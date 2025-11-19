<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEmployment extends Model
{

    protected $guarded = ['id'];

    public function softSkills() {
        return $this->hasMany(UserJobSkill::class, 'employment_id');
    }

    public function technicalSkills() {
        return $this->hasMany(UserJobTechnicalSkill::class, 'employment_id');
    }
}
