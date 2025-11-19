<?php

namespace App\Listeners;

use App\Events\TenantResolved;
use Illuminate\Support\Facades\Log;

class LogTenantActivity
{
    public function handle(TenantResolved $event): void
    {
        Log::info('Tenant resolved', [
            'tenant_id' => $event->tenant->id,
            'tenant_name' => $event->tenant->name,
            'resolved_via' => $event->resolvedVia,
            'context' => $event->context,
            'user_id' => auth()->id(),
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
    }
}
