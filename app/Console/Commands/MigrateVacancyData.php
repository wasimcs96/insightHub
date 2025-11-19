<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Job;
use App\Models\User;
use App\Services\Job\JobService;
use App\Services\Job\UpdateVacancyInJobService;
use App\Modules\Headcounts\Services\JobHeadcountService;

class MigrateVacancyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:vacancy-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate vacancy data for jobs';

    protected $jobService;
    protected $updateVacancyInJobService;
    protected $hcService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UpdateVacancyInJobService $service, JobService $jobService, JobHeadcountService $hcService)
    {
        parent::__construct();
        $this->updateVacancyInJobService = $service;
        $this->jobService = $jobService;
        $this->hcService = $hcService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting vacancy data migration...');
        
        $savedJobs = Job::where('is_primary', 0)->whereNotNull('business_unit_id')->whereNotNull('division_id')->get();
        
        $this->info('Found ' . $savedJobs->count() . ' jobs to process');
        
        $topPosition = Job::where('id', 4892)->first()->headcounts()->first()->id;
        
        if (!$topPosition) {
            $this->error('Top position (Job ID: 4892) not found or has no headcounts!');
            return Command::FAILURE;
        }
        
        $this->info('Top position ID: ' . $topPosition);
        
        $batchForAdd = [];
        $totalVacanciesCreated = 0;
        
        $progressBar = $this->output->createProgressBar($savedJobs->count());
        $progressBar->start();

        foreach ($savedJobs as $job) {
            $totalEmployees = User::where('position_id', $job->id)->count();
            $totalVacancies = $job->heads - $totalEmployees;

            $parentId = null;

            if ($totalVacancies < 0) {
                $totalVacancies = 0;
            }

            if ($totalVacancies > 0) {
                $headcount = $job->headcounts()->first();
                $parentId = $headcount?->parent_id;

                for ($i=0; $i < $totalVacancies; $i++) {
                    $generatedCode = $this->jobService->generateHeadcountCode($job->position_code, $job->id);
                    [$prefix, $jobId, $seq] = explode('-', $generatedCode);
                    $updatedHeadcountCode = implode('-', [$prefix, $jobId, $seq + $i]);

                    // dd($parentId);
                    
                    $batchForAdd[] = [
                        'job_id'           => (int) $job->id,
                        'headcount_code'   => $updatedHeadcountCode,
                        'parent_id'        => $parentId ?? $topPosition,
                        'department_id'    => $job->department_id,
                        'user_id'          => null,
                        'headcount_number' => (int) $seq+$i,
                        'orgMetadata' => [
                            'action' => 'add_position',
                            'reason' => "Vacant Position",
                            'node' => ['data'=>['code'=>$updatedHeadcountCode]],
                        ]
                    ];
                    
                    $totalVacanciesCreated++;
                }

                // $generatedCode = $this->jobService->generateHeadcountCode($job->position_code, $job->id);
                // [$prefix, $jobId, $seq] = explode('-', $generatedCode);
                // $batchForAdd[] = [
                //                     'job_id'           => (int) $job->id,
                //                     'headcount_code'   => $generatedCode,
                //                     'parent_id'        => $parentId ?? $topPosition,
                //                     'department_id'    => $job->department_id,
                //                     'user_id'    => null,
                //                     'headcount_number' => (int) $seq,
                //                     'orgMetadata' => [
                //                         'action' => 'add_position',
                //                         'reason' => "Vacant Position",
                //                         'node' => ['data'=>['code'=>$generatedCode]],
                //                     ]
                //                 ];
            }
            
            $job->vacancy = $totalVacancies;
            $job->save();
            
            $progressBar->advance();
        }
        
        $progressBar->finish();
        $this->newLine(2);
        
        //    dd($batchForAdd);
        if (count($batchForAdd) > 0) {
            $this->info('Creating ' . count($batchForAdd) . ' vacant positions in batch...');
            
            try {
                $this->hcService->createBatchForOrgChart($batchForAdd);
                $this->info('✓ Batch creation completed successfully!');
            } catch (\Exception $e) {
                $this->error('✗ Error creating batch: ' . $e->getMessage());
                return Command::FAILURE;
            }
        } else {
            $this->info('No vacant positions to create.');
        }
        //    dd($batchForAdd);
        
        $this->newLine();
        $this->info('========================================');
        $this->info('Migration Summary:');
        $this->info('- Jobs processed: ' . $savedJobs->count());
        $this->info('- Total vacancies created: ' . $totalVacanciesCreated);
        $this->info('========================================');
        $this->info('✓ Vacancy data migration completed successfully!');

        return Command::SUCCESS;
    }
}
