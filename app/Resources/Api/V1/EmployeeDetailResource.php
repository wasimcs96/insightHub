<?php

namespace App\Resources\Api\V1;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeDetailResource extends JsonResource
{
    public function toArray($request): array
    {
        // Basic identity
        $name  = $this->name ?? $this->full_name ?? null;
        $email = $this->email ?? null;
        $phone = $this->phone ?? $this->mobile_number ?? null; // optional columns

        // Department
        $deptId   = $this->department_id;
        $deptName = $this->department_name
            ?? $this->alt_department_name
            ?? optional($this->department)->name
            ?? optional($this->department)->department_name;

        // Division
        $divisionId   = $this->division_id ?? $this->joined_division_id;
        $divisionName = $this->division_name ?? optional($this->division)->name;

        // Business Unit
        $buId   = $this->business_unit_id ?? $this->joined_business_unit_id;
        $buName = $this->business_unit_name ?? optional(optional($this->division)->businessUnit)->name;

        // Job / Position
        $positionId = $this->position_id ?? $this->job_id;
        $jobTitle   = $this->job_title ?? optional($this->position)->title;
        $jobLevel = $this->job_level ?? optional($this->position)->level;


        // Timestamps
        $createdAt = $this->created_at;
        $updatedAt = $this->updated_at;

        if (isset($this->profile_picture) && File::exists(public_path($this->profile_picture))) {
            $profilePicture = $this->profile_picture;
        }else{
            $profilePicture = asset('/admin/media/svg/org-chart-svg/user-new.svg');
        }

        return [
            'id'   => $this->id,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'profile_picture' => $profilePicture,
            
            'department_id'   => $deptId,
            'department_name' => $deptName,

            'division_id'   => $divisionId,
            'division_name' => $divisionName,

            'business_unit_id'   => $buId,
            'business_unit_name' => $buName,

            'job_id' => $positionId,
            'job_title'   => $jobTitle,
            'job_level'   => $jobLevel,

            'created_at' => optional($createdAt)?->toIso8601String(),
            'updated_at' => optional($updatedAt)?->toIso8601String(),
        ];
    }
}
