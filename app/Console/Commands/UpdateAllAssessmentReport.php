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

class UpdateAllAssessmentReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assessment:update-all-reports {user_id} {--job_opening_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all assessment reports (OCEAN, RIASEC, Cognitive) for a specific user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Retrieve the user_id argument
        $user_id = $this->argument('user_id');
        $job_opening_id = $this->option('job_opening_id');
        
        $stats = HelperFunctions::getStats();

        $query = User::where('is_personality_motivation_completed', 1)
        ->where('is_work_interest_completed', 1)
        ->where('is_cognitive_ability_completed', 1)
        ->where('id', '>', $user_id);

        // Ensure the user has applied for the given job opening
        if ($job_opening_id) {
            $query->whereHas('jobOpeningApplication', function($query) use ($job_opening_id, $user_id) {
            $query->where('job_opening_id', $job_opening_id);
            });
        }


        $users = $query->get();
        
        //->where('company_id', 3) $users = User::whereIn('id', [2499, 3443])->get(); ->whereNotIn('id', [3466,3469,3499,4494, 4525, 4546]) whereIn('id', [2499, 3443]) where('company_id', 3)->whereNotNull('position_id')-> join('jobs', 'users.position_id', '=', 'jobs.id')-> ->select('users.*', 'jobs.title')
        $descriptors = DB::table('master_descriptors')->get();
        $this->info($users->count());

        foreach ($users as $use) {
            $user_id = $use->id;
            if ($user_id) {
                $user = User::find($user_id);

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
                if ($user) {
                    $this->info("Starting update for all assessment reports for User ID: {$user_id}");
    
                    // Logic for updating OCEAN report
                    $this->info('Updating OCEAN assessment report');

                    $this->info("Starting update for OCEAN assessment report for User ID: {$user_id}");
                    // Call the function or service that updates the OCEAN report
                    [$ccsMatchRateRaw, $gpScore] = NewAssessmentHelper::updateOceanResults($user_id, $user, $job_opening_id, $job, $position_id, $user_type, $descriptors, $stats);
            
                    // Logic for updating RIASEC report
                    $this->info('Updating RIASEC assessment report...');

                    // Call the function or service that updates the RIASEC report
                    [$jmr] = NewAssessmentHelper::updateRiasecResults($user_id, $user, $job_opening_id, $job, $position_id, $user_type, $descriptors, $stats);
                    
                    // Logic for updating Cognitive report
                    $this->info('Updating Cognitive assessment report...');
                    // Call the function or service that updates the Cognitive report
                    [$cognitiveTestPercentage] = NewAssessmentHelper::updateCognitiveResults($user_id, $user, $job_opening_id, $job, $position_id, $user_type, $descriptors, $stats);
    
                    // Soft Skill Score
                    [$soft_skill_score] =NewAssessmentHelper::updateSoftSkillScore($user_id, $position_id, $job,$descriptors, $jmr, $ccsMatchRateRaw, $cognitiveTestPercentage, $gpScore);

                    // Technical
                    NewAssessmentHelper::updateTechnicalResults($user_id, $user, $job_opening_id, $job, $position_id, $user_type, $descriptors, $soft_skill_score);
            
                    $user->save();
                    // Confirm that all reports have been updated
                    $this->info('All assessment reports updated successfully.');
                } else {
                    $this->info('User does not exist for this user_id');
                }
                
            }
        }

        return 1;
    }

}
