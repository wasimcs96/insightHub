<style>
    .container-dept {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 20px;
        margin-bottom: 10px;
    }
</style>

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
<div class="container-dept">
    <div class="frame-title">{{ $departmentName ?? "No Data" }}</div>
    <select id="status-dropdown" class="user-status text-bold">
        <option value="Active" {{ $departmentSectionStatus == '1' ? 'selected' : '' }}>Active</option>
        <option value="Inactive" {{ $departmentSectionStatus == '0' ? 'selected' : '' }}>Inactive</option>
    </select>
</div>

{{-- <div class="user-status-data">
    <div class="user-dept">
        <i class="bi bi-folder"></i>
        <p class="text-bold">{{ $departmentSectionNames ?? "Not Available" }}</p>
    </div>
    <div class="user-location">
        <i class="bi bi-geo-alt"></i>
        <p class="text-bold">{{ $location ?? "Not Available" }}</p>
    </div>
</div> --}}
{{-- <div class="user-position text-bold">Head Of Department: <span class="highlight-b">{{ $headOfDepartment ?? "No Data" }}</span></div> --}}
<div class="position-overview">
    <div class="highest-job-data">
        <div class="highest-job-position-level">Highest Job Position Level:</div>
        <div class="total-highest-job-data">
            <div class="total-value-highest-job-data">{{ $highestPositionLevel ?? 0 }}</div>
        </div>
    </div>
    <div class="number-job-position-data">
        <div class="number-job-position">Total Number of Job Position:</div>
        <div class="total-number-job-position">
            <div class="total-value-number-job-position">{{ $totalNumberJobPosition ?? 0 }}</div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdown = document.getElementById('status-dropdown');
    
        function updateStyles() {
            if (dropdown.value === 'Inactive') {
                dropdown.style.backgroundColor = '#F1F1F4';
                dropdown.style.color = '#78829D';
    
                dropdown.style.backgroundImage =
                    "url('data:image/svg+xml;utf8,<svg fill=\"%2378829D\" height=\"24\" viewBox=\"0 0 24 24\" width=\"24\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M7 10l5 5 5-5z\"/></svg>')";
            } else {
                dropdown.style.backgroundColor = '#DDF5E2';
                dropdown.style.color = '#218336';
    
                dropdown.style.backgroundImage =
                    "url('data:image/svg+xml;utf8,<svg fill=\"%23218336\" height=\"24\" viewBox=\"0 0 24 24\" width=\"24\" xmlns=\"http://www.w3.org/2000/svg\"><path d=\"M7 10l5 5 5-5z\"/></svg>')";
            }
        }
    
        updateStyles();
        dropdown.addEventListener('change', updateStyles);
    });
    </script>
    
    