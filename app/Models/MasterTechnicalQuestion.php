<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTenant;
class MasterTechnicalQuestion extends Model
{
    use HasFactory , BelongsToTenant;
    protected $table = "master_technical_questions";
    protected $fillable = ['job_id','sierra_id','question_number','level','score','title','option_1','option_2','option_3',
    'option_4','option','correct_answer'];

    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }

    public function technicalQuestionUserResponse()
    {
        return $this->hasMany(TechnicalQuestionUserResponse::class);
    }
}
