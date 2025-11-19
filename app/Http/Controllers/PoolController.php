<?php

namespace App\Http\Controllers;

use App\Models\FlagQuestionsCombination;
use App\Models\Job;
use App\Models\MasterEducationLevel;
use App\Models\QuizDomainValueAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use App\Exports\DataExport;
use Maatwebsite\Excel\Facades\Excel;

class PoolController extends Controller
{
    function poolUsers($id, Request $request)
    {
        $users = User::query();

        $users = $users->where('pool', $id);

        if ($request->has('gender') && $request->gender != '') {
            $users = $users->where('gender', '=', $request->gender);
        }

        if ($request->has('age') && $request->age != '') {
            $ageRange = $request->age;
            list(
                $minAge, $maxAge
            ) = explode('_', $ageRange);
            // Use Eloquent to filter users within the age range

            $users = $users->whereBetween('age', [$minAge, $maxAge]);
        }

        if ($request->has('education_level') && $request->education_level != '') {
            $users = $users->where('education_level', '=', $request->education_level);
        }


        if ($request->has('work_experience') && $request->work_experience != '') {
            $work_experienceRange = $request->work_experience;
            list(
                $minAge, $maxAge
            ) = explode('_', $work_experienceRange);
            // Use Eloquent to filter users within the age range

            $users = $users->whereBetween('year_of_experience_in_it_sector', [$minAge, $maxAge]);
        }


        $usersData = $users->paginate(5, ['*'], 'poolUser');

        $consistencyArray = [-4, 4, -3, 3, -2, 2];

        $cobinationAll = [];

        // foreach ($usersData as $key => $value) {
        //     $flag = "Low";

        //     // Checking For C2 Flag
        //     $combinationsC2 = FlagQuestionsCombination::where('domain_name', 'C2')->get();
        //     $c2CombinationCounts = 0;
        //     $c2ConsistencyCount = 0;
        //     $c2Percentage = 0;
        //     foreach ($combinationsC2 as $key1 => $value1) {
        //         $c2CombinationCounts++;
        //         $answerPositive = QuizDomainValueAnswer::where('user_id', $value->id)->where('quiz_domain_value_question_id', $value1->positive_question_id)->first()->answer;
        //         $answerNegative = QuizDomainValueAnswer::where('user_id', $value->id)->where('quiz_domain_value_question_id', $value1->negative_question_id)->first()->answer;
        //         $calculation = $answerPositive - (6 - $answerNegative);
        //         if (in_array($calculation, $consistencyArray)) {
        //             $c2ConsistencyCount++;
        //         }
        //     }
        //     $c2Percentage = ($c2ConsistencyCount / $c2CombinationCounts) * 100;
        //     if ($c2Percentage < 34) {
        //         $flag = "High";
        //     } elseif ($c2Percentage >= 34 && $c2Percentage < 67) {
        //         $flag = "Moderate";
        //     } elseif ($c2Percentage >= 67) {
        //         $flag = "Low";
        //     }



        //     // Checking For C3 Flag
        //     $combinationsC3 = FlagQuestionsCombination::where('domain_name', 'C3')->get();
        //     $c3CombinationCounts = 0;
        //     $c3ConsistencyCount = 0;
        //     $c3Percentage = 0;
        //     foreach ($combinationsC3 as $key1 => $value2) {
        //         $c3CombinationCounts++;
        //         $answerPositive = QuizDomainValueAnswer::where('user_id', $value->id)->where('quiz_domain_value_question_id', $value2->positive_question_id)->first()->answer;
        //         $answerNegative = QuizDomainValueAnswer::where('user_id', $value->id)->where('quiz_domain_value_question_id', $value2->negative_question_id)->first()->answer;
        //         $calculation = $answerPositive - (6 - $answerNegative);
        //         if (in_array($calculation, $consistencyArray)) {
        //             $c3ConsistencyCount++;
        //         }
        //     }
        //     $c3Percentage = ($c3ConsistencyCount / $c3CombinationCounts) * 100;

        //     if ($c3Percentage < 26) {
        //         $flag = "High";
        //     } elseif ($c3Percentage >= 26 && $c3Percentage < 50) {
        //         $flag = "Moderate";
        //     } elseif ($c3Percentage >= 50) {
        //         $flag = "Low";
        //     }


        //     // Checking For C4 Flag
        //     $combinationsC4 = FlagQuestionsCombination::where('domain_name', 'C4')->get();
        //     $c4CombinationCounts = 0;
        //     $c4ConsistencyCount = 0;
        //     $c4Percentage = 0;
        //     foreach ($combinationsC4 as $key1 => $value3) {
        //         $c4CombinationCounts++;
        //         $answerPositive = QuizDomainValueAnswer::where('user_id', $value->id)->where('quiz_domain_value_question_id', $value3->positive_question_id)->first()->answer;
        //         $answerNegative = QuizDomainValueAnswer::where('user_id', $value->id)->where('quiz_domain_value_question_id', $value3->negative_question_id)->first()->answer;
        //         $calculation = $answerPositive - (6 - $answerNegative);
        //         if (in_array($calculation, $consistencyArray)) {
        //             $c4ConsistencyCount++;
        //         }
        //     }
        //     $c4Percentage = ($c4ConsistencyCount / $c4CombinationCounts) * 100;

        //     if ($c4Percentage < 26) {
        //         $flag = "High";
        //     } elseif ($c4Percentage >= 26 && $c4Percentage < 50) {
        //         $flag = "Moderate";
        //     } elseif ($c4Percentage >= 50) {
        //         $flag = "Low";
        //     }



        //     // Checking For C5 Flag
        //     $combinationsC5 = FlagQuestionsCombination::where('domain_name', 'C5')->get();
        //     $c5CombinationCounts = 0;
        //     $c5ConsistencyCount = 0;
        //     $c5Percentage = 0;
        //     foreach ($combinationsC5 as $key1 => $value4) {
        //         $c5CombinationCounts++;
        //         $answerPositive = QuizDomainValueAnswer::where('user_id', $value->id)->where('quiz_domain_value_question_id', $value4->positive_question_id)->first()->answer;
        //         $answerNegative = QuizDomainValueAnswer::where('user_id', $value->id)->where('quiz_domain_value_question_id', $value4->negative_question_id)->first()->answer;
        //         $calculation = $answerPositive - (6 - $answerNegative);
        //         if (in_array($calculation, $consistencyArray)) {
        //             $c5ConsistencyCount++;
        //         }
        //     }
        //     $c5Percentage = ($c5ConsistencyCount / $c5CombinationCounts) * 100;
        //     if ($c5Percentage < 26) {
        //         $flag = "High";
        //     } elseif ($c5Percentage >= 26 && $c5Percentage < 50) {
        //         $flag = "Moderate";
        //     } elseif ($c5Percentage >= 50) {
        //         $flag = "Low";
        //     }


        //     $value->flag = $flag;
        //     $value->save();
        // }

        $pool = $id;

        $jobs = Job::all();

        $jobUsers = [];

        if ($request->has('job') && $request->job > 0) {
            $skills = [];
            $skillLabels = [];

            $selectedJob = Job::find($request->job);
            $totalJobPoints = 0;

            foreach ($selectedJob->skills as $key => $value) {
                if ($value->level == 0) {
                    $totalJobPoints += 20;
                    $skills[$value->title] = 20;
                } elseif ($value->level == 1) {
                    $totalJobPoints += 50;
                    $skills[$value->title] = 50;
                } elseif ($value->level == 2) {
                    $totalJobPoints += 100;
                    $skills[$value->title] = 100;
                }
                $skillLabels[$value->title] = $value->title;
            }

            $jobUsers = User::where('pool', $id)->paginate(5, ['*'], 'poolMatching');
            foreach ($jobUsers as $key => $valueUser) {


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
                    "), [$valueUser->id]);

                    if (count($workCompetencyResults) > 0) {
                        $workCompetencyCalculation = 0;
                        foreach ($workCompetencyResults as $res) {
                            if (in_array($res->aspect, $skillLabels)) {
                                $workCompetencyCalculation += $res->value;
                                // if ($res->value >= 1 && $res->value < 33) {
                                //     $workCompetencyCalculation += (($res->value - 1) / (33 - 1)) * 100;
                                // } elseif ($res->value > 33 && $res->value < 67) {
                                //     $workCompetencyCalculation += (($res->value - 33) / (67 - 33)) * 100;
                                // } elseif ($res->value >= 67 && $res->value <= 100) {
                                //     $workCompetencyCalculation += (($res->value - 67) / (100 - 67)) * 100;
                                // } else {
                                //     $workCompetencyCalculation += 0;
                                // }
                            }
                        }
                    }
                    $matchingPercentage = ($workCompetencyCalculation / $totalJobPoints) * 100;
                    $valueUser->matching_percentage =
                        (float)number_format($matchingPercentage, 2);
                } catch (\Throwable $th) {
                    $valueUser->matching_percentage = $matchingPercentage;
                }

                // try {
                //     $flag = "No";

                //     $combinationsC2 = FlagQuestionsCombination::where('domain_name', 'C2')->get();
                //     $c2CombinationCounts = 0;
                //     $c2ConsistencyCount = 0;
                //     $c2Percentage = 0;
                //     foreach ($combinationsC2 as $key1 => $value1) {
                //         $c2CombinationCounts++;
                //         $answerPositive = QuizDomainValueAnswer::where('user_id', $valueUser->id)->where('quiz_domain_value_question_id', $value1->positive_question_id)->first()->answer;
                //         $answerNegative = QuizDomainValueAnswer::where('user_id', $valueUser->id)->where('quiz_domain_value_question_id', $value1->negative_question_id)->first()->answer;
                //         $calculation = $answerPositive - (6 - $answerNegative);
                //         if (in_array($calculation, $consistencyArray)) {
                //             $c2ConsistencyCount++;
                //         }
                //     }
                //     $c2Percentage = ($c2ConsistencyCount / $c2CombinationCounts) * 100;
                //     if ($c2Percentage < 34) {
                //         $flag = "High";
                //     } elseif ($c2Percentage >= 34 && $c2Percentage < 67) {
                //         $flag = "Moderate";
                //     } elseif ($c2Percentage >= 67) {
                //         $flag = "Low";
                //     }







                //     $combinationsC3 = FlagQuestionsCombination::where('domain_name', 'C3')->get();
                //     $c3CombinationCounts = 0;
                //     $c3ConsistencyCount = 0;
                //     $c3Percentage = 0;
                //     foreach ($combinationsC3 as $key1 => $value2) {
                //         $c3CombinationCounts++;
                //         $answerPositive = QuizDomainValueAnswer::where('user_id', $valueUser->id)->where('quiz_domain_value_question_id', $value2->positive_question_id)->first()->answer;
                //         $answerNegative = QuizDomainValueAnswer::where('user_id', $valueUser->id)->where('quiz_domain_value_question_id', $value2->negative_question_id)->first()->answer;
                //         $calculation = $answerPositive - (6 - $answerNegative);
                //         if (in_array($calculation, $consistencyArray)) {
                //             $c3ConsistencyCount++;
                //         }
                //     }
                //     $c3Percentage = ($c3ConsistencyCount / $c3CombinationCounts) * 100;
                //     if ($c3Percentage < 26) {
                //         $flag = "High";
                //     } elseif ($c3Percentage >= 26 && $c3Percentage < 50) {
                //         $flag = "Moderate";
                //     } elseif ($c3Percentage >= 50) {
                //         $flag = "Low";
                //     }




                //     $combinationsC4 = FlagQuestionsCombination::where('domain_name', 'C4')->get();
                //     $c4CombinationCounts = 0;
                //     $c4ConsistencyCount = 0;
                //     $c4Percentage = 0;
                //     foreach ($combinationsC4 as $key1 => $value3) {
                //         $c4CombinationCounts++;
                //         $answerPositive = QuizDomainValueAnswer::where('user_id', $valueUser->id)->where('quiz_domain_value_question_id', $value3->positive_question_id)->first()->answer;
                //         $answerNegative = QuizDomainValueAnswer::where('user_id', $valueUser->id)->where('quiz_domain_value_question_id', $value3->negative_question_id)->first()->answer;
                //         $calculation = $answerPositive - (6 - $answerNegative);
                //         if (in_array($calculation, $consistencyArray)) {
                //             $c4ConsistencyCount++;
                //         }
                //     }
                //     $c4Percentage = ($c4ConsistencyCount / $c4CombinationCounts) * 100;
                //     if ($c4Percentage < 26) {
                //         $flag = "High";
                //     } elseif ($c4Percentage >= 26 && $c4Percentage < 50) {
                //         $flag = "Moderate";
                //     } elseif ($c4Percentage >= 50) {
                //         $flag = "Low";
                //     }



                //     $combinationsC5 = FlagQuestionsCombination::where('domain_name', 'C5')->get();
                //     $c5CombinationCounts = 0;
                //     $c5ConsistencyCount = 0;
                //     $c5Percentage = 0;
                //     foreach ($combinationsC5 as $key1 => $value4) {
                //         $c5CombinationCounts++;
                //         $answerPositive = QuizDomainValueAnswer::where('user_id', $valueUser->id)->where('quiz_domain_value_question_id', $value4->positive_question_id)->first()->answer;
                //         $answerNegative = QuizDomainValueAnswer::where('user_id', $valueUser->id)->where('quiz_domain_value_question_id', $value4->negative_question_id)->first()->answer;
                //         $calculation = $answerPositive - (6 - $answerNegative);
                //         if (in_array($calculation, $consistencyArray)) {
                //             $c5ConsistencyCount++;
                //         }
                //     }
                //     $c5Percentage = ($c5ConsistencyCount / $c5CombinationCounts) * 100;
                //     if ($c5Percentage < 26) {
                //         $flag = "High";
                //     } elseif ($c5Percentage >= 26 && $c5Percentage < 50) {
                //         $flag = "Moderate";
                //     } elseif ($c5Percentage >= 50) {
                //         $flag = "Low";
                //     }

                //     $valueUser->flag = $flag;
                // } catch (\Throwable $th) {
                //     $valueUser->flag = "Yes";
                // }
            }
        } else {
            $jobUsers = [];
        }

        $educationLevel = MasterEducationLevel::all();

        if ($request->has('action') && $request->action == "export") {

            $headings = [
                'First Name',
                'Last Name',
                'Email',
                'Age',
                'Pool',
                'Flag'
            ];
            $columns = ['first_name', 'last_name', 'email', 'age', 'pool', 'flag'];

            return Excel::download(new DataExport($users, $headings, $columns), 'users.xlsx');
        } else {
            $users = $users->paginate(5, ['*'], 'poolUser');
            return view('admin.drill_through', compact('users', 'pool', 'jobs', 'jobUsers', 'educationLevel'));
        }
    }
}
