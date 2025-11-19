<div class="modal-header">
    <h2 class="modal-title">Delete JD - {{ $job_title ?? ''}}</h2>
    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body text-left">
    {{-- <iconify-icon icon="ep:warning" width="70" height="70" class="mb-2"
        style="color: #F8BB86;"></iconify-icon> --}}
    {{-- <p class="fw-bold fs-1 lh-1 text-center">
        Clear Existing Inputs?
    </p> --}}
    <p class="text-left">
       This job description cannot be deleted because it is either assigned to <b>employees</b> or set as a <b>superior to other job positions.</b>
    </p>
    <p class="text-left">To proceed, please <b>remove or reassign the employees</b> or <b>reassign the subordinate job positions</b>.</p>

    <p class="text-left">For assistance, please contact your administrator.</p>
    <div class="filter-content d-flex justify-content-center gap-2">
        {{-- <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button> --}}
        <button data-bs-dismiss="modal" class="btn btn-apply text-white" style="background: #F7941C;">
            Close
        </button>
    </div>
</div>
