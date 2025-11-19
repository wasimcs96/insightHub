<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Permission\Contracts\Permission as PermissionContract;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permission extends SpatiePermission implements PermissionContract
{
    use BelongsToTenant;

    protected $guard_name = 'web';

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'guard_name',
        'tenant_id',
        'display_name',
        'description',
        'category',
        'is_system_permission'
    ];

    protected $casts = [
        'tenant_id' => 'integer',
        'is_system_permission' => 'boolean',
    ];

    // Permission categories
    public static $categories = [
        'user_management' => 'User Management',
        'role_management' => 'Role Management',
        'department_management' => 'Department Management',
        'job_management' => 'Job Management',
        'recruitment' => 'Recruitment',
        'reporting' => 'Reporting',
        'settings' => 'Settings',
        'api_access' => 'API Access'
    ];

    // System permissions (available to all tenants)
    public static $systemPermissions = [
        // User Management
        'users.view' => 'View Users',
        'users.create' => 'Create Users',
        'users.edit' => 'Edit Users',
        'users.delete' => 'Delete Users',
        'users.export' => 'Export Users',
        'users.import' => 'Import Users',
        
        // Role Management
        'roles.view' => 'View Roles',
        'roles.create' => 'Create Roles',
        'roles.edit' => 'Edit Roles',
        'roles.delete' => 'Delete Roles',
        'roles.assign' => 'Assign Roles',
        
        // Department Management
        'departments.view' => 'View Departments',
        'departments.create' => 'Create Departments',
        'departments.edit' => 'Edit Departments',
        'departments.delete' => 'Delete Departments',
        
        // Job Management
        'jobs.view' => 'View Jobs',
        'jobs.create' => 'Create Jobs',
        'jobs.edit' => 'Edit Jobs',
        'jobs.delete' => 'Delete Jobs',
        'jobs.publish' => 'Publish Jobs',
        
        // Recruitment
        'applications.view' => 'View Applications',
        'applications.review' => 'Review Applications',
        'applications.interview' => 'Conduct Interviews',
        'applications.hire' => 'Hire Candidates',
        
        // Reporting
        'reports.view' => 'View Reports',
        'reports.create' => 'Create Reports',
        'reports.export' => 'Export Reports',
        
        // Settings
        'settings.view' => 'View Settings',
        'settings.edit' => 'Edit Settings',
        'settings.system' => 'System Settings',
        
        // API Access
        'api.access' => 'API Access',
        'api.read' => 'API Read Access',
        'api.write' => 'API Write Access'
    ];

    /**
     * Override Spatie's method to include tenant_id in uniqueness check
     */
    public static function findByName(string $name, $guardName = null, $tenantId = null): PermissionContract
    {
        $guardName = $guardName ?? config('auth.defaults.guard');

        $query = static::where('name', $name)->where('guard_name', $guardName);
        
        if ($tenantId !== null) {
            $query->where('tenant_id', $tenantId);
        }

        $permission = $query->first();

        if (!$permission) {
            throw PermissionAlreadyExists::create($name, $guardName);
        }

        return $permission;
    }

    /**
     * Override Spatie's method to include tenant_id
     */
    public static function findOrCreate(string $name, $guardName = null, $tenantId = null): PermissionContract
    {
        $guardName = $guardName ?? config('auth.defaults.guard');

        $query = static::where('name', $name)->where('guard_name', $guardName);
        
        if ($tenantId !== null) {
            $query->where('tenant_id', $tenantId);
        }

        $permission = $query->first();

        if (!$permission) {
            return static::create([
                'name' => $name,
                'guard_name' => $guardName,
                'tenant_id' => $tenantId,
            ]);
        }

        return $permission;
    }

    /**
     * Override create to handle tenant-specific validation
     */
    public static function create(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? config('auth.defaults.guard');
        $tenantId = $attributes['tenant_id'] ?? null;

        // Check if permission exists for this specific tenant
        $exists = static::where('name', $attributes['name'])
            ->where('guard_name', $attributes['guard_name'])
            ->where('tenant_id', $tenantId)
            ->exists();

        if ($exists) {
            // Return existing permission instead of throwing exception
            return static::where('name', $attributes['name'])
                ->where('guard_name', $attributes['guard_name'])
                ->where('tenant_id', $tenantId)
                ->first();
        }

        // Clear cache before creating
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return static::query()->create($attributes);
    }

    /**
     * Get the sections for the permission.
     */
    public function sections()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }

    /**
     * Tenant relationship
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function scopeForTenant($query, int $tenantId)
    {
        return $query->where('tenant_id', $tenantId);
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function scopeSystemPermissions($query)
    {
        return $query->where('is_system_permission', true);
    }

    public function scopeCustomPermissions($query)
    {
        return $query->where('is_system_permission', false);
    }

    public function isSystemPermission(): bool
    {
        return $this->is_system_permission;
    }

    public function getDisplayNameAttribute($value): string
    {
        return $value ?: ucwords(str_replace(['.', '_'], ' ', $this->name));
    }
}