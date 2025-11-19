<div class="" id="review-details" aria-labelledby="review-details-tab"
            tabindex="0">
    <div class="top-content">
        <h3>Review Details</h3>
        <p>Review the details of your job advertisement carefully and make any necessary edits to attract the
            best candidates.</p>
    </div>
    <form >
        <input type="hidden" name="jobOpeningId" id="jobOpeningId" value="{{ $jobOpeningId }}">
        <input type="hidden" name="jobId" id="jobId" value="{{ $jobId }}">
        <div class="row g-3">
            <div class="col-md-12">
                <div class="accordion mt-5 review-card" id="VacancyDetails">
                    <div class="accordion-item">
                        <div class="d-flex justify-content-between align-items-center accordion-header after-align">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseVacancyDetails" aria-expanded="true"
                                aria-controls="collapseVacancyDetails">
                                Vacancy Details
                            </button>
                            <button type="button" class="d-flex align-items-center edit-button" onclick="navigateToEditSection('vacancy-details', {{ $jobId }}, {{ $jobOpeningId }}, 1)">
                                <iconify-icon icon="prime:pencil" width="16" height="16"></iconify-icon> Edit
                            </button>
                        </div>
                        <div id="collapseVacancyDetails" class="accordion-collapse collapse show"
                            data-bs-parent="#VacancyDetails">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-2">Job Title</h4>
                                        <p class="m-0">{{ $jobOpeningData->job_title}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="mb-2">Total Vacancies</h4>
                                        <p class="m-0">{{ $jobsData->vacancy}}</p>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <h4 class="mb-2">Employment Type</h4>
                                        <p class="m-0">{{ \App\Helpers\HelperFunctions::getEmploymentType($jobOpeningData->employment_type) }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="mb-2">Job Location</h4>
                                        <p class="m-0">{{ ucwords($jobOpeningData->job_location_type) }}</p>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <h4 class="mb-2">Application Period</h4>
                                        <p class="m-0">{{ $postedDate }} - {{ $endDate }}</p>
                                    </p>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="mb-2">Monthly Salary Range</h4>
                                        <p class="m-0">{{ $jobOpeningData->currency_short_name }} {{ $jobOpeningData->salary_lower_bound}}-{{$jobOpeningData->salary_upper_bound}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion mt-5 review-card" id="JobDetails">
                    <div class="accordion-item">
                        <div class="d-flex justify-content-between align-items-center accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseJobDetails" aria-expanded="true"
                                aria-controls="collapseJobDetails">
                                Job Details
                            </button>
                        </div>
                        <div id="collapseJobDetails" class="accordion-collapse collapse show"
                            data-bs-parent="#JobDetails">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="mb-2">Job Role Description</h4>
                                        <p class="m-0">{{ $jobOpeningData->job_role_description }}</p>
                                    </div>
                                    <div class="col-md-12 mt-5">
                                        <h4 class="mb-2">Critical Work Function</h4>
                                        @foreach ($criticalWorkFunction as $workFunction)
                                            <p class="mb-2">{{ $workFunction->description }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion mt-5 review-card" id="JobQualifications">
                    <div class="accordion-item">
                        <div class="d-flex justify-content-between align-items-center accordion-header after-align">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseJobQualifications" aria-expanded="true"
                                aria-controls="collapseJobQualifications">
                                Job Qualifications
                            </button>
                            <button type="button" class="d-flex align-items-center edit-button"  onclick="navigateToEditSection('job-qualifications', {{ $jobId }}, {{ $jobOpeningId }}, 3)">
                                <iconify-icon icon="prime:pencil" width="16"
                                    height="16"></iconify-icon> Edit
                            </button>
                        </div>
                        <div id="collapseJobQualifications" class="accordion-collapse collapse show"
                            data-bs-parent="#JobQualifications">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-2">Education Level</h4>
                                        <p class="m-0">{{$jobOpeningData->education_level_name }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="mb-2">Education program</h4>
                                            <p class="m-0">{{ $jobOpeningData->master_education_programs_name }}</p>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <h4 class="mb-2">Main Scope of Study</h4>
                                        <p class="m-0">{{$jobOpeningData->education_program_name }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="mb-2">Secondary Scope of Study <span class="optional">- optional</span> </h4>
                                        @foreach ($secondaryScope as $scope)
                                            <p class="m-0">{{ $scope['name'] }}</p>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <h4 class="mb-2">Relevant Professional Certificate <span
                                                class="optional">
                                                optional</span></h4>
                                            @foreach ($relevantProfessionalCertificate as $professionalCertificate)
                                                <p class="m-0" style="display: inline-block; margin-right: 10px;">
                                                    {{ $professionalCertificate->name }}
                                                </p>
                                            @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="mb-2">Relevant Training Program <span class="optional">-
                                                optional</span> </h4>
                                            @foreach ($relevantTrainingProgram as $trainingProgram)
                                                <p class="m-0" style="display: inline-block; margin-right: 10px;">{{ $trainingProgram->name }}</p>
                                            @endforeach                                            
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <h4 class="mb-2">Experience in Relevant Sector</h4>
                                        <p class="m-0">{{ $jobOpeningData->min_experience }}-{{ $jobOpeningData->max_experience }} Years</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion mt-5 review-card" id="JobSkills">
                    <div class="accordion-item">
                        <div class="d-flex justify-content-between align-items-center accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseJobSkills" aria-expanded="true"
                                aria-controls="collapseJobSkills">
                                Job Skills
                            </button>
                        </div>
                        <div id="collapseJobSkills" class="accordion-collapse collapse show"
                            data-bs-parent="#JobSkills">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-2">Soft Skill</h4>
                                        @foreach ($jobSoftSkill as $skill)
                                            <p class="mb-2">{{ $skill['name'] }}</p>
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="mb-2">Technical Skills</h4>
                                        @foreach ($jobTechnicalSkill as $skill)
                                            <p class="mb-2">{{ $skill['name'] }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion mt-5 review-card" id="OtherDetails">
                    <div class="accordion-item">
                        <div class="d-flex justify-content-between align-items-center accordion-header after-align">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOtherDetails" aria-expanded="true"
                                aria-controls="collapseOtherDetails">
                                Other Details
                            </button>
                            <button type="button" class="d-flex align-items-center edit-button" onclick="navigateToEditSection('otherDetailsForm', {{ $jobId }}, {{ $jobOpeningId }}, 5)">
                                <iconify-icon icon="prime:pencil" width="16"
                                    height="16"></iconify-icon> Edit
                            </button>
                        </div>
                        <div id="collapseOtherDetails" class="accordion-collapse collapse show"
                            data-bs-parent="#OtherDetails">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="mb-2">Company Overview <span class="optional">- optional</span></h4>
                                        @php
                                            $description = strip_tags($jobOpeningData->company_overview_description);
                                            // Ensure space after .!? if "Powered by" follows
                                            $description = preg_replace('/([.!?])/i', '$1 $2', $description);
                                        @endphp

                                        <p class="m-0">{{ $description }}</p>
                                    </div>
                                    <div class="col-md-12 mt-5">
                                        <h4 class="mb-2">Compensation & Benefits <span class="optional">-
                                                optional</span></h4>
                                        <p class="mb-0">{!! $jobOpeningData->company_benefit_description ?? '' !!}</p>
                                    </div>
                                    <div class="col-md-12 mt-5">
                                        <h4 class="mb-2">Application Document(s)</h4>
                                        @php
                                            $resumeDocuments = $jobApplicationDocument->where('name', 'Resume');
                                            $otherDocuments = $jobApplicationDocument->where('name', '!=', 'Resume');
                                        @endphp
                                        
                                        {{-- @if($resumeDocuments->isNotEmpty()) --}}
                                            <div class="mb-2 document-card position-relative">
                                                <h4 class="mb-2">Document Name</h4>
                                                <p class="mb-0">Resume</p>
                                                <div class="row mt-4">
                                                    <div class="col-md-6">
                                                        <h4 class="mb-2">Required for applicants to submit?</h4>
                                                        <p class="mb-0">Yes</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h4 class="mb-2">File Type</h4>
                                                        <p class="mb-0">
                                                            PDF (.pdf), Word Documents (.doc)
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="mb-2 document-card position-relative">
                                                <h4 class="mb-2">Document Name</h4>
                                                <p class="mb-0">Cover Letter</p>
                                                <div class="row mt-4">
                                                    <div class="col-md-6">
                                                        <h4 class="mb-2">Required for applicants to submit?</h4>
                                                        <p class="mb-0">No</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h4 class="mb-2">File Type</h4>
                                                        <p class="mb-0">
                                                            PDF (.pdf), Word Documents (.doc)
                                                        </p>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        {{-- @endif --}}
                                        
                                        @foreach ($otherDocuments as $document)
                                            <div class="mb-2 document-card position-relative">
                                                <h4 class="mb-2">Document Name</h4>
                                                <p class="mb-0">{{ $document->name }}</p>
                                                <div class="row mt-4">
                                                    <div class="col-md-6">
                                                        <h4 class="mb-2">Required for applicants to submit?</h4>
                                                        <p class="mb-0">{{ $document->is_required == 1 ? 'Yes' : 'No' }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h4 class="mb-2">File Type</h4>
                                                        <p class="mb-0">
                                                            @php
                                                            $types = json_decode($document->type, true);
                                                        @endphp
                                                        
                                                        @if ($types === 'website-link' || $document->type === 'website-link')
                                                            Website Link (www)
                                                        @elseif (is_array($types))
                                                            {{ implode(', ', $types) }}
                                                        @else
                                                            {{ $document->type }}
                                                        @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion mt-5 review-card mb-5" id="HiringWorkflow">
                    <div class="accordion-item">
                        <div class="d-flex justify-content-between align-items-center accordion-header after-align">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseHiringWorkflow" aria-expanded="true"
                                aria-controls="collapseHiringWorkflow">
                                Hiring Workflow
                            </button>
                            <button type="button" class="d-flex align-items-center edit-button" onclick="navigateToEditSection('hiringWorkflowForm', {{ $jobId }}, {{ $jobOpeningId }}, 6)">
                                <iconify-icon icon="prime:pencil" width="16"
                                    height="16"></iconify-icon> Edit
                            </button>
                        </div>
                        <div id="collapseHiringWorkflow" class="accordion-collapse collapse show"
                            data-bs-parent="#HiringWorkflow">
                            <div class="accordion-body">
                                <div class="row">
                                    <h4 class="mb-2">Suitability Rate</h4>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-between">
                                            <h4 class="mb-2">Criteria</h4>
                                            <h4 class="mb-2">Weightage (%)</h4>
                                        </div>
                                    
                                        @foreach ($suitabilityRate as $criterion)
                                            <div class="d-flex justify-content-between">
                                                <p class="mb-0">{{ $criterion->criteria_name }}</p>
                                                <p class="mb-0">{{ $criterion->weightage }}%</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="filter-content mt-6 display">
    <div class="d-flex gap-2 justify-content-end">
        <button class="btn btn-apply d-flex align-items-center gap-2" onclick="navigateToReviewSection(8, {{ $jobId }}, {{ $jobOpeningId }})">
            Next: Job Posting Preview 
            <iconify-icon icon="tabler:arrow-right" width="16" height="16"></iconify-icon>
        </button>
    </div>    
</div>


<script>
    function navigateToEditSection(section, jobId, jobOpeningId, step) {

        const currentUrl = new URL(window.location.href);
        const searchParams = currentUrl.searchParams;

        const hasEditTrue = searchParams.get('edit') === 'true';
        const hadReuseTrue = searchParams.get('reuse') === 'true';
        const hadCreatetrue = searchParams.get('create') === 'true';

        if (hadReuseTrue) {
            window.location.href = `/admin/talent-acquisition/job-board/create-job-advertisement?step=${step}&jobId=${jobId}&jobOpeningId=${jobOpeningId}&edit=true&reuse=true#${section}`;
        } else if (hadCreatetrue){
            window.location.href = `/admin/talent-acquisition/job-board/create-job-advertisement?step=${step}&jobId=${jobId}&jobOpeningId=${jobOpeningId}&edit=true&create=true#${section}`;
        } else if (hasEditTrue) {
            window.location.href = `/admin/talent-acquisition/job-board/create-job-advertisement?step=${step}&jobId=${jobId}&jobOpeningId=${jobOpeningId}&edit=true#${section}`;
        }
    }

    function navigateToReviewSection(step, jobId, jobOpeningId) {

        const currentUrl = new URL(window.location.href);
        const searchParams = currentUrl.searchParams;

        const hasEditTrue = searchParams.get('edit') === 'true';
        const hadReuseTrue = searchParams.get('reuse') === 'true';
        const hadCreatetrue = searchParams.get('create') === 'true';


        if (hasEditTrue && hadReuseTrue) {
            window.location.href = `/admin/talent-acquisition/job-board/create-job-advertisement/job-posting-preview-page?step=${step}&jobId=${jobId}&jobOpeningId=${jobOpeningId}&reuse=true`;
        } else if (hasEditTrue) {
            window.location.href = `/admin/talent-acquisition/job-board/create-job-advertisement/job-posting-preview-page?step=${step}&jobId=${jobId}&jobOpeningId=${jobOpeningId}&edit=true`;
        } else {
            window.location.href = `/admin/talent-acquisition/job-board/create-job-advertisement/job-posting-preview-page?step=${step}&jobId=${jobId}&jobOpeningId=${jobOpeningId}&create=true`;
        }

    }
</script>