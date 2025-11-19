<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\{User, Role, Permission};
use App\Services\SSO\SsoVerifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Services\Api\V1\TenantPermissionService;
use Illuminate\Support\Facades\DB;


class SsoController extends Controller
{
    private TenantPermissionService $tenantPermissionService;

    public function __construct(TenantPermissionService $tenantPermissionService)
    {
        $this->tenantPermissionService = $tenantPermissionService;
    }

    public function callback(Request $request)
    {
        $token = (string) $request->query('token');
        abort_unless($token, 400, 'Missing token');
    
        $verifier = SsoVerifier::fromEnv();
        $claims = $verifier->verify($token);
    
        $email = $claims->email ?? null;
        $centralPortalId = (string) ($claims->sub ?? '');
        $tenantId = $claims->tenant_id ?? null;
    
        $user = $email ? User::where('email', $email)->first() : null;
    
        if ($user) {
            return $this->handleExistingUser($user, $claims, $email, $centralPortalId, $tenantId);
        } else {
            return $this->handleNewUser($claims, $email, $centralPortalId, $tenantId);
        }
    }
    
    private function handleExistingUser($user, $claims, $email, $centralPortalId, $tenantId)
    {
        Log::info("Existing SSO user found, updating permissions", [
            'user_id' => $user->id,
            'tenant_id' => $tenantId,
            'sub' => $centralPortalId,
            'email' => $email
        ]);
    
        try {
            DB::beginTransaction();
            
            $permissionData = $this->fetchUserPermissions($tenantId, $centralPortalId);
            if (!$permissionData) {
                DB::rollBack();
                Auth::login($user, true);
                return redirect()->intended(url('/admin/dashboard'));
            }
    
            $this->updateUserInfo($user, $claims, $email);
            $this->syncUserRoleAndPermissions($user, $permissionData, $tenantId);
    
            DB::commit();
            
            Log::info("Existing user permissions updated successfully", [
                'user_id' => $user->id,
                'role' => $permissionData['role']['name'],
                'permissions_count' => count($permissionData['permissions'])
            ]);
    
            Auth::login($user, true);
            return redirect()->intended(url('/admin/dashboard'));
    
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error updating existing user permissions", [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
            
            Auth::login($user, true);
            return redirect()->intended(url('/admin/dashboard'));
        }
    }
    
    private function handleNewUser($claims, $email, $centralPortalId, $tenantId)
    {
        if (!$tenantId || !$centralPortalId) {
            Log::warning("Missing required SSO parameters", [
                'tenant_id' => $tenantId,
                'sub' => $centralPortalId
            ]);
            return redirect()->back()->with('error', 'Missing required SSO parameters');
        }
    
        try {
            DB::beginTransaction();
            
            $permissionData = $this->fetchUserPermissions($tenantId, $centralPortalId);
            if (!$permissionData) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Failed to setup user permissions');
            }
    
            $user = $this->createNewUser($claims, $email, $centralPortalId, $tenantId);
            $this->syncUserRoleAndPermissions($user, $permissionData, $tenantId);
    
            DB::commit();
            
            Log::info("New user permissions processed successfully", [
                'user_id' => $user->id,
                'role' => $permissionData['role']['name'],
                'permissions_count' => count($permissionData['permissions'])
            ]);
    
            Auth::login($user, true);
            return redirect()->intended(url('/admin/dashboard'));
    
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Failed to create new SSO user", [
                'error' => $e->getMessage(),
                'tenant_id' => $tenantId,
                'sub' => $centralPortalId
            ]);
            return redirect()->back()->with('error', 'Failed to create user account');
        }
    }
    
    private function fetchUserPermissions($tenantId, $centralPortalId)
    {
        $data = $this->tenantPermissionService->getUserPermissions($tenantId, $centralPortalId);
        
        if (!$data['success'] || !isset($data['data'])) {
            Log::error("Failed to fetch permissions during SSO", [
                'tenant_id' => $tenantId,
                'sub' => $centralPortalId,
                'response' => $data
            ]);
            return null;
        }
    
        $responseData = $data['data'];
        
        if (!isset($responseData['role']['name']) || !isset($responseData['permissions'])) {
            Log::error("Invalid permissions data structure", [
                'tenant_id' => $tenantId,
                'sub' => $centralPortalId,
                'data' => $responseData
            ]);
            return null;
        }
    
        return $responseData;
    }
    
    private function updateUserInfo($user, $claims, $email)
    {
        $user->update([
            'name' => $claims->name ?? ($email ?: $user->name),
            'email' => $email ?: $user->email,
        ]);
    }
    
    private function createNewUser($claims, $email, $centralPortalId, $tenantId)
    {
        return User::create([
            'central_portal_user_id' => $centralPortalId,
            'tenant_id' => $tenantId,
            'name' => $claims->name ?? ($email ?: 'Portal User'),
            'email' => $email ?: null,
            'password' => Hash::make(Str::random(32)),
        ]);
    }
    
    private function syncUserRoleAndPermissions($user, $permissionData, $tenantId)
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    
        // Create or get the role
        $role = $this->createOrGetRole($permissionData['role']['name'], $tenantId);
        
        // Create or get permissions
        $permissions = $this->createOrGetPermissions($permissionData['permissions'], $tenantId);
        
        // Sync permissions with role
        $role->syncPermissions($permissions);
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    
        // Assign role to user
        $user->syncRoles([$role->name]);
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
    
    private function createOrGetRole($roleName, $tenantId)
    {
        $role = \Spatie\Permission\Models\Role::firstOrCreate(
            [
                'name' => $roleName,
                'guard_name' => 'web'
            ]
        );
    
        // Add tenant_id if needed and not already set
        if ($tenantId && !$role->tenant_id) {
            $role->update(['tenant_id' => $tenantId]);
        }
    
        return $role;
    }
    
    private function createOrGetPermissions($permissionsData, $tenantId)
    {
        $permissionNames = collect($permissionsData)->pluck('name')->toArray();
        $permissionModels = collect();
        
        foreach ($permissionNames as $permissionName) {
            $permission = \Spatie\Permission\Models\Permission::firstOrCreate(
                [
                    'name' => $permissionName,
                    'guard_name' => 'web'
                ]
            );
            
            // Add tenant_id if needed and not already set
            if ($tenantId && !$permission->tenant_id) {
                $permission->update(['tenant_id' => $tenantId]);
            }
            
            $permissionModels->push($permission);
        }
    
        return $permissionModels;
    }
}