<?php

namespace App\Formatters\Results;

use App\Repositories\Rest\AnalyticsRepository;

class FiveFactor
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

    $response = [];

    foreach ($users as $user) {

      foreach ($this->quizQuestions['questions']['domains'] as $domain) {

        foreach ($domain['values'] as $value) {

          if (!isset($response[$value['title']])) $response[$value['title']] = ['score' => null, 'points' => 0];

          $questionsTotal = 0;

          foreach ($value['questions'] as $question) {

            foreach ($question['answers'] as $answer) {

              if ($answer['user_id'] == $user) $questionsTotal += $answer['answer'];
            }
          }

          $response[$value['title']]['points'] = $questionsTotal;

          if ($questionsTotal <= 25) {

            $response[$value['title']]['score'] = 'Low';
          }

          if ($questionsTotal > 25 && $questionsTotal <= 76) {

            $response[$value['title']]['score'] = 'Moderate';
          }

          if ($questionsTotal > 76) {

            $response[$value['title']]['score'] = 'High';
          }
        }
      }
    }

    return $response;
  }

  public function pipeLinesForAnalytical()
  {

    $users = (new AnalyticsRepository)->extractUsers($this->quizQuestions);


    $responsePipeline = ['totalScore' => ['score' => null, 'points' => 0], 'domains' => []];

    $response = [];

    foreach ($users as $user) {

      $totalScore = 0;


      foreach ($this->quizQuestions['questions']['domains'] as $domain) {

        foreach ($domain['values'] as $value) {

          if (!isset($response[$value['title']])) $response[$value['title']] = ['score' => null, 'points' => 0];

          $questionsTotal = 0;

          foreach ($value['questions'] as $question) {

            foreach ($question['answers'] as $answer) {

              if ($answer['user_id'] == $user) $questionsTotal += $answer['answer'];

              if ($answer['user_id'] == $user) $totalScore += $answer['answer'];
            }
          }

          $response[$value['title']]['points'] = $questionsTotal;

          if ($questionsTotal <= 25) {

            $response[$value['title']]['score'] = 'Low';
          }

          if ($questionsTotal > 25 && $questionsTotal <= 76) {

            $response[$value['title']]['score'] = 'Moderate';
          }

          if ($questionsTotal > 76) {

            $response[$value['title']]['score'] = 'High';
          }
        }
      }
      $totalScore = $totalScore * 100 / 240;

      $responsePipeline['totalScore']['points'] = $totalScore;
      $responsePipeline['totalScore']['score'] = $totalScore < 33 ? 'Low' : ($totalScore >= 33 && $totalScore <= 67 ? 'Moderate' : 'High');
    }

    $responsePipeline['domains'] = $response;


    return $responsePipeline;
  }
}
