<?php

namespace App\Imports;

use Illuminate\Support\Facades\Log;
use App\Services\Job\JdJobService;
use App\Jobs\OrganizationStructureBulkImport;
use Maatwebsite\Excel\Concerns\{
    ToArray,
    WithHeadingRow,
    WithCustomValueBinder
};
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;

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
        $seen = [
            'employee_id' => [],
            'email' => [],
            'tin' => [],
            'sss' => [],
            'hdmf' => [],
            'philhealth' => [],
            'job_map' => [],
        ];

        $topPositionFound = false;
        $allEmployeeIds = [];

        foreach ($rows as $index => $row) {
            if (collect($row)->every(fn($v) => trim($v) === '')) continue;

            $errors = [];
            $employeeId = trim($row['employee_id'] ?? '');
            $email = strtolower(trim($row['email'] ?? ''));
            $superiorId = trim($row['superior_emp_id'] ?? '');
            $jobPositionId = trim($row['job_position_id'] ?? '');

            // Required column check
            foreach ($columns as $column) {
                if ($this->isRequiredColumn($column)) {
                    $value = trim($row[$column] ?? '');
                    if ($value === '') {
                        $errors[$column] = "Missing $column";
                        $hasErrors = true;
                    }
                }
            }

            // Unique validations
            if ($employeeId !== '') {
                if (isset($seen['employee_id'][$employeeId])) {
                    $errors['employee_id'] = "Duplicate Employee ID: $employeeId";
                }
                $seen['employee_id'][$employeeId] = true;
                $allEmployeeIds[] = $employeeId;
            }

            if ($email !== '') {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "Invalid Email";
                } elseif (isset($seen['email'][$email])) {
                    $errors['email'] = "Duplicate Email: $email";
                }
                $seen['email'][$email] = true;
            }

            foreach (['tin', 'sss', 'hdmf', 'philhealth'] as $key) {
                $val = trim($row[$key] ?? '');
                if ($val !== '') {
                    if (isset($seen[$key][$val])) {
                        $errors[$key] = "Duplicate $key: $val";
                    }
                    $seen[$key][$val] = true;
                }
            }

            // Superior / Top Position check
            if ($superiorId === '' || strtoupper($superiorId) === 'NULL') {
                if (strtolower($row['top_position_yesno'] ?? '') === 'yes') {
                    if ($topPositionFound) {
                        $errors['superior_emp_id'] = "Only one row can have Superior_Emp_ID NULL with Top Position = YES";
                    }
                    $topPositionFound = true;
                } else {
                    $errors['superior_emp_id'] = "Superior_Emp_ID cannot be NULL unless Top Position = YES";
                }
            }

            // Job uniqueness
            if ($jobPositionId !== '') {
                $jobKey = strtolower(trim($row['job_position_name'] ?? '') . '|' . trim($row['companydivision'] ?? '') . '|' . trim($row['department'] ?? ''));
                if (isset($seen['job_map'][$jobPositionId]) && $seen['job_map'][$jobPositionId] !== $jobKey) {
                    $errors['job_position_id'] = "Job Position ID $jobPositionId already mapped differently";
                }
                $seen['job_map'][$jobPositionId] = $jobKey;
            }

            $row['error'] = implode('; ', $errors);
            $allRows[] = $row;

            if (!empty($errors)) {
                $errorMap[$index + 2] = $errors; // +2 for Excel row
            }
        }

        // Second pass: validate superior references
        foreach ($allRows as $i => $row) {
            $superiorId = trim($row['superior_emp_id'] ?? '');
            if ($superiorId !== '' && strtoupper($superiorId) !== "NULL" && !in_array($superiorId, $allEmployeeIds)) {
                $errorMap[$i + 2]['superior_emp_id'] = "Superior Employee ID not found in file";
                $allRows[$i]['error'] .= '; Superior Employee ID not found';
                $hasErrors = true;
            }
        }

        // Check if at least one top position exists
        if (!$topPositionFound) {
            $hasErrors = true;
            $errorMap[1]['superior_emp_id'] = "One Top Position (YES) with NULL Superior_Emp_ID is required";
        }

        if ($hasErrors) {
            session()->put('import_errors', $allRows);
            session()->put('import_error_map', $errorMap);
            return;
        }

        $this->processBulkRows($allRows);
    }

    private function isRequiredColumn($column): bool
    {
        $required = [
            'employee_id',
            'email',
            'job_position_id',
            'job_position_name',
            'business_unit',
            'companydivision',
            'department'
        ];
        return in_array(strtolower($column), $required);
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
                $value = $row[$colName] ?? '';
                $sheet->setCellValueExplicitByColumnAndRow($colIndex + 1, $excelRow, $value, DataType::TYPE_STRING);

                // highlight cell with error
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

    private function processBulkRows(array $rows)
    {
        try {
            // dd($rows);
            OrganizationStructureBulkImport::dispatch($rows, $this->jdJobService);
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
}
