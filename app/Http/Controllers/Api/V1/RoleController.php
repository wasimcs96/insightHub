<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreRoleRequest;
use App\Http\Requests\Api\V1\UpdateRoleRequest;
use App\Services\Api\V1\RoleService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    public function __construct(
        private readonly RoleService $roleService
    ) {}

    /**
     * Display a listing of roles
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            // Get tenant_id from request header or parameter
            $tenantId = $request->header('x-tenant-id') ?? $request->get('tenant_id');
       
            if (!$tenantId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tenant ID is required',
                    'data' => null,
                    'meta' => null
                ], 400);
            }

            $perPage = $request->get('per_page', 10);
            $search = $request->get('search');

            $roles = $this->roleService->getAllRoles($tenantId, $perPage, $search);

            return response()->json([
                'status' => 'success',
                'data' => $roles->items(),
                'meta' => [
                    'pagination' => [
                        'total' => $roles->total(),
                        'per_page' => $roles->perPage(),
                        'current_page' => $roles->currentPage(),
                        'last_page' => $roles->lastPage(),
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('API: Error fetching roles', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch roles',
                'data' => null,
                'meta' => null,
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], 500);
        }
    }

    /**
     * Store a newly created role
     * 
     * @param StoreRoleRequest $request
     * @return JsonResponse
     */
    public function store(StoreRoleRequest $request): JsonResponse
    {
        try {
            // Get tenant_id from request header or parameter
            $tenantId = $request->header('x-tenant-id') ?? $request->get('tenant_id');
            
            if (!$tenantId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tenant ID is required',
                    'data' => null,
                    'meta' => null
                ], 400);
            }

            DB::beginTransaction();

            $role = $this->roleService->createRole($tenantId, $request->validated());

            DB::commit();

            return response()->json([
                'status' => 'success',
                'data' => $role,
                'meta' => null
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('API: Error creating role', [
                'error' => $e->getMessage(),
                'data' => $request->validated()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null,
                'meta' => null
            ], 422);
        }
    }

    /**
     * Display the specified role
     * 
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function show(Request $request, int $id): JsonResponse
    {
        try {
            // Get tenant_id from request header or parameter
            $tenantId = $request->header('x-tenant-id') ?? $request->get('tenant_id');
            
            if (!$tenantId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tenant ID is required',
                    'data' => null,
                    'meta' => null
                ], 400);
            }

            $role = $this->roleService->getRoleWithDetails($tenantId, $id);

            return response()->json([
                'status' => 'success',
                'data' => $role,
                'meta' => null
            ]);
        } catch (\Exception $e) {
            Log::error('API: Error fetching role details', [
                'role_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Role not found',
                'data' => null,
                'meta' => null
            ], 404);
        }
    }

    /**
     * Update the specified role
     * 
     * @param UpdateRoleRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateRoleRequest $request, int $id): JsonResponse
    {
        try {
            // Get tenant_id from request header or parameter
            $tenantId = $request->header('x-tenant-id') ?? $request->get('tenant_id');
            
            if (!$tenantId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tenant ID is required',
                    'data' => null,
                    'meta' => null
                ], 400);
            }

            DB::beginTransaction();

            $role = $this->roleService->updateRole($tenantId, $id, $request->validated());

            DB::commit();

            return response()->json([
                'status' => 'success',
                'data' => $role,
                'meta' => null
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('API: Error updating role', [
                'role_id' => $id,
                'error' => $e->getMessage(),
                'data' => $request->validated()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null,
                'meta' => null
            ], 422);
        }
    }

    /**
     * Remove the specified role
     * 
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(Request $request, int $id): JsonResponse
    {
        try {
            // Get tenant_id from request header or parameter
            $tenantId = $request->header('x-tenant-id') ?? $request->get('tenant_id');
            
            if (!$tenantId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tenant ID is required',
                    'data' => null,
                    'meta' => null
                ], 400);
            }

            DB::beginTransaction();

            $this->roleService->deleteRole($tenantId, $id);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'data' => [
                    'message' => 'Role deleted successfully'
                ],
                'meta' => null
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('API: Error deleting role', [
                'role_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null,
                'meta' => null
            ], 422);
        }
    }

    /**
     * Get users for a specific role
     * 
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function users(Request $request, int $id): JsonResponse
    {
        try {
            // Get tenant_id from request header or parameter
            $tenantId = $request->header('x-tenant-id') ?? $request->get('tenant_id');
            
            if (!$tenantId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tenant ID is required',
                    'data' => null,
                    'meta' => null
                ], 400);
            }

            $perPage = $request->get('per_page', 10);
            $search = $request->get('search');

            $users = $this->roleService->getRoleUsers($tenantId, $id, $perPage, $search);

            return response()->json([
                'status' => 'success',
                'data' => $users->items(),
                'meta' => [
                    'pagination' => [
                        'total' => $users->total(),
                        'per_page' => $users->perPage(),
                        'current_page' => $users->currentPage(),
                        'last_page' => $users->lastPage(),
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('API: Error fetching role users', [
                'role_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch role users',
                'data' => null,
                'meta' => null
            ], 500);
        }
    }

    /**
     * Assign role to user
     * 
     * @param Request $request
     * @param int $roleId
     * @param int $userId
     * @return JsonResponse
     */
    public function assignToUser(Request $request, int $roleId, int $userId): JsonResponse
    {
        try {
            // Get tenant_id from request header or parameter
            $tenantId = $request->header('x-tenant-id') ?? $request->get('tenant_id');
            
            if (!$tenantId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tenant ID is required',
                    'data' => null,
                    'meta' => null
                ], 400);
            }

            DB::beginTransaction();

            $result = $this->roleService->assignRoleToUser($tenantId, $userId, $roleId);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'data' => $result,
                'meta' => null
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('API: Error assigning role to user', [
                'role_id' => $roleId,
                'user_id' => $userId,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null,
                'meta' => null
            ], 422);
        }
    }

    /**
     * Check if role is deletable
     * 
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function checkDeletable(Request $request, int $id): JsonResponse
    {
        try {
            // Get tenant_id from request header or parameter
            $tenantId = $request->header('x-tenant-id') ?? $request->get('tenant_id');
            
            if (!$tenantId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tenant ID is required',
                    'data' => null,
                    'meta' => null
                ], 400);
            }

            $result = $this->roleService->checkRoleDeletable($tenantId, $id);

            return response()->json([
                'status' => 'success',
                'data' => $result,
                'meta' => null
            ]);
        } catch (\Exception $e) {
            Log::error('API: Error checking role deletable status', [
                'role_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => null,
                'meta' => null
            ], 422);
        }
    }

    /**
     * Get grouped permissions for role creation/editing
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function permissions(Request $request): JsonResponse
    {
        try {
            // Get tenant_id from request header or parameter
            $tenantId = $request->header('x-tenant-id') ?? $request->get('tenant_id');
            
            if (!$tenantId) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tenant ID is required',
                    'data' => null,
                    'meta' => null
                ], 400);
            }

            $permissions = $this->roleService->getGroupedPermissions($tenantId);

            return response()->json([
                'status' => 'success',
                'data' => $permissions,
                'meta' => null
            ]);
        } catch (\Exception $e) {
            Log::error('API: Error fetching permissions', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to fetch permissions',
                'data' => null,
                'meta' => null
            ], 500);
        }
    }
}
