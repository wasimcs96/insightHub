<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class JobOpeningApplication extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['status_label', 'interview_performance_label', 'application_status_color','selection_matrix_label','interview_date_time_label'];

    /**
     * Get the job opening that owns the application.
     */

     public function getSelectionMatrixLabelAttribute()
    {
        $selectionMatrix = config('helpers.selection_matrix');
        $selectionMatrixLevels = config('helpers.selection_matrix_levels');

        if (
            $this->selection_matrix_level &&
            isset($selectionMatrix[$this->selection_matrix_level])
        ) {
            $finalResultLevel = $selectionMatrix[$this->selection_matrix_level]['final_result_level'];

            return $selectionMatrixLevels[$finalResultLevel] ?? 'Data Not Available';
        }

        return 'Data Not Available';
    }

    public function getInterviewDateTimeLabelAttribute()
    {
        if ($this->interview_date && $this->interview_start_time && $this->interview_end_time){
            return Carbon::parse($this->interview_date)->format('d M Y').' '.
            (Carbon::parse($this->interview_start_time)->format('g:ia').' - '.
            Carbon::parse($this->interview_end_time)->format('g:ia'));
        }else{
            return 'Not Scheduled';
        }
    }


    public function jobOpening()
    {
        return $this->belongsTo(JobOpening::class, 'job_opening_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function contract()
    {
        return $this->hasOne(Contract::class, 'job_application_id');
    }

    public function scopeApplyGeneralSorting($query, Request $request)
    {
        // Capture sorting parameters from request
        $sortBy = $request->input('sortBy') ?? null;
        $sortDirection = $request->input('sortDirection', 'asc'); // Default is ascending

        // Define sortable columns and their actual database columns
        $sortableColumns = [
            'employeeColumn' => 'users.name',
            'currentLocationColumn' => 'provinces.name',
            'hiringStatusColumn' => 'job_opening_applications.status',
            'nationalityColumn' => 'master_countries.name',
            'workAuthorisationColumn' => 'users.work_authorisation',
            'interviewPerformanceColumn' => 'job_opening_applications.interview_performance', // Sorting by Interview Performance
            'omrColumn' => 'user_max_levels.max_level', // Sorting by OMR
            'bfrColumn' => 'user_max_levels_bfr.max_level',
            'taColumn' => 'user_max_levels_ta.max_level',
            'ssmrColumn' => 'user_max_levels_ssmr.max_level',
            'jmrColumn' => 'user_max_levels_jmr.max_level',
            'catColumn' => 'user_max_levels_cat.max_level',
            'gpColumn' => 'user_max_levels_gp.max_level',
            'rciColumn' => 'user_max_levels_rci.max_level',
            'frColumn' => 'user_max_levels_fr.max_level',
            'wafColumn' => 'user_max_levels_waf.max_level',
            'suitabilityRateColumn' => 'job_opening_applications.suitability_rate', // Sorting suitability rate
            'workExperienceColumn' => 'users.year_of_experience_in_it_sector',
            'educationProgramColumn' => 'master_education_programs.name',
            'educationLevelColumn' => 'master_education_levels.name',
            'expectedSalaryColumn' => 'job_opening_applications.expected_salary',
            'lastHiringStatusColumn' => 'job_opening_applications.status',
            'riasecStatusColumn' => 'users.is_work_interest_completed',
            'oceanStatusColumn' => 'users.is_ocean_completed',
            'cognitiveAssessmentStatusColumn' => 'users.is_cognitive_ability_completed',
            'technicalAssessmentStatusColumn' => 'job_opening_applications.technical_assessment_completed',
            'bfrColumn' => 'user_max_levels.max_level',
            'interviewTimeColumnColumn' => 'job_opening_applications.interview_date',
            'updated_at' => 'job_opening_applications.updated_at',
        ];

        // If sortBy exists and is a valid column, apply sorting
        if ($sortBy && isset($sortableColumns[$sortBy])) {
            $column = $sortableColumns[$sortBy];

            // Ensure we select all required fields
            $query->select('job_opening_applications.*');

            // Handling special cases where sorting is on a related table (users)
            if (in_array($sortBy, ['employeeColumn', 'workExperienceColumn'])) {
                $query->selectRaw("
                    (SELECT $column FROM users WHERE users.id = job_opening_applications.user_id) as sortable_column
                ");
                $sortColumn = 'sortable_column';
            } elseif ($sortBy === 'interviewTimeColumnColumn') {
                $query->orderBy('job_opening_applications.interview_date', $sortDirection)
                      ->orderBy('job_opening_applications.interview_start_time', $sortDirection);
                return $query;
            }
             elseif ($sortBy === 'currentLocationColumn') {
                // Sorting by country (nationality)
                $query->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
                    ->leftJoin('provinces', 'users.province_id', '=', 'provinces.id')
                    ->selectRaw("
                          (SELECT name FROM provinces WHERE provinces.id = users.province_id) as sortable_column
                      ");
                $sortColumn = 'sortable_column';
            } elseif ($sortBy === 'nationalityColumn') {
                // Sorting by country (nationality)
                $query->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
                    ->leftJoin('master_countries', 'users.country_id', '=', 'master_countries.id')
                    ->selectRaw("
                          (SELECT name FROM master_countries WHERE master_countries.id = users.country_id) as sortable_column
                      ");
                $sortColumn = 'sortable_column';
            } elseif ($sortBy === 'workAuthorisationColumn') {
                // Sorting by Work Authorisation (Convert 1 -> "Yes", 2 -> "No", others -> "Other Work Authorisation")
                $query->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
                    ->selectRaw("
                        CASE 
                            WHEN users.work_authorisation = 1 THEN 'Yes' 
                            WHEN users.work_authorisation = 2 THEN 'No' 
                            ELSE 'Other Work Authorisation' 
                        END as sortable_column
                    ");
                $sortColumn = 'sortable_column';
            } elseif ($sortBy === 'interviewPerformanceColumn') {
                // Sorting by Interview Performance (Mapping numeric keys to labels)
                $interviewPerformanceMapping = config('helpers.interview_levels'); // Get mapping from config

                $caseStatement = "CASE ";
                foreach ($interviewPerformanceMapping as $key => $label) {
                    $caseStatement .= "WHEN job_opening_applications.interview_performance = $key THEN \"$label\" ";
                }
                $caseStatement .= "ELSE \"Other\" END";

                $query->selectRaw("$caseStatement as sortable_column");
                $sortColumn = 'sortable_column';
            } elseif ($sortBy === 'omrColumn') {
                $query->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
                    ->leftJoinSub(
                        DB::table('user_results')
                            ->select('user_results.user_id', DB::raw('MAX(level) as max_level'))
                            ->where('user_results.result_type', 'overall_match_rate')
                            ->groupBy('user_results.user_id'),
                        'user_max_levels',
                        'users.id',
                        '=',
                        'user_max_levels.user_id'
                    );
                $sortColumn = 'user_max_levels.max_level';
            } elseif ($sortBy === 'bfrColumn') {
                $query->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
                    ->leftJoinSub(
                        DB::table('user_results')
                            ->select('user_results.user_id', DB::raw("
                                MAX(
                                    CASE
                                        WHEN result_type = 'soft_skill_score' THEN
                                            CASE
                                                WHEN percentage > 59 THEN 3
                                                WHEN percentage > 16 THEN 2
                                                ELSE 1
                                            END
                                        ELSE 0
                                    END
                                ) as max_level
                            "))
                            ->groupBy('user_results.user_id'),
                        'user_max_levels',
                        'users.id',
                        '=',
                        'user_max_levels.user_id'
                    );
                $sortColumn = 'user_max_levels.max_level';
            } elseif ($sortBy === 'taColumn') {
                $query->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
                    ->leftJoinSub(
                        DB::table('user_results')
                            ->select('user_results.user_id', DB::raw('MAX(level) as max_level'))
                            ->where('result_type', 'overall')
                            ->where('assessment_type', 'technical')
                            ->groupBy('user_results.user_id'),
                        'user_max_levels',
                        'users.id',
                        '=',
                        'user_max_levels.user_id'
                    );
                $sortColumn = 'user_max_levels.max_level';
            } elseif ($sortBy === 'ssmrColumn') {
                $query->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
                    ->leftJoinSub(
                        DB::table('user_results')
                            ->select('user_results.user_id', DB::raw('MAX(level) as max_level'))
                            ->where('result_type', 'ccs_match_rate')
                            ->groupBy('user_results.user_id'),
                        'user_max_levels',
                        'users.id',
                        '=',
                        'user_max_levels.user_id'
                    );
                $sortColumn = 'user_max_levels.max_level';
            } elseif ($sortBy === 'jmrColumn') {
                $query->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
                    ->leftJoinSub(
                        DB::table('user_results')
                            ->select('user_results.user_id', DB::raw('MAX(level) as max_level'))
                            ->where('result_type', 'jmr')
                            ->groupBy('user_results.user_id'),
                        'user_max_levels',
                        'users.id',
                        '=',
                        'user_max_levels.user_id'
                    );
                $sortColumn = 'user_max_levels.max_level';
            } elseif ($sortBy === 'catColumn') {
                $query->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
                    ->leftJoinSub(
                        DB::table('user_results')
                            ->select('user_results.user_id', DB::raw('MAX(level) as max_level'))
                            ->where('result_type', 'overall')
                            ->where('assessment_type', 'cognitive')
                            ->groupBy('user_results.user_id'),
                        'user_max_levels',
                        'users.id',
                        '=',
                        'user_max_levels.user_id'
                    );
                $sortColumn = 'user_max_levels.max_level';
            } elseif ($sortBy === 'gpColumn') {
                $query->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
                    ->leftJoinSub(
                        DB::table('user_results')
                            ->select('user_results.user_id', DB::raw('MAX(level) as max_level'))
                            ->where('result_type', 'growth_potential')
                            ->groupBy('user_results.user_id'),
                        'user_max_levels',
                        'users.id',
                        '=',
                        'user_max_levels.user_id'
                    );
                $sortColumn = 'user_max_levels.max_level';
            } elseif ($sortBy === 'rciColumn') {
                $query->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
                    ->leftJoinSub(
                        DB::table('user_results')
                            ->select('user_results.user_id', DB::raw('MAX(level) as max_level'))
                            ->where('result_type', 'rci')
                            ->groupBy('user_results.user_id'),
                        'user_max_levels',
                        'users.id',
                        '=',
                        'user_max_levels.user_id'
                    );
                $sortColumn = 'user_max_levels.max_level';
            } elseif ($sortBy === 'frColumn') {
                $query->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
                    ->leftJoinSub(
                        DB::table('user_results')
                            ->select('user_results.user_id', DB::raw('MAX(level) as max_level'))
                            ->where('result_type', 'flight_risk')
                            ->groupBy('user_results.user_id'),
                        'user_max_levels',
                        'users.id',
                        '=',
                        'user_max_levels.user_id'
                    );
                $sortColumn = 'user_max_levels.max_level';
            } elseif ($sortBy === 'wafColumn') {
                $query->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
                    ->leftJoinSub(
                        DB::table('user_results')
                            ->select('user_results.user_id', DB::raw('MAX(level) as max_level'))
                            ->where('result_type', 'organizational_fit_forecast')
                            ->groupBy('user_results.user_id'),
                        'user_max_levels',
                        'users.id',
                        '=',
                        'user_max_levels.user_id'
                    );
                $sortColumn = 'user_max_levels.max_level';
            } elseif ($sortBy === 'riasecStatusColumn') {
                $query->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
                    ->selectRaw("
                          CASE 
                              WHEN users.is_work_interest_completed = 1 THEN 'Completed'
                              WHEN users.is_work_interest_completed = 0 THEN 'Not Completed'
                              ELSE 'Unknown'
                          END as sortable_column
                      ");
                $sortColumn = 'sortable_column';
            } elseif ($sortBy === 'oceanStatusColumn') {
                $query->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
                    ->selectRaw("
                          CASE 
                              WHEN users.is_personality_motivation_completed = 1 THEN 'Completed'
                              WHEN users.is_personality_motivation_completed = 0 THEN 'Not Completed'
                              ELSE 'Unknown'
                          END as sortable_column
                      ");
                $sortColumn = 'sortable_column';
            } elseif ($sortBy === 'cognitiveAssessmentStatusColumn') {
                $query->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id');
                $sortColumn = 'users.is_cognitive_ability_completed';
            } elseif ($sortBy === 'technicalAssessmentStatusColumn') {
                
                $sortColumn = 'job_opening_applications.technical_assessment_completed';
            } elseif ($sortBy === 'suitabilityRateColumn') {
                // Sorting directly by suitability_rate (numeric)
                $sortColumn = 'job_opening_applications.suitability_rate';
            } elseif ($sortBy === 'educationProgramColumn') {
                // Join the education programs table
                $query->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
                    ->leftJoin('master_education_programs', 'users.education_program_id', '=', 'master_education_programs.id');

                // Handle NULL values by sorting them as "Others"
                $sortColumn = DB::raw("COALESCE(master_education_programs.name, 'Others')");
            } elseif ($sortBy === 'educationLevelColumn') {
                // Join the education levels table
                $query->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
                    ->leftJoin('master_education_levels', 'users.education_level', '=', 'master_education_levels.id');

                // Handle NULL values by sorting them as "Others"
                $sortColumn = DB::raw("COALESCE(master_education_levels.name, 'Others')");
            } elseif ($sortBy === 'expectedSalaryColumn') {
                // Handle NULL values by treating them as "Other"
                $sortColumn = DB::raw("COALESCE(job_opening_applications.expected_salary, 0)");
            } elseif ($sortBy === 'hiringStatusColumn') {
                $sortColumn = 'job_opening_applications.status';
            } elseif ($sortBy === 'lastHiringStatusColumn') {
                $sortColumn = 'job_opening_applications.status';
            } else {
                $sortColumn = $column;
            }


            
            // Apply sorting
            $query->orderBy($sortColumn, $sortDirection);
        }

        return $query;
    }

    public function scopeApplyGeneralFilters($query, Request $request)
    {
        // List of general filters to apply
        $filterMappings = [
            'tab' => 'application_status',
            'selection_m'=>'selection_matrix_level',
        ];

        if ($request->pageType == 'hiring-pipeline') {
            $filterMappings['tab'] = 'job_opening_applications.status';
        }

        foreach ($filterMappings as $param => $column) {
            if ($request->has($param) && $request->input($param) != '') {
                $value = $request->input($param);
                // If the filter is a string, apply it with LIKE for partial matching
                if ($column == "selection_matrix_level") {
                    if ($value != null && count($value) > 0) {
                    
                    $finalResultLevel = [];
                    $selectionMatrix = config('helpers.selection_matrix');
                    
                    foreach ($value as $key => $matrix) {
                        $finalResultLevel[] = $selectionMatrix[$matrix]['final_result_level'];
                    }

                    
                    $query->whereIn($column, $finalResultLevel);
                    }
                    
                }else{
                    if ($value == 8) {
                        $query->whereIn($column, [8,9,10,11]);
                    }else{
                        $query->where($column, $value);
                    }
                }
                

                if ($request->pageType == 'hiring-pipeline') {
                    $query->where('application_status', '=', 1);
                }
                // You can also add more complex conditions as per your need
            }
        }

        if ($request->has('filters')) {
            $filters = $request->filters;

            $applicationStatusMapping = (config('helpers.application_status'));

            $statusKeys = [];
            $countryIDs = [];
            $programIDs = [];
            $provinceIDs = [];
            $levelIDs = [];

            $filteringOthers = false; // To check if "Others" should be included
            $filteringOthersForEducationProgram = false; // To check if "Others" should be included
            $filteringOthersForLevel = false; // To check if "Others" should be included
            $filteringOthersForLocation = false; // To check if "Others" should be included
            $workAuthorisationFilters = []; // Stores work authorisation filters
            // **Fetch interview performance mappings from config**
            $interviewPerformanceMapping = config('helpers.interview_performance');
            $omrLevelMapping = config('helpers.overall_match_rate_levels');
            $bfrLevelMapping = config('helpers.behavior_fit_rate_levels');
            $taLevelMapping = config('helpers.technical_assessment_levels');
            $ssmrLevelMapping = config('helpers.soft_skill_match_rate_levels');
            $jmrLevelMapping = config('helpers.job_match_rate_levels');
            $catLevelMapping = config('helpers.cognitive_ability_levels');
            $gpLevelMapping = config('helpers.growth_potential_levels');
            $rciLevelMapping = config('helpers.rci_levels');
            $frLevelMapping = config('helpers.flight_risk_levels');
            $wafLevelMapping = config('helpers.organizational_fit_forecast_levels');
            $workExperienceKeys = [];
            $suitabilityRateKeys = [];
            $salaryRangesKeys = [];
            $oceanAssessmentKeys = [];
            $riaSecStatusFilters = [];
            $filterByCognitiveStatus = [];
            $filterByTechnicalStatus = [];
            $selectionMatrixKeys = [];


            foreach ($filters as $filter) {


                if ($filter['filterKey'] === 'selectionMatrixCounts') {
                    $selectionMatrixMapping = config('helpers.selection_matrix_levels');
                    $levelKey = array_search($filter['value'], $selectionMatrixMapping);
                    if ($levelKey !== false) {
                        $selectionMatrixKeys[] = $levelKey;
                    } elseif ($filter['value'] === "Data Not Available") {
                        $selectionMatrixKeys[] = "not_available";
                    }
                }



                if ($filter['filterKey'] === 'statusCounts' || $filter['filterKey'] === 'lastStatusCounts') {
                    $statusKey = array_search($filter['value'], $applicationStatusMapping);
                    if ($statusKey !== false) {
                        $statusKeys[] = $statusKey;
                    }
                }

                // **Extract Country IDs based on filter**
                if ($filter['filterKey'] === 'countryCounts') {
                    if ($filter['value'] === 'Others') {
                        $filteringOthers = true; // Flag to include NULL country_id
                    } else {
                        $countryID = MasterCountry::where('name', $filter['value'])->value('id');
                        if ($countryID) {
                            $countryIDs[] = $countryID;
                        }
                    }
                }

                if ($filter['filterKey'] === 'currentLocationCounts') {
                    if ($filter['value'] === 'Others') {
                        $filteringOthersForLocation = true; // Flag to include NULL country_id
                    } else {
                        $provinceID = MasterProvince::where('name', $filter['value'])->value('id');
                        if ($provinceID) {
                            $provinceIDs[] = $provinceID;
                        }
                    }
                }

                if ($filter['filterKey'] === 'suitabilityRateCounts') {
                    $suitabilityRateKeys[] = $filter['value']; // Get only values that match the suitability range
                }

                if ($filter['filterKey'] === 'expectedSalaryCounts') {
                    $salaryRangesKeys[] = $filter['value'];
                }

                if ($filter['filterKey'] === 'educationProgramCounts') {
                    if ($filter['value'] === 'Others') {
                        $filteringOthersForEducationProgram = true; // Flag to include NULL country_id
                    } else {
                        $programID = MasterEducationProgram::where('name', $filter['value'])->value('id');
                        if ($programID) {
                            $programIDs[] = $programID;
                        }
                    }
                }

                if ($filter['filterKey'] === 'educationLevelCounts') {
                    if ($filter['value'] === 'Others') {
                        $filteringOthersForLevel = true; // Flag to include NULL country_id
                    } else {
                        $levelID = MasterEducationLevel::where('name', $filter['value'])->value('id');
                        if ($levelID) {
                            $levelIDs[] = $levelID;
                        }
                    }
                }

                if ($filter['filterKey'] === 'workAuthorisationCounts') {
                    if ($filter['value'] === 'Yes') {
                        $workAuthorisationFilters[] = 1;
                    } elseif ($filter['value'] === 'No') {
                        $workAuthorisationFilters[] = 2;
                    } elseif ($filter['value'] === 'Other Work Authorisation') {
                        $workAuthorisationFilters[] = 'others';
                    }
                }

                if ($filter['filterKey'] === 'interviewPerformanceCounts') {
                    $performanceKey = array_search($filter['value'], $interviewPerformanceMapping);
                    if ($performanceKey !== false) {
                        $interviewPerformanceKeys[] = $performanceKey;
                    } elseif ($filter['value'] === "Other") {
                        $interviewPerformanceKeys[] = "other";
                    }
                }

                foreach ($filters as $filter) {
                    if (isset($filter['filterKey']) && $filter['filterKey'] === 'workExperienceCounts') {
                        $workExperienceKeys[] = $filter['value'];
                    }
                }

                if ($filter['filterKey'] === 'omrLevelCounts') {
                    $levelKey = array_search($filter['value'], $omrLevelMapping);
                    if ($levelKey !== false) {
                        $omrLevelKeys[] = $levelKey;
                    } elseif ($filter['value'] === "Technical Assessment Not Completed") {
                        $omrLevelKeys[] = "not_completed"; // Special handling for missing results
                    }
                }

                if ($filter['filterKey'] === 'bfrLevelCounts') {
                    $levelKey = array_search($filter['value'], $bfrLevelMapping);
                    if ($levelKey !== false) {
                        $bfrLevelKeys[] = $levelKey;
                    } elseif ($filter['value'] === "Technical Assessment Not Completed") {
                        $bfrLevelKeys[] = "not_completed"; // Special handling for missing results
                    }
                }

                if ($filter['filterKey'] === 'taLevelCounts') {
                    $levelKey = array_search($filter['value'], $taLevelMapping);
                    if ($levelKey !== false) {
                        $taLevelKeys[] = $levelKey;
                    } elseif ($filter['value'] === "Technical Assessment Not Completed") {
                        $taLevelKeys[] = "not_completed"; // Special handling for missing results
                    }
                }

                if ($filter['filterKey'] === 'ssmrLevelCounts') {
                    $levelKey = array_search($filter['value'], $ssmrLevelMapping);
                    if ($levelKey !== false) {
                        $ssmrLevelKeys[] = $levelKey;
                    } elseif ($filter['value'] === "Technical Assessment Not Completed") {
                        $ssmrLevelKeys[] = "not_completed"; // Special handling for missing results
                    }
                }

                if ($filter['filterKey'] === 'jmrLevelCounts') {
                    $levelKey = array_search($filter['value'], $jmrLevelMapping);
                    if ($levelKey !== false) {
                        $jmrLevelKeys[] = $levelKey;
                    } elseif ($filter['value'] === "Technical Assessment Not Completed") {
                        $jmrLevelKeys[] = "not_completed"; // Special handling for missing results
                    }
                }

                if ($filter['filterKey'] === 'catLevelCounts') {
                    $levelKey = array_search($filter['value'], $catLevelMapping);
                    if ($levelKey !== false) {
                        $catLevelKeys[] = $levelKey;
                    } elseif ($filter['value'] === "Technical Assessment Not Completed") {
                        $catLevelKeys[] = "not_completed"; // Special handling for missing results
                    }
                }

                if ($filter['filterKey'] === 'gpLevelCounts') {
                    $levelKey = array_search($filter['value'], $gpLevelMapping);
                    if ($levelKey !== false) {
                        $gpLevelKeys[] = $levelKey;
                    } elseif ($filter['value'] === "Technical Assessment Not Completed") {
                        $gpLevelKeys[] = "not_completed"; // Special handling for missing results
                    }
                }


                if ($filter['filterKey'] === 'rciLevelCounts') {
                    $levelKey = array_search($filter['value'], $rciLevelMapping);
                    if ($levelKey !== false) {
                        $rciLevelKeys[] = $levelKey;
                    } elseif ($filter['value'] === "Technical Assessment Not Completed") {
                        $rciLevelKeys[] = "not_completed"; // Special handling for missing results
                    }
                }

                if ($filter['filterKey'] === 'frLevelCounts') {
                    $levelKey = array_search($filter['value'], $frLevelMapping);
                    if ($levelKey !== false) {
                        $frLevelKeys[] = $levelKey;
                    } elseif ($filter['value'] === "Technical Assessment Not Completed") {
                        $frLevelKeys[] = "not_completed"; // Special handling for missing results
                    }
                }

                if ($filter['filterKey'] === 'wafLevelCounts') {
                    $levelKey = array_search($filter['value'], $wafLevelMapping);
                    if ($levelKey !== false) {
                        $wafLevelKeys[] = $levelKey;
                    } elseif ($filter['value'] === "Technical Assessment Not Completed") {
                        $wafLevelKeys[] = "not_completed"; // Special handling for missing results
                    }
                }

                if ($filter['filterKey'] === 'oceanStatusCounts') {
                    if ($filter['value'] === 'Completed') {
                        $oceanAssessmentKeys[] = 1;
                    } elseif ($filter['value'] === 'Not Completed') {
                        $oceanAssessmentKeys[] = 0;
                    }
                }

                if (isset($filter['filterKey']) && $filter['filterKey'] === 'riasecStatusCounts') {
                    if ($filter['value'] === 'Completed') {
                        $riaSecStatusFilters[] = 1;
                    } elseif ($filter['value'] === 'Not Completed') {
                        $riaSecStatusFilters[] = 0;
                    }
                }

                if ($filter['filterKey'] === 'cognitiveAssessmentStatusCounts') {
                    $filterByCognitiveStatus[] = $filter['value']; // Expected: 0 or 1
                }

                if ($filter['filterKey'] === 'technicalAssessmentStatusCounts') {

                    if ($filter['value'] === 'Completed') {
                        $filterByTechnicalStatus[] = 1; 
                    } elseif ($filter['value'] === 'Not Completed') {
                        $filterByTechnicalStatus[] = 0; 
                    }

                    // Expected: 0 or 1
                }
            }

            if (count($statusKeys) > 0) {
                $query->whereIn('job_opening_applications.status', $statusKeys);
            }

            if (!empty($selectionMatrixKeys)) {
                $query->where(function ($query) use ($selectionMatrixKeys) {
                    if (in_array("not_available", $selectionMatrixKeys)) {
                        $keys = array_filter($selectionMatrixKeys, fn($key) => $key !== "not_available");
                        if (!empty($keys)) {
                            $query->whereIn('selection_matrix_level', $keys)
                                  ->orWhereNull('selection_matrix_level');
                        } else {
                            $query->whereNull('selection_matrix_level');
                        }
                    } else {
                        $query->whereIn('selection_matrix_level', $selectionMatrixKeys);
                    }
                });
            }            

            if (!empty($countryIDs) || $filteringOthers) {
                $query->whereHas('user', function ($query) use ($countryIDs, $filteringOthers) {
                    if ($filteringOthers) {
                        $query->where(function ($q) use ($countryIDs) {
                            if (!empty($countryIDs)) {
                                $q->whereIn('country_id', $countryIDs)->orWhereNull('country_id');
                            } else {
                                $q->whereNull('country_id');
                            }
                        });
                    } else {
                        $query->whereIn('country_id', $countryIDs);
                    }
                });
            }

            if (!empty($provinceIDs) || $filteringOthersForLocation) {
                $query->whereHas('user', function ($query) use ($provinceIDs, $filteringOthersForLocation) {
                    if ($filteringOthersForLocation) {
                        $query->where(function ($q) use ($provinceIDs) {
                            if (!empty($countryIDs)) {
                                $q->whereIn('province_id', $countryIDs)->orWhereNull('province_id');
                            } else {
                                $q->whereNull('province_id');
                            }
                        });
                    } else {
                        $query->whereIn('province_id', $provinceIDs);
                    }
                });
            }

            if (!empty($programIDs) || $filteringOthersForEducationProgram) {
                $query->whereHas('user', function ($query) use ($programIDs, $filteringOthersForEducationProgram) {
                    if ($filteringOthersForEducationProgram) {
                        $query->where(function ($q) use ($programIDs) {
                            if (!empty($programIDs)) {
                                $q->whereIn('education_program_id', $programIDs)->orWhereNull('education_program_id');
                            } else {
                                $q->whereNull('education_program_id');
                            }
                        });
                    } else {
                        $query->whereIn('education_program_id', $programIDs);
                    }
                });
            }

            if (!empty($levelIDs) || $filteringOthersForLevel) {
                $query->whereHas('user', function ($query) use ($levelIDs, $filteringOthersForLevel) {
                    if ($filteringOthersForLevel) {
                        $query->where(function ($q) use ($levelIDs) {
                            if (!empty($levelIDs)) {
                                // Ensure both NULL and blank values are checked
                                $q->whereIn('education_level', $levelIDs)
                                    ->orWhereNull('education_level')
                                    ->orWhere('education_level', '');
                            } else {
                                // Filtering "Others" should include blank values
                                $q->whereNull('education_level')
                                    ->orWhere('education_level', '');
                            }
                        });
                    } else {
                        $query->whereIn('education_level', $levelIDs);
                    }
                });
            }

            if (!empty($workAuthorisationFilters)) {
                $query->whereHas('user', function ($query) use ($workAuthorisationFilters) {
                    $query->where(function ($q) use ($workAuthorisationFilters) {
                        if (in_array(1, $workAuthorisationFilters)) {
                            $q->orWhere('work_authorisation', 1);
                        }
                        if (in_array(2, $workAuthorisationFilters)) {
                            $q->orWhere('work_authorisation', 2);
                        }
                        if (in_array('others', $workAuthorisationFilters)) {
                            $q->orWhereNotIn('work_authorisation', [1, 2])->orWhereNull('work_authorisation');
                        }
                    });
                });
            }

            if (!empty($interviewPerformanceKeys)) {
                $query->where(function ($query) use ($interviewPerformanceKeys) {
                    if (in_array("other", $interviewPerformanceKeys)) {
                        // "Other" means not included in the predefined mapping
                        $validKeys = array_keys(config('helpers.interview_performance'));
                        $query->whereNotIn('interview_performance', $validKeys)->orWhereNull('interview_performance');
                    } else {
                        $query->whereIn('interview_performance', $interviewPerformanceKeys);
                    }
                });
            }

            if (!empty($workExperienceKeys)) {
                $query->whereHas('user', function ($query) use ($workExperienceKeys) {
                    $query->where(function ($q) use ($workExperienceKeys) {
                        foreach ($workExperienceKeys as $key) {
                            switch ($key) {
                                case 'None':
                                    // Ensure NULL, 0, and empty values are included
                                    $q->orWhereRaw('(year_of_experience_in_it_sector IS NULL OR year_of_experience_in_it_sector = 0 OR year_of_experience_in_it_sector = "")');
                                    break;
                                case 'Less Than 1 Year':
                                    $q->orWhereBetween('year_of_experience_in_it_sector', [0.1, 0.99]);
                                    break;
                                case '1-2 Years':
                                    $q->orWhereBetween('year_of_experience_in_it_sector', [1, 2]);
                                    break;
                                case '3-5 Years':
                                    $q->orWhereBetween('year_of_experience_in_it_sector', [3, 5]);
                                    break;
                                case '6-8 Years':
                                    $q->orWhereBetween('year_of_experience_in_it_sector', [6, 8]);
                                    break;
                                case '9-10 Years':
                                    $q->orWhereBetween('year_of_experience_in_it_sector', [9, 10]);
                                    break;
                                case 'More than 10 Years':
                                    $q->orWhere('year_of_experience_in_it_sector', '>', 10);
                                    break;
                            }
                        }
                    });
                });
            }

            if (!empty($suitabilityRateKeys)) {
                $query->where(function ($query) use ($suitabilityRateKeys) {
                    foreach ($suitabilityRateKeys as $key) {
                        switch ($key) {
                            case '91%-100%':
                                $query->orWhereBetween('suitability_rate', [91, 100]);
                                break;
                            case '81%-90%':
                                $query->orWhereBetween('suitability_rate', [81, 90]);
                                break;
                            case '71%-80%':
                                $query->orWhereBetween('suitability_rate', [71, 80]);
                                break;
                            case '61%-70%':
                                $query->orWhereBetween('suitability_rate', [61, 70]);
                                break;
                            case '51%-60%':
                                $query->orWhereBetween('suitability_rate', [51, 60]);
                                break;
                            case 'Less than 50%':
                                $query->orWhere('suitability_rate', '<', 50);
                                break;
                        }
                    }
                });
            }

            if (!empty($omrLevelKeys)) {
                $query->whereHas('user', function ($query) use ($omrLevelKeys) {
                    $query->leftJoinSub(
                        DB::table('user_results')
                            ->select('user_id', DB::raw('MAX(level) as max_level'))
                            ->where('result_type', 'overall_match_rate')
                            ->groupBy('user_id'),
                        'user_max_levels',
                        'users.id',
                        '=',
                        'user_max_levels.user_id'
                    );

                    $query->select('users.id', DB::raw("COALESCE(user_max_levels.max_level, -1) as omr_level"))
                        ->groupBy('users.id');

                    if (in_array(0, $omrLevelKeys)) {
                        if (count($omrLevelKeys) > 1) {
                            // If "Technical Assessment Not Completed" is selected, include both NULL and selected levels
                            $query->havingRaw("(COALESCE(MAX(omr_level), -1) = -1 OR MAX(omr_level) IN (" . implode(',', array_filter($omrLevelKeys, fn($key) => $key !== 0)) . "))");
                        } else {
                            $query->havingRaw("COALESCE(MAX(omr_level), -1) = -1");
                        }
                    } else {
                        // Normal filtering when "Technical Assessment Not Completed" is NOT selected
                        $query->havingRaw("MAX(omr_level) IN (" . implode(',', $omrLevelKeys) . ")");
                    }
                });
            }

            if (!empty($bfrLevelKeys)) {
                $query->whereHas('user', function ($query) use ($bfrLevelKeys) {
                    $query->leftJoinSub(
                        DB::table('user_results')
                            ->select(
                                'user_id',
                                DB::raw("
                                    MAX(
                                        CASE
                                            WHEN result_type = 'soft_skill_score' THEN
                                                CASE
                                                    WHEN percentage > 59 THEN 5
                                                    WHEN percentage > 45 THEN 4
                                                    WHEN percentage > 30 THEN 3
                                                    WHEN percentage > 16 THEN 2
                                                    ELSE 1
                                                END
                                            ELSE NULL
                                        END
                                    ) as bfr_level
                                ")
                            )
                            ->groupBy('user_id'),
                        'user_bfr_levels',
                        'users.id',
                        '=',
                        'user_bfr_levels.user_id'
                    );

                    $query->select('users.id', DB::raw("COALESCE(user_bfr_levels.bfr_level, 0) as bfr_level"))
                        ->groupBy('users.id');

                    if (in_array(0, $bfrLevelKeys)) {
                        if (count($bfrLevelKeys) > 1) {
                            // Include both Data Not Available and selected levels
                            $query->havingRaw("(COALESCE(MAX(bfr_level), 0) = 0 OR MAX(bfr_level) IN (" . implode(',', array_filter($bfrLevelKeys, fn($key) => $key !== 0)) . "))");
                        } else {
                            $query->havingRaw("COALESCE(MAX(bfr_level), 0) = 0");
                        }
                    } else {
                        $query->havingRaw("MAX(bfr_level) IN (" . implode(',', $bfrLevelKeys) . ")");
                    }
                });
            }

            if (!empty($taLevelKeys)) {
                $query->whereHas('user', function ($query) use ($taLevelKeys) {
                    $query->leftJoinSub(
                        DB::table('user_results')
                            ->select('user_id', DB::raw('MAX(level) as ta_level'))
                            ->where('assessment_type', 'technical')
                            ->where('result_type', 'overall')
                            ->groupBy('user_id'),
                        'user_ta_levels',
                        'users.id',
                        '=',
                        'user_ta_levels.user_id'
                    );

                    $query->select('users.id', DB::raw('COALESCE(user_ta_levels.ta_level, 0) as ta_level'))
                        ->groupBy('users.id');

                    if (in_array(0, $taLevelKeys)) {
                        if (count($taLevelKeys) > 1) {
                            $query->havingRaw("(COALESCE(MAX(ta_level), 0) = 0 OR MAX(ta_level) IN (" . implode(',', array_filter($taLevelKeys, fn($key) => $key !== 0)) . "))");
                        } else {
                            $query->havingRaw("COALESCE(MAX(ta_level), 0) = 0");
                        }
                    } else {
                        $query->havingRaw("MAX(ta_level) IN (" . implode(',', $taLevelKeys) . ")");
                    }
                });
            }

            if (!empty($ssmrLevelKeys)) {
                $query->whereHas('user', function ($query) use ($ssmrLevelKeys) {
                    $query->leftJoinSub(
                        DB::table('user_results')
                            ->select('user_id', DB::raw('MAX(level) as ssmr_level'))
                            ->where('result_type', 'ccs_match_rate')
                            ->groupBy('user_id'),
                        'user_ssmr_levels',
                        'users.id',
                        '=',
                        'user_ssmr_levels.user_id'
                    );

                    $query->select('users.id', DB::raw('COALESCE(user_ssmr_levels.ssmr_level, 0) as ssmr_level'))
                        ->groupBy('users.id');

                    if (in_array(0, $ssmrLevelKeys)) {
                        if (count($ssmrLevelKeys) > 1) {
                            $query->havingRaw("(COALESCE(MAX(ssmr_level), 0) = 0 OR MAX(ssmr_level) IN (" . implode(',', array_filter($ssmrLevelKeys, fn($key) => $key !== 0)) . "))");
                        } else {
                            $query->havingRaw("COALESCE(MAX(ssmr_level), 0) = 0");
                        }
                    } else {
                        $query->havingRaw("MAX(ssmr_level) IN (" . implode(',', $ssmrLevelKeys) . ")");
                    }
                });
            }

            if (!empty($jmrLevelKeys)) {
                $query->whereHas('user', function ($query) use ($jmrLevelKeys) {
                    $query->leftJoinSub(
                        DB::table('user_results')
                            ->select('user_id', DB::raw('MAX(level) as jmr_level'))
                            ->where('result_type', 'jmr')
                            ->groupBy('user_id'),
                        'user_jmr_levels',
                        'users.id',
                        '=',
                        'user_jmr_levels.user_id'
                    );

                    $query->select('users.id', DB::raw('COALESCE(user_jmr_levels.jmr_level, 0) as jmr_level'))
                        ->groupBy('users.id');

                    if (in_array(0, $jmrLevelKeys)) {
                        if (count($jmrLevelKeys) > 1) {
                            $query->havingRaw("(COALESCE(MAX(jmr_level), 0) = 0 OR MAX(jmr_level) IN (" . implode(',', array_filter($jmrLevelKeys, fn($key) => $key !== 0)) . "))");
                        } else {
                            $query->havingRaw("COALESCE(MAX(jmr_level), 0) = 0");
                        }
                    } else {
                        $query->havingRaw("MAX(jmr_level) IN (" . implode(',', $jmrLevelKeys) . ")");
                    }
                });
            }

            if (!empty($catLevelKeys)) {
                $query->whereHas('user', function ($query) use ($catLevelKeys) {
                    $query->leftJoinSub(
                        DB::table('user_results')
                            ->select('user_id', DB::raw('MAX(level) as cat_level'))
                            ->where('assessment_type', 'cognitive')
                            ->where('result_type', 'overall')
                            ->groupBy('user_id'),
                        'user_cat_levels',
                        'users.id',
                        '=',
                        'user_cat_levels.user_id'
                    );

                    $query->select('users.id', DB::raw('COALESCE(user_cat_levels.cat_level, 0) as cat_level'))
                        ->groupBy('users.id');

                    if (in_array(0, $catLevelKeys)) {
                        if (count($catLevelKeys) > 1) {
                            $query->havingRaw("(COALESCE(MAX(cat_level), 0) = 0 OR MAX(cat_level) IN (" . implode(',', array_filter($catLevelKeys, fn($key) => $key !== 0)) . "))");
                        } else {
                            $query->havingRaw("COALESCE(MAX(cat_level), 0) = 0");
                        }
                    } else {
                        $query->havingRaw("MAX(cat_level) IN (" . implode(',', $catLevelKeys) . ")");
                    }
                });
            }

            if (!empty($gpLevelKeys)) {
                $query->whereHas('user', function ($query) use ($gpLevelKeys) {
                    $query->leftJoinSub(
                        DB::table('user_results')
                            ->select('user_id', DB::raw('MAX(level) as gp_level'))
                            ->where('result_type', 'growth_potential')
                            ->groupBy('user_id'),
                        'user_gp_levels',
                        'users.id',
                        '=',
                        'user_gp_levels.user_id'
                    );

                    $query->select('users.id', DB::raw('COALESCE(user_gp_levels.gp_level, 0) as gp_level'))
                        ->groupBy('users.id');

                    if (in_array(0, $gpLevelKeys)) {
                        if (count($gpLevelKeys) > 1) {
                            $query->havingRaw("(COALESCE(MAX(gp_level), 0) = 0 OR MAX(gp_level) IN (" . implode(',', array_filter($gpLevelKeys, fn($key) => $key !== 0)) . "))");
                        } else {
                            $query->havingRaw("COALESCE(MAX(gp_level), 0) = 0");
                        }
                    } else {
                        $query->havingRaw("MAX(gp_level) IN (" . implode(',', $gpLevelKeys) . ")");
                    }
                });
            }

            if (!empty($rciLevelKeys)) {
                $query->whereHas('user', function ($query) use ($rciLevelKeys) {
                    $query->leftJoinSub(
                        DB::table('user_results')
                            ->select('user_id', DB::raw('MAX(level) as rci_level'))
                            ->where('result_type', 'rci')
                            ->groupBy('user_id'),
                        'user_rci_levels',
                        'users.id',
                        '=',
                        'user_rci_levels.user_id'
                    );

                    $query->select('users.id', DB::raw('COALESCE(user_rci_levels.rci_level, 0) as rci_level'))
                        ->groupBy('users.id');

                    if (in_array(0, $rciLevelKeys)) {
                        if (count($rciLevelKeys) > 1) {
                            $query->havingRaw("(COALESCE(MAX(rci_level), 0) = 0 OR MAX(rci_level) IN (" . implode(',', array_filter($rciLevelKeys, fn($key) => $key !== 0)) . "))");
                        } else {
                            $query->havingRaw("COALESCE(MAX(rci_level), 0) = 0");
                        }
                    } else {
                        $query->havingRaw("MAX(rci_level) IN (" . implode(',', $rciLevelKeys) . ")");
                    }
                });
            }

            if (!empty($frLevelKeys)) {
                $query->whereHas('user', function ($query) use ($frLevelKeys) {
                    $query->leftJoinSub(
                        DB::table('user_results')
                            ->select('user_id', DB::raw('MAX(level) as fr_level'))
                            ->where('result_type', 'flight_risk')
                            ->groupBy('user_id'),
                        'user_fr_levels',
                        'users.id',
                        '=',
                        'user_fr_levels.user_id'
                    );

                    $query->select('users.id', DB::raw('COALESCE(user_fr_levels.fr_level, 0) as fr_level'))
                        ->groupBy('users.id');

                    if (in_array(0, $frLevelKeys)) {
                        if (count($frLevelKeys) > 1) {
                            $query->havingRaw("(COALESCE(MAX(fr_level), 0) = 0 OR MAX(fr_level) IN (" . implode(',', array_filter($frLevelKeys, fn($key) => $key !== 0)) . "))");
                        } else {
                            $query->havingRaw("COALESCE(MAX(fr_level), 0) = 0");
                        }
                    } else {
                        $query->havingRaw("MAX(fr_level) IN (" . implode(',', $frLevelKeys) . ")");
                    }
                });
            }

            if (!empty($wafLevelKeys)) {
                $query->whereHas('user', function ($query) use ($wafLevelKeys) {
                    $query->leftJoinSub(
                        DB::table('user_results')
                            ->select('user_id', DB::raw('MAX(level) as waf_level'))
                            ->where('result_type', 'organizational_fit_forecast')
                            ->groupBy('user_id'),
                        'user_waf_levels',
                        'users.id',
                        '=',
                        'user_waf_levels.user_id'
                    );

                    $query->select('users.id', DB::raw('COALESCE(user_waf_levels.waf_level, 0) as waf_level'))
                        ->groupBy('users.id');

                    if (in_array(0, $wafLevelKeys)) {
                        if (count($wafLevelKeys) > 1) {
                            $query->havingRaw("(COALESCE(MAX(waf_level), 0) = 0 OR MAX(waf_level) IN (" . implode(',', array_filter($wafLevelKeys, fn($key) => $key !== 0)) . "))");
                        } else {
                            $query->havingRaw("COALESCE(MAX(waf_level), 0) = 0");
                        }
                    } else {
                        $query->havingRaw("MAX(waf_level) IN (" . implode(',', $wafLevelKeys) . ")");
                    }
                });
            }

            if (!empty($salaryRangesKeys)) {
                $query->where(function ($query) use ($salaryRangesKeys) {
                    foreach ($salaryRangesKeys as $range) {
                        switch ($range) {
                            case 'Less than 1000':
                                $query->orWhere('expected_salary', '<', 1000);
                                break;
                            case '1000-5000':
                                $query->orWhereBetween('expected_salary', [1000, 5000]);
                                break;
                            case '5001-10000':
                                $query->orWhereBetween('expected_salary', [5001, 10000]);
                                break;
                            case '10001-15000':
                                $query->orWhereBetween('expected_salary', [10001, 15000]);
                                break;
                            case '15001-20000':
                                $query->orWhereBetween('expected_salary', [15001, 20000]);
                                break;
                            case 'Greater than 20000':
                                $query->orWhere('expected_salary', '>', 20000);
                                break;
                            case 'Other':
                                $query->orWhereNull('expected_salary');
                                break;
                        }
                    }
                });
            }

            if (!empty($oceanAssessmentKeys)) {
                $query->whereHas('user', function ($q) use ($oceanAssessmentKeys) {
                    $q->whereIn('is_personality_motivation_completed', $oceanAssessmentKeys);
                });
            }

            if (!empty($riaSecStatusFilters)) {
                $query->whereHas('user', function ($q) use ($riaSecStatusFilters) {
                    $q->whereIn('is_work_interest_completed', $riaSecStatusFilters);
                });
            }

            // Cognitive Assessment Status filter
            if (!empty($filterByCognitiveStatus)) {
                $query->whereHas('user', function ($query) use ($filterByCognitiveStatus) {
                    $query->whereIn('is_cognitive_ability_completed', $filterByCognitiveStatus);
                });
            }

            // Technical Assessment Status filter
            if (!empty($filterByTechnicalStatus)) {
                $query->whereIn('technical_assessment_completed', $filterByTechnicalStatus);
            }
        }

        if ($request->has('applicantTitle')) {
            $searchTerm = $request->applicantTitle;
            if (!empty($searchTerm) && $searchTerm != '') {
                $query->whereHas('user', function ($query) use ($searchTerm) {
                    $query->where(function ($q) use ($searchTerm) {
                        $q->where('name', 'LIKE', "%{$searchTerm}%")  // Full Name
                            ->orWhere('first_name', 'LIKE', "%{$searchTerm}%") // First Name
                            ->orWhere('last_name', 'LIKE', "%{$searchTerm}%"); // Last Name
                    });
                });
            }
        }

        return $query;
    }

    public function getStatusLabelAttribute()
    {
        $statusLabels = config('helpers.application_status');  // Load the status labels from the config file

        return $statusLabels[$this->status] ?? 'N/A'; // Default to 'Unknown' if the status doesn't match
    }

    public function getApplicationStatusColorAttribute()
    {
        $statusLabels = config('helpers.application_status_colors');  // Load the status labels from the config file

        return $statusLabels[$this->status] ?? 'N/A'; // Default to 'Unknown' if the status doesn't match
    }

    public function getInterviewPerformanceLabelAttribute()
    {
        $statusLabels = config('helpers.interview_performance');  // Load the status labels from the config file

        return $statusLabels[$this->interview_performance] ?? 'N/A'; // Default to 'Unknown' if the status doesn't match
    }


    public static function getStatusCountsForTabs($jobOpeningId, $tab, $pageType)
    {
        $statuses = config('helpers.application_status');

        // Initialize all statuses with 0 count
        $formattedStatusCounts = array_fill_keys(array_values($statuses), 0);

        // Fetch actual status counts from the database
        $statusCounts = self::where('job_opening_id', $jobOpeningId)->where('application_status',1)
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

          
        // Map actual counts to predefined labels
        foreach ($statusCounts as $key => $count) {
            
            if (isset($statuses[$key])) {
                $formattedStatusCounts[$statuses[$key]] = $count;
            }
        }

        return $formattedStatusCounts;
    }

    /**
     * Get the status counts for a specific Job Opening.
     */
    public static function getStatusCounts($jobOpeningId, $tab, $pageType)
    {
        $statuses = config('helpers.application_status');

        // Initialize all statuses with 0 count
        $formattedStatusCounts = array_fill_keys(array_values($statuses), 0);

        // Fetch actual status counts from the database
        $statusCounts = self::where('job_opening_id', $jobOpeningId)->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
            return $query->when($tab == 8, function ($q) {
                return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
            }, function ($q) use ($tab) {
                return $q->where('job_opening_applications.status', $tab);
            })->where('application_status', '=', 1);
        }, function ($query) use ($tab) {
            return $query->where('application_status', $tab);
        })
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Map actual counts to predefined labels
        foreach ($statusCounts as $key => $count) {
            if (isset($statuses[$key])) {
                $formattedStatusCounts[$statuses[$key]] = $count;
            }
        }

        return $formattedStatusCounts;
    }

    public static function getSelectionMatrixCounts($jobOpeningId, $tab)
    {
        $labels = config('helpers.selection_matrix_levels');
        $counts = array_fill_keys(array_values($labels), 0);
        $counts['Data Not Available'] = 0;

        $case = "CASE ";
        foreach ($labels as $key => $label) {
            $case .= "WHEN selection_matrix_level = $key THEN \"$label\" ";
        }
        $case .= "ELSE \"Data Not Available\" END";

        $rawCounts = self::where('job_opening_id', $jobOpeningId)
            ->where('application_status', $tab)
            ->select(DB::raw("$case as selection_label"), DB::raw("COUNT(*) as count"))
            ->groupBy(DB::raw($case))
            ->pluck('count', 'selection_label')
            ->toArray();

        foreach ($rawCounts as $label => $count) {
            $counts[$label] = $count;
        }

        return $counts;
    }


    /**
     * Get the country counts for a specific Job Opening.
     */
    public static function getCountryCounts($jobOpeningId, $tab, $pageType)
    {
        return self::where('job_opening_id', $jobOpeningId)->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
            return $query->when($tab == 8, function ($q) {
                return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
            }, function ($q) use ($tab) {
                return $q->where('job_opening_applications.status', $tab);
            })
                ->where('application_status', '=', 1);
        }, function ($query) use ($tab) {
            return $query->where('application_status', $tab);
        })
            ->select(
                DB::raw('COALESCE(master_countries.name, "Others") as nationality'),
                DB::raw('COUNT(*) as count')
            )
            ->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->leftJoin('master_countries', 'users.country_id', '=', 'master_countries.id')
            ->groupBy('nationality')
            ->pluck('count', 'nationality')
            ->toArray();
    }


    public static function getCurrentLocationCounts($jobOpeningId, $tab, $pageType)
    {
        return self::where('job_opening_id', $jobOpeningId)
            ->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
                return $query->when($tab == 8, function ($q) {
                    return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
                }, function ($q) use ($tab) {
                    return $q->where('job_opening_applications.status', $tab);
                })
                    ->where('application_status', '=', 1);
            }, function ($query) use ($tab) {
                return $query->where('application_status', $tab);
            })
            ->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->leftJoin('provinces', 'users.province_id', '=', 'provinces.id')
            ->select(
                DB::raw('IFNULL(provinces.name, "Others") as current_location'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('current_location')
            ->pluck('count', 'current_location')
            ->toArray();
    }


    public static function getWorkAuthorisationCounts($jobOpeningId, $tab, $pageType)
    {
        // Fetch work authorisation labels dynamically from config
        $workAuthLabels = config('helpers.work_authorisation');

        // Initialize all categories with 0 count
        $workAuthCounts = array_fill_keys($workAuthLabels, 0);
        $workAuthCounts["Other Work Authorisation"] = 0; // Ensure "Other Work Authorisation" is included

        // Dynamically generate CASE statement
        $caseStatement = "CASE ";
        foreach ($workAuthLabels as $key => $label) {
            $caseStatement .= "WHEN users.work_authorisation = $key THEN \"$label\" ";
        }
        $caseStatement .= "ELSE \"Other Work Authorisation\" END";

        // Fetch actual counts from the database
        $rawWorkAuthCounts = self::where('job_opening_id', $jobOpeningId)->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
            return $query->when($tab == 8, function ($q) {
                return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
            }, function ($q) use ($tab) {
                return $q->where('job_opening_applications.status', $tab);
            })
                ->where('application_status', '=', 1);
        }, function ($query) use ($tab) {
            return $query->where('application_status', $tab);
        })
            ->select(DB::raw("$caseStatement as work_authorisation"), DB::raw('COUNT(*) as count'))
            ->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->groupBy(DB::raw($caseStatement)) // Use case statement without alias in GROUP BY
            ->pluck('count', 'work_authorisation')
            ->toArray();

        // Merge actual counts into predefined categories
        foreach ($rawWorkAuthCounts as $key => $count) {
            $workAuthCounts[$key] = $count;
        }

        return $workAuthCounts;
    }

    public static function getInterviewPerformanceCounts($jobOpeningId, $tab, $pageType)
    {
        // Fetch interview performance labels from the config
        $performanceLabels = config('helpers.interview_performance');

        // Initialize all categories with 0 count
        $performanceCounts = array_fill_keys($performanceLabels, 0);

        // Dynamically generate CASE statement
        $caseStatement = "CASE ";
        foreach ($performanceLabels as $key => $label) {
            $caseStatement .= "WHEN interview_performance = $key THEN \"$label\" ";
        }
        $caseStatement .= "ELSE \"Other\" END as interview_performance";

        // Fetch actual counts
        $rawPerformanceCounts = self::where('job_opening_id', $jobOpeningId)->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
            return $query->when($tab == 8, function ($q) {
                return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
            }, function ($q) use ($tab) {
                return $q->where('job_opening_applications.status', $tab);
            })
                ->where('application_status', '=', 1);
        }, function ($query) use ($tab) {
            return $query->where('application_status', $tab);
        })
            ->select(DB::raw($caseStatement), DB::raw('COUNT(*) as count'))
            ->groupBy('interview_performance')
            ->pluck('count', 'interview_performance')
            ->toArray();

        // Merge actual counts with predefined categories
        foreach ($rawPerformanceCounts as $key => $count) {
            $performanceCounts[$key] = $count;
        }

        return $performanceCounts;
    }

    public static function getCatLevelCounts($jobOpeningId, $tab, $pageType)
    {
        // Fetch cognitive ability levels from config
        $catLevelLabels = config('helpers.cognitive_ability_levels');

        // Initialize all categories with 0 count
        $catLevelCounts = array_fill_keys($catLevelLabels, 0);

        // Generate the dynamic CASE statement
        $caseStatement = "CASE ";
        foreach ($catLevelLabels as $level => $label) {
            $caseStatement .= "WHEN user_max_levels.max_level = $level THEN \"$label\" ";
        }
        $caseStatement .= "ELSE \"Data Not Available\" END";

        // Fetch actual counts from the database
        $rawCatLevelCounts = self::where('job_opening_id', $jobOpeningId)->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
            return $query->when($tab == 8, function ($q) {
                return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
            }, function ($q) use ($tab) {
                return $q->where('job_opening_applications.status', $tab);
            })
                ->where('application_status', '=', 1);
        }, function ($query) use ($tab) {
            return $query->where('application_status', $tab);
        })
            ->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->leftJoinSub(
                DB::table('user_results')
                    ->select('user_results.user_id', DB::raw('MAX(user_results.level) as max_level'))
                    ->where('user_results.assessment_type', 'cognitive')
                    ->where('user_results.result_type', 'overall')
                    ->groupBy('user_results.user_id'),
                'user_max_levels',
                'users.id',
                '=',
                'user_max_levels.user_id'
            )
            ->select(DB::raw("$caseStatement as cat_level_label"), DB::raw('COUNT(DISTINCT job_opening_applications.user_id) as count'))
            ->groupBy(DB::raw($caseStatement)) // Correct usage of GROUP BY
            ->pluck('count', 'cat_level_label')
            ->toArray();

        // Merge actual counts into predefined categories
        foreach ($rawCatLevelCounts as $key => $count) {
            $catLevelCounts[$key] = $count;
        }

        return $catLevelCounts;
    }

    public static function getRciLevelCounts($jobOpeningId, $tab, $pageType)
    {
        // Fetch cognitive ability levels from config
        $rciLevelLabels = config('helpers.rci_levels');

        // Initialize all categories with 0 count
        $rciLevelCounts = array_fill_keys($rciLevelLabels, 0);

        // Generate the dynamic CASE statement
        $caseStatement = "CASE ";
        foreach ($rciLevelLabels as $level => $label) {
            $caseStatement .= "WHEN user_max_levels.max_level = $level THEN \"$label\" ";
        }
        $caseStatement .= "ELSE \"Data Not Available\" END";

        // Fetch actual counts from the database
        $rawRciLevelCounts = self::where('job_opening_id', $jobOpeningId)->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
            return $query->when($tab == 8, function ($q) {
                return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
            }, function ($q) use ($tab) {
                return $q->where('job_opening_applications.status', $tab);
            })
                ->where('application_status', '=', 1);
        }, function ($query) use ($tab) {
            return $query->where('application_status', $tab);
        })
            ->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->leftJoinSub(
                DB::table('user_results')
                    ->select('user_results.user_id', DB::raw('MAX(user_results.level) as max_level'))
                    ->where('user_results.result_type', 'rci')
                    ->groupBy('user_results.user_id'),
                'user_max_levels',
                'users.id',
                '=',
                'user_max_levels.user_id'
            )
            ->select(DB::raw("$caseStatement as rci_level_label"), DB::raw('COUNT(DISTINCT job_opening_applications.user_id) as count'))
            ->groupBy(DB::raw($caseStatement)) // Correct usage of GROUP BY
            ->pluck('count', 'rci_level_label')
            ->toArray();

        // Merge actual counts into predefined categories
        foreach ($rawRciLevelCounts as $key => $count) {
            $rciLevelCounts[$key] = $count;
        }

        return $rciLevelCounts;
    }

    public static function getFrLevelCounts($jobOpeningId, $tab, $pageType)
    {
        // Fetch cognitive ability levels from config
        $frLevelLabels = config('helpers.flight_risk_levels');

        // Initialize all categories with 0 count
        $frLevelCounts = array_fill_keys($frLevelLabels, 0);

        // Generate the dynamic CASE statement
        $caseStatement = "CASE ";
        foreach ($frLevelLabels as $level => $label) {
            $caseStatement .= "WHEN user_max_levels.max_level = $level THEN \"$label\" ";
        }
        $caseStatement .= "ELSE \"Data Not Available\" END";

        // Fetch actual counts from the database
        $rawRciLevelCounts = self::where('job_opening_id', $jobOpeningId)->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
            return $query->when($tab == 8, function ($q) {
                return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
            }, function ($q) use ($tab) {
                return $q->where('job_opening_applications.status', $tab);
            })
                ->where('application_status', '=', 1);
        }, function ($query) use ($tab) {
            return $query->where('application_status', $tab);
        })
            ->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->leftJoinSub(
                DB::table('user_results')
                    ->select('user_results.user_id', DB::raw('MAX(user_results.level) as max_level'))
                    ->where('user_results.result_type', 'flight_risk')
                    ->groupBy('user_results.user_id'),
                'user_max_levels',
                'users.id',
                '=',
                'user_max_levels.user_id'
            )
            ->select(DB::raw("$caseStatement as fr_level_label"), DB::raw('COUNT(DISTINCT job_opening_applications.user_id) as count'))
            ->groupBy(DB::raw($caseStatement)) // Correct usage of GROUP BY
            ->pluck('count', 'fr_level_label')
            ->toArray();

        // Merge actual counts into predefined categories
        foreach ($rawRciLevelCounts as $key => $count) {
            $frLevelCounts[$key] = $count;
        }

        return $frLevelCounts;
    }

    public static function getOmrLevelCounts($jobOpeningId, $tab, $pageType)
    {
        // Fetch cognitive ability levels from config
        $frLevelLabels = config('helpers.overall_match_rate_levels');

        // Initialize all categories with 0 count
        $frLevelCounts = array_fill_keys($frLevelLabels, 0);

        // Generate the dynamic CASE statement
        $caseStatement = "CASE ";
        foreach ($frLevelLabels as $level => $label) {
            $caseStatement .= "WHEN user_max_levels.max_level = $level THEN \"$label\" ";
        }
        $caseStatement .= "ELSE \"Technical Assessment Not Completed\" END";

        // Fetch actual counts from the database
        $rawRciLevelCounts = self::where('job_opening_id', $jobOpeningId)->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
            return $query->when($tab == 8, function ($q) {
                return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
            }, function ($q) use ($tab) {
                return $q->where('job_opening_applications.status', $tab);
            })
                ->where('application_status', '=', 1);
        }, function ($query) use ($tab) {
            return $query->where('application_status', $tab);
        })
            ->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->leftJoinSub(
                DB::table('user_results')
                    ->select('user_results.user_id', DB::raw('MAX(user_results.level) as max_level'))
                    ->where('user_results.result_type', 'overall_match_rate')
                    ->groupBy('user_results.user_id'),
                'user_max_levels',
                'users.id',
                '=',
                'user_max_levels.user_id'
            )
            ->select(DB::raw("$caseStatement as omr_level_label"), DB::raw('COUNT(DISTINCT job_opening_applications.user_id) as count'))
            ->groupBy(DB::raw($caseStatement)) // Correct usage of GROUP BY
            ->pluck('count', 'omr_level_label')
            ->toArray();

        // Merge actual counts into predefined categories
        foreach ($rawRciLevelCounts as $key => $count) {
            $frLevelCounts[$key] = $count;
        }

        return $frLevelCounts;
    }

    public static function getTaLevelCounts($jobOpeningId, $tab, $pageType)
    {
        // Fetch cognitive ability levels from config
        $frLevelLabels = config('helpers.technical_assessment_levels');

        // Initialize all categories with 0 count
        $frLevelCounts = array_fill_keys($frLevelLabels, 0);

        // Generate the dynamic CASE statement
        $caseStatement = "CASE ";
        foreach ($frLevelLabels as $level => $label) {
            $caseStatement .= "WHEN user_max_levels.max_level = $level THEN \"$label\" ";
        }
        $caseStatement .= "ELSE \"Technical Assessment Not Completed\" END";

        // Fetch actual counts from the database
        $rawRciLevelCounts = self::where('job_opening_id', $jobOpeningId)->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
            return $query->when($tab == 8, function ($q) {
                return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
            }, function ($q) use ($tab) {
                return $q->where('job_opening_applications.status', $tab);
            })
                ->where('application_status', '=', 1);
        }, function ($query) use ($tab) {
            return $query->where('application_status', $tab);
        })
            ->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->leftJoinSub(
                DB::table('user_results')
                    ->select('user_results.user_id', DB::raw('MAX(user_results.level) as max_level'))
                    ->where('user_results.result_type', 'overall')
                    ->where('assessment_type', 'technical')
                    ->groupBy('user_results.user_id'),
                'user_max_levels',
                'users.id',
                '=',
                'user_max_levels.user_id'
            )
            ->select(DB::raw("$caseStatement as ta_level_label"), DB::raw('COUNT(DISTINCT job_opening_applications.user_id) as count'))
            ->groupBy(DB::raw($caseStatement)) // Correct usage of GROUP BY
            ->pluck('count', 'ta_level_label')
            ->toArray();

        // Merge actual counts into predefined categories
        foreach ($rawRciLevelCounts as $key => $count) {
            $frLevelCounts[$key] = $count;
        }

        return $frLevelCounts;
    }

    public static function getBfrLevelCounts($jobOpeningId, $tab, $pageType)
    {
        // Fetch BFR level labels from config
        $bfrLevelLabels = config('helpers.behavior_fit_rate_levels');

        // Initialize all categories with 0 count
        $bfrLevelCounts = array_fill_keys($bfrLevelLabels, 0);

        // Generate the dynamic CASE statement
        $caseStatement = "CASE ";
        foreach ($bfrLevelLabels as $level => $label) {
            if ((int)$level === 0) {
                $caseStatement .= "WHEN bfr_level IS NULL THEN \"$label\" ";
            } else {
                $caseStatement .= "WHEN bfr_level = $level THEN \"$label\" ";
            }
        }
        $caseStatement .= "ELSE \"Data Not Available\" END";

        // Fetch actual counts
        $rawBfrLevelCounts = self::where('job_opening_id', $jobOpeningId)
            // ->where($pageType == 'hiring-pipeline' ? 'job_opening_applications.status' : 'application_status', $tab)
            ->when(true, function ($query) use ($pageType, $tab) {
                if ($pageType == 'hiring-pipeline') {
                    return $tab == 8
                        ? $query->whereIn('job_opening_applications.status', [8, 9, 10, 11])
                                ->where('application_status', 1)
                        : $query->where('job_opening_applications.status', $tab)
                                ->where('application_status', 1);
                } else {
                    return $query->where('application_status', $tab);
                }
            })
            ->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->leftJoinSub(
                DB::table('user_results')
                    ->select(
                        'user_id',
                        DB::raw("
                            MAX(
                                CASE
                                    WHEN result_type = 'soft_skill_score' THEN
                                        CASE
                                            WHEN percentage > 59 THEN 5
                                            WHEN percentage > 45 THEN 4
                                            WHEN percentage > 30 THEN 3
                                            WHEN percentage > 16 THEN 2
                                            ELSE 1
                                        END
                                    ELSE NULL
                                END
                            ) as bfr_level
                        ")
                    )
                    ->groupBy('user_id'),
                'user_bfr_levels',
                'users.id',
                '=',
                'user_bfr_levels.user_id'
            )
            ->select(DB::raw("$caseStatement as bfr_level_label"), DB::raw('COUNT(DISTINCT job_opening_applications.user_id) as count'))
            ->groupBy(DB::raw($caseStatement))
            ->pluck('count', 'bfr_level_label')
            ->toArray();

        // Merge actual counts into predefined categories
        foreach ($rawBfrLevelCounts as $key => $count) {
            $bfrLevelCounts[$key] = $count;
        }

        return $bfrLevelCounts;
    }

    public static function getSsmrLevelCounts($jobOpeningId, $tab, $pageType)
    {
        // Fetch cognitive ability levels from config
        $frLevelLabels = config('helpers.soft_skill_match_rate_levels');

        // Initialize all categories with 0 count
        $frLevelCounts = array_fill_keys($frLevelLabels, 0);

        // Generate the dynamic CASE statement
        $caseStatement = "CASE ";
        foreach ($frLevelLabels as $level => $label) {
            $caseStatement .= "WHEN user_max_levels.max_level = $level THEN \"$label\" ";
        }
        $caseStatement .= "ELSE \"Technical Assessment Not Completed\" END";

        // Fetch actual counts from the database
        $rawRciLevelCounts = self::where('job_opening_id', $jobOpeningId)->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
            return $query->when($tab == 8, function ($q) {
                return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
            }, function ($q) use ($tab) {
                return $q->where('job_opening_applications.status', $tab);
            })
                ->where('application_status', '=', 1);
        }, function ($query) use ($tab) {
            return $query->where('application_status', $tab);
        })
            ->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->leftJoinSub(
                DB::table('user_results')
                    ->select('user_results.user_id', DB::raw('MAX(user_results.level) as max_level'))
                    ->where('user_results.result_type', 'ccs_match_rate')
                    ->groupBy('user_results.user_id'),
                'user_max_levels',
                'users.id',
                '=',
                'user_max_levels.user_id'
            )
            ->select(DB::raw("$caseStatement as ssmr_level_label"), DB::raw('COUNT(DISTINCT job_opening_applications.user_id) as count'))
            ->groupBy(DB::raw($caseStatement)) // Correct usage of GROUP BY
            ->pluck('count', 'ssmr_level_label')
            ->toArray();

        // Merge actual counts into predefined categories
        foreach ($rawRciLevelCounts as $key => $count) {
            $frLevelCounts[$key] = $count;
        }

        return $frLevelCounts;
    }

    public static function getJmrLevelCounts($jobOpeningId, $tab, $pageType)
    {
        // Fetch cognitive ability levels from config
        $frLevelLabels = config('helpers.job_match_rate_levels');

        // Initialize all categories with 0 count
        $frLevelCounts = array_fill_keys($frLevelLabels, 0);

        // Generate the dynamic CASE statement
        $caseStatement = "CASE ";
        foreach ($frLevelLabels as $level => $label) {
            $caseStatement .= "WHEN user_max_levels.max_level = $level THEN \"$label\" ";
        }
        $caseStatement .= "ELSE \"Technical Assessment Not Completed\" END";

        // Fetch actual counts from the database
        $rawRciLevelCounts = self::where('job_opening_id', $jobOpeningId)->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
            return $query->when($tab == 8, function ($q) {
                return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
            }, function ($q) use ($tab) {
                return $q->where('job_opening_applications.status', $tab);
            })
                ->where('application_status', '=', 1);
        }, function ($query) use ($tab) {
            return $query->where('application_status', $tab);
        })
            ->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->leftJoinSub(
                DB::table('user_results')
                    ->select('user_results.user_id', DB::raw('MAX(user_results.level) as max_level'))
                    ->where('user_results.result_type', 'jmr')
                    ->groupBy('user_results.user_id'),
                'user_max_levels',
                'users.id',
                '=',
                'user_max_levels.user_id'
            )
            ->select(DB::raw("$caseStatement as jmr_level_label"), DB::raw('COUNT(DISTINCT job_opening_applications.user_id) as count'))
            ->groupBy(DB::raw($caseStatement)) // Correct usage of GROUP BY
            ->pluck('count', 'jmr_level_label')
            ->toArray();

        // Merge actual counts into predefined categories
        foreach ($rawRciLevelCounts as $key => $count) {
            $frLevelCounts[$key] = $count;
        }

        return $frLevelCounts;
    }

    public static function getGpLevelCounts($jobOpeningId, $tab, $pageType)
    {
        // Fetch cognitive ability levels from config
        $frLevelLabels = config('helpers.job_match_rate_levels');

        // Initialize all categories with 0 count
        $frLevelCounts = array_fill_keys($frLevelLabels, 0);

        // Generate the dynamic CASE statement
        $caseStatement = "CASE ";
        foreach ($frLevelLabels as $level => $label) {
            $caseStatement .= "WHEN user_max_levels.max_level = $level THEN \"$label\" ";
        }
        $caseStatement .= "ELSE \"Technical Assessment Not Completed\" END";

        // Fetch actual counts from the database
        $rawRciLevelCounts = self::where('job_opening_id', $jobOpeningId)->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
            return $query->when($tab == 8, function ($q) {
                return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
            }, function ($q) use ($tab) {
                return $q->where('job_opening_applications.status', $tab);
            })
                ->where('application_status', '=', 1);
        }, function ($query) use ($tab) {
            return $query->where('application_status', $tab);
        })
            ->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->leftJoinSub(
                DB::table('user_results')
                    ->select('user_results.user_id', DB::raw('MAX(user_results.level) as max_level'))
                    ->where('user_results.result_type', 'growth_potential')
                    ->groupBy('user_results.user_id'),
                'user_max_levels',
                'users.id',
                '=',
                'user_max_levels.user_id'
            )
            ->select(DB::raw("$caseStatement as gp_level_label"), DB::raw('COUNT(DISTINCT job_opening_applications.user_id) as count'))
            ->groupBy(DB::raw($caseStatement)) // Correct usage of GROUP BY
            ->pluck('count', 'gp_level_label')
            ->toArray();

        // Merge actual counts into predefined categories
        foreach ($rawRciLevelCounts as $key => $count) {
            $frLevelCounts[$key] = $count;
        }

        return $frLevelCounts;
    }

    public static function getWafLevelCounts($jobOpeningId, $tab, $pageType)
    {
        // Fetch cognitive ability levels from config
        $frLevelLabels = config('helpers.organizational_fit_forecast_levels');

        // Initialize all categories with 0 count
        $frLevelCounts = array_fill_keys($frLevelLabels, 0);

        // Generate the dynamic CASE statement
        $caseStatement = "CASE ";
        foreach ($frLevelLabels as $level => $label) {
            $caseStatement .= "WHEN user_max_levels.max_level = $level THEN \"$label\" ";
        }
        $caseStatement .= "ELSE \"Technical Assessment Not Completed\" END";

        // Fetch actual counts from the database
        $rawRciLevelCounts = self::where('job_opening_id', $jobOpeningId)->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
            return $query->when($tab == 8, function ($q) {
                return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
            }, function ($q) use ($tab) {
                return $q->where('job_opening_applications.status', $tab);
            })
                ->where('application_status', '=', 1);
        }, function ($query) use ($tab) {
            return $query->where('application_status', $tab);
        })
            ->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->leftJoinSub(
                DB::table('user_results')
                    ->select('user_results.user_id', DB::raw('MAX(user_results.level) as max_level'))
                    ->where('user_results.result_type', 'organizational_fit_forecast')
                    ->groupBy('user_results.user_id'),
                'user_max_levels',
                'users.id',
                '=',
                'user_max_levels.user_id'
            )
            ->select(DB::raw("$caseStatement as waf_level_label"), DB::raw('COUNT(DISTINCT job_opening_applications.user_id) as count'))
            ->groupBy(DB::raw($caseStatement)) // Correct usage of GROUP BY
            ->pluck('count', 'waf_level_label')
            ->toArray();

        // Merge actual counts into predefined categories
        foreach ($rawRciLevelCounts as $key => $count) {
            $frLevelCounts[$key] = $count;
        }

        return $frLevelCounts;
    }

    public static function getWorkExperienceCounts($jobOpeningId, $tab, $pageType)
    {
        // Define work experience ranges
        $experienceRanges = [
            'None' => 'year_of_experience_in_it_sector IS NULL OR year_of_experience_in_it_sector = 0',
            'Less Than 1 Year' => 'year_of_experience_in_it_sector = 1',
            '1-2 Years' => 'year_of_experience_in_it_sector BETWEEN 1 AND 2',
            '3-5 Years' => 'year_of_experience_in_it_sector BETWEEN 3 AND 5',
            '6-8 Years' => 'year_of_experience_in_it_sector BETWEEN 6 AND 8',
            '9-10 Years' => 'year_of_experience_in_it_sector BETWEEN 9 AND 10',
            'More than 10 Years' => 'year_of_experience_in_it_sector > 10'
        ];

        // Initialize all categories with 0 count
        $workExperienceCounts = array_fill_keys(array_keys($experienceRanges), 0);

        // Generate the dynamic CASE statement
        $caseStatement = "CASE ";
        foreach ($experienceRanges as $label => $condition) {
            $caseStatement .= "WHEN $condition THEN \"$label\" ";
        }
        $caseStatement .= "ELSE \"None\" END";

        // Fetch actual counts from the database
        $rawWorkExperienceCounts = self::where('job_opening_id', $jobOpeningId)->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
            return $query->when($tab == 8, function ($q) {
                return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
            }, function ($q) use ($tab) {
                return $q->where('job_opening_applications.status', $tab);
            })
                ->where('application_status', '=', 1);
        }, function ($query) use ($tab) {
            return $query->where('application_status', $tab);
        })
            ->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->select(DB::raw("$caseStatement as work_experience_label"), DB::raw('COUNT(DISTINCT job_opening_applications.user_id) as count'))
            ->groupBy(DB::raw($caseStatement)) // FIX: Removed aliasing in GROUP BY
            ->pluck('count', 'work_experience_label')
            ->toArray();

        // Merge actual counts into predefined categories
        foreach ($rawWorkExperienceCounts as $key => $count) {
            $workExperienceCounts[$key] = $count;
        }

        return $workExperienceCounts;
    }

    public static function getInterviewDateCounts($jobOpeningId, $tab, $pageType)
    {
        // Define date ranges
        $today = Carbon::today();
        $dateRanges = [
            'Any Interview Dates' => 'interview_date IS NOT NULL',
            'Upcoming 7 Days' => "interview_date BETWEEN '{$today}' AND '{$today->copy()->addDays(7)}'",
            'Upcoming 28 Days' => "interview_date BETWEEN '{$today}' AND '{$today->copy()->addDays(28)}'",
            'Upcoming 60 Days' => "interview_date BETWEEN '{$today}' AND '{$today->copy()->addDays(60)}'",
            'Upcoming 90 Days' => "interview_date BETWEEN '{$today}' AND '{$today->copy()->addDays(90)}'",
        ];

        // Initialize all categories with 0 count
        $interviewDateCounts = array_fill_keys(array_keys($dateRanges), 0);

        // Generate the dynamic CASE statement
        $caseStatement = "CASE ";
        foreach ($dateRanges as $label => $condition) {
            $caseStatement .= "WHEN $condition THEN \"$label\" ";
        }
        $caseStatement .= "ELSE \"No Interview Scheduled\" END";

        // Fetch actual counts from the database
        $rawInterviewDateCounts = self::where('job_opening_id', $jobOpeningId)->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
            return $query->when($tab == 8, function ($q) {
                return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
            }, function ($q) use ($tab) {
                return $q->where('job_opening_applications.status', $tab);
            })
                ->where('application_status', '=', 1);
        }, function ($query) use ($tab) {
            return $query->where('application_status', $tab);
        })
            ->select(DB::raw("$caseStatement as interview_date_label"), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw($caseStatement)) // FIX: No aliasing in GROUP BY
            ->pluck('count', 'interview_date_label')
            ->toArray();

        // Merge actual counts into predefined categories
        foreach ($rawInterviewDateCounts as $key => $count) {
            $interviewDateCounts[$key] = $count;
        }

        return $interviewDateCounts;
    }

    public static function getEducationProgramCounts($jobOpeningId, $tab, $pageType)
    {
        // Initialize array with "Others" set to 0 to include missing program data
        $educationProgramCounts = ['Others' => 0];

        // Fetch actual counts from the database
        $rawEducationProgramCounts = self::where('job_opening_id', $jobOpeningId)->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
            return $query->when($tab == 8, function ($q) {
                return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
            }, function ($q) use ($tab) {
                return $q->where('job_opening_applications.status', $tab);
            })
                ->where('application_status', '=', 1);
        }, function ($query) use ($tab) {
            return $query->where('application_status', $tab);
        })
            ->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->leftJoin('master_education_programs', 'users.education_program_id', '=', 'master_education_programs.id') // Assuming education programs are stored in a separate table
            ->select(DB::raw('COALESCE(master_education_programs.name, "Others") as education_program'), DB::raw('COUNT(DISTINCT job_opening_applications.user_id) as count'))
            ->groupBy('education_program')
            ->pluck('count', 'education_program')
            ->toArray();

        // Merge actual counts into predefined categories
        foreach ($rawEducationProgramCounts as $key => $count) {
            $educationProgramCounts[$key] = $count;
        }

        return $educationProgramCounts;
    }

    public static function getEducationLevelCounts($jobOpeningId, $tab, $pageType)
    {
        // Initialize array with "Others" set to 0 to include missing education level data
        $educationLevelCounts = ['Others' => 0];

        // Fetch actual counts from the database
        $rawEducationLevelCounts = self::where('job_opening_id', $jobOpeningId)->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
            return $query->when($tab == 8, function ($q) {
                return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
            }, function ($q) use ($tab) {
                return $q->where('job_opening_applications.status', $tab);
            })
                ->where('application_status', '=', 1);
        }, function ($query) use ($tab) {
            return $query->where('application_status', $tab);
        })
            ->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->leftJoin('master_education_levels', 'users.education_level', '=', 'master_education_levels.id') // Assuming master_education_levels contains level names
            ->select(DB::raw('COALESCE(master_education_levels.name, "Others") as education_level'), DB::raw('COUNT(DISTINCT job_opening_applications.user_id) as count'))
            ->groupBy('education_level')
            ->pluck('count', 'education_level')
            ->toArray();

        // Merge actual counts into predefined categories
        foreach ($rawEducationLevelCounts as $key => $count) {
            $educationLevelCounts[$key] = $count;
        }

        return $educationLevelCounts;
    }

    public static function getSuitabilityRateCounts($jobOpeningId, $tab, $pageType)
    {
        // Define the suitability rate ranges
        $suitabilityRanges = [
            '91%-100%' => 'suitability_rate BETWEEN 91 AND 100',
            '81%-90%' => 'suitability_rate BETWEEN 81 AND 90',
            '71%-80%' => 'suitability_rate BETWEEN 71 AND 80',
            '61%-70%' => 'suitability_rate BETWEEN 61 AND 70',
            '51%-60%' => 'suitability_rate BETWEEN 51 AND 60',
            'Less than 50%' => 'suitability_rate < 50'
        ];

        // Initialize all categories with a count of 0
        $suitabilityCounts = array_fill_keys(array_keys($suitabilityRanges), 0);

        // Generate a dynamic CASE statement
        $caseStatement = "CASE ";
        foreach ($suitabilityRanges as $label => $condition) {
            $caseStatement .= "WHEN $condition THEN \"$label\" ";
        }
        $caseStatement .= "ELSE \"Less than 50%\" END"; // Default to "Less than 50%" if nothing matches

        // Fetch actual counts from job_opening_applications table
        $rawSuitabilityCounts = self::where('job_opening_id', $jobOpeningId)
            ->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
                return $query->when($tab == 8, function ($q) {
                    return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
                }, function ($q) use ($tab) {
                    return $q->where('job_opening_applications.status', $tab);
                })
                    ->where('application_status', '=', 1);
            }, function ($query) use ($tab) {
                return $query->where('application_status', $tab);
            })
            ->whereNotNull('suitability_rate') // Ensuring NULL values are excluded
            ->select(DB::raw("$caseStatement as suitability_label"), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw($caseStatement))
            ->pluck('count', 'suitability_label')
            ->toArray();

        // Merge actual counts into predefined categories
        foreach ($rawSuitabilityCounts as $key => $count) {
            $suitabilityCounts[$key] = $count;
        }

        return $suitabilityCounts;
    }

    public static function getExpectedSalaryCounts($jobOpeningId, $tab, $pageType)
    {
        // Define salary ranges
        $salaryRanges = [
            'Less than 1000' => 'expected_salary < 1000',
            '1000-5000' => 'expected_salary BETWEEN 1000 AND 5000',
            '5001-10000' => 'expected_salary BETWEEN 5001 AND 10000',
            '10001-15000' => 'expected_salary BETWEEN 10001 AND 15000',
            '15001-20000' => 'expected_salary BETWEEN 15001 AND 20000',
            'Greater than 20000' => 'expected_salary > 20000',
            'Other' => 'expected_salary IS NULL'
        ];

        // Initialize counts with 0
        $salaryCounts = array_fill_keys(array_keys($salaryRanges), 0);

        // Generate CASE statement for dynamic counting
        $caseStatement = "CASE ";
        foreach ($salaryRanges as $label => $condition) {
            $caseStatement .= "WHEN $condition THEN \"$label\" ";
        }
        $caseStatement .= "ELSE \"Other\" END";

        // Fetch actual counts
        $rawSalaryCounts = self::where('job_opening_id', $jobOpeningId)
            ->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
                return $query->when($tab == 8, function ($q) {
                    return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
                }, function ($q) use ($tab) {
                    return $q->where('job_opening_applications.status', $tab);
                })
                    ->where('application_status', '=', 1);
            }, function ($query) use ($tab) {
                return $query->where('application_status', $tab);
            })
            ->select(DB::raw("$caseStatement as salary_label"), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw($caseStatement))
            ->pluck('count', 'salary_label')
            ->toArray();

        // Merge actual counts into predefined categories
        foreach ($rawSalaryCounts as $key => $count) {
            $salaryCounts[$key] = $count;
        }

        return $salaryCounts;
    }

    public static function getOceanAssessmentCounts($jobOpeningId, $tab, $pageType)
    {
        // Default labels
        $oceanCounts = [
            'Completed' => 0,
            'Not Completed' => 0,
        ];

        $rawCounts = self::where('job_opening_id', $jobOpeningId)
            ->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
                return $query->when($tab == 8, function ($q) {
                    return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
                }, function ($q) use ($tab) {
                    return $q->where('job_opening_applications.status', $tab);
                })
                    ->where('application_status', '=', 1);
            }, function ($query) use ($tab) {
                return $query->where('application_status', $tab);
            })
            ->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->select(
                DB::raw("CASE 
                            WHEN users.is_personality_motivation_completed = 1 THEN 'Completed' 
                            ELSE 'Not Completed' 
                        END as ocean_status"),
                DB::raw("COUNT(*) as count")
            )
            ->groupBy('ocean_status')
            ->pluck('count', 'ocean_status')
            ->toArray();

        // Merge actual counts with predefined keys to ensure both appear
        foreach ($rawCounts as $key => $count) {
            $oceanCounts[$key] = $count;
        }

        return $oceanCounts;
    }


    public static function getRiasecStatusCounts($jobOpeningId, $tab, $pageType)
    {
        $counts = [
            'Completed' => 0,
            'Not Completed' => 0,
        ];

        $rawCounts = self::where('job_opening_id', $jobOpeningId)
            ->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
                return $query->when($tab == 8, function ($q) {
                    return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
                }, function ($q) use ($tab) {
                    return $q->where('job_opening_applications.status', $tab);
                })
                    ->where('application_status', '=', 1);
            }, function ($query) use ($tab) {
                return $query->where('application_status', $tab);
            })
            ->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->select(
                DB::raw("CASE 
                            WHEN is_work_interest_completed = 1 THEN 'Completed' 
                            ELSE 'Not Completed' 
                        END as status"),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        foreach ($rawCounts as $label => $count) {
            $counts[$label] = $count;
        }

        return $counts;
    }

    public static function getCognitiveAssessmentStatusCounts($jobOpeningId, $tab, $pageType)
    {
        return self::where('job_opening_id', $jobOpeningId)->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
            return $query->when($tab == 8, function ($q) {
                return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
            }, function ($q) use ($tab) {
                return $q->where('job_opening_applications.status', $tab);
            })
                ->where('application_status', '=', 1);
        }, function ($query) use ($tab) {
            return $query->where('application_status', $tab);
        })
            ->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->select('is_cognitive_ability_completed', DB::raw('COUNT(*) as count'))
            ->groupBy('is_cognitive_ability_completed')
            ->pluck('count', 'is_cognitive_ability_completed')
            ->mapWithKeys(function ($value, $key) {
                return [$key == 1 ? 'Completed' : 'Not Completed' => $value];
            })
            ->toArray();
    }

    // public static function getTechnicalAssessmentStatusCounts($jobOpeningId, $tab, $pageType)
    // {
    //     // Initialize default labels
    //     $technicalCounts = [
    //         'Completed' => 0,
    //         'Not Completed' => 0,
    //     ];

    //     // Fetch counts with CASE logic
    //     $rawCounts = self::where('job_opening_id', $jobOpeningId)
    //         ->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
    //             return $query->where('job_opening_applications.status', $tab)
    //                 ->where('application_status', '=', 1);
    //         }, function ($query) use ($tab) {
    //             return $query->where('application_status', $tab);
    //         })
    //         ->leftJoin('users', 'job_opening_applications.user_id', '=', 'users.id')
    //         ->select(
    //             DB::raw("CASE 
    //                         WHEN users.is_technical_assessment_completed = 1 THEN 'Completed'
    //                         ELSE 'Not Completed'
    //                     END as tech_status"),
    //             DB::raw("COUNT(*) as count")
    //         )
    //         ->groupBy('tech_status')
    //         ->pluck('count', 'tech_status')
    //         ->toArray();    

    //     // Merge actual counts with predefined keys
    //     foreach ($rawCounts as $key => $count) {
    //         $technicalCounts[$key] = $count;
    //     }

    //     return $technicalCounts;
    // }

    public static function getTechnicalAssessmentStatusCounts($jobOpeningId, $tab, $pageType)
{
    // Initialize default labels
    $technicalCounts = [
        'Completed' => 0,
        'Not Completed' => 0,
    ];

    // Fetch counts directly from job_opening_applications table
    $rawCounts = self::where('job_opening_id', $jobOpeningId)
        ->when($pageType == 'hiring-pipeline', function ($query) use ($tab) {
            return $query->when($tab == 8, function ($q) {
                return $q->whereIn('job_opening_applications.status', [8, 9, 10, 11]);
            }, function ($q) use ($tab) {
                return $q->where('job_opening_applications.status', $tab);
            })
                         ->where('application_status', '=', 1);
        }, function ($query) use ($tab) {
            return $query->where('application_status', $tab);
        })
        ->select(
            DB::raw("CASE 
                        WHEN job_opening_applications.technical_assessment_completed = 1 THEN 'Completed'
                        ELSE 'Not Completed'
                    END as tech_status"),
            DB::raw("COUNT(*) as count")
        )
        ->groupBy('tech_status')
        ->pluck('count', 'tech_status')
        ->toArray();

    // Merge actual counts with predefined keys
    foreach ($rawCounts as $key => $count) {
        $technicalCounts[$key] = $count;
    }

    return $technicalCounts;
}


    public function interviewResponse()
    {
        return $this->hasMany(JobOpeningApplicationInterviewResponse::class, 'id');
    }

    public function jobOpeningApplicationUserDocuments()
    {
        return $this->hasMany(jobOpeningApplicationUserDocument::class, 'job_application_id');
    }
}
