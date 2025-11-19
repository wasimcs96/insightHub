<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\AssessmentHelper;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\EmployeeReview;
use App\Models\EmployeeReviewDetail;
use App\Models\JobSkill;
use App\Models\Kpi;
use App\Models\KPIObjective;
use App\Models\KPIObjectiveKey;
use App\Models\MasterSkill;
use App\Models\MetaSetting;
use App\Models\Objective;
use App\Models\PerformanceManagement;
use App\Models\PerformanceManagementDetail;
use App\Models\SkillReview;
use App\Models\SkillReviewDetail;
use App\Models\TechnicalSkill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerofrmanceManagementController extends Controller
{
    public function performanceStepOne()
{
    // Get the authenticated user's ID
    $employeeId = Auth::id();
    $user = Auth::user();

    // Check if the employee has a position_id
    if (is_null($user->position_id)) {
        return redirect()->back()->withErrors(['error' => 'You do not have a position assigned.']);
    }

    // Get the current year and month
    $currentYear = Carbon::now()->year;
    $currentMonth = Carbon::now()->month;

    // Determine the review type based on the current month
    $reviewType = null;
    if ($currentMonth == 12) {
        $reviewType = 'end_year';
    } elseif (in_array($currentMonth, [6, 7, 8])) {
        $reviewType = 'mid_year';
    }

    // Check for the latest approved mid-year KPI
    $latestMidYearKPI = Kpi::with(['user', 'objectives.keys'])
        ->where('user_id', $employeeId)
        ->where('approved', 1)
        ->whereYear('created_at', $currentYear)
        ->whereHas('objectives', function ($query) {
            $query->where('kpi_type', 'mid-year');
        })
        ->latest()
        ->first();

    // Check for the latest approved planning KPI if no mid-year KPI is found
    $latestPlanningKPI = null;
    if (!$latestMidYearKPI) {
        $latestPlanningKPI = Kpi::with(['user', 'objectives.keys'])
            ->where('user_id', $employeeId)
            ->where('confirm', 1)
            ->whereYear('created_at', $currentYear)
            ->whereHas('objectives', function ($query) {
                $query->where('kpi_type', 'planning');
            })
            ->latest()
            ->first();
    }

    // Use the latest mid-year KPI if available, otherwise use the planning KPI
    $latestKPI = $latestMidYearKPI ?? $latestPlanningKPI;

    // Check for the latest approved skill review
    $approvedSkillReview = SkillReview::with('details')
        ->where('user_id', $employeeId)
        ->where('approved', 1)
        ->orderBy('created_at', 'desc')
        ->first();

    // If an approved skill review is found, use it; otherwise, retrieve all skill reviews
    if ($approvedSkillReview) {
        $skillReviews = collect([$approvedSkillReview]);
    } else {
        $skillReviews = SkillReview::with('details')
            ->where('user_id', $employeeId)
            ->get();
    }

    // Retrieve user data
    $user = AssessmentHelper::getUserData($employeeId);
    $lastKPI = Kpi::where('user_id', $employeeId)->orderBy('created_at', 'desc')->first();
    $showPlanButton = $lastKPI ? now()->diffInDays($lastKPI->created_at) > 365 : true;

    // Check if the employee has submitted mid-year and end-year KPIs
    $hasMidYearKPI = Kpi::where('user_id', $employeeId)
        ->whereYear('created_at', $currentYear)
        ->where('kpi_type', 'mid-year')
        ->exists();
    $hasEndYearKPI = Kpi::where('user_id', $employeeId)
        ->whereYear('created_at', $currentYear)
        ->where('kpi_type', 'end-year')
        ->exists();

    $hasPerformancePlanning = SkillReview::where('user_id', $employeeId)
        ->where('type', 'planning')->where('approved', 1)
        ->exists(); 

    // Check if admin has created the settings for mid-year, end-year, and planning KPIs
    $adminCanAddMidYearKPI = MetaSetting::where('setting_name', 'Mid Year KPI')
        ->where('year', $currentYear)
        ->where('end_date', '>=', now())
        ->where('status', 'active')
        ->exists();

    $adminCanAddEndYearKPI = MetaSetting::where('setting_name', 'End Year KPI')
        ->where('year', $currentYear)
        ->where('end_date', '>=', now())
        ->where('status', 'active')
        ->exists();

    $adminCanAddPlanningKPI = MetaSetting::where('setting_name', 'Planning KPI')
        ->where('year', $currentYear)
        ->where('end_date', '>=', now())
        ->where('status', 'active')
        ->orderBy('end_date', 'desc')
        ->first();

    // Determine whether to show buttons
    $showButtons = $hasPerformancePlanning && ($adminCanAddEndYearKPI || $adminCanAddPlanningKPI);
    $showMidYearButton = !$hasMidYearKPI && $adminCanAddMidYearKPI;
    $showEndYearButton = $adminCanAddEndYearKPI && !$hasEndYearKPI && $hasMidYearKPI;

    // Check if the latest skill review is of type 'planning'
    $latestSkillReview = SkillReview::where('user_id', $employeeId)
        ->where('type', 'planning')
        ->orderBy('created_at', 'desc')
        ->first();

    // Redirect to a different Blade file if the last skill review type is 'planning'
    if ($latestSkillReview && $latestSkillReview->type == 'planning') {
        return view('employee.performance-management.step_1_planning', [
            'existingMidYearReview' => null,
            'existingEndYearReview' => null,
            'skillReviews' => $skillReviews,
            'user' => $user,
            'currentMonth' => $currentMonth,
            'showPlanButton' => $showPlanButton,
            'showButtons' => $showButtons,
            'showMidYearButton' => $showMidYearButton,
            'showEndYearButton' => $showEndYearButton,
            'hasEndYearKPI' => $hasEndYearKPI,
            'hasMidYearKPI' => $hasMidYearKPI,
            'latestKPI' => $latestKPI,
            'adminCanAddMidYearKPI' => $adminCanAddMidYearKPI,
            'adminCanAddEndYearKPI' => $adminCanAddEndYearKPI,
            'adminCanAddPlanningKPI' => $adminCanAddPlanningKPI,
            'currentDate' => Carbon::now(),
            'currentYear' => Carbon::now()->year,
            'endDate' => Carbon::createFromDate($currentYear, 12, 31)
        ]);
    }

    // If the skill review type is not 'planning', render the usual view
    return view('employee.performance-management.step_1', [
        'existingMidYearReview' => $latestMidYearKPI,
        'existingEndYearReview' => $latestPlanningKPI,
        'skillReviews' => $skillReviews,
        'user' => $user,
        'currentMonth' => $currentMonth,
        'showPlanButton' => $showPlanButton,
        'showButtons' => $showButtons,
        'showMidYearButton' => $showMidYearButton,
        'showEndYearButton' => $showEndYearButton,
        'hasEndYearKPI' => $hasEndYearKPI,
        'hasMidYearKPI' => $hasMidYearKPI,
        'latestKPI' => $latestKPI,
        'adminCanAddMidYearKPI' => $adminCanAddMidYearKPI,
        'adminCanAddEndYearKPI' => $adminCanAddEndYearKPI,
        'adminCanAddPlanningKPI' => $adminCanAddPlanningKPI,
        'currentDate' => Carbon::now(),
        'currentYear' => Carbon::now()->year,
        'endDate' => Carbon::createFromDate($currentYear, 12, 31)
    ]);
}


    
    public function performancePlan()
    {
        // Get the authenticated user's ID
        $employeeId = Auth::id();
        $user = Auth::user();

        // Check if the employee has a position_id
        if (is_null($user->position_id)) {
            return redirect()->back()->withErrors(['error' => 'You do not have a position assigned.']);
        }

        // Get the current year
        $currentYear = Carbon::now()->year;

        // Define the time threshold (6 months ago from now)
        $timeThreshold = now()->subMonths(6);

        // Determine the current month and set the review type
        $currentMonth = Carbon::now()->month;
        $reviewType = null;

        if ($currentMonth == 12) {
            $reviewType = 'end_year';
        } elseif (in_array($currentMonth, [6, 7, 8])) {
            $reviewType = 'mid_year';
        }

        // Check if the review type has been determined

        // Retrieve user data
        $user = AssessmentHelper::getUserData($employeeId);

        // Retrieve skill reviews for the logged-in user
        $skillReviews = SkillReview::with('details')
            ->where('user_id', $employeeId)
            ->get();

        // Retrieve objectives and KPIs for the logged-in user
        $objectives = KPIObjective::with('keys')
            ->whereHas('kpi', function ($query) use ($employeeId) {
                $query->where('user_id', $employeeId);
            })
            ->get();

        // No existing review found or no specific review period, pass null values to the view along with skill reviews, user data, objectives, and KPIs
        return view('employee.performance-management.index', [
            'existingMidYearReview' => null,
            'existingEndYearReview' => null,
            'skillReviews' => $skillReviews,
            'user' => $user,
            'objectives' => $objectives,
        ]);
    }
    public function addKpi(Request $request)
    {
        $type = $request->query('type');
        // Get the authenticated user's ID
        $employeeId = Auth::id();
        $user = Auth::user();

        // Check if the employee has a position_id
        if (is_null($user->position_id)) {
            return redirect()->back()->withErrors(['error' => 'You do not have a position assigned.']);
        }

        // Get the current year
        $currentYear = Carbon::now()->year;

        // Check if the user has a mid-year Kpi
        $midYearKpi = Kpi::with(['objectives.keys'])
            ->where('user_id', $employeeId)
            ->whereYear('created_at', $currentYear)
            ->where('approved', 1)
            ->whereHas('objectives', function ($query) {
                $query->where('type', 'mid_year');
            })
            ->orderBy('created_at', 'desc')
            ->first();


        if ($midYearKpi) {
            // If mid-year Kpi exists, pass it to the view
            return view('employee.performance-management.add_kpi', [
                'kpi' => $midYearKpi,
                'user' => $user,
            ]);
        }

        // Retrieve user data
        $user = AssessmentHelper::getUserData($employeeId);

        // Retrieve skill reviews for the logged-in user
        $skillReviews = SkillReview::with('details')
            ->where('user_id', $employeeId)
            ->where('approved', 1)
            ->orderBy('created_at', 'desc')
            ->first();


        // Ensure technical_skills and skills are set in $user
        $user['technical_skills'] = $user['technical_skills'] ?? [];
        $user['skills'] = $user['skills'] ?? [];

        // Retrieve planning data if no mid-year Kpi
        $planningData = Kpi::with('skillReview', 'skillReview.details', 'objectives', 'objectives.keys')
            ->where('user_id', $employeeId)
            ->where('kpi_type', 'planning')
            ->latest()
            ->first();

        $allKeys = collect();

        foreach ($planningData->objectives as $objective) {
            foreach ($objective->keys as $key) {
                $allKeys->push($key);
            }
        }
        $objectives = $planningData ? $planningData->objectives : collect();
        $technicalSkills = $planningData ? $planningData->skillReview->details->where('skill_type', 'technical') : collect();
        $softSkills = $planningData ? $planningData->skillReview->details->where('skill_type', 'soft') : collect();
        // Pass the planning data to the view along with other necessary data
        return view('employee.performance-management.add_kpi', [
            'existingMidYearReview' => null,
            'existingEndYearReview' => null,
            'skillReviews' => $skillReviews,
            'user' => $user,
            'allKeys' => $allKeys,
            'objectives' => $objectives,
            'technicalSkills' => $technicalSkills,
            'softSkills' => $softSkills,
            'type' => $type,
        ]);
    }





    public function performanceStepTwo(Request $request)
{
    $request->validate([
        'objectives' => 'required|array',
        'objectives.*.weightage' => 'required|numeric|min:0|max:100',
        'objectives.*.title' => 'required|string|max:255',
        'objectives.*.kpis' => 'required|array',
        'objectives.*.kpis.*.base_target' => 'required',
        'objectives.*.kpis.*.employee_planning' => 'required',
    ]);
    
    $data = $request->all();
    // Save the skill review first
    $skillReview = new SkillReview();
    $skillReview->user_id = auth()->user()->id;
    $skillReview->department_id = auth()->user()->department_id;
    $skillReview->review_date = now();
    $skillReview->position_id = auth()->user()->position_id;
    $skillReview->type = 'planning';
    $skillReview->approved = 0;
    $skillReview->save();

    $kpi = new Kpi();
    $kpi->user_id = $skillReview->user_id;
    $kpi->kpi_type = 'planning';
    $kpi->kpi_date = now();
    $kpi->kpi_year = now()->year;
    $kpi->approved = 0;
    $kpi->skill_review_id = $skillReview->id;
    $kpi->manager_id = $skillReview->manager_id;
    $kpi->save();

    // Loop through each objective
    foreach ($data['objectives'] as $objectiveData) {
        // Save the Kpi (as an objective is linked to a Kpi in your schema)
        $objective = new KPIObjective();
        $objective->kpi_id = $kpi->id;
        $objective->weightage = $objectiveData['weightage'];
        $objective->objectives = $objectiveData['title'];
        $objective->save();

        // Loop through each Kpi within the objective
        foreach ($objectiveData['kpis'] as $kpiData) {
            // Save the Kpi key
            $kpiKey = new KPIObjectiveKey();
            $kpiKey->objective_id = $objective->id;
            $kpiKey->base_target = $kpiData['base_target'];
            $kpiKey->kpi = $kpiData['title'];
            $kpiKey->stretch_target = $kpiData['stretch_target'];
            $kpiKey->employee_planning = $kpiData['employee_planning'];
            $kpiKey->save();
        }
    }

    // Save technical skills
    foreach ($data['technical_skills'] as $skillName => $skillData) {
        $skillDetail = new SkillReviewDetail();
        $skillDetail->skill_review_id = $skillReview->id;
        $skillDetail->name = $skillName;
        $skillDetail->remark = $skillData['plan']; // Assuming the plan is saved as a remark
        $skillDetail->level = 1; // Save the rating
        $skillDetail->skill_type = 'technical';
        $skillDetail->created_at = now();
        $skillDetail->updated_at = now();
        $skillDetail->save();
    }

    // Save soft skills
    foreach ($data['soft_skills'] as $skillName => $skillData) {
        $skillDetail = new SkillReviewDetail();
        $skillDetail->skill_review_id = $skillReview->id;
        $skillDetail->name = $skillName;
        $skillDetail->remark = $skillData['plan']; // Assuming the plan is saved as a remark
        $skillDetail->level = 1; // Save the rating
        $skillDetail->skill_type = 'soft';
        $skillDetail->created_at = now();
        $skillDetail->updated_at = now();
        $skillDetail->save();
    }

    return redirect()->to('performance/management');
}



    public function saveMidKpi(Request $request)
    {
        $data = $request->all();
        $kpi_type = $request->type;
        $userId = auth()->user()->id;
        $departmentId = auth()->user()->department_id;
        $positionId = auth()->user()->position_id;

        // Save the skill review first
        $skillReview = new SkillReview();
        $skillReview->user_id = $userId;
        $skillReview->department_id = $departmentId;
        $skillReview->review_date = now();
        $skillReview->position_id = $positionId;
        $skillReview->type = $kpi_type;
        $skillReview->approved = 0;
        $skillReview->save();

        // Check for existing Kpi and delete related objectives and Kpi keys
        $existingKPI = Kpi::where('user_id', $userId)
            ->where('kpi_type',  $kpi_type)
            ->where('approved', 0) // Assuming only not approved KPIs should be deleted
            ->first();

        if ($existingKPI) {
            // Delete related objectives and Kpi keys
            foreach ($existingKPI->objectives as $objective) {
                KPIObjectiveKey::where('objective_id', $objective->id)->delete();
                $objective->delete();
            }
            $existingKPI->delete();
        }

        $kpi = new Kpi();
        $kpi->user_id = $userId;
        $kpi->kpi_type = $kpi_type;
        $kpi->kpi_date = now();
        $kpi->kpi_year = now()->year;
        $kpi->approved = 0;
        $kpi->skill_review_id = $skillReview->id;
        $kpi->manager_id = $skillReview->manager_id;
        $kpi->save();

        // Loop through each objective and save
        foreach ($data['objectives'] as $objectiveData) {
            $objective = new KPIObjective();
            $objective->kpi_id = $kpi->id;
            $objective->weightage = $objectiveData['weightage'];
            $objective->objectives = $objectiveData['title'];
            $objective->save();

            // Loop through each Kpi within the objective and save
            foreach ($objectiveData['kpis'] as $kpiData) {
                $kpiKey = new KPIObjectiveKey();
                $kpiKey->objective_id = $objective->id;
                $kpiKey->kpi = $kpiData['kpi'];
                $kpiKey->base_target = $kpiData['base_target'];
                $kpiKey->stretch_target = $kpiData['stretch_target'];
                $kpiKey->employee_planning = $kpiData['employee_planning'];
                $kpiKey->rank = $kpiData['rating'] ?? null;
                $kpiKey->save();
            }
        }

        // Save technical skills
        foreach ($data['technical_skills'] as $skillName => $skillData) {
            $skillDetail = new SkillReviewDetail();
            $skillDetail->skill_review_id = $skillReview->id;
            $skillDetail->name = $skillName;
            $skillDetail->remark = $skillData['plan'];
            $skillDetail->level = $skillData['level'] ?? '';
            $skillDetail->skill_type = 'technical';
            $skillDetail->created_at = now();
            $skillDetail->updated_at = now();
            $skillDetail->save();
        }

        // Save soft skills
        foreach ($data['soft_skills'] as $skillName => $skillData) {
            $skillDetail = new SkillReviewDetail();
            $skillDetail->skill_review_id = $skillReview->id;
            $skillDetail->name = $skillName;
            $skillDetail->remark = $skillData['plan'];
            $skillDetail->level = $skillData['level'] ?? '';
            $skillDetail->skill_type = 'soft';
            $skillDetail->created_at = now();
            $skillDetail->updated_at = now();
            $skillDetail->save();
        }

        return redirect()->to('performance/management');
    }
    public function saveEndKpi(Request $request)
    {
        $data = $request->all();
        $userId = auth()->user()->id;
        $departmentId = auth()->user()->department_id;
        $positionId = auth()->user()->position_id;

        // Save the skill review first
        $skillReview = new SkillReview();
        $skillReview->user_id = $userId;
        $skillReview->department_id = $departmentId;
        $skillReview->review_date = now();
        $skillReview->position_id = $positionId;
        $skillReview->type = 'end-year';
        $skillReview->approved = 0;
        $skillReview->save();

        // Check for existing Kpi and delete related objectives and Kpi keys
        $existingKPI = Kpi::where('user_id', $userId)
            ->where('kpi_type', 'end-year')
            ->where('approved', 0) // Assuming only not approved KPIs should be deleted
            ->first();

        if ($existingKPI) {
            // Delete related objectives and Kpi keys
            foreach ($existingKPI->objectives as $objective) {
                KPIObjectiveKey::where('objective_id', $objective->id)->delete();
                $objective->delete();
            }
            $existingKPI->delete();
        }

        $kpi = new Kpi();
        $kpi->user_id = $userId;
        $kpi->kpi_type = 'end-year';
        $kpi->kpi_date = now();
        $kpi->kpi_year = now()->year;
        $kpi->approved = 0;
        $kpi->skill_review_id = $skillReview->id;
        $kpi->manager_id = $skillReview->manager_id;
        $kpi->save();

        // Loop through each objective and save
        foreach ($data['objectives'] as $objectiveData) {
            $objective = new KPIObjective();
            $objective->kpi_id = $kpi->id;
            $objective->weightage = $objectiveData['weightage'];
            $objective->objectives = $objectiveData['title'];
            $objective->save();

            // Loop through each Kpi within the objective and save
            foreach ($objectiveData['kpis'] as $kpiData) {
                $kpiKey = new KPIObjectiveKey();
                $kpiKey->objective_id = $objective->id;
                $kpiKey->kpi = $kpiData['kpi'];
                $kpiKey->base_target = $kpiData['base_target'];
                $kpiKey->stretch_target = $kpiData['stretch_target'];
                $kpiKey->rank = $kpiData['rating'] ?? null;
                $kpiKey->save();
            }
        }

        // Save technical skills
        foreach ($data['technical_skills'] as $skillName => $skillData) {
            $skillDetail = new SkillReviewDetail();
            $skillDetail->skill_review_id = $skillReview->id;
            $skillDetail->name = $skillName;
            $skillDetail->remark = $skillData['plan'];
            $skillDetail->level = $skillData['level'] ?? '';
            $skillDetail->skill_type = 'technical';
            $skillDetail->created_at = now();
            $skillDetail->updated_at = now();
            $skillDetail->save();
        }

        // Save soft skills
        foreach ($data['soft_skills'] as $skillName => $skillData) {
            $skillDetail = new SkillReviewDetail();
            $skillDetail->skill_review_id = $skillReview->id;
            $skillDetail->name = $skillName;
            $skillDetail->remark = $skillData['plan'];
            $skillDetail->level = $skillData['level'] ?? '';
            $skillDetail->skill_type = 'soft';
            $skillDetail->created_at = now();
            $skillDetail->updated_at = now();
            $skillDetail->save();
        }

        return redirect()->to('performance/management');
    }

    // public function performanceStepThree(Request $request)
    // {
    //     // Validate the incoming request data
    //     $validated = $request->validate([
    //         'technical_skills' => 'required|array',
    //         'technical_levels' => 'required|array',
    //         'technical_remarks' => 'nullable|array',
    //         'soft_skills' => 'required|array',
    //         'soft_levels' => 'required|array',
    //         'soft_remarks' => 'nullable|array',
    //         'kpi_objects' => 'required|array',
    //         'kpi_levels' => 'required|array',
    //         'kpi_achievements' => 'nullable|array',
    //         'kpi_type' => 'nullable',
    //         'kpi_ids' => 'nullable',
    //     ]);
    //     $employeeId = auth()->id();
    //     $date = Carbon::now();
    //     // Variables to store skill data
    //     $employeeReviewId =   EmployeeReview::create([
    //         'employee_id' => $employeeId,
    //         'review_date' => $date,
    //     ]);
    //     foreach ($validated['technical_skills'] as $skill) {
    //         EmployeeReviewDetail::create([
    //             // Assuming a static value of 1 for kpi_type
    //             'name' => $skill,
    //             'employee_review_id' => $employeeReviewId->id,
    //             'level' => $validated['technical_levels'][$skill],
    //             'remark' => $validated['technical_remarks'][$skill] ?? null,
    //             'skill_type' => 'technical',
    //             'status' => 'PENDING',
    //         ]);
    //     }

    //     // Save Kpi skills and calculate totals
    //     foreach ($validated['kpi_objects'] as $index => $skill) {
    //         EmployeeReviewDetail::create([
    //             'name' => $skill,
    //             'employee_review_id' => $employeeReviewId->id,
    //             'level' => $validated['kpi_levels'][$index],
    //             'remark' => $validated['kpi_achievements'][$index] ?? null,
    //             'skill_type' => 'kpi',
    //             'kpi_type' => $validated['kpi_type'],
    //             'kpi_id' => $validated['kpi_ids'][$index],
    //             'status' => 'PENDING',
    //         ]);
    //     }

    //     // Save soft skills and calculate totals
    //     foreach ($validated['soft_skills'] as $skill) {
    //         EmployeeReviewDetail::create([
    //             'kpi_type' => 1,  // Assuming a static value of 1 for kpi_type
    //             'name' => $skill,
    //             'employee_review_id' => $employeeReviewId->id,
    //             'level' => $validated['soft_levels'][$skill],
    //             'remark' => $validated['soft_remarks'][$skill] ?? null,
    //             'skill_type' => 'soft',
    //             'status' => 'PENDING',
    //         ]);
    //     }
    //     return redirect()->route('performance.management.performanceStepThreeGet');
    //     // return view('admin.performance-management.perofrmancestep3');
    // }

    public function performanceStepThreeGet()
    {
        $employeeId = auth()->user()->id;

        // Retrieve the most recent skills data for the employee including review_date
        $skillsData = Kpi::with(['skillReview.details' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])
            ->where('user_id', $employeeId)
            ->latest()
            ->first();

        if (!$skillsData) {
            // Handle the case where no skills data is found
            abort(404, 'Skills data not found.');
        }

        // Variables to store skill data
        $technicalSkills = [];
        $kpiSkills = [];
        $softSkills = [];

        // Process reviewDetails and categorize skills
        foreach ($skillsData->skillReview->details as $reviewDetail) {
            if ($reviewDetail->skill_type === 'technical') {
                $technicalSkills[] = [
                    'name' => $reviewDetail->name,
                    'level' => $reviewDetail->level,
                    'remark' => $reviewDetail->remark,
                    'skill_type' => 'technical',
                    'review_date' => $skillsData->kpi_date, // Assuming review_date is a Carbon instance
                ];
            } elseif ($reviewDetail->skill_type === 'kpi') {
                $kpiSkills[] = [
                    'name' => $reviewDetail->name,
                    'level' => $reviewDetail->level,
                    'remark' => $reviewDetail->remark,
                    'skill_type' => 'kpi',
                    'review_date' => $skillsData->review_date, // Assuming review_date is a Carbon instance
                    'kpi_type' => $reviewDetail->kpi_type,
                ];
            } elseif ($reviewDetail->skill_type === 'soft') {
                $softSkills[] = [
                    'name' => $reviewDetail->name,
                    'level' => $reviewDetail->level,
                    'remark' => $reviewDetail->remark,
                    'skill_type' => 'soft',
                    'review_date' => $skillsData->review_date, // Assuming review_date is a Carbon instance
                ];
            }
        }

        // Calculate Kpi score
        $kpiSelectedTotal = array_sum(array_column($kpiSkills, 'level'));
        $kpiCount = count($kpiSkills);
        $kpiTotalValue = $kpiCount * 4; // Total possible value is number of KPIs * max level (4)
        $kpiScore = ($kpiTotalValue > 0) ? ($kpiSelectedTotal / $kpiTotalValue) * 100 : 0;

        // Calculate Technical score
        $technicalSelectedTotal = array_sum(array_column($technicalSkills, 'level'));
        $technicalCount = count($technicalSkills);
        $technicalTotalValue = $technicalCount * 4; // Adjust as per your max level
        $technicalScore = ($technicalTotalValue > 0) ? ($technicalSelectedTotal / $technicalTotalValue) * 100 : 0;

        // Calculate Soft skills score
        $softSelectedTotal = array_sum(array_column($softSkills, 'level'));
        $softCount = count($softSkills);
        $softTotalValue = $softCount * 4; // Adjust as per your max level
        $softScore = ($softTotalValue > 0) ? ($softSelectedTotal / $softTotalValue) * 100 : 0;

        // Calculate overall score
        $overallScore = ($technicalScore * 0.7) + ($softScore * 0.3);

        // Calculate final score
        $finalScore = ($kpiScore * 0.7) + ($overallScore * 0.3);

        // Pass the data to the blade file
        return view('employee.performance-management.performanceStepThree', [
            'technicalSkills' => $technicalSkills,
            'kpiSkills' => $kpiSkills,
            'softSkills' => $softSkills,
            'kpiScore' => $kpiScore,
            'technicalScore' => $technicalScore,
            'softScore' => $softScore,
            'overallScore' => $overallScore,
            'finalScore' => $finalScore,
        ]);
    }
}
