<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TenantProvisionRequest;
use App\Services\TenantProvisionService;
use App\Models\Tenant;
use App\Models\Plan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class TenantProvisionController extends Controller
{
    protected TenantProvisionService $provisionService;

    public function __construct(TenantProvisionService $provisionService)
    {
        $this->provisionService = $provisionService;
        //dd($this->provisionService);
    }

    /**
     * Display tenant creation form
     */
    public function create()
    {
        $plans = Plan::with('modules')->where('is_active', true)->get();
        $parentTenants = Tenant::active()->parents()->get(['id', 'name']);

        return view('admin.tenants.provision', compact('plans', 'parentTenants'));
    }

    /**
     * Provision new tenant
     */
    public function store(TenantProvisionRequest $request): JsonResponse
    {dd("ad");
        try {
            $result = $this->provisionService->provision($request->validated());

            return response()->json($result, 201);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function storeee(TenantProvisionRequest $request): JsonResponse
    {
        try {
            $result = $this->provisionService->provision($request->validated());

            return response()->json($result, 201);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    /**
     * Get tenant details
     */
    public function show(int $tenantId): JsonResponse
    {
        try {
            $tenant = $this->provisionService->getTenantDetails($tenantId);

            if (!$tenant) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tenant not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'tenant' => $tenant
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get parent tenants for dropdown
     */
    public function getParentTenants(): JsonResponse
    {
        $parents = Tenant::active()
            ->parents()
            ->select('id', 'name', 'email', 'domain')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $parents
        ]);
    }

    /**
     * Get subsidiaries of a parent tenant
     */
    public function getSubsidiaries(int $parentId): JsonResponse
    {
        $subsidiaries = Tenant::where('parent_tenant_id', $parentId)
            ->with('plans')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $subsidiaries
        ]);
    }
}
