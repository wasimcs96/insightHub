<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacetQuestion extends Model
{
    use HasFactory;

    function facetQuestionOptions()
    {
        return $this->hasMany(FacetQuestionOption::class, 'facet_question_id');
    }
}
