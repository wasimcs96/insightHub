<?php

namespace App\Events;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TenantProvisioned
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Tenant $tenant;
    public User $adminUser;
    public string $generatedPassword;

    /**
     * Create a new event instance.
     */
    public function __construct(Tenant $tenant, User $adminUser, string $generatedPassword)
    {
        $this->tenant = $tenant;
        $this->adminUser = $adminUser;
        $this->generatedPassword = $generatedPassword;
    }
}
