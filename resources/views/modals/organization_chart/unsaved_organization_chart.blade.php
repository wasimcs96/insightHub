<style>
    .modal-body p {
color: #071437;
    font-size: 14px;
    font-weight: 400;
    line-height: 22px;
margin-bottom: 24px;
    }
</style>
<div class="modal-body text-center">
    <iconify-icon icon="ep:warning" width="70" height="70" class="mb-2"
        style="color: #F8BB86;"></iconify-icon>
    <p class="fw-bold fs-1 lh-1 text-center">
       Unsaved Changes Detected
    </p>
    <p class="text-center">
     You have unsaved changes. Refreshing the page now will discard all updates.
    </p>
    <p>
        Please click <b>“Save Changes”</b> to preserve your edits
    </p>
    <div class="filter-content d-flex justify-content-center gap-2">
        <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-apply text-white" style="background: #F7941C;" data-modal-submit>
            Confirm
        </button>
    </div>
</div>