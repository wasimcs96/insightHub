@extends('insighthub.layout.app')

@section('title', 'Role Management')

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

        .role-table thead {
            background: #F5F7F8;
            color: #2E2F38;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
        }

        .role-table td,
        .role-table th {
            vertical-align: middle !important;
            color: #2E2F38 !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            line-height: 20px;
            border-bottom: 1px solid #ECF0F3 !important;
            padding: 16px;
            height: 75px !important;
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
            padding-left: 16px;
            padding-right: 16px;
            border: 0;
            border-bottom: 1px solid #ECF0F3 !important;
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

        .tag-default {
            display: flex;
            height: 22px;
            padding: 4px 8px;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
            background: #DDFBE2;
            color: #19622A;
            font-size: 12px;
            font-weight: 500;
            line-height: 17px;
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

        .dropdown-item.disabled {
            cursor: default;
            background: #F5F7F8;
        }

        .dropdown-toggle::after {
            display: none;
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
    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                    Role Management
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Role Management</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div id="feedbackMessage" class="justify-content-between align-items-center feedback-message mt-3 mb-3">
                <p class="text-center fw-medium m-0"><b>Success!</b> You’ve successfully created a new role.</p>
                <iconify-icon icon="iconamoon:close" width="20" height="20" class="cursor-pointer"
                    id="closeIcon"></iconify-icon>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">
            <div class="page-header my-15 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="top-heading m-0">Role Management</h4>
                    <p class="custom-text-muted m-0">Manage user roles and permissions across the system.</p>
                </div>
                <button class="custom-btn orange-fill">
                    <span class="me-2 d-flex align-items-center"><iconify-icon icon="ic:round-plus" width="20"
                            height="20"></iconify-icon></span> Create Role
                </button>
            </div>

            <!-- ✅ Tab Content -->
            <!-- Table -->
            <div class="table-border bg-white">
                <div class="table-responsive">
                    <table class="table role-table align-middle m-0">
                        <thead>
                            <tr>
                                <th>
                                    <div class="d-flex gap-2 align-items-center">Role Name<div class="d-flex flex-column">
                                            <iconify-icon icon="iwwa:arrow-up" width="12" height="12"
                                                class="thead-icon"></iconify-icon><iconify-icon icon="iwwa:arrow-down"
                                                width="12" height="12" class="thead-icon"></iconify-icon>
                                        </div>
                                    </div>
                                </th>
                                <th>Description</th>
                                <th>
                                    <div class="d-flex gap-2 align-items-center">No. of Users<div
                                            class="d-flex flex-column"><iconify-icon icon="iwwa:arrow-up" width="12"
                                                height="12" class="thead-icon"></iconify-icon><iconify-icon
                                                icon="iwwa:arrow-down" width="12" height="12"
                                                class="thead-icon"></iconify-icon></div>
                                    </div>
                                </th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex gap-2 align-items-center">Administrator <span
                                            class="tag-default">Default</span></div>
                                </td>
                                <td><span class="truncate-text"> Full system access and control</span>
                                </td>
                                <td>1</td>


                                <td class="text-center action-icons">
                                    <div class="dropdown-container">
                                        <iconify-icon icon="bi:three-dots-vertical" width="16" height="16"
                                            class="dropdown-toggle"></iconify-icon>

                                        <div class="dropdown-menu">
                                            <div class="dropdown-item">View</div>
                                            <div class="dropdown-item disabled" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Default roles cannot be edited.">Edit
                                            </div>
                                            <div class="dropdown-item">Duplicate</div>
                                            <div class="dropdown-item disabled" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-title="Default roles cannot be deleted.">
                                                Delete</div>
                                        </div>
                                    </div>

                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex gap-2 align-items-center">Head of Division <span
                                            class="tag-default">Default</span></div>
                                </td>
                                <td><span class="truncate-text"> Division-level leadership and oversight</span>
                                </td>
                                <td>2</td>


                                <td class="text-center action-icons">
                                    <div class="dropdown-container">
                                        <iconify-icon icon="bi:three-dots-vertical" width="16" height="16"
                                            class="dropdown-toggle"></iconify-icon>

                                        <div class="dropdown-menu">
                                            <div class="dropdown-item">View</div>
                                            <div class="dropdown-item">Edit</div>
                                            <div class="dropdown-item">Duplicate</div>
                                            <div class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteRole"
                                    data-id="1" data-name="Stewardship Mindset">Delete</div>
                                        </div>
                                    </div>

                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex gap-2 align-items-center">Head of Department <span
                                            class="tag-default">Default</span></div>
                                </td>
                                <td><span class="truncate-text"> Department leadership and coordination</span>
                                </td>
                                <td>2</td>


                                <td class="text-center action-icons">
                                    <div class="dropdown-container">
                                        <iconify-icon icon="bi:three-dots-vertical" width="16" height="16"
                                            class="dropdown-toggle"></iconify-icon>

                                        <div class="dropdown-menu">
                                            <div class="dropdown-item">View</div>
                                            <div class="dropdown-item">Edit</div>
                                            <div class="dropdown-item">Duplicate</div>
                                            <div class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteRole"
                                    data-id="2" data-name="Stewardship Mindset">Delete</div>
                                        </div>
                                    </div>

                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="d-flex gap-2 align-items-center">Employee <span
                                            class="tag-default">Default</span></div>
                                </td>
                                <td><span class="truncate-text"> Manage their personal and employment details.</span>
                                </td>
                                <td>2</td>


                                <td class="text-center action-icons">
                                    <div class="dropdown-container">
                                        <iconify-icon icon="bi:three-dots-vertical" width="16" height="16"
                                            class="dropdown-toggle"></iconify-icon>

                                        <div class="dropdown-menu">
                                            <div class="dropdown-item">View</div>
                                            <div class="dropdown-item">Edit</div>
                                            <div class="dropdown-item">Duplicate</div>
                                            <div class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteRole"
                                    data-id="3" data-name="Stewardship Mindset">Delete</div>
                                        </div>
                                    </div>

                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>

                <!-- Pagination + Results -->
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

        <div class="modal fade" id="deleteRole" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content delete-modal p-6">

                <!-- Warning Icon -->
                <div class="d-flex justify-content-center">
                        <span><iconify-icon icon="ep:warning" width="70" height="70" style="color: #F24130;"></iconify-icon></span>
                </div>

                <!-- Title -->
                <h5>Delete Role?</h5>

                <!-- Message -->
                <p>
                    You’re about to delete this role from the system. This action can’t be undone. Are you sure you want to proceed?
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
@endsection

@section('scripts')


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
        const deleteModal = document.getElementById('deleteRole');
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
