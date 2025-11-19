@extends('admin.layout.app')

@section('title', 'Create Technical Question')

@section('styles')
{{-- Uncomment if needed --}}
{{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}
@endsection

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}" class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Technical Assessment Create
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Home </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/technical/assessment/index" class="capitalize text-muted text-hover-primary">
                        My Assessment
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    {{ !empty($user) ? 'Edit Survey' : 'Create Assessment' }}
                </li>
            </ul>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <a href="{{ route('technicalAss.index') }}" class="btn btn-primary d-flex align-items-center">
                    <iconify-icon icon="weui:back-filled"></iconify-icon>
                    Back To List
                </a>
            </div>
        </div>
    </div>
</div>


<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-body">
                <form class="form" action="{{ route('technicalAss.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                   
                        <div class="row mb-7">

    <!-- Business Unit -->
    <div class="col-lg-6">
        <label class="fw-semibold fs-6 mb-2 form-label">Business Unit</label>
        <select id="business_unit" name="business_unit_id"
            class="form-control form-control-solid">
            <option value="">Select Business Unit</option>
            @foreach($businessUnits as $bu)
                <option value="{{ $bu->id }}">{{ $bu->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Company / Division -->
    <div class="col-lg-6">
        <label class="fw-semibold fs-6 mb-2 form-label">Company / Division</label>
        <select id="company" name="company_id"
            class="form-control form-control-solid" disabled>
            <option value="">Select Company/Division</option>
        </select>
    </div>
</div>

<div class="row mb-7">
    <!-- Department -->
    <div class="col-lg-6">
        <label class="fw-semibold fs-6 mb-2 form-label">Department</label>
        <select id="department" name="department_id"
            class="form-control form-control-solid" disabled>
            <option value="">Select Department</option>
        </select>
    </div>

    <!-- Job Position -->
    <div class="col-lg-6">
        <label class="fw-semibold fs-6 mb-2 form-label">Job Position</label>
        <select id="job" name="job_id"
            class="form-control form-control-solid" disabled>
            <option value="">Select Job Position</option>
        </select>
    </div>
</div>
                   

                    <!-- Technical Question Button -->
                 @include('admin.technical.question')
                 {{-- @include('admin.technical.option') --}}


                

                 <div class="mt-25">
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-sm btn-primary mb-3 add-both-btn">
                            <i class="fas fa-plus-circle"></i> {{ trans('Add Technical Question') }}
                        </button>
                    </div>
                </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <button type="submit" class="btn btn-sm btn-primary mb-3">{{ trans('Create Question') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#department').on('change', function() {
            var departmentId = $(this).val();
            
            // Clear the previous jobs in the job select box
            $('#job').html('<option value="">Select Job</option>');

            if (departmentId) {
                $.ajax({
                    url: '/admin/get-jobs-by-department/' + departmentId, // Route to get jobs based on department
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Populate the job dropdown with the fetched jobs
                        $.each(data, function(key, job) {
                            $('#job').append('<option value="'+ job.id +'">'+ job.title +'</option>');
                        });
                    },
                    error: function() {
                        alert('Could not fetch jobs.');
                    }
                });
            }
        });
    });
</script>

<script>
$(document).ready(function () {

    $("#company").prop("disabled", true);
    $("#department").prop("disabled", true);
    $("#job").prop("disabled", true);

    $(".add-both-btn").prop("disabled", true);
    $("button[type='submit']").prop("disabled", true);

    // Step 1 — Business Unit → Division
    $("#business_unit").on("change", function () {
        let bu = $(this).val();

        $("#company").html('<option value="">Select Company/Division</option>').prop("disabled", true);
        $("#department").html('<option value="">Select Department</option>').prop("disabled", true);
        $("#job").html('<option value="">Select Job Position</option>').prop("disabled", true);

        $(".add-both-btn").prop("disabled", true);
        $("button[type='submit']").prop("disabled", true);

        if (bu) {
            $.get('/admin/get-companies-by-bu/' + bu, function (data) {
                $.each(data, function (i, division) {
                    $("#company").append(`<option value="${division.id}">${division.head_of_division}</option>`);
                });
                $("#company").prop("disabled", false);
            });
        }
    });

    // Step 2 — Division → Department
    $("#company").on("change", function () {
        let division = $(this).val();

        $("#department").html('<option value="">Select Department</option>').prop("disabled", true);
        $("#job").html('<option value="">Select Job Position</option>').prop("disabled", true);

        $(".add-both-btn").prop("disabled", true);
        $("button[type='submit']").prop("disabled", true);

        if (division) {
            $.get('/admin/get-departments-by-company/' + division, function (data) {
                $.each(data, function (i, dept) {
                    $("#department").append(`<option value="${dept.id}">${dept.name}</option>`);
                });
                $("#department").prop("disabled", false);
            });
        }
    });

    // Step 3 — Department → Job Position
    $('#department').on('change', function() {
    var departmentId = $(this).val(); // Get the department ID
    
    // Clear the previous jobs in the job select box
    $('#job').html('<option value="">Select Job</option>');

    if (departmentId) {
        $.ajax({
            url: '/admin/get-jobs-by-department/' + departmentId, // Correct route
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // Populate the job dropdown with the fetched jobs
                $.each(data, function(key, job) {
                    $('#job').append('<option value="'+ job.id +'">'+ job.title +'</option>');
                });
                $('#job').prop('disabled', false);
            },
            error: function() {
                alert('Could not fetch jobs.');
            }
        });
    }
});



    // Step 4 — Enable Add Technical Question
    $("#job").on("change", function () {
        if ($(this).val()) {
            $(".add-both-btn").prop("disabled", false);
        } else {
            $(".add-both-btn").prop("disabled", true);
        }
    });

    // Step 5 — Enable Create Assessment only after adding question
    $(document).on("click", ".add-both-btn", function () {
        $("button[type='submit']").prop("disabled", false);
    });

});
</script>


@endsection