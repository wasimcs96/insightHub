<?php

namespace App\Http\Controllers;

use App\Helpers\AssessmentHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Job;
use App\Models\SkillReview;
use App\Models\SkillReviewDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class SkillController extends Controller
{
    public function skillStepOne()
    {
        $departments = Department::where('status', 1)->get();
        $employees = User::whereNotNull('department_id')
            ->whereNotNull('position_id')
            ->get();
        return view('admin.skill-competency.index', compact('departments', 'employees'));
    }

    // Get users by department method
    public function getUsersByDepartment($department)
{
    $validPositionIds = Job::pluck('id')->toArray();
    $managerId = auth()->user()->id;

    // Get users who have not been rated by the current manager and have not completed their skill assessments
    $users = User::where('department_id', $department)
        ->whereIn('position_id', $validPositionIds)
        ->where('is_cognitive_ability_completed', 1)
        ->where('is_personality_motivation_completed', 1)
        ->where('is_work_interest_completed', 1)
        ->whereDoesntHave('reviews', function ($query) {
            $query->where('type', 'skill');
        })
        ->get();

    return response()->json(['users' => $users]);
}



    // Step two method
    public function skillStepTwo($id)
{
    if (!$id) {
        return back();
    }

    // Retrieve user data
    $user = AssessmentHelper::getUserData($id);
    if (!$user) {
        return back();
    }
    
    // Get the position_id of the user
    $userPositionId = $user['position_id'];

    // Retrieve the latest skill review for the user
    $lastSoftSkillReview = SkillReview::where('user_id', $id)
        ->orderBy('created_at', 'desc')
        ->first();
    
    $reviewDate = $lastSoftSkillReview ? $lastSoftSkillReview->review_date : null;
    $currentDate = now();
    if($lastSoftSkillReview){
    if ($lastSoftSkillReview->position_id === $userPositionId) {
        // Redirect to stepThreeGet if the position_id matches
        return redirect()->route('admin.skill-competencies.stepThreeGet', ['id' => $id]);
    }
    // Check if a review exists and if it's within the last year
    if ($reviewDate && $currentDate->diffInYears($reviewDate) <= 1) {
        // Check if the skill review's position_id matches the user's position_id
        if ($lastSoftSkillReview->position_id == $userPositionId) {
            return redirect()->route('admin.skill-competencies.Get', ['id' => $id]);
        }
    }
}

    return redirect()->route('admin.skill-competencies.stepThreeGet', $id);
}

    // Step three get method
    public function stepThreeGet($id)
    {
        $user = AssessmentHelper::getUserData($id);
        if (!$user) {
            return back();
        }
        $department = Department::find($user['department_id']);
        $softSkills = AssessmentHelper::getSoftSkills($id);

        $data['users'][] = array_merge($user, ['soft_skills' => $softSkills]);
     
        return view('admin.skill-competency.skill-review', compact('data', 'department', 'id'));
    }

    // Step three method
    public function skillStepThree($id)
{
    // Retrieve user data
    $user = AssessmentHelper::getUserData($id);
    if (!$user) {
        return back();
    }
    // Check if skill and competency already created
    $skillCompetencyExists = SkillReview::where('user_id', $id)->where('type', 'skill')->exists();

    // If skill and competency exist, redirect to another route
    if ($skillCompetencyExists) {
        return redirect()->route('admin.skill-competencies.Get', $id);
    }

    // Retrieve department data
    $department = Department::find($user['department_id']);
    $data['users'][] = $user;

    // Render the view
    return view('admin.skill-competency.step_3', compact('data', 'department', 'id'));
}

    // Update review method
    public function UpdateReview(Request $request)
    {
        return redirect()->route('admin.skill-competencies.stepFour');
    }

    // Step four method
    public function skillStepFour(Request $request)
    {
        $messages = [
            'department_id.required' => 'The department ID is required.',
            'department_id.integer' => 'The department ID must be an integer.',
            'department_id.exists' => 'The selected department ID does not exist.',
            'id.required' => 'The employee ID is required.',
            'id.integer' => 'The employee ID must be an integer.',
            'id.exists' => 'The selected employee ID does not exist.',
        ];
    
        $validator = Validator::make($request->all(), [
            'department_id' => 'required|integer|exists:departments,id',
            'id' => 'required|integer|exists:users,id',
        ], $messages);
        
   
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $currentYear = now()->year;
        $existingSkillReview = SkillReview::where('user_id', $request->id)
        ->whereYear('review_date', $currentYear)
        ->first();
        
        if ($existingSkillReview) {
            return redirect()->route('admin.skill-competencies.Get', [$request->id])
                ->with('info', 'A skill review for this employee already exists for the current year.');
        }
        $user = User::find($request->id);
    if (!$user) {
        return back()->with('error', 'User not found.')->withInput();
    }
        $skillReview = SkillReview::create([
            'manager_id' => auth()->user()->id,
            'position_id' => $user->position_id,
            'user_id' => $request->id,
            'type' => 'skill',
            'job_id' => $request->job_id,
            'department_id' => $request->department_id,
            'review_date' => now(),
        ]);
        $this->saveSkillReviewDetails($skillReview->id, $request->input('technical_levels', []), $request->input('technical_remarks', []), 'technical');
        $this->saveSkillReviewDetails($skillReview->id, $request->input('soft_levels', []), $request->input('soft_remarks', []), 'soft');
    
        return redirect()->route('admin.skill-competencies.Get', [$request->id]);
    }
    

    // Helper method to save skill review details
    private function saveSkillReviewDetails($reviewId, $levels, $remarks, $type)
    {
        foreach ($levels as $index => $level) {
            SkillReviewDetail::create([
                'skill_review_id' => $reviewId,
                'level' => $level,
                'name' => $index,
                'remark' => $remarks[$index] ?? '',
                'skill_type' => $type,
            ]);
        }
    }

    // Step four get method
    public function skillStepFourGet($userId)
    {
        $user = AssessmentHelper::getUserData($userId);
        if (!$user) {
            return back();
        }
        
        // Get user's skills
        $userSkills = $user['skills'];
        $userTechnicalSkills = $user['technical_skills']; // Get user's technical skills
    
        // Initialize arrays to store competency levels for each skill
        $competencyLevels = [];
        $technicalCompetencyLevels = [];
    
        // Calculate competency levels for each skill
        foreach ($userSkills as $index => $skill) {
            $competencyResult = AssessmentHelper::getWorkCompetencySixteenResultFull($userId);
            $competencyLevels[$index] = $competencyResult[$skill['title']] <= 33 ? 1 : ($competencyResult[$skill['title']] <= 67 ? 2 : 3);
        }
    
        // Calculate competency levels for each technical skill
        foreach ($userTechnicalSkills as $index => $techSkill) {
            $competencyResult = AssessmentHelper::getTechnicalSkills($userId);
            $technicalCompetencyLevels[$index] = $competencyResult[$techSkill['pivot']['level']] <= 33 ? 1 : ($competencyResult[$techSkill['pivot']['level']] <= 67 ? 2 : 3);
        }
    
        $lastSoftSkillReview = SkillReview::where('user_id', $userId)->orderBy('created_at', 'desc')->first();
        $reviewDate = $lastSoftSkillReview ? Carbon::parse($lastSoftSkillReview->review_date) : null;
        $reviewYear = $reviewDate ? $reviewDate->year : null;
        $hasCompletedOneYear = $reviewDate ? Carbon::now()->diffInDays($reviewDate) >= 365 : false;
    
        // Get all the review years for compare dropdown
        $reviewYears = SkillReview::where('user_id', $userId)->orderBy('review_date', 'desc')->pluck('review_date')->map(function ($date) {
            return Carbon::parse($date)->year;
        })->unique();
        
        $department = Department::find($user['department_id']);
        $user['soft_skills'] = AssessmentHelper::getSoftSkills($userId);
        $user['technical_skills'] = AssessmentHelper::getTechnicalSkills($userId);
        $user['techskills'] = AssessmentHelper::getTechSkills($userId);
        $user['selected_skills'][] = $selectedYear ?? '';
        $data['users'][] = $user;
    
        return view('admin.skill-competency.step_4', compact(
            'data', 'department', 'userId', 'competencyLevels', 'technicalCompetencyLevels', 'reviewYear', 'hasCompletedOneYear', 'reviewYears'
        ));
    }
    


    public function getDataByYear(Request $request, $userId)
    {
        $selectedYearReview = collect(); // Initialize as empty collection
        $selectedYear = null; // Initialize selectedYear
    
        // Check if the selectedYear parameter is present in the request
        if($request->has('selectedYear')) {
            $year = $request->year;
           $selectedYear = AssessmentHelper::getSoftSkillsSelectedYears($userId, $year);
        }
    
        $user = AssessmentHelper::getUserData($userId);
        if (!$user) {
            return back();
        }
        // Get user's skills
        $userSkills = $user['skills'];
    
        // Initialize an array to store competency levels for each skill
        $competencyLevels = [];
    
        // Calculate competency levels for each skill
        foreach ($userSkills as $index => $skill) {
            // Call the helper function to get the competency result for this skill
            $competencyResult = AssessmentHelper::getWorkCompetencySixteenResultFull($userId);
    
            // Determine the competency level based on the competency result
            if ($competencyResult[$skill['title']] <= 33) {
                $competencyLevel = 1;
            } elseif ($competencyResult[$skill['title']] <= 67) {
                $competencyLevel = 2;
            } else {
                $competencyLevel = 3;
            }
    
            // Store the competency level for this skill
            $competencyLevels[$index] = $competencyLevel;
        }
    
        $lastSoftSkillReview = SkillReview::where('user_id', $userId)->orderBy('created_at', 'desc')->first();
        $reviewDate = $lastSoftSkillReview ? Carbon::parse($lastSoftSkillReview->review_date) : null;
        $reviewYear = $reviewDate ? $reviewDate->year : null;
        $hasCompletedOneYear = $reviewDate ? Carbon::now()->diffInDays($reviewDate) >= 365 : false;
    
        // Get all the review years for compare dropdown
        $reviewYears = SkillReview::where('user_id', $userId)->orderBy('review_date', 'desc')->pluck('review_date')->map(function ($date) {
            return Carbon::parse($date)->year;
        })->unique();
        // dd($selectedYear);
        $department = Department::find($user['department_id']);
        $user['soft_skills'] = AssessmentHelper::getSoftSkills($userId);
        $user['selected_skills'][] = $selectedYear ?? '';
        $data['users'][] = $user;
        // Pass the necessary data to the view
        return view('admin.skill-competency.step_4', compact(
            'data', 'department', 'userId', 'competencyLevels', 'reviewYear', 'hasCompletedOneYear', 'reviewYears', 'selectedYearReview', 'selectedYear'
        ));
    }
}
