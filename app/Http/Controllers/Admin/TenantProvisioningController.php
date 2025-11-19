<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TenantProvisioningRequest;
use App\Services\TenantProvisionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class TenantProvisioningController extends Controller
{
    protected TenantProvisionService $provisionService;

    /**
     * Create a new controller instance.
     */
    public function __construct(TenantProvisionService $provisionService)
    {
        $this->provisionService = $provisionService;
    }

    /**
     * Provision a new tenant with complete setup
     *
     * @param TenantProvisioningRequest $request
     * @return JsonResponse
     */
    public function provision(TenantProvisioningRequest $request): JsonResponse
    {
        try {
            Log::info('Tenant provisioning request received', [
                'tenant_name' => $request->input('tenant.name'),
                'tenant_email' => $request->input('tenant.email'),
                'plan_id' => $request->input('subscription_plan_id'),
            ]);

            // Extract data from request
            $tenantData = $request->input('tenant');
            $planId = $request->input('subscription_plan_id');
            $adminUserData = $request->input('admin_user');

            // Process provisioning
            $result = $this->provisionService->provision($tenantData, $planId, $adminUserData);

            Log::info('Tenant provisioning request completed successfully', [
                'tenant_id' => $result['tenant']->id,
                'tenant_name' => $result['tenant']->name,
            ]);

            return response()->json([
                'success' => true,
                'message' => $result['message'],
                'data' => [
                    'tenant' => [
                        'id' => $result['tenant']->id,
                        'name' => $result['tenant']->name,
                        'email' => $result['tenant']->email,
                        'domain' => $result['tenant']->domain,
                        'status' => $result['tenant']->status,
                        'slug' => $result['tenant']->slug,
                        'is_subsidiary' => $result['tenant']->isSubsidiary(),
                        'parent_tenant_id' => $result['tenant']->parent_tenant_id,
                        'created_at' => $result['tenant']->created_at,
                    ],
                    'admin_user' => [
                        'id' => $result['admin_user']->id,
                        'name' => $result['admin_user']->name,
                        'email' => $result['admin_user']->email,
                        'tenant_id' => $result['admin_user']->tenant_id,
                    ],
                ],
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Tenant provisioning validation failed', [
                'errors' => $e->errors(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            Log::error('Tenant provisioning failed with exception', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to provision tenant: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get list of available subscription plans
     *
     * @return JsonResponse
     */
    public function getAvailablePlans(): JsonResponse
    {
        try {
            $plans = \App\Models\Plan::with('modules')->get()->map(function ($plan) {
                return [
                    'id' => $plan->id,
                    'title' => $plan->title,
                    'slug' => $plan->slug,
                    'modules' => $plan->modules->map(function ($module) {
                        return [
                            'id' => $module->id,
                            'name' => $module->name,
                            'slug' => $module->slug,
                        ];
                    }),
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $plans,
            ], 200);

        } catch (\Exception $e) {
            Log::error('Failed to fetch available plans', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch plans',
            ], 500);
        }
    }

    /**
     * Get list of active parent tenants (for subsidiary selection)
     *
     * @return JsonResponse
     */
    public function getParentTenants(): JsonResponse
    {
        try {
            $tenants = \App\Models\Tenant::where('status', 'active')
                ->select('id', 'name', 'email', 'domain', 'country', 'industry')
                ->orderBy('name')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $tenants,
            ], 200);

        } catch (\Exception $e) {
            Log::error('Failed to fetch parent tenants', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch parent tenants',
            ], 500);
        }
    }
}
