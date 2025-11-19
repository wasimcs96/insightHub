<?php

namespace App\Services\Job;

use App\Models\Job;
use App\Models\JobSkill;
use App\Models\JobTechnicalSkills;
use App\Models\JobSubordinate;
use App\Models\MasterSkill;
use App\Models\MasterTechnicalSkill;
use App\Models\LlmSoftSkillDescription as CustomSoftSkillDescription;
use App\Models\JobCriticalFunction;
use App\Models\CwfFunction;
use App\Models\AirAsiaFamilyJob;
use App\Models\TechnicalSkillCategory;
use App\Models\JobPerformanceExpectation;
use App\Models\JobSecondaryScopeOfStudy;
use App\Models\Sector;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Events\JobProfilePushedToAirAsia;
use App\Models\JobHeadcount;
use App\Models\JobProfile;
use App\Models\DepartmentTechnicalSkills;
use Illuminate\Support\Facades\Log;
use App\Helpers\MainHelper;
use App\Models\MasterJob;
use App\Modules\Headcounts\Services\JobHeadcountService;

class JdJobService
{
    public function __construct(protected JobHeadcountService $hcService)
    {
        

    }

    function extractJobIdFromCode(string $code): ?int
    {
        $parts = explode('-', $code);
        return isset($parts[1]) ? (int)$parts[1] : null;
    }

    public function createJob(array $requestData)
    {
        // dd($requestData);
        DB::beginTransaction();
        try {
            // $sectorName = trim($requestData['sector_name'] ?? '');
            $sectorName = !empty(trim($requestData['sector_name'] ?? ''))
                ? trim($requestData['sector_name'])
                : trim($requestData['sector'] ?? '');
            $subSectorName = trim($requestData['sub_sector_name'] ?? '');

            $masterSectorId = DB::table('sectors')
                ->where('name', $sectorName)
                ->value('id');


            $masterSubSectorId = DB::table('master_sub_sectors')
                ->where('name', $subSectorName)
                ->value('id');

            $masterJobId = null;

            if (!empty($requestData['sierra_id'])) {
                $masterJobId = MasterJob::where('sierra_id', $requestData['sierra_id'])
                    ->where('is_primary', 1)
                    ->value('id'); // only return id if found
            }else if(!empty($requestData['ai_job_id'])){
                $masterJobId = Job::where('id', $requestData['ai_job_id'])
                    ->value('id'); // only return id if found
            }
            
            $job = new Job();

            $jobId = $this->extractJobIdFromCode($requestData['headcounts'][0]['id']);

            if ($jobId != null) {
                if (\App\Models\Job::where('id', $jobId)->exists()) {
                    // flash an error and redirect back
                    return redirect()->back()
                                    ->withInput()
                                    ->withErrors(['position_code' => 'Failed to create Job: generated Job ID already exists.']);
                }
                $job->incrementing = false;
                $job->id = $jobId;
            }

            // ✅ Update the job_profiles table name before creating the Job
            if (!empty($requestData['job_profileId']) && !empty($requestData['job_profile'])) {
                \App\Models\JobProfile::where('id', $requestData['job_profileId'])
                    ->update(['name' => $requestData['job_profile']]);
            }
            
            $job = Job::create([
                'id' => $jobId,
                'title' => $requestData['job_profile'],
                'status' => $requestData['status'] ?? '',
                'description' => $requestData['description'],
                'heads' => $requestData['heads'] ?? '',
                'level' => $requestData['level_job'] ?? '12',
                'position_code' => $requestData['position_code'] ?? '',
                'org_department' => $requestData['job_familyId'] ?? '',
                'department_id' => $requestData['job_familyId'] ?? '',
                'code' => $requestData['job_profile_id'] ?? Job::generateUniquePositionCode(),
                'position_code' => $requestData['job_profile_id'] ?? Job::generateUniquePositionCode(),
                'saved_job' => 1,
                'education_level' => $requestData['education_level'] ?? null,
                'scope_of_study' => $requestData['scope_of_study'] ?? null,
                'professional_certificate' => $requestData['professional_certificate'] ?? null,
                'relevant_training' => $requestData['relevant_training'] ?? null,
                'work_experience' => $requestData['work_experience'] ?? null,
                'relevant_course' => $requestData['relevant_course'] ?? null,
                'superior_id' => $requestData['superior'] ?? null,
                'sierra_id' => $requestData['sierra_id'] ?? null,
                'job_profile_id' => $requestData['job_profileId'] ?? null,
                'master_sector_id' => $masterSectorId,
                'master_sub_sector_id' => $masterSubSectorId,
                'job_level' => $requestData['level_job'] ?? null,
                'ssf_job_title' => $requestData['title'] ?? null,
                'division_id' => $requestData['division_id'] ?? '',
                'master_id' => $masterJobId,
            ]);

             if (isset($requestData['is_critical']) && $requestData['is_critical'] == 'on') {
                $job->is_critical = 1;
            } else {
                $job->is_critical = 0;
                
            }

            $job->business_unit_id = $requestData['business_unit_id'];

            if ($superior = $requestData['superior'] ?? null) {
                    $job->superior_id = $superior;
            }

            $job->save();

            $this->assignJobType($job, $requestData);
            // $this->handleAirAsiaFamilyJob($job->id, $requestData);
            $this->handleJobSkills($job->id, $requestData['genericSkills'] ?? []);
            $decodedTechnicalSkills = [];

            if (!empty($requestData['technicalskill'])) {
                $decoded = json_decode($requestData['technicalskill'], true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $decodedTechnicalSkills = $decoded;
                }
            } else {
                $decodedTechnicalSkills = $requestData['technicalSkills'] ?? [];
            }
            $this->handleTechnicalSkills($job->id, $decodedTechnicalSkills,$requestData['job_familyId'] ?? null);
            $this->handleJobFunctions($job->id, $requestData['functions'] ?? []);
            $this->handleSubordinates($job->id, $requestData['subordinates'] ?? []);
            $this->handlePerformanceExpectations($job->id, $requestData['perfomance_expectation'] ?? []);
            $this->handleSecondaryScopeOfStudy($job->id, $requestData['secondary_scope_of_study'] ?? []);
            $this->handleHeadCounts($job->id, $requestData['headcounts'] ?? [], $requestData['job_familyId'] ?? null);

            $this->handleTopPosition($requestData,$job);

            DB::commit();
            

            // if ($job->status == '1') {
            //     try {
            //         event(new JobProfilePushedToAirAsia($job->id));
            //     } catch (\Throwable $th) {
            //         //throw $th;
            //     }
            // }

            return $job;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        
        
    }

    public function createJobForOrgChart(array $requestData)
    {
        // dd(json_decode($requestData['technicalskill']),$requestData);
        DB::beginTransaction();
        try {     

            $jobProfile = JobProfile::updateorCreate(
                ['aa_job_profile_id' => $requestData['position_code']],
                [
                'aa_job_profile_id' => $requestData['position_code'],
                'name' => $requestData['job_profile_name'],
                'description' => $requestData['job_profile_description'] ?? '',
                'department_id' => $requestData['job_familyId'],
            ]);

            $requestData['job_profileId'] = $jobProfile->id;
            
            $job = Job::create([
                'is_top' => $requestData['is_top'],
                'title' => $requestData['job_profile_name'],
                'status' => $requestData['status'] ?? '',
                'description' => $requestData['description'],
                'heads' => $requestData['heads'] ?? '',
               'level' => $requestData['level_job'] ?? '12',
                'position_code' => $requestData['position_code'] ?? '',
                'division_id' => $requestData['division_id'] ?? '',
                'business_unit_id' => $requestData['business_unit_id'] ?? '',
                'org_department' => $requestData['job_familyId'] ?? '',
                'department_id' => $requestData['job_familyId'] ?? '',
                'code' => $requestData['position_code'] ?? '',
                // 'code' => $requestData['job_profile_id'] ?? Job::generateUniquePositionCode(),
                'saved_job' => 1,
                'education_level' => $requestData['education_level'] ?? null,
                'scope_of_study' => $requestData['scope_of_study'] ?? null,
                'professional_certificate' => $requestData['professional_certificate'] ?? null,
                'relevant_training' => $requestData['relevant_training'] ?? null,
                'work_experience' => $requestData['work_experience'] ?? null,
                'relevant_course' => $requestData['relevant_course'] ?? null,
                'superior_id' => $requestData['superior'] ?? null,
                'sierra_id' => $requestData['superior'] ?? null,
                'job_profile_id' => $requestData['job_profileId'] ?? null,
                'job_level' => $requestData['level'] ?? null,
            ]);
            // $job->level = $requestData['level_job'] ?? 12; // Default to 12 if not provided
            $job->save();
            // dd($job);

            $this->assignJobType($job, $requestData);
            // $this->handleAirAsiaFamilyJob($job->id, $requestData);
            $this->handleJobSkills($job->id, $requestData['genericSkills'] ?? []);
            $decodedTechnicalSkills = [];

            if (!empty($requestData['technicalskill'])) {
                $decoded = json_decode($requestData['technicalskill'], true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $decodedTechnicalSkills = $decoded;
                }
            } else {
                $decodedTechnicalSkills = $requestData['technicalSkills'] ?? [];
            }

            $this->handleTechnicalSkills($job->id, $decodedTechnicalSkills, $requestData['job_familyId'] ?? null);
            $this->handleJobFunctions($job->id, $requestData['functions'] ?? []);
            $this->handleSubordinates($job->id, $requestData['subordinates'] ?? []);
            $this->handlePerformanceExpectations($job->id, $requestData['perfomance_expectation'] ?? []);
            $this->handleSecondaryScopeOfStudy($job->id, $requestData['secondary_scope_of_study'] ?? []);
            $this->handleHeadCounts($job->id, $requestData['headcounts'] ?? [], $requestData['job_familyId'] ?? null);

            // if ($requestData['job_profileId']) {
            //     $this->handleUpdateProfile($requestData['job_profileId'], $requestData['job_profile'] ?? null);
            // }

            DB::commit();

            

            return $job;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        
        
    }

    public function updateJob($jobId, array $requestData)
    {
    //  dd($requestData);
        DB::beginTransaction();
        $masterJobId = null;
         if (!empty($requestData['sierra_id'])) {
                $masterJobId = MasterJob::where('sierra_id', $requestData['sierra_id'])
                    ->where('is_primary', 1)
                    ->value('id'); // only return id if found
            }
            else if(!empty($requestData['ai_job_id'])){
                $masterJobId = Job::where('id', $requestData['ai_job_id'])
                    ->value('id'); // only return id if found
            }
        try {

            $job = Job::findOrFail($jobId);

            $job->fill([
                'title' => $requestData['job_profile'] ?? $job->title,
                'status' => $requestData['status'] ?? $job->status,
                'description' => $requestData['description'] ?? $job->description,
                'heads' => $requestData['heads'] ?? $job->heads,
                'level' => $requestData['level_job'] ?? $job->level,
                'org_department' => $requestData['org_department'] ?? $job->org_department,
                'education_level' => $requestData['education_level'] ?? $job->education_level,
                // 'scope_of_study' => $requestData['scope_of_study'] ?? $job->scope_of_study,
                'scope_of_study' => $requestData['scope_of_study'] ?? null,
                'professional_certificate' => $requestData['professional_certificate'] ?? $job->professional_certificate,
                'relevant_training' => $requestData['relevant_training'] ?? $job->relevant_training,
                'work_experience' => $requestData['work_experience'] ?? $job->work_experience,
                'relevant_course' => $requestData['relevant_course'] ?? $job->relevant_course,
                'superior_id' => $requestData['superior'] ?? $job->superior_id,
                'sierra_id' => $requestData['sierra_id'] ?? $job->sierra_id,
                'master_id' => $masterJobId ?? $job->master_id,
                'job_level' => $requestData['level_job'] ?? $job->job_level,
            ]);

                $job->is_critical = $requestData['is_critical'] ?? false ? 1 : 0;

                if ($superior = $requestData['superior'] ?? null) {
                    $job->superior_id = $superior;
                }

            if (isset($requestData['is_critical']) && $requestData['is_critical'] == 'on') {
                $job->is_critical = 1;
            } else {
                $job->is_critical = 0;
                
            }

            $job->save();



            if ($job->job_profile_id) {
                $this->handleUpdateProfile($job->job_profile_id, $requestData['job_profile'] ?? null);
            }

            $this->assignJobType($job, $requestData);

            
            JobSkill::where('job_id', $job->id)->delete();
            $this->handleJobSkills($job->id, $requestData['genericSkills'] ?? []);

            // --- Capture current master technical skills BEFORE you modify relations
        $prevMasterIds = \App\Models\JobTechnicalSkills::where('job_id', $job->id)
            ->pluck('master_technical_skill_id')
            ->unique();

            $decodedTechnicalSkills = [];

            if (!empty($requestData['technicalskill'])) {
                $decoded = json_decode($requestData['technicalskill'], true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $decodedTechnicalSkills = $decoded;
                }
            } else {
                $decodedTechnicalSkills = $requestData['technicalSkills'] ?? [];
            }
            
            // JobTechnicalSkills::where('job_id', $job->id)->delete();
            // $this->handleTechnicalSkills($job->id, $decodedTechnicalSkills, $requestData['job_familyId'] ?? null);

            // --- Rebuild the job's technical skills
            \App\Models\JobTechnicalSkills::where('job_id', $job->id)->delete();
            $this->handleTechnicalSkills($job->id, $decodedTechnicalSkills, $requestData['job_familyId'] ?? null);

            // --- Capture the job's current master technical skills AFTER rebuild
            $currMasterIds = \App\Models\JobTechnicalSkills::where('job_id', $job->id)
                ->pluck('master_technical_skill_id')
                ->unique();

            // --- We only care about skills that were REMOVED by this update
            $removedMasterIds = $prevMasterIds->diff($currMasterIds);

            // --- Cleanup only if there are removed master skills
            if ($removedMasterIds->isNotEmpty()) {

                // 1) Are any of these removed skills still used by other jobs?
                $usedElsewhere = \App\Models\JobTechnicalSkills::whereIn('master_technical_skill_id', $removedMasterIds)
                    ->where('job_id', '!=', $job->id)
                    ->pluck('master_technical_skill_id')
                    ->unique();

                // Skills truly unused across ALL other jobs
                $unusedIds = $removedMasterIds->diff($usedElsewhere);

                // 2) If truly unused, delete custom master skills (is_custom in [1,2])
                if ($unusedIds->isNotEmpty()) {
                    \App\Models\MasterTechnicalSkill::whereIn('id', $unusedIds)
                        ->whereIn('is_custom', [1, 2])
                        ->delete();
                }

                // 3) Department (job family) cleanup for removed skills not used in this family
                $orgDepartment = $job->department_id; // keep naming consistent
                if (!empty($orgDepartment)) {
                    // All other jobs in this department (exclude current job)
                    $jobIdsInDept = \App\Models\Job::where('department_id', $orgDepartment)
                        ->where('id', '!=', $job->id)
                        ->pluck('id');

                    if ($jobIdsInDept->isNotEmpty()) {
                        // Which of the removed skills are still used by OTHER jobs in this family?
                        $skillsUsedInFamily = \App\Models\JobTechnicalSkills::whereIn('job_id', $jobIdsInDept)
                            ->whereIn('master_technical_skill_id', $removedMasterIds)
                            ->pluck('master_technical_skill_id')
                            ->unique();

                        // Removed skills not used anywhere in this family
                        $unusedInFamily = $removedMasterIds->diff($skillsUsedInFamily);

                        if ($unusedInFamily->isNotEmpty()) {
                            \App\Models\DepartmentTechnicalSkills::where('department_id', $orgDepartment)
                                ->whereIn('master_technical_skill_id', $unusedInFamily)
                                ->delete();
                        }
                    } else {
                        // No other jobs in this department → all removed are unused in family
                        \App\Models\DepartmentTechnicalSkills::where('department_id', $orgDepartment)
                            ->whereIn('master_technical_skill_id', $removedMasterIds)
                            ->delete();
                    }
                }
            }

            JobCriticalFunction::where('job_id', $job->id)->delete();
            $this->handleJobFunctions($job->id, $requestData['functions'] ?? []);

            JobSubordinate::where('job_id', $job->id)->delete();
            $this->handleSubordinates($job->id, $requestData['subordinates'] ?? []);

            JobPerformanceExpectation::where('job_id', $job->id)->delete();
            $this->handlePerformanceExpectations($job->id, $requestData['perfomance_expectation'] ?? []);

            JobSecondaryScopeOfStudy::where('job_id', $job->id)->delete();
            $this->handleSecondaryScopeOfStudy($job->id, $requestData['secondary_scope_of_study'] ?? []);

            $this->handleHeadCounts($job->id, $requestData['headcounts'] ?? [], $requestData['job_familyId'] ?? null);
            $this->handleHcCodes($requestData);

            DB::commit();
            try {
                MainHelper::jobTriggerByTypeOnPositionEdit($job->id,config('helpers.panel_names')[env('DB_DATABASE')]);
            } catch (\Throwable $th) {
                \Log::error($th);
            } 
            return $job;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        

    }


    private function assignJobType($job, $data)
    {

        $jd_from = $data['jd_from'];
  
        if ($jd_from) {
            if ($jd_from == '2') {
                $job->fill([
                    'level' => $data['level'],
                    'top3riasec' => $data['top3riasec'],
                    'sierra_id' => $data['job_type'],
                    'master_id' => $data['job_type'],
                    'job_type' => 'master',
                ]);
            } elseif ($jd_from == '3') {
                $masterJob = Job::find($data['job_type']);
                $job->fill([
                    'level' => $data['level'],
                    'top3riasec' => $data['top3riasec'],
                    'sierra_id' => $masterJob->sierra_id,
                    'master_id' => $data['job_type'],
                    'job_type' => 'saved',
                ]);
            } elseif ($jd_from == '1') {
                $job->fill([
                    'level' => $data['level'],
                    'job_type' => 'custom',
                    'top3riasec' => implode('', $data['riasec'] ?? []),
                ]);
            } elseif ($jd_from == "4") {
                $job->fill([
                    'level' => $data['level'],
                    'job_type' => 'ai',
                    'top3riasec' => $data['riasec'] ?? null,
                ]);
            } elseif ($jd_from == "5") {
                $riasec = $data['riasec'] ?? null;

                if (is_array($riasec)) {
                    $riasec = implode('', $riasec);
                }

                $job->fill([
                    'level' => $data['level'],
                    'job_type' => 'ai_gen',
                    'top3riasec' => $riasec,
                ]);
            }
            elseif ($jd_from == "6") {
                $riasec = $data['riasec'] ?? null;

                if (is_array($riasec)) {
                    $riasec = implode('', $riasec);
                }

                $job->fill([
                    'level' => $data['level'],
                    'job_type' => 'master_gen',
                    'top3riasec' => $riasec,
                ]);
            }
            elseif ($jd_from == "7") {
                $riasec = $data['riasec'] ?? null;

                if (is_array($riasec)) {
                    $riasec = implode('', $riasec);
                }

                $job->fill([
                    'level' => $data['level'],
                    'job_type' => 'company_gen',
                    'top3riasec' => $riasec,
                ]);
            }
            elseif ($jd_from == "8") {
                $riasec = $data['riasec'] ?? null;

                if (is_array($riasec)) {
                    $riasec = implode('', $riasec);
                }

                $job->fill([
                    'level' => $data['level'],
                    'job_type' => 'custom_gen',
                    'master_id' => null,
                    'top3riasec' => $riasec,
                ]);
            }
            $job->save();
        }
    }


    // private function handleAirAsiaFamilyJob($jobId, $data)
    // {
    //     AirAsiaFamilyJob::create([
    //         'job_id' => $jobId,
    //         'job_profile_id' => $data['job_profileId'] ?? null,
    //         'job_family_id' => $data['job_familyId'] ?? null,
    //         'job_family_group_id' => $data['job_family_groupId'] ?? null,
    //     ]);
    // }

//     private function handleAirAsiaFamilyJob($jobId, $data)
// {
//     if (!empty($data['localized_job']) && $data['localized_job'] == '1') {
//         $existing = AirAsiaFamilyJob::where('job_profile_id', $data['job_profileId'])->first();

//         if ($existing) {
//             $oldJobId = $existing->job_id;

//             // Delete old job if exists
//             Job::where('id', $oldJobId)->delete();

//             // Delete associated job skills
//             JobSkill::where('job_id', $oldJobId)->delete();

//             // Delete associated technical skills
//             JobTechnicalSkills::where('job_id', $oldJobId)->delete();

//              JobCriticalFunction::where('job_id', $oldJobId)->delete();

//             // Delete the old AirAsiaFamilyJob record (optional cleanup)
//             AirAsiaFamilyJob::where('job_profile_id', $data['job_profileId'])->delete();
//         }
//     }

//     // Insert the new job mapping
//     AirAsiaFamilyJob::create([
//         'job_id' => $jobId,
//         'job_profile_id' => $data['job_profileId'] ?? null,
//         'job_family_id' => $data['job_familyId'] ?? null,
//         'job_family_group_id' => $data['job_family_groupId'] ?? null,
//     ]);
// }

private function handleAirAsiaFamilyJob($jobId, $data)
{
    if (!empty($data['localized_job']) && $data['localized_job'] == '1') {
        // Find existing job using job_profile_id
        $existingJob = Job::where('job_profile_id', $data['job_profileId'])->first();

        if ($existingJob) {
            $oldJobId = $existingJob->id;

            $JobProfile = JobProfile::where('id', $data['job_profileId'])->first();
            $JobProfile->name = $data['job_profile_name'] ?? $JobProfile->name;
            $JobProfile->save();
        }
    }

}

private function handleUpdateProfile($job_profileId, $title)
{

        $JobProfile = JobProfile::where('id', $job_profileId)->first();
        $JobProfile->name = $title ?? $JobProfile->name;
        $JobProfile->save();

}


    

    private function handleJobSkills($jobId, $skills)
{
    foreach ($skills as $skill) {
       if ($skill['preferred_level'] == 'Basic') {
            $skill['preferred_level'] = 1;
        } elseif ($skill['preferred_level'] == 'Intermediate') {
            $skill['preferred_level'] = 2;
        } elseif ($skill['preferred_level'] == 'Advanced') {
            $skill['preferred_level'] = 3;
        }
//  dd($skill);
        JobSkill::create([
            'job_id' => $jobId,
            'title' => $skill['competency'] ?? '',
            'level' => $skill['preferred_level'] ?? '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

   
//     private function handleTechnicalSkills($jobId, $technicalSkills)
// {
//     // Delete existing technical skills for the job
//     JobTechnicalSkills::where('job_id', $jobId)->delete();

//     $newTechnicalSkills = [];

//     foreach ($technicalSkills as $skillData) {
//         if (!isset($skillData['name']) || empty($skillData['name'])) {
//             continue; // Skip invalid data
//         }

//         // Insert into MasterTechnicalSkill
//         $masterTechnicalSkill = new MasterTechnicalSkill();
//         $masterTechnicalSkill->job_id = $jobId;
//         $masterTechnicalSkill->type = 1;
//         $masterTechnicalSkill->sector_id = $skillData['sector_id'] ?? null;
//         $masterTechnicalSkill->sector_name = $skillData['sector_name'] ?? '';
//         $masterTechnicalSkill->sub_sector_id = $skillData['sub_sector_id'] ?? null;
//         $masterTechnicalSkill->sub_sector_name = $skillData['sub_sector_name'] ?? '';
//         $masterTechnicalSkill->code = $skillData['code'] ?? '';
//         $masterTechnicalSkill->name = $skillData['name'] ?? '';
//         $masterTechnicalSkill->description = $skillData['description'] ?? '';

//         // Level Descriptions, Knowledge, and Ability
//         for ($i = 1; $i <= 6; $i++) {
//             $masterTechnicalSkill->{'level_' . $i . '_description'} = $skillData['level_' . $i . '_description'] ?? '';

//             $levelKnowledge = $skillData['level_' . $i . '_knowledge'] ?? [];
//             $levelAbility = $skillData['level_' . $i . '_ability'] ?? [];

//             $masterTechnicalSkill->{'level_' . $i . '_knowledge'} = is_array($levelKnowledge)
//                 ? implode('; ', $levelKnowledge)
//                 : $levelKnowledge;

//             $masterTechnicalSkill->{'level_' . $i . '_ability'} = is_array($levelAbility)
//                 ? implode('; ', $levelAbility)
//                 : $levelAbility;
//         }

//         $masterTechnicalSkill->save();

//         // Insert into JobTechnicalSkills after saving to MasterTechnicalSkill
//         $newTechnicalSkills[] = [
//             'job_id' => $jobId,
//             'master_technical_skill_id' => $masterTechnicalSkill->id, // Use the saved ID
//             'level' => $skillData['level'] ?? null,
//             'created_at' => Carbon::now(),
//             'updated_at' => Carbon::now(),
//         ];
//     }

//     // Bulk Insert into JobTechnicalSkills
//     if (!empty($newTechnicalSkills)) {
//         JobTechnicalSkills::insert($newTechnicalSkills);
//     }
// }

    // private function handleTechnicalSkills($jobId, $technicalSkills, $jobFamilyId = null)
    // {
    //     // Delete existing job-to-skill relationships
    //     JobTechnicalSkills::where('job_id', $jobId)->delete();

    //     $newTechnicalSkills = [];
        

    //     foreach ($technicalSkills as $skillData) {
    //         if (empty($skillData['name'])) {
    //             continue; // Skip invalid entries
    //         }

    //         $masterTechnicalSkill = null;

    //         // Update logic if it's a custom skill and flagged as modified
    //         if (
    //             ($skillData['is_custom'] ?? null) == 2 &&
    //             ($skillData['is_modify'] ?? null) == 1 &&
    //             !empty($skillData['skill_id'])
    //         ) {
    //             $masterTechnicalSkill = MasterTechnicalSkill::find($skillData['skill_id']);
    //         }



    //         $categoryId = $skillData['category_id'] ?? null;

    //         $sectorId = $skillData['sector_id'] ?? null;
    //         if (!empty($skillData['sector_name'])) {
    //             $secName  = trim($skillData['sector_name']);
    //             $sectorId = MasterSector::whereRaw('LOWER(name) = ?', [mb_strtolower($secName)])
    //                 ->value('id'); // null if not found
    //         }
    //         $skillData['sector_id'] = $sectorId;

    //         if (!empty($skillData['category_name'])) {
    //             // $category = TechnicalSkillCategory::where('title', $skillData['category_name'])->first();
    //             // $categoryId = $category ? $category->id : null;
    //             $catName    = trim($skillData['category_name']);
    //             $categoryId = TechnicalSkillCategory::whereRaw('LOWER(title) = ?', [mb_strtolower($catName)])
    //                 ->when($sectorId, fn ($q) => $q->where('sector_id', $sectorId))
    //                 ->value('id'); // null if not found
    //         }

    //         $checkMasterTechnicalSkill = MasterTechnicalSkill::where('name',$skillData['name'])
    //             ->whereIn('is_custom', [1,2]) // Assuming type 1 is for custom skills
    //             ->where('category_id', $categoryId) // Assuming type 1 is for custom skills
    //             ->first();

    //         if ($checkMasterTechnicalSkill) {
    //             $masterTechnicalSkill = $checkMasterTechnicalSkill;
    //         }  
                

    //         // If not found or not editable, create new
    //         if (!$masterTechnicalSkill) {
    //             $masterTechnicalSkill = new MasterTechnicalSkill();
    //             // $masterTechnicalSkill->job_id = $jobId; // only for new records
    //             $masterTechnicalSkill->type = 1;
    //             $masterTechnicalSkill->is_custom = 1;
    //         }

    //         // Populate data
    //         $masterTechnicalSkill->sector_id = $skillData['sector_id'] ?? null;
    //         $masterTechnicalSkill->sector_name = $skillData['sector_name'] ?? '';
    //         $masterTechnicalSkill->sub_sector_id = $skillData['sub_sector_id'] ?? null;
    //         $masterTechnicalSkill->sub_sector_name = $skillData['sub_sector_name'] ?? '';
    //         $masterTechnicalSkill->code = $skillData['code'] ?? '';
    //         // $masterTechnicalSkill->name = $skillData['name'] ?? '';
    //         $fullName = $skillData['name'] ?? '';
    //         $shortName = trim(preg_replace('/\s*\(.*$/', '', $fullName));
    //         $masterTechnicalSkill->name = $shortName;
    //         $masterTechnicalSkill->description = $skillData['description'] ?? '';

    //         $masterTechnicalSkill->category_id = $categoryId;

    //         // Level Descriptions, Knowledge, and Ability (Level 1 to 6)
    //         for ($i = 1; $i <= 6; $i++) {
    //             $descKey = "level_{$i}_description";
    //             $knowKey = "level_{$i}_knowledge";
    //             $abilKey = "level_{$i}_ability";

    //             $masterTechnicalSkill->{$descKey} = $skillData[$descKey] ?? '';

    //             $levelKnowledge = $skillData[$knowKey] ?? [];
    //             $levelAbility = $skillData[$abilKey] ?? [];

    //             $masterTechnicalSkill->{$knowKey} = is_array($levelKnowledge)
    //                 ? implode('; ', $levelKnowledge)
    //                 : $levelKnowledge;

    //             $masterTechnicalSkill->{$abilKey} = is_array($levelAbility)
    //                 ? implode('; ', $levelAbility)
    //                 : $levelAbility;
    //         }

    //         $masterTechnicalSkill->save();

    //         // Add to JobTechnicalSkills (associate with job)
    //         $newTechnicalSkills[] = [
    //             'job_id' => $jobId,
    //             'master_technical_skill_id' => $masterTechnicalSkill->id,
    //             'level' => $skillData['preferred_level'] ?? null,
    //             'created_at' => Carbon::now(),
    //             'updated_at' => Carbon::now(),
    //         ];

    //             if ($jobFamilyId) {
    //                 $exists = DepartmentTechnicalSkills::where('master_technical_skill_id', $masterTechnicalSkill->id)
    //                     ->where('department_id', $jobFamilyId)
    //                     ->exists();

    //                 if (!$exists) {
    //                     $jobFamilySkillMappings[] = [
    //                         'master_technical_skill_id' => $masterTechnicalSkill->id,
    //                         'department_id' => $jobFamilyId,
    //                         'created_at' => Carbon::now(),
    //                         'updated_at' => Carbon::now(),
    //                     ];
    //                 }
    //             }
    //     }

    //     // Bulk insert job-skill mappings
    //        if (!empty($newTechnicalSkills)) {
    //             JobTechnicalSkills::insert($newTechnicalSkills);
    //         }

    //     if (!empty($jobFamilySkillMappings)) {
    //         DepartmentTechnicalSkills::insert($jobFamilySkillMappings);
    //     }
    // }

//     private function handleTechnicalSkills($jobId, $technicalSkills, $jobFamilyId = null)
// {
//     // dd($technicalSkills);
//     DB::transaction(function () use ($jobId, $technicalSkills, $jobFamilyId) {
//         // 0) Remove existing Job → Skill mappings (we do NOT delete master skills)
//         JobTechnicalSkills::where('job_id', $jobId)->delete();

//         $newTechnicalSkills       = [];
//         $jobFamilySkillMappings   = [];

//         foreach ((array) $technicalSkills as $skillData) {
//             // Skip empty rows
//             if (empty($skillData['name'])) {
//                 continue;
//             }

//             // Check if the skill's preferred level has a valid description, otherwise skip this skill
//             $preferredLevel = $skillData['preferred_level'] ?? null;

//             // Validate if the description for the preferred level exists
//             if ($preferredLevel) {
//                 $levelDescriptionKey = "level_{$preferredLevel}_description";
//                 $levelDescription = $skillData[$levelDescriptionKey] ?? null;

//                 // Skip the skill if the description for the preferred level is missing
//                 if (empty($levelDescription)) {
//                     // Log the skipped skill dynamically for the missing level description
//                     // Log::info("Skipping skill with job ID {$jobId} and skill name '{$skillData['name']}' because 'level_{$preferredLevel}_description' is missing.");
//                      // Log the entire skillData when the description is missing for the specific level
//                     Log::info("Skipping skill due to missing description for 'level_{$preferredLevel}_description'.", $skillData);
//                     continue;
//                 }
//             }

//             // --- 1) Resolve sector_id (by sector_name if provided) ---
//             $sectorId = $skillData['sector_id'] ?? null;
//             if (!empty($skillData['sector_name'])) {
//                 $secName  = trim($skillData['sector_name']);
//                 $sectorId = MasterSector::whereRaw('LOWER(name) = ?', [mb_strtolower($secName)])
//                     ->value('id'); // null if not found
//             }
//             $skillData['sector_id'] = $sectorId;

//             // --- 2) Resolve category_id (case-insensitive, optionally within sector) ---
//             $categoryId = $skillData['category_id'] ?? null;
//             if (!empty($skillData['category_name'])) {
//                 $catName    = trim($skillData['category_name']);
//                 $categoryId = TechnicalSkillCategory::whereRaw('LOWER(title) = ?', [mb_strtolower($catName)])
//                     ->when($sectorId, fn ($q) => $q->where('sector_id', $sectorId))
//                     ->value('id'); // null if not found
//             }
//             $skillData['category_id'] = $categoryId;

//             // --- 3) Normalize skill name (strip text in parentheses) ---
//             $fullName   = trim($skillData['name']);
//             // $shortName  = trim(preg_replace('/\s*\(.*$/', '', $fullName));
//             $shortName  = trim(preg_replace('/\s*\((?=[^()]*-)[^()]*\)\s*$/u', '', $fullName));
//             $shortLower = mb_strtolower($shortName);

//             // --- 4) Prefer explicit modify flow if provided ---
//             $explicitModify       = false;
//             $masterTechnicalSkill = null;

//             if (
//                 (($skillData['is_custom'] ?? null) == 2) &&
//                 (($skillData['is_modify'] ?? null) == 1) &&
//                 !empty($skillData['skill_id'])
//             ) {
//                 $masterTechnicalSkill = MasterTechnicalSkill::find($skillData['skill_id']);
//                 if ($masterTechnicalSkill) {
//                     $explicitModify = true;
//                 }
//             }

//             // --- 5) If not explicitly modifying, try to find duplicate by (name + category), CI ---
//             if (!$masterTechnicalSkill) {
//                 $masterTechnicalSkill = MasterTechnicalSkill::query()
//                     ->whereRaw('LOWER(name) = ?', [$shortLower])
//                     ->when($categoryId, fn ($q) => $q->where('category_id', $categoryId))
//                     ->whereIn('is_custom', [1, 2])   // include custom & system-custom buckets
//                     ->first();
//             }

//             // --- 6) Create only if not found ---
//             $isNew = false;
//             if (!$masterTechnicalSkill) {
//                 $masterTechnicalSkill            = new MasterTechnicalSkill();
//                 $masterTechnicalSkill->type      = 1;
//                 $masterTechnicalSkill->is_custom = 1;
//                 $isNew                           = true;
//             }

//             // --- 7) Populate fields: only for new OR explicit modify ---
//             if ($isNew || $explicitModify) {
//                 $masterTechnicalSkill->sector_id        = $skillData['sector_id'] ?? null;
//                 $masterTechnicalSkill->sector_name      = $skillData['sector_name'] ?? '';
//                 $masterTechnicalSkill->sub_sector_id    = $skillData['sub_sector_id'] ?? null;
//                 $masterTechnicalSkill->sub_sector_name  = $skillData['sub_sector_name'] ?? '';
//                 $masterTechnicalSkill->code             = $skillData['code'] ?? '';
//                 $masterTechnicalSkill->name             = $shortName;
//                 $masterTechnicalSkill->description      = $skillData['description'] ?? '';
//                 $masterTechnicalSkill->category_id      = $categoryId;
//                 $masterTechnicalSkill->is_overwrite     = 1;

//                 // levels 1..6 (desc, knowledge, ability)
//                 for ($i = 1; $i <= 6; $i++) {
//                     $descKey = "level_{$i}_description";
//                     $knowKey = "level_{$i}_knowledge";
//                     $abilKey = "level_{$i}_ability";

//                     $masterTechnicalSkill->{$descKey} = $skillData[$descKey] ?? '';

//                     $levelKnowledge = $skillData[$knowKey] ?? [];
//                     $levelAbility   = $skillData[$abilKey] ?? [];

//                     $masterTechnicalSkill->{$knowKey} = is_array($levelKnowledge)
//                         ? implode('; ', $levelKnowledge)
//                         : $levelKnowledge;

//                     $masterTechnicalSkill->{$abilKey} = is_array($levelAbility)
//                         ? implode('; ', $levelAbility)
//                         : $levelAbility;
//                 }
//             } else {
//                 // Optional small syncs if existing record missed these
//                 if (empty($masterTechnicalSkill->category_id) && $categoryId) {
//                     $masterTechnicalSkill->category_id = $categoryId;
//                 }
//                 if (mb_strtolower(trim($masterTechnicalSkill->name)) !== $shortLower) {
//                     $masterTechnicalSkill->name = $shortName;
//                 }
//             }

//             $masterTechnicalSkill->save();

//             // --- 8) Queue Job → Skill mapping ---
//             $newTechnicalSkills[] = [
//                 'job_id'                     => $jobId,
//                 'master_technical_skill_id'  => $masterTechnicalSkill->id,
//                 'level'                      => $skillData['preferred_level'] ?? null,
//                 'created_at'                 => Carbon::now(),
//                 'updated_at'                 => Carbon::now(),
//             ];

//             // --- 9) Queue JobFamily/Department → Skill mapping (idempotent) ---
//             if ($jobFamilyId) {
//                 // If your table is DepartmentTechnicalSkills, swap the model & columns below accordingly.
//                 $exists = DepartmentTechnicalSkills::where('master_technical_skill_id', $masterTechnicalSkill->id)
//                     ->where('department_id', $jobFamilyId)
//                     ->exists();

//                 if (!$exists) {
//                     $jobFamilySkillMappings[] = [
//                         'master_technical_skill_id' => $masterTechnicalSkill->id,
//                         'department_id'             => $jobFamilyId,
//                         'created_at'                => Carbon::now(),
//                         'updated_at'                => Carbon::now(),
//                     ];
//                 }
//             }

//             // if (isset($skillData['is_modify']) && $skillData['is_modify'] == 1) {
//             //     // Get all existing JobTechnicalSkills records for this master_technical_skill_id
//             //     $existingJobSkills = JobTechnicalSkills::where('master_technical_skill_id', $skillData['skill_id'])->get();

//             //     // Loop through each existing JobTechnicalSkills record
//             //     foreach ($existingJobSkills as $jobTechnicalSkill) {
//             //         // Dynamically determine the level description key based on the level
//             //         $levelDescKey = "level_{$jobTechnicalSkill->level}_description";  // e.g., level_1_description, level_2_description, ...

//             //         // Check if the corresponding level description exists for this level in technicalSkills
//             //         if (empty($skillData[$levelDescKey])) {
//             //             // If the description is missing, delete the record
//             //             $jobTechnicalSkill->delete();
//             //             break;  // Exit the loop as we have already found the missing description and deleted the row
//             //         }
//             //     }
//             // }
//         }

//          // --- 10) Delete JobTechnicalSkills rows with missing level descriptions where is_modify = 1 ---
        

//         foreach ((array) $technicalSkills as $skillData) {
//             if (($skillData['is_modify'] ?? 0) == 1) {  // Ensure "is_modify" is 1
//                 // Loop through levels 1 to 6 dynamically
//                 for ($i = 1; $i <= 6; $i++) { 
//                     $levelDescKey = "level_{$i}_description";  // Generate keys dynamically: level_1_description, level_2_description, ...

//                     // Log current skill data for debugging
//                     Log::info("Checking level {$i} for skill: {$skillData['name']}");
//                     Log::info("Level description key: {$levelDescKey}");

//                     // Check if the description key exists (even if empty) or is missing entirely
//                     if (!array_key_exists($levelDescKey, $skillData) || empty($skillData[$levelDescKey])) {
//                         // Log the level being deleted
//                         Log::info("Deleting all records for level {$i} where skill_id = {$skillData['skill_id']}");

//                         // Delete all JobTechnicalSkills records for this master_technical_skill_id and level $i
//                         JobTechnicalSkills::where('master_technical_skill_id', $skillData['skill_id'])
//                             ->where('level', $i)  // Filter by the specific level (e.g., level 1, level 2, etc.)
//                             ->delete();  // Delete the records for this level across all jobs
                        
//                         break;  // Exit the loop after deleting the records for this level
//                     }
//                 }
//             }
//         }







//         // --- 10) Bulk insert mappings ---
//         if (!empty($newTechnicalSkills)) {
//             JobTechnicalSkills::insert($newTechnicalSkills);
//         }
//         if (!empty($jobFamilySkillMappings)) {
//             DepartmentTechnicalSkills::insert($jobFamilySkillMappings);
//         }
//     });
// }

// private function handleTechnicalSkills($jobId, $technicalSkills, $jobFamilyId = null)
// {
//     DB::transaction(function () use ($jobId, $technicalSkills, $jobFamilyId) {

//         // Remove existing mappings for this job (skills stay)
//         JobTechnicalSkills::where('job_id', $jobId)->delete();

//         $newTechnicalSkills     = [];
//         $jobFamilySkillMappings = [];

//         // helpers
//         $cleanShortName = function (?string $name): string {
//             $name = trim((string)$name);
//             // drop "(...-...)" tail
//             $name = trim(preg_replace('/\s*\((?=[^()]*-)[^()]*\)\s*$/u', '', $name));
//             // collapse inner whitespace
//             $name = preg_replace('/\s+/u', ' ', $name);
//             return $name;
//         };

//         foreach ((array)$technicalSkills as $skillData) {
//             if (empty($skillData['name'])) { continue; }

//             // ---- preferred level must have description ----
//             $preferredLevel = $skillData['preferred_level'] ?? null;
//             if ($preferredLevel) {
//                 $k = "level_{$preferredLevel}_description";
//                 if (empty($skillData[$k])) {
//                     Log::info("Skipping skill due to missing '{$k}'.", $skillData);
//                     continue;
//                 }
//             }

//             // ---- resolve sector & category ids (case-insensitive) ----
//             $sectorId = $skillData['sector_id'] ?? null;
//             if (!empty($skillData['sector_name'])) {
//                 $secName  = trim($skillData['sector_name']);
//                 $sectorId = MasterSector::whereRaw('LOWER(name) = ?', [mb_strtolower($secName)])->value('id');
//             }
//             $skillData['sector_id'] = $sectorId;

//             $categoryId = $skillData['category_id'] ?? null;
//             if (!empty($skillData['category_name'])) {
//                 $catName    = trim($skillData['category_name']);
//                 $categoryId = TechnicalSkillCategory::whereRaw('LOWER(title) = ?', [mb_strtolower($catName)])
//                     ->when($sectorId, fn($q) => $q->where('sector_id', $sectorId))
//                     ->value('id');
//             }
//             $categoryId = $categoryId ?: null;
//             $skillData['category_id'] = $categoryId;

//             // ---- normalised names ----
//             $fullName   = trim($skillData['name']);
//             $shortName  = $cleanShortName($fullName);
//             $shortLower = mb_strtolower($shortName);
//             $code       = $skillData['code'] ?? null;

//             // ---- intent flags (per-row) ----
//             $isCustom = (int)($skillData['is_custom'] ?? 0);                  // 0=master, 1/2=company buckets
//             $isModify = (int)($skillData['is_modify'] ?? 0) === 1;            // overwrite existing company
//             $isNew    = (int)($skillData['is_new'] ?? 0) === 1;               // convert master → company
//             $isNewDup = (int)($skillData['is_new_company_skill'] ?? 0) === 1; // create duplicate company
//             $skillId  = $skillData['skill_id'] ?? null;

//             // ---- finders (robust) ----
//             $findMaster = function() use ($skillId,$code,$shortName,$shortLower,$categoryId,$sectorId) {
//                 // 1) by id
//                 if (!empty($skillId)) {
//                     $row = MasterTechnicalSkill::where('is_custom', 0)->find($skillId);
//                     if ($row) return $row;
//                 }
//                 // 2) by code (unique)
//                 if (!empty($code)) {
//                     $row = MasterTechnicalSkill::where('is_custom', 0)->where('code', $code)->first();
//                     if ($row) return $row;
//                 }

//                 // 3) exact clean name + category
//                 $q = MasterTechnicalSkill::query()
//                     ->where('is_custom', 0)
//                     ->whereRaw('LOWER(name) = ?', [$shortLower]);
//                 if ($categoryId) $q->where('category_id', $categoryId);
//                 $row = $q->first();
//                 if ($row) return $row;

//                 // 4) exact clean name + sector
//                 if ($sectorId) {
//                     $row = MasterTechnicalSkill::where('is_custom', 0)
//                         ->whereRaw('LOWER(name) = ?', [$shortLower])
//                         ->where('sector_id', $sectorId)
//                         ->first();
//                     if ($row) return $row;
//                 }

//                 // 5) exact clean name (no cat/sector)
//                 $row = MasterTechnicalSkill::where('is_custom', 0)
//                     ->whereRaw('LOWER(name) = ?', [$shortLower])
//                     ->first();
//                 if ($row) return $row;

//                 // 6) name LIKE 'Short Name (%' — handles stored master names WITH the suffix
//                 $row = MasterTechnicalSkill::where('is_custom', 0)
//                     ->whereRaw('LOWER(name) LIKE ?', [mb_strtolower($shortName) . ' (%'])
//                     ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
//                     ->first();
//                 if ($row) return $row;

//                 // 7) last resort: LIKE prefix without cat filter
//                 return MasterTechnicalSkill::where('is_custom', 0)
//                     ->whereRaw('LOWER(name) LIKE ?', [mb_strtolower($shortName) . '%'])
//                     ->first();
//             };

//             $findCompany = function() use ($skillId,$shortLower,$categoryId) {
//                 if (!empty($skillId)) {
//                     $row = MasterTechnicalSkill::find($skillId);
//                     if ($row && (int)$row->is_custom !== 0) return $row;
//                 }
//                 return MasterTechnicalSkill::query()
//                     ->whereIn('is_custom', [1,2])
//                     ->whereRaw('LOWER(name) = ?', [$shortLower])
//                     ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
//                     ->first();
//             };

//             // try to locate its master for lineage
//             $sourceMaster = $findMaster();
//             $sourceMasterId = $sourceMaster?->id;

//             $targetSkill      = null; // MasterTechnicalSkill model (master/company)
//             $shouldSaveTarget = false;
//             $explicitModify   = false;

//             // ─── 1) Master-only link ────────────────────────────────────────────
//             if ($isCustom === 0 && !$isNew && !$isNewDup && !$isModify) {
//                 $targetSkill = $sourceMaster;
//                 if (!$targetSkill) {
//                     // create MASTER only if nothing matched
//                     $targetSkill            = new MasterTechnicalSkill();
//                     $targetSkill->type      = 1;
//                     $targetSkill->is_custom = 0;
//                     $shouldSaveTarget       = true;
//                     Log::info("Master-only: master not found, creating new master '{$shortName}'.", $skillData);
//                 }
//             }
//             // ─── 2) Overwrite existing COMPANY ─────────────────────────────────
//             elseif ($isCustom !== 0 && $isModify && !empty($skillId)) {
//                 $targetSkill = MasterTechnicalSkill::find($skillId);
//                 if (!$targetSkill || (int)$targetSkill->is_custom === 0) {
//                     Log::info("Overwrite: invalid company id for '{$shortName}'", $skillData);
//                     continue;
//                 }
//                 $explicitModify   = true;
//                 $shouldSaveTarget = true;
//             }
//             // ─── 3) Create another COMPANY duplicate ───────────────────────────
//             elseif ($isNewDup) {
//                 $targetSkill            = new MasterTechnicalSkill();
//                 $targetSkill->type      = 1;
//                 $targetSkill->is_custom = 1; // company
//                 $shouldSaveTarget       = true;
//             }
//             // ─── 4) Convert MASTER → COMPANY (first time, reuse if present) ────
//             elseif ($isCustom === 0 && $isNew) {
//                 $existingCompany = $findCompany();
//                 if ($existingCompany && !$isNewDup) {
//                     $targetSkill = $existingCompany;
//                     if (empty($targetSkill->master_technical_skill_id) && $sourceMasterId) {
//                         $targetSkill->master_technical_skill_id = $sourceMasterId;
//                         $targetSkill->save();
//                     }
//                 } else {
//                     $targetSkill            = new MasterTechnicalSkill();
//                     $targetSkill->type      = 1;
//                     $targetSkill->is_custom = 1;
//                     $shouldSaveTarget       = true;
//                 }
//             }
//             // ─── 5) Reuse COMPANY ──────────────────────────────────────────────
//             elseif ($isCustom !== 0 && !$isModify && !$isNewDup) {
//                 $targetSkill = $findCompany();
//                 if (!$targetSkill) {
//                     Log::info("Reuse-company: not found '{$shortName}', skipping.", $skillData);
//                     continue;
//                 }
//                 if (empty($targetSkill->master_technical_skill_id) && $sourceMasterId) {
//                     $targetSkill->master_technical_skill_id = $sourceMasterId;
//                     $targetSkill->save();
//                 }
//             }
//             else {
//                 Log::info("No intent matched for '{$shortName}', skipping.", $skillData);
//                 continue;
//             }

//             // ─── populate (create/overwrite/master-autocreate) ─────────────────
//             if ($shouldSaveTarget) {
//                 $targetSkill->sector_id       = $skillData['sector_id'] ?? null;
//                 $targetSkill->sector_name     = $skillData['sector_name'] ?? '';
//                 $targetSkill->sub_sector_id   = $skillData['sub_sector_id'] ?? null;
//                 $targetSkill->sub_sector_name = $skillData['sub_sector_name'] ?? '';
//                 $targetSkill->code            = $skillData['code'] ?? '';
//                 $targetSkill->name            = $shortName;
//                 $targetSkill->description     = $skillData['description'] ?? '';
//                 $targetSkill->category_id     = $categoryId;
//                 $targetSkill->is_overwrite    = $explicitModify ? 1 : 0;

//                 // lineage only for company
//                 if ((int)$targetSkill->is_custom !== 0 && $sourceMasterId) {
//                     $targetSkill->master_technical_skill_id = $sourceMasterId;
//                 }

//                 for ($i = 1; $i <= 6; $i++) {
//                     $descKey = "level_{$i}_description";
//                     $knowKey = "level_{$i}_knowledge";
//                     $abilKey = "level_{$i}_ability";

//                     $targetSkill->{$descKey} = $skillData[$descKey] ?? '';

//                     $levelKnowledge = $skillData[$knowKey] ?? [];
//                     $levelAbility   = $skillData[$abilKey] ?? [];

//                     $targetSkill->{$knowKey} = is_array($levelKnowledge) ? implode('; ', $levelKnowledge) : $levelKnowledge;
//                     $targetSkill->{$abilKey} = is_array($levelAbility)   ? implode('; ', $levelAbility)   : $levelAbility;
//                 }

//                 $targetSkill->save();
//             } else {
//                 // tiny syncs on reuse
//                 $touched = false;
//                 if (empty($targetSkill->category_id) && $categoryId) {
//                     $targetSkill->category_id = $categoryId; $touched = true;
//                 }
//                 if (mb_strtolower(trim($targetSkill->name)) !== $shortLower) {
//                     $targetSkill->name = $shortName; $touched = true;
//                 }
//                 if ($touched) { $targetSkill->save(); }
//             }

//             // ---- job → skill mapping ----
//             $newTechnicalSkills[] = [
//                 'job_id'                    => $jobId,
//                 'master_technical_skill_id' => $targetSkill->id,
//                 'level'                     => $skillData['preferred_level'] ?? null,
//                 'created_at'                => Carbon::now(),
//                 'updated_at'                => Carbon::now(),
//             ];

//             // ---- department mapping (idempotent) ----
//             if ($jobFamilyId) {
//                 $exists = DepartmentTechnicalSkills::where('master_technical_skill_id', $targetSkill->id)
//                     ->where('department_id', $jobFamilyId)
//                     ->exists();

//                 if (!$exists) {
//                     $jobFamilySkillMappings[] = [
//                         'master_technical_skill_id' => $targetSkill->id,
//                         'department_id'             => $jobFamilyId,
//                         'created_at'                => Carbon::now(),
//                         'updated_at'                => Carbon::now(),
//                     ];
//                 }
//             }
//         }

//         // ---- overwrite cleanup (your step 10) ----
//         foreach ((array)$technicalSkills as $skillData) {
//             if ((int)($skillData['is_modify'] ?? 0) === 1) {
//                 for ($i = 1; $i <= 6; $i++) {
//                     $k = "level_{$i}_description";
//                     Log::info("Checking level {$i} for skill: {$skillData['name']}");
//                     if (!array_key_exists($k, $skillData) || empty($skillData[$k])) {
//                         Log::info("Deleting all records for level {$i} where skill_id = {$skillData['skill_id']}");
//                         JobTechnicalSkills::where('master_technical_skill_id', $skillData['skill_id'])
//                             ->where('level', $i)
//                             ->delete();
//                         break;
//                     }
//                 }
//             }
//         }

//         // ---- bulk inserts ----
//         if (!empty($newTechnicalSkills)) {
//             JobTechnicalSkills::insert($newTechnicalSkills);
//         }
//         if (!empty($jobFamilySkillMappings)) {
//             DepartmentTechnicalSkills::insert($jobFamilySkillMappings);
//         }
//     });
// }

// private function handleTechnicalSkills($jobId, $technicalSkills, $jobFamilyId = null)
// {
//     // dd($technicalSkills);
//     DB::transaction(function () use ($jobId, $technicalSkills, $jobFamilyId) {

//         // Remove existing mappings for this job (skills stay)
//         JobTechnicalSkills::where('job_id', $jobId)->delete();

//         $newTechnicalSkills     = [];
//         $jobFamilySkillMappings = [];

//         // helpers
//         $cleanShortName = function (?string $name): string {
//             $name = trim((string)$name);
//             // drop "(...-...)" tail
//             $name = trim(preg_replace('/\s*\((?=[^()]*-)[^()]*\)\s*$/u', '', $name));
//             // collapse inner whitespace
//             $name = preg_replace('/\s+/u', ' ', $name);
//             return $name;
//         };

//         foreach ((array)$technicalSkills as $skillData) {
//             if (empty($skillData['name'])) { continue; }

//             // ---- preferred level must have description ----
//             $preferredLevel = $skillData['preferred_level'] ?? null;
//             if ($preferredLevel) {
//                 $k = "level_{$preferredLevel}_description";
//                 if (empty($skillData[$k])) {
//                     Log::info("Skipping skill due to missing '{$k}'.", $skillData);
//                     continue;
//                 }
//             }

//             // ---- resolve sector & category ids (case-insensitive) ----
//             $sectorId = $skillData['sector_id'] ?? null;
//             if (!empty($skillData['sector_name'])) {
//                 $secName  = trim($skillData['sector_name']);
//                 $sectorId = MasterSector::whereRaw('LOWER(name) = ?', [mb_strtolower($secName)])->value('id');
//             }
//             $skillData['sector_id'] = $sectorId;

//             $categoryId = $skillData['category_id'] ?? null;
//             if (!empty($skillData['category_name'])) {
//                 $catName    = trim($skillData['category_name']);
//                 $categoryId = TechnicalSkillCategory::whereRaw('LOWER(title) = ?', [mb_strtolower($catName)])
//                     ->when($sectorId, fn($q) => $q->where('sector_id', $sectorId))
//                     ->value('id');
//             }
//             $categoryId = $categoryId ?: null;
//             $skillData['category_id'] = $categoryId;

//             // ---- normalised names ----
//             $fullName   = trim($skillData['name']);
//             $shortName  = $cleanShortName($fullName);
//             $shortLower = mb_strtolower($shortName);
//             $code       = $skillData['code'] ?? null;

//             // ---- intent flags (per-row) ----
//             $isCustom = (int)($skillData['is_custom'] ?? 0);                  // 0=master, 1/2=company buckets
//             $isModify = (int)($skillData['is_modify'] ?? 0) === 1;            // overwrite existing company
//             $isNew    = (int)($skillData['is_new'] ?? 0) === 1;               // convert master → company
//             $isNewDup = (int)($skillData['is_new_company_skill'] ?? 0) === 1; // create duplicate company
//             $skillId  = $skillData['skill_id'] ?? null;

//             // ---- finders (robust) ----
//             $findMaster = function() use ($skillId,$code,$shortName,$shortLower,$categoryId,$sectorId) {
//                 // 1) by id
//                 if (!empty($skillId)) {
//                     $row = MasterTechnicalSkill::where('is_custom', 0)->find($skillId);
//                     if ($row) return $row;
//                 }
//                 // 2) by code (unique)
//                 if (!empty($code)) {
//                     $row = MasterTechnicalSkill::where('is_custom', 0)->where('code', $code)->first();
//                     if ($row) return $row;
//                 }

//                 // 3) exact clean name + category
//                 $q = MasterTechnicalSkill::query()
//                     ->where('is_custom', 0)
//                     ->whereRaw('LOWER(name) = ?', [$shortLower]);
//                 if ($categoryId) $q->where('category_id', $categoryId);
//                 $row = $q->first();
//                 if ($row) return $row;

//                 // 4) exact clean name + sector
//                 if ($sectorId) {
//                     $row = MasterTechnicalSkill::where('is_custom', 0)
//                         ->whereRaw('LOWER(name) = ?', [$shortLower])
//                         ->where('sector_id', $sectorId)
//                         ->first();
//                     if ($row) return $row;
//                 }

//                 // 5) exact clean name (no cat/sector)
//                 $row = MasterTechnicalSkill::where('is_custom', 0)
//                     ->whereRaw('LOWER(name) = ?', [$shortLower])
//                     ->first();
//                 if ($row) return $row;

//                 // 6) name LIKE 'Short Name (%' — handles stored master names WITH the suffix
//                 $row = MasterTechnicalSkill::where('is_custom', 0)
//                     ->whereRaw('LOWER(name) LIKE ?', [mb_strtolower($shortName) . ' (%'])
//                     ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
//                     ->first();
//                 if ($row) return $row;

//                 // 7) last resort: LIKE prefix without cat filter
//                 return MasterTechnicalSkill::where('is_custom', 0)
//                     ->whereRaw('LOWER(name) LIKE ?', [mb_strtolower($shortName) . '%'])
//                     ->first();
//             };

//             $findCompany = function() use ($skillId,$shortLower,$categoryId) {
//                 if (!empty($skillId)) {
//                     $row = MasterTechnicalSkill::find($skillId);
//                     if ($row && (int)$row->is_custom !== 0) return $row;
//                 }
//                 return MasterTechnicalSkill::query()
//                     ->whereIn('is_custom', [1,2])
//                     ->whereRaw('LOWER(name) = ?', [$shortLower])
//                     ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
//                     ->first();
//             };

//             // try to locate its master for lineage
//             $sourceMaster   = $findMaster();
//             $sourceMasterId = $sourceMaster?->id;

//             // ❗ lineage suppression: company edit/duplicate flows
//             $suppressLineage = ($isCustom !== 0) && ($isModify || $isNewDup);

//             $targetSkill      = null; // MasterTechnicalSkill model (master/company)
//             $shouldSaveTarget = false;
//             $explicitModify   = false;

//             // ─── 1) Master-only link ────────────────────────────────────────────
//             if ($isCustom === 0 && !$isNew && !$isNewDup && !$isModify) {
//                 $targetSkill = $sourceMaster;
//                 if (!$targetSkill) {
//                     // create MASTER only if nothing matched
//                     $targetSkill            = new MasterTechnicalSkill();
//                     $targetSkill->type      = 1;
//                     $targetSkill->is_custom = 0;
//                     $shouldSaveTarget       = true;
//                     Log::info("Master-only: master not found, creating new master '{$shortName}'.", $skillData);
//                 }
//             }
//             // ─── 2) Overwrite existing COMPANY ─────────────────────────────────
//             elseif ($isCustom !== 0 && $isModify && !empty($skillId)) {
//                 $targetSkill = MasterTechnicalSkill::find($skillId);
//                 if (!$targetSkill || (int)$targetSkill->is_custom === 0) {
//                     Log::info("Overwrite: invalid company id for '{$shortName}'", $skillData);
//                     continue;
//                 }
//                 $explicitModify   = true;
//                 $shouldSaveTarget = true;
//             }
//             // ─── 3) Create another COMPANY duplicate ───────────────────────────
//             elseif ($isNewDup) {
//                 $targetSkill            = new MasterTechnicalSkill();
//                 $targetSkill->type      = 1;
//                 $targetSkill->is_custom = 1; // company
//                 $shouldSaveTarget       = true;
//             }
//             // ─── 4) Convert MASTER → COMPANY (first time, reuse if present) ────
//             elseif ($isCustom === 0 && $isNew) {
//                 $existingCompany = $findCompany();
//                 if ($existingCompany && !$isNewDup) {
//                     $targetSkill = $existingCompany;
//                     if (empty($targetSkill->master_technical_skill_id) && $sourceMasterId && !$suppressLineage) {
//                         $targetSkill->master_technical_skill_id = $sourceMasterId;
//                         $targetSkill->save();
//                     }
//                 } else {
//                     $targetSkill            = new MasterTechnicalSkill();
//                     $targetSkill->type      = 1;
//                     $targetSkill->is_custom = 1;
//                     $shouldSaveTarget       = true;
//                 }
//             }
//             // ─── 5) Reuse COMPANY ──────────────────────────────────────────────
//             elseif ($isCustom !== 0 && !$isModify && !$isNewDup) {
//                 $targetSkill = $findCompany();
//                 if (!$targetSkill) {
//                     Log::info("Reuse-company: not found '{$shortName}', skipping.", $skillData);
//                     continue;
//                 }
//                 if (empty($targetSkill->master_technical_skill_id) && $sourceMasterId && !$suppressLineage) {
//                     $targetSkill->master_technical_skill_id = $sourceMasterId;
//                     $targetSkill->save();
//                 }
//             }
//             else {
//                 Log::info("No intent matched for '{$shortName}', skipping.", $skillData);
//                 continue;
//             }

//             // ─── populate (create/overwrite/master-autocreate) ─────────────────
//             if ($shouldSaveTarget) {
//                 $targetSkill->sector_id       = $skillData['sector_id'] ?? null;
//                 $targetSkill->sector_name     = $skillData['sector_name'] ?? '';
//                 $targetSkill->sub_sector_id   = $skillData['sub_sector_id'] ?? null;
//                 $targetSkill->sub_sector_name = $skillData['sub_sector_name'] ?? '';
//                 $targetSkill->code            = $skillData['code'] ?? '';
//                 $targetSkill->name            = $shortName;
//                 $targetSkill->description     = $skillData['description'] ?? '';
//                 $targetSkill->category_id     = $categoryId;
//                 $targetSkill->is_overwrite    = $explicitModify ? 1 : 0;

//                 // lineage only for company & not suppressed
//                 // if ((int)$targetSkill->is_custom !== 0) {
//                 //     if ($isNew && !$isNewDup && !$isModify && $sourceMasterId) {
//                 //         $targetSkill->master_technical_skill_id = $sourceMasterId;
//                 //     } else {
//                 //         $targetSkill->master_technical_skill_id = null; // clear for duplicate/overwrite/other flows
//                 //     }
//                 // }

//                 if ((int)$targetSkill->is_custom !== 0 && $sourceMasterId && !$suppressLineage) { $targetSkill->master_technical_skill_id = $sourceMasterId; }

//                 for ($i = 1; $i <= 6; $i++) {
//                     $descKey = "level_{$i}_description";
//                     $knowKey = "level_{$i}_knowledge";
//                     $abilKey = "level_{$i}_ability";

//                     $targetSkill->{$descKey} = $skillData[$descKey] ?? '';

//                     $levelKnowledge = $skillData[$knowKey] ?? [];
//                     $levelAbility   = $skillData[$abilKey] ?? [];

//                     $targetSkill->{$knowKey} = is_array($levelKnowledge) ? implode('; ', $levelKnowledge) : $levelKnowledge;
//                     $targetSkill->{$abilKey} = is_array($levelAbility)   ? implode('; ', $levelAbility)   : $levelAbility;
//                 }

//                 $targetSkill->save();
//             } else {
//                 // tiny syncs on reuse
//                 $touched = false;
//                 if (empty($targetSkill->category_id) && $categoryId) {
//                     $targetSkill->category_id = $categoryId; $touched = true;
//                 }
//                 if (mb_strtolower(trim($targetSkill->name)) !== $shortLower) {
//                     $targetSkill->name = $shortName; $touched = true;
//                 }
//                 if ($touched) { $targetSkill->save(); }
//             }

//             // ---- job → skill mapping ----
//             $newTechnicalSkills[] = [
//                 'job_id'                    => $jobId,
//                 'master_technical_skill_id' => $targetSkill->id,
//                 'level'                     => $skillData['preferred_level'] ?? null,
//                 'created_at'                => Carbon::now(),
//                 'updated_at'                => Carbon::now(),
//             ];

//             // ---- department mapping (idempotent) ----
//             if ($jobFamilyId) {
//                 $exists = DepartmentTechnicalSkills::where('master_technical_skill_id', $targetSkill->id)
//                     ->where('department_id', $jobFamilyId)
//                     ->exists();

//                 if (!$exists) {
//                     $jobFamilySkillMappings[] = [
//                         'master_technical_skill_id' => $targetSkill->id,
//                         'department_id'             => $jobFamilyId,
//                         'created_at'                => Carbon::now(),
//                         'updated_at'                => Carbon::now(),
//                     ];
//                 }
//             }
//         }

//         // ---- overwrite cleanup (your step 10) ----
//         foreach ((array)$technicalSkills as $skillData) {
//             if ((int)($skillData['is_modify'] ?? 0) === 1) {
//                 for ($i = 1; $i <= 6; $i++) {
//                     $k = "level_{$i}_description";
//                     Log::info("Checking level {$i} for skill: {$skillData['name']}");
//                     if (!array_key_exists($k, $skillData) || empty($skillData[$k])) {
//                         Log::info("Deleting all records for level {$i} where skill_id = {$skillData['skill_id']}");
//                         JobTechnicalSkills::where('master_technical_skill_id', $skillData['skill_id'])
//                             ->where('level', $i)
//                             ->delete();
//                         break;
//                     }
//                 }
//             }
//         }

//         // ---- bulk inserts ----
//         if (!empty($newTechnicalSkills)) {
//             JobTechnicalSkills::insert($newTechnicalSkills);
//         }
//         if (!empty($jobFamilySkillMappings)) {
//             DepartmentTechnicalSkills::insert($jobFamilySkillMappings);
//         }
//     });
// }

private function handleTechnicalSkills($jobId, $technicalSkills, $jobFamilyId = null)
{
    // dd($technicalSkills);
    DB::transaction(function () use ($jobId, $technicalSkills, $jobFamilyId) {

        // Remove existing mappings for this job (skills stay)
        JobTechnicalSkills::where('job_id', $jobId)->delete();

        $newTechnicalSkills     = [];
        $jobFamilySkillMappings = [];

        // helpers
         $cleanShortName = function (?string $name, $sectorName = null, $categoryName = null): string {
            $name = trim((string)$name);

            if ($sectorName && $categoryName) {
                // Build regex pattern for "(Sector - Category)" suffix
                $pattern = '/\s*\('
                    . preg_quote(trim($sectorName), '/')
                    . '\s*-\s*'
                    . preg_quote(trim($categoryName), '/')
                    . '\)\s*$/i';
                $name = preg_replace($pattern, '', $name);
            } else {
                // fallback: remove generic "(...-...)" tail
                $name = preg_replace('/\s*\((?=[^()]*-)[^()]*\)\s*$/u', '', $name);
            }

            // Collapse multiple spaces
            $name = preg_replace('/\s+/u', ' ', $name);
            return trim($name);
        };

        foreach ((array)$technicalSkills as $skillData) {
            if (empty($skillData['name'])) { continue; }

            // ---- preferred level must have description ----
            $preferredLevel = $skillData['preferred_level'] ?? null;
            if ($preferredLevel) {
                $k = "level_{$preferredLevel}_description";
                if (empty($skillData[$k])) {
                    Log::info("Skipping skill due to missing '{$k}'.", $skillData);
                    continue;
                }
            }

            // ---- resolve sector & category ids (case-insensitive) ----
            $sectorId = $skillData['sector_id'] ?? null;
            if (!empty($skillData['sector_name'])) {
                $secName  = trim($skillData['sector_name']);
                $sectorId = Sector::whereRaw('LOWER(name) = ?', [mb_strtolower($secName)])->value('id');
            }
            $skillData['sector_id'] = $sectorId;

            $categoryId = $skillData['category_id'] ?? null;
            if (!empty($skillData['category_name'])) {
                $catName    = trim($skillData['category_name']);
                $categoryId = TechnicalSkillCategory::whereRaw('LOWER(title) = ?', [mb_strtolower($catName)])
                    ->when($sectorId, fn($q) => $q->where('sector_id', $sectorId))
                    ->value('id');
            }
            $categoryId = $categoryId ?: null;
            $skillData['category_id'] = $categoryId;

            // ---- normalised names ----
            $fullName   = trim($skillData['name']);
            // $shortName  = $cleanShortName($fullName);
            $shortName  = $cleanShortName($fullName, $skillData['sector_name'] ?? null, $skillData['category_name'] ?? null);
            $shortLower = mb_strtolower($shortName);
            $code       = $skillData['code'] ?? null;

            // ---- intent flags (per-row) ----
            $isCustom = (int)($skillData['is_custom'] ?? 0);                       // 0=master, 1/2=company buckets
            $isModify = (int)($skillData['is_modify'] ?? 0) === 1;                 // overwrite existing company
            $isNew    = (int)($skillData['is_new'] ?? 0) === 1;                    // convert master → company (legacy)
            $isNewDup = (int)($skillData['is_new_company_skill'] ?? 0) === 1;      // create duplicate company
            $skillId  = $skillData['skill_id'] ?? null;

            // ---- finders (robust) ----
            $findMaster = function() use ($skillId,$code,$shortName,$shortLower,$categoryId,$sectorId) {
                
                // 2) by code (unique)
                if (!empty($code)) {
                    $row = MasterTechnicalSkill::where('is_custom', 0)->where('code', $code)->first();
                    if ($row) return $row;
                }

                // 3) exact clean name + category
                $q = MasterTechnicalSkill::query()
                    ->where('is_custom', 0)
                    ->whereRaw('LOWER(name) = ?', [$shortLower])
               ->where('category_id', $categoryId)
               ->where('sector_id', $sectorId);
                $row = $q->first();
                if ($row) return $row;
            };

            $findCompany = function() use ($skillId,$shortLower,$categoryId) {
                if (!empty($skillId)) {
                    $row = MasterTechnicalSkill::find($skillId);
                    if ($row && (int)$row->is_custom !== 0) return $row;
                }
                return MasterTechnicalSkill::query()
                    ->whereIn('is_custom', [1,2])
                    ->whereRaw('LOWER(name) = ?', [$shortLower])
                    ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
                    ->first();
            };

            // try to locate its master for lineage
            $sourceMaster   = $findMaster();
            $sourceMasterId = $sourceMaster?->id;

            // ❗ lineage suppression: company edit/duplicate flows
            $suppressLineage = ($isCustom !== 0) && ($isModify || $isNewDup);

            $targetSkill      = null; // MasterTechnicalSkill model (master/company)
            $shouldSaveTarget = false;
            $explicitModify   = false;

            // ─────────────────────────────────────────────────────────────────
            // COMPANY FLOWS FIRST (is_custom in [1,2]) — explicit rules you asked for
            // ─────────────────────────────────────────────────────────────────
            if ($isCustom === 1 || $isCustom === 2) {

                // A) Create a new COMPANY skill (duplicate/new company copy)
                if ($isNewDup) {
                    $targetSkill            = new MasterTechnicalSkill();
                    $targetSkill->type      = 1;
                    $targetSkill->is_custom = $isCustom; // preserve incoming bucket (1 or 2)
                    $shouldSaveTarget       = true;

                    if ($sourceMasterId && !$suppressLineage) {
                        $targetSkill->master_technical_skill_id = $sourceMasterId;
                    }
                }

                // B) Modify/overwrite an existing COMPANY skill (by id)
                elseif ($isModify) {
                    if (empty($skillId)) {
                        Log::info("Overwrite requested but missing skill_id for '{$shortName}'.", $skillData);
                        continue;
                    }
                    $existing = MasterTechnicalSkill::find($skillId);
                    if (!$existing || (int)$existing->is_custom === 0) {
                        Log::info("Overwrite: invalid company id for '{$shortName}'.", $skillData);
                        continue;
                    }

                    $targetSkill      = $existing;
                    $explicitModify   = true;
                    $shouldSaveTarget = true;

                    if ($sourceMasterId && !$suppressLineage) {
                        $targetSkill->master_technical_skill_id = $sourceMasterId;
                    }
                }

                // C) Reuse an existing COMPANY skill (no new/modify flags)
                else {
                    $existingCompany = $findCompany();
                    if (!$existingCompany) {
                        Log::info("Reuse-company: not found '{$shortName}', skipping.", $skillData);
                        continue;
                    }
                    $targetSkill = $existingCompany;

                    // ensure lineage if missing
                    if (empty($targetSkill->master_technical_skill_id) && $sourceMasterId && !$suppressLineage) {
                        $targetSkill->master_technical_skill_id = $sourceMasterId;
                        $targetSkill->save();
                    }
                }
            }

            // ─────────────────────────────────────────────────────────────────
            // MASTER FLOWS (is_custom == 0) — UNCHANGED from your original logic
            // ─────────────────────────────────────────────────────────────────
            else {
                // 1) Master-only link
                if ($isCustom === 0 && !$isNew && !$isNewDup && !$isModify) {
                    $targetSkill = $sourceMaster;
                    if (!$targetSkill) {
                        // create MASTER only if nothing matched
                        $targetSkill            = new MasterTechnicalSkill();
                        $targetSkill->type      = 1;
                        $targetSkill->is_custom = 0;
                        $shouldSaveTarget       = true;
                        Log::info("Master-only: master not found, creating new master '{$shortName}'.", $skillData);
                    }
                }
                // 2) Convert MASTER → COMPANY (first time, reuse if present)
                // elseif ($isCustom === 0 && $isNew) {
                //     $existingCompany = $findCompany();
                //     if ($existingCompany && !$isNewDup) {
                //         $targetSkill = $existingCompany;
                //         if (empty($targetSkill->master_technical_skill_id) && $sourceMasterId && !$suppressLineage) {
                //             $targetSkill->master_technical_skill_id = $sourceMasterId;
                //             $targetSkill->save();
                //         }
                //     } else {
                //         $targetSkill            = new MasterTechnicalSkill();
                //         $targetSkill->type      = 1;
                //         $targetSkill->is_custom = 1; // default company bucket
                //         $shouldSaveTarget       = true;
                //         if ($sourceMasterId && !$suppressLineage) {
                //             $targetSkill->master_technical_skill_id = $sourceMasterId;
                //         }
                //     }
                // }
                elseif ($isCustom === 0 && $isNew) {
                    // ignore any existing company skill; always create a fresh one
                    $targetSkill            = new MasterTechnicalSkill();
                    $targetSkill->type      = 1;
                    $targetSkill->is_custom = 1; // put it in company bucket 1 (change to 2 if you need the other bucket)
                    $shouldSaveTarget       = true;

                    // keep lineage to the source master (since this is a master→company copy)
                    if ($sourceMasterId) {
                        $targetSkill->master_technical_skill_id = $sourceMasterId;
                    }
                }
                else {
                    Log::info("No intent matched for '{$shortName}', skipping.", $skillData);
                    continue;
                }
            }

            // ─── populate (create/overwrite/master-autocreate) ─────────────────
            if ($shouldSaveTarget) {
                $targetSkill->sector_id       = $skillData['sector_id'] ?? null;
                $targetSkill->sector_name     = $skillData['sector_name'] ?? '';
                $targetSkill->sub_sector_id   = $skillData['sub_sector_id'] ?? null;
                $targetSkill->sub_sector_name = $skillData['sub_sector_name'] ?? '';
                $targetSkill->code            = $skillData['code'] ?? '';
                $targetSkill->name            = $shortName;
                $targetSkill->description     = $skillData['description'] ?? '';
                $targetSkill->category_id     = $categoryId;
                $targetSkill->is_overwrite    = $explicitModify ? 1 : 0;

                if ((int)$targetSkill->is_custom !== 0 && $sourceMasterId && !$suppressLineage) {
                    $targetSkill->master_technical_skill_id = $sourceMasterId;
                }

                for ($i = 1; $i <= 6; $i++) {
                    $descKey = "level_{$i}_description";
                    $knowKey = "level_{$i}_knowledge";
                    $abilKey = "level_{$i}_ability";

                    $targetSkill->{$descKey} = $skillData[$descKey] ?? '';

                    $levelKnowledge = $skillData[$knowKey] ?? [];
                    $levelAbility   = $skillData[$abilKey] ?? [];

                    $targetSkill->{$knowKey} = is_array($levelKnowledge) ? implode('; ', $levelKnowledge) : $levelKnowledge;
                    $targetSkill->{$abilKey} = is_array($levelAbility)   ? implode('; ', $levelAbility)   : $levelAbility;
                }

                $targetSkill->save();
            } else {
                // tiny syncs on reuse
                $touched = false;
                if (empty($targetSkill->category_id) && $categoryId) {
                    $targetSkill->category_id = $categoryId; $touched = true;
                }
                if (mb_strtolower(trim($targetSkill->name)) !== $shortLower) {
                    $targetSkill->name = $shortName; $touched = true;
                }
                if ($touched) { $targetSkill->save(); }
            }

            // ---- job → skill mapping ----
            $newTechnicalSkills[] = [
                'job_id'                    => $jobId,
                'master_technical_skill_id' => $targetSkill->id,
                'level'                     => $skillData['preferred_level'] ?? null,
                'created_at'                => Carbon::now(),
                'updated_at'                => Carbon::now(),
            ];

            // ---- department mapping (idempotent) ----
            if ($jobFamilyId) {
                $exists = DepartmentTechnicalSkills::where('master_technical_skill_id', $targetSkill->id)
                    ->where('department_id', $jobFamilyId)
                    ->exists();

                if (!$exists) {
                    $jobFamilySkillMappings[] = [
                        'master_technical_skill_id' => $targetSkill->id,
                        'department_id'             => $jobFamilyId,
                        'created_at'                => Carbon::now(),
                        'updated_at'                => Carbon::now(),
                    ];
                }
            }
        }

        // ---- overwrite cleanup (your step 10) ----
        foreach ((array)$technicalSkills as $skillData) {
            if ((int)($skillData['is_modify'] ?? 0) === 1) {
                for ($i = 1; $i <= 6; $i++) {
                    $k = "level_{$i}_description";
                    Log::info("Checking level {$i} for skill: {$skillData['name']}");
                    if (!array_key_exists($k, $skillData) || empty($skillData[$k])) {
                        Log::info("Deleting all records for level {$i} where skill_id = {$skillData['skill_id']}");
                        JobTechnicalSkills::where('master_technical_skill_id', $skillData['skill_id'])
                            ->where('level', $i)
                            ->delete();
                        break;
                    }
                }
            }
        }

        // ---- bulk inserts ----
        if (!empty($newTechnicalSkills)) {
            JobTechnicalSkills::insert($newTechnicalSkills);
        }
        if (!empty($jobFamilySkillMappings)) {
            DepartmentTechnicalSkills::insert($jobFamilySkillMappings);
        }
    });
}




    private function handleJobFunctions($jobId, $functions)
    {
        // dd($functions);
        $jobCriticalFunctions = [];
        $cwfFunctions = [];
        $currentTime = Carbon::now();
    
        // Inserting Critical Functions
        foreach ($functions as $functionData) {
            $jobCriticalFunctions[] = [
                'job_id' => $jobId,
                'description' => $functionData['title'] ?? $functionData['cwf_description'] ?? '', // Correct mapping to 'title'
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ];
        }
    
        JobCriticalFunction::insert($jobCriticalFunctions);
    
        // Fetching inserted critical function IDs
        $insertedCriticalFunctions = JobCriticalFunction::where('job_id', $jobId)
            ->orderBy('id')
            ->pluck('id')
            ->toArray();
    
    

        foreach ($functions as $index => $functionData) {
            // Check if 'cwf_keys' exists and contains 'keytasks'
            if (isset($functionData['cwf_keys']['keytasks']) && is_array($functionData['cwf_keys']['keytasks'])) {
                // Loop through keytasks inside cwf_keys
                foreach ($functionData['cwf_keys']['keytasks'] as $keyTask) {
                    $cwfFunctions[] = [
                        'cwf_id' => $insertedCriticalFunctions[$index] ?? null, // Safe mapping with null fallback
                        'name' => $keyTask,
                        'created_at' => $currentTime,
                        'updated_at' => $currentTime,
                    ];
                }
            }
            // Check if 'tasks' exists and is an array (for the second type of data)
            elseif (isset($functionData['tasks']) && is_array($functionData['tasks'])) {
                // Loop through tasks directly
                foreach ($functionData['tasks'] as $keyTask) {
                    $cwfFunctions[] = [
                        'cwf_id' => $insertedCriticalFunctions[$index] ?? null, // Safe mapping with null fallback
                        'name' => $keyTask,
                        'created_at' => $currentTime,
                        'updated_at' => $currentTime,
                    ];
                }
            }
        }
        
    
        // Inserting Key Tasks
        if (!empty($cwfFunctions)) {
            CwfFunction::insert($cwfFunctions);
        }
    }


    private function handleSubordinates($jobId, $subordinates)
    {
        $jobSubordinates = array_map(function ($subordinateId) use ($jobId) {
            return ['job_id' => $jobId, 
                    'subordinate_id' => $subordinateId,
                    'created_at' => Carbon::now(), // Set current timestamp
                    'updated_at' => Carbon::now(), // Set current timestamp
                ];
        }, $subordinates);
        JobSubordinate::insert($jobSubordinates);
    }

    private function handlePerformanceExpectations($jobId, $expectations)
    {
        $performanceExpectations = array_map(function ($title) use ($jobId) {
            return ['job_id' => $jobId, 
                    'title' => $title,
                    'created_at' => Carbon::now(), 
                    'updated_at' => Carbon::now(), 
                    ];
        }, $expectations);
        JobPerformanceExpectation::insert($performanceExpectations);
    }

    // private function handleSecondaryScopeOfStudy($jobId, $scopes)
    // {
    //     $secondaryScopes = array_map(function ($title) use ($jobId) {
    //         return ['job_id' => $jobId, 'title' => $title];
    //     }, $scopes);
    //     JobSecondaryScopeOfStudy::insert($secondaryScopes);
    // }

    private function handleSecondaryScopeOfStudy($jobId, $scopes)
    {
        try {
            // Decode the JSON string to an array
        if ($scopes != null) {
            $decodedScopes = json_decode($scopes, true);
    
        $decodedScopes = json_decode($scopes, true);

        // Optional: check if decoding failed
        if (!is_array($decodedScopes)) {
            return; // or throw an error/log it
        }

        // Map to the insert format
        $secondaryScopes = array_map(function ($item) use ($jobId) {
            return [
                'job_id' => $jobId,
                'title' => $item['value'] ?? null,
            ];
        }, $decodedScopes);

        // Insert into the database
        JobSecondaryScopeOfStudy::insert($secondaryScopes);
        }
        } catch (\Throwable $th) {
            //throw $th;
        }
    
    }


    private function handleHeadCounts($jobId1, $headcounts,$departmentId)
    {
        if (!empty($headcounts) && is_array($headcounts)) {

            $batch = [];
            foreach ($headcounts ?? [] as $hc) {
                // e.g. ["CEO01","4890","01"]
                [$prefix, $jobId, $seq] = explode('-', $hc['id']);

                $parentId = null;
                if (!empty($hc['superior'])) {
                    // use service to look up by code
                    $parent = $this->hcService->findByCode($hc['superior']);
                    $parentId = $parent?->id;
                }
                

                $batch[] = [
                    'id'    => $hc['id'],
                    'job_id'            => (int)$jobId1,
                    'headcount_code'    => $hc['id'],
                    'parent_id'         => $parentId,
                    'department_id'     => $departmentId,
                    'headcount_number'  => (int)$seq,
                    'orgMetadata' => [
                                    'action' => 'add_position',
                                    'reason' => "",
                                    'node' => ['data'=>['code'=>$hc['id']]],
                                    'source'=>"Job Management",
                    ]
                    
                ];
            }

            // 2) Delegate creation to the module’s service
            if (! empty($batch)) {
                $this->hcService->updateBatch($batch, $jobId1);
            }
        }
    }

    private function handleTopPosition($data, $job){

        $is_top = 0;
        if (isset($data['is_top']) && $data['is_top'] && $data['is_top'] == 'on') {
            $is_top = 1;
        }
        if ($is_top == 1) {

            $job->is_top = $is_top; 

            $existingTop = Job::where('is_top', 1)->where('id', '!=', $job->id)->first();

            if ($existingTop) {
                    $existingTop->is_top = 0;
                    $existingTop->save();
                    // This will handle the demotion + headcount re-assignments
                    $this->hcService->replaceTopPosition($existingTop, $job);
            }
            $job->save();
        }

    }

    private function handleHcCodes($requestData)
    {
        // Step 2: Decode JSON input
        $hcCodes = json_decode($requestData['hc_codes'], true);

        if ($hcCodes != null && count($hcCodes) > 0) {
            // Step 4: Clean the array
            $hcCodes = array_filter($hcCodes, function ($code) {
                return is_string($code) && !empty(trim($code));
            });

            // Step 5: Remove duplicates
            $hcCodes = array_unique($hcCodes);

            // Step 6: Delete matching records where user_id is NULL
            $deletedCount = JobHeadcount::whereNull('user_id')
                ->whereIn('headcount_code', $hcCodes)
                ->delete();
        }
        
    }
}
