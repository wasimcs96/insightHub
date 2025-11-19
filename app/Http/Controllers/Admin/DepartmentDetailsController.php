<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Position;
use App\Models\User;
use App\Models\Department;
use App\Models\DepartmentSection;
use App\Models\JobOpening;
use App\Models\JobHeadcount;
use App\Models\JobProfile;


use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Mpdf\Mpdf;


class DepartmentDetailsController extends Controller
{
     public function departmentDetails(Request $request, $id)
    {
        $user = Auth::user();

        $department = Department::find($id);
        
        if (!$department) {
            return redirect()->back()->with('error', 'Department not found.');
        }
        
        $results = DB::table('users as u')
        ->join('user_results as ur', 'u.id', '=', 'ur.user_id')
        ->where('u.department_id', $id)
        ->where(function ($query) {
            $query->where(function ($q) {
                $q->whereColumn('ur.job_id', 'u.position_id')->where('ur.result_type', 'overall_match_rate');
            })
            ->orWhere(function ($q) {
                $q->whereColumn('ur.job_id', 'u.position_id')->where('ur.result_type', 'soft_skill_score'); 
            })
            ->orWhere(function ($q) {
                $q->whereColumn('ur.job_id', 'u.position_id')->where('ur.result_type', 'technical_skill_match_rate'); 
            })
            ->orWhere(function ($q) {
                $q->whereColumn('ur.job_id', 'u.position_id')->where('ur.result_type', 'jmr'); 
            })
            ->orWhere(function ($q) {
                $q->where('ur.result_type', 'flight_risk'); 
            })
            ->orWhere(function ($q) {
                $q->where('ur.result_type', 'organizational_fit_forecast'); 
            })
            ->orWhere(function ($q) {
                $q->whereColumn('ur.job_id', 'u.position_id')->where('ur.result_type', 'overall')
                    ->where('ur.assessment_type', 'technical'); 
            })
            ->orWhere(function ($q) {
                $q->where('ur.result_type', 'overall')
                    ->where('ur.assessment_type', 'cognitive'); 
            })
            ->orWhere(function ($q) {
                $q->whereColumn('ur.job_id', 'u.position_id')->where('ur.result_type', 'ccs_match_rate')
                    ->where('ur.assessment_type', 'ocean'); 
            })
            ->orWhere(function ($q) {
                $q->where('ur.result_type', 'leadership_potential')
                    ->where('ur.assessment_type', 'ocean'); 
            })
            ->orWhere(function ($q) {
                $q->where('ur.result_type', 'growth_potential')
                    ->where('ur.assessment_type', 'ocean'); 
            })
            ->orWhere(function ($q) {
                $q->where('ur.assessment_type', 'all_star')
                    ->where('ur.slug', 'have-empathy-and-respect');
            })
            ->orWhere(function ($q) {
                $q->where('ur.result_type', 'all_star')
                    ->where('ur.slug', 'keep-it-simple');
            })
            ->orWhere(function ($q) {
                $q->where('ur.result_type', 'all_star')
                    ->where('ur.slug', 'all-for-one-one-for-all'); 
            })
            ->orWhere(function ($q) {
                $q->where('ur.result_type', 'all_star')
                    ->where('ur.slug', 'celebrate-all-individuals'); 
            })
            ->orWhere(function ($q) {
                $q->where('ur.result_type', 'all_star')
                    ->where('ur.slug', 'make-a-difference');
            })
            ->orWhere(function ($q) {
                $q->where('ur.result_type', 'all_star')
                    ->where('ur.slug', 'dare-to-dream'); 
            })
            ->orWhere(function ($q) {
                $q->where('ur.result_type', 'all_star')
                    ->where('ur.slug', 'be-transparent'); 
            })
            ->orWhere(function ($q) {
                $q->where('ur.result_type', 'all_star')
                    ->where('ur.slug', 'safety-1'); 
            });
        })
        ->select(
            'u.id',
            'u.name',
            DB::raw("MAX(CASE WHEN ur.result_type = 'overall_match_rate' THEN ur.level END) AS omr_level"),
            DB::raw("MAX(CASE WHEN ur.result_type = 'soft_skill_score' THEN ur.level END) AS bfr_level"),
            DB::raw("MAX(CASE WHEN ur.result_type = 'technical_skill_match_rate' THEN ur.level END) AS tsmr_level"),
            DB::raw("MAX(CASE WHEN ur.result_type = 'jmr' THEN ur.level END) AS jmr_level"),
            DB::raw("MAX(CASE WHEN ur.result_type = 'flight_risk' THEN ur.level END) AS fr_level"),
            DB::raw("MAX(CASE WHEN ur.result_type = 'organizational_fit_forecast' THEN ur.level END) AS waf_level"),
            DB::raw("MAX(CASE WHEN ur.assessment_type = 'technical' AND ur.result_type = 'overall' THEN ur.level END) AS ta_level"),
            DB::raw("MAX(CASE WHEN ur.assessment_type = 'cognitive' AND ur.result_type = 'overall' THEN ur.level END) AS cat_level"),
            DB::raw("MAX(CASE WHEN ur.assessment_type = 'ocean' AND ur.result_type = 'ccs_match_rate' THEN ur.level END) AS mr_level"),
            DB::raw("MAX(CASE WHEN ur.assessment_type = 'ocean' AND ur.result_type = 'leadership_potential' THEN ur.level END) AS lp_level"),
            DB::raw("MAX(CASE WHEN ur.assessment_type = 'ocean' AND ur.result_type = 'growth_potential' THEN ur.level END) AS gp_level"),
            DB::raw("MAX(CASE WHEN ur.slug = 'have-empathy-and-respect' AND ur.result_type = 'all_star' THEN ur.level END) AS celebrate_individuals"),
            DB::raw("MAX(CASE WHEN ur.slug = 'keep-it-simple' AND ur.result_type = 'all_star' THEN ur.level END) AS be_transparent"),
            DB::raw("MAX(CASE WHEN ur.slug = 'all-for-one-one-for-all' AND ur.result_type = 'all_star' THEN ur.level END) AS make_difference"),
            DB::raw("MAX(CASE WHEN ur.slug = 'celebrate-all-individuals' AND ur.result_type = 'all_star' THEN ur.level END) AS keep_it_simple_level"),
            DB::raw("MAX(CASE WHEN ur.slug = 'make-a-difference' AND ur.result_type = 'all_star' THEN ur.level END) AS all_for_one"),
            DB::raw("MAX(CASE WHEN ur.slug = 'dare-to-dream' AND ur.result_type = 'all_star' THEN ur.level END) AS have_empathy"),
            DB::raw("MAX(CASE WHEN ur.slug = 'be-transparent' AND ur.result_type = 'all_star' THEN ur.level END) AS safety"),
            DB::raw("MAX(CASE WHEN ur.slug = 'safety-1' AND ur.result_type = 'all_star' THEN ur.level END) AS dare_to_dream"),
        )
        ->groupBy('u.id', 'u.name')
        ->get();

        $groupedEmployees = [];

        $omrLevelCounts = [
            'VeryHigh' => 0,
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
            'VeryLow' => 0,
        ];
        
        $bfrLevelCounts = [
            'VeryHigh' => 0,
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
            'VeryLow' => 0,
        ];

        $taLevelCounts = [
           'VeryHigh' => 0,
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
            'VeryLow' => 0,
        ];

        $tsmrLevelCounts = [
            'VeryHigh' => 0,
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
            'VeryLow' => 0,
        ];
        
        $jmrLevelCounts = [
            'VeryHigh' => 0,
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
            'VeryLow' => 0,
        ];

        $flightRiskCounts = [
            'VeryHigh' => 0,
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
            'VeryLow' => 0,
        ];

        $workplaceAlignmentForecast = [
            'VeryHigh' => 0,
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
            'VeryLow' => 0,
        ];

        $catLevelCounts = [
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
        ];

        $matchRateCounts = [
            'VeryHigh' => 0,
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
            'VeryLow' => 0,
        ];

        $leadershipPotentialCounts = [
            'VeryHigh' => 0,
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
            'VeryLow' => 0,
        ];

        $growthPotentialCounts = [
            'VeryHigh' => 0,
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
            'VeryLow' => 0,
        ];

        $safetyCount = [
            'HighAligned' => 0,
            'Aligned' => 0,
            'NeedDevelopment' => 0,
        ];

        $celebrateIndividualsCount = [
            'HighAligned' => 0,
            'Aligned' => 0,
            'NeedDevelopment' => 0,
        ];

        $beTransparentCount = [
            'HighAligned' => 0,
            'Aligned' => 0,
            'NeedDevelopment' => 0,
        ];

        $makeDifferenceCount = [
            'HighAligned' => 0,
            'Aligned' => 0,
            'NeedDevelopment' => 0,
        ];

        $keepItSimpleCount = [
            'HighAligned' => 0,
            'Aligned' => 0,
            'NeedDevelopment' => 0,
        ];

        $allForOneCount = [
            'HighAligned' => 0,
            'Aligned' => 0,
            'NeedDevelopment' => 0,
        ];

        $haveEmpathyCount = [
            'HighAligned' => 0,
            'Aligned' => 0,
            'NeedDevelopment' => 0,
        ];

        $dareToDreamCount = [
            'HighAligned' => 0,
            'Aligned' => 0,
            'NeedDevelopment' => 0,
        ];
        
        foreach ($results as $data) {
            if($data->omr_level == 5){
                $omrLevelCounts['VeryHigh']++;
            } elseif ($data->omr_level == 4) {
                $omrLevelCounts['High']++;
            } elseif ($data->omr_level == 3) {
                $omrLevelCounts['Moderate']++;
            } elseif ($data->omr_level == 2) {
                $omrLevelCounts['Low']++;
            }elseif ($data->omr_level == 1) {
                $omrLevelCounts['VeryLow']++;
            }

            if($data->bfr_level == 5){
                $bfrLevelCounts['VeryHigh']++;
            } elseif ($data->bfr_level == 4) {
                $bfrLevelCounts['High']++;
            } elseif ($data->bfr_level == 3) {
                $bfrLevelCounts['Moderate']++;
            } elseif ($data->bfr_level == 2) {
                $bfrLevelCounts['Low']++;
            }elseif ($data->bfr_level == 1) {
                $bfrLevelCounts['VeryLow']++;
            }

            if($data->ta_level == 5){
                $taLevelCounts['VeryHigh']++;
            } elseif ($data->ta_level == 4) {
                $taLevelCounts['High']++;
            } elseif ($data->ta_level == 3) {
                $taLevelCounts['Moderate']++;
            } elseif ($data->ta_level == 2) {
                $taLevelCounts['Low']++;
            }elseif ($data->ta_level == 1) {
                $taLevelCounts['VeryLow']++;
            }

            if($data->tsmr_level == 5){
                $tsmrLevelCounts['VeryHigh']++;
            } elseif ($data->tsmr_level == 4) {
                $tsmrLevelCounts['High']++;
            } elseif ($data->tsmr_level == 3) {
                $tsmrLevelCounts['Moderate']++;
            } elseif ($data->tsmr_level == 2) {
                $tsmrLevelCounts['Low']++;
            }elseif ($data->tsmr_level == 1) {
                $tsmrLevelCounts['VeryLow']++;
            }

            if($data->jmr_level == 5){
                $jmrLevelCounts['VeryHigh']++;
            } elseif ($data->jmr_level == 4) {
                $jmrLevelCounts['High']++;
            } elseif ($data->jmr_level == 3) {
                $jmrLevelCounts['Moderate']++;
            } elseif ($data->jmr_level == 2) {
                $jmrLevelCounts['Low']++;
            }elseif ($data->jmr_level == 1) {
                $jmrLevelCounts['VeryLow']++;
            }

            if($data->fr_level == 5){
                $flightRiskCounts['VeryHigh']++;
            } elseif ($data->fr_level == 4) {
                $flightRiskCounts['High']++;
            } elseif ($data->fr_level == 3) {
                $flightRiskCounts['Moderate']++;
            } elseif ($data->fr_level == 2) {
                $flightRiskCounts['Low']++;
            }elseif ($data->fr_level == 1) {
                $flightRiskCounts['VeryLow']++;
            }

            if($data->waf_level == 5){
                $workplaceAlignmentForecast['VeryHigh']++;
            } elseif ($data->waf_level == 4) {
                $workplaceAlignmentForecast['High']++;
            } elseif ($data->waf_level == 3) {
                $workplaceAlignmentForecast['Moderate']++;
            } elseif ($data->waf_level == 2) {
                $workplaceAlignmentForecast['Low']++;
            }elseif ($data->waf_level == 1) {
                $workplaceAlignmentForecast['VeryLow']++;
            }

            if($data->cat_level == 3) {
                $catLevelCounts['High']++;
            } elseif ($data->cat_level == 2) {
                $catLevelCounts['Moderate']++;
            } elseif ($data->cat_level == 1) {
                $catLevelCounts['Low']++;
            }

            if($data->mr_level == 5){
                $matchRateCounts['VeryHigh']++;
            } elseif ($data->mr_level == 4) {
                $matchRateCounts['High']++;
            } elseif ($data->mr_level == 3) {
                $matchRateCounts['Moderate']++;
            } elseif ($data->mr_level == 2) {
                $matchRateCounts['Low']++;
            }elseif ($data->mr_level == 1) {
                $matchRateCounts['VeryLow']++;
            }

            if($data->lp_level == 5){
                $leadershipPotentialCounts['VeryHigh']++;
            } elseif ($data->lp_level == 4) {
                $leadershipPotentialCounts['High']++;
            } elseif ($data->lp_level == 3) {
                $leadershipPotentialCounts['Moderate']++;
            } elseif ($data->lp_level == 2) {
                $leadershipPotentialCounts['Low']++;
            }elseif ($data->lp_level == 1) {
                $leadershipPotentialCounts['VeryLow']++;
            }

            if($data->gp_level == 5){
                $growthPotentialCounts['VeryHigh']++;
            } elseif ($data->gp_level == 4) {
                $growthPotentialCounts['High']++;
            } elseif ($data->gp_level == 3) {
                $growthPotentialCounts['Moderate']++;
            } elseif ($data->gp_level == 2) {
                $growthPotentialCounts['Low']++;
            }elseif ($data->gp_level == 1) {
                $growthPotentialCounts['VeryLow']++;
            }
            
            if($data->safety == 3) {
                $safetyCount['HighAligned']++;
            } elseif ($data->safety == 2) {
                $safetyCount['Aligned']++;
            } elseif ($data->safety == 1) {
                $safetyCount['NeedDevelopment']++;
            }

            if($data->celebrate_individuals == 3) {
                $celebrateIndividualsCount['HighAligned']++;
            } elseif ($data->celebrate_individuals == 2) {
                $celebrateIndividualsCount['Aligned']++;
            } elseif ($data->celebrate_individuals == 1) {
                $celebrateIndividualsCount['NeedDevelopment']++;
            }

            if($data->be_transparent == 3) {
                $beTransparentCount['HighAligned']++;
            } elseif ($data->be_transparent == 2) {
                $beTransparentCount['Aligned']++;
            } elseif ($data->be_transparent == 1) {
                $beTransparentCount['NeedDevelopment']++;
            }

            if($data->make_difference == 3) {
                $makeDifferenceCount['HighAligned']++;
            } elseif ($data->make_difference == 2) {
                $makeDifferenceCount['Aligned']++;
            } elseif ($data->make_difference == 1) {
                $makeDifferenceCount['NeedDevelopment']++;
            }

            if($data->keep_it_simple_level == 3) {
                $keepItSimpleCount['HighAligned']++;
            } elseif ($data->keep_it_simple_level == 2) {
                $keepItSimpleCount['Aligned']++;
            } elseif ($data->keep_it_simple_level == 1) {
                $keepItSimpleCount['NeedDevelopment']++;
            }

            if($data->all_for_one == 3) {
                $allForOneCount['HighAligned']++;
            } elseif ($data->all_for_one == 2) {
                $allForOneCount['Aligned']++;
            } elseif ($data->all_for_one == 1) {
                $allForOneCount['NeedDevelopment']++;
            }

            if($data->have_empathy == 3) {
                $haveEmpathyCount['HighAligned']++;
            } elseif ($data->have_empathy == 2) {
                $haveEmpathyCount['Aligned']++;
            } elseif ($data->have_empathy == 1) {
                $haveEmpathyCount['NeedDevelopment']++;
            }

            if($data->dare_to_dream == 3) {
                $dareToDreamCount['HighAligned']++;
            } elseif ($data->dare_to_dream == 2) {
                $dareToDreamCount['Aligned']++;
            } elseif ($data->dare_to_dream == 1) {
                $dareToDreamCount['NeedDevelopment']++;
            }
        }

        $departmentName = $department ? $department->name : 'N/A';
        $location = $department ? $department->location : 'N/A';
        $headOfDepartment = $department ? User::where('id', $department->user_id)->pluck('name')->first() : 'N/A';
        $activeJobAds = JobOpening::where('department_id', $id)->where('status', 1)->count();
        $totalNumberJobPosition = JobProfile::where('department_id',$id)->count();
        $totalHeads = JobHeadcount::whereIn('job_id', function ($query) use ($id) {
            $query->select('id')->from('jobs')->where('department_id', $id);
        })->count();
        // dd($totalHeads);
        $totalEmployee = User::where('department_id', $id)->count();
        $jobVacancy = $totalHeads - $totalEmployee;
        $positionNames = Position::where('department_id', $id)->pluck('name');
        $roleNames = User::where('department_id', $id)->pluck('role_name');
        $cityCounts = User::where('department_id', $id)
        ->leftJoin('master_cities', 'users.city_id', '=', 'master_cities.id')
        ->select(
            DB::raw('COALESCE(master_cities.name, "Other") as city'),
            DB::raw('count(*) as count')
        )
        ->groupBy(DB::raw('COALESCE(master_cities.name, "Other")'))
        ->get();   
        $departmentSectionNames = Department::where('id', $id)->value('name');

        $departmentSectionStatus = Department::where('id', $id)->value('status');   

        // $ageGroups = [
        //     '18-24' => [18, 24],
        //     '25-34' => [25, 34],
        //     '35-44' => [35, 44],
        //     '45-54' => [45, 54],
        //     '55-64' => [55, 64],
        //     '65+'   => [65, 100]
        // ];

        // $genderData = [
        //     'Male' => [],
        //     'Female' => []
        // ];

        // foreach ($ageGroups as $label => [$minAge, $maxAge]) {
        //     $genderData['Male'][] = User::where('department_id', $id)
        //         ->where('gender', 0)
        //         ->whereBetween('age', [$minAge, $maxAge])
        //         ->count();
        //     $genderData['Female'][] = User::where('department_id', $id)
        //         ->where('gender', 1)
        //         ->whereBetween('age', [$minAge, $maxAge])
        //         ->count();
        // }

       $ageGroups = [
        '0'     => [0],        // Group for users with null age
        '18-24' => [18, 24],
        '25-34' => [25, 34],
        '35-44' => [35, 44],
        '45-54' => [45, 54],
        '55-64' => [55, 64],
        '65+'   => [65, 100]
        ];

        $genderData = [
            'Male' => [],
            'Female' => [],
            'Others' => [] // For unknown gender
        ];

        foreach ($ageGroups as $label => $range) {
            if (count($range) === 2) {
                [$minAge, $maxAge] = $range;

                $genderData['Male'][] = User::where('department_id', $id)
                    ->where('gender', 0)
                    ->whereBetween('age', [$minAge, $maxAge])
                    ->count();

                $genderData['Female'][] = User::where('department_id', $id)
                    ->where('gender', 1)
                    ->whereBetween('age', [$minAge, $maxAge])
                    ->count();

                $genderData['Others'][] = User::where('department_id', $id)
                    ->where(function ($query) {
                        $query->whereNull('gender')
                            ->orWhereNotIn('gender', [0, 1]);
                    })
                    ->whereBetween('age', [$minAge, $maxAge])
                    ->count();
            } else {
                // Group for users with NULL age
                $genderData['Male'][] = User::where('department_id', $id)
                    ->where('gender', 0)
                    ->whereNull('age')
                    ->count();

                $genderData['Female'][] = User::where('department_id', $id)
                    ->where('gender', 1)
                    ->whereNull('age')
                    ->count();

                $genderData['Others'][] = User::where('department_id', $id)
                    ->where(function ($query) {
                        $query->whereNull('gender')
                            ->orWhereNotIn('gender', [0, 1]);
                    })
                    ->whereNull('age')
                    ->count();
            }
        }





                $employmentStatuses = config('constants.EMPLOYMENT_STATUS');

                $employmentStatusCounts = User::where('department_id', $id)
                    ->select('employment_status', DB::raw('count(*) as count'))
                    ->groupBy('employment_status')
                    ->get()
                    ->pluck('count', 'employment_status')
                    ->toArray();

                // Initialize status data with all known statuses set to 0
                $statusData = array_fill_keys(array_values($employmentStatuses), 0);
                $statusData['Others'] = 0; // Add 'Others' category

                foreach ($employmentStatusCounts as $statusId => $count) {
                    if (isset($employmentStatuses[$statusId])) {
                        $label = $employmentStatuses[$statusId];
                        $statusData[$label] = $count;
                    } else {
                        $statusData['Others'] += $count; // Unknown status goes to Others
                    }
                }

                $assessmentCompletion = User::where('department_id', $id)->get();

                $completeAssessment = 0; 
                $notCompleteAssessment = 0; 

                foreach ($assessmentCompletion as $user) {
                    if (
                        $user->is_personality_motivation_completed === 1 &&
                        $user->is_work_interest_completed === 1 &&
                        $user->is_cognitive_ability_completed === 1 &&
                        $user->technical_assessment_completed === 1
                    ) {
                        $completeAssessment++;
                    } else {
                $notCompleteAssessment++; 
            }
        }

        $assessmentCompletionStatusData = [
            'Fully Completed' => $completeAssessment,
            'Not Fully Completed' => $notCompleteAssessment
        ];

        // $positionLevels = Position::select('positions.level', DB::raw('COUNT(users.id) as user_count'))
        //     ->leftJoin('users', 'users.position_id', '=', 'positions.id')
        //     ->where('users.department_id', $id)
        //     ->groupBy('positions.level')
        //     ->orderBy('positions.level', 'asc')
        //     ->get();

        // $positionLevel = array_fill_keys(range(1, 4), 0);
        // foreach ($positionLevels as $position) {
        //     $positionLevel[$position->level] = $position->user_count;
        // }

        // $positionLevelData = [];
        // foreach ($positionLevel as $level => $user_count) {
        //     $positionLevelData[] = [
        //         'level' => $level,
        //         'user_count' => $user_count
        //     ];
        // }

        // dd($id);

         $highestPositionLevel = DB::table('jobs')
            ->where('department_id', $id)
            ->max('level');
            // dd($highestPositionLevel);
        
       $employeeData = User::join('jobs', 'users.position_id', '=', 'jobs.id')
        ->leftJoin('user_results as ur', function ($join) {
            $join->on('users.id', '=', 'ur.user_id')
                ->where('ur.result_type', 'soft_skill_score'); 
        })
        ->where('jobs.department_id', $id)
        ->where('users.department_id', $id) 
        ->where('users.role_name', 'employee')
        ->select(
            'users.id',
            'users.name',
            'users.email',
            'users.role_name',
            'users.profile_picture',
            'users.is_high_potential',
            'users.age',
            'users.gender',
            'jobs.title as position_name',
            'jobs.level',
            'users.is_personality_motivation_completed',
            'users.is_work_interest_completed',
            'users.is_cognitive_ability_completed',
            DB::raw("MAX(CASE WHEN ur.result_type = 'soft_skill_score' THEN ur.level END) AS bfr_level"),
        )
        ->groupBy('users.id') // This will group by user_id to prevent duplicates
        ->orderByDesc('jobs.level')
        ->get();


        $positionsByLevel = $employeeData->groupBy('level')->map(function ($group) {
            return $group->pluck('position_name')->unique();
        })->toArray();

        $levelCounts = $employeeData->groupBy('level')
        ->map(function ($group) {
            return count($group);
        })
        ->sortKeys(); 

        $positionLevelData = $levelCounts->map(function ($count, $level) {
            return [
                'level' => $level,
                'user_count' => $count
            ];
        })->values()->toArray();

        $positionsByLevel = $employeeData->groupBy('level')
        ->map(function ($group) {
            return [
                'level' => $group->first()->level,  
                'count' => $group->count(),       
                'positions' => $group->groupBy('position_name') 
            ];
        });

        $levelsByPosition = $employeeData->groupBy('position_name')
        ->map(function ($group) {
            return [
                'position_name' => $group->first()->position_name, 
                'count' => $group->count(),                      
                'levels' => $group->pluck('level')->unique()     
            ];
        });

        $positionsByLevelPsychometric = $employeeData->groupBy('level')->map(function ($group) {
            $completed = $group->filter(function ($user) {
                return $user->is_personality_motivation_completed &&
                    $user->is_work_interest_completed &&
                    $user->is_cognitive_ability_completed;
            })->count();

            $incomplete = $group->count() - $completed;

            return [
                'level' => $group->first()->level,
                'count' => $group->count(),
                'completed_count' => $completed,
                'incomplete_count' => $incomplete,
                'positions' => $group->groupBy('position_name')
            ];
        });

        $levelsByPositionPsychometric = $employeeData->groupBy('position_name')->map(function ($group) {
            $completed = $group->filter(function ($user) {
                return $user->is_personality_motivation_completed &&
                    $user->is_work_interest_completed &&
                    $user->is_cognitive_ability_completed;
            })->count();

            $incomplete = $group->count() - $completed;

            return [
                'position_name' => $group->first()->position_name,
                'count' => $group->count(),
                'completed_count' => $completed,
                'incomplete_count' => $incomplete,
                'levels' => $group->pluck('level')->unique()
            ];
        });

        $positionLevelCounts = $employeeData->countBy('level')->sortKeys();
    
        $uniqueLevels = $positionLevelCounts->keys()->sort()->values();

        $uniquePositions = $employeeData->pluck('position_name')->unique();
        $positionCounts = $employeeData->countBy('position_name');

        $assessmentStatus = [
            'Completed' => User::where('department_id', $id)
                    ->where('is_personality_motivation_completed', 1)
                    ->where('is_work_interest_completed', 1)
                    ->where('is_english_proficiency_completed', 1)
                    ->where('is_work_values_completed', 1)
                    ->where('is_employability_completed', 1)
                    ->where('is_future_of_work_completed', 1)
                    ->where('is_cognitive_ability_completed', 1)
                    ->count(),
            'NotCompleted' => User::where('department_id', $id)
                ->where(function ($query) {
                    $query->where('is_personality_motivation_completed', 0)
                        ->orWhere('is_work_interest_completed', 0)
                        ->orWhere('is_english_proficiency_completed', 0)
                        ->orWhere('is_work_values_completed', 0)
                        ->orWhere('is_employability_completed', 0)
                        ->orWhere('is_future_of_work_completed', 0)
                        ->orWhere('is_cognitive_ability_completed', 0);
                })
                ->count()
        ];

        $total = $assessmentStatus['Completed'] + $assessmentStatus['NotCompleted'];

        $completedPercentage = round($total > 0 ? ($assessmentStatus['Completed'] / $total) * 100 : 0);
        $notCompletedPercentage = round($total > 0 ? ($assessmentStatus['NotCompleted'] / $total) * 100 : 0);

        $ageGroupPDF = [
            '20-30' => [20, 30],
            '31-40' => [31, 40],
            '41-50' => [41, 50],
            '51-100' => [51, 100]
        ];
        
        $ageData = User::selectRaw("
            CASE 
                WHEN age BETWEEN 20 AND 30 THEN '20-30'
                WHEN age BETWEEN 31 AND 40 THEN '31-40'
                WHEN age BETWEEN 41 AND 50 THEN '41-50'
                WHEN age BETWEEN 51 AND 100 THEN '51-100'
            END AS age_group, COUNT(*) AS count
            ")
            ->where('department_id', $id)
            ->whereNotNull('age') 
            ->groupBy('age_group')
            ->get();

        $resultOMR = DB::table('users as u')
            ->join('jobs as j', 'u.position_id', '=', 'j.id')
            ->join('user_results as ur', 'u.id', '=', 'ur.user_id')
            ->where('u.department_id', $id)
            ->where('ur.result_type', 'overall_match_rate') 
            ->select(
                'j.level',
                DB::raw("SUM(CASE WHEN ur.level = 5 THEN 1 ELSE 0 END) as Very_High"),
                DB::raw("SUM(CASE WHEN ur.level = 4 THEN 1 ELSE 0 END) as High"),
                DB::raw("SUM(CASE WHEN ur.level = 3 THEN 1 ELSE 0 END) as Moderate"),
                DB::raw("SUM(CASE WHEN ur.level = 2 THEN 1 ELSE 0 END) as Low"),
                DB::raw("SUM(CASE WHEN ur.level = 1 THEN 1 ELSE 0 END) as Very_Low")
            )
            ->groupBy('j.level')
            ->orderBy('j.level', 'asc')
            ->get();

        $resultTA = DB::table('users as u')
            ->join('jobs as j', 'u.position_id', '=', 'j.id')
            ->join('user_results as ur', 'u.id', '=', 'ur.user_id')
            ->where('u.department_id', $id)
            ->where('ur.result_type', 'overall')
            ->where('ur.assessment_type', 'technical') 
            ->select(
                'j.level',
                DB::raw("SUM(CASE WHEN ur.level = 5 THEN 1 ELSE 0 END) as Very_High"),
                DB::raw("SUM(CASE WHEN ur.level = 4 THEN 1 ELSE 0 END) as High"),
                DB::raw("SUM(CASE WHEN ur.level = 3 THEN 1 ELSE 0 END) as Moderate"),
                DB::raw("SUM(CASE WHEN ur.level = 2 THEN 1 ELSE 0 END) as Low"),
                DB::raw("SUM(CASE WHEN ur.level = 1 THEN 1 ELSE 0 END) as Very_Low")
            )
            ->groupBy('j.level') 
            ->orderBy('j.level', 'asc')
            ->get();

        $resultBFR = DB::table('users as u')
            ->join('jobs as j', 'u.position_id', '=', 'j.id')
            ->join('user_results as ur', 'u.id', '=', 'ur.user_id')
            ->where('u.department_id', $id)
            ->where('ur.result_type', 'soft_skill_score') 
            ->select(
                'j.level',
                DB::raw("SUM(CASE WHEN ur.level = 5 THEN 1 ELSE 0 END) as Very_High"),
                DB::raw("SUM(CASE WHEN ur.level = 4 THEN 1 ELSE 0 END) as High"),
                DB::raw("SUM(CASE WHEN ur.level = 3 THEN 1 ELSE 0 END) as Moderate"),
                DB::raw("SUM(CASE WHEN ur.level = 2 THEN 1 ELSE 0 END) as Low"),
                DB::raw("SUM(CASE WHEN ur.level = 1 THEN 1 ELSE 0 END) as Very_Low")
            )
            ->groupBy('j.level')
            ->orderBy('j.level', 'asc')
            ->get();

        $resultTSMR = DB::table('users as u')
            ->join('jobs as j', 'u.position_id', '=', 'j.id')
            ->join('user_results as ur', 'u.id', '=', 'ur.user_id')
            ->where('u.department_id', $id)
            ->whereColumn('ur.job_id', 'u.position_id')
            ->where('ur.result_type', 'technical_skill_match_rate') 
            ->select(
                'j.level',
                DB::raw("SUM(CASE WHEN ur.level = 5 THEN 1 ELSE 0 END) as Very_High"),
                DB::raw("SUM(CASE WHEN ur.level = 4 THEN 1 ELSE 0 END) as High"),
                DB::raw("SUM(CASE WHEN ur.level = 3 THEN 1 ELSE 0 END) as Moderate"),
                DB::raw("SUM(CASE WHEN ur.level = 2 THEN 1 ELSE 0 END) as Low"),
                DB::raw("SUM(CASE WHEN ur.level = 1 THEN 1 ELSE 0 END) as Very_Low")
            )
            ->groupBy('j.level')
            ->orderBy('j.level', 'asc')
            ->get();

        $resultJMR = DB::table('users as u')
            ->join('jobs as j', 'u.position_id', '=', 'j.id')
            ->join('user_results as ur', 'u.id', '=', 'ur.user_id')
            ->where('u.department_id', $id)
            ->where('ur.result_type', 'jmr') 
            ->select(
                'j.level',
                DB::raw("SUM(CASE WHEN ur.level = 5 THEN 1 ELSE 0 END) as Very_High"),
                DB::raw("SUM(CASE WHEN ur.level = 4 THEN 1 ELSE 0 END) as High"),
                DB::raw("SUM(CASE WHEN ur.level = 3 THEN 1 ELSE 0 END) as Moderate"),
                DB::raw("SUM(CASE WHEN ur.level = 2 THEN 1 ELSE 0 END) as Low"),
                DB::raw("SUM(CASE WHEN ur.level = 1 THEN 1 ELSE 0 END) as Very_Low")
            )
            ->groupBy('j.level') 
            ->orderBy('j.level', 'asc')
            ->get();

        $resultSSMR = DB::table('users as u')
            ->join('jobs as j', 'u.position_id', '=', 'j.id')
            ->join('user_results as ur', 'u.id', '=', 'ur.user_id')
            ->where('u.department_id', $id)
            ->where('ur.result_type', 'ccs_match_rate') 
            ->select(
                'j.level',
                DB::raw("SUM(CASE WHEN ur.level = 5 THEN 1 ELSE 0 END) as Very_High"),
                DB::raw("SUM(CASE WHEN ur.level = 4 THEN 1 ELSE 0 END) as High"),
                DB::raw("SUM(CASE WHEN ur.level = 3 THEN 1 ELSE 0 END) as Moderate"),
                DB::raw("SUM(CASE WHEN ur.level = 2 THEN 1 ELSE 0 END) as Low"),
                DB::raw("SUM(CASE WHEN ur.level = 1 THEN 1 ELSE 0 END) as Very_Low")
            )
            ->groupBy('j.level') 
            ->orderBy('j.level', 'asc')
            ->get();

        $resultLP = DB::table('users as u')
            ->join('jobs as j', 'u.position_id', '=', 'j.id')
            ->join('user_results as ur', 'u.id', '=', 'ur.user_id')
            ->where('u.department_id', $id)
            ->where('ur.result_type', 'leadership_potential') 
            ->select(
                'j.level',
                DB::raw("SUM(CASE WHEN ur.level = 5 THEN 1 ELSE 0 END) as Very_High"),
                DB::raw("SUM(CASE WHEN ur.level = 4 THEN 1 ELSE 0 END) as High"),
                DB::raw("SUM(CASE WHEN ur.level = 3 THEN 1 ELSE 0 END) as Moderate"),
                DB::raw("SUM(CASE WHEN ur.level = 2 THEN 1 ELSE 0 END) as Low"),
                DB::raw("SUM(CASE WHEN ur.level = 1 THEN 1 ELSE 0 END) as Very_Low")
            )
            ->groupBy('j.level') 
            ->orderBy('j.level', 'asc')
            ->get();

        $resultGP = DB::table('users as u')
            ->join('jobs as j', 'u.position_id', '=', 'j.id')
            ->join('user_results as ur', 'u.id', '=', 'ur.user_id')
            ->where('u.department_id', $id)
            ->where('ur.result_type', 'growth_potential') 
            ->select(
                'j.level',
                DB::raw("SUM(CASE WHEN ur.level = 5 THEN 1 ELSE 0 END) as Very_High"),
                DB::raw("SUM(CASE WHEN ur.level = 4 THEN 1 ELSE 0 END) as High"),
                DB::raw("SUM(CASE WHEN ur.level = 3 THEN 1 ELSE 0 END) as Moderate"),
                DB::raw("SUM(CASE WHEN ur.level = 2 THEN 1 ELSE 0 END) as Low"),
                DB::raw("SUM(CASE WHEN ur.level = 1 THEN 1 ELSE 0 END) as Very_Low")
            )
            ->groupBy('j.level') 
            ->orderBy('j.level', 'asc')
            ->get();

        $resultWAF = DB::table('users as u')
            ->join('jobs as j', 'u.position_id', '=', 'j.id')
            ->join('user_results as ur', 'u.id', '=', 'ur.user_id')
            ->where('u.department_id', $id)
            ->where('ur.result_type', 'organizational_fit_forecast') 
            ->select(
                'j.level',
                DB::raw("SUM(CASE WHEN ur.level = 5 THEN 1 ELSE 0 END) as Very_High"),
                DB::raw("SUM(CASE WHEN ur.level = 4 THEN 1 ELSE 0 END) as High"),
                DB::raw("SUM(CASE WHEN ur.level = 3 THEN 1 ELSE 0 END) as Moderate"),
                DB::raw("SUM(CASE WHEN ur.level = 2 THEN 1 ELSE 0 END) as Low"),
                DB::raw("SUM(CASE WHEN ur.level = 1 THEN 1 ELSE 0 END) as Very_Low")
            )
            ->groupBy('j.level') 
            ->orderBy('j.level', 'asc')
            ->get();

        $resultFR = DB::table('users as u')
            ->join('jobs as j', 'u.position_id', '=', 'j.id')
            ->join('user_results as ur', 'u.id', '=', 'ur.user_id')
            ->where('u.department_id', $id)
            ->where('ur.result_type', 'flight_risk') 
            ->select(
                'j.level',
                DB::raw("SUM(CASE WHEN ur.level = 5 THEN 1 ELSE 0 END) as Very_High"),
                DB::raw("SUM(CASE WHEN ur.level = 4 THEN 1 ELSE 0 END) as High"),
                DB::raw("SUM(CASE WHEN ur.level = 3 THEN 1 ELSE 0 END) as Moderate"),
                DB::raw("SUM(CASE WHEN ur.level = 2 THEN 1 ELSE 0 END) as Low"),
                DB::raw("SUM(CASE WHEN ur.level = 1 THEN 1 ELSE 0 END) as Very_Low")
            )
            ->groupBy('j.level') 
            ->orderBy('j.level', 'asc')
            ->get();

        $resultCA = DB::table('users as u')
            ->join('jobs as j', 'u.position_id', '=', 'j.id')
            ->join('user_results as ur', 'u.id', '=', 'ur.user_id')
            ->where('u.department_id', $id)
            ->where('ur.result_type', 'overall') // Ensure this filter isn't removing other levels
            ->where('ur.assessment_type', 'cognitive') // Ensure this filter isn't removing other levels
            ->select(
                'j.level',
                DB::raw("SUM(CASE WHEN ur.level = 3 THEN 1 ELSE 0 END) as High"),
                DB::raw("SUM(CASE WHEN ur.level = 2 THEN 1 ELSE 0 END) as Moderate"),
                DB::raw("SUM(CASE WHEN ur.level = 1 THEN 1 ELSE 0 END) as Low")
            )
            ->groupBy('j.level') // Ensure grouping includes both
            ->orderBy('j.level', 'asc')
            ->get();

        $resultCognitiveAbility = DB::table('users as u')
            ->join('jobs as j', 'u.position_id', '=', 'j.id')
            ->join('user_results as ur', 'u.id', '=', 'ur.user_id')
            ->where('u.department_id', $id)
            ->select(
                'j.level',
                DB::raw("SUM(CASE WHEN ur.slug = 'quantitative-knowledge' AND ur.level = 3 THEN 1 ELSE 0 END) as High_quantitative_knowledge"),
                DB::raw("SUM(CASE WHEN ur.slug = 'quantitative-knowledge' AND ur.level = 2 THEN 1 ELSE 0 END) as Moderate_quantitative_knowledge"),
                DB::raw("SUM(CASE WHEN ur.slug = 'quantitative-knowledge' AND ur.level = 1 THEN 1 ELSE 0 END) as Low_quantitative_knowledge"),
                DB::raw("SUM(CASE WHEN ur.slug = 'comprehension-knowledge' AND ur.level = 3 THEN 1 ELSE 0 END) as High_comprehension_knowledge"),
                DB::raw("SUM(CASE WHEN ur.slug = 'comprehension-knowledge' AND ur.level = 2 THEN 1 ELSE 0 END) as Moderate_comprehension_knowledge"),
                DB::raw("SUM(CASE WHEN ur.slug = 'comprehension-knowledge' AND ur.level = 1 THEN 1 ELSE 0 END) as Low_comprehension_knowledge"),
                DB::raw("SUM(CASE WHEN ur.slug = 'visual-reasoning' AND ur.level = 3 THEN 1 ELSE 0 END) as High_visual_reasoning"),
                DB::raw("SUM(CASE WHEN ur.slug = 'visual-reasoning' AND ur.level = 2 THEN 1 ELSE 0 END) as Moderate_visual_reasoning"),
                DB::raw("SUM(CASE WHEN ur.slug = 'visual-reasoning' AND ur.level = 1 THEN 1 ELSE 0 END) as Low_visual_reasoning"),
                DB::raw("SUM(CASE WHEN ur.slug = 'fluid-reasoning' AND ur.level = 3 THEN 1 ELSE 0 END) as High_fluid_reasoning"),
                DB::raw("SUM(CASE WHEN ur.slug = 'fluid-reasoning' AND ur.level = 2 THEN 1 ELSE 0 END) as Moderate_fluid_reasoning"),
                DB::raw("SUM(CASE WHEN ur.slug = 'fluid-reasoning' AND ur.level = 1 THEN 1 ELSE 0 END) as Low_fluid_reasoning")
            )
            ->groupBy('j.level')
            ->orderBy('j.level', 'asc')
            ->get();


        $chartPositionLevel = DB::table('users as u')
            ->join('user_results as ur', 'u.id', '=', 'ur.user_id')
            ->leftJoin('jobs as j', 'u.position_id', '=', 'j.id') // Add this join
            ->where('u.department_id', $id)
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->whereColumn('ur.job_id', 'u.position_id')->where('ur.result_type', 'overall_match_rate'); // omr_level
                })
                ->orWhere(function ($q) {
                    $q->whereColumn('ur.job_id', 'u.position_id')->where('ur.result_type', 'soft_skill_score'); // bfr_level
                })
                ->orWhere(function ($q) {
                    $q->whereColumn('ur.job_id', 'u.position_id')->where('ur.result_type', 'technical_skill_match_rate'); // tsmr_level
                })
                ->orWhere(function ($q) {
                    $q->whereColumn('ur.job_id', 'u.position_id')->where('ur.result_type', 'jmr'); // jmr_level
                })
                ->orWhere(function ($q) {
                    $q->where('ur.result_type', 'flight_risk'); // flight_risk_
                })
                ->orWhere(function ($q) {
                    $q->where('ur.result_type', 'organizational_fit_forecast'); // waf_forecast
                })
                ->orWhere(function ($q) {
                    $q->whereColumn('ur.job_id', 'u.position_id')->where('ur.result_type', 'overall')
                        ->where('ur.assessment_type', 'technical'); // ta_level
                })
                ->orWhere(function ($q) {
                    $q->where('ur.result_type', 'overall')
                        ->where('ur.assessment_type', 'cognitive'); // cat_level
                })
                ->orWhere(function ($q) {
                    $q->whereColumn('ur.job_id', 'u.position_id')->where('ur.result_type', 'ccs_match_rate')
                        ->where('ur.assessment_type', 'ocean'); 
                })
                ->orWhere(function ($q) {
                    $q->where('ur.result_type', 'growth_potential')
                        ->where('ur.assessment_type', 'ocean'); 
                });
            })
            ->select(
                'u.id',
                'u.name',
                DB::raw("MAX(CASE WHEN ur.result_type = 'overall_match_rate' THEN ur.level END) AS omr_level"),
                DB::raw("MAX(CASE WHEN ur.result_type = 'soft_skill_score' THEN ur.level END) AS bfr_level"),
                DB::raw("MAX(CASE WHEN ur.result_type = 'technical_skill_match_rate' THEN ur.level END) AS tsmr_level"),          
                DB::raw("MAX(CASE WHEN ur.result_type = 'jmr' THEN ur.level END) AS jmr_level"),
                DB::raw("MAX(CASE WHEN ur.result_type = 'flight_risk' THEN ur.level END) AS fr_level"),
                DB::raw("MAX(CASE WHEN ur.result_type = 'organizational_fit_forecast' THEN ur.level END) AS waf_level"),
                DB::raw("MAX(CASE WHEN ur.assessment_type = 'technical' AND ur.result_type = 'overall' THEN ur.level END) AS ta_level"),
                DB::raw("MAX(CASE WHEN ur.assessment_type = 'cognitive' AND ur.result_type = 'overall' THEN ur.level END) AS cat_level"), 
                DB::raw("MAX(CASE WHEN ur.assessment_type = 'ocean' AND ur.result_type = 'ccs_match_rate' THEN ur.level END) AS mr_level"),
                DB::raw("MAX(CASE WHEN ur.assessment_type = 'ocean' AND ur.result_type = 'leadership_potential' THEN ur.level END) AS lp_level"),
                DB::raw("MAX(CASE WHEN ur.assessment_type = 'ocean' AND ur.result_type = 'growth_potential' THEN ur.level END) AS gp_level"),
                DB::raw("MAX(j.level) AS jobs_level") 
            )
            ->groupBy('u.id', 'u.name')
        ->get();

        $groupedByJobLevel = $chartPositionLevel->groupBy('jobs_level');

        $chartPositionLevelGroup = [];

        $levelMappings = [
            'omr_level' => [
                0 => 'Technical Assessment Not Completed',
                1 => 'Very Low',
                2 => 'Low',
                3 => 'Moderate',
                4 => 'High',
                5 => 'Very High',
            ],
            'bfr_level' => [
                0 => 'Data Not Available',
                1 => 'Very Low',
                2 => 'Low',
                3 => 'Moderate',
                4 => 'High',
                5 => 'Very High'
            ],
            'tsmr_level' => [
                0 => 'Data Not Available',
                1 => 'Very Low',
                2 => 'Low',
                3 => 'Moderate',
                4 => 'High',
                5 => 'Very High'
            ],
            'jmr_level' => [
                0 => 'Data Not Available',
                1 => 'Very Low',
                2 => 'Low',
                3 => 'Moderate',
                4 => 'High',
                5 => 'Very High'
            ],
            'fr_level' => [
                0 => 'Data Not Available',
                1 => 'Very Low',
                2 => 'Low',
                3 => 'Moderate',
                4 => 'High',
                5 => 'Very High'
            ],
            'waf_level' => [
                0 => 'Data Not Available',
                1 => 'Very Low',
                2 => 'Low',
                3 => 'Moderate',
                4 => 'High',
                5 => 'Very High',
            ],
            'ta_level' => [
                0 => 'Technical Assessment Not Completed',
                1 => 'Very Low',
                2 => 'Low',
                3 => 'Moderate',
                4 => 'High',
                5 => 'Very High'
            ],
            'cat_level' => [
                0 => 'Data Not Available',
                1 => 'Low',
                2 => 'Moderate',
                3 => 'High'
            ],
            'mr_level' => [
                0 => 'Technical Assessment Not Completed',
                1 => 'Very Low',
                2 => 'Low',
                3 => 'Moderate',
                4 => 'High',
                5 => 'Very High'
            ],
            'lp_level' => [
                0 => 'N/A',
                1 => 'Very Low',
                2 => 'Low',
                3 => 'Moderate',
                4 => 'High',
                5 => 'Very High'
            ],
            'gp_level' => [
                0 => 'Technical Assessment Not Completed',
                1 => 'Very Low',
                2 => 'Low',
                3 => 'Moderate',
                4 => 'High',
                5 => 'Very High'
            ],
        ];

        foreach ($groupedByJobLevel as $jobLevel => $users) {
            $chartPositionLevelGroup[$jobLevel] = [
                'omr' => [
                    'Technical Assessment Not Completed' => 0,
                    'Very Low' => 0,
                    'Low' => 0,
                    'Moderate' => 0,
                    'High' => 0,
                    'Very High' => 0,
                ],
                'bfr' => [
                    'Data Not Available' => 0,
                    'Very Low' => 0,
                    'Low' => 0,
                    'Moderate' => 0,
                    'High' => 0,
                    'Very High' => 0
                ],
                'tsmr' => [
                    'Data Not Available' => 0,
                    'Very Low' => 0,
                    'Low' => 0,
                    'Moderate' => 0,
                    'High' => 0,
                    'Very High' => 0
                ],
                'jmr' => [
                    'Data Not Available' => 0,
                    'Very Low' => 0,
                    'Low' => 0,
                    'Moderate' => 0,
                    'High' => 0,
                    'Very High' => 0
                ],
                'fr' => [
                    'Data Not Available' => 0,
                    'Very Low' => 0,
                    'Low' => 0,
                    'Moderate' => 0,
                    'High' => 0,
                    'Very High' => 0
                ],
                'waf' => [
                    'Data Not Available' => 0,
                    'Very Low' => 0,
                    'Low' => 0,
                    'Moderate' => 0,
                    'High' => 0,
                    'Very High' => 0
                ],
                'ta' => [
                    'Technical Assessment Not Completed' => 0,
                    'Very Low' => 0,
                    'Low' => 0,
                    'Moderate' => 0,
                    'High' => 0,
                    'Very High' => 0
                ],
                'cat' => [
                    'Data Not Available' => 0,
                    'Low' => 0,
                    'Moderate' => 0,
                    'High' => 0,
                ],
                'mr' => [
                    'Technical Assessment Not Completed' => 0,
                    'Very Low' => 0,
                    'Low' => 0,
                    'Moderate' => 0,
                    'High' => 0,
                    'Very High' => 0
                ],
                'lp' => [
                    'Technical Assessment Not Completed' => 0,
                    'Very Low' => 0,
                    'Low' => 0,
                    'Moderate' => 0,
                    'High' => 0,
                    'Very High' => 0
                ],
                'gp' => [
                    'Technical Assessment Not Completed' => 0,
                    'Very Low' => 0,
                    'Low' => 0,
                    'Moderate' => 0,
                    'High' => 0,
                    'Very High' => 0
                ],
            ];

            // Count each user's levels
            foreach ($users as $user) {
                // OMR Level
                if (isset($user->omr_level) && isset($levelMappings['omr_level'][$user->omr_level])) {
                    $level = $levelMappings['omr_level'][$user->omr_level];
                    $chartPositionLevelGroup[$jobLevel]['omr'][$level]++;
                }

                // BFR Level
                if (isset($user->bfr_level) && isset($levelMappings['bfr_level'][$user->bfr_level])) {
                    $level = $levelMappings['bfr_level'][$user->bfr_level];
                    $chartPositionLevelGroup[$jobLevel]['bfr'][$level]++;
                }

                // TSMR Level
                if (isset($user->tsmr_level) && isset($levelMappings['tsmr_level'][$user->tsmr_level])) {
                    $level = $levelMappings['tsmr_level'][$user->tsmr_level];
                    $chartPositionLevelGroup[$jobLevel]['tsmr'][$level]++;
                }

                // JMR Level
                if (isset($user->jmr_level) && isset($levelMappings['jmr_level'][$user->jmr_level])) {
                    $level = $levelMappings['jmr_level'][$user->jmr_level];
                    $chartPositionLevelGroup[$jobLevel]['jmr'][$level]++;
                }

                // Flight Risk Level
                if (isset($user->fr_level) && isset($levelMappings['fr_level'][$user->fr_level])) {
                    $level = $levelMappings['fr_level'][$user->fr_level];
                    $chartPositionLevelGroup[$jobLevel]['fr'][$level]++;
                }

                // WAF Level
                if (isset($user->waf_level) && isset($levelMappings['waf_level'][$user->waf_level])) {
                    $level = $levelMappings['waf_level'][$user->waf_level];
                    $chartPositionLevelGroup[$jobLevel]['waf'][$level]++;
                }

                // TA Level
                if (isset($user->ta_level) && isset($levelMappings['ta_level'][$user->ta_level])) {
                    $level = $levelMappings['ta_level'][$user->ta_level];
                    $chartPositionLevelGroup[$jobLevel]['ta'][$level]++;
                }

                // CAT Level
                if (isset($user->cat_level) && isset($levelMappings['cat_level'][$user->cat_level])) {
                    $level = $levelMappings['cat_level'][$user->cat_level];
                    $chartPositionLevelGroup[$jobLevel]['cat'][$level]++;
                }

                // MR Level
                if (isset($user->mr_level) && isset($levelMappings['mr_level'][$user->mr_level])) {
                    $level = $levelMappings['mr_level'][$user->mr_level];
                    $chartPositionLevelGroup[$jobLevel]['mr'][$level]++;
                }

                // GP Level
                if (isset($user->lp_level) && isset($levelMappings['lp_level'][$user->lp_level])) {
                    $level = $levelMappings['lp_level'][$user->lp_level];
                    $chartPositionLevelGroup[$jobLevel]['lp'][$level]++;
                }

                // GP Level
                if (isset($user->gp_level) && isset($levelMappings['gp_level'][$user->gp_level])) {
                    $level = $levelMappings['gp_level'][$user->gp_level];
                    $chartPositionLevelGroup[$jobLevel]['gp'][$level]++;
                }

            }
        }

        $availableLevels = array_keys($chartPositionLevelGroup);
        sort($availableLevels);

        $perPage = $request->get('per_page', 10); // Default to 10

        $resultTAPsychometric = User::select([
                'users.id',
                'users.name',
                'users.is_personality_motivation_completed',
                'users.is_work_interest_completed',
                'users.is_cognitive_ability_completed',
                'users.profile_picture',
                'users.last_report_downloaded_at',
                'jobs.title as position_name',
                'jobs.level as position_level'
            ])
            // ->leftJoin('jobs', 'users.position_id', '=', 'jobs.id')
            ->join('jobs', 'users.position_id', '=', 'jobs.id')
            ->where('users.department_id', $id)
            ->where('users.role_name', 'employee')
            ->paginate($perPage);
        
            
         // Get unique position levels for filter dropdown
        $uniqueLevelsFilter = User::where('users.department_id', $id)
            ->join('jobs', 'users.position_id', '=', 'jobs.id')
            ->whereNotNull('jobs.level')
            ->pluck('jobs.level')
            ->unique()
            ->sort()
            ->values();
        
        $completedCount = User::where('users.department_id', $id)
            ->where('is_personality_motivation_completed', 1)
            ->where('is_work_interest_completed', 1)
            ->where('is_cognitive_ability_completed', 1)
            ->count();
    
        $incompleteCount = User::where('users.department_id', $id)
            ->where(function($query) {
                $query->where('is_personality_motivation_completed', 0)
                      ->orWhere('is_work_interest_completed', 0)
                      ->orWhere('is_cognitive_ability_completed', 0);
            })
            ->count();

        $newHiresCount = DB::table('users')
            ->join('job_opening_applications', 'users.id', '=', 'job_opening_applications.user_id')
            ->where('users.department_id', $id)
            ->where('job_opening_applications.status', 12)
            ->where('job_opening_applications.status_changed_date', '>=', now()->subDays(30))
            ->distinct('users.id')
        ->count();

        $previousMonthHires = DB::table('users')
            ->join('job_opening_applications', 'users.id', '=', 'job_opening_applications.user_id')
            ->where('users.department_id', $id)
            ->where('job_opening_applications.status', 12)
            ->whereBetween('job_opening_applications.status_changed_date', [
                now()->subDays(60), 
                now()->subDays(30)
            ])
            ->distinct('users.id')
            ->count();

        // Calculate percentage change
        $percentageChange = 0;
        if ($previousMonthHires > 0) {
            $percentageChange = (($newHiresCount - $previousMonthHires) / $previousMonthHires) * 100;
        } elseif ($newHiresCount > 0) {
            $percentageChange = 100;
        }

        $formattedPercentage = round($percentageChange, 1);

        $today = now()->format('Y-m-d');
        $sameDayLastMonth = now()->subDays(30)->format('Y-m-d');

        // $turnoverRate = DB::table('job_opening_applications')
        //     ->join('users', 'users.id', '=', 'job_opening_applications.user_id') // Join users table
        //     ->selectRaw('
        //         SUM(CASE WHEN job_opening_applications.status = 12 THEN 1 ELSE 0 END) AS hired_count,
        //         SUM(CASE WHEN job_opening_applications.status = 8 THEN 1 ELSE 0 END) AS offers_count,
        //         CASE 
        //             WHEN SUM(CASE WHEN job_opening_applications.status = 8 THEN 1 ELSE 0 END) > 0 
        //             THEN ROUND((SUM(CASE WHEN job_opening_applications.status = 12 THEN 1 ELSE 0 END) / 
        //                     SUM(CASE WHEN job_opening_applications.status = 8 THEN 1 ELSE 0 END)) * 100, 2)
        //             ELSE 0 
        //         END AS turnover_rate
        //     ')
        //     ->whereIn('job_opening_applications.status', [8, 12])
        //     ->where('users.department_id', 4) // Filter for department_id = 4
        //     ->whereBetween('job_opening_applications.status_changed_date', [$sameDayLastMonth, $today])
        //     ->first();

        $averagePercentage = DB::table('user_results')
            ->join('users', 'user_results.user_id', '=', 'users.id')
            ->selectRaw('ROUND(AVG(user_results.percentage), 0) AS average_percentage')
            ->first()
        ->average_percentage;
        
        return view('people_retention_department', compact(
            'positionsByLevelPsychometric',
            'levelsByPositionPsychometric',
            'positionsByLevel',
            'levelsByPosition',
            'percentageChange',
            'formattedPercentage',
            'averagePercentage',
            'newHiresCount',
            'completedCount',
            'incompleteCount',
            'uniqueLevelsFilter',
            'id',
            'availableLevels',
            'chartPositionLevelGroup',
            'positionLevelCounts',
            'uniqueLevels',
            'resultTAPsychometric',
            'positionCounts',
            'resultCognitiveAbility',
            'resultSSMR',
            'resultCA',
            'resultFR',
            'resultWAF',
            'resultGP',
            'resultJMR',
            'resultTSMR',
            'resultBFR',
            'resultTA',
            'resultOMR',
            'ageData',
            'notCompletedPercentage',
            'completedPercentage',
            'assessmentStatus',
            'cityCounts',
            'uniquePositions',
            'departmentSectionStatus',
            'departmentSectionNames',
            'roleNames',
            'dareToDreamCount',
            'haveEmpathyCount',
            'allForOneCount',
            'makeDifferenceCount',
            'beTransparentCount',
            'celebrateIndividualsCount',
            'safetyCount',
            'keepItSimpleCount',
            'leadershipPotentialCounts',
            'growthPotentialCounts',
            'matchRateCounts',
            'catLevelCounts',
            'workplaceAlignmentForecast',
            'flightRiskCounts',
            'taLevelCounts',
            'tsmrLevelCounts',
            'jmrLevelCounts',
            'omrLevelCounts',
            'bfrLevelCounts',
            'employeeData',
            'positionNames',
            'totalHeads',
            'totalNumberJobPosition',
            'departmentName',
            'location',
            'headOfDepartment',
            'totalEmployee',
            'jobVacancy',
            'activeJobAds',
            'genderData',
            'statusData',
            'assessmentCompletionStatusData',
            'positionLevelData',
            'highestPositionLevel',
            'department'
        ));
    }

    public function filterPsychometricData(Request $request, $id)
    {
        $perPage = $request->get('per_page', 10);
        $jobPosition = $request->get('job_position', '');
        $positionLevel = $request->get('position_level', '');
        $assessmentCompletion = $request->get('assessment_completion', '');
        $searchTerm = $request->get('search', ''); 

        $query = User::select([
                'users.id',
                'users.name',
                'users.is_personality_motivation_completed',
                'users.is_work_interest_completed',
                'users.is_cognitive_ability_completed',
                'users.is_technical_assessment_completed',
                'users.technical_assessment_completed',
                'users.profile_picture',
                'jobs.title as position_name',
                'jobs.level as position_level'
            ])
            // ->leftJoin('jobs', 'users.position_id', '=', 'jobs.id')
            ->join('jobs', 'users.position_id', '=', 'jobs.id')
            ->where('users.department_id', $id);

        if ($jobPosition) {
            $query->where('jobs.title', $jobPosition);
        }
        
        if ($positionLevel) {
            $levelValue = str_replace('Level ', '', $positionLevel);
            $query->where('jobs.level', $levelValue);
        }

        if ($assessmentCompletion === 'All Assessments Completed') {
            $query->where('is_personality_motivation_completed', 1)
                ->where('is_work_interest_completed', 1)
                ->where('is_cognitive_ability_completed', 1);
        } 
        elseif ($assessmentCompletion === 'Incomplete Assessments') {
            $query->where(function($q) {
                $q->where('is_personality_motivation_completed', 0)
                ->orWhere('is_work_interest_completed', 0)
                ->orWhere('is_cognitive_ability_completed', 0);
            });
        }

        // New search functionality
        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('users.name', 'like', '%'.$searchTerm.'%')
                ->orWhere('jobs.title', 'like', '%'.$searchTerm.'%');
            });
        }

        $resultTAPsychometric = $query->paginate($perPage);

        $tableHtml = view('components.people-retention-department.tab-psychometric.table-rows', [
            'resultTAPsychometric' => $resultTAPsychometric
        ])->render();
    
        $paginationHtml = $resultTAPsychometric->appends([
            'job_position' => $request->job_position,
            'position_level' => $request->position_level,
            'assessment_completion' => $request->assessment_completion,
            'search' => $request->search,
            'per_page' => $perPage,
            'tab' => $request->tab
        ])->links()->toHtml();
    
        return response()->json([
            'tableHtml' => $tableHtml,
            'paginationHtml' => $paginationHtml
        ]);
    }

    function searchEmployee(Request $request) {
        $searchTerm = $request->input('searchEmployee', '');
        
        $employeeData = User::where('users.name', 'like', "%$searchTerm%")
            ->join('jobs', 'users.position_id', '=', 'jobs.id')
            ->select(
                'users.name',
                'users.email',
                'users.role_name',
                'users.profile_picture',
                'jobs.name as position_name',
                'jobs.level'
            )
            ->get();
    
        return view('people_retention_department', compact('employeeData'));
    }

    public function updateStatus(Request $request)
    {
        $departmentId = $request->input('department_id');
        $newStatus = $request->input('status');

        $department = Department::where('id', $departmentId)->first();

        if ($department) {
            switch ($newStatus) {
                case 'Active':
                    $department->status = 1;
                    $department->save();
                    break;
                case 'Inactive':
                    $department->status = 0;
                    $department->save();
                    break;
                default:
                    return response()->json(['success' => false]);
            }
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
    
    public function generatePdf(Request $request)
    {
        // Retrieve all SVG data dynamically
        $chartSvgs = $request->all();
        $data = [];

        foreach ($chartSvgs as $key => $svgContent) {
            if ($svgContent) {
                $data[$key] = $svgContent; // Store only non-empty SVGs
            }
        }

        // Create a new mPDF instance
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L', // Landscape orientation
            'default_font' => 'sans-serif',
        ]);

        // Load the PDF view and pass data
        $html = view('psychometric-pdf', compact('data'))->render();

        // Write HTML content to the PDF
        $mpdf->WriteHTML($html);

        // Output the PDF as a downloadable file
        return response($mpdf->Output('multi-chart-pdf.pdf', 'S'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="multi-chart-pdf.pdf"',
        ]);
    }

    public function downloadPdf(Request $request, $id)
    {
        $department = Department::find($id);

        if (!$department) {
            return redirect()->back()->with('error', 'Department not found.');
        }

        $departmentName = $department ? $department->name : 'N/A';
        $totalEmployee = User::where('department_id', $id)->count();

        $employmentStatuses = config('constants.EMPLOYMENT_STATUS');

        $employmentStatusCounts = User::where('department_id', $id)
            ->select('employment_status', DB::raw('count(*) as count'))
            ->groupBy('employment_status')
            ->get()
            ->pluck('count', 'employment_status')
            ->toArray();

        $statusData = array_fill_keys(array_values($employmentStatuses), 0);
        foreach ($employmentStatusCounts as $statusId => $count) {
            if (isset($employmentStatuses[$statusId])) {
                $statusData[$employmentStatuses[$statusId]] = $count;
            }
        }

        $assessmentCompletion = User::where('department_id', $id)->get();

        $completeAssessment = 0; 
        $notCompleteAssessment = 0; 

        foreach ($assessmentCompletion as $user) {
            if (
                $user->is_personality_motivation_completed === 1 &&
                $user->is_work_interest_completed === 1 &&
                $user->is_cognitive_ability_completed === 1 &&
                $user->technical_assessment_completed === 1
            ) {
                $completeAssessment++;
            } else {
                $notCompleteAssessment++; 
            }
        }

        $totalEmployees = $completeAssessment + $notCompleteAssessment; // 122
    
        $completePercentage = round(($completeAssessment / $totalEmployees) * 100);

        $notCompletePercentage = round(($notCompleteAssessment / $totalEmployees) * 100);

        $assessmentCompletionStatusData = [
            'Fully Completed' => $completeAssessment,
            'Fully Percentage' => $completePercentage,
            'Not Fully Completed' => $notCompleteAssessment,
            'Not Fully Percentage' => $notCompletePercentage
        ];

        $maleCount = User::where('department_id', $id)
                ->where('gender', 0)
                ->count();
                
        $femaleCount = User::where('department_id', $id)
                ->where('gender', 1)
                ->count();

        $total = $maleCount + $femaleCount;

        $malePercentage = $total > 0 ? round(($maleCount / $total) * 100) : 0;
        $femalePercentage = $total > 0 ? round(($femaleCount / $total) * 100) : 0;

        $genderData = [
            'Male' => [
                        'count' => $maleCount,
                        'percentage' => $malePercentage
                    ],
            'Female' => [
            'count' => $femaleCount,
            'percentage' => $femalePercentage
            ]
        ];

        $ageGroups = [
            '20-30' => [20, 30],
            '31-40' => [31, 40],
            '41-50' => [41, 50],
            '50+' => [51, 100],
        ];
        
        $ageData = []; 
        
        foreach ($ageGroups as $label => [$minAge, $maxAge]) {
            $ageData[$label] = User::where('department_id', $id)
                ->whereBetween('age', [$minAge, $maxAge])
                ->count();
        }

        $employeeData = User::join('jobs', 'users.position_id', '=', 'jobs.id')
            ->leftJoin('user_results as ur', function ($join) {
                $join->on('users.id', '=', 'ur.user_id')
                        ->where('ur.result_type', 'soft_skill_score'); 
            })
            ->where('users.department_id', $id)
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'users.role_name',
                'users.profile_picture',
                'users.is_high_potential',
                'users.age',
                'users.gender',
                'jobs.title as position_name',
                'jobs.level',
                 DB::raw("MAX(CASE WHEN ur.result_type = 'soft_skill_score' THEN ur.level END) AS bfr_level"),
            )
            ->orderByDesc('jobs.level')
            ->get();

        $levelCounts = $employeeData->groupBy('level')
            ->map(function ($group) {
                return count($group);
            })
        ->sortKeys();

        $positionLevelData = $levelCounts->map(function ($count, $level) {
            return [
                'level' => $level,
                'user_count' => $count
            ];
        })->values()->toArray();

        $levels = explode(',', request()->query('levels', ''));

        $chartPositionLevel = DB::table('users as u')
            ->join('user_results as ur', 'u.id', '=', 'ur.user_id')
            ->leftJoin('jobs as j', 'u.position_id', '=', 'j.id') // Add this join
            ->where('u.department_id', $id)
            ->where(function ($query) {
                $query->where(function ($q) {
                    $q->where('ur.result_type', 'overall_match_rate'); // omr_level
                })
                ->orWhere(function ($q) {
                    $q->where('ur.result_type', 'soft_skill_score'); // bfr_level
                })
                ->orWhere(function ($q) {
                    $q->whereColumn('ur.job_id', 'u.position_id')->where('ur.result_type', 'technical_skill_match_rate'); // tsmr_level
                })
                ->orWhere(function ($q) {
                    $q->where('ur.result_type', 'jmr'); // jmr_level
                })
                ->orWhere(function ($q) {
                    $q->where('ur.result_type', 'flight_risk'); // flight_risk_
                })
                ->orWhere(function ($q) {
                    $q->where('ur.result_type', 'organizational_fit_forecast'); // waf_forecast
                })
                ->orWhere(function ($q) {
                    $q->where('ur.result_type', 'overall')
                        ->where('ur.assessment_type', 'technical'); // ta_level
                })
                ->orWhere(function ($q) {
                    $q->where('ur.result_type', 'overall')
                        ->where('ur.assessment_type', 'cognitive'); // cat_level
                })
                ->orWhere(function ($q) {
                    $q->where('ur.result_type', 'ccs_match_rate')
                        ->where('ur.assessment_type', 'ocean'); 
                })
                ->orWhere(function ($q) {
                    $q->where('ur.result_type', 'growth_potential')
                        ->where('ur.assessment_type', 'ocean'); 
                });
            })
            ->select(
                'u.id',
                'u.name',
                DB::raw("MAX(CASE WHEN ur.result_type = 'overall_match_rate' THEN ur.level END) AS omr_level"),
                DB::raw("MAX(CASE WHEN ur.result_type = 'soft_skill_score' THEN ur.level END) AS bfr_level"),   
                DB::raw("MAX(CASE WHEN ur.result_type = 'technical_skill_match_rate' THEN ur.level END) AS tsmr_level"),         
                DB::raw("MAX(CASE WHEN ur.result_type = 'jmr' THEN ur.level END) AS jmr_level"),
                DB::raw("MAX(CASE WHEN ur.result_type = 'flight_risk' THEN ur.level END) AS fr_level"),
                DB::raw("MAX(CASE WHEN ur.result_type = 'organizational_fit_forecast' THEN ur.level END) AS waf_level"),
                DB::raw("MAX(CASE WHEN ur.assessment_type = 'technical' AND ur.result_type = 'overall' THEN ur.level END) AS ta_level"),
                DB::raw("MAX(CASE WHEN ur.assessment_type = 'cognitive' AND ur.result_type = 'overall' THEN ur.level END) AS cat_level"),
                DB::raw("MAX(CASE WHEN ur.assessment_type = 'ocean' AND ur.result_type = 'ccs_match_rate' THEN ur.level END) AS mr_level"),
                DB::raw("MAX(CASE WHEN ur.assessment_type = 'ocean' AND ur.result_type = 'leadership_potential' THEN ur.level END) AS lp_level"),
                DB::raw("MAX(CASE WHEN ur.assessment_type = 'ocean' AND ur.result_type = 'growth_potential' THEN ur.level END) AS gp_level"),
                DB::raw("MAX(j.level) AS jobs_level") // Add this line for jobs_level
            )
            ->groupBy('u.id', 'u.name')
        ->get();

        $groupedByJobLevel = $chartPositionLevel->groupBy('jobs_level');

        $chartPositionLevelGroup = [];

        $levelMappings = [
            'omr_level' => [
                0 => 'Technical Assessment Not Completed',
                1 => 'Very Low',
                2 => 'Low',
                3 => 'Moderate',
                4 => 'High',
                5 => 'Very High',
            ],
            'bfr_level' => [
                0 => 'Data Not Available',
                1 => 'Very Low',
                2 => 'Low',
                3 => 'Moderate',
                4 => 'High',
                5 => 'Very High'
            ],
            'tsmr_level' => [
                0 => 'Data Not Available',
                1 => 'Very Low',
                2 => 'Low',
                3 => 'Moderate',
                4 => 'High',
                5 => 'Very High'
            ],
            'jmr_level' => [
                0 => 'Data Not Available',
                1 => 'Very Low',
                2 => 'Low',
                3 => 'Moderate',
                4 => 'High',
                5 => 'Very High'
            ],
            'mr_level' => [
                0 => 'Technical Assessment Not Completed',
                1 => 'Very Low',
                2 => 'Low',
                3 => 'Moderate',
                4 => 'High',
                5 => 'Very High'
            ],
            'lp_level' => [
                0 => 'N/A',
                1 => 'Very Low',
                2 => 'Low',
                3 => 'Moderate',
                4 => 'High',
                5 => 'Very High'
            ],
            'gp_level' => [
                0 => 'Technical Assessment Not Completed',
                1 => 'Very Low',
                2 => 'Low',
                3 => 'Moderate',
                4 => 'High',
                5 => 'Very High'
            ],
            'fr_level' => [
                0 => 'Data Not Available',
                1 => 'Very Low Risk',
                2 => 'Low Risk',
                3 => 'Moderate Risk',
                4 => 'High Risk',
                5 => 'Very High Risk'
            ],
            'waf_level' => [
                0 => 'Data Not Available',
                1 => 'Very Low Risk',
                2 => 'Low Risk',
                3 => 'Moderate Risk',
                4 => 'High Risk',
                5 => 'Very High Risk',
            ],
            'ta_level' => [
                0 => 'Technical Assessment Not Completed',
                1 => 'Very Low',
                2 => 'Low',
                3 => 'Moderate',
                4 => 'High',
                5 => 'Very High'
            ],
            'cat_level' => [
                0 => 'Data Not Available',
                1 => 'Low',
                2 => 'Moderate',
                3 => 'High'
            ],
        ];

        foreach ($groupedByJobLevel as $jobLevel => $users) {
            // Initialize counts for this job level
            $chartPositionLevelGroup[$jobLevel] = [
                'omr' => [
                    'Technical Assessment Not Completed' => 0,
                    'Very Low' => 0,
                    'Low' => 0,
                    'Moderate' => 0,
                    'High' => 0,
                    'Very High' => 0,
                ],
                'bfr' => [
                    'Data Not Available' => 0,
                    'Very Low' => 0,
                    'Low' => 0,
                    'Moderate' => 0,
                    'High' => 0,
                    'Very High' => 0
                ],
                'tsmr' => [
                    'Data Not Available' => 0,
                    'Very Low' => 0,
                    'Low' => 0,
                    'Moderate' => 0,
                    'High' => 0,
                    'Very High' => 0
                ],
                'jmr' => [
                    'Data Not Available' => 0,
                    'Very Low' => 0,
                    'Low' => 0,
                    'Moderate' => 0,
                    'High' => 0,
                    'Very High' => 0
                ],
                'mr' => [
                    'Technical Assessment Not Completed' => 0,
                    'Very Low' => 0,
                    'Low' => 0,
                    'Moderate' => 0,
                    'High' => 0,
                    'Very High' => 0
                ],
                'gp' => [
                    'Technical Assessment Not Completed' => 0,
                    'Very Low' => 0,
                    'Low' => 0,
                    'Moderate' => 0,
                    'High' => 0,
                    'Very High' => 0
                ],
                'fr' => [
                    'Data Not Available' => 0,
                    'Very Low Risk' => 0,
                    'Low Risk' => 0,
                    'Moderate Risk' => 0,
                    'High Risk' => 0,
                    'Very High Risk' => 0
                ],
                'waf' => [
                    'Data Not Available' => 0,
                    'Very Low Risk' => 0,
                    'Low Risk' => 0,
                    'Moderate Risk' => 0,
                    'High Risk' => 0,
                    'Very High Risk' => 0
                ],
                'ta' => [
                    'Technical Assessment Not Completed' => 0,
                    'Very Low' => 0,
                    'Low' => 0,
                    'Moderate' => 0,
                    'High' => 0,
                    'Very High' => 0
                ],
                'cat' => [
                    'Data Not Available' => 0,
                    'Low' => 0,
                    'Moderate' => 0,
                    'High' => 0,
                ],
            ];

            // Count each user's levels
            foreach ($users as $user) {
                // OMR Level
                if (isset($user->omr_level) && isset($levelMappings['omr_level'][$user->omr_level])) {
                    $level = $levelMappings['omr_level'][$user->omr_level];
                    $chartPositionLevelGroup[$jobLevel]['omr'][$level]++;
                }

                // BFR Level
                if (isset($user->bfr_level) && isset($levelMappings['bfr_level'][$user->bfr_level])) {
                    $level = $levelMappings['bfr_level'][$user->bfr_level];
                    $chartPositionLevelGroup[$jobLevel]['bfr'][$level]++;
                }

                // TSMR Level
                if (isset($user->tsmr_level) && isset($levelMappings['tsmr_level'][$user->tsmr_level])) {
                    $level = $levelMappings['tsmr_level'][$user->tsmr_level];
                    $chartPositionLevelGroup[$jobLevel]['tsmr'][$level]++;
                }

                // JMR Level
                if (isset($user->jmr_level) && isset($levelMappings['jmr_level'][$user->jmr_level])) {
                    $level = $levelMappings['jmr_level'][$user->jmr_level];
                    $chartPositionLevelGroup[$jobLevel]['jmr'][$level]++;
                }

                // MR Level
                if (isset($user->mr_level) && isset($levelMappings['mr_level'][$user->mr_level])) {
                    $level = $levelMappings['mr_level'][$user->mr_level];
                    $chartPositionLevelGroup[$jobLevel]['mr'][$level]++;
                }

                // GP Level
                if (isset($user->lp_level) && isset($levelMappings['lp_level'][$user->lp_level])) {
                    $level = $levelMappings['lp_level'][$user->lp_level];
                    $chartPositionLevelGroup[$jobLevel]['lp'][$level]++;
                }

                // GP Level
                if (isset($user->gp_level) && isset($levelMappings['gp_level'][$user->gp_level])) {
                    $level = $levelMappings['gp_level'][$user->gp_level];
                    $chartPositionLevelGroup[$jobLevel]['gp'][$level]++;
                }

                // Flight Risk Level
                if (isset($user->fr_level) && isset($levelMappings['fr_level'][$user->fr_level])) {
                    $level = $levelMappings['fr_level'][$user->fr_level];
                    $chartPositionLevelGroup[$jobLevel]['fr'][$level]++;
                }

                // WAF Level
                if (isset($user->waf_level) && isset($levelMappings['waf_level'][$user->waf_level])) {
                    $level = $levelMappings['waf_level'][$user->waf_level];
                    $chartPositionLevelGroup[$jobLevel]['waf'][$level]++;
                }

                // TA Level
                if (isset($user->ta_level) && isset($levelMappings['ta_level'][$user->ta_level])) {
                    $level = $levelMappings['ta_level'][$user->ta_level];
                    $chartPositionLevelGroup[$jobLevel]['ta'][$level]++;
                }

                // CAT Level
                if (isset($user->cat_level) && isset($levelMappings['cat_level'][$user->cat_level])) {
                    $level = $levelMappings['cat_level'][$user->cat_level];
                    $chartPositionLevelGroup[$jobLevel]['cat'][$level]++;
                }
            }
        }

        $omrLevelCounts = [
            'VeryHigh' => 0,
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
            'VeryLow' => 0,
        ];
        
        $bfrLevelCounts = [
            'VeryHigh' => 0,
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
            'VeryLow' => 0,
        ];

        $taLevelCounts = [
           'VeryHigh' => 0,
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
            'VeryLow' => 0,
        ];
        
        $tsmrLevelCounts = [
            'VeryHigh' => 0,
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
            'VeryLow' => 0,
        ];

        $jmrLevelCounts = [
            'VeryHigh' => 0,
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
            'VeryLow' => 0,
        ];

        $flightRiskCounts = [
            'VeryHigh' => 0,
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
            'VeryLow' => 0,
        ];

        $workplaceAlignmentForecast = [
            'VeryHigh' => 0,
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
            'VeryLow' => 0,
        ];

        $catLevelCounts = [
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
        ];

        $matchRateCounts = [
            'VeryHigh' => 0,
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
            'VeryLow' => 0,
        ];

        $leadershipPotentialCounts = [
            'VeryHigh' => 0,
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
            'VeryLow' => 0,
        ];

        $growthPotentialCounts = [
            'VeryHigh' => 0,
            'High' => 0,
            'Moderate' => 0,
            'Low' => 0,
            'VeryLow' => 0,
        ];

        foreach ($chartPositionLevel as $data) {
            if($data->omr_level == 5){
                $omrLevelCounts['VeryHigh']++;
            } elseif ($data->omr_level == 4) {
                $omrLevelCounts['High']++;
            } elseif ($data->omr_level == 3) {
                $omrLevelCounts['Moderate']++;
            } elseif ($data->omr_level == 2) {
                $omrLevelCounts['Low']++;
            }elseif ($data->omr_level == 1) {
                $omrLevelCounts['VeryLow']++;
            }

            if($data->bfr_level == 5){
                $bfrLevelCounts['VeryHigh']++;
            } elseif ($data->bfr_level == 4) {
                $bfrLevelCounts['High']++;
            } elseif ($data->bfr_level == 3) {
                $bfrLevelCounts['Moderate']++;
            } elseif ($data->bfr_level == 2) {
                $bfrLevelCounts['Low']++;
            }elseif ($data->bfr_level == 1) {
                $bfrLevelCounts['VeryLow']++;
            }

            if($data->ta_level == 5){
                $taLevelCounts['VeryHigh']++;
            } elseif ($data->ta_level == 4) {
                $taLevelCounts['High']++;
            } elseif ($data->ta_level == 3) {
                $taLevelCounts['Moderate']++;
            } elseif ($data->ta_level == 2) {
                $taLevelCounts['Low']++;
            }elseif ($data->ta_level == 1) {
                $taLevelCounts['VeryLow']++;
            }

            if($data->tsmr_level == 5){
                $tsmrLevelCounts['VeryHigh']++;
            } elseif ($data->tsmr_level == 4) {
                $tsmrLevelCounts['High']++;
            } elseif ($data->tsmr_level == 3) {
                $tsmrLevelCounts['Moderate']++;
            } elseif ($data->tsmr_level == 2) {
                $tsmrLevelCounts['Low']++;
            }elseif ($data->tsmr_level == 1) {
                $tsmrLevelCounts['VeryLow']++;
            }

            if($data->jmr_level == 5){
                $jmrLevelCounts['VeryHigh']++;
            } elseif ($data->jmr_level == 4) {
                $jmrLevelCounts['High']++;
            } elseif ($data->jmr_level == 3) {
                $jmrLevelCounts['Moderate']++;
            } elseif ($data->jmr_level == 2) {
                $jmrLevelCounts['Low']++;
            }elseif ($data->jmr_level == 1) {
                $jmrLevelCounts['VeryLow']++;
            }

            if($data->fr_level == 5){
                $flightRiskCounts['VeryHigh']++;
            } elseif ($data->fr_level == 4) {
                $flightRiskCounts['High']++;
            } elseif ($data->fr_level == 3) {
                $flightRiskCounts['Moderate']++;
            } elseif ($data->fr_level == 2) {
                $flightRiskCounts['Low']++;
            }elseif ($data->fr_level == 1) {
                $flightRiskCounts['VeryLow']++;
            }

            if($data->waf_level == 5){
                $workplaceAlignmentForecast['VeryHigh']++;
            } elseif ($data->waf_level == 4) {
                $workplaceAlignmentForecast['High']++;
            } elseif ($data->waf_level == 3) {
                $workplaceAlignmentForecast['Moderate']++;
            } elseif ($data->waf_level == 2) {
                $workplaceAlignmentForecast['Low']++;
            }elseif ($data->waf_level == 1) {
                $workplaceAlignmentForecast['VeryLow']++;
            }

            if($data->cat_level == 3) {
                $catLevelCounts['High']++;
            } elseif ($data->cat_level == 2) {
                $catLevelCounts['Moderate']++;
            } elseif ($data->cat_level == 1) {
                $catLevelCounts['Low']++;
            }

            if($data->mr_level == 5){
                $matchRateCounts['VeryHigh']++;
            } elseif ($data->mr_level == 4) {
                $matchRateCounts['High']++;
            } elseif ($data->mr_level == 3) {
                $matchRateCounts['Moderate']++;
            } elseif ($data->mr_level == 2) {
                $matchRateCounts['Low']++;
            }elseif ($data->mr_level == 1) {
                $matchRateCounts['VeryLow']++;
            }

            if($data->lp_level == 5){
                $leadershipPotentialCounts['VeryHigh']++;
            } elseif ($data->lp_level == 4) {
                $leadershipPotentialCounts['High']++;
            } elseif ($data->lp_level == 3) {
                $leadershipPotentialCounts['Moderate']++;
            } elseif ($data->lp_level == 2) {
                $leadershipPotentialCounts['Low']++;
            }elseif ($data->lp_level == 1) {
                $leadershipPotentialCounts['VeryLow']++;
            }

            if($data->gp_level == 5){
                $growthPotentialCounts['VeryHigh']++;
            } elseif ($data->gp_level == 4) {
                $growthPotentialCounts['High']++;
            } elseif ($data->gp_level == 3) {
                $growthPotentialCounts['Moderate']++;
            } elseif ($data->gp_level == 2) {
                $growthPotentialCounts['Low']++;
            }elseif ($data->gp_level == 1) {
                $growthPotentialCounts['VeryLow']++;
            }
        }

        $resultCognitiveAbility = DB::table('users as u')
            ->join('jobs as j', 'u.position_id', '=', 'j.id')
            ->join('user_results as ur', 'u.id', '=', 'ur.user_id')
            ->where('u.department_id', $id)
            ->select(
                'j.level',
                DB::raw("SUM(CASE WHEN ur.slug = 'quantitative-knowledge' AND ur.level = 3 THEN 1 ELSE 0 END) as High_quantitative_knowledge"),
                DB::raw("SUM(CASE WHEN ur.slug = 'quantitative-knowledge' AND ur.level = 2 THEN 1 ELSE 0 END) as Moderate_quantitative_knowledge"),
                DB::raw("SUM(CASE WHEN ur.slug = 'quantitative-knowledge' AND ur.level = 1 THEN 1 ELSE 0 END) as Low_quantitative_knowledge"),
                DB::raw("SUM(CASE WHEN ur.slug = 'comprehension-knowledge' AND ur.level = 3 THEN 1 ELSE 0 END) as High_comprehension_knowledge"),
                DB::raw("SUM(CASE WHEN ur.slug = 'comprehension-knowledge' AND ur.level = 2 THEN 1 ELSE 0 END) as Moderate_comprehension_knowledge"),
                DB::raw("SUM(CASE WHEN ur.slug = 'comprehension-knowledge' AND ur.level = 1 THEN 1 ELSE 0 END) as Low_comprehension_knowledge"),
                DB::raw("SUM(CASE WHEN ur.slug = 'visual-reasoning' AND ur.level = 3 THEN 1 ELSE 0 END) as High_visual_reasoning"),
                DB::raw("SUM(CASE WHEN ur.slug = 'visual-reasoning' AND ur.level = 2 THEN 1 ELSE 0 END) as Moderate_visual_reasoning"),
                DB::raw("SUM(CASE WHEN ur.slug = 'visual-reasoning' AND ur.level = 1 THEN 1 ELSE 0 END) as Low_visual_reasoning"),
                DB::raw("SUM(CASE WHEN ur.slug = 'fluid-reasoning' AND ur.level = 3 THEN 1 ELSE 0 END) as High_fluid_reasoning"),
                DB::raw("SUM(CASE WHEN ur.slug = 'fluid-reasoning' AND ur.level = 2 THEN 1 ELSE 0 END) as Moderate_fluid_reasoning"),
                DB::raw("SUM(CASE WHEN ur.slug = 'fluid-reasoning' AND ur.level = 1 THEN 1 ELSE 0 END) as Low_fluid_reasoning")
            )
            ->groupBy('j.level')
            ->orderBy('j.level', 'asc')
            ->get();
        
        $data = [
            'title' => $departmentName,
            'date' => now()->format('d F Y') ,
            'numEmployee' => $totalEmployee,
            'assessmentCompletionStatus' => $assessmentCompletionStatusData,
            'genderData' => $genderData,
            'positionLevelData' =>  $positionLevelData,
            'ageData' => $ageData,
            'omrLevelCounts' => $omrLevelCounts,
            'taLevelCounts' => $taLevelCounts,
            'bfrLevelCounts' => $bfrLevelCounts,
            'tsmrLevelCounts' => $tsmrLevelCounts,
            'jmrLevelCounts' => $jmrLevelCounts,
            'matchRateCounts' => $matchRateCounts,
            'growthPotentialCounts' => $growthPotentialCounts,
            'workplaceAlignmentForecast' => $workplaceAlignmentForecast,
            'flightRiskCounts' => $flightRiskCounts,
            'catLevelCounts' => $catLevelCounts,
            'selectedLevels' => $levels,
            'chartPositionLevelGroup' => $chartPositionLevelGroup,
            'resultCognitiveAbility' => $resultCognitiveAbility
        ];
                
        return view('components.pdf-aggregated-report.download-pdf', $data);
    }
    
}
