<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeeAssessmentExport implements FromQuery, WithHeadings, WithMapping
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
            $user->middle_name ?? '-',
            $user->last_name ?? '-',
            $user->email ?? '-',
            $user->is_personality_motivation_completed ?? '-',
            $user->is_work_interest_completed ?? '-',
            $user->is_cognitive_ability_completed ?? '-'
        ];
    }
}
