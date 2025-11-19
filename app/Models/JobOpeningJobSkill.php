<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpeningJobSkill extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function master_job_skill()
    {
        return $this->belongsTo(JobSkill::class, 'job_skill_id');
    }

}
