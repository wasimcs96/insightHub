<?php

namespace App\Resources\Api\V1;


use Illuminate\Http\Resources\Json\JsonResource;


class DepartmentResource extends JsonResource
{
    public function toArray($request): array
    {
        // Department display name may be 'name' or 'department_name'
        $deptName = $this->name ?? null;

        // Division fields (aliased by join). If your columns differ, adjust here.
        $divisionId = $this->division_id; // from departments + join (same id)
        $divisionName = $this->division_name
        ?? ($this->division->head_of_division ?? null );


        // Business Unit fields (aliased by join)
        $buId = $this->business_unit_id ?? $this->joined_business_unit_id ?? null;
        $buName = $this->business_unit_name
        ?? ($this->division->businessUnit->name ?? null);


        return [
        'id' => $this->id,
        'name' => $deptName,
        'division_id' => $divisionId,
        'division_name' => $divisionName,
        'business_unit_id' => $buId,
        'business_unit_name' => $buName,
        ];
    }
}