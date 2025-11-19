<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\BusinessUnit;
use App\Resources\Api\V1\BusinessUnitResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use OpenApi\Annotations as OA;

class BusinessUnitController extends Controller
{
    /**
     * GET /rest/v1/business-units
     * 
     * Return all ACTIVE business units (default), with optional pagination & search.
     * 
     * Query params:
     * - paginate: bool (default true). If false, returns full list.
     * - per_page: int (default 50, max 200) — only if paginate=true
     * - q: string search by name (optional)
     */

    /**
     * @OA\Get(
     *   path="/rest/v1/business-units",
     *   summary="List active business units",
     *   tags={"Business Units"},
     *   security={{"bearerAuth":{},"ApiKeyAuth":{}}},
     *   @OA\Parameter(name="x-api-key", in="header", required=true, description="Project API Key", @OA\Schema(type="string")),
     *   @OA\Parameter(name="page",in="query",description="Page number (starts at 1)",@OA\Schema(type="integer", minimum=1)),
     *   @OA\Parameter(name="per_page", in="query", @OA\Schema(type="integer", minimum=1, maximum=200)),
     *   @OA\Parameter(name="q", in="query", @OA\Schema(type="string")),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(type="object",
     *       @OA\Property(property="status", type="string", example="success"),
     *       @OA\Property(property="data", type="array",
     *         @OA\Items(type="object",
     *           @OA\Property(property="id", type="integer", example=1),
     *           @OA\Property(property="name", type="string", example="Corporate Services"),
     *         )
     *       ),
     *       @OA\Property(property="meta", type="object",
     *         @OA\Property(property="pagination", type="object",
     *           @OA\Property(property="total", type="integer", example=10),
     *           @OA\Property(property="per_page", type="integer", example=50),
     *           @OA\Property(property="current_page", type="integer", example=1),
     *           @OA\Property(property="last_page", type="integer", example=1)
     *         ),
     *         nullable=true
     *       )
     *     )
     *   )
     * )
    */

    /**
     * Get all active business units.
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
     * @queryParam q string optional The search term for filtering by name. Example: "Corporate Services"
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "Corporate Services"
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
     *   "message": "No business units found"
     * }
    */

    public function index(Request $request)
    {
        try {
            $paginate = filter_var($request->query('paginate', true), FILTER_VALIDATE_BOOLEAN);
            $perPage  = (int) min(max((int) $request->query('per_page', 50), 1), 200);
            $page     = max((int) $request->query('page', 1), 1);
            $search   = trim((string) $request->query('q', ''));
    
            $builder = BusinessUnit::query();
    
            // Active filter
            if (Schema::hasColumn('business_units', 'is_active')) {
                $builder->where('is_active', 1);
            } elseif (Schema::hasColumn('business_units', 'status')) {
                $builder->where('status', 1);
            }
    
            // Search
            if ($search !== '') {
                $builder->where(function ($q) use ($search) {
                    if (Schema::hasColumn('business_units', 'name')) {
                        $q->orWhere('name', 'like', "%{$search}%");
                    }
                    if (Schema::hasColumn('business_units', 'code')) {
                        $q->orWhere('code', 'like', "%{$search}%");
                    }
                    if (Schema::hasColumn('business_units', 'business_unit_name')) {
                        $q->orWhere('business_unit_name', 'like', "%{$search}%");
                    }
                });
            }
    
            // Sorting
            if (Schema::hasColumn('business_units', 'name')) {
                $builder->orderBy('name');
            } elseif (Schema::hasColumn('business_units', 'business_unit_name')) {
                $builder->orderBy('business_unit_name');
            }
            $builder->orderBy('id');
    
            // Paginated response (explicit page support)
            $paginator = $builder->paginate($perPage, ['*'], 'page', $page)
                                ->appends($request->query());
    
            return response()->json([
                'status' => 'success',
                'data'   => BusinessUnitResource::collection($paginator->items()),
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
            \Log::error('Business Unit index unexpected error', ['error' => $e->getMessage()]);
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.',
                'error'   => app()->environment('local') ? $e->getMessage() : null,
            ], 500);
        }
    }
   

}
