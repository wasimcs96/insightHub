<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CustomDropdown extends Component
{
    public $id;
    public $selectedTitle;
    public $jobs;
    public $showButton;
    
    public function __construct($id, $selectedTitle = 'Select Job Position', $jobs = [], $showButton = true)
    {
        $this->id = $id;
        $this->selectedTitle = $selectedTitle;
        $this->jobs = $jobs;
        $this->showButton = $showButton;
    }

    public function render()
    {
        return view('components.custom-dropdown');
    }
}