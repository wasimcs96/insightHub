


@extends('admin.layout.app')

@section('title', 'Organizational Chart')

@section('styles')
<script src="{{ asset('/js/org-structure/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/js/org-structure/iconify-icon.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css"> --}}
<style>
    html,
    body {
        height: 100%;
        margin: 0;
        font-family: sans-serif;
    }

    #container {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    #organizationPositionsChart {
        flex: 1;
        margin: 0px 32px;
    }

    .profile-name {
        color: #071437;
        font-size: 16.25px;
        font-weight: 700;
        line-height: 19.5px;
    }

    .sub-content {
        color: #4B5675;
        font-size: 12px;
        font-weight: 500;
        line-height: 16px;
    }

    .profile-name span,
    .tags {
        height: 24px;
        padding: 4px 12px;
        border-radius: 80px;
        font-size: 10px;
        font-weight: 600;
        line-height: 14px;
    }

    .top-heading {
        color: #071437;
        font-size: 16.25px;
        font-weight: 500;
        line-height: 19.5px;
    }

    .view-more-btn {
        color: #000;
        font-size: 12px;
        font-weight: 500;
        line-height: 16px;
        text-decoration-line: underline;
        text-decoration-style: solid;
        text-decoration-skip-ink: auto;
        text-decoration-thickness: auto;
        text-underline-offset: auto;
        text-underline-position: from-font;
    }

    .content-bottom {
        color: #071437;
        font-size: 14px;
        font-weight: 600;
        line-height: 20px;
    }

    .top-bar {
        height: 55px;
        box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        padding: 8px 1px 9.75px 0px;
    }

    .top-bar h4 {
        color: #071437;
        font-size: 17.55px;
        font-weight: 700;
    }

    .top-bar p {
        color: #99A1B7;
        font-size: 12.35px;
        font-weight: 400;
    }

    .elements-navbar {
        display: flex;
        padding: 16px 32px;
        border: 1px solid #000;
        margin-bottom: 40px;
    }

    .elements-navbar input,
    .elements-navbar button,
    .custom-dropdown .form-select,
    .custom-box {
        border: 1px solid #000;
        color: #000;
        font-weight: 500;
        background-color: #fff;
        border-radius: 0px;
    }

    .custom-dropdown .form-select {
        width: 224px;
        font-size: 12px;
    }

    .elements-navbar input {
        font-size: 12px;
        padding: 6px 10px;
        width: 325px;
    }

    .elements-navbar button,
    .custom-box {
        font-size: 14px;
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .elements-chart-inner {
        padding: 16px;
        border: 1px solid #000;
        background: #FCFCFC;
        width: fit-content;
    }

    .elements-chart-inner h4 {
        color: #000;
        font-size: 14px;
        font-weight: 600;
        line-height: 20px;
        margin-bottom: 12px;
    }

    .left-side-elements,
    .right-side-elements {
        position: absolute;
        z-index: 3;
        top: 174px;
    }

    .left-side-elements {
        left: 32px;
    }

    .right-side-elements {
        right: 32px;
    }

    .elements-chart-organization {
        width: 500px;
    }

    .elements-chart-position {
        width: 332px;
        margin-top: 12px;
    }

    .legend-chart {
        width: 200px;
    }

    .more-details-btn {
        color: #000;
        font-size: 10px;
        font-weight: 500;
        line-height: normal;
        text-decoration-line: underline;
        text-decoration-style: solid;
        text-decoration-skip-ink: auto;
        text-decoration-thickness: auto;
        text-underline-offset: 2px;
        cursor: pointer;
    }

    .clear-filters {
        color: #99A1B7;
        font-size: 12px;
        font-weight: 500;
        line-height: 16px;
        cursor: pointer;
    }

    .tags-elements {
        padding: 8px 16px;
        border-radius: 80px;
        background: #F1F1F4;
    }

    .tags-elements {
        color: #4B5675;
        font-size: 12px;
        font-weight: 500;
        line-height: 16px;
    }

    .tags-elements-content,
    .legend-text {
        color: #000;
        font-size: 12px;
        font-weight: 400;
    }


    .elements-chart-position .heading {
        color: #99A1B7;
        font-size: 12px;
        font-weight: 500;
        line-height: 16px;
    }

    .elements-chart-position .content {
        color: #4B5675;
        font-size: 12px;
        font-weight: 500;
        line-height: 16px;
    }

    .filter-side-heading {
        color: #071437;
        font-size: 14px;
        font-weight: 600;
        line-height: 20px;
    }

    .filter-side-label label {
        color: #000;
        font-size: 12px;
        font-weight: 500;
        line-height: 16px;
    }

    .filter-side-label label span {
        color: #99A1B7;
    }

    .filter-side-search {
        padding: 10px;
        flex: 1 0 0;
        border-radius: 4px;
        border: 1px solid #000;
        color: #000;
        font-size: 12px;
        font-weight: 500;
    }

    .selected-department {
        display: flex;
        padding: 4px 8px;
        align-items: center;
        gap: 8px;
        border-radius: 4px;
        background: #F1F1F4;
        color: #071437;
        font-size: 12px;
        font-weight: 500;
        line-height: 16px;
    }

    .selected-department .btn-close {
        font-weight: 600;
        color: #78829D;
        font-size: 10px;
    }

    .selected-department .btn-close:focus {
        outline: none;
        border: none;
        box-shadow: none;
    }

    .form-control:focus {
        border-color: #DBDFE9;
        outline: 0;
        box-shadow: none;
    }

    .form-check-input:focus {
        box-shadow: none;

    }

    .modal-body .form-control:focus {
        border-color: none;
        box-shadow: none;
    }

    .modal-body #headcountIdDisplay {
        border: none;
        padding: 0;
    }

    .form-check-input:checked {
        background-color: #F7941C;
        border-color: #F7941C;
    }

    #dropdownMenu {
        display: none;
        /* Ensure the dropdown is hidden by default */
    }

    .dropdown-main {
        position: absolute;
        display: none;
        width: 155px;
        background: #F4F4F6;
        padding: 0;
    }

    .dropdown-main button:first-child {
        border-radius: 4px 4px 0px 0px;
    }

    .dropdown-main button:last-child {
        border-radius: 0px 0px 4px 4px;
    }

    .dropdown-item {
        padding: 8px 16px;
        background: #F1F1F4;
        color: #4B5675;
        font-size: 12px;
        font-weight: 500;
        line-height: 16px;
    }

    .dropdown-item:hover {
        background: #000;
        color: #fff;
    }

    .modal-content-p p {
        color: #071437;
        font-size: 13.975px;
        font-weight: 500;
        line-height: 20px;
    }

    .modal-body .form-group label {
        color: #071437;
        font-size: 12px;
        font-weight: 500;
        line-height: 16px;
        margin-bottom: 4px;
    }

    .modal-body .form-control,
    .modal-body .form-select {
        color: #071437;
        font-size: 12px;
        font-weight: 400;
        line-height: 16px;
    }

    .form-select:focus {
        border-color: #DBDFE9;
        outline: 0;
        box-shadow: none;
    }

    .modal-footer button {
        display: flex;
        padding: 14px 20px;
        justify-content: center;
        align-items: center;
        gap: 8px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 600;
        line-height: 20px;
    }

    .modal-footer .cancel-button {
        color: #78829D;
        border: 1px solid #99A1B7;
        background: #FFF;
    }

    .modal-footer .orange-fill-disabled {
        border: 1px solid #DBDFE9;
        background: #F1F1F4;
        color: #99A1B7;
    }

    .modal-footer .orange-fill {
        background: #F7941C;
        border: 1px solid #F7941C;
        color: #fff;
    }

    .tooltip-inner {
        background-color: #ffffff !important;
        color: #000000 !important;
        border: 1px solid #ccc;
        font-size: 13px;
        padding: 6px 10px;
        border-radius: 4px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .bs-tooltip-top .tooltip-arrow::before {
        border-top-color: #ffffff !important;
        border-bottom-color: #ffffff !important;
        border-left-color: #ffffff !important;
        border-right-color: #ffffff !important;
    }

    .modal-body h4 {
        color: #071437;
        text-align: center;
        font-size: 32.5px;
        font-weight: 500;
        line-height: 39px;
    }

    .modal-body .radio-div {
        padding: 12px;
        border-radius: 4px;
        border: 1px solid #DBDFE9;
        background: #FFF;
    }

    .modal-body .radio-div p {
        color: #212529;
        font-size: 12px;
        font-weight: 500;
        line-height: 16px;
    }

    .modal-content-p h5 {
        color: #071437;
        font-size: 22.75px;
        font-weight: 700;
        line-height: 27.3px;
    }

    .modal-body th {
        color: #99A1B7;
        font-size: 12px;
        font-style: normal;
        font-weight: 600;
        line-height: 16px;
        padding: 22px;
        align-items: center;
        gap: 10px;
        background: #FFF;
    }

    .modal-body td {
        vertical-align: middle;
        color: #071437;
        font-size: 14px;
        font-weight: 500;
        line-height: 20px;
        padding: 22px;
    }

    .modal-body .form-select:disabled,
    .modal-body .form-control:disabled {
        border-radius: 4px;
        border: 1px solid #C4CADA;
        background: #DBDFE9;
        height: 36px;
        padding: 0px 12px;
        color: #78829D;
        font-size: 12px;
        font-weight: 400;
        line-height: 16px;
    }

    .modal-body .reason-input {
        border: 0;
        height: 36px;
    }

    .circle {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 3px solid #DDE0E5;
        background-color: #fff;
        transition: background-color 0.3s;
    }

    .circle.active {
        background-color: #E78829;
    }

    .step-text {
        font-weight: 500;
        color: #0C1C39;
        cursor: pointer;
        transition: font-weight 0.3s;
    }

    .step-text.active {
        font-weight: 700;
    }

    .line {
        width: 2px;
        height: 25px;
        position: relative;
        left: 10px;
        background-color: #DBDFE9;
    }

    .offcanvas-body .footer-btn button {
        padding: 16px;
        border: 1px solid #000;
        color: #000;
        font-size: 14px;
        font-weight: 500;
        width: 100%;
        background-color: #fff;
    }

    .offcanvas-body .footer-btn {
        position: absolute;
        bottom: 0px;
        width: 92%;
        padding: 24px 0px;
        background-color: #fff;
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
                Organisation Chart
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
                    Organisation Chart </li>
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



{{-- <div id="kt_app_content" class="app-content  flex-column-fluid ">

    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container  container-xxl ">
    </div>
</div>         --}}

<div id="container" class="app-content  flex-column-fluid">
    {{-- <div class="top-bar app-container  container-xxl">
        <h4 class="mb-1">Organisation Chart</h4>
        <p class="m-0">Department - Network Management Center</p>
    </div> --}}
    <div class="elements-navbar d-flex justify-content-between align-items-center gap-4">
        <div class="left d-flex gap-2">
            <input type="text" placeholder="Search">
            <div class="custom-dropdown">
                <select class="form-select bg-white">
                    <option selected>All Levels</option>
                    <option value="1">Level 1</option>
                    <option value="2">Level 2</option>
                    <option value="3">Level 3</option>
                </select>
            </div>
        </div>
        <div class="right d-flex gap-2">
            <div class="custom-box">
                <div class="form-check form-switch m-0 d-flex align-items-center">
                    <input class="form-check-input" type="checkbox" id="orgChartSwitch">
                    <label class="form-check-label ms-2 fw-medium text-dark" for="orgChartSwitch">Show Original Org
                        Chart</label>
                </div>
            </div>
            <button>
                <img src="/admin/media/svg/org-chart-svg/cancel.svg" alt="filter"> Discard Changes
            </button>
            <button>
                Delivery <img src="/admin/media/svg/org-chart-svg/cancel.svg" alt="filter">
            </button>

            <button>
                Operations <img src="/admin/media/svg/org-chart-svg/cancel.svg" alt="filter">
            </button>

            <button>
                + 10 more filters applied
            </button>

            <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                <img src="/admin/media/svg/org-chart-svg/filter-chart.svg" alt="filter"> Filters
            </button>

            <button>
                <img src="/admin/media/svg/org-chart-svg/save.svg" alt="Edit"> Save Changes
            </button>

            <button>
                <img src="/admin/media/svg/org-chart-svg/edit-chart.svg" alt="Edit"> Edit Structure
            </button>
        </div>
    </div>
    <div class="left-side-elements">
        <div class="elements-chart-organization elements-chart-inner">
            <h4>Entire Organization</h4>
            <div class="d-flex align-items-center gap-2">
                <div class="tags-elements d-flex align-items-center gap-1">
                    <img src="/admin/media/svg/org-chart-svg/department-chart.svg" alt="department">
                    <p class="m-0">15</p>
                </div>
                <div class="tags-elements d-flex align-items-center gap-1">
                    <img src="/admin/media/svg/org-chart-svg/job-position-chart.svg" alt="job-position">
                    <p class="m-0">24</p>
                </div>
                <div class="tags-elements d-flex align-items-center gap-1">
                    <img src="/admin/media/svg/org-chart-svg/employee-chart.svg" alt="employee">
                    <p class="m-0">135/140</p>
                </div>
                <div class="tags-elements d-flex align-items-center gap-1">
                    <img src="/admin/media/svg/org-chart-svg/vacancy-chart.svg" alt="vacancy">
                    <p class="m-0">5</p>
                </div>
                <div class="tags-elements d-flex align-items-center gap-1">
                    <img src="/admin/media/svg/org-chart-svg/critical-job-position-chart.svg"
                        alt="critical-job-position">
                    <p class="m-0">3</p>
                </div>
            </div>
        </div>
        <div class="elements-chart-position elements-chart-inner">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="d-flex align-items-center gap-3">Open Positions <span class="tags-elements">24</span>
                </h4>
                <p class="m-0 more-details-btn">More Details</p>
            </div>
            <div class="row mb-3">
                <p class="m-0 col-8 heading">Job Position</p>
                <p class="col-4 m-0 text-center heading">Vacancy</p>
            </div>

            <div class="row mb-3">
                <p class="col-8 m-0 content d-flex align-items-center gap-2">
                    Crew Controller
                    <img src="/admin/media/svg/org-chart-svg/critical-job-position-chart.svg"
                        alt="critical-job-position">
                </p>
                <p class="col-4 m-0 content text-center">1</p>
            </div>

            <div class="row mb-3">
                <p class="col-8 m-0 content">Regional Dispatch Training Manager</p>
                <p class="col-4 m-0 content text-center">1</p>
            </div>

            <div class="row mb-3">
                <p class="col-8 m-0 content">Senior Flight Dispatcher</p>
                <p class="col-4 m-0 content text-center">1</p>
            </div>

            <div class="row">
                <p class="col-8 m-0 content">Flight Dispatcher</p>
                <p class="col-4 m-0 content text-center">1</p>
            </div>
        </div>
    </div>

    <div class="right-side-elements">
        <div class="legend-chart elements-chart-inner">
            <p class="m-0 legend-text mb-2">Legend</p>
            <div class="d-flex flex-column gap-2">
                <div class="tags-elements-content d-flex align-items-center gap-3">
                    <img src="/admin/media/svg/org-chart-svg/levels-chart.svg" alt="department">
                    <p class="m-0">Level 1</p>
                </div>
                <div class="tags-elements-content d-flex align-items-center gap-3">
                    <img src="/admin/media/svg/org-chart-svg/levels-chart.svg" alt="job-position">
                    <p class="m-0">Level 2</p>
                </div>
                <div class="tags-elements-content d-flex align-items-center gap-3">
                    <img src="/admin/media/svg/org-chart-svg/levels-chart.svg" alt="employee">
                    <p class="m-0">Level 3</p>
                </div>
                <div class="tags-elements-content d-flex align-items-center gap-3">
                    <img src="/admin/media/svg/org-chart-svg/levels-chart.svg" alt="vacancy">
                    <p class="m-0">Level 4</p>
                </div>
                <div class="tags-elements-content d-flex align-items-center gap-3">
                    <img src="/admin/media/svg/org-chart-svg/levels-chart.svg" alt="critical-job-position">
                    <p class="m-0">Level 5</p>
                </div>
            </div>
            <hr>
            <div class="d-flex flex-column gap-2">
                <div class="tags-elements-content d-flex align-items-center gap-3">
                    <img src="/admin/media/svg/org-chart-svg/department-chart.svg" alt="department">
                    <p class="m-0">Department</p>
                </div>
                <div class="tags-elements-content d-flex align-items-center gap-3">
                    <img src="/admin/media/svg/org-chart-svg/job-position-chart.svg" alt="job-position">
                    <p class="m-0">Job Position</p>
                </div>
                <div class="tags-elements-content d-flex align-items-center gap-3">
                    <img src="/admin/media/svg/org-chart-svg/employee-chart.svg" alt="employee">
                    <p class="m-0">Employee</p>
                </div>
                <div class="tags-elements-content d-flex align-items-center gap-3">
                    <img src="/admin/media/svg/org-chart-svg/vacancy-chart.svg" alt="vacancy">
                    <p class="m-0">Vacancy</p>
                </div>
                <div class="tags-elements-content d-flex align-items-center gap-3">
                    <img src="/admin/media/svg/org-chart-svg/critical-job-position-chart.svg"
                        alt="critical-job-position">
                    <p class="m-0">Critical Job Position</p>
                </div>
                <div class="tags-elements-content d-flex align-items-center gap-3">
                    <img src="/admin/media/svg/org-chart-svg/high-flight-risk-chart.svg"
                        alt="critical-job-position">
                    <p class="m-0">High Flight Risk</p>
                </div>
            </div>
        </div>
    </div>

    <div id="organizationPositionsChart"></div>
    {{-- <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft"
        aria-labelledby="offcanvasLeftLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Employee Profile</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">

            <!-- Profile Info -->
            <div class="mb-4 d-flex gap-3 align-items-center">
                <img src="/admin/media/svg/org-chart-svg/user.svg" class="rounded-circle" alt="Profile">
                <div>
                    <h5 class="profile-name mb-2 d-flex gap-2 align-items-center">Jamie Fox <span class="ms-2"
                            style="background-color: #DDF5E2; color:#196329;">BSC:
                            78%</span></h5>
                    <p class="sub-content mb-0">Senior Flight Dispatcher</p>
                    <p class="sub-content mb-0">jamiefox@email.com</p>
                </div>
            </div>

            <!-- Badges -->
            <div class="row mb-4 gap-2">
                <div class="col-5">
                    <span class="tags" style="background-color: #DDF5E2; color:#196329;">LOW RISK</span>
                    <div class="small text-muted mt-1">Flight Risk</div>
                </div>
                <div class="col-5">
                    <span class="tags" style="background-color: #DDF5E2; color:#196329;">VERY HIGH</span>
                    <div class="small text-muted mt-1">Overall Match Rate</div>
                </div>
                <div class="col-5">
                    <span class="tags" style="background-color: #DDF5E2; color:#196329;">HIGH</span>
                    <div class="small text-muted mt-1">Behavioral Fit Rate</div>
                </div>
                <div class="col-5">
                    <span class="tags" style="background-color: #DDF5E2; color:#196329;">HIGH</span>
                    <div class="small text-muted mt-1">Job Match Rate</div>
                </div>
            </div>

            <hr class="my-4">

            <!-- Employee Details -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="top-heading mb-0">Employee Details</h6>
                <a href="#" class="view-more-btn">View More</a>
            </div>

            <div class="mb-4">
                <div class="mb-3">
                    <p class="sub-content mb-1">Headcount ID</p>
                    <p class="content-bottom mb-0">SF-001-01</p>
                </div>

                <div class="mb-3">
                    <p class="sub-content mb-1">Employee Code</p>
                    <p class="content-bottom mb-0">SF-001-01</p>
                </div>

                <div class="mb-3">
                    <p class="sub-content mb-1">Department</p>
                    <p class="content-bottom mb-0">Operations</p>
                </div>

                <div class="mb-3">
                    <p class="sub-content mb-1">Technical Assessment Results</p>
                    <p class="content-bottom mb-0">Very High</p>
                </div>

                <div class="mb-3">
                    <p class="sub-content mb-1">Soft Skill Match Rate</p>
                    <p class="content-bottom mb-0">Moderate</p>
                </div>

                <div class="mb-3">
                    <p class="sub-content mb-1">Predictive Performance Rate</p>
                    <p class="content-bottom mb-0">Low</p>
                </div>

                <div class="mb-3">
                    <p class="sub-content mb-1">Cognitive Test Result</p>
                    <p class="content-bottom mb-0">Moderate</p>
                </div>

                <div class="mb-3">
                    <p class="sub-content mb-1">RIASEC</p>
                    <p class="content-bottom mb-0">IRC</p>
                </div>

                <div class="mb-3">
                    <p class="sub-content mb-1">Job Match Rate</p>
                    <p class="content-bottom mb-0">Moderate</p>
                </div>

                <div class="mb-3">
                    <p class="sub-content mb-1">OCEAN Reliability</p>
                    <p class="content-bottom mb-0">Somewhat Consistent</p>
                </div>

                <div class="mb-3">
                    <p class="sub-content mb-1">Growth Potential</p>
                    <p class="content-bottom mb-0">Moderate</p>
                </div>

                <div class="mb-3">
                    <p class="sub-content mb-1">Workplace Forecast Alignment</p>
                    <p class="content-bottom mb-0">Moderate</p>
                </div>

            </div>

            <hr class="my-4">

            <!-- Superior Information -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="top-heading mb-0">Superior Information</h6>
            </div>
            <div class="mb-2">
                <p class="sub-content mb-1">Employee Name:</p>
                <p class="content-bottom m-0">Benjamin Tan</p>
            </div>

            <div class="mb-2">
                <p class="sub-content mb-1">Job Position:</p>
                <p class="content-bottom m-0">Heads of Ops & Dispatch Projects</p>
            </div>

            <div class="mb-2">
                <p class="sub-content mb-1">Headcount ID:</p>
                <p class="content-bottom m-0">HDP-001-01</p>
            </div>

            <div class="mb-2">
                <p class="sub-content mb-1">Department:</p>
                <p class="content-bottom m-0">Operations</p>
            </div>


        </div>
    </div> --}}
    

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft" aria-labelledby="offcanvasLeftLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Employee Profile</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
    
        <div class="offcanvas-body">
    
            <!-- Profile Info -->
            <div class="mb-4 d-flex gap-3 align-items-center">
                <img src="/admin/media/svg/org-chart-svg/user.svg" class="rounded-circle" alt="Profile">
                <div>
                    <h5 id="employee-name" class="profile-name mb-2 d-flex gap-2 align-items-center">-</h5>
                    <p id="employee-title" class="sub-content mb-0">-</p>
                    <p id="employee-email" class="sub-content mb-0">-</p>
                </div>
            </div>
    
            <!-- Badges -->
            <div class="row mb-4 gap-2">
                <div class="col-5">
                    <span id="badge-flight-risk" class="tags" style="background-color: #DDF5E2; color:#196329;">-</span>
                    <div class="small text-muted mt-1">Flight Risk</div>
                </div>
                <div class="col-5">
                    <span id="badge-match-rate" class="tags" style="background-color: #DDF5E2; color:#196329;">-</span>
                    <div class="small text-muted mt-1">Overall Match Rate</div>
                </div>
                <div class="col-5">
                    <span id="badge-behavioral-fit" class="tags" style="background-color: #DDF5E2; color:#196329;">-</span>
                    <div class="small text-muted mt-1">Behavioral Fit Rate</div>
                </div>
                <div class="col-5">
                    <span id="badge-job-match" class="tags" style="background-color: #DDF5E2; color:#196329;">-</span>
                    <div class="small text-muted mt-1">Job Match Rate</div>
                </div>
            </div>
    
            <hr class="my-4">
    
            <!-- Employee Details -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="top-heading mb-0">Employee Details</h6>
                <a href="#" id="view-more-btn" class="view-more-btn">View More</a>
            </div>
    
            <div class="mb-4">
                <div class="mb-3">
                    <p class="sub-content mb-1">Headcount ID</p>
                    <p id="emp-headcount-id" class="content-bottom mb-0">-</p>
                </div>
    
                <div class="mb-3">
                    <p class="sub-content mb-1">Employee Code</p>
                    <p id="emp-code" class="content-bottom mb-0">-</p>
                </div>
    
                <div class="mb-3">
                    <p class="sub-content mb-1">Department</p>
                    <p id="emp-dept" class="content-bottom mb-0">-</p>
                </div>
    
                <div class="mb-3">
                    <p class="sub-content mb-1">Technical Assessment Results</p>
                    <p id="emp-ta" class="content-bottom mb-0">-</p>
                </div>
    
                <div class="mb-3">
                    <p class="sub-content mb-1">Soft Skill Match Rate</p>
                    <p id="emp-ssmr" class="content-bottom mb-0">-</p>
                </div>
    
                <div class="mb-3">
                    <p class="sub-content mb-1">Cognitive Test Result</p>
                    <p id="emp-cog" class="content-bottom mb-0">-</p>
                </div>
    
                <div class="mb-3">
                    <p class="sub-content mb-1">RIASEC</p>
                    <p id="emp-riasec" class="content-bottom mb-0">-</p>
                </div>
    
                <div class="mb-3">
                    <p class="sub-content mb-1">Job Match Rate</p>
                    <p id="emp-job-match" class="content-bottom mb-0">-</p>
                </div>
    
                <div class="mb-3">
                    <p class="sub-content mb-1">OCEAN Reliability</p>
                    <p id="emp-ocean" class="content-bottom mb-0">-</p>
                </div>
    
                <div class="mb-3">
                    <p class="sub-content mb-1">Growth Potential</p>
                    <p id="emp-growth" class="content-bottom mb-0">-</p>
                </div>
    
                <div class="mb-3">
                    <p class="sub-content mb-1">Workplace Forecast Alignment</p>
                    <p id="emp-align" class="content-bottom mb-0">-</p>
                </div>
            </div>
    
            <hr class="my-4">
    
            <!-- Superior Information -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="top-heading mb-0">Superior Information</h6>
            </div>
            <div class="mb-2">
                <p class="sub-content mb-1">Employee Name:</p>
                <p id="sup-name" class="content-bottom m-0">-</p>
            </div>
    
            <div class="mb-2">
                <p class="sub-content mb-1">Job Position:</p>
                <p id="sup-position" class="content-bottom m-0">-</p>
            </div>
    
            <div class="mb-2">
                <p class="sub-content mb-1">Headcount ID:</p>
                <p id="sup-headcount" class="content-bottom m-0">-</p>
            </div>
    
            <div class="mb-2">
                <p class="sub-content mb-1">Department:</p>
                <p id="sup-dept" class="content-bottom m-0">-</p>
            </div>
    
        </div>
    </div>
    


    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
        aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <div class="d-flex gap-2 align-items-center">
                <h5 class="offcanvas-title">Filters <span>(12)</span></h5>
                <p class="m-0 clear-filters">Clear filters</p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" style="padding-bottom: 120px;">
            <h5 class="filter-side-heading mb-3">Levels <span>(5)</span></h5>
            <div class="form-check filter-side-label d-flex gap-2 align-items-center mb-2">
                <input class="form-check-input" type="checkbox">
                <label class="form-check-label d-flex justify-content-between w-100">
                    Level 1 <span class="text-muted">60</span>
                </label>
            </div>

            <div class="form-check filter-side-label d-flex gap-2 align-items-center mb-2">
                <input class="form-check-input" type="checkbox">
                <label class="form-check-label d-flex justify-content-between w-100">
                    Level 2 <span class="text-muted">20</span>
                </label>
            </div>

            <div class="form-check filter-side-label d-flex gap-2 align-items-center mb-2">
                <input class="form-check-input" type="checkbox">
                <label class="form-check-label d-flex justify-content-between w-100">
                    Level 3 <span class="text-muted">20</span>
                </label>
            </div>

            <div class="form-check filter-side-label d-flex gap-2 align-items-center mb-2">
                <input class="form-check-input" type="checkbox">
                <label class="form-check-label d-flex justify-content-between w-100">
                    Level 4 <span class="text-muted">20</span>
                </label>
            </div>

            <div class="form-check filter-side-label d-flex gap-2 align-items-center">
                <input class="form-check-input" type="checkbox">
                <label class="form-check-label d-flex justify-content-between w-100">
                    Level 5 <span class="text-muted">20</span>
                </label>
            </div>

            <hr>

            <h5 class="filter-side-heading mb-3">Business Unit <span>(2)</span></h5>

            <input type="text" class="form-control filter-side-search mb-3"
                placeholder="Search Business Unit">

            <div class="d-flex flex-wrap gap-2">
                <span class="selected-department">
                    Business Unit 1
                    <button type="button" class="btn-close btn-sm" aria-label="Close"></button>
                </span>
                <span class="selected-department">
                    Business Unit 2
                    <button type="button" class="btn-close btn-sm" aria-label="Close"></button>
                </span>
            </div>

            <hr>

            <h5 class="filter-side-heading mb-3">Company/Division <span>(2)</span></h5>

            <input type="text" class="form-control filter-side-search mb-3" placeholder="Search Departments">

            <div class="d-flex flex-wrap gap-2">
                <span class="selected-department">
                    Department 1
                    <button type="button" class="btn-close btn-sm" aria-label="Close"></button>
                </span>
                <span class="selected-department">
                    Department 2
                    <button type="button" class="btn-close btn-sm" aria-label="Close"></button>
                </span>
            </div>

            <hr>

            <h5 class="filter-side-heading mb-3">Departments <span>(2)</span></h5>

            <input type="text" class="form-control filter-side-search mb-3" placeholder="Search Departments">

            <div class="d-flex flex-wrap gap-2">
                <span class="selected-department">
                    Department 1
                    <button type="button" class="btn-close btn-sm" aria-label="Close"></button>
                </span>
                <span class="selected-department">
                    Department 2
                    <button type="button" class="btn-close btn-sm" aria-label="Close"></button>
                </span>
            </div>

            <hr>

            <h5 class="filter-side-heading mb-3">Teams <span>(2)</span></h5>

            <input type="text" class="form-control filter-side-search mb-3" placeholder="Search Teams">

            <div class="d-flex flex-wrap gap-2">
                <span class="selected-department">
                    Department 1
                    <button type="button" class="btn-close btn-sm" aria-label="Close"></button>
                </span>
                <span class="selected-department">
                    Department 2
                    <button type="button" class="btn-close btn-sm" aria-label="Close"></button>
                </span>
            </div>
            <div class="d-flex gap-3 footer-btn">
                <button type="button">Cancel</button>
                <button type="button">Apply Filters</button>
            </div>
        </div>

    </div>

    <div id="dropdownMenu" class="dropdown-menu show shadow dropdown-main text-center">
        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#assignPosition">Assign
            Employee</button>
        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addPosition">Add Position</button>
        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#moveEmployee">Move
            Employee</button>
        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#removeEmployee">Remove
            Employee</button>
        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deletePosition">Delete
            Position</button>
        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editJD">Edit JD</button>
        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#reassignSubordinates">Reassign
            Subordinates</button>
    </div>

    <div class="modal fade" id="assignPosition" tabindex="-1" aria-labelledby="assignPositionLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="assignPositionLabel">Assign Employee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column gap-4 p-4">
                    <div class="modal-content-p">
                        <p class="mb-2">Select how you’d like to assign an employee to:</p>
                        <p class="m-0"><b>Flight Dispatcher (FD-001-01)</b></p>
                    </div>

                    <div class="form-group d-flex radio-div flex-column gap-2">
                        <div class="form-group d-flex align-items-center gap-2">
                            <input class="form-check-input m-0" type="radio" name="jdModificationOption"
                                id="modifyExisting" value="modify">
                            <label class="form-check-label d-flex align-items-center gap-2 m-0"
                                for="modifyExisting">
                                Choose from existing employees
                            </label>
                        </div>
                        <div class="form-group" id="existingEmployeeGroup">
                            <label for="Employee">Employee <span style="color: #F24130">*</span></label>
                            <select class="form-select" id="addEmployee" required>
                                <option selected disabled value="">Select an employee</option>
                                <option value="Jamie Fox">Jamie Fox</option>
                                <option value="Taylor Reed">Taylor Reed</option>
                                <option value="Rachel Stan">Rachel Stan</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group d-flex radio-div flex-column gap-2">
                        <div class="form-group d-flex align-items-center gap-2">
                            <input class="form-check-input m-0" type="radio" name="jdModificationOption"
                                id="addNewEmployee" value="add">
                            <label class="form-check-label d-flex align-items-center gap-2 m-0"
                                for="addNewEmployee">
                                Add a new employee
                            </label>
                        </div>
                        <div class="form-group" id="newEmployeeGroup">
                            <label for="Reason for Adding New Employee">Reason for Adding New Employee <span
                                    style="color: #F24130">*</span></label>
                            <input type="text" class="form-control"
                                placeholder="Reason for Adding New Employee">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button type="button" class="cancel-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="disabledAssignBtn" class="orange-fill-disabled">
                        Assign Employee
                        <iconify-icon icon="material-symbols:info-outline-rounded" width="16" height="16"
                            data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Please select a job position."></iconify-icon>
                    </button>

                    <!-- Active Button that triggers modal -->
                    <button type="button" id="activeAssignBtn" class="orange-fill">
                        Assign Employee
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addPosition" tabindex="-1" aria-labelledby="addPositionLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addPositionLabel">Add Position</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column gap-4 p-4">
                    <div class="modal-content-p">
                        <p class="mb-2">Superior Information:</p>
                        <p class="mb-2"><b>Headcount ID: Jamie Fox (SF-001-01)</b></p>
                        <p class="mb-2"><b>Job Position: Senior Flight Dispatcher</b></p>
                        <p class="mb-2"><b>Job Position Level : Level 4</b></p>
                        <p class="m-0"><b>Department: Delivery</b></p>
                    </div>
                    <div class="form-group">
                        <label for="jobPosition">Job Position <span style="color: #F24130">*</span></label>
                        <select class="form-select" id="jobPosition" required>
                            <option selected disabled value="">Select a position</option>
                            <option value="Project Manager|PM|001">Project Manager</option>
                            <option value="Flight Dispatcher (Level 3)|FD|003">Flight Dispatcher (Level 3)</option>
                            <option value="Operations Lead|OL|005">Operations Lead</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Headcount ID</label>
                        <input type="text" id="headcountIdDisplay" readonly class="form-control"
                            placeholder="No Job Position Selected Yet">
                    </div>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button type="button" class="cancel-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="orange-fill-disabled">Add Position <iconify-icon
                            icon="material-symbols:info-outline-rounded" width="16" height="16"
                            data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Please select a job position."></iconify-icon></button>
                    <button type="button" class="orange-fill" data-bs-toggle="modal"
                        data-bs-target="#addPositionConfirm">Add Position</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addPositionConfirm" tabindex="-1" aria-labelledby="addPositionConfirmLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column gap-3 p-4 pt-0 text-center">
                    <iconify-icon icon="si:warning-line" width="70" height="70"
                        style="color: #F8BB86; margin: auto;"></iconify-icon>
                    <h4 class="m-0">Save Changes?</h4>
                    <p class="m-0">Saving changes to the org chart may affect the employee list and job
                        descriptions created. Do you want to proceed?</p>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button type="button" class="cancel-button" data-bs-dismiss="modal">Discard</button>
                    <button type="button" class="orange-fill">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="moveEmployee" tabindex="-1" aria-labelledby="moveEmployeeLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="moveEmployeeLabel">Move Employee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column gap-3 p-4">
                    <div class="modal-content-p">
                        <p class="mb-2">Select a vacant job position to reassign:</p>
                        <p class="m-0"><b>Jamie Fox (Senior Flight Dispatcher)</b></p>
                    </div>
                    <div class="form-group">
                        <label for="Department">Department <span style="color: #F24130">*</span></label>
                        <select class="form-select" required>
                            <option selected disabled value="">Select Department</option>
                            <option value="Department">Department</option>
                            <option value="Operations">Operations</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="vacantJobPosition">Vacant Job Position <span
                                style="color: #F24130">*</span></label>
                        <select class="form-select" required>
                            <option selected disabled value="">Select Vacant Job Position</option>
                            <option value="Crewing Manager (CM-001-02)">Crewing Manager (CM-001-02)</option>
                            <option value="Crew Controller (CC-001-01)">Crew Controller (CC-001-01)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Reason for Transfer</label>
                        <input type="text" class="form-control" placeholder="Reason for Transfer">
                    </div>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button type="button" class="cancel-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="orange-fill-disabled">Move Employee <iconify-icon
                            icon="material-symbols:info-outline-rounded" width="16" height="16"
                            data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Please select a department and vacant job position."></iconify-icon></button>
                    <button type="button" class="orange-fill">Move Employee</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="removeEmployee" tabindex="-1" aria-labelledby="removeEmployeeLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="removeEmployeeLabel">Remove Employee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column gap-3 p-4">
                    <div class="modal-content-p">
                        <p class="mb-2">Employee Information:</p>
                        <p class="m-0"><b>Employee Name: Benjamin Tan </b></p>
                        <p class="m-0"><b>Job Position: Head of Ops & Dispatch Projects </b></p>
                        <p class="m-0"><b>Department: Delivery </b></p>
                    </div>

                    <div class="form-group">
                        <label>Reason for Removal</label>
                        <input type="text" class="form-control" placeholder="Reason for Removal">
                    </div>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button type="button" class="cancel-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="orange-fill">Remove Employee</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editJD" tabindex="-1" aria-labelledby="editJDLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editJDLabel">Edit JD - Chief Executive Officer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column gap-3 p-4">
                    <div class="modal-content-p">
                        <p class="mb-2">Editing this job description, <b>Chief Executive Officer</b> will impact
                            1 <b>employee(s)</b> currently assigned to it.</p>
                        <p class="mb-2">Additionally, any subordinates under this role will also be affected. Any
                            changes made will be reflected in their records and may affect role alignment, skill
                            matching, and internal processes.</p>
                        <p>Please review your edits carefully before proceeding.</p>
                        <div class="form-check filter-side-label d-flex gap-2 align-items-center mb-2">
                            <input class="form-check-input" type="checkbox">
                            <p class="m-0">I understand that modifying this JD will affect assigned employees.
                            </p>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button type="button" class="cancel-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="orange-fill-disabled">Confirm & Proceed <iconify-icon
                            icon="material-symbols:info-outline-rounded" width="16" height="16"
                            data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Please acknowledge the impact by checking the box above to proceed."></iconify-icon></button>
                    <button type="button" class="orange-fill">Confirm & Proceed</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deletePosition" tabindex="-1" aria-labelledby="deletePositionLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deletePositionLabel">Delete Position</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column gap-3 p-4">
                    <div class="modal-content-p">
                        <p class="mb-2">Job Position Name:</p>
                        <p class="m-0"><b>Senior Flight Dispatcher</b></p>
                    </div>

                    <div class="form-group">
                        <label>Reason for Job Position Removal</label>
                        <input type="text" class="form-control" placeholder="Reason for Job Position Removal">
                    </div>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button type="button" class="cancel-button" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="orange-fill">Delete Position</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deletePositionName" tabindex="-1" aria-labelledby="deletePositionNameLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deletePositionNameLabel">Delete Position - Senior Flight
                        Dispatcher</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column gap-3 p-4">
                    <div class="modal-content-p">
                        <p class="mb-2">This job position, <b>Senior Flight Dispatcher</b> cannot be deleted
                            because it is currently assigned to 1 <b>employee(s)</b>. To proceed, you must first
                            reassign or remove these employees from this position.</p>
                        <p class="m-0">For assistance, please contact your administrator.</p>
                    </div>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button type="button" class="orange-fill" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deletePositionheadCount" tabindex="-1"
        aria-labelledby="deletePositionheadCountLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deletePositionheadCountLabel">Delete Position - Head of Ops &
                        Dispatch Projects</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column gap-3 p-4">
                    <div class="modal-content-p">
                        <p class="mb-2">This job position, Head of Ops & Dispatch Projects cannot be deleted
                            because it is the only available headcount for this role and has subordinates assigned
                            to it.</p>
                        <p class="mb-2">To maintain the organizational structure, this position must remain in
                            the org chart.</p>
                        <p class="m-0"> If you need assistance, please contact your administrator.</p>
                    </div>
                </div>
                <div class="modal-footer justify-content-center border-0 pt-0">
                    <button type="button" class="orange-fill" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deletePositionHeadcountMore" tabindex="-1"
        aria-labelledby="deletePositionHeadcountMoreLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deletePositionHeadcountMoreLabel">Delete Position - Crewing
                        Manager</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div>
                    <div class="modal-body p-4 d-flex gap-4">
                        <div class="d-flex flex-column align-items-start w-25">
                            <div class="d-flex align-items-center step" onclick="setActiveStep('a', 0)">
                                <div class="circle me-3" id="circle-a-0"></div>
                                <p class="mb-0 step-text" id="text-a-0">Select New Superior<br>Headcount</p>
                            </div>
                            <div class="line"></div>
                            <div class="d-flex align-items-center step" onclick="setActiveStep('a', 1)">
                                <div class="circle me-3" id="circle-a-1"></div>
                                <p class="mb-0 step-text" id="text-a-1">Confirm<br>Reassignment</p>
                            </div>
                        </div>


                        <div class="d-flex flex-column gap-4">
                            <div class="modal-content-p">
                                <h5 class="mb-3">Reassign Subordinates</h5>
                                <p class="m-0">This job position, <b>Crewing Manager</b> cannot be deleted
                                    because it
                                    has immediate subordinates assigned. Select a new superior for each subordinate.
                                    These
                                    changes will not be saved until you confirm in the next step.</p>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Job Position</th>
                                            <th>Headcount ID</th>
                                            <th>Employee Name</th>
                                            <th>New Superior Headcount ID <span class="text-danger">*</span></th>
                                            <th>Reason for Reassignment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Crew Controller</td>
                                            <td>CC-001-01</td>
                                            <td>Casey Jordan</td>
                                            <td>
                                                <select class="form-select select-headcount"
                                                    style="color: #99A1B7; height: 36px;">
                                                    <option selected disabled>Select New Superior Headcount ID
                                                    </option>
                                                    <option value="HC-101">HC-101</option>
                                                    <option value="HC-102">HC-102</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control reason-input"
                                                    placeholder="Reason for Reassignment" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Crew Controller</td>
                                            <td>CC-001-02</td>
                                            <td>Tina Liew</td>
                                            <td>
                                                <select class="form-select select-headcount"
                                                    style="color: #99A1B7; height: 36px;">
                                                    <option selected disabled>Select New Superior Headcount ID
                                                    </option>
                                                    <option value="HC-103">HC-103</option>
                                                    <option value="HC-104">HC-104</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control reason-input"
                                                    placeholder="Reason for Reassignment" disabled>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Reason for removal -->
                            <div class="form-group" id="reasonBox-a" style="display: none;">
                                <label>Reason for Reassignment (Group A)</label>
                                <input type="text" class="form-control" placeholder="Reason for Reassignment">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="cancel-button" data-bs-dismiss="modal">Previous: Reassign
                            Subordinates</button>
                        <div class="d-flex align-items-center gap-2">

                            <button type="button" class="cancel-button" data-bs-dismiss="modal"
                                style="border-color: #F7941C; color: #F7941C;">Cancel</button>
                            <button type="button" class="orange-fill-disabled">Continue : Proceed to Deletion
                                <iconify-icon icon="material-symbols:info-outline-rounded" width="16"
                                    height="16" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="Please acknowledge the impact by checking the box above to proceed."></iconify-icon></button>
                            <button type="button" class="orange-fill">Continue : Proceed to Deletion</button>
                            <button type="button" class="orange-fill">Confirm & Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reassignSubordinates" tabindex="-1" aria-labelledby="reassignSubordinatesLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="reassignSubordinatesLabel">Reassign Subordinates - Crewing
                        Manager</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div>
                    <div class="modal-body p-4 d-flex gap-4">
                        <div class="d-flex flex-column align-items-start w-25">
                            <div class="d-flex align-items-center step" onclick="setActiveStep('b', 0)">
                                <div class="circle me-3" id="circle-b-0"></div>
                                <p class="mb-0 step-text" id="text-b-0">Select New Superior<br>Headcount</p>
                            </div>
                            <div class="line"></div>
                            <div class="d-flex align-items-center step" onclick="setActiveStep('b', 1)">
                                <div class="circle me-3" id="circle-b-1"></div>
                                <p class="mb-0 step-text" id="text-b-1">Confirm<br>Reassignment</p>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-4">
                            <div class="modal-content-p">
                                <h5 class="mb-3">Reassign Subordinates</h5>
                                <p class="mb-2">This job position, <b>Crewing Manager</b>, has the following
                                    immediate subordinates. Please select a new superior headcount ID (another
                                    headcount under the same job position) for reassignment.</p>
                                <p class="m-0">By default, subordinates will not be reassigned. If you wish to
                                    reassign a subordinate, select a new superior headcount ID from the dropdown.
                                </p>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Job Position</th>
                                            <th>Headcount ID</th>
                                            <th>Employee Name</th>
                                            <th>New Superior Headcount ID</th>
                                            <th>Reason for Reassignment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Crew Controller</td>
                                            <td>CC-001-01</td>
                                            <td>Casey Jordan</td>
                                            <td>
                                                <select class="form-select select-headcount"
                                                    style="color: #99A1B7; height: 36px;">
                                                    <option selected disabled>Select New Superior Headcount ID
                                                    </option>
                                                    <option value="HC-101">HC-101</option>
                                                    <option value="HC-102">HC-102</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control reason-input"
                                                    placeholder="Reason for Reassignment" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Crew Controller</td>
                                            <td>CC-001-02</td>
                                            <td>Tina Liew</td>
                                            <td>
                                                <select class="form-select select-headcount"
                                                    style="color: #99A1B7; height: 36px;">
                                                    <option selected disabled>Select New Superior Headcount ID
                                                    </option>
                                                    <option value="HC-103">HC-103</option>
                                                    <option value="HC-104">HC-104</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control reason-input"
                                                    placeholder="Reason for Reassignment" disabled>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="cancel-button" data-bs-dismiss="modal">Previous: Reassign
                            Subordinates</button>
                        <div class="d-flex align-items-center gap-2">

                            <button type="button" class="cancel-button" data-bs-dismiss="modal"
                                style="border-color: #F7941C; color: #F7941C;">Cancel</button>
                            <button type="button" class="orange-fill-disabled">Previous: Select New Superior
                                Headcount
                                <iconify-icon icon="material-symbols:info-outline-rounded" width="16"
                                    height="16" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="Please acknowledge the impact by checking the box above to proceed."></iconify-icon></button>
                            <button type="button" class="orange-fill">Continue : Proceed to Reassignment</button>
                            <button type="button" class="orange-fill">Confirm Reassignment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

</div>
@endsection


@section('scripts')




<script>


function loadEmployeeProfile(employeeId) {
    var $jq = jQuery.noConflict();

    $jq.ajax({
        url: '/admin/ajax/employee-profile/' + employeeId,
        method: 'GET',
        success: function(response) {
            console.log(response);  // Log the response data to check

            // Populate profile info using innerHTML instead of jQuery
            const employeeName = document.getElementById('employee-name');
            employeeName.innerHTML = response.name;

            const bscScore = document.getElementById('bsc-score');
            // bscScore.innerHTML = 'BSC:%';

            const employeeTitle = document.getElementById('employee-title');
            employeeTitle.innerHTML = response.position;

            const employeeEmail = document.getElementById('employee-email');
            employeeEmail.innerHTML = response.email;

            // Populate badges
            const badgeFlightRisk = document.getElementById('badge-flight-risk');
            badgeFlightRisk.innerHTML = response.flight_risk;

            const badgeMatchRate = document.getElementById('badge-match-rate');
            badgeMatchRate.innerHTML = response.overall_match_rate;

            const badgeBehavioralFit = document.getElementById('badge-behavioral-fit');
            badgeBehavioralFit.innerHTML = response.behavioral_fit_rate;

            const badgeJobMatch = document.getElementById('badge-job-match');
            badgeJobMatch.innerHTML = response.job_match_rate;

            // Employee details
            const empHeadcountId = document.getElementById('emp-headcount-id');
            empHeadcountId.innerHTML = response.headcount_code;

            const empCode = document.getElementById('emp-code');
            empCode.innerHTML = response.employee_code;

            const empDept = document.getElementById('emp-dept');
            empDept.innerHTML = response.department;

            const empTa = document.getElementById('emp-ta');
            empTa.innerHTML = response.technical_assessment;

            const empSsmr = document.getElementById('emp-ssmr');
            empSsmr.innerHTML = response.soft_skill_match_rate;

            const empPpr = document.getElementById('emp-ppr');
            // empPpr.innerHTML = response.predictive_performance_rate;

            const empCog = document.getElementById('emp-cog');
            empCog.innerHTML = response.cognitive_test_result;

            const empRiasec = document.getElementById('emp-riasec');
            empRiasec.innerHTML = response.riasec;

            const empJobMatch = document.getElementById('emp-job-match');
            empJobMatch.innerHTML = response.job_match_rate;

            const empOcean = document.getElementById('emp-ocean');
            empOcean.innerHTML = response.ocean;

            const empGrowth = document.getElementById('emp-growth');
            empGrowth.innerHTML = response.growth_potential;

            const empAlign = document.getElementById('emp-align');
            empAlign.innerHTML = response.forecast_alignment;

            // Superior Info
            const supName = document.getElementById('sup-name');
            supName.innerHTML = response.superior.name;

            const supPosition = document.getElementById('sup-position');
            supPosition.innerHTML = response.superior.position;

            const supHeadcount = document.getElementById('sup-headcount');
            supHeadcount.innerHTML = response.superior.headcount_id;

            const supDept = document.getElementById('sup-dept');
            supDept.innerHTML = response.superior.department;

            // Show the offcanvas
            const offcanvasEl = document.getElementById('offcanvasLeft');
            const bsOffcanvas = new bootstrap.Offcanvas(offcanvasEl);
            bsOffcanvas.show();
        },
        error: function() {
            alert('Failed to load profile.');
        }
    });
}


    const $ = go.GraphObject.make;

    const myDiagram = $(go.Diagram, "organizationPositionsChart", {
        layout: $(go.TreeLayout, {
            angle: 90,
            layerSpacing: 20,
            arrangement: go.TreeLayout.ArrangementVertical
        }),
        "undoManager.isEnabled": true
    });

    // Function to add a new child node
    function addChildNode(parentNode) {
        const diagram = parentNode.diagram;
        if (!diagram) return;

        const model = diagram.model;
        const parentData = parentNode.data;

        // Generate a new unique key
        const nextKey = model.nodeDataArray.reduce((max, node) => Math.max(max, node.key), 0) + 1;

        // Define the new node data
        const newNodeData = {
            key: nextKey,
            parent: parentData.key,
            position: "New Position",
            department: "New Department",
            code: "NEW-" + nextKey,
            name: "New Employee",
            level: "1",
            profilePicUrl: "public/admin/media/svg/org-chart-svg/user.svg",
            isYou: false
        };

        // Add the new node to the model
        model.addNodeData(newNodeData);

        // Select the new node
        const newNode = diagram.findNodeForData(newNodeData);
        if (newNode) diagram.select(newNode);
    }

    function addChildNode(parentNode) {
        const diagram = parentNode.diagram;
        if (!diagram) return;

        diagram.startTransaction("Add Node");

        const model = diagram.model;
        const parentData = parentNode.data;
        const nextKey = model.nodeDataArray.reduce((max, node) => Math.max(max, node.key), 0) + 1;

        const newNodeData = {
            key: nextKey,
            parent: parentData.key,
            position: "New Position",
            department: parentData.department || "New Department",
            code: "NEW-" + nextKey,
            name: "New Employee",
            level: "1",
            profilePicUrl: "public/admin/media/svg/org-chart-svg/user.svg",
            isYou: false
        };

        model.addNodeData(newNodeData);
        diagram.commitTransaction("Add Node");

        // Optional: Select the new node
        const newNode = diagram.findNodeForData(newNodeData);
        if (newNode) diagram.select(newNode);
    }

    myDiagram.nodeTemplate =
        $(go.Node, "Auto", {
                selectionAdorned: false,
                minSize: new go.Size(300, 120), // Ensures consistent sizing
                mouseEnter: function(e, node) {
                    const plusButton = node.findObject("PLUS_BUTTON");
                    if (plusButton) plusButton.visible = true;
                },
                mouseLeave: function(e, node) {
                    const plusButton = node.findObject("PLUS_BUTTON");
                    if (plusButton) plusButton.visible = false;
                }
            },
            // Background shape
            $(go.Shape, "RoundedRectangle", {
                fill: "#FCFCFC",
                stroke: "#000",
                strokeWidth: 1,
                parameter1: 4
            }),

            // Main horizontal layout (percentage bar + content)
            $(go.Panel, "Horizontal", {
                    stretch: go.GraphObject.Fill
                },

                // 1. LEFT PERCENTAGE BAR (now truly flush left)
                $(go.Panel, "Auto", {
                        width: 40,
                        margin: 0,
                        stretch: go.GraphObject.Vertical,
                        // Only show if percent value exists and is not null/undefined
                        visible: false
                    },
                    new go.Binding("visible", "percent", function(p) {
                        return p !== null && p !== undefined && p !== "";
                    }),

                    $(go.Shape, "Rectangle", {
                            fill: "#D6F0D5", // Default light green
                            stroke: null,
                            name: "PERCENT_BAR" // Give it a name for binding
                        },
                        // Dynamic color binding - assumes your data has a 'percentColor' property
                        new go.Binding("fill", "percentColor")
                    ),

                    $(go.TextBlock, {
                            margin: 2,
                            stroke: "black",
                            font: "bold 14px sans-serif",
                            alignment: go.Spot.Center,
                            // Optional: Format the percent value with % sign
                            textAlign: "center"
                        },
                        new go.Binding("text", "percent", function(p) {
                            return p !== null && p !== undefined ? p + "%" : "";
                        })
                    )
                ),

                // 2. MAIN CONTENT AREA
                $(go.Panel, "Vertical", {
                        margin: 16,
                        defaultAlignment: go.Spot.Left
                    },

                    // Top Row -> Employee Code & Badge
                    $(go.Panel, "Table", {
                            padding: new go.Margin(0, 0, 16, 0),
                            defaultAlignment: go.Spot.Left
                        },

                        // Department
                        $(go.Panel, "Auto", {
                                column: 0,
                                cursor: "default",
                                padding: new go.Margin(0, 6, 0, 0)
                            },
                            $(go.Shape, "RoundedRectangle", // background shape
                                {
                                    fill: "#F1F1F4", // background color
                                    stroke: "transparent", // no border
                                    parameter1: 4 // rounded corners
                                }
                            ),
                            $(go.TextBlock, {
                                    font: "12px sans-serif",
                                    stroke: "#6b7280",
                                    margin: new go.Margin(2, 6, 2, 6), // padding inside like a button
                                    wrap: go.TextBlock.None,
                                    isMultiline: false
                                },
                                new go.Binding("text", "department")
                            )
                        ),

                        // Employee Code
                        $(go.Panel, "Auto", {
                                column: 1,
                                cursor: "default"
                            },
                            $(go.Shape, "RoundedRectangle", // background shape
                                {
                                    fill: "#F1F1F4", // background color
                                    stroke: "transparent", // no border
                                    parameter1: 4 // rounded corners
                                }
                            ),
                            $(go.TextBlock, {
                                    font: "12px sans-serif",
                                    stroke: "#6b7280",
                                    margin: new go.Margin(2, 6, 2, 6), // padding inside like a button
                                    wrap: go.TextBlock.None,
                                    isMultiline: false
                                },
                                new go.Binding("text", "code")
                            )
                        ),

                        // Badge (Like "YOU")
                        $(go.Panel, "Auto", {
                                column: 2,
                                margin: new go.Margin(0, 0, 0, 8),
                                visible: false // Hide whole badge
                            },
                            new go.Binding("visible", "isYou"), // Only show when isYou is true

                            $(go.Shape, "RoundedRectangle", {
                                fill: "#FCCF98",
                                stroke: "transparent",
                                parameter1: 4, // Rounded corners
                            }),

                            $(go.TextBlock, {
                                    stroke: "#4B5675",
                                    font: "500 10px sans-serif",
                                    textAlign: "center",
                                    verticalAlignment: go.Spot.Center,
                                    margin: new go.Margin(2, 6, 2, 6) // Padding inside badge
                                },
                                new go.Binding("text", "badgeText")
                            )
                        ),
                    ),

                    // Position
                    $(go.Panel, "Horizontal", // 2 Columns: Left & Right
                        {
                            defaultAlignment: go.Spot.Left
                        },

                        // Left Side (Position + Level + Name)
                        $(go.Panel, "Vertical", {
                                defaultAlignment: go.Spot.Left,
                                alignment: go.Spot.Top // <--- This is the key for level to stick to top
                            },

                            // Position + Level Row
                            $(go.Panel, "Horizontal", {
                                    margin: new go.Margin(0, 0, 4, 0),
                                },
                                $(go.TextBlock, {
                                        font: "600 14px sans-serif",
                                        stroke: "#111827",
                                        wrap: go.TextBlock.WrapFit, // for long text wrap
                                        margin: new go.Margin(0, 8, 0, 0)
                                    },
                                    new go.Binding("text", "position")
                                ),
                                $(go.Panel, "Horizontal", {
                                        margin: new go.Margin(0, 0, 0, 4),
                                        alignment: go.Spot.Left
                                    },

                                    // Icon
                                    $(go.Shape, {
                                        geometryString: "F M2 12 H4 V9 H2 Z M5 12 H7 V7 H5 Z M8 12 H10 V5 H8 Z M11 12 H13 V3 H11 Z",
                                        fill: "#99A1B7",
                                        strokeWidth: 0,
                                        desiredSize: new go.Size(12, 12),
                                        margin: new go.Margin(0, 4, 0, 0) // space between icon & text
                                    }),

                                    // Text
                                    $(go.TextBlock, {
                                            font: "12px sans-serif",
                                            stroke: "#99A1B7",
                                        },
                                        new go.Binding("text", "level"))
                                )

                            ),

                            // Name Row
                            $(go.TextBlock, {
                                    font: "400 12px sans-serif",
                                    stroke: "#000000",
                                    margin: new go.Margin(6, 0, 0, 0)
                                },
                                new go.Binding("text", "name")
                            )
                        ),

                        // Right Side (Profile Image)
                        $(go.Picture, {
                                width: 40,
                                height: 40,
                                alignment: go.Spot.Right,
                                margin: new go.Margin(0, 0, 0, 16),
                                imageStretch: go.GraphObject.Uniform, // Maintain aspect ratio
                                background: "#ccc", // fallback bg color while loading
                            },
                            new go.Binding("source", "profilePicUrl", function(img) {
                                return img ? img : "public/admin/media/svg/org-chart-svg/user.svg";
                            })
                        )
                    ),

                    // Button Row - View JD and View Profile
                    $(go.Panel, "Horizontal", {
                            margin: new go.Margin(20, 0, 0, 0),
                            alignment: go.Spot.Center,
                            defaultAlignment: go.Spot.Center
                        },
                        new go.Binding("visible", "isYou", function(v) {
                            return !v;
                        }), // Hide buttons for "You" node

                        // View JD Button
                        $(go.Panel, "Auto", {
                                cursor: "pointer",
                                mouseEnter: function(e, obj) {
                                    const shape = obj.findObject("JD_BUTTON_SHAPE");
                                    const icon = obj.findObject("JD_ICON");
                                    const text = obj.findObject("JD_TEXT");

                                    if (shape) shape.fill = "#000";
                                    if (icon) icon.source = "/admin/media/svg/org-chart-svg/briefcase-white.svg";
                                    if (text) text.stroke = "#FFFFFF";
                                },
                                mouseLeave: function(e, obj) {
                                    const shape = obj.findObject("JD_BUTTON_SHAPE");
                                    const icon = obj.findObject("JD_ICON");
                                    const text = obj.findObject("JD_TEXT");

                                    if (shape) shape.fill = "#F1F1F4";
                                    if (icon) icon.source = "/admin/media/svg/org-chart-svg/briefcase.svg";
                                    if (text) text.stroke = "#4B5675";
                                },
                                click: function(e, obj) {
                                    const data = obj.part.data;
                                    window.open(
                                        "/admin/saved-jobdescriptions?org_department=" + data.department_id + "&saved_job=1&selected_job=" + data.job_id,
                                        "_blank"
                                        );
                                }
                            },
                            $(go.Shape, "RoundedRectangle", {
                                name: "JD_BUTTON_SHAPE",
                                fill: "#F1F1F4",
                                parameter1: 4,
                                strokeWidth: 0,
                            }),
                            $(go.Panel, "Horizontal", {
                                    margin: new go.Margin(8, 16, 8, 16)
                                },
                                $(go.Picture, {
                                    name: "JD_ICON",
                                    source: "/admin/media/svg/org-chart-svg/briefcase.svg",
                                    width: 14,
                                    height: 14,
                                    margin: new go.Margin(0, 0, 0, 6)
                                }),
                                $(go.TextBlock, "View JD", {
                                    name: "JD_TEXT",
                                    stroke: "#4B5675",
                                    font: "500 12px Inter, sans-serif",
                                    margin: new go.Margin(0, 0, 0, 4)
                                })
                            )
                        ),

                        // Vertical separator line
                        $(go.Shape, "LineV", {
                            stroke: "#000000",
                            strokeWidth: 1,
                            height: 26,
                            margin: new go.Margin(0, 0, 0, 0)
                        }),

                        // View Profile Button
                        $(go.Panel, "Auto", {
                                cursor: "pointer",
                                mouseEnter: function(e, obj) {
                                    const shape = obj.findObject("PROFILE_BUTTON_SHAPE");
                                    const icon = obj.findObject("MORE_ICON"); // Changed from PROFILE_ICON
                                    const text = obj.findObject("PROFILE_TEXT");

                                    if (shape) shape.fill = "#000";
                                    if (icon) icon.source =
                                        "/admin/media/svg/org-chart-svg/eye-white.svg"; // Optional white icon on hover
                                    if (text) text.stroke = "#FFFFFF";
                                },
                                mouseLeave: function(e, obj) {
                                    const shape = obj.findObject("PROFILE_BUTTON_SHAPE");
                                    const icon = obj.findObject("MORE_ICON");
                                    const text = obj.findObject("PROFILE_TEXT");

                                    if (shape) shape.fill = "#F1F1F4";
                                    if (icon) icon.source =
                                        "/admin/media/svg/org-chart-svg/eye.svg"; // Restore normal icon
                                    if (text) text.stroke = "#4B5675";
                                },
                                click: function(e, obj) {
                                    // const offcanvasElement = document.getElementById('offcanvasLeft');
                                    // if (offcanvasElement) {
                                    //     const bsOffcanvas = new bootstrap.Offcanvas(offcanvasElement);
                                    //     bsOffcanvas.show();
                                    // }

                                    const data = obj.part.data;
                                    // Pass data to Offcanvas if needed
                                    if (data.user_id && data.user_id !== null) {
                                        // Assuming you have a function to load the employee profile
                                        loadEmployeeProfile(data.user_id);
                                    } 
                                }
                            },
                            // Rounded rectangle background
                            $(go.Shape, "RoundedRectangle", {
                                name: "PROFILE_BUTTON_SHAPE",
                                fill: "#F1F1F4",
                                parameter1: 4,
                                strokeWidth: 0,
                            }),
                            // Horizontal layout for icon + text
                            $(go.Panel, "Horizontal", {
                                    margin: new go.Margin(8, 16, 8, 16)
                                },
                                $(go.Picture, {
                                    name: "MORE_ICON",
                                    source: "/admin/media/svg/org-chart-svg/eye.svg",
                                    width: 14,
                                    height: 14,
                                    margin: new go.Margin(0, 0, 0, 6)
                                }),
                                $(go.TextBlock, "View Profile", {
                                    name: "PROFILE_TEXT",
                                    stroke: "#4B5675",
                                    font: "500 12px Inter, sans-serif",
                                    margin: new go.Margin(0, 0, 0, 4)
                                })
                            )
                        ),

                        // Vertical separator line
                        $(go.Shape, "LineV", {
                            stroke: "#000000",
                            strokeWidth: 1,
                            height: 26,
                            margin: new go.Margin(0, 0, 0, 0)
                        }),

                        // More Actions Button
                        $(go.Panel, "Auto", {
                                cursor: "pointer",
                                mouseEnter: function(e, obj) {
                                    obj.findObject("MORE_BUTTON_SHAPE").fill = "#000";
                                    obj.findObject("MORE_ICON").fill = "#FFFFFF";
                                    obj.findObject("MORE_TEXT").stroke = "#FFFFFF";
                                },
                                mouseLeave: function(e, obj) {
                                    obj.findObject("MORE_BUTTON_SHAPE").fill = "#F1F1F4";
                                    obj.findObject("MORE_ICON").fill = "#4B5675";
                                    obj.findObject("MORE_TEXT").stroke = "#4B5675";
                                },
                                click: function(e, obj) {
                                    showDropdown(e, obj);
                                }
                            },
                            $(go.Shape, "RoundedRectangle", {
                                name: "MORE_BUTTON_SHAPE",
                                fill: "#F1F1F4",
                                parameter1: 4,
                                strokeWidth: 0,
                            }),
                            $(go.Panel, "Horizontal", {
                                    margin: new go.Margin(8, 16, 8, 16)
                                },

                                $(go.TextBlock, "More Actions", {
                                    name: "MORE_TEXT",
                                    stroke: "#4B5675",
                                    font: "500 12px Inter, sans-serif",
                                    margin: new go.Margin(0, 0, 0, 0)
                                }),
                                $(go.Picture, {
                                    name: "MORE_ICON",
                                    source: "/admin/media/svg/org-chart-svg/chevron-right.svg", // Replace this with the actual path to your SVG file
                                    width: 14,
                                    height: 14,
                                    margin: new go.Margin(0, 0, 0, 4)
                                }),
                            )
                        ),
                    ),
                    // "+" Button to add child nodes (NEW) add position node
                    // Inside your node template, where other buttons are defined:
                    // $(go.Panel, "Horizontal", {
                    //         alignment: go.Spot.Center,
                    //         margin: new go.Margin(10, 0, 0, 0)
                    //     },
                    //     $(go.Panel, "Auto", {
                    //             cursor: "pointer",
                    //             click: function(e, obj) {
                    //                 addChildNode(obj.part);
                    //             },
                    //             visible: false, // Initially hidden
                    //             name: "PLUS_BUTTON", // Name for reference
                    //             // Hover effects
                    //             mouseEnter: function(e, obj) {
                    //                 const shape = obj.findObject("PLUS_CIRCLE");
                    //                 if (shape) shape.fill = "#000"; // Darker green on hover
                    //             },
                    //             mouseLeave: function(e, obj) {
                    //                 const shape = obj.findObject("PLUS_CIRCLE");
                    //                 if (shape) shape.fill = "#000"; // Original green
                    //             }
                    //         },
                    //         $(go.Shape, "RoundedRectangle", { // Changed from "Rectangle" to "RoundedRectangle"
                    //             fill: "#000",
                    //             stroke: "#000",
                    //             strokeWidth: 1,
                    //             width: 16,
                    //             height: 16,
                    //             name: "PLUS_BOX",
                    //             parameter1: 4 // This now works to control corner radius
                    //         }),
                    //         $(go.TextBlock, "+", {
                    //             stroke: "white",
                    //             font: "bold 14px sans-serif",
                    //             margin: 2
                    //         })
                    //     )
                    // )
                )
            )
        ).add(go.GraphObject.build('TreeExpanderButton', {
            _treeExpandedFigure: 'LineUp',
            _treeCollapsedFigure: 'LineDown',
            name: 'BUTTONX',
            alignment: go.Spot.Bottom,
            opacity: 0 // initially not visible
            })
            // button is visible either when node is selected or on mouse-over
            .bindObject('opacity', 'isSelected', (s) => (1)))
            .bindTwoWay('isTreeExpanded');

    myDiagram.linkTemplate =
        $(go.Link, {
                routing: go.Link.Orthogonal,
                corner: 10
            },
            $(go.Shape, {
                strokeWidth: 1.5,
                stroke: "#555"
            })
        );

        myDiagram.model = new go.TreeModel({
            nodeDataArray: [], // will be populated later
            keyProperty: "key",
            parentProperty: "parent"
        });

    myDiagram.addDiagramListener("ViewportBoundsChanged", function() {
        const dropdown = document.getElementById('dropdownMenu');
        if (dropdown && dropdown.style.display === 'block') {
            dropdown.style.display = 'none';
            activeDropdown = null;
            currentButtonKey = null;
            document.removeEventListener('click', handleOutsideClick);
        }
    });

    // Load the data into the diagram


    let page = 1;  // Track current page for lazy loading
    let isLoading = false;
    let organizationChartData = [];
    // Function to fetch more data
    function loadMoreData() {
        if (isLoading) return; // Prevent multiple AJAX calls
        isLoading = true;

        var $jq = jQuery.noConflict();

        // AJAX request to fetch new data
        $jq.ajax({
            url: '/admin/ajax/organization-chart',  // Adjust this with the correct route
            method: 'GET',
            data: {
                page: page,
            },
            success: function(response) {
            if (response.data.length > 0) {
                // Get current data from the diagram
                var existingData = myDiagram.model.nodeDataArray.slice();
                var keySet = new Set(existingData.map(n => n.key));

                // Prepare cleaned new data
                var cleanedNewData = response.data.map(n => {
                    // Remove parent if it's null
                    if (n.parent === null) {
                        const { parent, ...rest } = n;
                        return rest;
                    }
                    n.isYou = n.isYou === 1;
                    if (n.isYou === 1) {
                        n.badgeText = "You";
                    }
                    return n;
                });

                // Merge non-duplicates
                cleanedNewData.forEach(n => {
                    if (!keySet.has(n.key)) {
                        existingData.push(n);
                        keySet.add(n.key);
                    }
                });

                // Rebuild the model
                myDiagram.model = new go.TreeModel(existingData);
                // Next page
                page++;
            }

            isLoading = false;
        },

            error: function() {
                // $('#loading').hide();
                isLoading = false;
                alert("Failed to load more data.");
            }
        });
    }


    document.getElementById('container').addEventListener('scroll', () => {
    if (!isLoading && nearBottom()) {
        loadMoreData();
    }
    });

    function nearBottom() {
    const el = document.getElementById('container');
    return el.scrollHeight - el.scrollTop <= el.clientHeight + 200;
    }



    loadMoreData();
    console.log(organizationChartData);
    // myDiagram.model = new go.TreeModel(orgChartData);

    

    // Detect when user reaches the bottom of the page
    // $(window).scroll(function() {
    //     if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
    //         loadMoreData();
    //     }
    // });




</script>


<script>
    let activeDropdown = null;
    let currentButtonKey = null;

    function showDropdown(e, obj) {
        const diagram = e.diagram;
        const dropdown = document.getElementById('dropdownMenu');
        const buttonKey = obj.part.data.key;

        // Remove any previous listener (important!)
        document.removeEventListener('click', handleOutsideClick);

        // If dropdown is open for another button, close it first
        if (dropdown.style.display === 'block' && buttonKey !== currentButtonKey) {
            dropdown.style.display = 'none';
            activeDropdown = null;
            currentButtonKey = null;
        }

        // If already open for the same button, just toggle it closed
        if (dropdown.style.display === 'block' && buttonKey === currentButtonKey) {
            dropdown.style.display = 'none';
            activeDropdown = null;
            currentButtonKey = null;
            return;
        }

        // Position the dropdown near the button
        const buttonTopLeft = obj.getDocumentPoint(go.Spot.TopLeft);
        const buttonBottomRight = obj.getDocumentPoint(go.Spot.BottomRight);

        const screenTopLeft = diagram.transformDocToView(buttonTopLeft);
        const screenBottomRight = diagram.transformDocToView(buttonBottomRight);

        const offsetX = 40;
        const offsetY = 184;

        dropdown.style.position = 'absolute';
        dropdown.style.left = `${screenBottomRight.x + offsetX}px`;
        dropdown.style.top = `${screenTopLeft.y + offsetY}px`;
        dropdown.style.display = 'block';
        dropdown.dataset.nodeKey = buttonKey;

        activeDropdown = dropdown;
        currentButtonKey = buttonKey;

        // Delay adding click listener so it doesn't trigger from this same click
        setTimeout(() => {
            document.addEventListener('click', handleOutsideClick);
        }, 0);
    }

    function handleOutsideClick(event) {
        const dropdown = activeDropdown;
        if (!dropdown) return;

        // If click is outside dropdown, hide it
        if (!dropdown.contains(event.target)) {
            dropdown.style.display = 'none';
            activeDropdown = null;
            currentButtonKey = null;
            document.removeEventListener('click', handleOutsideClick);
        }
    }
</script>

<script>
    // Sample database of existing headcounts (in real app, this would come from an API)
    const existingHeadcounts = {
        "PM": ["PM-001-01", "PM-001-02"], // Project Manager
        "FD": ["FD-003-01", "FD-003-02"], // Flight Dispatcher
        "OL": ["OL-005-01"] // Operations Lead
    };

    document.getElementById('jobPosition').addEventListener('change', function() {
        const displayField = document.getElementById('headcountIdDisplay');
        const selectedValue = this.value;

        if (selectedValue) {
            const [positionName, prefix, deptId] = selectedValue.split('|');

            // Get existing IDs for this position type
            const existingIds = existingHeadcounts[prefix] || [];

            // Calculate next sequence number
            const lastSeq = existingIds.length > 0 ?
                parseInt(existingIds[existingIds.length - 1].split('-')[2]) :
                0;
            const nextSeq = String(lastSeq + 1).padStart(2, '0');

            // Generate new headcount ID
            const newHeadcountId = `${prefix}-${deptId}-${nextSeq}`;

            // Update the display field
            displayField.value = newHeadcountId;
        } else {
            displayField.value = '';
            displayField.placeholder = 'No Job Position Selected Yet';
        }
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function(tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

<script>
    const existingEmployeeGroup = document.getElementById("existingEmployeeGroup");
    const newEmployeeGroup = document.getElementById("newEmployeeGroup");
    const radios = document.getElementsByName("jdModificationOption");

    const disabledAssignBtn = document.getElementById("disabledAssignBtn");
    const activeAssignBtn = document.getElementById("activeAssignBtn");

    // Hide both form sections initially
    existingEmployeeGroup.style.display = "none";
    newEmployeeGroup.style.display = "none";

    radios.forEach(radio => {
        radio.addEventListener("change", function() {
            if (this.value === "modify") {
                existingEmployeeGroup.style.display = "block";
                newEmployeeGroup.style.display = "none";

                // Change button texts
                disabledAssignBtn.innerHTML =
                    'Assign Employee <iconify-icon icon="material-symbols:info-outline-rounded" width="16" height="16" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Please select a job position."></iconify-icon>';
                activeAssignBtn.innerText = 'Assign Employee';

            } else if (this.value === "add") {
                existingEmployeeGroup.style.display = "none";
                newEmployeeGroup.style.display = "block";

                // Change button texts
                disabledAssignBtn.innerHTML =
                    'Add Employee <iconify-icon icon="material-symbols:info-outline-rounded" width="16" height="16" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Please select a job position."></iconify-icon>';
                activeAssignBtn.innerText = 'Add Employee';
            }
        });
    });
</script>

<script>
    document.querySelectorAll('.select-headcount').forEach((select, index) => {
        select.addEventListener('change', function() {
            const reasonInput = document.querySelectorAll('.reason-input')[index];
            if (this.value) {
                reasonInput.disabled = false;
                reasonInput.focus();
            }
        });
    });
</script>

<script>
    function setActiveStep(groupId, index) {
        for (let i = 0; i < 2; i++) {
            document.getElementById(`circle-${groupId}-${i}`).classList.remove('active');
            document.getElementById(`text-${groupId}-${i}`).classList.remove('active');
        }

        document.getElementById(`circle-${groupId}-${index}`).classList.add('active');
        document.getElementById(`text-${groupId}-${index}`).classList.add('active');

        const reasonBox = document.getElementById(`reasonBox-${groupId}`);
        if (reasonBox) {
            reasonBox.style.display = (index === 1) ? 'block' : 'none';
        }
    }

    // Default initialize both groups to step 0
    window.onload = function() {
        setActiveStep('a', 0);
        setActiveStep('b', 0);
    };
</script>


<script>
//     function loadEmployeeProfile(employeeId) {
//         var $jq = jQuery.noConflict();
    
//         $jq.ajax({
//         url: '/admin/ajax/employee-profile/' + employeeId,
//         method: 'GET',
//         success: function(response) {
//             // Populate profile
//             console.log(response);
            
//             $('#employee-name').text(response.name);
//             $('#bsc-score').text('BSC: ' + response.bsc + '%');
//             $('#employee-title').text(response.position);
//             $('#employee-email').text(response.email);

//             // Badges
//             $('#badge-flight-risk').text(response.flight_risk);
//             $('#badge-match-rate').text(response.overall_match_rate);
//             $('#badge-behavioral-fit').text(response.behavioral_fit_rate);
//             $('#badge-job-match').text(response.job_match_rate);

//             // Employee details
//             $('#emp-headcount-id').text(response.headcount_id);
//             $('#emp-code').text(response.employee_code);
//             $('#emp-dept').text(response.department);
//             $('#emp-ta').text(response.technical_assessment);
//             $('#emp-ssmr').text(response.soft_skill_match_rate);
//             $('#emp-ppr').text(response.predictive_performance_rate);
//             $('#emp-cog').text(response.cognitive_test_result);
//             $('#emp-riasec').text(response.riasec);
//             $('#emp-job-match').text(response.job_match_rate);
//             $('#emp-ocean').text(response.ocean);
//             $('#emp-growth').text(response.growth_potential);
//             $('#emp-align').text(response.forecast_alignment);

//             // Superior Info
//             $('#sup-name').text(response.superior.name);
//             $('#sup-position').text(response.superior.position);
//             $('#sup-headcount').text(response.superior.headcount_id);
//             $('#sup-dept').text(response.superior.department);

//             // Show the offcanvas
//             const offcanvasEl = document.getElementById('offcanvasLeft');
//             const bsOffcanvas = new bootstrap.Offcanvas(offcanvasEl);
//             bsOffcanvas.show();
//         },
//         error: function() {
//             alert('Failed to load profile.');
//         }
//     });
// }






</script>

@endsection
