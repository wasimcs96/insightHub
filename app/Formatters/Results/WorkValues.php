<?php

namespace App\Formatters\Results;

use App\Repositories\Rest\AnalyticsRepository;


class WorkValues
{

  private $quizQuestions;

  private $quizDomain;

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

        if (!isset($response[$domain['title']])) $response[$domain['title']] = ['score' => null, 'points' => 0, 'values' => []];

        $questionsTotalDomain = 0;

        foreach ($domain['values'] as $value) {

          if (!isset($response[$domain['title']]['values'][$value['title']])) $response[$domain['title']]['values'][$value['title']] = ['score' => null, 'points' => 0];

          $questionsTotalValue = 0;

          foreach ($value['questions'] as $question) {

            foreach ($question['answers'] as $answer) {

              if ($answer['user_id'] == $user) $questionsTotalValue += $answer['answer'];

              if ($answer['user_id'] == $user) $questionsTotalDomain += $answer['answer'];
            }
          }

          $response[$domain['title']]['values'][$value['title']]['points'] = $questionsTotalValue;

          if ($questionsTotalValue >= $value['value_answer_valuation']['low'][0] && $questionsTotalValue <= $value['value_answer_valuation']['low'][1]) {

            $response[$domain['title']]['values'][$value['title']]['score'] = 'Low';
          }

          if ($questionsTotalValue >= $value['value_answer_valuation']['moderate'][0] && $questionsTotalValue <= $value['value_answer_valuation']['moderate'][1]) {

            $response[$domain['title']]['values'][$value['title']]['score'] = 'Moderate';
          }

          if ($questionsTotalValue >= $value['value_answer_valuation']['high'][0]) {

            $response[$domain['title']]['values'][$value['title']]['score'] = 'High';
          }
        }

        $response[$domain['title']]['points'] = $questionsTotalDomain;

        if ($questionsTotalDomain >= $domain['low'][0] && $questionsTotalDomain <= $domain['low'][1]) {

          $response[$domain['title']]['score'] = 'Low';
        }

        if ($questionsTotalDomain >= $domain['moderate'][0] && $questionsTotalDomain <= $domain['moderate'][1]) {

          $response[$domain['title']]['score'] = 'Moderate';
        }

        if ($questionsTotalDomain >= $domain['high'][0]) {

          $response[$domain['title']]['score'] = 'High';
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

        if (!isset($response[$domain['title']])) $response[$domain['title']] = ['score' => null, 'points' => 0, 'values' => []];

        $questionsTotalDomain = 0;

        foreach ($domain['values'] as $value) {

          if (!isset($response[$domain['title']]['values'][$value['title']])) $response[$domain['title']]['values'][$value['title']] = ['score' => null, 'points' => 0];

          $questionsTotalValue = 0;

          foreach ($value['questions'] as $question) {

            foreach ($question['answers'] as $answer) {

              if ($answer['user_id'] == $user) $questionsTotalValue += $answer['answer'];

              if ($answer['user_id'] == $user) $questionsTotalDomain += $answer['answer'];

              if ($answer['user_id'] == $user) $totalScore += $answer['answer'];
            }
          }

          $response[$domain['title']]['values'][$value['title']]['points'] = $questionsTotalValue;

          if ($questionsTotalValue >= $value['value_answer_valuation']['low'][0] && $questionsTotalValue <= $value['value_answer_valuation']['low'][1]) {

            $response[$domain['title']]['values'][$value['title']]['score'] = 'Low';
          }

          if ($questionsTotalValue >= $value['value_answer_valuation']['moderate'][0] && $questionsTotalValue <= $value['value_answer_valuation']['moderate'][1]) {

            $response[$domain['title']]['values'][$value['title']]['score'] = 'Moderate';
          }

          if ($questionsTotalValue >= $value['value_answer_valuation']['high'][0]) {

            $response[$domain['title']]['values'][$value['title']]['score'] = 'High';
          }
        }

        $response[$domain['title']]['points'] = $questionsTotalDomain;

        if ($questionsTotalDomain >= $domain['low'][0] && $questionsTotalDomain <= $domain['low'][1]) {

          $response[$domain['title']]['score'] = 'Low';
        }

        if ($questionsTotalDomain >= $domain['moderate'][0] && $questionsTotalDomain <= $domain['moderate'][1]) {

          $response[$domain['title']]['score'] = 'Moderate';
        }

        if ($questionsTotalDomain >= $domain['high'][0]) {

          $response[$domain['title']]['score'] = 'High';
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
