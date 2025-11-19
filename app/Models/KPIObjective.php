<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KPIObjective extends Model
{
    use HasFactory;
    protected $table = 'kpi_objectives';
    protected $fillable = [
        'kpi_id',
        'weightage',
    ];

    public function kpi()
    {
        return $this->belongsTo(Kpi::class, 'kpi_id');
    }

    public function keys()
    {
        return $this->hasMany(KPIObjectiveKey::class, 'objective_id');
    }
}
