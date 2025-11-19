<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\JobProfile; 
use App\Models\Job; 


class JobProfileSelect extends Component
{
    public $selectedJobProfile;
    public $departmentId;
    public $jobProfiles = [];

    protected $listeners = ['departmentSelected' => 'loadJobProfiles'];

    public function mount($selectedJobProfile = null, $departmentId = null)
    {
        
        $this->departmentId = $departmentId;
         if ($this->departmentId) {
        $this->loadJobProfiles($this->departmentId);
         }
        // Check if it's an edit or create page
        
        if ($selectedJobProfile) {
            $this->selectedJobProfile = $selectedJobProfile;
        }
    }
    
   public function updatedDepartment($department)
    {
        // $this->departmentId = $department;
        // $this->loadJobProfiles($departmentId);

        if (empty($department)) {
            $this->jobProfiles = collect();
            $this->selectedJobProfile = null;
            $this->dispatchBrowserEvent('job-profile-changed', ['selectedJobProfile' => null]);
        } else {
            $this->loadJobProfiles($department);
        }

    }

    public function loadJobProfiles($departmentId)
    {

        if(empty($departmentId)){
            $this->jobProfiles = [];
            $this->selectedJobProfile = null;
            $this->dispatchBrowserEvent('job-profile-changed', ['selectedJobProfile' => null]);
            return;
        }
        // dd($departmentId);
        // $this->jobProfiles = JobProfile::where('department_id', $departmentId)->get();

         $profiles = JobProfile::where('department_id', $departmentId)->get();

        //   if ($profiles->isEmpty()) {
        //         $this->jobProfiles = [];
        //         $this->selectedJobProfile = null;
        //         return;
        //     }

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
        $this->jobProfiles = $profiles;
        $this->dispatchBrowserEvent('job-profile-changed', ['selectedJobProfile' => $this->selectedJobProfile]);
    }

    public function render()
    {
        return view('livewire.job-profile-select');
    }
}