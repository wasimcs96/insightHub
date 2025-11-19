<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tenant_details' => 'required|array',
            'tenant_details.id' => 'required|integer',
            'tenant_details.name' => 'required|string|max:255',
            'tenant_details.slug' => 'nullable|string|max:255',
            'tenant_details.description' => 'nullable|string',
            'tenant_details.is_active' => 'nullable|integer|in:0,1',
            
            'user_details' => 'required|array',
            'user_details.name' => 'required|string|max:255',
            'user_details.email' => 'required|email|max:255|unique:users,email',
            'user_details.password' => 'required|string|min:8',
            'user_details.central_portal_user_id' => 'nullable|integer|unique:users,central_portal_user_id',
            'user_details.role_name' => 'required|string|max:255',
            
            'roles' => 'required|array|min:1',
            'roles.*.id' => 'required|integer',
            'roles.*.name' => 'required|string|max:255',
            'roles.*.permissions' => 'required|array|min:1',
            'roles.*.permissions.*.id' => 'required|integer',
            'roles.*.permissions.*.name' => 'required|string|max:255',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Check if the role_name exists in the provided roles array
            $roleName = $this->input('user_details.role_name');
            $roles = $this->input('roles', []);
            
            $roleExists = collect($roles)->contains('name', $roleName);
            
            if (!$roleExists) {
                $validator->errors()->add(
                    'user_details.role_name',
                    "The role '{$roleName}' must exist in the roles array."
                );
            }
        });
    }

    public function messages(): array
    {
        return [
            'tenant_details.required' => 'Tenant details are required',
            'tenant_details.id.required' => 'Tenant ID is required',
            'tenant_details.is_active.in' => 'The is_active field must be 0 or 1',
            'user_details.required' => 'User details are required',
            'user_details.email.unique' => 'This email is already registered',
            'user_details.password.min' => 'Password must be at least 8 characters',
            'user_details.central_portal_user_id.unique' => 'This central portal user ID is already registered',
            'user_details.role_name.required' => 'Role name is required',
            'roles.required' => 'At least one role is required',
            'roles.*.permissions.required' => 'Each role must have at least one permission',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}