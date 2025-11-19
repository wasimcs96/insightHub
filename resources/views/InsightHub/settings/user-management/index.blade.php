@extends('insighthub.layout.app')

@section('title', 'User Management')

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

        .custom-btn.orange-fill {
            background: #F7941C;
            color: #FFF;
            border: none;
        }

        .custom-btn.orange-outline {
            background: #fff;
            color: #F1760F;
            border: 1px solid #F1760F;
        }

        .custom-btn.grey-outline {
            background: #F5F7F8;
            color: #2E2F38;
            border: 1px solid #727790;
        }

        .custom-btn.grey-fill {
            background: #DDE2E8;
            color: #99A1B7;
            border: 1px solid #ECF0F3;
        }

        .table-users thead {
            background: #F5F7F8;
            color: #2E2F38;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
        }

        .table-users td,
        .table-users th {
            vertical-align: middle !important;
            color: #2E2F38 !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            line-height: 20px;
            border-bottom: 1px solid #ECF0F3 !important;
            padding: 16px;
        }
        .table-header-text{
            color: #2E2F38 !important;
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

        .empty-state {
            text-align: center;
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

        .input-group {
            height: 48px;
        }

        .custom-badge {
            padding: 8px 16px;
            border-radius: 80px;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            min-width: 80px;
        }

        .badge-applied {
            background: #E3F7FF;
            color: #125A78;
        }

        .badge-sent {
            background: #DDF5E2;
            color: #196329;
        }

        .badge-pending {
            background: #FFEBB4;
            color: #EB8100;
        }

        .badge-shortlisted {
            background: #F2EEFD;
            color: #6652A1;
        }

        .badge-interview {
            background: #E2F6F6;
            color: #108585;
        }

        .badge-declined {
            background: #FFE0DD;
            color: #80221A;
        }

        .employee-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .employee-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .employee-details {
            display: flex;
            flex-direction: column;
        }

        .employee-details .name {
            color: #2E2F38;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
        }

        .employee-details .email {
            color: #2E2F38;
            font-size: 10px;
            font-weight: 400;
            line-height: 14px;
            margin-bottom: 4px;
        }

        .employee-details .code {
            color: #99A1B7;
            font-size: 10px;
            font-weight: 400;
            line-height: 14px;
        }

        .custom-checkbox input[type="checkbox"] {
            appearance: none;
            width: 16px;
            height: 16px;
            position: relative;
            cursor: pointer;
            transition: all 0.2s ease;
            border-radius: 2px;
            border: 1px solid #C8CFD9;
            background: #FFF;
        }

        .custom-checkbox input[type="checkbox"]:checked {
            background-color: #F7941C;
            border-color: #F7941C;
        }

        .custom-checkbox input[type="checkbox"]:checked::after {
            content: "✓";
            color: white;
            font-size: 12px;
            position: absolute;
            top: -2px;
            left: 2px;
            font-weight: bold;
        }

        .action-icons iconify-icon {
            cursor: pointer;
            color: #2E2F38;
        }

        .dropdown-container {
            position: relative;
            display: inline-block;
        }

        .dropdown-toggle {
            cursor: pointer;
            transition: background 0.2s;
            height: 43px;
            padding: 12px 16px;
            border-radius: 4px;
            text-align: center;
            display: flex;
            align-items: center;
        }

        .dropdown-toggle:hover {
            background: #F5F7F8;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 50px;
            z-index: 10;
            overflow: hidden;

            width: 237px;
            border-radius: 8px;
            border: 1.5px solid #ECF0F3;
            background: #FFF;
            box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.05);
            width: 237px;
            padding: 8px;
        }

        .dropdown-item {
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
            padding: 12px 16px;
            border-radius: 4px;
            background: #fff;
            color: #2E2F38;
            font-size: 14px;
            font-weight: 400;
            line-height: 19px;
        }

        .dropdown-item:hover {
            background: #FFF8EB;
        }

        .dropdown-item.delete:hover {
            color: #F24130;
        }

        .dropdown-item.disabled {
            cursor: default;
            background: #F5F7F8;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .table:not(.table-bordered) tr td:nth-child(2),
        .table:not(.table-bordered) tr th:nth-child(2),
        .table:not(.table-bordered) tbody tr:last-child td:nth-child(2) {
            border-right: 1px solid #ECF0F3;
        }

        .modal-body,
        .offcanvas-body {
            background: #FCFCFC;
        }

        button:disabled {
            border: 1px solid #C8CFD9 !important;
            background: #DDE2E8 !important;
            color: #99A1B7 !important;
        }

        .modal-step-text {
            color: #2E2F38;
            font-size: 16px;
            font-weight: 700;
            line-height: 20px;
            margin-bottom: 16px;
        }

        .invalid-feedback {
            display: flex;
            align-items: center;
            color: #BD2618;
            font-size: 14px;
            font-weight: 400;
            line-height: 19px;
            margin-top: 0.25rem;
        }

        .email-count,
        .filter-count {
            font-size: 14px;
            font-weight: 600;
            height: 20px;
            min-width: 20px;
            padding: 2px 6px;
            gap: 10px;
            border-radius: 100px;
            background: #FFF;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .email-count {
            color: #D5540A;
        }

        .filter-count {
            color: #F7941C;
        }

        tr.selected-row {
            background-color: #FFF8EB !important;
            transition: background-color 0.2s ease;
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
            background: #F7941C;
            color: #FFF;
            border: 1px solid #F7941C;
        }

        .onboarding-email,
        .delete-modal {
            border-radius: 12px;
            position: relative;
            text-align: center;
        }

        .onboarding-email h5,
        .delete-modal h5 {
            color: #2E2F38;
            font-size: 22.75px;
            font-weight: 600;
            line-height: 27.3px;
            margin-top: 12px;
            margin-bottom: 8px;
        }

        .onboarding-email p,
        .delete-modal p, .found-employees {
            color: #727790;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            margin-bottom: 20px;
        }

        .feedback-message {
            display: flex;
            border-radius: 8px;
            border: 1px solid #BBECC5;
            background: #DDF5E2;
            padding: 24px;
            margin-bottom: 36px;
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

        .select2-container--bootstrap5 .select2-dropdown .select2-results__option.select2-results__option--selected,
        .select2-container--bootstrap5 .select2-dropdown .select2-results__option.select2-results__option--highlighted {
            color: #F7941C;
        }

        .select2-container--bootstrap5 .select2-dropdown .select2-results__option.select2-results__option--selected:after {
            background-color: #F7941C;
        }

        .select2-container--bootstrap5 .select2-selection--multiple .select2-selection__rendered .select2-selection__choice {
            background-color: #fff;
            border: 1px solid #dbdfe9;

        }

        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }


        .tag {
            display: flex;
            padding: 2px 14px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            border: 1px solid #F7941C;
            background: #FFF8EB;
            color: #D5540A;
            font-size: 14px;
            font-weight: 600;
            height: 32px;
            cursor: default;
            transition: box-shadow 0.2s;
        }
/* 
        .tag:hover {
            box-shadow: 0 0 0 2px #F7941C33;
        }

        .tag .remove-filter {
            cursor: pointer;
            transition: color 0.2s;
        }

        .tag .remove-filter:hover {
            color: #F24130;
        } */
    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                    User Management (Employee)
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">User Management</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Employee</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">
            <div class="page-header my-15">
                {{-- @if (session()->has('alert-success'))
                    <div id="feedbackMessage" class="justify-content-between align-items-center feedback-message mt-3">
                        <p class="text-center fw-medium m-0">
                            <b>Success!</b> {{ session('alert-success') }}
                        </p>
                        <iconify-icon icon="iconamoon:close" width="20" height="20" class="cursor-pointer" id="closeIcon"></iconify-icon>
                    </div>
                @endif --}}
                <h4 class="top-heading m-0">User Management</h4>
                <p class="custom-text-muted m-0">Manage user accounts, access, and permissions.</p>
            </div>

            <ul class="permission-tabs nav nav-pills mb-7" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-tab="employee" id="pills-permissions-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-permissions" type="button" role="tab" aria-controls="pills-permissions"
                        aria-selected="true">
                        Employee <span class="user-number">{{ $employeeCount }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-tab="candidate" id="pills-users-tab" data-bs-toggle="pill" data-bs-target="#pills-users"
                        type="button" role="tab" aria-controls="pills-users" aria-selected="false">
                        Candidate <span class="user-number">{{ $candidateCount }}</span>
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                {{-- Employee Tab --}}
                <div class="tab-pane fade show active" id="pills-permissions" role="tabpanel" aria-labelledby="pills-permissions-tab" tabindex="0">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-5">
                        <div class="d-flex gap-5 align-items-center justify-content-center">
                            <button class="custom-btn grey-outline gap-3" data-bs-toggle="offcanvas" id="filterTrigger"
                                data-bs-target="#filterSidebar" aria-controls="filterSidebar">
                                <span class="d-flex align-items-center"><iconify-icon icon="lets-icons:filter"
                                        width="20" height="20"></iconify-icon></span> Filter <span
                                    class="filter-count" style="display: none;">1</span>
                            </button>
                            <div class="input-group">
                                <input type="text" class="search-box" placeholder="Search employee" id="employeeSearch">
                                <span class="input-group-text" id="employeeSearchIcon" style="cursor:pointer;">
                                    <iconify-icon icon="ic:round-search" width="20"></iconify-icon>
                                </span>
                            </div>
                        </div>
                        <div class="d-flex gap-5 align-items-center justify-content-center">
                            <button id="sendEmailBtn" class="custom-btn orange-fill gap-3" data-bs-toggle="modal"
                                data-bs-target="#SendOnboardingEmail" disabled>
                                <span class="d-flex align-items-center">
                                    <iconify-icon icon="ic:outline-email" width="20" height="20"></iconify-icon>
                                </span>
                                Send Onboarding Email
                                <span class="email-count d-none"></span>
                            </button>
                            <svg xmlns="http://www.w3.org/2000/svg" width="1" height="43" viewBox="0 0 1 43"
                                fill="none">
                            <path d="M0.5 0V43" stroke="#C8CFD9" />
                            </svg>
                            <a href="{{ route('insighthub.settings.user-management.create') }}" class="custom-btn orange-outline">
                                <span class="me-2 d-flex align-items-center">
                                    <iconify-icon icon="ic:round-plus" width="20" height="20"></iconify-icon>
                                </span>
                                Add User
                            </a>
                            @php $user = auth()->user(); @endphp
                            @if ($user && $user->is_external_user == 0)
                                <button class="custom-btn orange-fill" data-bs-toggle="modal" data-bs-target="#BulkUpload">
                                    <span class="me-2 d-flex align-items-center">
                                        <iconify-icon icon="material-symbols:upload" width="20" height="20"></iconify-icon>
                                    </span> Bulk Upload
                                </button>
                            @endif
                        </div>
                    </div>
                    {{-- @include('InsightHub.settings.user-management._tags-container', [
                        'businessUnits' => $businessUnits,
                        'divisions' => $divisions,
                        'departments' => $departments,
                        'jobPositions' => $jobPositions,
                        'selectedFilters' => $selectedFilters,
                        'tab' => 'employee'
                    ])                     --}}
                    {{-- <p class="found-employees">Found {{ $users->total() }} employees.</p> --}}
                    <div id="employee-table-container">
                        @if ($employees->count())
                            @include('InsightHub.settings.user-management._table', ['users' => $employees, 'tab' => 'employee'])
                        @else
                            @include('InsightHub.settings.user-management._empty-state', ['type' => 'Employee'])
                        @endif
                    </div>
                </div>

                {{-- Candidate Tab --}}
                <div class="tab-pane fade" id="pills-users" role="tabpanel" aria-labelledby="pills-users-tab" tabindex="0">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-5">
                        <div class="d-flex gap-5 align-items-center justify-content-between" style="width: 100%;">
                            <button class="custom-btn grey-outline gap-3" data-bs-toggle="offcanvas" id="filterTriggerCandidate"
                                data-bs-target="#filterSidebarCandidate" aria-controls="filterSidebarCandidate">
                                <span class="d-flex align-items-center"><iconify-icon icon="lets-icons:filter"
                                        width="20" height="20"></iconify-icon></span> Filter <span
                                    class="filter-count" style="display: none;">1</span>
                            </button>
                            <div class="input-group" style="width: max-content !important;">
                                <input type="text" class="search-box" placeholder="Search candidate" id="candidateSearch">
                                <span class="input-group-text" id="candidateSearchIcon" style="cursor:pointer;">
                                    <iconify-icon icon="ic:round-search" width="20"></iconify-icon>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="candidate-table-container">
                        @if ($candidates->count())
                            @include('InsightHub.settings.user-management._table_candidate', ['users' => $candidates, 'tab' => 'candidate'])
                        @else
                            @include('InsightHub.settings.user-management._empty-state', ['type' => 'Candidate'])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bulk Upload Modal -->
    @include('InsightHub.settings.user-management.bulk-upload')

    <div class="modal fade" id="SendOnboardingEmail" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content onboarding-email p-6">

                <!-- Warning Icon -->
                <div class="d-flex justify-content-center">
                    <span><iconify-icon icon="ep:warning" width="70" height="70"
                            style="color: #F9A207;"></iconify-icon></span>
                </div>

                <!-- Title -->
                <h5>Send Onboarding Email?</h5>

                <!-- Message -->
                <p>
                    You’re about to send the onboarding email to 2 recipients. Do you want to proceed?
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

    <div class="modal fade" id="DeleteEmployee" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="deleteUserForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content delete-modal p-6">
                    <!-- Warning Icon -->
                    <div class="d-flex justify-content-center">
                        <span><iconify-icon icon="ep:warning" width="70" height="70" style="color: #F24130;"></iconify-icon></span>
                    </div>
                    <!-- Title -->
                    <h5>Delete Employee?</h5>
                    <!-- Message -->
                    <p>
                        You’re about to delete this employee from the system. This action can’t be undone. Are you sure you want to proceed?
                    </p>
                    <!-- Buttons -->
                    <div class="d-flex gap-3 justify-content-center">
                        <button type="button" class="modal-custom-btn modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="modal-custom-btn modal-confirm-btn" style="background: #F24130;">
                            Confirm
                        </button>
                    </div>
                    <!-- Close icon -->
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal">&times;</button>
                </div>
            </form>
        </div>
    </div>
    {{-- Filter Sidebar --}}
    @include('InsightHub.settings.user-management._filter-sidebar')
    @include('InsightHub.settings.user-management._filter-sidebar-candidate')
    {{-- <div class="offcanvas offcanvas-end" tabindex="-1" id="filterSidebar" aria-labelledby="filterSidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="filterSidebarLabel">Filter</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form>
                <div class="mb-3">
                    <label class="form-label fw-bold" for="businessUnit">Business Unit</label>
                    <select id="businessUnit" class="form-select" multiple>
                        <option>BU 1</option>
                        <option>BU 2</option>
                        <option>BU 3</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold" for="division">Division</label>
                    <select id="division" class="form-select" multiple>
                        <option>Division 1</option>
                        <option>Division 2</option>
                        <option>Division 3</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold" for="department">Department</label>
                    <select id="department" class="form-select" multiple>
                        <option>Department 1</option>
                        <option>Department 2</option>
                        <option>Department 3</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold" for="jobPosition">Job Position</label>
                    <select class="form-select" id="jobPosition">
                        <option>Select job position</option>
                        <option>Job position 1</option>
                        <option>Job position 2</option>
                        <option>Job position 3</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold" for="onboardingEmail">Onboarding Email Status</label>
                    <select class="form-select" id="onboardingEmail">
                        <option>Select onboarding email status</option>
                        <option>Sent</option>
                        <option>Pending</option>
                    </select>
                </div>

        </div>

        <div class="offcanvas-header d-flex justify-content-end gap-6">
            <button type="reset" class="custom-btn grey-outline bg-white" data-bs-dismiss="modal">Reset</button>
            <button type="submit" class="custom-btn orange-fill">Filter</button>
        </div>
        </form>
    </div> --}}

    {{-- <div id="user-table-container">
        @include('InsightHub.settings.user-management._table', ['users' => $employees, 'tab' => 'employee'])
    </div> --}}
@endsection

@section('scripts')
    <!-- User Management JavaScript -->
    {{-- <script src="{{ asset('js/user-management.js') }}"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
            function initSelect2() {
        // Employee sidebar
        $('#businessUnit').select2({ placeholder: 'Select business unit', width: '100%', allowClear: true });
        $('#division').select2({ placeholder: 'Select division', width: '100%', allowClear: true });
        $('#department').select2({ placeholder: 'Select department', width: '100%', allowClear: true });
        $('#jobPosition').select2({ placeholder: 'Select job position', width: '100%', allowClear: true });
        $('#onboardingEmail').select2({ placeholder: 'Select Onboarding Email Status', width: '100%', allowClear: true });

        // Candidate sidebar
        $('#businessUnitCandidate').select2({ placeholder: 'Select business unit', width: '100%', allowClear: true });
        $('#divisionCandidate').select2({ placeholder: 'Select division', width: '100%', allowClear: true });
        $('#departmentCandidate').select2({ placeholder: 'Select department', width: '100%', allowClear: true });
        $('#jobPositionCandidate').select2({ placeholder: 'Select job position', width: '100%', allowClear: true });
        $('#hiringStatusCandidate').select2({ placeholder: 'Select hiring status', width: '100%', allowClear: true });
    }

    $(document).ready(function() {
        initSelect2();
    });

    // After AJAX loads new content, call:
    initSelect2();
    </script>

    <script>
        function loadUserTable(url, tab) {
            $.ajax({
                url: url + (url.indexOf('?') > -1 ? '&' : '?') + 'tab=' + tab,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.table) {
                        if (tab === 'candidate') {
                            $('#candidate-table-container').html(response.table);
                            // Update candidate badge
                            $('button#pills-users-tab .user-number').text(response.candidateCount);
                            initSelect2();
                        } else {
                            $('#employee-table-container').html(response.table);
                            // Update employee badge
                            $('button#pills-permissions-tab .user-number').text(response.employeeCount);
                        }
                    }
                },
                error: function() {
                    alert('Failed to load users.');
                }
            });
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectAll = document.querySelector(".select-all");
            const checkboxes = document.querySelectorAll(".select-row");
            const sendBtn = document.getElementById("sendEmailBtn");
            const emailCount = document.querySelector(".email-count");

            function updateState() {
                const checked = [...checkboxes].filter(cb => cb.checked);
                const count = checked.length;

                // Highlight rows
                checkboxes.forEach(cb => {
                    const row = cb.closest("tr");
                    row.classList.toggle("selected-row", cb.checked);
                });

                // Handle select-all states
                const allChecked = checkboxes.length > 0 && checked.length === checkboxes.length;
                const someChecked = checked.length > 0 && checked.length < checkboxes.length;
                selectAll.checked = allChecked;
                selectAll.indeterminate = someChecked;

                // Update button + count visibility
                sendBtn.disabled = count === 0;
                emailCount.textContent = count;
                emailCount.classList.toggle("d-none", count === 0);
            }

            selectAll.addEventListener("change", function() {
                checkboxes.forEach(cb => cb.checked = this.checked);
                updateState();
            });

            checkboxes.forEach(cb => cb.addEventListener("change", updateState));
        });
    </script>

    <script>
        document.addEventListener('click', function(event) {
            const isDropdownButton = event.target.closest('.dropdown-toggle');
            const openDropdown = document.querySelector('.dropdown-menu.show');

            // Close already open dropdown if clicked outside
            if (openDropdown && !openDropdown.contains(event.target)) {
                openDropdown.classList.remove('show');
            }

            // Toggle the clicked dropdown
            if (isDropdownButton) {
                const menu = isDropdownButton
                    .closest('.dropdown-container')
                    .querySelector('.dropdown-menu');
                menu.classList.toggle('show');
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const fileInput = document.getElementById("fileInput");
            const submitBtn = document.getElementById("submitBtn");

            fileInput.addEventListener("change", function() {
                submitBtn.disabled = !fileInput.files.length; // enable only when a file is selected
            });
        });
    </script>

    <script>
        const fileInput = document.getElementById("fileInput");
        const fileError = document.getElementById("fileError");
        const submitBtn = document.getElementById("submitBtn");

        // Enable submit when a file is selected
        fileInput.addEventListener("change", () => {
            submitBtn.disabled = !fileInput.files.length;
            fileInput.classList.remove("is-invalid");
            fileError.classList.add("d-none");
        });

        // Simulate failed upload (replace this with actual error handling)
        document.getElementById("BulkUploadForm").addEventListener("submit", (e) => {
            e.preventDefault(); // remove this in production
            // On failure
            fileInput.classList.add("is-invalid");
            fileError.classList.remove("d-none");
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // On form submit ("Filter" button)
            // document.querySelector('.offcanvas-body form').addEventListener('submit', function(e) {
            //     e.preventDefault(); // prevent actual submission

            //     // Count non-empty filters: check selects with values
            //     let count = 0;
            //     let selects = this.querySelectorAll('select');
            //     selects.forEach(function(sel) {
            //         if (sel.multiple) {
            //             count += sel.selectedOptions.length;
            //         } else {
            //             if (sel.selectedIndex > 0) { // ignore the "Select ..." placeholder
            //                 count++;
            //             }
            //         }
            //     });

            //     // Set and show the filter count
            //     let filterCountSpan = document.querySelector('.filter-count');
            //     filterCountSpan.textContent = count;
            //     filterCountSpan.style.display = count > 0 ? 'flex' : 'none';

            //     // Change filter button to orange-fill
            //     var filterBtn = document.getElementById('filterTrigger');
            //     filterBtn.classList.remove('grey-outline');
            //     filterBtn.classList.add('orange-fill');

            //     // Close the offcanvas
            //     let filterSidebar = bootstrap.Offcanvas.getInstance(document.getElementById(
            //         'filterSidebar'));
            //     filterSidebar.hide();
            // });
        });
    </script>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle pagination link clicks for both tabs
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        let tab = url.includes('tab=candidate') ? 'candidate' : 'employee';
        loadUserTable(url, tab);
    });

    // Handle per page change for both tabs
    $(document).on('change', '#employee-table-container .results-select, #candidate-table-container .results-select', function() {
        let form = $(this).closest('form');
        let tab = form.find('input[name="tab"]').val();
        let url = "{{ route('insighthub.settings.user-management.index') }}?" + form.serialize();
        loadUserTable(url, tab);
    });

    // function loadUserTable(url, tab) {
    //     $.ajax({
    //         url: url + (url.indexOf('?') > -1 ? '&' : '?') + 'tab=' + tab,
    //         type: 'GET',
    //         dataType: 'json', 
    //         success: function(response) {
    //             // Try to parse as JSON
    //             let isJson = false;
    //             try {
    //                 var json = JSON.parse(response);
    //                 isJson = true;
    //             } catch (e) {}

    //             if (isJson && json.table) {
    //                 // AJAX filter returns JSON with table and tags
    //                 if (tab === 'candidate') {
    //                     $('#candidate-table-container').html(json.table);
    //                     $('.tags-container').html($(json.tags).html());
    //                     initSelect2();
    //                 } else {
    //                     $('#employee-table-container').html(json.table);
    //                     $('.tags-container').html($(json.tags).html());
    //                 }
    //             } else {
    //                 // Pagination returns HTML partial
    //                 if (tab === 'candidate') {
    //                     $('#candidate-table-container').html(response);
    //                 } else {
    //                     $('#employee-table-container').html(response);
    //                 }
    //             }
    //         },
    //         error: function() {
    //             alert('Failed to load users.');
    //         }
    //     });
    // }
});
</script>

<script>
$(document).on('input', '#employeeSearch', function() {
    let search = $(this).val();
    let url = "{{ route('insighthub.settings.user-management.index') }}?search=" + encodeURIComponent(search);
    loadUserTable(url, 'employee');
});
$(document).on('input', '#candidateSearch', function() {
    let search = $(this).val();
    let url = "{{ route('insighthub.settings.user-management.index') }}?search=" + encodeURIComponent(search);
    loadUserTable(url, 'candidate');
});
</script>

{{-- <script>
$(document).on('click', '#employeeSearchIcon', function() {
    let search = $('#employeeSearch').val();
    let url = "{{ route('insighthub.settings.user-management.index') }}?search=" + encodeURIComponent(search) + "&tab=employee";
    loadUserTable(url, 'employee');
});
$(document).on('click', '#candidateSearchIcon', function() {
    let search = $('#candidateSearch').val();
    let url = "{{ route('insighthub.settings.user-management.index') }}?search=" + encodeURIComponent(search) + "&tab=candidate";
    loadUserTable(url, 'candidate');
});
</script> --}}

<script>
$(document).ready(function() {
    $('#filterForm').on('submit', function(e) {
        e.preventDefault();

        // Count non-empty filters
        let count = 0;
        let selects = this.querySelectorAll('select');
        selects.forEach(function(sel) {
            if (sel.multiple) {
                count += sel.selectedOptions.length;
            } else {
                if (sel.selectedIndex > 0) {
                    count++;
                }
            }
        });

        // Update filter count and button color
        let filterCountSpan = document.querySelector('#filterTrigger .filter-count');
        filterCountSpan.textContent = count;
        filterCountSpan.style.display = count > 0 ? 'flex' : 'none';
        var filterBtn = document.getElementById('filterTrigger');
        filterBtn.classList.remove('grey-outline');
        filterBtn.classList.add('orange-fill');

        // AJAX request
        let tab = 'employee'; // <-- Always employee for this form
        let url = "{{ route('insighthub.settings.user-management.index') }}?" + $(this).serialize() + "&tab=" + tab;
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#employee-table-container').html(response.table);
                $('button#pills-permissions-tab .user-number').text(response.employeeCount);
                // $('.tags-container').html($(response.tags).html());
            },
            error: function() {
                alert('Failed to load users.');
            }
        });

        // Close the offcanvas
        let filterSidebar = bootstrap.Offcanvas.getInstance(document.getElementById('filterSidebar'));
        if (filterSidebar){
            filterSidebar.hide();
        }
    });

    $('#filterFormCandidate').on('submit', function(e) {
        e.preventDefault();
        console.log('Candidate filter submitted');
        // Count non-empty filters
        let count = 0;
        let selects = this.querySelectorAll('select');
        selects.forEach(function(sel) {
            if (sel.multiple) {
                count += sel.selectedOptions.length;
            } else {
                if (sel.selectedIndex > 0) {
                    count++;
                }
            }
        });

        // Update filter count and button color
        let filterCountSpan = document.querySelector('#filterTriggerCandidate .filter-count');
        filterCountSpan.textContent = count;
        filterCountSpan.style.display = count > 0 ? 'flex' : 'none';
        var filterBtn = document.getElementById('filterTriggerCandidate');
        filterBtn.classList.remove('grey-outline');
        filterBtn.classList.add('orange-fill');

        // AJAX request
        let tab = 'candidate';
        let url = "{{ route('insighthub.settings.user-management.index') }}?" + $(this).serialize() + "&tab=" + tab;
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#candidate-table-container').html(response.table);
                // $('.tags-container').html($(response.tags).html());
                initSelect2();

                // Activate candidate tab after filter
                $('#pills-users-tab').addClass('active');
                $('#pills-users').addClass('show active');
                $('#pills-permissions-tab').removeClass('active');
                $('#pills-permissions').removeClass('show active');
                $('button#pills-users-tab .user-number').text(response.candidateCount);
            },
            error: function() {
                alert('Failed to load candidates.');
            }
        });

        let filterSidebar = bootstrap.Offcanvas.getInstance(document.getElementById('filterSidebarCandidate'));
        if (filterSidebar) filterSidebar.hide();
    });
});
</script>

<script>
$(document).ready(function() {
    // Candidate filter count and button color
    // document.querySelector('#filterFormCandidate').addEventListener('submit', function(e) {
    //     e.preventDefault();

    //     // Count non-empty filters: check selects with values
    //     let count = 0;
    //     let selects = this.querySelectorAll('select');
    //     selects.forEach(function(sel) {
    //         if (sel.multiple) {
    //             count += sel.selectedOptions.length;
    //         } else {
    //             if (sel.selectedIndex > 0) { // ignore the "Select ..." placeholder
    //                 count++;
    //             }
    //         }
    //     });

    //     // Set and show the filter count
    //     let filterCountSpan = document.querySelector('#filterTriggerCandidate .filter-count');
    //     filterCountSpan.textContent = count;
    //     filterCountSpan.style.display = count > 0 ? 'flex' : 'none';

    //     // Change filter button to orange-fill
    //     var filterBtn = document.getElementById('filterTriggerCandidate');
    //     filterBtn.classList.remove('grey-outline');
    //     filterBtn.classList.add('orange-fill');

    //     // Close the offcanvas
    //     let filterSidebar = bootstrap.Offcanvas.getInstance(document.getElementById('filterSidebarCandidate'));
    //     if (filterSidebar) filterSidebar.hide();

    //     // Submit AJAX (already handled in your other script)
    // });
});
</script>

<script>
$(document).on('click', '.table-users th a', function(e) {
    e.preventDefault();
    let url = $(this).attr('href');
    let tab = url.includes('tab=candidate') ? 'candidate' : 'employee';
    loadUserTable(url, tab);
});
</script>

<script>
$(document).ready(function() {
    // Deselect all options when reset is clicked for employee sidebar
    // Employee sidebar reset
    $('#filterForm').on('reset', function() {
        setTimeout(() => {
            $(this).find('select').val(null).trigger('change'); // Clear Select2
            $(this).submit();
            let filterSidebar = bootstrap.Offcanvas.getOrCreateInstance(document.getElementById('filterSidebar'));
            filterSidebar.hide();
        }, 0);
    });

    // Candidate sidebar reset
    $('#filterFormCandidate').on('reset', function() {
        setTimeout(() => {
            $(this).find('select').val(null).trigger('change'); // Clear Select2
            $(this).submit();
            let filterSidebarCandidate = bootstrap.Offcanvas.getOrCreateInstance(document.getElementById('filterSidebarCandidate'));
            filterSidebarCandidate.hide();
        }, 0);
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Listen for offcanvas close event for both sidebars
    const employeeSidebar = document.getElementById('filterSidebar');
    const candidateSidebar = document.getElementById('filterSidebarCandidate');

    [employeeSidebar, candidateSidebar].forEach(function(sidebar) {
        if (sidebar) {
            sidebar.addEventListener('hidden.bs.offcanvas', function() {
                // Find all backdrops and set opacity to 0
                document.querySelectorAll('.offcanvas-backdrop.fade').forEach(function(backdrop) {
                    backdrop.style.opacity = '0';
                });
            });
        }
    });
});
</script>

<script>
function getActiveTab() {
    // Adjust selector as needed for your tab buttons
    return $('.nav-link.active').attr('data-tab') || 'employee';
}

// Before submitting any filter form, set the tab value
$('#filterForm, #filterFormCandidate').on('submit', function(e) {
    e.preventDefault();
    $(this).find('input[name="tab"]').val(getActiveTab());
    let tab = $(this).find('input[name="tab"]').val();
    let url = "{{ route('insighthub.settings.user-management.index') }}?" + $(this).serialize();
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (tab === 'candidate') {
                $('#candidate-table-container').html(response.table);
                // ...other candidate logic...
            } else {
                $('#employee-table-container').html(response.table);
                // ...other employee logic...
            }
        },
        error: function() {
            alert('Failed to load users.');
        }
    });
    // ...close sidebar logic...
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var deleteModal = document.getElementById('DeleteEmployee');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var userId = button.getAttribute('data-user-id');
        var form = document.getElementById('deleteUserForm');
        form.action = '/insighthub/settings/user-management/' + userId + '/delete';
    });
});
</script>


