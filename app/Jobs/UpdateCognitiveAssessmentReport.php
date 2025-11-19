<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Job;
use App\Models\JobOpeningApplication;
use App\Models\JobOpening;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Helpers\HelperFunctions;
use App\Helpers\AssessmentHelper;
use App\Helpers\NewAssessmentHelper;

class UpdateCognitiveAssessmentReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user_id;
    protected $job_opening_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id, $job_opening_id=null)
    {
        $this->user_id = $user_id;
        $this->job_opening_id = $job_opening_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Retrieve the user_id argument
        $user_id = $this->user_id;
        $job_opening_id = $this->job_opening_id;
        // Fetch master descriptors from the database
        $descriptors = DB::table('master_descriptors')->get();
        
        if($user_id) {
            $user = User::find($user_id);
            $user_type = $user->role_name ?? 'employee';
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
            \Log::info("I am in else");
        }

        \Log::info("Cognitive assessment report update done for User ID: {$user_id}");


        return 0;
    }
}
