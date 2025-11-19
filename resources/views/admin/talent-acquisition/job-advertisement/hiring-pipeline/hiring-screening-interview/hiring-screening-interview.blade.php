<div class="d-flex applicants-main-div p-0">
    <div class="d-flex justify-content-between" style="height: 40px;">
        <div class="d-flex gap-5 align-items-center">
            <h4 class="m-0">Interview Filtering Process</h4>
        </div>
        <div class="d-flex gap-3 align-items-center w-50 justify-content-end">
            {{-- <button class="btn-general d-flex gap-3 align-items-center interview-conducted-content d-none">
                <iconify-icon icon="lets-icons:send" width="16" height="16"></iconify-icon>
                Issue Contract
            </button> --}}
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
                <input type="text" id="searchInputInterviewScreening" class="border-0 shadow-none p-0" placeholder="Search Applicant">
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
            <button class="border-0 field-setting interview-conducted-content d-none" data-bs-toggle="modal"
                data-bs-target="#selection-matrix">
                <img src="{{ asset('/admin/media/svg/shapes/arrow-cross.svg') }}" alt="filter-icon" />
                Selection Matrix
            </button>
        </div>
        <div class="assessment-tabs-div">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="hiring-interview-scheduled-tab" data-bs-toggle="pill"
                        data-bs-target="#hiring-interview-scheduled" type="button" role="tab"
                        aria-controls="hiring-interview-scheduled" aria-selected="true">Interview Scheduled</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="hiring-interview-conducted-tab" data-bs-toggle="pill"
                        data-bs-target="#hiring-interview-conducted" type="button" role="tab"
                        aria-selected="false">
                        Interview Conducted
                    </button>
                </li>

            </ul>
        </div>
    </div>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="hiring-interview-scheduled" role="tabpanel"
            aria-labelledby="hiring-interview-scheduled-tab" tabindex="0">
            {{-- @include('admin.talent-acquisition.job-advertisement.hiring-pipeline.hiring-screening-interview.hiring-interview-scheduled-table') --}}
        </div>
        <div class="tab-content mt-3">
            <div class="tab-pane fade" id="hiring-interview-conducted" role="tabpanel"
                aria-labelledby="hiring-interview-conducted-tab" tabindex="0">
                {{-- @include('admin.talent-acquisition.job-advertisement.hiring-pipeline.hiring-screening-interview.hiring-interview-conducted-table') --}}
            </div>
        </div>
    </div>
</div>
