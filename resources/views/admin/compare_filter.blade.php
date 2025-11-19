@extends('admin.layout.app')

@section('title', 'Roles')

@section('styles')
  <style>
    .displayNone {
      display: none;
     }
  </style>
@endsection

@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">

            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Dashboard
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
                        Compare </li>
                    <!--end::Item-->

                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->

            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">

        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <div class="card card-xl-stretch mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-1 mb-1">Compare (Analytics)</span>

                    </h3>
                </div>
                <div class="card-body px-6 pb-6">

                    <form class="form" action="{{ route('admin.analytical.compareForm') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Input group-->
                        <div class="fv-row mb-7 row">

                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Select Pool</label>
                                <select class="form-select form-select-solid" id="pool" placeholder="Select a Pool" name="pool">
                                    <option value="employees">Employees</option>
                                    <option value="departments">Departments</option>
                                </select>
                            </div>

                            <div class="col-lg-6" id="departmentForEmployeeDiv">
                                <label class="required fw-semibold fs-6 mb-2">Select Department</label>
                                <select class="form-select form-select-solid" id="department_for_employee" data-control="select2"
                                   data-hide-search="false" data-placeholder="Select a Department" name="department_for_employee">
                                   <option value="">Select a Department</option>
                                   @foreach($departments as $key => $department)
                                        <option value="{{ $department->id }}"> {{ $department->head_of_department ?? '' }} </option>
                                   @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6 mt-10" id="employeesDiv">
                                <label class="required fw-semibold fs-6 mb-2">Select Employees</label>
                                <select class="form-select form-select-solid" id="employees" data-control="select2"
                                       data-hide-search="false" data-placeholder="Select Department First" multiple="multiple" name="employees[]">
                                    <option disabled>Select Department First</option>
                                </select>
                            </div>

                            <div class="col-lg-6 displayNone" id="departmentsDiv">
                                <label class="required fw-semibold fs-6 mb-2">Select Departments</label>
                                <select class="form-select form-select-solid" id="departments" data-control="select2"
                                   data-hide-search="false" data-placeholder="Select Departments" multiple="multiple" name="departments[]">
                                   @foreach($departments as $key => $department)
                                        <option value="{{ $department->id }}"> {{ $department->head_of_department ?? '' }} </option>
                                   @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="text-lg-end pt-10">
                            <button class="btn btn-primary" type="submit">
                                <span class="indicator-label">
                                    Compare
                                </span>
                                <span class="indicator-progress">
                                    Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </form>

                </div>

            </div>
            <!--end::Form-->
        </div>
    </div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#department_for_employee').select2({
            placeholder: "Select a Department",
            allowClear: true
        });

        $('#departments').select2({
            maximumSelectionLength: 2,
            placeholder: "Select Departments",
            allowClear: true
        });

        $('#employees').select2({
            maximumSelectionLength: 5,
            placeholder: "Select Employees",
            allowClear: true
        });

        // Trigger change event on initial load
        $('#pool').trigger('change');

        $('#department_for_employee').on('change', function() {
            var selectedDepartment = $(this).val();
            filterEmployeesByDepartment(selectedDepartment);
        });
    });

    document.getElementById("pool").addEventListener("change", function() {
        var value = this.value;
        var departmentsDiv = document.getElementById("departmentsDiv");
        var employeesDiv = document.getElementById("employeesDiv");
        var departmentForEmployeeDiv = document.getElementById("departmentForEmployeeDiv");

        if (value == "departments") {
            departmentForEmployeeDiv.classList.add("displayNone");
            employeesDiv.classList.add("displayNone");
            departmentsDiv.classList.remove("displayNone");
        } else if (value == "employees") {
            departmentForEmployeeDiv.classList.remove("displayNone");
            employeesDiv.classList.remove("displayNone");
            departmentsDiv.classList.add("displayNone");
        } else {
            departmentForEmployeeDiv.classList.remove("displayNone");
            employeesDiv.classList.remove("displayNone");
            departmentsDiv.classList.add("displayNone");
        }
    });

    function filterEmployeesByDepartment(department) {
        $.ajax({
            url: '{{ route("admin.getEmployeesByDepartment") }}', // Make sure to define this route in your web.php
            type: 'GET',
            data: {department: department},
            success: function(response) {
                var employeesSelect = $('#employees');
                employeesSelect.empty();
                response.employees.forEach(employee => {
                    employeesSelect.append(new Option(employee.first_name + ' ' + employee.last_name, employee.id));
                });
                employeesSelect.trigger('change'); // Refresh the select2 list
            }
        });
    }
</script>
@endsection
