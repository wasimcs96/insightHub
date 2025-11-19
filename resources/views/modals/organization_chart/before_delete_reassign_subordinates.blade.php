<div class="modal-header">
    <h1 class="modal-title fs-5" id="deletePositionNameLabel">Delete Position - {{ $title }}</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body p-4 d-flex gap-4">
    {{-- Left Navigation Steps --}}
    <div class="d-flex flex-column align-items-start w-25">
        <div class="d-flex align-items-center step" id="tab-newSuperior" dataValue="0">
            <div class="circle me-3" id="circle-b-0"></div>
            <p class="mb-0 step-text" id="text-b-0">Select New Superior<br>Headcount</p>
        </div>
        <div class="line"></div>
        <div class="d-flex align-items-center step" id="tab-reassignmentConfirmation" dataValue="1">
            <div class="circle me-3" id="circle-b-1"></div>
            <p class="mb-0 step-text" id="text-b-1">Confirm & <br>Delete Position</p>
        </div>
    </div>

    {{-- Right Content Area --}}
    <div class="d-flex flex-column gap-4 w-100">

        {{-- STEP 0: Select Superior Headcount --}}
        <div class="step-0-section">
            <div class="modal-content-p">
                <h5 class="mb-3">Reassign Subordinates</h5>
                <p class="mb-2">This job position, <b>{{ $title }}</b>, has the following immediate subordinates.
                    Please select a new superior headcount ID (another headcount under the same job position) for reassignment.</p>
                <p>By default, subordinates will not be reassigned. If you wish to reassign a subordinate,
                    select a new superior headcount ID from the dropdown.</p>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Job Position</th>
                            <th>Headcount ID</th>
                            <th>Employee Name</th>
                            <th>New Superior Headcount ID</th>
                            <th>Reason for Reassignment</th>
                        </tr>
                    </thead>
                    <tbody class="step-0-table-body">
                        {{-- Dynamically injected via JS --}}
                    </tbody>
                </table>
            </div>
        </div>

        {{-- STEP 1: Confirm Reassignment --}}
        <div class="step-1-section" style="display: none">
            <div class="modal-content-p">
                <h5 class="mb-3">Confirm Reassignment</h5>
                <p class="mb-2">
                    Are you sure you want to reassign the selected subordinates to the new superior headcount(s)?
                    This action will update their reporting line under the <b>{{ $title }}</b> job position.
                </p>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Job Position</th>
                            <th>Headcount ID</th>
                            <th>Employee Name</th>
                            <th>New Superior Headcount ID</th>
                            <th>Reason for Reassignment</th>
                        </tr>
                    </thead>
                    <tbody class="step-1-table-body">
                        {{-- Populated from JS on Continue --}}
                    </tbody>
                </table>
            </div>
            <div class="form-group" id="reasonBox-a">
                <label>Reason for Reassignment</label>
                <input type="text" class="form-control" id="reasonForRessignmentAndDelete" placeholder="Reason for Reassignment">
            </div>
        </div>
    </div>
</div>

{{-- Footer Buttons --}}
<div class="modal-footer justify-content-end border-0 pt-0">
    <button type="button" class="btn cancel-button" data-bs-dismiss="modal" style="border-color: #F7941C; color: #F7941C;">
        Cancel
    </button>

    {{-- Previous Button (hidden initially) --}}
    <button type="button" class="btn btn-outline-secondary btn-previous" style="display: none;">
        Previous: Select New Superior Headcount
    </button>

    {{-- Continue Button --}}
    <button type="button" class="btn orange-fill btn-continue">
        Continue: Proceed to Deletion
    </button>

    {{-- Confirm Button (hidden initially) --}}
    <button type="button" class="btn orange-fill btn-confirm" style="display: none;" data-modal-submit>
        Confirm & Delete
    </button>
</div>
