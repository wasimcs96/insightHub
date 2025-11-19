<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDivisionRequest extends FormRequest
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
        $divisionId = $this->route('id');
        
        return [
            'head_of_division' => [
                'required',
                'string',
                'max:255',
                Rule::unique('divisions', 'head_of_division')
                    ->where('business_unit_id', $this->business_unit_id)
                    ->where('tenant_id', auth()->user()->tenant_id)
                    ->ignore($divisionId)
            ],
            'business_unit_id' => [
                'required',
                'integer',
                'exists:business_units,id'
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
            'head_of_division.required' => 'Division name is required.',
            'head_of_division.string' => 'Division name must be a text string.',
            'head_of_division.max' => 'Division name cannot exceed 255 characters.',
            'head_of_division.unique' => 'This division name already exists in the selected business unit.',
            'business_unit_id.required' => 'Business unit is required.',
            'business_unit_id.integer' => 'Invalid business unit.',
            'business_unit_id.exists' => 'Selected business unit does not exist.',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Trim whitespace from head_of_division
        if ($this->has('head_of_division')) {
            $this->merge([
                'head_of_division' => trim($this->head_of_division),
            ]);
        }
    }
}
