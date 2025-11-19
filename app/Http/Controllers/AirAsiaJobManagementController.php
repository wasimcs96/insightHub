<?php

namespace App\Http\Controllers;

use App\Models\AirAsiaFamilyJob;
use Illuminate\Http\Request;
use App\Services\WorkdayService;
use Illuminate\Http\JsonResponse;
use App\Models\JobFamilyGroup;
use App\Models\Division;
use App\Models\Department;
use App\Models\JobFamily;
use App\Models\JobProfile;
use App\Models\Job;

class AirAsiaJobManagementController extends Controller
{
    protected $workdayService;

    public function __construct(WorkdayService $workdayService)
    {
        $this->workdayService = $workdayService;
    }

    
    public function index()
    {
        return view('admin.airasiajob.index');
    }

    
    public function getJobFamilyGroup()
    {
         return response()->json(Division::select('id', 'head_of_division as name')->get());
    }

     public function getByGroup($group_id)
    {
        return response()->json(
            Department::where('division_id', $group_id)
                ->select('id', 'name')
                ->get()
        );
    }

    

public function getByFamily($family_id)
{
    $profiles = JobProfile::where('department_id', $family_id)->get();

    foreach ($profiles as $profile) {
        // Directly find the job using job_profile_id
        $job = Job::where('job_profile_id', $profile->id)->first();

        if ($job) {
            $profile->status =  $job ? $job->status : null;
            $profile->job_id = $job->id;
            $profile->job_exist = 1;
        } else {
            $profile->status = null;
            $profile->job_id = null;
            $profile->job_exist = 0;

        }
    }

    return response()->json($profiles);
    //   return view('components.custom-dropdown', [
    //     'id' => 'jobDropdown',
    //     'selectedTitle' => 'Select Job Position',
    //     'jobs' => $profiles,
    //     'showButton' => true,
    // ]);
}



    public function getDetail($profile_id)
    {
        $profile = JobProfile::with([
            'jobFamily.jobFamilyGroup',
        ])->find($profile_id);

        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        // Transform as needed based on your frontend expectations
        return response()->json(['data' => $profile]);
    }

    
}
