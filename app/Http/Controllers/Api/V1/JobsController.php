<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Resources\Api\V1\JobResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use OpenApi\Annotations as OA;

class JobsController extends Controller
{

    /**
     * Get all active jobs.
     *
     * Requires an API key in the header.
     *
     * @group Company Structure
     * @authenticated
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @queryParam per_page integer optional The number of items per page (default 50, max 200). Example: 50
     * @queryParam page integer optional The page number (starts at 1). Example: 1
     * @queryParam q string optional The search term for filtering by title or position code. Example: "Developer"
     * @queryParam business_unit_id integer optional Filter by business unit ID. Example: 1
     * @queryParam division_id integer optional Filter by division ID. Example: 2
     * @queryParam department_id integer optional Filter by department ID. Example: 3
     * @queryParam level integer optional Filter by job level. Example: 5
     * @queryParam group_by string optional Group results by field (currently supports: 'department'). Example: "department"
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "data": [
     *     {
     *       "id": 1,
     *       "title": "Senior Developer",
     *       "position_code": "DEV-001",
     *       "level": 5,
     *       "business_unit": {
     *         "id": 1,
     *         "name": "Technology"
     *       },
     *       "division": {
     *         "id": 1,
     *         "name": "Engineering"
     *       },
     *       "department": {
     *         "id": 1,
     *         "name": "Software Development"
     *       }
     *     }
     *   ],
     *   "meta": {
     *     "pagination": {
     *       "total": 100,
     *       "per_page": 50,
     *       "current_page": 1,
     *       "last_page": 2
     *     }
     *   }
     * }
     * 
     * @response 200 scenario="Grouped by Department" {
     *   "status": "success",
     *   "data": [
     *     {
     *       "department": {
     *         "id": 1,
     *         "name": "Software Development"
     *       },
     *       "jobs": [
     *         {
     *           "id": 1,
     *           "title": "Senior Developer",
     *           "position_code": "DEV-001",
     *           "level": 5
     *         }
     *       ],
     *       "count": 5
     *     }
     *   ]
     * }
     * 
     * @response 400 scenario="Bad Request" {
     *   "status": "error",
     *   "message": "Invalid request parameters"
     * }
     */
    public function index(Request $request)
    {
        try {
            $paginate = filter_var($request->query('paginate', true), FILTER_VALIDATE_BOOLEAN);
            $perPage  = (int) min(max((int) $request->query('per_page', 50), 1), 200);
            $page     = max((int) $request->query('page', 1), 1);
            $search   = trim((string) $request->query('q', ''));
            $groupBy  = $request->query('group_by');
            
            // Filters
            $businessUnitId = $request->query('business_unit_id');
            $divisionId     = $request->query('division_id');
            $departmentId   = $request->query('department_id');
            $level          = $request->query('level');

            // If grouping by department
            if ($groupBy === 'department') {
                return $this->getJobsGroupedByDepartment($request, [
                    'search'          => $search,
                    'business_unit_id' => $businessUnitId,
                    'division_id'     => $divisionId,
                    'department_id'   => $departmentId,
                    'level'           => $level,
                ]);
            }

            // Regular listing
            $builder = Job::query();

            // Eager load relationships for better performance
            $builder->with([
                'businessUnit:id,name',
                'division:id,head_of_division',
                'department:id,name',
            ]);

            // Apply filters
            $this->applyFilters($builder, $search, $businessUnitId, $divisionId, $departmentId, $level);

            // Sorting
            if (Schema::hasColumn('jobs', 'title')) {
                $builder->orderBy('title');
            }
            $builder->orderBy('id');

            // Paginated response
            $paginator = $builder->paginate($perPage, ['*'], 'page', $page)
                                ->appends($request->query());

            return response()->json([
                'status' => 'success',
                'data'   => JobResource::collection($paginator->items()),
                'meta'   => [
                    'pagination' => [
                        'total'        => $paginator->total(),
                        'per_page'     => $paginator->perPage(),
                        'current_page' => (int) $paginator->currentPage(),
                        'last_page'    => (int) $paginator->lastPage(),
                    ],
                ],
            ]);
        } catch (\Throwable $e) {
            \Log::error('Jobs index unexpected error', ['error' => $e->getMessage()]);
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.',
                'error'   => app()->environment('local') ? $e->getMessage() : null,
            ], 500);
        }
    }

    /**
     * Get jobs grouped by department.
     *
     * @param \Illuminate\Http\Request $request
     * @param array $filters
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getJobsGroupedByDepartment(Request $request, array $filters)
    {
        try {
            $builder = Job::query();

            // Eager load relationships
            $builder->with([
                'businessUnit:id,name',
                'division:id,head_of_division',
                'department:id,name',
            ]);

            // Apply filters
            $this->applyFilters(
                $builder,
                $filters['search'],
                $filters['business_unit_id'],
                $filters['division_id'],
                $filters['department_id'],
                $filters['level']
            );

            // Get all jobs
            $jobs = $builder->orderBy('department_id')
                           ->orderBy('title')
                           ->get();

            // Group by department
            $grouped = $jobs->groupBy('department_id')->map(function ($departmentJobs, $departmentId) {
                $department = $departmentJobs->first()->department;
                
                return [
                    'department' => $department ? [
                        'id'   => $department->id,
                        'name' => $department->name,
                    ] : [
                        'id'   => null,
                        'name' => 'No Department',
                    ],
                    'jobs'  => JobResource::collection($departmentJobs),
                    'count' => $departmentJobs->count(),
                ];
            })->values();

            return response()->json([
                'status' => 'success',
                'data'   => $grouped,
                'meta'   => [
                    'total_jobs'        => $jobs->count(),
                    'total_departments' => $grouped->count(),
                    'grouped_by'        => 'department',
                ],
            ]);
        } catch (\Throwable $e) {
            \Log::error('Jobs grouped by department error', ['error' => $e->getMessage()]);
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.',
                'error'   => app()->environment('local') ? $e->getMessage() : null,
            ], 500);
        }
    }

    /**
     * Apply common filters to the query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param string $search
     * @param int|null $businessUnitId
     * @param int|null $divisionId
     * @param int|null $departmentId
     * @param int|null $level
     * @return void
     */
    protected function applyFilters($builder, $search, $businessUnitId, $divisionId, $departmentId, $level)
    {
        // Active filter (if applicable)
        if (Schema::hasColumn('jobs', 'is_active')) {
            $builder->where('is_active', 1);
        } elseif (Schema::hasColumn('jobs', 'status')) {
            $builder->where('status', 1);
        }

        // Search by title or position_code
        if ($search !== '') {
            $builder->where(function ($q) use ($search) {
                if (Schema::hasColumn('jobs', 'title')) {
                    $q->orWhere('title', 'like', "%{$search}%");
                }
                if (Schema::hasColumn('jobs', 'position_code')) {
                    $q->orWhere('position_code', 'like', "%{$search}%");
                }
            });
        }

        // Filters
        if ($businessUnitId) {
            $builder->where('business_unit_id', $businessUnitId);
        }

        if ($divisionId) {
            $builder->where('division_id', $divisionId);
        }

        if ($departmentId) {
            $builder->where('department_id', $departmentId);
        }

        if ($level) {
            $builder->where('level', $level);
        }
    }
}