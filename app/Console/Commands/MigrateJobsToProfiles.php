<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Job;
use App\Models\JobProfile;
use Illuminate\Support\Facades\DB;

class MigrateJobsToProfiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobs:migrate-to-profiles {--dry-run : Run without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate jobs data to job_profiles table and update job_profile_id in jobs';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');

        if ($dryRun) {
            $this->info('Running in DRY RUN mode - no changes will be made');
        }

        $this->info('Starting migration of jobs to job profiles...');

        // Get all jobs that need to be migrated
        $jobs = Job::where('is_primary', 0)
            ->whereNotNull('code')
            ->whereNotNull('department_id')
            ->get();

        if ($jobs->isEmpty()) {
            $this->info('No jobs found to migrate.');
            return Command::SUCCESS;
        }

        $this->info("Found {$jobs->count()} jobs to migrate.");

        $progressBar = $this->output->createProgressBar($jobs->count());
        $progressBar->start();

        $created = 0;
        $updated = 0;
        $skipped = 0;
        $errors = 0;

        DB::beginTransaction();

        try {
            foreach ($jobs as $job) {
                try {
                    // Check if a profile already exists with this code
                    $existingProfile = JobProfile::where('department_id', $job->department_id)
                        ->where('aa_job_profile_id', $job->code)
                        ->first();

                    if ($existingProfile) {
                        // Update job with existing profile
                        if (!$dryRun) {
                            $job->job_profile_id = $existingProfile->id;
                            $job->save();
                        }
                        $updated++;
                    } else {
                        // Create new profile
                        if (!$dryRun) {
                            $profile = JobProfile::create([
                                'department_id' => $job->department_id,
                                'aa_job_profile_id' => $job->code,
                                'name' => $job->title,
                                'description' => $job->description,
                            ]);

                            // Update job with new profile ID
                            $job->job_profile_id = $profile->id;
                            $job->save();
                        }
                        $created++;
                    }

                    $progressBar->advance();
                } catch (\Exception $e) {
                    $this->newLine();
                    $this->error("Error processing job ID {$job->id}: " . $e->getMessage());
                    $errors++;
                    $progressBar->advance();
                }
            }

            $progressBar->finish();
            $this->newLine(2);

            if ($dryRun) {
                DB::rollBack();
                $this->info('DRY RUN completed - no changes were made.');
            } else {
                DB::commit();
                $this->info('Migration completed successfully!');
            }

            // Display summary
            $this->table(
                ['Action', 'Count'],
                [
                    ['Profiles Created', $created],
                    ['Jobs Updated (existing profile)', $updated],
                    ['Skipped', $skipped],
                    ['Errors', $errors],
                    ['Total Processed', $jobs->count()],
                ]
            );

            return Command::SUCCESS;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Migration failed: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
