<?php

namespace App\Imports;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Exception;
use App\Services\Job\JdJobService;
use App\Models\{BusinessUnit, Division, Department, Job, User, MasterCountry, MasterCity, JobHeadCount};
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class OrganizationChartImport implements ToModel, WithHeadingRow
{

    protected $jdJobService;

    public function __construct(JdJobService $jdJobService)
    {
        $this->jdJobService = $jdJobService;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    { 
      
        $bU = $row['business_unit'];
        $businessUnit = BusinessUnit::updateOrCreate(
            [ // search condition
                'name' => $bU,
                'company_id' => 3,
            ],
            [ // values to update or insert
                'name' => $bU,
                'company_id' => 3,
                'status' => 1
            ]
        );
        DB::commit();

        $div = $row['companydivision'];
        $division = Division::updateOrCreate(
            [ 
                'business_unit_id' => $businessUnit->id,
                'head_of_division' => $div,
                'company_id' => 3,
            ],
            [ 
               'business_unit_id' => $businessUnit->id,
                'head_of_division' => $div,
                'company_id' => 3,
            ]
        );
        DB::commit();

        $dept = $row['department'];
        $department = Department::updateOrCreate(
            [ 
                'division_id' => $division->id,
                'head_of_department' => $dept,
                'company_id' => 3,
            ],
            [ 
               'division_id' => $division->id,
               'name' => $dept,
               'head_of_division' => $dept,
               'company_id' => 3,
               'status' => 1
            ]
        );
        DB::commit();

        if ($row['top_position_yesno'] == 'Yes') {
            $isTop = 1;
        } else {
            $isTop = 0;
        }
        $job = Job::where('business_unit_id', $businessUnit->id)->where('division_id', $division->id)->where('department_id', $department->id)->where('name', $row['job_position_name'])->first();
        if (!$job) {
            $job = $this->createJob($businessUnit->name, $division->name, $department->name, $row['job_position_name'], $row['job_description'], $row['management_level'], $businessUnit->id, $division->id, $department->id, $row['total_headcount'], $row['job_position_id'], $isTop);
        }

        $countryId = MasterCountry::where('name', $row['nationality'])->first()->id ?? 135;
        $cityId = MasterCity::where('country_id', $countryId)->where('name', $row['city'])->first()->id ?? '';

        $user = $this->createUser($row, $countryId, $cityId, $division->id, $department->id, $job->id);
        $assignedPosition = $this->assignPositionInOrgChart($row, $user->id, $job->id, $department->id, $row['total_headcount']);

        return 1;
    }

    private function createJob($businessUnit, $divisionName, $departmentName, $jobPosition, $jobDescription, $managementLevel, $businessUnitId, $divisionId, $departmentId, $headCounts, $positionCode, $isTop)
    {

       
            set_time_limit(0);
        
            $job = [];
            // Call the AI API to get job details
            $apiResponse = $this->getJdFromAI($businessUnit, $divisionName, $departmentName, $jobPosition, $jobDescription);
       
            if ($apiResponse) {
                // Use the first job from the AI API response
                $apiJob = $apiResponse[0]; // First job from the response
                // dd($apiJob);
                $formData = $this->processAiResponse($apiResponse[0],$divisionName, $departmentName, $jobPosition, $jobDescription, $managementLevel, $businessUnitId, $divisionId, $departmentId, $headCounts);  // Pass the first job from the AI response
                $formData['position_code'] = $positionCode;
                $formData['is_top'] = $isTop;
                // Create the job using the JdJobService
                $job = $this->jdJobService->createJobForOrgChart($formData);
            }

            return $job;
        
    }

    private function getJdFromAI($businessUnit, $divisionName, $departmentName, $jobPosition, $jobDescription)
    {
        // Make a request to the AI API to get job data
        $url = env('AI_API_BASE_URL') . '/api/v1/jd-generator/search';

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'x-api-token' => 'fea63371019d768206ee6e96a4ca88fb68cf0074ca0382943e21e562d67c0979',
        ])->post($url, [
            'localized_job_role_name' => implode(',', [
                $jobPosition, 
                $departmentName, 
                $divisionName, 
            ]),
            'sector' => '',
            'short_description' => $jobDescription,
        ]);

        if ($response->failed()) {
            return null;
        }

        $apiData = $response->json();
        $jobs = $apiData['job_roles'] ?? [];

        // Return only the first job if there are any
        return !empty($jobs) ? [$jobs[0]] : null;
    }


    public function processAiResponse($aiResponse ,$divisionName, $departmentName, $jobPosition, $jobDescription, $managementLevel, $businessUnitId, $divisionId, $departmentId, $headCounts)
    {
        // Initialize the data array for the form submission
        // dd($aiResponse);
        $formData = [
            '_token' => csrf_token(),  // Include CSRF token
            'jd_from' => 5,  // Assuming this value is static
            'riasec' => $aiResponse['top3riasec'], // Map RIASEC values
            'title' => $aiResponse['title'],  // Job title
            'level' => $aiResponse['level'] ?? null,  // Level (if provided in AI response)
            'description' => $aiResponse['description'],  // Job description
            'functions' => $this->mapCriticalFunctions($aiResponse['critical_functions']), // Map critical functions
            'technicalSkills' => $this->mapTechnicalSkills($aiResponse['technical_skills']), // Map technical skills
            'genericSkills' => $this->mapSoftSkills($aiResponse['soft_skills']),
        ];

        if ($managementLevel == 'Senior Management') {
                $jobLevel = 13;
                
            } elseif ($managementLevel ==  'Individual Contributor') {
                $jobLevel = 11;
            } elseif ($managementLevel == 'Management') {
                $jobLevel = 12;
            } elseif ($managementLevel == 'Non-Executive') {
                $jobLevel = 10;
            }else{
                $jobLevel = 0;
            }
        // Map job profile, job family, and job family group from the AI response
        $formData['job_profile_name'] = $jobPosition ?? '';  // Assuming the job profile name is the same as the title
        $formData['sector_name'] = $aiResponse['sector_name'];  // Same assumption as above
        $formData['sub_sector_name'] = $aiResponse['sub_sector_name'];  // Same assumption as above
        $formData['job_profile'] = $aiResponse['title'];  // Same assumption as above
        $formData['business_unit_id'] = $businessUnitId ?? '';  // Map job family group
        $formData['division_id'] = $divisionId ?? '';  // Map job family group
        $formData['job_familyId'] = $departmentId ?? '';  // Map job family
        $formData['level_job'] =  $jobLevel;  // Level job if provided
        $formData['level'] =  $jobLevel;  // Level if provided
        $formData['status'] = 2;  // Assuming status is 2
        $formData['heads'] = $headCounts;  // Assuming a default value for heads
        $formData['headcounts'] = $headCounts;

        // Call the store service with the formatted form data
        return $formData;
    }

    private function mapCriticalFunctions($criticalFunctions)
    {
        // Map critical functions to the "functions" structure in the form
        $mappedFunctions = [];
        foreach ($criticalFunctions as $function) {
            $mappedFunctions[] = [
                'title' => $function['cwf_description'],
                'tasks' => $function['cwf_keys']['keytasks'] ?? [],
            ];
        }
        return $mappedFunctions;
    }

    private function mapTechnicalSkills($technicalSkills)
    {
        // Map technical skills to match the structure in the form
        $mappedSkills = [];
        foreach ($technicalSkills as $skill) {
            $mappedSkills[] = [
                'c_id' => $skill['c_id'] ?? '',
                "sector_id" => $skill['sector_id'] ?? '',
                'sector_name' => $skill['sector_name'] ?? '',
                "sub_sector_id" => $skill['sub_sector_id'] ?? '',
                'sub_sector_name' => $skill['sub_sector_name'] ?? '',
                'code' => $skill['code'] ?? '',
                'name' => $skill['name'] ?? '',
                'category_name' => $skill['category_name'] ?? '',

                'description' => $skill['description'] ?? '',
                'preferred_level' => $skill['preferred_level'] ?? '',
                'level_1_description' => $skill['level_1_description'] ?? '',
                'level_2_description' => $skill['level_2_description'] ?? '',
                'level_3_description' => $skill['level_3_description'] ?? '',
                'level_4_description' => $skill['level_4_description'] ?? '',
                'level_5_description' => $skill['level_5_description'] ?? '',
                'level_6_description' => $skill['level_6_description'] ?? '',
                // Include knowledge and ability for each level
                'level_1_knowledge' => $skill['level_1_knowledge'] ?? '',
                'level_1_ability' => $skill['level_1_ability'] ?? '',
                'level_2_knowledge' => $skill['level_2_knowledge'] ?? '',
                'level_2_ability' => $skill['level_2_ability'] ?? '',
                'level_3_knowledge' => $skill['level_3_knowledge'] ?? '',
                'level_3_ability' => $skill['level_3_ability'] ?? '',
                'level_4_knowledge' => $skill['level_4_knowledge'] ?? '',
                'level_4_ability' => $skill['level_4_ability'] ?? '',
                'level_5_knowledge' => $skill['level_5_knowledge'] ?? '',
                'level_5_ability' => $skill['level_5_ability'] ?? '',
                'level_6_knowledge' => $skill['level_6_knowledge'] ?? '',
                'level_6_ability' => $skill['level_6_ability'] ?? '',
            ];
        }
        return $mappedSkills;
    }


    private function mapSoftSkills($softSkills)
    {
        // Map soft skills to match the structure in the form
        $mappedSoftSkills = [];
        foreach ($softSkills as $skill) {
            // Map preferred_level to 1, 2, 3 based on its value
            if ($skill['preferred_level'] == 'Basic') {
                $skill['preferred_level'] = '1';
            } elseif ($skill['preferred_level'] == 'Intermediate') {
                $skill['preferred_level'] = '2';
            } elseif ($skill['preferred_level'] == 'Advanced') {
                $skill['preferred_level'] = '3';
            }

            // Add the skill to the mapped array
            $mappedSoftSkills[] = [
                'competency' => $skill['competency'] ?? '',
                'description' => $skill['description'] ?? '',
                'category_name' => $skill['category_name'] ?? null,
                'preferred_level' => $skill['preferred_level'] ?? null,
                'level_1' => $skill['level_1'] ?? null,
                'level_2' => $skill['level_2'] ?? null,
                'level_3' => $skill['level_3'] ?? null,
                'level_1_knowledge' => $skill['level_1_knowledge'] ?? '',  // Assuming knowledge for soft skills
                'level_1_ability' => $skill['level_1_ability'] ?? '',     // Assuming ability for soft skills
                'level_2_knowledge' => $skill['level_2_knowledge'] ?? '',
                'level_2_ability' => $skill['level_2_ability'] ?? '',
                'level_3_knowledge' => $skill['level_3_knowledge'] ?? '',
                'level_3_ability' => $skill['level_3_ability'] ?? '',
            ];
        }
        return $mappedSoftSkills;
    }

    private function createUser($row, $countryId, $cityId, $divisionId, $departmentId, $jobId) 
    {
        if ($row['gender'] == 'Female') {
            $gender = 1;
        } else {
            $gender = 0;
        }

        if ($row['employment_status'] == 'Full-Time') {
            $employmentStatus = 1;
        } elseif ($row['employment_status'] == 'Part-Time') {
            $employmentStatus = 2;
        } else {
            $employmentStatus = 0;
        }
        return User::create([
            'name' => $row['emp_full_name'],
            'employee_id' => $row['employee_id'],
            'email' => $row['email'],
            'birth_date' => $row['date_of_birth'],
            'gender' => $gender,
            'country_id' => $countryId,
            'city_id' => $cityId,
            'mailing_city_id' => $cityId,
            'ec_city_id' => $cityId,
            'city' => $row['city'],
            'date_of_hire' => $row['date_hire'],
            'tin_number' => $row['taxidentificationnumbertin'],
            'sss_number' => $row['social_security_system_sss_number'],
            'hdmf_number' => $row['pag_ibg_fund_hdmf_number'],
            'phil_number' => $row['philhealth_number'],
            'division_id' => $divisionId,
            'department_id' => $departmentId,
            'position_id' => $jobId

        ]); 
    }

    private function assignPositionInOrgChart($row, $userId, $jobId, $departmentId, $headCounts) {
        if (($row['superior_emp_id']) && ($row['superior_emp_id'] != 'NULL')) {
            $user = User::where('employee_id', $row['superior_emp_id'])->first()->id;
            $parent_id = JobHeadCount::where('user_id', $userId)->first()->id;
        } else {
            $parent_id = NULL;
        }
        $totalExistingHeadCounts = JobHeadCount::where('job_id', $jobId)->count() ?? 0;
        $headCountNumber = $headCounts - $totalExistingHeadCounts;
        $formattedHeadCountNumber = str_pad($headCountNumber, 2, '0', STR_PAD_LEFT);
        return JobHeadcount::create([
            'job_id' => $jobId,
            'user_id' => $userId,
            'parent_id' => $parent_id,
            'department_id' => $departmentId,
            'headcount_number' => $formattedHeadCountNumber,
            'headcount_code' => $row['job_position_id'] . '-' . $jobId . '-' . $formattedHeadCountNumber,
        ]);
    }

}
