<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;

class TechnicalSkillsImport implements ToCollection, WithHeadingRow
{
    private $sheetIndex;
    private $rowCount = 0;

    public function __construct($sheetIndex)
    {
        $this->sheetIndex = $sheetIndex;
    }

    public function model(array $row)
    {
        $this->rowCount++;
        
        // Your logic to handle each row
    }

    public function getRowCount()
    {
        return $this->rowCount;
    }

    public function collection(Collection $rows)
    {
        $data = [];

        foreach ($rows as $row) {
            $sectorName = $row['sector'];
            $criticalFunctionName = $row['tsc_ccs_category'];
            // $code = $row['tsc_ccs_code'] ;
            $name = $row['tsc_ccs_title']; // Assuming the name is in the second column
            $description = $row['tsc_ccs_description']; // Assuming the description is in the third column
            $level = $row['proficiency_level'];
            $type = $row['knowledge_ability_classification'];
            $typeDescription = $row['knowledge_ability_items'];
            $proficiencyDescription = $row['proficiency_description'];

            // Create a unique key based on the sector, critical function, and title to group data
            $key = "{$sectorName}_{$criticalFunctionName}_{$name}";

            if (!isset($data[$key])) {
                $data[$key] = [
                    'sector_name' => $sectorName,
                    'critical_function_name' => $criticalFunctionName,
                    // 'code' => $code,
                    'name' => $name,
                    'description' => $description,
                    'levels' => [
                        1 => ['knowledge' => [], 'abilities' => [], 'description' => '', 'proficiency_description' => []],
                        2 => ['knowledge' => [], 'abilities' => [], 'description' => '', 'proficiency_description' => []],
                        3 => ['knowledge' => [], 'abilities' => [], 'description' => '', 'proficiency_description' => []],
                        4 => ['knowledge' => [], 'abilities' => [], 'description' => '', 'proficiency_description' => []],
                        5 => ['knowledge' => [], 'abilities' => [], 'description' => '', 'proficiency_description' => []],
                        6 => ['knowledge' => [], 'abilities' => [], 'description' => '', 'proficiency_description' => []],
                    ],
                ];
            }

            if ($type == 'knowledge') {
                $data[$key]['levels'][$level]['knowledge'][] = $typeDescription;
            } elseif ($type == 'ability') {
                $data[$key]['levels'][$level]['abilities'][] = $typeDescription;
            }

            // Assuming description is the same for all entries at this level
            $data[$key]['levels'][$level]['proficiency_description'][] = $proficiencyDescription;
        }

        foreach ($data as $key => $item) {
            $insertData = [
                'sector_name' => $item['sector_name'],
                'critical_function_name' => $item['critical_function_name'],
                // 'code' => $item['code'],
                'name' => $item['name'],
                'description' => $item['description'],
                'level_1_description' => implode('; ', $item['levels'][1]['proficiency_description']),
                'level_2_description' => implode('; ', $item['levels'][2]['proficiency_description']),
                'level_3_description' => implode('; ', $item['levels'][3]['proficiency_description']),
                'level_4_description' => implode('; ', $item['levels'][4]['proficiency_description']),
                'level_5_description' => implode('; ', $item['levels'][5]['proficiency_description']),
                'level_6_description' => implode('; ', $item['levels'][6]['proficiency_description']),
                'level_1_knowledge' => implode('; ', $item['levels'][1]['knowledge']),
                'level_2_knowledge' => implode('; ', $item['levels'][2]['knowledge']),
                'level_3_knowledge' => implode('; ', $item['levels'][3]['knowledge']),
                'level_4_knowledge' => implode('; ', $item['levels'][4]['knowledge']),
                'level_5_knowledge' => implode('; ', $item['levels'][5]['knowledge']),
                'level_6_knowledge' => implode('; ', $item['levels'][6]['knowledge']),
                'level_1_abilities' => implode('; ', $item['levels'][1]['abilities']),
                'level_2_abilities' => implode('; ', $item['levels'][2]['abilities']),
                'level_3_abilities' => implode('; ', $item['levels'][3]['abilities']),
                'level_4_abilities' => implode('; ', $item['levels'][4]['abilities']),
                'level_5_abilities' => implode('; ', $item['levels'][5]['abilities']),
                'level_6_abilities' => implode('; ', $item['levels'][6]['abilities']),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert data into the database
            DB::table('technical_skills_new')->insert($insertData);
        }
    }

    public function sheets(): array
    {
        return [
            $this->sheetIndex => $this,
        ];
    }
}
