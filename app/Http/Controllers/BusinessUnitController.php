<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BusinessUnit;
use Illuminate\Http\Request;
use DB;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;
class BusinessUnitController extends Controller
{
    public function index(){

        
        $businesses = BusinessUnit::with(['tenant'])->orderBy('created_at', 'DESC')->paginate(20);

        $data =[
            'businesses'=>$businesses
        ];

       return view('admin.business_unit.index',$data);
    }

    public function create(){
        return view('admin.business_unit.create');
    }

    public function store(Request $request)
    {
        
        // Validate the request data
        $request->validate([
            'name' => 'required|unique:business_units,name,NULL,id,tenant_id,' . auth()->user()->tenant_id,
            'status' => 'nullable|string|in:1,0',
        ]);

        // Start transaction to ensure atomicity
        \DB::beginTransaction();
        try {
            $businessUnit = BusinessUnit::create([
                    'name' => $request->name,
                    'status' => $request->status ?? 1,
                ]);

               
                
                
            // Commit transaction
            \DB::commit();

            return redirect('/admin/business/')->with('success', 'Business Unit created successfully.');

        } catch (\Exception $e) {
            // Rollback transaction in case of error
            \DB::rollBack();
            return redirect('/admin/business')->with('error','An error occurred.');
        }
    }

    public function edit($id)
    {

        $business = BusinessUnit::find($id);

        $data = [
            'business'=> $business
        ];
        return view('admin.business_unit.create',$data);
    }

    public function update(Request $request, $id)
    {
        $business_unit = BusinessUnit::where('id', $id)->first();

        if (!$business_unit) {
            return redirect('/admin/business')->with('error', 'Business Unit not found.');
        }

        // Validate the request data
        $request->validate([
            'name' => 'required|unique:business_units,name,' . $id . ',id,tenant_id,' . auth()->user()->id, // Ensure unique head_of_division within company
            'status' => 'nullable|string|in:1,0',
        ]);

        // Check if a business already has a head if 'head_of_division' is true
        if ($request->name && $request->name != $business_unit->name) {
            $existingHead = BusinessUnit::where('tenant_id', auth()->user()->tenant_id)
                ->where('name', $request->name)
                ->first();

            if ($existingHead) {
                throw ValidationException::withMessages([
                    'name' => 'Business Unit with this name already exists.'
                ]);
            }
        }

        // Start transaction to ensure atomicity
        \DB::beginTransaction();
        try {
            // Update business_unit's details
            $business_unit->update([
                'name' => $request->name,
                'status' => $request->status ?? 1,
                // 'status' => $request->status
            ]);

            // Commit transaction
            \DB::commit();

            return redirect('/admin/business')->with('success', 'Business Unit updated successfully.');

        } catch (\Exception $e) {
            // Rollback transaction in case of error
            \DB::rollBack();
            return redirect('/admin/business')->with('error', 'An error occurred.');
        }
    }

    public function destroy($id)
    {
        // Start transaction to ensure atomicity
        DB::beginTransaction();
        try {
            $business = BusinessUnit::where('id', $id)->first();
            if (!$business) {
                return redirect('/admin/business')->with('error', 'Business Unit not found.');
            }

            if ($business->division()->count() > 0) {
                return redirect('/admin/business')->with('error', 'Cannot delete business unit with company/division.');
            }

            // $user = $business->user;

            // Delete the business
            $business->delete();

            DB::commit();

            return redirect('/admin/business')->with('success', 'Business Unit deleted successfully.');

        } catch (\Exception $e) {
            // Rollback transaction in case of error
            DB::rollBack();
            return redirect('/admin/business')->with('error', 'An error occurred while deleting the department.');
        }
    }

    public function bulkImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx|max:2048', // Allow only .xlsx files up to 2MB
        ]);

        // Retrieve the uploaded file
        $file = $request->file('file');

        try {
            // Import the .xlsx file using Laravel Excel
            Excel::import(new UsersImport, $file);

            // Provide feedback to the user
            return back()->with('success', 'File uploaded and processed successfully.');
        } catch (\exception $th) {
            // Handle any exceptions or errors
            return back()->with('error','An error occurred while processing the file.');
        }

    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:1,0',
        ]);

        $business = BusinessUnit::findOrFail($id);
        $business->status = $request->status;
        $business->save();

        return response()->json(['success' => true]);
    }
}
