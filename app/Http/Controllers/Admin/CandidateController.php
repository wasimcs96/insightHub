<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\QuizDomainValueAnswer;
use App\Models\SavedEmployee;
use App\Models\Department;

use App\Exports\EmployeeExport;
use App\Exports\EmployeeAssessmentExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\MasterOpportunitiesForGrowth;
use App\Helpers\AssessmentHelper;
use App\Jobs\ImportCandidate;
use App\Models\DepartmentSection;
use App\Models\Job;
use App\Models\PersonalityTypeDescriptor;
use App\Models\Position;
use App\Models\Role;
use App\Models\SectionUnit;
use App\Models\Sector;
use App\Models\UserEmployment;
use Str;
use Illuminate\Support\Facades\Hash;
use App\Helpers\HelperFunctions;
use App\Models\MasterTechnicalQuestion;
use App\Models\MasterBarangay;
use App\Models\MasterCity;
use App\Models\MasterState;
use App\Models\Setting;
use App\Models\UserResult;
use App\Models\JobOpeningApplication;
use App\Models\JobOpening;
use App\Models\ActivityLog;
use App\Helpers\MainHelper;
use App\Helpers\NewAssessmentHelper;
use Carbon\Carbon;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CandidateController extends Controller
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
  


    public function index(Request $request)
    {
        
       
        
        // $departments = User::where('company_id', auth()->user()->id)->where('role_name', 'department')->get();
        $user = auth()->user();
        $departments = Department::where('company_id', auth()->user()->id)->get();
        $averagePercentage = User::where('company_id', auth()->user()->id)->where('role_id',8)->where('is_personality_motivation_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_cognitive_ability_completed', '=', 1)->avg('gp_percentage');
        
        if ($request->export == 1) { 
            
            $query = User::query();
            $query = $query->where('company_id', auth()->user()->id)->where('role_id', 8);
            
            if ($request->filled('age')) {
                $ageRange = explode('_', $request->input('age'));
                if (count($ageRange) == 2) {
                    $query->whereBetween('age', $ageRange);
                }
            }
            if ($request->filled('email')) {
                
                $query->where('email', 'LIKE', '%' . $request->input('email') . '%');
            }

            if ($request->filled('gender')) {
                $query->where('gender', $request->input('gender'));
            }

            if ($request->filled('is_assessment') &&  $request->input('is_assessment') == 1) {
                $query->where('is_personality_motivation_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_cognitive_ability_completed', '=', 1);
            }

            if ($request->filled('is_assessment') &&  $request->input('is_assessment') == 2) {
                $query->where(function ($query) {
                    $query->where('is_personality_motivation_completed', '=', 0)
                          ->orWhere('is_work_interest_completed', '=', 0)
                          ->orWhere('is_cognitive_ability_completed', '=', 0);
                });
            }

            if ($request->filled('city')) {
                $query->where('city', $request->input('city'));
            }

            if ($request->filled('education_level')) {
                $query->where('education_level', $request->input('education_level'));
            }

            if ($request->filled('work_experience')) {
                $workExperienceRange = explode('_', $request->input('work_experience'));
                if (count($workExperienceRange) == 2) {
                    $query->whereBetween('year_of_experience_in_it_sector', $workExperienceRange);
                }
            }

            if ($request->filled('potential')) {
                if ($request->potential == 1) {
                    $query->where('gp_percentage', '>', $averagePercentage);
                } else {
                    $query->where('gp_percentage', '<', $averagePercentage);
                }
            }

            if ($request->filled('level')) {
                $positions = Job::where('level', $request->level)->pluck('id')->toArray();
                $query->whereIn('position_id', $positions);
            }

            

            if ($request->filled('department') || $request->filled('department_name')) {
                if ($request->filled('department_name')) {
                    $dept = Department::where('head_of_department', $request->department_name)->first();
                    if ($dept) {
                        $query->where('department_id', $dept->id);
                    }
                } else {
                    if ($request->filled('department')) {
                        $query->where('department_id', $request->department);
                    }
                }
            }

            if ($request->filled('assessment_completion')) {
                
                if($request->assessment_completion == 1) {
                    $query->where('is_personality_motivation_completed', 1)->where('is_work_interest_completed', 1)->where('is_cognitive_ability_completed', 1);
                } else {
                    $query->where(function ($query) {
                        $query->where('is_personality_motivation_completed', '=', 0)
                              ->orWhere('is_work_interest_completed', '=', 0)
                              ->orWhere('is_cognitive_ability_completed', '=', 0);
                    });
                }
                
            }

            if ($request->filled('name')) {               
                $query->where('first_name', 'like', '%' . $request->name . '%')->orWhere('middle_name', 'like', '%' . $request->name . '%')->orWhere('last_name', 'like', '%' . $request->name . '%');
          
             }
            // Apply the duration filter
            $subquery = $query->yearsSinceCreation();

            if ($request->filled('duration')) {
                $duration = $request->input('duration');
                $subquery = $subquery->where(function ($query) use ($duration) {
                    switch ($duration) {
                        case '1_g':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) < 1');
                            break;
                        case '1_2':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 1 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 2');
                            break;
                        case '2_3':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 2 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) <= 3');
                            break;
                        case '3_4':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 3 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 4');
                            break;
                        case '4_5':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 4 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) <= 5');
                            break;
                        case '5_6':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 5 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 6');
                            break;
                        case '6_8':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 6 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 8');
                            break;
                        case '8_g':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 8');
                            break;
                    }
                });
            }

            $query = $query->select(
                'first_name',
                'middle_name',
                'last_name',
                'email',
                DB::raw("CASE WHEN is_personality_motivation_completed = '1' THEN 'Completed' ELSE 'Not completed' END AS is_personality_motivation_completed"),
                DB::raw("CASE WHEN is_work_interest_completed = '1' THEN 'Completed' ELSE 'Not completed' END AS is_work_interest_completed"),
                DB::raw("CASE WHEN is_cognitive_ability_completed = '1' THEN 'Completed' ELSE 'Not completed' END AS is_cognitive_ability_completed")
            )
            ->where('company_id', auth()->user()->id);
            $headings = [
                'First Name',
                'Middle Name',
                'Last Name',
                'Email',
                'Personality Motivation Completion Status',
                'Work Interest Completion Status',
                'Cognitive Ability Completion Status'
            ];
            $columns = ['first_name','middle_name', 'last_name', 'email', 'is_personality_motivation_completed', 'is_work_interest_completed', 'is_cognitive_ability_completed'];
    
            return Excel::download(new EmployeeAssessmentExport($query, $headings, $columns), 'Exported Users Data.xlsx');
        }
        if ($user->isCompany()) {
            $query = User::query();
            $query = $query->where('company_id', auth()->user()->id)->where('role_id', 8);
           
            if ($request->filled('gender')) {
                $query->where('gender', $request->input('gender'));
            }

            if ($request->filled('email')) {
                
                $query->where('email', 'LIKE', '%' . $request->input('email') . '%');
            }

            if ($request->filled('age')) {
                $ageRange = explode('_', $request->input('age'));
                if (count($ageRange) == 2) {
                    $query->whereBetween('age', $ageRange);
                }
            }

            if ($request->filled('gender')) {
                $query->where('gender', $request->input('gender'));
            }

            if ($request->filled('is_assessment') &&  $request->input('is_assessment') == 1) {
                $query->where('is_personality_motivation_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_cognitive_ability_completed', '=', 1);
            }

            if ($request->filled('education_level')) {
                $query->where('education_level', $request->input('education_level'));
            }

            if ($request->filled('work_experience')) {
                $workExperienceRange = explode('_', $request->input('work_experience'));
                if (count($workExperienceRange) == 2) {
                    $query->whereBetween('year_of_experience_in_it_sector', $workExperienceRange);
                }
            }

            if ($request->filled('potential')) {
                if ($request->potential == 1) {
                    $query->where('gp_percentage', '>', $averagePercentage);
                } else {
                    $query->where('gp_percentage', '<', $averagePercentage);
                }
            }

            if ($request->filled('level')) {
                $positions = Position::where('level', $request->level)->pluck('id')->toArray();
                $query->whereIn('position_id', $positions);
            }

            

            if ($request->filled('department') || $request->filled('department_name')) {
                if ($request->filled('department_name')) {
                    $dept = Department::where('head_of_department', $request->department_name)->first()->id;
                    $query->where('department_id', $dept);
                } else {
                    if ($request->filled('department')) {
                        $query->where('department_id', $request->department);
                    }
                }
            }

            if ($request->filled('assessment_completion')) {
                
                if($request->assessment_completion == 1) {
                    $query->where('is_personality_motivation_completed', 1)->where('is_work_interest_completed', 1)->where('is_cognitive_ability_completed', 1);
                } else {
                    $query->where(function ($query) {
                        $query->where('is_personality_motivation_completed', '=', 0)
                              ->orWhere('is_work_interest_completed', '=', 0)
                              ->orWhere('is_cognitive_ability_completed', '=', 0);
                    });
                }
                
            }

            if ($request->filled('name')) {               
                    $query->where('first_name', 'like', '%' . $request->name . '%')->orWhere('middle_name', 'like', '%' . $request->name . '%')->orWhere('last_name', 'like', '%' . $request->name . '%');
              
            }

            $users = $query->orderBy('created_at', 'DESC')->paginate(20);
        } elseif ($user->isAdmin()) {
            
            $query = User::query();
            $query = $query->where('company_id', auth()->user()->id)->where('role_id',8);
          
            if ($request->filled('age')) {
                $ageRange = explode('_', $request->input('age'));
                if (count($ageRange) == 2) {
                    $query->whereBetween('age', $ageRange);
                    
                }
            }

            if ($request->filled('email')) {
                
                $query->where('email', 'LIKE', '%' . $request->input('email') . '%');
            }
            if ($request->filled('gender')) {
                $query->where('gender', $request->input('gender'));
            }

            if ($request->filled('is_assessment') &&  $request->input('is_assessment') == 1) {
                $query->where('is_personality_motivation_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_cognitive_ability_completed', '=', 1);
            }

            if ($request->filled('is_assessment') &&  $request->input('is_assessment') == 2) {
                $query->where(function ($query) {
                    $query->where('is_personality_motivation_completed', '=', 0)
                          ->orWhere('is_work_interest_completed', '=', 0)
                          ->orWhere('is_cognitive_ability_completed', '=', 0);
                });
            }

            if ($request->filled('city')) {
                $query->where('city', $request->input('city'));
            }

            if ($request->filled('education_level')) {
                $query->where('education_level', $request->input('education_level'));
            }

            if ($request->filled('work_experience')) {
                $workExperienceRange = explode('_', $request->input('work_experience'));
                if (count($workExperienceRange) == 2) {
                    $query->whereBetween('year_of_experience_in_it_sector', $workExperienceRange);
                }
            }

            if ($request->filled('potential')) {
                if ($request->potential == 1) {
                    $query->where('gp_percentage', '>', $averagePercentage);
                } else {
                    $query->where('gp_percentage', '<', $averagePercentage);
                }
            }

           
            
            if ($request->filled('level')) {
                $positions = Job::where('level', $request->level)->pluck('id')->toArray();
                $query->whereIn('position_id', $positions);
               

            }

            

            if ($request->filled('department') || $request->filled('department_name')) {
                if ($request->filled('department_name')) {
                    $dept = Department::where('head_of_department','like',"%$request->department_name%")->first();
                   
                    if ($dept) {
                        $query->where('department_id', $dept->id);
                    }
                } else {
                    if ($request->filled('department')) {
                        $query->where('department_id', $request->department);
                    }
                }
            }

         

            if ($request->filled('assessment_completion')) {
                
                if($request->assessment_completion == 1) {
                    $query->where('is_personality_motivation_completed', 1)->where('is_work_interest_completed', 1)->where('is_cognitive_ability_completed', 1);
                } else {
                    $query->where(function ($query) {
                        $query->where('is_personality_motivation_completed', '=', 0)
                              ->orWhere('is_work_interest_completed', '=', 0)
                              ->orWhere('is_cognitive_ability_completed', '=', 0);
                    });
                }
                
            }
           

            if ($request->filled('name')) {
                $query->where(function ($subQuery) use ($request) {
                    $subQuery->where('first_name', 'like', '%' . $request->name . '%')
                             ->orWhere('middle_name', 'like', '%' . $request->name . '%')
                             ->orWhere('last_name', 'like', '%' . $request->name . '%');
                });
            }
            // Apply the duration filter
            $subquery = $query->yearsSinceCreation();

            if ($request->filled('duration')) {
                $duration = $request->input('duration');
                $subquery = $subquery->where(function ($query) use ($duration) {
                    switch ($duration) {
                        case '1_g':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) < 1');
                            break;
                        case '1_2':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 1 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 2');
                            break;
                        case '2_3':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 2 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) <= 3');
                            break;
                        case '3_4':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 3 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 4');
                            break;
                        case '4_5':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 4 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) <= 5');
                            break;
                        case '5_6':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 5 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 6');
                            break;
                        case '6_8':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 6 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 8');
                            break;
                        case '8_g':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 8');
                            break;
                    }
                });
            }
          
            $users = $query->orderBy('created_at', 'DESC')->paginate(20);
        } elseif($user->role_id == 4) {
            $query = User::query();

            $query = $query->where('department_id', auth()->user()->department_id)->where('role_id', 8);

            if ($request->filled('age')) {
                $ageRange = explode('_', $request->input('age'));
                if (count($ageRange) == 2) {
                    $query->whereBetween('age', $ageRange);
                }
            }

            if ($request->filled('gender')) {
                $query->where('gender', $request->input('gender'));
            }

            if ($request->filled('education_level')) {
                $query->where('education_level', $request->input('education_level'));
            }

            if ($request->filled('work_experience')) {
                $workExperienceRange = explode('_', $request->input('work_experience'));
                if (count($workExperienceRange) == 2) {
                    $query->whereBetween('year_of_experience_in_it_sector', $workExperienceRange);
                }
            }

            if ($request->filled('potential')) {
                if ($request->potential == 1) {
                    $query->where('gp_percentage', '>', $averagePercentage);
                } else {
                    $query->where('gp_percentage', '<', $averagePercentage);
                }
            }

            if ($request->filled('level')) {
                $positions = Position::where('level', $request->level)->pluck('id')->toArray();
                $query->whereIn('position_id', $positions);
            }

            if ($request->filled('department')) {
                $query->where('department_id', $request->department);
            }
            
            if ($request->filled('assessment_completion')) {
                
                if($request->assessment_completion == 1) {
                    $query->where('is_personality_motivation_completed', 1)->where('is_work_interest_completed', 1)->where('is_cognitive_ability_completed', 1);
                } else {
                    $query->where(function ($query) {
                        $query->where('is_personality_motivation_completed', '=', 0)
                              ->orWhere('is_work_interest_completed', '=', 0)
                              ->orWhere('is_cognitive_ability_completed', '=', 0);
                    });
                }
                
            }

            if ($request->filled('name')) {               
                $query->where('first_name', 'like', '%' . $request->name . '%')->orWhere('middle_name', 'like', '%' . $request->name . '%')->orWhere('last_name', 'like', '%' . $request->name . '%');
          
            }


            $users = $query->orderBy('created_at', 'DESC')->paginate(20);
        }else{
            
            $query = User::query();
            $query = $query->where('company_id', auth()->user()->company_id)->where('role_id',8);
          
            if ($request->filled('age')) {
                $ageRange = explode('_', $request->input('age'));
                if (count($ageRange) == 2) {
                    $query->whereBetween('age', $ageRange);
                    
                }
            }

            if ($request->filled('email')) {
                
                $query->where('email', 'LIKE', '%' . $request->input('email') . '%');
            }
            if ($request->filled('gender')) {
                $query->where('gender', $request->input('gender'));
            }

            if ($request->filled('is_assessment') &&  $request->input('is_assessment') == 1) {
                $query->where('is_personality_motivation_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_cognitive_ability_completed', '=', 1);
            }

            if ($request->filled('is_assessment') &&  $request->input('is_assessment') == 2) {
                $query->where(function ($query) {
                    $query->where('is_personality_motivation_completed', '=', 0)
                          ->orWhere('is_work_interest_completed', '=', 0)
                          ->orWhere('is_cognitive_ability_completed', '=', 0);
                });
            }

            if ($request->filled('city')) {
                $query->where('city', $request->input('city'));
            }

            if ($request->filled('education_level')) {
                $query->where('education_level', $request->input('education_level'));
            }

            if ($request->filled('work_experience')) {
                $workExperienceRange = explode('_', $request->input('work_experience'));
                if (count($workExperienceRange) == 2) {
                    $query->whereBetween('year_of_experience_in_it_sector', $workExperienceRange);
                }
            }

            if ($request->filled('potential')) {
                if ($request->potential == 1) {
                    $query->where('gp_percentage', '>', $averagePercentage);
                } else {
                    $query->where('gp_percentage', '<', $averagePercentage);
                }
            }

           
            
            if ($request->filled('level')) {
                $positions = Job::where('level', $request->level)->pluck('id')->toArray();
                $query->whereIn('position_id', $positions);
               

            }

            

            if ($request->filled('department') || $request->filled('department_name')) {
                if ($request->filled('department_name')) {
                    $dept = Department::where('head_of_department','like',"%$request->department_name%")->first();
                   
                    if ($dept) {
                        $query->where('department_id', $dept->id);
                    }
                } else {
                    if ($request->filled('department')) {
                        $query->where('department_id', $request->department);
                    }
                }
            }

         

            if ($request->filled('assessment_completion')) {
                
                if($request->assessment_completion == 1) {
                    $query->where('is_personality_motivation_completed', 1)->where('is_work_interest_completed', 1)->where('is_cognitive_ability_completed', 1);
                } else {
                    $query->where(function ($query) {
                        $query->where('is_personality_motivation_completed', '=', 0)
                              ->orWhere('is_work_interest_completed', '=', 0)
                              ->orWhere('is_cognitive_ability_completed', '=', 0);
                    });
                }
                
            }
           

            if ($request->filled('name')) {
                $query->where(function ($subQuery) use ($request) {
                    $subQuery->where('first_name', 'like', '%' . $request->name . '%')
                             ->orWhere('middle_name', 'like', '%' . $request->name . '%')
                             ->orWhere('last_name', 'like', '%' . $request->name . '%');
                });
            }
            // Apply the duration filter
            $subquery = $query->yearsSinceCreation();

            if ($request->filled('duration')) {
                $duration = $request->input('duration');
                $subquery = $subquery->where(function ($query) use ($duration) {
                    switch ($duration) {
                        case '1_g':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) < 1');
                            break;
                        case '1_2':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 1 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 2');
                            break;
                        case '2_3':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 2 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) <= 3');
                            break;
                        case '3_4':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 3 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 4');
                            break;
                        case '4_5':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 4 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) <= 5');
                            break;
                        case '5_6':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 5 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 6');
                            break;
                        case '6_8':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 6 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 8');
                            break;
                        case '8_g':
                            $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 8');
                            break;
                    }
                });
            }
          
            $users = $query->orderBy('created_at', 'DESC')->paginate(20);
        }

       
        $data = [
            'users' => $users,
            'departments' => $departments
            // 'type'=>$type
        ];
        return view('admin.candidate.index', $data);
    }

    public function create()
    {
        $sectors = Sector::all();

        $departments = Department::where('company_id', auth()->user()->id)->select('head_of_department', 'id')
            ->orderBy('created_at', 'DESC')
            ->get();

        $sections = []; // Initialize sections as an empty array
        $units = []; // Initialize units as an empty array
        $positions = [];

        // $barangays = \App\Models\MasterBarangay::select('id','name')->get();
        $education_levels = \App\Models\MasterEducationLevel::all();
        // $higher_learning_institutions = \App\Models\MasterHigherLearningInstitution::all();
        $scope_of_studies = \App\Models\MasterScopeOfStudy::all();
        $itSkills = \App\Models\MasterItSkill::all();
        // $cities = \App\Models\MasterCity::all();
        $provinces = \App\Models\MasterProvince::all();
        $user = null;
        $data = [
            'user'=>$user,
            'departments' => $departments,
            'sectors' => $sectors,
            'sections' => $sections,
            'units' => $units,
            'positions' => $positions,
            // 'barangays'=>$barangays,
            'education_levels'=>$education_levels,
            // 'higher_learning_institutions'=>$higher_learning_institutions,
            'scope_of_studies'=>$scope_of_studies,
            'itSkills'=>$itSkills,
            // 'cities'=>$cities,
            'provinces'=>$provinces
        ];

        return view('admin.candidate.create', $data);
    }

    public function store(Request $request)
    {
       $validatedData =  $request->validate([
            'first_name' => 'required',
            'middle_name' => 'required',

            'last_name' => 'required',
            'department_id' => 'nullable|exists:departments,id',
            'sector_id' => 'nullable|exists:sectors,id',
            'position_id' => 'nullable|exists:jobs,id',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'section_id' => 'nullable|exists:department_sections,id',
            'unit_id' => 'nullable|exists:section_units,id',
            'team_id' => 'nullable|exists:teams,id',
        ]);

        $auth = auth()->user();
        $req_data = array_merge($request->all(), $validatedData);
        if ($request->filled('section_id')) {
            // Check if the section belongs to the department
            $section = DepartmentSection::where('id', $request->section_id)
                ->where('department_id', $request->department_id)
                ->first();

            if (!$section) {
                return redirect()->back()->withErrors(['section_id' => 'The selected section does not belong to the specified department.'])->withInput();
            }
        }

        if ($request->filled('unit_id')) {
            // Check if the unit belongs to the section
            $unit = SectionUnit::where('id', $request->unit_id)
                ->where('department_section_id', $request->section_id)
                ->first();

            if (!$unit) {
                return redirect()->back()->withErrors(['unit_id' => 'The selected unit does not belong to the specified section.'])->withInput();
            }
        }

        DB::beginTransaction();
        // try {
            if($request->has('avatar')){
                $avatarName = '/media/users/avatars/' . time() . '.' . $request->avatar->extension(); // Generate unique avatar name
                $request->avatar->move(public_path('media/users/avatars'), $avatarName); // Move avatar to public/avatars directory
    
            }
        
            // Hash the password
            $hashedPassword = Hash::make($request->password);

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'role_name' => 'employee',
                'role_id' => 1,
                'name' => $request->first_name . ' ' . $request->last_name,
                'company_id' => $auth->id,
                'department_id' => $request->department_id,
                'section_id' => $request->section_id,
                'unit_id' => $request->unit_id,
                'sector_id' => $request->sector_id,
                'team_id' => $request->team_id,
                'position_id' => $request->position_id,
                'employment_status' => $request->emp_status,
                'date_of_hire' => $request->date_of_hire,
                'profile_picture' => $avatarName ?? NULL, // Save the avatar name in the database
                'email' => $request->email,
                'password' => $hashedPassword,
            ]);

            $user->update($req_data);
            
            if (isset($request->employments)){

                UserEmployment::where('user_id',$user->id)->delete();
                foreach($request->employments as $employment){
    
                   $emp =  UserEmployment::create([
                        'user_id' => $user->id,
                        'job_title' => $employment['job_title'],
                        'company_name' => $employment['company_name'],
                        'start_date' => $employment['start_date'],
                        'end_date' => $employment['end_date'] ?? '',
                        'year_of_work' => $employment['year_of_work'],
                        'key_responsiblity'=>$employment['key_responsiblity']
                    ]);
    
                }
            } else {
                UserEmployment::where('user_id',$user->id)->delete();
            }
    

            DB::commit();

            try {
                MainHelper::jobTriggerByTypeOnPositionChange($user->id,$user->position_id,config('helpers.panel_names')[env('DB_DATABASE')]);
            } catch (\Throwable $th) {
                \Log::error($th);
            }
            
            return redirect('/admin/myemployee/')->with('success', 'Employee created successfully.');
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     return redirect()->back()->with('error', 'An error occurred while creating the employee.')->withInput();
        // }
    }



    public function edit($id)
    {
        $user = User::find($id);

        $departments = Department::where('company_id', auth()->user()->id)->select('head_of_department', 'id')
            ->orderBy('created_at', 'DESC')
            ->get();

        $sectors = Sector::select('name', 'id')->orderBy('created_at', 'DESC')->get();

        $sections = DepartmentSection::where('department_id', $user->department_id)
            ->select('name', 'id')
            ->orderBy('created_at', 'DESC')
            ->get();

        $units = SectionUnit::where('department_section_id', $user->section_id)
            ->select('name', 'id')
            ->orderBy('created_at', 'DESC')
            ->get();

        $positions = Job::where('department_id', $user->sector_id)->get(); // Fetch positions based on sector_id

        // $barangays = \App\Models\MasterBarangay::select('id','name')->get();
        // dd($barangays);
        $education_levels = \App\Models\MasterEducationLevel::all();
        // $higher_learning_institutions = \App\Models\MasterHigherLearningInstitution::all();
        $scope_of_studies = \App\Models\MasterScopeOfStudy::all();
        $itSkills = \App\Models\MasterItSkill::all();
        // $cities = \App\Models\MasterCity::all();
        $provinces = \App\Models\MasterProvince::all();


        $data = [
            'user' => $user,
            'departments' => $departments,
            'sections' => $sections,
            'units' => $units,
            'sectors' => $sectors,
            'positions' => $positions,
            // 'barangays'=>$barangays,
            'education_levels'=>$education_levels,
            // 'higher_learning_institutions'=>$higher_learning_institutions,
            'scope_of_studies'=>$scope_of_studies,
            'itSkills'=>$itSkills,
            // 'cities'=>$cities,
            'provinces'=>$provinces
        ];
        return view('admin.candidate.create', $data);
    }


    public function update(Request $request, $id)
    {
      
        $user = User::where('id', $id)->first();
        $auth = auth()->user();

        $validatedData = $request->validate([
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate avatar as an image file
            'password' => 'nullable|confirmed', // Password is optional
            'department_id' => 'nullable|exists:departments,id',
            'section_id' => 'nullable|exists:department_sections,id',
            'unit_id' => 'nullable|exists:section_units,id',
            'team_id' => 'nullable|exists:teams,id',
            'position_id' => 'nullable|exists:jobs,id',
         
        ]);

        $req_data = array_merge($request->all(), $validatedData);

        if ($request->filled('section_id')) {
            // Check if the section belongs to the department
            $section = DepartmentSection::where('id', $request->section_id)
                ->where('department_id', $request->department_id)
                ->first();

            if (!$section) {
                return redirect()->back()->withErrors(['section_id' => 'The selected section does not belong to the specified department.'])->withInput();
            }
        }

        if ($request->filled('unit_id')) {
            // Check if the unit belongs to the section
            $unit = SectionUnit::where('id', $request->unit_id)
                ->where('department_section_id', $request->section_id)
                ->first();

            if (!$unit) {
                return redirect()->back()->withErrors(['unit_id' => 'The selected unit does not belong to the specified section.'])->withInput();
            }
        }

        DB::beginTransaction();
        try {
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'company_id' => $auth->id,
                // 'department_id' => $request->department_id,
                'section_id' => $request->section_id,
                'unit_id' => $request->unit_id,
                'team_id' => $request->team_id,
                'employment_status' => $request->emp_status,
                'date_of_hire' => $request->date_of_hire,
                // 'position_id' => $request->position_id,
                'sector_id' => $request->sector_id,
                
            ]);

            $user->update($req_data);

            if ($request->hasFile('avatar')) {
                // Store new avatar in the public folder
                $avatarName = '/media/users/avatars/' . time() . '.' . $request->avatar->extension();
                $request->avatar->move(public_path('media/users/avatars'), $avatarName);
                // Delete old avatar if exists
                if ($user->profile_picture && file_exists(public_path($user->profile_picture))) {
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

            if (isset($request->employments)){

                UserEmployment::where('user_id',$user->id)->delete();
                foreach($request->employments as $employment){
 
                   $emp =  UserEmployment::create([
                        'user_id' => $user->id,
                        'job_title' => $employment['job_title'],
                        'company_name' => $employment['company_name'],
                        'start_date' => $employment['start_date'],
                        'end_date' => $employment['end_date'] ?? '',
                        'year_of_work' => $employment['year_of_work'],
                        'key_responsiblity'=>$employment['key_responsiblity']
                    ]);
    
                }
            } else {
                UserEmployment::where('user_id',$user->id)->delete();
            }
    

        

            DB::commit();

            return redirect('/admin/myemployee/')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while updating the employee.')->withInput();
        }
    }


    public function destroy($id)
    {
        $user = User::find($id);
        // dd($id);
        $user->delete();

        return redirect('/admin/myemployee/')->with('success', 'User deleted successfully.');
    }



    public function barangaySearch(Request $request)
    {
        // dd($request->all());
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

    public function CitySearch(Request $request)
    {
       
        // Check if an ID is specified to fetch a specific barangay
        if ($request->has('id')) {
            $barangay = MasterCity::find($request->id);
            return response()->json([
                'id' => $barangay->id,
                'text' => $barangay->name
            ]);
        }
        

        // Handle search functionality
        $query = $request->get('q');
        $barangays = MasterCity::where('name', 'LIKE', "%{$query}%")->paginate(10);
        // dd($barangays);
        return response()->json([
            'results' => $barangays->map(function ($barangay) {
                return ['id' => $barangay->id, 'text' => $barangay->name];
            }),
            'pagination' => [
                'more' => $barangays->currentPage() < $barangays->lastPage()
            ]
        ]);
    }

    public function StateSearch(Request $request)
    {
       
        // Check if an ID is specified to fetch a specific barangay
        if ($request->has('id')) {
            $states = MasterState::find($request->id);
            return response()->json([
                'id' => $states->id,
                'text' => $states->name
            ]);
        }
        

        // Handle search functionality
        $query = $request->get('q');
        $states = MasterState::where('name', 'LIKE', "%{$query}%")->paginate(10);
        // dd($barangays);
        return response()->json([
            'results' => $states->map(function ($states) {
                return ['id' => $states->id, 'text' => $states->name];
            }),
            'pagination' => [
                'more' => $states->currentPage() < $states->lastPage()
            ]
        ]);
    }


    public function sendEmail($id)
    {
        try {
            // Generate random password
            $randomPassword = Str::random(12);
            $hashedPassword = Hash::make($randomPassword);

            // Find the user by ID
            $user = User::where('id', $id)->first();
            $user->password = $hashedPassword;
            $user->save();

            // Prepare email data
            $to = $user->email;
            $templateType = 'send_employees_email';  // Template type based on your database
            $data = [
                'email' => $user->email ?? '',
                'password' => $randomPassword ?? '',
                'Employee Full Name' => $user->name ?? '',
                'Employee First Name' => $user->first_name ?? '',
                'Employee Middle Name' => $user->middle_name ?? '',
                'Employee Last Name' => $user->last_name ?? '',
                'job_title' => $user->position->title ?? '',  // Replace with the actual job title if needed
                'company_name' => auth()->user()->userCompany()->first()->name ?? ''
            ];

            // Send the email using the sendEmail method in HelperFunctions
            HelperFunctions::sendEmail($to, $templateType, $data);

            // Return success response
            return redirect()->back()->with('success', 'Email Sent Successfully');

        } catch (\Exception $e) {
            // Handle error and log it
            \Log::error('Email sending failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Email sending failed.');
        }
    }


    public function manager(Request $request)
    {
       
        // Check if an ID is specified to fetch a specific barangay
        $query = User::query();
        $query = $query->where('company_id', 3)->where('role_name', Role::$employee)->where('is_pm_cm',1);
        // dd($barangays);
        if ($request->filled('email')) {               
            $query->where('email', 'LIKE', '%' . $request->input('email') . '%');
        }

        if ($request->filled('name')) {               
            $query->where('first_name', 'like', '%' . $request->name . '%')->orWhere('middle_name', 'like', '%' . $request->name . '%')->orWhere('last_name', 'like', '%' . $request->name . '%');     
        }

        $users = $query->paginate(10);
        $data = [
            'users' =>$users
        ];
        $setting = Setting::where('user_id', 3)->first();
        $data['setting'] = $setting;
        return view('admin.candidate.manager',$data);

    }

    public function dynamicPercentage(Request $request) {

        if(($request->technical_percentage + $request->soft_skill_percentage) > 100) {
            return redirect()->back()->with('error', 'Technical Percentage and Soft Skill Percentage must sum up to 100%.');
        }

        $setting = Setting::where('user_id', 3)->first();

        $setting->technical_percentage = $request->technical_percentage;
        $setting->soft_skill_percentage = $request->soft_skill_percentage;

        $setting->save();

        // $users = User::where('company_id', auth()->user()->id)->where('role_name', Role::$employee)->where('is_pm_cm',1)->where('is_cognitive_ability_completed', '=', 1)->where('is_work_interest_completed', '=', 1)->where('is_personality_motivation_completed', '=', 1)->get();

        $users = User::where('company_id', auth()->user()->id)->where('role_name', Role::$employee)->where('is_pm_cm', 1)->get();
        
        foreach ($users as $user) {
            $user->match_rate = ($request->technical_percentage)*($user->tech_skill_score) + ($request->soft_skill_percentage)*($user->soft_skill_score);
            $user->save();
        }

        return redirect()->back()->with('success', 'Percentage updated successfully.');
    }

    public function technicalQuestions(Request $request) {
        $technical_questions = MasterTechnicalQuestion::all();

        
        // Check if an ID is specified to fetch a specific barangay
        $query = MasterTechnicalQuestion::query();
        // $query = $query->where('company_id', 3)->where('role_name', Role::$employee)->where('is_pm_cm',1);
        // // dd($barangays);
        // if ($request->filled('email')) {               
        //     $query->where('email', 'LIKE', '%' . $request->input('email') . '%');
        // }

        // if ($request->filled('name')) {               
        //     $query->where('first_name', 'like', '%' . $request->name . '%')->orWhere('middle_name', 'like', '%' . $request->name . '%')->orWhere('last_name', 'like', '%' . $request->name . '%');     
        // }

        $technical_questions = $query->paginate(10);
        $data['technical_questions'] = $technical_questions;

        return view('admin.candidate.technical-questions', $data);
    }

    public function MasterHigherInstitutionSearch(Request $request)
    {
       
        // Check if an ID is specified to fetch a specific barangay
        if ($request->has('id')) {
            // $masterhigherinstitution = MasterCity::find($request->id);
            $higher_learning_institutions = \App\Models\MasterHigherLearningInstitution::find($request->id);
            return response()->json([
                'id' => $higher_learning_institutions->id,
                'text' => $higher_learning_institutions->name
            ]);
        }
        

        // Handle search functionality
        $query = $request->get('q');
        $higher_learning_institutions = \App\Models\MasterHigherLearningInstitution::where('name', 'LIKE', "%{$query}%")->paginate(10);
        // dd($barangays);
        return response()->json([
            'results' => $higher_learning_institutions->map(function ($higher_learning_institution) {
                return ['id' => $higher_learning_institution->id, 'text' => $higher_learning_institution->name];
            }),
            'pagination' => [
                'more' => $higher_learning_institutions->currentPage() < $higher_learning_institutions->lastPage()
            ]
        ]);
    }

    public function departmentWise(Request $request)
    {
        $departmentId = request('department_id', 63);
        $query = User::join('jobs', 'users.position_id', '=', 'jobs.id')
                    ->where('users.company_id', 3)
                    ->where('users.is_personality_motivation_completed', 1)
                    ->where('users.is_work_interest_completed', 1)
                    ->where('users.is_cognitive_ability_completed', 1)
                    ->where('users.department_id', $departmentId)
                    ->where('role_name', Role::$employee)
                    ->whereNotIn('users.email', [
                        'testcxs1@yopmail.com',
                        'dcamador@eei.com.ph',
                        'abancheta@eei.com.ph',
                        'jcprangoluan@eei.com.ph',
                        'rccaburnay@eei.com.ph',
                        'smremonte@eei.com.ph',
                        'mgzantua@eei.com.ph'
                    ])
                    ->select('users.*', 'jobs.title')
                    ->orderBy('soft_skill_score', 'desc');
        // dd($barangays);
        if ($request->filled('email')) {               
            $query->where('email', 'LIKE', '%' . $request->input('email') . '%');
        }

        if ($request->filled('name')) {               
            $query->where('first_name', 'like', '%' . $request->name . '%')->orWhere('middle_name', 'like', '%' . $request->name . '%')->orWhere('last_name', 'like', '%' . $request->name . '%');     
        }

        $users = $query->paginate(40);
        $data = [
            'users' =>$users
        ];
        $setting = Setting::where('user_id', 3)->first();
        $data['setting'] = $setting;

        $data['department'] = Department::find($departmentId);

        $departments = Department::where('company_id', auth()->user()->id)->get();
        $data['departments'] = $departments;

        return view('admin.candidate.department-wise',$data);

    }

    // public function sendEmailsDepartmentWise(Request $request) {
    //     $departmentId = request('department_id', 63);

    //     $application_emails = User::join('jobs', 'users.position_id', '=', 'jobs.id')
    //     ->where('users.company_id', 3)
    //     ->where('users.is_personality_motivation_completed', 1)
    //     ->where('users.is_work_interest_completed', 1)
    //     ->where('users.is_cognitive_ability_completed', 1)
    //     ->where('users.department_id', $departmentId)
    //     ->where('role_name', Role::$employee)->pluck('email')->toArray();
        
    //     // Send Email
    //     $subject = 'Important: Complete Your Technical Assessment by August 16th';
    //     $message = 'Important: Complete Your Technical Assessment by August 16th';
    //     $mailableClass = 'TechnicalAssessmentMail';

    //     $data = [];
        
    //     HelperFunctions::sendEmails($application_emails, $subject, $message, $mailableClass, $data);

    //    return redirect()->back()->with('success', 'Email Will Be Sent Successfully');

    // }
    public function sendEmailsDepartmentWise(Request $request) {
        $departmentId = $request->input('department_id', 63);
    
        // Get the emails of the selected department
        $application_emails = User::join('jobs', 'users.position_id', '=', 'jobs.id')
            ->where('users.company_id', 3)
            ->where('users.is_personality_motivation_completed', 1)
            ->where('users.is_work_interest_completed', 1)
            ->where('users.is_cognitive_ability_completed', 1)
            ->where('users.department_id', $departmentId)
            ->where('role_name', Role::$employee)
            ->pluck('email')
            ->toArray();
            
        if (empty($application_emails)) {
            return redirect()->back()->with('error', 'No emails found for the selected department.');
        }
    
        // Fetch the email template from the database
        $templateType = 'technical_assessment_mail';  // Template type based on your database
        $template = Template::where('type', $templateType)->first();
    
        if (!$template) {
            return redirect()->back()->with('error', 'Email template not found for ' . $templateType);
        }
    
        // Get the subject and message from the template
        $subject = $template->subject;
        $message = $template->description;
    
        // Fetch department details for dynamic data
        $department = Department::find($departmentId);  // Assuming you have a Department model
        $job_opening = JobOpening::where('department_id', $departmentId)->first();  // Assuming you have JobOpening model
    
        // Prepare dynamic data for email template
        $data = [
            'Employee Full Name' => $user->name ?? '',
            'Employee First Name' => $user->first_name ?? '',
            'Employee Middle Name' => $user->middle_name ?? '',
            'Employee Last Name' => $user->last_name ?? '',
            'job_title' => $job_opening->job_title ?? 'No Job Title',
            'company_name' => $job_opening->company->name ?? 'No Company Name',
            'department_name' => $department->name ?? 'No Department Name',
        ];
    
        // Prepare replacements (optional, based on the placeholders in your template)
        $replacements = HelperFunctions::prepareReplacements($data);
    
        // Replace placeholders in subject and message
        foreach ($replacements as $placeholder => $value) {
            $subject = str_replace($placeholder, $value, $subject);
            $message = str_replace($placeholder, $value, $message);
        }
    
        // Send emails to all selected applicants in the department
        // HelperFunctions::sendEmails($application_emails, $subject, $message, $templateType, $data);
           HelperFunctions::sendEmails($application_emails, $templateType, $data);
    
        return redirect()->back()->with('success', 'Emails have been sent successfully.');
    }
    
    
    // In your controller method for handling bulk import
    public function bulkImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx|max:3048', // Allow only .xlsx files up to 2MB
        ]);

        // Retrieve the uploaded file
        $file = $request->file('file');

        try {
            // Import the .xlsx file using Laravel Excel
            $filePath = $request->file('file')->store('temp'); // Store the file temporarily
            $filePath = storage_path('app/' . $filePath); // Get the full path
        
            ImportCandidate::dispatch($filePath, auth()->user());

            // Provide feedback to the user
            return back()->with('success', 'File uploaded and processed successfully.');
        } catch (\exception $th) {
            // Handle any exceptions or errors
            return back()->with('error', 'An error occurred while processing the file.');
        }
    }







    public function candidateDetails($id) 
    {
        
            $user = User::find($id);
            $descriptors = DB::table('master_descriptors')->where('user_type', 'candidate')->get();
            $user_results = [];
            $userResultExistence = UserResult::where('user_id', $user->id)->get();
            $isUserResultExists = 0;

            if (!$userResultExistence->isEmpty()) {
                $isUserResultExists = 1;
            } else {
                $isUserResultExists = 0;
            }
            $responseData = [];
            // dd($user->is_all_assessments_completed);
            if(($user) && ($user->is_all_assessments_completed == 1) && ($isUserResultExists)) {
                $user_id = $user->id;

                // OCEAN Result

                $total_correct = QuizDomainValueAnswer::where('user_id', $user_id)->where('quiz_domain_value_question_id', '>', 376)->where('is_correct', 1)->count();
                $responseData = array_merge($responseData, ['totalCorrectForCognitive' => $total_correct]);
        
                $total_not_attempted = QuizDomainValueAnswer::where('user_id', $user_id)->where('quiz_domain_value_question_id', '>', 376)->where('time_taken', 0)->where('option_selected', 0)->count();
                $responseData = array_merge($responseData, ['totalNonAttemptedForCognitive' => $total_not_attempted]);
                if ($total_correct == 0 && $total_not_attempted == 0) {
                    $total_wrong = 0;
                } else {
                    $total_wrong = 50 - $total_correct - $total_not_attempted;
                }
                $responseData = array_merge($responseData, ['totalWrongForCognitive' => $total_wrong]);
        
                $results = UserResult::where('user_id', $user_id)->get();
        
                $cognitiveOverallResult =  NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'overall', $user->role_name, $descriptors);
                $responseData = array_merge($responseData, ['cognitiveOverallResult' => $cognitiveOverallResult]);
        
                $totalMarksForCognitive = $cognitiveOverallResult['cognitive']['score'] ?? 0;
                $responseData = array_merge($responseData, ['totalMarksForCognitive' => $totalMarksForCognitive]);
        
                $cognitiveDomainResult =  NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'domains', $user->role_name, $descriptors);
                $responseData = array_merge($responseData, ['cognitiveDomainResult' => $cognitiveDomainResult]);
        
                
                $oceanDomainResults = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'domains', $user->role_name, $descriptors);
                $responseData = array_merge($responseData, ['oceanDomainResult' => $oceanDomainResults]);
        
                $oceanAllFacetsResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'all_facets', $user->role_name, $descriptors);
                $responseData = array_merge($responseData, ['oceanAllFacetsResult' => $oceanAllFacetsResult]);
        
                $oceanAllFacetsSingleResult = [];
                $oceanAllFacetsOverallResult = [];
        
        
                foreach ($oceanAllFacetsResult as $facet => $result) {
                    $newFacet = str_replace('-', '_', $facet);
                    $oceanAllFacetsSingleResult[$newFacet] = ['score' => $result['score'], 'percentage' => $result['percentage']];
                    $oceanAllFacetsOverallResult[$newFacet] = $result['score'];
                }
                $responseData = array_merge($responseData, ['oceanAllFacetsSingleResult' => $oceanAllFacetsSingleResult]);
                $responseData = array_merge($responseData, ['oceanAllFacetsOverallResult' => $oceanAllFacetsOverallResult]);
         
                $riasecDomainResult = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'domains', $user->role_name, $descriptors);
                $responseData = array_merge($responseData, ['riasecDomainResult' => $riasecDomainResult]);
        
                $riasecTop3Results = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'top_3_riasec');
        
                $riasecTop3Result['string'] = $riasecTop3Results['top-3-riasec']['level_description'] ?? '';
                $riasecTop3Result['array'] = str_split($riasecTop3Result['string']) ?? [];
                $riasecTop3Result['description'] = $riasecTop3Results['top-3-riasec']['description'] ?? '';
                $responseData = array_merge($responseData, ['riasecTop3Result' => $riasecTop3Result]);
        
                $ccsResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'ccs', $user->role_name, $descriptors);
                $responseData = array_merge($responseData, ['ccsResult' => $ccsResult]);
        
                $personalityTypeResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'personality_type');
                $responseData = array_merge($responseData, ['personalityTypeResult' => $personalityTypeResult]);
        
                $flightRiskResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'flight_risk', $user->role_name, $descriptors);
                $responseData = array_merge($responseData, ['flightRiskResult' => $flightRiskResult]);
        
                $organizationalFitForecastResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'organizational_fit_forecast', $user->role_name, $descriptors);
                $responseData = array_merge($responseData, ['organizationalFitForecastResult' => $organizationalFitForecastResult]);
        
                $growthPotentialResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'growth_potential', $user->role_name, $descriptors);
                $responseData = array_merge($responseData, ['growthPotentialResult' => $growthPotentialResult]);
        
                $rciResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'rci', $user->role_name, $descriptors);
                $responseData = array_merge($responseData, ['rciResult' => $rciResult]);
        
                
                $oceanSelfResult = [];
        
                $oceanSelfResult['Openness to Experience'] = $oceanDomainResults['openness-to-experience']['score'] ?? 0;
                $oceanSelfResult['Conscientiousness'] = $oceanDomainResults['conscientiousness']['score'] ?? 0;
                $oceanSelfResult['Extraversion'] = $oceanDomainResults['extraversion']['score'] ?? 0;
                $oceanSelfResult['Agreeableness'] = $oceanDomainResults['agreeableness']['score'] ?? 0;
                $oceanSelfResult['Emotional Stability'] = $oceanDomainResults['emotional-stability']['score'] ?? 0;
        
                $learningStyle = AssessmentHelper::getLearningStyle($user_id,$oceanSelfResult);
        
                $responseData = array_merge($responseData, ['learningStyle' => $learningStyle]);

                $jobOpeningApplication = JobOpeningApplication::where('user_id', $user->id)->latest()->first();
                $activitylogs = ActivityLog::where('user_id',$user->id)->where('job_application_id',$jobOpeningApplication->id)->get();
                // Pass the job details to your view

                $responseData = array_merge($responseData, ['user_results' => $user_results]);
                $responseData = array_merge($responseData, ['jobOpeningApplication' => $jobOpeningApplication]);
                $responseData = array_merge($responseData, ['user' => $user]);
                $responseData = array_merge($responseData, ['isUserResultExists' => $isUserResultExists]);
                $responseData = array_merge($responseData, ['activitylogs' => $activitylogs]);
                $responseData = array_merge($responseData, ['isResultAvailable' => 1]);

                $oceanDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'domains')->where('user_type', 'employee')->take(20)->get();      
            $responseData = array_merge($responseData, ['oceanDomainDescriptors' => $oceanDomainDescriptors]); 

            $riasecDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'riasec')->where('result_type', 'domains')->where('user_type', 'employee')->get();     
            $responseData = array_merge($responseData, ['riasecDomainDescriptors' => $riasecDomainDescriptors]); 

            $ccsDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'ccs')->where('user_type', 'employee')->get();     
            $responseData = array_merge($responseData, ['ccsDomainDescriptors' => $ccsDomainDescriptors]); 

            $learningAndDevelopmentPlanDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'learning_and_development_plan')->where('user_type', 'employee')->get();     
            $responseData = array_merge($responseData, ['learningAndDevelopmentPlanDescriptors' => $learningAndDevelopmentPlanDescriptors]); 

                return view('admin.job-openings.applicant-details', $responseData);

            }
            // $jobOpeningApplication = JobOpeningApplication::find($job_opening_application_id);
            $jobOpeningApplication = JobOpeningApplication::where('user_id', $user->id)->latest()->first();
            $activitylogs = ActivityLog::where('user_id',$user->id)->where('job_application_id',$jobOpeningApplication->id)->get();

            $responseData = array_merge($responseData, ['user_results' => $user_results]);
            $responseData = array_merge($responseData, ['jobOpeningApplication' => $jobOpeningApplication]);
            $responseData = array_merge($responseData, ['user' => $user]);
            $responseData = array_merge($responseData, ['isUserResultExists' => $isUserResultExists]);
            $responseData = array_merge($responseData, ['activitylogs' => $activitylogs]);
            $responseData = array_merge($responseData, ['isResultAvailable' => 0]);
            return view('admin.job-openings.applicant-details', $responseData);
    }


    public function downloadReport(Request $request, $employee_id, $job_opening_id) {

        User::where('id', $employee_id)->update([
            'last_report_downloaded_at' => now()
        ]);
        
        $data = [];
        // Assume $data contains report data; fetch or generate as needed
        $responseData = [];
        $user = User::find($employee_id);
        $user_id = $employee_id;
        $results = UserResult::where('user_id', $user_id)->get();
        if ($results->isEmpty()) {
            return redirect()->back()->with('error', 'Assessment Not Completed');
        } 
        $responseData['user'] = $user;
        $jobOpening = JobOpening::find($job_opening_id);
        $job = Job::find($jobOpening->job_id);
        $responseData['positionTitle'] = $jobOpening->job_title ?? '';
        $responseData['departmentTitle'] = $jobOpening->department->name ?? '';

        $descriptors = DB::table('master_descriptors')->where('user_type', 'candidate')->get();

        $total_correct = QuizDomainValueAnswer::where('user_id', $user_id)->where('quiz_domain_value_question_id', '>', 376)->where('is_correct', 1)->count();
        $responseData = array_merge($responseData, ['totalCorrectForCognitive' => $total_correct]);

        $total_not_attempted = QuizDomainValueAnswer::where('user_id', $user_id)->where('quiz_domain_value_question_id', '>', 376)->where('time_taken', 0)->where('option_selected', 0)->count();
        $responseData = array_merge($responseData, ['totalNonAttemptedForCognitive' => $total_not_attempted]);
        if ($total_correct == 0 && $total_not_attempted == 0) {
            $total_wrong = 0;
        } else {
            $total_wrong = 50 - $total_correct - $total_not_attempted;
        }
        $responseData = array_merge($responseData, ['totalWrongForCognitive' => $total_wrong]);

        $cognitiveOverallResult =  NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'overall','candidate',$descriptors);
        $responseData = array_merge($responseData, ['cognitiveOverallResult' => $cognitiveOverallResult]);
        
        $totalMarksForCognitive = $cognitiveOverallResult['cognitive']['score'] ?? 0;
        $responseData = array_merge($responseData, ['totalMarksForCognitive' => $totalMarksForCognitive]);

        $cognitiveDomainResult =  NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'domains','candidate',$descriptors);
        $responseData = array_merge($responseData, ['cognitiveDomainResult' => $cognitiveDomainResult]);

        
        $oceanDomainResults = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'domains','candidate',$descriptors);
        $responseData = array_merge($responseData, ['oceanDomainResult' => $oceanDomainResults]);

        $oceanAllFacetsResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'all_facets','candidate',$descriptors);
        $responseData = array_merge($responseData, ['oceanAllFacetsResult' => $oceanAllFacetsResult]);
    
        $riasecDomainResult = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'domains','candidate',$descriptors);
        $responseData = array_merge($responseData, ['riasecDomainResult' => $riasecDomainResult]);

        $riasecTop3Results = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'top_3_riasec');

        $riasecTop3Result['string'] = $riasecTop3Results['top-3-riasec']['level_description'] ?? '';
        $riasecTop3Result['array'] = str_split($riasecTop3Result['string']) ?? [];
        $riasecTop3Result['job_top_3_riasec'] = $job->top3riasec ?? '';
        $riasecTop3Result['job_top_3_riasec_array'] = str_split($riasecTop3Result['job_top_3_riasec']) ?? [];
        $riasecTop3Result['description'] = $riasecTop3Results['top-3-riasec']['description'] ?? '';
        $responseData = array_merge($responseData, ['riasecTop3Result' => $riasecTop3Result]);

        $ccsResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'ccs','candidate',$descriptors);

        $jobSkills = $job->skills ?? [];
        
        $jobSkillsArray = [];
        $jobSkillsLevelArray = [];
        foreach ($jobSkills as $skill) {
            $jobSkillsArray[] = $skill->title;
            $jobSkillsLevelArray[$skill->title] = $skill->level;
        }

        $jobCcsResult = [];
        $ccsResult = $ccsResult->filter(function ($result) use ($jobSkillsArray, $jobSkillsLevelArray, &$jobCcsResult, $descriptors) {
            // $result['is_job_required_skill'] = in_array($result['name'], $jobSkillsArray) ? 1 : 0;
            if (in_array($result['name'], $jobSkillsArray)) {
                // Add the current result to $jobCcsResult
                if($jobSkillsLevelArray[$result['name']] < $result['level']) {
                    $result['alignment_level'] = 2;
                } elseif ($jobSkillsLevelArray[$result['name']] == $result['level']) {
                    $result['alignment_level'] = 1;
                } else {
                    $result['alignment_level'] = 0;
                }
                $description = $descriptors->where('slug',$result['slug'])->where('user_type', 'candidate')->whereNotNull('job_requirement_level')->where('job_requirement_level', $jobSkillsLevelArray[$result['name']])->where('user_score_level', $result['level'])->first()->analysis ?? '';
                
                $result['required_level'] = $jobSkillsLevelArray[$result['name']];
                $result['description'] = $description;
                $jobCcsResult[$result['slug']] = $result;
                
                return false; // Remove it from $ccsResult
            }
        
            return true; // Keep it in $ccsResult
        });

        $responseData = array_merge($responseData, ['ccsResult' => $ccsResult]);
        $responseData = array_merge($responseData, ['jobCcsResult' => $jobCcsResult]);

        $allStarResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'all_star','candidate',$descriptors);
        $responseData = array_merge($responseData, ['allStarResult' => $allStarResult]);

        $personalityTypeResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'personality_type','candidate',$descriptors);
        $personalityTypeResponseResult = [];
        foreach ($personalityTypeResult as $name => $result) {
            $personalityTypeResponseResult['name'] = $result['name'] ?? '';
            $personalityTypeResponseResult['description'] = $result['level_description'] ?? '';
            break;
        }
        $responseData = array_merge($responseData, ['personalityTypeResult' => $personalityTypeResponseResult]);
        
        $flightRiskResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'flight_risk','candidate',$descriptors);
        $responseData = array_merge($responseData, ['flightRiskResult' => $flightRiskResult]);

        $organizationalFitForecastResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'organizational_fit_forecast','candidate',$descriptors);
        $responseData = array_merge($responseData, ['organizationalFitForecastResult' => $organizationalFitForecastResult]);

        $growthPotentialResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'growth_potential','candidate',$descriptors);
        $responseData = array_merge($responseData, ['growthPotentialResult' => $growthPotentialResult]);

        $rciResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'rci','candidate',$descriptors);
        $responseData = array_merge($responseData, ['rciResult' => $rciResult]);

        $oceanSelfResult = [];

        $oceanSelfResult['Openness to Experience'] = $oceanDomainResults['openness-to-experience']['score'] ?? 0;
        $oceanSelfResult['Conscientiousness'] = $oceanDomainResults['conscientiousness']['score'] ?? 0;
        $oceanSelfResult['Extraversion'] = $oceanDomainResults['extraversion']['score'] ?? 0;
        $oceanSelfResult['Agreeableness'] = $oceanDomainResults['agreeableness']['score'] ?? 0;
        $oceanSelfResult['Emotional Stability'] = $oceanDomainResults['emotional-stability']['score'] ?? 0;

        $learningStyle = AssessmentHelper::getLearningStyle($user_id,$oceanSelfResult);
        $responseData = array_merge($responseData, ['learningStyle' => $learningStyle]);

        $overAllMatchRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'all', 'overall_match_rate','candidate',$descriptors);
        $responseData = array_merge($responseData, ['overAllMatchRateResult' => $overAllMatchRateResult]);

        $behaviorFitRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'all', 'soft_skill_score','candidate',$descriptors);
        $responseData = array_merge($responseData, ['behaviorFitRateResult' => $behaviorFitRateResult]);
        
        $technicalResult = NewAssessmentHelper::getFormattedUserResults($results, 'technical', 'overall','candidate',$descriptors);
        $responseData = array_merge($responseData, ['technicalResult' => $technicalResult]);

        $softSkillMatchRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'ccs_match_rate','candidate',$descriptors);
        $responseData = array_merge($responseData, ['softSkillMatchRateResult' => $softSkillMatchRateResult]);

        $jobMatchRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'riasec', 'jmr','candidate',$descriptors);
        $responseData = array_merge($responseData, ['jobMatchRateResult' => $jobMatchRateResult]);

        $oceanDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'domains')->where('user_type', 'candidate')->take(20)->get();      
        $responseData = array_merge($responseData, ['oceanDomainDescriptors' => $oceanDomainDescriptors]); 

        $allStarResults = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'all_star','candidate',$descriptors);
        $responseData = array_merge($responseData, ['allStarResult' => $allStarResults]);

        $oceanAllFacetsDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'all_facets')->where('user_type', 'candidate')->get();      
        $responseData = array_merge($responseData, ['oceanAllFacetsDescriptors' => $oceanAllFacetsDescriptors]); 
       
        $riasecDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'riasec')->where('result_type', 'domains')->where('user_type', 'candidate')->get();     
        $responseData = array_merge($responseData, ['riasecDomainDescriptors' => $riasecDomainDescriptors]); 

        $ccsDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'ccs')->where('user_type', 'candidate')->get();     
        $responseData = array_merge($responseData, ['ccsDomainDescriptors' => $ccsDomainDescriptors]); 

        $learningAndDevelopmentPlanDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'learning_and_development_plan')->where('user_type', 'candidate')->get();     
        $responseData = array_merge($responseData, ['learningAndDevelopmentPlanDescriptors' => $learningAndDevelopmentPlanDescriptors]); 

        $allStarDomainDescriptors = DB::table('master_descriptors')->where('assessment_type', 'ocean')->where('result_type', 'all_star')->where('user_type', 'candidate')->get();     
        $responseData = array_merge($responseData, ['allStarDomainDescriptors' => $allStarDomainDescriptors]); 

        $reportDate = Carbon::now()->format('d F Y');
        $responseData = array_merge($responseData, ['reportDate' => $reportDate]);

        $chartData = [44, 55, 13, 43]; // Example data
        $chartLabels = ['Apple', 'Mango', 'Orange', 'Banana'];

        $responseData = array_merge($responseData, ['chartData' => $chartData]);
        $responseData = array_merge($responseData, ['chartLabels' => $chartLabels]);

        $totalCorrect = $total_correct*2 ?? 0;
        $totalWrong = $total_wrong*2 ?? 0;
        $totalMissed = $total_not_attempted*2 ?? 0;

        $chartUrl = 'https://quickchart.io/chart?c=' . urlencode(json_encode([
            'type' => 'doughnut',
            'data' => [
                'labels' => ['Correct Answers', 'Wrong Answers', 'Missed'],
                'datasets' => [[
                    'data' => [$totalCorrect, $totalWrong, $totalMissed],
                    'backgroundColor' => ['#BBECC5', '#FFDC92', '#f4a261'],
                    'borderWidth' => 0,
                ]]
            ],
            'options' => [
                'cutout' => '80%',
                'plugins' => [
                    'legend' => [
                        'display' => true,
                    ],
                    'datalabels' => [
                        'display' => true,
                    ],
                ],
            ]

        ]));
        
        $imageData = base64_encode(file_get_contents($chartUrl));
        $imageSrc = 'data:image/png;base64,' . $imageData;

        // OCEAN Summary
        $oceanSummary = NewAssessmentHelper::getOceanSummary($oceanDomainResults, 'admin');
        $responseData = array_merge($responseData, ['oceanSummary' => $oceanSummary]);
 
        $text = $oceanSummary ?? '';
        $length = strlen(strip_tags($text));
        $fontSize = 14; // default
 
        if ($length > 1200) {
            $fontSize = 10;
        } elseif ($length > 800) {
            $fontSize = 12;
        }
        $responseData = array_merge($responseData, ['oceanSummaryFontSize' => $fontSize]);

        $technicalSkillMatchRateResult = NewAssessmentHelper::getFormattedUserResults($results, 'cognitive', 'technical_skill_match_rate', 'candidate', $descriptors, $user->position_id);
        $responseData = array_merge($responseData, ['technicalSkillMatchRateResult' => $technicalSkillMatchRateResult]);

        $leadershipPotentialResult = NewAssessmentHelper::getFormattedUserResults($results, 'ocean', 'leadership_potential', 'candidate', $descriptors);
        $responseData = array_merge($responseData, ['leadershipPotentialResult' => $leadershipPotentialResult]);
        
        // dd($chartUrl);
        $responseData = array_merge($responseData, ['chartUrl' => $imageSrc]);
        // dd($responseData, $oceanAllFacetsResult->keys());
        // View file that formats the report

        $pdf = PDF::loadView('admin.reports.candidate-details-template', $responseData);
  
        $pdfName = $user->name.' Assessment Report.pdf';
        // Download the PDF file
        return $pdf->download($pdfName);
    }

}