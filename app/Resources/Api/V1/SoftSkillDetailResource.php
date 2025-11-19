<?php

namespace App\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class SoftSkillDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        // Build level blocks (1..3)
        $levels = [];
        for ($i = 1; $i <= 3; $i++) {
            $levels[] = [
                'level'        => $i,
                'description'  => $this->{"level_{$i}"} ?? null,
                'knowledge'    => $this->{"level_{$i}_knowledge"} ?? null,
                'ability'      => $this->{"level_{$i}_ability"} ?? null,
            ];
        }

        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'description'  => $this->description,
            // Per-level details
            'levels'       => $levels,
            // Timestamps (ISO 8601)
            'created_at'   => optional($this->created_at)->toISOString(),
            'updated_at'   => optional($this->updated_at)->toISOString(),
        ];
    }
}
