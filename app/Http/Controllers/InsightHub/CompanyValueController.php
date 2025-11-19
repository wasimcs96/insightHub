<?php

namespace App\Http\Controllers\InsightHub;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsightHub\CompanyValueRequest;
use App\Models\CompanyValue;
use App\Services\InsightHub\CompanyValueService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Exception;

class CompanyValueController extends Controller
{
    protected CompanyValueService $companyValueService;

    public function __construct(CompanyValueService $companyValueService)
    {
        $this->companyValueService = $companyValueService;
    }

    public function index(Request $request)
    {
        $tenantId = auth()->check() ? auth()->user()->tenant_id : null;

        $query = CompanyValue::query();

        if ($tenantId !== null) {
            $query->where('tenant_id', $tenantId);
        }

        $values = $query->paginate(10);

        if ($request->ajax()) {
            return response()
                ->json(['data' => $values])
                ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        }

        return view('InsightHub.settings.general-settings.company-values.index', compact('values'));
    }

    public function create()
    {
        return view('InsightHub.settings.general-settings.company-values.add');
    }

    public function store(CompanyValueRequest $request)
    {
        $data = $request->validated();
        $data['tenant_id'] = auth()->user()->tenant_id ?? null;

        $this->companyValueService->store($data);

        if ($request->ajax()) {
            return response()->json(['message' => 'Company Value created successfully!']);
        }

        return redirect()
            ->route('insighthub.settings.company-values.index')
            ->with('success', 'Company Value created successfully!');
    }

    public function show(Request $request, $id)
    {
        $value = CompanyValue::findOrFail($id);

        if ($request->ajax()) {
            return response()->json(['data' => $value]);
        }

        return view('InsightHub.settings.general-settings.company-values.view', compact('value'));
    }

    public function edit($id)
    {
        $value = CompanyValue::findOrFail($id);
        return view('InsightHub.settings.general-settings.company-values.edit', compact('value'));
    }

    public function update(CompanyValueRequest $request, $id)
    {
        $companyValue = CompanyValue::findOrFail($id);
        $this->companyValueService->update($companyValue, $request->validated());

        if ($request->ajax()) {
            return response()->json(['message' => 'Company Value updated successfully!']);
        }

        return redirect()
            ->route('insighthub.settings.company-values.index')
            ->with('success', 'Company Value updated successfully!');
    }

    public function destroy(Request $request, $id)
    {
        $companyValue = CompanyValue::findOrFail($id);
        $this->companyValueService->delete($companyValue);

        if ($request->ajax()) {
            return response()->json(['message' => 'Company Value deleted successfully!']);
        }

        return redirect()
            ->route('insighthub.settings.company-values.index')
            ->with('success', 'Company Value deleted successfully!');
    }
}
