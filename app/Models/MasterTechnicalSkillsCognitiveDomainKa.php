<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterTechnicalSkillsCognitiveDomainKa extends Model
{
    // Specify the table name if it does not follow Laravel's naming convention
    protected $table = 'master_technical_skills_cognitive_domain_kas';

    // Specify the primary key if different from 'id'
    protected $primaryKey = 'id';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'master_technical_skill_id',
        'name',
        'level',
        'level_description',
        'type',
        'description',
        'cognitive_domain_name',
        'cognitive_domain_short_name',
        'cognitive_domain_id',
    ];

    // Optional: Casts to convert attributes to native types
    // protected $casts = [
    //     'master_technical_skill_id' => 'integer',
    //     'cognitive_domain_id' => 'integer',
    // ];

    // Optional: If using timestamps
    public $timestamps = true;

    // Define any relationships if needed, for example:
    // public function masterTechnicalSkill()
    // {
    //     return $this->belongsTo(MasterTechnicalSkill::class, 'master_technical_skill_id');
    // }

    // public function cognitiveDomain()
    // {
    //     return $this->belongsTo(CognitiveDomain::class, 'cognitive_domain_id');
    // }
}
