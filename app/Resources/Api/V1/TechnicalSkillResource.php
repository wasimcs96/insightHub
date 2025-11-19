<?php

// FILE: app/Domain/Employee/Resources/EmployeeDetailResource.php

namespace App\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class TechnicalSkillResource extends JsonResource
{
    public function toArray($request): array
    {
        // Basic identity
        $title  = $this->masterTechnicalSkill->name ?? null;
        $level = $this->level ?? 0;
        $description = $this->masterTechnicalSkill->description ?? null;
        $property = "level_{$this->level}_description";
        $levelDescription = $this->masterTechnicalSkill->{$property} ?? '';

        $id = $this->masterTechnicalSkill->id ?? 0;

        return [
            'id'   => $id,
            'title' => $title,
            'description' => $description,
            'level' => $level,
            'level_description' => $levelDescription

        ];
    }
}
