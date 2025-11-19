<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterLeave extends Model
{
    use HasFactory;

    protected $table = "master_leaves";
    protected $fillable = ['name','days_per_year','entitlement','eligibility','purpose','cumulative'];
}
