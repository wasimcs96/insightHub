<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpeningCriticalFunction extends Model
{
    use HasFactory;

    protected $table = 'job_opening_critical_functions';

    protected $fillable = [
        'job_opening_id',
        'description',
    ];
}
