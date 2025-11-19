<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;
use DB;
use App\Imports\UsersImport;
use App\Models\BusinessUnit;
use App\Rules\UniqueInTenantHierarchy;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
class DivisionController extends Controller
{
    public function index(){

        $divisions = Division::with(['business_unit', 'tenant'])->orderBy('created_at', 'DESC')->paginate(10);
        $data =[
            'divisions'=>$divisions
        ];
       return view('admin.division.index',$data);
    }

    public function create(){
        $businesses = BusinessUnit::all();

        $data = [
            'businesses'=>$businesses
        ];

        return view('admin.division.create',$data);
    }

    public function store(Request $request)
    {
        $rules = [
            'head_of_division' => [
                'required',
                'string',
                'max:255',
                new UniqueInTenantHierarchy(
                    'divisions',
                    'head_of_division',
                    'business_unit_id',
                    $request->business_unit_id,
                    null,
                    'tenant_id',
                    'Division name must be unique within this business unit.'
                )
            ],
            'status' => 'nullable|string|in:1,0',
            'business_unit_id' => 'nullable|exists:business_units,id,tenant_id,' . tenant_id(),
        ];

        $request->validate($rules);

        // Start transaction to ensure atomicity
        \DB::beginTransaction();
        try {
            $division =  Division::create([
                    'name' => $request->head_of_division,
                    'head_of_division' => $request->head_of_division,
                    'status' => $request->status ?? 1,
                    'business_unit_id' => $request->business_unit_id,
                ]);

            // Commit transaction
            \DB::commit();

            return redirect('/admin/division/')->with('success', 'Division created successfully.');

        } catch (\Exception $e) {
            // Rollback transaction in case of error
            \DB::rollBack();
            return redirect('/admin/division')->with('error','An error occurred.');
        }
    }

    public function edit($id)
    {
        // Eager-load the business_unit relationship to avoid N+1
        $division = Division::with('business_unit')->findOrFail($id);

        // Only fetch business units for the current tenant
        $businesses = BusinessUnit::all();

        return view('admin.division.create', [
            'user'        => $division,
            'businesses'  => $businesses,
            'business'    => $division->business_unit, // already loaded
        ]);
    }

    public function update(Request $request, $id)
    {
        $division = Division::findOrFail($id);

        // Validate the request data
        $rules = [
            'head_of_division' => [
                'required',
                'string',
                'max:255',
                new UniqueInTenantHierarchy(
                    'divisions',
                    'head_of_division',
                    'business_unit_id',
                    $request->business_unit_id,
                    $id,
                    'tenant_id',
                    'Division name must be unique within this business unit.'
                )
            ],
            'status' => 'nullable|string|in:1,0',
            'business_unit_id' => 'nullable|exists:business_units,id,tenant_id,' . tenant_id(),
        ];

        $request->validate($rules);

        // Start transaction to ensure atomicity
        \DB::beginTransaction();
        try {
            // Update division's details
            $division->update([
                'head_of_division' => $request->head_of_division,
                'number_of_pax' => $request->number_of_pax ?? '',
                'name' => $request->head_of_division,
                'status' => $request->status ?? 1,
                'business_unit_id' => $request->business_unit_id,
            ]);

            // Commit transaction
            \DB::commit();

            return redirect('/admin/division')->with('success', 'Division updated successfully.');

        } catch (\Exception $e) {
            // Rollback transaction in case of error
            \DB::rollBack();
            return redirect('/admin/division')->with('error', 'An error occurred.');
        }
    }

    public function destroy($id)
    {
        // Start transaction to ensure atomicity
        DB::beginTransaction();
        try {
            $division = Division::where('id', $id)->first();
            if (!$division) {
                return redirect('/admin/division')->with('error', 'Division not found.');
            }

            if ($division->department()->count() > 0) {
                return redirect('/admin/division')->with('error', 'Cannot delete division with department.');
            }

            // $user = $division->user;

            // Delete the division
            $division->delete();

            DB::commit();

            return redirect('/admin/division')->with('success', 'Division deleted successfully.');

        } catch (\Exception $e) {
            // Rollback transaction in case of error
            DB::rollBack();
            return redirect('/admin/division')->with('error', 'An error occurred while deleting the department.');
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

        $division = Division::findOrFail($id);
        $division->status = $request->status;
        $division->save();

        return response()->json(['success' => true]);
    }
}
