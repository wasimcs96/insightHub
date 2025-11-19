<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCriticalFunction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function cwfKeys()
    {
        return $this->hasMany(CwfFunction::class, 'cwf_id', 'id');
    }
}
