<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobBookmark extends Model
{
    use HasFactory;

    protected $table = 'job_bookmarks';
    protected $guarded= ['id'];

    
}
