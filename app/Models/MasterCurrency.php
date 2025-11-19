<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCurrency extends Model
{
    use HasFactory;

    protected $table = "master_currency";

    protected $fillable = [
        'currency_short_name',
        'currency_long_name',
        'symbol'
    ];
}
