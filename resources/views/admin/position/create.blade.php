@extends('admin.layout.app')

@section('title', 'Users')
@section('styles')
{{-- <style>
    .image-input-placeholder {
        background-image: url({{asset("admin/media/svg/files/blank-image.svg")
    }
    });
    }

    [data-bs-theme="dark"] .image-input-placeholder {
        background-image: url({{asset("admin/media/svg/files/blank-image-dark.svg")
    }
    });
    }
</style> --}}
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
                    <a href="{{ route('admin.position.index') }}" class="capitalize text-muted text-hover-primary">
                        Position
                    </a>
                </li>
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    {{ !empty($position) ? 'Edit Position' : 'Create Position' }} </li>
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
                    <h3 class="fw-bold m-0">{{ !empty($position) ? 'Edit Position' : 'Create Position' }}</h3>
                </div>
                <!--end::Card title-->
            </div>
            <div class="card-body">

                <form class="form"
                    action="/admin/position/{{ !empty($position) ? $position->id . '/update' : 'store' }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf


                    <!--begin::Input group-->


                    <div class="fv-row mb-7 row">

                        <!--begin::Label-->

                        <div class="col-md-4 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Department</label>
                            {{-- {{ dd($position) }} --}}
                            <select class="form-select form-select-solid" id="department" data-control="select2"
                                data-hide-search="false" data-placeholder="Select a Department" name="department">
                                <option value="">Select Department...</option>

                                @foreach($departments as $department)
                                <option value="{{ $department->id }}" @if(!empty($position) && $position->department_id
                                    == $department->id) selected="selected" @endif>{{ $department->head_of_department ?? '' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <!--begin::Label-->
                        <div class="col-lg-4">
                            <label class="required fw-semibold fs-6 mb-2">Position Title</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="text" name="position_name"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('position_name') is-invalid @enderror"
                                value="{{ !empty($position) ? $position->name : old('position_name') }}"
                                placeholder="Full name" />
                            @error('position_name')
                            <div class="invalid-feedback text-red-500">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-lg-4">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Level</label>
                            <!--end::Label-->

                            <!--begin::Input-->
                            <input type="number" name="level"
                                class="form-control form-control-solid mb-3 mb-lg-0 @error('level') is-invalid @enderror"
                                placeholder="Full name"
                                value="{{!empty($position) ? $position->level : old('level') }}" />

                            @error('level')
                            <div class="invalid-feedback text-red-500">
                                {{ $message }}
                            </div>
                            @enderror
                            <!--end::Input-->
                        </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
    $(document).ready(function() {
        $('#department').change(function() {
            var departId = $(this).val();
            console.log(departId);
            $.ajax({
                url: '/admin/postions/' + departId,
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
