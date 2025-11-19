<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sector;
use App\Models\JobSkill;
use App\Models\JobTechnicalSkills;
use App\Models\TechnicalSkillCategory;
use App\Models\MasterTechnicalSkill;
use App\Models\Department;
use App\Models\Job;
use App\Models\JobFamily;
use App\Models\AirAsiaFamilyJob;
use App\Models\BusinessUnit;
use App\Models\Division;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;


use App\Models\DepartmentTechnicalSkills;

use App\Models\JobProfile;

use Illuminate\Support\Facades\DB;
use App\Services\Tsmr\TechnicalSkillProcessorService;

class CompanyTechnicalSkillController extends Controller
{
    // protected $processor;
    
    // public function __construct(TechnicalSkillProcessorService $processor)
    // {
    //     $this->processor = $processor;
    // }

    public function index(Request $request)
    {
      

        // $departments = Department::where('company_id',3)->select('id', 'name')->orderBy('name')->get();
        $sectors = Sector::select('id', 'name')->orderBy('name')->get();

        // $totalSkills = MasterTechnicalSkill::whereIn('is_custom', [1, 2])->count();
        // $categories = TechnicalSkillCategory::select('id', 'title')
        // ->whereHas('technicalSkills', function ($q) {
        //     $q->whereIn('is_custom', [1, 2]);
        // })
        // ->withCount(['technicalSkills' => function ($q) {
        //     $q->whereIn('is_custom', [1, 2]);
        // }])
        // ->get();
        
        // $allCategories = new \stdClass();
        // $allCategories->id = null;
        // $allCategories->title = 'All Categories';
        // $allCategories->technical_skills_count = $totalSkills;
        // $categories->prepend($allCategories);

        // Fallback: Full view render
        return view('admin.company_technical.index', compact(
            // 'categories',
            'sectors',
        ));
    }

    public function fetchTechSkills(Request $request)
    {
        // dd($request->all());
        $search = $request->query('search');
        $letter = $request->query('letter');
        $level = $request->query('level');
        $letterPage = $request->query('letter_page', 1);
        $lettersPerPage = 7;
        $jobIds = $request->query('job_ids');
        $category_id = $request->query('category_id');
        $perPage = (int) $request->query('perPage', 10);

        $departmentIds = $request->query('department_ids');
        $businessUnitIds = $request->query('business_unit_ids');
        $companyIds = $request->query('company_ids');
        $jobPositionIds = $request->query('job_position_ids');
        $sectorIds = $request->query('sector_ids');
        $filterCategoryIds = $request->query('filter_category_ids');

        if (is_string($sectorIds)) {
            $sectorIds = array_filter(explode(',', $sectorIds));
        }
        if (is_string($filterCategoryIds)) {
            $filterCategoryIds = array_filter(explode(',', $filterCategoryIds));
        }
        if (is_string($businessUnitIds)) {
        $businessUnitIds = array_filter(explode(',', $businessUnitIds));
        }
        
        if (is_string($companyIds)) {
            $companyIds = array_filter(explode(',', $companyIds));
        }

        if (is_string($departmentIds)) {
            $departmentIds = array_filter(explode(',', $departmentIds)); // remove empty
        }

            
        if (is_string($jobPositionIds)) {
            $jobPositionIds = array_filter(explode(',', $jobPositionIds));
        }

    
          $jobPositionsWithDepts = collect();
        if (!empty($jobPositionIds)) {
            $jobPositionsWithDepts = DB::table('jobs')
                ->whereIn('id', $jobPositionIds)
                ->select('id', 'title', 'department_id')
                ->get();
        }
        
        $perPageByHierarchy = [];
        foreach ($request->query() as $key => $value) {
            if (preg_match('/^per_page_dept_(\d+)$/', $key, $matches)) {
                $hierarchyId = (int) $matches[1];
                $perPageByHierarchy[$hierarchyId] = (int) $value;
            }
        }


        // $query = MasterTechnicalSkill::query()->whereIn('is_custom', [1, 2]);
        $query = DB::table('master_technical_skills')
            ->leftJoin('sectors as s', 'master_technical_skills.sector_id', '=', 's.id')
            ->leftJoin('technical_skill_categories as c', 'master_technical_skills.category_id', '=', 'c.id')
            ->select([
                'master_technical_skills.id',
                'master_technical_skills.name',
                'master_technical_skills.description',
                'master_technical_skills.level_1_description',
                'master_technical_skills.level_2_description',
                'master_technical_skills.level_3_description',
                'master_technical_skills.level_4_description',
                'master_technical_skills.level_5_description',
                'master_technical_skills.level_6_description',


                'master_technical_skills.is_custom as type',
                'master_technical_skills.sector_id',
                'master_technical_skills.category_id',
                'master_technical_skills.created_at',
                'master_technical_skills.updated_at',
                'master_technical_skills.is_overwrite',
                's.name as sector_name',
                'c.title as category_name',
            ])
        ->where(function ($q) {
            $q->whereIn('master_technical_skills.is_custom', [1, 2]) // company skills
            ->orWhere(function ($q2) { // master skills linked to jobs only
                $q2->where('master_technical_skills.is_custom', 0)
                    ->whereIn('master_technical_skills.id', function ($sub) {
                        // $sub->select('master_technical_skill_id')
                        //     ->from('job_technical_skills'); // semi-join; distinct not needed
                        $sub->select('jts.master_technical_skill_id')
                     ->from('job_technical_skills as jts')
                     ->join('jobs as j', 'jts.job_id', '=', 'j.id')
                     ->where('j.is_primary', 0);
                    });
            });
        });

        // Validate and apply sorting
        $sort = $request->query('sort');
        $order = in_array($request->query('order'), ['asc', 'desc']) ? $request->query('order') : 'asc';

        switch ($sort) {
            case 'name':
                $query->orderBy('master_technical_skills.name', $order);
                break;
            case 'created_at':
                $query->orderBy('master_technical_skills.created_at', $order);
                break;
            case 'sector':
                $query->orderBy('s.name', $order);
                break;
            case 'category':
                $query->orderBy('c.title', $order);
                break;
            case 'custom_type':
                $query->orderBy('master_technical_skills.is_custom', $order);
                break;
            default:
                $query->orderBy('master_technical_skills.created_at', 'desc');
        }

      
         
            if (!empty($sectorIds)) {
                $query->whereIn('master_technical_skills.sector_id', $sectorIds);
            }
     
            if (!empty($filterCategoryIds)) {
                $query->whereIn('master_technical_skills.category_id', $filterCategoryIds);
            }
    

        // Search filter
        if (!empty($search)) {
            $query->where('master_technical_skills.name', 'like', '%' . $search . '%');
        }

        // Letter filter
        if ($letter && strtoupper($letter) !== 'ALL' && $letter !== 'undefined' && $letter !== 'null') {
            $query->whereRaw('UPPER(LEFT(master_technical_skills.name, 1)) = ?', [strtoupper($letter)]);
        }

        // Level filter
        if ($level && in_array($level, ['1', '2', '3', '4', '5', '6'])) {
            $query->whereNotNull("master_technical_skills.level_{$level}_description")->where("master_technical_skills.level_{$level}_description", '!=', '');
        }

        if (!empty($jobPositionIds)) {
            $query->whereExists(function ($sub) use ($jobPositionIds) {
                $sub->select(DB::raw(1))
                    ->from('job_technical_skills as jts')
                    ->join('jobs as j', 'jts.job_id', '=', 'j.id')
                    ->where('j.is_primary', 0)
                    ->whereIn('j.id', $jobPositionIds)
                    ->whereColumn('jts.master_technical_skill_id', 'master_technical_skills.id');
            });
        }


        $technicalSkills = $query->paginate($perPage)->withQueryString();

        $totalSkills = MasterTechnicalSkill::whereIn('is_custom', [1, 2])->count();
        $selectedCategory = $category_id ? TechnicalSkillCategory::find($category_id) : null;

        
        $categories = TechnicalSkillCategory::select('id', 'title')
        ->whereHas('technicalSkills', function ($q) {
            $q->whereIn('is_custom', [1, 2]);
        })
        ->withCount(['technicalSkills' => function ($q) {
            $q->whereIn('is_custom', [1, 2]);
        }])
        ->get();

        $letterQuery = MasterTechnicalSkill::query()->whereIn('is_custom', [1, 2]);
        if ($category_id && $category_id !== 'undefined' && $category_id !== 'null') {
            $letterQuery->where('category_id', $category_id);
        }

        $allLetters = $letterQuery
            ->selectRaw('UPPER(LEFT(name, 1)) as first_letter')
            ->groupBy('first_letter')
            ->orderBy('first_letter')
            ->pluck('first_letter')
            ->toArray();

         $visibleLetters = $allLetters; // Return all letters (A–Z)
         $hiddenLetters = [];           // Not needed anymore

        // Handle AJAX filtering
        if ($request->ajax()) {
            $skillsByDept = [];

            $hierarchicalStructure = $this->determineHierarchicalStructure(
                $businessUnitIds, 
                $companyIds, 
                $departmentIds
            );

            // dd($hierarchicalStructure);

           if (!empty($hierarchicalStructure)) {
            foreach ($hierarchicalStructure as $item) {
                $q = DB::table('master_technical_skills')
            ->leftJoin('sectors as s', 'master_technical_skills.sector_id', '=', 's.id')
            ->leftJoin('technical_skill_categories as c', 'master_technical_skills.category_id', '=', 'c.id')
            ->select([
                'master_technical_skills.id',
                'master_technical_skills.name',
                'master_technical_skills.description',
                'master_technical_skills.level_1_description',
                'master_technical_skills.level_2_description',
                'master_technical_skills.level_3_description',
                'master_technical_skills.level_4_description',
                'master_technical_skills.level_5_description',
                'master_technical_skills.level_6_description',
                'master_technical_skills.is_custom as type',
                'master_technical_skills.sector_id',
                'master_technical_skills.category_id',
                'master_technical_skills.created_at',
                'master_technical_skills.updated_at',
                'master_technical_skills.is_overwrite',

                's.name as sector_name',
                'c.title as category_name',
            ])
            ->where(function ($q) {
                $q->whereIn('master_technical_skills.is_custom', [1, 2]) // company skills
                ->orWhere(function ($q2) { // master skills linked to jobs only
                    $q2->where('master_technical_skills.is_custom', 0)
                        ->whereIn('master_technical_skills.id', function ($sub) {
                            // $sub->select('master_technical_skill_id')
                            //     ->from('job_technical_skills'); // semi-join; distinct not needed
                              $sub->select('jts.master_technical_skill_id')
                                ->from('job_technical_skills as jts')
                                ->join('jobs as j', 'jts.job_id', '=', 'j.id')
                                ->where('j.is_primary', 0);
                
                        });
                });
            });

             switch ($sort) {
                case 'name':
                    $q->orderBy('master_technical_skills.name', $order);
                    break;
                case 'created_at':
                    $q->orderBy('master_technical_skills.created_at', $order);
                    break;
                case 'sector':
                    $q->orderBy('s.name', $order);
                    break;
                case 'category':
                    $q->orderBy('c.title', $order);
                    break;
                case 'custom_type':
                    $q->orderBy('master_technical_skills.is_custom', $order);
                    break;
                default:
                    $q->orderBy('master_technical_skills.created_at', 'desc');
            }
                
                // Apply all existing filters
               
                if ($letter && strtoupper($letter) !== 'ALL' && $letter !== 'undefined' && $letter !== 'null') {
                    $q->whereRaw('UPPER(LEFT(name, 1)) = ?', [strtoupper($letter)]);
                }
                //   dd($q->get());
                if (!empty($search)) {
                    $q->where('master_technical_skills.name', 'like', '%' . $search . '%');
                }
                if (!empty($sectorIds)) {
                    $q->whereIn('master_technical_skills.sector_id', $sectorIds);
                }
            
                if (!empty($filterCategoryIds)) {
                    $q->whereIn('master_technical_skills.category_id', $filterCategoryIds);
                }
                if ($level && in_array($level, ['1', '2', '3', '4', '5', '6'])) {
                    $q->whereNotNull("level_{$level}_description")
                      ->where("level_{$level}_description", '!=', '');
                }

                 $relevantJobPositions = $this->getJobPositionsForHierarchyItem($item, $jobPositionsWithDepts);

                // dd($q->get());

                // Apply hierarchical filtering using direct foreign keys
                $q->whereExists(function ($sub) use ($item,$relevantJobPositions) {
                    $sub->select(DB::raw(1))
                        ->from('job_technical_skills as jts')
                        ->join('jobs as j', 'jts.job_id', '=', 'j.id');
                     $sub->where('j.is_primary', 0);
                    // Filter based on hierarchy level
                    switch ($item['type']) {
                        case 'department':
                            $sub->where('j.department_id', $item['id']);
                            // dd($sub->get());
                            break;
                        case 'division':
                            $sub->where('j.division_id', $item['id']);
                            break;
                        case 'business_unit':
                            $sub->where('j.business_unit_id', $item['id']);
                            break;
                    }

                    
                    if (!empty($relevantJobPositions) && !$relevantJobPositions->isEmpty()) {
                    $sub->whereIn('j.id', $relevantJobPositions->pluck('id'));
                    }
        
                    
                    $sub->whereColumn('jts.master_technical_skill_id', 'master_technical_skills.id');
                });

        
                // Get per-page count for this hierarchy item
                $hierarchyPerPage = $perPageByHierarchy[$item['id']] ?? 10;
                
                // Paginate with hierarchy-specific page parameter
                $paginated = $q->paginate($hierarchyPerPage, ['*'], 'page_dept_' . $item['id'])
                    ->appends($request->query())
                    ->withPath('/admin/company/technical/skill/fetch');

                // Get jobs for this hierarchy level
                // $jobs = $this->getJobsForHierarchy($item);
                // dd($skillsByDept);
                $skillsByDept[$item['id']] = [
                    'department' => $item['display_name'], // This will show the full hierarchy path
                    'data'       => $paginated->items(),
                    'selected_job_positions' => $relevantJobPositions->toArray(),
                    // 'jobs'       => $jobs,
                    'pagination' => [
                        'current_page' => $paginated->currentPage(),
                        'last_page'    => $paginated->lastPage(),
                        'prev_url'     => $paginated->previousPageUrl(),
                        'next_url'     => $paginated->nextPageUrl(),
                        'page_param'   => 'page_dept_' . $item['id'],
                        'total'        => $paginated->total(),
                    ],
                ];
            }
        }

        // dd($skillsByDept);
            return response()->json([
                'technicalSkills' => $technicalSkills,
                'categories' => $categories,
                'totalSkills' => $totalSkills,
                'selectedCategory' => $selectedCategory,
                'visibleLetters' => $visibleLetters,
                'hiddenLetters' => $hiddenLetters,
                // 'departments' => $departments,
                'skillsByDept' => $skillsByDept ?? [],
                'pagination' => [
                    'current_page' => $technicalSkills->currentPage(),
                    'last_page' => $technicalSkills->lastPage(),
                    'prev_page_url' => $technicalSkills->previousPageUrl(),
                    'next_page_url' => $technicalSkills->nextPageUrl(),
                ],
            ]);
        }

    }

    public function getRelatedJobs($skillId)
    {
        // Check if the related jobs are cached
        $cacheKey = 'related_jobs_skill_' . $skillId;
        $relatedJobs = cache()->remember($cacheKey, 60, function() use ($skillId) {
            return Job::select('jobs.title')
                ->join('job_technical_skills', 'jobs.id', '=', 'job_technical_skills.job_id')
                ->where('job_technical_skills.master_technical_skill_id', $skillId)
                ->where('jobs.is_primary',0)
                ->get()
                ->pluck('title');  // Get an array of job titles
        });
        // dd($relatedJobs);
        return response()->json([
            'affectedJobs' => $relatedJobs
        ]);
    }

     public function create()
    {
        $sectors = Sector::select('id','name')->get();

        return view('admin.company_technical.create',compact('sectors'));
    }

     public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
            'required', 
            'string', 
            'max:255', 
            Rule::unique('master_technical_skills')->where(function ($query) use ($request) {
                return $query->where('sector_id', $request->sector_id)
                             ->where('category_id', $request->category_id);
            })
            ],
            'description' => 'required|string',
            'category_id' => 'required|integer|exists:technical_skill_categories,id',
            'sector_id' => 'required|integer|exists:sectors,id',
            'level_description' => 'array',
            'knowledge' => 'array',
            'ability' => 'array',
            ], 
            [
            'name.required' => 'The Technical Skill Title is required.'
        ]);
    
        //   $checkMasterTechnicalSkill = MasterTechnicalSkill::where('name', $request->name)
        // ->whereIn('is_custom', [1, 2]) // Assuming type 1 is for custom skills
        // ->where('category_id', $request->category_id) // Match category as well
        // ->first();

        // // dd($request->name,$request->category_id);
        // // If the technical skill exists, return a validation error
        //     if ($checkMasterTechnicalSkill) {
        //         return redirect()->back()
        //             ->withErrors([
        //                 'name' => 'A technical skill with this title already exists in the system for this category.'
        //             ])
        //             // ->with('error', 'A technical skill with this title already exists in the system for this category.')
        //             ->withInput();
        //     }
         if ($this->companyTitleExists($request->name)) {
            return back()
                ->withErrors(['name' => 'Company technical skill title already exists in this sector and category. Please enter a different one.'])
                ->withInput();
        }


        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => (int)$request->category_id,
            'sector_id' => (int)$request->sector_id,
            'is_custom' => 2, // Force store value 2
        ];
        
        for ($i = 1; $i <= 6; $i++) {
            $data["level_{$i}_description"] = $request->input("level_{$i}_description");
            $data["level_{$i}_knowledge"] = $request->has("level_{$i}_knowledge") ? implode('; ', $request->input("level_{$i}_knowledge")) : null;
            $data["level_{$i}_ability"] = $request->has("level_{$i}_ability") ? implode('; ', $request->input("level_{$i}_ability")) : null;
        }
        
        MasterTechnicalSkill::create($data);
        
        $message = "Technical skill <b>" . $request->name . "</b> was added successfully. You can assign it to job positions in the <b>Job Management</b> feature.";
        session()->flash('alert', ['type' => 'success', 'message' => $message]);
    
        // return redirect()->route('sector.skills.company');
        return redirect()->route('sector.skills.company', ['tab' => 'title']);

    }


    public function edit(Request $request, $id)
    {
       
       
        $skill = MasterTechnicalSkill::findOrFail($id);
        // $categories = TechnicalSkillCategory::all();
        $sectors = Sector::select('id','name')->get();


        $jobs = Job::select('jobs.title')
        ->join('job_technical_skills', 'jobs.id', '=', 'job_technical_skills.job_id')
        ->where('job_technical_skills.master_technical_skill_id', $id)
        ->get();
        

        // You can pass $request->input('title') to the view if needed
        return view('admin.company_technical.edit', compact('skill', 'sectors', 'jobs'));
    }


    public function view($id)
    {
        // Fetch the skill by ID
        $skill = MasterTechnicalSkill::findOrFail($id);

        $categoryTitle = $skill->category->title ?? '';
    
        // Prepare the levels array dynamically
        $levels = [];
        for ($i = 1; $i <= 6; $i++) {
            if (
                $skill->{"level_{$i}_description"} &&
                $skill->{"level_{$i}_knowledge"} &&
                $skill->{"level_{$i}_ability"}
            ) {
                $levels[] = [
                    'level' => $i,
                    'description' => $skill->{"level_{$i}_description"},
                    'knowledge' => $skill->{"level_{$i}_knowledge"},
                    'ability' => $skill->{"level_{$i}_ability"},
                ];
            }
        }
    
        // Retrieve all jobs related to this technical skill
        $jobs = Job::select('jobs.id', 'jobs.title', 'jobs.description', 'job_technical_skills.level as SkillLevel','jobs.department_id','jobs.level')
            ->join('job_technical_skills', 'jobs.id', '=', 'job_technical_skills.job_id')
            ->where('job_technical_skills.master_technical_skill_id', $id)->where('jobs.is_primary',0)
            ->get();
    
        $jobsByLevel = [];
        foreach ($jobs as $job) {
            $jobsByLevel[$job->SkillLevel][] = $job;
        }
    
        // Optionally convert to collections (if you want to use ->count() safely in Blade)
        foreach ($jobsByLevel as $level => $job) {
            $jobsByLevel[$level] = collect($job);
        }
    
        return view('admin.company_technical.view', compact('skill', 'levels', 'jobs', 'jobsByLevel', 'categoryTitle'));
    }
    


    public function duplicate(Request $request, $id)
    {

        $name = $request->query('new_title');
        $type = $request->query('skill_type');

        return redirect()
            ->route('sector.skills.company.edit', ['id' => $id,'duplicate'=>true,'skill_type'=>$type])
            ->withInput(['name' => $name, 'new_title' => $name])
            ->with('is_duplicate', true);
    }



    public function update(Request $request, $id)
    {

        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:technical_skill_categories,id',
            'sector_id' => 'required|exists:sectors,id',
        ], [
            'name.required' => 'The Technical Skill Title is required.'
        ]);

       $isDuplicateMode = (string)$request->input('is_duplicate') === '1';

        // Determine the skill ID to ignore if it's an update (we don't want to validate against the same skill when updating)
        $ignoreId = $isDuplicateMode ? null : $id;

        if ($this->companyTitleExists($request->name, $ignoreId)) {
            return back()
                ->withErrors(['name' => 'Company technical skill title already exists in this sector and category. Please enter a different one.'])
                ->withInput();
        }

        if ($isDuplicateMode) {
            // Creating a new skill in duplicate mode
            $skill = new MasterTechnicalSkill();
            $skill->is_custom = 2;

            if ($request->has('type') && (int)$request->type === 0) {
                $skill->master_technical_skill_id = $request->current_skill_id;
            }
        } else {
            // If it's not a duplicate, update the existing skill
            $skill = MasterTechnicalSkill::findOrFail($id);
            $skill->is_overwrite = 1;
        }
        $skill->name = $request->name;
        

        $skill->description = $request->description;

        $skill->category_id = $request->category_id;
        $skill->sector_id = $request->sector_id;


        // Get array of removed levels
        $removedLevels = $request->input('removed_levels', []);
     
        for ($i = 1; $i <= 6; $i++) {
            // If this level was removed, set all its fields to null
            if (in_array($i, $removedLevels)) {
                $skill->{"level_{$i}_description"} = null;
                $skill->{"level_{$i}_knowledge"} = null;
                $skill->{"level_{$i}_ability"} = null;
                continue;
            }

            $desc = $request->input("level_{$i}_description");
            $knowledge = $request->input("level_{$i}_knowledge", []);
            $ability = $request->input("level_{$i}_ability", []);

            if ($desc !== null || !empty(array_filter($knowledge)) || !empty(array_filter($ability))) {
                $skill->{"level_{$i}_description"} = $desc === "" ? null : $desc;
                $skill->{"level_{$i}_knowledge"} = empty(array_filter($knowledge)) ? null : implode(';', array_filter($knowledge));
                $skill->{"level_{$i}_ability"} = empty(array_filter($ability)) ? null : implode(';', array_filter($ability));
            } else {
                // If no data was submitted for this level, set to null
                $skill->{"level_{$i}_description"} = null;
                $skill->{"level_{$i}_knowledge"} = null;
                $skill->{"level_{$i}_ability"} = null;
            }
        }

        $skill->save();

        if($request->is_duplicate != null && $request->has('is_duplicate') && $request->is_duplicate == 1){
                    $message = "Technical skill <b>" . $request->name . "</b> has been successfully duplicated and saved as a new skill. You can now assign it to job positions in the <b> Job Management </b>feature.";
        }else{
        $message = "Technical skill <b>" . $request->name . "</b> has been successfully overwritten. All associated job positions have been updated.";
        }
        session()->flash('alert', ['type' => 'success', 'message' => $message]);

        // For single
        // try {
        //     $technicalSkill = MasterTechnicalSkill::findOrFail($skill->id);
        //     $predictUnmatched = $request->input('predict_unmatched', true);
            
        //     $result = $this->processor->processAndBulkInsert($technicalSkill, $predictUnmatched);
        //     // dd($result);
        //     return response()->json($result);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => $e->getMessage()
        //     ], 500);
        // }


        // For Bulk:
        // $request->validate([
        //     'skill_ids' => 'required|array',
        //     'skill_ids.*' => 'integer|exists:master_technical_skills,id',
        //     'predict_unmatched' => 'boolean'
        // ]);
        
        // try {
        //     $skillIds = $request->input('skill_ids');
        //     $predictUnmatched = $request->input('predict_unmatched', true);
            
        //     $result = $this->processor->processBulkSkills($skillIds, $predictUnmatched);
            
        //     return response()->json($result);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => $e->getMessage()
        //     ], 500);
        // }
       

        return redirect()->route('sector.skills.company.view', ['id' => $skill->id]);
    }
    
    // public function companyTitleExists($name, $sectorId, $categoryId, $ignoreId = null)
    // {
    //     $query = MasterTechnicalSkill::where('name', $name)
    //         ->where('sector_id', $sectorId)
    //         ->where('category_id', $categoryId);

    //     if ($ignoreId) {
    //         $query->where('id', '!=', $ignoreId);
    //     }

    //     return $query->exists();
    // }
    public function companyTitleExists($name, $ignoreId = null)
    {
        $query = MasterTechnicalSkill::where('name', $name);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        return $query->exists();
    }

    public function destroy(Request $request,$id)
    {
        // dd($request->skill_type == 0,$request->has('skill_type'));

        $skill = MasterTechnicalSkill::findOrFail($id);
            $skillName = $skill->name;
        if($request->has('skill_type') && $request->skill_type != 0){

            $skill->delete();
            $skillJobs = JobTechnicalSkills::where('master_technical_skill_id', $skill->id)->delete();
        }else{


            $skillJobs = JobTechnicalSkills::where('master_technical_skill_id', $skill->id)
            ->whereHas('job', function($query) {
                $query->where('is_primary', 0);
            })->delete();

            // dd($skillJobs);
            
        
        }
       

        //  $skillJobs = JobTechnicalSkills::where('master_technical_skill_id', $skill->id)
        //     ->whereIn('job_id', $request->profileIds)
        //     ->delete();


        $successMessage = 'The technical skill ' . $skillName . ' was deleted successfully.';
        session()->flash('alert', ['type' => 'success', 'message' => $successMessage]);

        return redirect()->route('sector.skills.company', ['tab' => 'title']);

    }


    
    public function getJobProfilesByDivision($division_id)
    {
        $departmentIds = Department::where('division_id', $division_id)
            ->pluck('id')
            ->toArray();

        if (empty($departmentIds)) {
            return response()->json([
                'allSkills'   => [],
                'profiles'    => [],
                'departments' => [],
            ]);
        }

        // Fetch departments for dropdown
        $departments = Department::where('division_id', $division_id)
            ->orderBy('name')
            ->get(['id', 'name'])
            ->toArray();

        // Fetch all skills for ALL departments in this division
        $allSkills = MasterTechnicalSkill::with(['sector:id,name', 'category:id,title'])
            ->whereIn('id', function($query) use ($departmentIds) {
                $query->select('master_technical_skill_id')
                    ->from('department_technical_skills')
                    ->whereIn('department_id', $departmentIds)
                    ->distinct();
            })
            ->orderBy('name')
            ->get([
                'id', 'name',
                'level_1_description', 'level_2_description', 'level_3_description',
                'level_4_description', 'level_5_description', 'level_6_description',
                'sector_id', 'category_id'
            ])
            ->map(function ($skill) {
                $sectorName = $skill->sector->name ?? 'Sector Name';
                $categoryName = $skill->category->title ?? 'N/A';
                
                return [
                    'id' => $skill->id,
                    'name' => $skill->name . " ({$sectorName} - {$categoryName})",
                    'level_1_description' => $skill->level_1_description,
                    'level_2_description' => $skill->level_2_description,
                    'level_3_description' => $skill->level_3_description,
                    'level_4_description' => $skill->level_4_description,
                    'level_5_description' => $skill->level_5_description,
                    'level_6_description' => $skill->level_6_description,
                ];
            })
            ->toArray();

        $skillIds = collect($allSkills)->pluck('id')->toArray();

        // Fetch ALL jobs for this division with optimized eager loading
        $jobs = Job::with([
                'jobProfile:id,name,job_profile_level',
                'technicalSkills:id,level_1_description,level_2_description,level_3_description,level_4_description,level_5_description,level_6_description',
                'department:id,name'
            ])
            ->where('division_id', $division_id)
            ->select(['id', 'job_profile_id', 'department_id', 'level', 'status'])
            ->get();

        $profiles = $jobs->map(function($job) use ($skillIds) {
            $profileModel = $job->jobProfile;
            
            if (!$profileModel) {
                return null;
            }

            // Build skills map
            $skillsMap = [];
            foreach ($job->technicalSkills as $skill) {
                if (!in_array($skill->id, $skillIds)) {
                    continue;
                }

                $level = (int) $skill->pivot->level;
                $descColumn = 'level_' . $level . '_description';
                
                $skillsMap[$skill->id] = [
                    'level'                    => $level,
                    'master_techs_skill_id'    => $skill->id,
                    'pivot_id'                 => $skill->pivot->id ?? null,
                    'description'              => $skill->{$descColumn} ?? '',
                ];
            }

            return [
                'profile_id'       => $profileModel->id,
                'job_id'           => $job->id,
                'department_id'    => $job->department_id,
                'department_name'  => $job->department->name ?? 'N/A',
                'status'           => $job->status,
                'profile_url'      => '/admin/saved-jobdescriptions?org_department=' . $job->department_id . '&saved_job=1&selected_job=' . $job->id,
                'name'             => $profileModel->name,
                'management_level' => $job->level ?? '-',
                'job_profile_level'=> $profileModel->job_profile_level,
                'skills'           => $skillsMap,
            ];
        })
        ->filter()
        ->values();

        // Sort profiles
        $managementOrder = [
            'Senior Management'     => 0,
            'Management'            => 1,
            'Individual Contributor'=> 2,
            'Non Executive'         => 3,
        ];

        $profiles = $profiles->sort(function ($a, $b) use ($managementOrder) {
            $rankA = $managementOrder[$a['management_level']] ?? 99;
            $rankB = $managementOrder[$b['management_level']] ?? 99;
            return $rankA <=> $rankB;
        })->values()->toArray();

        return response()->json([
            'allSkills'   => $allSkills,
            'profiles'    => $profiles,
            'departments' => $departments,
        ]);
    }

    /**
     * Get data for a specific department only
     * Called when a specific department is selected
     */
    public function getJobProfilesByDepartment($department_id)
    {
        $department = Department::find($department_id, ['id', 'name', 'division_id']);

        if (!$department) {
            return response()->json([
                'allSkills' => [],
                'profiles'  => [],
            ]);
        }

        // Fetch skills ONLY for this specific department
        $allSkills = MasterTechnicalSkill::with(['sector:id,name', 'category:id,title'])
            ->whereIn('id', function($query) use ($department_id) {
                $query->select('master_technical_skill_id')
                    ->from('department_technical_skills')
                    ->where('department_id', $department_id);
            })
            ->orderBy('name')
            ->get([
                'id', 'name',
                'level_1_description', 'level_2_description', 'level_3_description',
                'level_4_description', 'level_5_description', 'level_6_description',
                'sector_id', 'category_id'
            ])
            ->map(function ($skill) {
                $sectorName = $skill->sector->name ?? 'Sector Name';
                $categoryName = $skill->category->title ?? 'N/A';
                
                return [
                    'id' => $skill->id,
                    'name' => $skill->name . " ({$sectorName} - {$categoryName})",
                    'level_1_description' => $skill->level_1_description,
                    'level_2_description' => $skill->level_2_description,
                    'level_3_description' => $skill->level_3_description,
                    'level_4_description' => $skill->level_4_description,
                    'level_5_description' => $skill->level_5_description,
                    'level_6_description' => $skill->level_6_description,
                ];
            })
            ->toArray();

        $skillIds = collect($allSkills)->pluck('id')->toArray();

        // Fetch jobs for this department only
        $jobs = Job::with([
                'jobProfile:id,name,job_profile_level',
                'technicalSkills:id,level_1_description,level_2_description,level_3_description,level_4_description,level_5_description,level_6_description',
            ])
            ->where('department_id', $department_id)
            ->select(['id', 'job_profile_id', 'department_id', 'level', 'status'])
            ->get();

        $profiles = $jobs->map(function($job) use ($skillIds, $department) {
            $profileModel = $job->jobProfile;
            
            if (!$profileModel) {
                return null;
            }

            // Build skills map - only include skills from this department
            $skillsMap = [];
            foreach ($job->technicalSkills as $skill) {
                if (!in_array($skill->id, $skillIds)) {
                    continue;
                }

                $level = (int) $skill->pivot->level;
                $descColumn = 'level_' . $level . '_description';
                
                $skillsMap[$skill->id] = [
                    'level'                    => $level,
                    'master_techs_skill_id'    => $skill->id,
                    'pivot_id'                 => $skill->pivot->id ?? null,
                    'description'              => $skill->{$descColumn} ?? '',
                ];
            }

            return [
                'profile_id'       => $profileModel->id,
                'job_id'           => $job->id,
                'department_id'    => $job->department_id,
                'department_name'  => $department->name,
                'status'           => $job->status,
                'profile_url'      => '/admin/saved-jobdescriptions?org_department=' . $job->department_id . '&saved_job=1&selected_job=' . $job->id,
                'name'             => $profileModel->name,
                'management_level' => $job->level ?? '-',
                'job_profile_level'=> $profileModel->job_profile_level,
                'skills'           => $skillsMap,
            ];
        })
        ->filter()
        ->values();

        // Sort profiles
        $managementOrder = [
            'Senior Management'     => 0,
            'Management'            => 1,
            'Individual Contributor'=> 2,
            'Non Executive'         => 3,
        ];

        $profiles = $profiles->sort(function ($a, $b) use ($managementOrder) {
            $rankA = $managementOrder[$a['management_level']] ?? 99;
            $rankB = $managementOrder[$b['management_level']] ?? 99;
            return $rankA <=> $rankB;
        })->values()->toArray();

        return response()->json([
            'allSkills' => $allSkills,
            'profiles'  => $profiles,
        ]);
    }

    // Example of handling the request in a PHP (Laravel) controller
    public function updateTechnicalSkillLvl(Request $request)
    {
        // Debugging output (you can remove this in production)
        // dd($request->all());

        // Validate incoming request
        $request->validate([
            'skillId' => 'required|integer', // Ensure skillId is provided and is an integer
            'level' => 'nullable|integer|min:1|max:6', // Level is optional, but must be between 1 and 6 if provided
            'pivotId' => 'nullable|integer', // Ensure pivotId is provided and is an integer
            'is_remove' => 'nullable|boolean', // is_remove is optional but should be a boolean if provided
            'jobId' => 'nullable|integer', 
        ]);

        $skill = JobTechnicalSkills::find($request->pivotId);

        if ($request->has('is_remove') && $request->is_remove == true) {
            $skill->delete();
            $skillName= $skill->masterTechnicalSkill->name;
            $successMessage = 'The technical skill <b>' . $skillName . '</b> was deleted successfully.';

            return response()->json(['success' => true, 'message' => $successMessage]);
        }

        

        if ($skill) {
            if ($request->has('level')) {
            $skill->update([
                'level' => $request->level,
                // Add other fields to update if necessary
            ]);

             $skillName= $skill->masterTechnicalSkill->name;
            $successMessage = 'The technical skill <b>' . $skillName . '</b> was updated successfully';
            return response()->json(['success' => true, 'message' => $successMessage]);
        }
        }else{

        $jobSkill =  JobTechnicalSkills::create([
                'job_id'=>$request->jobId,
                'level'=>$request->level,
                'master_technical_skill_id'=>$request->skillId,

            ]);
            // dd($jobSkill);
             $skillName= $jobSkill->masterTechnicalSkill->name;
            $successMessage = 'The technical skill <b>' . $skillName . '</b> was created successfully';

            return response()->json(['success' => true, 'message' =>  $successMessage]);

        }


        return response()->json(['success' => false, 'message' => 'No action taken']);
    }

    public function approveSelectedJobProfile(Request $request)
    {
        // Extract selected values from the request
        $selectedValues = $request->input('selectedValues'); // Array of skill or job profile IDs

        // Ensure that selectedValues is an array and not empty
        if (empty($selectedValues) || !is_array($selectedValues)) {
            return response()->json(['success' => false, 'message' => 'No skills selected']);
        }

        // Process each selected value (approving the selected job positions)
        foreach ($selectedValues as $skillId) {
            // Find the skill (or job profile) using the provided ID
            $skill = Job::find($skillId); // Ensure that 'Job' is the correct model

            if ($skill) {
                $skill->status = 1; // Assuming 1 means "approved"
                $skill->save();
            } else {
                // If a job profile (skill) does not exist, you may want to return an error
                return response()->json(['success' => false, 'message' => 'One or more selected skills not found']);
            }
        }

        return response()->json(['success' => true, 'message' => 'Selected skills approved']);
    }

        public function deleteJobSkills(Request $request,$id)
    {
        // dd($request->all(),$id);
         $skill = MasterTechnicalSkill::findOrFail($id);
        $skillName = $skill->name;
      
            $skillJobs = JobTechnicalSkills::where('master_technical_skill_id', $skill->id)
            ->whereIn('job_id', $request->profileIds)
            ->delete();

            $jfts = DepartmentTechnicalSkills::where('master_technical_skill_id',$skill->id)->where('department_id',$request->job_family_id)->delete();

        $successMessage = 'The technical skill <b>' . $skillName . '</b> has been removed successfully.';

        return response()->json([
            'status' => 'success',
            'message' => $successMessage,
        ]);
    }

    public function createJobFamilyTechSkill(Request $request)
    {
        $request->validate([
            'skill_id' => 'required|integer',
            'track_id' => 'required|integer',
        ]);

        // Get original skill
        $originalSkill = MasterTechnicalSkill::findOrFail($request->skill_id);

        // Check if it's a master skill (0) or company skill (1 or 2)
        if ($originalSkill->is_custom == 0) {
            // If master skill, check for existing company copy with same name and category
            $companySkill = MasterTechnicalSkill::where('is_custom', '!=', 0)
                ->where('name', $originalSkill->name)
                ->where('category_id', $originalSkill->category_id)
                ->first();

            if (!$companySkill) {
                // Clone master skill into company skill
                $companySkill = MasterTechnicalSkill::create([
                    'sector_id' => $originalSkill->sector_id,
                    'category_id' => $originalSkill->category_id,
                    'sector_name' => $originalSkill->sector_name,
                    'sub_sector_id' => $originalSkill->sub_sector_id,
                    'sub_sector_name' => $originalSkill->sub_sector_name,
                    'code' => $originalSkill->code,
                    'name' => $originalSkill->name,
                    'description' => $originalSkill->description,

                    // Levels
                    'level_1_description' => $originalSkill->level_1_description,
                    'level_2_description' => $originalSkill->level_2_description,
                    'level_3_description' => $originalSkill->level_3_description,
                    'level_4_description' => $originalSkill->level_4_description,
                    'level_5_description' => $originalSkill->level_5_description,
                    'level_6_description' => $originalSkill->level_6_description,

                    // Knowledge
                    'level_1_knowledge' => $originalSkill->level_1_knowledge,
                    'level_2_knowledge' => $originalSkill->level_2_knowledge,
                    'level_3_knowledge' => $originalSkill->level_3_knowledge,
                    'level_4_knowledge' => $originalSkill->level_4_knowledge,
                    'level_5_knowledge' => $originalSkill->level_5_knowledge,
                    'level_6_knowledge' => $originalSkill->level_6_knowledge,

                    // Ability
                    'level_1_ability' => $originalSkill->level_1_ability,
                    'level_2_ability' => $originalSkill->level_2_ability,
                    'level_3_ability' => $originalSkill->level_3_ability,
                    'level_4_ability' => $originalSkill->level_4_ability,
                    'level_5_ability' => $originalSkill->level_5_ability,
                    'level_6_ability' => $originalSkill->level_6_ability,

                    'is_custom' => 2,
                    // 'type' => $originalSkill->type,
                    // 'job_id' => $originalSkill->job_id,
                ]);
            }

            $finalSkillId = $companySkill->id;
        } else {
            // If already a company skill
            $finalSkillId = $originalSkill->id;
        }

        // Now check if job family already has this skill mapped
        $jobFamilyskill = DepartmentTechnicalSkills::where('department_id', $request->track_id)
            ->where('master_technical_skill_id', $finalSkillId)
            ->first();

        if (!$jobFamilyskill) {
            $jobSkill = DepartmentTechnicalSkills::create([
                'department_id' => $request->track_id,
                'master_technical_skill_id' => $finalSkillId,
            ]);

            $skill = $jobSkill->masterTechnicalSkill;
            $skillName =$skill->name;
            $skillId =$skill->id;

            $data = [
                'success' => true,
                'skill_id'=>$skillId,
                'message' => 'The technical skill <b>' . $skillName . '</b> level created successfully'
            ];
        } else {
            $skill = $jobFamilyskill->masterTechnicalSkill;
            // dd($skill->name);
            $skillName =$skill->name;
            $skillId =$skill->id ?? '';
            $jobFamily = $jobFamilyskill->department;


            $data = [
                'success' => false,
                'skill_id'=>$skillId,
                'message' => 'The selected technical skill <b>' . $skillName . '</b> already exists in <b>' . $jobFamily->name . '</b>.'
            ];
        }

        return response()->json($data);
    }




private function getJobPositionsForHierarchyItem($item, $jobPositionsCollection)
{
    $relevantJobs = collect();
    
    foreach ($jobPositionsCollection as $job) {
        $belongsToHierarchy = false;
        
        switch ($item['type']) {
            case 'department':
                $belongsToHierarchy = ($job->department_id == $item['id']);
                break;
                
            case 'division':
                $deptDivision = DB::table('departments')
                    ->where('id', $job->department_id)
                    ->value('division_id');
                $belongsToHierarchy = ($deptDivision == $item['id']);
                break;
                
            case 'business_unit':
                $deptBU = DB::table('departments as d')
                    ->join('divisions as div', 'd.division_id', '=', 'div.id')
                    ->where('d.id', $job->department_id)
                    ->value('div.business_unit_id');
                $belongsToHierarchy = ($deptBU == $item['id']);
                break;
        }
        
        if ($belongsToHierarchy) {
            $relevantJobs->push([
                'id' => $job->id,
                'title' => $job->title
            ]);
        }
    }
    
    return $relevantJobs;
}

private function determineHierarchicalStructure($businessUnitIds, $companyIds, $departmentIds)
{
    $structure = [];
    
    // Get all selected business units
    $allBusinessUnits = !empty($businessUnitIds) ? $businessUnitIds : [];
    
    // If we have divisions selected, add their business units to the list
    if (!empty($companyIds)) {
        $divisionBUs = DB::table('divisions')
            ->whereIn('id', $companyIds)
            ->pluck('business_unit_id')
            ->toArray();
        $allBusinessUnits = array_unique(array_merge($allBusinessUnits, $divisionBUs));
    }
    
    // If we have departments selected, add their business units to the list
    if (!empty($departmentIds)) {
        $departmentBUs = DB::table('departments as d')
            ->join('divisions as div', 'd.division_id', '=', 'div.id')
            ->whereIn('d.id', $departmentIds)
            ->pluck('div.business_unit_id')
            ->toArray();
        $allBusinessUnits = array_unique(array_merge($allBusinessUnits, $departmentBUs));
    }
    
    // For each business unit, determine the lowest level selected
    foreach ($allBusinessUnits as $buId) {
        $lowestLevel = $this->getLowestLevelForBU($buId, $businessUnitIds, $companyIds, $departmentIds);
        
        if (!empty($lowestLevel)) {
            $structure = array_merge($structure, $lowestLevel);
        }
    }
    
    return $structure;
}

private function getLowestLevelForBU($businessUnitId, $businessUnitIds, $companyIds, $departmentIds)
{
    $items = [];
    
    // Check if any departments are selected for this BU
    if (!empty($departmentIds)) {
        $departments = DB::table('departments as d')
            ->join('divisions as div', 'd.division_id', '=', 'div.id')
            ->join('business_units as bu', 'div.business_unit_id', '=', 'bu.id')
            ->where('div.business_unit_id', $businessUnitId)
            ->whereIn('d.id', $departmentIds)
            ->select('d.id', 'd.name', 'div.head_of_division as division_name', 'bu.name as business_unit_name')
            ->get();
            
        if ($departments->isNotEmpty()) {
            // Departments are the lowest level for this BU
            foreach ($departments as $dept) {
                $displayName = trim($dept->business_unit_name . ' → ' . $dept->division_name . ' → ' . $dept->name);
                
                $items[] = [
                    'id' => $dept->id,
                    'type' => 'department',
                    'display_name' => $displayName,
                    'raw_name' => $dept->name
                ];
            }
            return $items;
        }
    }
    
    // Check if any divisions are selected for this BU
    if (!empty($companyIds)) {
        $divisions = DB::table('divisions as div')
            ->join('business_units as bu', 'div.business_unit_id', '=', 'bu.id')
            ->where('div.business_unit_id', $businessUnitId)
            ->whereIn('div.id', $companyIds)
            ->select('div.id', 'div.head_of_division', 'bu.name as business_unit_name')
            ->get();
            
        if ($divisions->isNotEmpty()) {
            // Divisions are the lowest level for this BU
            foreach ($divisions as $division) {
                $displayName = $division->business_unit_name . ' → ' . $division->head_of_division;
                
                $items[] = [
                    'id' => $division->id,
                    'type' => 'division',
                    'display_name' => $displayName,
                    'raw_name' => $division->head_of_division
                ];
            }
            return $items;
        }
    }
    
    // Check if this BU is directly selected
    if (!empty($businessUnitIds) && in_array($businessUnitId, $businessUnitIds)) {
        $businessUnit = DB::table('business_units')
            ->where('id', $businessUnitId)
            ->select('id', 'name')
            ->first();
            
        if ($businessUnit) {
            $items[] = [
                'id' => $businessUnit->id,
                'type' => 'business_unit',
                'display_name' => $businessUnit->name,
                'raw_name' => $businessUnit->name
            ];
        }
    }
    
    return $items;
}


}
   