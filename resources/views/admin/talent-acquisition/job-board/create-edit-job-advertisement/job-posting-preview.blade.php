<div class="jp-header bg-white">
    <h4>{{ $jobOpeningData->job_title }}</h4>
    <div class="d-flex align-items-center gap-3">
        <div class="d-flex align-items-center gap-1">
            <iconify-icon icon="lucide:briefcase" width="16" height="16" style="color:#99A1B7;"></iconify-icon>
            <p class="m-0">{{ ucwords(str_replace('_', ' ', $employmentTypeKey)) }}</p>
        </div>
        <div class="d-flex align-items-center gap-1">
            <iconify-icon icon="basil:location-outline" width="16" height="16"
                style="color:#99A1B7;"></iconify-icon>
            <p class="m-0">{{ ucwords($jobOpeningData->job_location_type ?? '') }} - {{ ucwords($locationData->state_name ?? '')}}, {{ ucwords($locationData->country_name ?? '') }}</p>
        </div>
        <div class="d-flex align-items-center gap-1">
            <iconify-icon icon="mdi:clock-outline" width="16" height="16" style="color:#99A1B7;"></iconify-icon>
            <p class="m-0">Posted {{ $postedDate }} - {{ $endDate }}</p>
        </div>
    </div>
</div>
<div class="jp-body d-flex">
    <div class="jp-left-side">
        <div class="mb-8">
            <h5 class="mb-2">Job Details</h5>
            <p>{{ $jobOpeningData->job_role_description }}</p>
        </div>
        <div class="accordion pb-5" id="accordionExample">
            <div class="accordion-item mb-5">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseCriticalWorkFunctions" aria-expanded="true"
                        aria-controls="collapseCriticalWorkFunctions">
                        Critical Work Functions
                    </button>
                </h2>
                <div id="collapseCriticalWorkFunctions" class="accordion-collapse collapse show"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <ul>
                            @foreach($criticalWorkFunction as $criticalWorkFunctionList)
                                <li>{{ $criticalWorkFunctionList->description }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item mb-5">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSoftSkills" aria-expanded="false" aria-controls="collapseSoftSkills">
                        Soft Skills
                    </button>
                </h2>
                <div id="collapseSoftSkills" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <ul>
                           @foreach ($softSkillList as $softSkill)
                                <li>{{ $softSkill->job_skill_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item mb-5">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTechnicalSkills" aria-expanded="false"
                        aria-controls="collapseTechnicalSkills">
                        Technical Skills
                    </button>
                </h2>
                <div id="collapseTechnicalSkills" class="accordion-collapse collapse"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <ul>
                            @foreach($technicalSkillList as $techSkill)
                                <li>{{ $techSkill->technical_skills_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="jp-sidebar">
        <div class="box">
            <h4 class="mb-3">Interested in this role?</h4>
            <div class="d-flex gap-3">
                <button class="btn btn-apply">Apply Now</button>
                <button class="btn btn-outline"><iconify-icon icon="tabler:share" width="24" height="24"
                        style="color: #78829D;"></iconify-icon></button>
                <button class="btn btn-outline"><iconify-icon icon="lets-icons:copy" width="24" height="24"
                        style="color: #78829D;"></iconify-icon></button>
            </div>
        </div>
        <div class="box mt-5">
            <h4 class="mb-3">Company Overview</h4>
            <p class="m-0">{!! $jobOpeningData->company_overview_description ?? '' !!}</p>
            <h4 class="mb-3">Company Benefit</h4>
            <p class="m-0">{!! $jobOpeningData->company_benefit_description ?? '' !!}</p>
            <h4 class="mt-8 mb-3">Job Qualification</h4>
            <h5 class="mb-1">Education Level</h5>
            <p class="mb-3">{{ $jobOpeningData->education_level_name }}</p>
            <h5 class="mb-1">Education Program</h5>
            <p class="mb-3">{{ $jobOpeningData->education_program }}</p>
            <h5 class="mb-1">Main Scope of Study</h5>
            <p class="mb-3">{{ $jobOpeningData->education_program_name }}</p>
            <h5 class="mb-1">Secondary Scope of Study</h5>
            <p class="mb-3">
                {{ $jobOpeningSecondaryScopeOfStudies->pluck('name')->implode(', ') }}
            </p>
            <h5 class="mb-1">Relevant Professional Certificate</h5>
            <p class="mb-3">{{ $relevantProfessionalCertificate->pluck('name')->implode(', ') }}</p>
            <h5 class="mb-1">Relevant Training Program</h5>
            <p class="mb-3">{{ $relevantTrainingProgram->pluck('name')->implode(', ') }}</p>
            <h5 class="mb-1">Work Experience</h5>
            <p class="mb0">{{ $jobOpeningData->min_experience }}-{{ $jobOpeningData->max_experience }} Years</p>
        </div>
    </div>
</div>
