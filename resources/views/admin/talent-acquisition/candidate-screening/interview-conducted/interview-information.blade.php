<h1 class="heading fw-bold">Interview Conducted</h1>
<div class="d-grid grid-section">
    <div class="left-side">
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
            {{-- <div class="dropdown">
                <button class="filter-btn" type="button" id="DepartmentConducted" data-bs-toggle="dropdown"
                    data-default-text="DepartmentConducted" aria-expanded="false">
                    <span>DepartmentConducted</span> <iconify-icon icon="tabler:chevron-down" width="16"
                        height="16"></iconify-icon>
                </button>
                <div class="dropdown-menu mt-4" style="width: 202px;">
                    <div class="d-flex gap-3 align-items-center custom-check-input">
                        <input class="interview-option" type="radio" name="departmentConductedFilter"
                            value="Online Interview" data-target="DepartmentConducted">
                        <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                            <p class="m-0">Online Interview</p> <span>10</span>
                        </label>
                    </div>
                    <div class="d-flex gap-3 align-items-center custom-check-input">
                        <input class="interview-option" type="radio" name="departmentConductedFilter"
                            value="Physical Interview" data-target="DepartmentConducted">
                        <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                            <p class="m-0">Physical Interview</p> <span>4</span>
                        </label>
                    </div>
                    <div class="d-flex gap-3 align-items-center custom-check-input">
                        <input class="interview-option" type="radio" name="departmentConductedFilter"
                            value="Phone Interview" data-target="DepartmentConducted">
                        <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                            <p class="m-0">Phone Interview</p> <span>2</span>
                        </label>
                    </div>
                    <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                        <button class="resetBtn border-0" data-target="DepartmentConducted">Reset</button>
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
            {{-- <div class="dropdown">
                <button class="filter-btn" type="button" id="selectionMatrix" data-bs-toggle="dropdown"
                    data-default-text="Selection Matrix" aria-expanded="false">
                    <span>Selection Matrix</span> <iconify-icon icon="tabler:chevron-down" width="16"
                        height="16"></iconify-icon>
                </button>
                <div class="dropdown-menu mt-4" style="width: 202px;">
                    <div class="d-flex gap-3 align-items-center custom-check-input">
                        <input class="interview-option" type="radio" name="selectionMatrixFilter" value="Hire"
                            data-target="selectionMatrix">
                        <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                            <p class="m-0">Hire</p> <span>10</span>
                        </label>
                    </div>
                    <div class="d-flex gap-3 align-items-center custom-check-input">
                        <input class="interview-option" type="radio" name="selectionMatrixFilter" value="Considered Further"
                            data-target="selectionMatrix">
                        <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                            <p class="m-0">Considered Further</p> <span>4</span>
                        </label>
                    </div>
                    <div class="d-flex gap-3 align-items-center custom-check-input">
                        <input class="interview-option" type="radio" name="selectionMatrixFilter" value="Review"
                            data-target="selectionMatrix">
                        <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                            <p class="m-0">Review</p> <span>2</span>
                        </label>
                    </div>
                    <div class="d-flex gap-3 align-items-center custom-check-input">
                        <input class="interview-option" type="radio" name="selectionMatrixFilter" value="Review"
                            data-target="selectionMatrix">
                        <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                            <p class="m-0">Reject</p> <span>2</span>
                        </label>
                    </div>
                    <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                        <button class="resetBtn border-0" data-target="selectionMatrix">Reset</button>
                        <button class="filter border-0">Filter</button>
                    </div>
                </div>
            </div> --}}
            <div class="dropdown">
                <button class="filter-btn" type="button" id="selectionMatrix" data-bs-toggle="dropdown"
                    data-default-text="Selection Matrix" aria-expanded="false">
                    <span>Selection Matrix</span> <iconify-icon icon="tabler:chevron-down" width="16"
                        height="16"></iconify-icon>
                </button>
                <div class="dropdown-menu mt-4" style="width: 202px;">
                    @foreach(config('helpers.selection_matrix_levels') as $key => $value)
                        @if($key > 0) {{-- Skip "Data Not Available" --}}
                        <div class="d-flex gap-3 align-items-center custom-check-input">
                            <input class="interview-option" type="radio" name="selectionMatrixFilter" value="{{ $value }}" data-id="{{ $key }}"
                                data-target="selectionMatrix">
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                <p class="m-0">{{ $value }}</p> 
                                <span>{{ $selectionMatrixCounts[$key] ?? 0 }}</span> {{-- Replace with actual count from database --}}
                            </label>
                        </div>
                        @endif
                    @endforeach
                    <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                        <button class="resetBtn border-0" data-target="selectionMatrix" id="matricsReset">Reset</button>
                        <button class="filter border-0" id="matricsFilter">Filter</button>
                    </div>
                </div>
            </div>
            
            {{-- <div class="dropdown">
                <button class="filter-btn" type="button" id="interviewPerformance" data-bs-toggle="dropdown"
                    data-default-text="Interview Performance" aria-expanded="false">
                    <span>Interview Performance</span> <iconify-icon icon="tabler:chevron-down" width="16"
                        height="16"></iconify-icon>
                </button>
                <div class="dropdown-menu mt-4" style="width: 202px;">
                    <div class="d-flex gap-3 align-items-center custom-check-input">
                        <input class="interview-option" type="checkbox" name="interviewPerformanceType" value="Very High"
                            data-target="interviewPerformance">
                        <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                            <p class="m-0">Very High</p> <span>10</span>
                        </label>
                    </div>
                    <div class="d-flex gap-3 align-items-center custom-check-input">
                        <input class="interview-option" type="checkbox" name="interviewPerformanceType" value="High"
                            data-target="interviewPerformance">
                        <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                            <p class="m-0">High</p> <span>4</span>
                        </label>
                    </div>
                    <div class="d-flex gap-3 align-items-center custom-check-input">
                        <input class="interview-option" type="checkbox" name="interviewPerformanceType" value="Moderate"
                            data-target="interviewPerformance">
                        <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                            <p class="m-0">Moderate</p> <span>2</span>
                        </label>
                    </div>
                    <div class="d-flex gap-3 align-items-center custom-check-input">
                        <input class="interview-option" type="checkbox" name="interviewPerformanceType" value="Low"
                            data-target="interviewPerformance">
                        <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                            <p class="m-0">Low</p> <span>2</span>
                        </label>
                    </div>
                    <div class="d-flex gap-3 align-items-center custom-check-input">
                        <input class="interview-option" type="checkbox" name="interviewPerformanceType" value="Very Low"
                            data-target="interviewPerformance">
                        <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                            <p class="m-0">Very Low</p> <span>2</span>
                        </label>
                    </div>
                    <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                        <button class="resetBtn border-0" data-target="interviewPerformance">Reset</button>
                        <button class="filter border-0">Filter</button>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="dropdown">
                <button class="filter-btn" type="button" id="interviewPerformance" data-bs-toggle="dropdown"
                    data-default-text="Interview Performance" aria-expanded="false">
                    <span>Interview Performance</span> <iconify-icon icon="tabler:chevron-down" width="16"
                        height="16"></iconify-icon>
                </button>
                <div class="dropdown-menu mt-4" style="width: 202px;">
                    @php $levels = ['Very High', 'High', 'Moderate', 'Low', 'Very Low']; @endphp
                    @foreach ($levels as $level)
                        <div class="d-flex gap-3 align-items-center custom-check-input">
                            <input class="interview-option" type="checkbox" name="interviewPerformanceType"
                                value="{{ $level }}" data-target="interviewPerformance">
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                <p class="m-0">{{ $level }}</p>
                                <span>{{ $interviewPerformanceCounts[$level] ?? 0 }}</span>
                            </label>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                        <button class="resetBtn border-0" data-target="interviewPerformance" id="performanceReset">Reset</button>
                        <button class="filter border-0" id="performanceFilter">Filter</button>
                    </div>
                </div>
            </div> --}}

            <div class="dropdown">
                <button class="filter-btn" type="button" id="interviewPerformance" data-bs-toggle="dropdown"
                    data-default-text="Interview Performance" aria-expanded="false">
                    <span>Interview Performance</span> <iconify-icon icon="tabler:chevron-down" width="16"
                        height="16"></iconify-icon>
                </button>
                <div class="dropdown-menu mt-4" style="width: 202px;">
                    @php $levels = ['Very High', 'High', 'Moderate', 'Low', 'Very Low']; @endphp
                    @foreach ($levels as $level)
                        <div class="d-flex gap-3 align-items-center custom-check-input">
                            <input class="interview-option" type="checkbox" name="interviewPerformanceType"
                                value="{{ $level }}" data-target="interviewPerformance">
                            <label class="form-check-label d-flex align-items-center justify-content-between w-100">
                                <p class="m-0">{{ $level }}</p>
                                <span>{{ $interviewPerformanceCounts[$level] ?? 0 }}</span>
                            </label>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-end gap-4 align-items-center button-div">
                        <button class="resetBtn border-0" data-target="interviewPerformance" id="performanceReset">Reset</button>
                        <button class="filter border-0" id="performanceFilter">Filter</button>
                    </div>
                </div>
            </div>
            
            
        </div>
        @include('admin.talent-acquisition.candidate-screening.interview-conducted.left-table')
    </div>
    <div class="right-side">
        <div class="not-selected">
            <div class="d-flex align-items-start justify-content-between mb-11">
                <h4 class="sub-heading m-0 fw-medium">Interview Evaluation Sheet</h4>
            </div>
            <div class="not-selected-content">
                <p class="m-0">No interview is currently chosen. Please select an interview to view details.</p>
            </div>
        </div>
        @include('admin.talent-acquisition.candidate-screening.interview-conducted.inter-info')
    </div>
</div>

