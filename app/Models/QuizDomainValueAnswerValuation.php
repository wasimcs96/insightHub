<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class QuizDomainValueAnswerValuation extends Model
{
    use HasFactory;

    protected $casts = ['low' => AsArrayObject::class, 'moderate' => AsArrayObject::class, 'high' => AsArrayObject::class];

    public function quizDomainValue(){

      $this->belongsTo(QuizDomainValue::class);

    }
}
