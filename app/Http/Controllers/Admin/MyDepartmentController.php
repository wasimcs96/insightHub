<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;

use App\Models\Position;
use Illuminate\Support\Facades\Http;

use App\Models\Role;
use Hash;
use App\Imports\UsersImport;
use App\Models\Division;
use App\Rules\UniqueInTenantHierarchy;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;
use DB;

class MyDepartmentController extends Controller
{
    //
    public function index(Request $request)
    {
        
        // Retrieve divisions for the currently logged-in user's company
        $divisions = Division::with('business_unit')->get();

        // Initialize the query for departments
        $query = Department::with('division.business_unit')->orderBy('id','DESC');

        // Filter by division_id if provided
        if ($request->filled('division_id')) {
            $query->where('division_id', $request->division_id);
        }

        // Filter by name if provided
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Paginate the results
        $departments = $query->paginate(10);

        return view('admin.mydepartment.index', compact('departments', 'divisions'));
    }


    public function create()
    {
        $departmentsList = Department::where('status', 1)->pluck('sierra_id')->toArray();

        

        $ch = curl_init();
        $url = "https://sierra.cxs.team/api/job-description/departments";

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL peer verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  // Disable SSL host verification

        // Since it's a GET request, we don't set CURLOPT_POST or CURLOPT_POSTFIELDS
        $response = curl_exec($ch);
        curl_close($ch);
        $department = json_decode($response);

        $availableDepartments = [];

        if (isset($departmentsList) && is_array($departmentsList) && count($departmentsList) > 0) {
            if (isset($department) && (is_array($department) || is_object($department))) {
                foreach ($department as $key => $value) {
                    if (!in_array($value->id, $departmentsList)) {
                        $availableDepartments[] = $value;
                    }
                }
            }
        }
        else{
            $availableDepartments = $department;
        }
        $divisions = Division::with('business_unit')->get();
        $data =[
            'department'=>$availableDepartments,
            'divisions'=>$divisions,
        ];

        return view('admin.mydepartment.create',$data);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                new UniqueInTenantHierarchy(
                    'departments',
                    'name',
                    'division_id',
                    $request->division_id,
                    null,
                    'tenant_id',
                    'Department name must be unique within this division.'
                )
            ],
            'division_id' => [
                'required',
                'exists:divisions,id'
            ]
        ];

        $customMessages = [
            'name.required' => 'Please type the department name.',
            'division_id.required' => 'Please select a division.',
        ];

        
        $request->validate($rules, $customMessages);
       

        // Start transaction to ensure atomicity
        \DB::beginTransaction();
        try {            
            Department::create([
                    'name' => $request->name,
                    'division_id' => $request->division_id,
                    'head_of_department' => $request->name,
                    'status' => $request->status ?? 1,
                ]);

            // Commit transaction
            \DB::commit();

            return redirect('/admin/mydepartment/')->with('success', 'Department created successfully.');

        } catch (\Exception $e) {
            // Rollback transaction in case of error
            \DB::rollBack();
            return redirect('/admin/mydepartment')->with('error','An error occurred.');
        }
    }

    public function edit($id)
    {

        $user = Department::find($id);
        $divisions = Division::with('business_unit')->get();
        $data = [
            'user'=> $user,
            'divisions'=> $divisions
        ];
        return view('admin.mydepartment.create',$data);
    }

    public function update(Request $request, $id)
    {
        $department = Department::where('id', $id)->first();

        if (!$department) {
            return redirect('/admin/mydepartment')->with('error', 'Department not found.');
        }

        // Validate the request data
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                new UniqueInTenantHierarchy(
                    'departments',
                    'name',
                    'division_id',
                    $request->division_id,
                    $id,
                    'tenant_id',
                    'Department name must be unique within this division.'
                )
            ],
            'division_id' => [
                'required',
                'exists:divisions,id'
            ]
        ];

        $request->validate($rules);

        // Start transaction to ensure atomicity
        \DB::beginTransaction();
        try {
            // Update department's details
            $department->update([
                'head_of_department' => $request->name,
                'number_of_pax' => $request->number_of_pax ?? '',
                'name' => $request->name,
                'division_id' => $request->division_id,
                'status' => $request->status
            ]);

            // Commit transaction
            \DB::commit();

            return redirect('/admin/mydepartment')->with('success', 'Department updated successfully.');

        } catch (\Exception $e) {
            // Rollback transaction in case of error
            \DB::rollBack();
            return redirect('/admin/mydepartment')->with('error', 'An error occurred.');
        }
    }

    public function destroy($id)
    {
        // Start transaction to ensure atomicity
        DB::beginTransaction();
        try {
            $department = Department::where('id', $id)->first();

            if (!$department) {
                return redirect('/admin/mydepartment')->with('error', 'Department not found.');
            }

            if ($department->sections()->count() > 0) {
                return redirect('/admin/mydepartment')->with('error', 'Cannot delete department with sections.');
            }

            if ($department->units()->count() > 0) {
                return redirect('/admin/mydepartment')->with('error', 'Cannot delete department with units.');
            }

             if ($department->jobProfiles()->count() > 0) {
                return redirect('/admin/mydepartment')->with('error', 'Cannot delete department with jobs.');
            }

            // $user = $department->user;

            // Delete the department
            $department->delete();

            // Delete the associated user
            // if ($user) {
            //     // Delete user's profile picture from the storage
            //     if ($user->profile_picture && file_exists(public_path($user->profile_picture))) {
            //         unlink(public_path($user->profile_picture));
            //     }

            //     $user->delete();
            // }

            // Commit transaction
            DB::commit();

            return redirect('/admin/mydepartment')->with('success', 'Department deleted successfully.');

        } catch (\Exception $e) {
            // Rollback transaction in case of error
            DB::rollBack();
            return redirect('/admin/mydepartment')->with('error', 'An error occurred while deleting the department.');
        }
    }


    // In your controller method for handling bulk import
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

        $department = Department::findOrFail($id);
        $department->status = $request->status;
        $department->save();

        return response()->json(['success' => true]);
    }


public function getDepartments($companyId)
{
    $departments = Department::pluck('name', 'id');
    return response()->json($departments);
}

public function getPositions($departId)
{
    $positions = Position::where('department_id', $departId)->pluck('name', 'id');
    return response()->json($positions);
}

// public function profileUpdate(Request $request)
// {
//     $user = auth()->user();

//     $request->validate([
//         'first_name' => 'required',
//         'last_name' => 'required',
//         'email' => 'required|email|unique:users,email,' . $user->id,
//         'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate avatar as an image file
//         'password' => 'nullable | confirmed', // Password is optional
//         // 'role_name' => 'required'

//     ]);

//     $user->update([
//         'first_name' => $request->first_name,
//         'last_name' => $request->last_name,
//         'person_in_charge' => $request->person_charge,
//         'name'=> $request->first_name . ' '. $request->last_name,
//         'email' => $request->email,
//         'address'=>$request->address,
//         'description'=>$request->description,
//     ]);


//     if ($request->hasFile('avatar')) {
//     // Store new avatar in the public folder
//     $avatarName ='/media/users/avatars/'.time().'.'.$request->avatar->extension();


//     $path = $request->avatar->move(public_path('media/users/avatars'), $avatarName);

//     // Delete old avatar if exists
//     if ($user->profile_picture) {
//         unlink(public_path( $user->profile_picture));
//     }
//     // Update user's avatar
//     $user->update(['profile_picture' => $avatarName]);
//     // dd($user);
//     }

//     if ($request->password) {
//         // Hash the password
//         $hashedPassword = Hash::make($request->password);
//         // Update user's password
//         $user->update(['password' => $hashedPassword]);
//     }


//     return redirect()->back()->with('success', 'Profile updated successfully.');
// }

// public function departmentProfileUpdate(Request $request)
// {
//     $user = auth()->user();
//     // dd($request->all());
//     $request->validate([
//         'first_name' => 'required',
//         'pax_count' => 'required|numeric',
//         'email' => 'required|email|unique:users,email,' . $user->id,
//         'address' => 'required',
//         'password' => 'nullable | confirmed', // Password is optional
//         // 'role_name' => 'required'

//     ]);
//     $user->update([
//         'first_name' => $request->first_name,
//         'name'=> $request->first_name,
//         'email' => $request->email,
//     ]);

//     $department = Department::firstOrCreate(['user_id'=>$user->id]);
//     // dd($department);

//     $department->number_of_pax = $request->pax_count;
//     $department->head_of_department = $request->person_charge;
//     $department->location = $request->address;
//     $department->user_id = $user->id;
//     $department->save();

//     if ($request->password) {
//         // Hash the password
//         $hashedPassword = Hash::make($request->password);
//         // Update user's password
//         $user->update(['password' => $hashedPassword]);
//     }


//     return redirect()->route('department.profile.edit')->with('success', 'Profile updated successfully.');
// }




}


