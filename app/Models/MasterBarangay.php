<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MasterCountry;
use App\Models\MasterCity;


class MasterBarangay extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['name'];
    protected $table = 'barangays';


    public function country()
{
    return $this->belongsTo(MasterCountry::class);
}

public function cities()
{
    return $this->hasMany(MasterCity::class);
}

}
 


