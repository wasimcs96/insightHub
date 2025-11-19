<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpeningApplicationInterviewResponse extends Model
{
    use HasFactory;

    protected $table = 'job_opening_application_interview_responses';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function question()
    {
        return $this->belongsTo(MasterInterviewQuestion::class, 'master_interview_question_id');
    }

    public function jobOpeningApplication()
    {
        return $this->belongsTo(JobOpeningApplication::class, 'job_opening_application_id');
    }


}
