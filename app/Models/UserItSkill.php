<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserItSkill extends Model
{

    protected $fillable = [
        'user_id',
        'it_skill_id'
    ];

    public function master_it_skill()
    {
        return $this->belongsTo(MasterItSkill::class, 'it_skill_id');
    }
}
