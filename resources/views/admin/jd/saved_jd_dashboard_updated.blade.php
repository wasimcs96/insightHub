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

        .bg-orange {
            background: #F7951D !important;
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

        .text-title:hover {
            color: #F7951D;
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

        .accordion-border[aria-expanded="true"] {
            border-bottom: none !important;
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

        /* 🔥 Selected Card - Orange Background */
        .card-checked-orange {
            border: 2px solid #F7941D !important;
            background-color: #F7941D !important;
            /* Full Orange Background */
            color: #FFFFFF !important;
        }

        .border-check-orange {
            border: 2px solid #F7941D !important;
        }

        /* 🔥 Selected Header - Orange Background & White Text */
        .header-checked-orange {
            background: #F7941D !important;
            color: #ffffff !important;
        }


        /* 🔥 Change icon colors to white inside the selected card */
        .card-checked-orange .fa-check-circle {
            color: #FFFFFF !important;
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

        .btn-pending-custom {
            padding: 8px 16px;
            border-radius: 80px;
            background: #FFEBB4;
            color: #EB8100;
            font-size: 12px;
            font-weight: 700;
            border: 1px solid #FFEBB4;
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
        }

        .btn-outline-custom:hover {
            background-color: #F9A845;
            color: #fff;
        }

        .form-select {
            padding: 8px 12px;
            border-radius: 80px;
            border: 1px solid #99A1B7;
            color: #78829D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            width: 142px;
        }

        .filter-text {
            color: #78829D;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
        }

        .align-right {
            margin-left: auto;
        }
    </style>

    <style>
        .select-wrapper {
            position: relative;
        }

        .select-box {
            display: flex;
            width: 260px;
            height: 40px;
            padding: 0px 12px;
            align-items: center;
            border-radius: 4px;
            border: 1px solid #C4CADA;
            background: #FFF;
            color: #99A1B7;
            font-size: 12px;
            font-style: normal;
            font-weight: 400;
            line-height: 16px;
            justify-content: space-between;
        }

        .dropdown {
            position: absolute;
            top: 110%;
            left: 11px;
            right: 0;
            background: #fff;
            border: 1px solid #C4CADA;
            border-radius: 4px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            z-index: 99;
            display: none;
            max-height: 300px;
            overflow-y: auto;
            max-width: 260px;
        }

        .dropdown.show {
            display: block;
        }

        .checkbox-option {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding: 12px;
            margin: 0;
        }

        .checkbox-option input {
            margin-right: 8px;
        }

        .dropdown-footer {
            display: flex;
            padding-top: 10px;
            gap: 12px;
            justify-content: flex-end;
            position: sticky;
            bottom: -13px;
            background: #fff;
            padding-bottom: 10px;
        }

        .btn-reset,
        .btn-filter {
            border: none;
            border-radius: 4px;
            font-weight: 600;
            font-size: 12px;
            cursor: pointer;
            padding: 4px 20px;
        }

        .btn-reset {
            background: #fff;
            color: #5B5B5B;
        }

        .btn-filter {
            background: #F7941C;
            color: white;
        }

        .arrow {
            transform: rotate(0deg);
            transition: transform 0.3s ease;
        }

        .select-box.open .arrow {
            transform: rotate(180deg);
        }

        .jobdesc-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 1000;
            background: #fff;
            border-radius: 4px;
            border: 1px solid #DBDFE9;
            margin-top: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            overflow-y: auto;
            display: none;
            width: 202px;
        }

        .form-check:not(.form-switch) .form-check-input[type=checkbox] {
            background-size: 60% 60%;
        }

        .form-check-input:checked {
            background-color: #F7941C;
            border-color: #F7941C;
        }

        .technical-accordion .star-technical {
            color: #F7941D;
        }

        #kt_accordion_technical .accordion-header[aria-expanded="true"] h4,
        #kt_accordion_4 .accordion-header[aria-expanded="true"] h4,
        #kt_accordion_3 .accordion-header[aria-expanded="true"] h4 {
            font-weight: 700 !important;
        }

        #kt_accordion_technical .accordion-header[aria-expanded="true"] {
            background-color: #FFF6EA !important;
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

        .badge-hover iconify-icon {
            color: #F9A845;
        }

        .badge-hover:hover {
            background: #F9A845;
            color: #fff;
        }

        .badge-hover:hover iconify-icon {
            color: #fff;
        }

        .bg-custom-orange {
            background-color: #F7941C !important;
        }

        .modal-body p {
            color: #071437;
            font-size: 14px;
            font-weight: 400;
            line-height: 22px;
            margin-bottom: 24px;
        }

        .close-icon {
            position: absolute;
            right: 16px;
            top: 16px;
            color: #99A1B7;
            cursor: pointer;
        }

        .icon-orange {
  color: #F7941C;
}
    .dropdown-menu.show {
        transform: translate3d(1063px, 205.5px, 0px) !important;
        width: 11%;
        border: 1px solid #D9D9D9;
        /* padding: 8px; */
        z-index: 10;
        position: absolute;
        width: 164px;
        border-radius: 8px;
        border: 1px solid #D9D9D9;
        box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        padding: 8px;
        top: 10px !important;

    }

    .dropdown-item {
        display: flex;
        padding: 12px 16px;
        align-items: flex-start;
        gap: 4px;
        border-radius: 8px;
        color: #1E1E1E;
        font-size: 12px;
        font-style: normal;
        font-weight: 400;
        line-height: 16px;
    }

    .jd-download {
    position: relative; 
    display: inline-block;
}

.dropdown-menu-custom {
    position: absolute;
    top: 45px !important;
    left: 0;
    min-width: 160px;
    background: #fff;
    border: 1px solid #D9D9D9;
    border-radius: 8px;
    box-shadow: 0px 3px 4px 0px rgba(0,0,0,0.03);
    z-index: 98;
    display: none;
    padding: 8px;
    opacity: 0;
    transform: translate3d(0, 20px, 0);
    transition: opacity 0.2s ease, transform 0.2s cubic-bezier(0.4,0,0.2,1);
    display: flex; 
    will-change: transform;
    animation: menu-sub-dropdown-animation-fade-in 0.3s ease, menu-sub-dropdown-animation-move-up 0.3s ease;
}

.dropdown-menu-custom.show,
.dropdown-menu-custom[style*="display: block"] {
    display: block !important;
    opacity: 1;
    transform: translate3d(0, 0, 0);
}

.dropdown-item:focus,
.dropdown-item:hover {
    color: #1E1E1E;
    background-color: #FFF6EA;
    border-radius: 8px;
}

.btn-outline-custom.active,
.btn-outline-custom:active,
.btn-outline-custom:focus {
    background-color: #F9A845 !important;
    color: #fff !important;
    border-color: #F7941C !important;
}

.text-truncate {
    word-break: break-word;
}
</style>

@endsection


@section('content')


    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack container-xxl">


            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
                class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->

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
                        } catch (e) {
                        }

                    @endphp
                    @if (request('department'))
                        {{ $title }}
                    @else
                        Job Descriptions
                    @endif
                </h1>
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

                    {{-- <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        JD Master List </li>
                    <!--end::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item--> --}}

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('jobs.savedJobs', ['saved_job' => 1]) }}" class="text-muted text-hover-primary">
                            Company JDs
                        </a>
                    </li>

                    @if (request('org_department'))
                        @php
                            $name = '';
                            $headOfDivision = '';
                            $jobFamilyGroupId = '';
                            $department = \App\Models\Department::with('division')
                                ->where('id', request('org_department'))
                                ->first();

                            if ($department) {
                                $name = $department->name;
                                $headOfDivision = optional($department->division)->head_of_division;
                                $jobFamilyGroupId = optional($department->division)->id; // Assuming division ID == job_family_group_id
                            }
                        @endphp

                        @if ($headOfDivision && $jobFamilyGroupId)
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ url('/admin/jobs/index?job_family_group_id=' . $jobFamilyGroupId) }}" class="text-muted text-hover-primary">
                                    {{ $headOfDivision }}
                                </a>
                            </li>
                        @endif
                    @endif





                    @if (request('org_department'))
                        @php
                            $name = '';
                            $department_name = \App\Models\Department::where('id', request('org_department'))->first();
                            if ($department_name) {
                                $name = $department_name->name;
                            }
                        @endphp

                        @if ($name != '')
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                {{-- <a href="#" class="text-muted text-hover-primary"> --}}
                                    {{ $name ?? '-' }}
                                {{-- </a> --}}
                            </li>
                        @endif

                    @endif
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Action group-->
            {{-- <!--begin::Toolbar end-->
            @php
                $roleId = auth()->user()->role_id ?? null;
            @endphp

            @if ($roleId !== 7)
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Secondary button-->
                    <!--end::Secondary button-->
                    <a href="{{ route('jobs.index', ['saved_job' => 0]) }}" class="btn btn-sm fw-bold btn-primary">
                        JD Master List
                    </a>
                    <a href="{{ route('jobs.savedJobs', ['saved_job' => 1]) }}" class="btn btn-sm fw-bold btn-primary">
                        Company JDs
                    </a>
                    <!--begin::Primary button-->
                    <a href="{{ route('jobs.create') }}" class="btn btn-sm fw-bold btn-primary">
                        Create
                    </a>
                    <!--end::Primary button-->
                </div>
            @endif --}}

            <!--end::Toolbar end-->
            <!--end::Action group-->
        </div>
        <!--end::Toolbar container-->
    </div>


    <div id="kt_app_content" class="app-content  flex-column-fluid ">



        <div id="kt_app_content_container" class="app-container">

            @if (session('alert'))
                <x-alert :type="session('alert.type')" :message="session('alert.message')" />
            @endif
            <div class="scroll-container">
                <!-- Left Arrow -->
                <button class="scroll-arrow left-arrow" onclick="scrollContent('left')">
                    <iconify-icon icon="ic:baseline-arrow-back" width="20" height="20"
                        style="top: 2px;position: relative;"></iconify-icon>
                </button>

                <!-- Scrollable Content -->
                <div class="row gx-6 gx-xl-9 behave-scroll" id="scrollSection">
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
                        <!--end::Statistics Widget 5 12.6%-->
                    </div>
                @endforeach --}}
                    @foreach ($data as $key8 => $level)
                        <div class="col-xl-2" style="width: 12.6% !important;">
                            @php
                                $currentUrlParams = request()->query();
                                $currentUrlParams['level'] = $key8;
                                $isDisabled = $level['count'] == 0;
                            @endphp

                            <a href="{{ $isDisabled ? 'javascript:void(0);' : route('admin.saved.jobdescriptions', $currentUrlParams) }}"
                                class="card card-xl-stretch mb-xl-8 bg-active-orange bg-grey"
                                @if (request('level') == $key8) style="background: #F7951D; !important" @endif
                                @if ($isDisabled) onclick="showErrorAlert();" @endif>
                                <iconify-icon icon="carbon:skill-level" width="32" height="32"
                                    style="width: 32px; height: 32px;"></iconify-icon>
                                <div class="text-title">
                                    {{ $level['title'] ?? '' }}
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
                    <iconify-icon icon="ic:baseline-arrow-forward" width="20" height="20"
                        style="top: 2px;position: relative;"></iconify-icon>
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
                                    <div class="mb-7 d-flex align-items-center gap-4">
                                        <p class="filter-text mb-0">Filter</p>
                                        {{-- <select class="form-select" name="status">
                                            <option value="">All Status </option>
                                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Approved
                                                ({{ $approvedJdCount ?? 0 }})</option>
                                            <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Pending
                                                ({{ $pendingJdCount ?? 0 }})</option>
                                        </select> --}}
                                        @php
                                            $status = request('status');
                                            $statusText =
                                                $status === '1'
                                                    ? 'Approved'
                                                    : ($status === '2'
                                                        ? 'Pending'
                                                        : 'All Status');
                                        @endphp

                                        <div class="select-wrapper jobdesc-wrapper">
                                            <div class="form-select jobdesc-select" onclick="toggleJobdescDropdown(this)">
                                                {{ $statusText }}
                                            </div>
                                            <div class="dropdown jobdesc-dropdown">
                                                <div class="options-list">
                                                    <label class="checkbox-option">
                                                        <input type="checkbox" name="status" value="1"
                                                            onclick="handleSingleCheckbox(this)"
                                                            {{ request('status') == '1' ? 'checked' : '' }}>
                                                        Approved
                                                    </label>
                                                    <label class="checkbox-option">
                                                        <input type="checkbox" name="status" value="2"
                                                            onclick="handleSingleCheckbox(this)"
                                                            {{ request('status') == '2' ? 'checked' : '' }}>
                                                        Pending
                                                    </label>
                                                </div>
                                                <div class="dropdown-footer px-3 py-2 text-end">
                                                    <button class="btn-reset me-2"
                                                        onclick="resetJobdescDropdown(this)">Reset</button>
                                                    {{-- <form method="GET"> --}}
                                                    {{-- <input type="hidden" name="status" id="statusInput" value="{{ request('status') }}"> --}}
                                                    <button type="submit" class="btn-filter">Filter</button>
                                                    {{-- </form> --}}
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="d-flex">
                                        <input type="text" class="form-control" placeholder="Search for jobs..."
                                            name="search" value="{{ request('search') }}" />

                                        <input type="hidden" name="department" value="{{ request('department') }}" />
                                        <input type="hidden" name="org_department"
                                            value="{{ request('org_department') }}" />
                                        <input type="hidden" name="saved_job" value="{{ request('saved_job') }}" />

                                        <button type="submit"
                                            class="btn btn-primary mx-1 d-flex justify-content-center align-items-center"
                                            data-kt-menu-dismiss="true">
                                            <iconify-icon icon="mingcute:search-3-line" class="fa-1-5"
                                                style="color: black"></iconify-icon>
                                        </button>

                                        @php
                                            $specificUrlParams = [
                                                'department' => request('department'),
                                                'saved_job' => request('saved_job'),
                                                'org_department' => request('org_department'),
                                            ];
                                        @endphp

                                        <a href="{{ route('admin.saved.jobdescriptions', $specificUrlParams) }}"
                                            class="btn btn-sm btn-light btn-active-light-primary me-2 mx-1 d-flex justify-content-center align-items-center"
                                            data-kt-menu-dismiss="true">
                                            <iconify-icon icon="system-uicons:reset-alt" class="fa-2x"
                                                style="color: black"></iconify-icon>
                                        </a>
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

                                    @foreach ($jobs as $key => $job)
                                        @php
                                            $currentUrlParams = request()->query(); // Get current query parameters
                                            $currentUrlParams['selected_job'] = $job->id; // Set or replace the 'level' parameter
                                            $currentUrlParams['search'] = request('search'); // Set or replace the 'level' parameter

                                        @endphp

                                        <!--begin::Item-->
                                        <div class="menu-item" style="overflow-wrap: anywhere;">
                                            <!--begin::Link-->
                                            <a href="{{ route('admin.saved.jobdescriptions', $currentUrlParams) }}"
                                                class="menu-link py-3 {{ request('selected_job') == $job->id ? 'active' : ($key == 0 && !request('selected_job') ? 'active' : '') }}">
                                                {{ $job->title ?? 'NA' }}
                                            </a>
                                            <!--end::Link-->
                                        </div>
                                        <!--end::Item-->
                                    @endforeach

                                </div>
                                <!--end::Menu-->
                            </div>
                            <!--end::Catigories-->







                        </div>
                        <!--end::Sidebar-->

                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid">
                            {{-- @if ($selectedJob && isset($selectedJob)) --}}
                            @if (!empty($selectedJob) && $selectedJob->id)



                                <!--begin::Extended content-->
                                <div class="mb-13">
                                    <!--begin::Content-->
                                    <div class="mb-15">
                                        <!--begin::Title-->
                                        <div class="d-flex gap-3 align-items-center flex-wrap">
                                            <span class="badge-orange"><strong>Department:
                                                </strong>{{ $selectedJob->OrgDepartment->name ?? '' }}</span>
                                            <span class="badge-orange"> <strong>Headcount:
                                                </strong>{{ $selectedJob->headcounts()->count() ?? 0 }}</span>
                                            @if (!empty($employeesCount) && $employeesCount > 0)
                                                <span class="badge-orange cursor-pointer badge-hover"
                                                    id="employeeModal"><strong>Employees:</strong>{{ $employeesCount ?? 0 }}

                                                    <span style="position: relative; top: 2px;"><iconify-icon
                                                            icon="cuida:open-in-new-tab-outline" width="12"
                                                            height="12"></iconify-icon></span>
                                                </span>
                                            @else
                                                <span
                                                    class="badge-orange"><strong>Employees:</strong>{{ $employeesCount ?? 0 }}

                                                </span>
                                            @endif
                                            <span class="badge-orange bg-white d-flex gap-4 align-items-center p-0 align-right">
                                            <div class="jd-download">
                                                <button 
                                                id="download-jd-btn"
                                                class="btn-outline-custom"
                                                >
                                                <iconify-icon icon="material-symbols:download-rounded" width="16" height="16"></iconify-icon>
                                                Download PDF
                                                <iconify-icon icon="iconamoon:arrow-down-2" width="16" height="16"></iconify-icon>
                                                </button>

                                                <!-- Dropdown menu -->
                                                <div id="dropdown-menu" class="dropdown-menu-custom" style="display: none;">
                                                    <a 
                                                        class="dropdown-item"
                                                        href="{{ route('export.jd.external', ['id' => $selectedJob->id ?? 0]) }}"
                                                        target="_blank"
                                                    >
                                                        External Version
                                                    </a>
                                                    <a 
                                                        class="dropdown-item"
                                                        href="{{ route('export.jd.internal', ['id' => $selectedJob->id ?? 0]) }}"
                                                        target="_blank"
                                                    >
                                                        Internal Version
                                                    </a>
                                            </div>
                                            </div>
                                            </span>


                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex flex-wrap gap-4 align-items-center"
                                                style="margin: 18px 0px 19.5px 0px;">
                                                <h4 class="fs-2x text-gray-800 w-bolder m-0" style="overflow-wrap: anywhere;">
                                                    @if ($selectedJob->job_type == 'ai')
                                                        <iconify-icon
                                                            style="
                                                     color: #f7941d;
                                                 "
                                                            icon="eos-icons:ai" width="24" height="24"
                                                            class="fa-1-5"></iconify-icon>
                                                    @endif {{ $selectedJob->title ?? 'NA' }}

                                                </h4>
                                                @if ($selectedJob->is_primary == '0')
                                                    {{-- @if ($selectedJob->job_type == 'ai_gen') --}}
                                                    @if (in_array($selectedJob->job_type, ['ai_gen', 'master_gen', 'company_gen', 'custom_gen']))
                                                        {{-- <a href="{{ route('llm.edit', $selectedJob->id) }}"
                                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mx-2">
                                                                <iconify-icon icon="heroicons:pencil-square"
                                                                    class="fa-1-5"></iconify-icon>
                                                            </a> --}}
                                                        <button
                                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm open-edit-modal"
                                                            style="height: 35px;" data-id="{{ $selectedJob->id }}"
                                                            data-title="{{ $selectedJob->title }}"
                                                            data-route="{{ route('llm.edit', $selectedJob->id) }}">
                                                            <iconify-icon icon="heroicons:pencil-square"
                                                                class="fa-1-5"></iconify-icon>
                                                        </button>
                                                    @else
                                                        {{-- href="{{ route('jobs.edit', $selectedJob->id) }}" --}}
                                                        {{-- <a href="{{ route('llm.edit', $selectedJob->id) }}"
                                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mx-2">
                                                                <iconify-icon icon="heroicons:pencil-square"
                                                                    class="fa-1-5"></iconify-icon>
                                                            </a> --}}
                                                        <button
                                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm open-edit-modal"
                                                            style="height: 35px;" data-id="{{ $selectedJob->id }}"
                                                            data-title="{{ $selectedJob->title }}"
                                                            data-route="{{ route('llm.edit', $selectedJob->id) }}">
                                                            <iconify-icon icon="heroicons:pencil-square"
                                                                class="fa-1-5"></iconify-icon>
                                                        </button>
                                                    @endif


                                                    {{-- <div class="ml-3  mt-4">
                                                        <form action="{{ route('jobs.destroy', $selectedJob->id) }}"
                                                            id="form-{{ $selectedJob->id }}" class="btn btn-icon "
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" custom1="{{ $selectedJob->id }}"
                                                                class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm mb-1 show_confirm">
                                                                <iconify-icon icon="heroicons:trash"
                                                                    class="fa-1-5"></iconify-icon>
                                                            </button>
                                                        </form>
                                                    </div> --}}

                                       
                                                     @if ((!empty($employeesCount) && $employeesCount > 0) || (isset($selectedJob->children) && $selectedJob->children->isNotEmpty()))
                                                    <button type="button"
                                                            class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm existing_employee_delete_modal"
                                                            style="height: 35px;">
                                                            <iconify-icon icon="heroicons:trash"
                                                                class="fa-1-5"></iconify-icon>
                                                        </button>
                                                    @else
                                                    <form action="{{ route('jobs.destroy', $selectedJob->id) }}"
                                                        id="form-{{ $selectedJob->id }}" method="POST"
                                                        class="delete-job-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm show_delete_modal"
                                                            style="height: 35px;" data-id="{{ $selectedJob->id }}"
                                                            data-title="{{ $selectedJob->title }}">
                                                            <iconify-icon icon="heroicons:trash"
                                                                class="fa-1-5"></iconify-icon>
                                                        </button>
                                                    </form>
                                                    @endif

                                                    <span
                                                        class="badge-orange bg-white d-flex gap-4 d-flex gap-4 align-items-center p-0">
                                                        @if ($selectedJob->status == 1)
                                                            <span
                                                                class="align-items-center badge-orange bg-success d-flex gap-4 text-light">
                                                                Approved
                                                            </span>
                                                        @elseif ($selectedJob->status == 2)
                                                            <button type="button" custom1="{{ $selectedJob->id }}"
                                                                class="btn-pending-custom">
                                                                Pending
                                                            </button>

                                                            <button id="approve-jd-btn" class="btn-outline-custom">
                                                                Approve this JD
                                                                <iconify-icon icon="material-symbols:check-rounded"
                                                                    width="16" height="16"></iconify-icon>
                                                            </button>
                                                        @endif
                                                    </span>

                                                @endif

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

                                            <!-- Job Profile ID -->
                                            <div class="form-control bg-white h-100">
                                                <label class="form-label text-muted small">Position Code</label>
                                                <div class="fw-semibold">
                                                    {{ $selectedJob->jobProfile->aa_job_profile_id ?? '' }}
                                                </div>
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
                                                @foreach ($selectedJob->criticalFunctions as $key3 => $value3)
                                                    <div class="mb-2">
                                                        <!--begin::Header-->
                                                        <div class="accordion-header collapsed p-6 d-flex accordion-border"
                                                            data-bs-target="#kt_accordion_3_item_{{ $key3 }}">
                                                            <span class="accordion-icon">

                                                                <iconify-icon icon="gravity-ui:circle-plus-fill"
                                                                    class="accordion-icon-off fs-3 me-3"
                                                                    style="color: #1AC2C2; font-size: 23px !important;"></iconify-icon>

                                                                <iconify-icon icon="zondicons:minus-outline"
                                                                    class="accordion-icon-on fs-3 me-3"
                                                                    style="color: #1AC2C2; font-size: 20px !important;"></iconify-icon>
                                                            </span>
                                                            <h4 class="m-0 fw-medium fs-5" style="overflow-wrap: anywhere;">
                                                                {{ $value3->description ?? '' }}</h4>
                                                        </div>
                                                        <!--end::Header-->

                                                        <!--begin::Body-->
                                                        <div id="kt_accordion_3_item_{{ $key3 }}"
                                                            class="fs-6 collapse ps-14 bg-open-accordion"
                                                            style="background: #E2F6F6;" data-bs-parent="#kt_accordion_3">


                                                            @foreach ($value3->cwfKeys as $key)
                                                                <div>{{ $key->name ?? '' }}
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                @endforeach

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




                                        <div class="mb-2">


                                            <!--end::Icon-->


                                            <!--end::Heading-->
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

                                            </div>



                                            <!--begin::Separator-->
                                            {{-- <div class="separator separator-dashed"></div> --}}
                                            <!--end::Separator-->
                                        </div>
                                        <!--end::Section-->



                                        <!--begin::Item-->
                                        <div class="mb-15 mt-15">
                                            <h3 class="accordion-heading mb-4">
                                                Technical Skills

                                            </h3>
                                            <div class="accordion accordion-icon-collapse" id="kt_accordion_technical">
                                                @foreach ($selectedJob->technicalSkills as $index => $skill)
                                                    @php
                                                        $skillData = json_decode(json_encode($skill), true);
                                                        $level = $skill['pivot']['level'];
                                                        $knowledge = $skillData['level_' . $level . '_knowledge'] ?? '';
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
                                                            {{-- @php
                                                                $skillName = $skill['name'] ?? 'NA';
                                                                $sectorName = $skill['sector_name'] ?? '';
                                                                $categoryTitle = $skill['category']['title'] ?? '';

                                                                // Agar sector aur category available hain tabhi bracket lagana
                                                                if (!empty($sectorName) && !empty($categoryTitle)) {
                                                                    // Existing bracket ko remove karna
                                                                    $skillName = preg_replace('/\s*\(.*?\)\s*/', '', $skillName);
                                                                    // Naya bracket append karna
                                                                    $skillName .= " ({$sectorName}-{$categoryTitle})";
                                                                }
                                                            @endphp --}}
                                                            @php
                                                                $skillName = $skill['name'] ?? 'NA';
                                                                // $sectorName = $skill['sector_name'] ?? '';
                                                                $sectorName = $skill['sector']['name'] ?? '';
                                                                $categoryTitle = $skill['category']['title'] ?? '';

                                                                
                                                                if (!empty($sectorName) && !empty($categoryTitle)) {
                                                                    $skillName = preg_replace('/\s*\((?=[^()]*-)[^()]*\)\s*$/u', '', $skillName);

                                                                    $skillName .= " ({$sectorName}-{$categoryTitle})";
                                                                }
                                                            @endphp

                                                            <h4
                                                                class="accordion-title d-flex align-items-center justify-content-between w-100 m-0 fw-medium fs-5">
                                                                {{ $skillName }}
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
                                                                        <p class="mb-2 d-flex align-items-center gap-4">
                                                                            <iconify-icon icon="simple-line-icons:check"
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
                                                                        <p class="mb-2 d-flex align-items-center gap-4">
                                                                            <iconify-icon icon="simple-line-icons:check"
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

                                        </div>
                                        @if ($selectedJob->org_department != null && $selectedJob->org_department > 0)
                                            <div class="mb-2">
                                                <!--begin::Title-->
                                                <h3 class="accordion-heading mb-4">
                                                    {{-- Employees --}}
                                                </h3>

                                            </div>
                                        @endif


                                    </div>
                                    <!--end::Extended content-->
                                </div>
                                @else
                                <div class="d-flex flex-column align-items-center justify-content-center text-center p-10" 
                                    style="min-height:400px; background:#f9f9f9; border-radius:12px;">
                                    <p class="mb-5">
                                        No job positions have been localised for this department yet.<br>
                                        Go to the Job Management module and click 'Create New JD' to localise job positions.
                                    </p>
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

    <div class="modal fade" id="EditJDModal" tabindex="-1" aria-labelledby="EditJDLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-medium" id="EditJDPositionLabel">
                        Edit JD - <span id="jobTitle">Job Title</span>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-4" id="modalDescription">
                        Loading...
                    </p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="understandCheckbox">
                        <label for="understandCheckbox">
                            I understand that modifying this JD will affect assigned employees.
                        </label>
                    </div>
                    <div class="d-flex justify-content-center align-items-center gap-4 mt-5">
                        <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                        {{-- <button id="confirmEditBtn" class="btn btn-apply text-white d-flex align-items-center gap-2"
                            style="background: #F7941C;" disabled>
                            Confirm & Proceed 
                            <span id="infoIconWrapper" style="cursor: pointer;">
                                <iconify-icon icon="material-symbols:info-outline-rounded" width="16" height="16"></iconify-icon>
                            </span>
                        </button> --}}

                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <button id="confirmEditBtn" class="btn btn-apply text-white d-flex align-items-center gap-2"
                                style="background: #F7941C;" disabled>
                                Confirm & Proceed
                            </button>

                            <!-- Icon outside the disabled button -->
                            {{-- <span id="infoIconWrapper" style="cursor: pointer;" title="Please acknowledge the impact by checking the box above to proceed.">
                                <iconify-icon icon="material-symbols:info-outline-rounded" width="18" height="18"></iconify-icon>
                            </span> --}}
                        </div>

                        {{-- <div id="editTooltip" 
                            style="display:none; position:absolute; background:#fff3cd; border:1px solid #f5c2c7; padding:10px; border-radius:5px; color:#664d03; z-index:9999;">
                            Please acknowledge the impact by checking the box above to proceed.
                        </div> --}}


                    </div>
                </div>
            </div>
        </div>
    </div>





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
                header.addEventListener('click', function (e) {
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

                // ✅ Apply your custom class styles correctly
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
                    <div class="form-check col-lg-4">
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

            // Set skill ID on save button for later use
            $('#techskillmodal .save-btn').data('skill-id', index);
        }

        // ✅ Function to dynamically change selected card styling
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

    <script>
        let selectedEditRoute = '';
        let selectedJobId = null;

        $(document).on('click', '.open-edit-modal', function() {
            selectedJobId = $(this).data('id');
            selectedEditRoute = $(this).data('route');
            const jobTitle = $(this).data('title');

            // Update modal title
            $('#jobTitle')
        .text(jobTitle)
        .css("overflow-wrap", "anywhere");

            // Reset checkbox and button state
            $('#understandCheckbox').prop('checked', false);
            $('#confirmEditBtn').prop('disabled', true);

            // Show modal
            $('#EditJDModal').modal('show');

            // Fetch employee count
            const employeeCountUrl = "{{ route('admin.savedDescriptions.employeeCount', ':id') }}".replace(':id',
                selectedJobId);
            $.ajax({
                url: employeeCountUrl,
                method: 'GET',
                success: function(response) {
                    const count = response.count ?? 0;
                    const desc = `
                Editing this job description, <strong style="overflow-wrap: anywhere;">${jobTitle}</strong> will impact 
                <strong>${count} employee${count !== 1 ? 's' : ''}</strong> currently assigned to it. 
                Any changes made will be reflected in their records and may affect role alignment, skill matching, and internal processes.<br><br>
                Additionally, any subordinates under this role will also be affected. Any changes made will be 
                reflected in their records and may affect role alignment, skill matching, and internal processes.<br><br>
                Please review your edits carefully before proceeding.`;

                    $('#modalDescription').html(desc);
                },
                error: function() {
                    $('#modalDescription').html('Unable to fetch employee count at the moment.');
                }
            });
        });

        // Enable confirm button when checkbox is checked
        $('#understandCheckbox').on('change', function() {
            $('#confirmEditBtn').prop('disabled', !this.checked);
        });

        // Redirect on confirm
        $('#confirmEditBtn').on('click', function() {
            if (selectedEditRoute) {
                window.location.href = selectedEditRoute;
            }
        });
    </script>

    <script>
        $(document).on('click', '.show_delete_modal', function() {
            ModalManager.open({
                module: 'jobs',
                key: "delete_jd",
                data: {
                    job_title:"{{ $selectedJob->title ?? '' }}"
                },
                onSubmit(modalEl1) {

                   $('#form-{{ $selectedJob->id ?? ''}}').submit();

                }
            })


        });
    </script>

     <script>
        $(document).on('click', '.existing_employee_delete_modal', function() {
            ModalManager.open({
                module: 'jobs',
                key: "delete_jd_employee_exist",
                data: {
                    job_title:"{{ $selectedJob->title ?? '' }}",
                    employee_count:"{{$employeesCount ?? 0 }}",

                },
                onSubmit(modalEl1) {

                   

                }
            })


        });
    </script>

    <script>
        function toggleJobdescDropdown(button) {
            const wrapper = button.closest('.jobdesc-wrapper');
            wrapper.querySelector('.jobdesc-dropdown').classList.toggle('show');
        }

        function handleSingleCheckbox(clickedBox) {
            const checkboxes = clickedBox.closest('.options-list').querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(box => {
                if (box !== clickedBox) box.checked = false;
            });

            const wrapper = clickedBox.closest('.jobdesc-wrapper');
            const statusInput = wrapper.querySelector('#statusInput');
            statusInput.value = clickedBox.checked ? clickedBox.value : '';
        }

        function applyJobdescFilter(button) {
            const wrapper = button.closest('.jobdesc-wrapper');
            const selected = wrapper.querySelector('input[type="checkbox"]:checked');
            const display = wrapper.querySelector('.jobdesc-select');
            const statusInput = wrapper.querySelector('#statusInput');

            if (selected) {
                display.textContent = selected.value === '1' ? 'Approved' : 'Pending';
                statusInput.value = selected.value;
            } else {
                display.textContent = 'All Status';
                statusInput.value = '';
            }

            wrapper.querySelector('.jobdesc-dropdown').classList.remove('show');
        }

        function resetJobdescDropdown(button) {
            const wrapper = button.closest('.jobdesc-wrapper');
            const checkboxes = wrapper.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(box => box.checked = false);

            wrapper.querySelector('.jobdesc-select').textContent = 'All Status';
            wrapper.querySelector('#statusInput').value = '';
            wrapper.querySelector('.jobdesc-dropdown').classList.remove('show');
        }
    </script>

    <script>
        $(document).ready(function() {

            $(document).on('click', '#employeeModal', function(event) {
                showOverlay();
                url = '/admin/ajax/job-headcounts/data/' + @json($selectedJob->id ?? '');
                fetch(url, {
                        method: 'get',
                    })
                    .then(res => res.json())
                    .then(response => {
                        console.log('responseeeeeeeeeeeeeeee', response);

                        ModalManager.open({
                            module: 'jobs',
                            key: "job_headcount_list",
                            data: {
                                employeeList: response,
                                job_title: '{{ $selectedJob->title ?? '' }}',
                                updated_at: '{{ App\Helpers\DateFormatHelper::formatDate($selectedJob->updated_at ?? '') }}'
                            },
                            onSubmit(modalEl) {
                                showOverlay();

                            },
                            onShown(modalEl) {
                                const tableBody = modalEl.querySelector('#employee-table-body');

                                let html = '';

                                response.forEach(item => {
                                    employee = item.user ?? null;
                                    console.log('emppp', employee);
                                    if (employee) {
                                        html += `
                                        <tr>
                                            <td>${employee.name ?? ''}</td>
                                            <td>${item.headcount_code ?? '-'}</td>
                                            <td>${employee.email ?? '-'}</td>
                                            <td>${employee.date_of_hire ?? '-'}</td>
                                            <td><a href="/admin/employee-details/${employee.id ?? ''}" class="btn eye-checked"><iconify-icon icon="bi:eye" class="eye-icon" width="16" height="16"></iconify-icon></a></td>
                                        </tr>
                                    `;
                                    }
                                });
                                if (tableBody) {
                                    tableBody.innerHTML = html;
                                }
                                hideOverlay();
                            }
                        })


                    })
                    .catch(error => {
                        console.error('Error:', error);
                        hideOverlay();
                    });
                console.log('ddddddddd');

            });

            $(document).on('click', '#approve-jd-btn', function(event) {
                ModalManager.open({
                    module: 'jobs',
                    key: "approve_jd",
                    data: {
                        job_id: 4870,
                        job_title: "{{ $selectedJob ? $selectedJob->title : '-' }}",
                        level: 1,
                        superior: 0,
                        is_top_position: "1",
                        type: ""
                    },
                    onSubmit(modalEl1) {

                        window.location.href =
                            `/admin/saved-jobdescriptions/update-status/` +
                            @json($selectedJob->id ?? '');
                    }
                })
            });

        });
    </script>

    <script>
        document.addEventListener('click', function(event) {
  if (
    event.target.classList.contains('eye-icon') &&
    event.target.closest('.eye-checked')
  ) {
    event.target.classList.add('icon-orange');
  }
});

    </script>
    {{-- Download PDF Scripts --}}
    {{-- <script>
document.addEventListener('DOMContentLoaded', function() {
    const button = document.getElementById('download-jd-btn');
    if (button) {
        button.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent bubbling to document
            toggleDropdown();
        });
    }
});

function toggleDropdown() {
    const dropdown = document.getElementById('dropdown-menu');
    const button = document.getElementById('download-jd-btn');
    const isOpen = dropdown.classList.contains('show');

    if (isOpen) {
        dropdown.classList.remove('show');
        button.classList.remove('active');
    } else {
        dropdown.classList.add('show');
        button.classList.add('active');
    }
    // Remove focus from the button to prevent :focus styling
    button.blur();
}

    </script>
    <script>
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('dropdown-menu');
    const button = document.getElementById('download-jd-btn');
    // Check if click is outside both the button (and its children) and the dropdown
    if (
        !button.contains(event.target) && // not the button or its children
        !dropdown.contains(event.target)   // not the dropdown or its children
    ) {
        dropdown.classList.remove('show');
        button.classList.remove('active');
    }
});
    </script> --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('download-jd-btn');
    const dropdown = document.getElementById('dropdown-menu');
    let hoverTimeout;

    function showDropdown() {
        dropdown.classList.add('show');
        btn.classList.add('active');
        dropdown.style.display = 'block';
    }

    function hideDropdown() {
        dropdown.classList.remove('show');
        btn.classList.remove('active');
        dropdown.style.display = 'none';
    }

    // Show dropdown on mouseenter
    btn.addEventListener('mouseenter', showDropdown);
    dropdown.addEventListener('mouseenter', showDropdown);

    // Hide dropdown on mouseleave (with small delay for smoothness)
    btn.addEventListener('mouseleave', () => {
        hoverTimeout = setTimeout(hideDropdown, 100);
    });
    dropdown.addEventListener('mouseleave', () => {
        hoverTimeout = setTimeout(hideDropdown, 100);
    });

    // Cancel hide if mouse re-enters quickly
    btn.addEventListener('mouseenter', () => {
        clearTimeout(hoverTimeout);
    });
    dropdown.addEventListener('mouseenter', () => {
        clearTimeout(hoverTimeout);
    });

    // Optional: still allow click to toggle on mobile
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        showDropdown();
    });

    // Hide dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!btn.contains(event.target) && !dropdown.contains(event.target)) {
            hideDropdown();
        }
    });
});
</script>
@endsection
