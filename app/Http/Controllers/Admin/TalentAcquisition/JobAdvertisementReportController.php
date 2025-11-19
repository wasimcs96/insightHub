<?php

namespace App\Http\Controllers\Admin\TalentAcquisition;

use App\Helpers\HelperFunctions;
use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\JobOpening;
use App\Models\JobOpeningApplication;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Helpers\QueryHelper;
use App\Services\TalentAcquisition\ApplicantDetailsService;
use Illuminate\Http\Request;


class JobAdvertisementReportController extends Controller
{
    protected $applicantDetailsService;

    public function __construct(ApplicantDetailsService $applicantDetailsService)
    {
        $this->applicantDetailsService = $applicantDetailsService;
    }

    public function index(Request $request, $id)
    {
        $responseData = [];

        $page = request()->get('page');

        $jobOpening = JobOpening::with(['department','country','state','province'])->find($id);
     
        if (!$jobOpening) {
            abort(404);
        }

        switch ($page) {
            case 'job-information':
                $responseData = $this->getJobInformation($id);
                break;
            case 'all-applicants':
                $responseData = $this->getAllApplicants($id);
                // $responseData = array_merge($this->getStatusCounts($jobOpening,$responseData));
                break;
            case 'hiring-pipeline':
                $responseData = $this->getHiringPipeline($id);
                break;
            case 'report':
                $responseData = $this->getReport($id);
                break;
            default:
                $responseData = $this->getJobInformation($id);
        }

        $responseData['jobOpening'] = $jobOpening;
        $responseData['department'] = $jobOpening->department;
        $responseData['state'] = $jobOpening->state;
        $responseData['country'] = $jobOpening->country;
        $responseData['province'] = $jobOpening->province;
        $responseData['page'] = $page;
        return view('admin.talent-acquisition.job-advertisement.index', $responseData);
    }

    private function getJobInformation($id){
        $jobOpening = JobOpening::with(['mainScopeOfStudy','education_level','companyBenefit', 'companyOveriew','secondaryScopeOfStudies','relevantTrainingPrograms','relevantProfessionalCertificates','requiredDocuments','suitabilityRateSettings','job','department',
        'job.technicalSkills',
        'job.criticalFunctions.cwfKeys','job.skills'])->find($id);

        $data = [];
        // $data['companyBenefit'] = $jobOpening->companyBenefit;
        // $data['secondaryScopeOfStudies'] = $jobOpening->secondaryScopeOfStudies;
        // $data['relevantTrainingPrograms'] = $jobOpening->relevantTrainingPrograms;
        // $data['relevantProfessionalCertificates'] = $jobOpening->relevantProfessionalCertificates;
        // $data['requiredDocuments'] = $jobOpening->requiredDocuments;
        // $data['suitabilityRateSettings'] = $jobOpening->suitabilityRateSettings;
        // $data['job'] = $jobOpening->job;
        // $data['department'] = $jobOpening->department;
        // $data['technicalSkills'] = $jobOpening->job->technicalSkills;
        // $data['criticalFunctions'] = $jobOpening->job->criticalFunctions;
        // $data['skills'] = $jobOpening->job->skills;
        // $data['education_level'] = $jobOpening->education_level;
        // $data['mainScopeOfStudy'] = $jobOpening->mainScopeOfStudy;
        $data['companyOverview'] = $jobOpening->companyOveriew;
        $data['companyBenefit'] = $jobOpening->companyBenefit;
        $data['secondaryScopeOfStudies'] = $jobOpening->secondaryScopeOfStudies;
        $data['relevantTrainingPrograms'] = $jobOpening->relevantTrainingPrograms;
        $data['relevantProfessionalCertificates'] = $jobOpening->relevantProfessionalCertificates;
        $data['requiredDocuments'] = $jobOpening->requiredDocuments;
        $data['suitabilityRateSettings'] = $jobOpening->suitabilityRateSettings;
        $data['job'] = $jobOpening->job ?? null;
        $data['department'] = $jobOpening->department ?? null;
        $data['technicalSkills'] = optional($jobOpening->job)->technicalSkills ?? collect();
        $data['criticalFunctions'] = optional($jobOpening->job)->criticalFunctions ?? collect();
        $data['skills'] = optional($jobOpening->job)->skills ?? collect();
        $data['education_level'] = $jobOpening->education_level ?? null;
        $data['mainScopeOfStudy'] = $jobOpening->mainScopeOfStudy ?? null;

        return $data;
    }

    private function getAllApplicants($id)
    {
        return [];
    }

    public function getApplicantUsersOld($id,Request $request){

        $levelMappings = [
            'omr_level' => config('helpers.overall_match_rate_levels'),
            'bfr_level' => config('helpers.behavior_fit_rate_levels'),
            'ta_level' =>  config('helpers.technical_assessment_levels'),
            'ssmr_level' =>  config('helpers.soft_skill_match_rate_levels'),
            'jmr_level' =>  config('helpers.job_match_rate_levels'),
            'cat_level' =>  config('helpers.cognitive_ability_levels'),
            'gp_level' =>  config('helpers.growth_potential_levels'),
            'rci_level' =>  config('helpers.rci_levels'),
            'fr_level' =>  config('helpers.flight_risk_levels'),
            'waf_level' =>  config('helpers.organizational_fit_forecast_levels'),
        ];


        $jobId = $id; // Get job_id from AJAX request

        $appliedUsers = JobOpeningApplication::where('job_opening_id', $jobId)
            ->with(['user:id,name,email,year_of_experience_in_it_sector,national_id,state_id,province_id,education_level,education_program_id,country_id',
            'user.country',
            'user.program',
            'user.education_level_check',
            'user.province',
            'user.state',
            'user.results' => function ($query) {
            $query->whereIn('result_type', [
                'growth_potential', 'rci', 'flight_risk', 'organizational_fit_forecast',
                'ccs_match_rate', 'jmr', 'overall', 'soft_skill_score', 'overall_match_rate'
            ])
            ->select(
                'user_id',
                DB::raw("MAX(CASE WHEN result_type = 'overall_match_rate' THEN level END) AS omr_level"),
                DB::raw("
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
                    ) AS bfr_level
                "),
                DB::raw("MAX(CASE WHEN assessment_type = 'technical' AND result_type = 'overall' THEN level END) AS ta_level"),
                DB::raw("MAX(CASE WHEN result_type = 'ccs_match_rate' THEN level END) AS ssmr_level"),
                DB::raw("MAX(CASE WHEN result_type = 'jmr' THEN level END) AS jmr_level"),
                DB::raw("MAX(CASE WHEN assessment_type = 'cognitive' AND result_type = 'overall' THEN level END) AS cat_level"),
                DB::raw("MAX(CASE WHEN result_type = 'growth_potential' THEN level END) AS gp_level"),
                DB::raw("MAX(CASE WHEN result_type = 'rci' THEN level END) AS rci_level"),
                DB::raw("MAX(CASE WHEN result_type = 'flight_risk' THEN level END) AS fr_level"),
                DB::raw("MAX(CASE WHEN result_type = 'organizational_fit_forecast' THEN level END) AS waf_level")
            )->groupBy('user_id');
        },
        'user.performanceRatings' => function ($query) {
            $query->select('user_id', DB::raw("AVG(CASE WHEN normalized_rating > 0 THEN normalized_rating ELSE NULL END) AS avg_performance_rating"))
                  ->groupBy('user_id');
        }
        ])
            ->paginate(10); // Change 10 to the number of records per page

        
        dd($appliedUsers);

        return response()->json($employees);

    }

    public function getApplicantUsers($id, Request $request)
    {

        $levelMappings = [
            'omr_level' => config('helpers.overall_match_rate_levels'),
            'bfr_level' => config('helpers.behavior_fit_rate_levels'),
            'ta_level' => config('helpers.technical_assessment_levels'),
            'ssmr_level' => config('helpers.soft_skill_match_rate_levels'),
            'jmr_level' => config('helpers.job_match_rate_levels'),
            'cat_level' => config('helpers.cognitive_ability_levels'),
            'gp_level' => config('helpers.growth_potential_levels'),
            'rci_level' => config('helpers.rci_levels'),
            'fr_level' => config('helpers.flight_risk_levels'),
            'waf_level' => config('helpers.organizational_fit_forecast_levels'),
        ];


        $jobId = $id; // Get job_id from AJAX request

        // if ($request->has('filters')) {
        //     foreach ($request->filters as $filter) {
        //         if ($filter['filterKey'] === 'OMR') {

        //         }
        //     }
        // }

        $filters = []; // Capture filters from request

        // Convert filter titles to corresponding level values
        $filterConditions = [];
        foreach ($filters as $column => $title) {
            if (isset($levelMappings[$column])) {
                $level = array_search($title, $levelMappings[$column]);
                if ($level !== false) {
                    $filterConditions[$column] = $level;
                }
            }
        }
        // dd($filterConditions);


        // Get dynamically generated queries
        $queries = QueryHelper::getDynamicLevelQueries();

        $appliedUsers = JobOpeningApplication::where('job_opening_id', $jobId)
            ->applyGeneralFilters($request)
            ->applyGeneralSorting($request)
            ->with([
                'user:id,name,email,year_of_experience_in_it_sector,city_id,national_id,state_id,province_id,education_level,education_program_id,country_id,work_authorisation,is_personality_motivation_completed,is_cognitive_ability_completed,is_technical_assessment_completed,is_work_interest_completed',
                'user.country',
                'user.nationality',
                'user.program',
                'user.education_level_check',
                'user.province',
                'user.city',
                'user.state',
                'user.results' => function ($query) use ($queries) {
                    $query->select(array_merge(['user_id'], $queries['selectStatements'], $queries['caseStatements']))
                        ->groupBy('user_id');
                },
                'user.performanceRatings' => function ($query) {
                    $query->select('user_id', DB::raw("AVG(CASE WHEN normalized_rating > 0 THEN normalized_rating ELSE NULL END) AS avg_performance_rating"))
                        ->groupBy('user_id');
                },'contract'
            ]);
            //Not Completed Assessments or Results Not Available
            // ->doesntHave('user.results')

            if ($request->has('showAll') && $request->showAll != 'false' && $request->has('selectedUsers')) {
                if (count(explode(',', $request->selectedUsers)) > 0 && $request->selectedUsers != null) {
                    $appliedUsers->whereIn('id',explode(',', $request->selectedUsers));
                }
            }


            $appliedUsers=$appliedUsers->paginate($request->perPage ?? 10);
            

            $pageType = 'all-applicants';

            if ($request->has('pageType')) {
                $pageType = $request->pageType;
            }

            if ($request->has('tab')) {
                $tab = $request->tab;
            }

            $columnsVisible = $this->getColumns($tab,$pageType);

            $responseData = [];

            $responseData['columns_visible'] = $columnsVisible;

            $responseData['appliedUsers'] = $appliedUsers;

            $responseData['application_status_columns'] = config('helpers.application_status_colors');

            $responseData['domain_colors'] = config('helpers.domain_colors');

            $responseData['sortBy'] = '';

            $responseData['sortDirection'] = '';

            if ($request->has('sortBy') && $request->has('sortDirection')) {
                $responseData['sortDirection'] = $request->input('sortDirection', 'asc');
                $responseData['sortBy'] = $request->input('sortBy') ?? 'created_at';
            }

            $responseData['status_counts'] = JobOpeningApplication::getStatusCountsForTabs($id, $tab, "hiring-pipeline");
            
        return response()->json($responseData);
    }

    private function getColumns($tab,$page){

        $allColumns = [];
        $columns = config('helpers.all_applicant_fields');
        foreach ($columns as $key => $value) {
            if (in_array($tab,$value['list'][$page])) {
                array_push($allColumns, $value);
            }
        }
       return $allColumns;
    }

    private function getHiringPipeline($id){
        return [];
    }

    private function getReport($id)
    {

        $totalHires = JobOpeningApplication::where('job_opening_id', $id)->where('status', 12)->count();
        $responseData['totalHires'] = $totalHires;

        $totalApplications = JobOpeningApplication::where('job_opening_id', $id)->count();
        $responseData['totalApplications'] = $totalApplications;

        $totalRejectedApplicants = JobOpeningApplication::where('job_opening_id', $id)->where('application_status', 2)->count();
        $responseData['totalRejectedApplicants'] = $totalRejectedApplicants;

        $timeToFill = JobOpening::select(DB::raw('DATEDIFF(application_filled_date, application_period_start_date) AS date_difference'))
            ->where('id', $id) // You can filter by the job opening ID
            ->first();

        $responseData['timeToFill'] = $timeToFill->date_difference;
        if ($totalHires != 0) {
            $averageTimeToFill = $timeToFill->date_difference / $totalHires;
            $responseData['averageTimeToFill'] = $averageTimeToFill;
        } else {
            $responseData['averageTimeToFill'] = 0;
        }

        $totalOfferAccepted = JobOpeningApplication::where('job_opening_id', $id)->where('status', 9)->count();
        $responseData['totalOfferAccepted'] = $totalOfferAccepted;

        if ($totalOfferAccepted != 0 || $totalHires !=0) {
            $offerAcceptanceRate = ($totalHires / ($totalOfferAccepted + $totalHires)) * 100;
            $responseData['offerAcceptanceRate'] = $offerAcceptanceRate;
        } else {
            $responseData['offerAcceptanceRate'] = 0;
        }

        $jobOpening = JobOpening::find($id);

        $currencyShortName = $jobOpening->currency_short_name;

        // Example: Add it to the response
        $responseData['currencyShortName'] = $currencyShortName;

        $averageSalaryOffered = Contract::where('job_id', $jobOpening->job_id)->avg('basic_salary');
        $responseData['averageSalaryOffered'] = round($averageSalaryOffered,2);

        $averageExpectedSalary = JobOpeningApplication::where('job_opening_id', $id)->avg('expected_salary');
        $responseData['averageExpectedSalary'] = round($averageExpectedSalary, 2);
       
        $cityApplications = JobOpeningApplication::selectRaw('master_cities.name as city_name, master_countries.name as country_name, COUNT(job_opening_applications.id) as total_applications')
            ->join('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->join('master_cities', 'users.city_id', '=', 'master_cities.id')
            ->leftJoin('master_countries', 'master_cities.country_id', '=', 'master_countries.id')
            ->where('job_opening_applications.job_opening_id', $id) 
            ->groupBy('master_cities.name', 'master_countries.name')
            ->get();

        $responseData['cityApplications'] = $cityApplications;

        $countryApplications = JobOpeningApplication::selectRaw('master_countries.name, COUNT(job_opening_applications.id) as total_applications')
            ->join('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->join('master_countries', 'users.country_id', '=', 'master_countries.id')
            ->where('job_opening_applications.job_opening_id', $id) 
            ->groupBy('master_countries.name')
            ->get();

        $responseData['countryApplications'] = $countryApplications;

        $workExperienceCounts = DB::table('job_opening_applications')
            ->join('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->selectRaw('
                                    CASE
                                        WHEN year_of_experience_in_it_sector < 1 THEN "Less Than 1 Year"
                                        WHEN year_of_experience_in_it_sector BETWEEN 1 AND 2 THEN "1-2 years"
                                        WHEN year_of_experience_in_it_sector BETWEEN 3 AND 5 THEN "3-5 years"
                                        WHEN year_of_experience_in_it_sector BETWEEN 6 AND 8 THEN "6-8 years"
                                        WHEN year_of_experience_in_it_sector BETWEEN 9 AND 10 THEN "9-10 years"
                                        WHEN year_of_experience_in_it_sector > 10 THEN "More than 10 Years"
                                        ELSE "None"
                                    END as work_experience,
                                    COUNT(job_opening_applications.id) as total_applications'
            )
            ->where('job_opening_applications.job_opening_id', $id)
            ->groupBy('work_experience')
            ->get();

        $responseData['workExperienceCounts'] = $workExperienceCounts;

        $educationLevelCounts = DB::table('job_opening_applications')
            ->join('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->join('master_education_levels', 'users.education_level', '=', 'master_education_levels.id')
            ->selectRaw('master_education_levels.name as education_level, COUNT(job_opening_applications.id) as total_applications')
            ->where('job_opening_applications.job_opening_id', $id)
            ->groupBy('education_level')
            ->get();

        $responseData['educationLevelCounts'] = $educationLevelCounts;

        $workAuthorizationCounts = DB::table('job_opening_applications')
            ->join('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->selectRaw("IF(users.work_authorisation = 1, 'Yes', 'No') as work_auth, COUNT(*) as total")
            ->where('job_opening_applications.job_opening_id', $id)
            ->groupBy('work_auth')
            ->get();
        $responseData['workAuthorizationCounts'] = $workAuthorizationCounts;

        $educationProgramCounts = DB::table('job_opening_applications')
            ->join('users', 'job_opening_applications.user_id', '=', 'users.id')
            ->join('master_education_programs', 'users.education_program_id', '=', 'master_education_programs.id')
            ->selectRaw('master_education_programs.name as education_program, COUNT(job_opening_applications.id) as total_applications')
            ->where('job_opening_applications.job_opening_id', $id)
            ->groupBy('education_program')
            ->get();

        $responseData['educationProgramCounts'] = $educationProgramCounts;

        // Group by status and application_status to get the count of each status as total_applications
        $statusCounts = JobOpeningApplication::select('status', 'application_status', DB::raw('count(*) as total_applications'))
            ->where('job_opening_applications.job_opening_id', $id)
            ->groupBy('status', 'application_status')
            ->get();

        // Define the status names as per your array
        $statusNames = [
            1 => 'Applied',
            2 => 'Assessment Link Sent',
            3 => 'Assessment Pending',
            4 => 'Assessment Completed',
            5 => 'Shortlisted',
            6 => 'Interview Scheduled',
            7 => 'Interview Completed',
            8 => 'Offered',
            9 => 'Offer Accepted',
            10 => 'Offer Declined',
            11 => 'Offer Expired',
            12 => 'Hired',
        ];

        // Prepare the labels, series, and counts for the chart, with zero counts for missing statuses
        $statusLabels = [];
        $statusSeries = [];
        $totalApplications = 0;
        $totalRejectedApplications = array_fill(1, 12, 0); // Array to track rejected applications for each status
        $statusRejectedCounts = array_fill(1, 12, 0); // Array to store the rejection counts for each status

        // Initialize all status counts to zero first
        $statusSeries = array_fill(1, 12, 0); // Array with keys 1 to 12, all values set to 0

        // Populate the series with actual counts from the database
        foreach ($statusCounts as $statusCount) {
            $status = $statusCount->status;
            $applications = $statusCount->total_applications;

            // Add to the total applications for this status
            $statusSeries[$status] += $applications;
            $totalApplications += $applications;

            // If application_status is 2 (rejected), count the rejected applications for this status
            if ($statusCount->application_status == 2) {
                $totalRejectedApplications[$status] += $applications;
            }
        }

        // Prepare the labels for the chart
        foreach ($statusNames as $statusId => $statusName) {
            $statusLabels[] = $statusName; // Keep the status names in the correct order
        }

        // Extract the series (total applications) in the same order
        $statusSeries = array_values($statusSeries);  // Reset the array to ensure correct order

        // Calculate rejection rates for each status and overall rejection rate
        $rejectionRates = [];

        foreach ($totalRejectedApplications as $statusId => $rejectedCount) {
            // Check if the statusId exists in statusSeries
            if (isset($statusSeries[$statusId]) && $statusSeries[$statusId] > 0) {
                $rejectionRates[$statusId] = ($rejectedCount / $statusSeries[$statusId]) * 100;
            } else {
                // If status doesn't exist or has zero total applications, set rejection rate to 0
                $rejectionRates[$statusId] = 0;
            }
        }

        // Calculate overall rejection rate (if there are any total applications)
        $overallRejectionRate = 0;
        if ($totalApplications > 0) {
            $overallRejectionRate = (array_sum($totalRejectedApplications) / $totalApplications) * 100;
        }

        // Prepare response data
        $responseData['statusLabels'] = $statusLabels;
        $responseData['statusSeries'] = $statusSeries;
        $responseData['totalRejectedApplications'] = $totalRejectedApplications;
        $responseData['rejectionRates'] = $rejectionRates; // Rejection rates for each status
        $responseData['overallRejectionRate'] = $overallRejectionRate; // Overall rejection rate

        return $responseData;
    } 


    // public function rejectApplicants(Request $request)
    //     {
    //         // Validate the request
    //         $request->validate([
    //             'selectedRows' => 'required|array',
    //             'selectedRows.*' => 'integer', // Ensures each value in the array is an integer
    //         ]);

    //         // Retrieve selected applicant IDs
    //         $applicantIds = $request->input('selectedRows');

    //         // Update status in a single query using whereIn
    //         $affectedRows = JobOpeningApplication::whereIn('id', $applicantIds)->update(['application_status' => 2]);

    //         return response()->json([
    //             'message' => 'Applicants rejected successfully.',
    //             'affectedRows' => $affectedRows
    //         ]);
    //     }


    // public function rejectApplicants(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'selectedRows' => 'required|array',
    //         'selectedRows.*' => 'integer',
    //     ]);

    //     // Retrieve selected applicant IDs
    //     $applicantIds = $request->input('selectedRows');

    //     // Fetch applicants and categorize them
    //     $applicants = JobOpeningApplication::whereIn('id', $applicantIds)->get();

    //     $rejectable = $applicants->filter(function ($applicant) {
    //         return $applicant->status <= 7;
    //     })->pluck('id');

    //     $nonRejectable = $applicants->filter(function ($applicant) {
    //         return $applicant->status > 7;
    //     })->pluck('id');

    //     // Update rejectable applicants
    //     $affectedRows = JobOpeningApplication::whereIn('id', $rejectable)->update(['application_status' => 2]);

    //     $message = 'Applicants processed successfully.';

    //     if ($nonRejectable->isNotEmpty()) {
    //         $message .= ' Note: Some applications were not rejected because they are in Offered or Hired stages.';
    //     }

    //     return response()->json([
    //         'message' => $message,
    //         'rejected' => $rejectable,
    //         'skipped' => $nonRejectable,
    //         'affectedRows' => $affectedRows
    //     ]);

    // }
    public function rejectApplicants(Request $request)
    {
        // Validate the request
        $request->validate([
            'selectedRows' => 'required|array',
            'selectedRows.*' => 'integer',
        ]);
    
        $applicantIds = $request->input('selectedRows');
    
        // Fetch applications
        $applicants = JobOpeningApplication::whereIn('id', $applicantIds)->get();
    
        $rejectable = $applicants->filter(function ($applicant) {
            return $applicant->status <= 7;
        });
    
        $nonRejectable = $applicants->filter(function ($applicant) {
            return $applicant->status > 7;
        });
    
        $rejectedIds = $rejectable->pluck('id');
        $skippedIds = $nonRejectable->pluck('id');
    
        // Update status for rejectable applicants
        $affectedRows = JobOpeningApplication::whereIn('id', $rejectedIds)->update(['application_status' => 2]);
    
        // 📨 Send email notifications for rejected applications
        if ($rejectable->isNotEmpty()) {
            try {
                // If you use a helper that sends emails based on application IDs
                // Pass array of IDs and status = 2 for rejection
                HelperFunctions::sendEmailOnStatusChange($rejectedIds->toArray(), 2);
            } catch (\Throwable $th) {
                \Log::error('Error sending rejection emails: ' . $th->getMessage());
            }
        }
    
        // Return response
        $message = 'Applicants processed successfully.';
    
        if ($nonRejectable->isNotEmpty()) {
            $message .= ' Note: Some applications were not rejected because they are in Offered or Hired stages.';
        }
    
        return response()->json([
            'message' => $message,
            'rejected' => $rejectedIds,
            'skipped' => $skippedIds,
            'affectedRows' => $affectedRows
        ]);
    }
    


    public function getStatusCountsApi($id, Request $request)
    {
        $tab = $request->tab ?? 1;
        $pageType = $request->pageType ?? 'all-applicants';
        $columnsVisible = $this->getColumns($tab, $pageType);

        // Map filter_keys to their respective static methods
        $functionMap = [
            'statusCounts' => 'getStatusCounts',
            'countryCounts' => 'getCountryCounts',
            'currentLocationCounts' => 'getCurrentLocationCounts',
            'workAuthorisationCounts' => 'getWorkAuthorisationCounts',
            'interviewPerformanceCounts' => 'getInterviewPerformanceCounts',
            'catLevelCounts' => 'getCatLevelCounts',
            'rciLevelCounts' => 'getRciLevelCounts',
            'frLevelCounts' => 'getFrLevelCounts',
            'workExperienceCounts' => 'getWorkExperienceCounts',
            'interviewDateCounts' => 'getInterviewDateCounts',
            'educationProgramCounts' => 'getEducationProgramCounts',
            'educationLevelCounts' => 'getEducationLevelCounts',
            'omrLevelCounts' => 'getOmrLevelCounts',
            'suitabilityRateCounts' => 'getSuitabilityRateCounts',
            'expectedSalaryCounts' => 'getExpectedSalaryCounts',
            'oceanStatusCounts' => 'getOceanAssessmentCounts',
            'riasecStatusCounts' => 'getRiasecStatusCounts',
            'technicalAssessmentStatusCounts' => 'getTechnicalAssessmentStatusCounts',
            'cognitiveAssessmentStatusCounts' => 'getCognitiveAssessmentStatusCounts',
            'bfrLevelCounts' => 'getBfrLevelCounts',
            'ssmrLevelCounts' => 'getSsmrLevelCounts',
            'jmrLevelCounts' => 'getJmrLevelCounts',
            'gpLevelCounts' => 'getGpLevelCounts',
            'wafLevelCounts' => 'getWafLevelCounts'
        ];

        $finalOutput = [];

        foreach ($columnsVisible as $column) {
            $filterKey = $column['filter_key'];
            $isEnabled = $column['show'] === 'true' && in_array($tab, $column['list'][$pageType] ?? []);

            if ($isEnabled) {
                if ($filterKey === 'selectionMatrixCounts') {
                    // $finalOutput[$filterKey] = []; // Static for now
                } elseif (isset($functionMap[$filterKey])) {
                    $functionName = $functionMap[$filterKey];
                    $finalOutput[$filterKey] = JobOpeningApplication::$functionName($id, $tab, $pageType);
                    
                    // Duplicate 'statusCounts' into 'lastStatusCounts' if present
                    if ($filterKey === 'statusCounts') {
                        $finalOutput['lastStatusCounts'] = $finalOutput['statusCounts'];
                    }
                }
            }
        }

        if ($tab == 8) {
            $allowedStatuses = [
                "Offered",
                "Offer Accepted",
                "Offer Declined",
                "Offer Expired"
            ];
            
            // Ensure the keys exist before filtering
            if (isset($finalOutput['statusCounts']) && is_array($finalOutput['statusCounts'])) {
                $finalOutput['statusCounts'] = array_intersect_key(
                    $finalOutput['statusCounts'],
                    array_flip($allowedStatuses)
                );
            }
        }
        

        return response()->json($finalOutput);
    }

    public function applicantDetails(Request $request, $jobOpeningId, $applicantId)
    {
        $page = request()->get('page');

        // Use the first service to get applicant details
        $responseData = $this->applicantDetailsService->getApplicantDetails($jobOpeningId, $applicantId, $page);
        $responseData['candidate'] = User::find($applicantId);
        return view('admin.talent-acquisition.job-advertisement.applicant-details.index', $responseData);
    }

    public function sendEmailsToSelected(Request $request) {

        $applicationIds = $request->input('applicant_ids');
        
        // $jobOpeningId = $request->input('job_opening_id');
        // 
        if ($applicationIds && count($applicationIds) > 0) {
            // $applications = JobOpeningApplication::where('job_opening_id', $jobOpeningId)->whereIn('user_id', $userIds)->where('application_status', 1)->get();
            $applications = JobOpeningApplication::whereIn('id', $applicationIds)->where('application_status', 1)->get();
           
            if($applications){
                // SendAssessmentEmailsJob::dispatch($applications);
                $application_emails = [];
                $application_ids = [];
                foreach($applications  as $application) {
                   
                    try {
                        $user = User::where('id', $application->user_id)->first();
                        $job_opening_id = $application->job_opening_id;
        
                      
                        if($user) {
        
                            $user->role_id = 8;
                            $user->role_name = 'candidate';
                            $user->save();
                          
                        }
                       
                        $application->status = 3;
                        
                        $application->save();
        
                        $application_emails[] = $application->external_user_email;

                        $application_ids[] = $application->id;

                    } catch (\Exception $e) {
                        // Exception handling
                        \Log::error('An error occurred while creating external user in the system: ' . $e->getMessage());
                    }
                   
                }
                

                // Send Email
                $mailableClass = 'send_assessment_link';
        
                $job_opening = JobOpening::find($job_opening_id);
        
                $data['Job Title'] = $job_opening->job_title ?? '';
                $data['Company Name'] = auth()->user()->userCompany()->first()->name ?? env('APP_NAME');
                $data["Candidate Full Name"] = $application->external_user_name ?? '';

                HelperFunctions::sendEmails($application_emails, $mailableClass, $data);

                // try {
                //     HelperFunctions::sendEmailOnStatusChange($application_ids,3);
                // } catch (\Throwable $th) {
                //     //throw $th;
                // }
                

                return response()->json([
                    'message' => 'Emails sent successfully!'
                ]);

            }else{
                return response()->json([
                    'message' => 'Application is withdrawal by candidate'
                ],400);

            }
            
        } else {
            return response()->json([
                'message' => 'Application is withdrawal by candidate'
            ],400);
        }
        return response()->json([
            'message' => 'Emails sent successfully!'
        ]);
    }

    public function applicationChangeShortlisted(Request $request){

        if($request->status == 5) {
 
            $jobOpeningApplications = JobOpeningApplication::whereIn('id',$request->applicant_ids)->update(['status'=>5]);
            $jobOpeningApplications = JobOpeningApplication::whereIn('id',$request->applicant_ids)->get();

            $application_ids = $request->applicant_ids;
            
            try {
                HelperFunctions::sendEmailOnStatusChange($application_ids,5);
            } catch (\Throwable $th) {
                //throw $th;
            }

            return response()->json([
                'message' => 'Candidates Shortlisted successfully!'
            ]);
    
        }
    }

    public function fetchUsersByApplicationIds(Request $request)
    {
        $applicationIds = $request->application_ids;

        $users = DB::table('job_opening_applications as joa')
            ->join('job_openings as jo', 'joa.job_opening_id', '=', 'jo.id')
            ->select('joa.user_id', 'jo.department_id')
            ->whereIn('joa.id', $applicationIds)
            ->get();

        return response()->json(['users' => $users]);
    }

    

}
