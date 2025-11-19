<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpi extends Model
{
    use HasFactory;
    protected $table = "kpis";
    protected $fillable = [
        'user_id',
        'kpi_type',
        'kpi_date',
        'kpi_year',
        'approved',
        'skill_review_id',
        'manager_id',
        'confirm',
    ];

    public function objectives()
    {
        return $this->hasMany(KPIObjective::class, 'kpi_id');
    }

    public function skillReview()
    {
        return $this->belongsTo(SkillReview::class, 'skill_review_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

