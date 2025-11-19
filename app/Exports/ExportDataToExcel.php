<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportDataToExcel implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        $this->data =collect($data);
    }

    public function collection()
    {
        return $this->data->map(function ($item, $key) {

            $rowData = [
                'id' => $item['id'],
                'answer_a_count' => number_format($item['answer_a_count'], 0),
                'answer_b_count' => number_format($item['answer_b_count'], 0),
                'answer_c_count' => number_format($item['answer_c_count']),
                'answer_d_count' =>number_format($item['answer_d_count'], 0),
                'correct_option_count'=> number_format($item['correct_option_count'], 0),
                'answer_a_percentage'=> round($item['answer_a_percentage']),
                'answer_b_percentage'=> round($item['answer_b_percentage']),
                'answer_c_percentage'=> round($item['answer_c_percentage']),
                'answer_d_percentage'=> round($item['answer_d_percentage']),
                'correct_option_percentage'=> round($item['correct_option_percentage']),
                'average_time_taken'=> number_format($item['average_time_taken'], 0),
         
            ];
            return $rowData;
        });
    }

    public function headings(): array
    {
        // Customize the column headings here
        $headings = [
            'Question ID',
            'Answer A Count',
            'Answer B Count',
            'Answer C Count',
            'Answer D Count',
            'Correct Option Count',
            'Answer A (%)',
            'Answer B (%)',
            'Answer C (%)',
            'Answer D (%)',
            'Correct Option (%)',
            'Average Time Taken',

        ];
      
        return $headings;
    }
}
