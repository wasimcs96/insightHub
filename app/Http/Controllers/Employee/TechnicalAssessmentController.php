<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\MasterTechnicalQuestion;
use App\Models\TechnicalQuestionUserResponse;
use App\Jobs\UpdateTechnicalAssessmentReport;
use App\Models\JobOpeningApplication;
use App\Models\Job;

use Illuminate\Http\Request;
use App\Helpers\MainHelper;

class TechnicalAssessmentController extends Controller
{

        public function index()
        {
            
        $job = Job::where('id',auth()->user()->position_id)->first();
            return view('employee.technicalAssessment.index', [
                'job' => $job,
            ]);
        }

    public function start($id)
    {
        $technicalAss = MasterTechnicalQuestion::where('job_id', (int)$id)->get();
      
        return view('employee.technicalAssessment.start', [
            'technicalAss' => $technicalAss,
            'job_id' => $id,
        ]);
    }

    public function store($id, Request $request)
    {
        // dd($request->all());
        $this->storeResponses($request, $id);
        $technicalQuestionIds  = MasterTechnicalQuestion::where('job_id',(int)$request->id)->pluck('id');
        $user = auth()->user();
        $user->tech_skill_score = $this->calculateScore($user->id, $technicalQuestionIds);
        $user->is_technical_assessment_completed = 1;
        $user->technical_assessment_completed = 1;
        $user->save();

        $this->triggerJobUpdate($user->id);

        return redirect()->route('employee.dashboard')
            ->with('success', 'Thank you! Assessment submitted successfully.');
    }

    public function JobApplicationTAStart($application_id, $id)
    {
        $technicalAss = MasterTechnicalQuestion::where('job_id', (int)$id)->get();

        return view('employee.technicalAssessment.start', [
            'technicalAss' => $technicalAss,
            'application_id' => $application_id,
            'job_id' => $id,
        ]);
    }

    public function JobApplicationTAStore($id, Request $request)
    {
        $this->storeResponses($request, $id);

        $jobApplication = JobOpeningApplication::find((int)$request->application_id);
        $technicalQuestionIds  = MasterTechnicalQuestion::where('job_id',(int)$request->id)->pluck('id');
        if ($jobApplication) {
            $jobApplication->technical_assessment_completed = 1;
            $jobApplication->tech_skill_score = $this->calculateScore(auth()->id(),$technicalQuestionIds);
            $jobApplication->status = 4;
            $jobApplication->save();
        }

        $this->triggerJobUpdate(auth()->id(), $jobApplication->job_opening_id);

        return redirect()->route('employee.dashboard.job-application')
            ->with('success', 'Thank you! Assessment submitted successfully.');
    }

    /**
     * Save technical assessment responses
     */
    private function storeResponses(Request $request, $jobId)
    {
        foreach ($request->input('question', []) as $questionId => $data) {
            $selectedOption = $data['answer'] ?? null;
            if (!$selectedOption) {
                continue;
            }

            $question = MasterTechnicalQuestion::find((int)$questionId);
            if (!$question) {
                continue;
            }

            $isCorrect = ($selectedOption == $question->correct_answer) ? 1 : 0;
            $mark = $isCorrect ? $question->score : 0;

            TechnicalQuestionUserResponse::updateOrCreate(
                [
                    'master_technical_question_id' => $questionId,
                    'user_id' => auth()->id(),
                ],
                [
                    'option_selected' => $selectedOption,
                    'is_correct' => $isCorrect,
                    'marks' => $mark,
                    'level' => $question->level,
                ]
            );
        }
    }

    /**
     * Calculate total technical skill score
     */
    private function calculateScore($userId,$technicalQuestionIds)
    {
        return TechnicalQuestionUserResponse::whereIn('master_technical_question_id',$technicalQuestionIds)->where('user_id', $userId)->sum('marks');
    }

    /**
     * Trigger post-assessment job update
     */
    private function triggerJobUpdate($userId, $jobOpeningId=null)
    {
        try {

            MainHelper::jobTriggerByType(
                $userId,
                'technical',
                config('helpers.panel_names')[env('DB_DATABASE')],
                $jobOpeningId
            );
        } catch (\Throwable $th) {
            \Log::error('Technical Assessment Job Trigger Error: ' . $th->getMessage());
        }
    }
}
