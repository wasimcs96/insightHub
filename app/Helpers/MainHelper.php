<?php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Http;

class MainHelper {

    public static function getOceanResult($user_id,$isPopulation=0){
        if($isPopulation) {
            $results = DB::table('quiz_domain_value_answers')
            ->join('quiz_domain_value_questions', 'quiz_domain_value_answers.quiz_domain_value_question_id', '=', 'quiz_domain_value_questions.id')
            ->join('quiz_domain_values', 'quiz_domain_value_questions.quiz_domain_value_id', '=', 'quiz_domain_values.id')
            ->where('quiz_domain_values.id', '>', 24)
            ->where('quiz_domain_values.id', '<=', 29)
            ->select('quiz_domain_values.title as name')
            ->selectRaw('(COUNT(quiz_domain_value_answers.user_id) / 24) as user_count')
            ->selectRaw('ROUND((SUM(quiz_domain_value_answers.answer) / ((COUNT(quiz_domain_value_answers.user_id) / 24) * 120))*5, 2) as answer_avg_population')
            ->groupBy('quiz_domain_values.title')
            ->get();
        } else {
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
            ->selectRaw('CASE
                            WHEN ROUND((SUM(quiz_domain_value_answers.answer) / 120) * 5, 2) <= 1.25 THEN "low"
                            WHEN ROUND((SUM(quiz_domain_value_answers.answer) / 120) * 5, 2) > 1.25 AND ROUND((SUM(quiz_domain_value_answers.answer) / 120) * 5, 2) <= 3.75 THEN "moderate"
                            WHEN ROUND((SUM(quiz_domain_value_answers.answer) / 120) * 5, 2) > 3.75 THEN "high"
                            ELSE "low"
                        END as level')
            ->groupBy('quiz_domain_values.title', 'quiz_domain_values.id')
            ->get();
        }
        return $results;
    }

    public static function getCognitiveResult($user_id) {
        $results = DB::table('quiz_domain_value_answers')
                    ->join('quiz_domain_value_questions', 'quiz_domain_value_answers.quiz_domain_value_question_id', '=', 'quiz_domain_value_questions.id')
                    ->join('quiz_domain_values', 'quiz_domain_value_questions.quiz_domain_value_id', '=', 'quiz_domain_values.id')
                    ->where('quiz_domain_value_answers.user_id', $user_id)
                    ->where('quiz_domain_value_questions.quiz_domain_value_id', '>', 69)
                    ->select(
                        'quiz_domain_values.title as name',
                        'quiz_domain_values.id as quiz_domain_value_id',
                        DB::raw('SUM(quiz_domain_value_answers.answer) as total_marks'),
                        DB::raw('CASE
                                    WHEN SUM(quiz_domain_value_answers.answer) <= 5 THEN "1"
                                    WHEN SUM(quiz_domain_value_answers.answer) BETWEEN 6 AND 9 THEN "2"
                                    WHEN SUM(quiz_domain_value_answers.answer) >= 10 THEN "3"
                                    ELSE "1"
                                END as level')
                    )
                    ->groupBy('quiz_domain_values.title', 'quiz_domain_values.id')
                    ->get();

        return $results;
    }

    public static function getWorkInterestResult($user_id,$isPopulation=0){
        if($isPopulation) {
           $results = DB::table('quiz_domain_value_answers')
            ->join('quiz_domain_value_questions', 'quiz_domain_value_answers.quiz_domain_value_question_id', '=', 'quiz_domain_value_questions.id')
            ->join('quiz_domain_values', 'quiz_domain_value_questions.quiz_domain_value_id', '=', 'quiz_domain_values.id')
            ->where('quiz_domain_values.id', '>', 18)
            ->where('quiz_domain_values.id', '<=', 24)
            ->select('quiz_domain_values.title as name')
            ->selectRaw('(COUNT(DISTINCT quiz_domain_value_answers.user_id)) as user_count')
            ->selectRaw('ROUND((SUM(quiz_domain_value_answers.answer) / (COUNT(DISTINCT quiz_domain_value_answers.user_id))), 2) as answer_avg_population')
            ->groupBy('quiz_domain_values.title')
            ->get();

        } else {
            $results = DB::table('quiz_domain_value_answers')
            ->join('quiz_domain_value_questions', 'quiz_domain_value_answers.quiz_domain_value_question_id', '=', 'quiz_domain_value_questions.id')
            ->join('quiz_domain_values', 'quiz_domain_value_questions.quiz_domain_value_id', '=', 'quiz_domain_values.id')
            ->where('quiz_domain_value_answers.user_id', $user_id)
            ->where('quiz_domain_values.id', '>', 18)
            ->where('quiz_domain_values.id', '<=', 24)
            ->select('quiz_domain_values.title as name', 'quiz_domain_values.id as quiz_domain_value_id')
            ->selectRaw('ROUND((SUM(quiz_domain_value_answers.answer) / 40) * 100, 2) as percentage')
            ->groupBy('quiz_domain_values.title', 'quiz_domain_values.id')
            ->get();

        }
        return $results;
    }

    public static function getTop3RIASEC($workInterestResults,$isPopulation=0) {
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

    public static function getWorkCompetencyResult($user_id,$isPopulation=0){
        if($isPopulation) {
            $results = DB::select(DB::raw("
                        WITH bartram AS (
                            SELECT
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
                                    SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (144,174,204,234) THEN answer ELSE 0 END)*5 AS C6
                                FROM quiz_domain_value_answers qdva
                                GROUP BY user_id
                            ) AS ocean
                        )
                        SELECT
                            'Critical Thinking' AS aspect,
                            AVG(BARTRAM1) AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            'Creativity' AS aspect,
                            AVG(BARTRAM2) AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            'Communication' AS aspect,
                            AVG(BARTRAM3) AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            'Leadership' AS aspect,
                            AVG(BARTRAM4) AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            'Teamwork' AS aspect,
                            AVG(BARTRAM5) AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            'Adaptability' AS aspect,
                            AVG(BARTRAM6) AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            'Systematic Planning' AS aspect,
                            AVG(BARTRAM7) AS value
                        FROM bartram
                        UNION ALL
                        SELECT
                            'Achievement Orientation' AS aspect,
                            AVG(BARTRAM8) AS value
                        FROM bartram;
                    "));

        } else {
            $results = DB::select(DB::raw("
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
                            "), [$user_id]);

        }
        return $results;
    }

    public static function getOCEANAllFacetsResult($user_id,$isPopulation=0){
        if($isPopulation) {

            # OCEAN All Facets Overall
            // Define the conditions for each domain of Openess To Experience
            $daydreamingCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (117, 147, 177, 207) THEN answer
                ELSE NULL
            END
            ");

            $aestheticAppreciationCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (122, 152, 182, 212) THEN answer
                ELSE NULL
            END
            ");

            $feelingAwareCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (127, 157, 187, 217) THEN answer
                ELSE NULL
            END
            ");

            $explorerCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (132, 162, 192, 222) THEN answer
                ELSE NULL
            END
            ");

            $innovationCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (137, 167, 197, 227) THEN answer
                ELSE NULL
            END
            ");

            $openMindednessCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (142, 172, 202, 232) THEN answer
                ELSE NULL
            END
            ");

            // Define the conditions for each domain of Conscientiousness for employee A
            $selfConfidenceCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (119, 149, 179, 209) THEN answer
                ELSE NULL
            END
            ");

            $tidinessCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (124, 154, 184, 214) THEN answer
                ELSE NULL
            END
            ");

            $responsibilityCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (129, 159, 189, 219) THEN answer
                ELSE NULL
            END
            ");

            $driveToAchieveCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (134, 164, 194, 224) THEN answer
                ELSE NULL
            END
            ");

            $willPowerCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (139, 169, 199, 229) THEN answer
                ELSE NULL
            END
            ");

            $carefulThinkingCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (144, 174, 204, 234) THEN answer
                ELSE NULL
            END
            ");

            // Define the conditions for each domain of Extraversion for employee A
            $sociabilityCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (116, 146, 176, 206) THEN answer
                ELSE NULL
            END
            ");

            $crowdEnjoymentCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (121, 151, 181, 211) THEN answer
                ELSE NULL
            END
            ");

            $confidenceCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (126, 156, 186, 216) THEN answer
                ELSE NULL
            END
            ");

            $energeticLifestyleCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (131, 161, 191, 221) THEN answer
                ELSE NULL
            END
            ");

            $thrillSeekingCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (136, 166, 196, 226) THEN answer
                ELSE NULL
            END
            ");

            $optimismCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (141, 171, 201, 231) THEN answer
                ELSE NULL
            END
            ");

            // Define the conditions for each domain of Agreeableness for employee A
            $beliefCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (118, 148, 178, 208) THEN answer
                ELSE NULL
            END
            ");

            $honestyCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (123, 153, 183, 213) THEN answer
                ELSE NULL
            END
            ");

            $helpfulnessCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (128, 158, 188, 218) THEN answer
                ELSE NULL
            END
            ");

            $diplomacyCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (133, 163, 193, 223) THEN answer
                ELSE NULL
            END
            ");

            $humilityCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (138, 168, 198, 228) THEN answer
                ELSE NULL
            END
            ");

            $compassionCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (143, 173, 203, 233) THEN answer
                ELSE NULL
            END
            ");

            // Define the conditions for each domain of Emotionl Stability for employee A
            $steadinessCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (115, 145, 175, 205) THEN answer
                ELSE NULL
            END
            ");

            $toleranceCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (120, 150, 180, 210) THEN answer
                ELSE NULL
            END
            ");

            $positivityCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (125, 155, 185, 215) THEN answer
                ELSE NULL
            END
            ");

            $socialSensitivityCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (130, 160, 190, 220) THEN answer
                ELSE NULL
            END
            ");

            $impulseControlCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (135, 165, 195, 225) THEN answer
                ELSE NULL
            END
            ");

            $stressResponseCondition = DB::raw("
            CASE
                WHEN quiz_domain_value_question_id IN (140, 170, 200, 230) THEN answer
                ELSE NULL
            END
            ");

            $results = DB::table('quiz_domain_value_answers')
            ->select([
                DB::raw('AVG(' . $daydreamingCondition . ') as daydreaming_avg'),
                DB::raw('AVG(' . $aestheticAppreciationCondition . ') as aesthetic_appreciation_avg'),
                DB::raw('AVG(' . $feelingAwareCondition . ') as feeling_aware_avg'),
                DB::raw('AVG(' . $explorerCondition . ') as explorer_avg'),
                DB::raw('AVG(' . $innovationCondition . ') as innovation_avg'),
                DB::raw('AVG(' . $openMindednessCondition . ') as open_mindedness_avg'),
                DB::raw('AVG(' . $selfConfidenceCondition . ') as self_confidence_avg'),
                DB::raw('AVG(' . $tidinessCondition . ') as tidiness_avg'),
                DB::raw('AVG(' . $responsibilityCondition . ') as responsibility_avg'),
                DB::raw('AVG(' . $driveToAchieveCondition . ') as drive_to_achieve_avg'),
                DB::raw('AVG(' . $willPowerCondition . ') as will_power_avg'),
                DB::raw('AVG(' . $carefulThinkingCondition . ') as careful_thinking_avg'),
                DB::raw('AVG(' . $sociabilityCondition . ') as sociability_avg'),
                DB::raw('AVG(' . $crowdEnjoymentCondition . ') as crowd_enjoyment_avg'),
                DB::raw('AVG(' . $confidenceCondition . ') as confidence_avg'),
                DB::raw('AVG(' . $energeticLifestyleCondition . ') as energetic_lifestyle_avg'),
                DB::raw('AVG(' . $thrillSeekingCondition . ') as thrill_seeking_avg'),
                DB::raw('AVG(' . $optimismCondition . ') as optimism_avg'),
                DB::raw('AVG(' . $beliefCondition . ') as belief_avg'),
                DB::raw('AVG(' . $honestyCondition . ') as honesty_avg'),
                DB::raw('AVG(' . $helpfulnessCondition . ') as helpfulness_avg'),
                DB::raw('AVG(' . $diplomacyCondition . ') as diplomacy_avg'),
                DB::raw('AVG(' . $humilityCondition . ') as humility_avg'),
                DB::raw('AVG(' . $compassionCondition . ') as compassion_avg'),
                DB::raw('AVG(' . $steadinessCondition . ') as steadiness_avg'),
                DB::raw('AVG(' . $toleranceCondition . ') as tolerance_avg'),
                DB::raw('AVG(' . $positivityCondition . ') as positivity_avg'),
                DB::raw('AVG(' . $socialSensitivityCondition . ') as social_sensitivity_avg'),
                DB::raw('AVG(' . $impulseControlCondition . ') as impulse_control_avg'),
                DB::raw('AVG(' . $stressResponseCondition . ') as stress_response_avg'),
            ])
            ->first();


        } else {

            # All Facets
            // Define the conditions for each domain of Openess To Experience

            $daydreamingConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (117, 147, 177, 207) THEN answer
                    ELSE NULL
                END
            ");

            $aestheticAppreciationConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (122, 152, 182, 212) THEN answer
                    ELSE NULL
                END
            ");

            $feelingAwareConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (127, 157, 187, 217) THEN answer
                    ELSE NULL
                END
            ");

            $explorerConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (132, 162, 192, 222) THEN answer
                    ELSE NULL
                END
            ");

            $innovationConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (137, 167, 197, 227) THEN answer
                    ELSE NULL
                END
            ");

            $openMindednessConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (142, 172, 202, 232) THEN answer
                    ELSE NULL
                END
            ");

            $selfConfidenceConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (119, 149, 179, 209) THEN answer
                    ELSE NULL
                END
            ");

            $tidinessConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (124, 154, 184, 214) THEN answer
                    ELSE NULL
                END
            ");

            $responsibilityConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (129, 159, 189, 219) THEN answer
                    ELSE NULL
                END
            ");

            $driveToAchieveConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (134, 164, 194, 224) THEN answer
                    ELSE NULL
                END
            ");

            $willPowerConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (139, 169, 199, 229) THEN answer
                    ELSE NULL
                END
            ");

            $carefulThinkingConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (144, 174, 204, 234) THEN answer
                    ELSE NULL
                END
            ");

            $sociabilityConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (116, 146, 176, 206) THEN answer
                    ELSE NULL
                END
            ");

            $crowdEnjoymentConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (121, 151, 181, 211) THEN answer
                    ELSE NULL
                END
            ");

            $confidenceConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (126, 156, 186, 216) THEN answer
                    ELSE NULL
                END
            ");

            $energeticLifestyleConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (131, 161, 191, 221) THEN answer
                    ELSE NULL
                END
            ");

            $thrillSeekingConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (136, 166, 196, 226) THEN answer
                    ELSE NULL
                END
            ");

            $optimismConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (141, 171, 201, 231) THEN answer
                    ELSE NULL
                END
            ");

            $beliefConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (118, 148, 178, 208) THEN answer
                    ELSE NULL
                END
            ");

            $honestyConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (123, 153, 183, 213) THEN answer
                    ELSE NULL
                END
            ");

            $helpfulnessConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (128, 158, 188, 218) THEN answer
                    ELSE NULL
                END
            ");

            $diplomacyConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (133, 163, 193, 223) THEN answer
                    ELSE NULL
                END
            ");

            $humilityConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (138, 168, 198, 228) THEN answer
                    ELSE NULL
                END
            ");

            $compassionConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (143, 173, 203, 233) THEN answer
                    ELSE NULL
                END
            ");

            $steadinessConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (115, 145, 175, 205) THEN answer
                    ELSE NULL
                END
            ");

            $toleranceConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (120, 150, 180, 210) THEN answer
                    ELSE NULL
                END
            ");

            $positivityConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (125, 155, 185, 215) THEN answer
                    ELSE NULL
                END
            ");

            $socialSensitivityConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (130, 160, 190, 220) THEN answer
                    ELSE NULL
                END
            ");

            $impulseControlConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (135, 165, 195, 225) THEN answer
                    ELSE NULL
                END
            ");

            $stressResponseConditionA = DB::raw("
                CASE
                    WHEN user_id = $user_id AND quiz_domain_value_question_id IN (140, 170, 200, 230) THEN answer
                    ELSE NULL
                END
            ");


           $results = DB::table('quiz_domain_value_answers')
                        ->select([
                            DB::raw('AVG(' . $daydreamingConditionA . ') as daydreaming_avg'),
                            DB::raw('AVG(' . $aestheticAppreciationConditionA . ') as aesthetic_appreciation_avg'),
                            DB::raw('AVG(' . $feelingAwareConditionA . ') as feeling_aware_avg'),
                            DB::raw('AVG(' . $explorerConditionA . ') as explorer_avg'),
                            DB::raw('AVG(' . $innovationConditionA . ') as innovation_avg'),
                            DB::raw('AVG(' . $openMindednessConditionA . ') as open_mindedness_avg'),
                            DB::raw('AVG(' . $selfConfidenceConditionA . ') as self_confidence_avg'),
                            DB::raw('AVG(' . $tidinessConditionA . ') as tidiness_avg'),
                            DB::raw('AVG(' . $responsibilityConditionA . ') as responsibility_avg'),
                            DB::raw('AVG(' . $driveToAchieveConditionA . ') as drive_to_achieve_avg'),
                            DB::raw('AVG(' . $willPowerConditionA . ') as will_power_avg'),
                            DB::raw('AVG(' . $carefulThinkingConditionA . ') as careful_thinking_avg'),
                            DB::raw('AVG(' . $sociabilityConditionA . ') as sociability_avg'),
                            DB::raw('AVG(' . $crowdEnjoymentConditionA . ') as crowd_enjoyment_avg'),
                            DB::raw('AVG(' . $confidenceConditionA . ') as confidence_avg'),
                            DB::raw('AVG(' . $energeticLifestyleConditionA . ') as energetic_lifestyle_avg'),
                            DB::raw('AVG(' . $thrillSeekingConditionA . ') as thrill_seeking_avg'),
                            DB::raw('AVG(' . $optimismConditionA . ') as optimism_avg'),
                            DB::raw('AVG(' . $beliefConditionA . ') as belief_avg'),
                            DB::raw('AVG(' . $honestyConditionA . ') as honesty_avg'),
                            DB::raw('AVG(' . $helpfulnessConditionA . ') as helpfulness_avg'),
                            DB::raw('AVG(' . $diplomacyConditionA . ') as diplomacy_avg'),
                            DB::raw('AVG(' . $humilityConditionA . ') as humility_avg'),
                            DB::raw('AVG(' . $compassionConditionA . ') as compassion_avg'),
                            DB::raw('AVG(' . $steadinessConditionA . ') as steadiness_avg'),
                            DB::raw('AVG(' . $toleranceConditionA . ') as tolerance_avg'),
                            DB::raw('AVG(' . $positivityConditionA . ') as positivity_avg'),
                            DB::raw('AVG(' . $socialSensitivityConditionA . ') as social_sensitivity_avg'),
                            DB::raw('AVG(' . $impulseControlConditionA . ') as impulse_control_avg'),
                            DB::raw('AVG(' . $stressResponseConditionA . ') as stress_response_avg'),
                        ])
                        ->where('user_id', '=', $user_id) // Apply user_id condition here
                        ->first();
        }
        return $results;
    }

    public static function getTeamDynamicsResult($user_id,$isPopulation=0){
        if($isPopulation) {
            # Openness To Experience
            $feelingAwareCondition = DB::raw("
            CASE
                WHEN user_id = $user_id AND quiz_domain_value_question_id IN (157, 162, 167, 172) THEN answer
                ELSE NULL
            END
            ");

            $innovationCondition = DB::raw("
            CASE
                WHEN user_id = $user_id AND quiz_domain_value_question_id IN (197, 202, 207, 212) THEN answer
                ELSE NULL
            END
            ");

            $openMindednessCondition = DB::raw("
            CASE
                WHEN user_id = $user_id AND quiz_domain_value_question_id IN (217, 222, 227, 232) THEN answer
                ELSE NULL
            END
            ");

            # Conscientiousness

            $responsibilityCondition = DB::raw("
            CASE
                WHEN user_id = $user_id AND quiz_domain_value_question_id IN (159, 164, 169, 174) THEN answer
                ELSE NULL
            END
            ");

            $driveToAchieveCondition = DB::raw("
            CASE
                WHEN user_id = $user_id AND quiz_domain_value_question_id IN (179, 184, 189, 194) THEN answer
                ELSE NULL
            END
            ");

            # Extraversion

            $crowdEnjoymentCondition = DB::raw("
            CASE
                WHEN user_id = $user_id AND quiz_domain_value_question_id IN (136, 141, 146, 151) THEN answer
                ELSE NULL
            END
            ");

            $confidenceCondition = DB::raw("
            CASE
                WHEN user_id = $user_id AND quiz_domain_value_question_id IN (156, 161, 166, 171) THEN answer
                ELSE NULL
            END
            ");

            # Agreeableness

            $beliefCondition = DB::raw("
            CASE
                WHEN user_id = $user_id AND quiz_domain_value_question_id IN (118, 123, 128, 133) THEN answer
                ELSE NULL
            END
            ");

            $diplomacyCondition = DB::raw("
            CASE
                WHEN user_id = $user_id AND quiz_domain_value_question_id IN (178, 183, 188, 193) THEN answer
                ELSE NULL
            END
            ");

            # Emotional Stability
            $steadinessCondition = DB::raw("
            CASE
                WHEN user_id = $user_id AND quiz_domain_value_question_id IN (115, 120, 125, 130) THEN answer
                ELSE NULL
            END
            ");

           $results = DB::table('quiz_domain_value_answers')
                    ->select([
                        DB::raw('AVG(' . $feelingAwareCondition . ') as feeling_aware_avg'),
                        DB::raw('AVG(' . $innovationCondition . ') as innovation_avg'),
                        DB::raw('AVG(' . $openMindednessCondition . ') as open_mindedness_avg'),
                        DB::raw('AVG(' . $responsibilityCondition . ') as responsibility_avg'),
                        DB::raw('AVG(' . $driveToAchieveCondition . ') as drive_to_achieve_avg'),
                        DB::raw('AVG(' . $crowdEnjoymentCondition . ') as crowd_enjoyment_avg'),
                        DB::raw('AVG(' . $confidenceCondition . ') as confidence_avg'),
                        DB::raw('AVG(' . $beliefCondition . ') as belief_avg'),
                        DB::raw('AVG(' . $diplomacyCondition . ') as diplomacy_avg'),
                        DB::raw('AVG(' . $steadinessCondition . ') as steadiness_avg'),
                    ])
                    ->where('user_id', '=', $user_id) // Apply user_id condition here
                    ->first();

        } else {
            # Openness To Experience
            $feelingAwareCondition = DB::raw("
            CASE
                WHEN user_id = $user_id AND quiz_domain_value_question_id IN (157, 162, 167, 172) THEN answer
                ELSE NULL
            END
            ");

            $innovationCondition = DB::raw("
            CASE
                WHEN user_id = $user_id AND quiz_domain_value_question_id IN (197, 202, 207, 212) THEN answer
                ELSE NULL
            END
            ");

            $openMindednessCondition = DB::raw("
            CASE
                WHEN user_id = $user_id AND quiz_domain_value_question_id IN (217, 222, 227, 232) THEN answer
                ELSE NULL
            END
            ");

            # Conscientiousness

            $responsibilityCondition = DB::raw("
            CASE
                WHEN user_id = $user_id AND quiz_domain_value_question_id IN (159, 164, 169, 174) THEN answer
                ELSE NULL
            END
            ");

            $driveToAchieveCondition = DB::raw("
            CASE
                WHEN user_id = $user_id AND quiz_domain_value_question_id IN (179, 184, 189, 194) THEN answer
                ELSE NULL
            END
            ");

            # Extraversion

            $crowdEnjoymentCondition = DB::raw("
            CASE
                WHEN user_id = $user_id AND quiz_domain_value_question_id IN (136, 141, 146, 151) THEN answer
                ELSE NULL
            END
            ");

            $confidenceCondition = DB::raw("
            CASE
                WHEN user_id = $user_id AND quiz_domain_value_question_id IN (156, 161, 166, 171) THEN answer
                ELSE NULL
            END
            ");

            # Agreeableness

            $beliefCondition = DB::raw("
            CASE
                WHEN user_id = $user_id AND quiz_domain_value_question_id IN (118, 123, 128, 133) THEN answer
                ELSE NULL
            END
            ");

            $diplomacyCondition = DB::raw("
            CASE
                WHEN user_id = $user_id AND quiz_domain_value_question_id IN (178, 183, 188, 193) THEN answer
                ELSE NULL
            END
            ");

            # Emotional Stability
            $steadinessCondition = DB::raw("
            CASE
                WHEN user_id = $user_id AND quiz_domain_value_question_id IN (115, 120, 125, 130) THEN answer
                ELSE NULL
            END
            ");

           $results = DB::table('quiz_domain_value_answers')
                    ->select([
                        DB::raw('AVG(' . $feelingAwareCondition . ') as feeling_aware_avg'),
                        DB::raw('AVG(' . $innovationCondition . ') as innovation_avg'),
                        DB::raw('AVG(' . $openMindednessCondition . ') as open_mindedness_avg'),
                        DB::raw('AVG(' . $responsibilityCondition . ') as responsibility_avg'),
                        DB::raw('AVG(' . $driveToAchieveCondition . ') as drive_to_achieve_avg'),
                        DB::raw('AVG(' . $crowdEnjoymentCondition . ') as crowd_enjoyment_avg'),
                        DB::raw('AVG(' . $confidenceCondition . ') as confidence_avg'),
                        DB::raw('AVG(' . $beliefCondition . ') as belief_avg'),
                        DB::raw('AVG(' . $diplomacyCondition . ') as diplomacy_avg'),
                        DB::raw('AVG(' . $steadinessCondition . ') as steadiness_avg'),
                    ])
                    ->where('user_id', '=', $user_id) // Apply user_id condition here
                    ->first();

        }
        return $results;
    }

    public static function escapeSpecialCharacters($string) {
        return str_replace(
            ["\\", "'", "\"", "\n", "\r", "\t"],
            ["\\\\", "\\'", "\\\"", "\\n", "\\r", "\\t"],
            $string
        );
    }

    public static function CreatejobApplicationLogs($userId,$jobApplicationId,$action) {

        $activityLog = ActivityLog::create([
            'user_id'=>$userId,
            'job_application_id'=>$jobApplicationId,
            'action'=>$action
        ]);
        return $activityLog;
    }

    public static function jobTriggerByType($userId,$assessment,$panel,$job_opening_id=null){
        $response = Http::withOptions([
            'verify' => false, // Disable SSL verification
        ])->post('https://jobsapi2233.theinsightaccess.com/api/update-user-results', [
            'user_id' => $userId,
            'assessment_name' => $assessment,
            'panel_name' => $panel,
            'job_opening_id' => $job_opening_id
        ]);

        return true;
    }

    public static function jobTriggerByTypeOnPositionChange($user_id, $position_id,$panel) {
        $response = Http::withOptions([
            'verify' => false, // Disable SSL verification
        ])->post('https://jobsapi2233.theinsightaccess.com/api/update-user-results-on-position-assign', [
            'user_id' => $user_id,
            'position_id' => $position_id,
            'panel_name' => $panel
        ]);
        
        return true;
    }

    public static function jobTriggerByTypeOnPositionEdit($position_id,$panel) {
        $response = Http::withOptions([
            'verify' => false, // Disable SSL verification
        ])->post('https://jobsapi2233.theinsightaccess.com/api/update-user-results-on-position-edit', [
            'position_id' => $position_id,
            'panel_name' => $panel
        ]);
        
        return true;
    }

}
