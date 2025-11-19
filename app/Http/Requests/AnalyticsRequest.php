<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnalyticsRequest extends FormRequest
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
    public function rules()
    {
        return [
            'insti_name' => 'nullable|max:255',
            'campus' => 'nullable|max:255',
            'faculty' => 'nullable|max:255',
            'study_program' => 'nullable|max:255',
            'year_of_study' => 'nullable|max:255',
            'year_of_register' => 'nullable|max:255'
        ];
    }
}
