<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyOrgChartChangesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            // top‐level JSON must be arrays
            'old'               => ['required'],
            'new'               => ['required'],
            'changes'           => ['required'],
            'reasons'           => ['sometimes'],

            // additions block
            'changes.additions'               => ['sometimes'],
            'changes.additions.*.action'      => ['required_with:changes.additions', 'in:add,update,delete'],
            'changes.additions.*.parentId'    => ['required_with:changes.additions', 'string'],
            'changes.additions.*.timestamp'   => ['required_with:changes.additions', 'date_format:Y-m-d\TH:i:s.u\Z'],

            // each new node
            'changes.additions.*.node'                    => ['required_with:changes.additions'],
            'changes.additions.*.node.id'                 => [
                'required',
                'regex:/^[A-Z0-9]+-\d+-\d{2}$/'
            ],
            'changes.additions.*.node.data.title'         => ['required_with:changes.additions', 'string'],
            'changes.additions.*.node.data.department'    => ['required_with:changes.additions', 'string'],
            'changes.additions.*.node.data.code'          => [
                'required',
                'regex:/^[A-Z0-9]+-\d+-\d{2}$/'
            ],
            'changes.additions.*.node.data.name'          => ['required_with:changes.additions', 'string'],
            'changes.additions.*.node.data.level'         => ['required_with:changes.additions', 'integer', 'between:1,99'],
            // …add other data.* rules as needed

            // mirror for updates & deletions if you use them
        ];
    }

    public function messages(): array
    {
        return [
            'changes.additions.*.node.id.regex'   => 'Each headcount code must be in the format PREFIX-JOBID-XX.',
            'changes.additions.*.node.data.code.regex' => 'Each node.data.code must be in the format PREFIX-JOBID-XX.',
            'changes.additions.*.timestamp.date_format' => 'Timestamps must be ISO8601 (e.g. 2025-05-14T08:56:21.286Z).',
        ];
    }
}
