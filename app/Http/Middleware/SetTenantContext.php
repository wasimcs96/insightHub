<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\TenantManager;
use App\Events\TenantResolved;
use Illuminate\Support\Facades\Log;

class SetTenantContext
{
    public function __construct(protected TenantManager $tenantManager) {}

    public function handle(Request $request, Closure $next)
    {
        try {
            // Skip tenant resolution for certain routes
            if ($this->shouldSkipTenantResolution($request)) {
                return $next($request);
            }

            // Resolve tenant using TenantManager
            $tenantId = $this->tenantManager->resolveTenantId();

            if ($tenantId) {
                $tenant = $this->tenantManager->getCurrentTenant();
                
                // Fire tenant resolved event
                event(new TenantResolved(
                    $tenant, 
                    'middleware',
                    [
                        'route' => $request->route()?->getName(),
                        'method' => $request->method(),
                        'path' => $request->path()
                    ]
                ));

                Log::info('Tenant context set via middleware', [
                    'tenant_id' => $tenantId,
                    'tenant_name' => $tenant->name,
                    'user_id' => auth()->id(),
                    'route' => $request->route()?->getName(),
                    'ip' => $request->ip()
                ]);
            } else {
                Log::debug('No tenant context found', [
                    'route' => $request->route()?->getName(),
                    'user_authenticated' => auth()->check(),
                    'session_tenant' => session('tenant_id'),
                    'header_tenant' => $request->header('x-tenant-id')
                ]);
            }

            return $next($request);

        } catch (\Exception $e) {
            Log::error('Error setting tenant context', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_path' => $request->path(),
                'user_id' => auth()->id()
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Tenant resolution failed',
                    'message' => config('app.debug') ? $e->getMessage() : 'Server error'
                ], 500);
            }

            // For web requests, continue without tenant context but log the issue
            return $next($request);
        }
    }

    /**
     * Determine if tenant resolution should be skipped for this request
     */
    protected function shouldSkipTenantResolution(Request $request): bool
    {
        $skipRoutes = [
            'login',
            'register',
            'password.*',
            'verification.*',
            'logout',
            'health-check',
            'status',
            'sso.*'
        ];

        $skipPaths = [
            'api/health',
            'api/status',
            'auth/*',
            'oauth/*',
            'socialite/*',
            '_debugbar/*',
            'telescope/*'
        ];

        // Skip by route name
        if ($request->route() && $request->route()->getName()) {
            foreach ($skipRoutes as $pattern) {
                if (fnmatch($pattern, $request->route()->getName())) {
                    return true;
                }
            }
        }

        // Skip by path
        foreach ($skipPaths as $pattern) {
            if (fnmatch($pattern, $request->path())) {
                return true;
            }
        }

        // Skip during authentication process
        return $this->isAuthenticating();
    }

    /**
     * Check if we're in the middle of authentication to avoid infinite loops
     */
    protected function isAuthenticating(): bool
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 20);
        
        $authClasses = [
            'Illuminate\Auth',
            'Laravel\Sanctum',
            'Laravel\Passport',
            'App\Http\Controllers\Auth',
            'Socialite',
            'OAuth'
        ];

        $authMethods = [
            'attempt',
            'login',
            'authenticate',
            'loginUsingId',
            'guard',
            'check'
        ];

        foreach ($trace as $frame) {
            if (!isset($frame['class']) || !isset($frame['function'])) {
                continue;
            }

            // Check for auth-related classes
            foreach ($authClasses as $authClass) {
                if (str_contains($frame['class'], $authClass)) {
                    return true;
                }
            }

            // Check for auth-related methods
            if (in_array($frame['function'], $authMethods)) {
                return true;
            }
        }

        return false;
    }
}