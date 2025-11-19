<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Job;
use App\Models\JobOpeningApplication;
use App\Models\JobOpening;
use App\Helpers\HelperFunctions;
use App\Helpers\AssessmentHelper;
use App\Helpers\NewAssessmentHelper;

class UpdateRiasecAssessmentReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assessment:update-riasec-reports {user_id} {--job_opening_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the RIASEC assessment report for a specific user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Retrieve the user_id argument
        $user_id = $this->argument('user_id');

        // Fetch master descriptors from the database
        $descriptors = DB::table('master_descriptors')->get();
        

        $this->info("Starting update for RIASEC assessment report for User ID: {$user_id}");
        // Fetch master descriptors from the database
        // $masterDescriptors = DB::table('master_descriptors')->pluck('description', 'name');
        if ($user_id) {
            $user = User::find($user_id);

            $job_opening_id = $this->option('job_opening_id');
            $job = [];
            if($job_opening_id) {
                $position_id = JobOpening::where('id', $job_opening_id)->value('job_id');
                $job = Job::find($position_id);
            } else {
                $position_id = $user->position_id;
                $job = Job::find($position_id);
            }

            $user_type = $user->role_name ?? 'employee';
            $descriptors = $descriptors->where('user_type', $user_type);
            NewAssessmentHelper::updateRiasecResults($user_id, $user, $job_opening_id, $job, $position_id, $user_type, $descriptors);                  
        }
        else {
            $this->info('I am in else');
        }

        $this->info('RIASEC assessment report updated successfully.');

        return 0;
    }

}
