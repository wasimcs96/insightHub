@extends('admin.layout.app')

@section('title', 'Users')
@section('styles')
<style>

</style>
@endsection
@section('content')

<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">


        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}" class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Reviews
            </h1>
            <!--end::Title-->


            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Home </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item capitalize text-muted">
                    Reviews </li>
                <!--end::Item-->

            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Action group-->
        <!--begin::Toolbar end-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Filter menu-->
            <div class="m-0">
                <!--begin::Menu toggle-->
                {{-- <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <iconify-icon icon="mingcute:filter-line" class="fa-1x"></iconify-icon>
                    Filter
                </a> --}}
                <!--end::Menu toggle-->



                <!--begin::Menu 1-->
                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_65e95fe68ac03">
                    <!--begin::Header-->
                    <div class="px-7 py-5">
                        <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                    </div>
                    <!--end::Header-->

                    <!--begin::Menu separator-->
                    <div class="separator border-gray-200"></div>
                    <!--end::Menu separator-->
                    <!--begin::Form-->
                    <div class="px-7 py-5" style="overflow-y: scroll;height: 500px;">
                        <!--begin::Input group-->
                        <form id="filter-form" action="{{ route('admin.performance.management.filterUsers') }}" method="GET">
                            <input type="hidden" name="export" value="0" id="export-input">
                            <input type="hidden" name="is_assessment" value="{{ request('is_assessment') }}" id="export-input">

                            <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block py-2">Search
                                By Name:</span>
                            <!--end::Label-->
                            <!--begin:: Input-->
                            <input type="text" name="name" class="form-control mb-3 mb-lg-0 " value="{{ request('name') }}" placeholder="Name">

                            <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block py-2">Search
                                By Email:</span>
                            <input type="text" name="email" class="form-control mb-3 mb-lg-0" placeholder="Search by Email" value="{{ request('email') }}">
                            <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block py-2">Search
                                By Year:</span>
                            <input type="number" name="year" class="form-control mb-3 mb-lg-0" placeholder="Search by Year" value="{{ request('year') }}">

                            <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block">Select
                                Department:</span>

                            <!--begin::Select-->
                            <select class="form-select form-select-solid me-6" data-control="select2"
                                    data-placeholder="Select Department" data-hide-search="true" name="department"
                                    id="department">
                                    <option selected="selected" value=""
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Select Department</option>
                                    
                                    @foreach ($data['departments'] as $department)
                                        <option value="{{ $department->id }}"
                                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600"
                                            {{ request('department') == $department->id ? 'selected' : '' }}>
                                            {{ $department->head_of_department ?? '' }}</option>
                                    @endforeach

                                </select>
                                <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block">Select
                                Position:</span>
                            <select class="form-select form-select-solid me-6" data-control="select2"
                                    data-placeholder="Select Position" data-hide-search="true" name="position"
                                    id="position">
                                    <option selected="selected" value=""
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Select Position</option>
                                        <option value=""
                                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600"
                                            >
                                           </option>


                                </select>
                                <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block">Select
                                KPI Type:</span>
                            <select class="form-select form-select-solid me-6" data-control="select2"
                                    data-placeholder="Select KPI Type" data-hide-search="true" name="kpi_type"
                                    id="kpi_type">
                                    <option selected="selected" value=""
                                        class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                        Select KPI Type</option>
                                        <option value="mid_year"
                                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600"
                                            >Mid Year
                                           </option>
                                        <option value="end_year"
                                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600"
                                            >End Year
                                           </option>


                                </select>

                            <!--begin::Actions-->

                        </form>
                        <!--end::Actions-->
                    </div>
                    <div class="px-7 py-5">
                        <div class="d-flex justify-content-end py-2">
                            <a href="/admin/performance/management/review" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</a>

                            <button type="button" onclick="document.getElementById('filter-form').submit();" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>


                        </div>
                    </div>
                    <!--end::Form-->
                </div>
                <!--end::Menu 1-->
            </div>
            <!--end::Filter menu-->


            <!--begin::Secondary button-->
            <!--end::Secondary button-->

            <!--begin::Primary button-->
            {{-- <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_create_app">
                    Create </a> --}}
            <!--end::Primary button-->
        </div>



        <!--end::Toolbar end-->
        <!--end::Action group-->
    </div>
    <!--end::Toolbar end-->
    <!--end::Action group-->
</div>
<!--end::Toolbar container-->

<!--begin::Content-->
<div id="kt_app_content" class="app-content  flex-column-fluid ">


    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container  ">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2 class="capitalize">Completed Review List
                    </h2>
                </div>
                <!--begin::Card title-->

                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <!--begin::Filter-->
                        {{-- <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span
                                    class="path2"></span></i> Filter
                        </button>
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                            </div>
                            <!--end::Header-->

                            <!--begin::Separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Separator-->

                            <!--begin::Content-->
                            <div class="px-7 py-5" data-kt-user-table-filter="form">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-semibold">Role:</label>
                                    <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                        data-placeholder="Select option" data-allow-clear="true"
                                        data-kt-user-table-filter="role" data-hide-search="true">
                                        <option></option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="Analyst">Analyst</option>
                                        <option value="Developer">Developer</option>
                                        <option value="Support">Support</option>
                                        <option value="Trial">Trial</option>
                                    </select>
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-semibold">Two Step
                                        Verification:</label>
                                    <select class="form-select form-select-solid fw-bold" data-kt-select2="true"
                                        data-placeholder="Select option" data-allow-clear="true"
                                        data-kt-user-table-filter="two-step" data-hide-search="true">
                                        <option></option>
                                        <option value="Enabled">Enabled</option>
                                    </select>
                                </div>
                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <button type="reset"
                                        class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                        data-kt-menu-dismiss="true" data-kt-user-table-filter="reset">Reset</button>
                                    <button type="submit" class="btn btn-primary fw-semibold px-6"
                                        data-kt-menu-dismiss="true" data-kt-user-table-filter="filter">Apply</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Content-->
                        </div> --}}
                        <!--end::Menu 1-->
                        <!--end::Filter-->
                        <!--begin::Export-->



                        {{-- <button type="button" class="btn btn-light-primary me-3 d-flex align-items-center" id="export-button">
                            <iconify-icon icon="clarity:export-line" class="fa-1x"></iconify-icon> Export
                        </button> --}}
                        <!--end::Export-->



                        <!--begin::Export-->
                        {{-- <button type="button" class="btn btn-light-primary me-3 d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#kt_modal_export_users">
                                <iconify-icon icon="uil:import" class="fa-1-5"></iconify-icon> Import
                            </button>
                            
                            <!--end::Export-->

                            <!--begin::Add user-->
                            <a href="/admin/myemployee/create/" class="btn btn-primary d-flex align-items-center">
                                <iconify-icon icon="charm:plus"></iconify-icon>
                                Add User
                            </a>
                            --}}
                        <!--end::Add user-->
                    </div>
                    <!--end::Toolbar-->

                    <!--begin::Group actions-->
                    <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                        <div class="fw-bold me-5">
                            <span class="me-2" data-kt-user-table-select="selected_count"></span> Selected
                        </div>

                        <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">
                            Delete Selected
                        </button>
                    </div>
                    <!--end::Group actions-->

                          
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body py-4" style="overflow-x: scroll;">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
    <thead>
        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
            <th class="min-w-125px">User</th>
            <th class="min-w-100px">Department</th>
            <th class="min-w-100px">Position</th>
            <th class="min-w-150px">Review Date</th>
            <th class="text-center min-w-100px">Actions</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-semibold">
        @if (isset($data['reviewData']) && count($data['reviewData']) > 0)
        @foreach ($data['reviewData'] as $review)
                <tr>
                    <td class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                            <a href="/admin/employee-details/{{ $review['userData']->id ?? '' }}">
                                <div class="symbol-label">
                                    @if (isset($review['userData']->profile_picture) && File::exists(public_path($review['userData']->profile_picture)))
                                        <img src="{{ asset($review['userData']->profile_picture) }}" alt="{{ $review['userData']->first_name ?? ''  . ' ' . $review['userData']->last_name ?? ''  }}" class="w-100" />
                                    @else
                                        <img src="{{ asset('images/default-user.svg') }}" alt="Image Not Found" class="w-100" />
                                    @endif
                                </div>
                            </a>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="/admin/employee-details/{{ $review['userData']->id ?? '' }}" class="text-gray-800 text-hover-primary mb-1">{{ $review['userData']->first_name ?? '' }} {{ $review['userData']->last_name ?? '' }}</a>
                            <span>{{ $review['userData']->email ?? '' }}</span>
                        </div>
                    </td>
                    <td>
                        {{ $review['userData'] && $review['userData']->department && $review['userData']->department->head_of_department ? $review['userData']->department->head_of_department : '' }}
                    </td>

                    <td>{{ $review['userData']->job_position->title ?? '' }}</td>
                    <td>{{ \Carbon\Carbon::parse($review['reviewDetails']->review_date  ?? '' )->format('d-m-Y') }}</td>
                    <td class="text-center">
                        
                        <a href="/admin/performance/review-details/{{$review['kpiId']}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mb-2">
                            <iconify-icon icon="fluent:eye-20-regular" class="fa-1-5"></iconify-icon>
                        </a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="text-center">No data available</td>
            </tr>
        @endif
    </tbody>
</table>


                <!--end::Table-->

            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->


<!--begin::Modal - Adjust Balance-->
<div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Import Users</h2>
                <!--end::Modal title-->

                <!--begin::Close-->
                <div class="btn btn-icon btn-close btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <iconify-icon icon="clarity:close-line" class="fa-1-5"></iconify-icon>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->

            <!--begin::Modal body-->
            <div class="modal-body mt-0 mx-5 mx-xl-15 my-7 pt-3 scroll-y">

                <div class="align-items-center d-flex justify-content-between mb-20">
                    <h2>Download Sample File:</h2> <a href="{{ asset('admin/users.xlsx') }}" download target="_blank" class="btn btn-primary">Download</a>
                </div>
                <!--begin::Form-->
                <form id="kt_modal_export_users_form" class="form" action="/admin/myemployee/import" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">Select CSV File:</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <input type="file" name="file" class="fw-bold form-control">

                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->



                    <!--begin::Actions-->
                    <div class="text-center">
                        <a type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                            Discard
                        </a>

                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">
                                Submit
                            </span>
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - New Card-->


@endsection
@section('scripts')
<!-- <script src="{{ asset('admin/js/custom/apps/user-management/users/list/table.js') }}"></script> -->
<script>
    document.getElementById('export-button').addEventListener('click', function() {
        document.getElementById('export-input').value = 1;
        document.getElementById('filter-form').submit();
    });
</script>

@endsection