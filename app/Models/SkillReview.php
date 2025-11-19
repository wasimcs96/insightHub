<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'manager_id',
        'user_id',
        'job_id',
        'department_id',
        'review_date',
        'position_id',
        'type',
        'approved',
        'confirm',
    ];

    public function kpis()
    {
        return $this->hasOne(Kpi::class, 'skill_review_id');
    }

    public function details()
    {
        return $this->hasMany(SkillReviewDetail::class, 'skill_review_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}