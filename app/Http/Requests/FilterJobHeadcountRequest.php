<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterJobHeadcountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'department_id' => 'nullable|integer|exists:departments,id',
            'job_id'        => 'nullable|integer|exists:jobs,id',
            'status'        => 'nullable|string',
            'is_filled'     => 'nullable|boolean',
            'vacant'        => 'nullable|boolean',
            'parent_id'     => 'nullable|integer|exists:job_headcounts,id',
            'search'        => 'nullable|string|max:100',
            'per_page'      => 'nullable|integer|min:1|max:100',
        ];
    }
}
