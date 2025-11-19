<?php

namespace App\Services;

use App\Helpers\MainHelper;
use App\Helpers\QueryHelper;
use App\Models\Department;
use App\Models\Job;
use App\Models\JobHeadcount;
use App\Models\OrgChartVersion;
use App\Models\User;
use App\Modules\Headcounts\Services\JobHeadcountService;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use App\Contracts\JobHeadcountRepositoryInterface;
use App\Models\JobOpening;

class OrganizationChartService
{
    protected JobHeadcountService $hcService;
    protected JobHeadcountRepositoryInterface $jobHeadcountRepository;

    public function __construct(JobHeadcountService $hcService,JobHeadcountRepositoryInterface $jobHeadcountRepository)
    {
        $this->hcService = $hcService;
        $this->jobHeadcountRepository = $jobHeadcountRepository;
    }

    public function getHierarchyData(array $filters = [], $page = 1, $perPage = 100)
    {
        $currentUserId = auth()->id() ?? $filters['user_id'] ?? User::where('role_name', 'admin')->first()->id ?? 3;

        $subQuery = DB::table('job_headcounts')->select('id');

        

        $query = DB::table('job_headcounts as jh')
            ->join('jobs as j', 'jh.job_id', '=', 'j.id')
            ->join('departments as d', 'j.department_id', '=', 'd.id')
            ->leftJoin('users as u', 'jh.user_id', '=', 'u.id')
            ->leftJoin('job_headcounts as parent_jh', 'jh.parent_id', '=', 'parent_jh.id')
            ->select([
                'jh.id as id',
                'j.title as title',
                'j.id as job_id',
                'j.is_critical as is_critical',
                'j.level as level',
                'd.name as department',
                'jh.headcount_code as code',
                DB::raw('COALESCE(u.name, "Vacant") as name'),
                DB::raw('COALESCE(u.profile_picture, "'.asset('/admin/media/svg/org-chart-svg/user-new.svg').'") as imageURL'),
                'jh.user_id as user_id',
                'jh.parent_id',
                DB::raw('IF(jh.user_id = '.$currentUserId.', true, false) as isYou'),
                DB::raw('IF(jh.user_id = '.$currentUserId.', "You", "") as badgeText'),
                'j.is_top',
                'parent_jh.headcount_code as parent_code',
                'j.department_id as department_id',
            ])
            ->where(function ($q) use ($subQuery) {
                $q->where('j.is_top', 1)
                    ->orWhereIn('jh.parent_id', $subQuery); // Ensure parent exists
            })
            ->where('jh.deleted_at', null)
            ->where('jh.tenant_id', tenant_id())
            ->orderByDesc('j.is_top');
       
        // Optional filters
        $query->when(isset($filters['department_id']), function ($q) use ($filters) {
            $q->where('j.department_id', $filters['department_id']);
        });

        $query->when(isset($filters['job_position']), function ($q) use ($filters) {
            $q->where('j.title', 'LIKE', '%' . $filters['job_position'] . '%');
        });

        // $query->when(isset($filters['user_id']), function ($q) use ($filters) {
        //     $q->where('u.id', $filters['user_id']);
        // });

        // $results = $query->paginate($perPage, ['*'], 'page', $page);

        $results = $query->get();

                // Build hierarchy
                $items = [];
                foreach ($results as $row) {

                    $isBlur= false;

                    $imageURL = null;
                    if (isset($row->imageURL) && File::exists(public_path($row->imageURL))) {
                        $imageURL = $row->imageURL;
                    }else{
                        $imageURL = asset('/admin/media/svg/org-chart-svg/user-new.svg');
                    }

                    if (isset($filters['user_id']) && $filters['user_id'] != null && $filters['user_id'] > 0) {
                        $isBlur= true;
                        if ($row->user_id == $filters['user_id']) {
                            $isBlur= false;
                        }
                    }

                    $items[strval($row->id)] = [
                        'id'       => $row->code,
                        'parent_code'    => $row->parent_code,
                        'data'     => [
                            'title'       => $row->title,
                            'department'  => $row->department,
                            'code'        => $row->code,
                            'name'        => $row->name,
                            'imageURL'    => $imageURL,
                            'isYou'       => (bool)$row->isYou,
                            'badgeText'   => $row->badgeText,
                            'level'        => $row->level,
                            'user_id'    => $row->user_id,
                            'parent_id'    => $row->parent_id,
                            'job_id'    => $row->job_id,
                            'department_id'=> $row->department_id,
                            'headcount_id'=> strval($row->id),
                            'is_new' => false,
                            'new_employee'=>false,
                            'employee_removed'=>false,
                            'is_transfer'=>false,
                            'is_reassigned'=>false,
                            'is_deleted'=>false,
                            'is_critical' => $row->is_critical,
                            'is_blured'=> $isBlur,
                            'is_subordinates'=>false
                        ],
                        'options'  => [
                            'nodeBGColor'       => '#eef0f6',
                            'nodeBGColorHover'  => '#d0d3e2',
                            'nodeWidth'=> '150',
                            'nodeHeight'=> '100'
                        ],
                        'modified_fields' => [
                            'department' => false,
                            'user_id' => false,
                            'parent_id' => false,
                            'is_deleted'=>false
                        ],
                        'reasons'=>[
                            'add_position'=>'',
                            'remove_position'=>'',
                            'assign_employee'=>'',
                            'remove_employee'=>'',
                            'move_employee'=>'',
                            'move_position'=>''
                        ],
                        'children' => []
                    ];
                }

        $tree = [];
        foreach ($items as $id => &$item) {
            if ($results->firstWhere('id', $id)->parent_id && isset($items[$results->firstWhere('id', $id)->parent_id])) {
                $items[$results->firstWhere('id', $id)->parent_id]['children'][] = &$item;
                $items[$results->firstWhere('id', $id)->parent_id]['data']['is_subordinates'] = true;

            } else {
                $tree[] = &$item;
            }
        }

        return $tree;
    }

    public function getEmployeeProfile($id)
    {
        $columns = [
            'jobHeadcount' => ['id', 'user_id', 'job_id', 'headcount_code', 'parent_id', 'department_id'],
            'parent' => ['id', 'user_id', 'job_id', 'headcount_code', 'department_id'],
            'user' => ['id', 'name', 'email'],
            'job' => ['id', 'title'],
            'department' => ['id', 'name'],
        ];


        $queries = QueryHelper::getDynamicLevelQueries();


        $employee = User::withParentJobHeadcountColumns($columns)->with(['results' => function ($query) use ($queries) {
            $query->select(array_merge(['user_id'], $queries['selectStatements'], $queries['caseStatements']))
                ->groupBy('user_id');
        }])->select('id', 'name', 'email', 'employee_code')->findOrFail($id);

        $data = [
            'name' => isset($employee->name) ? $employee->name : '-', // Check if name is set
            'email' => isset($employee->email) ? $employee->email : '-', // Check if email is set
            'position' => isset($employee->jobHeadcount) && isset($employee->jobHeadcount->job) && isset($employee->jobHeadcount->job->title) ? $employee->jobHeadcount->job->title : '-', // Check if position is set
            'bsc' => '-', // Static value, no changes

            'flight_risk' => isset($employee->results[0]) && isset($employee->results[0]->fr_level_label) ? $employee->results[0]->fr_level_label : '-', // Check if flight risk result is set
            'overall_match_rate' => isset($employee->results[0]) && isset($employee->results[0]->omr_level_label) ? $employee->results[0]->omr_level_label : '-', // Check if overall match rate is set
            'behavioral_fit_rate' => isset($employee->results[0]) && isset($employee->results[0]->bfr_level_label) ? $employee->results[0]->bfr_level_label : '-', // Check if behavioral fit rate is set
            'job_match_rate' => isset($employee->results[0]) && isset($employee->results[0]->jmr_level_label) ? $employee->results[0]->jmr_level_label : '-', // Check if job match rate is set

            'headcount_code' => isset($employee->jobHeadcount) && isset($employee->jobHeadcount->headcount_code) ? $employee->jobHeadcount->headcount_code : '-', // Check if headcount code is set
            'employee_code' => isset($employee->employee_code) ? $employee->employee_code : '-', // Check if employee code is set
            'department' => isset($employee->department) && isset($employee->department->name) ? $employee->department->name : '-', // Check if department is set
            'technical_assessment' => isset($employee->results[0]) && isset($employee->results[0]->ta_level_label) ? $employee->results[0]->ta_level_label : '-', // Check if technical assessment result is set
            'soft_skill_match_rate' => isset($employee->results[0]) && isset($employee->results[0]->ssmr_level_label) ? $employee->results[0]->ssmr_level_label : '-', // Check if soft skill match rate is set
            'cognitive_test_result' => isset($employee->results[0]) && isset($employee->results[0]->cat_level_label) ? $employee->results[0]->cat_level_label : '-', // Check if cognitive test result is set
            'riasec' => '-', // Static value for RIASEC, or populate dynamically if available
            'ocean' => isset($employee->results[0]) && isset($employee->results[0]->rci_level_label) ? $employee->results[0]->rci_level_label : '-', // Check if OCEAN is set
            'growth_potential' => isset($employee->results[0]) && isset($employee->results[0]->gp_level_label) ? $employee->results[0]->gp_level_label : '-', // Check if growth potential is set
            'forecast_alignment' => isset($employee->results[0]) && isset($employee->results[0]->waf_level_label) ? $employee->results[0]->waf_level_label : '-', // Check if forecast alignment is set

            'superior' => [
                'name' => isset($employee->jobHeadcount?->parent) && isset($employee->jobHeadcount?->parent?->user?->name) ? $employee->jobHeadcount?->parent?->user?->name : '-', // Check if superior name is set
                'position' => isset($employee->jobHeadcount?->parent) && isset($employee->jobHeadcount?->parent?->job) ? $employee->jobHeadcount?->parent?->job?->title : '-', // Check if superior position is set
                'headcount_id' => isset($employee->jobHeadcount?->parent) && isset($employee->jobHeadcount?->parent?->headcount_code) ? $employee->jobHeadcount?->parent?->headcount_code : '-', // Check if superior headcount_id is set
                'department' => isset($employee->jobHeadcount?->parent) && isset($employee->jobHeadcount?->parent?->department) && isset($employee->jobHeadcount?->parent?->department?->name) ? $employee->jobHeadcount?->parent?->department?->name : '-', // Check if superior department is set
            ],
        ];

        return $data;
    }


    public function getPositionActions(string $code): array
    {
        $config = config('constants.ALLOWED_ACTIONS_ORG_STRUCTURE');

        try {
            $hc = JobHeadcount::with('children')
                ->where('headcount_code', $code)
                ->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // code not in DB → suggest only “Add Position”
            return [
                // 1 => $config[1],
                5 => $config[5]
            ];
        }

        $actions = [];


        if (empty($hc->user_id)) {
            $actions[] = 1; // Assign Employee
            // if ($hc->children->isEmpty()) {
            //     $actions[] = 2;
            //     $actions[] = 6; // Edit JD
            //     $actions[] = 5;
            // }
            // if ($hc->children->isNotEmpty()) {
            //     $siblingCount = JobHeadcount::where('job_id', $hc->job_id)
            //         ->where('parent_id', $hc->parent_id)
            //         ->where('id', '<>', $hc->id)
            //         ->count();
            //     if ($siblingCount > 0) {
            //         $actions[] = 7; // Reassign Subordinates
            //     }
            // }
            // $actions[] = 1;
            $actions[] = 2; // Add Position
            $actions[] = 5;
            $actions[] = 6;
            // $actions[] = 7;
        } else {
            // $actions[] = 1;
            $actions[] = 2; // Add Position
            $actions[] = 3; // Move Employee
            $actions[] = 4; // Remove Employee
            $actions[] = 5;
            $actions[] = 6;
            // $actions[] = 7;

            // if ($hc->children->isNotEmpty()) {
            //     $actions[] = 7; // Reassign Subordinates
            // }

            // if ($hc->children->isEmpty() && empty($hc->user_id)) {
            $actions[] = 5; // Delete Position
            // }

        }


        // Map to labels and remove duplicates
        return collect($actions)
            ->unique()
            ->mapWithKeys(fn($key) => [$key => ($config[$key] ?? "Unknown Action #{$key}")])
            ->all();
    }


    public function getChildrenWithJD(int $id): array
    {
        // Eager‐load children + each child’s department
        $job = Job::with('children.department')
            ->findOrFail($id);

        return $job->children
            ->map(function (Job $child) {
                return [
                    'id'            => $child->id,
                    'title'         => $child->title,
                    'department_id' => $child->department_id,
                    'department'    => optional($child->department)->name,
                ];
            })
            ->toArray();
    }



    // public function oldApplyChanges($old,$new, $changes, $userId): void
    // {
    //     dd(json_decode($changes));
    //     DB::transaction(function () use ($old, $new, $changes, $userId) {

            
    //         $changes = json_decode($changes);
    //         // dd(!empty($changes->additions));
    //         // 1) Handle additions via your existing JobHeadcountService
    //         // if (!empty($changes->additions)) {
    //         //     $batch     = [];
    //         //     $deptCache = [];

    //         //     foreach ($changes->additions as $item) {
    //         //         $node = $item->node;
    //         //         // parse headcount_code
    //         //         [$prefix, $jobId, $seq] = explode('-', $node->id);

    //         //         // map department name → id (cache)
    //         //         $deptName = $node->data->department;
    //         //         if (! isset($deptCache[$deptName])) {
    //         //             $deptCache[$deptName] = \App\Models\Department::where('name', $deptName)
    //         //                 ->value('id');
    //         //         }

    //         //         // resolve parent_id by code
    //         //         $parentCode = $item->parentId ?? null;
    //         //         $parent     = $parentCode
    //         //             ? $this->hcService->findByCode($parentCode)
    //         //             : null;

    //         //         $batch[] = [
    //         //             'job_id'           => (int) $jobId,
    //         //             'headcount_code'   => $node->id,
    //         //             'parent_id'        => $parent?->id,
    //         //             'department_id'    => $deptCache[$deptName],
    //         //             'headcount_number' => (int) $seq,
    //         //         ];
    //         //     }

                
    //         //     // delegate to your service
    //         //     $this->hcService->createBatch($batch, reset($deptCache));
    //         // }

    //         // 2) (Optional) handle updates / deletions…
    //         if (!empty($changes->updates)) {
    //             $batchForAdd     = [];
    //             $batch     = [];
    //             $deptCache = [];

    //             foreach ($changes->updates as $item) {

    //                 // if ($item->action == "update_assign_employee") {

    //                 //     $node = $item->node;
    //                 //     // map department name → id (cache)
    //                 //     $user_id = $node->data->user_id;
                        
    //                 //     $user = User::find($user_id);

    //                 //     if (!$user) {
    //                 //        continue;
    //                 //     }

    //                 //     $headcount = $this->hcService->findByCode($node->id);

    //                 //     if ($headcount) {
    //                 //         $this->hcService->update($headcount->id,['user_id'=>$user->id]);
    //                 //     }

    //                 //     if ($user) {
    //                 //         $user->department_id = $headcount->department_id;
    //                 //         $user->position_id = $headcount->job_id;
    //                 //         $user->save();
    //                 //     }

    //                 // }else if($item->action == "update_remove_employee") {

                        // $node = $item->node;
                
                        // $headcount = $this->hcService->findByCode($node->id);

                        // if ($headcount) {

                        //     if ($headcount->user_id) {
                        //         $user = User::find($headcount->user_id);
                        //         if (!$user) {
                        //             continue;
                        //         }
                        //         $user->department_id = null;
                        //         $user->position_id = null;
                        //         $user->save();
                        //     }

                        //     $this->hcService->update($headcount->id,['user_id'=>null]);
                        // }

                        
                        

    //                 // }else if($item->action == "update_transfer_employee") {
                     
    //                 //     // To Track History
                       
    //                 // }
                    
    //                 if($item->action == 'modify_node'){
    //                     if ($item->node->data->is_new == true && $item->node->modified_fields->is_deleted == false) {
    //                         $node = $item->node;
    //                         // parse headcount_code
    //                         [$prefix, $jobId, $seq] = explode('-', $node->id);
        
    //                         // map department name → id (cache)
    //                         $deptName = $node->data->department;
    //                         if (! isset($deptCache[$deptName])) {
    //                             $deptCache[$deptName] = \App\Models\Department::where('name', $deptName)
    //                                 ->value('id');
    //                         }
        
    //                         // resolve parent_id by code
    //                         $parentCode = $item->parentId ?? null;
    //                         $parent     = $parentCode
    //                             ? $this->hcService->findByCode($parentCode)
    //                             : null;
        
    //                         $batchForAdd[] = [
    //                             'job_id'           => (int) $jobId,
    //                             'headcount_code'   => $node->id,
    //                             'parent_id'        => $parent?->id,
    //                             'department_id'    => $deptCache[$deptName],
    //                             'headcount_number' => (int) $seq,
    //                         ];
    //                     }
    //                 }

    //             }

    //             if (count($batchForAdd) > 0) {
    //                 $this->hcService->createBatch($batchForAdd, reset($deptCache));
    //             }
    //         }


    //         // 3) Only _after_ all DB operations succeed, log a version
    //         OrgChartVersion::create([
    //             'old_json' => $old,
    //             'new_json' => $new,
    //             'changes_json'       => json_encode($changes),
    //             'created_by'    => $userId,
    //             'created_at'    => Carbon::now(),
    //             'status' => 1
    //         ]);
    //     });
    // }


    // Org Structure JSON Modification
    public function applyChanges($old, $new, $changes, $userId): void
    {
       
        DB::transaction(function () use ($old, $new, $changes, $userId) {

            
            $changes = json_decode($changes);

            if (!empty($changes->updates)) {
                $batchForAdd     = [];
                $batch     = [];
              
                

                foreach ($changes->updates as $item) {      
                    
                    if($item->action == 'modify_node'){
                        // Handle Add Position
                        if ($item->node->data->is_new == true && $item->node->modified_fields->is_deleted == false) {

                            $node = $item->node;
                            
                            // parse headcount_code
                            [$prefix, $jobId, $seq] = explode('-', $node->id);

                            //Reason Of Add Position
                            $reason = $item?->node?->reasons?->add_position;
        
                            $batchForAdd[] = [
                                'job_id'           => (int) $jobId,
                                'headcount_code'   => $node->id,
                                'parent_id'        => $node?->data?->parent_id,
                                'department_id'    => $node?->data?->department_id,
                                'user_id'    => $node?->data?->user_id ?? null,
                                'headcount_number' => (int) $seq,
                                'orgMetadata' => [
                                    'action' => 'add_position',
                                    'reason' => $reason,
                                    'node' => $node,
                                ]
                            ];
                        }elseif ($item->node->data->is_new == false && $item->node->modified_fields->is_deleted == true) {
                            // Handling Delete Position 
                            $node = $item->node;
                            $headcountCode = $node->id; // Get the headcount code
                            $jobId = $node->data->job_id; // Get the associated job_id
                            $reason = $item?->node?->reasons?->remove_position;

                            // Find the headcount record by headcount code
                            $headcount = JobHeadcount::where('headcount_code', $headcountCode)->first();
                            
                            if ($headcount) {
                                // Perform the deletion (soft or hard delete)
                                $headcount->orgMetadata = [
                                    'action' => 'remove_position',
                                    'reason' => $reason,
                                    'node' => $node,
                                ];
                                $headcount->delete(); // Soft delete (if SoftDeletes trait is used)
                                
                                // If you need to perform a hard delete instead of soft delete, you can use:
                                // $headcount->forceDelete();
                            }


                        }elseif ($item->node->data->is_deleted == false && $item->node->modified_fields->user_id == true) {
                            // Handling Remove Employee & Assign Employee
                            $node = $item->node;
                            // map department name → id (cache)
                            $user_id = $node?->data?->user_id;
                            
                            if ($user_id == null) {
                                $node = $item->node;
                                $headcount = $this->hcService->findByCode($node->id);
                                $reason = $item?->node?->reasons?->remove_employee;

                                if ($headcount) {
                                    $removedUser = null;

                                    if ($headcount->user_id) {
                                        $removedUser= User::find($headcount->user_id);
                                        if (!$removedUser) {
                                            continue;
                                        }
                                        $removedUser->department_id = null;
                                        $removedUser->position_id = null;
                                        $removedUser->save();
                                    }

                                    $this->hcService->update($headcount->id,[
                                        'user_id' => null,
                                        'orgMetadata' => [
                                            'action' => 'remove_employee',
                                            'reason' => $reason,
                                            'node' => $node,
                                            'extra' => [
                                                'removedUser' => $removedUser
                                            ]
                                        ]
                                    ]);
                                }
                            }else{
                                $user = User::find($user_id);
                                $reason = $item?->node?->reasons?->assign_employee;
        
                                if (!$user) {
                                    continue;
                                }
        
                                $headcount = $this->hcService->findByCode($node->id);
        
                                if ($headcount) {
                                    $this->hcService->update($headcount->id,[
                                        'user_id'=>$user->id,
                                        'orgMetadata' => [
                                            'action' => 'assign_employee',
                                            'reason' => $reason,
                                            'node' => $node,
                                        ]
                                    ]);
                                }
        
                                if ($user) {
                                    $user->department_id = $headcount->department_id;
                                    $user->position_id = $headcount->job_id;
                                    $user->company_id = 3;
                                    $user->save();

                                    try {
                                        MainHelper::jobTriggerByTypeOnPositionChange($user->id,$user->position_id,config('helpers.panel_names')[env('DB_DATABASE')]);
                                    } catch (\Throwable $th) {
                                        
                                    }
                                    $remainingVacantHeadcounts = $this->jobHeadcountRepository->getVacantByJobId($headcount->job_id);
                                    if ($remainingVacantHeadcounts->count() == 0) {
                                        $this->markJobAsFilledByHeadcounts($headcount->job_id);
                                    }
                                }

                            }

                            // ?? how to differentiate remove and reassign
                            // $reason = $item?->node?->reasons?->move_employee;
                            
                        }elseif ($item->node->data->is_deleted == false && $item->node->modified_fields->parent_id == true) {
                            // Handling Parent Resasign
                            $node = $item->node;
                            // map department name → id (cache)
                            $parent_id = $node?->parent_code;
                            $reason = $item?->node?->reasons?->move_position;

                            if ($parent_id) {
                                
                                $parent = $this->hcService->findByCode($parent_id);
        
                                if (!$parent) {
                                continue;
                                }
                                $headcount = $this->hcService->findByCode($node->id);
                                
                                if ($headcount && $parent) {
                                    $this->hcService->update($headcount->id, [
                                        'parent_id' => $parent->id,
                                        'orgMetadata' => [
                                            'action' => 'move_position',
                                            'reason' => $reason,
                                            'node' => $node,
                                            'extra' => [
                                                'newHc' => $parent,
                                                'oldHd' => $headcount
                                            ]
                                        ]
                                    ]);
                                }
                            }

                        }
                    }
                }

                if (count($batchForAdd) > 0) {
                    $this->hcService->createBatchForOrgChart($batchForAdd);
                }
            }

            OrgChartVersion::create([
                'old_json' => $old,
                'new_json' => $new,
                'changes_json'       => json_encode($changes),
                'created_by'    => $userId,
                'created_at'    => Carbon::now(),
                'status' => 1
            ]);
        });
    }

    private function markJobAsFilledByHeadcounts($job): void
    {
        // Update job's vacancy field to match actual vacant headcounts
        $vacantCount = $this->jobHeadcountRepository->getVacantByJobId($job)->count();
        $job = Job::find($job);
        $job->update(['vacancy' => $vacantCount]);
        
        $jobOpening=JobOpening::where('job_id',$job->id);
        // Mark job opening as filled
        $jobOpening->update([
            'status' => 4,
            'application_filled_date' => now()
        ]);
    }

    public function searchUsers(array $criteria)
    {
        $query = User::where('tenant_id', tenant_id())->doesntHave('jobHeadcount');

        $query->where('role_id', 1);

        if (!empty($criteria['query'])) {
            $search = $criteria['query'];

            $query->where(function ($q) use ($search) {
                // search first_name
                $q->where('first_name', 'like', "%{$search}%")
                    // or last_name
                    ->orWhere('last_name', 'like', "%{$search}%")
                    // or the combined name column
                    ->orWhere('name', 'like', "%{$search}%");
            });
        }


        $query->whereNotIn('id', $criteria['exclueEmployeesList']);

        return $query->limit(10)
            ->get()
            ->map(function ($data) {
                return [
                    'id' => $data->id,
                    'text' => $data->name,
                    'profile_picture_url'=>$data->profile_picture_url
                    // 'level' => $data->level
                ];
            });
    }

    public function searchDepartments(array $criteria)
    {

        $query = Department::query();

        if (!empty($criteria['query'])) {

            $search = $criteria['query'];

            $query->where('name', 'like', "%{$search}%");
        }

        return $query->limit(10)
            ->get()
            ->map(function ($data) {
                return [
                    'id' => $data->id,
                    'text' => $data->name . ($data->division ? ' (' . $data->division->head_of_division . ')' : ''),
                ];
            });
    }

    public function getEmployeeCountByJobId($jobId)
    {
        $job = Job::withCount(['headcounts as employee_count' => function ($query) {
            $query->whereNotNull('user_id');
        }])->find($jobId);

        if (!$job) {
            return null;
        }

        return [
            'job_id' => $job->id,
            'title' => $job->title,
            'employee_count' => $job->employee_count,
        ];
    }

    public function buildFilter(array $filters)
    {
        // Start building the query using the JobHeadcount model
        $query = JobHeadcount::query();

        // Check if there are any filters
        if (count($filters) > 0) {
            // Loop through all filters in the array
            foreach ($filters as $key => $value) {
                if (!empty($value)) {
                    // Handle filters for user_id, department_id, division_id, or headcount_code
                    if (in_array($key, ['user_id', 'department_id', 'division_id'])) {
                        // Apply filter directly on the related fields in the JobHeadcount table
                        $query->where($key, '=', $value);
                    } 
                    // If it's a filter for headcount_code, apply it directly in the query
                    elseif ($key === 'headcount_code') {
                        $query->where('headcount_code', '=', $value);
                    } else {
                        // Add the condition for other filters if needed
                        $query->where($key, '=', $value);
                    }
                }
            }
        }

        // Pluck the headcount_code and return it as an array
        $headcountCodes = $query->pluck('headcount_code')->toArray();

        // Return the array of headcount_codes
        return $headcountCodes;
    }
    


}
