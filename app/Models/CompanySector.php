<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySector extends Model
{
    use HasFactory;

    protected $table = 'company_sector';

    protected $guarded = ['id'];

    public function sector()
    {
        return $this->belongsTo('App\Models\CompanySector', 'sector_id', 'id');
    }

}
