<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LlmSoftSkillDescription extends Model
{
    use HasFactory;
    protected $table = 'llm_soft_skill_descriptions';

    protected $fillable = [
        'job_id',
        'soft_skill_id',
        'soft_skill_title',
        'description',
        'tp_details',
        'level_1',
        'level_1_ability',
        'level_1_knowledge',
        'level_2',
        'level_2_ability',
        'level_2_knowledge',
        'level_3',
        'level_3_ability',
        'level_3_knowledge',
    ];

    // Relationship with Job Model
    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }

    // Relationship with SoftSkill Model
    public function softSkill()
    {
        return $this->belongsTo(MasterSkill::class,'soft_skill_id');
    }
}
