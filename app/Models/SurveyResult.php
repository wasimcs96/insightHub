<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyResult extends Model
{
    use HasFactory;
    protected $table = "survey_results";
    protected $fillable = ['survey_question_id', 'user_id', 'answer','survey_id','answer_id'];

    public function questions()
    {
        return $this->belongsTo(SurveyQuestion::class,'survey_question_id');
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class,'survey_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   
public function answers()
{
    return $this->belongsTo(SurveyAnswer::class,'answer_id');
}

}
