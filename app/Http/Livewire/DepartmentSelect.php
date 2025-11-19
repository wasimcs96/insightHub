<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department; // Assuming you have a Department model

class DepartmentSelect extends Component
{
    public $selectedDepartment;
    public $divisionId;
    public $selectedDivision;
    public $departments = [];

    protected $listeners = ['divisionSelected' => 'loadDepartments'];

     public function mount($selectedDepartment = null, $divisionId = null)
    {
        $this->divisionId = $divisionId;
        $this->selectedDivision = $divisionId;
          if ($this->divisionId) {
            $this->loadDepartments($this->divisionId);
          }
        // Check if it's an edit or create page
        if ($selectedDepartment) {
            $this->selectedDepartment = $selectedDepartment;
        }
    }

     public function updatedDivision($division)
    {
        $this->divisionId = $division;
        $this->loadDepartments($this->divisionId);
    }
    
    public function loadDepartments($divisionId)
    {
        if (empty($divisionId)) {
            $this->departments = collect();
            $this->selectedDepartment = null;
            $this->selectedDivision = null;
            $this->emit('departmentSelected', null);
            return;
        }
        $this->selectedDivision = $divisionId;
        $this->divisionId = $divisionId;
        $this->departments = Department::where('division_id', $divisionId)->get();
          if ($this->departments->isEmpty()) {
                $this->selectedDepartment = null;
                $this->emit('departmentSelected',null);
            }
        // $this->emit('departmentSelected', $divisionId);
    }

    public function render()
    {
        return view('livewire.department-select');
    }
}