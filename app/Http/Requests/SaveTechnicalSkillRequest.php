<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveTechnicalSkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'levels' => 'required|array',
            'levels.*.description' => 'required|string',
            'levels.*.knowledge' => 'nullable|array',
            'levels.*.knowledge.*' => 'string',
            'levels.*.ability' => 'nullable|array',
            'levels.*.ability.*' => 'string',
        ];
    }
}
