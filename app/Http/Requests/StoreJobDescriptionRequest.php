<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobDescriptionRequest extends FormRequest
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
    public function rules()
    {
        return [
            // 'level_job' => 'required',
            // 'heads' => 'required|numeric|min:1',
            'riasec' => 'required|array|min:1|max:3',
            'description' => 'required|string|min:10',
            'functions' => 'required|array|min:1',
            'functions.*.title' => 'required|string',
            'genericSkills' => 'required|array|min:3',
            'genericSkills.*.competency' => 'required|string',
            'genericSkills.*.preferred_level' => 'required',
            'technicalSkills' => 'required|array|min:1',
            // 'technicalSkills.*.name' => 'required|string',
            // 'technicalSkills.*.preferred_level' => 'required',
        ];
    }

    public function messages()
    {
        return [
            // 'level_job.required' => 'Please select a position level.',
            // 'heads.required' => 'Enter number of headcount.',
            'riasec.required' => 'Select top 3 RIASEC codes.',
            'description.required' => 'Enter job description.',
            'functions.required' => 'Please add at least one critical work function.',
            'genericSkills.required' => 'Please add at least three generic skills.',
            'genericSkills.*.competency.required' => 'Each generic skill must have a competency title.',
            'genericSkills.*.preferred_level.required' => 'Each generic skill must have a level.',
            'technicalSkills.required' => 'Please add at least one technical skill.',
            // 'technicalSkills.*.name.required' => 'Each technical skill must have a name.',
            // 'technicalSkills.*.preferred_level' => 'Each generic skill must have a level',
        ];
    }
}
