<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{
    use HasFactory;
    protected $table = "survey_answers";
    protected $fillable = ['survey_question_id','user_id','answer','survey_id'];

    public function questions()
    {
        return $this->belongsTo(SurveyQuestion::class,'survey_question_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function surveyResults()
    {
        return $this->hasMany(SurveyResult::class,'answer_id');
    }
}
