<?php

namespace App\Http\Controllers\Candidate;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Application;
use App\Models\User;
use App\Models\JobOpening;
use App\Models\JobOpeningApplication;
use App\Models\JobOpeningSuitabilityRateSetting;
use App\Models\JobOpeningApplicationDocument;
use App\Models\MasterEducationLevel;
use App\Models\MasterCity;
use App\Models\JobBookmark;
use App\Models\jobOpeningApplicationUserDocument;
use Carbon\Carbon;
use App\Helpers\MainHelper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class JobsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
       
        // Retrieve filters from the request, defaulting to null if not present
        $query = JobOpening::with([
            'industry',
            'education_level',
            'education_year',
            'education_program',
            'cities',
            'job_skills',
            'job_technical_skills'
        ])->where('status', 2);
    
        // Apply filters based on the request

        if ($request->has('job_title')) {
            // For a simple match; use 'like' for partial matches
            $query->where('job_title', 'like', '%' . $request->input('job_title') . '%');
        }
        // dd($query->get());

        if ($request->has('department') && $request->input('department') !== '' && $request->input('department') !== null) {
            
            $query->where('department_id', $request->input('department'));
        }
    
        if ($request->has('education_level') && $request->input('education_level') !== '' && $request->input('education_level') !== null) {
           

            $query->where('education_level_id', $request->input('education_level'));
        }
    
        if ($request->has('employment_type') && $request->input('employment_type') !== '' && $request->input('employment_type') !== null) {
            

            $query->where('employment_type', $request->input('employment_type'));
        }

        // dd()
        
        $city='';
        if($request->has('city_filter') && $request->input('city_filter') !== '' && $request->input('city_filter') !== null){
            $query->where('city_id', $request->input('city_filter'));

            
            $city = MasterCity::find($request->city_filter);
            // $query->
        }
        
    
        if ($request->has('sort_by') && $request->input('sort_by') == 'title_desc') {

            $query->orderBy('job_title', 'desc'); // Reverse alphabetical order (Z-A)

        }else{
            $query->orderBy('job_title', 'asc'); // Alphabetical order (A-Z)
        }
       
   
        // $jobOpenings = $query->get();
        $jobOpenings = $query->paginate(10);
        // dd($jobOpenings);
        $educationlevel = MasterEducationLevel::get();
        $jobCount = $jobOpenings->total();

       
       
        if ($request->ajax()) {
            // return response()->json(view('avenger.frontend.job-card', compact('jobOpenings','jobCount','city'))->render());
            return response()->json([
                'view' => view('avenger.frontend.job-card', compact('jobOpenings', 'jobCount', 'city'))->render(),
                'jobCount' => $jobCount,
                'next_page_url' => $jobOpenings->nextPageUrl(),
                'city' => $city
            ]);
        }
    
        return view('avenger.frontend.jobs', ['jobOpenings' => $jobOpenings, 'educationlevel' => $educationlevel,'city'=>$city]);
    }
    

    public function detail($slug)
    {
        // Fetch job details
        $jobDetail = JobOpening::with([
            'company',
            'department',
            'position',
            'industry',
            'education_level',
            'education_year',
            'education_program',
            'cities',
            'job_skills',
            'job_technical_skills',
        ])->where('slug', $slug)->first();
        
        if (!$jobDetail) {
            abort(404, 'Job not found');
        }
        
        // Fetch related job openings only if the job exists
        $jobOpenings = JobOpening::with(['company', 'position', 'industry'])
            ->where('department_id', $jobDetail->department_id)
            ->where('status', 2)
            ->where('id', '!=', $jobDetail->id) // Exclude the current job
            ->limit(4)
            ->get();

        // If no related jobs found, fetch jobs with status 2
        if ($jobOpenings->isEmpty()) {
            $jobOpenings = JobOpening::with(['company', 'position', 'industry'])
                ->where('status', 2)
                ->orderBy('created_at', 'desc')
                ->limit(4)
                ->get();
        }

        // Define alert message based on job status
        $status = null;
        $message = null;
        
        if ($jobDetail->status == 3) {
            $status = 'alert-error';
            $message = 'The advertisement for this position has expired and is no longer publicly available. This preview is for reference only.';
        } elseif ($jobDetail->status == 1) {
            $status = 'alert-info';
            $message = 'The advertisement for this position has not been launched yet and is not publicly available. This preview is for reference only.';
        }

        // Return the view with variables
        return view('avenger.frontend.job-details', compact('jobDetail', 'jobOpenings', 'status', 'message'));
    }

    
    public function applyJob($slug){

        // dd($id);
        $jobOpening = JobOpening::where('slug',$slug)->first();
     

        $documents = JobOpeningApplicationDocument::where('job_opening_id', $jobOpening->id)->get();
        $jobapplication = JobOpeningApplication::where('job_opening_id', $jobOpening->id)
            ->where('user_id', auth()->user()->id)
            ->first();
        // dd($documents);
        $data = [
            'jobOpening'=>$jobOpening,
            'documents'=>$documents,
            'jobapplication'=>$jobapplication
        ];

        return view('avenger.frontend.job-apply',$data);
    }
    public function applySubmit(Request $request,$slug) 
    {
        // dd($request->all());
    
        $required = 'required';
        if(auth()->user()->cv_resume){
            $required = 'nullable';
        }
        $validatedData = $request->validate([
            'cv_resume' => $required,
            'salary_lower_bound'=>'required',
        ]);  

        $jobDetail = JobOpening::where('slug',$slug)->first();
        $user = Auth()->user();
            
        
        $jobOpeningApplication = JobOpeningApplication::where('user_id', $user->id)
        ->where('job_opening_id', $jobDetail->id)->where('application_status',1)
        ->first();

      
        if ($jobOpeningApplication) {
            return redirect()->route('applications')->with('error','Job Application already exists for this user for this job');

        }

       
        
            if ($request->salary_lower_bound > 0 && $request->salary_upper_bound > 0) {
                $expected_salary =  ($request->salary_lower_bound + $request->salary_upper_bound) / 2;
            }elseif($request->salary_lower_bound > 0){
                $expected_salary =  $request->salary_lower_bound;
            } else {
                $expected_salary =  0; // or some default value
            }
      
            // Create the job application
            $application = new JobOpeningApplication();
            $application->job_opening_id = $jobDetail->id;
            $application->external_user_id = $user->id;
            $application->user_id = $user->id;
            $application->application_status =1;
            $application->external_user_name = $user->name ?? '';
            $application->applied_date = Carbon::now('Asia/Manila');
            $application->status_changed_date = Carbon::now('Asia/Manila');
            $application->external_user_email = $user->email ?? '';
            $application->salary_lower_bound = $request->salary_lower_bound ?? '';
            $application->salary_upper_bound = $request->salary_upper_bound ?? '';
            $application->expected_salary = $expected_salary;

            
     
            $user = $application->user;
            $suitabilityRateCriterias = JobOpeningSuitabilityRateSetting::where('job_opening_id', $jobDetail->id)->get();
    //  dd($suitabilityRateCriterias);
    if($suitabilityRateCriterias->isNotEmpty()){
 
            $totalCriteriaCount = $suitabilityRateCriterias->count();
            $suitabilityRate = 0;
     
            foreach ($suitabilityRateCriterias as $criteria) {
                $weightage = $criteria->weightage / 100; // Calculate weightage once
                switch ($criteria->criteria_id) {
                    case 1: // Education Program
                        $suitabilityRate += ($user->education_program_id == $jobDetail->education_program_id)
                            ? 100 * $weightage
                            : 20 * $weightage;
                        break;
     
                    case 2: // Education Level
                        if ($user->education_level >= $jobDetail->education_level_id) {
                            $suitabilityRate += 100 * $weightage;
                        } else {
                            $difference = abs($user->education_level - $jobDetail->education_level_id);
                            $suitabilityRate += ($difference > 3)
                                ? 25 * $weightage
                                : 50 * $weightage;
                        }
                        break;
     
                    case 3: // Salary
                        if ($application->expected_salary <= $jobDetail->salary) {
                            $suitabilityRate += 100 * $weightage;
                        } else {
                            $difference = abs($application->expected_salary - $jobDetail->salary);
                            $percentage = ($difference / $jobDetail->salary) * 100;
     
                            if ($percentage <= 10) {
                                $suitabilityRate += 85 * $weightage;
                            } elseif ($percentage <= 20) {
                                $suitabilityRate += 75 * $weightage;
                            } elseif ($percentage <= 30) {
                                $suitabilityRate += 50 * $weightage;
                            } elseif ($percentage <= 40) {
                                $suitabilityRate += 30 * $weightage;
                            } else {
                                $suitabilityRate += 20 * $weightage;
                            }
                        }
                        break;
     
                    case 4: // Work Experience
                        $experienceDifference = abs($user->year_of_experience_in_it_sector - $jobDetail->work_experience);
                        if ($user->year_of_experience_in_it_sector >= $jobDetail->work_experience) {
                            $suitabilityRate += 100 * $weightage;
                        } elseif ($experienceDifference < 1) {
                            $suitabilityRate += 100 * $weightage;
                        } elseif ($experienceDifference <= 3) {
                            $suitabilityRate += 85 * $weightage;
                        } elseif ($experienceDifference <= 5) {
                            $suitabilityRate += 70 * $weightage;
                        } elseif ($experienceDifference <= 8) {
                            $suitabilityRate += 50 * $weightage;
                        } else {
                            $suitabilityRate += 30 * $weightage;
                        }
                        break;
                }
            }
     
            // Calculate and save the suitability rate
           
            $application->suitability_rate = $suitabilityRate / $totalCriteriaCount;
                   
    }
            // $jobApplication->save();
        try {
        
            $application->save();
            $activity = MainHelper::CreatejobApplicationLogs($user->id, $application->id, 'Candidate Applied to the job');
           
           
            $this->handleAdditionalDocumentUpload($request, $application, $user);

            if($request->hasFile('cv_resume')){
                $this->handleFileUpload($request, 'cv_resume', 'uploads/cv_resumes', $user);
            }

                $this->handleFileUpload($request, 'cover_letter', 'uploads/cover_letter', $application);

            // Load the JobOpening relationship data
            $application->load('jobOpening');

            $message = 'Success! You applied for the role '. $jobDetail->job_title ?? '';

        return redirect()->route('applications')->with('alert-success', $message);
        } catch (\Exception $e) {
            // Handle any exceptions during the save operation
            return response()->json([
            'message' => 'Failed to submit application.',
            'error' => $e->getMessage()
            ], 500);
        }

    }

    public function applications() {
        $user = auth()->user();
        
        // Fetch applications for the current user
        $applications = JobOpeningApplication::where('external_user_id', $user->id)->where('application_status',1)
                                             ->with('jobOpening')  // Ensure job details are included
                                             ->get();
    
        // Check if the jobOpening exists and is valid
        $jobOpeningApplication = $applications->first()->jobOpening ?? null;
    
        // If there's a valid job opening, fetch related jobs
        $jobOpenings = collect(); // Default to an empty collection if no valid jobOpening
    
        if ($jobOpeningApplication) {
            $jobOpenings = JobOpening::with(['company', 'position', 'industry'])
                ->where('department_id', $jobOpeningApplication->department_id)->where('status',2)
                ->where('id', '!=', $jobOpeningApplication->id) // Exclude the current job
                ->limit(4)
                ->get();
        }else{
            $jobOpenings =  JobOpening::with(['company', 'position', 'industry'])
            ->where('status',2)->orderBy('created_at','desc') // Exclude the current job
            ->limit(4)
            ->get();
        }
    
        // dd($relatedJobs);
        return view('avenger.frontend.applications', compact('applications', 'jobOpenings'));
    }


    
    public function bookmarkedJob() {
        $user = auth()->user();
        
        // Fetch applications for the current user
        $bookmarkIds = $user->jobBookmarks->pluck('job_id')->toArray();
        // dd($bookmarkIds);
        $bookmarks = [];
        if($bookmarkIds){
            $bookmarks = JobOpening::whereIn('id',$bookmarkIds)->get();
        }

        // Check if the jobOpening exists and is valid
        if($bookmarks){
            $jobOpeningBookmarks = $bookmarks->first() ?? null;

        }else{
            $jobOpeningBookmarks = '';
        }
    
        
        $jobOpenings = collect(); // Default to an empty collection if no valid jobOpening
    
        if ($jobOpeningBookmarks) {
            $jobOpenings = JobOpening::with(['company', 'position', 'industry'])
                ->where('department_id', $jobOpeningBookmarks->department_id)->where('status',2)
                ->whereNotIn('id',$bookmarkIds) // Exclude the current job
                ->limit(4)
                ->get();
        }
        
        if($jobOpenings->isEmpty()){
            $jobOpenings =  JobOpening::with(['company', 'position', 'industry'])
            ->where('status',2)->orderBy('created_at','desc') // Exclude the current job
            ->limit(4)
            ->get();
        }
    
        // dd($relatedJobs);
        return view('avenger.frontend.bookmark', compact('bookmarks', 'jobOpenings'));
    }
    

    public function getByCompany(Request $request)
    {
        $companyId = $request->company_id;
        // Get Departments
        $departments = [];
        $apiUrlForDepartment = env('API_URL').'rest/v1/job-openings/get-departments?company_id='.$companyId;
        $departmentResponse = Http::withHeaders([
            'x-api-key' => env('API_KEY'),
        ])->get($apiUrlForDepartment);

        // Check if the request was successful
        if ($departmentResponse->successful()) {
            // Assuming the API returns a JSON response, which is automatically converted to an array
            $departments = $departmentResponse->json();
        } else {
            // Handle the error or return a default response
            \Log::error('Company Retrieve API failed', ['response' => $departmentResponse->body()]);
            // return redirect()->back()->with('error', 'Failed to retrieve job openings.');
        }

        return $departments;
    }

    private function handleFileUpload(Request $request, $fieldName, $destinationPath, $user)
    {
        if ($request->hasFile($fieldName)) {
           
            $currentImagePath = public_path($destinationPath . '/' . $user->$fieldName);
            if (File::exists($currentImagePath)) {
                File::delete($currentImagePath);
            }
            $randomString = Str::random(50);
            $imageName = auth()->user()->first_name . '_' . auth()->user()->last_name . '_' . $randomString . '.' . $request->$fieldName->extension();
            $request->$fieldName->move(public_path($destinationPath), $imageName);
            $imagePath = $destinationPath . '/' . $imageName;

            $user->update([$fieldName => $imagePath]);
        }

    
    }

    private function handleAdditionalDocumentUpload(Request $request, $jobApplication, $user)
    {
        $destinationPath = 'uploads/jobapplication/documents';
    
        // Handle file uploads
        if ($request->hasFile('document')) {
            foreach ($request->file('document') as $documentId => $file) {
                if ($file->isValid()) {
                    $randomString = Str::random(50);
                    $imageName = auth()->user()->first_name . '_' . auth()->user()->last_name . '_' . $randomString . '.' . $file->extension();
                    $filePath = $file->storeAs($destinationPath, $imageName, 'public');
    
                    jobOpeningApplicationUserDocument::create([
                        'job_application_id' => $jobApplication->id,
                        'user_id' => $user->id,
                        'document_id' => $documentId,
                        'document' => 'storage/' . $filePath, // Storing in Laravel storage
                    ]);
                }
            }
        }
    
        // Handle website links
        if ($request->filled('url')) {
            $documents = collect($request->input('url'))->map(function ($link, $documentId) use ($jobApplication, $user) {
                return [
                    'job_application_id' => $jobApplication->id,
                    'user_id' => $user->id,
                    'document_id' => $documentId,
                    'document' => $link,
                ];
            })->toArray();
    
            jobOpeningApplicationUserDocument::insert($documents); // Bulk insert for efficiency
        }
    }
    
    
    public function applicationStatus(Request $request,$id)
    {
      
       $job = JobOpeningApplication::find($id);
        //    dd($request->application_status);
        //    $job->application_status = $request->application_status ?? 1;
        $job->application_status =0;
       $job->save();

       $activity = MainHelper::CreatejobApplicationLogs($job->user_id, $job->id, 'Candidate withdrew job application');
        // Redirect back with a success message
        $message = 'Success! You have withdrawn your application for the role ' . $job->jobOpening->job_title;
        return back()->with('alert-success', $message);
    }

    public function guestApply($slug)
    {
        session()->forget('job_id');
        $jobDetail = JobOpening::where('slug',$slug)->first();
      
       
        session()->put('job_opening_id', $jobDetail->id);
        
    
        // Redirect back with a success message
        return redirect('/register');
    }


    public function getJob($id)
    {
        try {
            $jobOpeningDetail = JobOpening::with([
                'company',
                'department',
                'position',
                'industry',
                'education_level',
                'education_year',
                'education_program',
                'cities',
                'job_position',
                'companyOverview'
            ])->findOrFail($id); 
            
            // Extract the related TechnicalSkill and assign it directly
            $jobOpeningDetail['technical_skill'] = $jobOpeningDetail->job_position->jobOpeningTechSkills->pluck('masterTechnicalSkill');
            // dd($jobOpeningDetail['technical_skill']);
            $jobOpeningDetail['generic_skill'] = $jobOpeningDetail->job_position->skills;
            $jobOpeningDetail['cwf'] = $jobOpeningDetail->job_position->criticalFunctions;
    
            // Check if user is authenticated and if the application exists
            $jobOpeningDetail['application_exist'] = auth()->check() && JobOpeningApplication::where('user_id', auth()->user()->id)
                ->where('job_opening_id', $jobOpeningDetail->id)->where('application_status',1)
                ->exists() ? 1 : 0;
                
            return response()->json([
                'status' => 'success',
                'data' => $jobOpeningDetail
            ], 200);  // 200 OK response
        
        } catch (\Exception $e) {
            // Handle any unexpected errors
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage() // Only return the message, not the entire exception
            ], 500);  // 500 Internal Server Error response
        }
    }
    
    
    public function toggleBookmark(Request $request)
    {
        $userId = auth()->id(); // Get the authenticated user
        $jobId = $request->job_id;

        $bookmark = JobBookmark::where('user_id', $userId)->where('job_id', $jobId)->first();

        if ($bookmark) {
            // If bookmark exists, remove it
            $bookmark->delete();
            return response()->json(['status' => 'removed']);
        } else {
            // If bookmark doesn't exist, create a new one
            JobBookmark::create(['user_id' => $userId, 'job_id' => $jobId]);
            return response()->json(['status' => 'added']);
        }
    }
}
