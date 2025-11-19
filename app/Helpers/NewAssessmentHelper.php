<?php
namespace App\Helpers;

use App\Models\MasterSkill;
use App\Models\SkillReview;
use App\Models\SkillReviewDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\UserResult;
use App\Services\Tsmr\TsmrCalculationService;

class NewAssessmentHelper {

    // minus round down value, if remaining is less than 0.5, return floor value, else return ceiling value
    private static function customRound($value) {
        return ($value - floor($value) < 0.5) ? floor($value) : ceil($value);
    }

    private static function ordinal($number): string
    {
        $number = (int) $number;
        $suffix = 'th';

        if (!in_array(($number % 100), [11, 12, 13])) {
            switch ($number % 10) {
                case 1:  $suffix = 'st'; break;
                case 2:  $suffix = 'nd'; break;
                case 3:  $suffix = 'rd'; break;
            }
        }

        return $number . $suffix;
    }

    public static function getFormattedUserResults($results, $assessmentType, $resultType,$userType='employee', $descriptors=[], $jobId=0, $isPopulation=0){
        if ($isPopulation) {
            // Later
        } else {
             // In-memory filtering based on assessment_type and result_type
             if ($assessmentType) {
                 $results = $results->where('assessment_type', $assessmentType);
             }
 
             if ($resultType) {
                 $results = $results->where('result_type', $resultType);
             }
 
             if ($jobId !== 0) {
                 $results = $results->where('job_id', $jobId);
             }
 
             // Format the results in the required structure 
             $formattedResults = $results->mapWithKeys(function ($result) use ($descriptors, $userType) {
                 
                 // if($result->result_type == 'ccs') {
                 //    if ($result->score > 98) {
                 //        $result->level = 3;
                 //    } elseif ($result->score >=84 && $result->score <=98) {
                 //        $result->level = 2;
                 //    } elseif ($result->score >= 50){
                 //        $result->level = 1;
                 //    } else {
                 //        $result->level = 0;
                 //    }
                 // } 
 
                 if($descriptors) {
                     if (($result->assessment_type == 'ocean') && ($result->result_type == 'domains')) { 
                         if(($result->level == 2) || ($result->level == 4)){     
                             // ->skip(1)
                             $description = $descriptors->where('slug',$result->slug)->where('user_type', $userType)->where('user_score_level', $result->level)->skip(1)->first()->analysis ?? '';
                             if ($description == '') {
                                 $description = $descriptors->where('slug',$result->slug)->where('user_type', $userType)->where('user_score_level', $result->level)->first()->analysis ?? '';
                             }
                         } else{
                             $description = $descriptors->where('slug',$result->slug)->where('user_type', $userType)->where('user_score_level', $result->level)->first()->analysis ?? '';
                         }
                     }
                     elseif(($result->assessment_type == 'ocean') && ($result->result_type == 'ccs') && ($result->level == 0)) {
                             $description = $descriptors->where('slug',$result->slug)->where('user_type', $userType)->whereNotNull('job_requirement_level')->where('job_requirement_level', '!=', 0)->where('user_score_level', $result->level)->first()->analysis ?? '';
                     } 
                     else {
                         $description = $descriptors->where('slug',$result->slug)->where('user_type', $userType)->whereNotNull('user_score_level')->where('user_score_level', '=', $result->level)->first()->analysis ?? '';
                     }
 
                     if($result->result_type == 'personality_type') {
                         $result->level_description = $descriptors->where('result_type', 'personality_type')->where('code', $result->code)->first()->analysis ?? '';
                     }
                 } else {
                     $description = $result->description ?? '';
                 }
 
                 if($result->result_type == 'top_3_riasec') {
                     $description = preg_replace('/\b[A-Z]{3}\b/', $result->level_description, $description, 1);
                 }
 
 
                 if (!empty($description)) {
                     $highlightPhrases = [
                         'signify great potential',
                         'strong foundation',
                         'a balanced capacity',
                         'a strong ability',
                         'an exceptional ability',
                         'very low risk',
                         'low risk',
                         'moderate risk',
                         'high risk',
                         'very high risk',
                         'very low potential flight risk',
                         'low potential flight risk',
                         'moderate flight risk',
                         'high flight risk',
                         'very high flight risk',
                         'perfect alignment',
                         'strong alignment',
                         'moderate alignment',
                         'limited alignment',
                         'poor alignment',
                         'exceptional leadership potential',
                         'high leadership potential',
                         'moderate leadership potential',
                         'developing leadership potential',
                         'very low leadership potential'
                     ];
                 
                     usort($highlightPhrases, function ($a, $b) {
                         return strlen($b) - strlen($a); // Sort by length descending to avoid partial matches
                     });
                 
                     foreach ($highlightPhrases as $phrase) {
                         $escaped = preg_quote($phrase, '/');
                         $description = preg_replace_callback("/\b($escaped)\b/i", function ($matches) {
                             return '<span style="color: #f7931e;">' . $matches[0] . '</span>';
                         }, $description);
                     }
                 }
                 $level_description = $result->level_description;
                 if (!empty($level_description)) {
                     $highlightPhrases = [
                         'Leadership Skills',
                         'Communication',
                         'Social Skills',
                         'Resourcefulness',
                         'Innovative Thinking',
                         'Problem-Solving',
                         'Team Players',
                         'Willingness to Learn'
                     ];
                 
                     usort($highlightPhrases, function ($a, $b) {
                         return strlen($b) - strlen($a); // Sort by length descending to avoid partial matches
                     });
                 
                     foreach ($highlightPhrases as $phrase) {
                         $escaped = preg_quote($phrase, '/');
                         $level_description = preg_replace_callback("/\b($escaped)\b/i", function ($matches) {
                             return '<span style="color: #f7931e;">' . $matches[0] . '</span>';
                         }, $level_description);
                     }
                 }
                 
                 
                 
                 // apply round to score and percentage, then store in variable that can be used
                 if (($result->assessment_type == 'ocean') && ($result->result_type == 'domains')) {
                     $roundedScore = $result->score;
                 } else {
                     $roundedScore = self::customRound($result->score);
                 }
                 
                 $scorePercentage = ($result->score / 5) * 100;
 
                 $roundedPercentage = self::customRound($result->percentage);
                 $percentageWithLabel = self::ordinal($roundedPercentage);
                 return [
                     $result->slug => [
                         'name' => $result->name,
                         'assessment_type' => $result->assessment_type,
                         'result_type' => $result->result_type,
                         'code' => $result->code,
                         'score' => $roundedScore,
                         'score_percentage' => isset($scorePercentage) ? self::customRound($scorePercentage) : 0,
                         'z_score' => $result->z_score,
                         'percentage' => $roundedPercentage,
                         'percentage_with_label' => $percentageWithLabel,
                         'level' => $result->level,
                         'level_description' => $level_description,
                         'description' => $description,
                         'slug' => $result->slug
                     ],
                 ];
             });
 
             return $formattedResults;
        }
    }
 

    public static function getOceanSummary($oceanDomainResults, $userType) {

        if ($userType == 'admin') {
            $oceanSummary = '';
            $domains = ['openness-to-experience', 'conscientiousness', 'extraversion', 'agreeableness', 'emotional-stability'];
            $oceanDomainResults = $oceanDomainResults->toArray();
            uasort($oceanDomainResults, function ($a, $b) {
                return ($b['level'] ?? 0) <=> ($a['level'] ?? 0);
            });
    
            foreach ($domains as $domain) {
                if (!empty($oceanDomainResults[$domain])) {
                    $oceanSummary .= ' ' . config('helpers.ocean_summary_descriptors_admin')[$oceanDomainResults[$domain]['slug']][$oceanDomainResults[$domain]['level']];
                }
            }
            if ($oceanSummary == "     ") {
                $oceanSummary = 'No significant OCEAN summary can be derived as all levels are identical.';
            }
        } else {
            $oceanSummary = '';
            $oceanDomainResults = $oceanDomainResults->toArray();
            uasort($oceanDomainResults, function ($a, $b) {
                return ($b['score'] ?? 0) <=> ($a['score'] ?? 0);
            });
            
            // Get the scores as an array
            $scores = array_column($oceanDomainResults, 'score');
            
            // Check if all scores are the same
            if (!empty($scores) && count(array_unique($scores)) === 1) {
                // All scores are the same
                $oceanSummary = 'No significant OCEAN summary can be derived as all levels are identical.';
            } else {
                $highestScore = reset($scores); // Get the first score after sorting (highest)
                $lowestScore = end($scores);   // Get the last score after sorting (lowest)
            
                $highestItems = [];
                $lowestItems = [];
            
                // Collect all items with the highest score
                foreach ($oceanDomainResults as $item) {
                    if (($item['score'] ?? null) === $highestScore) {
                        $highestItems[] = $item;
                    } else {
                        break; // Stop since items are sorted in descending order
                    }
                }
            
                // Collect all items with the lowest score
                foreach (array_reverse($oceanDomainResults) as $item) {
                    if (($item['score'] ?? null) === $lowestScore) {
                        $lowestItems[] = $item;
                    } else {
                        break; // Stop since items are sorted in ascending order
                    }
                }
            
                // Generate the summary based on descriptors
                if (!empty($highestItems) && !empty($lowestItems)) {
                    $highestDescriptions = array_map(function ($item) {
                        return config('helpers.ocean_summary_descriptors_employee')[$item['slug']][5];
                    }, $highestItems);
            
                    $lowestDescriptions = array_map(function ($item) {
                        return config('helpers.ocean_summary_descriptors_employee')[$item['slug']][1];
                    }, $lowestItems);
            
                    $oceanSummary .= ' ' . implode(', ', $highestDescriptions) . ' ' . implode(', ', $lowestDescriptions);
                }
            }
        }
        

        return $oceanSummary;
    }

    public static function updateOceanResults($user_id, $user, $job_opening_id, $job, $position_id, $user_type, $descriptors, $stats) {
        // OCEAN Domains            
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
        
        $oceanCheckResult = $results;
        // Fetch all existing results for the user beforehand
        $existingResults = HelperFunctions::getExistingResults( $user_id, 'ocean', 'domains', 'name', 'all');

        $insertData = [];
        $updateData = [];
        
        foreach ($oceanSelfResult as $dimension => $score) {
            if (isset($stats[$dimension])) {
                $mean = $stats[$dimension]['mean'];
                $sd = $stats[$dimension]['sd'];

                // Calculate the z-score
                $z_score = HelperFunctions::calculateZScore($score, $mean, $sd);

                // Convert the z-score to percentage
                $percentage = HelperFunctions::zScoreToPercent($z_score);

                [$level, $level_description] = HelperFunctions::getLevel($percentage, 'percentile');
                
                [$description, $descriptor_id] = HelperFunctions::getDescriptor('ocean', 'domains', $dimension, $level, $descriptors);

                // Prepare data for insertion or update
                $data = HelperFunctions::prepareData($user_id, 'ocean', 'domains', $dimension, $descriptor_id, $description, $score, $z_score, $percentage, $level, $level_description);
                
                // Check if the result already exists in the pre-fetched results
                if (isset($existingResults[$dimension])) {
                    // Collect data for update (keeping ID for reference)
                    $updateData[] = ['id' => $existingResults[$dimension]->id] + $data;
                } else {
                    // Collect data for insert
                    $insertData[] = $data;
                }
            }
        }
        
        HelperFunctions::bulkTransactionsInDb($insertData, $updateData);

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

        // Fetch all the necessary answers in a single query
        $facetAnswers = DB::table('quiz_domain_value_answers')
            ->where('user_id', $user_id)
            ->whereIn('quiz_domain_value_question_id', array_merge(...array_values($facetConditions)))
            ->select('quiz_domain_value_question_id', DB::raw('AVG(answer) as avg_answer'))
            ->groupBy('quiz_domain_value_question_id')
            ->get();

        // Prepare the averages based on question IDs
        $facetAverages = [];
        foreach ($facetConditions as $facet => $questionIds) {
            $facetAverages[$facet] = $facetAnswers->whereIn('quiz_domain_value_question_id', $questionIds)->avg('avg_answer');
        }

        $allFacetsForGP = [];

        // Fetch all existing results for the user beforehand
        $existingResults = HelperFunctions::getExistingResults( $user_id, 'ocean', 'all_facets', 'name', 'all');

        $insertData = [];
        $updateData = [];
        
        foreach ($facetConditions as $facet => $questionIds) {
            $facetAvg = $facetAverages[$facet] ?? null;

            if ($facetAvg !== null && isset($stats[$facet])) {
                $mean = $stats[$facet]['mean'];
                $sd = $stats[$facet]['sd'];

                // Calculate the z-score
                $z_score = HelperFunctions::calculateZScore($facetAvg, $mean, $sd);

                // Convert the z-score to percentage
                $percentage = HelperFunctions::zScoreToPercent($z_score);
                [$level, $level_description] = HelperFunctions::getLevel($percentage, 'percentile');
                
                [$description, $descriptor_id] = HelperFunctions::getDescriptor('ocean', 'all_facets', $facet, $level, $descriptors);

                // Prepare data for insertion or update
                $data = HelperFunctions::prepareData($user_id, 'ocean', 'all_facets', $facet, $descriptor_id, $description, $facetAvg, $z_score, $percentage, $level, $level_description);
               
                $allFacetsForGP[$data['name']] = $data['score'];

                // Check if the result already exists in the pre-fetched results
                if (isset($existingResults[$facet])) {
                    // Collect data for update (keeping ID for reference)
                    $updateData[] = ['id' => $existingResults[$facet]->id] + $data;
                } else {
                    // Collect data for insert
                    $insertData[] = $data;
                }
            }
        }

        HelperFunctions::bulkTransactionsInDb($insertData, $updateData);

        // All Star
        $allStarResults = [
            'Have empathy and respect' => ($allFacetsForGP['Social Sensitivity'] + $allFacetsForGP['Impulse Control'] + $allFacetsForGP['Stress Response'] + $allFacetsForGP['Positivity']) / 4,
            'Keep it simple' => ($allFacetsForGP['Steadiness'] + $allFacetsForGP['Innovation'] + $allFacetsForGP['Tidiness']) / 3,
            'All for One, One for All' => ($allFacetsForGP['Tolerance'] + $allFacetsForGP['Crowd Enjoyment'] + $allFacetsForGP['Sociability'] + $allFacetsForGP['Helpfulness']) / 4,
            'Celebrate all individuals' => ($allFacetsForGP['Optimism'] + $allFacetsForGP['Feeling Aware'] + $allFacetsForGP['Compassion']) / 3,
            'Make a difference' => ($allFacetsForGP['Confidence'] + $allFacetsForGP['Open-Mindedness'] + $allFacetsForGP['Drive to Achieve'] + $allFacetsForGP['Self-Confidence']) / 4,
            'Dare to dream' => ($allFacetsForGP['Energetic Lifestyle'] + $allFacetsForGP['Thrill Seeking'] + $allFacetsForGP['Explorer'] + $allFacetsForGP['Aesthetic Appreciation'] + $allFacetsForGP['Daydreaming']) / 5,
            'Be transparent' => ($allFacetsForGP['Diplomacy'] + $allFacetsForGP['Humility'] + $allFacetsForGP['Belief'] + $allFacetsForGP['Honesty']) / 4,
            'Safety #1' => ($allFacetsForGP['Careful Thinking'] + $allFacetsForGP['Responsibility']  + $allFacetsForGP['Willpower']) / 3,
        ];

        // Fetch all existing results for the user beforehand
        $existingResults = HelperFunctions::getExistingResults($user_id, 'ocean', 'all_star', 'name', 'all');

        $insertData = [];
        $updateData = [];

        foreach ($allStarResults as $dimension => $score) {
            // Fetch mean and standard deviation for Z-score calculation
            $mean = $stats[$dimension]['mean'];
            $sd = $stats[$dimension]['sd'];

            // Calculate Z-score
            $z_score = HelperFunctions::calculateZScore($score, $mean, $sd);

            // Convert Z-score to percentage
            $percentage = HelperFunctions::zScoreToPercent($z_score); // Assumes a normal distribution (-3 to +3)

            [$level, $level_description] = HelperFunctions::getLevel($z_score, 'skill');
                
            [$description, $descriptor_id] = HelperFunctions::getDescriptor('ocean', 'all_star', $dimension, $level, $descriptors);

            // Prepare data for insertion or update
            $data = HelperFunctions::prepareData($user_id, 'ocean', 'all_star', $dimension, $descriptor_id, $description, $score, $z_score, $percentage, $level, $level_description);

            // Check if the result already exists in the pre-fetched results
            if (isset($existingResults[$dimension])) {
                // Collect data for update (keeping ID for reference)
                $updateData[] = ['id' => $existingResults[$dimension]->id] + $data;
            } else {
                // Collect data for insert
                $insertData[] = $data;
            }
        }

        HelperFunctions::bulkTransactionsInDb($insertData, $updateData);

        // JGSOC Values
        $jgsocValuesResults = [
            'Stewardship Mindset' => ($allFacetsForGP['Responsibility'] + $allFacetsForGP['Helpfulness'] + $allFacetsForGP['Honesty']) / 3,
            'Entrepreneurial Mindset' => ($allFacetsForGP['Drive to Achieve'] + $allFacetsForGP['Stress Response'] + $allFacetsForGP['Explorer']) / 3,
            'Malasakit' => ($allFacetsForGP['Helpfulness'] + $allFacetsForGP['Responsibility'] + $allFacetsForGP['Humility']) / 3,
            'Integrity'  => ($allFacetsForGP['Honesty'] + $allFacetsForGP['Open-Mindedness'] + $allFacetsForGP['Responsibility']) / 3
        ];

        // Fetch all existing results for the user beforehand
        $existingResults = HelperFunctions::getExistingResults($user_id, 'ocean', 'values', 'name', 'all');

        $insertData = [];
        $updateData = [];

        foreach ($jgsocValuesResults as $dimension => $score) {
            // Fetch mean and standard deviation for Z-score calculation
            $mean = $stats[$dimension]['mean'];
            $sd = $stats[$dimension]['sd'];

            // Calculate Z-score
            $z_score = HelperFunctions::calculateZScore($score, $mean, $sd);

            // Convert Z-score to percentage
            $percentage = HelperFunctions::zScoreToPercent($z_score);

            [$level, $level_description] = HelperFunctions::getLevel($z_score, 'skill');
                
            [$description, $descriptor_id] = HelperFunctions::getDescriptor('ocean', 'values', $dimension, $level, $descriptors);

            // Prepare data for insertion or update
            $data = HelperFunctions::prepareData($user_id, 'ocean', 'values', $dimension, $descriptor_id, $description, $score, $z_score, $percentage, $level, $level_description);

            // Check if the result already exists in the pre-fetched results
            if (isset($existingResults[$dimension])) {
                // Collect data for update (keeping ID for reference)
                $updateData[] = ['id' => $existingResults[$dimension]->id] + $data;
            } else {
                // Collect data for insert
                $insertData[] = $data;
            }
        }

        HelperFunctions::bulkTransactionsInDb($insertData, $updateData);

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
                    + $allFacetsForGP['Stress Response']) / 65)*100;

        $mean = $stats['Growth Potential']['mean'];
        $sd = $stats['Growth Potential']['sd'];
        
        $dimension = 'Growth Potential';
        $z_score = HelperFunctions::calculateZScore($gpScore, $mean, $sd);
        $percentage = HelperFunctions::zScoreToPercent($z_score);

        // Determine the performance level based on the percentage
        [$level, $level_description] = HelperFunctions::getLevel($percentage, 'percentile');
                
        [$description, $descriptor_id] = HelperFunctions::getDescriptor('ocean', 'growth_potential', $dimension, $level, $descriptors);

        // Prepare data for insertion or update
        $data = HelperFunctions::prepareData($user_id, 'ocean', 'growth_potential', $dimension, $descriptor_id, $description, $gpScore, $z_score, $percentage, $level, $level_description);

        $existingResult = HelperFunctions::getExistingResults($user_id, 'ocean', 'growth_potential', 'name', 'single');

        HelperFunctions::singleTransactionInDb($existingResult, $data);
        $gpPercentage = $percentage;
        // $user->gp_percentage = $percentage;

        // CCS
        // Fetch the work competency results
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

        // Fetch all existing results for the user beforehand
        $existingResults = HelperFunctions::getExistingResults($user_id, 'ocean', 'ccs', 'name', 'all');

        $insertData = [];
        $updateData = [];
        $ccsResultWithLevel = [];
        $ccsResultWithLevelRaw = [];

        // Loop through each competency dimension to prepare for insertion or update
        foreach ($ccsResult as $dimension => $score) {
            // Fetch mean and standard deviation for Z-score calculation
            $mean = $stats[$dimension]['mean'];
            $sd = $stats[$dimension]['sd'];

            // Calculate Z-score
            $z_score = HelperFunctions::calculateZScore($score, $mean, $sd);

            // Convert Z-score to percentage
            $percentage = HelperFunctions::zScoreToPercent($z_score); // Assumes a normal distribution (-3 to +3)

            [$level, $level_description] = HelperFunctions::getLevel($z_score, 'skill');
                
            [$description, $descriptor_id] = HelperFunctions::getDescriptor('ocean', 'ccs', $dimension, $level, $descriptors);

            // Prepare data for insertion or update
            $data = HelperFunctions::prepareData($user_id, 'ocean', 'ccs', $dimension, $descriptor_id, $description, $score, $z_score, $percentage, $level, $level_description);


            // Check if the result already exists in the pre-fetched results
            if (isset($existingResults[$dimension])) {
                // Collect data for update (keeping ID for reference)
                $updateData[] = ['id' => $existingResults[$dimension]->id] + $data;
            } else {
                // Collect data for insert
                $insertData[] = $data;
            }

            if ($score >= 80) {
                $levelRaw = 3;
            } elseif (($score >= 50) && ($score < 80)) {
                $levelRaw = 2;
            } elseif (($score > 20) && ($score < 50)) {
                $levelRaw = 1;
            } else {
                $levelRaw = 0;
            }
            $ccsResultWithLevel[$dimension] = $level;
            $ccsResultWithLevelRaw[$dimension] = $levelRaw;
        }

        HelperFunctions::bulkTransactionsInDb($insertData, $updateData);


        // RCI Ocean Reliability

        $domains = [
            'openness' => [
                ['pair_no' => 1, 'positive_item' => 127, 'negative_item' => 187],
                ['pair_no' => 2, 'positive_item' => 157, 'negative_item' => 217],
                ['pair_no' => 3, 'positive_item' => 132, 'negative_item' => 162],
                ['pair_no' => 4, 'positive_item' => 142, 'negative_item' => 202],
            ],
            'conscientiousness' => [
                ['pair_no' => 5, 'positive_item' => 124, 'negative_item' => 184],
                ['pair_no' => 6, 'positive_item' => 129, 'negative_item' => 219],
                ['pair_no' => 7, 'positive_item' => 164, 'negative_item' => 194],
                ['pair_no' => 8, 'positive_item' => 134, 'negative_item' => 224],
            ],
           'extraversion' => [
                ['pair_no' => 9, 'positive_item' => 116, 'negative_item' => 176],
                ['pair_no' => 10, 'positive_item' => 146, 'negative_item' => 206],
                ['pair_no' => 11, 'positive_item' => 121, 'negative_item' => 211],
                ['pair_no' => 12, 'positive_item' => 156, 'negative_item' => 216],
            ],
            'agreeableness' => [
                ['pair_no' => 13, 'positive_item' => 118, 'negative_item' => 208],
                ['pair_no' => 14, 'positive_item' => 158, 'negative_item' => 188],
                ['pair_no' => 15, 'positive_item' => 128, 'negative_item' => 218],
                ['pair_no' => 16, 'positive_item' => 173, 'negative_item' => 203],
            ],
            'neuroticism' => [
                ['pair_no' => 17, 'positive_item' => 150, 'negative_item' => 210],
                ['pair_no' => 18, 'positive_item' => 155, 'negative_item' => 215],
                ['pair_no' => 19, 'positive_item' => 135, 'negative_item' => 165],
                ['pair_no' => 20, 'positive_item' => 140, 'negative_item' => 230]
            ]
        ];

        $domainConsistency = [];

        // Loop through each domain to evaluate consistency
        foreach ($domains as $domainName => $pairs) {
            $consistentPairs = 0;
            $totalPairs = count($pairs);

            foreach ($pairs as $pair) {
                $positiveResponse = DB::table('quiz_domain_value_answers')
                    ->where('user_id', $user_id)
                    ->where('quiz_domain_value_question_id', $pair['positive_item'])
                    ->value('answer');

                $negativeResponse = DB::table('quiz_domain_value_answers')
                    ->where('user_id', $user_id)
                    ->where('quiz_domain_value_question_id', $pair['negative_item'])
                    ->value('answer');

                // Check consistency based on given criteria
                if ((in_array($positiveResponse, [1, 2]) && in_array($negativeResponse, [1, 2])) ||
                    (in_array($positiveResponse, [4, 5]) && in_array($negativeResponse, [4, 5])) ||
                    (($positiveResponse == 3) && ($negativeResponse == 3))) {
                    $consistentPairs++;
                }
            }

            // Calculate domain-level RCI and percentage
            $rci = $consistentPairs / $totalPairs;
            $percentage = $rci * 100;

            // Determine domain consistency
            $isConsistent = $percentage > 34.1;
            $domainConsistency[$domainName] = $isConsistent ? 'Consistent' : 'Not Consistent';
        }

        // Count consistent and not consistent domains
        $notConsistentDomains = count(array_filter($domainConsistency, fn($status) => $status === 'Not Consistent'));
        $consistentDomains = count($domainConsistency) - $notConsistentDomains;

        // Determine overall consistency status
        if ($notConsistentDomains >= 2) {
            $level = 0;
            $level_description = 'Not Consistent';
        } elseif ($notConsistentDomains === 1) {
            $level = 1;
            $level_description = 'Somewhat Consistent';
        } else {
            $level = 2;
            $level_description = 'Consistent';
        }
        $dimension = 'RCI';
                
        [$description, $descriptor_id] = HelperFunctions::getDescriptor('ocean', 'rci', $dimension, $level, $descriptors);
        $percentage = (($notConsistentDomains) / ($notConsistentDomains + $consistentDomains))*100;
        // Prepare data for insertion or update
        $data = HelperFunctions::prepareData($user_id, 'ocean', 'rci', $dimension, $descriptor_id, $description, $notConsistentDomains, $z_score, $percentage, $level, $level_description);


        // Check if the result already exists for the user and dimension
        $existingResult = HelperFunctions::getExistingResults($user_id, 'ocean', 'rci', 'name', 'single');
        
        HelperFunctions::singleTransactionInDb($existingResult, $data);

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

         // Fetch mean and standard deviation for Z-score calculation
         $mean = $stats[$dimension]['mean'];
         $sd = $stats[$dimension]['sd'];

         // Calculate Z-score
         $z_score = HelperFunctions::calculateZScore($flight_score, $mean, $sd);

         // Convert Z-score to percentage
         $percentage = HelperFunctions::zScoreToPercent($z_score);; // Assumes a normal distribution (-3 to +3)

         // Determine the performance level based on the percentage
         [$level, $level_description] = HelperFunctions::getLevel($z_score, 'z_score');
                
         [$description, $descriptor_id] = HelperFunctions::getDescriptor('ocean', 'flight_risk', $dimension, $level, $descriptors);

         // Prepare data for insertion or update
         $data = HelperFunctions::prepareData($user_id, 'ocean', 'flight_risk', $dimension, $descriptor_id, $description, $flight_score, $z_score, $percentage, $level, $level_description);

        // Check if the result already exists for the user and dimension
        $existingResult = HelperFunctions::getExistingResults( $user_id, 'ocean', 'flight_risk', 'name', 'single');
        
        HelperFunctions::singleTransactionInDb($existingResult, $data);

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

        // Fetch mean and standard deviation for Z-score calculation
        $mean = $stats[$dimension]['mean'];
        $sd = $stats[$dimension]['sd'];

        // Calculate Z-score
        $z_score = HelperFunctions::calculateZScore($dark_triads_score, $mean, $sd);

        // Convert Z-score to percentage
        $percentage = HelperFunctions::zScoreToPercent($z_score);

        // Determine the performance level based on the percentage
        [$level, $level_description] = HelperFunctions::getLevel($z_score, 'z_score');
                    
        [$description, $descriptor_id] = HelperFunctions::getDescriptor('ocean', 'organizational_fit_forecast', $dimension, $level, $descriptors);

        // Prepare data for insertion or update
        $data = HelperFunctions::prepareData($user_id, 'ocean', 'organizational_fit_forecast', $dimension, $descriptor_id, $description, $dark_triads_score, $z_score, $percentage, $level, $level_description);

        // Check if the result already exists for the user and dimension
        $existingResult = HelperFunctions::getExistingResults( $user_id, 'ocean', 'organizational_fit_forecast', 'name', 'single');
        
        HelperFunctions::singleTransactionInDb($existingResult, $data);

        // $user->organizational_fit_forecast_dark_triad_percentage = $percentage;
        // $user->organizational_fit_forecast = $level_description;

        // Personality Type
        $userPersonalityType = '';
        $oceanResultChecker = ["Emotional Stability" => "N", "Extraversion" => "E", "Openness to Experience" => "O", "Agreeableness" => "A", "Conscientiousness" => "C"];
        $scores = [];

        // Personality Type Checker    
        $oceanCheck = $oceanCheckResult;

        foreach ($oceanCheck as $oceanKey => $oceanVal) {
            $scores[$oceanResultChecker[$oceanVal->name]] = $oceanVal->answer_avg;
        }
        $priority = ["C", "O", "E", "A", "N"];  // Priority from highest to least important

        // Step 2: Sort the scores by their values in descending order
        arsort($scores);

        // Extract the top two scores based purely on value
        $topTwoByValue = array_slice($scores, 0, 2, true);

        // Determine if the top two scores are close to each other
        $topTwoValues = array_values($topTwoByValue);
        if (isset($topTwoValues[1]) && abs($topTwoValues[0] - $topTwoValues[1]) <= 0.05) {
            // They are close, apply the priority list
            // Filter the scores by the priority list
            $scoresByPriority = array_merge(array_flip($priority), $scores);
            $topTwoByPriority = array_slice($scoresByPriority, 0, 2, true);

            $topTwo = $topTwoByPriority;
        } else {
            $topTwo = $topTwoByValue;
        }


        $results = DB::table('personality_types')
            ->whereIn('dimension_one', array_keys($topTwo))
            ->whereIn('dimension_two', array_keys($topTwo))
            ->whereColumn('dimension_one', '<>', 'dimension_two')
            ->first();

        // $user->personality_type_id = $results->id;
        $dimension = $results->personality_name ?? '';


        // Prepare data for insertion or update
        $data = HelperFunctions::prepareData($user_id, 'ocean', 'personality_type', $dimension, $descriptor_id, $description, 0, 0, 0, $results->id, $results->descriptions);

       // Check if the result already exists for the user and dimension
       $existingResult = HelperFunctions::getExistingResults( $user_id, 'ocean', 'personality_type', 'name', 'single');
       
       HelperFunctions::singleTransactionInDb($existingResult, $data);

        // TP Match Rate / CCS Match Rate
        $level = 0;
        $level_description = '';
        $description = '';
        $ccs_match_rate = 0;
        $ccsMatchRateRaw = 0;
        $user_ccs_scores = $ccsResult;
        if($job) {
            $jobSkills = [];
            foreach($job->skills as $jobSkill) {
                $jobSkills[$jobSkill->title] = $jobSkill->level ?: 0;
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

                    // Raw
                    $userLevelRaw = $ccsResultWithLevelRaw[$ccs]; 
                    $levelDifferenceRaw = $required_level - $userLevelRaw;

                    if ($levelDifferenceRaw == 1) {
                        $adjustedScoreRaw = $user_ccs_scores[$ccs] / 2;
                    } elseif ($levelDifferenceRaw == 2) {
                        $adjustedScoreRaw = $user_ccs_scores[$ccs] / 4;
                    } elseif ($levelDifferenceRaw == 3) {
                        $adjustedScoreRaw = $user_ccs_scores[$ccs] / 8;
                    } else {
                        $adjustedScoreRaw = $user_ccs_scores[$ccs];
                    }

                    $finalCcsScoresRaw[$ccs] = $adjustedScoreRaw;
                }
            }

            if (count($finalCcsScoresRaw) != 0) {
                $ccsMatchRateRaw = array_sum($finalCcsScoresRaw) / count($finalCcsScoresRaw);
            } 
            
            if (count($final_ccs_scores) != 0) {
                $ccs_match_rate = array_sum($final_ccs_scores) / count($final_ccs_scores);
            } 

            [$level, $level_description] = HelperFunctions::getLevel($ccs_match_rate, 'percentile');
        }

        $dimension = 'CCS Match Rate';
        [$description, $descriptor_id] = HelperFunctions::getDescriptor('ocean', 'ccs_match_rate', $dimension, $level, $descriptors);

        // Prepare data for insertion or update
        $data = HelperFunctions::prepareData($user_id, 'ocean', 'ccs_match_rate', $dimension, $descriptor_id, $description, $ccsMatchRateRaw, 0, $ccs_match_rate, $level, $level_description, $position_id);

        // Check if the result already exists for the user and dimension
        $existingResult = HelperFunctions::getExistingResults( $user_id, 'ocean', 'ccs_match_rate', 'name', 'single', $position_id);
            
        HelperFunctions::singleTransactionInDb($existingResult, $data);
        
       return [$ccsMatchRateRaw, $gpScore];
    } 

    public static function updateRiasecResults($user_id, $user, $job_opening_id, $job, $position_id, $user_type, $descriptors) {
        // RIASEC
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

        // Fetch all existing results for the user beforehand
        $existingResults = HelperFunctions::getExistingResults( $user_id, 'riasec', 'domains', 'name', 'all');

        $insertData = [];
        $updateData = [];

        // Loop through each RIASEC dimension to prepare data for insertion or update
        foreach ($workInterestResult as $dimension => $percentage) {
            [$level, $level_description] = HelperFunctions::getLevel($percentage, 'percentile');
                
            [$description, $descriptor_id] = HelperFunctions::getDescriptor('riasec', 'domains', $dimension, $level, $descriptors);

            // Prepare data for insertion or update
            $data = HelperFunctions::prepareData($user_id, 'riasec', 'domains', $dimension, $descriptor_id, $description, $percentage, 0, $percentage, $level, $level_description);

            // Check if the result already exists in the pre-fetched results
            if (isset($existingResults[$dimension])) {
                // Collect data for update (keeping ID for reference)
                $updateData[] = ['id' => $existingResults[$dimension]->id] + $data;
            } else {
                // Collect data for insert
                $insertData[] = $data;
            }
        }

        HelperFunctions::bulkTransactionsInDb($insertData, $updateData);

        // Top 3 RIASEC

        $top_names_first_letters = AssessmentHelper::getTop3RIASECFull($results);
        $top_names_first_letters_based_on_score = AssessmentHelper::getTop3RIASECFullBasedOnScore($results);

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
            'description' =>  $top3Riasec->description,
            'level_description' => $top_names_first_letters_based_on_score
        ];

        $existingResult = HelperFunctions::getExistingResults( $user_id, 'riasec', 'top_3_riasec', 'name', 'single');

        HelperFunctions::singleTransactionInDb($existingResult, $data);

        // JMR
        $jobTop3Riasec = $job->top3riasec ?? '';
        
        $dimension = 'Job Match Rate';
        $level = 0;
        $level_description = '';
        $description = '';
        $jmr = 0;
        $results = $workInterestResult;

        if($jobTop3Riasec) {
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
            [$level, $level_description] = HelperFunctions::getLevel($jmr, 'raw_score');
                
            [$description, $descriptor_id] = HelperFunctions::getDescriptor('riasec', 'jmr', $dimension, $level, $descriptors);

        }

       // Prepare data for insertion or update
       $data = HelperFunctions::prepareData($user_id, 'riasec', 'jmr', $dimension, $descriptor_id, $description, $jmr, 0, $jmr, $level, $level_description, $position_id);

       $existingResult = HelperFunctions::getExistingResults( $user_id, 'riasec', 'jmr', 'name', 'single', $position_id);

       HelperFunctions::singleTransactionInDb($existingResult, $data);

       return [$jmr];             
    }

    public static function updateCognitiveResults($user_id, $user, $job_opening_id, $job, $position_id, $user_type, $descriptors){
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
        $cognitiveResult['Quantitative Knowledge'] = 0;
        $cognitiveResult['Comprehension Knowledge'] = 0;
        $cognitiveResult['Visual Reasoning'] = 0;
        $cognitiveResult['Fluid Reasoning'] = 0;
    
        $totalMarks = 0;
    
        foreach ($results as $res) {
            $cognitiveResult[$res->name] = $res->total_marks;
            $totalMarks = $totalMarks + $res->total_marks;
        }
    
        $dimension = 'Cognitive';
    
        $percentage = min(100, ($totalMarks / 48)*100);
    
        if ($totalMarks >= 36) {
            $level = 3;
            $level_description = 'high';
        } elseif (($totalMarks >= 16) && ($totalMarks < 36)) {
            $level = 2;
            $level_description = 'moderate';
        } else {
            $level = 1;
            $level_description = 'low';
        }
    
        [$description, $descriptor_id] = HelperFunctions::getDescriptor('cognitive', 'overall', $dimension, $level, $descriptors);
    
        // Prepare data for insertion or update
        $data = HelperFunctions::prepareData($user_id, 'cognitive', 'overall', $dimension, $descriptor_id, $description, $totalMarks, 0, $percentage, $level, $level_description);
    
        $existingResult = HelperFunctions::getExistingResults( $user_id, 'cognitive', 'overall', 'name', 'single');
    
        HelperFunctions::singleTransactionInDb($existingResult, $data);
        $cognitiveTestPercentage = ($totalMarks / 96)*100;
    
        // Fetch all existing results for the user beforehand
        $existingResults = DB::table('user_results')
        ->where('user_id', $user_id)
        ->where('assessment_type', 'cognitive')
        ->where('result_type', 'domains')
        ->get()
        ->keyBy('name'); // Index by 'name' for easy lookup
    
        $insertData = [];
        $updateData = [];
        $cognitiveDomainResults = [];
        // Initialize the variable to check if any domain marks are non-zero
        $isTsmrConsidered = 0;

        // Check if all domain marks are zero
        foreach ($cognitiveResult as $dimension => $domainTotalMarks) {
            if ($domainTotalMarks > 0) {
                $isTsmrConsidered = 1;
                break; // Exit early since we found at least one non-zero value
            }
        }

        // Loop through each cognitive dimension to prepare data for insertion or update
        foreach ($cognitiveResult as $dimension => $domainTotalMarks) {

            // Calculate percentage based on total marks
            $percentage = min(100, ($domainTotalMarks / 12) * 100);

            // Determine the performance level and description based on total marks
            if ($domainTotalMarks >= 9) {
                $level = 3;
                $level_description = 'high';
            } elseif ($domainTotalMarks >= 3 && $domainTotalMarks < 9) {
                $level = 2;
                $level_description = 'moderate';
            } else {
                $level = 1;
                $level_description = 'low';
            }
            
            if ($domainTotalMarks == 0) {
                $cognitiveDomainResults[$dimension] = 0;   
            } else {
                $cognitiveDomainResults[$dimension] = $level;
            }
            
            [$description, $descriptor_id] = HelperFunctions::getDescriptor('cognitive', 'domains', $dimension, $level, $descriptors);

            // Prepare data for insertion or update
            $data = HelperFunctions::prepareData($user_id, 'cognitive', 'domains', $dimension, $descriptor_id, $description, $domainTotalMarks, 0, $percentage, $level, $level_description);

            // Check if the result already exists in the pre-fetched results
            if (isset($existingResults[$dimension])) {
                // Collect data for update (keeping ID for reference)
                $updateData[] = ['id' => $existingResults[$dimension]->id] + $data;
            } else {
                // Collect data for insert
                $insertData[] = $data;
            }
        }
    
        HelperFunctions::bulkTransactionsInDb($insertData, $updateData);
    
        // Calculate Technical Skill Match Rate (TSMR)
        $totalTSMR = 0;

        if (($position_id) && ($isTsmrConsidered == 1)) {
            try {
                // Instantiate the service inside the static method
                $tsmrService = new TsmrCalculationService();

                // Calculate Technical Skill Match Rate
                $totalTSMR = $tsmrService->calculateTechnicalSkillMatchRate(
                    $user_id,
                    $position_id,
                    $cognitiveDomainResults
                );

                if ($totalTSMR != -1) {
                    $dimension = 'Technical Skill Match Rate';

                    [$level, $level_description] = HelperFunctions::getLevel($totalTSMR, 'raw_score');
                    [$description, $descriptor_id] = HelperFunctions::getDescriptor(
                        'cognitive',
                        'technical_skill_match_rate',
                        $dimension,
                        $level,
                        $descriptors
                    );

                    // Prepare data for insertion or update
                    $data = HelperFunctions::prepareData(
                        $user_id,
                        'cognitive',
                        'technical_skill_match_rate',
                        $dimension,
                        $descriptor_id,
                        $description,
                        $totalTSMR,
                        0,
                        $totalTSMR,
                        $level,
                        $level_description,
                        $position_id
                    );

                    $existingResult = HelperFunctions::getExistingResults(
                        $user_id,
                        'cognitive',
                        'technical_skill_match_rate',
                        'name',
                        'single',
                        $position_id
                    );

                    HelperFunctions::singleTransactionInDb($existingResult, $data);
                }
            } catch (\Exception $e) {
                // Log the error for debugging
                \Log::error('Error calculating Technical Skill Match Rate', [
                    'user_id' => $user_id,
                    'position_id' => $position_id,
                    'error_message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);

                // Optionally set default or fallback value
                $totalTSMR = 0;
            }
        }

        if (($isTsmrConsidered == 0)) {
           $userResult 
              = DB::table('user_results')
                ->where('user_id', $user_id)
                ->where('assessment_type', 'cognitive')
                ->where('result_type', 'technical_skill_match_rate')
                ->where('job_id', $position_id)
                ->first();
    
                if ($userResult) {
                 DB::table('user_results')->where('id', $userResult->id)->delete();
                }
    
                $totalTSMR = 0;
        }

        return [$cognitiveTestPercentage, $totalTSMR];

    }
    
    // private static function calculateTechnicalSkillMatchRate($user_id, $position_id, $cognitiveResult)
    // {
        
        // Aggregated Method
        // // Optimize database query with eager loading and selective columns
        // $technicalSkills = DB::table('job_technical_skills as jts')
        //     ->join('master_technical_skill_cognitive_domains as mtskcd', 
        //         'jts.master_technical_skill_id', '=', 'mtskcd.master_technical_skill_id')
        //     ->join('master_technical_skills as mts', 
        //         'jts.master_technical_skill_id', '=', 'mts.id')
        //     ->where('jts.job_id', $position_id)
        //     ->where('mtskcd.level', '=', DB::raw('jts.level'))
        //     ->select([
        //         'mtskcd.master_technical_skill_id',
        //         'mtskcd.level',
        //         'mtskcd.qk_ka_percentage',
        //         'mtskcd.ck_ka_percentage',
        //         'mtskcd.vr_ka_percentage',
        //         'mtskcd.fr_ka_percentage',
        //         'mtskcd.qk_ka_level',
        //         'mtskcd.ck_ka_level',
        //         'mtskcd.vr_ka_level',
        //         'mtskcd.fr_ka_level',
        //         'mts.name as technical_skill_name'
        //     ])
        //     ->get();
            
        // if ($technicalSkills->isEmpty()) {
        //     return -1; // No technical skills found for the job
        // }

        // // Define domains once
        // $domains = [
        //     'Quantitative Knowledge' => [
        //         'percentage' => 'qk_ka_percentage',
        //         'level' => 'qk_ka_level'
        //     ],
        //     'Comprehension Knowledge' => [
        //         'percentage' => 'ck_ka_percentage',
        //         'level' => 'ck_ka_level'
        //     ],
        //     'Visual Reasoning' => [
        //         'percentage' => 'vr_ka_percentage',
        //         'level' => 'vr_ka_level'
        //     ],
        //     'Fluid Reasoning' => [
        //         'percentage' => 'fr_ka_percentage',
        //         'level' => 'fr_ka_level'
        //     ]
        // ];

        // // Process in single loop with array operations
        // $technicalSkillTSMRs = [];
        
        // foreach ($technicalSkills as $skillDomain) {
        //     $totalMatch = 0;
        //     $domainCount = 0;
            
        //     // Calculate all domain matches in one pass
        //     foreach ($domains as $domainName => $domainInfo) {
        //         $percentage = $skillDomain->{$domainInfo['percentage']};
        //         $requiredLevel = $skillDomain->{$domainInfo['level']};
                
        //         if ($percentage == 0) {
        //             continue;
        //         }

        //         $userLevel = $cognitiveResult[$domainName] ?? 0;
        //         $gap = $requiredLevel - $userLevel;
        //         $gapPercentage = self::getGapPercentage($gap);
                
        //         // Calculate match in one line
        //         $totalMatch += ($percentage * $gapPercentage);
        //         $domainCount++;
        //     }

        //     if ($domainCount > 0) {
        //         $technicalSkillTSMRs[] = $totalMatch;
        //     }
        // }

        // return round(
        //     count($technicalSkillTSMRs) > 0 
        //         ? array_sum($technicalSkillTSMRs) / count($technicalSkillTSMRs) 
        //         : 0, 
        //     2
        // );
    // }

    
    // private static function getGapPercentage($gap)
    // {
    //     if ($gap <= 0) {
    //         return 1.0; // 100% match when user meets or exceeds requirement
    //     } elseif ($gap == 1) {
    //         return 0.5; // 50% match when gap is 1
    //     } else { // gap >= 2
    //         return 0.25; // 25% match when gap is 2 or more
    //     }
    // }

    public static function updateSoftSkillScore($user_id, $position_id, $job, $descriptors, $jmr, $ccsMatchRateRaw, $cognitiveTestPercentage, $gpScore) {
        $dimension = 'Soft Skill Score';
        $soft_skill_score = 0.30*($jmr) + 0.30*($ccsMatchRateRaw) + 0.20*($cognitiveTestPercentage) + 0.20*($gpScore);

        if($job) {
            [$level, $level_description] = HelperFunctions::getLevel($soft_skill_score, 'raw_score');
        } else {
            [$level, $level_description] = [0, 'Position not assigned'];
        }

        [$description, $descriptor_id] = HelperFunctions::getDescriptor('all', 'soft_skill_score', $dimension, $level, $descriptors);

        // Prepare data for insertion or update
        $data = HelperFunctions::prepareData($user_id, 'all', 'soft_skill_score', $dimension, $descriptor_id, $description, $soft_skill_score, 0, $soft_skill_score, $level, $level_description, $position_id);

        $existingResult = HelperFunctions::getExistingResults( $user_id, 'all', 'soft_skill_score', 'name', 'single', $position_id);

        HelperFunctions::singleTransactionInDb($existingResult, $data);

        return [$soft_skill_score];
    }

    public static function updateTechnicalResults($user_id, $user, $job_opening_id, $job, $position_id, $user_type, $descriptors, $soft_skill_score){
        $dimension = 'Technical';
        $technical_score = 0;
        $overall_match_rate = 0;
        $soft_skill_score = DB::table('user_results')->where('user_id', $user->id)->where('job_id', $position_id)->where('result_type', 'soft_skill_score')->value('percentage') ?? 0;
        $isTechnicalAssessmentCompleted = false;

        if ($user->role_name == 'candidate') {

            $jobOpeningApplication = JobOpeningApplication::where('user_id', $user->id)
            ->where('job_opening_id', $job_opening_id)
            ->whereNotNull('technical_assessment_completed')
            ->first();
        
            $isTechnicalAssessmentCompleted = (bool) $jobOpeningApplication;

            if ($isTechnicalAssessmentCompleted) {
                $technical_score = $jobOpeningApplication->tech_skill_score ?? 0;
                $overall_match_rate = 0.5 * $technical_score + 0.5 * $soft_skill_score;
            }
        } else {
            $isTechnicalAssessmentCompleted = !empty($user->technical_assessment_completed);

            if ($isTechnicalAssessmentCompleted) {
                $technical_score = $user->tech_skill_score;
                $overall_match_rate = 0.5 * $user->tech_skill_score + 0.5 * $soft_skill_score;
            }
            
        }

        if ($isTechnicalAssessmentCompleted) {
            [$level, $level_description] = HelperFunctions::getLevel($technical_score, 'raw_score');
        } else {
            [$level, $level_description] = [0, 'Technical Assessment Not Completed'];
        }
        
        [$description, $descriptor_id] = HelperFunctions::getDescriptor('technical', 'overall', $dimension, $level, $descriptors);

        // Prepare data for insertion or update
        $data = HelperFunctions::prepareData($user_id, 'technical', 'overall', $dimension, $descriptor_id, $description, $technical_score, 0, $technical_score, $level, $level_description, $position_id);

        $existingResult = HelperFunctions::getExistingResults( $user_id, 'technical', 'overall', 'name', 'single', $position_id);

        HelperFunctions::singleTransactionInDb($existingResult, $data);

        // Overall Match Rate

        // $user->match_rate = $overall_match_rate;
        $dimension = 'Overall Match Rate';

        if ($isTechnicalAssessmentCompleted) {
            [$level, $level_description] = HelperFunctions::getLevel($overall_match_rate, 'raw_score');
        } else {
            [$level, $level_description] = [0, 'Technical Assessment Not Completed'];
        }
        
        [$description, $descriptor_id] = HelperFunctions::getDescriptor('all', 'overall_match_rate', $dimension, $level, $descriptors);

        // Prepare data for insertion or update
        $data = HelperFunctions::prepareData($user_id, 'all', 'overall_match_rate', $dimension, $descriptor_id, $description, $overall_match_rate, 0, $overall_match_rate, $level, $level_description, $position_id);

        $existingResult = HelperFunctions::getExistingResults( $user_id, 'all', 'overall_match_rate', 'name', 'single', $position_id);

        HelperFunctions::singleTransactionInDb($existingResult, $data);
    }
}