<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MasterCity;

class MasterProvince extends Model
{

    protected $table = 'provinces';
    protected $fillable = [
        'name',
        'state_id'

    ];


    public function cities()
    {
        return $this->belongsTo(MasterCity::class);
    }
}
