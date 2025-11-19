@extends('admin.layout.app')

@section('title', 'Roles')

@section('styles')
<style>
    .displayNone {
        display: none;
    }

    .report-message-container {
        text-align: center;
        /* Centers the text */
        padding: 50px;
        /* Adds space around the content */
        color: #6c757d;
        /* Sets the text color */
        font-family: Arial, sans-serif;
        /* Sets the font style */
    }

    .report-message-container h2 {
        margin-bottom: 16px;
        /* Space below the header */
        font-size: 24px;
        /* Sets the font size for the header */
    }

    .report-message-container p {
        margin-bottom: 24px;
        /* Space below the paragraph */
        font-size: 16px;
        /* Sets the font size for the paragraph */
    }

    .report-link-button {
        display: inline-block;
        /* Makes the link a block-level element */
        padding: 10px 20px;
        /* Adds padding inside the button */
        font-size: 16px;
        /* Sets the font size for the button */
        color: #f7941d;
        /* Sets the text color for the button */
        border: 1px solid #f7941d;
        /* Sets the background color for the button */
        border-radius: 22px;
        /* Rounds the corners of the button */
        text-decoration: none;
        /* Removes the underline from the link */
        transition: background-color 0.3s ease;
        /* Adds a transition effect when hovering or focusing */
    }


    .step-bar-wrapper {
        font-size: 0;
        background: #fff;
        text-align: center;
        padding: 50px 0 0;
        /* box-shadow:5px 5px 24px 0px rgba(0, 0, 0, 0.2); */
        width: 100%;
        margin: 30px auto 0;
        position: relative;
        z-index: 10;
        border-radius: 10px
    }

    a {
        color: #5c399e;
        /* change primary color */
    }

    .step-wrapper {
        padding: 0;
        margin: 0;
        font-size: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        counter-reset: step;
        tr
    }

    .step-wrapper li {
        width: 120px;
    }

    .step-wrapper li>a:before {
        content: '';
        width: 36px;
        height: 36px;
        display: block;
        font-size: 16px;
        font-weight: 700;
        background-color: transparent;
        border-radius: 100%;
        z-index: 1;
        position: absolute;
        text-align: center;
    }

    .step-wrapper li>a:after {
        content: counter(step);
        counter-increment: step;
        width: 36px;
        line-height: 36px;
        display: block;
        font-size: 16px;
        color: #bbb;
        font-weight: 700;
        background-color: transparent;
        border-radius: 100%;
        z-index: 1;
        position: absolute;
        text-align: center;
    }

    .step-wrapper li.completed>a:after {
        content: '\2713';
        color: currentColor;
    }

    .step-wrapper li:first-of-type a:before,
    .step-wrapper li:first-of-type a:after {
        margin-left: -42px;
    }

    .step-wrapper li:last-of-type>a:before,
    .step-wrapper li:last-of-type>a:after {
        margin-left: 39px;

    }

    .step-wrapper li.completed>a:before {
        background: #fff;
        color: #c4c4c4;
        -webkit-box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.15);
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.15);
    }

    .step-wrapper li.active>a:before {
        background-color: #f7941d;
        -webkit-box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0.15), inset 0px 0px 0px 0px rgba(0, 0, 0, 0.15), 0px 0px 9px 0px #f7941d;
        background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(247, 247, 247, 0.5)), to(rgba(231, 231, 231, .01)));
        background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(247, 247, 247, 0.5)), to(rgba(231, 231, 231, .01)));
        background-image: -webkit-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
        background-image: -moz-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
        background-image: -ms-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
        background-image: -o-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
    }

    .step-wrapper li.active>a:after {
        color: #fff;
    }

    .step-wrapper li span {
        display: block;
        width: 100%;
        text-align: center;
        margin-bottom: 15px;
    }

    .step-wrapper li span a {
        font-size: 14px;
        font-weight: 700;
    }

    .step-wrapper li:not(.active):not(.completed) span a {
        color: #bbb;
    }

    .step-wrapper li>a {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        height: 48px
    }

    .step-wrapper li:first-of-type>a {
        padding-left: 40px;
    }

    .step-wrapper li:last-of-type>a {
        padding-right: 40px;
    }

    .step-wrapper li>a svg {
        height: 48px;
        min-height: 48px;
        width: auto;
        position: absolute;
        display: inline-block;
        stroke-width: 0;
        transition: all 300ms ease-in-out;
    }

    .step-wrapper li>a svg {
        filter: url(#inset-shadow);
    }

    a.button {
        margin: 50px 15px;
        display: inline-block;
        border-radius: 4px;
        width: 100px;
        height: 50px;
        text-align: center;
        line-height: 50px;
        background-color: currentColor;
        -webkit-box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.15), inset 0px 0px 0px 2px rgba(0, 0, 0, 0.15), 0px 0px 21px 0px currentColor;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.15), inset 0px 0px 0px 2px rgba(0, 0, 0, 0.15), 0px 0px 21px 0px currentColor;
        background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(247, 247, 247, 0.5)), to(rgba(231, 231, 231, .01)));
        background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(247, 247, 247, 0.5)), to(rgba(231, 231, 231, .01)));
        background-image: -webkit-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
        background-image: -moz-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
        background-image: -ms-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
        background-image: -o-linear-gradient(top, rgba(247, 247, 247, 0.5), rgba(231, 231, 231, .01));
    }

    a.button span {
        color: #fff;
        font-size: 16px;
    }
</style>
<style>
    /* Styling for the container holding the buttons */
    .button-container {
        position: fixed;
        /* Fixed positioning to make it stick */
        bottom: 0;
        /* Align to the bottom of the page */
        left: 0;
        /* Align to the left side of the page */
        width: 100%;
        /* Full width */
        background-color: #ffffff;
        /* Light grey background */
        text-align: center;
        /* Center the buttons inside the container */
        border-top: 1px dashed #DBDFE9;
        z-index: 40;
    }

    /* Styling for each button */
    .sticky-button {
        padding: 3px 18px;
        /* Padding around text */
        margin: 10px;
        /* Space between buttons */
        font-size: 16px;
        /* Font size */
        cursor: pointer;
        /* Cursor to pointer to indicate it's clickable */
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
                    <a href="/admin/dashboard" class="text-muted text-hover-primary">
                        Admin </a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->

                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    Compare </li>
                <!--end::Item-->

            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->

        <!--end::Actions-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->
<div id="kt_app_content" class="app-content  flex-column-fluid ">
    <!--begin::Content container-->
    <form id="myForm" action="{{route('admin.skill-competencies.stepThree', $id)}}" method="get">

    <div id="kt_app_content_container" class="app-container  container-xxl ">

        @include('admin/skill-competency.topnav')

        <div class="card">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-1 mb-1">Job Role</span>

                </h3>
                <a href="/admin/skill-competencies/skill-review" class="align-content-center pb-4 text-gray-600">Skill & Competencies Review Form</a>
            </div>
            <!--begin::Body-->
            <div class="card-body p-lg-17">

                <div class="d-flex flex-column flex-lg-row mb-17">
                    <!--begin::Sidebar-->
                    <div class="flex-lg-row-auto w-100 w-lg-275px w-xxl-350px me-0 me-lg-20">

                        <!--begin::Careers about-->
                        <div class="card bg-light ">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Top-->
                                <div class="mb-7">
                                    <!--begin::Title-->
                                    <h2 class="fs-1 text-gray-800 w-bolder mb-6">
                                        Employee Detail
                                    </h2>
                                    <!--end::Text-->
                                </div>
                                <!--end::Top-->


                                <!--begin::Item-->
                                <div class="mb-8">
                                    <!--begin::Title-->

                                    <!--end::Title-->

                                    <!--begin::Section-->
                                    <div class="my-2">
                                        <!--begin::Row-->
                                        @if(isset($data['users']) && count($data['users']) > 0)
                                        @foreach($data['users'] as $userData)
                                        <!-- User Information -->
                                        <div class="align-items-center mb-5">
                                            <div class="text-dark-600 color-dark fw-semibold fs-4">Name</div>
                                            <div class="text-gray-600 fw-semibold fs-3">{{ $userData['name'] }}</div>
                                        </div>
                                        @endforeach
                                        @endif
                                        <!--end::Row-->
                                        <div class="align-items-center mb-3 pt-4">
                                            <div class="text-dark-600 color-dark fw-semibold fs-4">Department</div>
                                            <div class="text-gray-600 fw-semibold fs-3">{{ $department->name }}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!-- You can add more rows to display other data -->
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Item-->

                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Careers about-->

                    </div>
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ">

                    @if(isset($data['users']) && count($data['users']) > 0)
        @foreach($data['users'] as $userData)
            <!--begin::Job-->
            <div class="mb-7">
                <!--begin::Description-->
                <div class="m-0">
                    <!--begin::Title-->
                    <h4 class="fs-1 text-gray-800 w-bolder mb-6">
                        {{ $userData['job_title'] }}
                    </h4>
                    <!--end::Title-->

                    <!--begin::Text-->
                    <p class="fw-semibold fs-4 text-gray-600 mb-2">
                        {{ $userData['job_description'] }}
                    </p>
                    <!--end::Text-->
                </div>
                <!--end::Description-->

                <!--begin::Accordion-->
                <!--begin::Section-->
                <div class="mt-5">
                    <!--begin::Heading-->
                    <div class="d-flex align-items-center collapsible py-3 toggle mb-0 collapsed" data-bs-toggle="collapse" data-bs-target="#kt_job_{{ $loop->index }}" aria-expanded="false">
                        <!--begin::Title-->
                        <h4 class="text-gray-700 fw-bolder fs-3 cursor-pointer mb-0">
                            Generic Skills & Competencies
                        </h4>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                </div>
                <!--end::Section-->

                <!--begin::Skills-->
                @if(isset($userData['skills']) && count($userData['skills']) > 0)
    @foreach($userData['skills'] as $skill)
        <div class="m-0">
            <!--begin::Heading-->
            <div class="d-flex align-items-center py-3 mb-0 justify-content-between">
                <!--begin::Label-->
                <div class="d-flex align-items-center ps-10 mb-n1">
                    <!--begin::Bullet-->
                    <span class="bullet me-3"></span>
                    <!--end::Bullet-->

                    <!--begin::Label-->
                    <div class="text-gray-600 fw-semibold fs-6">
                        {{ $skill['title'] }}
                    </div>
                    <!--end::Label-->
                </div>
                <!-- Determine the level text based on the skill level -->
                @php
                    switch ($skill['level']) {
                        case 0:
                            $levelText = 'Low';
                            break;
                        case 1:
                            $levelText = 'Medium';
                            break;
                        case 2:
                            $levelText = 'High';
                            break;
                        default:
                            $levelText = 'Unknown';
                            break;
                    }
                @endphp
                <div class="text-gray-700 fw-semibold fs-6">{{ $levelText }}</div>
                <!--end::Label-->
            </div>
            <!--end::Heading-->

            <!--begin::Separator-->
            <div class="separator separator-dashed"></div>
            <!--end::Separator-->
        </div>
    @endforeach
@else
                    <div class="m-0">
                        <div class="d-flex align-items-center py-3 mb-0">
                            <div class="text-gray-600 fw-semibold fs-6">No skills available.</div>
                        </div>
                        <div class="separator separator-dashed"></div>
                    </div>
                @endif
                <!--end::Skills-->
            </div>
            <!--end::Job-->
        @endforeach
    @else
        <div class="text-gray-600 fw-semibold fs-3">No users selected.</div>
    @endif
                        <!--begin::Job-->
                        <div class="mb-10 mb-lg-0 ">
                            <div class="mt-5">
                                <!--begin::Heading-->
                                <div class="d-flex align-items-center collapsible py-3 toggle mb-0 collapsed" data-bs-toggle="collapse" data-bs-target="#kt_job_1_1" aria-expanded="false">
                                    <!--begin::Icon-->

                                    <!--end::Icon-->

                                    <!--begin::Title-->
                                    <h4 class="text-gray-700 fw-bolder fs-3 cursor-pointer mb-0">
                                        Critical Work Functions
                                    </h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->

                                <!--begin::Separator-->
                                {{-- <div class="separator separator-dashed"></div> --}}
                                <!--end::Separator-->
                            </div>
                            <!--begin::Section-->
                            @if(isset($userData['critical_functions']) && count($userData['critical_functions']) > 0)
    @foreach($userData['critical_functions'] as $index => $criticalFunctions)
        <div class="m-0">
            <!--begin::Heading-->
            <div class="d-flex align-items-center collapsible py-3 toggle collapsed  mb-0" data-bs-toggle="collapse" data-bs-target="#kt_job_{{$index}}_1">
                <!--begin::Icon-->
                <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                    <iconify-icon icon="solar:alt-arrow-up-outline" class="toggle-on fs-1"></iconify-icon>
                    <iconify-icon icon="solar:alt-arrow-down-outline" class="toggle-off fs-1"></iconify-icon>
                </div>
                <!--end::Icon-->
                <!--begin::Title-->
                <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">
                    {{$criticalFunctions['description']}}
                </h4>
                <!--end::Title-->
            </div>
            <!--end::Heading-->

            <!--begin::Body-->
            <div id="kt_job_{{$index}}_1" class="collapse fs-6 ms-1">
                @if(isset($criticalFunctions['cwf_keys']) && count($criticalFunctions['cwf_keys']) > 0)
                    @foreach($criticalFunctions['cwf_keys'] as $cwfKey)
                        <!--begin::Item-->
                        <div class="mb-4">
                            <!--begin::Item-->
                            <div class="d-flex align-items-center ps-10 mb-n1">
                                <!--begin::Bullet-->
                                <span class="bullet me-3"></span>
                                <!--end::Bullet-->
                                <!--begin::Label-->
                                <div class="text-gray-600 fw-semibold fs-6">
                                    {{ $cwfKey}} </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Item-->
                    @endforeach
                @endif
                <!--begin::Separator-->
                <div class="separator separator-dashed"></div>
                <!--end::Separator-->
            </div>
        </div>
    @endforeach
@endif
                        <!--end::Job-->

                        <!--begin::Job-->
                  
                        <!--end::Job-->

                    </div>
                    <!--end::Content-->


                    <!--end::Sidebar-->
                </div>
                <!--end::Layout-->




                <!--end::Card-->
            </div>
            <!--end::Body-->
        </div>


    </div>
</div>
{{-- footer --}}
<div class="button-container">
    <div class="d-flex justify-content-between">
        <a class="sticky-button fs-2 d-flex align-items-center" style="color:#f7941d" onclick="goBack()"><iconify-icon icon="ic:round-arrow-back-ios"></iconify-icon>Back</a>
        <button type="submit" class="sticky-button btn btn-primary">Next</button>
    </div>
</div>
</form>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#employees').select2({
            maximumSelectionLength: 5,
            placeholder: "Select Employees",
            allowClear: true
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#departments').select2({
            maximumSelectionLength: 2,
            placeholder: "Select Department",
            allowClear: true
        });
    });
</script>
<script>
    document.getElementById("pool").addEventListener("change", function() {

        var value = this.value;
        var departmentsDiv = document.getElementById("departmentsDiv");
        var employeesDiv = document.getElementById("employeesDiv");
        console.log("hello")
        // Reset visibility

        // departmentsDiv.classList.remove("displayNone");
        // employeesDiv.classList.remove("displayNone");

        if (value == "departments") {
            employeesDiv.classList.add("displayNone");
            departmentsDiv.classList.remove("displayNone");
        } else if (value == "employees") {
            departmentsDiv.classList.add("displayNone");
            employeesDiv.classList.remove("displayNone");
        } else {
            departmentsDiv.classList.add("displayNone");
            employeesDiv.classList.remove("displayNone");
        }
    });
    function goBack() {
            // This function can be customized to navigate to a specific URL or perform another action
            // alert("Custom back button action");
            // For example, to go back to the previous page in the history:
            history.back();
        }
</script>
<script>
        document.addEventListener("DOMContentLoaded", function() {
            // Push a state to the history stack
            history.pushState(null, null, location.href);

            // Add an event listener to detect when the user tries to go back
            window.addEventListener('popstate', function(event) {
                // Push the same state again to effectively block the back button
                history.pushState(null, null, location.href);
                // alert("Back navigation is disabled on this page.");
            });
        });
    </script>
@endsection