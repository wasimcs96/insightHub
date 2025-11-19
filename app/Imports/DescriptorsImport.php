<?php

namespace App\Imports;

use App\Models\MasterDescriptor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Exception;

class DescriptorsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Clean and normalize
        $row = array_map(function ($value) {
            return is_string($value) ? trim($value) : $value;
        }, $row);
    
        $row['user_type'] = strtolower($row['user_type'] ?? '');
        $row['assessment_type'] = strtolower($row['assessment_type'] ?? '');
        $row['result_type'] = strtolower($row['result_type'] ?? '');
    
        $slug = Str::slug($row['name'] ?? '');
        $firstLetter = Str::upper(Str::substr($row['name'] ?? '', 0, 1));
        $code = $firstLetter;
    
        return MasterDescriptor::updateOrCreate(
            [
                'slug' => $slug,
                'user_score_level' => $row['user_score_level'],
                'user_type' => $row['user_type'],
                'assessment_type' => $row['assessment_type'],
                'result_type' => $row['result_type'],
            ],
            [
                'name' => $row['name'],
                'slug' => $slug,
                'code' => $code,
                'user_score_level' => $row['user_score_level'],
                'user_type' => $row['user_type'],
                'assessment_type' => $row['assessment_type'],
                'result_type' => $row['result_type'],
                'job_requirement_level' => $row['job_requirement_level'],
                'population_score_level' => $row['population_score_level'],
                'job_requirement_level_description' => $row['job_requirement_level_description'],
                'population_score_level_description' => $row['population_score_level_description'],
                'user_score_level_description' => $row['user_score_level_description'],
                'analysis' => $row['analysis'],
                'analysis_population' => $row['analysis_population'],
            ]
        );
    }
    

}
