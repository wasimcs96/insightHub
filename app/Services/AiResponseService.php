<?php

namespace App\Services;

use App\Models\{CriticalWorkFunction, SoftSkillMaster, MasterTechnicalSkill, Sector, SubSector};
use Illuminate\Support\Facades\DB;
use App\Models\Job;
use App\Models\MasterSkill;

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


    public function formatJobs($id)
    {
        $job = Job::with([
            'skills',
            'technicalSkills',
            'sector',
            'criticalFunctions.cwfKeys'
        ])
        ->find($id);
    
        if (!$job) {
            throw new \Exception('Job not found or is primary.');
        }
    
        $skillTitles = $job->skills->pluck('title')->toArray();
    
        $masterSkills = MasterSkill::whereIn('name', $skillTitles)->get()->keyBy('name');
       
        return [
            'source' => 'formatJobsbyfamily',
            'job_id' => $job->id,
            'job_profile_id'=>$job->job_profile_id ?? '',
            'title' => $job->title,
            'job_role' => $job->title,
            'job_sector' => $job->sector->name ?? '',
            'department' => $job->department->name ?? '',
            'description' => $job->description ?? '',
            'top3riasec' => $job->top3riasec,
            'level' => $job->level,
            'sector' => optional($job->sector)->name,
            'track' => optional($job->track)->name,
            'sierra_id' => $job->sierra_id,
    
            // 'soft_skills' => $job->skills->map(function ($s) use ($masterSkills) {
            //     $master = $masterSkills[$s->title] ?? null;
    
            //     return [
            //         'title' => $s->title,
            //         'description' => $master->description ?? '',
            //         'level' => $s->level,
            //         'level_1' => $master->level_1_description ?? '',
            //         'level_2' => $master->level_2_description ?? '',
            //         'level_3' => $master->level_3_description ?? '',
            //         'level_1_knowledge' => array_filter(explode(';', $master->level_1_knowledge ?? '')),
            //         'level_2_knowledge' => array_filter(explode(';', $master->level_2_knowledge ?? '')),
            //         'level_3_knowledge' => array_filter(explode(';', $master->level_3_knowledge ?? '')),
            //         'level_1_ability' => array_filter(explode(';', $master->level_1_ability ?? '')),
            //         'level_2_ability' => array_filter(explode(';', $master->level_2_ability ?? '')),
            //         'level_3_ability' => array_filter(explode(';', $master->level_3_ability ?? '')),
            //     ];
            // }),

            'soft_skills' => $job->skills->map(function ($s) use ($masterSkills) {
            $master = $masterSkills[$s->title] ?? null;

            $levelLabels = [
                1 => 'Basic',
                2 => 'Intermediate',
                3 => 'Advanced'
            ];

            $preferredLevel = $s->level ?? null;

            return [
                'job_id' => $s->pivot->job_id ?? null,
                'competency' => $s->title,
                'description' => $master->description ?? '',
                'level' => $preferredLevel,
                'preferred_level' => $levelLabels[$preferredLevel] ?? '',

                'level_1' => $master->level_1_description ?? '',
                'level_2' => $master->level_2_description ?? '',
                'level_3' => $master->level_3_description ?? '',

                'level_1_knowledge' => array_filter(explode(';', $master->level_1_knowledge ?? '')),
                'level_2_knowledge' => array_filter(explode(';', $master->level_2_knowledge ?? '')),
                'level_3_knowledge' => array_filter(explode(';', $master->level_3_knowledge ?? '')),

                'level_1_ability' => array_filter(explode(';', $master->level_1_ability ?? '')),
                'level_2_ability' => array_filter(explode(';', $master->level_2_ability ?? '')),
                'level_3_ability' => array_filter(explode(';', $master->level_3_ability ?? '')),
            ];
        }),
    
        
            // 'technical_skills' => $job->technicalSkills->map(function ($skill) {
            //     // dd($skill->pivot);
            //     return [
            //         'id' => $skill->id,
            //         'name' => $skill->name,
            //         'level' => $skill->pivot->level ?? null,
            //         'description'=>$skill->description,
            //         'level_1_description' => $skill->level_1_description,
            //         'level_2_description' => $skill->level_2_description,
            //         'level_3_description' => $skill->level_3_description,
            //         'level_4_description' => $skill->level_4_description,
            //         'level_5_description' => $skill->level_5_description,
            //         'level_6_description' => $skill->level_6_description,
            //         'level_1_knowledge' => $skill->level_1_knowledge,
            //         'level_2_knowledge' => $skill->level_2_knowledge,
            //         'level_3_knowledge' => $skill->level_3_knowledge,
            //         'level_4_knowledge' => $skill->level_4_knowledge,
            //         'level_5_knowledge' => $skill->level_5_knowledge,
            //         'level_6_knowledge' => $skill->level_6_knowledge,
            //         'level_1_ability' => $skill->level_1_ability,
            //         'level_2_ability' => $skill->level_2_ability,
            //         'level_3_ability' => $skill->level_3_ability,
            //         'level_4_ability' => $skill->level_4_ability,
            //         'level_5_ability' => $skill->level_5_ability,
            //         'level_6_ability' => $skill->level_6_ability,
            //     ];
            // }),

            'technical_skills' => $job->technicalSkills->map(function ($skill) {
            $formatted = [
                'c_id' => $skill->id,
                'sector_id' => $skill->sector_id ?? null,
                'category_id' => $skill->category_id ?? null,
                'category_name' => $skill->category->title ?? null,
                'sector_name' => $skill->sector_name ?? null,
                'sub_sector_id' => $skill->sub_sector_id ?? null,
                'sub_sector_name' => $skill->sub_sector_name ?? null,
                'code' => $skill->id,
                'name' => $skill->name,
                'description' => $skill->description,
                'preferred_level' => $skill->pivot->level ?? null,
                'is_custom' => $skill->is_custom,
            ];

            // Dynamically loop through 6 levels
            for ($i = 1; $i <= 6; $i++) {
                $descKey = "level_{$i}_description";
                $knowKey = "level_{$i}_knowledge";
                $abilKey = "level_{$i}_ability";
            
                $desc = $skill->$descKey;
            
                $rawKnow = str_replace(';', ',', $skill->$knowKey ?? '');
                $rawAbil = str_replace(';', ',', $skill->$abilKey ?? '');
            
                $know = array_filter(array_map('trim', explode(',', $rawKnow)));
                $abil = array_filter(array_map('trim', explode(',', $rawAbil)));
            
                if ($desc || !empty($know) || !empty($abil)) {
                    $formatted[$descKey] = $desc;
                    $formatted[$knowKey] = $know;
                    $formatted[$abilKey] = $abil;
                }
            }
            

            return $formatted;
}),
    
            // 'critical_functions' => $job->criticalFunctions->map(function ($cf) {
            //     return [
            //         'id' => $cf->id,
            //         'description' => $cf->description,
            //         'cwf_keys' => $cf->cwfKeys->map(fn($key) => [
            //             'id' => $key->id,
            //             'name' => $key->name,
            //         ]),
            //     ];
            // }),

            'critical_functions' => $job->criticalFunctions->map(function ($cf) use ($job) {
            return [
                'job_id' => $job->id,
                'cwf_id' => $cf->id,
                'cwf_description' => $cf->description,
                'cwf_keys' => [
                    'keytasks' => $cf->cwfKeys->pluck('name')->toArray(),
                    'cwf_id' => $cf->id,
                ],
            ];
        }),
        ];
    }




    public function formatJobsbyfamily($id, $jobFamilyGroupId = null, $jobFamilyId = null, $jobProfileId = null)
{
    $job = Job::with([
        'skills',
        'technicalSkills',
        'sector',
        'criticalFunctions.cwfKeys'
    ])->find($id);

    if (!$job) {
        throw new \Exception('Job not found or is primary.');
    }

    $skillTitles = $job->skills->pluck('title')->toArray();
    $masterSkills = MasterSkill::whereIn('name', $skillTitles)->get()->keyBy('name');

    return [
        'source' => 'formatJobsbyfamily',
        'id'=>$job->id,
        'job_id' => $job->id,
        'job_profile_id' => $job->job_profile_id,
        'title' => $job->title,
        'job_role' => $job->title,
        'job_sector' => $job->sector->name ?? '',
        'department' => $job->department->name ?? '',
        'description' => $job->description ?? '',
        'top3riasec' => $job->top3riasec,
        'level' => $job->level,
        'sector' => optional($job->sector)->name,
        'track' => optional($job->track)->name,

        // ✅ Include these fields in the response
        'job_family_group' => $jobFamilyGroupId,
        'job_family' => $jobFamilyId,
        'job_role' => $jobProfileId,

        // 'soft_skills' => $job->skills->map(function ($s) use ($masterSkills) {
        //     $master = $masterSkills[$s->title] ?? null;
        //     return [
        //         'title' => $s->title,
        //         'description' => $master->description ?? '',
        //         'level' => $s->level,
        //         'level_1' => $master->level_1_description ?? '',
        //         'level_2' => $master->level_2_description ?? '',
        //         'level_3' => $master->level_3_description ?? '',
        //         'level_1_knowledge' => array_filter(explode(';', $master->level_1_knowledge ?? '')),
        //         'level_2_knowledge' => array_filter(explode(';', $master->level_2_knowledge ?? '')),
        //         'level_3_knowledge' => array_filter(explode(';', $master->level_3_knowledge ?? '')),
        //         'level_1_ability' => array_filter(explode(';', $master->level_1_ability ?? '')),
        //         'level_2_ability' => array_filter(explode(';', $master->level_2_ability ?? '')),
        //         'level_3_ability' => array_filter(explode(';', $master->level_3_ability ?? '')),
        //     ];
        // }),

        'soft_skills' => $job->skills->map(function ($s) use ($masterSkills) {
            $master = $masterSkills[$s->title] ?? null;

            $levelLabels = [
                1 => 'Basic',
                2 => 'Intermediate',
                3 => 'Advanced'
            ];

            $preferredLevel = $s->level ?? null;

            return [
                'job_id' => $s->pivot->job_id ?? null,
                'competency' => $s->title,
                'description' => $master->description ?? '',
                'level' => $preferredLevel,
                'preferred_level' => $levelLabels[$preferredLevel] ?? '',

                'level_1' => $master->level_1_description ?? '',
                'level_2' => $master->level_2_description ?? '',
                'level_3' => $master->level_3_description ?? '',

                'level_1_knowledge' => array_filter(explode(';', $master->level_1_knowledge ?? '')),
                'level_2_knowledge' => array_filter(explode(';', $master->level_2_knowledge ?? '')),
                'level_3_knowledge' => array_filter(explode(';', $master->level_3_knowledge ?? '')),

                'level_1_ability' => array_filter(explode(';', $master->level_1_ability ?? '')),
                'level_2_ability' => array_filter(explode(';', $master->level_2_ability ?? '')),
                'level_3_ability' => array_filter(explode(';', $master->level_3_ability ?? '')),
            ];
        }),


        // 'technical_skills' => $job->technicalSkills->map(function ($skill) {
        //     return [
        //         'id' => $skill->id,
        //         'name' => $skill->name,
        //         'level' => $skill->pivot->level ?? null,
        //         'description' => $skill->description,
        //         'level_1_description' => $skill->level_1_description,
        //         'level_2_description' => $skill->level_2_description,
        //         'level_3_description' => $skill->level_3_description,
        //         'level_4_description' => $skill->level_4_description,
        //         'level_5_description' => $skill->level_5_description,
        //         'level_6_description' => $skill->level_6_description,
        //         'level_1_knowledge' => $skill->level_1_knowledge,
        //         'level_2_knowledge' => $skill->level_2_knowledge,
        //         'level_3_knowledge' => $skill->level_3_knowledge,
        //         'level_4_knowledge' => $skill->level_4_knowledge,
        //         'level_5_knowledge' => $skill->level_5_knowledge,
        //         'level_6_knowledge' => $skill->level_6_knowledge,
        //         'level_1_ability' => $skill->level_1_ability,
        //         'level_2_ability' => $skill->level_2_ability,
        //         'level_3_ability' => $skill->level_3_ability,
        //         'level_4_ability' => $skill->level_4_ability,
        //         'level_5_ability' => $skill->level_5_ability,
        //         'level_6_ability' => $skill->level_6_ability,
        //     ];
        // }),

        // 'technical_skills' => $job->technicalSkills->map(function ($skill) {
        //     return [
        //         'c_id' => $skill->id,
        //         'sector_id' => $skill->sector_id ?? null,
        //         'sector_name' => $skill->sector_name ?? null,
        //         'sub_sector_id' => $skill->sub_sector_id ?? null,
        //         'sub_sector_name' => $skill->sub_sector_name ?? null,
        //         'code' => $skill->id,
        //         'name' => $skill->name,
        //         'description' => $skill->description,
        //         'preferred_level' => $skill->pivot->level ?? null,

        //         'level_1_description' => $skill->level_1_description,
        //         'level_1_knowledge' => explode('|', $skill->level_1_knowledge),
        //         'level_1_ability' => explode('|', $skill->level_1_ability),

        //         'level_2_description' => $skill->level_2_description,
        //         'level_2_knowledge' => explode('|', $skill->level_2_knowledge),
        //         'level_2_ability' => explode('|', $skill->level_2_ability),

        //         'level_3_description' => $skill->level_3_description,
        //         'level_3_knowledge' => explode('|', $skill->level_3_knowledge),
        //         'level_3_ability' => explode('|', $skill->level_3_ability),

        //         'level_4_description' => $skill->level_4_description,
        //         'level_4_knowledge' => explode('|', $skill->level_4_knowledge),
        //         'level_4_ability' => explode('|', $skill->level_4_ability),

        //         'level_5_description' => $skill->level_5_description,
        //         'level_5_knowledge' => explode('|', $skill->level_5_knowledge),
        //         'level_5_ability' => explode('|', $skill->level_5_ability),

        //         'level_6_description' => $skill->level_6_description,
        //         'level_6_knowledge' => explode('|', $skill->level_6_knowledge),
        //         'level_6_ability' => explode('|', $skill->level_6_ability),
        //     ];
        // }),

        'technical_skills' => $job->technicalSkills->map(function ($skill) {
            $formatted = [
                'c_id' => $skill->id,
                'sector_id' => $skill->sector_id ?? null,
                'category_id' => $skill->category_id ?? null,
                'category_name' => $skill->category->title ?? null,
                'sector_name' => $skill->sector_name ?? null,
                'sub_sector_id' => $skill->sub_sector_id ?? null,
                'sub_sector_name' => $skill->sub_sector_name ?? null,
                'code' => $skill->id,
                'name' => $skill->name,
                'description' => $skill->description,
                'preferred_level' => $skill->pivot->level ?? null,
                'is_custom' => $skill->is_custom,
            ];

            // Dynamically loop through 6 levels
            for ($i = 1; $i <= 6; $i++) {
                $descKey = "level_{$i}_description";
                $knowKey = "level_{$i}_knowledge";
                $abilKey = "level_{$i}_ability";
            
                $desc = $skill->$descKey;
            
                $rawKnow = str_replace(';', ',', $skill->$knowKey ?? '');
                $rawAbil = str_replace(';', ',', $skill->$abilKey ?? '');
            
                $know = array_filter(array_map('trim', explode(',', $rawKnow)));
                $abil = array_filter(array_map('trim', explode(',', $rawAbil)));
            
                if ($desc || !empty($know) || !empty($abil)) {
                    $formatted[$descKey] = $desc;
                    $formatted[$knowKey] = $know;
                    $formatted[$abilKey] = $abil;
                }
            }
            

            return $formatted;
}),



        

        // 'critical_functions' => $job->criticalFunctions->map(function ($cf) {
        //     return [
        //         'id' => $cf->id,
        //         'cwf_description' => $cf->description,
        //         'cwf_keys' => $cf->cwfKeys->map(fn($key) => [
        //             'id' => $key->id,
        //             'keytasks' => $key->name,
        //         ]),
        //     ];
        // }),

        'critical_functions' => $job->criticalFunctions->map(function ($cf) use ($job) {
            return [
                'job_id' => $job->id,
                'cwf_id' => $cf->id,
                'cwf_description' => $cf->description,
                'cwf_keys' => [
                    'keytasks' => $cf->cwfKeys->pluck('name')->toArray(),
                    'cwf_id' => $cf->id,
                ],
            ];
        }),
    ];
}

    
}
