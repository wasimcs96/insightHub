<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\QuizDomainValueAnswer;
use App\Models\SavedEmployee;
// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Query\Expression;
use App\Helpers\AssessmentHelper;
use App\Helpers\NewAssessmentHelper;
use App\Models\Position;
use App\Models\Department;
use App\Models\Job;
use App\Models\JobOpening;
use App\Models\JobOpeningApplication;
use App\Models\UserResult;

class AdvancedComparisonController extends Controller
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

    public function taAdvancedComparison (Request $request) {
        $responseData = [];
        $departments = Department::where('company_id', auth()->user()->id)->get();
        $responseData['departments'] = $departments;

        $reportTypes = config('helpers.advanced_comparison_report_options');
        $responseData['reportTypes'] = $reportTypes;

        $applicationStatuses = config('helpers.application_status');
        $responseData['applicationStatuses'] = $applicationStatuses;

        $jobLevels = config('helpers.levels');
        $responseData['jobLevels'] = $jobLevels;
        // dd($responseData);
        return view('admin.advanced-comparison.talent-acquisition.filter', $responseData);
    }

    public function getJobOpenings(Request $request)
    {
        // Validate the request to ensure department_id is provided
        // $request->validate([
        //     'department_id' => 'required|integer|exists:departments,id',
        // ]);

        // Fetch job openings based on department_id
        $departmentId = $request->input('department_id');
        $jobOpenings = JobOpening::where('department_id', $departmentId)->get(['id', 'job_title']);

        // Return the job openings as JSON
        return response()->json([
            'jobOpenings' => $jobOpenings,
        ]);
    }

    // public function getCandidates(Request $request)
    // {
    //     // Fetch job openings based on department_id
    //     $jobOpeningId = $request->input('job_opening_id');
    //     $candidates = JobOpeningApplication::select('users.id as id', 'users.name', 'job_opening_applications.status')
    //     ->join('users', 'job_opening_applications.user_id', '=', 'users.id')
    //     ->where('job_opening_applications.job_opening_id', $jobOpeningId)
    //     ->get();

    //     // Return the job openings as JSON
    //     return response()->json([
    //         'candidates' => $candidates,
    //     ]);
    // }

    public function getCandidates(Request $request)
    {
        // Retrieve job_opening_id and other filters from the request
        $jobOpeningId = $request->input('job_opening_id');
        $isPersonalityMotivationCompleted = $request->input('is_personality_motivation_completed');
        $isWorkInterestCompleted = $request->input('is_work_interest_completed');
        $isCognitiveAbilityCompleted = $request->input('is_cognitive_ability_completed');
        // Build the query
        $candidatesQuery = JobOpeningApplication::select(
            'users.id as id',
            'users.name',
            'job_opening_applications.status'
        )
        ->join('users', 'job_opening_applications.user_id', '=', 'users.id')
        ->where('job_opening_applications.job_opening_id', $jobOpeningId);

        // Apply additional filters based on the request
        if ($isPersonalityMotivationCompleted) {
            $candidatesQuery->where('users.is_personality_motivation_completed', 1);
        }

        if ($isWorkInterestCompleted) {
            $candidatesQuery->where('users.is_work_interest_completed', 1);
        }

        if ($isCognitiveAbilityCompleted) {
            $candidatesQuery->where('users.is_cognitive_ability_completed', 1);
        }

        // Add a filter to check if the user_id is present in UserResult table
        $candidatesQuery->whereExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('user_results')
                ->whereColumn('user_results.user_id', 'users.id');
        });

        // Execute the query and get the candidates
        $candidates = $candidatesQuery->get();

        // Return the candidates as JSON
        return response()->json([
            'candidates' => $candidates,
        ]);
    }

    public function getJobPositions(Request $request)
    {
        // Validate the request to ensure department_id is provided
        // $request->validate([
        //     'department_id' => 'required|integer|exists:departments,id',
        // ]);

        // Fetch job positions based on department_id
        $jobLevelId = $request->input('job_level_id');
        $departmentId = $request->input('department_id');
        $jobPositions = Job::where('org_department', $departmentId)->where('level', $jobLevelId)->get(['id', 'title']);

        // Return the job positions as JSON
        return response()->json([
            'positions' => $jobPositions,
        ]);
    }

    // public function getEmployees(Request $request)
    // {
    //     // Fetch job positions based on department_id
    //     $jobPositionId = $request->input('job_position_id');
    //     $departmentId = $request->input('department_id');
    //     $employees = User::where('position_id', $jobPositionId)->where('role_name', 'employee')->get(['id', 'name']);

    //     // Return the job positions as JSON
    //     return response()->json([
    //         'employees' => $employees,
    //     ]);
    // }

    public function getEmployees(Request $request)
    {
        // Retrieve job_position_id, department_id, and other filters from the request
        $jobPositionId = $request->input('job_position_id');
        $departmentId = $request->input('department_id');
        $isPersonalityMotivationCompleted = $request->input('is_personality_motivation_completed');
        $isWorkInterestCompleted = $request->input('is_work_interest_completed');
        $isCognitiveAbilityCompleted = $request->input('is_cognitive_ability_completed');

        // Build the query
        $employeesQuery = User::select('id', 'name')
            ->where('position_id', $jobPositionId)
            ->where('role_name', 'employee');

        if ($isPersonalityMotivationCompleted) {
            $employeesQuery->where('is_personality_motivation_completed', 1);
        }

        if ($isWorkInterestCompleted) {
            $employeesQuery->where('is_work_interest_completed', 1);
        }

        if ($isCognitiveAbilityCompleted) {
            $employeesQuery->where('is_cognitive_ability_completed', 1);
        }

        // Execute the query and get the employees
        $employees = $employeesQuery->get();

        // Get the list of user_ids from the UserResult table
        $userIdsWithResults = \DB::table('user_results')->pluck('user_id')->toArray();

        // Filter employees based on user_id in UserResult table
        $filteredEmployees = $employees->filter(function ($employee) use ($userIdsWithResults) {
            return in_array($employee->id, $userIdsWithResults);
        });

        // Return the employees as JSON
        return response()->json([
            'employees' => $filteredEmployees,
        ]);
    }


    public function report(Request $request) {
        $responseData = [];
        $department_id = $request->department_id;
        $responseData['department_id'] = $department_id;
        $reportTypes = config('helpers.advanced_comparison_report_options');
        $responseData['reportTypes'] = $reportTypes;
        $report_type = $request->report_type;
        $responseData['report_type'] = $report_type;

        // Fetch domain-wise averages for company
        $companyDomainAverages = DB::table('user_results')
        ->join('users', 'user_results.user_id', '=', 'users.id')
        ->where('users.company_id', 3)
        ->where('user_results.assessment_type', 'ocean')
        ->where('user_results.result_type', 'domains')
        ->select('user_results.slug', DB::raw('AVG(user_results.score) as avg_score'))
        ->groupBy('user_results.slug')
        ->pluck('avg_score', 'user_results.slug');

        // Fetch facet-wise averages for company
        $companyFacetAverages = DB::table('user_results')
        ->join('users', 'user_results.user_id', '=', 'users.id')
        ->where('users.company_id', 3)
        ->where('user_results.assessment_type', 'ocean')
        ->where('user_results.result_type', 'all_facets')
        ->select('user_results.slug', DB::raw('AVG(user_results.score) as avg_score'))
        ->groupBy('user_results.slug')
        ->pluck('avg_score', 'user_results.slug');

        // Fetch domain-wise averages for department
        $departmentDomainAverages = DB::table('user_results')
        ->join('users', 'user_results.user_id', '=', 'users.id')
        ->where('users.department_id', $department_id)
        ->where('user_results.assessment_type', 'ocean')
        ->where('user_results.result_type', 'domains')
        ->select('user_results.slug', DB::raw('AVG(user_results.score) as avg_score'))
        ->groupBy('user_results.slug')
        ->pluck('avg_score', 'user_results.slug');

        // Fetch facet-wise averages for department
        $departmentFacetAverages = DB::table('user_results')
        ->join('users', 'user_results.user_id', '=', 'users.id')
        ->where('users.department_id', $department_id)
        ->where('user_results.assessment_type', 'ocean')
        ->where('user_results.result_type', 'all_facets')
        ->select('user_results.slug', DB::raw('AVG(user_results.score) as avg_score'))
        ->groupBy('user_results.slug')
        ->pluck('avg_score', 'user_results.slug');

        // Prepare the response
        $responseData['companyAverage'] = [
            'domains' => $companyDomainAverages,
            'all_facets' => $companyFacetAverages
        ];
        
        $responseData['departmentAverage'] = [
            'domains' => $departmentDomainAverages,
            'all_facets' => $departmentFacetAverages
        ];
        // $responseData['user_ids'] = $users;
        $userIds = explode(',', $request->users); // Explode user IDs from the request
        // Fetch user details based on IDs
        $users = User::whereIn('id', $userIds)->get();
        $responseData['users'] = $users;
        $employyeeData = $users->keyBy('id');

        // Fetch common data used across users
        $descriptors = DB::table('master_descriptors')->where('user_type', 'employee')->get();
        $oceanDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'domains')->where('user_type', 'employee')->take(20)->get();
        $oceanAllFacetsDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'all_facets')->where('user_type', 'employee')->get();
        $riasecDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'riasec')->where('result_type', 'domains')->where('user_type', 'employee')->get();
        $ccsDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'ccs')->where('user_type', 'employee')->get();
        $learningAndDevelopmentPlanDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'learning_and_development_plan')->where('user_type', 'employee')->get();
        $allStarDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'all_star')->where('user_type', 'employee')->get();

        foreach ($userIds as $user_id) {
            $user_id = trim($user_id); // Trim spaces around the user ID
            $employee = $employyeeData->get($user_id);

            // Skip if user is not found
            if (!$employee) {
                continue;
            }

            // Initialize single user's response data
            $userResponse = [];
            $userResponse['user_id'] = $user_id;
            $userResponse['user'] = $employee;

            // Fetch user results
            $results = UserResult::where('user_id', $user_id)->get();
            $userResponse['isUserResultExists'] = !$results->isEmpty() ? 1 : 0;

            // Calculate Cognitive Scores
            $total_correct = QuizDomainValueAnswer::where('user_id', $user_id)
                ->where('quiz_domain_value_question_id', '>', 376)
                ->where('is_correct', 1)
                ->count();

            $total_not_attempted = QuizDomainValueAnswer::where('user_id', $user_id)
                ->where('quiz_domain_value_question_id', '>', 376)
                ->where('time_taken', 0)->where('option_selected', 0)
                ->count();

            $total_wrong = ($total_correct == 0 && $total_not_attempted == 0)
                ? 0
                : 50 - $total_correct - $total_not_attempted;

            $userResponse['totalCorrectForCognitive'] = $total_correct;
            $userResponse['totalNonAttemptedForCognitive'] = $total_not_attempted;
            $userResponse['totalWrongForCognitive'] = $total_wrong;

            // Fetch Assessment Results
            $userResponse['cognitiveOverallResult'] = NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'overall', 'employee', $descriptors);
            $userResponse['cognitiveDomainResult'] = NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'domains', 'employee', $descriptors);
            $userResponse['oceanDomainResult'] = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'domains');
            $userResponse['oceanAllFacetsResult'] = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'all_facets', 'employee', $descriptors);
            $userResponse['riasecDomainResult'] = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'domains', 'employee', $descriptors);

            // RIACEC Top 3
            $riasecTop3Results = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'top_3_riasec');
            $riasecTop3Result = [
                'string' => $riasecTop3Results['top-3-riasec']['level_description'] ?? '',
                'array' => str_split($riasecTop3Results['top-3-riasec']['level_description'] ?? ''),
                'job_top_3_riasec' => $employee->position->top3riasec ?? '',
                'job_top_3_riasec_array' => str_split($employee->position->top3riasec ?? ''),
                'description' => $riasecTop3Results['top-3-riasec']['description'] ?? '',
            ];
            $userResponse['riasecTop3Result'] = $riasecTop3Result;

            // CCS Skills
            $jobSkills = $employee->position->skills ?? [];
            $jobSkillsArray = [];
            $jobSkillsLevelArray = [];
            foreach ($jobSkills as $skill) {
                $jobSkillsArray[] = $skill->title;
                $jobSkillsLevelArray[$skill->title] = $skill->level;
            }

            $jobCcsResult = [];
            $ccsResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'ccs', 'employee', $descriptors)
                ->filter(function ($result) use ($jobSkillsArray, $jobSkillsLevelArray, &$jobCcsResult) {
                    if (in_array($result['name'], $jobSkillsArray)) {
                        $result['required_level'] = $jobSkillsLevelArray[$result['name']];
                        $jobCcsResult[$result['slug']] = $result;
                        return false;
                    }
                    return true;
                });

            $userResponse['ccsResult'] = $ccsResult;
            $userResponse['jobCcsResult'] = $jobCcsResult;

            // Additional Results
            $userResponse['allStarResult'] = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'all_star', 'employee', $descriptors);
            $userResponse['flightRiskResult'] = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'flight_risk', 'employee', $descriptors);
            $userResponse['organizationalFitForecastResult'] = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'organizational_fit_forecast', 'employee', $descriptors);
            $userResponse['growthPotentialResult'] = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'growth_potential', 'employee', $descriptors);
            $userResponse['rciResult'] = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'rci', 'employee', $descriptors);

            $userResponse['oceanDomainDescriptors'] = $oceanDomainDescriptors;
            $userResponse['oceanAllFacetsDescriptors'] = $oceanAllFacetsDescriptors;
            $userResponse['riasecDomainDescriptors'] = $riasecDomainDescriptors;
            $userResponse['ccsDomainDescriptors'] = $ccsDomainDescriptors;
            $userResponse['learningAndDevelopmentPlanDescriptors'] = $learningAndDevelopmentPlanDescriptors;
            $userResponse['allStarDomainDescriptors'] = $allStarDomainDescriptors;

            // Append the user's data to the overall response
            $responseData[] = $userResponse;
        }
        // dd($responseData);
        return view('admin.advanced-comparison.talent-acquisition.report', ['responseData' => $responseData]);
    }

}
