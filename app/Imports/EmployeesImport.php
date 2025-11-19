<?php

namespace App\Imports;

use App\Helpers\HelperFunctions;
use App\Models\Department;
use App\Models\DepartmentSection;
use App\Models\Job;
use App\Models\Division;
use App\Models\MasterCity;
use App\Models\MasterCountry;
use App\Models\MasterEducationProgram;
use App\Models\MasterHigherLearningInstitution;
use App\Models\MasterProvince;
use App\Models\Position;
use App\Models\Section;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class EmployeesImport implements ToCollection, WithHeadingRow
{
    protected $auth;

    public function __construct($auth)
    {
        $this->auth = $auth;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

          

            $dept = null;
            $sector_id = null;
            $job_id = null;
            $city_id = null;
            $province_id = null;
            $employment_status = null;

            // Validate required fields
            $validator = Validator::make($row->toArray(), [
                'full_name' => 'required|string',
                'email_address_official' => 'required|email|unique:users,email',
                'job_titles' => 'required|string',
                'department' => 'required|string',
                'companydivision' => 'required|string',
            ]);
            


            if ($validator->fails()) {
                Log::info('Validation failed for row.', [
                    'row_data' => $row->toArray(),
                    'errors' => $validator->errors()->toArray(),
                ]);
                continue;
            }

            if (!empty($row['division'])) {
                $division = Division::firstOrCreate(
                    ['head_of_division' => $row['division']],
                    ['company_id' => auth()->user()->id]
                );
                // $user->division_id = $division->id;
            
                if (!empty($row['department'])) {
                    $department = Department::firstOrCreate(
                        [
                            'head_of_department' => $row['department'],
                            'division_id' => $division->id,
                        ],
                        [
                            'name' => $row['department'],
                            'status' => 1,
                        ]
                    );
                    $dept = $department->id;
            
                    if (!empty($row['job_titles'])) {
                        $position = Job::where('title', $row['job_titles'])->first();
                        if ($position) {
                            $job_id = $position->id;
                            $sector_id = $position->department_id;
                        }
                    }
                }
            } elseif (!empty($row['department'])) {
                $department = Department::firstOrCreate(
                    ['head_of_department' => $row['department']],
                    [
                        'name' => $row['department'],
                        'status' => 1,
                    ]
                );
                $dept = $department->id;
            
                if (!empty($row['job_titles'])) {
                    $position = Job::where('title', $row['job_titles'])->first();
                    if ($position) {
                        $job_id = $position->id;
                        $sector_id = $position->department_id;
                    }
                }
            }
            

  // Handle City and Province
            if (!empty($row['city'])) {
                $city = MasterCity::where('name', $row['city'] . '%')->first();
                if (!$city) {
                    $city = MasterCity::create(['name' => $row['city']]);
                }
                $city_id = $city->id;

                if (!empty($row['province'])) {
                    $province = MasterProvince::where('name', 'like', '%' . $row['province'] . '%')->first();
                    if (!$province) {
                        $province = MasterProvince::create(['name' => $row['province']]);
                    }
                    $province_id = $province->id;
                }
            }

            // Handle Nationality
            $nationality_id = null;
            if (!empty($row['nationality'])) {
                $national = MasterCountry::where('name', $row['nationality'])->first();
                if (!$national) {
                    // $national = MasterCountry::where('name', 'philippines')->first();
                    $national = MasterCountry::create(['name' => $row['nationality']]);

                }
                $nationality_id = $national->id ?? null;
            }

            if (!empty($row['employment_status'])) {
                $status = strtolower(trim($row['employment_status']));

                if ($status == 'full-time') {
                    $employment_status = 1;
                } elseif ($status == 'part-time') {
                    $employment_status = 2;
                } elseif ($status == 'probationary') {
                    $employment_status = 3;
                } elseif ($status == 'contractual') {
                    $employment_status = 4;
                } else {
                    // Optional: Log unknown status
                    Log::warning('Unknown employment status: ' . $row['employment_status']);
                    $employment_status = null; // or default value
                }
            }


            $fullName = trim($row['full_name']);
            $first_name = null;
            $middle_name = null;
            $last_name = null;

            $nameParts = preg_split('/\s+/', $fullName);

            if (count($nameParts) === 1) {
                $first_name = $nameParts[0];
            } elseif (count($nameParts) === 2) {
                $first_name = $nameParts[0];
                $last_name = $nameParts[1];
            } elseif (count($nameParts) >= 3) {
                $first_name = $nameParts[0];
                $last_name = array_pop($nameParts);
                $middle_name = implode(' ', array_slice($nameParts, 1));
            }




            DB::beginTransaction();
          

            try {
                $randomPassword = Str::random(12);
                $hashedPassword = Hash::make($randomPassword);

                 // Convert Excel date numbers to Carbon dates
                // $dob = isset($row['date_of_birth']) ? Carbon::createFromTimestamp(($row['date_of_birth'] - 25569) * 86400)->format('Y-m-d') : null;
                $dob = isset($row['date_of_birth']) ? Carbon::createFromTimestamp(($row['date_of_birth'] - 25569) * 86400) : null;
                $date_of_hire = isset($row['hire_date']) ? Carbon::createFromTimestamp(($row['hire_date'] - 25569) * 86400)->format('Y-m-d') : null;

                $age = $dob ? $dob->age : ''; 

                // Convert gender
                $gender = 2;
                if ($row['gender'] == 'Male') {
                    $gender = 0;
                }else if ($row['gender'] == 'Female') {
                    $gender = 1;
                }else{
                    $gender = 2;
                }

                $employment_status = null;

                if ($row['gender'] == 'Male') {
                    $gender = 0;
                }else if ($row['gender'] == 'Female') {
                    $gender = 1;
                }else{
                    $gender = 2;
                }

                // if ($row['dob']) {
                //     $unixDate = ($row['dob'] - 25569) * 86400;
                //     $dob = Carbon::createFromTimestamp($unixDate)->format('Y-m-d');
                // }


                // if ($row['date_of_hire']) {
                //     $unixDate = ($row['date_of_hire'] - 25569) * 86400;
                //     $date_of_hire = Carbon::createFromTimestamp($unixDate)->format('Y-m-d');
                // }


                // Create user
                $user = User::create([
                    'name' => $row['full_name'],
                    'first_name' => $first_name,
                    'middle_name' => $middle_name,
                    'last_name' => $last_name,
                    'dob' => $dob ?? '',
                    'role_name' => 'employee',
                    'role_id' => 1,
                    'gender' => $gender,
                    'nationality' => $row['nationality'] ?? '',
                    // 'address' => $row['address'] ?? '',
                    // 'home_address' => $row['address'] ?? '',
                    // 'barangay' => $row['barangaysubdivision'] ?? '',
                    'country_id' => $nationality_id,
                    'city_id' => $city_id,
                    'province_id' => $province_id,
                    'age' => $age ?? '',
                    'email' => $row['email_address_official'] ?? '',
                    'department_id' => $dept,
                    // 'tin_number' => $row['tax_identification_number_tin'] ?? '',
                    // 'sss_number' => $row['social_security_system_sss_number'] ?? '',
                    // 'hdmf_number' => $row['pag_ibg_fund_hdmf_number'] ?? '',
                    // 'phil_number' => $row['philhealth_member'] ?? '',
                    'password' => $hashedPassword,
                    'company_id' => $this->auth->id,
                    'position_id' => $job_id,
                    'sector_id' => $sector_id,
                    // 'postal_code'=> $row['postal_code'],
                    'job_title' => $row['job_titles'],
                    'date_of_hire' => $date_of_hire,
                    // 'graduate_year' => $row['year_graduated'] ?? '',
                    // 'is_pm_cm'=>1,
                ]);

                // if ($row['city']) {
                //     $city = MasterCity::where('name','like','%'.$row['city'].'%')->first();
                //     if ($city) {
                //         $user->city_id = $city->id;
                //     }else{
                //         $city = MasterCity::create(['name'=>$row['city']]);
                //         $user->city_id = $city->id;
                //      }

                //     $province_id = MasterProvince::where('name','like','%'.$row['province'].'%')->first();
                //     if ($province_id) {
                //         $user->province_id = $province_id->id;
                //     }else{
                //        $provience = MasterProvince::create(['name'=>$row['province']]);
                //        $user->province_id = $provience->id;
                //     }
                // }


                // if (isset($row['section']) && $row['section']) {
                //     $section =  DepartmentSection::where('name',$row['section'])->first();
                //     if ($section) {
                //         $user->section_id = $section->id;
                //     }else{
                //         $section = DepartmentSection::create(['name'=>$row['section'],'department_id'=>$dept]);
                //         $user->section_id = $section->id;
                //      }
                // }


                // if ($row['nationality']) {
                //     $nationality =  MasterCountry::where('name',$row['nationality'])->first();
                //     if ($nationality) {
                //         $user->national_id = $nationality->id;
                //     }else{
                //         $nationality = MasterCountry::where('name','philippines')->first();
                //         $user->national_id = $nationality->id;
                //      }
                // }


                // if ($row['employment_status']) {
                //     if ($row['employment_status'] == 'Regular') {
                //         $user->employment_status = 1;
                //     }
                // }

                // if ($row['highest_education']) {
                //     $user->education_level = 3;
                // }

                // if ($row['name_of_school_university']) {
                //     $institute = MasterHigherLearningInstitution::where('name','like','%'.$row['name_of_school_university'].'%')->first();
                //     if (!$institute) {
                //       $institute=MasterHigherLearningInstitution::create(['name'=>$row['name_of_school_university']]);
                //     }
                //     $user->higher_learning_institution = $institute->id;
                // }

                // if ($row['course_program']) {
                //     $program = MasterEducationProgram::where('name','like','%'.$row['course_program'].'%')->first();
                //     if (!$program) {
                //         $program = MasterEducationProgram::create(['name'=>$row['course_program']]);
                //     }
                //     $user->education_program_id = $program->id;
                // }

                // $user->save();
    
                
                // Send Email
                $to = $user->email;
                $templateType = 'send_employees_email'; 
                $data = [
                    'Employee Email' => $row['email_address_official'] ?? '',
                    'Employee Password' => $randomPassword ?? '',
                    // 'Employee First Name' => $row['first_name'] ?? '',
                    'Employee Full Name' => $row['full_name'] ?? '',
                    'Employee First Name' => $first_name ?? '',
                    'Employee Middle Name' => $middle_name ?? '',
                    'Employee Last Name' => $last_name ?? '',
                    'job_title' => 'Job',
                    'company_name' => auth()->user()->name ?? ''
                ];

                HelperFunctions::sendEmail($to, $templateType, $data);

                DB::commit();
            } catch (\Exception $e) {
                \Log::error($e);
                DB::rollBack();
                continue; // Skip rows with errors
            }
        }
    }
}
