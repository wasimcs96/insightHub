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
    <iconify-icon icon="simple-line-icons:check" width="70" height="70" class="mb-2" style="color: #99E2A8;"></iconify-icon>
    <p class="fw-bold lh-1 text-center" style="font-size: 32.5px;">
       Employee Account Successfully Converted
    </p>
    <p class="bottom-text text-center">
        The new employee account has been successfully registered, and a company email has been auto-assigned. 
    </p>

    <p class="bottom-text text-center">All relevant credentials and access rights have been updated accordingly. An email will be sent to the new employee, prompting them to change their password if desired. The current password is set to default.</p>
    <div class="filter-content d-flex justify-content-center gap-2">
        <!-- <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button> -->
        <button type="submit" class="btn btn-apply text-white" style="background: #F7941C;" data-modal-submit>
            Ok, got it
        </button>
    </div>
</div>