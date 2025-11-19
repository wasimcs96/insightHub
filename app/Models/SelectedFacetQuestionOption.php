<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectedFacetQuestionOption extends Model
{
    use HasFactory;
    protected $table = "selected_facet_question_options";

    protected $guarded = [];
}
