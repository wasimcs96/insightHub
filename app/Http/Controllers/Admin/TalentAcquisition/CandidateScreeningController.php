<?php

namespace App\Http\Controllers\Admin\TalentAcquisition;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobOpeningApplication;
use App\Models\Department;
use App\Models\JobOpening;
use App\Models\JobCriticalFunction;
use App\Models\JobSkill;
use App\Models\JobTechnicalSkill;
use App\Models\Job;
use App\Models\User;
use App\Models\UserResult;
use App\Models\UserJobPreferredLocation;
use App\Models\MasterInterviewQuestion;
use App\Models\JobOpeningApplicationInterviewResponse;
use DB;
use Carbon\Carbon;
use Config;
use Auth;


class CandidateScreeningController extends Controller
{
    // public function upcoming_index(Request $request)
    // {
    //     // Fetch JobOpeningApplications and eager load jobOpenings and jobs
    //     $query = JobOpeningApplication::join('job_openings', 'job_opening_applications.job_opening_id', '=', 'job_openings.id')
    //         ->join('jobs', 'job_openings.job_id', '=', 'jobs.id') // Joining jobs table
    //         ->select('job_opening_applications.*', 'jobs.title as job_title'); // Select all job application fields and the job title

    //     if(auth()->user()->company_id) {
    //         $company_id = auth()->user()->company_id;
    //     } else {
    //         $company_id = 3;
    //     }

    //     $departmentsWithApplications = JobOpeningApplication::join('job_openings', 'job_opening_applications.job_opening_id', '=', 'job_openings.id')
    //         ->join('departments', 'job_openings.department_id', '=', 'departments.id')  // Join with departments table using department_id
    //         ->select('departments.id as department_id', 'departments.name as department_name', DB::raw('COUNT(job_opening_applications.id) as application_count'))
    //         ->groupBy('departments.id', 'departments.name') // Group by department_id and department_name
    //         ->get();

    //     $jobOpeningsWithCount = JobOpening::leftJoin('job_opening_applications', 'job_openings.id', '=', 'job_opening_applications.job_opening_id')
    //         ->select('job_openings.id', 'job_openings.job_title', DB::raw('COUNT(job_opening_applications.id) as application_count'))
    //         ->groupBy('job_openings.id')
    //         ->having('application_count', '>', 0)
    //         ->get();

    //     $interviewModeCounts = JobOpeningApplication::select('interview_mode', DB::raw('COUNT(*) as application_count'))
    //         ->groupBy('interview_mode')
    //         ->get()
    //         ->keyBy('interview_mode');

    //     $interviewTypes = config('helpers.interview_mode');

    //      // Apply date filters based on the selected range
    //     $startDate = null;
    //     $endDate = null;
    //     $currentDate = now()->toDateString(); // Get current date in YYYY-MM-DD format

    //     // If the user selected 'Today', filter by today's date
    //     if ($request->filled('date_range') && $request->date_range === 'today') {
    //         $startDate = $currentDate;
    //         $endDate = $currentDate;
    //     }

    //     // If the user selected 'This Week', filter by the current week
    //     if ($request->filled('date_range') && $request->date_range === 'week') {
    //         $startDate = now()->startOfWeek()->toDateString(); // Get the start of the current week
    //         $endDate = now()->endOfWeek()->toDateString(); // Get the end of the current week
    //     }

    //     // If the user selected 'This Month', filter by the current month
    //     if ($request->filled('date_range') && $request->date_range === 'month') {
    //         $startDate = now()->startOfMonth()->toDateString(); // Get the start of the current month
    //         $endDate = now()->endOfMonth()->toDateString(); // Get the end of the current month
    //     }

    //     // dd($startDate,$endDate);
    //     // Apply date range filter if any
    //     if ($startDate && $endDate) {
    //         $query->whereBetween('job_opening_applications.interview_date', [$startDate, $endDate]);
    //     }

    //      // Apply filters
    //     if ($request->filled('department_id')) {
    //         // Filter by department ID from the job_opening table
    //         $query->join('departments', 'job_openings.department_id', '=', 'departments.id')
    //             ->where('departments.id', $request->department_id);
    //     }

    //     if ($request->filled('job_position_id')) {
    //         // Filter by job position (job_opening_id)
    //         $query->where('job_opening_applications.job_opening_id', $request->job_position_id);
    //     }

    //     if ($request->filled('interview_mode')) {
    //         // Filter by interview mode
    //         $query->where('job_opening_applications.interview_mode', $request->interview_mode);
    //     }
        

    //     $perPage = $request->input('per_page', 10); // Default to 10 items per page
    //     $jobApplications = $query->paginate($perPage); // Apply pagination

    //     // Return the data to the view
    //     if ($request->ajax()) {
    //         return response()->json([
    //             'html' => view('admin.talent-acquisition.candidate-screening.upcoming-interview.left-table', compact('jobApplications'))->render(),
    //             'pagination' => $jobApplications->links(), // Use built-in pagination
    //             'total_count' => $jobApplications->total(),
    //             'current_page' => $jobApplications->currentPage(),
    //             'last_page' => $jobApplications->lastPage(),
    //         ]);
    //     }

    //     // Full page load for non-AJAX request
    //     return view('admin.talent-acquisition.candidate-screening.upcoming-interview.index', compact('jobApplications', 'departmentsWithApplications', 'jobOpeningsWithCount', 'interviewModeCounts', 'interviewTypes'));
    // }

    public function upcoming_index(Request $request)
    {
        // Fetch JobOpeningApplications and eager load jobOpenings and jobs
        $query = JobOpeningApplication::join('job_openings', 'job_opening_applications.job_opening_id', '=', 'job_openings.id')
            ->join('jobs', 'job_openings.job_id', '=', 'jobs.id') // Joining jobs table
            ->where('job_opening_applications.status', 6)
            ->select('job_opening_applications.*', 'jobs.title as job_title'); // Select all job application fields and the job title

        if(auth()->user()->company_id) {
            $company_id = auth()->user()->company_id;
        } else {
            $company_id = 3;
        }

        $departmentsWithApplications = JobOpeningApplication::join('job_openings', 'job_opening_applications.job_opening_id', '=', 'job_openings.id')
            ->join('departments', 'job_openings.department_id', '=', 'departments.id')  // Join with departments table using department_id
            ->select('departments.id as department_id', 'departments.name as department_name', DB::raw('COUNT(job_opening_applications.id) as application_count'))
            ->groupBy('departments.id', 'departments.name') // Group by department_id and department_name
            ->where('job_opening_applications.status', 6)
            ->get();

        $jobOpeningsWithCount = JobOpening::leftJoin('job_opening_applications', 'job_openings.id', '=', 'job_opening_applications.job_opening_id')
            ->where('job_opening_applications.status', 6)
            ->select('job_openings.id', 'job_openings.job_title', DB::raw('COUNT(job_opening_applications.id) as application_count'))
            ->groupBy('job_openings.id')
            ->having('application_count', '>', 0)
            ->get();

        $interviewModeCounts = JobOpeningApplication::select('interview_mode', DB::raw('COUNT(*) as application_count'))
            ->groupBy('interview_mode')
            ->where('job_opening_applications.status', 6)
            ->get()
            ->keyBy('interview_mode');

        $interviewTypes = config('helpers.interview_mode');

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        if ($startDate && $endDate) {
            $query->whereBetween(DB::raw('DATE(job_opening_applications.interview_date)'), [$startDate, $endDate]);
        }

         // Apply filters
        if ($request->filled('department_id')) {
            // Filter by department ID from the job_opening table
            $query->join('departments', 'job_openings.department_id', '=', 'departments.id')
                ->where('departments.id', $request->department_id);
        }

        if ($request->filled('job_position_id')) {
            // Filter by job position (job_opening_id)
            $query->where('job_opening_applications.job_opening_id', $request->job_position_id);
        }

        if ($request->filled('interview_mode')) {
            // Filter by interview mode
            $query->where('job_opening_applications.interview_mode', $request->interview_mode);
        }
        

        $perPage = $request->input('per_page', 10); // Default to 10 items per page
        $jobApplications = $query->paginate($perPage); // Apply pagination

        // Return the data to the view
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.talent-acquisition.candidate-screening.upcoming-interview.left-table', compact('jobApplications'))->render(),
                'pagination' => $jobApplications->links(), // Use built-in pagination
                'total_count' => $jobApplications->total(),
                'current_page' => $jobApplications->currentPage(),
                'last_page' => $jobApplications->lastPage(),
            ]);
        }

        // Full page load for non-AJAX request
        return view('admin.talent-acquisition.candidate-screening.upcoming-interview.index', compact('jobApplications', 'departmentsWithApplications', 'jobOpeningsWithCount', 'interviewModeCounts', 'interviewTypes'));
    }


    // public function conduct_index(Request $request)
    // {
    //     // Fetch JobOpeningApplications and eager load jobOpenings and jobs
    //     $query = JobOpeningApplication::join('job_openings', 'job_opening_applications.job_opening_id', '=', 'job_openings.id')
    //         ->join('jobs', 'job_openings.job_id', '=', 'jobs.id') // Joining jobs table
    //         ->where('job_opening_applications.status', 7)
    //         ->select('job_opening_applications.*', 'jobs.title as job_title'); // Select all job application fields and the job title

    //     if(auth()->user()->company_id) {
    //         $company_id = auth()->user()->company_id;
    //     } else {
    //         $company_id = 3;
    //     }

    //     $departmentsWithApplications = JobOpeningApplication::join('job_openings', 'job_opening_applications.job_opening_id', '=', 'job_openings.id')
    //         ->join('departments', 'job_openings.department_id', '=', 'departments.id')  // Join with departments table using department_id
    //         ->select('departments.id as department_id', 'departments.name as department_name', DB::raw('COUNT(job_opening_applications.id) as application_count'))
    //         ->groupBy('departments.id', 'departments.name') // Group by department_id and department_name
    //         ->get();

    //     $jobOpeningsWithCount = JobOpening::leftJoin('job_opening_applications', 'job_openings.id', '=', 'job_opening_applications.job_opening_id')
    //         ->select('job_openings.id', 'job_openings.job_title', DB::raw('COUNT(job_opening_applications.id) as application_count'))
    //         ->groupBy('job_openings.id')
    //         ->having('application_count', '>', 0)
    //         ->get();

    //     $interviewModeCounts = JobOpeningApplication::select('interview_mode', DB::raw('COUNT(*) as application_count'))
    //         ->groupBy('interview_mode')
    //         ->get()
    //         ->keyBy('interview_mode');

    //     $interviewTypes = config('helpers.interview_mode');

    //   // Apply date filters based on the selected range
    //     $date = $request->input('date'); // Get the selected date (e.g., '2025-03-16')
    //     // dd($date);

    //     // if ($request->filled('date')) {
    //     //     $query->whereDate('job_opening_applications.interview_date', '=', $date);
    //     // }

    //      // Apply filters
    //     if ($request->filled('department_id')) {
    //         // Filter by department ID from the job_opening table
    //         $query->join('departments', 'job_openings.department_id', '=', 'departments.id')
    //             ->where('departments.id', $request->department_id);
    //     }

    //     if ($request->filled('job_position_id')) {
    //         // Filter by job position (job_opening_id)
    //         $query->where('job_opening_applications.job_opening_id', $request->job_position_id);
    //     }

    //     if ($request->filled('interview_mode')) {
    //         // Filter by interview mode
    //         $query->where('job_opening_applications.interview_mode', $request->interview_mode);
    //     }
        

    //     $perPage = $request->input('per_page', 10); // Default to 10 items per page
    //     $jobApplications = $query->paginate($perPage); // Apply pagination

    //     // Return the data to the view
    //     if ($request->ajax()) {
    //         return response()->json([
    //             'html' => view('admin.talent-acquisition.candidate-screening.interview-conducted.left-table', compact('jobApplications'))->render(),
    //             'pagination' => $jobApplications->links(), // Use built-in pagination
    //             'total_count' => $jobApplications->total(),
    //             'current_page' => $jobApplications->currentPage(),
    //             'last_page' => $jobApplications->lastPage(),
    //         ]);
    //     }

    //     // Full page load for non-AJAX request
    //     return view('admin.talent-acquisition.candidate-screening.interview-conducted.index', compact('jobApplications', 'departmentsWithApplications', 'jobOpeningsWithCount', 'interviewModeCounts', 'interviewTypes'));
    // }
    

    // public function conduct_index(Request $request)
    // {
    //     // Base query: join job_openings and jobs
    //     $query = JobOpeningApplication::join('job_openings', 'job_opening_applications.job_opening_id', '=', 'job_openings.id')
    //         ->join('jobs', 'job_openings.job_id', '=', 'jobs.id')
    //         ->where('job_opening_applications.status', 7)
    //         ->select('job_opening_applications.*', 'job_openings.job_id', 'jobs.title as job_title');

    //     if (auth()->user()->company_id) {
    //         $company_id = auth()->user()->company_id;
    //     } else {
    //         $company_id = 3;
    //     }

    //     // Optional filters
    //     if ($request->filled('department_id')) {
    //         $query->join('departments', 'job_openings.department_id', '=', 'departments.id')
    //             ->where('departments.id', $request->department_id);
    //     }

    //     if ($request->filled('job_position_id')) {
    //         $query->where('job_opening_applications.job_opening_id', $request->job_position_id);
    //     }

    //     if ($request->filled('interview_mode')) {
    //         $query->where('job_opening_applications.interview_mode', $request->interview_mode);
    //     }

    //     $perPage = $request->input('per_page', 10);
    //     $jobApplications = $query->paginate($perPage);

    //     // Get all interview descriptors
    //     $interviewDescriptions = DB::table('master_descriptors')
    //         ->where('assessment_type', 'interview')
    //         ->where('result_type', 'interview')
    //         ->get();

    //     // Loop each application and calculate interview score
    //     foreach ($jobApplications as $application) {
    //         // Get total possible score based only on option_3_score
    //         $totalMarks = DB::table('master_interview_questions')
    //             ->where('job_id', $application->job_id)
    //             ->sum('option_3_score');

    //         // Get obtained marks from responses
    //         $obtainedMarks = DB::table('job_opening_application_interview_responses')
    //             ->where('job_opening_application_id', $application->id)
    //             ->sum('marks');

    //         $application->interview_score = 0;
    //         $application->interview_level = 0;
    //         $application->performance_rating = 'Not Available';

    //         if ($totalMarks > 0) {
    //             $percentage = ($obtainedMarks / $totalMarks) * 100;

    //             // Determine level
    //             if ($percentage > 90) {
    //                 $level = 5;
    //             } elseif ($percentage > 75) {
    //                 $level = 4;
    //             } elseif ($percentage >= 60) {
    //                 $level = 3;
    //             } elseif ($percentage >= 45) {
    //                 $level = 2;
    //             } else {
    //                 $level = 1;
    //             }

    //             $descriptor = $interviewDescriptions->where('user_score_level', $level)->first();

    //             $application->interview_score = $percentage;
    //             $application->interview_level = $level;
    //             $application->performance_rating = $descriptor->user_score_level_description ?? 'Not Available';
    //         }
    //     }

    //     // Load other required data
    //     $departmentsWithApplications = JobOpeningApplication::join('job_openings', 'job_opening_applications.job_opening_id', '=', 'job_openings.id')
    //         ->join('departments', 'job_openings.department_id', '=', 'departments.id')
    //         ->select('departments.id as department_id', 'departments.name as department_name', DB::raw('COUNT(job_opening_applications.id) as application_count'))
    //         ->groupBy('departments.id', 'departments.name')
    //         ->get();

    //     $jobOpeningsWithCount = JobOpening::leftJoin('job_opening_applications', 'job_openings.id', '=', 'job_opening_applications.job_opening_id')
    //         ->select('job_openings.id', 'job_openings.job_title', DB::raw('COUNT(job_opening_applications.id) as application_count'))
    //         ->groupBy('job_openings.id')
    //         ->having('application_count', '>', 0)
    //         ->get();

    //     $interviewModeCounts = JobOpeningApplication::select('interview_mode', DB::raw('COUNT(*) as application_count'))
    //         ->groupBy('interview_mode')
    //         ->get()
    //         ->keyBy('interview_mode');

    //     $interviewTypes = config('helpers.interview_mode');

    //     if ($request->ajax()) {
    //         return response()->json([
    //             'html' => view('admin.talent-acquisition.candidate-screening.interview-conducted.left-table', compact('jobApplications'))->render(),
    //             'pagination' => $jobApplications->links(),
    //             'total_count' => $jobApplications->total(),
    //             'current_page' => $jobApplications->currentPage(),
    //             'last_page' => $jobApplications->lastPage(),
    //         ]);
    //     }

    //     return view('admin.talent-acquisition.candidate-screening.interview-conducted.index', compact(
    //         'jobApplications',
    //         'departmentsWithApplications',
    //         'jobOpeningsWithCount',
    //         'interviewModeCounts',
    //         'interviewTypes'
    //     ));
    // }

    public function conduct_index(Request $request)
{
    // Base query
    $query = JobOpeningApplication::join('job_openings', 'job_opening_applications.job_opening_id', '=', 'job_openings.id')
        ->join('jobs', 'job_openings.job_id', '=', 'jobs.id')
        ->where('job_opening_applications.status', 7)
        ->select('job_opening_applications.*', 'job_openings.job_id', 'jobs.title as job_title');

    // Apply date filters based on the selected range
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    // dd($startDate, $endDate);

    if ($startDate && $endDate) {
        $query->whereBetween(DB::raw('DATE(job_opening_applications.interview_date)'), [$startDate, $endDate]);
    }

    // Apply filters
    if ($request->filled('department_id')) {
        $query->join('departments', 'job_openings.department_id', '=', 'departments.id')
            ->where('departments.id', $request->department_id);
    }

    if ($request->filled('job_position_id')) {
        $query->where('job_opening_applications.job_opening_id', $request->job_position_id);
    }

    if ($request->filled('interview_mode')) {
        $query->where('job_opening_applications.interview_mode', $request->interview_mode);
    }

    if ($request->filled('selection_matrix')) {
        $matrixLevels = explode(',', $request->selection_matrix); // Get an array of selected values
        $query->whereIn('job_opening_applications.selection_matrix_level', $matrixLevels);
    }

    if ($request->filled('performance_levels')) {
        $filters = explode(',', strtolower($request->performance_levels));
    
        $interviewDescriptions = DB::table('master_descriptors')
            ->where('assessment_type', 'interview')
            ->where('result_type', 'interview')
            ->get()
            ->keyBy('user_score_level');
    
        // Get total marks per job_id (option_3_score only)
        $jobTotals = DB::table('master_interview_questions')
            ->select('job_id', DB::raw('SUM(option_3_score) as total_score'))
            ->groupBy('job_id')
            ->pluck('total_score', 'job_id'); // job_id => total
    
        // Get obtained marks per application
        $appScores = DB::table('job_opening_application_interview_responses')
            ->select('job_opening_application_id', DB::raw('SUM(marks) as obtained'))
            ->groupBy('job_opening_application_id')
            ->pluck('obtained', 'job_opening_application_id'); // app_id => obtained
    
        // Get application IDs with job_id mapping
        $allApplications = JobOpeningApplication::join('job_openings', 'job_opening_applications.job_opening_id', '=', 'job_openings.id')
            ->select('job_opening_applications.id', 'job_openings.job_id')
            ->get();
    
        $matchingAppIds = [];
    
        foreach ($allApplications as $app) {
            $total = $jobTotals[$app->job_id] ?? 0;
            $obtained = $appScores[$app->id] ?? 0;
    
            if ($total > 0) {
                $percentage = ($obtained / $total) * 100;
    
                $level = match (true) {
                    $percentage > 90 => 5,
                    $percentage > 75 => 4,
                    $percentage >= 60 => 3,
                    $percentage >= 45 => 2,
                    default => 1,
                };
    
                $desc = strtolower($interviewDescriptions[$level]->user_score_level_description ?? '');
                if (in_array($desc, $filters)) {
                    $matchingAppIds[] = $app->id;
                }
            }
        }
    
        // Apply to main query
        $query->whereIn('job_opening_applications.id', $matchingAppIds);
    }
    

    $perPage = $request->input('per_page', 10);
    $jobApplications = $query->paginate($perPage);

    // Load descriptors
    $interviewDescriptions = DB::table('master_descriptors')
        ->where('assessment_type', 'interview')
        ->where('result_type', 'interview')
        ->get();

    // Initialize counts
    $interviewPerformanceCounts = collect([
        'Very High' => 0,
        'High' => 0,
        'Moderate' => 0,
        'Low' => 0,
        'Very Low' => 0,
    ]);

    foreach ($jobApplications as $application) {
        $totalMarks = DB::table('master_interview_questions')
            ->where('job_id', $application->job_id)
            ->sum('option_3_score');
    
        $obtainedMarks = DB::table('job_opening_application_interview_responses')
            ->where('job_opening_application_id', $application->id)
            ->sum('marks');
    
        $application->interview_score = 0;
        $application->performance_rating = 'Not Available';
    
        if ($totalMarks > 0) {
            $percentage = ($obtainedMarks / $totalMarks) * 100;
    
            $level = match (true) {
                $percentage > 90 => 5,
                $percentage > 75 => 4,
                $percentage >= 60 => 3,
                $percentage >= 45 => 2,
                default => 1,
            };
    
            $descriptor = $interviewDescriptions->where('user_score_level', $level)->first();
            $rating = $descriptor->user_score_level_description ?? 'Not Available';
    
            $application->interview_score = $percentage;
            $application->performance_rating = $rating;
    
            // Count it
            $key = ucwords(strtolower($rating));
            $interviewPerformanceCounts->put($key, $interviewPerformanceCounts->get($key, 0) + 1);
        }
    }

    $selectionMatrixLevels = [
        0 => 'Data Not Available',
        1 => 'Reject',
        2 => 'Review',
        3 => 'Consider Further',
        4 => 'Hire'
    ];
    
    // Map the selection_matrix string to each application
    foreach ($jobApplications as $application) {
        $application->selection_matrix = $selectionMatrixLevels[$application->selection_matrix_level] ?? 'Unknown';
    }

    $selectionMatrixCounts = JobOpeningApplication::where('status', 7)
    ->select('selection_matrix_level', DB::raw('COUNT(*) as count'))
    ->where('job_opening_applications.status', 7)
    ->groupBy('selection_matrix_level')
    ->pluck('count', 'selection_matrix_level');
    

    // Dropdown data
    $departmentsWithApplications = JobOpeningApplication::join('job_openings', 'job_opening_applications.job_opening_id', '=', 'job_openings.id')
        ->join('departments', 'job_openings.department_id', '=', 'departments.id')
        ->select('departments.id as department_id', 'departments.name as department_name', DB::raw('COUNT(job_opening_applications.id) as application_count'))
        ->groupBy('departments.id', 'departments.name')
        ->where('job_opening_applications.status', 7)
        ->get();

    $jobOpeningsWithCount = JobOpening::leftJoin('job_opening_applications', 'job_openings.id', '=', 'job_opening_applications.job_opening_id')
        ->select('job_openings.id', 'job_openings.job_title', DB::raw('COUNT(job_opening_applications.id) as application_count'))
        ->groupBy('job_openings.id')
        ->having('application_count', '>', 0)
        ->where('job_opening_applications.status', 7)
        ->get();

    $interviewModeCounts = collect(); // You can extend this too later
    $interviewTypes = config('helpers.interview_mode');

    // AJAX response
    if ($request->ajax()) {
        return response()->json([
            'html' => view('admin.talent-acquisition.candidate-screening.interview-conducted.left-table',
                compact('jobApplications'))->render(),
            'pagination' => $jobApplications->links(),
            'total_count' => $jobApplications->total(),
            'current_page' => $jobApplications->currentPage(),
            'last_page' => $jobApplications->lastPage(),
        ]);
    }

    // Page view
    return view('admin.talent-acquisition.candidate-screening.interview-conducted.index', compact(
        'jobApplications',
        'departmentsWithApplications',
        'jobOpeningsWithCount',
        'interviewModeCounts',
        'interviewTypes',
        'interviewPerformanceCounts',
        'selectionMatrixCounts'
    ));
}




    // public function getInterviewInfo($applicationId)
    // {
    //     try {
    //         // Fetch application details along with job_opening_id
    //         $application = JobOpeningApplication::where('job_opening_applications.id', $applicationId)
    //             ->join('job_openings', 'job_opening_applications.job_opening_id', '=', 'job_openings.id')
    //             ->join('jobs', 'job_openings.job_id', '=', 'jobs.id')
    //             ->join('departments', 'job_openings.department_id', '=', 'departments.id')
    //             ->select(
    //                 'job_opening_applications.*',
    //                 'job_openings.id as job_opening_id',
    //                 'job_openings.job_id',
    //                 'jobs.title as job_title',
    //                 'jobs.description as job_description',
    //                 'departments.name as department_name',
    //                 'job_opening_applications.interview_date',
    //                 'job_opening_applications.interview_mode',
    //                 'job_opening_applications.interview_link',
    //                 'job_opening_applications.interviewer_name'
    //             )
    //             ->first();

    //         if (!$application) {
    //             return response()->json(['success' => false, 'message' => 'Application not found.'], 404);
    //         }

    //         // Format interview date & time
    //         $formattedDate = Carbon::parse($application->interview_date)->format('d M, Y');
    //         $formattedTime = Carbon::parse($application->interview_date)->format('h:i A');

    //         // Get interview type from config (helpers.php)
    //         $interviewTypes = Config::get('helpers.interview_mode', []);
    //         $interviewType = $interviewTypes[$application->interview_mode] ?? 'Unknown';

    //         // Fetch Job details with relationships
    //         $job = Job::with(['criticalFunctions.cwfKeys', 'skills', 'technicalSkills'])
    //             ->where('id', $application->job_id)
    //             ->first();

    //         if (!$job) {
    //             return response()->json(['success' => false, 'message' => 'Job not found.'], 404);
    //         }

    //         // Retrieve Critical Work Functions and their Keys
    //         $criticalWorkFunctions = $job->criticalFunctions->map(function ($cwf) {
    //             return [
    //                 'description' => $cwf->description,
    //                 'keys' => $cwf->cwfKeys->pluck('name')->toArray()
    //             ];
    //         })->toArray();

    //         // Retrieve Soft Skills and Technical Skills
    //         $softSkills = $job->skills->pluck('title')->toArray();
    //         $technicalSkills = $job->technicalSkills->pluck('name')->toArray();

    //         return response()->json([
    //             'success' => true,
    //             'candidate_name' => $application->external_user_name,
    //             'interview_date' => $formattedDate,
    //             'interview_time' => $formattedTime,
    //             'job_position' => $application->job_title,
    //             'interview_type' => $interviewType,
    //             'interview_link' => $application->interview_link ?? '#',
    //             'interviewers' => explode(',', $application->interviewer_name),
    //             'job_role' => [
    //                 'department' => $application->department_name,
    //                 'name' => $application->job_title,
    //                 'description' => $application->job_description,
    //                 'critical_work_functions' => $criticalWorkFunctions,
    //             ],
    //             'soft_skills' => $softSkills,
    //             'technical_skills' => $technicalSkills,
    //             'company_overview' => 'Lorem ipsum dolor sit amet...',
    //             'compensation_benefits' => ['Medical Insurance', 'Retirement Fund', 'Paid Time Off']
    //         ]);

    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    //     }
    // }


    public function getInterviewInfo($applicationId)
    {
        try {
            // Fetch application details along with job_opening_id
            $application = JobOpeningApplication::where('job_opening_applications.id', $applicationId)
                ->join('job_openings', 'job_opening_applications.job_opening_id', '=', 'job_openings.id')
                ->join('jobs', 'job_openings.job_id', '=', 'jobs.id')
                ->join('departments', 'job_openings.department_id', '=', 'departments.id')
                ->leftJoin('master_company_overviews', 'job_openings.company_overview_id', '=', 'master_company_overviews.id')
                ->leftJoin('master_company_benefits', 'job_openings.company_benefit_id', '=', 'master_company_benefits.id')
                ->select(
                    'job_opening_applications.*',
                    'job_openings.id as job_opening_id',
                    'job_openings.job_id',
                    'jobs.title as job_title',
                    'jobs.description as job_description',
                    'departments.name as department_name',
                    'job_opening_applications.interview_date',
                    'job_opening_applications.interview_mode',
                    'job_opening_applications.interview_link',
                    'job_opening_applications.interviewer_name',
                    'master_company_overviews.description as company_overview',
                    'master_company_benefits.description as company_benefits'
                )
                ->first();

            if (!$application) {
                return response()->json(['success' => false, 'message' => 'Application not found.'], 404);
            }

            // Format interview date & time
            $formattedDate = Carbon::parse($application->interview_date)->format('d M, Y');
            $formattedTime = Carbon::parse($application->interview_date)->format('h:i A');

            // Get interview type from config (helpers.php)
            $interviewTypes = Config::get('helpers.interview_mode', []);
            $interviewType = $interviewTypes[$application->interview_mode] ?? 'Unknown';

            // Fetch Job details with relationships
            $job = Job::with(['criticalFunctions.cwfKeys', 'skills', 'technicalSkills'])
                ->where('id', $application->job_id)
                ->first();

            if (!$job) {
                return response()->json(['success' => false, 'message' => 'Job not found.'], 404);
            }

            // Retrieve Critical Work Functions and their Keys
            $criticalWorkFunctions = $job->criticalFunctions->map(function ($cwf) {
                return [
                    'description' => $cwf->description,
                    'keys' => $cwf->cwfKeys->pluck('name')->toArray()
                ];
            })->toArray();

            // Retrieve Soft Skills and Technical Skills
            $softSkills = $job->skills->pluck('title')->toArray();
            $technicalSkills = $job->technicalSkills->pluck('name')->toArray();

            return response()->json([
                'success' => true,
                'candidate_name' => $application->external_user_name,
                'interview_date' => $formattedDate,
                'interview_time' => $formattedTime,
                'job_position' => $application->job_title,
                'interview_type' => $interviewType,
                'interview_link' => $application->interview_link ?? '#',
                'interviewers' => explode(',', $application->interviewer_name),
                'job_role' => [
                    'department' => $application->department_name,
                    'name' => $application->job_title,
                    'description' => $application->job_description,
                    'critical_work_functions' => $criticalWorkFunctions,
                ],
                'soft_skills' => $softSkills,
                'technical_skills' => $technicalSkills,
                'company_overview' => $application->company_overview ?? 'No company overview available',
                'compensation_benefits' => $application->company_benefits ? explode(',', $application->company_benefits) : ['No benefits available']
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    // public function getConductInterviewInfo($applicationId)
    // {
    //     try {
    //         // Fetch application details along with job_opening_id
    //         $application = JobOpeningApplication::where('job_opening_applications.id', $applicationId)
    //             ->join('job_openings', 'job_opening_applications.job_opening_id', '=', 'job_openings.id')
    //             ->join('jobs', 'job_openings.job_id', '=', 'jobs.id')
    //             ->join('departments', 'job_openings.department_id', '=', 'departments.id')
    //             ->leftJoin('master_company_overviews', 'job_openings.company_overview_id', '=', 'master_company_overviews.id')
    //             ->leftJoin('master_company_benefits', 'job_openings.company_benefit_id', '=', 'master_company_benefits.id')
    //             ->select(
    //                 'job_opening_applications.*',
    //                 'job_openings.id as job_opening_id',
    //                 'job_openings.job_id',
    //                 'jobs.title as job_title',
    //                 'jobs.description as job_description',
    //                 'departments.name as department_name',
    //                 'job_opening_applications.interview_date',
    //                 'job_opening_applications.interview_mode',
    //                 'job_opening_applications.interview_link',
    //                 'job_opening_applications.interviewer_name',
    //                 'master_company_overviews.description as company_overview',
    //                 'master_company_benefits.description as company_benefits'
    //             )
    //             ->first();

    //         if (!$application) {
    //             return response()->json(['success' => false, 'message' => 'Application not found.'], 404);
    //         }

    //         // Format interview date & time
    //         $formattedDate = Carbon::parse($application->interview_date)->format('d M, Y');
    //         $formattedTime = Carbon::parse($application->interview_date)->format('h:i A');

    //         // Get interview type from config (helpers.php)
    //         $interviewTypes = Config::get('helpers.interview_mode', []);
    //         $interviewType = $interviewTypes[$application->interview_mode] ?? 'Unknown';

    //         // Fetch Job details with relationships
    //         $job = Job::with(['criticalFunctions.cwfKeys', 'skills', 'technicalSkills'])
    //             ->where('id', $application->job_id)
    //             ->first();

    //         if (!$job) {
    //             return response()->json(['success' => false, 'message' => 'Job not found.'], 404);
    //         }

    //         // Retrieve Critical Work Functions and their Keys
    //         $criticalWorkFunctions = $job->criticalFunctions->map(function ($cwf) {
    //             return [
    //                 'description' => $cwf->description,
    //                 'keys' => $cwf->cwfKeys->pluck('name')->toArray()
    //             ];
    //         })->toArray();

    //         // Retrieve Soft Skills and Technical Skills
    //         $softSkills = $job->skills->pluck('title')->toArray();
    //         $technicalSkills = $job->technicalSkills->pluck('name')->toArray();

    //         return response()->json([
    //             'success' => true,
    //             'candidate_name' => $application->external_user_name,
    //             'interview_date' => $formattedDate,
    //             'interview_time' => $formattedTime,
    //             'job_position' => $application->job_title,
    //             'interview_type' => $interviewType,
    //             'interview_link' => $application->interview_link ?? '#',
    //             'interviewers' => explode(',', $application->interviewer_name),
    //             'job_role' => [
    //                 'department' => $application->department_name,
    //                 'name' => $application->job_title,
    //                 'description' => $application->job_description,
    //                 'critical_work_functions' => $criticalWorkFunctions,
    //             ],
    //             'soft_skills' => $softSkills,
    //             'technical_skills' => $technicalSkills,
    //             'company_overview' => $application->company_overview ?? 'No company overview available',
    //             'compensation_benefits' => $application->company_benefits ? explode(',', $application->company_benefits) : ['No benefits available']
    //         ]);

    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    //     }
    // }

    // public function getConductInterviewInfo($applicationId)
    // {
    //     try {
    //         // Fetch application details for the selected candidate
    //         $application = JobOpeningApplication::where('job_opening_applications.id', $applicationId)
    //             ->join('job_openings', 'job_opening_applications.job_opening_id', '=', 'job_openings.id')
    //             ->join('jobs', 'job_openings.job_id', '=', 'jobs.id')
    //             ->select(
    //                 'job_opening_applications.id as application_id',
    //                 'job_opening_applications.user_id',
    //                 'job_openings.id as job_opening_id',
    //                 'jobs.title as job_title',
    //                 'job_opening_applications.external_user_name',
    //                 'job_opening_applications.interview_date',
    //                 'job_opening_applications.interview_mode',
    //                 'job_opening_applications.interview_link'
    //             )
    //             ->first();

    //         if (!$application) {
    //             return response()->json(['success' => false, 'message' => 'Application not found.'], 404);
    //         }

    //         // Fetch all interview questions related to this job opening
    //         $interviewQuestions = DB::table('master_interview_questions')
    //             ->where('job_id', $application->job_opening_id)
    //             ->select(
    //                 'id as question_id',
    //                 'question_number',
    //                 'title',
    //                 'option_1_score',
    //                 'option_2_score',
    //                 'option_3_score',
    //                 'option_4_score'
    //             )
    //             ->get();

    //         // Fetch interview responses and link them with questions
    //         $interviewResponses = DB::table('job_opening_application_interview_responses')
    //             ->where('job_opening_application_id', $applicationId)
    //             ->select(
    //                 'master_interview_question_id as question_id',
    //                 'marks',
    //                 'comment'
    //             )
    //             ->get();

    //         // Convert responses into an associative array for easy lookup
    //         $responsesMap = [];
    //         foreach ($interviewResponses as $response) {
    //             $responsesMap[$response->question_id] = [
    //                 'marks' => $response->marks,
    //                 'comment' => $response->comment
    //             ];
    //         }

    //         return response()->json([
    //             'success' => true,
    //             'candidate_name' => $application->external_user_name,
    //             'job_position' => $application->job_title,
    //             'interview_date' => Carbon::parse($application->interview_date)->format('d M, Y'),
    //             'interview_time' => Carbon::parse($application->interview_date)->format('h:i A'),
    //             'interview_mode' => $application->interview_mode,
    //             'interview_link' => $application->interview_link ?? '#',
    //             'interview_questions' => $interviewQuestions,
    //             'interview_responses' => $responsesMap
    //         ]);

    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    //     }
    // }

//     public function getConductInterviewInfo($applicationId)
// {
//     try {
//         // Fetch application details with job title and candidate name
//         $application = JobOpeningApplication::where('job_opening_applications.id', $applicationId)
//             ->join('job_openings', 'job_opening_applications.job_opening_id', '=', 'job_openings.id')
//             ->join('jobs', 'job_openings.job_id', '=', 'jobs.id')
//             ->select(
//                 'job_opening_applications.*',
//                 'jobs.title as job_title',
//                 'job_opening_applications.external_user_name as candidate_name'
//             )
//             ->first();

//         if (!$application) {
//             return response()->json(['success' => false, 'message' => 'Application not found.'], 404);
//         }

//         // Fetch interview responses and related questions
//         $interviewResponses = DB::table('job_opening_application_interview_responses')
//             ->join('master_interview_questions', 'job_opening_application_interview_responses.master_interview_question_id', '=', 'master_interview_questions.id')
//             ->where('job_opening_application_interview_responses.job_opening_application_id', $applicationId)
//             ->select(
//                 'master_interview_questions.id as question_id',
//                 'master_interview_questions.question_number',
//                 'master_interview_questions.title',
//                 'master_interview_questions.option_1_score',
//                 'master_interview_questions.option_2_score',
//                 'master_interview_questions.option_3_score',
//                 'master_interview_questions.option_4_score',
//                 'job_opening_application_interview_responses.marks',
//                 'job_opening_application_interview_responses.comment'
//             )
//             ->get();

//         return response()->json([
//             'success' => true,
//             'candidate_name' => $application->candidate_name,
//             'job_position' => $application->job_title,
//             'interview_questions' => $interviewResponses,
//             'comment' => $interviewResponses->pluck('comment')->filter()->first() ?? ''
//         ]);

//     } catch (\Exception $e) {
//         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
//     }
// }


public function getConductInterviewInfo($applicationId)
{
    try {
        // Fetch application with job_id and other info
        $application = JobOpeningApplication::where('job_opening_applications.id', $applicationId)
            ->join('job_openings', 'job_opening_applications.job_opening_id', '=', 'job_openings.id')
            ->join('jobs', 'job_openings.job_id', '=', 'jobs.id')
            ->select(
                'job_opening_applications.*',
                'job_openings.job_id',
                'jobs.title as job_title',
                'job_opening_applications.external_user_name as candidate_name'
            )
            ->first();

        if (!$application) {
            return response()->json(['success' => false, 'message' => 'Application not found.'], 404);
        }

        // Fetch interview responses and questions
        $interviewResponses = DB::table('job_opening_application_interview_responses')
            ->join('master_interview_questions', 'job_opening_application_interview_responses.master_interview_question_id', '=', 'master_interview_questions.id')
            ->where('job_opening_application_interview_responses.job_opening_application_id', $applicationId)
            ->select(
                'master_interview_questions.id as question_id',
                'master_interview_questions.question_number',
                'master_interview_questions.title',
                'master_interview_questions.option_1_score',
                'master_interview_questions.option_2_score',
                'master_interview_questions.option_3_score',
                'master_interview_questions.option_4_score',
                'job_opening_application_interview_responses.marks',
                'job_opening_application_interview_responses.comment'
            )
            ->get();

        // Calculate total marks using option_3_score
        $totalMarks = DB::table('master_interview_questions')
            ->where('job_id', $application->job_id)
            ->sum('option_3_score');

        $obtainedMarks = DB::table('job_opening_application_interview_responses')
            ->where('job_opening_application_id', $applicationId)
            ->sum('marks');

        $interview_score = 0;
        $interview_level = 0;
        $interview_description = 'Not Available';

        if ($totalMarks > 0) {
            $percentage = ($obtainedMarks / $totalMarks) * 100;

            if ($percentage > 90) {
                $interview_level = 5;
            } elseif ($percentage > 75) {
                $interview_level = 4;
            } elseif ($percentage >= 60) {
                $interview_level = 3;
            } elseif ($percentage >= 45) {
                $interview_level = 2;
            } else {
                $interview_level = 1;
            }

            $descriptor = DB::table('master_descriptors')
                ->where('assessment_type', 'interview')
                ->where('result_type', 'interview')
                ->where('user_score_level', $interview_level)
                ->first();

            if ($descriptor) {
                $interview_description = $descriptor->user_score_level_description;
            }

            $interview_score = $percentage;
        }

        return response()->json([
            'success' => true,
            'candidate_name' => $application->candidate_name,
            'job_position' => $application->job_title,
            'interview_score' => round($interview_score, 1),
            'interview_performance_description' => strtoupper($interview_description),
            'interview_questions' => $interviewResponses,
            // 'comment' => $interviewResponses->pluck('comment')->filter()->first() ?? ''
            'selection_matrix_level' => $application->selection_matrix_level,
            'comment' => DB::table('job_opening_application_interview_responses')
                ->where('job_opening_application_id', $applicationId)
                ->whereNotNull('comment')
                ->orderBy('created_at', 'desc')
                ->value('comment') ?? '',
            'job_opening_id' => $application->job_opening_id,
            'application_id' => $application->id,

        ]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}









    // public function conductInterview(Request $request)
    // {
    //     // Retrieve application ID from sessionStorage (passed via GET request)
    //     $applicationId = $request->query('application_id');
    //     if (!$applicationId) {
    //         return redirect()->back()->with('error', 'No application ID provided');
    //     }

    //     // Fetch application details
    //     $application = JobOpeningApplication::where('id', $applicationId)->first();

    //     if (!$application) {
    //         return redirect()->back()->with('error', 'Application not found');
    //     }


    //     return view('admin.talent-acquisition.candidate-screening.upcoming-interview.conduct-interview', compact('application'));
    // }

    public function conductInterview(Request $request)
    {
        // Retrieve application ID from request
        $applicationId = $request->query('application_id');

        if (!$applicationId) {
            return redirect()->back()->with('error', 'No application ID provided');
        }

        // Fetch application details
        $application = JobOpeningApplication::where('id', $applicationId)->first();
        $userId = $application ? $application->user_id : null;

        if (!$application) {
            return redirect()->back()->with('error', 'Application not found');
        }

        // Fetch user details from Users table
        $user = User::where('id', $application->user_id)->first();

        // Fetch Suitability Rate from JobOpeningApplication
        $suitabilityRate = $application->suitability_rate ?? 'N/A';

        // Fetch Overall Match Rate from UserResult
        $employeeResults = UserResult::where('user_id', $application->user_id)
            ->where('slug', 'overall-match-rate')
            ->first();

        $overallMatchRateLevel = $employeeResults->level ?? 0;
        $overallMatchRate = config('helpers.overall_match_rate_levels')[$overallMatchRateLevel];

        // Fetch user documents
        $userDocuments = $user->cv_resume ?? 'N/A';

        // Fetch Personal Information
        $personalInfo = [
            'email' => $user->email ?? 'N/A',
            'phone' => $user->mobile_number ?? 'N/A',
            'current_location' => $user->cityName->name ?? 'N/A',
            'nationality' => $user->country->name ?? 'N/A',
            'address' => $user->home_address ?? 'N/A',
        ];

        $educationLevel = \App\Models\MasterEducationLevel::where('id', $user->education_level)->first();
        $educationLevelName = $educationLevel->name ?? 'N/A';

        $educationProgram = \App\Models\MasterEducationProgram::where('id', $user->education_program_id)->first();
        $educationProgramName = $educationProgram->name ?? 'N/A';

        // Fetch Education Information
        $educationInfo = [
            'education_level' => $educationLevelName,
            'graduation_year' => $user->graduate_year ?? 'N/A',
            'institution' => $user->higher_learning->name ?? 'N/A',
            'program' => $educationProgramName,
        ];

        // Fetch Job Preference
        $jobPreference = [
            'work_experience' => $user->year_of_experience_in_it_sector ?? 'N/A',
            'work_authorization' => $user->work_authorisation ? 'Yes' : 'No',
            'preferred_job' => $user->job_title ?? 'N/A',
            'expected_salary' => $user->job_expected_salary ?? 'N/A',
        ];

        // Fetch Preferred Working Locations
        $preferredLocations = UserJobPreferredLocation::where('user_id', $application->user_id)
            ->with('masterCity')
            ->get()
            ->pluck('masterCity.name')
            ->toArray();

        // Fetch job details
        $jobOpening = JobOpening::where('id', $application->job_opening_id)->first();
        $jobTitle = $jobOpening->job_title ?? 'N/A';

        if (!$jobOpening) {
            return redirect()->back()->with('error', 'Job Opening not found');
        }
    
        // Fetch job-related interview questions
        $interviewQuestions = MasterInterviewQuestion::where('job_id', $jobOpening->job_id)->get();

        return view('admin.talent-acquisition.candidate-screening.upcoming-interview.conduct-interview', compact(
            'application',
            'user',
            'suitabilityRate',
            'overallMatchRate',
            'userDocuments',
            'personalInfo',
            'educationInfo',
            'jobPreference',
            'preferredLocations',
            'interviewQuestions',
            'userId',
            'jobTitle'
        ));
    }

    public function conductInterviewResponse(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'job_opening_application_id' => 'required|exists:job_opening_applications,id',
            'application_id' => 'required|array',
            'application_id.*' => 'required|exists:master_interview_questions,id',
            'comment' => 'nullable|string',
        ]);

        $userId = $validated['user_id'];
        $interviewerId = Auth::id();
        $comment = $validated['comment'] ?? null;
        $jobOpeningId = $validated['job_opening_application_id'];
        $insertData = [];

        // Step 1: Save all question responses
        foreach ($validated['application_id'] as $applicationId) {
            $questionKey = 'question_' . $applicationId;

            if ($request->has($questionKey)) {
                $marks = $request->input($questionKey); // Get the selected marks

                $insertData[] = [
                    'user_id' => $userId,
                    'interviewer_id' => $interviewerId,
                    'job_opening_application_id' => $jobOpeningId,
                    'master_interview_question_id' => $applicationId,
                    'marks' => $marks,
                    'comment' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert all responses in a single query
        if (!empty($insertData)) {
            JobOpeningApplicationInterviewResponse::insert($insertData);
        }

        // Step 2: Insert the required comment
        JobOpeningApplicationInterviewResponse::create([
            'user_id' => $userId,
            'interviewer_id' => $interviewerId,
            'job_opening_application_id' => $jobOpeningId,
            'master_interview_question_id' => null,
            'marks' => 0,
            'comment' => $comment,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Step 3: Calculate Interview Performance Score
        $totalMarks = DB::table('master_interview_questions')
            ->where('job_id', function ($query) use ($jobOpeningId) {
                $query->select('job_id')
                    ->from('job_opening_applications')
                    ->where('id', $jobOpeningId);
            })
            ->sum('option_3_score');

        $obtainedMarks = DB::table('job_opening_application_interview_responses')
            ->where('job_opening_application_id', $jobOpeningId)
            ->sum('marks');

        $interview_score = $totalMarks > 0 ? ($obtainedMarks / $totalMarks) * 100 : 0;

        // Determine performance level
        $interview_level = match (true) {
            $interview_score > 90 => 5,
            $interview_score > 75 => 4,
            $interview_score >= 60 => 3,
            $interview_score >= 45 => 2,
            default => 1,
        };

        // Fetch performance description ID
        $interviewDescription =DB::table('master_descriptors')->where('assessment_type', 'interview')->where('result_type', 'interview')->where('user_score_level', $interview_level)
        ->first();

        $interview_performance_description_id = $interviewDescription->id ?? null;

        // Step 4: Get Overall Match Rate from user_results
        $overallMatchRate = DB::table('user_results')
            ->where('user_id', $userId)
            ->where('result_type', 'overall_match_rate')
            ->value('level'); // Assuming 'result' stores the OMR value

            $overallMatchRate = min(max($overallMatchRate, 0), 5); 

            // Selection Matrix Level Mapping
            $selection_matrix_level_conversion = config('helpers.selection_matrix_level_conversion');
            
            // Ensure interview level is within bounds
            $interview_level = min(max($interview_level, 0), 5);
            
            // Get selection matrix level from mapping
            $selection_matrix_level = $selection_matrix_level_conversion[$overallMatchRate][$interview_level] ?? 0;

        // Step 5: Update JobOpeningApplication with performance data
        $jobApplication = JobOpeningApplication::find($jobOpeningId);
        if ($jobApplication) {
            $jobApplication->status = 7;
            $jobApplication->interview_performance = $interview_level;
            $jobApplication->interview_performance_description_id = $interview_performance_description_id;
            $jobApplication->selection_matrix_level = $selection_matrix_level;
            $jobApplication->save();
        }

        return response()->json(['message' => 'Interview responses saved successfully!']);
    }






}
