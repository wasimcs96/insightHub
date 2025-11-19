<?php

namespace App\Imports;

use App\Models\MasterTechnicalSkillCognitiveDomain;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class TechnicalSkillCognitiveDomainImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation, ShouldQueue
{
    private $debugLogged = false;

    private function calculateLevel($percentage) 
    {
        if ($percentage >= 75) {
            return 3;
        } elseif ($percentage < 25) {
            return 1;
        } else {
            return 2;
        }
    }

    public function model(array $row)
    {
        // Debug: Log the row keys only once
        if (!$this->debugLogged) {
            Log::info('Excel row keys: ' . implode(', ', array_keys($row)));
            $this->debugLogged = true;
        }

        // Get percentage values
        $qkPercentage = $this->extractPercentage($this->getPercentageValue($row, 'qk'));
        $ckPercentage = $this->extractPercentage($this->getPercentageValue($row, 'ck'));
        $vrPercentage = $this->extractPercentage($this->getPercentageValue($row, 'vr'));
        $frPercentage = $this->extractPercentage($this->getPercentageValue($row, 'fr'));

        return new MasterTechnicalSkillCognitiveDomain([
            'master_technical_skill_id' => $row['master_technical_skills_id'],
            'name' => $row['technical_skill_name'],
            'level' => $row['level'],
            'qk_ka_count' => $row['quantitative_knowledge'],
            'ck_ka_count' => $row['comprehension_knowledge'],
            'vr_ka_count' => $row['visual_reasoning'],
            'fr_ka_count' => $row['fluid_reasoning'],
            'ka_total_count' => $row['kna_total'],
            'qk_ka_percentage' => $qkPercentage,
            'ck_ka_percentage' => $ckPercentage,
            'vr_ka_percentage' => $vrPercentage,
            'fr_ka_percentage' => $frPercentage,
            'qk_ka_level' => $this->calculateLevel($qkPercentage),
            'ck_ka_level' => $this->calculateLevel($ckPercentage),
            'vr_ka_level' => $this->calculateLevel($vrPercentage),
            'fr_ka_level' => $this->calculateLevel($frPercentage),
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function rules(): array
    {
        return [
            'master_technical_skills_id' => 'required|exists:master_technical_skills,id',
            'technical_skill_name' => 'required|string',
            'level' => 'required|integer|min:0',
            'comprehension_knowledge' => 'required|numeric|min:0',
            'fluid_reasoning' => 'required|numeric|min:0',
            'quantitative_knowledge' => 'required|numeric|min:0',
            'visual_reasoning' => 'required|numeric|min:0',
            'kna_total' => 'required|numeric|min:0',
            // Remove percentage validation for now since we're not sure of the exact column names
        ];
    }

    private function getPercentageValue($row, $type)
    {
        // Try different possible column name variations
        $possibleKeys = [
            $type . '_',           // ck_, fr_, etc.
            $type . '_percent',    // ck_percent, fr_percent, etc.
            $type . '_percentage', // ck_percentage, fr_percentage, etc.
            $type,                 // ck, fr, etc.
        ];

        foreach ($possibleKeys as $key) {
            if (isset($row[$key])) {
                return $row[$key];
            }
        }

        // If none found, log available keys and return 0
        Log::warning("Percentage column not found for type: $type. Available keys: " . implode(', ', array_keys($row)));
        return 0;
    }

    private function extractPercentage($value)
    {
        // Handle null/empty values
        if (is_null($value) || $value === '') {
            return 0.00;
        }
        
        // Remove any % sign and convert to float
        $cleanValue = str_replace(['%', ' '], '', $value);
        return (float) $cleanValue;
    }
}