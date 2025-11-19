{{-- <div class="left-table">
    <div>
        @foreach ($jobApplications as $application)
            <div class="d-flex align-items-center table-box">
                <div class="date-day">
                    <h5 class="m-0 table-date">{{ \Carbon\Carbon::parse($application->interview_date)->format('d') }}</h5>
                    <p class="m-0 table-day">{{ \Carbon\Carbon::parse($application->interview_date)->format('D') }}</p>
                </div>
                <div class="line"></div>
                <div class="name-info">
                    <p class="m-0 name">{{ $application->external_user_name }}</p>
                    <p class="m-0 time">{{ \Carbon\Carbon::parse($application->interview_date)->format('h:i A') }} – {{ \Carbon\Carbon::parse($application->interview_end_time)->format('h:i A') }}</p>
                    <p class="m-0 position">{{ $application->jobOpening->jobs->title ?? 'N/A' }}</p>
                </div>
                <div class="d-flex gap-4 align-items-center">
                    @if($application->interview_mode == 2)
                        <div class="tag blue">ONLINE</div>
                        <a href="{{ $application->interview_link }}" target="_blank" class="d-flex align-items-center">
                            <iconify-icon icon="material-symbols:link" width="24" height="24" class="icon-link"></iconify-icon>
                        </a>
                    @elseif($application->interview_mode == 1)
                        <div class="tag purple">PHYSICAL</div>
                        <p class="m-0 na-text"></p>
                    @elseif($application->interview_mode == 3)
                        <div class="tag teal">PHONE</div>
                        <p class="m-0 na-text"></p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex align-items-center p-4 pb-0">
        <div class="d-flex align-items-center">
            <span class="page-text">Rows per page</span>
            <select class="form-select form-select-sm page-input-box" name="per_page" id="rowsPerPage">
                <option value="10" {{ request()->per_page == 10 ? 'selected' : '' }}>10</option>
                <option value="20" {{ request()->per_page == 20 ? 'selected' : '' }}>20</option>
                <option value="30" {{ request()->per_page == 30 ? 'selected' : '' }}>30</option>
                <option value="50" {{ request()->per_page == 50 ? 'selected' : '' }}>50</option>
            </select>
        </div>
        <nav>
                {{ $jobApplications->links() }}
        </nav>
    </div>
</div> --}}

<div class="left-table">
    <div>
        @foreach ($jobApplications as $application)
            <div class="d-flex align-items-center table-box" data-id="{{ $application->id }}">
                <div class="date-day">
                    <h5 class="m-0 table-date">{{ \Carbon\Carbon::parse($application->interview_date)->format('d') }}</h5>
                    <p class="m-0 table-day">{{ \Carbon\Carbon::parse($application->interview_date)->format('D') }}</p>
                </div>
                <div class="line"></div>
                <div class="name-info">
                    <p class="m-0 name">{{ $application->external_user_name }}</p>
                    <p class="m-0 time">{{ \Carbon\Carbon::parse($application->interview_date)->format('h:i A') }} – {{ \Carbon\Carbon::parse($application->interview_end_time)->format('h:i A') }}</p>
                    <p class="m-0 position">{{ $application->job_title ?? 'N/A' }}</p>
                </div>
                <div class="d-flex gap-4 align-items-center">
                    @if($application->interview_mode == 2)
                        <div class="tag blue">ONLINE</div>
                        <a href="{{ $application->interview_link ?? '#' }}" target="_blank" class="d-flex align-items-center">
                            <iconify-icon icon="material-symbols:link" width="24" height="24" class="icon-link"></iconify-icon>
                        </a>
                    @elseif($application->interview_mode == 1)
                        <div class="tag purple">PHYSICAL</div>
                    @elseif($application->interview_mode == 3)
                        <div class="tag teal">PHONE</div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex align-items-center p-4 pb-0">
        <div class="d-flex align-items-center">
            <span class="page-text">Rows per page</span>
            <select class="form-select form-select-sm page-input-box" name="per_page" id="rowsPerPage">
                <option value="10" {{ request()->per_page == 10 ? 'selected' : '' }}>10</option>
                <option value="20" {{ request()->per_page == 20 ? 'selected' : '' }}>20</option>
                <option value="30" {{ request()->per_page == 30 ? 'selected' : '' }}>30</option>
                <option value="50" {{ request()->per_page == 50 ? 'selected' : '' }}>50</option>
            </select>
        </div>
        <nav>
            {{ $jobApplications->links() }}
        </nav>
    </div>
</div>
