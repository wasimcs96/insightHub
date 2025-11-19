<div class="table-container">
    <table class="table mb-0">
        <thead>
            <tr>
                <th>Job Title</th>
                <th class="text-center">Vacancies</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vacancies as $vacancy)
                <tr>
                        @php
                            $jobOpeningExists = DB::table('job_openings')
                                ->where('job_id', $vacancy->id)
                                ->whereNotIn('status', [3, 4])
                                ->exists();
                        @endphp
                    <td>
                        <span data-bs-toggle="tooltip" 
                            data-bs-placement="top" 
                            title="{{ $vacancy->title }}">
                            {{ Str::limit($vacancy->title, 30) }}
                        </span>
                        @if($vacancy->hasOngoingAdvertisement() == 1)
                            <span style="color: #F7941C">[ads ready]</span>
                        @endif
                        @if($vacancy->hasOngoingAdvertisement() == 2)
                            <span style="color: #F7941C">[ads on-going]</span>
                        @endif
                        @if($vacancy->hasOngoingAdvertisement() == 3)
                            <span style="color: #F7941C">[ads in-draft]</span>
                        @endif
                    </td>                    
                    <td class="text-center">{{ $vacancy->actual_vacant_positions }}</td>
                    <td class="text-center">
                        
                        {{-- Show menu ONLY if job opening with status 3 or 4 does NOT exist --}}
                        @if (!$jobOpeningExists)
                            <button class="btn action-btn p-0 border-0 bg-transparent" data-bs-toggle="dropdown" aria-expanded="false">
                                <iconify-icon icon="ph:dots-three-outline-vertical-bold" width="16" height="16"></iconify-icon>
                            </button>
                            <div class="dropdown-menu p-3 text-left" aria-labelledby="dropdownMenuButton">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="{{ route('admin.talent-acquisition.job-board.create-edit-job-advertisement.create-job-advertisement-page', ['step' => 1, 'jobId' => $vacancy->id, 'create' => 'true']) }}"
                                            class="d-block p-4 text-dark text-decoration-none text-left hover-effect">
                                            Create Job Advertisement
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a href="#" class="d-block p-4 text-dark text-decoration-none text-left" data-bs-toggle="modal" data-bs-target="#ReuseAdvertisement">
                                            Reuse Previous Job Advertisement
                                        </a>
                                    </li> --}}
                                </ul>
                            </div>
                        @endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-9 d-flex justify-content-between align-items-center p-4 pb-5 job-opening-pagination">
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
        {{-- {!! $vacancies->links('pagination::bootstrap-4') !!} --}}

        {{ $vacancies->links() }}
    </nav>
</div>
