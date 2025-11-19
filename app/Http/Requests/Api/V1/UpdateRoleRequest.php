<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $roleId = $this->route('id');
        
        return [
            'name' => 'sometimes|required|string|max:255|unique:roles,name,' . $roleId . ',id,tenant_id,' . auth()->user()->tenant_id,
            'description' => 'nullable|string|max:1000',
            'permissions' => 'sometimes|required|array|min:1',
            'permissions.*' => 'required|integer|exists:permissions,id'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Role name is required',
            'name.unique' => 'Role name already exists',
            'permissions.required' => 'At least one permission must be selected',
            'permissions.min' => 'At least one permission must be selected',
            'permissions.*.exists' => 'Invalid permission selected'
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
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
