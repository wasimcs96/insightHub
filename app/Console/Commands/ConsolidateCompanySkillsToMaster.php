<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ConsolidateCompanySkillsToMaster extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'skills:consolidate-company-to-master 
                            {created_date : The creation date of company skills to process (Y-m-d format)}
                            {--dry-run : Run in dry-run mode to see what would be changed}
                            {--verbose-log : Show detailed logs}
                            {--force : Skip confirmation prompts}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consolidate company skills created on specific date with matching master skills';

    /**
     * Statistics tracking
     */
    private $stats = [
        'skills_analyzed' => 0,
        'skills_matched' => 0,
        'skills_deleted' => 0,
        'skills_skipped_modified' => 0,
        'skills_skipped_no_match' => 0,
        'jobs_updated' => 0,
        'departments_updated' => 0,
        'job_conflicts_resolved' => 0,
        'dept_conflicts_resolved' => 0
    ];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $createdDate = $this->argument('created_date');
        $isDryRun = $this->option('dry-run');
        $verboseLog = $this->option('verbose-log');
        $force = $this->option('force');
        
        // Validate date format
        try {
            $targetDate = Carbon::parse($createdDate)->format('Y-m-d');
        } catch (\Exception $e) {
            $this->error("Invalid date format. Please use Y-m-d format (e.g., 2024-01-15)");
            return Command::FAILURE;
        }
        
        if ($isDryRun) {
            $this->info('🔍 Running in DRY-RUN mode - no changes will be made');
            $this->line('');
        }
        
        $this->info('=== Company Skills Consolidation Process ===');
        $this->info("Target Date: {$targetDate}");
        $this->info("Processing company skills created on this date...");
        $this->line('');
        
        if (!$force && !$isDryRun) {
            if (!$this->confirm("This will consolidate and potentially delete company skills created on {$targetDate}. Continue?")) {
                $this->info('Operation cancelled.');
                return Command::SUCCESS;
            }
        }
        
        try {
            DB::beginTransaction();
            
            // Step 1: Get all company skills created on the target date
            $companySkills = $this->getCompanySkillsForDate($targetDate);
            
            if ($companySkills->isEmpty()) {
                $this->warn("No company skills found for date: {$targetDate}");
                DB::commit();
                return Command::SUCCESS;
            }
            
            $this->stats['skills_analyzed'] = $companySkills->count();
            $this->info("Found {$companySkills->count()} company skills created on {$targetDate}");
            $this->line('');
            
            // Step 2: Process each company skill
            $this->info('Processing skills...');
            $progressBar = $this->output->createProgressBar($companySkills->count());
            
            foreach ($companySkills as $companySkill) {
                if (!$verboseLog) {
                    $progressBar->advance();
                }
                
                $this->processCompanySkill($companySkill, $isDryRun, $verboseLog);
            }
            
            if (!$verboseLog) {
                $progressBar->finish();
                $this->line('');
                $this->line('');
            }
            
            // Step 3: Show summary
            $this->displaySummary($isDryRun);
            
            // Step 4: Commit or rollback
            if ($isDryRun) {
                DB::rollBack();
                $this->line('');
                $this->info('✓ DRY-RUN completed. No actual changes were made.');
            } else {
                DB::commit();
                $this->line('');
                $this->info('✓ Consolidation completed successfully!');
            }
            
            return Command::SUCCESS;
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->line('');
            $this->error('✗ An error occurred during consolidation: ' . $e->getMessage());
            Log::error('Skill consolidation error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'date' => $targetDate
            ]);
            return Command::FAILURE;
        }
    }
    
    /**
     * Get company skills created on the target date
     */
    private function getCompanySkillsForDate($date)
    {
        return DB::table('master_technical_skills')
            ->whereIn('is_custom', [1, 2])
            // ->whereDate('created_at', $date)
            ->get();
    }
    
    /**
     * Process a single company skill
     */
    private function processCompanySkill($companySkill, $isDryRun, $verboseLog)
    {
        if ($verboseLog) {
            $this->line('');
            $this->info("Processing: {$companySkill->name} (ID: {$companySkill->id})");
        }
        
        // Check if the skill has been modified (updated_at != created_at)
        // if (!$this->isUnmodified($companySkill)) {
        //     $this->stats['skills_skipped_modified']++;
            
        //     if ($verboseLog) {
        //         $this->warn("  ⚠ Skipped: Skill has been modified after creation");
        //         $this->line("    Created: {$companySkill->created_at}");
        //         $this->line("    Updated: {$companySkill->updated_at}");
        //     }
        //     return;
        // }
        
        // Find matching master skill
        $masterSkill = $this->findMatchingMasterSkill($companySkill);
        
        if (!$masterSkill) {
            $this->stats['skills_skipped_no_match']++;
            
            if ($verboseLog) {
                $this->warn("  ⚠ Skipped: No matching master skill found");
                $this->line("    Sector: {$companySkill->sector_id}, Category: {$companySkill->category_id}");
            }
            return;
        }
        
        $this->stats['skills_matched']++;
        
        if ($verboseLog) {
            $this->info("  ✓ Matched with master skill: {$masterSkill->name} (ID: {$masterSkill->id})");
            $this->line("    Sector: {$masterSkill->sector_id}, Category: {$masterSkill->category_id}");
        }
        
        // Update relationships
        $jobsUpdated = $this->consolidateJobTechnicalSkills(
            $companySkill->id,
            $masterSkill->id,
            $isDryRun,
            $verboseLog
        );
        
        $deptsUpdated = $this->consolidateDepartmentTechnicalSkills(
            $companySkill->id,
            $masterSkill->id,
            $isDryRun,
            $verboseLog
        );
        
        $this->stats['jobs_updated'] += $jobsUpdated['updated'];
        $this->stats['job_conflicts_resolved'] += $jobsUpdated['conflicts'];
        $this->stats['departments_updated'] += $deptsUpdated['updated'];
        $this->stats['dept_conflicts_resolved'] += $deptsUpdated['conflicts'];
        
        // Delete the company skill
        if (!$isDryRun) {
            DB::table('master_technical_skills')
                ->where('id', $companySkill->id)
                ->delete();
        }
        
        $this->stats['skills_deleted']++;
        
        if ($verboseLog) {
            $this->info("  ✓ Company skill deleted successfully");
        }
    }
    
    /**
     * Check if skill has not been modified (created_at == updated_at)
     */
    private function isUnmodified($skill)
    {
        // If updated_at is null, consider it unmodified
        if (is_null($skill->updated_at)) {
            return true;
        }
        
        // Compare timestamps (allow for minor differences due to microseconds)
        $created = Carbon::parse($skill->created_at);
        $updated = Carbon::parse($skill->updated_at);
        
        // Consider unmodified if difference is less than 1 second
        return $created->diffInSeconds($updated) < 1;
    }
    
    /**
     * Find matching master skill based on sector_id, category_id, and name
     */
    private function findMatchingMasterSkill($companySkill)
    {
        return DB::table('master_technical_skills')
            ->where('is_custom', 0)
            ->where('sector_id', $companySkill->sector_id)
            ->where('category_id', $companySkill->category_id)
            ->where('name', $companySkill->name)
            ->first();
    }
    
    /**
     * Consolidate job technical skills from company to master skill
     */
    private function consolidateJobTechnicalSkills($companySkillId, $masterSkillId, $isDryRun, $verboseLog)
    {
        $stats = ['updated' => 0, 'conflicts' => 0];
        
        // Get all jobs using the company skill
        $companyJobSkills = DB::table('job_technical_skills')
            ->where('master_technical_skill_id', $companySkillId)
            ->get();
        
        foreach ($companyJobSkills as $jobSkill) {
            // Check if this job already has the master skill
            $existingMasterSkill = DB::table('job_technical_skills')
                ->where('job_id', $jobSkill->job_id)
                ->where('master_technical_skill_id', $masterSkillId)
                ->first();
            
            if ($existingMasterSkill) {
                // Conflict resolution: keep the company skill's level
                $stats['conflicts']++;
                
                if (!$isDryRun) {
                    // Update the master skill entry with company skill's level
                    DB::table('job_technical_skills')
                        ->where('id', $existingMasterSkill->id)
                        ->update([
                            'level' => $jobSkill->level,
                            'updated_at' => now()
                        ]);
                    
                    // Delete the company skill entry
                    DB::table('job_technical_skills')
                        ->where('id', $jobSkill->id)
                        ->delete();
                }
                
                if ($verboseLog) {
                    $this->line("    → Job {$jobSkill->job_id}: Conflict resolved, kept level {$jobSkill->level}");
                }
            } else {
                // Simple update: change the reference to master skill
                $stats['updated']++;
                
                if (!$isDryRun) {
                    DB::table('job_technical_skills')
                        ->where('id', $jobSkill->id)
                        ->update([
                            'master_technical_skill_id' => $masterSkillId,
                            'updated_at' => now()
                        ]);
                }
            }
        }
        
        if ($verboseLog && ($stats['updated'] > 0 || $stats['conflicts'] > 0)) {
            $this->line("    Jobs: {$stats['updated']} updated, {$stats['conflicts']} conflicts resolved");
        }
        
        return $stats;
    }
    
    /**
     * Consolidate department technical skills from company to master skill
     */
    private function consolidateDepartmentTechnicalSkills($companySkillId, $masterSkillId, $isDryRun, $verboseLog)
    {
        $stats = ['updated' => 0, 'conflicts' => 0];
        
        // Get all departments using the company skill
        $companyDeptSkills = DB::table('department_technical_skills')
            ->where('master_technical_skill_id', $companySkillId)
            ->get();
        
        foreach ($companyDeptSkills as $deptSkill) {
            // Check if this department already has the master skill
            $existingMasterSkill = DB::table('department_technical_skills')
                ->where('department_id', $deptSkill->department_id)
                ->where('master_technical_skill_id', $masterSkillId)
                ->first();
            
            if ($existingMasterSkill) {
                // Conflict: department has both skills - remove duplicate
                $stats['conflicts']++;
                
                if (!$isDryRun) {
                    // Delete the company skill entry (keep master)
                    DB::table('department_technical_skills')
                        ->where('id', $deptSkill->id)
                        ->delete();
                }
                
                if ($verboseLog) {
                    $this->line("    → Department {$deptSkill->department_id}: Duplicate removed");
                }
            } else {
                // Simple update: change the reference to master skill
                $stats['updated']++;
                
                if (!$isDryRun) {
                    DB::table('department_technical_skills')
                        ->where('id', $deptSkill->id)
                        ->update([
                            'master_technical_skill_id' => $masterSkillId,
                            'updated_at' => now()
                        ]);
                }
            }
        }
        
        if ($verboseLog && ($stats['updated'] > 0 || $stats['conflicts'] > 0)) {
            $this->line("    Departments: {$stats['updated']} updated, {$stats['conflicts']} conflicts resolved");
        }
        
        return $stats;
    }
    
    /**
     * Display summary of the consolidation process
     */
    private function displaySummary($isDryRun)
    {
        $this->line('');
        $this->info('=== CONSOLIDATION SUMMARY ===');
        
        $headers = ['Metric', 'Count'];
        $rows = [
            ['Skills Analyzed', $this->stats['skills_analyzed']],
            ['Skills Matched with Master', $this->stats['skills_matched']],
            ['Skills Deleted', $isDryRun ? $this->stats['skills_deleted'] . ' (would be)' : $this->stats['skills_deleted']],
            ['Skills Skipped (Modified)', $this->stats['skills_skipped_modified']],
            ['Skills Skipped (No Match)', $this->stats['skills_skipped_no_match']],
            ['', ''],
            ['Job Skills Updated', $this->stats['jobs_updated']],
            ['Job Conflicts Resolved', $this->stats['job_conflicts_resolved']],
            ['Department Skills Updated', $this->stats['departments_updated']],
            ['Department Conflicts Resolved', $this->stats['dept_conflicts_resolved']],
        ];
        
        $this->table($headers, $rows);
        
        // Show breakdown of skipped skills
        if ($this->stats['skills_skipped_modified'] > 0 || $this->stats['skills_skipped_no_match'] > 0) {
            $this->line('');
            $this->info('Skills Retention:');
            
            if ($this->stats['skills_skipped_modified'] > 0) {
                $this->line("  • {$this->stats['skills_skipped_modified']} skills kept (modified after creation)");
            }
            
            if ($this->stats['skills_skipped_no_match'] > 0) {
                $this->line("  • {$this->stats['skills_skipped_no_match']} skills kept (no matching master skill)");
            }
        }
        
        // Calculate success rate
        if ($this->stats['skills_analyzed'] > 0) {
            $successRate = round(($this->stats['skills_deleted'] / $this->stats['skills_analyzed']) * 100, 1);
            $this->line('');
            $this->info("Success Rate: {$successRate}% of analyzed skills were consolidated");
        }
    }
}