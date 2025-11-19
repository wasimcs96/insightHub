<?php

namespace App\Formatters\Analytics;

use App\Repositories\Rest\AnalyticsRepository;

class EnglishTest {

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

    $arr = [];

    foreach ($users as $user) {

      foreach ($this->quizQuestions['questions']['domains'] as $domain) {

        if(!$this->quizDomain && !isset($response[$domain['title']])) $response[$domain['title']] = ['id' => $domain['id'], 'totalTalents' => sizeof($users), 'results' => ['level1' => 0, 'level2' => 0, 'level3' => 0, 'level4' => 0, 'level5' => 0]];

        $questionsTotalDomain = 0;

        foreach($domain['values'] as $value){

          if($this->quizDomain && !isset($response[$value['title']])) $response[$value['title']] = ['totalTalents' => sizeof($users), 'results' => ['level1' => 0, 'level2' => 0, 'level3' => 0, 'level4' => 0, 'level5' => 0]];

          $questionsTotalValue = 0;

          foreach($value['questions'] as $question){

            foreach ($question['answers'] as $answer) {

              if($answer['user_id'] == $user) $questionsTotalDomain += $answer['answer'];//$answer['answer'] * 100 / ($value['title'] == 'Grammar' ? 20 : 30);

              if($answer['user_id'] == $user) $questionsTotalValue += $answer['answer'] * 100 / ($value['title'] == 'Grammar' ? 20 : 30);

            }

          }

          $questionsTotal = $questionsTotalValue;

          if($questionsTotal < 50){

            if($this->quizDomain) $response[$value['title']]['results']['level1'] += 1;

          }

          if($questionsTotal >= 50 && $questionsTotal < 60){

            if($this->quizDomain) $response[$value['title']]['results']['level2'] += 1;

          }

          if($questionsTotal >= 60 && $questionsTotal < 75){

            if($this->quizDomain) $response[$value['title']]['results']['level3'] += 1;

          }

          if($questionsTotal >= 75 && $questionsTotal < 90){

            if($this->quizDomain) $response[$value['title']]['results']['level4'] += 1;

          }

          if($questionsTotal >= 90){

            if($this->quizDomain) $response[$value['title']]['results']['level5'] += 1;

          }

        }

        $questionsTotal = $questionsTotalDomain * 100 / 50;

        if($questionsTotal < 50){

          if(!$this->quizDomain) $response[$domain['title']]['results']['level1'] += 1;

        }

        if($questionsTotal >= 50 && $questionsTotal < 60){

          if(!$this->quizDomain) $response[$domain['title']]['results']['level2'] += 1;

        }

        if($questionsTotal >= 60 && $questionsTotal < 75){

          if(!$this->quizDomain) $response[$domain['title']]['results']['level3'] += 1;

        }

        if($questionsTotal >= 75 && $questionsTotal < 90){

          if(!$this->quizDomain) $response[$domain['title']]['results']['level4'] += 1;

        }

        if($questionsTotal >= 90){

          if(!$this->quizDomain) $response[$domain['title']]['results']['level5'] += 1;

        }

      }

    }

    return $response;

  }
}
