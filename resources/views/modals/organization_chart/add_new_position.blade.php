@php
 
 $children = App\Helpers\HelperFunctions::getChildrenWithJD($jobId)
 
@endphp

<div class="modal-body d-flex flex-column gap-4 p-4">
    <div class="modal-content-p">
        <p class="mb-2">Superior Information:</p>
        <p class="mb-2"><b>Headcount ID: {{ $name }} ({{ $code }})</b></p>
        <p class="mb-2"><b>Job Position: {{ $title }}</b></p>
        <p class="mb-2"><b>Job Position Level : Level {{ $level }}</b></p>
        <p class="m-0"><b>Department: {{ $department }}</b></p>
    </div>
    <div class="form-group">
        <label for="jobPosition">Job Position <span style="color: #F24130">*</span></label>
        <select class="form-select" id="jobPosition" required>
            <option selected disabled value="">Select a position</option>
            {{-- <option value="Project Manager|PM|001">Project Manager</option>
            <option value="Flight Dispatcher (Level 3)|FD|003">Flight Dispatcher (Level 3)</option>
            <option value="Operations Lead|OL|005">Operations Lead</option> --}}

            {{-- @foreach($children as $pos)
                <option value="{{ $pos['id'] }}">
                {{ $pos['title'] }} — {{ $pos['department'] }}
                </option>
            @endforeach --}}

            @foreach($children as $pos)
                <option 
                    value="{{ $pos->id }}" 
                    title="{{ $pos->title }} — {{ $pos->department }}">
                    {{ Str::limit($pos->title . ' — ' . $pos->department, 78) }}
                </option>
            @endforeach

        </select>

        <div id="jobPositionErrorMessage" style="color: red; font-size: 12px; display: none;"></div>
    </div>

    <div class="form-group">
        <input type="hidden" id="JobPositionHeadcountId" value="{{ $code }}">
        <input type="hidden" id="departmentId" value="{{ $department_id }}">
        <input type="hidden" id="selectedJobPositionTitle" value="Title">
        <input type="hidden" id="selectedJobPositionDepartment" value="Department">
        <input type="hidden" id="selectedJobPositionDepartmentId" value="0">
        <input type="hidden" id="selectedJobPositionLevel" value="1">
        <input type="hidden" id="job_id" value="{{ $jobId }}">
    </div>    

    <div class="form-group">
        <label>Headcount ID</label>
        <input type="text" id="headcountIdDisplay" readonly class="form-control"
            placeholder="No Job Position Selected Yet">
    </div>
    <div class="form-group">
        <label>Reason for Addition</label>
        <input type="text" id="reasonForAddingPosition" class="form-control"
            placeholder="Reason for Addition">
    </div>
<div class="modal-footer justify-content-center border-0 pt-0">
    <button type="button" class="cancel-button" data-bs-dismiss="modal">Cancel</button>
    <button type="button" class="orange-fill" data-modal-submit>Add Position</button>
</div>