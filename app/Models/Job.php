<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\Events\JobExceptionOccurred;
use App\Models\Sector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Traits\HandlesJobLevelConsistency;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\BelongsToTenant;



class Job extends Model implements Auditable
{   
    use \OwenIt\Auditing\Auditable;
    use HasFactory, BelongsToTenant;
    use HandlesJobLevelConsistency;

    protected $table = "jobs";
    protected $guarded = [];
    protected $appends = ['job_full_title','vacancy'];

    public function getVacancyAttribute()
    {
        return $this->headcounts()
            ->whereNull('user_id')
            ->count();
    }


    protected function getJobFullTitleAttribute()
    {
        // Ensure OrgDepartment and level are not null before accessing their properties
        $departmentName = $this->OrgDepartment ? $this->OrgDepartment->name : 'No Department';
        $level = $this->level ? $this->level : 'No Level';

        return $this->title . ' (' . $departmentName . ') - Level ' . $level;
    }



    public static function generateUniquePositionCode()
    {
        do {
            $code = Str::random(10); // Generate a random 10-character string
        } while (self::where('position_code', $code)->exists());

        return $code;
    }

    public function masterJob()
    {
        return $this->belongsTo(Job::class, 'master_id');
    }

    public function skills()
    {
        return $this->hasMany(JobSkill::class);
    }

    public function jobProfile()
    {
        return $this->belongsTo(JobProfile::class, 'job_profile_id');
    }
    public function businessUnit()
    {
        return $this->belongsTo(BusinessUnit::class, 'business_unit_id');
    }
     public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
    public function criticalFunctions()
    {
        return $this->hasMany(JobCriticalFunction::class);
    }
    public function jdTechSkills()
    {
        return $this->hasMany(JobTechnicalSkills::class, 'job_id');
    }
    public function technicalSkills()
    {
        return $this->belongsToMany(MasterTechnicalSkill::class, 'job_technical_skills')->withPivot('id','level');
    }

    public function techSkills()
    {
        return $this->hasMany(JobTechnicalSkills::class, 'job_id')->with('technicalSkill');
    }

    public function jobOpeningTechSkills()
    {
        return $this->hasMany(JobTechnicalSkills::class, 'job_id');
    }

    public function employees()
    {
        return $this->hasMany(User::class,'position_id')->where('role_name', 'employee');
    }

    public function subordinates()
    {
        return $this->hasMany(JobSubordinate::class);
    }


    public function jobExpectations()
    {
        return $this->hasMany(JobPerformanceExpectation::class);
    }

    public function jobSecondaryScopeOfStudies()
    {
        return $this->hasMany(JobSecondaryScopeOfStudy::class);
    }

    public function secondaryScopeOfStudies(){
        return $this->hasMany(JobSecondaryScopeOfStudy::class, 'job_id');
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class,'department_id');
    }  

    public function OrgDepartment()
    {
        return $this->belongsTo(Department::class,'department_id');
    }  

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }  
      
    public function superior() {
        return $this->belongsTo(Job::class, 'superior_id');
    }

    public function subordinates_s() {
        return $this->hasMany(Job::class, 'superior_id');
    }

    public function llmSoftSkillDescriptions() {
        return $this->hasMany(LlmSoftSkillDescription::class);
    }

    public function subordinateJobs() {
        return $this->belongsToMany(Job::class, 'job_subordinates', 'job_id', 'subordinate_id');
    }

    public function superiorJobs() {
        return $this->belongsToMany(Job::class, 'job_subordinates', 'subordinate_id', 'job_id');
    }

    public function jobOpenings()
    {
        return $this->hasMany(JobOpening::class,'id','position_id');
    }

    public function interviewQuestion()
    {
        return $this->hasMany(MasterInterviewQuestion::class,'id','position_id');
    }

    public function educationLevel()
    {
        return $this->belongsTo(MasterEducationLevel::class,'education_level');
    }  
      
    public function scopeStudy() {
        return $this->belongsTo(MasterScopeOfStudy::class, 'scope_of_study');
    }

    public function technicalQuestions()
    {
        return $this->hasMany(MasterTechnicalQuestion::class,'job_id');
    }
    
    // App\Models\Job
    public function companyOverview()
    {
        return $this->belongsTo(MasterCompanyOverview::class, 'company_overview_id');
    }

    public function companyBenefit()
    {
        return $this->belongsTo(MasterCompanyBenefit::class, 'company_benefit_id');
    }

    public function jobOpening()
    {
        return $this->hasOne(JobOpening::class, 'job_id');
    }

    public function jobOpeningTechnicalSkill()
    {
        return $this->hasMany(JobTechnicalSkills::class, 'job_id');
    }

    public function hasOngoingAdvertisement()
    {
        return $this->jobOpening()
        ->whereIn('status', [1, 2, 5])
        ->pluck('status')
        ->map(function($status) {
            if ($status == 1) {
                return 1;
            } elseif ($status == 2) {
                return 2;
            } elseif ($status == 5) {
                return 3;
            } else {
                return 0;
            }
        })
        ->first();
    }

    public function headcounts()
    {
        return $this->hasMany(JobHeadcount::class, 'job_id');
    }

    public function children()
    {
        return $this->hasMany(Job::class, 'superior_id')->with('children'); // recursion
    }

    public function vacantHeadcounts(): HasMany
    {
        return $this->hasMany(JobHeadcount::class)->whereNull('user_id');
    }

    // Repository-based methods
    public function getVacantHeadcountsFormatted()
    {
        return JobHeadcount::repository()->getVacantHeadcountsFormatted($this->id);
    }

    public function getHeadcountStats(): array
    {
        return JobHeadcount::repository()->getHeadcountStatsByJobId($this->id);
    }

}