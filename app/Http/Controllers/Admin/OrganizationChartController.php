<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\DateFormatHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\EmployeeService;
use App\Services\OrganizationChartService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ApplyOrgChartChangesRequest;
use App\Http\Requests\FilterJobHeadcountRequest;
use App\Http\Resources\JobHeadcountResource;
use App\Models\BusinessUnit;
use App\Models\Department;
use App\Models\Division;
use App\Models\Job;
use App\Models\JobHeadcount;
use App\Models\Team;
use App\Models\OrganisationPosition;
use App\Modules\Headcounts\Services\JobHeadcountService;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\DB;
use App\Services\JobHeadcountValidationService;
use Symfony\Component\VarDumper\VarDumper;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\OrganizationChartImport;
use App\Services\Job\JdJobService;
use App\Models\{JobSkill, JobTechnicalSkills, JobCriticalFunction, JobSubordinate, JobPerformanceExpectation, JobSecondaryScopeOfStudy, Audit, OrgChartVersion, OrgChartChangeLog, MasterTechnicalSkill, JobProfile, DepartmentTechnicalSkills};
use Illuminate\Support\Facades\Date;
use Carbon\Carbon;

class OrganizationChartController extends Controller
{
    protected $organizationChartService, $employeeService, $jobHeadcountService, $validationService;

    public function __construct(OrganizationChartService $organizationChartService, EmployeeService $employeeService, JobHeadcountService $jobHeadcountService, JobHeadcountValidationService $validationService)
    {
        $this->organizationChartService = $organizationChartService;
        $this->employeeService = $employeeService;
        $this->jobHeadcountService = $jobHeadcountService;
        $this->validationService = $validationService;
    }

    public function index()
    {
        $chartCreated = OrgChartVersion::orderBy('created_at', 'asc')->first('created_at');
        $chartUpdated = OrgChartVersion::orderBy('created_at', 'desc')->first('updated_at');

        $createdFormattedDate = DateFormatHelper::formatDate($chartCreated->created_at ?? '');
        $updatedFormattedDate = DateFormatHelper::formatDate($chartUpdated->updated_at ?? '');

        $topPosition = Job::with(['headcounts'])->where('is_top',1)->first();

        $topPositionCode = null;

        if ($topPosition) {
            if ($topPosition->headcounts && $topPosition->headcounts->count() > 0) {
                $headcount = $topPosition->headcounts[0];
                if ($headcount) {
                    $topPositionCode = $headcount->headcount_code;
                }
            }
        }
        
        return view('admin.organization-structure.main', compact('createdFormattedDate', 'updatedFormattedDate','topPositionCode'));

    }

    // Method to get paginated organization chart data
    public function getHierarchyData(Request $request)
    {
        // Retrieve the page number from the request (defaults to 1)
        $page = $request->input('page', 1);

        // Optional: Get additional filters from the request (department, position, etc.)
        $filters = $request->only(['department_id', 'job_position', 'user_id']);

        // Fetch paginated data from the service
        $data = $this->organizationChartService->getHierarchyData($filters, $page);

        return response()->json($data);
    }

    public function fetchProfile($id)
    {
        // try {
            $data = $this->employeeService->getEmployeeProfile($id);
            return response()->json($data);
        // } catch (\Exception $e) {
        //     return response()->json(['error' => $e], 500);
        // }
    }

    public function getPositionActions($code)
    {
        try {
            $data = $this->organizationChartService->getPositionActions($code);
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to load actions.'], 500);
        }
    }

    public function apply(ApplyOrgChartChangesRequest $request): JsonResponse
    {
        $payload = $request->validated();

        // Debugbar::addMessage($payload);

        $changes = json_decode($request->changes); // assuming 'changes' is passed in the request
        // Step 1: Validate updates
        $errors = $this->validationService->validateUpdates($changes->updates);
        if (!empty($errors)) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $errors
            ], 422);
        }


        $this->organizationChartService->applyChanges(
            $payload['old'],
            $payload['new'],
            $payload['changes'],
            auth()->user()->id
        );

        return response()->json([
            'status'  => 'success',
            'message' => 'Org-chart changes applied and logged.',
        ]);
    }

    public function searchUsers(Request $request)
    {
        $validated = $request->validate([
            'query'  => 'nullable|string|max:255',
            'exclueEmployeesList' => 'nullable'
        ]);

        $users = $this->organizationChartService->searchUsers($validated);

        return response()->json([
            'success' => true,
            'results' => $users,
        ]);
    }

    public function searchDepartments(Request $request)
    {

        $validated = $request->validate([
            'query'  => 'nullable|string|max:255'
        ]);

        $users = $this->organizationChartService->searchDepartments($validated);

        return response()->json([
            'success' => true,
            'results' => $users,
        ]);
    }

    public function getJobHeadcountsByDepartment(Request $request)
    {
        $request->validate([
            'department' => 'required|string',
        ]);

        $department = $request->input('department');

        $jobs = DB::table('job_headcounts as jh')
            ->join('jobs as j', 'jh.job_id', '=', 'j.id')
            ->where('jh.department_id', $department)
            ->whereNull('jh.user_id')
            ->whereNull('jh.deleted_at')
            ->select(
                'jh.headcount_code',
                DB::raw("CONCAT(j.title, ' (', jh.headcount_code, ')') as label")
            )
            ->pluck('label', 'headcount_code')->toArray();

        return response()->json($jobs);
    }

    // public function filter(FilterJobHeadcountRequest $request)
    // {
    //     $data = $this->jobHeadcountService->filter($request);
    //     return JobHeadcountResource::collection($data);
    // }



    public function getBusinessUnit(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $perPage = (int) $request->query('per_page', 100);

        $paginator = \App\Models\BusinessUnit::query()
            ->select('id', 'name')
            ->when($q !== '', fn($sql) => $sql->where('name', 'like', "%{$q}%"))
            ->orderBy('name')
            ->paginate($perPage);

        // Ensure { data: [{id,name}], meta: {current_page,last_page,...} }
        $paginator->setCollection(
            $paginator->getCollection()->transform(fn($r) => ['id' => (int)$r->id, 'name' => $r->name])
        );

        return response()->json($paginator);
    }




    // Fetch Company/Division from the database
    public function getCompanyDivision(\Illuminate\Http\Request $request)
    {
        // Search term can come as ?q=, ?query=, or JSON body { q: "" }
        $q = (string) ($request->input('q', $request->query('q', $request->query('query', ''))));

        // BU IDs can come as query string bu_ids[]= or JSON body { bu_ids: [] }
        $buIds = collect($request->input('bu_ids', $request->query('bu_ids', [])))
            ->filter(fn ($v) => is_numeric($v))
            ->map(fn ($v) => (int) $v)
            ->values()
            ->all();

        $sql = \App\Models\Division::query()
            ->selectRaw('id, head_of_division as name')
            ->when(!empty($buIds), function ($q2) use ($buIds) {
                // If divisions table has business_unit_id:
                $q2->whereIn('business_unit_id', $buIds);

                // ---- OR (uncomment if many-to-many via relationship) ----
                // $q2->whereHas('businessUnits', fn ($q3) => $q3->whereIn('business_units.id', $buIds));
            })
            ->when($q !== '', fn ($q2) =>
                $q2->where('head_of_division', 'like', '%' . $q . '%')
            )
            ->orderBy('name');

        $rows = $sql->get(); // returns [{id, name}, ...]

        return response()->json($rows);
    }


    // Fetch Departments from the database
    public function getDepartments(Request $request)
    {
        // Accept both query string and JSON body
        $search  = (string) ($request->input('q', $request->query('q', $request->query('query', ''))));

        $companyIds = collect($request->input('company_ids', $request->query('company_ids', [])))
            ->filter(fn ($v) => is_numeric($v))
            ->map(fn ($v) => (int) $v)
            ->values()
            ->all();

        $buIds = collect($request->input('bu_ids', $request->query('bu_ids', [])))
            ->filter(fn ($v) => is_numeric($v))
            ->map(fn ($v) => (int) $v)
            ->values()
            ->all();

        $sql = Department::query()
            // If your column is 'name', keep as-is. If it's 'department_name', alias it:
            // ->selectRaw('id, department_name as name')
            ->selectRaw('id, name')
            ->when(!empty($companyIds), function ($q) use ($companyIds) {
                // ----- One-to-many (FK on departments) -----
                $q->whereIn('division_id', $companyIds);

                // ----- OR many-to-many via relation (uncomment and remove the line above) -----
                // $q->whereHas('companies', fn($qq) => $qq->whereIn('companies.id', $companyIds));
            })
            ->when($search !== '', function ($q) use ($search) {
                // If you aliased department_name as name above, this still works
                $q->where('name', 'like', '%' . $search . '%');
                // Or, if using department_name column directly:
                // $q->where('department_name', 'like', '%' . $search . '%');
            })
            ->orderBy('name');

        $rows = $sql->get(); // -> toArray() not required; Laravel handles it

        return response()->json($rows);
    }

    // Fetch Teams from the database
    public function getTeams(Request $request)
    {
        $query = $request->query('query', '');

        // Fetch Teams that match the query
        $teams = Team::where('name', 'like', "%$query%")
            ->select('id', 'name') // Select both 'id' and 'name'
            ->get(); // Get results as a collection

        return response()->json($teams);
    }

    // Controller method to fetch levels and their counts
    public function getLevels(Request $request)
    {
        // Get levels from config
        $levels = config('constants.LEVELS'); 

        // Example counts for each level (this can be dynamically generated or fetched from the database)
        $levelCounts = [
            1 => 60, // Level 1 count
            2 => 20, // Level 2 count
            3 => 20, // Level 3 count
            4 => 20, // Level 4 count
            5 => 20, // Level 5 count
            6 => 20, // Level 6 count
        ];

        // Format the levels with counts
        $formattedLevels = [];
        foreach ($levels as $key => $level) {
            $formattedLevels[] = [
                'id' => $key,
                'name' => $level,
                'count' => isset($levelCounts[$key]) ? $levelCounts[$key] : 0,
            ];
        }

        return response()->json($formattedLevels);
    }

    // public function migrateExistingData(Request $request)
    // {
    //     ini_set('max_execution_time', -1);
    
    //     $organisationPositions = OrganisationPosition::whereNotNull('job_id')->whereNotNull('user_id')->get();
    
    //     $data = [];
    //     foreach($organisationPositions as $organisationPosition){
    //         $data[$organisationPosition->job_id][] = $organisationPosition;
    //     }
    //     dd($data);

    //     foreach ($data as $jobId => $positions) {
    //         \Log::info("Migrating Job ID: " . $jobId);
    //         $job = '';
    //         if ($jobId != 4790) {
    //             $job = Job::find($jobId);
    //         }

            
     
    //         if (!$job) {
    //             continue;
    //         }

    //         // $job->sector_id = $job->department_id;
    //         // $job->department_id = $job->org_department;
    
    //         $jobProfile = JobProfile::updateorCreate(
    //             ['aa_job_profile_id' => $job->position_code],
    //             [
    //             'aa_job_profile_id' => $job->position_code,
    //             'name' => $job->title,
    //             'description' => $job->description,
    //             'department_id' => $job->department_id,
    //         ]);

    //         $job->job_profile_id = $jobProfile->id;

    //         $job->save();
            
    //         // foreach ($job->jdTechSkills as $jobTechnicalSkill) 
    //         // {
    //         //     if ($jobTechnicalSkill->master_technical_skill_id) {
    //         //         $masterTechnicalSkill = MasterTechnicalSkill::find($jobTechnicalSkill->master_technical_skill_id);
                     
    //         //         // Check if the skill already exists
    //         //         // $checkMasterTechnicalSkill = MasterTechnicalSkill::where('name', $masterTechnicalSkill->name)
    //         //         //     ->whereIn('is_custom', [1, 2])
    //         //         //     ->where('category_id', $masterTechnicalSkill->category_id)
    //         //         //     ->first();
                    
    //         //         $departmentTechnicalSkill = DepartmentTechnicalSkills::updateorCreate(
    //         //             [
    //         //                 'master_technical_skill_id' => $jobTechnicalSkill->id,
    //         //                 'department_id' => $job->department_id
    //         //             ],
    //         //             [
    //         //                 'master_technical_skill_id' => $jobTechnicalSkill->id,
    //         //                 'department_id' => $job->department_id,
    //         //                 'created_at' => Carbon::now(),
    //         //                 'updated_at' => Carbon::now(),
    //         //         ]);
    
    //         //         // if ($checkMasterTechnicalSkill) {
    //         //         //     // Skill exists – update the existing one
    //         //         //     $checkMasterTechnicalSkill->type = 1;
    //         //         //     $checkMasterTechnicalSkill->is_custom = 2;
    //         //         //     $checkMasterTechnicalSkill->save();
    
    //         //         //     $departmentTechnicalSkill = DepartmentTechnicalSkills::updateorCreate(
    //         //         //         [
    //         //         //             'master_technical_skill_id' => $checkMasterTechnicalSkill->id,
    //         //         //             'department_id' => $job->department_id
    //         //         //         ],
    //         //         //         [
    //         //         //             'master_technical_skill_id' => $checkMasterTechnicalSkill->id,
    //         //         //             'department_id' => $job->department_id,
    //         //         //             'created_at' => Carbon::now(),
    //         //         //             'updated_at' => Carbon::now(),
    //         //         //     ]);
    //         //         //     $jobTechnicalSkill->master_technical_skill_id = $checkMasterTechnicalSkill->id;
    //         //         //     $jobTechnicalSkill->save();
    //         //         // } 
    //         //         // else {
    //         //         //     // Skill doesn't exist – duplicate the original and update fields
    //         //         //     $newSkill = $masterTechnicalSkill->replicate();
    //         //         //     $newSkill->type = 1;
    //         //         //     $newSkill->is_custom = 2;
    //         //         //     $newSkill->save();
    
    //         //         //     $departmentTechnicalSkill = DepartmentTechnicalSkills::updateorCreate(
    //         //         //         [
    //         //         //             'master_technical_skill_id' => $newSkill->id,
    //         //         //             'department_id' => $job->department_id
    //         //         //         ],
    //         //         //         [
    //         //         //             'master_technical_skill_id' => $newSkill->id,
    //         //         //             'department_id' => $job->department_id,
    //         //         //             'created_at' => Carbon::now(),
    //         //         //             'updated_at' => Carbon::now(),
    //         //         //     ]);
    
    //         //         //     $jobTechnicalSkill->master_technical_skill_id = $newSkill->id;
    //         //         //     $jobTechnicalSkill->save();
    //         //         // }
    
    //         //     }
    //         // }

    //         $headCountNumber = 1;
    
    //         foreach ($positions as $organisationPosition) {
    //             $formattedHeadCountNumber = str_pad($headCountNumber, 2, '0', STR_PAD_LEFT);

    //             if ($organisationPosition->parent_id) {
    //                 $parent_id = $organisationPosition->parent_id + 1;
    //             } else {
    //                 $parent_id = 1;
    //             }
    
    //             $user = User::find($organisationPosition->user_id);
    //             $parent = JobHeadcount::find($parent_id);
    //             $headCountCode = $job->position_code . '-' . $job->id . '-' . $formattedHeadCountNumber;
    //             if (($user) && ($parent)){
    //                 JobHeadcount::updateOrCreate(
    //                     [
    //                        'id' => $organisationPosition->id + 1,
    //                     ],
    //                     [
    //                     'id' => $organisationPosition->id + 1,
    //                     'job_id' => $organisationPosition->job_id,
    //                     'user_id' => $organisationPosition->user_id,
    //                     'parent_id' => $parent_id,
    //                     'department_id' => $organisationPosition->department_id,
    //                     'headcount_number' => $formattedHeadCountNumber,
    //                     'headcount_code' => $headCountCode,
    //                     'orgMetadata' => [
    //                                 'action' => 'migrated_position',
    //                                 'reason' => "",
    //                                 'node' => ['data'=>['code'=>$headCountCode]],
    //                                 'source'=>"Job Migration",
    //                     ]
    //                 ]);
        
    //                 $headCountNumber++;
    //             }
                
    //         }
    //     }
    
    //     return response()->json(['message' => 'Migration completed successfully']);
    // }
    public function migrateExistingData(Request $request)
    {
        ini_set('max_execution_time', -1);

        // Step 1: Fix invalid parent_id references before migration
        // $this->fixInvalidParentIds();

        $organisationPositions = OrganisationPosition::whereNotNull('job_id')
            ->whereNotNull('user_id')
            ->get();
        
        $data = [];
        foreach($organisationPositions as $organisationPosition){
            $data[$organisationPosition->job_id][] = $organisationPosition;         
        }
        
        foreach ($data as $jobId => $positions) {
            \Log::info("Migrating Job ID: " . $jobId);
            
            if ($jobId == 4790) {
                continue;
            }
            
            $job = Job::find($jobId);
            
            if (!$job) {
                continue;
            }

            $jobProfile = JobProfile::updateOrCreate(
                ['aa_job_profile_id' => $job->position_code],
                [
                    'aa_job_profile_id' => $job->position_code,
                    'name' => $job->title,
                    'description' => $job->description,
                    'department_id' => $job->department_id,
                ]
            );

            $job->job_profile_id = $jobProfile->id;
            $job->save();

            $headCountNumber = 1;
            $parentIdMap = []; // Track old parent_id to new parent_id mapping

            foreach ($positions as $organisationPosition) {
                $formattedHeadCountNumber = str_pad($headCountNumber, 2, '0', STR_PAD_LEFT);

                // Calculate parent_id for new structure
                if ($organisationPosition->parent_id) {
                    $parent_id = $organisationPosition->parent_id;
                    
                    // Check if parent exists in job_headcounts table
                    $parentExists = JobHeadcount::find($parent_id);
                    
                    if (!$parentExists) {
                        // Check if we've already created a mapped parent
                        if (isset($parentIdMap[$parent_id])) {
                            $parent_id = $parentIdMap[$parent_id];
                        } else {
                            // Create parent record first
                            $parentOrgPosition = OrganisationPosition::find($parent_id);
                            
                            if ($parentOrgPosition && $parentOrgPosition->user_id) {
                                $parentUser = User::find($parentOrgPosition->user_id);
                                $parentFormattedNumber = str_pad($headCountNumber, 2, '0', STR_PAD_LEFT);
                                $parentHeadCountCode = $job->position_code . '-' . $job->id . '-' . $parentFormattedNumber;
                                
                                if ($parentUser) {
                                    $newParent = JobHeadcount::create([
                                        'job_id' => $parentOrgPosition->job_id,
                                        'user_id' => $parentOrgPosition->user_id,
                                        'parent_id' => 1, // Root parent
                                        'department_id' => $parentOrgPosition->department_id,
                                        'headcount_number' => $parentFormattedNumber,
                                        'headcount_code' => $parentHeadCountCode,
                                        'orgMetadata' => [
                                            'action' => 'migrated_position_parent',
                                            'reason' => "Auto-created parent",
                                            'node' => ['data'=>['code'=>$parentHeadCountCode]],
                                            'source'=>"Job Migration",
                                        ]
                                    ]);
                                    
                                    $parentIdMap[$parent_id] = $newParent->id;
                                    $parent_id = $newParent->id;
                                    $headCountNumber++;
                                } else {
                                    $parent_id = 1; // Fallback to root
                                }
                            } else {
                                $parent_id = 1; // Fallback to root
                            }
                        }
                    }
                } else {
                    $parent_id = 1;
                }

                $user = User::find($organisationPosition->user_id);
                $headCountCode = $job->position_code . '-' . $job->id . '-' . $formattedHeadCountNumber;
                
                if ($user && $parent_id) {
                    JobHeadcount::updateOrCreate(
                        ['id' => $organisationPosition->id],
                        [
                            'id' => $organisationPosition->id,
                            'job_id' => $organisationPosition->job_id,
                            'user_id' => $organisationPosition->user_id,
                            'parent_id' => $parent_id,
                            'department_id' => $organisationPosition->department_id,
                            'headcount_number' => $formattedHeadCountNumber,
                            'headcount_code' => $headCountCode,
                            'orgMetadata' => [
                                'action' => 'migrated_position',
                                'reason' => "",
                                'node' => ['data'=>['code'=>$headCountCode]],
                                'source'=>"Job Migration",
                            ]
                        ]
                    );
        
                    $headCountNumber++;
                }
            }
        }

        return response()->json(['message' => 'Migration completed successfully']);
    }

    /**
     * Fix invalid parent_id references in organisation_position table
     */
    private function fixInvalidParentIds()
    {
        \Log::info("Starting parent_id validation and fix...");
        
        // Get all positions with job_id and parent_id not null
        $positions = OrganisationPosition::whereNotNull('job_id')
            ->whereNotNull('parent_id')
            ->get();

        $fixedCount = 0;

        foreach ($positions as $position) {
            // Check if parent_id exists in organisation_position.id
            $parentExists = OrganisationPosition::where('id', $position->parent_id)->exists();

            if (!$parentExists) {
                \Log::warning("Invalid parent_id {$position->parent_id} for position ID {$position->id}");

                // Find other positions with the same job_id
                $siblingsWithSameJob = OrganisationPosition::where('job_id', $position->job_id)
                    ->where('id', '!=', $position->id)
                    ->get();

                if ($siblingsWithSameJob->count() > 0) {
                    // Try to find a valid parent from siblings
                    $validParent = null;

                    foreach ($siblingsWithSameJob as $sibling) {
                        if ($sibling->parent_id) {
                            // Check if sibling's parent_id exists
                            $siblingParentExists = OrganisationPosition::where('id', $sibling->parent_id)->exists();
                            
                            if ($siblingParentExists) {
                                $validParent = $sibling->parent_id;
                                break;
                            }
                        }
                    }

                    if ($validParent) {
                        // Update with valid parent found from siblings
                        $position->parent_id = $validParent;
                        $position->save();
                        $fixedCount++;
                        \Log::info("Fixed position ID {$position->id}: set parent_id to {$validParent}");
                    } else {
                        // No valid parent found, set to null or find root position
                        $rootPosition = OrganisationPosition::where('job_id', $position->job_id)
                            ->whereNull('parent_id')
                            ->first();

                        if ($rootPosition) {
                            $position->parent_id = $rootPosition->id;
                            $position->save();
                            $fixedCount++;
                            \Log::info("Fixed position ID {$position->id}: set parent_id to root position {$rootPosition->id}");
                        } else {
                            // Set to null if no root found
                            $position->parent_id = null;
                            $position->save();
                            $fixedCount++;
                            \Log::info("Fixed position ID {$position->id}: set parent_id to NULL (no valid parent found)");
                        }
                    }
                } else {
                    // Only one position with this job_id, set parent_id to null
                    $position->parent_id = null;
                    $position->save();
                    $fixedCount++;
                    \Log::info("Fixed position ID {$position->id}: set parent_id to NULL (single position for job)");
                }
            }
        }

        \Log::info("Parent_id fix completed. Fixed {$fixedCount} records.");
    }

    public function migrateTechnicalSkills()
    {
        ini_set('max_execution_time', -1);
 
        $masterTechnicalSkills = MasterTechnicalSkill::where('is_custom', 0)->get();

        foreach ($masterTechnicalSkills as $masterTechnicalSkill) {
            $customMasterTechnicalSkill = MasterTechnicalSkill::where('sector_id', $masterTechnicalSkill->sector_id)
                ->where('category_id', $masterTechnicalSkill->category_id)
                ->where('name', $masterTechnicalSkill->name)
                ->whereIn('is_custom', [1, 2])
                ->first();
            
            // Check if a matching custom master technical skill exists
            if ($customMasterTechnicalSkill) {
                // Update job technical skills if a match is found
                JobTechnicalSkills::where('master_technical_skill_id', $masterTechnicalSkill->id)
                    ->update([
                        'master_technical_skill_id' => $customMasterTechnicalSkill->id
                    ]);
            }
        }
        dd('done');
    }
    
    

    public function import(Request $request) {
        return view('admin.organization-structure.import');
    }

    public function importData(Request $request, JdJobService $jdJobService) {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);
        session()->forget(['import_errors', 'import_error_map']);
    
        try {
            $jdJobService = app(\App\Services\Job\JdJobService::class);
            $import = new OrganizationChartImport($jdJobService);
    
            ini_set('memory_limit', '-1'); // Or '-1' for unlimited
            set_time_limit(0);
            // gc_enable();
    
            Excel::import($import, $request->file('file'));
    
            // gc_collect_cycles();
    
            if ($import->hasErrors()) {
                return $import->exportErrorsToExcel();
            }
    
            // ini_set('memory_limit', '128M');
            // set_time_limit(30);
            return back()->with('success', 'Import completed successfully.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    

    public function deleteData(Request $request)
    {
        // Get all job_ids from JobHeadCount before deleting
        $jobHeadCountJobIds = JobHeadCount::pluck('job_id')->toArray();

        // Delete all rows (not static)
        JobHeadCount::query()->delete();

        // Get job_ids of non-primary jobs
        $nonPrimaryJobIds = Job::where('is_primary', 0)->pluck('id');

        // Delete jobs and their related data
        Job::whereIn('id', $nonPrimaryJobIds)->delete();
        JobSkill::whereIn('job_id', $nonPrimaryJobIds)->delete();
        JobTechnicalSkills::whereIn('job_id', $nonPrimaryJobIds)->delete();
        JobCriticalFunction::whereIn('job_id', $nonPrimaryJobIds)->delete();
        JobSubordinate::whereIn('job_id', $nonPrimaryJobIds)->delete();
        JobPerformanceExpectation::whereIn('job_id', $nonPrimaryJobIds)->delete();
        JobSecondaryScopeOfStudy::whereIn('job_id', $nonPrimaryJobIds)->delete();
        MasterTechnicalSkill::whereIn('is_custom', [1,2])->delete();
        JobProfile::query()->delete();

        // Nullify related users
        User::whereIn('position_id', $nonPrimaryJobIds)->update([
            'position_id' => null
        ]);
        User::whereIn('position_id', $nonPrimaryJobIds)->delete();
        // Delete all rows from these tables using query()
        DB::table('audits')->delete();
        OrgChartVersion::query()->delete();
        OrgChartChangeLog::query()->delete();

        // Debug output
        dd("Done");
    }

    public function updateSuperiorData() {

        $jobHeadCounts = JobHeadCount::whereNotNull('parent_id')->get();

        foreach ($jobHeadCounts as $jobHeadCount) {
            $parentJhc= JobHeadCount::find($jobHeadCount->parent_id);
            $jobToUpdateSuperiorId = Job::find($jobHeadCount->job_id);
            $jobToUpdateSuperiorId->superior_id = $parentJhc->job_id;
            $jobToUpdateSuperiorId->save();
        }
        dd('Done');
    }

    private function createVacantJobHeadCount()
    {
        $jobs = Job::where('saved_job', 1)->where('job_type', 'ai_gen')->get();

        foreach ($jobs as $job) {
            $existingHeadCounts = JobHeadCount::where('job_id', $job->id)->get();
            $existingCodes = $existingHeadCounts->pluck('headcount_code')->all();
            $existingCount = count($existingHeadCounts);
            $remaining = $job->heads - $existingCount;

            if ($remaining <= 0) {
                continue;
            }

            $parentId = optional($existingHeadCounts->first())->parent_id;

            for ($i = $remaining; $i >= 1; $i--) {
                $number = str_pad($existingCount + $i, 2, '0', STR_PAD_LEFT);
                $headCountCode = "{$job->position_code}-{$job->id}-{$number}";

                JobHeadCount::updateOrCreate(
                    ['headcount_code' => $headCountCode],
                    [
                        'job_id' => $job->id,
                        'parent_id' => $parentId,
                        'department_id' => $job->department_id,
                        'headcount_number' => $number,
                        'headcount_code' => $headCountCode,
                        'orgMetadata' => [
                            'action' => 'add_position',
                            'reason' => '',
                            'node' => ['data' => ['code' => $headCountCode]],
                            'source' => 'After Bulk Import',
                        ],
                    ]
                );
            }
        }
    }


    public function getEmployeeCountByJobId($jobId)
    {
        $result = $this->organizationChartService->getEmployeeCountByJobId($jobId);

        if (!$result) {
            return response()->json(['message' => 'Job not found.'], 404);
        }

        return response()->json($result);
    }

    public function buildFilter(Request $request)
    {

        $result = $this->organizationChartService->buildFilter($request->filters);

        return response()->json($result);
        
    }

    private function getHeaderText($buIds = [], $divisionIds = [], $departmentIds = [], $levels = [])
    {
        $headerParts = [];
        
        // Business Unit names
        if (!empty($buIds)) {
            $businessUnits = BusinessUnit::whereIn('id', $buIds)->pluck('name')->toArray();
            $headerParts = array_merge($headerParts, $businessUnits);
        }
        
        // Division names (Company/Division format)
        if (!empty($divisionIds)) {
            $headerParts = [];
            $divisions = Division::whereIn('id', $divisionIds)
                ->with('business_unit')
                ->get()
                ->map(function($division) {
                    return $division->head_of_division;
                    // return $division->head_of_division . '->' . $division->business_unit->name;
                })
                ->toArray();
            $headerParts = array_merge($headerParts, $divisions);
        }
        
        // // Department names
        // if (!empty($departmentIds)) {
        //     $headerParts = [];
        //     $departments = Department::whereIn('id', $departmentIds)->pluck('name')->toArray();
        //     $headerParts = array_merge($headerParts, $departments);
        // }

        if (!empty($departmentIds)) {
            $headerParts = [];
            $departments = Department::whereIn('id', $departmentIds)
                ->with(['division']) // Assuming departments also have business_unit relationship
                ->get()
                ->map(function($department) {
                    // return $department->name . '->' .$department->division->head_of_division. '->' .$department->division->business_unit->name;
                    return $department->name;

                })
                ->toArray();
            $headerParts = array_merge($headerParts, $departments);
        }
        
        
        // Return appropriate header text
        if (empty($headerParts)) {
            return 'Entire Organization';
        }
        
        // Smart truncation - show complete names until we hit the limit
        $maxLength = 5000; // Adjust as needed
        $result = [];
        $currentLength = 0;
        
        foreach ($headerParts as $index => $part) {
            $partWithComma = ($index > 0 ? ', ' : '') . $part;
            
            if ($currentLength + strlen($partWithComma) <= $maxLength) {
                $result[] = $part;
                $currentLength += strlen($partWithComma);
            } else {
                // If we can't fit this part, add ellipsis
                if (!empty($result)) {
                    break;
                } else {
                    // If even the first part is too long, truncate it
                    $truncatedPart = substr($part, 0, $maxLength - 3) . '...';
                    $result[] = $truncatedPart;
                    break;
                }
            }
        }
        
        
        // Add ellipsis if there are more parts that didn't fit
        $headerText = implode(', ', $result);
        // if (count($result) < count($headerParts)) {
        //     $headerText .= '...';
        // }
        
        return $headerText;
    }

    public function headcountCodes(Request $request)
    {
        $data = $request->validate([
            'business_unit_ids' => 'array',
            'business_unit_ids.*' => 'integer',
            'company_ids' => 'array',
            'company_ids.*' => 'integer',
            'department_ids' => 'array',
            'department_ids.*' => 'integer',
            'position_levels' => 'array',
            'position_levels.*' => 'string',
            'user_id' => 'nullable|integer',
            'vacancy_status' => 'nullable|string',
            'assessment_filters' => 'nullable|array',
        ]);

        $buIds = $data['business_unit_ids'] ?? [];
        $divisionIds = $data['company_ids'] ?? [];
        $departmentIds = $data['department_ids'] ?? [];
        $levels = $data['position_levels'] ?? [];
        $userId = $data['user_id'] ?? null;
        $isVacant = $data['vacancy_status'] ?? '';
        $assessmentFilters = $data['assessment_filters'] ?? [];
        $codes = [];

        // Load assessment config
        $assessmentConfig = config('assessment_results_type');
        
        
        $assessmentTypeIds = [];
        $assessmentLevelIds = [];
        $assessmentLevelLabels = [];
        $assessmentDetails = [];
        
        foreach ($assessmentFilters as $filter) {
            $typeId = $filter['type']['id'] ?? null;
            $levelId = $filter['level']['id'] ?? null;
            
            if ($typeId && $levelId) {
                $assessmentTypeIds[] = $typeId;
                $assessmentLevelIds[] = $levelId;
                
                if (isset($filter['level']['label'])) {
                    $assessmentLevelLabels[] = $filter['level']['label'];
                }
                
                // Get assessmentType and metric from config based on result_type (which is the type.id)
                if (isset($assessmentConfig['result_type'][$typeId]) && isset($assessmentConfig['leves_type'][$levelId])) {
                    $levelConfig = $assessmentConfig['leves_type'][$levelId];
                    
                    // Get the appropriate value - check conditionalValues first for assessmentId 8
                    $levelValue = $levelConfig['value']; // Default value
                    if ($typeId == 8 && isset($levelConfig['conditionalValues'][$typeId])) {
                        $levelValue = $levelConfig['conditionalValues'][$typeId];
                    }
                    
                    $assessmentDetails[] = [
                        'type_id' => $typeId,
                        'type_label' => $filter['type']['label'] ?? null,
                        'assessmentType' => $assessmentConfig['result_type'][$typeId]['assessmentType'],
                        'metric' => $assessmentConfig['result_type'][$typeId]['metric'],
                        'level_id' => $levelId,
                        'level_label' => $filter['level']['label'] ?? null,
                        'level_value' => $levelValue
                    ];
                }
            }
        }

        // Remove duplicates
        $assessmentTypeIds = array_unique($assessmentTypeIds);
        $assessmentLevelIds = array_unique($assessmentLevelIds);
        $assessmentLevelLabels = array_unique($assessmentLevelLabels);

        // Maintain your original condition
        if (!empty($buIds) || !empty($divisionIds) || !empty($departmentIds) || $isVacant !== '' || !empty($levels) || !empty($assessmentDetails)) {
            $q = JobHeadcount::query()
                ->select('job_headcounts.headcount_code', 'job_headcounts.user_id')
                ->join('jobs as j', 'j.id', '=', 'job_headcounts.job_id')
                ->whereNotNull('job_headcounts.headcount_code');

            // Apply basic filters
            if (!empty($buIds)) {
                $q->whereIn('j.business_unit_id', $buIds);
            }
            if (!empty($divisionIds)) {
                $q->whereIn('j.division_id', $divisionIds);
            }
            if (!empty($departmentIds)) {
                $q->whereIn('j.department_id', $departmentIds);
            }
            if ($isVacant == 'filled') {
                $q->whereNotNull('job_headcounts.user_id');
            } elseif ($isVacant == 'vacant') {
                $q->whereNull('job_headcounts.user_id');
            }
            if (!empty($levels)) {
                $q->whereIn('j.level', $levels);
            }

            $headcountData = $q->distinct()->get();
            
            // Determine final codes based on assessment filters
            if (!empty($assessmentDetails)) {
                if ($headcountData->isEmpty()) {
                    $codes = [];
                } else {
                    $assessmentMatches = $this->checkAssessmentMatches($headcountData, $assessmentDetails);
                    $codes = empty($assessmentMatches) 
                        ? [] 
                        : $headcountData->whereIn('user_id', $assessmentMatches)->pluck('headcount_code')->values()->toArray();
                }
            } else {
                // No assessment filters - return all filtered headcounts
                $codes = $headcountData->pluck('headcount_code')->values()->toArray();
            }
        }

        // Handle user search
        if ($userId) {
            $q2 = JobHeadcount::where('user_id', $userId)->first();
            if ($q2 && $q2->headcount_code) {
                if (!in_array($q2->headcount_code, $codes)) {
                    array_push($codes, $q2->headcount_code);
                }
            }
        }

        $organizationData = $this->getOrganizationData($buIds, $divisionIds, $departmentIds, $isVacant, $levels);
        
        // Get available position levels
        $positionLevels = $this->getAvailablePositionLevels($buIds, $divisionIds, $departmentIds, $isVacant);
        
        return response()->json([
            'headcount_codes' => $codes,
            'count' => count($codes),
            'organizationData' => $organizationData,
            'positionLevels' => $positionLevels,
            'assessment_filters' => [
                'type_ids' => $assessmentTypeIds,
                'level_ids' => $assessmentLevelIds,
                'level_labels' => $assessmentLevelLabels,
                'assessment_details' => $assessmentDetails
            ],
            'assessment_matches' => $assessmentMatches ?? []
        ]);
    }


    private function checkAssessmentMatches($headcountData, $assessmentDetails)
    {
        // Get user IDs from filtered headcounts (only those with user_id)
        $userIds = $headcountData->whereNotNull('user_id')->pluck('user_id')->unique()->values()->toArray();
        
        if (empty($userIds) || empty($assessmentDetails)) {
            return [];
        }
        
        // Build conditions and bindings for the query
        $conditions = [];
        $bindings = [];
        
        foreach ($assessmentDetails as $detail) {
            $conditions[] = "(result_type = ? AND assessment_type = ? AND level = ?)";
            $bindings[] = $detail['metric'];
            $bindings[] = $detail['assessmentType'];
            $bindings[] = $detail['level_value'];
        }
        
        $totalCriteria = count($assessmentDetails);
        
        // Get users who match ALL criteria using GROUP BY and HAVING
        $matchingUserIds = DB::table('user_results')
            ->whereIn('user_id', $userIds)
            ->whereRaw('(' . implode(' OR ', $conditions) . ')', $bindings)
            ->groupBy('user_id')
            ->havingRaw('COUNT(DISTINCT CONCAT(result_type, "_", assessment_type, "_", level)) = ?', [$totalCriteria])
            ->pluck('user_id')
            ->toArray();
        
        return $matchingUserIds;
    }


private function getAvailablePositionLevels($buIds = [], $divisionIds = [], $departmentIds = [], $isVacant = '')
{
    $query = JobHeadcount::query()
        ->join('jobs as j', 'j.id', '=', 'job_headcounts.job_id')
        ->whereNotNull('j.level');

    // Apply filters
    if (!empty($buIds)) {
        $query->whereIn('j.business_unit_id', $buIds);
    }
    if (!empty($divisionIds)) {
        $query->whereIn('j.division_id', $divisionIds);
    }
    if (!empty($departmentIds)) {
        $query->whereIn('j.department_id', $departmentIds);
    }
    if ($isVacant == 'filled') {
        $query->whereNotNull('job_headcounts.user_id');
    } elseif ($isVacant == 'vacant') {
        $query->whereNull('job_headcounts.user_id');
    }

    // Get actual counts from database
    $results = $query
        ->select('j.level', DB::raw('COUNT(*) as count'))
        ->groupBy('j.level')
        ->get();

    // Convert to associative array
    $levelCounts = [];
    foreach ($results as $result) {
        $levelCounts[(int)$result->level] = (int)$result->count;
    }

    // Get levels from config
    $configLevels = config('levels', []);
    
    // Create levels array using config
    $levels = [];
    foreach ($configLevels as $levelName => $levelNumber) {
        $levels[] = [
            'level' => (int) $levelNumber,
            'name' => $levelName,
            'count' => $levelCounts[$levelNumber] ?? 0
        ];
    }
    
    // Sort by level number to ensure proper order
    usort($levels, function($a, $b) {
        return $a['level'] - $b['level'];
    });

    return collect($levels);
}

public function getPositionLevels(Request $request)
{
    $data = $request->validate([
        'business_unit_ids' => 'array',
        'business_unit_ids.*' => 'integer',
        'company_ids' => 'array',
        'company_ids.*' => 'integer',
        'department_ids' => 'array',
        'department_ids.*' => 'integer',
        'vacancy_status' => 'nullable|string'
    ]);

    $buIds = $data['business_unit_ids'] ?? [];
    $divisionIds = $data['company_ids'] ?? [];
    $departmentIds = $data['department_ids'] ?? [];
    $isVacant = $data['vacancy_status'] ?? '';

    $query = JobHeadcount::query()
        ->join('jobs as j', 'j.id', '=', 'job_headcounts.job_id')
        ->select('j.level', DB::raw('COUNT(*) as total_count'))
        ->whereNotNull('j.level');

    // Apply filters
    if (!empty($buIds)) {
        $query->whereIn('j.business_unit_id', $buIds);
    }
    if (!empty($divisionIds)) {
        $query->whereIn('j.division_id', $divisionIds);
    }
    if (!empty($departmentIds)) {
        $query->whereIn('j.department_id', $departmentIds);
    }
    if ($isVacant == 'filled') {
        $query->whereNotNull('job_headcounts.user_id');
    } elseif ($isVacant == 'vacant') {
        $query->whereNull('job_headcounts.user_id');
    }

    // Get actual counts
    $results = $query->groupBy('j.level')->get();
    $levelCounts = [];
    foreach ($results as $result) {
        $levelCounts[$result->level] = $result->total_count;
    }

    // Get levels from config
    $configLevels = config('levels', []);
    
    // Create levels array using config names
    $levels = [];
    foreach ($configLevels as $levelName => $levelNumber) {
        $levels[] = [
            'level' => (int) $levelNumber,
            'name' => $levelName,
            'count' => $levelCounts[$levelNumber] ?? 0
        ];
    }
    
    // Sort by level number
    usort($levels, function($a, $b) {
        return $a['level'] - $b['level'];
    });

    return response()->json([
        'success' => true,
        'levels' => $levels
    ]);
}


private function getOrganizationData($buIds = [], $divisionIds = [], $departmentIds = [], $isVacant = '', $levels = [])
{
    // Build base query for filtering
    $baseQuery = function() use ($buIds, $divisionIds, $departmentIds, $isVacant, $levels) {
        $q = JobHeadcount::query()
            ->join('jobs as j', 'j.id', '=', 'job_headcounts.job_id');
        
        // Apply filters only if provided
        if (!empty($buIds)) {
            $q->whereIn('j.business_unit_id', $buIds);
        }
        if (!empty($divisionIds)) {
            $q->whereIn('j.division_id', $divisionIds);
        }
        if (!empty($departmentIds)) {
            $q->whereIn('j.department_id', $departmentIds);
        }
        if ($isVacant == 'vacant') {
            $q->whereNull('job_headcounts.user_id');
        } elseif ($isVacant == 'filled') {
            $q->whereNotNull('job_headcounts.user_id');
        }
        // Apply position levels using 'level' column
        if (!empty($levels)) {
            $q->whereIn('j.level', $levels);
        }
        
        return $q;
    };

    // Check if any filters are applied - maintaining your original condition
    $hasFilters = !empty($buIds) || !empty($divisionIds) || !empty($departmentIds) || $isVacant !== '' || !empty($levels);

    $headerText = $this->getHeaderText($buIds, $divisionIds, $departmentIds, $levels);

    if ($hasFilters) {
        // Calculate statistics based on filters
        
        // 1. Count unique departments
        $departmentCount = (clone $baseQuery())
            ->distinct()
            ->count('j.department_id');

        // 2. Count unique job positions
        $jobPositionCount = (clone $baseQuery())
            ->distinct()
            ->count('j.id');

        // 3. Count filled positions (employees)
        $employeeCount = (clone $baseQuery())
            ->whereNotNull('job_headcounts.user_id')
            ->count();

        // 4. Count total positions (headcounts)
        $totalPositions = (clone $baseQuery())->count();

        // 5. Count vacancies
        $vacancyCount = (clone $baseQuery())
            ->whereNull('job_headcounts.user_id')
            ->count();

        // 6. Count critical positions
        $criticalPositionCount = (clone $baseQuery())
            ->where('j.is_critical', true)
            ->whereNull('job_headcounts.user_id')
            ->count();

        // 7. Get top 4 open positions sorted by vacancy count
        $openPositions = (clone $baseQuery())
            ->select(
                'j.id', 
                'j.title', 
                'j.is_critical',
                DB::raw('COUNT(CASE WHEN job_headcounts.user_id IS NULL THEN 1 END) as vacancy_count')
            )
            ->whereNull('job_headcounts.user_id')
            ->groupBy('j.id', 'j.title', 'j.is_critical')
            ->having('vacancy_count', '>', 0)
            ->orderByDesc('vacancy_count')
            ->orderByDesc('j.is_critical')
            ->orderBy('j.title')
            ->limit(4)
            ->get();
            
    } else {
        // No filters - get entire organization data
        
        // 1. Count all unique departments
        $departmentCount = JobHeadcount::join('jobs as j', 'j.id', '=', 'job_headcounts.job_id')
            ->distinct()->count('j.department_id');

        // 2. Count all job positions
        $jobPositionCount = JobHeadcount::distinct()->count('job_id');

        // 3. Count all filled positions
        $employeeCount = JobHeadcount::whereNotNull('user_id')->count();

        // 4. Count total headcount positions
        $totalPositions = JobHeadcount::count();

        // 5. Count all vacancies
        $vacancyCount = JobHeadcount::whereNull('user_id')->count();

        // 6. Count critical vacant positions
        $criticalPositionCount = JobHeadcount::query()
            ->join('jobs as j', 'j.id', '=', 'job_headcounts.job_id')
            ->where('j.is_critical', true)
            ->whereNull('job_headcounts.user_id')
            ->count();

        // 7. Get top 4 open positions sorted by vacancy count
        $openPositions = JobHeadcount::query()
            ->join('jobs as j', 'j.id', '=', 'job_headcounts.job_id')
            ->select(
                'j.id', 
                'j.title', 
                'j.is_critical',
                DB::raw('COUNT(CASE WHEN job_headcounts.user_id IS NULL THEN 1 END) as vacancy_count')
            )
            ->whereNull('job_headcounts.user_id')
            ->groupBy('j.id', 'j.title', 'j.is_critical')
            ->having('vacancy_count', '>', 0)
            ->orderByDesc('vacancy_count')
            ->orderByDesc('j.is_critical')
            ->orderBy('j.title')
            ->limit(4)
            ->get();
    }

    // Check if there are more than 4 positions total
    $totalOpenPositionsCount = $hasFilters ? 
        (clone $baseQuery())
            ->select('j.id')
            ->whereNull('job_headcounts.user_id')
            ->groupBy('j.id')
            ->havingRaw('COUNT(CASE WHEN job_headcounts.user_id IS NULL THEN 1 END) > 0')
            ->count() :
        JobHeadcount::query()
            ->join('jobs as j', 'j.id', '=', 'job_headcounts.job_id')
            ->select('j.id')
            ->whereNull('job_headcounts.user_id')
            ->groupBy('j.id')
            ->havingRaw('COUNT(CASE WHEN job_headcounts.user_id IS NULL THEN 1 END) > 0')
            ->count();

    // Format open positions
    $formattedOpenPositions = $openPositions->map(function($job) {
        return [
            'title' => $job->title,
            'vacancy' => (int) $job->vacancy_count,
            'isCritical' => (bool) $job->is_critical
        ];
    })->toArray();

    return [
        'success' => true,
        'departments' => $departmentCount,
        'jobPositions' => $jobPositionCount,
        'employees' => $employeeCount,
        'totalPositions' => $totalPositions,
        'vacancies' => $vacancyCount,
        'criticalPositions' => $criticalPositionCount,
        'openPositions' => $formattedOpenPositions,
        'headerText' => $headerText,
        'hasMorePositions' => $totalOpenPositionsCount > 4
    ];
}
// Add this method to your controller




}
