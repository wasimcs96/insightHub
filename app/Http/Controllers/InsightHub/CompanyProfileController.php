<?php

namespace App\Http\Controllers\InsightHub;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompanyRequest;
use App\Models\CompanyProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class CompanyProfileController extends Controller
{

   public function index(Request $request)
{
    $tenantId = optional($request->user())->tenant_id ?? 1; 
    $company = CompanyProfile::where('tenant_id', $tenantId)->first(); 

    return view('InsightHub.settings.general-settings.company-profile.index', compact('company'));
}


 public function store(StoreCompanyRequest $request): JsonResponse
{
    $data = $request->validated();

    // ✅ Automatically assign tenant_id = 1
    $data['tenant_id'] = 1;

    // ✅ Handle logo upload if exists
    if ($request->hasFile('company_logo')) {
        $path = $request->file('company_logo')->store('logos', 'public');
        $data['company_logo'] = $path;
    }

    // ✅ Create company profile
    $profile = CompanyProfile::create($data);

    return response()->json([
        'message' => 'Company profile created successfully.',
        'data' => $profile
    ], 201);
}


   public function edit(Request $request)
{
    // Get tenant_id automatically (you can hardcode 1 for now)
    $tenantId = $request->user()->tenant_id ?? 1;

    // Fetch company profile for this tenant
    $company = CompanyProfile::where('tenant_id', $tenantId)->first();

    return view('InsightHub.settings.general-settings.company-profile.edit', compact('company'));
}

   public function update(Request $request)
{
    $tenantId = $request->user()->tenant_id ?? 1;

    // Validate input
    $validated = $request->validate([
        // 'company_name' => 'required|string|max:255',
        'business_registration_number' => 'nullable|string|max:255',
        'date_established' => 'nullable|date',
        // 'country' => 'nullable|string|max:255',
        'company_size' => 'nullable|string|max:255',
        'number_of_employees' => 'nullable|integer',
        // 'company_contact_number' => 'nullable|string|max:255',
        // 'company_email' => 'nullable|email|max:255',
        'company_website' => 'nullable|string|max:255',
        // 'industry_sector' => 'nullable|string|max:255',
        'sub_sector' => 'nullable|string|max:255',
        'company_address' => 'nullable|string|max:255',
        'company_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
    ]);

    // Upload new logo if provided
    if ($request->hasFile('company_logo')) {
        $path = $request->file('company_logo')->store('logos', 'public');
        $validated['company_logo'] = $path;
    }

    // Find and update the company record
    $company = CompanyProfile::where('tenant_id', $tenantId)->first();

    if ($company) {
        $company->update($validated);
    } else {
        $validated['tenant_id'] = $tenantId;
        $company = CompanyProfile::create($validated);
    }

    return redirect()->route('company-profile.index')
                     ->with('success', 'Company information updated successfully!');
}
}
