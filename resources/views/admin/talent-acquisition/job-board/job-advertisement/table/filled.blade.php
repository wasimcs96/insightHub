<div class="table-container">
    <table class="table mb-0">
        <thead>
            <tr>
                <th>Job Title</th>
                <th>Ad Created</th>
                <th class="text-center">Ad Status</th>
                <th class="text-center">Hired Employee</th>
                <th>Start Date</th>
                <th>Expiry Date</th>
                <th class="text-center">Time to Fill</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jobOpenings as $job)
            <tr>
                <td>{{ $job->job_title }}</td>
                <td>{{ App\Helpers\HelperFunctions::formatCreatedAtDate($job->created_at) }}</td>
                <td class="text-left">
                    <span class="status-badge 
                        @if($job->status == 1) status-ready 
                        @elseif($job->status == 2 ) status-active 
                        @elseif($job->status == 3 ) status-expired 
                        @elseif($job->status == 4) status-filled 
                        @elseif($job->status == 5) status-draft 
                        @endif">
                        @if($job->status == 1) READY 
                        @elseif($job->status == 2 ) ACTIVE 
                        @elseif($job->status == 3 ) EXPIRED 
                        @elseif($job->status == 4) FILLED 
                        @elseif($job->status == 5) DRAFT 
                        @endif
                    </span>
                </td>
                @php 
                    $hired = $job->job_applications->where('status',8)->count();
                    $remainingVacancies = $job->vacancies - $hired;
                    $expiryDate = \Carbon\Carbon::parse($job->application_period_end_date);
                    $isExpiringSoon = $expiryDate->diffInDays(now()) <= 7 && $remainingVacancies > 0;
                    $hirecount = $job->job_applications->where('status',12)->count();
                @endphp
                <td class="text-center">{{ $hirecount }}</td>
                <td>{{ App\Helpers\HelperFunctions::formatCreatedAtDate($job->application_period_start_date) }}</td>
                <td class="text-left @if($isExpiringSoon) expired-date @endif">
                    {{ App\Helpers\HelperFunctions::formatCreatedAtDate($job->application_period_end_date) }}
                </td>
                <td class="text-left">
                    <span class="status-badge status-active">
                        {{ App\Helpers\HelperFunctions::countDaysBetween($job->application_period_start_date, $job->application_filled_date) }} days
                    </span>
                </td>
                <td class="text-center">
                    <button class="btn action-btn p-0 border-0 bg-transparent" data-bs-toggle="dropdown" aria-expanded="false">
                        <iconify-icon icon="ph:dots-three-outline-vertical-bold" width="16" height="16"></iconify-icon>
                    </button>
                    <ul class="dropdown-menu p-3 text-left" aria-labelledby="dropdownMenuButton">
                        <li><a href="{{ route('admin.talent-acquisition.job-advertisement.detail', ['id' => $job->id, 'page' => 'report']) }}" class="d-block p-4 text-dark text-decoration-none text-left hover-effect">View Report</a></li>
                        <li><a href="{{ route('admin.talent-acquisition.job-advertisement.detail', $job->id) }}" class="d-block p-4 text-dark text-decoration-none text-left hover-effect">View Details</a></li>
                        <li><a href="{{ route('job-details',$job->slug) }}" class="d-block p-4 text-dark text-decoration-none text-left hover-effect">View Job Posting</a></li>
                        {{-- <li data-bs-toggle="modal" data-bs-target="#ReuseJobAdvertisement">
                            <a href="#" class="d-block p-4 text-dark text-decoration-none text-left hover-effect" id="reuseAdvertisement-{{ $job->id }}" 
                                data-bs-toggle="modal"
                                data-bs-target="#ReuseJobAdvertisement"
                                onclick="setJobIds({{ $job->job_id }}, {{ $job->id }})">
                                Reuse this advertisement
                            </a>
                        </li> --}}
                        
                        @if($job->job && $job->job->vacancy > 0)
                            <li data-bs-toggle="modal" data-bs-target="#ReuseJobAdvertisement">
                                <a href="#" class="d-block p-4 text-dark text-decoration-none text-left hover-effect" id="reuseAdvertisement-{{ $job->id }}" 
                                    data-bs-toggle="modal"
                                    data-bs-target="#ReuseJobAdvertisement"
                                    onclick="setJobIds({{ $job->job_id }}, {{ $job->id }})">
                                    Reuse this advertisement
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="#" class="d-block p-4 text-danger text-decoration-none text-left delete-job hover-effect"
                                data-bs-toggle="modal"
                                data-bs-target="#DeleteModal"
                                data-job-id="{{ $job->id }}"
                                data-job-title="{{ $job->job_title }}">
                                Delete
                            </a>
                        </li>
                        
                    </ul>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-9 d-flex justify-content-between align-items-center p-4 pb-5 job-opening-pagination">
    <div class="d-flex align-items-center">
        <span class="page-text">Rows per page</span>
        <select class="form-select form-select-sm page-input-box rowsPerPageJobOpening" data-tab="filled" id="rowsPerPage_filled" name="per_page_job">
            <option value="10" {{ request()->per_page_job_opening == 10 ? 'selected' : '' }}>10</option>
            <option value="20" {{ request()->per_page_job_opening == 20 ? 'selected' : '' }}>20</option>
            <option value="30" {{ request()->per_page_job_opening == 30 ? 'selected' : '' }}>30</option>
            <option value="50" {{ request()->per_page_job_opening == 50 ? 'selected' : '' }}>50</option>
        </select>
    </div>
        <nav>
            {{ $jobOpenings->links() }}
        </nav>
</div>

<script>
    function setJobIds(jobId, jobOpeningId) {
        console.log('Job ID:', jobId);
        console.log('Job Opening ID:', jobOpeningId);
    
        window.jobId = jobId;
        window.jobOpeningId = jobOpeningId;
    }

</script>

