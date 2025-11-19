<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterFacet extends Model
{
    use HasFactory;

    function facetQuestions()
    {
        return $this->hasMany(FacetQuestion::class, 'facet_id');
    }
}
