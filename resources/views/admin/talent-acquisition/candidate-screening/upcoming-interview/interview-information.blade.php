<h1 class="heading fw-bold">Upcoming Interview</h1>
<div class="d-grid grid-section">
    <div class="left-side">
        {{-- <div class="d-flex align-items-center justify-content-between mb-11">
            <div class="date-arrow d-flex gap-4">
                <h4 class="sub-heading m-0 fw-medium">Today 21 January, 2025</h4>
                <div class="arrow d-flex gap-4 align-items-center">
                    <iconify-icon icon="material-symbols:chevron-left-rounded" width="20"
                        height="20"></iconify-icon>
                    <iconify-icon icon="material-symbols:chevron-right-rounded" width="20"
                        height="20"></iconify-icon>
                </div>
            </div>
            <div class="dropdown">
                <button class="week-button d-flex align-items-center gap-2 fw-medium cursor-pointer" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="selectedText">This Week</span>
                    <iconify-icon icon="tabler:chevron-down" width="16" height="16"></iconify-icon>
                </button>
                <ul class="dropdown-menu mt-3 p-0 week-dropdown">
                    <li><a class="dropdown-item" href="#" onclick="updateDropdown(this, 'This Week')">This Week</a></li>
                    <li><a class="dropdown-item" href="#" onclick="updateDropdown(this, 'Next Week')">Next Week</a></li>
                    <li><a class="dropdown-item" href="#" onclick="updateDropdown(this, 'This Month')">This Month</a></li>
                </ul>
            </div>
        </div> --}}
        <div class="d-flex align-items-center justify-content-between mb-11">
            <div class="date-arrow d-flex gap-4">
                <!-- Display the selected date, starting with Today -->
                <h4 class="sub-heading m-0 fw-medium" id="selectedDate">Today 21 January, 2025</h4>
                <div class="arrow d-flex gap-4 align-items-center">
                    <iconify-icon icon="material-symbols:chevron-left-rounded" width="20" height="20" id="leftArrow"></iconify-icon>
                    <iconify-icon icon="material-symbols:chevron-right-rounded" width="20" height="20" id="rightArrow"></iconify-icon>
                </div>
            </div>
            <div class="dropdown">
                <button class="week-button d-flex align-items-center gap-2 fw-medium cursor-pointer" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="selectedText">Today</span> <!-- Default to 'Today' -->
                    <iconify-icon icon="tabler:chevron-down" width="16" height="16"></iconify-icon>
                </button>
                <ul class="dropdown-menu mt-3 p-0 week-dropdown">
                    <li><a class="dropdown-item" href="#" onclick="updateDropdown(this, 'Today')">Today</a></li>
                    <li><a class="dropdown-item" href="#" onclick="updateDropdown(this, 'This Week')">This Week</a></li>
                    <li><a class="dropdown-item" href="#" onclick="updateDropdown(this, 'This Month')">This Month</a></li>
                </ul>
            </div>
        </div>
        
        <div class="filter-buttons d-flex align-items-center">
            {{-- <div class="dropdown">
                <button class="filter-btn" type="button" id="Department" data-bs-toggle="dropdown"
                    data-default-text="Department" aria-expanded="false">
                    <span>Department</span> <iconify-icon icon="tabler:chevron-down" width="16"
                        height="16"></iconify-icon>
                </button>
                <div class="dropdown-menu mt-4" style="width: 202px;">
                    @foreach ($departmentsWithApplications as $department)
                        <div class="d-flex gap-3 align-items-center custom-check-input">
                            <input class="interview-option" type="radio" name="departmentFilter"
                                value="{{ $department->department_id }}" data-target="Department">
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                <p class="m-0">{{ $department->department_name }}</p>
                                <span>{{ $department->application_count }}</span>
                            </label>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                        <button class="resetBtn border-0" data-target="Department">Reset</button>
                        <button class="filter border-0">Filter</button>
                    </div>
                </div>
            </div>
            
            <div class="dropdown">
                <button class="filter-btn" type="button" id="jobPosition" data-bs-toggle="dropdown" data-default-text="Job Position" aria-expanded="false">
                    <span>Job Position</span> <iconify-icon icon="tabler:chevron-down" width="16" height="16"></iconify-icon>
                </button>
                <div class="dropdown-menu mt-4" style="width: 202px;">
                    @foreach ($jobOpeningsWithCount as $jobOpening)
                        <div class="d-flex gap-3 align-items-center custom-check-input">
                            <input class="interview-option" type="checkbox" name="jobPositionFilter" value="{{ $jobOpening->id }}" data-target="jobPosition">
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                <p class="m-0">{{ $jobOpening->job_title }}</p>
                                <span>{{ $jobOpening->application_count }}</span>
                            </label>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                        <button class="resetBtn border-0" data-target="jobPosition">Reset</button>
                        <button class="filter border-0">Filter</button>
                    </div>
                </div>
            </div>
            
            <div class="dropdown">
                <button class="filter-btn" type="button" id="interviewType" data-bs-toggle="dropdown"
                    data-default-text="Interview Type" aria-expanded="false">
                    <span>Interview Type</span> <iconify-icon icon="tabler:chevron-down" width="16" height="16"></iconify-icon>
                </button>
                <div class="dropdown-menu mt-4" style="width: 202px;">
                    @foreach ($interviewTypes as $key => $type)
                        @php
                            $count = $interviewModeCounts[$key]->application_count ?? 0;
                        @endphp
                        <div class="d-flex gap-3 align-items-center custom-check-input">
                            <input class="interview-option" type="radio" name="interviewTypeFilter" value="{{ $key }}"
                                data-target="interviewType">
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                <p class="m-0">{{ $type }}</p> <!-- Show the interview type name -->
                                <span>{{ $count }}</span> <!-- Show the count of job applications for that mode -->
                            </label>
                        </div>
                    @endforeach
            
                    <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                        <button class="resetBtn border-0" data-target="interviewType">Reset</button>
                        <button class="filter border-0">Filter</button>
                    </div>
                </div>
            </div> --}}

            <div class="dropdown">
                <button class="filter-btn" type="button" id="Department" data-bs-toggle="dropdown"
                    data-default-text="Department" aria-expanded="false">
                    <span>Department</span> <iconify-icon icon="tabler:chevron-down" width="16"
                        height="16"></iconify-icon>
                </button>
                <div class="dropdown-menu mt-4" style="width: 202px;">
                    @foreach ($departmentsWithApplications as $department)
                        <div class="d-flex gap-3 align-items-center custom-check-input">
                            <input class="interview-option" type="radio" name="departmentFilter"
                                value="{{ $department->department_name }}" data-target="Department" data-id="{{ $department->department_id }}">
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                <p class="m-0">{{ $department->department_name }}</p>
                                <span>{{ $department->application_count }}</span>
                            </label>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                        <button class="resetBtn border-0" data-target="Department" id="departReset">Reset</button>
                        <button class="filter border-0" id="departFilter">Filter</button>
                    </div>
                </div>
            </div>
            
            <div class="dropdown">
                <button class="filter-btn" type="button" id="jobPosition" data-bs-toggle="dropdown" data-default-text="Job Position" aria-expanded="false">
                    <span>Job Position</span> <iconify-icon icon="tabler:chevron-down" width="16" height="16"></iconify-icon>
                </button>
                <div class="dropdown-menu mt-4" style="width: 202px;">
                    @foreach ($jobOpeningsWithCount as $jobOpening)
                        <div class="d-flex gap-3 align-items-center custom-check-input">
                            <input class="interview-option" type="checkbox" name="jobPositionFilter" value="{{ $jobOpening->job_title }}" data-target="jobPosition" data-id="{{ $jobOpening->id }}">
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                <p class="m-0">{{ $jobOpening->job_title }}</p>
                                <span>{{ $jobOpening->application_count }}</span>
                            </label>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                        <button class="resetBtn border-0" data-target="jobPosition" id="jobReset">Reset</button>
                        <button class="filter border-0" id="jobFilter">Filter</button>
                    </div>
                </div>
            </div>
            
            <div class="dropdown">
                <button class="filter-btn" type="button" id="interviewType" data-bs-toggle="dropdown"
                    data-default-text="Interview Type" aria-expanded="false">
                    <span>Interview Type</span> <iconify-icon icon="tabler:chevron-down" width="16" height="16"></iconify-icon>
                </button>
                <div class="dropdown-menu mt-4" style="width: 202px;">
                    @foreach ($interviewTypes as $key => $type)
                        @php
                            $count = $interviewModeCounts[$key]->application_count ?? 0;
                        @endphp
                        <div class="d-flex gap-3 align-items-center custom-check-input">
                            <input class="interview-option" type="radio" name="interviewTypeFilter" value="{{ $type }}"
                                data-target="interviewType" data-id="{{ $key }}">
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                <p class="m-0">{{ $type }}</p>
                                <span>{{ $count }}</span>
                            </label>
                        </div>
                    @endforeach
            
                    <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                        <button class="resetBtn border-0" data-target="interviewType" id="typeReset">Reset</button>
                        <button class="filter border-0" id="typeFilter">Filter</button>
                    </div>
                </div>
            </div>
            
            
        </div>
        @include('admin.talent-acquisition.candidate-screening.upcoming-interview.left-table')
        
    </div>
    <div class="right-side">
        <div class="not-selected">
            <div class="d-flex align-items-start justify-content-between mb-11">
                <h4 class="sub-heading m-0 fw-medium">Interview Information</h4>
            </div>
            <div class="not-selected-content">
                <p class="m-0">No interview is currently chosen. Please select an interview to view details.</p>
            </div>
        </div>
        @include('admin.talent-acquisition.candidate-screening.upcoming-interview.inter-info')
    </div>
    
</div>
