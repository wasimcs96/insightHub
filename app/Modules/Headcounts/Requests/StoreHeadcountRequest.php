<?php
namespace App\Modules\Headcounts\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHeadcountRequest extends FormRequest
{
    public function authorize()
    {
        // apply any auth logic here, e.g.:
        // return auth()->user()->can('create', \App\Models\JobHeadcount::class);
    }

    public function rules()
    {
        return [
            'headcount_code' => [
                'required',
                'regex:/^[A-Z0-9]+-\d+-\d{2}$/',
                'unique:job_headcounts,headcount_code',
            ],
            'job_id'          => 'required|integer|exists:jobs,id',
            'parent_id'       => 'nullable|integer|exists:job_headcounts,id',
            'department_id'   => 'required|integer|exists:departments,id',
            'headcount_number'=> 'required|integer|min:1',
        ];
    }
}
