<?php

namespace App\Services;

use App\Helpers\QueryHelper;
use App\Models\User;
use App\Models\JobHeadcount;
use App\Models\Department;
use App\Models\Results;
use App\Models\UserResult;

class EmployeeService
{
    /**
     * Get employee profile data.
     *
     * @param int $id
     * @return array
     */
    public function getEmployeeProfile($id)
    {
        // Define columns to be fetched for relationships (eager loading)
        $columns = [
            'jobHeadcount' => ['id', 'user_id', 'job_id', 'headcount_code', 'parent_id', 'department_id'],
            'parent' => ['id', 'user_id', 'job_id', 'headcount_code', 'department_id'],
            'user' => ['id', 'name', 'email','employee_code'],
            'job' => ['id', 'title'],
            'department' => ['id', 'name'],
        ];

        // Fetch dynamic query parts for results
        $queries = QueryHelper::getDynamicLevelQueries();

        // Eager load relationships with necessary checks and custom query selection
        $employee = User::withParentJobHeadcountColumns($columns)
            ->with(['results' => function ($query) use ($queries) {
                $query->select(array_merge(['user_id'], $queries['selectStatements'], $queries['caseStatements']))
                    ->groupBy('user_id');
            }])
            ->select('id', 'name', 'email', 'employee_code', 'profile_picture') // Select basic user details
            ->findOrFail($id);
  
        // Initialize data with default values ('-')
        $data = $this->initializeEmployeeData();

        // Set employee profile data using helper functions
        $data['name'] = $this->getValue($employee->name);
        $data['email'] = $this->getValue($employee->email);
        // if(isset($employee->profile_picture) && file_exists($employee->profile_picture)) {
        //     $profile_picture = asset($employee->profile_picture);
        // } else {
        //     $profile_picture = asset('/admin/media/svg/org-chart-svg/user.svg');
        // }

        $data['profile_picture'] = $employee->profile_picture;
        $data['position'] = $this->getJobTitle($employee);
        $data['department'] =  $this->getDepartmentName($employee);
        $data['bsc'] = '-'; // Static value, no changes
        // Process results and other dynamic data
        $firstResult = $employee->results->first(); // Get first result safely
        if($firstResult) {
            $userResult = UserResult::where('user_id', $firstResult->user_id)->where('result_type', 'top_3_riasec')->first();
            $data['riasec'] = $userResult->level_description ?? ''; // Static value for RIASEC, or populate dynamically if available
        } else {
            $data['riasec'] = ''; // Static value for RIASEC, or populate dynamically if available
        }

        if($firstResult) {
            $userResult = UserResult::where('user_id', $firstResult->user_id)->where('result_type', 'personality_type')->first();
            $data['personality_type'] = $userResult->name ?? ''; // Static value for RIASEC, or populate dynamically if available
        } else {
            $data['personality_type'] = ''; // Static value for RIASEC, or populate dynamically if available
        }
        
        $data['flight_risk'] = $this->getResultValue($firstResult, 'fr_level_label');
        $data['flight_risk_level'] = $this->getResultValue($firstResult, 'fr_level');
        $data['overall_match_rate'] = $this->getResultValue($firstResult, 'omr_level_label');
        $data['overall_match_rate_level'] = $this->getResultValue($firstResult, 'omr_level');
        $data['behavioral_fit_rate'] = $this->getResultValue($firstResult, 'bfr_level_label');
        $data['behavioral_fit_rate_level'] = $this->getResultValue($firstResult, 'bfr_level');
        $data['job_match_rate'] = $this->getResultValue($firstResult, 'jmr_level_label');
        $data['job_match_rate_level'] = $this->getResultValue($firstResult, 'jmr_level');
        $data['headcount_code'] = $this->getValue($employee->jobHeadcount->headcount_code);
        $data['employee_code'] = $this->getValue($employee->employee_code);
        $data['technical_assessment'] = $this->getResultValue($firstResult, 'ta_level_label');
        $data['technical_assessment_level'] = $this->getResultValue($firstResult, 'ta_level');
        $data['soft_skill_match_rate'] = $this->getResultValue($firstResult, 'ssmr_level_label');
        $data['soft_skill_match_rate_level'] = $this->getResultValue($firstResult, 'ssmr_level');
        $data['cognitive_test_result'] = $this->getResultValue($firstResult, 'cat_level_label');
        $data['cognitive_test_result_level'] = $this->getResultValue($firstResult, 'cat_level');
       
        $data['ocean'] = $this->getResultValue($firstResult, 'rci_level_label');
        $data['rci'] = $this->getResultValue($firstResult, 'rci_level_label');
        $data['rci_level'] = $this->getResultValue($firstResult, 'rci_level');
        $data['growth_potential'] = $this->getResultValue($firstResult, 'gp_level_label');
        $data['growth_potential_level'] = $this->getResultValue($firstResult, 'gp_level');
        $data['forecast_alignment'] = $this->getResultValue($firstResult, 'waf_level_label');
        $data['forecast_alignment_level'] = $this->getResultValue($firstResult, 'waf_level');
        $data['technical_skill_match_rate'] = $this->getResultValue($firstResult, 'technical_skill_match_rate_level_label');
        $data['technical_skill_match_rate_level'] = $this->getResultValue($firstResult, 'technical_skill_match_rate_level');
        // Superior data, which may have nested relationships
        $data['superior'] = $this->getSuperiorData($employee);
        $data['leadership_potential'] = $this->getResultValue($firstResult, 'leadership_potential_level_label');
        $data['leadership_potential_level'] = $this->getResultValue($firstResult, 'leadership_potential_level');

        // Return the profile data array
        return $data;
    }

    /**
     * Helper function to initialize the data array with default values
     */
    private function initializeEmployeeData()
    {
        return [
            'name' => '-', 
            'email' => '-', 
            'position' => '-', 
            'department' => '-',
            'profile_picture' => '-',
            'bsc' => '-', 
            'flight_risk' => '-', 
            'flight_risk_level' => 0, 
            'overall_match_rate' => '-', 
            'overall_match_rate_level' => 0, 
            'behavioral_fit_rate' => '-', 
            'behavioral_fit_rate_level' => 0,
            'job_match_rate' => '-', 
            'job_match_rate_level' => 0, 
            'headcount_code' => '-', 
            'employee_code' => '-', 
            'department' => '-', 
            'technical_assessment' => '-', 
            'technical_assessment_level' => 0, 
            'soft_skill_match_rate' => '-', 
            'soft_skill_match_rate_level' => 0, 
            'cognitive_test_result' => '-', 
            'cognitive_test_result_level' => 0, 
            'riasec' => '-', 
            'ocean' => '-', 
            'growth_potential' => '-', 
            'growth_potential_level' => 0, 
            'forecast_alignment' => '-', 
            'forecast_alignment_level' => 0, 
            'superior' => [
                'name' => '-', 
                'position' => '-', 
                'headcount_id' => '-', 
                'department' => '-',
                'employee_code' => '-',
            ]
        ];
    }

    /**
     * Helper function to safely retrieve values or return default
     */
    private function getValue($value, $default = '-')
    {
        return isset($value) ? $value : $default;
    }

    /**
     * Helper function to get job title safely
     */
    private function getJobTitle($employee)
    {
        return isset($employee->jobHeadcount->job->title) ? $employee->jobHeadcount->job->title : '-';
    }

    private function getDepartmentName($employee)
    {
        return isset($employee->jobHeadcount->department->name) ? $employee->jobHeadcount->department->name : '-';
    }

    /**
     * Helper function to get result values (e.g. flight_risk, overall_match_rate)
     */
    private function getResultValue($result, $column, $default = '-')
    {
        return isset($result) && isset($result->$column) ? $result->$column : $default;
    }

    /**
     * Helper function to get department name safely
     */
    // private function getDepartmentName($employee)
    // {
    //     return isset($employee->department) && isset($employee->department->name) ? $employee->department->name : '-';
    // }

    /**
     * Helper function to get superior's data
     */
    private function getSuperiorData($employee)
    {
        return [
            'name' => $this->getValue($employee->jobHeadcount?->parent?->user?->name),
            'position' => $this->getJobTitleForSuperior($employee),
            'headcount_id' => $this->getValue($employee->jobHeadcount?->parent?->headcount_code),
            'department' => $this->getDepartmentNameForSuperior($employee),
            'employee_code' => $this->getValue($employee->jobHeadcount?->parent?->user?->employee_code),
        ];
    }

    /**
     * Helper function to get superior job title
     */
    private function getJobTitleForSuperior($employee)
    {
        return isset($employee->jobHeadcount?->parent?->job) ? $employee->jobHeadcount?->parent?->job->title : '-';
    }

    /**
     * Helper function to get superior department name
     */
    private function getDepartmentNameForSuperior($employee)
    {
        return isset($employee->jobHeadcount?->parent?->department?->name) ? $employee->jobHeadcount?->parent?->department?->name : '-';
    }
}
