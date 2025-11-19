<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OceanAllFacetsCombination extends Model
{

    protected $fillable = [
        'facet',
        'opposite_facet',
        'ea',
        'eb',
        'description'
    ];
}
