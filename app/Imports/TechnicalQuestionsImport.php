<?php

namespace App\Imports;

use App\Models\MasterTechnicalQuestion;
use App\Models\Job;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Exception;

class TechnicalQuestionsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Get the job title from the Excel sheet
        // $jobTitle = $row['job_title'];
        
        // Find the job by title
        // $job = Job::where('title', $jobTitle)->first();
        $jobTitle = preg_replace('/\s+/', ' ', trim($row['job_title']));

        $job = Job::whereRaw("LOWER(REPLACE(title, ' ', '')) LIKE ?", ['%' . strtolower(str_replace(' ', '', $jobTitle)) . '%'])->first();
        
        // If job is not found, log and throw an exception
        // dd($job);
        if (!$job) {
            Log::warning("Job title '$jobTitle' does not exist.");
            throw new Exception("Job title '$jobTitle' is incorrect or does not exist.");
        }

        // Return the new MasterTechnicalQuestion model if job is found
        return new MasterTechnicalQuestion([
            'job_id' => $job->id,  // Assign job_id
            'title' => $row['title'],
            'level' => $row['level'],
            'question_number' => $row['question_number'],
            'score' => $row['score'],
            'option_1' => $row['option_1'],
            'option_2' => $row['option_2'],
            'option_3' => $row['option_3'],
            'option_4' => $row['option_4'],
            'correct_answer' => $row['correct_answer'],
        ]);
    }
    

}
