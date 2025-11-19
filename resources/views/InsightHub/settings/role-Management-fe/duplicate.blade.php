@extends('insighthub.layout.app')

@section('title', 'Duplicate Role')

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

        .page-heading {
            color: #2E2F38;
            font-size: 32px;
            font-weight: 600;
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

        .settings-card-header {
            margin-bottom: 24px;
        }

        .thead-icon {
            color: #C8CFD9;
        }

        .thead-icon:hover,
        .thead-icon:active {
            color: #F7941C;
        }

        .search-box {
            border: 1px solid #C8CFD9;
            border-radius: 8px;
            padding: 8px 14px;
            width: 250px;
        }

        input:focus-visible {
            outline: none;
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

        .custom-btn.outline-red {
            background: #fff;
            color: #D5540A;
            border: 1px solid #D5540A;
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

        .form-switch .form-check-input {
            width: 32px;
            height: 16px;
            background-color: #fff;
            cursor: pointer;
            padding: 2px;
            transition: background-color 0.3s;
            border-radius: 32px;
            border: 1px solid #C8CFD9;

        }

        .module-header .form-check {
            min-height: inherit;
            margin-bottom: 0px;
        }

        .form-switch .form-check-input:checked {
            background-color: #F1760F;
            border: 1px solid #F7941C;
        }

        .module-header {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .table-role thead {
            background: #F5F7F8;
            color: #2E2F38;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
        }

        .table-role td,
        .table-role th {
            vertical-align: middle !important;
            color: #2E2F38 !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            line-height: 20px;
            border-bottom: 1px solid #ECF0F3 !important;
            padding: 16px;
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
            cursor: pointer;
            color: #2E2F38;
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
            padding-left: 16px;
            padding-right: 16px;
            border: 0;
            border-bottom: 1px solid #ECF0F3 !important;
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


        .table-border {
            border-radius: 4px;
            border: 1px solid #ECF0F3;
        }

        .permission-tabs {
            border-bottom: 1.5px solid #DBDFE9;
        }

        .permission-tabs .nav-link {
            display: flex;
            padding: 16px;
            justify-content: center;
            align-items: center;
            gap: 4px;
            color: #727790;
            font-size: 14px;
            font-weight: 600;
            line-height: 18px;
            position: relative;
            top: 1.5px;
        }

        .permission-tabs .nav-link.active {
            color: #F7941C;
            border-bottom: 1.5px solid #F7941C;
            background: none;
            border-radius: 0;
        }

        .user-number {
            height: 16px;
            min-width: 16px;
            padding: 2px 4px;
            border-radius: 100px;
            background: #5E6375;
            color: #FFF;
            display: flex;
            align-items: center;
            font-size: 12px;
            font-weight: 500;
            line-height: 24px;
        }

        .accordion-item {
            border: 1px solid #ECF0F3 !important;
            padding: 24px;
            border-radius: 8px !important;
            overflow: hidden;
            margin: 24px 0px 16px 0px;
            background: #fff;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
        }

        .accordion-button {
            background-color: #fff;
            border-bottom: 1px solid #ECF0F3;
            padding: 0px;
            box-shadow: none !important;
            border: none !important;
            color: #2E2F38;
            font-size: 20px;
            font-weight: 600;
        }

        .accordion-button:not(.collapsed) {
            border-bottom: 1px solid #ECF0F3 !important;
            padding-bottom: 24px;
            background: #fff;
            color: #2E2F38;
        }

        .accordion-body {
            padding: 0;
            margin-top: 24px;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: #fafafa;
            color: #555;
            font-weight: 600;
            font-size: 14px;
            border-bottom: 1px solid #eee;
        }

        .table td {
            font-size: 14px;
            color: #333;
            vertical-align: middle;
            border-color: #f3f3f3;
        }

        .check-icon {
            color: #19622A !important;
            width: 24px;
            height: 24px;
            padding: 4px;
            gap: 4px;
            border-radius: 100px;
            background: #DDFBE2;
        }

        .cross-icon {
            color: #dc3545;
            width: 24px;
            height: 24px;
            padding: 4px;
            gap: 4px;
            border-radius: 100px;
            background: #FFE4E1;
        }

        .is-invalid {
            border-color: #F24130 !important;
            /* Red border */
        }

        .invalid-feedback {
            color: #9C2418;
            margin-top: 4px;
        }

        .form-control.is-invalid:focus,
        .was-validated .form-control:invalid:focus {
            box-shadow: none;
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                    Duplicate Role
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Role Management</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Duplicate Role</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">
            <div class="page-header my-15 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="top-heading m-0">Duplicate Role</h4>
                </div>
                <button class="custom-btn outline-red">
                    Collapse All
                </button>
            </div>
            <form>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Role Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control is-invalid" placeholder="Enter role name">

                    <div class="invalid-feedback d-block" style="font-size: 13px;">
                        <iconify-icon icon="fe:warning" width="12" height="12"></iconify-icon> This field is
                        required.
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea class="form-control" rows="4" placeholder="Enter description"></textarea>
                </div>


                <!-- Dynamic Accordion Start -->
                {{-- @foreach ($modules as $mainIdx => $main)
                    <div class="accordion mb-4" id="mainAccordion{{ $mainIdx }}">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $main['module'] }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $main['module'] }}" aria-expanded="true">
                                    <span class="toggle-label">{{ $main['module'] }}</span>
                                    <div class="form-check form-switch ms-auto">
                                        <input class="form-check-input parent-toggle" type="checkbox"
                                            {{ $main['enabled'] ? 'checked' : '' }}>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapse{{ $main['module'] }}" class="accordion-collapse collapse show"
                                aria-labelledby="heading{{ $main['module'] }}">
                                <div class="accordion-body p-0">
                                    @foreach ($main['sections'] as $secIdx => $section)
                                        <div class="accordion sub-accordion mb-3"
                                            id="subAccordion{{ $main['module'] }}{{ $secIdx }}">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading{{ $section['name'] }}">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse{{ $section['name'] }}"
                                                        aria-expanded="true">
                                                        <span class="fs-5 me-2">{{ $section['name'] }}</span>
                                                        <div class="form-check form-switch ms-auto">
                                                            <input class="form-check-input parent-toggle" type="checkbox"
                                                                {{ $section['enabled'] ? 'checked' : '' }}>
                                                        </div>
                                                    </button>
                                                </h2>
                                                <div id="collapse{{ $section['name'] }}"
                                                    class="accordion-collapse collapse show"
                                                    aria-labelledby="heading{{ $section['name'] }}">
                                                    <div class="accordion-body p-0">
                                                        <div class="table-responsive table-role table-border">
                                                            <table class="table mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Module</th>
                                                                        <th>All</th>
                                                                        <th>View</th>
                                                                        <th>Create</th>
                                                                        <th>Edit</th>
                                                                        <th>Delete</th>
                                                                        @if (isset($section['modules'][0]['permissions']['export']))
                                                                            <th>Export/Download</th>
                                                                        @endif
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($section['modules'] as $row)
                                                                        <tr>
                                                                            <td>{{ $row['row'] }}</td>
                                                                            <td>
                                                                                <div class="form-check form-switch"><input
                                                                                        class="form-check-input"
                                                                                        type="checkbox"
                                                                                        {{ $row['permissions']['all'] ? 'checked' : '' }}>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-check form-switch"><input
                                                                                        class="form-check-input"
                                                                                        type="checkbox"
                                                                                        {{ $row['permissions']['view'] ? 'checked' : '' }}>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-check form-switch"><input
                                                                                        class="form-check-input"
                                                                                        type="checkbox"
                                                                                        {{ $row['permissions']['create'] ? 'checked' : '' }}>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-check form-switch"><input
                                                                                        class="form-check-input"
                                                                                        type="checkbox"
                                                                                        {{ $row['permissions']['edit'] ? 'checked' : '' }}>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-check form-switch"><input
                                                                                        class="form-check-input"
                                                                                        type="checkbox"
                                                                                        {{ $row['permissions']['delete'] ? 'checked' : '' }}>
                                                                                </div>
                                                                            </td>
                                                                            @if (isset($row['permissions']['export']))
                                                                                <td>
                                                                                    <div class="form-check form-switch">
                                                                                        <input class="form-check-input"
                                                                                            type="checkbox"
                                                                                            {{ $row['permissions']['export'] ? 'checked' : '' }}>
                                                                                    </div>
                                                                                </td>
                                                                            @endif
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach --}}
                <!-- Dynamic Accordion End -->

                <!-- Accordion Start -->
                <div class="accordion" id="mainAccordion">
                    <!-- Parent Accordion Item -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingInsightHub">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseInsightHub" aria-expanded="true"
                                aria-controls="collapseInsightHub">
                                <div class="module-header w-100">
                                    <span class="toggle-label">InsightHub</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input parent-toggle" type="checkbox" checked>
                                    </div>
                                </div>
                            </button>
                        </h2>

                        <div id="collapseInsightHub" class="accordion-collapse collapse show"
                            aria-labelledby="headingInsightHub" data-bs-parent="#mainAccordion">
                            <div class="accordion-body">

                                <!-- Sub Accordion 1 -->
                                <div class="accordion sub-accordion" id="subAccordionAnalytics">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingAnalytics">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseAnalytics"
                                                aria-expanded="true" aria-controls="collapseAnalytics">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Analytics</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox"
                                                            checked>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseAnalytics" class="accordion-collapse collapse show"
                                            aria-labelledby="headingAnalytics" data-bs-parent="#subAccordionAnalytics">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border ">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Dashboard</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Chatbot</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="section-divider"></div>

                                <!-- Sub Accordion 2 -->
                                <div class="accordion sub-accordion" id="subAccordionSettings">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSettings">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSettings"
                                                aria-expanded="true" aria-controls="collapseSettings">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Settings</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox"
                                                            checked>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseSettings" class="accordion-collapse collapse show"
                                            aria-labelledby="headingSettings" data-bs-parent="#subAccordionSettings">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border ">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>User Management</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Role Management</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>General Settings</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- accordion-body -->
                        </div>
                    </div> <!-- accordion-item -->
                </div>

                <div class="accordion" id="mainAccordionTalentCore">
                    <!-- Parent Accordion Item -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTalentCore">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTalentCore" aria-expanded="true"
                                aria-controls="collapseTalentCore">
                                <div class="module-header w-100">
                                    <span class="toggle-label">TalentCore</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input parent-toggle" type="checkbox" checked>
                                    </div>
                                </div>
                            </button>
                        </h2>

                        <div id="collapseTalentCore" class="accordion-collapse collapse show"
                            aria-labelledby="headingTalentCore" data-bs-parent="#mainAccordionTalentCore">
                            <div class="accordion-body">

                                <!-- Talent Acquisition Section -->
                                <div class="accordion sub-accordion" id="subAccordionTalentAcquisition">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTalentAcquisition">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTalentAcquisition"
                                                aria-expanded="true" aria-controls="collapseTalentAcquisition">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Talent Acquisition</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox"
                                                            checked>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseTalentAcquisition" class="accordion-collapse collapse show"
                                            aria-labelledby="headingTalentAcquisition"
                                            data-bs-parent="#subAccordionTalentAcquisition">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Job Board</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Candidate Screening-Upcoming Interview</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Candidate Screening-Interview Conducted</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Advanced Comparison</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Interview Questions</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Template Settings</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Talent Management Section -->
                                <div class="accordion sub-accordion" id="subAccordionTalentManagement">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTalentManagement">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTalentManagement"
                                                aria-expanded="true" aria-controls="collapseTalentManagement">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Talent Management</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox"
                                                            checked>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseTalentManagement" class="accordion-collapse collapse show"
                                            aria-labelledby="headingTalentManagement"
                                            data-bs-parent="#subAccordionTalentManagement">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                                <th>Export/Download</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Talent Insights</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Advanced Comparison</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Job Management Section -->
                                <div class="accordion sub-accordion" id="subAccordionJobManagement">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingJobManagement">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseJobManagement"
                                                aria-expanded="true" aria-controls="collapseJobManagement">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Job Management</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox"
                                                            checked>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseJobManagement" class="accordion-collapse collapse show"
                                            aria-labelledby="headingJobManagement"
                                            data-bs-parent="#subAccordionJobManagement">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                                <th>Export/Download</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Job Management</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Technical Skills Library Section -->
                                <div class="accordion sub-accordion" id="subAccordionTechnicalSkillsLibrary">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTechnicalSkillsLibrary">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTechnicalSkillsLibrary"
                                                aria-expanded="true" aria-controls="collapseTechnicalSkillsLibrary">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Technical Skills Library</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox"
                                                            checked>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseTechnicalSkillsLibrary" class="accordion-collapse collapse show"
                                            aria-labelledby="headingTechnicalSkillsLibrary"
                                            data-bs-parent="#subAccordionTechnicalSkillsLibrary">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Technical Skills Library</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Settings Section -->
                                <div class="accordion sub-accordion" id="subAccordionSettingsTalentCore">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSettingsTalentCore">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSettingsTalentCore"
                                                aria-expanded="true" aria-controls="collapseSettingsTalentCore">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Settings</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox"
                                                            checked>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseSettingsTalentCore" class="accordion-collapse collapse show"
                                            aria-labelledby="headingSettingsTalentCore"
                                            data-bs-parent="#subAccordionSettingsTalentCore">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                                <th>Export/Download</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Organizational Structure-Employee List</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Organizational Structure-Chart</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Technical Assessment</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- accordion-body -->
                        </div>
                    </div> <!-- accordion-item -->
                </div>

                <div class="accordion" id="mainAccordionBSC">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingBSC">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseBSC" aria-expanded="true" aria-controls="collapseBSC">
                                <div class="module-header w-100">
                                    <span class="toggle-label">Balanced Scorecard (BSC)</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input parent-toggle" type="checkbox" checked>
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseBSC" class="accordion-collapse collapse show" aria-labelledby="headingBSC"
                            data-bs-parent="#mainAccordionBSC">
                            <div class="accordion-body">

                                <!-- BSC Dashboard Section -->
                                <div class="accordion sub-accordion" id="subAccordionBSCDashboard">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingBSCDashboard">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseBSCDashboard"
                                                aria-expanded="true" aria-controls="collapseBSCDashboard">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">BSC Dashboard</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox"
                                                            checked>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseBSCDashboard" class="accordion-collapse collapse show"
                                            aria-labelledby="headingBSCDashboard"
                                            data-bs-parent="#subAccordionBSCDashboard">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>View</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Individual Metric Summary</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Strategic Planning Section -->
                                <div class="accordion sub-accordion" id="subAccordionStrategicPlanning">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingStrategicPlanning">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseStrategicPlanning"
                                                aria-expanded="true" aria-controls="collapseStrategicPlanning">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Strategic Planning</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox"
                                                            checked>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseStrategicPlanning" class="accordion-collapse collapse show"
                                            aria-labelledby="headingStrategicPlanning"
                                            data-bs-parent="#subAccordionStrategicPlanning">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Listing Page</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Create New Plan</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>CEO Metrics Review</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Division Metrics Review</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Department Metrics Review</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Plan Activation</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Plan Archival</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Reports Section -->
                                <div class="accordion sub-accordion" id="subAccordionReports">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingReports">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseReports"
                                                aria-expanded="true" aria-controls="collapseReports">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Reports</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox">
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseReports" class="accordion-collapse collapse show"
                                            aria-labelledby="headingReports" data-bs-parent="#subAccordionReports">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                                <th>Export/Download</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Detailed Strategic Reports</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Division Performance Comparison Section -->
                                <div class="accordion sub-accordion" id="subAccordionDivisionPerformance">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingDivisionPerformance">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseDivisionPerformance"
                                                aria-expanded="true" aria-controls="collapseDivisionPerformance">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Division Performance Comparison</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox"
                                                            checked>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseDivisionPerformance" class="accordion-collapse collapse show"
                                            aria-labelledby="headingDivisionPerformance"
                                            data-bs-parent="#subAccordionDivisionPerformance">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                                <th>Export/Download</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Division Performance Comparison</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Settings Section -->
                                <div class="accordion sub-accordion" id="subAccordionBSCSettings">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingBSCSettings">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseBSCSettings"
                                                aria-expanded="true" aria-controls="collapseBSCSettings">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Settings</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox"
                                                            checked>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseBSCSettings" class="accordion-collapse collapse show"
                                            aria-labelledby="headingBSCSettings"
                                            data-bs-parent="#subAccordionBSCSettings">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Corporate Profile</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Division Profile</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Subsidiaries Profile</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Metric Tracker Section -->
                                <div class="accordion sub-accordion" id="subAccordionMetricTracker">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingMetricTracker">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseMetricTracker"
                                                aria-expanded="true" aria-controls="collapseMetricTracker">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Metric Tracker</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox">
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseMetricTracker" class="accordion-collapse collapse show"
                                            aria-labelledby="headingMetricTracker"
                                            data-bs-parent="#subAccordionMetricTracker">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Listing Page</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Metric Detail Page</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="mainAccordionPMS">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingPMS">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapsePMS" aria-expanded="true" aria-controls="collapsePMS">
                                <div class="module-header w-100">
                                    <span class="toggle-label">Performance Management (PMS)</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input parent-toggle" type="checkbox">
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapsePMS" class="accordion-collapse collapse show" aria-labelledby="headingPMS"
                            data-bs-parent="#mainAccordionPMS">
                            <div class="accordion-body">

                                <!-- Dashboard (Admin & Manager) Section -->
                                <div class="accordion sub-accordion" id="subAccordionPMSDashboard">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingPMSDashboard">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapsePMSDashboard"
                                                aria-expanded="true" aria-controls="collapsePMSDashboard">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Dashboard (Admin & Manager)</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox">
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapsePMSDashboard" class="accordion-collapse collapse show"
                                            aria-labelledby="headingPMSDashboard"
                                            data-bs-parent="#subAccordionPMSDashboard">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Admin Dashboard</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Manager Dashboard</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Plan Management (Admin & Manager) Section -->
                                <div class="accordion sub-accordion" id="subAccordionPMSPlanManagement">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingPMSPlanManagement">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapsePMSPlanManagement"
                                                aria-expanded="true" aria-controls="collapsePMSPlanManagement">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Plan Management (Admin & Manager)</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox">
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapsePMSPlanManagement" class="accordion-collapse collapse show"
                                            aria-labelledby="headingPMSPlanManagement"
                                            data-bs-parent="#subAccordionPMSPlanManagement">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Admin: Plan Review Listing</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Admin: Plan Review Page</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Manager: Team Plan Listing</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Manager: Review Plan Workflow</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Manager: Adjust Plan Workflow</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Performance Calibration Section -->
                                <div class="accordion sub-accordion" id="subAccordionPMSCalibration">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingPMSCalibration">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapsePMSCalibration"
                                                aria-expanded="true" aria-controls="collapsePMSCalibration">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Performance Calibration</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox">
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapsePMSCalibration" class="accordion-collapse collapse show"
                                            aria-labelledby="headingPMSCalibration"
                                            data-bs-parent="#subAccordionPMSCalibration">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Main Dashboard</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Detailed Review Page</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Team & My Performance (Manager & All Users) Section -->
                                <div class="accordion sub-accordion" id="subAccordionPMSTeamPerformance">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingPMSTeamPerformance">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapsePMSTeamPerformance"
                                                aria-expanded="true" aria-controls="collapsePMSTeamPerformance">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Team & My Performance (Manager & All
                                                        Users)</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox">
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapsePMSTeamPerformance" class="accordion-collapse collapse show"
                                            aria-labelledby="headingPMSTeamPerformance"
                                            data-bs-parent="#subAccordionPMSTeamPerformance">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Manager: Team Performance Listing</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Manager: Team Performance Review Form</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Manager: View Team Member Report</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>All Users: My Performance Dashboard</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>All Users: Self-Assessment Form</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="mainAccordionSuccessionPlanning">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSuccessionPlanning">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSuccessionPlanning" aria-expanded="true"
                                aria-controls="collapseSuccessionPlanning">
                                <div class="module-header w-100">
                                    <span class="toggle-label">Succession Planning</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input parent-toggle" type="checkbox">
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseSuccessionPlanning" class="accordion-collapse collapse show"
                            aria-labelledby="headingSuccessionPlanning"
                            data-bs-parent="#mainAccordionSuccessionPlanning">
                            <div class="accordion-body">

                                <!-- Dashboard Section -->
                                <div class="accordion sub-accordion" id="subAccordionSPDashboard">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSPDashboard">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSPDashboard"
                                                aria-expanded="true" aria-controls="collapseSPDashboard">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Dashboard</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox">
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseSPDashboard" class="accordion-collapse collapse show"
                                            aria-labelledby="headingSPDashboard"
                                            data-bs-parent="#subAccordionSPDashboard">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>View Analytics & KPIs</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Onboarding Journey</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Employee Profiles Section -->
                                <div class="accordion sub-accordion" id="subAccordionSPEmployeeProfiles">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSPEmployeeProfiles">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSPEmployeeProfiles"
                                                aria-expanded="true" aria-controls="collapseSPEmployeeProfiles">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Employee Profiles</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox">
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseSPEmployeeProfiles" class="accordion-collapse collapse show"
                                            aria-labelledby="headingSPEmployeeProfiles"
                                            data-bs-parent="#subAccordionSPEmployeeProfiles">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>View Full Profile</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Succession Pipeline Section -->
                                <div class="accordion sub-accordion" id="subAccordionSPSuccessionPipeline">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSPSuccessionPipeline">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSPSuccessionPipeline"
                                                aria-expanded="true" aria-controls="collapseSPSuccessionPipeline">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Succession Pipeline</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox">
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseSPSuccessionPipeline" class="accordion-collapse collapse show"
                                            aria-labelledby="headingSPSuccessionPipeline"
                                            data-bs-parent="#subAccordionSPSuccessionPipeline">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>View Pipeline Table</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Create Candidate Pool</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Manage Candidate Pools</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Set & Assign Successors</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Career Paths Section -->
                                <div class="accordion sub-accordion" id="subAccordionSPCareerPaths">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSPCareerPaths">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSPCareerPaths"
                                                aria-expanded="true" aria-controls="collapseSPCareerPaths">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Career Paths</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox">
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseSPCareerPaths" class="accordion-collapse collapse show"
                                            aria-labelledby="headingSPCareerPaths"
                                            data-bs-parent="#subAccordionSPCareerPaths">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>View All Employee Paths</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Assign Official Path</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Strategic Overview Section -->
                                <div class="accordion sub-accordion" id="subAccordionSPStrategicOverview">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSPStrategicOverview">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSPStrategicOverview"
                                                aria-expanded="true" aria-controls="collapseSPStrategicOverview">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Strategic Overview</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox">
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseSPStrategicOverview" class="accordion-collapse collapse show"
                                            aria-labelledby="headingSPStrategicOverview"
                                            data-bs-parent="#subAccordionSPStrategicOverview">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>View Employee List</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Compare Employees</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Settings Section -->
                                <div class="accordion sub-accordion" id="subAccordionSPSettings">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSPSettings">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSPSettings"
                                                aria-expanded="true" aria-controls="collapseSPSettings">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Settings</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox">
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseSPSettings" class="accordion-collapse collapse show"
                                            aria-labelledby="headingSPSettings"
                                            data-bs-parent="#subAccordionSPSettings">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Manage Critical Position Status</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Manage Job Position Weights</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Manage Critical Position Weights</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="mainAccordionSurveyManagement">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSurveyManagement">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSurveyManagement" aria-expanded="true"
                                aria-controls="collapseSurveyManagement">
                                <div class="module-header w-100">
                                    <span class="toggle-label">Survey Management System</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input parent-toggle" type="checkbox" checked>
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseSurveyManagement" class="accordion-collapse collapse show"
                            aria-labelledby="headingSurveyManagement" data-bs-parent="#mainAccordionSurveyManagement">
                            <div class="accordion-body">

                                <!-- Dashboard Section -->
                                <div class="accordion sub-accordion" id="subAccordionSMDashboard">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSMDashboard">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSMDashboard"
                                                aria-expanded="true" aria-controls="collapseSMDashboard">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Dashboard</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox"
                                                            checked>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseSMDashboard" class="accordion-collapse collapse show"
                                            aria-labelledby="headingSMDashboard"
                                            data-bs-parent="#subAccordionSMDashboard">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>View All Widgets & Charts</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Extend Survey Expiry</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>View Live Results</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Group Management Section -->
                                <div class="accordion sub-accordion" id="subAccordionSMGroupManagement">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSMGroupManagement">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSMGroupManagement"
                                                aria-expanded="true" aria-controls="collapseSMGroupManagement">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Group Management</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox"
                                                            checked>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseSMGroupManagement" class="accordion-collapse collapse show"
                                            aria-labelledby="headingSMGroupManagement"
                                            data-bs-parent="#subAccordionSMGroupManagement">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>List/Search Groups</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Create Group</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Edit Group</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Delete Group</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Download Member Template</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Question Bank Section -->
                                <div class="accordion sub-accordion" id="subAccordionSMQuestionBank">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSMQuestionBank">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSMQuestionBank"
                                                aria-expanded="true" aria-controls="collapseSMQuestionBank">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Question Bank</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox"
                                                            checked>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseSMQuestionBank" class="accordion-collapse collapse show"
                                            aria-labelledby="headingSMQuestionBank"
                                            data-bs-parent="#subAccordionSMQuestionBank">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>List Sections</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Create Section</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Edit Section / Save as Draft</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>View Live Results</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Survey Management & Lifecycle Section -->
                                <div class="accordion sub-accordion" id="subAccordionSMSurveyLifecycle">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSMSurveyLifecycle">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSMSurveyLifecycle"
                                                aria-expanded="true" aria-controls="collapseSMSurveyLifecycle">
                                                <div class="module-header w-100">
                                                    <span class="fs-5">Survey Management & Lifecycle</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input parent-toggle" type="checkbox"
                                                            checked>
                                                    </div>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapseSMSurveyLifecycle" class="accordion-collapse collapse show"
                                            aria-labelledby="headingSMSurveyLifecycle"
                                            data-bs-parent="#subAccordionSMSurveyLifecycle">
                                            <div class="accordion-body">
                                                <div class="table-responsive table-role table-border">
                                                    <table class="table mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th>All</th>
                                                                <th>View</th>
                                                                <th>Create</th>
                                                                <th>Edit</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>List & View Details</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Create Survey</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Edit Survey</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Delete Survey</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Duplicate Survey</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Copy Survey Link</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Extend Survey Expiry</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Close Survey Manually</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Start Survey Manually</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Cancel Survey</td>
                                                                <td>
                                                                    <div class="form-check form-switch"><input
                                                                            class="form-check-input" type="checkbox"
                                                                            checked></div>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 align-items-center">
                    <button type="button" class="custom-btn grey-outline">Cancel</button>
                    <button type="submit" class="custom-btn orange-fill">Create</button>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('scripts')

    <script>
        // Collapse all button functionality
        document.querySelector('.outline-red').addEventListener('click', () => {
            document.querySelectorAll('.collapse.show').forEach(el => {
                const collapse = new bootstrap.Collapse(el, {
                    toggle: false
                });
                collapse.hide();
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            function updateParentState(parentToggle, childToggles) {
                const allChecked = [...childToggles].every(cb => cb.checked);
                parentToggle.checked = allChecked;
            }

            // Parent → Child behavior
            document.querySelectorAll(".parent-toggle").forEach(parentToggle => {
                parentToggle.addEventListener("change", function() {
                    const section = this.closest(".accordion-item");
                    if (!section) return;

                    const childToggles = section.querySelectorAll(
                        ".form-check-input:not(.parent-toggle)");
                    childToggles.forEach(cb => cb.checked = this.checked);
                });
            });

            // Child → Parent behavior
            document.querySelectorAll(".accordion-item").forEach(section => {
                const parentToggle = section.querySelector(".parent-toggle");
                const childToggles = section.querySelectorAll(".form-check-input:not(.parent-toggle)");

                childToggles.forEach(childCb => {
                    childCb.addEventListener("change", function() {
                        updateParentState(parentToggle, childToggles);
                    });
                });
            });

        });
    </script>


    {{-- <script>
        document.querySelectorAll('.accordion-button').forEach(button => {
            button.addEventListener('click', function(e) {
                const targetSelector = this.getAttribute('data-bs-target');
                const target = document.querySelector(targetSelector);

                // Prevent Bootstrap's default automatic toggle
                e.preventDefault();

                // Get collapse instance
                const collapseInstance = bootstrap.Collapse.getOrCreateInstance(target, {
                    toggle: false
                });

                // If open -> close it
                if (target.classList.contains('show')) {
                    collapseInstance.hide();
                    this.classList.add('collapsed');
                }
                // If closed -> open it
                else {
                    collapseInstance.show();
                    this.classList.remove('collapsed');
                }
            });
        });
    </script> --}}

@endsection
