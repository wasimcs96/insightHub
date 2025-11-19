<?php

namespace App\Http\Controllers\Candidate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserJobPreferredLocation;
use App\Models\UserJobSkill;
use App\Models\UserJobTechnicalSkill;
use App\Models\UserEmployment;
use Illuminate\Support\Facades\File;
use App\Models\MasterCountry;
use App\Models\MasterState;
use App\Models\MasterCity;
use App\Models\JobOpening;

use App\Models\TechnicalSkill;
use App\Models\MasterTechnicalSkill;
use App\Models\UserDocument;
use Illuminate\Support\Facades\Storage;




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
    public function index($step)
    {
        if(is_numeric($step)) {
            $step = config('helpers.register_steps_completed')[$step];
        } else {
            $step = config('helpers.steps_completed_name_first')[$step];
        }
        // dd($step);
        return view('auth.about_me')->with('step', $step);
    }

    public function store(Request $request) {
        // Assume the user is authenticated and we are updating the authenticated user's information
        $user = auth()->user();
        $step = $request->step;
        if ($step == 1) {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'first_name' => ['sometimes', 'string', 'max:255'],
                'last_name' => ['sometimes', 'string', 'max:255'],
                'nationality' => ['required', 'string'],

                'country_code' => ['sometimes', 'string'],
            ]);
            
            
            // Update user information with validated data
            $user->update([
                'first_name' => $validatedData['first_name'] ?? $user->first_name,
                'last_name' => $validatedData['last_name'] ?? $user->last_name,
                'country_code' => $validatedData['country_code'] ?? $user->country_code,
                'national_id' => $validatedData['nationality'] ?? $user->country_id,
                'steps_completed' => $step,
            ]);
        } elseif ($step == 2) {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'country_id' => ['required'],
                'state_id' => ['required'],
                'city_id' => ['required'],
                'postal_code' => ['required'],
                'address' => ['required'],
            ]);

            // Update user information with validated data
            $user->update([
                'country_id' => $validatedData['country_id'] ?? $user->country_id,
                'state_id' => $validatedData['state_id'] ?? $user->state_id,
                'city_id' => $validatedData['city_id'] ?? $user->city_id,
                'postal_code' => $validatedData['postal_code'] ?? $user->postal_code,
                'address' => $validatedData['address'] ?? $user->address,
                'steps_completed' => $step
            ]);
        } elseif ($step == 3) {
            // Validate the incoming request data
      
            $validatedData = $request->validate([
                'education_level_id' => ['required'],
                'education_year_id' => ['required'],
                'education_institution_id' => ['required'],
                'education_program_id' => ['required'],
                'prc_score'=>['nullable']
            ]);

           
            // Update user information with validated data
            $user->update([
                'education_level' => $validatedData['education_level_id'] ?? $user->education_level_id,
                'graduate_year' => $validatedData['education_year_id'] ?? $user->education_year_id,
                'prc_score' => $validatedData['prc_score'] ?? $user->prc_score,

                'higher_learning_institution' => $validatedData['education_institution_id'] ?? $user->education_institution_id,
                'education_program_id' => $validatedData['education_program_id'] ?? $user->education_program_id,
                'steps_completed' => $step
            ]);
        } elseif ($step == 4) {

            // dd($request->all());
            // Validate the incoming request data
            $validatedData = $request->validate([
                // 'job_expected_salary' => ['required'],
                'job_work_experience' => ['required'],
                'work_authorisation'=> ['required'],
                'job_id' => ['required'],
                // 'job_department_id' => ['required'],
                'job_preferred_locations' => ['required', 'array']
            ]);

            if(isset($validatedData['job_work_experience']) && $validatedData['job_work_experience'] == 0){
                $step = 5;
            }

            // Update user information with validated data
            $user->update([
                // 'job_expected_salary' => $validatedData['job_expected_salary'] ?? $user->job_expected_salary,
                'year_of_experience_in_it_sector' => $validatedData['job_work_experience'] ?? $user->job_work_experience,
                'preferred_job' => $validatedData['job_id'] ?? $user->job_id,
                'work_authorisation'=>$validatedData['work_authorisation'],
                // 'job_department_id' => $validatedData['job_department_id'] ?? $user->job_department_id,
                'steps_completed' => $step
            ]);

            if ($request->job_preferred_locations) {
                UserJobPreferredLocation::where('user_id', $user->id)->delete();

                foreach($request->job_preferred_locations as $job_preferred_location) {
                    UserJobPreferredLocation::create([
                        'user_id' => $user->id,
                        'city_id' => $job_preferred_location
                    ]);
                }
            }

        } elseif ($step == 5) {

            // dd($request->all());
            // Validate the incoming request data
            // $validatedData = $request->validate([
            //     // 'have_work_experience'=>['required'],
            //     'job_skills' => ['required_if:have_work_experience,1', 'array'],
            //     'job_technical_skills' => ['required_if:have_work_experience,1', 'array']
            // ]);

            // Update user information with validated data
            $user->update([
                'steps_completed' => $step,
                'do_you_have_experience_in_it_sector'=>$request->have_work_experience
            ]);

            if (isset($request->employments) && isset($request->employments[0]['job_title'])) {
                
                UserEmployment::where('user_id', $user->id)->delete();
                foreach ($request->employments as $employment) {
                    if (isset($employment['job_title']) && $employment['job_title'] != null) {
                        // dd($request->employments);
                        // Create employment record
                        $userEmp = UserEmployment::create([
                            'user_id' => $user->id,
                            'job_title' => $employment['job_title'] ?? '',
                            'company_name' => $employment['company_name'] ?? '',
                            'start_date' => $employment['start_date'] ?? '1970-01-01',
                            'end_date' => $employment['end_date'] ?? '1970-01-01',
                            'year_of_work' => $employment['year_of_work'] ?? '',
                            'location'=>$employment['location'] ?? ''
                        ]);
            
                        // Handle job skills and technical skills for employment
                      
                        $this->handleSkills($user, $employment['job_skills'], 'App\Models\UserJobSkill',$userEmp->id,'job_skill_id');
                        $this->handleSkills($user, $employment['job_technical_skills'], 'App\Models\UserJobTechnicalSkill', $userEmp->id, 'job_technical_skill_id');
                 
                        // Handle file uploads for certificates
                        if (isset($employment['certificate_of_employment'])) {
                            $this->handleEmpFileUpload($employment, 'certificate_of_employment', 'uploads/certificate_of_employment', $userEmp);
                        } else {
                            $userEmp->certificate_of_employment = $employment['existing_certificate_of_employment'] ?? null;
                            $userEmp->save();
                        }
            
                        if (isset($employment['clearance_certificate'])) {
                            $this->handleEmpFileUpload($employment, 'clearance_certificate', 'uploads/clearance_certificate', $userEmp);
                        } else {
                            $userEmp->clearance_certificate = $employment['existing_clearance_certificate'] ?? null;
                            $userEmp->save();
                        }
                    }
                }
            } else {
                UserEmployment::where('user_id', $user->id)->delete();
            }

          
        } elseif ($step == 6) {
        //   dd($request->all());
            $user = auth()->user();
// dd($request->all());
        $rules = [
            'id_card' => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:2048',
            'passport' => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:2048',
            'unified_mp_id' => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:2048',
            'birth_certificate' => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:2048',
            'driving_license' => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:2048',

            'tin_id' => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:2048',
            'voter_id' => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:2048',
            'education_certificate' => 'nullable|file|mimes:pdf,png,jpg,jpeg|max:2048',
            'cv_resume' => 'nullable|file|mimes:pdf|max:2048',
            'education_transcript' => 'nullable|file|mimes:pdf|max:2048',
        ];

        // if (!$request->has('existing_id_card')) {
        //     $rules['id_card'] = 'required|' . $rules['id_card'];
        // }
        // if (!$request->has('existing_passport')) {
        //     $rules['passport'] = 'required|' . $rules['passport'];
        // }
        // if (!$request->has('existing_unified_mp_id')) {
        //     $rules['unified_mp_id'] = 'required|' . $rules['unified_mp_id'];
        // }
        // if (!$request->has('existing_birth_certificate')) {
        //     $rules['birth_certificate'] = 'required|' . $rules['birth_certificate'];
        // }
        // if (!$request->has('existing_driving_license')) {
        //     $rules['driving_license'] = 'required|' . $rules['driving_license'];
        // }

        // if (!$request->has('existing_tin_id')) {
        //     $rules['tin_id'] = 'required|' . $rules['tin_id'];
        // }
        // if (!$request->has('existing_voter_id')) {
        //     $rules['voter_id'] = 'required|' . $rules['voter_id'];
        // }
        // if (!$request->has('existing_cv_resume')) {
        //     $rules['cv_resume'] = 'required|' . $rules['cv_resume'];
        // }
        // if (!$request->has('existing_education_transcript')) {
        //     $rules['education_transcript'] = 'required|' . $rules['education_transcript'];
        // }
        // if (!$request->has('existing_education_certificate')) {
        //     $rules['education_certificate'] = 'required|' . $rules['education_certificate'];
        // }

        $validatedData = $request->validate($rules);

        $this->handleFileUpload($request, 'cv_resume', 'uploads/cv_resumes', $user);
        $this->handleFileUpload($request, 'education_certificate', 'uploads/education_certificates', $user);
        $this->handleFileUpload($request, 'education_transcript', 'uploads/education_transcripts', $user);
        $this->handleFileUpload($request, 'prc_certificate', 'uploads/prc_certificates', $user);

        $this->handleFileUpload($request, 'id_card', 'uploads/id_cards', $user);
        $this->handleFileUpload($request, 'passport', 'uploads/passports', $user);
        $this->handleFileUpload($request, 'unified_mp_id', 'uploads/unified_mp_id', $user);
        $this->handleFileUpload($request, 'birth_certificate', 'uploads/birth_certificate', $user);
        $this->handleFileUpload($request, 'driving_license', 'uploads/driving_license', $user);
        $this->handleFileUpload($request, 'voter_id', 'uploads/voter_id', $user);
        $this->handleFileUpload($request, 'tin_id', 'uploads/tin_id', $user);

        // Handle file deletions
        if ($request->has('deleted_file_ids')) {
            foreach ($request->deleted_file_ids as $deletedFileId) {
                $fileRecord = UserDocument::find($deletedFileId);
                if ($fileRecord) {
                    Storage::disk('public')->delete($fileRecord->file_path);
                    $fileRecord->delete();
                }
            }
        }

        
        if($request->has('file_names')){
        foreach ($request->file_names as $index => $fileName) {
            $fileId = $request->file_ids[$index] ?? null;
            $filePath = $request->file_paths[$index] ?? null;
            $destiPath = 'uploads/addional_doc';

            if ($request->hasFile('education_certificates.' . $index)) {
                $file = $request->file('education_certificates.' . $index);
                // $filePath = $file->storeAs('uploads', $fileName . '.' . $file->getClientOriginalExtension(), 'public');

                $imageName = auth()->user()->first_name . '_' . auth()->user()->last_name . '_' . auth()->user()->id . '.' . $fileName.'.'. $file->extension();
                $file->move(public_path($destiPath), $imageName);
                $filePath = $destiPath . '/' . $imageName;

            }
    
            if ($fileId) {
                $fileRecord = UserDocument::find($fileId);
                if ($fileRecord) {
                    if ($request->hasFile('education_certificates.' . $index)) {
                        // Delete old file if a new file is uploaded
                        Storage::disk('public')->delete($fileRecord->file_path);
                    }
    
                    $fileRecord->update([
                        'file_name' => $fileName,
                        'file_path' => $filePath,
                    ]);
                }
            } else {
                UserDocument::create([
                    'user_id' => auth()->id(),
                    'file_name' => $fileName,
                    'file_path' => $filePath,
                ]);
            }
        }
    }
        $user->update([
            'is_all_steps_completed' => 1,
            'steps_completed' => $step
        ]);


        }
        // After successful update, redirect the user or return a response
        // For example, redirect back with a success message
        if ($step == 6) {
            $jobOpeningId = session()->get('job_opening_id');
           
            $jobOpening = JobOpening::find($jobOpeningId);
            
            if(isset($jobOpening)){
                // dd($jobOpeningId);
            
                $message = 'Success! You have created an account with us with the email ' . auth()->user()->email ?? '';
                return redirect()->route('apply-job',[$jobOpening->slug])->with('alert-success',$message);

            }else{
                $message = 'Success! You have created an account with us with the email ' . auth()->user()->email . ' Start applying for jobs and track your applications';
                return redirect()->route('all-jobs')->with('alert-success',$message);

            }

        } else {
            // dd($step);
            return redirect()->route('user.about.me',['step' =>$step+1])->with('success', 'Your profile has been updated successfully.')->with('step', $step + 1);
        }

    }

    // Method to fetch states by country
    public function getStates(Request $request)
    {
        $countryId = $request->country_id;
        $states = MasterState::where('country_id', $countryId)->get(['id', 'name']);

        return response()->json(['states' => $states]);
    }

    // Method to fetch cities by state
    public function getCities(Request $request)
    {
        // dd($request->all());
        if($request->searchTerm) {
            $searchTerm = $request->searchTerm;
            $cities = MasterCity::where('name', 'LIKE', '%' . $searchTerm . '%')
                                 ->get(['id', 'name']);
        } else {
            $stateId = $request->state_id;
            $cities = MasterCity::where('state_id', $stateId)->get(['id', 'name']);
        }


        return response()->json(['cities' => $cities]);
    }

    public function getTechnicalSkills(Request $request)
    {
        $query = $request->q;
        $ids = $request->ids;
    
        if ($ids) {
            $technicalSkills = MasterTechnicalSkill::whereIn('id', explode(',', $ids))->get();
        } else {
            $technicalSkills = MasterTechnicalSkill::where('name', 'LIKE', "%{$query}%")->paginate(10);
        }

        return response()->json([
            'results' => $technicalSkills->map(function ($technicalSkill) {
                return ['id' => $technicalSkill->id, 'text' => $technicalSkill->name.'( '.$technicalSkill->sector_name.' - '.$technicalSkill->sub_sector_name.' )'];
            }),
            'pagination' => [
                'more' => !$ids && $technicalSkills instanceof \Illuminate\Pagination\LengthAwarePaginator
                    ? $technicalSkills->currentPage() < $technicalSkills->lastPage()
                    : false
            ]
        ]);
    }

    private function handleFileUpload(Request $request, $fieldName, $destinationPath, $user)
    {
        if ($request->hasFile($fieldName)) {
            $currentImagePath = public_path($destinationPath . '/' . $user->$fieldName);
            if (File::exists($currentImagePath)) {
                File::delete($currentImagePath);
            }

            $imageName = auth()->user()->first_name . '_' . auth()->user()->last_name . '_' . auth()->user()->id . '.' . $request->$fieldName->extension();
            $request->$fieldName->move(public_path($destinationPath), $imageName);
            $imagePath = $destinationPath . '/' . $imageName;
            $user->update([$fieldName => $imagePath]);
        }
    }

    private function handleEmpFileUpload($employment, $fieldName, $destinationPath, $userEmp)
    {
        // dd(isset($employment[$fieldName]));
        if (isset($employment[$fieldName])) {
          
            $currentImagePath = public_path($destinationPath . '/' . $userEmp->$fieldName);
            if (File::exists($currentImagePath)) {
                File::delete($currentImagePath);
            }

            $imageName = $userEmp->id . '_'. auth()->user()->first_name . '_' . auth()->user()->last_name . '_' . auth()->user()->id . '.' . $employment[$fieldName]->extension();
            $employment[$fieldName]->move(public_path($destinationPath), $imageName);
            $imagePath = $destinationPath . '/' . $imageName;
            $userEmp->update([$fieldName => $imagePath]);
        }
        // dd($userEmp);
    }
    

    private function handleSkills($user, $skills, $model, $employ_id, $skill_column = 'job_skill_id') {
    //    dd($user);
        if (isset($skills)) {
            // Delete existing skills if any
            $model::where('user_id', $user->id)->delete();
    
            // Prepare data for batch insertion
            $data = array_map(function ($skill) use ($user, $employ_id, $skill_column) {
                return [
                    'user_id' => $user->id,
                    'employment_id' => $employ_id,
                    $skill_column => $skill
                ];
            }, $skills);
    
            // Insert all skills at once (batch insert)
            $model::insert($data);
        } else {
            // If no skills are provided, delete existing ones
            $model::where('user_id', $user->id)->delete();
        }
    }


    public function getcountries(Request $request)
    {
        
        $countries = MasterCountry::get(['id', 'name']);

        return response()->json(['countries' => $countries]);
    }
    
}
