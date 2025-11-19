<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\QuizDomainValueAnswer;
use App\Models\Setting;
use App\Models\User;
use DB;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\FlagQuestionsCombination;
use App\Helpers\MainHelper;
use App\Helpers\AssessmentHelper;
use App\Models\PersonalityType;
use App\Models\JobOpeningApplication;
use Illuminate\Support\Facades\Artisan;

class AssessmentAlgoSubmit implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        // Get the current time
        $current_time = Carbon::now();

        // Calculate the time one hour ago
        $one_hour_ago = $current_time->subHour();

        $userId = $this->id;


        // Retrieve users created or updated within the last hour
        $allUserData = User::where('id', '=', $userId);

        $usersPercentage = [];

        $educationLevelData = [];

        $setting = Setting::where('user_id', 3)->first();

        $users = $allUserData;

        $users = $users->where(
            'is_admin',
            '=',
            0
        )->where('is_cognitive_ability_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_personality_motivation_completed', '=', 1);

        $usersData = $users->get();

        $consistencyArray = [-4, 4, -3, 3, -2, 2];

        foreach ($usersData as $key => $value) {

            $scoreCounts = 0;
            $responseData = [];

            try {
                $scoreCounts += $value->scope->points;
            } catch (\Throwable $th) {
                $scoreCounts = +0;
            }

            try {
                $scoreCounts += $value->education_level_check->points;
            } catch (\Throwable $th) {
                $scoreCounts += 0;
            }

            try {
                if ($value->do_you_have_experience_in_it_sector && $value->do_you_have_experience_in_it_sector == 1) {
                    if ($value->year_of_experience_in_it_sector > 0) {
                        if ($value->year_of_experience_in_it_sector < 3) {
                            $scoreCounts += 2;
                        } elseif ($value->year_of_experience_in_it_sector >= 3 && $value->year_of_experience_in_it_sector < 5) {
                            $scoreCounts += 3;
                        } elseif ($value->year_of_experience_in_it_sector >= 5) {
                            $scoreCounts += 5;
                        } else {
                            $scoreCounts += 0;
                        }
                    } else {
                        $scoreCounts += 0;
                    }
                } else {
                    $scoreCounts += 0;
                }
                $educationLevelData[$value->id] = $value->education_level_check->points;
            } catch (\Throwable $th) {
                $scoreCounts += 0;
            }

            $profilePercentage = ($scoreCounts / 15) * (int)$setting->talent_profile;



            $riasecPercentage = 0;
            try {
                $workInterestResult = DB::table('quiz_domain_value_answers')
                    ->join('quiz_domain_value_questions', 'quiz_domain_value_answers.quiz_domain_value_question_id', '=', 'quiz_domain_value_questions.id')
                    ->join('quiz_domain_values', 'quiz_domain_value_questions.quiz_domain_value_id', '=', 'quiz_domain_values.id')
                    ->where('quiz_domain_value_answers.user_id', $value->id)
                    ->where('quiz_domain_values.id', '>', 18)
                    ->where('quiz_domain_values.id', '<=', 24)
                    ->selectRaw('(SUM(quiz_domain_value_answers.answer) / 240 * ' . ((int)$setting->soft_skill / 3) . ') as overall_percentage')
                    ->first();

                if (
                    $workInterestResult && $workInterestResult->overall_percentage != null
                ) {
                    $riasecPercentage += (float)$workInterestResult->overall_percentage;
                }
            } catch (\Throwable $th) {
                $riasecPercentage += 0;
            }

            $cognitivePercentage = 0;
            try {
                $total_correct = QuizDomainValueAnswer::where('user_id', $value->id)->where('quiz_domain_value_question_id', '>', 376)->where('is_correct', 1)->sum('answer');
                if ($total_correct > 0) {
                    $cognitivePercentage = (float)number_format(($total_correct / 96) * ((int)$setting->soft_skill / 3), 2);
                }
            } catch (\Throwable $th) {
                $cognitivePercentage += 0;
            }


            $oceanPercentage = 0;
            try {
                $results = DB::table('quiz_domain_value_answers')
                    ->join('quiz_domain_value_questions', 'quiz_domain_value_answers.quiz_domain_value_question_id', '=', 'quiz_domain_value_questions.id')
                    ->join('quiz_domain_values', 'quiz_domain_value_questions.quiz_domain_value_id', '=', 'quiz_domain_values.id')
                    ->where('quiz_domain_value_answers.user_id', $value->id)
                    ->where('quiz_domain_values.id', '>', 24)
                    ->where('quiz_domain_values.id', '<=', 29)
                    ->select(
                        'quiz_domain_values.title as name',
                        'quiz_domain_values.id as quiz_domain_value_id'
                    )
                    ->selectRaw('ROUND((SUM(quiz_domain_value_answers.answer) / 120) * 5, 2) as answer_avg')
                    ->selectRaw('CASE
                        WHEN ROUND((SUM(quiz_domain_value_answers.answer) / 120) * 5, 2) <= 1.25 THEN "low"
                        WHEN ROUND((SUM(quiz_domain_value_answers.answer) / 120) * 5, 2) BETWEEN 1.26 AND 3.75 THEN "moderate"
                        WHEN ROUND((SUM(quiz_domain_value_answers.answer) / 120) * 5, 2) > 3.75 THEN "high"
                        ELSE "low"
                    END as level')
                    ->groupBy('quiz_domain_values.title', 'quiz_domain_values.id')
                    ->get();

                $oceanCalculate = 0;
                if (count($results) > 0) {
                    foreach ($results as $result) {
                        $oceanCalculate += $result->answer_avg;
                    }
                    $oceanPercentage += ($oceanCalculate / 25) * ((int)$setting->soft_skill / 3);
                }
            } catch (\Throwable $th) {
                $oceanPercentage += 0;
            }






            $workCompetencyPercentage = 0;
            try {
                $workCompetencyResults = DB::select(DB::raw("
                        WITH bartram AS (
                            SELECT
                                user_id,
                                (O5+A4+O3)/3 AS BARTRAM1,
                                (O4+O2+O6)/3 AS BARTRAM2,
                                (E2+E1+E6)/3 AS BARTRAM3,
                                (E3+A5+C1)/3 AS BARTRAM4,
                                (A3+A6+A1)/3 AS BARTRAM5,
                                (N6+N1+N3)/3 AS BARTRAM6,
                                (C2+C6+C3)/3 AS BARTRAM7,
                                (C4+C5+E4)/3 AS BARTRAM8
                            FROM (
                                SELECT
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (115,145,175,205) THEN answer ELSE 0 END)*5 AS N1,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (120,150,180,210) THEN answer ELSE 0 END)*5 AS N2,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (125,155,185,215) THEN answer ELSE 0 END)*5 AS N3,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (130,160,190,220) THEN answer ELSE 0 END)*5 AS N4,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (135,165,195,225) THEN answer ELSE 0 END)*5 AS N5,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (140,170,200,230) THEN answer ELSE 0 END)*5 AS N6,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (116,146,176,206) THEN answer ELSE 0 END)*5 AS E1,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (121,151,181,211) THEN answer ELSE 0 END)*5 AS E2,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (126,156,186,216) THEN answer ELSE 0 END)*5 AS E3,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (131,161,191,221) THEN answer ELSE 0 END)*5 AS E4,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (136,166,196,226) THEN answer ELSE 0 END)*5 AS E5,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (141,171,201,231) THEN answer ELSE 0 END)*5 AS E6,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (117,147,177,207) THEN answer ELSE 0 END)*5 AS O1,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (122,152,182,212) THEN answer ELSE 0 END)*5 AS O2,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (127,157,187,217) THEN answer ELSE 0 END)*5 AS O3,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (132,162,192,222) THEN answer ELSE 0 END)*5 AS O4,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (137,167,197,227) THEN answer ELSE 0 END)*5 AS O5,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (142,172,202,232) THEN answer ELSE 0 END)*5 AS O6,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (118,148,178,208) THEN answer ELSE 0 END)*5 AS A1,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (123,153,183,213) THEN answer ELSE 0 END)*5 AS A2,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (158,128,188,218) THEN answer ELSE 0 END)*5 AS A3,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (133,163,193,223) THEN answer ELSE 0 END)*5 AS A4,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (138,168,198,228) THEN answer ELSE 0 END)*5 AS A5,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (143,173,203,233) THEN answer ELSE 0 END)*5 AS A6,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (119,149,179,209) THEN answer ELSE 0 END)*5 AS C1,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (124,154,184,214) THEN answer ELSE 0 END)*5 AS C2,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (129,159,189,219) THEN answer ELSE 0 END)*5 AS C3,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (164,134,224,194) THEN answer ELSE 0 END)*5 AS C4,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (139,169,199,229) THEN answer ELSE 0 END)*5 AS C5,
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (144,174,204,234) THEN answer ELSE 0 END)*5 AS C6,
                                    user_id
                                FROM (
                                    SELECT
                                        answer,
                                        quiz_domain_value_question_id,
                                        user_id
                                    FROM quiz_domain_value_answers
                                    WHERE user_id=?
                                ) AS qdva
                                GROUP BY user_id
                            ) AS ocean
                        )
                        SELECT
                            user_id,
                            'Critical Thinking' AS aspect,
                            BARTRAM1 AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            user_id,
                            'Creativity' AS aspect,
                            BARTRAM2 AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            user_id,
                            'Communication' AS aspect,
                            BARTRAM3 AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            user_id,
                            'Leadership' AS aspect,
                            BARTRAM4 AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            user_id,
                            'Teamwork' AS aspect,
                            BARTRAM5 AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            user_id,
                            'Adaptability' AS aspect,
                            BARTRAM6 AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            user_id,
                            'Systematic Planning' AS aspect,
                            BARTRAM7 AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            user_id,
                            'Achievement Orientation' AS aspect,
                            BARTRAM8 AS value
                        FROM bartram;
                    "), [$value->id]);

                if (count($workCompetencyResults) > 0) {
                    $workCompetencyCalculation = 0;
                    foreach ($workCompetencyResults as $res) {
                        $workCompetencyCalculation += $res->value;
                    }
                    $workCompetencyPercentage += ($workCompetencyCalculation / 800) * $setting->employee_profile;
                }
            } catch (\Throwable $th) {
                //throw $th;
            }

            $allPercentage = $profilePercentage + $workCompetencyPercentage + $oceanPercentage + $cognitivePercentage + $riasecPercentage;
            $usersPercentage[$value->id] =
                (float)number_format($allPercentage, 2);

            if (
                (int)$setting->pool_one <= (float)number_format($allPercentage, 2)
            ) {

                $value->pool = 1;
                $value->percentage = (float)number_format($allPercentage, 2);
                $value->save();
            } elseif ((int)$setting->pool_two <= (float)number_format($allPercentage, 2)) {

                $value->pool = 2;
                $value->percentage = (float)number_format($allPercentage, 2);
                $value->save();
            } else {

                $value->pool = 3;
                $value->percentage = (float)number_format($allPercentage, 2);
                $value->save();
            }


            //Flags Calculations
            $flag = "Low";

            // Checking For C2 Flag
            $combinationsC2 = FlagQuestionsCombination::where('domain_name', 'C2')->get();
            $c2CombinationCounts = 0;
            $c2ConsistencyCount = 0;
            $c2Percentage = 0;
            foreach ($combinationsC2 as $key1 => $value1) {
                $c2CombinationCounts++;
                $answerPositive = QuizDomainValueAnswer::where('user_id', $value->id)->where('quiz_domain_value_question_id', $value1->positive_question_id)->first()->answer;
                $answerNegative = QuizDomainValueAnswer::where('user_id', $value->id)->where('quiz_domain_value_question_id', $value1->negative_question_id)->first()->answer;
                $calculation = $answerPositive - (6 - $answerNegative);
                if (in_array($calculation, $consistencyArray)) {
                    $c2ConsistencyCount++;
                }
            }
            $c2Percentage = ($c2ConsistencyCount / $c2CombinationCounts) * 100;
            if ($c2Percentage < 34) {
                $flag = "High";
            } elseif ($c2Percentage >= 34 && $c2Percentage < 67) {
                $flag = "Moderate";
            } elseif ($c2Percentage >= 67) {
                $flag = "Low";
            }



            // Checking For C3 Flag
            $combinationsC3 = FlagQuestionsCombination::where('domain_name', 'C3')->get();
            $c3CombinationCounts = 0;
            $c3ConsistencyCount = 0;
            $c3Percentage = 0;
            foreach ($combinationsC3 as $key1 => $value2) {
                $c3CombinationCounts++;
                $answerPositive = QuizDomainValueAnswer::where('user_id', $value->id)->where('quiz_domain_value_question_id', $value2->positive_question_id)->first()->answer;
                $answerNegative = QuizDomainValueAnswer::where('user_id', $value->id)->where('quiz_domain_value_question_id', $value2->negative_question_id)->first()->answer;
                $calculation = $answerPositive - (6 - $answerNegative);
                if (in_array($calculation, $consistencyArray)) {
                    $c3ConsistencyCount++;
                }
            }
            $c3Percentage = ($c3ConsistencyCount / $c3CombinationCounts) * 100;

            if ($c3Percentage < 26) {
                $flag = "High";
            } elseif ($c3Percentage >= 26 && $c3Percentage < 50) {
                $flag = "Moderate";
            } elseif ($c3Percentage >= 50) {
                $flag = "Low";
            }


            // Checking For C4 Flag
            $combinationsC4 = FlagQuestionsCombination::where('domain_name', 'C4')->get();
            $c4CombinationCounts = 0;
            $c4ConsistencyCount = 0;
            $c4Percentage = 0;
            foreach ($combinationsC4 as $key1 => $value3) {
                $c4CombinationCounts++;
                $answerPositive = QuizDomainValueAnswer::where('user_id', $value->id)->where('quiz_domain_value_question_id', $value3->positive_question_id)->first()->answer;
                $answerNegative = QuizDomainValueAnswer::where('user_id', $value->id)->where('quiz_domain_value_question_id', $value3->negative_question_id)->first()->answer;
                $calculation = $answerPositive - (6 - $answerNegative);
                if (in_array($calculation, $consistencyArray)) {
                    $c4ConsistencyCount++;
                }
            }
            $c4Percentage = ($c4ConsistencyCount / $c4CombinationCounts) * 100;

            if ($c4Percentage < 26) {
                $flag = "High";
            } elseif ($c4Percentage >= 26 && $c4Percentage < 50) {
                $flag = "Moderate";
            } elseif ($c4Percentage >= 50) {
                $flag = "Low";
            }



            // Checking For C5 Flag
            $combinationsC5 = FlagQuestionsCombination::where('domain_name', 'C5')->get();
            $c5CombinationCounts = 0;
            $c5ConsistencyCount = 0;
            $c5Percentage = 0;
            foreach ($combinationsC5 as $key1 => $value4) {
                $c5CombinationCounts++;
                $answerPositive = QuizDomainValueAnswer::where('user_id', $value->id)->where('quiz_domain_value_question_id', $value4->positive_question_id)->first()->answer;
                $answerNegative = QuizDomainValueAnswer::where('user_id', $value->id)->where('quiz_domain_value_question_id', $value4->negative_question_id)->first()->answer;
                $calculation = $answerPositive - (6 - $answerNegative);
                if (in_array($calculation, $consistencyArray)) {
                    $c5ConsistencyCount++;
                }
            }
            $c5Percentage = ($c5ConsistencyCount / $c5CombinationCounts) * 100;
            if ($c5Percentage < 26) {
                $flag = "High";
            } elseif ($c5Percentage >= 26 && $c5Percentage < 50) {
                $flag = "Moderate";
            } elseif ($c5Percentage >= 50) {
                $flag = "Low";
            }


            $value->flag = $flag;
            $value->save();




            // Code to check Potential

            $cognitiveResultsA = MainHelper::getCognitiveResult($value->id);

            $potential = 1;

            $potentialCognitiveCheck = $cognitiveResultsA->pluck('level')->toArray();

            // Your array
            $array = $potentialCognitiveCheck;

            // Count all the values in the array
            $valueCounts = array_count_values($array);

            // Check if 3 is in the array and get its count
            $countOf3 = isset($valueCounts[3]) ? $valueCounts[3] : 0;
            $workCompetencyCalculation = 0;

            if (count($workCompetencyResults) > 0) {
                $workCompetencyCalculation = 0;
                foreach ($workCompetencyResults as $res) {
                    $workCompetencyCalculation += $res->value;
                }
            }
            $calcualtionPotential = (($workCompetencyCalculation / 800) * 100) / 20;

            if ($countOf3 > 3) {

                if ($calcualtionPotential > 3.75) {
                    $potential = 3;
                }

                if ($calcualtionPotential >= 3 && $calcualtionPotential <= 3.75) {
                    $potential = 2;
                }
            } elseif ($countOf3 > 2) {
                if ($calcualtionPotential >= 3) {
                    $potential = 2;
                }
            }

            $value->potential = $potential;


            $growthPotential = MainHelper::getOCEANAllFacetsResult($value->id);

            $value->gp_percentage = ($growthPotential->drive_to_achieve_avg / 5) * 20 +
                ($growthPotential->innovation_avg / 5) * 15 +
                ($growthPotential->compassion_avg / 5) * 10 +
                ($growthPotential->will_power_avg / 5) * 10 +
                ($growthPotential->self_confidence_avg / 5) * 10 +
                ($growthPotential->confidence_avg / 5) * 10 +
                ($growthPotential->aesthetic_appreciation_avg / 5) * 10 +
                ($growthPotential->responsibility_avg / 5) * 5 +
                ($growthPotential->steadiness_avg / 5) * 5 +
                ($growthPotential->stress_response_avg / 5) * 5;



            $userPersonalityType = '';
            $oceanResultChecker = ["Emotional Stability" => "N", "Extraversion" => "E", "Openness to Experience" => "O", "Agreeableness" => "A", "Conscientiousness" => "C"];
            $scores = [];

            // Personality Type Checker    
            $oceanCheck = AssessmentHelper::getOceanResult($value->id);

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

            $value->personality_type_id = $results->id;


            $flight_score = 0;
            $all_facets = AssessmentHelper::getOCEANAllFacetsResultFull($value->id, 0);

            if ($all_facets['daydreaming_avg'] < 3.5) {
                $flight_score = $flight_score - 1;
            } else {
                $flight_score = $flight_score + 1;
            }

            if ($all_facets['innovation_avg'] < 3.5) {
                $flight_score = $flight_score - 1;
            } else {
                $flight_score = $flight_score + 1;
            }

            if ($all_facets['will_power_avg'] < 3.5) {
                $flight_score = $flight_score - 1;
            } else {
                $flight_score = $flight_score + 1;
            }

            if ($all_facets['tidiness_avg'] < 3.5) {
                $flight_score = $flight_score - 1;
            } else {
                $flight_score = $flight_score + 1;
            }

            if ($all_facets['sociability_avg'] < 3.5) {
                $flight_score = $flight_score - 1;
            } else {
                $flight_score = $flight_score + 1;
            }

            if ($all_facets['confidence_avg'] < 3.5) {
                $flight_score = $flight_score - 1;
            } else {
                $flight_score = $flight_score + 1;
            }

            if ($all_facets['thrill_seeking_avg'] < 3.5) {
                $flight_score = $flight_score - 1;
            } else {
                $flight_score = $flight_score + 1;
            }

            if ($all_facets['helpfulness_avg'] < 3.5) {
                $flight_score = $flight_score - 1;
            } else {
                $flight_score = $flight_score + 1;
            }

            if ($all_facets['diplomacy_avg'] < 3.5) {
                $flight_score = $flight_score - 1;
            } else {
                $flight_score = $flight_score + 1;
            }

            if ($all_facets['humility_avg'] < 3.5) {
                $flight_score = $flight_score - 1;
            } else {
                $flight_score = $flight_score + 1;
            }

            if ($all_facets['steadiness_avg'] < 3.5) {
                $flight_score = $flight_score - 1;
            } else {
                $flight_score = $flight_score + 1;
            }

            if ($all_facets['stress_response_avg'] < 3.5) {
                $flight_score = $flight_score - 1;
            } else {
                $flight_score = $flight_score + 1;
            }

            if ($all_facets['social_sensitivity_avg'] < 3.5) {
                $flight_score = $flight_score - 1;
            } else {
                $flight_score = $flight_score + 1;
            }

            $flight_level = 'Moderate';
            if ($flight_score > 0) {
                $flight_level = 'low';
                $flight_percentage = 0.00;
            } elseif ($flight_score < -7) {
                $flight_level = 'high';
                $flight_percentage = 66.66;
            } else {
                $flight_level = 'moderate';
                $flight_percentage = 33.33;
            }

            $value->flight_risk_score = $flight_score;
            $value->flight_risk_level = $flight_level;
            $value->flight_risk_percentage = $flight_percentage;


            $workInterestResults = AssessmentHelper::getWorkInterestResult($value->id, 0);
            $workInterestResultsArray = AssessmentHelper::getWorkInterestResultFull($value->id, 0);
            $top_names_first_letters = AssessmentHelper::getTop3RIASECBasedOnScore($workInterestResults);

            $riasecs = [
                "R" => "Realistic",
                "I" => "Investigative",
                "A" => "Artistic",
                "S" => "Social",
                "E" => "Enterprising",
                "C" => "Conventional"
            ];
            try {
                $riaCode = str_split($top_names_first_letters);
                $value->riasec_code_one = $riaCode[0];
                $value->riasec_code_one_score = $workInterestResultsArray[$riasecs[$riaCode[0]]];
                $value->riasec_code_two = $riaCode[1];
                $value->riasec_code_two_score = $workInterestResultsArray[$riasecs[$riaCode[1]]];
                $value->riasec_code_three = $riaCode[2];
                $value->riasec_code_three_score = $workInterestResultsArray[$riasecs[$riaCode[2]]];
                $value->riasec_code = $top_names_first_letters;
            } catch (\Throwable $th) {
                // throw $th;
            }
            try{
                $organization_fit_factor = AssessmentHelper::getOrganizationalFitForecastForPipeline($all_facets);
                $value->organizational_fit_forecast = $organization_fit_factor['level'] ?? 'moderate';
                $value->organizational_fit_forecast_dark_triad_percentage = $organization_fit_factor['percentage'] ?? 0;

            } catch (\Throwable $th) {
                // throw $th;
            }

            try {
                if(($value->is_personality_motivation_completed == 1) && ($value->is_work_interest_completed == 1) && ($value->is_cognitive_ability_completed == 1) ) {
                    $cognitve_marks = AssessmentHelper::getCognitiveTotalResult($value->id);
                    $cognitive_percentage = ($cognitve_marks / 96)*100;
                    $value->cognitive_test_percentage = $cognitive_percentage;
        
                    // Match Rate
                    $position = Job::find($value->position_id);
                    if($position) {
                        $positions = str_split($position->top3riasec);
                    } else {
                        $positions = ["S","E","C"];
                    }
                    
                    $score = 0;
                    if (in_array($value->riasec_code_one, $positions)) {
                        $score = $score + (($value->riasec_code_one_score) * 0.6);
                    } 
                    if (in_array($value->riasec_code_two, $positions)) {
                        $score = $score + (($value->riasec_code_two_score) * 0.3);
                    } 
                    if (in_array($value->riasec_code_three, $positions)) {
                        $score = $score + (($value->riasec_code_three_score) * 0.1);
                    } 
        
                    $value->riasec_job_match_rate = $score;
        
                    $workCompetencyResult = AssessmentHelper::getWorkCompetencyResultFull($value->id);
                    $job = Job::find($value->position_id);
                    if($job) {
                        $jobSkills = [];
                        foreach($job->skills as $jobSkill) {
                           $jobSkills[$jobSkill->title] = $jobSkill->level;
                        }
            
                        // CCS to TP mapping
                        $ccs_mapping = [
                            "Creative Thinking" => ["Creativity"],
                            "Sense Making" => ["Critical Thinking"],
                            "Decision Making" => ["Systematic Planning", "Achievement Orientation"],
                            "Transdisciplinary Thinking" => ["Critical Thinking", "Creativity"],
                            "Problem Solving" => ["Critical Thinking", "Creativity", "Adaptability"],
                            "Collaboration" => ["Teamwork", "Communication"],
                            "Communication" => ["Communication"],
                            "Influence" => ["Leadership", "Communication"],
                            "Adaptability" => ["Adaptability"],
                            "Digital Fluency" => ["Systematic Planning", "Critical Thinking"],
                            "Learning Agility" => ["Achievement Orientation", "Adaptability"],
                            "Self Management" => ["Leadership", "Adaptability"],
                            "Global Perspective" => ["Leadership", "Communication"],
                            "Customer Orientation" => ["Systematic Planning", "Communication"],
                            "Developing People" => ["Leadership", "Teamwork", "Achievement Orientation"],
                            "Building Inclusivity" => ["Leadership"],
                        ];
            
                        // Level ranges
                        $level_ranges = [
                            1 => [0, 33],
                            2 => [33, 67],
                            3 => [67, 100],
                        ];
            
                        $user_ccs_scores = $this->calculateCCS($ccs_mapping, $workCompetencyResult);
                        // Adjust CCS scores based on job requirements and only include required CCS
                        $final_ccs_scores = [];
                        foreach ($jobSkills as $ccs => $required_level) {
                            if (isset($user_ccs_scores[$ccs])) {
                                $user_level = $this->getLevel($user_ccs_scores[$ccs], $level_ranges);
                                $level_difference = $required_level - $user_level;
                                
                                if ($level_difference == 1) {
                                    $adjusted_score = $user_ccs_scores[$ccs] / 2;
                                } elseif ($level_difference == 2) {
                                    $adjusted_score = $user_ccs_scores[$ccs] / 4;
                                } else {
                                    $adjusted_score = $user_ccs_scores[$ccs];
                                }
            
                                // Only include CCS scores that are in job requirements
                                $final_ccs_scores[$ccs] = $adjusted_score;
                            }
                        }
                        $tp_match_rate = array_sum($final_ccs_scores) / count($final_ccs_scores);
                    } else {
                        $tp_match_rate = 60;
                    }

                    $value->talent_pillar_match_rate = $tp_match_rate;
        
                    $soft_skill_match_rate = 0.3*($value->riasec_job_match_rate) + 0.25*($value->talent_pillar_match_rate) + 0.25*($value->cognitive_test_percentage) + 0.20*($value->gp_percentage) - 0.025*($value->flight_risk_percentage) - 0.025*($value->organizational_fit_forecast_dark_triad_percentage);
        
                    $value->soft_skill_score = $soft_skill_match_rate;
        
                    $final_match_rate = 0.7*($value->tech_skill_score) + 0.3*($soft_skill_match_rate);
                    if($final_match_rate > 70) {
                    $match_rank = 1;
                    } elseif ($final_match_rate < 40) {
                    $match_rank = 3;
                    } else {
                    $match_rank = 2;
                    }
                    if($value->is_pm_cm == 1) {
                        $value->match_rate = $final_match_rate;
                    } else {
                        $value->match_rate = $soft_skill_match_rate;
                    }
                    $value->match_rank = $match_rank;
                }
            } catch (\Throwable $th) {
                //
            }

            try {
                if($value->role_name == 'candidate') {
                    $jobApplications = JobOpeningApplication::where('user_id', $value->id)->get();
  
                    foreach($jobApplications as $jobApplication) {
                         if($jobApplication->status < 3) {
                             $jobApplication->status = 3;
                             $jobApplication->save();

                             $activity = MainHelper::CreatejobApplicationLogs($jobApplication->user_id, $jobApplication->id, 'Candidate completed assessment');
                         }
                    }
                }
                              
             } catch (\Throwable $th) {
                 // throw $th;
             }

             try {
                Artisan::call('pipeline:update-users-tp');
            } catch (\Exception $e) {
                \Log::error('Failed to execute command pipeline:update-users-tp' . $e->getMessage());
            }
            
            $value->save();
        }

        return Command::SUCCESS;
    }

    function calculateCCS($mapping, $scores) {
        $ccs_scores = [];
        foreach ($mapping as $ccs => $tps) {
            $total = 0;
            $count = count($tps);
            foreach ($tps as $tp) {
                $total += $scores[$tp];
            }
            $ccs_scores[$ccs] = $total / $count;
        }
        return $ccs_scores;
    }

    // Function to get level from score
    function getLevel($score, $ranges) {
        foreach ($ranges as $level => $range) {
            if ($score > $range[0] && $score <= $range[1]) {
                return $level;
            }
        }
        return null;
    }
}
