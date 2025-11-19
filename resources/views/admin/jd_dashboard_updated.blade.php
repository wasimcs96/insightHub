<!-- job.index.blade.php -->

@extends('admin.layout.app')

@section('title', 'Setting - Job Descriptions')

@section('styles')
    <style>
        .bg-grey {
            border-radius: 8.125px !important;
            align-items: flex-start;
            gap: 10px;
            padding: 26px 29.25px;
        }

        .bg-grey .grey-text {
            color: #99A1B7;
        }

        .bg-grey svg {
            color: #F7951D;
        }

        .bg-grey:active,
        .bg-grey:hover {
            color: #fff;
            background: #F7951D;
        }

        .badge-orange {
            border-radius: 80px;
            background: #FFF3E0;
            color: #975102;
            text-align: left;
            font-size: 12px;
            font-weight: 500;
            line-height: normal;
            padding: 8px 16px;
            height: fit-content;
        }

        .text-title {
            color: #071437;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
        }

        .grey-text {
            font-size: 39px;
            font-weight: 600;
            line-height: 46.8px;
            width: 100%;
        }

        .behave-scroll .card:hover,
        .behave-scroll .card.bg-active-orange:hover {
            background: #F7951D !important;
            /* orange shade */
            color: #fff;
        }

        .behave-scroll .card:hover .text-title,
        .behave-scroll .card:hover .grey-text,
        .behave-scroll .card:hover p {
            color: #fff !important;
        }

        .grey-text p {
            font-size: 13.975px;
            font-weight: 500;
            line-height: 16.77px;
        }

        .accordion-border {
            border-bottom: 1px solid #F1F1F4;
            /* margin-bottom: 5px !important; */
            border-radius: 8.13px 8.13px 0px 0px;
            align-items: center;
        }

        .bg-open-accordion {
            padding: 0px 19.5px 24px;
            border-radius: 0px 0px 8.13px 8.13px;
        }

        .accordion .accordion-heading {
            color: #292929;
            font-size: 17.55px;
            font-weight: 700;
            line-height: 20px;
            letter-spacing: 0.25px;
        }

        .accordion-icon {
            display: flex;
            align-items: center;
        }

        .menu-active-bg-light-primary .menu-item .menu-link.active {
            border-radius: 6.8px;
            border-bottom: 1px solid #F3F3F3;
            background-color: rgba(247, 149, 29, 0.15) !important;
            color: #1E2129 !important;
            font-size: 13px;
            font-weight: 400;
            line-height: 16.9px;
            letter-spacing: 0.5px;
        }

        .scroll-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .scroll-arrow {
            background-color: #fff;
            border: none;
            border-radius: 50%;
            padding: 5px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            cursor: pointer;
            z-index: 1;
            transition: background-color 0.3s ease;
        }

        .scroll-arrow:hover {
            background-color: #F7951D;
        }

        .left-arrow {
            position: absolute;
            left: 0;
            top: 38%;
        }

        .right-arrow {
            position: absolute;
            right: -10px;
            top: 38%;
        }

        .behave-scroll {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
            flex-flow: nowrap;
            margin: 0px 30px;
            width: 100%;
        }

        .card-checked-orange {
            border: 2px solid #F7941D !important;
            background-color: #F7941D !important;
            color: #FFFFFF !important;
        }

        .header-checked-orange {
            background: #F7941D !important;
            color: #ffffff !important;
        }


        .card-checked-orange .fa-check-circle {
            color: #FFFFFF !important;
        }

        .card {
            background-color: #FFFFFF !important;
            color: #000000 !important;
        }

        .card .card-header {
            justify-content: flex-start !important;
        }

        .check-icon-orange {
            color: #F7941D
        }

        .card-title-orange {
            color: #FFF !important;
            font-size: 16.575px;
            font-weight: 700;
            line-height: 24px;
            letter-spacing: 0.15px;
        }

        .navtab-btn {
            display: flex;
            border: 1px solid #F7941D;
            border-radius: 6px;
            overflow: hidden;
        }

        .navtab-btn .tab-link {
            text-align: center;
            padding: 8px 16px;
            color: #F7941D;
            background-color: #fff;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 12px;
            line-height: 16px;
        }

        .navtab-btn .tab-link.active-tab {
            background-color: #F7941D;
            color: #fff;
        }

        .border-check-orange {
            border: 2px solid #F7941D !important;
        }

        .technical-accordion .star-technical {
            color: #F7941D;
        }

        #kt_accordion_4 .accordion-header[aria-expanded="true"] h4,
        #kt_accordion_3 .accordion-header[aria-expanded="true"] h4 {
            font-weight: 700 !important;
        }

        #kt_accordion_4 .accordion-header[aria-expanded="true"] {
            background-color: #F2EEFD !important;
        }

        #kt_accordion_3 .accordion-header[aria-expanded="true"] {
            background-color: rgb(226, 246, 246) !important;
        }

        .accordion-header {
            transition: background-color 0.3s ease;
        }

        #kt_accordion_technical .accordion-header[aria-expanded="true"] h4,
        #kt_accordion_4 .accordion-header[aria-expanded="true"] h4,
        #kt_accordion_3 .accordion-header[aria-expanded="true"] h4 {
            font-weight: 700 !important;
        }

        #kt_accordion_technical .accordion-header[aria-expanded="true"] {
            background-color: #FFF6EA !important;
            border: none;
        }

        .align-right {
            margin-left: auto;
        }

        .btn-outline-custom {
            display: flex;
            height: 32px;
            padding: 8px 16px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            border: 1px solid #F7941C;
            background: #FFF;
            color: #F7941C;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            width: fit-content;
            transition: background-color 0.2s, color 0.2s;
        }

        .btn-outline-custom:hover,
        .btn-outline-custom:active {
            background-color: #F9A845 !important;
            color: #fff !important;
            border-color: #F7941C !important;
        }
    </style>

@section('content')


    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container"
            class="app-container  container-fluid d-flex flex-stack app-container container-xxl">


            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
                class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->

                @if (request('saved_job') == 1)
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        @php
                            $title = 'Job Descriptions';
                            try {
                                if (request('department')) {
                                    $var1 = \App\Models\Department::where('id', request('department'))->first();
                                    if ($var1) {
                                        $title = $var1->name;
                                    }
                                }
                            } catch (\Exception $e) {
                            }
                        @endphp

                        @if (request('department'))
                            {{ $title }}
                        @else
                            Job Descriptions
                        @endif
                    </h1>
                @elseif (request('saved_job') == 0)
                    {{-- @if (request('department'))
                        @php
                            $name = '';
                            $sector = \App\Models\Sector::where('id', request('department'))->first();
                            if ($sector) {
                                $name = $sector->name;
                            }
                        @endphp

                        @if ($name != '')
                            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                                {{ $name }}
                            </h1>
                        @endif
                    @endif --}}
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Job Descriptions
                    </h1>
                @endif
                <!--end::Title-->


                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="#" class="text-muted text-hover-primary">
                            Home </a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('jobs.index') }}" class="text-muted text-hover-primary">
                            Master JD List
                        </a>
                    </li>


                    @if (request('department'))
                        @php
                            $name = '';
                            $department_name = \App\Models\Sector::where('id', request('department'))->first();
                            if ($department_name) {
                                $name = $department_name->name;
                            }
                        @endphp

                        @if ($name != '')
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <a href="#" class="text-muted text-hover-primary">
                                    {{ $name ?? '-' }}
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Action group-->
            <!--begin::Toolbar end-->
            {{-- <div class="d-flex align-items-center gap-2 gap-lg-3">



                <!--begin::Secondary button-->
                <!--end::Secondary button-->
                <a href="{{ route('jobs.index', ['saved_job' => 0]) }}" class="btn btn-sm fw-bold btn-primary">
                    JD Master List </a>
                <a href="{{ route('jobs.savedJobs', ['saved_job' => 1]) }}" class="btn btn-sm fw-bold btn-primary">
                    Company JDs </a>
                <!--begin::Primary button-->
                <a href="{{ route('jobs.create') }}" class="btn btn-sm fw-bold btn-primary">
                    Create </a>
                <!--end::Primary button-->
            </div> --}}

            <div class="d-flex navtab-btn">
                <a href="{{ route('jobs.savedJobs', ['saved_job' => 1]) }}"
                    class="tab-link {{ Route::currentRouteName() == 'jobs.savedJobs' ? '' : '' }}">
                    Company JDs
                </a>
                <a href="{{ route('jobs.index', ['department' => 1, 'saved_job' => 0]) }}"
                    class="tab-link {{ Route::currentRouteName() == 'admin.jobdescriptions' ? 'active-tab' : '' }}">
                    JD Master List
                </a>
            </div>

            <!--end::Toolbar end-->
            <!--end::Action group-->
        </div>
        <!--end::Toolbar container-->
    </div>


    <div id="kt_app_content" class="app-content  flex-column-fluid ">



        <div id="kt_app_content_container" class="app-container">


            <div class="scroll-container">
                <!-- Left Arrow -->
                <button class="scroll-arrow left-arrow" onclick="scrollContent('left')">
                    <iconify-icon icon="ic:baseline-arrow-back" width="20" height="20"></iconify-icon>
                </button>

                <!-- Scrollable Content -->
                <div class="gx-6 gx-xl-9 behave-scroll" id="scrollSection">
                    {{-- @foreach ($data as $key8 => $level)
                    <div class="col-xl-2" style="width: 12.5% !important;">
                        
                        @php
                            $currentUrlParams = request()->query(); // Get current query parameters
                            $currentUrlParams['level'] = $key8; // Set or replace the 'level' parameter
                        @endphp

                            <!--begin::Statistics Widget 5-->
                            <a href="{{ route('admin.saved.jobdescriptions', $currentUrlParams) }}"
                            class="card card-xl-stretch mb-xl-8 bg-active-orange bg-grey">
                            <!--begin::Body-->
                            <iconify-icon icon="carbon:skill-level" width="32" height="32"></iconify-icon>

                            <div class="text-title">
                                {{ $level['title'] }}

                            </div>

                            <div class="grey-text">
                                {{ $level['count'] }} <p>Total Jobs</p>
                            </div>

                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                @endforeach --}}
                    @foreach ($data as $key8 => $level)
                        <div class="col-xl-2" style="width: 12.6% !important; padding: 0px 14.625;">
                            @php
                                $currentUrlParams = request()->query();
                                $currentUrlParams['level'] = $key8;
                                $isDisabled = $level['count'] == 0;
                            @endphp
                            <a href="{{ $isDisabled ? 'javascript:void(0);' : route('admin.jobdescriptions', $currentUrlParams) }}"
                                class="card card-xl-stretch mb-xl-8 bg-active-orange bg-grey"
                                @if ($isDisabled) onclick="showErrorAlert();" @endif>
                                <iconify-icon icon="carbon:skill-level" width="32" height="32"
                                    style="width: 32px; height: 32px;"></iconify-icon>
                                <div class="text-title">
                                    {{ $level['title'] }}
                                </div>
                                <div class="grey-text">
                                    {{ $level['count'] }} <p>Total Jobs</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Right Arrow -->
                <button class="scroll-arrow right-arrow" onclick="scrollContent('right')">
                    <iconify-icon icon="ic:baseline-arrow-forward" width="20" height="20"></iconify-icon>
                </button>
            </div>


            <!--begin::FAQ card-->
            <div class="card">
                <!--begin::Body-->
                <div class="card-body p-lg-15">
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-lg-row">
                        <!--begin::Sidebar-->
                        <div class="flex-column flex-lg-row-auto w-100 w-lg-275px mb-10 me-lg-20">
                            <form action="">
                                <!--begin::Search blog-->
                                <div class="mb-16">
                                    <h4 class="text-gray-900 mb-7">Search Job</h4>

                                    <!--begin::Input group-->
                                    <div class="d-flex">
                                        <input type="text" class="form-control " placeholder="Search for jobs..."
                                            name="search" value="{{ request('search') }}" />
                                        <input type="hidden" class="form-control " name="department"
                                            value="{{ request('department') }}" />
                                        <input type="hidden" class="form-control " name="org_department"
                                            value="{{ request('org_department') }}" />

                                        <input type="hidden" class="form-control " name="saved_job"
                                            value="{{ request('saved_job') }}" />

                                        <button type="submit"
                                            class="btn btn-primary mx-1 d-flex justify-content-center align-items-centers"
                                            data-kt-menu-dismiss="true"><iconify-icon icon="mingcute:search-3-line"
                                                class="fa-1-5" style="color: black"></iconify-icon></button>
                                        @php
                                            // Fetch only the 'department' parameter from the current request, discard others
                                            $specificUrlParams = [
                                                'department' => request('department'),
                                                'saved_job' => request('saved_job'),
                                                'org_department' => request('org_department'),
                                            ]; // Retains only 'department'
                                        @endphp
                                        <a href="{{ route('admin.jobdescriptions', $specificUrlParams) }}"
                                            class="btn btn-sm btn-light btn-active-light-primary me-2 mx-1 d-flex justify-content-center align-items-center"
                                            data-kt-menu-dismiss="true"><iconify-icon icon="system-uicons:reset-alt"
                                                class="fa-2x" style="color: black"></iconify-icon></a>

                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Search blog-->
                            </form>


                            <!--begin::Catigories-->
                            <div class="mb-15">
                                <h4 class="text-gray-900 mb-7">Jobs</h4>

                                <!--begin::Menu-->
                                <div
                                    class="menu menu-rounded menu-column menu-title-gray-700 menu-state-title-primary menu-active-bg-light-primary fw-semibold">
                                    @if ($jobs->count() > 0)
                                        @foreach ($jobs as $key => $job)
                                            @php
                                                $currentUrlParams = request()->query(); // Get current query parameters
                                                $currentUrlParams['selected_job'] = $job->id; // Set or replace the 'level' parameter
                                                $currentUrlParams['search'] = request('search'); // Set or replace the 'level' parameter

                                            @endphp

                                            <!--begin::Item-->
                                            <div class="menu-item">
                                                <!--begin::Link-->
                                                <a href="{{ route('admin.jobdescriptions', $currentUrlParams) }}"
                                                    class="menu-link py-3 {{ request('selected_job') == $job->id ? 'active' : ($key == 0 && !request('selected_job') ? 'active' : '') }}">
                                                    {{ $job->title ?? 'NA' }}
                                                </a>
                                                <!--end::Link-->
                                            </div>
                                            <!--end::Item-->
                                        @endforeach
                                    @else
                                        <div class="alert alert-info text-center">
                                            <p class="mb-0">No Jobs Available</p>
                                        </div>
                                    @endif

                                </div>
                                <!--end::Menu-->
                            </div>
                            <!--end::Catigories-->







                        </div>
                        <!--end::Sidebar-->

                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid">
                            @if ($selectedJob && isset($selectedJob))




                                <!--begin::Extended content-->
                                <div class="mb-13">
                                    <!--begin::Content-->
                                    <div class="mb-15">
                                        <!--begin::Title-->
                                        <div class="d-flex gap-3 align-items-center flex-wrap">
                                            {{-- <span class="badge-orange">Head Counts: {{ $selectedJob->heads ?? 0 }}</span>
                                            <span class="badge-orange">Employees: {{ $employeesCount ?? 0 }}</span> --}}
                                            @php
                                                $sectorName = null;
                                                if ($selectedJob && $selectedJob->department_id) {
                                                    $sector = \App\Models\Sector::find($selectedJob->department_id);
                                                    $sectorName = $sector ? $sector->name : null;
                                                }
                                            @endphp
                                            <span class="badge-orange">Sector: {{ $sectorName ?? 'N/A' }}</span>
                                            <span class="d-flex gap-4 align-items-center p-0 align-right">
                                                <div class="jd-download">
                                                    <a href="{{ route('export.jd.master', ['id' => $selectedJob->id ?? 0]) }}"
                                                        id="download-jd-btn"
                                                        class="btn-outline-custom d-flex align-items-center">
                                                        <iconify-icon icon="material-symbols:download-rounded"
                                                            width="16" height="16"></iconify-icon>
                                                        Download PDF
                                                    </a>
                                                </div>
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex">
                                                <h4 class="fs-2x text-gray-800 w-bolder mb-6 mt-4">
                                                    {{ $selectedJob->title ?? 'NA' }}

                                                </h4>
                                                @if ($selectedJob->is_primary == '0')
                                                    <a href="{{ route('jobs.edit', $selectedJob->id) }}"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mx-2 mt-4">
                                                        <iconify-icon icon="heroicons:pencil-square"
                                                            class="fa-1-5"></iconify-icon>
                                                    </a>
                                                    {{-- <form action="{{ route('jobs.destroy', $selectedJob->id) }}"
                                                        id="form-{{ $selectedJob->id }}" class="btn btn-icon " method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" custom1="{{ $selectedJob->id }}"
                                                            class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm mb-1 show_confirm">
                                                            <iconify-icon icon="heroicons:trash"
                                                                class="fa-1-5"></iconify-icon>
                                                        </button>
                                                    </form> --}}
                                                @endif
                                                {{-- <div class="ml-3 mx-4 mt-4">

                                                    <a href="{{ route('export.jd.master', ['id' => $selectedJob->id ?? 0]) }}"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mx-2"
                                                        title="Export"><iconify-icon icon="clarity:export-solid"
                                                            class="fa-1-5"></iconify-icon></a>

                                                </div> --}}

                                            </div>

                                        </div>
                                        <!--end::Title-->

                                        <!--begin::Text-->
                                        <p class="fw-semibold fs-4 text-gray-600 mb-2">
                                            {{ $selectedJob->description ?? 'NA' }}

                                        </p>
                                        <!--end::Text-->
                                    </div>
                                    <div class="mb-15">
                                        <h5 class="fw-bold mb-3">General Info</h5>
                                        <div class="d-flex gap-7 align-items-center">

                                            <!-- Position Level -->
                                            <div class="form-control bg-white h-100">
                                                <label class="form-label text-muted small">Position Level</label>
                                                <div class="fw-semibold">Level {{ $selectedJob->level ?? '' }}</div>
                                            </div>

                                            <!-- Top 3 RIASEC -->
                                            <div class="form-control bg-white h-100">
                                                <label class="form-label text-muted small">Top 3 RIASEC</label>
                                                <div class="fw-semibold">{{ $selectedJob->top3riasec ?? '' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Content-->

                                    <!--begin::Item-->
                                    <div class="mb-2">
                                        <!--begin::Title-->
                                        <h3 class="accordion-heading mb-4">
                                            Critical Work Functions
                                        </h3>
                                        <!--end::Title-->

                                        <!--begin::Accordion-->


                                        <!--begin::Section-->
                                        <div class="mb-2">


                                            <!--end::Icon-->


                                            <!--end::Heading-->
                                            <div class="accordion accordion-icon-collapse" id="kt_accordion_3">
                                                <!--begin::Item-->
                                                @if ($selectedJob && $selectedJob?->criticalFunctions?->isNotEmpty())

                                                    @foreach ($selectedJob->criticalFunctions as $key3 => $value3)
                                                        <div class="mb-2">
                                                            <!--begin::Header-->
                                                            <div class="accordion-header collapsed p-6 d-flex accordion-border"
                                                                style="overflow-wrap: anywhere;"
                                                                data-bs-target="#kt_accordion_3_item_{{ $key3 }}">
                                                                <span class="accordion-icon">

                                                                    <iconify-icon icon="gravity-ui:circle-plus-fill"
                                                                        class="accordion-icon-off fs-3 me-3"
                                                                        style="color: #1AC2C2; font-size: 23px !important;"></iconify-icon>

                                                                    <iconify-icon icon="zondicons:minus-outline"
                                                                        class="accordion-icon-on fs-3 me-3"
                                                                        style="color: #1AC2C2; font-size: 20px !important;"></iconify-icon>
                                                                </span>
                                                                <h4 class="m-0 fw-medium fs-5"
                                                                    style="overflow-wrap: anywhere;">
                                                                    {{ $value3->description ?? '' }}</h4>
                                                            </div>
                                                            <!--end::Header-->

                                                            <!--begin::Body-->
                                                            <div id="kt_accordion_3_item_{{ $key3 }}"
                                                                class="fs-6 collapse ps-14 bg-open-accordion"
                                                                style="background: #E2F6F6;"
                                                                data-bs-parent="#kt_accordion_3">


                                                                @foreach ($value3->cwfKeys as $key)
                                                                    <div>{{ $key->name ?? '' }}
                                                                    </div>
                                                                @endforeach

                                                            </div>
                                                            <!--end::Body-->
                                                        </div>
                                                    @endforeach

                                                @endif

                                            </div>



                                            <!--begin::Separator-->
                                            {{-- <div class="separator separator-dashed"></div> --}}
                                            <!--end::Separator-->
                                        </div>
                                        <!--end::Section-->



                                        <!--end::Accordion-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <div class="mb-15 mt-15">
                                        <!--begin::Title-->
                                        <h3 class="accordion-heading mb-4">
                                            Generic Skills
                                        </h3>
                                        <!--end::Title-->

                                        <!--begin::Accordion-->


                                        @if ($selectedJob && $selectedJob?->skills?->isNotEmpty())
                                            <div class="accordion accordion-icon-collapse" id="kt_accordion_4">
                                                <!--begin::Item-->
                                                @foreach ($selectedJob->skills as $index => $skill)
                                                    <div class="mb-2">
                                                        <!--begin::Header-->
                                                        <div class="d-flex align-items-center justify-content-between accordion-header collapsed p-6 accordion-border"
                                                            data-bs-target="#kt_accordion_4_item_{{ $index }}"
                                                            aria-expanded="false">
                                                            <div class="cursor-pointer mb-0 w-100"
                                                                style="display: flex; align-items: center;">

                                                                <span class="accordion-icon">

                                                                    <iconify-icon icon="gravity-ui:circle-plus-fill"
                                                                        class="accordion-icon-off fs-3 me-3"
                                                                        style="color: #997BF2; font-size: 23px !important;"></iconify-icon>

                                                                    <iconify-icon icon="zondicons:minus-outline"
                                                                        class="accordion-icon-on fs-3 me-3"
                                                                        style="color: #997BF2; font-size: 20px !important;"></iconify-icon>
                                                                </span>
                                                                {{-- <h4 class="m-0 fw-medium fs-5" style="overflow-wrap: anywhere;">
                                                                    {{ $skill->title ?? 'NA' }}
                                                                </h4> --}}

                                                                <h4
                                                                    class="accordion-title d-flex align-items-center justify-content-between w-100 m-0 fw-medium fs-5">
                                                                    {{ $skill->title ?? 'NA' }}
                                                                    <span class="d-flex align-items-center">
                                                                        <iconify-icon class="star-technical"
                                                                            icon="material-symbols:star" width="16"
                                                                            height="16"
                                                                            style="color: #997BF2 !important;"></iconify-icon>
                                                                        {{-- {{ $skill->level }} --}}
                                                                        @php
                                                                            $levels = [
                                                                                1 => 'Basic',
                                                                                2 => 'Intermediate',
                                                                                3 => 'Advanced',
                                                                            ];
                                                                        @endphp
                                                                        {{ $levels[$skill->level] ?? 'Unknown' }}
                                                                    </span>
                                                                </h4>

                                                                {{-- <iconify-icon icon="vaadin:level-right" width="1.2rem" height="1.2rem"  style="color: black"></iconify-icon> --}}



                                                            </div>

                                                            {{-- <div class="cursor-pointer mb-0"
                                                                style="display: flex; align-items: center; color: #997BF2 !important;">
                                                                <iconify-icon icon="material-symbols-light:star"
                                                                    style="font-size: 20px;"></iconify-icon>
                                                                {{ $skill->level }}
                                                            </div> --}}
                                                        </div>
                                                        <!--end::Header-->

                                                        <!--begin::Body-->
                                                        <div id="kt_accordion_4_item_{{ $index }}"
                                                            class="fs-6 collapse ps-14 bg-open-accordion"
                                                            style="background: #F2EEFD;" data-bs-parent="#kt_accordion_4">


                                                            @foreach ($masterSkills as $key1 => $value1)
                                                                {{ $skill->title == $value1->name ? $value1->description : '' }}
                                                            @endforeach

                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                @endforeach



                                                <!--end::Accordion-->
                                            </div>
                                        @endif
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <div class="mb-15 mt-15">
                                            <h3 class="accordion-heading mb-4">
                                                Technical Skills

                                            </h3>
                                            @if ($selectedJob && $selectedJob?->technicalSkills?->isNotEmpty())
                                                <div class="accordion accordion-icon-collapse"
                                                    id="kt_accordion_technical">
                                                    @foreach ($selectedJob->technicalSkills as $index => $skill)
                                                        @php
                                                            $skillData = json_decode(json_encode($skill), true);
                                                            $level = $skill['pivot']['level'];
                                                            $knowledge =
                                                                $skillData['level_' . $level . '_knowledge'] ?? '';
                                                            $ability = $skillData['level_' . $level . '_ability'] ?? '';
                                                            $description =
                                                                $skillData['level_' . $level . '_description'] ?? '';
                                                        @endphp

                                                        <div class="mb-2 technical-accordion">
                                                            <div class="d-flex align-items-center justify-content-between accordion-header collapsed p-6 accordion-border"
                                                                data-bs-target="#kt_accordion_technical_item_{{ $index }}"
                                                                aria-expanded="false">
                                                                <span class="accordion-icon me-3">
                                                                    <iconify-icon icon="gravity-ui:circle-plus-fill"
                                                                        class="accordion-icon-off fs-3"
                                                                        style="color: #F7941D; font-size: 23px !important;"></iconify-icon>
                                                                    <iconify-icon icon="zondicons:minus-outline"
                                                                        class="accordion-icon-on fs-3"
                                                                        style="color: #F7941D; font-size: 20px !important;"></iconify-icon>
                                                                </span>
                                                                <h4
                                                                    class="accordion-title d-flex align-items-center justify-content-between w-100 m-0 fw-medium fs-5">
                                                                    {{ $skill['name'] ?? 'NA' }}
                                                                    <span class="d-flex align-items-center">
                                                                        <iconify-icon class="star-technical"
                                                                            icon="material-symbols:star" width="16"
                                                                            height="16"
                                                                            style="color: #F7941D !important;"></iconify-icon>
                                                                        {{ $level }}
                                                                    </span>
                                                                </h4>
                                                            </div>

                                                            <div id="kt_accordion_technical_item_{{ $index }}"
                                                                class="fs-6 collapse ps-14 bg-open-accordion"
                                                                data-bs-parent="#kt_accordion_technical"
                                                                style="background: #FFF6EA;">

                                                                @if (!empty($description))
                                                                    <p class="mb-6">{{ $description }}</p>
                                                                @endif

                                                                @if (!empty($knowledge))
                                                                    <div class="technical-inner mb-6">
                                                                        <h4 class="mb-4 fw-bolder">Knowledge</h4>
                                                                        @foreach (array_filter(explode(';', $knowledge)) as $item)
                                                                            <p
                                                                                class="mb-2 d-flex align-items-center gap-4">
                                                                                <iconify-icon
                                                                                    icon="simple-line-icons:check"
                                                                                    class="star-technical" width="20"
                                                                                    height="20"></iconify-icon>
                                                                                {{ trim($item) }}
                                                                            </p>
                                                                        @endforeach
                                                                    </div>
                                                                @endif

                                                                @if (!empty($ability))
                                                                    <div class="technical-inner">
                                                                        <h4 class="mb-4 fw-bolder">Ability</h4>
                                                                        @foreach (array_filter(explode(';', $ability)) as $item)
                                                                            <p
                                                                                class="mb-2 d-flex align-items-center gap-4">
                                                                                <iconify-icon
                                                                                    icon="simple-line-icons:check"
                                                                                    class="star-technical" width="20"
                                                                                    height="20"></iconify-icon>
                                                                                {{ trim($item) }}
                                                                            </p>
                                                                        @endforeach

                                                                    </div>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                    <!--end::Item-->


                                    @if ($selectedJob->org_department != null && $selectedJob->org_department > 0)
                                        <div class="mb-0">
                                            <!--begin::Title-->
                                            <h3 class="accordion-heading mb-4">
                                                {{-- Employees --}}
                                            </h3>
                                            <!--end::Title-->

                                            {{-- <form action="{{ route('job.employee.save') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="job_id" value="{{ $selectedJob->id }}">
                                                <input type="hidden" name="department"
                                                    value="{{ $selectedJob->org_department }}">

                                                <!--begin::Section-->
                                                <div class="m-0">
                                                    <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                                        <label for="employees" class="fw-semibold fs-6 mb-2">Select
                                                            Employees</label>
                                                        <select id="employees"
                                                            class="form-select form-select-solid mb-3 mb-lg-0"
                                                            data-employees='@json($selectedJob->employees->pluck('name', 'id')->toArray())'
                                                            data-control="select2" data-close-on-select="false"
                                                            name="employees[]" data-placeholder="Select Employees"
                                                            multiple>
                                                            <option value="" class="dark:bg-slate-700">Select
                                                                Employees</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div>
                                                    <button type="submit"
                                                        class="btn btn-sm fw-bold btn-success">Save</button>
                                                </div>
                                            </form> --}}
                                        </div>
                                    @endif


                                </div>
                                <!--end::Extended content-->
                        </div>
                    @else
                        <div class="alert alert-warning text-center">
                            <p class="mb-0">No Data Available</p>
                        </div>
                        @endif
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Layout-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::FAQ card-->
    </div>

    </div>


    {{-- Technical Skill Modal Start --}}
    <div class="modal bg-body fade" tabindex="-1" id="techskillmodal">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Communication</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">

                        <iconify-icon icon="line-md:close" class=" fs-2x"></iconify-icon>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="row g-5 modalbody">
                        <div class="col-lg-4">
                            <div class="card card-stretch card-bordered mb-5">
                                <div class="card-header">
                                    <h3 class="card-title">Level 1</h3>
                                </div>
                                <div class="card-body">
                                    Description Not Found
                                </div>
                                {{-- <div class="card-footer">
                            Footer
                        </div> --}}
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card card-stretch card-bordered mb-5">
                                <div class="card-header">
                                    <h3 class="card-title">Level 2</h3>
                                </div>
                                <div class="card-body">
                                    Description Not Found
                                </div>
                                {{-- <div class="card-footer">
                            Footer
                        </div> --}}
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="card card-stretch card-bordered mb-5">
                                <div class="card-header">
                                    <h3 class="card-title">Level 3</h3>
                                </div>
                                <div class="card-body">
                                    Description Not Found
                                </div>
                                {{-- <div class="card-footer">
                            Footer
                        </div> --}}
                            </div>

                        </div>
                    </div>
                </div>

                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-btn" data-bs-dismiss="modal"
                        onclick="updateTechSkillLevel(this)">Save changes</button>

                </div> --}}
            </div>
        </div>
    </div>
    {{-- Technical Skill Modal End --}}



@endsection
@section('styles')
    <style>
        .trimmed-description {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
    </style>

@endsection
@section('scripts')

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <script>
        function initializeAccordion(containerSelector) {
            console.log(`Initializing accordion for container: ${containerSelector}`);

            const container = document.querySelector(containerSelector);
            if (!container) {
                console.warn(`Accordion container ${containerSelector} not found.`);
                return;
            } else {
                console.log(`Accordion container found.`);
            }

            const headers = container.querySelectorAll('.accordion-header');
            console.log(`Found ${headers.length} accordion header(s) inside ${containerSelector}.`);

            headers.forEach((header, index) => {
                const targetId = header.getAttribute('data-bs-target');
                console.log(`Header ${index + 1}: data-bs-target is '${targetId}'.`);

                const collapseEl = document.querySelector(targetId);
                if (!collapseEl) {
                    console.warn(`Collapse element '${targetId}' not found for header ${index + 1}.`);
                    return;
                } else {
                    console.log(`Collapse element '${targetId}' found.`);
                }

                // Initialize aria-expanded and classes based on initial state
                if (collapseEl.classList.contains('show')) {
                    header.classList.add('open');
                    header.classList.remove('collapsed');
                    header.setAttribute('aria-expanded', 'true');
                    console.log(`Collapse element '${targetId}' is initially open.`);
                } else {
                    header.classList.remove('open');
                    header.classList.add('collapsed');
                    header.setAttribute('aria-expanded', 'false');
                    console.log(`Collapse element '${targetId}' is initially closed.`);
                }

                // Click event listener
                header.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log(`Header ${index + 1} clicked.`);

                    const isCurrentlyOpen = header.getAttribute('aria-expanded') === 'true';
                    console.log(`Header ${index + 1} is currently ${isCurrentlyOpen ? 'open' : 'closed'}.`);

                    let bsCollapse = bootstrap.Collapse.getInstance(collapseEl);
                    if (!bsCollapse) {
                        console.log(`Creating new Bootstrap collapse instance for '${targetId}'.`);
                        bsCollapse = new bootstrap.Collapse(collapseEl, {
                            parent: containerSelector,
                        });
                    } else {
                        console.log(`Using existing Bootstrap collapse instance for '${targetId}'.`);
                    }

                    if (isCurrentlyOpen) {
                        console.log(`Hiding collapse element '${targetId}'.`);
                        bsCollapse.hide();
                    } else {
                        console.log(`Showing collapse element '${targetId}'.`);
                        bsCollapse.show();
                    }
                });

                // Bootstrap collapse show event
                collapseEl.addEventListener('show.bs.collapse', () => {
                    console.log(`Collapse element '${targetId}' is showing.`);
                    header.classList.add('open');
                    header.classList.remove('collapsed');
                    header.setAttribute('aria-expanded', 'true');
                });

                // Bootstrap collapse hide event
                collapseEl.addEventListener('hide.bs.collapse', () => {
                    console.log(`Collapse element '${targetId}' is hiding.`);
                    header.classList.remove('open');
                    header.classList.add('collapsed');
                    header.setAttribute('aria-expanded', 'false');
                });

            });
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeAccordion('#kt_accordion_3');
            initializeAccordion('#kt_accordion_4');
            initializeAccordion('#kt_accordion_technical');
        });
    </script>


    <script>
        function showErrorAlert() {
            Swal.fire({
                title: 'No Jobs Available',
                text: 'This level has no jobs assigned.',
                icon: 'error',
                confirmButtonText: 'Okay'
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            var maxLength = 100; // maximum number of characters to show initially

            // Using event delegation
            $(document).on('click', '.view-more', function(event) {
                event.preventDefault();
                var $description = $(this).closest('.description');
                var $fullDescription = $description.find('.full-description');
                var $trimmedDescription = $description.find('.trimmed-description');

                $trimmedDescription.toggle();
                $fullDescription.toggle();

                $(this).text(function(_, text) {
                    return text === "View More" ? "View Less" : "View More";
                });
            });

            $('.description').each(function() {
                var $description = $(this);
                var $fullDescription = $description.find('.full-description');
                var $trimmedDescription = $description.find('.trimmed-description');

                var fullText = $fullDescription.text();
                var trimmedText = fullText.substring(0, maxLength).trim();

                $trimmedDescription.text(trimmedText + '...');
                $fullDescription.hide();
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $('#form-' + $(this).attr('custom1'));
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Are you sure you want to delete this job?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });

        $('.show_confirm_save').click(function(event) {
            var form = $('#ajax-form');
            event.preventDefault();
            swal({
                    title: `Are you sure you want to save this job?`,
                    text: "",
                    icon: "success",
                    buttons: true,
                    dangerMode: false,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });

        $('.show_confirm_remove').click(function(event) {
            var form = $('#ajax-form');
            event.preventDefault();
            swal({
                    title: `Are you sure you want to remove this job from saved list?`,
                    text: "",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>

    <script>
        function initSelect2(selector) {
            var $select = $(selector);

            var data = $select.data('employees');
            // Append the initial option if provided

            if (data) {
                Object.entries(data).forEach((element, index) => {
                    var option = new Option(element[1], element[0], true, true);
                    $select.append(option).trigger('change');
                });

            }

            // Initialize Select2 with AJAX support
            $select.select2({
                ajax: {
                    url: '{{ route('job.search') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data, params) {
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination.more
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Select Employess',
                minimumInputLength: 1
            });
        }
        // });

        $(document).ready(function() {
            // Assume these values are passed from the server

            initSelect2('#employees');
        });
    </script>


    <script>
        function TechSkillChanged(index, skillName) {
            console.log('technicalskill', skillName)
            $.ajax({
                url: '/admin/get-techskill-levels/' + skillName, // Adjust this URL as necessary
                type: 'GET',
                success: function(data) {
                    console.log('ajaz data', data);

                    let selectLevelButton = $(`#selectTechLevelButton${index}`);
                    if (data) {
                        // Find the "Select Level" button for this skill

                        selectLevelButton.show();


                        let TechSkillName = data[0].name;

                        // Update the onclick event with new data
                        // selectLevelButton.attr("onclick", `populateModal('${index}', '${data.skill_id}', '${skillName}', '${data.level_1}', '${data.level_2}', '${data.level_3}', '1')`);
                        selectLevelButton.attr("onclick",
                            `technicalpopulateModal('${index}', '${escapeSpecialCharacters(JSON.stringify(data[0]))}', '${TechSkillName}','1')`
                        );
                        // Assuming default to level 1 or use current selected level
                    } else {
                        selectLevelButton.hide();

                    }
                },
                error: function(error) {
                    console.error("Error fetching level descriptors for skill:", skillName, error);
                }
            });
        }



        function technicalpopulateModal(index, data, skillTitle, selected_level) {
            console.log('technicalpoopupmodal', data);

            data = JSON.parse(data);
            let modalBody = $('#techskillmodal .modalbody');
            modalBody.empty(); // Clear previous content

            $('#techskillmodal .modal-title').text(skillTitle);

            let selectedLevel = parseInt(selected_level, 10);

            for (let i = 1; i <= 6; i++) {
                let knowledge = data['level_' + i + '_knowledge'] || '';
                let ability = data['level_' + i + '_ability'] || '';
                let description = data['level_' + i + '_description'] || '';

                let isChecked = selectedLevel == i ? 'checked' : '';
                let activeClass = selectedLevel == i ? 'card-checked-orange' : '';
                let activeBoarderClass = selectedLevel == i ? 'border-check-orange' : '';
                let headerClass = selectedLevel == i ? 'header-checked-orange' : '';
                let titleClass = selectedLevel == i ? 'card-title-orange' : '';

                let backgroundStyle = knowledge.trim() === '' ? 'style="background: #f1f1f4 !important;"' : '';

                let bodyContent = '';
                if (knowledge.trim() !== '') {
                    bodyContent = `
                        <h5>${description}</h5>
                        <div class="p-3">
                            <h4>Knowledge</h4>
                            <div class="d-flex flex-column">
                                ${createListFromString(knowledge)}
                            </div>
                        </div>
                        <div class="p-3">
                            <h4>Ability</h4>
                            <div class="d-flex flex-column">
                                ${createListFromString(ability)}
                            </div>
                        </div>
                    `;
                }

                modalBody.append(`
                    <div class="form-check col-lg-4 pl-0">
                        <label class="form-check-label h-100 w-100" for="level_${i}">
                            <div class="col-lg-12 h-100">
                                <div class="card card-stretch card-bordered mb-5 h-100 ${activeBoarderClass}" ${backgroundStyle}>
                                    <div class="card-header align-items-center ${headerClass} ${activeClass}">
                                        <h3 class="card-title ${titleClass}">Level ${i}</h3>
                                        <iconify-icon icon="material-symbols:star-outline-rounded" width="24" height="24"></iconify-icon>
                                        <input class="form-check-input border-dark d-none" type="radio" value="${i-1}" id="level_${i}" name="level" ${isChecked} onclick="updateSelectedLevel(${i})">
                                    </div>
                                    <div class="card-body">
                                        ${bodyContent}
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                `);
            }

            $('#techskillmodal').modal('show');

            $('#techskillmodal .save-btn').data('skill-id', index);
        }

        function updateSelectedLevel(level) {
            $('.card').removeClass('border-check-orange'); // Remove all active classes
            $('.card-header').removeClass('card-checked-orange');
            $('.card-header').removeClass('header-checked-orange');
            $('.card-title').removeClass('card-title-orange');

            $('#level_' + level).closest('.card').addClass('border-check-orange');
            $('#level_' + level).closest('.card').find('.card-header').addClass('card-checked-orange');
            $('#level_' + level).closest('.card').find('.card-title').addClass('card-title-orange');
        }


        function escapeSpecialCharacters(string) {
            return string.replace(/\\/g, '\\\\') // Escaping backslashes
                .replace(/'/g, "\\'") // Escaping single quotes
                .replace(/"/g, '\\"') // Escaping double quotes
                .replace(/\n/g, '\\n') // Escaping newlines
                .replace(/\r/g, '\\r') // Escaping carriage returns
                .replace(/\t/g, '\\t'); // Escaping tabs
        }

        function createListFromString(str) {
            return str.split(';').filter(item => item.trim() !== '').map(item =>
                `<li class="d-flex py-2 gap-2"><iconify-icon icon="lets-icons:check-fill" width="18" height="18" class="check-icon-orange"></iconify-icon>${item.trim()}</li>`
                ).join(
                '');
        }

        function fetchLevel() {
            const currentUrl = window.location.href;

            // Create a URL object
            const urlObj = new URL(currentUrl);

            // Use URLSearchParams to get the level parameter
            const level = urlObj.searchParams.get("level");

            console.log(level, "levelFetched");
        }

        function handleTab(clickedTab) {
            clickedTab.classList.add('selectedTab');
        }


        function updateTechSkillLevel(button) {

            let skillId = $(button).data('skill-id');
            let selectedLevel = $('#techskillmodal .modal-body input:checked').val();

            // Debugging output
            console.log("Skill ID:", skillId);
            console.log("Selected Level:", selectedLevel);

            // Ensure the selector targets the correct select element
            let selectSelector = `select[name="technicalSkills[${skillId}][level]"]`;
            let selectElement = $(selectSelector);

            if (selectElement.length) {
                selectElement.val(selectedLevel);
                console.log("Select element found and value updated.");
            } else {
                console.error("Select element not found with selector:", selectSelector);
            }
        }
    </script>

    <script>
        function scrollContent(direction) {
            const scrollContainer = document.getElementById('scrollSection');
            const scrollAmount = 300; // Adjust scrolling amount (pixels)

            if (direction === 'left') {
                scrollContainer.scrollLeft -= scrollAmount;
            } else if (direction === 'right') {
                scrollContainer.scrollLeft += scrollAmount;
            }
        }
    </script>

@endsection
