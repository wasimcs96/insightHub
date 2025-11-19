<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Job\JobHeadcountSplitService;

class SplitJobHeadcounts extends Command
{
    protected $signature = 'jobs:split-headcounts {--analyze : Only analyze without making changes}';
    protected $description = 'Split jobs that have headcounts with different parent job_ids';

    protected $splitService;

    public function __construct(JobHeadcountSplitService $splitService)
    {
        parent::__construct();
        $this->splitService = $splitService;
    }

    public function handle()
    {
        if ($this->option('analyze')) {
            $this->info('Analyzing jobs that need splitting...');
            $this->line('');
            
            $analysis = $this->splitService->analyzeJobsNeedingSplit();

            if (empty($analysis['job_groups'])) {
                $this->info('✓ No jobs need splitting.');
                return 0;
            }

            // Display summary
            $this->info('═══════════════════════════════════════════════════════════');
            $this->info('                    ANALYSIS SUMMARY                        ');
            $this->info('═══════════════════════════════════════════════════════════');
            $this->line('');
            
            $this->warn('Total Job Groups Affected: ' . $analysis['summary']['job_groups_affected']);
            $this->warn('Original Jobs to Keep: ' . $analysis['summary']['original_jobs_kept']);
            $this->info('NEW JOBS TO CREATE: ' . $analysis['summary']['new_jobs_will_be_created']);
            
            $this->line('');
            $this->info('═══════════════════════════════════════════════════════════');
            $this->line('');

            // Display detailed analysis
            foreach ($analysis['job_groups'] as $index => $item) {
                $this->warn("Job Group #" . ($index + 1));
                $this->line("├─ Current Job: {$item['job_title']} (ID: {$item['job_id']})");
                $this->line("├─ Current Position Code: {$item['current_position_code']}");
                $this->line("├─ Total Headcounts: {$item['total_headcounts']}");
                $this->line("├─ Different Parent Jobs: {$item['parent_count']}");
                $this->info("└─ NEW JOBS TO CREATE: {$item['new_jobs_to_create']}");
                $this->line('');

                foreach ($item['parents'] as $pIndex => $parent) {
                    $prefix = ($pIndex === count($item['parents']) - 1) ? '   └─' : '   ├─';
                    
                    if ($parent['will_create_new_job']) {
                        $this->line("{$prefix} [NEW JOB WILL BE CREATED]");
                        $this->line("   │  ├─ Expected Title: {$parent['expected_job_title']}");
                        $this->line("   │  ├─ New Position Code: <will be generated like MF24A1W>");
                    } else {
                        $this->line("{$prefix} [ORIGINAL JOB - NO CHANGES]");
                        $this->line("   │  ├─ Title: {$parent['expected_job_title']}");
                        $this->line("   │  ├─ Position Code: {$item['current_position_code']}");
                    }
                    
                    $this->line("   │  ├─ Parent Job: {$parent['parent_job_title']} (ID: {$parent['parent_job_id']})");
                    $this->line("   │  └─ Headcounts: {$parent['headcount_count']}");
                    
                    if ($pIndex < count($item['parents']) - 1) {
                        $this->line("   │");
                    }
                }
                
                $this->line('');
                $this->line('───────────────────────────────────────────────────────────');
                $this->line('');
            }

            // Final summary
            $this->info('═══════════════════════════════════════════════════════════');
            $this->info('                    WHAT WILL HAPPEN                        ');
            $this->info('═══════════════════════════════════════════════════════════');
            $this->line('');
            $this->line("• {$analysis['summary']['original_jobs_kept']} original job(s) will be KEPT");
            $this->info("• {$analysis['summary']['new_jobs_will_be_created']} NEW job(s) will be CREATED");
            $this->line("• Each new job will get:");
            $this->line("  - Unique position code (e.g., MF24A1W)");
            $this->line("  - Title with Roman numeral suffix (e.g., ' - II', ' - III')");
            $this->line("  - All relationships from original job");
            $this->line("• Headcounts will be updated with new codes:");
            $this->line("  - Format: <position_code>-<job_id>-<headcount_number>");
            $this->line("  - Example: MF24A1W-4749-01");
            $this->line('');
            $this->info('═══════════════════════════════════════════════════════════');

            return 0;
        }

        $this->info('Starting job splitting process...');
        $this->line('');
        
        try {
            $result = $this->splitService->splitJobsWithMultipleParents();
            
            if ($result['success']) {
                $this->line('');
                $this->info('═══════════════════════════════════════════════════════════');
                $this->info('                    SUCCESS                                ');
                $this->info('═══════════════════════════════════════════════════════════');
                $this->line('');
                $this->info($result['message']);
                $this->line('');
                $this->warn("Job Groups Processed: {$result['processed']}");
                $this->info("Total New Jobs Created: {$result['total_new_jobs_created']}");
                
                if (!empty($result['created_jobs'])) {
                    $this->line('');
                    $this->info('Created Jobs Details:');
                    $this->line('───────────────────────────────────────────────────────────');
                    
                    foreach ($result['created_jobs'] as $index => $created) {
                        $this->line('');
                        $this->warn("New Job #" . ($index + 1));
                        $this->line("├─ Original: {$created['original_job_title']} (ID: {$created['original_job_id']})");
                        $this->line("├─ New Title: {$created['new_job_title']}");
                        $this->line("├─ New Job ID: {$created['new_job_id']}");
                        $this->info("├─ New Position Code: {$created['new_position_code']}");
                        $this->line("└─ For Parent Job ID: {$created['parent_job_id']}");
                    }
                    
                    $this->line('');
                    $this->line('═══════════════════════════════════════════════════════════');
                }
            } else {
                $this->error('Job splitting failed.');
            }
            
            return 0;
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            $this->line('');
            $this->error($e->getTraceAsString());
            return 1;
        }
    }
}