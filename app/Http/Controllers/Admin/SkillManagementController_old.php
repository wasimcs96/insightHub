<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sector;
use App\Models\JobSkill;
use App\Models\JobTechnicalSkills;

class SkillManagementController extends Controller
{
    public function dashboard(Request $request){
        $sectorName = $request->sector_name;
        // $sectors = Sector::all();
        $sectors = Sector::when($request->sector_name, function ($query, $sectorName) {
            return $query->where('name', 'like', '%' . $sectorName . '%');
        })->get();
            $data = [];
            foreach ($sectors as $key => $value) {      
                $skillCounts = JobSkill::whereHas('job', function ($query) use ($value) {
                    $query->where('department_id', $value->id);
                })->distinct('title')->count('id');
                
                $techSkillCounts = JobTechnicalSkills::whereHas('job', function ($query) use ($value) {
                    $query->where('department_id', $value->id);
                })->distinct('master_technical_skill_id')->count('id');

                $data[$value->name] = ["icon"=>$value->icon,"id" => $value->id, "count" =>  $skillCounts + $techSkillCounts];
            }
            return view('admin.skill-management.dashboard', compact('data'));
    }

    public function viewSkills(){
        return view('admin.skill-management.view-skills');
    }

    public function sectorSkills($sector_id) {
        return view('admin.skill-management.sector-skills');
    }
}
