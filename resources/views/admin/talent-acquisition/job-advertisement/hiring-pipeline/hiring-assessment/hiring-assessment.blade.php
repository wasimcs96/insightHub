<div class="d-flex applicants-main-div p-0">
    <div class="d-flex justify-content-between" style="height: 40px;">
        <div class="d-flex gap-5 align-items-center">
            <h4 class="m-0">Assessment Overview</h4>
            <div class="d-flex gap-5 align-items-center d-none" id="assessmentCompletedButtons1">
                <button id="show-selected" class="border-0 filter-button">
                    <img src="{{ asset('/admin/media/svg/shapes/user-duble.svg') }}" alt="filter-icon" />
                    Compare
                </button>
                <button class="border-0 field-setting" data-bs-toggle="modal" data-bs-target="#advanced-comparison">
                    <iconify-icon icon="jam:settings-alt" width="16" height="16"></iconify-icon>
                    Advanced Compare
                </button>
                <button id="clear-comparison" class="border-0 field-setting bg-white">
                <iconify-icon icon="maki:cross" width="16" height="16"></iconify-icon>
                Clear Comparison
            </button>
            </div>
        </div>
        <div class="d-flex gap-3 align-items-center w-25 justify-content-end">
            <button class="btn-shortlist-candidate d-flex gap-3 align-items-center d-none disabled"
                id="assessmentCompletedButtons2" disabled>
                <iconify-icon icon="lucide:user-check" width="16" height="16"></iconify-icon>
                Shortlist
            </button>
            <button class="btn-reject-candidate d-flex gap-3 align-items-center disabled" disabled>
                <iconify-icon icon="solar:user-cross-broken" width="16" height="16"></iconify-icon>
                Reject Applicant
            </button>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="input-group d-flex gap-5">
            <div class="px-4 h-2 search-container d-flex align-items-center">
                <span class="border-0 bg-transparent p-0 me-2 d-flex">
                    <iconify-icon icon="mingcute:search-line" width="16" height="16"
                        style="color: #99A1B7"></iconify-icon>
                </span>
                <input type="text" id="searchInputAssessmentOverview" class="border-0 shadow-none p-0" placeholder="Search Applicant">
            </div>
            <button class="border-0 filter-button" data-bs-toggle="offcanvas" data-bs-target="#filtersSidebar"
                aria-controls="offcanvasRight">
                <img src="{{ asset('/admin/media/svg/files/filter.svg') }}" alt="filter-icon" />
                Filters & Sort <span class="filterCount"></span>
            </button>
            <button class="border-0 field-setting" data-bs-toggle="offcanvas" data-bs-target="#fieldSetting"
                aria-controls="offcanvasRight">
                <iconify-icon icon="lucide:server" width="16" height="16"></iconify-icon>
                Field Setting
            </button>
        </div>
        <div class="assessment-tabs-div">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="assessment-pending-tab" data-bs-toggle="pill"
                        data-bs-target="#assessment-pending" type="button" role="tab"
                        aria-controls="assessment-pending" aria-selected="true">Assessment Pending</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="assessment-completed-tab" data-bs-toggle="pill"
                        data-bs-target="#assessment-completed" type="button" role="tab" aria-selected="false">
                        Assessment Completed
                    </button>
                </li>

            </ul>
        </div>
    </div>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="assessment-pending" role="tabpanel"
            aria-labelledby="assessment-pending-tab" tabindex="0">
            {{-- @include('admin.talent-acquisition.job-advertisement.hiring-pipeline.hiring-assessment.assessment-pending-table') --}}
        </div>
        <div class="tab-pane fade" id="assessment-completed" role="tabpanel" aria-labelledby="assessment-completed-tab"
            tabindex="0">
            {{-- @include('admin.talent-acquisition.job-advertisement.hiring-pipeline.hiring-assessment.assessment-completed-table') --}}
        </div>
    </div>
</div>
