<?php
namespace App\Traits;

trait TenantAwareJob
{
    public $tenantId;

    public function setTenantId(?int $tenantId): self
    {
        $this->tenantId = $tenantId ?? app('tenant')->getCurrentTenantId();
        return $this;
    }

    public function getTenantId(): ?int
    {
        return $this->tenantId;
    }

    protected function setTenantContext(): void
    {
        if ($this->tenantId) {
            app('tenant')->setCurrentTenant($this->tenantId);
        }
    }
}