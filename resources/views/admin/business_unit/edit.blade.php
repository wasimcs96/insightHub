@extends('admin.layout.app')

@section('title', 'Business Unit')
@section('styles')
    <style>
        .image-input-placeholder {
            background-image: url({{ asset('admin/media/svg/files/blank-image.svg') }});
        }

        [data-bs-theme="dark"] .image-input-placeholder {
            background-image: url({{ asset('admin/media/svg/files/blank-image-dark.svg') }});
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
                    Business Unit
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
                        <a href="/admin/users" class="text-muted text-hover-primary">
                            Business Unit
                        </a>
                    </li>
                    <!--end::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">

                        Edit

                    </li>

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
            <form class="form" action="/admin/user/update/{{ $business->id }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="role" value="{{ $type ?? 'employee' }}">

                <!--begin::Scroll-->
                <div class=" ">
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="d-block fw-semibold fs-6 mb-5">Avatar</label>
                        <!--end::Label-->


                        <!--begin::Image placeholder-->

                        <!--end::Image placeholder-->
                        <!--begin::Image input-->
                        <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                            <!--begin::Preview existing avatar-->
                            <div class="image-input-wrapper w-125px h-125px"
                                @if (isset($business->profile_picture)) style="background-image: url('{{ asset($business->profile_picture) }}');"
                        @else
                        style="background-image: url('{{ asset('images/default-user.svg') }}');" @endif>
                            </div>
                            <!--end::Preview existing avatar-->

                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                <iconify-icon icon="heroicons-outline:pencil-alt" class="fa-1-5"></iconify-icon>
                                <!--begin::Inputs-->
                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg"
                                    value="{{ old('avatar') }}" />
                                <input type="hidden" name="avatar_remove" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->

                            <!--begin::Cancel-->
                            {{-- <span
                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                            title="Cancel avatar">
                            <iconify-icon icon="iconoir:cancel" class="fa-1-5">
                            </iconify-icon>
                        </span>
                        <!--end::Cancel-->

                        <!--begin::Remove-->
                        <span
                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                            title="Remove avatar">
                            <iconify-icon icon="iconoir:cancel" class="fa-1-5">
                            </iconify-icon>

                        </span> --}}
                            <!--end::Remove-->
                        </div>
                        <!--end::Image input-->

                        <!--begin::Hint-->
                        <div class="form-text  @error('avatar') is-invalid @enderror">Allowed file types: png,
                            jpg, jpeg.</div>
                        @error('avatar')
                            <div class="invalid-feedback text-red-500">
                                {{ $message }}
                            </div>
                        @enderror
                        <!--end::Hint-->
                    </div>

                           <!--begin::Input group-->
                           <div class="fv-row mb-7 row">
                            <!--begin::Label-->
                            <div class="col-md-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Role</label>

                                <select class="form-select form-select-solid" id="role" data-control="select2" data-hide-search="false" data-placeholder="Select a Role" name="role_id">
                                    <option value="">Select Role...</option>

                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->caption ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label class="required fw-semibold fs-6 mb-2">First
                                    Name</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <input type="text" name="first_name"
                                    class="form-control form-control-solid mb-3 mb-lg-0 @error('first_name') is-invalid @enderror"
                                    value="{{ $business->first_name ?? '' }}" placeholder="Full name" />
                                @error('first_name')
                                    <div class="invalid-feedback text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-lg-4">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Last
                                    Name</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <input type="text" name="last_name"
                                    class="form-control form-control-solid mb-3 mb-lg-0 @error('last_name') is-invalid @enderror"
                                    placeholder="Full name" value="{{ $business->last_name ?? '' }}" />

                                @error('last_name')
                                    <div class="invalid-feedback text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <!--end::Input-->
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                    <!--end::Input group-->
                    <div class="fv-row mb-7 row">
                        <!--begin::Label-->

                            <div class="col-md-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Company</label>

                                <select class="form-select form-select-solid" id="company" data-control="select2" data-hide-search="false" data-placeholder="Select a Company" name="company">
                                    <option value="">Select Company...</option>

                                    @foreach($company as $com)
                                    <option value="{{ $com->id }}" @if($com->id == $business->company_id) selected @endif>{{ $com->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Department</label>

                                <select class="form-select form-select-solid" id="department" data-control="select2" data-hide-search="true" data-placeholder="Select a Department" name="department">
                                    <option value="{{ $business->department_id ?? '' }}" selected>{{ $business->department->name ?? 'Select Department' }}</option>

                                </select>
                            </div>

                            <div class="col-md-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Position</label>

                                <select class="form-select form-select-solid" id="positions" data-control="select2" data-hide-search="true" data-placeholder="Select a Team Member" name="position">

                                    <option value="{{ $business->department_id ?? '' }}" selected>{{ $business->job_position->title ?? 'Select Position' }}</option>

                                </select>
                            </div>

                        <!--end::Input-->
                    </div>


                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">Email</label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <input type="email" name="email"
                            class="form-control form-control-solid mb-3 mb-lg-0 @error('email') is-invalid @enderror"
                            placeholder="example@domain.com" value="{{ $business->email ?? '' }}" />
                        @error('email')
                            <div class="invalid-feedback text-red-500">
                                {{ $message }}
                            </div>
                        @enderror
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    {{-- <div class="mb-5">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-5">Role</label>
                        <!--end::Label-->

                        <!--begin::Roles-->
                        <!--begin::Input row-->
                        <div class="row">
                            <div class="d-flex fv-row col-lg-6">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3 @error('role_name') is-invalid @enderror"
                                        @if ($business->role_id == 1) checked="checked" @endif name="role_name"
                                        type="radio" value="1" />
                                    <!--end::Input-->

                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_update_role_option_0">
                                        <div class="fw-bold text-gray-800">
                                            Administrator</div>
                                        <div class="text-gray-600  @error('role_name') is-invalid @enderror">Best for
                                            business owners and company
                                            administrators</div>
                                        @error('role_name')
                                            <div class="invalid-feedback text-red-500">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </label>

                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Input row-->

                            <div class="d-flex fv-row col-lg-6">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="role_name" type="radio" value="2"
                                        @if ($business->role_id == 2) checked="checked" @endif
                                        id="kt_modal_update_role_option_1" />
                                    <!--end::Input-->

                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_update_role_option_1">
                                        <div class="fw-bold text-gray-800">
                                            User</div>
                                        <div class="text-gray-600">Best for User to submit
                                            assessment</div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                        </div>

                        <!--end::Input row-->

                        <div class='separator separator-dashed my-5'>
                        </div>
                        <!--begin::Input row-->
                        <div class="row">

                            <div class="d-flex fv-row col-lg-6">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="role_name" type="radio" value="3"
                                        @if ($business->role_id == 3) checked="checked" @endif
                                        id="kt_modal_update_role_option_2" />
                                    <!--end::Input-->

                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_update_role_option_2">
                                        <div class="fw-bold text-gray-800">
                                            HOD</div>
                                        <div class="text-gray-600">Best for
                                            people who need full access to
                                            analytics data, but don't need
                                            to update business settings
                                        </div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Input row-->
                            <div class="d-flex fv-row col-lg-6">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="role_name" type="radio" value="4"
                                        @if ($business->role_id == 4) checked="checked" @endif
                                        id="kt_modal_update_role_option_4" />
                                    <!--end::Input-->

                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_update_role_option_4">
                                        <div class="fw-bold text-gray-800">
                                            External Business Unit</div>
                                        <div class="text-gray-600">Best for
                                            people who need to preview
                                            content data, but don't need to
                                            make any updates</div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                        </div>
                    </div> --}}
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mt-5">
                        <div class="mb-10 fv-row col-lg-6 mt-5" data-kt-password-meter="true">
                            <!--begin::Wrapper-->
                            <div class="mb-1 ">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold fs-6 mb-2">
                                    Password
                                </label>
                                <!--end::Label-->

                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input class="form-control form-control-lg form-control-solid " type="password"
                                        placeholder="" name="password" autocomplete="off" />

                                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                        data-kt-password-meter-control="visibility">

                                        {{-- <i class="ki-duotone ki-eye-slash fs-1"><span
                                        class="path1"></span><span
                                        class="path2"></span><span
                                        class="path3"></span><span class="path4"></span></i> --}}
                                        <i class="ki-eye-slash">
                                            <iconify-icon icon="ph:eye-slash"
                                                class=" ki-duotone ki-eye-slash fa-1-5"></iconify-icon>
                                        </i>



                                        {{-- <i class="ki-duotone ki-eye d-none fs-1"><span
                                        class="path1"></span><span
                                        class="path2"></span><span class="path3"></span></i> --}}
                                        <i class=" d-none ">
                                            <iconify-icon icon="mdi:eye-outline"
                                                class="ki-duotone ki-eye fa-1-5"></iconify-icon>
                                        </i>
                                    </span>

                                </div>
                                <!--end::Input wrapper-->

                                <!--begin::Meter-->
                                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                    </div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                    </div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                    </div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px">
                                    </div>
                                </div>
                                <!--end::Meter-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Hint-->
                            <div class="text-muted">
                                Use 8 or more characters with a mix of letters, numbers & symbols.
                            </div>
                            <!--end::Hint-->
                        </div>
                        <!--end::Input group--->
                        <!--begin::Input group--->
                        <div class="fv-row mb-10 col-lg-6 mt-5">
                            <label class="form-label fw-semibold fs-6 mb-2">Confirm Password</label>

                            <input
                                class="form-control form-control-lg form-control-solid  @error('password') is-invalid @enderror"
                                type="password" placeholder="" name="password_confirmation" autocomplete="off" />
                            @error('password')
                                <div class="invalid-feedback text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <!--end::Input group--->
                </div>
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


@endsection
@section('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#company').change(function() {
            var companyId = $(this).val();
            $.ajax({
                url: '/departments/' + companyId,
                type: 'GET',
                success: function(response) {
                    $('#department').empty();
                    $('#positions').empty();

                    $.each(response, function(key, value) {
                        $('#department').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#department').change(function() {
            var departId = $(this).val();
            console.log(departId);
            $.ajax({
                url: '/postions/' + departId,
                type: 'GET',
                success: function(response) {
                    $('#positions').empty();
                    $.each(response, function(key, value) {
                        $('#positions').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        });
    });
</script>

@endsection
