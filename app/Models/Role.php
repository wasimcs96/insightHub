<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToTenant;

class Role extends Model
{
    use HasFactory;

    use BelongsToTenant;

    protected $guard_name = 'web';
    
    static $admin = 'admin';
    static $employee = 'employee';
    static $department = 'department';
    static $company = 'company';

    protected $fillable = [
        'tenant_id',
        'name',
        'display_name',
        'guard_name',
        'description',
        'is_system_role',
        'is_default',
        'level'
    ];

    protected $casts = [
        'is_system_role' => 'integer',
        'is_default' => 'integer',
        'level' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    /**
     * Get the tenant that owns the role
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * The permissions that belong to the role
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            'role_has_permissions',
            'role_id',
            'permission_id'
        );
    }

    /**
     * The users that belong to the role
     */
    // public function users(): BelongsToMany
    // {
    //     return $this->belongsToMany(
    //         User::class,
    //         'model_has_roles',
    //         'role_id',
    //         'model_id'
    //     )->where('model_type', User::class);
    // }
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
    /**
     * Scope for default roles
     */
    public function scopeDefault($query)
    {
        return $query->where('is_default', 1);
    }

    /**
     * Scope for custom roles
     */
    public function scopeCustom($query)
    {
        return $query->where('is_default', 0)
            ->where('is_system_role', 0);
    }

    /**
     * Scope for system roles
     */
    public function scopeSystem($query)
    {
        return $query->where('is_system_role', 1);
    }

    /**
     * Check if role is editable
     */
    public function isEditable(): bool
    {
        return !$this->is_system_role;
    }

    /**
     * Check if role is deletable
     */
    public function isDeletable(): bool
    {
        if ($this->is_default || $this->is_system_role) {
            return false;
        }

        if ($this->users()->count() > 0) {
            return false;
        }

        return true;
    }

    /**
     * Get the deletion message
     */
    public function getDeletionMessage(): string
    {
        if ($this->is_default || $this->is_system_role) {
            return 'Default roles cannot be deleted.';
        }

        if ($this->users()->count() > 0) {
            return 'Cannot delete role. Please remove all users from this role first.';
        }

        return '';
    }

    /**
     * Get the deletion tooltip
     */
    public function getDeletionTooltip(): string
    {
        if ($this->is_default || $this->is_system_role) {
            return 'Unable to delete role';
        }

        if ($this->users()->count() > 0) {
            return 'Cannot delete role. Please remove all users from this role first.';
        }

        return '';
    }

    public function isAdminRole(): bool
    {
        return $this->is_admin;
    }
}