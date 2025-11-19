<?php

namespace App\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class SoftSkillResource extends JsonResource
{
    public function toArray($request): array
    {
        $title = $this->title ?? null;
        $level = $this->level ?? 0;
        $description = $this->masterSkill->description ?? null;

        // Build dynamic column name (e.g. level_1, level_2...)
        $level_description_column = "level_{$level}";

        // Safely access master_skill relation if it exists
        $level_description = $this->masterSkill->{$level_description_column} ?? null;

        return [
            'id'                 => $this->id,
            'title'              => $title,
            'description'        => $description,
            'level'              => $level,
            'level_description'  => $level_description,
        ];
    }
}
