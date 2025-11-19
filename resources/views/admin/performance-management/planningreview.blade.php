@extends('admin.layout.app')

@section('title', 'Review Details')
@section('styles')
<style>
    /* Your existing styles here */
</style>
@endsection

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Dashboard
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">Admin</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                @php
                $routeName = Route::currentRouteName();
                $title = ($routeName == 'admin.candidate.details') ? 'Candidate Details' : 'Review Details';
                @endphp
                <li class="breadcrumb-item text-muted">{{ $title }}</li>
            </ul>
        </div>
    </div>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card mb-5 mb-xl-10">
            <div class="card-body pt-9 pb-0">
                <div class="d-flex flex-wrap flex-sm-nowrap">
                    <div class="me-7 mb-4">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                            <img src="{{ asset($employee->profile_picture ?? '') }}" onerror="this.src='{{ asset('images/default-user.svg') }}'" alt="image" />
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $employee->first_name ?? '' }} {{ $employee->middle_name ?? '' }} {{ $employee->last_name ?? '' }}
                                        @if (isset($growth_potential_result))
                                        @if (strtolower($growth_potential_result) == 'super high')
                                        <iconify-icon icon="codicon:verified-filled" class="toolTip onTop ml-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Super High Potential " style="background: #08d36e; border-radius: 50%;"></iconify-icon>
                                        @elseif (strtolower($growth_potential_result) == 'very high')
                                        <iconify-icon icon="codicon:verified-filled" class="toolTip onTop ml-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Very High Potential " style="background: #1E90FF; border-radius: 50%;"></iconify-icon>
                                        @elseif (strtolower($growth_potential_result) == 'high')
                                        <iconify-icon icon="codicon:verified-filled" class="toolTip onTop ml-2" data-bs-toggle="tooltip" data-bs-placement="top" title="High Potential " style="background: #FFA500; border-radius: 50%;"></iconify-icon>
                                        @else
                                        <iconify-icon icon="solar:verified-check-broken" class="toolTip onTop ml-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Average Potential " style="background: #9ba9a2; border-radius: 50%;"></iconify-icon>
                                        @endif
                                        @endif
                                    </a>
                                </div>
                                <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-2">
                                        Job Title : {{ $employee->job_position->title ?? $employee->job_title ?? '' }}
                                    </a>
                                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-2">
                                        |
                                    </a>
                                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me">
                                        Department: {{ $employee->department->name ?? 'N/A' }}
                                    </a>
                                </div>
                                <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-2">
                                        Section: {{ $employee->departmentSection->name ?? 'N/A' }}
                                    </a>
                                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-2">
                                        |
                                    </a>
                                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me">
                                        Unit: {{ $employee->sectionUnit->name ?? 'N/A' }}
                                    </a>
                                </div>
                                <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-2">
                                        Emp ID: #EMP{{ $employee->id ?? 'N/A' }}
                                    </a>
                                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-2">
                                        |
                                    </a>
                                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me">
                                        Date of Hire: {{ \Carbon\Carbon::parse($employee->date_of_hire)->format('F d, Y') ?? 'N/A' }}
                                    </a>
                                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-2">
                                        |
                                    </a>
                                    <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me">
                                        Employment Status: {{ config('constants.EMPLOYMENT_STATUSES.'.$employee->employment_status) ?? 'Full Time' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap flex-stack">
                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                <div class="d-flex flex-wrap"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="tab" href="#kt_tab_pane_2">
                            KPI Ratings
                        </a>
                    </li>
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#kt_tab_pane_3">
                            Technical Skills
                        </a>
                    </li>
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#kt_tab_pane_4">
                            Soft Skills
                        </a>
                    </li>
                    @if($managerApproved && !$review->approved)
                    <li class="mt-2 ms-auto">
                        <button type="button" class="btn btn-primary" id="approvalButton" data-kpi-id="{{ $review->id }}">
                            Approval
                        </button>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="tab-content" id="myTabContent">
            <!-- KPI Ratings Tab -->
            <div class="card h-full tab-pane fade show active" id="kt_tab_pane_2" role="tabpanel">
                <header class="card-header align-items-center">
                    <h4 class="card-title">KPI Skills Ratings</h4>
                    <div class="d-flex" style="align-items: center;"></div>
                </header>
                <div class="card-body p-6">
                    <table class="table table-striped">
                        @php
                        $totalKpi = 0;
                        @endphp
                        @foreach($kpis as $index => $objective)
                        <thead>
                            <tr>
                                <td colspan="2" class="fw-bold">Objectives: {{ $objective->objectives }}</td>
                                <td colspan="1" class="fw-bold text-end">Weightage: {{ $objective->weightage }}%</td>
                            </tr>
                            <tr>
                                <th>KPI</th>
                                <th>Employee Planning</th>
                                <th>Base Target</th>
                                <th>Stretch Target</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $sumKpiRatings = 0;
                            $kpiCount = count($objective->keys);
                            @endphp
                            @foreach($objective->keys as $keyIndex => $keys)
                            @php
                            $sumKpiRatings += $keys->rank;
                            @endphp
                            <tr>
                                <td>{{ $keys->kpi }}</td>
                                <td>{{ $keys->employee_planning ?? 'N/A' }}</td>
                                <td>{{ $keys->base_target ?? 'N/A' }}</td>
                                <td>{{ $keys->stretch_target ?? 'N/A' }}</td>
                                @endforeach
                                @php
                                $objectiveWeightage = $objective->weightage;
                                $averageKpiRating = $kpiCount > 0 ? ($sumKpiRatings / $kpiCount) : 0;
                                $weightedKpiRating = ($averageKpiRating * $objectiveWeightage) / 100;
                                $totalKpi += $weightedKpiRating;
                                @endphp
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>

            <!-- Technical Skills Tab -->
            <div class="card h-full tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                <header class="card-header align-items-center">
                    <h4 class="card-title">Technical Skills Ratings</h4>
                    <div class="d-flex" style="align-items: center;"></div>
                </header>
                <div class="card-body p-6">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Skill</th>
                                <th>Minimal Level</th>
                                <th>Gap</th>
                                <th>Employee Planning</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $totalTechnical = 0;
                            $countTechnical = 0;
                            @endphp
                            @foreach($technicalSkills as $index => $skill)
                            @php
                            $minimalSkill = $minimalTech->firstWhere('name', $skill->name);
                            $jdRating = $minimalSkill ? $minimalSkill['pivot']['level'] : 1;
                            $arRating = $skill->level ?? 1;
                            $percentage = $arRating < $jdRating ? ($arRating / $jdRating) * 100 : 100;
                                $totalTechnical +=$percentage;
                                $countTechnical++;
                                $gap=$arRating - $jdRating;
                                @endphp
                                <tr>
                                <td>{{ $skill->name }}</td>
                                <td>{{ $jdRating }}</td>
                                <td>{{ $gap }}</td>
                                <td>{{ $skill->remark }}</td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Soft Skills Tab -->
            <div class="card h-full tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
                <header class="card-header align-items-center">
                    <h4 class="card-title">Soft Skills Review</h4>
                    <div class="d-flex" style="align-items: center;"></div>
                </header>
                <div class="card-body p-6">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Skill</th>
                                <th>Minimal Level</th>
                                <th>Gap</th>
                                <th>Employee Planning</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $totalSoft = 0;
                            $countSoft = 0;
                            @endphp
                            @foreach($softSkills as $index => $skill)
                            @php
                            $minimalSkill = $minimalSoft->firstWhere('title', $skill->name);
                            $jdRating = $minimalSkill ? $minimalSkill['level'] : 1;
                            $arRating = $skill->level ?? 1;
                            $percentage = $arRating < $jdRating ? ($arRating / $jdRating) * 100 : 100;
                                $totalSoft +=$percentage;
                                $countSoft++;
                                $gap=$arRating - $jdRating;
                                @endphp
                                <tr>
                                <td>{{ $skill->name }}</td>
                                <td>{{ $jdRating }}</td>
                                <td>{{ $gap }}</td>
                                <td>{{ $skill->remark }}</td>
                                </tr>
                                @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="remarksModal" tabindex="-1" aria-labelledby="remarksModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="remarksModalLabel">Add Manager Evaluation for <span id="skillName"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="remarksForm" method="POST" action="{{ route('admin.performance.management.saveRemarks') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="skill_id" id="skillId">
                    <div class="mb-3">
                        <label for="remarks" class="form-label">Manager Evaluation</label>
                        <textarea class="form-control" id="remarks" name="manager_evaluation" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Manager Rating</label>
                        <div class="d-flex justify-content-between">
                            @for ($i = 1; $i <= 4; $i++) <div class="form-check">
                                <input class="form-check-input" type="radio" id="manager_rating_{{ $i }}" name="manager_rating" value="{{ $i }}">
                                <label class="form-check-label" for="manager_rating_{{ $i }}">{{ $i }}</label>
                        </div>
                        @endfor
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>
</div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0"></script>
<script>
    document.getElementById('backButton').addEventListener('click', function() {
        history.back();
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var remarksModal = new bootstrap.Modal(document.getElementById('remarksModal'));

        document.querySelectorAll('.remarks').forEach(function(button) {
            button.addEventListener('click', function() {
                var skillId = this.getAttribute('data-skill-id');
                var skillName = this.getAttribute('data-skill-name');

                document.getElementById('skillId').value = skillId;
                document.getElementById('skillName').textContent = skillName;

                // Fetch previous evaluation and rating
                fetch(`/admin/performance-management/getSkillEvaluation/${skillId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            // Check and set manager_evaluation if available
                            document.getElementById('remarks').value = data.manager_evaluation || '';

                            // Uncheck all radio buttons first
                            document.querySelectorAll('input[name="manager_ratings"]').forEach(radio => {
                                radio.checked = false;
                            });
                            // Check the previous rating if available
                            if (data.manager_ratings) {
                                let ratingElement = document.getElementById(`manager_rating_${data.manager_ratings}`);
                                if (ratingElement) {
                                    ratingElement.checked = true;
                                }
                            } else {
                                document.getElementById('manager_rating_1').checked = true; // Default to 1
                            }

                            // Change button to green if evaluation exists
                            if (data.manager_evaluation) {
                                button.classList.add('btn-success');
                            } else {
                                button.classList.remove('btn-success');
                            }
                        } else {
                            // Clear the form if no data found
                            document.getElementById('remarks').value = '';
                            document.querySelectorAll('input[name="manager_rating"]').forEach(radio => {
                                radio.checked = false;
                            });
                            document.getElementById('manager_rating_1').checked = true; // Default to 1

                            // Remove green class if no evaluation exists
                            button.classList.remove('btn-success');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching skill evaluation:', error);
                        // Clear the form in case of error
                        document.getElementById('remarks').value = '';
                        document.querySelectorAll('input[name="manager_rating"]').forEach(radio => {
                            radio.checked = false;
                        });
                        document.getElementById('manager_rating_1').checked = true; // Default to 1

                        // Remove green class in case of error
                        button.classList.remove('btn-success');
                    });

                remarksModal.show();
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('approvalButton').addEventListener('click', function() {
        const kpiId = this.getAttribute('data-kpi-id'); // Get KPI ID from the button's data attribute

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to approve this KPI?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approve it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Construct the correct URL with the KPI ID
                const url = `{{ url('admin/performance-management/update-planning') }}/${kpiId}`;

                // Send the KPI ID to the server for approval
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ approved: 1 })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Approved!',
                            'The KPI has been approved successfully.',
                            'success'
                        ).then(() => {
                            location.reload(); // Reload the page or redirect as needed
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            'There was an error approving the KPI.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    Swal.fire(
                        'Error!',
                        'There was an error processing your request.',
                        'error'
                    );
                    console.error('Error:', error);
                });
            }
        })
    });
</script>


@endsection
