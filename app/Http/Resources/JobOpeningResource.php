<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobOpeningResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'job_title' => $this->job_title,
            'slug' => $this->slug,
            'company_id' => $this->company_id,
            'company_name' => $this->company->name ?? 'N/A',
            'position_id' => $this->position_id,
            'position_name' => $this->job_position->title ?? 'N/A',
            'department_id' => $this->department_id,
            'department_name' => $this->department->head_of_department ?? 'N/A',
            'user_type' => $this->user_type,
            'employment_type' => $this->employment_type,
            'overview_of_company' => $this->overview_of_company,
            'job_role_description' => $this->job_role_description,
            'industry_id' => $this->industry_id,
            'industry_name' => $this->industry->name ?? 'N/A', // Assuming the 'name' attribute exists
            'education_level_id' => $this->education_level_id,
            'education_level_name' => $this->education_level->name ?? 'N/A',
            'education_year_id' => $this->education_year_id,
            'education_year_name' => $this->education_year->name ?? 'N/A',
            'education_program_id' => $this->education_program_id,
            'education_program_name' => $this->education_program->name ?? 'N/A',
            'certificate' => $this->certificate,
            'work_experience' => $this->work_experience,
            'salary' => $this->salary,
            'cities' => JobOpeningCityResource::collection($this->whenLoaded('cities')),
            'job_skills' => JobOpeningJobSkillResource::collection($this->whenLoaded('job_skills')),
            'job_technical_skills' => JobOpeningJobTechnicalSkillResource::collection($this->whenLoaded('job_technical_skills')),
            // Continue with the rest of the fields
        ];
    }
}
