<?php

namespace App\Modules\Headcounts\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Update authorization logic as needed
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            // Job fields
            'jd_from'                   => ['required'],
            'title'                     => ['required','string','max:255'],
            'status'                    => ['required'],
            'description'               => ['required','string'],

            // Critical functions
            'functions'                 => ['required','array','min:1'],
            'functions.*.title'         => ['required','string'],

            // Technical skills
            'technicalSkills'           => ['required','array','min:1'],
            'technicalSkills.*.id'      => ['required','integer','exists:master_technical_skills,id'],
            'technicalSkills.*.level'   => ['required','integer','between:1,6'],

            // Core job attributes
            'level'                     => ['required','integer','between:1,15'],
            'org_department'            => ['required','integer','exists:departments,id'],
            'sector_id'                 => ['nullable','integer','exists:sectors,id'],
            'superior'                  => ['nullable','integer','exists:jobs,id'],

            // Position code
            'position_code'             => [
                'required','string',
                Rule::unique('jobs','position_code')
            ],

            // Headcounts
            'headcounts'                => ['required','array','min:1'],
            'headcounts.*.id'           => ['required','regex:/^[A-Z0-9]+-\d+-\d{2}$/'],
            'headcounts.*.superior'     => ['nullable','regex:/^[A-Z0-9]+-\d+-\d{2}$/'],
        ];
    }

    /**
     * Custom error messages for validation.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // Functions
            'functions.required'            => 'Please add at least one critical function.',
            'functions.array'               => 'Invalid critical functions data submitted.',
            'functions.min'                 => 'Please add at least one critical function.',
            'functions.*.title.required'    => 'Each critical function must have a title.',

            // Technical Skills
            'technicalSkills.required'      => 'Please add at least one technical skill.',
            'technicalSkills.array'         => 'Invalid technical skills data submitted.',
            'technicalSkills.min'           => 'Please add at least one technical skill.',

            // Position Code
            'position_code.required'        => 'Position Code is required.',
            'position_code.unique'          => 'That Position Code is already taken. Please choose another.',

            // Headcounts
            'headcounts.required'           => 'Please add at least one headcount.',
            'headcounts.array'              => 'Invalid headcount data submitted.',
            'headcounts.min'                => 'Please add at least one headcount.',
            'headcounts.*.id.required'      => 'Headcount code is required.',
            'headcounts.*.id.regex'         => 'Headcount code must be in the format ABC-1234-01.',
            'headcounts.*.superior.regex'   => 'Superior headcount code must be in the format ABC-1234-01.',
        ];
    }
}
