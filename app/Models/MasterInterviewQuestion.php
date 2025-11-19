<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;

class MasterInterviewQuestion extends Model
{
    use HasFactory;

    protected $table = "master_interview_questions";
    protected $guarded = [];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
    
    public function department()
    {
        return $this->belongsTo(Department::class);
    }


    public function interviewResponse()
    {
        return $this->hasMany(JobOpeningApplicationInterviewResponse::class,'id');
    }
}
