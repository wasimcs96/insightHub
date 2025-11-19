<?php

namespace App\Formatters\Analytics;

use App\Repositories\Rest\AnalyticsRepository;

class InterestRiasec {

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

    $newArr = ['totalTalents' => sizeof($users)];

    $response = [];

    foreach ($users as $user) {

      foreach ($this->quizQuestions['questions']['domains'] as $domain) {

        foreach($domain['values'] as $value){

          $newArr[$value['title']] = ['top' => 0, 'topThree' => 0];

          $questionsTotal = 0;

          foreach($value['questions'] as $question){

            foreach ($question['answers'] as $answer) {

              if($answer['user_id'] == $user) $questionsTotal += $answer['answer'];

            }

          }

          $response[$user][] = ['value' => $questionsTotal, 'label' => $value['title'], 'color' => $value['color']];

        }

      }

    }



    foreach($response as $key => $value){

      usort($response[$key], fn($a, $b) => $b['value'] - $a['value'] );

    }

    foreach($response as $key => $value) {

      $newArr[$value[0]['label']]['top'] += 1;

      $newArr[$value[1]['label']]['topThree'] += 1;
      $newArr[$value[2]['label']]['topThree'] += 1;

    }


    return $newArr;

  }
}
