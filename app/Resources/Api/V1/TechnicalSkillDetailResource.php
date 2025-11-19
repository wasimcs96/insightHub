<?php

namespace App\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class TechnicalSkillDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        // Build level blocks (1..6)
        $levels = [];
        for ($i = 1; $i <= 6; $i++) {
            $levels[] = [
                'level'        => $i,
                'description'  => $this->{"level_{$i}_description"} ?? null,
                'knowledge'    => $this->{"level_{$i}_knowledge"} ?? null,
                'ability'      => $this->{"level_{$i}_ability"} ?? null,
            ];
        }

        return [
            'id'           => $this->id,
            'sector'       => [
                'id'         => $this->sector_id,
                'name'       => $this->sector_name,
                'sub_sector' => [
                    'id'   => $this->sub_sector_id,
                    'name' => $this->sub_sector_name,
                ],
            ],
            'code'         => $this->code,
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
