<div class="table-container">
    <table class="table mb-0">
        <thead>
            <tr>
                <th>Job Title</th>
                <th>Last Saved</th>
                <th class="text-center">Vacancies</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jobOpenings as $job)
            <tr id="job-row-{{ $job->id }}">
                <td>{{ $job->job_title }} <i class="text-muted">-draft</i></td>
                <td>{{ App\Helpers\HelperFunctions::formatCreatedAtDate($job->updated_at) }}</td>
                <td class="text-center">{{ $job->vacancies }}</td>
                <td class="text-center">
                    <button class="btn action-btn p-0 border-0 bg-transparent" data-bs-toggle="dropdown" aria-expanded="false">
                        <iconify-icon icon="ph:dots-three-outline-vertical-bold" width="16" height="16"></iconify-icon>
                    </button>
                    <ul class="dropdown-menu p-3 text-left" aria-labelledby="dropdownMenuButton">
                        <li>
                            @php
                                if ($job->steps_completed == 8) {
                                    $baseUrl = '/admin/talent-acquisition/job-board/create-job-advertisement/job-posting-preview-page';
                                    $queryParams = [
                                        'step' => $job->steps_completed,
                                        'jobId' => $job->job_id,
                                        'jobOpeningId' => $job->id,
                                    ];
                                } else {
                                    $baseUrl = '/admin/talent-acquisition/job-board/create-job-advertisement';
                                    $queryParams = [
                                        'step' => $job->steps_completed,
                                        'jobId' =>  $job->job_id,
                                        'jobOpeningId' => $job->id,
                                        'draft' => 'true'
                                    ];
                                    $url = url($baseUrl . '?' . http_build_query($queryParams));
                                }
                            
                                if ($job->steps_completed == 8) {
                                    $url = url($baseUrl . '?' . http_build_query($queryParams));
                                }
                            @endphp
                        
                            <a href="{{ $url }}" class="d-block p-4 text-dark text-decoration-none text-left hover-effect">Continue Editing</a>          
                            {{-- <a href="{{ $job->steps_completed == 8 ? url('/admin/talent-acquisition/job-board/create-job-advertisement/job-posting-preview-page?step=' . $job->steps_completed . '&jobId=' . $job->job_id . '&jobOpeningId=' . $job->id ) : url('/admin/talent-acquisition/job-board/create-job-advertisement?step=' . $job->steps_completed . '&jobId=' . $job->job_id . '&jobOpeningId=' . $job->id) }}" class="d-block p-4 text-dark text-decoration-none text-left hover-effect">Continue Editing</a> --}}
                        </li>
                        <li data-bs-toggle="modal" data-bs-target="#DeleteDraftModal" data-job-id="{{ $job->id }}">
                            <a href="#" class="d-block p-4 text-danger text-decoration-none text-left hover-effect">Delete</a>
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
        <select class="form-select form-select-sm page-input-box rowsPerPageJobOpening" data-tab="draft" id="rowsPerPage_draft" name="per_page_job">
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