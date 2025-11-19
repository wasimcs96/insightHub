<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpeningRelevantProfessionalCertificate extends Model
{
    use HasFactory;
    protected $table = 'job_opening_relevant_professional_certificates';
    protected $guarded = [];

    public function jobOpening()
    {
        return $this->belongsTo(JobOpening::class, 'job_opening_id', 'id');
    }
}
