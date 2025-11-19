<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

use App\Repositories\Rest\Interfaces\AnalyticsRepositoryInterface;

use App\Models\Quiz;

use App\Models\QuizDomain;

use Illuminate\Validation\ValidationException;

use App\Http\Requests\AnalyticsRequest;

use App;

class AnalyticsController extends Controller
{
  private AnalyticsRepositoryInterface $analyticsRepository;

  public function __construct(Request $request, AnalyticsRepositoryInterface $analyticsRepository)
  {

    $this->analyticsRepository = $analyticsRepository;
  }
  public function index(Request $request)
  {

    Gate::authorize('see-analytics', $request->get('role'));

    return view('analytics.index', ['totalUsers' => 35, 'quizzes' => $this->analyticsRepository->userCompletedQuizzes()]);
  }

  public function show(Quiz $quiz, AnalyticsRequest $request)
  {

    Gate::authorize('see-analytics', $request->get('role'));

    return view('analytics.' . $quiz->name . '.index', $this->analyticsRepository->questionsAndAnswers($quiz, null, $request));
  }

  public function values(Quiz $quiz, QuizDomain $quizDomain, AnalyticsRequest $request)
  {

    Gate::authorize('see-analytics', $request->get('role'));

    if ($quizDomain->quiz_id != $quiz->id) abort(404);

    $questions = $this->analyticsRepository->questionsAndAnswers($quiz, $quizDomain, $request);

    $questions = array_merge($questions, ['quizDomain' => $quizDomain]);

    return view('analytics.' . $quiz->name . '.values', $questions);
  }

  public function quizzes(AnalyticsRequest $request)
  {

    return $this->analyticsRepository->quizzes($request);
  }

  public function quizzesCompletion($user_id)
  {

    return $this->analyticsRepository->quizzesCompletion($user_id);
  }

  public function analytics(Quiz $quiz, AnalyticsRequest $request, QuizDomain $quizDomain = null)
  {

    if ($quizDomain && $quizDomain->quiz_id != $quiz->id) throw ValidationException::withMessages(['Invalid Request' => 403]);

    return $this->analyticsRepository->getQuizAnalytics($quiz, $quizDomain, $request);
  }

  public function totals(Quiz $quiz, AnalyticsRequest $request)
  {

    if ($quiz->name != '21-century-skills') throw ValidationException::withMessages(['Invalid Request' => 403]);

    return $this->analyticsRepository->getQuizTotals($quiz, $request);
  }
}
