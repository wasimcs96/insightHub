<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSkill extends Model
{
    use HasFactory;

    public function llmSoftSkillDescriptions() {
        return $this->hasMany(LlmSoftSkillDescription::class);
    }
}
