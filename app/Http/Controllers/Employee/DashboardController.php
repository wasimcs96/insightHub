<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\AssessmentAlgoSubmit;
use Illuminate\Support\Facades\DB;
use App\Models\QuizDomainValueAnswer;
use Carbon\Carbon;
use App\Helpers\AssessmentHelper;
use App\Helpers\NewAssessmentHelper;
use Illuminate\Support\Facades\Http;
use App\Models\Contract;
use Barryvdh\DomPDF\Facade\Pdf;
use File;
use Storage;
use App\Jobs\GenerateContractPDF;
use App\Models\MasterOpportunitiesForGrowth;
use App\Models\JobOpeningApplication;
use App\Models\JobOpening;
use App\Models\User;
use App\Models\Role;
use App\Helpers\MainHelper;
use App\Helpers\HelperFunctions;
use App\Models\UserResult;
use App\Models\Job;
use App\Models\Department;
use App\Models\MasterSkill;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // $user = auth()->user();
        // $user_id = $user->id;
        // // $user->assignRole('employee');

        // $responseData = [];
        // $results = UserResult::where('user_id', $user_id)->get();
        // $resultsArray = $results->toArray();

        // if (!empty($resultsArray)) {
        //     $isUserResultExists = 1;
        // } else {
        //     $isUserResultExists = 0;
        // }

        // $responseData = array_merge($responseData, ['isUserResultExists' => $isUserResultExists]);
        // $oceanDomainResults = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'domains');
        // $responseData = array_merge($responseData, ['oceanDomainResult' => $oceanDomainResults]);
        // $oceanSelfResult = [];

        // $oceanSelfResult['Openness to Experience'] = $oceanDomainResults['openness-to-experience']['score'] ?? 0;
        // $oceanSelfResult['Conscientiousness'] = $oceanDomainResults['conscientiousness']['score'] ?? 0;
        // $oceanSelfResult['Extraversion'] = $oceanDomainResults['extraversion']['score'] ?? 0;
        // $oceanSelfResult['Agreeableness'] = $oceanDomainResults['agreeableness']['score'] ?? 0;
        // $oceanSelfResult['Emotional Stability'] = $oceanDomainResults['emotional-stability']['score'] ?? 0;

        // $learningStyle = AssessmentHelper::getLearningStyle($user_id,$oceanSelfResult);
        // $responseData = array_merge($responseData, ['learningStyle' => $learningStyle]);

        // New Dashboard Start
        // Assuming you need the currently authenticated employee
        $employee = auth()->user();  // Get the currently authenticated user (assuming they are an employee)
        if($employee->role_id == 8){
            return redirect('/dashboard');
        }
        $users = User::where('position_id', $employee->id)->first();
        $data = [];
    
        // Define the available levels
        // $levels = ["Level 1" => 1, "Level 2" => 2, "Level 3" => 3, "Level 4" => 4, "Level 5" => 5, "Level 6" => 6, "Level 7" => 7, "Level 8" => 8];
        // Fetch levels from the config file
        $levels = config('levels');
        
        // Query to get jobs for the employee
        $jobsQuery = Job::where('is_primary', 0)->orderBy('created_at', 'desc');
        
        // Filter by search if available (employee can search for jobs)
        if ($search = $request->query('search')) {
            $jobsQuery->where('title', 'like', '%' . $search . '%');
        }
        
        // Filter by department if the employee belongs to a department
        $employeeDepartmentId = $employee->department_id;  // Assuming each employee has a department
        if ($employeeDepartmentId) {
            $jobsQuery->where('department_id', $employeeDepartmentId);
        }
        
        // Optionally, filter by job level if employees can view jobs at specific levels
        if ($level = $request->query('level')) {
            $jobsQuery->where('level', $level);
        }
    
        // Filter by position_id if provided in the request
        if ($positionId = $request->query('position_id')) {
            $jobsQuery->where('position_id', $positionId);  // Assuming jobs have a 'position_id' field
        }
        
        // Get the filtered list of jobs
        $jobs = $jobsQuery->get();
        
        // Default to the first job if no specific job is selected
        $selectedJobId = $request->query('selected_job', optional($jobs->first())->id);
        
        // Find the selected job, defaulting to the first job if not found
        $selectedJob = $jobs->firstWhere('id', $selectedJobId) ?? $jobs->first();
        
        // Employee count for the selected job (assuming employees are linked to jobs)
        $employeesCount = 0;
        if ($selectedJob) {
            $employeesCount = $selectedJob->employees->count();  // Assuming each job has a relation to employees
        }
        
        // Get departments and skills for display (assuming you need them)
        $departments = Department::where('company_id', $employee->id)->get();
        $masterSkills = MasterSkill::all();
        
        // Prepare the data for the response
        $data = [
            'jobs' => $jobs,
            'selected_job' => $selectedJob,
            'employees_count' => $employeesCount,
            'levels' => $levels,  // Optionally return available levels for filtering
        ];
    
        // Return the view with the data
        return view('employee.dashboard.jd', compact('employee','jobs', 'selectedJob', 'masterSkills', 'departments', 'levels', 'data', 'employeesCount'));
    }
    // New Dashboard End
    // public function index()
    // {
    //     $user = auth()->user();
    //     $user_id = $user->id;
    //     // $user->assignRole('employee');

    //     $responseData = [];
    //     // $responseData = array_merge($responseData, ['employee' => $user]);
    //     $results = UserResult::where('user_id', $user_id)->get();

        
    //     if (!$results->isEmpty()) {
    //         $isUserResultExists = 1;
    //     } else {
    //         $isUserResultExists = 0;
    //     }

    //     $responseData = array_merge($responseData, ['isUserResultExists' => $isUserResultExists]);
        
    //     $oceanDomainResults = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'domains');
    //     $responseData = array_merge($responseData, ['oceanDomainResult' => $oceanDomainResults]);

    //     $oceanSelfResult = [];

    //     $oceanSelfResult['Openness to Experience'] = $oceanDomainResults['openness-to-experience']['score'] ?? 0;
    //     $oceanSelfResult['Conscientiousness'] = $oceanDomainResults['conscientiousness']['score'] ?? 0;
    //     $oceanSelfResult['Extraversion'] = $oceanDomainResults['extraversion']['score'] ?? 0;
    //     $oceanSelfResult['Agreeableness'] = $oceanDomainResults['agreeableness']['score'] ?? 0;
    //     $oceanSelfResult['Emotional Stability'] = $oceanDomainResults['emotional-stability']['score'] ?? 0;

    //     $learningStyle = AssessmentHelper::getLearningStyle($user_id,$oceanSelfResult);
    //     $responseData = array_merge($responseData, ['learningStyle' => $learningStyle]);
   
        
    //     $riasecDomainResult = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'domains');
    //     $responseData = array_merge($responseData, ['riasecDomainResult' => $riasecDomainResult]);

    //     $riasecTop3Results = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'top_3_riasec');

    //     $riasecTop3Result['string'] = $riasecTop3Results['top-3-riasec']['level_description'] ?? '';
    //     $riasecTop3Result['array'] = str_split($riasecTop3Result['string']) ?? [];
    //     $riasecTop3Result['description'] = $riasecTop3Results['top-3-riasec']['description'] ?? '';
    //     $responseData = array_merge($responseData, ['riasecTop3Result' => $riasecTop3Result]);

    //     $ccsResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'ccs');
    //     $responseData = array_merge($responseData, ['ccsResult' => $ccsResult]);

    //     $total_correct = QuizDomainValueAnswer::where('user_id', $user_id)->where('quiz_domain_value_question_id', '>', 376)->where('is_correct', 1)->count();
    //     $responseData = array_merge($responseData, ['totalCorrectForCognitive' => $total_correct]);

    //     $total_not_attempted = QuizDomainValueAnswer::where('user_id', $user_id)->where('quiz_domain_value_question_id', '>', 376)->where('time_taken', 0)->where('option_selected', 0)->count();
    //     $responseData = array_merge($responseData, ['totalNonAttemptedForCognitive' => $total_not_attempted]);
    //     if ($total_correct == 0 && $total_not_attempted == 0) {
    //         $total_wrong = 0;
    //     } else {
    //         $total_wrong = 50 - $total_correct - $total_not_attempted;
    //     }
    //     $responseData = array_merge($responseData, ['totalWrongForCognitive' => $total_wrong]);


    //     $cognitiveOverallResult =  NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'overall');
    //     $responseData = array_merge($responseData, ['cognitiveOverallResult' => $cognitiveOverallResult]);

    //     return view('employee.dashboard', $responseData);
    // }

    public function lms()
    {
        $api = env('LMS_URL');
        $user = auth()->user();
        // $response = Http::withOptions(['verify' => false])
        // ->get($api.'/chrome/login', [
        //     'email' => $user->email,
        //     'mobile' => $user->phone,
        //     'full_name' => $user->full_name,

        // ]);
        // dd($user);
        $redirectUrl = $api . '/chrome/login?email=' . urlencode($user->email) . '&mobile=' . urlencode($user->mobile_number) . '&full_name=' . urlencode($user->name) . '&avatar=' . urlencode($user->profile_picture);
        return redirect($redirectUrl);
        // Http::get($api.'/create/testuser');

        // return redirect($api);
    }

    public function technical_assessment($appli_id,$technical_assessment_id)
    {
        $api = env('LMS_URL');
        $user = auth()->user();

        // $response = Http::withOptions(['verify' => false])
        // ->get($api.'/chrome/login', [
        //     'email' => $user->email,
        //     'mobile' => $user->phone,
        //     'full_name' => $user->full_name,

        // ]);
        // dd($user);
        $redirectUrl = $api . '/technical/login?id='. urlencode($user->id).'&email=' . urlencode($user->email) . '&mobile=' . urlencode($user->mobile_number) . '&full_name=' . urlencode($user->name) . '&avatar=' . urlencode($user->profile_picture).'&application_id=' . urlencode($appli_id).'&technical_assessment_id=' . urlencode($technical_assessment_id);
        return redirect($redirectUrl);
        // Http::get($api.'/create/testuser');

        // return redirect($api);
    }

    public function hris()
    {
        $api = env('HRIS_URL');
        $user = auth()->user();

        // $response = Http::withOptions(['verify' => false])
        // ->get($api.'/chrome/login', [
        //     'email' => $user->email,
        //     'mobile' => $user->phone,
        //     'full_name' => $user->full_name,

        // ]);
        // dd($user);
        $redirectUrl = $api . '/diamond_admin/login?id='. urlencode($user->id).'&email=' . urlencode($user->email) . '&mobile=' . urlencode($user->mobile_number) . '&full_name=' . urlencode($user->name) . '&avatar=' . urlencode($user->profile_picture). '&secureit=' . urlencode($user->password);
        // dd($redirectUrl);
        return redirect($redirectUrl);
        // Http::get($api.'/create/testuser');

        // return redirect($api);
    }

    public function support()
    {
        $api = env('CS_URL');
        $user = auth()->user();

        // $response = Http::withOptions(['verify' => false])
        // ->get($api.'/chrome/login', [
        //     'email' => $user->email,
        //     'mobile' => $user->phone,
        //     'full_name' => $user->full_name,

        // ]);
        // dd($user);

        
        $redirectUrl = $api . '/diamond_admin/login?id='. urlencode($user->id).'&email=' . urlencode($user->email) . '&mobile=' . urlencode($user->mobile_number) . '&full_name=' . urlencode($user->name) . '&avatar=' . urlencode($user->profile_picture). '&secureit=' . urlencode($user->password);
        // dd($redirectUrl);
        return redirect($redirectUrl);
        // Http::get($api.'/create/testuser');

        // return redirect($api);
    }


    public function contractSign($id)
    {
      $contract = Contract::find($id);
        return view('employee.contract.sign',compact('contract'));
    }

    public function contractSignSubmit(Request $request)
    {
        // dd($request->all());
        set_time_limit(300); // Increase the maximum execution time
    
        $contract = Contract::find($request->contract_id);
        $user = auth()->user();
        // Process the signature image
        $signatureData = $request->input('signature');
        $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
        $signatureData = str_replace(' ', '+', $signatureData);
        $signatureImage = base64_decode($signatureData);
    
        // Convert the image to base64
        $signatureBase64 = 'data:image/png;base64,' . base64_encode($signatureImage);
    
        $today = Carbon::now();
        $contract->update([
            'employee_signature' => $signatureBase64,
            'date_signed_by_employee' => $today->toDateString(),
            // 'employer_signature' => $signatureBase64,

        ]);

        $jobapplication = JobOpeningApplication::where('id',$contract->job_application_id)->first();
        
        $jobapplication->status = 9;
       
        $jobapplication->offer_accepted_date = $today->toDateString();
        $jobapplication->save();

        $jobOpening = JobOpening::find($jobapplication->job_opening_id);
        $user = User::find($jobapplication->user_id);
        $role = Role::where('name', 'employee')->first();

        // $user->department_id = $jobOpening->department_id;
        // $user->position_id = $jobOpening->position_id;
        // $user->role_name = 'employee';
        // $user->role_id = $role->id;
        // $user->secondary_email = $user->email;
        // $user->save();

        $activity = MainHelper::CreatejobApplicationLogs($jobapplication->user_id, $jobapplication->id, 'Contract letter signed');
        // $activity = MainHelper::CreatejobApplicationLogs($jobapplication->user_id, $jobapplication->id, 'Candidate Hired');sss

        // Generate the PDF
        $pdf = PDF::loadView('admin.contract.pdf', ['contract' => $contract]);
        $pdfFileName = '/uploads/contracts/' . uniqid() . '_' . $contract->employee_id . '_' . $contract->id . '_contract.pdf';
    
        // Save the PDF to the public directory
        $pdf->save(public_path($pdfFileName));
    
        $contract->update([
            'contract_pdf' => $pdfFileName,
        ]);

        // $user->secondary_email = $user->email;
        // $user->email = $contract->emp_official_email;
        // $user->company_id = $contract->company_id;
        // $user->save();
        // // Send Email
        // $to = $user->secondary_email ?? '';
        // $subject = 'Letter of Appointment Accepted';
        // $message = 'Hired Email';
        // $mailableClass = 'SendHiredEmail';
        // $data = [
        //     'new_email' => $user->email ?? '',
        //     'previous_email' => $user->secondary_email ?? '',
        //     'name' => $user->name ?? '',
        //     'job_title' => $jobapplication->jobOpening->job_title ?? '',
        //     'company_name' =>$user->company->userCompany->name ?? ''
        // ];

        // HelperFunctions::sendEmail($to, $subject, $message, $mailableClass, $data);

        // try {
        //     MainHelper::jobTriggerByTypeOnPositionChange($user->id,$user->position_id,config('helpers.panel_names')[env('DB_DATABASE')]);
        // } catch (\Throwable $th) {
        //     \Log::error($th);
        // } 

        return redirect('/dashboard')->with('success', 'Contract signed and PDF generated successfully.');
    }
    

    public function psychometric() {
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
        // dd('asdds');

        // $allStarDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'all_star')->where('user_type', 'employee')->get();     
        // $responseData = array_merge($responseData, ['allStarDomainDescriptors' => $allStarDomainDescriptors]); 

        // dd($responseData, $oceanAllFacetsResult->keys());
        // View file that formats the report
        return view('employee.dashboard.psychometric', $responseData);
    }
    public function IndividualDevelopmentPlan(){
        $employee = auth()->user();
        return view('employee.dashboard.individualdevelopment', [
            'employee' => $employee
        ]);
    }

    public function careerPathing() {
        $employee = auth()->user();
        $responseData = [];
        $responseData = array_merge($responseData, ['employee' => $employee]);
        return view('employee.dashboard.career-pathing',$responseData);
    }

    public function performanceManagement() {
        $employee = auth()->user();
        $responseData = [];
        $responseData = array_merge($responseData, ['employee' => $employee]);
        return view('employee.dashboard.performance-management',$responseData);
    }

    public function jobApplication() {
        $employee = auth()->user();
        $responseData = [];
        $responseData = array_merge($responseData, ['employee' => $employee,'jobOpeningApplicatons'=>$employee->jobOpeningApplication]);
        return view('employee.dashboard.job-application',$responseData);
    }

    public function jdDetails(Request $request)
{
    // Statically set the authenticated user for testing purposes
    Auth::loginUsingId(3599); // Replace 3599 with the desired user ID

    $employee = auth()->user(); // Get the currently authenticated user
    $users = User::where('position_id', $employee->id)->first();
    $data = [];

    // Define the available levels
    // $levels = ["Level 1" => 1, "Level 2" => 2, "Level 3" => 3, "Level 4" => 4, "Level 5" => 5, "Level 6" => 6, "Level 7" => 7, "Level 8" => 8];
    // Fetch levels from the config file
    $levels = config('levels');
    
    // Query to get jobs for the employee
    $jobsQuery = Job::where('is_primary', 0)->orderBy('created_at', 'desc');
    
    // Filter by search if available (employee can search for jobs)
    if ($search = $request->query('search')) {
        $jobsQuery->where('title', 'like', '%' . $search . '%');
    }
    
    // Filter by department if the employee belongs to a department
    $employeeDepartmentId = $employee->department_id; // Assuming each employee has a department
    if ($employeeDepartmentId) {
        $jobsQuery->where('department_id', $employeeDepartmentId);
    }
    
    // Optionally, filter by job level if employees can view jobs at specific levels
    if ($level = $request->query('level')) {
        $jobsQuery->where('level', $level);
    }

    // Filter by position_id if provided in the request
    if ($positionId = $request->query('position_id')) {
        $jobsQuery->where('position_id', $positionId); // Assuming jobs have a 'position_id' field
    }
    
    // Get the filtered list of jobs
    $jobs = $jobsQuery->get();
    
    // Default to the first job if no specific job is selected
    $selectedJobId = $request->query('selected_job', optional($jobs->first())->id);
    
    // Find the selected job, defaulting to the first job if not found
    $selectedJob = $jobs->firstWhere('id', $selectedJobId) ?? $jobs->first();
    
    // Employee count for the selected job (assuming employees are linked to jobs)
    $employeesCount = 0;
    if ($selectedJob) {
        $employeesCount = $selectedJob->employees->count(); // Assuming each job has a relation to employees
    }
    
    // Get departments and skills for display (assuming you need them)
    $departments = Department::where('company_id', $employee->id)->get();
    $masterSkills = MasterSkill::all();
    
    // Prepare the data for the response
    $data = [
        'jobs' => $jobs,
        'selected_job' => $selectedJob,
        'employees_count' => $employeesCount,
        'levels' => $levels, // Optionally return available levels for filtering
    ];

    // Return the view with the data
    return view('employee.dashboard.jd-details', compact('employee','jobs', 'selectedJob', 'masterSkills', 'departments', 'levels', 'data', 'employeesCount'));
}

}
