@extends('insighthub.layout.app')

@section('title', 'Business Unit')

@section('styles')
    @include('InsightHub.settings.general-settings.organization-structure.partials.styles')
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">Organization Structure</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('hubcenter.dashboard') }}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Settings</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">General Settings</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Organization Structure</li>
                </ul>
            </div>
        </div>
    </div>

    @if(session('successs'))
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div id="feedbackMessage" class="justify-content-between align-items-center feedback-message mt-3 mb-3">
                <p class="text-center fw-medium m-0"><b>Success!</b> {{ session('successs') }}</p>
                <iconify-icon icon="iconamoon:close" width="20" height="20" class="cursor-pointer"
                    onclick="document.getElementById('feedbackMessage').style.display='none'"></iconify-icon>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3" role="alert">
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3" role="alert">
                <strong>Validation Error!</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif

    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
        <div id="kt_app_content_container" class="container-xxl app-container">
            @include('insighthub.settings.index')

            <div class="tab-content">
                <div class="tab-pane fade show active" id="structure" role="tabpanel">
                    <div class="settings-card">
                        {{-- Tab Navigation --}}
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <ul class="nav nav-pills sub-tab" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" href="{{ route('organization-structure.business-units') }}">
                                        Business Unit
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="{{ route('organization-structure.divisions') }}">
                                        Companies/Division
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="{{ route('organization-structure.departments') }}">
                                        Departments
                                    </a>
                                </li>
                            </ul>

                            <div class="d-flex gap-3 align-items-center">
                                <div class="input-group position-relative">
                                        <input type="text" id="searchBox" class="search-box" placeholder="Search business unit">
                                        <button type="button" id="clearSearchBtn" class="btn btn-sm position-absolute" 
                                            style="right: 45px; top: 50%; transform: translateY(-50%); z-index: 10; display: none; border: none; background: transparent; padding: 0 5px;">
                                            <iconify-icon icon="carbon:close-filled" width="18" height="18" style="color: #999;"></iconify-icon>
                                        </button>
                                        <button type="button" id="searchBtn" class="input-group-text" aria-label="Search">
                                            <iconify-icon icon="ic:round-search" width="20"></iconify-icon>
                                        </button>
                                    </div>
                            </div>
                        </div>

                        {{-- Business Unit Content --}}
                        <div class="d-flex align-items-center justify-content-between my-8">
                            <h4 class="m-0 top-heading text-start">Manage Business Units</h4>
                            <button class="custom-btn orange-fill" data-bs-toggle="modal" data-bs-target="#AddBusinessUnit">
                                <span class="me-2 d-flex align-items-center">
                                    <iconify-icon icon="ic:round-plus" width="20" height="20"></iconify-icon>
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
                                                <div class="d-flex gap-2 align-items-center">Business Unit Name</div>
                                            </th>
                                            <th>
                                                <div class="d-flex gap-2 align-items-center">No of employees</div>
                                            </th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="businessUnitsTbody">
                                        <tr>
                                            <td colspan="3" class="text-center py-5">Loading business units...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mx-5 my-4">
                                <div class="d-flex gap-5 align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                        <label class="custom-text-muted mb-0" style="color: #2E2F38;">Result per page</label>
                                        <select id="resultsPerPageSelect" class="results-select">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                    <p id="resultsSummary" class="mb-0 custom-text-muted">&nbsp;</p>
                                </div>
                                <nav>
                                    <ul id="paginationContainer" class="pagination mb-0"></ul>
                                </nav>
                            </div>
                        </div>
                        {{-- <div class="empty-state">

                            <div class="empty-icon mb-5">
                                <iconify-icon icon="mage:file-2" width="20" height="20"></iconify-icon>
                            </div>

                            <h5 class="m-0">No Results Found</h5>

                            <p class="custom-text-muted mx-auto" style="max-width: 500px;">
                                Try adjusting your search or using different keywords.
                            </p>
                        </div> --}}
                    </div>
                </div>
            </div>

            {{-- Add Business Unit Modal --}}
            <div class="modal fade" id="AddBusinessUnit" tabindex="-1" aria-labelledby="AddBusinessUnitLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('organization-structure.business-units.store') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold" id="AddBusinessUnitLabel">Add Business Unit</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Business Unit Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="addBusinessUnitName" name="name" class="form-control" placeholder="Enter business unit name" required>
                                    <div id="addNameValidation" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-end gap-2">
                                <button type="button" class="custom-btn grey-outline" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" id="addBusinessUnitBtn" class="custom-btn orange-fill">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Edit Business Unit Modal --}}
            <div class="modal fade" id="EditBusinessUnit" tabindex="-1" aria-labelledby="EditBusinessUnitLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="editBusinessUnitForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold" id="EditBusinessUnitLabel">Edit Business Unit</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Business Unit Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="editBusinessUnitName" name="name" class="form-control" placeholder="Enter business unit name" required>
                                    <div id="editNameValidation" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-end gap-2">
                                <button type="button" class="custom-btn grey-outline" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" id="updateBusinessUnitBtn" class="custom-btn orange-fill">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Delete Business Unit Modal --}}
            <div class="modal fade" id="DeleteBusinessUnit" tabindex="-1" aria-hidden="true">
                {{-- <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content delete-modal">
                        <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                            <iconify-icon icon="iconamoon:close"></iconify-icon>
                        </button>
                        <div class="modal-body">
                            <div class="d-flex justify-content-center mb-3">
                                <div class="warning-icon">
                                    <iconify-icon icon="ph:warning-bold"></iconify-icon>
                                </div>
                            </div>
                            <h5>Delete Business Unit</h5>
                            <p id="deleteConfirmText">Are you sure you want to delete this business unit?</p>
                            <div class="d-flex gap-2 justify-content-center">
                                <button type="button" class="modal-custom-btn modal-cancel-btn" data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <form id="deleteBusinessUnitForm" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="modal-custom-btn modal-confirm-btn">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}
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
                        <p id="deleteConfirmText">
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

                        <!-- Hidden form used to perform server-side DELETE (submitted when Confirm clicked) -->
                        <form id="deleteBusinessUnitForm" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>

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
            // Store all business units for validation
            let allBusinessUnits = [];
            
            // --- Add Modal validation ---
            const addModal = document.getElementById('AddBusinessUnit');
            const addForm = addModal ? addModal.querySelector('form') : null;
            const addInput = document.getElementById('addBusinessUnitName');
            const addValidation = document.getElementById('addNameValidation');
            const addBtn = document.getElementById('addBusinessUnitBtn');
            let currentEditingId = null;

            // No real-time validation - only validate on button click
            
            // Clear validation errors when user types (provides better UX)
            if (addInput) {
                addInput.addEventListener('input', function() {
                    if (addInput.classList.contains('is-invalid')) {
                        addInput.classList.remove('is-invalid');
                        if (addValidation) {
                            addValidation.classList.remove('d-block');
                            addValidation.textContent = '';
                        }
                        if (addBtn) addBtn.disabled = false;
                    }
                });
            }

            // Reset add form when modal opens
            if (addModal) {
                addModal.addEventListener('show.bs.modal', function() {
                    if (addForm) addForm.reset();
                    if (addInput) addInput.classList.remove('is-invalid');
                    if (addValidation) {
                        addValidation.classList.remove('d-block');
                        addValidation.textContent = '';
                    }
                    if (addBtn) addBtn.disabled = false;
                });
            }

            // Prevent form submission if validation fails
            if (addForm) {
                addForm.addEventListener('submit', function(e) {
                    e.preventDefault(); // Always prevent default, we'll validate via API first
                    
                    const name = addInput ? addInput.value.trim() : '';
                    
                    if (name === '') {
                        addInput.classList.add('is-invalid');
                        if (addValidation) {
                            addValidation.textContent = 'Business unit name is required.';
                            addValidation.classList.add('d-block');
                        }
                        return false;
                    }
                    
                    // Check via API before submitting
                    const checkUrl = `${apiBaseUrl}/insighthub/settings/general-settings/organization-structure/business-units/check-duplicate`;
                    
                    // Disable button while checking
                    if (addBtn) addBtn.disabled = true;
                    
                    fetch(checkUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ name: name })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.exists) {
                            // Show duplicate error
                            addInput.classList.add('is-invalid');
                            if (addValidation) {
                                addValidation.textContent = 'This business unit name already exists for your organization.';
                                addValidation.classList.add('d-block');
                            }
                            if (addBtn) addBtn.disabled = false;
                        } else {
                            // No duplicate, submit the form
                            addForm.submit();
                        }
                    })
                    .catch(err => {
                        console.error('Error checking duplicate:', err);
                        // On error, allow form submission (server will validate)
                        addForm.submit();
                    });
                    
                    return false;
                });
            }

            // --- Edit Modal wiring (uses existing modal & form in the template) ---
            const editModal = document.getElementById('EditBusinessUnit');
            const editForm = document.getElementById('editBusinessUnitForm');
            const editInput = document.getElementById('editBusinessUnitName');
            const editValidation = document.getElementById('editNameValidation');
            const updateBtn = document.getElementById('updateBusinessUnitBtn');

            // Clear validation errors when user types in edit modal
            if (editInput) {
                editInput.addEventListener('input', function() {
                    if (editInput.classList.contains('is-invalid')) {
                        editInput.classList.remove('is-invalid');
                        if (editValidation) {
                            editValidation.classList.remove('d-block');
                            editValidation.textContent = '';
                        }
                        if (updateBtn) updateBtn.disabled = false;
                    }
                });
            }

            if (editModal) {
                editModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const id = button.getAttribute('data-id');
                    const name = button.getAttribute('data-name');

                    currentEditingId = parseInt(id);
                    editInput.value = name;
                    editForm.action = "{{ route('organization-structure.business-units.update', ':id') }}".replace(':id', id);
                    
                    // Reset validation
                    if (editInput) editInput.classList.remove('is-invalid');
                    if (editValidation) {
                        editValidation.classList.remove('d-block');
                        editValidation.textContent = '';
                    }
                    if (updateBtn) updateBtn.disabled = false;
                });
            }

            // Prevent edit form submission if validation fails
            if (editForm) {
                editForm.addEventListener('submit', function(e) {
                    e.preventDefault(); // Always prevent default, we'll validate via API first
                    
                    const name = editInput ? editInput.value.trim() : '';
                    
                    if (name === '') {
                        editInput.classList.add('is-invalid');
                        if (editValidation) {
                            editValidation.textContent = 'Business unit name is required.';
                            editValidation.classList.add('d-block');
                        }
                        return false;
                    }
                    
                    // Check via API before submitting
                    const checkUrl = `${apiBaseUrl}/insighthub/settings/general-settings/organization-structure/business-units/check-duplicate`;
                    
                    // Disable button while checking
                    if (updateBtn) updateBtn.disabled = true;
                    
                    fetch(checkUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ 
                            name: name,
                            exclude_id: currentEditingId 
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.exists) {
                            // Show duplicate error
                            editInput.classList.add('is-invalid');
                            if (editValidation) {
                                editValidation.textContent = 'This business unit name already exists for your organization.';
                                editValidation.classList.add('d-block');
                            }
                            if (updateBtn) updateBtn.disabled = false;
                        } else {
                            // No duplicate, submit the form
                            editForm.submit();
                        }
                    })
                    .catch(err => {
                        console.error('Error checking duplicate:', err);
                        // On error, allow form submission (server will validate)
                        editForm.submit();
                    });
                    
                    return false;
                });
            }

            // --- Delete Modal wiring ---
            const deleteModal = document.getElementById('DeleteBusinessUnit');
            const deleteForm = document.getElementById('deleteBusinessUnitForm');
            const deleteText = document.getElementById('deleteConfirmText');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

            if (deleteModal) {
                deleteModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const id = button.getAttribute('data-id');
                    const name = button.getAttribute('data-name');

                    if (deleteText) {
                        deleteText.innerHTML = `You’re about to delete <strong>${name}</strong> from the system. This action can’t be undone. Are you sure you want to proceed?`;
                    }

                    if (deleteForm) {
                        deleteForm.action = "{{ route('organization-structure.business-units.destroy', ':id') }}".replace(':id', id);
                    }
                });

                // When confirm is clicked, submit the hidden form
                if (confirmDeleteBtn && deleteForm) {
                    confirmDeleteBtn.addEventListener('click', function() {
                        deleteForm.submit();
                    });
                }
            }

            // --- Fetch business units from external API and render table rows with pagination ---
            // const apiUrl = 'http://127.0.0.1:8000/rest/v1/business-units';
            const apiBaseUrl = "{{ env('APP_URL') }}";
            const apiUrl = `${apiBaseUrl}/insighthub/settings/general-settings/organization-structure/business-units/getData`;
            const tbody = document.getElementById('businessUnitsTbody');
            const resultsPerPageSelect = document.getElementById('resultsPerPageSelect');
            const resultsSummary = document.getElementById('resultsSummary');
            const paginationContainer = document.getElementById('paginationContainer');
            const searchBox = document.getElementById('searchBox');
            const searchBtn = document.getElementById('searchBtn');
            const clearSearchBtn = document.getElementById('clearSearchBtn');

            let currentPage = 1;
            let perPage = parseInt(resultsPerPageSelect ? resultsPerPageSelect.value : '10', 10) || 10;
            let currentSearch = '';

            // Toggle clear button visibility based on search box value
            function toggleClearButton() {
                if (clearSearchBtn && searchBox) {
                    if (searchBox.value.trim() !== '') {
                        clearSearchBtn.style.display = 'block';
                    } else {
                        clearSearchBtn.style.display = 'none';
                    }
                }
            }

            // simple debounce helper
            function debounce(fn, wait) {
                let t = null;
                return function(...args) {
                    clearTimeout(t);
                    t = setTimeout(() => fn.apply(this, args), wait);
                };
            }

            function renderRows(units) {
                if (!tbody) return;
                if (!Array.isArray(units) || units.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="3" class="text-center py-5">
                                <div class="empty-state">
                                    <div class="empty-icon mb-5">
                                        <iconify-icon icon="mage:file-2" width="20" height="20"></iconify-icon>
                                    </div>
                                    <h5 class="m-0">No Results Found</h5>
                                    <p class="custom-text-muted mx-auto" style="max-width: 500px;">No business units available. Click "Add Business Unit" to create one.</p>
                                </div>
                            </td>
                        </tr>
                    `;
                    return;
                }

                // Build rows; employee count is static (0) as requested
                const rows = units.map(unit => {
                    const id = unit.id;
                    const name = (unit.name || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                    const count = unit.employee_count;
                    return `
                        <tr>
                            <td>${name}</td>
                            <td>${count}</td>
                            <td class="text-center action-icons">
                                <iconify-icon icon="lucide:edit" width="16" height="16" class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#EditBusinessUnit" data-id="${id}" data-name="${name}"></iconify-icon>
                                ${unit.can_delete 
                                ? `<iconify-icon icon="gg:trash" width="20" height="20" class="ms-7 cursor-pointer" style="color: #F24130;" data-bs-toggle="modal" data-bs-target="#DeleteBusinessUnit" data-id="${id}" data-name="${name}"></iconify-icon>`
                                : `<iconify-icon icon="gg:trash" width="20" height="20"
                                class="ms-7 cursor-default" style="color: #99A1B7;"
                                title="Cannot delete: has related records"></iconify-icon>`
                                }
                            </td>
                        </tr>
                    `;
                }).join('');

                tbody.innerHTML = rows;
            }

            function updateResultsSummary(pagination) {
                if (!resultsSummary || !pagination) return;
                const total = pagination.total || 0;
                const per_page = pagination.per_page || perPage;
                const current = pagination.current_page || currentPage;
                const start = total === 0 ? 0 : (per_page * (current - 1)) + 1;
                const end = Math.min(total, per_page * current);
                resultsSummary.textContent = `${start}-${end} of ${total}`;
            }

            function renderPagination(pagination) {
                if (!paginationContainer) return;
                const total = pagination.total || 0;
                const last = pagination.last_page || 1;
                const current = pagination.current_page || 1;

                // Clear
                paginationContainer.innerHTML = '';

                // Helper to create li
                function makeLi(label, disabled, active, page) {
                    const li = document.createElement('li');
                    li.className = 'page-item' + (disabled ? ' disabled' : '') + (active ? ' active' : '');
                    if (disabled) {
                        const span = document.createElement('span');
                        span.className = 'page-link';
                        span.textContent = label;
                        li.appendChild(span);
                    } else {
                        const btn = document.createElement('button');
                        btn.className = 'page-link';
                        btn.textContent = label;
                        btn.addEventListener('click', function() {
                            fetchPage(page || 1, perPage);
                        });
                        li.appendChild(btn);
                    }
                    return li;
                }

                // Prev
                paginationContainer.appendChild(makeLi('<', current === 1, false, current - 1));

                // page window (up to 5 pages centered)
                let start = Math.max(1, current - 2);
                let end = Math.min(last, start + 4);
                if (end - start < 4) {
                    start = Math.max(1, end - 4);
                }

                if (start > 1) {
                    paginationContainer.appendChild(makeLi('1', false, false, 1));
                    if (start > 2) {
                        const ell = document.createElement('li');
                        ell.className = 'page-item disabled';
                        const span = document.createElement('span');
                        span.className = 'page-link';
                        span.textContent = '...';
                        ell.appendChild(span);
                        paginationContainer.appendChild(ell);
                    }
                }

                for (let p = start; p <= end; p++) {
                    paginationContainer.appendChild(makeLi(String(p), false, p === current, p));
                }

                if (end < last) {
                    if (end < last - 1) {
                        const ell = document.createElement('li');
                        ell.className = 'page-item disabled';
                        const span = document.createElement('span');
                        span.className = 'page-link';
                        span.textContent = '...';
                        ell.appendChild(span);
                        paginationContainer.appendChild(ell);
                    }
                    paginationContainer.appendChild(makeLi(String(last), false, false, last));
                }

                // Next
                paginationContainer.appendChild(makeLi('>', current === last, false, current + 1));
            }

            function fetchPage(page = 1, per_page = perPage) {
                currentPage = page;
                perPage = per_page;

                const url = new URL(apiUrl);
                // If user is searching, request more items from API (so we can filter client-side)
                const fetchPerPage = (currentSearch && currentSearch.trim() !== '') ? 1000 : perPage;
                url.searchParams.set('per_page', fetchPerPage);
                url.searchParams.set('page', currentPage);
                // Also send the search param in case API supports it
                if (currentSearch && currentSearch.trim() !== '') {
                    url.searchParams.set('search', currentSearch.trim());
                }

                // show loading row
                if (tbody) {
                    tbody.innerHTML = `<tr><td colspan="3" class="text-center py-5">Loading business units...</td></tr>`;
                }

                fetch(url.toString(), {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(json => {
                    if (json && json.status === 'success' && Array.isArray(json.data)) {
                        // Store all business units for validation
                        allBusinessUnits = json.data;
                        
                        // If user has entered a search term, perform a client-side filter as a fallback
                        // in case the API doesn't support server-side searching.
                        let units = json.data;
                        if (currentSearch && currentSearch.trim() !== '') {
                            const term = currentSearch.trim().toLowerCase();
                            units = units.filter(u => (u.name || '').toLowerCase().includes(term));

                            // Render filtered results (no server-side pagination for the filtered set)
                            renderRows(units);
                            const paginationData = { total: units.length, per_page: perPage, current_page: 1, last_page: 1 };
                            updateResultsSummary(paginationData);
                            renderPagination(paginationData);
                        } else {
                            renderRows(units);
                            const pagination = (json.meta && json.meta.pagination) ? json.meta.pagination : { total: units.length, per_page: perPage, current_page: currentPage, last_page: 1 };
                            updateResultsSummary(pagination);
                            renderPagination(pagination);
                        }

                        // If requested, smooth-scroll to the table area so user sees results
                        try {
                            if (shouldScrollToResults && tbody) {
                                const tableArea = tbody.closest('.table-border') || tbody;
                                tableArea.scrollIntoView({ behavior: 'smooth', block: 'start' });
                                shouldScrollToResults = false;
                            }
                        } catch (err) {
                            // ignore scroll errors
                        }
                    } else {
                        renderRows([]);
                        updateResultsSummary({ total: 0, per_page: perPage, current_page: 1, last_page: 1 });
                        renderPagination({ total: 0, per_page: perPage, current_page: 1, last_page: 1 });
                    }
                })
                .catch(err => {
                    console.error('Failed to fetch business units:', err);
                    renderRows([]);
                    updateResultsSummary({ total: 0, per_page: perPage, current_page: 1, last_page: 1 });
                    renderPagination({ total: 0, per_page: perPage, current_page: 1, last_page: 1 });
                });
            }

            // flag to indicate whether we should scroll to results after fetch
            let shouldScrollToResults = false;

            // init
            fetchPage(currentPage, perPage);

            // Results per page change
            if (resultsPerPageSelect) {
                resultsPerPageSelect.value = String(perPage);
                resultsPerPageSelect.addEventListener('change', function() {
                    const val = parseInt(this.value, 10) || 10;
                    fetchPage(1, val);
                });
            }

            // Search handling (debounced input only updates the search term now)
            // Searching will occur only when the user clicks the search button or presses Enter.
            if (searchBox) {
                const onSearch = debounce(function(e) {
                    // only update the currentSearch value; do NOT trigger fetch here
                    currentSearch = e.target.value || '';
                    toggleClearButton(); // Show/hide clear button
                }, 300);

                searchBox.addEventListener('input', onSearch);
                
                // Show/hide clear button on input
                searchBox.addEventListener('input', function() {
                    toggleClearButton();
                });
                
                // Enter key triggers immediate search and scroll
                searchBox.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        currentSearch = e.target.value || '';
                        shouldScrollToResults = true;
                        fetchPage(1, perPage);
                    }
                });
            }

            // Clear search button click handler
            if (clearSearchBtn) {
                clearSearchBtn.addEventListener('click', function() {
                    if (searchBox) {
                        searchBox.value = '';
                        currentSearch = '';
                        toggleClearButton();
                        shouldScrollToResults = false;
                        fetchPage(1, perPage); // Reload data without search
                    }
                });
            }

            // Search button click triggers immediate search and scroll
            if (searchBtn) {
                searchBtn.addEventListener('click', function() {
                    if (searchBox) {
                        currentSearch = searchBox.value || '';
                    }
                    shouldScrollToResults = true;
                    fetchPage(1, perPage);
                });
            }
        });
    </script>
@endsection
