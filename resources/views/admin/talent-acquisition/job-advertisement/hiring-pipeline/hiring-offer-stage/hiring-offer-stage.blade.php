<div class="d-flex applicants-main-div">
    <h4 class="m-0">Contract Pending</h4>
    <div class="input-group d-flex gap-5">
        <div class="px-4 h-2 search-container d-flex align-items-center">
            <span class="border-0 bg-transparent p-0 me-2 d-flex">
                <iconify-icon icon="mingcute:search-line" width="16" height="16"
                    style="color: #99A1B7"></iconify-icon>
            </span>
            <input type="text" id="searchInputOfferStage" class="border-0 shadow-none p-0" placeholder="Search Applicant">
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
        <button class="border-0 field-setting interview-conducted-content" data-bs-toggle="modal"
        data-bs-target="#selection-matrix">
            <img src="{{ asset('/admin/media/svg/shapes/arrow-cross.svg') }}" alt="filter-icon" />
            Selection Matrix
        </button>
    </div>
    {{-- @include('admin.talent-acquisition.job-advertisement.hiring-pipeline.hiring-offer-stage.hiring-offer-stage-table') --}}
</div>
