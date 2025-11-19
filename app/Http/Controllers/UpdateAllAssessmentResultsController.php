<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\UserResult;

class UpdateAllAssessmentResultsController extends Controller
{


    public function updateReportsForSingleUser(Request $request, $user_id) {

        $user = User::find($user_id);

        if($user) {
                // OCEAN domains
                $results = DB::table('quiz_domain_value_answers')
                    ->join('quiz_domain_value_questions', 'quiz_domain_value_answers.quiz_domain_value_question_id', '=', 'quiz_domain_value_questions.id')
                    ->join('quiz_domain_values', 'quiz_domain_value_questions.quiz_domain_value_id', '=', 'quiz_domain_values.id')
                    ->where('quiz_domain_value_answers.user_id', $user_id)
                    ->where('quiz_domain_values.id', '>', 24)
                    ->where('quiz_domain_values.id', '<=', 29)
                    ->select(
                        'quiz_domain_values.title as name',
                        'quiz_domain_values.id as quiz_domain_value_id'
                    )
                    ->selectRaw('ROUND((SUM(quiz_domain_value_answers.answer) / 120) * 5, 2) as answer_avg')
                    ->groupBy('quiz_domain_values.title', 'quiz_domain_values.id')
                    ->get();
                    
                $oceanSelfResult = [];
                $oceanSelfResult['Openness to Experience'] = 0;
                $oceanSelfResult['Conscientiousness'] = 0;
                $oceanSelfResult['Extraversion'] = 0;
                $oceanSelfResult['Agreeableness'] = 0;
                $oceanSelfResult['Emotional Stability'] = 0;
    
                foreach ($results as $result) {
                    $oceanSelfResult[$result->name] =  $result->answer_avg;
                }

                foreach ($oceanSelfResult as $dimension => $score) {
                        $level = 1;
                        $level_description = '';
    
                        // Determine the level based on the percentage
                        if ($score > 4.2) {
                            $level_description = 'very high';
                            $level = 5;
                        } elseif ($score > 3.4 && $score <= 4.2) {
                            $level_description = 'high';
                            $level = 4;
                        } elseif ($score >= 2.6 && $score <= 3.4) {
                            $level_description = 'moderate';
                            $level = 3;
                        } elseif ($score >= 1.84 && $score < 2.6) {
                            $level_description = 'low';
                            $level = 2;
                        } else {
                            $level_description = 'very low';
                            $level = 1;
                        }

                        $percentage = ($score / 5)*100;
    
                        $this->transactionInDb($user_id,'ocean','domains',$dimension,$score,$percentage,$level,$level_description);                              
                }

                // Learning & Development Plan
                $ldPlan['Visual & Kinesthetic'] = ($oceanSelfResult['Openness to Experience'] + $oceanSelfResult['Agreeableness']) / 2;
                $ldPlan['Aural'] = $oceanSelfResult['Extraversion'];
                $ldPlan['Reading & Writing'] = $oceanSelfResult['Conscientiousness'];


                foreach ($ldPlan as $dimension => $score) {
                    $level = 1;
                    $level_description = '';

                    // Determine the level based on the percentage
                    if ($score > 3.75) {
                        $level_description = 'Preferred';
                        $level = 1;
                    } else {
                        $level_description = 'Not Preferred';
                        $level = 0;
                    }

                    $percentage = ($score / 5)*100;

                    $this->transactionInDb($user_id,'ocean','learning_development_plan',$dimension,$score,$percentage,$level,$level_description);                              
            }


                // Ocean All facets

                // Define the conditions for each facet in an array
                $facetConditions = [
                    'Daydreaming' => [117, 147, 177, 207],
                    'Aesthetic Appreciation' => [122, 152, 182, 212],
                    'Feeling Aware' => [127, 157, 187, 217],
                    'Explorer' => [132, 162, 192, 222],
                    'Innovation' => [137, 167, 197, 227],
                    'Open-Mindedness' => [142, 172, 202, 232],
                    'Self-Confidence' => [119, 149, 179, 209],
                    'Tidiness' => [124, 154, 184, 214],
                    'Responsibility' => [129, 159, 189, 219],
                    'Drive to Achieve' => [134, 164, 194, 224],
                    'Willpower' => [139, 169, 199, 229],
                    'Careful Thinking' => [144, 174, 204, 234],
                    'Sociability' => [116, 146, 176, 206],
                    'Crowd Enjoyment' => [121, 151, 181, 211],
                    'Confidence' => [126, 156, 186, 216],
                    'Energetic Lifestyle' => [131, 161, 191, 221],
                    'Thrill Seeking' => [136, 166, 196, 226],
                    'Optimism' => [141, 171, 201, 231],
                    'Belief' => [118, 148, 178, 208],
                    'Honesty' => [123, 153, 183, 213],
                    'Helpfulness' => [128, 158, 188, 218],
                    'Diplomacy' => [133, 163, 193, 223],
                    'Humility' => [138, 168, 198, 228],
                    'Compassion' => [143, 173, 203, 233],
                    'Steadiness' => [115, 145, 175, 205],
                    'Tolerance' => [120, 150, 180, 210],
                    'Positivity' => [125, 155, 185, 215],
                    'Social Sensitivity' => [130, 160, 190, 220],
                    'Impulse Control' => [135, 165, 195, 225],
                    'Stress Response' => [140, 170, 200, 230],
                ];
    
                $allFacetsForGP = [];
                // Loop through each facet to calculate averages, z-scores, and insert/update results
                foreach ($facetConditions as $facet => $questionIds) {
                    // Fetch the average answer for the current facet
                    $facetAvg = DB::table('quiz_domain_value_answers')
                        ->where('user_id', $user_id)
                        ->whereIn('quiz_domain_value_question_id', $questionIds)
                        ->avg('answer');
    
                    if ($facetAvg !== null) {
                            $level = 1;
                            $level_description = '';
    
                            // Determine the level based on the percentage
                            if ($score > 4.2) {
                                $level_description = 'very high';
                                $level = 5;
                            } elseif ($score > 3.4 && $score <= 4.2) {
                                $level_description = 'high';
                                $level = 4;
                            } elseif ($score >= 2.6 && $score <= 3.4) {
                                $level_description = 'moderate';
                                $level = 3;
                            } elseif ($score >= 1.84 && $score < 2.6) {
                                $level_description = 'low';
                                $level = 2;
                            } else {
                                $level_description = 'very low';
                                $level = 1;
                            }
    
                            $percentage = ($facetAvg / 5)*100;

                            $this->transactionInDb($user_id,'ocean','all_facets',$dimension,$score,$percentage,$level,$level_description);
    
                            $allFacetsForGP[$data['name']] = $data['score'];
                        
                    }
                }

                // GP (Growth Potential)
                $gpScore = (($allFacetsForGP['Innovation'] 
                            + $allFacetsForGP['Explorer']
                            + $allFacetsForGP['Daydreaming'] 
                            + $allFacetsForGP['Drive to Achieve'] 
                            + $allFacetsForGP['Willpower'] 
                            + $allFacetsForGP['Self-Confidence'] 
                            + $allFacetsForGP['Confidence'] 
                            + $allFacetsForGP['Thrill Seeking'] 
                            + $allFacetsForGP['Helpfulness'] 
                            + $allFacetsForGP['Diplomacy'] 
                            + $allFacetsForGP['Steadiness'] 
                            + $allFacetsForGP['Impulse Control'] 
                            + $allFacetsForGP['Stress Response']) / 13);
                
                $dimension = 'Growth Potential';
                $level = 1;
                $level_description = '';

                // Determine the level based on the percentage
                if ($score > 4.2) {
                    $level_description = 'very high';
                    $level = 5;
                } elseif ($score > 3.4 && $score <= 4.2) {
                    $level_description = 'high';
                    $level = 4;
                } elseif ($score >= 2.6 && $score <= 3.4) {
                    $level_description = 'moderate';
                    $level = 3;
                } elseif ($score >= 1.84 && $score < 2.6) {
                    $level_description = 'low';
                    $level = 2;
                } else {
                    $level_description = 'very low';
                    $level = 1;
                }

                $percentage = ($gpScore / 5)*100;
    
                $this->transactionInDb($user_id,'ocean','growth_potential',$dimension,$score,$percentage,$level,$level_description);

                // Flight Risk
                $dimension = 'Flight Risk';

                $flight_score = ($allFacetsForGP['Daydreaming'] 
                                + $allFacetsForGP['Aesthetic Appreciation'] 
                                + $allFacetsForGP['Innovation'] 
                                + $allFacetsForGP['Responsibility'] 
                                + $allFacetsForGP['Belief'] 
                                + $allFacetsForGP['Steadiness'] 
                                + $allFacetsForGP['Tolerance'] 
                                + $allFacetsForGP['Positivity'] 
                                + $allFacetsForGP['Social Sensitivity'] 
                                + $allFacetsForGP['Impulse Control'] 
                                + $allFacetsForGP['Stress Response']) / 11;
    
                    $level = 0;
                    $level_description = '';

                    // Determine the level based on the percentage
                    if ($score > 4.2) {
                        $level_description = 'very high';
                        $level = 5;
                    } elseif ($score > 3.4 && $score <= 4.2) {
                        $level_description = 'high';
                        $level = 4;
                    } elseif ($score >= 2.6 && $score <= 3.4) {
                        $level_description = 'moderate';
                        $level = 3;
                    } elseif ($score >= 1.84 && $score < 2.6) {
                        $level_description = 'low';
                        $level = 2;
                    } else {
                        $level_description = 'very low';
                        $level = 1;
                    }
                
                $percentage = ($score / 5)*100;
    
                $this->transactionInDb($user_id,'ocean','flight_risk',$dimension,$score,$percentage,$level,$level_description);
    
                // Workplace Alignment Forecast (Organizational Fit Foreacast)   
                $dimension = 'Organizational Fit Forecast';
                
                // Narcissism   
                $narcissism = ($allFacetsForGP['Feeling Aware']
                                + $allFacetsForGP['Explorer']
                                + $allFacetsForGP['Daydreaming']
                                + $allFacetsForGP['Open-Mindedness']
                                + $allFacetsForGP['Innovation']
                                + $allFacetsForGP['Responsibility']
                                + $allFacetsForGP['Drive to Achieve']
                                + $allFacetsForGP['Willpower']
                                + $allFacetsForGP['Honesty']
                                + $allFacetsForGP['Diplomacy']
                                + $allFacetsForGP['Humility']
                                + $allFacetsForGP['Compassion']
                                + $allFacetsForGP['Crowd Enjoyment']
                                + $allFacetsForGP['Confidence']
                                + $allFacetsForGP['Energetic Lifestyle']
                                + $allFacetsForGP['Thrill Seeking']
                                + $allFacetsForGP['Optimism']
                                + $allFacetsForGP['Steadiness']
                                + $allFacetsForGP['Tolerance']
                                + $allFacetsForGP['Positivity']
                                + $allFacetsForGP['Social Sensitivity']
                                + $allFacetsForGP['Impulse Control']
                                + $allFacetsForGP['Stress Response']
                                ) / 23;
    
                // Machiavellianism   
                $machiavellianism = ($allFacetsForGP['Open-Mindedness']
                                            + $allFacetsForGP['Explorer']
                                            + $allFacetsForGP['Responsibility']
                                            + $allFacetsForGP['Drive to Achieve']
                                            + $allFacetsForGP['Willpower']
                                            + $allFacetsForGP['Self-Confidence']
                                            + $allFacetsForGP['Careful Thinking']
                                            + $allFacetsForGP['Tidiness']
                                            + $allFacetsForGP['Honesty']
                                            + $allFacetsForGP['Diplomacy']
                                            + $allFacetsForGP['Humility']
                                            + $allFacetsForGP['Compassion']
                                            + $allFacetsForGP['Belief']
                                            + $allFacetsForGP['Helpfulness']
                                            + $allFacetsForGP['Sociability']
                                            + $allFacetsForGP['Confidence']
                                            + $allFacetsForGP['Thrill Seeking']
                                            + $allFacetsForGP['Optimism']
                                            + $allFacetsForGP['Steadiness']
                                            + $allFacetsForGP['Tolerance']
                                            + $allFacetsForGP['Positivity']
                                            + $allFacetsForGP['Social Sensitivity']
                                            + $allFacetsForGP['Impulse Control']
                                            + $allFacetsForGP['Stress Response']
                                    ) / 24;
                
                // Psychopathy   
                $psychopathy =  ($allFacetsForGP['Feeling Aware']
                                    + $allFacetsForGP['Daydreaming']
                                    + $allFacetsForGP['Responsibility']
                                    + $allFacetsForGP['Drive to Achieve']
                                    + $allFacetsForGP['Willpower']
                                    + $allFacetsForGP['Self-Confidence']
                                    + $allFacetsForGP['Careful Thinking']
                                    + $allFacetsForGP['Tidiness']
                                    + $allFacetsForGP['Honesty']
                                    + $allFacetsForGP['Diplomacy']
                                    + $allFacetsForGP['Humility']
                                    + $allFacetsForGP['Compassion']
                                    + $allFacetsForGP['Belief']
                                    + $allFacetsForGP['Helpfulness']
                                    + $allFacetsForGP['Sociability']
                                    + $allFacetsForGP['Thrill Seeking']
                                    + $allFacetsForGP['Optimism']
                                    + $allFacetsForGP['Tolerance']
                                    + $allFacetsForGP['Positivity']
                                    + $allFacetsForGP['Impulse Control']
                                    + $allFacetsForGP['Stress Response']
                                ) / 21;
    
                $dark_triads_score = ($narcissism + $machiavellianism + $psychopathy) / 3;
                $score = $dark_triads_score;
                $percentage = ($score / 5)*100;
                
                $level = 0;
                $level_description = '';
    
                // Determine the level based on the percentage
                if ($score > 4.2) {
                    $level_description = 'very low';
                    $level = 5;
                } elseif ($score > 3.4 && $score <= 4.2) {
                    $level_description = 'low';
                    $level = 4;
                } elseif ($score >= 2.6 && $score <= 3.4) {
                    $level_description = 'moderate';
                    $level = 3;
                } elseif ($score >= 1.84 && $score < 2.6) {
                    $level_description = 'high';
                    $level = 2;
                } else {
                    $level_description = 'very high';
                    $level = 1;
                }
    
                $this->transactionInDb($user_id,'ocean','organizational_fit_forecast',$dimension,$score,$percentage,$level,$level_description);
        
                // PPR (Performance Predictive Rate)
                $dimension = 'Performance Predictive Rate';

                $score = $oceanSelfResult['Conscientiousness'];

                $percentage = ($score / 5)*100;
    
                $level = 0;
                $level_description = '';

                // Determine the level based on the percentage
                if ($score > 4.2) {
                    $level_description = 'very high';
                    $level = 5;
                } elseif ($score > 3.4 && $score <= 4.2) {
                    $level_description = 'high';
                    $level = 4;
                } elseif ($score >= 2.6 && $score <= 3.4) {
                    $level_description = 'moderate';
                    $level = 3;
                } elseif ($score >= 1.84 && $score < 2.6) {
                    $level_description = 'low';
                    $level = 2;
                } else {
                    $level_description = 'very low';
                    $level = 1;
                }
    
                $this->transactionInDb($user_id,'ocean','ppr',$dimension,$score,$percentage,$level,$level_description);

                // Ocean Reliability
                $dimension = 'Ocean Reliability';
                // Define the question pairs structure as per your data
                $questionPairs = [
                    // Example structure based on your image, replace with actual pairs
                    ['pair_no' => 1, 'positive_item' => 127, 'negative_item' => 187],
                    ['pair_no' => 2, 'positive_item' => 157, 'negative_item' => 217],
                    ['pair_no' => 3, 'positive_item' => 132, 'negative_item' => 162],
                    ['pair_no' => 4, 'positive_item' => 142, 'negative_item' => 202],
                    ['pair_no' => 5, 'positive_item' => 124, 'negative_item' => 184],
                    ['pair_no' => 6, 'positive_item' => 129, 'negative_item' => 219],
                    ['pair_no' => 7, 'positive_item' => 164, 'negative_item' => 194],
                    ['pair_no' => 8, 'positive_item' => 134, 'negative_item' => 224],
                    ['pair_no' => 9, 'positive_item' => 116, 'negative_item' => 176],
                    ['pair_no' => 10, 'positive_item' => 146, 'negative_item' => 206],
                    ['pair_no' => 11, 'positive_item' => 121, 'negative_item' => 211],
                    ['pair_no' => 12, 'positive_item' => 156, 'negative_item' => 216],
                    ['pair_no' => 13, 'positive_item' => 118, 'negative_item' => 208],
                    ['pair_no' => 14, 'positive_item' => 158, 'negative_item' => 188],
                    ['pair_no' => 15, 'positive_item' => 128, 'negative_item' => 218],
                    ['pair_no' => 16, 'positive_item' => 173, 'negative_item' => 203],
                    ['pair_no' => 17, 'positive_item' => 150, 'negative_item' => 210],
                    ['pair_no' => 18, 'positive_item' => 155, 'negative_item' => 215],
                    ['pair_no' => 19, 'positive_item' => 135, 'negative_item' => 165],
                    ['pair_no' => 20, 'positive_item' => 140, 'negative_item' => 230]
                ];
    
                $consistentPairs = 0;
    
                // Loop through each pair to evaluate consistency
                foreach ($questionPairs as $pair) {
                    $positiveResponse = DB::table('quiz_domain_value_answers')
                        ->where('user_id', $user_id)
                        ->where('quiz_domain_value_question_id', $pair['positive_item'])
                        ->value('answer');
    
                    $negativeResponse = DB::table('quiz_domain_value_answers')
                        ->where('user_id', $user_id)
                        ->where('quiz_domain_value_question_id', $pair['negative_item'])
                        ->value('answer');
    
                    // Check consistency based on the given criteria
                    if ((in_array($positiveResponse, [1, 2]) && in_array($negativeResponse, [1, 2])) ||
                        (in_array($positiveResponse, [4, 5]) && in_array($negativeResponse, [4, 5])) || (($positiveResponse == 3) && ($negativeResponse == 3))){
                        $consistentPairs++;
                    }
                }
    
                $totalPairs = count($questionPairs);
                // Calculate Reliability and percentage
                $score = $consistentPairs;
                $percentage = ($consistentPairs / $totalPairs)*100;
    
                // Determine consistency status
                $level_description = $percentage > 68.2 ? 'Consistent' : 'Consistent To Some Extent';
                $level = $percentage > 68.2 ? 1 : 0;

                $this->transactionInDb($user_id,'ocean','ocean_reliability',$dimension,$score,$percentage,$level,$level_description);

                // CCS 
                $results = DB::table('quiz_domain_value_answers as qdva')->select(
                    'u.name',
                    'qdva.user_id',
                    DB::raw('(SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (123, 153, 183, 213) THEN answer ELSE 0 END) * 5 + SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (127, 157, 187, 217) THEN answer ELSE 0 END) * 5) / 2 AS "Developing People"'),
                    DB::raw('SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (137, 167, 197, 227) THEN answer ELSE 0 END) * 5 AS "Learning Agility"'),
                    DB::raw('(SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (140, 170, 200, 230) THEN answer ELSE 0 END) * 5 + SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (121, 151, 181, 211) THEN answer ELSE 0 END) * 5 + SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (116, 146, 176, 206) THEN answer ELSE 0 END) * 5) / 3 AS "Adaptability"'),
                    DB::raw('(SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (115, 145, 175, 205) THEN answer ELSE 0 END) * 5 + SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (125, 155, 185, 215) THEN answer ELSE 0 END) * 5 + SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (124, 154, 184, 214) THEN answer ELSE 0 END) * 5) / 3 AS "Self Management"'),
                    DB::raw('(SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (120, 150, 180, 210) THEN answer ELSE 0 END) * 5 + SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (135, 165, 195, 225) THEN answer ELSE 0 END) * 5 + SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (130, 160, 190, 220) THEN answer ELSE 0 END) * 5) / 3 AS "Collaboration"'),
                    DB::raw('(SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (126, 156, 186, 216) THEN answer ELSE 0 END) * 5 + SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (141, 171, 201, 231) THEN answer ELSE 0 END) * 5) / 2 AS "Influence"'),
                    DB::raw('(SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (122, 152, 182, 212) THEN answer ELSE 0 END) * 5 + SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (136, 166, 196, 226) THEN answer ELSE 0 END) * 5) / 2 AS "Creative Thinking"'),
                    DB::raw('(SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (139, 169, 199, 229) THEN answer ELSE 0 END) * 5 + SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (131, 161, 191, 221) THEN answer ELSE 0 END) * 5) / 2 AS "Sense Making"'),
                    DB::raw('SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (127, 157, 187, 217) THEN answer ELSE 0 END) * 5 AS "Communication"'),
                    DB::raw('SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (132, 162, 192, 222) THEN answer ELSE 0 END) * 5 AS "Transdisciplinary Thinking"'),
                    DB::raw('(SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (142, 172, 202, 232) THEN answer ELSE 0 END) * 5 + SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (144, 174, 204, 234) THEN answer ELSE 0 END) * 5) / 2 AS "Decision Making"'),
                    DB::raw('SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (117, 147, 177, 207) THEN answer ELSE 0 END) * 5 AS "Digital Fluency"'),
                    DB::raw('(SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (138, 168, 198, 228) THEN answer ELSE 0 END) * 5 + SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (118, 148, 178, 208) THEN answer ELSE 0 END) * 5) / 2 AS "Global Perspective"'),
                    DB::raw('(SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (129, 159, 189, 219) THEN answer ELSE 0 END) * 5 + SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (158, 128, 188, 218) THEN answer ELSE 0 END) * 5) / 2 AS "Customer Orientation"'),
                    DB::raw('(SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (143, 173, 203, 233) THEN answer ELSE 0 END) * 5 + SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (164, 134, 224, 194) THEN answer ELSE 0 END) * 5) / 2 AS "Building Inclusivity"'),
                    DB::raw('SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (119, 149, 179, 209) THEN answer ELSE 0 END) * 5 AS "Problem Solving"')
                )->join('users as u', 'qdva.user_id', '=', 'u.id')
                ->where('qdva.user_id', $user_id) // Apply the user_id condition
                ->groupBy('qdva.user_id', 'u.name')
                ->first(); // Retrieve the first result
    
                // Define default values for the competency categories
                $ccsResult = [
                    'Developing People' => 0,
                    'Learning Agility' => 0,
                    'Adaptability' => 0,
                    'Self Management' => 0,
                    'Collaboration' => 0,
                    'Influence' => 0,
                    'Creative Thinking' => 0,
                    'Sense Making' => 0,
                    'Communication' => 0,
                    'Transdisciplinary Thinking' => 0,
                    'Decision Making' => 0,
                    'Digital Fluency' => 0,
                    'Global Perspective' => 0,
                    'Customer Orientation' => 0,
                    'Building Inclusivity' => 0,
                    'Problem Solving' => 0,
                ];
    
                // Map the results into the competency categories
                foreach ($results as $dimension => $value) {
                    if (isset($ccsResult[$dimension])) {
                        $ccsResult[$dimension] = $value;
                    }
                }

                // Loop through each competency dimension to insert or update the database
                foreach ($ccsResult as $dimension => $score) {
    
                    // Determine the performance level based on the percentage
                    $level = 0;
                    $level_description = '';
                    $percentage = $score;
                    $score = $score / 5;

                    // Determine the level based on the percentage
                    if ($score > 4.2) {
                        $level_description = 'very high';
                        $level = 5;
                    } elseif ($score > 3.4 && $score <= 4.2) {
                        $level_description = 'high';
                        $level = 4;
                    } elseif ($score >= 2.6 && $score <= 3.4) {
                        $level_description = 'moderate';
                        $level = 3;
                    } elseif ($score >= 1.84 && $score < 2.6) {
                        $level_description = 'low';
                        $level = 2;
                    } else {
                        $level_description = 'very low';
                        $level = 1;
                    }
    
                    $this->transactionInDb($user_id,'ocean','ccs',$dimension,$score,$percentage,$level,$level_description);
                }
                // RIASEC

                // RIASEC Domains

                // Define the work interest categories with default values
                $workInterestResult = [
                    'Realistic' => 0,
                    'Investigative' => 0,
                    'Artistic' => 0,
                    'Social' => 0,
                    'Enterprising' => 0,
                    'Conventional' => 0,
                ];
    
                // Fetch the RIASEC results
                $results = DB::table('quiz_domain_value_answers')
                    ->join('quiz_domain_value_questions', 'quiz_domain_value_answers.quiz_domain_value_question_id', '=', 'quiz_domain_value_questions.id')
                    ->join('quiz_domain_values', 'quiz_domain_value_questions.quiz_domain_value_id', '=', 'quiz_domain_values.id')
                    ->where('quiz_domain_value_answers.user_id', $user_id)
                    ->whereBetween('quiz_domain_values.id', [19, 24]) // Equivalent to "id > 18 and id <= 24"
                    ->select('quiz_domain_values.title as name', 'quiz_domain_values.id as quiz_domain_value_id')
                    ->selectRaw('ROUND((SUM(quiz_domain_value_answers.answer) / 40) * 100, 2) as percentage')
                    ->groupBy('quiz_domain_values.title', 'quiz_domain_values.id')
                    ->orderBy('percentage')
                    ->get();
                    
                // Map the results to the respective work interest categories
                foreach ($results as $result) {
                    $workInterestResult[$result->name] = $result->percentage;
                }
    
                // Loop through each RIASEC dimension to insert or update the database
                foreach ($workInterestResult as $dimension => $percentage) {
                    $score = $percentage / 20;
                    $level = 1;
                    $level_description = '';
                    // Determine the level based on the percentage
                    if ($score > 4.2) {
                        $level_description = 'very high';
                        $level = 5;
                    } elseif ($score > 3.4 && $score <= 4.2) {
                        $level_description = 'high';
                        $level = 4;
                    } elseif ($score >= 2.6 && $score <= 3.4) {
                        $level_description = 'moderate';
                        $level = 3;
                    } elseif ($score >= 1.84 && $score < 2.6) {
                        $level_description = 'low';
                        $level = 2;
                    } else {
                        $level_description = 'very low';
                        $level = 1;
                    }

                    $this->transactionInDb($user_id,'riasec','domains',$dimension,$score,$percentage,$level,$level_description);
                    
                }

                // Top 3 RIASEC
                $top_names_first_letters =$this->getTop3RIASECFull($results);
                $top_names_first_letters_based_on_score =$this->getTop3RIASECFullBasedOnScore($results);
    
                // $top3Riasec = DB::table('master_top_3_riasec_descriptions')->where('top_3_riasec', 'like', "%$top_names_first_letters%")->first();
                $top3Riasec = DB::table('master_top_3_riasec_descriptions')->where('top_3_riasec', $top_names_first_letters)->first();
        
                $workInterestResult['top_3_riasec'] = $top_names_first_letters_based_on_score ?? '';
                $workInterestResult['top_3_riasec_description'] = $top3Riasec->description ?? '';
                $userTop3Riasec = str_split($top_names_first_letters_based_on_score);
    
                $data = [
                    'user_id' => $user_id,
                    'assessment_type' => 'riasec', // Assuming 'facet' as assessment type
                    'result_type' => 'top_3_riasec', // Fixed as per your requirement
                    'name' => 'Top 3 Riasec',
                    'slug' => Str::slug('Top 3 Riasec'), // Slug for the facet name
                    'code' => substr($top_names_first_letters_based_on_score, 0, 1), // First letter of the facet name
                    'description' =>  $top3Riasec->description ?? '',
                    'level_description' => $top_names_first_letters_based_on_score
                ];
    
                // Check if the result already exists for the user and dimension
                $existingResult = DB::table('user_results')
                    ->where('user_id', $user_id)
                    ->where('assessment_type', 'riasec')
                    ->where('result_type', 'top_3_riasec')
                    ->where('name', 'Top 3 Riasec')
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

                // Cognitive 
                // Overall & Domains

                $results = DB::table('quiz_domain_value_answers')
                            ->join('quiz_domain_value_questions', 'quiz_domain_value_answers.quiz_domain_value_question_id', '=', 'quiz_domain_value_questions.id')
                            ->join('quiz_domain_values', 'quiz_domain_value_questions.quiz_domain_value_id', '=', 'quiz_domain_values.id')
                            ->where('quiz_domain_value_answers.user_id', $user_id)
                            ->where('quiz_domain_value_questions.quiz_domain_value_id', '>', 69)
                            ->select(
                                'quiz_domain_values.title as name',
                                'quiz_domain_values.id as quiz_domain_value_id',
                                DB::raw('SUM(quiz_domain_value_answers.answer) as total_marks')
                            )
                            ->groupBy('quiz_domain_values.title', 'quiz_domain_values.id')
                            ->get();
    
                $cognitiveResult = [];
                $cognitiveResult['Critical Thinking'] = 0;
                $cognitiveResult['Numerical Reasoning'] = 0;
                $cognitiveResult['Decision Making'] = 0;
                $cognitiveResult['Verbal Fluency '] = 0;

                $score = 0;

                foreach ($results as $res) {
                    $cognitiveResult[$res->name] = $res->total_marks;
                    $score = $score + $res->total_marks;
                }

                $dimension = 'Cognitive';

                $percentage = min(100, ($score / 48)*100);

                if ($score >= 72) {
                    $level = 3;
                    $level_description = 'high';
                } elseif (($score >= 33) && ($score < 72)) {
                    $level = 2;
                    $level_description = 'moderate';
                } else {
                    $level = 1;
                    $level_description = 'low';
                }

                $this->transactionInDb($user_id,'cognitive','overall',$dimension,$score,$percentage,$level,$level_description);
                
                // Domains
                
                foreach ($cognitiveResult as $dimension => $domainTotalMarks) { 
                    $score = $domainTotalMarks;
                    $percentage = min(100, ($domainTotalMarks / 25)*100);

                    if ($domainTotalMarks >= 15) {
                        $level = 3;
                        $level_description = 'high';
                    } elseif (($domainTotalMarks >= 6) && ($domainTotalMarks < 15)) {
                        $level = 2;
                        $level_description = 'moderate';
                    } else {
                        $level = 1;
                        $level_description = 'low';
                    }

                    $this->transactionInDb($user_id,'cognitive','domains',$dimension,$score,$percentage,$level,$level_description);
                }



        } else {
            return "Please use a correct user_id which exists in the db";
        }

    }

    private function transactionInDb($user_id,$assessment_type,$result_type,$dimension,$score,$percentage,$level,$level_description) {
                
        // Prepare data for insertion or update
        $data = [
            'user_id' => $user_id,
            'assessment_type' => $assessment_type,
            'result_type' => $result_type,
            'name' => $dimension,
            'slug' => Str::slug($dimension),
            'code' => substr($dimension, 0, 1),
            'score' => $score,
            'z_score' => 0,
            'percentage' => $percentage,
            'level' => $level,
            'level_description' => $level_description,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Check if the result already exists for the user and dimension
        $existingResult = DB::table('user_results')
            ->where('user_id', $user_id)
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

    private function getTop3RIASECFull($workInterestResults,$isPopulation=0) {
        $workInterestArray = $workInterestResults->toArray();
        // Sort the data based on percentage in descending order
              
        if($isPopulation){
            usort($workInterestArray, function($a, $b) {
                return $b->answer_avg_population <=> $a->answer_avg_population;
            });
        } else {
            usort($workInterestArray, function($a, $b) {
                return $b->percentage <=> $a->percentage;
            });
        }
        // Extract the first letter of the top 3 names and concatenate them
        $top_names_first_letters = '';
        
        foreach (array_slice($workInterestArray, 0, 3) as $entry) {
            $top_names_first_letters .= substr($entry->name, 0, 1);
        }
        
        // Sorting based on letter RIASEC
        $riasec_values = [
            'R' => 1,
            'I' => 2,
            'A' => 3,
            'S' => 4,
            'E' => 5,
            'C' => 6
        ];

        $top_names_first_letters_array = str_split($top_names_first_letters);
        // Sort the letters based on their RIASEC values
        usort($top_names_first_letters_array, function($a, $b) use ($riasec_values) {
            return $riasec_values[$a] <=> $riasec_values[$b];
        });
        
        $top_names_first_letters = implode('', $top_names_first_letters_array);

        return $top_names_first_letters;
    }

    private function getTop3RIASECFullBasedOnScore($workInterestResults,$isPopulation=0) {
        $workInterestArray = $workInterestResults->toArray();
        // Sort the data based on percentage in descending order
              
        if($isPopulation){
            usort($workInterestArray, function($a, $b) {
                return $b->answer_avg_population <=> $a->answer_avg_population;
            });
        } else {
            usort($workInterestArray, function($a, $b) {
                return $b->percentage <=> $a->percentage;
            });
        }
        // Extract the first letter of the top 3 names and concatenate them
        $top_names_first_letters = '';
        
        foreach (array_slice($workInterestArray, 0, 3) as $entry) {
            $top_names_first_letters .= substr($entry->name, 0, 1);
        }

        return $top_names_first_letters;
    }

}