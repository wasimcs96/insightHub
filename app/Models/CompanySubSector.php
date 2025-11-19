<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySubSector extends Model
{
    use HasFactory;
    
    protected $table = 'company_subsector';
    
    public function users()
    {
        return $this->hasMany(User::class, 'sector_id');
    }
}
