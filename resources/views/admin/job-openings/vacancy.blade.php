@extends('admin.layout.app')

@section('title', 'Job Openings')
@section('styles')
<style>
    .selected{
        border-bottom: 3px solid red;
    }
</style>
@endsection
@section('content')
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">


        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
            data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
            class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Job Advertisement
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
                    Job Advertisement </li>
                <!--end::Item-->

            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Action group-->
        <!--begin::Toolbar end-->
        {{-- <form class="d-flex align-items-center overflow-auto" action="">
             

                <span class="fs-7 fw-bold text-gray-700 flex-shrink-0 pe-4 d-none d-md-block">Job Title:</span>
                <!--end::Label-->

                <!--begin::Input-->
                <input type="text" placeholder="Search By Position Title" name="search" value="{{ request('search') ?? '' }}" autocomplete="search" class="form-control bg-transparent me-6"/>

                <!--end::Input-->


                <div class="bullet bg-secondary h-35px w-1px mx-6"></div>



                <!--begin::Actions-->
                <div class="d-flex align-items-center">
                    <button type="submit" class="btn btn-sm btn-icon btn-light-primary me-3" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Filter">
                        <iconify-icon icon="mingcute:filter-line" class="fa-2x"></iconify-icon>
                    </button>

                    <a href="/admin/job-openings" class="btn btn-sm btn-icon btn-light me-3" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Reset">
                        <iconify-icon icon="bx:reset" class="fa-2x"></iconify-icon>
                    </a>
          
                </div>
                <!--end::Actions-->
        </form> --}}
        <!--end::Toolbar end-->
        <!--end::Action group-->
    </div>
    <!--end::Toolbar container-->
</div>

<div id="kt_app_content" class="app-content  flex-column-fluid ">

    <div id="kt_app_content_container" class="app-container  w-100 ">
        <div class="card mb-5">
            <div class="align-items-lg-stretch border-0 border-none d-flex flex-wrap justify-content-between p-8 pt-5">
                <div class="d-flex">
                    <a href="/admin/job-openings{{ 
                        request('department_id') ? '?department_id=' . request('department_id') : 
                        (session('job_opening_department_id') ? '?department_id=' . session('job_opening_department_id') : '') 
                    }}" class="align-content-center fs-3 fw-bold mb-1 text-dark {{ Request::segment(2) == 'job-openings' ? 'selected' : '' }}" >Job Advertisements </a>
                    <a href="/admin/job-vacancies{{ 
                        request('department_id') ? '?department_id=' . request('department_id') : 
                        (session('job_opening_department_id') ? '?department_id=' . session('job_opening_department_id') : '') 
                    }}" 
                    class="align-content-center fs-3 fw-bold mb-1 ms-19 text-dark {{ Request::segment(2) == 'job-vacancies' ? 'selected' : '' }}">
                        Job Vacancies
                    </a>
                    

                </div>
                {{-- <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Job Advertisement Listing</span>

                
            </h3> --}}
                {{-- <a class="btn btn-primary float-right">Add a Job Advertisement</a> --}}
                <div class="card-toolbar">
                    <a href="{{ route('admin.job-openings.create-form') }}" class="btn btn-sm btn-light-primary">
                        <iconify-icon icon="mdi:plus"></iconify-icon> Create Job Advertisements
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form class="row">
                    <div class="col-lg-2">
                        <label class="form-label">Sort By</label>
                        <select class="form-select form-control-solid" name="sort">
                            <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Sort</option>
                            <option value="created_date" {{ request('sort') == 'created_date' ? 'selected' : '' }}>Created Date</option>
                            <option value="applicant_count" {{ request('sort') == 'applicant_count' ? 'selected' : '' }}>Applicant Count</option>
                            <option value="vacancy" {{ request('sort') == 'vacancy' ? 'selected' : '' }}>Vacancies</option>
                        </select>
                    </div>

                    <div class="col-lg-2">
                        <label class="form-label">Sort Type</label>
                        <select class="form-select form-control-solid" name="sort_type">
                            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Desc</option>
                            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Asc</option>
                        </select>
                    </div>
                    

                    <div class="col-lg-2">
                        <label class="form-label">Department</label>
                        <select class="form-select form-control-solid select2" name="department_id">
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2 d-flex align-items-center mt-5">
                        <button type="submit" class="btn btn-sm btn-icon btn-light-primary me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Filter">
                            <iconify-icon icon="mdi:filter" class="fa-2x"></iconify-icon>
                        </button>
                        <a href="/admin/job-vacancies" class="btn btn-sm btn-icon btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Reset">
                            <iconify-icon icon="bx:reset" class="fa-2x"></iconify-icon>
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Job Vacancy Listing [From Company JD's]</span>

                    {{-- <span class="text-muted mt-1 fw-semibold fs-7">Over 500 new products</span> --}}
                </h3>
                {{-- <a class="btn btn-primary float-right">Add a Job Advertisement</a> --}}
                {{-- <div class="card-toolbar">
                    <a href="{{ route('admin.job-openings.create-form') }}" class="btn btn-sm btn-light-primary">
                        <iconify-icon icon="mdi:plus"></iconify-icon> Create Job Advertisements
                    </a>
                    <a href="{{ route('all-jobs') }}" class="btn btn-sm btn-light-primary" style="margin-left: 2px;" target="_blank"> 
                        Go To Job Portal
                    </a>
                </div> --}}
            </div>
            <!--end::Header-->

             <!--begin::Body-->
             <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="min-w-125px text-center">Job Title</th>
                                <th class="min-w-125px text-center">Department</th>
                                <th class="min-w-125px text-center">Date Created</th>
                                <th class="min-w-125px text-center">Total Heads</th>
                                <th class="min-w-125px text-center">Total Employees</th>
                                <th class="min-w-125px text-center">Total Vacancies</th>
                                <th class="min-w-200px text-center rounded-end">Action</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody>
                            @foreach ($vacancies as $vacancy)
                                <tr>

                                    <td>
                                        <span
                                            class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ $vacancy->title ?? '' }}</span>
                                    </td>

                                    <td>
                                        <span
                                            class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ $vacancy->OrgDepartment->name ?? '' }}</span>
                                    </td>

                                    <td>
                                        <span
                                            class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ App\Helpers\HelperFunctions::formatCreatedAtDate($vacancy->created_at) }}
                                            |
                                            {{ App\Helpers\HelperFunctions::formatCreatedAtDate($vacancy->updated_at) }}</span>
                                    </td>

                                   <td>
                                        <span
                                            class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ $vacancy->heads ?? 0 }}</span>
                                    </td>

                                    <td>
                                        <span
                                            class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ $vacancy->employees_count ?? 0 }}</span>
                                    </td>

                                    <td>
                                        <span
                                            class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">{{ ($vacancy->heads - $vacancy->employees_count) ?? 0 }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="me-0">
                                            <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                {{-- <i class="ki-solid ki-dots-horizontal fs-2x"></i> --}}
                                                <iconify-icon icon="iconamoon:menu-kebab-vertical-bold"
                                                    class="fa-1-5"></iconify-icon>
                                            </button>

                                            <!--begin::Menu 3-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                                                data-kt-menu="true">
                                                <!--begin::Heading-->
                                                <div class="menu-item px-3">
                                                    <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                                        Actions
                                                    </div>
                                                </div>
                                                <!--end::Heading-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('jobs.edit', $vacancy->id) }}"
                                                        class="menu-link px-3">
                                                        Edit
                                                    </a>
                                                </div>
                                                <!--end::Menu item-->

                                            </div>
                                            <!--end::Menu 3-->
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->

                </div>
                {{ $vacancies->links() }}

                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </div>
    </div>

</div>

@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function exportToExcel() {
        // Select the table element
        var table = document.getElementById('table');

        // Convert table to worksheet
        // var ws = XLSX.utils.table_to_sheet(table, {autoWidth: true});
        // Convert table to worksheet
        var ws = XLSX.utils.table_to_sheet(table);

        // Calculate column widths
        var colWidths = [];
        var rows = XLSX.utils.sheet_to_json(ws, {
            header: 1
        });
        rows.forEach(function(row) {
            row.forEach(function(cell, colIndex) {
                var cellText = cell ? cell.toString() : '';
                var cellLength = cellText.length;
                colWidths[colIndex] = (colWidths[colIndex] || 0) < cellLength ? cellLength : (colWidths[colIndex] || 0);
            });
        });

        // Apply calculated column widths to the worksheet
        ws['!cols'] = colWidths.map(function(width) {
            return {
                wch: width
            };
        });

        // Create a workbook and add the worksheet
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

        // Save the workbook as a file
        XLSX.writeFile(wb, 'potential_employees.xlsx');
    }

</script>



@endsection
