<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\UserResult;
use App\Models\Job;
use App\Helpers\AssessmentHelper;
use App\Models\JobOpeningApplication;
use App\Models\JobOpening;

class UpdateReportsOnPositionAssign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:update-on-position-assign {position} {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update reports based on a specific position and a user ID';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Retrieve arguments
        $position_id = $this->argument('position');
        $user_id = $this->argument('user_id');

        $user = User::find($user_id);
        
        // Fetch master descriptors from the database
        $descriptors = DB::table('master_descriptors')->get();
        
        $this->info("Starting update for report for User ID: {$user_id}");

        if($user) {
            $userResults = UserResult::where('user_id', $user_id)->get();
            $user_type = $user->role_name ?? 'employee';

            if ($user->is_personality_motivation_completed == 1) {
                // TP Match Rate / CCS Match Rate / SSMR
                $ccs_match_rate = $this->updateCcsMatchRate($user_id, $position_id, $user,$userResults, $descriptors, $user_type);
                // $user->talent_pillar_match_rate = $ccs_match_rate;
            }

            if ($user->is_work_interest_completed == 1) {
                // JMR
                $jmr = $this->updateJmr($user_id, $position_id, $user,$userResults, $descriptors, $user_type);
                // $user->riasec_job_match_rate = $jmr;
            }

            if (($user->is_personality_motivation_completed == 1) && ($user->is_work_interest_completed == 1) && ($user->is_cognitive_ability_completed == 1)) {
                // BFR
                $soft_skill_score = $this->updateBfr($user_id, $position_id, $user,$userResults, $descriptors, $user_type, $jmr, $ccs_match_rate);
                // $user->soft_skill_score = $soft_skill_score;
                // OMR
                $overall_match_rate = $this->updateOmr($user_id, $position_id, $user,$userResults, $descriptors, $user_type, $soft_skill_score);
                // $user->match_rate = $overall_match_rate;
            }

            // $user->save();

        } else {
            $this->info("User does not exist");
        }

        // try {
        //     \App\Jobs\UpdateReportsOnPositionAssign::dispatch($user_id, $position_id);
        // }
        // catch(Exception $e) {
        //     print($e->getMessage());
        // }
        
        // Perform your logic here
        $this->info("Reports update completed successfully!");

        return Command::SUCCESS;
    }

    private function updateCcsMatchRate($user_id, $position_id, $user,$userResults, $descriptors, $user_type) {
        // TP Match Rate / CCS Match Rate / SSMR
        $ccsResult = [];
        $ccsResultWithLevel = [];

        $ccsUserResults = $userResults->where('result_type', 'ccs');

        foreach($ccsUserResults as $result) {
            $ccsResult[$result->name] = $result->score;
            $ccsResultWithLevel[$result->name] = $result->level;
        }
        
        $job = [];
        if($position_id) {
            $job = Job::find($position_id);
        } else {
            if(($user->role_name == 'candidate')) {
                $job_opening_id = JobOpeningApplication::where('user_id', $user_id)->value('job_opening_id');
                $position_id = JobOpening::where('id', $job_opening_id)->value('job_id');
                $job = Job::find($position_id);
            }
        }

        $level = 0;
        $level_description = '';
        $description = '';
        $ccs_match_rate = 0;
        $user_ccs_scores = $ccsResult;
        if($job) {
            $jobSkills = [];
            foreach($job->skills as $jobSkill) {
                $jobSkills[$jobSkill->title] = $jobSkill->level;
            }

            $final_ccs_scores = [];
            foreach ($jobSkills as $ccs => $required_level) {
                if (isset($user_ccs_scores[$ccs])) {
                    $user_level = $ccsResultWithLevel[$ccs];
                    $level_difference = $required_level - $user_level;
                    
                    if ($level_difference == 1) {
                        $adjusted_score = $user_ccs_scores[$ccs] / 2;
                    } elseif ($level_difference == 2) {
                        $adjusted_score = $user_ccs_scores[$ccs] / 4;
                    } elseif ($level_difference == 3) {
                            $adjusted_score = $user_ccs_scores[$ccs] / 8;
                    } else {
                        $adjusted_score = $user_ccs_scores[$ccs];
                    }

                    // Only include CCS scores that are in job requirements
                    $final_ccs_scores[$ccs] = $adjusted_score;
                }
            }
            if (count($final_ccs_scores) != 0) {
                $ccs_match_rate = array_sum($final_ccs_scores) / count($final_ccs_scores);
            } 

            if ($ccs_match_rate > 98) {
                $level_description = 'very high';
                $level = 5;
            } elseif ($ccs_match_rate > 84 && $ccs_match_rate <= 98) {
                $level_description = 'high';
                $level = 4;
            } elseif ($ccs_match_rate >= 16 && $ccs_match_rate <= 84) {
                $level_description = 'moderate';
                $level = 3;
            } elseif ($ccs_match_rate >= 2 && $ccs_match_rate < 16) {
                $level_description = 'low';
                $level = 2;
            } else {
                $level_description = 'very low';
                $level = 1;
            }
        }

        $dimension = 'CCS Match Rate';
        $this->insertInDb($user_id, $position_id, 'ocean', 'ccs_match_rate', $dimension, $ccs_match_rate, 0, $ccs_match_rate,$level, $level_description, $user_type, $descriptors);
        
        return $ccs_match_rate;
    }

    private function updateJmr($user_id, $position_id, $user,$userResults, $descriptors, $user_type) {
        // JMR
                
        $job = Job::find($position_id);
        $jobTop3Riasec = $job->top3riasec ?? '';

        $dimension = 'Job Match Rate';
        $level = 0;
        $level_description = '';
        $description = '';
        $jmr = 0;
        $results = [];
        $workInterestResults = $userResults->where('assessment_type', 'riasec')->where('result_type', 'domains');

        foreach ($workInterestResults as $result) {
            $results[$result->name] = $result->percentage;
        }

        if ($jobTop3Riasec && !$workInterestResults->isEmpty()) {
            $jobTop3RiasecArray = str_split($jobTop3Riasec);
            // Remove 'top_3_riasec' and 'top_3_riasec_description' from the array
            unset($results['top_3_riasec'], $results['top_3_riasec_description']);

            // Initialize an empty array to store the result
            $result = [];

            // Loop through the remaining RIASEC types
            foreach ($results as $type => $score) {
                // Get the first letter of the RIASEC type and map it to its score
                $result[$type[0]] = floatval($score); // Convert the score to float just in case it's in string format
            }

            // Sort the result array by value in descending order
            arsort($result);

            // Get the top 3 RIASEC types
            $top3RiasecKeyValue= array_slice($result, 0, 3, true); // Preserve keys

            // str_split($workInterestResult['top_3_riasec'])
            $top3RiasecKeys = array_keys($top3RiasecKeyValue);

            if (in_array($jobTop3RiasecArray[0], $top3RiasecKeys)) {
                $jmr = $jmr + 0.682*($top3RiasecKeyValue[$jobTop3RiasecArray[0]]);
                $userSingleJmrResult[$top3RiasecKeys[0]] = (0.682*($top3RiasecKeyValue[$jobTop3RiasecArray[0]])) / 100;
            } else {
                $userSingleJmrResult[$top3RiasecKeys[0]] = 0;
            }

            if (in_array($jobTop3RiasecArray[1], $top3RiasecKeys)) {
                $jmr = $jmr + 0.272*($top3RiasecKeyValue[$jobTop3RiasecArray[1]]);
                $userSingleJmrResult[$top3RiasecKeys[1]] = (0.272*($top3RiasecKeyValue[$jobTop3RiasecArray[1]])) / 100;
            } else {
                $userSingleJmrResult[$top3RiasecKeys[1]] = 0;
            }

            if (in_array($jobTop3RiasecArray[2], $top3RiasecKeys)) {
                $jmr = $jmr + 0.044*($top3RiasecKeyValue[$jobTop3RiasecArray[2]]);
                $userSingleJmrResult[$top3RiasecKeys[2]] = (0.044*($top3RiasecKeyValue[$jobTop3RiasecArray[2]])) / 100;
            } else {
                $userSingleJmrResult[$top3RiasecKeys[2]] = 0;
            }
           
            // Determine the performance level based on the percentage
            if ($jmr > 98) {
                $level_description = 'exceptional match';
                $level = 5;
            } elseif ($jmr > 84 && $jmr <= 98) {
                $level_description = 'strong match';
                $level = 4;
            } elseif ($jmr >= 16 && $jmr <= 84) {
                $level_description = 'moderate match';
                $level = 3;
            } elseif ($jmr >= 2 && $jmr < 16) {
                $level_description = 'limited match';
                $level = 2;
            } else {
                $level_description = 'minimal match';
                $level = 1;
            }
        }

        $this->insertInDb($user_id, $position_id, 'riasec', 'jmr', $dimension, $jmr, 0, $jmr,$level, $level_description, $user_type, $descriptors);

        return $jmr;
    }

    private function updateBfr($user_id, $position_id, $user,$userResults, $descriptors, $user_type, $jmr, $ccs_match_rate) {
        // BFR
        $cognitive = $userResults->where('assessment_type', 'cognitive')->where('result_type', 'overall')->first()->percentage ?? 0;
        $growth_potential = $userResults->where('assessment_type', 'ocean')->where('result_type', 'growth_potential')->first()->percentage ?? 0;
        $soft_skill_score = 0.30*($jmr) + 0.30*($ccs_match_rate) + 0.20*($cognitive) + 0.20*($growth_potential);
        // $user->soft_skill_score = $soft_skill_score;
        $dimension = 'Soft Skill Score';

        // Determine the performance level based on the percentage
        if ($soft_skill_score > 98) {
            $level_description = 'exceptional match';
            $level = 5;
        } elseif ($soft_skill_score > 84 && $soft_skill_score <= 98) {
            $level_description = 'strong match';
            $level = 4;
        } elseif ($soft_skill_score >= 16 && $soft_skill_score <= 84) {
            $level_description = 'moderate match';
            $level = 3;
        } elseif ($soft_skill_score >= 2 && $soft_skill_score < 16) {
            $level_description = 'limited match';
            $level = 2;
        } else {
            $level_description = 'minimal match';
            $level = 1;
        }

        $this->insertInDb($user_id, $position_id, 'all', 'soft_skill_score', $dimension, $soft_skill_score, 0, $soft_skill_score,$level, $level_description, $user_type, $descriptors);

        return $soft_skill_score;
    }

    private function updateOmr($user_id, $position_id, $user,$userResults, $descriptors, $user_type, $soft_skill_score) {
        // Overall Match Rate / OMR

        // if($user->technical_assessment_completed) {
        //     $overall_match_rate = 0.7*($user->tech_skill_score) + 0.3*($soft_skill_score);
        // } else {
        //     $overall_match_rate = 0;
        // }

        // $user->match_rate = $overall_match_rate;
        $dimension = 'Overall Match Rate';

        // Determine the performance level based on the percentage
        if ($overall_match_rate > 98) {
            $level_description = 'exceptional match';
            $level = 5;
        } elseif ($overall_match_rate > 84 && $overall_match_rate <= 98) {
            $level_description = 'strong match';
            $level = 4;
        } elseif ($overall_match_rate >= 16 && $overall_match_rate <= 84) {
            $level_description = 'moderate match';
            $level = 3;
        } elseif ($overall_match_rate >= 2 && $overall_match_rate < 16) {
            $level_description = 'limited match';
            $level = 2;
        } else {
            if($user->technical_assessment_completed) {
                $level = 1;
                $level_description = 'minimal match';
            } else {
                $level = 0;
                $level_description = 'Technical Assessment Not Completed';
            }
        }

        $this->insertInDb($user_id, $position_id, 'all', 'overall_match_rate', $dimension, $overall_match_rate, 0, $overall_match_rate,$level, $level_description, $user_type, $descriptors);
    }

    private function insertInDb($user_id, $position_id, $assessment_type, $result_type, $dimension, $score, $z_score, $percentage,$level, $level_description, $user_type, $descriptors) {
        
        $descriptor = $descriptors->where('assessment_type', $assessment_type)->where('result_type', $result_type)->where('slug',Str::slug($dimension))->where('user_type', $user_type)->where('user_score_level', $level)->first() ?? '';

        $description = $descriptor->analysis ?? '';
        $descriptor_id = $descriptor->id ?? '';

        // Prepare data for insertion or update
        $data = [
            'user_id' => $user_id,
            'job_id' => $position_id ?? '',
            'assessment_type' => $assessment_type,
            'result_type' => $result_type,
            'name' => $dimension,
            'slug' => Str::slug($dimension), 
            'code' => substr($dimension, 0, 1),
            'descriptor_id' => $descriptor_id ?? '',
            'description' => $description ?? '',
            'score' => $score, 
            'z_score' => $z_score, 
            'percentage' => $percentage,
            'level' => $level,
            'level_description' => $level_description,
            'created_at' => now(),
            'updated_at' => now(),
        ];
       
        // Check if the result already exists for the user and dimension
        $existingResult = DB::table('user_results')
            ->where('user_id', $user_id)
            ->where('job_id', $position_id)
            ->where('assessment_type', $assessment_type)
            ->where('result_type', $result_type)
            ->where('name', $dimension)
            ->first();

        if ($existingResult) {
            // Update existing record
            DB::table('user_results')
                ->where('id', $existingResult->id)
                ->update($data);
        } else {
            // Insert new record
            DB::table('user_results')->insert($data);
        }
    }
} 
