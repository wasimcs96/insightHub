<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateAiResponseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'jobRole.job_id' => 'required|exists:jobs,id',
            'jobRole.critical_functions.*.cwf_description' => 'required|string',
            'jobRole.soft_skills.*.competency' => 'required|string',
            'jobRole.technical_skills.*.name' => 'required|string',
            'jobRole.sector_name' => 'nullable|string',
            'jobRole.sub_sector_name' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'jobRole.job_id.exists' => 'The provided job_id does not exist.',
        ];
    }
}
