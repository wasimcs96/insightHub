<?php

namespace App\Http\Controllers\Admin;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use App\Models\SurveyAnswer;
use App\Models\SurveyResult;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index(){
        $survey = Survey::paginate(10);
        return view('admin.survey.index',compact('survey'));
    }

    public function create()
    {
       
        return view('admin.survey.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',

            'title' => 'required|string|max:255',
            'questions' => 'required|array',
            'questions.*' => 'required|string|max:255',
            'question_types' => 'required|array',
            'question_types.*' => 'required|string|in:multiple,descriptive',
            'answers' => 'array',
            'answers.*' => 'array',
            'answers.*.*' => 'required_if:question_types.*,multiple|string|max:255'
        ]);

        $survey = Survey::create([
            'title' => $request->title,
            'description'=>$request->description

        
        ]);

        foreach ($request->questions as $index => $question) {
            if (!isset($request->question_types[$index])) {
                throw new \Exception('Question type not set for index ' . $index);
            }

            $surveyQuestion = SurveyQuestion::create([
                'question' => $question,
                'survey_id' => $survey->id,
                'type' => $request->question_types[$index],
            ]);

            if ($request->question_types[$index] == 'multiple' && isset($request->answers[$index]) && is_array($request->answers[$index])) {
                foreach ($request->answers[$index] as $answer) {
                    SurveyAnswer::create([
                        'answer' => $answer,
                        'survey_question_id' => $surveyQuestion->id,
                        'survey_id' => $survey->id,
                        'user_id' => auth()->id(),
                    ]);
                }
            }
        }

        return redirect()->route('survey.index')->with('success', 'Survey Created Successfully.');
    }

    public function edit($id)
    {
        $survey = Survey::with('questions.answers')->findOrFail($id);
        return view('admin.survey.edit', compact('survey'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:255',

            'title' => 'required|string|max:255',
            'questions.*' => 'required|string',
            'question_types.*' => 'required|in:multiple,descriptive',
            'answers.*.*' => 'sometimes|nullable|string',
        ]);

        $survey = Survey::findOrFail($id);
        $survey->title = $request->title;
        $survey->description = $request->description;

        $survey->save();

        // Deleting old questions and answers
        foreach ($survey->questions as $question) {
            $question->answers()->delete();
            $question->delete();
        }

        // Adding new questions and answers
        if (is_array($request->questions) && is_array($request->question_types)) {
            foreach ($request->questions as $index => $question) {
                if (!isset($request->question_types[$index])) {
                    throw new \Exception('Question type not set for index ' . $index);
                }

                $surveyQuestion = SurveyQuestion::create([
                    'question' => $question,
                    'survey_id' => $survey->id,
                    'type' => $request->question_types[$index],
                ]);

                if ($request->question_types[$index] == 'multiple' && isset($request->answers[$index])) {
                    foreach ($request->answers[$index] as $answer) {
                        SurveyAnswer::create([
                            'answer' => $answer,
                            'survey_question_id' => $surveyQuestion->id,
                            'survey_id' => $survey->id,
                            'user_id' => auth()->id(),

                        ]);
                    }
                }
            }
        }

        return redirect()->route('survey.index')->with('success', 'Survey Updated Successfully.');
    }

    // app/Http/Controllers/SurveyController.php

    public function destroy($id)
    {
        // Find the survey by ID or fail if not found
        $survey = Survey::with('questions.answers')->findOrFail($id);
    
        // Delete related answers
        foreach ($survey->questions as $question) {
            $question->answers()->delete();
        }
    
        // Delete the questions
        $survey->questions()->delete();
    
        // Finally, delete the survey
        $survey->delete();
    
        // Redirect back with a success message
        return redirect()->route('survey.index')->with('success', 'Survey Deleted Successfully.');
    }



    // SurveyController.php

// SurveyController.php

public function start($id)
{
    $survey = Survey::with('questions.answers')->findOrFail($id);

    return view('admin.survey.start', compact('survey'));
}


public function start_store(Request $request, $id)
{
    $survey = Survey::findOrFail($id);
    $user = auth()->user();

    $results = $request->get('question');

    if ($results) {
        foreach ($results as $questionId => $answer) {
            SurveyResult::create([
                'survey_question_id' => $questionId,
                'survey_id' => $survey->id,
                'answer_id'=>$answer->id,
                'user_id' => $user->id,
                'answer' => is_array($answer) ? implode(',', $answer) : $answer,
            ]);
        }
    }

    return redirect()->route('survey.index')->with('success', 'Survey submitted successfully.');
}


public function recordDetails($surveyId)
{
    // Fetch survey
    $survey = Survey::findOrFail($surveyId);
    $user = Auth::user();

    // Fetch survey results for the specified survey
    $surveyResults = SurveyResult::where('survey_id', $surveyId)
                                 ->with(['questions' ,'answers', 'user'])
                                 ->paginate(8);
    $uniqueUsers = $surveyResults->unique('user_id');
    return view('admin.survey.recordDetails', compact('survey','uniqueUsers', 'surveyResults'));
}

public function viewSurveyAnswers($surveyId)
{
    $survey = Survey::findOrFail($surveyId);

    // Fetch survey results for the specific user and survey
    $userSurveyResults = SurveyResult::where('survey_id', $surveyId)
                                 ->with(['questions' ,'answers', 'user'])
                                 ->paginate(8);

    return view('admin.survey.view', compact('userSurveyResults','survey'));
}



}       
