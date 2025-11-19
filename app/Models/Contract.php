<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    protected $appends = ['contract_pdf_url'];
 
    public function getContractPdfUrlAttribute()
    {
        return asset($this->contract_pdf);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','employee_id','id');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\User', 'company_id', 'id');
    }

    public function jobPosition()
    {
        return $this->belongsTo('App\Models\Job', 'job_id', 'id');
    }

    public function jobApplication()
    {
        return $this->belongsTo('App\Models\JobOpeningApplication', 'job_application_id', 'id');
    }
    
}
