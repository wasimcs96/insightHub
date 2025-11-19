<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataExport implements FromQuery, WithHeadings
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
        return $this->users->select($this->columns);
    }
    public function headings(): array
    {
        // Adjust the headings to match the selected fields
        return $this->headings;
    }
}
