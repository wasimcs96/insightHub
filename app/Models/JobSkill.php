<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{
    use HasFactory;
    protected $table = 'job_skills';
    protected $fillable = ['job_id','title','level'];
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function masterSkill() 
    {
        return $this->belongsTo(MasterSkill::class, 'title', 'name');
    }
    
}
