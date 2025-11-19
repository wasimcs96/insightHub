<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ResolveTenantId
{
    /**
     * Handle an incoming request.
     * 
     * Priority:
     * 1. JWT Token (most secure)
     * 2. x-tenant-id Header
     * 3. tenant_id query parameter
     * 4. tenant_id in request body
     */
    public function handle(Request $request, Closure $next)
    {
        $tenantId = null;

        // Priority 1: Extract from authenticated user (JWT)
        if (Auth::guard('sanctum')->check()) {
            $tenantId = Auth::guard('sanctum')->user()->tenant_id;
            Log::info('Tenant ID from JWT', ['tenant_id' => $tenantId]);
        }

        // Priority 2: x-tenant-id Header (override if provided)
        if (!$tenantId && $request->header('x-tenant-id')) {
            $tenantId = $request->header('x-tenant-id');
            Log::info('Tenant ID from header', ['tenant_id' => $tenantId]);
        }

        // Priority 3: Query parameter
        if (!$tenantId && $request->query('tenant_id')) {
            $tenantId = $request->query('tenant_id');
            Log::info('Tenant ID from query', ['tenant_id' => $tenantId]);
        }

        // Priority 4: Request body
        if (!$tenantId && $request->input('tenant_id')) {
            $tenantId = $request->input('tenant_id');
            Log::info('Tenant ID from body', ['tenant_id' => $tenantId]);
        }

        // Validate tenant_id
        if (!$tenantId) {
            return response()->json([
                'success' => false,
                'message' => 'Tenant ID is required. Please provide it via header (x-tenant-id), query parameter, or request body.'
            ], 400);
        }

        // Optional: Verify tenant exists and is active
        $tenant = \App\Models\Tenant::where('id', $tenantId)
            ->where('is_active', true)
            ->first();

        if (!$tenant) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or inactive tenant.'
            ], 403);
        }

        // Add tenant_id to request for easy access
        $request->merge(['tenant_id' => $tenantId]);
        $request->headers->set('x-tenant-id', $tenantId);

        // Optionally set tenant context globally
        config(['app.current_tenant_id' => $tenantId]);

        return $next($request);
    }
}
