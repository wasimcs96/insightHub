<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillReviewDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'remark',
        'skill_type',
        'skill_review_id',
        'level',
        'manager_evaluation',
    ];

    public function skillReview()
    {
        return $this->belongsTo(SkillReview::class, 'skill_review_id');
    }
}
