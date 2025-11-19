<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeeExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $users, $headings, $columns;

    public function __construct($users, $headings, $columns)
    {
        $this->users = $users;
        $this->headings = $headings;
        $this->columns = $columns;
    }

    public function query()
    {
        return $this->users;
    }
    public function headings(): array
    {
        // Adjust the headings to match the selected fields
        return $this->headings;
    }
    public function map($user): array
    {
        return [
            $user->first_name ?? '-',
            $user->last_name ?? '-',
            $user->email ?? '-',
            $user->age ?? '-',
            $user->mobile_number ?? '-',
            $user->national_id ?? '-',
            $user->passport_no ?? '-',
            $user->passport_expiry_date ?? '-',
            $user->home_address ?? '-',
            $user->education_level_check->name ?? '-',
            $user->higher_learning->name ?? '-',
            $user->scope->name ?? '-',
            $user->year_of_experience_in_it_sector ?? '-'
        ];
    }
}
