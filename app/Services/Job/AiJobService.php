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
use App\Models\JobPerformanceExpectation;
use App\Models\JobSecondaryScopeOfStudy;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AiJobService
{
    

    public function createJob(array $requestData)
    {
        DB::beginTransaction();
        try {
            $job = Job::create([
                'title' => $requestData['title'],
                'status' => $requestData['status'] ?? '',
                'description' => $requestData['description'],
                'heads' => $requestData['heads'] ?? '',
                'level' => $requestData['level'] ?? '',
                'org_department' => $requestData['org_department'],
                'code' => $requestData['position_code'] ?? Job::generateUniquePositionCode(),
                'saved_job' => 1,
                'education_level' => $requestData['education_level'] ?? null,
                'scope_of_study' => $requestData['scope_of_study'] ?? null,
                'professional_certificate' => $requestData['professional_certificate'] ?? null,
                'relevant_training' => $requestData['relevant_training'] ?? null,
                'work_experience' => $requestData['work_experience'] ?? null,
                'relevant_course' => $requestData['relevant_course'] ?? null,
                'superior_id' => $requestData['superior'] ?? null,
                'sierra_id' => $requestData['superior'] ?? null,
            ]);

            $this->assignJobType($job, $requestData);
            $this->handleJobSkills($job->id, $requestData['genericSkills'] ?? []);
            $this->handleTechnicalSkills($job->id, $requestData['technicalSkills'] ?? []);
            $this->handleJobFunctions($job->id, $requestData['functions'] ?? []);
            $this->handleSubordinates($job->id, $requestData['subordinates'] ?? []);
            $this->handlePerformanceExpectations($job->id, $requestData['perfomance_expectation'] ?? []);
            $this->handleSecondaryScopeOfStudy($job->id, $requestData['secondary_scope_of_study'] ?? []);

            DB::commit();
            return $job;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    private function assignJobType(&$job, $data)
    {
        $jd_from = $data['jd_from'];
        if ($jd_from) {
            if ($jd_from == '2') {
                $job->fill([
                    'department_id' => $data['department'],
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
                $job->fill([
                    'level' => $data['level'],
                    'job_type' => 'ai_gen',
                    'top3riasec' => $data['riasec'] ?? null,
                ]);
            }
            $job->save();
        }
    }


    

    private function handleJobSkills($jobId, $skills)
{
    foreach ($skills as $skill) {
        // Check if the competency exists in MasterSkill and retrieve its ID
        $softSkill = MasterSkill::where('name', $skill['competency'])->first();

        // Convert array values into semicolon-separated strings
        $level_1_knowledge = isset($skill['level_1_knowledge']) ? implode('; ', $skill['level_1_knowledge']) : '';
        $level_1_ability = isset($skill['level_1_ability']) ? implode('; ', $skill['level_1_ability']) : '';
        $level_2_knowledge = isset($skill['level_2_knowledge']) ? implode('; ', $skill['level_2_knowledge']) : '';
        $level_2_ability = isset($skill['level_2_ability']) ? implode('; ', $skill['level_2_ability']) : '';
        $level_3_knowledge = isset($skill['level_3_knowledge']) ? implode('; ', $skill['level_3_knowledge']) : '';
        $level_3_ability = isset($skill['level_3_ability']) ? implode('; ', $skill['level_3_ability']) : '';

        // Insert data into llm_soft_skill_descriptions
        CustomSoftSkillDescription::create([
            'job_id' => $jobId,
            'soft_skill_id' => $softSkill->id ?? '', // Store the retrieved or newly created soft_skill_id
            'soft_skill_title' => $skill['competency'] ?? '',
            'description' => $skill['description'] ?? '',
            'tp_details' => $skill['preferred_level'] ?? '',
            'level_1' => $skill['level_1'] ?? '',
            'level_1_ability' => $level_1_ability,
            'level_1_knowledge' => $level_1_knowledge,
            'level_2' => $skill['level_2'] ?? '',
            'level_2_ability' => $level_2_ability,
            'level_2_knowledge' => $level_2_knowledge,
            'level_3' => $skill['level_3'] ?? '',
            'level_3_ability' => $level_3_ability,
            'level_3_knowledge' => $level_3_knowledge,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Insert into JobSkill table
        JobSkill::create([
            'job_id' => $jobId,
            'title' => $skill['competency'] ?? '',
            'level' => $skill['level'] ?? '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

   
    private function handleTechnicalSkills($jobId, $technicalSkills)
{
    // Delete existing technical skills for the job
    JobTechnicalSkills::where('job_id', $jobId)->delete();

    $newTechnicalSkills = [];

    foreach ($technicalSkills as $skillData) {
        if (!isset($skillData['name']) || empty($skillData['name'])) {
            continue; // Skip invalid data
        }

        // Insert into MasterTechnicalSkill
        $masterTechnicalSkill = new MasterTechnicalSkill();
        $masterTechnicalSkill->job_id = $jobId;
        $masterTechnicalSkill->type = 1;
        $masterTechnicalSkill->sector_id = $skillData['sector_id'] ?? null;
        $masterTechnicalSkill->sector_name = $skillData['sector_name'] ?? '';
        $masterTechnicalSkill->sub_sector_id = $skillData['sub_sector_id'] ?? null;
        $masterTechnicalSkill->sub_sector_name = $skillData['sub_sector_name'] ?? '';
        $masterTechnicalSkill->code = $skillData['code'] ?? '';
        $masterTechnicalSkill->name = $skillData['name'] ?? '';
        $masterTechnicalSkill->description = $skillData['description'] ?? '';

        // Level Descriptions, Knowledge, and Ability
        for ($i = 1; $i <= 6; $i++) {
            $masterTechnicalSkill->{'level_' . $i . '_description'} = $skillData['level_' . $i . '_description'] ?? '';

            $levelKnowledge = $skillData['level_' . $i . '_knowledge'] ?? [];
            $levelAbility = $skillData['level_' . $i . '_ability'] ?? [];

            $masterTechnicalSkill->{'level_' . $i . '_knowledge'} = is_array($levelKnowledge)
                ? implode('; ', $levelKnowledge)
                : $levelKnowledge;

            $masterTechnicalSkill->{'level_' . $i . '_ability'} = is_array($levelAbility)
                ? implode('; ', $levelAbility)
                : $levelAbility;
        }

        $masterTechnicalSkill->save();

        // Insert into JobTechnicalSkills after saving to MasterTechnicalSkill
        $newTechnicalSkills[] = [
            'job_id' => $jobId,
            'master_technical_skill_id' => $masterTechnicalSkill->id, // Use the saved ID
            'level' => $skillData['level'] ?? null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    // Bulk Insert into JobTechnicalSkills
    if (!empty($newTechnicalSkills)) {
        JobTechnicalSkills::insert($newTechnicalSkills);
    }
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

    private function handleSecondaryScopeOfStudy($jobId, $scopes)
    {
        $secondaryScopes = array_map(function ($title) use ($jobId) {
            return ['job_id' => $jobId, 'title' => $title];
        }, $scopes);
        JobSecondaryScopeOfStudy::insert($secondaryScopes);
    }
}
