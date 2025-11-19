<div class="table-container">
    <table class="table mb-0">
        <thead>
            <tr>
                <th>Job Title</th>
                <th class="text-center">Remaining Vacancies</th>
                <th>Hired Count</th>
                <th class="text-center">Applicant’s Count</th>
                <th class="text-center">Ad Status</th>
                <th>Start Date</th>
                <th>Expiry Date</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jobOpenings as $job)
            <tr>
                <td>{{ $job->job_title }}</td>
                @php 
                $hired = $job->job_applications->where('status',12)->count();
                $balance  = $job->vacancies - $hired;
                @endphp
                {{-- <td class="text-center">{{ max($balance,$job->job->vacancy) }}</td> --}}
                <td class="text-center">
                    @if($job->job)
                        {{ max($balance, $job->job->vacancy) }}
                    @else
                        {{ $balance }}
                    @endif
                </td>
                <td class="text-center">{{ $hired }}</td>
                <td class="text-center">{{ $job->job_applications_count }}</td>
                <td class="text-left">
                    <span class="status-badge 
                        @if($job->status == 1) status-ready 
                        @elseif($job->status == 2) status-active 
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
                    // Calculate the expiry date
                    $expiryDate = \Carbon\Carbon::parse($job->application_period_end_date);
                    $remainingVacancies = $balance; // $balance was already calculated in your code
                    $isExpiringSoon = $expiryDate->diffInDays(now()) <= 7 && $remainingVacancies > 0;
                @endphp
                <td>{{ App\Helpers\HelperFunctions::formatCreatedAtDate($job->application_period_start_date) }}</td>
                <td class="text-center 
                    @if($isExpiringSoon) expired-date @endif">
                    {{ App\Helpers\HelperFunctions::formatCreatedAtDate($job->application_period_end_date) }}
                </td>
                <td class="text-center">
                    <button class="btn action-btn p-0 border-0 bg-transparent" data-bs-toggle="dropdown" aria-expanded="false">
                        <iconify-icon icon="ph:dots-three-outline-vertical-bold" width="16" height="16"></iconify-icon>
                    </button>
                    <div class="dropdown-menu p-3 text-left" aria-labelledby="dropdownMenuButton">
                        <ul class="list-unstyled mb-0">
                            <li><a href="{{ route('admin.talent-acquisition.job-advertisement.detail', $job->id) }}" class="d-block p-4 text-dark text-decoration-none text-left hover-effect">View Details</a></li>
                            <li><a href="/admin/talent-acquisition/job-board/create-job-advertisement?step=7&jobId={{$job->job_id}}&jobOpeningId={{$job->id}}&edit=true" class="d-block p-4 text-dark text-decoration-none text-left hover-effect">Edit</a></li>
                            @if($job->status == 2)
                            <li>
                                <a href="#" class="copyLink d-block p-4 text-dark text-decoration-none text-left hover-effect" 
                                   data-link="{{ url('/job-details/' . $job->slug) }}">
                                   Copy Job Posting Link
                                </a>
                            </li>    
                            @endif                       
                            <li><a href="{{ route('job-details',$job->slug) }}" target="_blank" class="d-block p-4 text-dark text-decoration-none text-left hover-effect">View Job Posting</a></li>
                            @if($job->status == 2)
                            <li>
                                <a href="#" class="d-block p-4 text-dark text-decoration-none text-left hover-effect"
                                   data-bs-toggle="modal"
                                   data-bs-target="#ModifyApplicationDate"
                                   data-job-id="{{ $job->id }}"
                                   data-job-title="{{ $job->job_title }}"
                                   data-start-date="{{ $job->application_period_start_date }}"
                                   data-end-date="{{ $job->application_period_end_date }}">
                                   Modify Application Dates
                                </a>
                            </li>
                            @endif
                            
                            
                            <li>
                                @if($job->status == 3)  <!-- Check if the job status is expired (status == 3) -->
                                <a href="#" class="d-block p-4 text-dark text-decoration-none text-left hover-effect"
                                    data-bs-toggle="modal"
                                    data-bs-target="#ExtendExpiryDate"
                                    data-job-id="{{ $job->id }}"
                                    data-job-title="{{ $job->job_title }}"
                                    data-end-date="{{ $job->application_period_end_date }}">
                                    Extend Expiry Date
                                </a>
                                @else
                                <a href="#" class="d-block p-4 text-dark text-decoration-none text-left hover-effect"
                                    data-bs-toggle="modal"
                                    data-bs-target="#AddToExpiry"
                                    data-job-id="{{ $job->id }}"
                                    data-job-title="{{ $job->job_title }}">
                                    Set Ad to Expired
                                </a>
                                @endif
                            </li>
                            <li>
                                <a href="#" class="d-block p-4 text-danger text-decoration-none text-left hover-effect delete-job"
                                    data-bs-toggle="modal"
                                    data-bs-target="#DeleteModal"
                                    data-job-id="{{ $job->id }}"
                                    data-job-title="{{ $job->job_title }}">
                                    Delete
                                </a>
                            </li>
                            
                            
                        </ul>
                    </div>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination controls -->
<div class="mt-9 d-flex justify-content-between align-items-center p-4 pb-5 job-opening-pagination">
    <div class="d-flex align-items-center">
        <span class="page-text">Rows per page</span>
        <select class="form-select form-select-sm page-input-box rowsPerPageJobOpening" data-tab="ongoing" id="rowsPerPage_ongoing" name="per_page_job">
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
