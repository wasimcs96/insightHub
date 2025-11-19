<?php
namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (!$this->shouldApplyScope($model)) {
            return;
        }

        $tenantId = app('tenant')->getCurrentTenantId();
        
        if ($tenantId) {
            $builder->where($model->getTable() . '.tenant_id', $tenantId);
        }
    }

    public function extend(Builder $builder)
    {
        $builder->macro('withoutTenantScope', function (Builder $builder) {
            return $builder->withoutGlobalScope($this);
        });

        $builder->macro('forTenant', function (Builder $builder, $tenantId) {
            return $builder->withoutGlobalScope($this)
                          ->where($builder->getModel()->getTable() . '.tenant_id', $tenantId);
        });

        $builder->macro('forAllTenants', function (Builder $builder) {
            return $builder->withoutGlobalScope($this);
        });
    }

    protected function shouldApplyScope(Model $model): bool
    {
        // Skip if model doesn't have tenant_id column
        if (!$model->getConnection()->getSchemaBuilder()->hasColumn($model->getTable(), 'tenant_id')) {
            return false;
        }

        // Skip for certain models if needed
        $skipModels = ['Tenant', 'Migration'];
        return !in_array(class_basename($model), $skipModels);
    }
}