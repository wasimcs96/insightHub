<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAllowance extends Model
{
    use HasFactory;
    
    protected $table = "master_allowances";
    protected $fillable = ['name'];
}
