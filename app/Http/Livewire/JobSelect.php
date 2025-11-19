<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Job; 
class JobSelect extends Component
{
    public $departmentId;
    public $jobs = [];

    protected $listeners = ['departmentSelected' => 'loadJobs'];

    public function loadJobs($departmentId)
    {
    
         $jobs = Job::where('is_primary',0)->where('department_id', $departmentId)->whereNotNull('job_profile_id')->get();

        $this->jobs = $jobs;
       
    }


    public function render()
    {
        return view('livewire.job-select');
    }
}
