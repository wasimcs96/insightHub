
<div class="modal-body text-center pt-7">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float: right;"></button>
    <iconify-icon icon="ep:warning" width="70" height="70" class="mb-2"
        style="color: #F8BB86;" class="mb-5"></iconify-icon>
    <h4 class="fw-bold lh-1 text-center m-0" style="font-size: 33.5px;">Confirm Restore</h4>

    <p class="fw-bold fs-1 lh-1 text-center">
        {{ $job_title ?? '' }}
    </p>
    <p class="text-center mb-7">
        Are you sure you want to restore this removed skill?
    </p>
  
  
    <div class="filter-content d-flex justify-content-center gap-2">
        <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-apply text-white" style="background: #F7941C;" data-modal-submit>
            Restore
        </button>
    </div>
</div>