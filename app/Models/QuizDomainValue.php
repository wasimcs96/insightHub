<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizDomainValue extends Model
{
    use HasFactory;

    public function quizDomain() {

      return $this->belongsTo(QuizDomain::class, 'quiz_domain_id');

    }

    public function questions() {

      return $this->hasMany(QuizDomainValueQuestion::class);

    }

    public function valueAnswerValuation(){

      return $this->hasOne(QuizDomainValueAnswerValuation::class);

    }

    public function answers(){

      return $this->hasManyThrough(QuizDomainValueAnswer::class, QuizDomainValueQuestion::class);

    }
}
