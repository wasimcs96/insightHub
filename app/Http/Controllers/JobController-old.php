<?php

namespace App\Http\Controllers;

use App\Helpers\AssessmentHelper;
use App\Models\CwfFunction;
use App\Models\Job;
use App\Models\JobSkill;
use App\Models\JobCriticalFunction;
use App\Models\MasterSkill;
use App\Models\TechnicalSkill;
use App\Models\User;
use App\Models\Department;
use App\Models\JobPerformanceExpectation;
use App\Models\JobSecondaryScopeOfStudy;
use App\Models\JobSubordinate;
use App\Models\JobTechnicalSkills;
use App\Models\Sector;
use App\Models\MasterTechnicalSkill;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class JobController extends Controller
{
    // Display a listing of the resource.
    public function index(Request $request)
    {
        
        
        if (auth()->user()->role_id == 7) {
            
            $levels = ["Level 1" => 1, "Level 2" => 2, "Level 3" => 3, "Level 4" => 4, "Level 5" => 5, "Level 6" => 6];
           
            $sectorName = $request->sector_name;
            // $sectors = Sector::all();
            $sectors = Sector::when($request->sector_name, function ($query, $sectorName) {
                return $query->where('name', 'like', '%' . $sectorName . '%');
            })->get();

            $departments = Department::where('company_id',auth()->user()->company_id)->get();

            $data = [];


                foreach ($sectors as $key => $value) {
                        
                  
                    $jobsQuery1 = Job::where('is_primary', 1)->where('department_id', $value->id)->count();
                    

                    $data[$value->name] = ["icon"=>$value->icon,"id" => $value->id, "count" => $jobsQuery1];
                }
           

            return view('admin.jd_dashboard', compact('data'));
        } else {
            $levels = ["Level 1" => 1, "Level 2" => 2, "Level 3" => 3, "Level 4" => 4, "Level 5" => 5, "Level 6" => 6];

            $sectorName = $request->sector_name;
            // $sectors = Sector::all();
            $sectors = Sector::when($request->sector_name, function ($query, $sectorName) {
                return $query->where('name', 'like', '%' . $sectorName . '%');
            })->get();

            $departments = Department::where('company_id',auth()->user()->id)->get();

            $data = [];

                foreach ($sectors as $key => $value) {
                        
                  
                        $jobsQuery1 = Job::where('is_primary', 1)->where('department_id', $value->id)->count();
                    

                    $data[$value->name] = ["icon"=>$value->icon,"id" => $value->id, "count" => $jobsQuery1];
                }
           

            return view('admin.jd_dashboard', compact('data'));
        }
    }

        // Display a listing of the resource.
    public function savedJobs(Request $request)
        {
               
            if (auth()->user()->role_id == 7) {
                
                $levels = ["Level 1" => 1, "Level 2" => 2, "Level 3" => 3, "Level 4" => 4, "Level 5" => 5, "Level 6" => 6];
    
                $sectors = Sector::all();

                $query = Department::where('company_id',auth()->user()->company_id);
                if(request()->has('name')){
                   $query->where('name', 'like', '%' . $request->name . '%');
                }
               
                $departments = $query->get();

                $data = [];
    
                
                    foreach ($departments as $key => $value) {
                        
                        
                        $jobsQuery1 = Job::where('is_primary', 0)->where('org_department', $value->id)->count();
                      
    
                        $data[$value->name] = ["icon"=>'',"id" => $value->id, "count" => $jobsQuery1];
                    }
    
                return view('admin.jd.saved_jd_dashboard', compact('data'));
            } else {
                $levels = ["Level 1" => 1, "Level 2" => 2, "Level 3" => 3, "Level 4" => 4, "Level 5" => 5, "Level 6" => 6];
    
                $sectors = Sector::all();
    
                // $departments = Department::where('company_id',auth()->user()->id)->get();
                $query = Department::where('company_id',auth()->user()->id);
                if(request()->has('name')){
                   $query->where('name', 'like', '%' . $request->name . '%');
                }
               
                $departments = $query->get();

                $data = [];
    
    
    
                
                foreach ($departments as $key => $value) {
                        
                        
                        $jobsQuery1 = Job::where('is_primary', 0)->where('org_department', $value->id)->count();
                      
    
                        $data[$value->name] = ["icon"=>'',"id" => $value->id, "count" => $jobsQuery1];

                }
    
                return view('admin.jd.saved_jd_dashboard', compact('data'));
            }
        }



    // Show the form for creating a new resource.
    public function create()
    {

        $departments = Sector::all();

        $orgDepartments = Department::where('company_id',auth()->user()->id)->where('status',1)->get();

        if (auth()->user()->role_id == 7) {
           $orgDepartments = Department::where('company_id',auth()->user()->company_id)->where('status',1)->get();  
        }

        $data = [];

        foreach ($departments as $key => $value) {
            $data[$value->name] = $value->id;
        }

        $jobs = Job::where('is_primary', 1)->get();
        $existingJobs = Job::where('is_primary', 0)->get();
        $masterSkills = MasterSkill::all();
        $technicalSkills = [];
        return view('admin.setting.job_create', compact('jobs', 'masterSkills', 'technicalSkills', 'data','orgDepartments','existingJobs'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $messages = [
            'functions.required' => 'Please add at least one critical function.',
            'functions.*.title.required' => 'Each critical function must have a title.',
            'technicalSkills.required' => 'Please add at least one technical skill.',
        ];

        $validatedData = $request->validate([
            'jd_from' => 'required',
            'title' => 'required|string|max:255',
            'status' => 'required',
            'description' => 'required|string',
            'functions' => 'required|array|min:1', // Ensures that there is at least one function
            'functions.*.title' => 'required|string', // Ensures each function has a title
            'technicalSkills' => 'required|array|min:1', // Ensures that there is at least one function
            'heads' => 'required',
            'level' => 'required',
            'org_department' => 'required',
            'position_code' => 'required',
        ], $messages);

        $job_type = 'custom';

        $job = new Job();
        $job->title = $validatedData['title'];
        $job->status = $validatedData['status'];
        $job->description = $validatedData['description'];
        $job->heads = $validatedData['heads'];
        $job->level = $validatedData['level'];
        $job->org_department = $validatedData['org_department'];
        $job->code = $validatedData['position_code'];
        $job->position_code = Job::generateUniquePositionCode();
        $job->saved_job = 1;

        $job->education_level = $request->education_level;
        $job->scope_of_study = $request->scope_of_study;
        $job->professional_certificate = $request->professional_certificate;
        $job->relevant_training = $request->relevant_training;
        $job->work_experience = $request->work_experience;
        $job->relevant_course = $request->relevant_course;

        if ($jd_from = $request->jd_from) {
            
            if ($jd_from == "2") {
                if ($job_type = $request->job_type) {
                    $job->department_id = $request->department;
                    $job->level = $request->level;
                    $job->top3riasec = $request->top3riasec;
                    $masterJob = Job::where('id',$job_type)->first();
                    $job->sierra_id = $job_type;
                    $job->master_id = $job_type;
                    $job->job_type = 'master';
                }
            }else if ($jd_from == "3") {
                if ($job_type = $request->job_type) {
                    $job->level = $request->level;
                    $job->top3riasec = $request->top3riasec;
                    $masterJob = Job::where('id',$job_type)->first();
                    $job->sierra_id = $masterJob->sierra_id;
                    $job->master_id = $job_type;
                    $job->job_type = 'saved';
                }
            } else if ($jd_from == "1") {
                    $job->level = $request->level;
                    $job->job_type = 'custom';
                    $job->top3riasec = implode("", $request->riasec);                
            }
        }

        if ($superior = $request->superior) {
            $job->superior_id = $superior;
        }


        $job->save();

        // Handle job skills
        foreach ($request->skills as $skillData) {
            if ($skillData['title'] != null) {
                $skill = new JobSkill();
                $skill->job_id = $job->id;
                $skill->title = $skillData['title'] ?? '';
                $skill->level = $skillData['level'];
                $skill->save();
            }
        }

        JobTechnicalSkills::where('job_id', $job->id)->delete();

        // Handle technical skills association
        if ($request->has('technicalSkills')) {
            foreach ($request->technicalSkills as $skillId => $data) {
                if (array_key_exists('id',$data) && $data['id']) {
                $tech = new JobTechnicalSkills();
                $tech->job_id = $job->id;
                $tech->master_technical_skill_id = $data['id'];
                $tech->level = $data['level'];
                $tech->save();
                }
            }
        }

        if ($request->has('subordinates') && count($request->subordinates) > 0) {
            foreach ($request->subordinates as $key22 => $value22) {
                JobSubordinate::create(['job_id'=>$job->id,'subordinate_id'=>$value22]);
            }
        }
        

        // Handle job critical functions
        foreach ($request->functions as $functionData) {

            $function = new JobCriticalFunction();
            $function->job_id = $job->id;
            $function->description = $functionData['title'] ?? '';
            $function->save();

            if (array_key_exists("keys",$functionData) && $functionData['keys'] && count($functionData['keys']) > 0) {
                foreach ($functionData['keys'] as $val1) {
                    $cwfunction = new CwfFunction();
                    $cwfunction->cwf_id = $function->id;
                    $cwfunction->name = $val1 ?? '';
                    $cwfunction->save();
                }
            }
        }

        if ($request->perfomance_expectation && count($request->perfomance_expectation) > 0) {
            foreach ($request->perfomance_expectation as $val1) {
                $perfomance_expectation = new JobPerformanceExpectation();
                $perfomance_expectation->job_id = $job->id;
                $perfomance_expectation->title = $val1 ?? '';
                $perfomance_expectation->save();
            }
        }

        if ($request->secondary_scope_of_study && count($request->secondary_scope_of_study) > 0) {
            foreach ($request->secondary_scope_of_study as $val1) {
                $secondary_scope_of_study = new JobSecondaryScopeOfStudy();
                $secondary_scope_of_study->job_id = $job->id;
                $secondary_scope_of_study->title = $val1 ?? '';
                $secondary_scope_of_study->save();
            }
        }
        
        return redirect()->route('admin.saved.jobdescriptions',['org_department'=>$job->org_department])->with('success', 'Job created successfully.');
    }

    public function duplicateFromSierra(Request $request)
    {

        // set_time_limit(1200);   
        $id = Sector::all();
        $allJobs = [];

        foreach ($id as $key => $value) {
            $ch = curl_init();

            // Data to be sent in the URL query string
            $data = ['department_id' => $value->sierra_id];
            $query = http_build_query($data);

            // Append the query string to the URL
            $url = "https://sierra.cxs.team/api/job-description/by_department?" . $query;

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL peer verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  // Disable SSL host verification

            // Since it's a GET request, we don't set CURLOPT_POST or CURLOPT_POSTFIELDS
            $response = curl_exec($ch);
            curl_close($ch);
            $jobs = json_decode($response);
            
            foreach ($jobs as $key1 => $value1) {
                $allJobs[$key1] = $value1;
            }


        }

        $allJobsData = [];

        foreach ($allJobs as $key3 => $value3) {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://sierra.cxs.team/api/job-description/job/select");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL peer verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  // Disable SSL host verification
            curl_setopt($ch, CURLOPT_POST, true);

            $data = ['id' => $key3];
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

            $response = curl_exec($ch);

            curl_close($ch);

            $jobsierra = json_decode($response);

            $technicalSkills = $jobsierra->job->technical_skills;

            
            array_push($allJobsData,$jobsierra->job);
        }

        foreach ($allJobsData as $key4 => $value4) {
            $jobCheck = Job::where('sierra_id',$value4->id)->where('is_primary',1)->first();
            if (!$jobCheck) {
                if($value4->top3riasec && $value4->top3riasec != '' ){
                    $job = new Job();
                    $job->title = $value4->title;
                    $job->description = $value4->description;
                    $job->is_primary = 1;
                    $job->heads = 1;
                    $job->level = $value4->level;
                    $job->saved_job = 0;
                    $job->position_code = AssessmentHelper::generateUniquePositionCode();
                    $job->department_id = Sector::where('sierra_id',$value4->department_id)->first()->id;
                    $job->sierra_id = $value4->id;
                    $job->top3riasec = $value4->top3riasec;
                    $job->save();
    
                    foreach ($value4->skills as $skillData) {
                        $skill = new JobSkill();
                        $skill->job_id = $job->id;
                        $skill->title = $skillData->title ?? '';
                        $skill->level = $skillData->level;
                        $skill->save();
                    }
    
                    // Handle job critical functions
                    foreach ($value4->critical_functions as $functionData) {
    
                        $function = new JobCriticalFunction();
                        $function->job_id = $job->id;
                        $function->description = $functionData->description ?? '';
                        $function->save();
    
                        if ($functionData->cwf_keys && count($functionData->cwf_keys) > 0) {
                            foreach ($functionData->cwf_keys as $val1) {
                                $cwfunction = new CwfFunction();
                                $cwfunction->cwf_id = $function->id;
                                $cwfunction->name = $val1->name ?? '';
                                $cwfunction->save();
                            }
                        }
                    }
    
                    // Handle technical skills association
                    if ($value4->technical_skills) {
                        foreach ($value4->technical_skills as $skillId => $data) {
                            $tech = new JobTechnicalSkills();
                            $tech->job_id = $job->id;
                            $tech->master_technical_skill_id = $data->id;
                            $tech->level = $data->pivot->level;
                            $tech->save();
                        }
                    }
                }
             }
        }



        return redirect()->route('admin.jobdescriptions',['department'=>$job->department_id])->with('success', 'Job created successfully.');
    }


    // Show the form for editing the specified resource.
    public function edit(Job $job)
    {
        $masterSkills = MasterSkill::all();


        try {
            if ($job->sierra_id && $job->sierra_id != null) {
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, "https://sierra.cxs.team/api/job-description/job/select");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL peer verification
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  // Disable SSL host verification
                curl_setopt($ch, CURLOPT_POST, true);

                $data = ['id' => $job->sierra_id];
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

                $response = curl_exec($ch);

                curl_close($ch);

                $jobsierra = json_decode($response);

                $technicalSkills = $jobsierra->job->technical_skills;
            } else {
                $technicalSkills = $job->technicalSkills;
            }
        } catch (\Throwable $th) {
            $technicalSkills = $job->technicalSkills;
        }
        

        $job = Job::with('criticalFunctions.cwfKeys')->find($job->id);

        $existingJobs = Job::where('is_primary', 0)->get();

        $orgDepartments = Department::where('company_id',auth()->user()->id)->where('status',1)->get();

        if (auth()->user()->role_id == 7) {
            $orgDepartments = Department::where('company_id',auth()->user()->company_id)->where('status',1)->get();  
        }

        return view('admin.setting.job_edit', compact('job', 'masterSkills', 'technicalSkills','orgDepartments','existingJobs'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Job $job)
    {
        
        $messages = [
            'functions.required' => 'Please add at least one critical function.',
            'functions.*.title.required' => 'Each critical function must have a title.',
            'technicalSkills.required' => 'Please add at least one technical skill.',
        ];
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'functions' => 'required|array|min:1', // Ensures that there is at least one function
            'functions.*.title' => 'required|string', // Ensures each function has a title
            'technicalSkills' => 'required|array|min:1', // Ensures that there is at least one function
            'heads' => 'required',
            'org_department'=> 'required', 
            'position_code'=> 'required',
            'status' => 'required'
            // 'position_code' => 'required|unique:jobs,position_code,' . $job->id,

        ], $messages);

        $job->title = $validatedData['title'];
        $job->status = $validatedData['status'];
        $job->description = $validatedData['description'];
        $job->heads = $validatedData['heads'];
        $job->level = $request->level_job;
        $job->org_department = $validatedData['org_department'];
        $job->saved_job = 1;
        $job->code = $validatedData['position_code'];
        $job->education_level = $request->education_level;
        $job->scope_of_study = $request->scope_of_study;
        $job->professional_certificate = $request->professional_certificate;
        $job->relevant_training = $request->relevant_training;
        $job->work_experience = $request->work_experience;
        $job->relevant_course = $request->relevant_course;


        if ($superior = $request->superior) {
            $job->superior_id = $superior;
        }
        if ($job->job_type == "custom") {
            $job->top3riasec = implode("", $request->riasec);                
        }


        $job->save();



        JobSkill::where('job_id',$job->id)->delete();
        // Handle job skills update
        foreach ($request->skills as $skillData) {
            if ($skillData['title'] != null) {
                $skill = new JobSkill();
                $skill->title = $skillData['title'] ?? '';
                $skill->level = $skillData['level'];
                $skill->job_id = $job->id;
                $skill->save();
            }
        }

        // $job->technicalSkills()->detach(); // Remove all existing associations

        JobTechnicalSkills::where('job_id', $job->id)->delete();

        

        if ($request->has('technicalSkills')) {
            foreach ($request->technicalSkills as $skillId => $data) {
                if (array_key_exists('id',$data) && $data['id']) {
                    $tech = new JobTechnicalSkills();
                    $tech->job_id = $job->id;
                    $tech->master_technical_skill_id = $data['id'];
                    $tech->level = $data['level'];
                    $tech->save();
                }
            }
        }


        // Handle job critical functions update
        JobCriticalFunction::where('job_id', $job->id)->delete();
        foreach ($request->functions as $functionData) {
            $function = new JobCriticalFunction();
            $function->job_id = $job->id;
            $function->description = $functionData['title'] ?? '';
            $function->save();

            // Assuming you are also handling some sort of keys for each function
            if (array_key_exists("keys",$functionData) && !empty($functionData['keys'])) {
                foreach ($functionData['keys'] as $key) {
                    $cwfunction = new CwfFunction();
                    $cwfunction->cwf_id = $function->id;
                    $cwfunction->name = $key ?? '';
                    $cwfunction->save();
                }
            }
        }

        

        if ($job->subordinates->count() > 0) {
            JobSubordinate::where('job_id',$job->id)->delete();
        }

        if ($request->has('subordinates') && count($request->subordinates) > 0) {
            foreach ($request->subordinates as $key22 => $value22) {
                JobSubordinate::create(['job_id'=>$job->id,'subordinate_id'=>$value22]);
            }
        }

        JobPerformanceExpectation::where('job_id', $job->id)->delete();
        if ($request->perfomance_expectation && count($request->perfomance_expectation) > 0) {
            foreach ($request->perfomance_expectation as $val1) {
                $perfomance_expectation = new JobPerformanceExpectation();
                $perfomance_expectation->job_id = $job->id;
                $perfomance_expectation->title = $val1 ?? '';
                $perfomance_expectation->save();
            }
        }

        JobSecondaryScopeOfStudy::where('job_id', $job->id)->delete();
        if ($request->secondary_scope_of_study && count($request->secondary_scope_of_study) > 0) {
            foreach ($request->secondary_scope_of_study as $val1) {
                $secondary_scope_of_study = new JobSecondaryScopeOfStudy();
                $secondary_scope_of_study->job_id = $job->id;
                $secondary_scope_of_study->title = $val1 ?? '';
                $secondary_scope_of_study->save();
            }
        }

        if ($job->is_primary == "0") {
            return redirect()->route('admin.saved.jobdescriptions',['org_department'=>$job->org_department,'saved_job'=>'1'])->with('success', 'Job updated successfully.');
        }else{
            return redirect()->route('admin.jobdescriptions',['department'=>$job->department_id])->with('success', 'Job updated successfully.');
        }
    }

    // Remove the specified resource from storage.
    public function destroy(Job $job)
    {
        // $jobs = Job::where('is_primary',1)->get();

        // foreach ($jobs as $key => $job) {
            $department_id = $job->org_department;
            // Delete associated job skills
            $job->skills()->delete();
        
            // Delete associated job critical functions
            $job->criticalFunctions()->delete();
        
            // Delete the job itself
            $job->delete();
        // }

        // $department_id = $job->org_department;
        // // Delete associated job skills
        // $job->skills()->delete();
    
        // // Delete associated job critical functions
        // $job->criticalFunctions()->delete();
    
        // // Delete the job itself
        // $job->delete();
        
        return redirect()->route('admin.saved.jobdescriptions',['org_department'=>$department_id])->with('success', 'Job deleted successfully.');
    }

    public function primaryJob(Request $request)
    {

        if ($request->has('savedJob') && $request->savedJob == 3) {
            $job = Job::with(['skills', 'criticalFunctions.cwfKeys'])->where('id', $request->id)->first();
            $jobData = ['job' => $job, 'technicalSkills' => $job->technicalSkills->pluck('id', 'name')->toArray()];
    
            $job = $jobData;
    
            $masterSkills = MasterSkill::get(); // Fetch all master skills from the database
    
        
            // Iterate over the skills in the job object
            foreach ($job['job']->skills as &$skill) {
            
                // Find the matching master skill by title
                foreach ($masterSkills as $masterSkill) {
                
                    if ($skill->title == $masterSkill->name) {
                        // Add the level data to the skill
                        $skill->level_1 = $masterSkill->level_1;
                        $skill->level_1_ability = $masterSkill->level_1_ability;
                        $skill->level_1_knowledge = $masterSkill->level_1_knowledge;
    
                        $skill->level_2 = $masterSkill->level_2;
                        $skill->level_2_ability = $masterSkill->level_2_ability;
                        $skill->level_2_knowledge = $masterSkill->level_2_knowledge;
    
                        $skill->level_3 = $masterSkill->level_3;
                        $skill->level_3_ability = $masterSkill->level_3_ability;
                        $skill->level_3_knowledge = $masterSkill->level_3_knowledge;
                    }
                }
            }
        
            unset($skill); // Break reference with the last element
        
            // Print the updated skills with levels
            $techskillids = collect($job['job']->technicalSkills)->pluck('master_technical_skill_id')->toarray();
            // dd($techskillids);
            $mastertechskill = MasterTechnicalSkill::whereIn('id',$techskillids)->get();
        
            $data = ['job' => $job['job'], 'technicalSkills' => $job['job']->technicalSkills,'mastertechnicalskill'=>$mastertechskill];
    
            return response()->json($data, 200);
        }else{
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://sierra.cxs.team/api/job-description/job/select");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL peer verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  // Disable SSL host verification
            curl_setopt($ch, CURLOPT_POST, true);
    
            $data = ['id' => $request->id];
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    
            $response = curl_exec($ch);
    
            curl_close($ch);
    
            $jobData = json_decode($response);
    
            $job = $jobData;
    
            
    
            $masterSkills = MasterSkill::get(); // Fetch all master skills from the database
    
            $data = [];
            if ($job) {
                // Iterate over the skills in the job object
                foreach ($job->job->skills as &$skill) {
                
                    // Find the matching master skill by title
                    foreach ($masterSkills as $masterSkill) {
                        
                        if ($skill->title == $masterSkill->name) {
                            // Add the level data to the skill
                            $skill->level_1 = $masterSkill->level_1;
                            $skill->level_1_ability = $masterSkill->level_1_ability;
                            $skill->level_1_knowledge = $masterSkill->level_1_knowledge;
        
                            $skill->level_2 = $masterSkill->level_2;
                            $skill->level_2_ability = $masterSkill->level_2_ability;
                            $skill->level_2_knowledge = $masterSkill->level_2_knowledge;
        
                            $skill->level_3 = $masterSkill->level_3;
                            $skill->level_3_ability = $masterSkill->level_3_ability;
                            $skill->level_3_knowledge = $masterSkill->level_3_knowledge;
                        }
                    }
                }
                
                unset($skill); // Break reference with the last element
                
                // Print the updated skills with levels
                $techskillids = collect($job->job->technical_skills)->pluck('master_technical_skill_id')->toarray();
        
                $mastertechskill = MasterTechnicalSkill::whereIn('id',$techskillids)->get();

                $job->job->technical_skills = $job->technicalSkillsModified;
                
                $data = ['job' => $job->job, 'technicalSkills' => $job->technicalSkills,'mastertechnicalskill'=>$mastertechskill,'technicalSkillsModified'=>$job->technicalSkillsModified];
            }
            return response()->json($data, 200);
        }
    }

    public function allJobsByDepartment(Request $request)
    {
        $jobs = Job::where('department_id',$request->department_id)->where('is_primary',1)->pluck('title','sierra_id');
        return response()->json($jobs, 200);
    }


    public function allJobsByOrgDepartment(Request $request)
    {
        try {         
                $jobs = Job::where('org_department', $request->department_id)
                ->where('status', 2)
                ->withCount(['employees as assigned_users_count' => function ($query) {
                    $query->whereColumn('position_id', 'jobs.id');
                }])
                ->selectRaw("
                    jobs.id,
                    CONCAT(jobs.title, ' (Vacancies - ', (heads - 
                        (SELECT COUNT(*) FROM users WHERE users.position_id = jobs.id)
                    ), ')') as title_with_vacancies")
                ->havingRaw('heads > (SELECT COUNT(*) FROM users WHERE users.position_id = jobs.id)')
                ->where('is_primary', 0)
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                          ->from('job_openings')
                          ->whereColumn('job_openings.position_id', 'jobs.id');
                })
                ->orderBy('level', 'DESC')
                ->pluck('title_with_vacancies', 'id');

            return response()->json($jobs, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function allJobsByOrgDepartmentForJD(Request $request)
    {
        try {         
                $jobs = Job::where('org_department', $request->department_id)->pluck('title','id');

            return response()->json($jobs, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function addToSave(Request $request){
      
        $request->validate([
            'job_id' => 'required',
        ]);

        // Simulate storing the data
        $job_id = $request->input('job_id');

        $job = Job::find($job_id);

        if ($request->type != '1') {
            $job->org_department = null;
        }    

        $job->saved_job = $request->type;

        $job->save();
        // Return a response
        if ($request->type == '1') {
            return redirect()->route('admin.jobdescriptions',['saved_job'=>1])->with('success' , 'Job is successfully saved');
        }else{
            return redirect()->route('jobs.index')->with('success' , 'Job is successfully removed from the saved list');
        }
    }

    public function getEmployee(Request $request){

        $query = $request->get('q');
        $barangays = User::where('company_id',auth()->user()->id)->where('name', 'LIKE', "%{$query}%")->paginate(10);

        return response()->json([
            'results' => $barangays->map(function ($barangay) {
                return ['id' => $barangay->id, 'text' => $barangay->name];
            }),
            'pagination' => [
                'more' => $barangays->currentPage() < $barangays->lastPage()
            ]
        ]);
    }

    public function saveEmployee(Request $request){

        $users = User::where('position_id',$request->job_id)->get();

        foreach ($users as $key1 => $value1) {
            $value1->department_id = null;
            $value1->position_id = null;
            $value1->save();
        }

        if ($request->employees && count($request->employees) > 0) {
            foreach ($request->employees as $key => $value) {
                $user = User::find($value);
                $user->position_id = $request->job_id;
                $user->department_id = $request->department;
                $user->save();
            }
        }

        return redirect()->back()->with('success','employees saved successfully');
    }

    public function technicalSkillsSearch(Request $request)
    {
        // Handle search functionality
        $query = $request->get('q');
        $technicalSkills = MasterTechnicalSkill::where('name', 'LIKE', "%{$query}%")->paginate(10);

        return response()->json([
            'results' => $technicalSkills->map(function ($technicalSkill) {
                return ['id' => $technicalSkill->id, 'text' => $technicalSkill->name.'('.$technicalSkill->sector_name.'-'.$technicalSkill->sub_sector_name.')'];
            }),
            'pagination' => [
                'more' => $technicalSkills->currentPage() < $technicalSkills->lastPage()
            ]
        ]);
    }

    public function generateRiasecCode(Request $request){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://sierra.cxs.team/api/job-description/riasec_code");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // Disable SSL peer verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  // Disable SSL host verification
        curl_setopt($ch, CURLOPT_POST, true);

        $data = ['job' => $request->job_role];
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $response = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($response);

        return response()->json($result,200);
    }

    public function checkPositionCode(Request $request)
    {
        // if ($request->has('position_update')) {
        //     $positionCode = $request->input('position_code');
        //     $jobId = $request->input('job_id');

        //     $exists = Job::where('position_code', $positionCode)
        //                 ->where('id', '!=', $jobId)  // Exclude the current job record from the check
        //                 ->exists();
        // }else{
        //     $positionCode = $request->input('position_code');
        //     $exists = Job::where('position_code', $positionCode)->exists();
        // }

        return response()->json(['isUnique' => true]);
    }
}
