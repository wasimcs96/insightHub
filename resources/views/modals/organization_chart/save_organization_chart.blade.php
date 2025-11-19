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
    <p class="fw-bold fs-1 lh-1 text-center">
       Save Changes?
    </p>
    <p class="text-center">
     Saving changes to the org chart may affect the employee list and job descriptions created. Do you want to proceed?
    </p>
    <div class="filter-content d-flex justify-content-center gap-2">
        <button class="btn btn-outline" data-bs-dismiss="modal">Discard</button>
        <button type="submit" class="btn btn-apply text-white" style="background: #F7941C;" data-modal-submit>
            Confirm
        </button>
    </div>
</div>