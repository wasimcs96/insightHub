<?php

namespace App\Http\Requests\InsightHub;

use Illuminate\Foundation\Http\FormRequest;

class EmailTemplateRequest extends FormRequest
{
    /**
     * Authorize request (true = allowed for all authenticated users).
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for email template update.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'subject' => 'required|string|max:255',
            'type' => 'nullable|string|max:50',
            'module' => 'nullable|string|max:100',
            'body' => 'nullable|string',
        ];
    }

    /**
     * Custom error messages (optional).
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'subject.required' => 'The subject field is required.',
        ];
    }
}
