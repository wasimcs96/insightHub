<?php

namespace App\Jobs;

use App\Models\{
    BusinessUnit, Division, Department, Job, User, MasterCountry, MasterCity, JobHeadCount
};
use App\Services\Job\JdJobService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Str;
use App\Helpers\HelperFunctions;

class OrganizationStructureBulkImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $rows;
    protected JdJobService $jdJobService;

    public function __construct(array $rows, JdJobService $jdJobService)
    {
        $this->rows = $rows;
        $this->jdJobService = $jdJobService;
    }

    public function handle(): void
    {
        $companyId = 3;
        \Log::info("Started");
        // Preload and index business entities
        $existingBusinessUnits = BusinessUnit::where('company_id', $companyId)->get()->keyBy(fn($item) => strtolower(trim($item->name)));
        $existingDivisions = Division::where('company_id', $companyId)->get()->groupBy(fn($item) => $item->business_unit_id . '|' . strtolower(trim($item->head_of_division)));
        $existingDepartments = Department::where('company_id', $companyId)->get()->groupBy(fn($item) => $item->division_id . '|' . strtolower(trim($item->head_of_department))); 
        $existingJobs = Job::where('saved_job',1)->get()->keyBy('position_code');

        // Preload country & city maps
        $countries = MasterCountry::get()->keyBy(fn($item) => strtolower(trim($item->name)));
        // $cities = MasterCity::get()->groupBy('country_id')->map->keyBy(fn($item) => strtolower(trim($item->name)));

        // Optional: to collect queued emails after import
        $queuedEmails = []; 
        $rows = $this->rows;

        foreach ($rows as $row) {
            \Log::info("For: {$row['email']}");
            // 1. BUSINESS UNIT
            $businessUnitName = trim($row['business_unit']);
            $buKey = strtolower($businessUnitName);
            $businessUnit = $existingBusinessUnits[$buKey] ?? BusinessUnit::create([
                'name' => $businessUnitName,
                'company_id' => $companyId,
                'status' => 1,
            ]);
            $existingBusinessUnits[$buKey] = $businessUnit;

            // 2. DIVISION
            $divisionName = trim($row['companydivision']);
            $divKey = $businessUnit->id . '|' . strtolower($divisionName);
            $division = $existingDivisions[$divKey][0] ?? Division::create([
                'business_unit_id' => $businessUnit->id,
                'head_of_division' => $divisionName,
                'company_id' => $companyId,
            ]);
            $existingDivisions[$divKey] = collect([$division]);

            // 3. DEPARTMENT
            $departmentName = trim($row['department']);
            $deptKey = $division->id . '|' . strtolower($departmentName);
            $department = $existingDepartments[$deptKey][0] ?? Department::create([
                'division_id' => $division->id,
                'head_of_department' => $departmentName,
                'name' => $departmentName,
                'status' => 1,
                'company_id' => $companyId,
            ]);
            $existingDepartments[$deptKey] = collect([$department]);

            // 4. JOB
            $positionCode = $row['job_position_id'];
            $isTop = strtolower(trim($row['top_position_yesno'])) === 'yes' ? 1 : 0;
            $job = $existingJobs[$positionCode] ?? null;

            if (!$job) {
                $job = $this->createJob(
                    $businessUnit->name,
                    $division->head_of_division,
                    $department->name,
                    $row['job_position_name'],
                    $row['job_description'],
                    $row['management_level'],
                    $businessUnit->id,
                    $division->id,
                    $department->id,
                    $row['total_headcount'],
                    $positionCode,
                    $isTop,
                    $row
                );
                if ($job) {
                    $existingJobs[$positionCode] = $job;
                } else {
                    // Optional: log job creation failure
                    continue;
                }
            }

            // 5. COUNTRY & CITY
            $countryName = strtolower(trim($row['nationality']));
            $cityName = strtolower(trim($row['city']));
            $countryId = MasterCountry::whereRaw('LOWER(TRIM(name)) = ?', [strtolower(trim($row['nationality']))])->first()->id ?? 0;
            $cityId = $this->getCityId($countryId, $row['city']) ?? '';


            // 6. CREATE USER
            $user = $this->createUser(
                $row, $countryId, $cityId,
                $division->id, $department->id,
                $job->id, $job->title
            );

            // 7. ORG CHART ASSIGNMENT
            $this->assignPositionInOrgChart(
                $row, $user->id, $user->name,
                $job->id, $department->id,
                $row['total_headcount']
            );
        }
        $this->createVacantJobHeadCount();
        $this->migrateVacancyData();
        \Log::info("Done");

        // Send Email
        $to = 'sufiyan@cxsanalytics.com';
        $templateType = 'send_employees_email'; 
        $data = [
            'Employee Email' => $to ?? '',
            'Employee Password' => "Done" ?? '',
            'Employee Name' => "Done" ?? '',
            'job_title' => "Done",
            'company_name' => "Done" ?? ''
        ];

        HelperFunctions::sendEmail($to, $templateType, $data);
    }

    private function createJob($businessUnit, $divisionName, $departmentName, $jobPosition, $jobDescription, $managementLevel, $businessUnitId, $divisionId, $departmentId, $headCounts, $positionCode, $isTop, $row)
    {
        set_time_limit(0);

        $apiResponse = $this->getJdFromAI($businessUnit, $divisionName, $departmentName, $jobPosition, $jobDescription);
       
        if ($apiResponse) {
            $formData = $this->processAiResponse($apiResponse[0], $divisionName, $departmentName, $jobPosition, $jobDescription, $managementLevel, $businessUnitId, $divisionId, $departmentId, $headCounts, $row);
            $formData['position_code'] = $positionCode;
            $formData['is_top'] = $isTop; 
            $formData['job_profile_description'] = $jobDescription;
            return $this->jdJobService->createJobForOrgChart($formData);
        }

        return null;
    }

    private function getJdFromAI($businessUnit, $divisionName, $departmentName, $jobPosition, $jobDescription)
    {
        $url = env('AI_API_BASE_URL') . '/api/v1/jd-generator/search';

        $response = Http::withHeaders(['Accept' => 'application/json',  'x-api-token' => 'fea63371019d768206ee6e96a4ca88fb68cf0074ca0382943e21e562d67c0979'])->post($url, [
            'localized_job_role_name' => implode(',', [$jobPosition, $departmentName, $divisionName]),
            'sector' => '',
            'short_description' => $jobDescription,
        ]);

        if ($response->failed()) return null;

        $apiData = $response->json();
        return !empty($apiData['job_roles']) ? [$apiData['job_roles'][0]] : null;
    }

    private function processAiResponse($aiResponse, $divisionName, $departmentName, $jobPosition, $jobDescription, $managementLevel, $businessUnitId, $divisionId, $departmentId, $headCounts, $row)
    {
        $levelMap = [
            'Senior Management' => 13,
            'Management' => 12,
            'Individual Contributor' => 11,
            'Non-Executive' => 10,
        ];
        $jobLevel = $levelMap[$managementLevel] ?? 0;

        return [
            '_token' => csrf_token(),
            'jd_from' => 5,
            'riasec' => $aiResponse['top3riasec'],
            'title' => $aiResponse['title'],
            'level' => $row['job_level'],
            'description' => $aiResponse['description'],
            'functions' => $aiResponse['critical_functions'],
            'technicalSkills' => $aiResponse['technical_skills'],
            'genericSkills' => $aiResponse['soft_skills'],
            'job_profile_name' => $jobPosition,
            'sector_name' => $aiResponse['sector_name'],
            'sub_sector_name' => $aiResponse['sub_sector_name'],
            'job_profile' => $aiResponse['title'],
            'business_unit_id' => $businessUnitId,
            'division_id' => $divisionId,
            'job_familyId' => $departmentId,
            'level_job' => $row['job_level'],
            'status' => 2,
            'heads' => $headCounts,
            'headcounts' => $headCounts,
        ];
    }

    private function createUser($row, $countryId, $cityId, $divisionId, $departmentId, $jobId, $jobName)
    {
        $fullName = $row['emp_full_name'];

        // Split the name by space
        $nameParts = explode(' ', trim($fullName));

        // Handle first and last name
        $firstName = $nameParts[0] ?? '';
        $lastName = isset($nameParts[1]) 
            ? implode(' ', array_slice($nameParts, 1))  // Join rest as last name
            : '';

        $randomPassword = Str::random(12);
        $row['email'] = strtolower($row['email']);
        $user = User::where('email', $row['email'])->first();
        
        if ($user) { 
            $user->update(
                [
                'name' => $row['emp_full_name'],
                'first_name' => $firstName,
                'last_name' => $lastName,
                'employee_code' => $row['employee_id'],
                'email' => $row['email'],
                'birth_date' => $this->excelSerialToDate($row['date_of_birth']),
                'gender' => strtolower($row['gender']) === 'female' ? 1 : (strtolower($row['gender']) === 'male' ? 0 : 2),
                'country_id' => $countryId,
                'city_id' => $cityId,
                'mailing_city_id' => $cityId,
                'ec_city_id' => $cityId,
                'city' => $row['city'],
                'date_of_hire' => $this->excelSerialToDate($row['date_hire']),
                'tin_number' => $row['taxidentificationnumbertin'],
                'sss_number' => $row['social_security_system_sss_number'],
                'hdmf_number' => $row['pag_ibg_fund_hdmf_number'],
                'phil_number' => $row['philhealth_number'],
                'division_id' => $divisionId,
                'department_id' => $departmentId,
                'position_id' => $jobId,
                'company_id' => 3,
                'role_id' => 1,
                'role_name' => 'employee'
            ]);
           
        } else {
            $user = User::updateOrCreate(
                [ 'email' => $row['email']],
                [
                'name' => $row['emp_full_name'],
                'first_name' => $firstName,
                'last_name' => $lastName,
                'employee_code' => $row['employee_id'],
                'email' => strtolower($row['email']),
                'birth_date' => $this->excelSerialToDate($row['date_of_birth']),
                'gender' => strtolower($row['gender']) === 'female' ? 1 : (strtolower($row['gender']) === 'male' ? 0 : 2),
                'country_id' => $countryId,
                'city_id' => $cityId,
                'mailing_city_id' => $cityId,
                'ec_city_id' => $cityId,
                'city' => $row['city'],
                'date_of_hire' => $this->excelSerialToDate($row['date_hire']),
                'tin_number' => $row['taxidentificationnumbertin'],
                'sss_number' => $row['social_security_system_sss_number'],
                'hdmf_number' => $row['pag_ibg_fund_hdmf_number'],
                'phil_number' => $row['philhealth_number'],
                'division_id' => $divisionId,
                'department_id' => $departmentId,
                'position_id' => $jobId,
                'company_id' => 3,
                'role_id' => 1,
                'role_name' => 'employee',
                'password' => Hash::make($randomPassword),
            ]);
    
            // Send Email
            // $to = $user->email;
            // $templateType = 'send_employees_email'; 
            // $data = [
            //     'Employee Email' => $to ?? '',
            //     'Employee Password' => $randomPassword ?? '',
            //     'Employee Name' => $firstName ?? '',
            //     'job_title' => $jobName,
            //     'company_name' => auth()->user()->name ?? ''
            // ];
    
            // HelperFunctions::sendEmail($to, $templateType, $data);
        }
        
        return $user;
    }

    private function assignPositionInOrgChart($row, $userId, $userName, $jobId, $departmentId, $headCounts)
    {
        $parentId = null;
        if (!empty($row['superior_emp_id']) && strtolower($row['superior_emp_id']) != 'null') {
            $superiorUserId = User::where('employee_code', $row['superior_emp_id'])->first()->id;

            $parentJhc= JobHeadCount::where('user_id', $superiorUserId)->first();
            $parentId = $parentJhc->id;

            $jobToUpdateSuperiorId = Job::find($jobId);
            $jobToUpdateSuperiorId->superior_id = $parentJhc->job_id;
            $jobToUpdateSuperiorId->save();
        }
    
        $existing = JobHeadCount::where('job_id', $jobId)->count();
        $remaining = $headCounts - $existing;
    
        if ($remaining <= 0) {
            // Skip creation if no headcount left
            return null;
        }
    
        $number = str_pad($remaining, 2, '0', STR_PAD_LEFT);
        $headCountCode = "{$row['job_position_id']}-{$jobId}-{$number}";

        return JobHeadCount::updateOrCreate(
            [
                'job_id' => $jobId,
                'user_id' => $userId,
                'parent_id' => $parentId,
                'headcount_code' => $headCountCode,
            ],
            [
                'job_id' => $jobId,
                'user_id' => $userId,
                'parent_id' => $parentId,
                'department_id' => $departmentId,
                'headcount_number' => $number,
                'headcount_code' => $headCountCode,
                'orgMetadata' => [
                                    'action' => 'add_position_then_assign',
                                    'reason' => "",
                                    'node' => ['data'=>['code'=>$headCountCode, 'name' => $userName]],
                                    'source'=>"Bulk Import",
                        ]
            ]
        );
    }

    private function excelSerialToDate($serial)
    {
        // Check if the input is empty or non-numeric
        if (empty($serial)) {
            // Return default date if empty
            return '1900-01-01';  // Default Date in Y-m-d format
        }

        // If the serial is numeric (Excel serial number)
        if (is_numeric($serial)) {
            // Excel starts on 1900-01-01, which is day 1
            $unixTimestamp = ($serial - 25569) * 86400; // 25569 is the number of days between 1900-01-01 and 1970-01-01
            return date('Y-m-d', $unixTimestamp);
        }

        // If the serial is a date string (e.g., 18-Jan-94), try to parse it
        $date = DateTime::createFromFormat('d-M-y', $serial);

        if ($date === false) {
            // If the conversion fails, return the default date
            return '1900-01-01'; // Default Date if invalid format
        }
       
        // Return the date in the required Y-m-d format
        return $date->format('Y-m-d');
    }

    private function getCityId($countryId, $cityName)
    {
        return MasterCity::where('country_id', $countryId)
            ->whereRaw('LOWER(TRIM(name)) = ?', [strtolower(trim($cityName))])
            ->value('id');
    }

    private function createVacantJobHeadCount()
    {
        $jobs = Job::where('saved_job', 1)->where('job_type', 'ai_gen')->get();
       
        foreach ($jobs as $job) {
            $existingHeadCounts = JobHeadCount::where('job_id', $job->id)->get();
            $existingCodes = $existingHeadCounts->pluck('headcount_code')->all();
            $existingCount = count($existingHeadCounts);
            $remaining = $job->heads - $existingCount;
            if ($remaining <= 0) {
                continue;
            }

            $parentId = optional($existingHeadCounts->first())->parent_id;

            for ($i = $remaining; $i > 0; $i--) {
                $number = str_pad($i, 2, '0', STR_PAD_LEFT);
                $headCountCode = "{$job->position_code}-{$job->id}-{$number}";
                JobHeadCount::updateOrCreate(
                    ['headcount_code' => $headCountCode],
                    [
                        'job_id' => $job->id,
                        'parent_id' => $parentId,
                        'department_id' => $job->department_id,
                        'headcount_number' => $number,
                        'headcount_code' => $headCountCode,
                        'orgMetadata' => [
                            'action' => 'add_position',
                            'reason' => '',
                            'node' => ['data' => ['code' => $headCountCode]],
                            'source' => 'After Bulk Import',
                        ],
                    ]
                );
            }
        }
    }

    private function migrateVacancyData() {
        $savedJobs = Job::where('saved_job', 1)->get();
 
        foreach ($savedJobs as $job) {
            $totalEmployees = User::where('position_id', $job->id)->count();
            $totalVacancies = $job->heads - $totalEmployees;
 
            if ($totalVacancies < 0) {
              $totalVacancies = 0;
            }
           
            $job->vacancy = $totalVacancies;
            $job->save();
        }
    }

}
