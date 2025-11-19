<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasOrgChartAuditProperties
{
    use \OwenIt\Auditing\Auditable;

    protected $orgMetadata;

    public static function booted()
    {
        $removeAuditProperties = function (Model $model) {
              $model->orgMetadata = isset($model->attributes['orgMetadata']) ? $model->attributes['orgMetadata'] : null;
              unset($model->attributes['orgMetadata']);
        };

        static::creating(function ($model) use ($removeAuditProperties) {
            $removeAuditProperties($model);
        });

        static::updating(function ($model) use ($removeAuditProperties) {
            $removeAuditProperties($model);
        });

        static::deleting(function ($model) use ($removeAuditProperties) {
            $removeAuditProperties($model);
        });
    }

    abstract function makeAuditProperties(array $auditData): array;

    public function transformAudit(array $data): array
    {
        return [...$data, ...$this->makeAuditProperties($data)];
    }
}
