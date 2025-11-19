<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_id',
        'module_id',
    ];

    /**
     * Get the plan that owns this module assignment.
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Get the module associated with this assignment.
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
}