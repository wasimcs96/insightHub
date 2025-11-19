@extends('admin.layout.app')


@section('title', 'Dashboard')

@section('styles')
    <style>
        .app-wrapper {
            margin-top: 74px !important;
        }

        .app-content {
            padding-top: 15px !important;
        }

        .app-container {
            padding: 0px !important;
            margin: 0px 186px !important;
        }

        .nav-link {
            padding: 16px !important;
            margin: 0px !important;
        }

        .profile-card {
            padding: 39px 24px 0px !important
        }

        .mb-11 {
            margin-bottom: 36px !important;
        }

        .gap-7 {
            gap: 24px !important;
        }

        .gap-4 {
            gap: 16px !important;
        }

        .psych-inner {
            padding: 30px 40px 45px 40px;
        }

        .table-desc {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 400;
        }

        .left-table-head {
            color: #5B5B5B;
            font-size: 16px;
            font-weight: 500;
            line-height: normal;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 4px;
        }

        .left-table-head p {
            margin-bottom: 5px;
        }

        .left-table-head span {
            color: #F7941C;
            font-weight: 700;
        }

        .line-grey {
            background-color: #e6e6e6;
            position: relative;
            margin-top: 15px;
            width: 100%;
            height: 15px;
            background: #EBEBEB;
        }

        .ocean-grey {
            margin-top: 14.4px;
            height: 21.28px;

        }

        .ocean-orange {
            height: 21.28px !important;
        }

        .line-orange {
            height: 15px;
        }

        .fade-orange {
            background: #FABB6E;
        }

        .dark-orange {
            background: #F7941C;
        }

        .svg-round-icon {
            position: absolute;
            bottom: -0.701px;
            top: 13%;
            transform: translateY(-50%);
        }

        .line {
            border-radius: 7.14px;
        }

        .line-bottom {
            background: #E1E1E1;
            width: 100%;
            height: 1px;
        }

        .tweleve-head {
            color: #5B5B5B;
            font-size: 18px;
            font-weight: 500;
            line-height: normal;
            margin-bottom: 15px;
        }

        .tweleve-desc {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 8.4px;
        }

        .tweleve-desc img {
            margin-right: 5px;
            position: relative;
            top: 2px;
        }

        .skill-table {
            display: grid;
            gap: 30px;
        }

        .skill-table .table-desc {
            margin: 0;
        }

        .orange-bg {
            padding: 10px 10px 10px 15px;
            background: #FFF6EA;
            border-left: 2px solid #FABB6E;
        }

        .orange-bg .table-desc {
            margin: 0;
        }

        .work-right-head {
            color: #5B5B5B;
            font-size: 18px;
            font-weight: 500;
            line-height: 22px;
        }

        .work-orange {
            color: #F7941C;
            font-size: 36px;
            font-weight: 500;
            line-height: normal;
            margin: 12.8px 0px 6.4px 0px;
        }

        .bg-white {
            border-radius: 8px;
            background: #F1F1F4;
            border: 1px solid #F1F1F4;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .inner-table {
            display: grid;
            grid-template-columns: 47% 47%;
            gap: 70px;
        }

        .left-table-head span {
            color: #F7941C;
            font-weight: 700;
        }

        .table-desc {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 400;
        }

        .right-bot {
            color: #5B5B5B;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            display: table;
            margin: 7px 0px;

        }

        .right-bot span {
            padding: 2.626px 6.795px;
            position: relative;
            left: 7px;
            border-radius: 5.421px;
            background: #F7941C;
            color: #FFF;
            font-size: 9px;
            line-height: 14px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .purple,
        .cyan,
        .orange,
        .spring {
            font-size: 12px;
            font-weight: 600;
            line-height: normal;
        }

        .purple span,
        .cyan span,
        .orange span,
        .green span,
        .spring span {
            border-radius: 8px;
            position: relative;
            font-size: 11px;
            font-weight: 600;
            left: 6.4px;
            padding: 2px 8.6px;
            text-transform: uppercase;
        }

        .purple span {
            background: #E1D8FB;
            color: #7F66CA;
        }

        .cyan span {
            background: #B2ECEC;
            color: #108585;
        }

        .orange span {
            background: #FDE2C1;
            color: #F7941C;
        }

        .spring span {
            color: #F7941C;
            background: #FFEBB4;
        }

        .green span {
            color: #218336;
            background: #BBECC5 !important;
        }
    </style>

    <style>
        .circle {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            position: relative;
        }

        .circle-completed {
            border: 10px solid #f7931e;

        }

        .circle-incompleted {
            border: 10px solid #a5a5a5;

        }

        .circle span {
            font-size: 18px;
            color: #f7931e;
            font-weight: 700;
        }

        .circle p {
            font-size: 12px;
            color: #666;
            position: absolute;
            bottom: -20px;
            width: 100%;
            text-align: center;
        }

        .top-learning-text {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            font-size: 12px;
            line-height: 15px;
            /* identical to box height, or 125% */

            /* Caption grey */
            color: #5B5B5B;


        }

        .right-yellow-border-cont {
            /* Rectangle 126 */

            border-left: 1px solid #FFBD6F;
            /* Light orange highlight */
            background: #FFF6EA;
            height: 17px;
            width: 77px;

        }

        .reading-writing-cont {
            /* Rectangle 126 */
            padding: 10px 15px;
            border-left: 2px solid #FFBD6F;
            /* Light orange highlight */
            background: #FFF6EA;


        }

        .circle.completed span {
            font-size: 36px;
        }

        .circle.completed p {
            font-size: 16px;
            color: #333;
        }

        .assessment-card .circle.completed span {
            color: #f7931e;
        }

        .card-body-riasec {
            box-shadow: none !important;
            border: none !important;
            padding: 0;
            margin: 0;
        }

        @media (max-width: 360px) {
            .circle {
                width: 90px;
                height: 90px;
            }

            .emp_a {
                width: 15px;
                height: 15px;
            }

            .emp_b {
                width: 15px;
                height: 15px;
            }


        }

        .text-active-primary.active {
            color: #f7941d !important;
        }

        @media only screen and (min-width: 350px) and (max-width: 991px) {
            .app-container {
                padding: 0px !important;
                margin: 10px 10px !important;
            }

            .left-table-head {
                flex-direction: column;
                gap: 0;
                align-items: flex-start;
            }

            .app-wrapper {
                margin-top: 0px !important;
            }

            .app-content {
                padding-top: 0px !important;
            }

            .profile-card {
                padding: 20px 16px 0px !important;
            }

            .card-wrapper-main {
                padding: 16px;
                margin-top: 0;
            }

            .inner-table {
                grid-template-columns: 100%;
            }

            .psych-inner {
                padding: 16px;
            }

            .upper-cards {
                flex-direction: column;
                gap: 10px;
                margin: auto !important;
                padding: 0px 24px;
            }

            .upper-cards .card {
                min-width: 100% !important;
            }

            .upper-cards .card-title {
                margin: 20px 10px 0px 10px !important;
            }
        }

        @media only screen and (min-width: 992px) and (max-width: 1101px) {
            .app-container {
                padding: 0px !important;
                margin: 0px 10px !important;
            }
        }

        @media only screen and (min-width: 1101px) and (max-width: 1201px) {
            .app-container {
                padding: 0px !important;
                margin: 0px 50px !important;
            }
        }

        @media only screen and (min-width: 1202px) and (max-width: 1351px) {
            .app-container {
                padding: 0px !important;
                margin: 0px 70px !important;
            }
        }

        @media only screen and (min-width: 1352px) and (max-width: 1401px) {
            .app-container {
                padding: 0px !important;
                margin: 0px 120px !important;
            }
        }

        .badge-custom {
            border-radius: 8px;
            position: relative;
            font-size: 11px;
            font-weight: 600;
            left: 6.4px;
            padding: 2px 8.6px;
            text-transform: uppercase;
        }

        .badge-custom {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            padding: 3.3px 7.7px;
            border-radius: 11px;
            background: #FFEBB4 !important;
            color: #F7941C !important;
        }
    </style>
@endsection

@section('content')
    <div id="kt_app_content" class="app-content  flex-column-fluid">
        <div id="kt_app_content_container" class="app-container  ">
            <div class="row mb-5 ms-0 me-0 justify-content-center mt-0">
                @include('employee.dashboard.includes.card')
                <!-- begin::Assessment Chart Section -->
                <div class="row g-5 g-xl-8 d-flex mb-9 upper-cards"
                    style="justify-content: space-between; flex-wrap: wrap;  margin-bottom: 2.25rem !important">
                    <!-- begin:chart1 (Personality & Motivation) -->
                    <div class="card mt-0 rounded-20px shadow-sm" style="flex-grow: 1; min-width: 300px; max-width: 32.5%;">
                        <h3 class="card-title d-flex justify-content-between mt-4 fs-4">Personality & Motivation
                            @if (auth()->user()->is_personality_motivation_completed == 1)
                                <a href="/quiz/five-factor/results" type="button" class="fs-7" style="color: #f7931e;">
                                    Show result
                                </a>
                            @endif
                        </h3>
                        <div class="card-toolbar">
                        </div>
                        <div class="card-body my-15 p-0">
                            <div
                                class="circle @if (auth()->user()->is_personality_motivation_completed == 1) circle-completed  @else circle-incompleted @endif">
                                @if (auth()->user()->is_personality_motivation_completed == 1)
                                    <span class="text-center">Completed</span>
                                @else
                                    <a href="/quiz/five-factor/intro" class="text-center text-primary fw-medium">Start
                                        Assessment</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- end:chart 1 (Personality & Motivation) -->

                    <!-- begin:chart 2 (Work Interest) -->
                    <div class="card mt-0 rounded-20px shadow-sm" style="flex-grow: 1; min-width: 300px; max-width: 32.5%;">
                        <h3 class="card-title d-flex justify-content-between mt-5 m-1 fs-4"> Work Interest
                            @if (auth()->user()->is_work_interest_completed == 1)
                                <a type="button" href="/quiz/interest-riasec/results" class="fs-7"
                                    style="color: #f7931e;">
                                    Show result
                                </a>
                            @endif
                        </h3>
                        <div class="card-toolbar">
                        </div>
                        <div class="card-body my-15 p-0">
                            <div
                                class="circle @if (auth()->user()->is_work_interest_completed == 1) circle-completed  @else circle-incompleted @endif">
                                @if (auth()->user()->is_work_interest_completed == 1)
                                    <span class="text-center">Completed</span>
                                @else
                                    <a href="/quiz/interest-riasec/intro" class="text-center text-primary fw-medium">Start
                                        Assessment</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- end:chart 2 (Work Interest) -->

                    <!-- begin:chart 3 (Cognitive Ability) -->
                    <div class="card mt-0 rounded-20px shadow-sm" style="flex-grow: 1; min-width: 300px; max-width: 32.5%;">
                        <h3 class="card-title d-flex justify-content-between mt-4 fs-4">Cognitive Ability
                            @if (auth()->user()->is_cognitive_ability_completed == 1)
                                {{-- <a href="/quiz/cognitive-ability/results" class="fs-7" style="color: #f7931e;">
                                Show result
                            </a> --}}
                            @endif
                        </h3>
                        <div class="card-toolbar">
                        </div>
                        <div class="card-body my-15 p-0">
                            <div
                                class="circle   @if (auth()->user()->is_cognitive_ability_completed == 1) circle-completed  @else circle-incompleted @endif ">

                                @if (auth()->user()->is_cognitive_ability_completed == 1)
                                    <span class="text-center">Completed</span>
                                @else
                                    <a href="/quiz/cognitive-ability/intro" class="text-center text-primary fw-medium">Start
                                        Assessment</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- end:chart 3 (Cognitive Ability) -->
                </div>
                <!-- end::Assessment Chart Section -->
                <!--begin:: Psychometric-->
                <div class="tab-pane fade show active p-0" id="kt_tab_pane_1" role="tabpanel">
                    @if (auth()->user()->is_personality_motivation_completed == 1 && $isUserResultExists)
                        <!--begin::Col 1 -->
                        <div class="d-flex flex-column flex-md-row mb-9 gap-5 justify-content-center">
                            <div class="col-xl-6 pr-3 pl-0" style="margin-right: 4px;">
                                <!--begin::Engage widget 1-->
                                <div class="card psych-inner" dir="ltr">
                                    <!--begin::Title-->
                                    <h3 class="fs-2 fw-bolder lh-base" style="color: #5B5B5B; margin-bottom: 45px;">OCEAN
                                        Domain
                                    </h3>
                                    <!--end::Title-->
                                    <div class="psych-bar d-flex flex-column gap-9">

                                        <div class="left-table">
                                            <p class="left-table-head">Openness To Experience<span>
                                                    {{ $oceanDomainResult['openness-to-experience']['score_percentage'] ?? 0 }}%</span>
                                            </p>
                                            <p class="table-desc">
                                                {{-- {{ $oceanDomainResult['openness-to-experience']['description'] ?? 0 }}  --}}
                                                {{-- {{ $oceanDomainDescriptors->where('slug', 'openness-to-experience')->first()->analysis ?? ' ' }} --}}
                                                Imaginative, curious, open-minded, and willing to try new things. They tend
                                                to have a wide range of interests and a vivid imagination.
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: {{ $oceanDomainResult['openness-to-experience']['score_percentage'] ?? 0 }}%;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon"
                                                    style="right: {{ 100 - 2 - ($oceanDomainResult['openness-to-experience']['score_percentage'] ?? 0) }}%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="line-bottom"></div>
                                        <div class="left-table">
                                            <p class="left-table-head">Conscientiousness<span>
                                                    {{ $oceanDomainResult['conscientiousness']['score_percentage'] ?? 0 }}%</span>
                                            </p>
                                            <p class="table-desc">
                                                {{-- {{ $oceanDomainResult['conscientiousness']['description'] ?? 0 }} --}}
                                                {{ $oceanDomainDescriptors->where('slug', 'high-self-control')->first()->analysis ?? ' ' }}
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: {{ $oceanDomainResult['conscientiousness']['score_percentage'] ?? 0 }}%;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon"
                                                    style="right: {{ 100 - 2 - $oceanDomainResult['conscientiousness']['score_percentage'] }}%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="line-bottom"></div>
                                        <div class="left-table">
                                            <p class="left-table-head">Extraversion<span>
                                                    {{ $oceanDomainResult['extraversion']['score_percentage'] ?? 0 }}%</span>
                                            </p>
                                            <p class="table-desc">
                                                {{ $oceanDomainDescriptors->where('slug', 'extraversion')->first()->analysis ?? ' ' }}
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: {{ $oceanDomainResult['extraversion']['score_percentage'] ?? 0 }}%;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon"
                                                    style="right: {{ 100 - 2 - $oceanDomainResult['extraversion']['score_percentage'] }}%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="line-bottom"></div>
                                        <div class="left-table">
                                            <p class="left-table-head">Agreeableness<span>
                                                    {{ $oceanDomainResult['agreeableness']['score_percentage'] ?? 0 }}%</span>
                                            </p>
                                            <p class="table-desc">
                                                {{-- {{ $oceanDomainResult['agreeableness']['description'] ?? '' }} --}}
                                                {{ $oceanDomainDescriptors->where('slug', 'agreeableness')->first()->analysis ?? ' ' }}
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: {{ $oceanDomainResult['agreeableness']['score_percentage'] ?? 0 }}%;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon"
                                                    style="right: {{ 100 - 2 - $oceanDomainResult['agreeableness']['score_percentage'] }}%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="line-bottom"></div>
                                        <div class="left-table">
                                            <p class="left-table-head">Emotional Stability<span>
                                                    {{ $oceanDomainResult['emotional-stability']['score_percentage'] ?? 0 }}%</span>
                                            </p>
                                            <p class="table-desc">
                                                {{-- {{ $oceanDomainResult['emotional-stability']['description'] ?? '' }} --}}
                                                {{ $oceanDomainDescriptors->where('slug', 'low-anxiety')->first()->analysis ?? ' ' }}
                                            </p>
                                            <div class="line line-grey">
                                                <div style="width: {{ $oceanDomainResult['emotional-stability']['score_percentage'] ?? 0 }}%;"
                                                    class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon"
                                                    style="right: {{ 100 - 2 - $oceanDomainResult['emotional-stability']['score_percentage'] }}%;">
                                                    <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Engage widget 1-->
                            </div>
                            <!--end::Col 1-->

                            <!--begin::Col 2-->
                            <div class="col-xl-6 pl-3">
                                <!--begin::Chart widget 5-->
                                <div class="card psych-inner">
                                    <!--begin::Header-->
                                    <h3 class="fs-2 fw-bolder lh-base" style="color: #5B5B5B; margin-bottom: 10px;">
                                        Learning Style
                                    </h3>
                                    <div class="d-flex justify-content-start gap-2">
                                        <div class="right-yellow-border-cont"></div>
                                        <div class="top-learning-text" style="margin-bottom: 35px;">Your Preferred
                                            Learning Style</div>
                                    </div>
                                    <div class="psych-bar d-flex flex-column gap-9">

                                        <div class="left-table">
                                            @if ($learningStyle['visual_kinesthetic_score'] > 3.75)
                                                <div class="orange-bg">
                                            @endif
                                            <p class="left-table-head">Visual & Kinesthetic<span>
                                                    {{ $learningStyle['visual_kinesthetic_percentage'] ?? 0 }}%</span>
                                                @if (in_array('visual_kinesthetic', $learningStyle['highest_score_keys']))
                                                    <span class="badge-custom">
                                                        Top
                                                    </span>
                                                @endif

                                            </p>
                                            <p class="table-desc">
                                                {{ $learningAndDevelopmentPlanDescriptors->where('slug', 'visual-kinesthetic')->first()->analysis ?? ' ' }}
                                            </p>
                                            @if ($learningStyle['visual_kinesthetic_score'] > 3.75)
                                        </div>
                    @endif
                    <div class="line line-grey">
                        <div style="width: {{ $learningStyle['visual_kinesthetic_percentage'] ?? 0 }}%;"
                            class="line line-orange dark-orange"></div>
                        <div class="svg-round-icon"
                            style="right: {{ 100 - 2 - $learningStyle['visual_kinesthetic_percentage'] }}%; ">
                            <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                        </div>
                    </div>
                </div>

                <div class="line-bottom"></div>

                <div class="left-table">
                    @if ($learningStyle['aural_score'] > 3.75)
                        <div class="orange-bg">
                    @endif
                    <p class="left-table-head">AURAL<span> {{ $learningStyle['aural_percentage'] ?? 0 }}%</span>
                        @if (in_array('aural', $learningStyle['highest_score_keys']))
                            <span class="badge-custom">
                                Top
                            </span>
                        @endif
                    </p>
                    <p class="table-desc">
                        {{ $learningAndDevelopmentPlanDescriptors->where('slug', 'aural')->first()->analysis ?? ' ' }}
                    </p>
                    @if ($learningStyle['aural_score'] > 3.75)
                </div>
                @endif
                <div class="line line-grey">
                    <div style="width: {{ $learningStyle['aural_percentage'] ?? 0 }}%;"
                        class="line line-orange dark-orange"></div>
                    <div class="svg-round-icon" style="right: {{ 100 - 2 - $learningStyle['aural_percentage'] }}%;">
                        <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                    </div>
                </div>
            </div>

            <div class="line-bottom"></div>
            <div class="left-table">
                @if ($learningStyle['reading_writing_score'] > 3.75)
                    <div class="orange-bg">
                @endif
                <p class="left-table-head">Reading & Writing<span>
                        {{ $learningStyle['reading_writing_percentage'] ?? 0 }}%</span>
                    @if (in_array('reading_writing', $learningStyle['highest_score_keys']))
                        <span class="badge-custom">
                            Top
                        </span>
                    @endif
                </p>
                <p class="table-desc">
                    {{ $learningAndDevelopmentPlanDescriptors->where('slug', 'reading-writing')->first()->analysis ?? ' ' }}
                </p>
                @if ($learningStyle['reading_writing_score'] > 3.75)
            </div>
            @endif
            <div class="line line-grey">
                <div style="width: {{ $learningStyle['reading_writing_percentage'] ?? 0 }}%;"
                    class="line line-orange dark-orange"></div>
                <div class="svg-round-icon"
                    style="right: {{ 100 - 2 - $learningStyle['reading_writing_percentage'] }}%;">
                    <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                </div>
            </div>
        </div>

        <div class="line-bottom"></div>
        <div class="tweleve-inner">
            <p class="tweleve-desc"><iconify-icon icon="octicon:light-bulb-16"
                    style="color:#F7941C; font-size:14px; "></iconify-icon> Learning Style
                Summary</p>
            <p class="table-desc"
                style="
                                        font-size: 14px; line-height: normal;
                                        ">
                @foreach ($learningStyle['learning_style_preference'] as $key => $learning_style_preference)
                    {{ $learning_style_preference['learning_style_preference_summary'] ?? '' }} <br>
                @endforeach
            </p>
        </div>
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    </div>
    <!--end::Body-->
    </div>
    <!--end::Chart widget 5-->
    </div>

    {{-- @if ($employee->role_name == 'employee')
                            <div class="mb-9 bg-white psych-inner">
                                <div class="skill-div">
                                    <p class="fs-2 fw-medium lh-base" style="color: #5B5B5B; margin-bottom: 45px;">Skills
                                        Alignment: Critical Core Skills</p>

                                </div>
                                <div class="skill-table">
                                    @foreach ($jobCcsResult as $name => $result)
                                        <div class="inner-table">
                                            <div class="left-table">
                                            <div class="table-top-content">
                                                <div class="left-table-head">
                                                    <p>{{ $result['name'] ?? '' }}<span>  {{ $result['score'] ?? 0}}%</span>
                                                    <p>
                                                    <p class="{{ config('helpers.ccs_class_based_on_levels')[$result['level'] ?? 0] }}"><span>{{ config('helpers.ccs_levels')[$result['level'] ?? 0] }}</span></p>
                                                </div>
                                                <p class="table-desc">{{ $ccsDomainDescriptors->where('slug', $result['slug'])->first()->analysis ?? ' ' }}</p>
                                            </div>
                                            <div class="line line-grey">
                                                <div style="width: {{ $result['score'] ?? 0}}%;" class="line line-orange dark-orange"></div>
                                                <div class="svg-round-icon" style="right: {{ 100 - 2 - ($result['score']) }}%; ">
                                                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                                </div>
                                            </div>
                                            </div>
                                            <div class="right-table">
                                            <p class="{{ config('helpers.ccs_class_based_on_levels')[$result['required_level'] ?? 0] }}">Generic Skills Requirement <span>{{ config('helpers.ccs_levels')[$result['required_level'] ?? 0] }}</span></p>
                                            <p class="table-desc">
                                                {{ $result['description'] ?? '' }}
                                            </p>
                                            </div>
                                        </div>
                                        <div class="line-bottom"></div>
                                    @endforeach
                                </div>
                            </div>
                        @endif --}}
    <div class="mb-9 bg-white psych-inner">
        <div class="skill-div">
            <p class="fs-2 fw-medium lh-base" style="color: #5B5B5B; margin-bottom: 45px;">Critical Core Skills</p>

        </div>
        <div class="skill-table">
            <div class="inner-table">
                <?php $i = 1; ?>
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
                                <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                            </div>
                        </div>
                        {{-- <div class="left-table-head" style="margin-top: 10px">
                                                <p class="{{ config('helpers.ccs_class_based_on_levels')[$result['level'] ?? 0] }}"><span>{{ config('helpers.ccs_levels')[$result['level'] ?? 0] }}</span></p>
                                            </div>
                                            <p class="table-desc">{{ $result['description'] ?? '' }}</p> --}}
                    </div>
                    @if ($i % 2 == 0)
                        <div class="line-bottom" style ="width: 120%;"></div>
                        <div class="line-bottom"></div>
                    @endif
                    <?php $i = $i + 1; ?>
                @endforeach

            </div>
        </div>
    </div>

    <!--end::Col-->
@else
    <div class="d-flex">
        <div class="col-xl-12">
            <div class="card psych-inner">
                <h6 class="text-center">
                    Complete Assessments to see the detailed result
                </h6>
            </div>
        </div>
    </div>
    @endif

    @if (auth()->user()->is_work_interest_completed == 1 && $isUserResultExists)
        <!--begin::Col 1 -->
        <div class="d-flex flex-column flex-md-row mb-9 gap-5 justify-content-center">
            <div class="col-xl-6 pr-3 pl-0">
                <!--begin::Engage widget 1-->
                <div class="card psych-inner" dir="ltr">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <!-- Left: Work Interest Heading -->
                        <div>
                            <h3 class="fs-2 fw-bold lh-base m-0 mb-2" style="color: #5B5B5B;">Work Interest</h3>
                            <div class="d-flex align-items-center gap-2">
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="77" height="17" viewBox="0 0 77 17" fill="none">
                                                <rect width="77" height="17" fill="#FFF6EA" />
                                                <line x1="1" x2="1" y2="17" stroke="#FFBD6F" stroke-width="2" />
                                            </svg>
                                        <p class="work-right-head m-0" style="font-size: 12px;">Job Position's Top 3 RIASEC</p> --}}
                            </div>
                        </div>

                        <div> <!-- Right: Job's Top 3 RIASEC Heading -->
                            {{-- <p class="work-right-head m-0 mb-3">Job's Top 3 RIASEC:</p>
                                            <p class="work-orange m-0">{{ $riasecTop3Result['job_top_3_riasec'] ?? '' }}</p> --}}
                        </div>

                    </div>
                    <!--end::Title-->
                    <div class="psych-bar d-flex flex-column gap-9">
                        @foreach ($riasecDomainResult as $slug => $result)
                            <div class="left-table">
                                {{-- @if (in_array($result['code'], $riasecTop3Result['job_top_3_riasec_array']))
                                                <div class="orange-bg">
                                                @endif --}}
                                <p class="left-table-head">{{ $result['name'] ?? '' }}<span>
                                        {{ $result['score'] ?? 0 }}%</span></p>
                                <p class="table-desc">{{ $result['description'] ?? '' }}</p>
                                {{-- @if (in_array($result['code'], $riasecTop3Result['job_top_3_riasec_array']))
                                                </div>
                                                @endif --}}
                                <div class="line line-grey">
                                    <div style="width: {{ $result['score'] }}%;" class="line line-orange dark-orange">
                                    </div>
                                    <div class="svg-round-icon" style="right: {{ 100 - 2 - $result['score'] }}%;">
                                        <img src="{{ asset('admin/media/pdf/RoundIcon.svg') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="line-bottom"></div>
                        @endforeach
                    </div>
                </div>
                <!--end::Engage widget 1-->
            </div>
            <!--end::Col 1-->

            <!--begin::Col 2-->
            <div class="col-xl-6 pl-3">
                <!--begin::Chart widget 5-->
                <div class="card psych-inner">
                    <!--begin::Header-->
                    <div class="psych-bar d-flex flex-column gap-9">
                        <div class="work-right-inner">
                            <p class="work-right-head">Your Top 3 RIASEC:</p>
                            <p class="work-orange">{{ $riasecTop3Result['string'] ?? '' }}</p>
                            <p class="table-desc">
                                {{ $riasecTop3Result['description'] ?? '' }}
                            </p>
                        </div>
                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Chart widget 5-->
        </div>
        <!--end::Col-->
    @endif
    </div>
    </div>
    </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0"></script>
    <script>
        $(document).ready(function() {
            // Check if first_time_redirect parameter is present in URL
            const urlParams = new URLSearchParams(window.location.search);
            const firstTimeRedirect = urlParams.get('first_time_redirect');

            if (firstTimeRedirect === 'true') {
                // Remove the parameter from URL without reload
                const newUrl = window.location.pathname + window.location.hash;
                window.history.replaceState({}, document.title, newUrl);

                // Show the assessment completed modal
                if (typeof ModalManager !== 'undefined') {
                    ModalManager.open({
                        module: 'employee_module',
                        key: "assessment_completed",
                        data: {},
                        onSubmit(modalEl1) {
                            const bsModal = bootstrap.Modal.getInstance(modalEl1);
                            if (bsModal) bsModal.hide();
                        }
                    });
                } else {
                    console.error('ModalManager is not defined');
                }
            }
        });
    </script>
@endsection
