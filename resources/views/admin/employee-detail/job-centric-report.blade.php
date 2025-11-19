
    @if (($user->is_personality_motivation_completed == 1) && ($user->is_work_interest_completed == 1) && ($user->is_cognitive_ability_completed == 1) && ($isUserResultExists == 1))    
        @if (!$user->position_id)
            <div class="empty-state" style="background: #FCFCFC;">
                        <p>
                            Job Centric Assessment Report is unavailable as this <br> employee has not been assigned to a job position yet.
                        </p>
            </div>
        @else
            <section class="psychometric-section">
                <h3 class="top-heading m-0 mb-9">Assessment Overview</h3>
                <div class="box mb-9">
                    <div class="w-50 m-auto">
                        @if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required')))
                            <div class="job-centric mb-4">
                                <h4 class="m-0 fw-bold d-flex justify-content-center align-items-center">OVERALL MATCH RATE</h4>
                                <div class="icon-p-border">
                                    <p class="m-0 fw-bold d-flex align-items-center justify-content-center icon-p"><iconify-icon
                                                    icon="{{ config('helpers.applicant_details_icon_class_levels')[$overAllMatchRateResult['overall-match-rate']['level'] ?? 0] }}" width="16" height="16"
                                                    class="{{ config('helpers.applicant_details_icon_color_levels')[$overAllMatchRateResult['overall-match-rate']['level'] ?? 0] }}"></iconify-icon>{{ config('helpers.overall_match_rate_levels')[$overAllMatchRateResult['overall-match-rate']['level'] ?? 0] }}
                                    </p>
                                </div>
                            </div>
                            <div class="job-centric mb-4">
                                <h4 class="m-0 fw-bold d-flex justify-content-center align-items-center">Technical assessment</h4>
                                <div class="icon-p-border">
                                    <p class="overview-heading fw-medium text-center" style="color: #7b7b7b">Technical Assessment Result: </p>
                                    <p class="m-0 fw-bold d-flex align-items-center justify-content-center icon-p"><iconify-icon
                                                    icon="{{ config('helpers.applicant_details_icon_class_levels')[$technicalResult['technical']['level'] ?? 0] }}" width="16" height="16"
                                                    class="{{ config('helpers.applicant_details_icon_color_levels')[$technicalResult['technical']['level'] ?? 0] }}"></iconify-icon>
                                            {{ config('helpers.technical_assessment_levels')[$technicalResult['technical']['level'] ?? 0] }}</p>
                                </div>
                            </div>
                        @endif
                        
                        <div class="job-centric mb-4">
                            <h4 class="m-0 fw-bold d-flex justify-content-center align-items-center">Personality & Motivation</h4>
                            <div class="icon-p-border row w-100 m-auto">
                                <div class="col-md-6">
                                    <p class="overview-heading fw-medium" style="color: #7b7b7b">Behavioral Fit Rate  </p>
                                    <p class="m-0 fw-bold d-flex align-items-center icon-p"><iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0] }}"></iconify-icon>{{ config('helpers.behavior_fit_rate_levels')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0] }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="overview-heading fw-medium" style="color: #7b7b7b">Response Consistency Index  </p>
                                    <p class="m-0 fw-bold d-flex align-items-center icon-p"><iconify-icon icon="mdi:circle"
                                            width="20" height="20" style="color: {{config('helpers.rci_class_based_on_levels')[$rciResult['rci']['level'] ?? 0]}};"></iconify-icon>
                                            {{ config('helpers.rci_levels')[$rciResult['rci']['level'] ?? 0] }}</p>
                                </div>
                            </div>
                            <div class="icon-p-border row w-100 m-auto border-top-0">
                                <div class="col-md-6">
                                    <p class="overview-heading fw-medium" style="color: #7b7b7b">Job Match Rate </p>
                                    <p class="m-0 fw-bold d-flex align-items-center icon-p"><iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$jobMatchRateResult['job-match-rate']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels')[$jobMatchRateResult['job-match-rate']['level'] ?? 0] }}"></iconify-icon>
                                            {{ config('helpers.job_match_rate_levels')[$jobMatchRateResult['job-match-rate']['level'] ?? 0] }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="overview-heading fw-medium" style="color: #7b7b7b">Soft Skill Match Rate </p>
                                    <p class="m-0 fw-bold d-flex align-items-center icon-p"><iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$softSkillMatchRateResult['ccs-match-rate']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels')[$softSkillMatchRateResult['ccs-match-rate']['level'] ?? 0] }}"></iconify-icon>
                                            {{ config('helpers.talent_pillar_match_rate_levels')[$softSkillMatchRateResult['ccs-match-rate']['level'] ?? -1] }}</p>
                                </div>
                            </div>
                            <div class="icon-p-border row w-100 m-auto border-top-0">
                                {{-- <div class="col-md-6">
                                    <p class="overview-heading fw-medium" style="color: #7b7b7b">Personality Type </p>
                                    <p class="m-0 fw-bold d-flex align-items-center icon-p">
                                    {{ $personalityTypeResult['name'] ?? '' }}</p>
                                </div> --}}
                                <div class="col-md-6">
                                    <p class="overview-heading fw-medium" style="color: #7b7b7b">Leadership Potential </p>
                                    <p class="m-0 fw-bold d-flex align-items-center icon-p"><iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$leadershipPotentialResult['leadership-potential']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels')[$leadershipPotentialResult['leadership-potential']['level'] ?? 0] }}"></iconify-icon>{{ config('helpers.growth_potential_levels')[$leadershipPotentialResult['leadership-potential']['level'] ?? 0] }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="overview-heading fw-medium" style="color: #7b7b7b">Growth Potential </p>
                                    <p class="m-0 fw-bold d-flex align-items-center icon-p"><iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}"></iconify-icon>{{ config('helpers.growth_potential_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}</p>
                                </div>
                            </div>
                            <div class="icon-p-border row w-100 m-auto border-top-0">
                                <div class="col-md-6">
                                    <p class="overview-heading fw-medium" style="color: #7b7b7b">Workplace Alignment Forecast </p>
                                    <p class="m-0 fw-bold d-flex align-items-center icon-p"><iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels_opposite')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }}"></iconify-icon> {{ config('helpers.organizational_fit_forecast_levels')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }} Risk</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="overview-heading fw-medium" style="color: #7b7b7b">Flight Risk </p>
                                    <p class="m-0 fw-bold d-flex align-items-center icon-p"><iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$flightRiskResult['flight-risk']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels_opposite')[$flightRiskResult['flight-risk']['level'] ?? 0] }}"></iconify-icon> {{ config('helpers.flight_risk_levels')[$flightRiskResult['flight-risk']['level'] ?? 0] }} Risk</p>
                                </div>
                            </div>
                        </div>

                        <div class="job-centric mb-4">
                            <h4 class="m-0 fw-bold d-flex justify-content-center align-items-center">PERSONALITY TYPE</h4>
                            <div class="icon-p-border">
                                <p class="overview-heading fw-medium text-center" style="color: #7b7b7b">{{ $personalityTypeResult['name'] ?? '' }}</p>
                               
                            </div>
                        </div>

                        <div class="job-centric mb-4">
                            <h4 class="m-0 fw-bold d-flex justify-content-center align-items-center">COGNITIVE LEVEL</h4>
                            <div class="icon-p-border row w-100 m-auto">
                                <div class="col-md-6">
                                    <p class="overview-heading fw-medium" style="color: #7b7b7b">Cognitive Test Result</p>
                                    <div class="d-flex align-items-center gap-4 mb-5">
                                        <div class="d-flex align-items-center gap-2">
                                            @if (isset($cognitiveOverallResult['cognitive']['level']))
                                                @php
                                                    $level = $cognitiveOverallResult['cognitive']['level'];
                                                @endphp
                                                
                                                @switch($level)
                                                    @case(1)
                                                        <div class="small-strip dark-red"></div>
                                                        <div class="small-strip grey"></div>
                                                        <div class="small-strip grey"></div>
                                                        @break
                                                    
                                                    @case(2)
                                                        <div class="small-strip light-orange"></div>
                                                        <div class="small-strip dark-orange"></div>
                                                        <div class="small-strip grey"></div>
                                                        @break
                                                    
                                                    @case(3)
                                                        <div class="small-strip light-green"></div>
                                                        <div class="small-strip medium-green"></div>
                                                        <div class="small-strip dark-green"></div>
                                                        @break
                                                @endswitch
                                            @endif
                                            {{-- <div class="small-strip {{ $cognitiveOverallResult['cognitive']['level'] == 1 ? 'dark-orange' : 'grey' }}"></div>
                                            <div class="small-strip {{ $cognitiveOverallResult['cognitive']['level'] == 2 ? 'light-orange' : ($cognitiveOverallResult['cognitive']['level'] == 1 ? 'grey' : 'dark-orange') }}"></div>
                                            <div class="small-strip {{ $cognitiveOverallResult['cognitive']['level'] == 3 ? 'dark-orange' : 'grey' }}"></div> --}}
                                        </div>
                                        <p class="m-0 fw-bold d-flex align-items-center justify-content-center icon-p"> {{ config('helpers.cognitive_ability_levels')[$cognitiveOverallResult['cognitive']['level'] ?? 0] }}</p>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <p class="overview-heading fw-medium" style="color: #7b7b7b">Technical Skill Match Rate </p>
                                    <p class="m-0 fw-bold d-flex align-items-center icon-p"><iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$technicalSkillMatchRateResult['technical-skill-match-rate']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels')[$technicalSkillMatchRateResult['technical-skill-match-rate']['level'] ?? 0] }}"></iconify-icon>
                                            {{ config('helpers.job_match_rate_levels')[$technicalSkillMatchRateResult['technical-skill-match-rate']['level'] ?? 0] }}</p>
                                </div>
                            </div>
                            
                        </div>

                    
                        <div class="job-centric">
                            <h4 class="m-0 fw-bold d-flex justify-content-center align-items-center">WORK INTEREST</h4>
                            <div class="d-flex align-items-center">
                                <div class="icon-p-border w-100">
                                    <p class="overview-heading fw-medium text-center" style="color: #7b7b7b">RIASEC (Top 3)</p>
                                    <p class="m-0 fw-medium d-flex align-items-center justify-content-center fs-2"
                                        style="color: #F7941C;">
                                        {{ $riasecTop3Result['string'] ?? '' }}</p>
                                </div>
                                <div class="icon-p-border w-100">
                                    <p class="overview-heading fw-medium text-center" style="color: #7b7b7b">Job (Top 3)</p>
                                    <p class="m-0 fw-medium d-flex align-items-center justify-content-center fs-2"
                                        style="color: #F7941C;">
                                        {{ $riasecTop3Result['job_top_3_riasec'] ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex grid-template mb-9">
                    <div class="box w-75 job-centric-sticky h-100">
                        <a href="#skills-alignment" class="job-centric-nav-link"><p class="m-0 fw-medium pb-2">Skills Alignment: Critical Core Skills</p></a>
                        @if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required')))
                            <a href="#overall-match-rate" class="job-centric-nav-link"><p class="m-0 fw-medium pb-2">Overall match rate</p></a>
                            <a href="#technical-assessment-result" class="job-centric-nav-link"><p class="m-0 fw-medium pb-2">Technical Assessment Result</p></a>
                        @endif
                        <a href="#behavioral-fit-rate" class="job-centric-nav-link"><p class="m-0 fw-medium pb-2">Behavioral Fit Rate </p></a>
                        <a href="#response-consistency-index" class="job-centric-nav-link"><p class="m-0 fw-medium pb-2">Response Consistency Index </p></a>
                        <a href="#job-match-rate" class="job-centric-nav-link"><p class="m-0 fw-medium pb-2">Job Match Rate</p></a>
                        <a href="#soft-skill-match-rate" class="job-centric-nav-link"><p class="m-0 fw-medium pb-2">Soft Skill Match Rate</p></a>
                        <a href="#personality-type" class="job-centric-nav-link"><p class="m-0 fw-medium pb-2">Personality type</p></a>
                        <a href="#leadership-potential" class="job-centric-nav-link"><p class="m-0 fw-medium pb-2">Leadership Potential</p></a>
                        <a href="#growth-potential" class="job-centric-nav-link"><p class="m-0 fw-medium pb-2">Growth Potential</p></a>
                        <a href="#workplace-alignment-forecast" class="job-centric-nav-link"><p class="m-0 fw-medium pb-2">Workplace Alignment Forecast</p></a>
                        <a href="#flight-risk" class="job-centric-nav-link"><p class="m-0 fw-medium pb-2">Flight Risk</p></a>
                        <a href="#cognitive-test-result" class="job-centric-nav-link"><p class="m-0 fw-medium pb-2">Cognitive Test Result</p></a>
                        <a href="#technical-skill-match-rate" class="job-centric-nav-link"><p class="m-0 fw-medium pb-2">Technical Skill Match Rate</p></a>
                        <a href="#riasec" class="job-centric-nav-link"><p class="m-0 fw-medium pb-2">RIASEC (Top 3)</p></a>
                    </div>
                    <div style="height: 70vh; overflow: scroll;" id="job-centric-scroll-container">
                        <div class="box left-side d-grid mb-9" id="skills-alignment">
                            <div class="d-flex justify-content-between mb-14">
                                <div>
                                    <h5 class="fw-medium">Skills Alignment: Critical Core Skills</h5>
                                </div>
                            </div>
                            @foreach ($jobCcsResult as $name => $result)
                                <div class="skill-table mb-9">
                                    <div class="inner-table d-flex gap-4 align-items-center align-items-center">
                                        <div class="left-table w-75">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>
                                                        {{ $result['name'] ?? '' }} 
                                                        <span>{{ $result['score'] ?? 0 }}%</span>
                                                    </p>
                                                </div>
                                                <p class="table-desc">
                                                    {{ $ccsDomainDescriptors->where('slug', $result['slug'])->first()->analysis ?? ' ' }}
                                                </p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: {{ $result['score'] ?? 0 }}%;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon"
                                                    style="right: {{ 100 - 2 - $result['score'] }}%; top: 40% !important;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right-table w-50">
                                            <p class="badge-content fw-bold {{ config('helpers.applicant_details_ocean_badge_percentile_color_class')[$result['level'] ?? 0] }} mb-2">
                                                {{ $result['percentage_with_label'] ?? 0 }}
                                                <span>{{ config('helpers.ccs_levels')[$result['level'] ?? 0] }}</span>
                                            </p>
                                            <p class="badge-content fw-bold mb-2" style="color: #5B5B5B;">
                                                Generic Skills Requirement <span class="{{ config('helpers.applicant_details_ocean_badge_color_class')[$result['required_level'] ?? 0] }} badge fw-bold"><span>{{ config('helpers.ccs_levels')[$result['required_level'] ?? 0] }}</span></span>
                                            </p>
                                            <p class="badge-content fw-bold {{ config('helpers.applicant_details_positive_3_levels_color_class')[$result['alignment_level'] ?? 0] }}">
                                                <span class="{{ config('helpers.applicant_details_positive_3_levels_class')[$result['alignment_level'] ?? 0] }} badge fw-bold">{{ config('helpers.ccs_alignment_levels')[$result['alignment_level'] ?? 0] }}</span>
                                            </p>
                                            <p class="table-desc">
                                                {!! $result['description'] ?? '' !!}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-7 box">
                            @if (!in_array(env('DB_DATABASE'), config('client.omr_ta_not_required')))
                                <div class="left-side mb-11" style="width: 56%;" id="overall-match-rate">
                                    <div class="mb-4 pt-6">
                                        <h5 class="fw-medium mb-5 box-top-text">Overall Match Rate</h5>
                                    </div>
                                    <div class="mb-4">
                                        <h5 class="fw-medium mb-5 d-flex align-items-center gap-3">
                                            <iconify-icon
                                                    icon="{{ config('helpers.applicant_details_icon_class_levels')[$overAllMatchRateResult['overall-match-rate']['level'] ?? 0] }}" width="16" height="16"
                                                    class="{{ config('helpers.applicant_details_icon_color_levels')[$overAllMatchRateResult['overall-match-rate']['level'] ?? 0] }}">
                                            </iconify-icon>
                                            {{ config('helpers.overall_match_rate_levels')[$overAllMatchRateResult['overall-match-rate']['level'] ?? 0] }}
                                        </h5>
                                        <div class="orange-bg bg-white py-0" style="border-left: 2px solid #EBEBEB;">
                                            <p class="table-desc" style="line-height: 18px;">
                                                {{ $overAllMatchRateResult['overall-match-rate']['description'] ?? '' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="left-side mb-11" style="width: 56%;" id="technical-assessment-result">
                                    <div class="mb-4 pt-6">
                                        <h5 class="fw-medium mb-5 box-top-text">Technical Assessment Result</h5>
                                    </div>
                                    <div class="mb-4">
                                        <h5 class="fw-medium mb-5 d-flex align-items-center gap-3">
                                            <iconify-icon
                                                    icon="{{ config('helpers.applicant_details_icon_class_levels')[$technicalResult['technical']['level'] ?? 0] }}" width="16" height="16"
                                                    class="{{ config('helpers.applicant_details_icon_color_levels')[$technicalResult['technical']['level'] ?? 0] }}">
                                            </iconify-icon>
                                            {{ config('helpers.technical_assessment_levels')[$technicalResult['technical']['level'] ?? 0] }}
                                        </h5>
                                        <div class="orange-bg bg-white py-0" style="border-left: 2px solid #EBEBEB;">
                                            <p class="table-desc" style="line-height: 18px;">
                                                {{ $technicalResult['technical']['description'] ?? '' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        
                            <div class="left-side mb-11" style="width: 56%;" id="behavioral-fit-rate">
                                <div class="mb-4 pt-6">
                                    <h5 class="fw-medium mb-5 box-top-text">Behavioral Fit Rate</h5>
                                </div>
                                <div class="mb-4">
                                <h5 class="fw-medium mb-5 d-flex align-items-center gap-3">
                                        <iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0] }}">
                                        </iconify-icon>
                                        {{ config('helpers.soft_skill_match_rate_levels')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0] }}
                                    </h5>
                                    <div class="orange-bg bg-white py-0" style="border-left: 2px solid #EBEBEB;">
                                        <p class="table-desc" style="line-height: 18px;">
                                            {!! $behaviorFitRateResult['soft-skill-score']['description'] ?? '' !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="left-side mb-11" style="width: 56%;" id="response-consistency-index">
                                <div class="mb-4 pt-6">
                                    <h5 class="fw-medium mb-5 box-top-text">Response Consistency Index </h5>
                                </div>
                                <div class="mb-4">
                                    <h5 class="fw-medium mb-5 d-flex align-items-center gap-3">
                                        <iconify-icon icon="mdi:circle"
                                            width="20" height="20" style="color: {{config('helpers.rci_class_based_on_levels')[$rciResult['rci']['level'] ?? 0]}};"></iconify-icon>
                                            {{ config('helpers.rci_levels')[$rciResult['rci']['level'] ?? 0] }}
                                    </h5>
                                    <div class="orange-bg bg-white py-0" style="border-left: 2px solid #EBEBEB;">
                                        <p class="table-desc" style="line-height: 18px;">
                                            {!! $rciResult['rci']['description'] ?? '' !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="left-side mb-11" style="width: 56%;" id="job-match-rate">
                                <div class="mb-4 pt-6">
                                    <h5 class="fw-medium mb-5 box-top-text">Job Match Rate</h5>
                                </div>
                                <div class="mb-4">
                                    <h5 class="fw-medium mb-5 d-flex align-items-center gap-3">
                                        <iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$jobMatchRateResult['job-match-rate']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels')[$jobMatchRateResult['job-match-rate']['level'] ?? 0] }}"></iconify-icon>
                                            {{ config('helpers.job_match_rate_levels')[$jobMatchRateResult['job-match-rate']['level'] ?? 0] }}
                                    </h5>
                                    <div class="orange-bg bg-white py-0" style="border-left: 2px solid #EBEBEB;">
                                        <p class="table-desc" style="line-height: 18px;">
                                            {!! $jobMatchRateResult['job-match-rate']['description'] ?? '' !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="left-side mb-11" style="width: 56%;" id="soft-skill-match-rate">
                                <div class="mb-4 pt-6">
                                    <h5 class="fw-medium mb-5 box-top-text">Soft Skill Match Rate</h5>
                                </div>
                                <div class="mb-4">
                                    <h5 class="fw-medium mb-5 d-flex align-items-center gap-3"><iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$softSkillMatchRateResult['ccs-match-rate']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels')[$softSkillMatchRateResult['ccs-match-rate']['level'] ?? 0] }}"></iconify-icon>
                                            {{ config('helpers.talent_pillar_match_rate_levels')[$softSkillMatchRateResult['ccs-match-rate']['level'] ?? 0] }}
                                    </h5>
                                    <div class="orange-bg bg-white py-0" style="border-left: 2px solid #EBEBEB;">
                                        <p class="table-desc" style="line-height: 18px;">
                                            {!! $softSkillMatchRateResult['ccs-match-rate']['description'] ?? '' !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="left-side mb-11" style="width: 56%;" id="personality-type">
                                <div class="mb-4 pt-6">
                                    <h5 class="fw-medium mb-5 box-top-text">Personality Type</h5>
                                </div>
                                <div class="mb-4">
                                    <h5 class="fw-medium mb-5 d-flex align-items-center gap-3">{{ $personalityTypeResult['name'] ?? '' }}</h5>
                                    <div class="orange-bg bg-white py-0" style="border-left: 2px solid #EBEBEB;">
                                        <p class="table-desc" style="line-height: 18px;">
                                            {!! str_replace(';', ';<br>', $personalityTypeResult['description'] ?? '') !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="left-side mb-11" style="width: 56%;" id="leadership-potential">
                                <div class="mb-4 pt-6">
                                    <h5 class="fw-medium mb-5 box-top-text">Leadership Potential</h5>
                                </div>
                                <div class="mb-4">
                                    <h5 class="fw-medium mb-5 d-flex align-items-center gap-3"><iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$leadershipPotentialResult['leadership-potential']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels')[$leadershipPotentialResult['leadership-potential']['level'] ?? 0] }}"></iconify-icon>{{ config('helpers.growth_potential_levels')[$leadershipPotentialResult['leadership-potential']['level'] ?? 0] }}
                                    </h5>
                                    <div class="orange-bg bg-white py-0" style="border-left: 2px solid #EBEBEB;">
                                        <p class="table-desc" style="line-height: 18px;">
                                            {!! $leadershipPotentialResult['leadership-potential']['description'] ?? '' !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="left-side mb-11" style="width: 56%;" id="growth-potential">
                                <div class="mb-4 pt-6">
                                    <h5 class="fw-medium mb-5 box-top-text">Growth Potential</h5>
                                </div>
                                <div class="mb-4">
                                    <h5 class="fw-medium mb-5 d-flex align-items-center gap-3"><iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}"></iconify-icon>{{ config('helpers.growth_potential_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}
                                    </h5>
                                    <div class="orange-bg bg-white py-0" style="border-left: 2px solid #EBEBEB;">
                                        <p class="table-desc" style="line-height: 18px;">
                                            {!! $growthPotentialResult['growth-potential']['description'] ?? '' !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="left-side mb-11" style="width: 56%;" id="workplace-alignment-forecast">
                                <div class="mb-4 pt-6">
                                    <h5 class="fw-medium mb-5 box-top-text">Workplace Alignment Forecast</h5>
                                </div>
                                <div class="mb-4">
                                    <h5 class="fw-medium mb-5 d-flex align-items-center gap-3"><iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels_opposite')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }}"></iconify-icon> {{ config('helpers.organizational_fit_forecast_levels')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }} Risk
                                    </h5>
                                    <div class="orange-bg bg-white py-0" style="border-left: 2px solid #EBEBEB;">
                                        <p class="table-desc" style="line-height: 18px;">
                                        {!! $organizationalFitForecastResult['organizational-fit-forecast']['description'] ?? '' !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="left-side mb-11" style="width: 56%;" id="flight-risk">
                                <div class="mb-4 pt-6">
                                    <h5 class="fw-medium mb-5 box-top-text">Flight Risk</h5>
                                </div>
                                <div class="mb-4">
                                    <h5 class="fw-medium mb-5 d-flex align-items-center gap-3"><iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$flightRiskResult['flight-risk']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels_opposite')[$flightRiskResult['flight-risk']['level'] ?? 0] }}"></iconify-icon> {{ config('helpers.flight_risk_levels')[$flightRiskResult['flight-risk']['level'] ?? 0] }} Risk
                                    </h5>
                                    <div class="orange-bg bg-white py-0" style="border-left: 2px solid #EBEBEB;">
                                        <p class="table-desc" style="line-height: 18px;">
                                            {!! $flightRiskResult['flight-risk']['description'] ?? '' !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="left-side mb-11" style="width: 56%;" id="cognitive-test-result">
                                <div class="mb-4 pt-6">
                                    <h5 class="fw-medium mb-5 box-top-text">Cognitive Test Result</h5>
                                </div>
                                <div class="mb-4">
                                    <div class="d-flex align-items-center gap-4 mb-5">
                                        <div class="d-flex align-items-center gap-2">
                                            @if (isset($cognitiveOverallResult['cognitive']['level']))
                                                @switch($cognitiveOverallResult['cognitive']['level'])
                                                    @case(1)
                                                        <div class="small-strip dark-red"></div>
                                                        <div class="small-strip grey"></div>
                                                        <div class="small-strip grey"></div>
                                                        @break
                                                    
                                                    @case(2)
                                                        <div class="small-strip light-orange"></div>
                                                        <div class="small-strip dark-orange"></div>
                                                        <div class="small-strip grey"></div>
                                                        @break
                                                    
                                                    @case(3)
                                                        <div class="small-strip light-green"></div>
                                                        <div class="small-strip medium-green"></div>
                                                        <div class="small-strip dark-green"></div>
                                                        @break
                                                @endswitch
                                            @endif
                                            {{-- <div class="small-strip {{ $cognitiveOverallResult['cognitive']['level'] == 1 ? 'dark-orange' : 'grey' }}"></div>
                                            <div class="small-strip {{ $cognitiveOverallResult['cognitive']['level'] == 2 ? 'light-orange' : ($cognitiveOverallResult['cognitive']['level'] == 1 ? 'grey' : 'dark-orange') }}"></div>
                                            <div class="small-strip {{ $cognitiveOverallResult['cognitive']['level'] == 3 ? 'dark-orange' : 'grey' }}"></div> --}}

                                        </div>
                                        <h5 class="fw-medium d-flex align-items-center gap-3">
                                        {{ config('helpers.cognitive_ability_levels')[$cognitiveOverallResult['cognitive']['level'] ?? 0] }}</h5>
                                    </div>
                                    <div class="orange-bg bg-white py-0" style="border-left: 2px solid #EBEBEB;">
                                        <p class="table-desc" style="line-height: 18px;">
                                        {!! $cognitiveOverallResult['cognitive']['description'] ?? '' !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="left-side mb-11" style="width: 56%;" id="technical-skill-match-rate">
                                <div class="mb-4 pt-6">
                                    <h5 class="fw-medium mb-5 box-top-text">Technical Skill Match Rate</h5>
                                </div>
                                <div class="mb-4">
                                    <h5 class="fw-medium mb-5 d-flex align-items-center gap-3"><iconify-icon
                                                icon="{{ config('helpers.applicant_details_icon_class_levels')[$technicalSkillMatchRateResult['technical-skill-match-rate']['level'] ?? 0] }}" width="16" height="16"
                                                class="{{ config('helpers.applicant_details_icon_color_levels')[$technicalSkillMatchRateResult['technical-skill-match-rate']['level'] ?? 0] }}"></iconify-icon>{{ config('helpers.growth_potential_levels')[$technicalSkillMatchRateResult['technical-skill-match-rate']['level'] ?? 0] }}
                                    </h5>
                                    <div class="orange-bg bg-white py-0" style="border-left: 2px solid #EBEBEB;">
                                        <p class="table-desc" style="line-height: 18px;">
                                            {!! $technicalSkillMatchRateResult['technical-skill-match-rate']['description'] ?? '' !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="left-side mb-11" style="width: 56%;" id="riasec">
                                <div class="mb-4 pt-6">
                                    <h5 class="fw-medium mb-5 box-top-text">RIASEC (Top 3)</h5>
                                </div>
                                <div class="mb-4">
                                    <h5 class="fw-medium mb-5 d-flex align-items-center gap-3" style="color: #F7941C"> {{ $riasecTop3Result['string'] ?? '' }}
                                    </h5>
                                    <div class="orange-bg bg-white py-0" style="border-left: 2px solid #EBEBEB;">
                                        <p class="table-desc" style="line-height: 18px;">
                                            {!! $riasecTop3Result['description'] ?? '' !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </section>
        @endif
        
    @else
       {{--        
        <section class="psychometric-section">
            <div class="box mb-9 d-flex align-items-center justify-content-center" style="gap: 72px;">
                <h2>Details will be available once assessments are completed by the user.</h2>
            </div>
        </section> --}}
        <div class="empty-state" style="background: #FCFCFC;">
            <p>
                Details will be available once assessments are completed by the user.
            </p>
        </div>

        

    @endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.job-centric-nav-link');
    const scrollContainer = document.getElementById('job-centric-scroll-container');
    
    if (navLinks.length > 0 && scrollContainer) {
        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    // Scroll the container to the target element
                    const containerTop = scrollContainer.offsetTop;
                    const elementTop = targetElement.offsetTop;
                    const offset = elementTop - containerTop;
                    
                    scrollContainer.scrollTo({
                        top: offset,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }
});
</script>

