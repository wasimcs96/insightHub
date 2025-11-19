
<div class="modal-body d-flex flex-column gap-3 p-4">
    <div class="modal-content-p">
        <p class="mb-2">You are about to set a job position as the <b>Top Position</b> in the Org Chart.</p>

        <p class="mb-2">This action will define the highest-level role in your organization. The following changes will be applied:</p>
        <ul>
            <li>
                <p class="m-0"><b>This job position</b> will be designated as the <b>root</b> of the Org Chart.</p>
            </li>
            <li>
                <p class="m-0">Other job positions can now be linked as subordinates to this top position.</p>
            </li>
            <li>
                <p class="m-0"><b>Only one headcount</b> is allowed for a job position set as the top of the Org Chart.</p>
            </li>
        </ul>

        <p>Please confirm that you understand and acknowledge the implications of setting this as the top position.</p>

        <div class="form-check filter-side-label d-flex gap-2 align-items-center mb-2">
            <input class="form-check" type="checkbox" id="acknowledge-top-position" required>
            <label class="form-check-label m-0" for="acknowledge-top-position">
                I understand and agree to set this job position as the top position in the Org Chart.
            </label>
        </div>
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