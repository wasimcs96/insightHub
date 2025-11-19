<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\QuizDomainValueAnswer;
use App\Models\SavedEmployee;
use App\Exports\EmployeeExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\MasterOpportunitiesForGrowth;
use App\Helpers\AssessmentHelper;
use App\Helpers\NewAssessmentHelper;
use App\Models\Department;
use App\Models\PersonalityTypeDescriptor;
use App\Models\Role;
use App\Models\SavedCandidates;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Dompdf\Dompdf;

use Dompdf\Options;
use App\Models\UserResult;
use Hash;
use Carbon\Carbon;
use App\Helpers\MainHelper;
use App\Models\Job;
use App\Services\AssessmentDetailsService;
use App\Models\CompanyDetail;
use App\Models\UserPerformanceRating;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $applicantDetailsService;

    public function __construct(AssessmentDetailsService $assessmentDetailsService)
    {
        $this->assessmentDetailsService = $assessmentDetailsService;
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
        $user = User::find($id);
        $user_id = $id;
        $results = UserResult::where('user_id', $user_id)->get();

        $page = request()->get('page');
  
     
        switch ($page) {
            case 'overview':
                $responseData = $this->employeeOverview($id);
                break;
            case 'psychometric-insights':
                $responseData = $this->assessmentDetailsService->getPsychometricInsights($id);
                break;
            case 'psychometric':
                $responseData = $this->assessmentDetailsService->getPsychometric($id);
                break;
            case 'job-centric-report':
                $responseData = $this->assessmentDetailsService->getJobCentricReport($id, $user->position_id);
                break;
            case 'performance':
                $responseData['ratingsData'] = $this->employeePerformance($id);
                break;
            case 'succession':
                $responseData = $this->employeeSuccession($id);
                break;
            case 'detail_career':
                $responseData = $this->employeeCareer($id);
                break;
            case 'detail_comparison':
                $responseData = $this->employeeComparison($id, $employee, $results);
                $jobs = Job::where('saved_job', 1)->where('status', 2)->get(['id', 'title']);
                $responseData = array_merge($responseData, ['jobs' => $jobs]);
                break;
            case 'detail_skill':
                $responseData = $this->employeeSkill($id);
                break;
            default:
               $employeeOverview = $this->employeeOverview($id);
               break;
        }
        // $isUserResultExists = 0;
        if (!$results->isEmpty()) {
            $isUserResultExists = 1;
        } else {
            $isUserResultExists = 0;
        }
        
        $responseData = array_merge($responseData, ['isUserResultExists' => $isUserResultExists]);
        $responseData['user'] = $user;

        $softSkillScore = UserResult::where('user_id', $id)->where('job_id', $user->position_id)->where('result_type', 'soft_skill_score')->first();

        if ($softSkillScore && $user->position_id) {
            $softSkillScoreLevel = $softSkillScore->level ?? 0;
        } else {
            $softSkillScoreLevel = 0;
        }
         
        $responseData = array_merge($responseData, ['softSkillScoreLevel' => $softSkillScoreLevel]);

        $strategicInsight = $this->assessmentDetailsService->getStrategicInsight($id);
        $responseData = array_merge($responseData, ['strategicInsight' => $strategicInsight]);

        return view('admin.employee-detail.employe_detail', $responseData);
    }


    public function employeeCareer(){
        return[];
    }
    
    public function employeeOverview(){
        return[];
    }

    public function employeePsychometric($id){
        $responseData = [];
        $employee = User::find($id);
        $user_id = $id;
        $results = UserResult::where('user_id', $user_id)->get();
        if (!$results->isEmpty()) {
            $isUserResultExists = 1;
        } else {
            $isUserResultExists = 0;
        }
        $responseData = array_merge($responseData, ['isUserResultExists' => $isUserResultExists]);
        $responseData['employee'] = $employee;

        $descriptors = DB::table('master_descriptors')->where('user_type', 'employee')->get();

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

        $cognitiveOverallResult =  NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'overall','employee',$descriptors);
        $responseData = array_merge($responseData, ['cognitiveOverallResult' => $cognitiveOverallResult]);
        
        $totalMarksForCognitive = $cognitiveOverallResult['cognitive']['score'] ?? 0;
        $responseData = array_merge($responseData, ['totalMarksForCognitive' => $totalMarksForCognitive]);

        $cognitiveDomainResult =  NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'domains','employee',$descriptors);
        $responseData = array_merge($responseData, ['cognitiveDomainResult' => $cognitiveDomainResult]);

        
        $oceanDomainResults = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'domains');
        $responseData = array_merge($responseData, ['oceanDomainResult' => $oceanDomainResults]);

        $oceanAllFacetsResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'all_facets','employee',$descriptors);
        $responseData = array_merge($responseData, ['oceanAllFacetsResult' => $oceanAllFacetsResult]);
    
        $riasecDomainResult = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'domains','employee',$descriptors);
        $responseData = array_merge($responseData, ['riasecDomainResult' => $riasecDomainResult]);

        $riasecTop3Results = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'top_3_riasec');

        $riasecTop3Result['string'] = $riasecTop3Results['top-3-riasec']['level_description'] ?? '';
        $riasecTop3Result['array'] = str_split($riasecTop3Result['string']) ?? [];
        $riasecTop3Result['job_top_3_riasec'] = $user->position->top3riasec ?? '';
        $riasecTop3Result['job_top_3_riasec_array'] = str_split($riasecTop3Result['job_top_3_riasec']) ?? [];
        $riasecTop3Result['description'] = $riasecTop3Results['top-3-riasec']['description'] ?? '';
        $responseData = array_merge($responseData, ['riasecTop3Result' => $riasecTop3Result]);

        $ccsResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'ccs','employee',$descriptors);

        $jobSkills = $employee->position->skills ?? [];
        
        $jobSkillsArray = [];
        $jobSkillsLevelArray = [];
        foreach ($jobSkills as $skill) {
            $jobSkillsArray[] = $skill->title;
            $jobSkillsLevelArray[$skill->title] = $skill->level;
        }

        $jobCcsResult = [];
        $ccsResult = $ccsResult->filter(function ($result) use ($jobSkillsArray, $jobSkillsLevelArray, &$jobCcsResult, $descriptors) {
            // $result['is_job_required_skill'] = in_array($result['name'], $jobSkillsArray) ? 1 : 0;
            if (in_array($result['name'], $jobSkillsArray)) {
                // Add the current result to $jobCcsResult
                if($jobSkillsLevelArray[$result['name']] < $result['level']) {
                    $result['alignment_level'] = 2;
                } elseif ($jobSkillsLevelArray[$result['name']] == $result['level']) {
                    $result['alignment_level'] = 1;
                } else {
                    $result['alignment_level'] = 0;
                }
                $description = $descriptors->where('slug',$result['slug'])->where('user_type', 'employee')->whereNotNull('job_requirement_level')->where('job_requirement_level', $jobSkillsLevelArray[$result['name']])->where('user_score_level', $result['level'])->first()->analysis ?? '';
                
                $result['required_level'] = $jobSkillsLevelArray[$result['name']];
                $result['description'] = $description;
                $jobCcsResult[$result['slug']] = $result;
                
                return false; // Remove it from $ccsResult
            }
        
            return true; // Keep it in $ccsResult
        });

        $responseData = array_merge($responseData, ['ccsResult' => $ccsResult]);
        $responseData = array_merge($responseData, ['jobCcsResult' => $jobCcsResult]);

        $allStarResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'all_star','employee',$descriptors);
        $responseData = array_merge($responseData, ['allStarResult' => $allStarResult]);

        $personalityTypeResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'personality_type','employee',$descriptors);
        $personalityTypeResponseResult = [];
        foreach ($personalityTypeResult as $name => $result) {
            $personalityTypeResponseResult['name'] = $result['name'] ?? '';
            $personalityTypeResponseResult['description'] = $result['level_description'] ?? '';
            break;
        }
       
        $responseData = array_merge($responseData, ['personalityTypeResult' => $personalityTypeResponseResult]);
        
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

        $oceanDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'domains')->where('user_type', 'employee')->take(20)->get();      
        $responseData = array_merge($responseData, ['oceanDomainDescriptors' => $oceanDomainDescriptors]); 

        $oceanAllFacetsDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'all_facets')->where('user_type', 'employee')->get();      
        $responseData = array_merge($responseData, ['oceanAllFacetsDescriptors' => $oceanAllFacetsDescriptors]); 
       
        $riasecDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'riasec')->where('result_type', 'domains')->where('user_type', 'employee')->get();     
        $responseData = array_merge($responseData, ['riasecDomainDescriptors' => $riasecDomainDescriptors]); 

        $ccsDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'ccs')->where('user_type', 'employee')->get();     
        $responseData = array_merge($responseData, ['ccsDomainDescriptors' => $ccsDomainDescriptors]); 

        $learningAndDevelopmentPlanDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'learning_and_development_plan')->where('user_type', 'employee')->get();     
        $responseData = array_merge($responseData, ['learningAndDevelopmentPlanDescriptors' => $learningAndDevelopmentPlanDescriptors]); 

        $allStarDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'all_star')->where('user_type', 'employee')->get();     
        $responseData = array_merge($responseData, ['allStarDomainDescriptors' => $allStarDomainDescriptors]);

        // OCEAN Summary
        $oceanSummary = NewAssessmentHelper::getOceanSummary($oceanDomainResults, 'admin');
        $responseData = array_merge($responseData, ['oceanSummary' => $oceanSummary]);

        return $responseData;
    }

    public function employeeSkill(){
        return[];
    }

    public function employeePerformance($id){
        // Fetch ratings data for the specific user
        $ratings = UserPerformanceRating::where('user_id', $id)->orderBy('year', 'asc')->get();

        $data = [
            'categories' => [],
            'data' => []
        ];

        // Process the ratings data for the chart
        foreach ($ratings as $rating) {
            if (!in_array("Year " . $rating->year, $data['categories'])) {
                $data['categories'][] = "Year " . $rating->year;
            }

            // Add rating data to the respective year
            $index = array_search("Year " . $rating->year, $data['categories']);
            $data['data'][$index] = $rating->rating;
        }
        
        return $data;
    }

    public function employeeSuccession(){
        return[];
    }




    public function addToBookmark(Request $request)
    {
        // dd($request->all());
        SavedEmployee::updateOrCreate([
            'user_id' => $request->employee_id,
            'admin_id' => auth()->user()->id
        ]);

        if ($request->ajax()) {
            return response()->json(['message' => 'User bookmarked successfully']);
        }else{
            return redirect()->route('admin.employee.details', $request->employee_id);

        }
    }

    public function addToDepartment(Request $request)
    {
        // dd($request->all());
        Department::where('id',$request->department_id)->update([
            'user_id' => $request->employee_id
        ]);

        User::where('id',$request->employee_id)->update([
            'department_id' => $request->department_id
        ]);

        return redirect()->route('admin.employee.details', $request->employee_id)->with('success','Department Assigned successfully');
    }

    public function assessmentReset(Request $request)
    {
       

        try {
            if ($request->assessment_id == 1) {
                QuizDomainValueAnswer::where('user_id',$request->employee_id)->whereBetween('quiz_domain_value_question_id', [115, 234])->delete();
                User::where('id',$request->employee_id)->update([
                    'is_personality_motivation_completed' => 0
                ]);
             } else if ($request->assessment_id == 2) {
                QuizDomainValueAnswer::where('user_id',$request->employee_id)->whereBetween('quiz_domain_value_question_id', [55, 114])->delete();
                User::where('id',$request->employee_id)->update([
                    'is_work_interest_completed' => 0
                ]);
             }else{
                 QuizDomainValueAnswer::where('user_id',$request->employee_id)->whereBetween('quiz_domain_value_question_id', [377, 426])->delete();
                 User::where('id',$request->employee_id)->update([
                    'is_cognitive_ability_completed' => 0
                ]);
             }

             
        } catch (\Throwable $th) {
            //throw $th;
        }


        return redirect()->route('admin.employee.details', $request->employee_id)->with('success','Assessment Reset successfully');
    }

    public function removeBookmark(Request $request)
    {
        SavedEmployee::where('user_id', $request->employee_id)->where('admin_id', auth()->user()->id)->delete();


        if ($request->ajax()) {
            return response()->json(['message' => 'User Unbookmarked successfully']);
        }else{
            return redirect()->route('admin.employee.details', $request->employee_id);

        }
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




    public function index()
    {


        $users = User::where('role_name', Role::$employee)->orderBy('created_at', 'DESC')->paginate(20);


        $data = [
            'users' => $users,
            // 'type'=>$type
        ];
        return view('admin.users.employee.index', $data);
    }

    public function create()
    {
        $company = User::where('role_name', Role::$company)
            ->select('name', 'id')
            ->orderBy('created_at', 'DESC')
            ->get();

        $data = [
            // 'type'=>$type,
            'company' => $company,

        ];

        return view('admin.users.employee.create', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company_id' => 'required',
            'department_id' => 'required',
            'position_id' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|unique:users',
            'password' => 'required | confirmed',

        ]);

        $avatarName = '/media/users/avatars/' . time() . '.' . $request->avatar->extension(); // Generate unique avatar name
        $request->avatar->move(public_path('media/users/avatars'), $avatarName); // Move avatar to public/avatars directory

        // Hash the password
        $hashedPassword = Hash::make($request->password);



        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role_name' => 'employee',
            'role_id' => 1,
            'name' => $request->first_name . ' ' . $request->last_name,
            'company_id' => $request->company_id,
            'department_id' => $request->department_id,
            'position_id' => $request->position_id,


            'profile_picture' => $avatarName, // Save the avatar name in the database
            'email' => $request->email,
            'password' => $hashedPassword,
        ]);


        return redirect('/admin/employee/users/')->with('success', 'Employee created successfully.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $company = User::where('role_name', Role::$company)
            ->select('name', 'id')
            ->orderBy('created_at', 'DESC')
            ->get();
        $roles = Role::orderBy('created_at', 'desc')->get();

        $data = [
            'user' => $user,
            'company' => $company

        ];
        return view('admin.users.employee.create', $data);
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate avatar as an image file
            'password' => 'nullable | confirmed', // Password is optional
            // 'role_name' => 'required'
            'company_id' => 'required',
            'department_id' => 'required',
            'position_id' => 'required',
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'company_id' => $request->company_id,
            'department_id' => $request->department_id,
            'position_id' => $request->position_id,

        ]);


        if ($request->hasFile('avatar')) {
            // Store new avatar in the public folder
            $avatarName = '/media/users/avatars/' . time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('media/users/avatars'), $avatarName);
            // Delete old avatar if exists
            if ($user->profile_picture) {
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


        try {
            MainHelper::jobTriggerByTypeOnPositionChange($user->id,$user->position_id,config('helpers.panel_names')[env('DB_DATABASE')]);
        } catch (\Throwable $th) {
            \Log::error($th);
        }

        return redirect('/admin/employee/users/')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
       

        $user = User::find($id);
        
        $user->delete();

        return redirect('/admin/employee/users/')->with('success', 'User deleted successfully.');
    }


    // In your controller method for handling bulk import
    public function bulkImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx|max:2048', // Allow only .xlsx files up to 2MB
        ]);

        // Retrieve the uploaded file
        $file = $request->file('file');

        try {
            // Import the .xlsx file using Laravel Excel
            Excel::import(new UsersImport, $file);

            // Provide feedback to the user
            return back()->with('success', 'File uploaded and processed successfully.');
        } catch (\exception $th) {
            // Handle any exceptions or errors
            return back()->with('error', 'An error occurred while processing the file.');
        }
    }


    public function candidateAddToBookmark($user_id)
    {
        SavedCandidates::updateOrCreate([
            'candidate_id' => $user_id,
            'user_id' => auth()->user()->id
        ]);

        return response()->json(['message' => 'User bookmarked successfully']);
    }

    public function candidateRemoveBookmark($user)
    {
        SavedCandidates::where('candidate_id', $user)->where('user_id', auth()->user()->id)->delete();

        return response()->json(['message' => 'User unbookmarked successfully']);
    }

    public function candidateBookmarks(Request $request)
    {
        $user_ids = SavedCandidates::where('user_id', auth()->user()->id)->pluck('candidate_id');

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

            return view('admin.candidate_bookmark', compact('bookmarks'));
        }
    }

    public function downloadReport(Request $request, $employee_id) {
        
        $data = [];
        // Assume $data contains report data; fetch or generate as needed
        $responseData = [];
        $user = User::find($employee_id);
        $user_id = $employee_id;
        $results = UserResult::where('user_id', $user_id)->get();
        if ($results->isEmpty()) {
            return redirect()->back()->with('error', 'Assessment Not Completed');
        } 
        $responseData['user'] = $user;

        $companyDetail = CompanyDetail::latest()->first();

        $responseData['companyDetail'] = $companyDetail;

        User::where('id', $employee_id)->update([
            'last_report_downloaded_at' => now()
        ]);
        $descriptors = DB::table('master_descriptors')->where('user_type', 'employee')->get();

        $total_correct = QuizDomainValueAnswer::where('user_id', $user_id)->where('quiz_domain_value_question_id', '>', 376)->where('is_correct', 1)->count();
        $responseData = array_merge($responseData, ['totalCorrectForCognitive' => $total_correct]);

        $total_not_attempted = QuizDomainValueAnswer::where('user_id', $user_id)->where('quiz_domain_value_question_id', '>', 376)->where('time_taken', 0)->count();
        $responseData = array_merge($responseData, ['totalNonAttemptedForCognitive' => $total_not_attempted]);
        if ($total_correct == 0 && $total_not_attempted == 0) {
            $total_wrong = 0;
        } else {
            $total_wrong = 50 - $total_correct - $total_not_attempted;
        }
        $responseData = array_merge($responseData, ['totalWrongForCognitive' => $total_wrong]);

        $cognitiveOverallResult =  NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'overall','employee',$descriptors);
        $responseData = array_merge($responseData, ['cognitiveOverallResult' => $cognitiveOverallResult]);
        
        $totalMarksForCognitive = $cognitiveOverallResult['cognitive']['score'] ?? 0;
        $responseData = array_merge($responseData, ['totalMarksForCognitive' => $totalMarksForCognitive]);

        $cognitiveDomainResult =  NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'domains','employee',$descriptors);
        $responseData = array_merge($responseData, ['cognitiveDomainResult' => $cognitiveDomainResult]);

        
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
        $riasecTop3Result['job_top_3_riasec_array'] = str_split($riasecTop3Result['job_top_3_riasec']) ?? [];
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
        $ccsResult = $ccsResult->filter(function ($result) use ($jobSkillsArray, $jobSkillsLevelArray, &$jobCcsResult, $descriptors) {
            // $result['is_job_required_skill'] = in_array($result['name'], $jobSkillsArray) ? 1 : 0;
            if (in_array($result['name'], $jobSkillsArray)) {
                // Add the current result to $jobCcsResult
                if($jobSkillsLevelArray[$result['name']] < $result['level']) {
                    $result['alignment_level'] = 2;
                } elseif ($jobSkillsLevelArray[$result['name']] == $result['level']) {
                    $result['alignment_level'] = 1;
                } else {
                    $result['alignment_level'] = 0;
                }
                $description = $descriptors->where('slug',$result['slug'])->where('user_type', 'employee')->whereNotNull('job_requirement_level')->where('job_requirement_level', $jobSkillsLevelArray[$result['name']])->where('user_score_level', $result['level'])->first()->analysis ?? '';
                
                $result['required_level'] = $jobSkillsLevelArray[$result['name']];
                $result['description'] = $description;
                $jobCcsResult[$result['slug']] = $result;
                
                return false; // Remove it from $ccsResult
            }
        
            return true; // Keep it in $ccsResult
        });
        $ccsResult = $ccsResult->sortByDesc('score')->values();
        $responseData = array_merge($responseData, ['ccsResult' => $ccsResult]);

        // Convert array to collection
        $jobCcsResult = collect($jobCcsResult);

        // Now you can sort the collection by 'score'
        $jobCcsResult = $jobCcsResult->sortByDesc('score')->values();
        $responseData = array_merge($responseData, ['jobCcsResult' => $jobCcsResult]);

        $allStarResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'all_star','employee',$descriptors);
        $responseData = array_merge($responseData, ['allStarResult' => $allStarResult]);

        $personalityTypeResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'personality_type','employee',$descriptors);
        $personalityTypeResponseResult = [];
        foreach ($personalityTypeResult as $name => $result) {
            $personalityTypeResponseResult['name'] = $result['name'] ?? '';
            $personalityTypeResponseResult['description'] = $result['level_description'] ?? '';
            break;
        }
        $responseData = array_merge($responseData, ['personalityTypeResult' => $personalityTypeResponseResult]);
        
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

        $overAllMatchRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'all', 'overall_match_rate','employee',$descriptors, $user->position_id);
        $responseData = array_merge($responseData, ['overAllMatchRateResult' => $overAllMatchRateResult]);

        $behaviorFitRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'all', 'soft_skill_score','employee',$descriptors, $user->position_id);
        $responseData = array_merge($responseData, ['behaviorFitRateResult' => $behaviorFitRateResult]);
        
        $technicalResult = NewAssessmentHelper::getFormattedUserResults($results, 'technical', 'overall','employee',$descriptors, $user->position_id);
        $responseData = array_merge($responseData, ['technicalResult' => $technicalResult]);

        $softSkillMatchRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'ccs_match_rate','employee',$descriptors, $user->position_id);
        $responseData = array_merge($responseData, ['softSkillMatchRateResult' => $softSkillMatchRateResult]);

        $jobMatchRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'jmr','employee',$descriptors, $user->position_id);
        $responseData = array_merge($responseData, ['jobMatchRateResult' => $jobMatchRateResult]);

        $oceanDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'domains')->where('user_type', 'employee')->take(20)->get();      
        $responseData = array_merge($responseData, ['oceanDomainDescriptors' => $oceanDomainDescriptors]); 

        $oceanAllFacetsDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'all_facets')->where('user_type', 'employee')->get();      
        $responseData = array_merge($responseData, ['oceanAllFacetsDescriptors' => $oceanAllFacetsDescriptors]); 
       
        $riasecDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'riasec')->where('result_type', 'domains')->where('user_type', 'employee')->get();     
        $responseData = array_merge($responseData, ['riasecDomainDescriptors' => $riasecDomainDescriptors]); 

        $ccsDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'ccs')->where('user_type', 'employee')->get();     
        $responseData = array_merge($responseData, ['ccsDomainDescriptors' => $ccsDomainDescriptors]); 

        $learningAndDevelopmentPlanDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'learning_and_development_plan')->where('user_type', 'employee')->get();     
        $responseData = array_merge($responseData, ['learningAndDevelopmentPlanDescriptors' => $learningAndDevelopmentPlanDescriptors]); 

        $allStarDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'all_star')->where('user_type', 'employee')->get();     
        $responseData = array_merge($responseData, ['allStarDomainDescriptors' => $allStarDomainDescriptors]); 

        $reportDate = Carbon::now()->format('d F Y');
        $responseData = array_merge($responseData, ['reportDate' => $reportDate]);

        // OCEAN Summary
        $oceanSummary = NewAssessmentHelper::getOceanSummary($oceanDomainResults, 'admin');
        $responseData = array_merge($responseData, ['oceanSummary' => $oceanSummary]);

        $text = $oceanSummary ?? '';
        $length = strlen(strip_tags($text));
        $fontSize = 14; // default

        if ($length > 1200) {
            $fontSize = 10;
        } elseif ($length > 800) {
            $fontSize = 12;
        }
        $responseData = array_merge($responseData, ['oceanSummaryFontSize' => $fontSize]);

        $technicalSkillMatchRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'technical_skill_match_rate', 'employee', $descriptors, $user->position_id);
        $responseData = array_merge($responseData, ['technicalSkillMatchRateResult' => $technicalSkillMatchRateResult]);

        $leadershipPotentialResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'leadership_potential', 'employee', $descriptors);
        $responseData = array_merge($responseData, ['leadershipPotentialResult' => $leadershipPotentialResult]);
        
        $chartData = [44, 55, 13, 43]; // Example data
        $chartLabels = ['Apple', 'Mango', 'Orange', 'Banana'];

        $responseData = array_merge($responseData, ['chartData' => $chartData]);
        $responseData = array_merge($responseData, ['chartLabels' => $chartLabels]);

        $totalCorrect = $total_correct*2 ?? 0;
        $totalWrong = $total_wrong*2 ?? 0;
        $totalMissed = $total_not_attempted*2 ?? 0;

        $chartUrl = 'https://quickchart.io/chart?c=' . urlencode(json_encode([
            'type' => 'doughnut',
            'data' => [
                'labels' => ['Correct Answers', 'Wrong Answers', 'Missed'],
                'datasets' => [[
                    'data' => [$totalCorrect, $totalWrong, $totalMissed],
                    'backgroundColor' => ['#BBECC5', '#FFDC92', '#f4a261'],
                    'borderWidth' => 0,
                ]]
            ],
            'options' => [
                'cutout' => '80%',
                'plugins' => [
                    'legend' => [
                        'display' => true,
                    ],
                    'datalabels' => [
                        'display' => true,
                    ],
                ],
            ]

        ]));
        
        $imageData = base64_encode(file_get_contents($chartUrl));
        $imageSrc = 'data:image/png;base64,' . $imageData;
        
        // dd($chartUrl);
        $responseData = array_merge($responseData, ['chartUrl' => $imageSrc]);

        if (in_array(env('DB_DATABASE'), ['aboitiz_food_dev', 'aboitiz_food_prod'])) {
            $companyName = 'Aboitiz Group';
        } elseif(in_array(env('DB_DATABASE'), ['jgs_olefins_dev', 'jgs_olefins_prod'])) {
            $companyName = 'JGS';
        } else {
            $companyName = 'Company';
        }
        $responseData = array_merge($responseData, ['companyName' => $companyName]);
        // dd($responseData, $oceanAllFacetsResult->keys());
        // View file that formats the report
        $pdf = PDF::loadView('admin.reports.employee-details-template', $responseData)->setPaper('a4', 'portrait')->set_option("enable_php", true);
        //Download the generated PDF
        return $pdf->download("Report of {$user->name}.pdf");
    }
    

    public function getComparisonData(Request $request)
    {
        $position_id = $request->input('position_id');
        $employee_id = $request->input('employee_id');

        $position = Job::where('id', $position_id)->first(['level']);
        $positionLevel = $position->level ?? 1;

        $employee = User::find($employee_id);
        $employeeResults = UserResult::where('user_id', $employee_id)->get();

        $descriptors = DB::table('master_descriptors')->where('user_type', 'employee')->get();

        $user_type = 'employee';
        $responseData = [];



        $responseData = array_merge($responseData, ['positionLevel' => $positionLevel ?? 1]);

        $softSkillMatchRateResult = NewAssessmentHelper::getCcsMatchRate($employee_id, $position_id, $employee,$employeeResults, $descriptors, $user_type);
        $softSkillMatchRate = config('helpers.talent_pillar_match_rate_levels')[$softSkillMatchRateResult['level']] ?? 'Moderate';
        $softSkillMatchRateLevel = $softSkillMatchRateResult['level'] ?? 3;
        
        $responseData = array_merge($responseData, ['softSkillMatchRate' => $softSkillMatchRate ?? 'Moderate']);
        $responseData = array_merge($responseData, ['softSkillMatchRateLevel' => $softSkillMatchRateLevel ?? 3]);

        $jobMatchRateResult = NewAssessmentHelper::getJmr($employee_id, $position_id, $employee,$employeeResults, $descriptors, $user_type);
        $jobMatchRate = config('helpers.job_match_rate_levels')[$jobMatchRateResult['level']] ?? 'Moderate';
        $jobMatchRateLevel = $jobMatchRateResult['level'] ?? 3;

        $responseData = array_merge($responseData, ['jobMatchRate' => $jobMatchRate ?? 'Moderate']);
        $responseData = array_merge($responseData, ['jobMatchRateLevel' => $jobMatchRateLevel ?? 3]);

        $behaviorFitRateResult = NewAssessmentHelper::getBfr($employee_id, $position_id, $employee,$employeeResults, $descriptors, $user_type, $jobMatchRateResult['score'], $softSkillMatchRateResult['score']);
        $behaviorFitRate = config('helpers.job_match_rate_levels')[$behaviorFitRateResult['level']] ?? 'Moderate';
        $behaviorFitRateLevel = $behaviorFitRateResult['level'] ?? 3;

        $responseData = array_merge($responseData, ['behaviorFitRate' => $behaviorFitRate ?? 'Moderate']);
        $responseData = array_merge($responseData, ['behaviorFitRateLevel' => $behaviorFitRateLevel ?? 3]);

        $responseData = array_merge($responseData, ['overallMatchRate' => $overallMatchRate ?? 'Moderate']);
        $responseData = array_merge($responseData, ['overallMatchRateLevel' => $overallMatchRateLevel ?? 3]);
         
        // Your logic to fetch comparison data based on the `$value`.
        // dd($value, $responseData);
        return response()->json([
            'success' => true,
            'data' => $responseData,
        ]);
    }
}
