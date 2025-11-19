<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserJobSkill extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function masterSkill()
    {
        return $this->belongsTo(MasterSkill::class, 'job_skill_id');
    }
}
