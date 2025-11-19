<?php

namespace App\Formatters\Results;

use App\Repositories\Rest\AnalyticsRepository;

class EnglishTest
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

    $arr = [];

    foreach ($users as $user) {

      foreach ($this->quizQuestions['questions']['domains'] as $domain) {

        if (!isset($response[$domain['title']])) $response[$domain['title']] = ['score' => null, 'points' => 0, 'values' => []];

        $questionsTotalDomain = 0;

        foreach ($domain['values'] as $value) {

          if (!isset($response[$domain['title']]['values'][$value['title']])) $response[$domain['title']]['values'][$value['title']] = ['score' => null, 'points' => 0];

          $questionsTotalValue = 0;

          foreach ($value['questions'] as $question) {

            foreach ($question['answers'] as $answer) {

              if ($answer['user_id'] == $user) $questionsTotalDomain += $answer['answer']; //$answer['answer'] * 100 / ($value['title'] == 'Grammar' ? 20 : 30);

              if ($answer['user_id'] == $user) $questionsTotalValue += $answer['answer'] * 100 / ($value['title'] == 'Grammar' ? 20 : 30);
            }
          }

          $questionsTotal = $questionsTotalValue;

          $response[$domain['title']]['values'][$value['title']]['points'] = $questionsTotalValue;

          if ($questionsTotal < 50) {

            $response[$domain['title']]['values'][$value['title']]['score'] = 'Level 1';
          }

          if ($questionsTotal >= 50 && $questionsTotal < 60) {

            $response[$domain['title']]['values'][$value['title']]['score'] = 'Level 2';
          }

          if ($questionsTotal >= 60 && $questionsTotal < 75) {

            $response[$domain['title']]['values'][$value['title']]['score'] = 'Level 3';
          }

          if ($questionsTotal >= 75 && $questionsTotal < 90) {

            $response[$domain['title']]['values'][$value['title']]['score'] = 'Level 4';
          }

          if ($questionsTotal >= 90) {

            $response[$domain['title']]['values'][$value['title']]['score'] = 'Level 5';
          }
        }

        $questionsTotal = $questionsTotalDomain * 100 / 50;

        $response[$domain['title']]['points'] = $questionsTotal;

        if ($questionsTotal < 50) {

          $response[$domain['title']]['score'] = 'Level 1';
        }

        if ($questionsTotal >= 50 && $questionsTotal < 60) {

          $response[$domain['title']]['score'] = 'Level 2';
        }

        if ($questionsTotal >= 60 && $questionsTotal < 75) {

          $response[$domain['title']]['score'] = 'Level 3';
        }

        if ($questionsTotal >= 75 && $questionsTotal < 90) {

          $response[$domain['title']]['score'] = 'Level 4';
        }

        if ($questionsTotal >= 90) {

          $response[$domain['title']]['score'] = 'Level 5';
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

    $arr = [];

    foreach ($users as $user) {

      $totalScore = 0;

      foreach ($this->quizQuestions['questions']['domains'] as $domain) {

        if (!isset($response[$domain['title']])) $response[$domain['title']] = ['score' => null, 'points' => 0, 'values' => []];

        $questionsTotalDomain = 0;

        foreach ($domain['values'] as $value) {

          if (!isset($response[$domain['title']]['values'][$value['title']])) $response[$domain['title']]['values'][$value['title']] = ['score' => null, 'points' => 0];

          $questionsTotalValue = 0;

          foreach ($value['questions'] as $question) {

            foreach ($question['answers'] as $answer) {

              if ($answer['user_id'] == $user) $questionsTotalDomain += $answer['answer']; //$answer['answer'] * 100 / ($value['title'] == 'Grammar' ? 20 : 30);

              if ($answer['user_id'] == $user) $questionsTotalValue += $answer['answer'] * 100 / ($value['title'] == 'Grammar' ? 20 : 30);

              if ($answer['user_id'] == $user) $totalScore += $answer['answer'];
            }
          }

          $questionsTotal = $questionsTotalValue;

          $response[$domain['title']]['values'][$value['title']]['points'] = $questionsTotalValue;

          if ($questionsTotal < 50) {

            $response[$domain['title']]['values'][$value['title']]['score'] = 'Level 1';
          }

          if ($questionsTotal >= 50 && $questionsTotal < 60) {

            $response[$domain['title']]['values'][$value['title']]['score'] = 'Level 2';
          }

          if ($questionsTotal >= 60 && $questionsTotal < 75) {

            $response[$domain['title']]['values'][$value['title']]['score'] = 'Level 3';
          }

          if ($questionsTotal >= 75 && $questionsTotal < 90) {

            $response[$domain['title']]['values'][$value['title']]['score'] = 'Level 4';
          }

          if ($questionsTotal >= 90) {

            $response[$domain['title']]['values'][$value['title']]['score'] = 'Level 5';
          }
        }

        $questionsTotal = $questionsTotalDomain * 100 / 50;

        $response[$domain['title']]['points'] = $questionsTotal;

        if ($questionsTotal < 50) {

          $response[$domain['title']]['score'] = 'Level 1';
        }

        if ($questionsTotal >= 50 && $questionsTotal < 60) {

          $response[$domain['title']]['score'] = 'Level 2';
        }

        if ($questionsTotal >= 60 && $questionsTotal < 75) {

          $response[$domain['title']]['score'] = 'Level 3';
        }

        if ($questionsTotal >= 75 && $questionsTotal < 90) {

          $response[$domain['title']]['score'] = 'Level 4';
        }

        if ($questionsTotal >= 90) {

          $response[$domain['title']]['score'] = 'Level 5';
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
