<section class="job-application-section d-grid">
    <div class="left-side">
        <h3 class="top-heading m-0 mb-5">Applicant's Details</h3> 
        @foreach ($jobOpeningApplication->user->employments as $key => $employment)
            <div class="box mb-5">
                <div class="current-workplace-div">
                    <h4 class="heading-box d-flex align-items-center gap-3">
                        Working Experience {{ $key + 1 }} @if($employment->end_date == '0000-00-00' || !isset($employment->end_date)) <span class="fw-medium job-applied">Current Workplace</span> @endif
                    </h4>
                    <div class="inner-content">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="card-info-p fw-normal mb-1">Job Title</p>
                                <h5 class="fw-medium">{{ $employment->job_title ?? '' }}</h5>
                            </div>
                            <div class="col-md-6">
                                <p class="card-info-p fw-normal mb-1">Company Name</p>
                                <h5 class="fw-medium">{{ $employment->company_name ?? '' }}</h5>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <!-- <div class="col-md-6">
                                <p class="card-info-p fw-normal mb-1">Company Location</p>
                                <h5 class="fw-medium">{{ $employment->company_location ?? '' }}</h5>
                            </div> -->
                            <div class="col-md-6">
                                <p class="card-info-p fw-normal mb-1">Years of Work</p>
                                <h5 class="fw-medium">{{ $employment->year_of_work ?? '' }} Years</h5>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <p class="card-info-p fw-normal mb-1">Start Date</p>
                                <h5 class="fw-medium">{{ $employment->start_date ?? '' }}</h5>
                            </div>
                            <div class="col-md-6">
                                <p class="card-info-p fw-normal mb-1">End Date</p>
                                @if ((!$employment->end_date) || ($employment->end_date == '0000-00-00'))
                                   <h5 class="fw-medium">Currently working here</h5>
                                @else
                                   <h5 class="fw-medium">{{ $employment->end_date ?? '' }}</h5>
                                @endif
                                
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="card-info-p fw-normal mb-1">Soft skills involved</p>
                            <div class="d-flex gap-3 align-items-center">
                                @foreach ($employment->softSkills as $softSkill)
                                   <span class="skill-badge">{{ $softSkill->masterSkill->name ?? '' }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="card-info-p fw-normal mb-1">Technical skills involved</p>
                            <div class="d-flex gap-3 align-items-center">
                                @foreach ($employment->technicalSkills as $technicalSkill)
                                   <span class="skill-badge">{{ $technicalSkill->masterTechnicalSkill->name ?? '' }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <h3 class="top-heading m-0 mb-5">Activity Log</h3>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="border-right: 0;">
                            Description</th>
                        <th scope="col text-center" style="border-left: 0;">
                            <p class="text-center m-0">Date</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activityLogs as $activity)
                        <tr>
                            <td>{{ $activity->action ?? '' }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($activity->created_at)->format('m/d/Y h:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
                            <p class="card-info-p dark-grey fw-normal mb-1">{{ $jobOpeningApplication->user->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="card-info-p fw-normal mb-1">Phone Number</p>
                        </div>
                        <div class="col-md-7">
                            <p class="card-info-p dark-grey fw-normal mb-1">{{ $jobOpeningApplication->user->mobile_number ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <!-- <p class="card-info-p fw-normal mb-1">Current Location</p> -->
                            <p class="card-info-p fw-normal mb-1">City</p>
                        </div>
                        <div class="col-md-7">
                            <p class="card-info-p dark-grey fw-normal mb-1">{{ $jobOpeningApplication->user->cityName->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="card-info-p fw-normal mb-1">Nationality</p>
                        </div>
                        <div class="col-md-7">
                            <p class="card-info-p dark-grey fw-normal mb-1">{{ $jobOpeningApplication->user->country->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p class="card-info-p fw-normal mb-1">Address</p>
                        </div>
                        <div class="col-md-7">
                            <p class="card-info-p dark-grey fw-normal mb-1">{{ $jobOpeningApplication->user->home_address ?? 'N/A' }}, {{ $jobOpeningApplication->user->cityName->name ?? 'N/A' }}, {{ $jobOpeningApplication->user->state->name ?? 'N/A' }}, {{ $jobOpeningApplication->user->country->name ?? 'N/A' }}</p>
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
                            <p class="card-info-p dark-grey fw-normal mb-1">
                               {{ config('helpers.work_authorization')[$jobOpeningApplication->user->work_authorization ?? 0] }}
                            </p>
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
