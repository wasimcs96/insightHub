<?php

namespace App\Listeners;

use App\Services\TenantManager;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;

class ClearTenantOnLogout
{
    public function __construct(protected TenantManager $tenantManager) {}

    public function handle(Logout $event): void
    {
        $this->tenantManager->clearContext();
        
        Log::info('Tenant context cleared on logout', [
            'user_id' => $event->user->id ?? null
        ]);
    }
}
