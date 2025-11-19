<?php

namespace App\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class SectorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'sector_name' => $this->name,
            'sub_sectors' => $this->subSectors->map(function ($subSector) {
                return [
                    'id'   => $subSector->id,
                    'name' => $subSector->name,
                ];
            }),
        ];
    }
}