<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'company_value_name',
        'company_value_description',
        'facets',
        'developmental_stage_description',
        'basic_level_description',
        'intermediate_level_description',
        'advanced_level_description',
    ];

    protected $casts = [
        'facets' => 'array',
    ];
}
