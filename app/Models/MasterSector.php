<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSector extends Model
{
    use HasFactory;
    
    public function users()
    {
        return $this->hasMany(User::class, 'sector_id');
    }

    public function subSectors()
    {
        return $this->hasMany(MasterSubSector::class, 'sector_id');
    }
}
