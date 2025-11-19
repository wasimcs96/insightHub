<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
/**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only allow authenticated users
        return true;
    }

  public function rules(): array
    {
        return [
            'current_password' => ['required', 'string', 'min:8'],

            'password' => [
                'required',
                'string',
                'min:8', // Stronger length
                'different:current_password',
                // Require uppercase, lowercase, number, and special character
                // 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&^()_\-+=])[A-Za-z\d@$!%*#?&^()_\-+=]{12,}$/',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'Please enter your current password.',
            'current_password.min' => 'Your current password must be at least 8 characters.',

            'password.required' => 'Please enter a new password.',
            'password.min' => 'Your new password must be at least 8 characters.',
            'password.different' => 'Your new password must be different from the current password.',
            // 'password.regex' => 'Password must include at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ];
    }
}
