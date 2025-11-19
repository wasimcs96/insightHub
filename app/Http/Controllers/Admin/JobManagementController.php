<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\JobDescriptionRequest;
use App\Services\Job\JdJobService;
use App\Models\MasterSkill;
use App\Models\Department;
use App\Models\Sector;
use App\Models\Job;
use App\Models\JobProfile;
use App\Models\JobFamily;
use App\Models\JobFamilyGroup;
use App\Services\AiResponseService;
use App\Http\Requests\StoreJobDescriptionRequest;
use App\Models\AirAsiaFamilyJob;
use App\Models\Division;
use App\Models\JobHeadcount;
use App\Services\DropdownService;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class JobManagementController extends Controller
{
   

    protected $jdJobService,$jobDescriptionService,$aiResponseService;

    public function __construct(JdJobService $jdJobService,AiResponseService $aiResponseService)
    {
        $this->jdJobService = $jdJobService;
         $this->aiResponseService = $aiResponseService;
    }






    public function createJd($type)
    {
        // dd('dd');
        $businessUnits = DropdownService::getBusinessUnits();
        $data = [
            "businessUnits"=>$businessUnits,
            'jdType' => 'AI-jd'
        ];
        return view('admin.job-management.createJd',$data);
    }

    public function customJdIndex()
    {
        return view('admin.job-management.custom-jd.custom-jd');
    }

    public function CreateLocalizedJD($type)
    {
       
        // if($type == 'company-jd'){
          
        //     $dropdown = Department::where('company_id',config('app.company_id'))->where('status',1)->pluck('name','id')->toArray();
        // }else{
        //     $dropdown = Sector::pluck('name','id')->toArray();
        // }
        // dd($dropdown);
        $data = [
            'type'=>$type
        ];
        return view('admin.job-management.localized-jd',$data);
    }


    // public function createAiJd()
    // {
    //     $masterSkills = MasterSkill::all();
    // $orgDepartments = Department::where('company_id',auth()->user()->id)->where('status',1)->get();
    // $technicalSkills = [];

    //     return view('admin.job-management.create', compact('masterSkills', 'orgDepartments', 'technicalSkills'));
    // }

    public function store(Request $request)
    {
        
        $request->validate([
            'cache_key' => 'required|string',
            'job_data' => 'required|string'
        ]);

        $key = $request->input('cache_key');
        $jobData = json_decode($request->input('job_data'), true);

        $jobProfileId = $jobData['job_role'] ?? null;

        $jobProfile = JobProfile::where('id', $jobProfileId)->first();
        // dd($jobProfile);

        // if ($jobProfile) {
        //   $duplicateProfileCheck = AirAsiaFamilyJob::where('job_profile_id',$jobProfile->id)->exists();
        //   if ($duplicateProfileCheck) {
        //     return response()->json(['success' => false],400);
        //   }
        // }


        $jobData['profile_level'] =$jobProfile->management_level ?? null;

        $jobData['job_type'] = $jobData['jd_type'] ?? null;
        // dd($jobProfile);

        // dd($jobData['job_role']);

        // Cache for 15 minutes (adjust as needed)

        // dd($jobData);
        Cache::put($key, $jobData, now()->addMinutes(180));

        return response()->json(['success' => true]);
    }

    public function createAiJd(Request $request)
    {
        
        $masterSkills = MasterSkill::all();
        $orgDepartments = Department::where('company_id',auth()->user()->id)->where('status',1)->get();
        $jobProfile = JobProfile::all();
        // $jobFamilyGroup = JobFamilyGroup::all();
        // $jobFamily = JobFamily::all();
        $oldJobId = null;
        $isLocalizedJob = false;

        $jobFamilyGroup = [];
        $jobFamily = [];

        $technicalSkills = [];
        $cacheKey = $request->query('cache_key');
        $cachedData = Cache::get($cacheKey);

        if (array_key_exists('job_id', $cachedData)) {
            $cachedData['ai_job_id'] = $cachedData['job_id']; // mirror job_id
        }


        if (!empty($cachedData['is_localized_job']) && $cachedData['is_localized_job'] == true) {
            // Find existing job using job_profile_id
            $existingJob = Job::where('job_profile_id', $cachedData['job_role'])->with(['headcounts.user:id,name','masterJob'])->first();

            if ($existingJob) {
                $job = $existingJob;
                $oldJobId = $existingJob->id;
                $isLocalizedJob = true;


                ini_set('max_execution_time', 300); // 5 minutes

                $masterSkills = MasterSkill::all();
                $orgDepartments = Department::where('company_id',auth()->user()->id)->where('status',1)->get();
                $jobProfile = JobProfile::all();
                $jobFamilyGroup = [];
                $jobFamily = [];
                $technicalSkills = [];

                $jobProfile = JobProfile::find(optional($job->airAsiaFamilyJob)->job_profile_id);
                $cachedData['job_id'] = $job->id ?? null;
                
                $cachedData['profile_level'] = $job->level ?? null;
                
                $cachedData['heads'] = $job->heads ?? null; 
                $cachedData['job_role'] = $job->airAsiaFamilyJob->job_profile_id ?? null;
                $cachedData['job_family'] = $job->airAsiaFamilyJob->job_family_id ?? null;
                $cachedData['job_family_group'] = $job->airAsiaFamilyJob->job_family_group_id ?? null;
                $cachedData['jd_type'] = $job->job_type ?? null;
                $cachedData['company_jd'] = $job->saved_job ?? null;
                $cachedData['status'] = $job->status ?? null;
                // $cachedData['top3riasec_array'] = str_split($job->top3riasec);
                $cachedData['top3riasec_array'] = (!empty($job->top3riasec) && strtolower($job->top3riasec) !== 'not available')
                    ? str_split($job->top3riasec)
                    : '';



                $superiorJob = null;
                $superiorHeadcounts = null;
                $superiorHeadcountCodes =[];
                $superiorJobDepartmentId = null;
                $superiorNames = [];

                if ($job->superior_id) {
                    $superiorJob = Job::with('headcounts.user')->find($job->superior_id);
                    $superiorHeadcounts = $superiorJob?->headcounts;
                    $superiorHeadcountCodes = $superiorJob?->headcounts->pluck('headcount_code')->toArray();
                    $superiorJobDepartmentId = $superiorJob?->department_id;
                    if (!empty($superiorHeadcounts)) {
                        foreach ($superiorHeadcounts as $headcount) {
                            $code = (string) $headcount->headcount_code;
                            $superiorNames[$code] = $headcount->user_id && $headcount->user ? $headcount->user->name : 'Vacant';
                        }
                    }
                }
                // if ($cachedData == null) {
                //     return redirect()->route('llm.edit', $job->id)->with('error', 'No cached data found. Please try again.');
                // }
                $businessUnits = DropdownService::getBusinessUnits();
                return view('admin.setting.job_llm_edit', compact('masterSkills', 'orgDepartments', 'technicalSkills','cachedData','jobProfile','jobFamilyGroup','jobFamily','businessUnits','job','superiorHeadcountCodes','superiorJob','superiorHeadcounts','superiorJobDepartmentId','superiorNames'))
                    ->with('job', $job);
            }
        }

        $headcounts = [
            ['id' => 'Position1', 'employee' => 'Vacant', 'superior' => ''],
            // Add any other initial data if necessary
        ];

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

        $businessUnits = DropdownService::getBusinessUnits();
        
        if ($cachedData == null) {
            return redirect()->route('admin.job-management.createJd','Ai')->with('error', 'No cached data found. Please try again.');
        }

        return view('admin.job-management.create-ai', compact('masterSkills', 'orgDepartments', 'technicalSkills','cachedData','jobProfile','jobFamilyGroup','jobFamily','headcounts','isTopExists','topJob','topJobTitle','topJobId','businessUnits','oldJobId','isLocalizedJob'))
            ->with('cacheKey', $cacheKey);
    }

    public function storeJd(StoreJobDescriptionRequest $request, JdJobService $jdJobService)
    {
        
        $job = null;

        if (!empty($request->localized_job) && $request->localized_job == "1") {
            // Find existing job using job_profile_id
            $existingJob = Job::where('id', $request->oldJobId)->first();

            if ($existingJob) {
                $job = $jdJobService->updateJob($request->oldJobId,$request->all());
            }
        }

        if($job == null){
           $job = $jdJobService->createJob($request->all());
        }

        if ($job) {
            // Ensure the jobProfile relationship is loaded
            $job->load('jobProfile');
            
            // if ($request->redirect_target === 'create') {

            //     return redirect()->route('admin.job-management.createJd', ['type' => 'ai'])->with('success', 'Job created successfully.');

            // } elseif ($request->redirect_target === 'detail') {

                return redirect()->route('admin.saved.jobdescriptions', [
                'org_department' => $request->input('job_familyId'),
                    // 'job_profile_id' => $job->job_profileId,
                    'saved_job' => 1,
                    'selected_job' => $job->id
                ])->with('success', 'Job created successfully.');

            // }

        }

        return back()->with('error', 'Job creation failed or not found.');
    }

public function updateJd(StoreJobDescriptionRequest $request, JdJobService $jdJobService)
{
    // ini_set('max_input_vars', 1000);
    $job = $jdJobService->updateJob($request->job_id,$request->all());

    if ($job) {
        if ($request->jd_redirect == 2) {

            if ($request->pendingChangesJson != null) {
                $changes = json_decode($request->pendingChangesJson);
                if ($request->pendingChangesJson != null) {
                    $changes = json_decode($request->pendingChangesJson);
                    $headcountCode = null;
                    // Only fetch the first headcount if necessary
                    $headcount = $job->headcounts()->orderBy('headcount_code', 'asc')->first();

                    if ($headcount) {
                            $headcountCode = $headcount->headcount_code;
                    }
                    
                    // If changes exist and there are more than 1
                    if ($changes && count($changes) > 1) {
                        // Get the headcount code from the first headcount if available
                        if ($headcount) {
                            $headcountCode = $headcount->headcount_code;
                        }
                    } else {
                        foreach ($changes as $value) {
                            // Handle specific actions based on the key value
                            switch ($value->key) {
                                case 'remove_headcount':
                                    $headcountCode = $headcount->headcount_code;
                                    break;
                                case 'change_superior_headcount':
                                    $headcountCode = $value->new_value;
                                    break;
                                case 'change_superior_confirmation':
                                    if ($headcount) {
                                        $headcountCode = $headcount->headcount_code;
                                    }
                                    break;
                                case 'add_new_headcount':
                                    $headcountCode = $value->new_value;
                                    break;
                            }
                        }
                    }

                    return redirect()->route('admin.organizational.structure', ['headcountCode' => $headcountCode]);
                }
                
            }

            return redirect()->route('admin.organizational.structure');
        }
        return redirect()->route('admin.saved.jobdescriptions', [
            // 'org_department' => $job->airAsiaFamilyJob->job_family_id,
           'org_department' => $request->input('job_familyId'),
            // 'job_profile_id' => $job->job_profileId,
            'saved_job' => 1,
            'selected_job' => $job->id
        ])->with('success', 'Job updated successfully.');
    }

    return back()->with('error', 'Job update failed or not found.');
}

public function getRiasecData(Request $request)
{
    $riasecCode = $request->top3riasec ?? 'ESI';
    $riasecCodes = config('constants.RIASEC_CODES');
    $codeToName = array_flip($riasecCodes);

    $type = $request->type ?? 1;

    $riasecDummyDescription = [
        "Realistic"     => "Practical, hands-on, prefers working with tools, machines, or physical materials.",
        "Investigative" => "Analytical, curious, enjoys solving complex problems through research and analysis.",
        "Artistic"      => "Creative, imaginative, enjoys artistic expression, originality, and working without rigid rules.",
        "Social"        => "Compassionate, empathetic, enjoys helping and interacting with others.",
        "Enterprising"  => "Ambitious, persuasive, enjoys leadership roles and pursuing entrepreneurial endeavors.",
        "Conventional"  => "Detail-oriented, organized, prefers tasks involving established procedures and rules."
    ];
    
    // Split the code into letters
    $letters = str_split($riasecCode);

    // Assign each title to a variable
    $title1 = $codeToName[$letters[0]] ?? null;
    $title2 = $codeToName[$letters[1]] ?? null;
    $title3 = $codeToName[$letters[2]] ?? null;

    
     
       //Sierra API Call for new RIASEC code generation
        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, "https://sierra.cxs.team/api/job-description/riasec_code");
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL peer verification
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  // Disable SSL host verification
        // curl_setopt($ch, CURLOPT_POST, true);

        // $data = ['job' => $request->job_role];
        // AI based RIASEC code generation using job description
       $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://51.79.140.78:8123/api/v3/riasec-predictor/predict");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL peer verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  // Disable SSL host verification
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'x-api-token: fea63371019d768206ee6e96a4ca88fb68cf0074ca0382943e21e562d67c0979',
            'Content-Type: application/json'  // Add this line!
        ]);

        $data = ['job_title' => $request->job_profile,'job_description'=>$request->job_description ?? ''];

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($response);

        
        try {
            $generatedRiasecCode = $result->top3_riasec_code ?? 'ESI'; // Default to 'ESI' if not found
        } catch (\Throwable $th) {
            $generatedRiasecCode = 'ESI';
        }

            // Split the code into letters
        $letters1 = str_split($generatedRiasecCode);

        // Assign each title to a variable
        $title4 = $codeToName[$letters1[0]] ?? null;
        $title5 = $codeToName[$letters1[1]] ?? null;
        $title6 = $codeToName[$letters1[2]] ?? null;

        $masterId = $request->master_id ?? null;

        $role_name = $request->job_role ?? '-';

        if ($masterId) {
            $job = Job::where('id', $masterId)->first();
            if ($job) {
                $role_name = $job->title ?? '-';
            }
        }else{
             $role_name = $request->job_role ?? '-';
        }


    // This can come from your database or any source
    $riasecData = [
        [
            'title' => $request->jdTitle ?? '-',
            'badge' => ($type == 'company-jd' ? 'Company JD' : 'Master JD'),
            'badge_class' => 'master-jd-badge',
            'code' => $riasecCode,
            'show'=> $type != "1",
            'details' => [
                [
                    'sub_heading' => $title1,
                    'para' => $riasecDummyDescription[$title1] ?? 'Description not available for this RIASEC code.',
                ],
                [
                    'sub_heading' => $title2,
                    'para' => $riasecDummyDescription[$title2] ?? 'Description not available for this RIASEC code.',
                ],
                [
                    'sub_heading' => $title3,
                    'para' => $riasecDummyDescription[$title3] ?? 'Description not available for this RIASEC code.',
                ],
            ],
        ],
        [
            'title' => $request->job_profile ?? '-',
            'badge' => env('APP_NAME'),
            'badge_class' => 'enter-jr-badge',
            'code' => $generatedRiasecCode,
            'show'=> true,
            'details' => [
                [
                    'sub_heading' => $title4,
                    'para' => $riasecDummyDescription[$title4] ?? 'Description not available for this RIASEC code.',
                ],
                [
                    'sub_heading' => $title5,
                    'para' => $riasecDummyDescription[$title5] ?? 'Description not available for this RIASEC code.',
                ],
                [
                    'sub_heading' => $title6,
                    'para' => $riasecDummyDescription[$title6] ?? 'Description not available for this RIASEC code.',
                ],
            ],
        ]
    ];

    // You can filter or customize based on $request->job_role

    return response()->json($riasecData);
}



public function getJobsBySkill($skillId)
{
    $jobs = DB::table('job_technical_skills')
        ->join('jobs', 'job_technical_skills.job_id', '=', 'jobs.id')
        ->where('job_technical_skills.master_technical_skill_id', $skillId)
        ->select('jobs.title')
        ->distinct()
        ->get();

    return response()->json($jobs);
}

public function getJobCountBySkill($skillId)
{
    $count = DB::table('job_technical_skills')
        ->where('master_technical_skill_id', $skillId)
        ->distinct('job_id') // duplicate job_id remove karega
        ->count('job_id');

    return response()->json([
        'skill_id' => $skillId,
        'job_count' => $count
    ]);
}





    public function getSector(){
        $sector = Sector::pluck('name','id')->toArray();

        return response()->json(['data' => $sector], 200);
    }

    public function getDepartment(){
        $department = Department::where('company_id',config('app.company_id'))->where('status',1)->pluck('name','id')->toArray();

        return response()->json(['data' => $department], 200);
    }
    public function getJobRole($type,$sector){

       
        if($type == 'company-jd'){

           $job = Job::where('org_department',$sector)->where('is_primary',0)->where('status',2)->pluck('title','id')->toArray();
        //    dd($job);

        }else{
           $job = Job::where('department_id',$sector)->where('is_primary',1)->where('status',2)->pluck('title','id')->toArray();

        }

        return response()->json(['data' => $job], 200);
    }


    public function getJobRoleDetail($id)
    {
        try {

            $aiResponse = $this->aiResponseService->formatJobs($id);

    
            return response()->json(['data' => $aiResponse], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }



    public function getFormattedJobByProfile(Request $request)
{
    // dd($request->all());
    $jobFamilyGroupId = $request->input('job_family_group');
    $businessUnitId = $request->input('business_unit_id');

    $jobFamilyId = $request->input('job_family');
    $jobProfileId = $request->input('job_role'); // or job_profile

    // Validate
    if (!$jobFamilyGroupId || !$jobFamilyId || !$jobProfileId || !$businessUnitId) {
        return response()->json([
            'success' => false,
            'message' => 'All parameters are required.'
        ], 400);
    }

     $job = Job::where('id', $jobProfileId)
              ->first();


    if (!$job) {
        return response()->json([
            'success' => false,
            'message' => 'Job not found.'
        ], 404);
    }

    // Fetch full job info using your existing service
    try {
        $formattedJob = $this->aiResponseService->formatJobsbyfamily(
            $job->id,
            $jobFamilyGroupId,
            $jobFamilyId,
            $job->job_profile_id
        );

        return response()->json([
            'success' => true,
            'data' => $formattedJob
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Job not found or error occurred.',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function customCreate(Request $request)
{
    
    $cachedData = $request->only([
        'job_family_group',
        'job_family',
        'job_role',
        'job_family_group_name',
        'job_family_name',
        'job_role_name',
        'job_profile_description'
    ]);

    $cacheKey = $request->query('cache_key') ?? '';

     $existingJob = Job::where('job_profile_id', $cachedData['job_role'])->with(['headcounts.user:id,name','masterJob'])->first();
    $orgDepartments = Department::where('company_id',auth()->user()->id)->where('status',1)->get();
    $jobProfile = JobProfile::all();
    $jobFamilyGroup = [];
    $jobFamily = [];
    $technicalSkills = [];
    $oldJobId = null;
    $isLocalizedJob = false;

    $masterSkills = MasterSkill::all();
    
    $cachedData['job_id'] = null;
    $cachedData['top3riasec'] = null;
    $cachedData['title'] = null;
    $cachedData['level'] = null;
    $cachedData['jd_type'] = 1;
    $cachedData['profile_level'] = null;
    $cachedData['business_unit_id'] = null;

    $jobProfile = JobProfile::find($cachedData['job_role']);

    if ($jobProfile) {
       $department = Department::where('id', $jobProfile->department_id)->first();
       if ($department) {
           $division = Division::where('id', $department->division_id)->first();
           if ($division) {
               $cachedData['business_unit_id'] = $division->business_unit_id;
           }
        }
    }

    if ($existingJob) {
                $job = $existingJob;
                $oldJobId = $existingJob->id;
                $isLocalizedJob = true;


                ini_set('max_execution_time', 300); // 5 minutes

                

                $jobProfile = JobProfile::find(optional($job->airAsiaFamilyJob)->job_profile_id);
                $cachedData['job_id'] = $job->id ?? null;
                $cachedData['description'] = $job->description ?? null;
                
                $cachedData['profile_level'] = $job->level ?? null;
                
                $cachedData['heads'] = $job->heads ?? null; 
                $cachedData['job_role'] = $job->airAsiaFamilyJob->job_profile_id ?? null;
                $cachedData['title'] = $job->title ?? null;
                $cachedData['level'] = $job->level ?? null;


                $cachedData['job_family'] = $job->airAsiaFamilyJob->job_family_id ?? null;
                $cachedData['job_family_group'] = $job->airAsiaFamilyJob->job_family_group_id ?? null;
                $cachedData['jd_type'] = $job->job_type ?? null;
                $cachedData['company_jd'] = $job->saved_job ?? null;
                $cachedData['status'] = $job->status ?? null;
                $cachedData['top3riasec_array'] = str_split($job->top3riasec);
                $cachedData['top3riasec'] = $job->top3riasec ?? null;

               $superiorJob = null;
                $superiorHeadcounts = null;
                $superiorHeadcountCodes =[];
                $superiorJobDepartmentId = null;
                $superiorNames = [];

                if ($job->superior_id) {
                    $superiorJob = Job::with('headcounts.user')->find($job->superior_id);
                    $superiorHeadcounts = $superiorJob?->headcounts;
                    $superiorHeadcountCodes = $superiorJob?->headcounts->pluck('headcount_code')->toArray();
                    $superiorJobDepartmentId = $superiorJob?->department_id;
                    if (!empty($superiorHeadcounts)) {
                    foreach ($superiorHeadcounts as $headcount) {
                        $code = (string) $headcount->headcount_code;
                        $superiorNames[$code] = $headcount->user_id && $headcount->user ? $headcount->user->name : 'Vacant';
                    }
                    }
                }
                // if ($cachedData == null) {
                //     return redirect()->route('llm.edit', $job->id)->with('error', 'No cached data found. Please try again.');
                // }
                $businessUnits = DropdownService::getBusinessUnits();
                return view('admin.setting.job_llm_edit', compact('masterSkills', 'orgDepartments', 'technicalSkills','cachedData','jobProfile','jobFamilyGroup','jobFamily','businessUnits','job','superiorHeadcountCodes','superiorJob','superiorHeadcounts','superiorJobDepartmentId','superiorNames'))
                    ->with('job', $job);
    }

    $headcounts = [
            ['id' => 'Position1', 'employee' => 'Vacant', 'superior' => ''],
            // Add any other initial data if necessary
        ];

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

        $businessUnits = DropdownService::getBusinessUnits();
        
        if ($cachedData == null) {
            return redirect()->route('admin.job-management.createJd','Ai')->with('error', 'No cached data found. Please try again.');
        }

        return view('admin.job-management.create-ai', compact('masterSkills', 'orgDepartments', 'technicalSkills','cachedData','jobProfile','jobFamilyGroup','jobFamily','headcounts','isTopExists','topJob','topJobTitle','topJobId','businessUnits','oldJobId','isLocalizedJob'))
            ->with('cacheKey', $cacheKey);
}




    public function CreateLocalizedCustomJD()
    {
        $data = [
            'jdType' => 'custom-jd'
        ];

        // localized-custom-jd old blade file
        return view('admin.job-management.createJd',$data);
    }



    public function cacheJobData(Request $request)
    {
        $request->validate([
            'cache_key' => 'required|string',
            'job_data' => 'required|string'
        ]);

        Cache::put($request->cache_key, $request->job_data, now()->addMinutes(180));

        return response()->json(['success' => true]);
    }

    public function showAICreateJD(Request $request)
    {
        $cacheKey = $request->query('cache_key');
        $jobData = null;

        if ($cacheKey && Cache::has($cacheKey)) {
            $cached = Cache::get($cacheKey);

            // Decode only if it's a string
            $jobData = is_string($cached) ? json_decode($cached, true) : $cached;
        }

        return view('admin.job-management.createJd', [
            'cachedJobData' => $jobData,
            'jdType' => $jobData['jd_type'] ?? null
        ]);
    }

    public function createJobProfile(Request $request)
    {
          $rules = [
                'positionCode' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('job_profiles', 'aa_job_profile_id')
                        ->where('tenant_id', auth()->user()->tenant_id)
                ],
                'job_position_name' => 'required|string|max:255',
                'jobDescription' => 'nullable|string',
                'department_id' => 'required|exists:departments,id',
                'division_id'=>'required',
                'business_unit_id'=>'required',
            ];

            // Define custom messages
            $messages = [
                'positionCode.required' => 'The position code is required.',
                'positionCode.unique' => 'The position code already exists.',
                'job_position_name.required' => 'The job position is required.',
                'jobDescription.required' => 'The job description is required.',
                'department_id.required' => 'The department is required.',
                'department_id.exists' => 'The selected department does not exist.',
                'division_id.required' => 'The division is required.',
                'business_unit_id.required' => 'The business unit is required.',

            ];

            // Run the validator
            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

        // If validation passes, create the job profile
        JobProfile::create([
            'aa_job_profile_id' => $request->positionCode,
            'name' => $request->job_position_name,
            'description' => $request->jobDescription,
            'department_id' => $request->department_id,
        ]);

        return response()->json(['success' => true, 'message' => '<b>Success!</b> You have successfully added a new job position. Please click the Job Position dropdown to view and select it.']);
    }




    




}
