@extends('employee.layout.app')

@section('title', 'Dashboard')

@section('styles')

    <style>
        .container {
            width: 80%;
            max-width: 780px;
            margin: 20px auto;
        }

        .slider-legend_cognitive {
            width: 11%;
            text-align: center;
            font-size: 11px;
            border-radius: 28px;
            padding: 0px;
            color: white;
        }

        .slider-container {
            display: flex;
            align-items: center;
            /* margin: 17px 0px; */
        }

        .slider-label {
            width: 20%;
            text-align: center;
            font-size: 14px;
        }

        .slider-track {
            width: 80%;
            position: relative;
            height: 30px;
            background: #f1f1f1;
            border-radius: 32px;
            margin: 26px 1%;
            max-width: 523px;
        }

        .slider-bar {
            position: absolute;
            top: 50%;
            left: 10%;
            right: 10%;
            height: 4px;
            background: #aaa;
            transform: translateY(-50%);
        }

        .slider-indicator {
            position: absolute;
            top: -20px;
            background: #fff;
            color: #333;
            padding: 2px 5px;
            font-size: 12px;
            border-bottom-right-radius: 50px;
            border-bottom-left-radius: 53px;
            border: 1px solid #aaa;
        }

        .emp_a,
        .emp_b {
            position: absolute;
            top: 1px;
            width: auto;
            height: auto;
            background-color: #005daf;
            border-radius: 50%;
            font-size: smaller;
            color: white;
            padding: 4px 7px;
            /* border-left: 10px solid transparent;
      border-right: 10px solid transparent;
      border-top: 10px solid #00f; */
        }

        .emp_a {
            background-color: #0245A3;
            padding: 15px;
        }

        .emp_b {
            background-color: #1AB93B;

        }

        .slider-legend {
            width: 11%;
            text-align: center;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .slider-label {
                font-size: 9px;
                display: block !important;
            }

            .riasec {
                margin-top: 1.25rem !important;
            }

            .slider-indicator {
                font-size: 10px;
            }

            .emp_a,
            .emp_b {
                position: absolute;
                top: 1px;
                width: auto;
                height: auto;
                background-color: #005daf;
                border-radius: 50%;
                font-size: smaller;
                color: white;
                padding: 14px 14px;
            }

            .emp_a {
                background-color: #0245A3;

            }

            .emp_b {
                background-color: #1AB93B;

            }

            .slider-legend {
                width: 17%;
                text-align: center;
                font-size: 14px;
            }
        }
    </style>
@endsection
@section('content')

    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Dashboard
                </h1>
                <!--end::Title-->


                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="/dashboard" class="text-muted text-hover-primary">
                            @if (auth()->user()->isEmployee())
                                Employee
                            @else
                                Candidate
                            @endif
                        </a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        Dashboard </li>
                    <!--end::Item-->

                </ul>
                <!--end::Breadcrumb-->
            </div>


            <!--end::Page title-->

            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->


    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  ">
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">

                {{-- <div class="card p-6"> --}}

                <div class="row g-5 g-xl-8" style="justify-content: space-between;">

                    <div class="col-xl-3">
                        <!--begin::Statistics Widget 2-->
                        <div class="card card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body d-flex align-items-center pt-3 pb-0">
                                <div class="d-flex flex-column flex-grow-1 py-2 py-lg-13 me-2">
                                    <a href="#"
                                        class="fw-bold text-gray-900 fs-4 mb-2 text-hover-primary">{{ auth()->user()->name ? auth()->user()->first_name . ' ' . auth()->user()->last_name : '' }}</a>

                                    <span class="fw-semibold text-muted fs-5">

                                        {{ auth()->user()->position->title ?? (auth()->user()->job_title ?? 'Job Title') }} |
                                        {{ auth()->user()->department->name ?? 'Department Name' }}
                                    </span>
                                </div>


                                <img src="{{ asset(auth()->user()->profile_picture) }}"
                                    style="border-top-left-radius: 11px;border-top-right-radius: 11px;
                                    "
                                    onerror="this.src='{{ asset('images/default-user.svg') }}'" alt=""
                                    class="align-self-end h-100px">


                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Statistics Widget 2-->
                    </div>

                    <!-- BEGIN: Group Chart3 -->



                    <div class="card bg-light-warning  card-xl-stretch mb-xl-8 col-xl-3 cursor-pointer"
                        @if (auth()->user()->is_personality_motivation_completed == 1) onclick="window.location.href='/quiz/five-factor/results'" @else onclick="window.location.href='/quiz/five-factor/intro'" @endif>

                        <div class="card-body my-3">
                            <a class="card-title fw-bold text-warning  fs-5 mb-3 d-block"
                                @if (auth()->user()->is_personality_motivation_completed == 1) href="/quiz/five-factor/results"
                                        @else
                                        href="/quiz/five-factor/intro" @endif>
                                Personality & Motivation </a>

                            <div class="py-1">
                                @if (auth()->user()->is_personality_motivation_completed == 1)
                                    <span class="text-gray-900 fs-1 fw-bold me-2">Completed</span>
                                @else
                                    <span class="text-gray-900 fs-1 fw-bold me-2">Pending</span>
                                @endif

                            </div>

                            <div class="progress h-7px bg-warning  bg-opacity-50 mt-7">
                                <div class="progress-bar bg-warning " role="progressbar"
                                    @if (auth()->user()->is_personality_motivation_completed == 1) style="width: 100%"  @else style="width: 0%" @endif
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--end:: Body-->
                    </div>




                    <div class="card bg-light-primary  card-xl-stretch mb-xl-8 col-xl-3 cursor-pointer"
                        @if (auth()->user()->is_work_interest_completed == 1) onclick="window.location.href='/quiz/interest-riasec/results'" @else onclick="window.location.href='/quiz/interest-riasec/intro'" @endif>

                        <div class="card-body my-3">
                            <a class="card-title fw-bold text-info  fs-5 mb-3 d-block"
                                @if (auth()->user()->is_work_interest_completed == 1) href="/quiz/interest-riasec/results"
                                            @else
                                            href="/quiz/interest-riasec/intro" @endif>
                                Work Interest </a>

                            <div class="py-1">
                                @if (auth()->user()->is_work_interest_completed == 1)
                                    <span class="text-gray-900 fs-1 fw-bold me-2">Completed</span>
                                @else
                                    <span class="text-gray-900 fs-1 fw-bold me-2">Pending</span>
                                @endif

                            </div>

                            <div class="progress h-7px bg-info  bg-opacity-50 mt-7">
                                <div class="progress-bar bg-info " role="progressbar"
                                    @if (auth()->user()->is_work_interest_completed == 1) style="width: 100%"  @else style="width: 0%" @endif
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--end:: Body-->
                    </div>


                    <div class="card bg-light-success card-xl-stretch mb-xl-8 col-xl-3 cursor-pointer"
                        @if (auth()->user()->is_cognitive_ability_completed == 1) onclick="window.location.href='/quiz/cognitive-ability/results'" @else  
                            onclick="window.location.href='/quiz/cognitive-ability/intro'" @endif>

                        <div class="card-body my-3">
                            <a class="card-title fw-bold text-success fs-5 mb-3 d-block"
                                @if (auth()->user()->is_cognitive_ability_completed == 1) href="/quiz/cognitive-ability/results"
                                            @else
                                            href="/quiz/cognitive-ability/intro" @endif>
                                Cognitive Ability </a>

                            <div class="py-1">
                                @if (auth()->user()->is_cognitive_ability_completed == 1)
                                    <span class="text-gray-900 fs-1 fw-bold me-2">Completed</span>
                                @else
                                    <span class="text-gray-900 fs-1 fw-bold me-2">Pending</span>
                                @endif

                            </div>

                            <div class="progress h-7px bg-success bg-opacity-50 mt-7">
                                <div class="progress-bar bg-success" role="progressbar"
                                    @if (auth()->user()->is_cognitive_ability_completed == 1) style="width: 100%"  @else style="width: 0%" @endif
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--end:: Body-->
                    </div>


                    <!-- END: Group Chart3 -->
                </div>
                {{-- </div> --}}

                @if (auth()->user()->isEmployee())
                    <div class="card h-full">
                        <header class="card-header">
                            <h4 class="card-title">Summary of Assessment Results</h4>
                        </header>
                        <div class="card-body p-6">
                            <div class="row">
                                <!-- left -->
                                <div class="col-lg-6">
                                    <div class="card h-full shadow-base2">
                                        <header class="card-header">
                                            <h4 class="card-title">Personality & Motivation</h4>
                                        </header>
                                        <div class="card-body p-6">
                                            @if (auth()->user()->is_personality_motivation_completed == 1 && $isUserResultExists)
                                                <div class="">
                                                    <div class="slider-container cursor-pointer" data-bs-toggle="modal"
                                                        data-bs-target="#openness_facets_modal">
                                                        <div class="slider-label">Pragmatism</div>
                                                        <div class="slider-track">
                                                            <div class="emp_a"
                                                                @if (isset($oceanDomainResult['openness-to-experience']) &&
                                                                        $oceanDomainResult['openness-to-experience']['score'] / 0.05 == 100) style="left: 93%;" @else style="left: {{ $oceanDomainResult['openness-to-experience']['score'] / 0.05 ?? 0 }}%;" @endif>
                                                            </div>
                                                            {{-- <div class="emp_b population_hide hidden_population"
                                                                @if (isset($oceanOverallResult['Openness to Experience']) && ($oceanOverallResult['Openness to Experience'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanOverallResult['Openness to Experience'] / 5) * 100 ?? 0 }}%;" @endif>
                                                                P
                                                            </div> --}}
                                                        </div>
                                                        <div class="slider-label">Openness</div>
                                                    </div>
                                                    <div class="slider-container cursor-pointer" data-bs-toggle="modal"
                                                        data-bs-target="#conscientiousness_facets_modal">
                                                        <div class="slider-label">Low Self Control</div>
                                                        <div class="slider-track">
                                                            <div class="emp_a"
                                                                @if (isset($oceanDomainResult['conscientiousness']) && $oceanDomainResult['conscientiousness']['score'] / 0.05 == 100) style="left: 93%;" @else style="left: {{ $oceanDomainResult['conscientiousness']['score'] / 0.05 ?? 0 }}%;" @endif>
                                                            </div>
                                                            {{-- <div class="emp_b population_hide hidden_population"
                                                                @if (isset($oceanOverallResult['Conscientiousness']) && ($oceanOverallResult['Conscientiousness'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanOverallResult['Conscientiousness'] / 5) * 100 ?? 0 }}%;" @endif>
                                                                P
                                                            </div> --}}
                                                        </div>
                                                        <div class="slider-label">High Self Control</div>
                                                    </div>
                                                    <div class="slider-container cursor-pointer" data-bs-toggle="modal"
                                                        data-bs-target="#extraversion_facets_modal">
                                                        <div class="slider-label">Introversion</div>
                                                        <div class="slider-track">
                                                            <div class="emp_a"
                                                                @if (isset($oceanDomainResult['extraversion']) && $oceanDomainResult['extraversion']['score'] / 0.05 == 100) style="left: 93%;" @else style="left: {{ $oceanDomainResult['extraversion']['score'] / 0.05 ?? 0 }}%;" @endif>
                                                            </div>
                                                            {{-- <div class="emp_b population_hide hidden_population"
                                                                @if (isset($oceanOverallResult['Extraversion']) && ($oceanOverallResult['Extraversion'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanOverallResult['Extraversion'] / 5) * 100 ?? 0 }}%;" @endif>
                                                                P
                                                            </div> --}}
                                                        </div>
                                                        <div class="slider-label">Extraversion</div>
                                                    </div>
                                                    <div class="slider-container cursor-pointer" data-bs-toggle="modal"
                                                        data-bs-target="#agreeableness_facets_modal">
                                                        <div class="slider-label">Independence</div>
                                                        <div class="slider-track">
                                                            <div class="emp_a"
                                                                @if (isset($oceanDomainResult['agreeableness']) && $oceanDomainResult['agreeableness']['score'] / 0.05 == 100) style="left: 93%;" @else style="left: {{ $oceanDomainResult['agreeableness']['score'] / 0.05 ?? 0 }}%;" @endif>
                                                            </div>
                                                            {{-- <div class="emp_b population_hide hidden_population"
                                                                @if (isset($oceanOverallResult['Agreeableness']) && ($oceanOverallResult['Agreeableness'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanOverallResult['Agreeableness'] / 5) * 100 ?? 0 }}%;" @endif>
                                                                P
                                                            </div> --}}
                                                        </div>
                                                        <div class="slider-label">Agreebleness</div>
                                                    </div>

                                                    <div class="slider-container cursor-pointer" data-bs-toggle="modal"
                                                        data-bs-target="#emotional_stability_facets_modal">
                                                        <div class="slider-label">High Anxiety</div>
                                                        <div class="slider-track">
                                                            <div class="emp_a"
                                                                @if (isset($oceanDomainResult['emotional-stability']) &&
                                                                        $oceanDomainResult['emotional-stability']['score'] / 0.05 == 100) style="left: 93%;" @else style="left: {{ $oceanDomainResult['emotional-stability']['score'] / 0.05 ?? 0 }}%;" @endif>
                                                            </div>
                                                            {{-- <div class="emp_b population_hide hidden_population"
                                                                @if (isset($oceanOverallResult['Emotional Stability']) && ($oceanOverallResult['Emotional Stability'] / 5) * 100 == 100) style="left: 93%;" @else style="left: {{ ($oceanOverallResult['Emotional Stability'] / 5) * 100 ?? 0 }}%;" @endif>
                                                                P
                                                            </div> --}}
                                                        </div>
                                                        <div class="slider-label">Low Anxiety</div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="container text-center bg_secondary_green p-5"
                                                    style="
                                                    border-radius: 16px;">
                                                    <iconify-icon icon="wpf:statistics"
                                                        class="text-[2.23rem]"></iconify-icon>
                                                    <h4>Data Not Available </h4>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="card h-full shadow-base2 mt-5">
                                        <header class="card-header">
                                            <h4 class="card-title">Critical Core Skills</h4>

                                        </header>
                                        <div class="card-body p-6">
                                            {{-- {{ dd($workCompetencyResult) }} --}}
                                            @if (auth()->user()->is_personality_motivation_completed == 1 && $isUserResultExists)
                                                <div class="">
                                                    @foreach ($ccsResult as $ccs => $result)
                                                        <div class="slider-container">
                                                            <div class="slider-label accordion-button cursor-pointer"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#criticalThinkingAccordion">
                                                                {{ $result['name'] ?? 'N/A' }}
                                                                {{-- <span>
                                                                        <iconify-icon icon="iconamoon:arrow-down-2-light">
                                                                        </iconify-icon>
                                                                    </span> --}}
                                                            </div>
                                                            <div class="slider-track">
                                                                <div class="emp_a"
                                                                    @if (isset($result) && $result['score'] == 100) style="left: 93%;" @else style="left: {{ $result['score'] ?? 0 }}%;" @endif>
                                                                </div>
                                                                {{-- <div class="emp_b population_hide hidden_population"
                                                                        style="left: {{ $workCompetencyOverallResult['Critical Thinking'] ?? 0 }}%;">
                                                                        P</div> --}}

                                                            </div>
                                                            {{-- <div class="slider-label">Openness</div> --}}
                                                        </div>
                                                        {{-- <div class="accordion-item pl-8">
            
                                                                <div id="criticalThinkingAccordion"
                                                                    class="accordion-collapse collapse  color-black"
                                                                    aria-labelledby="panelsStayOpen-headingOne">
                                                                    <div class="accordion-body font13 text-slate-600">
            
                                                                        {{ $result['description'] ?? ' ' }}
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="container text-center bg_secondary_green p-5"
                                                    style="
                                                    border-radius: 16px;">
                                                    <iconify-icon icon="wpf:statistics"
                                                        class="text-[2.23rem]"></iconify-icon>
                                                    <h4>Data Not Available </h4>
                                                </div>
                                            @endif


                                        </div>
                                    </div>


                                </div>
                                <!-- left -->

                                <!-- right -->
                                <div class="col-lg-6">
                                    <div class="card h-full shadow-base2 riasec">
                                        <header class="card-header">
                                            <h4 class="card-title">Work Interest</h4>
                                        </header>
                                        <div class="card-body p-6">
                                            @if (auth()->user()->is_work_interest_completed == 1 && $isUserResultExists)


                                                @foreach ($riasecDomainResult as $riasec => $result)
                                                    <div
                                                        class="slider-container @if (in_array($result['code'], $riasecTop3Result['array'])) raisec_container @endif my-1">
                                                        <div class="slider-label">{{ $result['name'] ?? '' }}</div>
                                                        <div class="slider-track">
                                                            @if ($result['code'] == 'R')
                                                                <div class="d-flex justify-content-between"
                                                                    style="top: -23px;position: relative;margin-right: 11px;">
                                                                    <div class="slider-legend"
                                                                        style="background: #ff4639f7; border-radius: 28px;padding: 0px;color: white;">
                                                                        Low
                                                                    </div>
                                                                    <div class="slider-legend"
                                                                        style="background: #279d27;border-radius: 28px; color: white;">
                                                                        High
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="emp_a"
                                                                @if (isset($result['percentage']) && $result['percentage'] == 100) style="left: 93%;" @else style="left: {{ $result['percentage'] ?? 0 }}%;" @endif>
                                                            </div>
                                                            {{-- <div class="emp_b population_hide hidden_population"
                                                                        style="left: {{ $workInterestOverallResult['Investigative'] ?? 0 }}%;">
                                                                    P
                                                                </div> --}}

                                                        </div>
                                                        {{-- <div class="slider-label">Openness</div> --}}
                                                    </div>
                                                @endforeach

                                                <div class="accordion" id="accordionPanelsStayOpenExample">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                                            <button
                                                                class="accordion-button nav-link block font-medium font-Inter text-sm leading-tight capitalize rounded-md  py-3 focus:outline-none focus:ring-0 color-black active"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#panelsStayOpen-collapseOne"
                                                                aria-expanded="true"
                                                                aria-controls="panelsStayOpen-collapseOne">
                                                                Top 3 RIASEC -
                                                                {{ $riasecTop3Result['string'] ?? '' }}
                                                            </button>
                                                        </h2>
                                                        <div id="panelsStayOpen-collapseOne"
                                                            class="accordion-collapse collapse show color-black"
                                                            aria-labelledby="panelsStayOpen-headingOne">
                                                            <div class="accordion-body">
                                                                {{ $riasecTop3Result['description'] ?? '' }}
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            @else
                                                <div class="container text-center bg_secondary_green p-5"
                                                    style="
                                                    border-radius: 16px;">
                                                    <iconify-icon icon="wpf:statistics"
                                                        class="text-[2.23rem]"></iconify-icon>
                                                    <h4>Data Not Available </h4>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="card h-full shadow-base2 mt-5">
                                        <header class="card-header">
                                            <h4 class="card-title">Learning & Development Plan</h4>

                                        </header>
                                        <div class="card-body p-6">
                                            {{-- {{ dd($workCompetencyResult) }} --}}
                                            @if (auth()->user()->is_personality_motivation_completed == 1 && $isUserResultExists)
                                                <div class="">
                                                    <h6 class="mt-5">Learning Style</h6>

                                                    <div class="slider-container">
                                                        <div class="slider-label accordion-button cursor-pointer"
                                                            data-bs-toggle="collapse" data-bs-target="#visualAccordion">
                                                            Visual & Kinesthetic <span>
                                                                <iconify-icon icon="iconamoon:arrow-down-2-light">
                                                                </iconify-icon>
                                                            </span></div>
                                                        <div class="slider-track">
                                                            <div class="emp_a"
                                                                @if (isset($learningStyle['visual_kinesthetic_score']) && $learningStyle['visual_kinesthetic_score'] / 0.05 == 100) style="left: 93%;" @else style="left: {{ $learningStyle['visual_kinesthetic_score'] / 0.05 ?? 0 }}%;" @endif>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item pl-8">

                                                        <div id="visualAccordion"
                                                            class="accordion-collapse collapse  color-black"
                                                            aria-labelledby="panelsStayOpen-headingOne">
                                                            <div class="accordion-body font13 text-slate-600">
                                                                <b>Description: </b> <br>
                                                                Learners with a preference for the combined Visual and
                                                                Kinesthetic style grasp concepts more effectively through
                                                                direct interaction with learning materials. They thrive on
                                                                engaging physically with tasks and benefit from the use of
                                                                visual aids.
                                                                <br>
                                                                <b>Examples:</b> <br>
                                                                <ul>
                                                                    <li>Engaging with interactive simulations and physical
                                                                        models.</li>
                                                                    <li>Using diagrams, flowcharts, and illustrative videos
                                                                        to understand complex concepts.</li>
                                                                    <li>Participating in workshops where they can physically
                                                                        manipulate relevant materials.</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="slider-container">
                                                        <div class="slider-label accordion-button cursor-pointer"
                                                            data-bs-toggle="collapse" data-bs-target="#auralAccordion">
                                                            Aural
                                                            <span>
                                                                <iconify-icon icon="iconamoon:arrow-down-2-light">
                                                                </iconify-icon>
                                                            </span>
                                                        </div>
                                                        <div class="slider-track">
                                                            <div class="emp_a"
                                                                @if (isset($learningStyle['aural_score']) && $learningStyle['aural_score'] / 0.05 == 100) style="left: 93%;" @else style="left: {{ $learningStyle['aural_score'] / 0.05 ?? 0 }}%;" @endif>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item pl-8">

                                                        <div id="auralAccordion"
                                                            class="accordion-collapse collapse  color-black"
                                                            aria-labelledby="panelsStayOpen-headingOne">
                                                            <div class="accordion-body font13 text-slate-600">
                                                                <b>Description: </b> <br>
                                                                Aural learners absorb information best when it is presented
                                                                verbally. They excel in environments where listening and
                                                                discussion are encouraged and are adept at remembering
                                                                spoken instructions.
                                                                <br>
                                                                <b>Examples:</b> <br>
                                                                <ul>
                                                                    <li>Benefiting from lectures, group discussions, and
                                                                        verbal briefings.</li>
                                                                    <li>Using podcasts and audio recordings for learning new
                                                                        content.</li>
                                                                    <li>Participating in study groups or team meetings where
                                                                        ideas are discussed aloud.</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="slider-container">
                                                        <div class="slider-label accordion-button cursor-pointer"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#readingWritingAccordion">
                                                            Reading & Writing
                                                            <span>
                                                                <iconify-icon icon="iconamoon:arrow-down-2-light">
                                                                </iconify-icon>
                                                            </span>
                                                        </div>
                                                        <div class="slider-track">
                                                            <div class="emp_a"
                                                                @if (isset($learningStyle['reading_writing_score']) && $learningStyle['reading_writing_score'] / 0.05 == 100) style="left: 93%;" @else style="left: {{ $learningStyle['reading_writing_score'] / 0.05 ?? 0 }}%;" @endif>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item pl-8">

                                                        <div id="readingWritingAccordion"
                                                            class="accordion-collapse collapse  color-black"
                                                            aria-labelledby="panelsStayOpen-headingOne">
                                                            <div class="accordion-body font13 text-slate-600">
                                                                <b>Description: </b> <br>
                                                                Read / Write learners prefer to interact with information
                                                                through written words. They excel in traditional study
                                                                methods involving reading and taking detailed notes.
                                                                <br>
                                                                <b>Examples:</b> <br>
                                                                <ul>
                                                                    <li>Using textbooks, articles, and written handouts as
                                                                        primary study materials.</li>
                                                                    <li>Making comprehensive lists, writing out notes, and
                                                                        summarizing information</li>
                                                                    <li>Preferring email and text-based communication for
                                                                        clarity and record-keeping.</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="accordion accordion-icon-collapse"
                                                        id="learning_style_preference_summary_accordion">
                                                        <!--begin::Item-->
                                                        <div class="mb-5">
                                                            <!--begin::Header-->
                                                            <div class="accordion-header py-3 d-flex"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#learning_style_preference_summary">
                                                                <span class="accordion-icon">
                                                                    {{-- <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                                        <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span class="path2"></span></i> --}}
                                                                    <iconify-icon icon="ph:plus-fill"
                                                                        class="accordion-icon-off fa-1-5"></iconify-icon>
                                                                    <iconify-icon icon="ph:minus-fill"
                                                                        class="accordion-icon-on fa-1-5"></iconify-icon>
                                                                </span>
                                                                <h3 class="fs-4 fw-semibold mb-0 ms-4">
                                                                    Learning Style Summary</h3>
                                                            </div>
                                                            <!--end::Header-->

                                                            <!--begin::Body-->
                                                            <div id="learning_style_preference_summary"
                                                                class="fs-6 collapse show ps-10"
                                                                data-bs-parent="#learning_style_preference_summary">
                                                                @foreach ($learningStyle['learning_style_preference'] as $key => $learning_style_preference)
                                                                    {{ $learning_style_preference['learning_style_preference_summary'] ?? '' }}
                                                                    <br>
                                                                @endforeach
                                                            </div>
                                                            <!--end::Body-->
                                                        </div>
                                                        <!--end::Item-->

                                                        <!--begin::Item-->

                                                        <!--end::Item-->
                                                    </div>

                                                    {{-- <div class="accordion accordion-icon-collapse" id="training_recommendations_accordion">
                                                                <!--begin::Item-->
                                                                <div class="mb-5">
                                                                    <!--begin::Header-->
                                                                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse"
                                                                        data-bs-target="#training_recommendations">
                                                                        <span class="accordion-icon">
                                                                            <iconify-icon icon="ph:plus-fill"
                                                                                class="accordion-icon-off fa-1-5"></iconify-icon>
                                                                            <iconify-icon icon="ph:minus-fill"
                                                                                class="accordion-icon-on fa-1-5"></iconify-icon>
                                                                        </span>
                                                                        <h3 class="fs-4 fw-semibold mb-0 ms-4">
                                                                            Training Recommendations and Enhanced Development Insights</h3>
                                                                    </div>
                                                                    <!--end::Header-->
                
                                                                    <!--begin::Body-->
                                                                    <div id="training_recommendations" class="fs-6 collapse show ps-10"
                                                                        data-bs-parent="#learning_style_preference_summary">
                                                                        <b> <u>Training Recommendations:</u> </b> <br>
                                                                        <ul>
                                                                            @foreach (explode(';', $learningStyle['training_recommendations']) as $item)
                                                                                <li>{{ $item ?? ' ' }}</li>
                                                                            @endforeach
                                                                        </ul>
                
                                                                        <b> <u>Enhanced Development Insights:</u> </b> <br>
                                                                        <ul>
                                                                            <li> <b>Role Suitability: </b> {{$learningStyle['enhanced_development_insights_role_suitability'] ?? ''}} </li>
                                                                            <li> <b>Action Steps: </b> {{$learningStyle['enhanced_development_insights_action_steps'] ?? ''}} </li>
                                                                        </ul>
                                                                    </div>
                                                                    <!--end::Body-->
                                                                </div>
                                                                <!--end::Item-->
                
                                                                <!--begin::Item-->
                
                                                                <!--end::Item-->
                                                            </div> --}}

                                                    <div class="accordion accordion-icon-collapse"
                                                        id="summary_for_report_accordion">
                                                        <!--begin::Item-->
                                                        <div class="mb-5">
                                                            <!--begin::Header-->
                                                            <div class="accordion-header py-3 d-flex"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#summary_for_report">
                                                                <span class="accordion-icon">
                                                                    <iconify-icon icon="ph:plus-fill"
                                                                        class="accordion-icon-off fa-1-5"></iconify-icon>
                                                                    <iconify-icon icon="ph:minus-fill"
                                                                        class="accordion-icon-on fa-1-5"></iconify-icon>
                                                                </span>
                                                                <h3 class="fs-4 fw-semibold mb-0 ms-4">
                                                                    Summary for Report</h3>
                                                            </div>
                                                            <!--end::Header-->

                                                            <!--begin::Body-->
                                                            <div id="summary_for_report" class="fs-6 collapse show ps-10"
                                                                data-bs-parent="#learning_style_preference_summary">
                                                                This section of the report aims to harness the individual's
                                                                learning style to maximize their job performance and
                                                                satisfaction. By aligning their natural learning preferences
                                                                with specific training interventions and workplace
                                                                practices, the organization can enhance both individual and
                                                                team productivity. The recommendations provided are designed
                                                                to be directly applicable, ensuring the individual's
                                                                professional development is continuously supported and
                                                                aligned with organizational goals.
                                                            </div>
                                                            <!--end::Body-->
                                                        </div>
                                                        <!--end::Item-->

                                                        <!--begin::Item-->

                                                        <!--end::Item-->
                                                    </div>
                                                </div>
                                            @else
                                                <div class="container text-center bg_secondary_green p-5"
                                                    style="
                                                                    border-radius: 16px;">
                                                    <iconify-icon icon="wpf:statistics" class="text-[2.23rem]">
                                                    </iconify-icon>
                                                    <h4>Data Not Available </h4>
                                                </div>
                                            @endif


                                        </div>
                                    </div>
                                </div>
                                <!-- right -->


                            </div>

                        </div>
                    </div>
                @else
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">List of Application</span>

                                {{-- <span class="text-muted mt-1 fw-semibold fs-7">Over 500 new products</span> --}}
                            </h3>
                            <div class="card-toolbar">
                                {{-- <a href="{{ route('admin.job-opening.compare-index',['job_opening_id' => $jobOpening->id]) }}" class="btn btn-sm btn-light-primary">
                                            <iconify-icon icon="lucide:git-compare"></iconify-icon> Compare
                                        </a> --}}
                            </div>
                        </div>

                        <!--begin::Body-->
                        <div class="card-body py-3">


                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                @if (auth()->user()->jobOpeningApplication)
                                    <table class="table align-middle gs-0 gy-4">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fw-bold text-muted bg-light">
                                                <th class="min-w-125px text-center">No</th>
                                                <th class="min-w-125px text-center">List of Job Applied</th>
                                                <th class="min-w-125px text-center">Date Applied</th>
                                                <th class="min-w-125px text-center">Technical Assessment</th>
                                                <th class="min-w-125px text-center">Application Status</th>
                                                <th class="min-w-200px text-center">Status</th>
                                                <th class="min-w-200px text-center">Action</th>

                                            </tr>
                                        </thead>
                                        <!--end::Table head-->

                                        <!--begin::Table body-->
                                        <tbody>

                                            @foreach (auth()->user()->jobOpeningApplication as $key => $job)
                                                <tr>

                                                    <td>
                                                        <span class="text-gray-900 text-center fw-bold d-block mb-1 fs-6">
                                                            {{ $key + 1 }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-900 text-center fw-bold d-block mb-1 fs-6">{{ $job->jobOpening->job_title ?? '' }}</span>
                                                    </td>

                                                    <td>
                                                        <span class="text-gray-900 text-center fw-bold  d-block mb-1 fs-6">
                                                            {{ $job->created_at ?? '' }}
                                                        </span>
                                                    </td>

                                                    <td class="text-center">
                                                        {{-- {{ dd($job) }} --}}
                                                        <span class="text-gray-900 text-center fw-bold  d-block mb-1 fs-6">

                                                            @if ($job->technical_assessment_completed != 1)
                                                                @if (isset($job->jobOpening->job_position) && isset($job->jobOpening->job_position->technical_assessment_id))
                                                                    <a
                                                                        href="/technical-assessment/{{ $job->id }}/{{ $job->jobOpening->job_position->technical_assessment_id }}">Start</a>
                                                                @else
                                                                    N/A
                                                                @endif
                                                            @else
                                                                Completed
                                                            @endif

                                                        </span>
                                                    </td>


                                                    <td>
                                                        <span
                                                            class="text-gray-900 text-center fw-bold text-hover-primary d-block mb-1 fs-6">
                                                            @if ($job->application_status == 1)
                                                                Applied
                                                            @else
                                                                Withdraw
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <!-- Begin Form -->

                                                        <span class="text-gray-900 text-center fw-bold  d-block mb-1 fs-6">
                                                            @foreach (config('helpers.application_status') as $statusKey => $statusValue)
                                                                @if ($job->status == $statusKey)
                                                                    {{ $statusValue }}
                                                                @endif
                                                            @endforeach
                                                        </span>

                                                        <!-- End Form -->
                                                    </td>

                                                    <td class="text-center">

                                                        <div class="d-flex justify-content-center">
                                                            @if ($job->status == 8)
                                                                <a href="{{ $job->contract->contract_pdf }}"
                                                                    target="_blank"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <iconify-icon
                                                                        icon="fluent:eye-20-regular"></iconify-icon>
                                                                </a>
                                                            @endif

                                                            @if ($job->status == 7)
                                                                <a href="{{ $job->contract->contract_pdf }}"
                                                                    target="_blank"
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <iconify-icon
                                                                        icon="fluent:eye-20-regular"></iconify-icon>
                                                                </a>
                                                                <a data-bs-toggle="modal" data-bs-target="#signature_pad"
                                                                    contract_id="{{ $job->contract->id ?? '' }}"
                                                                    jobtitle='{{ $job->jobOpening->job_title ?? 'Job title' }}'
                                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                    <iconify-icon
                                                                        icon="fluent:document-signature-32-regular"></iconify-icon>
                                                                </a>
                                                            @endif

                                                            <form
                                                                action="{{ route('admin.application.update-status', $job->id) }}"
                                                                method="POST" id="statusForm-{{ $job->id }}">
                                                                @csrf
                                                                <input type="hidden" name="application_status"
                                                                    value="0">
                                                                <button type="button" title="Withdraw Application"
                                                                    class="withdrawButton btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 cursor-pointer"
                                                                    data-job-id="{{ $job->id ?? '' }}"
                                                                    @if ($job->application_status == 0 || $job->status == 8) disabled style="cursor: no-drop;color: black;" @endif>
                                                                    <iconify-icon icon="ph:hand-withdraw-light"
                                                                        class="fs-2"></iconify-icon>

                                                                </button>
                                                            </form>
                                                            {{-- <a href="{{ route('admin.job-opening.send-email',$jobOpeningApplication->id) }}" class="btn btn-sm btn-primary me-1">
                                                            Send Email
                                                        </a> --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                        <!--end::Table body-->
                                    </table>

                                @endif
                                <!--end::Table-->

                            </div>



                            <!--end::Table container-->
                        </div>
                        <!--begin::Body-->
                    </div>

                @endif


            </div>
        </div>
    </div>


    <!-- The Modal -->

    <div class="modal fade" tabindex="-1" id="signature_pad">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Signature</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><iconify-icon icon="vaadin:close-big"></iconify-icon></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <form id="signature_form" action="{{ route('contracts.sign.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="contract_id" id="contract_id">
                        <h5 id="contract_title">Job Title</h5>
                        {{-- <p>{{ $contract->contract_details }}</p> --}}

                        <label for="signature">Signature:</label>
                        <div>
                            <canvas id="signature-pad" width="400" height="200"
                                style="border:1px solid #000;"></canvas>
                        </div>
                        <button type="button" id="clear-signature" class="btn btn-danger py-1">Clear</button>
                        <input type="hidden" name="signature" id="signature">

                        <button type="submit" class="btn btn-primary py-1">Sign Contract</button>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary" onclick="document.getElementById('signature_form').submit();">Sign Contract</button> --}}
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0"></script>


    <script>
        var options = {
            chart: {
                type: 'donut',
                width: 400, // Set the width of the chart
                height: 300, // Set the height of the chart
            },
            series: [{{ $totalCorrectForCognitive ?? 0 }}, {{ $totalWrongForCognitive ?? 0 }},
                {{ $totalNonAttemptedForCognitive ?? 0 }}
            ],
            labels: ['Correct', 'Wrong', 'Missed'],
            colors: ['#1AB93B', '#CE9E20', '#1F5476'],
            xaxis: {
                categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
            },

            legend: {
                position: 'bottom', // Set the position of the legend to 'bottom'
            },
        }

        var chart = new ApexCharts(document.querySelector("#donut"), options);

        chart.render();
    </script>


    <script src="{{ asset('signature-pad/js/signature_pad.umd.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // When the button with data-bs-toggle="modal" is clicked
            $('[data-bs-toggle="modal"]').on('click', function() {
                // Get the contract_id attribute value
                var contractId = $(this).attr('contract_id');
                var jobTitle = $(this).attr('jobtitle');
                console.log(jobTitle);
                // Set the contract_id value to the hidden input in the modal
                $('#contract_id').val(contractId);
                $('#contract_title').text(jobTitle);
            });

            // Initialize signature pad
            var canvas = document.getElementById('signature-pad');
            var signaturePad = new SignaturePad(canvas);
            var clearButton = document.getElementById('clear-signature');
            var signatureInput = document.getElementById('signature');

            clearButton.addEventListener('click', function() {
                signaturePad.clear();
            });

            document.querySelector('#signature_form').addEventListener('submit', function(event) {
                if (signaturePad.isEmpty()) {
                    alert('Please provide a signature first.');
                    event.preventDefault();
                } else {
                    signatureInput.value = signaturePad.toDataURL();
                }
            });
        });
    </script>

@endsection
