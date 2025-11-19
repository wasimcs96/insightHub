{{-- Section Partial for Role Management --}}
<div class="sub-accordion mb-3">
    <div class="accordion-item">
        <h3 class="accordion-header" id="headingSection{{ $moduleIndex }}_{{ $loop->index }}">
            <button class="accordion-button collapsed" 
                    type="button"
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapseSection{{ $moduleIndex }}_{{ $loop->index }}"
                    aria-expanded="false">
                <div class="module-header">
                    <span>{{ $sectionName }}</span>
                    <div class="form-check form-switch" onclick="event.stopPropagation();">
                        <input class="form-check-input section-toggle" 
                               type="checkbox"
                               data-module="{{ $moduleIndex }}"
                               data-section="{{ $loop->index }}"
                               {{ $section['enabled'] ?? true ? 'checked' : '' }}>
                    </div>
                </div>
            </button>
        </h3>
        
        <div id="collapseSection{{ $moduleIndex }}_{{ $loop->index }}" 
             class="accordion-collapse collapse">
            <div class="accordion-body p-0 mt-3">
                @if(!empty($section['permissions']))
                    <div class="table-border">
                        <table class="table table-users mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 40%;">Permission</th>
                                    <th class="text-center" style="width: 12%;">All</th>
                                    <th class="text-center" style="width: 12%;">View</th>
                                    <th class="text-center" style="width: 12%;">Create</th>
                                    <th class="text-center" style="width: 12%;">Edit</th>
                                    <th class="text-center" style="width: 12%;">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // Group permissions by their base name (without action suffix)
                                    $groupedPerms = [];
                                    
                                    foreach($section['permissions'] as $permission) {
                                        $name = $permission->name;
                                        $displayName = $permission->display_name ?? $name;
                                        
                                        // Remove module prefix to get base name
                                        $baseName = $name;
                                        
                                        // Detect action type and extract base name
                                        $action = null;
                                        if (str_ends_with($name, '.view') || str_ends_with($name, '-view')) {
                                            $action = 'view';
                                            $baseName = preg_replace('/[.\-]view$/', '', $name);
                                        } elseif (str_ends_with($name, '.create') || str_ends_with($name, '-create')) {
                                            $action = 'create';
                                            $baseName = preg_replace('/[.\-]create$/', '', $name);
                                        } elseif (str_ends_with($name, '.edit') || str_ends_with($name, '-edit')) {
                                            $action = 'edit';
                                            $baseName = preg_replace('/[.\-]edit$/', '', $name);
                                        } elseif (str_ends_with($name, '.delete') || str_ends_with($name, '-delete')) {
                                            $action = 'delete';
                                            $baseName = preg_replace('/[.\-]delete$/', '', $name);
                                        }
                                        
                                        // Initialize group if not exists
                                        if (!isset($groupedPerms[$baseName])) {
                                            $groupedPerms[$baseName] = [
                                                'base_name' => $baseName,
                                                'display_name' => $displayName,
                                                'view' => null,
                                                'create' => null,
                                                'edit' => null,
                                                'delete' => null
                                            ];
                                        }
                                        
                                        // Assign permission to appropriate action
                                        if ($action) {
                                            $groupedPerms[$baseName][$action] = $permission;
                                            // Update display name to remove action suffix
                                            $cleanDisplayName = preg_replace('/[.\-](view|create|edit|delete)$/i', '', $displayName);
                                            $groupedPerms[$baseName]['display_name'] = $cleanDisplayName;
                                        } else {
                                            // If no specific action detected, treat as view
                                            $groupedPerms[$baseName]['view'] = $permission;
                                        }
                                    }
                                @endphp
                                
                                @foreach($groupedPerms as $permKey => $permRow)
                                    <tr class="permission-row" 
                                        data-module="{{ $moduleIndex }}" 
                                        data-section="{{ $loop->parent->index }}"
                                        data-row="{{ $loop->index }}">
                                        <td>
                                            <span class="permission-row-label">
                                                {{ ucwords(str_replace(['-', '_', '.'], ' ', $permRow['display_name'])) }}
                                            </span>
                                        </td>
                                        
                                        <!-- All Checkbox -->
                                        <td class="text-center">
                                            <div class="form-check form-switch d-flex justify-content-center">
                                                <input class="form-check-input all-permission" 
                                                       type="checkbox"
                                                       data-row="{{ $loop->index }}">
                                            </div>
                                        </td>
                                        
                                        <!-- View -->
                                        <td class="text-center">
                                            @if($permRow['view'])
                                                <div class="form-check form-switch d-flex justify-content-center">
                                                    <input class="form-check-input individual-permission view-permission" 
                                                           type="checkbox"
                                                           name="permissions[]" 
                                                           value="{{ $permRow['view']->id }}"
                                                           data-row="{{ $loop->index }}"
                                                           {{ isset($rolePermissions) && in_array($permRow['view']->id, $rolePermissions ?? []) ? 'checked' : '' }}
                                                           {{ in_array($permRow['view']->id, old('permissions', [])) ? 'checked' : '' }}>
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        
                                        <!-- Create -->
                                        <td class="text-center">
                                            @if($permRow['create'])
                                                <div class="form-check form-switch d-flex justify-content-center">
                                                    <input class="form-check-input individual-permission create-permission" 
                                                           type="checkbox"
                                                           name="permissions[]" 
                                                           value="{{ $permRow['create']->id }}"
                                                           data-row="{{ $loop->index }}"
                                                           {{ isset($rolePermissions) && in_array($permRow['create']->id, $rolePermissions ?? []) ? 'checked' : '' }}
                                                           {{ in_array($permRow['create']->id, old('permissions', [])) ? 'checked' : '' }}>
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        
                                        <!-- Edit -->
                                        <td class="text-center">
                                            @if($permRow['edit'])
                                                <div class="form-check form-switch d-flex justify-content-center">
                                                    <input class="form-check-input individual-permission edit-permission" 
                                                           type="checkbox"
                                                           name="permissions[]" 
                                                           value="{{ $permRow['edit']->id }}"
                                                           data-row="{{ $loop->index }}"
                                                           {{ isset($rolePermissions) && in_array($permRow['edit']->id, $rolePermissions ?? []) ? 'checked' : '' }}
                                                           {{ in_array($permRow['edit']->id, old('permissions', [])) ? 'checked' : '' }}>
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        
                                        <!-- Delete -->
                                        <td class="text-center">
                                            @if($permRow['delete'])
                                                <div class="form-check form-switch d-flex justify-content-center">
                                                    <input class="form-check-input individual-permission delete-permission" 
                                                           type="checkbox"
                                                           name="permissions[]" 
                                                           value="{{ $permRow['delete']->id }}"
                                                           data-row="{{ $loop->index }}"
                                                           {{ isset($rolePermissions) && in_array($permRow['delete']->id, $rolePermissions ?? []) ? 'checked' : '' }}
                                                           {{ in_array($permRow['delete']->id, old('permissions', [])) ? 'checked' : '' }}>
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4 text-muted">
                        <iconify-icon icon="mdi:information-outline" width="24" height="24"></iconify-icon>
                        <p class="mb-0 mt-2">No permissions available in this section</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>