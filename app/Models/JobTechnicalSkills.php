<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTenant;

class JobTechnicalSkills extends Model
{
    use HasFactory,BelongsToTenant;
    protected $table = "job_technical_skills";
    protected $guarded = [];

    public function technicalSkill()
    {
        return $this->belongsToMany(TechnicalSkill::class, 'id','technical_skill_id');
    }
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function masterTechnicalSkill()
    {
        return $this->belongsTo(MasterTechnicalSkill::class, 'master_technical_skill_id');
    }
}
