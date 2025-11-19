<?php
namespace App\Http\Middleware;

use App\Services\TenantManager;
use Closure;
use Illuminate\Http\Request;

class EnsureTenantAccess
{
    public function __construct(protected TenantManager $tenantManager) {}

    public function handle(Request $request, Closure $next)
    {
        if (!$this->tenantManager->isTenantAware()) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Tenant required'], 403);
            }
            
            abort(403, 'Tenant access required');
        }

        return $next($request);
    }
}