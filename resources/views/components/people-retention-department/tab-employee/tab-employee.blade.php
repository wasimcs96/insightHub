@props(['title', 'employeeData', 'uniquePositions', 'positionCounts', 'positionLevelCounts', 'uniqueLevels', 'positionsByLevel', 'levelsByPosition'])

@php
    $tabType = $title === 'Data Not Available' ? 'all' : strtolower(str_replace(' ', '-', $title));
@endphp

<div class="employee-directory-content active" data-tab-type="{{ $tabType }}">
    <div class="employee-directory-content-title">
        <h2 class="employee-directory-title">{{ $title }}</h2>
    </div>
    <x-people-retention-department.tab-employee.filter-bar 
        :title="$title"
        :employeeData="$employeeData" 
        :uniquePositions="$uniquePositions"
        :positionCounts="$positionCounts"
        :positionLevelCounts="$positionLevelCounts"
        :uniqueLevels="$uniqueLevels"
        :positionsByLevel="$positionsByLevel"
        :levelsByPosition="$levelsByPosition" />
    <div class="employee-directory-title-1">
        @foreach($employeeData as $positionName => $employees)
            <div class="position-container">
                <h1>{{ $positionName }} <span class="total-employee-number">{{ count($employees) }}</span></h1>
                <div class="profile-container">
                    @foreach($employees as $employee)
                        <div class="tab-employee-profile"
                            data-level="{{ $employee->level }}"
                            data-position="{{ $employee->position_name }}"
                            data-department="{{ $employee->position_name }}"
                            data-name="{{ strtolower($employee->name) }}"
                            data-email="{{ strtolower($employee->email) }}"
                            data-gender="{{ $employee->gender == 1 ? 'Female' : 'Male' }}"
                            style="cursor: pointer;">
                            <x-people-retention-department.tab-employee.card-employee-profile :employee="$employee"/>
                        </div>

                    @endforeach
                </div>
            </div>
        @endforeach
    </div>    
</div>