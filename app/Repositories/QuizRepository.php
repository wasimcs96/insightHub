<?php


namespace App\Repositories;

use App\Repositories\Interfaces\QuizRepositoryInterface;

use App\Models\Quiz;

use App\Services\ApiService;

class QuizRepository implements QuizRepositoryInterface
{

  public function userQuestionsAndAnswers($quiz, $user_id, $type)
  {

    $searchQuiz = $quiz->answers_referencing_quiz_id ? $quiz->answers_referencing_quiz_id : $quiz->id;

    $searchQuiz = Quiz::findOrFail($searchQuiz);

    $QA = Quiz::with(['domains' => function ($query) use ($user_id) {

      $query->with(['values' => function ($query) use ($user_id) {

        $query->with('valueAnswerValuation');

        $query->with(['questions.answer' => function ($query) use ($user_id) {

          $query->where('user_id', $user_id);
        }]);

        $query->withSum(['answers' => function ($query) use ($user_id) {

          $query->where('user_id', $user_id);
        }], 'answer');
      }]);
    }])->where('name', $searchQuiz->name)->first()->toArray();

    return $this->checkIsApiBased($quiz, $QA, $type);
  }

  public function userCareers($quiz, $user_id, $type, $jobZone)
  {

    $results = $this->userQuestionsAndAnswers($quiz, $user_id, $type);

    $data = ['start' => 1, 'end' => 5, 'job_zone' => $jobZone];

    foreach ($results['results']['result'] as $key => $value) {

      $data[$value['area']] = $value['score'];
    }

    $api = new ApiService(config('app.onet_api_endpoint'), 'interestprofiler/careers', $data);

    $api->setBasicAuth(config('app.onet_api_username'), config('app.onet_api_password'));

    $careers = $api->get();

    shuffle($careers['career']);

    return ['careers' => $careers];
  }

  public function userCareer($careerCode)
  {

    $api = new ApiService(config('app.onet_api_endpoint'), "careers/$careerCode/report");

    $api->setBasicAuth(config('app.onet_api_username'), config('app.onet_api_password'));

    $career = $api->get();

    return ['career' => $career];
  }

  public function checkIsApiBased($quiz, $questions, $type)
  {

    if ($quiz->api && ($type == 'results' || $type == 'careers')) {

      $answers = "";

      foreach ($this->getQuestionsOnly($questions) as $key => $value) {

        $answers .= $value['answer']['answer'] + 1;
      }

      $api = new ApiService(config('app.onet_api_endpoint'), 'interestprofiler/results', ['answers' => $answers]);

      $api->setBasicAuth(config('app.onet_api_username'), config('app.onet_api_password'));

      $results = $api->get();

      return ['results' => $results];
    }

    return ['questions' => $questions, 'questionsOnly' => $this->getQuestionsOnly($questions)];
  }

  private function getQuestionsOnly($questions)
  {

    $questionsOnly = [];

    foreach ($questions['domains'] as $domain) {

      foreach ($domain['values'] as $value) {

        foreach ($value['questions'] as $question) {

          $questionsOnly[] = $question;
        }
      }
    }

    usort($questionsOnly, function ($item1, $item2) {

      return $item2['order'] < $item1['order'];
    });

    return $questionsOnly;
  }
}
