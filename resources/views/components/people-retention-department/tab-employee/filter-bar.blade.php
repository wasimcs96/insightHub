@props(['title', 'employeeData', 'uniquePositions', 'positionCounts', 'positionLevelCounts', 'uniqueLevels', 'positionsByLevel', 'levelsByPosition'])

@php
    $tabType = $title === 'Data Not Available' ? 'all' : strtolower(str_replace(' ', '-', $title));
    $filterPrefix = 'ED' . str_replace('-', '', ucwords($tabType, '-'));
@endphp

<style>
    .employee-position-search {
        width: 25% !important;
    }
</style>

<div class="filter-buttons d-flex align-items-center mb-14 justify-content-between" data-tab="{{ $tabType }}">
    <div class="filter-container1">
        <h4>Filter</h4>
        
        <!-- Position Level Dropdown -->
        <div class="dropdown">
            <button class="filter-btn" type="button" id="{{ $filterPrefix }}PositionLevel" data-bs-toggle="dropdown"
                data-default-text="Position Level" aria-expanded="false">
                <span>Position Level</span> <iconify-icon icon="tabler:chevron-down" width="16" height="16"></iconify-icon>
            </button>
            <div class="dropdown-menu mt-4" style="width: 210px; max-height: 300px; overflow-y: auto; padding: 0px !important;">
                @foreach($positionsByLevel as $positionLevel)
                    @php
                        $label = config('helpers.position_levels')[$positionLevel['level']] ?? null;
                    @endphp

                    @if ($label)
                        <div class="d-flex gap-2 align-items-center custom-check-input">
                            <input class="interview-option" type="radio" 
                                name="{{ $filterPrefix }}PositionLevelFilter"
                                value="{{ $positionLevel['level'] }}" 
                                data-target="{{ $filterPrefix }}PositionLevel" 
                                data-label="{{ $label }}">
                                
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                <p class="m-0">{{ $label }}</p>
                                <span>{{ $positionLevel['count'] }}</span>
                            </label>
                        </div>
                    @endif
                @endforeach

                <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                    <button class="resetBtn border-0" data-target="{{ $filterPrefix }}PositionLevel">Reset</button>
                    <button class="filter border-0">Filter</button>
                </div>
            </div>

        </div>

        <!-- Job Position Dropdown -->
        <div class="dropdown">
            <button class="filter-btn filter-btn1" type="button" id="{{ $filterPrefix }}JobPosition" data-bs-toggle="dropdown"
                data-default-text="Job Position" aria-expanded="false">
                <span>Job Position</span> <iconify-icon icon="tabler:chevron-down" width="16" height="16"></iconify-icon>
            </button>
            <div class="dropdown-menu mt-4" style="width: 210px; max-height: 300px; overflow-y: auto; padding: 0px !important;">
                @foreach($levelsByPosition as $jobPosition)
                    <div class="d-flex gap-2 align-items-center custom-check-input">
                        <input class="interview-option" type="radio" name="{{ $filterPrefix }}JobPositionFilter"
                            value="{{ $jobPosition['position_name'] }}" data-target="{{ $filterPrefix }}JobPosition">
                        <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                            <p class="m-0">{{ $jobPosition['position_name'] }}</p>
                            <span>{{ $jobPosition['count'] }}</span>
                        </label>
                    </div>
                @endforeach
                <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                    <button class="resetBtn border-0" data-target="{{ $filterPrefix }}JobPosition">Reset</button>
                    <button class="filter border-0">Filter</button>
                </div>
            </div>
        </div>

    </div>
    <div class="employee-search employee-position-search">
    <input type="text" class="employee-searchTerm" placeholder="Search Employee" id="{{ $filterPrefix }}SearchEmployeeInput">
    <span class="employee-clearButton">
        <i class="fa fa-times"></i>
    </span>
    <button type="button" class="employee-searchButton" onclick="filterEmployees('{{ $tabType }}')">
        <i class="fa fa-search"></i>
    </button>
</div>

</div>
