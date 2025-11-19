<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Quiz;

class QuizzesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */



    public function run()
    {

      $data = [
        [
          "id" => 1,
          "name" => "work-values",
          "title" => "Work Values",
          "description" => "Explore the Work Values that are important for you in your future career.",
          "image" => "work-values.jpg"
        ],
        [
          "id" => 2,
          "name" => "interest-riasec",
          "title" => "Work Interests",
          "description" => "Discover your key areas of interest and the preferences that will make the best job match for you.",
          "image" => "riasec-work-interests.jpg"
        ],
        [
          "id" => 3,
          "name" => "five-factor",
          "title" => "Personality & Motivation",
          "description" => "Discover your unique personality profile and how it influences your motivation in life and work.",
          "image" => "personality-five-factor.jpg"
        ],
        [
          "id" => 4,
          "name" => "employability",
          "title" => "Employability",
          "description" => "Discover the work competencies that will make you highly employable.",
          "image" => "employability.jpg"
        ],
        [
          "id" => 5,
          "name" => "onet-profiler",
          "title" => "Career Explorer",
          "answers_referencing_quiz_id" => 2,
          "api" => true,
          "description" => "Explore possible careers that match your profiles.",
          "image" => "career-explorer-onet.jpg"
        ],
        [
          "id" => 6,
          "name" => "21-century-skills",
          "title" => "The Future of Work",
          "description" => "Discover the key competencies that you should develop for work in the future.",
          "image" => "future-21st-century.jpg"
        ],
        [
          "id" => 7,
          "name" => "english-test",
          "title" => "English Proficiency",
          "timer" => true,
          "description" => "Discover your level of competency in English.",
          "image" => "english.jpg"
        ]
      ];

      foreach ($data as $value) {

        Quiz::updateOrCreate($value);

      }

    }
}
