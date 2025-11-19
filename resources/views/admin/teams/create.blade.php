@extends('admin.layout.app')

@section('title', 'Teams')
@section('styles')

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
            <h1
                class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                {{ $type ?? 'employee' }}
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
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.teams.index') }}" class="capitalize text-muted text-hover-primary">
                        Teams
                    </a>
                </li>
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    {{ !empty($team) ? 'Edit Team' : 'Create Team' }} </li>
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
    <!--end::Toolbar container-->
</div>

<!--begin::Content-->
<div id="kt_app_content" class="app-content  flex-column-fluid ">


    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container  container-xxl ">
        <div class=" card ">

            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                data-bs-target="#kt_account_profile_details" aria-expanded="true"
                aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">{{ !empty($team) ? 'Edit Team' : 'Create Team' }}</h3>
                </div>
                <!--end::Card title-->
            </div>
            <div class="card-body">

                <form class="form" action="/admin/teams/{{ !empty($team) ? $team->id . '/update' : 'store' }}" method="POST"
                    enctype="multipart/form-data" >
                    @csrf


                    <!--begin::Input group-->


                    <div class="fv-row mb-7 row">

                        <!--begin::Label-->



                        <div class="col-lg-4">
                            <label class="required fw-semibold fs-6 mb-2">Team Title</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="title"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('title') is-invalid @enderror"
                                value="{{ !empty($team) ? $team->name : old('title') }}" placeholder="Full name" />
                            @error('position_name')
                            <div class="invalid-feedback text-red-500">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-4 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Department</label>

                            <select class="form-select form-select-solid" id="department" data-control="select2"
                                data-hide-search="false" data-placeholder="Select a Department" name="department">
                                <option value="">Select Department...</option>

                                @foreach($departments as $department)
                                <option value="{{ $department->id }}" @if(!empty($team) && $team->department_id == $department->id) selected="selected" @endif>{{ $department->head_of_department ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!--begin::Label-->
                        {{-- <div class="col-md-4 fv-row">
                            @if(!empty($team))
                            @php
                            $selectedemp = $team->teamEmployees->pluck('employee_id')->toarray();
                            $employees = App\Models\User::where('department_id',$team->department_id)->get();
                            @endphp
                            @endif
                            <label class="required fs-6 fw-semibold mb-2">Employee</label>
                            <select class="form-select" id="employee" name="employee[]" data-control="select2"
                                data-close-on-select="false" data-placeholder="Select an option" data-allow-clear="true"
                                multiple="multiple">
                            @if(!empty($team))

                                @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" @if(!empty($selectedemp) && in_array($employee->id, $selectedemp)) selected="selected" @endif>{{ $employee->name }}</option>
                            @endforeach
                            @endif
                            </select>
                        </div> --}}

                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->


                    <!--end::Scroll-->

                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                        {{-- <button type="reset" class="btn-closes btn btn-light me-3" data-bs-dismiss="modal">

                            Discard
                        </button> --}}

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
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#department').change(function() {
            var departId = $(this).val();
            console.log(departId);
            $.ajax({
                url: '/admin/teams/getemployee/' + departId,
                type: 'GET',
                success: function(response) {
                    $('#employee').empty();
                    $.each(response, function(key, value) {
                        $('#employee').append('<option value="' + key + '">' + value + '</option>');
                    });
                    // Trigger Select2 to update the UI
                    $('#employee').trigger('change');
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        });

        // Initialize Select2 for the employee dropdown
        $('#employee').select2({
            placeholder: "Select anasdsa option",
            allowClear: true,
            closeOnSelect: false
        });
    });
</script>


@endsection
