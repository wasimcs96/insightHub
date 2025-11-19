@extends('insighthub.layout.app')

@section('title', 'Email Templates')

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


        .page-heading {
            color: #2E2F38;
            font-size: 32px;
            font-weight: 600;
        }

        .filter-btn {
            display: flex;
            padding: 8px 12px;
            gap: 8px;
            color: #2E2F38;
            font-size: 14px;
            font-weight: 400;
            line-height: 19px;
            border-radius: 4px;
            border: 1px solid #727790;
            background: #FEFEFE;
            cursor: pointer;
            align-items: center;
        }

        .search-box {
            border: 1px solid #C8CFD9;
            border-radius: 8px;
            padding: 8px 14px;
            width: 250px;
        }

        .email-table thead {
            background: #F5F7F8;
            color: #2E2F38;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
        }

        .email-table td,
        .email-table th {
            vertical-align: middle !important;
            color: #2E2F38 !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            line-height: 20px;
            border-bottom: 1px solid #ECF0F3 !important;
            border-left: 1px solid #ECF0F3 !important;
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

        input:focus-visible {
            outline: none;
        }

        .table-border {
            border-radius: 4px;
            border: 1px solid #ECF0F3;
        }

        .custom-dropdown {
            width: 327px;
            border-radius: 8px;
            border: 1.5px solid #ECF0F3;
            background: #FFF;
            box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.05);
        }

        .dropdown-list {
            max-height: 260px;
            overflow-y: auto;
            padding: 12px;
        }

        .custom-option {
            border-radius: 4px;
            cursor: pointer;
            height: 46px;
            padding: 12px 16px;
            color: #2E2F38;
            font-size: 14px;
            font-weight: 400;
            line-height: 19px;
        }

        .custom-option.active,
        .custom-option:hover {
            background: #FFF8EB;
            color: #2E2F38;
        }

        .dropdown-footer {
            padding: 14px;
            border-top: 1px solid #eee;
        }

        .dropdown-filter-btn {
            display: flex;
            padding: 8px 12px;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
            text-align: center;
            font-size: 14px;
            font-weight: 600;
            border: none;
            height: 35px;
        }

        .dropdown-filter-btn.reset-btn {
            background: transparent;
            color: #727790;
        }

        .dropdown-filter-btn.filter-btn {
            background-color: #F7941C;
            color: #fff;
        }

        .thead-icon {
            color: #C8CFD9;
        }

        .thead-icon:hover,
        .thead-icon:active {
            color: #F7941C;
        }

        .custom-cross{
            position: absolute;
            right: 50px;
            top: 12px;
            display: none;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="container-xxl app-container d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading text-gray-900 fw-bold fs-3 my-0">
                    Email Templates
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">General Settings</li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted" id="breadcrumb-last">Email Templates</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
                @if(session('success'))
                    <div id="feedbackMessage" class="justify-content-between align-items-center feedback-message mt-3 mb-3">
                        <p class="text-center fw-medium m-0"><b>Success!</b> {{ session('success') }}</p>
                        <iconify-icon icon="iconamoon:close" width="20" height="20" class="cursor-pointer" id="closeIcon"></iconify-icon>
                    </div>
                @endif
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid p-0">
    <div id="kt_app_content_container" class="container-xxl app-container">
        @include('insighthub.settings.index')

        <div class="tab-content">
            <div class="tab-pane fade show active" id="email" role="tabpanel">
                <div class="settings-card">
                    <div class="settings-card-header d-flex justify-content-between align-items-center">
                        <h4 class="m-0 top-heading">Email Templates</h4>
                    </div>

                    <!-- Filters + Search -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

    <!-- Left: Filter + Module Dropdown -->
    <div class="d-flex justify-content-between align-items-center gap-3">
        <!-- Filter Label -->
        <button class="filter-btn border-0 bg-white" style="color: #727790;">
            <iconify-icon icon="lets-icons:filter" width="20" height="20"></iconify-icon>
            Filter
        </button>

        <!-- Dropdown -->
        <div class="dropdown filter-dropdown">
            <button class="filter-btn filter-toggle" style="color: #2E2F38;" type="button" data-bs-toggle="dropdown">
                <span id="selectedModule">{{ request('module') ? request('module') : 'Module' }}</span>
                <i class="bi bi-chevron-down"></i>
            </button>

            <div class="dropdown-menu p-0 custom-dropdown shadow">
                <form method="GET" action="{{ route('insighthub.settings.email-templates.index') }}" id="filterForm">
                    <ul class="list-unstyled mb-0 dropdown-list" id="moduleList">
                       @foreach($modules as $mod)
                            <li class="dropdown-item custom-option {{ request('module') == $mod->name ? 'active' : '' }}" data-value="{{ $mod->name }}">
                                {{ $mod->name }}
                            </li>
                       @endforeach
                    </ul>

                    <input type="hidden" name="module" id="moduleInput" value="{{ request('module') }}">
                    <input type="hidden" name="search" id="hiddenSearch" value="{{ request('search') }}">

                    <div class="dropdown-footer d-flex justify-content-end gap-3 align-items-center">
                        <button type="button" class="dropdown-filter-btn reset-btn" id="resetModule">Reset</button>
                        <button type="submit" class="dropdown-filter-btn filter-btn" id="applyFilter">Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Right: Search -->
    <form method="GET" action="{{ route('insighthub.settings.email-templates.index') }}" class="d-flex gap-3 align-items-center">
        <div class="input-group">
            <input type="text" name="search" class="search-box" placeholder="Search template" 
                   value="{{ request('search') }}">
                   <iconify-icon icon="carbon:close-filled" class="custom-cross" width="18" height="18" style="color: #999;"></iconify-icon>
            <button type="submit" class="input-group-text">
                <iconify-icon icon="ic:round-search" width="20"></iconify-icon>
            </button>
        </div>
        <!-- Keep selected module when searching -->
        <input type="hidden" name="module" value="{{ request('module') }}">
    </form>
</div>



                    <!-- Table -->
                    <div class="table-border">
                        <div class="table-responsive">
                            <table class="table email-table align-middle m-0">
                                <thead>
                                    <tr>
                                        <th>
                                            <a href="{{ route('insighthub.settings.email-templates.index', array_merge(request()->query(), [
                                                'sort' => 'title',
                                                'direction' => request('sort') === 'title' && request('direction') === 'asc' ? 'desc' : 'asc',
                                            ])) }}" class="text-decoration-none text-dark d-flex align-items-center gap-1">
                                                Email Action
                                                @if(request('sort') === 'title')
                                                    @if(request('direction') === 'asc')
                                                        <iconify-icon icon="mdi:chevron-up" class="thead-icon"></iconify-icon>
                                                    @else
                                                        <iconify-icon icon="mdi:chevron-down" class="thead-icon"></iconify-icon>
                                                    @endif
                                                @else
                                                    <iconify-icon icon="mdi:chevron-up-down" class="thead-icon"></iconify-icon>
                                                @endif
                                            </a>
                                        </th>
                                        <th>
                                            <a href="{{ route('insighthub.settings.email-templates.index', array_merge(request()->query(), [
                                                'sort' => 'module',
                                                'direction' => request('sort') === 'module' && request('direction') === 'asc' ? 'desc' : 'asc',
                                            ])) }}" class="text-decoration-none text-dark d-flex align-items-center gap-1">
                                                Module
                                                @if(request('sort') === 'module')
                                                    @if(request('direction') === 'asc')
                                                        <iconify-icon icon="mdi:chevron-up" class="thead-icon"></iconify-icon>
                                                    @else
                                                        <iconify-icon icon="mdi:chevron-down" class="thead-icon"></iconify-icon>
                                                    @endif
                                                @else
                                                    <iconify-icon icon="mdi:chevron-up-down" class="thead-icon"></iconify-icon>
                                                @endif
                                            </a>
                                        </th>
                                        <th>Description</th>
                                        <th>
                                            <a href="{{ route('insighthub.settings.email-templates.index', array_merge(request()->query(), [
                                                'sort' => 'updated_at',
                                                'direction' => request('sort') === 'updated_at' && request('direction') === 'asc' ? 'desc' : 'asc',
                                            ])) }}" class="text-decoration-none text-dark d-flex align-items-center gap-1">
                                                Last Edited
                                                @if(request('sort') === 'updated_at')
                                                    @if(request('direction') === 'asc')
                                                        <iconify-icon icon="mdi:chevron-up" class="thead-icon"></iconify-icon>
                                                    @else
                                                        <iconify-icon icon="mdi:chevron-down" class="thead-icon"></iconify-icon>
                                                    @endif
                                                @else
                                                    <iconify-icon icon="mdi:chevron-up-down" class="thead-icon"></iconify-icon>
                                                @endif
                                            </a>
                                        </th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>

                                <!-- ✅ Dynamic Data Section -->
                                <tbody>
                                    @forelse ($emailTemplates as $template)
                                        <tr>
                                            <td>{{ $template->title }}</td>
                                            <td>{{ $template->module->name ?? 'N/A' }}</td>
                                            <td><span class="truncate-text">{{ $template->description ?? 'No description' }}</span></td>
                                            <td>{{ optional($template->updated_at)->format('d M Y') ?? '—' }}</td>
                                            <td class="text-center action-icons">
                                                <a href="{{ route('insighthub.settings.email-templates.view', $template->id) }}">
                                                    <iconify-icon icon="solar:eye-outline" width="16" height="16" class="cursor-pointer"></iconify-icon>
                                                </a>
                                                <a href="{{ route('insighthub.settings.email-templates.edit', $template->id) }}">
                                                    <iconify-icon icon="lucide:edit" width="16" height="16" class="cursor-pointer ms-4"></iconify-icon>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-muted">No templates found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- ✅ Pagination Section -->
                        <div class="d-flex justify-content-between align-items-center mx-5 my-4">
                            <div class="d-flex gap-5 align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <label class="custom-text-muted mb-0">Result per page</label>
                                    <form method="GET" id="perPageForm">
                                        <select class="results-select" name="per_page" onchange="document.getElementById('perPageForm').submit()">
                                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                        </select>
                                    </form>
                                </div>

                                <p class="mb-0 custom-text-muted">
                                    Showing {{ $emailTemplates->firstItem() }}–{{ $emailTemplates->lastItem() }} of {{ $emailTemplates->total() }}
                                </p>
                            </div>

                            {{ $emailTemplates->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ✅ Success message auto-hide
    const feedback = document.getElementById('feedbackMessage');
    if (feedback) {
        setTimeout(() => feedback.style.display = 'none', 3000);
        const closeIcon = document.getElementById('closeIcon');
        if (closeIcon) {
            closeIcon.addEventListener('click', () => feedback.style.display = 'none');
        }
    }

    // ✅ Search box functionality
    const searchInput = document.querySelector('.search-box');
    const clearSearchBtn = document.querySelector('.custom-cross');

    function toggleClearButton() {
        if (clearSearchBtn && searchInput) {
            if (searchInput.value.trim() !== '') {
                clearSearchBtn.style.display = 'block';
            } else {
                clearSearchBtn.style.display = 'none';
            }
        }
    }

    // Initial state on page load
    toggleClearButton();

    // Show/Hide cross icon dynamically
    searchInput.addEventListener('input', toggleClearButton);

    // Clear search when clicking the cross
    clearSearchBtn.addEventListener('click', function() {
        searchInput.value = '';
        toggleClearButton();
        // Optional: auto-submit to reset search
        searchInput.closest('form').submit();
    });

    // Submit search on Enter
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            this.closest('form').submit();
        }
    });

    // ✅ Highlight active module filter (optional)
    const moduleSelect = document.querySelector('select[name="module"]');
    if (moduleSelect && moduleSelect.value !== '') {
        moduleSelect.style.borderColor = '#F7941C';
        moduleSelect.style.backgroundColor = '#FFF8EB';
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const moduleItems = document.querySelectorAll('.custom-option');
    const moduleInput = document.getElementById('moduleInput');
    const selectedModuleText = document.getElementById('selectedModule');
    const resetButton = document.getElementById('resetModule');
    const filterForm = document.getElementById('filterForm');

    moduleItems.forEach(item => {
        item.addEventListener('click', function () {
            moduleItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            const selectedValue = this.getAttribute('data-value');
            moduleInput.value = selectedValue;
            selectedModuleText.textContent = selectedValue;
        });
    });

    resetButton.addEventListener('click', function () {
        moduleInput.value = '';
        selectedModuleText.textContent = 'Module';
        moduleItems.forEach(i => i.classList.remove('active'));
        filterForm.submit();
    });
});
</script>

@endsection

