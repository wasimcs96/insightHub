<?php

namespace App\Resources\Api\V1;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Resources\Json\JsonResource;


class EmployeeResource extends JsonResource
{
    public function toArray($request): array
    {
        $name = $this->name ?? $this->full_name ?? null;
        $email = $this->email ?? null;


        // department
        $deptId = $this->department_id; // from join
        $deptName = $this->department_name ?? $this->alt_department_name
        ?? optional($this->department)->name ?? optional($this->department)->department_name;


        // job / position
        $positionId = $this->position_id ?? $this->job_id;
        $jobTitle = $this->job_title ?? optional($this->position)->title;
        $jobLevel = $this->job_level ?? optional($this->position)->level;

        if (isset($this->profile_picture) && File::exists(public_path($this->profile_picture))) {
            $profilePicture = $this->profile_picture;
        }else{
            $profilePicture = asset('/admin/media/svg/org-chart-svg/user-new.svg');
        }
        return [
            'id' => $this->id,
            'name' => $name,
            'email' => $email,
            'department_id' => $deptId,
            'department' => $deptName,
            'job_id' => $positionId,
            'job_title' => $jobTitle,
            'job_level' => $jobLevel,
            'profile_picture' => $profilePicture
        ];
    }
}