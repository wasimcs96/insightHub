<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\QuizDomain;

use App\Models\Quiz;

class QuizDomainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

      $workValuesQuizId = Quiz::where("name", "work-values")->first()->id;
      $interestsRiasecQuizId = Quiz::where("name", "interest-riasec")->first()->id;
      $fiveFactorQuizId = Quiz::where("name", "five-factor")->first()->id;
      $employabilityQuizId = Quiz::where("name", "employability")->first()->id;
      $onetProfilerQuizId = Quiz::where("name", "onet-profiler")->first()->id;
      $twentyFirstCenturyQuizId = Quiz::where("name", "21-century-skills")->first()->id;
      $englishQuizId = Quiz::where("name", "english-test")->first()->id;

      $data = [
        ["title" => "Mastery", "order" => 1, "quiz_id" => $workValuesQuizId, 'color' => '#821437', 'low' => [0, 12], 'moderate' => [13, 31], 'high' => [32, 48]],
        ["title" => "Quality of Life", "order" => 2, "quiz_id" => $workValuesQuizId, 'color' => '#1D7D1C', 'low' => [0, 15], 'moderate' => [16, 39], 'high' => [40, 60]],
        ["title" => "Fellowship", "order" => 3,"quiz_id" => $workValuesQuizId, 'color' => '#BB490B', 'low' => [0, 15], 'moderate' => [16, 39], 'high' => [40, 60]],
        ["title" => "Creating Value", "order" => 4, "quiz_id" => $workValuesQuizId, 'color' => '#861414', 'low' => [0, 12], 'moderate' => [13, 31], 'high' => [32, 48]],
        ["title" => "General", "order" => 1, "quiz_id" => $interestsRiasecQuizId, 'color' => '#00C4CC'],
        ["title" => "General", "order" => 1, "quiz_id" => $fiveFactorQuizId, 'color' => '#00C4CC'],
        ["title" => "Ideas and Opportunities", "order" => 1, "quiz_id" => $employabilityQuizId, 'color' => '#851C3A'],
        ["title" => "Resources", "order" => 2, "quiz_id" => $employabilityQuizId, 'color' => '#009611'],
        ["title" => "Into Action", "order" => 3, "quiz_id" => $employabilityQuizId, 'color' => '#DA6E27'],
        ["title" => "General", "order" => 1, "quiz_id" => $onetProfilerQuizId, 'color' => '#00C4CC'],
        ["title" => "Cognitive", "order" => 1, "quiz_id" => $twentyFirstCenturyQuizId, 'color' => '#821437'],
        ["title" => "Interpersonal", "order" => 2, "quiz_id" => $twentyFirstCenturyQuizId, 'color' => '#1D7D1C'],
        ["title" => "Self Leadership", "order" => 3, "quiz_id" => $twentyFirstCenturyQuizId, 'color' => '#BB490B'],
        ["title" => "Digital", "order" => 4, "quiz_id" => $twentyFirstCenturyQuizId, 'color' => '#861414'],
        ["title" => "General", "order" => 1, "quiz_id" => $englishQuizId, 'color' => '#00C4CC'],
      ];

      foreach ($data as $value) {

        QuizDomain::updateOrCreate($value);

      }

    }
}
