<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamEmployees extends Model
{
    protected $table = 'teams_employees';
    protected $guarded = ['id'];
    use HasFactory;

    public function team()
    {
        return $this->belongsTo('App\Models\Team', 'team_id', 'id');
    }
}
