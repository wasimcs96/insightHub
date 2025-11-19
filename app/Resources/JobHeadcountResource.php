<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobHeadcountResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'               => $this->id,
            'headcount_code'   => $this->headcount_code,
            'headcount_number' => $this->headcount_number,
            'is_filled'        => (bool) $this->is_filled,
            'status'           => $this->status,
            'department_id'    => $this->department_id,
            'job_title'        => optional($this->job)->title,
            'created_at'       => $this->created_at->toDateTimeString(),
        ];
    }
}
