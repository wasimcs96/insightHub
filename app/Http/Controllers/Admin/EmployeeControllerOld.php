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
use PDF;
use App\Models\UserResult;
use Hash;
use Carbon\Carbon;

class EmployeeController extends Controller
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
        $descriptors = DB::table('master_descriptors')->where('user_type', 'employee')->get();
        $user_id = $id;
        $results = UserResult::where('user_id', $user_id)->get();
        if (!$results->isEmpty()) {
            $isUserResultExists = 1;
        } else {
            $isUserResultExists = 0;
        }
        $responseData = array_merge($responseData, ['isUserResultExists' => $isUserResultExists]);
        $responseData['employee'] = $employee;

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

        $cognitiveOverallResult =  NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'overall', $employee->role_name, $descriptors);
        $responseData = array_merge($responseData, ['cognitiveOverallResult' => $cognitiveOverallResult]);

        $totalMarksForCognitive = $cognitiveOverallResult['cognitive']['score'] ?? 0;
        $responseData = array_merge($responseData, ['totalMarksForCognitive' => $totalMarksForCognitive]);

        $cognitiveDomainResult =  NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'domains', $employee->role_name, $descriptors);
        $responseData = array_merge($responseData, ['cognitiveDomainResult' => $cognitiveDomainResult]);

        
        $oceanDomainResults = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'domains', $employee->role_name, $descriptors);
        $responseData = array_merge($responseData, ['oceanDomainResult' => $oceanDomainResults]);

        $oceanAllFacetsResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'all_facets', $employee->role_name, $descriptors);
        $responseData = array_merge($responseData, ['oceanAllFacetsResult' => $oceanAllFacetsResult]);

        $oceanAllFacetsSingleResult = [];
        $oceanAllFacetsOverallResult = [];


        foreach ($oceanAllFacetsResult as $facet => $result) {
            $newFacet = str_replace('-', '_', $facet);
            $oceanAllFacetsSingleResult[$newFacet] = ['score' => $result['score'], 'percentage' => $result['percentage']];
            $oceanAllFacetsOverallResult[$newFacet] = $result['score'];
        }
        $responseData = array_merge($responseData, ['oceanAllFacetsSingleResult' => $oceanAllFacetsSingleResult]);
        $responseData = array_merge($responseData, ['oceanAllFacetsOverallResult' => $oceanAllFacetsOverallResult]);
 
        $riasecDomainResult = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'domains', $employee->role_name, $descriptors);
        $responseData = array_merge($responseData, ['riasecDomainResult' => $riasecDomainResult]);

        $riasecTop3Results = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'top_3_riasec');

        $riasecTop3Result['string'] = $riasecTop3Results['top-3-riasec']['level_description'] ?? '';
        $riasecTop3Result['array'] = str_split($riasecTop3Result['string']) ?? [];
        $riasecTop3Result['description'] = $riasecTop3Results['top-3-riasec']['description'] ?? '';
        $responseData = array_merge($responseData, ['riasecTop3Result' => $riasecTop3Result]);

        $ccsResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'ccs', $employee->role_name, $descriptors);
        $responseData = array_merge($responseData, ['ccsResult' => $ccsResult]);

        $personalityTypeResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'personality_type');
        $responseData = array_merge($responseData, ['personalityTypeResult' => $personalityTypeResult]);

        $flightRiskResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'flight_risk', $employee->role_name, $descriptors);
        $responseData = array_merge($responseData, ['flightRiskResult' => $flightRiskResult]);

        $organizationalFitForecastResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'organizational_fit_forecast', $employee->role_name, $descriptors);
        $responseData = array_merge($responseData, ['organizationalFitForecastResult' => $organizationalFitForecastResult]);

        $growthPotentialResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'growth_potential', $employee->role_name, $descriptors);
        $responseData = array_merge($responseData, ['growthPotentialResult' => $growthPotentialResult]);

        $rciResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'rci', $employee->role_name, $descriptors);
        $responseData = array_merge($responseData, ['rciResult' => $rciResult]);

        
        $oceanSelfResult = [];

        $oceanSelfResult['Openness to Experience'] = $oceanDomainResults['openness-to-experience']['score'] ?? 0;
        $oceanSelfResult['Conscientiousness'] = $oceanDomainResults['conscientiousness']['score'] ?? 0;
        $oceanSelfResult['Extraversion'] = $oceanDomainResults['extraversion']['score'] ?? 0;
        $oceanSelfResult['Agreeableness'] = $oceanDomainResults['agreeableness']['score'] ?? 0;
        $oceanSelfResult['Emotional Stability'] = $oceanDomainResults['emotional-stability']['score'] ?? 0;

        $learningStyle = AssessmentHelper::getLearningStyle($employee->id,$oceanSelfResult);

        $responseData = array_merge($responseData, ['learningStyle' => $learningStyle]);

        $bookmarked = SavedEmployee::where('user_id', $user_id)->where('admin_id', auth()->user()->id)->first();
        if ($bookmarked) {
            $isBookmarked = 1;
        } else {
            $isBookmarked = 0;
        }

        $responseData = array_merge($responseData, ['isBookmarked' => $isBookmarked]);


        // $departments = Department::where('company_id', auth()->user()->hasRole('company') ? auth()->user()->id : auth()->user()->company_id)
        // ->where('status',1)->get();
        $company_id = 0;
        if(auth()->user()->role_name == 'company') {
            $company_id = auth()->user()->id;
        } else {
            $company_id = auth()->user()->company_id;
        }
        $departments = Department::where('company_id', $company_id)
        ->where('status',1)->get();

        $responseData = array_merge($responseData, ['departments' => $departments]);

        if(isset($growthPotentialResult) && isset($growthPotentialResult['growth-potential'])) {
            $growth_potential_result = $growthPotentialResult['growth-potential']['level_description'];
        } else {
            $growth_potential_result = 'moderate';
        }
        $responseData = array_merge($responseData, ['growth_potential_result' => $growth_potential_result]);

        $oceanDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'domains')->where('user_type', 'employee')->take(20)->get();      
        $responseData = array_merge($responseData, ['oceanDomainDescriptors' => $oceanDomainDescriptors]); 

        $riasecDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'riasec')->where('result_type', 'domains')->where('user_type', 'employee')->get();     
        $responseData = array_merge($responseData, ['riasecDomainDescriptors' => $riasecDomainDescriptors]); 

        $ccsDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'ccs')->where('user_type', 'employee')->get();     
        $responseData = array_merge($responseData, ['ccsDomainDescriptors' => $ccsDomainDescriptors]); 

        $learningAndDevelopmentPlanDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'learning_and_development_plan')->where('user_type', 'employee')->get();     
        $responseData = array_merge($responseData, ['learningAndDevelopmentPlanDescriptors' => $learningAndDevelopmentPlanDescriptors]); 

        // dd($responseData);
        return view('admin.employe_detail', $responseData);
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
        $riasecTop3Result['job_top_3_riasec_array'] = $user->position && isset($user->position->top3riasec) ? str_split($user->position->top3riasec) : [];        
        $riasecTop3Result['description'] = $riasecTop3Results['top-3-riasec']['description'] ?? '';
        $responseData = array_merge($responseData, ['riasecTop3Result' => $riasecTop3Result]);

        $ccsResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'ccs','employee',$descriptors);

        $jobSkills = $user->position->skills ?? '';
        
        $jobSkillsArray = [];
        $jobSkillsLevelArray = [];
        if (is_array($jobSkills) || is_object($jobSkills)) {
            foreach ($jobSkills as $skill) {
                $jobSkillsArray[] = $skill->title;
                $jobSkillsLevelArray[$skill->title] = $skill->level;
            }
        } else {
            $jobSkillsArray = [];
            $jobSkillsLevelArray = [];
        }
        

        $jobCcsResult = [];
        $ccsResult = $ccsResult->filter(function ($result) use ($jobSkillsArray, $jobSkillsLevelArray, &$jobCcsResult) {
            // $result['is_job_required_skill'] = in_array($result['name'], $jobSkillsArray) ? 1 : 0;
            if (in_array($result['name'], $jobSkillsArray)) {
                // Add the current result to $jobCcsResult
                $result['required_level'] = $jobSkillsLevelArray[$result['name']];
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
        foreach ($personalityTypeResult as $name => $result) {
            $personalityTypeResponseResult['name'] = $result['name'] ?? '';
            $personalityTypeResponseResult['description'] = $result['level_description'] ?? '';
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

        $reportDate = Carbon::now()->format('d F Y');
        $responseData = array_merge($responseData, ['reportDate' => $reportDate]);

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
        // dd($responseData, $oceanAllFacetsResult->keys());
        // View file that formats the report

        $pdf = PDF::loadView('admin.reports.employee-details-template', $responseData);
  
        // Download the PDF file
        return $pdf->download('report.pdf');
    }
}
