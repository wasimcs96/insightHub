<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterCity;
use App\Models\MasterCountry;
use App\Models\MasterEducationLevel;
use App\Models\MasterEducationYear;
use App\Models\MasterEducationProgram;
use App\Models\MasterIndustry;
use App\Models\MasterOpportunitiesForGrowth;
use App\Models\JobSkill;
use App\Models\TechnicalSkill;
use App\Models\JobOpening;
use App\Models\JobOpeningApplication;
use App\Models\JobOpeningCity;
use App\Models\JobOpeningCountry;
use App\Models\MasterState;
use App\Models\JobOpeningJobSkill;
use App\Models\JobOpeningJobTechnicalSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Helpers\HelperFunctions;
use App\Models\User;
use App\Models\Role;
use App\Models\Position;
use App\Models\Department;
use App\Models\QuizDomainValueAnswer;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendAssessmentEmailsJob;
use App\Helpers\AssessmentHelper;
use App\Helpers\NewAssessmentHelper;
use Illuminate\Support\Str;
use App\Models\Job;
use App\Models\UserInterviewResponse;
use App\Models\JobTechnicalSkills;
use App\Models\MasterBarangay;
use App\Models\MasterProvince;
use App\Models\MasterSkill;
use App\Models\MasterTechnicalSkill;
use App\Models\ActivityLog;
use App\Helpers\MainHelper;
use App\Models\UserResult;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;




class JobOpeningsController extends Controller
{

    public function jobDashboard(Request $request) {

        // dd(auth()->user()->company_id);
        
        $data = Department::where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)
                    ->where('status', 1)
                    ->with('jobs') // Eager load jobs
                    ->get()
                    ->map(function ($department) {
                        // Get all the job IDs for this department
                        
                        $jobIds = $department->jobs->pluck('id');
                
                        // If there are no jobs, return the department as it is
                        if ($jobIds->isEmpty()) {
                            $department->vacancies = 0;
                            return $department;
                        }
                
                        // Get the total heads for all jobs in this department
                        $totalHeads = $department->jobs->sum('heads');
                
                        // Get the total number of users assigned to jobs in this department
                        $totalEmployees = User::whereIn('position_id', $jobIds)->count();
                
                        // Calculate vacancies
                        $department->total_vacancies = $totalHeads - $totalEmployees;
                        if($department->total_vacancies < 0) {
                            $department->total_vacancies = 0;
                        }
                        $department->total_heads = $totalHeads;
                        $department->total_employees = $totalEmployees;
                        $department->total_job_positions = count($jobIds);
                
                        return $department;
                    });

                    // dd($data);

        return view('admin.job-openings.job_dashboard', compact('data'));
    }

    // Display a listing of the job openings.
    public function index(Request $request) {
        
        $query = JobOpening::query()->withCount('job_applications');

        if(auth()->user()->company_id) {
            $company_id = auth()->user()->company_id;
        } else {
            $company_id = 3;
        }

        $query->where('company_id', $company_id);

        if ($request->filled('sort')) {
            if($request->sort_type) {
                $sort_type = $request->sort_type;
            } else {
                $sort_type = 'desc';
            }
            if ($request->sort == 'created_date') {
                $query->orderBy('created_at', $sort_type);
            } elseif ($request->sort == 'applicant_count') {
                $query->withCount('job_applications')->orderBy('job_applications_count', $sort_type);
            } elseif ($request->sort == 'vacancy') {
                $query->orderBy('vacancies', $sort_type);
            }
        }
        

        // Adjusted filters for company_id and position_id
        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
            // Setting department_id variable directly
            session(['job_opening_department_id' => $request->department_id]);

        }

        if (auth()->user()->isDepartment()) {
            $query->where('department_id', auth()->user()->department_id);
        }

        if ($request->filled('position_id')) {
            $query->where('position_id', $request->position_id);
        }

        // New filter for employment_type
        if ($request->filled('employment_type')) {
            $query->where('employment_type', $request->employment_type);
        }

        // Adjusted search logic for job_title
        if ($request->filled('search')) {
            $query->where('job_title', 'LIKE', '%' . $request->search . '%');
        }

    $jobOpenings = $query->paginate(10);

        $departments = Department::where('company_id', $company_id)->where('status',1)->get();

        if (auth()->user()->isDepartment()) {
            $departments = Department::where('id', auth()->user()->department_id)->where('status',1)->get();
        }

        return view('admin.job-openings.index', compact('jobOpenings', 'departments'));
    }

    public function vacancy(Request $request)
    {
 
        $query = Job::where('saved_job',1)
        ->where('status', 2)
        ->where('is_primary', 0)
        ->withCount(['employees as employees_count' => function ($query) {
            $query->whereColumn('position_id', 'jobs.id');
        }])
        ->havingRaw('heads > (SELECT COUNT(*) FROM users WHERE users.position_id = jobs.id)')
        ->whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('job_openings')
                  ->whereColumn('job_openings.position_id', 'jobs.id');
        });

        if(auth()->user()->company_id) {
            $company_id = auth()->user()->company_id;
        } else {
            $company_id = 3;
        }

        if ($request->filled('sort')) {
            if($request->sort_type) {
                $sort_type = $request->sort_type;
            } else {
                $sort_type = 'desc';
            }
            if ($request->sort == 'created_date') {
                $query->orderBy('created_at', $sort_type);
            } elseif ($request->sort == 'applicant_count') {
                $query->withCount('job_applications')->orderBy('job_applications_count', $sort_type);
            } elseif ($request->sort == 'vacancy') {
                $query->orderBy('vacancies', $sort_type);
            }
        }
        

        // Adjusted filters for company_id and position_id
        if ($request->filled('department_id')) {
            $query->where('org_department', $request->department_id);
            // Setting department_id variable directly
            // session(['job_opening_department_id' => $request->department_id]);

        }

        if (auth()->user()->isDepartment()) {
            $query->where('department_id', auth()->user()->department_id);
        }

        if ($request->filled('position_id')) {
            $query->where('position_id', $request->position_id);
        }

        // New filter for employment_type
        if ($request->filled('employment_type')) {
            $query->where('employment_type', $request->employment_type);
        }

        // Adjusted search logic for job_title
        if ($request->filled('search')) {
            $query->where('job_title', 'LIKE', '%' . $request->search . '%');
        }

        $vacancies = $query->paginate();

        $departments = Department::where('company_id', $company_id)->where('status',1)->get();

        if (auth()->user()->isDepartment()) {
            $departments = Department::where('id', auth()->user()->department_id)->where('status',1)->get();
        }

        return view('admin.job-openings.vacancy', compact('vacancies', 'departments'));

    }


    // Show the form for creating a new job opening.
    public function showCreateForm() {
        $companies = [];
        $isParent = 0;
        $departments = [];
        $isSubsidiary = 0;

        if (auth()->user()->role->name == Role::$admin) {
            $isParent = 1;
            $companies = User::where('role_name',Role::$company)->select('name', 'id')->orderBy('created_at', 'DESC')->get();
        }

        // $states = \App\Models\MasterState::all();
        $provinces = \App\Models\MasterProvince::all();
        // $barangays = \App\Models\MasterBarangay::select('id', 'name')->get();
        // $jobs = \App\Models\Job::all();
        // $cities = \App\Models\MasterCity::all();
        $education_levels = \App\Models\MasterEducationLevel::all();
        $education_years = \App\Models\MasterEducationYear::all();
        $education_programs = \App\Models\MasterEducationProgram::all();
        $industries = \App\Models\MasterIndustry::all();
        // $job_skills = \App\Models\JobSkill::all();
        // $job_technical_skills = \App\Models\TechnicalSkill::all();
        $countries = \App\Models\MasterCountry::all();

        // if (auth()->user()->role->name == Role::$company) {
        //     $isSubsidiary = 1;
        //     $departments = Department::where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->pluck('name', 'id');
        // }
        $departments = Department::where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->get();

        return view('admin.job-openings.create', compact('isParent','companies','isSubsidiary','departments','provinces','education_levels','education_years','education_programs','industries','countries'));
    }

    // Store a newly created job opening in storage.
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            // 'job_title' => 'required|string|max:510',
            'company_id' => 'nullable|integer',
            'department_id' => 'required|integer',
            'job_id' => 'required|integer',
            'job_title' => 'required',

            // 'user_type' => 'required|integer|min:1|max:2',
            'vacancies' => 'required|integer',
            'status' => 'required|integer|min:1|max:2',
            'employment_type' => 'required|integer|min:1|max:2',
            'salary_upper_bound' => 'required|integer',
            'salary_lower_bound' => 'required|integer',
            'work_experience' => 'required|integer',
            'overview_of_company' => 'required',
            // 'certificate' => 'required',
            'job_role_description' => 'required',
            // 'industry_id' => 'required|integer',
            'education_level_id' => 'required|integer',
            // 'education_year_id' => 'required|integer',
            'education_program_id' => 'required|integer',
            'cities.*' => 'required|integer|exists:master_cities,id',
            'states.*' => 'required|integer|exists:master_states,id', // Assumes 'cities' table exists with an 'id' column
            'barangays.*' => 'required|integer|exists:barangays,id', // Assumes 'barangays' table exists with an 'id' column

             // Assumes 'cities' table exists with an 'id' column
            'countries.*' => 'required|integer|exists:master_countries,id',
            'titles.*' => 'required|integer|exists:jobs,id',

            'job_skills.*' => 'required|integer|exists:job_skills,id', // Assumes 'job_skills' table exists with an 'id' column
            'job_technical_skills.*' => 'required|integer|exists:technical_skills,id', // Assumes 'job_technical_skills' table exists with an 'id' column
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // dd($request->all());

        $scalarFields = $request->except(['job_skills', 'job_technical_skills']);
        $slug = $this->createUniqueSlug($request->job_title);
        $scalarFields['slug'] = $slug;
        $scalarFields['company_id'] = auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id;
        $scalarFields['position_id'] = $request->job_id ?? '';
        $scalarFields['salary'] = ($request->salary_lower_bound + $request->salary_upper_bound) / 2;

        $jobOpening = JobOpening::create($scalarFields);
    

        // if (isset($request->cities)){
        //     foreach($request->cities as $city){
        //         JobOpeningCity::create([
        //             'job_opening_id' => $jobOpening->id,
        //             'city_id' => $city
        //         ]);
        //     }
        // }

        
        // if (isset($request->titles)){
        //     foreach($request->titles as $title){
        //         Job::create([
        //             'job_opening_id' => $jobOpening->id,
        //             'title_id' => $title
        //         ]);
        //     }
        // }


        // if (isset($request->countries)){
        //     foreach($request->countries as $country){
        //         JobOpeningCountry::create([
        //             'job_opening_id' => $jobOpening->id,
        //             'country_id' => $country
        //         ]);
        //     }
        // }

 

        if (isset($request->job_skills)){
            foreach($request->job_skills as $job_skill){
                JobOpeningJobSkill::create([
                    'job_opening_id' => $jobOpening->id,
                    'job_skill_id' => $job_skill
                ]);
            }
        }

        if (isset($request->job_technical_skills)){
            foreach($request->job_technical_skills as $job_technical_skill){
                JobOpeningJobTechnicalSkill::create([
                    'job_opening_id' => $jobOpening->id,
                    'job_technical_skill_id' => $job_technical_skill
                ]);
            }
        }

        // return redirect()->route('admin.job-openings.index', ['department_id' => $request->department_id])
        //          ->with('success', 'Job opening created successfully.');

         return redirect()->route('admin.job-openings.index')
        ->with('success', 'Job opening created successfully.');
    }

    // public function getState(Request $request){
    //     echo "assas";
    // }

    // Display the specified job opening.
    public function show(Request $request, $id) {
        $jobOpening = JobOpening::with(['education_level', 'education_year', 'education_program', 'industry', 'cities', 'job_skills', 'job_technical_skills'])->findOrFail($id);
        // $query = JobOpeningApplication::where('job_opening_id', $id);
        $query = JobOpeningApplication::select('job_opening_applications.*') // Select all columns from job_opening_applications
                ->where('job_opening_id', $id)
                ->join('users', 'users.id', '=', 'job_opening_applications.user_id');
        // New filter for status
        if ($request->filled('status')) {
            $query->where('job_opening_applications.status', $request->status);
        }    
        
        if ($request->filled('education_level')) {
            $query->where('users.education_level', $request->education_level);
        }

        // Adjusted search logic for job_title
        if ($request->filled('search')) {
            $query->where('job_opening_applications.external_user_name', 'LIKE', '%' . $request->search . '%');
        }

        $order = $request->input('order', 'asc'); // default sorting order
        $sort = $request->input('sort', 'matching_percentage'); // default column to sort
         
        $query->orderBy($sort, $order);
        $jobOpeningApplications = $query->paginate();
        return view('admin.job-openings.show', compact('jobOpening','jobOpeningApplications'));
    }
    // Show the form for editing the specified job opening.

    public function showEditForm($id)
    {
        // $jobOpening = JobOpening::with(['company', 'department', 'position'])->findOrFail($id);
        $jobOpening = JobOpening::with(['cities', 'job_skills', 'job_technical_skills'])->findOrFail($id);
   
        // Assuming these methods exist and fetch necessary data
        // $companies = Company::all();
        // $departments = Department::all();
        // $positions = Position::all();
        $job_position_technical_skill_ids = [];
        // $cities = MasterCity::all();
        $countries = MasterCountry::all();
        $education_levels = MasterEducationLevel::all();
        $education_years = MasterEducationYear::all();
        $education_programs = MasterEducationProgram::all();
        $industries = MasterIndustry::all();
        $master_job_skills= MasterSkill::all();
        $job_skills = JobSkill::all();
        // $states = \App\Models\MasterState::all();
        $provinces = \App\Models\MasterProvince::all();
        $barangays = \App\Models\MasterBarangay::select('id', 'name')->get();
        $jobs = \App\Models\Job::all();      

     
        if(isset($jobOpening->job_technical_skills) && $jobOpening->job_technical_skills->count() !=0){
        $job_position_technical_skill_ids = JobTechnicalSkills::where('job_id', $jobOpening->position_id)->pluck('master_technical_skill_id')->toArray();
        }
        $job_technical_skills = MasterTechnicalSkill::whereIn('id', $job_position_technical_skill_ids)->get();
        $companies = [];
        $isParent = 0;
        $departments = [];
        $isSubsidiary = 0;

        if (auth()->user()->role->name == Role::$admin) {
            $isParent = 1;
            $companies = User::where('role_name',Role::$company)->select('name', 'id')->orderBy('created_at', 'DESC')->get();
        }

        if (auth()->user()->role->name == Role::$company) {
            $isSubsidiary = 1;
            $departments = User::where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->whereNull('department_id')->pluck('name', 'id');
        }

        $selected_job_skills = [];
        foreach ($jobOpening->job_skills as $selected_job_skill) {
            $selected_job_skills[] = $selected_job_skill->job_skill_id;
        }

        $selected_job_technical_skills = [];
        foreach ($jobOpening->job_technical_skills as $selected_job_technical_skill) {
            $selected_job_technical_skills[] = $selected_job_technical_skill->job_technical_skill_id;
        }

        return view('admin.job-openings.edit', compact(
            'jobOpening',
            // 'companies',
            // 'departments',
            // 'positions',
            // 'cities',
            'education_levels',
            'education_years',
            'education_programs',
            'industries',
            'job_skills',
            'job_technical_skills',
            'selected_job_skills',
            'selected_job_technical_skills',
            'isParent',
            'companies',
            'isSubsidiary',
            'departments',
            'countries',
            'master_job_skills',
            // 'states',
            'provinces',
            'barangays',
            'jobs'
        ));
    }


    // Update the specified job opening in storage.
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'job_title' => 'required|string|max:510',
            'company_id' => 'nullable|integer',
            'department_id' => 'nullable|integer',
            'position_id' => 'nullable|integer',
            'vacancies' => 'required|integer',
            // 'user_type' => 'required|integer|min:1|max:2',
            'status' => 'required|integer|min:1|max:2',
            'employment_type' => 'required|integer|min:1|max:2',
            'salary_upper_bound' => 'required|integer',
            'salary_lower_bound' => 'required|integer',

            'work_experience' => 'required|integer',
            'overview_of_company' => 'required',
            // 'certificate' => 'required',
            'job_role_description' => 'required',
            // 'industry_id' => 'required|integer',
            'education_level_id' => 'required|integer',
            // 'education_year_id' => 'required|integer',
            'education_program_id' => 'required|integer',
            'cities.*' => 'required|integer|exists:master_cities,id', // Assumes 'cities' table exists with an 'id' column
            'job_skills.*' => 'required|integer|exists:job_skills,id', // Assumes 'job_skills' table exists with an 'id' column
            'job_technical_skills.*' => 'required|integer|exists:technical_skills,id', // Assumes 'job_technical_skills' table exists with an 'id' column
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jobOpening = JobOpening::findOrFail($id);

        $scalarFields = $request->except(['cities', 'job_skills', 'job_technical_skills']);
        $slug = $this->createUniqueSlug($request->job_title, $id);
        $scalarFields['slug'] = $slug;
        $scalarFields['company_id'] = auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id;
        $scalarFields['position_id'] = $request->job_id ?? '';
        $scalarFields['salary'] = ($request->salary_lower_bound + $request->salary_upper_bound) / 2;

        $jobOpening->update($scalarFields);

        // if (isset($request->cities)){
        //     JobOpeningCity::where('job_opening_id', $jobOpening->id)->delete();
        //     foreach($request->cities as $city){
        //         JobOpeningCity::create([
        //             'job_opening_id' => $jobOpening->id,
        //             'city_id' => $city
        //         ]);
        //     }
        // } else {
        //     JobOpeningCity::where('job_opening_id', $jobOpening->id)->delete();
        // }

        if (isset($request->job_skills)){
            JobOpeningJobSkill::where('job_opening_id', $jobOpening->id)->delete();
            foreach($request->job_skills as $job_skill){
                JobOpeningJobSkill::create([
                    'job_opening_id' => $jobOpening->id,
                    'job_skill_id' => $job_skill
                ]);
            }
        } else {
            JobOpeningJobSkill::where('job_opening_id', $jobOpening->id)->delete();
        }

        if (isset($request->job_technical_skills)){
            JobOpeningJobTechnicalSkill::where('job_opening_id', $jobOpening->id)->delete();
            foreach($request->job_technical_skills as $job_technical_skill){
                JobOpeningJobTechnicalSkill::create([
                    'job_opening_id' => $jobOpening->id,
                    'job_technical_skill_id' => $job_technical_skill
                ]);
            }
        } else {
            JobOpeningJobTechnicalSkill::where('job_opening_id', $jobOpening->id)->delete();
        }

        return redirect()->route('admin.job-openings.index', ['department_id' => $request->department_id])->with('success', 'Job opening updated successfully.');
    }

    // Remove the specified job opening from storage.
    public function delete($id) {
        $jobOpening = JobOpening::findOrFail($id);
        $jobOpening->delete();

        return redirect()->route('admin.job-openings.index')->with('success', 'Job opening deleted successfully.');
    }

    public function applicantDetails($job_opening_application_id, $id) {
        
        // // Build the API URL for fetching job details, including the job ID in the endpoint
        // $apiUrl = env('API_URL') . "api/user-details/{$id}";

        // // Example API call with an x-api-key header
        // $response = Http::withHeaders([
        //     'x-api-key' => env('API_KEY'),
        // ])->get($apiUrl);

        // // Check if the request was successful
        // if ($response->successful()) {
            // Assuming the API returns a JSON response, which is automatically converted to an array
            // $applicantDetails = $response->json();
            // $user = User::where('external_user_id', $applicantDetails['data']['id'])->first();
            // $job_opening_application = JobOpeningApplication::find($job_opening_application_id);
            // if($job_opening_application->status == 10) {
            //     $user = User::where('secondary_email', $applicantDetails['data']['email'])->first();
            // } else {
            //     $user = User::where('email', $applicantDetails['data']['email'])->first();
            // }
            $user = User::find($id);
            $descriptors = DB::table('master_descriptors')->where('user_type', 'candidate')->get();
            $user_results = [];
            $userResultExistence = UserResult::where('user_id', $user->id)->get();
            $isUserResultExists = 0;

            if (!$userResultExistence->isEmpty()) {
                $isUserResultExists = 1;
            } else {
                $isUserResultExists = 0;
            }
            $responseData = [];
            // dd($user->is_all_assessments_completed);
            if(($user) && ($user->is_all_assessments_completed == 1) && ($isUserResultExists)) {
                $user_id = $user->id;

                // OCEAN Result

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
        
                $results = UserResult::where('user_id', $user_id)->get();
        
                $cognitiveOverallResult =  NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'overall', $user->role_name, $descriptors);
                $responseData = array_merge($responseData, ['cognitiveOverallResult' => $cognitiveOverallResult]);
        
                $totalMarksForCognitive = $cognitiveOverallResult['cognitive']['score'] ?? 0;
                $responseData = array_merge($responseData, ['totalMarksForCognitive' => $totalMarksForCognitive]);
        
                $cognitiveDomainResult =  NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'domains', $user->role_name, $descriptors);
                $responseData = array_merge($responseData, ['cognitiveDomainResult' => $cognitiveDomainResult]);
        
                
                $oceanDomainResults = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'domains', $user->role_name, $descriptors);
                $responseData = array_merge($responseData, ['oceanDomainResult' => $oceanDomainResults]);
        
                $oceanAllFacetsResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'all_facets', $user->role_name, $descriptors);
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
         
                $riasecDomainResult = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'domains', $user->role_name, $descriptors);
                $responseData = array_merge($responseData, ['riasecDomainResult' => $riasecDomainResult]);
        
                $riasecTop3Results = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'top_3_riasec');
        
                $riasecTop3Result['string'] = $riasecTop3Results['top-3-riasec']['level_description'] ?? '';
                $riasecTop3Result['array'] = str_split($riasecTop3Result['string']) ?? [];
                $riasecTop3Result['description'] = $riasecTop3Results['top-3-riasec']['description'] ?? '';
                $responseData = array_merge($responseData, ['riasecTop3Result' => $riasecTop3Result]);
        
                $ccsResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'ccs', $user->role_name, $descriptors);
                $responseData = array_merge($responseData, ['ccsResult' => $ccsResult]);
        
                $personalityTypeResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'personality_type');
                $responseData = array_merge($responseData, ['personalityTypeResult' => $personalityTypeResult]);
        
                $flightRiskResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'flight_risk', $user->role_name, $descriptors);
                $responseData = array_merge($responseData, ['flightRiskResult' => $flightRiskResult]);
        
                $organizationalFitForecastResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'organizational_fit_forecast', $user->role_name, $descriptors);
                $responseData = array_merge($responseData, ['organizationalFitForecastResult' => $organizationalFitForecastResult]);
        
                $growthPotentialResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'growth_potential', $user->role_name, $descriptors);
                $responseData = array_merge($responseData, ['growthPotentialResult' => $growthPotentialResult]);
        
                $rciResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'rci', $user->role_name, $descriptors);
                $responseData = array_merge($responseData, ['rciResult' => $rciResult]);
        
                
                $oceanSelfResult = [];
        
                $oceanSelfResult['Openness to Experience'] = $oceanDomainResults['openness-to-experience']['score'] ?? 0;
                $oceanSelfResult['Conscientiousness'] = $oceanDomainResults['conscientiousness']['score'] ?? 0;
                $oceanSelfResult['Extraversion'] = $oceanDomainResults['extraversion']['score'] ?? 0;
                $oceanSelfResult['Agreeableness'] = $oceanDomainResults['agreeableness']['score'] ?? 0;
                $oceanSelfResult['Emotional Stability'] = $oceanDomainResults['emotional-stability']['score'] ?? 0;
        
                $learningStyle = AssessmentHelper::getLearningStyle($user_id,$oceanSelfResult);
        
                $responseData = array_merge($responseData, ['learningStyle' => $learningStyle]);


                $jobOpeningApplication = JobOpeningApplication::find($job_opening_application_id);
                $activitylogs = ActivityLog::where('user_id',$user->id)->where('job_application_id',$jobOpeningApplication->id)->get();
                // Pass the job details to your view

                $responseData = array_merge($responseData, ['user_results' => $user_results]);
                $responseData = array_merge($responseData, ['jobOpeningApplication' => $jobOpeningApplication]);
                $responseData = array_merge($responseData, ['user' => $user]);
                $responseData = array_merge($responseData, ['isUserResultExists' => $isUserResultExists]);
                $responseData = array_merge($responseData, ['activitylogs' => $activitylogs]);
                $responseData = array_merge($responseData, ['isResultAvailable' => 1]);

                $oceanDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'domains')->where('user_type', 'employee')->take(20)->get();      
            $responseData = array_merge($responseData, ['oceanDomainDescriptors' => $oceanDomainDescriptors]); 

            $riasecDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'riasec')->where('result_type', 'domains')->where('user_type', 'employee')->get();     
            $responseData = array_merge($responseData, ['riasecDomainDescriptors' => $riasecDomainDescriptors]); 

            $ccsDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'ccs')->where('user_type', 'employee')->get();     
            $responseData = array_merge($responseData, ['ccsDomainDescriptors' => $ccsDomainDescriptors]); 

            $learningAndDevelopmentPlanDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'learning_and_development_plan')->where('user_type', 'employee')->get();     
            $responseData = array_merge($responseData, ['learningAndDevelopmentPlanDescriptors' => $learningAndDevelopmentPlanDescriptors]); 

                return view('admin.job-openings.applicant-details', $responseData);

            }
            $jobOpeningApplication = JobOpeningApplication::find($job_opening_application_id);
            $activitylogs = ActivityLog::where('user_id',$user->id)->where('job_application_id',$jobOpeningApplication->id)->get();

            $responseData = array_merge($responseData, ['user_results' => $user_results]);
            $responseData = array_merge($responseData, ['jobOpeningApplication' => $jobOpeningApplication]);
            $responseData = array_merge($responseData, ['user' => $user]);
            $responseData = array_merge($responseData, ['isUserResultExists' => $isUserResultExists]);
            $responseData = array_merge($responseData, ['activitylogs' => $activitylogs]);
            $responseData = array_merge($responseData, ['isResultAvailable' => 0]);
// dd("gfsdjfg");
            // Pass the job details to your view
            return view('admin.job-openings.applicant-details', $responseData);
        // } else {
        //     // Log the error and return a default response
        //     \Log::error('Applicant detail API failed', ['response' => $response->body()]);
        //     return redirect()->back()->with('error', 'Failed to retrieve applicant details.');
        // }
    }


    public function sendEmail($id) {

        $application = JobOpeningApplication::find($id);
        
        // $user = User::where('email', $application->external_user_email)->first();
        $activity = MainHelper::CreatejobApplicationLogs($application->user_id, $application->id, 'Email sent to the Candidate');
        $user = User::where('id', $application->user_id)->first();

        if($user) {

            $user->role_id = 8;
            $user->role_name = 'candidate';
            $user->save();
          
        }

        // $application->user_id = $user->id;
        if($application->status < 2) {
            $application->status = 2;
        }
        
        $application->save();


        // $apiUrl = env('API_URL') . "api/update-application-status/{$application->id}";

        // $response = Http::post($apiUrl, [
        //                     'status' => 3,
        //                 ]);
        // if (!$response->successful()) {
        //     $errorResponse = $response->json();
        //     \Log::error('Failed to update application status via API', [
        //         'application_id' => $application->id,
        //         'response' => $errorResponse,
        //     ]);
        // }

        // Send Email
        $to = $user->email;
        $subject = 'Assessment Email';
        $message = 'This is the assessment email';
        $mailableClass = 'SendAssessmentEmail';
        $data = [
            'email' => $application->external_user_email ?? '',
            'password' => $application->external_user_email ?? '',
            'name' => $application->external_user_name ?? '',
            'job_title' => $application->jobOpening->job_title ?? '',
            'company_name' => $application->jobOpening->company->name ?? ''
        ];

        HelperFunctions::sendEmail($to, $subject, $message, $mailableClass, $data);

        return redirect()->back()->with('success', 'Email Sent Successfully');
    }

    public function sendEmails(Request $request, $id) {

        // $application_emails = JobOpeningApplication::where('matching_percentage', '>=', $request->matching_percentage)->pluck('external_user_email')->toArray();
        $application_emails = [];
        $applications = JobOpeningApplication::where('job_opening_id', $id)->where('matching_percentage', '>=', $request->matching_percentage)->where('application_status', 1)->get();
        SendAssessmentEmailsJob::dispatch($applications);


       return redirect()->back()->with('success', 'Email Will Be Sent Successfully');
    }

    // public function sendEmailsToSelected(Request $request) {

    //     $applicationIds = $request->input('applicant_ids');
        
    //     // $jobOpeningId = $request->input('job_opening_id'); 
    //     if ($applicationIds && count($applicationIds) > 0) {
    //         // $applications = JobOpeningApplication::where('job_opening_id', $jobOpeningId)->whereIn('user_id', $userIds)->where('application_status', 1)->get();
    //         $applications = JobOpeningApplication::whereIn('id', $applicationIds)->where('application_status', 1)->get();
           
    //         if($applications){
    //             // SendAssessmentEmailsJob::dispatch($applications);
    //             $application_emails = [];
    //             foreach($applications  as $application) {
                   
    //                 try {
    //                     $user = User::where('id', $application->user_id)->first();
    //                     $job_opening_id = $application->job_opening_id;
        
                      
    //                     if($user) {
        
    //                         $user->role_id = 8;
    //                         $user->role_name = 'candidate';
    //                         $user->save();
                          
    //                     }
    //                     // $application->user_id = $user->id;
    //                     // if($application->status < 3) {
    //                         $application->status = 2;
    //                     // }
    //                     $application->save();
        
    //                     $application_emails[] = $application->external_user_email;
    //                 } catch (\Exception $e) {
    //                     // Exception handling
    //                     \Log::error('An error occurred while creating external user in the system: ' . $e->getMessage());
    //                 }
                   
    //             }       
        
    //             // Send Email
    //             $subject = 'Assessment Email';
    //             $message = 'This is the assessment email';
    //             $mailableClass = 'SendAssessmentEmail';
        
    //             $job_opening = JobOpening::find($job_opening_id);
        
    //             $data['job_title'] = $job_opening->job_title ?? '';
    //             $data['company_name'] = $job_opening->company->name ?? '';
        
    //             HelperFunctions::sendEmails($application_emails, $subject, $message, $mailableClass, $data);
    //             return redirect()->back()->with('success', 'Emails sent successfully!');
    //         }else{
    //             return redirect()->back()->with('error', 'Application is withdrawal by candidate');

    //         }
            
    //     } else {
    //         return redirect()->back()->with('error', 'No users selected.');
    //     }
    //    return redirect()->back()->with('success', 'Email Will Be Sent Successfully');
    // }
    public function sendEmailsToSelected(Request $request) {
        $applicationIds = $request->input('applicant_ids');
        
        // Ensure applicationIds is not empty
        if ($applicationIds && count($applicationIds) > 0) {
            // Get the applications by their IDs and ensure their status is active (1)
            $applications = JobOpeningApplication::whereIn('id', $applicationIds)->where('application_status', 1)->get();
    
            if ($applications) {
                // Prepare an array to hold the emails of the selected applicants
                $application_emails = [];
    
                // Loop through the applications and gather email addresses
                foreach ($applications as $application) {
                    try {
                        $user = User::where('id', $application->user_id)->first();
                        $job_opening_id = $application->job_opening_id;
    
                        // If a user is found, set role and update status
                        if ($user) {
                            $user->role_id = 8;
                            $user->role_name = 'candidate';
                            $user->save();
                        }
    
                        // Change the application status to 2 (assigned)
                        $application->status = 2;
                        $application->save();
    
                        // Collect the email addresses to send the email to
                        $application_emails[] = $application->external_user_email;
                    } catch (\Exception $e) {
                        \Log::error('An error occurred while processing the application: ' . $e->getMessage());
                    }
                }
    
                // Prepare the dynamic email data
                $job_opening = JobOpening::find($job_opening_id);
                $data = [
                    'Employee Full Name' => $user->name ?? '',
                    'Employee First Name' => $user->first_name ?? '',
                    'Employee Middle Name' => $user->middle_name ?? '',
                    'Employee Last Name' => $user->last_name ?? '',
                    'job_title' => $job_opening->job_title ?? 'N/A',
                    'company_name' => auth()->user()->userCompany()->first()->name ?? 'Unknown Company',
                ];

                // Set template type
                $templateType = 'send_assessment_link';  // Template type for the assessment email
    
                // Send the emails using the global sendEmails function
                HelperFunctions::sendEmails($application_emails, $templateType, $data);
    
                return redirect()->back()->with('success', 'Emails sent successfully!');
            } else {
                return redirect()->back()->with('error', 'Applications have been withdrawn by candidates.');
            }
        } else {
            return redirect()->back()->with('error', 'No applicants selected.');
        }
    }
    
    

    // public function updateStatus(Request $request,$id)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'status' => 'required', // Adjust validation rules as needed
    //     ]);


    //     $jobOpeningApplication = JobOpeningApplication::find($id);
    //     // Update the job application's status
    //     $jobOpeningApplication->status = $request->status;
    //     $jobOpeningApplication->save();
    //     // dd($jobOpeningApplication);

    //     if($request->status == 4){
    //         $activity = MainHelper::CreatejobApplicationLogs($jobOpeningApplication->user_id, $jobOpeningApplication->id, 'Candidate Shortlisted');
    //     }elseif($request->status == 3){
    //         $activity = MainHelper::CreatejobApplicationLogs($jobOpeningApplication->user_id, $jobOpeningApplication->id, 'Candidate removed from Shortlist');
            
    //     }

    //     // if($request->status == 10) {
    //     //     $user = User::find($jobOpeningApplication->user_id);
    //     //     $job = JobOpening::find($jobOpeningApplication->job_opening_id);
    //     //     $user->email = $request->email;
    //     //     $user->role_id = 1;
    //     //     $user->role_name = Role::$employee;
    //     //     $user->company_id = $job->company_id;
    //     //     $user->department_id = $job->department_id;
    //     //     $user->position_id = $job->position_id;
    //     //     $user->is_external_user = 0;
    //     //     $user->save();

    //     //     $job->vacancies = $job->vacancies - 1;
    //     //     $job->save();
    //     // }
        

    //     if($request->status == 5) {
 
    //         $jobOpeningApplication->interview_date = $request->interview_date;
    //         $jobOpeningApplication->interviewer_name = $request->interviewer_name;
    //         $jobOpeningApplication->interview_mode = $request->interview_mode;
    //         $jobOpeningApplication->status = 5;
    //         $jobOpeningApplication->save();

    //         // Send Email
    //         $to = $jobOpeningApplication->external_user_email;
    //         $subject = 'Status Change Email';
    //         $message = 'This is the status change email';
    //         $mailableClass = 'SendInterviewInviteEmail';
    //         $data = [
    //             'status' => config('helpers.application_status')[5] ?? '',
    //             'company_name' => $jobOpeningApplication->jobOpening->company->name ?? '',
    //             'interview_date' =>$request->interview_date,
    //             'interviewer_name' =>$request->interviewer_name,
    //             'interview_mode' =>$request->interview_mode
    //         ];

    //         HelperFunctions::sendEmail($to, $subject, $message, $mailableClass, $data);

    //     } elseif ($request->status == 10) {
    //         $user = User::find($jobOpeningApplication->user_id);
    //         $job = JobOpening::find($jobOpeningApplication->job_opening_id);
    //         $user->email = $request->email;
    //         $user->secondary_email = $jobOpeningApplication->external_user_email;
    //         $user->role_id = 1;
    //         $user->role_name = Role::$employee;
    //         $user->company_id = $job->company_id;
    //         $user->department_id = $job->department_id;
    //         $user->position_id = $job->position_id;
    //         $user->is_external_user = 0;
    //         $user->save();

    //         $job->vacancies = $job->vacancies - 1;
    //         $job->save();

    //         // Send Email
    //         $to = $jobOpeningApplication->external_user_email;
    //         $subject = 'Hired Email';
    //         $message = 'Hired Email';
    //         $mailableClass = 'SendHiredEmail';
    //         $data = [
    //             'new_email' => $user->email ?? '',
    //             'previous_email' => $jobOpeningApplication->external_user_email ?? '',
    //             'name' => $jobOpeningApplication->external_user_name ?? '',
    //             'job_title' => $jobOpeningApplication->jobOpening->job_title ?? '',
    //             'company_name' => $jobOpeningApplication->jobOpening->company->name ?? ''
    //         ];

    //         HelperFunctions::sendEmail($to, $subject, $message, $mailableClass, $data);
    //     } else {
    //         // Send Email
    //         $to = $jobOpeningApplication->external_user_email;
    //         $subject = 'Status Change Email';
    //         $message = 'This is the status change email';
    //         $mailableClass = 'SendApplicationStatusChangeEmail';
    //         $data = [
    //             'status' => config('helpers.application_status')[$request->status] ?? '',
    //             'company_name' => $jobOpeningApplication->jobOpening->company->name ?? ''
    //         ];

    //         HelperFunctions::sendEmail($to, $subject, $message, $mailableClass, $data);
    //     }

    //     $apiUrl = env('API_URL') . "api/update-application-status/{$jobOpeningApplication->id}";

    //     $response = Http::withHeaders([
    //         'x-api-key' => env('API_KEY'),
    //     ])->post($apiUrl, [
    //         'status' => $request->status,
    //     ]);

    //     if (!$response->successful()) {
    //         $errorResponse = $response->json();
    //         \Log::error('Failed to update application status via API', [
    //             'application_id' => $jobOpeningApplication->id,
    //             'response' => $errorResponse,
    //         ]);
    //     }

    //     // Redirect back with a success message
    //     return back()->with('success', 'Application status updated successfully.');
    // }

        public function updateStatus(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'status' => 'required', // Adjust validation rules as needed
        ]);

        $jobOpeningApplication = JobOpeningApplication::find($id);
        // Update the job application's status
        $jobOpeningApplication->status = $request->status;
        $jobOpeningApplication->save();

        // Logging activity for specific status
        if ($request->status == 4) {
            $activity = MainHelper::CreatejobApplicationLogs($jobOpeningApplication->user_id, $jobOpeningApplication->id, 'Candidate Shortlisted');
        } elseif ($request->status == 3) {
            $activity = MainHelper::CreatejobApplicationLogs($jobOpeningApplication->user_id, $jobOpeningApplication->id, 'Candidate removed from Shortlist');
        }

        // Handling Interview Invitation (Status 5)
        if ($request->status == 5) {
            $jobOpeningApplication->interview_date = $request->interview_date;
            $jobOpeningApplication->interviewer_name = $request->interviewer_name;
            $jobOpeningApplication->interview_mode = $request->interview_mode;
            $jobOpeningApplication->status = 5;
            $jobOpeningApplication->save();

            // Send Interview Invitation Email using Helper function
            $to = $jobOpeningApplication->external_user_email;
            $templateType = 'send_interview_invite_email';  // Define the template type for interview invite
            $data = [
                'status' => config('helpers.application_status')[5] ?? '',
                'company_name' => $jobOpeningApplication->jobOpening->company->name ?? '',
                'Employee Full Name' => $user->name ?? '',
                'Employee First Name' => $user->first_name ?? '',
                'Employee Middle Name' => $user->middle_name ?? '',
                'Employee Last Name' => $user->last_name ?? '',
                'interview_date' => $request->interview_date,
                'interviewer_name' => $request->interviewer_name,
                'interview_mode' => $request->interview_mode,
            ];

            HelperFunctions::sendEmail($to, $templateType, $data);
        } 
        // Handling Hired Status (Status 10)
        elseif ($request->status == 10) {
            $user = User::find($jobOpeningApplication->user_id);
            $job = JobOpening::find($jobOpeningApplication->job_opening_id);
            $user->email = $request->email;
            $user->secondary_email = $jobOpeningApplication->external_user_email;
            $user->role_id = 1;
            $user->role_name = Role::$employee;
            $user->company_id = $job->company_id;
            $user->department_id = $job->department_id;
            $user->position_id = $job->position_id;
            $user->is_external_user = 0;
            $user->save();

            $job->vacancies = $job->vacancies - 1;
            $job->save();

            // Send Hired Email using Helper function
            $to = $jobOpeningApplication->external_user_email;
            $templateType = 'send_hired_email';  // Define the template type for hired email
            $data = [
                'new_email' => $user->email ?? '',
                'previous_email' => $jobOpeningApplication->external_user_email ?? '',
                'name' => $jobOpeningApplication->external_user_name ?? '',
                'job_title' => $jobOpeningApplication->jobOpening->job_title ?? '',
                'company_name' => $jobOpeningApplication->jobOpening->company->name ?? '',
                'Employee Full Name' => $user->name ?? '',
                'Employee First Name' => $user->first_name ?? '',
                'Employee Middle Name' => $user->middle_name ?? '',
                'Employee Last Name' => $user->last_name ?? ''
            ];

            HelperFunctions::sendEmail($to, $templateType, $data);
        } 
        // Handling Status Change (Default)
        else {
            // Send Status Change Email using Helper function
            $to = $jobOpeningApplication->external_user_email;
            $templateType = 'send_application_status_change_email';  // Define the template type for status change
            $data = [
                'Employee Full Name' => $user->name ?? '',
                'Employee First Name' => $user->first_name ?? '',
                'Employee Middle Name' => $user->middle_name ?? '',
                'Employee Last Name' => $user->last_name ?? '',
                'status' => config('helpers.application_status')[$request->status] ?? '',
                'company_name' => $jobOpeningApplication->jobOpening->company->name ?? ''
            ];

            HelperFunctions::sendEmail($to, $templateType, $data);
        }

        // Update application status via external API (Optional)
        $apiUrl = env('API_URL') . "api/update-application-status/{$jobOpeningApplication->id}";
        $response = Http::withHeaders([
            'x-api-key' => env('API_KEY'),
        ])->post($apiUrl, [
            'status' => $request->status,
        ]);

        if (!$response->successful()) {
            $errorResponse = $response->json();
            \Log::error('Failed to update application status via API', [
                'application_id' => $jobOpeningApplication->id,
                'response' => $errorResponse,
            ]);
        }

        // Redirect back with a success message
        return back()->with('success', 'Application status updated successfully.');
    }


    public function compareIndex(Request $request) {
        // dd($request->all());
        // $user_ids = JobOpeningApplication::where('job_opening_id', $job_opening_id)->pluck('user_id');
        $user_ids = JobOpeningApplication::whereIn('id', $request->applicant_ids)->pluck('user_id');
        // dd($user_ids);
        // $users = User::whereNotNull('first_name')->where('is_cognitive_ability_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_personality_motivation_completed', '=', 1)->whereIn('id', $user_ids)->get();

        $data = [];
        // $request_user_ids = $request->filled('request_user_ids') ?? [];
        $request_user_ids = $user_ids;
        $job_opening_id = $request->job_opening_id ?? '';
        $job = JobOpening::find($request->job_opening_id);
        $job_title = $job->job_title ?? '';
        $interviewDescriptions = DB::table('master_descriptors')->where('assessment_type', 'interview')->where('result_type', 'interview')->get();
        $descriptors = DB::table('master_descriptors')->where('user_type', 'candidate')->get();
        if ($request_user_ids) {
            foreach($request_user_ids as $key => $user_id) {
              
                $user = User::find($user_id);
              
                $job_opening_application = JobOpeningApplication::where('job_opening_id', $job_opening_id)->where('user_id', $user->id)->first();
                
                $data[$user_id]['job_opening_id'] = $job_opening_id ?? '';
                $data[$user_id]['job_opening_application_id'] = $job_opening_application->id ?? '';
                $data[$user_id]['job_opening_application_status'] = $job_opening_application->status ?? '';
                $data[$user_id]['job_opening_external_user_id'] = $job_opening_application->external_user_id ?? '';
                $user = User::find($user_id);
                $userResults = UserResult::where('user_id', $user_id)->get();

                    $data[$user_id]['first_name'] = $user->first_name ?? 'N/A';
                    $data[$user_id]['name'] = $user->first_name.' '.$user->middle_name. ' '.$user->last_name  ?? 'N/A';
                    $data[$user_id]['gender'] = $user->gender ?? 'N/A';
                    $data[$user_id]['age'] = $user->age ?? 'N/A';
                    $data[$user_id]['education_level'] = $user->education_level_check->name ?? 'N/A';
                    $data[$user_id]['higher_learning_institution'] = $user->higher_learning->name ?? 'N/A';
                    $data[$user_id]['work_experience'] = $user->year_of_experience_in_it_sector ?? 'N/A';
                    $data[$user_id]['profile_picture'] = $user->profile_picture ?? '';

                    // OCEAN Result
                    // $ocean_result = AssessmentHelper::getOCEANResultFull($user_id,0);
                    // $data[$user_id]['predictive_performance_result'] = ($ocean_result['Conscientiousness'] / 5)*100 ?? '0';
                    $ppr_result =  NewAssessmentHelper::getFormattedUserResults($userResults, 'all', 'ppr', $user->role_name, $descriptors);
                    $predictive_performance_result = $ppr_result['performance-predictive-rate']['percentage'] ?? 0;
                    
                    // Determine the performance level based on the percentage
                    if ($predictive_performance_result > 98) {
                        $ppr_level = 5;
                    } elseif ($predictive_performance_result > 84 && $predictive_performance_result <= 98) {
                        $ppr_level = 4;
                    } elseif ($predictive_performance_result >= 16 && $predictive_performance_result <= 84) {
                        $ppr_level = 3;
                    } elseif ($predictive_performance_result >= 2 && $predictive_performance_result < 16) {
                        $ppr_level = 2;
                    } else {
                        $ppr_level = 1;
                    }
                    $data[$user_id]['predictive_performance_result'] = $ppr_level ?? 0;
                    $data[$user_id]['predictive_performance_result_description'] = $ppr_result['performance-predictive-rate']['description'] ?? $ppr_level;

                    // Cognitive
                    // Single
                    // $cognitive_ability_result = AssessmentHelper::getCognitiveResultFull($user_id,0);
                    // $data[$user_id]['cognitive_ability_result'] = (int) (($cognitive_ability_result['Quantitative Knowledge'] + $cognitive_ability_result['Comprehension Knowledge'] + $cognitive_ability_result['Visual Reasoning'] + $cognitive_ability_result['Fluid Reasoning']) / 4);
                    $cognitive_ability_result =  NewAssessmentHelper::getFormattedUserResults($userResults, 'cognitive', 'overall', $user->role_name, $descriptors);
                    if (!empty($cognitive_ability_result)) {
                        $data[$user_id]['cognitive_ability_result'] = (int) ($cognitive_ability_result['cognitive']['level'] ?? 0);
                    } else {
                        $data[$user_id]['cognitive_ability_result'] = 0;
                    }                    

                    $data[$user_id]['cognitive_ability_result_description'] = isset($cognitive_ability_result['cognitive']) && isset($cognitive_ability_result['cognitive']['description']) 
                    ?  $cognitive_ability_result['cognitive']['description'] : 0;

                    // Top 3 RIASEC
                    // $work_interest_result = AssessmentHelper::getWorkInterestResultFull($user_id,0);
                    // $top_3_riasec = $work_interest_result['top_3_riasec'];
                    // $data[$user_id]['top_3_riasec'] = $top_3_riasec;
                    // $data[$user_id]['top_3_riasec_description'] = $work_interest_result['top_3_riasec_description'] ?? '';
                    $top_3_riasec =  NewAssessmentHelper::getFormattedUserResults($userResults, 'riasec', 'top_3_riasec');
                   
                    $data[$user_id]['top_3_riasec'] = $top_3_riasec['top-3-riasec']['level_description'] ?? 'Data Not Available';
                    $data[$user_id]['top_3_riasec_description'] = $top_3_riasec['top-3-riasec']['description'] ?? 'Data Not Available';

                    // Flight Risk
                    // $all_facets = AssessmentHelper::getOCEANAllFacetsResultFull($user_id,0);
                    // $flight_risk = AssessmentHelper::getFlightRiskFull($all_facets);

                    // $data[$user_id]['flight_risk_result'] = $flight_risk;
                    $flight_risk = NewAssessmentHelper::getFormattedUserResults($userResults, 'ocean', 'flight_risk', $user->role_name, $descriptors);
                    $data[$user_id]['flight_risk_result'] = $flight_risk['flight-risk']['level'] ?? 0;
                    $data[$user_id]['flight_risk_result_description'] = $flight_risk['flight-risk']['description'] ?? '';

                    // Match Rate
                    // $position = Job::find($user->position_id);
                    // if($position) {
                    //     $positions = str_split($position->top3riasec);
                    // } else {
                    //     $positions = ["S","E","C"];
                    // }

                    // $score = 0;
                    // if (in_array($user->riasec_code_one, $positions)) {
                    //     $score = $score + (($user->riasec_code_one_score) * 0.6);
                    // } elseif (in_array($user->riasec_code_two, $positions)) {
                    //     $score = $score + (($user->riasec_code_two_score) * 0.3);
                    // } elseif (in_array('C', $positions)) {
                    //     $score = $score + (($user->riasec_code_three_score) * 0.1);
                    // }
                    
                    // Soft Skill Match Rate
                    // $data[$user_id]['talent_pillar_match_rate'] = $user->talent_pillar_match_rate;
                    $ccs_match_rate = NewAssessmentHelper::getFormattedUserResults($userResults, 'ocean', 'ccs_match_rate', $user->role_name, $descriptors);
                    $data[$user_id]['talent_pillar_match_rate'] = $ccs_match_rate['ccs-match-rate']['level'] ?? 0;
                    $data[$user_id]['talent_pillar_match_rate_description'] = $ccs_match_rate['ccs-match-rate']['description'] ?? '';
                    
                    // Behaviour Fit Rate
                    // $data[$user_id]['soft_skill_match_rate'] = $user->soft_skill_score;
                    $soft_skill_score = NewAssessmentHelper::getFormattedUserResults($userResults, 'all', 'soft_skill_score', $user->role_name, $descriptors);
                    $data[$user_id]['soft_skill_match_rate'] = $soft_skill_score['soft-skill-score']['level'] ?? 0;
                    $data[$user_id]['soft_skill_match_rate_description'] = $soft_skill_score['soft-skill-score']['description'] ?? '';

                    // Overall Match Rate
                    if($user->technical_assessment_completed == 0) {
                        $data[$user_id]['match_rate'] = 0;
                        $data[$user_id]['match_rate_description'] = 'Technical Assessment Not Completed';
                    } else {
                        $overall_match_rate = NewAssessmentHelper::getFormattedUserResults($userResults, 'all', 'overall_match_rate', $user->role_name, $descriptors);
                        $data[$user_id]['match_rate'] = $overall_match_rate['overall-match-rate']['level'] ?? 0;
                        $data[$user_id]['match_rate_description'] = $overall_match_rate['overall-match-rate']['description'] ?? '';
                    }

                    // Technical Assessment Result
                    // $data[$user_id]['technical_assessment_result'] = $user->tech_skill_score;
                    $tech_skill_score = $user->tech_skill_score ?? 0;
                    $data[$user_id]['technical_assessment_result'] = $tech_skill_score ?? 0;

                    if ($tech_skill_score == 0) {
                        $data[$user_id]['technical_assessment_result'] = 0;
                        $data[$user_id]['technical_assessmnent_result_description'] = 'Technical Assessment Not Completed';
                    } else {
                        // Determine the performance level based on the percentage
                        if ($tech_skill_score > 90) {
                            $technical_level = 5;
                        } elseif ($tech_skill_score > 75 && $tech_skill_score <= 90) {
                            $technical_level = 4;
                        } elseif ($tech_skill_score >= 60 && $tech_skill_score <= 75) {
                            $technical_level = 3;
                        } elseif ($tech_skill_score >= 45 && $tech_skill_score < 60) {
                            $technical_level = 2;
                        } else {
                            $technical_level = 1;
                        }
                        $data[$user_id]['technical_assessment_result'] = $technical_level ?? 0;
                        $data[$user_id]['technical_assessment_result_description'] = $technical_assessment_result['technical']['description'] ?? '';
                    }

                    // Job Match Rate (RIASEC Match Rate)
                    // if($user->riasec_job_match_rate >= 70) {
                    //     $riasec_job_match_rate = 'High';
                    // } elseif ($user->riasec_job_match_rate <= 40) {
                    //     $riasec_job_match_rate = 'Low';
                    // } else {
                    //     $riasec_job_match_rate = 'Moderate';
                    // }
                    // $data[$user_id]['job_match_rate'] = $riasec_job_match_rate;
                    $riasec_job_match_rate = NewAssessmentHelper::getFormattedUserResults($userResults, 'riasec', 'jmr', $user->role_name, $descriptors);
                    $data[$user_id]['job_match_rate'] = $riasec_job_match_rate['job-match-rate']['level'] ?? 0;
                    $data[$user_id]['job_match_rate_description'] = $riasec_job_match_rate['job-match-rate']['description'] ?? '';

                    // OCEAN Reliability
                    // $data[$user_id]['ocean_reliability_result'] = AssessmentHelper::getOCEANReliability($user_id) ?? 'Average';
                    $rci = NewAssessmentHelper::getFormattedUserResults($userResults, 'ocean', 'rci', $user->role_name, $descriptors);
                    $data[$user_id]['rci'] = $rci['rci']['level'] ?? 0;
                    $data[$user_id]['rci_description'] = $rci['rci']['description'] ?? '';

                    // Position
                    // $data[$user_id]['position'] = $user->job_position->title ?? 'N/A';
                    $data[$user_id]['position'] = $job_title ?? 'N/A';
                    
                    // Growth Potential
                    // $averageGpPercentage = User::where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->where('is_personality_motivation_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_cognitive_ability_completed', '=', 1)->avg('gp_percentage');
                    // $growth_potential = 'Average';

                    // if(isset($user->gp_percentage) && ($user->gp_percentage > $averageGpPercentage)) {
                    //     $growth_potential = 'High';
                    // }

                    // $growth_potential = AssessmentHelper::getGrowthPotential(auth()->user()->id,$user->gp_percentage,$user->cognitive_test_percentage);
                    // $data[$user_id]['growth_potential_result'] = $growth_potential;

                    $growth_potential = NewAssessmentHelper::getFormattedUserResults($userResults, 'ocean', 'growth_potential', $user->role_name, $descriptors);
                    $data[$user_id]['growth_potential_result'] = $growth_potential['growth-potential']['level'] ?? 0;
                    $data[$user_id]['growth_potential_result_description'] = $growth_potential['growth-potential']['description'] ?? '';

                    // Dark Triads (Organization Fit Forecast)
                    // $organizational_fit_forecast_result = AssessmentHelper::getOrganizationalFitForecast($all_facets);
                    // $data[$user_id]['organizational_fit_forecast_result'] = $organizational_fit_forecast_result ?? 'Low';
                    $organizational_fit_forecast_result = NewAssessmentHelper::getFormattedUserResults($userResults, 'ocean', 'organizational_fit_forecast', $user->role_name, $descriptors);
                    $data[$user_id]['organizational_fit_forecast_result'] = $organizational_fit_forecast_result['organizational-fit-forecast']['level'] ?? 0;
                    $data[$user_id]['organizational_fit_forecast_result_description'] = $organizational_fit_forecast_result['organizational-fit-forecast']['description'] ?? '';

                    // Based on Job Application
                    $data[$user_id]['interview_score'] = $job_opening_application->interview_score ?? '50';
                    $jobInterviewScore =  $job_opening_application->interview_score ?? '';
                    
                    if($jobInterviewScore) {
                        // Determine the performance level based on the percentage
                        if ($jobInterviewScore > 90) {
                            $interview_level = 5;
                        } elseif ($jobInterviewScore > 75 && $jobInterviewScore <= 90) {
                            $interview_level = 4;
                        } elseif ($jobInterviewScore >= 60 && $jobInterviewScore <= 75) {
                            $interview_level = 3;
                        } elseif ($jobInterviewScore >= 45 && $jobInterviewScore < 60) {
                            $interview_level = 2;
                        } else {
                            $interview_level = 1;
                        }
                        $data[$user_id]['interview_performance'] = $interview_level ?? 0;
                        $data[$user_id]['interview_performance_description'] = $interviewDescriptions->where('user_score_level', $interview_level)->first()->analysis ?? '';
                    } else {
                        $data[$user_id]['interview_performance'] = 0;
                    }
                    

                    $data[$user_id]['tech_skill_score'] = $job_opening_application->tech_skill_score ?? 0;

                    $data[$user_id]['soft_skill_score'] = $soft_skill_score ?? 0;

                    $match_rate = $user->match_rate ?? 0;
                    $interview_score = $job_opening_application->interview_score ?? 0;
                    $tech_skill_score = $job_opening_application->tech_skill_score ?? $user->tech_skill_score ?? 60;

                    if($user->technical_assessment_completed == 0) {
                        $data[$user_id]['match_rate'] = 0;
                        $data[$user_id]['match_rate_description'] = 'Technical Assessment Not Completed';
                        $data[$user_id]['suggestion'] = -2;
                        $data[$user_id]['suggestion_description'] = 'Technical Assessment Not Completed';
                    } else {
                        $match_rate = 0.7*($tech_skill_score) + 0.3*($soft_skill_score);
                        if ($match_rate > 98) {
                            $match_rate_level = 5;
                        } elseif ($match_rate > 84 && $match_rate <= 98) {
                            $match_rate_level = 4;
                        } elseif ($match_rate >= 16 && $match_rate <= 84) {
                            $match_rate_level = 3;
                        } elseif ($match_rate >= 2 && $match_rate < 16) {
                            $match_rate_level = 2;
                        } else {
                            $match_rate_level = 1;
                        }
                        $data[$user_id]['match_rate'] = $match_rate_level ?? 0;
                        $data[$user_id]['match_rate_description'] = $descriptors->where('slug', 'overall-match-rate')->where('user_score_level', $match_rate_level)->first()->analysis ?? '';
                    }
                    
                    

                    if ($interview_score == 0) {
                        if ($user->technical_assessment_completed == 0) {
                            $data[$user_id]['suggestion'] = 0;
                            $data[$user_id]['suggestion_description'] = 'Technical Assessment & Interview Not Completed';
                        } else {
                            $data[$user_id]['suggestion'] = -1;
                            $data[$user_id]['suggestion_description'] = 'Interview Not Completed';
                        }                      
                    } else {
                        $final_match_rate = ($interview_score + $match_rate) / 2;
                        $suggestion_match_rate = $final_match_rate;
    
                        if($suggestion_match_rate > 70) {
                            $suggestion_level = 3;
                        } elseif ($suggestion_match_rate < 40) {
                            $suggestion_level = 1;
                        } else {
                            $suggestion_level = 2;
                        }
    
                        $data[$user_id]['suggestion'] = $suggestion ?? 0;
                        $data[$user_id]['suggestion_description'] = $descriptors->where('slug', 'suggestion')->where('user_score_level', $suggestion)->first()->analysis ?? '';
                    }
                 
                    $suitability_rate = $job_opening_application->matching_percentage ?? 50;

                    if ($suitability_rate > 90) {
                        $suitability_rate_level = 5;
                    } elseif ($suitability_rate > 75 && $suitability_rate <= 90) {
                        $suitability_rate_level = 4;
                    } elseif ($suitability_rate >= 60 && $suitability_rate <= 75) {
                        $suitability_rate_level = 3;
                    } elseif ($suitability_rate >= 45 && $suitability_rate < 60) {
                        $suitability_rate_level = 2;
                    } else {
                        $suitability_rate_level = 1;
                    }

                    $data[$user_id]['suitability_rate'] = $suitability_rate_level;
                    $data[$user_id]['suitability_rate_description'] = $descriptors->where('slug', 'suitability-rate')->where('user_score_level', $suitability_rate_level)->first()->analysis ?? '';

                    $data[$user_id]['job_opening_application_status'] = $job_opening_application->status ?? 6;

                    $skill_level = $job_opening_application->jobOpening->job_position->level ?? 1;

            }
        }

        return view('admin.job-openings.compare', compact('request_user_ids','data','job_opening_id', 'job_title'));
    }


    public function getCandidates(Request $request)
    {
        try {
            $departmentId = $request->department_id;
            $jobOpeningId = $request->job_opening_id;
            $status = $request->status;

            $jobApplications = JobOpeningApplication::where('job_opening_id', $jobOpeningId)
            ->when($status, function ($query) use ($status) {
                return $query->where('status', $status);
            })->pluck('user_id');

            // Fetch candidates based on department and job opening where('role_name', 'candidate') - further filter
            $candidates = User::where('department_id', $departmentId)
                ->whereIn('id', $jobApplications)
                ->get(['id', 'name']);
            
            return response()->json(['candidates' => $candidates]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch candidates.'], 500);
        }
    }

    public function getEmployees(Request $request)
    {
        try {
            // Fetch all employees
            $departmentId = $request->department_id;
            $jobOpeningId = $request->job_opening_id;

            $jobOpening = JobOpening::find($jobOpeningId);
            $employees = User::where('role_name', 'employee')->where('position_id', $jobOpening->position_id)->get(['id', 'name']);
            return response()->json(['employees' => $employees]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch employees.'], 500);
        }
    }

    public function getJobOpenings(Request $request)
    {
        try {
            $departmentId = $request->department_id;

            // Fetch job advertisements based on department
            $jobs = JobOpening::where('department_id', $departmentId)->get(['id', 'job_title']);
            return response()->json(['jobs' => $jobs]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch job openings.'], 500);
        }
    }



    public function compare(Request $request, $job_opening_id) {
        $data = [];
        foreach($user_ids as $user_id => $user_id) {
             $user = User::find($user_id);
             $data[$user_id]['name'] = $user->name ?? '';
             $data[$user_id]['gender'] = $user->gender ?? '';
             $data[$user_id]['age'] = $user->age ?? '';
             $data[$user_id]['education_level'] = $user->education_level_check ?? 'N/A';
             $data[$user_id]['higher_learning_institution'] = $user->higher_learning ?? 'N/A';
             $data[$user_id]['profile_picture'] = $user->profile_picture ?? '';
             // OCEAN Result
             $ocean_result = AssessmentHelper::getOceanResultFull($user_id,0);
             $data[$user_id]['predictive_performance_result'] = ($ocean_result['Conscientiousness'] / 5)*100 ?? '0';

             // Cognitive
             // Single
             $cognitive_ability_result = AssessmentHelper::getCognitiveResultFull($user_id,0);
             $data[$user_id]['cognitive_ability_result'] = (int) (($cognitive_ability_result['Quantitative Knowledge'] + $cognitive_ability_result['Comprehension Knowledge'] + $cognitive_ability_result['Visual Reasoning'] + $cognitive_ability_result['Fluid Reasoning']) / 4);

             // Top 3 RIASEC
             $top_3_riasec = AssessmentHelper::getTop3RIASECFullBasedOnScore($user_id,0);

             // Flight Risk
             $all_facets = AssessmentHelper::getOCEANAllFacetsResultFull($user_id,0);
             $flight_risk = AssessmentHelper::getFlightRiskFull($all_facets);

             $data[$user_id]['flight_risk_result'] = $flight_risk;
        }
    }

    public function compareInterviewedCandidatesIndex(Request $request, $job_opening_id) {
        $user_ids = JobOpeningApplication::where('job_opening_id', $job_opening_id)->where('status', '>', 5)->pluck('user_id');
        $users = User::whereNotNull('first_name')->where('is_cognitive_ability_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_personality_motivation_completed', '=', 1)->whereIn('id', $user_ids)->get();

        $data = [];
        $request_user_ids = $request->filled('request_user_ids') ?? [];

        $job = JobOpening::find($job_opening_id);
        $job_title = $job->job_title ?? '';

        if ($request_user_ids) {
            foreach($request->request_user_ids as $key => $user_id) {
                $user = User::find($user_id);
                $job_opening_application = JobOpeningApplication::where('job_opening_id', $job_opening_id)->where('user_id', $user->id)->first();

                $data[$user_id]['job_opening_id'] = $job_opening_id ?? '';
                $data[$user_id]['job_opening_application_id'] = $job_opening_application->id ?? '';
                $data[$user_id]['job_opening_application_status'] = $job_opening_application->status ?? '';
                $data[$user_id]['job_opening_external_user_id'] = $job_opening_application->external_user_id ?? '';
                $user = User::find($user_id);
                    $data[$user_id]['first_name'] = $user->first_name ?? 'N/A';
                    $data[$user_id]['name'] = $user->first_name.' '.$user->middle_name. ' '.$user->last_name  ?? 'N/A';
                    $data[$user_id]['gender'] = $user->gender ?? 'N/A';
                    $data[$user_id]['age'] = $user->age ?? 'N/A';
                    $data[$user_id]['education_level'] = $user->education_level_check->name ?? 'N/A';
                    $data[$user_id]['higher_learning_institution'] = $user->higher_learning->name ?? 'N/A';
                    $data[$user_id]['work_experience'] = $user->year_of_experience_in_it_sector ?? 'N/A';
                    $data[$user_id]['profile_picture'] = $user->profile_picture ?? '';

                    // OCEAN Result
                    $ocean_result = AssessmentHelper::getOCEANResultFull($user_id,0);
                    $data[$user_id]['predictive_performance_result'] = ($ocean_result['Conscientiousness'] / 5)*100 ?? '0';

                    // Cognitive
                    // Single
                    $cognitive_ability_result = AssessmentHelper::getCognitiveResultFull($user_id,0);
                    $data[$user_id]['cognitive_ability_result'] = (int) (($cognitive_ability_result['Quantitative Knowledge'] + $cognitive_ability_result['Comprehension Knowledge'] + $cognitive_ability_result['Visual Reasoning'] + $cognitive_ability_result['Fluid Reasoning']) / 4);

                    // Top 3 RIASEC
                    $work_interest_result = AssessmentHelper::getWorkInterestResultFull($user_id,0);
                    $top_3_riasec = $work_interest_result['top_3_riasec'];
                    $data[$user_id]['top_3_riasec'] = $top_3_riasec;
                    $data[$user_id]['top_3_riasec_description'] = $work_interest_result['top_3_riasec_description'] ?? '';
                    // Flight Risk
                    $all_facets = AssessmentHelper::getOCEANAllFacetsResultFull($user_id,0);
                    $flight_risk = AssessmentHelper::getFlightRiskFull($all_facets);

                    $data[$user_id]['flight_risk_result'] = $flight_risk;

                    // Match Rate
                    // $position = Job::find($user->position_id);
                    // if($position) {
                    //     $positions = str_split($position->top3riasec);
                    // } else {
                    //     $positions = ["S","E","C"];
                    // }

                    // $score = 0;
                    // if (in_array($user->riasec_code_one, $positions)) {
                    //     $score = $score + (($user->riasec_code_one_score) * 0.6);
                    // } elseif (in_array($user->riasec_code_two, $positions)) {
                    //     $score = $score + (($user->riasec_code_two_score) * 0.3);
                    // } elseif (in_array('C', $positions)) {
                    //     $score = $score + (($user->riasec_code_three_score) * 0.1);
                    // }
                    
                    // Soft Skill Match Rate
                    $data[$user_id]['talent_pillar_match_rate'] = $user->talent_pillar_match_rate;

                    // Behaviour Fit Rate
                    $data[$user_id]['soft_skill_match_rate'] = $user->soft_skill_score;

                    // Overall Match Rate
                    if($user->technical_assessment_completed == 0) {
                        $data[$user_id]['match_rate'] = 0;
                    } else {
                        $data[$user_id]['match_rate'] = $user->match_rate;
                    }

                    // Technical Assessment Result
                    $data[$user_id]['technical_assessment_result'] = $user->tech_skill_score;

                    // Job Match Rate (RIASEC Match Rate)
                    if($user->riasec_job_match_rate >= 70) {
                        $riasec_job_match_rate = 'High';
                    } elseif ($user->riasec_job_match_rate <= 40) {
                        $riasec_job_match_rate = 'Low';
                    } else {
                        $riasec_job_match_rate = 'Moderate';
                    }
                    $data[$user_id]['job_match_rate'] = $riasec_job_match_rate;

                    // OCEAN Reliability
                    $data[$user_id]['ocean_reliability_result'] = AssessmentHelper::getOCEANReliability($user_id) ?? 'Average';

                    // Position
                    $data[$user_id]['position'] = $user->job_position->title ?? 'N/A';

                    // Growth Potential
                    // $averageGpPercentage = User::where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->where('is_personality_motivation_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_cognitive_ability_completed', '=', 1)->avg('gp_percentage');
                    // $growth_potential = 'Average';

                    // if(isset($user->gp_percentage) && ($user->gp_percentage > $averageGpPercentage)) {
                    //     $growth_potential = 'High';
                    // }

                    $growth_potential = AssessmentHelper::getGrowthPotential(auth()->user()->id,$user->gp_percentage,$user->cognitive_test_percentage);
                    $data[$user_id]['growth_potential_result'] = $growth_potential;

                    // Dark Triads (Organization Fit Forecast)
                    $organizational_fit_forecast_result = AssessmentHelper::getOrganizationalFitForecast($all_facets);
                    $data[$user_id]['organizational_fit_forecast_result'] = $organizational_fit_forecast_result ?? 'Low';

                    // Based on Job Application

                    $data[$user_id]['interview_score'] = $job_opening_application->interview_score ?? '50';
                    $jobOpeningApplicationInterviewScore = $job_opening_application->interview_score ?? '';
                    $data[$user_id]['interview_performance'] = config('helpers.interview_performance')[AssessmentHelper::getInterviewPerformance($jobOpeningApplicationInterviewScore)] ?? 'Good';

                    $data[$user_id]['tech_skill_score'] = $job_opening_application->tech_skill_score ?? '50';
                    $data[$user_id]['soft_skill_score'] = $user->soft_skill_score ?? '50';

                    $match_rate = $user->match_rate ?? 0;
                    $interview_score = $job_opening_application->interview_score ?? 0;
                    $tech_skill_score = $job_opening_application->tech_skill_score ?? $user->tech_skill_score ?? 60;
                    $match_rate = 0.7*($tech_skill_score) + 0.3*($user->match_rate);

                    
                    $final_match_rate = ($interview_score + $match_rate) / 2;
                    $data[$user_id]['match_rate'] = $final_match_rate;

                    $suggestion_match_rate = ($match_rate + $interview_score) / 2;
                    $suggestion_match_rate = $final_match_rate;

                    

                    if($suggestion_match_rate > 70) {
                        $suggestion = 'Hire';
                    } elseif ($suggestion_match_rate < 40) {
                        $suggestion = 'Further Review';
                    } else {
                        $suggestion = 'Consider Further';
                    }

                    $data[$user_id]['suggestion'] = $suggestion ?? '50';

                    $data[$user_id]['suitability_rate'] = $job_opening_application->matching_percentage ?? '50';
                    $data[$user_id]['job_opening_application_status'] = $job_opening_application->status ?? 6;

                    $skill_level = $job_opening_application->jobOpening->job_position->level ?? 1;
            }
        }

        return view('admin.job-openings.compare-interviewed-candidates', compact('users','request_user_ids','data','job_opening_id', 'job_title'));
    }

    public function pipelineUpdateApplicationStatus() {
        $jobOpeningApplications = JobOpeningApplication::where('status', 2)->get();
        // $jobOpeningApplicationUserIds = JobOpeningApplication::where('status', 2)->pluck('user_id')->toArray();

        // $users = User::whereIn('user_id', $jobOpeningApplicationUserIds)->get();

        foreach($jobOpeningApplications as $jobOpeningApplication) {
            if($jobOpeningApplication->user_id) {
                $user = User::find($jobOpeningApplication->user_id);

                if ($user->is_all_assessments_completed == 1) {
                    $jobOpeningApplication->status == 3;
                    $jobOpeningApplication->save();

                    $apiUrl = env('API_URL') . "api/update-application-status/{$jobOpeningApplication->id}";

                    $response = Http::put($apiUrl, [
                                        'status' => 3,
                                    ]);
                    if (!$response->successful()) {
                        $errorResponse = $response->json();
                        \Log::error('Failed to update application status via API', [
                            'application_id' => $jobOpeningApplication->id,
                            'response' => $errorResponse,
                        ]);
                    }

                }
            }

        }

    }

    public function getByCompany($companyId)
    {
        if (auth()->user()->isDepartment()) {
            return Department::where('id', auth()->user()->department_id)->where('status',1)->get();
        }else{
            if(!$companyId) {
                return Department::where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->select('name', 'id')->get();
            } else {
                return Department::where('company_id', $companyId)->select('name', 'id')->get();
            }
        }


    }

    public function getByDepartment($departmentId)
    {
        // return Job::where('department_id', $departmentId)->orderBy('level', 'DESC')->where('is_primary', 0)->get();
        return Job::where('org_department', $request->department_id)
                ->withCount(['employees as assigned_users_count' => function ($query) {
                    $query->whereColumn('position_id', 'jobs.id');
                }])
                ->selectRaw("
                    jobs.id,
                    CONCAT(jobs.title, ' (Vacancies - ', (heads - 
                        (SELECT COUNT(*) FROM users WHERE users.position_id = jobs.id)
                    ), ')') as title_with_vacancies")
                ->havingRaw('heads > (SELECT COUNT(*) FROM users WHERE users.position_id = jobs.id)')
                ->orderBy('level', 'DESC')
                ->where('is_primary', 0)
                ->get();
    }

    public function getPositionDetails($positionId)
    {
        $position = Job::with(['skills', 'technicalSkills'])->find($positionId);
        // dd($position);
        $totalEmployees = User::where('position_id', $positionId)->count();
        // Will get headcounts from job table once sierra data migration is completed
        $headcounts = $position->heads ?? 20;
        $vacancies = $headcounts - $totalEmployees;

        $workExperienceRange = $position->work_experience; // This could be "1-3", "0", or null
        $workExperience = null;

        if (is_null($workExperienceRange) || $workExperienceRange === '') {
            $workExperience = '0';
        } else {
            $workExperience = explode('-', $workExperienceRange)[0];
        }

        $workExperience = explode('-', $workExperienceRange)[0];

        return response()->json([
            'description' => $position->description,
            'job_skills' => $position->skills,
            'technical_skills' => $position->technicalSkills,
            'vacancies' => $vacancies,
            'title' => $position->title,
            'heads' => $headcounts,
            'total_employees' => $totalEmployees,
            'education_level' => $position->education_level,
            'scope_of_study' => $position->scope_of_study,
            'work_experience' => (int) $workExperience
        ]);
    }

    private function createUniqueSlug($title, $id = 0)
    {
        // Normalize the title (to lowercase and replace spaces with hyphens)
        $slug = Str::slug($title, '-');
        // Check for slug uniqueness
        $allSlugs = JobOpening::select('slug')->where('job_title', $title)->where('id', '!=', $id)->get();
        if (!$allSlugs->contains('slug', $slug)){
            return $slug;
        }
        // If the slug is not unique, then append numbers until it is unique
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    public function interviewList(Request $request) {
        if($request->filled('job_opening')){
            $query = JobOpeningApplication::where('job_opening_applications.job_opening_id', $request->job_opening)
                      ->where('job_opening_applications.status', 5)
                     ->join('users', 'job_opening_applications.user_id', '=', 'users.id')
                     ->select('users.*')
                     ->select('job_opening_applications.*');
 
            if($request->filled('search')) {
               $query->where('name', 'LIKE', '%' . $request->search . '%');
            }
            $interviewLists = $query->paginate();
        } else {
           $interviewLists = [];
        }
 
        $departments = User::where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->whereNull('department_id')->pluck('name', 'id');
        $jobOpenings = JobOpening::where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->pluck('job_title', 'id');

        return view('admin.job-openings.interview-list', compact('interviewLists','departments','jobOpenings'));
     }
 
    public function completedInterviewList(Request $request) {
         if($request->filled('job_opening')){
            $jobOpeningDetail = JobOpening::find($request->job_opening);
            $query = JobOpeningApplication::where('job_opening_applications.job_opening_id', $request->job_opening)
                      ->where('job_opening_applications.status', '>', 5)
                     ->join('users', 'job_opening_applications.user_id', '=', 'users.id')
                     ->select('users.*')
                     ->select('job_opening_applications.*');

            if($request->filled('search')) {
                $query->where('name', 'LIKE', '%' . $request->search . '%');
             }
             $interviewLists = $query->paginate();
         } else {
            $interviewLists = [];
            $jobOpeningDetail = [];
         }
         
         $departments = User::where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->whereNull('department_id')->pluck('name', 'id');
         $jobOpenings = JobOpening::where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->pluck('job_title', 'id');
  
         return view('admin.job-openings.completed-interview-list', compact('interviewLists','departments','jobOpenings', 'jobOpeningDetail'));
     }
 
     public function updateInterviewScore(Request $request)
     {
         $request->validate([
             'interview_id' => 'required|integer', // Ensure the interview exists
             'interview_score' => 'required|integer|min:0|max:100' // Validate the score is within 0-100
         ]);
 
         $interview = User::findOrFail($request->interview_id);
         $interview->interview_score = $request->interview_score;
         $interview->interview_completion = 1;
         $interview->interview_performance = AssessmentHelper::getInterviewPerformance($request->interview_score);
         $interview->save();
 
         return response()->json([
             'message' => 'Interview score updated successfully!'
         ]);
     }

    public function takeInterview($job_opening_application_id) {
        $job_opening_application = JobOpeningApplication::find($job_opening_application_id);
        $level = $job_opening_application->jobOpening->job_position->level ?? 2;
        $name = $job_opening_application->external_user_name ?? 'Name';
        return view('admin.job-openings.take-interview',compact('job_opening_application_id', 'job_opening_application', 'level', 'name'));
    }

    public function storeInterviewResponse(Request $request) {
        // Validate the form data
        $validated = $request->validate([
            'background' => 'required|in:1,3,5',
            'itProject' => 'required|in:1,3,5',
            'studyMotivation' => 'required|in:1,3,5',
            'studyPractices' => 'required|in:1,3,5',
            'networkProtocols' => 'required|in:1,3,5',
            'additionalSkills' => 'required|in:1,3,5',
            'englishProficiency' => 'required|in:1,3,5',
            'timeliness' => 'required|in:1,3,5',
            'auditorySkills' => 'required|in:1,3,5',
            'inquisitiveAbilities' => 'required|in:1,3,5',
        ]);

        
        // Calculate the total score
        $totalScore = array_sum([
            $validated['background'],
            $validated['itProject'],
            $validated['studyMotivation'],
            $validated['studyPractices'],
            $validated['networkProtocols'],
            $validated['additionalSkills'],
            $validated['englishProficiency'],
            $validated['timeliness'],
            $validated['auditorySkills'],
            $validated['inquisitiveAbilities']
        ]);

        $jobOpeningApplication = JobOpeningApplication::find($request->job_opening_application_id);
      
        $jobOpeningApplication->interview_score = ($totalScore / 50)*100;
        $jobOpeningApplication->status = 6;
        // $jobOpeningApplication->interview_completion = 1;
        $jobOpeningApplication->interview_performance = AssessmentHelper::getInterviewPerformance($jobOpeningApplication->interview_score);
        $jobOpeningApplication->save();

        $activity = MainHelper::CreatejobApplicationLogs($jobOpeningApplication->user_id, $jobOpeningApplication->id, 'Interview Conducted');
        // Store the data in the database
        $application = new UserInterviewResponse();
        $application->user_id = $jobOpeningApplication->user_id;
        $application->interviewer_id = auth()->user()->id;
        $application->background = $validated['background'];
        $application->it_project = $validated['itProject'];
        $application->study_motivation = $validated['studyMotivation'];
        $application->study_practices = $validated['studyPractices'];
        $application->network_protocols = $validated['networkProtocols'];
        $application->additional_skills = $validated['additionalSkills'];
        $application->english_proficiency = $validated['englishProficiency'];
        $application->timeliness = $validated['timeliness'];
        $application->auditory_skills = $validated['auditorySkills'];
        $application->inquisitive_abilities = $validated['inquisitiveAbilities'];
        $application->total_score = $totalScore;
        $application->save();

        return redirect()->route('admin.job-opening.applicant-details', ['job_opening_application_id' => $jobOpeningApplication->id, 'id' => $jobOpeningApplication->user_id])->with('success', 'Application submitted successfully with a interview score of ' . $jobOpeningApplication->interview_score);
    }

    public function allCandidates(Request $request) {
        if($request->filled('job_opening')){
           $jobOpeningDetail = JobOpening::find($request->job_opening);
           $query = JobOpeningApplication::where('job_opening_applications.job_opening_id', $request->job_opening)
                    ->join('users', 'job_opening_applications.user_id', '=', 'users.id')
                    ->select('users.*')
                    ->select('job_opening_applications.*');

           if($request->filled('search')) {
               $query->where('name', 'LIKE', '%' . $request->search . '%');
            }
            $interviewLists = $query->paginate();
        } else {
           $interviewLists = [];
           $jobOpeningDetail = [];
        }
        
        $departments = User::where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->whereNull('department_id')->pluck('name', 'id');
        $jobOpenings = JobOpening::where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->pluck('job_title', 'id');
 
        return view('admin.job-openings.all-candidates', compact('interviewLists','departments','jobOpenings', 'jobOpeningDetail'));
    }

    public function getState(Request $request)
    {
        $states = MasterState::where('country_id', $request->cid)->get();
        $options = '<option value="">Select State</option>';
        foreach ($states as $state) {
            $options .= '<option value="' . $state->id . '">' . $state->name . '</option>';
        }
        return response()->json($options);
    }



    public function getCity(Request $request)
    { 
       
        $cities = MasterCity::where('state_id', $request->sid)->get();
        $options = '<option value="">Select City</option>';
        foreach ($cities as $city) {
            $options .= '<option value="' . $city->id . '">' . $city->name . '</option>';
        }
        return response()->json($options);
    }

    // public function showForm()
    // {
    //     $countries = MasterCountry::all(); // Assuming you have a Country model
    //     return view('location', compact('countries'));
    // }

    // for philipin coutnry add
    public function barangay(Request $request)
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

    public function City(Request $request)
    {
       
        // Check if an ID is specified to fetch a specific barangay
        if ($request->has('id')) {
            $barangay = MasterCity::where('country_id',135)->find($request->id);
            return response()->json([
                'id' => $barangay->id,
                'text' => $barangay->name
            ]);
        }
        

        // Handle search functionality
        $query = $request->get('q');
        $barangays = MasterCity::where('country_id',135)->where('name', 'LIKE', "%{$query}%")->paginate(10);
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
    public function advertisementStatus(Request $request,$id)
    {
       $job = JobOpening::find($id);
       $job->status = $request->status ?? 0;
       $job->save();

        // Redirect back with a success message
        return back()->with('success', 'Application status updated successfully.');
    }

    public function applicationStatus(Request $request,$id)
    {
      
       $job = JobOpeningApplication::find($id);
       $job->application_status = $request->application_status ?? 1;
       $job->save();

        // Redirect back with a success message
        return back()->with('success', 'Application status updated successfully.');
    }

    public function interviewSchedule(Request $request)
    {        
        // Validate the request
        $validator = Validator::make($request->all(), [
            'interview_datetime' => 'required|date',
            // 'interview_description' => 'required|string|max:255',
            // 'interview_link' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }


       
        $application = JobOpeningApplication::find($request->application_id);
        if ($request->has('start_hour') && $request->has('start_minute') && $request->has('start_ampm')) {
            $hour = (int) $request->start_hour;
            $minute = str_pad((int) $request->start_minute, 2, '0', STR_PAD_LEFT);
            $ampm = strtoupper($request->start_ampm);

            // Convert to 24-hour format
            if ($ampm === 'PM' && $hour < 12) {
                $hour += 12;
            } elseif ($ampm === 'AM' && $hour === 12) {
                $hour = 0;
            }

            $start_time = sprintf('%02d:%02d:00', $hour, $minute);

            $application->interview_start_time = $start_time;
        }

        if ($request->has('end_hour') && $request->has('end_minute') && $request->has('end_ampm')) {
            $endHour = (int) $request->end_hour;
            $endMinute = str_pad((int) $request->end_minute, 2, '0', STR_PAD_LEFT);
            $endAmPm = strtoupper($request->end_ampm);

            // Convert to 24-hour format
            if ($endAmPm === 'PM' && $endHour < 12) {
                $endHour += 12;
            } elseif ($endAmPm === 'AM' && $endHour === 12) {
                $endHour = 0;
            }

            $interviewEndTime = sprintf('%02d:%02d:00', $endHour, $endMinute);

            $application->interview_end_time = $interviewEndTime;

        }



        $application->interview_date = $request->interview_datetime;
        $application->interview_description = $request->interviewer_name;
        $application->interview_link = $request->interview_link;
        $application->interview_address = $request->interview_address;

        $application->interviewer_name = $request->interviewer_name;
        $application->interview_mode = $request->interview_mode;
        $application->status = 6;
        $application->save();

        $user = User::find($application->user_id);
        // Send Email
        $to = $user->email;



        $mailableClass =  config('constants.EMAIL_BY_INTERVIEW_TYPE')[$request->interview_mode];
        $successMessage = 'Interview Scheduled Successfully';
        $type = 'Scheduled';
        if ($request->has('form_type')) {
            if ($request->form_type == 'reschedule_interview') {
                $type = 'Re-Scheduled';
                $successMessage = 'Interview Re-Scheduled Successfully';
            }
        }

        

        $data = [
            // 'status' => config('helpers.application_status')[5] ?? '',
            'Job Title'=>$application->jobOpening->job_title,
            'Company Name' => auth()->user()->userCompany()->first()->name ?? '',
            'Interview Date' => $request->interview_datetime,
            'Interviewer Name' => $request->interviewer_name,
            'Interview Mode' => config('helpers.interview_mode')[$request->interview_mode],
            'Interview Link'=>$request->interview_link ?? '',
            'Interview Location'=>$request->interview_address ?? 'N/A',
            'Interview Type'=>$type ?? 'N/A',
        ];

        HelperFunctions::sendEmail($to, $mailableClass, $data);

        // try {
        //     HelperFunctions::sendEmailOnStatusChange([$request->application_id],6);
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }

        $activity = MainHelper::CreatejobApplicationLogs($application->user_id, $application->id, 'Interview Scheduled');

        return redirect()->back()->with('success',$successMessage);
    }

    public function shortlistedCandidates(Request $request) {
        if($request->filled('job_opening')){
           $jobOpeningDetail = JobOpening::find($request->job_opening);
           $query = JobOpeningApplication::where('job_opening_applications.job_opening_id', $request->job_opening)
                    ->where('job_opening_applications.status', 4)
                    ->join('users', 'job_opening_applications.user_id', '=', 'users.id')
                    ->select('users.*')
                    ->select('job_opening_applications.*');

           if($request->filled('search')) {
               $query->where('name', 'LIKE', '%' . $request->search . '%');
            }
            $interviewLists = $query->paginate();
        } else {
           $interviewLists = [];
           $jobOpeningDetail = [];
        }
        
        $departments = User::where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->whereNull('department_id')->pluck('name', 'id');
        $jobOpenings = JobOpening::where('company_id', auth()->user()->isCompany() ? auth()->user()->id : auth()->user()->company_id)->pluck('job_title', 'id');
 
        return view('admin.job-openings.shortlisted-candidates', compact('interviewLists','departments','jobOpenings', 'jobOpeningDetail'));
    }

    public function removeFromShortlist(Request $request)
    {
        // Get the list of selected candidate IDs
        $candidateIds = $request->input('candidate_ids');

        // Update the status of the selected candidates
        JobOpeningApplication::where('job_opening_id', $request->job_opening)->whereIn('user_id', $candidateIds)->update(['status' => 3]);

        return response()->json(['message' => 'Candidates removed from the shortlist successfully!']);
    }


    public function templateSelect(Request $request)
    {
        
      if($request->has('application_id')){
       $job = JobOpeningApplication::find($request->application_id);
       $job->template_id = $request->template_id;
       $job->save();
       $type = 'candidate';
       return redirect()->route('admin.contract.form',[$request->template_id,$job->id,$type]);

    }else{

        $job = User::find($request->user_id);
        // $job->template_id = $request->template_id;
        // $job->save();
        $type = 'employee';
        return redirect()->route('admin.contract.form',[$request->template_id,$job->id,$type]);
    }
 

    }

    public function applicantShow(Request $request,$id){
        
        $jobOpening = JobOpening::with(['education_level', 'education_year', 'education_program', 'industry', 'cities', 'job_skills', 'job_technical_skills'])->findOrFail($id);
        $query = JobOpeningApplication::select('job_opening_applications.*') // Select all columns from job_opening_applications
        ->where('job_opening_id', $id)
        ->join('users', 'users.id', '=', 'job_opening_applications.user_id');

        $statusCounts = JobOpeningApplication::where('status','!=',9)->where('job_opening_id', $id)->select('status', \DB::raw('count(*) as count'))
        ->groupBy('status')->pluck('count', 'status');
        // New filter for status
        if ($request->filled('status')) {
            $query->where('job_opening_applications.status', $request->status);
        }    
        
        if ($request->filled('suitability_rate')) {
            $query->where('job_opening_applications.matching_percentage','>=' ,$request->suitability_rate);
        }    
// dd($query->get());
        if ($request->filled('candidate_name')) {
            $query->where('users.name', 'LIKE', '%' . $request->candidate_name . '%');
        }

        
    
        if ($request->filled('education_level')) {
            $query->where('users.education_level', $request->education_level);
        }
        if ($request->filled('nationality')) {
            $query->where('users.country_id', $request->nationality);
        }
        // Adjusted search logic for job_title
        
        // dd($query->get());
        if ($request->filled('sort')) {
            if($request->sort_type) {
                $sort_type = $request->sort_type;
            } else {
                $sort_type = 'desc';
            }
            if ($request->sort == 'expected_salary') {
                $query->orderBy('expected_salary', $sort_type);
            } elseif ($request->sort == 'experience') {
                $query->orderBy('users.year_of_experience_in_it_sector', $sort_type);
            } elseif ($request->sort == 'suitability_rate') {
                $query->orderBy('matching_percentage', $sort_type);
            }
        }
        
        $jobOpeningApplications = $query->paginate(20);
        $countries = MasterCountry::get();
        $highest_education = MasterEducationLevel::get();

        $data = [
            'jobOpeningApplications'=>$jobOpeningApplications,
            'jobOpening'=>$jobOpening,
            'countries'=>$countries,
            'highest_education'=>$highest_education,
            'statusCounts'=>$statusCounts
        ];
        return view('admin.job-openings.applicants-listings', $data);
    }

    public function shortlistCandidate(Request $request)
    {
        // dd($request->applicant_ids);
        // Validate the request
        // $request->validate([
        //     'status' => 'required', // Adjust validation rules as needed
        // ]);


        
        // Update the job application's status
        // dd($jobOpeningApplication);
        foreach($request->applicant_ids as $applicationId){

            $jobOpeningApplication = JobOpeningApplication::where('id',$applicationId)->first();
            

            $jobOpeningApplication->status = 4;
            $jobOpeningApplication->save();
            // dd($jobOpeningApplication);
            if($request->status == 4){
                $activity = MainHelper::CreatejobApplicationLogs($jobOpeningApplication->user_id, $jobOpeningApplication->id, 'Candidate Shortlisted');
            }
            // elseif($request->status == 3){
            //     $activity = MainHelper::CreatejobApplicationLogs($jobOpeningApplication->user_id, $jobOpeningApplication->id, 'Candidate removed from Shortlist');
                
            // }
    
        
                $to = $jobOpeningApplication->external_user_email;
                $subject = 'Status Change Email';
                $message = 'This is the status change email';
                $mailableClass = 'SendApplicationStatusChangeEmail';
                $data = [
                    'status' => config('helpers.application_status')[$request->status] ?? '',
                    'company_name' => $jobOpeningApplication->jobOpening->company->name ?? ''
                ];
    
                HelperFunctions::sendEmail($to, $subject, $message, $mailableClass, $data);
          
    
        }


        // Redirect back with a success message
        return back()->with('success', 'Application status updated successfully.');
    }

    public function applicationDelete($id) {

        $jobApplication = JobOpeningApplication::find($id);
        $jobApplication->status = 9;
        $jobApplication->save();

    return back()->with('success', 'Application Removed successfully.');
    }
    
    public function updateApplicationPeriod(Request $request) {
        $request->validate([
            'job_id' => 'required|exists:job_openings,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:1,2'
        ]);
    
        $job = JobOpening::find($request->job_id);
        $job->application_period_start_date = $request->start_date;
        $job->application_period_end_date = $request->end_date;
        if ($request->status == 2) {
           $job->status = 2;
        }
        $job->save();
    
        return response()->json(['success' => true, 'message' => 'Application dates for '.$job->job_title.' successfully updated.']);
    }

    public function updateApplicationStatusToExpired(Request $request) {
        $request->validate([
            'job_id' => 'required|exists:job_openings,id',
            'status' => 'required|in:1,2,3'
        ]);
    
        $job = JobOpening::find($request->job_id);
        $job->status = $request->status;
        $job->save();
        
        $message = [3 => 'Advertisement for '.$job->job_title.' marked as expired.', 2 => 'Advertisement for '.$job->job_title.' re-launched successfully.'];

        return response()->json(['success' => true, 'message' => $message[$request->status]]);
    }

    

    public function deleteAdvertisement(Request $request) {
        $request->validate([
            'job_id' => 'required|exists:job_openings,id'
        ]);
    
        $job = JobOpening::find($request->job_id);

        $message ='The advertisement for '.$job->job_title.' has been successfully deleted and is no longer visible to the public.';

        $job->delete();
        
        return response()->json(['success' => true, 'message' => $message]);
    }

    public function convertToEmployee(Request $request)
    {
        $request->validate([
            'application_id_convert' => 'required|exists:job_opening_applications,id',
        ]);

        DB::beginTransaction();

        try {
            $jobOpeningApplication = JobOpeningApplication::with('jobOpening.job')->find($request->application_id_convert);
            $jobOpening = $jobOpeningApplication->jobOpening;
            $job = $jobOpening->job;

            if ($jobOpening->status != 2) {
                return back()->with('error', 'Job Advertisement is not active.');
            }

            $filledCounts = JobOpeningApplication::where('status', 12)
                            ->where('job_opening_id', $jobOpening->id)->count();

            if ($job->vacancy <= $filledCounts) {
                $job->vacancy = 0;
                $job->save();

                $jobOpening->status = 4;
                $jobOpening->application_filled_date = now();
                $jobOpening->save();

                DB::commit();
                return back()->with('error', 'Job Advertisement is already filled.');
            }

            // Update records
            $job->vacancy -= 1;
            $job->save();

            User::where('id', $jobOpeningApplication->user_id)->update([
                'position_id' => $jobOpening->job_id,
                'role_id' => 1,
                'role_name' => 'employee',
            ]);

            $jobOpeningApplication->status = 12;
            $jobOpeningApplication->save();

            $filledCounts += 1; // no need to recalculate

            if ($job->vacancy == 0 && $jobOpening->vacancies == $filledCounts) {
                $jobOpening->status = 4;
                $jobOpening->application_filled_date = now();
                $jobOpening->save();
            }

            DB::commit();

            return back()->with('success', 'Application converted to employee successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    

    public function convertToEmployeeAjax(Request $request): JsonResponse
    {
        $request->validate([
            'application_id_convert' => 'required|exists:job_opening_applications,id',
        ]);

        DB::beginTransaction();

        try {
            $conversionSingle = 1;
            $jobOpeningApplication = JobOpeningApplication::with('jobOpening.job')->find($request->application_id_convert);

            if ($jobOpeningApplication->status != 9) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only applications in the Offer Accepted stage can be converted to employees.'
                ]);
            }

            $jobOpening = $jobOpeningApplication->jobOpening;
            $job = $jobOpening->job;

            if ($jobOpening->status != 2) {
                if ($jobOpening->status == 4) {
                    return response()->json(['success' => false, 'message' => 'Job Advertisement is already filled.']);
                }
                return response()->json(['success' => false, 'message' => 'Job Advertisement is not active.']);
            }

            $filledCounts = JobOpeningApplication::where('status', 12)
                            ->where('job_opening_id', $jobOpening->id)->count();

            if ($job->vacancy <= 0) {
                $job->vacancy = 0;
                $job->save();

                $jobOpening->status = 4;
                $jobOpening->application_filled_date = now();
                $jobOpening->save();

                DB::commit();
                return response()->json(['success' => false, 'message' => 'Job Advertisement is already filled.']);
            }

            $job->vacancy -= 1;
            $job->save();

            User::where('id', $jobOpeningApplication->user_id)->update([
                'position_id' => $jobOpening->job_id,
                'role_id' => 1,
                'role_name' => 'employee',
            ]);

            $user = User::find($jobOpeningApplication->user_id);

            
            $user->secondary_email = $user->email;
            $user->email = $jobOpeningApplication->contract->emp_official_email;
            $user->company_id = $jobOpeningApplication->contract->company_id;
            $user->department_id = $jobOpening->department_id;
            $user->save();

            $to = $jobOpeningApplication->external_user_email ?? '';
       

            
            try {
                $mailableClass = 'convert_to_employee';

                $data = [
                        'Official Email' => $jobOpeningApplication->contract->emp_official_email ?? '',
                        'previous_email' => $user->secondary_email ?? '',
                        'Employee Full Name' => $user->name ?? '',
                        'Employee First Name' => $user->first_name ?? '',
                        'Employee Middle Name' => $user->middle_name ?? '',
                        'Employee Last Name' => $user->last_name ?? '',
                        'Job Title' => $jobOpeningApplication->jobOpening->job_title ?? '',
                        'Company Name' =>$user->company->userCompany->name ?? '',
                        'Start Date' => now()->format('Y-m-d')
                    ];
            
                HelperFunctions::sendEmail($to,$mailableClass, $data);
                
            } catch (\Throwable $th) {
                //throw $th;
            }


            $jobOpeningApplication->status = 12;
            $jobOpeningApplication->save();

            $filledCounts++;

            if ($job->vacancy == 0 && $jobOpening->vacancies == $filledCounts) {
                $jobOpening->status = 4;
                $jobOpening->application_filled_date = now();
                $jobOpening->save();
                $conversionSingle = 2;
            }

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Application converted to employee successfully.','conversionSingle'=>$conversionSingle]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

}
