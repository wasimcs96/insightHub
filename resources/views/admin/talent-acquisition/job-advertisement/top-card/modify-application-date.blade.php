<div class="modal fade" id="ModifyApplicationDate" tabindex="-1" aria-labelledby="ModifyApplicationDateLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <div class="modal-body py-0 pt-5">
                <button type="button" class="p-0  border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"
                    style="
                float: right;
            "><img
                        src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
                <p class="fw-medium fs-4 text-center mt-11" style="color: #4B5675;">Modify the Application Period Dates
                    <br /> for <span class="fw-bold">{{ $jobOpening->job_title ?? '-' }}</span><br /> Advertisement:
                </p>
                <p class="m-0 text-center" style="color: #4B5675;">Adjust the start and Expiry Dates for accepting
                    applications for the <span class="fw-bold">{{ $jobOpening->job_title ?? '-' }}</span> position</p>
                <div class="mt-4">
                    <div class="d-flex align-items-center gap-1">
                        <div class="input-group">
                            <input type="text" id="startDateM" class="form-control date-input bg-white border-end-0"
                                placeholder="Start Date" value="{{ $jobOpening->application_period_start_date ?? '' }}">
                            <span class="input-group-text bg-white"><iconify-icon icon="uil:calender" width="16"
                                    height="16"></iconify-icon></span>

                        </div>
                        <span> - </span>
                        <div class="input-group">
                            <input type="text" id="endDate" class="form-control date-input bg-white border-end-0"
                                placeholder="End Date" value="{{ $jobOpening->application_period_end_date ?? '' }}">
                            <span class="input-group-text bg-white"><iconify-icon icon="uil:calender" width="16"
                                    height="16"></iconify-icon></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-between gap-2 btn-custom">
                    <button id="hideApplicationSetModal" class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-apply" id="setApplicationDate">
                        Set Application Period
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>