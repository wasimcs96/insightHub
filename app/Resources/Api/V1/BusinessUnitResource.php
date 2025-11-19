<?php

namespace App\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;


class BusinessUnitResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name ?? $this->business_unit_name ?? null
        ];
    }
}