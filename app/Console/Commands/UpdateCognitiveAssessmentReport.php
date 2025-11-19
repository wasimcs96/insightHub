<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\JobOpening;
use App\Models\JobOpeningApplication;
use App\Models\Job;
use App\Helpers\HelperFunctions;
use App\Helpers\AssessmentHelper;
use App\Helpers\NewAssessmentHelper;

class UpdateCognitiveAssessmentReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assessment:update-cognitive-reports {user_id} {--job_opening_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the cognitive assessment report for a specific user';

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

        $this->info("Starting update for Cognitive assessment report for User ID: {$user_id}");
        
        if($user_id) {
            $user = User::find($user_id);
            $user_type = $user->role_name ?? 'employee';

            $job_opening_id = $this->option('job_opening_id');
            $job = [];
            if($job_opening_id) {
                $position_id = JobOpening::where('id', $job_opening_id)->value('job_id');
                $job = Job::find($position_id);
            } else {
                $position_id = $user->position_id;
                $job = Job::find($position_id);
            }

            $descriptors = $descriptors->where('user_type', $user_type);
            // Cognitive
            [$cognitiveTestPercentage] = NewAssessmentHelper::updateCognitiveResults($user_id, $user, $job_opening_id, $job, $position_id, $user_type, $descriptors);
                
            // Soft Skill Score 
            $userResults = DB::table('user_results')->where('user_id', $user->id)->get();
            
            $ccsMatchRateRaw = $userResults->where('job_id', $position_id)
                ->where('assessment_type', 'ocean')
                ->where('result_type', 'ccs_match_rate')
                ->pluck('score')
                ->first();

            $jmr = $userResults->where('job_id', $position_id)
                ->where('assessment_type', 'riasec')
                ->where('result_type', 'jmr')
                ->pluck('percentage')
                ->first();

            $gpScore = $userResults->where('assessment_type', 'ocean')
                ->where('result_type', 'growth_potential')
                ->pluck('score')
                ->first();
            
            NewAssessmentHelper::updateSoftSkillScore($user_id, $position_id, $job,$descriptors, $jmr, $ccsMatchRateRaw, $cognitiveTestPercentage, $gpScore);

        } else {
           $this->info("I am in else");
        }

        $this->info('Cognitive assessment report updated successfully.');

        return 0;
    }

}
