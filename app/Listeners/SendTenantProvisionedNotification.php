<?php

namespace App\Listeners;

use App\Events\TenantProvisioned;
use App\Notifications\SendTenantCredentials;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendTenantProvisionedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TenantProvisioned $event): void
    {
        try {
            Log::info('Sending tenant credentials notification', [
                'tenant_id' => $event->tenant->id,
                'tenant_name' => $event->tenant->name,
                'admin_user_id' => $event->adminUser->id,
                'admin_email' => $event->adminUser->email,
            ]);

            // Send notification to admin user
            $event->adminUser->notify(
                new SendTenantCredentials($event->tenant, $event->generatedPassword)
            );

            Log::info('Tenant credentials notification sent successfully', [
                'tenant_id' => $event->tenant->id,
                'admin_user_id' => $event->adminUser->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send tenant credentials notification', [
                'tenant_id' => $event->tenant->id,
                'admin_user_id' => $event->adminUser->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            // Re-throw the exception to retry the job
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(TenantProvisioned $event, \Throwable $exception): void
    {
        Log::error('Tenant provisioned notification failed permanently', [
            'tenant_id' => $event->tenant->id,
            'admin_user_id' => $event->adminUser->id,
            'error' => $exception->getMessage(),
        ]);
    }
}
