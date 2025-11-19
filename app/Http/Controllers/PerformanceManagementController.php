<?php

namespace App\Http\Controllers;

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
use App\Models\PerformanceManagement;
use App\Models\PerformanceManagementDetail;
use App\Models\SkillReview;
use App\Models\SkillReviewDetail;
use App\Models\TechnicalSkill;
use App\Models\User;
use Carbon\Carbon;
use Doctrine\DBAL\Schema\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PerformanceManagementController extends Controller
{
    public function performanceStepOne()
    {
        // Get the authenticated user's ID
        $user = Auth::user();

        // Check if the user is an admin
        $employeeReviews = Kpi::with(['objectives', 'skillReview', 'skillReview.user'])
            ->where('approved', 0)
            ->whereNull('manager_id')
            ->where('confirm', 0)
            ->where(function ($query) {
                $query->where('kpi_type', 'mid-year')
                    ->orWhere('kpi_type', 'end-year')
                    ->orWhere('kpi_type', 'planning');
            })
            ->get();
        // dd($employeeReviews);


        // $employeeReviews = Kpi::all();
        $departments = Department::where('company_id', $user->company_id)->where('status', 1)->get();

        $data = $this->formatReviewData($employeeReviews, $departments);
        return view('admin.performance-management.adminreview', compact('data'));
    }
    protected function formatReviewData($employeeReviews, $departments)
    {
        $reviewData = [];

        foreach ($employeeReviews as $review) {
            $reviewData[] = [
                'userData' => $review->skillReview->user,
                'reviewDetails' => $review,
                'kpiId' => $review->id
            ];
        }

        return [
            'reviewData' => $reviewData,
            'departments' => $departments
        ];
    }

    public function filterUsers(Request $request)
    {
        $query = User::query();

        // Apply filters based on request inputs
        if ($request->filled('name')) {
            $query->where(function ($query) use ($request) {
                $query->where('first_name', 'like', '%' . $request->name . '%')
                    ->orWhere('last_name', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('year')) {
            $year = $request->year;
            $query->whereHas('employeeReviews', function ($query) use ($year) {
                $query->whereYear('review_date', '=', $year);
            });
        }

        if ($request->filled('department')) {
            $query->where('department_id', $request->department);
        }

        if ($request->filled('position')) {
            $query->where('job_position_id', $request->position);
        }

        if ($request->filled('kpi_type')) {
            $query->whereHas('employeeReviews.reviewDetails', function ($query) use ($request) {
                $query->where('kpi_type', $request->kpi_type);
            });
        }

        $filteredUsers = $query->with('employeeReviews')->get();
        $employeeReviews = EmployeeReview::with(['user', 'reviewDetails'])
            ->whereIn('employee_id', $filteredUsers->pluck('id'))->get();
        $departments = Department::where('company_id', auth()->user()->company_id)->where('status', 1)->get();

        $data = $this->formatReviewData($employeeReviews, $departments);

        return view('admin.performance-management.adminreview', compact('data'));
    }
    public function employeeDetails($reviewId)
    {
        // Fetch the latest approved Kpi with related entities
        $kpi = Kpi::with(['user', 'objectives.keys'])
            ->where('id', $reviewId)
            // ->where('approved', 1)
            ->firstOrFail();
        $employee = $kpi->user;
        $user = AssessmentHelper::getUserData($employee->id);
        // Fetch departments based on company_id
        $departments = Department::where('company_id', $employee->company_id)
            ->where('status', 1)
            ->get();

        // Fetch technical skills and soft skills from SkillReviewDetail
        $technicalSkills = SkillReviewDetail::where('skill_review_id', $kpi->skill_review_id)
            ->where('skill_type', 'technical')
            ->get();
        $softSkills = SkillReviewDetail::where('skill_review_id', $kpi->skill_review_id)
            ->where('skill_type', 'soft')
            ->get();

        // Fetch the latest manager review for the user
        $managerReview = SkillReview::where('user_id', $employee->id)->latest()->first();
        // Check if manager review exists before fetching its details
        if ($managerReview) {
            $managerTech = SkillReviewDetail::where('skill_review_id', $managerReview->id)
                ->where('skill_type', 'technical')
                ->get();

            $managerSoft = SkillReviewDetail::where('skill_review_id', $managerReview->id)
                ->where('skill_type', 'soft')
                ->get();
        } else {
            $managerTech = collect();
            $managerSoft = collect();
        }
        $minimalTech = collect($user['technical_skills']);
        $minimalSoft = collect($user['skills']);
        $managerApproved = MetaSetting::where('setting_name', 'Planning Approval')
            ->where('status', 'active')
            ->exists();
        // Prepare data array
        $data = [
            'employee' => $employee,
            'review' => $kpi,
            'departments' => $departments,
            'technicalSkills' => $technicalSkills,
            'softSkills' => $softSkills,
            'kpis' => $kpi->objectives, // Assuming you want to get all the Kpi keys for the objectives
            'managerTech' => $managerTech,
            'managerSoft' => $managerSoft,
            'skillReview' => $managerReview ? $managerReview->id : null, // Use null if no manager review exists
            'minimalTech' => $minimalTech,
            'minimalSoft' => $minimalSoft,
            'managerApproved' => $managerApproved,
        ];
        if ($kpi->kpi_type == 'planning') {

            return view('admin.performance-management.planningreview', $data);
        }
        // Return the view with all required data
        return view('admin.performance-management.reviewemployee', $data);
    }





    // public function saveRemarks(Request $request)
    // {
    //     $request->validate([
    //         'skill_id' => 'required|exists:employee_review_details,id',
    //         'manager_evaluation' => 'required|string',
    //     ]);
    //     $skill = EmployeeReviewDetail::findOrFail($request->skill_id);
    //     $skill->manager_evaluation = $request->manager_evaluation;
    //     $skill->manager_ratings = $request->manager_rating;
    //     $skill->manager_id = auth()->user()->id;
    //     $skill->manager_rating_date = Carbon::now();
    //     $skill->status = 'RESPOND';
    //     $skill->save();

    //     return redirect()->back()->with('success', 'Remarks saved successfully.');
    // }

    // public function getNotifications()
    // {
    //     $notifications = EmployeeReviewDetail::where('status', 'RESPOND')
    //         ->with(['review.user', 'skill']) // Assuming you have relations set up
    //         ->get();

    //     return $notifications;
    // }
    // public function review($userId, $reviewId)
    // {
    //     // Fetch the review details for the specified user and review ID
    //     $review = EmployeeReviewDetail::where('id', $reviewId)
    //         // ->where('employee_id', $userId)
    //         // ->where('status', 'RESPOND')
    //         ->first();
    //     if (!$review) {
    //         // Handle the case where the review is not found
    //         abort(404, 'Review not found.');
    //     }

    //     // Pass the review data to the view
    //     return view('admin.performance-management.updatereview', compact('review'));
    // }


    // public function getSkillEvaluation($skillId)
    // {
    //     $evaluation = EmployeeReviewDetail::where('id', $skillId)
    //         // ->where('manager_id', auth()->user()->id)
    //         ->first();

    //     return response()->json($evaluation);
    // }
    // public function updateSkills(Request $request, $reviewId)
    // {
    //     $review = EmployeeReviewDetail::findOrFail($reviewId);
    //     // Update the review details
    //     $review->level = $request->input('kpi_level');
    //     $review->remark = $request->input('kpi_achievement');
    //     $review->status = 'UPDATED'; // Assuming status is passed in the form

    //     // Save the updated review
    //     $review->save();
    //     // Redirect back to the performance step three page
    //     return redirect()->route('performance.management.performanceStepThreeGet')->with('success', 'Skill updated successfully');
    // }

    public function approveSkillReview($id, Request $request)
    {
        // Find the skill review by ID
        $skillReview = Kpi::with(['skillReview.details', 'objectives.keys'])->findOrFail($id);
        $kpiId = $skillReview->id;
        // Determine the type of skill review
        $reviewType = null;
        if ($skillReview->kpi_type == 'planning') {
            $reviewType = 'Planning KPI';
        } elseif ($skillReview->kpi_type == 'mid-year') {
            $reviewType = 'Mid Year KPI';
        } elseif ($skillReview->kpi_type == 'end-year') {
            $reviewType = 'End Year KPI';
        }

        // Retrieve the necessary data
        $objectives = $skillReview ? $skillReview->objectives : collect();
        $technicalSkills = $skillReview ? $skillReview->skillReview->details->where('skill_type', 'technical') : collect();
        $softSkills = $skillReview ? $skillReview->skillReview->details->where('skill_type', 'soft') : collect();
        $allKeys = collect();

        foreach ($skillReview->objectives as $objective) {
            foreach ($objective->keys as $key) {
                $allKeys->push($key);
            }
        }
        if ($skillReview->kpi_type == 'planning') {
            return redirect()->route('admin.performance.management.employeeDetails', ['reviewId' => $kpiId]);
        }
        $skillReviewId = $skillReview->id;

        // Check if manager approved setting is enabled for the specific review type
        $managerApproved = MetaSetting::where('setting_name', $reviewType)
            ->where('status', 'active')
            ->exists();
        // Redirect back with a success message and pass the data
        return view('admin.performance-management.kpi_review')->with([
            'technicalSkills' => $technicalSkills,
            'softSkills' => $softSkills,
            'kpi' => $allKeys,
            'kpiId' => $kpiId,
            'skillReviewId' => $skillReviewId,
            'objectives' => $objectives,
            'reviewType' => $reviewType,
            'managerApproved' => $managerApproved,
        ]);
    }



    public function updateSkills(Request $request, $skillReviewId)
{
    // Validate the incoming request
    $request->validate([
        'technical_levels' => 'required|array',
        'soft_levels' => 'required|array',
        'objectives.*.kpis.*.rating' => 'required|integer',
        // Add validation rules for employee planning if necessary
    ]);

    // Retrieve the existing skill review by ID and get the related Kpi
    $existingSkillReview = Kpi::with('skillReview.details', 'objectives.keys')->findOrFail($skillReviewId);

    // Update the confirm field to 1
    $existingSkillReview->confirm = 1;
    $existingSkillReview->save();

    // Create a new SkillReview
    $newSkillReview = $existingSkillReview->skillReview->replicate();
    $newSkillReview->approved = 1; // Set as approved
    $newSkillReview->save();

    // Create a new Kpi
    $newKpi = $existingSkillReview->replicate();
    $newKpi->skill_review_id = $newSkillReview->id;
    $newKpi->approved = 1; // Set as approved
    $newKpi->manager_id = auth()->user()->id;
    $newKpi->save();

    // Replicate objectives and their keys
    $objectiveKeyMap = [];
    foreach ($existingSkillReview->objectives as $objective) {
        $newObjective = $objective->replicate();
        $newObjective->kpi_id = $newKpi->id;
        $newObjective->save();

        foreach ($objective->keys as $key) {
            $newKey = $key->replicate();
            $newKey->objective_id = $newObjective->id;
            $newKey->save();

            // Map old key id to new key id
            $objectiveKeyMap[$key->id] = $newKey->id;
        }
    }

    // Update technical skills
    foreach ($request->technical_levels as $skillName => $level) {
        $skill = new SkillReviewDetail([
            'skill_review_id' => $newSkillReview->id,
            'name' => $skillName,
            'level' => $level,
            'manager_evaluation' => $request->technical_evaluation[$skillName] ?? '',
            'remark' => $request->technical_remarks[$skillName] ?? '', // Save employee remark for technical skills
            'skill_type' => 'technical',
        ]);
        $skill->save();
    }

    // Update soft skills
    foreach ($request->soft_levels as $skillName => $level) {
        $skill = new SkillReviewDetail([
            'skill_review_id' => $newSkillReview->id,
            'name' => $skillName,
            'level' => $level,
            'manager_evaluation' => $request->soft_evaluation[$skillName] ?? '',
            'remark' => $request->soft_remarks[$skillName] ?? '', // Save employee remark for soft skills
            'skill_type' => 'soft',
        ]);
        $skill->save();
    }

    // Update the manager evaluation, rank, and employee planning for KPI objectives and keys
    if ($request->has('objectives')) {
        foreach ($request->objectives as $objectiveData) {
            if (isset($objectiveData['kpis'])) {
                foreach ($objectiveData['kpis'] as $kpiData) {
                    // Get the new key id
                    $newKeyId = $objectiveKeyMap[$kpiData['id']] ?? null;
                    if ($newKeyId) {
                        // Find the new key by id
                        $newKey = KPIObjectiveKey::findOrFail($newKeyId);

                        // Update the new key details
                        $newKey->manager_evaluation = $kpiData['manager_evaluation'] ?? '';
                        $newKey->rank = $kpiData['rating'] ?? 1;
                        $newKey->base_target = $kpiData['base_target'] ?? '';
                        $newKey->stretch_target = $kpiData['stretch_target'] ?? '';
                        $newKey->employee_planning = $kpiData['employee_planning'] ?? ''; // Save employee planning for KPIs
                        $newKey->save();
                    }
                }
            }
        }
    }

    // Redirect back with a success message
    return redirect()->route('admin.performance.management.employeeDetails', ['reviewId' => $newKpi->id])
        ->with('success', 'Skills and manager evaluations updated successfully!');
}

    
    public function updatePlanning(Request $request, $kpiId)
    {
        $kpi = Kpi::find($kpiId); // Find the KPI by ID

        if ($kpi) {
            $approved = $request->input('approved');
            $managerId = auth()->user()->id; // Get the logged-in manager's ID

            // Update the approved status, confirm status, and manager ID of the KPI
            $kpi->update([
                'approved' => $approved,
                'confirm' => 1, // Set confirm to 1
                'manager_id' => $managerId // Set the manager ID
            ]);

            // Check if the KPI has a related SkillReview and update it as well
            if ($kpi->skillReview) {
                $kpi->skillReview->update([
                    'approved' => $approved,
                    'confirm' => 1, // Set confirm to 1
                    'manager_id' => $managerId // Set the manager ID
                ]);
            }

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'KPI not found'], 404);
    }



    public function performanceStepTwo(Request $request)
    {


        return redirect()->to('performance/management');
    }

    public function pendingReview()
    {
        $user = Auth::user();

        // Check if the user is an admin
        $employeeReviews = Kpi::with(['objectives', 'skillReview', 'skillReview.user'])
            ->where('approved', 0)
            ->where('confirm', 0)
            ->whereNull('manager_id')
            ->where(function ($query) {
                $query->where('kpi_type', 'mid-year')
                    ->orWhere('kpi_type', 'end-year')
                    ->orWhere('kpi_type', 'planning');
            })
            ->get();
        // dd($employeeReviews);


        // $employeeReviews = Kpi::all();
        $departments = Department::where('company_id', $user->company_id)->where('status', 1)->get();
        $data = $this->formatReviewData($employeeReviews, $departments);
        return view('admin.performance-management.adminreview', compact('data'));
    }
    public function MidYearReview()
    {
        $user = Auth::user();

        // Check if the user is an admin
        $employeeReviews = Kpi::with(['objectives', 'skillReview', 'skillReview.user'])
            ->where('approved', 1)
            ->where('confirm', 1)
            ->where(function ($query) {
                $query->where('kpi_type', 'mid-year');
            })
            ->get();
        // dd($employeeReviews);


        // $employeeReviews = Kpi::all();
        $departments = Department::where('company_id', $user->company_id)->where('status', 1)->get();
        $data = $this->formatReviewData($employeeReviews, $departments);
        return view('admin.performance-management.reviewlistview', compact('data'));
    }
    public function EndYearReview()
    {
        $user = Auth::user();

        // Check if the user is an admin
        $employeeReviews = Kpi::with(['objectives', 'skillReview', 'skillReview.user'])
            ->where('approved', 1)
            ->where('confirm', 1)
            ->where(function ($query) {
                $query->where('kpi_type', 'end-year');
            })
            ->get();
        // dd($employeeReviews);


        // $employeeReviews = Kpi::all();
        $departments = Department::where('company_id', $user->company_id)->where('status', 1)->get();
        $data = $this->formatReviewData($employeeReviews, $departments);
        return view('admin.performance-management.reviewlistview', compact('data'));
    }
    public function PlanningReview()
    {
        $user = Auth::user();

        // Check if the user is an admin
        $employeeReviews = Kpi::with(['objectives', 'skillReview', 'skillReview.user'])
            ->where('approved', 1)
            // ->where('confirm', 1)
            ->where(function ($query) {
                $query->where('kpi_type', 'planning');
            })
            ->get();
        // dd($employeeReviews);


        // $employeeReviews = Kpi::all();
        $departments = Department::where('company_id', $user->company_id)->where('status', 1)->get();

        $data = $this->formatReviewData($employeeReviews, $departments);
        return view('admin.performance-management.reviewlistview', compact('data'));
    }
}
