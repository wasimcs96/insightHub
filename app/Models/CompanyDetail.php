<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    use HasFactory;

    protected $table = 'company_details';

    protected $guarded = ['id'];

    public function sector()
    {
        return $this->belongsTo('App\Models\CompanySector', 'sector_id', 'id');
    }

    public function masterSector()
    {
        return $this->belongsTo('App\Models\MasterSector', 'sector_id', 'id');
    }

    public function subSector()
    {
        return $this->belongsTo('App\Models\CompanySubSector', 'subsector_id', 'id');
    }

    public function masterSubSector()
    {
        return $this->belongsTo('App\Models\MasterSubSector', 'subsector_id', 'id');
    }

}
