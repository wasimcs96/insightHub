<?php

namespace App\Formatters\Analytics;

use App\Repositories\Rest\AnalyticsRepository;

class FiveFactor {

  private $quizQuestions;

  private $quizDomain;

  public function __construct($quizQuestions, $quizDomain){

    $this->quizQuestions = $quizQuestions;

    $this->quizDomain = $quizDomain;

  }

  public static function format($quizQuestions, $quizDomain){

    return new static($quizQuestions, $quizDomain);

  }

  public function get(){

    $users = (new AnalyticsRepository)->extractUsers($this->quizQuestions);

    $response = [];

    foreach ($users as $user) {

      foreach ($this->quizQuestions['questions']['domains'] as $domain) {

        foreach($domain['values'] as $value){

          if($this->quizDomain && !isset($response[$value['title']])) $response[$value['title']] = ['totalTalents' => sizeof($users), 'results' => ['low' => 0, 'moderate' => 0, 'high' => 0]];

          $questionsTotal = 0;

          foreach($value['questions'] as $question){

            foreach ($question['answers'] as $answer) {

              if($answer['user_id'] == $user) $questionsTotal += $answer['answer'];

            }

          }

          if($questionsTotal <= 25){


            if($this->quizDomain) $response[$value['title']]['results']['low'] += 1;

          }

          if($questionsTotal > 25 && $questionsTotal <= 76){


            if($this->quizDomain) $response[$value['title']]['results']['moderate'] += 1;

          }

          if($questionsTotal > 76){


            if($this->quizDomain) $response[$value['title']]['results']['high'] += 1;

          }

        }

      }

    }

    return $response;

  }
}
