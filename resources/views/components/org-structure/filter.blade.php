{{-- Meta tag for CSRF token --}}
@once
    @push('meta')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endpush
@endonce

@once
    @push('styles')
        <style>
            /* Scoped styles for filter component loading state */
            .select-box.loading { opacity: 0.9; pointer-events: none; }
            .select-box.disabled { opacity: 0.6; }
            .filter-loading-text { display: inline-flex; align-items: center; gap: 8px; }
            .filter-loading-text::before {
                content: '';
                width: 14px; height: 14px; border-radius: 50%;
                border: 2px solid rgba(0,0,0,0.12); border-top-color: #f7941c;
                display: inline-block; animation: filter-spin 0.8s linear infinite;
            }
            @keyframes filter-spin { to { transform: rotate(360deg); } }
        </style>
    @endpush
@endonce

{{-- Filter Button --}}
{{-- <button id="filter-btn" class="btn btn-primary" type="button">
    <iconify-icon icon="mi:filter" width="20" height="20"></iconify-icon>
    Filters
</button> --}}

{{-- Search Dropdown --}}
{{-- <div class="search-dropdown position-relative me-3">
    <div class="input-group">
        <span class="input-group-text border-0 bg-transparent">
            <iconify-icon icon="stash:search-solid" width="16" height="16"></iconify-icon>
        </span>
        <input type="text" id="searchInput" class="form-control border-0" placeholder="Search by name...">
        <button id="clearBtn" class="btn btn-link text-muted d-none" type="button">
            <iconify-icon icon="maki:cross" width="12" height="12"></iconify-icon>
        </button>
    </div>
    <div id="dropdownList" class="dropdown-menu w-100 d-none" style="max-height: 300px; overflow-y: auto;"></div>
</div> --}}

{{-- Organization Details Panel --}}
<div id="showDetailsBtn" class="btn btn-link" style="display: none;">
    Show Organization Details
</div>
<div id="detailsPanel" style="display: none;"></div>

{{-- Filter Offcanvas --}}
<div id="offcanvasRight" class="offcanvas offcanvas-end" data-bs-scroll="false">
    <div class="offcanvas-header">
        <div class="d-flex gap-2 align-items-center">
            <h5 class="offcanvas-title">Filters <span class="total-filter-count"></span></h5>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" style="padding-bottom: 120px;">

        {{-- Business Unit Filter --}}
        <div class="filter-block mb-4" data-type="Business Unit" data-key="bu">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="filter-side-heading mb-5">Business Unit <span class="filter-count">(0)</span></h5>
                <p class="m-0 clear-filters text-decoration-underline section-clear">Clear All</p>
            </div>
            <div class="select-wrapper">
                <div class="select-box" data-select="box">
                    <span class="selected-label">0 Business Unit(s) selected</span>
                    <span class="arrow">
                        <iconify-icon icon="fluent:chevron-down-16-filled" width="16" height="16"
                            style="color: #78829D;"></iconify-icon>
                    </span>
                </div>
                <div class="dropdown" style="display:none;">
                    <div class="search-input d-flex align-items-center gap-2 py-4 px-3">
                        <iconify-icon icon="stash:search-solid" width="16" height="16"></iconify-icon>
                        <input type="text" class="search-box border-0" placeholder="Search for Business Unit">
                    </div>
                    <div class="options-list" data-list="bu"></div>
                    <div class="dropdown-footer">
                        <button class="btn-reset" data-action="reset">Reset</button>
                        <button class="btn-filter" data-action="apply">Filter</button>
                    </div>
                </div>
                <div class="selected-tags d-flex flex-wrap gap-2 mt-3" data-tags="true"></div>
            </div>
        </div>
        {{-- <hr> --}}

        {{-- Company/Division Filter --}}
        <div class="filter-block mb-4" data-type="Company/Division" data-key="company">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="filter-side-heading mb-5">Company/Division <span class="filter-count">(0)</span></h5>
                <p class="m-0 clear-filters text-decoration-underline section-clear">Clear All</p>
            </div>
            <div class="select-wrapper">
                <div class="select-box disabled" data-select="box">
                    <span class="selected-label">0 Company/Division(s) selected</span>
                    <span class="arrow">
                        <iconify-icon icon="fluent:chevron-down-16-filled" width="16" height="16"
                            style="color: #78829D;"></iconify-icon>
                    </span>
                </div>
                <div class="dropdown" style="display:none;">
                    <div class="search-input d-flex align-items-center gap-2 py-4 px-3">
                        <iconify-icon icon="stash:search-solid" width="16" height="16"></iconify-icon>
                        <input type="text" class="search-box border-0" placeholder="Search For Company/Division">
                    </div>
                    <div class="options-list" data-list="company"></div>
                    <div class="dropdown-footer">
                        <button class="btn-reset" data-action="reset">Reset</button>
                        <button class="btn-filter" data-action="apply">Filter</button>
                    </div>
                </div>
                <div class="selected-tags d-flex flex-wrap gap-2 mt-3" data-tags="true"></div>
            </div>
        </div>
        {{-- <hr> --}}

        {{-- Departments Filter --}}
        <div class="filter-block mb-7" data-type="Departments" data-key="department">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="filter-side-heading mb-5">Departments <span class="filter-count">(0)</span></h5>
                <p class="m-0 clear-filters text-decoration-underline section-clear">Clear All</p>
            </div>
            <div class="select-wrapper">
                <div class="select-box disabled" data-select="box">
                    <span class="selected-label">0 Departments(s) selected</span>
                    <span class="arrow">
                        <iconify-icon icon="fluent:chevron-down-16-filled" width="16" height="16"
                            style="color: #78829D;"></iconify-icon>
                    </span>
                </div>
                <div class="dropdown" style="display:none;">
                    <div class="search-input d-flex align-items-center gap-2 py-4 px-3">
                        <iconify-icon icon="stash:search-solid" width="16" height="16"></iconify-icon>
                        <input type="text" class="search-box border-0" placeholder="Search For Departments">
                    </div>
                    <div class="options-list" data-list="department"></div>
                    <div class="dropdown-footer">
                        <button class="btn-reset" data-action="reset">Reset</button>
                        <button class="btn-filter" data-action="apply">Filter</button>
                    </div>
                </div>
                <div class="selected-tags d-flex flex-wrap gap-2 mt-3" data-tags="true"></div>
            </div>
        </div>
        <hr style="opacity: .10;" class="mb-7">

        {{-- Vacancy Status Filter --}}
        <div class="filter-block mb-7" data-type="Vacancy Status" data-key="vacancy">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="filter-side-heading mb-0">Vacancy Status <span class="filter-count">(0)</span></h5>
                <p class="m-0 clear-filters text-decoration-underline section-clear">Clear All</p>
            </div>
            <div class="form-group">
                <select class="form-control" id="vacancyStatus" name="vacancy_status">
                    <option value="">All Statuses</option>
                    <option value="vacant">Vacant</option>
                    <option value="filled">Filled</option>
                </select>
            </div>
        </div>
        <hr style="opacity: .10;" class="mb-7">

        {{-- Position Level Filter --}}
        <div class="filter-block mb-4" data-type="Position Level" data-key="levels">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="filter-side-heading mb-0">Position Level <span class="filter-count"
                        id="total-filter-level-count">(0)</span></h5>
                <p class="m-0 clear-filters section-clear"
                    style="color: #99A1B7; font-size: 14px; text-decoration: underline; cursor: pointer;">Clear All</p>
            </div>

            {{-- Position Level Items --}}
            <div class="position-levels-list mt-3" id="position-levels-container">
                @php
                    $configLevels = config('levels', [
                        'Level 1' => 1,
                        'Level 2' => 2,
                        'Level 3' => 3,
                        'Level 4' => 4,
                        'Level 5' => 5,
                        'Level 6' => 6,
                        'Level 7' => 7,
                        'Level 8' => 8,
                        'Level 9' => 9,
                        'Level 10' => 10,
                    ]);
                    // Sort by level number
                    uasort($configLevels, function ($a, $b) {
                        return (int) $a - (int) $b;
                    });
                    $levelIndex = 0;
                @endphp

                @foreach ($configLevels as $levelName => $levelNumber)
                    <div class="position-level-item d-flex align-items-center justify-content-between py-2"
                        data-level="{{ $levelNumber }}"
                        @if ($levelIndex >= 5) style="display:none!important;" @endif>
                        <div class="d-flex align-items-center gap-3">
                            <input type="checkbox" class="level-checkbox" id="level-{{ $levelNumber }}"
                                value="{{ $levelNumber }}">
                            <label for="level-{{ $levelNumber }}"
                                class="level-label mb-0">{{ $levelName }}</label>
                        </div>
                        <span class="level-count" data-level-count="{{ $levelNumber }}">0</span>
                    </div>
                    @php $levelIndex++; @endphp
                @endforeach
            </div>

            {{-- Show More Button --}}
            @if (count($configLevels) > 5)
                <div class="text-center mt-4" id="show-more-levels">
                    <button class="show-more-btn" type="button"
                        style="color: #F7941C; text-decoration: underline; background: none; border: none; font-size: 14px; cursor: pointer;">
                        Show More
                    </button>
                </div>
            @endif
        </div>
        <hr class="my-10">

        {{-- Job-Centric Assessment Filter --}}
        <div class="filter-block mb-4" data-type="Assessment" data-key="assessment">
            {{-- Title --}}
            <h4 class="assessment-title mb-4">Job-Centric Assessment Filter</h4>
            
            {{-- Active Filters Header --}}
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="assessment-active-title mb-0">Active Filters <span class="assessment-count">(0)</span></h6>
                <a href="#" class="assessment-clear-all" style="display: none;">Clear All</a>
            </div>
            
            {{-- Description --}}
            <p class="assessment-description mb-4">Only 3 filters can be active at a time, and each Assessment Results Type can be chosen once.</p>
            
            {{-- Selected Tags Container --}}
            <div class="assessment-tags mb-4" data-tags="assessment"></div>

            {{-- Filter Form --}}
            <div class="assessment-form-container">
                <div class="mb-4">
                    <label class="assessment-label mb-3">Assessment Results Type</label>
                    <div class="custom-select-wrapper">
                        <div class="custom-select" data-dropdown="type">
                            <div class="select-trigger">
                                <span class="select-text">Select Assessment Results Type</span>
                                <svg class="select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <div class="select-options">
                                <div class="option" data-value="overall_match_rate" data-icon="target">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                        <circle cx="12" cy="12" r="6" stroke="currentColor" stroke-width="2"/>
                                        <circle cx="12" cy="12" r="2" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                    Overall Match Rate
                                </div>
                                <div class="option" data-value="behavioral_fit_rate" data-icon="user">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2"/>
                                        <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                    Behavioral Fit Rate
                                </div>
                                <div class="option" data-value="job_match_rate" data-icon="briefcase">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                                        <line x1="8" y1="21" x2="16" y2="21" stroke="currentColor" stroke-width="2"/>
                                        <line x1="12" y1="17" x2="12" y2="21" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                    Job Match Rate
                                </div>
                                <div class="option" data-value="technical_skill_match_rate" data-icon="briefcase">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2" stroke="currentColor" stroke-width="2"/>
                                        <line x1="8" y1="21" x2="16" y2="21" stroke="currentColor" stroke-width="2"/>
                                        <line x1="12" y1="17" x2="12" y2="21" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                    Technical Skill Match Rate
                                </div>
                                <div class="option" data-value="soft_skill_match_rate" data-icon="lightbulb">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <path d="M9 21h6" stroke="currentColor" stroke-width="2"/>
                                        <path d="M12 17h0" stroke="currentColor" stroke-width="2"/>
                                        <path d="M12 3a6 6 0 0 0-6 6c0 1 .2 2 .6 2.8L8 15h8l1.4-3.2c.4-.8.6-1.8.6-2.8a6 6 0 0 0-6-6z" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                    Soft Skill Match Rate
                                </div>
                                <div class="option" data-value="growth_potential" data-icon="trending-up">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18" stroke="currentColor" stroke-width="2"/>
                                        <polyline points="17 6 23 6 23 12" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                    Growth Potential
                                </div>
                                <div class="option" data-value="workplace_alignment_forecast" data-icon="building">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18H6z" stroke="currentColor" stroke-width="2"/>
                                        <path d="M6 12h12" stroke="currentColor" stroke-width="2"/>
                                        <path d="M6 8h12" stroke="currentColor" stroke-width="2"/>
                                        <path d="M6 16h12" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                    Workplace Alignment Forecast
                                </div>
                                <div class="option" data-value="flight_risk" data-icon="airplane">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <path d="M17.8 19.2 16 11l3.5-3.5C21 6 21 4 19 4s-2 1-3.5 2.5L11 8.2V2.5l1-1V0l-3 2L6 0v1.5l1 1V8.2l-4.5-1.7C1 6 1 4-1 4s-2 1-3.5 2.5L-8 11l1.8 8.2" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                    Flight Risk
                                </div>
                                <div class="option" data-value="cognitive_ability_test" data-icon="brain">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                        <path d="M9.5 2A2.5 2.5 0 0 1 12 4.5v15a2.5 2.5 0 0 1-4.96.44 2.5 2.5 0 0 1-2.96-3.08 3 3 0 0 1-.34-5.58 2.5 2.5 0 0 1 1.32-4.24 2.5 2.5 0 0 1 1.98-3A2.5 2.5 0 0 1 9.5 2Z" stroke="currentColor" stroke-width="2"/>
                                        <path d="M14.5 6.5a2.5 2.5 0 0 1 0 5 2.5 2.5 0 0 1 0 5 2.5 2.5 0 0 1 0 5" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                    Cognitive Ability Test
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="assessment-label mb-3">Results Level</label>
                    <div class="custom-select-wrapper">
                        <div class="custom-select disabled" data-dropdown="level">
                            <div class="select-trigger">
                                <span class="select-text">Select Results Level</span>
                                <svg class="select-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none">
                                    <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <div class="select-options">
                                <div class="option" data-value="very_high" data-color="#22c55e">
                                    <span class="level-indicator" style="color: #22c55e;">▲</span>Very High
                                </div>
                                <div class="option" data-value="high" data-color="#22c55e">
                                    <span class="level-indicator" style="color: #22c55e;">▲</span>High
                                </div>
                                <div class="option" data-value="low_risk" data-color="#22c55e">
                                    <span class="level-indicator" style="color: #22c55e;">▼</span>Low Risk
                                </div>
                                <div class="option" data-value="very_low_risk" data-color="#22c55e">
                                    <span class="level-indicator" style="color: #22c55e;">▽</span>Very Low Risk
                                </div>
                                <div class="option" data-value="moderate" data-color="#f59e0b">
                                    <span class="level-indicator" style="color: #f59e0b;">♦</span>Moderate/ Moderate Risk
                                </div>
                                <div class="option" data-value="low" data-color="#ef4444">
                                    <span class="level-indicator" style="color: #ef4444;">▼</span>Low
                                </div>
                                <div class="option" data-value="very_low" data-color="#ef4444">
                                    <span class="level-indicator" style="color: #ef4444;">▽</span>Very Low
                                </div>
                                <div class="option" data-value="very_high_risk" data-color="#ef4444">
                                    <span class="level-indicator" style="color: #ef4444;">▲</span>Very High Risk
                                </div>
                                <div class="option" data-value="high_risk" data-color="#ef4444">
                                    <span class="level-indicator" style="color: #ef4444;">▲</span>High Risk
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button class="assessment-add-btn disabled" type="button" data-action="add-filter" disabled>
                    Add Filter
                </button>
            </div>
        </div>


    </div>
    <div class="d-flex gap-3 footer-btn position-sticky bottom-0 start-0 end-0 p-3 bg-white border-top">
        <button type="button" class="clear-filter btn btn-outline-secondary" id="footer-clear">Clear
            Filters</button>
        <button id="apply-filters-button" class="apply-filters btn btn-primary" type="button">Apply Filters</button>
    </div>
</div>

{{-- Styles --}}
@once
    @push('styles')
        <style>
            .offcanvas {
                width: 400px !important;
            }

            .filter-block .select-box {
                padding: 10px 15px;
                border: 1px solid #ddd;
                border-radius: 5px;
                cursor: pointer;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .filter-block .select-box.disabled {
                background-color: #f5f5f5;
                cursor: not-allowed;
                opacity: 0.6;
            }

            .filter-block .dropdown {
                position: absolute;
                background: white;
                border: 1px solid #ddd;
                border-radius: 5px;
                width: 100%;
                z-index: 1000;
                margin-top: 5px;
                max-height: 400px;
                overflow-y: auto;
            }

            .filter-block .checkbox-option {
                display: block;
                padding: 8px 15px;
                cursor: pointer;
            }

            .filter-block .checkbox-option:hover {
                background-color: #f5f5f5;
            }

            .custom-checkbox {
                display: flex;
                align-items: center;
                cursor: pointer;
            }

            .custom-checkbox input[type="checkbox"] {
                margin-right: 10px;
            }

            .tag-custom-chips {
                background-color: #f0f0f0;
                padding: 5px 10px;
                border-radius: 15px;
                font-size: 14px;
            }

            .dropdown-footer {
                padding: 10px;
                border-top: 1px solid #ddd;
                display: flex;
                justify-content: space-between;
            }

            .btn-reset,
            .btn-filter {
                padding: 5px 15px;
                border: none;
                border-radius: 3px;
                cursor: pointer;
            }

            .btn-reset {
                background-color: #f0f0f0;
            }

            .btn-filter {
                background-color: #F7941C;
                color: white;
            }

            .search-dropdown .dropdown-menu {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
            }

            .dropdown-item {
                padding: 8px 15px;
                cursor: pointer;
            }

            .dropdown-item:hover {
                background-color: #f5f5f5;
            }

            .dropdown-item.show-more {
                color: #F7941C;
                font-weight: 500;
            }

            .position-level-item {
                transition: all 0.3s ease;
            }

            .level-checkbox {
                cursor: pointer;
            }

            .footer-btn {
                background-color: white;
                box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            }

            .clear-filter,
            .apply-filters {
                flex: 1;
                padding: 10px;
            }


            .elements-chart-inner {
                margin-bottom: 20px;
            }

            .tags-elements {
                background-color: #f5f5f5;
                padding: 5px 10px;
                border-radius: 5px;
                font-size: 14px;
            }

            /* Job-Centric Assessment Filter Styles */
            .assessment-title {
                font-size: 20px;
                font-weight: 600;
                color: #1a1a1a;
                margin-bottom: 24px;
            }

            .assessment-active-title {
                font-size: 16px;
                font-weight: 600;
                color: #1a1a1a;
            }

            .assessment-count {
                color: #6b7280;
                font-weight: normal;
            }

            .assessment-clear-all {
                color: #9ca3af;
                font-size: 14px;
                text-decoration: underline;
            }

            .assessment-clear-all:hover {
                color: #6b7280;
                text-decoration: underline;
            }

            .assessment-description {
                color: #9ca3af;
                font-size: 14px;
                line-height: 1.5;
                margin-bottom: 24px;
            }

            .assessment-tags {
                min-height: 24px;
                margin-bottom: 24px;
            }

            .assessment-form-container {
                background: #f8f9fa;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
                padding: 24px;
            }

            .assessment-label {
                display: block;
                font-size: 16px;
                font-weight: 600;
                color: #1a1a1a;
                margin-bottom: 12px;
            }

            .custom-select-wrapper {
                position: relative;
                margin-bottom: 24px;
            }

            .custom-select {
                position: relative;
                width: 100%;
            }

            .select-trigger {
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
                padding: 12px 16px;
                font-size: 14px;
                color: #374151;
                background: white;
                border: 1px solid #d1d5db;
                border-radius: 6px;
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .custom-select:not(.disabled) .select-trigger:hover {
                border-color: #f97316;
            }

            .custom-select.active .select-trigger {
                border-color: #f97316;
                box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
            }

            .custom-select.disabled .select-trigger {
                background: #f3f4f6;
                color: #9ca3af;
                cursor: not-allowed;
                border-color: #d1d5db;
            }

            .select-text {
                flex: 1;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .select-text svg {
                width: 16px;
                height: 16px;
                color: #6b7280;
                flex-shrink: 0;
            }

            .select-arrow {
            width: 7px;
            height: 7px;
            color: #78829D;
                transition: transform 0.2s ease;
            }

            .custom-select.active .select-arrow {
                transform: rotate(180deg);
            }

            .select-options {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                border: 1px solid #d1d5db;
                border-top: none;
                border-radius: 0 0 6px 6px;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
                max-height: 200px;
                overflow-y: auto;
                z-index: 1000;
                display: none;
            }

            .custom-select.active .select-options {
                display: block;
            }

            .option {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 12px 16px;
                cursor: pointer;
                transition: background-color 0.2s ease;
                font-size: 14px;
            }

            .option:hover {
                background-color: #f9fafb;
            }

            .option.selected {
                background-color: #fef3e2;
                color: #ea580c;
            }

            .option svg {
                width: 16px;
                height: 16px;
                color: #6b7280;
                flex-shrink: 0;
            }

            .option.selected svg {
                color: #ea580c;
            }

            .level-indicator {
                font-size: 14px;
                font-weight: 600;
                margin-right: 8px;
            }

            /* Assessment Tags Styling */
            .assessment-tags {
                display: flex;
                flex-direction: column;
                gap: 6px;
                margin-bottom: 16px;
                min-height: 20px;
            }

            .assessment-tag {
                display: inline-flex;
                align-items: center;
                border: 1px solid #dee2e6;
                margin-bottom: 4px;
                width: fit-content;
                max-width: 100%;
                box-sizing: border-box;
                padding: 4px 12px;
                gap: 4px;
                border-radius: 80px;
                background: #F1F1F4;
                color: #4B5675;
                font-size: 12px;
                font-weight: 500;
                line-height: 16px;
            }

            .assessment-tag iconify-icon {
                width: 14px;
                height: 14px;
                color: #6b7280;
                flex-shrink: 0;
            }

            .assessment-tag-text {
                font-weight: 500;
                margin-right: 3px;
                line-height: 1.2;
                white-space: nowrap;
            }

            .assessment-tag .level-indicator {
                margin: 0 1px;
                display: inline-flex;
                align-items: center;
            }

            .assessment-tag .level-indicator iconify-icon {
                width: 12px;
                height: 12px;
            }

            .assessment-tag-level {
                font-weight: 500;
                margin-left: 2px;
                margin-right: 4px;
                flex-shrink: 0;
                line-height: 1.2;
                white-space: nowrap;
            }

            .assessment-tag-remove {
                color: #6c757d;
                border: none;
                background: none;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 20px;
                transition: background-color 0.2s;
                flex-shrink: 0;
                padding: 0;
                position: relative;
                top: -2px;
            }

            .assessment-clear-all {
                color: #6b7280;
                text-decoration: none;
                font-size: 14px;
                font-weight: 500;
            }

            .assessment-clear-all:hover {
                color: #374151;
                text-decoration: underline;
            }

            .assessment-add-btn {
                width: 100%;
                padding: 12px 24px;
                font-size: 14px;
                font-weight: 500;
                background: #e5e7eb;
                color: #9ca3af;
                border: none;
                border-radius: 6px;
                cursor: not-allowed;
                transition: all 0.2s ease;
            }

            .assessment-add-btn:not(.disabled) {
                background: #f59e0b;
                color: white;
                cursor: pointer;
            }

            .assessment-add-btn:not(.disabled):hover {
                background: #d97706;
            }

            /* Icon color classes */
            .icon-green,
            iconify-icon.icon-green {
                color: #28a745 !important;
            }

            .icon-yellow,
            iconify-icon.icon-yellow {
                color: #ffc107 !important;
            }

            .icon-red,
            iconify-icon.icon-red {
                color: #dc3545 !important;
            }

            /* Icon rotation classes */
            .rotate-90,
            iconify-icon.rotate-90 {
                transform: rotate(90deg);
            }

            .rotate-minus-90,
            iconify-icon.rotate-minus-90 {
                transform: rotate(-90deg);
            }

            /* Tag custom chips styling */
            .tag-custom-chips {
                background-color: #f8f9fa;
                border: 1px solid #dee2e6;
                padding: 6px 10px;
                border-radius: 16px;
                font-size: 13px;
                display: inline-flex;
                align-items: center;
                gap: 5px;
                margin-right: 8px;
                margin-bottom: 5px;
            }

            .tag-custom-chips .cursor-pointer {
                cursor: pointer;
                color: #6c757d;
                margin-left: 3px;
            }

        </style>
    @endpush
@endonce

{{-- Scripts --}}
@once
    @push('scripts')
        {{-- Iconify for icons --}}
        <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>


        {{-- Compiled JavaScript --}}
        <script src="{{ mix('js/org-chart-filter.js') }}" defer></script>
    @endpush
@endonce
