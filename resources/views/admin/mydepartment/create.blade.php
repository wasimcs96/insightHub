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
    <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack container-xxl">
        <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}" class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                {{ !empty($user) ? 'Edit Department' : 'Create Department' }}
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Home </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item capitalize text-muted">
                   Organization Structure
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/mydepartment" class="capitalize text-muted text-hover-primary">
                        My Department
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    {{ !empty($user) ? 'Edit Department' : 'Create Department' }}
                </li>
            </ul>
        </div>
    </div>
</div>
<div id="kt_app_content" class="app-content  flex-column-fluid ">
    <div id="kt_app_content_container" class="app-container  container-xxl ">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">{{ !empty($user) ? 'Edit Department' : 'Create Department' }}</span>
                </h3>
            </div>
            <div class="card-body">
                <form class="form" action="/admin/mydepartment/{{ !empty($user) ? $user->id . '/update' : 'store' }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class=" ">
                        {{-- <div class="fv-row mb-7">
                            <label class="d-block fw-semibold fs-6 mb-5">Avatar</label>
                            <div class="image-input image-input-outline image-input-placeholder"
                                data-kt-image-input="true">
                                <div class="image-input-wrapper w-125px h-125px"
                                @if (!empty($user)&&isset($user->user->profile_picture)) style="background-image: url('{{ asset($user->user->profile_picture) }}');"
                        @else
                        style="background-image: url('{{ asset('images/default-user.svg') }}');" @endif>
                    </div>
                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                        <iconify-icon icon="heroicons-outline:pencil-alt" class="fa-1-5"></iconify-icon>
                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg" value="{{ old('avatar') }}" />
                        <input type="hidden" name="avatar_remove" />
                    </label>
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                        <iconify-icon icon="iconoir:cancel" class="fa-1-5">
                        </iconify-icon>
                    </span>
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                        <iconify-icon icon="iconoir:cancel" class="fa-1-5">
                        </iconify-icon>
                    </span>
            </div>
            <div class="form-text  @error('avatar') is-invalid @enderror">Allowed file types: png,
                jpg, jpeg.</div>
            @error('avatar')
            <div class="invalid-feedback text-red-500">
                {{ $message }}
            </div>
            @enderror
        </div> --}}
        <div class="fv-row mb-7 row">
            <div class="col-lg-6">
                <label class="fw-semibold fs-6 mb-2" for="division_id">Division</label>
                <select class="form-control form-control-solid mb-3 mb-lg-0 @error('division_id') is-invalid @enderror" name="division_id" id="division_id">
                    @foreach($divisions as $division)
                    <option value="{{ $division->id }}" {{ old('division_id', $user->division_id ?? '') == $division->id ? 'selected' : '' }}>
                        {{ $division->head_of_division }} - {{ $division->business_unit->name ?? '' }}
                    </option>
                    @endforeach
                </select>

                @error('division_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-lg-6">
                <label class=" fw-semibold fs-6 mb-2">Department Name</label>
                <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0 @error('name') is-invalid @enderror" placeholder="Enter Department Name" value="{{ !empty($user) ? $user->name : old('name') }}" />
                @error('name')
                <div class="invalid-feedback text-red-500">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- <div class="col-lg-4">
                                <label class="required fw-semibold fs-6 mb-2">HOD First Name</label>
                                <input type="text" name="first_name"
                                    class="form-control form-control-solid mb-3 mb-lg-0 @error('first_name') is-invalid @enderror"
                                    value="{{ !empty($user) ? $user->user->first_name : old('first_name') }}" placeholder="First Name" />
            @error('first_name')
            <div class="invalid-feedback text-red-500">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-lg-4">
            <label class="required fw-semibold fs-6 mb-2">HOD Last Name</label>
            <input type="text" name="last_name" class="form-control form-control-solid mb-3 mb-lg-0 @error('last_name') is-invalid @enderror" placeholder="Last Name" value="{{ !empty($user) ? $user->user->last_name : old('last_name') }}" />
            @error('last_name')
            <div class="invalid-feedback text-red-500">
                {{ $message }}
            </div>
            @enderror
        </div> --}}

        {{-- <div class="col-lg-6">
            <label class="required fw-semibold fs-6 mb-2">Status</label>
            <select name="status" class="form-control form-control-solid mb-3 mb-lg-0 @error('status') is-invalid @enderror">
                <option value="1" {{ !empty($user) && $user->status == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !empty($user) && $user->status == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
            <div class="invalid-feedback text-red-500">
                {{ $message }}
            </div>
            @enderror
        </div> --}}

    </div>

    {{-- <div class="row">
                            <div class="mb-10 fv-row col-lg-6 mt-5" data-kt-password-meter="true">
                                <div class="mb-1 ">
                                    <label class="form-label fw-semibold fs-6 mb-2">Password</label>
                                    <div class="position-relative mb-3">
                                        <input class="form-control form-control-lg form-control-solid " type="password"
                                            placeholder="" name="password" autocomplete="off" />
                                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                            data-kt-password-meter-control="visibility">
                                            <i class="ki-eye-slash">
                                                <iconify-icon icon="ph:eye-slash" class=" ki-duotone ki-eye-slash fa-1-5">
                                                </iconify-icon>
                                            </i>
                                            <i class=" d-none ">
                                                <iconify-icon icon="mdi:eye-outline" class="ki-duotone ki-eye fa-1-5">
                                                </iconify-icon>
                                            </i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3"
                                        data-kt-password-meter-control="highlight">
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-muted">
                                    Use 8 or more characters with a mix of letters, numbers & symbols.
                                </div>
                            </div>
                            <div class="fv-row mb-10 col-lg-6 mt-5">
                                <label class="form-label fw-semibold fs-6 mb-2">Confirm Password</label>
                                <input class="form-control form-control-lg form-control-solid  @error('password') is-invalid @enderror"
                                    type="password" placeholder="" name="password_confirmation" autocomplete="off" />
                                @error('password')
                                <div class="invalid-feedback text-red-500">
                                    {{ $message }}
</div>
@enderror
</div>
</div> --}}
</div>
<div class="text-center pt-10">
    <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
        <span class="indicator-label">
            Submit
        </span>
        <span class="indicator-progress">
            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
        </span>
    </button>
</div>
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
        $('#company').change(function() {
            var companyId = $(this).val();
            $.ajax({
                url: '/admin/departments/' + companyId,
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

    $(document).ready(function() {
        $('#department').change(function() {
            var departId = $(this).val();
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