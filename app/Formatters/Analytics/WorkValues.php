<?php

namespace App\Formatters\Analytics;

use App\Repositories\Rest\AnalyticsRepository;


class WorkValues {

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

        if(!$this->quizDomain && !isset($response[$domain['title']])) $response[$domain['title']] = ['id' => $domain['id'], 'totalTalents' => sizeof($users), 'results' => ['low' => 0, 'moderate' => 0, 'high' => 0]];

        $questionsTotalDomain = 0;

        foreach($domain['values'] as $value){

          if($this->quizDomain && !isset($response[$value['title']])) $response[$value['title']] = ['totalTalents' => sizeof($users), 'results' => ['low' => 0, 'moderate' => 0, 'high' => 0]];

          $questionsTotalValue = 0;

          foreach($value['questions'] as $question){

            foreach ($question['answers'] as $answer) {

              if($answer['user_id'] == $user) $questionsTotalValue += $answer['answer'];

              if($answer['user_id'] == $user) $questionsTotalDomain += $answer['answer'];

            }

          }

          if($questionsTotalValue >= $value['value_answer_valuation']['low'][0] && $questionsTotalValue <= $value['value_answer_valuation']['low'][1]){

            if($this->quizDomain) $response[$value['title']]['results']['low'] += 1;

          }

          if($questionsTotalValue >= $value['value_answer_valuation']['moderate'][0] && $questionsTotalValue <= $value['value_answer_valuation']['moderate'][1]){

            if($this->quizDomain) $response[$value['title']]['results']['moderate'] += 1;

          }

          if($questionsTotalValue >= $value['value_answer_valuation']['high'][0]){

            if($this->quizDomain) $response[$value['title']]['results']['high'] += 1;

          }

        }

        if($questionsTotalDomain >= $domain['low'][0] && $questionsTotalDomain <= $domain['low'][1]){

          if(!$this->quizDomain) $response[$domain['title']]['results']['low'] += 1;

        }

        if($questionsTotalDomain >= $domain['moderate'][0] && $questionsTotalDomain <= $domain['moderate'][1]){

          if(!$this->quizDomain) $response[$domain['title']]['results']['moderate'] += 1;

        }

        if($questionsTotalDomain >= $domain['high'][0]){

          if(!$this->quizDomain) $response[$domain['title']]['results']['high'] += 1;


        }

      }

    }

    return $response;

  }
}
