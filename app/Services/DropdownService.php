<?php

namespace App\Services;

use App\Models\Division;
use App\Models\Department;
use App\Models\BusinessUnit;
use App\Models\Job;
use App\Models\JobHeadcount;
use App\Models\TechnicalSkillCategory;


class DropdownService
{
    public static function getDivisionsByBusinessUnit($businessUnitId)
    {
        return Division::where('business_unit_id', $businessUnitId)
                       ->where('status',1)
                       ->select('id', 'head_of_division')
                       ->orderBy('head_of_division')
                       ->get();
    }

    public static function getDepartmentsByDivision($divisionId)
    {
        return Department::where('division_id', $divisionId)
                       ->where('status',1)
                        ->select('id', 'name')
                         ->orderBy('name')
                         ->get();
    }


    public static function getBusinessUnits()
    {
        return BusinessUnit::where('status',1)->select('id', 'name')->orderBy('name')->get();
    }

    // public static function getJobHeadcounts($id)
    // {
    //     // Pull all saved headcount codes for this job ID:
    //     $codes = JobHeadcount::where('job_id', $id)
    //             ->orderBy('headcount_code')
    //             ->pluck('headcount_code')
    //             ->toArray();

    
    //     $headcounts = JobHeadcount::where('job_id', $id)
    //                 ->orderBy('headcount_code')
    //                 ->get(); // Lazy load: no ->with('user')

    //     $names = [];

    //     foreach ($headcounts as $headcount) {
    //         $names[(string) $headcount->headcount_code] = $headcount->user_id && $headcount->user ? $headcount->user->name : 'Vacant';
    //     }

    //     return [
    //         'headcount_codes' => $codes,
    //         'headcount_names' => $names
    //     ];
    // }


    public static function getJobHeadcounts($id)
    {
        // Fetch all headcounts for the given job ID, lazy loading the 'user' relationship
        $headcounts = JobHeadcount::where('job_id', $id)
                        ->orderBy('headcount_code')
                        ->get();

        $codes = [];
        $names = [];

        foreach ($headcounts as $headcount) {
            $code = (string) $headcount->headcount_code;
            $codes[] = $code;
            $names[$code] = $headcount->user_id && $headcount->user ? $headcount->user->name : 'Vacant';
        }

        return [
            'headcount_codes' => $codes,
            'headcount_names' => $names
        ];
    }



    public static function getJobHeadcountsData($id)
    {
        // Pull all saved headcount codes for this job ID:
        $headCounts = JobHeadcount::with('user')->where('job_id', $id)->get();

        // dd($headCounts);
        return $headCounts;
    }

    

    public static function getTechnicalSkillCategory($id)
    {
        // dd($id);
        // Pull all saved headcount codes for this job ID:
        $categories = TechnicalSkillCategory::wherein('sector_id',$id)->select('id','title')->get();

        // dd($headCounts);
        return $categories;
    }

    
    public static function getJobs($request)
    {
        $departmentIds = $request['department_ids'] ?? '';
        $searchTerm = $request['q'] ?? '';
        // dd($departmentIds);
            // Pull all saved headcount codes for this job ID:
            $query = Job::where('is_primary', 0)
            ->select('id', 'title as name')
            ->orderBy('title');

            
        if (!empty($departmentIds)) {
            $query->whereIn('department_id', $departmentIds);
        }

        if (!empty($searchTerm)) {
            $query->where('title', 'like', '%' . $searchTerm . '%');
        }

        $jobPositions = $query->get();

        return $jobPositions;
    }
}
