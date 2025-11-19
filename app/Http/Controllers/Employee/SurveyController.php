<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use App\Models\SurveyAnswer;
use App\Models\SurveyResult;
use Illuminate\Support\Facades\Auth;


class SurveyController extends Controller
{

    public function survey()
    {
        $survey = Survey::with(['questions.answers'])
            ->paginate(10);
    
        return view('employee.survey', compact('survey'));
    }

    public function start(Survey $survey)
    {
        return view('employee.start', compact('survey'));
    }

    public function store(Request $request, $surveyId)
    {
        $survey = Survey::findOrFail($surveyId);
        $user = auth()->user();

        $results = $request->get('question');

        if ($results) {
            foreach ($results as $questionId => $answerData) {
                $answerId = $answerData['answer_id'] ?? null;
                $answerText = $answerData['answer'] ?? null;

                SurveyResult::create([
                    'survey_question_id' => $questionId,
                    'survey_id' => $survey->id,
                    'user_id' => $user->id,
                    'answer_id' => $answerId,
                    'answer' => $answerText,
                ]);
            }
        }

        return redirect()->route('employee.survey')->with('success', 'Survey submitted successfully.');
    }

    


}
