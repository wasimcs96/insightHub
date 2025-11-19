@extends('admin.layout.app')

@section('title', 'Job Advertisement - Detail Page')

@section('styles')
    <style>
        .status-bread {
            font-family: Arial, sans-serif;
            font-size: 16px;
            display: flex;
            align-items: center;
        }

        .status-bread a {
            text-decoration: none;
            color: #666;
            padding: 0 2px;
            position: relative;
            font-weight: 500;
        }

        .status-bread a.active {
            color: #000;
            /* font-weight: bold; */
        }

        .status-bread a.active::after {
            content: "";
            display: block;
            width: 100%;
            height: 2px;
            background-color: #FF6C00;
            position: absolute;
            bottom: -2px;
            left: 0;
        }

        .status-bread span {
            color: #666;
            padding: 0 12px;

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
                    Job Applicants
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
                            Opening</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Job Applicants</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content  flex-column-fluid position-lg-relative">
        <div id="kt_app_content_container" class="app-container  w-100 " >
            <div class="card mb-5 mb-xl-8 p-4">
                <div class="row mb-8">
                    <div class="col-lg-3 text-gray-900 fw-bold fs-5">Job Title:</div>
                    <div class="col-lg-9 text-gray-900 fw-bold fs-7">{{ $jobOpening->job_title ?? '' }}</div>
                </div>

                <div class="row mb-0">
                    <div class="col-lg-3 text-gray-900 fw-bold fs-5">Department:</div>
                    <div class="col-lg-9 text-gray-900 fw-bold fs-7">{{ $jobOpening->department->name ?? '' }}</div>
                </div>

            </div>
            <div class="card mb-5 mb-xl-8">
                <div class="card-header border-0 ">
                    <h3 class="card-title align-items-start flex-column">List of Applicants</h3>

                </div>

                <div class=" card-body">
                   
                    <div class="status-bread" >
                        <a href="?status=" class="fs-5 fw-semibold @if (request('status') == null) active @endif">All
                            Applicants [<span class="text-primary p-0">{{ $statusCounts->sum()}}</span>]</a>
                        <span><iconify-icon icon="solar:alt-arrow-right-line-duotone"></iconify-icon>
                        </span>
                        
                        @foreach (config('helpers.application_status') as $key => $ep)
                       
                            <a href="?status={{ $key }}"
                                class="fs-5 fw-semibold @if (request('status') == $key) active @endif">{{ $ep }} [<span class="text-primary p-0">{{ $statusCounts[$key] ?? 0 }}</span>]</a>
                                
                            @if ($key != 8)
                                <span><iconify-icon icon="solar:alt-arrow-right-line-duotone"></iconify-icon>
                                </span>
                            @endif
                        @endforeach
                        {{-- <a href="?status=" class="fs-1 fw-semibold @if (request('status') == null) active @endif">All
                            Applicants</a>
                        <span><iconify-icon icon="solar:alt-arrow-right-line-duotone" class="fa-1-5"></iconify-icon></span>
                        <a href="?status=1"
                            class="fs-1 fw-semibold @if (request('status') == 1) active @endif">Pending</a>
                        <span><iconify-icon icon="solar:alt-arrow-right-line-duotone" class="fa-1-5"></iconify-icon></span>

                        <a href="?status=3"
                            class="fs-1 fw-semibold @if (request('status') == 3) active @endif">Assessment</a>
                        <span><iconify-icon icon="solar:alt-arrow-right-line-duotone" class="fa-1-5"></iconify-icon></span>

                        <a href="?status=4"
                            class="fs-1 fw-semibold @if (request('status') == 4) active @endif">Shortlisted</a>
                        <span><iconify-icon icon="solar:alt-arrow-right-line-duotone" class="fa-1-5"></iconify-icon></span>

                        <a href="?status=5"
                            class="fs-1 fw-semibold @if (request('status') == 5) active @endif">Interview</a>
                        <span><iconify-icon icon="solar:alt-arrow-right-line-duotone" class="fa-1-5"></iconify-icon></span>
                        <a href="?status=7"
                            class="fs-1 fw-semibold @if (request('status') == 7) active @endif">Offer</a> --}}
                    </div>
                    <div class="mt-15">

                        <form class="row justify-content-end" action="">
                            <input type="hidden" name="status" value="{{ request('status') }}">
                            <div class="col-lg-2">
                                <label class="form-label">Candidate Name</label>

                                <input type="text" class="form-control" name="candidate_name"
                                    value="{{ request('candidate_name') }}" placeholder="Filter by Candidate name">
                            </div>
                            <div class="col-lg-2">
                                <label class="form-label">Suitablity Rate</label>

                                <input type="number" class="form-control" step="0.01" name="suitability_rate"
                                    value="{{ request('suitability_rate') }}" placeholder="Filter by Suitablity rate">
                                <small class="text-danger">Equal to or greater than.</small>
                            </div>

                            <div class="col-lg-2">
                                <label class="form-label">Nationality</label>


                                <select class="form-select form-control-solid" data-close-on-select="false"
                                    data-placeholder="Select option" name="nationality" data-allow-clear="true">

                                    <option value=""
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Select Nationality</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id ?? '' }}"
                                            @if ($country->id == request('nationality')) selected @endif
                                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            {{ $country->name ?? '' }}
                                        </option>
                                    @endforeach




                                </select>
                            </div>

                            {{-- <div class="col-lg-2">
                                <label class="form-label">Current Location</label>

                                <select class="form-select form-control-solid" name="employment_type">
                                    <option value=""
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        All</option>
                                    <option value="1">Full-Time</option>
                                    <option value="2">Part-Time</option>
                                    <option value="3">Probationary</option>
                                    <option value="4">Contractual</option>
                                </select>
                            </div> --}}

                            <div class="col-lg-2">
                                <label class="form-label">Highest Education</label>

                                <select class="form-select form-control-solid" name="education_level">
                                    <option value=""
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        All</option>
                                    @foreach ($highest_education as $highest)
                                        <option value="{{ $highest->id ?? '' }}"
                                            @if ($highest->id == request('education_level')) selected @endif
                                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            {{ $highest->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-2">
                                <label class="form-label">Sort By</label>
                                <select class="form-select form-control-solid" name="sort">
                                    <option value="" selected="">Sort</option>
                                    <option value="expected_salary" @if (request('sort') == 'expected_salary') selected @endif>
                                        Expected Salary</option>
                                    <option value="suitability_rate" @if (request('sort') == 'suitability_rate') selected @endif>
                                        Suitability Rate</option>
                                    <option value="experience" @if (request('sort') == 'experience') selected @endif>Year of
                                        Experience</option>
                                </select>
                            </div>

                            <div class="col-lg-2">
                                <label class="form-label">Sort Type</label>
                                <select class="form-select form-control-solid" name="sort_type">
                                    <option value="desc" @if (request('sort_type') == 'desc') selected @endif>Desc
                                    </option>
                                    <option value="asc" @if (request('sort_type') == 'asc') selected @endif>Asc</option>
                                </select>
                            </div>




                            <div class="align-items-center col-lg-4 d-flex justify-content-end mt-5">
                                
                                <button type="submit" class="btn btn-sm btn-icon btn-light-primary me-3"
                                    data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Filter"
                                    data-bs-original-title="Filter" data-kt-initialized="1">
                                    <iconify-icon icon="mdi:filter"></iconify-icon>
                                </button>
                                <a href="/admin/job-applicant/{{ $jobOpening->id ?? '' }}"
                                    class="btn btn-sm btn-icon btn-light" data-bs-toggle="tooltip"
                                    data-bs-placement="top" aria-label="Reset" data-bs-original-title="Reset"
                                    data-kt-initialized="1">
                                    <iconify-icon icon="bx:reset" class="fa-2x"></iconify-icon>
                                </a>
                                @if (request('status') != null)
                                <div class="ms-3">
                                    <select id="bulkAction" class="form-select form-control-solid w-auto bg-primary py-2 text-dark">
                                        <option value="">Bulk Actions</option>
                                        @if (request('status') > '2')
                                            <option value="compare">Compare</option>
                                        @endif
                                        @if (request('status') == '1')
                                            <option value="send_assessment">Send Assessment</option>
                                        @endif
                                        @if (request('status') == '3')
                                            <option value="shortlist">Shortlist</option>
                                        @endif
                                    </select>
                                </div>
                            @endif
                            </div>
                        </form>

                    </div>
                    <div class="mt-8">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th></th>

                                        <th class="min-w-125px text-center">Name</th>
                                        <th class="min-w-125px text-center">Email</th>


                                        <th class="min-w-125px text-center">Nationality</th>
                                        {{-- <th class="min-w-125px text-center">Prefered location</th> --}}

                                        <th class="min-w-125px text-center">Expected Salary</th>

                                        <th class="min-w-125px text-center">Highest Education</th>
                                        <th class="min-w-125px text-center">Education Program</th>
                                        <th class="min-w-125px text-center">Years of Experience</th>

                                        <th class="min-w-125px text-center">Applicant Status</th>
                                        <th class="min-w-125px text-center">Status</th>

                                        <th class="min-w-125px text-center">Suitability Rate</th>


                                        <th></th>

                                    </tr>
                                </thead>
                                <!--end::Table head-->

                                <!--begin::Table body-->
                                <tbody>
                                    @foreach ($jobOpeningApplications as $value)
                                        {{-- {{ dd($value) }} --}}
                                        @if($value->status != 9)
                                        <tr>
                                            <td>
                                                @if ($value->application_status == 1)
                                                    <div
                                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="applicant_ids[]" value="{{ $value->id }}" />
                                                    </div>
                                                @endif
                                            </td>
                                            <td>

                                                <a href="{{ route('admin.job-opening.applicant-details', ['job_opening_application_id' => $value->id, 'id' => $value->user->id]) }}"
                                                    target="_blank"
                                                    class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">
                                                    {{ $value->user->name ?? '' }}
                                                </a>
                                            </td>
                                            <td>

                                                <span
                                                    class="text-gray-900 text-center fw-bold  d-block mb-1 fs-6">
                                                    {{ $value->user->email ?? '' }}
                                                </span>
                                            </td>

                                            <td>
                                                <span
                                                    class="text-gray-900 text-center fw-bold  d-block mb-1 fs-6">
                                                    {{ $value->user->country->name ?? '' }}

                                                </span>
                                            </td>

                                            {{-- <td>
                                            <span
                                                class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{$value->user->city->name ?? ''}}</span>
                                            </td> --}}



                                            <td>
                                                <span
                                                    class="text-gray-900 text-center fw-bold d-block mb-1 fs-6">{{ $value->expected_salary ?? '' }}</span>
                                            </td>

                                            <td>
                                                <span
                                                    class="text-gray-900 text-center fw-bold  d-block mb-1 fs-6">{{ $value->user->education_level_check->name ?? '' }}
                                                </span>
                                            </td>


                                            <td>
                                                <span
                                                    class="text-gray-900 text-center fw-bold  d-block mb-1 fs-6">{{ $value->user->program->name ?? 'N/A' }}</span>
                                            </td>


                                            <td>
                                                <span
                                                    class="text-gray-900 text-center fw-bold  d-block mb-1 fs-6">{{ $value->user->year_of_experience_in_it_sector ?? '' }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-gray-900 text-center fw-bold  d-block mb-1 fs-6">
                                                    @if ($value->application_status == 0)
                                                        Withdrew
                                                    @else
                                                        Applied
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <span
                                                    class="text-gray-900 text-center fw-bold  d-block mb-1 fs-6">
                                                    {{ config('helpers.application_status')[$value->status] }}
                                                </span>
                                            </td>

                                            <td>
                                                <span
                                                    class="text-gray-900 text-center fw-bold  d-block mb-1 fs-6">
                                                    {{-- {{ $value->matching_percentage ?? '' }} --}}
                                                    @php 
                                                      $suitability_rate = $value->matching_percentage ?? 50;

                                                        if ($suitability_rate > 90) {
                                                            $suitability_rate_level = 5;
                                                        } elseif ($suitability_rate > 75 && $suitability_rate <= 90) {
                                                            $suitability_rate_level = 4;
                                                        } elseif ($suitability_rate >= 60 && $suitability_rate <= 75) {
                                                            $suitability_rate_level = 3;
                                                        } elseif ($suitability_rate >= 45 && $suitability_rate < 60) {
                                                            $suitability_rate_level = 2;
                                                        } else {
                                                            $suitability_rate_level = 1;
                                                        }

                                                    @endphp
                                                    {{config('helpers.suitability_rate_levels')[$suitability_rate_level] }}
                                                </span>
                                            </td>


                                            <td class="text-center">

                                                <div class="me-0">
                                                    <button
                                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary"
                                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">

                                                        <iconify-icon icon="iconamoon:menu-kebab-vertical-bold"
                                                            class="fa-1-5"></iconify-icon>
                                                    </button>

                                                    <!--begin::Menu 3-->
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light- primary fw-semibold w-200px py-3"
                                                        data-kt-menu="true" style="">
                                                        <!--begin::Heading-->
                                                        <div class="menu-item px-3">
                                                            <div
                                                                class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                                                Actions
                                                            </div>
                                                        </div>
                                                        <!--end::Heading-->

                                                        <!--begin::Menu item-->
                                                        @if ($value->status == 4)
                                                            <div class="menu-item px-3">
                                                                <a href="javascript:void(0);" data-bs-toggle="modal"
                                                                    data-bs-target="#kt_modal_1" class="menu-link px-3"
                                                                    data-application-id="{{ $value->id }}"
                                                                    data-interview-datetime="{{ $value->interview_date ?? '' }}"
                                                                    data-interview-description="{{ $value->interview_description ?? '' }}"
                                                                    data-interviewer-name="{{ $value->interviewer_name ?? '' }}"
                                                                    data-interview-mode="{{ $value->interview_mode ?? '2' }}"
                                                                    data-interview-link="{{ $value->interview_link ?? '' }}"
                                                                    data-interview-address="{{ $value->interview_address ?? '' }}"
                                                                    onclick="populateInterviewModal(this)">

                                                                    Schedule Interview
                                                                </a>

                                                            </div>
                                                        @endif
                                                        @if ($value->status == 5)
                                                            <div class="menu-item px-3">
                                                                <a href="{{ url('admin/talent-acquisition/candidate-screening/conduct-interview') }}?application_id={{ $value->id }}"
                                                                    class="menu-link px-3">
                                                                    Conduct Interview
                                                                </a>
                                                            </div>
                                                        @endif

                                                        @if ($value->status == 6)
                                                            <div class="menu-item px-3">
                                                                <a href="javascript:void(0);" data-bs-toggle="modal"
                                                                    data-bs-target="#kt_modal_2" class="menu-link px-3"
                                                                    data-offer-application-id="{{ $value->id }}"
                                                                    onclick="populateContractModal(this)">
                                                                    Send Offer
                                                                </a>

                                                            </div>
                                                        @endif

                                                        @if ($value->status == 7)
                                                            <div class="menu-item px-3">
                                                                <a href="{{ $value->contract->contract_pdf ?? '' }}"
                                                                    target="_blank" class="menu-link px-3"
                                                                    onclick="populateContractModal(this)">
                                                                    View Offer letter
                                                                </a>

                                                            </div>


                                                            <div class="menu-item px-3">
                                                                <a href="javascript:void(0);" data-bs-toggle="modal"
                                                                    data-bs-target="#kt_modal_2" class="menu-link px-3"
                                                                    data-offer-application-id="{{ $value->id }}"
                                                                    onclick="populateContractModal(this)">
                                                                    Resend Offer
                                                                </a>

                                                            </div>
                                                        @endif

                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#deleteConfirmationModal"
                                                                data-delete-url="/admin/job-applicant/delete/{{ $value->id ?? '' }}"
                                                                class="menu-link px-3">
                                                                Remove Application
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->

                                                    </div>
                                                    <!--end::Menu 3-->
                                                </div>
                                            </td>

                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                            {{ $jobOpeningApplications->appends(request()->query())->links() }}

                            <div class="d-flex justify-content-end">
                                <a class="btn btn-sm btn-bg-light btn-active-color-primary d-flex me-4"
                                    @if (request('status') != null && request('status') == 1) disabled @endif
                                    href="?status={{ request('status') - 1 }}"> <iconify-icon
                                        icon="solar:alt-arrow-left-line-duotone" class="fa-1-5"></iconify-icon>Previous
                                    Step </a>

                                <a class="btn btn-sm btn-bg-light btn-active-color-primary d-flex"
                                    @if (request('status') == 8) disabled @endif
                                    href="?status={{ request('status') + 1 }}">Next Step <iconify-icon
                                        icon="solar:alt-arrow-right-line-duotone" class="fa-1-5"></iconify-icon></a>

                            </div>

                        </div>


                        <!--end::Table container-->
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- Schedule Interview start --}}

    <div class="modal fade" tabindex="-1" id="kt_modal_1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Create Interview</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <iconify-icon icon="radix-icons:cross-1" class="ki-cross fs-1"></iconify-icon>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.job-opening.applicant-interview-schedule') }}" id="interviewForm"
                        method="post">
                        @csrf
                        <input type="hidden" name="application_id" class="form-control bg-transparent"
                            id="application_id" value="" required />

                        <div class="fv-row mb-8">
                            <label class="form-label mb-3">Interview Date Time</label>
                            <input type="datetime-local" value="" name="interview_datetime"
                                class="form-control bg-transparent" id="interview_datetime" required />
                            <div class="invalid-feedback" id="datetime_error"></div>
                        </div>

                        <div class="fv-row mb-8">
                            <label class="form-label mb-3">Interview Description</label>
                            <textarea placeholder="Enter Interview description" name="interview_description" class="form-control bg-transparent"
                                id="interview_description" required></textarea>
                            <div class="invalid-feedback" id="description_error"></div>
                        </div>

                        <div class="fv-row mb-8">
                            <label class="form-label mb-3">Interviewer Name</label>
                            <input type="text" placeholder="Enter Interviewer name" value=""
                                name="interviewer_name" class="form-control bg-transparent" id="interviewer_name"
                                required />
                            <div class="invalid-feedback" id="interviewer_name_error"></div>
                        </div>

                        <div class="fv-row mb-8">
                            <label class="form-label mb-3">Interview Mode</label>
                            <select class="form-control" name="interview_mode" id="interview_mode">
                                <option value="2">Online</option>
                                <option value="1">Physical
                                </option>
                            </select>
                            <div class="invalid-feedback" id="interview_mode_error"></div>
                        </div>

                        <!-- Interview Link Field -->
                        <div class="fv-row mb-8" id="interview_link_container">
                            <label class="form-label mb-3">Interview Link</label>
                            <input type="url" placeholder="Enter Interview link" value=""
                                name="interview_link" class="form-control bg-transparent" id="interview_link" />
                            <div class="invalid-feedback" id="link_error"></div>
                        </div>

                        <!-- Interview Address Field -->
                        <div class="fv-row mb-8" id="interview_address_container" style="display:none;">
                            <label class="form-label mb-3">Interview Address</label>
                            <input type="text" placeholder="Enter Interview Address" value=""
                                name="interview_address" class="form-control bg-transparent" id="interview_address" />
                            <div class="invalid-feedback" id="address_error"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Schedule Interview end --}}


    {{-- Offer Template start --}}

    <div class="modal fade" tabindex="-1" id="kt_modal_2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Select Contract Template</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <iconify-icon icon="radix-icons:cross-1" class="ki-cross fs-1"></iconify-icon>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.contract.template.select') }}" id="templateform" method="post">
                        @csrf
                        <input type="hidden" name="application_id" class="form-control bg-transparent"
                            id="offerLetterapplication_id" value="" required />

                        @php $templates = App\Models\ContractTemplate::get();@endphp

                        <div class="fv-row mb-8">
                            <label class="form-label mb-3">Select Contract Template</label>
                            <select class="form-control" name="template_id">
                                @foreach ($templates as $template)
                                    <option value="{{ $template->id ?? '' }}">{{ $template->name ?? '' }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="description_error"></div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"
                        onclick="document.getElementById('templateform').submit();">Create Contract</button>
                </div>
            </div>
        </div>
    </div>
    {{--  Offer Template end --}}

    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this job opening?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteJobOpeningForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                        'Please select at least one applicant from listing below through checkboxes to send emails.'
                    );
                }
            });

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle bulk action dropdown change
            document.getElementById('bulkAction').addEventListener('change', function() {
                let selectedAction = this.value;
                let selectedApplicants = document.querySelectorAll('input[name="applicant_ids[]"]:checked');
                let jobOpeningId = {{ $jobOpening->id ?? '' }};
                console.log('asdfadsf', jobOpeningId);
                if (selectedApplicants.length === 0) {
                    alert('Please select at least one applicant to perform the action.');
                    return;
                }

                let selectedIds = Array.from(selectedApplicants).map(applicant => applicant.value);
                console.log("selectedIds")

                if (selectedAction === '') {
                    alert('Please select an action.');
                    return;
                }
                console.log(selectedIds)
                // Perform action based on selected bulk action
                switch (selectedAction) {
                    case 'compare':
                        redirectToAction('/admin/job-opening/compare/', selectedIds, jobOpeningId);
                        break;
                    case 'send_assessment':
                        redirectToAction('/admin/job-opening/send-emails-to-selected', selectedIds,
                            jobOpeningId);
                        break;
                    case 'shortlist':
                        redirectToAction('/admin/job-applicant/shortlist/candidates', selectedIds,
                            jobOpeningId);
                        break;
                    default:
                        alert('Invalid action.');
                }
            });

            // Function to handle redirection with selected applicants
            function redirectToAction(url, ids, jobOpeningId) {
                // Convert the selected IDs to a query string parameter
                let queryString = ids.map(id => `applicant_ids[]=${id}`).join('&');
                queryString += `&job_opening_id=${jobOpeningId}`;
                window.location.href = `${url}?${queryString}`;
            }
        });
    </script>

    <script>
        document.getElementById('saveChanges').addEventListener('click', function() {
            let valid = true;

            // Clear previous errors
            document.getElementById('datetime_error').textContent = '';
            document.getElementById('description_error').textContent = '';
            document.getElementById('link_error').textContent = '';
            document.getElementById('link_error').style.display = 'none';
            document.getElementById('address_error').textContent = '';
            document.getElementById('address_error').style.display = 'none';

            // Get form values
            const datetime = document.getElementById('interview_datetime').value;
            const description = document.getElementById('interview_description').value;
            const interviewMode = document.getElementById('interview_mode').value;
            const link = document.getElementById('interview_link').value;
            const address = document.getElementById('interview_address').value;

            // Basic validation
            if (!datetime) {
                valid = false;
                document.getElementById('datetime_error').textContent = 'Interview date and time is required.';
                document.getElementById('datetime_error').style.display = 'block';
            }

            if (!description) {
                valid = false;
                document.getElementById('description_error').textContent = 'Interview description is required.';
                document.getElementById('description_error').style.display = 'block';
            }

            // Enhanced URL validation
            function isValidURL(url) {
                try {
                    new URL(url);
                    return true;
                } catch (e) {
                    return false;
                }
            }

            // Conditional validation for interview mode
            if (interviewMode === '2') { // Online
                if (!link) {
                    valid = false;
                    document.getElementById('link_error').textContent =
                        'Interview link is required for online interviews.';
                    document.getElementById('link_error').style.display = 'block';
                } else if (!isValidURL(link)) {
                    valid = false;
                    document.getElementById('link_error').textContent = 'Interview link is not a valid URL.';
                    document.getElementById('link_error').style.display = 'block';
                }
            } else if (interviewMode === '1') { // Physical
                if (!address) {
                    valid = false;
                    document.getElementById('address_error').textContent =
                        'Interview address is required for physical interviews.';
                    document.getElementById('address_error').style.display = 'block';
                }
            }

            if (valid) {
                document.getElementById('interviewForm').submit();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const interviewModeSelect = document.getElementById('interview_mode');
            const interviewLinkContainer = document.getElementById('interview_link_container');
            const interviewAddressContainer = document.getElementById('interview_address_container');

            function toggleInterviewFields() {
                const selectedMode = interviewModeSelect.value;
                if (selectedMode === '2') { // Online
                    interviewLinkContainer.style.display = 'block';
                    interviewAddressContainer.style.display = 'none';
                } else if (selectedMode === '1') { // Physical
                    interviewLinkContainer.style.display = 'none';
                    interviewAddressContainer.style.display = 'block';
                }
            }

            // Initial call to set the fields based on the current value
            toggleInterviewFields();

            // Add event listener for changes in the interview mode
            interviewModeSelect.addEventListener('change', toggleInterviewFields);
        });
    </script>
    <script>
        function populateInterviewModal(button) {
            // Get the data attributes from the clicked button
            const applicationId = button.getAttribute('data-application-id');
            const interviewDateTime = button.getAttribute('data-interview-datetime');
            const interviewDescription = button.getAttribute('data-interview-description');
            const interviewerName = button.getAttribute('data-interviewer-name');
            const interviewMode = button.getAttribute('data-interview-mode');
            const interviewLink = button.getAttribute('data-interview-link');
            const interviewAddress = button.getAttribute('data-interview-address');

            // Set the values in the modal fields
            document.getElementById('application_id').value = applicationId;
            document.getElementById('interview_datetime').value = interviewDateTime;
            document.getElementById('interview_description').value = interviewDescription;
            document.getElementById('interviewer_name').value = interviewerName;
            document.getElementById('interview_mode').value = interviewMode;
            document.getElementById('interview_link').value = interviewLink;
            document.getElementById('interview_address').value = interviewAddress;

            // Trigger the display logic for interview link/address fields
            toggleInterviewFields();
        }

        function toggleInterviewFields() {
            const selectedMode = document.getElementById('interview_mode').value;
            const interviewLinkContainer = document.getElementById('interview_link_container');
            const interviewAddressContainer = document.getElementById('interview_address_container');

            if (selectedMode === '2') { // Online
                interviewLinkContainer.style.display = 'block';
                interviewAddressContainer.style.display = 'none';
            } else if (selectedMode === '1') { // Physical
                interviewLinkContainer.style.display = 'none';
                interviewAddressContainer.style.display = 'block';
            }
        }

        // Add event listener for changes in the interview mode
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('interview_mode').addEventListener('change', toggleInterviewFields);
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var deleteModal = document.getElementById('deleteConfirmationModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var deleteUrl = button.getAttribute('data-delete-url');
                var form = document.getElementById('deleteJobOpeningForm');
                form.action = deleteUrl;
            });
        });
    </script>
    <script>
        function populateContractModal(button) {
            // Get the application id from the button's data attributes
            const applicationId = button.getAttribute('data-offer-application-id');

            // Set the application id in the modal form's hidden input
            document.getElementById('offerLetterapplication_id').value = applicationId;
        }
    </script>
@endsection
