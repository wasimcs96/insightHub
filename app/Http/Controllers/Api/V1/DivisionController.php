<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Division; 
use App\Resources\Api\V1\DivisionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use OpenApi\Annotations as OA;

class DivisionController extends Controller
{
    /**
     * Get all active divisions.
     *
     * Requires an API key in the header.
     *
     * @group Company Structure
     * @authenticated
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @queryParam per_page integer optional The number of items per page (default 50, max 200). Example: 50
     * @queryParam page integer optional The page number (starts at 1). Example: 1
     * @queryParam q string optional The search term for filtering by name. Example: "Corporate Services"
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "Corporate Services",
     *       "business_unit": "CORP"
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
     *   "message": "No divisions found"
     * }
    */

    public function index(Request $request)
    {
        try {
            $paginate = filter_var($request->query('paginate', true), FILTER_VALIDATE_BOOLEAN);
            $perPage  = (int) min(max((int) $request->query('per_page', 50), 1), 200);
            $page     = max((int) $request->query('page', 1), 1); 
            $search   = trim((string) $request->query('q', ''));
        
            $builder = Division::query();
        
            // Active filter: supports is_active=1 or status='active'
            if (Schema::hasColumn('divisions', 'is_active')) {
                $builder->where('is_active', 1);
            } elseif (Schema::hasColumn('divisions', 'status')) {
                $builder->where('status', 'active');
            }
        
            // Optional search on name/code/head_of_division (if columns exist)
            if ($search !== '') {
                $builder->where(function ($q) use ($search) {
                    if (Schema::hasColumn('divisions', 'name')) {
                        $q->orWhere('name', 'like', "%{$search}%");
                    }
                    if (Schema::hasColumn('divisions', 'code')) {
                        $q->orWhere('code', 'like', "%{$search}%");
                    }
                    if (Schema::hasColumn('divisions', 'head_of_division')) {
                        $q->orWhere('head_of_division', 'like', "%{$search}%");
                    }
                });
            }
        
            // Sort by name if present, else head_of_division, then id
            if (Schema::hasColumn('divisions', 'name')) {
                $builder->orderBy('name');
            } elseif (Schema::hasColumn('divisions', 'head_of_division')) {
                $builder->orderBy('head_of_division');
            }
            $builder->orderBy('id');
        
            // Paginated response (explicit page support)
            $paginator = $builder->paginate($perPage, ['*'], 'page', $page)
                                 ->appends($request->query());
        
            return response()->json([
                'status' => 'success',
                'data'   => DivisionResource::collection($paginator->items()),
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
           \Log::error('Division index unexpected error', ['error' => $e->getMessage()]);
           return response()->json([
               'status'  => 'error',
               'message' => 'Something went wrong.',
               'error'   => app()->environment('local') ? $e->getMessage() : null,
           ], 500);
       }
    }
     
}
