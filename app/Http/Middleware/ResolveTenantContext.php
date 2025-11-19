<?php
namespace App\Http\Middleware;

use App\Events\TenantResolved;
use App\Services\TenantManager;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResolveTenantContext
{
    public function __construct(protected TenantManager $tenantManager) {}

    public function handle(Request $request, Closure $next)
    {
        try {
            $tenantId = $this->tenantManager->resolveTenantId();
            
            if ($tenantId) {
                $tenant = $this->tenantManager->getCurrentTenant();
                
                event(new TenantResolved(
                    $tenant,
                    'middleware',
                    ['route' => $request->route()?->getName()]
                ));
            }

            return $next($request);

        } catch (\Exception $e) {
            Log::error('Tenant resolution failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_path' => $request->path()
            ]);

            if ($request->expectsJson()) {
                return response()->json(['error' => 'Tenant resolution failed'], 500);
            }

            return $next($request);
        }
    }
}