<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class QuizDomainValueQuestion extends Model
{
  use HasFactory;

  protected $casts = [
    'options' => 'array',
  ];


  public function quizDomainValue()
  {

    return $this->belongsTo(QuizDomainValue::class, 'quiz_domain_value_id');
  }

  public function answer()
  {

    return $this->hasOne(QuizDomainValueAnswer::class);
  }

  public function answers()
  {

    return $this->hasMany(QuizDomainValueAnswer::class);
  }
}
