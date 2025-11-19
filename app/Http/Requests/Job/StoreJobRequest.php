<?php
// app/Http/Requests/StoreJobRequest.php
namespace App\Http\Requests\Job;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
{
    public function rules()
    {
        return [
                'jd_from' => 'required',
                'title' => 'required|string|max:255',
                'status' => 'required',
                'description' => 'required|string',
                'functions' => 'required|array|min:1',
                'functions.*.title' => 'required|string',
                'technicalSkills' => 'required|array|min:1',
                'heads' => 'required',
                'level' => 'required',
                'org_department' => 'required',
                'position_code' => 'required',
                'education_level' => 'nullable|string',
                'scope_of_study' => 'nullable|string',
                'professional_certificate' => 'nullable|string',
                'relevant_training' => 'nullable|string',
                'work_experience' => 'nullable|string',
                'relevant_course' => 'nullable|string',
                'superior' => 'nullable|integer',
                'subordinates' => 'nullable|array',
                'subordinates.*' => 'integer',
                'perfomance_expectation' => 'nullable|array',
                'perfomance_expectation.*' => 'string',
                'secondary_scope_of_study' => 'nullable|array',
                'secondary_scope_of_study.*' => 'string'
        ];
    }

    public function messages()
    {
        return [
            'jd_from.required' => 'The source of the job description (jd_from) is required.',
            'title.required' => 'The job title is required.',
            'title.string' => 'The job title must be a string.',
            'title.max' => 'The job title may not exceed 255 characters.',
            'status.required' => 'The job status is required.',
            'description.required' => 'The job description is required.',
            'description.string' => 'The job description must be a string.',
            'functions.required' => 'At least one job function is required.',
            'functions.array' => 'The job functions must be an array.',
            'functions.min' => 'At least one job function is required.',
            'functions.*.title.required' => 'The title for each job function is required.',
            'functions.*.title.string' => 'The title for each job function must be a string.',
            'technicalSkills.required' => 'At least one technical skill is required.',
            'technicalSkills.array' => 'The technical skills must be an array.',
            'technicalSkills.min' => 'At least one technical skill is required.',
            'heads.required' => 'The job head(s) are required.',
            'level.required' => 'The job level is required.',
            'org_department.required' => 'The organizational department is required.',
            'position_code.required' => 'The position code is required.',
            'education_level.string' => 'The education level must be a string.',
            'scope_of_study.string' => 'The scope of study must be a string.',
            'professional_certificate.string' => 'The professional certificate must be a string.',
            'relevant_training.string' => 'The relevant training must be a string.',
            'work_experience.string' => 'The work experience must be a string.',
            'relevant_course.string' => 'The relevant course must be a string.',
            'superior.integer' => 'The superior must be an integer.',
            'subordinates.array' => 'The subordinates field must be an array.',
            'subordinates.*.integer' => 'Each subordinate must be an integer.',
            'perfomance_expectation.array' => 'The performance expectations must be an array.',
            'perfomance_expectation.*.string' => 'Each performance expectation must be a string.',
            'secondary_scope_of_study.array' => 'The secondary scope of study must be an array.',
            'secondary_scope_of_study.*.string' => 'Each secondary scope of study must be a string.',
        ];
        
    }
}
