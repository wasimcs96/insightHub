<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacetQuestionOption extends Model
{
    use HasFactory;

    function facetQuestion()
    {
        return $this->belongsTo(FacetQuestion::class, 'facet_question_id');
    }
}
