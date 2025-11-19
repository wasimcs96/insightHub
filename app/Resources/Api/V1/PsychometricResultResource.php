<?php

namespace App\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PsychometricResultResource extends JsonResource
{
    public function toArray($request): array
    {
        $levelDescription = '';
        if (($this->assessment_type == 'cognitive') && ($this->result_type == 'cognitive')) {
            $levelDescription = config('helpers.cognitive_ability_levels')[$this->level];
        } elseif ($this->result_type == 'rci') {
            $levelDescription = config('helpers.rci_levels')[$this->level];
        } elseif ($this->result_type == 'ccs') {
            $levelDescription = config('helpers.ccs_levels')[$this->level];
        } else {
            $levelDescription = config('helpers.talent_pillar_match_rate_levels')[$this->level];
        }
        return [
            // 'id'                => $this->id,
            // 'user_id'           => $this->user_id,
            'job_id'            => $this->when(isset($this->job_id), $this->job_id),
            'assessment_type'   => $this->assessment_type,
            'result_type'       => $this->result_type,
            'name'              => $this->name,
            'slug'              => $this->slug,
            // 'code'              => $this->code,
            // 'descriptor_id'     => $this->when(isset($this->descriptor_id), $this->descriptor_id),
            'description'       => $this->when(isset($this->description), $this->description),
            'score'      => $this->when(isset($this->score), round((float) $this->score, 2)),
            'z_score'    => $this->when(isset($this->z_score), round((float) $this->z_score, 2)),
            'level'      => $this->when(isset($this->level), (int) $this->level),
            'percentage' => $this->when(isset($this->percentage), round((float) $this->percentage, 2)),
            'level_description' => $levelDescription,
            // 'created_at'        => optional($this->created_at)->toIso8601String(),
            // 'updated_at'        => optional($this->updated_at)->toIso8601String(),
        ];
    }
}
