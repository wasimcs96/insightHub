<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Job\JobHeadcountRevertService;

class RevertJobHeadcounts extends Command
{
    protected $signature = 'jobs:revert-split 
                            {--analyze : Only analyze without making changes}
                            {--jobs=* : Specific job IDs to revert}
                            {--delete-only : Delete jobs without reverting headcounts (dangerous)}';
    
    protected $description = 'Revert split jobs and restore headcounts to original jobs';

    protected $revertService;

    public function __construct(JobHeadcountRevertService $revertService)
    {
        parent::__construct();
        $this->revertService = $revertService;
    }

    public function handle()
    {
        // Analyze mode
        if ($this->option('analyze')) {
            $this->info('Analyzing split jobs that can be reverted...');
            $analysis = $this->revertService->analyzeSplitJobsForDeletion();

            if (empty($analysis)) {
                $this->info('No split jobs found.');
                return 0;
            }

            $this->info(count($analysis) . ' job group(s) found:');
            $this->line('');

            foreach ($analysis as $item) {
                $this->warn("Base Title: {$item['base_title']}");
                $this->line("  Original Job: {$item['original_job_title']} (ID: {$item['original_job_id']})");
                $this->line("  Split Jobs: {$item['split_jobs_count']}");
                
                foreach ($item['split_jobs'] as $splitJob) {
                    $this->line("    - {$splitJob['job_title']} (ID: {$splitJob['job_id']})");
                    $this->line("      Headcounts: {$splitJob['headcount_count']}");
                    $this->line("      Skills: {$splitJob['skills_count']}");
                    $this->line("      Technical Skills: {$splitJob['tech_skills_count']}");
                    $this->line("      Functions: {$splitJob['functions_count']}");
                }
                $this->line('');
            }

            return 0;
        }

        // Specific jobs mode
        if ($jobIds = $this->option('jobs')) {
            if ($this->option('delete-only')) {
                $this->warn('WARNING: You are about to DELETE jobs and their headcounts permanently!');
                if (!$this->confirm('Are you sure you want to continue?')) {
                    $this->info('Operation cancelled.');
                    return 0;
                }

                $this->info('Deleting specific jobs...');
                $result = $this->revertService->deleteSplitJobsOnly($jobIds);
            } else {
                $this->info('Reverting specific jobs...');
                $result = $this->revertService->revertSpecificJobs($jobIds);
            }
        } 
        // Revert all split jobs
        else {
            $this->warn('This will revert ALL split jobs and restore headcounts to original jobs.');
            if (!$this->confirm('Are you sure you want to continue?')) {
                $this->info('Operation cancelled.');
                return 0;
            }

            $this->info('Starting revert process...');
            $result = $this->revertService->revertAllSplitJobs();
        }

        if ($result['success']) {
            $this->info($result['message']);
            
            if (!empty($result['deleted_jobs'])) {
                $this->line('');
                $this->info('Deleted Jobs:');
                foreach ($result['deleted_jobs'] as $deleted) {
                    $headcountKey = isset($deleted['headcounts_moved']) ? 'headcounts_moved' : 'headcounts_deleted';
                    $this->line("  - {$deleted['job_title']} (ID: {$deleted['job_id']}) - {$deleted[$headcountKey]} headcount(s)");
                }
            }
        } else {
            $this->error('Revert operation failed.');
        }

        return 0;
    }
}