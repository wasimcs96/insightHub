<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSubSector extends Model
{
    use HasFactory;

    public function sector()
    {
        return $this->belongsTo(MasterSector::class, 'sector_id');
    }
}
