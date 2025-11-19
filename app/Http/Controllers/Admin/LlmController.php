<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use App\Services\Job\AiJobService;
use App\Models\Job;
use App\Models\MasterSkill;
use App\Models\JobProfile;
use App\Models\JobFamily;
use App\Models\JobFamilyGroup;
use App\Services\AiResponseService;
use App\Services\DropdownService;

class LlmController extends Controller
{
    protected $aiJobService;

    public function __construct(AiJobService $aiJobService)
    {
        $this->aiJobService = $aiJobService;
    }
    public function create_llm(Request $request){
        $redisKey = $request->query('redisKey');
            $cachedData = Cache::get($redisKey);
            $orgDepartments = Department::where('company_id', auth()->user()->id)
                                         ->where('status', 1)
                                         ->get();
            $existingJobs = Job::where('is_primary', 0)->get();
        return view('admin.jd.llm.index', compact('cachedData','orgDepartments','existingJobs'));
      }

      public function store(Request $request, AiJobService $aiJobService)
      {
                    ini_set('max_input_vars', 5000);
                    $job = $aiJobService->createJob($request->all());

                    if ($job) {
                        return redirect()->route('admin.saved.jobdescriptions', [
                            'org_department' => $job->org_department
                        ])->with('success', 'Job created successfully.');
                    }

                    return back()->with('error', 'Job creation failed or not found.');
        }


    public function edit(Request $request,Job $job)
    {
        ini_set('max_execution_time', 300); // 5 minutes
       $formatSkills = function ($skills) {
            return $skills->map(function ($skill) {
                $formatted = [
                    'c_id' => $skill->id,
                    'id' => $skill->id,
                    'sector_id' => $skill->sector_id ?? null,
                    'category_id' => $skill->category_id ?? null,
                    'category_name' => $skill->category->title ?? null,
                    'sector_name' => $skill->sector_name ?? null,
                    'sub_sector_id' => $skill->sub_sector_id ?? null,
                    'sub_sector_name' => $skill->sub_sector_name ?? null,
                    'code' => $skill->id,
                    'name' => $skill->name,
                    'description' => $skill->description,
                    'preferred_level' => $skill->pivot->level ?? null,
                    'is_custom' => $skill->is_custom,
                ];

                // 🔁 levels 1–6
                for ($i = 1; $i <= 6; $i++) {
                    $descKey = "level_{$i}_description";
                    $knowKey = "level_{$i}_knowledge";
                    $abilKey = "level_{$i}_ability";

                    $desc = $skill->$descKey;

                    $rawKnow = str_replace(';', ',', $skill->$knowKey ?? '');
                    $rawAbil = str_replace(';', ',', $skill->$abilKey ?? '');

                    $know = array_filter(array_map('trim', explode(',', $rawKnow)));
                    $abil = array_filter(array_map('trim', explode(',', $rawAbil)));

                    if ($desc || !empty($know) || !empty($abil)) {
                        $formatted[$descKey] = $desc;
                        $formatted[$knowKey] = $know;
                        $formatted[$abilKey] = $abil;
                    }
                }

                return $formatted;
            })->toArray();
        };
        
        $job = Job::where('id', $job->id)->with(['headcounts.user:id,name','masterJob'])->first();
        $masterSkills = MasterSkill::all();
        $orgDepartments = Department::where('company_id',auth()->user()->id)->where('status',1)->get();
        $jobProfile = JobProfile::all();
        $jobFamilyGroup = [];
        $jobFamily = [];
        $technicalSkills = [];
        $masterTechnicalSkills = [];


        $cachedData = [];
        $cachedData = $this->getJobForEdit($job->id);

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

                     if (!empty($job->master_id)) {
                    $masterJob = Job::with(['technicalSkills.category'])
                        ->find($job->master_id);

                    if ($masterJob) {
                        $masterTechnicalSkills = $formatSkills($masterJob->technicalSkills);
                    }
                }

                $cachedData['masterTechnicalSkills'] = $masterTechnicalSkills;
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

                    foreach ($superiorHeadcounts as $headcount) {
                        $code = (string) $headcount->headcount_code;
                        $superiorNames[$code] = $headcount->user_id && $headcount->user ? $headcount->user->name : 'Vacant';
                    }
                }
        // if ($cachedData == null) {
        //     return redirect()->route('llm.edit', $job->id)->with('error', 'No cached data found. Please try again.');
        // }
        $businessUnits = DropdownService::getBusinessUnits();
        return view('admin.setting.job_llm_edit', compact('masterSkills', 'orgDepartments', 'technicalSkills','cachedData','jobProfile','jobFamilyGroup','jobFamily','businessUnits','job','superiorHeadcountCodes','superiorJob','superiorHeadcounts','superiorJobDepartmentId','superiorNames'))
            ->with('job', $job);
    }

    public function getJobForEdit($jobId)
    {
        $job = Job::with([
            'criticalFunctions',
            'skills',
            'llmSoftSkillDescriptions',
            'jdTechSkills',
            'educationLevel',
            'scopeStudy',
            'OrgDepartment',
            'superior'
        ])->findOrFail($jobId);

        // Prepare Critical Functions
        $criticalFunctions = $job->criticalFunctions->map(function ($criticalFunction) {
            $keytasks = $criticalFunction->cwfKeys->pluck('name')->toArray();

            return [
                'job_id' => $criticalFunction->job_id,
                'cwf_id' => $criticalFunction->id,
                'cwf_description' => $criticalFunction->description,
                'cwf_keys' => [
                    'keytasks' => $keytasks,
                    'cwf_id' => $criticalFunction->id
                ]
            ];
        });
     
        // Prepare Soft Skills
        $softSkills = $job->skills->map(function ($softSkill) { 
            return [
                'job_id' => $softSkill->job_id,
                'id' => $softSkill->id,
                'competency' => $softSkill->title,
                // 'category_name' => $softSkill->category_name ?? '',
                'description' => $softSkill->masterSkill->description ?? '',
                'preferred_level' => $softSkill->level ?? '',
                'level_1' => $softSkill->masterSkill->level_1 ?? '',
                'level_1_knowledge' => explode(';', $softSkill->masterSkill->level_1_knowledge ?? ''),
                'level_1_ability' => explode(';', $softSkill->masterSkill->level_1_ability ?? ''),
                'level_2' => $softSkill->masterSkill->level_2 ?? '',
                'level_2_knowledge' => explode(';', $softSkill->masterSkill->level_2_knowledge ?? ''),
                'level_2_ability' => explode(';', $softSkill->masterSkill->level_2_ability ?? ''),
                'level_3' => $softSkill->masterSkill->level_3 ?? '',
                'level_3_knowledge' => explode(';', $softSkill->masterSkill->level_3_knowledge ?? ''),
                'level_3_ability' => explode(';', $softSkill->masterSkill->level_3_ability ?? ''),
            ];
        });
        
        // Prepare Technical Skills
        $technicalSkills = $job->jdTechSkills->map(function ($techSkill) {
            $technicalSkill = $techSkill->masterTechnicalSkill;
              
            $formatted = [
                'c_id' => $technicalSkill->id ?? '',
                'id' => $technicalSkill->id ?? '',
                'skill_id' => $technicalSkill->id ?? '',
                'sector_id' => $technicalSkill->sector_id ?? '',
                'sector_name' => $technicalSkill->sector_name ?? '',
                'sub_sector_id' => $technicalSkill->sub_sector_id ?? '',
                'sub_sector_name' => $technicalSkill->sub_sector_name ?? '',
                'code' => $technicalSkill->code ?? '',
                'name' => $technicalSkill->name ?? '',
                // 'category_name' => optional($technicalSkill->category)->title ?? '',
                'category_name' => $technicalSkill && $technicalSkill->category ? $technicalSkill->category->title : '',
                'description' => $technicalSkill->description ?? '',
                'preferred_level' => $techSkill->level ?? '',
                'is_custom' => $technicalSkill->is_custom ?? '',
            ];

            // Add dynamic levels
            for ($i = 1; $i <= 6; $i++) {
                $formatted["level_{$i}_description"] = $technicalSkill->{"level_{$i}_description"} ?? '';
                $formatted["level_{$i}_knowledge"] = explode('; ', $technicalSkill->{"level_{$i}_knowledge"} ?? '');
                $formatted["level_{$i}_ability"] = explode('; ', $technicalSkill->{"level_{$i}_ability"} ?? '');
            }

            return $formatted;
        });
        
        // Return final structured data
        return [
            'job_id' => $job->id,
            'title' => $job->title,
            'description' => $job->description,
            'top3riasec' => $job->top3riasec,
            'department_id' => $job->department_id,
            'level' => $job->level,
            'sector_name' => $job->sector->title ?? '',
            'sub_sector_name' => $job->sector->sub_sector_name ?? '',
            'sub_sector_id' => $job->sector->sub_sector_id ?? '',
            'critical_functions' => $criticalFunctions,
            'soft_skills' => $softSkills,
            'technical_skills' => $technicalSkills ?? []
        ];
    }


    // public function saveCompanyJd(Request $request, AiJobService $aiJobService)
    // {
    //     ini_set('max_input_vars', 5000);

    //     $redisKey = $request->query('redisKey');
    //     $cachedData = Cache::get($redisKey);

    //     if (!$cachedData) {
    //         return back()->with('error', 'No data found in cache.');
    //     }

    //     dd($cachedData);

    //     // Merge cached data into the request
    //     $mergedRequest = new Request(array_merge($request->all(), $cachedData));

    //     // Pass the merged request data to the service
    //     $job = $aiJobService->createJob($mergedRequest->all());

    //     if ($job) {
    //         return redirect()->route('admin.saved.jobdescriptions', [
    //             'org_department' => $job->org_department
    //         ])->with('success', 'Job created successfully.');
    //     }

    //     return back()->with('error', 'Job creation failed or not found.');
    // }

    public function saveCompanyJd(Request $request, AiJobService $aiJobService)
    {
        ini_set('max_input_vars', 5000);

        $redisKey = $request->input('redisKey');
        $cachedData = Cache::get($redisKey);

        if (!$cachedData || !isset($cachedData['llmOutput'])) {
            return back()->with('error', 'No valid data found in cache.');
        }

        // Extract 'llmOutput' data
        $llmOutput = $cachedData['llmOutput'];

        // Transform data into the required format
        $formattedData = [
            '_token' => $request->has('_token') ? $request->input('_token') : csrf_token(), // Use existing or generate new token
            'jd_from' => '5', 
            'riasec' => $llmOutput['top3riasec'] ?? '',
            'title' => $llmOutput['title'] ?? '',
            'level' => (string) ($llmOutput['level'] ?? ''),
            'sector' => $llmOutput['sector_name'] ?? '',
            'job_role' => $llmOutput['title'] ?? '',
            'description' => $llmOutput['description'] ?? '',
            'level_job' => (string) ($llmOutput['level'] ?? ''),
            'org_department' => $request->input('department') ,
            'heads' => $request->input('heads') ?? '',
            'status' => $request->input('status') ?? '',
            'functions' => $llmOutput['critical_functions'] ?? [],
            'technicalSkills' => $llmOutput['technical_skills'] ?? [],
            'genericSkills' => $llmOutput['soft_skills'] ?? [],
            'superior' => $request->input('immediateSuperior') ?? '',
            'subordinates' => $request->input('immediateSubordinates') ?? '',
            'education_level' => $request->input('educationLevel') ?? '',
            'scope_of_study' => $request->input('scopeStudy') ?? '',
            'secondary_scope_of_study' => $request->input('secondaryScopeStudy') ?? '',
            'professional_certificate' => $request->input('professionalCertificates') ?? '',
            'relevant_training' => $request->input('relevantTraining') ?? '',
            'work_experience' => $request->input('workExperience') ?? '',
        ];

        // Pass the formatted data to the service
        $job = $aiJobService->createJob($formattedData);

        if ($job) {
            $redirectUrl = route('admin.saved.jobdescriptions', [
                'org_department' => $job->org_department
            ]);
            return response()->json(['success' => true, 'redirectUrl' => $redirectUrl]);
        }

        return back()->with('error', 'Job creation failed or not found.');
    }


}
