@extends('insighthub.layout.app')

@section('title', 'Departments')

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

    @if(session('success'))
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div id="feedbackMessage" class="justify-content-between align-items-center feedback-message mt-3 mb-3">
                <p class="text-center fw-medium m-0"><b>Success!</b> {{ session('success') }}</p>
                <iconify-icon icon="iconamoon:close" width="20" height="20" class="cursor-pointer"
                    onclick="document.getElementById('feedbackMessage').style.display='none'"></iconify-icon>
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
                                    <a class="nav-link" href="{{ route('organization-structure.business-units') }}">
                                        Business Unit
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="{{ route('organization-structure.divisions') }}">
                                        Companies/Division
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" href="{{ route('organization-structure.departments') }}">
                                        Departments
                                    </a>
                                </li>
                            </ul>

                            <div class="d-flex gap-3 align-items-center">
                                <div class="input-group position-relative">
                                    <input type="text" id="searchBox" class="search-box" placeholder="Search department">
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

                        {{-- Department Content --}}
                        <div class="d-flex align-items-center justify-content-between my-8">
                            <h4 class="m-0 top-heading text-start">Manage Department</h4>
                            <button class="custom-btn orange-fill" data-bs-toggle="modal" data-bs-target="#AddDepartment">
                                <span class="me-2 d-flex align-items-center">
                                    <iconify-icon icon="ic:round-plus" width="20" height="20"></iconify-icon>
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
                                                <div class="d-flex gap-2 align-items-center">Department</div>
                                            </th>
                                            <th>
                                                <div class="d-flex gap-2 align-items-center">Division</div>
                                            </th>
                                            <th>
                                                <div class="d-flex gap-2 align-items-center">Business Unit</div>
                                            </th>
                                            <th>
                                                <div class="d-flex gap-2 align-items-center">No of employees</div>
                                            </th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="departmentsTbody">
                                        <tr>
                                            <td colspan="5" class="text-center py-5">Loading departments...</td>
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
                    </div>
                </div>
            </div>

            {{-- Add Department Modal --}}
            <div class="modal fade" id="AddDepartment" tabindex="-1" aria-labelledby="AddDepartmentLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('organization-structure.departments.store') }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold" id="AddDepartmentLabel">Add Department</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Department Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="addDepartmentName" name="name" class="form-control" placeholder="Enter department name" required>
                                    <div id="addNameValidation" class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Division <span class="text-danger">*</span>
                                    </label>
                                    <select id="addDivisionId" name="division_id" class="form-control" required>
                                        <option value="">Select Division</option>
                                        @foreach($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->head_of_division }}</option>
                                        @endforeach
                                    </select>
                                    <div id="addDivisionValidation" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-end gap-2">
                                <button type="button" class="custom-btn grey-outline" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" id="addDepartmentBtn" class="custom-btn orange-fill">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Edit Department Modal --}}
            <div class="modal fade" id="EditDepartment" tabindex="-1" aria-labelledby="EditDepartmentLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="editDepartmentForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold" id="EditDepartmentLabel">Edit Department</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Department Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="editDepartmentName" name="name" class="form-control" placeholder="Enter department name" required>
                                    <div id="editNameValidation" class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Division <span class="text-danger">*</span>
                                    </label>
                                    <select id="editDivisionId" name="division_id" class="form-control" required>
                                        <option value="">Select Division</option>
                                        @foreach($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->head_of_division }}</option>
                                        @endforeach
                                    </select>
                                    <div id="editDivisionValidation" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-end gap-2">
                                <button type="button" class="custom-btn grey-outline" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" id="updateDepartmentBtn" class="custom-btn orange-fill">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Delete Department Modal --}}
            <div class="modal fade" id="DeleteDepartment" tabindex="-1" aria-hidden="true">
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
                            <h5>Delete Department</h5>
                            <p id="deleteConfirmText">Are you sure you want to delete this department?</p>
                            <div class="d-flex gap-2 justify-content-center">
                                <button type="button" class="modal-custom-btn modal-cancel-btn" data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <form id="deleteDepartmentForm" method="POST" style="display: inline;">
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
            const apiBaseUrl = "{{ env('APP_URL') }}";
            const apiUrl = `${apiBaseUrl}/insighthub/settings/general-settings/organization-structure/departments/getData`;
            const tbody = document.getElementById('departmentsTbody');
            const resultsPerPageSelect = document.getElementById('resultsPerPageSelect');
            const resultsSummary = document.getElementById('resultsSummary');
            const paginationContainer = document.getElementById('paginationContainer');
            const searchBox = document.getElementById('searchBox');
            const searchBtn = document.getElementById('searchBtn');
            const clearSearchBtn = document.getElementById('clearSearchBtn');

            let currentPage = 1;
            let perPage = parseInt(resultsPerPageSelect ? resultsPerPageSelect.value : '10', 10) || 10;
            let currentSearch = '';
            let currentEditingId = null;

            // Add Modal Elements
            const addModal = document.getElementById('AddDepartment');
            const addForm = addModal ? addModal.querySelector('form') : null;
            const addInput = document.getElementById('addDepartmentName');
            const addDivisionSelect = document.getElementById('addDivisionId');
            const addValidation = document.getElementById('addNameValidation');
            const addBtn = document.getElementById('addDepartmentBtn');

            // Edit Modal Elements
            const editModal = document.getElementById('EditDepartment');
            const editForm = document.getElementById('editDepartmentForm');
            const editInput = document.getElementById('editDepartmentName');
            const editDivisionSelect = document.getElementById('editDivisionId');
            const editValidation = document.getElementById('editNameValidation');
            const updateBtn = document.getElementById('updateDepartmentBtn');

            // Delete Modal Elements
            const deleteModal = document.getElementById('DeleteDepartment');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            let deleteId = null;

            // Debounce helper
            function debounce(fn, wait) {
                let t = null;
                return function(...args) {
                    clearTimeout(t);
                    t = setTimeout(() => fn.apply(this, args), wait);
                };
            }

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

            // Render table rows
            function renderRows(departments) {
                if (!tbody) return;
                if (!Array.isArray(departments) || departments.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="empty-state">
                                    <div class="empty-icon mb-5">
                                        <iconify-icon icon="mage:file-2" width="20" height="20"></iconify-icon>
                                    </div>
                                    <h5 class="m-0">No Results Found</h5>
                                    <p class="custom-text-muted mx-auto" style="max-width: 500px;">No departments available. Click "Add Department" to create one.</p>
                                </div>
                            </td>
                        </tr>
                    `;
                    return;
                }

                const rows = departments.map(dept => {
                    const id = dept.id;
                    const name = (dept.name || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                    const division = (dept.division_name || 'N/A').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                    const businessUnit = (dept.business_unit_name || 'N/A').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                    const count = dept.employee_count || 0;
                    const canDelete = dept.can_delete;
                    const divisionId = dept.division_id || '';

                    const deleteIcon = canDelete 
                        ? `<iconify-icon icon="gg:trash" width="20" height="20" class="ms-7 cursor-pointer delete-dept-btn" style="color: #F24130;" data-id="${id}" data-name="${name}"></iconify-icon>`
                        : `<iconify-icon icon="gg:trash" width="20" height="20" class="ms-7 cursor-default" style="color: #99A1B7;"></iconify-icon>`;

                    return `
                        <tr>
                            <td>${name}</td>
                            <td>${division}</td>
                            <td>${businessUnit}</td>
                            <td>${count}</td>
                            <td class="text-center action-icons">
                                <iconify-icon icon="lucide:edit" width="16" height="16" class="cursor-pointer edit-dept-btn" data-id="${id}" data-name="${name}" data-division-id="${divisionId}"></iconify-icon>
                                ${deleteIcon}
                            </td>
                        </tr>
                    `;
                }).join('');

                tbody.innerHTML = rows;

                // Attach event listeners to dynamically created buttons
                document.querySelectorAll('.edit-dept-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        const name = this.getAttribute('data-name');
                        const divisionId = this.getAttribute('data-division-id');
                        openEditModal(id, name, divisionId);
                    });
                });

                document.querySelectorAll('.delete-dept-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        const name = this.getAttribute('data-name');
                        openDeleteModal(id, name);
                    });
                });
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

                paginationContainer.innerHTML = '';

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

                paginationContainer.appendChild(makeLi('<', current === 1, false, current - 1));

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

                paginationContainer.appendChild(makeLi('>', current === last, false, current + 1));
            }

            function fetchPage(page = 1, per_page = perPage) {
                currentPage = page;
                perPage = per_page;

                const url = new URL(apiUrl);
                url.searchParams.set('per_page', perPage);
                url.searchParams.set('page', currentPage);
                if (currentSearch && currentSearch.trim() !== '') {
                    url.searchParams.set('q', currentSearch.trim());
                }

                if (tbody) {
                    tbody.innerHTML = `<tr><td colspan="5" class="text-center py-5">Loading departments...</td></tr>`;
                }

                fetch(url.toString(), {
                    headers: { 'Accept': 'application/json' }
                })
                .then(res => res.json())
                .then(json => {
                    if (json && json.status === 'success' && Array.isArray(json.data)) {
                        renderRows(json.data);
                        const pagination = (json.meta && json.meta.pagination) ? json.meta.pagination : { total: json.data.length, per_page: perPage, current_page: currentPage, last_page: 1 };
                        updateResultsSummary(pagination);
                        renderPagination(pagination);
                    } else {
                        renderRows([]);
                        updateResultsSummary({ total: 0, per_page: perPage, current_page: 1, last_page: 1 });
                        renderPagination({ total: 0, per_page: perPage, current_page: 1, last_page: 1 });
                    }
                })
                .catch(err => {
                    console.error('Failed to fetch departments:', err);
                    renderRows([]);
                    updateResultsSummary({ total: 0, per_page: perPage, current_page: 1, last_page: 1 });
                    renderPagination({ total: 0, per_page: perPage, current_page: 1, last_page: 1 });
                });
            }

            // Initialize
            fetchPage(currentPage, perPage);

            // Results per page change
            if (resultsPerPageSelect) {
                resultsPerPageSelect.value = String(perPage);
                resultsPerPageSelect.addEventListener('change', function() {
                    const val = parseInt(this.value, 10) || 10;
                    fetchPage(1, val);
                });
            }

            // Search handling
            if (searchBox) {
                // Show/hide clear button on input
                searchBox.addEventListener('input', function() {
                    toggleClearButton();
                });

                searchBox.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        currentSearch = e.target.value || '';
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
                        fetchPage(1, perPage); // Reload data without search
                    }
                });
            }

            if (searchBtn) {
                searchBtn.addEventListener('click', function() {
                    if (searchBox) {
                        currentSearch = searchBox.value || '';
                    }
                    fetchPage(1, perPage);
                });
            }

            // Add Modal - Clear validation on input
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

            if (addDivisionSelect) {
                addDivisionSelect.addEventListener('change', function() {
                    if (addInput.classList.contains('is-invalid')) {
                        addInput.classList.remove('is-invalid');
                        if (addValidation) {
                            addValidation.classList.remove('d-block');
                            addValidation.textContent = '';
                        }
                    }
                });
            }

            // Add form submission with duplicate check
            if (addForm) {
                addForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const name = addInput ? addInput.value.trim() : '';
                    const divisionId = addDivisionSelect ? addDivisionSelect.value : '';
                    
                    if (name === '' || divisionId === '') {
                        if (name === '') {
                            addInput.classList.add('is-invalid');
                            if (addValidation) {
                                addValidation.textContent = 'Department name is required.';
                                addValidation.classList.add('d-block');
                            }
                        }
                        return false;
                    }
                    
                    if (addBtn) addBtn.disabled = true;
                    
                    const checkUrl = `${apiBaseUrl}/insighthub/settings/general-settings/organization-structure/departments/check-duplicate`;
                    
                    fetch(checkUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ 
                            name: name,
                            division_id: divisionId
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.exists) {
                            addInput.classList.add('is-invalid');
                            if (addValidation) {
                                addValidation.textContent = 'This department name already exists in the selected division.';
                                addValidation.classList.add('d-block');
                            }
                            if (addBtn) addBtn.disabled = false;
                        } else {
                            addForm.submit();
                        }
                    })
                    .catch(err => {
                        console.error('Error checking duplicate:', err);
                        addForm.submit();
                    });
                    
                    return false;
                });
            }

            // Edit Modal - Clear validation on input
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

            if (editDivisionSelect) {
                editDivisionSelect.addEventListener('change', function() {
                    if (editInput.classList.contains('is-invalid')) {
                        editInput.classList.remove('is-invalid');
                        if (editValidation) {
                            editValidation.classList.remove('d-block');
                            editValidation.textContent = '';
                        }
                    }
                });
            }

            // Open edit modal
            function openEditModal(id, name, divisionId) {
                currentEditingId = parseInt(id);
                if (editInput) editInput.value = name;
                if (editDivisionSelect) editDivisionSelect.value = divisionId;
                if (editForm) {
                    editForm.action = "{{ route('organization-structure.departments.update', ':id') }}".replace(':id', id);
                }
                
                // Reset validation
                if (editInput) editInput.classList.remove('is-invalid');
                if (editValidation) {
                    editValidation.classList.remove('d-block');
                    editValidation.textContent = '';
                }
                if (updateBtn) updateBtn.disabled = false;
                
                const modal = new bootstrap.Modal(editModal);
                modal.show();
            }

            // Edit form submission with duplicate check
            if (editForm) {
                editForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const name = editInput ? editInput.value.trim() : '';
                    const divisionId = editDivisionSelect ? editDivisionSelect.value : '';
                    
                    if (name === '' || divisionId === '') {
                        if (name === '') {
                            editInput.classList.add('is-invalid');
                            if (editValidation) {
                                editValidation.textContent = 'Department name is required.';
                                editValidation.classList.add('d-block');
                            }
                        }
                        return false;
                    }
                    
                    if (updateBtn) updateBtn.disabled = true;
                    
                    const checkUrl = `${apiBaseUrl}/insighthub/settings/general-settings/organization-structure/departments/check-duplicate`;
                    
                    fetch(checkUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ 
                            name: name,
                            division_id: divisionId,
                            exclude_id: currentEditingId 
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.exists) {
                            editInput.classList.add('is-invalid');
                            if (editValidation) {
                                editValidation.textContent = 'This department name already exists in the selected division.';
                                editValidation.classList.add('d-block');
                            }
                            if (updateBtn) updateBtn.disabled = false;
                        } else {
                            editForm.submit();
                        }
                    })
                    .catch(err => {
                        console.error('Error checking duplicate:', err);
                        editForm.submit();
                    });
                    
                    return false;
                });
            }

            // Open delete modal
            function openDeleteModal(id, name) {
                deleteId = id;
                const modal = new bootstrap.Modal(deleteModal);
                modal.show();
            }

            // Delete confirmation
            if (confirmDeleteBtn) {
                confirmDeleteBtn.addEventListener('click', function() {
                    if (!deleteId) return;
                    
                    const deleteForm = document.createElement('form');
                    deleteForm.method = 'POST';
                    deleteForm.action = "{{ route('organization-structure.departments.destroy', ':id') }}".replace(':id', deleteId);
                    
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                    
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    
                    deleteForm.appendChild(csrfInput);
                    deleteForm.appendChild(methodInput);
                    document.body.appendChild(deleteForm);
                    deleteForm.submit();
                });
            }
        });
    </script>
@endsection
