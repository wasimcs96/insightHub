@extends('admin.layout.app')

@section('title', 'Talent Insights Hub')

@section('styles')

    <style>
        .app-wrapper {
            margin-top: 74px !important;
        }

        .section-insight {
            padding: 49px 54px 50px 59px;
            background: #FCFCFC;
            width: fit-content;
            margin: auto;
        }

        h5 {
            color: #071437;
            font-size: 32.5px;
            line-height: 39px;
        }

        .tab-btn button {
            padding: 12px 18px;
            background: #FFF;
            border-color: #99A1B7;
            color: #78829D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .tab-btn button.active {
            background-color: #F7941C;
            color: #FFF;
            border-color: #F7941C;
            border: 0px;
        }

        .btn-tab-1 {
            border-width: 1px 0px 1px 1px;
            border-radius: 4px 0px 0px 4px;
        }

        .btn-tab-2 {
            border-width: 1px 1px 1px 0px;
            border-radius: 0px 4px 4px 0px;
        }

        .orange {
            color: #F7941C;
        }

        .black,
        .employee-info a {
            color: #071437;
        }

        .grid {
            display: grid;
            grid-template-columns: 27.3% 27.3% 27.3%;
            gap: 16px 26px;
        }

        .grid-item {
            height: 45.122px;
            border-radius: 4px;
            border-radius: 4px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .yellow {
            border: 1px solid #F6E54B;
            background: #F6E54B;
        }

        .green {
            border: 1px solid #7DC76F;
            background: #7DC76F;
        }

        .dark-green {
            border: 1px solid #4d774e;
            background: #4d774e;
        }

        .red {
            border: 1px solid #F2B948;
            background: #F2B948;
        }

        .pink {
            border: 1px solid #E66C6C;
            background: #E66C6C;
        }

        .selected .checkmark {
            font-size: 36px;
            color: white;
            top: 5px;
            position: relative;
        }

        .grid-item:hover {
            transform: scale(1.05);
            transition: transform 0.2s;
            cursor: pointer;
        }

        /* Table styling */
        .custom-table,
        .custom-table-2 {
            width: max-content;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .custom-table thead th,
        .custom-table-2 thead th {
            padding: 16px;
            color: #4B5675;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
            border-bottom: 1px solid #DBDFE9;
        }

        .custom-table tr th:nth-child(3),
        .custom-table tbody td:nth-child(3) {
            background: #FFF5DA;
        }

        .custom-table-2 th:nth-child(4),
        .custom-table-2 td:nth-child(4),
        .custom-table-2 th:nth-child(6),
        .custom-table-2 td:nth-child(6) {
            background: #FAFAFB;
        }

        .custom-table th:nth-child(5),
        .custom-table td:nth-child(5),
        .custom-table th:nth-child(7),
        .custom-table td:nth-child(7),
        .custom-table th:nth-child(9),
        .custom-table td:nth-child(9),
        .custom-table th:nth-child(11),
        .custom-table td:nth-child(11) {
            background: #FAFAFB;
        }

        .employee-head {
            display: grid;
            grid-template-columns: 76% 10%;
        }

        .employee-head p,
        .top-row p {
            margin: 0;
        }

        .top-row {
            display: flex;
            gap: 24px;
            justify-content: center;
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            height: 90px;
        }

        .custom-table tbody td,
        .custom-table-2 tbody td {
            text-align: center;
            padding: 16px;
            font-size: 0.9rem;
            vertical-align: middle;
            border-bottom: 1px solid #DBDFE9;
        }

        .employee-info {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .employee-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .employee-info .employee-name {
            color: #071437;
            font-size: 14px;
            font-weight: 600;
            line-height: normal;
            margin: 0;
            text-align: left;
        }

        .employee-info .employee-role {
            color: #4B5675;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            margin: 0;
            text-align: left;
            margin-bottom: 5px;
        }

        .table-status {
            border-radius: 15px;
            padding: 4px 12px;
            width: max-content;
        }

        .high {
            background-color: #DDF5E2;
            color: #196329;
            border-radius: 15px;
            padding: 4px 12px;
        }

        .moderate {
            background-color: #FFEBB4;
            color: #EB8100;
            border-radius: 15px;
            padding: 4px 12px;
        }

        .low {
            background-color: #ffcdd2;
            color: #d32f2f;
            border-radius: 15px;
            padding: 4px 12px;
        }

        .high-risk {
            background-color: #FFE0DD;
            color: #AA2D22;
            border-radius: 15px;
            padding: 4px 12px;
        }

        .profile {
            color: #D9D9D9;
            font-size: 36px;
            width: 36px;
        }

        .profile-name {
            width: 50%;
            text-align: left;
        }

        .profile-name p {
            margin-top: 4px;
        }

        .info {
            font-size: 20px;
            color: #757575;
            width: 20px;
        }

        .drop-content p {
            cursor: pointer;
            color: #1E1E1E;
            font-style: normal;
            font-size: 14px;
        }

        .select2-container--bootstrap5 .select2-selection--multiple .select2-selection__rendered {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .select2-container--bootstrap5 .select2-selection--multiple.form-select-sm .select2-selection__choice {
            display: flex !important;
            padding: 8px 16px !important;
            justify-content: center;
            align-items: center !important;
            gap: 4px;
            border-radius: 80px !important;
            background: #FFF3E0;
            color: #975102;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            overflow: scroll;
            scrollbar-width: none;
        }

        .select2-container--bootstrap5 .select2-selection--multiple .select2-selection__rendered .select2-selection__choice .select2-selection__choice__remove {
            left: 12px;
            background: #F7941C;
            height: 20px;
            opacity: 1;
        }

        .select2-container--bootstrap5.select2-container--focus:not(.select2-container--disabled) .form-select-solid,
        .select2-container--bootstrap5.select2-container--open:not(.select2-container--disabled) .form-select-solid {
            background: white !important;
        }

        .select2-container--bootstrap5.select2-container--disabled .form-select {
            background: #fff !important;
            color: #071437 !important;
            border-radius: 8px;
border: 1px dashed #DBDFE9 !important;
padding: 20px !important;
        }

        .select2-selection__choice__display {
            width: -webkit-fill-available;
        }

        .form-select.form-select-solid {
            background: none !important;
        }

        .select2-container--bootstrap5 .select2-dropdown {
            display: none;
        }

        .compare span {
            --bs-form-select-bg-img: none !important;
}

        .select2-selection__clear {
            display: none !important;
        }

        .modal-body p {
            color: #4B5675;
            font-size: 16px;
            font-style: normal;
            font-weight: 400;
            line-height: 140%;
        }

        .btn-close {
            width: 10px;
            height: 10px;
            position: relative;
            top: -25px;
            left: 15px;
        }

        .btn-dismiss {
            padding: 12px 18px;
            border-radius: 4px;
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #78829D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        /* Form select and dropdown styling */
        .form-select {
            width: 100%;
        }

        /* Style the select options */
        .form-select option {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding: 8px 12px;
        }

        /* Style the Bootstrap dropdown menu */
        .dropdown-menu {
            width: 100% !important;
            min-width: 100% !important;
            max-width: 100% !important;
        }

        .dropdown-menu .dropdown-item {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding: 8px 12px;
        }

        .filter,
        .g-grid-filter,
        .compare {
            border-radius: 8px;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .insight-table {
            width: 71vw;
        }

        .insight-table,
        .insight-filter {
            height: 100vh;
            overflow-y: scroll;
        }

        .pagination-bar {
            border-radius: 0px 0px 16px 16px;
            border-bottom: 1px solid #F3F3F3;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .pagination-inner {
            display: flex;
            padding: 16px;
            align-items: center;
            gap: 24px;
            align-self: stretch;
        }

        .pagination-inner p {
            margin: 0;
        }

        .rows-drop {
            display: flex;
            gap: 8px;
            align-items: center;
            color: #4B5675;
        }

        .dropdown button {
            padding: 8px 16px !important;
            border-radius: 4px;
            border: 1px solid #D9D9D9 !important;
            color: #4B5675;
        }

        .pagination-number {
            color: #4B5675;
            font-size: 12px;
            font-style: normal;
            font-weight: 400;
            line-height: 16px;
        }

        .page-icon {
            font-size: 24px;
            color: #99A1B7;
        }

        .custom-table input[type="checkbox"],
        .custom-table-2 input[type="checkbox"] {
            accent-color: #F7941C !important;
            width: 24px;
            height: 24px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border: 2px solid #DBDFE9;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s, border-color 0.2s;
        }

        .custom-table input[type="checkbox"]:checked,
        .custom-table-2 input[type="checkbox"]:checked {
            background-color: #F7941C;
            border: 4px solid #fff;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }

        .insight-main {
            height: 85vh;
            z-index: 100;
            background: #FCFCFC;
            position: sticky;
        }

        /* .insight-filter,
        .insight-table {
            position: sticky;
            top: 0;
            z-index: 100;
        } */

        .custom-table thead,
        .custom-table-2 thead {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 10;
        }
    
.table-container {
    overflow-x: auto;
    overflow-y: auto;
    height: 76vh;
}

.active>.page-link, .page-link.active {
    background: #071437;
}

.custom-table, .custom-table-2 {
    width: max-content;
    border-collapse: collapse;
    table-layout: fixed;
}

.custom-table td:first-child,
.custom-table td:nth-child(2),
.custom-table th:first-child,
.custom-table th:nth-child(2),
.custom-table-2 td:first-child,
.custom-table-2 td:nth-child(2),
.custom-table-2 th:first-child,
.custom-table-2 th:nth-child(2) {
    position: sticky;
    left: 0;
    z-index: 1;
    background-color: white;
}

.custom-table th:nth-child(1),
.custom-table th:nth-child(2),
.custom-table-2 th:nth-child(1),
.custom-table-2 th:nth-child(2) {
    z-index: 100;
    background-color: #f8f8f8;
}

.custom-table thead th {
    position: sticky;
    top: 0;
    background-color: white;
    z-index: 10;
}

.custom-table td {
    background-color: #fff;
    z-index: 0;
}

.flex-column-fluid {
    position: sticky;
    top: 70px;
}

.modal-backdrop {
    z-index: -1;
}

 .form-check-label {
            color: #071437;
            font-size: 14px;
            line-height: 20px;
        }

         .line-grey {
            height: 1px;
            width: 100%;
            display: block;
            background-color: #F1F1F4;
            margin: 12px 0px;
        }

         .filter-content {
            margin: 32px 0px 0px;
        }

         .filter-content button {
            display: flex;
            padding: 12px 18px;
            justify-content: center;
            align-items: center;
            flex: 1 0 0;
            border-radius: 4px;
            font-size: 12px;
            line-height: 16px;
        }

         .filter-content button.btn-outline {
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #78829D;
        }

         .filter-content button.btn-apply {
            border-radius: 4px;
            background: #F7941C;
            color: #fff;
            border: 1px solid #F7941C;
        }

         .form-check-input:checked {
            background-color: #F7941C;
            border-color: #F7941C;
        }

         .checkbox-custom,
         .custom-radio {
            width: 16px;
            height: 16px;
        }

         .custom-label {
            color: #071437;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

         .custom-label span {
            color: #99A1B7;
        }

         input[type="radio"]:checked {
            border-width: 0.8px;
        }

        .filter-group .selected-text {
            padding: 8px 16px;
            border-radius: 80px;
            background: #F1F1F4;
            color: #4B5675;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
            gap: 4px;
            width: fit-content;
        }

        .filter-group .form-check-label span {
            color: #99A1B7;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

    </style>

@endsection

@section('content')

<div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
    <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Talent Insight
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="#" class="text-muted text-hover-primary">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="/admin/talent/insight" class="text-muted text-hover-primary">Talent Insights</a>
                </li>
               
            </ul>
        </div>
    </div>
</div>

    <section class="section-insight" style="margin-top: 50px;">
         <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-bolder m-0 black">Talent Insights</h5>
            <div class="tab-btn d-flex" id="pills-tab" role="tablist">
                <button class="btn-tab-1 active col" style="margin-right: 10px; border-radius: 4px;" data-bs-toggle="modal"
                    data-bs-target="#selectFieldModal"
                    data-job-id=""
                    data-job-title="" type="button">
                        Export
                </button>
                
                <button class="btn-tab-1 active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                    type="button" role="tab" aria-controls="pills-home" aria-selected="true">Assessment
                    Results</button>
                    @if(auth()->user()->role_id != 13)
                <button class="btn-tab-2" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                    type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Readiness</button>
                    @endif
            </div>
        </div> 
        <div class="insight-main d-flex gap-13 mt-5">
             <div class="insight-filter bg-white p-0" style="width: 330px; overflow: scroll; height: 100%;">
                <div class="filter p-5 d-flex flex-column gap-7">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="fw-bolder fs-4 m-0">Filter</p>
                        <p class="fs-7 fw-medium m-0 orange cursor-pointer" id="firstClearFilter">Clear filter</p>
                    </div>
                    <div class="filter-form">
                        <form id="filterForm">
                            <div class="mb-5">
                                <label for="division_id" class="form-label fs-7 fw-medium black mb-1">Division</label>
                                <select class="form-select" name="division_id" id="division_id">
                                    <option value="">Select Division</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id ?? 0 }}"
                                            @if (request('division_id') == $division->id) selected @endif> {{ $division->head_of_division ?? '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="department_id" class="form-label fs-7 fw-medium black mb-1">Department</label>
                                <select class="form-select" name="department_id" id="department_id">
                                    <option value="">Select Department</option>
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="exampleInputPassword1" class="form-label fs-7 fw-medium black mb-1">Position
                                    Level</label>
                                <select class="form-select" name="position_level" id="position_level">
                                    <option value="">Select Position Level</option>
                                    @foreach (config('helpers.levels') as $level => $name)
                                        <option value="{{ $level }}"
                                            @if (request('position_level') == $level) selected @endif> {{ $name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="exampleInputPassword1" class="form-label fs-7 fw-medium black mb-1">Assessment Status</label>
                                <select class="form-select" name="assessment_status" id="assessment_status">
                                <option value="">Select Assessment Status</option>
                                <option value="1">All</option>
                                <option value="2">Completed All Assessments</option>
                                <option value="3">Completed Psychometric Assessments (But Not Technical)</option>
                                <option value="4">No Assessment Completed</option>
                                </select>
                            </div>

                            <div class="mb-5">
                                <label for="exampleInputPassword1" class="form-label fs-7 fw-medium black mb-1">Strategic Insight</label>
                                <select class="form-select" name="strategy" id="strategy">
                                    <option value="">Select Strategic Insight
                                    </option>
                                    @foreach (config('helpers.talent_insight_strategies') as $level => $name)
                                        <option value="{{ $level }}"
                                            @if (request('strategy') == $level) selected @endif> {{ $name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="fs-7 fw-medium m-0 black">Show Bookmark Employees</p>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" @if (request('is_high_potential')) checked @endif
                                        name="is_high_potential" type="checkbox" role="switch"
                                        id="is_high_potential">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="g-grid-filter p-5 d-flex flex-column gap-7">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="fw-bolder fs-4 m-0 d-flex align-items-center">9-Grid Filter
                            <iconify-icon icon="material-symbols:info-outline" class="info ml-2" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"></iconify-icon>
                        </p>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body p-10">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h2 class="m-0 mb-4">
                                                What is a 9-Grid filter?</h2>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <p class="m-0">
                                            The grid plots an employee's current performance against their future
                                            prospect.
                                            </br>
                                            </br>
                                            The higher the employee scores on the vertical and horizontal axes, the more
                                            they are considered a strong performer with excellent alignment to the
                                            organization's values and potential for future growth. These individuals are
                                            ideal candidates for leadership development, succession planning, or other
                                            strategic opportunities.
                                        </p>
                                        <button type="button" class="float-right btn-dismiss mt-8"
                                            data-bs-dismiss="modal">Dismiss</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="fs-7 fw-medium m-0 orange cursor-pointer" id="secondClearFilter">Clear filter</p>
                    </div>
                    <div class="grid fliter-color">
                        <div class="grid-item yellow" data-id="1" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-html="true" data-bs-title="<b>Key Prospect</b><br>High Prospect<br>Low Performance">
                        </div>
                        <div class="grid-item green" data-id="2" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-html="true"
                            data-bs-title="<b>High Prospect</b><br>High Prospect<br>Moderate Performance"></div>
                        <div class="grid-item dark-green" data-id="3" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-html="true"
                            data-bs-title="<b>Star</b><br>High Prospect<br>High Performance">
                        </div>
                        <div class="grid-item red" data-id="4" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-html="true"
                            data-bs-title="<b>Inconsistent Player</b><br>Moderate Prospect<br>Low Performance"></div>
                        <div class="grid-item yellow" data-id="5" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-html="true"
                            data-bs-title="<b>Core Player</b><br>Moderate Prospect<br>Moderate Performance"></div>
                        <div class="grid-item green" data-id="6" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-html="true"
                            data-bs-title="<b>High Performer</b><br>Moderate Prospect<br>High Performance">
                        </div>
                        <div class="grid-item pink" data-id="7" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-html="true" data-bs-title="<b>Risk</b><br>Low Prospect<br>Low Performance"></div>
                        <div class="grid-item red" data-id="8" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-html="true"
                            data-bs-title="<b>Average Performer</b><br>Low Prospect<br>Moderate Performance"></div>
                        <div class="grid-item yellow" data-id="9" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-html="true"
                            data-bs-title="<b>Solid Performer</b><br>Low Prospect<br>High Performance">
                        </div>
                    </div>

                    <!-- Hidden input to store the selected grid_id -->
                    <input type="hidden" id="grid_id" name="grid_id" />
                </div>
                <form class="compare p-5 d-flex flex-column gap-7">
                    <p class="fw-bolder fs-4 m-0">Compare</iconify-icon></p>
                    <select class="form-select form-select-sm form-select-solid me-6" id="selectCompare"
                        data-control="select2" data-close-on-select="false" data-allow-clear="true"
                        data-placeholder="Select two or more employees to start comparing" data-hide-search="true" multiple="multiple" disabled>
                    </select>
                    <div class="tab-btn d-flex gap-6">
                        <button class="btn-tab-2 border-1 rounded col" id="clearSelectionButton" type="button">Clear
                            selection</button>
                        <button class="btn-tab-1 border-1 rounded active col" id="compareButton" type="button"><svg
                                xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17"
                                fill="none" class="mr-2">
                                <g clip-path="url(#clip0_202_3294)">
                                    <path d="M0.916626 13.6982V9.69821H4.91663" stroke="white" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M15.5834 3.03152V7.03152H11.5834" stroke="white" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M2.58996 6.36488C2.92807 5.4094 3.50271 4.55515 4.26027 3.88182C5.01783 3.2085 5.9336 2.73805 6.92215 2.51438C7.9107 2.29071 8.9398 2.32111 9.91342 2.60273C10.887 2.88435 11.7735 3.40802 12.49 4.12488L15.5833 7.03154M0.916626 9.69821L4.00996 12.6049C4.72646 13.3217 5.61287 13.8454 6.5865 14.127C7.56012 14.4087 8.58922 14.439 9.57777 14.2154C10.5663 13.9917 11.4821 13.5213 12.2396 12.8479C12.9972 12.1746 13.5718 11.3204 13.91 10.3649"
                                        stroke="white" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_202_3294">
                                        <rect width="16" height="16" fill="white"
                                            transform="translate(0.25 0.364868)" />
                                    </clipPath>
                                </defs>
                            </svg> Compare</button>
                    </div>
                </form>
            </div>
             <div class="insight-table bg-white p-0">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab" tabindex="0">
                        <div class="table-container">
                            <table class="custom-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class="sortable" data-sort-column="employee" style="width: 250px;">
                                            <div class="employee-head">
                                                <p>Employee</p><iconify-icon icon="ri:arrow-down-s-line"
                                                    class="info"></iconify-icon>
                                            </div>
                                        </th>
                                        @if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required')))
                                            <th class="sortable" data-sort-column="omr_level">
                                                <div class="top-row"><iconify-icon icon="material-symbols:info-outline"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Overall Match Rate" class="info"></iconify-icon>
                                                    <p>OMR</p><iconify-icon icon="ri:arrow-down-s-line"
                                                        class="info"></iconify-icon>
                                                </div>
                                            </th>
                                            <th class="sortable" data-sort-column="ta_level">
                                                <div class="top-row"><iconify-icon icon="material-symbols:info-outline"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-title="Technical Assessment Result"
                                                        class="info"></iconify-icon>
                                                    <p>TA</p><iconify-icon icon="ri:arrow-down-s-line"
                                                        class="info"></iconify-icon>
                                                </div>
                                            </th>
                                        @endif
                                        <th class="sortable" data-sort-column="bfr_level">
                                            <div class="top-row"><iconify-icon icon="material-symbols:info-outline"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Behaviour Fit Rate" class="info"></iconify-icon>
                                                <p>BFR</p><iconify-icon icon="ri:arrow-down-s-line"
                                                    class="info"></iconify-icon>
                                            </div>
                                        </th>
                                        <th class="sortable" data-sort-column="tsmr_level">
                                            <div class="top-row"><iconify-icon icon="material-symbols:info-outline"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Technical Skill Match Rate" class="info"></iconify-icon>
                                                <p>TSMR</p><iconify-icon icon="ri:arrow-down-s-line"
                                                    class="info"></iconify-icon>
                                            </div>
                                        </th>
                                        <th class="sortable" data-sort-column="ssmr_level">
                                            <div class="top-row"><iconify-icon icon="material-symbols:info-outline"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Soft Skill Match Rate" class="info"></iconify-icon>
                                                <p>SSMR</p><iconify-icon icon="ri:arrow-down-s-line"
                                                    class="info"></iconify-icon>
                                            </div>
                                        </th>
                                        <th class="sortable" data-sort-column="jmr_level">
                                            <div class="top-row"><iconify-icon icon="material-symbols:info-outline"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Job Match Rate" class="info"></iconify-icon>
                                                <p>JMR</p><iconify-icon icon="ri:arrow-down-s-line"
                                                    class="info"></iconify-icon>
                                            </div>
                                        </th>
                                        <th class="sortable" data-sort-column="cat_level">
                                            <div class="top-row"><iconify-icon icon="material-symbols:info-outline"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true"
                                                    data-bs-title="Cognitive Level<br>(Cognitive Test Result)"
                                                    class="info"></iconify-icon>
                                                <p>CAT</p><iconify-icon icon="ri:arrow-down-s-line"
                                                    class="info"></iconify-icon>
                                            </div>
                                        </th>
                                        <th class="sortable" data-sort-column="gp_level">
                                            <div class="top-row"><iconify-icon icon="material-symbols:info-outline"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Leadership Potential" class="info"></iconify-icon>
                                                <p>LP</p><iconify-icon icon="ri:arrow-down-s-line"
                                                    class="info"></iconify-icon>
                                            </div>
                                        </th>
                                        <th class="sortable" data-sort-column="gp_level">
                                            <div class="top-row"><iconify-icon icon="material-symbols:info-outline"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Growth Potential" class="info"></iconify-icon>
                                                <p>GP</p><iconify-icon icon="ri:arrow-down-s-line"
                                                    class="info"></iconify-icon>
                                            </div>
                                        </th>
                                        <th class="sortable" data-sort-column="rci_level">
                                            <div class="top-row"><iconify-icon icon="material-symbols:info-outline"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Response Consistency Index"
                                                    class="info"></iconify-icon>
                                                <p>RCI</p><iconify-icon icon="ri:arrow-down-s-line"
                                                    class="info"></iconify-icon>
                                            </div>
                                        </th>
                                        <th class="sortable" data-sort-column="fr_level">
                                            <div class="top-row"><iconify-icon icon="material-symbols:info-outline"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Flight Risk" class="info"></iconify-icon>
                                                <p>FR</p><iconify-icon icon="ri:arrow-down-s-line"
                                                    class="info"></iconify-icon>
                                            </div>
                                        </th>
                                        <th class="sortable" data-sort-column="waf_level">
                                            <div class="top-row"><iconify-icon icon="material-symbols:info-outline"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-title="Workplace Alignment Forecast"
                                                    class="info"></iconify-icon>
                                                <p>WAF</p><iconify-icon icon="ri:arrow-down-s-line"
                                                    class="info"></iconify-icon>
                                            </div>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody id="insightResults">



                                </tbody>

                            </table>

                        </div>

                        <div style="display: flex; justify-content: space-between; align-items:center; margin-top: 5px;">
                            <div class="rows-per-page">
                                <label for="rowsPerPage">Rows per page:</label>
                                <select id="rowsPerPage">
                                    <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                                </select>
                            </div>
                            <div class="insight-pagination" id="insightPagination"></div></div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                        tabindex="0">
                        <div class="table-container">
                            <table class="custom-table-2">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>
                                            <div class="employee-head">
                                                <p>Employee</p><iconify-icon icon="ri:arrow-down-s-line"
                                                    class="info"></iconify-icon>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="top-row">
                                                <p></p>
                                                <p>Succession Readiness</p><iconify-icon icon="ri:arrow-down-s-line"
                                                    class="info"></iconify-icon>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="top-row">
                                                <p></p>
                                                <p>Tenure</p>
                                                <p></p>
                                            </div>
                                        </th>

                                        <th>
                                            <div class="top-row">
                                                <p></p>
                                                <p>Job Skill Alignment (%)</p><iconify-icon icon="ri:arrow-down-s-line"
                                                    class="info"></iconify-icon>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="top-row">
                                                <p></p>
                                                <p>Future Role Alignment (%)</p><iconify-icon icon="ri:arrow-down-s-line"
                                                    class="info"></iconify-icon>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="top-row">
                                                <p></p>
                                                <p>Performance Rating</p><iconify-icon icon="ri:arrow-down-s-line"
                                                    class="info"></iconify-icon>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="checkbox">
                                        </td>
                                        <td>
                                            <div class="employee-info">
                                                <iconify-icon icon="mingcute:round-fill" class="profile"></iconify-icon>
                                                <div class="profile-name">
                                                    <p class="employee-name">Cyrene Daang Macabenta</p>
                                                    <p class="employee-role">HR Officer - People Operation & Services</p>
                                                    <p class="high table-status">Bookmarked</p>
                                                </div>
                                                <a href="#" data-kt-menu-trigger="click"
                                                    data-kt-menu-placement="bottom-end">
                                                    <iconify-icon icon="entypo:dots-three-vertical"></iconify-icon>
                                                </a>
                                                <div class="menu menu-sub menu-sub-dropdown p-3 text-left drop-content"
                                                    data-kt-menu="true" id="kt_menu_65e95fe68ac03">
                                                    <a class="m-0 px-4 py-2"
                                                        href="{{ route('admin.employee.details', ['id' => 2477]) }}">View
                                                        Profile</a>
                                                    {{-- <p class="m-0 px-4 py-2">Tag as High Potential</p> --}}
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="high table-status">YES</span></td>
                                        <td><span class="table-status">3 years</span></td>
                                        <td><span class="high table-status">93%</span></td>
                                        <td><span class="moderate table-status">86%</span></td>
                                        <td><span class="table-status">2.64</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- <div class="insight-pagination">{{ $results->links() }}</div> --}}
                    </div>
                </div>
            </div> 
        </div>

    </section>


    <div class="modal fade" style="top: 60px;" id="selectFieldModal" tabindex="-1" aria-labelledby="selectFieldModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="fieldSettingsForm" action="{{ route('admin.talent-insight.exportReport') }}" method="POST">
                @csrf
                <div class="modal-content modal-div">
                    <div class="modal-body py-0 pt-5 text-center">
                        <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close" style="float: right;">
                            &times;
                        </button>
        
                        <p class="fw-bolder fs-1 lh-1 text-center" style="color: #4B5675;">
                            Select the fields you want to export
                        </p>
        
                        @foreach (config('helpers.talent_insight_export_fields') as $value => $field)
                            {{-- If TA is NOT required, skip omr_level and ta_level --}}
                            @if (in_array(env('DB_DATABASE'), config('client.omr_ta_not_required')))
                                @if ($value == 'omr_level' || $value == 'ta_level')
                                    @continue
                                @endif
                            @endif
                        
                            <div class="form-check form-switch d-flex justify-content-between p-0 align-items-center">
                                <label class="form-check-label fw-bold" for="{{ $value }}">{{ $field }}</label>
                                <input name="fields[]" class="form-check-input position-relative m-0 p-0 formCheckAllApplicant-inputs"
                                    type="checkbox" role="switch" value="{{ $value }}" id="{{ $value }}" checked>
                            </div>
                            <div class="line-grey"></div>
                        @endforeach
                    
                    </div>
                    <div class="modal-footer modal-footer d-block border-0">
                        <div class="filter-content d-flex justify-content-between gap-2" style="margin: 0;">
                            <button class="btn btn-outline" type="button" aria-label="Close" data-bs-dismiss="modal">Cancel</button>
                            <button id="exportButton" type="button" class="btn btn-apply" style="background: #f7941d;">
                                Export
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
@endsection
@section('scripts')

    <script>
        // Initialize KT Menu on document ready
        $(document).ready(function() {
            // Initialize KTMenu
            var menu = new KTMenu(document.querySelector('.menu-sub-dropdown'));

            // Function to handle select dropdown width and text truncation
            function initializeSelectDropdowns() {
    const selects = document.querySelectorAll('.form-select');

    selects.forEach(select => {
        const selectWidth = select.offsetWidth;
        select.dataset.width = selectWidth + 'px';

        const truncateText = (text, maxLength) => {
            if (text.length <= maxLength) return text; // ✅ no truncate
            return text.substring(0, maxLength - 3).trim() + '...'; // ✅ clean truncate
        };

        // Update select element options
        Array.from(select.options).forEach(option => {
            const text = option.getAttribute('data-full-text') || option.textContent.trim();
            option.setAttribute('data-full-text', text);

            if (text.length > 30) {
                option.title = text;
                option.textContent = truncateText(text, 30);
            } else {
                option.textContent = text;
                option.removeAttribute('title');
            }
        });

        // Update dropdown items when open
        select.addEventListener('show.bs.select', function () {
            setTimeout(() => {
                const dropdown = document.querySelector('.dropdown-menu');
                if (!dropdown) return;

                dropdown.style.width = selectWidth + 'px';

                const items = dropdown.querySelectorAll('.dropdown-item');
                items.forEach((item, index) => {
                    const fullText = select.options[index].getAttribute('data-full-text');
                    if (!fullText) return;

                    if (fullText.length > 30) {
                        item.title = fullText;
                        item.textContent = truncateText(fullText, 30);
                    } else {
                        item.textContent = fullText;
                        item.removeAttribute('title');
                    }
                });
            }, 0);
        });
    });
}

            // Initialize on page load
            initializeSelectDropdowns();

            // Re-initialize when new content is loaded dynamically
            $(document).on('change', '.form-select', function() {
                initializeSelectDropdowns();
            });
        });

        $(document).ready(function() {
            KTMenu.init(); // Initialize the KT Menu system

            // Alternatively, if using a custom menu toggle
            $('[data-kt-menu-trigger="click"]').on('click', function(e) {
                e.preventDefault();
                $(this).next('.menu-sub-dropdown').toggleClass('show');
            });
        });


        $(document).ready(function() {
            var selectedUserIds = [];
            var selectedGridId = ''; // Store the selected grid ID
            var page = 1;
            var sortColumn = ''; // Store the column to sort
            var sortDirection = 'asc'; // Store the sort direction (asc or desc)

            // Function to initialize KTMenu dropdowns
            function initMenuDropdowns() {
                $('[data-kt-menu-trigger="click"]').each(function() {
                    var menu = $(this).next('.menu-sub-dropdown');
                    if (!menu.hasClass('kt-menu')) {
                        KTMenu.init(menu); // Reinitialize KTMenu if it's not already initialized
                    }
                });
            }

            loadResults(); // Trigger initial data load

            // Event listener for changes to any dropdown (select elements)
            $('#division_id').on('change', function() {
                var divisionId = $(this).val();
                var departmentSelect = $('#department_id');
                
                // Clear and disable department dropdown if no division is selected
                if (!divisionId) {
                    departmentSelect.html('<option value="">Select Department</option>').prop('disabled', true);
                    loadResults();
                    return;
                }

                // Enable department dropdown and fetch departments
                departmentSelect.prop('disabled', false);

                // Fetch departments based on selected division
                $.ajax({
                    url: '{{ url("admin/ajax/departments") }}/' + divisionId,
                    method: 'GET',
                    data: { division_id: divisionId },
                    success: function(response) {
                        var options = '<option value="">Select Department</option>';
                        if (response && Array.isArray(response)) {
                            response.forEach(function(department) {
                                options += `<option value="${department.id}">${department.name}</option>`;
                            });
                        }
                        departmentSelect.html(options);
                        loadResults();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching departments: " + error);
                        departmentSelect.html('<option value="">Error loading departments</option>');
                    }
                });
            });

            $('#department_id').on('change', function() {
                loadResults(); // Reload results when any dropdown is changed
            });

            $('#position_level').on('change', function() {
                loadResults(); // Reload results when any dropdown is changed
            });

            $('#assessment_status').on('change', function() {
                loadResults(); // Reload results when any dropdown is changed
            });

            $('#strategy').on('change', function() {
                loadResults(); // Reload results when any dropdown is changed
            });

            $('#is_high_potential').on('change', function() {
                loadResults(); // Reload results when any dropdown is changed
            });

            // Handle grid filter click
            $(document).on('click', '.grid-item', function() {
                selectedGridId = $(this).data('id'); // Get the grid ID (1-9) when a grid item is clicked
                // Remove checkmark from all grid items
                $('.grid-item').removeClass('selected').find('.checkmark').remove();
                // Add checkmark to the selected grid item
                $(this).addClass('selected').append(
                    '<div class="checkmark"><iconify-icon icon="mingcute:check-fill"></iconify-icon></div>'
                );
                loadResults(); // Reload results based on selected grid ID
            });

            // Event listener for sorting clicks
            $(document).on('click', '.sortable', function() {
                var column = $(this).data('sort-column');

                // Toggle sort direction
                if (sortColumn === column) {
                    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc'; // Toggle direction
                } else {
                    sortColumn = column;
                    sortDirection = 'asc'; // Default to ascending for new column
                }

                // Update the sort icon for the column
                updateSortIcons(column);

                // Reload results with the new sort options
                loadResults(page, 0, '', sortColumn, sortDirection);
            });

            // Function to update the sort icons
            function updateSortIcons(column) {
                $('.sortable').each(function() {
                    var currentColumn = $(this).data('sort-column');
                    var icon = $(this).find('.sort-icon');

                    // Reset all icons
                    icon.removeClass('ascending descending');

                    // Update the icon for the sorted column
                    if (currentColumn === column) {
                        icon.addClass(sortDirection === 'asc' ? 'ascending' : 'descending');
                    }
                });
            }

            // Event listener for pagination links
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                page = $(this).attr('href').split('page=')[1];
                loadResults(page);
            });

            // Handle clear filter button click
            $("#firstClearFilter").on('click', function() {
                loadResults(page, clearFilter = 1);
            });

            // Handle clear filter button click
            $("#secondClearFilter").on('click', function() {
                loadResults(page, clearFilter = 2);
            });

            // Handle checkbox selection for users
            $(document).on('click', '.user-checkbox', function(e) {
                var userId = $(this).data('id');
                var userName = $(this).data('name');

                // Add or remove user ID based on checkbox state
                if ($(this).prop('checked')) {
                    selectedUserIds.push(userId);
                    var newOption = new Option(userName, userId, true, true);
                    $('#selectCompare').append(newOption).trigger('change');
                } else {
                    selectedUserIds = selectedUserIds.filter(function(id) {
                        return id !== userId;
                    });
                    $('#selectCompare option[value="' + userId + '"]').remove();
                }
            });

            // Handle compare button click
            $(document).on('click', '#compareButton', function(e) {
                // Update selectedUserIds based on current Select2 selection
                selectedUserIds = $('#selectCompare').val() || [];

                if (selectedUserIds.length > 0) {
                    var userIds = selectedUserIds.join(',');
                    loadResults(page, 0, userIds); // Assuming loadResults is defined elsewhere
                } else {
                    alert('Please select at least one user to compare.');
                }
            });

            // Handle removing user selection from Select2
            $(document).on('click', '.select2-selection__choice__remove', function (event) {
                event.preventDefault(); // Prevent default button behavior

                // Get the user name from the clicked remove button
                const listItem = $(this).closest('.select2-selection__choice');
                const userName = listItem.find('.select2-selection__choice__display').text().trim();

                // Find the corresponding option in the Select2 dropdown
                const selectElement = $('#selectCompare');
                const optionToRemove = selectElement.find('option').filter(function () {
                    return $(this).text() === userName;
                });

                // Remove the selected option from the dropdown
                if (optionToRemove.length) {
                    optionToRemove.prop('selected', false); // Unselect the option
                    selectElement.trigger('change'); // Notify Select2 about the change
                }

                // Uncheck the corresponding checkbox in the table
                const checkbox = $(`input.user-checkbox[data-name="${userName}"]`);
                if (checkbox.length) {
                    checkbox.prop('checked', false);
                }

                // Remove the user ID from the selectedUserIds array
                selectedUserIds = selectedUserIds.filter(function(id) {
                    return id !== optionToRemove.val();
                });

                // console.log(`${userName} removed successfully.`);
            });

            // Handle clear selection button click
            $(document).on('click', '#clearSelectionButton', function(e) {
                selectedUserIds = [];
                $('#selectCompare').empty();
                loadResults(page, 0);
            });
  
            $(document).ready(function() {
                // Retrieve data_id from the URL
                var urlParams = new URLSearchParams(window.location.search);
                selectedGridId = urlParams.get('data_id'); // Get the 'data_id' parameter from URL

                // Now, you can use selectedGridId in the loadResults function
                loadResults(1); // Initialize the loadResults with page 1 by default
            });

            // Function to load data based on selected filters, pagination, and grid filter
            function loadResults(page = 1, clearFilter = 0, userIds = '', sortColumn = '', sortDirection = '') {
                showOverlay();
                let perPage = $('#rowsPerPage').val(); // Get rows per page value

                  // If clearFilter is 1 or 2, reset the filters accordingly
                  var divisionId, departmentId, positionLevel, assessmentStatus, isHighPotential;
                  
                if (clearFilter == 1) {
                    divisionId = '';
                    departmentId = '';
                    positionLevel = '';
                    assessmentStatus = '';
                    strategy = '';
                    isHighPotential = 0;
                    $('#division_id').val('');
                    $('#department_id').val('').prop('disabled', true);
                    $('#position_level').val('');
                    $('#assessment_status').val('');
                    $('#strategy').val('');
                    $('#is_high_potential').prop('checked', false); // Uncheck checkbox
                } else if (clearFilter == 2) {
                    selectedGridId = ''; // Reset selected grid ID if clearFilter == 2
                    divisionId = $('#division_id').val();
                    departmentId = $('#department_id').val();
                    positionLevel = $('#position_level').val();
                    assessmentStatus = $('#assessment_status').val();
                    strategy = $('#strategy').val();
                    isHighPotential = $('#is_high_potential').prop('checked') ? 1 : 0; // checkbox
                    $('.grid-item').removeClass('selected').find('.checkmark').remove();
                } else {
                    divisionId = $('#division_id').val();
                    departmentId = $('#department_id').val();
                    positionLevel = $('#position_level').val();
                    assessmentStatus = $('#assessment_status').val();
                    strategy = $('#strategy').val();
                    isHighPotential = $('#is_high_potential').prop('checked') ? 1 : 0; // checkbox
                }
                $('#grid_id').val(selectedGridId);
                // Prepare data to be sent with the AJAX request
                var formData = {
                    division_id: divisionId,
                    department_id: departmentId,
                    position_level: positionLevel,
                    assessment_status: assessmentStatus,
                    strategy: strategy,
                    is_high_potential: isHighPotential,
                    user_ids: userIds, // Pass selected user IDs for comparison
                    grid_id: selectedGridId, // Send selected grid ID from URL or filter
                    page: page, // Include the page number for pagination
                    sort_column: sortColumn, // Send the selected column to sort by
                    sort_direction: sortDirection, // Send the selected sort direction
                    perPage: perPage, // Include perPage parameter
                    _token: '{{ csrf_token() }}' // Ensure to send the CSRF token
                };

                // AJAX request to fetch data based on selected filters, pagination, and grid filter
                $.ajax({
                    url: '{{ route('admin.talent-insight.index') }}',
                    method: 'GET',
                    data: formData,
                    success: function(response) {
                        // Replace the results section with new data
                        $('#insightResults').html(response.html); // Replace with the new HTML content
                        $('#insightPagination').html(response.pagination);
                        hideOverlay();
                        // Update the active class for pagination links
                        updatePaginationActiveClass(page);
                        // Reinitialize KTMenu dropdowns after new content is loaded
                        initMenuDropdowns();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error loading data: " + error);
                    }
                });
            }

            $(document).on('change', '#rowsPerPage', function() {
                // loadResults(); // Reload results with the selected rows per page
                loadResults(page, 0);
            });
            // Function to update the active class in pagination links
            function updatePaginationActiveClass(currentPage) {
                $('.pagination a').removeClass('active'); // Remove active class from all links

                // Loop through all pagination links and add the 'active' class to the current page
                $('.pagination a').each(function() {
                    var linkPage = getPageNumberFromUrl($(this).attr(
                        'href')); // Extract the page number from the URL

                    // Check if the current page matches the link's page number
                    if (linkPage == currentPage) {
                        $(this).addClass('active'); // Add active class to the correct pagination link
                        $(this).closest('li').addClass(
                            'active'); // Also add to the parent <li> for consistency
                    }
                });
            }

            // Helper function to extract page number from the URL
            function getPageNumberFromUrl(url) {
                var urlParams = new URLSearchParams(url.split('?')[1]);
                return urlParams.has('page') ? urlParams.get('page') : 1; // Default to 1 if no page query is found
            }
        });
    </script>
 
    <script>
        $(document).ready(function () {
            // Handle the export button click event
            $('#exportButton').on('click', function () {

                var data = {
                    division_id: $('#division_id').val(),
                    department_id: $('#department_id').val(),
                    position_level: $('#position_level').val(),
                    assessment_status: $('#assessment_status').val(),
                    strategy: $('#strategy').val(),
                    is_high_potential: $('#is_high_potential').is(':checked') ? 1 : 0,
                    user_ids: $('#user_ids').val() || [],
                    grid_id: $('#grid_id').val(),
                    fields: $('input[name="fields[]"]:checked').map(function () {
                        return $(this).val();
                    }).get(),
                };

                $('#fieldSettingsForm').append('<input type="hidden" name="division_id" value="' + data.division_id + '">');
                $('#fieldSettingsForm').append('<input type="hidden" name="department_id" value="' + data.department_id + '">');
                $('#fieldSettingsForm').append('<input type="hidden" name="position_level" value="' + data.position_level + '">');
                $('#fieldSettingsForm').append('<input type="hidden" name="assessment_status" value="' + data.assessment_status + '">');
                $('#fieldSettingsForm').append('<input type="hidden" name="strategy" value="' + data.strategy + '">');
                $('#fieldSettingsForm').append('<input type="hidden" name="is_high_potential" value="' + data.is_high_potential + '">');
                $('#fieldSettingsForm').append('<input type="hidden" name="user_ids" value="' + data.user_ids + '">');
                $('#fieldSettingsForm').append('<input type="hidden" name="grid_id" value="' + data.grid_id + '">');

                $('#fieldSettingsForm').submit();
            });
        });

    </script>

@endsection
