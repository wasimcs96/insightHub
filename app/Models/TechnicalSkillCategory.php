<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicalSkillCategory extends Model
{
    protected $guarded = [];

    use HasFactory;

    // In TechnicalSkillCategory.php
public function technicalSkills()
{
    return $this->hasMany(MasterTechnicalSkill::class, 'category_id');
}
}
