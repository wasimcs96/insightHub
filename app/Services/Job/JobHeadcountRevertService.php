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

class JobHeadcountRevertService
{
    /**
     * Find all split jobs (jobs with Roman numerals in title)
     */
    public function findSplitJobs()
    {
        // Pattern to match jobs ending with " - I", " - II", " - III", etc.
        $splitJobs = Job::where('title', 'REGEXP', ' - (I|II|III|IV|V|VI|VII|VIII|IX|X|XI|XII|XIII|XIV|XV|XVI|XVII|XVIII|XIX|XX)$')
            ->get();

        $grouped = [];
        
        foreach ($splitJobs as $job) {
            // Extract base title (everything before " - Roman")
            $baseTitle = preg_replace('/ - (I|II|III|IV|V|VI|VII|VIII|IX|X|XI|XII|XIII|XIV|XV|XVI|XVII|XVIII|XIX|XX)$/', '', $job->title);
            
            if (!isset($grouped[$baseTitle])) {
                $grouped[$baseTitle] = [
                    'base_title' => $baseTitle,
                    'original_job' => null,
                    'split_jobs' => []
                ];
            }
            
            $grouped[$baseTitle]['split_jobs'][] = $job;
        }

        // Find the original jobs (without Roman numerals)
        foreach ($grouped as $baseTitle => &$group) {
            $originalJob = Job::where('title', $baseTitle)->first();
            $group['original_job'] = $originalJob;
        }

        return $grouped;
    }

    /**
     * Revert all split jobs and restore headcounts to original job
     */
    public function revertAllSplitJobs()
    {
        $splitJobGroups = $this->findSplitJobs();

        if (empty($splitJobGroups)) {
            Log::info("No split jobs found to revert.");
            return ['success' => true, 'message' => 'No split jobs found to revert.', 'reverted' => 0];
        }

        DB::beginTransaction();
        try {
            $revertedCount = 0;
            $deletedJobs = [];

            foreach ($splitJobGroups as $baseTitle => $group) {
                $originalJob = $group['original_job'];
                $splitJobs = $group['split_jobs'];

                if (!$originalJob) {
                    Log::warning("No original job found for base title: {$baseTitle}");
                    continue;
                }

                Log::info("Reverting jobs for: {$baseTitle}");
                Log::info("Original Job ID: {$originalJob->id}");

                foreach ($splitJobs as $splitJob) {
                    Log::info("Processing split job: {$splitJob->title} (ID: {$splitJob->id})");

                    // Move all headcounts back to original job
                    $headcountsMoved = JobHeadcount::where('job_id', $splitJob->id)
                        ->update([
                            'job_id' => $originalJob->id,
                            'updated_at' => now()
                        ]);

                    Log::info("Moved {$headcountsMoved} headcount(s) from job {$splitJob->id} to {$originalJob->id}");

                    // Delete all related data for the split job
                    $this->deleteSplitJobRelationships($splitJob->id);

                    // Delete the split job itself
                    $splitJob->delete();

                    $deletedJobs[] = [
                        'job_id' => $splitJob->id,
                        'job_title' => $splitJob->title,
                        'headcounts_moved' => $headcountsMoved
                    ];

                    Log::info("Deleted split job: {$splitJob->title} (ID: {$splitJob->id})");
                }

                $revertedCount++;
            }

            DB::commit();

            return [
                'success' => true,
                'message' => "Successfully reverted {$revertedCount} job group(s).",
                'reverted' => $revertedCount,
                'deleted_jobs' => $deletedJobs
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error reverting split jobs: " . $e->getMessage());
            Log::error($e->getTraceAsString());
            throw $e;
        }
    }

    /**
     * Revert specific jobs by their IDs
     */
    public function revertSpecificJobs(array $jobIds)
    {
        DB::beginTransaction();
        try {
            $deletedJobs = [];

            foreach ($jobIds as $jobId) {
                $job = Job::find($jobId);

                if (!$job) {
                    Log::warning("Job {$jobId} not found.");
                    continue;
                }

                // Extract base title to find original job
                $baseTitle = preg_replace('/ - (I|II|III|IV|V|VI|VII|VIII|IX|X|XI|XII|XIII|XIV|XV|XVI|XVII|XVIII|XIX|XX)$/', '', $job->title);
                $originalJob = Job::where('title', $baseTitle)->first();

                if (!$originalJob) {
                    Log::warning("No original job found for: {$job->title}");
                    continue;
                }

                Log::info("Reverting job: {$job->title} (ID: {$job->id}) to original job ID: {$originalJob->id}");

                // Move all headcounts back to original job
                $headcountsMoved = JobHeadcount::where('job_id', $job->id)
                    ->update([
                        'job_id' => $originalJob->id,
                        'updated_at' => now()
                    ]);

                Log::info("Moved {$headcountsMoved} headcount(s)");

                // Delete all related data
                $this->deleteSplitJobRelationships($job->id);

                // Delete the job
                $job->delete();

                $deletedJobs[] = [
                    'job_id' => $job->id,
                    'job_title' => $job->title,
                    'headcounts_moved' => $headcountsMoved
                ];

                Log::info("Deleted job: {$job->title} (ID: {$job->id})");
            }

            DB::commit();

            return [
                'success' => true,
                'message' => "Successfully reverted " . count($deletedJobs) . " job(s).",
                'deleted_jobs' => $deletedJobs
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error reverting specific jobs: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete all relationships for a split job
     */
    protected function deleteSplitJobRelationships($jobId)
    {
        // Delete job skills
        $skillsDeleted = JobSkill::where('job_id', $jobId)->delete();
        Log::info("Deleted {$skillsDeleted} job skill(s)");

        // Delete technical skills
        $techSkillsDeleted = JobTechnicalSkills::where('job_id', $jobId)->delete();
        Log::info("Deleted {$techSkillsDeleted} technical skill(s)");

        // Delete CWF functions first (child records)
        $criticalFunctionIds = JobCriticalFunction::where('job_id', $jobId)->pluck('id');
        $cwfDeleted = CwfFunction::whereIn('cwf_id', $criticalFunctionIds)->delete();
        Log::info("Deleted {$cwfDeleted} CWF function(s)");

        // Delete critical functions
        $criticalFunctionsDeleted = JobCriticalFunction::where('job_id', $jobId)->delete();
        Log::info("Deleted {$criticalFunctionsDeleted} critical function(s)");

        // Delete subordinates
        $subordinatesDeleted = JobSubordinate::where('job_id', $jobId)->delete();
        Log::info("Deleted {$subordinatesDeleted} subordinate(s)");

        // Delete performance expectations
        $expectationsDeleted = JobPerformanceExpectation::where('job_id', $jobId)->delete();
        Log::info("Deleted {$expectationsDeleted} performance expectation(s)");

        // Delete secondary scope of studies
        $scopesDeleted = JobSecondaryScopeOfStudy::where('job_id', $jobId)->delete();
        Log::info("Deleted {$scopesDeleted} secondary scope(s)");
    }

    /**
     * Analyze what would be deleted (dry run)
     */
    public function analyzeSplitJobsForDeletion()
    {
        $splitJobGroups = $this->findSplitJobs();
        $analysis = [];

        foreach ($splitJobGroups as $baseTitle => $group) {
            $originalJob = $group['original_job'];
            $splitJobs = $group['split_jobs'];

            $jobDetails = [];
            foreach ($splitJobs as $splitJob) {
                $headcountCount = JobHeadcount::where('job_id', $splitJob->id)->count();
                $skillsCount = JobSkill::where('job_id', $splitJob->id)->count();
                $techSkillsCount = JobTechnicalSkills::where('job_id', $splitJob->id)->count();
                $functionsCount = JobCriticalFunction::where('job_id', $splitJob->id)->count();

                $jobDetails[] = [
                    'job_id' => $splitJob->id,
                    'job_title' => $splitJob->title,
                    'headcount_count' => $headcountCount,
                    'skills_count' => $skillsCount,
                    'tech_skills_count' => $techSkillsCount,
                    'functions_count' => $functionsCount
                ];
            }

            $analysis[] = [
                'base_title' => $baseTitle,
                'original_job_id' => $originalJob ? $originalJob->id : null,
                'original_job_title' => $originalJob ? $originalJob->title : 'NOT FOUND',
                'split_jobs_count' => count($splitJobs),
                'split_jobs' => $jobDetails
            ];
        }

        return $analysis;
    }

    /**
     * Delete split jobs without reverting headcounts (dangerous - use with caution)
     */
    public function deleteSplitJobsOnly(array $jobIds)
    {
        DB::beginTransaction();
        try {
            $deletedJobs = [];

            foreach ($jobIds as $jobId) {
                $job = Job::find($jobId);

                if (!$job) {
                    Log::warning("Job {$jobId} not found.");
                    continue;
                }

                Log::info("Deleting job: {$job->title} (ID: {$job->id})");

                // First, delete or reassign headcounts
                $headcountCount = JobHeadcount::where('job_id', $job->id)->count();
                
                // Option 1: Delete headcounts (use with caution)
                JobHeadcount::where('job_id', $job->id)->delete();

                // Delete all related data
                $this->deleteSplitJobRelationships($job->id);

                // Delete the job
                $job->delete();

                $deletedJobs[] = [
                    'job_id' => $job->id,
                    'job_title' => $job->title,
                    'headcounts_deleted' => $headcountCount
                ];

                Log::info("Deleted job and {$headcountCount} headcount(s): {$job->title} (ID: {$job->id})");
            }

            DB::commit();

            return [
                'success' => true,
                'message' => "Successfully deleted " . count($deletedJobs) . " job(s) and their headcounts.",
                'deleted_jobs' => $deletedJobs
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error deleting jobs: " . $e->getMessage());
            throw $e;
        }
    }
}