<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Services\TenantManager;


class ApiAuthentication
{
    public function __construct(protected TenantManager $tenantManager) {}

    public function handle(Request $request, Closure $next, $permission = null)
    {
        // Skip authentication for OPTIONS requests (CORS preflight)
        if ($request->isMethod('OPTIONS')) {
            return response('', 200)->header('Access-Control-Allow-Origin', '*');
        }

        $apiKey = $request->header('X-API-Key');
        $signature = $request->header('X-Signature');
        $timestamp = $request->header('X-Timestamp');
        $serviceName = $request->header('X-Service-Name');
        $tenantId = $request->header('x-tenant-id'); // Add tenant header

        if (!$apiKey || !$signature || !$timestamp) {
            return $this->unauthorizedResponse('Missing required headers');
        }

        // Check timestamp (prevent replay attacks)
        $maxDrift = config('api.security.max_timestamp_drift', 300);
        if (abs(now()->timestamp - $timestamp) > $maxDrift) {
            return $this->unauthorizedResponse('Request timestamp expired');
        }

        // Validate service authentication
        $serviceConfig = $this->getServiceConfig($apiKey);
        if (!$serviceConfig) {
            Log::warning('Unknown API key used', [
                'api_key' => substr($apiKey, 0, 8) . '...',
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
            return $this->unauthorizedResponse('Invalid API key');
        }

        // Validate signature
        if (!$this->validateSignature($request, $timestamp, $serviceConfig['secret'])) {
            Log::warning('Invalid API signature', [
                'service' => $serviceName,
                'api_key' => substr($apiKey, 0, 8) . '...',
                'ip' => $request->ip(),
                'method' => $request->method()
            ]);
            return $this->unauthorizedResponse('Invalid signature');
        }

        // Set tenant context for API requests
        if ($tenantId) {
            $tenant = \App\Models\Tenant::find($tenantId);
            if (!$tenant || !$tenant->isActive()) {
                return $this->unauthorizedResponse('Invalid tenant');
            }
            
            session(['tenant_id' => $tenantId]);
            $request->attributes->set('tenant_id', $tenantId);
            $request->attributes->set('tenant', $tenant);
            // Set tenant context from API key
            $this->tenantManager->setCurrentTenant($tenantId);
        }

        // Check service permissions
        if ($permission && !$this->hasPermission($serviceConfig, $permission)) {
            return $this->forbiddenResponse("Service lacks permission: {$permission}");
        }

        // Add service context to request
        $request->attributes->set('api_service', $serviceName);
        $request->attributes->set('service_config', $serviceConfig);

        Log::info('API request authenticated', [
            'service' => $serviceName,
            'tenant_id' => $tenantId,
            'endpoint' => $request->path(),
            'method' => $request->method()
        ]);

        return $next($request);
    }

    private function getServiceConfig($apiKey): ?array
    {
        $allowedServices = config('api.allowed_services', []);
        
        foreach ($allowedServices as $serviceName => $config) {
            if ($config['api_key'] === $apiKey) {
                return array_merge($config, ['name' => $serviceName]);
            }
        }

        return null;
    }

    private function validateSignature(Request $request, $timestamp, $secret): bool
    {
        // For GET requests, use empty payload since they don't have request body
        // For other methods, use the actual request content
        $payload = $request->isMethod('GET') ? '' : $request->getContent();
        
        $expectedSignature = $this->generateSignature($payload, $timestamp, $secret);
        $receivedSignature = $request->header('X-Signature');
        
        return hash_equals($expectedSignature, $receivedSignature);
    }

    private function generateSignature($payload, $timestamp, $secret): string
    {
        $data = $payload . $timestamp . $secret;
        Log::info('TC Signature Data', [
            'payload' => $payload,
            'timestamp' => $timestamp,
            'secret' => $secret,
            'data' => $data
        ]);
        return hash_hmac('sha256', $data, $secret);
    }

    private function hasPermission(array $serviceConfig, string $permission): bool
    {
        return in_array($permission, $serviceConfig['permissions'] ?? []);
    }

    private function unauthorizedResponse($message): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => false,
            'error' => 'Unauthorized',
            'message' => $message
        ], 401);
    }

    private function forbiddenResponse($message): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => false,
            'error' => 'Forbidden',
            'message' => $message
        ], 403);
    }
}