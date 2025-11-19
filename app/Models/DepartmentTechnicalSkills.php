<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTenant;

class DepartmentTechnicalSkills extends Model
{
    use HasFactory,BelongsToTenant;

    protected $fillable = [
        'master_technical_skill_id',
        'department_id'
    ];

        public function technicalSkill()
    {
        return $this->belongsToMany(TechnicalSkill::class, 'id','technical_skill_id');
    }
        public function masterTechnicalSkill()
    {
        return $this->belongsTo(MasterTechnicalSkill::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

}
