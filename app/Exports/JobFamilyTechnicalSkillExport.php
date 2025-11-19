<?php

namespace App\Exports;

use App\Models\BusinessUnit;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class JobFamilyTechnicalSkillExport implements WithMultipleSheets
{
    protected $businessUnits;
    protected $allData;

    public function __construct()
    {
        $this->loadAllDataInOneQuery();
    }

    private function loadAllDataInOneQuery()
    {
        // Cache the entire export for 60 seconds
        $cacheKey = 'tech_skill_export_' . auth()->id() . '_' . date('Y-m-d-H-i');
        
        $this->allData = Cache::remember($cacheKey, 60, function () {
            // Use Query Builder - much safer and handles escaping
            $results = DB::table('jobs')
                ->select(
                    'jobs.id as job_id',
                    'jobs.level',
                    'jobs.status',
                    'jobs.business_unit_id',
                    'business_units.name as business_unit_name',
                    'divisions.head_of_division',
                    'departments.name as department_name',
                    'job_profiles.name as job_profile_name',
                    'master_technical_skills.id as skill_id',
                    'master_technical_skills.name as skill_name',
                    'master_technical_skills.level_1_description',
                    'master_technical_skills.level_2_description',
                    'master_technical_skills.level_3_description',
                    'master_technical_skills.level_4_description',
                    'master_technical_skills.level_5_description',
                    'master_technical_skills.level_6_description',
                    'sectors.name as sector_name',
                    'technical_skill_categories.title as category_title',
                    'job_technical_skills.level as skill_level'
                )
                ->join('business_units', 'jobs.business_unit_id', '=', 'business_units.id')
                ->leftJoin('divisions', 'jobs.division_id', '=', 'divisions.id')
                ->leftJoin('departments', 'jobs.department_id', '=', 'departments.id')
                ->leftJoin('job_profiles', 'jobs.job_profile_id', '=', 'job_profiles.id')
                ->leftJoin('job_technical_skills', 'jobs.id', '=', 'job_technical_skills.job_id')
                ->leftJoin('master_technical_skills', 'job_technical_skills.master_technical_skill_id', '=', 'master_technical_skills.id')
                ->leftJoin('sectors', 'master_technical_skills.sector_id', '=', 'sectors.id')
                ->leftJoin('technical_skill_categories', 'master_technical_skills.category_id', '=', 'technical_skill_categories.id')
                ->orderBy('jobs.business_unit_id')
                ->orderBy('departments.name')
                ->orderBy('jobs.level')
                ->get();

            // Group the results by business unit
            $grouped = $this->groupResultsByBusinessUnit($results);
            
            return $grouped;
        });
        
        $this->businessUnits = collect(array_keys($this->allData));
    }

    private function groupResultsByBusinessUnit($results)
    {
        $grouped = [];
        
        foreach ($results as $row) {
            $buId = $row->business_unit_id;
            
            // Initialize business unit if not exists
            if (!isset($grouped[$buId])) {
                $grouped[$buId] = [
                    'id' => $buId,
                    'name' => $row->business_unit_name,
                    'jobs' => [],
                    'skills' => []
                ];
            }
            
            // Add job if not exists
            if (!isset($grouped[$buId]['jobs'][$row->job_id])) {
                $grouped[$buId]['jobs'][$row->job_id] = (object)[
                    'id' => $row->job_id,
                    'level' => $row->level,
                    'status' => $row->status,
                    'head_of_division' => $row->head_of_division,
                    'department_name' => $row->department_name,
                    'job_profile_name' => $row->job_profile_name,
                    'skills' => []
                ];
            }
            
            // Add skill to job if exists
            if ($row->skill_id) {
                $grouped[$buId]['jobs'][$row->job_id]->skills[$row->skill_id] = (object)[
                    'level' => $row->skill_level,
                    'master_technical_skill_id' => $row->skill_id
                ];
                
                // Track unique skills for this BU
                if (!isset($grouped[$buId]['skills'][$row->skill_id])) {
                    $grouped[$buId]['skills'][$row->skill_id] = (object)[
                        'id' => $row->skill_id,
                        'name' => $row->skill_name,
                        'sector_name' => $row->sector_name,
                        'category_title' => $row->category_title,
                        'level_1_description' => $row->level_1_description,
                        'level_2_description' => $row->level_2_description,
                        'level_3_description' => $row->level_3_description,
                        'level_4_description' => $row->level_4_description,
                        'level_5_description' => $row->level_5_description,
                        'level_6_description' => $row->level_6_description,
                    ];
                }
            }
        }
        
        return $grouped;
    }

    public function sheets(): array
    {
        $sheets = [];
        
        foreach ($this->allData as $buId => $data) {
            $sheets[] = new JobFamilyGroupTechnicSkillSheet(
                (object)['id' => $data['id'], 'name' => $data['name']],
                collect($data['skills'])->values(),
                collect($data['jobs'])->values()
            );
        }

        return $sheets;
    }
}