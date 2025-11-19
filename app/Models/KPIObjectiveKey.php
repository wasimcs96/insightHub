<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KPIObjectiveKey extends Model
{
    use HasFactory;
    protected $table = "kpi_objective_keys";
    protected $fillable = [
        'objective_id',
        'base_target',
        'stretch_target',
        'rank',
        'kpi',
        'manager_evaluation',
        'employee_planning',
    ];

    public function objective()
    {
        return $this->belongsTo(KPIObjective::class, 'objective_id');
    }
}
