<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicalQuestionUserResponse extends Model
{
    use HasFactory;
    protected $table = "technical_question_user_responses";
    protected $fillable = ['master_technical_question_id','user_id','option_selected','is_correct','marks','level'];

    public function masterTechnical()
    {
        return $this->belongsTo(MasterTechnicalQuestion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
