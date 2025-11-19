@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('styles')

@endsection
@section('content')
<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Analytical Dashboard
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
                    Analytical Dashboard
                </li>
                <!--end::Item-->

            </ul>
            <!--end::Breadcrumb-->
        </div>

        <div>
            <a class="btn btn-secondary" href="/admin/dashboard">Demographic</a>
            <a class="btn btn-secondary" href="/admin/analytical/dashboard">Analytical</a>

        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Filter menu-->
            <div class="m-0">
                <!--begin::Menu toggle-->
                <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click"
                    data-kt-menu-placement="bottom-end">
                    <iconify-icon icon="mingcute:filter-line" class="fa-1x"></iconify-icon>
                    Filter
                </a>
                <!--end::Menu toggle-->



                <!--begin::Menu 1-->
                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                    id="kt_menu_65e95fe68ac03">
                    <!--begin::Header-->
                    <div class="px-7 py-5">
                        <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                    </div>
                    <!--end::Header-->

                    <!--begin::Menu separator-->
                    <div class="separator border-gray-200"></div>
                    <!--end::Menu separator-->


                    <!--begin::Form-->
                    <div class="px-7 py-5">
                        <!--begin::Input group-->
                        <form action="">

                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">Report:</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <div>
                                    <select class="form-select form-select-solid" data-close-on-select="false"
                                        data-placeholder="Select option" name="report" data-allow-clear="true">

                                        <option selected="Selected"
                                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            Select Report</option>
                                        <option class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            Talent Acquisition
                                        </option>
                                        <option class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                           Talent Management</option>
                                        <option class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            Talent Development</option>
                                        <option class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            Performance Management</option>

                                    </select>
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">Department:</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <div>
                                    <select class="form-select form-select-solid" data-close-on-select="false"
                                        data-placeholder="Select option" name="department" data-allow-clear="true">

                                        <option selected="Selected" value=""
                                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            Select Department</option>

                                        <option @if (request('gender')=='0' ) selected @endif value="0"
                                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            Human Resources
                                        </option>
                                        <option @if (request('gender')==1) selected @endif value="1"
                                            class="py-1 inline-block font-Inter font-normal text-sm text-slate-600">
                                            Finance Management</option>
                                    </select>
                                </div>
                                <!--end::Input-->
                            </div>

                            <!--begin::Actions-->
                            <div class="d-flex justify-content-end">
                                <a href="/admin/dashboard" class="btn btn-sm btn-light btn-active-light-primary me-2"
                                    data-kt-menu-dismiss="true">Reset</a>

                                <button type="submit" class="btn btn-sm btn-primary"
                                    data-kt-menu-dismiss="true">Apply</button>
                            </div>
                        </form>
                        <!--end::Actions-->
                    </div>
                    <!--end::Form-->
                </div>
                <!--end::Menu 1-->
            </div>
            <!--end::Filter menu-->


            <!--begin::Secondary button-->
            <!--end::Secondary button-->

            <!--begin::Primary button-->
            {{-- <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                data-bs-target="#kt_modal_create_app">
                Create </a> --}}
            <!--end::Primary button-->
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Toolbar container-->
</div>
@endsection


@section('scripts')
@endsection
