<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedCandidates extends Model
{
    use HasFactory;

    Protected $table = 'saved_candidates';
    protected $guarded = ['id'];
    public $timestamps = false;
}
