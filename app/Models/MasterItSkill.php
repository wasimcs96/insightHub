<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterItSkill extends Model
{

    protected $fillable = [
        'name',
        'points'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_it_skills', 'it_skill_id', 'user_id');
    }
}
