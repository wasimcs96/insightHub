<div class="table-border bg-white">
    <div class="table-responsive" style="overflow: scroll;">
        <table class="table table-users align-middle m-0" style="width: 100%; overflow: hidden;">
            <thead>
                <tr>
                    <th scope="col">
                        <div class="custom-checkbox">
                            <input type="checkbox" class="select-all">
                        </div>
                    </th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery([
                            'sort_by' => 'name',
                            'sort_order' => (request('sort_by') === 'name' && request('sort_order') === 'asc') ? 'desc' : 'asc',
                            'tab' => $tab ?? 'employee'
                        ]) }}">
                            <div class="d-flex gap-2 align-items-center table-header-text">
                                Employee
                                <div class="d-flex flex-column">
                                    <iconify-icon icon="iwwa:arrow-up" width="12" height="12"
                                        class="thead-icon {{ request('sort_by') === 'name' && request('sort_order') === 'asc' ? 'text-primary' : '' }}"></iconify-icon>
                                    <iconify-icon icon="iwwa:arrow-down" width="12" height="12"
                                        class="thead-icon {{ request('sort_by') === 'name' && request('sort_order') === 'desc' ? 'text-primary' : '' }}"></iconify-icon>
                                </div>
                            </div>
                        </a>
                    </th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery([
                            'sort_by' => 'role_id',
                            'sort_order' => (request('sort_by') === 'role_id' && request('sort_order') === 'asc') ? 'desc' : 'asc'
                        ]) }}">
                            <div class="d-flex gap-2 align-items-center table-header-text">
                                Role
                                <div class="d-flex flex-column">
                                    <iconify-icon icon="iwwa:arrow-up" width="12" height="12"
                                        class="thead-icon {{ request('sort_by') === 'role_id' && request('sort_order') === 'asc' ? 'text-primary' : '' }}"></iconify-icon>
                                    <iconify-icon icon="iwwa:arrow-down" width="12" height="12"
                                        class="thead-icon {{ request('sort_by') === 'role_id' && request('sort_order') === 'desc' ? 'text-primary' : '' }}"></iconify-icon>
                                </div>
                            </div>
                        </a>
                    </th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery([
                            'sort_by' => 'onboarding_email_status',
                            'sort_order' => (request('sort_by') === 'onboarding_email_status' && request('sort_order') === 'asc') ? 'desc' : 'asc'
                        ]) }}">
                            <div class="d-flex gap-2 align-items-center table-header-text">
                                Onboarding Email Status
                                <div class="d-flex flex-column">
                                    <iconify-icon icon="iwwa:arrow-up" width="12" height="12"
                                        class="thead-icon {{ request('sort_by') === 'onboarding_email_status' && request('sort_order') === 'asc' ? 'text-primary' : '' }}"></iconify-icon>
                                    <iconify-icon icon="iwwa:arrow-down" width="12" height="12"
                                        class="thead-icon {{ request('sort_by') === 'onboarding_email_status' && request('sort_order') === 'desc' ? 'text-primary' : '' }}"></iconify-icon>
                                </div>
                            </div>
                        </a>
                    </th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery([
                            'sort_by' => 'position_id',
                            'sort_order' => (request('sort_by') === 'position_id' && request('sort_order') === 'asc') ? 'desc' : 'asc'
                        ]) }}">
                            <div class="d-flex gap-2 align-items-center table-header-text">
                                Job Position
                                <div class="d-flex flex-column">
                                    <iconify-icon icon="iwwa:arrow-up" width="12" height="12"
                                        class="thead-icon {{ request('sort_by') === 'position_id' && request('sort_order') === 'asc' ? 'text-primary' : '' }}"></iconify-icon>
                                    <iconify-icon icon="iwwa:arrow-down" width="12" height="12"
                                        class="thead-icon {{ request('sort_by') === 'position_id' && request('sort_order') === 'desc' ? 'text-primary' : '' }}"></iconify-icon>
                                </div>
                            </div>
                        </a>
                    </th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery([
                            'sort_by' => 'department_id',
                            'sort_order' => (request('sort_by') === 'department_id' && request('sort_order') === 'asc') ? 'desc' : 'asc'
                        ]) }}">
                            <div class="d-flex gap-2 align-items-center table-header-text">
                                Department
                                <div class="d-flex flex-column">
                                    <iconify-icon icon="iwwa:arrow-up" width="12" height="12"
                                        class="thead-icon {{ request('sort_by') === 'department_id' && request('sort_order') === 'asc' ? 'text-primary' : '' }}"></iconify-icon>
                                    <iconify-icon icon="iwwa:arrow-down" width="12" height="12"
                                        class="thead-icon {{ request('sort_by') === 'department_id' && request('sort_order') === 'desc' ? 'text-primary' : '' }}"></iconify-icon>
                                </div>
                            </div>
                        </a>
                    </th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery([
                            'sort_by' => 'division_id',
                            'sort_order' => (request('sort_by') === 'division_id' && request('sort_order') === 'asc') ? 'desc' : 'asc'
                        ]) }}">
                            <div class="d-flex gap-2 align-items-center table-header-text">
                                Division
                                <div class="d-flex flex-column">
                                    <iconify-icon icon="iwwa:arrow-up" width="12" height="12"
                                        class="thead-icon {{ request('sort_by') === 'division_id' && request('sort_order') === 'asc' ? 'text-primary' : '' }}"></iconify-icon>
                                    <iconify-icon icon="iwwa:arrow-down" width="12" height="12"
                                        class="thead-icon {{ request('sort_by') === 'division_id' && request('sort_order') === 'desc' ? 'text-primary' : '' }}"></iconify-icon>
                                </div>
                            </div>
                        </a>
                    </th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery([
                            'sort_by' => 'business_unit_id',
                            'sort_order' => (request('sort_by') === 'business_unit_id' && request('sort_order') === 'asc') ? 'desc' : 'asc'
                        ]) }}">
                            <div class="d-flex gap-2 align-items-center table-header-text">
                                Business Unit
                                <div class="d-flex flex-column">
                                    <iconify-icon icon="iwwa:arrow-up" width="12" height="12"
                                        class="thead-icon {{ request('sort_by') === 'business_unit_id' && request('sort_order') === 'asc' ? 'text-primary' : '' }}"></iconify-icon>
                                    <iconify-icon icon="iwwa:arrow-down" width="12" height="12"
                                        class="thead-icon {{ request('sort_by') === 'business_unit_id' && request('sort_order') === 'desc' ? 'text-primary' : '' }}"></iconify-icon>
                                </div>
                            </div>
                        </a>
                    </th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery([
                            'sort_by' => 'created_at',
                            'sort_order' => (request('sort_by') === 'created_at' && request('sort_order') === 'asc') ? 'desc' : 'asc'
                        ]) }}">
                            <div class="d-flex gap-2 align-items-center table-header-text">
                                Joined Date
                                <div class="d-flex flex-column">
                                    <iconify-icon icon="iwwa:arrow-up" width="12" height="12"
                                        class="thead-icon {{ request('sort_by') === 'created_at' && request('sort_order') === 'asc' ? 'text-primary' : '' }}"></iconify-icon>
                                    <iconify-icon icon="iwwa:arrow-down" width="12" height="12"
                                        class="thead-icon {{ request('sort_by') === 'created_at' && request('sort_order') === 'desc' ? 'text-primary' : '' }}"></iconify-icon>
                                </div>
                            </div>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>
                            <div class="custom-checkbox">
                                <input type="checkbox" class="select-row" value="{{ $user->id }}">
                            </div>
                        </td>
                        <td>
                            <div class="employee-info">
                                <div class="d-flex gap-6 align-items-center">
                                    <img src="{{ $user->profile_picture ?? 'media/default-user.svg' }}" alt="Avatar" class="employee-avatar">
                                    <div class="employee-details">
                                        <p class="name m-0">{{ $user->name }}</p>
                                        <p class="email m-0">{{ $user->email }}</p>
                                        <p class="code m-0">{{ $user->employee_code ?? '' }}</p>
                                    </div>
                                </div>
                                @php
                                    $hasDepartment   = !empty($user->department_id);
                                    $hasDivision     = !empty($user->division_id);
                                    $hasCompany      = !empty($user->company_id);
                                    $hasBusinessUnit = $user->division && !empty($user->division->business_unit_id);
                                    $disableDelete   = $hasDepartment || $hasDivision || $hasCompany || $hasBusinessUnit;
                                @endphp

                                <div class="dropdown-container">
                                    <iconify-icon icon="bi:three-dots-vertical" width="16" height="16" class="dropdown-toggle"></iconify-icon>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-item">
                                            <a href="{{ route('insighthub.settings.user-management.show', $user->id) }}" class="dropdown-item" style="padding-left: 0;">
                                            View
                                            </a>
                                        </div>
                                        <div class="dropdown-item">
                                            <a href="{{ route('insighthub.settings.user-management.edit', $user->id) }}" class="dropdown-item" style="padding-left: 0;">
                                            Edit
                                            </a>
                                        </div>
                                        @if($disableDelete)
                                            <div class="dropdown-item text-muted disabled"
                                                 title="Cannot delete: user is linked to department, division, company, or business unit"
                                                 style="pointer-events: none; opacity: .5;">
                                                Delete
                                            </div>
                                        @else
                                            <div class="dropdown-item delete"
                                                 data-bs-toggle="modal"
                                                 data-bs-target="#DeleteEmployee"
                                                 data-user-id="{{ $user->id }}">
                                                Delete
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $user->role->display_name ?? 'N/A' }}</td>
                        <td>
                            <span class="custom-badge {{ $user->onboarding_email_status === 1 ? 'badge-sent' : 'badge-pending' }}">
                                {{ $user->onboarding_email_status === 1 ? 'Sent' : 'Pending' }}
                            </span>
                        </td>
                        <td>{{ $positions[$user->position_id] ?? 'N/A' }}</td>
                        <td>{{ $departments[$user->department_id] ?? 'N/A' }}</td>
                        <td>{{ $divisions[$user->division_id] ?? 'N/A' }}</td>
                        <td>{{ $user->division && $user->division->business_unit ? $user->division->business_unit->name : 'N/A' }}</td>
                        <td>{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No results found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination + Results -->
    <div class="d-flex justify-content-between align-items-center mx-5 my-4">
        <div class="d-flex gap-5 align-items-center">
            <form id="perPageForm" method="GET" class="d-flex align-items-center gap-2">
                <input type="hidden" name="tab" value="{{ $tab ?? 'employee' }}">
                <label class="custom-text-muted mb-0" style="color: #2E2F38;">Result per page</label>
                <select class="results-select" name="per_page">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                </select>
                @foreach(request()->except(['per_page', 'page']) as $key => $value)
                    @if(is_array($value))
                        @foreach($value as $v)
                            <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                        @endforeach
                    @else
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach
            </form>
            <p class="mb-0 custom-text-muted">
                {{ $users->firstItem() }}-{{ $users->lastItem() }} of {{ $users->total() }}
            </p>
        </div>
        <nav>
            {{ $users->appends(array_merge(request()->except('page'), ['tab' => $tab ?? 'employee']))->links() }}
        </nav>
    </div>
</div>