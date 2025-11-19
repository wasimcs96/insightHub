<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TenantProvisioningRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Add your authorization logic here
        // For now, returning true - adjust based on your requirements
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // Tenant information
            'tenant.name' => ['required', 'string', 'max:255'],
            'tenant.email' => ['required', 'email', 'unique:tenants,email'],
            'tenant.domain' => ['required', 'string', 'max:255', 'unique:tenants,domain'],
            'tenant.country' => ['required', 'string', 'max:255'],
            'tenant.address' => ['required', 'string'],
            'tenant.industry' => ['required', 'string', 'max:255'],
            'tenant.status' => ['required', Rule::in(['active', 'inactive', 'suspended'])],
            'tenant.contact_person_name' => ['required', 'string', 'max:255'],
            'tenant.is_parent_company' => ['nullable', 'boolean'],
            'tenant.is_subsidiary_company' => ['nullable', 'boolean'],
            'tenant.parent_tenant_id' => [
                'nullable',
                'required_if:tenant.is_subsidiary_company,true',
                'exists:tenants,id',
                function ($attribute, $value, $fail) {
                    if ($value && $this->input('tenant.is_subsidiary_company')) {
                        $parentTenant = \App\Models\Tenant::find($value);
                        if (!$parentTenant || $parentTenant->status !== 'active') {
                            $fail('The parent tenant must be active.');
                        }
                    }
                },
            ],
            
            // Subscription plan
            'subscription_plan_id' => ['required', 'exists:plans,id'],
            
            // Admin user information
            'admin_user.name' => ['required', 'string', 'max:255'],
            'admin_user.email' => ['required', 'email', 'unique:users,email'],
            'admin_user.mobile_number' => ['required', 'string', 'max:20'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'tenant.name.required' => 'Company name is required.',
            'tenant.email.required' => 'Company email is required.',
            'tenant.email.unique' => 'This email is already registered.',
            'tenant.domain.required' => 'Domain name is required.',
            'tenant.domain.unique' => 'This domain is already taken.',
            'tenant.country.required' => 'Country is required.',
            'tenant.address.required' => 'Address is required.',
            'tenant.industry.required' => 'Industry is required.',
            'tenant.status.required' => 'Status is required.',
            'tenant.contact_person_name.required' => 'Contact person name is required.',
            'tenant.parent_tenant_id.required_if' => 'Parent tenant is required for subsidiary companies.',
            'tenant.parent_tenant_id.exists' => 'The selected parent tenant does not exist.',
            'subscription_plan_id.required' => 'Subscription plan is required.',
            'subscription_plan_id.exists' => 'The selected subscription plan does not exist.',
            'admin_user.name.required' => 'Admin name is required.',
            'admin_user.email.required' => 'Admin email is required.',
            'admin_user.email.unique' => 'This admin email is already registered.',
            'admin_user.mobile_number.required' => 'Admin mobile number is required.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'tenant.name' => 'company name',
            'tenant.email' => 'company email',
            'tenant.domain' => 'domain name',
            'tenant.country' => 'country',
            'tenant.address' => 'address',
            'tenant.industry' => 'industry',
            'tenant.status' => 'status',
            'tenant.contact_person_name' => 'contact person name',
            'tenant.parent_tenant_id' => 'parent tenant',
            'subscription_plan_id' => 'subscription plan',
            'admin_user.name' => 'admin name',
            'admin_user.email' => 'admin email',
            'admin_user.mobile_number' => 'admin mobile number',
        ];
    }
}
