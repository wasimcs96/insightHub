<?php


namespace App\Repositories\Rest;

use Illuminate\Support\Arr;
use App\Repositories\Rest\Interfaces\AnalyticsRepositoryInterface;
use App\Repositories\QuizRepository;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz;
use App\Formatters\Analytics\WorkValues;
use App\Formatters\Analytics\InterestRiasec;
use App\Formatters\Analytics\FiveFactor;
use App\Formatters\Analytics\Employability;
use App\Formatters\Analytics\TwentyFirstCentury;
use App\Formatters\Analytics\EnglishTest;
use App\Http\Requests\AnalyticsRequest;
use MongoDB\BSON\Binary;
use App\Models\User;
use App\Formatters\FormatResponse;

class AnalyticsRepository implements AnalyticsRepositoryInterface
{

  public function userCompletedQuizzes($users){ //returns how much  users fully completed of each particular assessment - answered all questions
    $result = DB::select(DB::raw('
    select quizzes.id, quizzes.name, quizzes.title, COALESCE(conv.completed, "0") as completed from quizzes left join (select questions.id, questions.title, questions.name, count(DISTINCT user_id) as completed from (
      select quizzes.id, quizzes.title, quizzes.name, count(quiz_domain_value_questions.id) as question_count from quiz_domain_value_questions
  inner join quiz_domain_values on quiz_domain_values.id = quiz_domain_value_questions.quiz_domain_value_id
  inner join quiz_domains on quiz_domains.id = quiz_domain_values.quiz_domain_id
  inner join quizzes on quiz_domains.quiz_id = quizzes.id GROUP BY quizzes.id, quizzes.title
  ) as questions, (
      select  quizzes.id, quizzes.title, count(quiz_domain_value_answers.answer) as answer_count, quiz_domain_value_answers.user_id from quiz_domain_value_answers
  inner join quiz_domain_value_questions on quiz_domain_value_questions.id = quiz_domain_value_answers.quiz_domain_value_question_id
  inner join quiz_domain_values on quiz_domain_values.id = quiz_domain_value_questions.quiz_domain_value_id
  inner join quiz_domains on  quiz_domains.id = quiz_domain_values.quiz_domain_id
  inner join quizzes on quizzes.id = quiz_domains.quiz_id where quiz_domain_value_answers.user_id IN ('."'" . implode("','", $users) . "'".')
  GROUP by quizzes.id, quizzes.title,quiz_domain_value_answers.user_id
  ) as userAnswers where questions.id = userAnswers.id and questions.question_count = userAnswers.answer_count GROUP BY questions.id)
  as conv on conv.id = quizzes.id
    '));

    return $result;
  }

  public function questionsAndAnswers($quiz, $quizDomain = null, AnalyticsRequest $request, $collection){

    $searchQuiz = $quiz->answers_referencing_quiz_id ? $quiz->answers_referencing_quiz_id : $quiz->id;

    $searchQuiz = Quiz::findOrFail($searchQuiz);

    $users = $this->getUserIds($collection);

    $QA = Quiz::with(['domains' => function($query) use($quizDomain, $users){

      if($quizDomain) $query->where(['id' => $quizDomain->id]);

      $query->with(['values' => function($query) use($users){

        $query->with('valueAnswerValuation');

        $query->with(['questions.answers' => function($query) use($users){

          $query->whereIn('user_id', $users);

        }]);

      }]);

    }])->where('name', $searchQuiz->name)->first()->toArray();

    return (new QuizRepository)->checkIsApiBased($quiz, $QA, 'results');

  }

  public function quizzesCompletion($user_id){ //returns how much particular user completed of each particular assessment - in percents

    $result = DB::table('quizzes as q')->selectRaw('q.title as quiz, q.name, CONCAT("'.config('app.url').'/images/", q.image) as image, q.description, ((

      SELECT COUNT(quiz_domain_value_answers.id) from quiz_domain_value_answers
      inner JOIN quiz_domain_value_questions ON quiz_domain_value_answers.quiz_domain_value_question_id = quiz_domain_value_questions.id
      inner JOIN quiz_domain_values ON quiz_domain_value_questions.quiz_domain_value_id = quiz_domain_values.id
      inner JOIN quiz_domains ON quiz_domain_values.quiz_domain_id = quiz_domains.id
      inner JOIN quizzes ON quiz_domains.quiz_id = IF(quizzes.api, quizzes.answers_referencing_quiz_id, quizzes.id)
      WHERE quizzes.id = IF(q.api, q.answers_referencing_quiz_id, q.id) AND quiz_domain_value_answers.user_id = "'.$user_id.'"

    ) / (

      SELECT COUNT(quiz_domain_value_questions.id) from quiz_domain_value_questions
      inner JOIN quiz_domain_values ON quiz_domain_value_questions.quiz_domain_value_id = quiz_domain_values.id
      inner JOIN quiz_domains ON quiz_domain_values.quiz_domain_id = quiz_domains.id
      inner JOIN quizzes ON quiz_domains.quiz_id = IF(quizzes.api, quizzes.answers_referencing_quiz_id, quizzes.id)
      WHERE quizzes.id = IF(q.api, q.answers_referencing_quiz_id, q.id)

    ) * 100) as completed')->get();

    return $result;

  }

  public function quizzes(AnalyticsRequest $request){

    $collection = $this->filterUsers($request)->get();

    $users = $this->getUserIds($collection);

    $results = ['totalUsers' => sizeof($users), 'quizzes' => $this->userCompletedQuizzes($users)];

    return FormatResponse::format($request, $results, $collection)->get();

  }

  public function getQuizAnalytics(Quiz $quiz, $quizDomain, AnalyticsRequest $request){

    $collection = $this->filterUsers($request)->get();

    $quizQuestions = $this->questionsAndAnswers($quiz, $quizDomain, $request, $collection);
    
    switch($quiz->name){

      case 'work-values' :

      return FormatResponse::format( // format response (facet, request)
        $request,
        WorkValues::format($quizQuestions, $quizDomain)->get(), //format results
        $collection)->get();

      break;

      case 'interest-riasec' :

      return FormatResponse::format( // format response (facet, request)
        $request,
        InterestRiasec::format($quizQuestions, $quizDomain)->get(), //format results
        $collection)->get();

      break;

      case 'five-factor' :

      return FormatResponse::format( // format response (facet, request)
        $request,
        FiveFactor::format($quizQuestions, $quizDomain)->get(), //format results
        $collection)->get();

      break;

      case 'employability' :

      return FormatResponse::format( // format response (facet, request)
        $request,
        Employability::format($quizQuestions, $quizDomain)->get(), //format results
        $collection)->get();

      break;

      case '21-century-skills' :

      return FormatResponse::format( // format response (facet, request)
        $request,
        TwentyFirstCentury::format($quizQuestions, $quizDomain)->get(), //format results
        $collection)->get();

      break;

      case 'english-test' :        

      return FormatResponse::format( // format response (facet, request)
        $request,
        EnglishTest::format($quizQuestions, $quizDomain)->get(), //format results
        $collection)->get();

      break;

    }

  }

  public function getQuizTotals(Quiz $quiz, AnalyticsRequest $request){

    $collection = $this->filterUsers($request)->get();

    $quizQuestions = $this->questionsAndAnswers($quiz, null, $request, $collection);

    switch($quiz->name){

      case '21-century-skills' :

      return FormatResponse::format( // format response (facet, request)
        $request,
        TwentyFirstCentury::format($quizQuestions, null)->getTotals(), //format results
        $collection)->get();

      break;

    }

  }


  public function extractUsers($questions) { //extracts unique users from our DB

    $users = [];

    foreach ($questions['questions']['domains'] as $domain) {

      foreach($domain['values'] as $value){

        foreach($value['questions'] as $question){

          foreach ($question['answers'] as $answer) {

            if(!in_array($answer['user_id'], $users)) $users[] = $answer['user_id'];

          }

        }

      }

    }

    return $users;

  }

  public function getUserIds($collection) { //extracts unique user IDs from collection

    return $collection->map(function ($item, $key){

        return $this->mongoBinaryToUuid($item['user_id']);

    })->all();

  }

  public function filterUsers($request){ //filter users from remote DB by forwarded params

    $result = DB::connection('mongodb')->table('core_model_onboardform')->select('*');
    if($request->input('insti_name')) $result->whereIn('insti_name', explode(',', $request->input('insti_name')));
    if($request->input('campus')) $result->whereIn('campus', explode(',', $request->input('campus')));
    if($request->input('faculty')) $result->whereIn('faculty', explode(',', $request->input('faculty')));
    if($request->input('study_program')) $result->whereIn('study_program', explode(',', $request->input('study_program')));
    if($request->input('year_of_study')) $result->whereIn('curr_study_year', explode(',', $request->input('year_of_study')));
    if($request->input('scope_of_study')) $result->whereIn('scope', explode(',', $request->input('scope_of_study')));
    // if($request->input('year_of_register')) $result->whereRaw(["univ_enroll_date" => ['$eq' => "2019-04-30"]]);

    return $result;

  }

  public function mongoBinaryToUuid($uuid)
  {
    $hex = bin2hex($uuid->getData());

    return preg_replace('/([0-9a-f]{8})([0-9a-f]{4})([0-9a-f]{4})([0-9a-f]{4})([0-9a-f]{12})/', '$1-$2-$3-$4-$5', $hex);
  }
}
