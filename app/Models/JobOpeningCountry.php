<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpeningCountry extends Model
{
    use HasFactory;

    public function master_country()
    {
        return $this->belongsTo(MasterCountry::class, 'country_id');
    }
}
