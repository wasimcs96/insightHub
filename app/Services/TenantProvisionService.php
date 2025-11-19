<?php

namespace App\Services;

use App\Events\TenantProvisioned;
use App\Models\Module;
use App\Models\Permission;
use App\Models\Plan;
use App\Models\Role;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TenantProvisionService
{
    /**
     * Provision a new tenant with complete setup
     *
     * @param array $tenantData
     * @param int $planId
     * @param array $adminUserData
     * @return array
     * @throws \Exception
     */
    public function provision(array $tenantData, int $planId, array $adminUserData): array
    {
        Log::info('Starting tenant provisioning', [
            'tenant_name' => $tenantData['name'],
            'plan_id' => $planId,
            'admin_email' => $adminUserData['email']
        ]);

        return DB::transaction(function () use ($tenantData, $planId, $adminUserData) {
            try {
                // Step 1: Validate parent tenant if subsidiary
                if (!empty($tenantData['parent_tenant_id'])) {
                    $this->validateParentTenant($tenantData['parent_tenant_id']);
                }

                // Step 2: Create tenant
                $tenant = $this->createTenant($tenantData);
                Log::info('Tenant created', ['tenant_id' => $tenant->id]);

                // Step 3: Assign subscription plan
                $this->assignSubscriptionPlan($tenant, $planId);
                Log::info('Subscription plan assigned', ['tenant_id' => $tenant->id, 'plan_id' => $planId]);

                // Step 4: Get plan and modules
                $plan = Plan::with('modules')->findOrFail($planId);
                $moduleIds = $plan->modules->pluck('id')->toArray();
                Log::info('Retrieved plan modules', ['tenant_id' => $tenant->id, 'module_count' => count($moduleIds)]);

                // Step 5: Create default roles for tenant
                $roles = $this->createDefaultRoles($tenant);
                Log::info('Default roles created', ['tenant_id' => $tenant->id, 'role_count' => count($roles)]);

                // Step 6: Fetch and assign permissions
                $permissions = $this->getSystemPermissionsForModules($moduleIds);
                Log::info('Retrieved system permissions', ['tenant_id' => $tenant->id, 'permission_count' => count($permissions)]);

                $this->assignPermissionsToRoles($roles, $permissions);
                Log::info('Permissions assigned to roles', ['tenant_id' => $tenant->id]);

                // Step 7: Generate password for admin user
                $generatedPassword = $this->generateSecurePassword();

                // Step 8: Create admin user
                $adminUser = $this->createAdminUser($tenant, $adminUserData, $generatedPassword, $roles);
                Log::info('Admin user created', ['tenant_id' => $tenant->id, 'user_id' => $adminUser->id]);

                // Step 9: Dispatch event for email notification
                event(new TenantProvisioned($tenant, $adminUser, $generatedPassword));
                Log::info('TenantProvisioned event dispatched', ['tenant_id' => $tenant->id]);

                Log::info('Tenant provisioning completed successfully', [
                    'tenant_id' => $tenant->id,
                    'tenant_name' => $tenant->name
                ]);

                return [
                    'success' => true,
                    'tenant' => $tenant->fresh(['parent', 'plans', 'roles']),
                    'admin_user' => $adminUser->fresh(['tenant', 'role']),
                    'message' => 'Tenant provisioned successfully. Credentials have been sent to the admin email.'
                ];
            } catch (\Exception $e) {
                Log::error('Tenant provisioning failed', [
                    'tenant_name' => $tenantData['name'] ?? 'unknown',
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                throw $e;
            }
        });
    }

    /**
     * Validate that parent tenant exists and is active
     *
     * @param int $parentTenantId
     * @return void
     * @throws \Exception
     */
    protected function validateParentTenant(int $parentTenantId): void
    {
        $parentTenant = Tenant::find($parentTenantId);

        if (!$parentTenant) {
            throw new \Exception('Parent tenant not found.');
        }

        if ($parentTenant->status !== 'active') {
            throw new \Exception('Parent tenant must be active.');
        }

        Log::info('Parent tenant validated', [
            'parent_tenant_id' => $parentTenantId,
            'parent_tenant_name' => $parentTenant->name
        ]);
    }

    /**
     * Create a new tenant
     *
     * @param array $data
     * @return Tenant
     */
    protected function createTenant(array $data): Tenant
    {
        $tenantData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'domain' => $data['domain'],
            'subdomain' => $data['subdomain'] ?? null,
            'country' => $data['country'],
            'address' => $data['address'],
            'industry' => $data['industry'],
            'contact_person_name' => $data['contact_person_name'],
            'mobile_number' => $data['mobile_number'] ?? null,
            'status' => $data['status'] ?? 'active',
            'parent_tenant_id' => $data['parent_tenant_id'] ?? null,
            'slug' => $this->generateUniqueSlug($data['name']),
            'settings' => $data['settings'] ?? null,
            'trial_ends_at' => $data['trial_ends_at'] ?? now()->addDays(30),
        ];

        return Tenant::create($tenantData);
    }

    /**
     * Generate a unique slug for the tenant
     *
     * @param string $name
     * @return string
     */
    protected function generateUniqueSlug(string $name): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (Tenant::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Assign subscription plan to tenant
     *
     * @param Tenant $tenant
     * @param int $planId
     * @return void
     */
    protected function assignSubscriptionPlan(Tenant $tenant, int $planId): void
    {
        $tenant->plans()->attach($planId, [
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Create default roles for the tenant by copying system roles
     *
     * @param Tenant $tenant
     * @return array
     */
    protected function createDefaultRoles(Tenant $tenant): array
    {
        // Fetch system roles
        $systemRoles = Role::where('is_system_role', 1)
            ->where('tenant_id', null)
            ->get();

        $createdRoles = [];

        foreach ($systemRoles as $systemRole) {
            $newRole = Role::create([
                'tenant_id' => $tenant->id,
                'name' => $systemRole->name,
                'display_name' => $systemRole->display_name,
                'guard_name' => $systemRole->guard_name,
                'description' => $systemRole->description,
                'is_system_role' => 0, // Not a system role anymore, it's tenant-specific
                'is_default' => $systemRole->is_default,
                'level' => $systemRole->level,
            ]);

            $createdRoles[] = $newRole;

            Log::debug('Role created for tenant', [
                'tenant_id' => $tenant->id,
                'role_id' => $newRole->id,
                'role_name' => $newRole->name
            ]);
        }

        return $createdRoles;
    }

    /**
     * Get system permissions for the given modules
     *
     * @param array $moduleIds
     * @return \Illuminate\Support\Collection
     */
    protected function getSystemPermissionsForModules(array $moduleIds)
    {
        return Permission::where('is_system_permission', 1)
            ->whereIn('module_id', $moduleIds)
            ->get();
    }

    /**
     * Assign permissions to roles
     *
     * @param array $roles
     * @param \Illuminate\Support\Collection $permissions
     * @return void
     */
    protected function assignPermissionsToRoles(array $roles, $permissions): void
    {
        $permissionIds = $permissions->pluck('id')->toArray();

        if (empty($permissionIds)) {
            Log::warning('No permissions to assign to roles');
            return;
        }

        // Prepare bulk insert data
        $rolePermissions = [];
        $timestamp = now();

        foreach ($roles as $role) {
            // Assign all permissions to default roles
            if ($role->is_default) {
                foreach ($permissionIds as $permissionId) {
                    $rolePermissions[] = [
                        'role_id' => $role->id,
                        'permission_id' => $permissionId,
                    ];
                }

                Log::debug('Permissions assigned to role', [
                    'role_id' => $role->id,
                    'role_name' => $role->name,
                    'permission_count' => count($permissionIds)
                ]);
            }
        }

        // Bulk insert for performance
        if (!empty($rolePermissions)) {
            DB::table('role_has_permissions')->insert($rolePermissions);
            Log::info('Bulk insert of role permissions completed', [
                'total_records' => count($rolePermissions)
            ]);
        }
    }

    /**
     * Generate a secure random password
     *
     * @param int $length
     * @return string
     */
    protected function generateSecurePassword(int $length = 12): string
    {
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $specialChars = '!@#$%^&*';

        $password = '';
        $password .= $uppercase[rand(0, strlen($uppercase) - 1)];
        $password .= $lowercase[rand(0, strlen($lowercase) - 1)];
        $password .= $numbers[rand(0, strlen($numbers) - 1)];
        $password .= $specialChars[rand(0, strlen($specialChars) - 1)];

        $allChars = $uppercase . $lowercase . $numbers . $specialChars;
        for ($i = 4; $i < $length; $i++) {
            $password .= $allChars[rand(0, strlen($allChars) - 1)];
        }

        return str_shuffle($password);
    }

    /**
     * Create admin user for the tenant
     *
     * @param Tenant $tenant
     * @param array $data
     * @param string $password
     * @param array $roles
     * @return User
     */
    protected function createAdminUser(Tenant $tenant, array $data, string $password, array $roles): User
    {
        // Find the admin role (assuming it's marked as default and has highest level or specific name)
        $adminRole = collect($roles)->first(function ($role) {
            return $role->is_default && (
                str_contains(strtolower($role->name), 'admin') ||
                str_contains(strtolower($role->display_name), 'admin')
            );
        });

        // If no admin role found, use the first default role
        if (!$adminRole) {
            $adminRole = collect($roles)->first(fn($role) => $role->is_default);
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile_number' => $data['mobile_number'] ?? null,
            'password' => Hash::make($password),
            'tenant_id' => $tenant->id,
            'role_id' => $adminRole ? $adminRole->id : null,
            'is_admin' => 1,
            'email_verified_at' => now(),
        ]);

        // Assign role using Spatie if role exists
        if ($adminRole) {
            $user->assignRole($adminRole);
        }

        return $user;
    }
}
