{{-- resources/views/frontend/job-detail.blade.php --}}
@extends('avenger.layouts.app')

@section('title', env('APP_NAME') . ' | Job Details')


@section('styles')

    <style>
        .view-job {
            padding: 80px 10px 120px 10px;
        }

        .view-job-header {
            padding: 24px 24px 24px 48px;
            border-radius: 8px 8px 0px 0px;
            border: 1px solid #F1F1F4;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .view-job-header h4 {
            color: #071437;
            font-size: 22.75px;
            font-weight: 500;
            line-height: 27.3px;
            margin-bottom: 8px;
        }

        .view-job-header p {
            color: #99A1B7 !important;
            font-size: 13.975px !important;
            font-weight: 500 !important;
            line-height: 16.77px !important;
        }

        .view-job-body {
            padding: 48px;
            border-radius: 0px 0px 8px 8px;
            border-right: 1px solid #F1F1F4;
            border-bottom: 1px solid #F1F1F4;
            border-left: 1px solid#F1F1F4;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            gap: 26px;
        }

        .view-job-sidebar {
            width: 36%;
        }

        .view-job-left-side {
            width: 62%;
        }

        .view-job-left-side h5 {
            color: #071437;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
        }

        .view-job-left-side p {
            color: #4B5675 !important;
            font-size: 16px !important;
            font-weight: 400 !important;
            line-height: 25px !important;
        }

        .view-job-left-side .accordion-button,
        .view-job-left-side .accordion-item {
            padding: 16px;
            border-radius: 8px;
            font-size: 16.25px;
            font-weight: 500;
            border: 0;
            line-height: 19.5px;
        }

        .view-job-left-side .accordion-body {
            padding: 20px 0px 0px;
        }

        .view-job-left-side .accordion-body ul li {
            color: #4B5675;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
        }

        .view-job-left-side .accordion-button {
            padding: 0px;
        }

        .view-job-left-side .accordion-item {
            border: 1px solid #DBDFE9;
        }

        .view-job-left-side .accordion-button:not(.collapsed) {
            color: #071437;
            box-shadow: none;
            background: none;
        }

        .view-job-sidebar .box {
            padding: 24px;
            border-radius: 8px;
            background: #FAFAFB;
        }

        .view-job-sidebar h4 {
            color: #071437;
            font-size: 16.25px;
            font-weight: 500;
            line-height: 19.5px;
        }

        .view-job-sidebar p {
            color: #4B5675 !important;
            font-size: 14px !important;
            font-weight: 400 !important;
            line-height: 22px !important;
        }

        .view-job-sidebar h5 {
            color: #4B5675;
            font-size: 14px;
            font-weight: 700;
            line-height: 22px;
        }

        .view-job-sidebar button {
            display: flex;
            padding: 14px 20px;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
        }

        .view-job-sidebar .btn-apply {
            background: #F7941C;
            color: #FFF;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
            flex: 1 0 0;
        }

        .view-job-sidebar .btn-outline {
            display: flex;
            width: 48px;
            height: 48px;
            justify-content: center;
            align-items: center;
            border: 1px solid #99A1B7 !important;
            background: #FFF;
        }
    </style>

    <style>
        .job-openings {
            padding: 120px 10px;
            background: #FAFAFB;
        }

        .job-openings .heading {
            color: #4B5675;
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
        }

        .job-openings .see-all-btn {
            display: flex;
            padding: 12px 18px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            border: 1px solid #99A1B7;
            color: #78829D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            background: white;
        }

        .job-openings .job-card {
            background-color: #fff;
        }

        .job-openings .job-card .job-header {
            padding: 24px;
            border-radius: 8px 8px 0px 0px;
            border: 1px solid #F1F1F4;
        }

        .job-openings .job-card .job-body {
            padding: 24px;
            border-radius: 0px 0px 8px 8px;
            border-right: 1px solid #F1F1F4;
            border-bottom: 1px solid #F1F1F4;
            border-left: 1px solid #F1F1F4;
        }

        .job-openings .job-card .job-body .custom-button {
            font-size: 14px;
        }

        .job-openings .job-card .job-header h6 {
            color: #071437;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
            margin-bottom: 8px;
        }

        .job-openings .job-card .job-header p {
            color: #99A1B7;
            font-size: 13.975px;
            font-weight: 500;
            line-height: 16.77px;
        }

        .job-openings .job-card .job-body p {
            overflow: hidden;
            color: #99A1B7;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 20px;
            letter-spacing: 0.25px;
            margin-bottom: 16px;
        }

        .custom-button {
            display: flex;
            padding: 14px 20px;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
            font-size: 16.25px;
            font-weight: 500;
            line-height: 19.5px;
            height: fit-content;
            width: fit-content;
            gap: 8px;
        }

        .custom-button.btn-orange-fill {
            background: #F7941C;
            color: #FFF;
            border: 1px solid #F7941C;
        }

        .custom-button.btn-outline-orange {
            border: 1px solid #F7941C;
            background: #FFF;
            color: #F7941C;
        }

        .custom-button.btn-grey-outline {
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #78829D;
        }

        .btn-apply-disabled {
            background: #F1F1F4;
            color: #8b8b8b;
            border: 1px solid #DBDFE9;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
            flex: 1 0 0;
        }

        .btn-apply-disabled:hover {
            background: #F1F1F4;
            color: #8b8b8b;
            border: 1px solid #DBDFE9;
        }

        .btn-apply-disabled:active {
            background: #F1F1F4 !important;
            color: #8b8b8b !important;
            border: 1px solid #DBDFE9 !important;
        }
    </style>

@endsection


@section('content')


    @if ($status != null && $message != null)
        <div id="feedbackMessage"
            class="justify-content-between align-items-center feedback-message alert alert-dismissible mb-0"
            style=" background-color:  #{{ $status = 'alert-info' ? 'E3F7FF' : 'ffe8e0' }}">
            <div></div>
            {{-- {{ dd(session()->get('job_opening_id')) }} --}}

            <p class="text-center fw-medium m-0">{{ $message ?? '' }}

            </p>

            <iconify-icon icon="iconamoon:close-bold" width="24" height="24" class="cursor-pointer "
                data-bs-dismiss="alert" id="closeIcon"></iconify-icon>
        </div>
    @endif

    <section class="view-job container m-auto">
        <div class="view-job-header bg-white">
            <p style="margin-bottom: 8px;">Job Title</p>
            <h4>{{ $jobDetail->job_title ?? '' }}</h4>

            <div class="d-flex align-items-center gap-3">
                <div class="d-flex align-items-center gap-1">
                    @if (isset($jobDetail->employment_type))
                        <iconify-icon icon="lucide:briefcase" width="16" height="16"
                            style="color:#99A1B7;"></iconify-icon>
                        <p class="m-0">{{ config('constants.EMPLOYMENT_STATUSES')[$jobDetail->employment_type] }}</p>
                    @endif
                </div>
                <div class="d-flex align-items-center gap-1">
                    @if (isset($jobDetail->employment_type))
                        <iconify-icon icon="basil:location-outline" width="16" height="16"
                            style="color:#99A1B7;"></iconify-icon>
                        <p class="m-0">{{ ucfirst($jobDetail->job_location_type ?? '') }}</p>
                    @endif
                </div>
                <div class="d-flex align-items-center gap-1">
                    <iconify-icon icon="mdi:clock-outline" width="16" height="16"
                        style="color:#99A1B7;"></iconify-icon>
                    <p class="m-0">Posted {{ \Carbon\Carbon::parse($jobDetail->created_at)->format('d.m.Y') }}</p>
                </div>
            </div>
        </div>
        <div class="view-job-body d-flex">
            <div class="view-job-left-side">
                <div class="mb-8">
                    <h5 class="mb-2">Job Details</h5>
                    <p>{{ $jobDetail->job_role_description ?? '' }}</p>
                </div>
                <div class="accordion pb-5" id="accordionExample">
                    <div class="accordion-item mb-5">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSoftSkills" aria-expanded="false"
                                aria-controls="collapseSoftSkills">
                                Job Skills
                            </button>
                        </h2>
                        <div id="collapseSoftSkills" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @if (isset($jobDetail->job_position) && isset($jobDetail->job_position->skills))

                                    <ul>

                                        @foreach ($jobDetail->job_position->skills as $value)
                                            <li>{{ $value->title ?? '' }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    Not found
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-5">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTechnicalSkills" aria-expanded="false"
                                aria-controls="collapseTechnicalSkills">
                                Job Technical Skills
                            </button>
                        </h2>
                        <div id="collapseTechnicalSkills" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                               
                                @if (isset($jobDetail->job_position) && isset($jobDetail->job_position->jobOpeningTechSkills))
                                    <ul>

                                        @foreach ($jobDetail->job_position->jobOpeningTechSkills as $techskill)
                                            <li>{{ $techskill->masterTechnicalSkill->name ?? '' }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    Not found
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item mb-5">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseCriticalWorkFunctions" aria-expanded="false"
                                aria-controls="collapseCriticalWorkFunctions">
                                Job Critical Work Functions
                            </button>
                        </h2>
                        <div id="collapseCriticalWorkFunctions" class="accordion-collapse collapse"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                @if (isset($jobDetail->job_position) && isset($jobDetail->job_position->criticalFunctions))
                                    <ul>
                                        @foreach ($jobDetail->job_position->criticalFunctions as $cwf)
                                            <li>{{ $cwf->description ?? '' }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    Not found
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="view-job-sidebar">
                <div class="box">
                    <h4 class="mb-3">Interested in this role?</h4>
                    <div class="d-flex gap-3 ">
                        @if (auth()->user() != null)
                            @php
                                $jobapplication = App\Models\JobOpeningApplication::where(
                                    'job_opening_id',
                                    $jobDetail->id,
                                )
                                    ->where('user_id', auth()->user()->id)
                                    ->where('application_status', 1)
                                    ->get();
                            @endphp

                            @if ($jobapplication->isEmpty())
                            @if(!in_array($jobDetail->status,[1,3,4,5]))
                                <a class="btn btn-apply" href="/apply/job/{{ $jobDetail->slug ?? '' }}">Apply Now</a>
                                @else
                                <a class="btn btn-apply-disabled" disabled href="javascript:void(0)"
                                style="">Apply Now</a>
                                @endif
                            @else
                                <a class="btn btn-apply-disabled" disabled href="javascript:void(0)"
                                    style="">Applied</a>
                            @endif
                        @else
                            <a class="btn btn-apply" href="/job/apply/guest-user/{{ $jobDetail->slug ?? '' }}">Apply
                                Now</a>
                        @endif
                        <button class="btn btn-outline "
                            onclick="sharePage('/job-details/{{ $jobDetail->slug }}')"><iconify-icon icon="tabler:share"
                                width="24" height="24" style="color: #78829D;"></iconify-icon></button>
                        <div class="btn-container">
                            <button class="btn btn-outline"><iconify-icon icon="lets-icons:copy" width="24"
                                    height="24" style="color: #78829D;"
                                    onclick="copyToClipboard(event,'/job-details/{{ $jobDetail->slug }}')"></iconify-icon></button>
                            <span class="tooltip">Copied to clipboard!</span>
                        </div>

                    </div>
                </div>
                <div class="box mt-5">
                    <h4 class="mb-3">Company Overview</h4>
                    <p class="m-0">{!! $jobDetail->companyOverview->description ?? '' !!}</p>
                    <h4 class="mb-3">Company Benefit</h4>
                    <p class="m-0">{!! $jobDetail->companyBenefit->description ?? '' !!}</p>
                    <h4 class="mt-8 mb-3">Job Qualifications</h4>
                    <h5 class="mb-1">Education Level</h5>
                    <p class="mb-3">{{ $jobDetail->education_level->name ?? '' }}</p>
                    <h5 class="mb-1">Education Program</h5>
                    <p class="mb-3">{{ $jobDetail->education_program->name ?? '' }}</p>
                    <h5 class="mb-1">Work Experience</h5>
                    <p class="mb0">{{ $jobDetail->work_experience ?? '0' }}</p>
                </div>
            </div>
        </div>

    </section>

    <section class="job-openings">
        <div class="m-auto container">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="heading m-0">More jobs like this</h4>
                <a href="{{ route('all-jobs') }}">
                    <button class="see-all-btn">See All Jobs<iconify-icon icon="ic:round-chevron-right" width="16"
                            height="16"></iconify-icon></button>
                </a>
            </div>

            <div class="d-grid gap-8 mt-5" style="
    grid-template-columns: 31.8% 31.8% 31.8%;
">
                {{-- @foreach ($relatedJobs as $jobOpenings) --}}
                {{-- <div class="job-card">
                        <div class="job-header">
                            <h6>{{ $data->job_title ?? '' }}</h6>
                            <div class="d-flex align-items-center gap-3">
                                <p class="d-flex align-items-center gap-2 m-0">
                                    <iconify-icon icon="mdi:clock-outline" width="16" height="16"></iconify-icon>
                                    {{ \Carbon\Carbon::parse($data->created_at)->format('d.m.Y') }}
                                </p>
                                <p class="d-flex align-items-center gap-2 m-0">
                                    @if ($data->province && $data->country)
                                        <iconify-icon icon="akar-icons:location" width="16"
                                            height="16"></iconify-icon>
                                    @endif
                                    {{ $data->province->name ?? '' }}
                                    @if ($data->province && $data->country)
                                        ,
                                    @endif
                                    {{ $data->country->name ?? '' }}
                                </p>
                            </div>
                        </div>
                        <div class="job-body">
                            <p>{{ $data->job_position->description ?? '' }}</p>
                            <div class="d-flex justify-content-between gap-3">
                                <a class="custom-button btn-grey-outline w-100"
                                    href="/job-details/{{ $data->slug ?? '' }}">More info</a>
                                <button class="custom-button btn-orange-fill w-100 fw-bold" data-bs-toggle="modal"
                                    data-bs-target="#viewJobModel" onclick="loadJobDetails({{ $data->id }})">Apply
                                    Now</button>
                            </div>
                        </div>
                    </div> --}}
                @include('avenger.frontend.job-card', $jobOpenings)
                {{-- @endforeach --}}
            </div>
        </div>
    </section>
    @include('avenger.frontend.job-modal')

@endsection


@section('scripts')

    <script src="{{ asset('employee/assets/js/custom/jobpopup.js') }}"></script>

@endsection
