<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Survey_Answer;

class SurveyQuestion extends Model
{
    use HasFactory;
    protected $table = "survey_questions";
    static $multiple = 'multiple';

    static $descriptive = 'descriptive';


    protected $fillable = [
        'type',
        'question',
        'survey_id',
        'grade',
        'correct'
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function answers()
    {
        return $this->hasMany(SurveyAnswer::class, 'survey_question_id');
    }

    public function surveyResults()
    {
        return $this->hasMany(SurveyResult::class,'survey_question_id');
    }
}
