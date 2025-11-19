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
       Update Superior Headcount ID?
    </p>
    <p class="text-center" style="color: #071437; margin-bottom: 13px;">
       You are about to update the Superior Headcount ID(s) for this job position, <b>{{ $job_title }}</b>.
    </p>
    <p class="text-center" style="color: #071437; margin-bottom: 13px;">
       This will change the reporting structure for the affected employee(s). Please review the changes carefully before proceeding. 
    </p>
<p class="text-center" style="color: #071437; margin-bottom: 13px;">
        Upon confirming, your <b>changes will be saved,</b> and you’ll be redirected to <b>Org Chart View Mode</b> to view the updated structure.
    </p>
    <div class="filter-content d-flex justify-content-center gap-2">
        <button class="btn btn-outline fs-7" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-apply text-white fs-7" style="background: #F7941C;" data-modal-submit>
            Confirm
        </button>
    </div>
</div>