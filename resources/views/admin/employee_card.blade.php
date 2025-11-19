{{-- <div class="card ">
    <!--begin::Card body-->
    <div class="card-body d-flex flex-center flex-column pt-12 p-9">
        <!--begin::Avatar-->
        <div class="symbol symbol-65px symbol-circle mb-5">
            <img src="{{ asset($employee->profile_picture ?? '') }}"
                onerror="this.src='{{ asset('images/default-user.svg') }}'" alt="image">
            <div
                class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3">
            </div>
        </div>
        <!--end::Avatar-->

        <div><h2>Employee Details</h2></div>
        <!--begin::Name-->
        <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">{{ $employee->name ?? '' }}</a>
        <!--end::Name-->

        <!--begin::Position-->
        <div class="fw-semibold text-gray-500 mb-6">{{ $employee->job_position->title ?? ($employee->job_title ?? '') }}</div>
        <!--end::Position-->

 

    </div>
    <!--end::Card body-->
</div> --}}
<div class="col-xl-12 mb-5 mb-xl-10">

    <!--begin::Engage widget 1-->
    <div class="card card-flush h-md-100" dir="ltr">

        <div class="card-header flex-nowrap pt-5">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-900">Basic Personal Information&ZeroWidthSpace;</span>
                <button class="btn btn-icon btn-close btn-sm btn-active-icon-primary position-absolute top-0 end-0 m-3"
                        id="closeButton"
                        aria-label="Close"><iconify-icon icon="line-md:close" class="fs-1"></iconify-icon>
                </button>

            </h3>
            <!--end::Title-->


        </div>
        <!--begin::Body-->
        <div class="card-body p-9">

            <div class="d-flex flex-wrap mb-6">
                <!--begin::Image-->
                <div class="d-flex flex-center flex-shrink-0 bg-light rounded w-80px h-80px me-7 mb-4">
                    <img class="mw-100 rounded-3" src="{{ asset($employee->profile_picture ?? '') }}"
                        onerror="this.src='{{ asset('images/default-user.svg') }}'" alt="image">
                </div>
                <!--end::Image-->

                <!--begin::Wrapper-->
                <div class="flex-grow-1">
                    <!--begin::Head-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::Details-->
                        <div class="d-flex flex-column">
                            <!--begin::Status-->
                            <div class="d-flex align-items-center mb-1">
                                <a href="/admin/employee-details/{{ $employee->id ?? '' }}"
                                    class="text-gray-800 text-hover-primary fs-2 fw-bold me-3">{{ $employee->name ?? '' }}</a>
                                {{-- <span class="badge badge-light-success me-auto">In Progress</span> --}}
                            </div>
                            <!--end::Status-->

                            <!--begin::Description-->
                            <div class="d-flex flex-wrap fw-semibold mb-2 fs-5 text-gray-500">
                                {{ $employee->email ?? '' }}
                                {{-- @if ($employee->gender == 0)
                                Male
                            @elseif ($employee->gender == 1)
                                Female
                            @else
                                N / A
                            @endif |  --}}
                            </div>
                            {{-- <div class="d-flex flex-wrap fw-semibold mb-2 fs-5 text-gray-500">
                                @if ($employee->gender == 0)
                                Male
                            @elseif ($employee->gender == 1)
                                Female
                            @else
                                N / A
                            @endif
                            </div> --}}
                            <div class="d-flex flex-wrap fw-semibold mb-2 fs-5 text-gray-500">
                                {{ $employee->company->userCompany->name ?? '' }}
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Details-->


                    </div>
                    <!--end::Head-->

                </div>
                <!--end::Wrapper-->
            </div>
            <div class=" pt-5">
                <!--begin::Title-->
                <h3 class="card-title align-items-start flex-column mb-5">
                    <span class="card-label fw-bold text-gray-900">Position Details</span>

                </h3>
                <!--end::Title-->


            </div>
            
            <!--end::Input group-->
            <div class="row mb-2">
                <!--begin::Label-->
                <label class="col-lg-6 fw-semibold text-muted">Department</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-6">
                    <span class="fw-bold fs-7 text-gray-800"> {{ $employee->department->name ?? '' }}</span>
                </div>
                <!--end::Col-->
            </div>

            @can('user_management_read')
            <div class="row mb-2">
                <!--begin::Label-->
                <label class="col-lg-6 fw-semibold text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Overall Match Rate">
                    {{-- JIMR --}}
                    Overall Match Rate
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-6">
                    <span class="fw-bold fs-6 text-gray-800">

                        {{-- {{ $employee->match_rate ?? 0 }} %  --}}
                        @if($employee->technical_assessment_completed == 0)
                           (Technical Assessment Not Completed Yet)
                        @else
                           {{ config('helpers.overall_match_rate_levels')[$employeeResults->where('slug', 'overall-match-rate')->first()->level ?? 0] }}
                        @endif
                    </span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-2">
                <!--begin::Label-->
                <label class="col-lg-6 fw-semibold text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Behavior Fit Rate">
                    {{-- JIMR --}}
                    Behavior Fit Rate
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-6">
                    <span class="fw-bold fs-6 text-gray-800">

                        {{-- {{ $employee->soft_skill_score ?? 0 }} %  --}}
                        {{ config('helpers.soft_skill_match_rate_levels')[$employeeResults->where('slug', 'soft-skill-score')->first()->level ?? 0] }}
                    </span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-2">
                <!--begin::Label-->
                <label class="col-lg-6 fw-semibold text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Technnical Assessment Result">
                    {{-- JIMR --}}
                    Technnical Assessment Result
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-6">
                    <span class="fw-bold fs-6 text-gray-800">

                        {{-- {{ $employee->tech_skill_score ?? 0 }} %  --}}
                        {{ config('helpers.technical_assessment_levels')[$employeeResults->where('slug', 'technical')->first()->level ?? 0] }}
                    </span>
                </div>
                <!--end::Col-->
            </div>

            <div class="row mb-2">
                <!--begin::Label-->
                <label class="col-lg-6 fw-semibold text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Soft Skill Match Rate">
                    {{-- TPMR --}}
                    Soft Skill Match Rate
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-6">
                    <span class="fw-bold fs-6 text-gray-800">
                        {{-- {{ $employee->talent_pillar_match_rate ?? 0 }} % --}}
                        {{ config('helpers.talent_pillar_match_rate_levels')[$employeeResults->where('slug', 'ccs-match-rate')->first()->level ?? 0] }}
                    </span>
                </div>
                <!--end::Col-->
            </div>

            <!--begin::Input group-->
            <div class="row mb-2">
                <!--begin::Label-->
                <label class="col-lg-6 fw-semibold text-muted">Position</label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-6">
                    <span class="fw-bold fs-7 text-gray-800"> {{ $employee->job_position->title ?? '' }}</span>
                </div>
                <!--end::Col-->
            </div>

            <!--begin::Row-->
            <div class="row mb-2">
                <!--begin::Label-->
                <label class="col-lg-6 fw-semibold text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Predictive Performance Rate">
                    {{-- PPR --}}Predictive Performance Rate
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-6">
                    <span class="fw-bold fs-6 text-gray-800">
                        {{-- {{ $employee->getPerformancePredictiveScore($employee->id) ?? 0 }} % --}}
                        {{ config('helpers.performance_predictive_rate_levels')[$employeeResults->where('slug', 'performance-predictive-rate')->first()->level ?? 0] }}
                    </span>
                </div>
                <!--end::Col-->
            </div>

            
           
            <div class="row mb-2">
                <!--begin::Label-->
                <label class="col-lg-6 fw-semibold text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Cognitive Test Result">
                    {{-- CTR --}}
                    Cognitive Test Result
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-6">
                    <span class="fw-bold fs-6 text-gray-800">
                        {{-- {{ $employee->getCognitiveLevel($employee->id) ?? "Level: 2" }} --}}
                        {{ config('helpers.cognitive_ability_levels')[$employeeResults->where('slug', 'cognitive')->first()->level ?? 0] }}
                    </span>
                </div>
                <!--end::Col-->
            </div>       

            <div class="row mb-2">
                <!--begin::Label-->
                <label class="col-lg-6 fw-semibold text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="RIASEC (Top 3)">
                    {{-- JIMR --}}
                    RIASEC (Top 3)
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-6">
                    <span class="fw-bold fs-6 text-gray-800">

                        {{ $employee->riasec_code ?? 0 }} 
                    </span>
                </div>
                <!--end::Col-->
            </div>

            <div class="row mb-2">
                <!--begin::Label-->
                <label class="col-lg-6 fw-semibold text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Job Match Rate">
                    {{-- JIMR --}}
                    Job Match Rate
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-6">
                    <span class="fw-bold fs-6 text-gray-800">

                        {{-- @if($employee->riasec_job_match_rate >= 70) 
                            High
                        @elseif ($employee->riasec_job_match_rate <= 40)
                            Low
                        @else
                            Moderate                           
                        @endif --}}
                        {{ config('helpers.job_match_rate_levels')[$employeeResults->where('slug', 'job-match-rate')->first()->level ?? 0] }}
                    </span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-2">
                <!--begin::Label-->
                <label class="col-lg-6 fw-semibold text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Growth Potential">
                    {{-- GP --}}OCEAN Reliability
                </label>
                <!--end::Label-->

                @php
                $user_id = $employee->id;
                if ($employee->company_id) {
                    $user_id = $employee->company_id;
                }
                @endphp
                <!--begin::Col-->
                <div class="col-lg-6">
                    <span class="fw-bold fs-6 text-gray-800" > 
                        {{-- {{ $employee->getGrowthPotentialLevel($user_id) ?? 'Average' }} --}}
                        {{ config('helpers.rci_levels')[$employeeResults->where('slug', 'rci')->first()->level ?? 0] }}
                    </span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-2">
                <!--begin::Label-->
                <label class="col-lg-6 fw-semibold text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Growth Potential">
                    {{-- GP --}}Growth Potential
                </label>
                <!--end::Label-->

                @php
                $user_id = $employee->id;
                if ($employee->company_id) {
                    $user_id = $employee->company_id;
                }
                @endphp
                <!--begin::Col-->
                <div class="col-lg-6">
                    <span class="fw-bold fs-6 text-gray-800" > 
                        {{ config('helpers.growth_potential_levels')[$employeeResults->where('slug', 'growth-potential')->first()->level ?? 0] }}
                    </span>
                </div>
                <!--end::Col-->
            </div>
            
            

            <div class="row mb-2">
                <!--begin::Label-->
                <label class="col-lg-6 fw-semibold text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Flight Risk">
                    {{-- FR --}}Flight Risk (Based on Facets)
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-6">
                    
                    <span class="fw-bold fs-6 text-gray-800">
                        {{ config('helpers.flight_risk_levels')[$employeeResults->where('slug', 'flight-risk')->first()->level ?? 0] }}
                    </span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-2">
                <!--begin::Label-->
                <label class="col-lg-6 fw-semibold text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Workplace Alignment Forecast">
                    {{-- OFF  --}}Workplace Alignment Forecast
                </label>
                <!--end::Label-->

                <!--begin::Col-->
                <div class="col-lg-6">
                    <span class="fw-bold fs-6 text-gray-800">
                        {{-- {{ ucFirst($employee->organizational_fit_forecast) ?? 0 }} Risk --}}
                        {{ config('helpers.organizational_fit_forecast_levels')[$employeeResults->where('slug', 'organizational-fit-forecast')->first()->level ?? 0] }}
                    </span>
                </div>
                <!--end::Col-->
            </div>
            @endcan
        

            
          
            <!--end::Notice-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Engage widget 1-->

</div>
<!-- JavaScript -->
<script>
        // Add click event to the close button
    document.getElementById('closeButton').addEventListener('click', function () {
        // Hide the profile icon element
        const profileIcon = document.getElementById('profile-icon');
        if (profileIcon) {
            profileIcon.style.display = 'none'; // Hides the profile icon
            $('#org_chart').removeClass(
                                        'col-md-9').addClass(
                                        'col-md-12');
        } else {
            console.error('Profile icon not found!');
        }
    });
</script>
