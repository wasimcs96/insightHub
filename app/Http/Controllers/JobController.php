<?php

namespace App\Http\Controllers;

use App\Helpers\AssessmentHelper;
use App\Models\CwfFunction;
use App\Models\Job;
use App\Models\JobSkill;
use App\Models\JobCriticalFunction;
use App\Models\MasterSkill;
use App\Models\TechnicalSkill;
use App\Models\User;
use App\Models\Department;
use App\Models\Sector;
use App\Models\TechnicalSkillCategory;
use App\Models\JobPerformanceExpectation;
use App\Models\JobSecondaryScopeOfStudy;
use App\Models\JobSubordinate;
use App\Models\JobTechnicalSkills;
use App\Models\MasterTechnicalSkill;
use App\Models\JobOpening;
use Illuminate\Http\Request;
use App\Helpers\MainHelper;
use App\Http\Controllers\Admin\DropdownController;
use App\Models\JobDraft;
use App\Models\JobFamily;
use App\Models\JobFamilyGroup;
use App\Models\JobProfile;
use App\Models\Division;
use App\Services\DropdownService;
use App\Services\Job\JobService;
use App\Services\Job\UpdateVacancyInJobService;
use Illuminate\Support\Facades\DB;
use App\Models\JobHeadcount;
use App\Models\BusinessUnit;

use App\Modules\Headcounts\Services\JobHeadcountService;
use App\Modules\Headcounts\Requests\StoreJobRequest;
use App\Modules\Headcounts\Requests\StoreHeadcountRequest;
use Illuminate\Http\RedirectResponse;
use App\Exports\JobFamilyTechnicalSkillExport;
use App\Models\MasterJob;
use Maatwebsite\Excel\Facades\Excel;


class JobController extends Controller
{

    protected $jobService;
    protected $updateVacancyInJobService;
    protected $modalService;

    public function __construct(UpdateVacancyInJobService $service,JobService $jobService,protected JobHeadcountService $hcService)
    {
        $this->updateVacancyInJobService = $service;
        $this->jobService = $jobService;
    }

    // Display a listing of the resource.
    public function index(Request $request)
    {
        
        if (auth()->user()->role_id == 7) {
            
            $levels = ["Level 1" => 1, "Level 2" => 2, "Level 3" => 3, "Level 4" => 4, "Level 5" => 5, "Level 6" => 6];
           
            $sectorName = $request->sector_name;
            // $sectors = Sector::all();
            $sectors = Sector::when($request->sector_name, function ($query, $sectorName) {
                return $query->where('name', 'like', '%' . $sectorName . '%');
            })->get();

            $departments = Department::where('company_id',auth()->user()->company_id)->get();

            $data = [];


                foreach ($sectors as $key => $value) {
                        
                  
                    $jobsQuery1 = MasterJob::where('is_primary', 1)->where('department_id', $value->id)->count();
                    

                    $data[$value->name] = ["icon"=>$value->icon,"id" => $value->id, "count" => $jobsQuery1];
                }
           

            return view('admin.jd_dashboard', compact('data'));
        } else {
            $levels = ["Level 1" => 1, "Level 2" => 2, "Level 3" => 3, "Level 4" => 4, "Level 5" => 5, "Level 6" => 6];

            $sectorName = $request->sector_name;
            // $sectors = Sector::all();
            $sectors = Sector::when($request->sector_name, function ($query, $sectorName) {
                return $query->where('name', 'like', '%' . $sectorName . '%');
            })->get();

            $departments = Department::where('company_id',auth()->user()->id)->get();

            $data = [];

                foreach ($sectors as $key => $value) {
                        
                  
                        $jobsQuery1 = MasterJob::where('is_primary', 1)->where('department_id', $value->id)->count();
                    

                    $data[$value->name] = ["icon"=>$value->icon,"id" => $value->id, "count" => $jobsQuery1];
                }
           

            return view('admin.jd_dashboard', compact('data'));
        }
    }

        // Display a listing of the resource.
        // public function savedJobs(Request $request)
        // {
               
        //     if (auth()->user()->role_id == 7) {
                
        //         $levels = ["Level 1" => 1, "Level 2" => 2, "Level 3" => 3, "Level 4" => 4, "Level 5" => 5, "Level 6" => 6];
    
        //         $sectors = Sector::all();

        //         $query = Department::where('company_id',auth()->user()->company_id);
        //         if(request()->has('name')){
        //            $query->where('name', 'like', '%' . $request->name . '%');
        //         }
               
        //         $departments = $query->get();

        //         $data = [];
    
                
        //             foreach ($departments as $key => $value) {
                        
                        
        //                 $jobsQuery1 = Job::where('is_primary', 0)->where('org_department', $value->id)->count();
                      
    
        //                 $data[$value->name] = ["icon"=>'',"id" => $value->id, "count" => $jobsQuery1];
        //             }
    
        //         return view('admin.jd.saved_jd_dashboard', compact('data'));
        //     } else {
        //         $levels = ["Level 1" => 1, "Level 2" => 2, "Level 3" => 3, "Level 4" => 4, "Level 5" => 5, "Level 6" => 6];
    
        //         $sectors = Sector::all();
    
        //         // $departments = Department::where('company_id',auth()->user()->id)->get();
        //         $query = Department::where('company_id',auth()->user()->id);
        //         if(request()->has('name')){
        //            $query->where('name', 'like', '%' . $request->name . '%');
        //         }
               
        //         $departments = $query->get();

        //         $data = [];
    
    
    
                
        //         foreach ($departments as $key => $value) {
                        
                        
        //                 $jobsQuery1 = Job::where('is_primary', 0)->where('org_department', $value->id)->count();
                      
    
        //                 $data[$value->name] = ["icon"=>'',"id" => $value->id, "count" => $jobsQuery1];

        //         }
    
        //         return view('admin.jd.saved_jd_dashboard', compact('data'));
        //     }
        // }
    public function savedJobs(Request $request)
        {
             
            // dd('ad');

            $jobFamilies = Null;
           
       
            
            if ($request->has('job_family_group_id')) {
                  
  
                   $jobFamiliesQuery = Department::query()->where('status',1)
                        ->where('division_id', $request->job_family_group_id)
                        ->withCount([
                            'jobs as approved_jobs_count' => function ($query) {
                                $query->where('is_primary', 0)
                                    ->whereNotNull('job_profile_id') // Instead of `where('job_profile_id', '!=', null)`
                                    ->where('status', 1);
                            },
                            'jobs as pending_jobs_count' => function ($query) {
                                $query->where('is_primary', 0)
                                    ->whereNotNull('job_profile_id') // Instead of `where('job_profile_id', '!=', null)`
                                    ->where('status', 2);
                            },
                        ]);

                    $jobFamilies = $jobFamiliesQuery->get();
                    $data = [
                            'jobFamilies'=>$jobFamilies,
                    ];
              
            return view('admin.jd.saved_jd_jobFamily', $data);

            }else{

            $jobFamilyGroups = Division::query()->where('status',1);
            $businessUnits = DropdownService::getBusinessUnits();
            
            // $jobFamilyGroups->where('id',73);

            if ($request->has('business_unit') && $request->business_unit !== 'all') {
                $jobFamilyGroups->where('business_unit_id',$request->business_unit);
            }

                $jobFamilyGroups = $jobFamilyGroups->get();
                $data = [
                   'jobFamilyGroups' =>$jobFamilyGroups,
                   'businessUnits'=>$businessUnits,
                ];
             return view('admin.jd.saved_jd_dashboard', $data);

            }
          
          

       
            // Return the data to the view for initial loading
        }



    // Show the form for creating a new resource.
    public function create()
    {

        $departments = Sector::all();

        $orgDepartments = Department::where('company_id',auth()->user()->id)->where('status',1)->get();

        if (auth()->user()->role_id == 7) {
           $orgDepartments = Department::where('company_id',auth()->user()->company_id)->where('status',1)->get();  
        }

        $data = [];

        foreach ($departments as $key => $value) {
            $data[$value->name] = $value->id;
        }

        $jobs = MasterJob::where('is_primary', 1)->get();
        $existingJobs = Job::where('is_primary', 0)->get();
        $masterSkills = MasterSkill::all();
        $technicalSkills = [];

        $businessUnits = DropdownService::getBusinessUnits();
    
        $isTopExists = false;
        $topJobTitle = null;
        $topJobId = null;

        $topJob = null;

        $isTopExists = Job::where('is_top', 1)->exists();

        if ($isTopExists) {
            $topJob = Job::where('is_top', 1)->select('id','title','code')->first();
            $topJobTitle = $topJob->title;
            $topJobId = $topJob->id;
        }

        return view('admin.setting.job_create', compact('jobs', 'masterSkills', 'technicalSkills', 'data','orgDepartments','existingJobs','businessUnits','isTopExists','topJob','topJobTitle','topJobId'));
    }

    function extractJobIdFromCode(string $code): ?int
    {
        $parts = explode('-', $code);
        return isset($parts[1]) ? (int)$parts[1] : null;
    }




    // Store a newly created resource in storage.
    public function store(StoreJobRequest $request): RedirectResponse
    {   
        
        $validatedData = $request->validated();

        $job_type = 'custom';

        $job = new Job();

        $jobId = $this->extractJobIdFromCode($request->headcounts[0]['id']);

        $existingTop = Job::where('is_top', 1)->where('id', '!=', $job->id)->first();

        if ($jobId != null) {
            if (\App\Models\Job::where('id', $jobId)->exists()) {
                // flash an error and redirect back
                return redirect()->back()
                                 ->withInput()
                                 ->withErrors(['position_code' => 'Failed to create Job: generated Job ID already exists.']);
            }
            $job->incrementing = false;
            $job->id = $jobId;
        }

        $job->title = $validatedData['title'];
        $job->status = $validatedData['status'];
        $job->description = $validatedData['description'];
        $job->heads = count($validatedData['headcounts']);
        $job->vacancy = count($validatedData['headcounts']);
        $job->level = $validatedData['level'];
        $job->org_department = $validatedData['org_department'];
        $job->code = $validatedData['position_code'];
        $job->position_code = Job::generateUniquePositionCode();
        $job->saved_job = 1;

        if ($request->has('is_top') && $request->is_top == "on") {
            $job->is_top = 1;
        } else {
            $job->is_top = 0;
        }

        if ($request->has('is_critical') && $request->is_critical == "on") {
            $job->is_critical = 1;
        } else {
            $job->is_critical = 0;
        }

        if($request->has('superior') && $request->superior != null){
            $job->superior_id = $request->superior;
        }

        $job->education_level = $request->education_level;
        $job->scope_of_study = $request->scope_of_study;
        $job->professional_certificate = $request->professional_certificate;
        $job->relevant_training = $request->relevant_training;
        $job->work_experience = $request->work_experience;
        $job->relevant_course = $request->relevant_course;
        $job->business_unit_id = $request->business_unit_id;
        $job->division_id = $request->division_id;

        if ($jd_from = $request->jd_from) {
            
            if ($jd_from == "2") {
                if ($job_type = $request->job_type) {
                    $job->department_id = $validatedData['org_department'];
                    $job->sector_id = $request->sector_id;
                    $job->level = $request->level;
                    $job->top3riasec = $request->top3riasec;
                    $masterJob = Job::where('id',$job_type)->first();
                    $job->sierra_id = $job_type;
                    $job->master_id = $job_type;
                    $job->job_type = 'master';
                }
            }else if ($jd_from == "3") {
                if ($job_type = $request->job_type) {
                    $job->level = $request->level;
                    $job->top3riasec = $request->top3riasec;
                    $masterJob = Job::where('id',$job_type)->first();
                    $job->sierra_id = $masterJob->sierra_id;
                    $job->master_id = $job_type;
                    $job->job_type = 'saved';
                }
            } else if ($jd_from == "1") {
                    $job->level = $request->level;
                    $job->job_type = 'custom';
                    $job->top3riasec = implode("", $request->riasec);                
            } else if ($jd_from == "4") {
                $job->level = $request->level;
                $job->job_type = 'ai';
                $job->top3riasec = $request->riasec;         
            }
            else if ($jd_from == "5") {
                $job->level = $request->level;
                $job->job_type = 'ai_gen';
                $job->top3riasec = $request->riasec;         
            }
        }

        if ($superior = $request->superior) {
            $job->superior_id = $superior;
        }


        $job->save();

        if (!empty($request->headcounts) && is_array($request->headcounts)) {

            $batch = [];
            foreach ($validatedData['headcounts'] ?? [] as $hc) {
                // e.g. ["CEO01","4890","01"]
                [$prefix, $jobId, $seq] = explode('-', $hc['id']);

                $parentId = null;
                if (!empty($hc['superior'])) {
                    // use service to look up by code
                    $parent = $this->hcService->findByCode($hc['superior']);
                    $parentId = $parent?->id;
                }

                $batch[] = [
                    'job_id'            => (int)$jobId,
                    'headcount_code'    => $hc['id'],
                    'parent_id'         => $parentId,
                    'department_id'     => $validatedData['org_department'],
                    'headcount_number'  => (int)$seq,
                    'orgMetadata' => [
                                    'action' => 'add_position',
                                    'reason' => "",
                                    'node' => ['data'=>['code'=>$hc['id']]],
                                    'source'=>"Job Management",

                    ]
                ];
            }

            // 2) Delegate creation to the module’s service
            if (! empty($batch)) {
                $this->hcService->createBatch($batch, $validatedData['org_department']);
            }
        }

        if ($job->is_top == 1) {
            // Check if another top job already exists
            
    
            if ($existingTop) {
                // This will handle the demotion + headcount re-assignments
                $this->hcService->replaceTopPosition($existingTop, $job);
            }
        }

        // Handle job skills
        foreach ($request->skills as $skillData) {
            if ($skillData['title'] != null) {
                $skill = new JobSkill();
                $skill->job_id = $job->id;
                $skill->title = $skillData['title'] ?? '';
                $skill->level = $skillData['level'];
                $skill->save();
            }
        }

        JobTechnicalSkills::where('job_id', $job->id)->delete();

        // Handle technical skills association
        if ($request->has('technicalSkills')) {
            foreach ($request->technicalSkills as $skillId => $data) {
                if (array_key_exists('id',$data) && $data['id']) {
                $tech = new JobTechnicalSkills();
                $tech->job_id = $job->id;
                $tech->master_technical_skill_id = $data['id'];
                $tech->level = $data['level'];
                $tech->save();
                }
            }
        }

        if ($request->has('subordinates') && count($request->subordinates) > 0) {
            foreach ($request->subordinates as $key22 => $value22) {
                JobSubordinate::create(['job_id'=>$job->id,'subordinate_id'=>$value22]);
            }
        }
        

        // Handle job critical functions
        foreach ($request->functions as $functionData) {

            $function = new JobCriticalFunction();
            $function->job_id = $job->id;
            $function->description = $functionData['title'] ?? '';
            $function->save();

            if (array_key_exists("keys",$functionData) && $functionData['keys'] && count($functionData['keys']) > 0) {
                foreach ($functionData['keys'] as $val1) {
                    $cwfunction = new CwfFunction();
                    $cwfunction->cwf_id = $function->id;
                    $cwfunction->name = $val1 ?? '';
                    $cwfunction->save();
                }
            }
        }

        if ($request->perfomance_expectation && count($request->perfomance_expectation) > 0) {
            foreach ($request->perfomance_expectation as $val1) {
                $perfomance_expectation = new JobPerformanceExpectation();
                $perfomance_expectation->job_id = $job->id;
                $perfomance_expectation->title = $val1 ?? '';
                $perfomance_expectation->save();
            }
        }

        if ($request->secondary_scope_of_study && count($request->secondary_scope_of_study) > 0) {
            foreach ($request->secondary_scope_of_study as $val1) {
                $secondary_scope_of_study = new JobSecondaryScopeOfStudy();
                $secondary_scope_of_study->job_id = $job->id;
                $secondary_scope_of_study->title = $val1 ?? '';
                $secondary_scope_of_study->save();
            }
        }
        
        return redirect()->route('admin.saved.jobdescriptions',['org_department'=>$job->org_department])->with('success', 'Job created successfully.');
    }

    public function duplicateFromSierra(Request $request)
    {

        // set_time_limit(1200);   
        $id = Sector::all();
        $allJobs = [];

        foreach ($id as $key => $value) {
            $ch = curl_init();

            // Data to be sent in the URL query string
            $data = ['department_id' => $value->sierra_id];
            $query = http_build_query($data);

            // Append the query string to the URL
            $url = "https://sierra.cxs.team/api/job-description/by_department?" . $query;

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL peer verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  // Disable SSL host verification

            // Since it's a GET request, we don't set CURLOPT_POST or CURLOPT_POSTFIELDS
            $response = curl_exec($ch);
            curl_close($ch);
            $jobs = json_decode($response);
            
            foreach ($jobs as $key1 => $value1) {
                $allJobs[$key1] = $value1;
            }


        }

        $allJobsData = [];

        foreach ($allJobs as $key3 => $value3) {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://sierra.cxs.team/api/job-description/job/select");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL peer verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  // Disable SSL host verification
            curl_setopt($ch, CURLOPT_POST, true);

            $data = ['id' => $key3];
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

            $response = curl_exec($ch);

            curl_close($ch);

            $jobsierra = json_decode($response);

            $technicalSkills = $jobsierra->job->technical_skills;

            
            array_push($allJobsData,$jobsierra->job);
        }

        foreach ($allJobsData as $key4 => $value4) {
            $jobCheck = Job::where('sierra_id',$value4->id)->where('is_primary',1)->first();
            if (!$jobCheck) {
                if($value4->top3riasec && $value4->top3riasec != '' ){
                    $job = new Job();
                    $job->title = $value4->title;
                    $job->description = $value4->description;
                    $job->is_primary = 1;
                    $job->heads = 1;
                    $job->level = $value4->level;
                    $job->saved_job = 0;
                    $job->position_code = AssessmentHelper::generateUniquePositionCode();
                    $job->department_id = Sector::where('sierra_id',$value4->department_id)->first()->id;
                    $job->sierra_id = $value4->id;
                    $job->top3riasec = $value4->top3riasec;
                    $job->save();
    
                    foreach ($value4->skills as $skillData) {
                        $skill = new JobSkill();
                        $skill->job_id = $job->id;
                        $skill->title = $skillData->title ?? '';
                        $skill->level = $skillData->level;
                        $skill->save();
                    }
    
                    // Handle job critical functions
                    foreach ($value4->critical_functions as $functionData) {
    
                        $function = new JobCriticalFunction();
                        $function->job_id = $job->id;
                        $function->description = $functionData->description ?? '';
                        $function->save();
    
                        if ($functionData->cwf_keys && count($functionData->cwf_keys) > 0) {
                            foreach ($functionData->cwf_keys as $val1) {
                                $cwfunction = new CwfFunction();
                                $cwfunction->cwf_id = $function->id;
                                $cwfunction->name = $val1->name ?? '';
                                $cwfunction->save();
                            }
                        }
                    }
    
                    // Handle technical skills association
                    if ($value4->technical_skills) {
                        foreach ($value4->technical_skills as $skillId => $data) {
                            $tech = new JobTechnicalSkills();
                            $tech->job_id = $job->id;
                            $tech->master_technical_skill_id = $data->id;
                            $tech->level = $data->pivot->level;
                            $tech->save();
                        }
                    }
                }
             }
        }



        return redirect()->route('admin.jobdescriptions',['department'=>$job->department_id])->with('success', 'Job created successfully.');
    }


    // Show the form for editing the specified resource.
    public function edit(Job $job)
    {
        $masterSkills = MasterSkill::all();


        try {
            if ($job->sierra_id && $job->sierra_id != null) {
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "https://sierra.cxs.team/api/job-description/job/select");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL peer verification
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  // Disable SSL host verification
                curl_setopt($ch, CURLOPT_POST, true);

                $data = ['id' => $job->sierra_id];
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

                $response = curl_exec($ch);

                curl_close($ch);

                $jobsierra = json_decode($response);

                $technicalSkills = $jobsierra->job->technical_skills;
            } else {
                $technicalSkills = $job->technicalSkills;
            }
        } catch (\Throwable $th) {
            $technicalSkills = $job->technicalSkills;
        }
        

        $job = Job::with('criticalFunctions.cwfKeys')->find($job->id);

        $existingJobs = Job::where('is_primary', 0)->get();

        $orgDepartments = Department::where('company_id',auth()->user()->id)->where('status',1)->get();

        if (auth()->user()->role_id == 7) {
            $orgDepartments = Department::where('company_id',auth()->user()->company_id)->where('status',1)->get();  
        }

        $businessUnits = DropdownService::getBusinessUnits();

        $data = Sector::all();

        $superiorHeadcounts = null;
        $superiorHeadcountCodes =[];
        $superiorNames = [];
        if ($job->superior_id) {
            $superiorJob = Job::with('headcounts.user')->find($job->superior_id);
            $superiorHeadcounts = $superiorJob?->headcounts;
            $superiorHeadcountCodes = $superiorJob?->headcounts->pluck('headcount_code')->toArray();
            

            foreach ($superiorHeadcounts as $headcount) {
                $code = (string) $headcount->headcount_code;
                $superiorNames[$code] = $headcount->user_id && $headcount->user ? $headcount->user->name : 'Vacant';
            }

        }

        return view('admin.setting.job_edit', compact('job', 'masterSkills', 'technicalSkills','orgDepartments','existingJobs','businessUnits','data','superiorHeadcounts','superiorHeadcountCodes','superiorNames'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Job $job)
    {
        $messages = [
            'functions.required' => 'Please add at least one critical function.',
            'functions.*.title.required' => 'Each critical function must have a title.',
            'technicalSkills.required' => 'Please add at least one technical skill.',
            'headcounts.required'           => 'Please add at least one headcount.',
            'headcounts.array'              => 'Invalid headcount data submitted.',
            'headcounts.min'                => 'Please add at least one headcount.',
            'headcounts.*.id.required'      => 'Headcount code is required.',
            'headcounts.*.id.regex'         => 'Headcount code must be in the format ABC-1234-01.',
            'headcounts.*.superior.regex'   => 'Superior headcount code must be in the format ABC-1234-01.',
        ];
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'functions' => 'required|array|min:1', // Ensures that there is at least one function
            'functions.*.title' => 'required|string', // Ensures each function has a title
            'technicalSkills' => 'required|array|min:1', // Ensures that there is at least one function
            'department_id'=> 'required', 
            'status' => 'required',
            'headcounts'=> ['required','array','min:1'],
            'headcounts.*.id'=> ['required','regex:/^[A-Z0-9]+-\d+-\d{2}$/'],
            'headcounts.*.superior'=> ['nullable','regex:/^[A-Z0-9]+-\d+-\d{2}$/'],
            // 'position_code' => 'required|unique:jobs,position_code,' . $job->id,

        ], $messages);

        $job->title = $validatedData['title'];
        $job->status = $validatedData['status'];
        $job->description = $validatedData['description'];
        $job->heads = count($validatedData['headcounts']);
        $totalEmployees = User::where('position_id', $job->id)->count();
        $job->vacancy = count($validatedData['headcounts']) - $totalEmployees;
        $newLevel = $request->level_job;

        $job->updateLevelSafely($newLevel);
        

        if ($job->department_id != $validatedData['department_id']) {
            $this->hcService->updateHeadcountDepartment($job->id, $validatedData['department_id']);
        }
        $job->org_department = $validatedData['department_id'];
        $job->department_id = $validatedData['department_id'];
        $job->saved_job = 1;
        $job->education_level = $request->education_level;
        $job->scope_of_study = $request->scope_of_study;
        $job->professional_certificate = $request->professional_certificate;
        $job->relevant_training = $request->relevant_training;
        $job->work_experience = $request->work_experience;
        $job->relevant_course = $request->relevant_course;
        $job->business_unit_id = $request->business_unit_id;
        $job->division_id = $request->division_id;

        $job->is_critical = $request->has('is_critical') && $request->is_critical == "on" ? 1 : 0;

        if ($superior = $request->superior) {
            $job->superior_id = $superior;
        }

        if ($job->job_type == "custom") {
            $job->top3riasec = implode("", $request->riasec);                
        }


        $job->save();


        $this->updateVacancyInJobService->updateVacancyOnJobEdit($job->id);

        if (!empty($request->headcounts) && is_array($request->headcounts)) {

            $batch = [];
            foreach ($validatedData['headcounts'] ?? [] as $hc) {
                // e.g. ["CEO01","4890","01"]
                [$prefix, $jobId, $seq] = explode('-', $hc['id']);

                $parentId = null;
                if (!empty($hc['superior'])) {
                    // use service to look up by code
                    $parent = $this->hcService->findByCode($hc['superior']);
                    $parentId = $parent?->id;
                }

                $batch[] = [
                    'id'    => $hc['id'],
                    'job_id'            => (int)$jobId,
                    'headcount_code'    => $hc['id'],
                    'parent_id'         => $parentId,
                    'department_id'     => $validatedData['department_id'],
                    'headcount_number'  => (int)$seq,
                ];
            }

            // 2) Delegate creation to the module’s service
            if (! empty($batch)) {
                $this->hcService->updateBatch($batch, $job->id);
            }
        }



        JobSkill::where('job_id',$job->id)->delete();
        // Handle job skills update
        foreach ($request->skills as $skillData) {
            if ($skillData['title'] != null) {
                $skill = new JobSkill();
                $skill->title = $skillData['title'] ?? '';
                $skill->level = $skillData['level'];
                $skill->job_id = $job->id;
                $skill->save();
            }
        }

        // $job->technicalSkills()->detach(); // Remove all existing associations

        JobTechnicalSkills::where('job_id', $job->id)->delete();

        

        if ($request->has('technicalSkills')) {
            foreach ($request->technicalSkills as $skillId => $data) {
                if (array_key_exists('id',$data) && $data['id']) {
                    $tech = new JobTechnicalSkills();
                    $tech->job_id = $job->id;
                    $tech->master_technical_skill_id = $data['id'];
                    $tech->level = $data['level'];
                    $tech->save();
                }
            }
        }


        // Handle job critical functions update
        JobCriticalFunction::where('job_id', $job->id)->delete();
        foreach ($request->functions as $functionData) {
            $function = new JobCriticalFunction();
            $function->job_id = $job->id;
            $function->description = $functionData['title'] ?? '';
            $function->save();

            // Assuming you are also handling some sort of keys for each function
            if (array_key_exists("keys",$functionData) && !empty($functionData['keys'])) {
                foreach ($functionData['keys'] as $key) {
                    $cwfunction = new CwfFunction();
                    $cwfunction->cwf_id = $function->id;
                    $cwfunction->name = $key ?? '';
                    $cwfunction->save();
                }
            }
        }

        

        if ($job->subordinates->count() > 0) {
            JobSubordinate::where('job_id',$job->id)->delete();
        }

        if ($request->has('subordinates') && count($request->subordinates) > 0) {
            foreach ($request->subordinates as $key22 => $value22) {
                JobSubordinate::create(['job_id'=>$job->id,'subordinate_id'=>$value22]);
            }
        }

        JobPerformanceExpectation::where('job_id', $job->id)->delete();
        if ($request->perfomance_expectation && count($request->perfomance_expectation) > 0) {
            foreach ($request->perfomance_expectation as $val1) {
                $perfomance_expectation = new JobPerformanceExpectation();
                $perfomance_expectation->job_id = $job->id;
                $perfomance_expectation->title = $val1 ?? '';
                $perfomance_expectation->save();
            }
        }

        JobSecondaryScopeOfStudy::where('job_id', $job->id)->delete();
        if ($request->secondary_scope_of_study && count($request->secondary_scope_of_study) > 0) {
            foreach ($request->secondary_scope_of_study as $val1) {
                $secondary_scope_of_study = new JobSecondaryScopeOfStudy();
                $secondary_scope_of_study->job_id = $job->id;
                $secondary_scope_of_study->title = $val1 ?? '';
                $secondary_scope_of_study->save();
            }
        }

        try {
            $jobAds = JobOpening::where('job_id', $job->id)->whereNotIn('status', [3, 4])->get();

            foreach ($jobAds as $jobAd) {
                $jobAd->vacancies = $job->vacancy;
                $jobAd->save();
            }
          }
          
        //catch exception
        catch(Exception $e) {
           //
        } 

        if ($job->is_primary == "0") {
            return redirect()->route('admin.saved.jobdescriptions',['org_department'=>$job->org_department,'saved_job'=>'1'])->with('success', 'Job updated successfully.');
        }else{
            return redirect()->route('admin.jobdescriptions',['department'=>$job->department_id])->with('success', 'Job updated successfully.');
        }
    }

    // Remove the specified resource from storage.
    // public function destroy(Job $job)
    // {
    //     // $jobs = Job::where('is_primary',1)->get();

    //     // foreach ($jobs as $key => $job) {
    //         $department_id = $job->org_department;
    //         // Delete associated job skills
    //         $job->skills()->delete();
        
    //         // Delete associated job critical functions
    //         $job->criticalFunctions()->delete();
        
    //         // Delete the job itself
    //         $job->delete();
    //     // }

    //     // $department_id = $job->org_department;
    //     // // Delete associated job skills
    //     // $job->skills()->delete();
    
    //     // // Delete associated job critical functions
    //     // $job->criticalFunctions()->delete();
    
    //     // // Delete the job itself
    //     // $job->delete();
        
    //     return redirect()->route('admin.saved.jobdescriptions',['org_department'=>$department_id])->with('success', 'Job deleted successfully.');
    // }

    public function destroy(Job $job)
{
    $department_id = $job->org_department;

    // Step 1: Get all master technical skill IDs for this job
    $masterTechnicalIds = $job->jdTechSkills->pluck('master_technical_skill_id')->unique();

    // Step 2: Delete the jdTechSkills entries (before checking usage in other jobs)
    $job->jdTechSkills()->delete();

    // Step 3: Find master skills used in other jobs (avoid N queries in loop)
    // if ($masterTechnicalIds->isNotEmpty()) {
    //     $usedElsewhere = \App\Models\JobTechnicalSkills::whereIn('master_technical_skill_id', $masterTechnicalIds)
    //         ->where('job_id', '!=', $job->id)
    //         ->pluck('master_technical_skill_id')
    //         ->unique();

    //     // Find IDs not used elsewhere
    //     $unusedIds = $masterTechnicalIds->diff($usedElsewhere);

    //     // Delete only unused master technical skills
    //     if ($unusedIds->isNotEmpty()) {
    //         \App\Models\MasterTechnicalSkill::whereIn('id', $unusedIds)->delete();
    //     }
    // }

    // Step 3: Find master skills used in other jobs (avoid N queries in loop)
    if ($masterTechnicalIds->isNotEmpty()) {
        $usedElsewhere = \App\Models\JobTechnicalSkills::whereIn('master_technical_skill_id', $masterTechnicalIds)
            ->where('job_id', '!=', $job->id)
            ->pluck('master_technical_skill_id')
            ->unique();

        // Find IDs not used elsewhere
        $unusedIds = $masterTechnicalIds->diff($usedElsewhere);

        // Delete only unused master technical skills
        if ($unusedIds->isNotEmpty()) {
            \App\Models\MasterTechnicalSkill::whereIn('id', $unusedIds)->whereIn('is_custom', [1, 2])->delete();
            if ($department_id) {
                $jobIds = \App\Models\Job::where('department_id', $department_id)
                ->pluck('id')
                ->toArray();
                   if (!empty($jobIds)) {
                        // Step 2: Find all master_technical_skill_ids that ARE used by OTHER jobs in this family
                         $skillsUsedInJobFamily = \App\Models\JobTechnicalSkills::whereIn('job_id', $jobIds)
                            ->whereIn('master_technical_skill_id', $masterTechnicalIds)
                            ->where('job_id', '!=', $job->id) // exclude current job
                            ->pluck('master_technical_skill_id')
                            ->unique();
                            
                        // Step 3: Find IDs from $unusedIds that are NOT used in this job family
                        $unusedInFamily = $masterTechnicalIds->diff($skillsUsedInJobFamily);
                
                        // Step 4: Delete only these unused skills in JobFamilyTechnicalSkills relation for the job family
                        if ($unusedInFamily->isNotEmpty()) {
                            \App\Models\DepartmentTechnicalSkills::where('department_id', $department_id)
                                ->whereIn('master_technical_skill_id', $unusedInFamily)
                                ->delete();
                        }
                    }
                }
        }
    }

    // Step 4: Delete other relations
    $job->skills()->delete();
    $job->criticalFunctions()->delete();

    $job->delete();

    return redirect()->route('admin.saved.jobdescriptions', [
        'org_department' => $department_id
    ])->with('success', 'Job deleted successfully.');
}

    public function primaryJob(Request $request)
    {

        if ($request->has('savedJob') && $request->savedJob == 3) {
            $job = Job::with(['skills', 'criticalFunctions.cwfKeys'])->where('id', $request->id)->first();
            $jobData = ['job' => $job, 'technicalSkills' => $job->technicalSkills->pluck('id', 'name')->toArray()];
    
            $job = $jobData;
    
            $masterSkills = MasterSkill::get(); // Fetch all master skills from the database
    
        
            // Iterate over the skills in the job object
            foreach ($job['job']->skills as &$skill) {
            
                // Find the matching master skill by title
                foreach ($masterSkills as $masterSkill) {
                
                    if ($skill->title == $masterSkill->name) {
                        // Add the level data to the skill
                        $skill->level_1 = $masterSkill->level_1;
                        $skill->level_1_ability = $masterSkill->level_1_ability;
                        $skill->level_1_knowledge = $masterSkill->level_1_knowledge;
    
                        $skill->level_2 = $masterSkill->level_2;
                        $skill->level_2_ability = $masterSkill->level_2_ability;
                        $skill->level_2_knowledge = $masterSkill->level_2_knowledge;
    
                        $skill->level_3 = $masterSkill->level_3;
                        $skill->level_3_ability = $masterSkill->level_3_ability;
                        $skill->level_3_knowledge = $masterSkill->level_3_knowledge;
                    }
                }
            }
        
            unset($skill); // Break reference with the last element
        
            // Print the updated skills with levels
            $techskillids = collect($job['job']->technicalSkills)->pluck('master_technical_skill_id')->toarray();
            // dd($techskillids);
            $mastertechskill = MasterTechnicalSkill::whereIn('id',$techskillids)->get();
        
            $data = ['job' => $job['job'], 'technicalSkills' => $job['job']->technicalSkills,'mastertechnicalskill'=>$mastertechskill];
    
            return response()->json($data, 200);
        }else{
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://sierra.cxs.team/api/job-description/job/select");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL peer verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  // Disable SSL host verification
            curl_setopt($ch, CURLOPT_POST, true);
    
            $data = ['id' => $request->id];
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    
            $response = curl_exec($ch);
    
            curl_close($ch);
    
            $jobData = json_decode($response);
    
            $job = $jobData;
    
            
    
            $masterSkills = MasterSkill::get(); // Fetch all master skills from the database
    
            $data = [];
            if ($job) {
                // Iterate over the skills in the job object
                foreach ($job->job->skills as &$skill) {
                
                    // Find the matching master skill by title
                    foreach ($masterSkills as $masterSkill) {
                        
                        if ($skill->title == $masterSkill->name) {
                            // Add the level data to the skill
                            $skill->level_1 = $masterSkill->level_1;
                            $skill->level_1_ability = $masterSkill->level_1_ability;
                            $skill->level_1_knowledge = $masterSkill->level_1_knowledge;
        
                            $skill->level_2 = $masterSkill->level_2;
                            $skill->level_2_ability = $masterSkill->level_2_ability;
                            $skill->level_2_knowledge = $masterSkill->level_2_knowledge;
        
                            $skill->level_3 = $masterSkill->level_3;
                            $skill->level_3_ability = $masterSkill->level_3_ability;
                            $skill->level_3_knowledge = $masterSkill->level_3_knowledge;
                        }
                    }
                }
                
                unset($skill); // Break reference with the last element
                
                // Print the updated skills with levels
                $techskillids = collect($job->job->technical_skills)->pluck('master_technical_skill_id')->toarray();
        
                $mastertechskill = MasterTechnicalSkill::whereIn('id',$techskillids)->get();

                $job->job->technical_skills = $job->technicalSkillsModified;
                
                $data = ['job' => $job->job, 'technicalSkills' => $job->technicalSkills,'mastertechnicalskill'=>$mastertechskill,'technicalSkillsModified'=>$job->technicalSkillsModified];
            }
            return response()->json($data, 200);
        }
    }

    public function allJobsByDepartment(Request $request)
    {
        $jobs = Job::where('department_id',$request->department_id)->where('is_primary',1)->pluck('title','sierra_id');
        return response()->json($jobs, 200);
    }


    public function allJobsByOrgDepartment(Request $request)
    {
        try {         
                $jobs = Job::where('org_department', $request->department_id)
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
                        ->pluck('title_with_vacancies', 'id');

            return response()->json($jobs, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function allJobsByOrgDepartmentForJD(Request $request)
    {
        try {         
                $jobs = Job::where('org_department', $request->department_id)->pluck('title','id');

            return response()->json($jobs, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function addToSave(Request $request){
      
        $request->validate([
            'job_id' => 'required',
        ]);

        // Simulate storing the data
        $job_id = $request->input('job_id');

        $job = Job::find($job_id);

        if ($request->type != '1') {
            $job->org_department = null;
        }    

        $job->saved_job = $request->type;

        $job->save();
        // Return a response
        if ($request->type == '1') {
            return redirect()->route('admin.jobdescriptions',['saved_job'=>1])->with('success' , 'Job is successfully saved');
        }else{
            return redirect()->route('jobs.index')->with('success' , 'Job is successfully removed from the saved list');
        }
    }

    public function getEmployee(Request $request){

        $query = $request->get('q');
        $barangays = User::where('company_id',auth()->user()->id)->where('name', 'LIKE', "%{$query}%")->paginate(10);

        return response()->json([
            'results' => $barangays->map(function ($barangay) {
                return ['id' => $barangay->id, 'text' => $barangay->name];
            }),
            'pagination' => [
                'more' => $barangays->currentPage() < $barangays->lastPage()
            ]
        ]);
    }

    public function saveEmployee(Request $request){

        $users = User::where('position_id',$request->job_id)->get();

        foreach ($users as $key1 => $value1) {
            $value1->department_id = null;
            $value1->position_id = null;
            $value1->save();
        }

        if ($request->employees && count($request->employees) > 0) {
            foreach ($request->employees as $key => $value) {
                $user = User::find($value);
                $user->position_id = $request->job_id;
                $user->department_id = $request->department;
                $user->save();

                try {
                    MainHelper::jobTriggerByTypeOnPositionChange($user->id,$user->position_id,config('helpers.panel_names')[env('DB_DATABASE')]);
                } catch (\Throwable $th) {
                    \Log::error($th);
                } 
            }

        }

        return redirect()->back()->with('success','employees saved successfully');
    }

    // public function technicalSkillsSearch(Request $request)
    // {
    //     // Handle search functionality
    //     $query = $request->get('q');
    //     $technicalSkills = MasterTechnicalSkill::where('name', 'LIKE', "%{$query}%")->paginate(10);

    //     return response()->json([
    //         'results' => $technicalSkills->map(function ($technicalSkill) {
    //             return ['id' => $technicalSkill->id, 'text' => $technicalSkill->name.' ('.$technicalSkill->sector_name.'-'.$technicalSkill->sub_sector_name.')'];
    //         }),
    //         'pagination' => [
    //             'more' => $technicalSkills->currentPage() < $technicalSkills->lastPage()
    //         ]
    //     ]);
    // }

    public function technicalSkillsSearch(Request $request)
{
    $query = $request->get('q');
    $page = $request->get('page', 1);

    $technicalSkills = MasterTechnicalSkill::with('category')
        ->where('name', 'LIKE', "%{$query}%")
        ->whereIn('is_custom', [0, 1, 2]) // optional if you only want valid classifications
        ->whereNotNull('category_id')
        ->paginate(10, ['*'], 'page', $page);

    return response()->json([
        'results' => $technicalSkills->map(function ($technicalSkill) {
            $categoryName = optional($technicalSkill->category)->title ?? 'Unknown Category';
            $sectorName   = optional($technicalSkill->sector)->name ?? 'Unknown Sector';
            $skillType = $technicalSkill->is_custom == 0 ? 'Master Skill' : 'Company Skill';

            return [
                'id' => $technicalSkill->id,
                'text' => "{$technicalSkill->name} ({$skillType} - {$categoryName})",
                'sector' => $sectorName, // agar separately bhejna ho
                'category' => $categoryName,
                'skill_type' => $skillType,
            ];
        }),
        'pagination' => [
            'more' => $technicalSkills->currentPage() < $technicalSkills->lastPage()
        ]
    ]);
}

// public function checkSkill(Request $request)
// {
    
//     // Raw skill name
//     $skillName = $request->input('skill_name');

//     // Brackets ke andar ka text remove karke clean name banao
//     $cleanSkillName = preg_replace('/\s*\(.*?\)\s*/', '', $skillName);

//     // Find the skill by clean name and is_custom = 0
//     $skill = DB::table('master_technical_skills')
//         ->where('name', $cleanSkillName)
//         ->where('is_custom', 0)
//         ->first();

//     if ($skill) {
//         // Self relation check (same table me related record search)
//         $relatedSkill = DB::table('master_technical_skills')
//             ->where('master_technical_skill_id', $skill->id) // yeh column hona chahiye
//             ->first();

//         return response()->json([
//             'skillExists' => true,
//             'skill' => $skill,
//             'hasRelatedSkill' => $relatedSkill ? true : false,
//         ]);
//     } else {
//         return response()->json([
//             'skillExists' => false,
//         ]);
//     }
// }


public function checkSkill(Request $request)
{
    $skill = null;
    $relatedSkill = null;

    // --- 1) Resolve sector_id ---
    $sectorId = null;
    if ($request->filled('sector_name')) {
        $secName  = trim($request->input('sector_name'));
        $sectorId = Sector::whereRaw('LOWER(name) = ?', [mb_strtolower($secName)])
            ->value('id'); // null if not found
    }

    // --- 2) Resolve category_id ---
    $categoryId = null;
    if ($request->filled('category_name')) {
        $catName  = trim($request->input('category_name'));
        $categoryId = TechnicalSkillCategory::whereRaw('LOWER(title) = ?', [mb_strtolower($catName)])
            ->when($sectorId, fn ($q) => $q->where('sector_id', $sectorId))
            ->value('id'); // null if not found
    }

    // ✅ Agar request me id aayi hai to direct us id se skill fetch karo
    if ($request->filled('id')) {
        $skill = DB::table('master_technical_skills')
            ->where('id', $request->input('id'))
            ->where('is_custom', 0)
            ->first();

        if ($skill) {
            // related skill ko direct request ki id se hi check karo
            $relatedSkill = DB::table('master_technical_skills')
                ->where('master_technical_skill_id', $request->input('id'))
                ->first();
        }
    } else {
        // Raw skill name
        $skillName = $request->input('skill_name');

        // Brackets ke andar ka text remove karke clean name banao
        $cleanSkillName = preg_replace('/\s*\(.*?\)\s*/', '', $skillName);

        // Find the skill by clean name, sector, category, and is_custom = 0
        $skill = DB::table('master_technical_skills')
            ->where('name', $cleanSkillName)
            ->where('is_custom', 0)
            ->when($sectorId, fn($q) => $q->where('sector_id', $sectorId))
            ->when($categoryId, fn($q) => $q->where('category_id', $categoryId))
            ->first();

        if ($skill) {
            $relatedSkill = DB::table('master_technical_skills')
                ->where('master_technical_skill_id', $skill->id)
                ->first();
        }
    }

    if ($skill) {
        return response()->json([
            'skillExists' => true,
            'skill' => $skill,
            'hasRelatedSkill' => $relatedSkill ? true : false,
        ]);
    } else {
        return response()->json([
            'skillExists' => false,
        ]);
    }
}






    public function checkCompanySkillExists(Request $request)
{
    $name = $request->input('name');
    $jobId = $request->input('job_id');

    $skill = MasterTechnicalSkill::where('name', $name)
        ->whereIn('is_custom', [1, 2])
        ->first();

    if ($skill) {
        $alreadyLinked = JobTechnicalSkills::where('job_id', $jobId)
            ->where('master_technical_skill_id', $skill->id)
            ->exists();

        return response()->json([
            'exists' => true,
            'linked' => $alreadyLinked
        ]);
    }

    return response()->json([
        'exists' => false,
        'linked' => false
    ]);
}

public function dupCheck(Request $request)
{
    $name        = trim((string) $request->input('name', ''));
    $sectorName  = trim((string) $request->input('sector_name', ''));
    $categoryName= trim((string) $request->input('category_name', ''));

    if ($name === '') {
        return response()->json(['exists' => false]);
    }

    // Resolve sector_id (case-insensitive)
    $sectorId = null;
    if ($sectorName !== '') {
        $sectorId = Sector::whereRaw('LOWER(name) = ?', [mb_strtolower($sectorName)])->value('id');
    }

    // Resolve category_id (case-insensitive, optional: scoped to sector)
    $categoryId = null;
    if ($categoryName !== '') {
        $q = TechnicalSkillCategory::whereRaw('LOWER(title) = ?', [mb_strtolower($categoryName)]);
        if ($sectorId) {
            $q->where('sector_id', $sectorId);
        }
        $categoryId = $q->value('id');
    }

    // Check conflict in Master/Company skills (is_custom in [1,2]) with same name,
    // and (optionally) same sector/category when those resolve to IDs.
    $q = MasterTechnicalSkill::query()
        ->whereRaw('LOWER(name) = ?', [mb_strtolower($name)])
        ->whereIn('is_custom', [1, 2]);

    if ($sectorId)   $q->where('sector_id', $sectorId);
    if ($categoryId) $q->where('category_id', $categoryId);

    $conflict = $q->first();

    if ($conflict) {
        return response()->json([
            'exists' => true,
            'skill'  => [
                'id'          => $conflict->id,
                'name'        => $conflict->name,
                'is_custom'   => $conflict->is_custom,
                'sector_id'   => $conflict->sector_id,
                'category_id' => $conflict->category_id,
            ],
            'message' => 'Company technical skill title already exists in this sector and category. Please enter a different one.'
        ]);
    }

    return response()->json(['exists' => false]);
}

    public function generateRiasecCode(Request $request){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://sierra.cxs.team/api/job-description/riasec_code");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL peer verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  // Disable SSL host verification
        curl_setopt($ch, CURLOPT_POST, true);

        $data = ['job' => $request->job_role];
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $response = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($response);

        return response()->json($result,200);
    }

    public function checkPositionCode(Request $request)
    {
        // if ($request->has('position_update')) {
        //     $positionCode = $request->input('position_code');
        //     $jobId = $request->input('job_id');

        //     $exists = Job::where('position_code', $positionCode)
        //                 ->where('id', '!=', $jobId)  // Exclude the current job record from the check
        //                 ->exists();
        // }else{
        //     $positionCode = $request->input('position_code');
        //     $exists = Job::where('position_code', $positionCode)->exists();
        // }

        return response()->json(['isUnique' => true]);
    }
    public function viewJD(){
        return view('admin.jd.viewjd');
    }

    public function createJD($id,$track,$sector){
       
        $job = Job::where('sierra_id',$id)->first();
        // dd($job);
        $track = $track ?? 'Track';
        $sector = $sector ?? 'Sector';

        $masterSkills = MasterSkill::all();


        try {
            if ($job->sierra_id && $job->sierra_id != null) {
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "https://sierra.cxs.team/api/job-description/job/select");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL peer verification
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  // Disable SSL host verification
                curl_setopt($ch, CURLOPT_POST, true);

                $data = ['id' => $job->sierra_id];
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

                $response = curl_exec($ch);

                curl_close($ch);

                $jobsierra = json_decode($response);

                $technicalSkills = $jobsierra->job->technical_skills;
            } else {
                $technicalSkills = $job->technicalSkills;
            }
        } catch (\Throwable $th) {
            $technicalSkills = $job->technicalSkills;
        }
        

        $job = Job::with('criticalFunctions.cwfKeys')->find($job->id);

        $existingJobs = Job::where('is_primary', 0)->get();

        $orgDepartments = Department::where('company_id',auth()->user()->id)->where('status',1)->get();

        if (auth()->user()->role_id == 7) {
            $orgDepartments = Department::where('company_id',auth()->user()->company_id)->where('status',1)->get();  
        }

        return view('admin.jd.createjd', compact('job', 'masterSkills', 'technicalSkills','orgDepartments','existingJobs','track','sector'));
    }  

    public function migrateVacancyData(Request $request) {
       $savedJobs = Job::where('is_primary', 0)->whereNotNull('business_unit_id')->whereNotNull('division_id')->get();
       $topPosition = Job::where('id', 4892)->first()->headcounts()->first()->id;
       $batchForAdd = [];

       foreach ($savedJobs as $job) {
           $totalEmployees = User::where('position_id', $job->id)->count();
           $totalVacancies = $job->heads - $totalEmployees;

           $parentId = null;

           if ($totalVacancies < 0) {
             $totalVacancies = 0;
           }

           if ($totalVacancies > 0) {
            

            $headcount = $job->headcounts()->first();
            $parentId = $headcount?->parent_id;

            for ($i=0; $i < $totalVacancies; $i++) {
                $generatedCode = $this->jobService->generateHeadcountCode($job->position_code, $job->id);
                [$prefix, $jobId, $seq] = explode('-', $generatedCode);
                $updatedHeadcountCode = implode('-', [$prefix, $jobId, $seq + $i]);

                // dd($parentId);
                
                    $batchForAdd[] = [
                                    'job_id'           => (int) $job->id,
                                    'headcount_code'   => $updatedHeadcountCode,
                                    'parent_id'        => $parentId ?? $topPosition,
                                    'department_id'    => $job->department_id,
                                    'user_id'    => null,
                                    'headcount_number' => (int) $seq+$i,
                                    'orgMetadata' => [
                                        'action' => 'add_position',
                                        'reason' => "Vacant Position",
                                        'node' => ['data'=>['code'=>$updatedHeadcountCode]],
                                    ]
                                ];
                
                
            }

            // $generatedCode = $this->jobService->generateHeadcountCode($job->position_code, $job->id);
            // [$prefix, $jobId, $seq] = explode('-', $generatedCode);
            // $batchForAdd[] = [
            //                     'job_id'           => (int) $job->id,
            //                     'headcount_code'   => $generatedCode,
            //                     'parent_id'        => $parentId ?? $topPosition,
            //                     'department_id'    => $job->department_id,
            //                     'user_id'    => null,
            //                     'headcount_number' => (int) $seq,
            //                     'orgMetadata' => [
            //                         'action' => 'add_position',
            //                         'reason' => "Vacant Position",
            //                         'node' => ['data'=>['code'=>$generatedCode]],
            //                     ]
            //                 ];

           }
           
            
           $job->vacancy = $totalVacancies;
           $job->save();
       }
    //    dd($batchForAdd);
        if (count($batchForAdd) > 0) {
                    $this->hcService->createBatchForOrgChart($batchForAdd);
        }
    //    dd($batchForAdd);
    }

    public function getSuperiorJobs(Request $request)
    {
        $query = $request->input('q');
        $level = $request->input('level');

        if ($request->has('job_id') && $request->job_id != null) {
            $results = $this->jobService->searchSuperiorJobs($query, $level,$request->job_id);
        }else{
            $results = $this->jobService->searchSuperiorJobs($query, $level);
        }
        

        return response()->json($results);
    }

    // public function generateHeadcountCodes(Request $request)
    // {
        
    //     // Start a database transaction to ensure consistency
    //     DB::beginTransaction();

    //     try {
    //         if ($request->has('job_draft_id') && $request->job_draft_id != null) {

    //             $jobDraft = JobDraft::find($request->job_draft_id);

    //             if($jobDraft){

    //                 $positionCode = strtoupper(preg_replace('/[^A-Z0-9]/', '', $request->position_code));
    //                 $headcountCode = $this->jobService->generateHeadcountCode($positionCode, $jobDraft->job_id);
    //                 $jobDraft->position_code = $positionCode;
    //                 $jobDraft->headcount_code = $headcountCode;
    //                 $jobDraft->save();
    //                 DB::commit();
    //                 return response()->json(['headcount_codes' => $headcountCode,'job_draft_id'=>$jobDraft->id], 200);

    //             }
                
    //         }
    //         // Step 1: Lock the jobs table to prevent race conditions
    //         $latestJob = Job::lockForUpdate()->orderBy('id', 'desc')->first(); // Get the most recent job
    //         $nextJobDescriptionId = $latestJob ? $latestJob->id + 1 : 1; // Increment job description ID

    //         // Step 2: Check if this job_description_id is already used in JobDrafts
    //         $existingDraft = JobDraft::where('job_id', $nextJobDescriptionId)->first();

    //         // If the ID is already used, increment until a free one is found
    //         while ($existingDraft) {
    //             $nextJobDescriptionId++;
    //             $existingDraft = JobDraft::where('job_id', $nextJobDescriptionId)->first();
    //         }

    //         // Step 3: Get the position code from the input
    //         $positionCode = strtoupper(preg_replace('/[^A-Z0-9]/', '', $request->position_code));

    //         // Step 4: Generate the headcount code
    //         $headcountCode = $this->jobService->generateHeadcountCode($positionCode, $nextJobDescriptionId);

    //         // Step 5: Create a new JobDraft entry with the generated job description ID and other necessary details
    //         $jobDraft = new JobDraft();
    //         $jobDraft->job_id = $nextJobDescriptionId;
    //         $jobDraft->position_code = $positionCode;
    //         $jobDraft->headcount_code = $headcountCode;
    //         $jobDraft->created_by = auth()->id(); // Assuming logged-in user is creating this draft
    //         // Add other necessary fields to the JobDraft model here, if any
    //         $jobDraft->save();

    //         // Step 6: Commit the transaction
    //         DB::commit();

    //         // Return the response with the generated headcount code
    //         return response()->json(['headcount_codes' => $headcountCode,'job_draft_id'=>$jobDraft->id], 200);

    //     } catch (\Exception $e) {
    //         // Rollback the transaction in case of any error
    //         DB::rollback();

    //         // Log or capture the exception details for better debugging
    //         \Log::error('Error generating headcount code', ['error' => $e->getMessage()]);

    //         // Return error response
    //         return response()->json(['error' => 'An error occurred while generating the headcount code'], 500);
    //     }
    // }


    public function generateHeadcountCodes(Request $request)
    {
        $userId = auth()->id();

        DB::beginTransaction();
        try {
            // Sanitize position code up front
            $positionCode = strtoupper(preg_replace('/[^A-Z0-9]/', '', $request->job_profile_id));

            // Do we already have a draft in play?
            if ($draftId = $request->input('job_draft_id')) {
                $draft = JobDraft::lockForUpdate()
                    ->where('id', $draftId)
                    ->where('user_id', $userId)
                    ->firstOrFail();

                // Re‑use its job_id
                $jobId = $draft->job_id;
            } else {
                // No draft yet: reserve the next free job_id
                $latestJob = Job::lockForUpdate()
                    ->orderBy('id', 'desc')
                    ->first();

                $nextJobId = $latestJob ? $latestJob->id + 1 : 1;

                // Skip any job_ids already in drafts
                while (JobDraft::where('job_id', $nextJobId)->exists()) {
                    $nextJobId++;
                }

                $jobId = $nextJobId;

                // Create a new draft row
                $draft = new JobDraft();
                $draft->job_id   = $jobId;
                $draft->user_id  = $userId;
                $draft->created_by = $userId;
            }

            // Generate (or re‑generate) your headcount code
            $headcountCode = $this->jobService
                                ->generateHeadcountCode($positionCode, $jobId);

            // Update draft with the latest values
            $draft->position_code  = $positionCode;
            $draft->headcount_code = $headcountCode;
            $draft->save();

            DB::commit();

            return response()->json([
                'job_draft_id'    => $draft->id,
                'headcount_codes' => [$headcountCode],
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error generating headcount code', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Unable to generate headcount code, please try again.'
            ], 500);
        }
    }

    public function allowedLevelsBySuperiorJob(Request $request)
    {
        $jobId       = $request->input('job_id');
        $isTop    = filter_var($request->input('is_top'),    FILTER_VALIDATE_BOOLEAN);
        $superior = $request->input('superior_id');



        if ($jobId) {
            // Edit mode
            $job = Job::findOrFail($jobId);
            $allowed = $this->hcService->getAllowedLevelsForEdit($job, $superior);
        }else{
            // Get the [level=>label] array
            $allowed = $this->hcService->getAllowedLevels($isTop, $superior);
        }
        

        // Format for JSON: [ {value,label}, … ]
        $payload = [];
        foreach ($allowed as $lvl => $label) {
            $payload[] = ['value' => $lvl, 'text' => $label];
        }

        return response()->json($payload);
    }

    // public function generateCodeUsingJobId(Request $request)
    // {
    //     $job = Job::where('id',$request->job_id)->first();
    //     $positionCode = strtoupper(preg_replace('/[^A-Z0-9]/', '', $job->code));
    //     $headcountCode = $this->jobService->generateHeadcountCode($positionCode, $job->id);
    //     $title = $job->title;
    //     $jobId = $job->id;
    //     $department_id = $job->department_id;
    //     $departmentName = $job->department->name;
    //     $level = $job->level;
    //     return response()->json(['headcount_codes' => $headcountCode,'title'=>$title,'jobId'=>$jobId,'department_id'=>$department_id,'departmentName'=>$departmentName,'level'=>$level], 200);
    // }


    public function generateCodeUsingJobId(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
        ]);

        $job = Job::findOrFail($request->job_id);
        $positionCode = strtoupper(preg_replace('/[^A-Z0-9]/', '', $job->code));

        // Generate the headcount code and check for its uniqueness
        $headcountCode = $this->jobService->generateHeadcountCode($positionCode, $job->id);

        // Check if the generated headcount code already exists in the database
        while (JobHeadcount::withTrashed()->where('headcount_code', $headcountCode)->exists()) {
            // If it exists, increment the sequence and generate again
            $headcountCode = $this->jobService->generateHeadcountCode($positionCode, $job->id);
        }

        // If not, proceed with the operation
        return response()->json([
            'headcount_codes' => $headcountCode,
            'title' => $job->title,
            'jobId' => $job->id,
            'department_id' => $job->department_id,
            'departmentName' => $job->department->name,
            'level' => $job->level
        ], 200);
    }
    

public function TechnicalSkillReportExport()
{
    // Increase memory limit for large datasets
    ini_set('memory_limit', '512M');
    ini_set('max_execution_time', 600);
    
    // Disable query log to save memory
    DB::disableQueryLog();
    
    $filename = 'technical-skill-job-profiles-' . now()->format('Y-m-d_His') . '.xlsx';
    
    // Stream the download for better memory management
    return Excel::download(new JobFamilyTechnicalSkillExport(), $filename, \Maatwebsite\Excel\Excel::XLSX, [
        'pre_calculate_formulas' => false, // Skip formula calculation
        'use_bom' => false, // Don't add BOM
    ]);
}
}
