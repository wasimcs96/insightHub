<?php

namespace App\Formatters\Results;

use App\Repositories\Rest\AnalyticsRepository;

class InterestRiasec
{

  private $quizQuestions;

  public function __construct($quizQuestions)
  {

    $this->quizQuestions = $quizQuestions;
  }

  public static function format($quizQuestions)
  {

    return new static($quizQuestions);
  }

  public function get()
  {

    $users = (new AnalyticsRepository)->extractUsers($this->quizQuestions);

    $newArr = [];

    $response = [];

    foreach ($users as $user) {

      foreach ($this->quizQuestions['questions']['domains'] as $domain) {

        foreach ($domain['values'] as $value) {

          $newArr[$value['title']] = ['points' => 0, 'top' => false, 'topThree' => false, 'score' => null];

          $questionsTotal = 0;

          foreach ($value['questions'] as $question) {

            foreach ($question['answers'] as $answer) {

              if ($answer['user_id'] == $user) $questionsTotal += $answer['answer'];
            }
          }

          $newArr[$value['title']]['points'] = $questionsTotal;

          if ($questionsTotal < 12) {
            $newArr[$value['title']]['score'] = 'Low';
          }

          if ($questionsTotal >= 13 && $questionsTotal <= 31) {
            $newArr[$value['title']]['score'] = 'Moderate';
          }

          if ($questionsTotal > 32) {
            $newArr[$value['title']]['score'] = 'High';
          }

          $response[$user][] = ['value' => $questionsTotal, 'label' => $value['title'], 'color' => $value['color']];
        }
      }
    }



    foreach ($response as $key => $value) {

      usort($response[$key], fn ($a, $b) => $b['value'] - $a['value']);
    }

    foreach ($response as $key => $value) {

      $newArr[$value[0]['label']]['top'] = true;

      $newArr[$value[1]['label']]['topThree'] = true;
      $newArr[$value[2]['label']]['topThree'] = true;
    }


    return $newArr;
  }

  public function pipeLinesForAnalytical()
  {

    $users = (new AnalyticsRepository)->extractUsers($this->quizQuestions);

    $newArr = [];

    $responsePipeline = ['totalScore' => ['score' => null, 'points' => 0], 'domains' => []];

    $response = [];

    foreach ($users as $user) {

      $totalScore = 0;


      foreach ($this->quizQuestions['questions']['domains'] as $domain) {

        foreach ($domain['values'] as $value) {

          $newArr[$value['title']] = ['points' => 0, 'top' => false, 'topThree' => false, 'score' => null];

          $questionsTotal = 0;

          foreach ($value['questions'] as $question) {

            foreach ($question['answers'] as $answer) {

              if ($answer['user_id'] == $user) $questionsTotal += $answer['answer'];
              if ($answer['user_id'] == $user) $totalScore += $answer['answer'];
            }
          }

          $newArr[$value['title']]['points'] = $questionsTotal;

          if ($questionsTotal < 33) {

            $newArr[$value['title']]['score'] = 'Low';
          }

          if ($questionsTotal >= 33 && $questionsTotal <= 67) {

            $newArr[$value['title']]['score'] = 'Moderate';
          }

          if ($questionsTotal > 67) {

            $newArr[$value['title']]['score'] = 'High';
          }

          $response[$user][] = ['value' => $questionsTotal, 'label' => $value['title'], 'color' => $value['color']];
        }
      }
      $totalScore = $totalScore * 100 / 240;

      $responsePipeline['totalScore']['points'] = $totalScore;
      $responsePipeline['totalScore']['score'] = $totalScore < 33 ? 'Low' : ($totalScore >= 33 && $totalScore <= 67 ? 'Moderate' : 'High');
    }



    foreach ($response as $key => $value) {

      usort($response[$key], fn ($a, $b) => $b['value'] - $a['value']);
    }

    foreach ($response as $key => $value) {

      $newArr[$value[0]['label']]['top'] = true;

      $newArr[$value[1]['label']]['topThree'] = true;
      $newArr[$value[2]['label']]['topThree'] = true;
    }

    $responsePipeline['domains'] = $newArr;

    return $responsePipeline;
  }
}
