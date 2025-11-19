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
    {{-- <iconify-icon icon="simple-line-icons:check" width="70" height="70" class="mb-2" style="color: #99E2A8;"></iconify-icon> --}}
    {{-- <iconify-icon icon="ep:warning" width="70" height="70" class="mb-2"
        style="color: #F8BB86;"></iconify-icon> --}}
    <p class="fw-bold lh-1 text-center" style="font-size: 32.5px;">
       The ad status has been changed to 'Filled’
    </p>


    <p class="bottom-text text-center">The status will be updated to 'Filled' as the intended vacancy has been filled by the number of employees hired through this advertisement. To hire additional candidates, you can edit the vacancy.</p>
    <div class="filter-content d-flex justify-content-center gap-2">
        <!-- <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button> -->
        <button type="submit" class="btn btn-apply text-white" style="background: #F7941C;" data-modal-submit>
            Ok, got it
        </button>
    </div>
</div>