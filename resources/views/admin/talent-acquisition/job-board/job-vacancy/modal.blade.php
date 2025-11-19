<div class="modal fade" id="ReuseAdvertisement" tabindex="-1" aria-labelledby="ReuseAdvertisementLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div" style="
        min-width: 510px;
    ">
            <div class="modal-header py-6">
                <h1 class="modal-title" id="ReuseAdvertisementLabel">Reuse Previous Job
                    Advertisement</h1>
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"><img
                        src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
            </div>
            <div class="modal-body">
                <p class="m-0">Previous Job Advertisement (mark as ‘Filled’)</p>
                <div class="mt-4">
                    <div class="d-flex align-items-center">
                        <div class="dropdown">
                            <div class="form-select dropdown-div text-start year" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Select a Year
                            </div>
                            <ul class="dropdown-menu w-100 mt-2" style="min-width: 100%;">
                                <li><a class="dropdown-item" href="#"
                                        onclick="setDropdownValue(this, 'year')">2025</a></li>
                                <li><a class="dropdown-item" href="#"
                                        onclick="setDropdownValue(this, 'year')">2024</a></li>
                                <li><a class="dropdown-item" href="#"
                                        onclick="setDropdownValue(this, 'year')">2023</a></li>
                                <li><a class="dropdown-item" href="#"
                                        onclick="setDropdownValue(this, 'year')">2022</a></li>
                                <li><a class="dropdown-item" href="#"
                                        onclick="setDropdownValue(this, 'year')">2021</a></li>
                                <li><a class="dropdown-item" href="#"
                                        onclick="setDropdownValue(this, 'year')">2020</a></li>
                                <li><a class="dropdown-item" href="#"
                                        onclick="setDropdownValue(this, 'year')">2019</a></li>
                                <li><a class="dropdown-item" href="#"
                                        onclick="setDropdownValue(this, 'year')">2018</a></li>
                            </ul>
                        </div>

                        <div class="dropdown w-100">
                            <div class="form-select previous-job-btn text-start" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"
                                title="Select a Previous Job Advertisement">
                                Select a Previous Job Advertisement
                            </div>
                            <ul class="dropdown-menu w-100 mt-2">
                                <li><a class="dropdown-item" href="#"
                                        onclick="setDropdownValue(this, 'previous-job-btn')">
                                        <strong>Software Engineer</strong>, <em>Full Time, Kuala
                                            Lumpur</em><br> – Dec 10, 2023
                                    </a></li>
                                <li><a class="dropdown-item" href="#"
                                        onclick="setDropdownValue(this, 'previous-job-btn')">
                                        <strong>Software Engineer</strong>, <em>Part Time,
                                            Sepang</em><br> – Oct 20, 2023
                                    </a></li>
                                <li><a class="dropdown-item" href="#"
                                        onclick="setDropdownValue(this, 'previous-job-btn')">
                                        <strong>Software Engineer</strong>, <em>Full Time, Kuala
                                            Lumpur</em><br> – June 20, 2023
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer d-block">
                <div class="filter-content d-flex justify-content-between gap-2">
                    <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                    <button id="applyUSeBtn" class="btn btn-apply btn-apply-disable" disabled>
                        <iconify-icon icon="ri:loop-right-line" width="16" height="16"></iconify-icon>
                        Use This Ad Information
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="CreateJobAdvertisement" tabindex="-1" aria-labelledby="CreateJobAdvertisementLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content modal-div">
            <div class="modal-header py-6">
                <h1 class="modal-title" id="CreateJobAdvertisementLabel">Create Job Advertisement</h1>
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"><img
                        src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
            </div>
            <div class="modal-body p-15 text-left">
                @include('admin.talent-acquisition.job-board.create-edit-job-advertisement.create-job-advertisement')
            </div>
            <div class="modal-footer modal-footer d-block">
                <div class="filter-content">
                    <div class="d-flex justify-content-between">
                        <div>
                            <button class="btn btn-outline">Previous: Vacancy
                                Details</button>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline">Save Draft</button>
                            <button class="btn btn-apply" data-bs-toggle="modal"
                                data-bs-target="#JobPostingPreviewModal" style="width: 281px;">Next: Job
                                Qualification</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="EditJobAdvertisement" tabindex="-1" aria-labelledby="EditJobAdvertisementLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content modal-div">
            <div class="modal-header py-6">
                <h1 class="modal-title" id="EditJobAdvertisementLabel">Edit Job Advertisement</h1>
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"><img
                        src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
            </div>
            <div class="modal-body p-15 text-left">
                @include('admin.talent-acquisition.job-board.create-edit-job-advertisement.create-job-advertisement')
            </div>
            <div class="modal-footer modal-footer d-block">
                <div class="filter-content">
                    <div class="d-flex justify-content-end">
                        <div class="d-flex gap-2">
                            <button class="btn btn-apply" data-bs-toggle="modal"
                                data-bs-target="#AdvertisementUpdate">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="JobPostingPreviewModal" tabindex="-1" aria-labelledby="JobPostingPreviewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content modal-div">
            <div class="modal-header py-6">
                <h1 class="modal-title" id="JobPostingPreviewModalLabel">Edit Job Advertisement</h1>
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"><img
                        src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
            </div>
            <div class="modal-body p-10 text-left" style="background-color: #F1F1F4;">
                @include('admin.talent-acquisition.job-board.create-edit-job-advertisement.job-posting-preview')
            </div>
            <div class="modal-footer modal-footer d-block">
                <div class="filter-content">
                    <div class="d-flex justify-content-between">
                        <div>
                            <button class="btn btn-outline">Back to Edit</button>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline">Save Draft</button>
                            <button class="btn btn-apply" style="width: 326px;" data-bs-toggle="modal"
                            data-bs-target="#AdvertisementCreated">Create Job
                                Advertisement</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

