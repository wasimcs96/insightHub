<div class="modal fade" id="AddToExpiry" tabindex="-1" aria-labelledby="AddToExpiryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <div class="modal-body py-0 pt-5 text-center">
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"
                    style="
                float: right;
            "><img
                        src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
                <iconify-icon icon="ep:warning" width="70" height="70" class="my-5"
                    style="color: #F8BB86;"></iconify-icon>
                <p class="fw-bolder fs-1 lh-1 text-center" style="color: #4B5675;">Are You Sure You Want to Set the
                    Advertisement to Expired?
                </p>
                <p class="m-0 text-center" style="color: #4B5675;">The expiry date hasn’t passed yet. Changing the
                    status for <span class="fw-bold">{{ $jobOpening->job_title ?? '-' }}</span> position to 'Expired' means the
                    public will no longer be able to view your job posting.</p>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-between gap-2 btn-custom">
                    <button id="hideAddToExpiry" class="btn btn-outline" data-bs-dismiss="modal">No, cancel</button>
                    <button id="setAddToExpiry" class="btn btn-apply">
                        Yes, set to ‘Expired’
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <div class="modal-body py-0  pt-5 text-center">
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"
                    style="
                float: right;
            "><img
                        src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
                <iconify-icon icon="ep:warning" width="70" height="70" class="my-5"
                    style="color: #FF6355;"></iconify-icon>
                <p class="fw-bolder fs-1 lh-1 text-center" style="color: #4B5675;">Are You Sure You Want to Delete this
                    Advertisement?
                </p>
                <p class="text-center" style="color: #4B5675;">Deleting the advertisement for <span
                        class="fw-bold">{{ $jobOpening->job_title ?? '-' }}</span> will not remove any hired employees. Their
                    count will be assigned to the remaining vacancies. However:</p>
                <ul class="text-left">
                    <li>This job posting will be immediately removed from public view.</li>
                    <li>All associated records, details, and data will be permanently deleted.</li>
                    <li>Reports for this advertisement will no longer be available.</li>
                </ul>
                <p class="fw-bolder text-center m-0">Once deleted, this action cannot be undone.</p>
            </div>
            <div class="modal-footer modal-footer d-block border-0 ">
                <div class="filter-content d-flex justify-content-between gap-2 btn-custom">
                    <button class="btn btn-outline" data-bs-dismiss="modal">cancel</button>
                    <button id="setDeleteAdvertisement" class="btn btn-apply" style="background: #F24130;">
                        Permanently Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ExtendExpiryDate" tabindex="-1" aria-labelledby="ExtendExpiryDateLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <div class="modal-body pt-0">
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"
                    style="
                float: right;
            "><img
                        src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
                <p class="fw-medium fs-4 text-center mt-11" style="color: #4B5675;">Extend Expiry Date
                    <br /> for <span class="fw-bold">{{ $jobOpening->job_title ?? '-' }}</span><br /> Advertisement:
                </p>
                <p class="m-0 text-center" style="color: #4B5675;">Adjust expiry Dates for accepting applications for
                    the <span class="fw-bold">{{ $jobOpening->job_title ?? '-' }}</span> position</p>
                <div class="mt-4">
                    <div class="d-flex align-items-center">
                        <div class="input-group m-auto" style="width: fit-content;">
                            <input type="text" id="extendEndDate"
                                class="form-control date-input bg-white border-end-0" value="{{ $jobOpening->application_period_end_date ?? ''}}" placeholder="End Date">
                            <span class="input-group-text bg-white"><iconify-icon icon="uil:calender" width="16"
                                    height="16"></iconify-icon></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-between gap-2">
                    <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                    <button id="setExtendExpiryDate" class="btn btn-apply">
                        Set Expiry Date
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="LaunchAdvertisement" tabindex="-1" aria-labelledby="LaunchAdvertisementLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <div class="modal-body py-0  pt-5 text-center">
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"
                    style="
                float: right;
            "><img
                        src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
                <iconify-icon icon="ep:warning" width="70" height="70" class="my-5 text-center"
                    style="color: #F8BB86;"></iconify-icon>
                <p class="fw-bolder fs-1 lh-1 text-center" style="color: #4B5675;">Are You Sure You Want to Launch
                    this
                    Advertisement Now?
                </p>
                <p class="m-0 text-center" style="color: #4B5675;">This will immediately publish the advertisement of
                    <span class="fw-bold">{{ $jobOpening->job_title }}</span> and make it visible to candidates
                </p>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-between gap-2">
                    <button class="btn btn-outline" data-bs-dismiss="modal">No, keep it</button>
                    <button id="setLaunchAdvertisement" class="btn btn-apply">
                        Yes, launch now
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="DeleteDraftModal" tabindex="-1" aria-labelledby="DeleteDraftModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <div class="modal-body py-0  pt-5 text-center">
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"
                    style="
                float: right;
            "><img
                        src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
                <iconify-icon icon="ep:warning" width="70" height="70" class="my-5"
                    style="color: #FF6355;"></iconify-icon>
                <p class="fw-bolder fs-1 lh-1 text-center" style="color: #4B5675;">Are You Sure You Want to Delete
                    this Draft?
                </p>
                <p class="text-center" style="color: #4B5675;">You are about to delete the draft advertisement for the
                    <span class="fw-bold">{{ $jobOpening->job_title ?? '-' }}</span> position. This action is irreversible, and
                    all records will be permanently removed from the system.
                </p>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-between gap-2">
                    <button class="btn btn-outline" data-bs-dismiss="modal">cancel</button>
                    <button class="btn btn-apply" style="background: #F24130;">
                        Delete Draft
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ReuseJobAdvertisement" tabindex="-1" aria-labelledby="ReuseJobAdvertisementLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <div class="modal-header py-6">
                <h1 class="modal-title" id="ReuseJobAdvertisementLabel">Reuse Job Advertisement</h1>
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"><img
                        src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
            </div>
            <div class="modal-body pb-0 pt-3">
                <p class="m-0">This advertisement can be reused for the following vacancy:</p>
                <div class="mt-4 px-5 py-3 rounded" style="background-color: #F1F1F4;">
                    <p>Job Position: Software Engineer</p>
                    <p>Total Vacancies: 5</p>
                    <p class="m-0">Vacancy Created: 15 Feb 2025</p>
                </div>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-between gap-2">
                    <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-apply">
                        Review Details
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-reject" tabindex="-1" aria-labelledby="modal-reject-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Reject Applicants</h1>
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"><img
                        src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
            </div>
            <div class="modal-body text-center pt-4">
                <iconify-icon icon="ep:warning" width="70" height="70"
                    style="color: #FFC1BB;"></iconify-icon>
                    <h4 class="my-5" id="rejectModalMessage">Are you sure you want to reject <br><span id="rejectCount">0</span> Applicants?</h4>
                
                <p class="mb-5">This action is final and cannot be reverted.</p>
                <button class="btn btn-outline" data-bs-dismiss="modal">cancel</button>
                <button id="confirmReject" class="btn btn-apply text-white" style="background: #F24130;">
                    Confirm Rejection
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-send-assessment" tabindex="-1" aria-labelledby="modal-send-assessment-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Send Assessment Link</h1>
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"><img
                        src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
            </div>
            <div class="modal-body text-center pt-4">
                <iconify-icon icon="ep:warning" width="70" height="70"
                    style="color: #FFC1BB;"></iconify-icon>
                    <h4 class="my-5" id="rejectModalMessage">Are you sure you want to send assessment <br><span id="sendCount">0</span> Applicants?</h4>
                
                <p class="mb-5">This action is final and cannot be reverted.</p>
                <button class="btn btn-outline" data-bs-dismiss="modal">cancel</button>
                <button id="confirmSend" class="btn btn-apply text-white" style="background: #F24130;">
                    Confirm Send
                </button>
            </div>
        </div>
    </div>
</div>