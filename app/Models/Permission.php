<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'name',
        'display_name',
        'guard_name',
        'description',
        'section',
        'permission_type',
        'is_system_permission'
    ];

    protected $casts = [
        'is_system_permission' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the module that owns the permission
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    /**
     * The roles that belong to the permission
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            'role_has_permissions',
            'permission_id',
            'role_id'
        );
    }

    /**
     * Scope for system permissions
     */
    public function scopeSystem($query)
    {
        return $query->where('is_system_permission', 1);
    }

    /**
     * Scope by permission type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('permission_type', $type);
    }

    /**
     * Scope by section
     */
    public function scopeBySection($query, $section)
    {
        return $query->where('section', $section);
    }

    /**
     * Scope by module
     */
    public function scopeByModule($query, $moduleId)
    {
        return $query->where('module_id', $moduleId);
    }
}