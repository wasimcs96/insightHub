<div class="input-group mb-5 d-flex justify-content-between">
    <div class="input-group h-2 search-container align-items-center justify-content-between">
        
        <input type="text" class="border-0 shadow-none px-4" placeholder="Search Job Advertisement" name="search_job" id="search_job">
        <span class="bg-transparent p-0 d-flex align-items-center px-3 h-100" type="submit" style="border-left: 1px solid #C4CADA;" id="filter-btn2">
            <iconify-icon icon="mingcute:search-line" width="16" height="16" style="color: #99A1B7"></iconify-icon>
        </span>
    </div>
    {{-- <button type="submit" class="btn btn-sm btn-icon btn-light-primary me-3" id="filter-btn2" data-bs-toggle="tooltip" data-bs-placement="top" title="Filter By Name">
        <iconify-icon icon="mdi:filter"></iconify-icon>
    </button> --}}
    <button class="border-0 filter-button filterBtn2">
        <img src="{{ asset('/admin/media/svg/files/filter.svg') }}" alt="filter-icon" />
        Filters & Sort <span class="filterCount2"></span>
    </button>
</div> 

<p id="jobVacanciesText2" class="found-text mb-5" style="display: none;"></p>

<div class="offcanvas offcanvas-end" tabindex="-1" id="job-advertisement" aria-labelledby="offcanvasRightLabel2">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel2">Filters & Sort</h5>
        <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="offcanvas" aria-label="Close">
            <img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel" />
        </button>
    </div>
    <div class="offcanvas-body">
        <div class="filter-content">
            <h5 class="d-flex justify-content-between">Selected <span class="cursor-pointer clear-all-btn2"
                    data-bs-dismiss="offcanvas" aria-label="Close">Clear all</span></h5>

            <div class="mb-2 d-flex align-items-center selected-text">
                <p class="m-0" id="selectedSort2">Sort By: Most Recent</p>
                <iconify-icon icon="maki:cross" width="14" height="14" style="color: #78829D;" onclick="clearFilter2('selectedSort2', 'sortDropdown2')"></iconify-icon>
            </div>

            <div class="mb-2 d-flex align-items-center selected-text">
                <p class="m-0" id="selectedDepartment2">Any Department</p>
                <iconify-icon icon="maki:cross" width="14" height="14" style="color: #78829D;" onclick="clearFilter2('selectedDepartment2', 'sortDropdown3')"></iconify-icon>
            </div>

            <div class="mb-2 d-flex align-items-center selected-text">
                <p class="m-0" id="selectedPositionLevel2">Position Level - Any</p>
                <iconify-icon icon="maki:cross" width="14" height="14" style="color: #78829D;" onclick="clearFilter2('selectedPositionLevel2')"></iconify-icon>
            </div>

            <div class="mb-2 d-flex align-items-center selected-text" id="selectedStatusWrapper" style="display: flex;">
                <p class="m-0" id="selectedStatus2">Status - Any</p>
                <iconify-icon icon="maki:cross" width="14" height="14" style="color: #78829D;" onclick="clearFilter2('selectedStatus2')"></iconify-icon>
            </div>

            <div class="filter-line"></div>
        </div>

        <!-- Sort By Section -->
        <div class="filter-content">
            <h5 class="d-flex justify-content-between">Sort By <span class="cursor-pointer" id="resetSort2">Reset to default</span></h5>
            <div class="dropdown jobOpeningFilter" id="sortDropdown2">
                <div class="form-select dropdown-div text-start" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Select an option
                </div>
                <ul class="dropdown-menu w-100">
                    <li><a class="dropdown-item d-flex justify-content-between align-items-center" href="#"
                            onclick="updateDropdownText2(this)">Job Title A-Z <span class="checkmark"></span></a></li>
                    <li><a class="dropdown-item d-flex justify-content-between align-items-center" href="#"
                            onclick="updateDropdownText2(this)">Job Title Z-A <span class="checkmark"></span></a></li>
                    <li><a class="dropdown-item d-flex justify-content-between align-items-center" href="#"
                            onclick="updateDropdownText2(this)">Most Recent
                            <span class="checkmark">
                                <iconify-icon icon="fa6-solid:check" width="14" height="16"></iconify-icon>
                            </span>
                        </a>
                    </li>
                    <li><a class="dropdown-item d-flex justify-content-between align-items-center" href="#"
                            onclick="updateDropdownText2(this)">Oldest <span class="checkmark"></span></a></li>
                    <li><a class="dropdown-item d-flex justify-content-between align-items-center" href="#"
                            onclick="updateDropdownText2(this)">Most Total Vacancies <span class="checkmark"></span></a>
                    </li>
                    <li><a class="dropdown-item d-flex justify-content-between align-items-center" href="#"
                            onclick="updateDropdownText2(this)">Fewest Total Vacancies <span class="checkmark"></span></a></li>
                </ul>
            </div>
        </div>
        <div class="filter-line"></div>
        <!-- Department Filter Section -->
        <div class="filter-content">
            <h5 class="d-flex justify-content-between">Filters <span class="cursor-pointer clear-all-btn2">Clear filters</span></h5>
            <label for="Department">Department</label>
            <div class="dropdown" id="sortDropdown3">
                <div class="form-select dropdown-div text-start" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Any Department
                </div>
                <ul class="dropdown-menu w-100">
                    <li>
                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="#"
                            onclick="updateDropdownText2(this)" data-id="">
                            <p class="mb-0 department-name-filter">All Department</p>
                            <span>{{ $departmentsJob->sum('job_count') }}</span>
                        </a>
                    </li>
                            @foreach ($departmentsJob as $department)
                            @if ($department->job_count > 0)
                            <li>
                                <a class="dropdown-item d-flex justify-content-between align-items-center" href="#" onclick="updateDropdownText2(this)" data-id="{{ $department->id }}">
                                    <p class="mb-0 department-name-filter">{{ $department->name }}</p> <span>{{ $department->job_count }}</span>
                                </a>
                            </li>
                            @endif
                        @endforeach
                </ul>
            </div>
        </div>

        <div class="filter-content mt-5 tab-status-filter" id="adsStatusFilterSection">
            <label for="Ads Status">Ads Status</label>
            <div class="mt-2">
                <!-- Loop through job statuses dynamically -->
                @foreach($status_of_job as $key => $value)
                    @if(in_array($key, [2, 3])) {{-- 2 = Active, 3 = Expired --}}
                        <label class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-2 align-items-center">
                                <input type="radio" name="jobOpeningStatus" value="{{ $key }}">
                                <p class="m-0 input-text">{{ $value }}</p>
                            </div>
                            <span class="text-muted">{{ $jobOpeningsCount[$key] ?? 0 }}</span>
                        </label>
                    @endif
                @endforeach
            </div>
        </div>
        
        <div class="filter-line my-5"></div>
        <!-- Position Level Filter Section -->
        <div class="filter-content pt-0">
            <label for="Position Level">Position Level</label>
            <div class="mt-2 mb-10">
                @php
                $totalCount = $levelsJob->sum('job_count');
            @endphp
    
            {{-- All Position Level --}}
            <label class="list-group-item d-flex justify-content-between align-items-center">
                <div class="d-flex gap-2 align-items-center">
                    <input type="radio" name="positionLevelJob" value="">
                    <p class="m-0 input-text">All Position Level</p>
                </div>
                <span class="text-muted">{{ $totalCount }}</span>
            </label>
                @foreach ($levelsJob as $level)
                @if ($level->job_count > 0)
                <label class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-2 align-items-center">
                        <input type="radio" name="positionLevelJob" value="{{ $level->level_value }}">
                        <p class="m-0 input-text">{{ $level->level_name }}</p>
                    </div>
                    <span class="text-muted">
                        {{ $level->job_count }}
                    </span>
                </label>
                @endif
            @endforeach
            

            </div>
        </div>

        <!-- Filter Actions -->
        <div class="filter-content d-flex justify-content-between gap-5">
            <button class="btn btn-outline clear-all-btn2" data-bs-dismiss="offcanvas" aria-label="Close">Clear All</button>
            <button class="btn btn-apply applyFilters2 btn-disabled" id="applyFiltersBtn2" data-bs-dismiss="offcanvas" aria-label="Close" disabled>Apply Filters</button>
        </div>
    </div>
</div>

