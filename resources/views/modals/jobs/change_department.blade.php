<style>
    .modal-body p {
color: #071437;
    font-size: 14px;
    font-weight: 400;
    line-height: 22px;
margin-bottom: 24px;
    }

            .close-icon {
    position: absolute;
    right: 16px;
    top: 16px;
    color: #99A1B7;
    cursor: pointer;
}
</style>
<div class="modal-body text-center">
    <iconify-icon icon="ic:round-close" width="24" height="24" class="close-icon" data-bs-dismiss="modal"></iconify-icon>
    <iconify-icon icon="ep:warning" width="70" height="70" class="mb-2"
        style="color: #F8BB86;"></iconify-icon>
    <p class="fw-bolder fs-1 text-center w-75 m-auto" style="color: #071437;margin-bottom: 13px !important; line-height: normal;">
        Change Department?
    </p>
    <p class="text-center" style="color: #071437; margin-bottom: 13px;">
        This job position, <b>{{ $job_title }}</b> from <b>{{ $old_value }}</b> will move to a new department, <b>{{ $new_value }}</b>.
    </p>
<p class="text-center" style="color: #071437; margin-bottom: 13px;">
        Existing reporting relationships will remain intact but may now span across departments when changing departments.
    </p>
    <div class="filter-content d-flex justify-content-center gap-2">
        <button class="btn btn-outline fs-7" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-apply text-white fs-7" style="background: #F7941C;" data-modal-submit>
            Confirm
        </button>
    </div>
</div>