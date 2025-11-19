<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Quiz;

use App\Http\Requests\QuizRequest;

use App\Http\Requests\CareersRequest;
use App;
use App\Jobs\AssessmentAlgoSubmit;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use App\Models\QuizDomainValueQuestion;
use App\Models\QuizDomainValueAnswer;
use App\Models\JobOpeningApplication;
use App\Models\JobOpening;
use App\Helpers\MainHelper;
use Carbon\Carbon;
use App\Jobs\UpdateOceanAssessmentReport;
use App\Jobs\UpdateRiasecAssessmentReport;
use App\Jobs\UpdateCognitiveAssessmentReport;
use App\Models\User;
use App\Models\UserQuestion;



class QuizController extends Controller
{

  private QuizRepositoryInterface $quizRepository;

  public function __construct(Request $request, QuizRepositoryInterface $quizRepository)
  {

    $this->quizRepository = $quizRepository;
  }

  public function index(Quiz $quiz, Request $request)
  {

    $questions = $this->quizRepository->userQuestionsAndAnswers($quiz, $request->get('user_id'), __FUNCTION__);

    // if ($request->get('timer')) {

    $valueAnswersCount = self::countValueAnswers($questions);

    $questions = array_merge($questions, ['valueAnswers' => $valueAnswersCount]);

    $questions = array_merge($questions, ['timer' => $request->get('timer')]);
    // }

    return view('quiz.' . $quiz->name . '.index', $questions);
  }


  public function intro(Quiz $quiz, Request $request)
  {

    // dd($request->all());
    $user = auth()->user();


    if ($quiz->name === 'cognitive-ability') {
        if (!$user->is_personality_motivation_completed && !$user->is_work_interest_completed) {
            return redirect('/dashboard')
                ->with('error', 'Please complete the Personality and Work Interest Assessments first.');
        }elseif (!$user->is_work_interest_completed) {
            return redirect('/dashboard')
                ->with('error', 'Please complete the Work Interest Assessment first.');
        }
    }

 
    if ($quiz->name === 'interest-riasec' && !$user->is_personality_motivation_completed ) {
        return redirect('/dashboard')
            ->with('error', 'Please complete the Personality Assessment first.');
    }

    return view('quiz.' . $quiz->name . '.intro', ['quiz' => $quiz]);
  }

  public function results(Quiz $quiz, Request $request)
  {
    $questions = $this->quizRepository->userQuestionsAndAnswers($quiz, $request->get('user_id'), __FUNCTION__);

    if ($quiz->timer) {

      $valueAnswersCount = self::countValueAnswers($questions);

      $questions = array_merge($questions, ['valueAnswers' => $valueAnswersCount]);
    }
    if ($quiz->name == "interest-riasec") {
      foreach ($questions["questions"]["domains"] as $key1 => $item) {
        foreach ($item["values"] as $key2 => $value) {
          $questions["questions"]["domains"][$key1]["values"][$key2]["title"] = __($value["title"]);
        }
      }
    }
    if ($quiz->name == "cognitive-ability") {
      $valueAnswersCount = self::countValueAnswers($questions);

      $questions = array_merge($questions, ['valueAnswers' => $valueAnswersCount]);

      $total_correct = QuizDomainValueAnswer::where('user_id', auth()->user()->id)->where('quiz_domain_value_question_id', '>', 376)->where('is_correct', 1)->count();
      $questions = array_merge($questions, ['total_correct' => $total_correct]);
      $total_not_attempted = QuizDomainValueAnswer::where('user_id', auth()->user()->id)->where('quiz_domain_value_question_id', '>', 376)->where('time_taken', 0)->where('option_selected', 0)->count();
      $questions = array_merge($questions, ['total_not_attempted' => $total_not_attempted]);
      $total_wrong = 50 - $total_correct - $total_not_attempted;
      $questions = array_merge($questions, ['total_wrong' => $total_wrong]);

      $total_is_anchor_wrong = QuizDomainValueAnswer::where('user_id', auth()->user()->id)->where('quiz_domain_value_question_id', '>', 376)->where('is_anchor_wrong', 1)->count();
      $questions = array_merge($questions, ['total_is_anchor_wrong' => $total_is_anchor_wrong]);
      $total_is_anchor_correct = 2 - $total_is_anchor_wrong;
      $questions = array_merge($questions, ['total_is_anchor_correct' => $total_is_anchor_correct]);

      // $total_time_taken = QuizDomainValueAnswer::where('user_id',auth()->user()->id)->where('quiz_domain_value_question_id', '>', 376)->sum('time_taken');
      // $questions = array_merge($questions, ['total_time_taken' => ($total_time_taken) / 60]);

      $single_data = QuizDomainValueAnswer::where('user_id', auth()->user()->id)->where('quiz_domain_value_question_id', '>', 376)->orderBy('created_at', 'desc')->first();
      $questions = array_merge($questions, ['time_at_which_assessment_was_submitted' => ($single_data->created_at)->addHours(8)->format('d M y g.i a')]);

      $user_id = auth()->user()->id;

      $results = QuizDomainValueAnswer::join('quiz_domain_value_questions', 'quiz_domain_value_answers.quiz_domain_value_question_id', '=', 'quiz_domain_value_questions.id')
        ->select('quiz_domain_value_questions.quiz_domain_value_id')
        ->selectRaw('SUM(CASE WHEN quiz_domain_value_answers.is_correct = 1 THEN 1 ELSE 0 END) as correct_count')
        ->selectRaw('SUM(CASE WHEN quiz_domain_value_answers.time_taken = 0 THEN 1 ELSE 0 END) as non_attempted_count')
        ->where('quiz_domain_value_answers.user_id', $user_id)
        ->where('quiz_domain_value_questions.quiz_domain_value_id', '>', 69)
        ->groupBy('quiz_domain_value_questions.quiz_domain_value_id')
        ->get();

      // Transform the results into the desired format
      $countResults = $results->mapWithKeys(function ($item) {
        if ($item->quiz_domain_value_id == 70 || $item->quiz_domain_value_id == 71) {
          return [
            $item->quiz_domain_value_id => [
              'correct' => $item->correct_count ? (int) $item->correct_count - 1 : (int) $item->correct_count,
              'wrong' => 13 - $item->correct_count - $item->non_attempted_count,
              'non_attempted' => (int) $item->non_attempted_count,
            ],
          ];
        } else {
          return [
            $item->quiz_domain_value_id => [
              'correct' => (int) $item->correct_count,
              'wrong' => 12 - $item->correct_count - $item->non_attempted_count,
              'non_attempted' => (int) $item->non_attempted_count,
            ],
          ];
        }
      });
      $questions = array_merge($questions, ['domain_results' => $countResults]);
    }

    return view('quiz.' . $quiz->name . '.results', $questions);
  }


  public function careers(Quiz $quiz, CareersRequest $request)
  {

    $careers = $this->quizRepository->userCareers($quiz, $request->get('user_id'), __FUNCTION__, $request->get('jobZone'));

    return view('quiz.' . $quiz->name . '.careers', $careers);
  }

  public function career(Quiz $quiz, $careerCode, Request $request)
  {

    $career = $this->quizRepository->userCareer($careerCode);

    return view('quiz.' . $quiz->name . '.career', $career);
  }

  public function store(Quiz $quiz, QuizRequest $request)
  {

    $name = '';
    if ($quiz->name == "work-values") {
      $name = 'work_values';
      auth()->user()->is_work_values_completed = 1;
      auth()->user()->save();
    }

    if ($quiz->name == "interest-riasec") {
      $name = 'work_interests';
      auth()->user()->is_work_interest_completed = 1;
      auth()->user()->save();
      if ((auth()->user()->role_name == 'candidate') && (auth()->user()->is_personality_motivation_completed == 1) && (auth()->user()->is_work_interest_completed == 1) && (auth()->user()->is_cognitive_ability_completed == 1)) {
        $jobApplications = JobOpeningApplication::where('user_id', auth()->user()->id)->get();

        foreach ($jobApplications as $jobApplication) {
          if ($jobApplication->status < 4) {
            $jobApplication->status = 4;
            $jobApplication->save();
            $activity = MainHelper::CreatejobApplicationLogs($jobApplication->user_id, $jobApplication->id, 'Candidate completed Work Interest assessment');
          }
        }
      }
    }

    if ($quiz->name == "five-factor") {
      $name = 'personality_and_motivation';
      auth()->user()->is_personality_motivation_completed = 1;
      auth()->user()->save();

      if ((auth()->user()->role_name == 'candidate') && (auth()->user()->is_personality_motivation_completed == 1) && (auth()->user()->is_work_interest_completed == 1) && (auth()->user()->is_cognitive_ability_completed == 1)) {
        $jobApplications = JobOpeningApplication::where('user_id', auth()->user()->id)->get();

        foreach ($jobApplications as $jobApplication) {
          if ($jobApplication->status < 4) {
            $jobApplication->status = 4;
            $jobApplication->save();
            $activity = MainHelper::CreatejobApplicationLogs($jobApplication->user_id, $jobApplication->id, 'Candidate completed Personality Motivation assessment');
          }
        }
      }   
    }

    if ($quiz->name == "employability") {
      $name = 'employability';
      auth()->user()->is_employability_completed = 1;
      auth()->user()->save();
    }

    if ($quiz->name == "onet-profiler") {
      $name = 'career_explorer';
      auth()->user()->is_work_interest_completed = 1;
      auth()->user()->save();
      
        }

    if ($quiz->name == "21-century-skills") {
      $name = 'future_of_work';

      auth()->user()->is_future_of_work_completed = 1;
      auth()->user()->save();
    }

    if ($quiz->name == "english-test") {
      $name = 'english_proficiency';
      auth()->user()->is_english_proficiency_completed = 1;
      auth()->user()->save();
    }

    // $response = Http::put('http://api-test-mynext.cxsanalytics.com/api/update-university-student-assessment/'.$request->get('user_id').'/?assessment_name='.$name.'');

    // $responseBody = $response->json();

    $submitType = $request->input('submit');

    $request->storeQuiz($request->get('user_id'));

    
    if ($quiz->name == "five-factor") {
      try {
        
        if (auth()->user()->role_name == 'candidate') {
          $jobApplications = JobOpeningApplication::where('user_id', auth()->user()->id)->get();
  
          foreach ($jobApplications as $jobApplication) {
            MainHelper::jobTriggerByType(auth()->user()->id,$quiz->name,config('helpers.panel_names')[env('DB_DATABASE')], $jobApplication->job_opening_id);
          }
        }
        else {
          MainHelper::jobTriggerByType(auth()->user()->id,$quiz->name,config('helpers.panel_names')[env('DB_DATABASE')]);
        }

      } catch (\Throwable $th) {
        \Log::error($th);
      } 
    }

    if ($quiz->name == "interest-riasec" || $quiz->name == "onet-profiler") {
      try {
        if (auth()->user()->role_name == 'candidate') {
          $jobApplications = JobOpeningApplication::where('user_id', auth()->user()->id)->get();
  
          foreach ($jobApplications as $jobApplication) {
            MainHelper::jobTriggerByType(auth()->user()->id,$quiz->name,config('helpers.panel_names')[env('DB_DATABASE')], $jobApplication->job_opening_id);
          }
        }
        else {
          MainHelper::jobTriggerByType(auth()->user()->id,$quiz->name,config('helpers.panel_names')[env('DB_DATABASE')]);
        }
         
       
      } catch (\Throwable $th) {
        \Log::error($th);
      }
    }

    return response()->json([
      'success' => true,
      'redirect' => $submitType == "submit_continue" ? config('app.remote_base_url') : ($quiz->timer ? '/quiz/' . $quiz->name : '/quiz/' . $quiz->name . '/results')
    ]);
  }

  public static function countValueAnswers($questions)
  {

    $response = [];

    foreach ($questions['questions']['domains'] as $domain) {

      foreach ($domain['values'] as  $value) {
        $response[$value['title']] = $value['answers_sum_answer'];
      }
    }

    return $response;
  }

  public function cognitiveAbilityAssessmentIntro(Request $request)
  {
   
    $userId = auth()->user()->id;
    $answersGiven = QuizDomainValueAnswer::where('user_id',$userId)->where('quiz_domain_value_question_id', '>', 376)->count();
    $isAnchorWrong = QuizDomainValueAnswer::where('user_id',$userId)->where('is_anchor_wrong', 1)->count();

    if ($answersGiven >= 50){
      return redirect()->route('results',['user_id' => $userId, 'quiz'=> 'cognitive-ability']);
    } elseif ($answersGiven < 50) {
    //   if($isAnchorWrong > 0){
    //     return view('quiz.cognitive-ability.not-eligible');
    //   }
    //   else
      if ($answersGiven == 49 || $answersGiven == 48 || $answersGiven == 47) {
        $range = range(377, 426);
        $existingNumbers = QuizDomainValueAnswer::where('user_id',$userId)->where('quiz_domain_value_question_id', '>', 376)->pluck('quiz_domain_value_question_id')->toArray();
        $missingNumbers = array_values(array_diff($range, $existingNumbers));

        $order = $missingNumbers[0] - 376;

        return redirect()->route('cognitive-ability-assessment',['question' => $order]);
      } elseif($answersGiven == 0) {
        return view('quiz.cognitive-ability.intro');
      } else {
        // $question = QuizDomainValueQuestion::where('quiz_domain_value_id', '>', 69)->where('order',$answersGiven + 1)->first();
        session(['question_no' => $answersGiven + 1]);
        return redirect()->route('cognitive-ability-assessment',['question' => $answersGiven + 1]);
      }
    }
    else {
      return view('quiz.cognitive-ability.intro');
    }
  }

  public function cognitiveAbilityAssessment(Request $request)
  {

    $userID = auth()->user()->id;
    $language = session()->get('locale', 'en');
    $is_english = $language == 'my' ? 0 : 1;

    if(!session('question_no') && !$request->question){
      session(['question_no' => 1]);
    } else {
      if($request->question){
        session(['question_no' => $request->question]);
      }
    }

    // $questions = QuizDomainValueQuestion::where('quiz_domain_value_id', '>', 69)->where('set_no',1)->where('is_english',$is_english)->get();
    $answersGiven = QuizDomainValueAnswer::where('user_id',$userID)->where('quiz_domain_value_question_id', '>', 376)->count();
     // dd($answersGiven);
    if(!empty($answersGiven)){
        return redirect()->route('results', ['user_id' => $userID, 'quiz' => 'cognitive-ability']);

    }else{
        $userQuestion=UserQuestion::where('user_id',$userID)->first();

        if(empty($userQuestion)){
            $questions = $this->generateNewQuestionSet($language);
           
            $questionIds = json_decode($questions[1], true);

        }else{
            $questionIds = json_decode($userQuestion->questions, true);
        }

        $questions = QuizDomainValueQuestion::whereIn('id',$questionIds)->orderby('id','asc')->get();
        // dd($questions);

        return view('quiz.cognitive-ability.index',compact(['questions','userID']));
    }

  }

  public function cognitiveAbilityAssessmentStore(Request $request)
  {
    // Debug request data
    \Log::info('Quiz Submission Data:', $request->all());

    // Extract request values
    $is_timer_completed = $request->is_timer_completed ?? 0;
    $userId = auth()->user()->id;
    $answers = $request->answers ?? []; // Get submitted answers
    $timeTaken = json_decode($request->time_taken, true) ?? []; // Convert JSON string to array

    // Fetch only the relevant quiz questions based on the submitted IDs to validate answers
    $questionIds = array_keys($timeTaken);
    $questions = QuizDomainValueQuestion::whereIn('id', $questionIds)->get();

    // Initialize an array to collect quiz answer data for batch insert/update
    $quizAnswers = [];

    // Iterate over each question and store the results
    foreach ($timeTaken as $questionId => $time) {
        $question = $questions->firstWhere('id', $questionId); // Retrieve the corresponding question
        if (!$question) continue; // Skip if question not found

        // Default values for unanswered questions
        $option_selected = $answers[$questionId] ?? 0;
        $is_correct = 0;
        $marks = 0;
        $is_anchor_wrong = 0;

        // Determine correctness & scoring
        if ($option_selected == $question->correct_answer) {
            $is_correct = 1;
            $difficultyLevel = (int) $question->level_of_difficulty;
            $marks = match ($difficultyLevel) {
                1 => 1,
                2 => 2,
                3 => 3,
                default => 0,
            };
        }

        // Handle anchor questions
        if ($question->is_anchor_question) {
            $marks = 0;
            if (!$is_correct) {
                $is_anchor_wrong = 1;
            }
        }

        // Prepare the answer data for batch insertion or update
        $quizAnswers[] = [
            'user_id' => $userId,
            'quiz_domain_value_question_id' => $questionId,
            'answer' => $marks,
            'time_taken' => $time,
            'option_selected' => $option_selected,
            'is_correct' => $is_correct,
            'level_of_difficulty' => $question->level_of_difficulty,
            'is_anchor_wrong' => $is_anchor_wrong,
            'language' => session()->get('locale', 'en'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    // Insert or update the quiz answers in a single query to improve performance
    if (!empty($quizAnswers)) {
        QuizDomainValueAnswer::upsert($quizAnswers, ['user_id', 'quiz_domain_value_question_id'], ['answer', 'time_taken', 'option_selected', 'is_correct', 'level_of_difficulty', 'is_anchor_wrong', 'language']);
   
         
        $user = auth()->user();
        $user->is_cognitive_ability_completed = 1;
        $user->save();
   
   
   
       try {
         MainHelper::jobTriggerByType(auth()->user()->id,'cognitive',config('helpers.panel_names')[env('DB_DATABASE')]);
       } catch (\Throwable $th) {
         \Log::error($th);
       }
   
      }



    // Mark quiz as completed (if required)
    // $user = auth()->user();
    // $user->is_cognitive_ability_completed = 1;
    // $user->save();

    // Redirect to results page
    return redirect()->route('results', ['quiz' => 'cognitive-ability']);
  }

  public function generateNewQuestionSet($language = 'en')
  {
      if ($language == 'my') {
          $allQuestions = QuizDomainValueQuestion::where('quiz_domain_value_id', '>', 69)->where('is_english', 0)->get();
      } else {
          $allQuestions = QuizDomainValueQuestion::where('quiz_domain_value_id', '>', 69)->where('set_no', '<', 11)->where('is_english', 1)->get();
      }

      $categories = range(70, 73);
      $levels = [1, 2, 3];

      $organizedQuestions = $this->organizeQuestions($allQuestions, $categories, $levels);
      // dd($organizedQuestions);
      try {
          $newQuestionSet = $this->generateRandomSet($organizedQuestions, $categories, $levels,$language);
      } catch (\Exception $e) {
          return response()->json([
              'error' => $e->getMessage(),
          ], 500);
      }

      return collect($newQuestionSet)->sortBy('order')->values();;
  }

  private function organizeQuestions($questions, $categories, $levels)
  {
      $organizedQuestions = [];

      foreach ($categories as $category) {
          foreach ($levels as $level) {
              $filteredQuestions = $questions->filter(function ($question) use ($category, $level) {
                  return $question->quiz_domain_value_id == $category && $question->level_of_difficulty == $level;
              });

              $organizedQuestions[$category][$level] = $filteredQuestions->values()->all();
          }
      }
      return $organizedQuestions;
  }

  private function generateRandomSet($questions, $categories, $levels,$language)
  {
      $randomSet = [];
      $totalMarks = 0;
      $is_english = 0;
      $authUser = auth()->user();
      if($language == 'en'){
          $is_english = 1;
      }else{
          $is_english = 0;

      }

      // First loop to generate random questions per category and level
      foreach ($categories as $category) {
          foreach ($levels as $level) {
              // Convert the array of questions to a collection and filter out anchor questions
              $levelQuestions = collect($questions[$category][$level])->filter(function ($question) {
                  return $question; // Exclude anchor questions
              });

              // Ensure there are always 4 questions selected
              $selectedQuestions = $levelQuestions->count() >= 4
                  ? $levelQuestions->random(4)->toArray()
                  : $levelQuestions->toArray(); // If less than 4, select all available questions.

              $randomSet = array_merge($randomSet, $selectedQuestions);
              $totalMarks += 4 * $level;
          }
      }

      // Handle categories 70 and 71
      $remainingQuestions70 = collect($questions[70])->flatten()->reject(function ($q) use ($randomSet) {
          return in_array($q, $randomSet);
      });

      $newQuestion70 = $remainingQuestions70->isNotEmpty() ? $remainingQuestions70->random() : null;

      $remainingQuestions71 = collect($questions[71])->flatten()->reject(function ($q) use ($randomSet) {
          return in_array($q, $randomSet);
      });

      $newQuestion71 = $remainingQuestions71->isNotEmpty() ? $remainingQuestions71->random() : null;

      if ($newQuestion70) {
          array_splice($randomSet, 0, 0, [$newQuestion70]);
      }

      if ($newQuestion71) {
          array_splice($randomSet, 13, 0, [$newQuestion71]);
      }

      // Remove duplicates: check and replace any repeated question
      $uniqueRandomSet = [];
      foreach ($randomSet as $question) {
          // Check if the question already exists in the unique set
          if (!in_array($question['id'], array_column($uniqueRandomSet, 'id'))) {
              $uniqueRandomSet[] = $question;
          } else {
              // Replace with a new question from the database (you can adjust this part based on how you fetch questions from DB)
              $newQuestion = QuizDomainValueQuestion::where('quiz_domain_value_id', '>', 69)->where('is_english', $is_english)->whereNotIn('id', array_column($uniqueRandomSet, 'id'))->inRandomOrder()->first();
              if ($newQuestion) {
                  $uniqueRandomSet[] = $newQuestion->toArray();
              }
          }
      }

      // Ensure the set contains 50 questions
      while (count($uniqueRandomSet) < 50) {
          // Fetch a random question from the DB if there are less than 50
          $newQuestion = QuizDomainValueQuestion::where('quiz_domain_value_id', '>', 69)->where('is_english', $is_english)->whereNotIn('id', array_column($uniqueRandomSet, 'id'))->inRandomOrder()->first();
          if ($newQuestion) {
              $uniqueRandomSet[] = $newQuestion->toArray();
          }
      }

      // Debug: Check the total number of questions selected
      if (count($uniqueRandomSet) != 50) {
          // Log for debugging if the count doesn't match 50
          Log::debug('Generated question set count: ' . count($uniqueRandomSet));
      }

      // Order questions
      for ($i = 0; $i < count($uniqueRandomSet); $i++) {
          $uniqueRandomSet[$i]['order'] = $i + 1;
      }

      $questionData = array_map(function ($question, $index) {
          return $question['id'];
      }, $uniqueRandomSet, array_keys($uniqueRandomSet));

      // Store question data for the user
      $userQuestion = UserQuestion::where('user_id', $authUser->id)->first();
      if ($userQuestion) {
          $userQuestion->update([
              'questions' => json_encode($questionData),
          ]);
      } else {
          $userQuestion = UserQuestion::create([
              'user_id' => $authUser->id,
              'questions' => json_encode($questionData),
          ]);
      }
      // dd($userQuestion);
      // $questionIds = json_decode($userQuestion->questions, true);
      // dd($questionIds);
      //     $questions = QuizDomainValueQuestion::whereIn('id',$questionIds)->orderby('id','asc')->get();
      return $userQuestion;
  }


  public function migrateCognitiveData(Request $request) {
    $answers = QuizDomainValueAnswer::where('user_id', '>', 5817)->where('quiz_domain_value_question_id',  '>', 376)->where('is_correct', 1)->get();

    foreach ($answers as $ans) {
      $ans->answer = (int) $ans->level_of_difficulty;
      $ans->save();
    }

    dd($answers->count());
  }

 public function cognitiveAbilityAssessmentDisplay(Request $request)
{
    $userID = auth()->user()->id;
    $language = session()->get('locale', 'en');
    $is_english = $language == 'my' ? 0 : 1;

        $questions = QuizDomainValueQuestion::where('id','>', 376)->where('is_english',1)->orderby('id','asc')->get();
    
    return view('quiz.cognitive-ability.questions-display', compact('questions', 'userID'));
}


}
