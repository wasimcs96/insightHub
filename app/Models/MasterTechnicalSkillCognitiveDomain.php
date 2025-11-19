<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MasterTechnicalSkillCognitiveDomain extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'master_technical_skill_id',
        'name',
        'level',
        'qk_ka_count',
        'ck_ka_count',
        'vr_ka_count',
        'fr_ka_count',
        'ka_total_count',
        'qk_ka_percentage',
        'ck_ka_percentage',
        'vr_ka_percentage',
        'fr_ka_percentage',
        'qk_ka_level',
        'ck_ka_level',
        'vr_ka_level',
        'fr_ka_level'
    ];

    /**
     * Get the technical skill that owns this cognitive domain.
     */
    public function technicalSkill(): BelongsTo
    {
        return $this->belongsTo(
            MasterTechnicalSkill::class,
            'master_technical_skill_id',
            'id'
        );
    }

    public function masterTechnicalSkill(): BelongsTo
    {
        return $this->belongsTo(
            MasterTechnicalSkill::class,
            'master_technical_skill_id',
            'id'
        );
    }

    /**
     * Calculate the total percentage of all KA types.
     *
     * @return float
     */
    public function getTotalPercentageAttribute(): float
    {
        return round(
            ($this->qk_ka_percentage + 
             $this->ck_ka_percentage + 
             $this->vr_ka_percentage + 
             $this->fr_ka_percentage),
            2
        );
    }

    /**
     * Calculate the average KA count across all types.
     *
     * @return float
     */
    public function getAverageKaCountAttribute(): float
    {
        $counts = [
            $this->qk_ka_count,
            $this->ck_ka_count,
            $this->vr_ka_count,
            $this->fr_ka_count
        ];
        
        return round(array_sum($counts) / count($counts), 2);
    }
}