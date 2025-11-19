<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OrganisationPosition;
use App\Models\Job;
use App\Models\JobProfile;
use App\Models\JobHeadcount;
use App\Models\User;

class MigrateExistingData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:existing-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate existing organization positions to job headcounts';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ini_set('max_execution_time', -1);

        $this->info('Starting migration...');

        // $organisationPositions = OrganisationPosition::whereNotNull('job_id')
        //     ->whereNotNull('user_id')
        //     ->get();

        // To rerun for the missed ones
        // $organisationPositions = OrganisationPosition::whereNotNull('job_id')
        //         ->whereNotNull('user_id')
        //         ->where('job_id', '!=', 4790)
        //         ->whereNotIn('id', function($query) {
        //             $query->select('id')
        //                 ->from('job_headcounts');
        //         })
        //         ->get();

        $this->info('Found ' . $organisationPositions->count() . ' positions to migrate');
        
        $data = [];
        foreach($organisationPositions as $organisationPosition){
            $data[$organisationPosition->job_id][] = $organisationPosition;         
        }
        
        $progressBar = $this->output->createProgressBar(count($data));
        $progressBar->start();

        foreach ($data as $jobId => $positions) {
            $this->line("\nMigrating Job ID: " . $jobId);
            
            if ($jobId == 4790) {
                $this->warn("Skipping Job ID: 4790");
                $progressBar->advance();
                continue;
            }
            
            $job = Job::find($jobId);
            
            if (!$job) {
                $this->warn("Job not found: " . $jobId);
                $progressBar->advance();
                continue;
            }

            $jobProfile = JobProfile::updateOrCreate(
                ['aa_job_profile_id' => $job->position_code],
                [
                    'aa_job_profile_id' => $job->position_code,
                    'name' => $job->title,
                    'description' => $job->description,
                    'department_id' => $job->department_id,
                ]
            );

            $job->job_profile_id = $jobProfile->id;
            $job->save();

            // Get the maximum headcount number for this job to avoid conflicts
            $maxHeadcount = JobHeadcount::where('job_id', $jobId)
                ->max('headcount_number');
            
            $headCountNumber = $maxHeadcount ? (int)$maxHeadcount + 1 : 1;
            $parentIdMap = []; // Track old parent_id to new parent_id mapping
            $createdHeadcountCodes = []; // Track created codes to avoid duplicates

            foreach ($positions as $organisationPosition) {
                // Check if this position already exists
                $existingHeadcount = JobHeadcount::find($organisationPosition->id);
                if ($existingHeadcount) {
                    $this->warn("Headcount already exists for position ID: " . $organisationPosition->id);
                    continue;
                }

                $formattedHeadCountNumber = str_pad($headCountNumber, 2, '0', STR_PAD_LEFT);
                $headCountCode = $job->position_code . '-' . $job->id . '-' . $formattedHeadCountNumber;

                // Ensure unique headcount code
                while (in_array($headCountCode, $createdHeadcountCodes) || 
                       JobHeadcount::where('headcount_code', $headCountCode)->exists()) {
                    $headCountNumber++;
                    $formattedHeadCountNumber = str_pad($headCountNumber, 2, '0', STR_PAD_LEFT);
                    $headCountCode = $job->position_code . '-' . $job->id . '-' . $formattedHeadCountNumber;
                }

                // Calculate parent_id for new structure
                if ($organisationPosition->parent_id) {
                    $parent_id = $organisationPosition->parent_id;
                    
                    // Check if parent exists in job_headcounts table
                    $parentExists = JobHeadcount::find($parent_id);
                    
                    if (!$parentExists) {
                        // Check if we've already created a mapped parent
                        if (isset($parentIdMap[$parent_id])) {
                            $parent_id = $parentIdMap[$parent_id];
                        } else {
                            // Create parent record first
                            $parentOrgPosition = OrganisationPosition::find($parent_id);
                            
                            if ($parentOrgPosition && $parentOrgPosition->user_id) {
                                $parentUser = User::find($parentOrgPosition->user_id);
                                
                                if ($parentUser) {
                                    // Generate unique code for parent
                                    $parentHeadCountNumber = $headCountNumber;
                                    $parentFormattedNumber = str_pad($parentHeadCountNumber, 2, '0', STR_PAD_LEFT);
                                    $parentHeadCountCode = $job->position_code . '-' . $job->id . '-' . $parentFormattedNumber;
                                    
                                    while (in_array($parentHeadCountCode, $createdHeadcountCodes) || 
                                           JobHeadcount::where('headcount_code', $parentHeadCountCode)->exists()) {
                                        $parentHeadCountNumber++;
                                        $parentFormattedNumber = str_pad($parentHeadCountNumber, 2, '0', STR_PAD_LEFT);
                                        $parentHeadCountCode = $job->position_code . '-' . $job->id . '-' . $parentFormattedNumber;
                                    }

                                    $newParent = JobHeadcount::create([
                                        'job_id' => $parentOrgPosition->job_id,
                                        'user_id' => $parentOrgPosition->user_id,
                                        'parent_id' => 1, // Root parent
                                        'department_id' => $parentOrgPosition->department_id,
                                        'headcount_number' => $parentFormattedNumber,
                                        'headcount_code' => $parentHeadCountCode,
                                        'orgMetadata' => [
                                            'action' => 'migrated_position_parent',
                                            'reason' => "Auto-created parent",
                                            'node' => ['data'=>['code'=>$parentHeadCountCode]],
                                            'source'=>"Job Migration",
                                        ]
                                    ]);
                                    
                                    $createdHeadcountCodes[] = $parentHeadCountCode;
                                    $parentIdMap[$parent_id] = $newParent->id;
                                    $parent_id = $newParent->id;
                                    $headCountNumber = $parentHeadCountNumber + 1;
                                } else {
                                    $parent_id = 1; // Fallback to root
                                }
                            } else {
                                $parent_id = 1; // Fallback to root
                            }
                        }
                    }
                } else {
                    $parent_id = 1;
                }

                $user = User::find($organisationPosition->user_id);
                
                if ($user && $parent_id) {
                    try {
                        JobHeadcount::create([
                            'id' => $organisationPosition->id,
                            'job_id' => $organisationPosition->job_id,
                            'user_id' => $organisationPosition->user_id,
                            'parent_id' => $parent_id,
                            'department_id' => $organisationPosition->department_id,
                            'headcount_number' => $formattedHeadCountNumber,
                            'headcount_code' => $headCountCode,
                            'orgMetadata' => [
                                'action' => 'migrated_position',
                                'reason' => "",
                                'node' => ['data'=>['code'=>$headCountCode]],
                                'source'=>"Job Migration",
                            ]
                        ]);
            
                        $createdHeadcountCodes[] = $headCountCode;
                        $headCountNumber++;
                    } catch (\Exception $e) {
                        $this->error("Error creating headcount for position " . $organisationPosition->id . ": " . $e->getMessage());
                    }
                }
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine();
        $this->info('Migration completed successfully!');

        return Command::SUCCESS;
    }
}