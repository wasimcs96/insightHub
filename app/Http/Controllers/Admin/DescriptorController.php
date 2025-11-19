<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterDescriptor;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DescriptorsImport;
use Illuminate\Support\Facades\Storage;

class DescriptorController extends Controller
{
    public function index(Request $request)
    {
        $query = MasterDescriptor::query();
    
        // Apply filters based on request inputs
        if ($request->filled('assessment_type')) {
            $query->where('assessment_type', $request->assessment_type);
        }
    
        if ($request->filled('result_type')) {
            $query->where('result_type', $request->result_type);
        }
    
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
    
        if ($request->filled('user_type')) {
            $query->where('user_type', $request->user_type);
        }
    
        if ($request->filled('job_requirement_level')) {
            $query->where('job_requirement_level', $request->job_requirement_level);
        }
    
        if ($request->filled('population_score_level')) {
            $query->where('population_score_level', $request->population_score_level);
        }
    
        if ($request->filled('user_score_level')) {
            $query->where('user_score_level', $request->user_score_level);
        }
    
        if ($request->filled('is_descriptor')) {
            $query->where('is_descriptor', $request->is_descriptor);
        }
    
        // Paginate the filtered results
        $descriptor = $query->paginate(10);
    
        // Pass filters back to the view to retain values
        return view('admin.descriptor.index', [
            'descriptor' => $descriptor,
            'filters' => $request->all(),
        ]);
    }
    

    public function create()
    {
        return view('admin.descriptor.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'assessment_type' => 'required|string|max:255',
            'result_type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'user_type' => 'required|string|max:25',
            'job_requirement_level' => 'nullable|integer|max:25',
            'population_score_level' => 'nullable|integer|max:25',
            'user_score_level' => 'nullable|integer|max:25',
            'job_requirement_level_description' => 'nullable|string|max:255',
            'population_score_level_description' => 'nullable|string|max:255',
            'user_score_level_description' => 'nullable|string|max:255',
            'analysis' => 'nullable|string',
            'analysis_population' => 'nullable|string',
            'is_descriptor' => 'sometimes|boolean', // Validate the is_descriptor checkbox
        ]);
        
    
        // Automatically generate the slug from the name
        $validatedData['slug'] = Str::slug($request->input('name'));
    
        // Generate the code by taking the first letter of the name and making it uppercase
        $name = $request->input('name');
        $firstLetter = Str::upper(Str::substr($name, 0, 1)); // Get the first letter of the name and make it uppercase
    
        // Example of how to generate a full code (you could customize this logic)
        
        $validatedData['code'] = $firstLetter;

           // Handle the is_descriptor field (default to 0 if unchecked)
    $validatedData['is_descriptor'] = $request->has('is_descriptor') ? 1 : 0;
    
        // Create the descriptor
        MasterDescriptor::create($validatedData);
    
        // Redirect back to the index with success message
        return redirect()->route('descriptors.index')->with('success', 'Descriptor created successfully.');
    }

public function edit($id)
{
    $descriptor = MasterDescriptor::find($id);
    return view('admin.descriptor.edit',compact('descriptor'));
}

public function update(Request $request, $id)
{
    // Find the descriptor by ID
    $descriptor = MasterDescriptor::findOrFail($id);

    // Validate the incoming request
    $validatedData = $request->validate([
        'assessment_type' => 'required|string|max:255',
        'result_type' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'user_type' => 'required|string|max:25',
        'job_requirement_level' => 'nullable|integer|max:25',
        'population_score_level' => 'nullable|integer|max:25',
        'user_score_level' => 'nullable|integer|max:25',
        'job_requirement_level_description' => 'nullable|string|max:255',
        'population_score_level_description' => 'nullable|string|max:255',
        'user_score_level_description' => 'nullable|string|max:255',
        'analysis' => 'nullable|string',
        'analysis_population' => 'nullable|string',
        'is_descriptor' => 'sometimes|boolean', // Validate the is_descriptor checkbox

    ]);
    

    // Automatically generate the slug from the name
    $validatedData['slug'] = Str::slug($request->input('name'));

     // Generate the code by taking the first letter of the name and making it uppercase
     $name = $request->input('name');
     $firstLetter = Str::upper(Str::substr($name, 0, 1)); // Get the first letter of the name and make it uppercase
 
     // Generate a new code or keep the current one if preferred
     
     $validatedData['code'] = $firstLetter;
     
         // Handle the is_descriptor field (default to 0 if unchecked)
    $validatedData['is_descriptor'] = $request->has('is_descriptor') ? 1 : 0;
    // Update the descriptor with validated data
    $descriptor->update($validatedData);

    // Redirect back with success message
    return redirect()->route('descriptors.index')->with('success', 'Descriptor updated successfully.');
}

public function destroy($id)
{
    $descriptor = MasterDescriptor::findOrFail($id);
    $descriptor->delete();
    return redirect()->route('descriptors.index')->with('success', 'Descriptor deleted successfully.');

}

public function file()
{
    return view('admin.descriptor.import');
}

public function show()
{
    $filePath = storage_path('app/templates/sample_descriptors.xlsx');
    // dd($filePath);  

    return response()->download($filePath, 'sample_descriptors.xlsx');
}

public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,csv',
    ]);

    try {
        // ini_set('memory_limit', '512M');

        Excel::import(new DescriptorsImport, $request->file('file'));

        return redirect()->route('descriptors.index')->with('success', 'Descriptors imported successfully.');
    } catch (\Exception $e) {
        return redirect()->route('descriptors.index')->with('error', $e->getMessage());
    }
}

}
