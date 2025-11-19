<?php

namespace App\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class JobDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        // Basic identity
        $title  = $this->title ?? null;
        $description = $this->description ?? null;
        $departmentName = $this->department->name ?? null;
        $level = $this->level ?? null; 
        $positionCode = $this->position_code ?? null; 
        $technicalSkills = TechnicalSkillResource::collection($this->jdTechSkills) ?? [];
        $softSkills = SoftSkillResource::collection($this->skills) ?? [];


        return [
            'id'   => $this->id,
            'title' => $title,
            'department_name' => $departmentName,
            'level' => $level,
            'position_code' => $positionCode,
            'technical_skills' => $technicalSkills,
            'soft_skills' => $softSkills
        ];
    }
}
