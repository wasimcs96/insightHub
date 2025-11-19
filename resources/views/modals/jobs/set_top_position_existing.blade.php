<div class="modal-body d-flex flex-column gap-3">
    <div class="modal-content-p">
        <p class="mb-4">There is already a job position, <b>{{ $job_title }}</b> set as
            the Top Position in the Org Chart.</p>
        <p class="mb-4">If you proceed, the current top position will be replaced. The following
            changes will take place automatically:</p>
        <ul>
            <li>
                <p class="m-0"><b>The existing top position</b> will become a <b>subordinate</b>
                    of this new top position.</p>
            </li>
            <li>
                <p class="m-0"><b>The superior job position</b> of the existing top position
                    will be updated.</p>
            </li>
            <li>
                <p class="m-0">Any <b>headcount(s)</b> assigned to the existing top position
                    will be updated with the <b>new top position as their superior.</b></p>
            </li>
        </ul>
        <p>Please confirm that you understand and accept the changes.</p>
        <label class="modal-custom-check custom-checkbox">
  <input type="checkbox">
  <span class="checkmark"></span>
  I understand and agree to replace the existing top position in the
                Org Chart with this job position.
</label>
        {{-- <div class="form-check filter-side-label d-flex gap-2 align-items-center mb-2 p-0">
            <input class="" type="checkbox">
            <p class="m-0"> I understand and agree to replace the existing top position in the
                Org Chart with this job position.
            </p>
            </label>
        </div> --}}
    </div>
</div>


<div class="modal-footer modal-footer d-block border-0 pt-0">
    <div class="filter-content d-flex justify-content-center gap-2">
        <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-apply text-white" style="background: #F7941C;" data-modal-submit disabled>
            Confirm & Proceed 
            {{-- <iconify-icon icon="material-symbols:info-outline-rounded" width="16" height="16"
                data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-title="Please acknowledge the impact by checking the box above to proceed.">
            </iconify-icon> --}}
        </button>
    </div>
</div>