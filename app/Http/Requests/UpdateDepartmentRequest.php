<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $departmentId = $this->route('id');
        
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                // Department name must be unique within the same division for the tenant (excluding current department)
                Rule::unique('departments', 'name')
                    ->where('tenant_id', auth()->user()->tenant_id)
                    ->where('division_id', $this->input('division_id'))
                    ->ignore($departmentId)
            ],
            'division_id' => [
                'required',
                'integer',
                'exists:divisions,id',
            ],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Department name is required.',
            'name.string' => 'Department name must be a text string.',
            'name.max' => 'Department name cannot exceed 255 characters.',
            'name.unique' => 'This department name already exists in the selected division.',
            'division_id.required' => 'Please select a division.',
            'division_id.integer' => 'Invalid division selected.',
            'division_id.exists' => 'The selected division does not exist.',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Trim whitespace from name
        if ($this->has('name')) {
            $this->merge([
                'name' => trim($this->name),
            ]);
        }
    }
}
