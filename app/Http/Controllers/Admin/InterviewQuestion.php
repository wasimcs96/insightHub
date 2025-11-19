<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Department;
use App\Models\MasterInterviewQuestion;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\InterviewQuestionsImport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class InterviewQuestion extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::all();
    
        $query = MasterInterviewQuestion::with('job', 'department')
            ->select(
                'job_id',
                'department_id',
                \DB::raw('MIN(created_at) as created_at'),
                \DB::raw('MAX(updated_at) as updated_at')
            )
            ->groupBy('job_id', 'department_id');
    
        // Filters
        if ($request->department_id) {
            $query->where('department_id', $request->department_id);
        }
    
        if ($request->job_id) {
            $query->where('job_id', $request->job_id);
        }
    
        if ($request->search) {
            $query->whereHas('job', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%');
            });
        }
    
        // Sorting
        $sortField = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
    
        $collection = $query->get()->sortBy(function ($item) use ($sortField) {
            switch ($sortField) {
                case 'job_position':
                    return $item->job->title ?? '';
                case 'department':
                    return $item->department->name ?? '';
                case 'created_at':
                    return $item->created_at;
                case 'updated_at':
                    return $item->updated_at;
                default:
                    return $item->created_at;
            }
        }, SORT_REGULAR, $sortOrder === 'desc');
    
        // Pagination
        $perPage = 10;
        $page = $request->get('page', 1);
        $offset = ($page - 1) * $perPage;
        $paginated = new LengthAwarePaginator(
            $collection->slice($offset, $perPage)->values(),
            $collection->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
    
        return view('admin.interview-question.index', [
            'interviewGroups' => $paginated,
            'departments' => $departments,
            'sortField' => $sortField,
            'sortOrder' => $sortOrder,
        ]);
    }
    
    

    public function manual_creation()
    {
        return view('admin.interview-question.edit');
    }

    public function create()
    {
          // Get the authenticated user's company_id or default to 3
          if(auth()->user()->company_id) {
            $company_id = auth()->user()->company_id;
        } else {
            $company_id = 3;
        }
        $departments = Department::where('company_id', $company_id)->get();

        return view('admin.interview-question.create',compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|integer',
            'job_id' => 'required|integer',
            'title' => 'required|array|min:1|max:10',
            'title.*' => 'required|string|max:255',
        ]);
    
        foreach ($request->title as $index => $questionTitle) {
            MasterInterviewQuestion::create([
                'department_id' => $request->department_id,
                'job_id' => $request->job_id,
                'question_number' => $index + 1,
                'title' => $questionTitle,
                'level' => 'basic', // default level
                'option_1_score'   => 1,
                'option_2_score'   => 3,
                'option_3_score'   => 5,
            ]);
        }
    
        return redirect()->route('admin.interview-question.index')->with('success', 'Interview questions created successfully.');
    }
    
    

    public function getJobsByDepartment($department_id)
    {
        // Fetch jobs related to the selected department
        $jobs = Job::where('org_department', $department_id)->get();
    
        // Return the jobs as JSON response
        return response()->json($jobs);
    }

    public function edit($job_id, $department_id)
    {
        $departments = Department::all();
        $jobs = Job::where('department_id', $department_id)->get(); // fetch jobs for selected dept
        $questions = MasterInterviewQuestion::where('job_id', $job_id)
            ->where('department_id', $department_id)
            ->orderBy('question_number')
            ->get();
    
        return view('admin.interview-question.edit', compact('departments', 'questions','jobs','job_id', 'department_id'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'department_id' => 'required|integer',
            'job_id' => 'required|integer',
            'title' => 'required|array|min:1|max:10',
            'title.*' => 'required|string|max:255',
            'question_ids' => 'nullable|array',
            'question_ids.*' => 'nullable|integer'
        ]);
    
        $questionIds = $request->question_ids ?? [];
        $titles = $request->title;
    
        $usedIds = [];
    
        foreach ($titles as $index => $title) {
            $id = $questionIds[$index] ?? null;
    
            if ($id) {
                // Update existing
                $question = MasterInterviewQuestion::find($id);
                if ($question) {
                    $question->update([
                        'title' => $title,
                        'question_number' => $index + 1,
                        'department_id' => $request->department_id,
                        'job_id' => $request->job_id,
                    ]);
                    $usedIds[] = $id;
                }
            } else {
                // Create new
                $new = MasterInterviewQuestion::create([
                    'title' => $title,
                    'question_number' => $index + 1,
                    'department_id' => $request->department_id,
                    'job_id' => $request->job_id,
                    'level' => 'basic',
                ]);
                $usedIds[] = $new->id;
            }
        }
    
        // Delete questions that are no longer present
        MasterInterviewQuestion::where('job_id', $request->job_id)
            ->where('department_id', $request->department_id)
            ->whereNotIn('id', $usedIds)
            ->delete();
    
        return redirect()->route('admin.interview-question.index')->with('success', 'Interview questions updated successfully.');
    }
    

    

    public function show($department_id, $job_id)
    {
        $questions = MasterInterviewQuestion::where('department_id', $department_id)
                        ->where('job_id', $job_id)
                        ->orderBy('question_number')
                        ->get();
    
        $department = Department::findOrFail($department_id);
        $job = Job::findOrFail($job_id);
    
        $group = (object)[
            'department_id' => $department_id,
            'job_id' => $job_id,
        ];
        return view('admin.interview-question.view', compact('questions', 'department', 'job', 'group'));
    }
    

    public function bulk_upload()
    {
        return view('admin.interview-question.bulk-upload');
    }

    public function downloadTemplate()
   {
    $filePath = storage_path('app/templates/sample_interview.xlsx');
    // dd($filePath);  

    return response()->download($filePath, 'sample_interview.xlsx');
   }

   public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,csv',
    ]);

    try {
        Excel::import(new InterviewQuestionsImport, $request->file('file'));

        return redirect()->route('admin.interview-question.index')->with('success', 'Interview Questions imported successfully.');
    } catch (\Exception $e) {
        return redirect()->route('admin.interview-question.index')->with('error', $e->getMessage());
    }

}


    public function destroy(Request $request)
    {
        $request->validate([
            'job_id' => 'required|integer',
            'department_id' => 'required|integer',
        ]);
    
        MasterInterviewQuestion::where('job_id', $request->job_id)
            ->where('department_id', $request->department_id)
            ->delete();
    
        return redirect()->route('admin.interview-question.index')
            ->with('success', 'Interview questions deleted successfully.');
    }


}
