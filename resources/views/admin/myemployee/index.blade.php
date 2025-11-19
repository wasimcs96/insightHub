@extends('admin.layout.app')

@section('title', 'Users')
@section('styles')
    <style>
        .image-input-placeholder {
            background-image: url({{ asset('admin/media/svg/files/blank-image.svg') }});
        }

        [data-bs-theme="dark"] .image-input-placeholder {
            background-image: url({{ asset('admin/media/svg/files/blank-image-dark.svg') }});
        }

        table {
            width: 100%;
            white-space: nowrap;
        }

        .dataTables_wrapper {
            overflow-x: auto;
        }

        .no-search {
            pointer-events: none;
            cursor: default;
            color: #ccc;
        }

        #emailValidationMessage {
            font-size: 14px;
            font-weight: bold;
            color: red;
            /* Red color for invalid email */
        }

        #paginationControls {
            gap: 4px;
        }

        .dtsb-title {
            font-size: 16px;
            font-weight: 600;
        }

        .dtsb-add,
        .dtsb-clearGroup {
            background-color: #f7931e !important;
            /* padding: 2px 18px !important; */
            /* font-size: 20px !important; */
            color: #fff !important;
            /* border: 1px solid #f7931e !important; */
        }

        /* .dtsb-group .btn.btn-secondary:hover:not(.btn-active),
                                    div.dt-buttons>.dt-button:hover {
                                        background-color: #f7931e;
                                        color: #fff;
                                    }

                                        .dtsb-group .btn.btn-secondary:hover:not(.btn-active),
                                    div.dt-buttons>.dt-button:hover {
                                        background-color: #f7931e;
                                        color: #fff;
                                    } */
        .dtsb-clearGroup {
            width: fit-content !important;
            padding: 0px 10px !important;
        }

        .dtsb-logicContainer {
            flex-wrap: nowrap !important;
            gap: 10px;
            overflow: initial !important;
        }

        .dtsb-logic,
        .dtsb-clearGroup {
            background-color: #F1F1F4 !important;
            border: 1px solid #0000002b !important;
            color: #0000006b !important;
            border-radius: 4px !important;
        }

        div.dtsb-searchBuilder div.dtsb-group div.dtsb-criteria select.dtsb-italic {
            font-style: normal !important;
            color: #4B5675 !important;
            margin-right: 0px !important;
            border: 1px solid #DBDFE9;
            line-height: 36px;
            height: 100% !important;
        }


        .dtsb-criteria {
            gap: 20px !important;
            border: 1px solid #DBDFE9 !important;
            padding: 12px !important;
            border-radius: 4px !important;
            align-items: center;
        }

        .dtsb-searchBuilder {
            margin-bottom: 30px !important;
        }


        .dtsb-inputCont {
            flex: initial !important;
        }

        .dtsb-buttonContainer {
            margin-left: initial !important;
        }

        div.dt-scroll-body {
             min-height: 380px;
        }

        div.dt-scroll-body>table>tbody tr,
        div.dt-scroll-body>table>thead tr th {
            border-bottom: 1px dashed #F1F1F4 !important;
        }

        .dt-column-title {
            font-size: 12.35px !important;
            color: #99A1B7 !important;
            text-transform: uppercase !important;
        }

        table.table.dataTable> :not(caption)>*>* {
            background-color: #fff !important;
        }

        .dt-layout-start {
            margin-bottom: 20px !important;
        }

        div.dt-buttons>.dt-button {
            padding: 8px 16px !important;
            background: #fff !important;
            border: 1px solid #0000002b !important;
            color: #0000006b !important;
            border-radius: 4px !important;
        }

        div.dt-buttons span.dt-button-down-arrow {
            top: 0px !important;
        }

        .dtsb-criteria .form-control:focus {
            box-shadow: none !important;
        }

        .dtsb-criteria select {
            margin-right: 0px !important;
        }

        .dtsb-data,
        .dtsb-condition {
            border-color: #DBDFE9 !important;
        }

        div.dtsb-searchBuilder div.dtsb-group button.dtsb-search {
            float: right !important;
            background: #f7931e;
            color: white;
            margin-left: 10px;
        }

        /* .dtsb-clearAll {
            display: none !important;
        } */

         .dtsb-clearAll:not(#custom-reset-btn) {
            display: none !important;
        }


        div.dtsb-searchBuilder div.dtsb-group div.dtsb-criteria select.dtsb-dropDown {
            min-width: 26em !important;
            max-width: 26em !important;
            padding-left: 17px !important;
        }

        .dtsb-input {
            min-width: 26em !important;
            max-width: 26em !important;
        }

        .dtsb-inputCont {
            min-width: 26em !important;
            max-width: 26em !important;
        }

        div.dtsb-searchBuilder div.dtsb-group div.dtsb-criteria select.dtsb-value,
        div.dtsb-searchBuilder div.dtsb-group div.dtsb-criteria input.dtsb-value {
            border-color: #DBDFE9 !important;
        }

        .dtsb-inputCont:empty {
            display: none !important;
        }


        #employees-table_wrapper> :first-child {
            /* Your CSS styles here */

            border: 1px solid #DBDFE9;
            border-radius: 12px;
            margin-bottom: 20px !important;

        }

        #employees-table_wrapper> :second-child {
            padding: 1px 16px !important;
        }

        .form-select:disabled {
            background-color: #ffffff !important;
        }

        div.dtsb-searchBuilder div.dtsb-group div.dtsb-criteria select.dtsb-value {
            border: 1px solid #DBDFE9 !important;
        }

        .dtsb-delete {
            border: 1px solid #FF6355 !important;
            color: #FF6355 !important;
            background-color: white !important;
            padding: 8px 16px !important;
            height: 48.39px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
        }

        .dtsb-buttonContainer .btn.btn-secondary:hover:not(.btn-active) {
            background-color: #FF6355 !important;
            color: #fff !important;
        }

        .dtsb-add {
            background-color: #f7931e !important;
            color: #fff !important;
        }

        /* .dtsb-title{
            padding-top: 18px !important;
        } */
        .dtsb-titleRow {
            margin-bottom: 16px !important;
        }

        .dtsb-searchBuilder {
            margin: 18px !important;
        }

        #custom-reset-btn {
            float: right;
            border: 1px solid #F7941C;
            color: #F7941C;
            height: 41.64px;
            display: flex;
            align-items: center;
        }

        /* div.dtsb-searchBuilder div.dtsb-group div.dtsb-criteria div.dtsb-inputCont input.dtsb-value{
            width:100% !important;
        } */

        .custom-light.btn.btn-light:hover:not(.btn-active), .custom-light.btn.btn-light.show{
            background-color: white !important;
        }

        div.dtsb-searchBuilder div.dtsb-group div.dtsb-criteria select.dtsb-dropDown, div.dtsb-searchBuilder div.dtsb-group div.dtsb-criteria input.dtsb-input {
            height: 48.39px;
        }

        div.dtsb-searchBuilder div.dtsb-group div.dtsb-criteria .form-control {
            height: 48.39px !important;
        }
    </style>



    {{-- https://cdn.datatables.net/datetime/1.5.4/css/dataTables.dateTime.min.css --}}


    <!-- DataTables Bootstrap 5 Integration -->
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" rel="stylesheet">

    <!-- DataTables SearchBuilder Bootstrap 5 Integration -->
    <link href="https://cdn.datatables.net/searchbuilder/1.8.1/css/searchBuilder.bootstrap5.css" rel="stylesheet">

    <!-- DataTables DateTime CSS -->
    <link href="https://cdn.datatables.net/datetime/1.5.4/css/dataTables.dateTime.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css" rel="stylesheet">




@endsection
@section('content')
    @if (session('error'))
        <div id="error-alert" class="alert alert-danger">
            {{ session('error') }}
            <a href="{{ session('download_link') }}" class="btn btn-primary" onclick="hideErrorAlert()">Download Invalid
                Emails</a>
        </div>
    @endif


    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">


            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
                class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1
                    class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Employees
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
                        Organization Structure </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item capitalize text-muted">
                        Employees </li>
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
        <!--end::Toolbar end-->
        <!--end::Action group-->
    </div>
    <!--end::Toolbar container-->
    {{-- </div> --}}

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
                        <h2 class="capitalize"> Employees List</h2>
                    </div>
                    <!--begin::Card title-->

                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                            <!--begin::Export-->
                            {{-- <button type="button" class="btn btn-light-primary me-3 d-flex align-items-center"
                                data-bs-toggle="modal" data-bs-target="#kt_modal_export_users">
                                <iconify-icon icon="uil:import" class="fa-1-5"></iconify-icon> Import
                            </button> --}}
                            <!--end::Export-->

                            <!--begin::Add user-->
                            {{-- <a href="/admin/myemployee/create/" class="btn btn-primary d-flex align-items-center">
                                <iconify-icon icon="charm:plus"></iconify-icon>
                                Add User
                            </a> --}}
                            <!--end::Add user-->
                        </div>
                        <!--end::Toolbar-->

                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none"
                            data-kt-user-table-toolbar="selected">
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

                    <table id="employees-table" class="table">
                        <thead class="table-light">
                            <tr>
                               
                                <th>User</th>
                                <th>Company</th>
                                <th>Division</th>
                                <th>Department</th>
                                <th>Position</th>
                                {{-- <th>Team</th> --}}
                                <th>Age</th>
                                <th>Gender</th>
                                {{-- <th>Department</th> --}}
                                <th>Email</th>
                                <th>Personality and Motivation</th>
                                <th>Work Interest</th>
                                <th>Cognitive Ability</th>
                                <th>Technical Assessment</th>
                                <th class="no-search">Actions</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="table-controls">
                        <!-- Filter Dropdown -->
                        {{-- <select id="filter-dropdown" class="form-select">
                            <option value="">All Departments</option>
                            <option value="HR">HR</option>
                            <option value="IT">IT</option>
                            <option value="Sales">Sales</option>
                        </select>
                    
                        <!-- Action Dropdown -->
                        <select id="action-dropdown" class="form-select">
                            <option value="">Select Action</option>
                            <option value="delete">Delete</option>
                            <option value="export">Export</option>
                        </select> --}}

                        <!-- Select All Button -->
                        {{-- <button id="select-all" class="btn btn-primary">Select All</button> --}}

                    </div>



                    <!-- Show More Button -->
                    {{-- <button id="show-more" class="btn btn-secondary">Show More</button>                     --}}

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
                        <h2>Download Sample File:</h2> <a href="{{ asset('admin/users.xlsx') }}" download target="_blank"
                            class="btn btn-primary">Download</a>
                    </div>
                    <!--begin::Form-->
                    <form id="kt_modal_export_users_form" class="form" action="/admin/myemployee/import" method="POST"
                        enctype="multipart/form-data">
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

    {{-- Offer Template start --}}

    <div class="modal fade" tabindex="-1" id="kt_modal_2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Select Template</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <iconify-icon icon="radix-icons:cross-1" class="ki-cross fs-1"></iconify-icon>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.contract.template.select') }}" id="templateform" method="post">
                        @csrf
                        <input type="hidden" name="user_id" class="form-control bg-transparent" id="user_id"
                            value="" required />

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
                        onclick="document.getElementById('templateform').submit();">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{--  Offer Template end --}}

@endsection
@section('scripts')

    <!-- DataTables CSS -->


    <!-- DataTables JS -->
    {{-- <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css"> --}}

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- Bootstrap 5 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

    <!-- DataTables SearchBuilder -->
    <script src="https://cdn.datatables.net/searchbuilder/1.8.1/js/dataTables.searchBuilder.js"></script>
    <script src="https://cdn.datatables.net/searchbuilder/1.8.1/js/searchBuilder.bootstrap5.js"></script>

    <!-- DataTables DateTime -->
    <script src="https://cdn.datatables.net/datetime/1.5.4/js/dataTables.dateTime.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>

    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.dataTables.js"></script>
    
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.colVis.min.js"></script>

    






    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>





    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Include jQuery (required for Select2) -->

    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>




    <script src="{{ asset('admin/js/custom/apps/user-management/users/list/table.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <script>
        document.getElementById('export-button').addEventListener('click', function() {
            document.getElementById('export-input').value = 1;
            document.getElementById('filter-form').submit();
        });
    </script>

    {{-- <script>
        window.COMPANY_OPTIONS = @json($companies); // [{id:..., name:...}, ...]
    </script> --}}

    <script>
                function createResetButton() {
        if ($('#custom-reset-btn').length > 0) return; // already created

        const $resetBtn = $('<button>')
            .attr('id', 'custom-reset-btn')
            .addClass('btn ms-2 dtsb-clearAll dtsb-button')
            .text('Reset')
            .hide() // hide by default
            .on('click', function () {
                $('#employees-table').DataTable().searchBuilder.rebuild(); // Clear filters
                $('#custom-reset-btn').hide(); // Hide again after clearing
            });

        return $resetBtn;
    }

    function insertResetButtonImmediately() {
        const $btn = createResetButton();

        // Find the +Add Filter button's parent and insert beside it
        const target = $('.dtsb-search').last().parent();
        if (target.length && $('#custom-reset-btn').length === 0) {
            target.append($btn);
        }
    }

    function toggleResetButtonVisibility() {
        const hasFilters = $('.dtsb-criteria').length > 0;
        $('#custom-reset-btn').toggle(hasFilters);
    }

    function observeSearchBuilderDOM() {
        const container = document.querySelector('.dtsb-searchBuilder');
        if (!container) {
            console.warn('❌ .dtsb-searchBuilder not found');
            return;
        }

        const observer = new MutationObserver(() => {
            insertResetButtonImmediately();     // Ensure button is always placed
            toggleResetButtonVisibility();      // Instantly reflect filter count
        });

        observer.observe(container, {
            childList: true,
            subtree: true
        });
    }
    
        $(document).ready(function() {
            $('[data-bs-target="#kt_modal_2"]').on('click', function() {
                var userId = $(this).attr('userid');
                $('#kt_modal_2 #user_id').val(userId);
            });

            insertResetButtonImmediately();  // On load
        observeSearchBuilderDOM();       // Real-time updates

        // Make sure reset shows when adding filters
        $(document).on('click', '.dtsb-add', function () {
            $('#custom-reset-btn').show();
        });

        // On DataTable redraw (e.g. after filter apply/reset)
        $('#employees-table').on('draw.dt', function () {
            insertResetButtonImmediately();
            toggleResetButtonVisibility();
        });
        });

        function hideErrorAlert() {
            document.getElementById('error-alert').style.display = 'none';
        }

        function getAgeFilterFromSB_ForServer() {
            let out = null;
            $('.dtsb-criteria').each(function () {
                const $row = $(this);
                const col = $row.find('select.dtsb-data option:selected').text().trim().toLowerCase();
                if (col !== 'age') return;

                const opLabel = $row.find('select.dtsb-condition option:selected').text().trim().toLowerCase();
                const $vals   = $row.find('input.dtsb-value');

                // map UI label -> backend op
                if (opLabel === 'equals')                    out = { op: 'eq',  value: $vals.eq(0).val() };
                else if (opLabel === 'not')                  out = { op: 'ne',  value: $vals.eq(0).val() };
                else if (opLabel === 'less than')            out = { op: 'lt',  value: $vals.eq(0).val() };
                else if (opLabel === 'less than equal to')   out = { op: 'lte', value: $vals.eq(0).val() };
                else if (opLabel === 'greater than equal to')out = { op: 'gte', value: $vals.eq(0).val() };
                else if (opLabel === 'greater than')         out = { op: 'gt',  value: $vals.eq(0).val() };
                else if (opLabel === 'between')              out = { op: 'between',     min: $vals.eq(0).val(), max: $vals.eq(1).val() };
                else if (opLabel === 'not between')          out = { op: 'not_between',  min: $vals.eq(0).val(), max: $vals.eq(1).val() };
                else if (opLabel === 'empty')                out = { op: 'is_null' };
                else if (opLabel === 'not empty')            out = { op: 'not_null' };
            });
            return out;
        }

        // expose companies (controller must pass $companies)
        window.COMPANY_OPTIONS = @json($companies ?? []);

            $('#employees-table').DataTable({
                    language: {
                        searchBuilder: {
                    add: '+ Add Filter',
                    condition: 'Select Comparator',
                    clearAll: 'Reset',
                    delete: `<iconify-icon icon="lucide:trash" width="20" height="20"></iconify-icon>`,
                    search: 'Filter',
                    deleteTitle: 'Delete Title',
                    data: 'Select Column',
                    left: 'Left',
                    leftTitle: 'Left Title',
                    logicAnd: 'And',
                    logicOr: 'Or',
                    right: 'Right',
                    rightTitle: 'Right Title',
                    title: {
                        0: 'Filters',
                        _: 'Filters (%d)'
                    },
                    value: 'Select Option',
                    valueJoiner: 'et'
                }
                    },
                    layout: {
                        topStart: {
                            buttons: [
                                {extend: 'pageLength',className: 'btn btn-light-primary'},
                                {
                                    text: 'Export to Excel',
                                    action: function (e, dt, button, config) {
                                        $.ajax({
                                            url: "{{ route('admin.employee.users.ajax') }}",
                                            type: 'GET',
                                            data: {
                                                department_id: $('#department_id').val(),
                                                division_id: $('#division_id').val(),
                                                is_personality_motivation_completed_id: $('#is_personality_motivation_completed_id').val(),
                                                is_work_interest_completed_id: $('#is_work_interest_completed_id').val(),
                                                is_cognitive_ability_completed_id: $('#is_cognitive_ability_completed_id').val(),
                                                is_technical_assessment_completed_id: $('#is_technical_assessment_completed_id').val(),
                                                name_keyword: $('#name_keyword').val(),
                                                position: $('#position_id').val(),
                                                // team: $('#team_id').val(),
                                                gender: $('#gender_id').val(),
                                                email_keyword: $('#email_keyword').val(),
                                                length: -1,
                                                type:'export'
                                            },
                                            success: function(response) {
                                                if (response.data && response.data.length > 0) {
                                                    // Get visible columns
                                                    var visibleColumns = dt.columns(':visible').indexes().toArray();
                                                    visibleColumns = visibleColumns.filter(column => column !== 12);
                                                    const columnHeaders = visibleColumns.map(index => dt.column(index).header().innerText);

                                                    // Prepare export data based on visible columns
                                                    let exportData = response.data.map(row => 
                                                        visibleColumns.map(index => row[dt.column(index).dataSrc()])
                                                    );

                                                    // Add headers to export data
                                                    exportData.unshift(columnHeaders);

                                                    // Use SheetJS to create and export the Excel file
                                                    const ws = XLSX.utils.aoa_to_sheet(exportData);
                                                    const wb = XLSX.utils.book_new();
                                                    XLSX.utils.book_append_sheet(wb, ws, 'ExportedData');
                                                    XLSX.writeFile(wb, 'Employee_Data.xlsx');
                                                } else {
                                                    alert('No data available to export.');
                                                }
                                            },
                                            error: function(err) {
                                                console.error('Error fetching data for export:', err);
                                                alert('Failed to fetch data for export.');
                                            }
                                        });
                                    },
                                    className: 'btn btn-light-primary'
                                },
                                {extend: 'colvis',className: 'btn btn-light-primary'},
                            ]
                    },
                        top1: {
                            searchBuilder: {
                                liveSearch: false,
                                depthLimit: 0,
                                columns: [0,1,2,3, 4, 5, 6, 7, 8, 9, 10, 11],
                                conditions: {
                                    "custom": {
                                        department_id: {
                                            conditionName: 'Department Name',
                                            init: function(that, column) {
                                                var select = $('<select id="department_id">')
                                                    .addClass('form-control')
                                                    .append('<option value="">Select Department</option>');

                                                // Populate the select options with department data
                                                $.ajax({
                                                    url: '{{ route('admin.employee.departments.ajax') }}', // Endpoint to fetch departments
                                                    method: 'GET',
                                                    success: function(data) {
                                                        data.forEach(function(department) {
                                                            select.append(
                                                                '<option value="' +
                                                                department.id +
                                                                '">' + department
                                                                .name + '</option>');
                                                        });
                                                    }
                                                });
                                                return select;
                                            },
                                            inputValue: function(input) {
                                                return $(input[0]).val();
                                            },
                                            isInputValid: function(input) {
                                                return $(input[0]).val() !== '';
                                            },
                                            search: function(value, comparison) {
                                                return value == comparison;
                                            },
                                            condition: 'Department Name'
                                        }
                                    },
                                    "is_personality_motivation_completed": {

                                        is_personality_motivation_completed: {
                                            conditionName: 'Equals',
                                            init: function(that, column) {
                                                var select = $(
                                                        '<select id="is_personality_motivation_completed_id">'
                                                        )
                                                    .addClass('form-control')
                                                    .append('<option value="">Status</option>');


                                                select.append('<option value="0">Not Completed</option>');
                                                select.append('<option value="1">Completed</option>');

                                                return select;
                                            },
                                            inputValue: function(input) {
                                                return $(input[0]).val();
                                            },
                                            isInputValid: function(input) {
                                                return $(input[0]).val() !== '';
                                            },
                                            search: function(value, comparison) {
                                                return value == comparison;
                                            },
                                            condition: 'Equals'
                                        }

                                    },
                                    "is_work_interest_completed": {

                                        is_work_interest_completed: {
                                            conditionName: 'Equals',
                                            init: function(that, column) {
                                                var select = $(
                                                        '<select id="is_work_interest_completed_id">')
                                                    .addClass('form-control')
                                                    .append('<option value="">Status</option>');


                                                select.append('<option value="0">Not Completed</option>');
                                                select.append('<option value="1">Completed</option>');

                                                return select;
                                            },
                                            inputValue: function(input) {
                                                return $(input[0]).val();
                                            },
                                            isInputValid: function(input) {
                                                return $(input[0]).val() !== '';
                                            },
                                            search: function(value, comparison) {
                                                return value == comparison;
                                            },
                                            condition: 'Equals'
                                        }

                                    },
                                    "is_cognitive_ability_completed": {

                                        is_cognitive_ability_completed: {
                                            conditionName: 'Equals',
                                            init: function(that, column) {
                                                var select = $(
                                                        '<select id="is_cognitive_ability_completed_id">')
                                                    .addClass('form-control')
                                                    .append('<option value="">Status</option>');


                                                select.append('<option value="0">Not Completed</option>');
                                                select.append('<option value="1">Completed</option>');

                                                return select;
                                            },
                                            inputValue: function(input) {
                                                return $(input[0]).val();
                                            },
                                            isInputValid: function(input) {
                                                return $(input[0]).val() !== '';
                                            },
                                            search: function(value, comparison) {
                                                return value == comparison;
                                            },
                                            condition: 'Equals'
                                        }

                                    },
                                    "technical_assessment_completed": {

                                        technical_assessment_completed: {
                                            conditionName: 'Equals',
                                            init: function(that, column) {
                                                var select = $(
                                                        '<select id="is_technical_assessment_completed_id">')
                                                    .addClass('form-control')
                                                    .append('<option value="">Status</option>');


                                                select.append('<option value="0">Not Completed</option>');
                                                select.append('<option value="1">Completed</option>');

                                                return select;
                                            },
                                            inputValue: function(input) {
                                                return $(input[0]).val();
                                            },
                                            isInputValid: function(input) {
                                                return $(input[0]).val() !== '';
                                            },
                                            search: function(value, comparison) {
                                                return value == comparison;
                                            },
                                            condition: 'Equals'
                                        }

                                    },
                                    "name_keyword": {

                                        name_keyword: {
                                            conditionName: 'Keyword',
                                            init: function(that, column) {
                                                var input = $('<input>')
                                                    .attr('type', 'text')
                                                    .attr('id', 'name_keyword')
                                                    .attr('name', 'name_keyword')
                                                    .addClass('form-control')
                                                    .attr('placeholder', 'Enter name');
                                                return input;
                                            },
                                            inputValue: function(input) {
                                                return $(input[0]).val();
                                            },
                                            isInputValid: function(input) {
                                                return $(input[0]).val() !== '';
                                            },
                                            search: function(value, comparison) {
                                                return value == comparison;
                                            },
                                            condition: 'Keyword'
                                        }

                                    },
                                    "position": {
                                        position: {
                                            conditionName: 'Position Name',
                                            init: function(that, column) {
                                                var select = $('<select id="position_id">')
                                                    .addClass('form-control select2')
                                                    .append('<option value="">Select Position</option>');

                                                      
                                                // Populate the select options with department data
                                                $.ajax({
                                                    url: '{{ route('admin.employee.positions.ajax') }}', // Endpoint to fetch departments
                                                    method: 'GET',
                                                    success: function(data) {
                                                        data.forEach(function(department) {
                                                            select.append(
                                                                '<option value="' +
                                                                department.id +
                                                                '">' + department
                                                                .title + '</option>');
                                                        });
                                                    }
                                                });
                                               
                                                return select;
                                            },
                                            inputValue: function(input) {
                                                return $(input[0]).val();
                                            },
                                            isInputValid: function(input) {
                                                return $(input[0]).val() !== '';
                                            },
                                            search: function(value, comparison) {
                                                return value == comparison;
                                            },
                                            condition: 'Position Name'
                                        }
                                    },
                                    "company": {
                                            keyword: {
                                                conditionName: 'Keyword',
                                                init: function () {
                                                return $('<input type="text" class="form-control dtsb-value" placeholder="Enter company name">');
                                                },
                                                inputValue: function (input) {
                                                return $(input[0]).val();
                                                },
                                                isInputValid: function (input) {
                                                return $(input[0]).val() !== '';
                                                },
                                                search: function (value, comparison) {
                                                if (!comparison) return true;
                                                return String(value).toLowerCase().includes(String(comparison).toLowerCase());
                                                },
                                                condition: 'Keyword'
                                            }
                                        },

                                    "age": {
                                        equals: {
                                            conditionName: 'Equals',
                                            init: () => $('<input type="number" class="form-control dtsb-value" placeholder="e.g. 30">'),
                                            inputValue: i => $(i[0]).val(),
                                            isInputValid: i => $(i[0]).val() !== '',
                                            search: (v, c) => parseInt(v,10) === parseInt(c,10)
                                        },
                                        not: {
                                            conditionName: 'Not',
                                            init: () => $('<input type="number" class="form-control dtsb-value" placeholder="e.g. 30">'),
                                            inputValue: i => $(i[0]).val(),
                                            isInputValid: i => $(i[0]).val() !== '',
                                            search: (v, c) => parseInt(v,10) !== parseInt(c,10)
                                        },
                                        less: {
                                            conditionName: 'Less Than',
                                            init: () => $('<input type="number" class="form-control dtsb-value" placeholder="< age">'),
                                            inputValue: i => $(i[0]).val(),
                                            isInputValid: i => $(i[0]).val() !== '',
                                            search: (v, c) => parseInt(v,10) < parseInt(c,10)
                                        },
                                        lessOrEqual: {
                                            conditionName: 'Less Than Equal To',
                                            init: () => $('<input type="number" class="form-control dtsb-value" placeholder="≤ age">'),
                                            inputValue: i => $(i[0]).val(),
                                            isInputValid: i => $(i[0]).val() !== '',
                                            search: (v, c) => parseInt(v,10) <= parseInt(c,10)
                                        },
                                        greaterOrEqual: {
                                            conditionName: 'Greater Than Equal To',
                                            init: () => $('<input type="number" class="form-control dtsb-value" placeholder="≥ age">'),
                                            inputValue: i => $(i[0]).val(),
                                            isInputValid: i => $(i[0]).val() !== '',
                                            search: (v, c) => parseInt(v,10) >= parseInt(c,10)
                                        },
                                        greater: {
                                            conditionName: 'Greater Than',
                                            init: () => $('<input type="number" class="form-control dtsb-value" placeholder="> age">'),
                                            inputValue: i => $(i[0]).val(),
                                            isInputValid: i => $(i[0]).val() !== '',
                                            search: (v, c) => parseInt(v,10) > parseInt(c,10)
                                        },
                                        between: {
                                            conditionName: 'Between',
                                            init: () => $('<div class="d-flex gap-2">\
                                                            <input type="number" class="form-control dtsb-value" placeholder="Min">\
                                                            <input type="number" class="form-control dtsb-value" placeholder="Max">\
                                                        </div>'),
                                            inputValue: i => {
                                            const $v = $(i[0]).find('input.dtsb-value');
                                            return [$v.eq(0).val(), $v.eq(1).val()];
                                            },
                                            isInputValid: i => {
                                            const $v = $(i[0]).find('input.dtsb-value');
                                            return $v.eq(0).val() !== '' && $v.eq(1).val() !== '';
                                            },
                                            search: (v, c) => {
                                            const val = parseInt(v,10), min = parseInt(c[0],10), max = parseInt(c[1],10);
                                            return !isNaN(val)&&!isNaN(min)&&!isNaN(max) && val >= min && val <= max;
                                            }
                                        },
                                        notBetween: {
                                            conditionName: 'Not Between',
                                            init: () => $('<div class="d-flex gap-2">\
                                                            <input type="number" class="form-control dtsb-value" placeholder="Min">\
                                                            <input type="number" class="form-control dtsb-value" placeholder="Max">\
                                                        </div>'),
                                            inputValue: i => {
                                            const $v = $(i[0]).find('input.dtsb-value');
                                            return [$v.eq(0).val(), $v.eq(1).val()];
                                            },
                                            isInputValid: i => {
                                            const $v = $(i[0]).find('input.dtsb-value');
                                            return $v.eq(0).val() !== '' && $v.eq(1).val() !== '';
                                            },
                                            search: (v, c) => {
                                            const val = parseInt(v,10), min = parseInt(c[0],10), max = parseInt(c[1],10);
                                            return !isNaN(val)&&!isNaN(min)&&!isNaN(max) && (val < min || val > max);
                                            }
                                        },
                                        isNull: {
                                            conditionName: 'Empty',
                                            init: () => $('<div class="small text-muted">No value needed</div>'),
                                            inputValue: () => null,
                                            isInputValid: () => true,
                                            search: v => v === null || v === '' || typeof v === 'undefined'
                                        },
                                        notNull: {
                                            conditionName: 'Not Empty',
                                            init: () => $('<div class="small text-muted">No value needed</div>'),
                                            inputValue: () => null,
                                            isInputValid: () => true,
                                            search: v => !(v === null || v === '' || typeof v === 'undefined')
                                        }
                                    },
                                    // "team": {
                                    //     position: {
                                    //         conditionName: 'Team Name',
                                    //         init: function(that, column) {
                                    //             var select = $('<select id="team_id">')
                                    //                 .addClass('form-control select2')
                                    //                 .append('<option value="">Select Team</option>');

                                                      
                                    //             // Populate the select options with department data
                                    //             $.ajax({
                                    //                 url: '{{ route('admin.employee.teams.ajax') }}', // Endpoint to fetch departments
                                    //                 method: 'GET',
                                    //                 success: function(data) {
                                    //                     data.forEach(function(department) {
                                    //                         select.append(
                                    //                             '<option value="' +
                                    //                             department.id +
                                    //                             '">' + department
                                    //                             .name + '</option>');
                                    //                     });
                                    //                 }
                                    //             });
                                               
                                    //             return select;
                                    //         },
                                    //         inputValue: function(input) {
                                    //             return $(input[0]).val();
                                    //         },
                                    //         isInputValid: function(input) {
                                    //             return $(input[0]).val() !== '';
                                    //         },
                                    //         search: function(value, comparison) {
                                    //             return value == comparison;
                                    //         },
                                    //         condition: 'Team Name'
                                    //     }
                                    // },
                                    "division": {
                                            division: {
                                                conditionName: 'Division Name',
                                                init: function () {
                                                var select = $('<select id="division_id">')
                                                    .addClass('form-control')
                                                    .append('<option value="">Select Division</option>');

                                                $.ajax({
                                                    url: '{{ route('admin.employee.divisions.ajax') }}',   // <-- uses your new route
                                                    method: 'GET',
                                                    success: function (data) {
                                                    (data || []).forEach(function (d) {
                                                        select.append('<option value="' + d.id + '">' + d.head_of_division + '</option>');
                                                    });
                                                    }
                                                });

                                                return select;
                                                },
                                                inputValue: function (input) { return $(input[0]).val(); },
                                                isInputValid: function (input) { return $(input[0]).val() !== ''; },
                                                search: function (value, comparison) { return value == comparison; },
                                                condition: 'Division Name'
                                            }
                                    },


                                    "gender": {

                                        gender: {
                                            conditionName: 'Select Gender',
                                            init: function(that, column) {
                                                var select = $(
                                                        '<select id="gender_id">')
                                                    .addClass('form-control')
                                                    .append('<option value="">Select Gender</option>');


                                                select.append('<option value="1">Female</option>');
                                                select.append('<option value="0">Male</option>');
                                                select.append('<option value="2">Not Filled</option>');
                                                return select;
                                            },
                                            inputValue: function(input) {
                                                return $(input[0]).val();
                                            },
                                            isInputValid: function(input) {
                                                return $(input[0]).val() !== '';
                                            },
                                            search: function(value, comparison) {
                                                return value == comparison;
                                            },
                                            condition: 'Select Gender'
                                        }

                                    },
                                    "email_keyword": {
                                        email_keyword: {
                                            conditionName: 'Keyword',
                                            init: function(that, column) {
                                                var input = $('<input>')
                                                    .attr('type', 'text')
                                                    .attr('id', 'email_keyword')
                                                    .attr('name', 'email_keyword')
                                                    .addClass('form-control')
                                                    .attr('placeholder', 'Enter email');
                                                return input;
                                            },
                                            inputValue: function(input) {
                                                return $(input[0]).val();
                                            },
                                            isInputValid: function(input) {
                                                return $(input[0]).val() !== '';
                                            },
                                            search: function(value, comparison) {
                                                return value == comparison;
                                            },
                                            condition: 'Keyword'
                                        }

                                    },
                                },
                            }
                        }
                    },
                    columnDefs: [
                        {
                            targets: -1,
                            visible: true
                        }
                    ],    
                orderCellsTop: true,
                fixedHeader: true,
                processing: true,
                serverSide: true,
                searching: false,
                scrollX: true,
                deferRender: true,
                scroller: true,
                responsive: true,
                paging: true, // Disable pagination
                ajax: {
                    url: "{{ route('admin.employee.users.ajax') }}",
                    data: function(d) {
                        d.searchBuilder = d.searchBuilder;
                        d.department_id = $('#department_id').val(); // Apply filter
                        d.division_id = $('#division_id').val();
                        d.is_personality_motivation_completed_id = $(
                            '#is_personality_motivation_completed_id').val();
                        d.is_work_interest_completed_id = $('#is_work_interest_completed_id').val();
                        d.is_cognitive_ability_completed_id = $('#is_cognitive_ability_completed_id').val();
                        d.is_technical_assessment_completed_id = $('#is_technical_assessment_completed_id')
                            .val();
                        d.name_keyword = $('#name_keyword').val();
                        d.position = $('#position_id').val();
                        // d.team = $('#team_id').val();
                        d.gender = $('#gender_id').val();
                        d.email_keyword = $('#email_keyword').val();
                        d.company_id = $('#company_id').val() || null;

                        const age = getAgeFilterFromSB_ForServer();
                        if (age) {
                        d.age_operator = age.op;
                        d.age_value    = age.value || null;
                        d.age_min      = age.min   || null;
                        d.age_max      = age.max   || null;
                        } else {
                        d.age_operator = d.age_value = d.age_min = d.age_max = null;
                        }

                    }
                },
                columns: [
                    {
                        data: 'name',
                        name: 'name',
                        searchBuilderType: 'name_keyword'
                    },
                    {
                        data: 'company_id',
                        name: 'company',
                        // orderable: false,
                        // searchable: false
                        searchBuilderType: 'company'
                    },
                    {
                        data: 'division_id',
                        name: 'division_id',
                        searchBuilderType: 'division'
                    },
                    {
                        data: 'department_id',
                        name: 'department_id',
                        searchBuilderType: 'custom'
                    },
                    {
                        data: 'position_id',
                        name: 'position_id',
                        searchBuilderType: 'position'
                    },
                    // {
                    //     data: 'team_id',
                    //     name: 'team_id',
                    //     searchBuilderType: 'team'
                    // },
                    {
                        data: 'age',
                        name: 'age',
                        searchBuilderType: 'age'
                    },
                    {
                        data: 'gender',
                        name: 'gender',
                        searchBuilderType: 'gender'
                        
                    },
                    {
                        data: 'email',
                        name: 'email',
                        searchBuilderType: 'email_keyword'
                    },
                    {
                        data: 'is_personality_motivation_completed',
                        name: 'is_personality_motivation_completed',
                        searchBuilderType: 'is_personality_motivation_completed'
                    },
                    {
                        data: 'is_work_interest_completed',
                        name: 'is_work_interest_completed',
                        searchBuilderType: 'is_work_interest_completed'
                    },
                    {
                        data: 'is_cognitive_ability_completed',
                        name: 'is_cognitive_ability_completed',
                        searchBuilderType: 'is_cognitive_ability_completed'
                    },
                    {
                        data: 'technical_assessment_completed',
                        name: 'technical_assessment_completed',
                        searchBuilderType: 'technical_assessment_completed'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
    </script>

@endsection
