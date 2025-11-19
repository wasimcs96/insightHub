<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToTenant;

class MasterTechnicalSkill extends Model
{
    protected $table = 'master_technical_skills';

    use HasFactory,BelongsToTenant;

        
    protected $guarded = [];
    protected $fillable = ['name', 'description', 'category_id', 'sector_id','sector_name','sub_sector_name',
    'level_1_knowledge', 'level_1_ability', 'level_1_description',
    'level_2_knowledge', 'level_2_ability', 'level_2_description',
    'level_3_knowledge', 'level_3_ability', 'level_3_description',
    'level_4_knowledge', 'level_4_ability', 'level_4_description',
    'level_5_knowledge', 'level_5_ability', 'level_5_description',
    'level_6_knowledge', 'level_6_ability', 'level_6_description',
    'is_custom', 'master_technical_skill_id','is_overwrite','tenant_id'];
    public function getRelevantLevels()
    {
        $levels = [];
    
        for ($i = 1; $i <= 6; $i++) {
            $desc = $this->{"level_{$i}_description"};
    
            if ($desc) {
                $levels[] = [
                    'level' => $i,
                    'title' => $desc,
                    'knowledge' => $this->{"level_{$i}_knowledge"} ?? '',
                    'ability' => $this->{"level_{$i}_ability"} ?? '',
                ];
            }
        }
    
        return $levels;
    }
    public function jobTechnicalSkills()
    {
        return $this->hasMany(JobTechnicalSkills::class, 'master_technical_skill_id');
    }

        public function category()
    {
        return $this->belongsTo(TechnicalSkillCategory::class, 'category_id');
    }

         public function sector()
    {
        return $this->belongsTo(MasterSector::class, 'sector_id');
    }

     public function children()
    {
        return $this->hasMany(MasterTechnicalSkill::class, 'master_technical_skill_id');
    }

    // Method to count custom child skills
    public function customChildrenCount()
    {
        return $this->children()->whereIn('is_custom', [1,2])->count();
    }

    public function cognitiveDomains()
    {
        return $this->hasMany(MasterTechnicalSkillCognitiveDomain::class);
    }
}
