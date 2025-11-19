<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TalentInsightExport implements FromQuery, WithHeadings
{
    protected $query;
    protected $selectedFields;

    public function __construct($query, $selectedFields)
    {
        $this->query = $query;
        $this->selectedFields = $selectedFields;
    }

    public function query()
    {
        return $this->query;
    }

    public function headings(): array
    {
        // Define the available headings for each field
        $availableHeadings = [
            'Name',
            'Position Title',
            // 'OMR Level',
            'BFR Level',
            // 'TA Level',
            'TSMR Level',
            'SSMR Level',
            'JMR Level',
            'CAT Level',
            'LP Level',
            'GP Level',
            'RCI Level',
            'FR Level',
            'WAF Level'
        ];
    
        // Filter the headings based on the selected fields
        $selectedHeadings = ['Name', 'Position Title'];
        
        foreach ($this->selectedFields as $field) {
            switch ($field) {
                // Include OMR Level only if it's not in the excluded databases
                case 'omr_level':
                    if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required'))) {
                        $selectedHeadings[] = 'OMR Level';
                    }
                    break;
                // Include TA Level only if it's not in the excluded databases
                case 'ta_level':
                    if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required'))) {
                        $selectedHeadings[] = 'TA Level';
                    }
                    break;
                case 'bfr_level':
                    $selectedHeadings[] = 'BFR Level';
                    break;
                case 'tsmr_level':
                    $selectedHeadings[] = 'TSMR Level';
                    break;
                case 'ssmr_level':
                    $selectedHeadings[] = 'SSMR Level';
                    break;
                case 'jmr_level':
                    $selectedHeadings[] = 'JMR Level';
                    break;
                case 'cat_level':
                    $selectedHeadings[] = 'CAT Level';
                    break;
                case 'lp_level':
                    $selectedHeadings[] = 'LP Level';
                    break;
                case 'gp_level':
                    $selectedHeadings[] = 'GP Level';
                    break;
                case 'rci_level':
                    $selectedHeadings[] = 'RCI Level';
                    break;
                case 'fr_level':
                    $selectedHeadings[] = 'FR Level';
                    break;
                case 'waf_level':
                    $selectedHeadings[] = 'WAF Level';
                    break;
            }
        }
    
        return $selectedHeadings;
    }
    
}
