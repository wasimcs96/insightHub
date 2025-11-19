<?php

namespace App\Services\InsightHub;

use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use App\Models\TenantPlan;
use App\Models\PlanModule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RoleService
{
    /**
     * Get all roles with pagination
     */
    public function getAllRoles($perPage = 10, $search = null)
    {
        $query = Role::where('tenant_id', Auth::user()->tenant_id)
                 ->where('is_system_role', 0)
            ->withCount('users');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('display_name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        return $query->orderBy('is_default', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get role with detailed information
     */
    public function getRoleWithDetails($id)
    {
        $role = Role::where('tenant_id', Auth::user()->tenant_id)
            ->with(['permissions', 'users'])
            ->withCount('users')
            ->findOrFail($id);

        return $role;
    }

    /**
     * Get grouped permissions by module and section
     * 
     * @param array $rolePermissions Array of permission IDs to mark as checked
     */
    public function getGroupedPermissions($rolePermissions = [])
    {
        $tenantPurchasedPlan = TenantPlan::where('tenant_id', Auth::user()->tenant_id)
                        ->latest() // defaults to 'created_at' column
                        ->first();
        $moduleIds = PlanModule::where('plan_id', $tenantPurchasedPlan->plan_id)->pluck('module_id')->toArray();

        $permissions = Permission::with('module')
            ->whereIn('module_id', $moduleIds)
            ->where('is_system_permission', 1)
            ->orderBy('module_id')
            ->orderBy('section')
            ->orderBy('name')
            ->get();

        // Group permissions by module and section
        $grouped = [];
        
        foreach ($permissions as $permission) {
            $moduleName = $permission->module->name ?? 'Other';
            $section = $permission->section ?? 'General';
            
            if (!isset($grouped[$moduleName])) {
                $grouped[$moduleName] = [
                    'module' => $moduleName,
                    'enabled' => true,
                    'all_checked' => false,
                    'sections' => []
                ];
            }

            if (!isset($grouped[$moduleName]['sections'][$section])) {
                $grouped[$moduleName]['sections'][$section] = [
                    'name' => $section,
                    'enabled' => true,
                    'all_checked' => false,
                    'permissions' => []
                ];
            }

            $grouped[$moduleName]['sections'][$section]['permissions'][] = $permission;
        }

        // Calculate all_checked status if rolePermissions provided
        if (!empty($rolePermissions)) {
            foreach ($grouped as $moduleName => &$module) {
                $moduleAllChecked = true;
                
                foreach ($module['sections'] as $sectionName => &$section) {
                    $sectionAllChecked = true;
                    
                    foreach ($section['permissions'] as $permission) {
                        if (!in_array($permission->id, $rolePermissions)) {
                            $sectionAllChecked = false;
                            $moduleAllChecked = false;
                        }
                    }
                    
                    $section['all_checked'] = $sectionAllChecked && count($section['permissions']) > 0;
                }
                
                $module['all_checked'] = $moduleAllChecked;
            }
        }

        return array_values($grouped);
    }

    /**
     * Create a new role
     */
    public function createRole(array $data)
    {
        // Check if role name already exists
        $existingRole = Role::where('tenant_id', Auth::user()->tenant_id)
            ->where('name', $data['name'])
            ->first();

        if ($existingRole) {
            throw new \Exception('Role already exists.');
        }

        // Create role
        $role = Role::create([
            'tenant_id' => Auth::user()->tenant_id,
            'name' => $data['name'],
            'display_name' => $data['name'],
            'description' => $data['description'] ?? null,
            'guard_name' => 'web',
            'is_system_role' => 0,
            'is_default' => 0,
            'level' => 0
        ]);

        // Sync permissions
        if (isset($data['permissions']) && is_array($data['permissions'])) {
            $role->permissions()->sync($data['permissions']);
        }

        return $role->load('permissions');
    }

    /**
     * Update an existing role
     */
    public function updateRole($id, array $data)
    {
        $role = Role::where('tenant_id', Auth::user()->tenant_id)
            ->findOrFail($id);

        // Prevent updating system roles
        if ($role->is_system_role) {
            throw new \Exception('System roles cannot be updated.');
        }

        // Check if new name already exists (excluding current role)
        if (isset($data['name']) && $data['name'] !== $role->name) {
            $existingRole = Role::where('tenant_id', Auth::user()->tenant_id)
                ->where('name', $data['name'])
                ->where('id', '!=', $id)
                ->first();

            if ($existingRole) {
                throw new \Exception('Role already exists.');
            }
        }

        // Update role
        $role->update([
            'name' => $data['name'] ?? $role->name,
            'display_name' => $data['name'] ?? $role->display_name,
            'description' => $data['description'] ?? $role->description,
        ]);

        // Sync permissions
        if (isset($data['permissions']) && is_array($data['permissions'])) {
            $role->permissions()->sync($data['permissions']);
        }

        return $role->load('permissions');
    }

    /**
     * Delete a role
     */
    public function deleteRole($id)
    {
        $role = Role::where('tenant_id', Auth::user()->tenant_id)
            ->withCount('users')
            ->findOrFail($id);

        // Prevent deleting default/system roles
        if ($role->is_default || $role->is_system_role) {
            throw new \Exception('Default roles cannot be deleted.');
        }

        // Check if role has users assigned
        if ($role->users_count > 0) {
            throw new \Exception('Cannot delete role. Please remove all users from this role first.');
        }

        $role->delete();

        return true;
    }

    /**
     * Check if role can be deleted
     */
    public function checkRoleDeletable($id)
    {
        $role = Role::where('tenant_id', Auth::user()->tenant_id)
            ->withCount('users')
            ->findOrFail($id);

        $deletable = true;
        $message = '';
        $tooltip = '';

        // Check if it's a default/system role
        if ($role->is_default || $role->is_system_role) {
            $deletable = false;
            $message = 'Default roles cannot be deleted.';
            $tooltip = 'Unable to delete role';
        }
        // Check if role has users
        elseif ($role->users_count > 0) {
            $deletable = false;
            $message = 'Cannot delete role. Please remove all users from this role first.';
            $tooltip = 'Cannot delete role. Please remove all users from this role first.';
        }

        return [
            'deletable' => $deletable,
            'message' => $message,
            'tooltip' => $tooltip,
            'users_count' => $role->users_count,
            'is_default' => $role->is_default || $role->is_system_role
        ];
    }

    /**
     * Get users for a specific role
     */
    public function getRoleUsers($roleId, $perPage = 10, $search = null)
    {
        $role = Role::where('tenant_id', Auth::user()->tenant_id)
            ->findOrFail($roleId);

        $query = $role->users();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return $query->select(['id', 'name', 'email', 'created_at'])
            ->paginate($perPage);
    }

    /**
     * Assign a role to a user
     */
    public function assignRoleToUser($userId, $roleId)
    {
        // Validate user belongs to the same tenant
        $user = User::where('id', $userId)
            ->where('tenant_id', Auth::user()->tenant_id)
            ->firstOrFail();

        // Validate role belongs to the same tenant
        $role = Role::where('id', $roleId)
            ->where('tenant_id', Auth::user()->tenant_id)
            ->firstOrFail();

        // Check if user already has this role
        if ($user->roles()->where('role_id', $roleId)->exists()) {
            throw new \Exception('User already has this role assigned.');
        }

        // Update the role_id column in users table
        $user->update(['role_id' => $roleId]);

        // Assign the role (for many-to-many relationship if exists)
        $user->roles()->attach($roleId);

        return [
            'user' => $user->load('roles'),
            'role' => $role
        ];
    }

    /**
     * Get default roles for seeding
     */
    public static function getDefaultRoles()
    {
        return [
            [
                'name' => 'super-admin',
                'display_name' => 'Super Admin',
                'description' => 'Full system access with all permissions',
                'is_default' => 0,
                'is_system_role' => 1,
                'level' => 1
            ],
            [
                'name' => 'admin',
                'display_name' => 'Admin',
                'description' => 'Full system access with all permissions',
                'is_default' => 0,
                'is_system_role' => 1,
                'level' => 1
            ],
            [
                'name' => 'admin-view',
                'display_name' => 'Admin',
                'description' => 'Full system access with all view permissions',
                'is_default' => 0,
                'is_system_role' => 1,
                'level' => 2
            ],
            [
                'name' => 'head-of-division',
                'display_name' => 'Head of Division',
                'description' => 'Division-level management access',
                'is_default' => 1,
                'is_system_role' => 0,
                'level' => 3
            ],
            [
                'name' => 'head-of-department',
                'display_name' => 'Head of Department',
                'description' => 'Department-level management access',
                'is_default' => 1,
                'is_system_role' => 0,
                'level' => 3
            ],
            [
                'name' => 'employee',
                'display_name' => 'Employee',
                'description' => 'Basic employee access',
                'is_default' => 1,
                'is_system_role' => 0,
                'level' => 4
            ]
        ];
    }
}