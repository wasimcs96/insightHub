@extends('admin.layout.app')

@section('title', 'Interview Question')

@section('styles')

    <style>
        .app-wrapper {
            margin-top: 90px !important;
        }

        .app-container {
            padding: 0px !important;
            margin: 0px 186px !important;
        }

        .top-message {
            display: flex;
            padding: 0px 26px;
            height: 72px;
            border-radius: 8px;
            margin: 48px 0px;
        }

        .top-message p {
            color: #071437;
            font-size: 13.975px;
            line-height: 16.77px;
        }

        .top-message .icon {
            color: #78829D;
        }

        .top-message.message-green {
            background: #DDF5E2;
            border: 1px solid #BBECC5;
        }

        .top-message.message-red {
            background: #FFE0DD;
            border: 1px solid #FFC1BB;
        }

        .styles-interview-index h1 {
            color: #252F4A;
            font-size: 32.5px;
            line-height: 39px;
        }

        .styles-interview-index input:focus {
            outline: 0;
            box-shadow: none;
            border-color: #DBDFE9;
        }

        .styles-interview-index input,
        .styles-interview-index select {
            display: flex;
            height: 40px;
            padding: 0px 12px;
            align-items: center;
            flex: 1 0 0;
            border-radius: 4px 0px 0px 4px;
            border-top: 1px solid #DBDFE9;
            border-bottom: 1px solid #DBDFE9;
            border-left: 1px solid #DBDFE9;
            border-right: 0;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }

        .styles-interview-index select {
            border: 1px solid #DBDFE9;
            border-radius: 4px;
        }

        .styles-interview-index .search-icon {
            border-radius: 0px 4px 4px 0px;
            background-color: #F7941C;
            display: flex;
            width: 40px !important;
            height: 40px !important;
            ;
            padding: 8px 16px;
            justify-content: center;
            align-items: center;
            color: #ffffff;
        }

        .styles-interview-index .button {
            padding: 14px 20px;
            gap: 8px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
            width: 100%;
        }

        .styles-interview-index .outline-orange-btn {
            border: 1px solid #F7941C;
            background: #FFF;
            color: #F7941C;
        }

        .styles-interview-index .fill-orange-btn {
            background: #F7941C;
            color: #FFF;
            border: 0;
        }

        .styles-interview-index .btn-group .dropdown-menu {
            width: 223px;
            top: 6px !important;
            padding: 8px;
            border-radius: 8px;
            border: 1px solid #D9D9D9;
            box-shadow: 0px 4px 4px -1px rgba(12, 12, 13, 0.1);
        }

        .styles-interview-index .btn-group .dropdown-menu .dropdown-item {
            display: flex;
            padding: 12px 16px;
            align-items: center;
            gap: 12px;
            align-self: stretch;
            border-radius: 8px;
            color: #1E1E1E;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
        }

        .styles-interview-index .filter-side {
            padding: 16px;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            width: 25%;
            height: fit-content;
        }

        .styles-interview-index .filter-side h5 {
            color: #071437;
            font-size: 16.25px;
            font-weight: 700;
            line-height: 19.5px;
        }

        .styles-interview-index .filter-side a {
            color: #F7941D;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

        .styles-interview-index .filter-side label {
            color: #071437;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            margin-bottom: 7px;
        }

        .styles-interview-index .table-side {
            background-color: #ffffff;
            width: 100%;
        }

        .styles-interview-index .table-side table {
            width: inherit;
        }

        .styles-interview-index .table-side table thead {
            border-bottom: 1px solid #F3F3F3;
        }

        .styles-interview-index .table-side table thead tr th {
            padding: 16px;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .styles-interview-index .table-side table tbody tr td {
            padding: 24px 16px;
            border-bottom: 1px solid #F1F1F4;
            color: #4B5675;
            font-size: 14px;
            font-style: normal;
            font-weight: 500;
            line-height: 20px;
            letter-spacing: 0.1px;
        }

        .styles-interview-index .table-side .action-btn {
            display: flex;
            width: 32px;
            padding: 8px 16px;
            justify-content: center;
            align-items: center;
            flex-shrink: 0;
            border-radius: var 4px;
            border: 1px solid #99A1B7;
            background-color: #FFF;
            color: #78829D;
        }

        .styles-interview-index .table-side .action-div {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
    </style>

@endsection

@section('content')

    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_content" class="app-content  flex-column-fluid ">
            <div id="kt_app_content_container" class="app-container styles-interview-index">
                <div id="successMessage" class="justify-content-between align-items-center top-message message-green"
                    style="display: none;">
                    <p class="text-center fw-medium m-0">Success! Interview Question for <b>Manager - TOC & OTP</b> has been
                        created successfully.</p>
                    <iconify-icon icon="iconamoon:close-bold" width="24" height="24"
                        class="cursor-pointer close-icon"></iconify-icon>
                </div>
                <div id="deleteMessage" class="justify-content-between align-items-center top-message message-red"
                    style="display: none;">
                    <p class="text-center fw-medium m-0">
                        Interview Question for <b>Manager - TOC & OTP</b> has been deleted successfully.
                    </p>
                    <iconify-icon icon="iconamoon:close-bold" width="24" height="24"
                        class="cursor-pointer close-icon"></iconify-icon>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <h1 class="fw-semibold text-primary-emphasis">Interview Question</h1>
                    <div class="d-flex gap-5 align-items-center">
                        <form method="GET" action="{{ route('admin.interview-question.index') }}" class="input-group" style="max-width: 250px;">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search Job Position">
                            <button type="submit" class="search-icon border-0" style="background-color: #F7941C;">
                                <iconify-icon icon="mingcute:search-line" width="16" height="16" style="color: white;"></iconify-icon>
                            </button>
                        </form>
                        
                        <a href="{{route('admin.interview-question.bulk-upload')}}">
                            <button class="d-flex align-items-center justify-content-center button outline-orange-btn"
                            style="width: 200px;">
                            <iconify-icon icon="material-symbols:upload" width="16" height="16"></iconify-icon> Bulk
                            Upload
                        </button>
                        </a>
                        <div class="btn-group gap-1">
                            <!-- Main button -->
                            <button id="createQuestionBtn"
                                class="text-white d-flex align-items-center justify-content-center button fill-orange-btn"
                                style="width: 182px; border-radius: 4px 0px 0px 4px;">
                                <iconify-icon icon="stash:plus-solid" width="16" height="16"></iconify-icon> Create Questions
                            </button>
                        
                            <!-- Dropdown toggle -->
                            <button
                                class="text-white d-flex align-items-center justify-content-center button fill-orange-btn dropdown-toggle-split"
                                style="width: 34.8px; border-radius: 0px 4px 4px 0px;"
                                data-bs-toggle="dropdown">
                                <iconify-icon icon="fluent:chevron-down-12-filled" width="12" height="12"></iconify-icon>
                            </button>
                        
                            <!-- Dropdown menu -->
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.interview-question.create') }}">
                                    <iconify-icon icon="prime:pencil" style="color: #78829D;" width="18" height="18"></iconify-icon>
                                    Manual Creation
                                </a>
                            </li>
                                <li><a class="dropdown-item" href="#">
                                    <iconify-icon icon="ix:ai" style="color: #78829D;" width="18" height="18"></iconify-icon>
                                    AI-Generate
                                </a></li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
                <div class="d-flex gap-9 my-14">
                    <div class="filter-side">
                        <form method="GET" action="{{ route('admin.interview-question.index') }}" id="filterSidebarForm">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Filter</h5>
                                <a href="{{ route('admin.interview-question.index') }}">Clear filter</a>
                            </div>
                    
                            <div class="mt-7">
                                <label class="form-label fw-semibold">Department</label>
                                <select name="department_id" id="sidebarDepartment" class="form-select">
                                    <option value="">Select a department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <div class="mt-5">
                                <label class="form-label fw-semibold">Job Position</label>
                                <select name="job_id" id="sidebarJob" class="form-select">
                                    <option value="">Select a job</option>
                                    {{-- Will be dynamically populated --}}
                                </select>
                            </div>
                    
                            <div class="mt-5">
                                <button type="submit" class="btn btn-primary w-100">Apply Filter</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="table-side">
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery([
                                            'sort' => 'job_position',
                                            'order' => ($sortField === 'job_position' && $sortOrder === 'asc') ? 'desc' : 'asc'
                                        ]) }}">
                                           <div class="d-flex align-items-center gap-2">
                                            Job Position
                                            <div class="d-flex flex-column">
                                            <iconify-icon icon="fluent:chevron-up-12-filled" style="margin-bottom: -2px;" width="12" height="12"
                                                class="{{ $sortField === 'job_position' && $sortOrder === 'asc' ? 'text-primary' : '' }}"></iconify-icon>
                                            <iconify-icon icon="fluent:chevron-down-12-filled" style="margin-top: -2px;" width="12" height="12"
                                                class="{{ $sortField === 'job_position' && $sortOrder === 'desc' ? 'text-primary' : '' }}"></iconify-icon>
                                            </div>
                                        </div>
                                        </a>
                                    </th>
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery([
                                            'sort' => 'department',
                                            'order' => ($sortField === 'department' && $sortOrder === 'asc') ? 'desc' : 'asc'
                                        ]) }}">
                                            <div class="d-flex align-items-center gap-2">
                                                Department
                                                <div class="d-flex flex-column">
                                                    <iconify-icon
                                                        icon="fluent:chevron-up-12-filled"
                                                        width="12"
                                                        height="12"
                                                        style="margin-bottom: -2px;"
                                                        class="{{ $sortField === 'department' && $sortOrder === 'asc' ? 'text-primary' : 'text-muted' }}">
                                                    </iconify-icon>
                                                    <iconify-icon
                                                        icon="fluent:chevron-down-12-filled"
                                                        width="12"
                                                        height="12"
                                                        style="margin-top: -2px;"
                                                        class="{{ $sortField === 'department' && $sortOrder === 'desc' ? 'text-primary' : 'text-muted' }}">
                                                    </iconify-icon>
                                                </div>
                                            </div>
                                        </a>
                                    </th>
                                    
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'created_at', 'order' => ($sortField === 'created_at' && $sortOrder === 'asc') ? 'desc' : 'asc']) }}">
                                            <div class="d-flex align-items-center gap-2">
                                                Date Created
                                                <div class="d-flex flex-column">
                                            <iconify-icon icon="fluent:chevron-up-12-filled" width="12" height="12" class="{{ $sortField === 'created_at' && $sortOrder === 'asc' ? 'text-primary' : '' }}"></iconify-icon>
                                            <iconify-icon icon="fluent:chevron-down-12-filled" width="12" height="12" class="{{ $sortField === 'created_at' && $sortOrder === 'desc' ? 'text-primary' : '' }}"></iconify-icon>
                                        </div>
                                    </div>
                                        </a>
                                    </th>
                                    
                                    <th>
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'updated_at', 'order' => ($sortField === 'updated_at' && $sortOrder === 'asc') ? 'desc' : 'asc']) }}">
                                            <div class="d-flex align-items-center gap-2">
                                                Date Updated
                                                <div class="d-flex flex-column">
                                            <iconify-icon icon="fluent:chevron-up-12-filled" width="12" height="12" class="{{ $sortField === 'updated_at' && $sortOrder === 'asc' ? 'text-primary' : '' }}"></iconify-icon>
                                            <iconify-icon icon="fluent:chevron-down-12-filled" width="12" height="12" class="{{ $sortField === 'updated_at' && $sortOrder === 'desc' ? 'text-primary' : '' }}"></iconify-icon>
                                        </div>
                                    </div>
                                        </a>
                                    </th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($interviewGroups as $group)
        <tr>
            <td>{{ $group->job->title ?? '-' }}</td>
            <td>{{ $group->department->name ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($group->created_at)->format('d/m/Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($group->updated_at)->format('d/m/Y') }}</td>
            <td class="action-div">
                <a href="{{ route('admin.interview-question.show', ['department_id' => $group->department_id, 'job_id' => $group->job_id]) }}" class="action-btn">
                    <iconify-icon icon="iconamoon:eye-bold" width="16" height="16"></iconify-icon>
                </a>
                
                <a href="{{ route('admin.interview-question.edit', ['department_id' => $group->department_id, 'job_id' => $group->job_id]) }}" class="action-btn">
                    <iconify-icon icon="ph:note-pencil-bold" width="16" height="16"></iconify-icon>
                </a>
                <button class="action-btn" data-bs-toggle="modal" data-bs-target="#deleteInterview"
                data-job="{{ $group->job_id }}" data-department="{{ $group->department_id }}">
                <iconify-icon icon="bx:trash" width="16" height="16"></iconify-icon>
            </button>
            
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center text-muted">No interview questions found.</td>
        </tr>
    @endforelse
                            </tbody>
                        </table>
                        {{ $interviewGroups->appends(request()->query())->links() }}

                    </div>
                </div>
            </div>
        <!-- Delete Confirmation Modal & Form -->
<form id="deleteInterviewForm" method="POST" action="{{ route('admin.interview-question.destroy') }}">
    @csrf
    @method('DELETE')
    <input type="hidden" name="job_id" id="deleteJobId">
    <input type="hidden" name="department_id" id="deleteDepartmentId">

    <div class="modal fade" id="deleteInterview" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-div">
                <div class="modal-body text-center pt-5">
                    <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" style="float:right;">
                        <iconify-icon icon="mingcute:close-fill" width="24" height="24" style="color: #99A1B7;"></iconify-icon>
                    </button>
                    <iconify-icon icon="ep:warning" width="70" height="70" class="my-3" style="color: #FF6355;"></iconify-icon>
                    <p class="fw-bolder fs-1" style="color: #4B5675;">Are You Sure You Want to Delete this Interview Question?</p>
                    <p class="text-muted">This action is permanent and cannot be undone.</p>
                </div>
                <div class="modal-footer d-block border-0">
                    <div class="d-flex w-100 gap-2">
                        <button type="button" class="btn btn-outline w-50" data-bs-dismiss="modal">No, cancel</button>
                        <button type="submit" class="btn btn-danger w-50">Yes, delete it</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

        </div>
    </div>

@endsection

@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
  document.addEventListener("DOMContentLoaded", function() {
    document.querySelector(".confirmDelete").addEventListener("click", function() {
        setTimeout(() => {
            let deleteMessage = document.getElementById("deleteMessage");
            deleteMessage.style.display = "flex";
        }, 300);

        setTimeout(() => {
            document.getElementById("deleteMessage").style.display = "none";
        }, 3000);
    });

    document.querySelector(".close-icon").addEventListener("click", function() {
        document.getElementById("deleteMessage").style.display = "none";
    });
});

    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mainBtn = document.getElementById('createQuestionBtn');
        const dropdownToggle = mainBtn.nextElementSibling; // The arrow button
        const dropdownMenu = dropdownToggle.nextElementSibling;

        mainBtn.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent any default behavior

            // Toggle the dropdown manually
            const isShown = dropdownMenu.classList.contains('show');

            // Hide all open dropdowns
            document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                menu.classList.remove('show');
            });

            // Toggle current one
            if (!isShown) {
                dropdownMenu.classList.add('show');
            }
        });

        // Optional: Close dropdown when clicking outside
        document.addEventListener('click', function (e) {
            if (!mainBtn.contains(e.target) && !dropdownToggle.contains(e.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteButtons = document.querySelectorAll("[data-bs-target='#deleteInterview']");

        deleteButtons.forEach(button => {
            button.addEventListener("click", () => {
                document.getElementById("deleteJobId").value = button.dataset.job;
                document.getElementById("deleteDepartmentId").value = button.dataset.department;
            });
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deptDropdown = document.getElementById("sidebarDepartment");
        const jobDropdown = document.getElementById("sidebarJob");
        const selectedJob = "{{ request('job_id') }}";

        function fetchJobs(deptId) {
            jobDropdown.innerHTML = `<option value="">Select a job</option>`;
            if (!deptId) return;

            fetch(`/admin/get-job-by-department/${deptId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(job => {
                        const option = document.createElement('option');
                        option.value = job.id;
                        option.text = job.title;

                        if (selectedJob == job.id) {
                            option.selected = true;
                        }

                        jobDropdown.appendChild(option);
                    });
                });
        }

        // On load if department is already selected
        if (deptDropdown.value) {
            fetchJobs(deptDropdown.value);
        }

        // On department change
        deptDropdown.addEventListener('change', function () {
            fetchJobs(this.value);
        });
    });
</script>





@endsection
