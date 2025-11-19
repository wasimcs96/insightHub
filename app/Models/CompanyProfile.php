<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;
       protected $table = 'company_profiles';
       protected $fillable = [
        'tenant_id',
        'company_name',
        'business_registration_number',
        'date_established',
        'country',
        'company_size',
        'number_of_employees',
        'company_contact_number',
        'company_email',
        'company_website',
        'industry_sector',
        'sub_sector',
        'company_address',
        'company_logo',
    ];
}
