<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Team;


use App\Models\Position;
use App\Models\Job;


use App\Models\Role;
use Hash;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TechnicalSkillsImport;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\TechnicalSkill;
use App\Models\MasterTechnicalSkill;
use App\Models\JobTechnicalSkills;
use App\Imports\TechnicalSkillsForJobs;

class UsersController extends Controller
{
    //
    public function index($type){


        // $users = User::orderBy('created_at','DESC')->get();
        if($type == 'employee'){
            $role = Role::where('name', 'employee')->first();
        }elseif($type == 'company'){
            $role = Role::where('name', 'company')->first();
        }elseif($type == 'department'){
            $role = Role::where('name', 'department')->first();

        }elseif($type == 'super admin'){
            $role = Role::where('name', 'admin')->first();

        }
        // dd($role->users);

        $users = $role->users()->orderBy('created_at', 'DESC')->paginate(20);


        $data =[
            'users'=>$users,
            'type'=>$type
        ];
       return view('admin.users.index',$data);
    }

    public function create($type)
    {
        $company = User::where('role_name',Role::$company)
        ->select('name', 'id')
        ->orderBy('created_at', 'DESC')
        ->get();
        $roles = Role::orderBy('created_at', 'desc')->get();
        $data =[
            'type'=>$type,
            'company'=>$company,
            'roles'=>$roles
        ];

        return view('admin.users.create',$data);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            // 'company' => 'required',
            // 'department' => 'required',
            'role_id' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|unique:users',
            'password' => 'required | confirmed' ,
            'company' => 'required_if:role,employee|required_if:role,department',
            'department' => 'required_if:role,employee',
            'position' => 'required_if:role,employee',
        ]);

        $avatarName = '/media/users/avatars/'.time().'.'.$request->avatar->extension(); // Generate unique avatar name
        $request->avatar->move(public_path('media/users/avatars'), $avatarName); // Move avatar to public/avatars directory

        // Hash the password
        $hashedPassword = Hash::make($request->password);

        // if (!empty($data['role_id'])) {
            $role = Role::find($request->role_id);
            // if (!empty($role)) {


                $user = User::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'role_name' => $role->name,
                    'role_id' => $request->role_id,
                    'name'=> $request->first_name . ' '. $request->last_name,
                    'company_id' => $request->company,
                    'department_id' => $request->department,
                    'position_id' => $request->position,
                    'profile_picture' => $avatarName, // Save the avatar name in the database
                    'email' => $request->email,
                    'password' => $hashedPassword,
                ]);

             if($role->role_name == 'department'){

                Department::create([
                    'user_id'=>$user->id,
                    'number_of_pax'=>$request->number_of_pax,
                    'head_of_department'=>$request->head_of_department,
                ]);
             }
        //     }
        // }else{
            // dd($user);
        // }
        // dd($user);


        return redirect('/admin/users/'.$request->role)->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit($type,$id)
    {

        $user = User::find($id);
        $company = User::where('role_name',Role::$company)
        ->select('name', 'id')
        ->orderBy('created_at', 'DESC')
        ->get();
        $roles = Role::orderBy('created_at', 'desc')->get();

        $data = [
            'user'=> $user,
            'type'=>$type,
            'roles'=>$roles,
            'company'=>$company

        ];
        return view('admin.users.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id',$id)->first();

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate avatar as an image file
            'password' => 'nullable | confirmed', // Password is optional
            // 'role_name' => 'required'
            'company' => 'required_if:role,employee|required_if:role,department',
            'department' => 'required_if:role,employee',
            'position' => 'required_if:role,employee',
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name'=> $request->first_name . ' '. $request->last_name,
            'email' => $request->email,
            'role_name' => $request->role_name,
            'company_id' => $request->company,
            'department_id' => $request->department,
            'position_id' => $request->position,
        ]);


        if ($request->hasFile('avatar')) {
        // Store new avatar in the public folder
        $avatarName ='/media/users/avatars/'.time().'.'.$request->avatar->extension();
        $request->avatar->move(public_path('media/users/avatars'), $avatarName);
        try {
            if ($user->profile_picture) {
                unlink(public_path('avatars/' . $user->profile_picture));
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        // Delete old avatar if exists

        // Update user's avatar
        $user->update(['avatar' => $avatarName]);
        }

        if ($request->password) {
            // Hash the password
            $hashedPassword = Hash::make($request->password);
            // Update user's password
            $user->update(['password' => $hashedPassword]);
        }

        if($request->role == 'employee'){

            $user->assignRole('employee');

        }elseif($request->role  == 'company'){

            $user->assignRole('company');

        }elseif($request->role  == 'department'){


            $user->assignRole('department');

        }elseif($request->role  == 'super admin'){

            $user->assignRole('super admin');

        }


        return redirect('/admin/users/'.$type)->with('success', 'User updated successfully.');
    }

    public function destroy($type,$id)
    {
        $user = User::find($id);
        // dd($id);
        $user->delete();

        return redirect('/admin/users/'.$type)->with('success', 'User deleted successfully.');
    }


    // In your controller method for handling bulk import
public function bulkImport(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx|max:2048', // Allow only .xlsx files up to 2MB
    ]);
    // Retrieve the uploaded file
    $file = $request->file('file');
    $departId = $request->department_id ?? auth()->user()->id;
    try {
        // Import the .xlsx file using Laravel Excel
        Excel::import(new UsersImport($departId), $file);

        // Provide feedback to the user
        return back()->with('success', 'File uploaded and processed successfully.');
    } catch (\exception $th) {
        // Handle any exceptions or errors
        return back()->with('error','An error occurred while processing the file.');
    }

}



public function getDepartments($companyId)
{
    $departments = Department::where('company_id', $companyId)->pluck('name', 'id');
    return response()->json($departments);
}

public function getPositions($departId)
{

    $positions = Job::where('department_id', $departId)->pluck('title', 'id');
    // dd($positions);
    return response()->json($positions);
}

public function getTeams($departId)
{
    // dd($departId);

    $positions = Team::where('department_id', $departId)->pluck('name', 'id');
    // dd($positions);
    return response()->json($positions);
}


public function profileEdit()
{

    $user = auth()->user();
    $company = User::whereNull('company_id')
    ->select('name', 'id')
    ->orderBy('created_at', 'DESC')
    ->get();
    $data = [
        'user'=> $user,
        'company'=>$company

    ];

    return view('admin.profile',$data);
}

public function profileUpdate(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate avatar as an image file
        'password' => 'nullable | confirmed', // Password is optional
        // 'role_name' => 'required'

    ]);

    $user->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'person_in_charge' => $request->person_charge,
        'name'=> $request->first_name . ' '. $request->last_name,
        'email' => $request->email,
        'address'=>$request->address,
        'description'=>$request->description,
    ]);


    if ($request->hasFile('avatar')) {
    // Store new avatar in the public folder
    $avatarName ='/media/users/avatars/'.time().'.'.$request->avatar->extension();


    $path = $request->avatar->move(public_path('media/users/avatars'), $avatarName);

    // Delete old avatar if exists
    try {
        if ($user->profile_picture) {
            unlink(public_path( $user->profile_picture));
        }
    } catch (\Throwable $th) {
        //throw $th;
    }

    // Update user's avatar
    $user->update(['profile_picture' => $avatarName]);
    // dd($user);
    }

    if ($request->password) {
        // Hash the password
        $hashedPassword = Hash::make($request->password);
        // Update user's password
        $user->update(['password' => $hashedPassword]);
    }


    return redirect()->back()->with('success', 'Profile updated successfully.');
}


public function departmentProfileEdit()
{

    $user = auth()->user();
    $company = User::whereNull('company_id')
    ->select('name', 'id')
    ->orderBy('created_at', 'DESC')
    ->get();
    $data = [
        'user'=> $user,
        'company'=>$company

    ];

    return view('department.profile',$data);
}

public function departmentProfileUpdate(Request $request)
{
    $user = auth()->user();
    // dd($request->all());
    $request->validate([
        'first_name' => 'required',
        'pax_count' => 'required|numeric',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'address' => 'required',
        'password' => 'nullable | confirmed', // Password is optional
        // 'role_name' => 'required'

    ]);
    $user->update([
        'first_name' => $request->first_name,
        'name'=> $request->first_name,
        'email' => $request->email,
    ]);

    $department = Department::firstOrCreate(['user_id'=>$user->id]);
    // dd($department);

    $department->number_of_pax = $request->pax_count;
    $department->head_of_department = $request->person_charge;
    $department->location = $request->address;
    $department->user_id = $user->id;
    $department->save();

    if ($request->password) {
        // Hash the password
        $hashedPassword = Hash::make($request->password);
        // Update user's password
        $user->update(['password' => $hashedPassword]);
    }


    return redirect()->route('department.profile.edit')->with('success', 'Profile updated successfully.');
}



public function getSectors($companyId)
{
    $departments = Department::where('company_id', $companyId)->pluck('sierra_id')->toArray();

    $ch = curl_init();
        $url = "https://sierra.cxs.team/api/job-description/departments";

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL peer verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  // Disable SSL host verification

        // Since it's a GET request, we don't set CURLOPT_POST or CURLOPT_POSTFIELDS
        $response = curl_exec($ch);
        curl_close($ch);

        // Step 3: Decode the JSON response into an associative array
        $sectors = json_decode($response, true);

        // Step 4: Filter sectors to find those not in $departments
        $newSectors = array_filter($sectors, function ($sector) use ($departments) {
            return !in_array($sector['id'], $departments);
        });

        // dd(array_values($newSectors));

        return response()->json([
            'new_sectors' => array_values($newSectors)
        ]);

}


    public function getOrgChartData()
    {
        $users = User::with('job_position')->whereNotNull('position_id')->get();

        // Assuming the general manager is at the highest level (level 4)
        $generalManager = $users->filter(function ($user) {
            if($user->job_position){
                return $user->job_position->level == 4;
            } else {
                return true;
            }
            
        })->first();

        if (!$generalManager) {
            return response()->json(['error' => 'General manager not found'], 404);
        }

        $orgChartData = $this->buildOrgChartData($generalManager, $users);

        return response()->json($orgChartData);
    }

    public function buildOrgChart($user) {
        if ($user) {

            if ($user->position) {
                $result = [
                    'name' => $user->name,
                    'title' => $user->position->title ?? '',
                    'className' => 'level-' . $user->position->level ?? ''
                ];
            }else{
                $result = [
                    'name' => $user->name
                ];
            }


        if ($user->subordinates->isNotEmpty()) {
            $result['children'] = [];
            foreach ($user->subordinates as $subordinate) {
                $result['children'][] = $this->buildOrgChart($subordinate);
            }
        }

        return $result;
            # code...
        }
        return [];
    }
    

    public function buildOrgChartData()
    {
        $topUser = null;

        for ($level = 10; $level >= 1; $level--) {
            $topUser = User::with(['position', 'subordinates'])->whereHas('position', function($query) use ($level) {
                $query->where('level', $level);
            })->whereHas('subordinates')->first();
    
            if ($topUser) {
                break;
            }
        }
    
        if (!$topUser) {
            $dataSource = [];
        } else {
            $dataSource = $this->buildOrgChart($topUser);
        }
        
        $departments = Department::all();

        return view('admin.org_structure',compact('dataSource','departments'));
    }

    public function updateTechnicalSkillsView() {
        return view('admin.update-technical-skills');
    }

    public function updateTechnicalSkills(Request $request) {
        // Validate the file input
        $validator = Validator::make($request->all(), [
            'excel_file' => 'required|file|mimes:xlsx,xls|max:10240'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }
    
        try {
            // Capture the start time
            $startTime = microtime(true);
    
            $sheetIndex = $request->input('sheet_index');
    
            // Import the file and get the number of records
            $importer = new TechnicalSkillsImport($sheetIndex);
            Excel::import($importer, $request->file('excel_file'));
            $numberOfRecords = $importer->getRowCount();
    
            // Capture the end time
            $endTime = microtime(true);
            $timeTaken = $endTime - $startTime;
    
            return response()->json([
                'message' => 'Skills imported successfully',
                'time_taken' => $timeTaken,
                'number_of_records' => $numberOfRecords
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred during import',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function migrateTechnicalSkillsId() {
          $technicalSkillsForJob = JobTechnicalSkills::pluck('technical_skill_id')->toArray();

          $technicalSkills = TechnicalSkill::whereNull('technical_skill_id')->whereIn('id',$technicalSkillsForJob)->get();

          foreach($technicalSkills as $technicalSkill) {
            $technicalSkillJob = JobTechnicalSkills::where('technical_skill_id',$technicalSkill->id)->first();
            if($technicalSkillJob) {
                $job = Job::find($technicalSkillJob->job_id);
                $masterTechnicalSkill = MasterTechnicalSkill::where('sector_id',$job->department_id)->where('name', $technicalSkill->name)->first();
                if($masterTechnicalSkill) {
                    $technicalSkill->technical_skill_id = $masterTechnicalSkill->id;
    
                    $technicalSkill->save();
                }
                
            }
            
          }

          dd("Done");
    }

    public function updateTechnicalSkillsForJobsView() {
        return view('admin.update-technical-skills-for-jobs');
    }

    public function updateTechnicalSkillsForJobs(Request $request) {

        ini_set('memory_limit', '512M');
        // Validate the file input
        $validator = Validator::make($request->all(), [
            'excel_file' => 'required|file|mimes:xlsx,xls|max:10240'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }
        
        // try {
            // Capture the start time
            $startTime = microtime(true);
    
            // Import the file and get the number of records
            Excel::import(new TechnicalSkillsForJobs, $request->file('excel_file'));
        
            // Capture the end time
            $endTime = microtime(true);
            $timeTaken = $endTime - $startTime;
    
            return response()->json([
                'message' => 'Skills imported successfully',
                'time_taken' => $timeTaken
            ]);
        // } catch (ValidationException $e) {
        //     return response()->json([
        //         'message' => 'Validation error',
        //         'errors' => $e->errors()
        //     ], 422);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'message' => 'An error occurred during import',
        //         'error' => $e->getMessage()
        //     ], 500);
        // }
    }

    public function usersSearch(Request $request){
        // Handle search functionality
        $query = $request->get('q');
        $user_id = $request->get('user_id');

        $users = User::where('role_name','employee')->where('id', '!=', $user_id)->where('name', 'LIKE', "%{$query}%")->paginate(10);

        return response()->json([
            'results' => $users->map(function ($user) {
                return ['id' => $user->id, 'text' => $user->name];
            }),
            'pagination' => [
                'more' => $users->currentPage() < $users->lastPage()
            ]
        ]);
    }

    public function superiorAdd(Request $request){
        // Handle search functionality
        $superior = $request->superior;

        $id = $request->id;

        if ($superior != $id) {

            $user = User::where('id',$id)->first();

            $user->superior_id = $superior;
    
            $user->save();

        }

        return response()->json([],200);
    }


    public function usersDepartmentSearch(Request $request){
        // Handle search functionality
        $query = $request->get('q');
        $user_id = $request->get('user_id');

        $departments = Department::where('name', 'LIKE', "%{$query}%")->paginate(10);

        return response()->json([
            'results' => $departments->map(function ($department) {
                return ['id' => $department->id, 'text' => $department->name];
            }),
            'pagination' => [
                'more' => $departments->currentPage() < $departments->lastPage()
            ]
        ]);
    }    


}


