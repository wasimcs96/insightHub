<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;

use App\Models\Position;

use App\Models\Role;
use Hash;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
class DepartmentController extends Controller
{
    //
    public function index(){


        $users = Department::where('company_id','!=',auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(20);
        $data =[
            'users'=>$users,
            // 'type'=>$type
        ];
       return view('admin.users.department.index',$data);
    }

    public function create()
    {
        $company = User::where('role_name',Role::$company)
        ->select('name', 'id')
        ->orderBy('created_at', 'DESC')
        ->get();

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

        $data =[
            // 'type'=>$type,
            'department'=>$department,
            'company'=>$company,

        ];

        return view('admin.users.department.create',$data);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'sector_id' => 'required',
            // 'department' => 'required',

            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|unique:users',
            'password' => 'required | confirmed' ,

        ]);

        $avatarName = '/media/users/avatars/'.time().'.'.$request->avatar->extension(); // Generate unique avatar name
        $request->avatar->move(public_path('media/users/avatars'), $avatarName); // Move avatar to public/avatars directory

        // Hash the password
        $hashedPassword = Hash::make($request->password);



                $user = User::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'role_name' => 'department',
                    'role_id' => 4,
                    'name'=> $request->first_name . ' '. $request->last_name,
                    'company_id' => $request->company_id ?? auth()->user()->id,

                    'profile_picture' => $avatarName, // Save the avatar name in the database
                    'email' => $request->email,
                    'password' => $hashedPassword,
                ]);

             if($user){

                Department::create([
                    'user_id'=>$user->id,
                    'sierra_id'=>$request->sector_id,
                    'number_of_pax'=>$request->number_of_pax ?? '',
                    'head_of_department'=>$request->head_of_department ?? '',
                    'name'=> $request->first_name . ' '. $request->last_name,
                    'company_id' => $request->company_id ?? auth()->user()->id,

                ]);
             }


        return redirect('/admin/department/users/')->with('success', 'Department created successfully.');
    }

    public function edit($id)
    {

        $user = Department::find($id);
        $company = User::where('role_name',Role::$company)
        ->select('name', 'id')
        ->orderBy('created_at', 'DESC')
        ->get();


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

        $roles = Role::orderBy('created_at', 'desc')->get();

        $data = [
            'user'=> $user,
            'company'=>$company,
            'department'=>$department

        ];
        return view('admin.users.department.create',$data);
    }

    public function update(Request $request, $id)
    {
        $user = Department::where('id',$id)->first();

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate avatar as an image file
            'password' => 'nullable | confirmed', // Password is optional
            // 'role_name' => 'required'
            // 'company_id' => 'required',

        ]);

        $user->user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name'=> $request->first_name . ' '. $request->last_name,
            'email' => $request->email,
            'company_id' => $request->company_id ?? auth()->user()->id,

        ]);

        $user->update([
            'head_of_department'=>$request->head_of_department,
            'number_of_pax'=>$request->number_of_pax,
            // 'sierra_id'=>$request->sector_id,
            'name'=> $request->first_name . ' '. $request->last_name,
            'company_id' => $request->company_id ?? auth()->user()->id,

        ]);


        if ($request->hasFile('avatar')) {
        // Store new avatar in the public folder
        $avatarName ='/media/users/avatars/'.time().'.'.$request->avatar->extension();
        $request->avatar->move(public_path('media/users/avatars'), $avatarName);
        // Delete old avatar if exists
        if ($user->user->profile_picture) {
            unlink(public_path($user->user->profile_picture));
        }
        // Update user's avatar
        $user->user->update(['profile_picture' => $avatarName]);
        }

        if ($request->password) {
            // Hash the password
            $hashedPassword = Hash::make($request->password);
            // Update user's password
            $user->user->update(['password' => $hashedPassword]);
        }



        return redirect('/admin/department/users/')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = Department::find($id);
        // dd($id);
        $user->user->delete();
        $user->delete();


        return redirect('/admin/department/users/')->with('success', 'User deleted successfully.');
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





}


