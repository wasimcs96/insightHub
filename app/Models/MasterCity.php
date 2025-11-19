<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MasterState;
use App\Models\MasterBarangay;
use App\Models\MasterProvince;




class MasterCity extends Model
{

    protected $fillable = [
        'name',
        'state_id'
    ];
    protected $table = 'master_cities';


    public function states()
    {
        return $this->belongsTo(MasterState::class);
    }

    public function province()
    {
        return $this->hasMany(MasterProvince::class);
    }

    public function barangays()
    {
        return $this->belongsTo(MasterBarangay::class);
    }
}
