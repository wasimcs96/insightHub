  <section class="top-card bg-white">
    <div class="d-flex justify-content-between mb-30px">
        <div class="card-info card-info d-flex flex-column gap-16px">
            <p class="m-0 card-info-p fw-normal">{{ $department->name ?? '-' }}</p>
            <h1 class="m-0 d-flex gap-16px">{{ $jobOpening->job_title ?? '-' }} <span class="badge fw-bold w-auto @if($jobOpening->status == 1) status-ready 
                        @elseif($jobOpening->status == 2 ) status-active 
                        @elseif($jobOpening->status == 3 ) status-expired 
                        @elseif($jobOpening->status == 4) status-filled 
                        @elseif($jobOpening->status == 5) status-draft 
                        @endif">{{ config('helpers.status_of_job')[$jobOpening->status] }}</span>
            </h1>
            <div class="d-flex align-items-center gap-16px">
                <div class="d-flex align-items-center gap-1">
                    <iconify-icon icon="lucide:briefcase" width="16" height="16"
                        style="color:#99A1B7;"></iconify-icon>
                    <p class="m-0 card-info-p fw-normal">{{ in_array($jobOpening->employment_type,[1,2]) ? config('helpers.job_advertisement_employment_type')[$jobOpening->employment_type]:'-' }}</p>
                </div>
                <div class="d-flex align-items-center gap-1">
                    <iconify-icon icon="fa-solid:money-bill" width="16" height="16"
                        style="color:#99A1B7;"></iconify-icon>
                    <p class="m-0 card-info-p fw-normal">{{ $jobOpening->currency_short_name ?? 'RM' }} {{ $jobOpening->salary_lower_bound ?? '0' }} - {{ $jobOpening->salary_upper_bound ?? '0' }}</p>
                </div>
                <div class="d-flex align-items-center gap-1">
                    <iconify-icon icon="basil:location-outline" width="16" height="16"
                        style="color:#99A1B7;"></iconify-icon>
                    <p class="m-0 card-info-p fw-normal">{{ $state && $state->name ? $state->name.',':($province && $province->name ? $province->name.',':'') }} {{ $country->name ?? '-' }}</p>
                </div>
                <div class="d-flex align-items-center gap-1">
                    <iconify-icon icon="mdi:clock-outline" width="16" height="16"
                        style="color:#99A1B7;"></iconify-icon>
                    <p class="m-0 card-info-p fw-normal">Date Created: {{ $jobOpening->created_at ? App\Helpers\HelperFunctions::formatCreatedAtDate($jobOpening->created_at):'' }}</p>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <p class="m-0 card-info-p fw-normal">Application Period: {{ $jobOpening->application_period_start_date ? App\Helpers\HelperFunctions::formatCreatedAtDate($jobOpening->application_period_start_date):'' }} - {{ $jobOpening->application_period_end_date ? App\Helpers\HelperFunctions::formatCreatedAtDate($jobOpening->application_period_end_date):'' }}</p>
                <span class="line-vertical"></span>
                <div class="d-flex align-items-center gap-1">
                    <p class="m-0 card-info-p fw-normal">Total Vacancies: <span class="vacancy-number fw-bold">{{ $jobOpening->vacancies ?? '0' }}</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="card-info-btn d-flex gap-3">
            <button class="btn-orange fw-bold bg-white" onclick="window.open('{{ route('job-details', $jobOpening->slug) }}', '_blank')">
                View Job Posting
            </button>
            <button type="button" class="btn-action fw-bold bg-white" data-kt-menu-trigger="click"
                data-kt-menu-placement="bottom-start"><iconify-icon icon="ph:dots-three-outline-bold" width="16"
                    height="16" style="color: #78829D;"></iconify-icon> More Action</button>
                    @php
                    $status = config('helpers.status_of_job')[$jobOpening->status]; // Assuming status is stored in the jobOpening model
                @endphp
                
                <div class="menu menu-sub menu-sub-dropdown p-3 text-left drop-content mt-3" data-kt-menu="true">
                    <div>
                        <ul class="list-unstyled mb-0">
                            @if(in_array($status, ['Ready', 'Active', 'Expired']))
                                <li><a href="/admin/talent-acquisition/job-board/create-job-advertisement?step=7&jobId={{$jobOpening->job_id}}&jobOpeningId={{$jobOpening->id}}&edit=true" class="d-block p-4 text-dark text-decoration-none text-left">Edit</a></li>
                            @endif
                
                            @if($status == 'Ready')
                                <li data-bs-toggle="modal" data-bs-target="#LaunchAdvertisement" ><a href="#" class="d-block p-4 text-dark text-decoration-none text-left">Launch Advertisement</a></li>
                                <li data-bs-toggle="modal" data-bs-target="#ModifyApplicationDate"><a href="#"
                                    class="d-block p-4 text-dark text-decoration-none text-left">Modify
                                    Application Dates</a></li>
                            @endif
                
                            @if($status == 'Active')
                                <li>
                                    <a href="#" class="copyLink d-block p-4 text-dark text-decoration-none text-left"
                                        data-link="{{ route('job-details', $jobOpening->slug) }}">
                                        Copy Job Posting Link
                                    </a>
                                </li>
                                <li data-bs-toggle="modal" data-bs-target="#ModifyApplicationDate"><a href="#"
                                    class="d-block p-4 text-dark text-decoration-none text-left">Modify
                                    Application Dates</a></li>
                                <li data-bs-toggle="modal" data-bs-target="#AddToExpiry"><a href="#" class="d-block p-4 text-dark text-decoration-none text-left">Set Ad to Expired</a></li>
                            @endif
                
                            @if($status == 'Expired')
                                <li data-bs-toggle="modal" data-bs-target="#ExtendExpiryDate"><a href="#" class="d-block p-4 text-dark text-decoration-none text-left">Extend Expiry Date</a></li>
                            @endif
                
                            @if($status == 'Filled')
                                <li><a href="#" class="d-block p-4 text-dark text-decoration-none text-left">Reuse this advertisement</a></li>
                            @endif
                
                            <li data-bs-toggle="modal" data-bs-target="#DeleteModal"><a href="#" class="d-block p-4 text-danger text-decoration-none text-left">Delete</a></li>
                        </ul>
                    </div>
                </div>
        </div>
    </div>
    <div class="tabs-div">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link bg-white fw-bold rounded-0 @if($page == 'job-information') active @endif @if($page == '') active @endif" href="{{ route('admin.talent-acquisition.job-advertisement.detail', ['id' => $jobOpening->id, 'page' => 'job-information']) }}">Job Information</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link bg-white fw-bold rounded-0 @if($page == 'all-applicants') active @endif" href="{{ route('admin.talent-acquisition.job-advertisement.detail', ['id' => $jobOpening->id, 'page' => 'all-applicants']) }}">All Applicants</a>
            </li>
            <li class="nav-item" role="presentation">
               <a class="nav-link bg-white fw-bold rounded-0 @if($page == 'hiring-pipeline') active @endif" href="{{ route('admin.talent-acquisition.job-advertisement.detail', ['id' => $jobOpening->id, 'page' => 'hiring-pipeline']) }}">Hiring Pipeline</a>
            </li>
            @if ($jobOpening->status == 4)
                <li class="nav-item" role="presentation">
                    <a class="nav-link bg-white fw-bold rounded-0 @if($page == 'report') active @endif" href="{{ route('admin.talent-acquisition.job-advertisement.detail', ['id' => $jobOpening->id, 'page' => 'report']) }}">Report</a>
                </li>
            @endif
        </ul>
    </div>
</section>
<div class="tab-content" id="pills-tabContent">

    @switch($page)
        @case('job-information')
            <div class="tab-pane show active" id="job-information" role="tabpanel"
                aria-labelledby="job-information-tab" tabindex="0">
                @include('admin.talent-acquisition.job-advertisement.job-information.job-information')
            </div>
        @break

        @case('all-applicants')
            <div class="tab-pane show active" id="all-applicants" role="tabpanel" aria-labelledby="all-applicants-tab"
                tabindex="0">
                @include('admin.talent-acquisition.job-advertisement.all-applicants.all-applicants')
            </div>
        @break

        @case('hiring-pipeline')
            <div class="tab-pane show active" id="hiring-pipeline" role="tabpanel" aria-labelledby="hiring-pipeline-tab"
                tabindex="0">
                @include('admin.talent-acquisition.job-advertisement.hiring-pipeline.hiring-pipeline')
            </div>
        @break

        @case('report')
            <div class="tab-pane show active" id="report" role="tabpanel" aria-labelledby="report-tab"
                tabindex="0">
                @include('admin.talent-acquisition.job-advertisement.report-tab.report')
            </div>
        @break

        @default
            <div class="tab-pane fade show active" id="job-information" role="tabpanel"
                aria-labelledby="job-information-tab" tabindex="0">
                @include('admin.talent-acquisition.job-advertisement.job-information.job-information')
            </div>
    @endswitch 
</div>
