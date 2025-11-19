<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Position extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function department()
    {
        return $this->belongsTo('App\Models\User', 'department_id', 'id');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User', 'position_id', 'id');
    }
}
