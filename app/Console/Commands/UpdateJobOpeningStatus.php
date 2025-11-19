<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\JobOpeningApplication;
use App\Models\JobOpening;
use App\Models\JobOpeningSuitabilityRateSetting;
use Carbon\Carbon;

class UpdateJobOpeningStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job-opening:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of the job opening - ready, active, expired';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $jobOpenings = JobOpening::whereIn('status', [1,2])->get();

        $today = Carbon::today();

        foreach ($jobOpenings as $jobOpening) {
            $this->info($jobOpening->job_title);
            if ($jobOpening->status == 1) {
                if ($jobOpening->application_period_start_date <= $today) {
                    $jobOpening->status = 2;
                    $jobOpening->save();
                }
            } elseif ($jobOpening->status == 2) {
                if ($jobOpening->application_period_end_date < $today) {
                    $jobOpening->status = 3;
                }
            } 
            
            $jobOpening->save();
        }

        
        $this->info('Job opening active or expired status updated.');

        return 0;

    }

}
