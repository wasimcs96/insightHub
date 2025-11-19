<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizDomainValueAnswer extends Model
{
  use HasFactory;

  protected $fillable = ["user_id", "answer", "quiz_domain_value_question_id", "time_taken", "option_selected", "is_correct", "level_of_difficulty", "is_anchor_wrong", "language"];

  public function question()
  {

    return $this->belongsTo(QuizDomainValueQuestion::class, 'quiz_domain_value_question_id');
  }


  public function user()
  {

    return $this->belongsTo(User::class, 'user_id');
  }
}
