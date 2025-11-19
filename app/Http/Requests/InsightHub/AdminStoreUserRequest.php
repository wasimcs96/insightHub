<?php

namespace App\Http\Requests\InsightHub;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isCompany());
    }

    /**
     * Get the validation rules that apply to the request
     * for Admin-created Users (password is auto-generated).
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Personal Details
            'first_name' => 'required|string|max:191',
            'last_name'  => 'required|string|max:191',
            'email'      => 'required|email:rfc,dns|unique:users,email',
            'mobile_number' => 'nullable|string|max:100',

            'birth_date' => 'required|date',
            'gender'     => 'required|integer', // tinyint in DB
            'marital_status' => 'required|integer', // int in DB

            // Nationality (country_id is used for nationality + also in address tab, so keep nullable)
            'country_id' => 'nullable|integer',

            'national_id' => 'nullable|string|max:100',

            // Profile Picture
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            // Employment Details
            'employee_code' => 'required|string|max:191|unique:users,employee_code',

            // These help with cascading dropdowns (BU -> Division -> Department), 
            // only some are stored on users table
            'business_unit_id' => 'nullable|integer',              // not stored (used for filtering only)
            'division_id'      => 'nullable|integer|exists:divisions,id',
            'department_id'    => 'nullable|integer|exists:departments,id',
            'job_title'        => 'nullable|string',               // users.job_title (longtext)

            // Headcount / superior info – currently not stored on users, but accepted from form
            'job_position_headcount_id' => 'nullable|integer',
            'superior_job_position'     => 'nullable|string',
            'superior_headcount_id'     => 'nullable|string',
            'superior_name'             => 'nullable|string',

            // Employment status & hire date
            'employment_status' => 'nullable|integer', // users.employment_status (int)
            'date_of_hire'      => 'nullable|date',

            // Role assignment
            'role_id' => 'required|integer|exists:roles,id',

            // Performance ratings (no direct columns; kept for possible future use)
            'performance_rating_2025' => 'nullable|numeric|min:0|max:5',
            'performance_rating_2024' => 'nullable|numeric|min:0|max:5',
            'performance_rating_2023' => 'nullable|numeric|min:0|max:5',

            // Address Information (Home)
            'home_address' => 'nullable|string|max:500',
            'state_id'     => 'nullable|integer',
            'city_id'      => 'nullable|integer',   // users.city_id (int)
            'postal_code'  => 'nullable|numeric',   // users.postal_code (int)

            // Mailing Address
            'mailing_address'      => 'nullable|string|max:500',
            'mailing_country_id'   => 'nullable|integer', // not in users table but allowed
            'mailing_province_id'  => 'nullable|integer', // users.mailing_province_id (int)
            'mailing_city_id'      => 'nullable|integer', // users.mailing_city_id (int)
            'mailing_postal_code'  => 'nullable|numeric', // users.mailing_postal_code (int)

            // Government Information
            'passport_no'          => 'nullable|string|max:100',
            'passport_expiry_date' => 'nullable|date',
            'tin_number'           => 'nullable|string',
            'sss_number'           => 'nullable|string',
            'hdmf_number'          => 'nullable|string',
            'phil_number'          => 'nullable|string',

            // Educational Background
            'education_level' => 'required|string|max:191', // users.education_level (NOT NULL)
            'higher_learning_institution' => 'nullable|string|max:191',
            'course_name'     => 'nullable|string',
            'graduate_year'   => 'nullable|string',

            // Skills & Certifications
            // Tagify sends raw JSON-like string (e.g. `[{"value":"Test"}]`) – store as raw text
            'skills'                  => 'nullable|string',
            'professional_certificate'=> 'nullable|string',
            'training_program'        => 'nullable|string',

            // Emergency Contact
            'ec_contact_person_name'   => 'nullable|string',
            'ec_relation_employee'     => 'nullable|integer', // config constant, stored as int in DB
            'ec_contact_person_number' => 'nullable|numeric',
            'ec_home_address'          => 'nullable|string',

            // Working Experience (users_employments table)
            'employments' => 'nullable|array',
            'employments.*.job_title'        => 'nullable|string|max:100',
            'employments.*.company_name'     => 'nullable|string|max:100',
            'employments.*.start_date'       => 'nullable|date',
            'employments.*.end_date'         => 'nullable|date',
            'employments.*.year_of_work'     => 'nullable|numeric',
            'employments.*.key_responsibility'=> 'nullable|string',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // Personal
            'first_name.required' => 'The first name is required.',
            'last_name.required'  => 'The last name is required.',

            'email.required' => 'The email address is required.',
            'email.email'    => 'Please enter a valid email address.',
            'email.unique'   => 'This email address is already registered.',

            'birth_date.required' => 'The date of birth is required.',
            'birth_date.date'     => 'Please enter a valid date of birth.',

            'gender.required' => 'The gender is required.',
            'marital_status.required' => 'The civil status is required.',

            // Employment
            'employee_code.required' => 'The employee ID is required.',
            'employee_code.unique'   => 'This employee ID is already in use.',

            'role_id.required' => 'Please assign a role to this employee.',
            'role_id.exists'   => 'The selected role is invalid.',

            // Education
            'education_level.required' => 'The educational level is required.',

            // File
            'profile_picture.image' => 'The profile picture must be an image.',
            'profile_picture.mimes' => 'The profile picture must be a file of type: jpeg, png, jpg, gif.',
            'profile_picture.max'   => 'The profile picture may not be greater than 2MB.',

            // Generic dates & numerics for performance ratings
            'performance_rating_2025.numeric' => 'The 2025 performance rating must be a number.',
            'performance_rating_2024.numeric' => 'The 2024 performance rating must be a number.',
            'performance_rating_2023.numeric' => 'The 2023 performance rating must be a number.',
        ];
    }
}
