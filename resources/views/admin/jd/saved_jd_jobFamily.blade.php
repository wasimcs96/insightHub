<!-- job.index.blade.php -->

@extends('admin.layout.app')

@section('title', 'Setting - Job Descriptions')
@section('styles')
    <style>
        .navtab-btn {
            border: 1px solid #f7941d;
            border-radius: 6px;
        }

        a.bg-primary:hover {
            background-color: #000000 !important;
            color: white;
        }

        .trimmed-description {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .new-jd-btn {

            padding: 12px 16px;
            border-radius: 4px;
            border: 1px solid #DBDFE9;
            transform: translate3d(-210px, 130.5px, 0px) !important;
        }

        .new-jd-btn a {
            color: #000;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }
    </style>

    <style>
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

        .search-wrapper {
            height: 32px;
            display: flex;
        }

        .search-input {
            width: 270px;
            padding: 0px 12px;
            border-radius: 4px 0px 0px 4px;
            border: 1px solid #C4CADA;
            border-right: 0;
            background: #FFF;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 400;
        }

        .search-icon {
            display: flex;
            padding: 0px 8px;
            align-items: center;
            border-radius: 0px 4px 4px 0px;
            border: 1px solid #C4CADA;
            background: #FFF;
            color: #99A1B7;
        }

        .size-icon-fix {
            width: 16px;
            height: 16px;
            display: block;
        }

        .btn-view-jd {
            border: 1px solid #ced4da;
            color: #6c757d;
            background-color: white;
        }

        .btn-view-jd i {
            margin-right: 4px;
        }

        input:focus-visible {
            outline: none !important;
            box-shadow: none !important;
        }

        .custom-btn {
            height: 35px;
            padding: 8px 16px;
            background: #F7941C;
            justify-content: center;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            width: fit-content;
        }

        .custom-btn.orange-fill,
        .orange-fill-popup {
            background: #F7941C;
            color: #FFF;
        }

        .orange-outline-popup {
            border: 1px solid #F7941C !important;
            background: #FFF;
            color: #F7941C;
        }

        .disable-grey-popup {
            border: 1px solid #DBDFE9 !important;
            background: #F1F1F4;
            color: #99A1B7;
        }

        .grey-outline-popup {
            border: 1px solid #99A1B7 !important;
            background: #FFF;
            color: #78829D;

        }

        .btn-view-jd {
            padding: 8px 16px;
            border-radius: 4px;
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #78829D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .line-h {
            width: 1px;
            height: 32px;
            background: #DDD;
        }

        .dropdown-menu.show {
            /* transform: translate3d(1063px, 205.5px, 0px) !important; */
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

        .dropdown-item:focus,
        .dropdown-item:hover {
            color: #1E1E1E;
            background-color: #FFF6EA;
            border-radius: 8px;
        }

        .empty-state {
            display: flex;
            height: 70vh;
            padding: 118px 232px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 16px;
            border-radius: 8px;
            background: #F1F1F4;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            margin-top: 28px;
        }

        .empty-state p {
            color: #4B5675;
            text-align: center;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
        }

        .sector-main {
            margin-top: 28px;
            display: flex;
            align-items: center;
            gap: 28px 31px;
            flex-wrap: wrap;
        }

        .sector-box {
            min-width: 397px;
            margin: auto;
            display: flex;
            padding: 26px 29.25px;
            flex-direction: column;
            align-items: flex-start;
            border-radius: 8.125px;
            background: #FFF;
            box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.1);
        }

        .sector-box:hover {
            background: #FFF6EA;
        }

        .sector-box img {
            margin-bottom: 16.25px;
        }

        .sector-box h4 {
            margin-bottom: 22.75px;
        }

        .modal-header {
            border-bottom: none;
            padding-bottom: 0px;
        }

        .modal-footer {
            border-top: none;
            padding-top: 0px;
        }

        .modal-footer button {
            flex: 1 0 0;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
        }

        .custom-popup-body h4 {
            margin: 16px auto 13px auto;
            color: #4B5675;
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
        }

        .custom-popup-body p {
            color: #4B5675;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 20px;
            margin-bottom: 16px;
        }

        .manually-radio {
            position: relative;
        }

        .manually-radio input[type="radio"] {
            display: none;
        }

        .manually-radio input[type="radio"]:checked+.manually-modal-inner {
            border: 2px solid #F7941C !important;
        }

        .manually-modal-inner {
            border-radius: 16px;
            border: 2px solid #F1F1F4;
            padding: 16px;
            flex: 1 0 0;
            min-width: 32%;
            height: 150px;
            cursor: pointer;
        }

        .manually-modal-inner:hover {
            border: 2px solid #F7941C;
        }

        .manually-modal-inner .line {
            height: 2px;
            width: 100%;
            display: block;
            background-color: #F1F1F4;
        }

        .popup-proceed-button:disabled {
            border: 1px solid #DBDFE9 !important;
            background: #F1F1F4;
            color: #99A1B7;
        }

        .tab-button {
            padding: 16px;
            gap: 4px;
            color: #99A1B7;
            font-size: 14px;
            font-weight: 600;
            line-height: 18px;
            cursor: pointer;
        }

        .tab-button p {
            margin: 0;
        }

        .tab-button.active {
            border-bottom: 1px solid #F7941C;
            color: #F7941C;
            font-weight: 600;
        }

        .top-filter {
            display: flex;
            border-bottom: 1px solid #f1f1f4;
            margin-bottom: 24px;
        }

        .card-body {
            border-radius: 8.125px;
            background: #FFF;
        }

        .card .card-body {
            padding: 2rem 2.25rem;
            color: black;
        }

        .department-card .card-body:hover {
            background-color: #FFF6EA;
        }
    </style>
@endsection

@section('content')

    <div class="d-flex flex-column flex-column-fluid">

        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">

                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Job Management
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
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            Job Management</li>

                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->


                        <!--begin::Item-->
                       <li class="breadcrumb-item text-muted">
                            <a href="{{ route('jobs.savedJobs', ['saved_job' => 1]) }}" class="text-muted text-hover-primary">
                                Company JDs
                            </a>
                       </li>

                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->

                        @php
                            $divisionId = request()->get('job_family_group_id'); // get ID from route
                            $division = \App\Models\Division::find($divisionId);
                        @endphp

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            {{ $division->head_of_division ?? 'No Division' }}</li>

                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->


                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            Department</li>
                        <!--end::Item-->

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <div class="d-flex ">
                    @php
                        $roleId = auth()->user()->role_id ?? null;
                    @endphp

                    @if (in_array($roleId, [2, 7]))
                        <div class="d-flex mr-1 navtab-btn">

                            <a href="{{ route('jobs.savedJobs', ['saved_job' => 1]) }}"
                                class="tab-link active-tab {{ Route::currentRouteName() == 'jobs.savedJobs' }}">
                                Company JDs
                            </a>
                            <a href="{{ route('jobs.index', ['saved_job' => 0]) }}"
                                class="tab-link {{ Route::currentRouteName() == 'jobs.index' ? '' : '' }}">
                                JD Master List
                            </a>

                        </div>
                    @endif


                    {{-- <a href="/admin/setting/job-description/view"
                    class="align-content-center align-items-center btn btn-outline btn-outline-secondary d-flex justify-content-center mr-1 rounded-1  {{ Route::currentRouteName() == 'jobs.create' ? 'active' : '' }}">
                    <iconify-icon icon="f7:sparkles" class="mr-1"></iconify-icon> View JD
                </a>

                <a href="{{ route('jobs.create') }}"
                    class="align-content-center align-items-center btn btn-outline btn-outline-secondary d-flex justify-content-center rounded-1 border-right rounded-end-0 {{ Route::currentRouteName() == 'jobs.create' ? 'active' : '' }}">
                    <iconify-icon icon="ep:plus" class="mr-1"></iconify-icon> Create New JD
                </a> --}}


                    <!--begin::Filter menu-->
                    {{-- <div class="p-4 btn btn-outline btn-outline-secondary border-left-0 rounded-start-0">
                    <!--begin::Menu toggle-->
                    <a href="#" class="" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <iconify-icon icon="oui:arrow-down" class="text-dark"></iconify-icon>

                    </a>
                    <!--end::Menu toggle-->



                    <!--begin::Menu 1-->
                    <div class="menu menu-sub menu-sub-dropdown new-jd-btn" data-kt-menu="true"
                        id="kt_menu_65e95fe68ac03">
                        <!--begin::Header-->
                        <div>
                            <a href="/admin/ai/jd/generator/create" class="fs-6"><iconify-icon
                                    icon="f7:sparkles" class="mr-1"></iconify-icon> Generate New JD</a>
                        </div>


                    </div>
                    <!--end::Menu 1-->
                </div> --}}

                </div>
            </div>

            <!--end::Actions-->
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->

        <!--begin::Content-->

        <div id="kt_app_content" class="app-content  flex-column-fluid ">


            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container  container-xxl ">
                <div class="d-flex justify-content-between">
                    <h1 class="m-0">Department</h1>
                    <div class="d-flex align-items-center gap-5">
                        <div class="search-wrapper">
                            <input type="text" class="search-input" placeholder="Search by Department">
                            <button class="search-icon" id="searchBtn">
                                <iconify-icon icon="iconamoon:search-bold" width="16" height="16"
                                    class="size-icon-fix"></iconify-icon>
                            </button>
                        </div>
                        @php
                            $roleId = auth()->user()->role_id ?? null;
                        @endphp

@if (in_array($roleId, [2, 7]))
                            <button class="btn custom-btn orange-fill d-flex gap-2 align-items-center" type="button"
                                id="createJDDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <iconify-icon icon="stash:plus-solid" width="16" height="16"
                                    class="size-icon-fix"></iconify-icon>
                                <span>Create New JD</span>
                                <iconify-icon icon="fluent:chevron-down-12-filled" width="16" height="16"
                                    class="size-icon-fix"></iconify-icon>
                            </button>

                            <!-- ✅ Proper Dropdown Menu -->
                            <div class="dropdown-menu" aria-labelledby="createJDDropdown">
                                <a href="javascript:void(0);" class="dropdown-item redirect-link"
                                    data-url="{{ route('admin.job-management.createJd', ['type' => 'Ai']) }}">
                                    Create with AI
                                    <iconify-icon icon="f7:sparkles" width="16" height="16" class="size-icon-fix"
                                        style="color: #78829D;"></iconify-icon>
                                </a>
                                <a class="dropdown-item" data-bs-toggle="modal" href="#CreateJDManually">
                                    Create Manually
                                    <iconify-icon icon="prime:pencil" width="16" height="16" class="size-icon-fix"
                                        style="color: #78829D;"></iconify-icon>
                                </a>
                            </div>

                            <div class="line-h"></div>

                            <a href="/admin/setting/job-description/view"
                                class="btn-view-jd d-flex align-items-center gap-2">
                                <iconify-icon icon="f7:sparkles" class="mr-1" width="16" height="16"
                                    class="size-icon-fix"></iconify-icon>
                                View JD
                            </a>
                        @endif
                    </div>
                    {{-- <div>
                        <label>
                            <input type="radio" name="category" value="all" onclick="filterJobFamilies()" checked> All
                        </label>
                        <label>
                            <input type="radio" name="category" value="operational" onclick="filterJobFamilies()">
                            Operational
                        </label>
                        <label>
                            <input type="radio" name="category" value="non-operational" onclick="filterJobFamilies()">
                            Non-Operational
                        </label>
                    </div> --}}
                </div>
                {{-- {{ dd($jobFamilies) }} --}}
                {{-- @if (empty($jobFamilies))
                <div class="top-filter">
                    <a class="tab-button @if (request('category') == 'all' || request('category') == '') active @endif" value="all" href="{{ route('jobs.savedJobs', ['category' => 'all', 'saved_job' => request('saved_job')]) }}">
                        <p>All</p>
                    </a>
                    <a class="tab-button @if (request('category') == 'Operational') active @endif" value="operational"   href="{{ route('jobs.savedJobs', ['category' => 'Operational', 'saved_job' => request('saved_job')]) }}">
                        <p>Operational</p>
                    </a>
                    <a class="tab-button @if (request('category') == 'Corporate') active @endif"  value="non-operational" href="{{ route('jobs.savedJobs', ['category' => 'Corporate', 'saved_job' => request('saved_job')]) }}">
                        <p>Corporate</p>
                    </a>
                </div>
                @endif --}}

                {{-- {{ dd($jobFamilyGroups,$jobFamilies) }} --}}
                {{-- @if (!empty($jobFamilies))

                    <div class="row gx-6 gx-xl-9 mt-7">

                        @foreach ($jobFamilies as $key => $value)
                            <div class="col-xl-4 department-card mb-9" data-name="{{ strtolower($value->name) }}">

                                <!--begin::Statistics Widget 5-->
                                <a href="{{ route('admin.saved.jobdescriptions', ['org_department' => $value->id, 'saved_job' => request('saved_job')]) }}"
                                    class="card hoverable card-xl-stretch mb-xl-8 w-100 h-100">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <iconify-icon icon="{{ $value['icon'] ?? 'arcticons:emoji-department-store' }}"
                                            width="64" height="64"></iconify-icon>

                                        <div class="fw-bold fs-2 mb-2 mt-5">
                                            {{ $value->name ?? '' }}

                                        </div>

                                        <div class="fw-bold fs-2 mb-2 mt-5">

                                            Total Job Positions(s):
                                            {{ $value->jobProfiles ? $value->jobProfiles->count() : 0 }} <br>
                                            Pending Job Positions(s): {{ $value->pending_jobs_count ?? 0 }} <br>
                                            Approved Job Positions(s): {{ $value->approved_jobs_count ?? 0 }}
                                        </div>

                                    </div>
                                    <!--end::Body-->
                                </a>
                                <!--end::Statistics Widget 5-->
                            </div>
                        @endforeach

                    </div>
                @else
                    <div class="empty-state">
                        <p>
                            You haven’t added any company JDs yet. <br>
                            Click “Create New JD” to get started.
                        </p>
                        <div class="custom-btn orange-fill d-flex gap-2 align-items-center" data-bs-toggle="modal"
                            data-bs-target="#createNewJD">
                            <iconify-icon type="button" icon="stash:plus-solid" width="16"
                                height="16"></iconify-icon>
                            <span type="button">
                                Create New JD
                            </span>

                        </div>

                    </div>

                @endif --}}
                @if($jobFamilies->isNotEmpty()) <!-- Use isNotEmpty() to check if the collection has elements -->

                    <div class="row gx-6 gx-xl-9 mt-7">
                        @foreach ($jobFamilies as $key => $value)
                            <div class="col-xl-4 department-card mb-9" data-name="{{ strtolower($value->name) }}">

                                <!--begin::Statistics Widget 5-->
                                <a href="{{ route('admin.saved.jobdescriptions', ['org_department' => $value->id, 'saved_job' => request('saved_job')]) }}"
                                class="card hoverable card-xl-stretch mb-xl-8 w-100 h-100">
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <iconify-icon icon="{{ $value['icon'] ?? 'arcticons:emoji-department-store' }}" width="64" height="64"></iconify-icon>

                                        <div class="fw-bold fs-2 mb-2 mt-5">
                                            {{ $value->name ?? '' }}
                                        </div>

                                        <div class="fw-bold fs-2 mb-2 mt-5">
                                            Total Job Positions(s):
                                            {{ $value->jobProfiles ? $value->jobProfiles->count() : 0 }} <br>
                                            Pending Job Positions(s): {{ $value->pending_jobs_count ?? 0 }} <br>
                                            Approved Job Positions(s): {{ $value->approved_jobs_count ?? 0 }}
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                </a>
                                <!--end::Statistics Widget 5-->
                            </div>
                        @endforeach
                    </div>

                @else
                    <div class="empty-state text-center p-5">
                        <p>
                            No departments have been added to this Company/Division yet. <br>
                            Click ‘Add Department’ to create one.
                        </p>
                        <a href="/admin/mydepartment/create/" target="_blank" 
                            class="custom-btn orange-fill d-flex gap-2 align-items-center">
                            <iconify-icon icon="stash:plus-solid" width="16" height="16"></iconify-icon>
                            <span>Add Department</span>
                        </a>
                    </div>
                @endif
                <!--end::Stats-->
            </div>
            <!--end::Content container-->


        </div>
        <!--end::Content-->

    </div>
    @include('admin.job-management.modals.job_create_modal')
    @include('admin.job-management.modals.manual_job_create_modal')


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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        // Get all the radio buttons
        const radioButtons = document.querySelectorAll('input[name="jdOption"]');
        const proceedButton = document.getElementById('proceedBtn');

        // Listen for change event on radio buttons
        radioButtons.forEach(button => {
            button.addEventListener('change', function() {
                // Enable the proceed button when a radio is selected
                proceedButton.disabled = false;
            });
        });

        // Add event listener to the proceed button
        proceedButton.addEventListener('click', function() {
            // Get the selected radio button value
            const selectedOption = document.querySelector('input[name="jdOption"]:checked');

            if (selectedOption) {
                // Redirect to the URL corresponding to the selected radio button value
                let redirectURL = '/';

                switch (selectedOption.value) {
                    case 'custom':
                        redirectURL = '/admin/job-management/custom-jd'; // Set the URL for Custom JD
                        break;
                    case 'master':
                        redirectURL = '/admin/job-management/localized/master-jd'; // Set the URL for Master JD
                        break;
                    case 'company':
                        redirectURL = '/admin/job-management/localized/company-jd'; // Set the URL for Company JD
                        break;
                    default:
                        break;
                }

                if (redirectURL) {
                    window.location.href = redirectURL; // Redirect to the selected URL
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#searchBtn').on('click', function(e) {
                e.preventDefault(); // Prevent default button behavior if needed

                let input = $('.search-input').val().toLowerCase().trim();

                $('.department-card').each(function() {
                    let departmentName = $(this).data('name');
                    if (departmentName.includes(input)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });

                // Optional: Show empty state message if no matches
                let visibleCards = $('.department-card:visible').length;
                if (visibleCards === 0) {
                    if ($('#empty-search-result').length === 0) {
                        $('#kt_app_content_container').append(`
                        <div id="empty-search-result" class="empty-state mt-4">
                                                  <p>No departments match your search.</p>
                        </div>
                    `);
                    }
                } else {
                    $('#empty-search-result').remove();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Debounce function to limit the number of searches triggered while typing
            let debounceTimer;
            $('#searchBtn').on('click', function(e) {
                e.preventDefault(); // Prevent default button behavior if needed
                filterJobFamilies(); // Filter job families directly
            });

            // Listen to input changes and apply debounce
            $('.search-input').on('input', function() {
                console.log('ddddd');
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function() {
                    filterJobFamilies(); // Trigger search after typing stops
                }, 500); // Delay in ms before search is triggered (e.g., 500ms)
            });

            // Reset filter when input is cleared
            $('.search-input').on('input', function() {
                if ($(this).val().trim() === '') {
                    resetFilter();
                }
            });

            // Filter job families based on input value
            function filterJobFamilies() {
                let input = $('.search-input').val().toLowerCase().trim();
                $('.department-card').each(function() {
                    let departmentName = $(this).data('name');
                    console.log(departmentName);
                    if (departmentName.includes(input)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });

                // Optional: Show empty state message if no matches
                let visibleCards = $('.department-card:visible').length;
                if (visibleCards === 0) {
                    if ($('#empty-search-result').length === 0) {
                        $('#kt_app_content_container').append(`
                    <div id="empty-search-result" class="empty-state mt-4">
                        <p>No departments match your search.</p>
                    </div>
                `);
                    }
                } else {
                    $('#empty-search-result').remove();
                }
            }

            // Reset filter and show all departments
            function resetFilter() {
                $('.department-card').show();
                $('#empty-search-result').remove(); // Hide empty state message
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.redirect-link').forEach(function(el) {
                el.addEventListener('click', function() {
                    const url = this.getAttribute('data-url');
                    if (url) {
                        window.location.href = url;
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const createJDButton = document.getElementById("createJDDropdown");


            if (createJDButton) {
                const dropdown = new bootstrap.Dropdown(createJDButton);

                // Optional: If you want to toggle manually on click (not using Bootstrap's data attributes)
                createJDButton.addEventListener("click", function(e) {
                    e.preventDefault();
                    dropdown.toggle();
                });
            }
        });
    </script>
@endsection
