<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpeningJobTechnicalSkill extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function master_job_technical_skill()
    {
        return $this->belongsTo(TechnicalSkill::class, 'job_technical_skill_id');
    }

}
