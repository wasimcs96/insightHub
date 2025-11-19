<section class="job-application-section d-grid"> 
    <div class="left-side">
        @if($jobOpeningApplication->user->cv_resume)
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h3 class="top-heading m-0">Resume</h3>
            <a href="{{ asset($jobOpeningApplication->user->cv_resume) }}" download>
                <button type="button" class="btn-action fw-bold bg-white">
                    <iconify-icon icon="material-symbols:download-rounded" width="16" height="16" style="color: #78829D;"></iconify-icon>
                    Download
                </button>
            </a>
        </div>

        <!-- <div class="mb-10 p-0">
            <div class="current-workplace-div">
                <iframe src="{{ asset($jobOpeningApplication->user->cv_resume ?? '/admin/media/stock/documents-frame.png') }}" style="width: 100%; height: 100%"></iframe>
            </div>
        </div> -->

        @endif
        @if($jobOpeningApplication->cover_letter)
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h3 class="top-heading m-0">Cover Letter</h3>
            <a href="{{ asset($jobOpeningApplication->cover_letter) }}" download>
                <button type="button" class="btn-action fw-bold bg-white"><iconify-icon
                        icon="material-symbols:download-rounded" width="16" height="16"
                        style="color: #78829D;"></iconify-icon> Download</button>
            </a>
        </div>
        <!-- <div class="mb-10 p-0">
            <div class="current-workplace-div">
               <iframe src="{{ asset($jobOpeningApplication->user->cv_resume ?? '/admin/media/stock/documents-frame.png') }}" style="width: 100%; height: 100%"></iframe>
            </div>
        </div> -->
        @endif

        @foreach($jobOpeningApplication->jobOpeningApplicationUserDocuments as $document)
         
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h3 class="top-heading m-0">{{ $document->jobOpeningApplicationDocument->name ?? '' }}</h3>
                <a href="{{ asset($document->document ?? '/admin/media/stock/documents-frame.png') }}">
                    <button type="button" class="btn-action fw-bold bg-white"><iconify-icon
                            icon="material-symbols:download-rounded" width="16" height="16"
                            style="color: #78829D;"></iconify-icon> Download</button>
                </a>
            </div>
            <!-- <div class="mb-10 p-0">
                <div class="current-workplace-div">
                    <img src="{{ asset($document->document ?? '/admin/media/stock/documents-frame.png') }}" alt="Document" class="w-100">
                </div>
            </div> -->
        @endforeach

    </div>
    <div class="right-side">
        <div class="box mt-13">
            <div class="current-workplace-div">
                <h4 class="heading-box">
                    Personal Information
                </h4>
                <div class="inner-content">
                    <div class="row">
                        <div class="col-md-5">
                            <p class="card-info-p fw-normal mb-1">Email</p>
                        </div>
                        <div class="col-md-7">
                            <p class="card-info-p dark-grey fw-normal mb-1">{{ $jobOpeningApplication->user->email ?? ' ' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="card-info-p fw-normal mb-1">Phone Number</p>
                        </div>
                        <div class="col-md-7">
                            <p class="card-info-p dark-grey fw-normal mb-1">{{ $jobOpeningApplication->user->mobile_number ?? ' ' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <!-- <p class="card-info-p fw-normal mb-1">Current Location</p> -->
                            <p class="card-info-p fw-normal mb-1">City</p>
                        </div>
                        <div class="col-md-7">
                            <p class="card-info-p dark-grey fw-normal mb-1">{{ $jobOpeningApplication->user->city->name ?? ' ' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="card-info-p fw-normal mb-1">Nationality</p>
                        </div>
                        <div class="col-md-7">
                            <p class="card-info-p dark-grey fw-normal mb-1">{{ $jobOpeningApplication->user->country->name ?? ' ' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="card-info-p fw-normal mb-1">Address</p>
                        </div>
                        <div class="col-md-7">
                            <p class="card-info-p dark-grey fw-normal mb-1">{{ $jobOpeningApplication->user->home_address ?? ' ' }}, {{ $jobOpeningApplication->user->city->name ?? ' ' }}, {{ $jobOpeningApplication->user->state->name ?? ' ' }}, {{ $jobOpeningApplication->user->country->name ?? ' ' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box my-5">
            <div class="current-workplace-div">
                <h4 class="heading-box">
                    Education Information
                </h4>
                <div class="inner-content">
                    <div class="row">
                        <div class="col-md-5">
                            <p class="card-info-p fw-normal mb-1">Education Level</p>
                        </div>
                        <div class="col-md-7">
                            <p class="card-info-p dark-grey fw-normal mb-1">{{ $jobOpeningApplication->user->educationLevel->name ?? '' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="card-info-p fw-normal mb-1">Year Graduation</p>
                        </div>
                        <div class="col-md-7">
                            <p class="card-info-p dark-grey fw-normal mb-1">{{ $jobOpeningApplication->user->graduate_year ?? '' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="card-info-p fw-normal mb-1">Education Institution</p>
                        </div>
                        <div class="col-md-7">
                            <p class="card-info-p dark-grey fw-normal mb-1">{{ $jobOpeningApplication->user->higherLearning->name ?? '' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="card-info-p fw-normal mb-1">Education Program</p>
                        </div>
                        <div class="col-md-7">
                            <p class="card-info-p dark-grey fw-normal mb-1">{{ $jobOpeningApplication->user->educationProgram->name ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="current-workplace-div">
                <h4 class="heading-box">
                    Job Preference
                </h4>
                <div class="inner-content">
                    <div class="row">
                        <div class="col-md-5">
                            <p class="card-info-p fw-normal mb-1">Work Experience</p>
                        </div>
                        <div class="col-md-7">
                            <p class="card-info-p dark-grey fw-normal mb-1">{{ $jobOpeningApplication->user->year_of_experience_in_it_sector ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="card-info-p fw-normal mb-1">Work Authorisation</p>
                        </div>
                        <div class="col-md-7">
                            <p class="card-info-p dark-grey fw-normal mb-1">{{ $jobOpeningApplication->user->work_authorization ?? 0 }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="card-info-p fw-normal mb-1">Preferred Working Locations</p>
                        </div>
                        <div class="col-md-7">
                            @foreach ($jobOpeningApplication->user->preferredLocations as $preferredLocation)
                                <p class="card-info-p dark-grey fw-normal mb-1">
                                    {{ $preferredLocation->masterCity->name ?? '' }}, {{ $preferredLocation->masterCountry->name ?? '' }}
                                </p>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="card-info-p fw-normal mb-1">Preferred Job</p>
                        </div>
                        <div class="col-md-7">
                            <p class="card-info-p dark-grey fw-normal mb-1">Software Engineer</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="card-info-p fw-normal mb-1">Expected Salary ({{ $jobOpeningApplication->jobOpening->currency_short_name ?? 'MYR' }})</p>
                        </div>
                        <div class="col-md-7">
                            <p class="card-info-p dark-grey fw-normal mb-1">{{ $jobOpeningApplication->salary_lower_bound ?? 0}} - {{ $jobOpeningApplication->salary_upper_bound ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
