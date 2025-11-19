<?php

namespace App\Imports;

use App\Models\Department;
use App\Models\Job;
use App\Models\MasterInterviewQuestion;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InterviewQuestionsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        if ($rows->isEmpty()) return;

        // Get department and job from first row
        $firstRow = $rows->first();

        $department = Department::where('name', $firstRow['department_name'])->first();
        $job = Job::where('title', $firstRow['job_title'])->first();

        if (!$department || !$job) {
            throw new \Exception("Invalid department or job title in Excel file.");
        }

        // Optional: clear old questions
        MasterInterviewQuestion::where('department_id', $department->id)
            ->where('job_id', $job->id)
            ->delete();

        // Store new ones with auto question_number
        foreach ($rows as $index => $row) {
            if (!empty($row['title'])) {
                MasterInterviewQuestion::create([
                    'department_id' => $department->id,
                    'job_id' => $job->id,
                    'question_number' => $index + 1,
                    'title' => $row['title'],
                    'level' => 'basic', // or make dynamic later
                    'option_1_score'   => 1,
                    'option_2_score'   => 3,
                    'option_3_score'   => 5,
                ]);
            }
        }
    }
}
