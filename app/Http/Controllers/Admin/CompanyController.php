<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\CompanyDetail;
use App\Models\CompanySector;
use App\Models\CompanySubSector;
use App\Models\Position;

use App\Models\Role;
use Hash;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
class CompanyController extends Controller
{
    //
    public function index(){



            // $role = Role::where('name', 'company')->first();


        $users = User::where('role_name',Role::$company)->orderBy('created_at', 'DESC')->paginate(20);


        $data =[
            'users'=>$users,
            // 'type'=>$type
        ];
       return view('admin.users.company.index',$data);
    }

    public function create()
    {
        // $company = User::where('role_name',Role::$company)
        // ->select('name', 'id')
        // ->orderBy('created_at', 'DESC')
        // ->get();
        $roles = Role::orderBy('created_at', 'desc')->get();
        $data =[
            // 'type'=>$type,
            // 'company'=>$company,
            'roles'=>$roles
        ];

        return view('admin.users.company.create',$data);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'first_name' => 'required',
            // 'last_name' => 'required',
            // 'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|unique:users',
            'password' => 'required | confirmed' ,
        ]);
        $avatarName = '';
        if($request->has('avatar')){
            $avatarName = '/media/users/avatars/'.time().'.'.$request->avatar->extension(); // Generate unique avatar name
            $request->avatar->move(public_path('media/users/avatars'), $avatarName); // Move avatar to public/avatars directory
        }


        // Hash the password
        $hashedPassword = Hash::make($request->password);


                $user = User::create([
                    'first_name' => $request->first_name,
                    // 'last_name' => $request->last_name,
                    'role_name' => 'company',
                    'role_id' => 3,
                    'name'=> $request->first_name,
                    // 'company_id' => $request->company,
                    // 'department_id' => $request->department,
                    // 'position_id' => $request->position,
                    'profile_picture' => $avatarName, // Save the avatar name in the database
                    'email' => $request->email,
                    'password' => $hashedPassword,
                ]);


        return redirect('/admin/company/users')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {

        $user = User::find($id);

        $data = [
            'user'=> $user,
            // 'type'=>$type,
            // 'roles'=>$roles,
            // 'company'=>$company

        ];
        return view('admin.users.company.create',$data);
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id',$id)->first();

        $request->validate([
            'first_name' => 'required',
            // 'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // 'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate avatar as an image file
            'password' => 'nullable | confirmed', // Password is optional
            // 'role_name' => 'required'

        ]);

        $user->update([
            'first_name' => $request->first_name,
            // 'last_name' => $request->last_name,
            'name'=> $request->first_name,
            'email' => $request->email,
            // 'role_name' => $request->role_name,
            // 'company_id' => $request->company,
            // 'department_id' => $request->department,
            // 'position_id' => $request->position,
        ]);


        if ($request->hasFile('avatar')) {
        // Store new avatar in the public folder


        $avatarName ='/media/users/avatars/'.time().'.'.$request->avatar->extension();
        $request->avatar->move(public_path('media/users/avatars'), $avatarName);
        // Delete old avatar if exists
        // dd(public_path('avatars/' . $user->profile_picture));
        if ($user->profile_picture) {
            unlink(public_path($user->profile_picture));
        }
        // Update user's avatar
        $user->update(['profile_picture' => $avatarName]);
        }

        if ($request->password) {
            // Hash the password
            $hashedPassword = Hash::make($request->password);
            // Update user's password
            $user->update(['password' => $hashedPassword]);
        }

        // if($request->role == 'employee'){

        //     $user->assignRole('employee');

        // }elseif($request->role  == 'company'){

        //     $user->assignRole('company');

        // }elseif($request->role  == 'department'){


        //     $user->assignRole('department');

        // }elseif($request->role  == 'super admin'){

        //     $user->assignRole('super admin');

        // }


        return redirect('/admin/company/users/')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        // dd($id);
        $user->delete();

        return redirect('/admin/company/users/')->with('success', 'User deleted successfully.');
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

public function profileEdit()
{

    $user = auth()->user();
    $sector = CompanySector::get();
    $data = [
        'user'=> $user,
        'sector'=>$sector

    ];

    return view('admin.users.company.profile',$data);
}

public function profileUpdate(Request $request)
{
    $user = auth()->user();
    // dd($user);
    // dd($request->all());
    
    $request->validate([
        'company_name' => 'required',
        'company_mobile_number' => 'required',
        'company_email' => 'required',
        'website' => 'required',
        'sector_id' => 'required',
        'sub_sector_id' => 'required',

        'company_address'=>'required',


        'first_name' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,    
        'mobile_number' => 'required|numeric',
        'password' => 'nullable | confirmed', // Password is optional
        // 'role_name' => 'required'

    ]);
    $user->update([
        'first_name' => $request->first_name,
        'name'=> $request->first_name,
        'email' => $request->email,
        'mobile_number' => $request->mobile_number,

    ]);

    $company_details = CompanyDetail::firstOrCreate(['user_id'=>$user->id]);

    $company_details->name = $request->company_name;
    $company_details->mobile_number = $request->company_mobile_number;
    $company_details->email = $request->company_email;
    $company_details->user_id = $user->id;
    $company_details->website = $request->website;
    $company_details->sector_id = $request->sector_id;
    $company_details->subsector_id = $request->sub_sector_id;
    $company_details->address = $request->company_address;
    $company_details->save();
    

    
    if ($request->hasFile('avatar')) {
        // Store new avatar in the public folder
        $baseUrl = env('APP_URL', 'http://localhost');

        // Generate a unique name for the avatar file using the current timestamp
        $avatarName = time() . '.' . $request->avatar->extension();

        // Construct the full URL of the avatar
        $avatarPath = 'media/users/avatars/' . $avatarName;
        $fullAvatarUrl = $baseUrl . $avatarPath;

        // Move the uploaded avatar to the 'public/media/users/avatars' directory
        $request->avatar->move(public_path('media/users/avatars'), $avatarName);
    
        // Delete old avatar if exists
        try {
            if ($user->profile_picture) {
                unlink(public_path( $user->profile_picture));
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    
        // Update user's avatar
        $user->update(['profile_picture' => $fullAvatarUrl]);
        // dd($user);
        }

    if ($request->password) {
        // Hash the password
        $hashedPassword = Hash::make($request->password);
        // Update user's password
        $user->update(['password' => $hashedPassword]);
    }


    return redirect()->route('company.profile.edit')->with('success', 'Profile updated successfully.');
}


public function getSubSector($departId)
{

    $positions = CompanySubSector::where('sector_id', $departId)->pluck('name', 'id');
    // dd($positions);
    return response()->json($positions);
}

}


