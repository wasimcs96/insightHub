<?php

namespace App\Services;

use App\Models\TechnicalSkill;

class TechnicalSkillService
{
    public function save(array $data)
    {
        $skill = TechnicalSkill::updateOrCreate(
            ['name' => $data['name']],
            ['description' => $data['description']]
        );

        foreach ($data['levels'] as $level) {
            $skill->levels()->updateOrCreate(
                ['level' => $level['level']],
                [
                    'description' => $level['description'],
                    'knowledge' => json_encode($level['knowledge']),
                    'ability' => json_encode($level['ability']),
                ]
            );
        }
    }
}

