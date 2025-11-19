<?php

namespace App\Models;

use App\Traits\BelongsToTenant;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Contracts\Role as RoleContract;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Role extends SpatieRole implements RoleContract
{
    use BelongsToTenant;

    protected $guard_name = 'web';
    
    static $admin = 'admin';
    static $employee = 'employee';
    static $department = 'department';
    static $company = 'company';

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'guard_name',
        'tenant_id',
        'display_name',
        'description',
        'is_system_role',
        'level',
        'is_admin'
    ];

    protected $casts = [
        'tenant_id' => 'integer',
        'is_system_role' => 'boolean',
        'is_admin' => 'boolean',
        'level' => 'integer'
    ];

    // System roles that exist across all tenants
    public static $systemRoles = [
        'super-admin' => 'Super Administrator',
        'tenant-admin' => 'Tenant Administrator'
    ];

    // Default tenant roles
    public static $tenantRoles = [
        'admin' => 'Administrator',
        'company-admin' => 'Company Administrator',
        'department-manager' => 'Department Manager',
        'hr-manager' => 'HR Manager',
        'talent-acquisition' => 'Talent Acquisition',
        'employee' => 'Employee',
        'contractor' => 'Contractor'
    ];

    // Role hierarchy levels
    public static $roleLevels = [
        'super-admin' => 100,
        'tenant-admin' => 90,
        'admin' => 80,
        'company-admin' => 70,
        'department-manager' => 60,
        'hr-manager' => 50,
        'talent-acquisition' => 40,
        'employee' => 30,
        'contractor' => 20
    ];

    /**
     * Override Spatie's method to include tenant_id in uniqueness check
     */
    public static function findByName(string $name, $guardName = null, $tenantId = null): RoleContract
    {
        $guardName = $guardName ?? config('auth.defaults.guard');

        $query = static::where('name', $name)->where('guard_name', $guardName);
        
        if ($tenantId !== null) {
            $query->where('tenant_id', $tenantId);
        }

        $role = $query->first();

        if (!$role) {
            throw RoleAlreadyExists::named($name);
        }

        return $role;
    }

    /**
     * Override Spatie's method to include tenant_id
     */
    public static function findOrCreate(string $name, $guardName = null, $tenantId = null): RoleContract
    {
        $guardName = $guardName ?? config('auth.defaults.guard');

        $query = static::where('name', $name)->where('guard_name', $guardName);
        
        if ($tenantId !== null) {
            $query->where('tenant_id', $tenantId);
        }

        $role = $query->first();

        if (!$role) {
            return static::create([
                'name' => $name,
                'guard_name' => $guardName,
                'tenant_id' => $tenantId,
            ]);
        }

        return $role;
    }

    /**
     * Override create to handle tenant-specific validation
     */
    public static function create(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? config('auth.defaults.guard');
        $tenantId = $attributes['tenant_id'] ?? null;

        // Check if role exists for this specific tenant
        $exists = static::where('name', $attributes['name'])
            ->where('guard_name', $attributes['guard_name'])
            ->where('tenant_id', $tenantId)
            ->exists();

        if ($exists) {
            // Return existing role instead of throwing exception
            return static::where('name', $attributes['name'])
                ->where('guard_name', $attributes['guard_name'])
                ->where('tenant_id', $tenantId)
                ->first();
        }

        // Clear cache before creating
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        return static::query()->create($attributes);
    }

    public function canDelete()
    {
        switch ($this->name) {
            case self::$admin:
            case self::$employee:
            case self::$company:
            case self::$department:
                return false;
                break;
            default:
                return true;
        }
    }

    /**
     * Legacy relationship for backward compatibility
     */
    public function directUsers()
    {
        return $this->hasMany('App\Models\User', 'role_id', 'id');
    }

    /**
     * Alias for backward compatibility
     */
    public function legacyUsers()
    {
        return $this->directUsers();
    }

    public function isDefaultRole()
    {
        return in_array($this->name, [self::$admin, self::$employee, self::$company, self::$department]);
    }

    public static function getUserRoleId()
    {
        $id = 1;
        $role = self::where('name', self::$employee)->first();
        return !empty($role) ? $role->id : $id;
    }

    public static function getDepartmentRoleId()
    {
        $id = 4;
        $role = self::where('name', self::$department)->first();
        return !empty($role) ? $role->id : $id;
    }

    public static function getCompanyRoleId()
    {
        $id = 3;
        $role = self::where('name', self::$company)->first();
        return !empty($role) ? $role->id : $id;
    }

    /**
     * Tenant relationship
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }

    public function scopeForTenant($query, int $tenantId)
    {
        $tenantId = $tenantId ?? app('tenant')->getCurrentTenantId();
        return $query->where('tenant_id', $tenantId);
    }

    public function scopeSystemRoles($query)
    {
        return $query->where('is_system_role', true);
    }

    public function scopeTenantRoles($query, $tenantId = null)
    {
        $tenantId = $tenantId ?? app('tenant')->getCurrentTenantId();
        return $query->where('tenant_id', $tenantId)
                    ->where('is_system_role', false);
    }

    public function scopeAdminRoles($query)
    {
        return $query->where('is_admin', true);
    }

    public function scopeCustomRoles($query)
    {
        return $query->where('is_system_role', false);
    }

    public function isSystemRole(): bool
    {
        return $this->is_system_role;
    }

    public function getLevel(): int
    {
        return $this->level ?? static::$roleLevels[$this->name] ?? 0;
    }

    public function isHigherThan(Role $role): bool
    {
        return $this->getLevel() > $role->getLevel();
    }

    public function canManage(Role $otherRole): bool
    {
        return $this->isHigherThan($otherRole) || $this->is_admin;
    }

    public function isAdminRole(): bool
    {
        return $this->is_admin;
    }

    // Get roles that this role can manage
    public function getManageableRoles($tenantId = null)
    {
        $tenantId = $tenantId ?? $this->tenant_id ?? app('tenant')->getCurrentTenantId();
        
        return static::where('tenant_id', $tenantId)
                    ->where('level', '<', $this->getLevel())
                    ->get();
    }
}