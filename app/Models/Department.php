<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JobOpening;
use App\Traits\BelongsToTenant;

class Department extends Model
{
    use BelongsToTenant; //use only for tenant specific tables and update fillable array with tenant_id

    protected $guarded = ['id'];

    protected $fillable = ['company_id',
                            'name',
                            'division_id',
                            'user_id',
                            'head_of_department',
                            'status',
                            'tenant_id',
                            'number_of_pax',
                            'location'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function jobProfiles()
    {
        return $this->hasMany(JobProfile::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    // public function jobs()
    // {
    //     return $this->hasMany(Job::class, 'org_department', 'id');
    // }

    public function company()
    {
        return $this->belongsTo('App\Models\User', 'company_id', 'id');
    }

    public function sections()
    {
        return $this->hasMany(DepartmentSection::class);
    }

    public function units()
    {
        return $this->hasManyThrough(SectionUnit::class, DepartmentSection::class);
    }

    public function usersList()
    {
        return $this->hasMany('App\Models\User','department_id');
    }

    public function jobOpenings()
    {
        return $this->hasMany(JobOpening::class);
    }
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

}
