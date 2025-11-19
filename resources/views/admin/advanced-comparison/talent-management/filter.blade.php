@extends('admin.layout.app')

@section('title', 'Create Section')
@section('styles')
    <style>
        .grid-box {
            grid-template-columns: 27% 71%;
        }

        .left h3 {
            color: #071437;
            font-size: 24px;
            font-weight: 500;
            line-height: 32px;
            margin: 0;
            padding: 30px;
            border-bottom: 1px solid #F1F1F4;
        }

        .label-p {
            color: #071437;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
        }

        .pool button {
            padding: 12px 18px;
            border-radius: 4px;
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #78829D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .form-select {
            border: 1px solid #99A1B7;
            color: #78829D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .compare button {
            display: flex;
            padding: 14px 20px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            border: 1px solid #DBDFE9;
            background: #F1F1F4;
            /* color: #99A1B7; */
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
            width: 100%;
        }

        .pool .active {
            background: #F7941C;
            color: #FFF;
            border: 1px solid #F7941C;
        }

        .right {
            padding: 30px;
        }

        .right h3 {
            color: #071437;
            font-size: 20px;
            font-weight: 500;
            line-height: 26px;
            margin-bottom: 24px;
        }

        .btn-sorting {
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
            border: 1px solid #DBDFE9;
            background: #fff;
            color: #7B7B7B;
            font-size: 10px;
            font-weight: 700;
            line-height: 14px;
        }

        .status {
            padding: 12px 8px;
            border: 0;
            border-radius: 8px 0px 0px 8px;
            border-right: 1px solid #DBDFE9;
            background-color: #F1F1F4;
            color: #7B7B7B;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .border-custom {
            border-radius: 8px;
            border: 1px solid #DBDFE9;
        }

        .search-input {
            color: #B3B3B3;
            font-size: 12px;
            font-style: normal;
            font-weight: 500;
            line-height: 16px;
        }

        .select2-container--bootstrap5 .select2-selection--multiple .select2-selection__rendered {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .select2-container--bootstrap5 .select2-selection--multiple.form-select-sm .select2-selection__choice {
            display: flex !important;
            padding: 8px 16px !important;
            justify-content: center;
            align-items: center !important;
            gap: 4px;
            border-radius: 80px !important;
            background: #FFF3E0;
            color: #975102;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            overflow: scroll;
            scrollbar-width: none;
        }

        .select2-container--bootstrap5 .select2-selection--multiple .select2-selection__rendered .select2-selection__choice .select2-selection__choice__remove {
            left: 12px;
            background: #F7941C;
            height: 20px;
            opacity: 1;
            padding: 0px;
        }

        .select2-container--bootstrap5.select2-container--focus:not(.select2-container--disabled) .form-select-solid,
        .select2-container--bootstrap5.select2-container--open:not(.select2-container--disabled) .form-select-solid {
            background: white !important;
        }

        .select2-container--bootstrap5 .select2-selection--multiple.form-select-sm {
            background: #fff !important;
            color: #071437 !important;
            border-radius: 8px;
            border: 0px !important;
            padding: 0px !important;
        }

        .form-select.form-select-solid {
            background: none !important;
            border: none !important;
        }

        .select2-selection__choice__display {
            width: -webkit-fill-available;
        }

        .select2-selection__clear {
            display: none !important;
        }

        .dropdown-menu {
            padding: 0px;
            width: 100%;
        }

        .dropdown-item {
            padding: 12px 8px;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }

        .dropdown-item:focus,
        .dropdown-item:hover {
            background: #F1F1F4;
        }

        .form-control:focus {
            box-shadow: none;
        }

        .search-input {
            width: 300px;
        }

        #searchDropdown, #employeeSearchDropdown {
            background: white;
            border: 1px solid #ddd;
            margin-top: 60px !important;
        }

        #searchDropdown .list-group-item, 
        #employeeSearchDropdown .list-group-item {
            cursor: pointer;
            transition: background-color 0.3s;
            border: 0;
            padding: 16px;
        }

        #searchDropdown .list-group-item:hover, 
        #employeeSearchDropdown .list-group-item:hover {
            background-color: #FFF6EA;
        }

        #searchDropdown .list-group-item.active, 
        #employeeSearchDropdown .list-group-item.active  {
            background-color: #F7941C;
            color: white;
        }
    </style>
@endsection
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
                class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1
                    class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Advanced Comparison
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item link-a text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Advanced Comparison</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="d-grid grid-box gap-7">
                <div class="left card">
                    <h3>Advanced Comparison Analysis</h3>
                    <div class="d-grid gap-9" style="padding: 30px;">
                        <div id="selectPoolSection" class="pool">
                            <p class="label-p">Select Pool</p>
                            <div class="d-grid gap-3 selectPool">
                                <button id="candidateVsCandidate" data-value="employee-vs-employee" class="active">Employee vs Employee</button>
                                <button id="candidateVsEmployee" data-value="employee-vs-candidate">Employee vs Candidate</button>
                            </div>
                        </div>
                        
                        <div id="reportTypeSection" class="pool">
                            <p class="label-p">Report Type</p>
                            <div class="d-grid gap-3">
                                <select id="reportTypeSelect" class="form-select">
                                    <option value="">Select Report</option>
                                    @foreach ($reportTypes as $id => $reportType)
                                       <option value="{{$id}}">{{ $reportType }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>

                        <div id="selectComparisonSection" class="pool" style="display: none;">
                            <p class="label-p">Select Comparison</p>
                            <div class="d-flex gap-3">
                                <button class="w-100">Candidate</button>
                                <button class="w-100">Employee</button>
                            </div>
                        </div>
                        
                        <div id="departmentSection" class="pool" style="display: none;">
                            <p class="label-p">Department</p>
                            <div class="d-grid gap-3">
                                <select id="departmentSelect" class="form-select">
                                    <option value="">Select Department</option>
                                    @foreach($departments as $department)
                                       <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                        </div>
                        
                        <div id="jobOpeningSection" class="pool" style="display: none;">
                            <p class="label-p">Job Opening</p>
                            <div class="d-grid gap-3">
                                <select id="jobOpeningSelect" class="form-select">
                                    {{-- <option value="">Select Job Opening</option>
                                    <option>Staff II-Benefits 2</option> --}}
                                </select>
                            </div>
                        </div>

                        <div id="jobLevelSection" class="pool" style="display: none;">
                            <p class="label-p">Job Level</p>
                            <div class="d-grid gap-3">
                                <select id="jobLevelSelect" class="form-select">
                                    <option>Select Job Level</option>
                                    @foreach ($jobLevels as $id => $jobLevel)
                                       <option value="{{$id}}">{{ $jobLevel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="pool">
                            {{-- <p class="label-p d-flex justify-content-between">Comparing (<span id="totalCount" style="margin: 0;">0</span>/5)<span
                                    style="color: #F7941C;">Clear All</span></p> --}}

                            <p class="label-p d-flex justify-content-between align-items-center" style="margin: 0;">
                                <span>
                                    Comparing (<span id="totalCount">0</span>/5)
                                </span>
                                <span style="color: #F7941C; cursor: pointer;">Clear All</span>
                            </p>
                            
                                    
                            <div class="d-grid gap-3">
                                <select class="form-select form-select-sm form-select-solid me-6" id="selectCompare"
                                    data-control="select2" data-close-on-select="false" data-allow-clear="true"
                                    data-placeholder="" data-hide-search="true" multiple="multiple">
                                    {{-- <option value="1"> Noah Miller Brown</option>
                                    <option value="1"> Noah Evans Jones</option> --}}
                                </select>
                            </div>
                        </div>
                        <div class="compare">
                                <button id="compareButton" disabled>
                                    <iconify-icon icon="octicon:sync-16" width="16" height="16" aria-hidden="true"></iconify-icon>
                                    Compare
                                </button>
                                
                        </div>
                    </div>
                </div>
                <div id="candidateSection" class="right card" style="display: none;">
                    <h3>Select Candidate</h3>
                    <div class="d-flex">
                        <div id="candidateSearch" class="border-custom w-100 me-3" style="display: grid; grid-template-columns: 22% 78%;">
                            <div class="dropdown">
                                <button id="applicationStatusDropdown" class="form-select status" type="button" data-bs-toggle="dropdown">
                                    Application Status
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="applicationStatusDropdown">
                                    @foreach ($applicationStatuses as $key => $applicationStatus)
                                       <li><a class="dropdown-item" href="#" data-status="{{ $key }}">{{ $applicationStatus }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="d-flex justify-content-betweeen align-items-center w-100"
                                style="padding: 0px 20px 0px 16px">
                                <div class="d-flex flex-column gap-2 w-100 align-items-center position-relative search-input">
                                    <div class="d-flex gap-4 w-100 align-items-center">
                                        <iconify-icon icon="material-symbols:search" width="24"
                                            height="24"></iconify-icon>
                                        <input type="text" class="form-control border-0 p-0"
                                            placeholder="Type to search candidate" id="searchInput"
                                            onfocus="showDropdown('searchDropdown')" oninput="filterOptions('searchDropdown')" />
                                    </div>
                                    <ul id="searchDropdown" class="list-group w-100 position-absolute mt-2"
                                        style="display: none; max-height: 600px; overflow-y: auto;">
                                        {{-- <li class="list-group-item" onclick="selectOption(this)">Noah Miller Brown</li>
                                        <li class="list-group-item" onclick="selectOption(this)">James Moore Miller</li>
                                        <li class="list-group-item" onclick="selectOption(this)">Henry Phillips Johnson
                                        </li>
                                        <li class="list-group-item" onclick="selectOption(this)">James Wilson Williams
                                        </li>
                                        <li class="list-group-item" onclick="selectOption(this)">Mia Adams Lopez</li>
                                        <li class="list-group-item" onclick="selectOption(this)">Noah Evans Jones</li>
                                        <li class="list-group-item" onclick="selectOption(this)">Noah Carter Garcia</li>
                                        <li class="list-group-item" onclick="selectOption(this)">Mia Carter Davis</li> --}}
                                    </ul>
                                </div>
                                <iconify-icon icon="iconamoon:arrow-down-2-duotone" width="24" height="24"
                                    style="color: #B3B3B3;"></iconify-icon>
                            </div>
                        </div>
                        <button class="btn-sorting">
                            <iconify-icon icon="icons8:alphabetical-sorting" width="24"
                                height="24"></iconify-icon>
                        </button>
                    </div>
                </div>

                <div id="employeeSection" class="right card" style="display: none;">
                    <h3>Select Employee</h3>
                    <div class="d-flex">
                        <div id="employeeSearch" class="border-custom w-100 me-3" style="display: grid; grid-template-columns: 22% 78%;">
                            <div class="dropdown">
                                <button id="jobPositionDropdown" class="form-select status" type="button" data-bs-toggle="dropdown">
                                    Job Position
                                </button>
                                <ul id="jobPositionSelect" class="dropdown-menu" aria-labelledby="jobPositionDropdown">
                                    {{-- <li><a class="dropdown-item" href="#">Applied</a></li>
                                    <li><a class="dropdown-item" href="#">Assessment</a></li>
                                    <li><a class="dropdown-item" href="#">Shortlisted</a></li>
                                    <li><a class="dropdown-item" href="#">Screening Interview</a></li>
                                    <li><a class="dropdown-item" href="#">Interview (Conducted)</a></li>
                                    <li><a class="dropdown-item" href="#">Offer Stage</a></li>
                                    <li><a class="dropdown-item" href="#">Contract Issued</a></li> --}}
                                </ul>
                            </div>
                            <div class="d-flex justify-content-betweeen align-items-center w-100"
                                style="padding: 0px 20px 0px 16px">
                                <div class="d-flex flex-column gap-2 w-100 align-items-center position-relative search-input">
                                    <div class="d-flex gap-4 w-100 align-items-center">
                                        <iconify-icon icon="material-symbols:search" width="24"
                                            height="24"></iconify-icon>
                                        <input type="text" class="form-control border-0 p-0"
                                            placeholder="Type to search candidate" id="searchInput"
                                            onfocus="showDropdown('employeeSearchDropdown')" oninput="filterOptions('employeeSearchDropdown')" />
                                    </div>
                                    <ul id="employeeSearchDropdown" class="list-group w-100 position-absolute mt-2"
                                        style="display: none; max-height: 600px; overflow-y: auto;">
                                        {{-- <li class="list-group-item" onclick="selectOption(this)">Noah Miller Brown</li>
                                        <li class="list-group-item" onclick="selectOption(this)">James Moore Miller</li>
                                        <li class="list-group-item" onclick="selectOption(this)">Henry Phillips Johnson
                                        </li>
                                        <li class="list-group-item" onclick="selectOption(this)">James Wilson Williams
                                        </li>
                                        <li class="list-group-item" onclick="selectOption(this)">Mia Adams Lopez</li>
                                        <li class="list-group-item" onclick="selectOption(this)">Noah Evans Jones</li>
                                        <li class="list-group-item" onclick="selectOption(this)">Noah Carter Garcia</li>
                                        <li class="list-group-item" onclick="selectOption(this)">Mia Carter Davis</li> --}}
                                    </ul>
                                </div>
                                <iconify-icon icon="iconamoon:arrow-down-2-duotone" width="24" height="24"
                                    style="color: #B3B3B3;"></iconify-icon>
                            </div>
                        </div>
                        <button class="btn-sorting">
                            <iconify-icon icon="icons8:alphabetical-sorting" width="24"
                                height="24"></iconify-icon>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')

<script>

    // Initially show only "Select Pool"
    document.getElementById('selectPoolSection').style.display = 'block';
    // document.getElementById('reportTypeSection').style.display = 'none';
    document.getElementById('selectComparisonSection').style.display = 'none';
    document.getElementById('departmentSection').style.display = 'none';
    document.getElementById('jobOpeningSection').style.display = 'none';
    document.getElementById('jobLevelSection').style.display = 'none';
    document.getElementById('candidateSection').style.display = 'none';

    // Event listener for "Select Pool" buttons
    document.querySelectorAll('#selectPoolSection button').forEach(button => {
        button.addEventListener('click', () => {
            const poolValue = button.getAttribute('data-value'); // Get the value of the selected button
            console.log(`Selected Pool: ${poolValue}`); // Log the selected value for debugging

            if (poolValue === "employee-vs-employee") {
                document.getElementById('selectComparisonSection').style.display = 'none';
                document.getElementById('departmentSelect').value = '';
                document.getElementById('jobLevelSection').style.display = 'none';

                document.querySelectorAll('#selectComparisonSection button').forEach(btn => btn.classList.remove('active'));
                
            } else {
                document.getElementById('selectComparisonSection').style.display = 'block'; // Show comparison section
                document.getElementById('departmentSection').style.display = 'none';
                document.getElementById('jobOpeningSection').style.display = 'none';
            }

            document.getElementById('reportTypeSection').style.display = 'block'; // Show report type section
            document.querySelectorAll('#selectPoolSection button').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
        });
    });

    // Event listener for "Report Type" selection
    document.getElementById('reportTypeSelect').addEventListener('change', () => {
        const selectedPool = document.querySelector('#selectPoolSection .active').getAttribute('data-value');

        if (selectedPool === "employee-vs-employee") {
            document.getElementById('selectComparisonSection').style.display = 'none';
            document.getElementById('departmentSection').style.display = 'block'; // Directly show department section
            
        } else {
            document.getElementById('selectComparisonSection').style.display = 'block'; // Show comparison section
            document.getElementById('departmentSection').style.display = 'none';
            document.getElementById('jobOpeningSection').style.display = 'none';
        }
    });

    // Event listener for "Select Comparison" buttons
    document.querySelectorAll('#selectComparisonSection button').forEach(button => {
        button.addEventListener('click', () => {
            document.querySelectorAll('#selectComparisonSection button').forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const selectedComparison = button.textContent.trim();
            console.log(`Selected Comparison: ${selectedComparison}`); // Log for debugging

            if (selectedComparison === "Candidate") {
                document.getElementById('departmentSelect').value = '';
                document.getElementById('jobLevelSelect').value = '';
                document.getElementById('departmentSection').style.display = 'block';
                document.getElementById('jobLevelSection').style.display = 'none';
            } else if (selectedComparison === "Employee") {
                document.getElementById('departmentSelect').value = '';
                document.getElementById('jobOpeningSelect').value = '';
                document.getElementById('departmentSection').style.display = 'block';
                document.getElementById('jobOpeningSection').style.display = 'none';
            }
        });
    });

    // Event listener for "Select Department" buttons
    document.getElementById('departmentSelect').addEventListener('change', () => {
        const departmentId = document.getElementById('departmentSelect').value; // Get selected department ID
        const selectedComparison = document.querySelector('#selectComparisonSection .active')?.textContent.trim();
        console.log(`Department selected: ${departmentId}. Current comparison: ${selectedComparison}`);

        if (selectedComparison === "Employee") {
            document.getElementById('jobLevelSelect').value = '';
            document.getElementById('jobOpeningSection').style.display = 'none'; // Hide Job Opening
            document.getElementById('jobLevelSection').style.display = 'block'; // Show Job Level
        } else {
            document.getElementById('jobOpeningSelect').value = '';
            document.getElementById('jobOpeningSection').style.display = 'block'; // Show Job Opening
            document.getElementById('jobLevelSection').style.display = 'none'; // Hide Job Level

            // Use Laravel route() helper to generate the URL
            // In your Blade template
            const baseUrl = "{{ route('admin.tm.advanced_comparison.get_job_openings') }}";

            // Append query parameters in JavaScript
            const url = `${baseUrl}?department_id=${departmentId}`;

            // Perform AJAX request to get job openings
            fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    const jobOpeningSelect = document.getElementById('jobOpeningSelect');

                    // Clear existing options
                    jobOpeningSelect.innerHTML = '<option value="">Select Job Opening</option>';

                    // Populate with new job openings
                    data.jobOpenings.forEach(job => {
                        const option = document.createElement('option');
                        option.value = job.id;
                        option.textContent = job.job_title;
                        jobOpeningSelect.appendChild(option);
                    });

                    console.log(`Job openings for department ${departmentId}:`, data.jobOpenings);
                })
                .catch(error => {
                    console.error('Error fetching job openings:', error);
                });
        }
    });

    // Event listener for "Job Opening" selection
    document.getElementById('jobOpeningSelect').addEventListener('change', () => {
        console.log("Job Opening selected. Showing candidate section...");
        document.getElementById('candidateSection').style.display = 'block'; // Show the candidate section
        document.getElementById('employeeSection').style.display = 'none'; // Hide the employee section
        const jobOpeningId = document.getElementById('jobOpeningSelect').value;
        populateCandidateSearchDropdown(jobOpeningId); // Populate the candidate list dynamically
    });

    // Event listener for "Job Level" selection
    document.getElementById('jobLevelSelect').addEventListener('change', () => {
        console.log("Job level selected. Showing employee section...");
        document.getElementById('employeeSection').style.display = 'block'; // Show the employee section
        document.getElementById('candidateSection').style.display = 'none'; 
        jobLevelId = document.getElementById("jobLevelSelect").value;
        departmentId = document.getElementById("departmentSelect").value;
        const baseUrl = "{{ route('admin.tm.advanced_comparison.get_job_positions') }}";

        // Append query parameters in JavaScript
        const url = `${baseUrl}?job_level_id=${jobLevelId}&department_id=${departmentId}`;

        // Perform AJAX request to get job openings
        fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                const jobPositionSelect = document.getElementById("jobPositionSelect");
                // Populate with new job openings
                data.positions.forEach(position => {
                    const listItem = document.createElement("li");
                    const anchor = document.createElement("a");

                    // Add classes, attributes, and text to the anchor element
                    anchor.classList.add("dropdown-item");
                    anchor.href = "#";
                    anchor.setAttribute("data-id", position.id);
                    anchor.textContent = position.title; // Set the text content to `position.title`

                    // Add an event listener to the anchor for click handling
                    anchor.onclick = function () {
                        populateEmployeeSearchDropdown(position.id)
                    };

                    // Append the anchor to the list item
                    listItem.appendChild(anchor);

                    // Append the list item to the dropdown
                    jobPositionSelect.appendChild(listItem);

                });

                console.log(`Job positions for level ${jobLevelId}:`, data.positions);
            })
            .catch(error => {
                console.error('Error fetching job openings:', error);
            });
        // populateSearchDropdown(); // Populate the employee list dynamically
    });

    // Populate the search dropdown with candidates
    // function populateCandidateSearchDropdown(jobOpeningId) {
    //     const searchDropdown = document.getElementById("searchDropdown");
    //     searchDropdown.innerHTML = ""; // Clear any existing options

    //     // In your Blade template
    //     const baseUrl = "{{ route('admin.advanced_comparison.get_candidates') }}";

    //     // Append query parameters in JavaScript
    //     const url = `${baseUrl}?job_opening_id=${jobOpeningId}`;

    //     // Perform AJAX request to get job openings
    //     fetch(url, {
    //         method: 'GET',
    //         headers: {
    //             'Content-Type': 'application/json',
    //         },
    //     })
    //         .then(response => {
    //             if (!response.ok) {
    //                 throw new Error(`HTTP error! status: ${response.status}`);
    //             }
    //             return response.json();
    //         })
    //         .then(data => {

    //             // Populate with new job openings
    //             data.candidates.forEach(candidate => {
    //                 const listItem = document.createElement("li");
    //                 listItem.classList.add("list-group-item");
    //                 listItem.textContent = candidate.name;
    //                 listItem.setAttribute("data-id", candidate.id);
    //                 listItem.setAttribute("data-status", candidate.status);
    //                 listItem.onclick = function () {
    //                     selectOption(this);
    //                 };
    //                 searchDropdown.appendChild(listItem);
    //             });

    //             console.log(`Candidates for job opening ${jobOpeningId}:`, data.candidates);
    //         })
    //         .catch(error => {
    //             console.error('Error fetching Candidates:', error);
    //         });
    // }

    function populateCandidateSearchDropdown(jobOpeningId) {
    const searchDropdown = document.getElementById("searchDropdown");
    searchDropdown.innerHTML = ""; // Clear any existing options

    const reportType = parseInt(document.getElementById('reportTypeSelect').value, 10);

    // Determine the filter condition based on the selected report type
    let filterCondition = {};
    if (reportType === 1) {
        filterCondition.is_personality_motivation_completed = 1;
    } else if (reportType === 7) {
        filterCondition.is_work_interest_completed = 1;
    } else if (reportType === 8) {
        filterCondition.is_cognitive_ability_completed = 1;
    } else if ([2, 3, 4, 5, 6].includes(reportType)) {
        filterCondition.is_personality_motivation_completed = 1;
    }

    // Construct query parameters dynamically
    const queryParams = new URLSearchParams({
        job_opening_id: jobOpeningId,
        ...filterCondition,
    });

    // Construct the final URL
    const baseUrl = "{{ route('admin.tm.advanced_comparison.get_candidates') }}";
    const url = `${baseUrl}?${queryParams.toString()}`;

    // Perform AJAX request to get candidates
    fetch(url, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        },
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Populate the dropdown with candidates
            data.candidates.forEach(candidate => {
                const listItem = document.createElement("li");
                listItem.classList.add("list-group-item");
                listItem.textContent = candidate.name;
                listItem.setAttribute("data-id", candidate.id);
                listItem.setAttribute("data-status", candidate.status);
                listItem.onclick = function () {
                    selectOption(this);
                };
                searchDropdown.appendChild(listItem);
            });

            console.log(`Candidates for job opening ${jobOpeningId}:`, data.candidates);
        })
        .catch(error => {
            console.error('Error fetching Candidates:', error);
        });
}
    
    // Populate the search dropdown with candidates
    function populateEmployeeSearchDropdown(jobPositionId) {
        const searchDropdown = document.getElementById("employeeSearchDropdown");
        searchDropdown.innerHTML = ""; // Clear any existing options

        const reportType = parseInt(document.getElementById('reportTypeSelect').value, 10);

        // Determine the filter condition based on the selected report type
        let filterCondition = {};
        if (reportType === 1) {
            filterCondition.is_personality_motivation_completed = 1;
        } else if (reportType === 7) {
            filterCondition.is_work_interest_completed = 1;
        } else if (reportType === 8) {
            filterCondition.is_cognitive_ability_completed = 1;
        } else if ([2, 3, 4, 5, 6].includes(reportType)) {
            filterCondition.is_personality_motivation_completed = 1;
        }

        // Construct query parameters dynamically
        const queryParams = new URLSearchParams({
            job_opening_id: jobPositionId,
            ...filterCondition,
        });

        // In your Blade template
        const baseUrl = "{{ route('admin.tm.advanced_comparison.get_employees') }}";

        // Append query parameters in JavaScript
        const url = `${baseUrl}?${queryParams.toString()}`;

        // Perform AJAX request to get job openings
        fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {

                // Populate with new job openings
                data.employees.forEach(employee => {
                    const listItem = document.createElement("li");
                    listItem.classList.add("list-group-item");
                    listItem.textContent = employee.name;
                    listItem.setAttribute("data-id", employee.id);
                    // listItem.setAttribute("data-status", employee.status);
                    listItem.onclick = function () {
                        selectOption(this);
                    };
                    searchDropdown.appendChild(listItem);
                });

                console.log(`Employees for job position ${jobPositionId}:`, data.employees);
            })
            .catch(error => {
                console.error('Error fetching employees:', error);
            });
    }

    // Show dropdown when input is focused
    function showDropdown(id) {
        const searchDropdown = document.getElementById(id);
        searchDropdown.style.display = "block";
    }
    

    // Hide dropdown on outside click
    document.addEventListener("click", function (event) {
        if (!event.target.closest(".search-input")) {
            const searchDropdown = document.getElementById("searchDropdown");
            searchDropdown.style.display = "none";
        }
    });

    // Filter options in the search dropdown
    function filterOptions(id) {
        const searchInput = document.getElementById("searchInput").value.toLowerCase();
        const searchDropdown = document.getElementById(id);
        const options = searchDropdown.querySelectorAll("li");
        options.forEach(option => {
            const text = option.textContent.toLowerCase();
            option.style.display = text.includes(searchInput) ? "" : "none";
        });
    }

    // Sort candidates alphabetically in the dropdown
    const sortButton = document.querySelector(".btn-sorting");
    let isAscending = true;
    sortButton.addEventListener("click", () => {
        const searchDropdown = document.getElementById("searchDropdown");
        const options = Array.from(searchDropdown.querySelectorAll("li"));

        // Sort based on direction
        options.sort((a, b) => {
            if (isAscending) {
                return a.textContent.localeCompare(b.textContent);
            } else {
                return b.textContent.localeCompare(a.textContent);
            }
        });

        // Append sorted options
        options.forEach(option => searchDropdown.appendChild(option));
        isAscending = !isAscending; // Toggle sorting direction

        console.log(`Candidates sorted in ${isAscending ? 'ascending' : 'descending'} order.`);
    });

    // Application status dropdown handling
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    const dropdownButton = document.getElementById('applicationStatusDropdown');

    dropdownItems.forEach(item => {
        item.addEventListener('click', function (event) {
            event.preventDefault();

            // Get the status from the data-status attribute
            const selectedStatus = this.getAttribute('data-status');

            // Update the dropdown button text
            dropdownButton.textContent = this.textContent;

            // Call the filter function with the selected status
            filterByStatus(selectedStatus);
        });
    });

    // Filter candidates by application status
    function filterByStatus(status) {
        const searchDropdown = document.getElementById("searchDropdown");
        const options = searchDropdown.querySelectorAll("li");

        options.forEach(option => {
            // Assuming each candidate has a data-status attribute for filtering
            const candidateStatus = option.getAttribute("data-status");

            // Show or hide candidates based on the selected status
            if (status === "All" || candidateStatus === status) {
                option.style.display = ""; // Show the candidate
            } else {
                option.style.display = "none"; // Hide the candidate
            }
        });

        console.log(`Filtered candidates by status: ${status}`);
    }

</script>

<script>
    // Array to track selected candidates
    let selectedCandidates = [];

    // Function to handle candidate selection
    function selectOption(option) {
        const candidateName = option.textContent;
        const candidateId = option.getAttribute("data-id");

        // Check if the candidate is already selected
        if (selectedCandidates.find(candidate => candidate.id === candidateId)) {
            alert("This candidate is already selected.");
            return;
        }

        // Check if the selection limit is reached
        if (selectedCandidates.length >= 5) {
            alert("You can only select up to 5 comparisons.");
            return;
        }

        // Add candidate to the selected list
        selectedCandidates.push({ id: candidateId, name: candidateName });

        // Update the total count display
        document.getElementById("totalCount").textContent = selectedCandidates.length;

        // Append to the comparison dropdown
        const selectCompare = document.getElementById("selectCompare");
        const optionElement = document.createElement("option");
        optionElement.value = candidateId;
        optionElement.textContent = candidateName;
        optionElement.selected = true;
        selectCompare.appendChild(optionElement);

        // Update "Compare" button state
        updateCompareButtonState();

        // Hide the search dropdown
        document.getElementById("searchDropdown").style.display = "none";

        console.log("Selected candidatessss:", selectedCandidates);
    }

    // Function to handle removal of a candidate
    function removeCandidate(candidateId) {
        // Remove candidate from the selected list
        selectedCandidates = selectedCandidates.filter(candidate => candidate.id !== candidateId);
        console.log(selectedCandidates.length);
        // Update the total count display
        document.getElementById("totalCount").textContent = selectedCandidates.length;

        // Update the dropdown
        const selectCompare = document.getElementById("selectCompare");
        const optionToRemove = Array.from(selectCompare.options).find(option => option.value === candidateId);
        if (optionToRemove) {
            selectCompare.removeChild(optionToRemove);
        }

        // Update "Compare" button state
        updateCompareButtonState();

        console.log("Candidate removed:", candidateId);
        console.log("Updated selected candidates:", selectedCandidates);
    }

    // Function to update "Compare" button state
    function updateCompareButtonState() {
        const compareButton = document.querySelector(".compare button");
        if (selectedCandidates.length >= 2) {
            compareButton.disabled = false;
            compareButton.style.background = "#F7941C";
            compareButton.style.cursor = "pointer";
        } else {
            compareButton.disabled = true;
            compareButton.style.background = "#F1F1F4";
            compareButton.style.cursor = "not-allowed";
        }
    }

    // Initialize select2
    $(document).ready(function () {
        $("#selectCompare").select2({
            placeholder: "Select candidates",
            allowClear: true,
        });

        // Event listener for changes in the select2 dropdown
        $("#selectCompare").on("select2:select", function (event) {
            const candidateId = event.params.data.id;
            const candidateName = event.params.data.text;

            // Add the candidate if not already selected
            if (!selectedCandidates.find(candidate => candidate.id === candidateId)) {
                selectedCandidates.push({ id: candidateId, name: candidateName });
            }

            // Check if we exceed the limit
            if (selectedCandidates.length > 5) {
                alert("You can only select up to 5 comparisons.");
                // Remove the last-added candidate
                selectedCandidates = selectedCandidates.filter(candidate => candidate.id !== candidateId);
                $("#selectCompare").find(`option[value='${candidateId}']`).prop("selected", false);
                $("#selectCompare").trigger("change");
            }

            updateCompareButtonState();
            updateTotalCount();
        });

        $("#selectCompare").on("select2:unselect", function (event) {
            const candidateId = event.params.data.id;

            // Remove the candidate from the list
            selectedCandidates = selectedCandidates.filter(candidate => candidate.id !== candidateId);

            updateCompareButtonState();
            updateTotalCount();
        });
    });

    // Function to update the total count display
    function updateTotalCount() {
        document.getElementById("totalCount").textContent = selectedCandidates.length;
    }


    // Event listener for "Clear All" button
    document.querySelector('.label-p span[style*="cursor: pointer"]').addEventListener('click', clearAllSelections);

    // Function to clear all selections
    function clearAllSelections() {
        selectedCandidates = [];
        document.getElementById("totalCount").textContent = "0";

        // Clear the comparison dropdown
        const selectCompare = document.getElementById("selectCompare");
        selectCompare.innerHTML = "";

        // Update "Compare" button state
        updateCompareButtonState();

        console.log("All selections cleared.");
    }

    // Initialize the candidate dropdown on page load
    document.addEventListener("DOMContentLoaded", () => {
        updateCompareButtonState(); // Ensure button state is correct on load
    });

</script>

{{-- Submit on click button  --}}
<script>
    document.getElementById('compareButton').addEventListener('click', () => {
        const selectedPoolType = document.querySelector(".selectPool .active");
        if (selectedPoolType) {
            const poolType = selectedPoolType.getAttribute("data-value");
        } else {
            const poolType = ''
            console.log("No button is currently active.");
        }

        departmentId = document.getElementById('departmentSelect').value;
        reportType = document.getElementById('reportTypeSelect').value;
        const selectBox = document.getElementById("selectCompare");
        const users = Array.from(selectBox.selectedOptions).map(option => option.value);

        const baseUrl = "{{ route('admin.tm.advanced_comparison.report') }}";

        // Append query parameters 
        const url = `${baseUrl}?department_id=${departmentId}&report_type=${reportType}&pool_type=${selectedPoolType.getAttribute("data-value")}&users=${encodeURIComponent(users)}`;

        // Redirect to the constructed URL
        window.location.href = url;
        
    });
</script>

@endsection
