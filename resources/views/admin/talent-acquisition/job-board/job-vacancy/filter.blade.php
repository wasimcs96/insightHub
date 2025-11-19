<div class="input-group mb-5 d-flex justify-content-between">
    <div class="input-group h-2 search-container align-items-center justify-content-between">
        <input type="text" class="border-0 shadow-none px-4" name="search" id="search"
            placeholder="Search Job Vacancy">
        <span class="bg-transparent p-0 d-flex align-items-center px-3 h-100 cursor-pointer" style="border-left: 1px solid #C4CADA;" type="submit" id="filter-btn">
            <iconify-icon icon="mingcute:search-line" width="16" height="16" style="color: #99A1B7;"></iconify-icon>
        </span>
    </div>
    {{-- <button type="submit" class="btn btn-sm btn-icon btn-light-primary me-3" id="filter-btn" data-bs-toggle="tooltip"
        data-bs-placement="top" title="Filter By Name">
        <iconify-icon icon="mdi:filter"></iconify-icon>
    </button> --}}
    <button class="border-0 filter-button filterBtn" id="openFilterBtn">
        <img src="{{ asset('/admin/media/svg/files/filter.svg') }}" alt="filter-icon" />
        Filters & Sort <span class="filterCount"></span>
    </button>
</div> 

<p id="jobVacanciesText" class="found-text mb-5" style="display: none;"></p>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Filters & Sort</h5>
        <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="offcanvas" aria-label="Close"><img
                src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
    </div>
    <div class="offcanvas-body">
        <div class="filter-content">
            <h5 class="d-flex justify-content-between">Selected <span class="cursor-pointer clear-all-btn"
                    data-bs-dismiss="offcanvas" aria-label="Close">Clear
                    all</span></h5>

            <div class="mb-2 d-flex align-items-center selected-text" id="selectedSortContainer">
                <p class="m-0" id="selectedSort">Sort By: Most Recent</p>
                <iconify-icon icon="maki:cross" width="14" height="14" style="color: #78829D;"
                    onclick="clearFilter('selectedSort', 'sortDropdown1')"></iconify-icon>
            </div>

            <div class="mb-2 d-flex align-items-center selected-text" id="selectedDepartmentContainer">
                <p class="m-0" id="selectedDepartment">Any Department</p>
                <iconify-icon icon="maki:cross" width="14" height="14" style="color: #78829D;"
                    onclick="clearFilter('selectedDepartment', 'sortDropdown2')"></iconify-icon>
            </div>

            <div class="mb-2 d-flex align-items-center selected-text" id="selectedPositionLevelContainer">
                <p class="m-0" id="selectedPositionLevel">Position Level - Any</p>
                <iconify-icon icon="maki:cross" width="14" height="14" style="color: #78829D;"
                    onclick="clearFilter('selectedPositionLevel')"></iconify-icon>
            </div>

            <div class="filter-line"></div>
        </div>
        <div class="filter-content">
            <h5 class="d-flex justify-content-between">Sort By <span class="cursor-pointer" id="resetSort">Reset to default</span></h5>
            <div class="dropdown jobFilter" id="sortDropdown1">
                <div class="form-select dropdown-div text-start" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Select an option
                </div>
                <ul class="dropdown-menu w-100">
                    <li><a class="dropdown-item d-flex justify-content-between align-items-center" href="#"
                            onclick="updateDropdownText(this)">Job Title A-Z <span class="checkmark"></span></a></li>
                    <li><a class="dropdown-item d-flex justify-content-between align-items-center" href="#"
                            onclick="updateDropdownText(this)">Job Title Z-A <span class="checkmark"></span></a></li>
                    <li><a class="dropdown-item d-flex justify-content-between align-items-center" href="#"
                            onclick="updateDropdownText(this)">Most Recent
                            <span class="checkmark">
                                <iconify-icon icon="fa6-solid:check" width="14" height="16"></iconify-icon>
                            </span>
                        </a>
                    </li>
                    <li><a class="dropdown-item d-flex justify-content-between align-items-center" href="#"
                            onclick="updateDropdownText(this)">Oldest <span class="checkmark"></span></a></li>
                    <li><a class="dropdown-item d-flex justify-content-between align-items-center" href="#"
                            onclick="updateDropdownText(this)">Most Total Vacancies <span
                                class="checkmark"></span></a>
                    </li>
                    <li><a class="dropdown-item d-flex justify-content-between align-items-center" href="#"
                            onclick="updateDropdownText(this)">Fewest Total Vacancies <span
                                class="checkmark"></span></a></li>
                </ul>
            </div>
            <div class="filter-line"></div>
        </div>
        <div class="filter-content">
            <h5 class="d-flex justify-content-between">Filters <span class="cursor-pointer clear-all-btn">Clear
                    filters</span></h5>
            <label for="Department">Department</label>
            <div class="dropdown" id="sortDropdown2">
                <div class="form-select dropdown-div text-start" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Any Department
                </div>
                <ul class="dropdown-menu w-100">
                    {{-- <li>
                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="#" onclick="updateDropdownText(this)">
                            Any Department <span>{{ $departments->sum('job_count') }}</span>
                        </a>
                    </li> --}}
                    <li>
                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="#"
                            onclick="updateDropdownText(this)" data-id="">
                            <p class="mb-0 department-name-filter">Any Department</p>
                            <span>{{ $departments->sum('job_count') }}</span>
                        </a>
                    </li>
                    @foreach ($departments as $department)
                        @if ($department->job_count > 0)
                            <li>
                                <a class="dropdown-item d-flex justify-content-between align-items-center" href="#"
                                    onclick="updateDropdownText(this)" data-id="{{ $department->id }}">
                                    <p class="mb-0 department-name-filter">{{ $department->name }}</p> <span>{{ $department->job_count }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

        </div>
        <div class="filter-content mt-10">
            <label for="Position Level">Position Level</label>
            <div class="mt-2 mb-10">
                {{-- @foreach ($levels as $levelName => $level)
                    <label class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2 align-items-center">
                            <input type="radio" name="positionLevel" value="{{ $level }}">
                            <p class="m-0 input-text">{{ $levelName }}</p>
                        </div>
                        <span class="text-muted">
                            {{ $vacancyCounts[$levelName] ?? 0 }} <!-- Display vacancy count for this level -->
                        </span>
                    </label>
                @endforeach --}}
                @php
                $totalVacancyCount = collect($vacancyCounts)->sum();
                @endphp
                <label class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-2 align-items-center">
                        <input type="radio" name="positionLevel" value="">
                        <p class="m-0 input-text">All Position Level</p>
                    </div>
                    <span class="text-muted">{{ $totalVacancyCount }}</span>
                </label>
                @foreach ($levels as $levelName => $level)
                @if (($vacancyCounts[$level] ?? 0) > 0)
                    <label class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2 align-items-center">
                            <input type="radio" name="positionLevel" value="{{ $level }}">
                            <p class="m-0 input-text">{{ $levelName }}</p>
                        </div>
                        <span class="text-muted">
                            {{ $vacancyCounts[$level] ?? 0 }} <!-- Use $level instead of $levelName -->
                        </span>
                    </label>
                @endif
                @endforeach

            </div>

        </div>
        <div class="filter-content d-flex justify-content-between gap-5">
            <button class="btn btn-outline clear-all-btn" data-bs-dismiss="offcanvas" aria-label="Close">Clear
                All</button>
            <button class="btn btn-apply applyFilters btn-disabled" id="applyFiltersBtn" data-bs-dismiss="offcanvas" aria-label="Close" disabled>Apply
                Filters</button>
        </div>
    </div>
</div>
