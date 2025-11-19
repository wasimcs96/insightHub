{{-- resources/views/frontend/job-detail.blade.php --}}
@extends('avenger.layouts.app')

@section('title', env('APP_NAME') . ' | Applications')

@section('styles')

    <style>
        .feedback-message {
            display: flex;
            background: #DDF5E2;
            padding: 0px 26px;
            height: 80px;
        }

        .feedback-message p {
            color: #071437;
            font-size: 13.975px;
            line-height: 16.77px;
        }

        .feedback-message .icon {
            color: #78829D;
        }

        .search-container {
            background-color: #F1F1F4;
            height: 120px;
        }

        .search-container .heading {
            color: #4B5675;
            font-size: 39px;
            font-weight: 600;
            line-height: 46.8px;
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
    </style>

    <style>
        .job-applications {
            padding: 80px 10px;
        }

        .job-applications .inner {
            padding: 48px;
            border-radius: 8px;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .job-applications .table:not(.table-bordered)>:not(:last-child)>:last-child>* {
            background: #FAFAFB;
            padding: 16px 14px;
            color: #4B5675;
            text-align: center;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
        }

        .job-applications .table:not(.table-bordered) tbody tr td,
        .table:not(.table-bordered) tbody tr th,
        .table:not(.table-bordered) tfoot tr td,
        .table:not(.table-bordered) tfoot tr th {
            padding: 16px;
            vertical-align: middle;
            color: #4B5675;
            text-align: center;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
        }

        .job-applications .table:not(.table-bordered) td:first-child {
            font-weight: 600 !important;
        }

        .job-applications .table-button button,
        .table-button a {
            display: flex;
            padding: 8px 16px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #78829D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            width: fit-content;
            margin: auto;
        }

        .modal-div .modal-title {
            color: #071437;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
        }

        .modal-div .modal-body p {
            color: #071437;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
            text-align: left;
        }
    </style>

    <style>
        .job-openings {
            padding: 120px 10px;
            background: rgba(241, 241, 244, 0.50);
        }

        .job-openings .heading,
        .job-applications .heading {
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

     
    </style>

    <style>
        .how-it-works {
            padding: 120px 10px;
            background: #F1F1F4;
        }

        .how-it-works h4 {
            color: #4B5675;
            text-align: center;
            font-size: 32.5px;
            font-weight: 600;
            line-height: 39px;
            margin-bottom: 48px;
        }

        .how-it-works .works-card .works-icon {
            display: flex;
            padding: 24px;
            align-items: center;
            border-radius: 100px;
            background: #DBDFE9;
            color: #78829D;
            margin-bottom: 24px;
            width: fit-content;
            height: fit-content;
        }

        .how-it-works .works-card .step-text {
            color: #99A1B7;
            font-size: 13.975px;
            font-weight: 700;
            line-height: 16.77px;
        }

        .how-it-works .works-card .head {
            color: #4B5675;
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
        }

        .how-it-works .works-card .desc {
            color: #4B5675;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
        }

        .works-button {
            color: #F7941C;
            font-size: 12px;
            line-height: 16px;
            padding: 12px 18px;
            border-radius: 4px;
            border: 1px solid #F7941C;
            background: #FFF;
        }
    </style>

@endsection

@section('content')
    <section class="d-flex align-items-center flex-column justify-content-center search-container">
        <h2 class="heading">Job Applications</h2>
    </section>

    <!--end::Alert-->
    <section class="job-applications">
        <div class="container m-auto inner">
            <h4 class="heading m-0">Job Applications</h4>
            @if ($applications->count() > 0)
                <table class="table mt-5 mb-0">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="min-w-125px text-center">Position Title</th>
                            <th class="min-w-125px text-center">Resume</th>
                            <th class="min-w-125px text-center">Application Status</th>
                            <th class="min-w-125px text-center">Status</th>
                            <th class="min-w-200px text-center">Applied At</th>
                            <th class="min-w-200px text-center rounded-end">Action</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->

                    <!--begin::Table body-->


                    <tbody>

                        @foreach ($applications as $application)
                            <tr>
                                <td>{{ $application->jobOpening->job_title ?? '' }}</td>
                                <td>
                                    @if (auth()->user()->cv_resume)
                                        <a target="_blank" href="{{ asset(auth()->user()->cv_resume) }}">View</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if ($application->application_status == 1)
                                        Applied
                                    @else
                                        Withdraw
                                    @endif
                                </td>
                                <td>{{ config('helpers.application_status')[$application->status] ?? '' }}</td>
                                @php

                                    $created_at = new DateTime($application->created_at);

                                    $formatted_date = $created_at->format('Y-m-d H:i:s');
                                @endphp
                                <td>

                                    {{ $formatted_date ?? '' }}
                                </td>
                                <td>
                                    <div class="d-flex flex-column gap-3 table-button">
                                        <a href="{{ route('job-details', $application->jobOpening->slug ?? '') }}">
                                            <iconify-icon icon="lucide:eye" width="16"
                                                height="16"></iconify-icon>View
                                            Job
                                            Description
                                        </a>


                                        <form action="{{ route('admin.application.update-status', $application->id) }}"
                                            method="POST" id="statusForm-{{ $application->id }}">
                                            @csrf
                                            <input type="hidden" name="application_status" value="0">
                                            <button type="button" class="withdrawButton" title="Withdraw Application"
                                                data-job-id="{{ $application->id ?? '' }}"
                                                @if ($application->application_status == 0 || $application->status == 8) disabled style="cursor: no-drop;color: black;" @endif>
                                                <iconify-icon icon="charm:cross" width="16"
                                                    height="16"></iconify-icon>
                                                Withdraw Application
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>

                    <!--end::Table body-->
                </table>
            @else
                <div class="d-flex justify-content-around mt-13">
                    <div class="text-center">

                        <p class="fs-6 fw-bold text-gray-600">No job applications available</p>
                        <p class="text-gray-700">Start applying now and your applications will show up here</p>
                        <a href="{{ route('all-jobs') }}" class="btn btn-primary rounded-2">Search Jobs</a>
                    </div>

                </div>
            @endif
        </div>
    </section>

    <section class="job-openings">
        <div class="m-auto container">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="heading m-0">Other jobs you might be interested in</h4>
                <a href="{{ route('all-jobs') }}">
                    <button class="see-all-btn">See All Jobs<iconify-icon icon="ic:round-chevron-right" width="16"
                            height="16"></iconify-icon></button>
                </a>
            </div>

            <div class="d-grid gap-8 mt-5" style="
            grid-template-columns: 31.8% 31.8% 31.8%;
        ">
                {{-- @foreach ($relatedJobs as $data)
                <div class="job-card">
                    <div class="job-header">
                        <h6>{{ $data->job_title ?? '' }}</h6>
                        <div class="d-flex align-items-center gap-3">
                            <p class="d-flex align-items-center gap-2 m-0">
                                <iconify-icon icon="mdi:clock-outline" width="16" height="16"></iconify-icon>
                                {{ \Carbon\Carbon::parse($data->created_at)->format('d.m.Y') }}
                            </p>
                            <p class="d-flex align-items-center gap-2 m-0"> 
                                @if ($data->province && $data->country)
                                    <iconify-icon icon="akar-icons:location" width="16" height="16"></iconify-icon>
                                @endif
                                {{ $data->province->name ?? '' }}
                                @if ($data->province && $data->country) , @endif
                                {{ $data->country->name ?? '' }}
                            </p>
                        </div>
                    </div>
                    <div class="job-body">
                        <p>{{ $data->job_position->description ?? '' }}</p>
                        <div class="d-flex justify-content-between gap-3">
                            <a class="custom-button btn-grey-outline w-100" href="/job-details/{{ $data->slug ?? '' }}">More info</a>
                            <button class="custom-button btn-orange-fill w-100 fw-bold" data-bs-toggle="modal" 
                                    data-bs-target="#viewJobModel" onclick="loadJobDetails({{ $data->id }})">Apply Now</button>
                        </div>
                    </div>
                </div>
            @endforeach --}}

                @include('avenger.frontend.job-card', $jobOpenings)
            </div>
        </div>
    </section>

    <section class="how-it-works" id="how-it-works">
        <h4 class="text-center">How it works</h4>
        <div class="m-auto container">
            <div class="d-flex gap-8 mt-5">
                <div class="works-card w-25">
                    <iconify-icon icon="ic:round-login" width="32" height="32" class="works-icon"></iconify-icon>
                    <p class="mb-3 step-text">STEP 1</p>
                    <p class="mb-3 head">Sign Up</p>
                    <p class="mb-3 desc">Create your profile to get started—fill in your details, skills, preferences, and
                        upload your documents.</p>
                    @guest
                        <a href="/register" class="works-button fw-bold">Sign Up Now</a>
                    @endguest
                </div>
                <div class="works-card w-25">
                    <iconify-icon icon="lucide:briefcase" width="32" height="32" class="works-icon"></iconify-icon>
                    <p class="mb-3 step-text">STEP 2</p>
                    <p class="mb-3 head">Apply for Jobs</p>
                    <p class="mb-3 desc">Browse available positions, apply with a single click, and track your application
                        status.</p>
                    @if (auth()->user() != null)
                        <a href="{{ route('all-jobs') }}" class="works-button fw-bold">Browse Jobs</a>
                    @else
                        <a href="/register" class="works-button fw-bold">Sign Up Now</a>
                    @endif
                </div>
                <div class="works-card w-25">
                    <iconify-icon icon="lucide:clipboard" width="32" height="32" class="works-icon"></iconify-icon>
                    <p class="mb-3 step-text">STEP 3</p>
                    <p class="mb-3 head">Complete Assessment</p>
                    <p class="mb-3 desc">If shortlisted, complete an assessment to showcase your skills. This step helps us
                        get to know you better and ensure a perfect fit!</p>
                    @guest
                        <a href="/register" class="works-button fw-bold">Sign Up Now</a>
                    @endguest
                </div>
                <div class="works-card w-25">
                    <iconify-icon icon="tdesign:user-checked-1" width="32" height="32"
                        class="works-icon"></iconify-icon>
                    <p class="mb-3 step-text">STEP 4</p>
                    <p class="mb-3 head">Get Hired</p>
                    <p class="mb-3 desc">Once you impress us, we’ll make an offer! Welcome to your new role.</p>
                    @guest
                        <a href="/register" class="works-button fw-bold">Sign Up Now</a>
                    @endguest
                </div>
            </div>
        </div>
    </section>
    @include('avenger.frontend.job-modal')

@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const withdrawButtons = document.querySelectorAll('.withdrawButton');

            withdrawButtons.forEach(function(buttonElement) {
                buttonElement.addEventListener('click', function(event) {
                    event.preventDefault();
                    const jobId = buttonElement.getAttribute('data-job-id');
                    const statusForm = document.getElementById('statusForm-' + jobId);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you want to withdraw the application?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, withdraw it!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            statusForm.submit();
                        }
                    });
                });
            });
        });
    </script>
    <script src="{{ asset('employee/assets/js/custom/jobpopup.js') }}"></script>

@endsection
