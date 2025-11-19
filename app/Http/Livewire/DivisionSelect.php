<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Division; // Assuming you have a Division model

class DivisionSelect extends Component
{
    public $selectedDivision;
    public $businessUnitId;
    public $selectedBusinessUnit;
    public $divisions = [];

    protected $listeners = ['businessUnitSelected' => 'loadDivisions'];
    public function mount($selectedDivision = null, $businessUnitId = null)
    {
        
        $this->businessUnitId = $businessUnitId;
        $this->selectedBusinessUnit = $businessUnitId;
        // dd($businessUnitId);
        if ($this->businessUnitId) {
            $this->loadDivisions($this->businessUnitId);
        }
        // Check if it's an edit or create page
        if ($selectedDivision) {
            $this->selectedDivision = $selectedDivision;
        }
    }

    public function updatedBusinessUnit($unitId)
    {

        $this->businessUnitId = $unitId;
        $this->loadDivisions($this->businessUnitId);
    }

    public function loadDivisions($businessUnitId)
    {       
        $this->selectedBusinessUnit = $businessUnitId;
        $this->businessUnitId = $businessUnitId;
        $this->divisions = Division::where('business_unit_id',$businessUnitId)->get();
         if ($this->divisions->isEmpty()) {
                $this->selectedDivision = null;
                $this->emit('divisionSelected', null);  // Tell department to clear itself
            }
    }

    public function render()
    {
        return view('livewire.division-select');
    }
}