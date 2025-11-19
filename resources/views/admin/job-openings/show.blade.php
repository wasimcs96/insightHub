@extends('admin.layout.app')

@section('title', 'Job Advertisement - Detail Page')

@section('styles')
    <style>
        .funnel {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            /* Adjust spacing between stages */
        }

        .stage {
            width: 100%;
            /* Dynamically set via inline style */
            position: relative;
            text-align: center;
        }

        .stage-content {
            background-color: #f7941d;
            /* Use a consistent color for the stages */
            padding: 10px 15px;
            border-radius: 10px;
            color: #ffffff;
            font-weight: bold;
        }

        .funnel-number {
            font-size: 1.25rem;
            /* Larger font size for better visibility */
            display: block;
        }

        @media (max-width: 768px) {
            .funnel {
                gap: 10px;
                /* Adjust spacing for smaller screens */
            }

            .stage-content {
                padding: 8px 12px;
            }

            .funnel-number {
                font-size: 1rem;
            }
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">
            <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
                class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Job Advertisement View
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.job-openings.index') }}" class="text-muted text-hover-primary">Job
                            Advertisement List</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Job Advertisement View</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content  flex-column-fluid position-lg-relative">
        <div id="kt_app_content_container" class="app-container  w-100 " style="margin-top: 120px;">

            <div class="card mb-5 mb-xl-8">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">Job Advertisement Details</h3>
                    <div class="card-toolbar">
                        <a href="{{ route('admin.job-openings.edit-form', $jobOpening->id) }}" class="btn btn-sm btn-info"
                            style="margin-right: 4px;">
                            <iconify-icon icon="mdi:pencil"></iconify-icon> Edit
                        </a>
                        <a href="{{ route('admin.job-openings.index', ['department_id' => session('job_opening_department_id')]) }}"
                            class="btn btn-sm btn-primary">
                            <iconify-icon icon="material-symbols:arrow-back"></iconify-icon> Back To Job Advertisement
                            Dashboard
                        </a>
                    </div>
                </div>
                <div class="card-body py-3">
                    <div class="row mb-8">
                        <div class="col-lg-3">Job Title:</div>
                        <div class="col-lg-9">{{ $jobOpening->job_title ?? '' }}</div>
                    </div>
                    <div class="row mb-8">
                        <div class="col-lg-3">Company:</div>
                        <div class="col-lg-9">{{ $jobOpening->company->name ?? '' }}</div>
                    </div>
                    <div class="row mb-8">
                        <div class="col-lg-3">Department:</div>
                        <div class="col-lg-9">{{ $jobOpening->department->name ?? '' }}</div>
                    </div>
                    <div class="row mb-8">
                        <div class="col-lg-3">Position:</div>
                        <div class="col-lg-9">{{ $jobOpening->job_position->title ?? '' }}</div>
                    </div>
                    <div class="row mb-8">
                        <div class="col-lg-3">Total Vacancies:</div>
                        <div class="col-lg-9">{{ $jobOpening->vacancies ?? '' }}</div>
                    </div>
                    <div class="row mb-8">
                        <div class="col-lg-3">User Type:</div>
                        <div class="col-lg-9">{{ config('helpers.user_type')[$jobOpening->user_type] ?? '' }}</div>
                    </div>
                    <div class="row mb-8">
                        <div class="col-lg-3">Employment Type:</div>
                        <div class="col-lg-9">{{ config('helpers.employment_type')[$jobOpening->employment_type] ?? '' }}
                        </div>
                    </div>
                    <div class="row mb-8">
                        <div class="col-lg-3">Salary: </div>
                        <div class="col-lg-9">₱ {{ $jobOpening->salary_lower_bound ?? 0 }} -
                            {{ $jobOpening->salary_upper_bound ?? 0 }}</div>
                    </div>
                    <div class="row mb-8">
                        <div class="col-lg-3">Work Experience:</div>
                        <div class="col-lg-9">{{ $jobOpening->work_experience ?? '' }} Years</div>
                    </div>
                    <div class="row mb-8">
                        <div class="col-lg-3">Overview of Company:</div>
                        <div class="col-lg-9">{!! $jobOpening->overview_of_company ?? '' !!}</div>
                    </div>
                    <div class="row mb-8">
                        <div class="col-lg-3">Job Role Description:</div>
                        <div class="col-lg-9">{!! $jobOpening->job_role_description ?? '' !!}</div>
                    </div>
                    <div class="row mb-8">
                        <div class="col-lg-3">Education Level:</div>
                        <div class="col-lg-9">{{ $jobOpening->education_level->name ?? '' }}</div>
                    </div>
                    <div class="row mb-8">
                        <div class="col-lg-3">Education Program:</div>
                        <div class="col-lg-9">{{ $jobOpening->education_program->name ?? '' }}</div>
                    </div>
                    <div class="row mb-8">
                        <div class="col-lg-3">Locations:</div>
                        <div class="col-lg-9">
                            @if ($jobOpening->country_id == 135)
                                {{ $jobOpening->country->name ?? '' }} | {{ $jobOpening->barangay->name ?? '' }} |
                                {{ $jobOpening->province->name ?? '' }} | {{ $jobOpening->city->name ?? '' }} |
                                {{ $jobOpening->postal_code ?? '' }}
                            @else
                                {{ $jobOpening->country->name ?? '' }} | {{ $jobOpening->state->name ?? '' }} |
                                {{ $jobOpening->city->name ?? '' }}
                            @endif
                        </div>
                    </div>
                    <div class="row mb-8">
                        <div class="col-lg-3">Job Skills:</div>
                        <div class="col-lg-9">
                            @if ($jobOpening->job_position)
                                @foreach ($jobOpening->job_position->skills as $key => $value)
                                    <span type="button"
                                        class="badge badge-success mt-4">{{ $value->title ?? '' }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="row mb-8">
                        <div class="col-lg-3">Required Technical Skills:</div>
                        <div class="col-lg-9">
                            @if ($jobOpening->job_position)
                                @foreach ($jobOpening->job_position->technicalSkills as $key => $value)
                                    <span type="button" class="badge badge-success mt-4">{{ $value->name ?? '' }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @php
                $jobOpeningStatusWiseCounts = $jobOpening->getApplicantCountByStatuses();
                $offerConversionRate = 0;

                if ($jobOpeningStatusWiseCounts[7] || $jobOpeningStatusWiseCounts[8]) {
                    $offerConversionRate =
                        ($jobOpeningStatusWiseCounts[8] /
                            ($jobOpeningStatusWiseCounts[7] + $jobOpeningStatusWiseCounts[8])) *
                        100;
                }

                $salaryVariant = $jobOpening->getSalaryVariant();
            @endphp
            <div class="card mb-5 mb-xl-8">
                <div class="card-header border-0 pt-5 d-flex justify-content-between align-items-center">
                    <h3 class="card-title align-items-start flex-column">
                        Recruitment Funnel
                    </h3>
                    <div class="d-flex align-items-center">
                        <h5 class="text-muted me-4">
                            Offer Conversion Rate: {{ $offerConversionRate ?? '0' }}%
                        </h5>
                        <h5 class="text-muted">
                            Salary Variant: {{ $salaryVariant ?? '0' }}
                        </h5>
                    </div>
                </div>
                <div class="card-body py-3">
                    <div class="funnel">
                        @foreach ([['label' => 'Applicants', 'count' => $jobOpeningStatusWiseCounts[0] ?? 0, 'width' => '100%'], ['label' => 'Pending', 'count' => $jobOpeningStatusWiseCounts[1] ?? 0, 'width' => '90%'], ['label' => 'Assessment Pending', 'count' => $jobOpeningStatusWiseCounts[2] ?? 0, 'width' => '80%'], ['label' => 'Assessment Completed', 'count' => $jobOpeningStatusWiseCounts[3] ?? 0, 'width' => '70%'], ['label' => 'Shortlisted', 'count' => $jobOpeningStatusWiseCounts[4] ?? 0, 'width' => '60%'], ['label' => 'Interview Scheduled', 'count' => $jobOpeningStatusWiseCounts[5] ?? 0, 'width' => '50%'], ['label' => 'Interview Completed', 'count' => $jobOpeningStatusWiseCounts[6] ?? 0, 'width' => '40%'], ['label' => 'Contract Issued', 'count' => $jobOpeningStatusWiseCounts[7] ?? 0, 'width' => '30%'], ['label' => 'Hired', 'count' => $jobOpeningStatusWiseCounts[8] ?? 0, 'width' => '20%']] as $stage)
                            <div class="stage" style="width: {{ $stage['width'] }};">
                                <div class="stage-content">
                                    <span class="funnel-number">{{ $stage['count'] }}</span>
                                    <br>{{ $stage['label'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all checkboxes
            document.getElementById('selectAll').addEventListener('change', function() {
                let checkboxes = document.querySelectorAll('input[name="user_ids[]"]');
                checkboxes.forEach((checkbox) => {
                    checkbox.checked = this.checked;
                });
            });

            // Handle form submission
            document.getElementById('sendEmailsButton').addEventListener('click', function() {
                let form = document.getElementById('applicantSelectionForm');
                let checkboxes = document.querySelectorAll('input[name="user_ids[]"]:checked');

                if (checkboxes.length > 0) {
                    // If at least one checkbox is selected, submit the form
                    form.submit();
                } else {
                    // If no checkboxes are selected, show an alert to the user
                    alert(
                        'Please select at least one applicant from listing below through checkboxes to send emails.');
                }
            });

        });
    </script>
@endsection
