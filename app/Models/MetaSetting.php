<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'setting_name',
        'year',
        'start_date',
        'end_date',
        'status',
    ];
}
