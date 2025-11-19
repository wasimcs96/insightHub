<?php

namespace App\Imports;

use Illuminate\Support\Facades\Hash;
use Str;
use App\Helpers\HelperFunctions;
use App\Models\{
    BusinessUnit, Division, Department, Job, User, MasterCountry, MasterCity, JobHeadCount
};
use App\Services\Job\JdJobService;
use App\Exports\ArrayExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\{
    ToArray,
    WithHeadingRow,
    WithCustomValueBinder
};
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use App\Jobs\OrganizationStructureBulkImport;

class OrganizationChartImport extends DefaultValueBinder implements
    ToArray,
    WithHeadingRow,
    WithCustomValueBinder
{
    protected $jdJobService;

    public function __construct(JdJobService $jdJobService)
    {
        $this->jdJobService = $jdJobService;
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function bindValue(Cell $cell, $value)
    {
        $cell->setValueExplicit((string) $value, DataType::TYPE_STRING);
        return true;
    }

    public function array(array $rows)
    {
        $allRows = [];
        $errorMap = [];
        $hasErrors = false;

        $columns = array_keys($rows[0] ?? []);

        foreach ($rows as $index => $row) {
            if (collect($row)->every(fn($v) => trim($v) === '')) {
                continue;
            }

            $errors = [];
            $isTopCheckDone = 0;
            foreach ($columns as $column) {
                if (($column === 'superior_emp_id') && ($row[$column] == '') && ($isTopCheckDone == 0)) {
                    $isTopCheckDone = 1;
                    continue;
                }

                $nonMandatoryColumns = ['error', 'management_level', 'job_description', 'date_of_birth', 'date_hire', 'taxidentificationnumbertin', 'social_security_system_sss_number', 'pag_ibg_fund_hdmf_number', 'philhealth_number', 'nationality', 'gender', 'city', 'employment_status', 'performance_rating_year1', 'performance_rating_year2', 'performance_rating_year3', 'concat_jobid', '', 'concatenated', 'validation_of_job_position_id', 'check_headcount', 'concat_test', 'concat_headcount', 'expected_companydivision', 'expected_department'];
                if (in_array($column, $nonMandatoryColumns)) {
                    continue;
                }

                $value = trim(preg_replace('/[\x00-\x1F\x7F\xA0]/u', '', $row[$column] ?? ''));
                if ($value === '') {
                    $errors[$column] = "Missing $column";
                    $hasErrors = true;
                } elseif ($column === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$column] = 'Invalid email';
                    $hasErrors = true;
                }
            }

            $row['error'] = implode('; ', $errors);
            $allRows[] = $row;

            if (!empty($errors)) {
                $errorMap[$index + 2] = $errors;
            }
        }

        if ($hasErrors) {
            session()->put('import_errors', $allRows);
            session()->put('import_error_map', $errorMap);
            return;
        }
       
        // try {
            // DB::transaction(function () use ($allRows) {
            //     foreach ($allRows as $row) {
            //          try {
            //             $this->insertRow($row);
            //          } catch (\Throwable $e) {
            //              Log::error("Row import failed: " . $e->getMessage(), ['row' => $row]);
            //          }
            //     }
            // });
            // DB::transaction(function () use ($allRows) {
                $this->processBulkRows($allRows);
            // });
            
        // } catch (\Exception $e) {
        //     Log::error('Import transaction failed: ' . $e->getMessage());
        //     session()->flash('import_exception', 'Something went wrong while importing. Please check the logs.');
        // }
    }

    public function hasErrors(): bool
    {
        return session()->has('import_errors');
    }

    public function exportErrorsToExcel(): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $rows = session('import_errors', []);
        $errorMap = session('import_error_map', []);
        if (empty($rows)) abort(404);

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $columns = array_keys($rows[0]);
        foreach ($columns as $colIndex => $colName) {
            $sheet->setCellValueByColumnAndRow($colIndex + 1, 1, $colName);
        }

        foreach ($rows as $rowIndex => $row) {
            $excelRow = $rowIndex + 2;
            foreach ($columns as $colIndex => $colName) {
                $sheet->setCellValueExplicitByColumnAndRow($colIndex + 1, $excelRow, $row[$colName] ?? '', DataType::TYPE_STRING);

                if (isset($errorMap[$excelRow]) && array_key_exists($colName, $errorMap[$excelRow])) {
                    $sheet->getStyleByColumnAndRow($colIndex + 1, $excelRow)
                        ->getFill()->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()->setARGB(Color::COLOR_RED);
                }
            }
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        return new \Symfony\Component\HttpFoundation\StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
            session()->forget(['import_errors', 'import_error_map']);
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="Validated_Organization_Structure_Sheet.xlsx"',
        ]);
    }

    // private function insertRow($row)
    // {
    //     $companyId = 3;

    //     $businessUnit = BusinessUnit::updateOrCreate(
    //         ['name' => trim($row['business_unit']), 'company_id' => $companyId],
    //         ['name' => trim($row['business_unit']), 'company_id' => $companyId, 'status' => 1],
    //     );

    //     $division = Division::updateOrCreate(
    //         ['business_unit_id' => $businessUnit->id, 'head_of_division' => trim($row['companydivision']), 'company_id' => $companyId],
    //         ['business_unit_id' => $businessUnit->id, 'head_of_division' => trim($row['companydivision']), 'company_id' => $companyId]
    //     );

    //     $department = Department::updateOrCreate(
    //         ['division_id' => $division->id, 'head_of_department' => trim($row['department']), 'company_id' => $companyId],
    //         ['division_id' => $division->id, 'name' => trim($row['department']), 'head_of_division' => trim($row['department']), 'status' => 1, 'company_id' => $companyId]
    //     );

    //     $isTop = strtolower(trim($row['top_position_yesno'])) === 'yes' ? 1 : 0;
       
    //     $job = Job::where([
    //         // 'business_unit_id' => $businessUnit->id,
    //         // 'division_id' => $division->id,
    //         // 'department_id' => $department->id,
    //         // 'title' => $row['job_position_name'],
    //         'position_code' => $row['job_position_id']
    //     ])->first();

    //     if (!$job) {
    //         $job = $this->createJob(
    //             $businessUnit->name, $division->name, $department->name,
    //             $row['job_position_name'], $row['job_description'], $row['management_level'],
    //             $businessUnit->id, $division->id, $department->id,
    //             $row['total_headcount'], $row['job_position_id'], $isTop, $row
    //         );
    //     }

    //     $countryId = MasterCountry::where('name', $row['nationality'])->value('id') ?? 135;
    //     $cityId = MasterCity::where('country_id', $countryId)->where('name', $row['city'])->value('id') ?? '';

    //     $user = $this->createUser($row, $countryId, $cityId, $division->id, $department->id, $job->id, $job->title);

    //     $this->assignPositionInOrgChart($row, $user->id, $user->name, $job->id, $department->id, $row['total_headcount']);
    // }

    private function processBulkRows(array $rows)
    { 
       
        try {
            OrganizationStructureBulkImport::dispatch($rows, $this->jdJobService);
          } catch (\Throwable $th) {
            \Log::error($th);
          } 
        // $companyId = 3;

        // // Preload and index business entities
        // $existingBusinessUnits = BusinessUnit::where('company_id', $companyId)->get()->keyBy(fn($item) => strtolower(trim($item->name)));
        // $existingDivisions = Division::where('company_id', $companyId)->get()->groupBy(fn($item) => $item->business_unit_id . '|' . strtolower(trim($item->head_of_division)));
        // $existingDepartments = Department::where('company_id', $companyId)->get()->groupBy(fn($item) => $item->division_id . '|' . strtolower(trim($item->head_of_department))); 
        // $existingJobs = Job::where('saved_job',1)->get()->keyBy('position_code');

        // // Preload country & city maps
        // $countries = MasterCountry::get()->keyBy(fn($item) => strtolower(trim($item->name)));
        // // $cities = MasterCity::get()->groupBy('country_id')->map->keyBy(fn($item) => strtolower(trim($item->name)));

        // // Optional: to collect queued emails after import
        // $queuedEmails = []; 

        // foreach ($rows as $row) {
        //     // 1. BUSINESS UNIT
        //     $businessUnitName = trim($row['business_unit']);
        //     $buKey = strtolower($businessUnitName);
        //     $businessUnit = $existingBusinessUnits[$buKey] ?? BusinessUnit::create([
        //         'name' => $businessUnitName,
        //         'company_id' => $companyId,
        //         'status' => 1,
        //     ]);
        //     $existingBusinessUnits[$buKey] = $businessUnit;

        //     // 2. DIVISION
        //     $divisionName = trim($row['companydivision']);
        //     $divKey = $businessUnit->id . '|' . strtolower($divisionName);
        //     $division = $existingDivisions[$divKey][0] ?? Division::create([
        //         'business_unit_id' => $businessUnit->id,
        //         'head_of_division' => $divisionName,
        //         'company_id' => $companyId,
        //     ]);
        //     $existingDivisions[$divKey] = collect([$division]);

        //     // 3. DEPARTMENT
        //     $departmentName = trim($row['department']);
        //     $deptKey = $division->id . '|' . strtolower($departmentName);
        //     $department = $existingDepartments[$deptKey][0] ?? Department::create([
        //         'division_id' => $division->id,
        //         'head_of_department' => $departmentName,
        //         'name' => $departmentName,
        //         'status' => 1,
        //         'company_id' => $companyId,
        //     ]);
        //     $existingDepartments[$deptKey] = collect([$department]);

        //     // 4. JOB
        //     $positionCode = $row['job_position_id'];
        //     $isTop = strtolower(trim($row['top_position_yesno'])) === 'yes' ? 1 : 0;
        //     $job = $existingJobs[$positionCode] ?? null;

        //     if (!$job) {
        //         $job = $this->createJob(
        //             $businessUnit->name,
        //             $division->head_of_division,
        //             $department->name,
        //             $row['job_position_name'],
        //             $row['job_description'],
        //             $row['management_level'],
        //             $businessUnit->id,
        //             $division->id,
        //             $department->id,
        //             $row['total_headcount'],
        //             $positionCode,
        //             $isTop,
        //             $row
        //         );
        //         if ($job) {
        //             $existingJobs[$positionCode] = $job;
        //         } else {
        //             // Optional: log job creation failure
        //             continue;
        //         }
        //     }

        //     // 5. COUNTRY & CITY
        //     $countryName = strtolower(trim($row['nationality']));
        //     $cityName = strtolower(trim($row['city']));
        //     $countryId = MasterCountry::whereRaw('LOWER(TRIM(name)) = ?', [strtolower(trim($row['nationality']))])->value('id') ?? 135;
        //     $cityId = $this->getCityId($countryId, $row['city']) ?? '';


        //     // 6. CREATE USER
        //     $user = $this->createUser(
        //         $row, $countryId, $cityId,
        //         $division->id, $department->id,
        //         $job->id, $job->title
        //     );

        //     // 7. ORG CHART ASSIGNMENT
        //     $this->assignPositionInOrgChart(
        //         $row, $user->id, $user->name,
        //         $job->id, $department->id,
        //         $row['total_headcount']
        //     );
        // }

        // Optionally send emails after bulk if needed
        // dispatch(new SendBulkWelcomeEmailsJob($queuedEmails));
    }



}
