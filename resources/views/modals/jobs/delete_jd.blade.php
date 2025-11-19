
<div class="modal-body text-center">
    <iconify-icon icon="ep:warning" width="70" height="70" class="mb-2"
        style="color: #F8BB86;"></iconify-icon>
    <p class="fw-bold fs-1 lh-1 text-center">
        Delete this JD?
    </p>

    <p class="fw-bold fs-1 lh-1 text-center">
        {{ $job_title ?? '' }}
    </p>
    <p class="text-center">
        This action cannot be undone, and the job will be 
permanently removed.
    </p>
  
  
    <div class="filter-content d-flex justify-content-center gap-2">
        <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-apply text-white" style="background: #F7941C;" data-modal-submit>
            Confirm
        </button>
    </div>
</div>