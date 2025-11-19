<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterLeave;

class LeaveManagementController extends Controller
{
    public function index()
    {
        $leave = MasterLeave::orderby('created_at','DESC')->paginate(10);
        return view('admin.leave.index',compact('leave'));
    }

    
    public function create()
    {
        return view('admin.leave.create');
    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'depend_on_job' => 'nullable',
            'days_per_year' => 'nullable|integer|required_if:depend_on_job,0',
            // 'entitlement' => 'nullable|string|max:255',
            'eligibility' => 'required|in:A,F,M',
            'purpose' => 'nullable|string',
            'cumulative' => 'required|boolean',
        ]);
        
       

        // Create a new leave entry
        $leave = new MasterLeave();
        $leave->name = $validatedData['name'];
        $leave->days_per_year = $validatedData['days_per_year'] ?? '';
        // $leave->entitlement = $validatedData['entitlement'];
        $leave->eligibility = $validatedData['eligibility'];
        $leave->purpose = $validatedData['purpose'];
        $leave->cumulative = $validatedData['cumulative'];
        $leave->depend_on_job = $validatedData['depend_on_job'];
        $leave->save();

        // Redirect or return response
        return redirect()->route('leave.index')->with('success', 'Leave created successfully.');
    }

    public function edit($id)
    {
        $leave = MasterLeave::findOrFail($id);
        return view('admin.leave.edit', compact('leave'));
    }

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'depend_on_job' => 'nullable',
            'days_per_year' => 'nullable|integer|required_if:depend_on_job,0',
            // 'entitlement' => 'nullable|string|max:255',
            'eligibility' => 'required|in:A,F,M',
            'purpose' => 'nullable|string',
            'cumulative' => 'required|boolean',
        ]);
        
        $leave = MasterLeave::findOrFail($id);

        $leave->update($validatedData);
        $leave->depend_on_job = $validatedData['depend_on_job'] ?? 0;
        $leave->days_per_year = $validatedData['days_per_year'] ?? 0;

        $leave->save();

        return redirect()->route('leave.index')->with('success', 'Leave updated successfully.');
    }

    public function destroy($id)
    {
        // Find the leave entry by ID
        $leave = MasterLeave::findOrFail($id);
    
        // Delete the leave entry
        $leave->delete();
    
        // Redirect back with a success message
        return redirect()->route('leave.index')->with('success', 'Leave deleted successfully.');
    }

}
