<?php

namespace App\Imports;

use App\Helpers\HelperFunctions;
use App\Models\Department;
use App\Models\DepartmentSection;
use App\Models\Job;
use App\Models\MasterCity;
use App\Models\MasterCountry;
use App\Models\MasterEducationProgram;
use App\Models\MasterHigherLearningInstitution;
use App\Models\MasterProvince;
use App\Models\Position;
use App\Models\Section;
use App\Models\User;
use App\Models\JobOpening;
use App\Models\JobOpeningApplication;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CandidateImport implements ToCollection, WithHeadingRow
{
    protected $auth;

    public function __construct($auth)
    {
        $this->auth = $auth;
    }

    public function collection(Collection $rows)
    {
        // dd($rows);
        
        foreach ($rows as $row) {
          

            $dept = null;
            $sector_id = null;
            $job_id = null;
          
            $salary = $row['salary'] ?? '';
           
        
            $salaryRange = explode('-', str_replace('K', '000', $salary));
            $lowerBoundSalary = intval($salaryRange[0] ?? 0);
            $upperBoundSalary = intval($salaryRange[1] ?? 0);
            $expectedSalary = ($lowerBoundSalary + $upperBoundSalary) / 2;

            Log::info('Row Data:', $row->toArray());
           
            // Validate required fields
            $validator = Validator::make($row->toArray(), [
                'first_name' => 'required|string|max:255',
                // 'last_name' => 'required|string|max:255',
                'email_address_personal' => 'required|email|unique:users,email',
                'department' => 'required|string|max:255',
                'job_title' => 'required|string|max:255',
                // Add other necessary validation rules
            ]);

            if ($validator->fails()) {
                Log::info('Validation failed for row:', $validator->errors()->toArray());
                continue; 
            }
            
            $firstName = $row['first_name'] ?? '';
            $nameParts = explode(',',  $firstName);
        //    dd($nameParts);
            $row['first_name'] = trim($nameParts[0]);
           
            $row['last_name'] = trim($nameParts[1]);

            $department = Department::where('id',149)->first();
            $job = Job::where('id',4796)->first();
            $jobDetail = JobOpening::where('id',45)->first();
            // $department = Department::where('head_of_department', $row['department'])->first();
        
            // if ($department) {
            //     $dept = $department->id;

            //     $position = Job::where('title', $row['job_title'])->first();
            //     if ($position) {
            //         $job_id = $position->id;
            //         $sector_id = $position->department_id;
            //     }
            // }else{
            //     $dept = Department::create(['name'=>$row['department'],'head_of_department'=>$row['department'],'status'=>1]);
            //     $dept = $dept->id;
            // }








            DB::beginTransaction();
          

            try {
                $randomPassword = Str::random(12);
                $hashedPassword = Hash::make($randomPassword);

                $dob = null;

                $date_of_hire = null;

                $gender = 2;

                $employment_status = null;

                if ($row['gender'] == 'M') {
                    $gender = 0;
                }else if ($row['gender'] == 'F') {
                    $gender = 1;
                }else{
                    $gender = 2;
                }

                $firstName = $row['first_name'] ?? '';
                $lastName = $row['last_name'] ?? '';
                $user = User::create([
                    'name' => $firstName . ' ' . $lastName,
                    'first_name' => $firstName ?? '',
                    'last_name' =>  $lastName,
                    'role_id'=>8,
                    'role_name'=>'candidate',
                    'email' => $row['email_address_personal'] ?? '',
                    'department_id' => $dept,
                    'position_id' => $job_id,
                    'password' => $hashedPassword,
                    'company_id' => $this->auth->id,
                    'home_address' => $row['address'] ?? '',
                    'mobile_number' => $row['mobile_number'] ?? '',

                ]);

                if ($row['name_of_school_university']) {
                    $institute = MasterHigherLearningInstitution::where('name','like','%'.$row['name_of_school_university'].'%')->first();
                    if (!$institute) {
                      $institute=MasterHigherLearningInstitution::create(['name'=>$row['name_of_school_university']]);
                    }
                    $user->higher_learning_institution = $institute->id;
                }

                if ($row['course_program']) {
                    $program = MasterEducationProgram::where('name','like','%'.$row['course_program'].'%')->first();
                    if (!$program) {
                        $program = MasterEducationProgram::create(['name'=>$row['course_program']]);
                    }
                    $user->education_program_id = $program->id;
                }

                $user->save();
    
                       // Store job application details with salary bounds
                        $application = new JobOpeningApplication();
                        $application->job_opening_id = 45;
                        $application->external_user_id = $user->id;
                        $application->status = 1;
                        $application->user_id = $user->id;
                        $application->application_status =1;
                        $application->external_user_name = $user->name ?? '';
                        $application->applied_date = Carbon::now('Asia/Manila');
                        $application->status_changed_date = Carbon::now('Asia/Manila');
                        $application->external_user_email = $user->email ?? '';
                        $application->salary_lower_bound = $lowerBoundSalary;
                        $application->salary_upper_bound = $upperBoundSalary;
                        $application->expected_salary = $expectedSalary;

                        // Calculate additional fields (education_program, matching_percentage, etc.)
                        if($user->education_program_id == $jobDetail->education_program_id) {
                            $education_program = 100;
                        } else {
                            $education_program = 20;
                        }

                        if($user->education_level >= $jobDetail->education_level_id) {
                            $education_level = 100;
                        } else {
                            $difference = abs($user->education_level - $jobDetail->education_level_id);
            
                            if ($difference > 3) {
                                $education_level = 25;
                            } else {
                                $education_level = 50;
                            }
                        }


                        if($expectedSalary <= $jobDetail->salary) {
                            $salary = 100;
                        } else {
                            $difference = abs($expectedSalary - $jobDetail->salary);
                            $percentage = ($difference / $jobDetail->salary)*100;
            
                            if($percentage <= 10) {
                                $salary = 85;
                            } elseif ($percentage <= 20) {
                                $salary = 75;
                            } elseif ($percentage <= 30) {
                                $salary = 50;
                            } elseif ($percentage <= 40) {
                                $salary = 30;
                            } else {
                                $salary = 20;
                            }
                        }

                        if($user->year_of_experience_in_it_sector >= $jobDetail->work_experience) {
                            $work_experience = 100;
                        } else {
                            $difference = abs($user->year_of_experience_in_it_sector - $jobDetail->work_experience);
            
                            if($difference < 1) {
                                $work_experience = 100;
                            } elseif ($difference >= 1 && $difference <= 3) {
                                $work_experience = 85;
                            } elseif ($difference > 3 && $difference <= 5) {
                                $work_experience = 70;
                            } elseif ($difference > 5 && $difference <= 8) {
                                $work_experience = 50;
                            } else {
                                $work_experience = 30;
                            }
                        }
            
                        $matching_percentage = ($education_program + $education_level + $salary + $work_experience) / 4;
            
                        $application->matching_percentage = $matching_percentage;
                        // Save the job application
                        $application->save();
                        // Send Email
                        $to = $user->email;
                        $subject = 'Welcome to InsightAccess';
                        $message = 'This is the onboard email';
                        $mailableClass = 'SendCandidateEmail';
                        $data = [
                            'email' => $row['email_address_personal'] ?? '',
                            'password' => $randomPassword ?? '',
                            'name' => $user->name ?? '',
                            'job_title' => 'Job',
                            'company_name' => auth()->user()->name ?? ''
                        ];

                HelperFunctions::sendEmail($to, $subject, $message, $mailableClass, $data);

                DB::commit();
            } catch (\Exception $e) {
                \Log::error($e);
                DB::rollBack();
                continue; // Skip rows with errors
            }
        }
    }
}
