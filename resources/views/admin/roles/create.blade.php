@extends('admin.layout.app')

@section('title', 'Roles')

@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Roles
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
                        Roles </li>
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
                        <span class="card-label fw-bold fs-1 mb-1">Role</span>

                    </h3>
                </div>
                <div class="card-body px-6 pb-6">
                    <form class="form" action="/admin/roles/{{ !empty($role) ? $role->id . '/update' : 'store' }}"
                        method="Post">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column  me-n7 pe-7">
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                @if (empty($role))
                                    <label class="fs-5 fw-bold form-label mb-2">
                                        <span class="required">Role name</span>
                                    </label>
                                @endif

                                <!--end::Label-->

                                <!--begin::Input-->
                                <input type="{{ !empty($role) ? 'hidden' : 'text' }}" name="name"
                                    class="form-control form-control-solid"
                                    value="{{ !empty($role) ? $role->name : old('name') }}" />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->


                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="fs-5 fw-bold form-label mb-2">
                                    <span class="required">Caption</span>
                                </label>

                                <!--end::Label-->

                                <!--begin::Input-->
                                <input type="text" name="caption" class="form-control form-control-solid"
                                    placeholder="Enter Caption for Role"
                                    value="{{ !empty($role) ? $role->caption : old('caption') }}" />
                                @error('caption')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <!--end::Input-->
                            </div>

                            @if (empty($role) or !$role->isDefaultRole())
                                <div class="fv-row mb-10">

                                    <label
                                        class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                        <input class="form-check-input" type="checkbox" name="is_admin"
                                            {{ !empty($role) && $role->is_admin ? 'checked' : '' }} />
                                        <span class="form-check-label">
                                           Admin Panel Access
                                        </span>
                                    </label>
                                </div>
                            @endif

                            {{-- {{ (!empty($role) && $role->is_admin) ? '' :'d-none'}} --}}
                            <!--begin::Permissions-->
                            <div class="fv-row {{ empty($role) ? '' : '' }}">
                                <!--begin::Label-->
                                <label class="fs-5 fw-bold form-label mb-2">Role
                                    Permissions</label>
                                <!--end::Label-->

                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <!--begin::Table body-->
                                        <tbody class="text-gray-600 fw-semibold">

                                            <!--end::Table row-->
                                            <!--begin::Table row-->

                                            @foreach($sections as $section)
                                            <tr>

                                                <!--begin::Label-->
                                                <td class="text-gray-800">{{ $section->caption }}
                                                </td>
                                                <!--end::Label-->

                                                <!--begin::Options-->
                                                <td>
                                                    <!--begin::Wrapper-->
                                                    @if(!empty($section->children))

                                                    <div class="d-flex">
                                                        <!--begin::Checkbox-->
                                                        @foreach($section->children as $key => $child)

                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20"  for="permissions_{{ $child->id }}">
                                                            <input class="form-check-input" type="checkbox"  name="permissions[]" id="permissions_{{ $child->id }}" value="{{ $child->id }}"
                                                            {{ isset($permissions[$child->id]) ? 'checked' : '' }} />
                                                            <span class="form-check-label">

                                                                {{ $child->caption }}
                                                            </span>
                                                        </label>
                                                        @endforeach

                                                        <!--end::Checkbox-->

                                                        <!--end::Checkbox-->
                                                    </div>
                                                    @endif
                                                    <!--end::Wrapper-->
                                                </td>
                                                <!--end::Options-->
                                            </tr>
                                            @endforeach
                                            <!--end::Table row-->
                                            <!--begin::Table row-->

                                            <!--end::Table row-->

                                            <!--end::Table row-->
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Permissions-->
                        </div>
                        <!--end::Scroll-->

                        <!--begin::Actions-->
                        <div class=" text-center pt-15">
                            {{-- <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">
                                Discard
                            </button> --}}

                            <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
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
            <!--end::Form-->
        </div>
    </div>

@endsection

@section('scripts')
@endsection
