<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DropdownService;
use App\Services\Job\JobService;
use Illuminate\Http\Request;
use App\Models\MasterTechnicalSkill;

class DropdownController extends Controller
{

     public function getBusinessUnit()
    {
        // dd('dd');
        $businessUnit = DropdownService::getBusinessUnits();
        return response()->json($businessUnit);
    }

    public function getDivisions($businessUnitId)
    {
        $divisions = DropdownService::getDivisionsByBusinessUnit($businessUnitId);
        return response()->json($divisions);
    }

    public function getDepartments($divisionId)
    {
        $departments = DropdownService::getDepartmentsByDivision($divisionId);
        return response()->json($departments);
    }

    public function getJobHeadcounts($id)
    {
        // Pull all saved headcount codes for this job ID:
        $data = DropdownService::getJobHeadcounts($id);

        return response()->json(['headcount_codes' => $data['headcount_codes'], 'headcount_names' => $data['headcount_names']]);
    }

     public function getJobHeadcountsData($id)
    {
        // Pull all saved headcount codes for this job ID:
        $getJobHeadcountsData = DropdownService::getJobHeadcountsData($id);
        
        return response()->json($getJobHeadcountsData);
    }

         public function getTechnicalSkillCategory($id)
    {
        // Pull all saved headcount codes for this job ID:
            $ids = explode(',',$id);
   
        $getTechnicalSkillCategoryData = DropdownService::getTechnicalSkillCategory($ids);
        
        return response()->json($getTechnicalSkillCategoryData);
    }

      public function getJobs(Request $request)
    {
        $requestData = $request->all();
        // Pull all saved headcount codes for this job ID:
            // $ids = $request->department
        $jobs = DropdownService::getJobs($requestData);
        
        return response()->json($jobs);
    }


      public function getMasterSkillChildrenCount(MasterTechnicalSkill $skill)
      {
        // Single, efficient query with constrained withCount:
        $skill = MasterTechnicalSkill::query()
            ->whereKey($skill->getKey())
            ->withCount([
                'children as custom_children_count' => fn($q) => $q->whereIn('is_custom', [1,2]),
            ])
            ->firstOrFail();
// dd($skill->custom_children_count);
        return response()->json([
            'count' => (int) $skill->custom_children_count,
        ]);
    }
}
