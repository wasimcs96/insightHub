<?php

namespace App\Http\Controllers\Admin;

use App\Models\MasterCity;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\MasterItSkill;
use App\Helpers\AssessmentHelper;
use App\Helpers\NewAssessmentHelper;
use App\Models\MasterSector;
use App\Models\MasterSkill;
use App\Models\Position;
use App\Models\QuizDomainValueAnswer;
use App\Models\Setting;
use App\Models\User;
use App\Models\Department;
use App\Models\MasterTechnicalSkill;
use App\Models\TechnicalSkill;
use App\Models\JobOpeningApplication;
use App\Models\JobOpening;
use App\Models\JobProfile;
use App\Models\MasterJob;
use App\Models\UserResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    // public function dashboard(Request $request)
    // {
    //     $user = auth()->user();
    //         if($user->role_id == 2){
    //             $company_id = $user->id;
    //         }else{
    //             $company_id = $user->company_id;
    //         }
            
    //     if ((config('client.' . env('APP_BRANCH') . '.admin_dashboard')) && auth()->user()->role_id == 2) {
    //         return redirect('/admin/jobs/index?saved_job=1');
    //     }

    //     if (auth()->user()->role_id == 7) {
    //         return redirect("/admin/company/sector-skills?tab=joblevel");
    //     }elseif (auth()->user()->role_id == 12) {
    //         return redirect()->route('admin.jobDashboard.index');
    //     }
    //     elseif (auth()->user()->role_id == 11) {
    //         return redirect()->route('admin.employee.users.manager');
    //     } else {

           

    //         //Position Calculation
    //         $query1 = Job::query();
    //         // dd();

    //         $query1->withCount(['employees' => function ($query) use ($request,$company_id) {
    //             $query = $query->where('is_admin', '=', 0)->where('company_id', $company_id)->where('role_id', 1);

    //             if ($request->has('gender') && $request->gender != '') {
    //                 $query->where('gender', '=', $request->gender);
    //             }

    //             if ($request->has('department_id') && $request->department_id != '') {
    //                 $query->where('department_id', '=', $request->department_id);
    //             }

    //             if ($request->has('age') && $request->age != '') {
    //                 $ageRange = $request->age;
    //                 list(
    //                     $minAge, $maxAge
    //                 ) = explode('_', $ageRange);
                       
    //                 $query->whereBetween('age', [$minAge, $maxAge]);
    //             }
               
    //         }]);


    //         $positions = $query1->get();
 
    //         $positionWithUserCounts = [1=>0,2=>0,3=>0,4=>0];

    //         foreach ($positions as $position) {
    //             $level = $position->level;
    //             $usersCount = $position->employees_count;
                
    //             if ($usersCount > 0) {
    //                 if (isset($positionWithUserCounts[$level])) {
    //                     $positionWithUserCounts[$level] += $usersCount;
    //                 } else {
    //                     $positionWithUserCounts[$level] = $usersCount;
    //                 }
    //             }

    //         }

    //        ksort($positionWithUserCounts);
           
            
    //         $departments = Department::where('company_id', $company_id)->pluck('head_of_department', 'id')->toArray();
    //         $departmentSqlParts = [];
    //         foreach ($departments as $id => $name) {
    //             $departmentSqlParts[] = "select " . intval($id) . " as id, '" . addslashes($name) . "' as head_of_department";
    //         }
    //         $departmentSql = implode(
    //             " union all ",
    //             $departmentSqlParts
    //         );

    //         try {
    //             $userDepartmentsCounts = DB::table('users')->where('company_id', $company_id)->where('role_id', 1)
    //                 ->select('departments.head_of_department', DB::raw('count(users.id) as total'))
    //                 ->rightJoin(DB::raw("({$departmentSql}) as departments"), 'users.department_id', '=', 'departments.id')
    //                 ->groupBy('departments.head_of_department')
    //                 ->get()
    //                 ->pluck('total', 'head_of_department')->toArray();
    //         } catch (\Throwable $th) {
    //             $userDepartmentsCounts = [];
    //         }
           

    //         $query = MasterSector::query();

    //         $query->withCount(['users' => function ($query) use ($request) {
    //             $query = $query->where('is_admin', '=', 0)->where('role_id', 1);

    //             if ($request->has('gender') && $request->gender != '') {
    //                 $query->where('gender', '=', $request->gender);
    //             }

    //             if ($request->has('department_id') && $request->department_id != '') {
    //                 $query->where('department_id', '=', $request->department_id);
    //             }

    //             if ($request->has('age') && $request->age != '') {
    //                 $ageRange = $request->age;
    //                 list(
    //                     $minAge, $maxAge
    //                 ) = explode('_', $ageRange);

    //                 $query->whereBetween('age', [$minAge, $maxAge]);
    //             }
    //         }]);

    //         $sectorsWithUserCounts = $query->get()->pluck('users_count', 'name')->toArray();





    //         $topSkillsQuery = MasterItSkill::query();



    //         $topSkillsQuery = $topSkillsQuery->select('master_it_skills.name', DB::raw('COUNT(user_it_skills.user_id) as user_count'))
    //             ->join('user_it_skills', 'master_it_skills.id', '=', 'user_it_skills.it_skill_id')
    //             ->join('users', 'users.id', '=', 'user_it_skills.user_id');

    //         $topSkillsQuery = $topSkillsQuery->where('users.role_id', '=', 1);

    //         // Applying gender filter if present
    //         if ($request->has('gender') && $request->gender != '') {
    //             $topSkillsQuery = $topSkillsQuery->where('users.gender', '=', $request->gender);
    //         }

    //         if ($request->has('department_id') && $request->department_id != '') {
    //             $topSkillsQuery = $topSkillsQuery->where('users.department_id', '=', $request->department_id);
    //         }

    //         // Applying age filter if present
    //         if ($request->has('age') && $request->age != '') {
    //             $ageRange = $request->age;
    //             list($minAge, $maxAge) = explode('_', $ageRange);
    //             $topSkillsQuery = $topSkillsQuery->whereBetween('users.age', [(int)$minAge, (int)$maxAge]);
    //         }

    //         // Finalizing the query
    //         $topSkills = $topSkillsQuery->groupBy('master_it_skills.name')
    //             ->orderByDesc('user_count')
    //             ->take(5)
    //             ->get();




    //         $topCities = User::query()->where('is_admin', 0)->where('company_id', $company_id)->where('role_id', 1);

    //         if ($request->has('gender') && $request->gender != '') {
    //             $topCities = $topCities->where('gender', '=', $request->gender);
    //         }

    //         if ($request->has('department_id') && $request->department_id != '') {
    //             $topCities = $topCities->where('department_id', '=', $request->department_id);
    //         }

    //         if ($request->has('age') && $request->age != '') {
    //             $ageRange = $request->age;
    //             list(
    //                 $minAge, $maxAge
    //             ) = explode('_', $ageRange);
    //             // Use Eloquent to filter users within the age range

    //             $topCities = $topCities->whereBetween('age', [$minAge, $maxAge]);
    //         }

    //         $topCities = $topCities->select(DB::raw("COALESCE(NULLIF(city, ''), 'Other') as city"), DB::raw('COUNT(*) as user_count'))
    //             ->groupBy('city')
    //             ->orderByDesc('user_count')
    //             ->take(10)
    //             ->get()
    //             ->pluck('user_count', 'city');




    //         if ($topCities->count() < 10) {
    //             $existingCityNames = $topCities->keys()->filter(function ($name) {
    //                 return $name !== 'Other'; // Exclude 'Other' from existing city names
    //             });

    //             $additionalCities = MasterCity::whereNotIn('name', $existingCityNames)
    //                 ->where('name', '<>', '') // Ensure the city is not empty
    //                 ->select('name as city')
    //                 ->take(10 - $topCities->count())
    //                 ->pluck('city');

    //             $additionalCities = $additionalCities->mapWithKeys(function ($cityName) {
    //                 return [$cityName => 0]; // Assign 0 as the user_count for additional cities
    //             });

    //             $topCities = $topCities->merge($additionalCities);
    //         }

    //         $transformedData = collect($topCities->toArray())->map(function ($count, $city) {
    //             return ['x' => $city, 'y' => $count];
    //         })->values()->all();


    //         $usersMale = User::query();

    //         $usersFeMale = User::query();

    //         $poolOneCount = 0;

    //         $users = User::query();

    //         $users = $users->where('is_admin', '=', 0)->where('company_id', $company_id)->where('role_id', 1);

    //         $usersMale = $usersMale->where('is_admin', '=', 0)->where('company_id', $company_id)->where('role_id', 1);

    //         $usersFeMale = $usersFeMale->where('is_admin', '=', 0)->where('company_id', $company_id)->where('role_id', 1);


    //         if ($request->has('gender') && $request->gender != '') {
    //             $users = $users->where('gender', '=', $request->gender);
    //             $usersMale = $usersMale->where('gender', '=', $request->gender);
    //             $usersFeMale = $usersFeMale->where('gender', '=', $request->gender);
    //             $gender = $request->gender;
    //         }

    //         if ($request->has('age') && $request->age != '') {
    //             $ageRange = $request->age;
    //             list(
    //                 $minAge, $maxAge
    //             ) = explode('_', $ageRange);
    //             // Use Eloquent to filter users within the age range

    //             $users = $users->whereBetween('age', [$minAge, $maxAge]);
    //             $usersMale = $usersMale->whereBetween('age', [$minAge, $maxAge]);
    //             $usersFeMale = $usersFeMale->whereBetween('age', [$minAge, $maxAge]);
    //         }

    //         if ($request->has('department_id') && $request->department_id != '') {
    //             $users = $users->where('department_id', '=', $request->department_id);
    //             $usersMale = $usersMale->where('department_id', '=', $request->department_id);
    //             $usersFeMale = $usersFeMale->where('department_id', '=', $request->department_id);
    //         }


    //         $registeredUsersCount = $users->count();

    //         $assessmentGivenUsers = $users->where('is_personality_motivation_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_cognitive_ability_completed', '=', 1)->count();

    //         $oceanAssessmentGivenUsers = $users->where('is_personality_motivation_completed', '=', 1)->count();

    //         $cognitiveAssessmentGivenUsers = $users->where('is_cognitive_ability_completed', '=', 1)->count();

    //         $interestAssessmentGivenUsers = $users->where('is_work_interest_completed', '=', 1)->count();

    //         $maleUsers = $usersMale->where('gender', '=', 0)->count();

    //         $femaleUsers = $usersFeMale->where('gender', '=', 1)->count();

    //         $setting = Setting::where('user_id', $company_id)->first();

    //         $poolUsers = [0 => 0, 1 => 0, 2 => 0];

    //         $poolCounts = $users->select('pool', DB::raw('count(*) as user_count'))
    //             ->whereIn('pool', [1, 2, 3])
    //             ->groupBy('pool')
    //             ->orderBy(
    //                 'pool',
    //                 'asc'
    //             ) // Ensure the results are ordered by pool
    //             ->get();

    //         // $settingsByPool = ['Pool 1(' . $setting->pool_one - 1 . '%)', 'Pool 2(' . $setting->pool_two - 1 . '%)', 'Pool 3(' . $setting->pool_three . '%)'];
    //         $settingsByPool = ['Pool 1 (High Rank Talent)', 'Pool 2 (Medium Rank Talent)', 'Pool 3 (Low Rank Talent)'];


    //         foreach ($poolCounts as $key => $poolCount) {
    //             $poolUsers[$poolCount['pool'] - 1] = $poolCount['user_count'];
    //         }

    //         $departmentsMain = Department::where('company_id', $company_id)->get();


    //         $subquery = User::where('company_id',$company_id)->where('role_id',1);


    //         if ($request->has('gender') && $request->gender != '') {
    //             $subquery->where('gender', '=', $request->gender);
    //         }

    //         if ($request->has('age') && $request->age != '') {
    //             $ageRange = $request->age;
    //             list(
    //                 $minAge, $maxAge
    //             ) = explode('_', $ageRange);
    //             // Use Eloquent to filter users within the age range

    //             $subquery->whereBetween('age', [$minAge, $maxAge]);

    //         }

    //         if ($request->has('department_id') && $request->department_id != '') {
    //             $subquery->where('department_id', '=', $request->department_id);
    //         }



    //         //Tenure Users
    //         $tenureUsers = [];

    //         $subquery = $subquery->yearsSinceCreation();

    //         $userExperience = DB::table(DB::raw("({$subquery->toSql()}) as sub"))
    //             ->mergeBindings($subquery->getQuery())
    //             ->select(
    //                 DB::raw('CASE
    //                             WHEN sub.years_since_created < 1 THEN "< 1 year"
    //                             WHEN sub.years_since_created >= 2 AND sub.years_since_created <= 3 THEN "2-3"
    //                             WHEN sub.years_since_created >= 4 AND sub.years_since_created <= 5 THEN "4-5"
    //                             WHEN sub.years_since_created >= 6 AND sub.years_since_created < 8 THEN "6-8"
    //                             ELSE "> 8 year"
    //                          END as duration'),
    //                 DB::raw('COUNT(*) as user_count')
    //             )
    //             ->groupBy('duration')
    //             ->orderBy('duration')
    //             ->get()->toArray();
            
    //         foreach ($userExperience as $expKey => $expValue) {
    //             $tenureUsers[$expValue->duration] = $expValue->user_count;
    //         }   
            
    //         $ageCountsQuery = User::query();

    //         $ageCountsQuery->where('company_id',$company_id)->where('role_id',1);

    //         if ($request->has('gender') && $request->gender != '') {
    //             $ageCountsQuery->where('gender', '=', $request->gender);
    //         }

    //         if ($request->has('age') && $request->age != '') {
    //             $ageRange = $request->age;
    //             list(
    //                 $minAge, $maxAge
    //             ) = explode('_', $ageRange);
    //             // Use Eloquent to filter users within the age range

    //             $ageCountsQuery->whereBetween('age', [$minAge, $maxAge]);

    //         }

    //         if ($request->has('department_id') && $request->department_id != '') {
    //             $ageCountsQuery->where('department_id', '=', $request->department_id);
    //         }


    //         // $ageCountsQuery = $ageCountsQuery->selectRaw('
    //         // COUNT(CASE WHEN age BETWEEN 15 AND 20 THEN 1 END) as age_15_20,
    //         // COUNT(CASE WHEN age BETWEEN 20 AND 25 THEN 1 END) as age_20_25,
    //         // COUNT(CASE WHEN age BETWEEN 25 AND 30 THEN 1 END) as age_25_30,
    //         // COUNT(CASE WHEN age BETWEEN 30 AND 35 THEN 1 END) as age_30_35,
    //         // COUNT(CASE WHEN age BETWEEN 35 AND 40 THEN 1 END) as age_35_40,
    //         // COUNT(CASE WHEN age BETWEEN 40 AND 150 THEN 1 END) as age_40_plus
    //         // ')->first()->toArray();
    //         $ageCountsQuery = $ageCountsQuery->selectRaw('
    //             COUNT(CASE WHEN age BETWEEN 15 AND 20 THEN 1 END) as age_15_20,
    //             COUNT(CASE WHEN age BETWEEN 21 AND 25 THEN 1 END) as age_20_25,
    //             COUNT(CASE WHEN age BETWEEN 26 AND 30 THEN 1 END) as age_25_30,
    //             COUNT(CASE WHEN age BETWEEN 31 AND 35 THEN 1 END) as age_30_35,
    //             COUNT(CASE WHEN age BETWEEN 36 AND 49 THEN 1 END) as age_35_40,
    //             COUNT(CASE WHEN age BETWEEN 40 AND 150 THEN 1 END) as age_40_plus
    //         ')->first()->toArray();
    //         // dd($ageCountsQuery);
    //         // dd(array_keys($positionWithUserCounts));
    //         $data = [
    //             'labels' => $settingsByPool,
    //             'data' => $poolUsers,
    //             'registeredUsersCount' => $registeredUsersCount,
    //             'oceanAssessmentGivenUsers' => $oceanAssessmentGivenUsers,
    //             'cognitiveAssessmentGivenUsers' => $cognitiveAssessmentGivenUsers,
    //             'interestAssessmentGivenUsers' => $interestAssessmentGivenUsers,
    //             'assessmentGivenUsers' => [$assessmentGivenUsers, $registeredUsersCount - $assessmentGivenUsers],
    //             'labels2' => array_keys($sectorsWithUserCounts),
    //             'data2' => array_values($sectorsWithUserCounts),
    //             'skill_labels' => $topSkills->pluck('name')->toArray(),
    //             'skill_data' => $topSkills->pluck('user_count')->toArray(),
    //             'cities' => $transformedData,
    //             'maleUsers' => $maleUsers,
    //             'femaleUsers' => $femaleUsers,
    //             'positionKeys' => array_keys($positionWithUserCounts),
    //             'positionValues' => array_values($positionWithUserCounts),
    //             'userDepartmentsKeys' => array_keys($userDepartmentsCounts),
    //             'userDepartmentsValues' => array_values($userDepartmentsCounts),
    //             'departmentsMain' => $departmentsMain,
    //             'tenureUsersKeys' => array_keys($tenureUsers),
    //             'tenureUsersValues' => array_values($tenureUsers),
    //             'ageCountsQuery' => array_values($ageCountsQuery)
    //         ];

    //         return view('admin.dashboard', $data);
    //     }
    // }


    // public function dashboard(Request $request)
    // {
    //     if ((config('client.' . env('APP_BRANCH') . '.admin_dashboard')) && auth()->user()->role_id == 2) {
    //         return redirect('/admin/jobs/index?saved_job=1');
    //     }

    //     if (auth()->user()->role_id == 7) {
    //         // return redirect("/admin/company/sector-skills?tab=joblevel");
    //         return redirect('/admin/jobs/index?saved_job=1');
    //     }elseif (auth()->user()->role_id == 12) {
    //         return redirect()->route('admin.jobDashboard.index');
    //     }
    //     elseif (auth()->user()->role_id == 11) {
    //         return redirect()->route('admin.employee.users.manager');
    //     }
        
    //     $departmentsMain = Department::where('company_id', 3)->get();

    //     return view('admin.dashboard', compact('departmentsMain'));
    // }

       public function dashboard() {

   
        $employee_id = auth()->user()->id;
        
        $data = [];
        // Assume $data contains report data; fetch or generate as needed
        $responseData = [];
        $user = User::find($employee_id);
        $user_id = $employee_id;
        $results = UserResult::where('user_id', $user_id)->get();

        $responseData['employee'] = $user;
        $descriptors = DB::table('master_descriptors')->where('user_type', 'employee')->get();

        if (!$results->isEmpty()) {
            $isUserResultExists = 1;
        } else {
            $isUserResultExists = 0;
        }

        $responseData = array_merge($responseData, ['isUserResultExists' => $isUserResultExists]);
        
        if($isUserResultExists) {
            $total_correct = QuizDomainValueAnswer::where('user_id', $user_id)->where('quiz_domain_value_question_id', '>', 376)->where('is_correct', 1)->count();
            $responseData = array_merge($responseData, ['totalCorrectForCognitive' => $total_correct]);
            
            $oceanDomainResults = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'domains','employee',$descriptors);
            $responseData = array_merge($responseData, ['oceanDomainResult' => $oceanDomainResults]);

            $oceanAllFacetsResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'all_facets','employee',$descriptors);
            $responseData = array_merge($responseData, ['oceanAllFacetsResult' => $oceanAllFacetsResult]);
        
            $riasecDomainResult = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'domains','employee',$descriptors);
            $responseData = array_merge($responseData, ['riasecDomainResult' => $riasecDomainResult]);

            $riasecTop3Results = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'top_3_riasec');

            $riasecTop3Result['string'] = $riasecTop3Results['top-3-riasec']['level_description'] ?? '';
            $riasecTop3Result['array'] = str_split($riasecTop3Result['string']) ?? [];
            $riasecTop3Result['job_top_3_riasec'] = $user->position->top3riasec ?? '';
            $riasecTop3Result['job_top_3_riasec_array'] = str_split($user->position->top3riasec ?? '') ?? [];
            $riasecTop3Result['description'] = $riasecTop3Results['top-3-riasec']['description'] ?? '';
            $responseData = array_merge($responseData, ['riasecTop3Result' => $riasecTop3Result]);

            $ccsResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'ccs','employee',$descriptors);

            $jobSkills = $user->position->skills ?? [];
            
            $jobSkillsArray = [];
            $jobSkillsLevelArray = [];
            foreach ($jobSkills as $skill) {
                $jobSkillsArray[] = $skill->title;
                $jobSkillsLevelArray[$skill->title] = $skill->level;
            }

            $jobCcsResult = [];
            $ccsResult = $ccsResult->filter(function ($result) use ($jobSkillsArray, $jobSkillsLevelArray, &$jobCcsResult) {
                // $result['is_job_required_skill'] = in_array($result['name'], $jobSkillsArray) ? 1 : 0;
                if (in_array($result['name'], $jobSkillsArray)) {
                    // Add the current result to $jobCcsResult
                    $result['required_level'] = $jobSkillsLevelArray[$result['name']];
                    $jobCcsResult[$result['slug']] = $result;
                    
                    // return false; // Remove it from $ccsResult
                }
            
                return true; // Keep it in $ccsResult
            });

            // Sort by score descending
            $ccsResult = $ccsResult->sortByDesc('score')->values();
            $responseData = array_merge($responseData, ['ccsResult' => $ccsResult]);

            $jobCcsResult = $ccsResult->sortByDesc('score')->values();
            $responseData = array_merge($responseData, ['jobCcsResult' => $jobCcsResult]);

            // $allStarResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'all_star','employee',$descriptors);
            // $responseData = array_merge($responseData, ['allStarResult' => $allStarResult]);

            // $personalityTypeResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'personality_type','employee',$descriptors);
            // foreach ($personalityTypeResult as $name => $result) {
            //     $personalityTypeResponseResult['name'] = $result['name'] ?? '';
            //     $personalityTypeResponseResult['description'] = $result['level_description'] ?? '';
            // }
            // $responseData = array_merge($responseData, ['personalityTypeResult' => $personalityTypeResponseResult]);
            
            $flightRiskResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'flight_risk','employee',$descriptors);
            $responseData = array_merge($responseData, ['flightRiskResult' => $flightRiskResult]);

            $organizationalFitForecastResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'organizational_fit_forecast','employee',$descriptors);
            $responseData = array_merge($responseData, ['organizationalFitForecastResult' => $organizationalFitForecastResult]);

            $growthPotentialResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'growth_potential','employee',$descriptors);
            $responseData = array_merge($responseData, ['growthPotentialResult' => $growthPotentialResult]);

            $rciResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'rci','employee',$descriptors);
            $responseData = array_merge($responseData, ['rciResult' => $rciResult]);

            $oceanSelfResult = [];

            $oceanSelfResult['Openness to Experience'] = $oceanDomainResults['openness-to-experience']['score'] ?? 0;
            $oceanSelfResult['Conscientiousness'] = $oceanDomainResults['conscientiousness']['score'] ?? 0;
            $oceanSelfResult['Extraversion'] = $oceanDomainResults['extraversion']['score'] ?? 0;
            $oceanSelfResult['Agreeableness'] = $oceanDomainResults['agreeableness']['score'] ?? 0;
            $oceanSelfResult['Emotional Stability'] = $oceanDomainResults['emotional-stability']['score'] ?? 0;

            $learningStyle = AssessmentHelper::getLearningStyle($user_id,$oceanSelfResult);
            $responseData = array_merge($responseData, ['learningStyle' => $learningStyle]);

            $overAllMatchRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'all', 'overall_match_rate','employee',$descriptors);
            $responseData = array_merge($responseData, ['overAllMatchRateResult' => $overAllMatchRateResult]);

            $behaviorFitRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'all', 'soft_skill_score','employee',$descriptors);
            $responseData = array_merge($responseData, ['behaviorFitRateResult' => $behaviorFitRateResult]);
            
            $technicalResult = NewAssessmentHelper::getFormattedUserResults($results, 'technical', 'overall','employee',$descriptors);
            $responseData = array_merge($responseData, ['technicalResult' => $technicalResult]);

            $softSkillMatchRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'ccs_match_rate','employee',$descriptors);
            $responseData = array_merge($responseData, ['softSkillMatchRateResult' => $softSkillMatchRateResult]);

            $jobMatchRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'jmr','employee',$descriptors);
            $responseData = array_merge($responseData, ['jobMatchRateResult' => $jobMatchRateResult]);

            $oceanDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'domains')->where('user_type', 'employee')->take(80)->get();      
            $responseData = array_merge($responseData, ['oceanDomainDescriptors' => $oceanDomainDescriptors]); 

            $oceanAllFacetsDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'all_facets')->where('user_type', 'employee')->get();      
            $responseData = array_merge($responseData, ['oceanAllFacetsDescriptors' => $oceanAllFacetsDescriptors]); 
        
            $riasecDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'riasec')->where('result_type', 'domains')->where('user_type', 'employee')->get();     
            $responseData = array_merge($responseData, ['riasecDomainDescriptors' => $riasecDomainDescriptors]); 

            $ccsDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'ccs')->whereNull('user_score_level')->orWhere('user_score_level', 0)->where('user_type', 'employee')->get();       
            $responseData = array_merge($responseData, ['ccsDomainDescriptors' => $ccsDomainDescriptors]); 

            $learningAndDevelopmentPlanDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'learning_and_development_plan')->where('user_type', 'employee')->get();     
            $responseData = array_merge($responseData, ['learningAndDevelopmentPlanDescriptors' => $learningAndDevelopmentPlanDescriptors]); 
        }

        // $allStarDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'all_star')->where('user_type', 'employee')->get();     
        // $responseData = array_merge($responseData, ['allStarDomainDescriptors' => $allStarDomainDescriptors]); 

        // dd($responseData, $oceanAllFacetsResult->keys());
        // View file that formats the report
        return view('admin.dashboard.psychometric', $responseData);
    }

    private function filteredUsers(Request $request)
    {
        if (auth()->user()->company_id) {
            $company_id = auth()->user()->company_id;
        } else {
            $company_id = 3;
        }
        $query = User::where('users.role_name', 'employee')->where('users.company_id', $company_id);

        if ($request->age) {
            [$min, $max] = explode('_', $request->age);
            $query->whereBetween('users.age', [$min, $max]);
        }

        if ($request->gender !== null && $request->gender !== '') {
            $query->where('users.gender', $request->gender);
        }

        if ($request->department_id) {
            $query->where('users.department_id', $request->department_id);
        }

        return $query;
    }

    public function chartData(Request $request, $chart)
    {
        $users = $this->filteredUsers($request);

        switch ($chart) {
            case 'headcount':
                $registeredUsersCount = $users->count();
                $maleUsers = (clone $users)->where('gender', 0)->count();
                $femaleUsers = (clone $users)->where('gender', 1)->count();
                $assessmentGivenUsers = [
                    (clone $users)
                        ->where('is_cognitive_ability_completed', '=', 1)
                        ->where('is_work_interest_completed', '=', 1)
                        ->where('is_personality_motivation_completed', '=', 1)
                        ->count(),
                
                    (clone $users)
                        ->where(function ($query) {
                            $query->where('is_cognitive_ability_completed', '=', 0)
                                  ->orWhere('is_work_interest_completed', '=', 0)
                                  ->orWhere('is_personality_motivation_completed', '=', 0);
                        })
                        ->count(),
                ];                
                return response()->json([
                    'registeredUsersCount' => $registeredUsersCount,
                    'maleUsers' => $maleUsers,
                    'femaleUsers' => $femaleUsers,
                    'assessmentGivenUsers' => $assessmentGivenUsers,
                ]);

            case 'tenure':
                $tenureGroups = [
                    '< 1 year'   => [null, 1],
                    '2-3'        => [2, 3],
                    '4-5'        => [4, 5],
                    '6-8'        => [6, 8],
                    '> 8 years'  => [8, null]
                ];
            
                $values = [];
                $keys = [];
            
                foreach ($tenureGroups as $label => [$min, $max]) {
                    $query = (clone $users)->whereNotNull('date_of_hire');
            
                    if ($min === null) {
                        // < 1 year: years < 1
                        $query->whereRaw("TIMESTAMPDIFF(YEAR, date_of_hire, CURDATE()) < ?", [$max]);
                    } elseif ($max === null) {
                        // > 8 years: years >= 8
                        $query->whereRaw("TIMESTAMPDIFF(YEAR, date_of_hire, CURDATE()) >= ?", [$min]);
                    } else {
                        // Range: min <= years <= max (both inclusive)
                        $query->whereRaw("TIMESTAMPDIFF(YEAR, date_of_hire, CURDATE()) >= ? 
                                            AND TIMESTAMPDIFF(YEAR, date_of_hire, CURDATE()) <= ?", [$min, $max]);
                    }
                    
                    $values[] = $query->count();
                    $keys[] = $label;
                }
                
                return response()->json(['keys' => $keys, 'values' => $values]);
                
                

                case 'age':
                    $ageGroups = [
                        '15-20' => [15, 20],
                        '21-25' => [21, 25],
                        '26-30' => [26, 30],
                        '31-35' => [31, 35],
                        '36-40' => [36, 40],
                        '40+' => [41, 150],
                    ];
                    $values = [];
                    foreach ($ageGroups as $range => [$min, $max]) {
                        $values[] = (clone $users)->whereBetween('age', [$min, $max])->count();
                    }
                    return response()->json(['values' => $values]);

            case 'city':
                // Get top 10 cities
                $topCities = $users->select(
                        DB::raw("COALESCE(NULLIF(users.city, ''), 'Other') as city"),
                        DB::raw('COUNT(*) as user_count')
                    )
                    ->groupBy('city')
                    ->orderByDesc('user_count')
                    ->take(10)
                    ->get()
                    ->pluck('user_count', 'city'); 
            
                // Fill missing if less than 10
                if ($topCities->count() < 10) {
                    $existingCityNames = $topCities->keys()->filter(fn($name) => $name !== 'Other');
            
                    $additionalCities = MasterCity::whereNotIn('name', $existingCityNames)
                        ->where('name', '<>', '')
                        ->select('name as city')
                        ->take(10 - $topCities->count())
                        ->pluck('city');
            
                    $additionalCities = $additionalCities->mapWithKeys(fn($cityName) => [$cityName => 0]);
            
                    $topCities = $topCities->merge($additionalCities);
                }
            
                return response()->json($topCities);
                
                
                
            case 'position':
                    $data = (clone $users) // keep applied filters
                        ->join('jobs', 'users.position_id', '=', 'jobs.id')
                        ->selectRaw('jobs.level as position, COUNT(*) as total')
                        ->groupBy('jobs.level')
                        ->pluck('total', 'position');
                
                    return response()->json($data);
                
                

            case 'department':
                $data = $users
                    ->join('departments', 'users.department_id', '=', 'departments.id')
                    ->selectRaw('departments.head_of_department as department, COUNT(*) as total')
                    ->groupBy('departments.head_of_department')
                    // ->orderByDesc('total')         
                    ->pluck('total', 'department');
            
                return response()->json($data);
                    
                
        }

        return response()->json([]);
    }
    // public function jobDescriptions(Request $request)
    // {
    //     $data = [];

    //     // $levels = ["Level 1" => 1, "Level 2" => 2, "Level 3" => 3, "Level 4" => 4, "Level 5" => 5, "Level 6" => 6, "Level 7" => 7, "Level 8" => 8];
    //     // Fetch levels from the config file
    //     $levels = config('levels');

    //     foreach ($levels as $key => $value) {
    //         $jobsQuery1 = Job::query('is_primary', 0)->orderBy('created_at', 'desc');


    //         if ($department = $request->query('department')) {
    //             $jobsQuery1->where('department_id', $department);
    //         }

    //         if ($org_department = $request->query('org_department')) {
    //             $jobsQuery1->where('org_department', $org_department);
    //         }

    //         $data[$value] = ["title" => $key, "count" => $jobsQuery1->where('level', $value)->count()];
    //     }

    //     $departments = Department::where('company_id', auth()->user()->id)->get();

    //     $masterSkills = MasterSkill::all();

    //     // Start the query builder for jobs
    //     $jobsQuery = Job::where('is_primary', 0)->orderBy('created_at', 'desc');

    //     // If there's a search term, filter jobs by name
    //     // if ($search = $request->query('search')) {
    //     //     $jobsQuery->where('title', 'like', '%' . $search . '%');
    //     // }

    //     if ($search = $request->query('search')) {
    //         $jobsQuery->where('department_id', $request->query('department_id'))->where('title', 'like', '%' . $search . '%');
    //     }

    //     if ($department = $request->query('department')) {
    //         $jobsQuery->where('department_id', $department);
    //     }

    //     if ($org_department = $request->query('org_department')) {
    //         $jobsQuery->where('org_department', $org_department);
    //     }

    //     if ($level = $request->query('level')) {
    //         $jobsQuery->where('level', $level);
    //     }


    //     // Get the filtered list of jobs
    //     $jobs = $jobsQuery->get();

    //     // Default to the first job if no specific job is selected
    //     $selectedJobId = $request->query('selected_job', optional($jobs->first())->id);

    //     // Find the job by the selectedJobId, defaulting to the first job if not found
    //     $selectedJob = $jobs->firstWhere('id', $selectedJobId) ?? $jobs->first();


    //     $employeesCount = 0;

    //     if ($selectedJob) {
    //         $employeesCount = $selectedJob->employees->count();
    //     }

    //     return view('admin.jd_dashboard_updated', compact('jobs', 'selectedJob', 'masterSkills', 'departments', 'levels', 'data','employeesCount'));
    // }

public function jobDescriptions(Request $request)
{
    $data = [];
 
    // Fetch levels from the config file
    $levels = config('levels');
 
    foreach ($levels as $key => $value) {
        // Start the query with the correct filter for is_primary = 1
        $jobsQuery1 = MasterJob::where('is_primary', 1)->orderBy('created_at', 'desc');
 
        if ($department = $request->query('department')) {
            $jobsQuery1->where('department_id', $department);
        }
 
        if ($org_department = $request->query('org_department')) {
            $jobsQuery1->where('org_department', $org_department);
        }
 
        $data[$value] = ["title" => $key, "count" => $jobsQuery1->where('level', $value)->count()];
    }
 
    $departments = Department::all();
 
    $masterSkills = MasterSkill::all();
 
    // Start the query builder for jobs with is_primary = 1
    $jobsQuery = MasterJob::where('is_primary', 1)->orderBy('created_at', 'desc');
 
    if ($search = $request->query('search')) {
        $jobsQuery->where('department_id', $request->query('department'))
            ->where('title', 'like', '%' . $search . '%');
    }
 
    if ($department = $request->query('department')) {
        $jobsQuery->where('department_id', $department);
    }
 
    if ($org_department = $request->query('org_department')) {
        $jobsQuery->where('org_department', $org_department);
    }
 
    if ($level = $request->query('level')) {
        $jobsQuery->where('level', $level);
    }
 
    // Get the filtered list of jobs
    $jobs = $jobsQuery->get();
 
    // Default to the first job if no specific job is selected
    $selectedJobId = $request->query('selected_job', optional($jobs->first())->id);
 
    // Find the job by the selectedJobId, defaulting to the first job if not found
    $selectedJob = $jobs->firstWhere('id', $selectedJobId) ?? $jobs->first();
 
    $employeesCount = 0;
 
    if ($selectedJob) {
        $employeesCount = $selectedJob?->employees?->count() ?? 0;
    }
 
    return view('admin.jd_dashboard_updated', compact('jobs', 'selectedJob', 'masterSkills', 'departments', 'levels', 'data', 'employeesCount'));
}



    public function jobDescriptionsSaved(Request $request)
    {
        $data = [];
        ini_set('memory_limit', '512M'); // Increase memory limit if necessary
        ini_set('max_execution_time', 600); // Increase execution time if necessary
        // $levels = ["Level 1" => 1, "Level 2" => 2, "Level 3" => 3, "Level 4" => 4, "Level 5" => 5, "Level 6" => 6, "Level 7" => 7, "Level 8" => 8];
        // Fetch levels from the config file
        $levels = config('levels');

        foreach ($levels as $key => $value) {
            $jobsQuery1 = Job::where('is_primary', 0)->orderBy('created_at', 'desc');


            if ($department = $request->query('department')) {
                $jobsQuery1->where('department_id', $department);
            }

            if ($org_department = $request->query('org_department')) {
                $jobsQuery1->where('department_id', $org_department);
            }

             if ($status = $request->query('status')) {
                $jobsQuery1->where('status', $status);
            }

            $data[$value] = ["title" => $key, "count" => $jobsQuery1->where('level', $value)->count()];
        }

        $departments = Department::where('company_id', auth()->user()->id)->get();

        $masterSkills = MasterSkill::all();

        // Start the query builder for jobs
        $jobsQuery = Job::where('is_primary', 0)->orderBy('created_at', 'desc');

        // If there's a search term, filter jobs by name
        // if ($search = $request->query('search')) {
        //     $jobsQuery->where('title', 'like', '%' . $search . '%');
        // }

        if ($search = $request->query('search')) {
            $jobsQuery->where('department_id', $request->query('org_department'))->where('title', 'like', '%' . $search . '%');
        }

        if ($department = $request->query('department')) {
            $jobsQuery->where('department_id', $department);
        }

         if ($status = $request->query('status')) {
            $jobsQuery->where('status', $status);
        }

        if ($org_department = $request->query('org_department')) {
            $jobsQuery->where('department_id', $org_department);
        }

        if ($level = $request->query('level')) {
            $jobsQuery->where('level', $level);
        }


        // Use chunk to prevent memory issues - process jobs in batches
        $jobs = collect();
        
        $jobsQuery->chunk(100, function ($jobChunk) use (&$jobs) {
            // Add each chunk to the collection, hiding expensive attributes
            foreach ($jobChunk as $job) {
                $job->makeHidden(['vacancy', 'job_full_title']);
                $jobs->push($job);
            }
        });

        // dd($jobs);
        // Default to the first job if no specific job is selected
        $selectedJobId = $request->query('selected_job', optional($jobs->first())->id);

        // Find the job by the selectedJobId, defaulting to the first job if not found
        $selectedJob = $jobs->firstWhere('id', $selectedJobId) ?? $jobs->first();


        $employeesCount = 0;

        if ($selectedJob) {
            // Simplified query to avoid memory issues
            $employeesCount = DB::table('job_headcounts')
                ->whereNotNull('user_id')
                ->where('job_id', $selectedJob->id)
                ->count();
        }
        // dd($employeesCount);

        return view('admin.jd.saved_jd_dashboard_updated', compact('jobs', 'selectedJob', 'masterSkills', 'departments', 'levels', 'data','employeesCount'));
    }

        public function jobDescriptionUpdateStatus(Request $request, $id) {
            $job = Job::find($id); 

    $jobProfile = JobProfile::find($job->job_profile_id);

    
    if ($jobProfile) {
        // Update the JobProfile description instead of Job's description
        $jobProfile->description = $job->description;
        $jobProfile->save();
    }
            $job->status = 1;
            $job->save();

            $message = 'Success! ' . $job->title . ' approved successfully.';

            session()->flash('alert', ['type' => 'success', 'message' => $message]);

            return redirect()->back()->with('success', 'Job Approved Successfully');
        }

    public function analytical_dashboard(Request $request)
    {
        $data = [];
        $departments = Department::where('status',1)->whereNotNull('division_id')->get();
        $data = array_merge($data, ['departments' => $departments]);

        // Department filter
        $departmentId = $request->get('department');
        $data = array_merge($data, ['departmentId' => $departmentId]);
        $companyId = auth()->user()->id;

        if($request->has('report') && $request->report == 'talent_management'){
            // return redirect('/admin/talent-management/dashboard');
            // Average Age by Department
        $averageAgeByDept = User::join('departments', 'users.department_id', '=', 'departments.id')
        ->select('departments.name as department_name', DB::raw('AVG(TIMESTAMPDIFF(YEAR, birth_date, CURDATE())) as average_age'))
        ->where('users.company_id', $companyId)
        ->where('users.role_name', 'employee')
        ->when($departmentId, function ($query) use ($departmentId) {
            return $query->where('users.department_id', $departmentId);
        })
        ->groupBy('departments.name')
        ->pluck('average_age', 'department_name')
        ->toArray();
    $data = array_merge($data, ['averageAgeByDept' => $averageAgeByDept]);

    // Gender Distribution by Department
    $genderByDept = User::select('users.gender', DB::raw('COUNT(*) as total'))
        ->where('users.company_id', $companyId)
        ->where('users.role_name', 'employee')
        ->when($departmentId, function ($query) use ($departmentId) {
            return $query->where('users.department_id', $departmentId);
        })
        ->groupBy('users.gender')
        ->pluck('total', 'users.gender')
        ->toArray();
    $data = array_merge($data, ['genderByDept' => $genderByDept]);

    // Employee Education by Department
    $educationByDept = User::join('master_education_levels', 'users.education_level', '=', 'master_education_levels.id')
                    ->select('master_education_levels.name as education_level_name', DB::raw('COUNT(*) as total'))
                    ->where('users.company_id', $companyId)
                    ->where('users.role_name', 'employee')
                    ->when($departmentId, function ($query) use ($departmentId) {
                        return $query->where('users.department_id', $departmentId);
                    })
                    ->groupBy('master_education_levels.name')
                    ->pluck('total', 'education_level_name')
                    ->toArray();

    $data = array_merge($data, ['educationByDept' => $educationByDept]);

    // Average OCEAN Score by Department
    $averageOceanScoreByDept = DB::table('quiz_domain_value_answers')
        ->join('quiz_domain_value_questions', 'quiz_domain_value_answers.quiz_domain_value_question_id', '=', 'quiz_domain_value_questions.id')
        ->join('quiz_domain_values', 'quiz_domain_value_questions.quiz_domain_value_id', '=', 'quiz_domain_values.id')
        ->join('users', 'quiz_domain_value_answers.user_id', '=', 'users.id')
        ->where('quiz_domain_values.id', '>', 24)
        ->where('quiz_domain_values.id', '<=', 29)
        ->where('users.company_id', $companyId)
        ->where('users.role_name', 'employee')
        ->when($departmentId, function ($query) use ($departmentId) {
            return $query->where('users.department_id', $departmentId);
        })
        ->select('quiz_domain_values.title as name')
        ->selectRaw('(COUNT(quiz_domain_value_answers.user_id) / 24) as user_count')
        ->selectRaw('ROUND((SUM(quiz_domain_value_answers.answer) / ((COUNT(quiz_domain_value_answers.user_id) / 24) * 120)) * 5, 2) as answer_avg_population')
        ->groupBy('quiz_domain_values.title')
        ->pluck('answer_avg_population', 'name')
        ->toArray();
    $data = array_merge($data, ['averageOceanScoreByDept' => $averageOceanScoreByDept]);

    // Top 3 RIASEC Scores by Department
    $riasecScoresByDept = User::select('users.riasec_code_one', 'users.riasec_code_two', 'users.riasec_code_three', DB::raw('COUNT(*) as total'))
        ->where('users.company_id', $companyId)
        ->where('users.role_name', 'employee')
        ->when($departmentId, function ($query) use ($departmentId) {
            return $query->where('users.department_id', $departmentId);
        })
        ->groupBy('users.riasec_code_one', 'users.riasec_code_two', 'users.riasec_code_three')
        ->pluck('total', 'riasec_code_one', 'riasec_code_two', 'riasec_code_three')
        ->toArray();
    $data = array_merge($data, ['riasecScoresByDept' => $riasecScoresByDept]);

    // Flight Risk Levels by Department
    $flightRiskByDept = User::select('users.flight_risk_level', DB::raw('COUNT(*) as total'))
        ->where('users.company_id', $companyId)
        ->where('users.role_name', 'employee')
        ->whereNotNull('flight_risk_level')
        ->when($departmentId, function ($query) use ($departmentId) {
            return $query->where('users.department_id', $departmentId);
        })
        ->groupBy('users.flight_risk_level')
        ->pluck('total', 'flight_risk_level')
        ->toArray();
    $data = array_merge($data, ['flightRiskByDept' => $flightRiskByDept]);

    // Organization Fit Level per Department
    $orgFitByDept = User::select('users.organizational_fit_forecast', DB::raw('COUNT(*) as total'))
        ->where('users.company_id', $companyId)
        ->where('users.role_name', 'employee')
        ->whereNotNull('organizational_fit_forecast')
        ->when($departmentId, function ($query) use ($departmentId) {
            return $query->where('users.department_id', $departmentId);
        })
        ->groupBy('users.organizational_fit_forecast')
        ->pluck('total', 'organizational_fit_forecast')
        ->toArray();
    $data = array_merge($data, ['orgFitByDept' => $orgFitByDept]);

    // Average Technical Score Across Departments
    $averageTechScoreByDept = User::join('departments', 'users.department_id', '=', 'departments.id')
        ->select('departments.name as department_name', DB::raw('AVG(users.tech_skill_score) as average_tech_score'))
        ->where('users.company_id', $companyId)
        ->where('users.role_name', 'employee')
        ->when($departmentId, function ($query) use ($departmentId) {
            return $query->where('users.department_id', $departmentId);
        })
        ->groupBy('departments.name')
        ->pluck('average_tech_score', 'department_name')
        ->toArray();
    $data = array_merge($data, ['averageTechScoreByDept' => $averageTechScoreByDept]);

    return view('admin.analytical_dashboard.talent_management', $data);
        } else {
        
            
            // Recruitment Funnel Data 
            $applicationStatus = config('helpers.application_status');

            $statusCounts = JobOpeningApplication::select('status', \DB::raw('count(*) as total'))
                            ->when($departmentId, function ($query) use ($departmentId) {
                                return $query->whereHas('jobOpening', function ($q) use ($departmentId) {
                                    $q->where('department_id', $departmentId);
                                });
                            })
                            ->whereHas('jobOpening', function ($q) use ($companyId) {
                                $q->where('company_id', $companyId);
                            })
                            ->groupBy('status')
                            ->pluck('total', 'status');


            // Prepare the result array
            $jobOpeningStatusWiseCounts = [];

            // Add the total count at the 0 index
            $jobOpeningStatusWiseCounts[0] = $statusCounts->sum();

            foreach ($applicationStatus as $key => $label) {
                $jobOpeningStatusWiseCounts[$key] = $statusCounts->get($key, 0);
            }
            
            $data = array_merge($data, ['jobOpeningStatusWiseCounts' => $jobOpeningStatusWiseCounts]);

            // Aggregated Data 
            $aggregatedData['total_number_of_applications'] = $jobOpeningStatusWiseCounts[0];
            
            $totalJobOpening = JobOpening::where('job_openings.company_id', $companyId)->when($departmentId, function ($query) use ($departmentId) {
                return $query->where('department_id', $departmentId);
            })->count();
            $aggregatedData['total_number_of_job_opening'] = $totalJobOpening;

            // Fetch the job opening ID, created_at date, and offer_accepted_date in a single query
            $results = DB::table('job_opening_applications')
                ->join('job_openings', 'job_opening_applications.job_opening_id', '=', 'job_openings.id')
                ->when($departmentId, function ($query) use ($departmentId) {
                    return $query->where('job_openings.department_id', $departmentId);
                })
                ->where('job_openings.company_id', $companyId)
                ->where('job_opening_applications.status', 8)
                ->select('job_openings.id', 'job_openings.created_at as job_created_at', 'job_opening_applications.offer_accepted_date')
                ->get();

            // Calculate the differences in days and store them
            $differences = $results->map(function ($result) {
                return Carbon::parse($result->offer_accepted_date)->diffInDays(Carbon::parse($result->job_created_at));
            });
            
            // Calculate the overall average difference
            $overallAverage = $differences->average();
            $aggregatedData['average_time_to_fill'] = round($overallAverage) . " Days";
            $data = array_merge($data, ['aggregatedData' => $aggregatedData]);

            // Data for charts (Applicants by Subs/Dept, Open Position by Subs/Dept, etc.)

            $positionsKeys = JobOpening::join('departments', 'job_openings.department_id', '=', 'departments.id')
            ->select('departments.name', DB::raw('count(*) as total'))
            ->where('job_openings.company_id', $companyId)  // Add company_id filter
            ->when($departmentId, function ($query) use ($departmentId) {
                return $query->where('job_openings.department_id', $departmentId);
            })
            ->groupBy('departments.name')
            ->pluck('total', 'departments.name')
            ->keys()
            ->toArray();

            $applicantsByDept = JobOpeningApplication::join('job_openings', 'job_opening_applications.job_opening_id', '=', 'job_openings.id')
            ->join('departments', 'job_openings.department_id', '=', 'departments.id')
            ->select('departments.name', DB::raw('count(*) as total'))
            ->where('job_openings.company_id', $companyId)  // Add company_id filter within the join
            ->when($departmentId, function ($query) use ($departmentId) {
                return $query->where('job_openings.department_id', $departmentId);
            })
            ->groupBy('departments.name')
            ->pluck('total', 'departments.name')
            ->toArray();

            $openPositionByDept = JobOpening::join('departments', 'job_openings.department_id', '=', 'departments.id')
            ->select('departments.name', DB::raw('count(*) as total'))
            ->where('job_openings.company_id', $companyId)  // Add company_id filter
            ->when($departmentId, function ($query) use ($departmentId) {
                return $query->where('job_openings.department_id', $departmentId);
            })
            ->groupBy('departments.name')
            ->pluck('total', 'departments.name')
            ->toArray();

            $avgTimeToFillByDept = DB::table('job_opening_applications')
            ->join('job_openings', 'job_opening_applications.job_opening_id', '=', 'job_openings.id')
            ->join('departments', 'job_openings.department_id', '=', 'departments.id')
            ->where('job_opening_applications.status', 8)
            ->where('job_openings.company_id', $companyId)  // Correctly filter by company_id
            ->when($departmentId, function ($query) use ($departmentId) {
                return $query->where('job_openings.department_id', $departmentId);
            })
            ->select('departments.name', DB::raw('AVG(DATEDIFF(offer_accepted_date, job_openings.created_at)) as avg_days'))
            ->groupBy('departments.name')
            ->pluck('avg_days', 'departments.name')
            ->toArray();

            

            // Merge additional chart data
            $data = array_merge($data, [
                'positionsKeys' => $positionsKeys,
                'applicantsByDept' => $applicantsByDept,
                'openPositionByDept' => $openPositionByDept,
                'avgTimeToFillByDept' => $avgTimeToFillByDept,
            ]);
        
            return view('admin.analytical_dashboard.talent_acquisition', $data);
        }

        
    }


    public function reportPool($allUserData)
    {
        $usersPercentage = [];
        $educationLevelData = [];

        $setting = Setting::where('user_id', auth()->user()->id)->first();

        $users = $allUserData;

        $users = $users->where('is_admin', '=', 0)->where('is_cognitive_ability_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_personality_motivation_completed', '=', 1);

        $usersData = $users->get();

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

                if ($workInterestResult && $workInterestResult->overall_percentage != null) {
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
        }

        return $usersPercentage;
    }

    public function searchGeneric(Request $request)
        {
            $query = $request->get('q', '');
            $skills = MasterSkill::where('name', 'like', '%' . $query . '%')
                        ->orderBy('name')
                        ->limit(20)
                        ->get(['id', 'name']);
            return response()->json($skills);
        }



    public function showGeneric($id)
        {
            $techSkill = MasterSkill::where('id', $id)->first();
            if ($techSkill) {
                $skill = $techSkill->toArray();
       
                return response()->json($skill);
            } else {
                return response()->json(null, 404);
            }
        }
     




    public function detailed(Request $request)
    {

        $population = '';
        if ($request->has('from') || $request->has('to') || $request->has('gender') || $request->has('scopestudy') || $request->has('yearstudy')) {

            $population =  $this->filterDetailed($request);
        }

        $year_study_api = env('MYNEXT_URL') . '/api/master/year-of-studies/';
        $yos = $this->getapidata($year_study_api);



        $scope_study_api = env('MYNEXT_URL') . '/api/master/scope-of-studies/';
        $sos = $this->getapidata($scope_study_api);

        $base_url =  env('MYNEXT_URL') . "/api/dashboard/university/analytical/demographic/total-students-cognitive?page_size=1000";
        $url = $request->query('url') ?? $base_url;

        if (isset($population) &&  $population != null) {

            $table = $population;
        } else {
            $table = $this->DetailedTable($url);
        }

        $data = [
            'yearstudy' => $yos,
            'scopestudy' => $sos,
            'population' => $population,
            'table' => $table
        ];
        return view('admin.reports.detailed', $data);
    }

    public function population(Request $request)
    {

        $population = '';
        if ($request->has('from') || $request->has('to') || $request->has('gender') || $request->has('scopestudy') || $request->has('yearstudy')) {

            $population =  $this->filterPopulation($request);
        }

        $year_study_api = env('MYNEXT_URL') . '/api/master/year-of-studies/';
        $yos = $this->getapidata($year_study_api);

        $scope_study_api = env('MYNEXT_URL') . '/api/master/scope-of-studies/';
        $sos = $this->getapidata($scope_study_api);

        $base_url =  env('MYNEXT_URL') . "/api/dashboard/university/analytical/demographic/total-questions-cognitive?page_size=100";
        $url = $request->query('url') ?? $base_url;

        $table = $this->populationTable($url);


        $data = [
            'yearstudy' => $yos,
            'scopestudy' => $sos,
            'population' => $population,
            'table' => $table
        ];
        return view('admin.reports.population', $data);
    }

    public function individual(Request $request)
    {

        $base_url =  env('MYNEXT_URL') . "/api/dashboard/university/analytical/demographic/total-students-cognitive?page_size=10";
        $url = $request->query('url') ?? $base_url;

        #Old Code
        // $response = Http::get($url);

        #new Code
        $response = Http::withOptions(['verify' => false])->get($url);


        $data = $response->json(['data']);

        return view('admin.reports.individual', compact('data'));
    }

    public function individualDetail(Request $request, $userid)
    {



        $url = $request->query('url') ?? 'https://api-uat-mynext.cxsanalytics.com/api/dashboard/university/analytical/demographic/total-questions-by-user-cognitive?page_size=10&user_id=' . $userid;

        $response = Http::withOptions(['verify' => false])->get($url);

        $data = $response->json(['data']);
        return view('admin.reports.individualDetail', ['data' => $data]);
    }


    public function individualStudent(Request $request)
    {


        $page = $request->input('page', 1);
        $perPage = 10; // Number of records to show per page
        // Fetch data from the API using Laravel's HTTP client
        $api = env('MYNEXT_URL') . '/api/dashboard/university/analytical/demographic/total-students-cognitive?page_size=10&page=' . $page;

        $response = Http::withOptions(['verify' => false])->get($api);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Failed to fetch data from the API'], 500);
        }
    }

    public function getapidata($api)
    {
        $response = Http::withOptions(['verify' => false])->get($api);
        $data = json_decode($response->body());

        return $data;
    }

    public function filterDashboard($request)
    {

        $from = '';
        $to = '';

        if (isset($request->from)) {
            $from = $this->dateFormat($request->from);
            $to = Carbon::now()->format('d-m-Y');
        }
        if (isset($request->to)) {
            $to = $this->dateFormat($request->to) ?? Carbon::now();
        }
        $gender = $request->gender ?? '';
        $yearstudy = $request->yearstudy ?? '';
        $scopestudy = $request->scopestudy ?? '';
        $setno = $request->set_no ?? '';


        $api = env('MYNEXT_URL') . '/api/dashboard/university/analytical/demographic/total-students-cognitive-counts?set_no=' . $setno . '&gender=' . $gender . '&year_of_study=' . $yearstudy . '&scope_of_study=' . $scopestudy . '&start_date=' . $from . '&end_date=' . $to;



        $response = Http::withOptions(['verify' => false])->get($api);

        $data = $response->json(['data'])['data'];
        return $data;
    }

    public function dateFormat($date)
    {
        $dateString = $date;
        $date = Carbon::createFromFormat('Y-m-d', $dateString);
        $formattedDate = $date->format('d-m-Y');
        return $formattedDate;
    }
    public function TableDashboard($url)
    {

        $response = Http::withOptions(['verify' => false])->get($url);

        $data = $response->json(['data'])['data'];

        return $data;
    }

    public function DetailedTable($url)
    {

        $response = Http::withOptions(['verify' => false])->get($url);

        $data = $response->json()['data'];

        return $data;
    }


    public function ocean(Request $request)
    {

        $population = '';
        if ($request->has('from') || $request->has('to') || $request->has('gender') || $request->has('scopestudy') || $request->has('yearstudy')) {

            $population =  $this->filterDetailed($request);
        }

        $year_study_api = env('MYNEXT_URL') . '/api/master/year-of-studies/';
        $yos = $this->getapidata($year_study_api);



        $scope_study_api = env('MYNEXT_URL') . '/api/master/scope-of-studies/';
        $sos = $this->getapidata($scope_study_api);

        $base_url =  env('MYNEXT_URL') . "/api/dashboard/university/analytical/demographic/total-students-cognitive?page_size=10000";
        $url = $request->query('url') ?? $base_url;

        if (isset($population) &&  $population != null) {

            $table = $population;
        } else {
            $table = $this->DetailedTable($url);
        }

        $data = [
            'yearstudy' => $yos,
            'scopestudy' => $sos,
            'population' => $population,
            'table' => $table
        ];
        return view('admin.reports.detailedReport.ocean', $data);
    }

    public function riasec(Request $request)
    {

        $population = '';
        if ($request->has('from') || $request->has('to') || $request->has('gender') || $request->has('scopestudy') || $request->has('yearstudy')) {

            $population =  $this->filterDetailed($request);
        }

        $year_study_api = env('MYNEXT_URL') . '/api/master/year-of-studies/';
        $yos = $this->getapidata($year_study_api);



        $scope_study_api = env('MYNEXT_URL') . '/api/master/scope-of-studies/';
        $sos = $this->getapidata($scope_study_api);

        $base_url =  env('MYNEXT_URL') . "/api/dashboard/university/analytical/demographic/total-students-cognitive?page_size=10000";
        $url = $request->query('url') ?? $base_url;

        if (isset($population) &&  $population != null) {

            $table = $population;
        } else {
            $table = $this->DetailedTable($url);
        }

        $data = [
            'yearstudy' => $yos,
            'scopestudy' => $sos,
            'population' => $population,
            'table' => $table
        ];
        return view('admin.reports.detailedReport.riasec', $data);
    }

    public function english(Request $request)
    {

        $population = '';
        if ($request->has('from') || $request->has('to') || $request->has('gender') || $request->has('scopestudy') || $request->has('yearstudy')) {

            $population =  $this->filterDetailed($request);
        }

        $year_study_api = env('MYNEXT_URL') . '/api/master/year-of-studies/';
        $yos = $this->getapidata($year_study_api);



        $scope_study_api = env('MYNEXT_URL') . '/api/master/scope-of-studies/';
        $sos = $this->getapidata($scope_study_api);

        $base_url =  env('MYNEXT_URL') . "/api/dashboard/university/analytical/demographic/total-students-cognitive?page_size=10000";
        $url = $request->query('url') ?? $base_url;

        if (isset($population) &&  $population != null) {

            $table = $population;
        } else {
            $table = $this->DetailedTable($url);
        }

        $data = [
            'yearstudy' => $yos,
            'scopestudy' => $sos,
            'population' => $population,
            'table' => $table
        ];
        return view('admin.reports.detailedReport.english', $data);
    }

    public function all(Request $request)
    {

        $population = '';
        if ($request->has('from') || $request->has('to') || $request->has('gender') || $request->has('scopestudy') || $request->has('yearstudy')) {

            $population =  $this->filterDetailed($request);
        }

        $year_study_api = env('MYNEXT_URL') . '/api/master/year-of-studies/';
        $yos = $this->getapidata($year_study_api);



        $scope_study_api = env('MYNEXT_URL') . '/api/master/scope-of-studies/';
        $sos = $this->getapidata($scope_study_api);

        $base_url =  env('MYNEXT_URL') . "/api/dashboard/university/analytical/demographic/total-students-cognitive?page_size=10000";
        $url = $request->query('url') ?? $base_url;

        if (isset($population) &&  $population != null) {

            $table = $population;
        } else {
            $table = $this->DetailedTable($url);
        }

        $data = [
            'yearstudy' => $yos,
            'scopestudy' => $sos,
            'population' => $population,
            'table' => $table
        ];
        return view('admin.reports.detailedReport.all', $data);
    }

    public function filterDetailed($request)
    {

        $from = '';
        $to = '';

        if (isset($request->from)) {
            $from = $this->dateFormat($request->from);
            $to = Carbon::now()->format('d-m-Y');
        }
        if (isset($request->to)) {
            $to = $this->dateFormat($request->to) ?? Carbon::now();
        }
        $gender = $request->gender ?? '';
        $yearstudy = $request->yearstudy ?? '';
        $scopestudy = $request->scopestudy ?? '';
        $setno = $request->set_no ?? '';


        $api = env('MYNEXT_URL') . '/api/dashboard/university/analytical/demographic/total-students-cognitive?page_size=1000&set_no=' . $setno . '&gender=' . $gender . '&year_of_study=' . $yearstudy . '&scope_of_study=' . $scopestudy . '&start_date=' . $from . '&end_date=' . $to;



        $response = Http::withOptions(['verify' => false])->get($api);

        $data = $response->json()['data'];
        return $data;
    }

    // In your SkillController or a relevant controller
        public function getSkillLevel($skillName) {
            $masterSkill = MasterSkill::where('name', $skillName)->first();
           
            if ($masterSkill) {
               
                return response()->json([
                    'skill_name' => $masterSkill->name,
                    'level_1' => $masterSkill->level_1,
                    'level_1_ability' => $masterSkill->level_1_ability,
                    'level_1_knowledge' => $masterSkill->level_1_knowledge,

                    'level_2' => $masterSkill->level_2,
                    'level_2_ability' => $masterSkill->level_2_ability,
                    'level_2_knowledge' => $masterSkill->level_2_knowledge,


                    'level_3' => $masterSkill->level_3,
                    'level_3_ability' => $masterSkill->level_3_ability,
                    'level_3_knowledge' => $masterSkill->level_3_knowledge,
                ]);
            } else {
                return response()->json(null, 404);
            }
        }


        public function getTechSkillLevel($id) {

            $techSkill = MasterTechnicalSkill::where('id', $id)->first();
            $mastertechskill =  $techSkill->toarray();
      
           
            if ($mastertechskill) {
                $mastertechskill['category_name'] = $techSkill->category->title ?? $mastertechskill['category_name'] ?? null;
               
                return response()->json([
                    $mastertechskill
                ]);
            } else {
                return response()->json(null, 404);
            }
        }


        public function skillGap() {
            $data = [
                'currentEmployees' => 113,
                'skillsRepresented' => 345,
                'skillsUtilised' => ['percentage' => 82, 'utilised' => 273, 'total' => 345],
                'skillsProficient' => ['percentage' => 92, 'proficient' => 273, 'total' => 345],
                'proficiencyGaps' => [
                    ['name' => 'Airside Driving', 'level' => 'High', 'count' => '15/35'],
                    ['name' => 'Ground Support Operations', 'level' => 'Critical', 'count' => '5/17'],
                    ['name' => 'Innovation Management', 'level' => 'Medium', 'count' => '8/20'],
                    ['name' => 'Stakeholder Management', 'level' => 'High', 'count' => '25/33'],
                    ['name' => 'Technology Application', 'level' => 'Low', 'count' => '12/18'],
                ],
                'skillsForecast' => [
                    ['name' => 'Human Factors Management', 'demand' => 'High Demand', 'growth' => '+50%'],
                    ['name' => 'Innovation Management', 'demand' => 'High Demand', 'growth' => '+73%'],
                    ['name' => 'Process Improvement and Optimisation', 'demand' => 'In Demand', 'growth' => '+34%'],
                    ['name' => 'Manpower Planning', 'demand' => 'In Demand', 'growth' => '+25%'],
                ],
                'skillsGap' => [
                ['name' => 'Eylia Fariza Binti Hamzah', 'proficient' => 30, 'exceeds' => 30, 'below' => 32, 'not_proficient' => 21, 'projected' => 9],
                ['name' => 'Firdaus Daud', 'proficient' => 30, 'exceeds' => 30, 'below' => 32, 'not_proficient' => 21, 'projected' => 9],
                ['name' => 'Abbie Fariza Binti Hamzah', 'proficient' => 30, 'exceeds' => 30, 'below' => 32, 'not_proficient' => 21, 'projected' => 9],
                ['name' => 'Faiq Daud', 'proficient' => 30, 'exceeds' => 30, 'below' => 32, 'not_proficient' => 21, 'projected' => 9],
                ['name' => 'Aliya Fariza Binti Hamzah', 'proficient' => 30, 'exceeds' => 30, 'below' => 32, 'not_proficient' => 21, 'projected' => 9],
                ['name' => 'Faye Daud', 'proficient' => 30, 'exceeds' => 30, 'below' => 32, 'not_proficient' => 21, 'projected' => 9],
                ],
                'projectedSkills' => [
                    [
                        'name' => 'Human Factors Management',
                        'currentDemand' => 10,
                        'projectedDemand' => 15,
                        'growthRate' => '+50%',
                        'currentSkillAvailability' => 108,
                        'skillGapForecast' => '5 positions',
                        'urgency' => 'Low',
                    ],
                    [
                        'name' => 'Innovation Management',
                        'currentDemand' => 10,
                        'projectedDemand' => 15,
                        'growthRate' => '+32%',
                        'currentSkillAvailability' => 24,
                        'skillGapForecast' => '5 positions',
                        'urgency' => 'High',
                    ],
                ],
            ];
        
             // Simulated data for individuals
             $individualData = [
                ['name' => 'Eylia Fariza Binti Hamzah', 'proficient' => 30, 'exceeds' => 30, 'below' => 32, 'not_proficient' => 21, 'projected' => 9],
                ['name' => 'Firdaus Daud', 'proficient' => 30, 'exceeds' => 30, 'below' => 32, 'not_proficient' => 21, 'projected' => 9],
                ['name' => 'Abbie Fariza Binti Hamzah', 'proficient' => 35, 'exceeds' => 40, 'below' => 25, 'not_proficient' => 20, 'projected' => 8],
                ['name' => 'Aliya Fariza Binti Hamzah', 'proficient' => 40, 'exceeds' => 20, 'below' => 30, 'not_proficient' => 15, 'projected' => 10],
                ['name' => 'Faiq Daud', 'proficient' => 25, 'exceeds' => 35, 'below' => 30, 'not_proficient' => 18, 'projected' => 12],
                ['name' => 'Faye Daud', 'proficient' => 30, 'exceeds' => 30, 'below' => 32, 'not_proficient' => 21, 'projected' => 9],
                ['name' => 'Haziq Yusof', 'proficient' => 20, 'exceeds' => 25, 'below' => 40, 'not_proficient' => 30, 'projected' => 5],
                ['name' => 'Liyana Zulkifli', 'proficient' => 50, 'exceeds' => 20, 'below' => 20, 'not_proficient' => 10, 'projected' => 5],
                ['name' => 'Pavithra Surendaram', 'proficient' => 35, 'exceeds' => 25, 'below' => 30, 'not_proficient' => 10, 'projected' => 10],
                ['name' => 'Kok Weng Wong', 'proficient' => 28, 'exceeds' => 32, 'below' => 25, 'not_proficient' => 20, 'projected' => 15],
                ['name' => 'Nur Farhana', 'proficient' => 30, 'exceeds' => 25, 'below' => 35, 'not_proficient' => 20, 'projected' => 10],
                ['name' => 'Ahmad Farid', 'proficient' => 45, 'exceeds' => 25, 'below' => 20, 'not_proficient' => 15, 'projected' => 8],
                ['name' => 'Siti Aminah', 'proficient' => 30, 'exceeds' => 30, 'below' => 30, 'not_proficient' => 25, 'projected' => 7],
                ['name' => 'Zikri Abdullah', 'proficient' => 38, 'exceeds' => 30, 'below' => 20, 'not_proficient' => 25, 'projected' => 10],
                ['name' => 'Hana Ismail', 'proficient' => 35, 'exceeds' => 20, 'below' => 30, 'not_proficient' => 20, 'projected' => 15],
            ];

            // Simulated data for departments
            $departmentData = [
                ['name' => 'Flight Operations', 'skill' => 'Flight Planning', 'demand' => 'High Demand', 'growth' => '+50%', 'urgency' => 'Medium'],
                ['name' => 'Cabin Crew', 'skill' => 'Customer Service', 'demand' => 'In Demand', 'growth' => '+75%', 'urgency' => 'High'],
                ['name' => 'Engineering & Maintenance', 'skill' => 'Aircraft Systems Knowledge', 'demand' => 'Critical', 'growth' => '+30%', 'urgency' => 'High'],
                ['name' => 'Ground Services', 'skill' => 'Operational Efficiency', 'demand' => 'Moderate Demand', 'growth' => '+20%', 'urgency' => 'Medium'],
                ['name' => 'Cargo & Logistics', 'skill' => 'Supply Chain Management', 'demand' => 'High Demand', 'growth' => '+40%', 'urgency' => 'Medium'],
                ['name' => 'Marketing', 'skill' => 'Digital Marketing', 'demand' => 'Critical', 'growth' => '+60%', 'urgency' => 'High'],
                ['name' => 'IT Support', 'skill' => 'Technical Troubleshooting', 'demand' => 'Moderate Demand', 'growth' => '+25%', 'urgency' => 'Low'],
                ['name' => 'Finance', 'skill' => 'Financial Analysis', 'demand' => 'In Demand', 'growth' => '+45%', 'urgency' => 'Medium'],
                ['name' => 'Customer Service', 'skill' => 'Conflict Resolution', 'demand' => 'High Demand', 'growth' => '+55%', 'urgency' => 'High'],
                ['name' => 'Safety & Security', 'skill' => 'Risk Assessment', 'demand' => 'Critical', 'growth' => '+35%', 'urgency' => 'High'],
                ['name' => 'HR', 'skill' => 'Manpower Planning', 'demand' => 'Moderate Demand', 'growth' => '+25%', 'urgency' => 'Low'],
                ['name' => 'Procurement', 'skill' => 'Vendor Management', 'demand' => 'High Demand', 'growth' => '+50%', 'urgency' => 'Medium'],
                ['name' => 'Training', 'skill' => 'Employee Development', 'demand' => 'Critical', 'growth' => '+40%', 'urgency' => 'High'],
                ['name' => 'Project Management', 'skill' => 'Agile Methodology', 'demand' => 'In Demand', 'growth' => '+30%', 'urgency' => 'Medium'],
                ['name' => 'Legal', 'skill' => 'Compliance Management', 'demand' => 'High Demand', 'growth' => '+20%', 'urgency' => 'Medium'],
            ];

            // Paginate the data
            $individualData = $this->paginate($individualData, 5);
            $departmentData = $this->paginate($departmentData, 5);

            return view('admin.skill_gap', compact('data','individualData', 'departmentData'));
        }

        private function paginate($items, $perPage = 5)
        {
            $page = request()->get('page', 1);
            $items = collect($items);
            $offset = ($page - 1) * $perPage;
            return new LengthAwarePaginator(
                $items->slice($offset, $perPage)->values(),
                $items->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }

}
