<?php
// filepath: /Applications/XAMPP/xamppfiles/htdocs/jc-diamond/app/Traits/BelongsToTenant.php

namespace App\Traits;

use App\Models\Tenant;
use App\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToTenant
{
    protected static function bootBelongsToTenant()
    {
        static::addGlobalScope(new TenantScope);

        static::creating(function ($model) {
            if (!$model->tenant_id) {
                $tenantId = app('tenant')->getCurrentTenantId();
                if ($tenantId) {
                    $model->tenant_id = $tenantId;
                }
            }
        });

        static::updating(function ($model) {
            // Prevent tenant switching on updates
            if ($model->isDirty('tenant_id') && $model->getOriginal('tenant_id')) {
                throw new \Exception('Cannot change tenant_id for existing records');
            }
        });
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function scopeForTenant($query, $tenantId = null)
    {
        $tenantId = $tenantId ?? app('tenant')->getCurrentTenantId();
        return $query->where('tenant_id', $tenantId);
    }

    public function belongsToCurrentTenant(): bool
    {
        return $this->tenant_id === app('tenant')->getCurrentTenantId();
    }
}