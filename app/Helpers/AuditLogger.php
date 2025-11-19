<?php

namespace App\Helpers;

use OwenIt\Auditing\Models\Audit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Collection;

class AuditLogger
{
    /**
     * Log audits for bulk model updates efficiently.
     *
     * @param string $modelClass The full model class name (e.g. App\Models\JobHeadcount)
     * @param Collection $originalModels Collection of original model instances (before update)
     * @param array $changedFields Key-value pairs of fields that were updated ['field_name' => new_value]
     * @param string $event Audit event type ('updated', 'created', 'deleted')
     * @param array $tags Optional tags for filtering audits
     */
    public static function logBulkAudit(string $modelClass, Collection $originalModels, array $changedFields, string $event = 'updated', array $tags = []): void
    {
        $user = Auth::user();

        $auditEntries = $originalModels->map(function ($model) use ($modelClass, $changedFields, $event, $tags, $user) {

            $oldValues = [];
            $newValues = [];

            foreach ($changedFields as $field => $newValue) {
                $oldValue = $model->{$field};
                if ($oldValue != $newValue) {
                    $oldValues[$field] = $oldValue;
                    $newValues[$field] = $newValue;
                }
            }

            if (empty($oldValues)) {
                return null;
            }

            return [
                'user_type'      => $user ? get_class($user) : null,
                'user_id'        => $user->id ?? null,
                'event'          => $event,
                'auditable_type' => $modelClass,
                'auditable_id'   => $model->id,
                'old_values'     => json_encode($oldValues),
                'new_values'     => json_encode($newValues),
                'url'            => Request::fullUrl(),
                'ip_address'     => Request::ip(),
                'user_agent'     => Request::userAgent(),
                'tags'           => implode(',', $tags),
                'created_at'     => now(),
                'updated_at'     => now(),
            ];

        })->filter()->values()->toArray();

        if (!empty($auditEntries)) {
            Audit::insert($auditEntries);
        }
    }
}
