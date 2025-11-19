<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Job;
use App\Helpers\AssessmentHelper;
use App\Models\JobOpeningApplication;
use App\Models\JobOpening;

class UpdateArbitraryAssessmentReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assessment:update-arbitrary-reports {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the arbitrary assessment report for a specific user';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where('is_personality_motivation_completed',1)->where('is_work_interest_completed',1)
        ->where('is_cognitive_ability_completed',1)->where('company_id', 3)->where('id', '>', 1500)->get();
        // $users = User::whereIn('id', [2499, 3443])->get(); whereIn('id', [2499, 3443]) ->whereNotIn('id', [3466,3469,3499,4494, 4525, 4546]) where('company_id', 3)->whereNotNull('position_id')-> join('jobs', 'users.position_id', '=', 'jobs.id')-> ->select('users.*', 'jobs.title')
        $this->info($users->count());
        $i = 0;
        $stats = config('helpers.stats');
        $i = 1;
        // Fetch master descriptors from the database
        $descriptors = DB::table('master_descriptors')->get();
        foreach($users as $user) {
            $user_id = $user->id;
            $this->info($i);
            $this->info($user_id);
            $i = $i + 1;
            if($user_id) {
                $user = User::find($user_id);
                $user_type = $user->role_name ?? 'employee';
                $dimension = 'Technical';
    
                $score = $user->tech_skill_score ?? 0;
    
                if (!($score) && ($user->role_name == 'candidate')) {
                    $job_application = JobOpeningApplication::where('user_id', $user_id)->first();
                    $score = $job_application->tech_skill_score ?? 0;
                }
                
                if ($score >= 90) {
                    $level_description = 'very high';
                    $level = 5;
                } elseif ($score >= 70 && $score < 90) {
                    $level_description = 'high';
                    $level = 4;
                } elseif ($score >= 60 && $score < 70) {
                    $level_description = 'moderate';
                    $level = 3;
                } elseif ($score >= 45 && $score < 60) {
                    $level_description = 'low';
                    $level = 2;
                } else {
                    if($user->technical_assessment_completed) {
                        $level = 1;
                        $level_description = 'very low';
                    } else {
                        $level = 0;
                        $level_description = 'Technical Assessment Not Completed';
                    }
                }
    
                $descriptor = $descriptors->where('assessment_type', 'technical')->where('result_type', 'overall')->where('slug',Str::slug($dimension))->where('user_type', $user_type)->where('user_score_level', $level)->first() ?? '';
    
                $description = $descriptor->analysis ?? '';
                $descriptor_id = $descriptor->id ?? '';
    
                $data = [
                    'user_id' => $user_id,
                    'assessment_type' => 'technical',
                    'result_type' => 'overall',
                    'name' => $dimension,
                    'slug' => Str::slug($dimension),
                    'code' => substr($dimension, 0, 1),
                    'descriptor_id' => $descriptor_id ?? '',
                    'description' => $description ?? '',
                    'score' => $score,
                    'z_score' => 0,
                    'percentage' => $score,
                    'level' => $level,
                    'level_description' => $level_description,
                    'created_at' => now(),
                    'updated_at' => now(),
                    ];
    
                // Check if the result already exists for the user and dimension
                $existingResult = DB::table('user_results')
                                ->where('user_id', $user_id)
                                ->where('assessment_type', 'technical')
                                ->where('result_type', 'overall')
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
                // Overall Match Rate
    
                if ($score) {
                    $overall_match_rate = 0.7*($user->tech_skill_score) + 0.3*($user->soft_skill_score);
                } else {
                    $overall_match_rate = 0.3*($user->soft_skill_score);
                }
    
                $user->match_rate = $overall_match_rate;
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

                if(!$user->technical_assessment_completed) {
                    $level = 0;
                    $level_description = 'Technical Assessment Not Completed';
                }
    
                $descriptor = $descriptors->where('assessment_type', 'all')->where('result_type', 'overall_match_rate')->where('slug',Str::slug($dimension))->where('user_type', $user_type)->where('user_score_level', $level)->first() ?? '';
    
                $description = $descriptor->analysis ?? '';
                $descriptor_id = $descriptor->id ?? '';
    
                // Prepare data for insertion or update
                $data = [
                    'user_id' => $user_id,
                    'assessment_type' => 'all',
                    'result_type' => 'overall_match_rate',
                    'name' => $dimension,
                    'slug' => Str::slug($dimension), 
                    'code' => substr($dimension, 0, 1), 
                    'descriptor_id' => $descriptor_id ?? '',
                    'description' => $description ?? '',
                    'score' => $overall_match_rate, 
                    'z_score' => 0, 
                    'percentage' => $overall_match_rate,
                    'level' => $level,
                    'level_description' => $level_description,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
    
                // Check if the result already exists for the user and dimension
                $existingResult = DB::table('user_results')
                    ->where('user_id', $user_id)
                    ->where('assessment_type', 'all')
                    ->where('result_type', 'overall_match_rate')
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
                $user->save();
    
            } else {
               $this->info("I am in else");
            }
        }

        // foreach ($users as $user) {
        //     $user_id = $user->id;
        //     $domains = [
        //         'openness' => [
        //             ['pair_no' => 1, 'positive_item' => 127, 'negative_item' => 187],
        //             ['pair_no' => 2, 'positive_item' => 157, 'negative_item' => 217],
        //             ['pair_no' => 3, 'positive_item' => 132, 'negative_item' => 162],
        //             ['pair_no' => 4, 'positive_item' => 142, 'negative_item' => 202],
        //         ],
        //         'conscientiousness' => [
        //             ['pair_no' => 5, 'positive_item' => 124, 'negative_item' => 184],
        //             ['pair_no' => 6, 'positive_item' => 129, 'negative_item' => 219],
        //             ['pair_no' => 7, 'positive_item' => 164, 'negative_item' => 194],
        //             ['pair_no' => 8, 'positive_item' => 134, 'negative_item' => 224],
        //         ],
        //        'extraversion' => [
        //             ['pair_no' => 9, 'positive_item' => 116, 'negative_item' => 176],
        //             ['pair_no' => 10, 'positive_item' => 146, 'negative_item' => 206],
        //             ['pair_no' => 11, 'positive_item' => 121, 'negative_item' => 211],
        //             ['pair_no' => 12, 'positive_item' => 156, 'negative_item' => 216],
        //         ],
        //         'agreeableness' => [
        //             ['pair_no' => 13, 'positive_item' => 118, 'negative_item' => 208],
        //             ['pair_no' => 14, 'positive_item' => 158, 'negative_item' => 188],
        //             ['pair_no' => 15, 'positive_item' => 128, 'negative_item' => 218],
        //             ['pair_no' => 16, 'positive_item' => 173, 'negative_item' => 203],
        //         ],
        //         'neuroticism' => [
        //             ['pair_no' => 17, 'positive_item' => 150, 'negative_item' => 210],
        //             ['pair_no' => 18, 'positive_item' => 155, 'negative_item' => 215],
        //             ['pair_no' => 19, 'positive_item' => 135, 'negative_item' => 165],
        //             ['pair_no' => 20, 'positive_item' => 140, 'negative_item' => 230]
        //         ]
        //     ];

        //     $domainConsistency = [];

        //     // Loop through each domain to evaluate consistency
        //     foreach ($domains as $domainName => $pairs) {
        //         $consistentPairs = 0;
        //         $totalPairs = count($pairs);

        //         foreach ($pairs as $pair) {
        //             $positiveResponse = DB::table('quiz_domain_value_answers')
        //                 ->where('user_id', $user_id)
        //                 ->where('quiz_domain_value_question_id', $pair['positive_item'])
        //                 ->value('answer');

        //             $negativeResponse = DB::table('quiz_domain_value_answers')
        //                 ->where('user_id', $user_id)
        //                 ->where('quiz_domain_value_question_id', $pair['negative_item'])
        //                 ->value('answer');

        //             // Check consistency based on given criteria
        //             if ((in_array($positiveResponse, [1, 2]) && in_array($negativeResponse, [1, 2])) ||
        //                 (in_array($positiveResponse, [4, 5]) && in_array($negativeResponse, [4, 5])) ||
        //                 (($positiveResponse == 3) && ($negativeResponse == 3))) {
        //                 $consistentPairs++;
        //             }
        //         }

        //         // Calculate domain-level RCI and percentage
        //         $rci = $consistentPairs / $totalPairs;
        //         $percentage = $rci * 100;

        //         // Determine domain consistency
        //         $isConsistent = $percentage > 34.1;
        //         // $domainConsistency[$domainName] = $isConsistent ? 'Consistent' : 'Not Consistent';
        //         $domainConsistency[$domainName] = $percentage;
        //     }
        //     dd($domainConsistency);
        //     // Count consistent and not consistent domains
        //     $notConsistentDomains = count(array_filter($domainConsistency, fn($status) => $status === 'Not Consistent'));
        //     $consistentDomains = count($domainConsistency) - $notConsistentDomains;

        //     // Determine overall consistency status
        //     if ($notConsistentDomains >= 2) {
        //         $level = 0;
        //         $level_description = 'Not Consistent';
        //     } elseif ($notConsistentDomains === 1) {
        //         $level = 1;
        //         $level_description = 'Somewhat Consistent';
        //     } else {
        //         $level = 2;
        //         $level_description = 'Consistent';
        //     }
        // }

        // foreach ($users as $user) {
        //     $user_id = $user->id;
        //     $userResults = DB::table('user_results')->where('user_id', $user_id)->get();

        //     foreach($userResults as $result) {
        //        $descriptor = DB::table('master_descriptors')->where('result_type', $result->result_type)->where('assessment_type', $result->assessment_type)->where('name', $result->name)->where('user_type', strtolower($user->role_name))->where('user_score_level', $result->level)->first();
               
        //        $result->description = $descriptor->analysis;
        //        $result->save();

        //        dd($result);
        //     }
        // }
        // foreach ($users as $user) {
        //     $user_id = $user->id;
        
        //     // Fetch all user results in a single query
        //     $userResults = DB::table('user_results')->where('user_id', $user_id)->get();
        
        //     // Prepare an array of result types and assessment types to batch fetch descriptors
        //     $resultTypes = $userResults->pluck('result_type')->unique()->toArray();
        //     $assessmentTypes = $userResults->pluck('assessment_type')->unique()->toArray();
        //     $names = $userResults->pluck('name')->unique()->toArray();
        //     $userType = strtolower($user->role_name);
        //     $scoreLevels = $userResults->pluck('level')->unique()->toArray();
        
        //     // Fetch all matching descriptors in one query
        //     $descriptors = DB::table('master_descriptors')
        //                 ->whereIn('result_type', $resultTypes)
        //                 ->whereIn('assessment_type', $assessmentTypes)
        //                 ->whereIn('name', $names)
        //                 ->where('user_type', $userType)
        //                 ->whereIn('user_score_level', $scoreLevels)
        //                 ->where('result_type', '!=', 'top_3_riasec')
        //                 ->get()
        //                 ->keyBy(function ($descriptor) {
        //                     return $descriptor->result_type . '_' . $descriptor->assessment_type . '_' . $descriptor->slug . '_' . $descriptor->user_score_level;
        //                 });
        
        //     // Update user results in bulk
        //     foreach ($userResults as $result) {
        //         $key = $result->result_type . '_' . $result->assessment_type . '_' . $result->slug . '_' . $result->level;
        
        //         // Check if the descriptor exists for the given result
        //         if (isset($descriptors[$key])) {
        //             $descriptor = $descriptors[$key];
        
        //             // Update the description field for the result
        //             DB::table('user_results')
        //                 ->where('id', $result->id)
        //                 ->update(['description' => $descriptor->analysis]);
        //         }
        //     }
        // }
        
        // foreach ($users as $user) {
        //         $user_id = $user->id;
        //         $i = $i + 1;
        //         $this->info($i);
        //         // RCI Ocean Reliability
            
        //     // Assume you have an array of domains and their associated pairs
        //     $domains = [
        //         'openness' => [
        //             ['pair_no' => 1, 'positive_item' => 127, 'negative_item' => 187],
        //             ['pair_no' => 2, 'positive_item' => 157, 'negative_item' => 217],
        //             ['pair_no' => 3, 'positive_item' => 132, 'negative_item' => 162],
        //             ['pair_no' => 4, 'positive_item' => 142, 'negative_item' => 202],
        //         ],
        //         'conscientiousness' => [
        //             ['pair_no' => 5, 'positive_item' => 124, 'negative_item' => 184],
        //             ['pair_no' => 6, 'positive_item' => 129, 'negative_item' => 219],
        //             ['pair_no' => 7, 'positive_item' => 164, 'negative_item' => 194],
        //             ['pair_no' => 8, 'positive_item' => 134, 'negative_item' => 224],
        //         ],
        //        'extraversion' => [
        //             ['pair_no' => 9, 'positive_item' => 116, 'negative_item' => 176],
        //             ['pair_no' => 10, 'positive_item' => 146, 'negative_item' => 206],
        //             ['pair_no' => 11, 'positive_item' => 121, 'negative_item' => 211],
        //             ['pair_no' => 12, 'positive_item' => 156, 'negative_item' => 216],
        //         ],
        //         'agreeableness' => [
        //             ['pair_no' => 13, 'positive_item' => 118, 'negative_item' => 208],
        //             ['pair_no' => 14, 'positive_item' => 158, 'negative_item' => 188],
        //             ['pair_no' => 15, 'positive_item' => 128, 'negative_item' => 218],
        //             ['pair_no' => 16, 'positive_item' => 173, 'negative_item' => 203],
        //         ],
        //         'neuroticism' => [
        //             ['pair_no' => 17, 'positive_item' => 150, 'negative_item' => 210],
        //             ['pair_no' => 18, 'positive_item' => 155, 'negative_item' => 215],
        //             ['pair_no' => 19, 'positive_item' => 135, 'negative_item' => 165],
        //             ['pair_no' => 20, 'positive_item' => 140, 'negative_item' => 230]
        //         ]
        //     ];

        //     $domainConsistency = [];

        //     $responses = [];
        //     // Loop through each domain to evaluate consistency
        //     foreach ($domains as $domainName => $pairs) {
        //         $consistentPairs = 0;
        //         $totalPairs = count($pairs);

        //         foreach ($pairs as $pair) {
        //             $positiveResponse = DB::table('quiz_domain_value_answers')
        //                 ->where('user_id', $user_id)
        //                 ->where('quiz_domain_value_question_id', $pair['positive_item'])
        //                 ->value('answer');

        //             $responses['positive'][$pair['positive_item']] = $positiveResponse;
        //             $negativeResponse = DB::table('quiz_domain_value_answers')
        //                 ->where('user_id', $user_id)
        //                 ->where('quiz_domain_value_question_id', $pair['negative_item'])
        //                 ->value('answer');
        //             $responses['negative'][$pair['negative_item']] = $negativeResponse;
        //             // Check consistency based on given criteria
        //             if ((in_array($positiveResponse, [1, 2]) && in_array($negativeResponse, [1, 2])) ||
        //                 (in_array($positiveResponse, [4, 5]) && in_array($negativeResponse, [4, 5])) ||
        //                 (($positiveResponse == 3) && ($negativeResponse == 3))) {
        //                 $consistentPairs++;
        //             }
        //         }

        //         // Calculate domain-level RCI and percentage
        //         $rci = $consistentPairs / $totalPairs;
        //         $percentage = $rci * 100;

        //         // Determine domain consistency
        //         $isConsistent = $percentage > 34.1;
        //         $domainConsistency[$domainName] = $isConsistent ? 'Consistent' : 'Not Consistent';
        //         // $domainConsistency[$domainName] = $percentage;
        //     }
        //     // Count consistent and not consistent domains
        //     $notConsistentDomains = count(array_filter($domainConsistency, fn($status) => $status === 'Not Consistent'));
        //     $consistentDomains = count($domainConsistency) - $notConsistentDomains;

        //     // Determine overall consistency status
        //     if ($notConsistentDomains >= 2) {
        //         $level = 0;
        //         $level_description = 'Not Consistent';
        //     } elseif ($notConsistentDomains === 1) {
        //         $level = 1;
        //         $level_description = 'Somewhat Consistent';
        //     } else {
        //         $level = 2;
        //         $level_description = 'Consistent';
        //     }
        //     $dimension = 'RCI';
        //     // Prepare data for insertion or update
        //     $data = [
        //         'user_id' => $user_id,
        //         'assessment_type' => 'ocean',
        //         'result_type' => 'rci',
        //         'name' => $dimension,
        //         'slug' => Str::slug($dimension),
        //         'code' => substr($dimension, 0, 1),
        //         'score' => $consistentDomains,
        //         'z_score' => 0,
        //         'percentage' => ($consistentDomains / 5)*100, // Migration for this change not ran yet
        //         'level' => $level,
        //         'level_description' => $level_description,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];

        //     // Check if the result already exists for the user and dimension
        //     $existingResult = DB::table('user_results')
        //         ->where('user_id', $user_id)
        //         ->where('assessment_type', 'ocean')
        //         ->where('result_type', 'rci')
        //         ->where('name', $dimension)
        //         ->first();

        //     if ($existingResult) {
        //         // Update existing record
        //         DB::table('user_results')
        //             ->where('id', $existingResult->id)
        //             ->update($data);
        //     } else {
        //         // Insert new record
        //         DB::table('user_results')->insert($data);
        //     }


        // }

        
    }

        // Function to calculate z-score
        private function calculateZScore($score, $mean, $sd) {
            return ($score - $mean) / $sd;
        }
    
        // Function to convert z-score to percentage using the normal CDF
        private function zScoreToPercent($z) {
            // Constants
            $sqrt2 = sqrt(2);
        
            // Calculate the cumulative distribution function (CDF) for a normal distribution
            $percent = (1 + $this->erf($z / $sqrt2)) / 2;
        
            // Convert to percentage
            return round($percent*100,4);
        }
        
        private function erf($x) {
            // Constants for approximation
            $a1 =  0.254829592;
            $a2 = -0.284496736;
            $a3 =  1.421413741;
            $a4 = -1.453152027;
            $a5 =  1.061405429;
            $p  =  0.3275911;
        
            // Save the sign of x
            $sign = ($x >= 0) ? 1 : -1;
            $x = abs($x);
        
            // Approximation formula
            $t = 1.0 / (1.0 + $p * $x);
            $y = 1.0 - ((((($a5 * $t + $a4) * $t) + $a3) * $t + $a2) * $t + $a1) * $t * exp(-$x * $x);
        
            return $sign * $y;
        }
    
        // Function to get level from score
        private function getLevel($score, $ranges) {
            foreach ($ranges as $level => $range) {
                if ($score > $range[0] && $score <= $range[1]) {
                    return $level;
                }
            }
            return null;
        }
}

//  // PPR
//                         // $userTop3Riasec 
//                         $riasecOceanArray = [
//                             'R' => [
//                                 'openness-to-experience' => null,
//                                 'conscientiousness' => 'high',
//                                 'extraversion' => 'low',
//                                 'agreeableness' => 'low',
//                                 'emotional-stability' => null,
//                             ],
//                             'I' => [
//                                 'openness-to-experience' => 'high',
//                                 'conscientiousness' => 'high',
//                                 'extraversion' => null,
//                                 'agreeableness' => null,
//                                 'emotional-stability' => 'high',
//                             ],
//                             'A' => [
//                                 'openness-to-experience' => 'high',
//                                 'conscientiousness' => 'low',
//                                 'extraversion' => null,
//                                 'agreeableness' => null,
//                                 'emotional-stability' => 'high',
//                             ],
//                             'S' => [
//                                 'openness-to-experience' => null,
//                                 'conscientiousness' => null,
//                                 'extraversion' => 'high',
//                                 'agreeableness' => 'high',
//                                 'emotional-stability' => 'high',
//                             ],
//                             'E' => [
//                                 'openness-to-experience' => null,
//                                 'conscientiousness' => 'high',
//                                 'extraversion' => 'high',
//                                 'agreeableness' => 'high',
//                                 'emotional-stability' => null,
//                             ],
//                             'C' => [
//                                 'openness-to-experience' => null,
//                                 'conscientiousness' => 'high',
//                                 'extraversion' => null,
//                                 'agreeableness' => 'low',
//                                 'emotional-stability' => 'low',
//                             ],
//                         ];
            
//                         $oceanSavedResults = DB::table('user_results')->where('assessment_type', 'ocean')->where('result_type', 'domains')->get();
            
//                         $oceanResults = [];
            
//                         foreach($oceanSavedResults as $result) {
//                             $level = '';
//                             if (($result->level_description == 'very high') ||  ($result->level_description == 'high')) {
//                                 $level = 'high';
//                             } elseif (($result->level_description == 'very low') ||  ($result->level_description == 'low')) {
//                                 $level = 'low';
//                             } else {
//                                 $level = 'moderate';
//                             }
            
//                             $oceanResults[$result->slug] = $level;
//                         }
            
//                         $matchCount = 0; // Initialize match count
//                         $riasecMatchCounts = [];
            
//                         foreach ($userTop3Riasec as $riasec) {
//                             // Get the corresponding RIASEC-OCEAN array for the current RIASEC type
//                             $riasecOcean = $riasecOceanArray[$riasec];
                            
//                             foreach ($riasecOcean as $trait => $expectedLevel) {
//                                 // Only proceed if the expected level is not null
//                                 if ($expectedLevel !== null && isset($oceanResults[$trait])) {
//                                     // Compare the expected level with the actual OCEAN result
//                                     if ($expectedLevel === $oceanResults[$trait]) {
//                                         $matchCount++; // Increment the match count if they match
//                                     }
//                                 }
//                             }
            
//                             $riasecMatchCounts[$riasec] = $matchCount / 3;
//                         }
            
//                         $ppr = 0;
            
//                         foreach ($userTop3Riasec as $riasec) {
//                             if (isset($userSingleJmrResult) && isset($userSingleJmrResult[$riasec])) {
//                                 $ppr = $ppr + (($userSingleJmrResult[$riasec])*($riasecMatchCounts[$riasec]))*100;
//                             }
                            
//                         }
            
//                         $dimension = 'Performance Predictive Rate';

//                         if ($ppr > 98) {
//                             $level_description = 'very high';
//                             $level = 5;
//                         } elseif ($ppr > 84 && $ppr <= 98) {
//                             $level_description = 'high';
//                             $level = 4;
//                         } elseif ($ppr >= 16 && $ppr <= 84) {
//                             $level_description = 'moderate';
//                             $level = 3;
//                         } elseif ($ppr >= 2 && $ppr < 16) {
//                             $level_description = 'low';
//                             $level = 2;
//                         } else {
//                             $level_description = 'very low';
//                             $level = 1;
//                         }

//                         $descriptor = $descriptors->where('assessment_type', 'all')->where('result_type', 'ppr')->where('slug',Str::slug($dimension))->where('user_type', $user_type)->where('user_score_level', $level)->first() ?? '';
                        
//                         $description = $descriptor->analysis ?? '';
//                         $descriptor_id = $descriptor->id ?? '';

//                         // Prepare data for insertion or update
//                         $data = [
//                             'user_id' => $user_id,
//                             'assessment_type' => 'all',
//                             'result_type' => 'ppr',
//                             'name' => $dimension,
//                             'slug' => Str::slug($dimension),
//                             'code' => substr($dimension, 0, 1),
//                             'descriptor_id' => $descriptor_id ?? '',
//                             'description' => $description ?? '',
//                             'score' => $ppr, 
//                             'z_score' => 0,
//                             'percentage' => $ppr,
//                             'level' => $level,
//                             'level_description' => $level_description,
//                             'created_at' => now(),
//                             'updated_at' => now(),
//                         ];
            
//                         // Check if the result already exists for the user and dimension
//                         $existingResult = DB::table('user_results')
//                         ->where('user_id', $user_id)
//                         ->where('assessment_type', 'all')
//                         ->where('result_type', 'ppr')
//                         ->where('name', $dimension)
//                         ->first();
            
//                         if ($existingResult) {
//                             // Update existing record
//                             DB::table('user_results')
//                                 ->where('id', $existingResult->id)
//                                 ->update($data);
//                         } else {
//                             // Insert new record
//                             DB::table('user_results')->insert($data);
//                         }  
