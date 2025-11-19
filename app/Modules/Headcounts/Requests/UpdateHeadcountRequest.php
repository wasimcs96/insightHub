<?php

namespace App\Modules\Headcounts\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateHeadcountRequest extends FormRequest
{
    public function authorize()
    {
        // You can add policy checks here, e.g.:
        return auth()->user()->can('update', \App\Models\JobHeadcount::class);
    }

    public function rules()
    {
        // Grab the headcount ID from the route, e.g. /headcounts/{headcount}
        $hcId = $this->route('headcount');

        return [
            'headcount_code' => [
                'required',
                'regex:/^[A-Z0-9]+-\d+-\d{2}$/',
                // unique on the table, but ignore this record’s own code
                Rule::unique('job_headcounts', 'headcount_code')->ignore($hcId),
            ],
            'job_id'           => 'required|integer|exists:jobs,id',
            'parent_id'        => 'nullable|integer|exists:job_headcounts,id',
            'department_id'    => 'required|integer|exists:departments,id',
            'headcount_number' => 'required|integer|min:1',
        ];
    }
}
