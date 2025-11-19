<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BusinessUnit; // Assuming you have a BusinessUnit model

class BusinessUnitSelect extends Component
{
     public $businessUnitId;
    public $businessUnits = [];
    public $selectedBusinessUnit;
    public $selectedDivision = null;
    public function mount($selectedBusinessUnit = null)
    {
        $this->businessUnits = BusinessUnit::all(); // Load business units on mount
        if ($selectedBusinessUnit) {
            $this->selectedBusinessUnit = $selectedBusinessUnit;
        }
    }

    public function render()
    {
        return view('livewire.business-unit-select');
    }

    public function updatedBusinessUnit($unitId)
{
    $this->businessUnitId = $unitId;
    if (empty($unitId)) {
        $this->divisions = collect(); 
        $this->selectedDivision = null;
        $this->emit('divisionSelected', null);
    } else {
        $this->loadDivisions($this->businessUnitId);
    }
}
}