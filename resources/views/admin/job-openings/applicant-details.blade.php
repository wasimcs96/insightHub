@extends('admin.layout.app')

@section('title', 'Setting - Job Create')
@section('styles')
    <style>
        .slider-container {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 10px;
            /* margin: 17px 0px; */
        }

        .slider-label {
            width: 20%;
            /* text-align: center; */
            font-size: 12px;
        }

        .slider-legend, .slider-legend_cognitive {
            width: 11%;
            display: flex;
    align-items: center;
    justify-content: center;
            font-size: 11px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 8.6px;
            text-transform: uppercase;
        }

        .slider-track {
            width: 80%;
            position: relative;
            height: 20px;
            background: #f1f1f1;
            border-radius: 12px;
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
        .emp_b {
            position: absolute;
            top: -4px;
            width: auto;
            height: auto;
            background-color: #005daf;
            border-radius: 50%;
            font-size: smaller;
            color: white;
            padding: 5px 11px;
            /* border-left: 10px solid transparent;
                                                                                                        border-right: 10px solid transparent;
                                                                                                        border-top: 10px solid #00f; */
        }

        .emp_a {
            padding: 13px;
            background-color: #f7941d;
            padding: 10px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            border: 4px solid #fff;
        }

        .emp_b {
            background-color: #1f5476;

        }

        .line {
            border-radius: 7.14px;
        }

        .dark-orange {
            background: #F7941C;
        }

        .line-orange {
            height: 20px;
        }



        @media (max-width: 768px) {
            .slider-label {
                font-size: 12px;
            }

            .slider-indicator {
                font-size: 10px;
            }

            .emp_a,
            .emp_b {
                position: absolute;
                top: 1px;
                width: auto;
                height: auto;
                background-color: #005daf;
                border-radius: 50%;
                font-size: smaller;
                color: white;
                padding: 14px 14px;
            }

            .emp_a {
                background-color: #0245A3;

            }

            .emp_b {
                background-color: #1f5476;

            }

        }

        @media (min-width: 1024px) {
            .lg\:col-span-6 {
                grid-column: span 6 / span 6;
            }

            .lg\:.col-span-3 {
                grid-column: span 3 / span 3;
            }

            .lg\:.col-span-9 {
                grid-column: span 9 / span 9;
            }
        }

        .col-span-3 {
            grid-column: span 3 / span 3;
        }

        .col-span-9 {
            grid-column: span 9 / span 9;
        }

        .d-flex {
            display: flex;
        }

        .custom_legends {
            padding: 6px 8px;
            border-radius: 50%;
            color: white;
        }

        .hidden_population {
            display: none;
        }

        .modal-backdrop {
            display: none;
        }

        .top_riasec {
            background: #1f5476;
            color: white;
            border-radius: 29px;
        }
    </style>
@endsection
@section('content')
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-xxl container-fluid d-flex flex-stack ">


            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
                class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1
                    class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Applicant Details
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
                    <li class="breadcrumb-item capitalize text-muted">
                        Job Advertisement Dashboard </li>
                    <!--end::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item capitalize text-muted">
                        Job Advertisement Listing </li>

                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item capitalize text-muted">
                        Job Advertisement View </li>

                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item capitalize text-muted">
                        Job Advertisement Applicant Detail </li>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Action group-->
            <!--begin::Toolbar end-->



            <!--end::Toolbar end-->
            <!--end::Action group-->
        </div>
        <!--end::Toolbar end-->
        <!--end::Action group-->
    </div>
    <!--end::Toolbar container-->

    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <div class="card mb-7">
                <div class="card-body profile-card pb-0">
                    <div class="d-flex flex-wrap gap-7 flex-sm-nowrap mb-11">
                        <div>
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img src="{{ asset($employee->profile_picture ?? '') }}"
                                    onerror="this.src='{{ asset('images/default-user.svg') }}'"
                                    alt="image" />
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column gap-4">
                                    <div class="">
                                        <a href="#"
                                            class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1 lh-base">{{ $user['full_name'] ?? $user['first_name'] }}
                                        </a>
                                        <p class="text-muted mt-1 fw-semibold fs-7 mb-0">
                                            {{ $jobOpeningApplication->jobOpening->job_title ?? '' }}</p>
                                    </div>
                                    <div class="d-flex flex-wrap fw-semibold fs-6 pe-2">
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                            Email:
                                            {{ $user['email'] ?? '' }}
                                        </a>
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                            |
                                        </a>
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                            Mobile:
                                            {{ $user->country_code ?? '' }} {{ $user->mobile_number ?? '' }}
                                        </a>
                                    </div>
                                    <div class="d-flex flex-wrap fw-semibold fs-6 pe-2">
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                            Technical Skill Score:
                                            {{ $jobOpeningApplication->tech_skill_score ?? '0' }}
                                        </a>
                                        @if ($jobOpeningApplication->status > 5)
                                            <a href="#"
                                                class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                                |
                                            </a>
                                            <a href="#"
                                                class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                                Interview Score:
                                                {{ $jobOpeningApplication->interview_score ?? '0' }}
                                            </a>
                                        @endif
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                            |
                                        </a>
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-500 text-hover-primary me-2 fw-normal">
                                            Application Status:
                                            {{ config('helpers.application_status')[$jobOpeningApplication->status] }}
                                        </a>
                                    </div>
                                    <div class="d-flex flex-wrap fw-semibold fs-6 pe-2 mt-3">
                                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary"
                                            style="margin-right: 4px;">
                                            Back
                                        </a>
                                        {{-- @if (auth()->user()->hasAnyPermission(['Manage Job Advertisement'])) --}}

                                        @if ($jobOpeningApplication->status < 5)
                                            <a data-bs-toggle="modal" data-bs-target="#kt_modal_1"
                                                class="btn btn-sm btn-primary" style="margin-right: 4px;">
                                                Schedule Interview
                                            </a>
                                        @endif

                                        @if ($jobOpeningApplication->status == 5)
                                            <a data-bs-toggle="modal" data-bs-target="#kt_modal_1"
                                                class="btn btn-sm btn-primary" style="margin-right: 4px;">
                                                Edit Interview
                                            </a>
                                        @endif


                                        @if ($jobOpeningApplication->status <= 5)
                                            <a href="{{ route('admin.job-openings.take-interview', $jobOpeningApplication->id) }}"
                                                class="btn btn-sm btn-primary" style="margin-right: 4px;">
                                                Conduct Interview
                                            </a>
                                        @endif


                                        @if ($jobOpeningApplication->status < 8)
                                            @if ($jobOpeningApplication->status == 7)
                                                <a href="{{ $jobOpeningApplication->contract->contract_pdf }}"
                                                    target="_blank" class="btn btn-sm btn-primary"
                                                    style="margin-right: 4px;">
                                                    View Offer letter
                                                </a>
                                                <a data-bs-toggle="modal" data-bs-target="#kt_modal_2"
                                                    class="btn btn-sm btn-primary" style="margin-right: 4px;">
                                                    Re Offer
                                                </a>
                                            @else
                                                <a data-bs-toggle="modal" data-bs-target="#kt_modal_2"
                                                    class="btn btn-sm btn-primary" style="margin-right: 4px;">
                                                    Offer
                                                </a>
                                                {{-- <a data-bs-toggle="modal" data-bs-target="#kt_modal_2" class="btn btn-sm btn-primary" style="margin-right: 4px;">
                                            Offer
                                        </a> --}}
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 mb-5 mb-xl-7">
                    <div class="card h-md-100" dir="ltr">
                        <div class="card-header flex-nowrap pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Basic Personal Information​​</span>
                            </h3>
                        </div>
                        <div class="card-body p-9 pb-0">
                            <div class="row mb-7">
                                <label class="col-lg-3 fw-bold fs-6 text-gray-800">Full Name </label>
                                <div class="col-lg-6">
                                    <span class="fw-semibold text-muted fs-6">
                                        {{ $user['full_name'] ?? $user['first_name'] }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-3 fw-bold fs-6 text-gray-800">Email </label>
                                <div class="col-lg-6">
                                    <span class="fw-semibold text-muted fs-6">
                                        {{ $user['email'] ?? '' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-3 fw-bold fs-6 text-gray-800">Mobile </label>
                                <div class="col-lg-6">
                                    <span class="fw-semibold text-muted fs-6">
                                        {{ $user['email'] ?? '' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-3 fw-bold fs-6 text-gray-800">Address </label>
                                <div class="col-lg-6">
                                    <span class="fw-semibold text-muted fs-6">
                                        {{ $user['address'] ?? '' }}, {{ $user->cityName->name ?? '' }},
                                        {{ $user->state->name ?? '' }}, {{ $user->country->name ?? '' }},
                                        {{ $user->postal_code ?? '' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-3 fw-bold fs-6 text-gray-800">ID Card URL </label>
                                <div class="col-lg-6">
                                    <span class="fw-semibold text-muted fs-6">
                                        @if ($user['id_card'] && file_exists(public_path($user['id_card'])))
                                            <a href="{{ asset($user['id_card']) }}" target="_blank">ID Card URL</a>
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-3 fw-bold fs-6 text-gray-800">Passport URL </label>
                                <div class="col-lg-6">
                                    <span class="fw-semibold text-muted fs-6">
                                        @if ($user['passport'] && file_exists(public_path($user['passport'])))
                                            <a href="{{ asset($user['passport']) }}" target="_blank">Passport URL</a>
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-6 mb-5 mb-xl-7">
                    <div class="card h-md-100" dir="ltr">
                        <div class="card-header flex-nowrap pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Educational Background​​</span>
                            </h3>
                        </div>
                        <div class="card-body p-9 pb-0">
                            <div class="row mb-7">
                                <label class="col-lg-5 fw-bold fs-6 text-gray-800">Education Level </label>
                                <div class="col-lg-6">
                                    <span class="fw-semibold text-muted fs-6">
                                        {{ $user->education_level_check->name ?? '' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-5 fw-bold fs-6 text-gray-800">Education Institution </label>
                                <div class="col-lg-6">
                                    <span class="fw-semibold text-muted fs-6">
                                        {{ $user->higher_learning->name ?? '' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-5 fw-bold fs-6 text-gray-800">Education Program </label>
                                <div class="col-lg-6">
                                    <span class="fw-semibold text-muted fs-6">
                                        {{ $user->program->name ?? '' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-5 fw-bold fs-6 text-gray-800">Education Transcript URL </label>
                                <div class="col-lg-6">
                                    <span class="fw-semibold text-muted fs-6">
                                        @if ($user['education_transcript'] && file_exists(public_path($user['education_transcript'])))
                                            <a href="{{ asset($user['education_transcript']) }}"
                                                target="_blank">Education Transcript
                                                URL</a>
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-5 fw-bold fs-6 text-gray-800">Education Certificate URL </label>
                                <div class="col-lg-6">
                                    <span class="fw-semibold text-muted fs-6">
                                        @if ($user['education_certificate'] && file_exists(public_path($user['education_certificate'])))
                                            <a href="{{ asset($user['education_certificate']) }}"
                                                target="_blank">Education
                                                Certificate URL</a>
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex card flex-row mb-5 mb-xl-7">
                <div class="col-xl-6 mb-5 mb-xl-7 pr-0">
                    <div class="h-md-100" dir="ltr">
                        <div class="card-header flex-nowrap pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Employment History & Expectation​​</span>
                            </h3>
                        </div>
                        <div class="card-body p-9 pb-0">
                            <div class="row mb-7">
                                <label class="col-lg-5 fw-bold fs-6 text-gray-800">CV / Resume URL </label>
                                <div class="col-lg-6">
                                    <span class="fw-semibold text-muted fs-6">
                                        @if ($user['cv_resume'] && file_exists(public_path($user['cv_resume'])))
                                            <a href="{{ asset($user['cv_resume']) }}" target="_blank">CV / Resume URL</a>
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-5 fw-bold fs-6 text-gray-800">Cover letter </label>
                                <div class="col-lg-6">
                                    <span class="fw-semibold text-muted fs-6">
                                        @if ($jobOpeningApplication->cover_letter && file_exists(public_path($jobOpeningApplication->cover_letter)))
                                            <a href="{{ asset($jobOpeningApplication->cover_letter) }}"
                                                target="_blank">Cover Letter
                                                URL</a>
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-5 fw-bold fs-6 text-gray-800">Expected Salary </label>
                                <div class="col-lg-6">
                                    <span class="fw-semibold text-muted fs-6">
                                        @if ($user['job_expected_salary'])
                                            ₱ {{ $user['job_expected_salary'] ?? '' }}
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-5 fw-bold fs-6 text-gray-800">Work Experience </label>
                                <div class="col-lg-6">
                                    <span class="fw-semibold text-muted fs-6">
                                        {{ $user['job_work_experience'] ? $user['job_work_experience'] . ' ' . 'Years' : 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-5 fw-bold fs-6 text-gray-800">Preferred Locations </label>
                                <div class="col-lg-6">
                                    <span class="fw-semibold text-muted fs-6">
                                        @foreach ($user->preferredLocation as $key => $value)
                                            <span type="button"
                                                class=" badge-success badge mt-1">{{ $value->masterCity->name ?? '' }}</span>
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 mb-5 mb-xl-7 pl-0">
                    <div class="h-md-100" dir="ltr">
                        <div class="card-header flex-nowrap pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-white">Educational Background​​</span>
                            </h3>
                        </div>
                        @foreach ($user['employments'] as $employment)
                            <div class="card-body p-9 pb-0">
                                <div class="row mb-7">
                                    <label class="col-lg-5 fw-bold fs-6 text-gray-800">Job Title </label>
                                    <div class="col-lg-6">
                                        <span class="fw-semibold text-muted fs-6">
                                            {{ $employment['job_title'] ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-5 fw-bold fs-6 text-gray-800">Company Name </label>
                                    <div class="col-lg-6">
                                        <span class="fw-semibold text-muted fs-6">
                                            {{ $employment['company_name'] ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-5 fw-bold fs-6 text-gray-800">Year Of Work </label>
                                    <div class="col-lg-6">
                                        <span class="fw-semibold text-muted fs-6">
                                            {{ $employment['year_of_work'] ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-5 fw-bold fs-6 text-gray-800">Start Date </label>
                                    <div class="col-lg-6">
                                        <span class="fw-semibold text-muted fs-6">
                                            {{ $employment['start_date'] ?? 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-7">
                                    <label class="col-lg-5 fw-bold fs-6 text-gray-800">End Date </label>
                                    <div class="col-lg-6">
                                        <span class="fw-semibold text-muted fs-6">
                                            @if ($employment['end_date'] == '1970-01-01' || $employment['end_date'] == '0000-00-00')
                                                Currently working here
                                            @else
                                                @if (isset($employment['start_date']))
                                                    {{ $employment['end_date'] ?? 'N/A' }}
                                                @endif
                                            @endif
                                        </span>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @if ($isResultAvailable)
            <div class="card mb-7">
                <div class="card-body profile-card p-0 pb-6">
                    <div class="card-header flex-nowrap pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-900">Results​​</span>
                        </h3>
                        <div class="card-toolbar">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary" style="margin-right: 4px;">
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="row px-6 mt-5">
                        <div class="col-lg-6">
                            <div class="card h-full shadow-base2">
                                <header class="card-header">
                                    <h4 class="card-title">Critical Core Skills</h4>

                                </header>
                                <div class="card-body p-6 pb-0">
                                    {{-- {{ dd($workCompetencyResult) }} --}}
                                    @if ($user->is_personality_motivation_completed == 1)
                                        <div class="">
                                            <div class="row" style="justify-content: end;">
                                                <div class="col-lg-12 mb-8">
                                                    <button class="btn btn-primary p-3 py-2"
                                                        style="float: right;">Percentile
                                                        (th)</button>
                                                </div>
                                            </div>
                                            @foreach ($ccsResult as $ccs => $result)
                                                <div class="slider-container">
                                                    <div class="slider-label cursor-pointer" data-bs-toggle="collapse"
                                                        data-bs-target="#{{ $result['slug'] }}Accordion">
                                                        {{ $result['name'] ?? '' }} <span><iconify-icon
                                                                icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                    </div>
                                                    <div class="slider-track">
                                                        {{-- <div style="width: 90%;" class="line line-orange dark-orange">
                                                        </div> --}}
                                                        <div class="emp_a" data-bs-toggle="collapse"
                                                            data-bs-target="#{{ $result['slug'] }}UserAccordion"
                                                            @if (isset($result) && $result['score'] == 100) style="left: 93%;" @else style="left: {{ $result['score'] ?? 0 }}%;" @endif>
                                                        </div>
                                                        {{-- <div class="emp_b population_hide hidden_population"
                                                            style="left: {{ $workCompetencyOverallResult['Critical Thinking'] ?? 0 }}%;">
                                                            P</div> --}}

                                                    </div>
                                                    <div class="btn btn-primary p-3 py-2" style="width: 7%;">
                                                        {{ (int) $result['percentage'] ?? 0 }}</div>
                                                    {{-- <div class="slider-label">Openness</div> --}}
                                                </div>
                                                <div class="accordion-item pl-8 mb-8">
                                                    <div id="{{ $result['slug'] }}Accordion"
                                                        class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2"
                                                        aria-labelledby="panelsStayOpen-headingOne">
                                                        <div class="accordion-body font13 description_accordian">
                                                            {{ $ccsDomainDescriptors->where('slug', $result['slug'])->first()->analysis ?? ' ' }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item pl-8 mb-8">
                                                    <div id="{{ $result['slug'] }}UserAccordion"
                                                        class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2"
                                                        aria-labelledby="panelsStayOpen-headingOne">
                                                        <div class="accordion-body font13 description_accordian">
                                                            {{ $result['description'] ?? ' ' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="container text-center bg_secondary_green p-5"
                                            style="
                                                        border-radius: 16px;">
                                            <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                            </iconify-icon>
                                            <h4>Data Not Available </h4>
                                        </div>
                                    @endif


                                </div>
                            </div>
                            <div class="card h-full shadow-base2 mt-5">
                                @php
                                    $level_number = $cognitiveOverallResult['cognitive']['level'] ?? '1';
                                    $level = 'Level: ' . config('helpers.cognitive_ability_levels')[$level_number];
                                @endphp

                                <header class="card-header">
                                    <h4 class="card-title">Cognitive Ability</h4>
                                </header>

                                <div class="card-body p-6">
                                    @if ($user->is_cognitive_ability_completed == 1)
                                        <div id="donut" class="align-items-center d-flex justify-content-center"
                                            style="min-height: 267.3px;display: flex;align-items: center;justify-content: center;">
                                        </div>
                                        <div class="col-lg-5 mt-3"
                                            style="align-items: center;display: flex;flex-direction: column;margin: auto;">
                                            <h1 class="pricing-card-title text-3xl">
                                                {{-- {{ ($totalCorrectForCognitive / 50)*100 }}%
                                            <small class="text-body-secondary fw-light"> Correct
                                                ({{$totalCorrectForCognitive}} / 50)
                                            </small> --}}
                                                {{ $level ?? '1' }}
                                            </h1>

                                        </div>
                                        <div class="d-flex justify-content-between"
                                            style="margin-left: 128px;margin-top: 24px;">
                                            <div class="slider-legend_cognitive"
                                            style="background: #FDE2C1; color: #F7941C !important;">
                                                L0</div>
                                            <div class="slider-legend_cognitive"
                                                style="
                                                        background: rgb(255, 220, 146) !important; color: #5e5656 !important;

                                                    ">
                                                L1</div>
                                            <div class="slider-legend_cognitive"
                                            style="background: #B2ECEC; color: #108585 !important;">
                                                L2</div>
                                            <div class="slider-legend_cognitive"
                                            style="background: #E1D8FB; color: #7F66CA !important;">
                                                L3</div>
                                        </div>
                                        <div class="mt-5">
                                            <div class="slider-container mb-4">
                                                <div class="slider-label">Quantitative Knowledge</div>
                                                <div class="slider-track">
                                                    {{-- <div style="width: 90%;" class="line line-orange dark-orange"></div> --}}
                                                    <div class="emp_a"
                                                        @if (isset($cognitiveDomainResult) &&
                                                                isset($cognitiveDomainResult['quantitative-knowledge']) &&
                                                                isset($cognitiveDomainResult['quantitative-knowledge']['level']) &&
                                                                $cognitiveDomainResult['quantitative-knowledge']['level'] / 3 == 1) style="left: 93%;" 
                                                    @else 
                                                        style="left: {{ isset($cognitiveDomainResult['quantitative-knowledge']['level']) ? ($cognitiveDomainResult['quantitative-knowledge']['level'] / 3) * 100 : 0 }}%;" @endif>
                                                    </div>


                                                </div>
                                                {{-- <div class="slider-label">Openness</div> --}}
                                            </div>
                                            <div class="slider-container mb-7">
                                                <div class="slider-label">Comprehensive Knowledge</div>
                                                <div class="slider-track">
                                                    {{-- <div style="width: 90%;" class="line line-orange dark-orange"></div> --}}
                                                    <div class="d-flex justify-content-between"
                                                        style="top: -28px; position: relative;">
                                                    </div>
                                                    <div class="emp_a"
                                                        @if (isset($cognitiveDomainResult) &&
                                                                isset($cognitiveDomainResult['comprehension-knowledge']) &&
                                                                isset($cognitiveDomainResult['comprehension-knowledge']['level']) &&
                                                                $cognitiveDomainResult['comprehension-knowledge']['level'] / 3 == 1) style="left: 93%;" 
                                                        @else 
                                                            style="left: {{ isset($cognitiveDomainResult['comprehension-knowledge']['level']) ? ($cognitiveDomainResult['comprehension-knowledge']['level'] / 3) * 100 : 0 }}%;" @endif>
                                                    </div>
                                                </div>
                                                {{-- <div class="slider-label">Openness</div> --}}
                                            </div>
                                            <div class="slider-container mb-9">
                                                <div class="slider-label">Visual Reasoning</div>
                                                <div class="slider-track">
                                                    {{-- <div style="width: 90%;" class="line line-orange dark-orange"></div> --}}
                                                    <div class="d-flex justify-content-between"
                                                        style="top: -28px; position: relative;">
                                                    </div>
                                                    <div class="emp_a"
                                                        @if (isset($cognitiveDomainResult) &&
                                                                isset($cognitiveDomainResult['visual-reasoning']) &&
                                                                isset($cognitiveDomainResult['visual-reasoning']['level']) &&
                                                                $cognitiveDomainResult['visual-reasoning']['level'] / 3 == 1) style="left: 93%;" 
                                                        @else 
                                                            style="left: {{ isset($cognitiveDomainResult['visual-reasoning']['level']) ? ($cognitiveDomainResult['visual-reasoning']['level'] / 3) * 100 : 0 }}%;" @endif>
                                                    </div>
                                                </div>
                                                {{-- <div class="slider-label">Openness</div> --}}
                                            </div>
                                            <div class="slider-container mb-6">
                                                <div class="slider-label">Fluid Reasoning</div>
                                                <div class="slider-track">
                                                    {{-- <div style="width: 90%;" class="line line-orange dark-orange"></div> --}}
                                                    <div class="d-flex justify-content-between"
                                                        style="top: -28px; position: relative;">
                                                    </div>
                                                    <div class="emp_a"
                                                        @if (isset($cognitiveDomainResult) &&
                                                                isset($cognitiveDomainResult['fluid-reasoning']) &&
                                                                isset($cognitiveDomainResult['fluid-reasoning']['level']) &&
                                                                $cognitiveDomainResult['fluid-reasoning']['level'] / 3 == 1) style="left: 93%;" 
                                                        @else 
                                                            style="left: {{ isset($cognitiveDomainResult['fluid-reasoning']['level']) ? ($cognitiveDomainResult['fluid-reasoning']['level'] / 3) * 100 : 0 }}%;" @endif>
                                                    </div>
                                                </div>
                                                {{-- <div class="slider-label">Openness</div> --}}
                                            </div>
                                        </div>
                                    @else
                                        <div class="container text-center bg_secondary_green p-5"
                                            style="
                                                        border-radius: 16px;">
                                            <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                            </iconify-icon>
                                            <h4>Data Not Available </h4>
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <div class="card h-full shadow-base2 mt-5">
                                <div class="card-header border-0 pt-0 pl-0">
                                    <h3 class="card-title align-items-start flex-column" style="
                                    padding: 0 2.25rem;
                                ">Activity Log</span>
                                    </h3>

                                </div>
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle gs-0 gy-4 mb-0">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fw-bold text-muted bg-light">
                                                <th class="min-w-125px text-center">Date</th>

                                                <th class="min-w-125px text-center">Description</th>

                                            </tr>
                                        </thead>
                                        <!--end::Table head-->

                                        <!--begin::Table body-->

                                        <tbody>
                                            @foreach ($activitylogs as $activity)
                                                <tr>

                                                    <td>
                                                        <span
                                                            class="text-gray-900 text-center text-hover-primary d-block mb-1 fs-6">{{ \Carbon\Carbon::parse($activity->created_at)->format('m/d/Y h:i A') }}
                                                        </span>

                                                    </td>

                                                    <td>
                                                        <span
                                                            class="text-gray-900 text-center text-hover-primary d-block mb-1 fs-6">{{ $activity->action ?? '' }}</span>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->

                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6">
                            <div class="card h-full shadow-base2">
                                <header class="card-header">
                                    <h4 class="card-title">Work Interest</h4>
                                </header>
                                <div class="card-body p-6">
                                    @if ($user->is_work_interest_completed == 1)
                                        {{-- <div id="riasec" class="align-items-center col-lg-3 d-flex justify-content-center">
                                    </div> --}}
                                        @foreach ($riasecDomainResult as $riasec => $result)
                                            @if ($result['code'] == 'R')
                                                <div class="d-flex justify-content-between"
                                                    style="top: 0px; position: relative; margin-left: 128px; margin-bottom: 22px;">
                                                    <div class="slider-legend"
                                                    style="background: #FDE2C1; color: #F7941C !important;">
                                                        Low
                                                    </div>
                                                    <div class="slider-legend"
                                                        
                                                        style="background: #E1D8FB; color: #7F66CA !important;">
                                                        High
                                                    </div>
                                                </div>
                                            @endif
                                            <div
                                                class="slider-container @if (in_array($result['code'], $riasecTop3Result['array'])) raisec_container @endif">
                                                <div class="slider-label cursor-pointer" data-bs-toggle="collapse"
                                                    data-bs-target="#{{ $result['slug'] }}Accordion">
                                                    {{ $result['name'] ?? '' }} <span><iconify-icon
                                                            icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="slider-track">
                                                    {{-- <div style="width: 90%;" class="line line-orange dark-orange"></div> --}}
                                                    <div class="emp_a" data-bs-toggle="collapse"
                                                        data-bs-target="#{{ $result['slug'] }}UserAccordion"
                                                        @if (isset($result['percentage']) && $result['percentage'] == 100) style="left: 93%;" @else style="left: {{ $result['percentage'] ?? 0 }}%;" @endif>
                                                    </div>
                                                    {{-- <div class="emp_b population_hide hidden_population"
                                                                    style="left: {{ $workInterestOverallResult['Investigative'] ?? 0 }}%;">
                                                                P
                                                            </div> --}}

                                                </div>
                                                {{-- <div class="slider-label">Openness</div> --}}
                                            </div>
                                            <div class="accordion-item pl-8 mb-8">
                                                <div id="{{ $result['slug'] }}Accordion"
                                                    class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2"
                                                    aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $riasecDomainDescriptors->where('slug', $result['slug'])->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item pl-8 mb-8">
                                                <div id="{{ $result['slug'] }}UserAccordion"
                                                    class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2"
                                                    aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $result['description'] ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="accordion" id="accordionPanelsStayOpenExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                                    <button
                                                        class="accordion-button nav-link block font-medium font-Inter text-sm leading-tight capitalize rounded-md  py-3 focus:outline-none focus:ring-0 color-black active"
                                                        type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                                        aria-controls="panelsStayOpen-collapseOne">
                                                        Top 3 RIASEC -
                                                        {{ $riasecTop3Result['string'] ?? '' }}
                                                    </button>
                                                </h2>
                                                <div id="panelsStayOpen-collapseOne"
                                                    class="accordion-collapse collapse show color-black"
                                                    aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body">
                                                        {{ $riasecTop3Result['description'] ?? '' }}
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    @else
                                        <div class="container text-center bg_secondary_green p-5"
                                            style="
                                                                border-radius: 16px;">
                                            <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                            </iconify-icon>
                                            <h4>Data Not Available </h4>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card h-full shadow-base2 mt-5">
                                <header class="card-header"
                                    style="display: flex; justify-content: space-between; align-items: center;">
                                    <h4 class="card-title">Personality & Motivation</h4>
                                    <span style="float: right;">
                                        {{-- Response Consistency Index: {{ $rciResult['rci']['level_description'] ?? 'Consistent' }} --}}
                                        Response Consistency Index:
                                        @if ($user->is_personality_motivation_completed == 1 && $isUserResultExists)
                                            {{ config('helpers.rci_levels')[$rciResult['rci']['level'] ?? 0] ?? '' }}
                                        @else
                                            Data Not Available
                                        @endif
                                    </span>
                                </header>

                                <div class="card-body p-6">
                                    @if ($user->is_personality_motivation_completed == 1)
                                        @php
                                            $allFacetsDescriptionsFromDB = \App\Models\OceanAllFacetsCombination::all();

                                            $allFacetsDescriptions = [];
                                            foreach ($allFacetsDescriptionsFromDB as $allFacet) {
                                                $allFacetsDescriptions[$allFacet->facet][$allFacet->ea][$allFacet->eb] =
                                                    $allFacet->description;
                                            }

                                            function convertScoreToLevel($score)
                                            {
                                                $level = 'Moderate';
                                                if ($score > 3.75) {
                                                    $level = 'High';
                                                } elseif ($score <= 1.25) {
                                                    $level = 'Low';
                                                } else {
                                                    $level = 'Moderate';
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
                                                $oceanAllFacetsSingleResult,
                                                $oceanAllFacetsOverallResult,
                                                $allHighFacets,
                                                $allLowFacets,
                                                $allFacetsDescriptions,
                                                $oceanAllFacetsResult,
                                                $slug,
                                            ) {
                                                // Extracting the property values from objects
                                                $facet_value_a = isset(
                                                    $oceanAllFacetsSingleResult[$facet_field_name]['score'],
                                                )
                                                    ? $oceanAllFacetsSingleResult[$facet_field_name]['score']
                                                    : 0;
                                                $facet_value_b = isset(
                                                    $oceanAllFacetsEmployeeBResult[$facet_field_name],
                                                )
                                                    ? $oceanAllFacetsEmployeeBResult[$facet_field_name]
                                                    : 0;
                                                $facet_value_o = isset($oceanAllFacetsOverallResult[$facet_field_name])
                                                    ? $oceanAllFacetsOverallResult[$facet_field_name]
                                                    : 0;
                                                $analyzedDescription =
                                                    $allFacetsDescriptions[$facet][convertScoreToLevel($facet_value_a)][
                                                        convertScoreToLevel($facet_value_b)
                                                    ] ?? '';
                                                $percentage = isset(
                                                    $oceanAllFacetsSingleResult[$facet_field_name]['percentage'],
                                                )
                                                    ? (int) $oceanAllFacetsSingleResult[$facet_field_name]['percentage']
                                                    : 0;

                                                // Use direct PHP concatenation for dynamic content
                                                $facetLowId = lowerAndReplaceSpace($facet_low);
                                                $facetId = lowerAndReplaceSpace($facet);

                                                // Calculate left position for emp_a
                                                $leftPositionA = $facet_value_a / 0.05;
                                                $styleA =
                                                    $leftPositionA == 100
                                                        ? 'style="left: 93%;"'
                                                        : 'style="left: ' . $leftPositionA . '%;"';

                                                // Calculate left position for emp_b
                                                $leftPositionB = $facet_value_b / 0.05;
                                                $styleB =
                                                    $leftPositionB == 100
                                                        ? 'style="left: 93%;"'
                                                        : 'style="left: ' . $leftPositionB . '%;"';
                                                $description = $oceanAllFacetsResult[$slug]['description'] ?? '';
                                                // $description = '';
                                                $html =
                                                    '<div class="slider-container">' .
                                                    '<div class="slider-label cursor-pointer mt-5" data-bs-toggle="collapse" data-bs-target="#' .
                                                    $facetLowId .
                                                    '">' .
                                                    htmlspecialchars($facet_low) .
                                                    '<span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span></div>' .
                                                    '<div class="slider-track mb-0" style="margin-bottom: 0px;">' .
                                                    '<div class="emp_a" ' .
                                                    $styleA .
                                                    ' data-bs-toggle="collapse" data-bs-target="#' .
                                                    $slug .
                                                    'Description"></div>' .
                                                    '<div class="emp_b population_hide hidden_population" style="left: ' .
                                                    ($facet_value_o / 5) * 100 .
                                                    '%;">P</div>' .
                                                    '</div>' .
                                                    '<div class="slider-label cursor-pointer mt-5" data-bs-toggle="collapse" data-bs-target="#' .
                                                    $facetId .
                                                    '">' .
                                                    htmlspecialchars($facet) .
                                                    '<span><iconify-icon icon="iconamoon:arrow-down-2-light"></iconify-icon></span></div> ' .
                                                    '<div class="btn btn-primary p-3 py-2" style="width: 7%;">' .
                                                    $percentage .
                                                    '</div></div>' .
                                                    '<div class="accordion-item pl-8 mb-8">' .
                                                    '<div id="' .
                                                    $facetLowId .
                                                    '" class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9 mt-2" aria-labelledby="panelsStayOpen-headingOne">' .
                                                    '<div class="accordion-body font13 description_accordian_left">' .
                                                    htmlspecialchars($allLowFacets[$facet_low]) .
                                                    '</div>' .
                                                    '</div>' .
                                                    '</div>' .
                                                    '<div class="accordion-item pl-8 mb-8" >' .
                                                    '<div id="' .
                                                    $facetId .
                                                    '"  class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9 mt-2"  aria-labelledby="panelsStayOpen-headingOne">' .
                                                    '<div class="accordion-body font13 text-slate-600 description_accordian_right">' .
                                                    htmlspecialchars($allHighFacets[$facet]) .
                                                    '</div>' .
                                                    '</div>' .
                                                    '</div>' .
                                                    '<div class="accordion-item pl-8 mb-8" >' .
                                                    '<div id="' .
                                                    $slug .
                                                    'Description"  class="accordion-collapse collapse  color-black p-1.5 shadow-deep collapse  br-9 mt-2"  aria-labelledby="panelsStayOpen-headingOne">' .
                                                    '<div class="accordion-body font13 text-slate-600 description_accordian_right">' .
                                                    htmlspecialchars($description) .
                                                    '</div>' .
                                                    '</div>' .
                                                    '</div>';

                                                return $html;
                                            }
                                        @endphp

                                        {{-- <div id="chart"></div> --}}

                                        <div class="">
                                            <div class="row" style="justify-content: end;">
                                                <div class="col-lg-12 mb-8">
                                                    <button class="btn btn-primary p-3 py-2"
                                                        style="float: right;">Percentile
                                                        (th)</button>
                                                </div>
                                            </div>
                                            <div class="slider-container">
                                                <div class="slider-label cursor-pointer" data-bs-toggle="collapse"
                                                    data-bs-target="#pragmatismAccordion">
                                                    Pragmatism <span><iconify-icon
                                                            icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="slider-track">
                                                    {{-- <div style="width: 90%;" class="line line-orange dark-orange"></div> --}}
                                                    <div class="emp_a cursor-pointer" data-bs-toggle="modal"
                                                        data-bs-target="#openness_facets_modal"
                                                        @if (isset($oceanDomainResult['openness-to-experience']) &&
                                                                $oceanDomainResult['openness-to-experience']['score'] / 0.05 == 100) style="left: 93%;" @else style="left: {{ $oceanDomainResult['openness-to-experience']['score'] / 0.05 ?? 0 }}%;" @endif>
                                                    </div>
                                                    {{-- <div class="emp_b population_hide hidden_population"
                                                        @if (isset($oceanOverallResult['Openness to Experience']) && ($oceanOverallResult['Openness to Experience'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanOverallResult['Openness to Experience'] / 5) * 100 ?? 0 }}%;" @endif>
                                                        P
                                                    </div> --}}
                                                </div>
                                                <div class="slider-label cursor-pointer" data-bs-toggle="collapse"
                                                    data-bs-target="#opennessAccordion">
                                                    Openness <span><iconify-icon
                                                            icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="btn btn-primary p-3 py-2" style="width: 7%;">
                                                    {{ (int) $oceanDomainResult['openness-to-experience']['percentage'] ?? 0 }}
                                                </div>

                                            </div>
                                            <div class="accordion-item pl-8 mb-8">
                                                <div id="pragmatismAccordion"
                                                    class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2"
                                                    aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $oceanDomainDescriptors->where('slug', 'pragmatism')->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item pl-8 mb-8">
                                                <div id="opennessAccordion"
                                                    class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2"
                                                    aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $oceanDomainDescriptors->where('slug', 'openness-to-experience')->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="slider-container">
                                                <div class="slider-label cursor-pointer" data-bs-toggle="collapse"
                                                    data-bs-target="#lowSelfControlAccordion">Low Self Control
                                                    <span><iconify-icon
                                                            icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="slider-track">
                                                    {{-- <div style="width: 90%;" class="line line-orange dark-orange"></div> --}}
                                                    <div class="emp_a cursor-pointer" data-bs-toggle="modal"
                                                        data-bs-target="#conscientiousness_facets_modal"
                                                        @if (isset($oceanDomainResult['conscientiousness']) && $oceanDomainResult['conscientiousness']['score'] / 0.05 == 100) style="left: 93%;" @else style="left: {{ $oceanDomainResult['conscientiousness']['score'] / 0.05 ?? 0 }}%;" @endif>
                                                    </div>
                                                    {{-- <div class="emp_b population_hide hidden_population"
                                                        @if (isset($oceanOverallResult['Conscientiousness']) && ($oceanOverallResult['Conscientiousness'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanOverallResult['Conscientiousness'] / 5) * 100 ?? 0 }}%;" @endif>
                                                        P
                                                    </div> --}}
                                                </div>
                                                <div class="slider-label cursor-pointer" data-bs-toggle="collapse"
                                                    data-bs-target="#highSelfControlAccordion">
                                                    High Self Control <span><iconify-icon
                                                            icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="btn btn-primary p-3 py-2" style="width: 7%;">
                                                    {{ (int) $oceanDomainResult['conscientiousness']['percentage'] ?? 0 }}
                                                </div>
                                            </div>
                                            <div class="accordion-item pl-8 mb-8">
                                                <div id="lowSelfControlAccordion"
                                                    class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2"
                                                    aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $oceanDomainDescriptors->where('slug', 'low-self-control')->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item pl-8 mb-8">
                                                <div id="highSelfControlAccordion"
                                                    class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2"
                                                    aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $oceanDomainDescriptors->where('slug', 'high-self-control')->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="slider-container">
                                                <div class="slider-label cursor-pointer" data-bs-toggle="collapse"
                                                    data-bs-target="#introversionAccordion">Introversion
                                                    <span><iconify-icon
                                                            icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="slider-track">
                                                    {{-- <div style="width: 90%;" class="line line-orange dark-orange"></div> --}}
                                                    <div class="emp_a cursor-pointer" data-bs-toggle="modal"
                                                        data-bs-target="#extraversion_facets_modal"
                                                        @if (isset($oceanDomainResult['extraversion']) && $oceanDomainResult['extraversion']['score'] / 0.05 == 100) style="left: 93%;" @else style="left: {{ $oceanDomainResult['extraversion']['score'] / 0.05 ?? 0 }}%;" @endif>
                                                    </div>
                                                    {{-- <div class="emp_b population_hide hidden_population"
                                                        @if (isset($oceanOverallResult['Extraversion']) && ($oceanOverallResult['Extraversion'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanOverallResult['Extraversion'] / 5) * 100 ?? 0 }}%;" @endif>
                                                        P
                                                    </div> --}}
                                                </div>
                                                <div class="slider-label cursor-pointer" data-bs-toggle="collapse"
                                                    data-bs-target="#extraversionAccordion">Extraversion
                                                    <span><iconify-icon
                                                            icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="btn btn-primary p-3 py-2" style="width: 7%;">
                                                    {{ (int) $oceanDomainResult['extraversion']['percentage'] ?? 0 }}
                                                </div>
                                            </div>
                                            <div class="accordion-item pl-8 mb-8">
                                                <div id="introversionAccordion"
                                                    class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2"
                                                    aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $oceanDomainDescriptors->where('slug', 'introversion')->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item pl-8 mb-8">
                                                <div id="extraversionAccordion"
                                                    class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2"
                                                    aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $oceanDomainDescriptors->where('slug', 'extraversion')->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="slider-container">
                                                <div class="slider-label cursor-pointer" data-bs-toggle="collapse"
                                                    data-bs-target="#independenceAccordion">Independence
                                                    <span><iconify-icon
                                                            icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="slider-track">
                                                    {{-- <div style="width: 90%;" class="line line-orange dark-orange"></div> --}}
                                                    <div class="emp_a cursor-pointer" data-bs-toggle="modal"
                                                        data-bs-target="#agreeableness_facets_modal"
                                                        @if (isset($oceanDomainResult['agreeableness']) && $oceanDomainResult['agreeableness']['score'] / 0.05 == 100) style="left: 93%;" @else style="left: {{ $oceanDomainResult['agreeableness']['score'] / 0.05 ?? 0 }}%;" @endif>
                                                    </div>
                                                    {{-- <div class="emp_b population_hide hidden_population"
                                                        @if (isset($oceanOverallResult['Agreeableness']) && ($oceanOverallResult['Agreeableness'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanOverallResult['Agreeableness'] / 5) * 100 ?? 0 }}%;" @endif>
                                                        P
                                                    </div> --}}
                                                </div>
                                                <div class="slider-label cursor-pointer" data-bs-toggle="collapse"
                                                    data-bs-target="#agreeablenessAccordion">Agreeableness
                                                    <span><iconify-icon
                                                            icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="btn btn-primary p-3 py-2" style="width: 7%;">
                                                    {{ (int) $oceanDomainResult['agreeableness']['percentage'] ?? 0 }}
                                                </div>
                                            </div>
                                            <div class="accordion-item pl-8 mb-8">
                                                <div id="independenceAccordion"
                                                    class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2"
                                                    aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $oceanDomainDescriptors->where('slug', 'independence')->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item pl-8 mb-8">
                                                <div id="agreeablenessAccordion"
                                                    class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2"
                                                    aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $oceanDomainDescriptors->where('slug', 'agreeableness')->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="slider-container">
                                                <div class="slider-label cursor-pointer" data-bs-toggle="collapse"
                                                    data-bs-target="#highAnxietyAccordion">High Anxiety
                                                    <span><iconify-icon
                                                            icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="slider-track">
                                                    {{-- <div style="width: 90%;" class="line line-orange dark-orange"></div> --}}
                                                    <div class="emp_a cursor-pointer" data-bs-toggle="modal"
                                                        data-bs-target="#emotional_stability_facets_modal"
                                                        @if (isset($oceanDomainResult['emotional-stability']) &&
                                                                $oceanDomainResult['emotional-stability']['score'] / 0.05 == 100) style="left: 93%;" @else style="left: {{ $oceanDomainResult['emotional-stability']['score'] / 0.05 ?? 0 }}%;" @endif>
                                                    </div>
                                                    {{-- <div class="emp_b population_hide hidden_population"
                                                        @if (isset($oceanOverallResult['Emotional Stability']) && ($oceanOverallResult['Emotional Stability'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanOverallResult['Emotional Stability'] / 5) * 100 ?? 0 }}%;" @endif>
                                                        P
                                                    </div> --}}
                                                </div>
                                                <div class="slider-label cursor-pointer" data-bs-toggle="collapse"
                                                    data-bs-target="#lowAnxietyAccordion">Low Anxiety
                                                    <span><iconify-icon
                                                            icon="iconamoon:arrow-down-2-light"></iconify-icon></span>
                                                </div>
                                                <div class="btn btn-primary p-3 py-2" style="width: 7%;">
                                                    {{ (int) $oceanDomainResult['emotional-stability']['percentage'] ?? 0 }}
                                                </div>
                                            </div>
                                            <div class="accordion-item pl-8 mb-8">
                                                <div id="highAnxietyAccordion"
                                                    class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2"
                                                    aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $oceanDomainDescriptors->where('slug', 'high-anxiety')->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item pl-8 mb-8">
                                                <div id="lowAnxietyAccordion"
                                                    class="accordion-collapse collapse color-black p-1.5 shadow-deep br-9 mt-2"
                                                    aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body font13 description_accordian">
                                                        {{ $oceanDomainDescriptors->where('slug', 'low-anxiety')->first()->analysis ?? ' ' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="container text-center bg_secondary_green p-5"
                                            style="border-radius: 16px;">
                                            <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                            </iconify-icon>
                                            <h4>Data Not Available </h4>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if ($user->is_personality_motivation_completed == 1)
                                <div class="card h-full shadow-base2 mt-5">
                                    <header class="card-header">

                                        <h4 class="card-title">Personality Type
                                            ({{ $user && $user->personality_type ? ucwords(strtolower($user->personality_type->personality_name)) : '' }})
                                        </h4>

                                    </header>
                                    <div class="card-body p-6">
                                        @if ($user->is_personality_motivation_completed == 1 && $user->personality_type)
                                            <!--begin::Accordion-->
                                            <!--begin::Accordion-->
                                            <div class="accordion accordion-icon-collapse" id="kt_accordion_3">
                                                <!--begin::Item-->
                                                <div class="mb-5">
                                                    <!--begin::Header-->
                                                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                                                        data-bs-target="#kt_accordion_3_item_1">
                                                        <span class="accordion-icon">
                                                            {{-- <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                            <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span class="path2"></span></i> --}}
                                                            <iconify-icon icon="ph:plus-fill"
                                                                class="accordion-icon-off fa-1-5"></iconify-icon>
                                                            <iconify-icon icon="ph:minus-fill"
                                                                class="accordion-icon-on fa-1-5"></iconify-icon>
                                                        </span>
                                                        <h3 class="fs-4 fw-semibold mb-0 ms-4">
                                                            {{ $user->personality_type->type_name }}</h3>
                                                    </div>
                                                    <!--end::Header-->

                                                    <!--begin::Body-->
                                                    <div id="kt_accordion_3_item_1" class="fs-6 collapse show ps-10"
                                                        data-bs-parent="#kt_accordion_3">
                                                        {{ $user->personality_type->descriptions }}
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->

                                                <!--end::Item-->
                                            </div>
                                            <!--end::Accordion-->
                                            <!--end::Accordion-->

                                            <div class="accordion accordion-icon-collapse"
                                                id="kt_accordion_3_communicationDescriptor">
                                                <!--begin::Item-->
                                                <div class="mb-5">
                                                    <!--begin::Header-->
                                                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                                                        data-bs-target="#kt_accordion_3_item_1_communicationDescriptor">
                                                        <span class="accordion-icon">
                                                            {{-- <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                        <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span class="path2"></span></i> --}}
                                                            <iconify-icon icon="ph:plus-fill"
                                                                class="accordion-icon-off fa-1-5"></iconify-icon>
                                                            <iconify-icon icon="ph:minus-fill"
                                                                class="accordion-icon-on fa-1-5"></iconify-icon>
                                                        </span>
                                                        <h3 class="fs-4 fw-semibold mb-0 ms-4">Strengths</h3>
                                                    </div>
                                                    <!--end::Header-->

                                                    <!--begin::Body-->
                                                    <div id="kt_accordion_3_item_1_communicationDescriptor"
                                                        class="fs-6 collapse show ps-10"
                                                        data-bs-parent="#kt_accordion_3_communicationDescriptor">
                                                        {{ $user->personality_type->strengths_description }}
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->
                                                <div class="accordion accordion-icon-collapse"
                                                    id="kt_accordion_3_communicationDescriptor_2">
                                                    <!--begin::Item-->
                                                    <div class="mb-5">
                                                        <!--begin::Header-->
                                                        <div class="accordion-header py-3 d-flex"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#kt_accordion_3_item_1_communicationDescriptor_2">
                                                            <span class="accordion-icon">
                                                                {{-- <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                        <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span class="path2"></span></i> --}}
                                                                <iconify-icon icon="ph:plus-fill"
                                                                    class="accordion-icon-off fa-1-5"></iconify-icon>
                                                                <iconify-icon icon="ph:minus-fill"
                                                                    class="accordion-icon-on fa-1-5"></iconify-icon>
                                                            </span>
                                                            <h3 class="fs-4 fw-semibold mb-0 ms-4">Weaknesses</h3>
                                                        </div>
                                                        <!--end::Header-->

                                                        <!--begin::Body-->
                                                        <div id="kt_accordion_3_item_1_communicationDescriptor_2"
                                                            class="fs-6 collapse show ps-10"
                                                            data-bs-parent="#kt_accordion_3_communicationDescriptor_2">
                                                            {{ $user->personality_type->weaknesses_description }}
                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->

                                                    <!--end::Item-->
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                        @else
                                            <div class="container text-center bg_secondary_green p-5"
                                                style="
                                                            border-radius: 16px;">
                                                <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                                </iconify-icon>
                                                <h4>Data Not Available </h4>
                                            </div>
                                        @endif


                                    </div>
                                </div>
                                <div class="card h-full shadow-base2 mt-5">
                                    <header class="card-header">
                                        <h4 class="card-title">Flight Risk</h4>

                                    </header>
                                    <div class="card-body p-6">
                                        {{-- {{ dd($workCompetencyResult) }} --}}
                                        @if ($user->is_personality_motivation_completed == 1)
                                            <!--begin::Accordion-->
                                            <!--begin::Accordion-->
                                            <div class="accordion accordion-icon-collapse" id="kt_accordion_2">
                                                <!--begin::Item-->
                                                <div class="mb-5">
                                                    <!--begin::Header-->
                                                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                                                        data-bs-target="#kt_accordion_3_item_3">
                                                        <span class="accordion-icon">
                                                            {{-- <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                            <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span class="path2"></span></i> --}}
                                                            <iconify-icon icon="ph:plus-fill"
                                                                class="accordion-icon-off fa-1-5"></iconify-icon>
                                                            <iconify-icon icon="ph:minus-fill"
                                                                class="accordion-icon-on fa-1-5"></iconify-icon>
                                                        </span>
                                                        <h3 class="fs-4 fw-semibold mb-0 ms-4">
                                                            {{ isset($flightRiskResult['flight-risk']['level_description']) ? ucfirst($flightRiskResult['flight-risk']['level_description']) : 'Moderate' }}
                                                        </h3>
                                                    </div>
                                                    <!--end::Header-->

                                                    <!--begin::Body-->
                                                    <div id="kt_accordion_3_item_3" class="fs-6 collapse show ps-10"
                                                        data-bs-parent="#kt_accordion_2">
                                                        {{-- @if (isset($flightRiskResult['flight-risk']['level_description']) && $flightRiskResult['flight-risk']['level_description'] == 'high')
                                                                Employees identified with a high flight risk exhibit signs of
                                                                decreased engagement, such as reduced productivity, lack of
                                                                involvement in team activities, or open exploration of new job
                                                                opportunities.
                                                            @elseif (isset($user->flight_risk_level) && $user->flight_risk_level == 'low')
                                                                Employees at a low flight risk level display strong engagement
                                                                and satisfaction with their roles, actively participate in
                                                                organizational activities, and express a commitment to long-term
                                                                career development within the company.
                                                            @else
                                                                Those with a moderate flight risk might express occasional
                                                                dissatisfaction or ambivalence about their career progression,
                                                                job role, or the organizational culture.
                                                            @endif --}}
                                                        {{ $flightRiskResult['flight-risk']['description'] ?? '' }}
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->

                                                <!--end::Item-->
                                            </div>
                                            <!--end::Accordion-->
                                            <!--end::Accordion-->
                                        @else
                                            <div class="container text-center bg_secondary_green p-5"
                                                style="
                                                            border-radius: 16px;">
                                                <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                                </iconify-icon>
                                                <h4>Data Not Available </h4>
                                            </div>
                                        @endif


                                    </div>
                                </div>

                                <div class="card h-full shadow-base2 mt-5">
                                    <header class="card-header">

                                        <h4 class="card-title">Workplace Alignment Forecast</h4>

                                    </header>
                                    <div class="card-body p-6">
                                        {{-- {{ dd($workCompetencyResult) }} --}}
                                        @if ($user->is_personality_motivation_completed == 1)
                                            @php
                                                $organizational_fit_forecast_result =
                                                    $organizationalFitForecastResult['organizational-fit-forecast'][
                                                        'level_description'
                                                    ] ?? '';
                                            @endphp
                                            <!--begin::Accordion-->
                                            <div class="accordion accordion-icon-collapse" id="kt_accordion_4">
                                                <!--begin::Item-->
                                                <div class="mb-5">
                                                    <!--begin::Header-->
                                                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                                                        data-bs-target="#kt_accordion_3_item_4">
                                                        <span class="accordion-icon">
                                                            {{-- <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                            <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span class="path2"></span></i> --}}
                                                            <iconify-icon icon="ph:plus-fill"
                                                                class="accordion-icon-off fa-1-5"></iconify-icon>
                                                            <iconify-icon icon="ph:minus-fill"
                                                                class="accordion-icon-on fa-1-5"></iconify-icon>
                                                        </span>
                                                        <h3 class="fs-4 fw-semibold mb-0 ms-4">
                                                            {{ ucfirst($organizational_fit_forecast_result) ?? 'Moderate Risk' }}
                                                        </h3>
                                                    </div>
                                                    <!--end::Header-->

                                                    <!--begin::Body-->
                                                    <div id="kt_accordion_3_item_4" class="fs-6 collapse show ps-10"
                                                        data-bs-parent="#kt_accordion_4">
                                                        {{-- @if (isset($organizational_fit_forecast_result) && $organizational_fit_forecast_result == 'high risk')
                                                                Employees at a high risk level may exhibit behaviors that can lead
                                                                to discord within teams and affect the overall workplace atmosphere
                                                                negatively.
                                                            @elseif(isset($organizational_fit_forecast_result) && $organizational_fit_forecast_result == 'low risk')
                                                                Employees at a low risk level typically exhibit behaviors that
                                                                support and strengthen team unity and align well with the company's
                                                                cultural values.
                                                            @else
                                                                Employees with a moderate risk level might occasionally display
                                                                behaviors that could impact team dynamics, yet these issues are
                                                                generally manageable with proactive strategies.
                                                            @endif --}}
                                                        {{ $organizationalFitForecastResult['organizational-fit-forecast']['description'] ?? '' }}
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->

                                                <!--end::Item-->
                                            </div>
                                            <!--end::Accordion-->
                                            <!--end::Accordion-->
                                        @else
                                            <div class="container text-center bg_secondary_green p-5"
                                                style="
                                                            border-radius: 16px;">
                                                <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                                </iconify-icon>
                                                <h4>Data Not Available </h4>
                                            </div>
                                        @endif


                                    </div>
                                </div>

                                <div class="card h-full shadow-base2 mt-5">
                                    <header class="card-header">
                                        <h4 class="card-title">Growth Potential</h4>

                                    </header>

                                    <div class="card-body p-6">
                                        {{-- {{ dd($workCompetencyResult) }} --}}
                                        @if ($user->is_personality_motivation_completed == 1)
                                            @php
                                                $growth_potential_result =
                                                    $growthPotentialResult['growth-potential']['level_description'] ??
                                                    '';
                                            @endphp
                                            <!--begin::Accordion-->
                                            <div class="accordion accordion-icon-collapse" id="kt_accordion_4">
                                                <!--begin::Item-->
                                                <div class="mb-5">
                                                    <!--begin::Header-->
                                                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                                                        data-bs-target="#kt_accordion_3_item_4">
                                                        <span class="accordion-icon">
                                                            {{-- <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                            <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span class="path2"></span></i> --}}
                                                            <iconify-icon icon="ph:plus-fill"
                                                                class="accordion-icon-off fa-1-5"></iconify-icon>
                                                            <iconify-icon icon="ph:minus-fill"
                                                                class="accordion-icon-on fa-1-5"></iconify-icon>
                                                        </span>
                                                        <h3 class="fs-4 fw-semibold mb-0 ms-4">
                                                            {{ ucfirst($growth_potential_result) ?? 'Moderate' }}</h3>
                                                    </div>
                                                    <!--end::Header-->

                                                    <!--begin::Body-->
                                                    <div id="kt_accordion_3_item_4" class="fs-6 collapse show ps-10"
                                                        data-bs-parent="#kt_accordion_4">
                                                        {{-- @if (isset($growth_potential_result) && strtolower($growth_potential_result) == 'very high')
                                                               Very High-potential employees are visionaries who not only excel in their current roles but also drive innovation and strategic transformation within the organization. They are natural leaders with exceptional foresight, capable of inspiring and mobilizing teams towards ambitious goals. These individuals thrive in challenging environments and are prime candidates for top executive positions, as they consistently deliver extraordinary results and exhibit a profound impact on the company's long-term success.
                                                            @elseif (isset($growth_potential_result) && strtolower($growth_potential_result) == 'high')
                                                               High-potential employees demonstrate remarkable performance and possess the ability to take on significant responsibilities swiftly. They exhibit strong leadership qualities, strategic thinking, and an exceptional capacity for growth and learning. These employees are ideal for advanced development programs, often transitioning into critical leadership roles and contributing to major organizational initiatives. Their proactive approach and high-level problem-solving skills make them indispensable assets in driving company progress.
                                                            @elseif(isset($growth_potential_result) && strtolower($growth_potential_result) == 'moderate')
                                                               Moderate-potential employees excel in adaptability, learning, and leadership. They respond well to accelerated development opportunities, such as cross-functional projects and leadership training, often being candidates for succession planning and strategic organizational roles. Their enthusiasm for personal and professional growth, combined with their ability to inspire peers, positions them as key contributors to the organization's future success.
                                                            @else
                                                               Employees at this level are dependable and consistent in their current roles. They benefit from focused skill enhancement and may evolve into broader roles over time with dedicated training and mentorship. They are foundational to maintaining the status quo and operational success. With the right support and development, these individuals have the potential to grow and take on more responsibilities within the organization.
                                                            @endif --}}
                                                        {{ $growthPotentialResult['growth-potential']['description'] ?? '' }}
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->

                                                <!--end::Item-->
                                            </div>
                                            <!--end::Accordion-->
                                            <!--end::Accordion-->
                                        @else
                                            <div class="container text-center bg_secondary_green p-5"
                                                style="
                                                            border-radius: 16px;">
                                                <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                                </iconify-icon>
                                                <h4>Data Not Available </h4>
                                            </div>
                                        @endif


                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
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
                            id="application_id" value="{{ $jobOpeningApplication->id }}" required />

                        <div class="fv-row mb-8">
                            <label class="form-label mb-3">Interview Date Time</label>
                            <input type="datetime-local" value="{{ $jobOpeningApplication->interview_date ?? '' }}"
                                name="interview_datetime" class="form-control bg-transparent" id="interview_datetime"
                                required />
                            <div class="invalid-feedback" id="datetime_error"></div>
                        </div>

                        <div class="fv-row mb-8">
                            <label class="form-label mb-3">Interview Description</label>
                            <textarea placeholder="Enter Interview description" name="interview_description" class="form-control bg-transparent"
                                id="interview_description" required>{{ $jobOpeningApplication->interview_description ?? '' }}</textarea>
                            <div class="invalid-feedback" id="description_error"></div>
                        </div>

                        <div class="fv-row mb-8">
                            <label class="form-label mb-3">Interviewer Name</label>
                            <input type="text" placeholder="Enter Interviewer name"
                                value="{{ $jobOpeningApplication->interviewer_name ?? '' }}" name="interviewer_name"
                                class="form-control bg-transparent" id="interviewer_name" required />
                            <div class="invalid-feedback" id="interviewer_name_error"></div>
                        </div>

                        <div class="fv-row mb-8">
                            <label class="form-label mb-3">Interview Mode</label>
                            <select class="form-control" name="interview_mode" id="interview_mode">
                                <option value="2" @if ($jobOpeningApplication->interview_mode == '2') selected @endif>Online</option>
                                <option value="1" @if ($jobOpeningApplication->interview_mode == '1') selected @endif>Physical
                                </option>
                            </select>
                            <div class="invalid-feedback" id="interview_mode_error"></div>
                        </div>

                        <!-- Interview Link Field -->
                        <div class="fv-row mb-8" id="interview_link_container">
                            <label class="form-label mb-3">Interview Link</label>
                            <input type="url" placeholder="Enter Interview link"
                                value="{{ $jobOpeningApplication->interview_link ?? '' }}" name="interview_link"
                                class="form-control bg-transparent" id="interview_link" />
                            <div class="invalid-feedback" id="link_error"></div>
                        </div>

                        <!-- Interview Address Field -->
                        <div class="fv-row mb-8" id="interview_address_container" style="display:none;">
                            <label class="form-label mb-3">Interview Address</label>
                            <input type="text" placeholder="Enter Interview Address"
                                value="{{ $jobOpeningApplication->interview_address ?? '' }}" name="interview_address"
                                class="form-control bg-transparent" id="interview_address" />
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
                            id="application_id" value="{{ $jobOpeningApplication->id }}" required />

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

    {{-- all facet modal start --}}
    @if ($user->is_personality_motivation_completed == 1 && $isResultAvailable)
        {{-- #Openness To Experience Facets Modal --}}
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
            id="openness_facets_modal" tabindex="-1" aria-labelledby="openness_facets_modal" aria-hidden="true">
            <div class="modal-dialog modal-xl relative w-auto pointer-events-none">
                <div
                    class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
                        rounded-md outline-none text-current">
                    <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                        <!-- Modal header -->
                        <div class="d-flex justify-content-between p-5">
                            <h3 class="text-xl font-medium text-dark capitalize">
                                Openness to Experiences
                            </h3>
                            <button type="button" class="border-0 bg-transparent" data-bs-dismiss="modal">
                                <iconify-icon icon="akar-icons:cross" class="fa-1-5"></iconify-icon>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-4">
                            <div class="">
                                <div class="row" style="justify-content: end;">
                                    <div class="col-lg-12">
                                        <button class="btn btn-primary p-3 py-2" style="float: right;">Percentile
                                            (th)</button>
                                    </div>
                                </div>
                                <h6> {{ $oceanDomainResult['openness-to-experience']['description'] ?? ' ' }} </h6>
                                {!! renderFinalFacetHtml(
                                    'Practicality',
                                    'daydreaming',
                                    'Day Dreaming',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'daydreaming',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Practical Aesthetics',
                                    'aesthetic_appreciation',
                                    'Aesthetic Appreciation',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'aesthetic-appreciation',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Measured Emotionality',
                                    'feeling_aware',
                                    'Feeling Aware',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'feeling-aware',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Consistent Reliability',
                                    'explorer',
                                    'Explorer',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'explorer',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Realistic Pragmatism',
                                    'innovation',
                                    'Innovation',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'innovation',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Traditional Values',
                                    'open_mindedness',
                                    'Open Mindedness',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'open-mindedness',
                                ) !!}


                                {{-- <div class="slider-container">
                                    <div class="slider-label">Practicality</div>
                            
                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->daydreaming_avg) && ($oceanAllFacetsEmployeeAResult->daydreaming_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->daydreaming_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->daydreaming_avg / 5) * 100 ?? 0 }}%;">
                                            P
                                        </div>
                                    </div>
                                    <div class="slider-label">Daydreaming</div>
                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">Practical Aesthetics</div>
                                    
                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->aesthetic_appreciation_avg) && ($oceanAllFacetsEmployeeAResult->aesthetic_appreciation_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->aesthetic_appreciation_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->aesthetic_appreciation_avg / 5) * 100 ?? 0 }}%;">
                                            P</div>

                                    </div>
                                    <div class="slider-label">Aesthetic Appreciation</div>
                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">Measured Emotionality</div>

                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->feeling_aware_avg) && ($oceanAllFacetsEmployeeAResult->feeling_aware_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->feeling_aware_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->feeling_aware_avg / 5) * 100 ?? 0 }}%;">
                                            P</div>
                                    </div>
                                    <div class="slider-label">Feeling Aware</div>

                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">Consistent Reliability</div>
                                    
                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->explorer_avg) && ($oceanAllFacetsEmployeeAResult->explorer_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->explorer_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->explorer_avg / 5) * 100 ?? 0 }}%;">P
                                        </div>
                                    </div>
                                    <div class="slider-label">Explorer</div>
                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">Realistic Pragmatism</div>

                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->innovation_avg) && ($oceanAllFacetsEmployeeAResult->innovation_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->innovation_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->innovation_avg / 5) * 100 ?? 0 }}%;">
                                            P
                                        </div>
                                    </div>
                                    <div class="slider-label">Innovation</div>

                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">Traditional Values</div>
                                    
                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->open_mindedness_avg) && ($oceanAllFacetsEmployeeAResult->open_mindedness_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->open_mindedness_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->open_mindedness_avg / 5) * 100 ?? 0 }}%;">
                                            P</div>
                                    </div>
                                    <div class="slider-label">Open-mindedness</div>
                                </div> --}}
                            </div>
                        </div>
                        <!-- Modal footer -->
                        {{-- <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button data-bs-dismiss="modal"
                            class="btn inline-flex justify-center text-white bg-black-500">Accept</button>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Conscientiousness Facets Modal --}}
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
            id="conscientiousness_facets_modal" tabindex="-1" aria-labelledby="conscientiousness_facets_modal"
            aria-hidden="true">
            <div class="modal-dialog modal-xl relative w-auto pointer-events-none">
                <div
                    class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                    <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                        <!-- Modal header -->
                        <div class="d-flex justify-content-between p-5">
                            <h3 class="text-xl font-medium text-dark capitalize">
                                Conscientiousness
                            </h3>
                            <button type="button" class="border-0 bg-transparent" data-bs-dismiss="modal">
                                <iconify-icon icon="akar-icons:cross" class="fa-1-5"></iconify-icon>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-4">
                            <div class="">
                                <div class="row" style="justify-content: end;">
                                    <div class="col-lg-12">
                                        <button class="btn btn-primary p-3 py-2" style="float: right;">Percentile
                                            (th)</button>
                                    </div>
                                </div>
                                <h6> {{ $oceanDomainResult['conscientiousness']['description'] ?? ' ' }} </h6>
                                {!! renderFinalFacetHtml(
                                    'Humble Capability',
                                    'self_confidence',
                                    'Self Confidence',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'self-confidence',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Flexibility',
                                    'tidiness',
                                    'Tidiness',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'tidiness',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Autonomy',
                                    'responsibility',
                                    'Responsibility',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'responsibility',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Contentment',
                                    'drive_to_achieve',
                                    'Drive To Achieve',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'drive-to-achieve',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Spontaneity',
                                    'willpower',
                                    'Will Power',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'willpower',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Impulsiveness',
                                    'careful_thinking',
                                    'Careful Thinking',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'careful-thinking',
                                ) !!}

                                {{-- <div class="slider-container">
                                    <div class="slider-label">Humble Capability</div>
                                    
                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->self_confidence_avg) && ($oceanAllFacetsEmployeeAResult->self_confidence_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->self_confidence_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->self_confidence_avg / 5) * 100 ?? 0 }}%;">
                                            P</div>
                                    </div>
                                    <div class="slider-label">Self-Confidence</div>
                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">Flexibility</div>
                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->tidiness_avg) && ($oceanAllFacetsEmployeeAResult->tidiness_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->tidiness_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->tidiness_avg / 5) * 100 ?? 0 }}%;">P
                                        </div>

                                    </div>
                                    <div class="slider-label">Tidiness</div>
                                    
                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">Autonomy</div>

                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->responsibility_avg) && ($oceanAllFacetsEmployeeAResult->responsibility_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->responsibility_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->responsibility_avg / 5) * 100 ?? 0 }}%;">
                                            P</div>
                                    </div>
                                    <div class="slider-label">Responsibility</div>

                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">Contentment</div>
                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->drive_to_achieve_avg) && ($oceanAllFacetsEmployeeAResult->drive_to_achieve_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->drive_to_achieve_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->drive_to_achieve_avg / 5) * 100 ?? 0 }}%;">
                                            P</div>
                                    </div>
                                
                                    <div class="slider-label">Drive to Achieve</div>
                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">Spontaneity</div>
                                
                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->will_power_avg) && ($oceanAllFacetsEmployeeAResult->will_power_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->will_power_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->will_power_avg / 5) * 100 ?? 0 }}%;">
                                            P
                                        </div>
                                    </div>
                                    <div class="slider-label">Willpower</div>
                                </div>
                                <div class="slider-container">
                                    <div class="slider-label">Impulsiveness</div>
                                    
                                    <div class="slider-track">
                                        <div class="emp_a"
                                            @if (isset($oceanAllFacetsEmployeeAResult->careful_thinking_avg) && ($oceanAllFacetsEmployeeAResult->careful_thinking_avg / 5) * 100 == 100) style="left: 93%;"@else
                                            style="left: {{ ($oceanAllFacetsEmployeeAResult->careful_thinking_avg / 5) * 100 ?? 0 }}%;" @endif>
                                        </div>
                                        <div class="emp_b population_hide hidden_population"
                                            style="left: {{ ($oceanAllFacetsOverallResult->careful_thinking_avg / 5) * 100 ?? 0 }}%;">
                                            P</div>
                                    </div>
                                    <div class="slider-label">Careful Thinking</div>
                                </div> --}}
                            </div>
                        </div>
                        <!-- Modal footer -->
                        {{-- <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button data-bs-dismiss="modal"
                            class="btn inline-flex justify-center text-white bg-black-500">Accept</button>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Extraversion Facets Modal --}}
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
            id="extraversion_facets_modal" tabindex="-1" aria-labelledby="extraversion_facets_modal"
            aria-hidden="true">
            <div class="modal-dialog modal-xl relative w-auto pointer-events-none">
                <div
                    class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
                    rounded-md outline-none text-current">
                    <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                        <!-- Modal header -->
                        <div class="d-flex justify-content-between p-5">
                            <h3 class="text-xl font-medium text-dark capitalize">
                                Extraversion
                            </h3>

                            <button type="button" class="border-0 bg-transparent" data-bs-dismiss="modal">
                                <iconify-icon icon="akar-icons:cross" class="fa-1-5"></iconify-icon>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-4">
                            <div class="">
                                <div class="row" style="justify-content: end;">
                                    <div class="col-lg-12">
                                        <button class="btn btn-primary p-3 py-2" style="float: right;">Percentile
                                            (th)</button>
                                    </div>
                                </div>
                                <h6> {{ $oceanDomainResult['extraversion']['description'] ?? ' ' }} </h6>
                                {!! renderFinalFacetHtml(
                                    'Reservedness',
                                    'sociability',
                                    'Sociability',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'sociability',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Independence',
                                    'crowd_enjoyment',
                                    'Crowd Enjoyment',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'crowd-enjoyment',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Humility',
                                    'confidence',
                                    'Confidence',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'confidence',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Calmness',
                                    'energetic_lifestyle',
                                    'Energetic Lifestyle',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'energetic-lifestyle',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Risk Aversion',
                                    'thrill_seeking',
                                    'Thrill Seeking',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'thrill-seeking',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Composed Outlook',
                                    'optimism',
                                    'Optimism',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'optimism',
                                ) !!}

                            </div>
                        </div>
                        <!-- Modal footer -->
                        {{-- <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button data-bs-dismiss="modal"
                            class="btn inline-flex justify-center text-white bg-black-500">Accept</button>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Agreeableness Facets Modal --}}
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
            id="agreeableness_facets_modal" tabindex="-1" aria-labelledby="agreeableness_facets_modal"
            aria-hidden="true">
            <div class="modal-dialog modal-xl relative w-auto pointer-events-none">
                <div
                    class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                    <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                        <!-- Modal header -->
                        <div class="d-flex justify-content-between p-5">
                            <h3 class="text-xl font-medium text-dark capitalize">
                                Agreeableness
                            </h3>

                            <button type="button" class="border-0 bg-transparent" data-bs-dismiss="modal">
                                <iconify-icon icon="akar-icons:cross" class="fa-1-5"></iconify-icon>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-4">
                            <div class="">
                                <div class="row" style="justify-content: end;">
                                    <div class="col-lg-12">
                                        <button class="btn btn-primary p-3 py-2" style="float: right;">Percentile
                                            (th)</button>
                                    </div>
                                </div>
                                <h6> {{ $oceanDomainResult['agreeableness']['description'] ?? ' ' }} </h6>
                                {!! renderFinalFacetHtml(
                                    'Skepticism',
                                    'belief',
                                    'Belief',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'belief',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Tactfulness',
                                    'honesty',
                                    'Honesty',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'honesty',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Self-Reliance',
                                    'helpfulness',
                                    'Helpfulness',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'helpfulness',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Self-Assuredness',
                                    'diplomacy',
                                    'Diplomacy',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'diplomacy',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Self-Belief',
                                    'humility',
                                    'Humility',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'humility',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Tough-Mindedness',
                                    'compassion',
                                    'Compassion',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'compassion',
                                ) !!}

                            </div>
                        </div>
                        <!-- Modal footer -->
                        {{-- <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button data-bs-dismiss="modal"
                            class="btn inline-flex justify-center text-white bg-black-500">Accept</button>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Emotional Stability Facets Modal --}}
        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
            id="emotional_stability_facets_modal" tabindex="-1" aria-labelledby="emotional_stability_facets_modal"
            aria-hidden="true">
            <div class="modal-dialog modal-xl relative w-auto pointer-events-none">
                <div
                    class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
            rounded-md outline-none text-current">
                    <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                        <!-- Modal header -->
                        <div class="d-flex justify-content-between p-5">
                            <h3 class="text-xl font-medium text-dark capitalize">
                                Emotional Stability
                            </h3>

                            <button type="button" class="border-0 bg-transparent" data-bs-dismiss="modal">
                                <iconify-icon icon="akar-icons:cross" class="fa-1-5"></iconify-icon>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-4">
                            <div class="">
                                <div class="row" style="justify-content: end;">
                                    <div class="col-lg-12">
                                        <button class="btn btn-primary p-3 py-2" style="float: right;">Percentile
                                            (th)</button>
                                    </div>
                                </div>
                                <h6> {{ $oceanDomainResult['emotional-stability']['description'] ?? ' ' }} </h6>
                                {!! renderFinalFacetHtml(
                                    'Stress Sensitivity',
                                    'steadiness',
                                    'Steadiness',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'steadiness',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Irritability',
                                    'tolerance',
                                    'Tolerance',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'tolerance',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Discouragement',
                                    'positivity',
                                    'Positivity',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'positivity',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Self-Doubt',
                                    'social_sensitivity',
                                    'Social Sensitivity',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'social-sensitivity',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Rashness',
                                    'impulse_control',
                                    'Impulse Control',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'impulse-control',
                                ) !!}
                                {!! renderFinalFacetHtml(
                                    'Stress Prone',
                                    'stress_response',
                                    'Stress Response',
                                    $oceanAllFacetsSingleResult,
                                    $oceanAllFacetsOverallResult,
                                    $allHighFacets,
                                    $allLowFacets,
                                    $allFacetsDescriptions,
                                    $oceanAllFacetsResult,
                                    'stress-response',
                                ) !!}

                            </div>
                        </div>
                        <!-- Modal footer -->
                        {{-- <div
                        class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                        <button data-bs-dismiss="modal"
                            class="btn inline-flex justify-center text-white bg-black-500">Accept</button>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- all facet modal end --}}
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0"></script>

    <script>
        var options = {
            chart: {
                type: 'donut',
                width: 400, // Set the width of the chart
                height: 300, // Set the height of the chart
            },
            series: [{{ $totalCorrectForCognitive ?? 0 }}, {{ $totalWrongForCognitive ?? 0 }},
                {{ $totalNonAttemptedForCognitive ?? 0 }}
            ],
            labels: ['Correct', 'Wrong', 'Missed'],
            colors: ['#8CE3E3', '#FFDC92', '#BBA7F6'],
            xaxis: {
                categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
            },

            legend: {
                position: 'bottom', // Set the position of the legend to 'bottom'
            },
        }

        var chart = new ApexCharts(document.querySelector("#donut"), options);

        chart.render();
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
@endsection
