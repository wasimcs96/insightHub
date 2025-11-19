<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTenant;


class JobProfile extends Model
{
    use HasFactory, BelongsToTenant;

    protected $guarded = ['id'];

    public function jobFamily()
    {
        return $this->belongsTo(JobFamily::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function job()
    {
        return $this->hasMany(Job::class);
    }

    public function criticalFunctions()
{
    return $this->hasMany(CriticalFunction::class);
}

public function technicalSkills()
{
    return $this->hasMany(TechnicalSkill::class);
}

public function softSkills()
{
    return $this->hasMany(SoftSkill::class);
}


 public function airAsiaFamilyJobProfile()
    {
        return $this->hasOne(AirAsiaFamilyJob::class, 'job_profile_id');
    }
}
