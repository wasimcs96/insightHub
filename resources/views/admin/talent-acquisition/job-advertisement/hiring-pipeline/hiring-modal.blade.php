<div class="modal fade" id="modal-reject-applicant-single" tabindex="-1" aria-labelledby="modal-reject-applicant-single-label"
    aria-hidden="true">
    <input type="hidden" name="modal-reject-applicant-single-value">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Reject Applicants</h1>
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"><img
                        src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
            </div>
            <div class="modal-body text-center pt-4">
                <iconify-icon icon="ep:warning" width="70" height="70" style="color: #FFC1BB;"></iconify-icon>
                <h4 class="my-5">Are you sure you want to reject<br>Adelin Rohayu Binti Zaharudin?</h4>
                <p class="my-5">This action is final and cannot be reverted.</p>
                <button class="btn btn-outline" data-bs-dismiss="modal">cancel</button>
                <button class="btn btn-apply text-white" style="background: #F24130;">
                    Confirm Rejection
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="schedule-interview" tabindex="-1" aria-labelledby="schedule-interview-label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-2 fw-medium" id="interview-title" style="width: 80%">
                    Schedule Interview for <span id="interviewee-name">Adelin Rohayu Binti Zaharudin</span>
                </h1>
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"><img
                        src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
            </div>
            <div class="modal-body pt-4">
                
                {{-- <div class="btn-custom"> --}}
                    <form id="schedule-form" method="POST" action="">
                        @csrf

                        <input type="hidden" name="application_id" id="application_id">
                    
                        <input type="hidden" name="form_type" value="schedule_interview">

                        <div class="mb-4">
                            <label for="date" class="custom-label mb-1 fw-medium">Date</label>
                            <div class="input-group">
                                <input type="date" name="interview_datetime" class="form-control date-input bg-white border-end-0" required>
                                <!-- <span class="input-group-text bg-white">
                                    <iconify-icon icon="uil:calender" width="16" height="16"></iconify-icon>
                                </span> -->
                            </div>
                        </div>
                    
                        <!-- Start & End Time -->
                        <div class="row mb-4">
                            <div class="col">
                                <label class="custom-label mb-1 fw-medium">Start Time</label>
                                <div class="input-group gap-3">
                                    <input type="number" name="start_hour" class="form-control" min="1" max="12" placeholder="HH" required>
                                    <span class="input-group-text border-0 p-0">:</span>
                                    <input type="number" name="start_minute" class="form-control" min="0" max="59" placeholder="MM" required>
                                    <select name="start_ampm" class="form-select" required>
                                        <option>AM</option>
                                        <option>PM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label class="custom-label mb-1 fw-medium">End Time</label>
                                <div class="input-group gap-3">
                                    <input type="number" name="end_hour" class="form-control" min="1" max="12" placeholder="HH" required>
                                    <span class="input-group-text border-0 p-0">:</span>
                                    <input type="number" name="end_minute" class="form-control" min="0" max="59" placeholder="MM" required>
                                    <select name="end_ampm" class="form-select" required>
                                        <option>AM</option>
                                        <option>PM</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    
                        <div class="mb-4">
                            <label for="interviewer_name" class="custom-label mb-1 fw-medium">Name of the Interviewer(s)</label>
                            <input type="text" name="interviewer_name" class="form-control" placeholder="Enter Name of the Interviewer(s)" required>
                        </div>
                    
                        <div class="mb-4">
                            <label class="custom-label mb-1 fw-medium">Interview Type</label>
                            <div class="d-flex gap-2 align-items-center mt-1">
                                <input class="h-auto" type="radio" name="interview_mode" value="1" required>
                                <label class="form-label m-0">In-Person</label>
                            </div>
                            <div class="d-flex gap-2 align-items-center mt-1">
                                <input class="h-auto" type="radio" name="interview_mode" value="2">
                                <label class="form-label m-0">Virtual Interview</label>
                            </div>
                            <div class="d-flex gap-2 align-items-center mt-1">
                                <input class="h-auto" type="radio" name="interview_mode" value="3">
                                <label class="form-label m-0">Phone Interview</label>
                            </div>
                        </div>
                    
                        <div class="mb-4" id="interviewerLinkSchedule" style="display: none;">
                            <label class="custom-label mb-1 fw-medium">Interviewer Link</label>
                            <input type="text" name="interview_link" class="form-control" placeholder="https://meet.google.com/abc-defg-hij" required>
                        </div>
                    
                        <div class="btn-custom">
                            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                Schedule Interview
                            </button>
                        </div>
                    </form>
                    
                    {{-- <button class="btn btn-outline" data-bs-dismiss="modal">cancel</button>
                    <button class="btn ">
                        Schedule Interview
                    </button> --}}
                {{-- </div> --}}
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="reschedule-interview" tabindex="-1" aria-labelledby="reschedule-interview-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-2 fw-medium" style="width: 80%">
                    Reschedule Interview for <span id="reschedule-candidate-name">Adelin Rohayu Binti Zaharudin</span>
                </h1>
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel">
                </button>
            </div>
            <div class="modal-body pt-4">
                <form id="reschedule-form" action="" method="POST">
                    @csrf
                    <input type="hidden" name="application_id" id="re_application_id">
                    <input type="hidden" name="form_type" value="reschedule_interview">
                    <div class="mb-4">
                        <label for="rescheduleDate" class="custom-label mb-1 fw-medium">Date</label>
                        <div class="input-group">
                            <input type="date" name="interview_datetime" id="rescheduleDate" class="form-control date-input bg-white border-end-0" required>
                            <span class="input-group-text bg-white">
                                <iconify-icon icon="uil:calender" width="16" height="16"></iconify-icon>
                            </span>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <label class="custom-label mb-1 fw-medium">Start Time</label>
                            <div class="input-group gap-3">
                                <input type="number"  name="start_hour" id="startHour" class="form-control" min="1" max="12" placeholder="HH" required>
                                <span class="input-group-text border-0 p-0">:</span>
                                <input type="number" name="start_minute" id="startMinute" class="form-control" min="0" max="59" placeholder="MM" required>
                                <select class="form-select" name="start_ampm" id="startAmPm" required>
                                    <option>AM</option>
                                    <option>PM</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <label class="custom-label mb-1 fw-medium">End Time</label>
                            <div class="input-group gap-3">
                                <input type="number" name="end_hour" id="endHour" class="form-control" min="1" max="12" placeholder="HH" required>
                                <span class="input-group-text border-0 p-0">:</span>
                                <input type="number" name="end_minute" id="endMinute" class="form-control" min="0" max="59" placeholder="MM" required>
                                <select class="form-select" name="end_ampm" id="endAmPm" required>
                                    <option>AM</option>
                                    <option>PM</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="interviewer" class="custom-label mb-1 fw-medium">Name of the Interviewer(s)</label>
                        <div class="form-control" style="padding: 12px; height: fit-content;">
                            <div class="tag-container" id="tagContainer">
                                <!-- Interviewer tags will be dynamically populated here -->
                                <input type="text" name="interviewer_name" class="tag-input border-0" id="tagInput" placeholder="Enter Interviewer Name">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="custom-label mb-1 fw-medium">Interview Type</label>
                        <div class="d-flex gap-2 align-items-center mt-1">
                            <input class="h-auto" type="radio"  name="interview_mode" value="1" id="inPerson">
                            <label class="form-label m-0" for="inPerson">In-Person</label>
                        </div>
                        <div class="d-flex gap-2 align-items-center mt-1">
                            <input class="h-auto" type="radio" name="interview_mode" value="2" id="virtual" >
                            <label class="form-label m-0" for="virtual">Virtual Interview</label>
                        </div>
                        <div class="d-flex gap-2 align-items-center mt-1">
                            <input class="h-auto" type="radio" name="interview_mode" value="3" id="phone" >
                            <label class="form-label m-0" for="phone">Phone Interview</label>
                        </div>
                    </div>

                    <div class="mb-4" id="interviewerLinkReschedule" style="display: none;">
                        <label class="custom-label mb-1 fw-medium">Interviewer Link</label>
                        <input type="text" class="form-control" name="interview_link" id="rescheduleInterviewLink" placeholder="https://meet.google.com/abc-defg-hij">
                    </div>

                    <div class="btn-custom">
                        <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-orange" id="submit-reschedule-btn">
                            Reschedule Interview
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="issue-contract" tabindex="-1" aria-labelledby="issue-contract-label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-2 fw-medium" style="width: 80%">Select
                    Contract Template</h1>
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"><img
                        src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
            </div>
            <div class="modal-body pt-4">
                <form>
                    <div class="mb-4">
                        <label for="date" class="custom-label mb-1 fw-medium">Contract Template</label>
                        <div class="input-group contract">
                            <select class="form-select" id="contractSelect">
                                <option value="" disabled selected hidden>Select Contract Template</option>
                                <option value="advance_crewing">Advance Crewing Supervisor Contract</option>
                            </select>

                        </div>
                    </div>
                </form>
                <div class="btn-custom">
                    <button class="btn btn-outline" data-bs-dismiss="modal">cancel</button>
                    <button id="scheduleButton" class="btn disabled" data-bs-toggle="modal"
                        data-bs-target="#contract-preview">
                        Schedule Interview
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="contract-preview" tabindex="-1" aria-labelledby="contract-preview-label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-2 fw-medium" style="width: 80%">Employee Contract Preview: Adelin Rohayu
                    Binti Zaharudin</h1>
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"><img
                        src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
            </div>
            <div class="modal-body" style="background: #F1F1F4;">
                <p>document</p>
            </div>
            <div class="modal-footer btn-custom-contract">
                <button class="btn btn-outline" data-bs-dismiss="modal">Back</button>
                <button class="btn btn-apply">
                    Send Employee Contract
                </button>
            </div>
        </div>
    </div>
</div>


{{-- <div class="modal fade" id="selection-matrix" tabindex="-1" aria-labelledby="selection-matrix-label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-div">
            <div class="modal-body pt-5">
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"
                    style="float: right;"><img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}"
                        alt="cancel"></button>
                <p class="fw-bolder fs-1 lh-1" style="color: #4B5675;">Selection Matrix
                </p>
                <p class="mb-5" style="color: #4B5675;">The grid evaluates candidates based on their interview
                    performance and overall match rate observed during the screening process. <br><br> Candidates in the
                    top-right quadrant are ideal hires, showcasing an excellent current fit and future potential. Those
                    in other quadrants provide varying insights, from promising but underdeveloped potential to
                    misalignment with the company’s needs.
                    <br><br>
                    Select the matrices you want to filters from the 9-grid matrix; multiple selections are allowed for
                    a more comprehensive result
                </p>

                <div class="d-grid color-grid-modal m-auto mb-8">
                    <div class="left-side">
                        <p class="fw-bolder fs-4 m-0" style="color: #4B5675;">Interview Performance</p>
                        <div class="d-grid gap-5">
                            <div class="d-flex justify-content-between">
                                <p class="m-0 fs-6 fw-bolder" style="color: #99A1B7;">Very Low</p>
                                <p class="m-0 fs-6 fw-bolder" style="color: #99A1B7;">Very High</p>
                            </div>
                            <div class="arrow-div">
                                <div class="arrow"><iconify-icon icon="line-md:chevron-right" width="24"
                                        height="24"></iconify-icon></div>
                            </div>
                        </div>
                        <div class="color-grid">
                            <div class="grid-item orange" data-id="1" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Review</b><br>Very Low Interview Performance<br>Very High OMR"></div>
                            <div class="grid-item yellow" data-id="2" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Consider Further</b><br>Low Interview Performance<br>Very High OMR">
                            </div>
                            <div class="grid-item yellow" data-id="3" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Consider Further</b><br>Moderate Interview Performance<br>Very High OMR">
                            </div>
                            <div class="grid-item green" data-id="4" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Hire</b><br>High Interview Performance<br>Very High OMR"></div>
                            <div class="grid-item green selected" data-id="5" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Hire</b><br>Very High Interview Performance<br>Very High OMR">
                                <div class="checkmark"><iconify-icon icon="mingcute:check-fill"></iconify-icon></div>
                            </div>

                            <div class="grid-item orange" data-id="6" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Review</b><br>Very Low Interview Performance<br>High OMR"></div>
                            <div class="grid-item orange" data-id="7" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Review</b><br>Low Interview Performance<br>High OMR"></div>
                            <div class="grid-item yellow" data-id="8" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Consider Further</b><br>Moderate Interview Performance<br>High OMR">
                            </div>
                            <div class="grid-item yellow" data-id="9" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Hire</b><br>High Interview Performance<br>High OMR"></div>
                            <div class="grid-item green" data-id="10" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Consider Further</b><br>Very High Interview Performance<br>High OMR">
                            </div>

                            <div class="grid-item red" data-id="11" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Reject</b><br>Very Low Interview Performance<br>Moderate OMR"></div>
                            <div class="grid-item orange" data-id="12" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Review</b><br>Low Interview Performance<br>Moderate OMR"></div>
                            <div class="grid-item orange" data-id="13" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Review</b><br>Moderate Interview Performance<br>Moderate OMR"></div>
                            <div class="grid-item yellow" data-id="14" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Consider Further</b><br>High Interview Performance<br>Moderate OMR">
                            </div>
                            <div class="grid-item yellow" data-id="15" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Consider Further</b><br>Very High Interview Performance<br>Moderate OMR">
                            </div>

                            <div class="grid-item red" data-id="16" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Reject</b><br>Very Low Interview Performance<br>Low OMR"></div>
                            <div class="grid-item red" data-id="17" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Reject</b><br>Low Interview Performance<br>Low OMR"></div>
                            <div class="grid-item orange" data-id="18" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Review</b><br>Moderate Interview Performance<br>Low OMR"></div>
                            <div class="grid-item orange" data-id="19" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Review</b><br>High Interview Performance<br>Low OMR"></div>
                            <div class="grid-item orange" data-id="20" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Consider Further</b><br>Very High Interview Performance<br>Low OMR">
                            </div>

                            <div class="grid-item red" data-id="21" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Reject</b><br>Very Low Interview Performance<br>Very Low OMR"></div>
                            <div class="grid-item red" data-id="22" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Reject</b><br>Low Interview Performance<br>Very Low OMR"></div>
                            <div class="grid-item red" data-id="23" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Reject</b><br>Moderate Interview Performance<br>Very Low OMR"></div>
                            <div class="grid-item orange" data-id="24" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Review</b><br>High Interview Performance<br>Very Low OMR"></div>
                            <div class="grid-item orange" data-id="25" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-html="true"
                                data-bs-title="<b>Review</b><br>Very High Interview Performance<br>Very Low OMR"></div>
                        </div>
                        <div class="right-side-arrow-div">
                            <p class="fw-bolder fs-4 m-0 mb-5 d-flex justify-content-end" style="color: #4B5675;">
                                0verall Match Rate</p>
                            <div class="d-grid gap-5">
                                <div class="d-flex justify-content-between">
                                    <p class="m-0 fs-6 fw-bolder" style="color: #99A1B7;">Very Low</p>
                                    <p class="m-0 fs-6 fw-bolder" style="color: #99A1B7;">Very High</p>
                                </div>
                                <div class="arrow-div">
                                    <div class="arrow" style="left: -9px;"><iconify-icon icon="line-md:chevron-left"
                                            width="24" height="24"></iconify-icon></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right-side">

                    </div>
                </div>
                <div class="btn-custom">
                    <button class="btn btn-outline" data-bs-dismiss="modal">No, go back to talent insight</button>
                    <button class="btn btn-apply">
                        Filters using the selected matrix
                    </button>
                </div>
            </div>
        </div>
    </div>
</div> --}}


@php
    $selectionMatrix = config('helpers.selection_matrix');
    $selectionMatrixLevels = config('helpers.overall_match_rate_levels');
@endphp

<div class="modal fade" id="selection-matrix" tabindex="-1" aria-labelledby="selection-matrix-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content modal-div">
            <div class="modal-body pt-5">
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close" style="float: right;">
                    <img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel">
                </button>

                <p class="fw-bolder fs-1 lh-1" style="color: #4B5675;">Selection Matrix</p>
                <p class="mb-5" style="color: #4B5675;">
                    The grid evaluates candidates based on their interview performance and overall match rate observed during the screening process. <br><br>
                    Candidates in the top-right quadrant are ideal hires, showcasing an excellent current fit and future potential. Those in other quadrants provide varying insights, from promising but underdeveloped potential to misalignment with the company’s needs.
                    <br><br>
                    Select the matrices you want to filters from the 9-grid matrix; multiple selections are allowed for a more comprehensive result
                </p>

                <div class="d-grid color-grid-modal m-auto mb-8">
                    <div class="left-side">
                        <p class="fw-bolder fs-4 m-0" style="color: #4B5675;">Interview Performance</p>
                        <div class="d-grid gap-5">
                            <div class="d-flex justify-content-between">
                                <p class="m-0 fs-6 fw-bolder" style="color: #99A1B7;">Very Low</p>
                                <p class="m-0 fs-6 fw-bolder" style="color: #99A1B7;">Very High</p>
                            </div>
                            <div class="arrow-div">
                                <div class="arrow">
                                    <iconify-icon icon="line-md:chevron-right" width="24" height="24"></iconify-icon>
                                </div>
                            </div>
                        </div>

                        {{-- Start Dynamic Grid --}}
                        {{-- {{ dd($selectionMatrixLevels,$selectionMatrix) }} --}}
                        <div class="color-grid">
                            @foreach ($selectionMatrix as $id => $data)
                                @php
                                    $level = $data['final_result_level'];
                                    $result = $data['final_result'];
                                    $interviewLabel = ucfirst($selectionMatrixLevels[$data['interview_performance']] ?? 'N/A');
                                    $omrLabel = ucfirst($selectionMatrixLevels[$data['omr']] ?? 'N/A');

                                    $colorClass = match($level) {
                                        1 => 'red',
                                        2 => 'orange',
                                        3 => 'yellow',
                                        4 => 'green',
                                        default => '',
                                    };

                                    $isSelected = $id == 5 ? 'selected' : '';

                                    $tooltip = "<b>{$result}</b><br>{$interviewLabel} Interview Performance<br>{$omrLabel} OMR";
                                @endphp

                                <div class="grid-item {{ $colorClass }} {{ $isSelected }}"
                                     data-id="{{ $id }}"
                                     data-bs-toggle="tooltip"
                                     data-bs-placement="top"
                                     data-bs-html="true"
                                     data-bs-title="{!! $tooltip !!}">
                                    @if ($isSelected)
                                        <div class="checkmark">
                                            <iconify-icon icon="mingcute:check-fill"></iconify-icon>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        {{-- End Dynamic Grid --}}

                        <div class="right-side-arrow-div">
                            <p class="fw-bolder fs-4 m-0 mb-5 d-flex justify-content-end" style="color: #4B5675;">Overall Match Rate</p>
                            <div class="d-grid gap-5">
                                <div class="d-flex justify-content-between">
                                    <p class="m-0 fs-6 fw-bolder" style="color: #99A1B7;">Very Low</p>
                                    <p class="m-0 fs-6 fw-bolder" style="color: #99A1B7;">Very High</p>
                                </div>
                                <div class="arrow-div">
                                    <div class="arrow" style="left: -9px;">
                                        <iconify-icon icon="line-md:chevron-left" width="24" height="24"></iconify-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="right-side">
                        {{-- Keep empty or use for future --}}
                    </div>
                </div>

                <div class="btn-custom">
                    <button class="btn btn-outline btn-clear-selectmatrix" data-bs-dismiss="modal">Clear All</button>
                    <button class="btn btn-apply btn-apply-selectmatrix">
                        Filters using the selected matrix
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="convert-to-employee" tabindex="-1" aria-labelledby="convert-to-employee-label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <div class="modal-body pt-5 text-center">
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"
                    style="float: right;"><img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}"
                        alt="cancel"></button>
                <form id="application_id_convert-form" method="POST" action="">
                            @csrf        
                <input type="hidden" name="application_id_convert" id="application_id_convert">

                <iconify-icon icon="mage:question-mark-circle" width="70" height="70"
                    style="color: #F8BB86;"></iconify-icon>
                <h4 class="my-5 fs-1 w-75 m-auto">Are You Sure You Want to Convert <span id="emp-name">Adelin Rohayu Binti Zaharudin</span> as
                    Employee?</h4>
                <p class="my-5 fs-5">Please confirm whether you wish to proceed with converting <span id="emp-desc-name"> Adelin Rohayu Binti
                    Zaharudin’s </span> status to an official employee. This action may have implications for employment terms,
                    responsibilities, and system access</p>
                <div class="btn-custom">
                    <button type="button" class="btn btn-outline" data-bs-dismiss="modal">No, keep as candidate</button>
                    <button type="submit" class="btn btn-apply">
                        Yes, convert to employee
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="yes-convert-to-employee" tabindex="-1" aria-labelledby="yes-convert-to-employee-label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-div">
            <div class="modal-body pt-5 text-center">
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"
                    style="float: right;"><img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}"
                        alt="cancel"></button>
                <img src="{{ asset('/admin/media/svg/shapes/right.svg') }}" alt="right">
                <h4 class="my-5 fs-1 w-75 m-auto">Employee Account Successfully Converted</h4>
                <p class="my-5 fs-5">The new employee account has been successfully registered, and a company email has
                    been auto-assigned.<br><br>All relevant credentials and access rights have been updated accordingly.
                    An email will be sent to
                    the new employee, prompting them to change their password if desired. The current password is set to
                    default.
                </p>
                <div class="btn-custom">
                    {{-- <button class="btn btn-outline" data-bs-dismiss="modal">Back to job advertisement</button> --}}
                    <button class="btn btn-apply" data-bs-dismiss="modal">
                        Ok, got it
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="employee-status-changed" tabindex="-1" aria-labelledby="employee-status-changed-label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-2 fw-medium" style="width: 80%">Status Changed</h1>
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"><img
                        src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
            </div>
            <div class="modal-body text-center">
                <h4 class="my-5 fs-1 w-75 mt-0 m-auto fw-bold" style="color: #4B5675">The ad status has been changed to 'Filled’</h4>
                <p class="my-6 fs-5" style="color: #4B5675">The status will be updated to 'Filled' as the intended vacancy has been filled by
                    the number of employees hired through this advertisement. To hire additional candidates, you can
                    edit the vacancy.
                </p>
                <div class="btn-custom">
                    <a class="btn btn-outline" href="{{ route('admin.talent-acquisition.job-advertisement.detail', ['id' => $jobOpening->id, 'page' => 'report']) }}" >View Report</a>
                    <button class="btn btn-apply" data-bs-dismiss="modal">
                        Ok, got it
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-send-assessment-single" tabindex="-1" aria-labelledby="modal-send-assessment-single-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Send Assessment Link</h1>
                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel">
                </button>
            </div>
            <div class="modal-body text-center pt-4">
                <iconify-icon icon="ep:warning" width="70" height="70" style="color: #FFC1BB;"></iconify-icon>
                <h4 class="my-5" id="singleSendMessage">
                    Are you sure you want to send an assessment to<br>
                    <span id="singleApplicantName" class="fw-bold"></span>?
                </h4>
                <p class="mb-5">This action is final and cannot be reverted.</p>
                <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                <button id="confirmSingleSend" class="btn btn-apply text-white" style="background: #F24130;">
                    Confirm Send
                </button>
            </div>
        </div>
    </div>
</div>
