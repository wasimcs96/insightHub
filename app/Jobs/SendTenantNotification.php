<?php
namespace App\Jobs;

use App\Traits\TenantAwareJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class SendTenantNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, TenantAwareJob;

    public function __construct(
        public array $userData,
        ?int $tenantId = null
    ) {
        $this->setTenantId($tenantId);
    }

    public function handle(): void
    {
        $this->setTenantContext();
        
        // Now all model queries will be tenant-scoped
        $users = \App\Models\User::where('active', true)->get();
        
        // Process notifications...
    }
}