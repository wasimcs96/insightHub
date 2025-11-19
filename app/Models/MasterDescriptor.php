<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDescriptor extends Model
{
    use HasFactory;
    protected $table = "master_descriptors";
    protected $fillable = ['analysis_population','analysis','user_score_level','population_score_level','job_requirement_level',
    'user_type','code','slug','name','result_type','assessment_type','user_score_level_description','population_score_level_description','job_requirement_level_description','is_descriptor'];
}
