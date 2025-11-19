<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDraft extends Model
{
    use HasFactory;

    // Define table name
    protected $table = 'job_drafts';

    // Define fillable fields to protect against mass assignment
    protected $fillable = [
        'job_id', 
        'position_code', 
        'headcount_code', 
        'created_by',
    ];

    // Relationship: A JobDraft belongs to a Job
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    // Relationship: A JobDraft belongs to a User (who created it)
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
