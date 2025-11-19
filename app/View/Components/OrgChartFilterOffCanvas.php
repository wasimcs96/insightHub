<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class OrgChartFilterOffCanvas extends Component
{
    public $sources = [
        'Org Chart',
        'Employee Profile',
        'Job Management',
    ];


    public $types = [
        'Added Position',
        'Removed Position',
        'Assigned Employee',
        'Removed Employee',
        'Moved Position',
        'Moved Employee',
    ];

    public $usernames;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $dynamicTable,
    ) {
        $this->usernames = User::all()->pluck('name')->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.org-chart-filter-off-canvas', [
            'usernames' => $this->usernames,
            'types' => $this->types,
            'sources' => $this->sources,
        ]);
    }
}
