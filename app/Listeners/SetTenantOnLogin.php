<?php

namespace App\Listeners;

use App\Events\TenantResolved;
use App\Services\TenantManager;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;

class SetTenantOnLogin
{
    public function __construct(protected TenantManager $tenantManager) {}

    public function handle(Login $event): void
    {
        $user = $event->user;
        
        if (!$user->tenant_id) {
            Log::warning('User logged in without tenant_id', ['user_id' => $user->id]);
            return;
        }

        $tenantId = $this->tenantManager->setCurrentTenant($user->tenant_id);
        
        if ($tenantId) {
            event(new TenantResolved(
                $this->tenantManager->getCurrentTenant(),
                'user_login',
                ['user_id' => $user->id, 'guard' => $event->guard]
            ));
            
            Log::info('Tenant context set on login', [
                'user_id' => $user->id,
                'tenant_id' => $tenantId,
                'guard' => $event->guard
            ]);
        }
    }
}
