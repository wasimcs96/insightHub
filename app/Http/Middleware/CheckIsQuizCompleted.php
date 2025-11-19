<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Quiz;

use Illuminate\Support\Facades\Route;

use App\Repositories\Interfaces\QuizRepositoryInterface;

use App\Http\Controllers\QuizController;

class CheckIsQuizCompleted
{

    private QuizRepositoryInterface $quizRepository;

    public function __construct(Request $request, QuizRepositoryInterface $quizRepository){

       $this->quizRepository = $quizRepository;

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

      
        $routeName = Route::currentRouteName();

        $quiz = $request->route('quiz');

        $quiz_id = $quiz->answers_referencing_quiz_id ? $quiz->answers_referencing_quiz_id : $quiz->id;

        $user_id = $request->get('user_id');
        
        if ($quiz->name == 'cognitive-ability'){
          $totalQuizQuestions = 50;
        } else {
          $totalQuizQuestions = DB::table('quizzes as q')->selectRaw('COUNT(qdvq.id) as totalQuizQuestions')
          ->leftJoin('quiz_domains as qd', 'qd.quiz_id', '=', 'q.id')
          ->leftJoin('quiz_domain_values as qdv', 'qdv.quiz_domain_id', '=', 'qd.id')
          ->leftJoin('quiz_domain_value_questions as qdvq', 'qdvq.quiz_domain_value_id', '=', 'qdv.id')
          ->where(['q.id' => $quiz_id])->first()->totalQuizQuestions;
        }
        

        $result = DB::table('quizzes as q')->selectRaw('q.id, q.title, qdva.id as answer_id')
        ->leftJoin('quiz_domains as qd', 'qd.quiz_id', '=', 'q.id')
        ->leftJoin('quiz_domain_values as qdv', 'qdv.quiz_domain_id', '=', 'qd.id')
        ->leftJoin('quiz_domain_value_questions as qdvq', 'qdvq.quiz_domain_value_id', '=', 'qdv.id')
        ->leftJoin('quiz_domain_value_answers as qdva', 'qdva.quiz_domain_value_question_id', '=', 'qdvq.id')
        ->where(['q.id' => $quiz_id, 'qdva.user_id' => $user_id])->get();
        
        if(in_array($routeName, ['index', 'store'])){
          
          if(!$result->isEmpty() && sizeof($result) == $totalQuizQuestions){
            
            return redirect('/quiz/'.$quiz->name.'/results');

          }else{

            return $next($request);

          }

        }else{
          if($routeName == 'intro' && sizeof($result) == 0) return $next($request);

          elseif($routeName == 'intro' && sizeof($result) == $totalQuizQuestions) return redirect('/quiz/'.$quiz->name.'/results');

          elseif($result->isEmpty() || sizeof($result) < $totalQuizQuestions){
            if($quiz->name == 'cognitive-ability'){
              session(['from_quiz_is_completed_middleware' => 1]);
              return redirect('/quiz/cognitive-ability-assessment');
            } else {
              return redirect('/quiz/'.$quiz->name);
            }

          }else{

            if($quiz->timer){

              $questions = $this->quizRepository->userQuestionsAndAnswers($quiz, $user_id, 'index');

              foreach(QuizController::countValueAnswers($questions) as $key => $value){

                if(is_null($value)){

                  if($quiz->name == 'cognitive-ability'){
                    return redirect('/quiz/cognitive-ability-assessment');
                  } else {
                    return redirect('/quiz/'.$quiz->name);
                  }

                }

              }

              return $next($request);

            }

            return $next($request);

          }


        }

    }

}
