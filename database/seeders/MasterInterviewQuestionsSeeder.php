<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterInterviewQuestionsSeeder extends Seeder
{
    public function run()
    {

        // Interview questions data
        $questions = [
            [
                'job_id' => 4796,
                'question_number' => 1,
                'level' => null,
                'title' => 'Can you walk us through your experience managing turnaround projects?',
                'option_1_score' => 1,
                'option_2_score' => 3,
                'option_3_score' => 5,
                'option_4_score' => null
            ],
            [
                'job_id' => 4796,
                'question_number' => 2,
                'level' => null,
                'title' => 'What key factors do you consider when planning a turnaround event?',
                'option_1_score' => 1,
                'option_2_score' => 3,
                'option_3_score' => 5,
                'option_4_score' => null
            ],
            [
                'job_id' => 4796,
                'question_number' => 3,
                'level' => null,
                'title' => 'How do you ensure that turnaround projects stay on schedule and within budget?',
                'option_1_score' => 1,
                'option_2_score' => 3,
                'option_3_score' => 5,
                'option_4_score' => null
            ],
            [
                'job_id' => 4796,
                'question_number' => 4,
                'level' => null,
                'title' => 'What tools or software have you used for turnaround planning and tracking?',
                'option_1_score' => 1,
                'option_2_score' => 3,
                'option_3_score' => 5,
                'option_4_score' => null
            ],
            [
                'job_id' => 4796,
                'question_number' => 5,
                'level' => null,
                'title' => 'How do you coordinate with multiple stakeholders (e.g., contractors, operations, and leadership) during a turnaround?',
                'option_1_score' => 1,
                'option_2_score' => 3,
                'option_3_score' => 5,
                'option_4_score' => null
            ],
            [
                'job_id' => 4796,
                'question_number' => 6,
                'level' => null,
                'title' => 'Can you describe a time when you had to handle an unexpected delay or challenge during a turnaround? How did you resolve it?',
                'option_1_score' => 1,
                'option_2_score' => 3,
                'option_3_score' => 5,
                'option_4_score' => null
            ],
            [
                'job_id' => 4796,
                'question_number' => 7,
                'level' => null,
                'title' => 'What steps do you take to ensure safety and compliance during a turnaround?',
                'option_1_score' => 1,
                'option_2_score' => 3,
                'option_3_score' => 5,
                'option_4_score' => null
            ],
            [
                'job_id' => 4796,
                'question_number' => 8,
                'level' => null,
                'title' => 'How do you handle risk assessment and mitigation in a turnaround project?',
                'option_1_score' => 1,
                'option_2_score' => 3,
                'option_3_score' => 5,
                'option_4_score' => null
            ],
            [
                'job_id' => 4796,
                'question_number' => 9,
                'level' => null,
                'title' => 'How do you handle conflicts between teams or contractors during a turnaround?',
                'option_1_score' => 1,
                'option_2_score' => 3,
                'option_3_score' => 5,
                'option_4_score' => null
            ],
            [
                'job_id' => 4796,
                'question_number' => 10,
                'level' => null,
                'title' => 'What’s the most significant turnaround project you\'ve managed, and what was the outcome?',
                'option_1_score' => 1,
                'option_2_score' => 3,
                'option_3_score' => 5,
                'option_4_score' => null
            ],
        ];

        // Insert data into database
        DB::table('master_interview_questions')->insert($questions);
    }
}
