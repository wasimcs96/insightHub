<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Division;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserPerformanceRatingImport;
use App\Exports\UserResultsExport;
use App\Exports\TalentInsightExport;
use TenantDB;

class TalentInsightController extends Controller
{
    public function index(Request $request)
    {
        $responseData = [];

        $user = auth()->user();
        $company_id = $user->company_id ?: 3;

        // Fetch divisions first
        $divisions = Division::where('status', 'active')->orderBy('created_at', 'DESC')->get();
        $responseData['divisions'] = $divisions; 

        // Only fetch departments if division is selected
        if ($request->get('division_id')) {
            $departments = Department::where('division_id', $request->get('division_id'))
                                   ->where('status', 1)
                                   ->get();
            $responseData['departments'] = $departments;
        } else {
            $responseData['departments'] = collect([]);
        }

        // Default pagination and sorting
        $perPage = $request->get('perPage', 10);
        $perPage = is_numeric($perPage) && $perPage > 0 ? $perPage : 10;

        $divisionId = $request->get('division_id') ?? 0;
        $departmentId = $request->get('department_id') ?? 0;
        $positionLevel = $request->get('position_level') ?? 0;
        $assessmentStatus = $request->get('assessment_status') ?? 0;
        $strategy = $request->get('strategy') ?? 0;
        $isHighPotential = $request->get('is_high_potential') ?? 0;
        $userIds = $request->get('user_ids') ?? [];
        $gridId = $request->get('grid_id') ?? 0;
        
        // Sorting parameters
        $sortColumn = $request->get('sort_column', 'x.name');
        $sortDirection = in_array($request->get('sort_direction'), ['asc', 'desc']) ? $request->get('sort_direction') : 'asc';

        $validColumns = ['x.name', 'x.id', 'j.title', 'omr_level', 'bfr_level', 'ta_level', 'tsmr_level', 'ssmr_level', 'jmr_level', 'cat_level', 'gp_level', 'rci_level', 'fr_level', 'waf_level'];
        if (!in_array($sortColumn, $validColumns)) {
            $sortColumn = 'x.name';
        }

        $responseData = array_merge($responseData, [
            'divisionId' => $divisionId,
            'departmentId' => $departmentId,
            'positionLevel' => $positionLevel,
            'isHighPotential' => $isHighPotential,
            'userIds' => $userIds
        ]);

        // Build query
        $results = TenantDB::table('users as x')
            ->leftJoin('jobs as j', 'x.position_id', '=', 'j.id')
            ->leftJoin('departments as d', 'x.department_id', '=', 'd.id') // Add departments join
            ->join('user_results as ur', 'x.id', '=', 'ur.user_id')
            ->leftJoin('user_performance_ratings as upr', 'x.id', '=', 'upr.user_id')
            ->select(
                'x.id', 'x.name', 'x.is_high_potential', 'x.profile_picture',
                'j.title as position_title',
                TenantDB::raw("MAX(CASE WHEN ur.result_type = 'overall_match_rate' AND ur.job_id = x.position_id THEN ur.level END) AS omr_level"),
                TenantDB::raw("MAX(CASE WHEN ur.result_type = 'soft_skill_score' AND ur.job_id = x.position_id THEN ur.level END) AS bfr_level"),
                TenantDB::raw("MAX(CASE WHEN ur.assessment_type = 'technical' AND ur.result_type = 'overall' AND ur.job_id = x.position_id THEN ur.level END) AS ta_level"),
                TenantDB::raw("MAX(CASE WHEN ur.result_type = 'ccs_match_rate' AND ur.job_id = x.position_id THEN ur.level END) AS ssmr_level"),
                TenantDB::raw("MAX(CASE WHEN ur.result_type = 'jmr' AND ur.job_id = x.position_id THEN ur.level END) AS jmr_level"),
                TenantDB::raw("MAX(CASE WHEN ur.assessment_type = 'cognitive' AND ur.result_type = 'overall' THEN ur.level END) AS cat_level"),
                TenantDB::raw("MAX(CASE WHEN ur.result_type = 'growth_potential' THEN ur.level END) AS gp_level"),
                TenantDB::raw("MAX(CASE WHEN ur.result_type = 'rci' THEN ur.level END) AS rci_level"),
                TenantDB::raw("MAX(CASE WHEN ur.result_type = 'flight_risk' THEN ur.level END) AS fr_level"),
                TenantDB::raw("MAX(CASE WHEN ur.result_type = 'organizational_fit_forecast' THEN ur.level END) AS waf_level"),
                TenantDB::raw("AVG(CASE WHEN upr.normalized_rating > 0 THEN upr.normalized_rating ELSE NULL END) AS avg_performance_rating")  // Consider only ratings greater than 0.00
            )
            ->whereIn('ur.result_type', [
                'growth_potential', 'rci', 'flight_risk', 'organizational_fit_forecast',
                'ccs_match_rate', 'jmr', 'overall', 'soft_skill_score', 'overall_match_rate', 'technical_skill_match_rate', 'leadership_potential'
            ])
            ->when($divisionId, function ($query) use ($divisionId) {
                return $query->where('d.division_id', $divisionId);
            })
            ->when($departmentId, function ($query) use ($departmentId) {
                return $query->where('x.department_id', $departmentId);
            })
            ->when($positionLevel, function ($query) use ($positionLevel) {
                return $query->where('j.level', $positionLevel);
            })
            ->when($assessmentStatus, function ($query) use ($assessmentStatus) {
                
                switch ($assessmentStatus) {
                    case 1:
                      return $query;
                      break;
                    case 2:
                        return $query->where('x.is_personality_motivation_completed', 1)->where('x.is_work_interest_completed', 1)->where('x.is_cognitive_ability_completed', 1)->where('x.is_technical_assessment_completed', 1);
                        break;
                    case 3:
                        return $query->where('x.is_personality_motivation_completed', 1)->where('x.is_work_interest_completed', 1)->where('x.is_cognitive_ability_completed', 1)->where('x.is_technical_assessment_completed', 0);
                        break;
                    case 4:
                        return $query->where('x.is_personality_motivation_completed', 0)->where('x.is_work_interest_completed', 0)->where('x.is_cognitive_ability_completed', 0)->where('x.is_technical_assessment_completed', 0);
                        break;
                    default:
                        return $query;
                  }
                
            })
            ->when($strategy, function ($query) use ($strategy) {
                if ($strategy == 1) {
                    return $query->havingRaw("
                     (
                         MAX(CASE WHEN ur.result_type = 'growth_potential' THEN ur.level END) > ?
                         AND
                         MAX(CASE WHEN ur.result_type = 'jmr' THEN ur.level END) > ?
                     )
                     ", [3, 3])
                     ->havingRaw("MAX(CASE WHEN ur.result_type = 'rci' THEN ur.level END) > ?", [0]);
                 } elseif ($strategy == 2) {
                     return $query->havingRaw("
                     (
                         MAX(CASE WHEN ur.result_type = 'growth_potential' THEN ur.level END) < ?
                         OR
                         MAX(CASE WHEN ur.assessment_type = 'cognitive' AND ur.result_type = 'overall' THEN ur.level END) < ?
                     )
                     ", [3, 2])
                     ->havingRaw("
                     (
                         MAX(CASE WHEN ur.result_type = 'growth_potential' THEN ur.level END) < ?
                         AND
                         MAX(CASE WHEN ur.result_type = 'jmr' THEN ur.level END) < ?
                     )
                     ", [3, 3])
                     ->havingRaw("MAX(CASE WHEN ur.result_type = 'rci' THEN ur.level END) > ?", [0]);
                 } elseif ($strategy == 3) {
                     return $query->havingRaw("MAX(CASE WHEN ur.result_type = 'growth_potential' THEN ur.level END) = ?", [3])
                     ->havingRaw("MAX(CASE WHEN ur.assessment_type = 'cognitive' AND ur.result_type = 'overall' THEN ur.level END) = ?", [2]);
                 } elseif ($strategy == 4) {
                     return $query->havingRaw("
                     (
                         MAX(CASE WHEN ur.result_type = 'flight_risk' THEN ur.level END) > ?
                         OR
                         MAX(CASE WHEN ur.result_type = 'organizational_fit_forecast' THEN ur.level END) >= ?
                     )
                 ", [3, 3]);
                 
                 } elseif ($strategy == 5) {
                     return $query->havingRaw("
                     (
                         MAX(CASE WHEN ur.result_type = 'flight_risk' THEN ur.level END) <= ?
                         OR
                         MAX(CASE WHEN ur.result_type = 'organizational_fit_forecast' THEN ur.level END) < ?
                     )
                 ", [3, 3]);
                }
                else {
                    return $query;
                }
            })
            ->when($isHighPotential, function ($query) use ($isHighPotential) {
                return $query->where('x.is_high_potential', $isHighPotential);
            })
            ->when($userIds, function ($query) use ($userIds) {
                $userIdsArray = is_string($userIds) ? explode(',', $userIds) : $userIds;
                return is_array($userIdsArray) ? $query->whereIn('x.id', $userIdsArray) : $query;
            })
            ->when($gridId, function ($query) use ($gridId) {
                $bfrLevels = config('helpers.talent_insight_9_grid')[$gridId]['bfr'];
                $placeholders = implode(',', array_fill(0, count($bfrLevels), '?'));
                $rating = config('helpers.talent_insight_9_grid')[$gridId]['performance_rating'];
                return $query->havingRaw("bfr_level IN ($placeholders)", $bfrLevels)
                             ->havingRaw("AVG(CASE WHEN upr.normalized_rating > 0 THEN upr.normalized_rating END) >= ? AND AVG(CASE WHEN upr.normalized_rating > 0 THEN upr.normalized_rating END) < ?", [$rating, $rating + 1]);// Only consider ratings greater than 0
            })
            ->groupBy('x.id', 'x.name', 'x.is_high_potential', 'x.profile_picture', 'j.title')
            ->orderBy($sortColumn, $sortDirection) // Apply sorting with validated direction
            ->paginate($perPage);


        // Merge results into response data
        $responseData = array_merge($responseData, ['results' => $results]);
        
        // Check if it's an AJAX request
        if ($request->ajax()) {
            // dd($request->all());
            return response()->json([
                'html' => view('admin.talent-insight.results', $responseData)->render(),
                'pagination' => (string) $results->links(), // Include pagination links
            ]);
        }
    
        // Return view with results if not an AJAX request
        return view('admin.talent-insight.index', $responseData);
    }

    public function tagHighPotential(Request $request, $employee_id)
    {

        // Retrieve the filters from the request
        $department_id = $request->input('department_id');
        $position_level = $request->input('position_level');
        $user_ids = $request->input('user_ids'); // Assuming this is an array of user IDs
        // dd($department_id);
        // Apply the update for is_high_potential toggle based on filters
        User::where('id', $employee_id)
            ->update([
                'is_high_potential' => TenantDB::raw('IF(is_high_potential = 0, 1, 0)') // Toggle value
            ]);

        // Redirect back to the previous URL, preserving the query parameters
        return redirect()->route('admin.talent-insight.index', [
            'department_id' => $department_id,
            'position_level' => $position_level,
            'user_ids' => $user_ids,
        ]);
        
        
    }

    public function importRatingDataView() {
        return view('admin.talent-insight.import');
    }
    
    public function importRatingData(Request $request) {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new UserPerformanceRatingImport, $request->file('file'));

        return back()->with('success', 'User performance ratings imported successfully.');
    }

    public function downloadReport(Request $request) {
        return Excel::download(new UserResultsExport($request), 'User Results.xlsx');
    }

    public function exportReport(Request $request) {
        // Get parameters from the request
        $divisionId = $request->get('division_id') ?? '';
        $departmentId = $request->get('department_id') ?? '';
        $positionLevel = $request->get('position_level') ?? '';
        $assessmentStatus = $request->get('assessment_status') ?? 0;
        $strategy = $request->get('strategy') ?? '';
        $isHighPotential = $request->get('is_high_potential') ?? '';
        $userIds = $request->get('user_ids') ?? [];
        $gridId = $request->get('grid_id') ?? '';
        $selectedFields = $request->input('fields'); // Fields selected in the frontend
     
        // Prepare the data to export
        $query = $this->prepareQuery($companyId, $divisionId, $departmentId, $positionLevel, $assessmentStatus, $strategy, $isHighPotential, $userIds, $gridId, $selectedFields);
       
        // Perform the export
        return Excel::download(new TalentInsightExport($query, $selectedFields), 'Talent Insight Users Export.xlsx');
    }


    private function prepareQuery($divisionId, $departmentId, $positionLevel, $assessmentStatus, $strategy, $isHighPotential, $userIds, $gridId, $selectedFields)
    {
        // Fixed Fields (non-selectable)
        $fixedFields = [
            'name' => 'x.name',
            'position_title' => 'j.title as position_title',
        ];

        // Mappable Fields (based on your dynamic field list)
        $mappableFields = [
            'omr_level' => TenantDB::raw("MAX(CASE WHEN ur.result_type = 'overall_match_rate' AND ur.job_id = x.position_id THEN 
                CASE WHEN ur.level = 0 THEN 'Data not available'
                WHEN ur.level = 1 THEN 'Very Low'
                WHEN ur.level = 2 THEN 'Low'
                WHEN ur.level = 3 THEN 'Moderate'
                WHEN ur.level = 4 THEN 'High'
                WHEN ur.level = 5 THEN 'Very High'
                ELSE 'Unknown' END END) AS omr_level"),

            'bfr_level' => TenantDB::raw("MAX(CASE WHEN ur.result_type = 'soft_skill_score' AND ur.job_id = x.position_id THEN 
                CASE WHEN ur.level = 0 THEN 'Data not available'
                WHEN ur.level = 1 THEN 'Very Low'
                WHEN ur.level = 2 THEN 'Low'
                WHEN ur.level = 3 THEN 'Moderate'
                WHEN ur.level = 4 THEN 'High'
                WHEN ur.level = 5 THEN 'Very High'
                ELSE 'Unknown' END END) AS bfr_level"),

            'ta_level' => TenantDB::raw("MAX(CASE WHEN ur.assessment_type = 'technical' AND ur.result_type = 'overall' AND ur.job_id = x.position_id THEN 
                CASE WHEN ur.level = 0 THEN 'Data not available'
                WHEN ur.level = 1 THEN 'Very Low'
                WHEN ur.level = 2 THEN 'Low'
                WHEN ur.level = 3 THEN 'Moderate'
                WHEN ur.level = 4 THEN 'High'
                WHEN ur.level = 5 THEN 'Very High'
                ELSE 'Unknown' END END) AS ta_level"),

            'tsmr_level' => DB::raw("MAX(CASE WHEN ur.result_type = 'technical_skill_match_rate' AND ur.job_id = x.position_id THEN 
                CASE WHEN ur.level = 0 THEN 'Data not available'
                WHEN ur.level = 1 THEN 'Very Low'
                WHEN ur.level = 2 THEN 'Low'
                WHEN ur.level = 3 THEN 'Moderate'
                WHEN ur.level = 4 THEN 'High'
                WHEN ur.level = 5 THEN 'Very High'
                ELSE 'Unknown' END END) AS tsmr_level"),

            'ssmr_level' => TenantDB::raw("MAX(CASE WHEN ur.result_type = 'ccs_match_rate' AND ur.job_id = x.position_id THEN 

                CASE WHEN ur.level = 0 THEN 'Data not available'
                WHEN ur.level = 1 THEN 'Very Low'
                WHEN ur.level = 2 THEN 'Low'
                WHEN ur.level = 3 THEN 'Moderate'
                WHEN ur.level = 4 THEN 'High'
                WHEN ur.level = 5 THEN 'Very High'
                ELSE 'Unknown' END END) AS ssmr_level"),

            'jmr_level' => TenantDB::raw("MAX(CASE WHEN ur.result_type = 'jmr' AND ur.job_id = x.position_id THEN 
                CASE WHEN ur.level = 0 THEN 'Data not available'
                WHEN ur.level = 1 THEN 'Very Low'
                WHEN ur.level = 2 THEN 'Low'
                WHEN ur.level = 3 THEN 'Moderate'
                WHEN ur.level = 4 THEN 'High'
                WHEN ur.level = 5 THEN 'Very High'
                ELSE 'Unknown' END END) AS jmr_level"),

            'cat_level' => TenantDB::raw("MAX(CASE WHEN ur.assessment_type = 'cognitive' AND ur.result_type = 'overall' THEN 
                CASE WHEN ur.level = 0 THEN 'Data not available'
                WHEN ur.level = 1 THEN 'Low'
                WHEN ur.level = 2 THEN 'Moderate'
                WHEN ur.level = 3 THEN 'High'
                ELSE 'Unknown' END END) AS cat_level"),
            
            'lp_level' => DB::raw("MAX(CASE WHEN ur.result_type = 'leadership_potential' THEN 
                CASE WHEN ur.level = 0 THEN 'Data not available'
                WHEN ur.level = 1 THEN 'Very Low'
                WHEN ur.level = 2 THEN 'Low'
                WHEN ur.level = 3 THEN 'Moderate'
                WHEN ur.level = 4 THEN 'High'
                WHEN ur.level = 5 THEN 'Very High'
                ELSE 'Unknown' END END) AS lp_level"),

            'gp_level' => TenantDB::raw("MAX(CASE WHEN ur.result_type = 'growth_potential' THEN 
                CASE WHEN ur.level = 0 THEN 'Data not available'
                WHEN ur.level = 1 THEN 'Very Low'
                WHEN ur.level = 2 THEN 'Low'
                WHEN ur.level = 3 THEN 'Moderate'
                WHEN ur.level = 4 THEN 'High'
                WHEN ur.level = 5 THEN 'Very High'
                ELSE 'Unknown' END END) AS gp_level"),

            'rci_level' => TenantDB::raw("MAX(CASE WHEN ur.result_type = 'rci' THEN 
                CASE WHEN ur.level = 0 THEN 'Somewhat Consistent'
                WHEN ur.level = 1 THEN 'Fairly Consistent'
                WHEN ur.level = 2 THEN 'Consistent'
                ELSE 'Unknown' END END) AS rci_level"),

            'fr_level' => TenantDB::raw("MAX(CASE WHEN ur.result_type = 'flight_risk' THEN 
                CASE WHEN ur.level = 0 THEN 'Data not available'
                WHEN ur.level = 1 THEN 'Very Low'
                WHEN ur.level = 2 THEN 'Low'
                WHEN ur.level = 3 THEN 'Moderate'
                WHEN ur.level = 4 THEN 'High'
                WHEN ur.level = 5 THEN 'Very High'
                ELSE 'Unknown' END END) AS fr_level"),

            'waf_level' => TenantDB::raw("MAX(CASE WHEN ur.result_type = 'organizational_fit_forecast' THEN 
                CASE WHEN ur.level = 0 THEN 'Data not available'
                WHEN ur.level = 1 THEN 'Very Low'
                WHEN ur.level = 2 THEN 'Low'
                WHEN ur.level = 3 THEN 'Moderate'
                WHEN ur.level = 4 THEN 'High'
                WHEN ur.level = 5 THEN 'Very High'
                ELSE 'Unknown' END END) AS waf_level")
        ];
         
        // Initialize the query
        $query = TenantDB::table('users as x')
            ->leftJoin('jobs as j', 'x.position_id', '=', 'j.id')
            ->leftJoin('departments as d', 'x.department_id', '=', 'd.id') // Add departments join
            ->join('user_results as ur', 'x.id', '=', 'ur.user_id')
            ->leftJoin('user_performance_ratings as upr', 'x.id', '=', 'upr.user_id')
            ->where('x.tenant_id', $tenantId)
            ->whereIn('ur.result_type', [
                'growth_potential', 'rci', 'flight_risk', 'organizational_fit_forecast',
                'ccs_match_rate', 'jmr', 'overall', 'soft_skill_score', 'overall_match_rate', 'technical_skill_match_rate', 'leadership_potential'
            ])
            ->when(request()->get('division_id'), function ($query) {
                return $query->where('d.division_id', request()->get('division_id'));
            })
            ->when($divisionId, function ($query) use ($divisionId) {
                return $query->where('x.department_id', $divisionId);
            })
            ->when($departmentId, function ($query) use ($departmentId) {
                return $query->where('x.department_id', $departmentId);
            })
            ->when($positionLevel, function ($query) use ($positionLevel) {
                return $query->where('j.level', $positionLevel);
            })
            ->when($assessmentStatus, function ($query) use ($assessmentStatus) {
                
                switch ($assessmentStatus) {
                    case 1:
                      return $query;
                      break;
                    case 2:
                        return $query->where('x.is_personality_motivation_completed', 1)->where('x.is_work_interest_completed', 1)->where('x.is_cognitive_ability_completed', 1)->where('x.is_technical_assessment_completed', 1);
                        break;
                    case 3:
                        return $query->where('x.is_personality_motivation_completed', 1)->where('x.is_work_interest_completed', 1)->where('x.is_cognitive_ability_completed', 1)->where('x.is_technical_assessment_completed', 0);
                        break;
                    case 4:
                        return $query->where('x.is_personality_motivation_completed', 0)->where('x.is_work_interest_completed', 0)->where('x.is_cognitive_ability_completed', 0)->where('x.is_technical_assessment_completed', 0);
                        break;
                    default:
                        return $query;
                  }
                
            })
            ->when($strategy, function ($query) use ($strategy) {
                if ($strategy == 1) {
                    $query->havingRaw("
                    (
                        MAX(CASE WHEN ur.result_type = 'growth_potential' THEN ur.level END) > ?
                        AND
                        MAX(CASE WHEN ur.result_type = 'jmr' THEN ur.level END) > ?
                    )
                    ", [3, 3])
                    ->havingRaw("MAX(CASE WHEN ur.result_type = 'rci' THEN ur.level END) > ?", [0]);
                } elseif ($strategy == 2) {
                    return $query->havingRaw("
                    (
                        MAX(CASE WHEN ur.result_type = 'growth_potential' THEN ur.level END) < ?
                        OR
                        MAX(CASE WHEN ur.assessment_type = 'cognitive' AND ur.result_type = 'overall' THEN ur.level END) < ?
                    )
                    ", [3, 2])
                    ->havingRaw("
                        MAX(CASE WHEN ur.result_type = 'growth_potential' THEN ur.level END) < ?
                        AND
                        MAX(CASE WHEN ur.result_type = 'jmr' THEN ur.level END) < ?
                    )
                    ", [3, 3])
                    ->havingRaw("MAX(CASE WHEN ur.result_type = 'rci' THEN ur.level END) > ?", [0]);
                } elseif ($strategy == 3) {
                    return $query->havingRaw("MAX(CASE WHEN ur.result_type = 'growth_potential' THEN ur.level END) = ?", [3])
                    ->havingRaw("MAX(CASE WHEN ur.assessment_type = 'cognitive' AND ur.result_type = 'overall' THEN ur.level END) = ?", [2]);
                } elseif ($strategy == 4) {
                    return $query->havingRaw("
                    (
                        MAX(CASE WHEN ur.result_type = 'flight_risk' THEN ur.level END) > ?
                        OR
                        MAX(CASE WHEN ur.result_type = 'organizational_fit_forecast' THEN ur.level END) >= ?
                    )
                ", [3, 3]);
                
                } elseif ($strategy == 5) {
                    return $query->havingRaw("
                    (
                        MAX(CASE WHEN ur.result_type = 'flight_risk' THEN ur.level END) <= ?
                        OR
                        MAX(CASE WHEN ur.result_type = 'organizational_fit_forecast' THEN ur.level END) < ?
                    )
                ", [3, 3]);
                
                } else {
                    return $query;
                }
            })
            ->when($isHighPotential, function ($query) use ($isHighPotential) {
                if ($isHighPotential == 1) {
                    return $query->where('x.is_high_potential', $isHighPotential);
                }
            })
            ->when($userIds, function ($query) use ($userIds) {
                    $userIdsArray = is_string($userIds) ? explode(',', $userIds) : $userIds;
                    return is_array($userIdsArray) ? $query->whereIn('x.id', $userIdsArray) : $query;           
            })
            ->when($gridId, function ($query) use ($gridId) {
                $bfrLevels = config('helpers.talent_insight_9_grid')[$gridId]['bfr'];
                $placeholders = implode(',', array_fill(0, count($bfrLevels), '?'));
                $rating = config('helpers.talent_insight_9_grid')[$gridId]['performance_rating'];
                return $query->havingRaw("bfr_level IN ($placeholders)", $bfrLevels)
                             ->havingRaw("AVG(CASE WHEN upr.normalized_rating > 0 THEN upr.normalized_rating END) >= ? AND AVG(CASE WHEN upr.normalized_rating > 0 THEN upr.normalized_rating END) < ?", [$rating, $rating + 1]);// Only consider ratings greater than 0
            })
            ->groupBy('x.id', 'x.name', 'x.is_high_potential', 'j.title')
            ->orderBy('x.name');

        // Select fields for the query
        $selectFields = array_values($fixedFields);

        // Add the selected fields dynamically from the mappable fields
        foreach ($selectedFields as $field) {
            if (isset($mappableFields[$field])) {
                $selectFields[] = $mappableFields[$field];
            }
        }
        
        // Apply the selected fields to the query
        $query->select($selectFields);
        return $query;
    }

}


