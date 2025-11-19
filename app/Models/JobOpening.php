<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\BelongsToTenant;


class JobOpening extends Model
{
    use HasFactory, BelongsToTenant;
    
    protected $guarded = ['id'];

    public function cities() {
        return $this->hasMany(JobOpeningCity::class);
    }



    public function country() {
        return $this->belongsTo(MasterCountry::class);
    }

    // public function jobs() {
    //     return $this->hasMany(Job::class);
    // }

    public function jobs()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function job() {
        return $this->belongsTo(Job::class);
    }

    public function job_skills()
    {
        return $this->hasMany(JobOpeningJobSkill::class);
    }

    public function job_technical_skills()
    {
        return $this->hasMany(JobOpeningJobTechnicalSkill::class);
    }

    public function mainScopeOfStudy() {
        return $this->belongsTo(MasterScopeOfStudy::class, 'scope_of_study');
    }

    public function education_level() {
        return $this->belongsTo(MasterEducationLevel::class, 'education_level_id');
    }

    public function educationProgram()
    {
        return $this->belongsTo(MasterScopeOfStudy::class, 'education_program_id');
    }

    public function education_year() {
        return $this->belongsTo(MasterEducationYear::class, 'education_year_id');
    }

    public function education_program() {
        return $this->belongsTo(MasterEducationProgram::class, 'education_program_id');
    }

    public function industry() {
        return $this->belongsTo(MasterIndustry::class, 'industry_id');
    }

    // public function company()
    // {
    //     return $this->belongsTo(User::class, 'company_id');
    // }
    // In JobOpening.php
    public function company()
    {
        return $this->belongsTo(CompanyDetail::class, 'company_id');
    }


    // public function department()
    // {
    //     return $this->belongsTo(User::class, 'department_id');
    // }
    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id','id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }

    public function job_applications()
    {
        return $this->hasMany(JobOpeningApplication::class);
    }

    public function job_position()
    {
        return $this->belongsTo('App\Models\Job', 'job_id', 'id');
    }
    
    public function barangay()
    {

        return $this->belongsTo(MasterBarangay::class,'barangay_id');
    }

    public function province()
    {

        return $this->belongsTo(MasterProvince::class,'province_id');
    }

    public function city()
    {

        return $this->belongsTo(MasterCity::class,'city_id');
    }

    public function companyOverview()
    {

        return $this->belongsTo(MasterCompanyOverview::class,'company_overview_id');
    }

    public function state() {
        return $this->belongsTo(MasterState::class,'state_id');
    }

    // Average Time To Fill (average_time_to_fill)
    public function getAverageTimeToFillAttribute()
    {
        // Get all job opening applications with status 8 for this job opening
        $applications = $this->job_applications()
            ->where('status', 8)
            ->pluck('offer_accepted_date');

        // Calculate the differences in days and store in an array
        $differences = $applications->map(function ($offerAcceptedDate) {
            return Carbon::parse($offerAcceptedDate)->diffInDays($this->created_at);
        });

        // Calculate the average of the differences
        $averageDifference = $differences->average();

        // Return the average difference or null if there are no applications
        return $averageDifference ? $averageDifference." Days": "N/A";
    }

    // Get applicant count by status 
    public function getApplicantCountByStatus($status)
    {
        if($status == 0) {
            return $this->job_applications()
            ->count();
        }

        return $this->job_applications()
            ->where('status', $status)
            ->count();
    }

    // Get applicant count by status in single request
    public function getApplicantCountByStatuses()
    {
        // Define the application status array
        $applicationStatus = config('helpers.application_status');
        
        // Get the counts of applications grouped by status
        $statusCounts = $this->job_applications()
            ->select('status', \DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        // Prepare the result array
        $result = [];
        $result[0] = $this->job_applications()->count();
        foreach ($applicationStatus as $key => $label) {
            $result[$key] = $statusCounts->get($key, 0);
        }
        
        return $result;
    }
    
    // Non Optimized
    // public function getSalaryVariant() {
    //     // Get job opening salary
    //     $salary = $this->salary;

    //     $hiredApplicants = $this->job_applications()
    //                           ->where('status', 8)
    //                           ->pluck('user_id');
        
    //     $allHiredContracts = Contract::whereIn('employee_id', $hiredApplicants)->get();
    //     $allHiredCounts = $allHiredContracts->count();

    //     $totalSalaryOffered = 0;
    //     foreach($allHiredContracts as $allHiredContract) {
    //         $totalSalaryOffered = $totalSalaryOffered + $allHiredContract->basic_salary;
    //     }

    //     $salaryBudgetForJobOpening = $salary*$allHiredCounts;

    //     $result = 0;
    //     if($salaryBudgetForJobOpening > $totalSalaryOffered) {
    //         $percentage = (($salaryBudgetForJobOpening - $totalSalaryOffered) / $salaryBudgetForJobOpening)*100;
    //         $result = " + ". ($salaryBudgetForJobOpening - $totalSalaryOffered) . " (". number_format($percentage ?? 0, 2). "%)"; 
    //     } elseif ($salaryBudgetForJobOpening < $totalSalaryOffered) {
    //         $percentage = (($totalSalaryOffered - $salaryBudgetForJobOpening) / $salaryBudgetForJobOpening)*100;
    //         $result = " - ". ($totalSalaryOffered - $salaryBudgetForJobOpening) . " (". number_format($percentage ?? 0, 2). "%)";
    //     } else {
    //         $result = 0;
    //     }

    //     return $result;
    // }
    public function getSalaryVariant() {
        // Get job opening salary
        $salary = $this->salary;
    
        // Fetch all hired applicants' contracts and calculate total salary offered
        $totalSalaryOffered = Contract::whereIn('employee_id', $this->job_applications()
                                    ->where('status', 8)
                                    ->pluck('user_id'))
                                    ->sum('basic_salary');
    
        // Calculate the salary budget for the job opening
        $hiredCount = $this->job_applications()->where('status', 8)->count();
        $salaryBudgetForJobOpening = $salary * $hiredCount;
    
        // Determine the salary variant
        $difference = $salaryBudgetForJobOpening - $totalSalaryOffered;
        if ($difference != 0) {
            $percentage = (abs($difference) / $salaryBudgetForJobOpening) * 100;
            $sign = $difference > 0 ? '+' : '-';
            return sprintf("₱ %s %d (%.2f%%)", $sign, abs($difference), $percentage);
        }
    
        return 0;
    }

    // public function companyOverview()
    // {
    //     return $this->belongsTo(MasterCompanyOverview::class, 'company_overview_id');
    // }

    public function companyBenefits()
    {
        return $this->belongsTo(MasterCompanyBenefit::class, 'company_benefit_id');
    }
    
    public function secondaryScopeOfStudies()
    {
        return $this->hasMany(JobOpeningSecondaryScopeOfStudies::class, 'job_opening_id', 'id');
    }

    public function relevantProfessionalCertificates()
    {
        return $this->hasMany(JobOpeningRelevantProfessionalCertificate::class, 'job_opening_id', 'id');
    }

    public function relevantTrainingPrograms()
    {
        return $this->hasMany(JobOpeningRelevantTrainingProgram::class, 'job_opening_id', 'id');
    }

    public function requiredDocuments()
    {
        return $this->hasMany(JobOpeningApplicationDocument::class, 'job_opening_id', 'id');
    }

    public function suitabilityRateSettings()
    {
        return $this->hasMany(JobOpeningSuitabilityRateSetting::class, 'job_opening_id', 'id');
    }

    public function companyBenefit()
    {
        return $this->belongsTo(MasterCompanyBenefit::class, 'company_benefit_id');
    }

    public function companyOveriew()
    {
        return $this->belongsTo(MasterCompanyOverview::class, 'company_overview_id');
    }

}
