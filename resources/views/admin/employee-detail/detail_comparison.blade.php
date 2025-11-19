<style>
    table th {
        color: #071437 !important;
        font-size: 14px !important;
        font-style: normal;
        font-weight: 600 !important;
        line-height: 20px;
        padding: 32px 16px !important;
    }

    .table-first {
        color: #071437 !important;
        font-size: 14px !important;
        font-style: normal !important;
        font-weight: 600 !important;
        line-height: 20px !important;
        padding: 32px 16px !important;
    }

    th:nth-child(1),
    th:nth-child(3),
    td:nth-child(1),
    td:nth-child(3) {
        background: #FAFAFB;
    }

    th:nth-child(2),
    td:nth-child(2) {
        background: #ffffff;
    }

    .heading {
        color: #1E1E1E;
        font-size: 19.5px;
        font-style: normal;
        font-weight: 700;
        line-height: 23.4px;
    }

    .heading-badge {
        padding: 4px 12px;
        border-radius: 50px;
        background: #BBECC5;
        color: #196329;
        font-size: 11px;
        font-style: normal;
        font-weight: 500;
        line-height: 16px;
        letter-spacing: 0.5px;
    }

    .heading-badge-gray {
        padding: 4px 12px;
        border-radius: 80px;
        background: #F1F1F4;
        color: #99A1B7;
        text-align: center;
        font-size: 10px;
        font-style: normal;
        font-weight: 600;
        line-height: 14px;
    }

    .dropdown-menu .heading-badge {
        background: #DDF5E2;
        color: #196329;
        font-size: 10px;
        font-style: normal;
        font-weight: 600;
        line-height: 14px;
        position: relative;
        top: 1px;
    }

    .dropdown-menu .heading-badge-gray {
        padding: 4px 12px;
        border-radius: 80px;
        background: #F1F1F4;
        color: #99A1B7;
        text-align: center;
        font-size: 10px;
        font-style: normal;
        font-weight: 600;
        line-height: 14px;
        position: relative;
        top: 1px;
    }

    td span {
        font-size: 12px;
        font-style: normal;
        font-weight: 600;
        line-height: 16px;
        padding: 8px 16px;
        border-radius: 80px;
    }

    .moderate {
        background-color: #FFEBB4;
        color: #EB8100;
    }

    .high {
        background-color: #DDF5E2;
        color: #196329;
    }

    .low {
            background-color: #ffcdd2;
            color: #d32f2f;
    }
    .info {
        font-size: 20px;
        color: #757575;
        width: 20px;
    }

    .dropdown-toggle {
        border-radius: 8px;
        border: 1px solid #DBDFE9 !important;
        padding: 16px 24px !important;
        width: 100%;
    }

    .dropdown {
        position: relative;
        border-radius: 8px;
        border: 1px solid #DBDFE9 !important;
        padding: 10px 24px 16px 24px !important;
        width: 100%;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        margin-top: 3px;
        width: 100%;
        z-index: 10;
        padding: 0px;
        border-radius: 4px;
        border: 1px solid #DBDFE9;
        background: #FFF;
        border-radius: 8px;
        border: 1px solid #D9D9D9;
        box-shadow: 0 4px 4px -1px rgba(12, 12, 13, 0.1), 0 4px 4px -1px rgba(12, 12, 13, 0.05);

    }

    .dropdown-menu .dropdown-item {
        display: flex;
        padding: 12px 16px;
        align-items: center;
        align-self: stretch;
        display: flex;
        justify-content: space-between;
        color: #071437;
        font-size: 14px;
        font-style: normal;
        font-weight: 500;
        line-height: 20px;
    }

    .dropdown-menu .dropdown-item:hover {
        background: #FFF6EA;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-menu .dropdown-item.active {
        background: #F7941C;
        color: #FFF;
    }

    .displayNone {
        display: none;
    }
</style>

<!--begin::Panel 5-->
<div class="h-full " role="tabpanel">
    <div class="container my-4">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th class="text-center" style="
                        width: 20%;
                    "></th>
                        <th class="text-center" style="
                        width: 40%;
                    ">Current
                            Career
                        </th>
                        <th class="text-center" style="
                        width: 40%;
                    ">
                            Comparison</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="table-first">
                            <p class="d-flex justify-content-between">Job Position<iconify-icon
                                    icon="material-symbols:info-outline" class="info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Job Position"></iconify-icon></p>
                        </td>
                        <td class="text-center table-first">
                            <span class="heading">{{ $positionName ?? ' ' }}</span>
                            <span class="heading-badge ms-1">80% Successor Rate</span>
                        </td>
                        <td class="text-center table-first"
                            style="
                        padding: 16px !important;
                    ">
                            <div class="d-flex">
                                <div class="dropdown">
                                    <div class="dropdown-button heading">
                                        <span class="dropdown-text heading"
                                            style="display: flex;
                                            justify-content: center;
                                            flex-flow: wrap;
                                            gap: 10px;">Select Position
                                            {{-- <p class="heading-badge ms-2" style="margin: 0;">100%
                                                Successor Rate</p></span> --}}
                                        <span style="padding: 0; position: absolute; top: 16px; right: 8px;">
                                            <iconify-icon icon="iconamoon:arrow-down-2-duotone" width="24"
                                                height="24"></iconify-icon>
                                        </span> 
                                    </div>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item">Select Position
                                        </li>
                                        @foreach($jobs as $job)
                                            <li class="dropdown-item" data-value="{{ $job->id }}">{{ $job->title }}<p class="heading-badge ms-2"
                                                style="margin: 0;">{{ rand(1,100) }}% Successor Rate</p>
                                            </li>
                                        @endforeach
                                        {{-- <li class="dropdown-item">Advance Crew Controllers<p class="heading-badge ms-2"
                                                style="margin: 0;">100% Successor Rate</p>
                                        </li>
                                        <li class="dropdown-item">Advance Crewing Supervisor<p
                                                class="heading-badge ms-2" style="margin: 0;">90% Successor Rate</p>
                                        </li>
                                        <li class="dropdown-item">AIMS System Support<p class="heading-badge ms-2"
                                                style="margin: 0;">80% Successor Rate</p>
                                        </li>
                                        <li class="dropdown-item">Charter and Ops Planning Manager<p
                                                class="heading-badge-gray ms-2" style="margin: 0;">79% Successor Rate
                                            </p>
                                        </li>
                                        <li class="dropdown-item">Crew Controller<p class="heading-badge-gray ms-2"
                                                style="margin: 0;">50% Successor Rate</p>
                                        </li>
                                        <li class="dropdown-item">Crewing Manager<p class="heading-badge-gray ms-2"
                                                style="margin: 0;">10% Successor Rate</p>
                                        </li>
                                        <li class="dropdown-item">Duty Manager (Crew Scheduling)</li>
                                        <li class="dropdown-item">Duty Manager (Flight Operations)</li>
                                        <li class="dropdown-item">Fleet Controller</li> --}}
                                    </ul>
                                </div>


                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-first">
                            <p class="d-flex justify-content-between">Job Level<iconify-icon
                                    icon="material-symbols:info-outline" class="info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Job Level"></iconify-icon></p>
                        </td>
                        <td class="text-center table-first">
                            <div class=" d-flex align-items-center gap-1 justify-content-center">
                                <iconify-icon icon="fe:line-chart" class="line-chart"></iconify-icon>
                                <p class="m-0 fs-4 fw-medium">{{ $positionLevel ?? ' ' }}</p>
                            </div>
                        </td>
                        <td class="text-center table-first">
                            <div class=" d-flex align-items-center gap-1 justify-content-center">
                                <iconify-icon icon="fe:line-chart" class="line-chart displayNone" id="positionLevelIcon"></iconify-icon>
                                <p class="m-0 fs-4 fw-medium" id="positionLevel"></p>
                            </div>
                        </td>
                    </tr>
                    {{-- <tr>
                        <td class="table-first">
                            <p class="d-flex justify-content-between">Overall Match Rate<iconify-icon
                                    icon="material-symbols:info-outline" class="info"></iconify-icon></p>
                        </td>
                        <td class="text-center table-first"><span class="{{ config('helpers.talent_insight_positive_levels_class')[$overAllMatchRateResult['overall-match-rate']['level'] ?? 0] }}">{{ config('helpers.overall_match_rate_levels')[$overAllMatchRateResult['overall-match-rate']['level'] ?? 0] }}</span></td>
                        <td class="text-center table-first"><span class="" id="omrResult"></span></td>
                    </tr> --}}
                    <tr>
                        <td class="table-first">
                            <p class="d-flex justify-content-between">Behavioral Fit Rate<iconify-icon
                                    icon="material-symbols:info-outline" class="info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Behavioral Fit Rate"></iconify-icon></p>
                        </td>
                        <td class="text-center table-first"><span class="{{ config('helpers.talent_insight_positive_levels_class')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0] }}">{{ config('helpers.soft_skill_match_rate_levels')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0] }}</span></td>
                        <td class="text-center table-first"><span class="" id="bfrResult"></span></td>
                    </tr>
                    <tr>
                        <td class="table-first">
                            <p class="d-flex justify-content-between">Job Match Rate<iconify-icon
                                    icon="material-symbols:info-outline" class="info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Job Match Rate"></iconify-icon></p>
                        </td>
                        <td class="text-center table-first"><span class="{{ config('helpers.talent_insight_positive_levels_class')[$jobMatchRateResult['job-match-rate']['level'] ?? 0] }}">{{ config('helpers.job_match_rate_levels')[$jobMatchRateResult['job-match-rate']['level'] ?? 0] }}</span></td>
                        <td class="text-center table-first"><span class="" id="jmrResult"></span></td>
                    </tr>
                    <tr>
                        <td class="table-first">
                            <p class="d-flex justify-content-between">Soft Skill Match Rate<iconify-icon
                                    icon="material-symbols:info-outline" class="info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Soft Skill Match Rate"></iconify-icon></p>
                        </td>
                        <td class="text-center table-first"><span class="{{ config('helpers.talent_insight_positive_levels_class')[$softSkillMatchRateResult['ccs-match-rate']['level'] ?? 0] }}">{{ config('helpers.soft_skill_match_rate_levels')[$softSkillMatchRateResult['ccs-match-rate']['level'] ?? 0] }}</span></td>
                        <td class="text-center table-first"><span class="" id="ssmrResult"></span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--end::Panel 5-->

@section('scripts')
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdown = document.querySelector('.dropdown'); // Dropdown container
            const dropdownButton = dropdown.querySelector('.dropdown-button'); // Dropdown button
            const dropdownText = dropdownButton.querySelector('.dropdown-text'); // Dropdown text
            const dropdownMenu = dropdown.querySelector('.dropdown-menu'); // Dropdown menu

            // Toggle dropdown menu visibility when clicking the button
            dropdownButton.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent click from propagating to the document
                dropdownMenu.classList.toggle('visible'); // Toggle visibility class
            });

            // Handle dropdown item clicks using event delegation
            dropdownMenu.addEventListener('click', function(e) {
                if (e.target.classList.contains('dropdown-item')) {
                    const activeItem = dropdownMenu.querySelector('.active');

                    // Remove 'active' class from any previously active item
                    if (activeItem) {
                        activeItem.classList.remove('active');
                    }

                    // Add 'active' class to the clicked item
                    e.target.classList.add('active');

                    // Update the dropdown text (preserving the arrow position)
                    dropdownText.innerHTML = e.target.innerHTML;

                    // Optionally close the dropdown menu after selection
                    dropdownMenu.classList.remove('visible');
                }
            });

            // Close dropdown menu when clicking outside
            document.addEventListener('click', function() {
                dropdownMenu.classList.remove('visible');
            });
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdown = document.querySelector('.dropdown'); // Dropdown container
            const dropdownButton = dropdown.querySelector('.dropdown-button'); // Dropdown button
            const dropdownText = dropdownButton.querySelector('.dropdown-text'); // Dropdown text
            const dropdownMenu = dropdown.querySelector('.dropdown-menu'); // Dropdown menu
    
            // Toggle dropdown menu visibility when clicking the button
            dropdownButton.addEventListener('click', function (e) {
                e.stopPropagation(); // Prevent click from propagating to the document
                dropdownMenu.classList.toggle('visible'); // Toggle visibility class
            });
    
            // Handle dropdown item clicks using event delegation
            dropdownMenu.addEventListener('click', function (e) {
                if (e.target.classList.contains('dropdown-item')) {
                    const activeItem = dropdownMenu.querySelector('.active');
    
                    // Remove 'active' class from any previously active item
                    if (activeItem) {
                        activeItem.classList.remove('active');
                    }
    
                    // Add 'active' class to the clicked item
                    e.target.classList.add('active');
    
                    // Update the dropdown text (preserving the arrow position)
                    dropdownText.innerHTML = e.target.innerHTML;
                    // Call AJAX to fetch data based on the selected item
                    const selectedValue = e.target.getAttribute('data-value') || e.target.textContent.trim();

                    const currentUrl = window.location.href;
                    const employeeId = currentUrl.split('/employee-details/')[1].split('?')[0];
                    
                    fetchComparisonData(selectedValue, employeeId);
    
                    // Optionally close the dropdown menu after selection
                    dropdownMenu.classList.remove('visible');
                    
                }
            });
    
            // Close dropdown menu when clicking outside
            document.addEventListener('click', function () {
                dropdownMenu.classList.remove('visible');
            });
    
            // Function to fetch data and update table cells
            function fetchComparisonData(selectedValue, employeeId) {
                // Show the overlay
               showOverlay();

                const url = `{{ route('admin.employee.details.get_comparison_data') }}?position_id=${encodeURIComponent(selectedValue)}&employee_id=${encodeURIComponent(employeeId)}`;
                
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        // Select table cells
                        const behaviorFitRateCell = document.querySelector('#bfrResult');
                        const jobMatchRateCell = document.querySelector('#jmrResult');
                        const softSkillMatchRateCell = document.querySelector('#ssmrResult');
                        const positionLevelCell = document.querySelector('#positionLevel');

                        // Update the content dynamically based on the data returned
                        if (behaviorFitRateCell) behaviorFitRateCell.textContent = data.data.behaviorFitRate || 'N/A';
                        if (jobMatchRateCell) jobMatchRateCell.textContent = data.data.jobMatchRate || 'N/A';
                        if (softSkillMatchRateCell) softSkillMatchRateCell.textContent = data.data.softSkillMatchRate || 'N/A';
                        if (positionLevelCell) positionLevelCell.textContent = data.data.positionLevel || 'N/A';

                        if (positionLevelCell) {
                            document.getElementById('positionLevelIcon').classList.remove('displayNone');
                        }

                        // Update styles based on data (optional)
                        updateStyles(behaviorFitRateCell, data.data.behaviorFitRateLevel);
                        updateStyles(jobMatchRateCell, data.data.jobMatchRateLevel);
                        updateStyles(softSkillMatchRateCell, data.data.softSkillMatchRateLevel);
                    })
                    .catch(error => {
                        console.error('Error fetching comparison data:', error);
                    })
                    .finally(() => {
                        // Hide the overlay after fetch is complete (success or failure)
                       hideOverlay()
                    });
            }

    
            // Function to update styles based on the match level
            function updateStyles(cell, level) {
                if (!cell) return; // Ensure the cell exists
                cell.className = ''; // Reset existing classes
                if (level === 5 || level === 4) {
                    cell.classList.add('high');
                } else if (level === 3) {
                    cell.classList.add('moderate');
                } else if (level === 2 || level === 1) {
                    cell.classList.add('low');
                } else {
                    cell.classList.add('moderate'); // Default style
                }
            }
        });
    </script>
    
    
@endsection
