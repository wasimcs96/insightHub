<?php

namespace App\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'title'             => $this->title,
            'position_code'     => $this->position_code,
            'level'             => $this->level,
            // 'job_full_title'    => $this->job_full_title,
            // 'vacancy'           => $this->vacancy,
            
            // Master data
            // 'master_id'         => $this->master_id,
            // 'job_profile_id'    => $this->job_profile_id,
            
            // Organization structure
            // 'business_unit_id'  => $this->business_unit_id,
            // 'division_id'       => $this->division_id,
            // 'department_id'     => $this->department_id,
            // 'superior_id'       => $this->superior_id,
            
            // Education requirements
            // 'education_level'   => $this->education_level,
            // 'scope_of_study'    => $this->scope_of_study,
            
            // Experience
            // 'experience_years'  => $this->experience_years ?? null,
            
            // Status
            'status'         => $this->status ?? null,
            'status_title'    => ($this->status == 1) ? 'Approved' : 'Pending',
            
            // Relationships (loaded conditionally)
            'business_unit'     => $this->whenLoaded('businessUnit', function () {
                return [
                    'id'   => $this->businessUnit->id,
                    'name' => $this->businessUnit->name ?? null,
                ];
            }),
            
            'division'          => $this->whenLoaded('division', function () {
                return [
                    'id'   => $this->division->id,
                    'name' => $this->division->head_of_division ?? null,
                ];
            }),
            
            'department'        => $this->whenLoaded('department', function () {
                return [
                    'id'   => $this->department->id,
                    'name' => $this->department->name ?? null,
                ];
            }),
            
            // 'job_profile'       => $this->whenLoaded('jobProfile', function () {
            //     return [
            //         'id'   => $this->jobProfile->id,
            //         'name' => $this->jobProfile->name ?? null,
            //     ];
            // }),
            
            // 'superior'          => $this->whenLoaded('superior', function () {
            //     return [
            //         'id'    => $this->superior->id,
            //         'title' => $this->superior->title ?? null,
            //     ];
            // }),
            
            // Timestamps
            'created_at'        => $this->created_at?->toIso8601String(),
            'updated_at'        => $this->updated_at?->toIso8601String(),
        ];
    }
}