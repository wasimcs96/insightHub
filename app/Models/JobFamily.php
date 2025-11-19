<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobFamily extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'job_family_group_id'];

    public function jobFamilyGroup()
    {
        return $this->belongsTo(JobFamilyGroup::class);
    }

    public function jobProfiles()
    {
        return $this->hasMany(JobProfile::class);
    }

    public function airAsiaJobs()
    {
        return $this->hasMany(AirAsiaFamilyJob::class, 'job_family_id');
    }

}
