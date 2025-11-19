<?php
namespace App\Helpers;

use App\Models\MasterSkill;
use App\Models\SkillReview;
use App\Models\SkillReviewDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class AssessmentHelper {

    public static function getOceanResult($user_id,$isPopulation=0){
        
        if($isPopulation) {
            if(auth()->user()->company_id) {
                $company_id = auth()->user()->company_id;
            } else {
                $company_id = 3;
            }
            $results = DB::table('quiz_domain_value_answers')
            ->join('quiz_domain_value_questions', 'quiz_domain_value_answers.quiz_domain_value_question_id', '=', 'quiz_domain_value_questions.id')
            ->join('quiz_domain_values', 'quiz_domain_value_questions.quiz_domain_value_id', '=', 'quiz_domain_values.id')
            ->join('users', 'quiz_domain_value_answers.user_id', '=', 'users.id')  // Join with users table
            ->where('quiz_domain_values.id', '>', 24)
            ->where('quiz_domain_values.id', '<=', 29)
            ->where('users.company_id', '=', $company_id)
            ->where('users.is_admin', 0)
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
                                    WHEN SUM(quiz_domain_value_answers.answer) <= 2 THEN "1"
                                    WHEN SUM(quiz_domain_value_answers.answer) BETWEEN 3 AND 6 THEN "2"
                                    WHEN SUM(quiz_domain_value_answers.answer) >= 7 THEN "3"
                                    ELSE "1"
                                END as level')
                    )
                    ->groupBy('quiz_domain_values.title', 'quiz_domain_values.id')
                    ->get();

        return $results;
    }

    public static function getCognitiveTotalResult($user_id) {
        $results = DB::table('quiz_domain_value_answers')
                    ->join('quiz_domain_value_questions', 'quiz_domain_value_answers.quiz_domain_value_question_id', '=', 'quiz_domain_value_questions.id')
                    ->join('quiz_domain_values', 'quiz_domain_value_questions.quiz_domain_value_id', '=', 'quiz_domain_values.id')
                    ->where('quiz_domain_value_answers.user_id', $user_id)
                    ->where('quiz_domain_value_questions.quiz_domain_value_id', '>', 69)
                    ->sum('quiz_domain_value_answers.answer');

        return $results;
    }

    public static function getWorkInterestResult($user_id,$isPopulation=0){
        if($isPopulation) {
            if(auth()->user()->company_id) {
                $company_id = auth()->user()->company_id;
            } else {
                $company_id = 3;
            }
           $results = DB::table('quiz_domain_value_answers')
            ->join('quiz_domain_value_questions', 'quiz_domain_value_answers.quiz_domain_value_question_id', '=', 'quiz_domain_value_questions.id')
            ->join('quiz_domain_values', 'quiz_domain_value_questions.quiz_domain_value_id', '=', 'quiz_domain_values.id')
            ->join('users', 'quiz_domain_value_answers.user_id', '=', 'users.id')  // Join with users table
            ->where('quiz_domain_values.id', '>', 18)
            ->where('quiz_domain_values.id', '<=', 24)
            ->where('users.company_id', '=', $company_id)
            ->where('users.is_admin', 0)
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

    public static function getTop3RIASECBasedOnScore($workInterestResults,$isPopulation=0) {
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
        // $riasec_values = [
        //     'R' => 1,
        //     'I' => 2,
        //     'A' => 3,
        //     'S' => 4,
        //     'E' => 5,
        //     'C' => 6
        // ];

        // $top_names_first_letters_array = str_split($top_names_first_letters);
        // // Sort the letters based on their RIASEC values
        // usort($top_names_first_letters_array, function($a, $b) use ($riasec_values) {
        //     return $riasec_values[$a] <=> $riasec_values[$b];
        // });

        // $top_names_first_letters = implode('', $top_names_first_letters_array);

        return $top_names_first_letters;
    }

    public static function getWorkCompetencyResult($user_id,$isPopulation=0){
        if($isPopulation) {
            if(auth()->user()->company_id) {
                $company_id = auth()->user()->company_id;
              } else {
               $company_id = 3;
              }
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
                        (C4+C5+E4)/3 AS BARTRAM8,
                        user_id
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
                            qdva.user_id
                        FROM quiz_domain_value_answers qdva
                        GROUP BY qdva.user_id
                    ) AS ocean
                )
                SELECT
                    'Critical Thinking' AS aspect,
                    AVG(BARTRAM1) AS value
                FROM bartram
                JOIN users ON bartram.user_id = users.id
                WHERE users.company_id = $company_id
                UNION ALL
                SELECT
                    'Creativity' AS aspect,
                    AVG(BARTRAM2) AS value
                FROM bartram
                JOIN users ON bartram.user_id = users.id
                WHERE users.company_id = $company_id
                UNION ALL
                SELECT
                    'Communication' AS aspect,
                    AVG(BARTRAM3) AS value
                FROM bartram
                JOIN users ON bartram.user_id = users.id
                WHERE users.company_id = $company_id
                UNION ALL
                SELECT
                    'Leadership' AS aspect,
                    AVG(BARTRAM4) AS value
                FROM bartram
                JOIN users ON bartram.user_id = users.id
                WHERE users.company_id = $company_id
                UNION ALL
                SELECT
                    'Teamwork' AS aspect,
                    AVG(BARTRAM5) AS value
                FROM bartram
                JOIN users ON bartram.user_id = users.id
                WHERE users.company_id = $company_id
                UNION ALL
                SELECT
                    'Adaptability' AS aspect,
                    AVG(BARTRAM6) AS value
                FROM bartram
                JOIN users ON bartram.user_id = users.id
                WHERE users.company_id = $company_id
                UNION ALL
                SELECT
                    'Systematic Planning' AS aspect,
                    AVG(BARTRAM7) AS value
                FROM bartram
                JOIN users ON bartram.user_id = users.id
                WHERE users.company_id = $company_id
                UNION ALL
                SELECT
                    'Achievement Orientation' AS aspect,
                    AVG(BARTRAM8) AS value
                FROM bartram
                JOIN users ON bartram.user_id = users.id
                WHERE users.company_id = $company_id
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
    public static function getUserData($userId)
    {
        $user = User::with('position.skills', 'position.technicalSkills', 'position.criticalFunctions.cwfKeys')->find($userId);
        if (!$user) {
            return null;
        }
        $jobData = $user->position;
        $skills = $jobData ? $jobData->skills->map(fn ($skill) => [
            'title' => $skill->title ?? 'N/A',
            'level' => $skill->level ?? 'N/A',
            'id' => $skill->id ?? 'N/A',

        ])->toArray() : [];
        $technicalSkills = $jobData->technicalSkills->toArray();
        $jobData ? $jobData->technicalSkills->map(fn ($techSkill) => [
            'title' => $techSkill->name ?? 'N/A',
            'id' => $techSkill->id ?? 'N/A',
            'level' => $techSkill->pivot->level ?? 'N/A', // Ensure correct attribute access
            'technical_skill_id' => $techSkill->technical_skill_id ?? 'N/A',
        ])->toArray() : [];
        
        $criticalFunctions = $jobData ? $jobData->criticalFunctions->map(fn ($critFunc) => [
            'description' => $critFunc->description ?? 'N/A',
            'cwf_keys' => $critFunc->cwfKeys->pluck('name')->toArray()
        ])->toArray() : [];

        return [
            'first_name' => $user->first_name ?? 'N/A',
            'name' => $user->name ?? 'N/A',
            'department_id' => $user->department_id ?? 'N/A',
            'position_id' => $user->position_id ?? 'N/A',
            'job_title' => $jobData->title ?? 'N/A',
            'job_description' => $jobData->description ?? 'N/A',
            'skills' => $skills,
            'technical_skills' => $technicalSkills,
            'critical_functions' => $criticalFunctions,
            'initials' => strtoupper(substr($user->first_name, 0, 1)) . strtoupper(substr($user->last_name, 0, 1))
        ];
    }
    public static function getWorkCompetencySixteenResultFull($user_id, $isPopulation = 0)
    {
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

        $workCompetencyResult = [];
        $workCompetencyResult['Critical Thinking'] = 0;
        $workCompetencyResult['Creativity'] = 0;
        $workCompetencyResult['Communication'] = 0;
        $workCompetencyResult['Leadership'] = 0;
        $workCompetencyResult['Teamwork'] = 0;
        $workCompetencyResult['Adaptability'] = 0;
        $workCompetencyResult['Systematic Planning'] = 0;
        $workCompetencyResult['Achievement Orientation'] = 0;

        foreach ($results as $res) {
            $workCompetencyResult[$res->aspect] = $res->value;
        }

        $results = $workCompetencyResult;

        $result2 = [];

       $skills = MasterSkill::all();
$result2 = [];

foreach ($skills as $key => $value) {
    $tpData = explode(';', $value->tp_details);
    $total = 0;
    $count = 0; // Initialize a counter to keep track of valid keys

    foreach ($tpData as $key1 => $value1) {
        $trimmedValue1 = trim($value1);
        
        if (isset($results[$trimmedValue1])) {
            $total += $results[$trimmedValue1];
            $count++;
        }
    }

    if ($count > 0) {
        $total = $total / $count;
    }

    $result2[$value->name] = $total;
}

return $result2;
    }
    public static function getSoftSkills($userId)
    {
        $allSkillReviews = SkillReview::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        $softSkills = [];

        foreach ($allSkillReviews as $review) {
            $reviewYear = date('Y', strtotime($review->review_date));
            $softSkillDetails = SkillReviewDetail::where('skill_review_id', $review->id)
                ->where('skill_type', 'soft')
                ->get();
            $reviewSkills = $softSkillDetails->map(fn ($detail) => [
                'title' => $detail->name ?? 'N/A',
                'level' => $detail->level ?? 'N/A',
                'remarks' => $detail->remark ?? 'N/A'
            ])->toArray();

            $softSkills[] = [
                'review_id' => $review->id,
                'year' => $reviewYear,
                'skills' => $reviewSkills
            ];
        }

        return $softSkills;
    }
    public static function getTechSkills($userId)
    {
        $allSkillReviews = SkillReview::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        $softSkills = [];

        foreach ($allSkillReviews as $review) {
            $reviewYear = date('Y', strtotime($review->review_date));
            $softSkillDetails = SkillReviewDetail::where('skill_review_id', $review->id)
                ->where('skill_type', 'technical')
                ->get();
            $reviewSkills = $softSkillDetails->map(fn ($detail) => [
                'title' => $detail->name ?? 'N/A',
                'level' => $detail->level ?? 'N/A',
                'remarks' => $detail->remark ?? 'N/A'
            ])->toArray();

            $softSkills[] = [
                'review_id' => $review->id,
                'year' => $reviewYear,
                'skills' => $reviewSkills
            ];
        }

        return $softSkills;
    }

    public static function getTechnicalSkills($userId)
    {
        $user = User::with('position.technicalSkills')->find($userId);
        if (!$user) {
            return null;
        }
    
        $jobData = $user->position;
    
        $technicalSkills = $jobData ? $jobData->technicalSkills->map(fn ($techSkill) => [
            'title' => $techSkill->name ?? 'N/A',
            'level' => $techSkill->pivot->level ?? 'N/A',
            'id' => $techSkill->id ?? 'N/A',
        ])->toArray() : [];
    
        return $technicalSkills;
    }

    
    public static function getSoftSkillsYears($userId)
    {
        $allSkillReviews = SkillReview::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        $softSkills = [];

        foreach ($allSkillReviews as $review) {
            $reviewYear = date('Y', strtotime($review->review_date));
            $softSkillDetails = SkillReviewDetail::where('skill_review_id', $review->id)
                ->where('skill_type', 'soft')
                ->get();
            $reviewSkills = $softSkillDetails->map(fn ($detail) => [
                'title' => $detail->name ?? 'N/A',
                'level' => $detail->level ?? 'N/A',
                'remarks' => $detail->remark ?? 'N/A'
            ])->toArray();

            $softSkills[] = [
                'review_id' => $review->id,
                'year' => $reviewYear,
                'skills' => $reviewSkills
            ];
        }

        return $softSkills;
    }
    public static function getSoftSkillsSelectedYears($userId, $year)
    {
        $allSkillReviews = SkillReview::where('user_id', $userId) ->whereYear('review_date', $year)->get();
        $softSkills = [];
        foreach ($allSkillReviews as $review) {
            $reviewYear = date('Y', strtotime($review->review_date));
            $softSkillDetails = SkillReviewDetail::where('skill_review_id', $review->id)
                ->where('skill_type', 'soft')
                ->get();
            $reviewSkills = $softSkillDetails->map(fn ($detail) => [
                'title' => $detail->name ?? 'N/A',
                'level' => $detail->level ?? 'N/A',
                'remarks' => $detail->remark ?? 'N/A'
            ])->toArray();

            $softSkills[] = [
                'review_id' => $review->id,
                'year' => $reviewYear,
                'skills' => $reviewSkills
            ];
        }

        return $softSkills;
    }

    public static function getOCEANAllFacetsResult($user_id,$isPopulation=0){
        if($isPopulation) {
            if(auth()->user()->company_id) {
                $company_id = auth()->user()->company_id;
            } else {
                $company_id = 3;
            }
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
            ->join('users', 'quiz_domain_value_answers.user_id', '=', 'users.id')  // Join with users table
            ->where('users.company_id', '=', $company_id)
            ->where('users.is_admin', 0)
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

    // Full Results

    public static function getOceanResultFull($user_id,$isPopulation=0){
        
        if($isPopulation) {
            if(auth()->user()->company_id) {
                $company_id = auth()->user()->company_id;
            } else {
                $company_id = 3;
            }
            $results = DB::table('quiz_domain_value_answers')
            ->join('quiz_domain_value_questions', 'quiz_domain_value_answers.quiz_domain_value_question_id', '=', 'quiz_domain_value_questions.id')
            ->join('quiz_domain_values', 'quiz_domain_value_questions.quiz_domain_value_id', '=', 'quiz_domain_values.id')
            ->join('users', 'quiz_domain_value_answers.user_id', '=', 'users.id')  // Join with users table
            ->where('quiz_domain_values.id', '>', 24)
            ->where('quiz_domain_values.id', '<=', 29)
            ->where('users.company_id', '=', $company_id)
            ->where('users.is_admin', 0)
            ->select('quiz_domain_values.title as name')
            ->selectRaw('(COUNT(quiz_domain_value_answers.user_id) / 24) as user_count')
            ->selectRaw('ROUND((SUM(quiz_domain_value_answers.answer) / ((COUNT(quiz_domain_value_answers.user_id) / 24) * 120))*5, 2) as answer_avg_population')
            ->groupBy('quiz_domain_values.title')
            ->get();
            
            $oceanOverallResult = [];
            $oceanOverallResult['Openness to Experience'] = 0;
            $oceanOverallResult['Conscientiousness'] = 0;
            $oceanOverallResult['Extraversion'] = 0;
            $oceanOverallResult['Agreeableness'] = 0;
            $oceanOverallResult['Emotional Stability'] = 0;

            foreach ($results as $result) {
                $oceanOverallResult[$result->name] =  $result->answer_avg_population;
            }

            $results = $oceanOverallResult;
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
            
            $oceanSelfResult = [];
            $oceanSelfResult['Openness to Experience'] = 0;
            $oceanSelfResult['Conscientiousness'] = 0;
            $oceanSelfResult['Extraversion'] = 0;
            $oceanSelfResult['Agreeableness'] = 0;
            $oceanSelfResult['Emotional Stability'] = 0;

            foreach ($results as $result) {
                $oceanSelfResult[$result->name] =  $result->answer_avg;
            }

            $results = $oceanSelfResult;
           
        }
        
        return $results;
    }

    public static function getOCEANResultFullByDepartment($department_id) {
        $results = DB::table('quiz_domain_value_answers')
        ->join('quiz_domain_value_questions', 'quiz_domain_value_answers.quiz_domain_value_question_id', '=', 'quiz_domain_value_questions.id')
        ->join('quiz_domain_values', 'quiz_domain_value_questions.quiz_domain_value_id', '=', 'quiz_domain_values.id')
        ->join('users', 'quiz_domain_value_answers.user_id', '=', 'users.id')  // Join with users table
        ->where('quiz_domain_values.id', '>', 24)
        ->where('quiz_domain_values.id', '<=', 29)
        ->where('users.department_id', '=', $department_id)  // Filtering by department_id
        ->where('users.is_personality_motivation_completed', '=', 1)
        ->select('quiz_domain_values.title as name')
        ->selectRaw('(COUNT(quiz_domain_value_answers.user_id) / 24) as user_count')
        ->selectRaw('ROUND((SUM(quiz_domain_value_answers.answer) / ((COUNT(quiz_domain_value_answers.user_id) / 24) * 120))*5, 2) as answer_avg_population')
        ->groupBy('quiz_domain_values.title')
        ->get();


        $oceanOverallResult = [];
        $oceanOverallResult['Openness to Experience'] = 0;
        $oceanOverallResult['Conscientiousness'] = 0;
        $oceanOverallResult['Extraversion'] = 0;
        $oceanOverallResult['Agreeableness'] = 0;
        $oceanOverallResult['Emotional Stability'] = 0;

        foreach ($results as $result) {
            $oceanOverallResult[$result->name] =  $result->answer_avg_population;
        }

        $results = $oceanOverallResult;
        
        return $results;
    }

    public static function getOCEANAllFacetsResultFull($user_id,$isPopulation=0){
        if($isPopulation) {
            if(auth()->user()->company_id) {
                $company_id = auth()->user()->company_id;
            } else {
                $company_id = 3;
            }
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
            ->join('users', 'quiz_domain_value_answers.user_id', '=', 'users.id')  // Join with users table
            ->where('users.company_id', '=', $company_id)
            ->where('users.is_admin', 0)
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
        return (array) $results;
    }

    public static function getWorkInterestResultFullByDepartment($department_id) {
        $results = DB::table('quiz_domain_value_answers')
        ->join('quiz_domain_value_questions', 'quiz_domain_value_answers.quiz_domain_value_question_id', '=', 'quiz_domain_value_questions.id')
        ->join('quiz_domain_values', 'quiz_domain_value_questions.quiz_domain_value_id', '=', 'quiz_domain_values.id')
        ->join('users', 'quiz_domain_value_answers.user_id', '=', 'users.id')  // Join with users table
        ->where('quiz_domain_values.id', '>', 18)
        ->where('quiz_domain_values.id', '<=', 24)
        ->where('users.department_id', '=', $department_id)
        ->select('quiz_domain_values.title as name')
        ->selectRaw('(COUNT(DISTINCT quiz_domain_value_answers.user_id)) as user_count')
        ->selectRaw('ROUND((SUM(quiz_domain_value_answers.answer) / (COUNT(DISTINCT quiz_domain_value_answers.user_id))), 2) as answer_avg_population')
        ->groupBy('quiz_domain_values.title')
        ->get();

        $workInterestOverallResult = [];
        $workInterestOverallResult['Realistic'] = 0;
        $workInterestOverallResult['Investigative'] = 0;
        $workInterestOverallResult['Artistic'] = 0;
        $workInterestOverallResult['Social'] = 0;
        $workInterestOverallResult['Enterprising'] = 0;
        $workInterestOverallResult['Conventional'] = 0;

        foreach ($results as $result) {
            $workInterestOverallResult[$result->name] =  $result->answer_avg_population;
        }

        $top_names_first_letters = AssessmentHelper::getTop3RIASECFull($results,1);
        $top_names_first_letters_based_on_score = AssessmentHelper::getTop3RIASECFullBasedOnScore($results,1);

        $top3Riasec = DB::table('master_top_3_riasec_descriptions')->where('top_3_riasec', 'like', "%$top_names_first_letters%")->first();

        $workInterestOverallResult['top_3_riasec'] = $top_names_first_letters_based_on_score ?? '';
        $workInterestOverallResult['top_3_riasec_description'] = $top3Riasec->description ?? '';

        $results = $workInterestOverallResult;
        
        return $results;
    }

    public static function getWorkInterestResultFull($user_id,$isPopulation=0){
        if($isPopulation) {
           if(auth()->user()->company_id) {
             $company_id = auth()->user()->company_id;
           } else {
            $company_id = 3;
           }
           $results = DB::table('quiz_domain_value_answers')
            ->join('quiz_domain_value_questions', 'quiz_domain_value_answers.quiz_domain_value_question_id', '=', 'quiz_domain_value_questions.id')
            ->join('quiz_domain_values', 'quiz_domain_value_questions.quiz_domain_value_id', '=', 'quiz_domain_values.id')
            ->join('users', 'quiz_domain_value_answers.user_id', '=', 'users.id')  // Join with users table
            ->where('quiz_domain_values.id', '>', 18)
            ->where('quiz_domain_values.id', '<=', 24)
            ->where('users.company_id', '=', $company_id)
            ->select('quiz_domain_values.title as name')
            ->selectRaw('(COUNT(DISTINCT quiz_domain_value_answers.user_id)) as user_count')
            ->selectRaw('ROUND((SUM(quiz_domain_value_answers.answer) / (COUNT(DISTINCT quiz_domain_value_answers.user_id))), 2) as answer_avg_population')
            ->groupBy('quiz_domain_values.title')
            ->get();

            $workInterestOverallResult = [];
            $workInterestOverallResult['Realistic'] = 0;
            $workInterestOverallResult['Investigative'] = 0;
            $workInterestOverallResult['Artistic'] = 0;
            $workInterestOverallResult['Social'] = 0;
            $workInterestOverallResult['Enterprising'] = 0;
            $workInterestOverallResult['Conventional'] = 0;

            foreach ($results as $result) {
                $workInterestOverallResult[$result->name] =  $result->answer_avg_population;
            }

            $top_names_first_letters = AssessmentHelper::getTop3RIASECFull($results,1);
            $top_names_first_letters_based_on_score = AssessmentHelper::getTop3RIASECFullBasedOnScore($results,1);

            $top3Riasec = DB::table('master_top_3_riasec_descriptions')->where('top_3_riasec', 'like', "%$top_names_first_letters%")->first();

            $workInterestOverallResult['top_3_riasec'] = $top_names_first_letters_based_on_score ?? '';
            $workInterestOverallResult['top_3_riasec_description'] = $top3Riasec->description ?? '';

            $results = $workInterestOverallResult;
            
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

            $workInterestResult = [];
            $workInterestResult['Realistic'] = 0;
            $workInterestResult['Investigative'] = 0;
            $workInterestResult['Artistic'] = 0;
            $workInterestResult['Social'] = 0;
            $workInterestResult['Enterprising'] = 0;
            $workInterestResult['Conventional'] = 0;

            foreach ($results as $result) {
                $workInterestResult[$result->name] =  $result->percentage;
            }

            $top_names_first_letters = AssessmentHelper::getTop3RIASECFull($results);
            $top_names_first_letters_based_on_score = AssessmentHelper::getTop3RIASECFullBasedOnScore($results);

            // $top3Riasec = DB::table('master_top_3_riasec_descriptions')->where('top_3_riasec', 'like', "%$top_names_first_letters%")->first();
            $top3Riasec = DB::table('master_top_3_riasec_descriptions')->where('top_3_riasec', $top_names_first_letters)->first();
 
            $workInterestResult['top_3_riasec'] = $top_names_first_letters_based_on_score ?? '';
            $workInterestResult['top_3_riasec_description'] = $top3Riasec->description ?? '';

            $results = $workInterestResult;
            
        }
        return $results;
    }

    public static function getWorkCompetencyResultFullByDepartment($department_id) {
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
                            (C4+C5+E4)/3 AS BARTRAM8,
                            user_id
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
                                qdva.user_id
                            FROM quiz_domain_value_answers qdva
                            GROUP BY qdva.user_id
                        ) AS ocean
                    )
                    SELECT
                        'Critical Thinking' AS aspect,
                        AVG(BARTRAM1) AS value
                    FROM bartram
                    JOIN users ON bartram.user_id = users.id
                    WHERE users.department_id = $department_id
                    UNION ALL
                    SELECT
                        'Creativity' AS aspect,
                        AVG(BARTRAM2) AS value
                    FROM bartram
                    JOIN users ON bartram.user_id = users.id
                    WHERE users.department_id = $department_id
                    UNION ALL
                    SELECT
                        'Communication' AS aspect,
                        AVG(BARTRAM3) AS value
                    FROM bartram
                    JOIN users ON bartram.user_id = users.id
                    WHERE users.department_id = $department_id
                    UNION ALL
                    SELECT
                        'Leadership' AS aspect,
                        AVG(BARTRAM4) AS value
                    FROM bartram
                    JOIN users ON bartram.user_id = users.id
                    WHERE users.department_id = $department_id
                    UNION ALL
                    SELECT
                        'Teamwork' AS aspect,
                        AVG(BARTRAM5) AS value
                    FROM bartram
                    JOIN users ON bartram.user_id = users.id
                    WHERE users.department_id = $department_id
                    UNION ALL
                    SELECT
                        'Adaptability' AS aspect,
                        AVG(BARTRAM6) AS value
                    FROM bartram
                    JOIN users ON bartram.user_id = users.id
                    WHERE users.department_id = $department_id
                    UNION ALL
                    SELECT
                        'Systematic Planning' AS aspect,
                        AVG(BARTRAM7) AS value
                    FROM bartram
                    JOIN users ON bartram.user_id = users.id
                    WHERE users.department_id = $department_id
                    UNION ALL
                    SELECT
                        'Achievement Orientation' AS aspect,
                        AVG(BARTRAM8) AS value
                    FROM bartram
                    JOIN users ON bartram.user_id = users.id
                    WHERE users.department_id = $department_id
                "));
                // dd($results);
                $workCompetencyOverallResult = [];
                $workCompetencyOverallResult['Critical Thinking'] = 68.48;
                $workCompetencyOverallResult['Creativity'] = 63.11;
                $workCompetencyOverallResult['Communication'] = 67.58;
                $workCompetencyOverallResult['Leadership'] = 67.59;
                $workCompetencyOverallResult['Teamwork'] = 73.14;
                $workCompetencyOverallResult['Adaptability'] = 61.30;
                $workCompetencyOverallResult['Systematic Planning'] = 75.09;
                $workCompetencyOverallResult['Achievement Orientation'] = 68.07;


                foreach ($results as $ores) {
                    $workCompetencyOverallResult[$ores->aspect] = $ores->value;
                }

                $results = $workCompetencyOverallResult;
            
                return $results;
    }

    public static function getWorkCompetencyResultFull($user_id,$isPopulation=0){
        if($isPopulation) {
            if(auth()->user()->company_id) {
                $company_id = auth()->user()->company_id;
              } else {
               $company_id = 3;
              }
            //   $results = DB::select(DB::raw("
            //     WITH bartram AS (
            //         SELECT
            //             (O5+A4+O3)/3 AS BARTRAM1,
            //             (O4+O2+O6)/3 AS BARTRAM2,
            //             (E2+E1+E6)/3 AS BARTRAM3,
            //             (E3+A5+C1)/3 AS BARTRAM4,
            //             (A3+A6+A1)/3 AS BARTRAM5,
            //             (N6+N1+N3)/3 AS BARTRAM6,
            //             (C2+C6+C3)/3 AS BARTRAM7,
            //             (C4+C5+E4)/3 AS BARTRAM8,
            //             user_id
            //         FROM (
            //             SELECT
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (115,145,175,205) THEN answer ELSE 0 END)*5 AS N1,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (120,150,180,210) THEN answer ELSE 0 END)*5 AS N2,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (125,155,185,215) THEN answer ELSE 0 END)*5 AS N3,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (130,160,190,220) THEN answer ELSE 0 END)*5 AS N4,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (135,165,195,225) THEN answer ELSE 0 END)*5 AS N5,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (140,170,200,230) THEN answer ELSE 0 END)*5 AS N6,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (116,146,176,206) THEN answer ELSE 0 END)*5 AS E1,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (121,151,181,211) THEN answer ELSE 0 END)*5 AS E2,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (126,156,186,216) THEN answer ELSE 0 END)*5 AS E3,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (131,161,191,221) THEN answer ELSE 0 END)*5 AS E4,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (136,166,196,226) THEN answer ELSE 0 END)*5 AS E5,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (141,171,201,231) THEN answer ELSE 0 END)*5 AS E6,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (117,147,177,207) THEN answer ELSE 0 END)*5 AS O1,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (122,152,182,212) THEN answer ELSE 0 END)*5 AS O2,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (127,157,187,217) THEN answer ELSE 0 END)*5 AS O3,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (132,162,192,222) THEN answer ELSE 0 END)*5 AS O4,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (137,167,197,227) THEN answer ELSE 0 END)*5 AS O5,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (142,172,202,232) THEN answer ELSE 0 END)*5 AS O6,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (118,148,178,208) THEN answer ELSE 0 END)*5 AS A1,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (123,153,183,213) THEN answer ELSE 0 END)*5 AS A2,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (158,128,188,218) THEN answer ELSE 0 END)*5 AS A3,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (133,163,193,223) THEN answer ELSE 0 END)*5 AS A4,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (138,168,198,228) THEN answer ELSE 0 END)*5 AS A5,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (143,173,203,233) THEN answer ELSE 0 END)*5 AS A6,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (119,149,179,209) THEN answer ELSE 0 END)*5 AS C1,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (124,154,184,214) THEN answer ELSE 0 END)*5 AS C2,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (129,159,189,219) THEN answer ELSE 0 END)*5 AS C3,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (164,134,224,194) THEN answer ELSE 0 END)*5 AS C4,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (139,169,199,229) THEN answer ELSE 0 END)*5 AS C5,
            //                 SUM(CASE WHEN qdva.quiz_domain_value_question_id IN (144,174,204,234) THEN answer ELSE 0 END)*5 AS C6,
            //                 qdva.user_id
            //             FROM quiz_domain_value_answers qdva
            //             GROUP BY qdva.user_id
            //         ) AS ocean
            //     )
            //     SELECT
            //         'Critical Thinking' AS aspect,
            //         AVG(BARTRAM1) AS value
            //     FROM bartram
            //     JOIN users ON bartram.user_id = users.id
            //     WHERE users.company_id = $company_id
            //     UNION ALL
            //     SELECT
            //         'Creativity' AS aspect,
            //         AVG(BARTRAM2) AS value
            //     FROM bartram
            //     JOIN users ON bartram.user_id = users.id
            //     WHERE users.company_id = $company_id
            //     UNION ALL
            //     SELECT
            //         'Communication' AS aspect,
            //         AVG(BARTRAM3) AS value
            //     FROM bartram
            //     JOIN users ON bartram.user_id = users.id
            //     WHERE users.company_id = $company_id
            //     UNION ALL
            //     SELECT
            //         'Leadership' AS aspect,
            //         AVG(BARTRAM4) AS value
            //     FROM bartram
            //     JOIN users ON bartram.user_id = users.id
            //     WHERE users.company_id = $company_id
            //     UNION ALL
            //     SELECT
            //         'Teamwork' AS aspect,
            //         AVG(BARTRAM5) AS value
            //     FROM bartram
            //     JOIN users ON bartram.user_id = users.id
            //     WHERE users.company_id = $company_id
            //     UNION ALL
            //     SELECT
            //         'Adaptability' AS aspect,
            //         AVG(BARTRAM6) AS value
            //     FROM bartram
            //     JOIN users ON bartram.user_id = users.id
            //     WHERE users.company_id = $company_id
            //     UNION ALL
            //     SELECT
            //         'Systematic Planning' AS aspect,
            //         AVG(BARTRAM7) AS value
            //     FROM bartram
            //     JOIN users ON bartram.user_id = users.id
            //     WHERE users.company_id = $company_id
            //     UNION ALL
            //     SELECT
            //         'Achievement Orientation' AS aspect,
            //         AVG(BARTRAM8) AS value
            //     FROM bartram
            //     JOIN users ON bartram.user_id = users.id
            //     WHERE users.company_id = $company_id
            // "));
            $averages = User::where('is_cognitive_ability_completed', '=', 1)
                                ->where('is_work_interest_completed', '=', 1)
                                ->where('is_personality_motivation_completed', '=', 1)
                                ->where('company_id', '=', 3)
                                ->select([
                                        DB::raw('AVG(tp_critical_thinking_score) as avg_critical_thinking'),
                                        DB::raw('AVG(tp_creativity_score) as avg_creativity'),
                                        DB::raw('AVG(tp_communication_score) as avg_communication'),
                                        DB::raw('AVG(tp_leadership_score) as avg_leadership'),
                                        DB::raw('AVG(tp_teamwork_score) as avg_teamwork'),
                                        DB::raw('AVG(tp_adaptability_score) as avg_adaptability'),
                                        DB::raw('AVG(tp_systematic_planning_score) as avg_systematic_planning'),
                                        DB::raw('AVG(tp_achievement_orientation_score) as avg_achievement_orientation'),
                                ])->first();
            
            $workCompetencyOverallResult = [];
            $workCompetencyOverallResult['Critical Thinking'] = $averages['tp_critical_thinking_score'];
            $workCompetencyOverallResult['Creativity'] = $averages['tp_creativity_score'];
            $workCompetencyOverallResult['Communication'] = $averages['tp_communication_score'];
            $workCompetencyOverallResult['Leadership'] = $averages['tp_leadership_score'];
            $workCompetencyOverallResult['Teamwork'] = $averages['tp_teamwork_score'];
            $workCompetencyOverallResult['Adaptability'] = $averages['tp_adaptability_score'];
            $workCompetencyOverallResult['Systematic Planning'] = $averages['tp_systematic_planning_score'];
            $workCompetencyOverallResult['Achievement Orientation'] = $averages['tp_achievement_orientation_score'];


            // foreach ($results as $ores) {
            //     $workCompetencyOverallResult[$ores->aspect] = $ores->value;
            // }

            $results = $workCompetencyOverallResult;
            
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

            $workCompetencyResult = [];
            $workCompetencyResult['Critical Thinking'] = 0;
            $workCompetencyResult['Creativity'] = 0;
            $workCompetencyResult['Communication'] = 0;
            $workCompetencyResult['Leadership'] = 0;
            $workCompetencyResult['Teamwork'] = 0;
            $workCompetencyResult['Adaptability'] = 0;
            $workCompetencyResult['Systematic Planning'] = 0;
            $workCompetencyResult['Achievement Orientation'] = 0;
    
            foreach ($results as $res) {
                $workCompetencyResult[$res->aspect] = $res->value;
            }

            $results = $workCompetencyResult;
            
        }
        return $results;
    }

    public static function getTop3RIASECFull($workInterestResults,$isPopulation=0) {
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

    public static function getTop3RIASECFullBasedOnScore($workInterestResults,$isPopulation=0) {
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
        
        // // Sorting based on letter RIASEC
        // $riasec_values = [
        //     'R' => 1,
        //     'I' => 2,
        //     'A' => 3,
        //     'S' => 4,
        //     'E' => 5,
        //     'C' => 6
        // ];

        // $top_names_first_letters_array = str_split($top_names_first_letters);
        // // Sort the letters based on their RIASEC values
        // usort($top_names_first_letters_array, function($a, $b) use ($riasec_values) {
        //     return $riasec_values[$a] <=> $riasec_values[$b];
        // });
        
        // $top_names_first_letters = implode('', $top_names_first_letters_array);

        return $top_names_first_letters;
    }

    public static function getCognitiveResultFull($user_id) {
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
                                    WHEN SUM(quiz_domain_value_answers.answer) <= 2 THEN "1"
                                    WHEN SUM(quiz_domain_value_answers.answer) BETWEEN 3 AND 6 THEN "2"
                                    WHEN SUM(quiz_domain_value_answers.answer) >= 7 THEN "3"
                                    ELSE "1"
                                END as level')
                    )
                    ->groupBy('quiz_domain_values.title', 'quiz_domain_values.id')
                    ->get();
        
        $cognitiveResult = [];
        $cognitiveResult['Quantitative Knowledge'] = 0;
        $cognitiveResult['Comprehension Knowledge'] = 0;
        $cognitiveResult['Visual Reasoning'] = 0;
        $cognitiveResult['Fluid Reasoning'] = 0;

        foreach ($results as $res) {
            $cognitiveResult[$res->name] = $res->level;
        }

        return $cognitiveResult;
    }

    public static function getCognitiveResultFullByDepartment($department_id) {
        $results = DB::table('quiz_domain_value_answers')
    ->join('quiz_domain_value_questions', 'quiz_domain_value_answers.quiz_domain_value_question_id', '=', 'quiz_domain_value_questions.id')
    ->join('quiz_domain_values', 'quiz_domain_value_questions.quiz_domain_value_id', '=', 'quiz_domain_values.id')
    ->join('users', 'quiz_domain_value_answers.user_id', '=', 'users.id')
    ->where('quiz_domain_value_questions.quiz_domain_value_id', '>', 69)
    ->where('users.department_id', $department_id)
    ->where('is_cognitive_ability_completed', 1)
    ->select(
        'quiz_domain_values.title as name',
        'quiz_domain_values.id as quiz_domain_value_id',
        DB::raw('SUM(quiz_domain_value_answers.answer) as total_marks')
    )
    ->groupBy('quiz_domain_values.title', 'quiz_domain_values.id')
    ->get()
    ->map(function ($item) {
        $item->average_level = $item->total_marks <= 5 ? 1 :
                              ($item->total_marks >= 6 && $item->total_marks <= 9 ? 2 : 3);
        return $item;
    });

    
        
        $cognitiveResult = [];
        $cognitiveResult['Quantitative Knowledge'] = 0;
        $cognitiveResult['Comprehension Knowledge'] = 0;
        $cognitiveResult['Visual Reasoning'] = 0;
        $cognitiveResult['Fluid Reasoning'] = 0;

        foreach ($results as $res) {
            $cognitiveResult[$res->name] = $res->average_level;
        }

        return $cognitiveResult;
    }

    public static function getCognitiveResultFullPopulation() {

        if(auth()->user()->company_id) {
            $company_id = auth()->user()->company_id;
        } else {
            $company_id = 3;
        }

        $results = DB::table('quiz_domain_value_answers')
                    ->join('quiz_domain_value_questions', 'quiz_domain_value_answers.quiz_domain_value_question_id', '=', 'quiz_domain_value_questions.id')
                    ->join('quiz_domain_values', 'quiz_domain_value_questions.quiz_domain_value_id', '=', 'quiz_domain_values.id')
                    ->join('users', 'quiz_domain_value_answers.user_id', '=', 'users.id')
                    ->where('quiz_domain_value_questions.quiz_domain_value_id', '>', 69)
                    ->where('users.is_cognitive_ability_completed', '=', 1)
                    ->where('users.is_work_interest_completed', '=', 1)
                    ->where('users.is_personality_motivation_completed', '=', 1)
                    ->where('users.company_id', $company_id)
                    ->where('users.is_admin', 0)
                    ->select(
                        'quiz_domain_values.title as name',
                        'quiz_domain_values.id as quiz_domain_value_id',
                        DB::raw('SUM(quiz_domain_value_answers.answer) as total_marks')
                    )
                    ->groupBy('quiz_domain_values.title', 'quiz_domain_values.id')
                    ->get()
                    ->map(function ($item) {
                        $item->average_level = $item->total_marks <= 5 ? 1 :
                                            ($item->total_marks >= 6 && $item->total_marks <= 9 ? 2 : 3);
                        return $item;
                    });

    
        
        $cognitiveResult = [];
        $cognitiveResult['Quantitative Knowledge'] = 0;
        $cognitiveResult['Comprehension Knowledge'] = 0;
        $cognitiveResult['Visual Reasoning'] = 0;
        $cognitiveResult['Fluid Reasoning'] = 0;

        foreach ($results as $res) {
            $cognitiveResult[$res->name] = $res->average_level;
        }

        return $cognitiveResult;
    }

    public static function getFlightRiskFull($all_facets) {
        $flight_score = 0;
            
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
            $flight_level = 'Low';
        } elseif ($flight_score < -7) {
            $flight_level = 'High';
        } else {
            $flight_level = 'Moderate';
        }

        $result['flight_risk_score'] = $flight_score;
        $result['flight_risk_level'] = $flight_level;

        return $result;

            
    }

    public static function getFlightRiskByDepartmentAndPosition($is_position,$department_id=0) {
        if($is_position) {
            // Individual user risk level calculation based on facet scores
            // Flight Risk
            // $all_facets2 = AssessmentHelper::getOCEANAllFacetsResultFull(2,0);
            // $flight_risk2 = AssessmentHelper::getFlightRiskFull($all_facets2);

            // $all_facets1571 = AssessmentHelper::getOCEANAllFacetsResultFull(1571,0);
            // $flight_risk1571 = AssessmentHelper::getFlightRiskFull($all_facets1571);

            // dd($flight_risk2, $flight_risk1571);
            
            $results = DB::table(DB::raw('(
                SELECT 
                    u.id as user_id,
                    u.company_id,
                    u.position_id,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (157, 162, 167, 172) THEN qdva.answer ELSE NULL END) as avg_157_172,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (177, 182, 187, 192) THEN qdva.answer ELSE NULL END) as avg_177_192,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (197, 202, 207, 212) THEN qdva.answer ELSE NULL END) as avg_197_212,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (217, 222, 227, 232) THEN qdva.answer ELSE NULL END) as avg_217_232,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (119, 124, 129, 134) THEN qdva.answer ELSE NULL END) as avg_119_134,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (159, 164, 169, 174) THEN qdva.answer ELSE NULL END) as avg_159_174,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (179, 184, 189, 194) THEN qdva.answer ELSE NULL END) as avg_179_194,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (219, 224, 229, 234) THEN qdva.answer ELSE NULL END) as avg_219_234,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (136, 141, 146, 151) THEN qdva.answer ELSE NULL END) as avg_136_151,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (176, 181, 186, 191) THEN qdva.answer ELSE NULL END) as avg_176_191,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (216, 221, 226, 231) THEN qdva.answer ELSE NULL END) as avg_216_231,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (118, 123, 128, 133) THEN qdva.answer ELSE NULL END) as avg_118_133,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (138, 143, 148, 153) THEN qdva.answer ELSE NULL END) as avg_138_153,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (218, 223, 228, 233) THEN qdva.answer ELSE NULL END) as avg_218_233,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (135, 140, 145, 150) THEN qdva.answer ELSE NULL END) as avg_135_150,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (155, 160, 165, 170) THEN qdva.answer ELSE NULL END) as avg_155_170,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (195, 200, 205, 210) THEN qdva.answer ELSE NULL END) as avg_195_210
                FROM quiz_domain_value_answers as qdva
                JOIN users as u ON qdva.user_id = u.id
                GROUP BY u.id, u.position_id, u.company_id
            ) as sub'))
            ->join('jobs as p', 'sub.position_id', '=', 'p.id')
            ->select([
                'p.id as position_id',
                'p.level as position_name',
                DB::raw('COUNT(sub.user_id) as number_of_users'),
                DB::raw('AVG(CASE 
                    WHEN (
                        SIGN(IF(sub.avg_157_172 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_177_192 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_197_212 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_217_232 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_119_134 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_159_174 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_179_194 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_219_234 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_136_151 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_176_191 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_216_231 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_118_133 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_138_153 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_218_233 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_135_150 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_155_170 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_195_210 >= 3.5, 1, -1))
                    ) >= 0 THEN 0
                    WHEN (
                        SIGN(IF(sub.avg_157_172 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_177_192 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_197_212 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_217_232 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_119_134 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_159_174 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_179_194 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_219_234 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_136_151 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_176_191 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_216_231 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_118_133 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_138_153 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_218_233 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_135_150 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_155_170 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_195_210 >= 3.5, 1, -1))
                    ) < -12 THEN 66.66
                    ELSE 33.33
                END) as average_risk_level')
            ])
            ->where('sub.company_id', auth()->user()->id) # Use 'sub' to reference the company_id from the subquery
            ->groupBy('p.level');

            if($department_id){
                $results->where('p.department_id', $department_id);
            }
            $results = $results->get();
            
                     
        } else {
            $results = DB::table(DB::raw('(
                SELECT 
                    u.id as user_id,
                    u.company_id,  -- Ensure company_id is selected
                    u.team_id,
                    u.department_id,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (157, 162, 167, 172) THEN qdva.answer ELSE NULL END) as avg_157_172,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (177, 182, 187, 192) THEN qdva.answer ELSE NULL END) as avg_177_192,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (197, 202, 207, 212) THEN qdva.answer ELSE NULL END) as avg_197_212,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (217, 222, 227, 232) THEN qdva.answer ELSE NULL END) as avg_217_232,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (119, 124, 129, 134) THEN qdva.answer ELSE NULL END) as avg_119_134,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (159, 164, 169, 174) THEN qdva.answer ELSE NULL END) as avg_159_174,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (179, 184, 189, 194) THEN qdva.answer ELSE NULL END) as avg_179_194,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (219, 224, 229, 234) THEN qdva.answer ELSE NULL END) as avg_219_234,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (136, 141, 146, 151) THEN qdva.answer ELSE NULL END) as avg_136_151,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (176, 181, 186, 191) THEN qdva.answer ELSE NULL END) as avg_176_191,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (216, 221, 226, 231) THEN qdva.answer ELSE NULL END) as avg_216_231,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (118, 123, 128, 133) THEN qdva.answer ELSE NULL END) as avg_118_133,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (138, 143, 148, 153) THEN qdva.answer ELSE NULL END) as avg_138_153,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (218, 223, 228, 233) THEN qdva.answer ELSE NULL END) as avg_218_233,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (135, 140, 145, 150) THEN qdva.answer ELSE NULL END) as avg_135_150,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (155, 160, 165, 170) THEN qdva.answer ELSE NULL END) as avg_155_170,
                    AVG(CASE WHEN qdva.quiz_domain_value_question_id IN (195, 200, 205, 210) THEN qdva.answer ELSE NULL END) as avg_195_210
                FROM quiz_domain_value_answers as qdva
                JOIN users as u ON qdva.user_id = u.id
                GROUP BY u.id, u.department_id, u.company_id  -- Group by company_id to include it in the result set
            ) as sub'))
            ->join('departments as departments', 'sub.department_id', '=', 'departments.id')
            ->select([
                'departments.name as department_name',
                DB::raw('COUNT(sub.user_id) as number_of_users'),
                DB::raw('AVG(CASE 
                    WHEN (
                        SIGN(IF(sub.avg_157_172 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_177_192 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_197_212 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_217_232 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_119_134 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_159_174 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_179_194 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_219_234 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_136_151 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_176_191 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_216_231 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_118_133 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_138_153 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_218_233 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_135_150 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_155_170 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_195_210 >= 3.5, 1, -1))
                    ) >= 0 THEN 0
                    WHEN (
                        SIGN(IF(sub.avg_157_172 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_177_192 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_197_212 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_217_232 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_119_134 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_159_174 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_179_194 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_219_234 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_136_151 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_176_191 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_216_231 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_118_133 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_138_153 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_218_233 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_135_150 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_155_170 >= 3.5, 1, -1)) +
                        SIGN(IF(sub.avg_195_210 >= 3.5, 1, -1))
                    ) < -12 THEN 66.66
                    ELSE 33.33
                END) as average_risk_level')
            ])
            ->where('sub.company_id', auth()->user()->id)  # Use 'sub' to reference the company_id from the subquery
            ->groupBy('departments.name');



            if($department_id){
                $results->where('departments.id', $department_id);
            }
            $results = $results->get();
        }

        // Format the average_risk_level to two decimal places
        foreach ($results as $result) {
            $result->average_risk_level = round($result->average_risk_level, 2);
        }
        return $results;
    }

    public static function getOrganizationalFitForecast($allfacets) {
        // Narcissism
        $assertiveness = $allfacets['confidence_avg'] ?? 0;
        $cheerfulness = $allfacets['optimism_avg'] ?? 0;
        $trust = $allfacets['belief_avg'] ?? 0;
        $modesty = $allfacets['humility_avg'] ?? 0;
        $imagination = $allfacets['daydreaming_avg'] ?? 0;
        $artistic_interest = $allfacets['aesthetic_appreciation_avg'] ?? 0;

        $narcissism = (($assertiveness / 5)*0.25 + ($cheerfulness / 5)*0.1 + ((6 - $trust) / 5)*0.2 + ((6 - $modesty) /5)*0.15 + ($imagination / 5)*0.15 + ($artistic_interest / 5)*0.15);

        // Machiavellianism
        $trust = $allfacets['belief_avg'] ?? 0;
        $morality = $allfacets['honesty_avg'] ?? 0;
        $cautiousness = $allfacets['careful_thinking_avg'] ?? 0;
        $adventurousness = $allfacets['explorer_avg'] ?? 0;
        $liberalism = $allfacets['open_mindedness_avg'] ?? 0;

        $machiavellianism = (((6 - $trust) / 5)*0.3 + ((6 - $morality)/5)*0.3 + ($cautiousness / 5)*0.1 + ($adventurousness / 5)*0.15 + ($liberalism / 5)*0.15);
        
        // Psychopathy
        $excitement_seeking = $allfacets['thrill_seeking_avg'] ?? 0;
        $trust = $allfacets['belief_avg'] ?? 0;
        $morality = $allfacets['honesty_avg'] ?? 0;
        $altruism = $allfacets['helpfulness_avg'] ?? 0;
        $anger = $allfacets['tolerance_avg'] ?? 0;
        $immoderation = $allfacets['impulse_control_avg'] ?? 0;
        $vulnerability = $allfacets['stress_response_avg'] ?? 0;


        $psychopathy = (($excitement_seeking / 5)*0.2 + ((6 - $trust) / 5)*0.2 + ((6 - $morality) / 5)*0.25 + ((6 - $altruism) / 5)*0.1 + ($anger / 5)*0.15 + ($immoderation / 5)*0.05 + ($vulnerability / 5)*0.05);

        $dark_triads = ($narcissism + $machiavellianism + $psychopathy) / 3;

        $dark_triads_in_percentage = $dark_triads*100;

        if ($dark_triads_in_percentage <= 60) {
            $organizational_fit_forecast_result = 'low';
        } elseif ($dark_triads_in_percentage >= 63) {
            $organizational_fit_forecast_result = 'high';
        } else {
            $organizational_fit_forecast_result = 'moderate';
        }

        return $organizational_fit_forecast_result;
    }

    public static function getOrganizationalFitForecastForPipeline($allfacets) {
        // Narcissism
        $assertiveness = $allfacets['confidence_avg'] ?? 0;
        $cheerfulness = $allfacets['optimism_avg'] ?? 0;
        $trust = $allfacets['belief_avg'] ?? 0;
        $modesty = $allfacets['humility_avg'] ?? 0;
        $imagination = $allfacets['daydreaming_avg'] ?? 0;
        $artistic_interest = $allfacets['aesthetic_appreciation_avg'] ?? 0;

        $narcissism = (($assertiveness / 5)*0.25 + ($cheerfulness / 5)*0.1 + ((6 - $trust) / 5)*0.2 + ((6 - $modesty) /5)*0.15 + ($imagination / 5)*0.15 + ($artistic_interest / 5)*0.15);

        // Machiavellianism
        $trust = $allfacets['belief_avg'] ?? 0;
        $morality = $allfacets['honesty_avg'] ?? 0;
        $cautiousness = $allfacets['careful_thinking_avg'] ?? 0;
        $adventurousness = $allfacets['explorer_avg'] ?? 0;
        $liberalism = $allfacets['open_mindedness_avg'] ?? 0;

        $machiavellianism = (((6 - $trust) / 5)*0.3 + ((6 - $morality)/5)*0.3 + ($cautiousness / 5)*0.1 + ($adventurousness / 5)*0.15 + ($liberalism / 5)*0.15);
        
        // Psychopathy
        $excitement_seeking = $allfacets['thrill_seeking_avg'] ?? 0;
        $trust = $allfacets['belief_avg'] ?? 0;
        $morality = $allfacets['honesty_avg'] ?? 0;
        $altruism = $allfacets['helpfulness_avg'] ?? 0;
        $anger = $allfacets['tolerance_avg'] ?? 0;
        $immoderation = $allfacets['impulse_control_avg'] ?? 0;
        $vulnerability = $allfacets['stress_response_avg'] ?? 0;


        $psychopathy = (($excitement_seeking / 5)*0.2 + ((6 - $trust) / 5)*0.2 + ((6 - $morality) / 5)*0.25 + ((6 - $altruism) / 5)*0.1 + ($anger / 5)*0.15 + ($immoderation / 5)*0.05 + ($vulnerability / 5)*0.05);

        $dark_triads = ($narcissism + $machiavellianism + $psychopathy) / 3;

        $dark_triads_in_percentage = $dark_triads*100;
        $result['percentage'] = $dark_triads_in_percentage;

        if ($dark_triads_in_percentage <= 60) {
            $organizational_fit_forecast_result = 'low';
            $result['level'] = 'low';
        } elseif ($dark_triads_in_percentage >= 63) {
            $organizational_fit_forecast_result = 'high';
            $result['level'] = 'high';
        } else {
            $organizational_fit_forecast_result = 'moderate';
            $result['level'] = 'moderate';
        }

        // return $organizational_fit_forecast_result;
        return $result;
    }

    public static function getInterviewPerformance($interview_score) {
        if($interview_score > 70){
            return 1;
        } elseif ($interview_score < 40) {
            return 3;
        } else {
            return 2;
        }
    }

    public static function getOCEANReliability($user_id,$isPopulation=0){
        $results = DB::table('quiz_domain_value_answers')->select([
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (117, 122, 127, 132) THEN answer ELSE NULL END) as daydreaming_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (137, 142, 147, 152) THEN answer ELSE NULL END) as aesthetic_appreciation_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (157, 162, 167, 172) THEN answer ELSE NULL END) as feeling_aware_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (177, 182, 187, 192) THEN answer ELSE NULL END) as explorer_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (197, 202, 207, 212) THEN answer ELSE NULL END) as innovation_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (217, 222, 227, 232) THEN answer ELSE NULL END) as open_mindedness_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (119, 124, 129, 134) THEN answer ELSE NULL END) as self_confidence_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (139, 144, 149, 154) THEN answer ELSE NULL END) as tidiness_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (159, 164, 169, 174) THEN answer ELSE NULL END) as responsibility_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (179, 184, 189, 194) THEN answer ELSE NULL END) as drive_to_achieve_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (199, 204, 209, 214) THEN answer ELSE NULL END) as will_power_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (219, 224, 229, 234) THEN answer ELSE NULL END) as careful_thinking_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (116, 121, 126, 131) THEN answer ELSE NULL END) as sociability_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (136, 141, 146, 151) THEN answer ELSE NULL END) as crowd_enjoyment_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (156, 161, 166, 171) THEN answer ELSE NULL END) as confidence_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (176, 181, 186, 191) THEN answer ELSE NULL END) as energetic_lifestyle_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (196, 201, 206, 211) THEN answer ELSE NULL END) as thrill_seeking_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (216, 221, 226, 231) THEN answer ELSE NULL END) as optimism_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (118, 123, 128, 133) THEN answer ELSE NULL END) as belief_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (138, 143, 148, 153) THEN answer ELSE NULL END) as honesty_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (158, 163, 168, 173) THEN answer ELSE NULL END) as helpfulness_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (178, 183, 188, 193) THEN answer ELSE NULL END) as diplomacy_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (198, 203, 208, 213) THEN answer ELSE NULL END) as humility_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (218, 223, 228, 233) THEN answer ELSE NULL END) as compassion_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (115, 120, 125, 130) THEN answer ELSE NULL END) as steadiness_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (135, 140, 145, 150) THEN answer ELSE NULL END) as tolerance_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (155, 160, 165, 170) THEN answer ELSE NULL END) as positivity_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (175, 180, 185, 190) THEN answer ELSE NULL END) as social_sensitivity_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (195, 200, 205, 210) THEN answer ELSE NULL END) as impulse_control_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN user_id = ' . $user_id . ' AND quiz_domain_value_question_id IN (215, 220, 225, 230) THEN answer ELSE NULL END) as stress_response_answers'),
            ])
            ->where('user_id', '=', $user_id)
            ->first();

        $confidence_score_array = [];

        foreach ($results as $all_facet_response) {
            $answers = explode(',', $all_facet_response);
            $unique_answers = array_unique($answers);

            if (count($unique_answers) == 1) { // If all answers are the same
                $confidence_score = 5;
            } else {
                $answer_counts = array_count_values($answers);
                $similar_answer = array_search(max($answer_counts), $answer_counts);
                $similar_count = $answer_counts[$similar_answer];
                $diff = array_sum(array_map(function($ans) use ($similar_answer) {
                    return abs($similar_answer - $ans);
                }, array_filter($answers, function($ans) use ($similar_answer) {
                    return $ans != $similar_answer;
                })));
                // Base score is 75
                $score = 75;

                // Adjust the score based on diff and similar_count
                if ($similar_count == 3) {
                    if ($diff == 1) {
                        $score -= $diff * 5;
                    } elseif ($diff == 2) {
                        $score -= $diff * 10;
                    } elseif ($diff == 3) {
                        $score -= $diff * 12;
                    } elseif ($diff == 4) {
                        $score -= $diff * 14;
                    }
                } elseif ($similar_count == 2) {
                    $max_diff = max($answers) - min($answers); // Calculate maximum difference
                    if ($max_diff == 1) { // Small difference between pairs
                        $score = 65; // Higher confidence
                    } elseif ($max_diff == 2) {
                        $score = 45;
                    } elseif ($max_diff == 3) {
                        $score = 25;
                    } elseif ($max_diff == 4) {
                        $score = 15;
                    } else { // Large difference between pairs
                        $score = 35; // Lower confidence
                    }
                } else {
                    $score = 20;
                }

                // Determine confidence_score based on the final score
                if ($score >= 81) {
                    $confidence_score = 5;
                } elseif ($score >= 61) {
                    $confidence_score = 4;
                } elseif ($score >= 41) {
                    $confidence_score = 3;
                } elseif ($score >= 21) {
                    $confidence_score = 2;
                } else {
                    $confidence_score = 1;
                }
            }
            
            $confidence_score_array[] = $confidence_score;
            
        }

        $average_confidence_score = array_sum($confidence_score_array)/count($confidence_score_array);
        if($average_confidence_score >= 3.75 ){
            $ocean_reliability = 'Very High';
        } elseif($average_confidence_score >= 3 && $average_confidence_score < 3.5) {
            $ocean_reliability = 'High';
        } elseif($average_confidence_score > 1.5 && $average_confidence_score < 3) {
            $ocean_reliability = 'Average';
        } else {
            $ocean_reliability = 'Low';
        }
        return $ocean_reliability;
    }

    public static function getOCEANReliabilityFacetWise($user_id) {
        // Step 1: Fetch answers for all facets
        $results = DB::table('quiz_domain_value_answers')->select([
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (117, 122, 127, 132) THEN answer ELSE NULL END) as daydreaming_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (137, 142, 147, 152) THEN answer ELSE NULL END) as aesthetic_appreciation_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (157, 162, 167, 172) THEN answer ELSE NULL END) as feeling_aware_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (177, 182, 187, 192) THEN answer ELSE NULL END) as explorer_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (197, 202, 207, 212) THEN answer ELSE NULL END) as innovation_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (217, 222, 227, 232) THEN answer ELSE NULL END) as open_mindedness_answers'),
    
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (119, 124, 129, 134) THEN answer ELSE NULL END) as self_confidence_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (139, 144, 149, 154) THEN answer ELSE NULL END) as tidiness_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (159, 164, 169, 174) THEN answer ELSE NULL END) as responsibility_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (179, 184, 189, 194) THEN answer ELSE NULL END) as drive_to_achieve_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (199, 204, 209, 214) THEN answer ELSE NULL END) as will_power_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (219, 224, 229, 234) THEN answer ELSE NULL END) as careful_thinking_answers'),
    
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (116, 121, 126, 131) THEN answer ELSE NULL END) as sociability_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (136, 141, 146, 151) THEN answer ELSE NULL END) as crowd_enjoyment_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (156, 161, 166, 171) THEN answer ELSE NULL END) as confidence_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (176, 181, 186, 191) THEN answer ELSE NULL END) as energetic_lifestyle_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (196, 201, 206, 211) THEN answer ELSE NULL END) as thrill_seeking_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (216, 221, 226, 231) THEN answer ELSE NULL END) as optimism_answers'),
    
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (118, 123, 128, 133) THEN answer ELSE NULL END) as belief_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (138, 143, 148, 153) THEN answer ELSE NULL END) as honesty_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (158, 163, 168, 173) THEN answer ELSE NULL END) as helpfulness_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (178, 183, 188, 193) THEN answer ELSE NULL END) as diplomacy_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (198, 203, 208, 213) THEN answer ELSE NULL END) as humility_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (218, 223, 228, 233) THEN answer ELSE NULL END) as compassion_answers'),
    
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (115, 120, 125, 130) THEN answer ELSE NULL END) as steadiness_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (135, 140, 145, 150) THEN answer ELSE NULL END) as tolerance_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (155, 160, 165, 170) THEN answer ELSE NULL END) as positivity_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (175, 180, 185, 190) THEN answer ELSE NULL END) as social_sensitivity_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (195, 200, 205, 210) THEN answer ELSE NULL END) as impulse_control_answers'),
                DB::raw('GROUP_CONCAT(CASE WHEN quiz_domain_value_question_id IN (215, 220, 225, 230) THEN answer ELSE NULL END) as stress_response_answers')
            ])
            ->where('user_id', '=', $user_id)
            ->first();
    
        // Step 2: Split results by facet
        $facets = [
            'O' => ['daydreaming_answers', 'aesthetic_appreciation_answers', 'feeling_aware_answers', 'explorer_answers', 'innovation_answers', 'open_mindedness_answers'],
            'C' => ['self_confidence_answers', 'tidiness_answers', 'responsibility_answers', 'drive_to_achieve_answers', 'will_power_answers', 'careful_thinking_answers'],
            'E' => ['sociability_answers', 'crowd_enjoyment_answers', 'confidence_answers', 'energetic_lifestyle_answers', 'thrill_seeking_answers', 'optimism_answers'],
            'A' => ['belief_answers', 'honesty_answers', 'helpfulness_answers', 'diplomacy_answers', 'humility_answers', 'compassion_answers'],
            'N' => ['steadiness_answers', 'tolerance_answers', 'positivity_answers', 'social_sensitivity_answers', 'impulse_control_answers', 'stress_response_answers']
        ];
    
        // Step 3: Calculate reliability for each facet
        $facet_reliabilities = [];
    
        foreach ($facets as $facet => $facet_keys) {
            $confidence_score_array = [];
    
            foreach ($facet_keys as $key) {
                $answers = explode(',', $results->$key);
                $unique_answers = array_unique($answers);
    
                if (count($unique_answers) == 1) {
                    $confidence_score = 5;
                } else {
                    $answer_counts = array_count_values($answers);
                    $similar_answer = array_search(max($answer_counts), $answer_counts);
                    $similar_count = $answer_counts[$similar_answer];
                    $diff = array_sum(array_map(function($ans) use ($similar_answer) {
                        return abs($similar_answer - $ans);
                    }, array_filter($answers, function($ans) use ($similar_answer) {
                        return $ans != $similar_answer;
                    })));
                    
                    $score = 75;
                    
                    if ($similar_count == 3) {
                        if ($diff == 1) {
                            $score -= $diff * 5;
                        } elseif ($diff == 2) {
                            $score -= $diff * 10;
                        } elseif ($diff == 3) {
                            $score -= $diff * 12;
                        } elseif ($diff == 4) {
                            $score -= $diff * 14;
                        }
                    } elseif ($similar_count == 2) {
                        $max_diff = max($answers) - min($answers);
                        if ($max_diff == 1) {
                            $score = 65;
                        } elseif ($max_diff == 2) {
                            $score = 45;
                        } elseif ($max_diff == 3) {
                            $score = 25;
                        } elseif ($max_diff == 4) {
                            $score = 15;
                        } else {
                            $score = 35;
                        }
                    } else {
                        $score = 20;
                    }
    
                    if ($score >= 81) {
                        $confidence_score = 5;
                    } elseif ($score >= 61) {
                        $confidence_score = 4;
                    } elseif ($score >= 41) {
                        $confidence_score = 3;
                    } elseif ($score >= 21) {
                        $confidence_score = 2;
                    } else {
                        $confidence_score = 1;
                    }
                }
    
                $confidence_score_array[] = $confidence_score;
            }
    
            $average_confidence_score = array_sum($confidence_score_array) / count($confidence_score_array);
    
            if ($average_confidence_score >= 3.75) {
                $facet_reliabilities[$facet] = 4;
            } elseif ($average_confidence_score >= 3 && $average_confidence_score < 3.5) {
                $facet_reliabilities[$facet] = 3;
            } elseif ($average_confidence_score > 1.5 && $average_confidence_score < 3) {
                $facet_reliabilities[$facet] = 2;
            } else {
                $facet_reliabilities[$facet] = 1;
            }
        }
        return $facet_reliabilities;
    }
    

    public static function getGrowthPotential($company_id,$growth_potential_score, $cognitive_score) {
        $growthStats = DB::table('users')->where('company_id', $company_id)
        ->where('is_admin', 0)
        ->where('is_personality_motivation_completed', '=', 1)
        ->where('is_work_interest_completed', '=', 1)
        ->where('is_cognitive_ability_completed', '=', 1)->whereNotNull('gp_percentage')->select(DB::raw('SUM(gp_percentage) as total_growth, COUNT(*) as count'))->first();
        
        $cognitiveStats = DB::table('users')->where('company_id',$company_id)->where('is_admin', 0)
        ->where('is_personality_motivation_completed', '=', 1)
        ->where('is_work_interest_completed', '=', 1)
        ->where('is_cognitive_ability_completed', '=', 1)->whereNotNull('gp_percentage')->select(DB::raw('SUM(cognitive_test_percentage) as total_cognitive, COUNT(*) as count'))->first();
        $avgGrowthPotential = $growthStats->total_growth / $growthStats->count;
        $avgCognitiveAssessment = $cognitiveStats->total_cognitive / $cognitiveStats->count;
        $growth_weight = 0.7;
        $cognitive_weight = 0.3;
        $combined_mean = self::calculateCombinedScore($avgGrowthPotential, $avgCognitiveAssessment, $growth_weight, $cognitive_weight);
        $variance = DB::select(DB::raw('
            SELECT SUM(POW(((gp_percentage * :growth_weight + cognitive_test_percentage * :cognitive_weight) / :total_weight) - :combined_mean, 2)) / COUNT(*) as variance
            FROM users
            WHERE company_id = :company_id
            AND is_personality_motivation_completed = 1
            AND is_work_interest_completed = 1
            AND is_cognitive_ability_completed = 1
            AND gp_percentage IS NOT NULL
        '), [
            'growth_weight' => $growth_weight,
            'cognitive_weight' => $cognitive_weight,
            'total_weight' => $growth_weight + $cognitive_weight,
            'combined_mean' => $combined_mean,
            'company_id' => auth()->user()->id
        ]);
        $combined_std_dev = sqrt($variance[0]->variance);

        // Calculate the combined score
        $combined_score = 0.7 * $growth_potential_score + 0.3 * $cognitive_score;
        // Determine the gp_potential based on the combined score
        if ($combined_score >= ($combined_mean + $combined_std_dev)) {
            $gp_potential = 'Super High';
        } elseif ($combined_score >= $combined_mean && $combined_score < ($combined_mean + $combined_std_dev)) {
            $gp_potential = 'Very High';
        } elseif ($combined_score >= ($combined_mean - $combined_std_dev) && $combined_score < $combined_mean) {
            $gp_potential = 'High';
        } else {
            $gp_potential = 'Average';
        }

        return $gp_potential;
    }

    private static function calculateCombinedScore($avgGrowthPotential, $avgCognitiveAssessment, $growth_weight, $cognitive_weight)
    {
        $total_weight = $growth_weight + $cognitive_weight;
        return ($avgGrowthPotential * $growth_weight + $avgCognitiveAssessment * $cognitive_weight) / $total_weight;
    }



    public static function generateUniquePositionCode()
    {
        // do {
            $code = strtoupper(Str::random(10));
        // } while (\App\Models\Job::where('position_code', $code)->exists());

        return $code;
    }

    private static function customRound($value) {
        return ($value - floor($value) < 0.5) ? floor($value) : ceil($value);
    }


    public static function getLearningStyle($user_id, $individual_ocean_score) {
        $data = [];
    
        // Calculate the scores for each learning style
        $data['visual_kinesthetic_score'] = ($individual_ocean_score['Openness to Experience'] + $individual_ocean_score['Agreeableness']) / 2;
        $data['aural_score'] = $individual_ocean_score['Extraversion'];
        $data['reading_writing_score'] = $individual_ocean_score['Conscientiousness'];

        $data['visual_kinesthetic_percentage'] = self::customRound($data['visual_kinesthetic_score'] * 20);
        $data['aural_percentage'] = self::customRound($data['aural_score'] * 20);
        $data['reading_writing_percentage'] = self::customRound($data['reading_writing_score'] * 20);
    
        // Retrieve learning styles from the database
        $visualKinesthetic = DB::table('master_learning_styles')->where('slug', 'visual-kinesthetic')->first();
        $aural = DB::table('master_learning_styles')->where('slug', 'aural')->first();
        $readingWriting = DB::table('master_learning_styles')->where('slug', 'reading-writing')->first();
    
        $learning_style_preference = [];
    
        // Check which learning styles meet the threshold
        if ($data['visual_kinesthetic_score'] > 3.75) {
            $learning_style_preference[] = ['learning_style_preference_summary' => $visualKinesthetic->preference_summary];
        }
    
        if ($data['aural_score'] > 3.75) {
            $learning_style_preference[] = ['learning_style_preference_summary' => $aural->preference_summary];
        }
    
        if ($data['reading_writing_score'] > 3.75) {
            $learning_style_preference[] = ['learning_style_preference_summary' => $readingWriting->preference_summary];
        }
    
        if (empty($learning_style_preference)) {
            $learning_style_preference[] = ['learning_style_preference_summary' => 'The results suggest an openness to different ways of learning rather than a single strong preference. This flexibility allows the individual to adapt their approach and benefit from a variety of methods depending on the situation.'];
        }
    
        $data['learning_style_preference'] = $learning_style_preference;

        // Assign scores to an associative array
        $scores = [
            'visual_kinesthetic' => $data['visual_kinesthetic_score'],
            'aural' => $data['aural_score'],
            'reading_writing' => $data['reading_writing_score']
        ];
    
        // Simulate tied scores for demonstration purposes 
        // To test tie breaker scenario
        // $scores = [
        //     'visual_kinesthetic' => 4,
        //     'aural' => 4,
        //     'reading_writing' => 4
        // ];
    
        // Find the highest score(s) and their corresponding keys
        $max_score = max($scores);
        $highest_score_keys = array_keys($scores, $max_score);
    
        // Initialize variables for training recommendations and insights
        $training_recommendations = '';
        $enhanced_development_insights_role_suitability = '';
        $enhanced_development_insights_action_steps = '';
        
        $data['highest_score_keys'] = $highest_score_keys;
        // If there's a tie (multiple highest scores)
        if (count($highest_score_keys) > 1) {
            // Get the facet-wise reliability scores
            $facetWiseReliability = self::getOCEANReliabilityFacetWise($user_id);
    
            // Define a mapping from learning styles to their corresponding facets
            $facet_mapping = [
                'visual_kinesthetic' => ['O', 'A'], // Average of Openness and Agreeableness
                'aural' => ['E'],                  // Extraversion
                'reading_writing' => ['C']         // Conscientiousness
            ];
    
            // Determine the highest reliability score among the tied learning styles
            $selected_style = null;
            $highest_reliability_score = -1;
            
            foreach ($highest_score_keys as $key) {
                $reliability_score = 0;
                foreach ($facet_mapping[$key] as $facet) {
                    $reliability_score += $facetWiseReliability[$facet];
                }
                $average_reliability_score = $reliability_score / count($facet_mapping[$key]);
    
                if ($average_reliability_score > $highest_reliability_score) {
                    $highest_reliability_score = $average_reliability_score;
                    $selected_style = $key;
                }
            }
    
            // Use the selected style to determine the recommendations
            switch ($selected_style) {
                case 'visual_kinesthetic':
                    $training_recommendations = $visualKinesthetic->training_recommendations;
                    $enhanced_development_insights_role_suitability = $visualKinesthetic->enhanced_development_insights_role_suitability;
                    $enhanced_development_insights_action_steps = $visualKinesthetic->enhanced_development_insights_action_steps;
                    break;
                case 'aural':
                    $training_recommendations = $aural->training_recommendations;
                    $enhanced_development_insights_role_suitability = $aural->enhanced_development_insights_role_suitability;
                    $enhanced_development_insights_action_steps = $aural->enhanced_development_insights_action_steps;
                    break;
                case 'reading_writing':
                    $training_recommendations = $readingWriting->training_recommendations;
                    $enhanced_development_insights_role_suitability = $readingWriting->enhanced_development_insights_role_suitability;
                    $enhanced_development_insights_action_steps = $readingWriting->enhanced_development_insights_action_steps;
                    break;
            }
        } else {
            // No tie, handle the highest score normally
            $highest_score_key = $highest_score_keys[0];
            switch ($highest_score_key) {
                case 'visual_kinesthetic':
                    $training_recommendations = $visualKinesthetic->training_recommendations;
                    $enhanced_development_insights_role_suitability = $visualKinesthetic->enhanced_development_insights_role_suitability;
                    $enhanced_development_insights_action_steps = $visualKinesthetic->enhanced_development_insights_action_steps;
                    break;
                case 'aural':
                    $training_recommendations = $aural->training_recommendations;
                    $enhanced_development_insights_role_suitability = $aural->enhanced_development_insights_role_suitability;
                    $enhanced_development_insights_action_steps = $aural->enhanced_development_insights_action_steps;
                    break;
                case 'reading_writing':
                    $training_recommendations = $readingWriting->training_recommendations;
                    $enhanced_development_insights_role_suitability = $readingWriting->enhanced_development_insights_role_suitability;
                    $enhanced_development_insights_action_steps = $readingWriting->enhanced_development_insights_action_steps;
                    break;
            }
        }
    
        // Add the recommendation to the learning_style_preference array
        $data['training_recommendations'] = $training_recommendations;
        $data['enhanced_development_insights_role_suitability'] = $enhanced_development_insights_role_suitability;
        $data['enhanced_development_insights_action_steps'] = $enhanced_development_insights_action_steps;
    
        return $data;
    }


}


