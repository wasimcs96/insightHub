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

        .search-box {
            border: 1px solid #C8CFD9;
            border-radius: 8px;
            padding: 8px 14px;
            width: 250px;
        }

        input:focus-visible {
            outline: none;
        }

        .thead-icon {
            color: #C8CFD9;
        }

        .thead-icon:hover,
        .thead-icon:active {
            color: #F7941C;
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
                    <li class="breadcrumb-item text-muted">Role Management</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">View Permissions</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">
            <div class="page-header my-15 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="top-heading m-0">{{ $role->display_name ?? $role->name }}</h4>
                    <p class="custom-text-muted m-0">{{ $role->description ?? 'No description available' }}</p>
                </div>
                @if(!empty($permissions))
                    <button class="custom-btn outline-red" id="collapseAllBtn">
                        Collapse All
                    </button>
                @endif
            </div>

            <!-- Tab Navigation -->
            <ul class="permission-tabs nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-permissions-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-permissions" type="button" role="tab" aria-controls="pills-permissions"
                        aria-selected="true">Permissions</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-users-tab" data-bs-toggle="pill" data-bs-target="#pills-users"
                        type="button" role="tab" aria-controls="pills-users" aria-selected="false">
                        Users 
                        <span class="user-number">{{ $role->users_count ?? 0 }}</span>
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="pills-tabContent">
                <!-- Permissions Tab -->
                <div class="tab-pane fade show active" id="pills-permissions" role="tabpanel"
                    aria-labelledby="pills-permissions-tab" tabindex="0">

                    @if(!empty($permissions))
                        <!-- Dynamic Accordion for Permissions -->
                        <div class="accordion" id="permissionsAccordion">
                            @foreach ($permissions as $mainIdx => $module)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ Str::slug($module['module']) }}">
                                        <button class="accordion-button {{ $mainIdx > 0 ? 'collapsed' : '' }}" 
                                                type="button" 
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ Str::slug($module['module']) }}" 
                                                aria-expanded="{{ $mainIdx === 0 ? 'true' : 'false' }}"
                                                aria-controls="collapse{{ Str::slug($module['module']) }}">
                                            {{ $module['module'] }}
                                        </button>
                                    </h2>

                                    <div id="collapse{{ Str::slug($module['module']) }}" 
                                         class="accordion-collapse collapse {{ $mainIdx === 0 ? 'show' : '' }}"
                                         aria-labelledby="heading{{ Str::slug($module['module']) }}"
                                         data-bs-parent="#permissionsAccordion">
                                        <div class="accordion-body">
                                            @if(!empty($module['sections']))
                                                <!-- Sub Accordion for Sections -->
                                                <div class="accordion" id="subAccordion{{ Str::slug($module['module']) }}">
                                                    @foreach ($module['sections'] as $sectionName => $section)
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="heading{{ Str::slug($sectionName) }}{{ $mainIdx }}">
                                                                <button class="accordion-button collapsed fs-5" 
                                                                        type="button"
                                                                        data-bs-toggle="collapse" 
                                                                        data-bs-target="#collapse{{ Str::slug($sectionName) }}{{ $mainIdx }}"
                                                                        aria-expanded="false" 
                                                                        aria-controls="collapse{{ Str::slug($sectionName) }}{{ $mainIdx }}">
                                                                    {{ $sectionName }}
                                                                </button>
                                                            </h2>
                                                            <div id="collapse{{ Str::slug($sectionName) }}{{ $mainIdx }}" 
                                                                 class="accordion-collapse collapse"
                                                                 aria-labelledby="heading{{ Str::slug($sectionName) }}{{ $mainIdx }}"
                                                                 data-bs-parent="#subAccordion{{ Str::slug($module['module']) }}">
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
                                                                            @php
                                                                                // Group permissions by their base name
                                                                                $groupedPerms = [];
                                                                                
                                                                                foreach($section['permissions'] as $permission) {
                                                                                    $name = $permission->name;
                                                                                    $displayName = $permission->display_name ?? $name;
                                                                                    
                                                                                    // Remove action suffix to get base name
                                                                                    $baseName = preg_replace('/[.\-](view|create|edit|delete)$/', '', $name);
                                                                                    
                                                                                    // Initialize group if not exists
                                                                                    if (!isset($groupedPerms[$baseName])) {
                                                                                        $groupedPerms[$baseName] = [
                                                                                            'base_name' => $baseName,
                                                                                            'display_name' => preg_replace('/[.\-](view|create|edit|delete)$/i', '', $displayName),
                                                                                            'view' => null,
                                                                                            'create' => null,
                                                                                            'edit' => null,
                                                                                            'delete' => null
                                                                                        ];
                                                                                    }
                                                                                    
                                                                                    // Assign permission to appropriate action
                                                                                    if (str_ends_with($name, '.view') || str_ends_with($name, '-view')) {
                                                                                        $groupedPerms[$baseName]['view'] = $permission;
                                                                                    } elseif (str_ends_with($name, '.create') || str_ends_with($name, '-create')) {
                                                                                        $groupedPerms[$baseName]['create'] = $permission;
                                                                                    } elseif (str_ends_with($name, '.edit') || str_ends_with($name, '-edit')) {
                                                                                        $groupedPerms[$baseName]['edit'] = $permission;
                                                                                    } elseif (str_ends_with($name, '.delete') || str_ends_with($name, '-delete')) {
                                                                                        $groupedPerms[$baseName]['delete'] = $permission;
                                                                                    } else {
                                                                                        // If no specific action, treat as view
                                                                                        $groupedPerms[$baseName]['view'] = $permission;
                                                                                    }
                                                                                }
                                                                            @endphp
                                                                            
                                                                            @foreach($groupedPerms as $permRow)
                                                                                <tr>
                                                                                    <td>{{ ucwords(str_replace(['-', '_', '.'], ' ', $permRow['display_name'])) }}</td>
                                                                                    <td class="text-center">
                                                                                        @if($permRow['view'])
                                                                                            @if(in_array($permRow['view']->id, $rolePermissions))
                                                                                                <iconify-icon icon="material-symbols:check-rounded" class="check-icon" width="16" height="16"></iconify-icon>
                                                                                            @else
                                                                                                <iconify-icon icon="maki:cross" class="cross-icon" width="16" height="16"></iconify-icon>
                                                                                            @endif
                                                                                        @else
                                                                                            <span>-</span>
                                                                                        @endif
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        @if($permRow['create'])
                                                                                            @if(in_array($permRow['create']->id, $rolePermissions))
                                                                                                <iconify-icon icon="material-symbols:check-rounded" class="check-icon" width="16" height="16"></iconify-icon>
                                                                                            @else
                                                                                                <iconify-icon icon="maki:cross" class="cross-icon" width="16" height="16"></iconify-icon>
                                                                                            @endif
                                                                                        @else
                                                                                            <span>-</span>
                                                                                        @endif
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        @if($permRow['edit'])
                                                                                            @if(in_array($permRow['edit']->id, $rolePermissions))
                                                                                                <iconify-icon icon="material-symbols:check-rounded" class="check-icon" width="16" height="16"></iconify-icon>
                                                                                            @else
                                                                                                <iconify-icon icon="maki:cross" class="cross-icon" width="16" height="16"></iconify-icon>
                                                                                            @endif
                                                                                        @else
                                                                                            <span>-</span>
                                                                                        @endif
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        @if($permRow['delete'])
                                                                                            @if(in_array($permRow['delete']->id, $rolePermissions))
                                                                                                <iconify-icon icon="material-symbols:check-rounded" class="check-icon" width="16" height="16"></iconify-icon>
                                                                                            @else
                                                                                                <iconify-icon icon="maki:cross" class="cross-icon" width="16" height="16"></iconify-icon>
                                                                                            @endif
                                                                                        @else
                                                                                            <span>-</span>
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">
                            <strong>No Permissions Available</strong><br>
                            There are no permissions assigned to this role.
                        </div>
                    @endif
                </div>

                <!-- Users Tab -->
                <div class="tab-pane fade" id="pills-users" role="tabpanel" aria-labelledby="pills-users-tab" tabindex="0">
                    <div class="d-flex justify-content-between align-items-center mb-4 pt-7 pb-5">
                        <h4 class="m-0 top-heading">Users</h4>

                        <div class="d-flex gap-3 align-items-center">
                            <!-- Search -->
                            <div class="input-group">
                                <input type="text" class="search-box" placeholder="Search user" id="userSearch">
                                <span class="input-group-text">
                                    <iconify-icon icon="ic:round-search" width="20"></iconify-icon>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Users Table -->
                    <div class="table-border bg-white">
                        <div class="table-responsive">
                            <table class="table table-users align-middle m-0">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="d-flex gap-2 align-items-center">
                                                Name
                                                <div class="d-flex flex-column">
                                                    <iconify-icon icon="iwwa:arrow-up" width="12" height="12" class="thead-icon"></iconify-icon>
                                                    <iconify-icon icon="iwwa:arrow-down" width="12" height="12" class="thead-icon"></iconify-icon>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="d-flex gap-2 align-items-center">
                                                Email
                                                <div class="d-flex flex-column">
                                                    <iconify-icon icon="iwwa:arrow-up" width="12" height="12" class="thead-icon"></iconify-icon>
                                                    <iconify-icon icon="iwwa:arrow-down" width="12" height="12" class="thead-icon"></iconify-icon>
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead> 

                                <tbody id="usersTableBody">
                                    @if($role->users->count() > 0)
                                        @foreach($role->users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="2" class="text-center py-5">
                                                <p class="custom-text-muted mb-0">No users assigned to this role yet.</p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        @if($role->users->count() > 0)
                            <!-- Pagination + Results -->
                            <div class="d-flex justify-content-between align-items-center mx-5 my-4">
                                <div class="d-flex gap-5 align-items-center">
                                    <div class="d-flex align-items-center gap-2">
                                        <label class="custom-text-muted mb-0" style="color: #2E2F38;">Result per page</label>
                                        <select class="results-select">
                                            <option selected>10</option>
                                            <option>25</option>
                                            <option>50</option>
                                        </select>
                                    </div>

                                    <p class="mb-0 custom-text-muted">Showing {{ $role->users->count() }} user(s)</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        @if(!empty($permissions))
        // Collapse all button functionality
        document.getElementById('collapseAllBtn').addEventListener('click', function() {
            const allCollapses = document.querySelectorAll('.collapse.show');
            
            if (allCollapses.length > 0) {
                // Collapse all
                allCollapses.forEach(el => {
                    const collapse = new bootstrap.Collapse(el, { toggle: false });
                    collapse.hide();
                });
                this.textContent = 'Expand All';
            } else {
                // Expand all
                document.querySelectorAll('.collapse').forEach(el => {
                    const collapse = new bootstrap.Collapse(el, { toggle: false });
                    collapse.show();
                });
                this.textContent = 'Collapse All';
            }
        });
        @endif

        // User search functionality (client-side)
        document.getElementById('userSearch')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const tableRows = document.querySelectorAll('#usersTableBody tr');
            
            tableRows.forEach(row => {
                const name = row.cells[0]?.textContent.toLowerCase() || '';
                const email = row.cells[1]?.textContent.toLowerCase() || '';
                
                if (name.includes(searchTerm) || email.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection