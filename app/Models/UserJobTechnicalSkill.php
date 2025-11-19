<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserJobTechnicalSkill extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function masterTechnicalSkill()
    {
        return $this->belongsTo(MasterTechnicalSkill::class, 'job_technical_skill_id');
    }

}
