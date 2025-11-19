<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jobOpeningApplicationUserDocument extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'job_application_id',
        'user_id',
        'document_id',
        'document',
    ];
    protected $table = 'job_application_user_documents';

    public function jobOpeningApplicationDocument()
    {
        return $this->belongsTo(JobOpeningApplicationDocument::class, 'document_id');
    }

}
