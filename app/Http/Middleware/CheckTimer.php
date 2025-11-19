<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;

use App\Repositories\Interfaces\QuizRepositoryInterface;

use App\Http\Controllers\QuizController;

use App\Models\QuizDomainValue;

use App\Models\QuizDomainValueQuestion;

use App\Models\QuizDomainValueAnswer;

class CheckTimer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    private QuizRepositoryInterface $quizRepository;

    public function __construct(Request $request, QuizRepositoryInterface $quizRepository){

       $this->quizRepository = $quizRepository;

    }


    public function handle(Request $request, Closure $next)
    {

      $quiz = $request->route('quiz');
      $user_id = $request->get('user_id');

      if($quiz->timer){

        $cacheKey = $quiz->name.$user_id;
        $cache = Cache::get($cacheKey);

        if ($request->path() == 'quiz/'.$quiz->name.'/intro'){

          if(!$cache){
            return $next($request);
          }

          else{
            return redirect('/quiz/'.$quiz->name);
          }

        }

        elseif ($request->path() == 'quiz/'.$quiz->name){

          if(!$cache){
            $duration = now()->addMinutes(30)->timestamp;
            Cache::forever($cacheKey, $duration);
            $request->merge(['timer' => $duration]);
            return $next($request);
          }

          else{

            if($cache - now()->timestamp <= 0){
              $questions = $this->quizRepository->userQuestionsAndAnswers($quiz, $user_id, 'index');
              foreach(QuizController::countValueAnswers($questions) as $key => $value){

                if(is_null($value)){

                  $quizDomainValue = QuizDomainValue::where(['title' => $key])->first();

                  foreach($quizDomainValue->questions as $question){
                    QuizDomainValueAnswer::insert(['answer' => 0, 'quiz_domain_value_question_id' => $question->id, 'user_id' => $user_id, 'created_at' => now(), 'updated_at' => now()]);
                  }

                }

              }
              return redirect('/quiz/'.$quiz->name.'/results');

            }

            else{
              $request->merge(['timer' => $cache]);
              return $next($request);
            }
          }
        }

        else{
            return $next($request);
        }
      }

      return $next($request);

    }
}
