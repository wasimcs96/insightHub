<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterCity;
use App\Models\MasterEducationLevel;
use App\Models\MasterEducationYear;
use App\Models\MasterEducationProgram;
use App\Models\MasterIndustry;
use App\Models\JobSkill;
use App\Models\TechnicalSkill;
use App\Models\JobOpening;
use App\Models\JobOpeningApplication;
use App\Models\JobOpeningCity;
use App\Models\JobOpeningJobSkill;
use App\Models\JobOpeningJobTechnicalSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Helpers\HelperFunctions;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendAssessmentEmailsJob;
use App\Helpers\AssessmentHelper;
use App\Models\Position;
use App\Models\Department;
use Illuminate\Support\Str;
use DB;

class TalentManagementController extends Controller
{
    // Display a listing of the job openings.
    public function index(Request $request)
    {
        $departments = Department::where('company_id', auth()->user()->id)->get();
    
        $averagePercentage = User::where('company_id', auth()->user()->id)
            ->where('is_personality_motivation_completed', '=', 1)
            ->where('is_work_interest_completed', '=', 1)
            ->where('is_cognitive_ability_completed', '=', 1)
            ->avg('gp_percentage');
    
        $query = User::where('company_id', auth()->user()->id)
            ->where('is_personality_motivation_completed', '=', 1)
            ->where('is_work_interest_completed', '=', 1)
            ->where('is_cognitive_ability_completed', '=', 1);
    
        $queryForAll = User::where('company_id', auth()->user()->id)
            ->where('is_personality_motivation_completed', '=', 1)
            ->where('is_work_interest_completed', '=', 1)
            ->where('is_cognitive_ability_completed', '=', 1);
    
        if ($request->filled('age')) {
            $ageRange = explode('_', $request->input('age'));
            if (count($ageRange) == 2) {
                $query->whereBetween('age', $ageRange);
                $queryForAll->whereBetween('age', $ageRange);
            }
        }
    
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
            $queryForAll->where('gender', $request->input('gender'));
        }
    
        if ($request->filled('education_level')) {
            $query->where('education_level', $request->input('education_level'));
            $queryForAll->where('education_level', $request->input('education_level'));
        }
    
        if ($request->filled('work_experience')) {
            $workExperienceRange = explode('_', $request->input('work_experience'));
            if (count($workExperienceRange) == 2) {
                $query->whereBetween('year_of_experience_in_it_sector', $workExperienceRange);
                $queryForAll->whereBetween('year_of_experience_in_it_sector', $workExperienceRange);
            }
        }
    
        if ($request->filled('potential')) {
            if ($request->potential == 1) {
                $query->where('gp_percentage', '>', $averagePercentage);
                $queryForAll->where('gp_percentage', '>', $averagePercentage);
            } else {
                $query->where('gp_percentage', '<', $averagePercentage);
                $queryForAll->where('gp_percentage', '<', $averagePercentage);
            }
        }
    
        if ($request->filled('level')) {
            $positions = Position::where('level', $request->level)->pluck('id')->toArray();
            $query->whereIn('position_id', $positions);
            $queryForAll->whereIn('position_id', $positions);
        }
    
        if ($request->filled('department')) {
            $query->where('department_id', $request->department);
            $queryForAll->where('department_id', $request->department);
        }
    
        $growthStats = DB::table('users')->where('company_id', auth()->user()->id)
        ->where('is_personality_motivation_completed', '=', 1)
        ->where('is_work_interest_completed', '=', 1)
        ->where('is_cognitive_ability_completed', '=', 1)->whereNotNull('gp_percentage')->select(DB::raw('SUM(gp_percentage) as total_growth, COUNT(*) as count'))->first();
        $cognitiveStats = DB::table('users')->where('company_id', auth()->user()->id)
        ->where('is_personality_motivation_completed', '=', 1)
        ->where('is_work_interest_completed', '=', 1)
        ->where('is_cognitive_ability_completed', '=', 1)->whereNotNull('gp_percentage')->select(DB::raw('SUM(cognitive_test_percentage) as total_cognitive, COUNT(*) as count'))->first();
        $avgGrowthPotential = $growthStats->total_growth / $growthStats->count;
        $avgCognitiveAssessment = $cognitiveStats->total_cognitive / $cognitiveStats->count;
        $growth_weight = 0.7;
        $cognitive_weight = 0.3;
        $combined_mean = $this->calculateCombinedScore($avgGrowthPotential, $avgCognitiveAssessment, $growth_weight, $cognitive_weight);
        $variance = DB::select(DB::raw('
            SELECT SUM(POW(((gp_percentage * :growth_weight + cognitive_test_percentage * :cognitive_weight) / :total_weight) - :combined_mean, 2)) / COUNT(*) as variance
            FROM users
            WHERE company_id = :company_id
            AND is_personality_motivation_completed = 1
            AND is_work_interest_completed = 1
            AND is_cognitive_ability_completed = 1
            AND gp_percentage IS NOT NULL
        '), [
            'growth_weight' => $growth_weight,
            'cognitive_weight' => $cognitive_weight,
            'total_weight' => $growth_weight + $cognitive_weight,
            'combined_mean' => $combined_mean,
            'company_id' => auth()->user()->id
        ]);
    
        $combined_std_dev = sqrt($variance[0]->variance);

        $query->whereNotNull('gp_percentage');
    
        if ($request->filled('category')) {
            $category = $request->input('category');
            
            switch ($category) {
                case 'Super High':
                    $query->whereRaw('(0.7 * gp_percentage + 0.3 * cognitive_test_percentage) >= ?', [$combined_mean + $combined_std_dev]);
                    break;
                case 'Very High':
                    $query->whereRaw('(0.7 * gp_percentage + 0.3 * cognitive_test_percentage) >= ?', [$combined_mean])
                        ->whereRaw('(0.7 * gp_percentage + 0.3 * cognitive_test_percentage) < ?', [$combined_mean + $combined_std_dev]);
                    break;
                case 'High':
                    $query->whereRaw('(0.7 * gp_percentage + 0.3 * cognitive_test_percentage) >= ?', [$combined_mean - $combined_std_dev])
                        ->whereRaw('(0.7 * gp_percentage + 0.3 * cognitive_test_percentage) < ?', [$combined_mean]);
                    break;
                case 'Average':
                    $query->whereRaw('(0.7 * gp_percentage + 0.3 * cognitive_test_percentage) < ?', [$combined_mean - $combined_std_dev]);
                    break;
            }
        }
        $top5users = $query->select('*', 
            DB::raw('RANK() OVER (ORDER BY (0.7 * gp_percentage + 0.3 * cognitive_test_percentage) DESC) AS `rank`'), 
            DB::raw("CASE 
                        WHEN (0.7 * gp_percentage + 0.3 * cognitive_test_percentage) >= ($combined_mean + $combined_std_dev) THEN 'Super High' 
                        WHEN (0.7 * gp_percentage + 0.3 * cognitive_test_percentage) >= ($combined_mean) 
                        AND (0.7 * gp_percentage + 0.3 * cognitive_test_percentage) < ($combined_mean + $combined_std_dev) THEN 'Very High' 
                        WHEN (0.7 * gp_percentage + 0.3 * cognitive_test_percentage) >= ($combined_mean - $combined_std_dev) 
                        AND (0.7 * gp_percentage + 0.3 * cognitive_test_percentage) < $combined_mean THEN 'High' 
                        WHEN (0.7 * gp_percentage + 0.3 * cognitive_test_percentage) < ($combined_mean - $combined_std_dev) THEN 'Average' 
                     END AS gp_potential"))

            ->orderBy(DB::raw('(0.7 * gp_percentage + 0.3 * cognitive_test_percentage)'), 'DESC')
            ->limit(5)
            ->get();
    
        $users = $query->select('*', DB::raw('RANK() OVER (ORDER BY gp_percentage DESC) AS `rank`'), DB::raw("CASE 
                WHEN (0.7 * gp_percentage + 0.3 * cognitive_test_percentage) >= ($combined_mean + $combined_std_dev) THEN 'Super High' 
                WHEN (0.7 * gp_percentage + 0.3 * cognitive_test_percentage) >= ($combined_mean) 
                AND (0.7 * gp_percentage + 0.3 * cognitive_test_percentage) < ($combined_mean + $combined_std_dev) THEN 'Very High' 
                WHEN (0.7 * gp_percentage + 0.3 * cognitive_test_percentage) >= ($combined_mean - $combined_std_dev)
                AND (0.7 * gp_percentage + 0.3 * cognitive_test_percentage) < $combined_mean THEN 'High' 
                WHEN (0.7 * gp_percentage + 0.3 * cognitive_test_percentage) < ($combined_mean - $combined_std_dev) THEN 'Average' 
                
            END AS gp_potential"))
            ->orderBy('gp_percentage', 'DESC')
            ->paginate(10);

        $performanceCounts = $queryForAll->select(
            DB::raw("SUM(CASE 
                        WHEN (0.7 * gp_percentage + 0.3 * cognitive_test_percentage) >= ($combined_mean + $combined_std_dev) THEN 1 
                        ELSE 0 
                     END) AS super_high_count"),
            DB::raw("SUM(CASE 
                        WHEN (0.7 * gp_percentage + 0.3 * cognitive_test_percentage) >= ($combined_mean) 
                        AND (0.7 * gp_percentage + 0.3 * cognitive_test_percentage) < ($combined_mean + $combined_std_dev) THEN 1 
                        ELSE 0 
                     END) AS very_high_count"),
            DB::raw("SUM(CASE 
                        WHEN (0.7 * gp_percentage + 0.3 * cognitive_test_percentage) >= ($combined_mean - $combined_std_dev) 
                        AND (0.7 * gp_percentage + 0.3 * cognitive_test_percentage) < $combined_mean THEN 1 
                        ELSE 0 
                     END) AS high_count"),
            DB::raw("SUM(CASE 
                        WHEN (0.7 * gp_percentage + 0.3 * cognitive_test_percentage) < ($combined_mean) THEN 1 
                        ELSE 0 
                     END) AS avg_count")
        )->first();
        
        $performanceData = [$performanceCounts->super_high_count ?? 0, $performanceCounts->very_high_count ?? 0, $performanceCounts->high_count ?? 0, $performanceCounts->avg_count ?? 0];
        $performanceLabels = ['Super High','Very High', 'High', 'Average'];
    
        $type = 'employee';
    
        return view('admin.growth-potential.index', compact('users', 'averagePercentage', 'type', 'performanceData', 'performanceLabels', 'top5users', 'departments'));
    }
    

    public function filterUsers(Request $request)
    {
        $category = $request->input('category');
    
        $users = User::whereHas('gp_potential', function($query) use ($category) {
            $query->where('gp_potential', $category);
        })->get();
    
        return response()->json([
            'users' => $users
        ]);
    }

    public function flightRisk(Request $request)
    {
        // dd($request->all());
        $query = User::where('company_id', auth()->user()->id)
            ->where('is_personality_motivation_completed', '=', 1)
            ->where('is_work_interest_completed', '=', 1)
            ->where('is_cognitive_ability_completed', '=', 1);
        $department_id = $request->get('department_id') ?? 0;
        if ($request->filled('department')) {
            $matchedDepartment = Department::where('name', $request->department)->first()->id;
            $query->where('department_id', $matchedDepartment);
            $department_name = $request->department;
        }
        $resultsOfPosition = AssessmentHelper::getFlightRiskByDepartmentAndPosition(1, $department_id);
        $resultsOfDepartment = AssessmentHelper::getFlightRiskByDepartmentAndPosition(0, $department_id);
        $resultsOfAllDepartments = AssessmentHelper::getFlightRiskByDepartmentAndPosition(0, 0);
        $sum = 0;
        $count = 0;

        foreach ($resultsOfAllDepartments as $department) {
            $sum = $sum + $department->average_risk_level;
            $count = $count + 1;
        }

        if ($department_id) {

            $average_of_all_departments = $sum / $count;
            // Create a new object with the specified properties
            $newDepartment = (object) [
                'department_name' => 'All',
                'number_of_users' => 0,  // Assuming you initially want to set this to 0
                'average_risk_level' => $average_of_all_departments
            ];

            // Add the new department to the existing collection
            $resultsOfDepartment->prepend($newDepartment);
            $query->where('department_id', $department_id);
            $department_name = Department::where('id', $department_id)->first()->name;
        }

        if ($request->filled('position')) {
            $query->where('position_id', $request->position);
        }
        $users = $query->orderBy('flight_risk_score', 'ASC')->paginate(10);
        $department = Department::where('company_id', auth()->user()->id)->select('id', 'name')->get();
        $data = [
            'resultsOfPosition' => $resultsOfPosition,
            'resultsOfDepartment' => $resultsOfDepartment,
            'department' => $department,
            'users' => $users,
            'department_name' => $department_name ?? null
        ];
        // dd($resultsOfPosition, $resultsOfDepartment);
        return view('admin.talent-management.flight-risk', $data);
    }

    public function organizationalFitForecast(Request $request)
    {
        $query = User::where('company_id', auth()->user()->id)->where('is_personality_motivation_completed', '=', 1)
        ->where('is_work_interest_completed', '=', 1)
        ->where('is_cognitive_ability_completed', '=', 1);

        // Check if a department_id filter is present
        $departmentId = $request->input('department_id');

        if ($request->filled('department')) {
            $matched_department = Department::where('name', $request->department)->pluck('id')->first();
            $department_name = $request->department;
            $query->where('department_id', $matched_department);
        }

        if ($request->filled('risk_level')) {
            $query->where('organizational_fit_forecast', $request->risk_level);
        }

        // Query for 'ALL' without grouping
        $allAggregatedQueryDepartment = DB::table('users')
            ->select(
                DB::raw("'ALL' as department_name"),
                DB::raw("COUNT(CASE WHEN organizational_fit_forecast = 'high' THEN 1 END) as high"),
                DB::raw("COUNT(CASE WHEN organizational_fit_forecast = 'moderate' THEN 1 END) as moderate"),
                DB::raw("COUNT(CASE WHEN organizational_fit_forecast = 'low' THEN 1 END) as low")
            )->where('company_id', auth()->user()->id);

        // Apply the department_id filter if present
        // if ($departmentId) {
        //     $allAggregatedQueryDepartment->where('users.department_id', $departmentId);
        // }

        $allAggregatedForDepartment = $allAggregatedQueryDepartment->first();

        // Query for 'ALL' without grouping
        $allAggregatedQueryPosition = DB::table('users')
            ->select(
                DB::raw("'ALL' as position_name"),
                DB::raw("COUNT(CASE WHEN organizational_fit_forecast = 'high' THEN 1 END) as high"),
                DB::raw("COUNT(CASE WHEN organizational_fit_forecast = 'moderate' THEN 1 END) as moderate"),
                DB::raw("COUNT(CASE WHEN organizational_fit_forecast = 'low' THEN 1 END) as low")
            )->where('company_id', auth()->user()->id);

        // Apply the department_id filter if present
        if ($departmentId) {
            $allAggregatedQueryPosition->where('users.department_id', $departmentId);

            $query->where('department_id', $departmentId);
            $department_name = Department::where('id', $departmentId)->first()->name;
        }

        $allAggregatedForPosition = $allAggregatedQueryPosition->first();

        // Base query for departments
        $departmentQuery = DB::table('users as u')
            ->join('departments as d', 'u.department_id', '=', 'd.id')
            ->select(
                'd.name as department_name',
                DB::raw("COUNT(CASE WHEN u.organizational_fit_forecast = 'high' THEN 1 END) as high"),
                DB::raw("COUNT(CASE WHEN u.organizational_fit_forecast = 'moderate' THEN 1 END) as moderate"),
                DB::raw("COUNT(CASE WHEN u.organizational_fit_forecast = 'low' THEN 1 END) as low")
            )
            ->where('u.company_id', auth()->user()->id)
            ->groupBy('d.name'); // Group by the department's id for accurate aggregation


        // Apply the department_id filter if present
        if ($departmentId) {
            $departmentQuery->where('u.department_id', $departmentId);
        }

        $resultsOfDepartment = $departmentQuery->get();
        // $resultsOfDepartment->prepend($newDepartment);
        // Base query for positions
        $positionQuery = DB::table('users')
            ->join('positions', 'users.position_id', '=', 'positions.id')
            ->select(
                'positions.level as position_name',
                DB::raw("COUNT(CASE WHEN organizational_fit_forecast = 'high' THEN 1 END) as high"),
                DB::raw("COUNT(CASE WHEN organizational_fit_forecast = 'moderate' THEN 1 END) as moderate"),
                DB::raw("COUNT(CASE WHEN organizational_fit_forecast = 'low' THEN 1 END) as low")
            )
            ->where('users.company_id', auth()->user()->id)
            ->groupBy('positions.level');

        // Apply the department_id filter to the position data if present
        if ($departmentId) {
            $positionQuery->where('users.department_id', $departmentId);
        }

        $resultsOfPosition = $positionQuery->get();

        $resultsOfDepartment->prepend($allAggregatedForDepartment);
        $resultsOfPosition->prepend($allAggregatedForPosition);

        // Retrieve all departments for the filter dropdown
        $department = Department::where('company_id', auth()->user()->id)->select('id', 'name')->get();
        
        $users = $query->orderBy('organizational_fit_forecast_dark_triad_percentage', 'DESC')->paginate(10);
        // Pass the data to the view
        return view('admin.talent-management.organizational-fit-forecast', [
            'departmentData' => $resultsOfDepartment,
            'positionData' => $resultsOfPosition,
            'department' => $departmentId, // Pass the selected department_id if any
            'department' => $department,
            'users' => $users,
            'department_name' => $department_name ?? null
        ]);
    }

    private function calculateCombinedScore($avgGrowthPotential, $avgCognitiveAssessment, $growth_weight, $cognitive_weight)
    {
        $total_weight = $growth_weight + $cognitive_weight;
        return ($avgGrowthPotential * $growth_weight + $avgCognitiveAssessment * $cognitive_weight) / $total_weight;
    }
}
