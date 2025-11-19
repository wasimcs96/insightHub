<?php

namespace App\Http\Controllers\InsightHub;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsightHub\StoreRoleRequest;
use App\Http\Requests\InsightHub\UpdateRoleRequest;
use App\Services\InsightHub\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of roles
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 10);
            $search = $request->get('search');

            $roles = $this->roleService->getAllRoles($perPage, $search);
            
            // Check if it's an API request or AJAX request
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Roles retrieved successfully',
                    'data' => $roles
                ]);
            }

            return view('insighthub.settings.role-management.index', compact('roles'));
        } catch (\Exception $e) {
            Log::error('Error fetching roles: ' . $e->getMessage());
            
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to fetch roles',
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Failed to fetch roles');
        }
    }

    /**
     * Show the form for creating a new role
     */
    public function create()
    {
        try {
            $permissions = $this->roleService->getGroupedPermissions();
            return view('insighthub.settings.role-management.create', compact('permissions'));
        } catch (\Exception $e) {
            Log::error('Error loading create role page: ' . $e->getMessage());
            return back()->with('error', 'Failed to load create role page');
        }
    }

    /**
     * Store a newly created role
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            DB::beginTransaction();

            $role = $this->roleService->createRole(
                $request->validated()
            );

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'New role has been created successfully.',
                    'data' => $role
                ]);
            }

            return redirect()->route('insighthub.role-management.index')
                ->with('success', 'New role has been created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating role: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 422);
            }

            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified role
     */
    public function show($id)
    {
        try {
            $role = $this->roleService->getRoleWithDetails($id);
            $rolePermissions = $role->permissions->pluck('id')->toArray();
            $permissions = $this->roleService->getGroupedPermissions($rolePermissions);
            
            return view('insighthub.settings.role-management.view', compact('role', 'permissions', 'rolePermissions'));
        } catch (\Exception $e) {
            Log::error('Error viewing role: ' . $e->getMessage());
            return back()->with('error', 'Failed to load role details');
        }
    }

    /**
     * Show the form for editing the specified role
     */
    public function edit($id)
    {
        try {
            $role = $this->roleService->getRoleWithDetails($id);
            // Prevent editing system roles
            if ($role->is_system_role) {
                return back()->with('error', 'System roles cannot be edited');
            }

            $rolePermissions = $role->permissions->pluck('id')->toArray();
            $permissions = $this->roleService->getGroupedPermissions($rolePermissions);
            
            return view('insighthub.settings.role-management.edit', compact('role', 'permissions', 'rolePermissions'));
        } catch (\Exception $e) {
            Log::error('Error loading edit role page: ' . $e->getMessage());
            return back()->with('error', 'Failed to load edit role page');
        }
    }

    /**
     * Update the specified role
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $role = $this->roleService->updateRole($id, $request->validated());

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Role has been updated successfully.',
                    'data' => $role
                ]);
            }

            return redirect()->route('insighthub.role-management.index')
                ->with('success', 'Role has been updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating role: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 422);
            }

            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for duplicating a role
     */
    public function duplicate($id)
    {
        try {
            $sourceRole = $this->roleService->getRoleWithDetails($id);
            $rolePermissions = $sourceRole->permissions->pluck('id')->toArray();
            $permissions = $this->roleService->getGroupedPermissions($rolePermissions);
            
            // Prepare duplicated role data with " (Copy)" suffix
            $duplicatedRole = [
                'name' => $sourceRole->display_name . ' (Copy)',
                'description' => $sourceRole->description,
            ];
            
            return view('insighthub.settings.role-management.duplicate', compact('sourceRole', 'duplicatedRole', 'permissions', 'rolePermissions'));
        } catch (\Exception $e) {
            Log::error('Error loading duplicate role page: ' . $e->getMessage());
            return back()->with('error', 'Failed to load duplicate role page');
        }
    }

    /**
     * Store the duplicated role
     */
    public function storeDuplicate(StoreRoleRequest $request)
    {
        try {
            DB::beginTransaction();

            $role = $this->roleService->createRole($request->validated());

            DB::commit();

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Role has been duplicated successfully.',
                    'data' => $role
                ]);
            }

            return redirect()->route('insighthub.role-management.index')
                ->with('success', 'Role has been duplicated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error duplicating role: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 422);
            }

            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified role
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $this->roleService->deleteRole($id);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Role has been deleted successfully.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting role: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    /**
     * Check if role can be deleted
     */
    public function checkDeletable($id)
    {
        try {
            $result = $this->roleService->checkRoleDeletable($id);

            return response()->json([
                'success' => true,
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    /**
     * Get users for a specific role
     */
    public function getRoleUsers(Request $request, $id)
    {
        try {
            $perPage = $request->get('per_page', 10);
            $search = $request->get('search');

            $users = $this->roleService->getRoleUsers($id, $perPage, $search);

            return response()->json([
                'success' => true,
                'data' => $users
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching role users: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch role users'
            ], 500);
        }
    }

    /**
     * Assign a role to a user
     */
    public function assignRoleToUser(Request $request, $userId, $roleId)
    {
        try {
            DB::beginTransaction();

            $result = $this->roleService->assignRoleToUser($userId, $roleId);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Role has been assigned to user successfully.',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error assigning role to user: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
}