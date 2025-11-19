<?php

namespace App\Repositories\Rest\Results;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Results\ResultsRequest;
use App\Repositories\Rest\Interfaces\AnalyticsRepositoryInterface;
use App\Repositories\QuizRepository;
use App\Models\Quiz;
use App\Models\User;
use App\Formatters\Results\WorkValues;
use App\Formatters\Results\InterestRiasec;
use App\Formatters\Results\FiveFactor;
use App\Formatters\Results\Employability;
use App\Formatters\Results\TwentyFirstCentury;
use App\Formatters\Results\EnglishTest;
use App\Formatters\FormatResponse;
use Illuminate\Support\Facades\Response;

class ResultsRepository
{

  private AnalyticsRepositoryInterface $analyticsRepository;

  public function __construct(AnalyticsRepositoryInterface $analyticsRepository)
  {

    $this->analyticsRepository = $analyticsRepository;
  }

  public function allResults(ResultsRequest $request)
  {

    $collection = $this->filterUsers($request);

    $users = $collection->map(function ($item, $key) {
      return ['id' => $this->analyticsRepository->mongoBinaryToUuid($item['user_id']), 'name' => $item['display_name'], 'cgpa' => $item['grade']];
    });

    $results = [];

    foreach ($users as $user) {

      $userResults = (array)$this->userResults($user['id']);

      $userResults['interestRiasec'] = $userResults['interestRiasec'] ? explode(",", $userResults['interestRiasec']) : NULL;

      $results[] = array_merge($user, $userResults);
    }

    $results = array_merge($collection->toArray(), array("data" => $results));

    return FormatResponse::format($request, $results, $collection)->get();
  }

  public function totals(Quiz $quiz, $user_id)
  {

    $quizQuestions = $this->questionsAndAnswers($quiz, $user_id);

    switch ($quiz->name) {

      case 'work-values':

        return WorkValues::format($quizQuestions)->get();

        break;

      case 'interest-riasec':

        return InterestRiasec::format($quizQuestions)->get();

        break;

      case 'five-factor':

        return FiveFactor::format($quizQuestions)->get();

        break;

      case 'employability':

        return Employability::format($quizQuestions)->get();

        break;

      case '21-century-skills':

        return TwentyFirstCentury::format($quizQuestions)->get();

        break;

      case 'english-test':

        return EnglishTest::format($quizQuestions)->get();

        break;
    }
  }

  public function totalsForPipelines(Quiz $quiz, $user_id)
  {

    $quizWorkValues = Quiz::where('name', 'work-values')->first();
    $quizWorkInterest = Quiz::where('name', 'interest-riasec')->first();
    $quizFiveFactor = Quiz::where('name', 'five-factor')->first();
    $quizEmployability = Quiz::where('name', 'employability')->first();
    $quizFutureOfWork = Quiz::where('name', '21-century-skills')->first();
    $quizEnglishTest = Quiz::where('name', 'english-test')->first();


    $quizQuestionsWorkValues = $this->questionsAndAnswers($quizWorkValues, $user_id);
    $quizQuestionsWorkInterest = $this->questionsAndAnswers($quizWorkInterest, $user_id);
    $quizQuestionsFiveFactor = $this->questionsAndAnswers($quizFiveFactor, $user_id);
    $quizQuestionsEmployability = $this->questionsAndAnswers($quizEmployability, $user_id);
    $quizQuestionsFutureOfWork = $this->questionsAndAnswers($quizFutureOfWork, $user_id);
    $quizQuestionsEnglishTest = $this->questionsAndAnswers($quizEnglishTest, $user_id);



    $result = [
      'work-values' => WorkValues::format($quizQuestionsWorkValues)->pipeLinesForAnalytical(),
      'interest-riasec' => InterestRiasec::format($quizQuestionsWorkInterest)->pipeLinesForAnalytical(),
      'five-factor' => FiveFactor::format($quizQuestionsFiveFactor)->pipeLinesForAnalytical(),
      'employability' => Employability::format($quizQuestionsEmployability)->pipeLinesForAnalytical(),
      '21-century-skills' => TwentyFirstCentury::format($quizQuestionsFutureOfWork)->pipeLinesForAnalytical(),
      'english-test' => EnglishTest::format($quizQuestionsEnglishTest)->pipeLinesForAnalytical()
    ];

    return $result;
  }


  public function questionsAndAnswers($quiz, $user_id)
  {

    $searchQuiz = Quiz::findOrFail($quiz->id);

    $QA = Quiz::with(['domains' => function ($query) use ($user_id) {

      $query->with(['values' => function ($query) use ($user_id) {

        $query->with('valueAnswerValuation');

        $query->with(['questions.answers' => function ($query) use ($user_id) {

          $query->where('user_id', $user_id);
        }]);
      }]);
    }])->where('name', $searchQuiz->name)->first()->toArray();

    return (new QuizRepository)->checkIsApiBased($quiz, $QA, 'results');
  }

  public function userResults($user_id)
  {

    $result = DB::select("SELECT op.careerAlignment,g.motivationLevel,e.employability, f.futureOfWork, en.englishTest, GROUP_CONCAT(i.title) as interestRiasec
      FROM
      (SELECT CASE
          WHEN SUM(qdva.answer) * 100 / 240 < 33 THEN 'Low'
          WHEN SUM(qdva.answer) * 100 / 240 >= 33 AND SUM(qdva.answer) * 100 / 240 <= 67 THEN 'Moderate'
          WHEN SUM(qdva.answer) * 100 / 240 > 67 THEN 'High'
          ELSE NULL
      END AS motivationLevel from quiz_domain_value_answers as qdva
      LEFT JOIN quiz_domain_value_questions as qdvq ON qdvq.id = qdva.quiz_domain_value_question_id
      LEFT JOIN quiz_domain_values as qdv ON qdv.id = qdvq.quiz_domain_value_id
      LEFT JOIN quiz_domains AS qd ON qd.id = qdv.quiz_domain_id
      LEFT JOIN quizzes AS q ON q.id = qd.quiz_id
      WHERE q.name = 'five-factor' AND user_id = '$user_id') as g,
      (SELECT CASE
          WHEN SUM(qdva.answer) * 100 / 240 < 33 THEN 'Low'
          WHEN SUM(qdva.answer) * 100 / 240 >= 33 AND SUM(qdva.answer) * 100 / 240 <= 67 THEN 'Moderate'
          WHEN SUM(qdva.answer) * 100 / 240 > 67 THEN 'High'
          ELSE NULL
      END AS careerAlignment from quiz_domain_value_answers as qdva
      LEFT JOIN quiz_domain_value_questions as qdvq ON qdvq.id = qdva.quiz_domain_value_question_id
      LEFT JOIN quiz_domain_values as qdv ON qdv.id = qdvq.quiz_domain_value_id
      LEFT JOIN quiz_domains AS qd ON qd.id = qdv.quiz_domain_id
      LEFT JOIN quizzes AS q ON q.id = qd.quiz_id
      WHERE q.name = 'work-values' AND user_id = '$user_id') as op,
      (SELECT CASE
          WHEN SUM(qdva.answer) * 100 / 240 < 33 THEN 'Low'
          WHEN SUM(qdva.answer) * 100 / 240 >= 33 AND SUM(qdva.answer) * 100 / 240 <= 67 THEN 'Moderate'
          WHEN SUM(qdva.answer) * 100 / 240 > 67 THEN 'High'
          ELSE NULL
      END AS employability from quiz_domain_value_answers as qdva
      LEFT JOIN quiz_domain_value_questions as qdvq ON qdvq.id = qdva.quiz_domain_value_question_id
      LEFT JOIN quiz_domain_values as qdv ON qdv.id = qdvq.quiz_domain_value_id
      LEFT JOIN quiz_domains AS qd ON qd.id = qdv.quiz_domain_id
      LEFT JOIN quizzes AS q ON q.id = qd.quiz_id
      WHERE q.name = 'employability' AND user_id = '$user_id') as e,
      (SELECT CASE
          WHEN SUM(qdva.answer) * 100 / 320 < 33 THEN 'Low'
          WHEN SUM(qdva.answer) * 100 / 320 >= 33 AND SUM(qdva.answer) * 100 / 320 <= 67 THEN 'Moderate'
          WHEN SUM(qdva.answer) * 100 / 240 > 67 THEN 'High'
          ELSE NULL
      END AS futureOfWork from quiz_domain_value_answers as qdva
      LEFT JOIN quiz_domain_value_questions as qdvq ON qdvq.id = qdva.quiz_domain_value_question_id
      LEFT JOIN quiz_domain_values as qdv ON qdv.id = qdvq.quiz_domain_value_id
      LEFT JOIN quiz_domains AS qd ON qd.id = qdv.quiz_domain_id
      LEFT JOIN quizzes AS q ON q.id = qd.quiz_id
      WHERE q.name = '21-century-skills' AND user_id = '$user_id') as f,
      (SELECT CASE
          WHEN SUM(qdva.answer) * 100 / 20 < 50 THEN 'Level 1'
          WHEN SUM(qdva.answer) * 100 / 20 >= 50 AND SUM(qdva.answer) * 100 / 20 < 60 THEN 'Level 2'
         	WHEN SUM(qdva.answer) * 100 / 20 >= 60 AND SUM(qdva.answer) * 100 / 20 < 75 THEN 'Level 3'
         	WHEN SUM(qdva.answer) * 100 / 20 >= 75 AND SUM(qdva.answer) * 100 / 20 < 90 THEN 'Level 4'
          WHEN SUM(qdva.answer) * 100 / 20 >= 90 THEN 'Level 5'
          ELSE NULL
      END AS englishTest from quiz_domain_value_answers as qdva
      LEFT JOIN quiz_domain_value_questions as qdvq ON qdvq.id = qdva.quiz_domain_value_question_id
      LEFT JOIN quiz_domain_values as qdv ON qdv.id = qdvq.quiz_domain_value_id AND qdv.title = 'Grammar'
      LEFT JOIN quiz_domains AS qd ON qd.id = qdv.quiz_domain_id
      LEFT JOIN quizzes AS q ON q.id = qd.quiz_id
      WHERE q.name = 'english-test' AND user_id = '$user_id') as en,
      (SELECT qdv.title, SUM(qdva.answer) as total from quiz_domain_value_answers as qdva
      LEFT JOIN quiz_domain_value_questions as qdvq ON qdvq.id = qdva.quiz_domain_value_question_id
      LEFT JOIN quiz_domain_values as qdv ON qdv.id = qdvq.quiz_domain_value_id
      LEFT JOIN quiz_domains AS qd ON qd.id = qdv.quiz_domain_id
      LEFT JOIN quizzes AS q ON q.id = qd.quiz_id
      WHERE q.name = 'interest-riasec' AND user_id = '$user_id' group by qdv.title order by total desc LIMIT 3) AS i");

    return $result[0];
  }

  public function filterUsers($request)
  { //filter users from remote DB by forwarded params

    $offset = $request->input('offset') ? $request->input('offset') : 0;

    $limit = $request->input('per_page') ? $request->input('per_page') : 10;

    $result = DB::connection('mongodb')->table('core_model_onboardform')->whereNotNull('campus')->whereNotNull('faculty')->whereNotNull('study_program')->whereNotNull('scope')->whereNotNull('curr_study_year')->whereIn('talent_status', ['studying', 'internship'])->select('*');

    if ($request->input('display_name')) $result->where('display_name', 'like', '%' . str_replace('+', '%', $request->input('display_name')) . '%');

    if ($request->input('insti_name')) $result->whereIn('insti_name', explode(',', $request->input('insti_name')));

    if ($request->input('organization_id')) $result->whereIn('organization_id', explode(',', $request->input('organization_id')));

    if ($request->input('campus')) $result->whereIn('campus', explode(',', $request->input('campus')));

    if ($request->input('faculty')) $result->whereIn('faculty', explode(',', $request->input('faculty')));

    if ($request->input('study_program')) $result->whereIn('study_program', explode(',', $request->input('study_program')));

    if ($request->input('curr_study_year')) $result->whereIn('curr_study_year', explode(',', $request->input('curr_study_year')));

    if ($request->input('gender')) $result->whereIn('gender', explode(',', $request->input('gender')));

    if ($request->input('scope')) $result->whereIn('scope', explode(',', $request->input('scope')));

    //$result = $result->skip($offset)->take($limit);

    $isDownload = $request->input('is_download') ? $request->input('is_download') : 0;

    if ($isDownload) {
      return $result->get();
    } else {
      return $result->paginate($limit);
    }

    return $result->paginate($limit);
  }
}
