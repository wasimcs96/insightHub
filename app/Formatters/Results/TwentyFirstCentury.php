<?php

namespace App\Formatters\Results;

use App\Repositories\Rest\AnalyticsRepository;

class TwentyFirstCentury
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

    $response = ['totalScore' => ['score' => null, 'points' => 0], 'domains' => []];

    foreach ($users as $user) {

      $totalScore = 0;

      foreach ($this->quizQuestions['questions']['domains'] as $domain) {

        if (!isset($response['domains'][$domain['title']])) $response['domains'][$domain['title']] = ['score' => null, 'points' => 0, 'values' => []];

        $questionsTotalDomain = 0;

        foreach ($domain['values'] as $value) {

          if (!isset($response['domains'][$domain['title']]['values'][$value['title']])) $response['domains'][$domain['title']]['values'][$value['title']] = ['score' => null, 'points' => 0];

          $questionsTotalValue = 0;

          foreach ($value['questions'] as $question) {

            foreach ($question['answers'] as $answer) {

              if ($answer['user_id'] == $user) $questionsTotalValue += $answer['answer'];

              if ($answer['user_id'] == $user) $questionsTotalDomain += $answer['answer'];

              if ($answer['user_id'] == $user) $totalScore += $answer['answer'];
            }
          }

          $questionsTotal = $questionsTotalValue * 100 / 20;

          $response['domains'][$domain['title']]['values'][$value['title']]['points'] = $questionsTotal;

          if ($questionsTotal < 33) {

            $response['domains'][$domain['title']]['values'][$value['title']]['score'] = 'Low';
          }

          if ($questionsTotal >= 33 && $questionsTotal <= 67) {

            $response['domains'][$domain['title']]['values'][$value['title']]['score'] = 'Moderate';
          }

          if ($questionsTotal > 67) {

            $response['domains'][$domain['title']]['values'][$value['title']]['score'] = 'High';
          }
        }



        $questionsTotal = $questionsTotalDomain * 100 / 80;

        $response['domains'][$domain['title']]['points'] = $questionsTotal;

        if ($questionsTotal < 33) {

          $response['domains'][$domain['title']]['score'] = 'Low';
        }

        if ($questionsTotal >= 33 && $questionsTotal <= 67) {

          $response['domains'][$domain['title']]['score'] = 'Moderate';
        }

        if ($questionsTotal > 67) {

          $response['domains'][$domain['title']]['score'] = 'High';
        }
      }

      $totalScore = $totalScore * 100 / 320;

      $response['totalScore']['points'] = $totalScore;
      $response['totalScore']['score'] = $totalScore < 33 ? 'Low' : ($totalScore >= 33 && $totalScore <= 67 ? 'Moderate' : 'High');
    }

    return $response;
  }

  public function pipeLinesForAnalytical()
  {

    $users = (new AnalyticsRepository)->extractUsers($this->quizQuestions);

    $response = ['totalScore' => ['score' => null, 'points' => 0], 'domains' => []];

    foreach ($users as $user) {

      $totalScore = 0;

      foreach ($this->quizQuestions['questions']['domains'] as $domain) {

        if (!isset($response['domains'][$domain['title']])) $response['domains'][$domain['title']] = ['score' => null, 'points' => 0, 'values' => []];

        $questionsTotalDomain = 0;

        foreach ($domain['values'] as $value) {

          if (!isset($response['domains'][$domain['title']]['values'][$value['title']])) $response['domains'][$domain['title']]['values'][$value['title']] = ['score' => null, 'points' => 0];

          $questionsTotalValue = 0;

          foreach ($value['questions'] as $question) {

            foreach ($question['answers'] as $answer) {

              if ($answer['user_id'] == $user) $questionsTotalValue += $answer['answer'];

              if ($answer['user_id'] == $user) $questionsTotalDomain += $answer['answer'];

              if ($answer['user_id'] == $user) $totalScore += $answer['answer'];
            }
          }

          $questionsTotal = $questionsTotalValue * 100 / 20;

          $response['domains'][$domain['title']]['values'][$value['title']]['points'] = $questionsTotal;

          if ($questionsTotal < 33) {

            $response['domains'][$domain['title']]['values'][$value['title']]['score'] = 'Low';
          }

          if ($questionsTotal >= 33 && $questionsTotal <= 67) {

            $response['domains'][$domain['title']]['values'][$value['title']]['score'] = 'Moderate';
          }

          if ($questionsTotal > 67) {

            $response['domains'][$domain['title']]['values'][$value['title']]['score'] = 'High';
          }
        }



        $questionsTotal = $questionsTotalDomain * 100 / 80;

        $response['domains'][$domain['title']]['points'] = $questionsTotal;

        if ($questionsTotal < 33) {

          $response['domains'][$domain['title']]['score'] = 'Low';
        }

        if ($questionsTotal >= 33 && $questionsTotal <= 67) {

          $response['domains'][$domain['title']]['score'] = 'Moderate';
        }

        if ($questionsTotal > 67) {

          $response['domains'][$domain['title']]['score'] = 'High';
        }
      }

      $totalScore = $totalScore * 100 / 320;

      $response['totalScore']['points'] = $totalScore;
      $response['totalScore']['score'] = $totalScore < 33 ? 'Low' : ($totalScore >= 33 && $totalScore <= 67 ? 'Moderate' : 'High');
    }

    return $response;
  }
}
