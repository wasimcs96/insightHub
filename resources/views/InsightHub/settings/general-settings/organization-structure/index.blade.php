@extends('insighthub.layout.app')

@section('title', 'Business Unit')

@section('styles')
    <style>
        .top-heading {
            color: #2E2F38;
            font-size: 32.5px;
            font-weight: 600;
            line-height: 39px;
        }

        .custom-text-muted {
            color: #727790;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
        }

        .settings-card {
            padding: 24px;
            border-radius: 8px;
            border-right: 1px solid #F1F1F4;
            border-bottom: 1px solid #F1F1F4;
            border-left: 1px solid #F1F1F4;
            background: #FFF;
            box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.03);
        }

        .page-heading {
            color: #2E2F38;
            font-size: 32px;
            font-weight: 600;
        }

        .search-box {
            border: 1px solid #C8CFD9;
            border-radius: 8px;
            padding: 8px 14px;
            width: 250px;
        }

        .custom-btn {
            display: flex;
            height: 48px;
            padding: 8px 16px;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            line-height: 20px;
        }

        .custom-btn.orange-fill {
            background: #F7941C;
            color: #FFF;
            border: none;
        }

        .custom-btn.grey-outline {
            background: #fff;
            color: #727790;
            border: 1px solid #858BA6;
        }

        .os-table thead {
            background: #F5F7F8;
            color: #2E2F38;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
        }

        .os-table td,
        .os-table th {
            vertical-align: middle !important;
            color: #2E2F38 !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            line-height: 20px;
            border-bottom: 1px solid #ECF0F3 !important;
        }

        .truncate-text {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 470px;
        }

        .action-icons iconify-icon {
            color: #2E2F38;
        }

        .pagination .page-link {
            display: flex;
            width: 51px;
            height: 51px;
            padding: 16px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            color: #2E2F38;
            border: 1px solid #ECF0F3;
            margin: 0 4px;
            padding: 6px 12px;
            background: #FFF;
        }

        .pagination .active>.page-link {
            background: #F7941C;
            border-color: #F7941C;
            color: #FFF;
        }

        .results-select {
            border-radius: 8px;
            border: 1px solid #D0D5DD;
            padding: 6px;
        }

        .feedback-message {
            display: flex;
            border-radius: 8px;
            border: 1px solid #BBECC5;
            background: #DDF5E2;
            padding: 24px;
        }

        .feedback-message p {
            color: #19622A;
            font-size: 16px;
            font-weight: 400;
            line-height: 21px;
        }

        .feedback-message .icon {
            color: #727790;
        }

        .table:not(.table-bordered) td:first-child,
        .table:not(.table-bordered) th:first-child,
        .table:not(.table-bordered) tr:first-child,
        .table:not(.table-bordered) td:last-child,
        .table:not(.table-bordered) th:last-child,
        .table:not(.table-bordered) tr:last-child,
        .table:not(.table-bordered) tbody tr:last-child td,
        .table:not(.table-bordered) tbody tr:last-child th,
        .table:not(.table-bordered) tfoot tr:last-child td,
        .table:not(.table-bordered) tfoot tr:last-child th {
            padding-left: 9.750px;
            padding-right: 16px;
            border: 0;
            border-bottom: 1px solid #ECF0F3 !important;
        }

        input:focus-visible {
            outline: none;
        }

        .table-border {
            border-radius: 4px;
            border: 1px solid #ECF0F3;
        }

        .thead-icon {
            color: #C8CFD9;
        }

        .thead-icon:hover,
        .thead-icon:active {
            color: #F7941C;
        }

        .modal-body {
            background: #FCFCFC;
        }

        .delete-modal {
            border-radius: 12px;
            position: relative;
            text-align: center;
        }

        .delete-modal h5 {
            color: #2E2F38;
            font-size: 22.75px;
            font-weight: 600;
            line-height: 27.3px;
            margin-top: 12px;
            margin-bottom: 8px;
        }

        .delete-modal p {
            color: #727790;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            margin-bottom: 20px;
        }

        .warning-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid #F24130;
            color: #F24130;
            font-size: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-close-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            border: none;
            background: none;
            font-size: 22px;
            color: #727790;
            cursor: pointer;
        }

        .modal-custom-btn {
            display: flex;
            height: 48px;
            padding: 12px 16px;
            justify-content: center;
            align-items: center;
            flex: 1 0 0;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
        }

        .modal-cancel-btn {
            background: #FFF;
            color: #2E2F38;
            border: 1px solid #858BA6;
        }

        .modal-confirm-btn {
            background: #F24130;
            color: #FFF;
            border: 1px solid #F24130;
        }

        .sub-tab {
            border-radius: 8px;
            border: 1px solid #F7941C;

        }

        .nav-pills .nav-link {
            padding: 8px 16px;
            border-radius: 8px;
            color: #F7941C;
            font-size: 16px;
            font-weight: 600;
            border-radius: 0;

        }

        .nav-pills .nav-link.active {
            background: #F7941C;
            color: #fff !important;
        }

        .empty-state {
            text-align: center;
            display: flex;
            padding: 48px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
            border: 1px dashed #C8CFD9;
        }

        .empty-state h5 {
            color: #2E2F38;
            font-size: 20px;
            font-weight: 600;
        }

        .empty-icon {
            margin: auto;
            display: flex;
            width: 48px;
            height: 48px;
            padding: 12px;
            justify-content: center;
            align-items: center;
            border-radius: 100px;
            background: #F5F7F8;
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                    Business Unit
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">General Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Organization Structure</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">- Business Unit</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div id="feedbackMessage" class="justify-content-between align-items-center feedback-message mt-3 mb-3">
                <p class="text-center fw-medium m-0"><b>Success!</b> Business unit created successfully.</p>
                <iconify-icon icon="iconamoon:close" width="20" height="20" class="cursor-pointer"
                    id="closeIcon"></iconify-icon>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">
            @include('insighthub.settings.index')


            <div class="tab-content">
                <div class="tab-pane fade" id="company" role="tabpanel">
                    <div class="settings-card">
                        <h4>Company</h4>
                        <p class="custom-text-muted">Setup onboarding and notification templates...</p>
                    </div>
                </div>

                <div class="tab-pane fade" id="values" role="tabpanel">
                    <div class="settings-card">
                        <h4>Company Values</h4>
                        <p class="custom-text-muted">Add value details, mission, vision etc...</p>
                    </div>
                </div>


                <div class="tab-pane fade show active" id="structure" role="tabpanel">
                    <div class="settings-card">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <ul class="nav nav-pills sub-tab" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-business-unit-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-business-unit" type="button" role="tab"
                                        aria-controls="pills-business-unit" aria-selected="true">Business Unit</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-companies-division-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-companies-division" type="button" role="tab"
                                        aria-controls="pills-companies-division"
                                        aria-selected="false">Companies/Division</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-departments-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-departments" type="button" role="tab"
                                        aria-controls="pills-departments" aria-selected="false">Departments</button>
                                </li>
                            </ul>

                            <div class="d-flex gap-3 align-items-center">
                                <div class="input-group">
                                    <input type="text" class="search-box" placeholder="Search business unit">
                                    <span class="input-group-text">
                                        <iconify-icon icon="ic:round-search" width="20"></iconify-icon>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-business-unit" role="tabpanel"
                                aria-labelledby="pills-business-unit-tab" tabindex="0">
                                <div class="d-flex align-items-center justify-content-between my-8">
                                    <h4 class="m-0 top-heading text-start">Manage Business Units</h4>
                                    <button class="custom-btn orange-fill" data-bs-toggle="modal"
                                        data-bs-target="#AddBusinessUnit">
                                        <span class="me-2 d-flex align-items-center">
                                            <iconify-icon icon="ic:round-plus" width="20"
                                                height="20"></iconify-icon>
                                        </span>
                                        Add Business Unit
                                    </button>

                                </div>

                                <div class="table-border">
                                    <div class="table-responsive">
                                        <table class="table os-table align-middle m-0">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <div class="d-flex gap-2 align-items-center">Business Unit Name
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="d-flex gap-2 align-items-center">No of employees
                                                        </div>
                                                    </th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>Global Tech Operations</td>
                                                    <td>6</td>
                                                    <td class="text-center action-icons">

                                                        <iconify-icon icon="lucide:edit" width="16" height="16"
                                                            class="cursor-pointer" data-bs-toggle="modal"
                                                            data-bs-target="#EditBusinessUnit"
                                                            data-name="Global Tech Operations"></iconify-icon>
                                                        <iconify-icon icon="gg:trash" width="20" height="20"
                                                            class="ms-7 cursor-default" style="color: #99A1B7;">
                                                        </iconify-icon>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Corporate Services</td>
                                                    <td>0</td>
                                                    <td class="text-center action-icons">

                                                        <iconify-icon icon="lucide:edit" width="16" height="16"
                                                            class="cursor-pointer" data-bs-toggle="modal"
                                                            data-bs-target="#EditBusinessUnit"
                                                            data-name="Corporate Services">
                                                        </iconify-icon>

                                                        <iconify-icon icon="gg:trash" width="20" height="20"
                                                            class="ms-7 cursor-pointer" style="color: #F24130;"
                                                            data-bs-toggle="modal" data-bs-target="#DeleteBusinessUnit"
                                                            data-id="1" data-name="Stewardship Mindset">
                                                        </iconify-icon>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Digital Solutions & Innovation</td>
                                                    <td>3</td>
                                                    <td class="text-center action-icons">

                                                        <iconify-icon icon="lucide:edit" width="16" height="16"
                                                            class="cursor-pointer" data-bs-toggle="modal"
                                                            data-bs-target="#EditBusinessUnit"
                                                            data-name="Digital Solutions & Innovation">
                                                        </iconify-icon>
                                                        <iconify-icon icon="gg:trash" width="20" height="20"
                                                            class="ms-7 cursor-default" style="color: #99A1B7;">
                                                        </iconify-icon>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mx-5 my-4">
                                        <div class="d-flex gap-5 align-items-center">
                                            <div class="d-flex align-items-center gap-2">
                                                <label class="custom-text-muted mb-0" style="color: #2E2F38;">Result per
                                                    page</label>
                                                <select class="results-select">
                                                    <option selected>10</option>
                                                    <option>25</option>
                                                    <option>50</option>
                                                </select>
                                            </div>

                                            <p class="mb-0 custom-text-muted">1-10 of 1,250</p>
                                        </div>
                                        <nav>
                                            <ul class="pagination mb-0">
                                                <li class="page-item disabled"><span class="page-link">&lt;</span></li>
                                                <li class="page-item active"><button class="page-link">1</button></li>
                                                <li class="page-item"><button class="page-link">2</button></li>
                                                <li class="page-item"><button class="page-link">3</button></li>
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                                <li class="page-item"><button class="page-link">10</button></li>
                                                <li class="page-item"><button class="page-link">&gt;</button></li>
                                            </ul>
                                        </nav>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-companies-division" role="tabpanel"
                                aria-labelledby="pills-companies-division-tab" tabindex="0">
                                <div class="d-flex align-items-center justify-content-between my-8">
                                    <h4 class="m-0 top-heading text-start">Manage Companies/Division</h4>
                                    <button class="custom-btn orange-fill" data-bs-toggle="modal"
                                        data-bs-target="#AddDivision">
                                        <span class="me-2 d-flex align-items-center">
                                            <iconify-icon icon="ic:round-plus" width="20"
                                                height="20"></iconify-icon>
                                        </span>
                                        Add Division
                                    </button>

                                </div>

                                <div class="table-border">
                                    <div class="table-responsive">
                                        <table class="table os-table align-middle m-0">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <div class="d-flex gap-2 align-items-center">Name
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="d-flex gap-2 align-items-center">Business Unit
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="d-flex gap-2 align-items-center">No of employees
                                                        </div>
                                                    </th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>Software Solutions</td>
                                                    <td>Global Tech Operations</td>
                                                    <td>3</td>
                                                    <td class="text-center action-icons">

                                                        <iconify-icon icon="lucide:edit" width="16" height="16"
                                                            class="cursor-pointer" data-bs-toggle="modal"
                                                            data-bs-target="#EditDivision"
                                                            data-name="Software Solutions"></iconify-icon>
                                                        <iconify-icon icon="gg:trash" width="20" height="20"
                                                            class="ms-7 cursor-default" style="color: #99A1B7;">
                                                        </iconify-icon>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Cloud Infrastructure</td>
                                                    <td>Global Tech Operations</td>
                                                    <td>4</td>
                                                    <td class="text-center action-icons">

                                                        <iconify-icon icon="lucide:edit" width="16" height="16"
                                                            class="cursor-pointer" data-bs-toggle="modal"
                                                            data-bs-target="#EditDivision"
                                                            data-name="Cloud Infrastructure">
                                                        </iconify-icon>

                                                        <iconify-icon icon="gg:trash" width="20" height="20"
                                                            class="ms-7 cursor-default" style="color: #99A1B7;">
                                                        </iconify-icon>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Human Resources</td>
                                                    <td>Corporate Services</td>
                                                    <td>0</td>
                                                    <td class="text-center action-icons">

                                                        <iconify-icon icon="lucide:edit" width="16" height="16"
                                                            class="cursor-pointer" data-bs-toggle="modal"
                                                            data-bs-target="#EditDivision"
                                                            data-name="Digital Solutions & Innovation">
                                                        </iconify-icon>
                                                        <iconify-icon icon="gg:trash" width="20" height="20"
                                                            class="ms-7 cursor-pointer" style="color: #F24130;"
                                                            data-bs-toggle="modal" data-bs-target="#DeleteBusinessUnit"
                                                            data-id="1" data-name="Stewardship Mindset">
                                                        </iconify-icon>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mx-5 my-4">
                                        <div class="d-flex gap-5 align-items-center">
                                            <div class="d-flex align-items-center gap-2">
                                                <label class="custom-text-muted mb-0" style="color: #2E2F38;">Result per
                                                    page</label>
                                                <select class="results-select">
                                                    <option selected>10</option>
                                                    <option>25</option>
                                                    <option>50</option>
                                                </select>
                                            </div>

                                            <p class="mb-0 custom-text-muted">1-10 of 1,250</p>
                                        </div>
                                        <nav>
                                            <ul class="pagination mb-0">
                                                <li class="page-item disabled"><span class="page-link">&lt;</span></li>
                                                <li class="page-item active"><button class="page-link">1</button></li>
                                                <li class="page-item"><button class="page-link">2</button></li>
                                                <li class="page-item"><button class="page-link">3</button></li>
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                                <li class="page-item"><button class="page-link">10</button></li>
                                                <li class="page-item"><button class="page-link">&gt;</button></li>
                                            </ul>
                                        </nav>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-departments" role="tabpanel"
                                aria-labelledby="pills-departments-tab" tabindex="0">
                                <div class="d-flex align-items-center justify-content-between my-8">
                                    <h4 class="m-0 top-heading text-start">Manage Department</h4>
                                    <button class="custom-btn orange-fill" data-bs-toggle="modal"
                                        data-bs-target="#AddDepartment">
                                        <span class="me-2 d-flex align-items-center">
                                            <iconify-icon icon="ic:round-plus" width="20"
                                                height="20"></iconify-icon>
                                        </span>
                                        Add Department
                                    </button>

                                </div>

                                <div class="table-border">
                                    <div class="table-responsive">
                                        <table class="table os-table align-middle m-0">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <div class="d-flex gap-2 align-items-center">Department
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="d-flex gap-2 align-items-center">Division
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="d-flex gap-2 align-items-center">Business Unit
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="d-flex gap-2 align-items-center">No of employees
                                                        </div>
                                                    </th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td>Software Solutions</td>
                                                    <td>Global Tech Operations</td>
                                                    <td>Global Tech Operations</td>
                                                    <td>5</td>
                                                    <td class="text-center action-icons">

                                                        <iconify-icon icon="lucide:edit" width="16" height="16"
                                                            class="cursor-pointer" data-bs-toggle="modal"
                                                            data-bs-target="#EditDepartment"
                                                            data-name="Software Solutions"></iconify-icon>
                                                        <iconify-icon icon="gg:trash" width="20" height="20"
                                                            class="ms-7 cursor-default" style="color: #99A1B7;">
                                                        </iconify-icon>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>DevOps</td>
                                                    <td>Cloud Infrastructure</td>
                                                    <td>Global Tech Operations</td>
                                                    <td>0</td>
                                                    <td class="text-center action-icons">
                                                        <iconify-icon icon="lucide:edit" width="16" height="16"
                                                            class="cursor-pointer" data-bs-toggle="modal"
                                                            data-bs-target="#EditDepartment"
                                                            data-name="Digital Solutions & Innovation">
                                                        </iconify-icon>
                                                        <iconify-icon icon="gg:trash" width="20" height="20"
                                                            class="ms-7 cursor-pointer" style="color: #F24130;"
                                                            data-bs-toggle="modal" data-bs-target="#DeleteDepartment"
                                                            data-id="1" data-name="Stewardship Mindset">
                                                        </iconify-icon>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mx-5 my-4">
                                        <div class="d-flex gap-5 align-items-center">
                                            <div class="d-flex align-items-center gap-2">
                                                <label class="custom-text-muted mb-0" style="color: #2E2F38;">Result per
                                                    page</label>
                                                <select class="results-select">
                                                    <option selected>10</option>
                                                    <option>25</option>
                                                    <option>50</option>
                                                </select>
                                            </div>

                                            <p class="mb-0 custom-text-muted">1-10 of 1,250</p>
                                        </div>
                                        <nav>
                                            <ul class="pagination mb-0">
                                                <li class="page-item disabled"><span class="page-link">&lt;</span></li>
                                                <li class="page-item active"><button class="page-link">1</button></li>
                                                <li class="page-item"><button class="page-link">2</button></li>
                                                <li class="page-item"><button class="page-link">3</button></li>
                                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                                <li class="page-item"><button class="page-link">10</button></li>
                                                <li class="page-item"><button class="page-link">&gt;</button></li>
                                            </ul>
                                        </nav>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="empty-state">

                            <div class="empty-icon mb-5">
                                <iconify-icon icon="mage:file-2" width="20" height="20"></iconify-icon>
                            </div>

                            <h5 class="m-0">No Results Found</h5>

                            <p class="custom-text-muted mx-auto" style="max-width: 500px;">
                                Try adjusting your search or using different keywords.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="email" role="tabpanel">
                    <div class="settings-card">
                        <h4>Email Template</h4>
                        <p class="custom-text-muted">Employee departments, hierarchy, onboarding processes...</p>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="AddBusinessUnit" tabindex="-1" aria-labelledby="AddBusinessUnitLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="AddBusinessUnitLabel">Add Business Unit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Business Unit Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" placeholder="Enter business unit name"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-end gap-2">
                            <button type="button" class="custom-btn grey-outline" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="button" class="custom-btn orange-fill">
                                Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="EditBusinessUnit" tabindex="-1" aria-labelledby="EditBusinessUnitLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="EditBusinessUnitLabel">Edit Business Unit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Edit Business Unit <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" placeholder="Enter business unit name"
                                    value="Global Tech Operations" required>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-end gap-2">
                            <button type="button" class="custom-btn grey-outline" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="button" class="custom-btn orange-fill">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="DeleteBusinessUnit" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content delete-modal p-6">

                        <!-- Warning Icon -->
                        <div class="d-flex justify-content-center">
                            <span><iconify-icon icon="ep:warning" width="70" height="70"
                                    style="color: #F24130;"></iconify-icon></span>
                        </div>

                        <!-- Title -->
                        <h5>Delete Business Unit?</h5>

                        <!-- Message -->
                        <p>
                            You’re about to delete this business unit from the system. This action can’t be undone. Are you
                            sure you want to proceed?
                        </p>

                        <!-- Buttons -->
                        <div class="d-flex gap-3 justify-content-center">
                            <button type="button" class="modal-custom-btn modal-cancel-btn"
                                data-bs-dismiss="modal">Cancel</button>

                            <button type="button" class="modal-custom-btn modal-confirm-btn" id="confirmDeleteBtn">
                                Confirm
                            </button>
                        </div>

                        <!-- Close icon -->
                        <button type="button" class="modal-close-btn" data-bs-dismiss="modal">&times;</button>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="AddDivision" tabindex="-1" aria-labelledby="AddDivisionLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="AddDivisionLabel">Add Division</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="businessUnit" class="form-label fw-semibold">
                                    Business Unit Name <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="businessUnit" required>
                                    <option selected disabled>Select a business unit</option>
                                    <option>Global Tech Operations</option>
                                    <option>Corporate Services</option>
                                    <option>Digital Solutions</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="divisionName" class="form-label fw-semibold">
                                    Division Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="divisionName" name="division_name" class="form-control"
                                    placeholder="e.g., Software Solutions" required>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-end gap-2">
                            <button type="button" class="custom-btn grey-outline" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="button" class="custom-btn orange-fill">
                                Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="EditDivision" tabindex="-1" aria-labelledby="EditDivisionLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="EditDivisionLabel">Edit Division</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editDivisionForm">

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Business Unit Name <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" id="editBusinessUnit">
                                        <option disabled>Select a business unit</option>
                                        <option selected>Corporate Services</option>
                                        <option>Global Tech Operations</option>
                                        <option>Digital Solutions</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Division Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" value="Software Solutions"
                                        placeholder="e.g., Software Solutions">
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer d-flex justify-content-end gap-2">
                            <button type="button" class="custom-btn grey-outline" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="button" class="custom-btn orange-fill">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="DeleteDivision" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content delete-modal p-6">

                        <!-- Warning Icon -->
                        <div class="d-flex justify-content-center">
                            <span><iconify-icon icon="ep:warning" width="70" height="70"
                                    style="color: #F24130;"></iconify-icon></span>
                        </div>

                        <!-- Title -->
                        <h5>Delete Division?</h5>

                        <!-- Message -->
                        <p>
                            You’re about to delete this division from the system. This action can’t be undone. Are you sure
                            you want to proceed?
                        </p>

                        <!-- Buttons -->
                        <div class="d-flex gap-3 justify-content-center">
                            <button type="button" class="modal-custom-btn modal-cancel-btn"
                                data-bs-dismiss="modal">Cancel</button>

                            <button type="button" class="modal-custom-btn modal-confirm-btn" id="confirmDeleteBtn">
                                Confirm
                            </button>
                        </div>

                        <!-- Close icon -->
                        <button type="button" class="modal-close-btn" data-bs-dismiss="modal">&times;</button>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="AddDepartment" tabindex="-1" aria-labelledby="AddDepartmentLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="AddDepartmentLabel">Add Department</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="businessUnit" class="form-label fw-semibold">
                                    Division <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="businessUnit" required>
                                    <option selected disabled>Select a division</option>
                                    <option>Global Tech Operations</option>
                                    <option>Cloud Infrastructure</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="DepartmentName" class="form-label fw-semibold">
                                    Department Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="DepartmentName" name="Department_name" class="form-control"
                                    placeholder="e.g., Frontend Development" required>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-end gap-2">
                            <button type="button" class="custom-btn grey-outline" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="button" class="custom-btn orange-fill">
                                Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="EditDepartment" tabindex="-1" aria-labelledby="EditDepartmentLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="EditDepartmentLabel">Edit Department</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editDepartmentForm">

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Division <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" id="editBusinessUnit">
                                        <option disabled>Select a Division</option>
                                        <option selected>Corporate Services</option>
                                        <option>Global Tech Operations</option>
                                        <option>Digital Solutions</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Department Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" value="DevOps"
                                        placeholder="e.g., Software Solutions">
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer d-flex justify-content-end gap-2">
                            <button type="button" class="custom-btn grey-outline" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="button" class="custom-btn orange-fill">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="DeleteDepartment" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content delete-modal p-6">

                        <!-- Warning Icon -->
                        <div class="d-flex justify-content-center">
                            <span><iconify-icon icon="ep:warning" width="70" height="70"
                                    style="color: #F24130;"></iconify-icon></span>
                        </div>

                        <!-- Title -->
                        <h5>Delete Department?</h5>

                        <!-- Message -->
                        <p>
                            You’re about to delete this department from the system. This action can’t be undone. Are you
                            sure you want to proceed?
                        </p>

                        <!-- Buttons -->
                        <div class="d-flex gap-3 justify-content-center">
                            <button type="button" class="modal-custom-btn modal-cancel-btn"
                                data-bs-dismiss="modal">Cancel</button>

                            <button type="button" class="modal-custom-btn modal-confirm-btn" id="confirmDeleteBtn">
                                Confirm
                            </button>
                        </div>

                        <!-- Close icon -->
                        <button type="button" class="modal-close-btn" data-bs-dismiss="modal">&times;</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editModal = document.getElementById('EditBusinessUnit');
            const inputField = editModal.querySelector('input.form-control');

            editModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget; // The clicked icon

                const name = button.getAttribute('data-name'); // Fetch business unit name
                inputField.value = name;
            });
        });
    </script>

    <script>
        const deleteModal = document.getElementById('DeleteBusinessUnit');
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        const deleteText = document.getElementById('deleteConfirmText');

        let deleteId = null;

        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            deleteId = button.getAttribute('data-id');
            const valueName = button.getAttribute('data-name');

            deleteText.innerHTML = `Are you sure you want to delete <strong>${valueName}</strong>?`;

            confirmBtn.onclick = () => {
                console.log("Deleting ID:", deleteId);
                // ✅ Later: AJAX or Form submit for actual delete
            };
        });
    </script>
@endsection
