@extends('insighthub.layout.app')

@section('title', 'Edit Role')

@section('styles')
    {{-- Add this temporarily to debug --}}
    {{-- 
    @php
        dd([
            'rolePermissions' => $rolePermissions,
            'rolePermissions_type' => gettype($rolePermissions),
            'is_array' => is_array($rolePermissions)
        ]);
    @endphp
    --}}
    
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

        .table-border {
            border-radius: 4px;
            border: 1px solid #ECF0F3;
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

        .is-invalid {
            border-color: #F24130 !important;
        }

        .invalid-feedback {
            color: #9C2418;
            margin-top: 4px;
        }

        .form-control.is-invalid:focus,
        .was-validated .form-control:invalid:focus {
            box-shadow: none;
        }

        .toggle-label {
            font-size: 20px;
            font-weight: 600;
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                    Edit Role
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">Role Management</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">Edit Role</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">
            <div class="page-header my-15 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="top-heading m-0">Edit Role</h4>
                </div>
                @if(!empty($permissions))
                    <button class="custom-btn outline-red" id="collapseAllBtn">
                        Collapse All
                    </button>
                @endif
            </div>

            <form action="{{ route('insighthub.role-management.update', $role->id) }}" method="POST" id="editRoleForm">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Role Name <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           placeholder="Enter role name"
                           value="{{ old('name', $role->display_name ?? $role->name) }}"
                           required>
                    @error('name')
                        <div class="invalid-feedback d-block" style="font-size: 13px;">
                            <iconify-icon icon="fe:warning" width="12" height="12"></iconify-icon> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" 
                              class="form-control @error('description') is-invalid @enderror" 
                              rows="4" 
                              placeholder="Enter description">{{ old('description', $role->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback d-block" style="font-size: 13px;">
                            <iconify-icon icon="fe:warning" width="12" height="12"></iconify-icon> {{ $message }}
                        </div>
                    @enderror
                </div>

                @if(!empty($permissions))
                    <!-- Dynamic Accordion Start -->
                    @foreach ($permissions as $mainIdx => $module)
                        <div class="accordion mb-4" id="mainAccordion{{ $mainIdx }}">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ Str::slug($module['module']) }}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ Str::slug($module['module']) }}" 
                                        aria-expanded="true">
                                        <div class="module-header w-100">
                                            <span class="toggle-label">{{ $module['module'] }}</span>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input parent-toggle" 
                                                       type="checkbox"
                                                       data-module="{{ $mainIdx }}"
                                                       {{ $module['all_checked'] ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                    </button>
                                </h2>

                                <div id="collapse{{ Str::slug($module['module']) }}" 
                                     class="accordion-collapse collapse show"
                                     aria-labelledby="heading{{ Str::slug($module['module']) }}">
                                    <div class="accordion-body p-0">
                                        @foreach ($module['sections'] as $sectionName => $section)
                                            <div class="accordion sub-accordion mb-3"
                                                id="subAccordion{{ Str::slug($module['module']) }}{{ $loop->index }}">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="heading{{ Str::slug($sectionName) }}{{ $mainIdx }}{{ $loop->index }}">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapse{{ Str::slug($sectionName) }}{{ $mainIdx }}{{ $loop->index }}"
                                                            aria-expanded="false">
                                                            <div class="module-header w-100">
                                                                <span class="fs-5">{{ $sectionName }}</span>
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input section-toggle" 
                                                                           type="checkbox"
                                                                           data-module="{{ $mainIdx }}"
                                                                           data-section="{{ $loop->index }}"
                                                                           {{ $section['all_checked'] ? 'checked' : '' }}>
                                                                </div>
                                                            </div>
                                                        </button>
                                                    </h2>

                                                    <div id="collapse{{ Str::slug($sectionName) }}{{ $mainIdx }}{{ $loop->index }}"
                                                        class="accordion-collapse collapse show"
                                                        aria-labelledby="heading{{ Str::slug($sectionName) }}{{ $mainIdx }}{{ $loop->index }}">
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
                                                                            <tr class="permission-row" 
                                                                                data-module="{{ $mainIdx }}" 
                                                                                data-section="{{ $loop->parent->index }}"
                                                                                data-row="{{ $loop->index }}">
                                                                                <td>{{ ucwords(str_replace(['-', '_', '.'], ' ', $permRow['display_name'])) }}</td>
                                                                                <td>
                                                                                    <div class="form-check form-switch">
                                                                                        <input class="form-check-input all-permission" 
                                                                                               type="checkbox"
                                                                                               data-row="{{ $loop->index }}"
                                                                                               @php
                                                                                                   $allChecked = true;
                                                                                                   if ($permRow['view'] && !in_array($permRow['view']->id, $rolePermissions)) $allChecked = false;
                                                                                                   if ($permRow['create'] && !in_array($permRow['create']->id, $rolePermissions)) $allChecked = false;
                                                                                                   if ($permRow['edit'] && !in_array($permRow['edit']->id, $rolePermissions)) $allChecked = false;
                                                                                                   if ($permRow['delete'] && !in_array($permRow['delete']->id, $rolePermissions)) $allChecked = false;
                                                                                               @endphp
                                                                                               {{ $allChecked ? 'checked' : '' }}>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    @if($permRow['view'])
                                                                                        <div class="form-check form-switch">
                                                                                            <input class="form-check-input individual-permission" 
                                                                                                   type="checkbox"
                                                                                                   name="permissions[]" 
                                                                                                   value="{{ $permRow['view']->id }}"
                                                                                                   data-row="{{ $loop->index }}"
                                                                                                   {{ in_array($permRow['view']->id, $rolePermissions) ? 'checked' : '' }}>
                                                                                        </div>
                                                                                    @else
                                                                                        <span class="text-center">-</span>
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if($permRow['create'])
                                                                                        <div class="form-check form-switch">
                                                                                            <input class="form-check-input individual-permission" 
                                                                                                   type="checkbox"
                                                                                                   name="permissions[]" 
                                                                                                   value="{{ $permRow['create']->id }}"
                                                                                                   data-row="{{ $loop->index }}"
                                                                                                   {{ in_array($permRow['create']->id, $rolePermissions) ? 'checked' : '' }}>
                                                                                        </div>
                                                                                    @else
                                                                                        <span class="text-center">-</span>
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if($permRow['edit'])
                                                                                        <div class="form-check form-switch">
                                                                                            <input class="form-check-input individual-permission" 
                                                                                                   type="checkbox"
                                                                                                   name="permissions[]" 
                                                                                                   value="{{ $permRow['edit']->id }}"
                                                                                                   data-row="{{ $loop->index }}"
                                                                                                   {{ in_array($permRow['edit']->id, $rolePermissions) ? 'checked' : '' }}>
                                                                                        </div>
                                                                                    @else
                                                                                        <span class="text-center">-</span>
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if($permRow['delete'])
                                                                                        <div class="form-check form-switch">
                                                                                            <input class="form-check-input individual-permission" 
                                                                                                   type="checkbox"
                                                                                                   name="permissions[]" 
                                                                                                   value="{{ $permRow['delete']->id }}"
                                                                                                   data-row="{{ $loop->index }}"
                                                                                                   {{ in_array($permRow['delete']->id, $rolePermissions) ? 'checked' : '' }}>
                                                                                        </div>
                                                                                    @else
                                                                                        <span class="text-center">-</span>
                                                                                    @endif
                                                                                </td>
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
                    @endforeach
                    <!-- Dynamic Accordion End -->
                @else
                    <div class="alert alert-info">
                        <strong>No Permissions Available</strong><br>
                        There are no permissions available for your current plan.
                    </div>
                @endif

                @error('permissions')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="d-flex justify-content-end gap-3 align-items-center">
                    <a href="{{ route('insighthub.role-management.index') }}" class="custom-btn grey-outline">Cancel</a>
                    <button type="submit" class="custom-btn orange-fill" {{ empty($permissions) ? 'disabled' : '' }}>Update</button>
                </div>
            </form>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        @if(!empty($permissions))
        // Collapse all button functionality
        document.getElementById('collapseAllBtn').addEventListener('click', function() {
            const allCollapses = document.querySelectorAll('.collapse.show');
            allCollapses.forEach(el => {
                const collapse = new bootstrap.Collapse(el, { toggle: false });
                collapse.hide();
            });
            
            // Update button text
            if (this.textContent.trim() === 'Collapse All') {
                this.textContent = 'Expand All';
            } else {
                this.textContent = 'Collapse All';
                // Re-open all collapses
                document.querySelectorAll('.collapse').forEach(el => {
                    const collapse = new bootstrap.Collapse(el, { toggle: false });
                    collapse.show();
                });
            }
        });

        // Helper function to update parent state
        function updateParentState(parentToggle, childToggles) {
            const allChecked = [...childToggles].every(cb => cb.checked);
            parentToggle.checked = allChecked;
        }

        // Parent Module Toggle → All Children
        document.querySelectorAll(".parent-toggle[data-module]").forEach(parentToggle => {
            parentToggle.addEventListener("change", function() {
                const moduleIndex = this.getAttribute('data-module');
                const isChecked = this.checked;
                
                // Toggle all section toggles in this module
                document.querySelectorAll(`.section-toggle[data-module="${moduleIndex}"]`).forEach(sectionToggle => {
                    sectionToggle.checked = isChecked;
                    sectionToggle.dispatchEvent(new Event('change'));
                });
            });
        });

        // Section Toggle → All Permissions in Section
        document.querySelectorAll(".section-toggle").forEach(sectionToggle => {
            sectionToggle.addEventListener("change", function() {
                const moduleIndex = this.getAttribute('data-module');
                const sectionIndex = this.getAttribute('data-section');
                const isChecked = this.checked;
                
                // Toggle all permissions in this section
                document.querySelectorAll(`.permission-row[data-module="${moduleIndex}"][data-section="${sectionIndex}"]`).forEach(row => {
                    const checkboxes = row.querySelectorAll('.individual-permission');
                    checkboxes.forEach(cb => {
                        cb.checked = isChecked;
                        cb.disabled = !isChecked;
                    });
                    
                    // Update "All" checkbox
                    const allCheckbox = row.querySelector('.all-permission');
                    if (allCheckbox) {
                        allCheckbox.checked = isChecked;
                        allCheckbox.disabled = !isChecked;
                    }
                });
            });
        });

        // "All" Permission Toggle (per row)
        document.querySelectorAll('.all-permission').forEach(allCheckbox => {
            allCheckbox.addEventListener('change', function() {
                const row = this.closest('tr');
                const individualCheckboxes = row.querySelectorAll('.individual-permission');
                const isChecked = this.checked;
                
                individualCheckboxes.forEach(checkbox => {
                    if (!checkbox.disabled) {
                        checkbox.checked = isChecked;
                    }
                });
            });
        });

        // Individual Permission Toggle - Update "All" checkbox
        document.querySelectorAll('.individual-permission').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const row = this.closest('tr');
                const allCheckbox = row.querySelector('.all-permission');
                const individualCheckboxes = row.querySelectorAll('.individual-permission:not([disabled])');
                
                // Check if all individual checkboxes are checked
                const allChecked = Array.from(individualCheckboxes).every(cb => cb.checked);
                
                if (allCheckbox) {
                    allCheckbox.checked = allChecked && individualCheckboxes.length > 0;
                }
            });
        });
        @endif

        // Form Validation
        document.getElementById('editRoleForm').addEventListener('submit', function(e) {
            const roleName = document.querySelector('input[name="name"]');
            
            @if(!empty($permissions))
            const permissions = document.querySelectorAll('input[name="permissions[]"]:checked');
            @endif
            
            // Validate role name
            if (!roleName.value.trim()) {
                e.preventDefault();
                alert('Role name is required.');
                return false;
            }
            
            @if(!empty($permissions))
            // Validate at least one permission is selected
            if (permissions.length === 0) {
                e.preventDefault();
                alert('Please select at least one permission for this role.');
                return false;
            }
            @endif
        });
    </script>
@endsection