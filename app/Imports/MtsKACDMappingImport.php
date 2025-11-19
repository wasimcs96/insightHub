<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\DefaultValueBinder;

class MtsKACDMappingImport extends DefaultValueBinder implements ToCollection, WithChunkReading, WithHeadingRow, WithCustomValueBinder
{
    private $rowsProcessed = 0;

    public function collection(Collection $rows)
    {
        $cognitiveDomainShortNames = [
            'COMPREHENSION_KNOWLEDGE' => 'ck',
            'FLUID_REASONING' => 'fr',
            'QUANTITATIVE_KNOWLEDGE' => 'qk',
            'VISUAL_REASONING' => 'vr',
        ];

        $data = [];

        foreach ($rows as $row) {
            $cognitiveDomainName = $row['cognitive_domain_name'];
            $shortName = $cognitiveDomainShortNames[$cognitiveDomainName] ?? '';

            if ($row['tsc_ccs_type'] == 'ccs') {
                continue; // Skip invalid/header rows as per your logic
            }
            
            $data[] = [
                'master_technical_skill_id' => $row['master_technical_skill_id'],
                'name' => $row['tsc_ccs_title'],
                'level' => $row['proficiency_level'],
                'level_description' => $row['proficiency_description'] ?? null,
                'type' => $row['knowledge_ability_classification'],
                'description' => $row['knowledge_ability_items'] ?? null,
                'cognitive_domain_name' => $cognitiveDomainName,
                'cognitive_domain_short_name' => $shortName,
                'cognitive_domain_id' => $row['cognitive_domain_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $this->rowsProcessed++;
            if ($this->rowsProcessed % 5000 === 0) {
                echo "Processed {$this->rowsProcessed} records so far...\n";
            }
        }

        if (!empty($data)) {
            DB::table('master_technical_skills_cognitive_domain_kas')->insert($data);
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
