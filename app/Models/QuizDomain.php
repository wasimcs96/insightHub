<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class QuizDomain extends Model
{
    use HasFactory;

    protected $casts = ['low' => AsArrayObject::class, 'moderate' => AsArrayObject::class, 'high' => AsArrayObject::class];

    public function quiz(){

      return $this->belongsTo(Quiz::class, 'quiz_id');

    }

    public function values(){

      return $this->hasMany(QuizDomainValue::class);

    }
}
