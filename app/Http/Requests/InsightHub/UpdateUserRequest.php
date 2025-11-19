<?php

namespace App\Http\Requests\InsightHub;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $userId = $this->route('id');
        
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'employee_code' => 'nullable|string|max:50|unique:users,employee_code,' . $userId,
            'department_id' => 'nullable|integer|exists:departments,id',
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
            'password' => 'nullable|string|min:8|confirmed',
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
            'department_id.integer' => 'The department must be a valid integer.',
            'department_id.exists' => 'The selected department does not exist.',
            'position_id.integer' => 'The position must be a valid integer.',
            'position_id.exists' => 'The selected position does not exist.',
            'job_title.max' => 'The job title must not exceed 255 characters.',
            'role_name.max' => 'The role name must not exceed 255 characters.',
            'employment_status.max' => 'The employment status must not exceed 255 characters.',
            'date_of_hire.date' => 'Please enter a valid date of hire.',
            'mobile_number.max' => 'The mobile number must not exceed 100 characters.',
            'country_code.max' => 'The country code must not exceed 191 characters.',
            'home_address.max' => 'The home address must not exceed 500 characters.',
            'city.max' => 'The city must not exceed 255 characters.',
            'state_id.integer' => 'The state must be a valid integer.',
            'postal_code.max' => 'The postal code must not exceed 255 characters.',
            'passport_no.max' => 'The passport number must not exceed 100 characters.',
            'passport_expiry_date.date' => 'Please enter a valid passport expiry date.',
            'tin_number.max' => 'The TIN number must not exceed 255 characters.',
            'sss_number.max' => 'The SSS number must not exceed 255 characters.',
            'hdmf_number.max' => 'The HDMF number must not exceed 255 characters.',
            'phil_number.max' => 'The PhilHealth number must not exceed 255 characters.',
            'education_level.max' => 'The education level must not exceed 191 characters.',
            'course_name.max' => 'The course name must not exceed 255 characters.',
            'higher_learning_institution.max' => 'The institution name must not exceed 191 characters.',
            'graduate_year.max' => 'The graduate year must not exceed 255 characters.',
            'skills.string' => 'The skills must be a valid string.',
            'professional_certificate.string' => 'The professional certificate must be a valid string.',
            'training_program.string' => 'The training program must be a valid string.',
            'ec_contact_person_name.string' => 'The emergency contact name must be a valid string.',
            'ec_relation_employee.string' => 'The emergency contact relationship must be a valid string.',
            'ec_contact_person_number.string' => 'The emergency contact number must be a valid string.',
            'ec_home_address.string' => 'The emergency contact address must be a valid string.',
            'marital_status.max' => 'The marital status must not exceed 255 characters.',
            'country_id.integer' => 'The country must be a valid integer.',
            'birth_date.date' => 'Please enter a valid birth date.',
            'gender.integer' => 'The gender must be a valid integer.',
            'profile_picture.image' => 'The file must be an image.',
            'profile_picture.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'profile_picture.max' => 'The image may not be greater than 2MB.',
            'onboarding_email_status.in' => 'The onboarding email status must be Sent or Pending.',
            'is_active.boolean' => 'The active status must be true or false.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }
}
