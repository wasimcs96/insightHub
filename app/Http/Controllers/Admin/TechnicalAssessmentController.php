<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Department;

use App\Models\MasterTechnicalQuestion;
use App\Models\BusinessUnit;
use App\Models\Division;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TechnicalQuestionsImport;
use Illuminate\Support\Facades\Storage;


class TechnicalAssessmentController extends Controller
{
  public function index(Request $request)
{
   // Get the search query and department name from the request
   $search = $request->input('search');
   $department = $request->input('department');

   // Retrieve job titles with the count of associated technical questions
   $technicalAss = MasterTechnicalQuestion::select('master_technical_questions.job_id','master_technical_questions.id')
       ->selectRaw('COUNT(*) as question_count')
       ->selectRaw('SUM(score) as total_marks')
      ->leftJoin('jobs', 'jobs.id', '=', 'master_technical_questions.job_id') 
      ->leftJoin('departments', 'departments.id', '=', 'jobs.department_id')
       ->when($search, function ($query, $search) {
           // Filter by job ID if search query exists
           return $query->where('jobs.id', $search);
       })
       ->when($department, function ($query, $department) {
           // Filter by department name if department parameter exists
           return $query->where('departments.name', 'like', '%' . $department . '%');
       })
       ->groupBy('master_technical_questions.job_id')
       ->paginate(10);
    //    dd($technicalAss[0]);
   return view('admin.technical.index', compact('technicalAss', 'search', 'department'));
}

public function getJobs(Request $request)
{
    $search = $request->input('q'); // Search query from Select2

    $jobs = Job::query()
        ->where('is_primary', 0)// Filter by is_primary = 1
        ->when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })
        ->select('id', 'title') // Select only required fields
        ->limit(10) // Limit results to improve performance
        ->get();

    return response()->json($jobs);
}



    public function create()
    {
        // Get the authenticated user's company_id or default to 3
        if(auth()->user()->company_id) {
            $company_id = auth()->user()->company_id;
        } else {
            $company_id = 3;
        }
    
        // Fetch departments based on the company_id
        // $departments = Department::where('company_id', $company_id)->get();
        $businessUnits = BusinessUnit::all(); 
        // Return the view with departments
        return view('admin.technical.create', compact('businessUnits'));
    }

//     public function getJobsByDepartment($department_id)
// {
    
//     // Fetch jobs related to the selected department
//     $jobs = Job::where('org_department', $department_id)->get();
//     // Return the jobs as JSON response
//     return response()->json($jobs);
// }
    public function getJobsByDepartment($department_id)
    {
        if (!$department_id) {
            return response()->json(['error' => 'Department ID is required'], 400);
        }

        $jobs = Job::where('department_id', $department_id)->get();

        if ($jobs->isEmpty()) {
            return response()->json(['message' => 'No jobs found for this department'], 404);
        }

        return response()->json($jobs);
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titles.*' => 'required|string|max:255',
            'levels.*' => 'required|integer',
            'question_numbers.*' => 'required|integer',
            'scores.*' => 'required|integer',
            'options.*.*.text' => 'required|string|max:255', // Adjusted to match your form structure
            'correct_answer' => 'required|array', // Correct answer should be an array
            'job_id' => 'required|integer|exists:jobs,id',
        ]);
    
        foreach ($validatedData['titles'] as $index => $title) {
            $technicalAss = new MasterTechnicalQuestion();
    
            // Assign job_id to the question
            $technicalAss->job_id = $validatedData['job_id'];
    
            // Assign other fields to the question
            $technicalAss->title = $title;
            $technicalAss->level = $validatedData['levels'][$index];
            $technicalAss->question_number = $validatedData['question_numbers'][$index];
            $technicalAss->score = $validatedData['scores'][$index];
    
            // Check if the correct answer is defined for this question
            if (isset($validatedData['correct_answer'][$index])) {
                $correctOptionIndex = $validatedData['correct_answer'][$index];
                $correctAnswer = 'option_' . ($correctOptionIndex + 1);
                $technicalAss->correct_answer = $correctAnswer;
            } else {
                // Handle the case where the correct answer is not set
                $technicalAss->correct_answer = null; // or set a default value
            }
    
            // Save the options
         // Initialize an empty array for options
// Initialize an empty array for options
$options = [];

// Loop to save options and populate the array with keys
for ($i = 0; $i < 4; $i++) {
    $optionField = 'option_' . ($i + 1);
    
    // Assign the text to the model's option fields
    $technicalAss->$optionField = $validatedData['options'][$index][$i]['text'] ?? null;
    
    // Add the text to the options array with the corresponding key
    $options[$optionField] = $validatedData['options'][$index][$i]['text'] ?? null;
}

// Store the options array as a JSON string in the new option column
$technicalAss->option = json_encode($options);


           
            // Save the question to the database
            $technicalAss->save();
        }
    
        return redirect()->route('technicalAss.index')->with('success', 'Technical Questions created successfully.');
    }
    


    public function edit($id)
    {
        // Retrieve the specific job by ID
        $job = Job::find($id);
    
        // Ensure the job exists, or handle error
        if (!$job) {
            return redirect()->route('admin.jobs.index')->with('error', 'Job not found.');
        }
    
        // Retrieve all technical questions associated with the job ID
        $technicalAss = MasterTechnicalQuestion::where('job_id', $id)->get();
    
        // Fetch relationships: Job -> Department -> Division -> BusinessUnit
        $departmentId = $job->department_id ?? null;
        $selectedDivisionId = null;
        $selectedBusinessUnitId = null;

        // Retrieve all departments for the dropdown
        $departments = Department::all();

        // Retrieve jobs related to the selected department
        $jobs = Job::where('department_id', $departmentId)->get();

        // Prepare BusinessUnit and Division (company) data
        $businessUnits = BusinessUnit::all();

        // Trace the relationships to get Division and BusinessUnit
        try {
            if ($departmentId) {
                $dept = Department::find($departmentId);
                if ($dept) {
                    $selectedDivisionId = $dept->division_id ?? null;
                    if ($selectedDivisionId) {
                        $division = Division::find($selectedDivisionId);
                        if ($division) {
                            $selectedBusinessUnitId = $division->business_unit_id ?? null;
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // Continue with nulls if relationships don't exist
        }

        // Pass the data to the Blade view
        return view('admin.technical.edit', compact('job', 'technicalAss', 'departments', 'jobs', 'departmentId', 'businessUnits', 'selectedDivisionId', 'selectedBusinessUnitId'));
    }



public function update(Request $request, $jobId)
{
    // Validate the request data
    $validatedData = $request->validate([
        'titles.*' => 'required|string|max:255',
        'levels.*' => 'required|integer',
        'question_numbers.*' => 'required|integer',
        'scores.*' => 'required|integer',
        'options.*.*.text' => 'required|string|max:255',
        'correct_answer' => 'required|array',
        'job_id' => 'required|integer|exists:jobs,id',
        'question_ids.*' => 'nullable|exists:master_technical_questions,id',
    ]);

    // Retrieve existing questions related to the job
    $existingQuestions = MasterTechnicalQuestion::where('job_id', $jobId)->get();

    // Array to track existing question IDs
    $existingQuestionIds = $existingQuestions->pluck('id')->toArray();

    // Array to track question IDs that will be updated
    $updatedQuestionIds = [];

    foreach ($validatedData['titles'] as $index => $title) {
        $questionId = $validatedData['question_ids'][$index] ?? null;

        if ($questionId && in_array($questionId, $existingQuestionIds)) {
            // Update existing question
            $technicalAss = MasterTechnicalQuestion::find($questionId);
            $updatedQuestionIds[] = $questionId;
        } else {
            // Create new question
            $technicalAss = new MasterTechnicalQuestion();
            $technicalAss->job_id = $validatedData['job_id'];
        }

        // Update the question details
        $technicalAss->title = $title;
        $technicalAss->level = $validatedData['levels'][$index];
        $technicalAss->question_number = $validatedData['question_numbers'][$index];
        $technicalAss->score = $validatedData['scores'][$index];

        // Save the options
        $options = [];

        // Loop to save options and populate the array with keys
        for ($i = 0; $i < 4; $i++) {
            $optionField = 'option_' . ($i + 1);
            
            // Assign the text to the model's option fields
            $technicalAss->$optionField = $validatedData['options'][$index][$i]['text'] ?? null;
            
            // Add the text to the options array with the corresponding key
            $options[$optionField] = $validatedData['options'][$index][$i]['text'] ?? null;
        }
        
        // Store the options array as a JSON string in the new option column
        $technicalAss->option = json_encode($options);

        // Check if the correct answer is defined for this question
        if (isset($validatedData['correct_answer'][$index])) {
            $correctOptionIndex = $validatedData['correct_answer'][$index];
            $correctAnswer = 'option_' . ($correctOptionIndex + 1);
            $technicalAss->correct_answer = $correctAnswer;
        } else {
            $technicalAss->correct_answer = null;
        }

        // Save or update the question in the database
        $technicalAss->save();

        // If it's a new question, add its ID to the array
        if (!$questionId) {
            $updatedQuestionIds[] = $technicalAss->id;
        }
    }

    // Remove questions that were not included in the update request (i.e., those that were deleted)
    $deletedQuestionIds = array_diff($existingQuestionIds, $updatedQuestionIds);
    if (!empty($deletedQuestionIds)) {
        MasterTechnicalQuestion::whereIn('id', $deletedQuestionIds)->delete();
    }

    // Update the job ID for all the updated questions (if the job ID is changed)
    MasterTechnicalQuestion::whereIn('id', $updatedQuestionIds)->update(['job_id' => $validatedData['job_id']]);

    return redirect()->route('technicalAss.index')->with('success', 'Technical Questions updated successfully.');
}





public function destroy($id)
{
    try {
        // Delete all records with the specified job_id
        MasterTechnicalQuestion::where('job_id', $id)->delete();

        return redirect()->route('technicalAss.index')->with('success', 'All technical questions removed successfully.');
    } catch (\Exception $e) {
        return redirect()->route('technicalAss.index')->with('error', 'Failed to remove technical questions.');
    }
}



public function file()
{
    return view('admin.technical.import');
}

public function downloadTemplate()
{
    $filePath = storage_path('app/templates/sample_assessmet.xlsx');
    // dd($filePath);  

    return response()->download($filePath, 'sample_assessmet.xlsx');
}

public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,csv',
    ]);

    try {
        Excel::import(new TechnicalQuestionsImport, $request->file('file'));

        return redirect()->route('technicalAss.index')->with('success', 'Technical Questions imported successfully.');
    } catch (\Exception $e) {
        return redirect()->route('technicalAss.index')->with('error', $e->getMessage());
    }
}

public function getCompaniesByBU($buId)
{
    $divisions = Division::where('business_unit_id', $buId)->get();

    return response()->json($divisions);
}


public function getDepartmentsByCompany($companyId)
{
    $departments = Department::where('division_id', $companyId)->get();
    return response()->json($departments);
}


  
}
