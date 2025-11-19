@if (($candidate->is_personality_motivation_completed == 1) && ($candidate->is_work_interest_completed == 1) && ($candidate->is_cognitive_ability_completed == 1) && ($isUserResultExists == 1))
    <section class="psychometric-section">
        <p id="backBtn" class="mb-30 back-button fw-bold cursor-pointer show-on-click d-none">
            ← Back to the main assessment results
        </p>
                <h3 class="top-heading m-0 mb-9">Assessment Overview</h3>
                <div class="box mb-9 d-flex align-items-center" style="gap: 72px;">
                    <div class="left-side d-flex align-items-center gap-9">
                        <div class="circle-content {{ config('helpers.applicant_details_circle_content_class')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0] }}"><span class="{{ config('helpers.applicant_details_circle_color_class')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0] }}  fw-bold">{{ config('helpers.behavior_fit_rate_levels')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0] }}</span></div>
                        <div class="d-flex flex-column" style="width: 170px;">
                            <h5 class="fw-medium">Behavior Fit Rate:</h5>
                            <h2 class="{{ config('helpers.applicant_details_circle_color_class')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0] }} m-0">{{ config('helpers.behavior_fit_rate_levels')[$behaviorFitRateResult['soft-skill-score']['level'] ?? 0] }}</h2>
                        </div>
                    </div>
                    <div class="right-side w-100">
                        <div class="row gap-8 mb-5">
                            <div class="overview-div col-md-4">
                                <p class="overview-heading fw-medium">Personality Type:</p>
                                <p class="m-0 overview-heading fw-medium"> {{ $personalityTypeResult['name'] ?? '' }} </p>
                            </div>
                            <div class="overview-div col">
                                <p class="overview-heading fw-medium">Growth Potential:</p>
                                <p class="m-0 overview-sub-heading fw-bold d-flex align-items-center gap-2"><iconify-icon
                                        icon="{{ config('helpers.applicant_details_icon_class_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}" width="16" height="16"
                                        class="{{ config('helpers.applicant_details_icon_color_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}"></iconify-icon>{{ config('helpers.growth_potential_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}</p>
                            </div>
                        </div>
                        <div class="row gap-8">
                            <div class="overview-div col-md-4">
                                <p class="overview-heading fw-medium">Workplace Alignment Forecast: </p>
                                <p class="m-0 overview-sub-heading fw-bold d-flex align-items-center gap-2"><iconify-icon
                                        icon="{{ config('helpers.applicant_details_icon_class_levels')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }}" width="16" height="16"
                                        class="{{ config('helpers.applicant_details_icon_color_levels_opposite')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }}"></iconify-icon> {{ config('helpers.organizational_fit_forecast_levels')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }} Risk</p>
                            </div>
                            <div class="overview-div col-md-6">
                                <p class="overview-heading fw-medium">Flight Risk:</p>
                                <p class="m-0 overview-sub-heading fw-bold d-flex align-items-center gap-2"><iconify-icon
                                        icon="{{ config('helpers.applicant_details_icon_class_levels')[$flightRiskResult['flight-risk']['level'] ?? 0] }}" width="16" height="16"
                                        class="{{ config('helpers.applicant_details_icon_color_levels_opposite')[$flightRiskResult['flight-risk']['level'] ?? 0] }}"></iconify-icon> {{ config('helpers.flight_risk_levels')[$flightRiskResult['flight-risk']['level'] ?? 0] }} Risk</p>
                            </div>
                        </div>
                    </div>
                </div>
                <h3 class="top-heading m-0 mb-14 d-flex align-items-center gap-5">Summary of Assessment Results 
                    <!-- <span class="reset-setting-text fw-bold cursor-pointer hide-on-click" data-bs-toggle="modal" 
                        data-bs-target="#resetAssessment">
                        <img src="{{ asset('/admin/media/svg/shapes/reset-setting.svg') }}" alt="reset-setting"> Reset Assessment
                    </span> -->
                </h3>
                <!-- <div class="modal fade" id="resetAssessment" tabindex="-1" aria-labelledby="resetAssessmentLabel" aria-hidden="true"      data-bs-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content modal-div">
                            <div class="modal-body py-0 pt-5 text-center">
                                <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close" style="float: right;">
                                    <img src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel">
                                </button>
                                <iconify-icon icon="ep:warning" width="70" height="70" class="my-5 text-center" style="color: #F8BB86;"></iconify-icon>
                                <p class="fw-bolder fs-1 lh-1 text-center" style="color: #4B5675;">
                                    Are you sure you want to reset this candidate's Assessment?
                                </p>
                                <p class="m-0 text-center" style="color: #4B5675;">
                                    This action will clear all your current answers and restore the assessment to it's initial state. You will lose any analysis made so far.
                                </p>
                            </div>
                            <div class="modal-footer modal-footer d-block border-0">
                                Route needs to be created
                                <form class="filter-content d-flex justify-content-between gap-2">
                                    <button class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                                    <button class="btn btn-apply" type = "submit">
                                        Reset
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> -->
                <h5 class="fw-medium mb-5 box-top-text hide-on-click">OCEAN Personality Test</h5>
                <div class="d-grid grid-template mb-9 hide-on-click">
                    <div class="box left-side d-grid">
                        <div class="d-flex justify-content-between mb-14">
                            <div>
                                <h5 class="fw-medium">OCEAN Domain</h5>
                                <p class="m-0 overview-sub-heading fw-bold">Response Consistency Index: <span style="color: {{config('helpers.rci_class_based_on_levels')[$rciResult['rci']['level'] ?? 0]}};">{{ config('helpers.rci_levels')[$rciResult['rci']['level'] ?? 0] }}</span></p>
                            </div>
                            <p id="toggleBtn" class="m-0 view-all-text cursor-pointer">View all 30 facets</p>
                        </div>
                        @foreach (['openness-to-experience', 'conscientiousness', 'extraversion', 'agreeableness', 'emotional-stability'] as $domain)
                            <div class="skill-table mb-9">
                                <div class="inner-table">
                                    <div class="left-table">
                                        <div class="table-top-content">
                                            <div class="left-table-head">
                                                <p>{{ ucfirst(str_replace('-', ' ', $domain)) }} <span>{{ $oceanDomainResult[$domain]['score_percentage'] ?? 0 }}%</span></p>
                                            </div>
                                            <p class="table-desc">
                                                {{ $oceanDomainDescriptors->where('slug', $domain)->first()->analysis ?? ' ' }}
                                            </p>
                                        </div>
                                        <div class="line line-grey">
                                            <div style="width: {{ $oceanDomainResult[$domain]['score_percentage'] ?? 0 }}%;" class="line line-orange dark-orange"></div>
                                            <div class="svg-round-icon" style="right: {{ 100 - 2 - (($oceanDomainResult[$domain]['score_percentage']) ?? 0) }}%;">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-table">
                                        <p class="badge-content fw-bold {{ config('helpers.applicant_details_ocean_badge_percentile_color_class')[$oceanDomainResult[$domain]['level'] ?? 0] }}">
                                            {{ $oceanDomainResult[$domain]['percentage'] ?? 0 }}th
                                            <span class="badge fw-bold {{ config('helpers.applicant_details_ocean_badge_color_class')[$oceanDomainResult[$domain]['level'] ?? 0] }}">{{ config('helpers.ocean_levels')[$oceanDomainResult[$domain]['level'] ?? 0] }}</span>
                                        </p>
                                        <p class="table-desc">{{ $oceanDomainResult[$domain]['description'] ?? ' ' }}</p>
                                    </div>
                                </div>
                                <div class="line-bottom"></div>
                            </div>
                        @endforeach

                        <div class="twelve-inner">
                            <p class="overview-sub-heading fw-bold mb-3"><iconify-icon icon="octicon:light-bulb-16"
                                    style="color:#F7941C; font-size:14px; "></iconify-icon> OCEAN Summary</p>
                            <p class="table-desc">
                                {{ $oceanSummary ?? '' }}
                            </p>
                        </div>
                    </div>
                    <div class="box">
                        <div class="mb-14">
                            <h5 class="fw-medium">Learning Style</h5>
                            <p class="table-desc fw-normal d-flex gap-2"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="77" height="17" viewBox="0 0 77 17" fill="none">
                                    <rect width="77" height="17" fill="#FFF6EA" />
                                    <line x1="1" x2="1" y2="17" stroke="#FFBD6F"
                                        stroke-width="2" />
                                </svg> Candidate’s Learning Style</p>
                        </div>
                        @foreach (['visual_kinesthetic', 'aural', 'reading_writing'] as $style)
                            <div class="left-table mb-9">
                                @if ($learningStyle["{$style}_score"] > 3.75)
                                    <div class="orange-bg">
                                @endif
                                <p class="left-table-head mb-1">{{ ucfirst(str_replace('_', ' ', $style)) }} <span> {{ ($learningStyle["{$style}_percentage"]) ?? 0 }}%</span></p>
                                <p class="table-desc">
                                    {{ $learningAndDevelopmentPlanDescriptors->where('slug', str_replace('_', '-', $style))->first()->analysis ?? ' ' }}
                                </p>
                                @if ($learningStyle["{$style}_score"] > 3.75)
                                    </div>
                                @endif
                                <div class="line line-grey">
                                    <div style="width: {{ ($learningStyle["{$style}_percentage"]) ?? 0 }}%;" class="line line-orange dark-orange"></div>
                                    <div class="svg-round-icon" style="right: {{ 100 - 2 - (($learningStyle["{$style}_percentage"])) }}%;">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                        @endforeach

                        <div class="twelve-inner">
                            <p class="overview-sub-heading fw-bold mb-3">
                                <iconify-icon icon="octicon:light-bulb-16" style="color:#F7941C; font-size:14px;"></iconify-icon> Learning Style Summary
                            </p>
                            <p class="table-desc">
                                @foreach($learningStyle['learning_style_preference'] as $key => $learning_style_preference)
                                    {{ $learning_style_preference['learning_style_preference_summary'] ?? '' }} <br>
                                @endforeach
                            </p>
                        </div>

                    </div>
                </div>
                <div class="mb-9 bg-white psych-inner hide-on-click">
                    <div class="skill-div">
                        <p class="fs-2 fw-medium lh-base" style="color: #5B5B5B; margin-bottom: 45px;">Critical Core Skills</p>
                
                    </div>
                    <div class="skill-table">
                
                        <div class="inner-table" style="grid-template-columns: 48.7% 48.7%">
                            @foreach ($ccsResult as $name => $result)
                                <div class="left-table">
                                    <div class="table-top-content">
                                        <div class="left-table-head">
                                            <p>{{ $result['name'] ?? '' }}<span> {{ $result['score'] ?? 0 }}%</span>
                                            <p>
                                        </div>
                                        <p class="table-desc">
                                            {{ $ccsDomainDescriptors->where('slug', $result['slug'])->first()->analysis ?? ' ' }}</p>
                                    </div>
                                    <div class="line line-grey" style="margin-bottom: 15px">
                                        <div style="width:  {{ $result['score'] ?? 0 }}%;" class="line line-orange dark-orange">
                                        </div>
                                        <div class="svg-round-icon" style="right:  {{ 100 - 2 - $result['score'] }}%;">
                                            {{-- <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" /> --}}
                                        </div>
                                    </div>
                                    <div class="left-table-head" style="margin-top: 10px">
                                        <p class="badge-content fw-bold">
                                            <span class="badge fw-bold {{ config('helpers.ccs_badge_color_class_based_on_levels')[$result['level'] ?? 0] }}">{{ config('helpers.ccs_levels')[$result['level'] ?? 0] }}</span></p>
                                    </div>
                                    <p class="table-desc">{{ $result['description'] ?? '' }}</p>
                                </div>
                            @endforeach
                
                        </div>
                    </div>
                </div>
                <div class="d-flex grid-template mb-9 hide-on-click">
                    <div class="box left-side w-50">
                        <div class="mb-4">
                            <h5 class="fw-medium mb-4">Personality Type</h5>
                            <h5 class="fw-medium mb-4 box-top-text">{{ $personalityTypeResult['name'] ?? '' }}</h5>
                            <div class="orange-bg bg-white py-0">
                                <!-- <p class="table-desc mb-2">
                                    <span class="fw-bolder" style="color: #F7941C">Innovative Thinking:</span> Geniuses
                                    are known
                                    for their creativity and ability to think outside the box, often coming up with
                                    groundbreaking
                                    ideas and solutions.
                                </p> -->
                                <p class="table-desc">
                                        {!! str_replace(';', '<br>', $personalityTypeResult['description'] ?? '') !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="box right-side w-50">
                        <div class="mb-4">
                            <h5 class="fw-medium mb-4">Growth Potential</h5>
                            <h5 class="fw-medium mb-5 box-top-text d-flex align-items-center gap-3"><iconify-icon
                                        icon="{{ config('helpers.applicant_details_icon_class_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}" width="16" height="16"
                                        class="{{ config('helpers.applicant_details_icon_color_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}"></iconify-icon>{{ config('helpers.growth_potential_levels')[$growthPotentialResult['growth-potential']['level'] ?? 0] }}</h5>
                            <div class="orange-bg bg-white py-0">
                                <p class="table-desc">
                                    {{ $growthPotentialResult['growth-potential']['description'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex grid-template mb-9 hide-on-click">
                    <div class="box left-side w-50">
                        <div class="mb-4">
                            <h5 class="fw-medium mb-4">Workplace Alignment Forecast</h5>
                            <h5 class="fw-medium mb-4 box-top-text d-flex align-items-center gap-3"><iconify-icon
                                        icon="{{ config('helpers.applicant_details_icon_class_levels')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }}" width="16" height="16"
                                        class="{{ config('helpers.applicant_details_icon_color_levels_opposite')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }}"></iconify-icon> {{ config('helpers.organizational_fit_forecast_levels')[$organizationalFitForecastResult['organizational-fit-forecast']['level'] ?? 0] }} Risk</h5>
                            <div class="orange-bg bg-white py-0">
                                <p class="table-desc w-75">
                                {{ $organizationalFitForecastResult['organizational-fit-forecast']['description'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="box right-side w-50">
                        <div class="mb-4">
                            <h5 class="fw-medium mb-4">Flight Risk</h5>
                            <h5 class="fw-medium mb-5 box-top-text"><iconify-icon
                                        icon="{{ config('helpers.applicant_details_icon_class_levels')[$flightRiskResult['flight-risk']['level'] ?? 0] }}" width="16" height="16"
                                        class="{{ config('helpers.applicant_details_icon_color_levels_opposite')[$flightRiskResult['flight-risk']['level'] ?? 0] }}"></iconify-icon> {{ config('helpers.flight_risk_levels')[$flightRiskResult['flight-risk']['level'] ?? 0] }} Risk</h5>
                            <div class="orange-bg bg-white py-0">
                                <p class="table-desc w-75">
                                {{ $flightRiskResult['flight-risk']['description'] ??'' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="fw-medium mb-5 box-top-text hide-on-click">RIASEC Test</h5>
                <div class="d-grid grid-template mb-9 hide-on-click">
                    <div class="box left-side">
                        <div class="mb-14">
                            <h5 class="fw-medium">Work Interest</h5>
                        </div>
                        @foreach($riasecDomainResult as $slug => $result)
                            <div class="left-table mb-9">
                                <div class="@if(in_array($result['code'], $riasecTop3Result['array'])) orange-bg @else orange-bg bg-white @endif     w-75">
                                    <p class="left-table-head mb-1">{{ $result['name'] ?? '' }} <span>{{ $result['score'] ?? 0 }}%</span></p>
                                    <p class="table-desc">{{ $result['description'] ?? ' ' }}</p>
                                </div>
                                <div class="line line-grey w-75">
                                    <div style="width: {{ $result['score'] }}%;" class="line line-orange {{ $result['score'] >= 80 ? 'orange' : 'light-orange' }}"></div>
                                    <div class="svg-round-icon" style="right: {{ 100 - 2 - $result['score'] }}%;">
                                        
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="box" style="height: fit-content;">
                        <div class="mb-5">
                            <h5 class="fw-medium fs-4">Candidate’s Top 3 RIASEC:</h5>
                        </div>
                        <div class="twelve-inner w-50">
                            <h1 class="esi-text fw-medium">{{ $riasecTop3Result['string'] ?? '' }}</h1>
                            <p class="table-desc">
                                {{ $riasecTop3Result['description'] ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>
                <h5 class="fw-medium mb-5 box-top-text hide-on-click">Cognitive Ability</h5>
                <div class="d-grid grid-template hide-on-click">
                    <div class="box left-side d-grid">
                        <div class="mb-14">
                            <h5 class="fw-medium fs-4">Overall Cognitive Ability</h5>
                            <h5 class="fw-medium box-top-text m-0" class="{{ config('helpers.applicant_details_positive_3_levels_class')[$cognitiveOverallResult['cognitive']['level'] ?? 0] }}">{{ config('helpers.cognitive_ability_levels')[$cognitiveOverallResult['cognitive']['level'] ?? 0] }}</h5>
                        </div>
                        <div class="skill-table mb-9">
                            <div class="left-table w-75">
                                <div class="table-top-content w-75">
                                    <div class="left-table-head">
                                        <p>QUANTITATIVE KNOWLEDGE
                                        <p>
                                    </div>
                                    <p class="table-desc">
                                        The ability to reason numerical concepts and relationships, and to manipulate
                                        numerical
                                        symbols.
                                    </p>
                                </div>
                                <div class="progress-container">
                                    <div class="progress-fill">
                                        <div class="progress-segment segment-yellow"></div>
                                        <div class="progress-segment segment-orange"></div>
                                        <div class="progress-segment segment-blue"></div>
                                    </div>
                                    <!-- <div class="progress-circle" style="right: 12%;"> -->
                                    <div class="progress-circle" style="transform: translate({{ config('helpers.cognitive_ability_rates')[$cognitiveDomainResult   ['quantitative-knowledge']['level'] ?? 0] }}, -10%);">
                                    </div>
                                </div>
                                <p class="mb-2 overview-sub-heading fw-bold d-flex align-items-center gap-2">Level: <span
                                        class="{{ config('helpers.applicant_details_positive_3_levels_class')[$cognitiveDomainResult['quantitative-knowledge']['level'] ?? 0] }} badge fw-bold">{{ config('helpers.cognitive_ability_levels')[$cognitiveDomainResult['quantitative-knowledge']['level'] ?? 0] }}</span></p>
                                <p class="table-desc w-75">
                                {{ $cognitiveDomainResult['quantitative-knowledge']['description'] ?? 0 }}
                                </p>
                            </div>
                            <div class="line-bottom"></div>
                        </div>
                        <div class="skill-table mb-9">
                            <div class="left-table w-75">
                                <div class="table-top-content w-75">
                                    <div class="left-table-head">
                                        <p>COMPREHENSIVE KNOWLEDGE
                                        <p>
                                    </div>
                                    <p class="table-desc">
                                        A person's acquired knowledge as well as the ability to communicate knowledge using
                                        learned
                                        experiences or procedures.
                                    </p>
                                </div>
                                <div class="progress-container">
                                    <div class="progress-fill">
                                        <div class="progress-segment segment-yellow"></div>
                                        <div class="progress-segment segment-orange"></div>
                                        <div class="progress-segment segment-blue"></div>
                                    </div>
                                    <div class="progress-circle" style="transform: translate({{ config('helpers.cognitive_ability_rates')[$cognitiveDomainResult   ['comprehension-knowledge']['level'] ?? 0] }}, -10%);">
                                    </div>
                                </div>
                                <p class="mb-2 overview-sub-heading fw-bold d-flex align-items-center gap-2">Level: <span
                                        class="{{ config('helpers.applicant_details_positive_3_levels_class')[$cognitiveDomainResult['comprehension-knowledge']['level'] ?? 0] }} badge fw-bold">{{ config('helpers.cognitive_ability_levels')[$cognitiveDomainResult['comprehension-knowledge']['level'] ?? 0] }}</span></p>
                                <p class="table-desc w-75">
                                    {{ $cognitiveDomainResult['comprehension-knowledge']['description'] ?? 0 }}
                                </p>
                            </div>
                            <div class="line-bottom"></div>
                        </div>
                        <div class="skill-table mb-9">
                            <div class="left-table w-75">
                                <div class="table-top-content w-75">
                                    <div class="left-table-head">
                                        <p>Visual Reasoning
                                        <p>
                                    </div>
                                    <p class="table-desc">
                                        The ability to perceive, analyse and synthesize visual patterns, and to think with
                                        visual
                                        patterns, including the ability to store and recall visual representations.
                                    </p>
                                </div>
                                <div class="progress-container">
                                    <div class="progress-fill">
                                        <div class="progress-segment segment-yellow"></div>
                                        <div class="progress-segment segment-orange"></div>
                                        <div class="progress-segment segment-blue"></div>
                                    </div>
                                    <div class="progress-circle" style="transform: translate({{ config('helpers.cognitive_ability_rates')[$cognitiveDomainResult   ['visual-reasoning']['level'] ?? 0] }}, -10%);">
                                    </div>
                                </div>
                                <p class="mb-2 overview-sub-heading fw-bold d-flex align-items-center gap-2">Level: <span
                                        class="{{ config('helpers.applicant_details_positive_3_levels_class')[$cognitiveDomainResult['visual-reasoning']['level'] ?? 0] }} badge fw-bold">{{ config('helpers.cognitive_ability_levels')[$cognitiveDomainResult['visual-reasoning']['level'] ?? 0] }}</span></p>
                                <p class="table-desc w-75">
                                {{ $cognitiveDomainResult['visual-reasoning']['description'] ?? 0 }}
                                </p>
                            </div>
                            <div class="line-bottom"></div>
                        </div> 
                        <div class="skill-table">
                            <div class="left-table w-75">
                                <div class="table-top-content w-75">
                                    <div class="left-table-head">
                                        <p>Fluid Reasoning
                                        <p>
                                    </div>
                                    <p class="table-desc">
                                        The ability to reason, form concepts, and solve problems using unfamiliar
                                        information or
                                        novel procedures.
                                    </p>
                                </div>
                                <div class="progress-container">
                                    <div class="progress-fill">
                                        <div class="progress-segment segment-yellow"></div>
                                        <div class="progress-segment segment-orange"></div>
                                        <div class="progress-segment segment-blue"></div>
                                    </div>
                                    <div class="progress-circle" style="transform: translate({{ config('helpers.cognitive_ability_rates')[$cognitiveDomainResult   ['fluid-reasoning']['level'] ?? 0] }}, -10%);">
                                    </div>
                                </div>
                                <p class="mb-2 overview-sub-heading fw-bold d-flex align-items-center gap-2">Level: <span
                                class="{{ config('helpers.applicant_details_positive_3_levels_class')[$cognitiveDomainResult['fluid-reasoning']['level'] ?? 0] }} badge fw-bold">{{ config('helpers.cognitive_ability_levels')[$cognitiveDomainResult['fluid-reasoning']['level'] ?? 0] }}</span></p>
                                <p class="table-desc w-75">
                                {{ $cognitiveDomainResult['fluid-reasoning']['description'] ?? 0 }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="box" style="height: fit-content;">
                        <p>Result:</p>
                        <div id="result-chart" style="margin: auto; padding: 0 19%" class="mb-8"></div>
                        <div class="color-result">
                            <p class="d-flex align-items-center gap-2"><span class="small-box missed"></span>Missed
                                Questions</p>
                            <p class="d-flex align-items-center gap-2"><span class="small-box correct"></span>Correct
                                Answers</p>
                            <p class="d-flex align-items-center gap-2"><span class="small-box wrong"></span>Wrong Answers
                            </p>
                        </div>
                    </div>
                </div>
                <div class="show-on-click d-none">
                    <h5 class="fw-medium mb-5 box-top-text">OCEAN Personality Test: 30 Facets</h5>
                    <div class="d-flex grid-template mb-9">
                        <div class="box left-side d-grid w-100">
                            <div class="d-flex justify-content-between mb-14">
                                <div>
                                    <h5 class="fw-medium">Openness to Experience</h5>
                                    <!-- <p class="m-0 overview-sub-heading fw-bold">Response Consistency Index: <span
                                            style="color: #2AA443;">Consistent</span></p> -->
                                </div>
                            </div>
                            @foreach ($oceanAllFacetsResult->whereIn('slug', ['daydreaming', 'aesthetic-appreciation', 'feeling-aware', 'explorer', 'innovation', 'open-mindedness']) as $name => $result)
                                <div class="skill-table mb-9">
                                    <div class="inner-table">
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>{{ $result['name'] ?? '' }} <span>{{ $result['score_percentage'] ?? 0 ?? 0 }}%</span></p>
                                                </div>
                                                <p class="table-desc">
                                                    {{ $oceanAllFacetsDescriptors->where('slug', $result['slug'])->first()->analysis ?? '' }}
                                                </p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: {{ $result['score_percentage'] ?? 0 ?? 0 }}%;" class="line line-orange orange"></div>
                                                <div class="svg-round-icon" style="right: {{ 100 - 2 - (($result['score_percentage']) ?? 0) }}%;">
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right-table">
                                            <p class="badge-content fw-bold {{ config('helpers.applicant_details_ocean_badge_percentile_color_class')[$result['level'] ?? 0] }}">
                                                {{ $result['percentage'] ?? 0 }}th
                                                <span class="{{ config('helpers.applicant_details_ocean_badge_color_class')[$result['level'] ?? 0] }} badge fw-bold">{{ config('helpers.ocean_levels')[$result['level'] ?? 0] }}</span>
                                            </p>
                                            
                                            <p class="table-desc">{{ $result['description'] ?? '' }}</p>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                </div>
                            @endforeach
                        </div>
                        <div class="box left-side d-grid w-100">
                            <div class="d-flex justify-content-between mb-14">
                                <div>
                                    <h5 class="fw-medium">Conscientiousness</h5>
                                    <!-- <p class="m-0 overview-sub-heading fw-bold">Response Consistency Index: <span
                                            style="color: #2AA443;">Consistent</span></p> -->
                                </div>
                            </div>
                            @foreach ($oceanAllFacetsResult->whereIn('slug', ['self-confidence', 'tidiness', 'responsibility', 'drive-to-achieve', 'willpower', 'careful-thinking']) as $name => $result)
                                <div class="skill-table mb-9">
                                    <div class="inner-table">
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>{{ $result['name'] ?? '' }} <span>{{ $result['score_percentage'] ?? 0 ?? 0 }}%</span></p>
                                                </div>
                                                <p class="table-desc">
                                                    {{ $oceanAllFacetsDescriptors->where('slug', $result['slug'])->first()->analysis ?? '' }}
                                                </p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: {{ $result['score_percentage'] ?? 0 ?? 0 }}%;" class="line line-orange orange"></div>
                                                <div class="svg-round-icon" style="right: {{ 100 - 2 - (($result['score_percentage']) ?? 0) }}%;">
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right-table">
                                            <p class="badge-content fw-bold {{ config('helpers.applicant_details_ocean_badge_percentile_color_class')[$result['level'] ?? 0] }}">
                                                {{ $result['percentage'] ?? 0 }}th
                                                <span class="{{ config('helpers.applicant_details_ocean_badge_color_class')[$result['level'] ?? 0] }} badge fw-bold">{{ config('helpers.ocean_levels')[$result['level'] ?? 0] }}</span>
                                            </p>
                                            
                                            <p class="table-desc">{{ $result['description'] ?? '' }}</p>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="d-flex grid-template mb-9">
                        <div class="box left-side d-grid w-100">
                            <div class="d-flex justify-content-between mb-14">
                                <div>
                                    <h5 class="fw-medium">Extraversion</h5>
                                    <!-- <p class="m-0 overview-sub-heading fw-bold">Response Consistency Index: <span
                                            style="color: #2AA443;">Consistent</span></p> -->
                                </div>
                            </div>
                            @foreach ($oceanAllFacetsResult->whereIn('slug', ['sociability', 'crowd-enjoyment', 'confidence', 'energetic-lifestyle', 'thrill-seeking', 'optimism']) as $name => $result)
                                <div class="skill-table mb-9">
                                    <div class="inner-table">
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>{{ $result['name'] ?? '' }} <span>{{ $result['score_percentage'] ?? 0 ?? 0 }}%</span></p>
                                                </div>
                                                <p class="table-desc">
                                                    {{ $oceanAllFacetsDescriptors->where('slug', $result['slug'])->first()->analysis ?? '' }}
                                                </p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: {{ $result['score_percentage'] ?? 0 ?? 0 }}%;" class="line line-orange orange"></div>
                                                <div class="svg-round-icon" style="right: {{ 100 - 2 - (($result['score_percentage']) ?? 0) }}%;">
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right-table">
                                            <p class="badge-content fw-bold {{ config('helpers.applicant_details_ocean_badge_percentile_color_class')[$result['level'] ?? 0] }}">
                                                {{ $result['percentage'] ?? 0 }}th
                                                <span class="{{ config('helpers.applicant_details_ocean_badge_color_class')[$result['level'] ?? 0] }} badge fw-bold">{{ config('helpers.ocean_levels')[$result['level'] ?? 0] }}</span>
                                            </p>
                                            
                                            <p class="table-desc">{{ $result['description'] ?? '' }}</p>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                </div>
                            @endforeach
                        </div>
                        <div class="box left-side d-grid w-100">
                            <div class="d-flex justify-content-between mb-14">
                                <div>
                                    <h5 class="fw-medium">Agreeableness</h5>
                                    <!-- <p class="m-0 overview-sub-heading fw-bold">Response Consistency Index: <span
                                            style="color: #FF6355;">Not Consistent</span></p> -->
                                </div>
                            </div>
                            @foreach ($oceanAllFacetsResult->whereIn('slug', ['belief', 'honesty', 'helpfulness', 'diplomacy', 'humility', 'compassion']) as $name => $result)
                                <div class="skill-table mb-9">
                                    <div class="inner-table">
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>{{ $result['name'] ?? '' }} <span>{{ $result['score_percentage'] ?? 0 ?? 0 }}%</span></p>
                                                </div>
                                                <p class="table-desc">
                                                    {{ $oceanAllFacetsDescriptors->where('slug', $result['slug'])->first()->analysis ?? '' }}
                                                </p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: {{ $result['score_percentage'] ?? 0 ?? 0 }}%;" class="line line-orange orange"></div>
                                                <div class="svg-round-icon" style="right: {{ 100 - 2 - (($result['score_percentage']) ?? 0) }}%;">
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right-table">
                                            <p class="badge-content fw-bold {{ config('helpers.applicant_details_ocean_badge_percentile_color_class')[$result['level'] ?? 0] }}">
                                                {{ $result['percentage'] ?? 0 }}th
                                                <span class="{{ config('helpers.applicant_details_ocean_badge_color_class')[$result['level'] ?? 0] }} badge fw-bold">{{ config('helpers.ocean_levels')[$result['level'] ?? 0] }}</span>
                                            </p>
                                            
                                            <p class="table-desc">{{ $result['description'] ?? '' }}</p>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="d-flex grid-template">
                        <div class="box left-side d-grid w-100">
                            <div class="d-flex justify-content-between mb-14">
                                <div>
                                    <h5 class="fw-medium">Emotional Stability</h5>
                                    <!-- <p class="m-0 overview-sub-heading fw-bold">Response Consistency Index: <span
                                            style="color: #2AA443;">Consistent</span></p> -->
                                </div>
                            </div>
                            @foreach ($oceanAllFacetsResult->whereIn('slug', ['steadiness', 'tolerance', 'positivity', 'social-sensitivity', 'impulse-control', 'stress-response']) as $name => $result)
                                <div class="skill-table mb-9">
                                    <div class="inner-table">
                                        <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>{{ $result['name'] ?? '' }} <span>{{ $result['score_percentage'] ?? 0 ?? 0 }}%</span></p>
                                                </div>
                                                <p class="table-desc">
                                                    {{ $oceanAllFacetsDescriptors->where('slug', $result['slug'])->first()->analysis ?? '' }}
                                                </p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: {{ $result['score_percentage'] ?? 0 ?? 0 }}%;" class="line line-orange orange"></div>
                                                <div class="svg-round-icon" style="right: {{ 100 - 2 - (($result['score_percentage']) ?? 0) }}%;">
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right-table">
                                            <p class="badge-content fw-bold {{ config('helpers.applicant_details_ocean_badge_percentile_color_class')[$result['level'] ?? 0] }}">
                                                {{ $result['percentage'] ?? 0 }}th
                                                <span class="{{ config('helpers.applicant_details_ocean_badge_color_class')[$result['level'] ?? 0] }} badge fw-bold">{{ config('helpers.ocean_levels')[$result['level'] ?? 0] }}</span>
                                            </p>
                                            
                                            <p class="table-desc">{{ $result['description'] ?? '' }}</p>
                                        </div>
                                    </div>
                                    <div class="line-bottom"></div>
                                </div>
                            @endforeach
                        </div>
                        <div class="w-100">
                        </div>
                    </div>
                </div>
    </section>
@else
    <section class="psychometric-section">
        <div class="box mb-9 d-flex align-items-center justify-content-center" style="gap: 72px;">
            <h2>Details will be available once assessments are completed by the user.</h2>
        </div>
    </section>

@endif

