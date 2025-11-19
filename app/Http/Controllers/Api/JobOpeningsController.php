<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobOpening;
use App\Models\JobOpeningApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\JobOpeningResource;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Role;
use App\Models\TechnicalSkill;
use App\Models\MasterSkill;
use App\Jobs\AssessmentAlgoSubmit;
use App\Jobs\UpdateTechnicalAssessmentReport;
use App\Models\Department;
use App\Models\Contract;
use App\Helpers\MainHelper;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TechnicalSkillsUpdateImport;
use App\Imports\AirasiaJobProfileUpdateImport;
use Illuminate\Support\Facades\Storage;

class JobOpeningsController extends Controller
{
    // Display a listing of the job openings.
    public function index(Request $request) {
        $perPage = $request->input('perPage', 15); // Default to 15 items per page if not provided

        // Ensure perPage is within a reasonable range to prevent abuse
        $perPage = min(max($perPage, 1), 20);

        // Start building the query
        $query = JobOpening::with([
            'industry',
            'education_level',
            'education_year',
            'education_program',
            'cities',
            'job_skills',
            'job_technical_skills'
        ]);

        // Apply filters if present in the request
        if ($request->has('company_id')) {
            $query->where('company_id', $request->input('company_id'));
        }

        if ($request->has('department_id')) {
            $query->where('department_id', $request->input('department_id'));
        }

        if ($request->has('search')) {
            // For a simple match; use 'like' for partial matches
            $query->where('job_title', 'like', '%' . $request->input('search') . '%');
        }

        // if ($request->has('expected_salary')) {
        //     // Assuming you want to filter jobs with an expected salary greater than or equal to the provided amount
        //     $query->where('expected_salary', '>=', $request->input('expected_salary'));
        // }

        $jobOpenings = $query->paginate($perPage);
        // dd($jobOpenings);
        // return response()->json($jobOpenings);
        return JobOpeningResource::collection($jobOpenings);
    }

    public function detail($slug)
    {
        // Find the job opening by ID
        $jobOpening = JobOpening::with([
            'company',
            'department',
            'position',
            'industry',
            'education_level',
            'education_year',
            'education_program',
            'cities',
            'job_skills',
            'job_technical_skills'
        ])->where('slug',$slug)->first();

        // If the job opening doesn't exist, return a 404 response
        if (!$jobOpening) {
            return response()->json(['message' => 'Job opening not found'], 404);
        }

        // Return the job opening details
        // return response()->json($jobOpening);
        return new JobOpeningResource($jobOpening);
    }

    public function submitApplication(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'job_opening_id' => 'required|exists:job_openings,id',
            'external_user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $jobOpeningApplication = JobOpeningApplication::where('external_user_id', $request->external_user_id)
                                ->where('job_opening_id', $request->job_opening_id)
                                ->first();

        if ($jobOpeningApplication) {
            return response()->json([
                'message' => 'Job Application already exists for this user for this job',
                'error' => 'Job Application already exists for this user for this job'
            ], 400);
        }

        // Create the job application
        $application = new JobOpeningApplication();
        $application->job_opening_id = $request->job_opening_id;
        $application->external_user_id = $request->external_user_id;
        $application->external_user_name = $request->external_user_name;
        $application->applied_date = Carbon::now('Asia/Manila');
        $application->status_changed_date = Carbon::now('Asia/Manila');
        $application->matching_percentage = $request->matching_percentage;
        $application->external_user_email = $request->external_user_email;

        try {
            $application->save();

            // Load the JobOpening relationship data
            $application->load('jobOpening');

            // Optionally, use a resource for formatting the response
            // return new JobApplicationResource($application);

            // Return success response with application data including JobOpening data
            return response()->json([
                'message' => 'Application submitted successfully!',
                'application' => $application,
                'jobOpening' => $application->jobOpening // Including the related JobOpening data
            ], 201);
        } catch (\Exception $e) {
            // Handle any exceptions during the save operation
            return response()->json([
                'message' => 'Failed to submit application.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function getCompanies() {
        $companies = User::where('role_name', Role::$company)
                         ->select('name', 'id')
                         ->orderBy('created_at', 'DESC')
                         ->get();

        return response()->json($companies);
    }

    public function getDepartments(Request $request) {
        if($request->filled('company_id')) {
            $departments = Department::where('company_id', $request->company_id)->get();
        } else {
            $departments = Department::whereNotNull('company_id')->select('name', 'id')->get();
        }

        return response()->json($departments);
    }

    public function updateTechnicalExamScoreFromLms(Request $request) {
        // dd($request->application_id);
        try {
            // $user = User::find($request->user_id);

            // $user->tech_skill_score = $request->tech_skill_score;
            // $user->is_technical_assessment_completed = 1;
            // $user->save();

            $user = User::find($request->user_id);
            $user->tech_skill_score = $request->tech_skill_score;
            $user->technical_assessment_completed = 1;
            $user->save();

            if ($user->role_name == 'candidate') {
                $job_application = JobOpeningApplication::find($request->application_id);
                $job_application->tech_skill_score = $request->tech_skill_score;
                $job_application->technical_assessment_completed = 1;
                $job_application->save();
            }

              
            \Log::info("Job application",['response' => $job_application]);
            
            
              try {
                MainHelper::jobTriggerByType(auth()->user()->id,'technical',config('helpers.panel_names')[env('DB_DATABASE')]);
              } catch (\Throwable $th) {
                \Log::error($th);
              }

            return response()->json([
                'message' => 'Technical skill score updated successfully!',
            ], 201);

        } catch (\Exception $e) {
            // Handle any exceptions during the save operation
            return response()->json([
                'message' => 'Failed to submit application.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getApplications($external_user_id) {
        $applications = JobOpeningApplication::where('external_user_id', $external_user_id)->with('jobOpening')->get();
        return response()->json($applications);
    }



    public function getTechnicalSkills(Request $request) {
        $query = $request->q;
        $technicalSkills = TechnicalSkill::where('name', 'LIKE', "%{$query}%")->paginate(10);

        // dd($technicalSkills);

        return response()->json([
            'results' => $technicalSkills->map(function ($technicalSkill) {
                return ['id' => $technicalSkill->id, 'text' => $technicalSkill->name];
            }),
            'pagination' => [
                'more' => $technicalSkills->currentPage() < $technicalSkills->lastPage()
            ]
        ]);
    }

    public function getGenericSkills() {
        
        $technicalSkills = MasterSkill::get();

        // dd($technicalSkills);

        return response()->json([
            'success' => 1,
            'data' => $technicalSkills
        ]);
    }

    public function getcontract(Request $request) {
        
        
        $contract = Contract::where('employee_id',$request['user_id'])->first();

     

        return response()->json([
            'success' => 1,
            'data' => $contract
        ]);
    }

    public function getEmployeeDetail(Request $request) {
        
        
        $user = User::where('id',$request['user_id'])->first();

        // dd($contract);
     

        return response()->json([
            'success' => 1,
            'data' => $user
        ]);
    }

    
    public function uploadFile(Request $request)
    {
        set_time_limit(0);
        // dd($request->all());
        // Validate file input
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv',
        ]);

        // Store file
        $file = $request->file('file');
        $path = $file->storeAs('uploads', $file->getClientOriginalName());

        // Process the file (assumes you're using a package like Maatwebsite/Excel)
        Excel::import(new TechnicalSkillsUpdateImport, storage_path('app/'.$path));

        return response()->json(['message' => 'File processed successfully!']);
    }


}
