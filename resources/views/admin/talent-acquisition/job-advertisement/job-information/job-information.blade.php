<div class="ji-body d-flex">
    <div class="ji-left-side">
        <div class="">
            <h4>Job Role Description</h4>
            <p class="m-0">{{ $jobOpening->job_role_description ?? '-' }}</p>
        </div>
        <div class="">
            <h4>Critical Work Functions</h4>
            <div id="customAccordion">
                @if (!isset($criticalFunctions) || $criticalFunctions->isEmpty())
                    <p class="m-0">No critical work functions found.</p>
                @else
                    @foreach ($criticalFunctions as $item)
                        <div class="">
                            <div class="accordion-design d-flex align-items-center" data-bs-toggle="collapse"
                                data-bs-target="#sectionOne-{{ $item->id }}" aria-expanded="false">
                                <iconify-icon icon="oui:plus-in-circle-filled" width="23" height="23"
                                    class="icon plus-icon"></iconify-icon>
                                <iconify-icon icon="lsicon:minus-outline" width="23" height="23"
                                    class="icon minus-icon d-none"></iconify-icon>
                                {{ $item->description ?? '-' }}
                            </div>
                            <div id="sectionOne-{{ $item->id }}" class="accordion-collapse collapse" data-bs-parent="#customAccordion">
                                <div class="accordion-body fs-6 ps-10 mt-2">
                                    @if (!isset($item->cwfKeys) || $item->cwfKeys->isEmpty())
                                        <p class="m-0">No keys found.</p>
                                    @else
                                        @foreach ($item->cwfKeys as $key)
                                            <p class="m-0">{{ $key->name ?? '-' }}</p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="">
            <h4>Soft Skills</h4>
            <div class="d-flex flex-wrap gap-3">
                @if (!isset($skills) || $skills->isEmpty())
                    <p class="m-0">No soft skills found.</p>
                @else
                    @foreach ($skills as $item)
                        <div class="tag">{{ $item->title ?? '-' }}</div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="">
            <h4>Technical Skills</h4>
            <div class="d-flex flex-wrap gap-3">
                @if (!isset($technicalSkills) || $technicalSkills->isEmpty())
                    <p class="m-0">No technical skills found.</p>
                @else
                    @foreach ($technicalSkills as $item)
                        <div class="tag">{{ $item->name ?? '-' }}</div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class=""> 
            <h4>Company Overview</h4>
            <p class="m-0">{!! $companyOverview->description ?? '-' !!}</p>
            <!-- <ul class="p-0">
                <ol type="1">
                    <li>
                        
                    </li>                     
                </ol>
            </ul> -->
        </div>
        <div class="">
            <h4>Compensation & Benefits</h4>
            <p class="m-0">{!! $companyBenefit->description ?? '-' !!}</p>
            <!-- <ul class="p-0">
                <ol type="1">
                    <li>
                       
                    </li>                     
                </ol>
            </ul> -->
        </div>
    </div>
    <div class="ji-sidebar">
        <div class="box">
            <h4 style="margin-bottom: 18px">Job Qualifications</h4>
            <h5 class="mb-1">Education Level</h5>
            <p class="mb-3">{{ $education_level->name ?? '-' }}</p>
            <h5 class="mb-1">Main Scope of Study</h5>
            <p class="mb-3">{{ $mainScopeOfStudy->name ?? '-' }}</p>
            <h5 class="mb-1">Secondary Scope of Study</h5>
            <p class="mb-3">
                @if (!isset($secondaryScopeOfStudies) || $secondaryScopeOfStudies->isEmpty())
                    -
                @else
                    @foreach ($secondaryScopeOfStudies as $item)
                        {{ $item->name ?? '-' }}@if (!$loop->last), @endif
                    @endforeach
                @endif
            </p> 
            <h5 class="mb-1">Relevant Professional Certificates</h5>
            <p class="mb-3">
                @if (!isset($relevantProfessionalCertificates) || $relevantProfessionalCertificates->isEmpty())
                    -
                @else
                    @foreach ($relevantProfessionalCertificates as $item)
                        {{ $item->name ?? '-' }}@if (!$loop->last), @endif
                    @endforeach
                @endif
            </p>
            <h5 class="mb-1">Relevant Training Programs</h5>
            <p class="mb-3">
                @if (!isset($relevantTrainingPrograms) || $relevantTrainingPrograms->isEmpty())
                    -
                @else
                    @foreach ($relevantTrainingPrograms as $item)
                        {{ $item->name ?? '-' }}@if (!$loop->last), @endif
                    @endforeach
                @endif
            </p>
            <h5 class="mb-1">Experience in Relevant Sector</h5>
            <p class="mb-0">{{ $jobOpening->work_experience ?? '0' }} Years</p>
        </div>
        <div class="box mt-5">
            <h4 style="margin-bottom: 18px">Hiring Details</h4>
            <h5 class="mb-1">Required Documents for Application</h5>
            <p class="mb-3">
                Resume, 
                @if (!isset($requiredDocuments) || $requiredDocuments->isEmpty())
                    -
                @else
                    @foreach ($requiredDocuments as $item)
                        {{ $item->name ?? '-' }}@if (!$loop->last), @endif
                    @endforeach
                @endif
            </p>
            <h5 class="mb-1">Suitability Rate Criteria</h5>
            <p class="mb-0">
                @if (!isset($suitabilityRateSettings) || $suitabilityRateSettings->isEmpty())
                    -
                @else
                    @foreach ($suitabilityRateSettings as $item)
                        {{ $item->criteria_name ?? '-' }}@if (!$loop->last), @endif
                    @endforeach
                @endif
            </p>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const accordionHeader = document.querySelector(".accordion-design");

        accordionHeader.addEventListener("click", function() {
            const plusIcon = this.querySelector(".plus-icon");
            const minusIcon = this.querySelector(".minus-icon");

            if (this.getAttribute("aria-expanded") === "true") {
                plusIcon.classList.remove("d-none");
                minusIcon.classList.add("d-none");
            } else {
                plusIcon.classList.add("d-none");
                minusIcon.classList.remove("d-none");
            }
        });
    });
</script>
