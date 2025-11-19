@extends('insighthub.layout.app')

@section('title', 'View Permissions')

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
    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                    View Permissions
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Role Management</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">View Permissions</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">
            <div class="page-header my-15 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="top-heading m-0">Employee</h4>
                    <p class="custom-text-muted m-0">Manage their personal and employment details.</p>
                </div>
                <button class="custom-btn outline-red">
                    Collapse All
                </button>
            </div>

            <!-- ✅ Tab Content -->
            <!-- Table -->
            <ul class="permission-tabs nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-permissions-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-permissions" type="button" role="tab" aria-controls="pills-permissions"
                        aria-selected="true">Permissions</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-users-tab" data-bs-toggle="pill" data-bs-target="#pills-users"
                        type="button" role="tab" aria-controls="pills-users" aria-selected="false">Users <span
                            class="user-number">152</span></button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-permissions" role="tabpanel"
                    aria-labelledby="pills-permissions-tab" tabindex="0">

                    <!-- Accordion Start -->
                    <div class="accordion" id="accordionExample">
                        <!-- InsightHub -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    InsightHub
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body settings-card p-0">
                                    <table class="table table-users mb-0">
                                        <thead>
                                            <tr>
                                                <th>Module</th>
                                                <th class="text-center">View</th>
                                                <th class="text-center">Create</th>
                                                <th class="text-center">Edit</th>
                                                <th class="text-center">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Hub Center</td>
                                                <td class="text-center">
                                                    <iconify-icon icon="material-symbols:check-rounded" class="check-icon"
                                                        width="16" height="16"></iconify-icon>
                                                </td>
                                                <td class="text-center">-</td>
                                                <td class="text-center">-</td>
                                                <td class="text-center">-</td>
                                            </tr>
                                                                                        <tr>
                                                <td>General Settings</td>
                                                <td class="text-center">
                                                    <iconify-icon icon="material-symbols:check-rounded" class="check-icon"
                                                        width="16" height="16"></iconify-icon>
                                                </td>
                                                <td class="text-center">-</td>
                                                <td class="text-center"><iconify-icon icon="maki:cross" class="cross-icon"
                                                        width="16" height="16"></iconify-icon></td>
                                                <td class="text-center">-</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Career Pathing -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingCareer">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseCareer" aria-expanded="false" aria-controls="collapseCareer">
                                    Career Pathing
                                </button>
                            </h2>

                            <div id="collapseCareer" class="accordion-collapse collapse" aria-labelledby="headingCareer">
                                <div class="accordion-body">
                                    <!-- Inner Accordion -->
                                    <div class="accordion" id="careerPathAccordion">

                                        <!-- My Career Path -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingInnerOne">
                                                <button class="accordion-button collapsed fs-4" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseInnerOne"
                                                    aria-expanded="false" aria-controls="collapseInnerOne">
                                                    My Career Path
                                                </button>
                                            </h2>
                                            <div id="collapseInnerOne" class="accordion-collapse collapse"
                                                aria-labelledby="headingInnerOne">
                                                <div class="accordion-body settings-card p-0">
                                                    <table class="table table-users mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th class="text-center">All</th>
                                                                <th class="text-center">View</th>
                                                                <th class="text-center">Create</th>
                                                                <th class="text-center">Edit</th>
                                                                <th class="text-center">Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>View Paths</td>
                                                                <td></td>
                                                                <td class="text-center">
                                                                    <iconify-icon icon="material-symbols:check-rounded"
                                                                        class="check-icon" width="16"
                                                                        height="16"></iconify-icon>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Select/Manage Desired Path</td>
                                                                <td></td>
                                                                <td class="text-center">
                                                                    <iconify-icon icon="material-symbols:check-rounded"
                                                                        class="check-icon" width="16"
                                                                        height="16"></iconify-icon>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center"><iconify-icon icon="material-symbols:check-rounded"
                                                                        class="check-icon" width="16"
                                                                        height="16"></iconify-icon></td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Skills and Development -->
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingInnerTwo">
                                                <button class="accordion-button collapsed fs-4" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseInnerTwo"
                                                    aria-expanded="false" aria-controls="collapseInnerTwo">
                                                    Skills and Development
                                                </button>
                                            </h2>
                                            <div id="collapseInnerTwo" class="accordion-collapse collapse"
                                                aria-labelledby="headingInnerTwo">
                                                <div class="accordion-body settings-card p-0">
                                                    <table class="table table-users mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Module</th>
                                                                <th class="text-center">All</th>
                                                                <th class="text-center">View</th>
                                                                <th class="text-center">Create</th>
                                                                <th class="text-center">Edit</th>
                                                                <th class="text-center">Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>View Assessment Results</td>
                                                                <td></td>
                                                                <td class="text-center">
                                                                    <iconify-icon icon="material-symbols:check-rounded"
                                                                        class="check-icon" width="16"
                                                                        height="16"></iconify-icon>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Update Skills</td>
                                                                <td></td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">-</td>
                                                                <td class="text-center">
                                                                    <iconify-icon icon="material-symbols:check-rounded"
                                                                        class="check-icon" width="16"
                                                                        height="16"></iconify-icon>
                                                                </td>
                                                                <td class="text-center">-</td>
                                                            </tr>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- End Inner Accordion -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-users" role="tabpanel" aria-labelledby="pills-users-tab"
                    tabindex="0">
                    <div class="d-flex justify-content-between align-items-center mb-4 pt-7 pb-5">
                        <h4 class="m-0 top-heading">Users</h4>

                        <div class="d-flex gap-3 align-items-center">
                            <!-- Filter -->


                            <!-- Search -->
                            <div class="input-group">
                                <input type="text" class="search-box" placeholder="Search user">
                                <span class="input-group-text">
                                    <iconify-icon icon="ic:round-search" width="20"></iconify-icon>
                                </span>
                            </div>
                        </div>
                    </div>


                    <!-- Table -->
                    <div class="table-border bg-white">
                        <div class="table-responsive">
                            <table class="table table-users align-middle m-0">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="d-flex gap-2 align-items-center">Name<div
                                                    class="d-flex flex-column"><iconify-icon icon="iwwa:arrow-up"
                                                        width="12" height="12"
                                                        class="thead-icon"></iconify-icon><iconify-icon
                                                        icon="iwwa:arrow-down" width="12" height="12"
                                                        class="thead-icon"></iconify-icon></div>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="d-flex gap-2 align-items-center">Email<div
                                                    class="d-flex flex-column"><iconify-icon icon="iwwa:arrow-up"
                                                        width="12" height="12"
                                                        class="thead-icon"></iconify-icon><iconify-icon
                                                        icon="iwwa:arrow-down" width="12" height="12"
                                                        class="thead-icon"></iconify-icon></div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>Alice Johnson</td>
                                        <td>alice.j@example.com</td>
                                    </tr>

                                    <tr>
                                        <td>Bob Williams</td>
                                        <td>bob.w@example.com</td>
                                    </tr>
                                    <tr>
                                        <td>Charlie Brown</td>
                                        <td>charlie.b@example.com</td>
                                    </tr>

                                    <tr>
                                        <td>Diana Miller</td>
                                        <td>diana.m@example.com</td>
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
    </script>

@endsection
