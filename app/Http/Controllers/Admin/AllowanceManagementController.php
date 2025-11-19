<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterAllowance;
use Illuminate\Http\Request;

class AllowanceManagementController extends Controller
{
    public function index(){
        $allowance = MasterAllowance::paginate(10);
        return view('admin.allowance.index',compact('allowance'));
    }

    public function create(){
        return view('admin.allowance.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'
         
        ]);

        // Create a new leave entry
        $allowance = new MasterAllowance();
        $allowance->name = $validatedData['name'];
        $allowance->save();

        // Redirect or return response
        return redirect()->route('allowance.index')->with('success', 'Allowance created successfully.');
    }


    public function edit($id)
    {
        $allowance = MasterAllowance::find($id);
        return view('admin.allowance.edit',compact('allowance'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Add more validation rules as needed
        ]);

        $allowance = MasterAllowance::findOrFail($id);
        $allowance->name = $request->input('name');
        // Update other fields as necessary

        $allowance->save();

        return redirect()->route('allowance.index')->with('success', 'Allowance updated successfully.');
    }

    public function destroy($id){
        $allowance = MasterAllowance::findOrFail($id);
        
          // Delete the allowance entry
          $allowance->delete();
    
          // Redirect back with a success message
          return redirect()->route('allowance.index')->with('success', 'Allowance deleted successfully.');
    }
}
