<?php

namespace App\Services\Job;

use App\Models\Job;
use App\Models\JobHeadcount;
use App\Models\JobSkill;
use App\Models\JobTechnicalSkills;
use App\Models\JobCriticalFunction;
use App\Models\CwfFunction;
use App\Models\JobSubordinate;
use App\Models\JobPerformanceExpectation;
use App\Models\JobSecondaryScopeOfStudy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class JobHeadcountSplitService
{
    protected $jdJobService;

    public function __construct(JdJobService $jdJobService)
    {
        $this->jdJobService = $jdJobService;
    }

    /**
     * Find job_ids that have headcounts with multiple different parent job_ids
     * Returns: ['job_id' => ['parent_job_id_1', 'parent_job_id_2', ...]]
     */
    public function findJobsNeedingSplit()
    {
        $query = DB::table('job_headcounts as jh')
            ->join('job_headcounts as parent_jh', 'jh.parent_id', '=', 'parent_jh.id')
            ->whereNull('jh.deleted_at')
            ->whereNull('parent_jh.deleted_at')
            ->select(
                'jh.job_id',
                DB::raw('GROUP_CONCAT(DISTINCT parent_jh.job_id ORDER BY parent_jh.job_id) as parent_job_ids'),
                DB::raw('COUNT(DISTINCT parent_jh.job_id) as parent_count')
            )
            ->groupBy('jh.job_id')
            ->having('parent_count', '>', 1);

        $results = $query->get();

        $jobsNeedingSplit = [];
        foreach ($results as $row) {
            $jobsNeedingSplit[$row->job_id] = array_map('intval', explode(',', $row->parent_job_ids));
        }

        return $jobsNeedingSplit;
    }

    /**
     * Split jobs that have headcounts with different parent job_ids
     */
    public function splitJobsWithMultipleParents()
    {
        $jobsNeedingSplit = $this->findJobsNeedingSplit();

        if (empty($jobsNeedingSplit)) {
            Log::info("No jobs need splitting.");
            return ['success' => true, 'message' => 'No jobs need splitting.', 'processed' => 0];
        }

        DB::beginTransaction();
        try {
            $processedCount = 0;
            $createdJobs = [];
            $totalNewJobsCreated = 0;
            $totalUsersUpdated = 0;

            foreach ($jobsNeedingSplit as $originalJobId => $parentJobIds) {
                $parentCount = count($parentJobIds);
                $newJobsNeeded = $parentCount - 1; // -1 because we keep the original
                
                Log::info("Processing Job ID: {$originalJobId} with {$parentCount} different parent job IDs");
                Log::info("Will create {$newJobsNeeded} new job(s)");

                // Get the original job
                $originalJob = Job::find($originalJobId);

                if (!$originalJob) {
                    Log::error("Job {$originalJobId} not found.");
                    continue;
                }

                // Get all headcounts for this job grouped by parent_job_id
                $headcountsByParent = $this->getHeadcountsGroupedByParentJobId($originalJobId);

                // Sort parent job IDs to ensure consistent processing
                sort($parentJobIds);

                // Keep the original job for the first parent
                $firstParentJobId = $parentJobIds[0];
                $parentToJobMapping = [$firstParentJobId => $originalJobId];

                Log::info("Original job {$originalJobId} will be kept for parent job ID {$firstParentJobId}");

                // Create new jobs for remaining parents (starting from index 1)
                for ($i = 1; $i < count($parentJobIds); $i++) {
                    $parentJobId = $parentJobIds[$i];
                    
                    // Create a replica of the original job with proper naming
                    $newJob = $this->replicateJob($originalJob, $i + 1); // i+1 gives us II, III, etc.
                    
                    if ($newJob) {
                        $parentToJobMapping[$parentJobId] = $newJob->id;
                        $createdJobs[] = [
                            'original_job_id' => $originalJobId,
                            'original_job_title' => $originalJob->title,
                            'new_job_id' => $newJob->id,
                            'new_job_title' => $newJob->title,
                            'new_position_code' => $newJob->position_code,
                            'parent_job_id' => $parentJobId
                        ];
                        $totalNewJobsCreated++;
                        Log::info("Created new Job ID: {$newJob->id} ('{$newJob->title}') with position code '{$newJob->position_code}' for parent job ID {$parentJobId}");
                    }
                }

                // Update job_headcounts to use the correct job_id based on their parent's job_id
                foreach ($headcountsByParent as $parentJobId => $headcounts) {
                    $targetJobId = $parentToJobMapping[$parentJobId] ?? null;
                    
                    if (!$targetJobId) {
                        Log::warning("No job mapping found for parent job ID {$parentJobId}");
                        continue;
                    }

                    $targetJob = Job::find($targetJobId);
                    if (!$targetJob) {
                        Log::warning("Target job {$targetJobId} not found");
                        continue;
                    }

                    // Update headcounts and regenerate headcount codes
                    foreach ($headcounts as $index => $headcount) {
                        $headcountNumber = $index + 1;
                        $newHeadcountCode = $this->generateHeadcountCode(
                            $targetJob->position_code,
                            $targetJobId,
                            $headcountNumber
                        );

                        JobHeadcount::where('id', $headcount->id)
                            ->update([
                                'job_id' => $targetJobId,
                                'headcount_code' => $newHeadcountCode,
                                'headcount_number' => $headcountNumber,
                                'updated_at' => now()
                            ]);
                        
                        Log::info("Updated headcount ID: {$headcount->id} (old code: {$headcount->headcount_code}, new code: {$newHeadcountCode}) to use Job ID: {$targetJobId}");

                        // Update users' position_id who are assigned to this headcount
                        $updatedUsers = DB::table('users')
                            ->where('headcount_id', $headcount->id)
                            ->whereNull('deleted_at')
                            ->update([
                                'position_id' => $targetJobId,
                                'updated_at' => now()
                            ]);
                        
                        if ($updatedUsers > 0) {
                            $totalUsersUpdated += $updatedUsers;
                            Log::info("Updated {$updatedUsers} user(s) position_id to {$targetJobId} for headcount ID: {$headcount->id}");
                        }
                    }
                }

                $processedCount++;
            }

            DB::commit();
            
            return [
                'success' => true,
                'message' => "Successfully processed {$processedCount} job group(s), created {$totalNewJobsCreated} new job(s), and updated {$totalUsersUpdated} user(s).",
                'processed' => $processedCount,
                'total_new_jobs_created' => $totalNewJobsCreated,
                'total_users_updated' => $totalUsersUpdated,
                'created_jobs' => $createdJobs
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error splitting jobs: " . $e->getMessage());
            Log::error($e->getTraceAsString());
            throw $e;
        }
    }

    /**
     * Get headcounts grouped by their parent's job_id
     */
    protected function getHeadcountsGroupedByParentJobId($jobId)
    {
        $headcounts = DB::table('job_headcounts as jh')
            ->join('job_headcounts as parent_jh', 'jh.parent_id', '=', 'parent_jh.id')
            ->where('jh.job_id', $jobId)
            ->whereNull('jh.deleted_at')
            ->whereNull('parent_jh.deleted_at')
            ->select('jh.*', 'parent_jh.job_id as parent_job_id')
            ->orderBy('parent_jh.job_id')
            ->orderBy('jh.id')
            ->get();

        $grouped = [];
        foreach ($headcounts as $hc) {
            $parentJobId = $hc->parent_job_id;
            if (!isset($grouped[$parentJobId])) {
                $grouped[$parentJobId] = [];
            }
            $grouped[$parentJobId][] = $hc;
        }

        return $grouped;
    }

    /**
     * Generate unique position code in format: MF24A1W
     */
    protected function generateUniquePositionCode()
    {
        do {
            // Generate 7 character alphanumeric code
            $code = strtoupper(Str::random(7));
            // Ensure it has a good mix of letters and numbers
            if (preg_match('/[A-Z]/', $code) && preg_match('/[0-9]/', $code)) {
                $exists = Job::where('position_code', $code)->exists();
            } else {
                $exists = true; // Regenerate if doesn't have both letters and numbers
            }
        } while ($exists);

        return $code;
    }

    /**
     * Generate headcount code in format: MF24A1W-4749-01
     */
    protected function generateHeadcountCode($positionCode, $jobId, $headcountNumber)
    {
        return sprintf('%s-%d-%02d', $positionCode, $jobId, $headcountNumber);
    }

    /**
     * Replicate a job with all its relationships
     */
    protected function replicateJob(Job $originalJob, int $suffix)
    {
        $romanNumeral = $this->convertToRoman($suffix);
        
        // Generate new unique position code
        $newPositionCode = $this->generateUniquePositionCode();
        
        // Create new job with modified title and new position code
        $newJob = $originalJob->replicate();
        $newJob->title = $originalJob->title . ' - ' . $romanNumeral;
        $newJob->position_code = $newPositionCode;
        $newJob->code = $newPositionCode; // Keep code same as position_code
        $newJob->created_at = now();
        $newJob->updated_at = now();
        $newJob->save();

        Log::info("Created new job {$newJob->id} as replica of {$originalJob->id} with position code {$newPositionCode}");

        // Replicate job skills
        $this->replicateJobSkills($originalJob->id, $newJob->id);

        // Replicate technical skills
        $this->replicateJobTechnicalSkills($originalJob->id, $newJob->id);

        // Replicate critical functions with CWF functions
        $this->replicateCriticalFunctions($originalJob->id, $newJob->id);

        // Replicate subordinates
        $this->replicateSubordinates($originalJob->id, $newJob->id);

        // Replicate performance expectations
        $this->replicatePerformanceExpectations($originalJob->id, $newJob->id);

        // Replicate secondary scope of studies
        $this->replicateSecondaryScopeOfStudies($originalJob->id, $newJob->id);

        Log::info("Successfully replicated all relationships for job {$newJob->id}");

        return $newJob;
    }

    /**
     * Replicate job skills
     */
    protected function replicateJobSkills($originalJobId, $newJobId)
    {
        $skills = JobSkill::where('job_id', $originalJobId)->get();
        
        foreach ($skills as $skill) {
            JobSkill::create([
                'job_id' => $newJobId,
                'title' => $skill->title,
                'level' => $skill->level,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        Log::info("Replicated " . count($skills) . " job skills");
    }

    /**
     * Replicate job technical skills
     */
    protected function replicateJobTechnicalSkills($originalJobId, $newJobId)
    {
        $techSkills = JobTechnicalSkills::where('job_id', $originalJobId)->get();
        
        foreach ($techSkills as $techSkill) {
            JobTechnicalSkills::create([
                'job_id' => $newJobId,
                'master_technical_skill_id' => $techSkill->master_technical_skill_id,
                'level' => $techSkill->level,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        Log::info("Replicated " . count($techSkills) . " technical skills");
    }

    /**
     * Replicate critical functions with CWF functions
     */
    protected function replicateCriticalFunctions($originalJobId, $newJobId)
    {
        $criticalFunctions = JobCriticalFunction::where('job_id', $originalJobId)->get();
        
        foreach ($criticalFunctions as $criticalFunction) {
            // Create new critical function
            $newCriticalFunction = JobCriticalFunction::create([
                'job_id' => $newJobId,
                'description' => $criticalFunction->description,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Replicate associated CWF functions
            $cwfFunctions = CwfFunction::where('cwf_id', $criticalFunction->id)->get();
            
            foreach ($cwfFunctions as $cwfFunction) {
                CwfFunction::create([
                    'cwf_id' => $newCriticalFunction->id,
                    'name' => $cwfFunction->name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        
        Log::info("Replicated " . count($criticalFunctions) . " critical functions");
    }

    /**
     * Replicate subordinates
     */
    protected function replicateSubordinates($originalJobId, $newJobId)
    {
        $subordinates = JobSubordinate::where('job_id', $originalJobId)->get();
        
        foreach ($subordinates as $subordinate) {
            JobSubordinate::create([
                'job_id' => $newJobId,
                'subordinate_id' => $subordinate->subordinate_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        Log::info("Replicated " . count($subordinates) . " subordinates");
    }

    /**
     * Replicate performance expectations
     */
    protected function replicatePerformanceExpectations($originalJobId, $newJobId)
    {
        $expectations = JobPerformanceExpectation::where('job_id', $originalJobId)->get();
        
        foreach ($expectations as $expectation) {
            JobPerformanceExpectation::create([
                'job_id' => $newJobId,
                'title' => $expectation->title,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        Log::info("Replicated " . count($expectations) . " performance expectations");
    }

    /**
     * Replicate secondary scope of studies
     */
    protected function replicateSecondaryScopeOfStudies($originalJobId, $newJobId)
    {
        $scopes = JobSecondaryScopeOfStudy::where('job_id', $originalJobId)->get();
        
        foreach ($scopes as $scope) {
            JobSecondaryScopeOfStudy::create([
                'job_id' => $newJobId,
                'title' => $scope->title,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        Log::info("Replicated " . count($scopes) . " secondary scope of studies");
    }

    /**
     * Convert number to Roman numeral
     */
    protected function convertToRoman($num)
    {
        $map = [
            'I', 'II', 'III', 'IV', 'V', 
            'VI', 'VII', 'VIII', 'IX', 'X',
            'XI', 'XII', 'XIII', 'XIV', 'XV',
            'XVI', 'XVII', 'XVIII', 'XIX', 'XX'
        ];
        return isset($map[$num - 1]) ? $map[$num - 1] : (string)$num;
    }

    /**
     * Analyze jobs before splitting (for preview/reporting)
     */
    public function analyzeJobsNeedingSplit()
    {
        $jobsNeedingSplit = $this->findJobsNeedingSplit();
        $analysis = [];
        $totalNewJobsToCreate = 0;

        foreach ($jobsNeedingSplit as $jobId => $parentJobIds) {
            $job = Job::find($jobId);
            if (!$job) continue;

            $headcountsByParent = $this->getHeadcountsGroupedByParentJobId($jobId);
            
            // Calculate how many new jobs will be created
            $parentCount = count($parentJobIds);
            $newJobsForThisGroup = $parentCount - 1; // -1 because we keep the original
            $totalNewJobsToCreate += $newJobsForThisGroup;

            $parentDetails = [];
            foreach ($parentJobIds as $index => $parentJobId) {
                $parentJob = Job::find($parentJobId);
                $headcountCount = count($headcountsByParent[$parentJobId] ?? []);
                
                // Determine if this will be the original job or a new job
                $willBeNewJob = ($index > 0);
                $jobTitleSuffix = $willBeNewJob ? ' - ' . $this->convertToRoman($index + 1) : ' (ORIGINAL)';
                
                $parentDetails[] = [
                    'parent_job_id' => $parentJobId,
                    'parent_job_title' => $parentJob ? $parentJob->title : 'Unknown',
                    'headcount_count' => $headcountCount,
                    'will_create_new_job' => $willBeNewJob,
                    'expected_job_title' => $job->title . $jobTitleSuffix
                ];
            }

            $analysis[] = [
                'job_id' => $jobId,
                'job_title' => $job->title,
                'current_position_code' => $job->position_code,
                'parent_count' => $parentCount,
                'new_jobs_to_create' => $newJobsForThisGroup,
                'parents' => $parentDetails,
                'total_headcounts' => array_sum(array_map('count', $headcountsByParent))
            ];
        }

        return [
            'job_groups' => $analysis,
            'total_job_groups' => count($analysis),
            'total_new_jobs_to_create' => $totalNewJobsToCreate,
            'summary' => [
                'job_groups_affected' => count($analysis),
                'new_jobs_will_be_created' => $totalNewJobsToCreate,
                'original_jobs_kept' => count($analysis)
            ]
        ];
    }
}