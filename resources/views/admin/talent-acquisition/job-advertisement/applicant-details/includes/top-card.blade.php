<section class="top-card bg-white">
    <div class="d-flex justify-content-between mb-30px">
        <div class="d-flex align-items-center gap-8">
            <img src="{{ asset($jobOpeningApplication->user->profile_picture ?? 'images/default-user.svg') }}" alt="cancel" style="width: 100px; height: 100px; object-fit: cover;" >
            <div class="card-info card-info d-flex flex-column gap-16px">
                <h1 class="m-0 d-flex gap-16px">{{ $jobOpeningApplication->user->name ?? '' }}
                     {{-- <span class="badge fw-bold w-auto filled">HIRING STAGE:
                        OFFER STAGE</span> --}}
                </h1>
                <div class="d-flex align-items-center gap-16px">
                    <div class="d-flex align-items-center gap-1">
                        @if($isMultipleJobOpeningApplicationsExists)
                           <select name="job_opening" id="job_opening" value="{{ $jobOpeningApplication->job_opening_id ?? '' }}">
                                  <option value="{{ $jobOpeningApplication->job_opening_id ?? '' }}">{{ $jobOpeningApplication->jobOpening->job_title ?? '' }}</option>
                                  @foreach($jobOpeningApplications as $jobOpeningApp)
                                     <option value="{{ $jobOpeningApp->job_opening_id ?? '' }}">{{ $jobOpeningApp->jobOpening->job_title ?? '' }}</option>
                                  @endforeach
                           </select>
                        @else
                           <p class="m-0 card-info-p fw-normal">Job Applied: <span class="fw-bold job-applied">{{ $jobOpeningApplication->jobOpening->job_title ?? '' }}</span></p>
                        @endif
                        
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <p class="m-0 card-info-p fw-normal d-flex align-items-center gap-2">Interview Performance: <span
                            class="badge fw-bold w-auto {{ config('helpers.applicant_details_positive_levels_class')[$jobOpeningApplication->interview_performance ?? 0] }}">{{ config('helpers.applicant_details_classifications')[$jobOpeningApplication->interview_performance ?? 0] }}</span></p>
                    <span class="line-vertical"></span>
                    <p class="m-0 card-info-p fw-normal d-flex align-items-center gap-2">Overall Match Rate: <span
                            class="badge fw-bold w-auto {{ config('helpers.applicant_details_positive_levels_class')[$omr ?? 0] }}">{{ config('helpers.applicant_details_classifications')[$omr ?? 0] }}</span></p>
                    <span class="line-vertical"></span>
                    <p class="m-0 card-info-p fw-normal d-flex align-items-center gap-2">Suitability Rate: <span
                            class="badge fw-bold w-auto {{ config('helpers.applicant_details_positive_levels_class')[$suitabilityRateLevel ?? 0] }}">{{ $jobOpeningApplication->suitability_rate ?? 0 }}%</span></p>
                </div>
            </div>
        </div>
        <div class="card-info-btn d-flex gap-3">
                <a href="{{ route('admin.candidate.details.download_report', ['employee_id' => $candidate->id, 'job_opening_id' => $jobOpeningApplication->job_opening_id]) }}"
                    class="email-button">
                    <button type="button" class="btn-orange fw-bold bg-white d-flex align-items-center gap-2">
                        <iconify-icon icon="material-symbols:download" width="16" height="16"
                            style="color: #F7941C;"></iconify-icon>
                        Download Report
                    </button>
                </a>
                <a href="mailto:{{ $jobOpeningApplication->user->email ?? '' }}?subject=Subject%20Here&body=Body%20text%20here" class="email-button">
                    <button type="button" class="btn-orange fw-bold bg-white">
                    <iconify-icon icon="tabler:send" width="16" height="16" style="color: #F7941C;"></iconify-icon>
                    Send Email</button>
                </a>
        </div>
    </div>
    <div class="tabs-div">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link bg-white fw-bold rounded-0 @if($page == 'job-application') active @endif @if($page == '') active @endif" href="{{ route('admin.talent-acquisition.job-advertisement.detail.applicant-details', ['id' => $jobOpeningApplication->job_opening_id,'applicant_id' => $jobOpeningApplication->user_id, 'page' => 'job-application']) }}">Job Application</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link bg-white fw-bold rounded-0 @if($page == 'documents') active @endif" href="{{ route('admin.talent-acquisition.job-advertisement.detail.applicant-details', ['id' => $jobOpeningApplication->job_opening_id,'applicant_id' => $jobOpeningApplication->user_id, 'page' => 'documents']) }}">Documents</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link bg-white fw-bold rounded-0 @if($page == 'psychometric') active @endif" href="{{ route('admin.talent-acquisition.job-advertisement.detail.applicant-details', ['id' => $jobOpeningApplication->job_opening_id,'applicant_id' => $jobOpeningApplication->user_id, 'page' => 'psychometric']) }}">Psychometric</a>
            </li>
            <li class="nav-item" role="presentation">
                 <a class="nav-link bg-white fw-bold rounded-0 @if($page == 'job-centric-report') active @endif" href="{{ route('admin.talent-acquisition.job-advertisement.detail.applicant-details', ['id' => $jobOpeningApplication->job_opening_id,'applicant_id' => $jobOpeningApplication->user_id, 'page' => 'job-centric-report']) }}">Job Centric Assessment Report</a>
            </li>
 
        </ul>

    </div>
</section>
<div class="tab-content" id="pills-tabContent">
    @switch($page)
        @case('job-application')
            <div class="tab-pane show active" id="applicant-job-application" role="tabpanel"
                aria-labelledby="applicant-job-application-tab" tabindex="0">
                @include('admin.talent-acquisition.job-advertisement.applicant-details.includes.job-application')
            </div>
        @break

        @case('documents')
            <div class="tab-pane show active" id="applicant-documents" role="tabpanel" aria-labelledby="applicant-documents-tab"
                tabindex="0">
                @include('admin.talent-acquisition.job-advertisement.applicant-details.includes.documents')
            </div>
        @break

        @case('psychometric')
            <div class="tab-pane show active" id="applicant-psychometric" role="tabpanel" aria-labelledby="applicant-psychometric-tab"
                tabindex="0">
                @include('admin.talent-acquisition.job-advertisement.applicant-details.includes.psychometric')
            </div>
        @break

        @case('job-centric-report')
            <div class="tab-pane show active" id="job-centric-assessment-report" role="tabpanel"
                aria-labelledby="job-centric-assessment-report-tab" tabindex="0">
                @include('admin.talent-acquisition.job-advertisement.applicant-details.includes.job-centric-report')
            </div>
        @break

        @default
            <div class="tab-pane show active" id="applicant-job-application" role="tabpanel"
                aria-labelledby="applicant-job-application-tab" tabindex="0">
                @include('admin.talent-acquisition.job-advertisement.applicant-details.includes.job-application')
            </div>
    @endswitch 
</div>
