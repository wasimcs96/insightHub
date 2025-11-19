<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\MasterSector;
use App\Resources\Api\V1\SectorResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use OpenApi\Annotations as OA;

class SectorController extends Controller
{
    /**
     * @OA\Get(
     *   path="/rest/v1/sectors",
     *   summary="List active sectors with sub-sectors",
     *   tags={"Sectors"},
     *   security={{"bearerAuth":{},"ApiKeyAuth":{}}},
     *
     *   @OA\Parameter(
     *     name="x-api-key", in="header", required=true,
     *     description="Project API Key",
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *     name="per_page", in="query",
     *     description="Items per page (default 50, max 200)",
     *     @OA\Schema(type="integer", minimum=1, maximum=200)
     *   ),
     *   @OA\Parameter(
     *     name="page", in="query",
     *     description="Page number (starts at 1)",
     *     @OA\Schema(type="integer", minimum=1)
     *   ),
     *   @OA\Parameter(
     *     name="q", in="query",
     *     description="Search by sector name",
     *     @OA\Schema(type="string")
     *   ),
     *
     *   @OA\Response(
     *     response=200, description="OK",
     *     @OA\JsonContent(type="object",
     *       @OA\Property(property="status", type="string", example="success"),
     *       @OA\Property(property="data", type="array",
     *         @OA\Items(type="object",
     *           @OA\Property(property="id", type="integer", example=1),
     *           @OA\Property(property="sector_name", type="string", example="Information Technology"),
     *           @OA\Property(property="sub_sectors", type="array",
     *             @OA\Items(type="object",
     *               @OA\Property(property="id", type="integer", example=101),
     *               @OA\Property(property="name", type="string", example="Software Development")
     *             )
     *           )
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
     * Get all active sectors with sub-sectors.
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
     * @queryParam q string optional The search term for filtering by sector name. Example: "Information Technology"
     *
     * @response 200 scenario="Success" {
     *   "status": "success",
     *   "data": [
     *     {
     *       "id": 1,
     *       "sector_name": "Information Technology",
     *       "sub_sectors": [
     *         { "id": 101, "name": "Software Development" },
     *         { "id": 102, "name": "Cybersecurity" },
     *         { "id": 103, "name": "Cloud Services" }
     *       ]
     *     },
     *     {
     *       "id": 2,
     *       "sector_name": "Construction",
     *       "sub_sectors": [
     *         { "id": 201, "name": "Engineering" },
     *         { "id": 202, "name": "Real Estate Development" }
     *       ]
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
     *   "message": "No sectors found"
     * }
    */

    public function index(Request $request)
    {
        try {
            $perPage = (int) min(max((int) $request->query('per_page', 50), 1), 200);
            $page    = max((int) $request->query('page', 1), 1);
            $search  = trim((string) $request->query('q', ''));

            $builder = MasterSector::query();

            // Eager load sub-sectors relationship
            $builder->with(['subSectors' => function ($query) {
                // Only load active sub-sectors if the column exists
                if (Schema::hasColumn('master_sub_sectors', 'is_active')) {
                    $query->where('is_active', 1);
                } elseif (Schema::hasColumn('master_sub_sectors', 'status')) {
                    $query->where('status', 'active');
                }
                $query->orderBy('name');
            }]);

            // Active filter for sectors
            if (Schema::hasColumn('master_sectors', 'is_active')) {
                $builder->where('is_active', 1);
            } elseif (Schema::hasColumn('master_sectors', 'status')) {
                $builder->where('status', 'active');
            }

            // Optional search on name
            if ($search !== '') {
                $builder->where(function ($q) use ($search) {
                    if (Schema::hasColumn('master_sectors', 'name')) {
                        $q->where('name', 'like', "%{$search}%");
                    }
                });
            }

            // Sort by name if present
            if (Schema::hasColumn('master_sectors', 'name')) {
                $builder->orderBy('name');
            }
            $builder->orderBy('id');

            // Paginated response
            $paginator = $builder->paginate($perPage, ['*'], 'page', $page)
                                 ->appends($request->query());

            return response()->json([
                'status' => 'success',
                'data'   => SectorResource::collection($paginator->items()),
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
            \Log::error('Sector index unexpected error', ['error' => $e->getMessage()]);
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong.',
                'error'   => app()->environment('local') ? $e->getMessage() : null,
            ], 500);
        }
    }
}