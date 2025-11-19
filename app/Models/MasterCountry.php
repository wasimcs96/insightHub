<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MasterState;
use App\Models\MasterBarangay;


class MasterCountry extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = ['name','country_code'];

    protected $table = "master_countries";



    public function states()
    {
        return $this->hasMany(MasterState::class);
    }

    public function barangays()
    {
        return $this->hasMany(MasterBarangay::class);
    }
}
