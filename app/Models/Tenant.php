<?php
// filepath: /Applications/XAMPP/xamppfiles/htdocs/jc-diamond/app/Models/Tenant.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'domain',
        'subdomain',
        'country',
        'address',
        'industry',
        'contact_person_name',
        'mobile_number',
        'settings',
        'status',
        'trial_ends_at',
        'parent_tenant_id',
    ];

    protected $casts = [
        'settings' => 'json',
        'trial_ends_at' => 'datetime',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get the parent tenant (if this is a subsidiary)
     */
    public function parent()
    {
        return $this->belongsTo(Tenant::class, 'parent_tenant_id');
    }

    /**
     * Get all subsidiary tenants
     */
    public function subsidiaries()
    {
        return $this->hasMany(Tenant::class, 'parent_tenant_id');
    }

    /**
     * Get the plans associated with this tenant
     */
    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'tenant_plans')
            ->withTimestamps();
    }

    /**
     * Get the roles associated with this tenant
     */
    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    /**
     * Check if tenant is a parent company
     */
    public function isParent(): bool
    {
        return $this->subsidiaries()->count() > 0;
    }

    /**
     * Check if tenant is a subsidiary
     */
    public function isSubsidiary(): bool
    {
        return !is_null($this->parent_tenant_id);
    }
}