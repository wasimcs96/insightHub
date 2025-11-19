{{-- <div class="modal-body p-4 d-flex gap-4">
    <div class="d-flex flex-column align-items-start w-25">
        <div class="d-flex align-items-center step" id="tab-newSuperior" dataValue="0" >
            <div class="circle me-3" id="circle-b-0"></div>
            <p class="mb-0 step-text" id="text-b-0">Select New Superior<br>Headcount</p>
        </div>
        <div class="line"></div>
        <div class="d-flex align-items-center step" id="tab-reassignmentConfirmation" dataValue="1" >
            <div class="circle me-3" id="circle-b-1"></div>
            <p class="mb-0 step-text" id="text-b-1">Confirm<br>Reassignment</p>
        </div>
    </div>
    <div class="d-flex flex-column gap-4">
        <div class="modal-content-p">
            <h5 class="mb-3">Reassign Subordinates</h5>
            <p class="mb-2">This job position, <b>{{ $title }}</b>, has the following
                immediate subordinates. Please select a new superior headcount ID (another
                headcount under the same job position) for reassignment.</p>
            <p class="m-0">By default, subordinates will not be reassigned. If you wish to
                reassign a subordinate, select a new superior headcount ID from the dropdown.
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
                <tbody>
                    <tr>
                        <td>Crew Controller</td>
                        <td>CC-001-01</td>
                        <td>Casey Jordan</td>
                        <td>
                            <select class="form-select select-headcount"
                                style="color: #99A1B7; height: 36px;">
                                <option selected disabled>Select New Superior Headcount ID
                                </option>
                                <option value="HC-101">HC-101</option>
                                <option value="HC-102">HC-102</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control reason-input"
                                placeholder="Reason for Reassignment" >
                        </td>
                    </tr>
                    <tr>
                        <td>Crew Controller</td>
                        <td>CC-001-02</td>
                        <td>Tina Liew</td>
                        <td>
                            <select class="form-select select-headcount"
                                style="color: #99A1B7; height: 36px;">
                                <option selected disabled>Select New Superior Headcount ID
                                </option>
                                <option value="HC-103">HC-103</option>
                                <option value="HC-104">HC-104</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control reason-input"
                                placeholder="Reason for Reassignment" >
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal-footer justify-content-between" style="justify-content: end!important;">
    {{-- <button type="button" class="orange-fill">Confirm Reassignment</button> --}}
    {{-- <button type="button" class="cancel-button" data-bs-dismiss="modal">Previous: Reassign
        Subordinates</button> --}}
    {{-- <div class="d-flex align-items-center gap-2">

        <button type="button" class="cancel-button" data-bs-dismiss="modal"
            style="border-color: #F7941C; color: #F7941C;">Cancel</button>
        <button type="button" class="orange-fill">Continue : Proceed to Reassignment</button>
        {{-- <button type="button" class="orange-fill">Confirm Reassignment</button> --}}
    {{-- </div>
</div> --}} 


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
            <p class="mb-0 step-text" id="text-b-1">Confirm<br>Reassignment</p>
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
        Continue: Proceed to Reassignment
    </button>

    {{-- Confirm Button (hidden initially) --}}
    <button type="button" class="btn orange-fill btn-confirm" style="display: none;" data-modal-submit>
        Confirm Reassignment
    </button>
</div>
