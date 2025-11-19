@extends('admin.layout.app')

@section('title', 'Advance Compare')
@section('styles')
    <style>
        .emp_th {
            position: inherit !important;
            width: 45px !important;
            font-size: 19px !important;
            height: 38px !important;
            text-align: center !important;
            justify-content: center !important;
            display: flex !important;
            padding: 5px !important;
        }

        .container {
            width: 80%;
            max-width: 780px;
            margin: 20px auto;
        }

        .slider-legend_cognitive {
            width: 11%;
            text-align: center;
            font-size: 11px;
            border-radius: 28px;
            padding: 0px;
            color: white;
        }

        .slider-container {
            display: flex;
            align-items: center;
            /* margin: 17px 0px; */
        }

        .slider-label {
            width: 20%;
            text-align: center;
            font-size: 14px;
        }

        .slider-track {
            width: 80%;
            position: relative;
            height: 30px;
            background: #f1f1f1;
            border-radius: 32px;
            margin: 26px 1%;
            max-width: 523px;
        }

        .slider-bar {
            position: absolute;
            top: 50%;
            left: 10%;
            right: 10%;
            height: 4px;
            background: #aaa;
            transform: translateY(-50%);
        }

        .slider-indicator {
            position: absolute;
            top: -20px;
            background: #fff;
            color: #333;
            padding: 2px 5px;
            font-size: 12px;
            border-bottom-right-radius: 50px;
            border-bottom-left-radius: 53px;
            border: 1px solid #aaa;
        }

        .emp_a,
        .emp_b,
        .candidate {
            position: absolute;
            top: 1px;
            width: auto;
            height: auto;
            background-color: #005daf;
            border-radius: 50%;
            font-size: smaller;
            color: white;
            padding: 7px 9px;
            /* border-left: 10px solid transparent;
              border-right: 10px solid transparent;
              border-top: 10px solid #00f; */
        }

        .emp_p,
        .department {
            position: absolute;
            top: 1px;
            width: auto;
            height: auto;
            background-color: #1B84FF;
            border-radius: 50%;
            font-size: smaller;
            color: white;
            padding: 7px 12px;
            /* border-left: 10px solid transparent;
              border-right: 10px solid transparent;
              border-top: 10px solid #00f; */
        }

        .emp_a {
            background-color: #0245A3;

        }

        .emp_b {
            background-color: #1AB93B;

        }

        .department {
            background-color: #e48d1b;

        }


        @media (max-width: 768px) {
            .slider-label {
                font-size: 12px;
            }

            .slider-indicator {
                font-size: 10px;
            }

            .emp_a,
            .emp_b,
            .candidate {
                position: absolute;
                top: 1px;
                width: auto;
                height: auto;
                border-radius: 50%;
                font-size: smaller;
                color: white;
                padding: 7px 12px;
            }

            .emp_p,
            .department {
                position: absolute;
                top: 1px;
                width: auto;
                height: auto;
                background-color: #1B84FF;
                border-radius: 50%;
                font-size: smaller;
                color: white;
                padding: 7px 12px;
            }

            .emp_a {
                background-color: #0245A3;

            }

            .emp_b {
                background-color: #1AB93B;

            }

            .candidate {
                background-color: #d0d03d;

            }

            .department {
                background-color: #e48d1b;

            }


        }

        .hidden_population,
        .hidden_department_population {
            display: none;
        }

        .top_riasec {
            background: #1f5476;
            color: white;
            border-radius: 29px;
        }

        .top_riasec_department {
            background: #e48d1b;
            color: white;
            border-radius: 29px;
        }

        .accordion-button::after {
            margin-left: 11px;
        }

        .is-invalid {
            border-color: red;
        }

        .invalid-feedback {
            display: none;
            color: red;
            font-size: 12px;
        }

        .select-container {
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .emp_a {
            display: none !important;
        }

        .form-select.form-select-solid {
            height: 43px;
        }
        
    </style>
@endsection
@section('content')

    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">


            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
                class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Advance Compare
                </h1>
                <!--end::Title-->


                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">
                            Dashboard </a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        Advance Compare </li>
                    <!--end::Item-->

                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Action group-->
            <!--begin::Toolbar end-->


            <!--end::Toolbar end-->
            <!--end::Action group-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">


        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <div class="card">
                <div class="card-header border-0 ">
                    <h3 class="card-title align-items-start flex-column">Advance Compare</h3>

                </div>
                <div class="card-body">
                    <div class="">

                        <form class="row justify-content-start" action="">

                            <div class="col-lg-3 mt-3">
                                <label class="form-label">Department</label>

                                <select class="form-select  form-select-solid me-6" data-control="select2"
                                    name="department_id" id="department_id" required>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            @if (request('department_id') == $department->id) selected @endif>{{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback">This field is required.</span>
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label class="form-label">Job Opening:</label>

                                <select class="form-select  form-select-solid me-6" data-control="select2"
                                    name="job_opening_id" id="job_opening_id" required>
                                    @foreach ($jobOpenings as $job)
                                        <option value="{{ $job->id }}"
                                            @if (request('job_opening_id') == $job->id) selected @endif>{{ $job->job_title ?? '' }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback">This field is required.</span>
                            </div>

                            <div class="col-lg-3 mt-3">
                                <label class="form-label">Pool Type</label>

                                <select class="form-select  form-select-solid me-6" data-control="select2" name="pool_type"
                                    id="pool_type" required>
                                    <option value="candidate_vs_employee" @if (request('pool_type') == 'candidate_vs_employee') selected @endif>
                                        Candidate vs Employee</option>
                                    <option value="candidate_vs_candidate"
                                        @if (request('pool_type') == 'candidate_vs_candidate') selected @endif>Candidate vs Candidate</option>
                                </select>
                                <span class="invalid-feedback">This field is required.</span>
                            </div>

                            <div class="col-lg-3 mt-3" id="application_status_container">
                                <label class="form-label">Application Status</label>

                                <select class="form-select  form-select-solid me-6" data-control="select2"
                                    name="application_status" id="application_status" required>
                                    <option value="">All</option>
                                    @foreach (config('helpers.application_status') as $statusKey => $statusValue)
                                        <option value="{{ $statusKey }}"
                                            @if (request('status') == $statusKey) selected @endif>{{ $statusValue }}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback">This field is required.</span>
                            </div>

                            <div class="col-lg-3 mt-3">
                                <label class="form-label">Candidate</label>
                                <select class="form-select  form-select-solid me-6" data-control="select2"
                                    name="candidate_id" id="candidate_ids" required>
                                    <!-- Dynamic options -->
                                </select>
                                <span class="invalid-feedback">This field is required.</span>
                            </div>

                            <div class="col-lg-3 mt-3 " id="second_candidate_ids_container">
                                <label class="form-label">Second Candidate</label>
                                <select class="form-select  form-select-solid me-6" data-control="select2"
                                    name="second_candidate_id" id="second_candidate_ids">
                                    <!-- Dynamic options -->
                                </select>
                                <span class="invalid-feedback">This field is required.</span>
                            </div>

                            <div class="col-lg-3 mt-3" id="employee_ids_container">
                                <label class="form-label">Employee</label>
                                <select class="form-select  form-select-solid me-6" data-control="select2"
                                    name="employee_id" id="employee_ids">
                                    <!-- Dynamic options -->
                                </select>
                                <span class="invalid-feedback">This field is required.</span>
                            </div>

                            <div class="col-lg-3 mt-3">
                                <label class="form-label">Report</label>
                                <select class="form-select  form-select-solid me-6" data-control="select2" name="report"
                                    id="report" required>
                                    <option value="">Select Report</option>
                                    <option @if (request('report') == 'all_facets') selected="Selected" @endif value="all_facets">
                                        All Facets (OCEAN)</option>
                                    <option @if (request('report') == 'ocean') selected="Selected" @endif value="ocean">
                                        Personality & Motivation (OCEAN)</option>
                                    <option @if (request('report') == 'work_interest') selected="Selected" @endif
                                        value="work_interest">Work Interest (RIASEC)</option>
                                    {{-- <option @if (request('report') == 'talent_pillar') selected="Selected" @endif value="talent_pillar" >Talent Pillar</option> --}}
                                    <option @if (request('report') == 'cognitive_ability') selected="Selected" @endif
                                        value="cognitive_ability">Cognitive Ability</option>
                                    {{-- <option @if (request('report') == 'team_dynamics') selected="Selected" @endif value="team_dynamics" >Team Dynamics</option> --}}
                                </select>
                                <span class="invalid-feedback">This field is required.</span>
                            </div>

                            <div class="align-items-center mt-3 d-flex justify-content-end mt-5 col-lg-3" >

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

                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="row g-5 g-xl-8 justify-content-center mt-5">
                <div class="col-xl-8">
                    <!--begin::Charts Widget 1-->
                    <div class="card card-xl-stretch mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold fs-3 mb-1">Comparison</span>

                            </h3>
                            <div class="card-toolbar">
                                {{-- <div class="ml-3 population_hide hidden_population    mx-4">
                                <span class="bg-primary custom_legends mx-2">
                                    P
                                </span>

                                Population
                            </div> --}}

                                @if (request('report'))
                                    <div class="form-check">
                                        <input class="form-check-input" name="checkbox" id="population"
                                            value="population" type="checkbox" value="" />
                                        <label class="form-check-label" for="population">
                                            Company
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" name="checkbox" id="department"
                                            value="department" type="checkbox" value="" />
                                        <label class="form-check-label" for="department">
                                            Department
                                        </label>
                                    </div>
                                @endif

                            </div>

                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body px-6 pb-6">

                            @if (!request('report'))
                                <div class="text-center py-5">
                                    <h3>No comparison data available. Please select report to compare. </h3>
                                </div>
                            @endif

                            @if (request('report') == 'ocean')
                                <div class="lg:col-span-12 col-span-12">
                                    <div class="card h-full mt-4 shadow-deep">
                                        <header class="card-header">
                                            <h4 class="card-title">Personality & Motivation</h4>
                                        </header>
                                        <div class="card-body p-6">

                                            <div class="">
                                                <div class="slider-container">
                                                    <div class="slider-label">Pragmatism</div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            @if (isset($oceanSuperiorResult['Openness to Experience']) &&
                                                                    ($oceanSuperiorResult['Openness to Experience'] / 5) * 100 == 100) style="left: 93%;padding: 15px;" @else style="left: {{ ($oceanSuperiorResult['Openness to Experience'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($oceanEmployeeResult['Openness to Experience']) &&
                                                                    ($oceanEmployeeResult['Openness to Experience'] / 5) * 100 == 100) style="left: 93%;padding: 15px;" @else style="left: {{ ($oceanEmployeeResult['Openness to Experience'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($oceanCandidateResult['Openness to Experience']) &&
                                                                    ($oceanCandidateResult['Openness to Experience'] / 5) * 100 == 100) style="left: 93%;padding: 15px;" @else style="left: {{ ($oceanCandidateResult['Openness to Experience'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        <div class="emp_p population_hide hidden_population"
                                                            @if (isset($oceanOverallResult['Openness to Experience']) &&
                                                                    ($oceanOverallResult['Openness to Experience'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanOverallResult['Openness to Experience'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            P</div>
                                                        <div class="department department_population_hide hidden_department_population"
                                                            @if (isset($oceanDepartmentResult['Openness to Experience']) &&
                                                                    ($oceanDepartmentResult['Openness to Experience'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanDepartmentResult['Openness to Experience'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            D</div>
                                                    </div>
                                                    <div class="slider-label">Openness</div>
                                                </div>

                                                <div class="slider-container">
                                                    <div class="slider-label">Low Self Control</div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            @if (isset($oceanSuperiorResult['Conscientiousness']) && ($oceanSuperiorResult['Conscientiousness'] / 5) * 100 == 100) style="left: 93%;padding: 15px;" @else style="left: {{ ($oceanSuperiorResult['Conscientiousness'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($oceanEmployeeResult['Conscientiousness']) && ($oceanEmployeeResult['Conscientiousness'] / 5) * 100 == 100) style="left: 93%;padding: 15px;" @else style="left: {{ ($oceanEmployeeResult['Conscientiousness'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($oceanCandidateResult['Conscientiousness']) && ($oceanCandidateResult['Conscientiousness'] / 5) * 100 == 100) style="left: 93%;padding: 15px;" @else style="left: {{ ($oceanCandidateResult['Conscientiousness'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        <div class="emp_p population_hide hidden_population"
                                                            @if (isset($oceanOverallResult['Conscientiousness']) && ($oceanOverallResult['Conscientiousness'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanOverallResult['Conscientiousness'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            P</div>
                                                        <div class="department department_population_hide hidden_department_population"
                                                            @if (isset($oceanDepartmentResult['Conscientiousness']) &&
                                                                    ($oceanDepartmentResult['Conscientiousness'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanDepartmentResult['Conscientiousness'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            D</div>
                                                    </div>
                                                    <div class="slider-label">High Self Control</div>
                                                </div>

                                                <div class="slider-container">
                                                    <div class="slider-label">Introversion</div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            @if (isset($oceanSuperiorResult['Extraversion']) && ($oceanSuperiorResult['Extraversion'] / 5) * 100 == 100) style="left: 93%;padding: 15px;" @else style="left: {{ ($oceanSuperiorResult['Extraversion'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($oceanEmployeeResult['Extraversion']) && ($oceanEmployeeResult['Extraversion'] / 5) * 100 == 100) style="left: 93%;padding: 15px;" @else style="left: {{ ($oceanEmployeeResult['Extraversion'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($oceanCandidateResult['Extraversion']) && ($oceanCandidateResult['Extraversion'] / 5) * 100 == 100) style="left: 93%;padding: 15px;" @else style="left: {{ ($oceanCandidateResult['Extraversion'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        <div class="emp_p population_hide hidden_population"
                                                            @if (isset($oceanOverallResult['Extraversion']) && ($oceanOverallResult['Extraversion'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanOverallResult['Extraversion'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            P</div>
                                                        <div class="department department_population_hide hidden_department_population"
                                                            @if (isset($oceanDepartmentResult['Extraversion']) && ($oceanDepartmentResult['Extraversion'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanDepartmentResult['Extraversion'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            D</div>
                                                    </div>
                                                    <div class="slider-label">Extraversion</div>
                                                </div>

                                                <div class="slider-container">
                                                    <div class="slider-label">Independenc{{ $first_title ?? 'E' }}</div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            @if (isset($oceanSuperiorResult['Agreeableness']) && ($oceanSuperiorResult['Agreeableness'] / 5) * 100 == 100) style="left: 93%;padding: 15px;" @else style="left: {{ ($oceanSuperiorResult['Agreeableness'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($oceanEmployeeResult['Agreeableness']) && ($oceanEmployeeResult['Agreeableness'] / 5) * 100 == 100) style="left: 93%;padding: 15px;" @else style="left: {{ ($oceanEmployeeResult['Agreeableness'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($oceanCandidateResult['Agreeableness']) && ($oceanCandidateResult['Agreeableness'] / 5) * 100 == 100) style="left: 93%;padding: 15px;" @else style="left: {{ ($oceanCandidateResult['Agreeableness'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        <div class="emp_p population_hide hidden_population"
                                                            @if (isset($oceanOverallResult['Agreeableness']) && ($oceanOverallResult['Agreeableness'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanOverallResult['Agreeableness'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            P</div>
                                                        <div class="department department_population_hide hidden_department_population"
                                                            @if (isset($oceanDepartmentResult['Agreeableness']) && ($oceanDepartmentResult['Agreeableness'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanDepartmentResult['Agreeableness'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            D</div>
                                                    </div>
                                                    <div class="slider-label">AgreeblenesH</div>
                                                </div>

                                                <div class="slider-container">
                                                    <div class="slider-label">High Anxiety</div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            @if (isset($oceanSuperiorResult['Emotional Stability']) &&
                                                                    ($oceanSuperiorResult['Emotional Stability'] / 5) * 100 == 100) style="left: 93%;padding: 15px;" @else style="left: {{ ($oceanSuperiorResult['Emotional Stability'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($oceanEmployeeResult['Emotional Stability']) &&
                                                                    ($oceanEmployeeResult['Emotional Stability'] / 5) * 100 == 100) style="left: 93%;padding: 15px;" @else style="left: {{ ($oceanEmployeeResult['Emotional Stability'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($oceanCandidateResult['Emotional Stability']) &&
                                                                    ($oceanCandidateResult['Emotional Stability'] / 5) * 100 == 100) style="left: 93%;padding: 15px;" @else style="left: {{ ($oceanCandidateResult['Emotional Stability'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        <div class="emp_p population_hide hidden_population"
                                                            @if (isset($oceanOverallResult['Emotional Stability']) && ($oceanOverallResult['Emotional Stability'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanOverallResult['Emotional Stability'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            P</div>
                                                        <div class="department department_population_hide hidden_department_population"
                                                            @if (isset($oceanDepartmentResult['Emotional Stability']) &&
                                                                    ($oceanDepartmentResult['Emotional Stability'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanDepartmentResult['Emotional Stability'] / 5) * 100 ?? 0 }}%;" @endif>
                                                            D</div>
                                                    </div>
                                                    <div class="slider-label">Low Anxiety</div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            {{-- OCEAN end --}}

                            @if (request('report') == 'all_facets')
                                @php
                                    $allFacetsDescriptionsFromDB = \App\Models\OceanAllFacetsCombination::all();

                                    $allFacetsDescriptions = [];
                                    foreach ($allFacetsDescriptionsFromDB as $allFacet) {
                                        $allFacetsDescriptions[$allFacet->facet][$allFacet->ea][$allFacet->eb] =
                                            $allFacet->description;
                                    }

                                    function convertScoreToLevel($score)
                                    {
                                        $level = 'Medium';
                                        if ($score > 3.75) {
                                            $level = 'High';
                                        } elseif ($score <= 1.25) {
                                            $level = 'Low';
                                        } else {
                                            $level = 'Medium';
                                        }
                                        return $level;
                                    }
                                    $allFacetsFromDB = \App\Models\MasterAllOceanFacet::all();
                                    $allHighFacets = [];
                                    $allLowFacets = [];
                                    foreach ($allFacetsFromDB as $allFac) {
                                        $allHighFacets[$allFac->facet] = $allFac->facet_description;
                                        $allLowFacets[$allFac->facet_low] = $allFac->facet_low_description;
                                    }

                                    function lowerAndReplaceSpace($inputString)
                                    {
                                        // Lowercase the letters
                                        $inputString = strtolower($inputString);
                                        // Replace spaces with underscores
                                        $inputString = str_replace(' ', '', $inputString);
                                        return $inputString;
                                    }

                                    function renderFinalFacetHtml(
                                        $facet_low,
                                        $facet_field_name,
                                        $facet,
                                        $oceanAllFacetsSuperiorResult,
                                        $oceanAllFacetsEmployeeResult,
                                        $oceanAllFacetsCandidateResult,
                                        $oceanAllFacetsOverallResult,
                                        $oceanAllFacetsDepartmentResult,
                                        $allHighFacets,
                                        $allLowFacets,
                                        $allFacetsDescriptions,
                                        $first_title,
                                        $second_title,
                                    ) {
                                        // Extracting the property values from objects
                                        $facet_value_a = isset($oceanAllFacetsSuperiorResult[$facet_field_name])
                                            ? $oceanAllFacetsSuperiorResult[$facet_field_name]
                                            : 0;
                                        $facet_value_b = isset($oceanAllFacetsEmployeeResult[$facet_field_name])
                                            ? $oceanAllFacetsEmployeeResult[$facet_field_name]
                                            : 0;
                                        $facet_value_c = isset($oceanAllFacetsCandidateResult[$facet_field_name])
                                            ? $oceanAllFacetsCandidateResult[$facet_field_name]
                                            : 0;
                                        $facet_value_o = isset($oceanAllFacetsOverallResult[$facet_field_name])
                                            ? $oceanAllFacetsOverallResult[$facet_field_name]
                                            : 0;
                                        $facet_value_d = isset($oceanAllFacetsDepartmentResult[$facet_field_name])
                                            ? $oceanAllFacetsDepartmentResult[$facet_field_name]
                                            : 0;
                                        $analyzedDescription =
                                            $allFacetsDescriptions[$facet][convertScoreToLevel($facet_value_a)][
                                                convertScoreToLevel($facet_value_b)
                                            ] ?? '';

                                        // Use direct PHP concatenation for dynamic content
                                        $facetLowId = lowerAndReplaceSpace($facet_low);
                                        $facetId = lowerAndReplaceSpace($facet);

                                        // Calculate left position for emp_a
                                        $leftPositionA = ($facet_value_a / 5) * 100;
                                        $styleA =
                                            $leftPositionA == 100
                                                ? 'style="left: 93%;"'
                                                : 'style="left: ' . $leftPositionA . '%;"';

                                        // Calculate left position for emp_b
                                        $leftPositionB = ($facet_value_b / 5) * 100;
                                        $styleB =
                                            $leftPositionB == 100
                                                ? 'style="left: 93%;"'
                                                : 'style="left: ' . $leftPositionB . '%;"';

                                        // Calculate left position for candidate
                                        $leftPositionC = ($facet_value_c / 5) * 100;
                                        $styleC =
                                            $leftPositionC == 100
                                                ? 'style="left: 93%;"'
                                                : 'style="left: ' . $leftPositionC . '%;"';
                                        $html =
                                            '<div class="slider-container">' .
                                            '<div class="slider-label cursor-pointer mt-5" data-bs-toggle="collapse" data-bs-target="#' .
                                            $facetLowId .
                                            '">' .
                                            htmlspecialchars($facet_low) .
                                            '<span>
                                        <iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon>
                                    </span></div>' .
                                            '<div class="slider-track mb-0" style="margin-bottom: 0px;">' .
                                            '<div class="emp_a" ' .
                                            $styleA .
                                            '>H</div>' .
                                            '<div class="emp_b" ' .
                                            $styleB .
                                            '>' .
                                            $first_title .
                                            '</div>' .
                                            '<div class="candidate" ' .
                                            $styleC .
                                            '>' .
                                            $second_title .
                                            '</div>' .
                                            '<div class="emp_p population_hide hidden_population" style="left: ' .
                                            ($facet_value_o / 5) * 100 .
                                            '%;">P</div>' .
                                            '<div class="department department_population_hide hidden_department_population" style="left: ' .
                                            ($facet_value_d / 5) * 100 .
                                            '%;">D</div>' .
                                            '</div>' .
                                            '<div class="slider-label cursor-pointer mt-5" data-bs-toggle="collapse" data-bs-target="#' .
                                            $facetId .
                                            '">' .
                                            htmlspecialchars($facet) .
                                            '<span>
                                        <iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon>
                                    </span></div>' .
                                            '</div>' .
                                            '<div class="accordion-item pl-8">' .
                                            '<div id="' .
                                            $facetLowId .
                                            '" class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9 mt-2" aria-labelledby="panelsStayOpen-headingOne">' .
                                            '<div class="accordion-body font13 text-slate-600">' .
                                            htmlspecialchars($allLowFacets[$facet_low]) .
                                            '</div>' .
                                            '</div>' .
                                            '</div>' .
                                            '<div class="accordion-item pl-8">' .
                                            '<div id="' .
                                            $facetId .
                                            '" class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9 mt-2" aria-labelledby="panelsStayOpen-headingOne">' .
                                            '<div class="accordion-body font13 text-slate-600">' .
                                            htmlspecialchars($allHighFacets[$facet]) .
                                            '</div>' .
                                            '</div>' .
                                            '</div>';

                                        return $html;
                                    }
                                @endphp


                                <div class="lg:col-span-12 col-span-12">
                                    <div class="card h-full mt-4 shadow-deep">
                                        <header class="card-header">
                                            <h4 class="card-title">All Facets(OCEAN)</h4>
                                        </header>
                                        <div class="card-body p-6">
                                            <div class="container">
                                                <h6 class="mt-5">Openness To Experience</h6>

                                                {!! renderFinalFacetHtml(
                                                    'Practicality',
                                                    'daydreaming_avg',
                                                    'Day Dreaming',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Practical Aesthetics',
                                                    'aesthetic_appreciation_avg',
                                                    'Aesthetic Appreciation',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Measured Emotionality',
                                                    'feeling_aware_avg',
                                                    'Feeling Aware',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Consistent Reliability',
                                                    'explorer_avg',
                                                    'Explorer',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Realistic Pragmatism',
                                                    'innovation_avg',
                                                    'Innovation',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Traditional Values',
                                                    'daydreaming_avg',
                                                    'Open Mindedness',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}

                                                <h6 class="mt-5">Conscientiousness</h6>

                                                {!! renderFinalFacetHtml(
                                                    'Humble Capability',
                                                    'self_confidence_avg',
                                                    'Self Confidence',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Flexibility',
                                                    'tidiness_avg',
                                                    'Tidiness',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Autonomy',
                                                    'responsibility_avg',
                                                    'Responsibility',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Contentment',
                                                    'drive_to_achieve_avg',
                                                    'Drive To Achieve',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Spontaneity',
                                                    'will_power_avg',
                                                    'Will Power',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Impulsiveness',
                                                    'careful_thinking_avg',
                                                    'Careful Thinking',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}


                                                <h6 class="mt-5">Extraversion</h6>
                                                {!! renderFinalFacetHtml(
                                                    'Reservedness',
                                                    'sociability_avg',
                                                    'Sociability',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Independence',
                                                    'crowd_enjoyment_avg',
                                                    'Crowd Enjoyment',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Humility',
                                                    'confidence_avg',
                                                    'Confidence',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Calmness',
                                                    'sociability_avg',
                                                    'Sociability',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Risk Aversion',
                                                    'thrill_seeking_avg',
                                                    'Thrill Seeking',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Composed Outlook',
                                                    'optimism_avg',
                                                    'Optimism',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}

                                                <h6 class="mt-5">Agreeableness</h6>

                                                {!! renderFinalFacetHtml(
                                                    'Skepticism',
                                                    'belief_avg',
                                                    'Belief',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Tactfulness',
                                                    'honesty_avg',
                                                    'Honesty',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Self-Reliance',
                                                    'helpfulness_avg',
                                                    'Helpfulness',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Self-Assuredness',
                                                    'diplomacy_avg',
                                                    'Diplomacy',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Self-Belief',
                                                    'humility_avg',
                                                    'Humility',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Tough-Mindedness',
                                                    'compassion_avg',
                                                    'Compassion',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}

                                                <h6 class="mt-5">Emotional Stability</h6>
                                                {!! renderFinalFacetHtml(
                                                    'Stress Sensitivity',
                                                    'steadiness_avg',
                                                    'Steadiness',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Irritability',
                                                    'tolerance_avg',
                                                    'Tolerance',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Discouragement',
                                                    'positivity_avg',
                                                    'Positivity',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Self-Doubt',
                                                    'social_sensitivity_avg',
                                                    'Social Sensitivity',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Stress Prone',
                                                    'stress_response_avg',
                                                    'Stress Response',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                                {!! renderFinalFacetHtml(
                                                    'Tactfulness',
                                                    'honesty_avg',
                                                    'Honesty',
                                                    $oceanAllFacetsSuperiorResult,
                                                    $oceanAllFacetsEmployeeResult,
                                                    $oceanAllFacetsCandidateResult,
                                                    $oceanAllFacetsOverallResult,
                                                    $oceanAllFacetsDepartmentResult,
                                                    $allHighFacets,
                                                    $allLowFacets,
                                                    $allFacetsDescriptions,
                                                    $first_title,
                                                    $second_title,
                                                ) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (request('report') == 'work_interest')
                                <div class="lg:col-span-12 col-span-12">
                                    <div class="card h-full mt-4 shadow-deep">
                                        <header class="card-header">
                                            <h4 class="card-title">Work Interest (RIASEC)</h4>
                                        </header>
                                        <div class="card-body p-6">
                                            {{-- @if (auth()->user()->is_personality_motivation_completed == 1) --}}
                                            {{-- <div id="riasec"></div> --}}
                                            {{-- @else
                                        <div class="container text-center bg_secondary_green p-5" style="
                                    border-radius: 16px;">
                                            <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                            </iconify-icon>
                                            <h4>Data Not Available </h4>
                                        </div>
                                        @endif --}}
                                            <div class="col-lg-12">

                                                @php
                                                    $topriasec = str_split($workInterestOverallResult['top_3_riasec']);
                                                    $topriasecDepartment = str_split(
                                                        $workInterestDepartmentResult['top_3_riasec'],
                                                    );
                                                @endphp

                                                <div
                                                    class="slider-container @if (in_array('R', $topriasec)) raisec_container @endif @if (in_array('R', $topriasecDepartment)) raisec_container_department @endif my-1">
                                                    <div class="slider-label">Realisti{{ $second_title ?? ' C' }}</div>


                                                    <div class="slider-track">
                                                        <div class="d-flex justify-content-between"
                                                            style="top: -28px; position: relative;">
                                                            <div class="slider-legend"
                                                                style="
                                                        background: #ff4639f7;
                                                        border-radius: 28px;
                                                        padding: 0px 7px;
                                                        color: white;
                                                    ">
                                                                Low</div>
                                                            <div class="slider-legend"
                                                                style="
                                                        background: #279d27;
                                                        border-radius: 28px;
                                                        padding: 0px 7px;
                                                        color: white;
                                                    ">
                                                                High</div>
                                                        </div>
                                                        <div class="emp_a"
                                                            @if (isset($workInterestSuperiorResult['Realistic']) && $workInterestSuperiorResult['Realistic'] == 100) style="left: 93%;" @else style="left: {{ $workInterestSuperiorResult['Realistic'] ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($workInterestEmployeeResult['Realistic']) && $workInterestEmployeeResult['Realistic'] == 100) style="left: 93%;" @else style="left: {{ $workInterestEmployeeResult['Realistic'] ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($workInterestCandidateResult['Realistic']) && $workInterestCandidateResult['Realistic'] == 100) style="left: 93%;" @else style="left: {{ $workInterestCandidateResult['Realistic'] ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        {{-- <div class="emp_p population_hide hidden_population"
                                                    @if (isset($workInterestOverallResult['Realistic']) && $workInterestOverallResult['Realistic'] == 100) style="left: 93%;" @else style="left: {{ $workInterestOverallResult['Realistic'] ?? 0 }}%;" @endif>
                                                        P
                                                    </div>
                                                    <div class="department department_population_hide hidden_department_population"
                                                    @if (isset($workInterestOverallResult['Realistic']) && $workInterestOverallResult['Realistic'] == 100) style="left: 93%;" @else style="left: {{ $workInterestOverallResult['Realistic'] ?? 0 }}%;" @endif>
                                                        D
                                                    </div> --}}

                                                    </div>
                                                    {{-- <div class="slider-label">Openness</div> --}}
                                                </div>

                                                <div
                                                    class="slider-container @if (in_array('I', $topriasec)) raisec_container @endif @if (in_array('I', $topriasecDepartment)) raisec_container_department @endif my-1">
                                                    <div class="slider-label">Investigativ{{ $first_title ?? 'E' }}</div>
                                                    <div class="slider-track">
                                                        <div class="d-flex justify-content-between"
                                                            style="top: -28px; position: relative;">
                                                            <div class="slider-legend"
                                                                style="
                                                                            background: #ff4639f7;
                                                                            border-radius: 28px;
                                                                            padding: 0px 7px;
                                                                            color: white;
                                                                        ">
                                                                Low</div>
                                                            <div class="slider-legend"
                                                                style="
                                                                            background: #279d27;
                                                                            border-radius: 28px;
                                                                            padding: 0px 7px;
                                                                            color: white;
                                                                        ">
                                                                High</div>
                                                        </div>
                                                        <div class="emp_a"
                                                            @if (isset($workInterestSuperiorResult['Investigative']) && $workInterestSuperiorResult['Investigative'] == 100) style="left: 93%;" @else style="left: {{ $workInterestSuperiorResult['Investigative'] ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($workInterestEmployeeResult['Investigative']) && $workInterestEmployeeResult['Investigative'] == 100) style="left: 93%;" @else style="left: {{ $workInterestEmployeeResult['Investigative'] ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($workInterestCandidateResult['Investigative']) && $workInterestCandidateResult['Investigative'] == 100) style="left: 93%;" @else style="left: {{ $workInterestCandidateResult['Investigative'] ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        {{-- <div class="emp_p population_hide hidden_population"
                                                                        @if (isset($workInterestOverallResult['Investigative']) && $workInterestOverallResult['Investigative'] == 100) style="left: 93%;" @else style="left: {{ $workInterestOverallResult['Investigative'] ?? 0 }}%;" @endif>
                                                                            P
                                                                        </div>
                                                                        <div class="department department_population_hide hidden_department_population"
                                                                        @if (isset($workInterestOverallResult['Investigative']) && $workInterestOverallResult['Investigative'] == 100) style="left: 93%;" @else style="left: {{ $workInterestOverallResult['Investigative'] ?? 0 }}%;" @endif>
                                                                            D
                                                                        </div> --}}

                                                    </div>
                                                </div>
                                                <div
                                                    class="slider-container @if (in_array('A', $topriasec)) raisec_container @endif @if (in_array('A', $topriasecDepartment)) raisec_container_department @endif my-1">
                                                    <div class="slider-label">Artisti{{ $second_title ?? ' C' }}</div>
                                                    <div class="slider-track">
                                                        <div class="d-flex justify-content-between"
                                                            style="top: -28px; position: relative;">
                                                            <div class="slider-legend"
                                                                style="
                                                                            background: #ff4639f7;
                                                                            border-radius: 28px;
                                                                            padding: 0px 7px;
                                                                            color: white;
                                                                        ">
                                                                Low</div>
                                                            <div class="slider-legend"
                                                                style="
                                                                            background: #279d27;
                                                                            border-radius: 28px;
                                                                            padding: 0px 7px;
                                                                            color: white;
                                                                        ">
                                                                High</div>
                                                        </div>
                                                        <div class="emp_a"
                                                            @if (isset($workInterestSuperiorResult['Artistic']) && $workInterestSuperiorResult['Artistic'] == 100) style="left: 93%;" @else style="left: {{ $workInterestSuperiorResult['Artistic'] ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($workInterestEmployeeResult['Artistic']) && $workInterestEmployeeResult['Artistic'] == 100) style="left: 93%;" @else style="left: {{ $workInterestEmployeeResult['Artistic'] ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($workInterestCandidateResult['Artistic']) && $workInterestCandidateResult['Artistic'] == 100) style="left: 93%;" @else style="left: {{ $workInterestCandidateResult['Artistic'] ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        {{-- <div class="emp_p population_hide hidden_population"
                                                                        @if (isset($workInterestOverallResult['Artistic']) && $workInterestOverallResult['Artistic'] == 100) style="left: 93%;" @else style="left: {{ $workInterestOverallResult['Artistic'] ?? 0 }}%;" @endif>
                                                                            P
                                                                        </div>
                                                                        <div class="department department_population_hide hidden_department_population"
                                                                        @if (isset($workInterestOverallResult['Artistic']) && $workInterestOverallResult['Artistic'] == 100) style="left: 93%;" @else style="left: {{ $workInterestOverallResult['Artistic'] ?? 0 }}%;" @endif>
                                                                            D
                                                                        </div> --}}

                                                    </div>
                                                </div>
                                                <div
                                                    class="slider-container @if (in_array('S', $topriasec)) raisec_container @endif @if (in_array('S', $topriasecDepartment)) raisec_container_department @endif my-1">
                                                    <div class="slider-label">Social</div>
                                                    <div class="slider-track">
                                                        <div class="d-flex justify-content-between"
                                                            style="top: -28px; position: relative;">
                                                            <div class="slider-legend"
                                                                style="
                                                                    background: #ff4639f7;
                                                                    border-radius: 28px;
                                                                    padding: 0px 7px;
                                                                    color: white;
                                                                ">
                                                                Low</div>
                                                            <div class="slider-legend"
                                                                style="
                                                                    background: #279d27;
                                                                    border-radius: 28px;
                                                                    padding: 0px 7px;
                                                                    color: white;
                                                                ">
                                                                High</div>
                                                        </div>
                                                        <div class="emp_a"
                                                            @if (isset($workInterestSuperiorResult['Social']) && $workInterestSuperiorResult['Social'] == 100) style="left: 93%;" @else style="left: {{ $workInterestSuperiorResult['Social'] ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($workInterestEmployeeResult['Social']) && $workInterestEmployeeResult['Social'] == 100) style="left: 93%;" @else style="left: {{ $workInterestEmployeeResult['Social'] ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($workInterestCandidateResult['Social']) && $workInterestCandidateResult['Social'] == 100) style="left: 93%;" @else style="left: {{ $workInterestCandidateResult['Social'] ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        {{-- <div class="emp_p population_hide hidden_population"
                                                                @if (isset($workInterestOverallResult['Social']) && $workInterestOverallResult['Social'] == 100) style="left: 93%;" @else style="left: {{ $workInterestOverallResult['Social'] ?? 0 }}%;" @endif>
                                                                    P
                                                                </div>
                                                                <div class="department department_population_hide hidden_department_population"
                                                                @if (isset($workInterestOverallResult['Social']) && $workInterestOverallResult['Social'] == 100) style="left: 93%;" @else style="left: {{ $workInterestOverallResult['Social'] ?? 0 }}%;" @endif>
                                                                    D
                                                                </div> --}}

                                                    </div>
                                                </div>
                                                <div
                                                    class="slider-container @if (in_array('E', $topriasec)) raisec_container @endif @if (in_array('E', $topriasecDepartment)) raisec_container_department @endif my-1">
                                                    <div class="slider-label">Enterprising</div>
                                                    <div class="slider-track">
                                                        <div class="d-flex justify-content-between"
                                                            style="top: -28px; position: relative;">
                                                            <div class="slider-legend"
                                                                style="
                                                                background: #ff4639f7;
                                                                border-radius: 28px;
                                                                padding: 0px 7px;
                                                                color: white;
                                                            ">
                                                                Low</div>
                                                            <div class="slider-legend"
                                                                style="
                                                                background: #279d27;
                                                                border-radius: 28px;
                                                                padding: 0px 7px;
                                                                color: white;
                                                            ">
                                                                High</div>
                                                        </div>
                                                        <div class="emp_a"
                                                            @if (isset($workInterestSuperiorResult['Enterprising']) && $workInterestSuperiorResult['Enterprising'] == 100) style="left: 93%;" @else style="left: {{ $workInterestSuperiorResult['Enterprising'] ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($workInterestEmployeeResult['Enterprising']) && $workInterestEmployeeResult['Enterprising'] == 100) style="left: 93%;" @else style="left: {{ $workInterestEmployeeResult['Enterprising'] ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($workInterestCandidateResult['Enterprising']) && $workInterestCandidateResult['Enterprising'] == 100) style="left: 93%;" @else style="left: {{ $workInterestCandidateResult['Enterprising'] ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        {{-- <div class="emp_p population_hide hidden_population"
                                                            @if (isset($workInterestOverallResult['Enterprising']) && $workInterestOverallResult['Enterprising'] == 100) style="left: 93%;" @else style="left: {{ $workInterestOverallResult['Enterprising'] ?? 0 }}%;" @endif>
                                                                P
                                                            </div>
                                                            <div class="department department_population_hide hidden_department_population"
                                                            @if (isset($workInterestOverallResult['Enterprising']) && $workInterestOverallResult['Enterprising'] == 100) style="left: 93%;" @else style="left: {{ $workInterestOverallResult['Enterprising'] ?? 0 }}%;" @endif>
                                                                D
                                                            </div> --}}

                                                    </div>

                                                </div>

                                                <div
                                                    class="slider-container @if (in_array('C', $topriasec)) raisec_container @endif @if (in_array('C', $topriasecDepartment)) raisec_container_department @endif my-1">
                                                    <div class="slider-label">Conventional</div>

                                                    <div class="slider-track">
                                                        <div class="d-flex justify-content-between"
                                                            style="top: -28px; position: relative;">
                                                            <div class="slider-legend"
                                                                style="
                                                        background: #ff4639f7;
                                                        border-radius: 28px;
                                                        padding: 0px 7px;
                                                        color: white;
                                                    ">
                                                                Low</div>
                                                            <div class="slider-legend"
                                                                style="
                                                        background: #279d27;
                                                        border-radius: 28px;
                                                        padding: 0px 7px;
                                                        color: white;
                                                    ">
                                                                High</div>
                                                        </div>
                                                        <div class="emp_a"
                                                            @if (isset($workInterestSuperiorResult['Conventional']) && $workInterestSuperiorResult['Conventional'] == 100) style="left: 93%;" @else style="left: {{ $workInterestSuperiorResult['Conventional'] ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($workInterestEmployeeResult['Conventional']) && $workInterestEmployeeResult['Conventional'] == 100) style="left: 93%;" @else style="left: {{ $workInterestEmployeeResult['Conventional'] ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($workInterestCandidateResult['Conventional']) && $workInterestCandidateResult['Conventional'] == 100) style="left: 93%;" @else style="left: {{ $workInterestCandidateResult['Conventional'] ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        {{-- <div class="emp_p population_hide hidden_population"
                                                    @if (isset($workInterestOverallResult['Conventional']) && $workInterestOverallResult['Conventional'] == 100) style="left: 93%;" @else style="left: {{ $workInterestOverallResult['Conventional'] ?? 0 }}%;" @endif>
                                                        P
                                                    </div>
                                                    <div class="department department_population_hide hidden_department_population"
                                                    @if (isset($workInterestOverallResult['Conventional']) && $workInterestOverallResult['Conventional'] == 100) style="left: 93%;" @else style="left: {{ $workInterestOverallResult['Conventional'] ?? 0 }}%;" @endif>
                                                        D
                                                    </div> --}}

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-lg-between mt-4">
                                                <div class="accordion mr-3 p-1 shadow-deep"
                                                    id="accordionPanelsStayOpenExample"
                                                    style="
                                                                            border-radius: 8px;
                                                                        ">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                                            <button
                                                                class="accordion-button shadow text-body-secondary active"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#ebpanelsStayOpen-collapseOne"
                                                                aria-expanded="true"
                                                                aria-controls="panelsStayOpen-collapseOne">
                                                                Superior Top 3 RIASEC -
                                                                {{ $workInterestSuperiorResult['top_3_riasec'] ?? '' }}
                                                            </button>
                                                        </h2>
                                                        <div id="ebpanelsStayOpen-collapseOne"
                                                            class="accordion-collapse collapse show color-black"
                                                            aria-labelledby="panelsStayOpen-headingOne">
                                                            <div class="accordion-body p-3">
                                                                {{ $workInterestSuperiorResult['top_3_riasec_description'] ?? '' }}
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="accordion mr-3 p-1 shadow-deep"
                                                    style="
                                                                            border-radius: 8px;
                                                                        "
                                                    id="accordionPanelsStayOpenExample">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                                            <button
                                                                class="accordion-button shadow text-body-secondary active"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#panelsStayOpen-collapseOne"
                                                                aria-expanded="true"
                                                                aria-controls="panelsStayOpen-collapseOne">
                                                                Employee Top 3 RIASEC -
                                                                {{ $workInterestEmployeeResult['top_3_riasec'] ?? '' }}
                                                            </button>
                                                        </h2>
                                                        <div id="panelsStayOpen-collapseOne"
                                                            class="accordion-collapse collapse show color-black"
                                                            aria-labelledby="panelsStayOpen-headingOne">
                                                            <div class="accordion-body p-3">
                                                                {{ $workInterestEmployeeResult['top_3_riasec_description'] ?? '' }}
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="accordion mr-3 p-1 shadow-deep"
                                                    style="
                                                                            border-radius: 8px;
                                                                        "
                                                    id="accordionPanelsStayOpenExample">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                                            <button
                                                                class="accordion-button shadow text-body-secondary active"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#panelsStayOpen-collapseOne"
                                                                aria-expanded="true"
                                                                aria-controls="panelsStayOpen-collapseOne">
                                                                Candidate Top 3 RIASEC -
                                                                {{ $workInterestCandidateResult['top_3_riasec'] ?? '' }}
                                                            </button>
                                                        </h2>
                                                        <div id="panelsStayOpen-collapseOne"
                                                            class="accordion-collapse collapse show color-black"
                                                            aria-labelledby="panelsStayOpen-headingOne">
                                                            <div class="accordion-body p-3">
                                                                {{ $workInterestCandidateResult['top_3_riasec_description'] ?? '' }}
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- riasec end --}}
                            @if (request('report') == 'talent_pillar')
                                <div class="lg:col-span-12 col-span-12">
                                    <div class="card h-full mt-4 shadow-deep">
                                        <header class="card-header">
                                            <h4 class="card-title">Talent Pillar</h4>
                                        </header>
                                        <div class="card-body p-6">
                                            {{-- @if (auth()->user()->is_personality_motivation_completed == 1) --}}
                                            {{-- <div id="talent_pillar"></div> --}}
                                            {{-- @else
                                        <div class="container text-center bg_secondary_green p-5" style="
                                    border-radius: 16px;">
                                            <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                            </iconify-icon>
                                            <h4>Data Not Available </h4>
                                        </div>
                                        @endif --}}
                                            <div class="">
                                                <div class="slider-container">
                                                    <div class="slider-label accordion-button cursor-pointer"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#criticalThinkingAccordion">Critical Thinking
                                                        <span>
                                                            <iconify-icon icon="iconamoon:arrow-down-2-light">
                                                            </iconify-icon>
                                                        </span>
                                                    </div>

                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            @if (isset($workCompetencySuperiorResult['Critical Thinking']) &&
                                                                    $workCompetencySuperiorResult['Critical Thinking'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencySuperiorResult['Critical Thinking'] ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($workCompetencyEmployeeResult['Critical Thinking']) &&
                                                                    $workCompetencyEmployeeResult['Critical Thinking'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyEmployeeResult['Critical Thinking'] ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($workCompetencyCandidateResult['Critical Thinking']) &&
                                                                    $workCompetencyCandidateResult['Critical Thinking'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyCandidateResult['Critical Thinking'] ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        <div class="emp_p population_hide hidden_population"
                                                            @if (isset($workCompetencyOverallResult['Critical Thinking']) &&
                                                                    $workCompetencyOverallResult['Critical Thinking'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyOverallResult['Critical Thinking'] ?? 0 }}%;" @endif>
                                                            P
                                                        </div>
                                                        <div class="department department_population_hide hidden_department_population"
                                                            @if (isset($workCompetencyOverallResult['Critical Thinking']) &&
                                                                    $workCompetencyOverallResult['Critical Thinking'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyOverallResult['Critical Thinking'] ?? 0 }}%;" @endif>
                                                            D
                                                        </div>

                                                    </div>
                                                    {{-- <div class="slider-label">OpennesH</div> --}}
                                                </div>
                                                <div class="accordion-item pl-8">

                                                    <div id="criticalThinkingAccordion"
                                                        class="accordion-collapse collapse  color-black"
                                                        aria-labelledby="panelsStayOpen-headingOne">
                                                        <div class="accordion-body font13 text-slate-600">

                                                            Skilled in breaking down complex issues, using expertise
                                                            well, and communicating effectively, especially in writing.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slider-container">
                                                    <div class="slider-label accordion-button cursor-pointer"
                                                        data-bs-toggle="collapse" data-bs-target="#creativityAccordion">
                                                        Creativity
                                                        <span>
                                                            <iconify-icon icon="iconamoon:arrow-down-2-light">
                                                            </iconify-icon>
                                                        </span>
                                                    </div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            @if (isset($workCompetencySuperiorResult['Creativity']) && $workCompetencySuperiorResult['Creativity'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencySuperiorResult['Creativity'] ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($workCompetencyEmployeeResult['Creativity']) && $workCompetencyEmployeeResult['Creativity'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyEmployeeResult['Creativity'] ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($workCompetencyCandidateResult['Creativity']) && $workCompetencyCandidateResult['Creativity'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyCandidateResult['Creativity'] ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        <div class="emp_p population_hide hidden_population"
                                                            @if (isset($workCompetencyOverallResult['Creativity']) && $workCompetencyOverallResult['Creativity'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyOverallResult['Creativity'] ?? 0 }}%;" @endif>
                                                            P
                                                        </div>
                                                        <div class="department department_population_hide hidden_department_population"
                                                            @if (isset($workCompetencyOverallResult['Creativity']) && $workCompetencyOverallResult['Creativity'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyOverallResult['Creativity'] ?? 0 }}%;" @endif>
                                                            D
                                                        </div>

                                                    </div>
                                                    {{-- <div class="slider-label">OpennesH</div> --}}
                                                </div>
                                                <div class="accordion-item pl-8">

                                                    <div id="creativityAccordion"
                                                        class="accordion-collapse collapse  color-black"
                                                        aria-labelledby="panelsStayOpen-headingOne">
                                                        <div class="accordion-body font13 text-slate-600">
                                                            Excels in generating new ideas, embraces learning, and
                                                            drives change with creative and strategic thinking.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slider-container">
                                                    <div class="slider-label accordion-button cursor-pointer"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#communicationAccordion">
                                                        Communication
                                                        <span>
                                                            <iconify-icon icon="iconamoon:arrow-down-2-light">
                                                            </iconify-icon>
                                                        </span>
                                                    </div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            @if (isset($workCompetencySuperiorResult['Communication']) && $workCompetencySuperiorResult['Communication'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencySuperiorResult['Communication'] ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($workCompetencyEmployeeResult['Communication']) && $workCompetencyEmployeeResult['Communication'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyEmployeeResult['Communication'] ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($workCompetencyCandidateResult['Communication']) && $workCompetencyCandidateResult['Communication'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyCandidateResult['Communication'] ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        <div class="emp_p population_hide hidden_population"
                                                            @if (isset($workCompetencyOverallResult['Communication']) && $workCompetencyOverallResult['Communication'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyOverallResult['Communication'] ?? 0 }}%;" @endif>
                                                            P
                                                        </div>
                                                        <div class="department department_population_hide hidden_department_population"
                                                            @if (isset($workCompetencyOverallResult['Communication']) && $workCompetencyOverallResult['Communication'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyOverallResult['Communication'] ?? 0 }}%;" @endif>
                                                            D
                                                        </div>
                                                    </div>
                                                    {{-- <div class="slider-label">OpennesH</div> --}}
                                                </div>
                                                <div class="accordion-item pl-8">

                                                    <div id="communicationAccordion"
                                                        class="accordion-collapse collapse  color-black"
                                                        aria-labelledby="panelsStayOpen-headingOne">
                                                        <div class="accordion-body font13 text-slate-600">
                                                            Strong in networking and influencing, communicates
                                                            confidently and relates well to others.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slider-container">
                                                    <div class="slider-label accordion-button cursor-pointer"
                                                        data-bs-toggle="collapse" data-bs-target="#leadershipAccordion">
                                                        Leadership
                                                        <span>
                                                            <iconify-icon icon="iconamoon:arrow-down-2-light">
                                                            </iconify-icon>
                                                        </span>
                                                    </div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            @if (isset($workCompetencySuperiorResult['Leadership']) && $workCompetencySuperiorResult['Leadership'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencySuperiorResult['Leadership'] ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($workCompetencyEmployeeResult['Leadership']) && $workCompetencyEmployeeResult['Leadership'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyEmployeeResult['Leadership'] ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($workCompetencyCandidateResult['Leadership']) && $workCompetencyCandidateResult['Leadership'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyCandidateResult['Leadership'] ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        <div class="emp_p population_hide hidden_population"
                                                            @if (isset($workCompetencyOverallResult['Leadership']) && $workCompetencyOverallResult['Leadership'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyOverallResult['Leadership'] ?? 0 }}%;" @endif>
                                                            P
                                                        </div>
                                                        <div class="department department_population_hide hidden_department_population"
                                                            @if (isset($workCompetencyOverallResult['Leadership']) && $workCompetencyOverallResult['Leadership'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyOverallResult['Leadership'] ?? 0 }}%;" @endif>
                                                            D
                                                        </div>

                                                    </div>
                                                    {{-- <div class="slider-label">OpennesH</div> --}}
                                                </div>
                                                <div class="accordion-item pl-8">

                                                    <div id="leadershipAccordion"
                                                        class="accordion-collapse collapse  color-black"
                                                        aria-labelledby="panelsStayOpen-headingOne">
                                                        <div class="accordion-body font13 text-slate-600">
                                                            Demonstrates strong leadership, proactively takes charge,
                                                            and assumes responsibility.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slider-container">
                                                    <div class="slider-label accordion-button cursor-pointer"
                                                        data-bs-toggle="collapse" data-bs-target="#teamworkAccordion">
                                                        Teamwork <span>
                                                            <iconify-icon icon="iconamoon:arrow-down-2-light">
                                                            </iconify-icon>
                                                        </span>
                                                    </div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            @if (isset($workCompetencySuperiorResult['Teamwork']) && $workCompetencySuperiorResult['Teamwork'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencySuperiorResult['Teamwork'] ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($workCompetencyEmployeeResult['Teamwork']) && $workCompetencyEmployeeResult['Teamwork'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyEmployeeResult['Teamwork'] ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($workCompetencyCandidateResult['Teamwork']) && $workCompetencyCandidateResult['Teamwork'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyCandidateResult['Teamwork'] ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        <div class="emp_p population_hide hidden_population"
                                                            @if (isset($workCompetencyOverallResult['Teamwork']) && $workCompetencyOverallResult['Teamwork'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyOverallResult['Teamwork'] ?? 0 }}%;" @endif>
                                                            P
                                                        </div>
                                                        <div class="department department_population_hide hidden_department_population"
                                                            @if (isset($workCompetencyOverallResult['Teamwork']) && $workCompetencyOverallResult['Teamwork'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyOverallResult['Teamwork'] ?? 0 }}%;" @endif>
                                                            D
                                                        </div>

                                                    </div>
                                                    {{-- <div class="slider-label">OpennesH</div> --}}
                                                </div>
                                                <div class="accordion-item pl-8">

                                                    <div id="teamworkAccordion"
                                                        class="accordion-collapse collapse  color-black"
                                                        aria-labelledby="panelsStayOpen-headingOne">
                                                        <div class="accordion-body font13 text-slate-600">
                                                            Prioritizes team and client needs, works well with others,
                                                            and aligns personal values with the organization.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slider-container">
                                                    <div class="slider-label accordion-button cursor-pointer"
                                                        data-bs-toggle="collapse" data-bs-target="#adaptabilityAccordion">
                                                        Adaptability
                                                        <span>
                                                            <iconify-icon icon="iconamoon:arrow-down-2-light">
                                                            </iconify-icon>
                                                        </span>
                                                    </div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            @if (isset($workCompetencySuperiorResult['Adaptability']) && $workCompetencySuperiorResult['Adaptability'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencySuperiorResult['Adaptability'] ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($workCompetencyEmployeeResult['Adaptability']) && $workCompetencyEmployeeResult['Adaptability'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyEmployeeResult['Adaptability'] ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($workCompetencyCandidateResult['Adaptability']) && $workCompetencyCandidateResult['Adaptability'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyCandidateResult['Adaptability'] ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        <div class="emp_p population_hide hidden_population"
                                                            @if (isset($workCompetencyOverallResult['Adaptability']) && $workCompetencyOverallResult['Adaptability'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyOverallResult['Adaptability'] ?? 0 }}%;" @endif>
                                                            P
                                                        </div>
                                                        <div class="department department_population_hide hidden_department_population"
                                                            @if (isset($workCompetencyOverallResult['Adaptability']) && $workCompetencyOverallResult['Adaptability'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyOverallResult['Adaptability'] ?? 0 }}%;" @endif>
                                                            D
                                                        </div>

                                                    </div>
                                                    {{-- <div class="slider-label">OpennesH</div> --}}
                                                </div>
                                                <div class="accordion-item pl-8">

                                                    <div id="adaptabilityAccordion"
                                                        class="accordion-collapse collapse  color-black"
                                                        aria-labelledby="panelsStayOpen-headingOne">
                                                        <div class="accordion-body font13 text-slate-600">
                                                            Adapts to change, handles stress effectively, and recovers
                                                            quickly from setbacks.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="slider-container">
                                                    <div class="slider-label accordion-button cursor-pointer"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#systematicPlanningAccordion">Systematic
                                                        Planning <span>
                                                            <iconify-icon icon="iconamoon:arrow-down-2-light">
                                                            </iconify-icon>
                                                        </span>
                                                    </div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            @if (isset($workCompetencySuperiorResult['Systematic Planning']) &&
                                                                    $workCompetencySuperiorResult['Systematic Planning'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencySuperiorResult['Systematic Planning'] ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($workCompetencyEmployeeResult['Systematic Planning']) &&
                                                                    $workCompetencyEmployeeResult['Systematic Planning'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyEmployeeResult['Systematic Planning'] ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($workCompetencyCandidateResult['Systematic Planning']) &&
                                                                    $workCompetencyCandidateResult['Systematic Planning'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyCandidateResult['Systematic Planning'] ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        <div class="emp_p population_hide hidden_population"
                                                            @if (isset($workCompetencyOverallResult['Systematic Planning']) &&
                                                                    $workCompetencyOverallResult['Systematic Planning'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyOverallResult['Systematic Planning'] ?? 0 }}%;" @endif>
                                                            P
                                                        </div>
                                                        <div class="department department_population_hide hidden_department_population"
                                                            @if (isset($workCompetencyOverallResult['Systematic Planning']) &&
                                                                    $workCompetencyOverallResult['Systematic Planning'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyOverallResult['Systematic Planning'] ?? 0 }}%;" @endif>
                                                            D
                                                        </div>

                                                    </div>
                                                    {{-- <div class="slider-label">OpennesH</div> --}}
                                                </div>
                                                <div class="accordion-item pl-8">

                                                    <div id="systematicPlanningAccordion"
                                                        class="accordion-collapse collapse  color-black"
                                                        aria-labelledby="panelsStayOpen-headingOne">
                                                        <div class="accordion-body font13 text-slate-600">
                                                            Plans and organizes work systematically, follows procedures,
                                                            and focuses on providing quality service.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="slider-container">
                                                    <div class="slider-label accordion-button cursor-pointer text-left"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#achievementOreientationAccordion">Achievement
                                                        Orientation <span>
                                                            <iconify-icon icon="iconamoon:arrow-down-2-light">
                                                            </iconify-icon>
                                                        </span>
                                                    </div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            @if (isset($workCompetencySuperiorResult['Achievement Orientation']) &&
                                                                    $workCompetencySuperiorResult['Achievement Orientation'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencySuperiorResult['Achievement Orientation'] ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($workCompetencyEmployeeResult['Achievement Orientation']) &&
                                                                    $workCompetencyEmployeeResult['Achievement Orientation'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyEmployeeResult['Achievement Orientation'] ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($workCompetencyCandidateResult['Achievement Orientation']) &&
                                                                    $workCompetencyCandidateResult['Achievement Orientation'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyCandidateResult['Achievement Orientation'] ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        <div class="emp_p population_hide hidden_population"
                                                            @if (isset($workCompetencyOverallResult['Achievement Orientation']) &&
                                                                    $workCompetencyOverallResult['Achievement Orientation'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyOverallResult['Achievement Orientation'] ?? 0 }}%;" @endif>
                                                            P
                                                        </div>
                                                        <div class="department department_population_hide hidden_department_population"
                                                            @if (isset($workCompetencyOverallResult['Achievement Orientation']) &&
                                                                    $workCompetencyOverallResult['Achievement Orientation'] == 100) style="left: 93%;" @else style="left: {{ $workCompetencyOverallResult['Achievement Orientation'] ?? 0 }}%;" @endif>
                                                            D
                                                        </div>
                                                    </div>
                                                    {{-- <div class="slider-label">OpennesH</div> --}}
                                                </div>
                                                <div class="accordion-item pl-8">

                                                    <div id="achievementOreientationAccordion"
                                                        class="accordion-collapse collapse  color-black"
                                                        aria-labelledby="panelsStayOpen-headingOne">
                                                        <div class="accordion-body font13 text-slate-600">
                                                            Targets results, aligns work closely with outcomes,
                                                            understands business essentials, and seeks personal growth
                                                            and career development opportunities.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- talent_pillar end --}}

                            @if (request('report') == 'cognitive_ability')
                                <div class="lg:col-span-12 col-span-12">
                                    <div class="card h-full mt-4 shadow-deep">
                                        <header class="card-header">
                                            <h4 class="card-title">Cognitive Ability</h4>
                                        </header>
                                        <div class="card-body p-6">

                                            {{-- @if (auth()->user()->is_personality_motivation_completed == 1) --}}
                                            {{-- <div id="cognitive"></div> --}}
                                            {{-- @else
                                                <div class="container text-center bg_secondary_green p-5" style="
                                                    border-radius: 16px;">
                                                            <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                                            </iconify-icon>
                                                            <h4>Data Not Available </h4>
                                                        </div>
                                                        @endif --}}
                                            <div class="container ">



                                                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10 mb-12">
                                                    <!--begin::Order details-->
                                                    <div class="card card-flush py-0 flex-row-fluid">
                                                        <!--begin::Card header-->
                                                        <div class="card-header"
                                                            style="border-bottom: 1px dashed gray !important;">
                                                            <div class="card-title">
                                                                <h2>Overall</h2>
                                                            </div>
                                                        </div>
                                                        <!--end::Card header-->

                                                        <!--begin::Card body-->
                                                        <div class="card-body p-2 pb-0">
                                                            <div class="table-responsive">
                                                                <!--begin::Table-->
                                                                <table
                                                                    class="table align-middle table-row-bordered mb-0 fs-6 gy-2 min-w-300px">
                                                                    <tbody class="fw-semibold text-gray-600">
                                                                        {{-- <tr>
                                                                                <td class="text-muted">
                                                                                    <div class="d-flex align-items-center">
                                                                                        <div class="emp_a emp_th">S
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="fw-bold text-end">{{ $cognitiveLevelForSuperior ?? 'Low'
                                                                                }}</td>
                                                                            </tr> --}}
                                                                        <tr>
                                                                            <td class="text-muted">
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="emp_b emp_th">E
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fw-bold text-end">
                                                                                {{ $cognitiveLevelForEmployee ?? 'Low' }}
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td class="text-muted">
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="emp_b emp_th">C
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fw-bold text-end">
                                                                                {{ $cognitiveLevelForCandidate ?? 'Low' }}
                                                                            </td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>
                                                                <!--end::Table-->
                                                            </div>
                                                        </div>
                                                        <!--end::Card body-->
                                                    </div>
                                                    <!--end::Order details-->

                                                </div>

                                                <div class="slider-container" data-bs-toggle="modal"
                                                    data-bs-target="#openness">
                                                    <div class="slider-label">Quantitative
                                                        Knowledg{{ $first_title ?? 'E' }}</div>
                                                    <div class="slider-track">

                                                        <div class="d-flex justify-content-around"
                                                            style="top: -28px; position: relative;">
                                                            <div class="slider-legend_cognitive"
                                                                style="
                                                            background: #ff4639f7;">
                                                                L0</div>
                                                            <div class="slider-legend_cognitive"
                                                                style="
                                                            background: #f3e95ff7;">
                                                                L1</div>
                                                            <div class="slider-legend_cognitive"
                                                                style="
                                                         background: #d3c611;">
                                                                L2</div>
                                                            <div class="slider-legend_cognitive"
                                                                style="
                                                            background: #279d27;">
                                                                L3</div>
                                                        </div>

                                                        <div class="emp_a"
                                                            @if (isset($cognitiveSuperiorResult['Quantitative Knowledge']) &&
                                                                    $cognitiveSuperiorResult['Quantitative Knowledge'] / 3 == 1) style="left: 93%;" @else style="left: {{ ($cognitiveSuperiorResult['Quantitative Knowledge'] / 3) * 100 ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($cognitiveEmployeeResult['Quantitative Knowledge']) &&
                                                                    $cognitiveEmployeeResult['Quantitative Knowledge'] / 3 == 1) style="left: 93%;" @else style="left: {{ ($cognitiveEmployeeResult['Quantitative Knowledge'] / 3) * 100 ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($cognitiveCandidateResult['Quantitative Knowledge']) &&
                                                                    $cognitiveCandidateResult['Quantitative Knowledge'] / 3 == 1) style="left: 93%;" @else style="left: {{ ($cognitiveCandidateResult['Quantitative Knowledge'] / 3) * 100 ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        {{-- <div class="emp_p population_hide hidden_population"
                        @if (isset($cognitiveOverallResult['Quantitative Knowledge']) && $cognitiveOverallResult['Quantitative Knowledge'] / 3 == 1) style="left: 93%;" @else style="left: {{ ($cognitiveSuperiorResult['Quantitative Knowledge'] / 3)*100 ?? 0 }}%;" @endif>
                            P
                        </div>
                        <div class="department department_population_hide hidden_department_population"
                        @if (isset($cognitiveOverallResult['Quantitative Knowledge']) && $cognitiveOverallResult['Quantitative Knowledge'] / 3 == 1) style="left: 93%;" @else style="left: {{ ($cognitiveSuperiorResult['Quantitative Knowledge'] / 3)*100 ?? 0 }}%;" @endif>
                            D
                        </div> --}}

                                                    </div>

                                                </div>
                                                <div class="slider-container">
                                                    <div class="slider-label">Comprehension
                                                        Knowledg{{ $first_title ?? 'E' }}</div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            @if (isset($cognitiveSuperiorResult['Comprehension Knowledge']) &&
                                                                    $cognitiveSuperiorResult['Comprehension Knowledge'] / 3 == 1) style="left: 93%;" @else style="left: {{ ($cognitiveSuperiorResult['Comprehension Knowledge'] / 3) * 100 ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($cognitiveEmployeeResult['Comprehension Knowledge']) &&
                                                                    $cognitiveEmployeeResult['Comprehension Knowledge'] / 3 == 1) style="left: 93%;" @else style="left: {{ ($cognitiveEmployeeResult['Comprehension Knowledge'] / 3) * 100 ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($cognitiveCandidateResult['Comprehension Knowledge']) &&
                                                                    $cognitiveCandidateResult['Comprehension Knowledge'] / 3 == 1) style="left: 93%;" @else style="left: {{ ($cognitiveCandidateResult['Comprehension Knowledge'] / 3) * 100 ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        {{-- <div class="emp_p population_hide hidden_population"
                        @if (isset($cognitiveOverallResult['Comprehension Knowledge']) && $cognitiveOverallResult['Comprehension Knowledge'] / 3 == 1) style="left: 93%;" @else style="left: {{ ($cognitiveSuperiorResult['Comprehension Knowledge'] / 3)*100 ?? 0 }}%;" @endif>
                            P
                        </div>
                        <div class="department department_population_hide hidden_department_population"
                        @if (isset($cognitiveOverallResult['Comprehension Knowledge']) && $cognitiveOverallResult['Comprehension Knowledge'] / 3 == 1) style="left: 93%;" @else style="left: {{ ($cognitiveSuperiorResult['Comprehension Knowledge'] / 3)*100 ?? 0 }}%;" @endif>
                            D
                        </div> --}}
                                                    </div>

                                                </div>
                                                <div class="slider-container">
                                                    <div class="slider-label">Visual Reasoning</div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            @if (isset($cognitiveSuperiorResult['Visual Reasoning']) && $cognitiveSuperiorResult['Visual Reasoning'] / 3 == 1) style="left: 93%;" @else style="left: {{ ($cognitiveSuperiorResult['Visual Reasoning'] / 3) * 100 ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($cognitiveEmployeeResult['Visual Reasoning']) && $cognitiveEmployeeResult['Visual Reasoning'] / 3 == 1) style="left: 93%;" @else style="left: {{ ($cognitiveEmployeeResult['Visual Reasoning'] / 3) * 100 ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($cognitiveCandidateResult['Visual Reasoning']) && $cognitiveCandidateResult['Visual Reasoning'] / 3 == 1) style="left: 93%;" @else style="left: {{ ($cognitiveCandidateResult['Visual Reasoning'] / 3) * 100 ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        {{-- <div class="emp_p population_hide hidden_population"
                        @if (isset($cognitiveOverallResult['Visual Reasoning']) && $cognitiveOverallResult['Visual Reasoning'] / 3 == 1) style="left: 93%;" @else style="left: {{ ($cognitiveSuperiorResult['Visual Reasoning'] / 3)*100 ?? 0 }}%;" @endif>
                            P
                        </div>
                        <div class="department department_population_hide hidden_department_population"
                        @if (isset($cognitiveOverallResult['Visual Reasoning']) && $cognitiveOverallResult['Visual Reasoning'] / 3 == 1) style="left: 93%;" @else style="left: {{ ($cognitiveSuperiorResult['Visual Reasoning'] / 3)*100 ?? 0 }}%;" @endif>
                            D
                        </div> --}}
                                                    </div>

                                                </div>
                                                <div class="slider-container">
                                                    <div class="slider-label">Fluid Reasoning</div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            @if (isset($cognitiveSuperiorResult['Fluid Reasoning']) && $cognitiveSuperiorResult['Fluid Reasoning'] / 3 == 1) style="left: 93%;" @else style="left: {{ ($cognitiveSuperiorResult['Fluid Reasoning'] / 3) * 100 ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($cognitiveEmployeeResult['Fluid Reasoning']) && $cognitiveEmployeeResult['Fluid Reasoning'] / 3 == 1) style="left: 93%;" @else style="left: {{ ($cognitiveEmployeeResult['Fluid Reasoning'] / 3) * 100 ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($cognitiveCandidateResult['Fluid Reasoning']) && $cognitiveCandidateResult['Fluid Reasoning'] / 3 == 1) style="left: 93%;" @else style="left: {{ ($cognitiveCandidateResult['Fluid Reasoning'] / 3) * 100 ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                        {{-- <div class="emp_p population_hide hidden_population"
                            @if (isset($cognitiveOverallResult['Fluid Reasoning']) && $cognitiveOverallResult['Fluid Reasoning'] / 3 == 1) style="left: 93%;" @else style="left: {{ ($cognitiveSuperiorResult['Fluid Reasoning'] / 3)*100 ?? 0 }}%;" @endif>
                                P
                            </div>
                            <div class="department department_population_hide hidden_department_population"
                            @if (isset($cognitiveOverallResult['Fluid Reasoning']) && $cognitiveOverallResult['Fluid Reasoning'] / 3 == 1) style="left: 93%;" @else style="left: {{ ($cognitiveSuperiorResult['Fluid Reasoning'] / 3)*100 ?? 0 }}%;" @endif>
                                D
                            </div> --}}
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- cognitive end --}}

                            {{-- Team Dynamics Start --}}

                            @if (request('report') == 'team_dynamics')
                                @php
                                    $facets = \App\Models\MasterFacet::all();
                                    $teamDynamicsFacets = [];
                                    foreach ($facets as $facet) {
                                        $teamDynamicsFacets[$facet->title] = $facet->point;
                                    }

                                    $teamDynamicsFacetDescriptions = [];

                                    foreach ($facets as $facet) {
                                        $teamDynamicsFacetDescriptions[$facet->title] = [
                                            'low' => $facet->low_description,
                                            'medium' => $facet->medium_description,
                                            'high' => $facet->high_description,
                                        ];
                                    }

                                    function returnStyle($facetName, $facetPoint)
                                    {
                                        if ($facetPoint > 3.75) {
                                            $style =
                                                'left: 76%;padding: 15px 12.5%;background: #fdd262;border-radius: 22px;';
                                        } elseif ($facetPoint <= 3.75 && $facetPoint > 1.25) {
                                            $style =
                                                'left: 26%;padding: 15px 25%;background: #fdd262;border-radius: 22px;';
                                        } else {
                                            $style =
                                                'left: 0%;padding: 15px 12.5%;background: #fdd262;border-radius: 22px;';
                                        }

                                        return $style;
                                    }

                                @endphp
                                <div class="lg:col-span-12 col-span-12">
                                    <div class="card h-full mt-4 shadow-deep">
                                        <header class="card-header">
                                            <h4 class="card-title">Team DynamicH</h4>
                                        </header>
                                        <div class="card-body p-6">
                                            <div class="container">

                                                <div class="slider-container">
                                                    {{-- <div class="slider-label">Diplomacy</div> --}}
                                                    <div class="slider-label"> Self-AssurednesH</div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            style="{{ returnStyle('Cooperation', $teamDynamicsFacets['Cooperation']) }}">
                                                        </div>
                                                        <div class="emp_a"
                                                            @if (isset($teamDynamicsSuperiorResult->diplomacy_avg) && ($teamDynamicsSuperiorResult->diplomacy_avg / 5) * 100 == 100) style="left: 93%;"@else
                                style="left: {{ ($teamDynamicsSuperiorResult->diplomacy_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($teamDynamicsEmployeeResult->diplomacy_avg) && ($teamDynamicsEmployeeResult->diplomacy_avg / 5) * 100 == 100) style="left: 93%;"@else
                                style="left: {{ ($teamDynamicsEmployeeResult->diplomacy_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>

                                                        <div class="candidate"
                                                            @if (isset($teamDynamicsCandidateResult->diplomacy_avg) &&
                                                                    ($teamDynamicsCandidateResult->diplomacy_avg / 5) * 100 == 100) style="left: 93%;"@else
                                    style="left: {{ ($teamDynamicsCandidateResult->diplomacy_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                    </div>
                                                    <div class="slider-label">Cooperation</div>

                                                </div>
                                                <div class="d-flex justify-content-evenly">
                                                    <div class="accordion  ml-28" id="cooperationFacetAccordionDivLow">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="cooperationFacetAccordionHeadingLow">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#cooperationFacetAccordionLow"
                                                                    aria-expanded="true"
                                                                    aria-controls="cooperationFacetAccordionLow">
                                                                    Low<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="cooperationFacetAccordionLow"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="cooperationFacetAccordionHeadingLow">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Cooperation']['low'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion  ml-28" id="cooperationFacetAccordionDivMedium">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="cooperationFacetAccordionHeadingMedium">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#cooperationFacetAccordionMedium"
                                                                    aria-expanded="true"
                                                                    aria-controls="cooperationFacetAccordionMedium">
                                                                    Medium<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="cooperationFacetAccordionMedium"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="cooperationFacetAccordionHeadingMedium">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Cooperation']['medium'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion  ml-28" id="cooperationFacetAccordionDivHigh">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="cooperationFacetAccordionHeadingHigh">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#cooperationFacetAccordionHigh"
                                                                    aria-expanded="true"
                                                                    aria-controls="cooperationFacetAccordionHigh">
                                                                    High<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="cooperationFacetAccordionHigh"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="cooperationFacetAccordionHeadingHigh">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Cooperation']['high'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="slider-container">
                                                    {{-- <div class="slider-label">Belief</div> --}}
                                                    <div class="slider-label"> Skepticism</div>

                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            style="{{ returnStyle('Trust', $teamDynamicsFacets['Trust']) }}">
                                                        </div>
                                                        <div class="emp_a"
                                                            @if (isset($teamDynamicsSuperiorResult->belief_avg) && ($teamDynamicsSuperiorResult->belief_avg / 5) * 100 == 100) style="left: 93%;"@else
                                style="left: {{ ($teamDynamicsSuperiorResult->belief_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($teamDynamicsEmployeeResult->belief_avg) && ($teamDynamicsEmployeeResult->belief_avg / 5) * 100 == 100) style="left: 93%;"@else
                                style="left: {{ ($teamDynamicsEmployeeResult->belief_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($teamDynamicsCandidateResult->belief_avg) && ($teamDynamicsCandidateResult->belief_avg / 5) * 100 == 100) style="left: 93%;"@else
                                    style="left: {{ ($teamDynamicsCandidateResult->belief_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                    </div>
                                                    <div class="slider-label">Trust</div>
                                                </div>

                                                <div class="d-flex justify-content-evenly">
                                                    <div class="accordion  ml-28" id="trustFacetAccordionDivLow">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="trustFacetAccordionHeadingLow">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#trustFacetAccordionLow"
                                                                    aria-expanded="true"
                                                                    aria-controls="trustFacetAccordionLow">
                                                                    Low<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="trustFacetAccordionLow"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="trustFacetAccordionHeadingLow">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Trust']['low'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion  ml-28" id="trustFacetAccordionDivMedium">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="trustFacetAccordionHeadingMedium">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#trustFacetAccordionMedium"
                                                                    aria-expanded="true"
                                                                    aria-controls="trustFacetAccordionMedium">
                                                                    Medium<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="trustFacetAccordionMedium"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="trustFacetAccordionHeadingMedium">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Trust']['medium'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion  ml-28" id="trustFacetAccordionDivHigh">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="trustFacetAccordionHeadingHigh">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#trustFacetAccordionHigh"
                                                                    aria-expanded="true"
                                                                    aria-controls="trustFacetAccordionHigh">
                                                                    High<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="trustFacetAccordionHigh"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="trustFacetAccordionHeadingHigh">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Trust']['high'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="slider-container">
                                                    {{-- <div class="slider-label">Confidenc{{ $first_title ?? 'E' }}</div> --}}
                                                    <div class="slider-label">Humility</div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            style="{{ returnStyle('Assertiveness', $teamDynamicsFacets['Assertiveness']) }}">
                                                        </div>
                                                        <div class="emp_a"
                                                            @if (isset($teamDynamicsSuperiorResult->confidence_avg) &&
                                                                    ($teamDynamicsSuperiorResult->confidence_avg / 5) * 100 == 100) style="left: 93%;"@else
                                style="left: {{ ($teamDynamicsSuperiorResult->confidence_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($teamDynamicsEmployeeResult->confidence_avg) &&
                                                                    ($teamDynamicsEmployeeResult->confidence_avg / 5) * 100 == 100) style="left: 93%;"@else
                                style="left: {{ ($teamDynamicsEmployeeResult->confidence_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>

                                                        <div class="candidate"
                                                            @if (isset($teamDynamicsCandidateResult->confidence_avg) &&
                                                                    ($teamDynamicsCandidateResult->confidence_avg / 5) * 100 == 100) style="left: 93%;"@else
                                    style="left: {{ ($teamDynamicsCandidateResult->confidence_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                    </div>
                                                    <div class="slider-label"> AssertivenesH</div>
                                                </div>

                                                <div class="d-flex justify-content-evenly">
                                                    <div class="accordion  ml-28" id="assertivenessFacetAccordionDivLow">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="assertivenessFacetAccordionHeadingLow">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#assertivenessFacetAccordionLow"
                                                                    aria-expanded="true"
                                                                    aria-controls="assertivenessFacetAccordionLow">
                                                                    Low<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="assertivenessFacetAccordionLow"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="assertivenessFacetAccordionHeadingLow">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Assertiveness']['low'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion  ml-28"
                                                        id="assertivenessFacetAccordionDivMedium">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="assertivenessFacetAccordionHeadingMedium">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#assertivenessFacetAccordionMedium"
                                                                    aria-expanded="true"
                                                                    aria-controls="assertivenessFacetAccordionMedium">
                                                                    Medium<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="assertivenessFacetAccordionMedium"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="assertivenessFacetAccordionHeadingMedium">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Assertiveness']['medium'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion  ml-28" id="assertivenessFacetAccordionDivHigh">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="assertivenessFacetAccordionHeadingHigh">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#assertivenessFacetAccordionHigh"
                                                                    aria-expanded="true"
                                                                    aria-controls="assertivenessFacetAccordionHigh">
                                                                    High<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="assertivenessFacetAccordionHigh"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="assertivenessFacetAccordionHeadingHigh">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Assertiveness']['high'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="slider-container">
                                                    {{-- <div class="slider-label">Drive to Achiev{{ $first_title ?? 'E' }}</div> --}}
                                                    <div class="slider-label"> Contentment</div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            style="{{ returnStyle('Achievement-Striving', $teamDynamicsFacets['Achievement-Striving']) }}">
                                                        </div>
                                                        <div class="emp_a"
                                                            @if (isset($teamDynamicsSuperiorResult->drive_to_achieve_avg) &&
                                                                    ($teamDynamicsSuperiorResult->drive_to_achieve_avg / 5) * 100 == 100) style="left: 93%;"@else
                                style="left: {{ ($teamDynamicsSuperiorResult->drive_to_achieve_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($teamDynamicsEmployeeResult->drive_to_achieve_avg) &&
                                                                    ($teamDynamicsEmployeeResult->drive_to_achieve_avg / 5) * 100 == 100) style="left: 93%;"@else
                                style="left: {{ ($teamDynamicsEmployeeResult->drive_to_achieve_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>

                                                        <div class="candidate"
                                                            @if (isset($teamDynamicsCandidateResult->drive_to_achieve_avg) &&
                                                                    ($teamDynamicsCandidateResult->drive_to_achieve_avg / 5) * 100 == 100) style="left: 93%;"@else
                                    style="left: {{ ($teamDynamicsCandidateResult->drive_to_achieve_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                    </div>
                                                    <div class="slider-label">Achievement-Striving</div>
                                                </div>

                                                <div class="d-flex justify-content-evenly">
                                                    <div class="accordion  ml-28"
                                                        id="achievementStrivingFacetAccordionDivLow">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="achievementStrivingFacetAccordionHeadingLow">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#achievementStrivingFacetAccordionLow"
                                                                    aria-expanded="true"
                                                                    aria-controls="achievementStrivingFacetAccordionLow">
                                                                    Low<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="achievementStrivingFacetAccordionLow"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="achievementStrivingFacetAccordionHeadingLow">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Achievement-Striving']['low'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion  ml-28"
                                                        id="achievementStrivingFacetAccordionDivMedium">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="achievementStrivingFacetAccordionHeadingMedium">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#achievementStrivingFacetAccordionMedium"
                                                                    aria-expanded="true"
                                                                    aria-controls="achievementStrivingFacetAccordionMedium">
                                                                    Medium<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="achievementStrivingFacetAccordionMedium"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="achievementStrivingFacetAccordionHeadingMedium">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Achievement-Striving']['medium'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion  ml-28"
                                                        id="achievementStrivingFacetAccordionDivHigh">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="achievementStrivingFacetAccordionHeadingHigh">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#achievementStrivingFacetAccordionHigh"
                                                                    aria-expanded="true"
                                                                    aria-controls="achievementStrivingFacetAccordionHigh">
                                                                    High<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="achievementStrivingFacetAccordionHigh"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="achievementStrivingFacetAccordionHeadingHigh">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Achievement-Striving']['high'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="slider-container">
                                                    {{-- <div class="slider-label">Responsibility</div> --}}
                                                    <div class="slider-label">Autonomy</div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            style="{{ returnStyle('Dutifulness', $teamDynamicsFacets['Dutifulness']) }}">
                                                        </div>
                                                        <div class="emp_a"
                                                            @if (isset($teamDynamicsSuperiorResult->responsibility_avg) &&
                                                                    ($teamDynamicsSuperiorResult->responsibility_avg / 5) * 100 == 100) style="left: 93%;"@else
                                style="left: {{ ($teamDynamicsSuperiorResult->responsibility_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($teamDynamicsEmployeeResult->responsibility_avg) &&
                                                                    ($teamDynamicsEmployeeResult->responsibility_avg / 5) * 100 == 100) style="left: 93%;"@else
                                style="left: {{ ($teamDynamicsEmployeeResult->responsibility_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>

                                                        <div class="candidate"
                                                            @if (isset($teamDynamicsCandidateResult->responsibility_avg) &&
                                                                    ($teamDynamicsCandidateResult->responsibility_avg / 5) * 100 == 100) style="left: 93%;"@else
                                    style="left: {{ ($teamDynamicsCandidateResult->responsibility_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                    </div>
                                                    <div class="slider-label"> DutifulnesH</div>
                                                </div>

                                                <div class="d-flex justify-content-evenly">
                                                    <div class="accordion  ml-28" id="dutifulnessFacetAccordionDivLow">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="dutifulnessFacetAccordionHeadingLow">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#dutifulnessFacetAccordionLow"
                                                                    aria-expanded="true"
                                                                    aria-controls="dutifulnessFacetAccordionLow">
                                                                    Low<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="dutifulnessFacetAccordionLow"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="dutifulnessFacetAccordionHeadingLow">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Dutifulness']['low'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion  ml-28" id="dutifulnessFacetAccordionDivMedium">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="dutifulnessFacetAccordionHeadingMedium">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#dutifulnessFacetAccordionMedium"
                                                                    aria-expanded="true"
                                                                    aria-controls="dutifulnessFacetAccordionMedium">
                                                                    Medium<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="dutifulnessFacetAccordionMedium"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="dutifulnessFacetAccordionHeadingMedium">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Dutifulness']['medium'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion  ml-28" id="dutifulnessFacetAccordionDivHigh">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="dutifulnessFacetAccordionHeadingHigh">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#dutifulnessFacetAccordionHigh"
                                                                    aria-expanded="true"
                                                                    aria-controls="dutifulnessFacetAccordionHigh">
                                                                    High<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="dutifulnessFacetAccordionHigh"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="dutifulnessFacetAccordionHeadingHigh">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Dutifulness']['high'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="slider-container">
                                                    {{-- <div class="slider-label">Innovation</div> --}}
                                                    <div class="slider-label"> Realistic-Pragmatism</div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            style="{{ returnStyle('Intellect', $teamDynamicsFacets['Intellect']) }}">
                                                        </div>
                                                        <div class="emp_a"
                                                            @if (isset($teamDynamicsSuperiorResult->innovation_avg) &&
                                                                    ($teamDynamicsSuperiorResult->innovation_avg / 5) * 100 == 100) style="left: 93%;"@else
                                style="left: {{ ($teamDynamicsSuperiorResult->innovation_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($teamDynamicsEmployeeResult->innovation_avg) &&
                                                                    ($teamDynamicsEmployeeResult->innovation_avg / 5) * 100 == 100) style="left: 93%;"@else
                                style="left: {{ ($teamDynamicsEmployeeResult->innovation_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($teamDynamicsCandidateResult->innovation_avg) &&
                                                                    ($teamDynamicsCandidateResult->innovation_avg / 5) * 100 == 100) style="left: 93%;"@else
                                    style="left: {{ ($teamDynamicsCandidateResult->innovation_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                    </div>
                                                    <div class="slider-label"> Intellect</div>
                                                </div>

                                                <div class="d-flex justify-content-evenly">
                                                    <div class="accordion  ml-28" id="intellectFacetAccordionDivLow">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="intellectFacetAccordionHeadingLow">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#intellectFacetAccordionLow"
                                                                    aria-expanded="true"
                                                                    aria-controls="intellectFacetAccordionLow">
                                                                    Low<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="intellectFacetAccordionLow"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="intellectFacetAccordionHeadingLow">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Intellect']['low'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion  ml-28" id="intellectFacetAccordionDivMedium">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="intellectFacetAccordionHeadingMedium">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#intellectFacetAccordionMedium"
                                                                    aria-expanded="true"
                                                                    aria-controls="intellectFacetAccordionMedium">
                                                                    Medium<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="intellectFacetAccordionMedium"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="intellectFacetAccordionHeadingMedium">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Intellect']['medium'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion  ml-28" id="intellectFacetAccordionDivHigh">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="intellectFacetAccordionHeadingHigh">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#intellectFacetAccordionHigh"
                                                                    aria-expanded="true"
                                                                    aria-controls="intellectFacetAccordionHigh">
                                                                    High<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="intellectFacetAccordionHigh"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="intellectFacetAccordionHeadingHigh">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Intellect']['high'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="slider-container">
                                                    {{-- <div class="slider-label">Open MindednesH</div> --}}
                                                    <div class="slider-label"> Traditional Values </div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            style="{{ returnStyle('Liberalism', $teamDynamicsFacets['Liberalism']) }}">
                                                        </div>
                                                        <div class="emp_a"
                                                            @if (isset($teamDynamicsSuperiorResult->open_mindedness_avg) &&
                                                                    ($teamDynamicsSuperiorResult->open_mindedness_avg / 5) * 100 == 100) style="left: 93%;"@else
                                style="left: {{ ($teamDynamicsSuperiorResult->open_mindedness_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($teamDynamicsEmployeeResult->open_mindedness_avg) &&
                                                                    ($teamDynamicsEmployeeResult->open_mindedness_avg / 5) * 100 == 100) style="left: 93%;"@else
                                style="left: {{ ($teamDynamicsEmployeeResult->open_mindedness_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($teamDynamicsCandidateResult->open_mindedness_avg) &&
                                                                    ($teamDynamicsCandidateResult->open_mindedness_avg / 5) * 100 == 100) style="left: 93%;"@else
                                    style="left: {{ ($teamDynamicsCandidateResult->open_mindedness_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                    </div>
                                                    <div class="slider-label"> Liberalism</div>
                                                </div>

                                                <div class="d-flex justify-content-evenly">
                                                    <div class="accordion  ml-28" id="liberalismFacetAccordionDivLow">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="liberalismFacetAccordionHeadingLow">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#liberalismFacetAccordionLow"
                                                                    aria-expanded="true"
                                                                    aria-controls="liberalismFacetAccordionLow">
                                                                    Low<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="liberalismFacetAccordionLow"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="liberalismFacetAccordionHeadingLow">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Liberalism']['low'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion  ml-28" id="liberalismFacetAccordionDivMedium">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="liberalismFacetAccordionHeadingMedium">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#liberalismFacetAccordionMedium"
                                                                    aria-expanded="true"
                                                                    aria-controls="liberalismFacetAccordionMedium">
                                                                    Medium<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="liberalismFacetAccordionMedium"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="liberalismFacetAccordionHeadingMedium">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Liberalism']['medium'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion  ml-28" id="liberalismFacetAccordionDivHigh">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="liberalismFacetAccordionHeadingHigh">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#liberalismFacetAccordionHigh"
                                                                    aria-expanded="true"
                                                                    aria-controls="liberalismFacetAccordionHigh">
                                                                    High<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="liberalismFacetAccordionHigh"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="liberalismFacetAccordionHeadingHigh">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Liberalism']['high'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="slider-container">
                                                    {{-- <div class="slider-label">Crowd Enjoyment</div> --}}
                                                    <div class="slider-label"> Independenc{{ $first_title ?? 'E' }}</div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            style="{{ returnStyle('Gregariousness', $teamDynamicsFacets['Gregariousness']) }}">
                                                        </div>
                                                        <div class="emp_a"
                                                            @if (isset($teamDynamicsSuperiorResult->crowd_enjoyment_avg) &&
                                                                    ($teamDynamicsSuperiorResult->crowd_enjoyment_avg / 5) * 100 == 100) style="left: 93%;"@else
                                style="left: {{ ($teamDynamicsSuperiorResult->crowd_enjoyment_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($teamDynamicsEmployeeResult->crowd_enjoyment_avg) &&
                                                                    ($teamDynamicsEmployeeResult->crowd_enjoyment_avg / 5) * 100 == 100) style="left: 93%;"@else
                                style="left: {{ ($teamDynamicsEmployeeResult->crowd_enjoyment_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($teamDynamicsCandidateResult->crowd_enjoyment_avg) &&
                                                                    ($teamDynamicsCandidateResult->crowd_enjoyment_avg / 5) * 100 == 100) style="left: 93%;"@else
                                    style="left: {{ ($teamDynamicsCandidateResult->crowd_enjoyment_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                    </div>
                                                    <div class="slider-label">GregariousnesH</div>
                                                </div>

                                                <div class="d-flex justify-content-evenly">
                                                    <div class="accordion  ml-28" id="gregariousnessFacetAccordionDivLow">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="gregariousnessFacetAccordionHeadingLow">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#gregariousnessFacetAccordionLow"
                                                                    aria-expanded="true"
                                                                    aria-controls="gregariousnessFacetAccordionLow">
                                                                    Low<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="gregariousnessFacetAccordionLow"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="gregariousnessFacetAccordionHeadingLow">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Gregariousness']['low'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion  ml-28"
                                                        id="gregariousnessFacetAccordionDivMedium">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="gregariousnessFacetAccordionHeadingMedium">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#gregariousnessFacetAccordionMedium"
                                                                    aria-expanded="true"
                                                                    aria-controls="gregariousnessFacetAccordionMedium">
                                                                    Medium<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="gregariousnessFacetAccordionMedium"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="gregariousnessFacetAccordionHeadingMedium">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Gregariousness']['medium'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion  ml-28"
                                                        id="gregariousnessFacetAccordionDivHigh">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="gregariousnessFacetAccordionHeadingHigh">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#gregariousnessFacetAccordionHigh"
                                                                    aria-expanded="true"
                                                                    aria-controls="gregariousnessFacetAccordionHigh">
                                                                    High<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="gregariousnessFacetAccordionHigh"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="gregariousnessFacetAccordionHeadingHigh">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Gregariousness']['high'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="slider-container">
                                                    {{-- <div class="slider-label">Feeling Awar{{ $first_title ?? 'E' }}</div> --}}
                                                    <div class="slider-label">Measured Emotionality</div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            style="{{ returnStyle('Emotionality', $teamDynamicsFacets['Emotionality']) }}">
                                                        </div>
                                                        <div class="emp_a"
                                                            @if (isset($teamDynamicsSuperiorResult->feeling_aware_avg) &&
                                                                    ($teamDynamicsSuperiorResult->feeling_aware_avg / 5) * 100 == 100) style="left: 93%;"@else
                                style="left: {{ ($teamDynamicsSuperiorResult->feeling_aware_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($teamDynamicsEmployeeResult->feeling_aware_avg) &&
                                                                    ($teamDynamicsEmployeeResult->feeling_aware_avg / 5) * 100 == 100) style="left: 93%;"@else
                                style="left: {{ ($teamDynamicsEmployeeResult->feeling_aware_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($teamDynamicsCandidateResult->feeling_aware_avg) &&
                                                                    ($teamDynamicsCandidateResult->feeling_aware_avg / 5) * 100 == 100) style="left: 93%;"@else
                                    style="left: {{ ($teamDynamicsCandidateResult->feeling_aware_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                    </div>
                                                    <div class="slider-label"> Emotionality</div>
                                                </div>

                                                <div class="d-flex justify-content-evenly">
                                                    <div class="accordion  ml-28" id="emotionalityFacetAccordionDivLow">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="emotionalityFacetAccordionHeadingLow">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#emotionalityFacetAccordionLow"
                                                                    aria-expanded="true"
                                                                    aria-controls="emotionalityFacetAccordionLow">
                                                                    Low<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="emotionalityFacetAccordionLow"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="emotionalityFacetAccordionHeadingLow">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Emotionality']['low'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion  ml-28"
                                                        id="emotionalityFacetAccordionDivMedium">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="emotionalityFacetAccordionHeadingMedium">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#emotionalityFacetAccordionMedium"
                                                                    aria-expanded="true"
                                                                    aria-controls="emotionalityFacetAccordionMedium">
                                                                    Medium<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="emotionalityFacetAccordionMedium"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="emotionalityFacetAccordionHeadingMedium">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Emotionality']['medium'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion  ml-28"
                                                        id="emotionalityFacetAccordionDivHigh">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="emotionalityFacetAccordionHeadingHigh">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#emotionalityFacetAccordionHigh"
                                                                    aria-expanded="true"
                                                                    aria-controls="emotionalityFacetAccordionHigh">
                                                                    High<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="emotionalityFacetAccordionHigh"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="emotionalityFacetAccordionHeadingHigh">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Emotionality']['high'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="slider-container">
                                                    {{-- <div class="slider-label">SteadinesH</div> --}}
                                                    <div class="slider-label"> Stress Sensitivity</div>
                                                    <div class="slider-track">
                                                        <div class="emp_a"
                                                            style="{{ returnStyle('Anxiety', $teamDynamicsFacets['Anxiety']) }}">
                                                        </div>
                                                        <div class="emp_a"
                                                            @if (isset($teamDynamicsSuperiorResult->steadiness_avg) &&
                                                                    ($teamDynamicsSuperiorResult->steadiness_avg / 5) * 100 == 100) style="left: 93%;"@else
                                style="left: {{ ($teamDynamicsSuperiorResult->steadiness_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            H</div>
                                                        <div class="emp_b"
                                                            @if (isset($teamDynamicsEmployeeResult->steadiness_avg) &&
                                                                    ($teamDynamicsEmployeeResult->steadiness_avg / 5) * 100 == 100) style="left: 93%;"@else
                                style="left: {{ ($teamDynamicsEmployeeResult->steadiness_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $first_title ?? 'E' }}</div>
                                                        <div class="candidate"
                                                            @if (isset($teamDynamicsCandidateResult->steadiness_avg) &&
                                                                    ($teamDynamicsCandidateResult->steadiness_avg / 5) * 100 == 100) style="left: 93%;"@else
                                    style="left: {{ ($teamDynamicsCandidateResult->steadiness_avg / 5) * 100 ?? 0 }}%;" @endif>
                                                            {{ $second_title ?? ' C' }}</div>
                                                    </div>
                                                    <div class="slider-label">Anxiety</div>
                                                </div>

                                                <div class="d-flex justify-content-evenly">
                                                    <div class="accordion  ml-28" id="anxietyFacetAccordionDivLow">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="anxietyFacetAccordionHeadingLow">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#anxietyFacetAccordionLow"
                                                                    aria-expanded="true"
                                                                    aria-controls="anxietyFacetAccordionLow">
                                                                    Low<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="anxietyFacetAccordionLow"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="anxietyFacetAccordionHeadingLow">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Anxiety']['low'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion  ml-28" id="anxietyFacetAccordionDivMedium">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="anxietyFacetAccordionHeadingMedium">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#anxietyFacetAccordionMedium"
                                                                    aria-expanded="true"
                                                                    aria-controls="anxietyFacetAccordionMedium">
                                                                    Medium<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="anxietyFacetAccordionMedium"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="anxietyFacetAccordionHeadingMedium">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Anxiety']['medium'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion  ml-28" id="anxietyFacetAccordionDivHigh">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="anxietyFacetAccordionHeadingHigh">
                                                                <button
                                                                    class="accordion-button shadow text-body-secondary justify-content-between"
                                                                    type="button" data-bs-toggle="collapse"
                                                                    data-bs-target="#anxietyFacetAccordionHigh"
                                                                    aria-expanded="true"
                                                                    aria-controls="anxietyFacetAccordionHigh">
                                                                    High<span>

                                                                    </span>
                                                                </button>
                                                            </h2>
                                                            <div id="anxietyFacetAccordionHigh"
                                                                class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9"
                                                                aria-labelledby="anxietyFacetAccordionHeadingHigh">
                                                                <div class="accordion-body font13 text-slate-600">
                                                                    {{ $teamDynamicsFacetDescriptions['Anxiety']['high'] ?? '' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Team Dynamics End --}}

                            {{-- <div class="lg:col-span-12 col-span-12">
                                    <div class="card h-full mt-4 shadow-deep" style="
                            width: 74%;      ">
                                        <header class="card-header">
                                            <h4 class="card-title">Quantitative Knowledge</h4>
                                        </header>
                                        <div class="card-body p-6">

                                            <div id="quantative"></div>

                                        </div>
                                    </div>
                                </div> --}}
                            {{-- quantative end --}}

                            {{-- <div class="lg:col-span-12 col-span-12">
                                    <div class="card h-full mt-4 shadow-deep" style="
                            width: 74%;      ">
                                        <header class="card-header">
                                            <h4 class="card-title">Comprehension Knowledge</h4>
                                        </header>
                                        <div class="card-body p-6">

                                            <div id="comprehension"></div>

                                        </div>
                                    </div>
                                </div> --}}
                            {{-- comprehension end --}}


                            {{-- <div class="lg:col-span-12 col-span-12">
                                    <div class="card h-full mt-4 shadow-deep" style="
                            width: 74%;      ">
                                        <header class="card-header">
                                            <h4 class="card-title">Visual Reasoning </h4>
                                        </header>
                                        <div class="card-body p-6">

                                            <div id="visual_reas"></div>

                                        </div>
                                    </div>
                                </div> --}}
                            {{-- visual_reas end --}}


                            {{-- <div class="lg:col-span-12 col-span-12">
                                    <div class="card h-full mt-4 shadow-deep" style="
                            width: 74%;      ">
                                        <header class="card-header">
                                            <h4 class="card-title">Fluid Reasoning </h4>
                                        </header>
                                        <div class="card-body p-6">

                                            <div id="fluid_reas"></div>

                                        </div>
                                    </div>
                                </div> --}}
                            {{-- fluid_reas end --}}

                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Charts Widget 1-->
                </div>

            </div>



        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->

@endsection
@section('scripts')
    <script>
        document.getElementById("population").addEventListener("change", function() {
            var elements = document.getElementsByClassName("population_hide");
            var raisec_ele = document.getElementsByClassName("raisec_container");

            for (var i = 0; i < elements.length; i++) {
                if (this.checked) {
                    elements[i].classList.remove("hidden_population");

                } else {
                    elements[i].classList.add("hidden_population");

                }
            }

            for (var i = 0; i < raisec_ele.length; i++) {
                if (this.checked) {
                    raisec_ele[i].classList.add("top_riasec");

                } else {
                    raisec_ele[i].classList.remove("top_riasec");

                }
            }
        });

        document.getElementById("department").addEventListener("change", function() {
            var elements = document.getElementsByClassName("department_population_hide");
            var raisec_ele = document.getElementsByClassName("raisec_container_department");

            for (var i = 0; i < elements.length; i++) {
                if (this.checked) {
                    elements[i].classList.remove("hidden_department_population");

                } else {
                    elements[i].classList.add("hidden_department_population");

                }
            }

            for (var i = 0; i < raisec_ele.length; i++) {
                if (this.checked) {
                    raisec_ele[i].classList.add("top_riasec_department");

                } else {
                    raisec_ele[i].classList.remove("top_riasec_department");

                }
            }
        });
    </script>
    {{-- <script>
                document.getElementById('validateForm').addEventListener('click', function(event) {
                    // Target only the original select elements with the class original-select
                    var selects = document.querySelectorAll('select.original-select');
                    var allValid = true;

                    selects.forEach(function(select) {
                        var feedback = select.parentElement.querySelector('.invalid-feedback');
                        if (!select.value) {
                            allValid = false;
                            select.classList.add('is-invalid');
                            if (feedback) {
                                feedback.style.display = 'block';
                            }
                        } else {
                            select.classList.remove('is-invalid');
                            if (feedback) {
                                feedback.style.display = 'none';
                            }
                        }
                    });

                    if (allValid) {
                        document.getElementById('myForm').submit();
                    }
                });
            
        </script> --}}



    {{-- <script>
            document.addEventListener('DOMContentLoaded', function () {
                const departmentFilter = $('#department_id');
                const jobOpeningFilter = $('#job_opening_id');
                const poolType = $('#pool_type');
                const applicationStatus = $('#application_status');
                const candidateFilter = $('#candidate_ids');
                const employeeFilter = $('#employee_ids');
                const maxSelections = 5;
            
                // Selected values (this data should be passed from the backend)
                let selectedCandidates = @json(request('candidate_ids', []));  // From the request
                let selectedEmployees = @json(request('employee_ids', []));  // From the request
            
                // Initialize Select2 with search enabled for candidate and employee filters
                function initializeSelect2() {
                    candidateFilter.select2({
                        placeholder: "Select Candidates",  // Add a placeholder
                        allowClear: true,  // Allows clearing the selection
                        minimumResultsForSearch: 0, // Always show the search box for candidates
                        dropdownCssClass: 'select2-dropdown-multi',  // Custom class for multi-select
                        width: '100%'  // Ensure the dropdown is responsive
                    });
            
                    employeeFilter.select2({
                        placeholder: "Select Employees",  // Add a placeholder
                        allowClear: true,  // Allows clearing the selection
                        minimumResultsForSearch: 0, // Always show the search box for employees
                        dropdownCssClass: 'select2-dropdown-multi',  // Custom class for multi-select
                        width: '100%'  // Ensure the dropdown is responsive
                    });
                }
            
                // Call the initialization function on page load
                initializeSelect2();
            
                // Function to set required attributes and show/hide elements based on pool type
                // function updateFormBasedOnPoolType() {
                //     if (poolType.val() === 'candidate_vs_candidate') {
                //         applicationStatus.show();
                //         $('#employee_ids').select2('close'); // Close the select2 dropdown
                //         $('#employee_ids').next('.select2-container').hide(); // Hide select2 wrapper
                //         employeeFilter.prop('required', false); // Make employee filter not required
                //         applicationStatus.prop('required', true); // Ensure application status is required
                //         loadCandidates(selectedCandidates); // Load only candidates for this pool type
                //     } else {
                //         applicationStatus.hide();
                //         $('#employee_ids').next('.select2-container').show(); // Show select2 wrapper
                //         employeeFilter.prop('required', true); // Ensure employee filter is required
                //         applicationStatus.prop('required', false); // Make application status not required
                //         loadCandidates(selectedCandidates); // Load both candidates and employees
                //         loadEmployees(selectedEmployees);
                //     }
                // }

                function updateFormBasedOnPoolType() {
                    if (poolType.val() === 'candidate_vs_candidate') {
                        $('#application_status_container').show(); // Show application status
                        $('#employee_ids_container').hide(); // Hide employee filter
                        employeeFilter.prop('required', false); // Make employee filter not required
                        applicationStatus.prop('required', true); // Ensure application status is required
                        loadCandidates(selectedCandidates); // Load only candidates for this pool type
                    } else {
                        $('#application_status_container').hide(); // Hide application status
                        $('#employee_ids_container').show(); // Show employee filter
                        employeeFilter.prop('required', true); // Ensure employee filter is required
                        applicationStatus.prop('required', false); // Make application status not required
                        loadCandidates(selectedCandidates); // Load both candidates and employees
                        loadEmployees(selectedEmployees);
                    }
                }

            
                // When the department is changed, load new job advertisements
                departmentFilter.on('change.select2', function () {
                    loadJobAdvertisements();
                });
            
                // When the job opening is changed, load the relevant candidates and employees
                jobOpeningFilter.on('change.select2', function () {
                    loadCandidates(selectedCandidates);
                    if (poolType.val() === 'candidate_vs_employee') {
                        loadEmployees(selectedEmployees);
                    }
                });
            
                // When the application status is changed, reload the candidates list
                applicationStatus.on('change.select2', function () {
                    loadCandidates(selectedCandidates); // Reload candidates based on the new application status
                });
            
                // When the pool type is changed, show/hide filters and load candidates/employees accordingly
                poolType.on('change.select2', function () {
                    updateFormBasedOnPoolType();
                });
            
                // Load job advertisements based on selected department
                function loadJobAdvertisements() {
                    const departmentId = departmentFilter.val();
                    if (departmentId) {
                        fetch(`/admin/job-opening/compare/get-job-openings?department_id=${departmentId}`)
                            .then(response => response.json())
                            .then(data => {
                                jobOpeningFilter.empty(); // Clear the current job options
                                data.jobs.forEach(job => {
                                    const option = new Option(job.job_title, job.id);
                                    jobOpeningFilter.append(option);
                                });
                                jobOpeningFilter.trigger('change.select2');  // Trigger change to load candidates
                            })
                            .catch(error => console.error('Error fetching job advertisements:', error));
                    }
                }
            
                // Load candidates based on selected department, job opening, and application status
                function loadCandidates(selectedCandidates) {
                    const departmentId = departmentFilter.val();
                    const jobOpeningId = jobOpeningFilter.val();
                    const status = applicationStatus.val();
            
                    if (departmentId && jobOpeningId) {
                        fetch(`/admin/job-opening/compare/get-candidates?department_id=${departmentId}&job_opening_id=${jobOpeningId}&status=${status}`)
                            .then(response => response.json())
                            .then(data => {
                                candidateFilter.empty(); // Clear previous candidates
                                data.candidates.forEach(candidate => {
                                    const option = new Option(candidate.name, candidate.id);
                                    candidateFilter.append(option);
                                });
                                reinitializeSelect2(candidateFilter, selectedCandidates); // Reinitialize Select2 for candidates with selected values
                            })
                            .catch(error => console.error('Error fetching candidates:', error));
                    }
                }
            
                // Load employees (for Candidate vs Employee pool type)
                function loadEmployees(selectedEmployees) {
                    fetch('/admin/job-opening/compare/get-employees')
                        .then(response => response.json())
                        .then(data => {
                            employeeFilter.empty();  // Clear previous employees
                            data.employees.forEach(employee => {
                                const option = new Option(employee.name, employee.id);
                                employeeFilter.append(option);
                            });
                            reinitializeSelect2(employeeFilter, selectedEmployees); // Reinitialize Select2 for employees with selected values
                        })
                        .catch(error => console.error('Error fetching employees:', error));
                }
            
                // Reinitialize Select2 for a specific dropdown and set selected values
                function reinitializeSelect2(selector, selectedValues) {
                    selector.select2('destroy');  // Destroy previous Select2 instance
                    selector.select2({
                        placeholder: selector === candidateFilter ? "Select Candidates" : "Select Employees",
                        allowClear: true,
                        minimumResultsForSearch: 0,  // Always show the search box
                        dropdownCssClass: 'select2-dropdown-multi',
                        width: '100%'
                    });
            
                    // Set the selected values dynamically
                    selectedValues.forEach(function (value) {
                        selector.find('option[value="' + value + '"]').attr('selected', 'selected');
                    });
            
                    // Re-trigger Select2 to apply the selected values
                    selector.trigger('change.select2');
                }
            
                // Handle maximum combined selections
                // candidateFilter.on('change.select2', handleMaxSelection);
                // employeeFilter.on('change.select2', handleMaxSelection);
            
                // Attach the event listeners AFTER initializing select2
                candidateFilter.on('change', function() {handleMaxSelection();});
                employeeFilter.on('change', function() {console.log('Employee filter changed');handleMaxSelection();});

                function handleMaxSelection() {
                    const candidateSelected = candidateFilter.find('option:selected').length;
                    const employeeSelected = employeeFilter.find('option:selected').length;
                    const totalSelected = candidateSelected + employeeSelected;

                    console.log("Total selected: ", totalSelected); // Debugging line

                    if (totalSelected > maxSelections) {
                        alert('You can only select up to 5 candidates and employees combined.');

                        // Undo the last selection based on which filter triggered the event
                        if ($(this).attr('id') === 'candidate_ids') {
                            candidateFilter.val(selectedCandidates).trigger('change');
                        } else {
                            employeeFilter.val(selectedEmployees).trigger('change');
                        }
                    }
                }
    
                // On page load, ensure the employee dropdown is hidden if "Candidate vs Candidate" is selected by default
                updateFormBasedOnPoolType();
            
                // Trigger department change on page load
                departmentFilter.trigger('change.select2');
            });
        </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const departmentFilter = $('#department_id');
            const jobOpeningFilter = $('#job_opening_id');
            const poolType = $('#pool_type');
            const applicationStatus = $('#application_status');
            const candidateFilter = $('#candidate_ids');
            const secondCandidateFilter = $('#second_candidate_ids'); // Second candidate filter
            const employeeFilter = $('#employee_ids');
            const maxSelections = 5;

            // Selected values (this data should be passed from the backend)
            let selectedCandidates = @json(request('candidate_ids', [])); // From the request
            let selectedEmployees = @json(request('employee_ids', [])); // From the request

            // Initialize Select2 with search enabled for candidate, second candidate, and employee filters
            function initializeSelect2() {
                candidateFilter.select2({
                    placeholder: "Select Candidates",
                    allowClear: true,
                    minimumResultsForSearch: 0,
                    dropdownCssClass: 'select2-dropdown-multi',
                    width: '100%'
                });

                secondCandidateFilter.select2({
                    placeholder: "Select Second Candidate",
                    allowClear: true,
                    minimumResultsForSearch: 0,
                    dropdownCssClass: 'select2-dropdown-multi',
                    width: '100%'
                });

                employeeFilter.select2({
                    placeholder: "Select Employees",
                    allowClear: true,
                    minimumResultsForSearch: 0,
                    dropdownCssClass: 'select2-dropdown-multi',
                    width: '100%'
                });
            }

            // Call the initialization function on page load
            initializeSelect2();

            // Function to set required attributes and show/hide elements based on pool type
            function updateFormBasedOnPoolType() {
                if (poolType.val() === 'candidate_vs_candidate') {
                    $('#application_status_container').show(); // Show application status
                    $('#employee_ids_container').hide(); // Hide employee filter
                    $('#second_candidate_ids_container').show(); // Show second candidate filter
                    employeeFilter.prop('required', false); // Make employee filter not required
                    applicationStatus.prop('required', true); // Ensure application status is required
                    loadCandidates(selectedCandidates); // Load only candidates for this pool type
                    loadSecondCandidates(); // Load second candidate dropdown
                } else {
                    $('#application_status_container').hide(); // Hide application status
                    $('#employee_ids_container').show(); // Show employee filter
                    $('#second_candidate_ids_container').hide(); // Hide second candidate filter
                    employeeFilter.prop('required', true); // Ensure employee filter is required
                    applicationStatus.prop('required', false); // Make application status not required
                    loadCandidates(selectedCandidates); // Load both candidates and employees
                    loadEmployees(selectedEmployees);
                }
            }

            // When the department is changed, load new job advertisements
            departmentFilter.on('change.select2', function() {
                loadJobAdvertisements();
            });

            // When the job opening is changed, load the relevant candidates and employees
            jobOpeningFilter.on('change.select2', function() {
                loadCandidates(selectedCandidates);
                if (poolType.val() === 'candidate_vs_employee') {
                    loadEmployees(selectedEmployees);
                } else {
                    loadSecondCandidates();
                }
            });

            // When the application status is changed, reload the candidates list
            applicationStatus.on('change.select2', function() {
                loadCandidates(selectedCandidates); // Reload candidates based on the new application status
                loadSecondCandidates();
            });

            // When the pool type is changed, show/hide filters and load candidates/employees accordingly
            poolType.on('change.select2', function() {
                updateFormBasedOnPoolType();
            });

            // Load job advertisements based on selected department
            function loadJobAdvertisements() {
                const departmentId = departmentFilter.val();
                if (departmentId) {
                    fetch(`/admin/job-opening/compare/get-job-openings?department_id=${departmentId}`)
                        .then(response => response.json())
                        .then(data => {
                            jobOpeningFilter.empty(); // Clear the current job options
                            data.jobs.forEach(job => {
                                const option = new Option(job.job_title, job.id);
                                jobOpeningFilter.append(option);
                            });
                            jobOpeningFilter.trigger('change.select2'); // Trigger change to load candidates
                        })
                        .catch(error => console.error('Error fetching job advertisements:', error));
                }
            }

            // Load candidates based on selected department, job opening, and application status
            function loadCandidates(selectedCandidates) {
                const departmentId = departmentFilter.val();
                const jobOpeningId = jobOpeningFilter.val();
                const status = applicationStatus.val();

                if (departmentId && jobOpeningId) {
                    fetch(
                            `/admin/job-opening/compare/get-candidates?department_id=${departmentId}&job_opening_id=${jobOpeningId}&status=${status}`)
                        .then(response => response.json())
                        .then(data => {
                            candidateFilter.empty(); // Clear previous candidates
                            data.candidates.forEach(candidate => {
                                const option = new Option(candidate.name, candidate.id);
                                candidateFilter.append(option);
                            });
                            reinitializeSelect2(candidateFilter,
                            selectedCandidates); // Reinitialize Select2 for candidates with selected values
                        })
                        .catch(error => console.error('Error fetching candidates:', error));
                }
            }

            // Load second candidates (for second dropdown in Candidate vs Candidate pool type)
            function loadSecondCandidates() {
                const departmentId = departmentFilter.val();
                const jobOpeningId = jobOpeningFilter.val();
                const status = applicationStatus.val();

                if (departmentId && jobOpeningId) {
                    fetch(
                            `/admin/job-opening/compare/get-candidates?department_id=${departmentId}&job_opening_id=${jobOpeningId}&status=${status}`)
                        .then(response => response.json())
                        .then(data => {
                            secondCandidateFilter.empty(); // Clear previous second candidates
                            data.candidates.forEach(candidate => {
                                const option = new Option(candidate.name, candidate.id);
                                secondCandidateFilter.append(option);
                            });
                            reinitializeSelect2(secondCandidateFilter,
                        []); // Reinitialize Select2 for second candidates without pre-selected values
                        })
                        .catch(error => console.error('Error fetching second candidates:', error));
                }
            }

            // Load employees (for Candidate vs Employee pool type)
            function loadEmployees(selectedEmployees) {
                const departmentId = departmentFilter.val();
                const jobOpeningId = jobOpeningFilter.val();

                if (departmentId && jobOpeningId) {
                    fetch(
                            `/admin/job-opening/compare/get-employees?department_id=${departmentId}&job_opening_id=${jobOpeningId}&status=${status}`)
                        .then(response => response.json())
                        .then(data => {
                            employeeFilter.empty(); // Clear previous employees
                            data.employees.forEach(employee => {
                                const option = new Option(employee.name, employee.id);
                                employeeFilter.append(option);
                            });
                            reinitializeSelect2(employeeFilter,
                            selectedEmployees); // Reinitialize Select2 for employees with selected values
                        })
                        .catch(error => console.error('Error fetching employees:', error));
                }
            }

            // Reinitialize Select2 for a specific dropdown and set selected values
            function reinitializeSelect2(selector, selectedValues) {
                selector.select2('destroy'); // Destroy previous Select2 instance
                selector.select2({
                    placeholder: selector === candidateFilter ? "Select Candidates" : "Select Employees",
                    allowClear: true,
                    minimumResultsForSearch: 0,
                    dropdownCssClass: 'select2-dropdown-multi',
                    width: '100%'
                });

                // Set the selected values dynamically
                selectedValues.forEach(function(value) {
                    selector.find('option[value="' + value + '"]').attr('selected', 'selected');
                });

                // Re-trigger Select2 to apply the selected values
                selector.trigger('change.select2');
            }

            // On page load, ensure the employee dropdown is hidden if "Candidate vs Candidate" is selected by default
            updateFormBasedOnPoolType();

            // Trigger department change on page load
            departmentFilter.trigger('change.select2');
        });
    </script>

@endsection
