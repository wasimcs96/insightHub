<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CwfFunction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'cwf_keys';
}
