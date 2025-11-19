@extends('employee.layout.app')

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

        .card-wrapper-main {

            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 24px;
            /* overflow-y: scroll; */

            background: #FFFFFF;
            box-shadow: 0px 1px 4px rgba(12, 12, 13, 0.05);
            border-radius: 8px;

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

        hr {
            background: #F1F1F4;
            height: 2px;
            widows: 100%;
            border: none !important;
        }
        .bg-open-accordion {
    border-radius: 8.13px;
    padding: 19.5px 24px;
}
.text-active-primary.active {
            color: #f7941d !important;
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

    
    </style>
@endsection

@section('content')

<div id="kt_app_content" class="app-content  flex-column-fluid">
    <div id="kt_app_content_container" class="app-container  ">
        <div class="row mb-5 ms-0 me-0 justify-content-center mt-0">
            <div class="card-wrapper-main">
                <!-- Add Go Back Button -->
                <div class="mb-4">
                    <a href="{{ route('employee.dashboard.career-pathing') }}" class="btn btn-warning">
                        Go Back
                    </a>
                </div>
                <div class="mb-0">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <h4 class="fs-2x text-gray-800 w-bolder mb-6">
                                {{ $employee->job_position->title ?? ($employee->job_title ?? '') }}

                            </h4>
                            <div class="align-items-baseline d-flex ml-3 mx-4">



                            </div>
                        </div>

                    </div>
                    <!--begin::Text-->
                    <p class="fw-semibold fs-4 text-gray-600 mb-2">
                        {{ $employee->job_position->description ?? 'NA' }}

                    </p>
                    <!--end::Text-->
                </div>
                <!--end::Content-->

                <!--begin::Item-->
                <div class="mb-0 mt-10">
                    <!--begin::Title-->
                    <h3 class="accordion-heading mb-4">
                        Critical Work Functions
                    </h3>
                    <!--end::Title-->

                    <!--begin::Accordion-->


                    <!--begin::Section-->
                    <div class="m-0">


                        <!--end::Icon-->


                        <!--end::Heading-->
                        <div class="accordion accordion-icon-collapse" id="kt_accordion_3">
                            <!--begin::Item-->
                            @foreach ($employee->job_position->criticalFunctions as $key3 => $value3)
                                <div class="mb-0">
                                    <!--begin::Header-->
                                    <div class="accordion-header collapsed py-6 d-flex accordion-border"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#kt_accordion_3_item_{{ $key3 }}">
                                        <span class="accordion-icon">

                                            <iconify-icon icon="gravity-ui:circle-plus-fill"
                                                class="accordion-icon-off fs-3 me-3"
                                                style="color: #1AC2C2; font-size: 23px !important;"></iconify-icon>

                                            <iconify-icon icon="zondicons:minus-outline"
                                                class="accordion-icon-on fs-3 me-3"
                                                style="color: #1AC2C2; font-size: 20px !important;"></iconify-icon>
                                        </span>
                                        {{ $value3->description ?? '' }}
                                    </div>
                                    <!--end::Header-->

                                    <!--begin::Body-->
                                    <div id="kt_accordion_3_item_{{ $key3 }}"
                                        class="fs-6 collapse ps-10 bg-open-accordion" 
                                        data-bs-parent="#kt_accordion_3">


                                        @foreach ($value3->cwfKeys as $key)
                                            <div class="badge badge-primary">{{ $key->name ?? '' }}
                                            </div>
                                        @endforeach

                                    </div>
                                    <!--end::Body-->
                                </div>
                                <hr>
                            @endforeach

                        </div>



                        <!--begin::Separator-->
                        {{-- <div class="separator separator-dashed"></div> --}}
                        <!--end::Separator-->
                    </div>
                    <!--end::Section-->



                    <!--end::Accordion-->
                </div>
                <!--end::Item-->
                <!--begin::Item-->
                <div class="mb-15 mt-10">
                    <!--begin::Title-->
                    <h3 class="accordion-heading mb-4">
                        Generic Skills
                    </h3>
                    <!--end::Title-->

                    <!--begin::Accordion-->


                    <div class="accordion accordion-icon-collapse" id="kt_accordion_3">

                        @foreach ($employee->job_position->skills as $index => $skill)
                            <!--begin::Section-->
                            <div class="m-0">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center justify-content-between accordion-header collapsed py-6 accordion-border
                                                              "
                                    data-bs-toggle="collapse" data-bs-target="#kt_job_{{ $index }}">
                                    <!--begin::Icon-->

                                    <!--end::Icon-->

                                    <!--begin::Title-->
                                    <div class="cursor-pointer mb-0" style="display: flex; align-items: center;">

                                        <span class="accordion-icon">

                                            <iconify-icon icon="gravity-ui:circle-plus-fill"
                                                class="accordion-icon-off fs-3 me-3"
                                                style="color: #997BF2; font-size: 23px !important;"></iconify-icon>

                                            <iconify-icon icon="zondicons:minus-outline"
                                                class="accordion-icon-on fs-3 me-3"
                                                style="color: #997BF2; font-size: 20px !important;"></iconify-icon>
                                        </span>
                                        {{ $skill->title ?? 'NA' }}

                                        {{-- <iconify-icon icon="vaadin:level-right" width="1.2rem" height="1.2rem"  style="color: black"></iconify-icon> --}}



                                    </div>

                                    <div class="cursor-pointer mb-0"
                                        style="display: flex; align-items: center; color: #997BF2 !important;">
                                        <iconify-icon icon="material-symbols-light:star"
                                            style="font-size: 20px;"></iconify-icon>
                                        {{ $skill->level }}
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->

                                <!--begin::Body-->
                                <div id="kt_job_{{ $index }}"
                                    class="collapse {{ $index == 0 ? 'show' : '' }} fs-6 ms-1">


                                    <div class="fs-6 ps-10 bg-open-accordion collapse show"
                                        style="background: #F2EEFD;">
                                        @foreach ($masterSkills as $key1 => $value1)
                                            {{ $skill->title == $value1->name ? $value1->description : '' }}
                                        @endforeach
                                    </div>

                                    <!--begin::Text-->

                                    <!--end::Text-->
                                </div>
                                <!--end::Content-->


                                <!--begin::Separator-->
                                <!-- <div class="separator separator-dashed"></div> -->
                                <!--end::Separator-->
                            </div>
                            <!--end::Section-->
                        @endforeach



                        <!--end::Accordion-->
                    </div>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <div class="mb-15 mt-10">
                        <h3 class="accordion-heading mb-4">
                            Technical Skills

                        </h3>
                        @foreach ($employee->job_position->technicalSkills as $key4 => $value4)
                            <div class="m-0">
                                <!--begin::Heading-->
                                <div onclick="technicalpopulateModal('{{ $key4 }}', '{{ App\Helpers\MainHelper::escapeSpecialCharacters(json_encode($value4)) }}', '{{ $value4->name }}', '{{ $value4->pivot->level }}')"
                                    data-bs-toggle="modal" data-bs-target="#techskillmodal"
                                    class="d-flex align-items-center justify-content-between accordion-header collapsed py-6 accordion-border
                                                              ">
                                    <!--begin::Icon-->

                                    <!--end::Icon-->

                                    <!--begin::Title-->
                                    <div class="cursor-pointer mb-0" style="display: flex; align-items: center;">

                                        <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                            <iconify-icon icon="gravity-ui:circle-plus-fill"
                                                class="accordion-icon-off fs-3 me-3"
                                                style="color: #F7941D; font-size: 23px !important;"></iconify-icon>
                                        </div>
                                        {{ $value4->name ?? 'NA' }}

                                        {{-- <iconify-icon icon="vaadin:level-right" width="1.2rem" height="1.2rem"  style="color: black"></iconify-icon> --}}



                                    </div>

                                    <div class="cursor-pointer mb-0"
                                        style="display: flex; align-items: center; color: #F7941D !important;">
                                        <iconify-icon icon="material-symbols-light:star"
                                            style="font-size: 20px;"></iconify-icon>
                                        {{ $value4->pivot->level }}
                                    </div>
                                    <!--end::Title-->
                                </div>

                            </div>
                        @endforeach


                    </div>
                </div>

                <div class="modal fade" id="techskillmodal" tabindex="-1" aria-labelledby="techskillModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="techskillModalLabel">Technical Skill Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Modal Content will be dynamically populated here -->
                                <div id="techSkillDetails"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.0"></script>
        <script>
            function technicalpopulateModal(key, value, name, level) {
                // Escape and parse data into a readable format
                const parsedValue = JSON.parse(value);

                // Populate modal content dynamically
                const modalBody = document.getElementById('techSkillDetails');
                modalBody.innerHTML = `
            <h5>Name: ${name}</h5>
            <p><strong>Level:</strong> ${level}</p>
            <p><strong>Description:</strong> ${parsedValue.description ?? 'No description available.'}</p>
            
        `;
            }
        </script>
    @endsection
