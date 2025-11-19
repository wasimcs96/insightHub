<?php

namespace App\Http\Controllers\Admin\TalentAcquisition;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobOpening;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class JobBoardController extends Controller
{
    public function indexOld(Request $request)
    {
        $query = Job::where('saved_job', 1)
        ->where('status', 2)
        ->where('is_primary', 0)
        ->where('vacancy', '>', 0)
        ->orderBy('updated_at', 'desc');

        $search = $request->input('search', ''); // Default to empty search if not provided

        if(auth()->user()->company_id) {
            $company_id = auth()->user()->company_id;
        } else {
            $company_id = 3;
        }

        $queryJobOpenings = JobOpening::query()->withCount('job_applications')->where('company_id', $company_id)->orderBy('updated_at', 'desc');

        // Sorting
        $sort = $request->input('sort', 'created_date');  // Default to 'created_date'
        $sortType = $request->input('sort_type', 'desc');  // Default to descending order
        // dd($sort, $sortType);
        
        // Apply sorting based on the selected option
        if ($sort == 'Job Title A-Z') {
            $query->orderBy('title', 'asc');
        } elseif ($sort == 'Job Title Z-A') {
            $query->orderBy('title', 'desc');
        } elseif ($sort == 'Most Recent') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort == 'Oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort == 'Most Total Vacancies') {
            $query->orderBy('vacancy', 'desc'); 
        } elseif ($sort == 'Fewest Total Vacancies') {
            $query->orderBy('vacancy', 'asc'); 
        }

        // Filters
        if ($request->filled('department_id')) {
            $query->where('org_department', $request->department_id);
        }
        if ($request->filled('position_level')) {
            $query->where('level', $request->position_level);
        }
        if ($search) {
            $query->where('title', 'LIKE', '%' . $search . '%');
        }

        // Pagination with custom per-page value
        $perPage = $request->input('per_page', 10); // Default to 10
        $vacancies = $query->paginate($perPage);

        $departments = Department::where('status', 1)
            ->where('company_id', $company_id)
            ->withCount(['jobs as job_count' => function ($query) {
                $query->whereColumn('jobs.org_department', 'departments.id') // Ensure correct relationship
                    ->where('jobs.status', 2) // Ensure only active jobs are counted
                    ->where('jobs.vacancy', '>', 0); // Count only jobs with vacancies
            }])
            ->orderByDesc('job_count') // Order by job count in descending order
            ->get();
        // dd($departments);

        $departmentsJob = Department::where('status', 1)
        ->where('company_id', $company_id)
        ->withCount(['jobs as job_count' => function ($query) {
            $query->whereColumn('jobs.org_department', 'departments.id'); // Ensuring the relationship
        }])
        ->orderByDesc('job_count') // Order by job count in descending order
        ->get();

        $departmentsJob = Department::where('status', 1)
        ->where('company_id', $company_id)
        ->withCount(['jobOpenings as job_count' => function ($query) {
            $query->whereColumn('job_openings.department_id', 'departments.id');
        }])
        ->orderByDesc('job_count')
        ->get();


        $jobOpeningsCount = DB::table('job_openings')
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

            $status_of_job = [
                1 => 'Ready',
                2 => 'Active',
                3 => 'Expired',
                4 => 'Filled',
                5 => 'Draft'
            ];
        
        // Get the vacancy count per position level
        $levels = config('levels');
        $vacancyCounts = [];

        foreach ($levels as $levelName => $level) {
            $count = \DB::table('jobs')
            ->where('status', 2)
            ->where('is_primary', 0)
            ->where('vacancy', '>', 0)
            ->where('saved_job', 1)
            ->where('level', $level)
            ->count();
    
            $vacancyCounts[$level] = $count;

        }

        $jobCounts = \DB::table('job_openings')
            ->join('jobs', 'job_openings.job_id', '=', 'jobs.id')
            ->where('job_openings.company_id', $company_id)
            // ->whereIn('jobs.level', array_values($levels))
            ->selectRaw('jobs.level, COUNT(job_openings.id) as job_count')
            ->groupBy('jobs.level')
            ->pluck('job_count', 'jobs.level');
            

        $levelsJob = collect();

        foreach ($levels as $levelName => $levelValue) {
            $levelsJob->push((object)[
                'level_name' => $levelName,
                'level_value' => $levelValue,
                'job_count' => $jobCounts[$levelValue] ?? 0,
            ]);
        }

          // Filters for search, department, position, etc.
        if ($request->filled('search_job')) {
            $queryJobOpenings->where('job_title', 'LIKE', '%' . $request->input('search_job') . '%');
        }
        if ($request->filled('department_id_job')) {
            $queryJobOpenings->where('department_id', $request->department_id_job);
        }
        if ($request->filled('position_level_job')) {
            $queryJobOpenings->whereHas('jobs', function ($query) use ($request) {
                $query->where('level', $request->position_level_job);
            });
        }

        if ($request->filled('job_opening_status')) {
            $queryJobOpenings->where('status', $request->job_opening_status);
        }

         // Job opening statuses to filter by
        $statuses = [
            'ongoing' => [2, 3],
            'ready' => [1],
            'filled' => [4],
            'draft' => [5],
        ];
        $status = $request->input('status', 'ongoing');

        if (isset($statuses[$status])) {
            $queryJobOpenings->whereIn('status', $statuses[$status]);
        }

        $perPageJob = $request->input('per_page_job', 10);
        $jobOpenings = $queryJobOpenings->paginate($perPageJob);

        // Handle AJAX request
        if ($request->ajax()) {
            $html = view('admin.talent-acquisition.job-board.job-vacancy.index', compact('vacancies'))->render();
            $htmlOngoing = view('admin.talent-acquisition.job-board.job-advertisement.table.ongoing', compact('jobOpenings'))->render();
            $htmlReady = view('admin.talent-acquisition.job-board.job-advertisement.table.ready', compact('jobOpenings'))->render();
            $htmlFilled = view('admin.talent-acquisition.job-board.job-advertisement.table.filled', compact('jobOpenings'))->render();
            $htmlDraft = view('admin.talent-acquisition.job-board.job-advertisement.table.draft', compact('jobOpenings'))->render();
            return response()->json([
                'html' => $html,
                'htmlOngoing' => $htmlOngoing,
                'htmlReady' => $htmlReady,
                'htmlFilled' => $htmlFilled,
                'htmlDraft' => $htmlDraft,
                'total_count' => $vacancies->total(), 
                'current_page' => $vacancies->currentPage(),
                'last_page' => $vacancies->lastPage(),
            ]);
        }
        // Full page load
        return view('admin.talent-acquisition.job-board.job_board', compact('vacancies', 'departments', 'departmentsJob', 'vacancyCounts', 'levels', 'levelsJob', 'status', 'jobOpenings','jobOpeningsCount','status_of_job'));
    }

    public function index(Request $request)
    {
        // Early initialization and validation
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
            'search_job' => 'nullable|string|max:255',
            'sort' => 'nullable|string',
            'sort_type' => 'nullable|in:asc,desc',
            'department_id' => 'nullable|integer',
            'department_id_job' => 'nullable|integer',
            'position_level' => 'nullable|string',
            'position_level_job' => 'nullable|string',
            'job_opening_status' => 'nullable|integer',
            'status' => 'nullable|string',
            'per_page' => 'nullable|integer|min:1|max:100',
            'per_page_job' => 'nullable|integer|min:1|max:100',
        ]);

        $companyId = 3;
        $search = $request->input('search', '') ?? '';
        $perPage = $request->input('per_page', 10);
        $perPageJob = $request->input('per_page_job', 10);

        // Optimize main job query with eager loading
        $jobQuery = $this->buildJobQuery($request, $search);
        $vacancies = $jobQuery->paginate($perPage);

        // Optimize job openings query
        $jobOpeningsQuery = $this->buildJobOpeningsQuery($request, $companyId);
        $jobOpenings = $jobOpeningsQuery->paginate($perPageJob);

        // Handle AJAX request early to avoid unnecessary queries
        if ($request->ajax()) {
            return $this->handleAjaxResponse($vacancies, $jobOpenings);
        }

        // Use lazy loading for full page load to avoid unnecessary queries
        $departments = $this->getDepartmentsWithCounts($companyId);
        $departmentsJob = $this->getDepartmentsWithJobOpeningCounts($companyId);
        $jobOpeningsCount = $this->getJobOpeningStatusCounts($companyId);
        $levelsData = $this->getLevelsData($companyId);

        return view('admin.talent-acquisition.job-board.job_board', [
            'vacancies' => $vacancies,
            'departments' => $departments,
            'departmentsJob' => $departmentsJob,
            'vacancyCounts' => $levelsData['vacancyCounts'],
            'levels' => $levelsData['levels'],
            'levelsJob' => $levelsData['levelsJob'],
            'status' => $request->input('status', 'ongoing'),
            'jobOpenings' => $jobOpenings,
            'jobOpeningsCount' => $jobOpeningsCount,
            'status_of_job' => config('job_statuses', [
                1 => 'Ready',
                2 => 'Active',
                3 => 'Expired',
                4 => 'Filled',
                5 => 'Draft'
            ])
        ]);
    }

    private function buildJobQuery(Request $request, string $search)
    {
        $query = Job::query()
            ->select([
                'id', 
                'title', 
                'org_department', 
                'level', 
                'vacancy', 
                'created_at', 
                'updated_at'
            ])
            // Only get jobs that have at least one vacant position in job_headcounts
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('job_headcounts')
                    ->whereColumn('job_headcounts.job_id', 'jobs.id')
                    ->whereNull('job_headcounts.user_id')
                    ->whereNull('job_headcounts.deleted_at');
            })
            ->where('saved_job', 1)
            ->where('is_primary', 0);


        // Optional: Add actual vacant count as a subquery
        $query->selectSub(function ($query) {
            $query->from('job_headcounts')
                ->whereColumn('job_headcounts.job_id', 'jobs.id')
                ->whereNull('job_headcounts.user_id')
                ->whereNull('job_headcounts.deleted_at')
                ->selectRaw('COUNT(*)');
        }, 'actual_vacant_positions');

        // Apply sorting with optimized mapping
        $sortMappings = [
            'Job Title A-Z' => ['title', 'asc'],
            'Job Title Z-A' => ['title', 'desc'],
            'Most Recent' => ['created_at', 'desc'],
            'Oldest' => ['created_at', 'asc'],
            'Most Actual Vacancies' => ['actual_vacant_positions', 'desc'],
            'Fewest Actual Vacancies' => ['actual_vacant_positions', 'asc'],
        ];

        $sort = $request->input('sort', 'Most Recent');
        if (isset($sortMappings[$sort])) {
            $query->orderBy(...$sortMappings[$sort]);
        } else {
            $query->orderBy('actual_vacant_positions', 'desc'); // Change default
        }

        // Apply filters
        $query->when($request->filled('department_id'), function ($q) use ($request) {
            $q->where('department_id', $request->department_id);
        })
        ->when($request->filled('position_level'), function ($q) use ($request) {
            $q->where('level', $request->position_level);
        })
        ->when($search, function ($q) use ($search) {
            $q->where('title', 'LIKE', '%' . $search . '%');
        });

        return $query;
    }

    private function buildJobOpeningsQuery(Request $request, int $companyId)
    {
        $query = JobOpening::query()
            ->with(['jobs:id,level', 'job_applications'])
            ->where('company_id', $companyId);

        // Apply filters
        $query->when($request->filled('search_job'), function ($q) use ($request) {
            $q->where('job_title', 'LIKE', '%' . $request->input('search_job') . '%');
        })
        ->when($request->filled('department_id_job'), function ($q) use ($request) {
            $q->where('department_id', $request->department_id_job);
        })
        ->when($request->filled('position_level_job'), function ($q) use ($request) {
            $q->whereHas('jobs', function ($query) use ($request) {
                $query->where('level', $request->position_level_job);
            });
        })
        ->when($request->filled('job_opening_status'), function ($q) use ($request) {
            $q->where('status', $request->job_opening_status);
        });

        // Apply status filter
        $statusMappings = [
            'ongoing' => [2, 3],
            'ready' => [1],
            'filled' => [4],
            'draft' => [5],
        ];

        $status = $request->input('status', 'ongoing');
        if (isset($statusMappings[$status])) {
            $query->whereIn('status', $statusMappings[$status]);
        }

        // Add count as a subquery to avoid N+1
        $query->withCount('job_applications')
            ->orderBy('updated_at', 'desc');

        return $query;
    }

    private function getDepartmentsWithCounts(int $companyId)
    {
        return Cache::remember("departments_with_counts_{$companyId}", 300, function () use ($companyId) {
            return Department::where('status', 1)
                ->where('company_id', $companyId)
                ->withCount(['jobs as job_count' => function ($query) {
                    $query->whereExists(function ($q) {
                        $q->select(DB::raw(1))
                        ->from('job_headcounts')
                        ->whereColumn('job_headcounts.job_id', 'jobs.id')
                        ->whereNull('job_headcounts.user_id');
                    })
                    ->where('jobs.status', 2);
                }])
                ->orderByDesc('job_count')
                ->get(['id', 'name', 'status', 'company_id']);
        });
    }

    private function getDepartmentsWithJobOpeningCounts(int $companyId)
    {
        return Cache::remember("departments_job_openings_{$companyId}", 300, function () use ($companyId) {
            return Department::where('status', 1)
                ->where('company_id', $companyId)
                ->withCount('jobOpenings as job_count')
                ->orderByDesc('job_count')
                ->get(['id', 'name', 'status', 'company_id']);
        });
    }

    private function getJobOpeningStatusCounts(int $companyId)
    {
        return Cache::remember("job_opening_status_counts_{$companyId}", 300, function () use ($companyId) {
            return DB::table('job_openings')
                ->where('company_id', $companyId)
                ->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status')
                ->toArray();
        });
    }

    private function getLevelsData(int $companyId)
    {
        return Cache::remember("levels_data_{$companyId}", 300, function () use ($companyId) {
            $levels = config('levels');
            
            // Single query to get all level-related statistics
            $levelStats = DB::table('jobs')
                ->leftJoin('job_headcounts', function ($join) {
                    $join->on('jobs.id', '=', 'job_headcounts.job_id')
                        ->whereNull('job_headcounts.user_id');
                })
                ->leftJoin('job_openings', function ($join) use ($companyId) {
                    $join->on('jobs.id', '=', 'job_openings.job_id')
                        ->where('job_openings.company_id', '=', $companyId);
                })
                ->where('jobs.status', 2)
                ->where('jobs.is_primary', 0)
                ->where('jobs.saved_job', 1)
                ->whereIn('jobs.level', array_values($levels))
                ->whereNotNull('job_headcounts.id') // Ensure at least one vacant position exists
                ->select(
                    'jobs.level',
                    DB::raw('COUNT(DISTINCT jobs.id) as job_count'),
                    DB::raw('COUNT(DISTINCT job_headcounts.id) as vacant_positions'),
                    DB::raw('COUNT(DISTINCT job_openings.id) as job_opening_count')
                )
                ->groupBy('jobs.level')
                ->get()
                ->keyBy('level');

            // Build the arrays and collection
            $vacancyCounts = [];
            $levelsJob = collect();

            foreach ($levels as $levelName => $levelValue) {
                $stats = $levelStats[$levelValue] ?? null;
                
                // Set vacancy counts
                $vacancyCounts[$levelValue] = $stats->vacant_positions ?? 0;
                
                // Add to levels collection
                $levelsJob->push((object)[
                    'level_name' => $levelName,
                    'level_value' => $levelValue,
                    'job_count' => $stats->job_opening_count ?? 0,
                    'vacant_positions' => $stats->vacant_positions ?? 0,
                    'total_jobs' => $stats->job_count ?? 0,
                ]);
            }

            return [
                'levels' => $levels,
                'vacancyCounts' => $vacancyCounts,
                'levelsJob' => $levelsJob
            ];
        });
    }

    private function handleAjaxResponse($vacancies, $jobOpenings)
    {
        $views = [
            'html' => 'admin.talent-acquisition.job-board.job-vacancy.index',
            'htmlOngoing' => 'admin.talent-acquisition.job-board.job-advertisement.table.ongoing',
            'htmlReady' => 'admin.talent-acquisition.job-board.job-advertisement.table.ready',
            'htmlFilled' => 'admin.talent-acquisition.job-board.job-advertisement.table.filled',
            'htmlDraft' => 'admin.talent-acquisition.job-board.job-advertisement.table.draft',
        ];

        $renderedViews = [];
        foreach ($views as $key => $view) {
            $data = $key === 'html' ? compact('vacancies') : compact('jobOpenings');
            $renderedViews[$key] = view($view, $data)->render();
        }

        return response()->json(array_merge($renderedViews, [
            'total_count' => $vacancies->total(),
            'current_page' => $vacancies->currentPage(),
            'last_page' => $vacancies->lastPage(),
        ]));
    }


    public function getJobOpenings(Request $request)
    {
        $company_id = auth()->user()->company_id ?? 3;
        if(!$company_id) {
            $company_id = 3;
        }

        // Query for Job Openings
        $queryJobOpenings = JobOpening::query()
            ->where('company_id', $company_id)
            ->withCount('job_applications')->orderBy('updated_at', 'desc');

        // Search by Job Title
        if ($request->filled('search_job_opening')) {
            $queryJobOpenings->where('job_title', 'LIKE', '%' . $request->input('search_job_opening') . '%');
        }

        // Department Filter
        if ($request->filled('department_id_job_opening')) {
            $queryJobOpenings->where('department_id', $request->department_id_job_opening);
        }

        // Position Level Filter
        if ($request->filled('position_level_job_opening')) {
            $queryJobOpenings->whereHas('jobs', function ($query) use ($request) {
                $query->where('level', $request->position_level_job_opening);
            });
        }

        // Job Opening Status Filter
        if ($request->filled('job_opening_status')) {
            $queryJobOpenings->where('status', $request->job_opening_status);
        }

        $sort = $request->input('sort_job_opening', 'created_date');  // Default to 'created_date'
        $sortType = $request->input('sort_type_job_opening', 'desc');  // Default to descending order
        // dd($sort, $sortType);
        
        // Apply sorting based on the selected option
        if ($sort == 'Job Title A-Z') {
            $queryJobOpenings->orderBy('job_title', 'asc');
        } elseif ($sort == 'Job Title Z-A') {
            $queryJobOpenings->orderBy('job_title', 'desc');
        } elseif ($sort == 'Most Recent') {
            $queryJobOpenings->orderBy('created_at', 'desc');
        } elseif ($sort == 'Oldest') {
            $queryJobOpenings->orderBy('created_at', 'asc');
        } elseif ($sort == 'Most Total Vacancies') {
            $queryJobOpenings->orderBy('vacancies', 'desc'); 
        } elseif ($sort == 'Fewest Total Vacancies') {
            $queryJobOpenings->orderBy('vacancies', 'asc'); 
        }

        // Status Mapping
        $statuses = [
            'ongoing' => [2, 3], // Ongoing
            'ready' => [1],      // Ready
            'filled' => [4],     // Filled
            'draft' => [5],      // Draft
        ];

        // Default to 'ongoing' if status is missing/invalid
        $status = $request->input('status', 'ongoing');
        if (!isset($statuses[$status])) {
            $status = 'ongoing';
        }
        $queryJobOpenings->whereIn('status', $statuses[$status]);

        // Pagination
        $perPageJob = $request->input('per_page_job_opening', 10);
        $jobOpenings = $queryJobOpenings->paginate($perPageJob);

        // Render only the requested tab
        $html = view("admin.talent-acquisition.job-board.job-advertisement.table.$status", compact('jobOpenings'))->render();

        // Return JSON Response
        return response()->json([
            'html' => $html,  
            'pagination' => $jobOpenings->links()->toHtml(), // Convert pagination to HTML
            'total_count' => $jobOpenings->total(),
            'current_page' => $jobOpenings->currentPage(),
            'last_page' => $jobOpenings->lastPage(),
        ]);
    }


    public function destroy($id)
    {
        $job = JobOpening::find($id);

        if (!$job) {
            return response()->json(['success' => false, 'message' => 'Job not found'], 404);
        }

        $job->delete();

        return response()->json(['success' => true, 'message' => 'Job deleted successfully']);
    }


    // public function updateJobDates(Request $request)
    // {
    //     $validated = $request->validate([
    //         'job_id' => 'required|exists:job_openings,id',
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date',
    //     ]);
        

    //     $job = JobOpening::find($validated['job_id']);
    //     $job->application_period_start_date = $validated['start_date'];
    //     $job->application_period_end_date = $validated['end_date'];
    //     $job->save();

    //     return response()->json(['success' => true]);
    // }

    // public function updateJobDates(Request $request)
    // {
    //     $validated = $request->validate([
    //         'job_id' => 'required|exists:job_openings,id',
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date',
    //     ]);

    //     // Find the job and update its application period
    //     $job = JobOpening::find($validated['job_id']);
    //     $job->application_period_start_date = Carbon::parse($validated['start_date'])->format('Y-m-d');
    //     $job->application_period_end_date = Carbon::parse($validated['end_date'])->format('Y-m-d');
    //     $job->save();

    //     return response()->json(['success' => true]);
    // }

    // public function updateJobDates(Request $request)
    // {
    //     $validated = $request->validate([
    //         'job_id' => 'required|exists:job_openings,id',
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date',
    //     ]);

    //     $today = Carbon::today();
    //     $startDate = Carbon::parse($validated['start_date']);
    //     $endDate = Carbon::parse($validated['end_date']);

    //     // Set status based on the given logic
    //     if ($startDate->isFuture()) {
    //         $status = 1; // Upcoming
    //     } elseif ($startDate->isSameDayOrBefore($today) && $endDate->isSameDayOrAfter($today)) {
    //         $status = 2; // Ongoing
    //     } elseif ($endDate->isBefore($today)) {
    //         $status = 3; // Expired
    //     } else {
    //         $status = 0; // Fallback (optional)
    //     }

    //     // Find and update job
    //     $job = JobOpening::find($validated['job_id']);
    //     $job->application_period_start_date = $startDate->format('Y-m-d');
    //     $job->application_period_end_date = $endDate->format('Y-m-d');
    //     $job->status = $status;
    //     $job->save();

    //     return response()->json(['success' => true, 'status' => $status]);
    // }

    public function updateJobDates(Request $request)
{
    $validated = $request->validate([
        'job_id' => 'required|exists:job_openings,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
    ]);

    $today = Carbon::today();
    $startDate = Carbon::parse($validated['start_date']);
    $endDate = Carbon::parse($validated['end_date']);

    // Set status based on the given logic
    if ($startDate->greaterThan($today)) {
        $status = 1; // Upcoming
    } elseif (
        ($startDate->equalTo($today) || $startDate->lessThan($today)) &&
        ($endDate->equalTo($today) || $endDate->greaterThan($today))
    ) {
        $status = 2; // Ongoing
    } elseif ($endDate->lessThan($today)) {
        $status = 3; // Expired
    } else {
        $status = 0; // Fallback (optional)
    }

    // Find and update job
    $job = JobOpening::find($validated['job_id']);
    $job->application_period_start_date = $startDate->format('Y-m-d');
    $job->application_period_end_date = $endDate->format('Y-m-d');
    $job->status = $status;
    $job->save();

    return response()->json(['success' => true, 'status' => $status]);
}



    public function setToExpired(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'job_id' => 'required|exists:job_openings,id',
            'status' => 'required|in:3', // Only allow status to be set to 3 (Expired)
        ]);

        // Find the job and update the status
        $job = JobOpening::find($validated['job_id']);
        $job->status = $validated['status'];
        $job->application_period_end_date = Carbon::today()->format('Y-m-d');
        $job->save();

        return response()->json(['success' => true]);
    }


    public function extendExpiryDate(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'job_id' => 'required|exists:job_openings,id',
            'end_date' => 'required|date',
        ]);

        // Find the job and update the expiry date
        $job = JobOpening::find($validated['job_id']);
        $job->application_period_end_date = Carbon::parse($validated['end_date'])->format('Y-m-d');
        $job->status = 2;
        $job->save();

        return response()->json(['success' => true]);
    }


    public function launchAdvertisement(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'job_id' => 'required|exists:job_openings,id',
            'start_date' => 'required|date',
            'status' => 'required|in:1,2,3,4,5',  // Assuming these are valid status values
        ]);

        // Find the job and update the start date and status
        $job = JobOpening::find($validated['job_id']);
        $job->application_period_start_date = Carbon::parse($validated['start_date'])->format('Y-m-d');
        $job->status = $validated['status'];
        $job->save();

        return response()->json(['success' => true]);
    }






}
