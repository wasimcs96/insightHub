@extends('employee.layout.app')

@section('title', 'Settings')
@section('style')
    <style>
        .toggle-password {
            top: 73%;
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
                        Settings </li>
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
            <div class="card card-docs flex-row-fluid mb-2" id="kt_docs_content_card">
                <!--begin::Card Body-->
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15 text-gray-700">
                    <!--begin::Heading-->
                    <div class="d-flex flex-stack mb-2">
                        <span class="text-gray-900 fw-bold fs-1 me-5">Video Tutorials</span>


                    </div>
                    <!--end::Heading-->

                    <!--begin::Description-->
                    <div class="fw-semibold text-gray-600 fs-5 mb-7">
                        Video tutorials prepared so that you can have a better understanding of the software
                    </div>
                    <!--end::Description-->

                    <!--begin::Row-->
                    <div class="row g-10">


                        <div class=" col-lg-6">
                            <div class="card card-body">
                                <div class="pb-3">
                                    <h4>Employee Sign In </h4>
                                </div>
                                <!--begin::Video-->
                                <div class="card-rounded ratio ratio-16x9 border-1 border-dotted">
                                    {{-- <iframe src="https://www.youtube.com/embed/HJ3RNhoI24A" title="YouTube video"
                                    allowfullscreen="" class="rounded"></iframe> --}}
                                    <video controls class="rounded" width="100%" height="auto">
                                        <source src="{{ asset('videos/help/sign_in.mp4') }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>


                            <!--end::Video-->
                        </div>

                        <div class=" col-lg-6">
                            <div class="card card-body">
                                <div class="pb-3">
                                    <h4>Employee About Me</h4>
                                </div>
                                <!--begin::Video-->
                                <div class="card-rounded ratio ratio-16x9 border-1 border-dotted">
                                    {{-- <iframe src="https://www.youtube.com/embed/HJ3RNhoI24A" title="YouTube video"
                                    allowfullscreen="" class="rounded"></iframe> --}}
                                    <video controls class="rounded" width="100%" height="auto">
                                        <source src="{{ asset('videos/help/about_me.mp4') }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>


                            <!--end::Video-->
                        </div>

                        <div class=" col-lg-6">
                            <div class="card card-body">
                                <div class="pb-3">
                                    <h4>Employee Personality and Motivation Assessment</h4>
                                </div>
                                <!--begin::Video-->
                                <div class="card-rounded ratio ratio-16x9 border-1 border-dotted">
                                    {{-- <iframe src="https://www.youtube.com/embed/HJ3RNhoI24A" title="YouTube video"
                                    allowfullscreen="" class="rounded"></iframe> --}}
                                    <video controls class="rounded" width="100%" height="auto">
                                        <source src="{{ asset('videos/help/personality.mp4') }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>


                            <!--end::Video-->
                        </div>

                        <div class=" col-lg-6">
                            <div class="card card-body">
                                <div class="pb-3">
                                    <h4>Employee Cognitive Ability Assessment</h4>
                                </div>
                                <!--begin::Video-->
                                <div class="card-rounded ratio ratio-16x9 border-1 border-dotted">
                                    {{-- <iframe src="https://www.youtube.com/embed/HJ3RNhoI24A" title="YouTube video"
                                    allowfullscreen="" class="rounded"></iframe> --}}
                                    <video controls class="rounded" width="100%" height="auto">
                                        <source src="{{ asset('videos/help/cognitive.mp4') }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>


                            <!--end::Video-->
                        </div>

                        <div class=" col-lg-6">
                            <div class="card card-body">
                                <div class="pb-3">
                                    <h4>Employee Work Interest Assessment</h4>
                                </div>
                                <!--begin::Video-->
                                <div class="card-rounded ratio ratio-16x9 border-1 border-dotted">
                                    {{-- <iframe src="https://www.youtube.com/embed/HJ3RNhoI24A" title="YouTube video"
                                    allowfullscreen="" class="rounded"></iframe> --}}
                                    <video controls class="rounded" width="100%" height="auto">
                                        <source src="{{ asset('videos/help/work_interest.mp4') }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>


                            <!--end::Video-->
                        </div>


                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Card Body-->
            </div>
        </div>
    </div>
@endsection
