<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserEmployment;

use App\Models\MasterBarangay;
use App\Models\MasterCity;


use App\Models\UserItSkill;
use Illuminate\Validation\Rule;

class AboutMeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $barangays = \App\Models\MasterBarangay::select('id','name')->get();
        $education_levels = \App\Models\MasterEducationLevel::all();
        $higher_learning_institutions = \App\Models\MasterHigherLearningInstitution::all();
        $edu_program = \App\Models\MasterEducationProgram::all();
        $sectors = \App\Models\MasterSector::all();
        $itSkills = \App\Models\MasterItSkill::all();
        // $cities = \App\Models\MasterCity::all();
        $provinces = \App\Models\MasterProvince::all();

        $data = [
            // 'barangays'=>$barangays,
            'education_levels'=>$education_levels,
            'higher_learning_institutions'=>$higher_learning_institutions,
            'edu_program'=>$edu_program,
            'sectors'=>$sectors,
            'itSkills'=>$itSkills,
            // 'cities'=>$cities,
            'provinces'=>$provinces
        ];
        return view('employee.about-me',$data);
    }

    public function store(Request $request)
    {
       
        // Validate the incoming request data
        $validatedData = $request->validate([
            // 'suffix' => 'required|string|max:255',
            // 'first_name' => 'required|string|max:255',
            // 'last_name' => 'required|string|max:255',
            // 'middle_name' => 'required|string|max:255',
            // 'course_name' => 'required|string|max:255',


            // 'email' => [
            //     'required',
            //     'email',
            //     Rule::unique('users')->ignore(auth()->user()->id),
            // ],
            // 'home_address' => 'required',
            // 'barangay_id'=>'required',
            // 'city_id'=>'required',
            // 'province_id'=>'required',
            // 'postal_code'=>'required',
            // 'mailing_address' => 'required',
            // 'mailing_barangay_id'=> 'required',
            // 'mailing_city_id'=> 'required',
            // 'mailing_province_id'=> 'required',
            // 'mailing_postal_code'=> 'required',
            // 'national_id' => 'required',
            // 'passport_no' => 'required',
            // 'passport_expiry_date' => 'required',
            // 'mobile_number' => 'required',
            // 'birth_date' => 'required',
            // 'age' => 'required',
            // 'gender' => 'required',
            'education_level' => 'required',
            'higher_learning_institution' => 'required',
            'education_program_id' => 'required',
            'graduate_year' => 'required',
            'national_id'=>'required',
            // 'do_you_have_experience_in_it_sector' => 'required',
            // 'year_of_experience_in_it_sector' => 'required',
            // 'sector_id' => 'required',

            // 'ec_contact_person_name' => 'required',
            // 'ec_relation_employee' => 'required',
            // 'ec_contact_person_number' => 'required',
            // 'ec_home_address' => 'required',
            // 'ec_barangay_id' => 'required',
            // 'ec_city_id' => 'required',
            // 'ec_province' => 'required',
            // 'ec_postal_code' => 'required',

            // 'tin_number' => 'required',
            // 'sss_number' => 'required',
            // 'hdmf_number' => 'required',
            // 'phil_number' => 'required',
            // 'consent_data' => 'required',
            // 'company_policy' => 'required',

            // 'city' => 'required'
        ]);

        // Find the user record to update
        $user = User::findOrFail(auth()->user()->id);

        $req_data = array_merge($request->all(), $validatedData);

        // $user->name = $request->first_name .' '. $request->middle_name .' '.$request->last_name;
        $user->suffix = $request->suffix;
        $user->first_time_login = 1;
        $user->graduate_year = $request->graduate_year;
        $user->skills = $request->skills;
        $user->professional_certificate = $request->professional_certificate;
        $user->training_program = $request->training_program;
        $user->mailing_postal_code = $request->mailing_postal_code;
        // Update the user record with the validated data
        $user->update($req_data);

        if (isset($request->employments)){

            UserEmployment::where('user_id',auth()->user()->id)->delete();
            foreach($request->employments as $employment){

               $emp =  UserEmployment::create([
                    'user_id' => auth()->user()->id,
                    'job_title' => $employment['job_title'],
                    'company_name' => $employment['company_name'],
                    'start_date' => $employment['start_date'],
                    'end_date' => $employment['end_date'] ?? '',
                    'year_of_work' => $employment['year_of_work'],
                    'key_responsiblity'=>$employment['key_responsiblity']
                ]);

            }
        } else {
            UserEmployment::where('user_id',auth()->user()->id)->delete();
        }

        // if (isset($request->it_skills)){
        //     UserItSkill::where('user_id',auth()->user()->id)->delete();
        //     foreach($request->it_skills as $it_skill){
        //         UserItSkill::create([
        //             'user_id' => auth()->user()->id,
        //             'it_skill_id' => $it_skill
        //         ]);
        //     }
        // } else {
        //     UserItSkill::where('user_id',auth()->user()->id)->delete();
        // }\

        // dd($user);

        return redirect()->route('employee.dashboard')->with('success', 'User profile updated successfully!');
    }

    public function barangaySearch(Request $request)
    {
      
        // Check if an ID is specified to fetch a specific barangay
        if ($request->has('id')) {
            $barangay = MasterBarangay::find($request->id);
            return response()->json([
                'id' => $barangay->id,
                'text' => $barangay->name
            ]);
        }

        // Handle search functionality
        $query = $request->get('q');
        $barangays = MasterBarangay::where('name', 'LIKE', "%{$query}%")->paginate(10);

        return response()->json([
            'results' => $barangays->map(function ($barangay) {
                return ['id' => $barangay->id, 'text' => $barangay->name];
            }),
            'pagination' => [
                'more' => $barangays->currentPage() < $barangays->lastPage()
            ]
        ]);
    }

    public function citySearch(Request $request)
    {
      
        // Check if an ID is specified to fetch a specific barangay
        if ($request->has('id')) {
            $city = MasterCity::find($request->id);
            return response()->json([
                'id' => $city->id,
                'text' => $city->name
            ]);
        }

        // Handle search functionality
        $query = $request->get('q');
        $city = MasterCity::where('name', 'LIKE', "%{$query}%")->paginate(10);

        return response()->json([
            'results' => $city->map(function ($city) {
                return ['id' => $city->id, 'text' => $city->name];
            }),
            'pagination' => [
                'more' => $city->currentPage() < $city->lastPage()
            ]
        ]);
    }



}
