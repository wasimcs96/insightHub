<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
use App\Models\JobTechnicalSkills;
use App\Models\Job;
use App\Models\TechnicalSkill;
use App\Models\MasterTechnicalSkill;
use App\Models\MasterSector;

class TechnicalSkillsForJobs implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows)
    {
        $sectors = [
            'Accountancy' => 1,
            'Aerospace' => 2,
            'Agrifood' => 3,
            'Air Transport' => 4,
            'BioPharmaceuticals Manufacturing' => 5,
            'Built Environment' => 6,
            'Design' => 7,
            'Early Childhood Care and Education' => 8,
            'Electronics' => 9,
            'Energy and Chemicals' => 10,
            'Energy and Power' => 11,
            'Engineering Services' => 12,
            'Environmental Services' => 13,
            'Financial Services' => 14,
            'Food Manufacturing' => 15,
            'Food Services' => 16,
            'Healthcare' => 17,
            'Hotel and Accommodation Services' => 18,
            'Human Resource' => 19,
            'Infocomm Technology' => 20,
            'Intellectual Property' => 21,
            'Landscape' => 22,
            'Logistics' => 23,
            'Marine and Offshore' => 24,
            'Media' => 25,
            'Precision Engineering' => 26,
            'Public Transport' => 27,
            'Retail' => 28,
            'Sea Transport' => 29,
            'Security' => 30,
            'Social Service' => 31,
            'Tourism' => 32,
            'Trade Associations and Chambers' => 33,
            'Training and Adult Education' => 34,
            'Wholesale Trade' => 35,
            'Workplace Safety and Health' => 36,
            'Water Management' => 37
        ];
        
        $sqlQuery = '';

        foreach ($rows as $row) {
           
            $jobName = $row['job_role'];
            $technicalSkillName = $row['ccs_tsc_title'];
            $proficiencyLevel = $row['proficiency_level'];
            $sectorName = $row['sector'];
            $subsectorName = $row['track'];

            $sector = MasterSector::where('name', $sectorName)->first();

            $job = Job::where('title', $jobName)->where('department_id', $sector->id)->where('sub_sector_name', $subsectorName)->first();
            $masterTechnicalSkill = MasterTechnicalSkill::where('name',$technicalSkillName)->where('sector_name', $sectorName)->first();
            //  DB::table('job_technical_skills')->insert([
            //     'job_id' => $job->id,
            //     'technical_Skill_id' => $masterTechnicalSkill->id,
            //     'level' => $proficiencyLevel
            //  ]);
            \Log::info("Master Technical Skill ". $technicalSkillName . " Job ". $jobName. $job->id);
            $sqlQuery .= "INSERT INTO job_technical_skills (job_id, technical_skill_id, level) VALUES (".$job->id.", ".$masterTechnicalSkill->id.", ".$proficiencyLevel.");";
           
            // $test = JobTechnicalSkills::create([
            //     'job_id' => $job->id,
            //     'technical_skill_id' => $masterTechnicalSkill->id,
            //     'level' => $proficiencyLevel
            //  ]);
            
             
             
        }
        dd($sqlQuery);
           

     }
     

    
}
