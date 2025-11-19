<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPopulationTabularDataToExcel implements FromCollection, WithHeadings
{
    protected $data;
    protected $type;
    public function __construct($data ,$type)
    {
        $this->data =collect($data);
        $this->type =$type;

    }

    public function collection()
    {
        return $this->data->map(function ($item) {

            if($this->type == 'caa'){
                $rowData = [
                    'display_name' => $item['display_name'],
                    'email' => $item['email'],
                    'gender' => $item['gender'] == 1 ? 'Male':'Female',
                    'race' => $item['race'],
                    'age' => $item['dob'],
                    'cgpa' => $item['cgpa'],   
                ];

                foreach ($item['questions'] as $i => $questionValue) {
                    $questionKey = 'Q' . ($i + 1); // Add 1 to match 'Q1', 'Q2', etc.
                    
                    // Check if the question is not set (unanswered) and set it to 'Not Answered'
                    if (!isset($questionValue)) {
                        $rowData[$questionKey] = 'Not Answered';
                    } elseif ($questionValue == 1) {
                        // Assuming '1' represents a correct answer
                        $rowData[$questionKey] = '1';
                    } else {
                        // Assuming '0' represents a wrong answer
                        $rowData[$questionKey] = '0';
                    }
                    
                }
    
                for ($i = count($item['questions']) + 1; $i <= 50; $i++) {
                    $questionKey = 'Q' . $i;
                    $rowData[$questionKey] = 'Not Answered';
                }

            }elseif($this->type == 'ocean'){
               
                $rowData = [
                    'display_name' => $item['display_name'],
                    'email' => $item['email'],
                    'gender' => $item['gender'] == 1 ? 'Male':'Female',
                    'race' => $item['race'],
                    'age' => $item['dob'],
                    'cgpa' => $item['cgpa'],   
                ];

                if(isset($item['ocean'])){
                foreach ($item['ocean'] as $i => $questionValue) {
                    $questionKey = 'Q' . ($i + 1); // Add 1 to match 'Q1', 'Q2', etc.
                    
                    // Check if the question is not set (unanswered) and set it to 'Not Answered'
                    if (!isset($questionValue)) {
                        $rowData[$questionKey] = 'Not Answered';
                    } 
                    else {
                        // Assuming '0' represents a wrong answer
                        $rowData[$questionKey] = $questionValue['answer'];
                    }
                }
            }    
                // for ($i = count($item['questions']) + 1; $i <= 120; $i++) {
                //     $questionKey = 'Q' . $i;
                //     $rowData[$questionKey] = 'Not Answered';
                // }

            }elseif($this->type == 'riasec'){
                
                $rowData = [
                    'display_name' => $item['display_name'],
                    'email' => $item['email'],
                    'gender' => $item['gender'] == 1 ? 'Male':'Female',
                    'race' => $item['race'],
                    'age' => $item['dob'],
                    'cgpa' => $item['cgpa'],
                    'realistic'  =>$item['realistic'] ?? 'N/A',
                    'investigative'  =>$item['investigative'] ?? 'N/A',
                    'artistic'  =>$item['artistic'] ?? 'N/A',
                    'social'  =>$item['social'] ?? 'N/A',
                    'enterprising'  =>$item['enterprising'] ?? 'N/A',
                    'conventional'  =>$item['conventional'] ?? 'N/A',

                ];

                if(isset($item['riasec'])){
                foreach ($item['riasec'] as $i => $questionValue) {
                    $questionKey = 'Q' . ($i + 1); // Add 1 to match 'Q1', 'Q2', etc.
                    
                    // Check if the question is not set (unanswered) and set it to 'Not Answered'
                    if (!isset($questionValue)) {
                        $rowData[$questionKey] = 'Not Answered';
                    } 
                    else {
                        // Assuming '0' represents a wrong answer
                        $rowData[$questionKey] = $questionValue['answer'];
                    }
                }
            }    
                // for ($i = count($item['questions']) + 1; $i <= 60; $i++) {
                //     $questionKey = 'Q' . $i;
                //     $rowData[$questionKey] = 'Not Answered';
                // }

            }
            elseif($this->type == 'english'){
                if(isset($item['english_comprehension'])){
                    $ec = number_format($item['english_comprehension']);
                }else{
                    $ec= 'N/A';
                }
                $rowData = [
                    'display_name' => $item['display_name'],
                    'email' => $item['email'],
                    'gender' => $item['gender'] == 1 ? 'Male':'Female',
                    'race' => $item['race'],
                    'age' => $item['dob'],
                    'cgpa' => $item['cgpa'],  
                    'english_comprehension' =>$ec,
                    'english_grammar'=>$item['english_grammar'] ?? 'N/A',
                    'english_total'=>$item['english_total'] ?? 'N/A'
                ];

               
            

            }elseif($this->type == 'all'){
                // CAA Start
                
                if(isset($item['english_comprehension'])){
                    $ec = number_format($item['english_comprehension']);
                }else{
                    $ec= 'N/A';
                }
                $rowData = [
                    'display_name' => $item['display_name'],
                    'email' => $item['email'],
                    'gender' => $item['gender'] == 1 ? 'Male':'Female',
                    'race' => $item['race'],
                    'age' => $item['dob'],
                    'cgpa' => $item['cgpa'], 
                    'english_comprehension' =>$ec,
                    'english_grammar'=>$item['english_grammar'] ?? 'N/A',
                    'english_total'=>$item['english_total'] ?? 'N/A',
                    'realistic'  =>$item['realistic'] ?? 'N/A',
                    'investigative'  =>$item['investigative'] ?? 'N/A',
                    'artistic'  =>$item['artistic'] ?? 'N/A',
                    'social'  =>$item['social'] ?? 'N/A',
                    'enterprising'  =>$item['enterprising'] ?? 'N/A',
                    'conventional'  =>$item['conventional'] ?? 'N/A',
                ];

                foreach ($item['questions'] as $i => $questionValue) {
                    $questionKey = 'CAA Q' . ($i + 1); // Add 1 to match 'Q1', 'Q2', etc.
                    
                    // Check if the question is not set (unanswered) and set it to 'Not Answered'
                    if (!isset($questionValue)) {
                        $rowData[$questionKey] = 'Not Answered';
                    } elseif ($questionValue == 1) {
                        // Assuming '1' represents a correct answer
                        $rowData[$questionKey] = '1';
                    } else {
                        // Assuming '0' represents a wrong answer
                        $rowData[$questionKey] = '0';
                    }
                }
                for ($i = count($item['questions']) + 1; $i <= 50; $i++) {
                    $questionKey = 'CAA Q' . $i;
                    $rowData[$questionKey] = 'Not Answered';
                }

            //     for ($i = count($item['questions']); $i <= 50; $i++){
            //         $questionKey = 'CAA Q' . $i +1;
            //         if (isset($item['questions'][$i - 1])){

            //             if (($item['questions'][0] == 0 || $item['questions'][1] == 0) && $i > 2){
            //                 $rowData[$questionKey] = 'Not Answered';
            //             }
            //         else{

            //             $rowData[$questionKey] = $item['questions'][$i - 1];

            //         }
            //         }else{
            //             $rowData[$questionKey] = 'Not Answered';
            //         }
                
               
            // }
                // Ocean start

                if(isset($item['ocean'])){
                    foreach ($item['ocean'] as $i => $questionValue) {
                        $questionKey = 'OCEAN Q' . ($i + 1); // Add 1 to match 'Q1', 'Q2', etc.
                        
                        // Check if the question is not set (unanswered) and set it to 'Not Answered'
                        if (!isset($questionValue)) {
                            $rowData[$questionKey] = 'Not Answered';
                        } 
                        else {
                            // Assuming '0' represents a wrong answer
                            $rowData[$questionKey] = $questionValue['answer'];
                        }
                    }
                }    

                // RIASEC Start
                if(isset($item['riasec'])){
                    foreach ($item['riasec'] as $i => $questionValue) {
                        $questionKey = 'RIASEC Q' . ($i + 1); // Add 1 to match 'Q1', 'Q2', etc.
                        
                        // Check if the question is not set (unanswered) and set it to 'Not Answered'
                        if (!isset($questionValue)) {
                            $rowData[$questionKey] = 'Not Answered';
                        } 
                        else {
                            // Assuming '0' represents a wrong answer
                            $rowData[$questionKey] = $questionValue['answer'];
                        }
                    }
                }    

             
               
            }
            return $rowData;
        
        });
    }

    public function headings(): array
    {
        // Customize the column headings here
        if($this->type == 'caa'){
            $headings = [
                'Name',
                'Email',
                'Gender',
                'Race',
                'Age',
                'CGPA',
            ];
            for ($i = 1; $i <= 50; $i++) {
                $headings[] = 'Q' . $i;
            }
        

        }elseif($this->type == 'ocean'){
            $headings = [
                'Name',
                'Email',
                'Gender',
                'Race',
                'Age',
                'CGPA',
            ];
            for ($i = 1; $i <= 120; $i++) {
                $headings[] = 'Q' . $i;
            }
        
        }elseif($this->type == 'riasec'){
            $headings = [
                'Name',
                'Email',
                'Gender',
                'Race',
                'Age',
                'CGPA',
                'R',
                'I',
                'A',
                'S',
                'E',
                'C',
            ];
            for ($i = 1; $i <= 60; $i++) {
                $headings[] = 'Q' . $i;
            }
        
        }elseif($this->type == 'english'){
            $headings = [
                'Name',
                'Email',
                'Gender',
                'Race',
                'Age',
                'CGPA',
                'C',
                'G',
                'T'
            ];
            // for ($i = 1; $i <= 60; $i++) {
            //     $headings[] = 'Q' . $i;
            // }
        
        }
        elseif($this->type == 'all'){
            $headings = [
                'Name',
                'Email',
                'Gender',
                'Race',
                'Age',
                'CGPA',
                'C',
                'G',
                'T',
                'R',
                'I',
                'A',
                'S',
                'E',
                'C',
                
            ];
            // CAA Start
            for ($i = 1; $i <= 50; $i++) {
                $headings[] = 'CAA Q' . $i;
            }
            // Ocean Start
            for ($i = 1; $i <= 120; $i++) {
                $headings[] = 'Ocean Q' . $i;
            }
             // RIASEC Start
             for ($i = 1; $i <= 60; $i++) {
                $headings[] = 'RIASEC Q' . $i;
            }


          
        }
      
      
        return $headings;
    }
}
