<?php

namespace App\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class DivisionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'   => $this->id,
            'name' => $this->head_of_division ?? null,
            'business_unit' => $this->business_unit->name ?? null
        ];
    }
}
