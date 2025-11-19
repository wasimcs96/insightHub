<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MasterTechnicalSkill;
class TechnicalSkill extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_technical_skills');
    }

    public function masterTechnicalSkill()
    {
        return $this->belongsTo(MasterTechnicalSkill::class, 'technical_skill_id');
    }
}
