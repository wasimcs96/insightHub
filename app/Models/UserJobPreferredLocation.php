<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserJobPreferredLocation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function masterCity()
    {
        return $this->belongsTo(MasterCity::class, 'city_id');
    }

    public function masterCountry()
    {
        return $this->belongsTo(MasterCountry::class, 'country_id');
    }
}
