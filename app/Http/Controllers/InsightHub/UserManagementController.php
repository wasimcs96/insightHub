<?php

namespace App\Http\Controllers\InsightHub;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsightHub\AdminStoreUserRequest;
use App\Http\Requests\InsightHub\UpdateUserRequest;
use App\Services\InsightHub\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Exception;

class UserManagementController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        // $this->middleware('check.user.role');
    }

    /**
     * Display the user management page
     */
    public function index(Request $request)
    {
        $tab = $request->input('tab', 'employee');
        $perPage = $request->input('per_page', 10);

        if ($tab === 'candidate') {
            $candidateFilters = [
                'search' => $request->input('search'),
                'business_unit' => $request->input('business_unit'),
                'division' => $request->input('division'),
                'department' => $request->input('department'),
                'job_position' => $request->input('job_position'),
                'hiring_status' => $request->input('hiring_status'),
                'sort_by' => $request->input('sort_by', 'created_at'),
                'sort_order' => $request->input('sort_order', 'desc'),
            ];
            $employeeFilters = []; // No filters for employees
        } else {
            $employeeFilters = [
                'search' => $request->input('search'),
                'business_unit' => $request->input('business_unit'),
                'division' => $request->input('division'),
                'department' => $request->input('department'),
                'job_position' => $request->input('job_position'),
                'onboarding_status' => $request->input('onboarding_status'),
                'sort_by' => $request->input('sort_by', 'created_at'),
                'sort_order' => $request->input('sort_order', 'desc'),
            ];
            $candidateFilters = []; // No filters for candidates
        }

        $employees = $this->userService->getPaginatedEmployees($employeeFilters, $perPage);
        $candidates = $this->userService->getPaginatedCandidates($candidateFilters, $perPage);

        // Eager load all necessary relationships for candidates
        $candidates->load([
            'jobOpeningApplication.jobOpening.job', // jobOpeningApplication (user) -> jobOpening (application) -> job (job_openings.job_id)
            'jobOpeningApplication.jobOpening.department',
            'jobOpeningApplication.jobOpening.job.division', // job_openings.job_id -> jobs.division_id -> divisions
            'jobOpeningApplication.jobOpening.job.businessUnit', // job_openings.job_id -> jobs.business_unit_id -> business_units
        ]);

        $employeeCount = $employees->total();
        $candidateCount = $candidates->total();

        $businessUnits = \App\Models\BusinessUnit::orderBy('name')->pluck('name', 'id')->toArray();
        $divisions = \App\Models\Division::orderBy('head_of_division')->pluck('head_of_division', 'id')->toArray();
        $departments = \App\Models\Department::orderBy('name')->pluck('name', 'id')->toArray();
        $jobPositions = \App\Models\JobOpening::orderBy('job_title')->pluck('job_title', 'id')->toArray();
        
        $selectedFilters = [
            'business_unit' => $request->input('business_unit', []),
            'division' => $request->input('division', []),
            'department' => $request->input('department', []),
            'job_position' => $request->input('job_position', ''),
            'onboarding_status' => $request->input('onboarding_status', ''),
        ];
        // Only return the table partial for AJAX requests
        if ($request->ajax()) {
            $tab = $request->input('tab', 'employee');
            $perPage = $request->input('per_page', 10);

            if ($tab === 'candidate') {
                $filters = [
                    'search' => $request->input('search'),
                    'business_unit' => $request->input('business_unit'),
                    'division' => $request->input('division'),
                    'department' => $request->input('department'),
                    'job_position' => $request->input('job_position'),
                    'hiring_status' => $request->input('hiring_status'),
                    'sort_by' => $request->input('sort_by', 'created_at'),
                    'sort_order' => $request->input('sort_order', 'desc'),
                ];
                $users = $this->userService->getPaginatedCandidates($filters, $perPage);
                $employeeCount = $this->userService->getPaginatedEmployees([], $perPage)->total(); // No filters for employees
                $candidateCount = $users->total();
            } else {
                $filters = [
                    'search' => $request->input('search'),
                    'business_unit' => $request->input('business_unit'),
                    'division' => $request->input('division'),
                    'department' => $request->input('department'),
                    'job_position' => $request->input('job_position'),
                    'onboarding_status' => $request->input('onboarding_status'),
                    'sort_by' => $request->input('sort_by', 'created_at'),
                    'sort_order' => $request->input('sort_order', 'desc'),
                ];
                $users = $this->userService->getPaginatedEmployees($filters, $perPage);
                $employeeCount = $users->total();
                $candidateCount = $this->userService->getPaginatedCandidates([], $perPage)->total(); // No filters for candidates
            }

            $tableHtml = view(
                $tab === 'candidate'
                    ? 'InsightHub.settings.user-management._table_candidate'
                    : 'InsightHub.settings.user-management._table',
                [
                    'users' => $users,
                    'tab' => $tab,
                    'departments' => $departments,
                    'divisions' => $divisions,
                    'businessUnits' => $businessUnits,
                ]
            )->render();

            $tagsHtml = view('InsightHub.settings.user-management._tags-container', compact(
                'businessUnits', 'divisions', 'departments', 'jobPositions', 'selectedFilters'
            ))->render();

            return response()->json([
                'table' => $tableHtml,
                'employeeCount' => $employeeCount,
                'candidateCount' => $candidateCount,
            ]);
        }
        // For testing 0 employees/candidates
        // $employees = $employees->setCollection(collect([]));
        // $employeeCount = 0;
        // $candidates = $candidates->setCollection(collect([]));
        // $candidateCount = 0;

        // For full page load, return the full index view
        // Fetch options from DB

        return view('InsightHub.settings.user-management.index', compact(
            'employees', 'candidates', 'employeeCount', 'candidateCount',
            'departments', 'businessUnits', 'divisions', 'jobPositions', 'selectedFilters'
        ));
    }

    /**
     * Get paginated users data (Ajax)
     */
    public function getData(Request $request): JsonResponse
    {
        try {
            $filters = [
                'search' => $request->input('search'),
                'department' => $request->input('department'),
                'job_position' => $request->input('job_position'),
                'onboarding_status' => $request->input('onboarding_status'),
                'is_active' => $request->input('is_active'),
                'sort_by' => $request->input('sort_by', 'created_at'),
                'sort_order' => $request->input('sort_order', 'desc'),
            ];

            $perPage = $request->input('per_page', 10);
            $users = $this->userService->getPaginatedUsers($filters, $perPage);

            return response()->json([
                'success' => true,
                'data' => $users->items(),
                'pagination' => [
                    'current_page' => $users->currentPage(),
                    'last_page' => $users->lastPage(),
                    'per_page' => $users->perPage(),
                    'total' => $users->total(),
                    'from' => $users->firstItem(),
                    'to' => $users->lastItem(),
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch users: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get filter options (departments, job positions)
     */
    public function getFilterOptions(): JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'departments' => $this->userService->getDepartments(),
                'job_positions' => $this->userService->getJobPositions(),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch filter options: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created user
     */
    public function store(AdminStoreUserRequest $request)
    {
        try {
            // All logic in service
            $this->userService->adminCreateUser($request->validated(), $request);

            return redirect()
                ->route('insighthub.settings.user-management.index')
                ->with('alert-success', 'User created successfully');

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create user: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified user
     */
    public function show($id)
{
        $user = \App\Models\User::with([
            'performanceRatings',
            'employments',
            'job_position',
            'jobHeadcount'
        ])->findOrFail($id);

        $ratings = $user->performanceRatings
            ->whereIn('year', ['2023', '2024', '2025'])
            ->keyBy('year');

        return view('InsightHub.settings.user-management.view', compact('user'));
    }

    /**
     * Display the candidate users
     */
    public function showCandidate($id)
    {
        $user = \App\Models\User::with([
            'jobOpeningApplication.jobOpening',
            'jobOpeningApplication.jobOpening.job',
            'jobOpeningApplication.jobOpening.department',
            'jobOpeningApplication.jobOpening.job.division',
            'jobOpeningApplication.jobOpening.job.businessUnit',
            'preferredJobOpening',
            'educationProgram',
            'higherLearning',
            'educationLevel',
            'cityName',
        ])->findOrFail($id);

        // Add any other candidate-specific data you need

        return view('InsightHub.settings.user-management.view_candidate', compact('user'));
    }

    /**
     * Update the specified user
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $data = $request->validated();

            // Split full name into first_name and last_name
            if (!empty($data['name'])) {
                $nameParts = preg_split('/\s+/', trim($data['name']));
                $data['last_name'] = array_pop($nameParts);
                $data['first_name'] = implode(' ', $nameParts);
            }

            if (!empty($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            }

            $updatedUser = $this->userService->updateUser($user, $data);

            // If AJAX, return JSON
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'User updated successfully',
                    'data' => $updatedUser
                ]);
            }

            // Otherwise, redirect back with success message
            return redirect()
                ->route('insighthub.settings.user-management.show', $user->id)
                ->with('success', 'User updated successfully');

        } catch (Exception $e) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update user: ' . $e->getMessage()
                ], 500);
            }
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to update user: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified user
     */
    public function destroy($id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);
            $this->userService->deleteUser($user);

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete user: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete multiple users
     */
    public function bulkDelete(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'user_ids' => 'required|array',
                'user_ids.*' => 'exists:users,id'
            ]);

            $deletedCount = $this->userService->deleteMultipleUsers($request->user_ids);

            return response()->json([
                'success' => true,
                'message' => "{$deletedCount} user(s) deleted successfully",
                'deleted_count' => $deletedCount
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete users: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Send onboarding email to user
     */
    public function sendOnboardingEmail($id): JsonResponse
    {
        try {
            $user = User::findOrFail($id);
            $this->userService->sendOnboardingEmail($user);

            return response()->json([
                'success' => true,
                'message' => 'Onboarding email sent successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send onboarding email: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Send onboarding emails to multiple users
     */
    public function bulkSendOnboardingEmail(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'user_ids' => 'required|array',
                'user_ids.*' => 'exists:users,id'
            ]);

            $sentCount = $this->userService->sendBulkOnboardingEmails($request->user_ids);

            return response()->json([
                'success' => true,
                'message' => "Onboarding emails sent to {$sentCount} user(s)",
                'sent_count' => $sentCount
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send onboarding emails: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Process bulk user upload
     */
    public function bulkUpload(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'file' => 'required|file|mimes:csv,xlsx,xls|max:10240'
            ]);

            $results = $this->userService->processBulkUpload($request->file('file'));

            return response()->json([
                'success' => true,
                'message' => 'Bulk upload processed',
                'results' => $results
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to process bulk upload: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user statistics
     */
    public function getStatistics(): JsonResponse
    {
        try {
            $stats = $this->userService->getUserStatistics();

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch statistics: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Edit the specified user
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $countries = \App\Models\MasterCountry::orderBy('name')->get();
        $roles = \App\Models\Role::orderBy('name')->get();
        // Add other dropdown data as needed (departments, divisions, etc.)

        return view('InsightHub.settings.user-management.edit', compact('user', 'countries', 'roles'));
    }

    /**
     * Create a new user
     */
    public function create()
    {
        $countries = \App\Models\MasterCountry::orderBy('name')->get();
        $businessUnits = \App\Models\BusinessUnit::orderBy('name')->get();
        $divisions = \App\Models\Division::orderBy('head_of_division')->get();
        $departments = \App\Models\Department::orderBy('name')->get();
        $jobs = \App\Models\Job::orderBy('title')->get();
        $jobHeadcounts = \App\Models\JobHeadcount::whereNull('user_id')
            ->where('is_filled', 0)
            ->orderBy('created_at')
            ->get();
        $roles = \App\Models\Role::orderBy('name')->get();
        return view('InsightHub.settings.user-management.create', compact(
            'countries', 'businessUnits', 'divisions', 'departments', 'jobs', 'jobHeadcounts', 'roles'
        ));
    }

    /**
     * Get user by job position
     */
    public function getUserByJobPosition(Request $request)
    {
        $jobId = $request->query('job_id');
        $headcount = \App\Models\JobHeadcount::with([
            'user',
            'parent.job',
            'parent.user'
        ])->where('job_id', $jobId)->whereNull('deleted_at')->first();

        return response()->json([
            'headcount_code' => $headcount?->headcount_code,
            'superior_job_position' => $headcount?->parent?->job?->title,
            'superior_headcount_code' => $headcount?->parent?->headcount_code,
            'superior_name' => $headcount?->parent?->user?->name,
        ]);
    }

    public function getStatesByCountry($countryId)
    {
        return \App\Models\MasterState::where('country_id', $countryId)
            ->orderBy('name')
            ->get(['id','name']);
    }

    public function getCitiesByState($stateId)
    {
        return \App\Models\MasterCity::where('state_id', $stateId)
            ->orderBy('name')
            ->get(['id','name']);
    }

    public function getBarangays($cityId)
    {
        return \App\Models\MasterBarangay::where('city_id', $cityId)
            ->orderBy('name')
            ->get(['id', 'name']);
    }

}
