<?php

namespace App\Http\Requests\InsightHub;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isCompany());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'employee_code' => 'nullable|string|max:50|unique:users,employee_code',
            'department_id' => 'nullable|integer|exists:departments,id',
            'division_id' => 'nullable|integer|exists:divisions,id',
            'position_id' => 'nullable|integer|exists:positions,id',
            'job_title' => 'nullable|string|max:255',
            'role_name' => 'nullable|string|max:255',
            'employment_status' => 'nullable|string|max:255',
            'date_of_hire' => 'nullable|date',
            'mobile_number' => 'nullable|string|max:100',
            'country_code' => 'nullable|string|max:191',
            'home_address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:255',
            'state_id' => 'nullable|integer',
            'postal_code' => 'nullable|string|max:255',
            'passport_no' => 'nullable|string|max:100',
            'passport_expiry_date' => 'nullable|date',
            'tin_number' => 'nullable|string|max:255',
            'sss_number' => 'nullable|string|max:255',
            'hdmf_number' => 'nullable|string|max:255',
            'phil_number' => 'nullable|string|max:255',
            'education_level' => 'nullable|string|max:191',
            'course_name' => 'nullable|string|max:255',
            'higher_learning_institution' => 'nullable|string|max:191',
            'graduate_year' => 'nullable|string|max:255',
            'skills' => 'nullable|string',
            'professional_certificate' => 'nullable|string',
            'training_program' => 'nullable|string',
            'ec_contact_person_name' => 'nullable|string',
            'ec_relation_employee' => 'nullable|string',
            'ec_contact_person_number' => 'nullable|string',
            'ec_home_address' => 'nullable|string',
            'marital_status' => 'nullable|string|max:255',
            'country_id' => 'nullable|integer',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|integer',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'onboarding_email_status' => 'nullable|in:Sent,Pending',
            'is_active' => 'nullable|boolean',
            'password' => 'required|string|min:8|confirmed',
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
            'name.required' => 'The employee name is required.',
            'email.required' => 'The email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'employee_code.unique' => 'This employee code is already in use.',
            'job_position.required' => 'The job position is required.',
            'department.required' => 'The department is required.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'profile_picture.image' => 'The file must be an image.',
            'profile_picture.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'profile_picture.max' => 'The image may not be greater than 2MB.',
        ];
    }
}
