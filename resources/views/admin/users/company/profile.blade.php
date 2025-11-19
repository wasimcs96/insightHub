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
                    Profile
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
                            Profile
                        </a>
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
            <form class="form" action="/company/profile/update" method="POST"
                enctype="multipart/form-data">
                @csrf


                <!--begin::Scroll-->
                <div class="card card-body ">
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="d-block fw-semibold fs-6 mb-5">Company Logo</label>
                        <!--end::Label-->


                        <!--begin::Image placeholder-->

                        <!--end::Image placeholder-->
                        <!--begin::Image input-->
                        <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                            <!--begin::Preview existing avatar-->
                            <div class="image-input-wrapper w-125px h-125px"
                            {{-- {{    dd($user->profile_picture)}} --}}
                                @if (isset($user->profile_picture))
                                style="background-image: url('{{ asset($user->profile_picture) }}');"
                        @else
                        style="background-image: url('{{ $user->profile_picture ? env('APP_URL') . '/' . $user->profile_picture : asset('images/default-user.svg') }}');" @endif>
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
                    <!--end::Input group-->


                    <div class="fv-row mb-7 row">
                        <!--begin::Label-->
                        <div class="col-lg-3">
                            <label class="required fw-semibold fs-6 mb-2">Company Name</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="company_name"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('company_name') is-invalid @enderror"
                                value="{{ $user->userCompany->name ?? '' }}" placeholder="Company name" />
                            @error('company_name')
                                <div class="invalid-feedback text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-lg-3">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Company Contact Number</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="company_mobile_number"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('company_mobile_number') is-invalid @enderror"
                                placeholder="Mobile Number" value="{{ $user->userCompany->mobile_number ?? '' }}" />

                            @error('company_mobile_number')
                                <div class="invalid-feedback text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror
                            <!--end::Input-->
                        </div>

                        <div class="col-lg-3">
                            <label class="required fw-semibold fs-6 mb-2">Company Email</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="company_email"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('company_email') is-invalid @enderror"
                                value="{{ $user->userCompany->email ?? '' }}" placeholder="Enter Company Email" />
                            @error('company_email')
                                <div class="invalid-feedback text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="col-lg-3">
                            <label class="required fw-semibold fs-6 mb-2">Company Website</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="url" name="website"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('website') is-invalid @enderror"
                                value="{{ $user->userCompany->website ?? '' }}" placeholder="Company Website" />
                            @error('website')
                                <div class="invalid-feedback text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                    <div class="fv-row mb-7 row">
                        <!--begin::Label-->
                       
                        <div class="col-lg-4">
                            <!--begin::Label-->
        
                                <label class="required fw-semibold fs-6 mb-2">Industry/Sector</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                
                                    <select class="form-select form-select-solid  @error('sector_id') is-invalid @enderror" data-close-on-select="false"
                                        data-placeholder="Select Sector" id="sector_id" name="sector_id" data-allow-clear="true">

                                        <option selected="Selected" value=""
                                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            Select Sector</option>
                                            @foreach ($sector as $value)
                                            <option value="{{ $value->id}}"
                                                @if ($user->userCompany && $user->userCompany->sector_id == $value->id) Selected @endif>{{ $value->name ?? '' }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('sector_id')
                                    <div class="invalid-feedback text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>

                        <div class="col-lg-4">
                            <!--begin::Label-->
                            
        
                                <label class="required fw-semibold fs-6 mb-2">Sub Sector</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                
                                    <select class="form-select form-select-solid  @error('sub_sector_id') is-invalid @enderror" data-close-on-select="false"
                                        data-placeholder="Select Sector" id="sub_sector_id" name="sub_sector_id" data-allow-clear="true">

                                        <option selected="Selected" value="{{ $user->userCompany->subSector->id ?? ' Select Sub Sector' }}" class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">{{ $user->userCompany->subSector->name ?? ' Select Sub Sector' }}</option>
                                        </select>

                                    @error('sub_sector_id')
                                    <div class="invalid-feedback text-red-500">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>

                        <div class="col-lg-4">
                            <label class="required fw-semibold fs-6 mb-2">Company Address</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="company_address"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('company_address') is-invalid @enderror"
                                value="{{ $user->userCompany->address ?? '' }}" placeholder="Person In Charge" />
                            @error('company_address')
                                <div class="invalid-feedback text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>




                    <h3 class="mt-4 mb-4">Admin Login Details</h3>


                    <!--begin::Input group-->
                    <div class="fv-row mb-7 row">
                        <!--begin::Label-->
                        <div class="col-lg-4">
                            <label class="required fw-semibold fs-6 mb-2">Admin Name</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="first_name"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('first_name') is-invalid @enderror"
                                value="{{ $user->first_name ?? '' }}" placeholder="Full name" />
                            @error('first_name')
                                <div class="invalid-feedback text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-lg-4">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Admin Email</label>
                            <!--end::Label-->
    
                            <!--begin::Input-->
                            <input type="email" name="email"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('email') is-invalid @enderror"
                                placeholder="example@domain.com" value="{{ $user->email ?? '' }}" />
                            @error('email')
                                <div class="invalid-feedback text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror
                            <!--end::Input-->
                        </div>

                        <div class="col-lg-4">
                            <label class="required fw-semibold fs-6 mb-2">Admin Mobile Number</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="number" name="mobile_number"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('mobile_number') is-invalid @enderror"
                                value="{{ $user->mobile_number ?? '' }}" placeholder="Enter Mobile Number" />
                            @error('mobile_number')
                                <div class="invalid-feedback text-red-500">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>
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
                </div>
                <!--end::Scroll-->

            </form>
        </div>
    </div>


@endsection
@section('scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#sector_id').change(function() {
            var departId = $(this).val();
            
            $.ajax({
                url: '/company/get/subsector/' + departId,
                type: 'GET',
                success: function(response) {
                    $('#sub_sector_id').empty();
                    $('#sub_sector_id').append('<option value="">Select Sub Sector</option>');
                    $.each(response, function(key, value) {
                        $('#sub_sector_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        });
    });
</script>

@endsection
