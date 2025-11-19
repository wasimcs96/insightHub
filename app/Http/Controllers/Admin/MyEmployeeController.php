<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\QuizDomainValueAnswer;
use App\Models\SavedEmployee;
use App\Models\Department;
use App\Models\Division;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\EmployeeExport;
use App\Exports\EmployeeAssessmentExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\MasterOpportunitiesForGrowth;
use App\Helpers\AssessmentHelper;
use App\Jobs\ImportEmployees;
use App\Models\DepartmentSection;
use App\Models\Job;
use App\Models\PersonalityTypeDescriptor;
use App\Models\Position;
use App\Models\Role;
use App\Models\SectionUnit;
use App\Models\Sector;
use App\Models\UserEmployment;
use Str;
use Illuminate\Support\Facades\Hash;
use App\Helpers\HelperFunctions;
use App\Models\Contract;
use App\Models\MasterTechnicalQuestion;
use App\Models\MasterBarangay;
use App\Models\MasterCity;
use App\Models\MasterState;
use App\Models\Setting;
use App\Models\Team;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Imports\EmployeesImport;


class MyEmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detail($id)
    {

        $responseData = [];
        $employee = User::find($id);
        $user_id = $id;
        $responseData['employee'] = $employee;
        $results = AssessmentHelper::getOceanResult($user_id, 0);

        $overall_population_average = AssessmentHelper::getOceanResult($user_id, 1);

        $oceanSelfResult = [];
        $oceanSelfResult['Openness to Experience'] = 0;
        $oceanSelfResult['Conscientiousness'] = 0;
        $oceanSelfResult['Extraversion'] = 0;
        $oceanSelfResult['Agreeableness'] = 0;
        $oceanSelfResult['Emotional Stability'] = 0;

        $oceanOverallResult = [];
        $oceanOverallResult['Openness to Experience'] = 0;
        $oceanOverallResult['Conscientiousness'] = 0;
        $oceanOverallResult['Extraversion'] = 0;
        $oceanOverallResult['Agreeableness'] = 0;
        $oceanOverallResult['Emotional Stability'] = 0;

        foreach ($results as $result) {
            $oceanSelfResult[$result->name] =  $result->answer_avg;
        }

        foreach ($overall_population_average as $overall) {
            $oceanOverallResult[$overall->name] =  $overall->answer_avg_population;
        }

        $responseData = array_merge($responseData, ['oceanSelfResult' => $oceanSelfResult]);
        $responseData = array_merge($responseData, ['oceanOverallResult' => $oceanOverallResult]);

        $total_correct = QuizDomainValueAnswer::where('user_id', $user_id)->where('quiz_domain_value_question_id', '>', 376)->where('is_correct', 1)->count();
        $responseData = array_merge($responseData, ['totalCorrectForCognitive' => $total_correct]);
        $total_not_attempted = QuizDomainValueAnswer::where('user_id', $user_id)->where('quiz_domain_value_question_id', '>', 376)->where('time_taken', 0)->where('option_selected', 0)->count();
        $responseData = array_merge($responseData, ['totalNonAttemptedForCognitive' => $total_not_attempted]);
        if ($total_correct == 0 && $total_not_attempted == 0) {
            $total_wrong = 0;
        } else {
            $total_wrong = 50 - $total_correct - $total_not_attempted;
        }

        $responseData = array_merge($responseData, ['totalWrongForCognitive' => $total_wrong]);

        $total_marks = QuizDomainValueAnswer::where('user_id', $user_id)->where('quiz_domain_value_question_id', '>', 376)->sum('answer');
        $responseData = array_merge($responseData, ['totalMarksForCognitive' => $total_marks]);

        $cognitiveResultsA = AssessmentHelper::getCognitiveResult($user_id);

        $cognitiveResultA = [];
        $cognitiveResultA['Quantitative Knowledge'] = 0;
        $cognitiveResultA['Comprehension Knowledge'] = 0;
        $cognitiveResultA['Visual Reasoning'] = 0;
        $cognitiveResultA['Fluid Reasoning'] = 0;

        foreach ($cognitiveResultsA as $res) {
            $cognitiveResultA[$res->name] = $res->level;
        }

        $responseData = array_merge($responseData, ['cognitiveEmployeeAResult' => $cognitiveResultA]);

        $workInterestResults = AssessmentHelper::getWorkInterestResult($user_id, 0);

        $workInterestOverallResults = AssessmentHelper::getWorkInterestResult($user_id, 1);

        $workInterestResult = [];
        $workInterestResult['Realistic'] = 0;
        $workInterestResult['Investigative'] = 0;
        $workInterestResult['Artistic'] = 0;
        $workInterestResult['Social'] = 0;
        $workInterestResult['Enterprising'] = 0;
        $workInterestResult['Conventional'] = 0;

        foreach ($workInterestResults as $result) {
            $workInterestResult[$result->name] =  $result->percentage;
        }

        $workInterestOverallResult = [];
        $workInterestOverallResult['Realistic'] = 0;
        $workInterestOverallResult['Investigative'] = 0;
        $workInterestOverallResult['Artistic'] = 0;
        $workInterestOverallResult['Social'] = 0;
        $workInterestOverallResult['Enterprising'] = 0;
        $workInterestOverallResult['Conventional'] = 0;

        foreach ($workInterestOverallResults as $wior) {
            $workInterestOverallResult[$wior->name] =  $wior->answer_avg_population;
        }

        $top_names_first_letters = AssessmentHelper::getTop3RIASEC($workInterestResults);
        $top_names_first_letters_based_on_score = AssessmentHelper::getTop3RIASECFullBasedOnScore($workInterestResults);

        $top3Riasec = DB::table('master_top_3_riasec_descriptions')->where('top_3_riasec', 'like', "%$top_names_first_letters%")->first();

        $workInterestResult['top_3_riasec'] = $top_names_first_letters_based_on_score ?? '';
        $workInterestResult['top_3_riasec_description'] = $top3Riasec->description ?? '';

        $top_names_first_lettersO = AssessmentHelper::getTop3RIASEC($workInterestOverallResults, 1);
        $top_names_first_lettersO_based_on_score = AssessmentHelper::getTop3RIASECFullBasedOnScore($workInterestOverallResults);

        $top3RiasecO = DB::table('master_top_3_riasec_descriptions')->where('top_3_riasec', 'like', "%$top_names_first_lettersO%")->first();

        $workInterestOverallResult['top_3_riasec'] = $top_names_first_lettersO_based_on_score ?? '';
        $workInterestOverallResult['top_3_riasec_array'] = str_split($top_names_first_lettersO) ?? '';
        $workInterestOverallResult['top_3_riasec_description'] = $top3RiasecO->description ?? '';
        // dd(str_split($top_names_first_lettersO),$workInterestOverallResult['top_3_riasec_array']);
        $responseData = array_merge($responseData, ['workInterestResult' => $workInterestResult]);
        $responseData = array_merge($responseData, ['workInterestOverallResult' => $workInterestOverallResult]);

        // dd($responseData);

        $workCompetencyResults = AssessmentHelper::getWorkCompetencyResult($user_id, 0);

        $workCompetencyResult = [];
        $workCompetencyResult['Critical Thinking'] = 0;
        $workCompetencyResult['Creativity'] = 0;
        $workCompetencyResult['Communication'] = 0;
        $workCompetencyResult['Leadership'] = 0;
        $workCompetencyResult['Teamwork'] = 0;
        $workCompetencyResult['Adaptability'] = 0;
        $workCompetencyResult['Systematic Planning'] = 0;
        $workCompetencyResult['Achievement Orientation'] = 0;

        foreach ($workCompetencyResults as $res) {
            $workCompetencyResult[$res->aspect] = $res->value;
        }


        $responseData = array_merge($responseData, ['workCompetencyResult' => $workCompetencyResult]);

        // Learning & Development Plan
        // $workCompetencyResult['Critical Thinking'] = 24.75;
        // Filter the original array using an anonymous function
        // 50 is 2.5 and 25 is 1.25
        $workCompetencyResultLessThan25 = array_filter($workCompetencyResult, function ($value) {
            return floatval($value) <= 50;
        });
        $workCompetencyResultLessThan25Names = array_values(array_keys($workCompetencyResultLessThan25));
        $learningAndDevelopmentPlanResults = MasterOpportunitiesForGrowth::whereIn('talent_pillar', $workCompetencyResultLessThan25Names)->get();
        $responseData = array_merge($responseData, ['learningAndDevelopmentPlanResults' => $learningAndDevelopmentPlanResults]);


        // $workCompetencyResultsAllUsersAverage = AssessmentHelper::getWorkCompetencyResult($user_id,1);

        $workCompetencyOverallResult = [];
        $workCompetencyOverallResult['Critical Thinking'] = 68.48;
        $workCompetencyOverallResult['Creativity'] = 63.11;
        $workCompetencyOverallResult['Communication'] = 67.58;
        $workCompetencyOverallResult['Leadership'] = 67.59;
        $workCompetencyOverallResult['Teamwork'] = 73.14;
        $workCompetencyOverallResult['Adaptability'] = 61.30;
        $workCompetencyOverallResult['Systematic Planning'] = 75.09;
        $workCompetencyOverallResult['Achievement Orientation'] = 68.07;


        // foreach ($workCompetencyResultsAllUsersAverage as $ores) {
        //     $workCompetencyOverallResult[$ores->aspect] = $ores->value;
        // }

        $responseData = array_merge($responseData, ['workCompetencyOverallResult' => $workCompetencyOverallResult]);

        $bookmarked = SavedEmployee::where('user_id', $user_id)->where('admin_id', auth()->user()->id)->first();
        if ($bookmarked) {
            $isBookmarked = 1;
        } else {
            $isBookmarked = 0;
        }

        $responseData = array_merge($responseData, ['isBookmarked' => $isBookmarked]);

        # OCEAN All Facets For Single Employee
        // Calculate averages for each domain using aggregate
        $oceanAllFacetsResultA = AssessmentHelper::getOCEANAllFacetsResult($user_id, 0);

        # OCEAN All Facets Overall
        // Calculate averages for each domain using aggregate
        $oceanAllFacetsResult = AssessmentHelper::getOCEANAllFacetsResult($user_id, 1);

        $responseData = array_merge($responseData, ['oceanAllFacetsEmployeeAResult' => $oceanAllFacetsResultA]);
        $responseData = array_merge($responseData, ['oceanAllFacetsOverallResult' => $oceanAllFacetsResult]);


        // Code to check High Potential

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

        $employee->potential = $potential;
        $employee->save();

        $responseData = array_merge($responseData, ['potential' => $potential]);

        // Growth Potential
        $averageGpPercentage = User::where('company_id', auth()->user()->id)->where('is_personality_motivation_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_cognitive_ability_completed', '=', 1)->avg('gp_percentage');
        $growth_potential = 'Average';

        if (isset($employee->gp_percentage) && ($employee->gp_percentage > $averageGpPercentage)) {
            $growth_potential = 'High';
        }

        $responseData = array_merge($responseData, ['growth_potential_result' => $growth_potential]);
        // Dark Triads (Organization Fit Forecast)
        $allfacets = (array) $oceanAllFacetsResultA;
        $organizational_fit_forecast_result = AssessmentHelper::getOrganizationalFitForecast($allfacets);

        $responseData = array_merge($responseData, ['organizational_fit_forecast_result' => $organizational_fit_forecast_result]);


        $departments = Department::where('company_id', auth()->user()->id)->where('status', 1)->get();

        $responseData = array_merge($responseData, ['departments' => $departments]);

        return view('admin.employe_detail', $responseData);
    }

    public function addToBookmark(Request $request)
    {
        SavedEmployee::updateOrCreate([
            'user_id' => $request->employee_id,
            'admin_id' => auth()->user()->id
        ]);

        return redirect()->route('admin.employee.details', $request->employee_id);
    }

    public function removeBookmark(Request $request)
    {
        SavedEmployee::where('user_id', $request->employee_id)->where('admin_id', auth()->user()->id)->delete();
        return redirect()->route('admin.employee.details', $request->employee_id);
    }

    public function bookmarks(Request $request)
    {
        $user_ids = SavedEmployee::where('admin_id', auth()->user()->id)->pluck('user_id');

        $query = User::whereIn('id', $user_ids);

        if ($request->filled('age')) {
            $ageRange = explode('_', $request->input('age'));
            if (count($ageRange) == 2) {
                $query->whereBetween('age', $ageRange);
            }
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        if ($request->filled('education_level')) {
            $query->where('education_level', $request->input('education_level'));
        }

        if ($request->filled('work_experience')) {
            $workExperienceRange = explode('_', $request->input('work_experience'));
            if (count($workExperienceRange) == 2) {
                $query->whereBetween('year_of_experience_in_it_sector', $workExperienceRange);
            }
        }

        if ($request->has('action') && $request->action == "export") {

            $headings = [
                'First Name',
                'Last Name',
                'Email',
                'Age',
                'Phone',
                'National ID',
                'Passport No',
                'Passport Expiry Date',
                'Home Address',
                'Education Level',
                'Learning Institution',
                'Scope Of Study',
                'Work Experience In IT Sector'
            ];
            $columns = ['first_name', 'last_name', 'email', 'age', 'mobile_number'];

            return Excel::download(new EmployeeExport($query, $headings, $columns), 'users.xlsx');
        } else {
            $bookmarks = $query->paginate(10);

            return view('admin.bookmark', compact('bookmarks'));
        }
    }

    public function potentials(Request $request)
    {
        $query = User::where('id', '>', 0);

        if ($request->filled('age')) {
            $ageRange = explode('_', $request->input('age'));
            if (count($ageRange) == 2) {
                $query->whereBetween('age', $ageRange);
            }
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        if ($request->filled('education_level')) {
            $query->where('education_level', $request->input('education_level'));
        }

        if ($request->filled('work_experience')) {
            $workExperienceRange = explode('_', $request->input('work_experience'));
            if (count($workExperienceRange) == 2) {
                $query->whereBetween('year_of_experience_in_it_sector', $workExperienceRange);
            }
        }

        if ($request->filled('potential')) {
            $query->where('potential', $request->input('potential'));
        }

        // if ($request->has('action') && $request->action == "export") {

        //     $headings = [
        //         'First Name',
        //         'Last Name',
        //         'Email',
        //         'Age',
        //         'Phone',
        //         'National ID',
        //         'Passport No',
        //         'Passport Expiry Date',
        //         'Home Address',
        //         'Education Level',
        //         'Learning Institution',
        //         'Scope Of Study',
        //         'Work Experience In IT Sector'
        //     ];
        //     $columns = ['first_name', 'last_name', 'email', 'age', 'mobile_number'];

        //     return Excel::download(new EmployeeExport($query, $headings, $columns), 'users.xlsx');
        // } else {
        $query->whereNotNull('position_id');
        $potentials = $query->orderByDesc('potential')->paginate(10);

        return view('admin.potentials', compact('potentials'));
        // }
    }




    public function index(Request $request)
    {
        $data = [
            // 'type'=>$type
        ];
        // $user = auth()->user();
        // dd($user);
       
        return view('admin.myemployee.index', $data);
    }

    public function indexOld(Request $request)
    {
        // $departments = User::where('company_id', auth()->user()->id)->where('role_name', 'department')->get();
        $user = auth()->user();
        $departments = Department::where('company_id', auth()->user()->id)->get();
        $averagePercentage = User::where('company_id', auth()->user()->id)->where('role_id', 1)->where('is_personality_motivation_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_cognitive_ability_completed', '=', 1)->avg('gp_percentage');

        if ($request->export == 1) {

            $query = User::query();
            $query = $query->where('company_id', auth()->user()->id)->where('role_name', Role::$employee);

            if ($request->filled('age')) {
                $ageRange = explode('_', $request->input('age'));
                if (count($ageRange) == 2) {
                    $query->whereBetween('age', $ageRange);
                }
            }
            if ($request->filled('email')) {

                $query->where('email', 'LIKE', '%' . $request->input('email') . '%');
            }

            if ($request->filled('gender')) {
                $query->where('gender', $request->input('gender'));
            }

            if ($request->filled('is_assessment') &&  $request->input('is_assessment') == 1) {
                $query->where('is_personality_motivation_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_cognitive_ability_completed', '=', 1);
            }

            if ($request->filled('is_assessment') &&  $request->input('is_assessment') == 2) {
                $query->where(function ($query) {
                    $query->where('is_personality_motivation_completed', '=', 0)
                        ->orWhere('is_work_interest_completed', '=', 0)
                        ->orWhere('is_cognitive_ability_completed', '=', 0);
                });
            }

            if ($request->filled('city')) {
                $query->where('city', $request->input('city'));
            }

            if ($request->filled('education_level')) {
                $query->where('education_level', $request->input('education_level'));
            }

            if ($request->filled('work_experience')) {
                $workExperienceRange = explode('_', $request->input('work_experience'));
                if (count($workExperienceRange) == 2) {
                    $query->whereBetween('year_of_experience_in_it_sector', $workExperienceRange);
                }
            }

            if ($request->filled('potential')) {
                if ($request->potential == 1) {
                    $query->where('gp_percentage', '>', $averagePercentage);
                } else {
                    $query->where('gp_percentage', '<', $averagePercentage);
                }
            }

            if ($request->filled('level')) {
                $positions = Job::where('level', $request->level)->pluck('id')->toArray();
                $query->whereIn('position_id', $positions);
            }



            if ($request->filled('department') || $request->filled('department_name')) {
                if ($request->filled('department_name')) {
                    $dept = Department::where('head_of_department', $request->department_name)->first();
                    if ($dept) {
                        $query->where('department_id', $dept->id);
                    }
                } else {
                    if ($request->filled('department')) {
                        $query->where('department_id', $request->department);
                    }
                }
            }

            if ($request->filled('assessment_completion')) {

                if ($request->assessment_completion == 1) {
                    $query->where('is_personality_motivation_completed', 1)->where('is_work_interest_completed', 1)->where('is_cognitive_ability_completed', 1);
                } else {
                    $query->where(function ($query) {
                        $query->where('is_personality_motivation_completed', '=', 0)
                            ->orWhere('is_work_interest_completed', '=', 0)
                            ->orWhere('is_cognitive_ability_completed', '=', 0);
                    });
                }
            }

            if ($request->filled('name')) {
                $names = explode(' ', $request->name); // Split the input name into parts
                $query = $query->where(function ($subQuery) use ($names) {
                    foreach ($names as $name) {
                        $subQuery->orWhere('first_name', 'like', '%' . $name . '%')
                            ->orWhere('middle_name', 'like', '%' . $name . '%')
                            ->orWhere('last_name', 'like', '%' . $name . '%');
                    }
                });
            }

            // Apply the duration filter
            $subquery = $query->yearsSinceCreation();

            if ($request->filled('duration')) {
                $duration = $request->input('duration');
                $subquery = $subquery->where(function ($query) use ($duration) {
                    switch ($duration) {
                        case '1_g':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) < 1');
                            break;
                        case '1_2':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 1 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 2');
                            break;
                        case '2_3':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 2 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) <= 3');
                            break;
                        case '3_4':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 3 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 4');
                            break;
                        case '4_5':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 4 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) <= 5');
                            break;
                        case '5_6':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 5 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 6');
                            break;
                        case '6_8':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 6 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 8');
                            break;
                        case '8_g':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 8');
                            break;
                    }
                });
            }

            $query = $query->select(
                'first_name',
                'middle_name',
                'last_name',
                'email',
                DB::raw("CASE WHEN is_personality_motivation_completed = '1' THEN 'Completed' ELSE 'Not completed' END AS is_personality_motivation_completed"),
                DB::raw("CASE WHEN is_work_interest_completed = '1' THEN 'Completed' ELSE 'Not completed' END AS is_work_interest_completed"),
                DB::raw("CASE WHEN is_cognitive_ability_completed = '1' THEN 'Completed' ELSE 'Not completed' END AS is_cognitive_ability_completed")
            )
                ->where('company_id', auth()->user()->id);
            $headings = [
                'First Name',
                'Middle Name',
                'Last Name',
                'Email',
                'Personality Motivation Completion Status',
                'Work Interest Completion Status',
                'Cognitive Ability Completion Status'
            ];
            $columns = ['first_name', 'middle_name', 'last_name', 'email', 'is_personality_motivation_completed', 'is_work_interest_completed', 'is_cognitive_ability_completed'];

            return Excel::download(new EmployeeAssessmentExport($query, $headings, $columns), 'Exported Users Data.xlsx');
        }
        if ($user->isCompany()) {
            $query = User::query();
            $query = $query->where('company_id', auth()->user()->id)->where('role_name', Role::$employee)->where('role_id', 1);

            if ($request->filled('gender')) {
                $query->where('gender', $request->input('gender'));
            }

            if ($request->filled('email')) {

                $query->where('email', 'LIKE', '%' . $request->input('email') . '%');
            }

            if ($request->filled('age')) {
                $ageRange = explode('_', $request->input('age'));
                if (count($ageRange) == 2) {
                    $query->whereBetween('age', $ageRange);
                }
            }

            if ($request->filled('gender')) {
                $query->where('gender', $request->input('gender'));
            }

            if ($request->filled('is_assessment') &&  $request->input('is_assessment') == 1) {
                $query->where('is_personality_motivation_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_cognitive_ability_completed', '=', 1);
            }

            if ($request->filled('education_level')) {
                $query->where('education_level', $request->input('education_level'));
            }

            if ($request->filled('work_experience')) {
                $workExperienceRange = explode('_', $request->input('work_experience'));
                if (count($workExperienceRange) == 2) {
                    $query->whereBetween('year_of_experience_in_it_sector', $workExperienceRange);
                }
            }

            if ($request->filled('potential')) {
                if ($request->potential == 1) {
                    $query->where('gp_percentage', '>', $averagePercentage);
                } else {
                    $query->where('gp_percentage', '<', $averagePercentage);
                }
            }

            if ($request->filled('level')) {
                $positions = Position::where('level', $request->level)->pluck('id')->toArray();
                $query->whereIn('position_id', $positions);
            }



            if ($request->filled('department') || $request->filled('department_name')) {
                if ($request->filled('department_name')) {
                    $dept = Department::where('head_of_department', $request->department_name)->first()->id;
                    $query->where('department_id', $dept);
                } else {
                    if ($request->filled('department')) {
                        $query->where('department_id', $request->department);
                    }
                }
            }

            if ($request->filled('assessment_completion')) {

                if ($request->assessment_completion == 1) {
                    $query->where('is_personality_motivation_completed', 1)->where('is_work_interest_completed', 1)->where('is_cognitive_ability_completed', 1);
                } else {
                    $query->where(function ($query) {
                        $query->where('is_personality_motivation_completed', '=', 0)
                            ->orWhere('is_work_interest_completed', '=', 0)
                            ->orWhere('is_cognitive_ability_completed', '=', 0);
                    });
                }
            }

            if ($request->filled('name')) {
                $names = explode(' ', $request->name); // Split the input name into parts
                $query = $query->where(function ($subQuery) use ($names) {
                    foreach ($names as $name) {
                        $subQuery->orWhere('first_name', 'like', '%' . $name . '%')
                            ->orWhere('middle_name', 'like', '%' . $name . '%')
                            ->orWhere('last_name', 'like', '%' . $name . '%');
                    }
                });
            }

            $users = $query->orderBy('created_at', 'DESC')->paginate(20);
        } elseif ($user->isAdmin()) {

            $query = User::query();
            $query = $query->where('company_id', auth()->user()->id)->where('role_name', Role::$employee);

            if ($request->filled('age')) {
                $ageRange = explode('_', $request->input('age'));
                if (count($ageRange) == 2) {
                    $query->whereBetween('age', $ageRange);
                }
            }

            if ($request->filled('email')) {

                $query->where('email', 'LIKE', '%' . $request->input('email') . '%');
            }
            if ($request->filled('gender')) {
                $query->where('gender', $request->input('gender'));
            }

            if ($request->filled('is_assessment') &&  $request->input('is_assessment') == 1) {
                $query->where('is_personality_motivation_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_cognitive_ability_completed', '=', 1);
            }

            if ($request->filled('is_assessment') &&  $request->input('is_assessment') == 2) {
                $query->where(function ($query) {
                    $query->where('is_personality_motivation_completed', '=', 0)
                        ->orWhere('is_work_interest_completed', '=', 0)
                        ->orWhere('is_cognitive_ability_completed', '=', 0);
                });
            }

            if ($request->filled('city')) {
                $query->where('city', $request->input('city'));
            }

            if ($request->filled('education_level')) {
                $query->where('education_level', $request->input('education_level'));
            }

            if ($request->filled('work_experience')) {
                $workExperienceRange = explode('_', $request->input('work_experience'));
                if (count($workExperienceRange) == 2) {
                    $query->whereBetween('year_of_experience_in_it_sector', $workExperienceRange);
                }
            }

            if ($request->filled('potential')) {
                if ($request->potential == 1) {
                    $query->where('gp_percentage', '>', $averagePercentage);
                } else {
                    $query->where('gp_percentage', '<', $averagePercentage);
                }
            }



            if ($request->filled('level')) {
                $positions = Job::where('level', $request->level)->pluck('id')->toArray();
                $query->whereIn('position_id', $positions);
            }



            if ($request->filled('department') || $request->filled('department_name')) {
                if ($request->filled('department_name')) {
                    $dept = Department::where('head_of_department', 'like', "%$request->department_name%")->first();

                    if ($dept) {
                        $query->where('department_id', $dept->id);
                    }
                } else {
                    if ($request->filled('department')) {
                        $query->where('department_id', $request->department);
                    }
                }
            }



            if ($request->filled('assessment_completion')) {

                if ($request->assessment_completion == 1) {
                    $query->where('is_personality_motivation_completed', 1)->where('is_work_interest_completed', 1)->where('is_cognitive_ability_completed', 1);
                } else {
                    $query->where(function ($query) {
                        $query->where('is_personality_motivation_completed', '=', 0)
                            ->orWhere('is_work_interest_completed', '=', 0)
                            ->orWhere('is_cognitive_ability_completed', '=', 0);
                    });
                }
            }


            if ($request->filled('name')) {
                $names = explode(' ', $request->name); // Split the input name into parts
                $query = $query->where(function ($subQuery) use ($names) {
                    foreach ($names as $name) {
                        $subQuery->orWhere('first_name', 'like', '%' . $name . '%')
                            ->orWhere('middle_name', 'like', '%' . $name . '%')
                            ->orWhere('last_name', 'like', '%' . $name . '%');
                    }
                });
            }
            // Apply the duration filter
            $subquery = $query->yearsSinceCreation();

            if ($request->filled('duration')) {
                $duration = $request->input('duration');
                $subquery = $subquery->where(function ($query) use ($duration) {
                    switch ($duration) {
                        case '1_g':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) < 1');
                            break;
                        case '1_2':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 1 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 2');
                            break;
                        case '2_3':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 2 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) <= 3');
                            break;
                        case '3_4':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 3 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 4');
                            break;
                        case '4_5':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 4 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) <= 5');
                            break;
                        case '5_6':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 5 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 6');
                            break;
                        case '6_8':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 6 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 8');
                            break;
                        case '8_g':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 8');
                            break;
                    }
                });
            }

            $users = $query->orderBy('created_at', 'DESC')->paginate(20);
        } else {
            $query = User::query();

            $query = $query->here('department_id', auth()->user()->id)->where('role_name', Role::$employee);

            if ($request->filled('age')) {
                $ageRange = explode('_', $request->input('age'));
                if (count($ageRange) == 2) {
                    $query->whereBetween('age', $ageRange);
                }
            }

            if ($request->filled('gender')) {
                $query->where('gender', $request->input('gender'));
            }

            if ($request->filled('education_level')) {
                $query->where('education_level', $request->input('education_level'));
            }

            if ($request->filled('work_experience')) {
                $workExperienceRange = explode('_', $request->input('work_experience'));
                if (count($workExperienceRange) == 2) {
                    $query->whereBetween('year_of_experience_in_it_sector', $workExperienceRange);
                }
            }

            if ($request->filled('potential')) {
                if ($request->potential == 1) {
                    $query->where('gp_percentage', '>', $averagePercentage);
                } else {
                    $query->where('gp_percentage', '<', $averagePercentage);
                }
            }

            if ($request->filled('level')) {
                $positions = Position::where('level', $request->level)->pluck('id')->toArray();
                $query->whereIn('position_id', $positions);
            }

            if ($request->filled('department')) {
                $query->where('department_id', $request->department);
            }

            if ($request->filled('assessment_completion')) {

                if ($request->assessment_completion == 1) {
                    $query->where('is_personality_motivation_completed', 1)->where('is_work_interest_completed', 1)->where('is_cognitive_ability_completed', 1);
                } else {
                    $query->where(function ($query) {
                        $query->where('is_personality_motivation_completed', '=', 0)
                            ->orWhere('is_work_interest_completed', '=', 0)
                            ->orWhere('is_cognitive_ability_completed', '=', 0);
                    });
                }
            }

            if ($request->filled('name')) {
                $names = explode(' ', $request->name); // Split the input name into parts
                $query = $query->where(function ($subQuery) use ($names) {
                    foreach ($names as $name) {
                        $subQuery->orWhere('first_name', 'like', '%' . $name . '%')
                            ->orWhere('middle_name', 'like', '%' . $name . '%')
                            ->orWhere('last_name', 'like', '%' . $name . '%');
                    }
                });
            }


            $users = $query->orderBy('created_at', 'DESC')->paginate(20);
        }


        $data = [
            'users' => $users,
            'departments' => $departments
            // 'type'=>$type
        ];
        return view('admin.myemployee.index', $data);
    }

    public function employeeGet(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {
            
            $user = auth()->user();

            $query = User::with(['department', 'division', 'company.userCompany', 'job_position', 'team','tenant'])
                ->select([
                    'users.id',
                    'users.tenant_id',
                    'users.name',
                    'users.first_name',
                    'users.last_name',
                    'users.email',
                    'users.gender',
                    'users.age',
                    'users.profile_picture',
                    'is_personality_motivation_completed',
                    'users.department_id',
                    'users.division_id',
                    'users.company_id',
                    'users.position_id',
                    // 'users.team_id',
                    'is_work_interest_completed',
                    'is_cognitive_ability_completed',
                    'technical_assessment_completed'
                ])
                ->where('tenant_id', tenant_id())
                ->where('role_name', Role::$employee);

            if ($request->has('searchBuilder') && isset($request->searchBuilder['criteria'])) {
                foreach ($request->searchBuilder['criteria'] as $criteria) {

                    if (isset($criteria['origData']) && $criteria['origData'] === 'department') {
                        $departmentId = $criteria['value1'] ?? null;
                        if ($departmentId) {
                            $query->where('department_id', $departmentId);
                        }
                    }

                    if (isset($criteria['origData']) && $criteria['origData'] === 'division') {
                        $divisionId = $criteria['value1'] ?? null;
                        if ($divisionId) $query->where('division_id', $divisionId);
                    }

                    if (in_array('origData', array_keys($criteria)) && in_array('condition', array_keys($criteria))) {

                        $column = $criteria['origData']; // Column to filter on
                        $value1 = $criteria['value1'] ?? null; // First value for comparison
                        $value2 = $criteria['value2'] ?? null; // Second value for comparison (if applicable)
                        $condition = $criteria['condition']; // Comparison operator
                        $type = $criteria['type']; // Data type (string, num, date, etc.)

                        // Apply condition based on column type and operator
                        switch ($type) {
                            case 'string':
                                $this->applyStringCondition($query, $column, $condition, $value1);
                                break;
                            case 'num':
                                $this->applyNumericCondition($query, $column, $condition, $value1, $value2);
                                break;
                                // Add cases for other data types as needed
                        }
                    }
                }
            }

            if ($request->has('department_id')) {
                $query->where('users.department_id', $request->department_id);
            }

            if ($request->has('division_id')) {
                $query->where('users.division_id', $request->division_id);
            }

            if ($request->has('position')) {
                $query->where('users.position_id', $request->position);
            }

            if ($request->filled('company_id')) {
                $query->where('company_id', (int) $request->company_id);
            }

            
            

            // if ($request->has('team')) {
            //     $query->where('users.team_id', $request->team);
            // }

            if ($request->has('gender')) {
                $query->where('gender', $request->gender);
            }

            // if ($request->has('name_keyword')) {
            //     $names = explode(' ', $request->name_keyword); // Split the input name into parts
            //     $query->where(function ($subQuery) use ($names) {
            //         foreach ($names as $name) {
            //             $subQuery->orWhere('first_name', 'like', '%' . $name . '%')
            //                 ->orWhere('middle_name', 'like', '%' . $name . '%')
            //                 ->orWhere('last_name', 'like', '%' . $name . '%');
            //         }
            //     });
            // }
            if ($request->has('name_keyword')) {
                $nameKeyword = $request->name_keyword;

                $query->where(function ($subQuery) use ($nameKeyword) {
                    $subQuery->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$nameKeyword%"])
                            ->orWhereRaw("CONCAT(first_name, ' ', middle_name, ' ', last_name) LIKE ?", ["%$nameKeyword%"])
                            ->orWhere('first_name', 'like', '%' . $nameKeyword . '%')
                            ->orWhere('middle_name', 'like', '%' . $nameKeyword . '%')
                            ->orWhere('last_name', 'like', '%' . $nameKeyword . '%');
                });
            }
            
            if ($request->has('email_keyword')) {
                $value = $request->email_keyword;
                $query->where('email', 'LIKE', '%' . $value . '%');
            }

            if ($request->has('is_personality_motivation_completed_id')) {
                $query->where('is_personality_motivation_completed', $request->is_personality_motivation_completed_id);
            }

            if ($request->has('is_work_interest_completed_id')) {
                $query->where('is_work_interest_completed', $request->is_work_interest_completed_id);
            }

            if ($request->has('is_cognitive_ability_completed_id')) {
                $query->where('is_cognitive_ability_completed', $request->is_cognitive_ability_completed_id);
            }

            if ($request->has('is_technical_assessment_completed_id')) {
                if ($request->is_technical_assessment_completed_id == '0') {
                    $query->where(function ($q) {
                        $q->where('technical_assessment_completed', '0')
                          ->orWhereNull('technical_assessment_completed');
                    });
                } else {
                    $query->where('technical_assessment_completed', $request->is_technical_assessment_completed_id);
                }
            }

            $op  = $request->input('age_operator'); // eq, ne, lt, lte, gte, gt, between, not_between, is_null, not_null
            $val = $request->input('age_value');
            $min = $request->input('age_min');
            $max = $request->input('age_max');

            if ($op) {
                switch ($op) {
                    case 'eq':  if ($val !== null && $val !== '') $query->where('age', (int)$val); break;
                    case 'ne':  if ($val !== null && $val !== '') $query->where('age', '!=', (int)$val); break;
                    case 'lt':  if ($val !== null && $val !== '') $query->where('age', '<',  (int)$val); break;
                    case 'lte': if ($val !== null && $val !== '') $query->where('age', '<=', (int)$val); break;
                    case 'gte': if ($val !== null && $val !== '') $query->where('age', '>=', (int)$val); break;
                    case 'gt':  if ($val !== null && $val !== '') $query->where('age', '>',  (int)$val); break;

                    case 'between':
                        if ($min !== null && $max !== null && $min !== '' && $max !== '')
                            $query->whereBetween('age', [(int)$min, (int)$max]);
                        break;

                    case 'not_between':
                        if ($min !== null && $max !== null && $min !== '' && $max !== '')
                            $query->where(function($q) use ($min,$max){
                                $q->where('age','<',(int)$min)->orWhere('age','>',(int)$max);
                            });
                        break;

                    case 'is_null':  $query->whereNull('age');    break;
                    case 'not_null': $query->whereNotNull('age'); break;
                }
            }         
            

            if ($request->has('type')) {
                $employees = $query->selectRaw('
                CASE 
                    WHEN age > 0 THEN age 
                    ELSE "-" 
                END as age,
                CASE 
                    WHEN gender = 2 THEN "Female" 
                    ELSE "Male" 
                END as gender,
                CASE 
                    WHEN is_personality_motivation_completed = 1 THEN "Completed" 
                    ELSE "Not Completed" 
                END as is_personality_motivation_completed,
                CASE 
                    WHEN is_work_interest_completed = 1 THEN "Completed" 
                    ELSE "Not Completed" 
                END as is_work_interest_completed,
                CASE 
                    WHEN is_cognitive_ability_completed = 1 THEN "Completed" 
                    ELSE "Not Completed" 
                END as is_cognitive_ability_completed,
                CASE 
                    WHEN technical_assessment_completed = 1 THEN "Completed" 
                    ELSE "Not Completed" 
                END as technical_assessment_completed,
        "' . env('APP_NAME') . '" as company_id
            ')->leftJoin('departments', 'users.department_id', '=', 'departments.id')
            ->addSelect('departments.name as department_id')->leftJoin('jobs', 'users.position_id', '=', 'jobs.id')
            ->addSelect('jobs.title as position_id')->leftJoin('teams', 'users.team_id', '=', 'teams.id')
            ->addSelect('teams.name as team_id')->leftJoin('divisions', 'users.division_id', '=', 'divisions.id')
            ->addSelect('divisions.head_of_division as division_id')->get();
                return response()->json(['data' => $employees]);
            }
            
            // Return DataTable
            return DataTables::of($query)
                ->rawColumns(['name', 'actions']) // Render raw HTML for checkboxes
                ->editColumn('name', function ($user) {
                    $html = '<div class="row-checkbox symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <a href="/admin/employee-details/' . $user->id . '">
                                                <div class="symbol-label">';
                    if (isset($user->profile_picture) && File::exists(public_path($user->profile_picture))) {
                        $html .= '<img src="' . asset($user->profile_picture) . '"
                       alt="' . ($user->name) . '" class="w-100" />';
                    } else {
                        $html .= '<img src="' . asset('images/default-user.svg') . '"
                       alt="' . ($user->name) . '" class="w-100" />';
                    }
                    $html .= '</div></a></div>';

                    $html .= '<div class="d-flex flex-column">
                                            <a href="/admin/employee-details/' . $user->id . '"
                                                class="text-gray-800 text-hover-primary mb-1">' . $user->name . '</a>
                                            <span>' . $user->email . '</span>
                                        </div>';
                    return $html;
                })
                ->editColumn('gender', function ($user) {
                    return $this->formatGender($user->gender);
                })
                ->editColumn('is_personality_motivation_completed', function ($user) {
                    return $this->formatCompletionStatus($user->is_personality_motivation_completed);
                })
                ->editColumn('department_id', function ($user) {
                    if ($user->department) {
                        return $user->department->name;
                    }
                    return '-';
                })
                ->editColumn('division_id', function ($user) {
                    return $user->division ? $user->division->head_of_division : '-';
                })
                ->editColumn('company_id', function ($user) {
                    return $user?->tenant?->name ?? '-';
                })
                ->editColumn('position_id', function ($user) {
                    if ($user->job_position) {
                        return $user->job_position->title;
                    }
                    return '-';
                })
                // ->editColumn('team_id', function ($user) {
                //     if ($user->team) {
                //         return $user->team->name;
                //     }
                //     return '-';
                // })
                ->editColumn('is_work_interest_completed', function ($user) {
                    return $this->formatCompletionStatus($user->is_work_interest_completed);
                })
                ->editColumn('is_cognitive_ability_completed', function ($user) {
                    return $this->formatCompletionStatus($user->is_cognitive_ability_completed);
                })
                ->editColumn('technical_assessment_completed', function ($user) {
                    return $this->formatCompletionStatus($user->technical_assessment_completed);
                })                
                // ->addColumn('actions', function ($user) {
                //     $html = '
                //     <a href="/admin/myemployee/send/email/' . $user->id . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Email"
                //         class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mb-2">
                //         <iconify-icon icon="mdi:email-sent-outline" class="fa-1-5"></iconify-icon>
                //     </a>
                //     <a href="/admin/employee-details/' . $user->id . '" data-bs-toggle="tooltip" data-bs-placement="top" title="View Detail"
                //         class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mb-2">
                //         <iconify-icon icon="fluent:eye-20-regular" class="fa-1-5"></iconify-icon>
                //     </a>
                //     <a href="/admin/myemployee/' . $user->id . '/edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit User"
                //         class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mb-2">
                //         <iconify-icon icon="heroicons-outline:pencil-alt" class="fa-1-5"></iconify-icon>
                //     </a>
                //     <a href="/admin/myemployee/' . $user->id . '/login" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Login User"
                //         class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mb-2">
                //         <iconify-icon icon="mdi:login" class="fa-1-5"></iconify-icon>
                //     </a>';
                //     // <a href="/admin/myemployee/' . $user->id . '/delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete User"
                //     //     class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm mb-2">
                //     //     <iconify-icon icon="iconamoon:trash-light" class="fa-1-5"></iconify-icon>
                //     // </a>';

                //     // $loggedInUser = auth()->user();
                //     // if ($loggedInUser->role_id === 2) {
                //     //     $html .= '
                //     //     <a href="/admin/myemployee/' . $user->id . '/delete" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete User"
                //     //         class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm mb-2">
                //     //         <iconify-icon icon="iconamoon:trash-light" class="fa-1-5"></iconify-icon>
                //     //     </a>';
                //     // }

                //     // Check for contract and position
                //     if ($user->position_id) {
                //         $contract = Contract::where('employee_id', $user->id)
                //             ->where('job_id', $user->position_id)
                //             ->first();

                //         if (!$contract) {
                //             $html .= '
                //             <a data-bs-toggle="modal" data-bs-target="#kt_modal_2" userid="' . ($user->id ?? '') . '" data-bs-toggle="tooltip" data-bs-placement="top" title="Assign Contract"
                //                 class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mb-2">
                //                 <iconify-icon icon="teenyicons:contract-outline" class="fa-1-5"></iconify-icon>
                //             </a>';
                //         } else {
                //             $html .= '
                //             <a href="' . ($contract->contract_pdf ?? '') . '" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="View Assigned Contract"
                //                 class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mb-2">
                //                 <iconify-icon icon="mdi:contract-sign" class="fa-1-5"></iconify-icon>
                //             </a>';
                //         }
                //     }

                //     return $html;
                // })
                ->addColumn('actions', function ($user) {
                    $html = '
                    <div class="dropup">
                        <button class="custom-light btn btn-light bg-white" type="button" id="kebabMenu_' . $user->id . '" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="kebabMenu_' . $user->id . '">
                            <li>
                                <a class="dropdown-item" href="/admin/employee-details/' . $user->id . '" title="View Detail">
                                    <iconify-icon icon="fluent:eye-20-regular" class="me-2"></iconify-icon>View Detail
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/admin/myemployee/send/email/' . $user->id . '" title="Send Email">
                                    <iconify-icon icon="mdi:email-sent-outline" class="me-2"></iconify-icon>Send Reminder Email
                                </a>
                            </li>
                            <li>
                            <li>
                                <a class="dropdown-item" href="/admin/myemployee/resend-onboarding-email/' . $user->id . '" title="Resend Assessment Email">
                                    <iconify-icon icon="mdi:email-sent-outline" class="me-2"></iconify-icon>
                                    Resend Assessment Email
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/admin/myemployee/send-technical-assessment/' . $user->id . '" title="Send Technical Assessment">
                                    <iconify-icon icon="mdi:email-sent-outline" class="me-2"></iconify-icon>
                                    Send Technical Assessment
                                </a>
                            </li>';
                            // <li>
                            //     <a class="dropdown-item" href="/admin/myemployee/' . $user->id . '/edit" title="Edit User">
                            //         <iconify-icon icon="heroicons-outline:pencil-alt" class="me-2"></iconify-icon>Edit User
                            //     </a>
                            // </li>
                            // <li>
                            //     <a class="dropdown-item" href="/admin/myemployee/' . $user->id . '/delete" title="Delete User">
                            //         <iconify-icon icon="iconamoon:trash-light" class="me-2"></iconify-icon>Delete User
                            //     </a>
                            // </li>
                            // <li>
                            //     <a class="dropdown-item" href="/admin/myemployee/' . $user->id . '/login" target="_blank" title="Login User">
                            //         <iconify-icon icon="mdi:login" class="me-2"></iconify-icon>Login User
                            //     </a>
                            // </li>';

                    // Check for contract and position
                    if ($user->position_id) {
                        $contract = \App\Models\Contract::where('employee_id', $user->id)
                            ->where('job_id', $user->position_id)
                            ->first();

                        if (!$contract) {
                            // $html .= '
                            // <li>
                            //     <a class="dropdown-item assign-contract-btn" href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_2" userid="' . ($user->id ?? '') . '" title="Assign Contract">
                            //         <iconify-icon icon="teenyicons:contract-outline" class="me-2"></iconify-icon>Assign Contract
                            //     </a>
                            // </li>';
                        } else {
                            $html .= '
                            <li>
                                <a class="dropdown-item" href="' . ($contract->contract_pdf ?? '') . '" target="_blank" title="View Assigned Contract">
                                    <iconify-icon icon="mdi:contract-sign" class="me-2"></iconify-icon>View Contract
                                </a>
                            </li>';
                        }
                    }

                    $html .= '</ul></div>';

                    return $html;
                })
                ->make(true);
        }
    }

    public function departmentGet(Request $request)
    {
        $departments = Department::where('company_id', 3)->get();
        return response()->json($departments, 200);
    }

    public function divisionsGet(Request $request)
    {
        $user = auth()->user();
        $companyId = $user->isCompany() ? $user->id : $user->company_id;

        $divisions = Division::where('company_id', $companyId)
            ->orderBy('head_of_division')
            ->get(['id', 'head_of_division']);

        return response()->json($divisions, 200);
    }

    public function positionsGet(Request $request)
    {
        $jobs = Job::where('is_primary', 0)->get(['id','title']);
        return response()->json($jobs, 200);
    }

    public function teamsGet(Request $request)
    {
        $teams = Team::where('company_id', 3)->get(['id','name']);
        return response()->json($teams, 200);
    }

    /**
     * Format Completion Status
     */
    private function formatCompletionStatus($status)
    {
        return $status == 1 ? 'Completed' : 'Not Completed';
    }

    /**
     * Format Completion Status
     */
    private function formatGender($gender)
    {
        $result = 'N / A';
        if ($gender == 0) {
            $result = 'Male';
        } elseif ($gender == 1) {
            $result = 'Female';
        } elseif ($gender == 2) {
            $result = 'N / A';
        }
        return $result;
        // return $gender == 2 ? 'Female' : 'Male';
    }


    private function applyStringCondition($query, $column, $condition, $value)
    {
        switch ($condition) {
            case '=':
                $query->where($column, '=', $value);
                break;
            case 'contains':
                $query->where($column, 'LIKE', "%$value%");
                break;
            case 'startsWith':
                $query->where($column, 'LIKE', "$value%");
                break;
            case 'endsWith':
                $query->where($column, 'LIKE', "%$value");
                break;
                // Add more string conditions as needed
        }
    }

    /**
     * Apply numeric-based conditions to the query.
     */
    private function applyNumericCondition($query, $column, $condition, $value1, $value2 = null)
    {
        // dd($condition);
        switch ($condition) {
            case 'equals':
                $query->where($column, '=', $value1);
                break;
            case 'not':
                $query->where($column, '!=', $value1);
                break;
            case 'greaterThan':
                $query->where($column, '>', $value1);
                break;
            case 'lessThan':
                $query->where($column, '<', $value1);
                break;
            case 'between':
                if ($value1 !== null && $value2 !== null) {
                    $query->whereBetween($column, [$value1, $value2]);
                }
                break;
            case '!between':
                if ($value1 !== null && $value2 !== null) {
                    $query->whereNotBetween($column, [$value1, $value2]);
                }
                break;  
            case 'null':
                $query->whereNull($column);
                break;
            case 'notNull':
                $query->whereNotNull($column);
                break;
            case '>=':
                if ($value1 !== null) {
                $query->where($column, '>=', (float)$value1);
                }
                break;
            case '<=':
                $query->where($column, '<=', $value1);
                break;        
                
                // Add more numeric conditions as needed
        }
    }

    public function create()
    {
        $sectors = Sector::all();

        $departments = Department::where('company_id', auth()->user()->id)->select('head_of_department', 'id')
            ->orderBy('created_at', 'DESC')
            ->get();

        $sections = []; // Initialize sections as an empty array
        $units = []; // Initialize units as an empty array
        $positions = [];

        // $barangays = \App\Models\MasterBarangay::select('id','name')->get();
        $education_levels = \App\Models\MasterEducationLevel::all();
        // $higher_learning_institutions = \App\Models\MasterHigherLearningInstitution::all();
        $scope_of_studies = \App\Models\MasterScopeOfStudy::all();
        $itSkills = \App\Models\MasterItSkill::all();
        // $cities = \App\Models\MasterCity::all();
        $provinces = \App\Models\MasterProvince::all();
        $user = null;
        $data = [
            'user' => $user,
            'departments' => $departments,
            'sectors' => $sectors,
            'sections' => $sections,
            'units' => $units,
            'positions' => $positions,
            // 'barangays'=>$barangays,
            'education_levels' => $education_levels,
            // 'higher_learning_institutions'=>$higher_learning_institutions,
            'scope_of_studies' => $scope_of_studies,
            'itSkills' => $itSkills,
            // 'cities'=>$cities,
            'provinces' => $provinces
        ];

        return view('admin.myemployee.create', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData =  $request->validate([
            'first_name' => 'required',
            // 'middle_name' => 'required',

            'last_name' => 'required',
            'department_id' => 'nullable|exists:departments,id',
            'sector_id' => 'nullable|exists:sectors,id',
            'position_id' => 'nullable|exists:jobs,id',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'section_id' => 'nullable|exists:department_sections,id',
            'unit_id' => 'nullable|exists:section_units,id',
            'team_id' => 'nullable|exists:teams,id',
        ]);

        $auth = auth()->user();
        $req_data = array_merge($request->all(), $validatedData);
        if ($request->filled('section_id')) {
            // Check if the section belongs to the department
            $section = DepartmentSection::where('id', $request->section_id)
                ->where('department_id', $request->department_id)
                ->first();

            if (!$section) {
                return redirect()->back()->withErrors(['section_id' => 'The selected section does not belong to the specified department.'])->withInput();
            }
        }

        if ($request->filled('unit_id')) {
            // Check if the unit belongs to the section
            $unit = SectionUnit::where('id', $request->unit_id)
                ->where('department_section_id', $request->section_id)
                ->first();

            if (!$unit) {
                return redirect()->back()->withErrors(['unit_id' => 'The selected unit does not belong to the specified section.'])->withInput();
            }
        }

        DB::beginTransaction();
        // try {
        if ($request->has('avatar')) {
            $avatarName = '/media/users/avatars/' . time() . '.' . $request->avatar->extension(); // Generate unique avatar name
            $request->avatar->move(public_path('media/users/avatars'), $avatarName); // Move avatar to public/avatars directory

        }

        // Hash the password
        $hashedPassword = Hash::make($request->password);

        $fullName = '';

        if ($request->filled('middle_name')) {
                $fullName = $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name;
        } else {
                $fullName = $request->first_name . ' ' . $request->last_name;
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name ?? '',
            'last_name' => $request->last_name,
            'role_name' => 'employee',
            'role_id' => 1,
            'birth_date' => $request->birth_date ?? '',
            'city_id' => $request->city_id ?? '',
            'education_level' => $request->education_level,
            'higher_learning_institution' => $request->higher_learning_institution,
            'scope_of_study' => $request->scope_of_study,
            // 'education_program_id' => $request->scope_of_study,
            'graduate_year' => $request->graduate_year,
            'gender' => $request->gender,
            'age' => $request->age,
            'national_id' => $request->national_id,
            'country_id' => $request->country_id,
            'name' => $fullName,
            'company_id' => 3,
            'department_id' => $request->department_id,
            'section_id' => $request->section_id,
            'unit_id' => $request->unit_id,
            'sector_id' => $request->sector_id,
            'team_id' => $request->team_id,
            'position_id' => $request->position_id,
            'employment_status' => $request->emp_status,
            'date_of_hire' => $request->date_of_hire,
            'profile_picture' => $avatarName ?? NULL, // Save the avatar name in the database
            'email' => $request->email,
            'password' => $hashedPassword,
            'tenant_id' => tenant_id(),
        ]);

        // $user->update($req_data);

        if (isset($request->employments)) {

            UserEmployment::where('user_id', $user->id)->delete();
            foreach ($request->employments as $employment) {

                $emp =  UserEmployment::create([
                    'user_id' => $user->id,
                    'job_title' => $employment['job_title'],
                    'company_name' => $employment['company_name'],
                    'start_date' => $employment['start_date'],
                    'end_date' => $employment['end_date'] ?? '',
                    'year_of_work' => $employment['year_of_work'],
                    'key_responsiblity' => $employment['key_responsiblity']
                ]);
            }
        } else {
            UserEmployment::where('user_id', $user->id)->delete();
        }

         // Prepare email data
        $to = $user->email;
        $templateType = 'manual_employee_onboarding';  // Template type based on your database
        $data = [
            'Employee First Name' => $user->first_name ?? '',
            'Employee Middle Name' => $user->middle_name ?? '',
            'Employee Last Name' => $user->last_name ?? '',
            'Employee Email' => $user->email,
            'Employee Password'=>$request->password,
        ];

        $data['Company Name'] = $user->company->userCompany->name ?? env('APP_NAME');
        $data['Company Phone Number'] = $user->company->userCompany->mobile_number ?? env('APP_NAME');
        $data['Employee Full Name'] = $user->name;
        $data['X'] = now()->diffInMinutes($user->otp_expires_at);
        // Send email using the sendEmail method
        HelperFunctions::sendEmail($to, $templateType, $data);

        DB::commit();

        return redirect('/admin/myemployee/')->with('success', 'Employee created successfully.');
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return redirect()->back()->with('error', 'An error occurred while creating the employee.')->withInput();
        // }
    }



    public function edit($id)
    {
        $user = User::find($id);

        $departments = Department::where('company_id', auth()->user()->id)->select('head_of_department', 'id')
            ->orderBy('created_at', 'DESC')
            ->get();

        $sectors = Sector::select('name', 'id')->orderBy('created_at', 'DESC')->get();

        $sections = DepartmentSection::where('department_id', $user->department_id)
            ->select('name', 'id')
            ->orderBy('created_at', 'DESC')
            ->get();

        $units = SectionUnit::where('department_section_id', $user->section_id)
            ->select('name', 'id')
            ->orderBy('created_at', 'DESC')
            ->get();

        $positions = Job::where('department_id', $user->sector_id)->get(); // Fetch positions based on sector_id

        // $barangays = \App\Models\MasterBarangay::select('id','name')->get();
        // dd($barangays);
        $education_levels = \App\Models\MasterEducationLevel::all();
        // $higher_learning_institutions = \App\Models\MasterHigherLearningInstitution::all();
        $scope_of_studies = \App\Models\MasterScopeOfStudy::all();
        $itSkills = \App\Models\MasterItSkill::all();
        // $cities = \App\Models\MasterCity::all();
        $provinces = \App\Models\MasterProvince::all();


        $data = [
            'user' => $user,
            'departments' => $departments,
            'sections' => $sections,
            'units' => $units,
            'sectors' => $sectors,
            'positions' => $positions,
            // 'barangays'=>$barangays,
            'education_levels' => $education_levels,
            // 'higher_learning_institutions'=>$higher_learning_institutions,
            'scope_of_studies' => $scope_of_studies,
            'itSkills' => $itSkills,
            // 'cities'=>$cities,
            'provinces' => $provinces
        ];
        return view('admin.myemployee.create', $data);
    }


    public function update(Request $request, $id)
    {

        $user = User::where('id', $id)->first();

        $auth = auth()->user();

        $validatedData = $request->validate([
            'first_name' => 'required',
            // 'middle_name' => 'required',
            'middle_name' => 'nullable|string',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate avatar as an image file
            'password' => 'nullable|confirmed', // Password is optional
            'department_id' => 'nullable|exists:departments,id',
            // 'section_id' => 'nullable|exists:department_sections,id',
            'section_id' => 'nullable',

            'unit_id' => 'nullable|exists:section_units,id',
            'team_id' => 'nullable|exists:teams,id',
            'position_id' => 'nullable|exists:jobs,id',

        ]);

        $req_data = array_merge($request->all(), $validatedData);

        if ($request->filled('section_id')) {
            // Check if the section belongs to the department
            $section = DepartmentSection::where('id', $request->section_id)
                ->where('department_id', $user->department_id)
                ->first();

            if (!$section) {
                return redirect()->back()->withErrors(['section_id' => 'The selected section does not belong to the specified department.'])->withInput();
            }
        }

        if ($request->filled('unit_id')) {
            // Check if the unit belongs to the section
            $unit = SectionUnit::where('id', $request->unit_id)
                ->where('department_section_id', $request->section_id)
                ->first();

            if (!$unit) {
                return redirect()->back()->withErrors(['unit_id' => 'The selected unit does not belong to the specified section.'])->withInput();
            }
        }

        DB::beginTransaction();
        try {

            $fullName = '';
            if ($request->filled('middle_name')) {
                $fullName = $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name;
            } else {
                $fullName = $request->first_name . ' ' . $request->last_name;
            }


            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'name' => $fullName,
                'email' => $request->email,
                // 'company_id' => $auth->id,
                'company_id' => 3,
                // 'department_id' => $request->department_id,
                'section_id' => $request->section_id,
                'unit_id' => $request->unit_id,
                'team_id' => $request->team_id,
                'employment_status' => $request->emp_status,
                'date_of_hire' => $request->date_of_hire,
                // 'position_id' => $request->position_id,
                'sector_id' => $request->sector_id,

            ]);

            $user->update($req_data);

            if ($request->hasFile('avatar')) {
                // Store new avatar in the public folder
                $avatarName = '/media/users/avatars/' . time() . '.' . $request->avatar->extension();
                $request->avatar->move(public_path('media/users/avatars'), $avatarName);
                // Delete old avatar if exists
                if ($user->profile_picture && file_exists(public_path($user->profile_picture))) {
                    unlink(public_path($user->profile_picture));
                }
                // Update user's avatar
                $user->update(['profile_picture' => $avatarName]);
            }

            if ($request->password) {
                // Hash the password
                $hashedPassword = Hash::make($request->password);
                // Update user's password
                $user->update(['password' => $hashedPassword]);
            }

            if (isset($request->employments)) {

                UserEmployment::where('user_id', $user->id)->delete();
                foreach ($request->employments as $employment) {

                    $emp =  UserEmployment::create([
                        'user_id' => $user->id,
                        'job_title' => $employment['job_title'],
                        'company_name' => $employment['company_name'],
                        'start_date' => $employment['start_date'],
                        'end_date' => $employment['end_date'] ?? '',
                        'year_of_work' => $employment['year_of_work'],
                        'key_responsiblity' => $employment['key_responsiblity']
                    ]);
                }
            } else {
                UserEmployment::where('user_id', $user->id)->delete();
            }




            DB::commit();

            return redirect('/admin/myemployee/')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while updating the employee.')->withInput();
        }
    }


    public function destroy($id)
    {
        $user = User::find($id);
        // dd($id);
        $user->delete();

        return redirect('/admin/myemployee/')->with('success', 'User deleted successfully.');
    }

    public function removeAvatar($id)
    {
        $user = User::findOrFail($id);

        if ($user->profile_picture && file_exists(public_path($user->profile_picture))) {
            unlink(public_path($user->profile_picture));
        }

        $user->profile_picture = null;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Avatar removed successfully.']);
    }


    // In your controller method for handling bulk import
    public function bulkImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx|max:3048', // Allow only .xlsx files up to 2MB
        ]);
        set_time_limit(0);

        // Retrieve the uploaded file
        $file = $request->file('file');

        try {
            // Import the .xlsx file using Laravel Excel
            $filePath = $request->file('file')->store('temp'); // Store the file temporarily
            $filePath = storage_path('app/' . $filePath); // Get the full path

            // ImportEmployees::dispatch($filePath, auth()->user());
            // dd($filePath);
            Excel::import(new EmployeesImport(auth()->user()), $filePath);

            // Provide feedback to the user
            return back()->with('success', 'File uploaded and processed successfully.');
        } catch (\exception $th) {
            // Handle any exceptions or errors
            return back()->with('error', 'An error occurred while processing the file.');
        }
    }


    public function barangaySearch(Request $request)
    {
        // dd($request->all());
        // Check if an ID is specified to fetch a specific barangay
        if ($request->has('id')) {
            $barangay = MasterBarangay::find($request->id);
            return response()->json([
                'id' => $barangay->id,
                'text' => $barangay->name
            ]);
        }

        // Handle search functionality
        $query = $request->get('q');
        $barangays = MasterBarangay::where('name', 'LIKE', "%{$query}%")->paginate(10);

        return response()->json([
            'results' => $barangays->map(function ($barangay) {
                return ['id' => $barangay->id, 'text' => $barangay->name];
            }),
            'pagination' => [
                'more' => $barangays->currentPage() < $barangays->lastPage()
            ]
        ]);
    }

    public function CitySearch(Request $request)
    {

        // Check if an ID is specified to fetch a specific barangay
        if ($request->has('id')) {
            $barangay = MasterCity::find($request->id);
            return response()->json([
                'id' => $barangay->id,
                'text' => $barangay->name
            ]);
        }


        // Handle search functionality
        $query = $request->get('q');
        $barangays = MasterCity::where('name', 'LIKE', "%{$query}%")->paginate(10);
        // dd($barangays);
        return response()->json([
            'results' => $barangays->map(function ($barangay) {
                return ['id' => $barangay->id, 'text' => $barangay->name];
            }),
            'pagination' => [
                'more' => $barangays->currentPage() < $barangays->lastPage()
            ]
        ]);
    }

    public function StateSearch(Request $request)
    {

        // Check if an ID is specified to fetch a specific barangay
        if ($request->has('id')) {
            $states = MasterState::find($request->id);
            return response()->json([
                'id' => $states->id,
                'text' => $states->name
            ]);
        }


        // Handle search functionality
        $query = $request->get('q');
        $states = MasterState::where('name', 'LIKE', "%{$query}%")->paginate(10);
        // dd($barangays);
        return response()->json([
            'results' => $states->map(function ($states) {
                return ['id' => $states->id, 'text' => $states->name];
            }),
            'pagination' => [
                'more' => $states->currentPage() < $states->lastPage()
            ]
        ]);
    }


    public function sendEmail($id)
{
    try {
        // Generate random password
        $randomPassword = Str::random(12);
        $hashedPassword = Hash::make($randomPassword);

        // Find the user by ID
        $user = User::where('id', $id)->first();
        $user->password = $hashedPassword;
        $user->save();

        // Prepare email data
        $to = $user->email;
        $templateType = 'assessment_resent_email';  // Template type for the send employees email
        $data = [
            'Employee Email' => $user->email ?? '',
            'Employee Password' => $randomPassword ?? '',
            'Employee Full Name' => $user->name ?? '',
            'Employee First Name' => $user->first_name ?? '',
            'Employee Middle Name' => $user->middle_name ?? '',
            'Employee Last Name' => $user->last_name ?? '',
            'job_title' => $user->position->title ?? '',  // Replace with the actual job title if needed
            'company_name' => auth()->user()->userCompany()->first()->name ?? ''
        ];
        // dd($data);

        // Send email using the sendEmail method in HelperFunctions
        HelperFunctions::sendEmail($to, $templateType, $data);

        // Return success response
        return redirect()->back()->with('success', 'Email Sent Successfully');
    } catch (\Exception $e) {
        // Handle error and log it
        \Log::error('Email sending failed: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Email sending failed.');
    }
}


    public function manager(Request $request)
    {

        // Check if an ID is specified to fetch a specific barangay
        $query = User::query();
        $query = $query->where('company_id', 3)->where('role_name', Role::$employee)->where('is_pm_cm', 1);
        // dd($barangays);
        if ($request->filled('email')) {
            $query->where('email', 'LIKE', '%' . $request->input('email') . '%');
        }

        if ($request->filled('name')) {
            $query->where('first_name', 'like', '%' . $request->name . '%')->orWhere('middle_name', 'like', '%' . $request->name . '%')->orWhere('last_name', 'like', '%' . $request->name . '%');
        }

        $users = $query->paginate(10);
        $data = [
            'users' => $users
        ];
        $setting = Setting::where('user_id', 3)->first();
        $data['setting'] = $setting;
        return view('admin.myemployee.manager', $data);
    }

    public function dynamicPercentage(Request $request)
    {

        if (($request->technical_percentage + $request->soft_skill_percentage) > 100) {
            return redirect()->back()->with('error', 'Technical Percentage and Soft Skill Percentage must sum up to 100%.');
        }

        $setting = Setting::where('user_id', 3)->first();

        $setting->technical_percentage = $request->technical_percentage;
        $setting->soft_skill_percentage = $request->soft_skill_percentage;

        $setting->save();

        // $users = User::where('company_id', auth()->user()->id)->where('role_name', Role::$employee)->where('is_pm_cm',1)->where('is_cognitive_ability_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_personality_motivation_completed', '=', 1)->get();

        $users = User::where('company_id', auth()->user()->id)->where('role_name', Role::$employee)->where('is_pm_cm', 1)->get();

        foreach ($users as $user) {
            $user->match_rate = ($request->technical_percentage) * ($user->tech_skill_score) + ($request->soft_skill_percentage) * ($user->soft_skill_score);
            $user->save();
        }

        return redirect()->back()->with('success', 'Percentage updated successfully.');
    }

    public function technicalQuestions(Request $request)
    {
        $technical_questions = MasterTechnicalQuestion::all();


        // Check if an ID is specified to fetch a specific barangay
        $query = MasterTechnicalQuestion::query();
        // $query = $query->where('company_id', 3)->where('role_name', Role::$employee)->where('is_pm_cm',1);
        // // dd($barangays);
        // if ($request->filled('email')) {               
        //     $query->where('email', 'LIKE', '%' . $request->input('email') . '%');
        // }

        // if ($request->filled('name')) {               
        //     $query->where('first_name', 'like', '%' . $request->name . '%')->orWhere('middle_name', 'like', '%' . $request->name . '%')->orWhere('last_name', 'like', '%' . $request->name . '%');     
        // }

        $technical_questions = $query->paginate(10);
        $data['technical_questions'] = $technical_questions;

        return view('admin.myemployee.technical-questions', $data);
    }

    public function MasterHigherInstitutionSearch(Request $request)
    {

        // Check if an ID is specified to fetch a specific barangay
        if ($request->has('id')) {
            // $masterhigherinstitution = MasterCity::find($request->id);
            $higher_learning_institutions = \App\Models\MasterHigherLearningInstitution::find($request->id);
            return response()->json([
                'id' => $higher_learning_institutions->id,
                'text' => $higher_learning_institutions->name
            ]);
        }


        // Handle search functionality
        $query = $request->get('q');
        $higher_learning_institutions = \App\Models\MasterHigherLearningInstitution::where('name', 'LIKE', "%{$query}%")->paginate(10);
        // dd($barangays);
        return response()->json([
            'results' => $higher_learning_institutions->map(function ($higher_learning_institution) {
                return ['id' => $higher_learning_institution->id, 'text' => $higher_learning_institution->name];
            }),
            'pagination' => [
                'more' => $higher_learning_institutions->currentPage() < $higher_learning_institutions->lastPage()
            ]
        ]);
    }

    public function departmentWise(Request $request)
    {
        $departmentId = request('department_id', 63);
        $query = User::join('jobs', 'users.position_id', '=', 'jobs.id')
            ->where('users.company_id', 3)
            ->where('users.is_personality_motivation_completed', 1)
            ->where('users.is_work_interest_completed', 1)
            ->where('users.is_cognitive_ability_completed', 1)
            ->where('users.department_id', $departmentId)
            ->where('role_name', Role::$employee)
            ->whereNotIn('users.email', [
                'testcxs1@yopmail.com',
                'dcamador@eei.com.ph',
                'abancheta@eei.com.ph',
                'jcprangoluan@eei.com.ph',
                'rccaburnay@eei.com.ph',
                'smremonte@eei.com.ph',
                'mgzantua@eei.com.ph'
            ])
            ->select('users.*', 'jobs.title')
            ->orderBy('soft_skill_score', 'desc');
        // dd($barangays);
        if ($request->filled('email')) {
            $query->where('email', 'LIKE', '%' . $request->input('email') . '%');
        }

        if ($request->filled('name')) {
            $query->where('first_name', 'like', '%' . $request->name . '%')->orWhere('middle_name', 'like', '%' . $request->name . '%')->orWhere('last_name', 'like', '%' . $request->name . '%');
        }

        $users = $query->paginate(40);
        $data = [
            'users' => $users
        ];
        $setting = Setting::where('user_id', 3)->first();
        $data['setting'] = $setting;

        $data['department'] = Department::find($departmentId);

        $departments = Department::where('company_id', auth()->user()->id)->get();
        $data['departments'] = $departments;

        return view('admin.myemployee.department-wise', $data);
    }

    public function sendEmailsDepartmentWise(Request $request)
    {
        $departmentId = request('department_id', 63);

        $application_emails = User::join('jobs', 'users.position_id', '=', 'jobs.id')
            ->where('users.company_id', 3)
            ->where('users.is_personality_motivation_completed', 1)
            ->where('users.is_work_interest_completed', 1)
            ->where('users.is_cognitive_ability_completed', 1)
            ->where('users.department_id', $departmentId)
            ->where('role_name', Role::$employee)->pluck('email')->toArray();

        // Send Email
        $subject = 'Important: Complete Your Technical Assessment by August 16th';
        $message = 'Important: Complete Your Technical Assessment by August 16th';
        $mailableClass = 'TechnicalAssessmentMail';

        $data = [];

        HelperFunctions::sendEmails($application_emails, $subject, $message, $mailableClass, $data);

        return redirect()->back()->with('success', 'Email Will Be Sent Successfully');
    }

    public function loginAsEmployee($id)
    {
        $user = User::findOrFail($id);

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function resendOnboardingEmail($id)
{
    $user = User::findOrFail($id);
 
    // Example logic to resend the email
    HelperFunctions::sendEmail($user->email, 'manual_employee_onboarding', [
        'Employee Name' => $user->name ?? '',
        'Employee Email' => $user->email ?? '',
        'Company Name'          => $user->company->userCompany->name ?? env('APP_NAME'),
        'Employee Email' => $user->email,
        'Employee Password'=>$request->password,
    ]);
 
    return redirect()->back()->with('success', 'Assessment email resent successfully!');
}

    public function sendTechnicalAssessment($id)
    {
        $user = User::findOrFail($id);

        // Prepare email data
        $to = $user->email;
        $templateType = 'technical_assessment_mail';

        $data = [
            'Employee First Name'   => $user->first_name ?? '',
            'Employee Middle Name'  => $user->middle_name ?? '',
            'Employee Last Name'    => $user->last_name ?? '',
            'Employee Email'        => $user->email,
            'Employee Password'     => $user->password_text ?? '',
            'Company Name'          => $user->company->userCompany->name ?? env('APP_NAME'),
            'Company Phone Number'  => $user->company->userCompany->mobile_number ?? env('APP_NAME'),
            'Employee Full Name'    => $user->name,
            'X'                     => now()->diffInMinutes($user->otp_expires_at),
            'Assessment Link'       => url('/technical-assessment/start/' . $user->id),
        ];

        // Send the email using your helper
        HelperFunctions::sendEmail($to, $templateType, $data);

        return redirect()->back()->with('success', 'Technical assessment email sent successfully!');
    }




}
