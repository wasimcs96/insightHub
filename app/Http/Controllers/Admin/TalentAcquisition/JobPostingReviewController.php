<?php

namespace App\Http\Controllers\Admin\TalentAcquisition;

use App\Http\Controllers\Controller;
use App\Models\JobOpening;
use App\Models\JobOpeningCriticalFunction;
use App\Models\JobOpeningJobTechnicalSkill;
use App\Models\JobOpeningRelevantProfessionalCertificate;
use App\Models\JobOpeningRelevantTrainingProgram;
use App\Models\JobTechnicalSkills;
use App\Models\MasterTechnicalSkill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobPostingReviewController extends Controller
{
    public function jobPreview(Request $request){

        $jobOpeningId = $request->query('jobOpeningId');
        $jobId = $request->query('jobId');
        $editMode = $request->query('edit', false);

        $jobOpeningData = DB::table('job_openings')
            ->where('job_openings.job_id', $jobId)
            ->where('job_openings.id', $jobOpeningId)
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
                'master_education_programs.name as education_program'
            )
            ->first();

        $criticalWorkFunction = JobOpeningCriticalFunction::where('job_opening_id',  $jobOpeningId)->get();

        $technicalSkillList = DB::table('job_openings as a')
            ->join('job_opening_job_technical_skills as b', 'a.id', '=', 'b.job_opening_id')
            ->join('job_technical_skills as c', 'b.job_technical_skill_id', '=', 'c.id')
            ->join('technical_skills as d', 'c.master_technical_skill_id', '=', 'd.id')
            ->select(
                'a.id as job_opening_id',
                'b.id as job_opening_job_technical_skills_id',
                'c.id as job_technical_skills_id',
                'd.id as technical_skills',
                'd.name as technical_skills_name'
            )
            ->where('a.id',  $jobOpeningId)
            ->get();

        
        $softSkillList = DB::table('job_openings as a')
        ->join('job_opening_job_skills as b', 'a.id', '=', 'b.job_opening_id')
        ->join('job_skills as c', 'b.job_skill_id', '=', 'c.id')
        ->select(
            'a.id as job_opening_id',
            'b.id as job_opening_job_technical_skills_id',
            'c.id as job_technical_skills_id',
            'c.title as job_skill_name'
        )
        ->where('a.id',  $jobOpeningId)
        ->get();

        $postedDate = $jobOpeningData?->application_period_start_date 
            ? Carbon::parse($jobOpeningData->application_period_start_date)->format('j M Y') 
            : null;

        $endDate = $jobOpeningData?->application_period_end_date 
            ? Carbon::parse($jobOpeningData->application_period_end_date)->format('j M Y') 
            : null;
            
        $relevantTrainingProgram = JobOpeningRelevantTrainingProgram::where('job_opening_id',  $jobOpeningId)->get();
        $relevantProfessionalCertificate = JobOpeningRelevantProfessionalCertificate::where('job_opening_id',  $jobOpeningId)->get();

        $employmentTypes = config('helpers.employment_type');
        $employmentTypeKey = array_search($jobOpeningData->employment_type, $employmentTypes);

        $jobOpeningSecondaryScopeOfStudies = DB::table('job_opening_secondary_scope_of_studies')
        ->join('job_openings', 'job_opening_secondary_scope_of_studies.job_opening_id', '=', 'job_openings.id')
        ->where('job_opening_secondary_scope_of_studies.job_opening_id',  $jobOpeningId) 
        ->select('job_opening_secondary_scope_of_studies.*')
        ->get();

        $locationData = DB::table('master_cities as c')
            ->join('master_states as s', 'c.state_id', '=', 's.id')
            ->join('master_countries as co', 'c.country_id', '=', 'co.id')
            ->select(
                'c.id as city_id',
                'c.name as city_name',
                's.id as state_id',
                's.name as state_name',
                'co.id as country_id',
                'co.name as country_name'
            )
            ->where('c.id', $jobOpeningData->city_id)      
            ->where('s.id', $jobOpeningData->state_id)    
            ->where('co.id', $jobOpeningData->country_id) 
            ->first();
            
        return view(
            'admin.talent-acquisition.job-board.create-edit-job-advertisement.job-posting-preview-page',
            compact(
                'jobOpeningData',
                'criticalWorkFunction',
                'technicalSkillList',
                'softSkillList',
                'postedDate',
                'endDate',
                'employmentTypeKey',
                'jobOpeningSecondaryScopeOfStudies',
                'relevantTrainingProgram',
                'relevantProfessionalCertificate',
                'jobOpeningId',
                'locationData',
                'jobId',
                'editMode',
            )
        );
    }
}
