<?php

namespace App\Http\Controllers\Admin\TalentAcquisition;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Job;
use App\Models\JobCriticalFunction;
use App\Models\JobOpening;
use App\Models\JobOpeningApplicationDocument;
use App\Models\JobOpeningCriticalFunction;
use App\Models\JobOpeningJobSkill;
use App\Models\JobOpeningJobTechnicalSkill;
use App\Models\JobOpeningRelevantProfessionalCertificate;
use App\Models\JobOpeningRelevantTrainingProgram;
use App\Models\JobOpeningSecondaryScopeOfStudies;
use App\Models\JobOpeningSuitabilityRateSetting;
use App\Models\JobSecondaryScopeOfStudy;
use App\Models\MasterCompanyOverview;
use App\Models\MasterCurrency;
use App\Models\MasterEducationProgram;
use App\Models\Position;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobCreateAdvertisement extends Controller
{
    public function createJobAdvertisementForm(Request $request)
    {
        $step = $request->query('step', 1); 
        $jobOpeningId = (int)$request->query('jobOpeningId');
        $editMode = $request->query('edit', false);
        $jobId = $request->query('jobId');
        $draftMode = $request->query('draft', false);

        $user = Auth::user();
        $currencies = MasterCurrency::all();
        $educationProgram = MasterEducationProgram::all();
        $jobCriticalSkill = JobCriticalFunction::where('job_id', $jobId)->select('description')->get();
        
        $suitabilityRate = [];

        // Get base options from job_secondary_scope_of_studies
        $allSecondaryScopeOptions = DB::table('job_secondary_scope_of_studies')
            ->where('job_id', $jobId) 
            ->select('id', 'title as name', 'job_id')
            ->get()
            ->map(function ($scope) {
                return [
                    'id' => $scope->id,
                    'name' => $scope->name,
                    'job_id' => $scope->job_id,
                ];
            })->toArray();

        $secondaryScope = [];

        if (($editMode && $jobOpeningId) || ($draftMode && $jobOpeningId)) {
            // Get selected options from job_opening_secondary_scope_of_studies
            $jobOpeningSecondaryScopeOfStudies = DB::table('job_opening_secondary_scope_of_studies')
                ->join('job_openings', 'job_opening_secondary_scope_of_studies.job_opening_id', '=', 'job_openings.id')
                ->where('job_opening_secondary_scope_of_studies.job_opening_id', $jobOpeningId)
                ->where('job_openings.job_id', $jobId)
                ->select('job_opening_secondary_scope_of_studies.*', 'job_openings.job_id')
                ->get();

            $secondaryScope = $jobOpeningSecondaryScopeOfStudies->map(function ($scope) {
                return [
                    'id' => $scope->job_secondary_scope_of_study_id,
                    'name' => $scope->name,
                    'job_id' => $scope->job_id,
                ];
            })->toArray();

            // Merge all options (base + selected ones that aren't in base)
            $existingIds = array_column($allSecondaryScopeOptions, 'id');
            foreach ($secondaryScope as $scope) {
                if (!in_array($scope['id'], $existingIds)) {
                    $allSecondaryScopeOptions[] = $scope;
                }
            }

            $jobOpeningData = DB::table('job_openings')
                ->where('job_openings.id', $jobOpeningId)
                ->latest('job_openings.id')
                ->leftJoin('master_education_levels', 'job_openings.education_level_id', '=', 'master_education_levels.id')
                ->leftJoin('master_scope_of_studies', 'job_openings.scope_of_study', '=', 'master_scope_of_studies.id')
                ->leftJoin('master_company_benefits', 'job_openings.company_benefit_id', '=', 'master_company_benefits.id')
                ->leftJoin('master_company_overviews', 'job_openings.company_overview_id', '=', 'master_company_overviews.id')
                ->leftJoin('master_education_programs', 'job_openings.education_program_id', '=', 'master_education_programs.id')
                ->select(
                    'job_openings.*',
                    'master_education_levels.name as education_level_name',
                    'master_scope_of_studies.name as education_program_name',
                    'master_company_benefits.description as company_benefit_description',
                    'master_company_overviews.description as company_overview_description',
                    'master_education_programs.name as master_education_programs_name'
                )
                ->first();
                
            $suitabilityRate = JobOpeningSuitabilityRateSetting::where('job_opening_id', $jobOpeningId)->get();
            $jobApplicationDocument = JobOpeningApplicationDocument::where('job_opening_id', $jobOpeningId)->get();

            $companyOverviews = DB::table('master_company_overviews')->get();
            $companyBenefits = DB::table('master_company_benefits')->get();

            $relevantTrainingProgram = JobOpeningRelevantTrainingProgram::where('job_opening_id', $jobOpeningId)->get();
            $relevantProfessionalCertificate = JobOpeningRelevantProfessionalCertificate::where('job_opening_id', $jobOpeningId)->get();

            $relevantTrainingProgramData = $relevantTrainingProgram->map(function ($program) {
                return ['value' => $program->name];
            })->toArray();

            $relevantProfessionalCertificateData = $relevantProfessionalCertificate->map(function ($program) {
                return ['value' => $program->name];
            })->toArray();

            $locationData = DB::table('master_countries')->get();

            $cities = DB::table('master_cities')
                ->where('country_id', $jobOpeningData->country_id)
                ->where('state_id', $jobOpeningData->state_id)
                ->where('id', $jobOpeningData->city_id)
                ->get();

            $states = DB::table('master_states')
                ->where('country_id', $jobOpeningData->country_id)
                ->where('id', $jobOpeningData->state_id)
                ->get();
        }

        // Get job opening data for both modes
        $jobOpeningData = DB::table('job_openings')
            ->where('job_openings.job_id', $jobId)
            ->latest('job_openings.id')
            ->leftJoin('master_education_levels', 'job_openings.education_level_id', '=', 'master_education_levels.id')
            ->leftJoin('master_scope_of_studies', 'job_openings.education_program_id', '=', 'master_scope_of_studies.id')
            ->leftJoin('master_company_benefits', 'job_openings.company_benefit_id', '=', 'master_company_benefits.id')
            ->leftJoin('master_company_overviews', 'job_openings.company_overview_id', '=', 'master_company_overviews.id')
            ->leftJoin('master_education_programs', 'job_openings.education_program_id', '=', 'master_education_programs.id')
            ->select(
                'job_openings.*',
                'master_education_levels.name as education_level_name',
                'master_scope_of_studies.name as education_program_name',
                'master_company_benefits.description as company_benefit_description',
                'master_company_overviews.description as company_overview_description',
                'master_education_programs.name as master_education_programs_name'
            )
            ->first();

        // Handle step 7 separately
        if ($step == 7 && $jobOpeningId) {
            $jobOpeningSecondaryScopeOfStudies = DB::table('job_opening_secondary_scope_of_studies')
                ->where('job_opening_id', $jobOpeningId)
                ->select('id', 'job_secondary_scope_of_study_id', 'name')
                ->get();

            $secondaryScope = $jobOpeningSecondaryScopeOfStudies->map(function ($scope) {
                return [
                    'id' => $scope->job_secondary_scope_of_study_id,
                    'name' => $scope->name,
                ];
            })->toArray();
        }

        $jobsData = Job::with([
            'secondaryScopeOfStudies', 
            'skills', 
            'companyOverview',
            'companyBenefit'
            ])
            ->leftJoin('master_scope_of_studies', 'jobs.scope_of_study', '=', 'master_scope_of_studies.id')
            ->leftJoin('master_education_levels', 'jobs.education_level', '=', 'master_education_levels.id')
            ->select(
                'jobs.*',
                'master_scope_of_studies.name as master_scope_of_study_name',
                'master_education_levels.name as master_education_level_name'
            )
            ->where('jobs.id', $jobId)
            ->first();

        $job = Job::with('jobOpeningTechnicalSkill.masterTechnicalSkill')->find($jobId);

        if ($job) {
            $jobTechnicalSkill = $job->jobOpeningTechnicalSkill->map(function ($skill) use ($job) {
                return [
                    'id' => $job->id, 
                    'tech-id' => $skill->masterTechnicalSkill->id ?? null, 
                    'name' => $skill->masterTechnicalSkill->name ?? null, 
                ];
            })->toArray();
        }

        // Only set secondaryScope from jobsData if NOT in edit/draft mode
        if (!$editMode && !$draftMode) {
            if ($jobsData && $jobsData->secondaryScopeOfStudies) {
                $secondaryScope = $jobsData->secondaryScopeOfStudies->map(function ($scope) {
                    return [
                        'id' => $scope->id,
                        'name' => $scope->title,
                        'job_id' => $scope->job_id
                    ];
                })->toArray() ?? [];
            }

            $locationData = DB::table('master_countries')->get();
        }

        $criticalWorkFunction = JobOpeningCriticalFunction::where('job_opening_id', $jobOpeningId)->get();
        $relevantProfessionalCertificate = JobOpeningRelevantProfessionalCertificate::where('job_opening_id', $jobOpeningId)->get();
        $relevantTrainingProgram = JobOpeningRelevantTrainingProgram::where('job_opening_id', $jobOpeningId)->get();
        $jobApplicationDocument = JobOpeningApplicationDocument::where('job_opening_id', $jobOpeningId)->get();
        $suitabilityRate = JobOpeningSuitabilityRateSetting::where('job_opening_id', $jobOpeningId)->get();

        $companyOverviews = DB::table('master_company_overviews')->get();
        $companyBenefits = DB::table('master_company_benefits')->get();

        $companyOverviewData = $jobsData->companyOverview ? [
            'id' => $jobsData->companyOverview->id,
            'name' => $jobsData->companyOverview->name,
            'description' => $jobsData->companyOverview->description,
        ] : [];
        
        $companyBenefitData = $jobsData->companyBenefit ? [
            'id' => $jobsData->companyBenefit->id,
            'name' => $jobsData->companyBenefit->name,
            'description' => $jobsData->companyBenefit->description,
        ] : [];

        $postedDate = $jobOpeningData?->application_period_start_date 
            ? Carbon::parse($jobOpeningData->application_period_start_date)->format('j M Y') 
            : null;

        $endDate = $jobOpeningData?->application_period_end_date 
            ? Carbon::parse($jobOpeningData->application_period_end_date)->format('j M Y') 
            : null;

        $relevantTrainingProgramData = $relevantTrainingProgram->map(function ($program) {
            return ['value' => $program->name];
        })->toArray();

        $relevantProfessionalCertificateData = $relevantProfessionalCertificate->map(function ($program) {
            return ['value' => $program->name];
        })->toArray();

        $jobSoftSkill = $jobsData->skills->map(function ($scope) {
            return [
                'id' => $scope->id,
                'name' => $scope->title,
            ];
        })->toArray();


        return view(
            'admin.talent-acquisition.job-board.create-edit-job-advertisement.create-job-advertisement-page',
            compact(
                'jobsData',
                'currencies',
                'jobCriticalSkill',
                'secondaryScope',
                'allSecondaryScopeOptions', 
                'jobSoftSkill',
                'jobTechnicalSkill',
                'jobOpeningData',
                'criticalWorkFunction',
                'relevantTrainingProgram',
                'relevantProfessionalCertificate',
                'jobApplicationDocument',
                'suitabilityRate',
                'step',
                'jobOpeningId',
                'companyOverviewData',
                'companyBenefitData',
                'editMode',
                'draftMode',
                'companyOverviews',
                'companyBenefits',
                'relevantTrainingProgramData',
                'relevantProfessionalCertificateData',
                'locationData',
                'postedDate',
                'endDate',
                'jobId',
                'educationProgram'
            )
        );
    }

    public function getCities($state_id)
    {
        $cities = DB::table('master_cities')
            ->where('state_id', $state_id)
            ->get();

        return response()->json([
            'cities' => $cities
        ]);
    }

    public function getStates($country_id)
    {
        $states = DB::table('master_states')
            ->where('country_id', $country_id)
            ->get();

        return response()->json([
            'states' => $states
        ]);
    }

    public function createVacancyDetails(Request $request)
    {

        $validatedData = $request->validate([
            'jobTitle' => 'required|string|max:255',
            'jobId' => 'required|string|max:255',
            'orgDepartmentId' => 'required|string|max:255',
            'totalVacancies' => 'required|integer',
            'employmentType' => 'required|integer',
            'jobLocation' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'currency' => 'required|string',
            'minSalary' => 'required|numeric',
            'maxSalary' => 'required|numeric',
            'education_level' => 'nullable|integer',
            'country_id' => 'required|integer',
            'city_id' => 'required|integer',  
            'state_id' => 'required|integer',  
        ]);

        $currencyParts = explode('|', $validatedData['currency']);
        $currencyShortName = $currencyParts[0];
        $currencyLongName = $currencyParts[1];

        $startDate = new DateTime($validatedData['startDate']);
        $startDateFormatted = $startDate->format('Y-m-d');

        $endDate = new DateTime($validatedData['endDate']);
        $endDateFormatted = $endDate->format('Y-m-d');

        $slug = $this->createUniqueSlug($validatedData['jobTitle']);

        $companyId = (Auth::check() && !empty(Auth::user()->company_id))
                    ? Auth::user()->company_id
                    : config('helpers.company_id', 3);

        $averageSalary = ($validatedData['minSalary'] + $validatedData['maxSalary']) / 2;

        $salary = intval(max($validatedData['minSalary'], $averageSalary));
        
        $jobOpening = JobOpening::create([
            'job_title' => $validatedData['jobTitle'],
            'department_id' => $validatedData['orgDepartmentId'],
            'vacancies' => $validatedData['totalVacancies'],
            'employment_type' => $validatedData['employmentType'],
            'job_location_type' => $validatedData['jobLocation'],
            'salary' => $salary,
            'application_period_start_date' => $startDateFormatted,
            'application_period_end_date' => $endDateFormatted,
            'salary_lower_bound' => $validatedData['minSalary'],
            'salary_upper_bound' => $validatedData['maxSalary'],
            'currency_short_name' => $currencyShortName,
            'currency_long_name' => $currencyLongName,
            'job_id' => $validatedData['jobId'],
            'education_level_id' => $validatedData['education_level'],
            'education_program_id' => 1,
            'slug' => $slug,
            'country_id' => $validatedData['country_id'],
            'city_id' => $validatedData['city_id'],
            'state_id' => $validatedData['state_id'],
            'company_id' => $companyId,
        ]);

        if (!empty($validatedData['education_level'])) {
            DB::table('jobs')
                ->where('id', $validatedData['jobId'])
                ->update(['education_level' => $validatedData['education_level']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Vacancy details saved successfully!',
            'jobOpeningId' => $jobOpening->id,
        ]);
    }

    public function updateVacancyDetails(Request $request)
    {
        $validatedData = $request->validate([
            'jobOpeningId' => 'required|integer',
            'jobTitle' => 'required|string|max:255',
            'totalVacancies' => 'required|integer',
            'employmentType' => 'required|integer',
            'jobLocation' => 'required|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'currency' => 'required|string',
            'minSalary' => 'required|numeric',
            'maxSalary' => 'required|numeric',
            'country_id' => 'nullable|integer',
            'state_id' => 'nullable|integer',
            'city_id' => 'nullable|integer',
        ]);
    
        $startDate = new DateTime($validatedData['startDate']);
        $startDateFormatted = $startDate->format('Y-m-d');
    
        $endDate = new DateTime($validatedData['endDate']);
        $endDateFormatted = $endDate->format('Y-m-d');
    
        $jobOpening = JobOpening::findOrFail($validatedData['jobOpeningId']);
        
        $averageSalary = ($validatedData['minSalary'] + $validatedData['maxSalary']) / 2;

        $salary = intval(max($validatedData['minSalary'], $averageSalary));
    
        $updateData = [
            'job_title' => $validatedData['jobTitle'],
            'vacancies' => $validatedData['totalVacancies'],
            'employment_type' => $validatedData['employmentType'],
            'job_location_type' => $validatedData['jobLocation'],
            'salary' => $salary,
            'application_period_start_date' => $startDateFormatted,
            'application_period_end_date' => $endDateFormatted,
            'salary_lower_bound' => $validatedData['minSalary'],
            'salary_upper_bound' => $validatedData['maxSalary'],
            'currency_short_name' => explode('|', $validatedData['currency'])[0],
            'currency_long_name' => explode('|', $validatedData['currency'])[1],
        ];
    
        if (isset($validatedData['country_id'])) {
            $updateData['country_id'] = $validatedData['country_id'];
        }
        if (isset($validatedData['state_id'])) {
            $updateData['state_id'] = $validatedData['state_id'];
        }
        if (isset($validatedData['city_id'])) {
            $updateData['city_id'] = $validatedData['city_id'];
        }
    
        $jobOpening->update($updateData);
    
        return response()->json([
            'success' => true,
            'message' => 'Vacancy details updated successfully!',
            'jobOpeningId' => $validatedData['jobOpeningId'],
        ]);
    }

    public function createJobDetails(Request $request)
    {
       
        $validatedData = $request->validate([
            'jobOpeningId' => 'required|integer', 
            'jobRoleDescription' => 'required|string',
            'criticalWorkFunction' => 'required|array', 
        ]);

        $jobOpening = JobOpening::findOrFail($validatedData['jobOpeningId']);

        $jobOpening->update([
            'job_role_description' => $validatedData['jobRoleDescription'],
        ]);

        foreach ($validatedData['criticalWorkFunction'] as $function) {
            JobOpeningCriticalFunction::create([
                'job_opening_id' => $validatedData['jobOpeningId'], 
                'description' => $function,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Job details updated successfully!',
            'jobOpeningId' => $jobOpening->id,
        ]);
    }

    public function createJobQualifications(Request $request)
    {
        $validatedData = $request->validate([
            'jobOpeningId' => 'required|integer', 
            'jobId' => 'required|string|max:255',
            'education_level' => 'required|string',
            'education_program' => 'required|string',
            'scope_of_study' => 'nullable|integer',
            'secondary_scope_of_study' => 'nullable|array', 
            'relevant_professional_certificates' => 'nullable|string', 
            'relevant_training_program' => 'nullable|string', 
            'experience_range' => 'required|string',
        ]);

        $experienceRange = $validatedData['experience_range'];
        $minExperience = 0;
        $maxExperience = 0;

        switch ($experienceRange) {
            case 'no_experience':
                $minExperience = 0;
                $maxExperience = 0;
                break;
            case 'less_than_1_year':
                $minExperience = 0;
                $maxExperience = 1;
                break;
            case '1_2_years':
                $minExperience = 1;
                $maxExperience = 2;
                break;
            case '3_5_years':
                $minExperience = 3;
                $maxExperience = 5;
                break;
            case '6_8_years':
                $minExperience = 6;
                $maxExperience = 8;
                break;
            case '9_10_years':
                $minExperience = 9;
                $maxExperience = 10;
                break;
            case 'more_than_10_years':
                $minExperience = 10;
                $maxExperience = 0;
                break;
            default:
                $minExperience = 0;
                $maxExperience = 0;
        }

        $educationLevelMapping = array_flip(config('helpers.education_level'));
        $educationLevelText = $validatedData['education_level'] ?? null;
        $validatedData['education_level'] = $educationLevelMapping[$educationLevelText] ?? 3;

        $professionalCertificateNames = [];
        if (!empty($validatedData['relevant_professional_certificates'])) {
            $professionalCertificates = json_decode($validatedData['relevant_professional_certificates'], true);
            $professionalCertificateNames = array_map(function($item) {
                return $item['value'];
            }, $professionalCertificates);
        }

        $trainingProgramNames = [];
        if (!empty($validatedData['relevant_training_program'])) {
            $trainingProgram = json_decode($validatedData['relevant_training_program'], true);
            $trainingProgramNames = array_map(function($item) {
                return $item['value'];
            }, $trainingProgram);
        }

        $jobOpening = JobOpening::findOrFail($validatedData['jobOpeningId']);

        $jobOpening->update([
            'education_level' => $validatedData['education_level'],
            'education_program_id' => $validatedData['education_program'],
            'scope_of_study' => $validatedData['scope_of_study'],
            'min_experience' => $minExperience,
            'max_experience' => $maxExperience,
        ]);

        if (!empty($validatedData['secondary_scope_of_study'])) {
            // First get all currently selected scopes (from the form)
            $selectedScopes = [];
            foreach ($validatedData['secondary_scope_of_study'] as $secondaryScope) {
                $parts = explode('|', $secondaryScope, 2);
                
                if (count($parts) === 2) {
                    $secondaryScopeId = trim($parts[0]);
                    $secondaryScopeTitle = trim($parts[1]);
                    
                    if ($secondaryScopeId == 0) {
                        // Create new scope if it doesn't exist
                        $newScope = JobSecondaryScopeOfStudy::firstOrCreate(
                            ['title' => $secondaryScopeTitle, 'job_id' => $validatedData['jobId']]
                        );
                        $secondaryScopeId = $newScope->id;
                    }
                    
                    $selectedScopes[$secondaryScopeId] = $secondaryScopeTitle;
                }
            }
        
            // Get all existing scopes for this job opening
            $existingScopes = JobOpeningSecondaryScopeOfStudies::where('job_opening_id', $validatedData['jobOpeningId'])
                ->get()
                ->keyBy('job_secondary_scope_of_study_id');
        
            // Delete scopes that are no longer selected
            foreach ($existingScopes as $scopeId => $scope) {
                if (!array_key_exists($scopeId, $selectedScopes)) {
                    $scope->delete();
                }
            }
        
            // Add new scopes that weren't previously selected
            foreach ($selectedScopes as $scopeId => $scopeTitle) {
                if (!$existingScopes->has($scopeId)) {
                    JobOpeningSecondaryScopeOfStudies::create([
                        'job_opening_id' => $validatedData['jobOpeningId'],
                        'job_secondary_scope_of_study_id' => $scopeId,
                        'name' => $scopeTitle,
                    ]);
                }
            }
        } else {
            // If no scopes are selected, delete all existing ones
            JobOpeningSecondaryScopeOfStudies::where('job_opening_id', $validatedData['jobOpeningId'])->delete();
        }

        foreach ($professionalCertificateNames as $certificate) {
            JobOpeningRelevantProfessionalCertificate::create([
                'job_opening_id' => $validatedData['jobOpeningId'],
                'name' => trim($certificate)
            ]);
        }

        foreach ($trainingProgramNames as $program) {
            JobOpeningRelevantTrainingProgram::create([
                'job_opening_id' => $validatedData['jobOpeningId'],
                'name' => trim($program)
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Job qualifications updated successfully!',
            'jobOpeningId' => $jobOpening->id,
        ]);
    }

    public function updateJobQualifications(Request $request)
    {
        $validatedData = $request->validate([
            'jobOpeningId' => 'required|integer', 
            'jobId' => 'required|integer',
            'education_level' => 'required|string',
            'education_program' => 'required|string',
            'scope_of_study' => 'nullable|integer',
            'experience_range' => 'required|string',
            'secondary_scope_of_study' => 'nullable|array', 
            'relevant_training_program' => 'nullable|string', 
            'relevant_professional_certificates' => 'nullable|string', 
        ]);

        $experienceRange = $validatedData['experience_range'];
        $minExperience = 0;
        $maxExperience = 0;

        switch ($experienceRange) {
            case 'no_experience':
                $minExperience = 0;
                $maxExperience = 0;
                break;
            case 'less_than_1_year':
                $minExperience = 0;
                $maxExperience = 1;
                break;
            case '1_2_years':
                $minExperience = 1;
                $maxExperience = 2;
                break;
            case '3_5_years':
                $minExperience = 3;
                $maxExperience = 5;
                break;
            case '6_8_years':
                $minExperience = 6;
                $maxExperience = 8;
                break;
            case '9_10_years':
                $minExperience = 9;
                $maxExperience = 10;
                break;
            case 'more_than_10_years':
                $minExperience = 10;
                $maxExperience = 0;
                break;
            default:
                $minExperience = 0;
                $maxExperience = 0;
        }

        $educationLevelMapping = array_flip(config('helpers.education_level'));
        $educationLevelText = $validatedData['education_level'];
        $validatedData['education_level'] = $educationLevelMapping[$educationLevelText] ?? null;

        if (!empty($validatedData['secondary_scope_of_study'])) {
            $submittedSecondaryScope = [];
            // First process all submitted scopes to handle new entries (id=0)
            foreach ($validatedData['secondary_scope_of_study'] as $scope) {
                
                [$id, $name] = array_pad(explode('|', $scope, 2), 2, null);
                $id = trim($id);
                $name = trim($name);
                
                // Handle new scopes (id=0)
                if (($id == 0) || ($name == "")) {
                    
                    if ($name == "") {
                        $newScope = JobSecondaryScopeOfStudy::firstOrCreate(
                            [
                                'title' => $id,
                                'job_id' => $validatedData['jobId']
                            ]
                        );
                    } else {
                        $newScope = JobSecondaryScopeOfStudy::firstOrCreate(
                            [
                                'title' => $name,
                                'job_id' => $validatedData['jobId']
                            ]
                        );
                    }
                    
                    $id = $newScope->id;
                }
                
                $submittedSecondaryScope[] = [
                    'job_secondary_scope_of_study_id' => $id,
                    'name' => $name,
                ];
            }
        
            // Get existing scopes for this job opening
            $existingSecondaryScope = JobOpeningSecondaryScopeOfStudies::where('job_opening_id', $validatedData['jobOpeningId'])->get();
        
            // Find records to delete (scopes that are no longer selected)
            $recordsToDelete = $existingSecondaryScope->filter(function ($record) use ($submittedSecondaryScope) {
                return !collect($submittedSecondaryScope)->contains('job_secondary_scope_of_study_id', $record->job_secondary_scope_of_study_id);
            });
        
            // Delete unwanted records
            foreach ($recordsToDelete as $record) {
                $record->delete();
            }
        
            // Find existing scope IDs for comparison
            $existingIds = $existingSecondaryScope->pluck('job_secondary_scope_of_study_id')->toArray();
            
            // Create new records for scopes that don't exist yet
            foreach ($submittedSecondaryScope as $scope) {
                if (!in_array($scope['job_secondary_scope_of_study_id'], $existingIds)) {
                    JobOpeningSecondaryScopeOfStudies::create([
                        'job_opening_id' => $validatedData['jobOpeningId'],
                        'job_secondary_scope_of_study_id' => $scope['job_secondary_scope_of_study_id'],
                        'name' => $scope['name'],
                    ]);
                }
            }
        } else {
            // If no scopes submitted, delete all existing ones
            JobOpeningSecondaryScopeOfStudies::where('job_opening_id', $validatedData['jobOpeningId'])->delete();
        }

        $jobOpening = JobOpening::findOrFail($validatedData['jobOpeningId']);

        $jobOpening->update([
            'education_level' => $validatedData['education_level'],
            'education_program_id' => $validatedData['education_program'],
            'scope_of_study' => $validatedData['scope_of_study'],
            'min_experience' => $minExperience,
            'max_experience' => $maxExperience,
        ]);

        if (!empty($validatedData['relevant_training_program'])) {

            $submittedPrograms = json_decode($validatedData['relevant_training_program'], true);

            $submittedProgramNames = array_map(function ($program) {
                return $program['value'];
            }, $submittedPrograms);

            $existingPrograms = JobOpeningRelevantTrainingProgram::where('job_opening_id', $validatedData['jobOpeningId'])->get();

            $programsToDelete = $existingPrograms->filter(function ($program) use ($submittedProgramNames) {
                return !in_array($program->name, $submittedProgramNames);
            });

            foreach ($programsToDelete as $program) {
                $program->delete();
            }

            $existingProgramNames = $existingPrograms->pluck('name')->toArray();
            $programsToAdd = array_filter($submittedProgramNames, function ($program) use ($existingProgramNames) {
                return !in_array($program, $existingProgramNames);
            });

            foreach ($programsToAdd as $program) {
                JobOpeningRelevantTrainingProgram::create([
                    'job_opening_id' => $validatedData['jobOpeningId'],
                    'name' => $program,
                ]);
            }
        } else {

            JobOpeningRelevantTrainingProgram::where('job_opening_id', $validatedData['jobOpeningId'])->delete();
        }

        if (!empty($validatedData['relevant_professional_certificates'])) {

            $submittedPrograms = json_decode($validatedData['relevant_professional_certificates'], true);

            $submittedProgramNames = array_map(function ($program) {
                return $program['value'];
            }, $submittedPrograms);

            $existingPrograms = JobOpeningRelevantProfessionalCertificate::where('job_opening_id', $validatedData['jobOpeningId'])->get();

            $programsToDelete = $existingPrograms->filter(function ($program) use ($submittedProgramNames) {
                return !in_array($program->name, $submittedProgramNames);
            });

            foreach ($programsToDelete as $program) {
                $program->delete();
            }

            $existingProgramNames = $existingPrograms->pluck('name')->toArray();
            $programsToAdd = array_filter($submittedProgramNames, function ($program) use ($existingProgramNames) {
                return !in_array($program, $existingProgramNames);
            });

            foreach ($programsToAdd as $program) {
                JobOpeningRelevantProfessionalCertificate::create([
                    'job_opening_id' => $validatedData['jobOpeningId'],
                    'name' => $program,
                ]);
            }
        } else {

            JobOpeningRelevantProfessionalCertificate::where('job_opening_id', $validatedData['jobOpeningId'])->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Job qualifications updated successfully!',
            'jobOpeningId' => $jobOpening->id,
        ]);
    }

    public function createJobSkills(Request $request)
    {
        $validatedData = $request->validate([
            'jobOpeningId' => 'required|integer', 
            'jobSoftSkills' => 'nullable|array',
            'jobSoftSkills.*.id' => 'nullable|integer',
            'jobTechnicalSkills' => 'nullable|array',
            'jobTechnicalSkills.*.tech-id' => 'nullable|integer',
        ]);
    
        $jobOpening = JobOpening::findOrFail($validatedData['jobOpeningId']);
    
        DB::beginTransaction();
    
        try {
            // Process technical skills if they exist
            if (isset($validatedData['jobTechnicalSkills'])) {
                foreach ($validatedData['jobTechnicalSkills'] as $skill) {
                    JobOpeningJobTechnicalSkill::create([
                        'job_opening_id' => $validatedData['jobOpeningId'],
                        'job_technical_skill_id' => $skill['tech-id'],
                    ]);
                }
            }
    
            // Process soft skills if they exist
            if (isset($validatedData['jobSoftSkills'])) {
                foreach ($validatedData['jobSoftSkills'] as $skill) {
                    JobOpeningJobSkill::create([
                        'job_opening_id' => $validatedData['jobOpeningId'],
                        'job_skill_id' => $skill['id'],
                    ]);
                }
            }
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => 'Skills saved successfully.',
                'jobOpeningId' => $jobOpening->id,
            ]);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to save skills: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function createOtherDetails(Request $request)
    {
        $validatedData = $request->validate([
            'jobOpeningId' => 'required|integer',
            'company_overview_id' => 'nullable|integer',
            'company_benefit_id' => 'nullable|integer',
        ]);

        $jobOpening = JobOpening::findOrFail($validatedData['jobOpeningId']);

        $jobOpening->update([
            'company_overview_id' => $validatedData['company_overview_id'],
            'company_benefit_id' => $validatedData['company_benefit_id']
        ]);

        // Handle default resume document with multiple file types
        if ($request->has('document_name_default')) {
            $fileTypes = $request->input('file_types_default', []);
            
            foreach ($fileTypes as $fileType) {
                JobOpeningApplicationDocument::create([
                    'job_opening_id' => $validatedData['jobOpeningId'],
                    'name' => $request->input('document_name_default'),
                    'is_required' => $request->input('document_required_default', 1),
                    'type' => $fileType,
                ]);
            }
        }

        // Handle additional documents

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'document_name_') === 0 && $key !== 'document_name_default') {
                $setId = str_replace('document_name_', '', $key); 
                $documentName = $value;
                $documentRequired = $request->input("document_required_{$setId}", 0); 
                $type = null;

                // if ($request->has("parent_{$setId}")) {
                //     if ($request->input("parent_{$setId}") == 'website-link') {
                //         $type = 'website-link';
                //     } else if ($request->input("parent_{$setId}") == 'parent2' && $request->has("child_{$setId}")) {
                //         $type = $request->input("child_{$setId}");
                //     }
                // }

                if ($request->has("parent_{$setId}")) {
                    if ($request->input("parent_{$setId}") == 'website-link') {
                        $type = 'website-link';
                    } else if ($request->input("parent_{$setId}") == 'parent2' && $request->has("child_{$setId}")) {
                        $type = $request->input("child_{$setId}");
                        $type = json_encode($type);
                    }
                }


                JobOpeningApplicationDocument::create([
                    'job_opening_id' => $validatedData['jobOpeningId'],
                    'name' => $documentName,
                    'is_required' => $documentRequired,
                    'type' => $type ?? '.pdf',
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Job details updated successfully!',
            'jobOpeningId' => $jobOpening->id,
        ]);
    }

    public function updateOtherDetails(Request $request)
    {
        $validatedData = $request->validate([
            'jobOpeningId' => 'required|integer',
            'company_overview_id' => 'nullable|integer',
            'company_benefit_id' => 'nullable|integer',
        ]);

        $jobOpening = JobOpening::findOrFail($validatedData['jobOpeningId']);

        $jobOpening->update([
            'company_overview_id' => $validatedData['company_overview_id'] ?? 0,
            'company_benefit_id' => $validatedData['company_benefit_id'] ?? 0,
        ]);

        $existingDocuments = JobOpeningApplicationDocument::where('job_opening_id', $validatedData['jobOpeningId'])->get();

        $resumeExists = $existingDocuments->contains('name', 'Resume');

        if ($request->has('document_name_default') && !$resumeExists) {
            $fileTypes = $request->input('file_types_default', []);
            
            foreach ($fileTypes as $fileType) {
                JobOpeningApplicationDocument::create([
                    'job_opening_id' => $validatedData['jobOpeningId'],
                    'name' => $request->input('document_name_default'),
                    'is_required' => $request->input('document_required_default', 1),
                    'type' => $fileType,
                ]);
            }
        }

        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'document_name_') === 0 && $key !== 'document_name_default') {
                $setId = str_replace('document_name_', '', $key); 
                $documentName = $value;
                $documentRequired = $request->input("document_required_{$setId}", 0); 
                $type = null;

                if ($request->has("parent_{$setId}")) {
                    if ($request->input("parent_{$setId}") == 'website-link') {
                        $type = 'website-link';
                    } else if ($request->input("parent_{$setId}") == 'parent2' && $request->has("child_{$setId}")) {
                        $type = $request->input("child_{$setId}");
                        $type = json_encode($type);
                    }
                }

                $existingDocument = $existingDocuments->firstWhere('id', $setId);

                if ($existingDocument) {
                    $existingDocument->update([
                        'name' => $documentName,
                        'is_required' => $documentRequired,
                        'type' => $type,
                    ]);
                } else {
                    JobOpeningApplicationDocument::create([
                        'job_opening_id' => $validatedData['jobOpeningId'],
                        'name' => $documentName,
                        'is_required' => $documentRequired,
                        'type' => $type,
                    ]);
                }
            }
        }

        $submittedDocumentIds = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'document_name_') === 0 && $key !== 'document_name_default') {
                $setId = str_replace('document_name_', '', $key);
                $submittedDocumentIds[] = $setId;
            }
        }

        // Don't delete Resume documents when cleaning up
        $existingDocuments->each(function ($document) use ($submittedDocumentIds) {
            if (!in_array($document->id, $submittedDocumentIds) && $document->name !== 'Resume') {
                $document->delete();
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Job details updated successfully!',
            'jobOpeningId' => $jobOpening->id,
        ]);
    }

    public function createHiringWorkflow(Request $request)
    {
        $validatedData = $request->validate([
            'jobOpeningId' => 'required|integer',
            'criteria' => 'required|array',
        ]);
    
        $jobOpening = JobOpening::findOrFail($validatedData['jobOpeningId']);
    
        foreach ($validatedData['criteria'] as $criteriaId => $criteriaData) {
            if (isset($criteriaData['checked'])) {
                JobOpeningSuitabilityRateSetting::create(
                    [
                        'job_opening_id' => $validatedData['jobOpeningId'],
                        'criteria_id' => $criteriaId,
                        'criteria_name' => config('helpers.suitability_criteria')[$criteriaId],
                        'weightage' => $criteriaData['weightage'],
                    ]
                );
            }
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Suitability rate settings updated successfully.',
            'jobOpeningId' => $jobOpening->id,
        ]);
    }

    public function updateHiringWorkflow(Request $request)
    {
        $validatedData = $request->validate([
            'jobOpeningId' => 'required|integer|exists:job_openings,id',
            'criteria' => 'required|array',
            'criteria.*.checked' => 'sometimes|boolean',
            'criteria.*.weightage' => 'required_if:criteria.*.checked,true|integer|min:0|max:100',
        ]);

        $jobOpening = JobOpening::findOrFail($validatedData['jobOpeningId']);

        $allCriteriaKeys = array_keys(config('helpers.suitability_criteria'));

        $payloadCriteriaKeys = array_keys($validatedData['criteria']);

        $criteriaToDelete = array_diff($allCriteriaKeys, $payloadCriteriaKeys);

        if (!empty($criteriaToDelete)) {
            JobOpeningSuitabilityRateSetting::where('job_opening_id', $validatedData['jobOpeningId'])
                ->whereIn('criteria_id', $criteriaToDelete)
                ->delete();
        }

        foreach ($validatedData['criteria'] as $criteriaId => $criteriaData) {

            $criteriaId = (int)$criteriaId;
        
            if (isset($criteriaData['checked']) && $criteriaData['checked']) {
                JobOpeningSuitabilityRateSetting::updateOrCreate(
                    [
                        'job_opening_id' => $validatedData['jobOpeningId'],
                        'criteria_id' => $criteriaId, 
                    ],
                    [
                        'criteria_name' => config('helpers.suitability_criteria')[$criteriaId],
                        'weightage' => $criteriaData['weightage'],
                    ]
                );
            } else {

                JobOpeningSuitabilityRateSetting::where('job_opening_id', $validatedData['jobOpeningId'])
                    ->where('criteria_id', $criteriaId)
                    ->delete();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Suitability rate settings updated successfully.',
            'jobOpeningId' => $jobOpening->id,
        ]);
    }

    public function saveDraft(Request $request)
    {
        $formId = $request->input('form_id');
        $step = $request->input('step');
        $draftMode = $request->input('draftMode') === 'true';

        $updateStepOnly = $request->input('update_step_only', false);

        if ($updateStepOnly) {
            $validatedData = $request->validate([
                'jobOpeningId' => 'required|integer',
                'step' => 'required|integer',
            ]);
    
            $jobOpening = JobOpening::findOrFail($validatedData['jobOpeningId']);
            $jobOpening->update([
                'steps_completed' => $validatedData['step'],
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Step updated successfully!'
            ]);
        }

        $validatedData = [];

        switch ($formId) {
            case 'vacancyDetailsForm':

                if ($draftMode && isset($validatedData['jobOpeningId'])) {
                     $validatedData = $request->validate([
                        'jobTitle' => 'required|string|max:255',
                        'jobId' => 'required|string|max:255',
                        'orgDepartmentId' => 'required|string|max:255',
                        'totalVacancies' => 'required|integer',
                        'employmentType' => 'required|integer',
                        'jobLocation' => 'required|string',
                        'startDate' => 'required|date',
                        'endDate' => 'required|date',
                        'currency' => 'required|string',
                        'minSalary' => 'required|numeric',
                        'maxSalary' => 'required|numeric',
                        'education_level' => 'nullable|integer',
                        'step' => 'required|integer',
                        'country_id' => 'required|integer',
                        'city_id' => 'required|integer',
                        'state_id' => 'required|integer',
                        'jobOpeningId' => 'sometimes|integer', // Add this line
                    ]);

                    $currencyParts = explode('|', $validatedData['currency']);
                    $currencyShortName = $currencyParts[0];
                    $currencyLongName = $currencyParts[1];

                    $startDate = new DateTime($validatedData['startDate']);
                    $startDateFormatted = $startDate->format('Y-m-d');

                    $endDate = new DateTime($validatedData['endDate']);
                    $endDateFormatted = $endDate->format('Y-m-d');

                    $companyId = (Auth::check() && !empty(Auth::user()->company_id))
                        ? Auth::user()->company_id
                        : config('helpers.company_id', 3);

                    $slug = $this->createUniqueSlug($validatedData['jobTitle']);

                    $averageSalary = ($validatedData['minSalary'] + $validatedData['maxSalary']) / 2;

                    $salary = intval(max($validatedData['minSalary'], $averageSalary));

                    $jobOpening = JobOpening::findOrFail($validatedData['jobOpeningId']);
                    $jobOpening->update([
                        'job_title' => $validatedData['jobTitle'],
                        'department_id' => $validatedData['orgDepartmentId'],
                        'vacancies' => $validatedData['totalVacancies'],
                        'employment_type' => $validatedData['employmentType'],
                        'job_location_type' => $validatedData['jobLocation'],
                        'application_period_start_date' => $startDateFormatted,
                        'application_period_end_date' => $endDateFormatted,
                        'salary' => $salary,
                        'salary_lower_bound' => $validatedData['minSalary'],
                        'salary_upper_bound' => $validatedData['maxSalary'],
                        'currency_short_name' => $currencyShortName,
                        'currency_long_name' => $currencyLongName,
                        'status' => 5,
                        'job_id' => $validatedData['jobId'],
                        'education_level_id' => $validatedData['education_level'],
                        'education_program_id' => 7,
                        'slug' => $slug,
                        'steps_completed' => $step,
                        'country_id' => $validatedData['country_id'],
                        'city_id' => $validatedData['city_id'],
                        'state_id' => $validatedData['state_id'],
                        'company_id' => $companyId,
                    ]);

                    if (!empty($validatedData['education_level'])) {
                        DB::table('jobs')
                            ->where('id', $validatedData['jobId'])
                            ->update(['education_level' => $validatedData['education_level']]);
                    }
                } 

                if (!$draftMode) {
                     $validatedData = $request->validate([
                        'jobTitle' => 'required|string|max:255',
                        'jobId' => 'required|string|max:255',
                        'orgDepartmentId' => 'required|string|max:255',
                        'totalVacancies' => 'required|integer',
                        'startDate' => 'required|date',
                        'currency' => 'required|string',
                        'education_level' => 'nullable|integer',
                        'step' => 'required|integer',
                        'country_id' => 'required|integer',
                        
                        'employmentType' => 'nullable|integer',
                        'jobLocation' => 'nullable|string',
                        'city_id' => 'nullable|integer',
                        'state_id' => 'nullable|integer',
                        'endDate' => 'nullable|date',
                        'minSalary' => 'nullable|numeric',
                        'maxSalary' => 'nullable|numeric',
                    ]);

                    $currencyParts = explode('|', $validatedData['currency']);
                    $currencyShortName = $currencyParts[0];
                    $currencyLongName = $currencyParts[1];

                    $startDate = new DateTime($validatedData['startDate']);
                    $startDateFormatted = $startDate->format('Y-m-d');

                    $endDate = new DateTime($validatedData['endDate']);
                    $endDateFormatted = $endDate->format('Y-m-d');

                    $companyId = (Auth::check() && !empty(Auth::user()->company_id))
                        ? Auth::user()->company_id
                        : config('helpers.company_id', 3);

                    $slug = $this->createUniqueSlug($validatedData['jobTitle']);

                    $averageSalary = ($validatedData['minSalary'] + $validatedData['maxSalary']) / 2;

                    $salary = intval(max($validatedData['minSalary'], $averageSalary));

                    $validatedData['employmentType'] = $validatedData['employmentType'] ?? 1;
                    $validatedData['minSalary'] = $validatedData['minSalary'] ?? 0;
                    $validatedData['maxSalary'] = $validatedData['maxSalary'] ?? 0;

                    JobOpening::create([
                        'company_id' => $companyId,
                        'department_id' => $validatedData['orgDepartmentId'],
                        'job_id' => $validatedData['jobId'],
                        'job_title' => $validatedData['jobTitle'],
                        'slug' => $slug,
                        'education_level_id' => $validatedData['education_level'],
                        'status' => 5,
                        'vacancies' => $validatedData['totalVacancies'],
                        'country_id' => $validatedData['country_id'], 
                        'application_period_start_date' => $startDateFormatted,
                        'currency_short_name' => $currencyShortName,
                        'currency_long_name' => $currencyLongName,
                        'steps_completed' => $step,  
                        'salary' => $salary,
                        'employment_type' => $validatedData['employmentType'],
                        'job_location_type' => $validatedData['jobLocation'],
                        'city_id' => $validatedData['city_id'],
                        'state_id' => $validatedData['state_id'],
                        'application_period_end_date' => $endDateFormatted,
                        'salary_lower_bound' => $validatedData['minSalary'],
                        'salary_upper_bound' => $validatedData['maxSalary'],
                    ]);

                    if (!empty($validatedData['education_level'])) {
                        DB::table('jobs')
                            ->where('id', $validatedData['jobId'])
                            ->update(['education_level' => $validatedData['education_level']]);
                    }
                }
                break;
            case 'jobDetailsForm':
                $validatedData = $request->validate([
                    'jobOpeningId' => 'required|integer', 
                    'jobRoleDescription' => 'required|string',
                    'criticalWorkFunction' => 'required|array',
                    'step' => 'required|integer',
                ]);

                $jobOpening = JobOpening::findOrFail($validatedData['jobOpeningId']);

                $jobOpening->update([
                    'job_role_description' => $validatedData['jobRoleDescription'],
                    'status' => 5,
                    'steps_completed' => $step
                ]);

                foreach ($validatedData['criticalWorkFunction'] as $function) {
                    JobOpeningCriticalFunction::create([
                        'job_opening_id' => $validatedData['jobOpeningId'], 
                        'description' => $function,
                    ]);
                }
                break;
            case 'jobQualificationsForm':
                $validatedData = $request->validate([
                    'jobOpeningId' => 'required|integer', 
                    'jobId' => 'required|integer',
                    'education_level' => 'required|string',
                    'scope_of_study' => 'required|integer',
                    'experience_range' => 'required|string',
                    'education_program' => 'required|string',
                    'secondary_scope_of_study' => 'nullable|array', 
                    'relevant_training_program' => 'nullable|string', 
                    'relevant_professional_certificates' => 'nullable|string', 
                    'step' => 'sometimes|integer',
                ]);
        
                $experienceRange = $validatedData['experience_range'];
                $minExperience = 0;
                $maxExperience = 0;
        
                switch ($experienceRange) {
                    case 'no_experience':
                        $minExperience = 0;
                        $maxExperience = 0;
                        break;
                    case 'less_than_1_year':
                        $minExperience = 0;
                        $maxExperience = 1;
                        break;
                    case '1_2_years':
                        $minExperience = 1;
                        $maxExperience = 2;
                        break;
                    case '3_5_years':
                        $minExperience = 3;
                        $maxExperience = 5;
                        break;
                    case '6_8_years':
                        $minExperience = 6;
                        $maxExperience = 8;
                        break;
                    case '9_10_years':
                        $minExperience = 9;
                        $maxExperience = 10;
                        break;
                    case 'more_than_10_years':
                        $minExperience = 10;
                        $maxExperience = 0;
                        break;
                    default:
                        $minExperience = 0;
                        $maxExperience = 0;
                }
        
                $educationLevelMapping = array_flip(config('helpers.education_level'));
                $educationLevelText = $validatedData['education_level'];
                $validatedData['education_level'] = $educationLevelMapping[$educationLevelText] ?? null;
        
                if (($draftMode && isset($validatedData['jobOpeningId']))) {
                    if (!empty($validatedData['secondary_scope_of_study'])) {
                        $submittedSecondaryScope = [];
                        
                        foreach ($validatedData['secondary_scope_of_study'] as $scope) {
                            [$id, $name] = array_pad(explode('|', $scope, 2), 2, null);
                            $id = trim($id);
                            $name = trim($name);
                            
                            if ($id == 0) {
                                $newScope = JobSecondaryScopeOfStudy::firstOrCreate(
                                    [
                                        'title' => $name,
                                        'job_id' => $validatedData['jobId']
                                    ]
                                );
                                $id = $newScope->id;
                            }
                            
                            $submittedSecondaryScope[] = [
                                'job_secondary_scope_of_study_id' => $id,
                                'name' => $name,
                            ];
                        }
                    
                        $existingSecondaryScope = JobOpeningSecondaryScopeOfStudies::where('job_opening_id', $validatedData['jobOpeningId'])->get();
                    
                        $recordsToDelete = $existingSecondaryScope->filter(function ($record) use ($submittedSecondaryScope) {
                            return !collect($submittedSecondaryScope)->contains('job_secondary_scope_of_study_id', $record->job_secondary_scope_of_study_id);
                        });
                    
                        foreach ($recordsToDelete as $record) {
                            $record->delete();
                        }
                    
                        foreach ($submittedSecondaryScope as $scope) {
                            $exists = JobOpeningSecondaryScopeOfStudies::where([
                                'job_opening_id' => $validatedData['jobOpeningId'],
                                'job_secondary_scope_of_study_id' => $scope['job_secondary_scope_of_study_id']
                            ])->exists();
                    
                            if (!$exists) {
                                JobOpeningSecondaryScopeOfStudies::create([
                                    'job_opening_id' => $validatedData['jobOpeningId'],
                                    'job_secondary_scope_of_study_id' => $scope['job_secondary_scope_of_study_id'],
                                    'name' => $scope['name'],
                                ]);
                            }
                        }
                    } else {
                        JobOpeningSecondaryScopeOfStudies::where('job_opening_id', $validatedData['jobOpeningId'])->delete();
                    }
                
                    $jobOpening = JobOpening::findOrFail($validatedData['jobOpeningId']);
                    $jobOpening->update([
                        'education_level' => $validatedData['education_level'],
                        'scope_of_study' => $validatedData['scope_of_study'],
                        'status' => 5,
                        'education_program_id' => $validatedData['education_program'],
                        'min_experience' => $minExperience,
                        'max_experience' => $maxExperience,
                    ]);
                
                    if (!empty($validatedData['relevant_training_program'])) {
                        $submittedPrograms = [];
                        $decodedPrograms = json_decode($validatedData['relevant_training_program'], true);
                        
                        foreach ($decodedPrograms as $program) {
                            $submittedPrograms[] = [
                                'name' => trim($program['value'])
                            ];
                        }
                    
                        $existingPrograms = JobOpeningRelevantTrainingProgram::where('job_opening_id', $validatedData['jobOpeningId'])->get();
                    
                        $recordsToDelete = $existingPrograms->filter(function ($record) use ($submittedPrograms) {
                            return !collect($submittedPrograms)->contains('name', $record->name);
                        });
                    
                        foreach ($recordsToDelete as $record) {
                            $record->delete();
                        }
                    
                        $existingNames = $existingPrograms->pluck('name')->toArray();
                        
                        foreach ($submittedPrograms as $program) {
                            if (!in_array($program['name'], $existingNames)) {
                                JobOpeningRelevantTrainingProgram::create([
                                    'job_opening_id' => $validatedData['jobOpeningId'],
                                    'name' => $program['name'],
                                ]);
                            }
                        }
                    } else {
                        JobOpeningRelevantTrainingProgram::where('job_opening_id', $validatedData['jobOpeningId'])->delete();
                    }
                
                    if (!empty($validatedData['relevant_professional_certificates'])) {
                        $submittedCertificates = [];
                        $decodedCertificates = json_decode($validatedData['relevant_professional_certificates'], true);
                        
                        foreach ($decodedCertificates as $certificate) {
                            $submittedCertificates[] = [
                                'name' => trim($certificate['value'])
                            ];
                        }
                    
                        $existingCertificates = JobOpeningRelevantProfessionalCertificate::where('job_opening_id', $validatedData['jobOpeningId'])->get();
                    
                        $recordsToDelete = $existingCertificates->filter(function ($record) use ($submittedCertificates) {
                            return !collect($submittedCertificates)->contains('name', $record->name);
                        });
                    
                        foreach ($recordsToDelete as $record) {
                            $record->delete();
                        }
                    
                        $existingNames = $existingCertificates->pluck('name')->toArray();
                        
                        foreach ($submittedCertificates as $certificate) {
                            if (!in_array($certificate['name'], $existingNames)) {
                                JobOpeningRelevantProfessionalCertificate::create([
                                    'job_opening_id' => $validatedData['jobOpeningId'],
                                    'name' => $certificate['name'],
                                ]);
                            }
                        }
                    } else {
                        JobOpeningRelevantProfessionalCertificate::where('job_opening_id', $validatedData['jobOpeningId'])->delete();
                    }
                } else {
                    $professionalCertificateNames = [];
                    if (!empty($validatedData['relevant_professional_certificates'])) {
                        $professionalCertificates = json_decode($validatedData['relevant_professional_certificates'], true);
                        $professionalCertificateNames = array_map(function($item) {
                            return $item['value'];
                        }, $professionalCertificates);
                    }
                
                    $trainingProgramNames = [];
                    if (!empty($validatedData['relevant_training_program'])) {
                        $trainingProgram = json_decode($validatedData['relevant_training_program'], true);
                        $trainingProgramNames = array_map(function($item) {
                            return $item['value'];
                        }, $trainingProgram);
                    }
                
                    $jobOpening = JobOpening::findOrFail($validatedData['jobOpeningId']);
                
                    $jobOpening->update([
                        'education_level' => $validatedData['education_level'],
                        'scope_of_study' => $validatedData['scope_of_study'],
                        'status' => 5,
                        'education_program_id' => $validatedData['education_program'],
                        'min_experience' => $minExperience,
                        'max_experience' => $maxExperience,
                        'steps_completed' => $step
                    ]);
                
                    if (!empty($validatedData['secondary_scope_of_study'])) {
                        $submittedSecondaryScope = [];
                        
                        foreach ($validatedData['secondary_scope_of_study'] as $scope) {
                            [$id, $name] = array_pad(explode('|', $scope, 2), 2, null);
                            $id = trim($id);
                            $name = trim($name);
                            
                            if ($id == 0) {
                                $newScope = JobSecondaryScopeOfStudy::firstOrCreate(
                                    ['title' => $name, 'job_id' => $validatedData['jobId']]
                                );
                                $id = $newScope->id;
                            }
                            
                            $submittedSecondaryScope[$id] = [
                                'job_secondary_scope_of_study_id' => $id,
                                'name' => $name,
                            ];
                        }
                    
                        $existingScopes = JobOpeningSecondaryScopeOfStudies::where('job_opening_id', $validatedData['jobOpeningId'])
                            ->get()
                            ->keyBy('job_secondary_scope_of_study_id');
                    
                        $submittedIds = array_keys($submittedSecondaryScope);
                        $existingIds = $existingScopes->keys()->toArray();
                    
                        $toDelete = array_diff($existingIds, $submittedIds);
                        if (!empty($toDelete)) {
                            JobOpeningSecondaryScopeOfStudies::where('job_opening_id', $validatedData['jobOpeningId'])
                                ->whereIn('job_secondary_scope_of_study_id', $toDelete)
                                ->delete();
                        }
                    
                        $toAdd = array_diff($submittedIds, $existingIds);
                        foreach ($toAdd as $scopeId) {
                            JobOpeningSecondaryScopeOfStudies::create([
                                'job_opening_id' => $validatedData['jobOpeningId'],
                                'job_secondary_scope_of_study_id' => $scopeId,
                                'name' => $submittedSecondaryScope[$scopeId]['name'],
                            ]);
                        }
                    } else {
                        JobOpeningSecondaryScopeOfStudies::where('job_opening_id', $validatedData['jobOpeningId'])
                            ->delete();
                    }
                
                    if (!empty($professionalCertificateNames)) {
                        $existingCertificates = JobOpeningRelevantProfessionalCertificate::where('job_opening_id', $validatedData['jobOpeningId'])
                            ->pluck('name')
                            ->toArray();
                            
                        foreach ($professionalCertificateNames as $certificate) {
                            $certificate = trim($certificate);
                            if (!in_array($certificate, $existingCertificates)) {
                                JobOpeningRelevantProfessionalCertificate::create([
                                    'job_opening_id' => $validatedData['jobOpeningId'],
                                    'name' => $certificate
                                ]);
                            }
                        }
                        
                        $submittedCertificates = array_map('trim', $professionalCertificateNames);
                        $toDeleteCertificates = array_diff($existingCertificates, $submittedCertificates);
                        if (!empty($toDeleteCertificates)) {
                            JobOpeningRelevantProfessionalCertificate::where('job_opening_id', $validatedData['jobOpeningId'])
                                ->whereIn('name', $toDeleteCertificates)
                                ->delete();
                        }
                    } else {
                        JobOpeningRelevantProfessionalCertificate::where('job_opening_id', $validatedData['jobOpeningId'])
                            ->delete();
                    }
                
                    if (!empty($trainingProgramNames)) {
                        $existingPrograms = JobOpeningRelevantTrainingProgram::where('job_opening_id', $validatedData['jobOpeningId'])
                            ->pluck('name')
                            ->toArray();
                            
                        foreach ($trainingProgramNames as $program) {
                            $program = trim($program);
                            if (!in_array($program, $existingPrograms)) {
                                JobOpeningRelevantTrainingProgram::create([
                                    'job_opening_id' => $validatedData['jobOpeningId'],
                                    'name' => $program
                                ]);
                            }
                        }
                        
                        $submittedPrograms = array_map('trim', $trainingProgramNames);
                        $toDeletePrograms = array_diff($existingPrograms, $submittedPrograms);
                        if (!empty($toDeletePrograms)) {
                            JobOpeningRelevantTrainingProgram::where('job_opening_id', $validatedData['jobOpeningId'])
                                ->whereIn('name', $toDeletePrograms)
                                ->delete();
                        }
                    } else {
                        JobOpeningRelevantTrainingProgram::where('job_opening_id', $validatedData['jobOpeningId'])
                            ->delete();
                    }
                }

                break;
            case 'jobSkillsForm':
                $validatedData = $request->validate([
                    'jobOpeningId' => 'required|integer', 
                    'jobSoftSkills' => 'nullable|array',
                    'jobSoftSkills.*.id' => 'nullable|integer',
                    'jobTechnicalSkills' => 'nullable|array',
                    'jobTechnicalSkills.*.tech-id' => 'nullable|integer',
                ]);
    
                $jobOpening = JobOpening::findOrFail($validatedData['jobOpeningId']);
                
                $jobOpening->update([
                    'status' => 5,
                    'steps_completed' => $step
                ]);
        
                DB::beginTransaction();
    
                try {
                    if (isset($validatedData['jobTechnicalSkills'])) {
                        foreach ($validatedData['jobTechnicalSkills'] as $skill) {
                            JobOpeningJobTechnicalSkill::create([
                                'job_opening_id' => $validatedData['jobOpeningId'],
                                'job_technical_skill_id' => $skill['tech-id'],
                            ]);
                        }
                    }
            
                    if (isset($validatedData['jobSoftSkills'])) {
                        foreach ($validatedData['jobSoftSkills'] as $skill) {
                            JobOpeningJobSkill::create([
                                'job_opening_id' => $validatedData['jobOpeningId'],
                                'job_skill_id' => $skill['id'],
                            ]);
                        }
                    }
            
                    DB::commit();
            
                    return response()->json([
                        'success' => true,
                        'message' => 'Skills saved successfully.',
                        'jobOpeningId' => $jobOpening->id,
                    ]);
            
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to save skills: ' . $e->getMessage(),
                    ], 500);
                }
                break;
                case 'otherDetailsForm':
                    $validatedData = $request->validate([
                        'jobOpeningId' => 'required|integer',
                        'company_overview_id' => 'nullable|integer',
                        'company_benefit_id' => 'nullable|integer',
                        'step' => 'sometimes|integer',
                    ]);
                
                    $jobOpening = JobOpening::findOrFail($validatedData['jobOpeningId']);
                
                    if ($draftMode) {
                        $jobOpening->update([
                            'status' => 5,
                            'company_overview_id' => $validatedData['company_overview_id'] ?? 0,
                            'company_benefit_id' => $validatedData['company_benefit_id'] ?? 0,
                        ]);
                
                        $existingDocuments = JobOpeningApplicationDocument::where('job_opening_id', $validatedData['jobOpeningId'])->get();
                
                        $resumeExists = $existingDocuments->contains('name', 'Resume');
                
                        if ($request->has('document_name_default') && !$resumeExists) {
                            $fileTypes = $request->input('file_types_default', []);
                            
                            foreach ($fileTypes as $fileType) {
                                JobOpeningApplicationDocument::create([
                                    'job_opening_id' => $validatedData['jobOpeningId'],
                                    'name' => $request->input('document_name_default'),
                                    'is_required' => $request->input('document_required_default', 1),
                                    'type' => $fileType,
                                ]);
                            }
                        }
                
                        $submittedDocumentIds = [];
                
                        foreach ($request->all() as $key => $value) {
                            if (strpos($key, 'document_name_') === 0 && $key !== 'document_name_default') {
                                $setId = str_replace('document_name_', '', $key);
                                $documentName = $value;
                                $documentRequired = $request->input("document_required_{$setId}", 0);
                                $type = null;
                
                                if ($request->has("parent_{$setId}")) {
                                    if ($request->input("parent_{$setId}") == 'website-link') {
                                        $type = 'website-link';
                                    } else if ($request->input("parent_{$setId}") == 'parent2' && $request->has("child_{$setId}")) {
                                        $type = $request->input("child_{$setId}");
                                    }
                                }
                
                                $existingDocument = $existingDocuments->firstWhere('id', $setId);
                
                                if ($existingDocument) {
                                    $existingDocument->update([
                                        'name' => $documentName,
                                        'is_required' => $documentRequired,
                                        'type' => $type,
                                    ]);
                                } else {
                                    JobOpeningApplicationDocument::create([
                                        'job_opening_id' => $validatedData['jobOpeningId'],
                                        'name' => $documentName,
                                        'is_required' => $documentRequired,
                                        'type' => $type,
                                    ]);
                                }
                
                                $submittedDocumentIds[] = $setId;
                            }
                        }
                
                        $existingDocuments->each(function ($document) use ($submittedDocumentIds) {
                            if (!in_array($document->id, $submittedDocumentIds) && $document->name !== 'Resume') {
                                $document->delete();
                            }
                        });
                    } else {
                        $jobOpening->update([
                            'status' => 5,
                            'company_overview_id' => $validatedData['company_overview_id'],
                            'company_benefit_id' => $validatedData['company_benefit_id'],
                            'steps_completed' => $step,
                        ]);
                
                        if ($request->has('document_name_default')) {
                            $fileTypes = $request->input('file_types_default', []);
                            
                            foreach ($fileTypes as $fileType) {
                                JobOpeningApplicationDocument::create([
                                    'job_opening_id' => $validatedData['jobOpeningId'],
                                    'name' => $request->input('document_name_default'),
                                    'is_required' => $request->input('document_required_default', 1),
                                    'type' => $fileType,
                                ]);
                            }
                        }
                
                        foreach ($request->all() as $key => $value) {
                            if (strpos($key, 'document_name_') === 0 && $key !== 'document_name_default') {
                                $setId = str_replace('document_name_', '', $key);
                                $documentName = $value;
                                $documentRequired = $request->input("document_required_{$setId}", 0);
                                $type = null;
                
                                if ($request->has("parent_{$setId}")) {
                                    if ($request->input("parent_{$setId}") == 'website-link') {
                                        $type = 'website-link';
                                    } else if ($request->input("parent_{$setId}") == 'parent2' && $request->has("child_{$setId}")) {
                                        $type = $request->input("child_{$setId}");
                                    }
                                }
                
                                JobOpeningApplicationDocument::create([
                                    'job_opening_id' => $validatedData['jobOpeningId'],
                                    'name' => $documentName,
                                    'is_required' => $documentRequired,
                                    'type' => $type,
                                ]);
                            }
                        }
                    }
                break;
            case 'hiringWorkflowForm':
                $validatedData = $request->validate([
                    'jobOpeningId' => 'required|integer',
                    'criteria' => 'required|array',
                    'step' => 'required|integer',
                ]);
            
                $jobOpening = JobOpening::findOrFail($validatedData['jobOpeningId']);
                $jobOpening->update([
                    'status' => 5,
                    'steps_completed' => $step
                ]);
            
                $allCriteriaKeys = array_keys(config('helpers.suitability_criteria'));
            
                $payloadCriteriaKeys = array_keys($validatedData['criteria']);
            
                $criteriaToDelete = array_diff($allCriteriaKeys, $payloadCriteriaKeys);
            
                if (!empty($criteriaToDelete)) {
                    JobOpeningSuitabilityRateSetting::where('job_opening_id', $validatedData['jobOpeningId'])
                        ->whereIn('criteria_id', $criteriaToDelete)
                        ->delete();
                }
            
                foreach ($validatedData['criteria'] as $criteriaId => $criteriaData) {
                    $criteriaId = (int)$criteriaId;
            
                    if (isset($criteriaData['checked']) && $criteriaData['checked']) {
                        JobOpeningSuitabilityRateSetting::updateOrCreate(
                            [
                                'job_opening_id' => $validatedData['jobOpeningId'],
                                'criteria_id' => $criteriaId,
                            ],
                            [
                                'criteria_name' => config('helpers.suitability_criteria')[$criteriaId],
                                'weightage' => $criteriaData['weightage'],
                            ]
                        );
                    } else {
                        JobOpeningSuitabilityRateSetting::where('job_opening_id', $validatedData['jobOpeningId'])
                            ->where('criteria_id', $criteriaId)
                            ->delete();
                    }
                }
                break;
            default:
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid form ID.',
                ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Draft saved successfully!'
        ]);
    }

    public function saveDraftPostingReview(Request $request)
    {
        $request->validate([
            'step' => 'required|integer',
            'jobOpeningId' => 'required|integer',
        ]);

        $step = $request->input('step');
        $jobOpeningId = $request->input('jobOpeningId');

        try {
            $updated = DB::table('job_openings')
                ->where('id', $jobOpeningId)
                ->update([
                    'status' => 5,
                    'steps_completed' => $step
                ]);

            if ($updated) {
                return response()->json(['message' => 'Draft saved successfully!'], 200);
            } else {
                return response()->json(['message' => 'Job opening not found.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while saving the draft.'], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $jobOpening = JobOpening::find($id);

        if ($jobOpening) {
            $status = $request->input('status');
        
            if ($status == 1) {
                if (!empty($jobOpening->application_period_start_date) &&
                    Carbon::parse($jobOpening->application_period_start_date)->lte(Carbon::today())) {
                    $status = 2;
                }
            }
        
            $jobOpening->status = $status;
            $jobOpening->save();
        
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function updateStatusReviewDetails(Request $request)
    {
        $request->validate([
            'jobOpeningId' => 'required|integer',
            'status' => 'required|integer',
        ]);

        $jobOpening = JobOpening::findOrFail($request->input('jobOpeningId'));

        $jobOpening->update([
            'status' => $request->input('status'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully!',
        ]);
    }


    public function reuseAdvertisement(Request $request)
    {
        $request->validate([
            'jobId' => 'required|integer',
            'jobOpeningId' => 'required|integer',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
        ]);

        $originalJobOpening = JobOpening::findOrFail($request->jobOpeningId);
        $originalJobs = Job::findOrFail($request->jobId);


        $newJobOpening = $originalJobOpening->replicate();

        $newJobOpening->slug = $this->createUniqueSlug($originalJobOpening->slug);

        $newJobOpening->application_period_start_date = $request->startDate;
        $newJobOpening->application_period_end_date = $request->endDate;
        $newJobOpening->vacancies = $originalJobs->vacancy;
        $newJobOpening->status = 1;

        $newJobOpening->save();

        $originalTechnicalSkills = JobOpeningJobTechnicalSkill::where('job_opening_id', $originalJobOpening->id)->get();
        foreach ($originalTechnicalSkills as $skill) {
            $newTechnicalSkill = $skill->replicate();
            $newTechnicalSkill->job_opening_id = $newJobOpening->id;
            $newTechnicalSkill->save();
        }

        $originalSkills = JobOpeningJobSkill::where('job_opening_id', $originalJobOpening->id)->get();
        foreach ($originalSkills as $skill) {
            $newSkill = $skill->replicate();
            $newSkill->job_opening_id = $newJobOpening->id;
            $newSkill->save();
        }

        $originalCricticalFunction = JobOpeningCriticalFunction::where('job_opening_id', $originalJobOpening->id)->get();
        foreach ($originalCricticalFunction as $critical) {
            $newCritical = $critical->replicate();
            $newCritical->job_opening_id = $newJobOpening->id;
            $newCritical->save();
        }

        $originalSecondaryScope = JobOpeningSecondaryScopeOfStudies::where('job_opening_id', $originalJobOpening->id)->get();
        foreach ($originalSecondaryScope as $secondScope){
            $newSecondScope = $secondScope->replicate();
            $newSecondScope->job_opening_id = $newJobOpening->id;
            $newSecondScope->save();
        }

        $originalRelevantProfessionalCertificate = JobOpeningRelevantProfessionalCertificate::where('job_opening_id', $originalJobOpening->id)->get();
        foreach ($originalRelevantProfessionalCertificate as $relevantProfessionalCertificate) {
            $newRelevantProfessionalCertificate = $relevantProfessionalCertificate->replicate();
            $newRelevantProfessionalCertificate->job_opening_id = $newJobOpening->id;
            $newRelevantProfessionalCertificate->save();
        }

        $originalRelevantTrainingrogram = JobOpeningRelevantTrainingProgram::where('job_opening_id', $originalJobOpening->id)->get();
        foreach ($originalRelevantTrainingrogram as $relevantTrainingProgram) {
            $newRelevantTrainingProgram = $relevantTrainingProgram->replicate();
            $newRelevantTrainingProgram->job_opening_id = $newJobOpening->id;
            $newRelevantTrainingProgram->save();
        }

        $originalApplicationDocument = JobOpeningApplicationDocument::where('job_opening_id', $originalJobOpening->id)->get();
        foreach ($originalApplicationDocument as $applicationDocument) {
            $newApplicationDocument = $applicationDocument->replicate();
            $newApplicationDocument->job_opening_id = $newJobOpening->id;
            $newApplicationDocument->save();
        }

        $originalSuitabilityRate = JobOpeningSuitabilityRateSetting::where('job_opening_id', $originalJobOpening->id)->get();
        foreach ($originalSuitabilityRate as $rate) {
            $newRate = $rate->replicate();
            $newRate->job_opening_id = $newJobOpening->id;
            $newRate->save();
        }

        return response()->json([
            'success' => true,
            'newJobOpeningId' => $newJobOpening->id,
        ]);
    }

    public function destroy($id)
    {
        try {
            $jobOpening = JobOpening::find($id);
    
            if (!$jobOpening) {
                return response()->json(['success' => false, 'error' => 'Job opening not found'], 404);
            }
    
            $jobOpening->delete();
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error("Failed to delete job opening ID $id: " . $e->getMessage());
    
            return response()->json(['success' => false, 'error' => 'Server error'], 500);
        }
    }
    

    /**
     * Generate a unique slug based on the job title.
     *
     * @param string $title The job title.
     * @param int $id The ID of the job opening (for updates).
     * @return string The unique slug.
    */
    private function createUniqueSlug($title, $id = 0)
    {
        $slug = Str::slug($title, '-');

        $allSlugs = JobOpening::select('slug')
            ->where('slug', 'like', $slug . '%')
            ->where('id', '!=', $id)
            ->pluck('slug');

        if (!$allSlugs->contains($slug)) {
            return $slug;
        }

        for ($i = 1; $i <= 200; $i++) {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains($newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Cannot create a unique slug');
    }

}
