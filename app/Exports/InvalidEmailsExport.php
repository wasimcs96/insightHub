<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvalidEmailsExport implements FromArray, WithHeadings
{
    protected $emails;

    public function __construct(array $emails)
    {
        $this->emails = $emails;
    }

    /**
     * Return array of invalid emails for export.
     */
    public function array(): array
    {
        return $this->emails;
    }

    /**
     * Define the headings for the Excel file.
     */
    public function headings(): array
    {
        return ['Email', 'Validation Result'];
    }
}