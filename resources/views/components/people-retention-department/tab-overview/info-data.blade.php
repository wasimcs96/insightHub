<div class="top-data">
    <div class="workforce-data">
        <div class="head-total">
            <div class="title">Head Counts: {{ $totalHeads ?? 0}}</div>
        </div>
        <div class="employee-total">
            <div class="title2">Employees: {{ $totalEmployee ?? 0}}</div>
        </div>
        <div class="vacancy-total">
            <div class="title2">Job Vacancy: {{ $jobVacancy ?? 0}}</div>
        </div>
    </div>
    {{-- <div class="button-frame">
        <div class="button">
            <button type="button" class="btn btn-outline-warning"><i class="bi bi-pencil"></i>Edit</button>
        </div>
        <div class="button2">
            <button type="button" class="btn btn-outline-danger"><i class="bi bi-trash3"></i>Delete</button>
        </div>
    </div> --}}
</div>
<div class="d-flex gap-4">
<div class="frame-title">{{ $departmentName ?? "No Data" }}</div>
<div class="user-status-data">
    {{-- <select id="status-dropdown" class="user-status">
        <option value="Active" {{ $departmentSectionStatus == 'Active' ? 'selected' : '' }}>Active</option>
        <option value="Inactive" {{ $departmentSectionStatus == 'Inactive' ? 'selected' : '' }}>Inactive</option>
    </select> --}}
    {{-- <div class="user-dept">
        <i class="bi bi-folder"></i>
        <p>{{ $departmentSectionNames ?? "Not Available" }}</p>
    </div>
    <div class="user-location">
        <i class="bi bi-geo-alt"></i>
        <p>{{ $location ?? "Not Available" }}</p>
    </div> --}}
</div>
</div>
{{-- <div class="user-position">Head Of Department: {{ $headOfDepartment ?? "No Data" }}</div> --}}
<div class="position-overview">
    <div class="highest-job-data">
        <div class="highest-job-position-level">Highest Position Level:</div>
        <div class="total-highest-job-data">
            <div class="total-value-highest-job-data">{{ config('helpers.levels.' . $highestPositionLevel) ?? 0 }}</div>
        </div>
    </div>
    <div class="number-job-position-data">
        <div class="number-job-position">Total Number of Job Position:</div>
        <div class="total-number-job-position">
            <div class="total-value-number-job-position">{{ $totalNumberJobPosition ?? 0 }}</div>
        </div>
    </div>
</div>