<div class="table-border bg-white">
    <div class="table-responsive" style="overflow: scroll;">
        <table class="table table-users align-middle m-0">
            <thead>
                <tr>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery([
                            'sort_by' => 'name',
                            'sort_order' => (request('sort_by') === 'name' && request('sort_order') === 'asc') ? 'desc' : 'asc',
                            'tab' => $tab ?? 'candidate'
                        ]) }}">
                            <div class="d-flex gap-2 align-items-center table-header-text">
                                Candidate
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
                            'sort_by' => 'job_title',
                            'sort_order' => (request('sort_by') === 'job_title' && request('sort_order') === 'asc') ? 'desc' : 'asc'
                        ]) }}">
                            <div class="d-flex gap-2 align-items-center table-header-text">
                                Job Applied
                                <div class="d-flex flex-column">
                                    <iconify-icon icon="iwwa:arrow-up" width="12" height="12"
                                        class="thead-icon {{ request('sort_by') === 'job_title' && request('sort_order') === 'asc' ? 'text-primary' : '' }}"></iconify-icon>
                                    <iconify-icon icon="iwwa:arrow-down" width="12" height="12"
                                        class="thead-icon {{ request('sort_by') === 'job_title' && request('sort_order') === 'desc' ? 'text-primary' : '' }}"></iconify-icon>
                                </div>
                            </div>
                        </a>
                    </th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery([
                            'sort_by' => 'status',
                            'sort_order' => (request('sort_by') === 'status' && request('sort_order') === 'asc') ? 'desc' : 'asc'
                        ]) }}">
                            <div class="d-flex gap-2 align-items-center table-header-text">
                                Hiring Status
                                <div class="d-flex flex-column">
                                    <iconify-icon icon="iwwa:arrow-up" width="12" height="12"
                                        class="thead-icon {{ request('sort_by') === 'status' && request('sort_order') === 'asc' ? 'text-primary' : '' }}"></iconify-icon>
                                    <iconify-icon icon="iwwa:arrow-down" width="12" height="12"
                                        class="thead-icon {{ request('sort_by') === 'status' && request('sort_order') === 'desc' ? 'text-primary' : '' }}"></iconify-icon>
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
                    @php
                        $applications = $user->jobOpeningApplication ?? collect();
                        $appCount = $applications->count();
                        // If no applications, show one row with N/A for application columns
                        $showRows = $appCount > 0 ? $appCount : 1;
                    @endphp
                    @for($i = 0; $i < $showRows; $i++)
                        @php
                            $application = $appCount > 0 ? $applications[$i] : null;
                            $job = $application && $application->jobOpening ? $application->jobOpening->job : null;
                            $department = $application && $application->jobOpening ? $application->jobOpening->department : null;
                            $division = $job ? $job->division : null;
                            $businessUnit = $job ? $job->businessUnit : null;
                        @endphp
                        <tr>
                            @if($i === 0)
                                <td rowspan="{{ $showRows }}">
                                    <div class="employee-info">
                                        <div class="d-flex gap-6 align-items-center">
                                            <img src="{{ $user->profile_picture ?? 'media/default-user.svg' }}" alt="Avatar" class="employee-avatar">
                                            <div class="employee-details">
                                                <p class="name m-0">{{ $user->name }}</p>
                                                <p class="email m-0">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-6 align-items-center">
                                            <div class="dropdown-container">
                                                <iconify-icon icon="bi:three-dots-vertical" width="16" height="16" class="dropdown-toggle"></iconify-icon>
                                                <div class="dropdown-menu">
                                                    <div class="dropdown-item">
                                                        <a href="{{ route('insighthub.settings.user-management.show-candidate', $user->id) }}" class="dropdown-item" style="padding-left: 0;">
                                                            View
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            @endif
                            <td>{{ $application && $application->jobOpening ? $application->jobOpening->job_title : 'N/A' }}</td>
                            <td>
                                @php
                                    $statusKey = $application && $application->status ? $application->status : null;
                                @endphp
                                @if($statusKey)
                                    <x-status-badge :status="$statusKey" />
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $department && $department->name ? $department->name : 'N/A' }}</td>
                            <td>{{ $division && $division->head_of_division ? $division->head_of_division : 'N/A' }}</td>
                            <td>{{ $businessUnit && $businessUnit->name ? $businessUnit->name : 'N/A' }}</td>
                            <td>{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}</td>

                                {{-- @if($application && ($application->offer_accepted_date || $application->created_at))
                                    {{ $application && $application->offer_accepted_date
                                        ? \Carbon\Carbon::parse($application->offer_accepted_date)->format('d/m/Y')
                                        : ($application && $application->created_at
                                            ? \Carbon\Carbon::parse($application->created_at)->format('d/m/Y')
                                            : 'N/A')
                                    }}
                                @else
                                    N/A
                                @endif --}}

                        </tr>
                    @endfor
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No results found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Pagination + Results -->
    <div class="d-flex justify-content-between align-items-center mx-5 my-4">
        <div class="d-flex gap-5 align-items-center">
            <form id="perPageForm" method="GET" class="d-flex align-items-center gap-2">
                <input type="hidden" name="tab" value="{{ $tab ?? 'candidate' }}">
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
