<?php

namespace App\Services;

use App\Models\{CriticalWorkFunction, SoftSkillMaster, MasterTechnicalSkill, Sector, SubSector};
use Illuminate\Support\Facades\DB;

class AiResponseService
{
    public function processAiResponse(array &$aiResponse)
    {
        DB::transaction(function () use (&$aiResponse) {
            // Validate and Insert Critical Work Functions
            foreach ($aiResponse['jobRole']['critical_functions'] as &$cwf) {
                $existingCwf = CriticalWorkFunction::firstOrCreate(
                    ['description' => $cwf['cwf_description']],
                    ['description' => $cwf['cwf_description']]
                );
                $cwf['cwf_id'] = $existingCwf->id; // Update AI response with DB ID
            }

            // Validate and Insert Soft Skills
            foreach ($aiResponse['jobRole']['soft_skills'] as &$softSkill) {
                $existingSoftSkill = SoftSkillMaster::firstOrCreate(
                    ['name' => $softSkill['competency']],
                    ['description' => $softSkill['level_1'] ?? 'No description provided']
                );
                $softSkill['soft_skill_id'] = $existingSoftSkill->id; // Update AI response
            }

            // Validate and Insert Technical Skills
            foreach ($aiResponse['jobRole']['technical_skills'] as &$techSkill) {
                $existingTechSkill = MasterTechnicalSkill::firstOrCreate(
                    ['name' => $techSkill['name']],
                    ['description' => $techSkill['description'] ?? 'No description provided']
                );
                $techSkill['technical_skill_id'] = $existingTechSkill->id; // Update AI response
            }

            // Validate and Insert Sector and Sub-Sector
            if (!empty($aiResponse['jobRole']['sector_name'])) {
                $sector = Sector::firstOrCreate(['name' => $aiResponse['jobRole']['sector_name']]);
                $aiResponse['jobRole']['sector_id'] = $sector->id; // Update AI response
            }

            if (!empty($aiResponse['jobRole']['sub_sector_name'])) {
                $subSector = SubSector::firstOrCreate(
                    ['name' => $aiResponse['jobRole']['sub_sector_name']],
                    ['sector_id' => $sector->id ?? null]
                );
                $aiResponse['jobRole']['sub_sector_id'] = $subSector->id; // Update AI response
            }
        });
    }
}
