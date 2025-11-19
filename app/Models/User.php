<?php

namespace App\Models;

use App\Helpers\AssessmentHelper;
use App\Traits\BelongsToTenant;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{   
    use HasRoles;
    protected $guard_name = 'web';
    // Note: Don't use BelongsToTenant trait on User model to avoid auth loops

    protected $guarded = ['id'];

    protected $casts = [
        'last_report_downloaded_at' => 'datetime',
    ];

    protected $appends = ['role_name'];

    // protected $fillable = [
    //     'first_name',
    //     'last_name',
    //     'name',
    //     'email',
    //     'email_verified_at',
    //     'password',
    //     'is_personality_motivation_completed',
    //     'is_work_interest_completed',
    //     'is_english_proficiency_completed',
    //     'is_work_values_completed',
    //     'is_employability_completed',
    //     'is_future_of_work_completed',
    //     'is_cognitive_ability_completed',
    //     'birth_date',
    //     'education_level',
    //     'higher_learning_institution',
    //     'scope_of_study',
    //     'do_you_have_experience_in_it_sector',
    //     'year_of_experience_in_it_sector',
    //     'gender',
    //     'age',
    //     'is_admin',
    //     'home_address',
    //     'mailing_address',
    //     'national_id',
    //     'passport_no',
    //     'passport_expiry_date',
    //     'mobile_number',
    //     'profile_picture',
    //     'sector_id',
    //     'city',
    //     'is_external_user',
    //     'external_user_id'
    // ];

    // Manual tenant relationship without global scope for User model
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    // Manually handle tenant scoping for User model when needed
    public function scopeForTenant($query, $tenantId)
    {
        return $query->where('tenant_id', $tenantId);
    }

    public function scopeWithoutTenantScope($query)
    {
        return $query; // No global scope to remove
    }

    // All your existing relationships and methods...
    public function employments()
    {
        return $this->hasMany(UserEmployment::class);
    }

    public function country()
    {
        return $this->belongsTo(MasterCountry::class, 'country_id');
    }

    public function nationality()
    {
        return $this->belongsTo(MasterCountry::class, 'national_id');
    }

    public function answers()
    {
        return $this->belongsTo(Survey_Answer::class, 'user_id');
    }

    public function barangay()
    {
        return $this->belongsTo(MasterBarangay::class, 'barangay_id');
    }

    public function mailBarangay()
    {
        return $this->belongsTo(MasterBarangay::class, 'mailing_barangay_id');
    }

    public function mailCity()
    {
        return $this->belongsTo(MasterCity::class, 'mailing_city_id');
    }

    public function state()
    {
        return $this->belongsTo(MasterState::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(MasterCity::class, 'city_id');
    }

    public function cityName()
    {
        return $this->belongsTo(MasterCity::class, 'city_id');
    }

    public function province()
    {
        return $this->belongsTo(MasterProvince::class, 'province_id');
    }

    public function ecBarangay()
    {
        return $this->belongsTo(MasterBarangay::class, 'ec_barangay_id');
    }

    public function ecCityName()
    {
        return $this->belongsTo(MasterCity::class, 'ec_city_id');
    }

    public function ecProvince()
    {
        return $this->belongsTo(MasterProvince::class, 'province_id');
    }

    public function educationLevel()
    {
        return $this->belongsTo(MasterEducationLevel::class, 'education_level');
    }

    public function education_level_check()
    {
        return $this->belongsTo(MasterEducationLevel::class, 'education_level');
    }

    public function scope()
    {
        return $this->belongsTo(MasterScopeOfStudy::class, 'scope_of_study');
    }

    public function higherLearning()
    {
        return $this->belongsTo(MasterHigherLearningInstitution::class, 'higher_learning_institution');
    }

    public function higher_learning()
    {
        return $this->belongsTo(MasterHigherLearningInstitution::class, 'higher_learning_institution');
    }

    public function sector()
    {
        return $this->belongsTo(MasterSector::class, 'sector_id');
    }

    public function it_skills()
    {
        return $this->hasMany(UserItSkill::class);
    }

    public function skills()
    {
        return $this->belongsToMany(MasterItSkill::class, 'user_it_skills', 'user_id', 'it_skill_id');
    }

    public function departmentPositions()
    {
        return $this->hasMany('App\Models\Position', 'department_id', 'id');
    }

    public function interviewResponse()
    {
        return $this->hasMany('App\Models\JobOpeningApplicationInterviewResponse', 'id');
    }

    public function jobBookmarks()
    {
        return $this->hasMany('App\Models\JobBookmark', 'user_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function departmentSection()
    {
        return $this->belongsTo('App\Models\DepartmentSection', 'section_id', 'id');
    }

    public function sectionUnit()
    {
        return $this->belongsTo('App\Models\SectionUnit', 'unit_id', 'id');
    }

    public function isAdmin()
    {

        return $this->role->is_admin ?? 1;
    }

    /**
     * Get the role name attribute
     * This accessor provides compatibility with both legacy role() relationship
     * and Spatie's roles() relationship
     *
     * @return string|null
     */
    public function getRoleNameAttribute()
    {
        // First try to get from Spatie's roles (first role)
        try {
            if (isset($this->relations['roles']) && $this->roles && $this->roles->count() > 0) {
                return $this->roles->first()->name;
            }
        } catch (\Exception $e) {
            // Continue to fallback
        }
        
        // Fallback to legacy role relationship
        try {
            if (isset($this->relations['role']) && $this->role) {
                return $this->role->name;
            }
        } catch (\Exception $e) {
            // Continue to fallback
        }
        
        return null;
    }

    public function isEmployee()
    {
        return $this->role_name === Role::$employee;
    }

    public function isDepartment()
    {
        return $this->role_name === Role::$department;
    }

    public function isCompany()
    {
        return $this->role_name === Role::$company || $this->role_name === 'admin';
    }

    public function isTalentAcquisition()
    {
        return $this->role_name === 'talent-acquisition';
    }

    // public function hasPermission($section_name)
    // {
    //     if (!isset($this->permissions)) {
    //         $sections_id = Permission::where('role_id', '=', $this->role_id)->where('allow', true)->pluck('section_id')->toArray();
    //         $this->permissions = Section::whereIn('id', $sections_id)->pluck('name')->toArray();
    //     }

    //     return true; //in_array($section_name, $this->permissions);
    // }

    // public function role()
    // {
    //     return $this->belongsTo('App\Models\Role', 'role_id', 'id');
    // }

    public function userDepartment()
    {
        return $this->hasOne('App\Models\Department');
    }

    public function userCompany()
    {
        return $this->hasOne('App\Models\CompanyDetail');
    }

    public function getIsAllAssessmentsCompletedAttribute()
    {
        $completed = $this->is_personality_motivation_completed
            && $this->is_work_interest_completed
            && $this->is_cognitive_ability_completed;

        return $completed ? 1 : 0;
    }

    public function employeeTeam()
    {
        return $this->belongsTo('App\Models\TeamEmployees', 'id', 'employee_id');
    }

    public function team()
    {
        return $this->belongsTo('App\Models\Team', 'team_id', 'id');
    }

    public function personality_type()
    {
        return $this->belongsTo(PersonalityType::class, 'personality_type_id');
    }

    public function job_position()
    {
        return $this->belongsTo('App\Models\Job', 'position_id', 'id');
    }

    public function jobOpeningApplication()
    {
        return $this->hasMany('App\Models\JobOpeningApplication', 'user_id', 'id');
    }

    public function scopeYearsSinceCreation($query)
    {
        return $query->selectRaw('*, TIMESTAMPDIFF(YEAR, created_at, NOW()) as years_since_created');
    }

    public function scopeYearsAndAge($query)
    {
        return $query->selectRaw('*, TIMESTAMPDIFF(YEAR, created_at, NOW()) as years_since_created, TIMESTAMPDIFF(YEAR, dob, NOW()) as age');
    }

    public function scopeDurationFilter($query, $duration)
    {
        switch ($duration) {
            case '1_g':
                return $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) < 1');
            case '1_2':
                return $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 1 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 2');
            case '2_3':
                return $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 2 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 3');
            case '3_4':
                return $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 3 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 4');
            case '4_5':
                return $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 4 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 5');
            case '5_6':
                return $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 5 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 6');
            case '6_7':
                return $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 6 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 7');
            case '7_8':
                return $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 7 AND TIMESTAMPDIFF(YEAR, created_at, NOW()) < 8');
            case '8_g':
                return $query->whereRaw('TIMESTAMPDIFF(YEAR, created_at, NOW()) >= 8');
            default:
                return $query;
        }
    }

    public function educationProgram()
    {
        return $this->belongsTo(MasterEducationProgram::class, 'education_program_id');
    }

    public function program()
    {
        return $this->belongsTo(MasterEducationProgram::class, 'education_program_id');
    }

    public function subordinates()
    {
        return $this->hasMany(User::class, 'superior_id');
    }

    public function userDocuments()
    {
        return $this->hasMany(UserDocument::class);
    }

    public function preferredLocations()
    {
        return $this->hasMany(UserJobPreferredLocation::class, 'user_id');
    }

    public function preferredLocation()
    {
        return $this->hasMany(UserJobPreferredLocation::class, 'user_id');
    }

    public function superior()
    {
        return $this->belongsTo(User::class, 'superior_id');
    }

    public function jobHeadcount()
    {
        return $this->hasOne(JobHeadcount::class, 'user_id');
    }

    public function getPerformancePredictiveScore($user_id)
    {
        $ocean_result = AssessmentHelper::getOCEANResultFull($user_id, 0);
        $result = ($ocean_result['Conscientiousness'] / 5) * 100 ?? '0';

        return $result;
    }

    public function reviews()
    {
        return $this->hasMany(SkillReview::class);
    }

    public function getCognitiveLevel($user_id)
    {
        $cognitive_ability_result = AssessmentHelper::getCognitiveResultFull($user_id, 0);
        $result = (int) (($cognitive_ability_result['Quantitative Knowledge'] + $cognitive_ability_result['Comprehension Knowledge'] + $cognitive_ability_result['Visual Reasoning'] + $cognitive_ability_result['Fluid Reasoning']) / 4);

        if ($result == 3) {
            $level = 'High';
        } elseif ($result == 1) {
            $level = 'Low';
        } else {
            $level = 'Medium';
        }

        return 'Level: '.$result;
    }

    public function getGrowthPotentialLevel($user_id)
    {
        $employee = User::find($user_id);
        $growth_potential = AssessmentHelper::getGrowthPotential(auth()->user()->id, $employee->gp_percentage, $employee->cognitive_test_percentage);

        return $growth_potential;
    }

    public function results()
    {
        return $this->hasMany(UserResult::class, 'user_id');
    }

    public function performanceRatings()
    {
        return $this->hasMany(UserPerformanceRating::class, 'user_id');
    }

    public function scopeWithParentJobHeadcountColumns($query, $columns = [])
    {
        return $query->with([
            'jobHeadcount' => function ($query) use ($columns) {
                $query->select($columns['jobHeadcount'] ?? ['id', 'user_id', 'job_id', 'parent_id','department_id']);
            },
            'jobHeadcount.job' => function ($query) use ($columns) {
                $query->select($columns['job'] ?? ['id', 'title']);
            },
            'jobHeadcount.department' => function ($query) use ($columns) {
                $query->select($columns['department'] ?? ['id', 'name']);
            },
            'jobHeadcount.parent' => function ($query) use ($columns) {
                $query->select($columns['parent'] ?? ['id', 'user_id', 'job_id']);
            },
            'jobHeadcount.parent.user' => function ($query) use ($columns) {
                $query->select($columns['user'] ?? ['id', 'name']);
            },
            'jobHeadcount.parent.job' => function ($query) use ($columns) {
                $query->select($columns['job'] ?? ['id', 'title']);
            },
            'jobHeadcount.parent.department' => function ($query) use ($columns) {
                $query->select($columns['department'] ?? ['id', 'name']);
            },
        ]);
    }

    // Enhanced employee code generation with tenant prefix
    public static function generateEmployeeCode($tenantId = null)
    {   
        if(is_TC()){
            if (!$tenantId && auth()->check()) {
                $tenantId = auth()->user()->tenant_id;
            }
            
            if (!$tenantId) {
                $tenantId = session('tenant_id');
            }

            $tenant = $tenantId ? Tenant::find($tenantId) : null;
            $prefix = $tenant ? strtoupper(substr($tenant->slug, 0, 3)) : 'EMP';
            
            $lastEmployeeCode = User::where('tenant_id', $tenantId)
                ->where('employee_code', 'LIKE', $prefix . '-%')
                ->max('employee_code');
                
            $counter = $lastEmployeeCode ? intval(explode('-', $lastEmployeeCode)[1]) + 1 : 1;
            $startingNumber = 1001;

            $employeeCode = $prefix . '-' . str_pad($counter, 4, '0', STR_PAD_LEFT) . '-' . str_pad($startingNumber, 4, '0', STR_PAD_LEFT);

            while (User::where('tenant_id', $tenantId)
                    ->where('employee_code', $employeeCode)->exists()) {
                $counter++;
                $startingNumber++;
                $employeeCode = $prefix . '-' . str_pad($counter, 4, '0', STR_PAD_LEFT) . '-' . str_pad($startingNumber, 4, '0', STR_PAD_LEFT);
            }
        }else{
            $lastEmployeeCode = User::max('employee_code');
            $counter = $lastEmployeeCode ? intval(substr($lastEmployeeCode, 4, 4)) + 1 : 1;
            $startingNumber = 1001;
        
            $employeeCode = 'EMP-' . str_pad($counter, 4, '0', STR_PAD_LEFT) . '-' . str_pad($startingNumber, 4, '0', STR_PAD_LEFT);
        
            while (User::where('employee_code', $employeeCode)->exists()) {
                $counter++;
                $startingNumber++;
                $employeeCode = 'EMP-' . str_pad($counter, 4, '0', STR_PAD_LEFT) . '-' . str_pad($startingNumber, 4, '0', STR_PAD_LEFT);
            }
        }
        
        return $employeeCode;
    }

    protected static function booted()
    {
        static::creating(function ($user) {
            if (empty($user->employee_code)) {
                $user->employee_code = self::generateEmployeeCode($user->tenant_id);
            }
        });
    }

    // Check if user belongs to specific tenant
    public function belongsToTenant($tenantId)
    {
        return $this->tenant_id == $tenantId;
    }

    // Permission check with tenant context
    public function hasPermissionInTenant($permission, $tenantId = null)
    {
        $checkTenantId = $tenantId ?? $this->tenant_id;
        
        if ($this->tenant_id !== $checkTenantId) {
            return false;
        }

        return $this->hasPermissionTo($permission);
    }

    /**
     * Tenant relationship
     */
   
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function getProfilePictureUrlAttribute()
    {
        if (isset($this->profile_picture) && File::exists(public_path($this->profile_picture))) {
            return asset($this->profile_picture);
        }

        return asset('images/default-user.svg');
    }

    /**
     * Check if user has a specific role
     *
     * @param string $roleName
     * @return bool
     */
    // public function hasRole($roleName)
    // {   
    //     return $this->roles()->where('name', $roleName)->exists(); //getting issue on this that's why changed below 
    //      return true;
    // }

    /**
     * Check if user has a specific permission
     *
     * @param string $permissionName
     * @return bool
     */
    public function hasPermission($permissionName)
    {
        // Get all permissions through roles
        return $this->roles()
            ->whereHas('permissions', function ($query) use ($permissionName) {
                $query->where('name', $permissionName);
            })
            ->exists();
    }

    /**
     * Get all user permissions
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllPermissions()
    {
        return $this->roles()
            ->with('permissions')
            ->get()
            ->pluck('permissions')
            ->flatten()
            ->unique('id');
    }

    public function getDepartmentNameAttribute()
    {
        return $this->department->name ?? $this->department ?? '';
    }
    public function getDivisionNameAttribute()
    {
        return $this->division->name ?? $this->division ?? '';
    }
    // public function getBusinessUnitNameAttribute()
    // {
    //     return $this->business_unit->name ?? $this->business_unit ?? '';
    // }
    public function getJobPositionNameAttribute()
    {
        // dd($this->job_position);
        return $this->job_position->title ?? $this->job_position ?? '';
    }

    public function getOnboardingEmailStatusLabelAttribute()
    {
        return $this->onboarding_email_status == 1 ? 'Sent' : 'Not Sent';
    }

    /**
     * Get users by role using Spatie's model_has_roles pivot table
     * Handles multi-tenant environments by checking tenant_id
     *
     * @param string $roleName The name of the role
     * @param int|null $tenantId Optional tenant ID (defaults to auth user's tenant)
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getUsersByRole($roleName, $tenantId = null)
    {
        // Default to authenticated user's tenant if not provided
        if ($tenantId === null && auth()->check()) {
            $tenantId = auth()->user()->tenant_id;
        }

        // Find the role by name and tenant
        $role = \App\Models\Role::where('name', $roleName)
            ->where('tenant_id', $tenantId)
            ->first();

        if (!$role) {
            return collect(); // Return empty collection if role not found
        }

        // Query users through model_has_roles pivot table
        return static::whereHas('roles', function($query) use ($role) {
            $query->where('roles.id', $role->id);
        })->get();
    }
}
