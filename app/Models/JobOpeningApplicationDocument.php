<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpeningApplicationDocument extends Model
{
    use HasFactory;
    protected $table = 'job_opening_application_documents';
    protected $guarded = [];
}
