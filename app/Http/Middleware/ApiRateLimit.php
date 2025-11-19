<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;

class ApiRateLimit
{
    public function handle(Request $request, Closure $next)
    {
        $key = $this->resolveRequestSignature($request);
        $maxAttempts = config('api.security.max_requests_per_minute', 60);

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $retryAfter = RateLimiter::availableIn($key);
            
            return response()->json([
                'error' => 'Too many requests',
                'retry_after' => $retryAfter
            ], 429)->header('Retry-After', $retryAfter);
        }

        RateLimiter::hit($key);

        $response = $next($request);

        // Add rate limit headers
        $response->headers->set('X-RateLimit-Limit', $maxAttempts);
        $response->headers->set('X-RateLimit-Remaining', $maxAttempts - RateLimiter::attempts($key));

        return $response;
    }

    protected function resolveRequestSignature(Request $request)
    {
        $apiKey = $request->header('X-API-Key');
        return 'api_rate_limit:' . ($apiKey ?: $request->ip());
    }
}