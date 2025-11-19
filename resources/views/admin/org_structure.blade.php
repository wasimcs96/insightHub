@extends('admin.layout.app')

@section('title', 'Roles')

@section('styles')
    <style>
        #chart-container {
            font-family: Arial;
            height: 100%;
            border: 2px dashed #aaa;
            border-radius: 5px;
            overflow: auto;
            text-align: center;
        }

        .orgchart {
            background: #fff;
        }

        .orgchart td.left,
        .orgchart td.right,
        .orgchart td.top {
            border-color: #aaa;
        }

        .orgchart td>.down {
            background-color: #aaa;
        }

        .orgchart .middle-level .title {
            background-color: #006699;
        }

        .orgchart .middle-level .content {
            border-color: #006699;
        }

        .orgchart .product-dept .title {
            background-color: #009933;
        }

        .orgchart .product-dept .content {
            border-color: #009933;
        }

        .orgchart .rd-dept .title {
            background-color: rgb(247 147 30);
        }

        .orgchart .rd-dept .content {
            border-color: #f7941d !important;
        }

        .orgchart .pipeline1 .title {
            background-color: #996633;
        }

        .orgchart .pipeline1 .content {
            border-color: #996633;
        }

        .orgchart .frontend1 .title {
            background-color: #cc0066;
        }

        .orgchart .frontend1 .content {
            border-color: #cc0066;
        }

        #github-link {
            position: fixed;
            top: 0px;
            right: 10px;
            font-size: 3em;
        }

        .orgchart .node .title {
            background-color: #f7941d !important;
        }

        .orgchart .lines .downLine {
            background-color: Black !important;
        }

        .orgchart .lines .rightLine {
            border-right: 1px solid Black !important;

        }

        .orgchart .lines .leftLine {
            border-left: 1px solid Black !important;
        }

        .orgchart .lines .topLine {
            border-top: 2px solid black !important;
        }

        .orgchart .node .content {
            border: 1px solid rgb(0 0 0 / 80%) !important;
        }

        .orgchart .node .title {
            width: 100% !important;
        }

        .select2-container {
            z-index: 99999 !important;
        }

        .popup {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            z-index: 10000;
        }

        .popup.show {
            display: block;
        }

        .modal-backdrop {
            display: none;
        }

        /* .modal-body{
              height: 200px;
              overflow: scroll;
            } */
        .app-header {
            z-index: 7 !important;
        }

        .app-toolbar {
            z-index: 5 !important;
        }

        .modal-dialog {
            z-index: 9 !important;
        }

        .orgchart {
            height: 100% !important;
        }

        .form {
            justify-content: start;
            display: flex;
        }
        .fa-users{
            display: none !important;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.9/css/jquery.orgchart.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <a id="github-link" href="https://github.com/dabeng/OrgChart" target="_blank"><i class="fa fa-github-square"></i></a>

@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Organization - Chart
                </h1>
                <!--end::Title-->


                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">
                            Admin </a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        {{ $departmentDetail->name ?? '' }} </li>
                    <!--end::Item-->

                </ul>

                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <!-- <form action="{{ route('department_sections.index') }}" method="GET" class="d-flex align-items-center col-lg-8 justify-content-end">
                <div class="row w-100">
                    <div class="col-md-3">
                        <select name="division_id" id="division_id" class="form-control">
                            <option value="">All Divisions</option>
                            @foreach ($divisions as $division)
    <option value="{{ $division->id }}" {{ request('division_id') == $division->id ? 'selected' : '' }}>
                                    {{ $division->head_of_division }}
                                </option>
    @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="department_id" id="department_id" class="form-control">
                            <option value="">All Departments</option>
                            @foreach ($departments as $department)
    <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->head_of_department }}
                                </option>
    @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="name" class="form-control" placeholder="Search by Name" value="{{ request('name') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('department_sections.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form> -->
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        @if (request('department_id') && request('department_id') > 0)
            <div class="row mx-3">

                <div class="col-md-3" id="profile-icon" style="display:none;">

                </div>
                <div class="col-md-12" id="org_chart">
                    <div class="text-start d-flex justify-content-between">
                        @php
                            $vacancy = App\Models\OrganisationPosition::where('department_id', $departmentDetail->id)
                                ->where('job_id', '!=', null)
                                ->count();
                            $filled = App\Models\OrganisationPosition::where('department_id', $departmentDetail->id)
                                ->where('job_id', '!=', null)
                                ->where('user_id', '!=', null)
                                ->count();
 
                        @endphp
                        {{-- {{ dd($vacancy) }} --}}
                        <span class="fw-bold fa-1x">Filled/Vacant : {{ $filled }}/{{ $vacancy }}</span>
 
                        <div class="mb-3">
                            <td>Created Date: {{ \Carbon\Carbon::parse($create_at)->format('Y-m-d H:i:s') }}</td><br>
                            <td>Updated Date: {{ \Carbon\Carbon::parse($updated_at)->format('Y-m-d H:i:s') }}</td>
                        </div>
                    </div>
                    <div id="chart-container" class="card h-100" style="
                    background-image: linear-gradient(90deg, rgba(200, 0, 0, .15) 10%, rgba(0, 0, 0, 0) 10%), linear-gradient(rgba(200, 0, 0, .15) 10%, rgba(0, 0, 0, 0) 10%);
                    background-size: 10px 10px;
                "></div>
                </div>

            </div>
        @endif
    </div>

    <div class="modal fade" tabindex="-1" id="kt_modal_1">
        <div class="modal-dialog">
            <form action="{{ route('admin.employee.add_to_department') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Assign HOD</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon  btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <button type="button" class="border-0 bg-transparent" data-bs-dismiss="modal">
                                <iconify-icon icon="basil:cancel-outline" class="fa-1-5">
                                </iconify-icon>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">



                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="kt_modal_edit_1">
        <div class="modal-dialog">
            <form action="{{ route('admin.employee.add_to_department') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Assign HOD</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon  btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <button type="button" class="border-0 bg-transparent" data-bs-dismiss="modal">
                                <iconify-icon icon="basil:cancel-outline" class="fa-1-5">
                                </iconify-icon>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <!-- Modal body -->
                        {{-- <div class="p-6 space-y-4">
                

                    
                  <label class="required fs-6 fw-semibold mb-2">Department</label>
                  <select class="form-select form-select-solid" id="department" name="department_id" required>
                      <option value="">Select Department...</option>
                      @foreach ($departments as $department)
                          <option value="{{ $department->id }}">
                              {{ $department->head_of_department }}
                          </option>
                      @endforeach
                  </select>
              </div> --}}
                        <!-- Modal footer -->




                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.9/js/jquery.orgchart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        var employees = @json($employees);
        var departments = @json($departments);
    </script>
    <script>
        "use strict";

        (function($) {
            $(function() {
                var datascource = @json($dataSource);

                var oc = $("#chart-container").orgchart({
                    data: datascource,
                    nodeContent: "title",
                    createNode: function($node, data) {




                        //Start Update Selected Job Position in Popup
                        var $select = $($('#department_search-' + data.level + '-' + data.id));

                        var initialId = "{{ request('department_id') }}";

                        var initialName = data.department;

                        var position_id = data.job_id;


                        if (initialId) {
                            var option = new Option(initialName, initialId, true, true);
                            $select.append(option).trigger('change');
                            // if (position_id) {
                            $.ajax({
                                url: "/admin/jobs/allJobsByOrgDepartmentForJD",
                                method: 'GET',
                                data: {
                                    department_id: initialId
                                },
                                success: function(response) {
                                    // Update job descriptions dropdown options based on response
                                    var selectedVar = '';
                                    var options =
                                        '<option value="">Select Job Position</option>';
                                    var options2 =
                                        '<option value="">Select Job Position</option>';
                                    $.each(response, function(key, value) {
                                        var selectedVar = '';
                                        if (position_id && key == position_id) {
                                            selectedVar = 'selected';
                                        }
                                        options += '<option value="' + key +
                                            '"' + selectedVar + '>' + value +
                                            '</option>';
                                        options2 += '<option value="' + key +
                                            '">' + value + '</option>';

                                    });
                                    $('#job_search-' + data.level + '-' + data.id).html(
                                        options);
                                    $('#job_search_subordinates-' + data.level + '-' +
                                        data.id).html(options2);
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                            // }
                        }

                        //End Update Selected Job Position in Popup




                        var secondMenuIcon3 = $('<i>', {
                            'class': 'mx-3 fa fa-eye text-warning',
                            click: function() {
                                // $('#kt_modal_edit-'+data.level+'-'+data.id).modal('show');
                                // $('.hidden-data-'+data.level+'-'+data.id).append('<input type="hidden" name="id" value="'+data.id+'">')

                                $.ajax({
                                    url: '{{ route('admin.orgposition.employeesData') }}',
                                    method: 'GET',
                                    data: {
                                        user_id: data?.user_id
                                    },
                                    success: function(res) {
                                        $('#profile-icon').html(res).show();

                                        // Adjust the org chart to take up 9 columns instead of 12
                                        $('#org_chart').removeClass(
                                            'col-md-12').addClass(
                                            'col-md-9');
                                        // var employeeSelect = $('#employee-'+data.level+'-'+data.id);
                                        // employeeSelect.empty();
                                        // employeeSelect.append('<option value="" class="dark:bg-slate-700">Select Employee</option>');
                                        // res.forEach(function(employee) {
                                        //     var sel = employee.id == data.user_id ? 'selected':'';
                                        //     employeeSelect.append('<option value="' + employee.id + '" class="dark:bg-slate-700" '+sel+'>' + employee.name + '</option>');
                                        // });
                                        console.log(
                                        "=====================");
                                        console.log(res);
                                    }
                                });


                            }
                        });

                        $node.append(secondMenuIcon3);

                        //Action Icons Start
                        var secondMenuIcon = $('<i>', {
                            'class': 'fa fa-plus edit-btn text-success',
                            click: function() {
                                $('#kt_modal_add-' + data.level + '-' + data.id).modal(
                                    'show');

                                $.ajax({
                                    url: '{{ route('admin.orgposition.employeesGet') }}',
                                    method: 'GET',
                                    success: function(res) {
                                        var employeeSelect = $(
                                            '#employee_subordinates-' +
                                            data.level + '-' + data.id);
                                        employeeSelect.empty();
                                        employeeSelect.append(
                                            '<option value="" class="dark:bg-slate-700">Select Employee</option>'
                                            );
                                        res.forEach(function(employee) {
                                            employeeSelect.append(
                                                '<option value="' +
                                                employee.id +
                                                '" class="dark:bg-slate-700">' +
                                                employee.name +
                                                '</option>');
                                        });
                                    }
                                });

                            }
                        });

                        $node.append(secondMenuIcon);

                        var secondMenuIcon2 = $('<i>', {
                            'class': 'mx-3 fa fa-pencil edit-btn text-warning',
                            click: function() {
                                $('#kt_modal_edit-' + data.level + '-' + data.id).modal(
                                    'show');
                                $('.hidden-data-' + data.level + '-' + data.id).append(
                                    '<input type="hidden" name="id" value="' + data
                                    .id + '">')

                                $.ajax({
                                    url: '{{ route('admin.orgposition.employeesGet') }}',
                                    method: 'GET',
                                    data: {
                                        user_id: data?.user_id
                                    },
                                    success: function(res) {
                                        var employeeSelect = $(
                                            '#employee-' + data.level +
                                            '-' + data.id);
                                        employeeSelect.empty();
                                        employeeSelect.append(
                                            '<option value="" class="dark:bg-slate-700">Select Employee</option>'
                                            );
                                        res.forEach(function(employee) {
                                            var sel = employee.id ==
                                                data.user_id ?
                                                'selected' : '';
                                            employeeSelect.append(
                                                '<option value="' +
                                                employee.id +
                                                '" class="dark:bg-slate-700" ' +
                                                sel + '>' +
                                                employee.name +
                                                '</option>');
                                        });
                                    }
                                });


                            }
                        });

                        $node.append(secondMenuIcon2);




                        if (data?.children?.length == undefined && data?.parent_id != '') {
                            var secondMenuIcon1 = $('<i>', {
                                'class': 'mx-3 fa fa-minus edit-btn text-danger',
                                click: function() {
                                    var form = $('#form-' + data.id);
                                    event.preventDefault();
                                    swal({
                                            title: `Are you sure you want to delete this position?`,
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
                                }
                            });
                            $node.append(secondMenuIcon1);

                            // Remove Subordinates Modal Start
                            var modalHTML2 = `<form id="form-${data.id}" method="POST" action="{{ route('admin.orgposition.remove') }}">
                  @csrf
                  <input type="hidden" name="id" value="${data.id}">           
                  </form>`

                            $node.append(modalHTML2);

                            // Remove Subordinates Modal End
                        }
                        //Action Icons End



                        var dept_id = "{{ request('department_id') }}";

                        //Edit Position data popup start
                        const modalHTML = `<div class="modal fade" tabindex="-1" id="kt_modal_edit-${data.level+'-'+data.id}">
                                  <div class="modal-dialog ">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h3 class="modal-title">Position Details</h3>

                                              <!--begin::Close-->
                                              <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                  <iconify-icon icon="line-md:close" class="fs-1"></iconify-icon>
                                              </div>
                                              <!--end::Close-->
                                          </div>
                                          <form action="{{ route('admin.orgposition.store') }}" method="post">
                                              @csrf
                                              <div class="modal-body">
                                                <div class="hidden-data-${data.level+'-'+data.id}"></div>

                                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                                  <label for="position_title" class="fw-semibold d-flex fs-6 mb-2">Position Title</label>
                                                  <select id="job_search-${data.level+'-'+data.id}" custom1="${data.level+'-'+data.id}" class="form-control form-control-solid mb-3 mb-lg-0 job_search_data select-job" name="job_search" >
                                                        <option value="" class="dark:bg-slate-700">Select Job.</option>
                                                    </select>
                                                </div>  

                                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">

                                                  <label for="employee" class="fw-semibold fs-6 d-flex mb-2">Select Employee</label>
                                                  <select id="employee-${data.level+'-'+data.id}" class="form-control form-control-solid mb-3 mb-lg-0 employee-subordinates" data-placeholder="Select Employee" name="employee" >
                                                      <option value="" class="dark:bg-slate-700">Select Employee</option>

                                                  </select>
                                                </div>

                                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">

                                                    <label for="job_search" class="fw-semibold d-flex fs-6 mb-2">Position Level</label>
                                                    <input type="text" id="level-${data.level+'-'+data.id}" class="form-control form-control-solid mb-3 mb-lg-0 position_title" name="title"  placeholder="Enter Title" value="${data.position_name}" readonly>
                                                    

                                                </div>

                                                <input type="hidden" name="department_search" value="${dept_id}">

                                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                                    <label for="job_position_type" class="fw-semibold d-flex fs-6 mb-2">Select Position Type</label>
                                                    <select id="job_position_type" class="form-control form-control-solid mb-3 mb-lg-0" name="job_position_type" disabled>
                                                        <option value="" class="dark:bg-slate-700">Position Type</option>
                                                        <option value="hod" class="dark:bg-slate-700" ${data?.parent_id == '' ? 'selected':''}>Head of department</option>
                                                        <option value="employee" class="dark:bg-slate-700" ${data?.parent_id != '' ? 'selected':''}>Employee</option>
                                                    </select>
                                                </div>

                                                           <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                    <label for="additional_department_id" class="fw-semibold fs-6 mb-2 form">Additional Department</label>
                                    <select id="additional_department_id-${data.level+'-'+data.id}" class="form-control form-control-solid mb-3 mb-lg-0" name="additional_department_id">
                                        <option value="" disabled>Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" ${data.additional_department_id == '{{ $department->id }}' ? 'selected' : ''}>{{ $department->name }}</option>
                                        @endforeach
                                    </select> 
                                </div>

                                              </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                          </form>
                                      </div>
                                  </div>
                                </div>
                            `;

                        $node.append(modalHTML);

                        //Edit Position data popup End





                        //Add Subordinates Modal Start

                        const modalHTML1 = `<div class="modal fade" tabindex="-1" id="kt_modal_add-${data.level+'-'+data.id}">
                                  <div class="modal-dialog ">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h3 class="modal-title">Add Subordinate Position</h3>

                                              <!--begin::Close-->
                                              <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                  <iconify-icon icon="line-md:close" class="fs-1"></iconify-icon>
                                              </div>
                                              <!--end::Close-->
                                          </div>
                                          <form action="{{ route('admin.orgposition.add') }}" method="post">
                                              @csrf
                                              <div class="modal-body">
                                                <div class="hidden-kt_modal_add-data-${data.level+'-'+data.id}"></div>

                                                 <input type="hidden" name="parent_id" value="${data.id}" required>

                                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                                  <label for="position_title" class="fw-semibold fs-6 mb-2 d-flex">Position Title</label>
                                                  <select custom1="${data.level+'-'+data.id}" id="job_search_subordinates-${data.level+'-'+data.id}" class="form-control form-control-solid mb-3 mb-lg-0 job_search_data select-job" name="job_search_subordinates" >
                                                        <option value="" class="dark:bg-slate-700">Select Job.</option>
                                                    </select>
                                                  
                                                </div>  

                                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">

                                                  <label for="employee_subordinates" class="fw-semibold fs-6 mb-2 d-flex">Select Employee</label>
                                                  <select id="employee_subordinates-${data.level+'-'+data.id}" class="form-control form-control-solid mb-3 mb-lg-0 employee-subordinates" data-placeholder="Select Employee" name="employee_subordinates" >
                                                      <option value="" class="dark:bg-slate-700">Select Employee</option>
                                                      ${employees.map(employee => `<option value="${employee.id}" class="dark:bg-slate-700" >${employee.name ?? '-'}</option>`).join('')}
                                                  </select>
                                                </div>

                                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">

                                                    <label for="job_search_subordinates" class="fw-semibold fs-6 mb-2 d-flex">Position Level</label>
                                                    <input type="text" id="sub-level-${data.level+'-'+data.id}" class="form-control form-control-solid mb-3 mb-lg-0 position_title" name="position_title"  placeholder="Level" value="1" readonly>

                                                </div>

                                                <input type="hidden" name="department_search_subordinates" value="${dept_id}">

                                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                                                    <label for="job_position_type" class="fw-semibold fs-6 mb-2 d-flex">Position Type</label>
                                                    <select id="job_position_type" class="form-control form-control-solid mb-3 mb-lg-0" name="job_position_type" >
                                                        <option value="employee" class="dark:bg-slate-700">Employee</option>
                                                    </select>
                                                </div>

                                                                        <div class="fv-row mb-7 fv-plugins-icon-container col-lg-12">
                <label for="additional_department_id" class="fw-semibold fs-6 mb-2 form">Additional Department</label>
                <select id="additional_department_id" class="form-control form-control-solid mb-3 mb-lg-0" name="additional_department_id">
                    <option value="" disabled selected>Select Department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
                  </div>

                                              </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                          </form>
                                      </div>
                                  </div>
                                </div>
                            `;

                        $node.append(modalHTML1);


                        //Add Subordinates Modal End




                    }

                });
            });
        })(jQuery);
    </script>

    <script>
        $(document).ready(function() {

            $('.select-job').on('change', function() {
                // var savedJob = $('#toggle_select').val();
                var custom1 = $(this).attr('custom1');

                if (this.value) {
                    var ajaxUrl = "jobs/primary/job/select";
                    var formData = {
                        "_token": "{{ csrf_token() }}",
                        "id": this.value,
                        "savedJob": 3
                    };

                    $.ajax({
                        url: ajaxUrl,
                        data: formData,
                        method: "POST",
                        success: function(data) {
                            console.log(data);

                            $('#level-' + custom1).val(data.job.level);
                            $('#sub-level-' + custom1).val(data.job.level);

                        },
                        error: function(data) {
                            console.error("Error loading job data: ", data);
                        }
                    });
                }
            });

            $('.select-job2').on('change', function() {
                // var savedJob = $('#toggle_select').val();
                var custom1 = $(this).attr('custom1');

                if (this.value) {
                    var ajaxUrl = "jobs/primary/job/select";
                    var formData = {
                        "_token": "{{ csrf_token() }}",
                        "id": this.value,
                        "savedJob": 3
                    };

                    $.ajax({
                        url: ajaxUrl,
                        data: formData,
                        method: "POST",
                        success: function(data) {
                            console.log(data);

                            $('#sub-level-' + custom1).val(data.job.level);

                        },
                        error: function(data) {
                            console.error("Error loading job data: ", data);
                        }
                    });
                }
            });

            // $.ajax({
            //       url: "/admin/jobs/by_org_department"
            //       , method: 'GET'
            //       , data: {
            //           department_id: "{{ request('department_id') }}"
            //       }
            //       , success: function(response) {
            //           // Update job descriptions dropdown options based on response
            //           var options = '<option value="">Select Job Position</option>';
            //           $.each(response, function(key, value) {
            //               options += '<option value="' + key + '">' + value + '</option>';
            //           });
            //           $('.job_search_data').html(options);
            //       }
            //       , error: function(xhr, status, error) {
            //           console.error(xhr.responseText);
            //       }
            //   });

            $('.department_search_subordinates').on('change', function() {

                var custom1 = $(this).attr('custom1');

                var departmentId = $(this).val();

                var ajaxUrl = "/admin/jobs/allJobsByOrgDepartmentForJD";

                if (departmentId) {
                    $.ajax({
                        url: ajaxUrl,
                        method: 'GET',
                        data: {
                            department_id: departmentId
                        },
                        success: function(response) {
                            // Update job descriptions dropdown options based on response
                            var options = '<option value="">Select Job Position</option>';
                            $.each(response, function(key, value) {
                                options += '<option value="' + key + '">' + value +
                                    '</option>';
                            });
                            $('#job_search_subordinates-' + custom1).html(options);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });

            $('.select-job').select2({

            });

            $('.select-job2').select2({

            });

            $('.employee-subordinates').select2({

            });

            $('.modal').modal({
                backdrop: 'static',
                keyboard: false,
                focus: false
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            function initSelect2(selector) {

                $(selector).select2({

                    ajax: {
                        url: '{{ route('admin.departments-filter.search') }}', // Change to your actual API endpoint
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data.results,
                                pagination: {
                                    more: data.pagination.more
                                }
                            };
                        },
                        cache: true
                    },
                    placeholder: 'Search for a department',
                    minimumInputLength: 1
                });
            }

            //   var skillSelect = $('#employee')

            // initSelect2(skillSelect);
        });
    </script>
@endsection
