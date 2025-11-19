@extends('insighthub.layout.app')

@section('title', 'Companies/Division')

@section('styles')
    @include('InsightHub.settings.general-settings.organization-structure.partials.styles')
    <style>
        .is-invalid {
            border-color: #dc3545 !important;
        }
        .invalid-feedback {
            display: none;
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }
        .invalid-feedback.d-block {
            display: block !important;
        }
    </style>
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
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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
                                    <a class="nav-link active" href="{{ route('organization-structure.divisions') }}">
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
                                    <input type="text" class="search-box" id="searchInput" placeholder="Search division">
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

                        {{-- Division Content --}}
                        <div class="d-flex align-items-center justify-content-between my-8">
                            <h4 class="m-0 top-heading text-start">Manage Companies/Division</h4>
                            <button class="custom-btn orange-fill" data-bs-toggle="modal" data-bs-target="#AddDivision">
                                <span class="me-2 d-flex align-items-center">
                                    <iconify-icon icon="ic:round-plus" width="20" height="20"></iconify-icon>
                                </span>
                                Add Division
                            </button>
                        </div>

                        <div class="table-border">
                            <div class="table-responsive">
                                <table class="table os-table align-middle m-0" id="divisionsTable">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="d-flex gap-2 align-items-center">Name</div>
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
                                    <tbody>
                                        {{-- Data will be loaded dynamically via JavaScript --}}
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mx-5 my-4">
                                <div class="d-flex gap-5 align-items-center">
                                    <div class="d-flex align-items-center gap-2">
                                        <label class="custom-text-muted mb-0" style="color: #2E2F38;">Result per page</label>
                                        <select class="results-select" id="perPageSelect">
                                            <option value="10" selected>10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                    <p class="mb-0 custom-text-muted" id="paginationInfo">-</p>
                                </div>
                                <nav>
                                    <ul class="pagination mb-0" id="paginationControls">
                                        {{-- Pagination will be generated dynamically --}}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Add Division Modal --}}
            <div class="modal fade" id="AddDivision" tabindex="-1" aria-labelledby="AddDivisionLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ route('organization-structure.divisions.store') }}" method="POST" id="addDivisionForm">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold" id="AddDivisionLabel">Add Division</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Division Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="head_of_division" id="addDivisionName" class="form-control" placeholder="Enter division name" required>
                                    <div class="invalid-feedback" id="addDivisionNameError"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Business Unit <span class="text-danger">*</span>
                                    </label>
                                    <select name="business_unit_id" id="addBusinessUnitId" class="form-control" required>
                                        <option value="">Select Business Unit</option>
                                        @foreach($businessUnits as $businessUnit)
                                            <option value="{{ $businessUnit->id }}">{{ $businessUnit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-end gap-2">
                                <button type="button" class="custom-btn grey-outline" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="custom-btn orange-fill" id="addDivisionBtn">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Edit Division Modal --}}
            <div class="modal fade" id="EditDivision" tabindex="-1" aria-labelledby="EditDivisionLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="editDivisionForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold" id="EditDivisionLabel">Edit Division</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="editDivisionId" name="division_id">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Division Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="editDivisionName" name="head_of_division" class="form-control" placeholder="Enter division name" required>
                                    <div class="invalid-feedback" id="editDivisionNameError"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Business Unit <span class="text-danger">*</span>
                                    </label>
                                    <select name="business_unit_id" id="editBusinessUnitId" class="form-control" required>
                                        <option value="">Select Business Unit</option>
                                        @foreach($businessUnits as $businessUnit)
                                            <option value="{{ $businessUnit->id }}">{{ $businessUnit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-end gap-2">
                                <button type="button" class="custom-btn grey-outline" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="custom-btn orange-fill" id="editDivisionBtn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Delete Division Modal --}}
            <div class="modal fade" id="DeleteDivision" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content delete-modal p-6">
                        <!-- Warning Icon -->
                        <div class="d-flex justify-content-center">
                            <span><iconify-icon icon="ep:warning" width="70" height="70"
                                    style="color: #F24130;"></iconify-icon></span>
                        </div>

                        <!-- Title -->
                        <h5>Delete Division?</h5>

                        <!-- Message -->
                        <p id="deleteConfirmText">
                            You're about to delete this division from the system. This action can't be undone. Are you sure
                            you want to proceed?
                        </p>

                        <!-- Hidden form -->
                        <form id="deleteDivisionForm" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>

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
        let currentPage = 1;
        let perPage = 10;
        let searchQuery = '';
        let isCheckingDuplicate = false;
        let duplicateCheckTimeout = null;
        let searchTimeout = null;

        document.addEventListener('DOMContentLoaded', function() {
            // Load initial data
            loadDivisions();

            const searchInput = document.getElementById('searchInput');
            const clearSearchBtn = document.getElementById('clearSearchBtn');
            const searchBtn = document.getElementById('searchBtn');

            // Toggle clear button visibility
            function toggleClearButton() {
                if (clearSearchBtn && searchInput) {
                    if (searchInput.value.trim() !== '') {
                        clearSearchBtn.style.display = 'block';
                    } else {
                        clearSearchBtn.style.display = 'none';
                    }
                }
            }

            // Show/hide clear button on input
            searchInput.addEventListener('input', function() {
                toggleClearButton();
            });

            // Search on Enter key press
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    searchQuery = this.value.trim();
                    currentPage = 1;
                    loadDivisions();
                }
            });

            // Search button click functionality
            if (searchBtn) {
                searchBtn.style.cursor = 'pointer';
                searchBtn.addEventListener('click', function() {
                    searchQuery = searchInput.value.trim();
                    currentPage = 1;
                    loadDivisions();
                });
            }

            // Clear search button click handler
            if (clearSearchBtn) {
                clearSearchBtn.addEventListener('click', function() {
                    searchInput.value = '';
                    searchQuery = '';
                    toggleClearButton();
                    currentPage = 1;
                    loadDivisions();
                });
            }

            // Per page change
            const perPageSelect = document.getElementById('perPageSelect');
            perPageSelect.addEventListener('change', function() {
                perPage = parseInt(this.value);
                currentPage = 1;
                loadDivisions();
            });

            // Add Division Form - Clear error on input change
            const addDivisionName = document.getElementById('addDivisionName');
            addDivisionName.addEventListener('input', function() {
                this.classList.remove('is-invalid');
                document.getElementById('addDivisionNameError').classList.remove('d-block');
            });

            // Add Division Form - Duplicate Check on Submit
            const addDivisionForm = document.getElementById('addDivisionForm');
            addDivisionForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const name = document.getElementById('addDivisionName').value.trim();
                const businessUnitId = document.getElementById('addBusinessUnitId').value;
                
                if (name && businessUnitId) {
                    // Check for duplicates before submitting
                    checkDuplicateBeforeSubmit(name, businessUnitId, null, 'add', addDivisionForm);
                } else {
                    // If fields are empty, let HTML5 validation handle it
                    addDivisionForm.submit();
                }
            });

            // Edit Division Form - Clear error on input change
            const editDivisionName = document.getElementById('editDivisionName');
            editDivisionName.addEventListener('input', function() {
                this.classList.remove('is-invalid');
                document.getElementById('editDivisionNameError').classList.remove('d-block');
            });

            // Edit Division Form - Duplicate Check on Submit
            const editDivisionForm = document.getElementById('editDivisionForm');
            editDivisionForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const name = document.getElementById('editDivisionName').value.trim();
                const businessUnitId = document.getElementById('editBusinessUnitId').value;
                const excludeId = document.getElementById('editDivisionId').value;
                
                if (name && businessUnitId && excludeId) {
                    // Check for duplicates before submitting
                    checkDuplicateBeforeSubmit(name, businessUnitId, excludeId, 'edit', editDivisionForm);
                } else {
                    // If fields are empty, let HTML5 validation handle it
                    editDivisionForm.submit();
                }
            });

            // Delete confirmation
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            confirmDeleteBtn.addEventListener('click', function() {
                document.getElementById('deleteDivisionForm').submit();
            });
        });

        function loadDivisions() {
            const tbody = document.querySelector('#divisionsTable tbody');
            tbody.innerHTML = '<tr><td colspan="4" class="text-center py-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></td></tr>';

            const url = new URL('{{ route("organization-structure.divisions.getData") }}');
            url.searchParams.append('page', currentPage);
            url.searchParams.append('per_page', perPage);
            if (searchQuery) {
                url.searchParams.append('q', searchQuery);
            }

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        renderTable(data.data);
                        renderPagination(data.meta.pagination);
                    } else {
                        showError('Failed to load divisions');
                    }
                })
                .catch(error => {
                    console.error('Error loading divisions:', error);
                    showError('An error occurred while loading divisions');
                });
        }

        function renderTable(divisions) {
            const tbody = document.querySelector('#divisionsTable tbody');
            
            if (divisions.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="empty-state">
                                <div class="empty-icon mb-5">
                                    <iconify-icon icon="mage:file-2" width="20" height="20"></iconify-icon>
                                </div>
                                <h5 class="m-0">No Results Found</h5>
                                <p class="custom-text-muted mx-auto" style="max-width: 500px;">
                                    No divisions available. Click "Add Division" to create one.
                                </p>
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = divisions.map(division => `
                <tr>
                    <td>${escapeHtml(division.head_of_division || 'N/A')}</td>
                    <td>${escapeHtml(division.business_unit_name || 'N/A')}</td>
                    <td>${division.employee_count || 0}</td>
                    <td class="text-center action-icons">
                        <iconify-icon icon="lucide:edit" width="16" height="16"
                            class="cursor-pointer" 
                            onclick="openEditModal(${division.id}, '${escapeJs(division.head_of_division)}', ${division.business_unit_id})"></iconify-icon>
                        
                        ${division.can_delete 
                            ? `<iconify-icon icon="gg:trash" width="20" height="20"
                                class="ms-7 cursor-pointer" style="color: #F24130;"
                                onclick="openDeleteModal(${division.id}, '${escapeJs(division.head_of_division)}')"></iconify-icon>`
                            : `<iconify-icon icon="gg:trash" width="20" height="20"
                                class="ms-7 cursor-default" style="color: #99A1B7;"
                                title="Cannot delete: has related records"></iconify-icon>`
                        }
                    </td>
                </tr>
            `).join('');
        }

        function renderPagination(pagination) {
            const paginationInfo = document.getElementById('paginationInfo');
            const start = (pagination.current_page - 1) * pagination.per_page + 1;
            const end = Math.min(pagination.current_page * pagination.per_page, pagination.total);
            paginationInfo.textContent = `${start}-${end} of ${pagination.total}`;

            const paginationControls = document.getElementById('paginationControls');
            let html = '';

            // Previous button
            html += `<li class="page-item ${pagination.current_page === 1 ? 'disabled' : ''}">
                <button class="page-link" onclick="changePage(${pagination.current_page - 1})" ${pagination.current_page === 1 ? 'disabled' : ''}>&lt;</button>
            </li>`;

            // Page numbers
            const maxPagesToShow = 5;
            let startPage = Math.max(1, pagination.current_page - 2);
            let endPage = Math.min(pagination.last_page, startPage + maxPagesToShow - 1);
            
            if (endPage - startPage < maxPagesToShow - 1) {
                startPage = Math.max(1, endPage - maxPagesToShow + 1);
            }

            if (startPage > 1) {
                html += `<li class="page-item"><button class="page-link" onclick="changePage(1)">1</button></li>`;
                if (startPage > 2) {
                    html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }
            }

            for (let i = startPage; i <= endPage; i++) {
                html += `<li class="page-item ${i === pagination.current_page ? 'active' : ''}">
                    <button class="page-link" onclick="changePage(${i})">${i}</button>
                </li>`;
            }

            if (endPage < pagination.last_page) {
                if (endPage < pagination.last_page - 1) {
                    html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }
                html += `<li class="page-item"><button class="page-link" onclick="changePage(${pagination.last_page})">${pagination.last_page}</button></li>`;
            }

            // Next button
            html += `<li class="page-item ${pagination.current_page === pagination.last_page ? 'disabled' : ''}">
                <button class="page-link" onclick="changePage(${pagination.current_page + 1})" ${pagination.current_page === pagination.last_page ? 'disabled' : ''}>&gt;</button>
            </li>`;

            paginationControls.innerHTML = html;
        }

        function changePage(page) {
            currentPage = page;
            loadDivisions();
        }

        function openEditModal(id, name, businessUnitId) {
            document.getElementById('editDivisionId').value = id;
            document.getElementById('editDivisionName').value = name;
            document.getElementById('editBusinessUnitId').value = businessUnitId;
            
            // Clear any previous error states
            document.getElementById('editDivisionName').classList.remove('is-invalid');
            document.getElementById('editDivisionNameError').classList.remove('d-block');
            
            const editForm = document.getElementById('editDivisionForm');
            editForm.action = "{{ route('organization-structure.divisions.update', ':id') }}".replace(':id', id);
            
            const modal = new bootstrap.Modal(document.getElementById('EditDivision'));
            modal.show();
        }

        function openDeleteModal(id, name) {
            const deleteText = document.getElementById('deleteConfirmText');
            deleteText.innerHTML = `You're about to delete <strong>${name}</strong> from the system. This action can't be undone. Are you sure you want to proceed?`;
            
            const deleteForm = document.getElementById('deleteDivisionForm');
            deleteForm.action = "{{ route('organization-structure.divisions.destroy', ':id') }}".replace(':id', id);
            
            const modal = new bootstrap.Modal(document.getElementById('DeleteDivision'));
            modal.show();
        }

        function checkDuplicateBeforeSubmit(name, businessUnitId, excludeId, formType, form) {
            if (isCheckingDuplicate) return;
            
            isCheckingDuplicate = true;
            
            // Disable submit button while checking
            const submitBtn = document.getElementById(formType === 'add' ? 'addDivisionBtn' : 'editDivisionBtn');
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Checking...';
            
            const formData = new FormData();
            formData.append('head_of_division', name);
            formData.append('business_unit_id', businessUnitId);
            if (excludeId) {
                formData.append('exclude_id', excludeId);
            }

            fetch('{{ route("organization-structure.divisions.check-duplicate") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const nameInput = document.getElementById(formType === 'add' ? 'addDivisionName' : 'editDivisionName');
                const errorDiv = document.getElementById(formType === 'add' ? 'addDivisionNameError' : 'editDivisionNameError');
                
                if (data.exists) {
                    // Show error
                    nameInput.classList.add('is-invalid');
                    errorDiv.textContent = 'This division name already exists in the selected business unit.';
                    errorDiv.classList.add('d-block');
                    submitBtn.innerHTML = originalBtnText;
                    submitBtn.disabled = false;
                } else {
                    // No duplicate, submit the form
                    nameInput.classList.remove('is-invalid');
                    errorDiv.classList.remove('d-block');
                    submitBtn.innerHTML = originalBtnText;
                    form.submit();
                }
            })
            .catch(error => {
                console.error('Error checking duplicate:', error);
                submitBtn.innerHTML = originalBtnText;
                submitBtn.disabled = false;
                alert('Error checking for duplicates. Please try again.');
            })
            .finally(() => {
                isCheckingDuplicate = false;
            });
        }

        function escapeJs(text) {
            if (!text) return '';
            return text.replace(/\\/g, '\\\\')
                      .replace(/'/g, "\\'")
                      .replace(/"/g, '\\"')
                      .replace(/\n/g, '\\n')
                      .replace(/\r/g, '\\r');
        }

        function escapeHtml(text) {
            if (!text) return '';
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, m => map[m]);
        }

        function showError(message) {
            const tbody = document.querySelector('#divisionsTable tbody');
            tbody.innerHTML = `
                <tr>
                    <td colspan="4" class="text-center py-5">
                        <div class="alert alert-danger">
                            ${message}
                        </div>
                    </td>
                </tr>
            `;
        }

        // Reset forms when modals are closed
        document.getElementById('AddDivision').addEventListener('hidden.bs.modal', function() {
            const form = document.getElementById('addDivisionForm');
            form.reset();
            document.getElementById('addDivisionName').classList.remove('is-invalid');
            document.getElementById('addDivisionNameError').classList.remove('d-block');
            const btn = document.getElementById('addDivisionBtn');
            btn.disabled = false;
            btn.innerHTML = 'Add';
        });

        document.getElementById('EditDivision').addEventListener('hidden.bs.modal', function() {
            document.getElementById('editDivisionName').classList.remove('is-invalid');
            document.getElementById('editDivisionNameError').classList.remove('d-block');
            const btn = document.getElementById('editDivisionBtn');
            btn.disabled = false;
            btn.innerHTML = 'Update';
        });
    </script>
@endsection
