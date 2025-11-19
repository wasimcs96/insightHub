<?php

namespace App\Http\Requests\InsightHub;

use Illuminate\Foundation\Http\FormRequest;

class CompanyValueRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'company_value_name' => 'required|string|max:255',
            'company_value_description' => 'required|string',
            'facets' => 'required|array|min:1',
            'facets.*' => 'string|in:' . implode(',', array_keys(config('constants.30_facets'))),
            'developmental_stage_description' => 'required|string',
            'basic_level_description' => 'required|string',
            'intermediate_level_description' => 'required|string',
            'advanced_level_description' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'company_value_name.required' => 'Company Value Name is required.',
            'company_value_description.required' => 'Please enter a company value description.',
            'facets.required' => 'Please select at least one facet.',
            'facets.*.in' => 'One or more selected facets are invalid.',
            'developmental_stage_description.required' => 'Developmental stage description is required.',
            'basic_level_description.required' => 'Basic level description is required.',
            'intermediate_level_description.required' => 'Intermediate level description is required.',
            'advanced_level_description.required' => 'Advanced level description is required.',
        ];
    }
}
