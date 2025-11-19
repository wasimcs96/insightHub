<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Resources\Api\V1\DepartmentResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use OpenApi\Annotations as OA;

class DepartmentController extends Controller
{
    /**
     * GET /rest/v1/departments
     *
     * Return all ACTIVE departments with optional filters, pagination & search.
     *
     * Query params:
     * - paginate: bool (default true). If false, returns full list.
     * - per_page: int (default 50, max 200) — only if paginate=true
     * - q: string search by name (optional)
     * - division_id: int (optional)
     * - business_unit_id: int (optional)
     */

    /**
      * @OA\Get(
      *   path="/rest/v1/departments",
      *   summary="List active departments (with division and business unit)",
      *   tags={"Departments"},
      *   security={{"bearerAuth":{},"ApiKeyAuth":{}}},
      *
      *   @OA\Parameter(
      *     name="x-api-key",
      *     in="header",
      *     required=true,
      *     description="Project API Key",
      *     @OA\Schema(type="string")
      *   ),
      *   @OA\Parameter(
      *     name="per_page",
      *     in="query",
      *     description="Items per page (default 50, max 200)",
      *     @OA\Schema(type="integer", minimum=1, maximum=200)
      *   ),
      *   @OA\Parameter(
      *     name="page",
      *     in="query",
      *     description="Page number (starts at 1)",
      *     @OA\Schema(type="integer", minimum=1)
      *   ),
      *   @OA\Parameter(
      *     name="q",
      *     in="query",
      *     description="Search by department name",
      *     @OA\Schema(type="string")
      *   ),
      *   @OA\Parameter(
      *     name="division_id",
      *     in="query",
      *     @OA\Schema(type="integer")
      *   ),
      *   @OA\Parameter(
      *     name="business_unit_id",
      *     in="query",
      *     @OA\Schema(type="integer")
      *   ),
      *
      *   @OA\Response(
      *     response=200,
      *     description="OK",
      *     @OA\JsonContent(
      *       type="object",
      *       @OA\Property(property="status", type="string", example="success"),
      *       @OA\Property(
      *         property="data",
      *         type="array",
      *         @OA\Items(
      *           type="object",
      *           @OA\Property(property="id", type="integer", example=12),
      *           @OA\Property(property="name", type="string", example="Finance"),
      *           @OA\Property(property="division_id", type="integer", example=2),
      *           @OA\Property(property="division_name", type="string", example="Corporate Services"),
      *           @OA\Property(property="business_unit_id", type="integer", example=1),
      *           @OA\Property(property="business_unit_name", type="string", example="Head Office")
      *         )
      *       ),
      *       @OA\Property(
      *         property="meta",
      *         type="object",
      *         nullable=true,
      *         @OA\Property(
      *           property="pagination",
      *           type="object",
      *           @OA\Property(property="total", type="integer", example=10),
      *           @OA\Property(property="per_page", type="integer", example=50),
      *           @OA\Property(property="current_page", type="integer", example=1),
      *           @OA\Property(property="last_page", type="integer", example=1)
      *         )
      *       )
      *     )
      *   )
      * )
      */
    /**
     * Get all active departments.
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
     * @queryParam q string optional The search term for filtering by department name. Example: "Name"
     * @queryParam division_id integer optional The ID of the division to filter departments by. Example: "1"
     * @queryParam business_unit_id integer optional The ID of the business unit to filter departments by. Example: "2"
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "data": [
     *     {
     *       "id": 12,
     *       "name": "Finance",
     *       "division_id": 2,
     *       "division_name": "Corporate Services",
     *       "business_unit_id": 1,
     *       "business_unit_name": "Head Office"
     *     }
     *   ],
     *   "meta": {
     *     "pagination": {
     *       "total": 10,
     *       "per_page": 50,
     *       "current_page": 1,
     *       "last_page": 1
     *     }
     *   }
     * }
     * 
     * @response 400 scenario="Bad Request" {
     *   "status": "error",
     *   "message": "Invalid request parameters"
     * }
     * 
     * @response 404 scenario="Not Found" {
     *   "status": "error",
     *   "message": "No departments found"
     * }
     */ 
    public function index(Request $request)
    {
        try {
            $paginate = filter_var($request->query('paginate', true), FILTER_VALIDATE_BOOLEAN);
            $perPage  = (int) min(max((int) $request->query('per_page', 50), 1), 200);
            $page     = max((int) $request->query('page', 1), 1);   // ✅ new
            $search   = trim((string) $request->query('q', ''));
            $divId    = $request->query('division_id');
            $buId     = $request->query('business_unit_id');
    
            $builder = Department::query()
                ->select([
                    'departments.*',
                    'divisions.id as division_id',
                    'divisions.head_of_division as division_name',
                    'divisions.business_unit_id as joined_business_unit_id',
                    'business_units.id as business_unit_id',
                    'business_units.name as business_unit_name',
                ])
                ->leftJoin('divisions', 'divisions.id', '=', 'departments.division_id')
                ->leftJoin('business_units', 'business_units.id', '=', 'divisions.business_unit_id');
    
            // Active
            if (Schema::hasColumn('departments', 'is_active')) {
                $builder->where('departments.is_active', 1);
            } elseif (Schema::hasColumn('departments', 'status')) {
                $builder->where('departments.status', 1);
            }
    
            // Filters
            if ($divId) {
                $builder->where('departments.division_id', $divId);
            }
            if ($buId) {
                $builder->where('divisions.business_unit_id', $buId);
            }
    
            // Search
            if ($search !== '') {
                $builder->where(function ($q) use ($search) {
                    if (Schema::hasColumn('departments', 'name')) {
                        $q->orWhere('departments.name', 'like', "%{$search}%");
                    }
                    if (Schema::hasColumn('departments', 'code')) {
                        $q->orWhere('departments.code', 'like', "%{$search}%");
                    }
                    if (Schema::hasColumn('departments', 'department_name')) {
                        $q->orWhere('departments.department_name', 'like', "%{$search}%");
                    }
                });
            }
    
            // Sort
            if (Schema::hasColumn('departments', 'name')) {
                $builder->orderBy('departments.name');
            } elseif (Schema::hasColumn('departments', 'department_name')) {
                $builder->orderBy('departments.department_name');
            }
            $builder->orderBy('departments.id');
    
            // Paginated response (explicit page support)
            $paginator = $builder->paginate($perPage, ['*'], 'page', $page)
                                ->appends($request->query());
    
            return response()->json([
                'status' => 'success',
                'data'   => DepartmentResource::collection($paginator->items()),
                'meta'   => [
                    'pagination' => [
                        'total'        => $paginator->total(),
                        'per_page'     => $paginator->perPage(),
                        'current_page' => (int) $paginator->currentPage(),
                        'last_page'    => (int) $paginator->lastPage(),
                    ],
                ],
            ]);
        }  catch (\Throwable $e) {
            \Log::error('Department index unexpected error', ['error' => $e->getMessage()]);
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.',
                'error'   => app()->environment('local') ? $e->getMessage() : null,
            ], 500);
        }
    }
    

}
