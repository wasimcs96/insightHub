<?php
namespace App\Services;

use App\Models\Tenant;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class TenantManager
{
    protected ?Tenant $currentTenant = null;
    protected ?int $currentTenantId = null;
    protected array $tenantContext = [];

    /**
     * Resolve tenant from multiple sources with priority
     */
    public function resolveTenantId(): ?int
    {
        // Check if already resolved for this request
        if ($this->currentTenantId) {
            return $this->currentTenantId;
        }

        $tenantId = null;

        // Priority 1: From authenticated user
        if (auth()->check() && auth()->user()->tenant_id) {
            $tenantId = auth()->user()->tenant_id;
        }
        
        // Priority 2: From API token context
        elseif (request()->bearerToken() && $apiTenant = $this->resolveFromApiToken()) {
            $tenantId = $apiTenant;
        }
        
        // Priority 3: From SSO session data
        elseif ($ssoTenant = $this->resolveFromSsoSession()) {
            $tenantId = $ssoTenant;
        }
        
        // Priority 4: From request headers
        elseif (request()->header('x-tenant-id')) {
            $tenantId = request()->header('x-tenant-id');
        }
        
        // Priority 5: From subdomain
        elseif ($subdomainTenant = $this->resolveFromSubdomain()) {
            $tenantId = $subdomainTenant;
        }
        
        // Priority 6: From session
        elseif (session('tenant_id')) {
            $tenantId = session('tenant_id');
        }

        return $this->setCurrentTenant($tenantId);
    }

    //app('tenant')->setCurrentTenant($this->tenantId); use any where in app this way
    public function setCurrentTenant(?int $tenantId): ?int
    {
        if (!$tenantId) {
            return null;
        }

        $tenant = $this->getTenant($tenantId);
        
        if (!$tenant || !$tenant->isActive()) {
            Log::warning('Invalid tenant attempted', ['tenant_id' => $tenantId]);
            return null;
        }

        $this->currentTenantId = $tenantId;
        $this->currentTenant = $tenant;
        
        // Set in multiple contexts for reliability
        $this->storeInContext($tenant);
        
        return $tenantId;
    }

    public function getCurrentTenant(): ?Tenant
    {
        if (!$this->currentTenant && $this->currentTenantId) {
            $this->currentTenant = $this->getTenant($this->currentTenantId);
        }
        
        return $this->currentTenant;
    }

    public function getCurrentTenantId(): ?int
    {
        return $this->currentTenantId ?? $this->resolveTenantId();
    }

    public function clearContext(): void
    {
        $this->currentTenant = null;
        $this->currentTenantId = null;
        $this->tenantContext = [];
        
        session()->forget(['tenant_id', 'tenant']);
        request()->attributes->remove('tenant_id');
        request()->attributes->remove('tenant');
    }

    protected function getTenant(int $tenantId): ?Tenant
    {
        return Cache::remember("tenant.{$tenantId}", 300, function () use ($tenantId) {
            return Tenant::find($tenantId);
        });
    }

    protected function storeInContext(Tenant $tenant): void
    {
        // Store in session for web requests
        if (!request()->expectsJson()) {
            session([
                'tenant_id' => $tenant->id,
                'tenant' => $tenant->toArray()
            ]);
        }

        // Store in request attributes
        request()->attributes->set('tenant_id', $tenant->id);
        request()->attributes->set('tenant', $tenant);

        // Store in service context
        $this->tenantContext = [
            'id' => $tenant->id,
            'name' => $tenant->name,
            'subdomain' => $tenant->subdomain,
            'database' => $tenant->database ?? null,
        ];
    }

    protected function resolveFromApiToken(): ?int
    {
        if (!$token = request()->bearerToken()) {
            return null;
        }

        // Check if token has tenant context (customize based on your token implementation)
        return Cache::remember("api_token_tenant.{$token}", 60, function () use ($token) {
            // Example: Laravel Sanctum
            if ($tokenModel = \Laravel\Sanctum\PersonalAccessToken::findToken($token)) {
                return $tokenModel->tokenable->tenant_id ?? null;
            }
            
            // Example: Custom API key
            if ($apiKey = \App\Models\ApiKey::where('key', $token)->first()) {
                return $apiKey->tenant_id;
            }

            return null;
        });
    }

    protected function resolveFromSsoSession(): ?int
    {
        // Check for SSO-specific session data
        if ($ssoData = session('sso_user_data')) {
            return $ssoData['tenant_id'] ?? null;
        }

        // Check for OAuth state
        if ($oauthState = session('oauth_state')) {
            return $oauthState['tenant_id'] ?? null;
        }

        return null;
    }

    protected function resolveFromSubdomain(): ?int
    {
        $host = request()->getHost();
        $parts = explode('.', $host);
        
        if (count($parts) < 3) {
            return null;
        }

        $subdomain = $parts[0];
        
        if (in_array($subdomain, ['www', 'api', 'admin', 'localhost'])) {
            return null;
        }

        return Cache::remember("subdomain_tenant.{$subdomain}", 300, function () use ($subdomain) {
            return Tenant::where('subdomain', $subdomain)->value('id');
        });
    }

    public function isTenantAware(): bool
    {
        return !is_null($this->getCurrentTenantId());
    }

    public function validateAccess(int $resourceTenantId): bool
    {
        $currentTenantId = $this->getCurrentTenantId();
        
        if (!$currentTenantId) {
            return false;
        }

        return $currentTenantId === $resourceTenantId;
    }
}