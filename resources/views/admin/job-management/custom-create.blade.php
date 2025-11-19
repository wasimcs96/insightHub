@extends('admin.layout.app')

@section('title', 'Setting - Job Descriptions')
@section('styles')
    <style>
        .navtab-btn {
            border: 1px solid #f7941d;
            border-radius: 6px;
        }

        a.bg-primary:hover {
            background-color: #000000 !important;
            color: white;
        }

        .trimmed-description {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .select2-selection__choice {
            background-color: #FFF6EA !important;
            color: #7C4A0E !important;
            /* margin-right: 2rem !important; */
        }

        .form-check-input:checked,
        .form-check-input {
            display: none;
        }

        .card-checked-orange {
            border: 1px solid #F7941D;
        }

        .header-checked-orange {
            background: #F7941D;
            color: #fff;
        }

        .card-title-orange {
            color: #FFF;
            font-size: 16.575px;
            font-weight: 700;
            line-height: 24px;
            letter-spacing: 0.15px;
        }

        .orange-check {
            color: #F7941D;
            font-size: 22px;
        }

        /* .select2-selection__choice__remove {
                                left: 80%;
                                margin-left: 8px;
                            } */
        .select2-selection__choice__display {
            /* margin-left: 0px !important; */
            /* margin-right: 15px !important; */
        }

        .app-content {
            padding: 45px 187px 225px 187px;
        }

        .card .card-header {
            padding: 24px;
        }

        .card .card-header .card-title {
            margin: 0;
        }

        .card-title {
            font-size: 17.55px;
            font-weight: 500;
            line-height: 21.06px;
        }

        .card-body {
            padding: 24px !important;
        }

        .card-body h6 {
            color: #3E3E3E;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        /* .card-body .technical-skill div:last-child {
            margin-left: 20px !important;
        } */

        .col-lg-4 {
            padding-left: 0 !important;
        }

        .select2-container--bootstrap5 .select2-selection--multiple {
            float: right;
        }

        .select2-container .select2-selection--multiple .select2-selection__rendered {
            white-space: normal;
        }

        .form-control {
            border-radius: 4px;
        }

        .submit-job-bot button,
        .submit-job-bot a,
        .add-function {
            display: flex;
            padding: 14px 20px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            border: none;
            color: #FFF;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
        }

        .submit-job-bot button {
            background: #F7941C;
        }

        .submit-job-bot a {
            background: #F24130;
        }

        .btn-vl-container {
            display: flex;
            align-items: center;
        }

        .btn-vl-container select {
            border-radius: 4px 0px 0px 4px;
            border-top: 1px solid #DBDFE9;
            border-bottom: 1px solid #DBDFE9;
            border-left: 1px solid #DBDFE9;
            border-right: 0px;
            color: #071437;
            height: 100%;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
            display: flex;
            padding: 0px 12px;
            align-items: center;
            flex: 1 0 0;
            align-self: stretch;
        }

        .btn-vl-container button {
            border-radius: 0px 4px 4px 0px;
            border: 1.5px solid #F7941C;
            display: flex;
            padding: 8px 16px;
            justify-content: center;
            align-items: center;
            align-self: stretch;
            color: #F7941D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            background: #fff;
        }

        @media (max-width: 1281px) {
            .app-content {
                padding: 45px 70px 50px 70px;
            }
        }
    </style>
    <style>
        .unique .model-head h1 {
            color: #071437;
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
        }

        .unique .model-head p {
            color: #071437;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
        }

        .unique .ts-edit-popup-body {
            display: flex;
            gap: 16px;
            align-items: center;
            flex-wrap: wrap;
        }

        .unique .ts-edit-popup-body .ts-edit-inner-box {
            min-width: 32%;
            margin: auto;
            padding: 1px;
            border-radius: 8.13px;
            border: 1px solid rgba(153, 161, 183, 0.30);
            background: #FFF;
        }

        .unique .ts-edit-inner-box .header {
            height: 69px;
            padding: 0px 29.25px;
            border-bottom: 1px solid rgba(153, 161, 183, 0.30);
        }

        .unique .ts-edit-inner-box .inner-content {
            display: flex;
            padding: 26px 29.25px;
            flex-direction: column;
            align-items: center;
            min-height: 714px;
            height: 68vh;
            overflow: scroll;
        }

        .unique .ts-edit-inner-box.bg-grey {
            background: #F1F1F4;
        }

        .unique .ts-edit-inner-box .delete-btn {
            border-radius: 4px;
            border: 2px solid #F7941C;
            background: #FFF;
            color: #F7941C;
            width: 56px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .unique .ts-edit-inner-box .header .content-header {
            color: #071437;
            font-size: 16.575px;
            font-weight: 400;
            line-height: 24px;
            letter-spacing: 0.15px;
        }

        .unique .ts-edit-inner-box .inner-content .input-box {
            display: flex;
            padding: 12px;
            align-items: flex-end;
            gap: 8px;
            border-radius: 4px;
            border: 1px solid #DBDFE9;
        }

        .unique .ts-edit-inner-box .inner-content .reset-btn {
            padding: 4px;
            width: 24px;
            height: 24px;
            border-radius: 4px;
            background: #F1F1F4;
            border: none;
            color: #99A1B7;
        }

        .unique .ts-edit-inner-box input:focus-visible,
        .unique .ts-edit-inner-box textarea:focus-visible {
            outline: none !important;
            box-shadow: none !important;
        }

        .unique .ts-edit-inner-box .inner-content textarea.form-control {
            min-height: calc(1.55rem + 2px);
            /* Adjust as needed */
        }

        .unique .ts-edit-popup-body .orange-fill-popup {
            background: #F7941C;
            color: #FFF;
        }

        .unique .ts-edit-popup-body .orange-outline-popup {
            border: 1px solid #F7941C !important;
            background: #FFF;
            color: #F7941C;
        }

        .unique .ts-edit-popup-body .disable-grey-popup {
            border: 1px solid #DBDFE9 !important;
            background: #F1F1F4;
            color: #99A1B7;
        }

        .unique .ts-edit-popup-body .grey-outline-popup {
            border: 1px solid #99A1B7 !important;
            background: #FFF;
            color: #78829D;

        }
    </style>
    <style>
        .unique .enter-jr-badge {
            background: #DDF5E2;
            color: #196329;
        }

        .unique .modal-jd-heading,
        .unique .modal-jd-heading-generate {
            color: #4B5675;
            font-size: 32.5px;
            font-weight: 600;
            line-height: 39px;
            margin-bottom: 24px;
        }

        .unique .modal-header.bg-orange {
            background: #F7941C;
            padding: 22.750px;
        }

        .unique .modal-header.bg-orange h1,
        .modal-header.bg-orange .close-color {
            color: #fff;
            background: none;
        }

        .unique .modal-content-riasec .heading {
            color: #F7941C;
            font-size: 36px;
            font-weight: 500;
        }

        .unique .modal-content-riasec .sub-heading {
            color: #F7941C;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
        }

        .unique .modal-content-riasec .para {
            color: #4B5675;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
        }

        .unique .modal-content-riasec {
            gap: 24px;
        }

        .unique .modal-page-span {
            height: 28px;
            padding: 2px 8px;
            border-radius: 4px;
            background: #F1F1F4;
            color: #4B5675;
            font-size: 16.25px;
            font-weight: 500;
            line-height: 19.5px;
            display: flex;
            align-items: center;
        }

        .unique .scroll-btn {
            background: #fff;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #DBDFE9;
            color: #78829D;
        }

        .unique .manually-radio {
            /* position: relative; */

        }

        .unique .manually-radio input[type="radio"] {
            display: none;
        }

        .unique .manually-radio input[type="radio"]:checked+.manually-modal-inner {
            border: 2px solid #F7941C !important;
        }

        .unique .manually-modal-inner:hover {
            border: 2px solid #F7941C;
        }

        .unique .manually-modal-inner .line {
            height: 2px;
            width: 100%;
            display: block;
            background-color: #F1F1F4;
        }

        .unique .popup-proceed-button:disabled {
            border: 1px solid #DBDFE9 !important;
            background: #F1F1F4;
            color: #99A1B7;
        }

        .unique .custom-btn {
            padding: 14px 16px;
            background: #F7941C;
            justify-content: center;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            width: fit-content;
            color: #fff;
        }

        .unique .custom-btn.orange-fill,
        .unique .orange-fill-popup {
            background: #F7941C;
            color: #FFF;
        }

        .unique .jd-badge {
            padding: 4px 12px;
            border-radius: 80px;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            width: fit-content;
        }

        .unique .master-jd-badge {
            background: #E3F7FF;
            color: #1877A0;
        }

        .unique .company-jd-badge {
            background: #FFF0CF;
            color: #A56313;
        }

        .unique .modal-header {
            border-bottom: none;
            padding-bottom: 0px;
        }

        .unique .modal-footer .procee {
            border-top: none;
            padding-top: 0px;
        }

        .unique .modal-footer .procee button {
            flex: 1 0 0;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
        }

        .unique .custom-popup-body h4 {
            margin: 16px auto 13px auto;
            color: #4B5675;
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
        }

        .unique .custom-popup-body p {
            color: #4B5675;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 20px;
            margin-bottom: 16px;
        }

        .unique .manually-radio {
            position: relative;
        }


        #GenerateJDUsingAI .manually-radio {
            flex: 0 0 calc(50% - 1rem);
            max-width: calc(50% - 1rem);
            display: inline-block;
            height: 100%;
        }

        #GenerateJDUsingAI .manually-modal-inner {
            height: 100%;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            box-sizing: border-box;
        }

        #GenerateJDUsingAI #jdOptionsContainer {
            scroll-behavior: smooth;
        }

        .unique .manually-radio input[type="radio"] {
            display: none;
        }

        .unique .manually-radio input[type="radio"]:checked+.manually-modal-inner {
            border: 2px solid #F7941C !important;
        }

        .unique .manually-modal-inner {
            border-radius: 16px;
            border: 2px solid #F1F1F4;
            padding: 16px;
            flex: 1 0 0;
            min-width: 32%;
            height: 150px;
            cursor: pointer;
        }

        .unique .manually-modal-inner:hover {
            border: 2px solid #F7941C;
        }

        .unique .manually-modal-inner .line {
            height: 2px;
            width: 100%;
            display: block;
            background-color: #F1F1F4;
        }

        .unique .popup-proceed-button:disabled {
            border: 1px solid #DBDFE9 !important;
            background: #F1F1F4;
            color: #99A1B7;
        }

        .task-chip {
            background-color: #FFF6EA;
            color: #7C4A0E;
            font-weight: 500;
            font-size: 14px;
            line-height: 18px;
            padding: 6px 10px;
            border-radius: 16px;
            display: inline-block;
            word-break: break-word; 
            overflow-wrap: anywhere;
        }

        .task-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            /* space between chips */
            margin-top: 8px;
        }

        /* Fix invalid input styles */
        textarea.form-control.is-invalid {
            border-color: #dc3545;
            background-color: #fff5f5;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 4px;
        }

        .right-orange-btn,
        .cross-grey-btn {
            display: flex;
            padding: 14px 20px !important;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
            background-color: #FFF !important;
        }

        .right-orange-btn {
            border: 2px solid #F7941C !important;
            color: #F7941C !important;
        }

        .cross-grey-btn {
            border: 2px solid #99A1B7 !important;
            color: #78829D !important;
        }


        .form-check-input[type=radio] {
            border-radius: 4px;
        }

        input[type="radio"] {
            accent-color: #F7941C !important;
            width: 24px;
            height: 24px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border: 2px solid #DBDFE9;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s, border-color 0.2s;
        }

        input[type="radio"]:checked {
            background-color: #F7941C;
            border: 4px solid #fff;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }

        .form-check-input:checked[type=radio] {
            --bs-form-check-bg-image: none;
        }

        @media (max-width: 1281px) {
            .app-content {
                padding: 45px 70px 50px 70px;
            }
        }

        .btn-check {
            position: absolute;
            opacity: 0;
        }

        .btn-check+label {
            cursor: pointer;
        }

        .card-checked-orange {
            border: 2px solid #F7941D !important;
            background-color: #F7941D !important;
            /* Full Orange Background */
            color: #FFFFFF !important;
        }

        /* 🔥 Selected Header - Orange Background & White Text */
        .header-checked-orange {
            background: #F7941D !important;
            color: #ffffff !important;
        }


        /* 🔥 Change icon colors to white inside the selected card */
        .card-checked-orange .fa-check-circle {
            color: #FFFFFF !important;
        }

        /* 🔥 Unselected cards remain normal */
        .card {
            background-color: #FFFFFF !important;
            color: #000000 !important;
        }

        .card .card-header {
            justify-content: flex-start !important;
        }

        .check-icon-orange {
            color: #F7941D
        }

        .card-title-orange {
            color: #FFF !important;
            font-size: 16.575px;
            font-weight: 700;
            line-height: 24px;
            letter-spacing: 0.15px;
        }

        .edit-level-btn,
        .add-task {
            border: 1px solid #F7941C;
            height: 43.59px;
            border-radius: 4px;
            background-color: #fff;
            width: 158.08px;
            display: flex;
            gap: 8px;
            align-items: center;
            justify-content: center;
            color: #F7941C;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }
        .edit-level-btn{
            width: 137px !important;
        }

        .reset-btn {
            display: flex;
            padding: 4px;
            align-items: center;
            border-radius: 4px;
            background: #F1F1F4;
            border: none;
            color: #99A1B7;
        }

        .add-task:hover {
            background-color: #F7941C;
            color: #fff;
        }

        .feedback-label {
            border: 2px solid transparent;
            border-radius: 8px;
            padding: 10px;
            cursor: pointer;
            transition: border-color 0.3s;
        }

        .feedback-label.selected {
            border-color: #F7941C;
            /* Highlight color */
        }

        .feedback-label:hover {
            border-color: #6c757d;
            /* Optional hover effect */
        }
    </style>
    <style>
        .custom-scroll-left,
        .custom-scroll-right {
            user-select: none;
            background: #fff;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #DBDFE9;
            color: #78829D;
            z-index: 10;
        }
        .select2-container {
            max-width: 100% !important;
            width: 100% !important;
            min-width: 100% !important;
        }
        
        .select-skill {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        }
        
        .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        }

        button.remove-headcount:disabled iconify-icon {
    color: #99A1B7 !important;  
}
    </style>
@endsection
@section('content')

    <div class="d-flex flex-column flex-column-fluid">

        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Custom JD
                    </h1>
                    <!--end::Title-->


                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">
                                Home </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            Job Management </li>

                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                    Custom JD </li>
                        <!--end::Item-->

                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->

            </div>

            <!--end::Actions-->
            <!--end::Toolbar container-->
        </div>

        <div id="kt_app_content" class="app-content  flex-column-fluid ">

            {{-- {{ $cachedData['is_localized_job'] }} --}}
            <!--begin::Content container-->
            <div id="kt_app_content_container">
                <form action="{{ route('admin.job-management.ai.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="jd_from" value="5">
                    <input type="hidden" name="riasec" value="{{ $cachedData['top3riasec'] ?? '' }}">
                    <input type="hidden" name="title" value="{{ $cachedData['title'] ?? '' }}">
                    <input type="hidden" name="level" value="{{ $cachedData['level'] ?? '' }}">
                    <input type="hidden" name="job_profileId" value="{{ $cachedData['job_role']  ?? '' }}">
                    <input type="hidden" name="job_familyId" value="{{ $cachedData['job_family'] ?? '' }}">
                    <input type="hidden" name="job_family_groupId" value="{{ $cachedData['job_family_group'] ?? '' }}">
                    <input type="hidden" name="type" value="{{ $cachedData['jd_type'] ?? '' }}">
                    <input type="hidden" name="localized_job" value="{{ $cachedData['is_localized_job'] ?? '' }}">

                    <input type="hidden" id="technicalSkillsJson" name="technicalskill">
                    {{-- <input type="hidden" name="technicalskill" value="{{ json_encode($cachedData['llmOutput']['technical_skills']) }}"> --}}

                    {{-- @php
                        $jobProfileId = $cachedData['job_role'] ?? null;
                        $jobProfileTitle = $jobProfile->firstWhere('id', $jobProfileId)->name ?? '';
                        $jobProfileid = $jobProfile->firstWhere('id', $jobProfileId)->aa_job_profile_id ?? '';

                        $jobFamilyId = $cachedData['job_family'] ?? null;
                        $jobFamilyTitle = $jobFamily->firstWhere('id', $jobFamilyId)->name ?? '';

                        $jobFamilyGroupId = $cachedData['job_family_group'] ?? null;
                        $jobFamilyGroupTitle = $jobFamilyGroup->firstWhere('id', $jobFamilyGroupId)->name ?? '';
                    @endphp --}}

                    @php
                        $jobProfileId = $cachedData['job_role'] ?? null;
                        $jobProfileItem = $jobProfile->firstWhere('id', $jobProfileId);

                        $jobProfileTitle = $jobProfileItem->name ?? '';
                        $jobProfileid = $jobProfileItem->aa_job_profile_id ?? '';
                        $jobDescription = $jobProfileItem->description ?? '';

                        // $jobFamilyId = $cachedData['job_family'] ?? null;
                        // $jobFamilyItem = $jobFamilyList->firstWhere('id', $jobFamilyId);
                        $jobFamilyTitle = $jobFamilyItem->name ?? '';

                        $jobFamilyGroupId = $cachedData['job_family_group'] ?? null;
                        // $jobFamilyGroupItem = $jobFamilyGroupList->firstWhere('id', $jobFamilyGroupId);
                        $jobFamilyGroupTitle = $jobFamilyGroupItem->name ?? '';
                    @endphp

                    <input type="hidden" name="status" value="2">
                    <input type="hidden" name="job_profile_name" value="{{ $jobProfileTitle ?? '' }}">

                    @php

                        $type = $cachedData['jd_type'] ?? '';
                        // switch ($type) {
                        //     case 'master-jd':
                        $heading = 'Job Role Based on Master JD';
                        //         break;
                        //     case 'company-jd':
                        //         $heading = 'Based on Company JD';
                        //         break;
                        //     default:
                        //         $heading = 'Based on AI JD';
                        // }
                    @endphp

                    {{-- <div class="card  shadow-sm mb-4">
                        <div class="bg-primary card-header">
                            <h3 class="card-title text-white">{{ $heading }}</h3>

                        </div>
                        <div class="card-body  px-2 py-5">

                            <div id="role-details" class="mt-4"></div>

                        </div>

                    </div> --}}

                    <div class="card  shadow-sm mb-4">
                        <div class="card-header">
                            <h3 class="card-title">General Info</h3>

                        </div>
                        <div class="card-body  py-5">

                            <div class="mb-5 row ">
                                <div class="fv-row  fv-plugins-icon-container col-lg-6">
                                    <label for="sector" class="fw-semibold fs-6 mb-2 required">Job Position</label>
                                    <input id="job_profile" name="job_profile" value="{{ $jobProfileTitle }}"
                                        class="form-control" placeholder="Job Role" readonly>

                                </div>
                                <div class="fv-row  fv-plugins-icon-container col-lg-6">
                                    <label for="sector" class="fw-semibold fs-6 mb-2 required">Job Position ID</label>
                                    <input id="job_profile_id" name="job_profile_id" class="form-control"
                                        value="{{ $jobProfileid }}" placeholder="Job Role" readonly>

                                </div>
                            </div>
                            <div class="mb-5 row">
                                <div class="fv-row  fv-plugins-icon-container col-lg-6">
                                    <label for="sector" class="fw-semibold fs-6 mb-2 required">Company/Division</label>
                                    <input id="job_family_group" name="job_family_group" class="form-control"
                                        value="{{ $jobFamilyGroupTitle }}" placeholder="Select the Sector" readonly>

                                </div>
                                {{-- <div class="fv-row  fv-plugins-icon-container col-lg-6">
                                <label for="department" class="fw-semibold fs-6 mb-2 required">Department</label>
                                    <select id="department" class="form-control form-control mb-3 mb-lg-0 select-department"
                                    name="org_department" required>
                                    <option value="" class="dark:bg-slate-700">Select Department</option>
                                    @foreach ($orgDepartments as $key2 => $value2)
                                        <option value="{{ $value2->id }}" class="dark:bg-slate-700"
                                            @if (isset($cachedData['department']) && $cachedData['department'] == $value2->id) selected @endif>
                                            {{ $value2->name ?? '-' }}
                                        </option>
                                    @endforeach
                                </select>

                            </div> --}}
                                <div class="fv-row  fv-plugins-icon-container col-lg-6">
                                    <label for="sector" class="fw-semibold fs-6 mb-2 required">Department</label>
                                    <input id="job_family" name="job_family" class="form-control"
                                        value="{{ $jobFamilyTitle }}" placeholder="Select the Sector" readonly>

                                </div>
                            </div>
                            {{-- {{ dd($cachedData['profile_level']) }} --}}
                            <div class="mb-5 row">
                                <div class="fv-row  fv-plugins-icon-container col-lg-6">
                                    <label for="position_level" class="fw-semibold fs-6 mb-2 required">Management
                                        Level</label>
                                    
                                    {{-- <select id="level-job" class="form-control form-control mb-3 mb-lg-0"
                                        {{ $cachedData['profile_level'] == null ? '' : 'readonly' }} name="level_job"
                                        data-fixed-value="{{ $cachedData['profile_level'] }}">
                                        <option value="" class="dark:bg-slate-700">Select Position Level</option>

                                        

                                        @php
                                            $customLevels = config('positionlevel');
                                        @endphp

                                        @foreach ($customLevels as $value => $label)
                                            <option value="{{ $value }}"
                                                {{ $cachedData['profile_level'] == $label ? 'selected' : '' }}
                                                class="dark:bg-slate-700">
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select> --}}

                                    <select id="level-job" class="form-control form-control mb-3 mb-lg-0"
                                        {{ isset($cachedData['profile_level']) && $cachedData['profile_level'] !== null ? 'readonly' : '' }} 
                                        name="level_job"
                                        data-fixed-value="{{ $cachedData['profile_level'] ?? '' }}">
                                        <option value="" class="dark:bg-slate-700">Select Position Level</option>

                                        @php
                                            $customLevels = config('positionlevel');
                                        @endphp

                                        @foreach ($customLevels as $value => $label)
                                            <option value="{{ $value }}"
                                                {{ isset($cachedData['profile_level']) && $cachedData['profile_level'] == $label ? 'selected' : '' }}
                                                class="dark:bg-slate-700">
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>



                                </div>

                                
                                <div class="fv-row  fv-plugins-icon-container col-lg-6">
                                    <label for="headcount" class="fw-semibold fs-6 mb-2 ">No. of Headcount</label>
                                    <input id="headcount" type="number" min="1" class="form-control mb-lg-0"
                                        name="heads" placeholder="Number of heads" value="100">

                                    

                                </div>
                            </div>
                            <div class="d-flex align-items-center row" id="riasec-block">
                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-9">
                                    <label for="riasec" class="fw-semibold fs-6 mb-2 required">Select Riasec</label>
                                    <select id="riasec"
                                        class="form-select mb-3 mb-lg-0 @error('riasec') is-invalid @enderror"
                                        data-control="select2" data-close-on-select="false" name="riasec[]"
                                        data-placeholder="Select Riasec" multiple required>
                                        <option value="" class="dark:bg-slate-700">Select Riasec</option>
                                        @foreach (config('constants.RIASEC_CODES') as $key24 => $value24)
                                            <option value="{{ $value24 }}" class="dark:bg-slate-700"
                                                {{ collect(old('riasec'))->contains($value24) ? 'selected' : '' }}>
                                                {{ $key24 . '(' . $value24 . ')' ?? '-' }}</option>
                                        @endforeach
                                    </select>
                                    @error('riasec')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="fv-row fv-plugins-icon-container col">
                                    <button id="generate-riasec" type="button"
                                        class="btn btn-primary d-flex align-items-center gap-2">Generate Riasec
                                        Using Job Role <iconify-icon icon="material-symbols:info-outline" width="16"
                                            height="16"></iconify-icon></button>
                                </div>
                            </div>

                            <div class="mb-5">
                                <label for="" class="form-label">Job Role Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="jobRoleDescription"
                                    data-kt-autosize="true" rows="5" cols="50">{{ old('description', $cachedData['job_profile_description'] ?? '') }}</textarea>

                                @error('description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>

                    <div class="card  shadow-sm mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Critical Work Functions</h3>

                        </div>
                        <div class="card-body  py-5">

                            <div class="critical-functions-container">
                                <!-- Dynamic content will be inserted here -->
                            </div>

                            @if ($errors->has('functions'))
                                <div class="text-danger mt-2">
                                    {{ $errors->first('functions') }}
                                </div>
                            @endif

                            <button type="button" id="add_new_function" class="add-function mt-5"
                                style="background:#F7941C"><iconify-icon icon="stash:plus-solid"
                                    style="font-size: 20px"></iconify-icon> Add New
                                Function</button>
                            <div id="validationMessage" style="color: red; display: none;">Atlest one Critical Work
                                Function
                                is required.</div>
                        </div>

                    </div>

                    <div class="card  shadow-sm mb-4">
                        <div class="card-header">
                            <h3 class="card-title"> Technical Skills</h3>

                        </div>
                        <div class="card-body  py-5">
                            <input type="hidden" id="technicalSkillsJson" name="technicalSkillsJson" value="">
                            <div id="skills-container"></div>

                            @if ($errors->has('technicalSkills'))
                                <div class="text-danger mt-2">
                                    {{ $errors->first('technicalSkills') }}
                                </div>
                            @endif
                            <button type="button" id="add_new_skill" class="add-function mt-5"
                                style="background:#F7941C"><iconify-icon icon="stash:plus-solid"
                                    style="font-size: 20px"></iconify-icon> Add New Skill</button>
                            <div id="techvalidationmessage" style="color: red; display: none;">Atlest One Technical Skill
                                is
                                required.</div>
                        </div>

                    </div>
                    <div class="card  shadow-sm mb-4">
                        <div class="card-header">
                            <h3 class="card-title"> Generic Skills</h3>

                        </div>
                        @php $masterSkills = []; @endphp

                        <div class="card-body py-5">
                            <!-- Generic Skill 1 -->

                            <div id="generic-skills-container"></div>

                            <button type="button" id="add_new_generic_skill" class="add-function mt-5"
                                style="background:#F7941C"><iconify-icon icon="stash:plus-solid"
                                    style="font-size: 20px"></iconify-icon> Add New Skill</button>

                            <div id="genericValidationMessage" style="color: red; display: none;">
                                At least one Generic Skill is required.
                            </div>

                        </div>




                    </div>
                    <div class="card  shadow-sm mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Review Status</h3>

                        </div>
                        <div class="card-body  py-5">

                            <div class="col-lg-4">
                                <label for="job_role_desc" class="fw-semibold fs-6 mb-2">Select Status</label>
                                <select class="form-select" data-control="select2" data-placeholder="Select Status">
                                    <option></option>
                                    <option value="1">Approved</option>
                                    <option value="2" selected>Pending</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="card  shadow-sm mb-4">
                        <div class="card-header">
                            <h3 class="card-title"> Update Job Position?</h3>

                        </div>
                        <div class="card-body  py-5">

                            <div class="mb-8 col-lg-4 gap-3 d-flex submit-job-bot">
                                <button type="submit">
                                    {{-- <iconify-icon icon="flowbite:plus-outline"></iconify-icon> --}}
                                    Submit
                                </button>

                                
                                <a href="{{ url('/admin/job-management/create/Ai') }}">
                                    <iconify-icon icon="gg:trash"></iconify-icon>
                                    Discard
                                </a>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <!--end::Content container-->


        </div>
    </div>


    <!-- Thumbs Up Modal -->
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="feedbackModalLabel">Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Rate the accuracy of the results<span style="color: #F24130">*</span></h6>
                    <form id="feedback-form">
                        <!-- Feedback Options -->
                        <div class="row text-center mb-8 gap-5 m-auto emotions-div">

                            <div class="col p-0">
                                <input type="radio" class="btn-check" name="accuracy" id="accurate" value="5"
                                    autocomplete="off">
                                <label class="gap-5 d-flex flex-column feedback-label card p-5 h-100" for="accurate">
                                    <div class="heading-emotions">Accurate</div>
                                    <div class="icon_wrapper">
                                        <img src="{{ asset('images/feedback-modal/LOL.png') }}" alt="Accurate" />
                                    </div>
                                    <small class="heading-emotions-desc">The results met my
                                        expectations</small>
                                </label>
                            </div>
                            <div class="col p-0">
                                <input type="radio" class="btn-check" name="accuracy" id="partiallyAccurate"
                                    value="4" autocomplete="off">
                                <label class="gap-5 d-flex flex-column feedback-label card p-5 h-100"
                                    for="partiallyAccurate">
                                    <div class="heading-emotions">Partially Accurate</div>
                                    <div class="icon_wrapper"><img src="{{ asset('images/feedback-modal/Happy.png') }}"
                                            value="3" alt="Partially Accurate" /></div>
                                    <small class="heading-emotions-desc">The results were somewhat relevant but
                                        need improvement</small>
                                </label>
                            </div>
                            <div class="col p-0">
                                <input type="radio" class="btn-check" name="accuracy" id="notAccurate" value="3"
                                    autocomplete="off">
                                <label class="gap-5 d-flex flex-column feedback-label card p-5 h-100" for="notAccurate">
                                    <div class="heading-emotions">Not Accurate</div>
                                    <div class="icon_wrapper"><img src="{{ asset('images/feedback-modal/Neutral.png') }}"
                                            alt="Not Accurate" /></div>
                                    <small class="heading-emotions-desc">The results were not relevant to my
                                        query</small>
                                </label>
                            </div>
                            <div class="col p-0">
                                <input type="radio" class="btn-check" name="accuracy" id="confusing" value="2"
                                    autocomplete="off">
                                <label class="gap-5 d-flex flex-column feedback-label card p-5 h-100" for="confusing">
                                    <div class="heading-emotions">Confusing</div>
                                    <div class="icon_wrapper"><img src="{{ asset('images/feedback-modal/Boring.png') }}"
                                            alt="Confusing" /></div>
                                    <small class="heading-emotions-desc">The results were unclear or difficult
                                        to understand</small>
                                </label>
                            </div>
                            <div class="col p-0">
                                <input type="radio" class="btn-check" name="accuracy" id="incomplete" value="1"
                                    autocomplete="off">
                                <label class="gap-5 d-flex flex-column feedback-label card p-5 h-100" for="incomplete">
                                    <div class="heading-emotions">Incomplete</div>
                                    <div class="icon_wrapper"><img src="{{ asset('images/feedback-modal/Help.png') }}"
                                            alt="Incomplete" /></div>
                                    <small class="heading-emotions-desc">The results were insufficient or
                                        missing key elements</small>
                                </label>
                            </div>
                            <!-- Repeat for other options -->
                        </div>
                        <div class="mb-8">
                            <label for="comments" class="form-label">Share additional comments to help us
                                improve</label>
                            <textarea class="form-control" id="comments" rows="3" placeholder="I think it’s very helpful!"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="submit-feedback">Submit
                        Feedback</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Generic Skill Modal Start --}}
    <div class="modal bg-body fade" tabindex="-1" id="genericSkillModal">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Communication</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">

                        <iconify-icon icon="line-md:close" class=" fs-2x"></iconify-icon>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="row g-5 modalbody">
                        <div class="col-lg-4">
                            <div class="card card-stretch card-bordered mb-5">
                                <div class="card-header">
                                    <h3 class="card-title">Basic</h3>
                                </div>
                                <div class="card-body">
                                    Description Not Found
                                </div>
                                {{-- <div class="card-footer">
                                    Footer
                                </div> --}}
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card card-stretch card-bordered mb-5">
                                <div class="card-header">
                                    <h3 class="card-title">Intermediate</h3>
                                </div>
                                <div class="card-body">
                                    Description Not Found
                                </div>
                                {{-- <div class="card-footer">
                                    Footer
                                </div> --}}
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="card card-stretch card-bordered mb-5">
                                <div class="card-header">
                                    <h3 class="card-title">Advanced</h3>
                                </div>
                                <div class="card-body">
                                    Description Not Found
                                </div>
                                {{-- <div class="card-footer">
                                    Footer
                                </div> --}}
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-btn" data-bs-dismiss="modal"
                        onclick="updateSkillLevel(this)">Save changes</button>

                </div>
            </div>
        </div>
    </div>
    {{-- Generic Skill Modal End --}}

    {{-- Technical Skill Modal Start --}}
    <div class="modal bg-body fade" tabindex="-1" id="techskillmodal">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Communication</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">

                        <iconify-icon icon="line-md:close" class=" fs-2x"></iconify-icon>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="row g-5 modalbody">
                        <div class="col-lg-4">
                            <div class="card card-stretch card-bordered mb-5">
                                <div class="card-header">
                                    <h3 class="card-title">Level 1</h3>
                                </div>
                                <div class="card-body">
                                    Description Not Found
                                </div>
                                {{-- <div class="card-footer">
                                    Footer
                                </div> --}}
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card card-stretch card-bordered mb-5">
                                <div class="card-header">
                                    <h3 class="card-title">Level 2</h3>
                                </div>
                                <div class="card-body">
                                    Description Not Found
                                </div>
                                {{-- <div class="card-footer">
                                    Footer
                                </div> --}}
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="card card-stretch card-bordered mb-5">
                                <div class="card-header">
                                    <h3 class="card-title">Level 3</h3>
                                </div>
                                <div class="card-body">
                                    Description Not Found
                                </div>
                                {{-- <div class="card-footer">
                                    Footer
                                </div> --}}
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-btn" data-bs-dismiss="modal"
                        onclick="updateTechSkillLevel(this)" disabled>Save changes</button>

                </div>
            </div>
        </div>
    </div>
    {{-- Technical Skill Modal End --}}
    <div class="modal fade" id="EditTsfromMSL" tabindex="-1" aria-labelledby="EditTsfromMSLLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-medium" id="EditTsfromMSLLabel">Edit Technical Skill from Master Skill
                        Library</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center pt-4">
                    <iconify-icon icon="ep:warning" width="70" height="70"
                        style="color: #FABB6E;"></iconify-icon>
                    <h4 class="my-5">Edit Technical Skill from<br> Master Skill Library?</h4>
                    <p class="my-5">Changes made here will not affect the original template. Updated skills will be saved
                        as new Company technical skills after saving.</p>
                    <button class="btn btn-outline" data-bs-dismiss="modal">cancel</button>
                    <button id="continueEditSkillBtn" class="btn btn-apply text-white" style="background: #F7941C;">
                        Continue Editing
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade unique" id="tsEditLevel" tabindex="-1" aria-labelledby="tsEditLevelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="model-head">
                        <h1 class="modal-title fs-5" id="tsEditLevelLabel">Skill Name</h1>
                        <p class="m-0" style="max-height: 70px; overflow: scroll;">Skill Description</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="ts-edit-popup-body">
                        <!-- Levels will be populated dynamically by JavaScript -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="custom-btn orange-fill-popup border-0 py-4 px-6 d-flex gap-2"
                        onclick="saveTSEditLevelModal()">
                        <iconify-icon icon="tabler:check" width="16" height="16"></iconify-icon> Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade unique" id="generateRIASECJR" tabindex="-1" aria-labelledby="generateRIASECJRLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 70%;">
            <div class="modal-content">
                <div class="modal-header bg-orange">
                    <h1 class="modal-title fs-5 fw-medium" id="generateRIASECJRLabel">Generate RIASEC Using Job Position</h1>
                    <button type="button" data-bs-dismiss="modal" class="border-0 close-color"
                        aria-label="Close"><iconify-icon icon="material-symbols:close-rounded" width="24"
                            height="24"></iconify-icon></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div id="dynamic-riasec-options" class="d-flex align-items-stretch justify-content-center gap-4">
                            <label class="manually-radio">
                                <input type="radio" name="jdOption" value="custom" id="customJD1">
                                <div class="d-flex flex-column gap-3 manually-modal-inner h-100">
                                    <p
                                        class="m-0 text-left fw-bolder fs-2 d-flex justify-content-between gap-5 align-items-center ">
                                        Supervisor (Flight Operations) <span
                                            class="jd-badge text-center master-jd-badge">Master JD</span></p>
                                    <div class="line"></div>
                                    <div class="modal-content-riasec d-flex flex-column">
                                        <p class="m-0 heading">ESI</p>
                                        <div class="d-flex flex-column">
                                            <p class="m-0 sub-heading">ENTERPRISING</p>
                                            <p class="m-0 para">Ambitious, and persuasive, and enjoy taking on
                                                leadership roles and pursuing entrepreneurial endeavours</p>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <p class="m-0 sub-heading">SOCIAL</p>
                                            <p class="m-0 para">Compassionate, and empathetic, and enjoy
                                                helping
                                                and interacting with others.</p>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <p class="m-0 sub-heading">INVESTIGATE</p>
                                            <p class="m-0 para">Analytical, curious, and enjoy solving complex
                                                problems through research and analysis</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                            <label class="manually-radio">
                                <input type="radio" name="jdOption" value="master" id="masterJD">
                                <div class="d-flex flex-column gap-3 manually-modal-inner h-100">
                                    <p
                                        class="m-0 text-left fw-bolder fs-2 fw-bold d-flex justify-content-between gap-5 align-items-center">
                                        Cabin Crew 2 <span class="jd-badge text-center enter-jr-badge">Entered
                                            Job Role</span></p>
                                    <div class="line"></div>
                                    <div class="modal-content-riasec d-flex flex-column">
                                        <p class="m-0 heading">SRC</p>
                                        <div class="d-flex flex-column">
                                            <p class="m-0 sub-heading">SOCIAL</p>
                                            <p class="m-0 para">Compassionate, and empathetic, and enjoy
                                                helping and interacting with others.</p>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <p class="m-0 sub-heading">REALISTIC</p>
                                            <p class="m-0 para">Practical, and hands-on,and prefer tasks that
                                                involve working with tools, machines, or physical materials.</p>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <p class="m-0 sub-heading">CONVENTIONAL</p>
                                            <p class="m-0 para">Detail oriented, organized, and prefer tasks
                                                that involve following established procedures and rules</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="proceedBtn"
                        class="custom-btn border-0 h-auto orange-fill-popup popup-proceed-button flex-grow-0 px-14"
                        style="flex: none;" disabled>Select this RIASEC</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade unique" id="GenerateJDUsingAI" tabindex="-1" aria-labelledby="GenerateJDUsingAILabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 70%;">
            <div class="modal-content">
                <div class="modal-header bg-orange">
                    <h1 class="modal-title fs-5 fw-medium" id="GenerateJDUsingAILabel">Generate Job Description Using AI
                    </h1>
                    <button type="button" data-bs-dismiss="modal" class="border-0 close-color" aria-label="Close">
                        <iconify-icon icon="material-symbols:close-rounded" width="24" height="24"></iconify-icon>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="step1">
                        <h4 class="modal-jd-heading fs-1 fw-bolder" id="jd_title">Cabin Crew 2</h4>
                        <form>
                            <div class="d-flex align-items-stretch justify-content-center flex-column">
                                <div class="d-flex flex-column gap-3 border manually-modal-inner h-100">
                                    <p class="m-0 text-left fw-bolder fs-2">Original Job Description</p>
                                    <div class="line"></div>
                                    <p class="para fs-5" id="baseJD">The Cabin Crew 2 at AirAsia is responsible for
                                        ensuring the smooth and efficient management of flight operations during turnaround
                                        processes...</p>
                                </div>
                                <h4 class="modal-jd-heading fs-1 fw-bolder" id="jd_job_profile">Cabin Crew 2</h4>
                                <div class="mt-7">
                                    <label for="additionalDetail" class="form-label fw-semibold text-dark">Job Description
                                        from Workday</label>
                                    <textarea class="form-control" id="additionalDetail" rows="4" placeholder="Enter additional details..."></textarea>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div id="step2" class="d-none">
                        <h4 class="modal-jd-heading-generate fs-1 fw-bolder d-flex align-items-center gap-3">Generate JD
                            using AI <span class="modal-page-span">1/3</span></h4>
                        <h4 class="modal-jd-heading fs-1 fw-bolder" id="jd_job_profile_step">Cabin Crew 2 Assistant</h4>
                        <div class="d-flex flex-column gap-3">
                            <p class="m-0"><b>Job Description</b></p>
                            <p class="mb-8" id="jd_workday">(Workday JD content here...)</p>
                        </div>

                        <div class="position-relative">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="custom-scroll-left position-absolute start-0 top-50 translate-middle-y"
                                    style="cursor: pointer;" onclick="scrollJD('left')"> <iconify-icon
                                        icon="line-md:chevron-left" width="24" height="24"></iconify-icon></span>
                                <span class="custom-scroll-right position-absolute end-0 top-50 translate-middle-y"
                                    style="cursor: pointer;" onclick="scrollJD('right')"><iconify-icon
                                        icon="line-md:chevron-right" width="24" height="24"></iconify-icon></span>
                            </div>
                            <div class="jd-scroll-wrapper overflow-hidden" id="jdScrollWrapper"
                                style="scroll-behavior: smooth;">
                                <div class="d-flex flex-nowrap gap-4" id="jdOptionsContainer"
                                    style="min-width: 100%; overflow-x: auto;">
                                    <label class="manually-radio" style="min-width: 400px; display: inline-block;">
                                        <input type="radio" class="select-jd-option" name="jdOption"
                                            value="currentJDText" id="customJD_ai">
                                        <div class="d-flex flex-column gap-3 manually-modal-inner h-100">
                                            <p
                                                class="m-0 text-left fw-bolder fs-2 d-flex justify-content-between gap-5 align-items-center">
                                                Job Description <span
                                                    class="jd-badge text-center master-jd-badge">Current</span>
                                            </p>
                                            <div class="line"></div>
                                            <p id="currentJDText" class="m-0">
                                                The Cabin Crew 2 at AirAsia is responsible for ensuring the smooth and
                                                efficient management of flight operations...
                                            </p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer d-flex flex-column gap-2">
                    <div id="step1-footer" class="w-100 d-flex justify-content-end gap-3">
                        <button type="button" id="generateJD"
                            class="custom-btn border-0 h-auto orange-fill-popup popup-proceed-button d-flex gap-2 align-items-center">
                            Generate JD using AI
                            <iconify-icon icon="f7:sparkles" class="mr-1" width="24"
                                height="24"></iconify-icon>
                        </button>
                    </div>

                    <div id="step2-footer" class="w-100 d-none d-flex justify-content-between align-items-center">
                        <button type="button" id="regenerateBtn"
                            class="custom-btn border-0 h-auto orange-outline-popup popup-proceed-button">
                            Regenerate with New Details
                        </button>
                        <button type="button" id="selectJD"
                            class="custom-btn border-0 h-auto orange-fill-popup popup-proceed-button" disabled>
                            Select this Job Description
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade unique" id="CompanyTechnicalSkill" tabindex="-1" aria-labelledby="CreateJDManuallyLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="custom-popup-body modal-content">
                <div class="modal-header">
                    <div class="model-head">
                        <h1 class="modal-title fs-5">Edit Company Technical Skill</h1>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0">
                    <div class="text-center m-auto">
                        <iconify-icon icon="jam:alert" width="70" height="70"
                            style="color: #F8BB86;"></iconify-icon>
                        <h4 class="w-50">Edit Company Technical Skill?</h4>
                        <p>
                            Choose how you'd like to apply the changes to
                            <b id="companySkillName">Skill Name</b>.
                        </p>
                        <form>
                            <div class="d-flex align-items-center justify-content-center gap-4 mb-5">
                                <label class="manually-radio w-50">
                                    <input type="radio" name="jdOption" value="custom" id="customJD">
                                    <div class="d-flex flex-column gap-3 manually-modal-inner">
                                        <p class="m-0 text-left fw-bold">Customise for this JD</p>
                                        <div class="line"></div>
                                        <p class="m-0 text-left">Customise the skill specifically for this JD without
                                            affecting the version in the Company Technical Skill Library.</p>
                                    </div>
                                </label>
                                <label class="manually-radio w-50">
                                    <input type="radio" name="jdOption" value="master" id="masterJD">
                                    <div class="d-flex flex-column gap-3 manually-modal-inner">
                                        <p class="m-0 text-left fw-bold">Overwrite Company Technical Skill</p>
                                        <div class="line"></div>
                                        <p class="m-0 text-left">Replace the existing skill in the Company Technical Skill
                                            Library with the updated version.</p>
                                    </div>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="proceedCompanySkillBtn"
                        class="btn btn-apply text-white" style="background: #F7941C;"
                        disabled>Proceed</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="OverwriteCompanySkillConfirmModal" tabindex="-1" aria-labelledby="EditTsfromMSLLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style=" position: absolute; right: 15px; top: 10px; z-index: 1;
                    "></button>
                <div class="modal-body text-center pt-4">
                    <iconify-icon icon="ep:warning" width="70" height="70"
                        style="color: #FABB6E;"></iconify-icon>
                    <h4 class="my-5">Overwrite Technical Skill?</h4>
                    <p class="mx-12 my-5">You're about to overwrite the localised version of <b
                            id="overwriteCompanySkillName">Aircraft Dispatch</b>
                        in the skill
                        library. <br><br>
                        This action will update the skill details across all associated job descriptions listed below.
                    </p>
                    <div class="bg-moda-content">
                        <p class="m-0" id="affectedJobList">
                            Loading affected job titles...</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <button class="btn btn-outline m-0" data-bs-dismiss="modal">cancel</button>
                        <button id="OverwriteContinueEditSkillBtn" class="btn btn-apply text-white m-0"
                            style="background: #F24130;">
                            Overwrite
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection

@section('scripts')

    <script>
        let triggerOverwriteConfirmAfterSave = false;
        const MAX_GENERIC_SKILLS = 5;
    </script>

    <script>
        // The DOM elements you wish to replace with Tagify
        var input1 = document.querySelector("#kt_tagify_1");
        var input2 = document.querySelector("#kt_tagify_2");

        var input3 = document.querySelector("#kt_tagify_3");

        // Initialize Tagify components on the above inputs
        new Tagify(input1);
        new Tagify(input2);
        new Tagify(input3);
    </script>

    <script>
        var technicalSkills = @json($technicalSkills);
        $(document).ready(function() {
            $('#technicalSkills').select2();
            $('#superior').select2();


            $('#job_description_form').submit(function(event) {
                var job_desc = $('#job_desc').val();
                var heads = $('#heads').val();
                var position_code = $('#position_code').val();
                var job_role = $('#job_role').val();
                var job_role_desc = $('#job_role_desc').val();
                var isValid = true;
                console.log("dbhjsdfhjsdf");



                // Simple validation checks
                if (job_role_desc === '') {
                    $('#job_role_desc').next('.error').remove();
                    $('#job_role_desc').after(
                        '<span class="error">Job Role Description is required</span>');
                    isValid = false;
                } else {
                    $('#job_role_desc').next('.error').remove();
                }

                if (job_role === '') {
                    $('#job_role').next('.error').remove();
                    $('#job_role').after('<span class="error">Job Role is required</span>');
                    isValid = false;
                } else {
                    $('#job_role').next('.error').remove();
                }

                if (heads === '') {
                    $('#heads').next('.error').remove();
                    $('#heads').after('<span class="error">Job Role is required</span>');
                    isValid = false;
                } else {
                    $('#heads').next('.error').remove();
                }


                if ($('.critical-functions-container').find('.critical-function').length === 0) {
                    $('#validationMessage').show();
                    isValid = false;
                } else {
                    $('#validationMessage').hide();
                }

                if ($('#skills-container').find('.technical-skill').length === 0) {
                    $('#techvalidationmessage').show();
                    isValid = false;
                } else {
                    $('#techvalidationmessage').hide();
                }

                if (position_code === '') {
                    $('#position_code').next('.error').remove();
                    $('#position_code').after('<span class="error">Position Code is required</span>');
                    isValid = false;
                } else {
                    $('#position_code').next('.error').remove();
                }


                // Check uniqueness of position code
                if (isValid) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('check-position-code') }}",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            position_code: position_code
                        },
                        async: false,
                        success: function(response) {
                            if (!response.isUnique) {
                                $('#position_code').next('.error').remove();
                                $('#position_code').after(
                                    '<span class="error">Position Code must be unique</span>'
                                );
                                isValid = false;
                            } else {
                                $('#position_code').next('.error').remove();
                            }
                        }
                    });
                }

                // Validate generic skills
                var selectedSkills = [];
                var skillsValid = true;
                var firstInvalidSkillElement = null;

                $('select[name^="skills["][name$="[title]"]').each(function() {
                    var skillValue = $(this).val();
                    if (skillValue !== "") {
                        if (selectedSkills.includes(skillValue)) {
                            $(this).next('.error').remove();
                            $(this).after('<span class="error">Duplicate Skill Selected</span>');
                            skillsValid = false;
                            if (!firstInvalidSkillElement) {
                                firstInvalidSkillElement = $(this);
                            }
                        } else {
                            selectedSkills.push(skillValue);
                            $(this).next('.error').remove();
                        }
                    }
                });

                if (selectedSkills.length === 0) {
                    $('select[name^="skills["][name$="[title]"]').first().next('.error').remove();
                    $('select[name^="skills["][name$="[title]"]').first().after(
                        '<span class="error">At least one skill must be selected</span>');
                    skillsValid = false;
                    firstInvalidSkillElement = $('select[name^="skills["][name$="[title]"]').first();
                }

                if (!skillsValid) {
                    isValid = false;
                }



                // Validate technical skills
                var selectedTechnicalSkills = [];
                var technicalSkillsValid = true;
                var firstInvalidTechnicalSkillElement = null;

                $('select[name^="technicalSkills["][name$="[id]"]').each(function() {
                    var techSkillValue = $(this).val();
                    if (techSkillValue !== "") {
                        if (selectedTechnicalSkills.includes(techSkillValue)) {
                            $(this).next('.error').remove();
                            $(this).after(
                                '<span class="error">Duplicate Technical Skill Selected</span>');
                            technicalSkillsValid = false;
                            if (!firstInvalidTechnicalSkillElement) {
                                firstInvalidTechnicalSkillElement = $(this);
                            }
                        } else {
                            selectedTechnicalSkills.push(techSkillValue);
                            $(this).next('.error').remove();
                        }
                    }
                });

                if (selectedTechnicalSkills.length === 0) {
                    $('select[name^="technicalSkills["][name$="[id]"]').first().next('.error').remove();
                    $('select[name^="technicalSkills["][name$="[id]"]').first().after(
                        '<span class="error">At least one technical skill must be selected</span>');
                    technicalSkillsValid = false;
                    firstInvalidTechnicalSkillElement = $('select[name^="technicalSkills["][name$="[id]"]')
                        .first();
                }

                if (!technicalSkillsValid) {
                    isValid = false;
                }



                // Prevent the form submission if validation fails
                if (!isValid) {
                    event.preventDefault();
                    scrollToFirstErrorField();
                }
            });

            function scrollToFirstErrorField() {
                var firstErrorField = $(
                    '.error:visible, #validationMessage:visible, #techvalidationmessage:visible').first().prev(
                    'input, textarea, select, button');
                if (firstErrorField.length) {
                    $('html, body').animate({
                        scrollTop: firstErrorField.offset().top - 100 // Adjust the offset as needed
                    }, 500);
                    firstErrorField.focus();
                }
            }

            function scrollToElement(element) {
                $('html, body').animate({
                    scrollTop: element.offset().top - 100 // Adjust the offset to scroll more up
                }, 500);
                element.focus();
            }
        });



        $(document).ready(function() {
            $('.select-department').on('change', function() {
                var departmentId = $(this).val();

                var ajaxUrl = "by_department";

                if (departmentId) {
                    $.ajax({
                        url: ajaxUrl,
                        method: 'GET',
                        data: {
                            department_id: departmentId
                        },
                        success: function(response) {
                            // Update job descriptions dropdown options based on response
                            var options = '<option value="">Select Job Description</option>';
                            $.each(response, function(key, value) {
                                options += '<option value="' + key + '">' + value +
                                    '</option>';
                            });
                            $('#job_desc').html(options);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    formReset();
                }
            });
        });
        $(document).ready(function() {
            $('#org_department_filter').on('change', function() {
                var departmentId = $(this).val();


                var ajaxUrl = "by_org_department";

                if (departmentId) {
                    $.ajax({
                        url: ajaxUrl,
                        method: 'GET',
                        data: {
                            department_id: departmentId
                        },
                        success: function(response) {
                            // Update job descriptions dropdown options based on response
                            var options = '<option value="">Select Job Description</option>';
                            $.each(response, function(key, value) {
                                options += '<option value="' + key + '">' + value +
                                    '</option>';
                            });
                            $('#job_desc').html(options);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    formReset();
                }
            });
        });



        function test() {

        }
    </script>

    <script>
        function TechSkillChanged(index, skillId) {
            $.ajax({
                url: '/admin/get-techskill-levels/' + skillId,
                type: 'GET',
                success: function(response) {
                    const skill = response[0]; // Ensure this is the full skill object
                    if (!skill) return;

                    // Save to global data store
                    technicalSkillsData[index] = {
                        c_id: skill.c_id || null,
                        skill_id: skill.id || null,
                        code: skill.code || null,
                        sector_id: skill.sector_id || null,
                        sector_name: skill.sector_name || '',
                        sub_sector_id: skill.sub_sector_id || null,
                        sub_sector_name: skill.sub_sector_name || '',
                        name: skill.name || '',
                        description: skill.description || '',
                        preferred_level: skill.preferred_level || '',
                        is_custom: skill.is_custom ?? '',
                        category_id: skill.category_id ?? '',
                        category_name: skill.category_name ?? ''
                    };

                    // Parse levels dynamically
                    Object.keys(skill).forEach(key => {
                        const match = key.match(/^level_(\d+)_description$/);
                        if (match) {
                            const level = match[1];
                            technicalSkillsData[index][`level_${level}_description`] = skill[
                                `level_${level}_description`];
                            technicalSkillsData[index][`level_${level}_knowledge`] = Array.isArray(
                                    skill[`level_${level}_knowledge`]) ?
                                skill[`level_${level}_knowledge`] :
                                (skill[`level_${level}_knowledge`] || '').split(';');

                            technicalSkillsData[index][`level_${level}_ability`] = Array.isArray(skill[
                                    `level_${level}_ability`]) ?
                                skill[`level_${level}_ability`] :
                                (skill[`level_${level}_ability`] || '').split(';');
                        }
                    });

                    // Update the button label
                    $(`#selectTechLevelButton${index}`).html(`Level ${skill.preferred_level || ''}`);

                    // Store skill name
                    $(`#technicalSkillsHidden\\[${index}\\]`).val(skill.name);

                    // Update modal trigger
                    $(`#selectTechLevelButton${index}`).attr(
                        'onclick',
                        `technicalpopulateModal(${index})`
                    );

                    // Optional: store the JSON in hidden field if needed
                    $('#technicalSkillsJson').val(JSON.stringify(technicalSkillsData));
                },
                error: function(error) {
                    console.error("Failed to load technical skill levels:", error);
                }
            });
        }



        function skillChanged(index, skillName) {
            $.ajax({
                url: '/admin/get-skill-levels/' + skillName, // Adjust this URL as necessary
                type: 'GET',
                success: function(data) {

                    if (data && data.level_1 && data.level_2 && data.level_3) {
                        // Find the "Select Level" button for this skill
                        let selectLevelButton = $(`#selectLevelButton${index}`);
                        selectLevelButton.show();
                        console.log('populatedskillmodal', data);
                        // Update the onclick event with new data
                        // selectLevelButton.attr("onclick", `populateModal('${index}', '${data.skill_id}', '${skillName}', '${data.level_1}', '${data.level_2}', '${data.level_3}', '1')`);
                        selectLevelButton.attr("onclick",
                            `populateModal('${index}', '${escapeSpecialCharacters(JSON.stringify(data))}', '${skillName}','1')`
                        );
                        // Assuming default to level 1 or use current selected level
                    } else {
                        selectLevelButton.hide();

                    }
                },
                error: function(error) {
                    console.error("Error fetching level descriptors for skill:", skillName, error);
                }
            });
        }



        // function populateModal(index,skillId, skillTitle, level_1,level_2,level_3,selected_level) {
        function populateModal(index, data, skillTitle, selected_level) {
            console.log('populatedskillmodal', data);

            data = JSON.parse(data);
            console.log(data.level_1_knowledge);
            let modalBody = $('#kt_modal_2 .modalbody');
            // console.log(selected_level);
            // console.log(level_2);
            modalBody.empty(); // Clear existing modal content

            $('#kt_modal_2 .modal-title').text(skillTitle);
            // levels.forEach(level => {
            modalBody.append(`
                <div class="form-check col-lg-4">
                 
                
                    <label class="form-check-label" for="level_1">
                        <div class="col-lg-12">
                                <div class="card card-stretch card-bordered mb-5">
                                    <div class="card-header align-items-center">
                                        <h3 class="card-title">Level 1</h3>
                                        <input class="form-check-input border-dark" type="radio" value="1" id="level_1" name="level" ${selected_level == 1 ? 'checked' : ''}>

                                    </div>
                                    <div class="card-body">
                                        <h5>${data.level_1}</h5>
                                        <div class="p-3">
                                            <h4>Knowledge</h4>
                                            <div class="d-flex flex-column">
                                            ${createListFromString(data.level_1_knowledge)}
                                           
                                            </div>
                                        
                                        </div>
                                        <div class="p-3">
                                            <h4>Ability</h4>
                                            <div class="d-flex flex-column">
                                                ${createListFromString(data.level_1_ability)}
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                        </div>
                    </label>
                </div>
            `);

            modalBody.append(`
            <div class="form-check col-lg-4">
                 
                
                    <label class="form-check-label" for="level_2">
                        <div class="col-lg-12">
                                <div class="card card-stretch card-bordered mb-5">
                                    <div class="card-header align-items-center">
                                        <h3 class="card-title">Level 2</h3>
                                       <input class="form-check-input border-dark" type="radio" value="2" id="level_2" name="level" ${selected_level == 2 ? 'checked' : ''}>


                                    </div>
                                     <div class="card-body">
                                        <h5>${data.level_2}</h5>
                                        <div class="p-3">
                                            <h4>Knowledge</h4>
                                            <div class="d-flex flex-column">
                                             ${createListFromString(data.level_2_knowledge)}

                                            </div>
                                        
                                        </div>
                                        <div class="p-3">
                                            <h4>Ability</h4>
                                            <div class="d-flex flex-column">
                                               ${createListFromString(data.level_2_ability)}
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                        </div>
                    </label>
                </div>
        `);

            modalBody.append(`
            <div class="form-check col-lg-4">
                 
                
                    <label class="form-check-label" for="level_3">
                        <div class="col-lg-12">
                                <div class="card card-stretch card-bordered mb-5">
                                    <div class="card-header align-items-center">
                                        <h3 class="card-title">Level 3</h3>
                    <input class="form-check-input border-dark" type="radio" value="3" name="level" id="level_3" ${selected_level == 3 ? 'checked' : ''}>

                                    </div>
                                     <div class="card-body">
                                        <h5>${data.level_3}</h5>
                                        <div class="p-3">
                                            <h4>Knowledge</h4>
                                            <div class="d-flex flex-column">
                                                ${createListFromString(data.level_3_knowledge)}

                                            </div>
                                        
                                        </div>
                                        <div class="p-3">
                                            <h4>Ability</h4>
                                            <div class="d-flex flex-column">
                                               ${createListFromString(data.level_3_ability)}
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                        </div>
                    </label>
                </div>
        `);

            $('#kt_modal_2 .save-btn').data('skill-id', index); // Set skill ID on save button for later
        }

        function escapeSpecialCharacters(string) {
            return string.replace(/\\/g, '\\\\') // Escape backslashes
                .replace(/'/g, "\\'") // Escape single quotes
                .replace(/"/g, '\\"') // Escape double quotes
                .replace(/\n/g, '\\n') // Escape newlines
                .replace(/\r/g, '\\r') // Escape carriage returns
                .replace(/\t/g, '\\t'); // Escape tabs
        }


        function createListFromString(input) {
            // Check if input is an array
            if (Array.isArray(input)) {
                return input
                    .filter(item => item.trim() !== '') // Remove empty items
                    .map(item =>
                        `<li class="d-flex align-items-center py-2 fs-xxl-9"><iconify-icon icon="lets-icons:check-fill" class="orange-check me-3"></iconify-icon>${item.trim()}</li>`
                    )
                    .join('');
            }

            // If input is not an array, assume it's a string
            if (typeof input === 'string') {
                return input
                    .split(',') // Split by commas
                    .filter(item => item.trim() !== '') // Remove empty items
                    .map(item =>
                        `<li class="d-flex align-items-center py-2 fs-xxl-9"><iconify-icon icon="lets-icons:check-fill" class="orange-check me-3"></iconify-icon>${item.trim()}</li>`
                    )
                    .join('');
            }

            // If input is neither an array nor a string, return an empty list
            return '';
        }

        function updateSkillLevel(button) {
            const index = $(button).data('skill-id');
            const selectedLevel = $('#genericSkillModal input[name="level"]:checked').val();
            if (!selectedLevel) return;

            console.log('updateSkillLevel', index, selectedLevel);

            const levelLabel = getLevelLabel(selectedLevel);

            if (genericSkillsData[index]) {
                genericSkillsData[index].preferred_level = levelLabel;
            }

            // Update or insert the hidden input
            const container = $(`#generic-skill-${index}`);
            const inputSelector = `input[name="genericSkills[${index}][preferred_level]"]`;
            const existingInput = container.find(inputSelector);

            if (existingInput.length) {
                existingInput.val(levelLabel);
            } else {
                container.prepend(
                    `<input type="hidden" name="genericSkills[${index}][preferred_level]" value="${levelLabel}">`
                );
            }

            // Update level button display
            $(`#selectGenericLevelButton${index}`).text(levelLabel);
        }

        function updateTechSkillLevel(button) {
            let skillId = $(button).data('skill-id');
            let selectedLevel = $('#techskillmodal .modal-body input:checked').val();

            if (!technicalSkillsData[skillId]) return;

            technicalSkillsData[skillId].preferred_level = parseInt(selectedLevel);

            // Update the hidden input value (or insert if not present)
            const hiddenInputSelector = `input[name="technicalSkills[${skillId}][preferred_level]"]`;
            let inputEl = $(hiddenInputSelector);
            if (inputEl.length) {
                inputEl.val(selectedLevel);
            } else {
                $(`#skill-${skillId}`).prepend(`
                    <input type="hidden" name="technicalSkills[${skillId}][preferred_level]" value="${selectedLevel}">
                `);
            }

            // Update Level Button Label
            $(`#selectTechLevelButton${skillId}`).text(`Level ${selectedLevel}`);

            // (Optional) If you're storing the full data as JSON
            $('#technicalSkillsJson').val(JSON.stringify(technicalSkillsData));
        }
    </script>

    <script>
        $(document).ready(function() {
            var select4 = $('#perfomance_expectation');
            select4.select2({
                tags: true,
                createTag: function(params) {
                    if (params.term.trim() === "") {
                        return null; // Prevent blank tags
                    }
                    return {
                        id: params.term,
                        text: params.term,
                        newOption: true
                    };
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var select4 = $('#secondary_scope_of_study');
            select4.select2({
                tags: true,
                createTag: function(params) {
                    if (params.term.trim() === "") {
                        return null; // Prevent blank tags
                    }
                    return {
                        id: params.term,
                        text: params.term,
                        newOption: true
                    };
                }
            });
        });
    </script>

    <script>
        $('.existing_selects').hide();
        $('#riasec-block').hide();
        $('#riasec').prop('required', false);
        $('.existing_selects').prop('required', false);
        $('.existing_selects_sector').hide();
        $('.select-department').prop('required', false);
        $('.existing_dept').hide();
        $('#org_department_filter').prop('required', false);

        $('#toggle_select').on('change', function() {
            var selectedValue = $(this).val();

            if (selectedValue == '1') {
                $('#riasec-block').show();
                $('#riasec').prop('required', true);
                $('.existing_selects').hide();
                $('.existing_selects').prop('required', false);
                $('.existing_selects_sector').show();
                $('.select-department').prop('required', true);
                formReset();
                $('.existing_dept').hide();
                $('#org_department_filter').prop('required', false);
            } else if (selectedValue == '2') {
                $('.existing_dept').hide();
                $('#riasec-block').hide();
                $('#riasec').prop('required', false);
                $('#org_department_filter').prop('required', false);

                $('.existing_selects').show();
                $('.existing_selects').prop('required', true);
                $('.existing_selects_sector').show();
                $('.select-department').prop('required', true);

            } else if (selectedValue == '3') {
                formReset();
                $('.existing_selects_sector').hide();
                $('#riasec').prop('required', false);
                $('#riasec-block').hide();
                $('.select-department').prop('required', false);
                var options = '<option value="">Please Select Department First</option>';
                $('#job_desc').html(options);

                $('.existing_dept').show();
                $('#org_department_filter').prop('required', true);

                $('.existing_selects').show();
                $('.existing_selects').prop('required', true);
            } else {
                $('.existing_selects').hide();
                $('#riasec').prop('required', false);
                $('#riasec-block').hide();
                $('.existing_selects').prop('required', false);
                $('.existing_selects_sector').hide();
                $('.select-department').prop('required', false);
                $('.existing_dept').hide();
                $('#org_department_filter').prop('required', false);
                formReset();
            }
        });

        function formReset() {
            $('.select-department').prop('selectedIndex', 0);
            $('.select-job').prop('selectedIndex', 0);
            var options = '<option value="">Please Select Sector First</option>';
            $('#job_desc').html(options);
            $('.critical-function').remove();
            $('.technical-skill').remove();
            $('#job_role').val('');
            $('#job_role_desc').val('');
        }
    </script>

    <script>
        const technicalSkillsData = {};
        const genericSkillsData = {};
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const sector = urlParams.get('sector');
            const track = urlParams.get('track');
            const role = urlParams.get('role');
            // const ajaxResponse = JSON.parse(sessionStorage.getItem('ajaxResponse'));
            const ajaxResponse = @json($cachedData);
            // if (ajaxResponse) {
            //     console.log('Full AJAX Response:', ajaxResponse);
            //     console.log('Full AJAX Response data description:', ajaxResponse.description);

            //     populateForm(ajaxResponse);
            //     // Use the response as needed
            //     // document.querySelector('textarea[name="job_description"]').value = ajaxResponse.description || '';
            //     // You can also populate other fields from the response
            //     // Example:
            //     // document.querySelector('.some-other-field').innerText = ajaxResponse.data.someKey || '';
            // } else {
            //     console.warn('No AJAX response found in session storage.');
            // }




            // Add event listener for adding new critical work functions
            document.getElementById('add_new_function').addEventListener('click', function() {
                const newIndex = document.querySelectorAll(
                    '.critical-functions-container .critical-function').length;
                addNewCriticalFunction(newIndex);
            });

            // Event listener for adding new technical skills
            // document.getElementById('add_new_skill').addEventListener('click', function() {
            //     const newIndex = document.querySelectorAll('#skills-container .technical-skill').length;
            //     console.log('newIndex', newIndex);
            //     addTechnicalSkill(newIndex);
            // });

            $('#add_new_skill').click(function() {
                var newIndex = $('.technical-skill').length; // Calculate the new index
                // Assuming you have stored your skills data in some variable `technicalSkills` from an AJAX call

                addNewTechnicalSkill(newIndex,
                    technicalSkills); // You would need to make sure `technicalSkills` is up to date
            });

            // Event listener for adding new generic skills
            // document.getElementById('add_new_generic_skill')?.addEventListener('click', function() {
            //     const newIndex = document.querySelectorAll('#generic-skills-container .generic-skill')
            //         .length;
            //     addGenericSkill(newIndex);
            // });

            $('#add_new_generic_skill').on('click', function() {
                const newIndex = $('.generic-skill').length;
                addNewGenericSkill(newIndex);
            });
        });

        // function populateForm(data) {
        //     // Populate Sector, Track, Role
        //     // console.log('populate form',data.sub_sector_name);
        //     // document.getElementById('sector').value = data.job_sector || '';
        //     // document.getElementById('sector_form').value = data.job_sector || '';
        //     // document.getElementById('job_role').value = data.job_role || '';
        //     // document.getElementById('job_role_form').value = data.job_role || '';
        //     document.getElementById('riasec').value = data.top3riasec || '';
        //     document.getElementById('jd_title').textContent = data.title || '';
        //     document.getElementById('baseJD').textContent = data.description || '';
        //     document.getElementById('jd_job_profile').textContent = data.job_role_name || '';
        //     document.getElementById('additionalDetail').value = data.job_profile_description || '';
        //     document.getElementById('jd_job_profile_step').textContent = data.job_role_name || '';
        //     document.getElementById('jd_workday').textContent = data.job_profile_description || '';
        //     document.getElementById('currentJDText').textContent = data.description || '';
        //     // document.getElementById('jd_workday').textContent = document.getElementById('additionalDetail').value;


        //     // Job Role Description
        //     document.querySelector('textarea[name="description"]').value = data.description || '';

        //     // Populate Critical Work Functions
        //     const criticalFunctionsContainer = document.querySelector('.critical-functions-container');
        //     criticalFunctionsContainer.innerHTML = '';
        //     data.critical_functions.forEach((cwf, index) => {
        //         addCriticalFunction(index, cwf);
        //     });

        //     // Populate Technical Skills
        //     const skillsContainer = document.getElementById('skills-container');
        //     skillsContainer.innerHTML = '';
        //     data.technical_skills.forEach((skill, index) => {
        //         console.log('addTechnicalSkill', skill);
        //         addTechnicalSkill(index, skill);
        //     });

        //     // Populate Generic Skills
        //     const genericSkillsContainer = document.getElementById('generic-skills-container');
        //     genericSkillsContainer.innerHTML = '';
        //     data.soft_skills.forEach((skill, index) => {
        //         console.log('addGenericSkill', skill);
        //         addGenericSkill(index, skill);
        //     });
        // }

        function addTechnicalSkill(index, skill = null, allSkills = []) {
            if (!skill) return;

            const skillData = {
                c_id: skill?.c_id || null,
                skill_id: skill?.id || null,
                code: skill?.code || null,
                sector_id: skill?.sector_id || null,
                sector_name: skill?.sector_name || '',
                sub_sector_id: skill?.sub_sector_id || null,
                sub_sector_name: skill?.sub_sector_name || '',
                name: skill?.name || '',
                description: skill?.description || '',
                preferred_level: skill?.preferred_level || '',
                is_custom: skill?.is_custom ?? '',
                category_id: skill?.category_id ?? '',
                category_name: skill?.category_name ?? '',
            };

            const levelsFound = [];
            Object.keys(skill).forEach(key => {
                const match = key.match(/^level_(\d+)_description$/);
                if (match) {
                    const level = match[1];
                    levelsFound.push(level);

                    skillData[`level_${level}_description`] = skill[`level_${level}_description`];
                    skillData[`level_${level}_knowledge`] = Array.isArray(skill[`level_${level}_knowledge`]) ?
                        skill[`level_${level}_knowledge`] :
                        (skill[`level_${level}_knowledge`] || '').split(';');
                    skillData[`level_${level}_ability`] = Array.isArray(skill[`level_${level}_ability`]) ?
                        skill[`level_${level}_ability`] :
                        (skill[`level_${level}_ability`] || '').split(';');
                }
            });

            technicalSkillsData[index] = skillData;

            let hiddenInputs = '';
            Object.keys(skillData).forEach((key) => {
                if (Array.isArray(skillData[key])) {
                    (skillData[key] || []).forEach((value, i) => {
                        hiddenInputs +=
                            `<input type="hidden" name="technicalSkills[${index}][${key}][${i}]" value="${value}">`;
                    });
                } else {
                    hiddenInputs +=
                        `<input type="hidden" name="technicalSkills[${index}][${key}]" value="${skillData[key]}">`;
                }
            });

            const skillHtml = `
        <div class="technical-skill row mb-8" id="skill-${index}">
            ${hiddenInputs}
            <div class="d-flex align-items-center gap-3 w-100 flex-nowrap overflow-hidden">
 
                    <!-- Trash Button -->
                    <div class="flex-shrink-0">
                        <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center remove-skill">
                            <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
                        </button>
                    </div>
 
                    <!-- Edit Button -->
                    <div class="flex-shrink-0">
                        <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center edit-skill" data-index="${index}">
                            <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
                        </button>
                    </div>
 
                    <!-- Select box -->
                    <div class="flex-grow-1 overflow-hidden">
                        <select id="skill[${index}]"
                                name="technicalSkills[${index}][id]"
                                class="form-control select-skill text-truncate w-100"
                                data-index="${index}"
                                title="${skill?.name}(Master Skill - ${skill?.category_name})">
                            <option value="${skill?.id}" selected>
                                ${skill?.name}(Master Skill - ${skill?.category_name})
                            </option>
                        </select>
                    </div>
 
                    <!-- Hidden Input -->
                    <input type="hidden" id="technicalSkillsHidden[${index}]" name="technicalSkills[${index}][name]" value="${skill?.name || ''}">
 
                    <!-- Level Button -->
                    <div class="flex-shrink-0">
                        <button type="button"
                                id="selectTechLevelButton${index}"
                                class="btn-view edit-level-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#techskillmodal"
                                onclick="technicalpopulateModal(${index})">
                            Level ${skill?.preferred_level || ''}
                        </button>
                    </div>
 
                </div>
 
        </div>`;

            const container = document.getElementById('skills-container');
            container.insertAdjacentHTML('beforeend', skillHtml);

            const selectEl = $(`#skill\\[${index}\\]`);

            if (allSkills.length > 0) {
                selectEl.empty();
                allSkills.forEach(s => {
                    selectEl.append(new Option(s.name, s.id, s.id === skill.id, s.id === skill.id));
                });
            }

            // ✅ Use only once
            initSelect2(selectEl);

            selectEl.on('change', function() {
                const selectedId = $(this).val();
                const selectedText = $(this).find('option:selected').text();
                $(`#technicalSkillsHidden\\[${index}\\]`).val(selectedText);
                // TechSkillChanged(index, this); // optionally fetch extra details
                // Fetch updated skill details from server and update everything
                TechSkillChanged(index, selectedId);
            });

            container.querySelector(`#skill-${index} .remove-skill`)
                .addEventListener('click', function() {
                    delete technicalSkillsData[index];
                    this.closest('.technical-skill').remove();
                    toggleRemoveSkillButtons();
                });

            container.querySelector(`#skill-${index} .edit-skill`)
                .addEventListener('click', function() {
                    const skillIndex = this.getAttribute('data-index');
                    const skillData = technicalSkillsData[skillIndex];

                    
                    if (skillData.is_custom == 1 || skillData.is_custom == 2) {
                        const modalEl = document.getElementById('CompanyTechnicalSkill');
                        modalEl.setAttribute('data-skill-index', skillIndex);
                        modalEl.querySelector('#companySkillName').textContent = skillData.name || 'Skill';
                        new bootstrap.Modal(modalEl).show();
                    } else {
                        const editModalEl = document.getElementById('EditTsfromMSL');
                        editModalEl.setAttribute('data-skill-index', skillIndex);
                        new bootstrap.Modal(editModalEl).show();
                    }
                });

            toggleRemoveSkillButtons();
        }



        $(document).ready(function() {
            $('form').on('submit', function(e) {
                const skillCount = $('.technical-skill').length;

                if (skillCount === 0) {
                    e.preventDefault();
                    $('#techvalidationmessage').show();
                    $('html, body').animate({
                        scrollTop: $('#techvalidationmessage').offset().top - 100
                    }, 500);
                } else {
                    $('#techvalidationmessage').hide();
                }
            });
        });

        function initSelect2(selector) {
            const $el = typeof selector === 'string' ? $(selector) : selector;

            $el.select2({
                ajax: {
                    url: '{{ route('admin.technical-skill.search') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination.more
                            }
                        };
                    },
                    cache: true
                },
                templateResult: function(data) {
                    if (data.loading) return data.text;
                    const isNewSkill = data.text && data.text.includes('(New Skill)');
                    return $(
                        `<span>${data.text} ${isNewSkill ? '<span class="badge bg-warning text-dark ms-2">New</span>' : ''}</span>`
                        );
                },
                templateSelection: function(data) {
                    return data.text;
                },
                placeholder: 'Search for a skill',
                minimumInputLength: 1,
                width: 'resolve'
            });
        }

        function addNewTechnicalSkill(index, technicalSkills) {
    const technicalSkillsData = window.technicalSkillsData || (window.technicalSkillsData = {});
 
    // Create the skill select element
    var skillSelect = $('<select>', {
        id: `skill[${index}]`,
        name: `technicalSkills[${index}][id]`,
        class: 'form-control select-skill text-truncate w-100',
        'data-control': 'select2',
        'data-hide-search': 'false',
        'data-index': index,
        onchange: `TechSkillChanged('${index}', this.value)`,
        required: true
    });
 
    // Populate skill options
    $.each(technicalSkills, function(key, skill) {
        skillSelect.append($('<option>', {
            value: skill.id,
            text: skill.name,
            'data-name': skill.name,
            'data-level1': skill.level_1_description,
            'data-level2': skill.level_2_description,
            'data-level3': skill.level_3_description,
            'data-level4': skill.level_4_description,
            'data-level5': skill.level_5_description,
            'data-level6': skill.level_6_description
        }));
    });
 
    // Create level select (hidden by default)
    var levelSelect = $('<select>', {
        id: `level[${index}]`,
        name: `technicalSkills[${index}][level]`,
        class: 'form-control mb-3 mb-lg-0 d-none'
    });
 
    for (var level = 1; level <= 6; level++) {
        levelSelect.append($('<option>', {
            value: level,
            text: 'Level ' + level
        }));
    }
 
    // Create the entire skill row structure
    const skillRow = $(`
<div class="technical-skill row mb-8" id="skill-${index}">
<input type="hidden" id="technicalSkillsHidden[${index}]" name="technicalSkills[${index}][name]" value="">
<div class="d-flex align-items-center gap-3 w-100 flex-nowrap overflow-hidden">
 
                <!-- Trash Button -->
<div class="flex-shrink-0">
<button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center remove-skill">
<iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
</button>
</div>
 
                <!-- Edit Button -->
<div class="flex-shrink-0">
<button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center edit-skill" data-index="${index}">
<iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
</button>
</div>
 
                <!-- Select box container -->
<div class="flex-grow-1 overflow-hidden"></div>
 
                <!-- Level Button -->
<div class="flex-shrink-0">
<button type="button"
                            id="selectTechLevelButton${index}"
                            class="btn-view edit-level-btn"
                            data-bs-toggle="modal"
                            data-bs-target="#techskillmodal"
                            onclick="technicalpopulateModal(${index})">
                        Select Level
</button>
</div>
 
            </div>
</div>
    `);
 
    // Append select and level select
    skillRow.find('.flex-grow-1').append(skillSelect);
    skillRow.append(levelSelect);
 
    $('#skills-container').append(skillRow);
 
    // Initialize Select2
    $(skillSelect).select2({
        ajax: {
            url: '{{ route('admin.technical-skill.search') }}',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return { q: params.term };
            },
            processResults: function(data) {
                return {
                    results: data.results,
                    pagination: { more: data.pagination.more }
                };
            },
            cache: true
        },
        templateResult: function(data) {
            if (data.loading) return data.text;
            const isNewSkill = data.text.includes('(New Skill)');
            return $(
                `<span>${data.text} ${isNewSkill ? '<span class="badge bg-warning text-dark ms-2">New</span>' : ''}</span>`
            );
        },
        templateSelection: function(data) {
            return data.text;
        },
        placeholder: 'Search for a skill',
        minimumInputLength: 1,
        width: 'resolve'
    });
 
    // Handle skill select change
    skillSelect.on('change', function() {
        const selected = $(this).find('option:selected');
        const id = selected.val();
        const skillName = selected.data('name');
        const skillType = selected.text().includes('Company Skill') ? 2 : 0;
 
        // Update hidden input
        $(`#technicalSkillsHidden\\[${index}\\]`).val(skillName);
 
        // Store in global data
        technicalSkillsData[index] = {
            id: id,
            name: skillName,
            description: '',
            level_1_description: selected.data('level1'),
            level_2_description: selected.data('level2'),
            level_3_description: selected.data('level3'),
            level_4_description: selected.data('level4'),
            level_5_description: selected.data('level5'),
            level_6_description: selected.data('level6'),
            preferred_level: 1,
            sector_name: '',
            is_custom: skillType
        };
    });
 
    // Edit button logic
    skillRow.find('.edit-skill').on('click', function() {
        const skillIndex = $(this).data('index');
        let skillData = technicalSkillsData[skillIndex];
 
        // Build from DOM if needed
        if (!skillData) {
            const selectedOption = $(`#skill\\[${skillIndex}\\] option:selected`);
            if (!selectedOption.length) return alert("Please select a skill first.");
 
            skillData = {
                id: selectedOption.val(),
                name: selectedOption.data('name'),
                description: '',
                level_1_description: selectedOption.data('level1'),
                level_2_description: selectedOption.data('level2'),
                level_3_description: selectedOption.data('level3'),
                level_4_description: selectedOption.data('level4'),
                level_5_description: selectedOption.data('level5'),
                level_6_description: selectedOption.data('level6'),
                sector_name: '',
                preferred_level: 1,
                is_custom: selectedOption.text().includes('Company Skill') ? 2 : 0
            };
 
            technicalSkillsData[skillIndex] = skillData;
        }
 
        if (skillData.is_custom == 1 || skillData.is_custom == 2) {
            const modalEl = document.getElementById('CompanyTechnicalSkill');
            modalEl.setAttribute('data-skill-index', skillIndex);
            modalEl.querySelector('#companySkillName').textContent = skillData.name || 'Skill';
            const companyModal = new bootstrap.Modal(modalEl);
            companyModal.show();
        } else {
            const editModal = new bootstrap.Modal(document.getElementById('EditTsfromMSL'));
            document.getElementById('EditTsfromMSL').setAttribute('data-skill-index', skillIndex);
            editModal.show();
        }
    });
 
    // Remove button logic
    skillRow.find('.remove-skill').on('click', function() {
        $(this).closest('.technical-skill').remove();
        toggleRemoveSkillButtons();
    });
 
    toggleRemoveSkillButtons();
}



        function technicalpopulateModal(index) {
            currentTechSkillIndex = index;
            const data = technicalSkillsData[index];
            const modalBody = $('#techskillmodal .modalbody');
            modalBody.empty();

            $('#techskillmodal .modal-title').text(data.name);

            let selectedLevel = parseInt(data.preferred_level, 10); // Convert string to number

            for (let i = 1; i <= 6; i++) {
                const description = data[`level_${i}_description`] || '';
                const knowledge = data[`level_${i}_knowledge`] || '';
                const ability = data[`level_${i}_ability`] || '';

                const isSelected = selectedLevel === i;
                const isEmpty = !description && !knowledge && !ability;

                const checkedAttr = isSelected ? 'checked' : '';
                const disabledAttr = isEmpty ? 'disabled' : '';
                const activeCard = isSelected ? 'card-checked-orange' : '';
                const headerHighlight = isSelected ? 'header-checked-orange' : '';
                const labelDim = isEmpty ? 'disabled-label' : '';
                const onclickAttr = isEmpty ? '' : `onclick="updateSelectedLevel(${i})"`;

                if (isEmpty) {
                    const placeholder = `
                <div class="form-check col-lg-4 unique">
                    <div class="ts-edit-inner-box bg-grey">
                        <div class="header"></div>
                        <div class="inner-content justify-content-center">
                            <div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            `;
                    modalBody.append(placeholder);
                } else {
                    modalBody.append(`
                <div class="form-check col-lg-4">
                    <label class="form-check-label h-100 w-100 ${labelDim}" for="level_${i}">
                        <div class="col-lg-12 h-100">
                            <div class="card card-stretch card-bordered mb-5 h-100 ${activeCard}">
                                <div class="card-header align-items-center ${headerHighlight}">
                                    <h3 class="card-title">Level ${i}</h3>
                                    <iconify-icon icon="material-symbols:star" style="margin-left: 5px"></iconify-icon>
                                    <input class="form-check-input border-dark" type="radio" 
                                        value="${i}" id="level_${i}" name="level" ${checkedAttr} ${disabledAttr} ${onclickAttr}>
                                </div>
                                <div class="card-body">
                                    <h5 class="fs-6">${description}</h5>
                                    <div class="p-3">
                                        <h4 class="fs-6">Knowledge</h4>
                                        <div class="d-flex flex-column">
                                            ${createListFromString(knowledge)}
                                        </div>
                                    </div>
                                    <div class="p-3">
                                        <h4 class="fs-6">Ability</h4>
                                        <div class="d-flex flex-column">
                                            ${createListFromString(ability)}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
            `);
                }
            }

             // Save button initially disabled
    $('#techskillmodal .save-btn').prop('disabled', true);
    $('#techskillmodal .save-btn').data('skill-id', index);

    // Event listener for level selection
    $('#techskillmodal input[name="level"]').off('change').on('change', function () {
        const level = parseInt(this.value, 10);
        const skillData = technicalSkillsData[currentTechSkillIndex];

        const description = skillData[`level_${level}_description`] || '';
        const valid = description.trim() !== '';

        if (!valid) {
            alert('This level does not contain valid information and cannot be selected.');
            this.checked = false;
            $('#techskillmodal .save-btn').prop('disabled', true);
            return;
        }

        // Deselect all
        $('#techskillmodal input[name="level"]').each(function () {
            const card = $(this).closest('.card');
            card.removeClass('card-checked-orange');
            card.find('.card-header').removeClass('header-checked-orange');
        });

        // Select the chosen one
        const card = $(this).closest('.card');
        card.addClass('card-checked-orange');
        card.find('.card-header').addClass('header-checked-orange');

        // Update preferred level
        skillData.preferred_level = level;

        // Enable Save button
        $('#techskillmodal .save-btn').prop('disabled', false);
    });

    $('#techskillmodal').modal('show');
        }


        function technicalModal(index, data, skillTitle, selected_level) {
            console.log('technicalpoopupmodal', data);
            currentTechSkillIndex = index;

            data = JSON.parse(data);
            let modalBody = $('#techskillmodal .modalbody');
            modalBody.empty(); // Clear previous content

            $('#techskillmodal .modal-title').text(skillTitle);

            let selectedLevel = parseInt(selected_level, 10);

            for (let i = 1; i <= 6; i++) {
                let knowledge = data['level_' + i + '_knowledge'] || '';
                let ability = data['level_' + i + '_ability'] || '';
                let description = data['level_' + i + '_description'] || '';

                let selected = selectedLevel == i;
                let isChecked = selected ? 'checked' : '';

                // let isDisabled = description.trim() === '';
                let isDisabled = description === '' && knowledge.length === 0 && ability.length === 0;
                let disabledAttr = isDisabled ? 'disabled' : '';
                let cardDisabledClass = isDisabled ? 'disabled-card' : '';
                let onclickAttr = isDisabled ? '' : `onclick="updateSelectedLevel(${i})"`;

                let activeClass = selected ? 'card-checked-orange' : '';
                let headerClass = selected ? 'header-checked-orange' : '';
                let titleClass = selected ? 'card-title-orange' : '';

                modalBody.append(`
            <div class="form-check col-lg-4">
                <label class="form-check-label h-100 w-100 ${isDisabled ? 'disabled-label' : ''}" for="level_${i}">
                    <div class="col-lg-12 h-100">
                        <div class="card card-stretch card-bordered mb-5 h-100 ${activeClass} ${cardDisabledClass}">
                            <div class="card-header align-items-center ${headerClass}">
                                <h3 class="card-title ${titleClass}">Level ${i}</h3>
                                <iconify-icon icon="material-symbols:star-outline-rounded" width="24" height="24"></iconify-icon>
                                <input class="form-check-input border-dark d-none" type="radio" value="${i}" id="level_${i}" name="level" ${isChecked} ${disabledAttr} ${onclickAttr}>
                            </div>
                            <div class="card-body">
                                <h5>${description}</h5>
                                <div class="p-3">
                                    <h4>Knowledge</h4>
                                    <div class="d-flex flex-column">
                                        ${createListFromString(knowledge)}
                                    </div>
                                </div>
                                <div class="p-3">
                                    <h4>Ability</h4>
                                    <div class="d-flex flex-column">
                                        ${createListFromString(ability)}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </label>
            </div>
        `);
            }

             // Save button initially disabled
    $('#techskillmodal .save-btn').prop('disabled', true);
    $('#techskillmodal .save-btn').data('skill-id', index);

    // Event listener for level selection
    $('#techskillmodal input[name="level"]').off('change').on('change', function () {
        const level = parseInt(this.value, 10);
        const skillData = technicalSkillsData[currentTechSkillIndex];

        const description = skillData[`level_${level}_description`] || '';
        const valid = description.trim() !== '';

        if (!valid) {
            alert('This level does not contain valid information and cannot be selected.');
            this.checked = false;
            $('#techskillmodal .save-btn').prop('disabled', true);
            return;
        }

        // Deselect all
        $('#techskillmodal input[name="level"]').each(function () {
            const card = $(this).closest('.card');
            card.removeClass('card-checked-orange');
            card.find('.card-header').removeClass('header-checked-orange');
        });

        // Select the chosen one
        const card = $(this).closest('.card');
        card.addClass('card-checked-orange');
        card.find('.card-header').addClass('header-checked-orange');

        // Update preferred level
        skillData.preferred_level = level;

        // Enable Save button
        $('#techskillmodal .save-btn').prop('disabled', false);
    });

    $('#techskillmodal').modal('show');
        }

        // ✅ Function to dynamically change selected card styling
        function updateGenericLevel(level, index) {
            // Store the selected level in the hidden data object
            if (genericSkillsData[index]) {
                genericSkillsData[index].preferred_level = getLevelLabel(level);
            }

            // Optional: Visually mark the card or add any effects
            $('#genericSkillModal input[name="level"]').each(function() {
                const card = $(this).closest('.card');
                card.removeClass('card-checked-orange');
                card.find('.card-header').removeClass('header-checked-orange');
            });

            const selectedInput = $(`#level_${level}`);
            const selectedCard = selectedInput.closest('.card');
            selectedCard.addClass('card-checked-orange');
            selectedCard.find('.card-header').addClass('header-checked-orange');
        }

        // function updateSelectedLevel(level) {
        //     // First: Clear all selections visually
        //     $('#techskillmodal input[name="level"]').each(function() {
        //         const card = $(this).closest('.card');
        //         card.removeClass('card-checked-orange');
        //         card.find('.card-header').removeClass('header-checked-orange');
        //         $(this).prop('checked', false);
        //     });

        //     // Then: Apply visual selection to the chosen level
        //     const selectedInput = $(`#level_${level}`);
        //     selectedInput.prop('checked', true);
        //     const selectedCard = selectedInput.closest('.card');
        //     selectedCard.addClass('card-checked-orange');
        //     selectedCard.find('.card-header').addClass('header-checked-orange');

        //     // Optional: update the data object (you must define currentIndex somewhere)
        //     if (typeof technicalSkillsData !== 'undefined' && typeof currentTechSkillIndex !== 'undefined') {
        //         technicalSkillsData[currentTechSkillIndex].preferred_level = level;
        //     }
        // }

        function updateSelectedLevel(level) {
    if (typeof technicalSkillsData === 'undefined' || typeof currentTechSkillIndex === 'undefined') return;

    const skillData = technicalSkillsData[currentTechSkillIndex];
    const descKey = `level_${level}_description`;
    const description = skillData[descKey] ? skillData[descKey].trim() : '';

    // 🚫 Do not allow selection if no description
    if (!description) {
        console.warn(`Level ${level} has no description. Cannot select.`);
        return;
    }

    // ✅ Deselect all first
    $('#techskillmodal input[name="level"]').each(function () {
        const card = $(this).closest('.card');
        card.removeClass('card-checked-orange');
        card.find('.card-header').removeClass('header-checked-orange');
        $(this).prop('checked', false);
    });

    // ✅ Select this level
    const selectedInput = $(`#level_${level}`);
    selectedInput.prop('checked', true);

    const selectedCard = selectedInput.closest('.card');
    selectedCard.addClass('card-checked-orange');
    selectedCard.find('.card-header').addClass('header-checked-orange');

    skillData.preferred_level = level;
}


$('#techskillmodal .save-btn').off('click').on('click', function () {
    const selectedInput = $('#techskillmodal input[name="level"]:checked');
    if (!selectedInput.length) {
        alert('Please select a level before saving.');
        return;
    }

    const level = parseInt(selectedInput.val(), 10);
    const skillIndex = $(this).data('skill-id');
    const skillData = technicalSkillsData[skillIndex];

    const description = skillData[`level_${level}_description`] || '';
    if (!description.trim()) {
        alert(`Level ${level} is missing a valid description and cannot be saved.`);
        return;
    }

    // Store preferred level
    skillData.preferred_level = level;

    // Update UI label
    const button = document.getElementById(`selectTechLevelButton${skillIndex}`);
    if (button) {
        button.textContent = `Level ${level}`;
    }

    $('#techskillmodal').modal('hide');
});




        function getPreferredLevel(level) {
            switch (level?.toLowerCase()) {
                case 'basic':
                    return 1;
                case 'intermediate':
                    return 2;
                case 'advanced':
                    return 3;
                default:
                    return ''; // Return empty string if no match
            }
        }

        function getLevelLabel(level) {
            switch (parseInt(level)) {
                case 1:
                    return 'Basic';
                case 2:
                    return 'Intermediate';
                case 3:
                    return 'Advanced';
                default:
                    return '';
            }
        }


        function toggleRemoveSkillButtons() {
    const genericSkillElements = document.querySelectorAll('.generic-skill');
    const technicalSkillElements = document.querySelectorAll('.technical-skill');

    const genericButtons = document.querySelectorAll('.generic-skill .remove-skill');
    const techButtons = document.querySelectorAll('.technical-skill .remove-skill');

    const genericCount = genericSkillElements.length;
    const techCount = technicalSkillElements.length;

    // Toggle remove buttons for generic skills (minimum 3 must remain)
    genericButtons.forEach(btn => {
        btn.disabled = genericCount <= 3;
    });

    // Toggle remove buttons for technical skills (minimum 1 must remain)
    techButtons.forEach(btn => {
        btn.disabled = techCount <= 1;
    });

    // Toggle Add button
    const addBtn = $('#add_new_generic_skill');
    if (genericCount >= MAX_GENERIC_SKILLS) {
        addBtn.prop('disabled', true).attr('title', 'Maximum 5 generic skills allowed');
    } else {
        addBtn.prop('disabled', false).attr('title', '');
    }
}


        function isDuplicateSkillByName(selectedName, currentIndex) {
            return Object.entries(genericSkillsData).some(([index, skill]) => {
                return skill?.competency?.trim().toLowerCase() === selectedName?.trim().toLowerCase() &&
                    parseInt(index) !== currentIndex;
            });
        }

        function addGenericSkill(index, skill = null, allSkills = []) {
            if (!skill) return;

            const skillData = {
                job_id: skill?.job_id || null,
                id: skill?.id || null,
                competency: skill?.competency || '',
                description: skill?.description || '',
                preferred_level: skill?.preferred_level || '',
                level_1: skill?.level_1 || '',
                level_2: skill?.level_2 || '',
                level_3: skill?.level_3 || '',
                level_1_knowledge: skill?.level_1_knowledge || [],
                level_1_ability: skill?.level_1_ability || [],
                level_2_knowledge: skill?.level_2_knowledge || [],
                level_2_ability: skill?.level_2_ability || [],
                level_3_knowledge: skill?.level_3_knowledge || [],
                level_3_ability: skill?.level_3_ability || [],
            };

            genericSkillsData[index] = skillData;

            const generateHiddenInputs = (data) => {
                let hidden = '';
                Object.keys(data).forEach(key => {
                    if (Array.isArray(data[key])) {
                        data[key].forEach((value, i) => {
                            hidden +=
                                `<input type="hidden" name="genericSkills[${index}][${key}][${i}]" value="${value}">`;
                        });
                    } else {
                        hidden +=
                            `<input type="hidden" name="genericSkills[${index}][${key}]" value="${data[key]}">`;
                    }
                });
                return hidden;
            };

            const skillHtml = `
        <div class="generic-skill row mb-8" id="generic-skill-${index}">
            ${generateHiddenInputs(skillData)}
            <div class="d-flex align-items-center gap-3 w-100 flex-nowrap overflow-hidden">
 
    <!-- Trash Button -->
    <div class="flex-shrink-0">
        <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center align-items-center remove-skill">
            <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
        </button>
    </div>
 
    <!-- Select Box -->
    <div class="flex-grow-1 overflow-hidden">
        <select id="genericSkill[${index}]"
                name="genericSkills[${index}][id]"
                class="form-control select-generic-skill text-truncate w-100 select2-generic-skill"
                data-index="${index}"
                title="${skillData.competency}">
            <option value="${skillData.id}" selected>
                ${skillData.competency}
            </option>
        </select>
    </div>
 
    <!-- Hidden Input -->
    <input type="hidden" id="genericSkillsHidden[${index}]" name="genericSkills[${index}][competency]" value="${skillData.competency || ''}">
 
    <!-- Level Button -->
    <div class="flex-shrink-0">
        <button type="button"
                id="selectGenericLevelButton${index}"
                class="btn-view edit-level-btn"
                data-bs-toggle="modal"
                data-bs-target="#genericSkillModal"
                onclick="genericPopulateModal(${index})">
            ${skillData.preferred_level || ''}
        </button>
    </div>
 
</div>
        </div>`;

            const container = document.getElementById('generic-skills-container');
            container.insertAdjacentHTML('beforeend', skillHtml);

            const selectElGeneric = $(`#genericSkill\\[${index}\\]`);
            selectElGeneric.select2({
                placeholder: 'Search Generic Skill...',
                ajax: {
                    url: '/admin/master-skills/search',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(skill => ({
                                id: skill.id,
                                text: skill.name
                            }))
                        };
                    },
                    cache: true
                }
            });

            selectElGeneric.on('change', function() {
                const selectedId = $(this).val();
                const selectedText = $(this).find('option:selected').text();

                if (isDuplicateSkillByName(selectedText, index)) {
                    alert('This generic skill is already selected.');
                    $(this).val(null).trigger('change');
                    $(`#genericSkillsHidden\\[${index}\\]`).val('');
                    $(`#selectGenericLevelButton${index}`).prop('disabled', true).text('Select a level');
                    return;
                }

                $(`#genericSkillsHidden\\[${index}\\]`).val(selectedText);

                $.ajax({
                    url: `/admin/master-skills/${selectedId}`,
                    type: 'GET',
                    success: function(skill) {
                        const updatedSkill = {
                            job_id: skill.job_id || null,
                            id: skill.id,
                            competency: skill.name,
                            description: skill.description || '',
                            preferred_level: '',
                            level_1: skill.level_1 || '',
                            level_2: skill.level_2 || '',
                            level_3: skill.level_3 || '',
                            level_1_knowledge: (skill.level_1_knowledge || '').split(';'),
                            level_1_ability: (skill.level_1_ability || '').split(';'),
                            level_2_knowledge: (skill.level_2_knowledge || '').split(';'),
                            level_2_ability: (skill.level_2_ability || '').split(';'),
                            level_3_knowledge: (skill.level_3_knowledge || '').split(';'),
                            level_3_ability: (skill.level_3_ability || '').split(';')
                        };

                        genericSkillsData[index] = updatedSkill;

                        // Remove old hidden inputs and add new
                        const skillContainer = $(`#generic-skill-${index}`);
                        skillContainer.find(`input[name^="genericSkills[${index}]"]`).remove();
                        skillContainer.prepend(generateHiddenInputs(updatedSkill));

                        // Update level button text
                        $(`#selectGenericLevelButton${index}`).text(
                            `Level ${updatedSkill.preferred_level || ''}`);
                    },
                    error: function(err) {
                        console.error("Failed to fetch skill data", err);
                    }
                });
            });

            container.querySelector(`#generic-skill-${index} .remove-skill`)
                .addEventListener('click', function() {
                    delete genericSkillsData[index];
                    this.closest('.generic-skill').remove();
                    toggleRemoveSkillButtons();
                });

            toggleRemoveSkillButtons();
        }



        $(document).ready(function() {
            $('form').on('submit', function(e) {
                const genericSkillCount = $('.generic-skill').length;

                if (genericSkillCount === 0) {
                    e.preventDefault();
                    $('#genericValidationMessage').show();
                    $('html, body').animate({
                        scrollTop: $('#genericValidationMessage').offset().top - 100
                    }, 500);
                } else {
                    $('#genericValidationMessage').hide();
                }
            });
        });


        function addNewGenericSkill() {
    // Reuse empty/null slots or get new index
    let newIndex = Object.keys(genericSkillsData).length;
    for (let i = 0; i < MAX_GENERIC_SKILLS; i++) {
        if (!genericSkillsData[i]) {
            newIndex = i;
            break;
        }
    }

    const currentCount = $('.generic-skill').length;
    if (currentCount >= MAX_GENERIC_SKILLS) {
        alert(`You can only add up to ${MAX_GENERIC_SKILLS} generic skills.`);
        return;
    }

    const skillData = {
        job_id: null,
        id: '',
        competency: '',
        description: '',
        preferred_level: '',
        level_1: '',
        level_2: '',
        level_3: '',
        level_1_knowledge: [],
        level_1_ability: [],
        level_2_knowledge: [],
        level_2_ability: [],
        level_3_knowledge: [],
        level_3_ability: []
    };

    genericSkillsData[newIndex] = skillData;

    const skillHtml = `
        <div class="generic-skill row mb-8" id="generic-skill-${newIndex}">
            <div class="d-flex align-items-center gap-3 w-100 flex-nowrap overflow-hidden">
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center align-items-center remove-skill">
                        <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
                    </button>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <select id="genericSkill[${newIndex}]"
                            name="genericSkills[${newIndex}][id]"
                            class="form-control select-generic-skill select2-generic-skill text-truncate w-100"
                            data-index="${newIndex}"
                            title="Select Generic Skill">
                        <option value="">Select Generic Skills</option>
                    </select>
                </div>
                <input type="hidden" id="genericSkillsHidden[${newIndex}]"
                       name="genericSkills[${newIndex}][competency]" value="">
                <div class="flex-shrink-0">
                    <button type="button"
                            id="selectGenericLevelButton${newIndex}"
                            class="btn-view edit-level-btn"
                            disabled
                            data-bs-toggle="modal"
                            data-bs-target="#genericSkillModal"
                            onclick="genericPopulateModal(${newIndex})">
                        Select a level
                    </button>
                </div>
            </div>
        </div>`;

    $('#generic-skills-container').append(skillHtml);

    $(`#genericSkill\\[${newIndex}\\]`).select2({
        placeholder: 'Search Generic Skill...',
        ajax: {
            url: '/admin/master-skills/search',
            dataType: 'json',
            delay: 250,
            data: params => ({ q: params.term }),
            processResults: data => ({
                results: data.map(skill => ({
                    id: skill.id,
                    text: skill.name
                }))
            }),
            cache: true
        }
    });

    $(`#genericSkill\\[${newIndex}\\]`).on('change', function () {
        const selectedId = $(this).val();
        const selectedText = $(this).find('option:selected').text();

        if (isDuplicateSkillByName(selectedText, newIndex)) {
            alert('This generic skill is already selected.');
            $(this).val(null).trigger('change');
            $(`#genericSkillsHidden\\[${newIndex}\\]`).val('');
            $(`#selectGenericLevelButton${newIndex}`).prop('disabled', true).text('Select a level');
            return;
        }

        $(`#genericSkillsHidden\\[${newIndex}\\]`).val(selectedText);

        $.ajax({
            url: `/admin/master-skills/${selectedId}`,
            type: 'GET',
            success: function (skill) {
                const updatedSkill = {
                    job_id: skill.job_id || null,
                    id: skill.id,
                    competency: skill.name,
                    description: skill.description || '',
                    preferred_level: '',
                    level_1: skill.level_1 || '',
                    level_2: skill.level_2 || '',
                    level_3: skill.level_3 || '',
                    level_1_knowledge: (skill.level_1_knowledge || '').split(';'),
                    level_1_ability: (skill.level_1_ability || '').split(';'),
                    level_2_knowledge: (skill.level_2_knowledge || '').split(';'),
                    level_2_ability: (skill.level_2_ability || '').split(';'),
                    level_3_knowledge: (skill.level_3_knowledge || '').split(';'),
                    level_3_ability: (skill.level_3_ability || '').split(';')
                };

                genericSkillsData[newIndex] = updatedSkill;

                const container = $(`#generic-skill-${newIndex}`);
                container.find(`input[name^="genericSkills[${newIndex}]"]`).remove();
                container.prepend(generateGenericHiddenInputs(newIndex, updatedSkill));

                // Enable and update the level button
                $(`#selectGenericLevelButton${newIndex}`)
                    .prop('disabled', false)
                    .text('Select a level');
            },
            error: function () {
                console.error("Skill fetch failed.");
            }
        });
    });

    $(`#generic-skill-${newIndex} .remove-skill`).on('click', function () {
        genericSkillsData[newIndex] = null;
        $(this).closest('.generic-skill').remove();
        toggleRemoveSkillButtons();
    });

    toggleRemoveSkillButtons();
}


        // Helper to generate hidden inputs
        function generateGenericHiddenInputs(index, data) {
            let hidden = '';
            Object.keys(data).forEach(key => {
                if (Array.isArray(data[key])) {
                    data[key].forEach((value, i) => {
                        hidden +=
                            `<input type="hidden" name="genericSkills[${index}][${key}][${i}]" value="${value}">`;
                    });
                } else {
                    hidden += `<input type="hidden" name="genericSkills[${index}][${key}]" value="${data[key]}">`;
                }
            });
            return hidden;
        }


        function genericPopulateModal(index) {
    const data = genericSkillsData[index];

    if (!data || !data.competency) {
        alert('Skill data missing or not selected.');
        return;
    }

    const preferredLevel = getPreferredLevel(data?.preferred_level);
    const modalBody = $('#genericSkillModal .modalbody');
    modalBody.empty();
    $('#genericSkillModal .modal-title').text(data.competency || 'Generic Skill');

    for (let i = 1; i <= 3; i++) {
        const description = data[`level_${i}`] || '';
        const knowledge = data[`level_${i}_knowledge`] || [];
        const ability = data[`level_${i}_ability`] || [];
        const isSelected = preferredLevel === i;
        const isEmpty = (knowledge.length === 0 && ability.length === 0);
        const checkedAttr = isSelected ? 'checked' : '';
        const disabledAttr = isEmpty ? 'disabled' : '';
        const activeCard = isSelected ? 'card-checked-orange' : '';
        const headerHighlight = isSelected ? 'header-checked-orange' : '';
        const labelDim = isEmpty ? 'disabled-label' : '';
        const onclickAttr = isEmpty ? '' : `onclick="updateGenericLevel(${i}, ${index})"`;

        modalBody.append(`
            <div class="form-check col-lg-4">
                <label class="form-check-label h-100 w-100 ${labelDim}" for="level_${i}">
                    <div class="col-lg-12 h-100">
                        <div class="card card-stretch card-bordered mb-5 h-100 ${activeCard}">
                            <div class="card-header align-items-center ${headerHighlight}">
                                <h3 class="card-title">${getLevelLabel(i)}</h3>
                                <input class="form-check-input border-dark" type="radio" 
                                    value="${i}" id="level_${i}" name="level" ${checkedAttr} ${disabledAttr} ${onclickAttr}>
                            </div>
                            <div class="card-body">
                                <h5 class="fs-6">${description || 'No Description'}</h5>
                                <div class="p-3">
                                    <h4 class="fs-6">Knowledge</h4>
                                    <div class="d-flex flex-column">
                                        ${createListFromString(knowledge)}
                                    </div>
                                </div>
                                <div class="p-3">
                                    <h4 class="fs-6">Ability</h4>
                                    <div class="d-flex flex-column">
                                        ${createListFromString(ability)}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </label>
            </div>
        `);
    }

    $('#genericSkillModal .save-btn').data('skill-id', index);
}


    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enable the proceed button when an option is selected
            document.querySelectorAll('input[name="jdOption"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    document.getElementById('proceedCompanySkillBtn').disabled = false;
                });
            });

            // Reset modal on close
            document.getElementById('CompanyTechnicalSkill').addEventListener('hidden.bs.modal', function() {
                document.querySelectorAll('input[name="jdOption"]').forEach(r => r.checked = false);
                document.getElementById('proceedCompanySkillBtn').disabled = true;
            });

            // Proceed button click logic
            document.getElementById('proceedCompanySkillBtn').addEventListener('click', function() {
                const selectedOption = document.querySelector('input[name="jdOption"]:checked')?.value;
                const modal = bootstrap.Modal.getInstance(document.getElementById('CompanyTechnicalSkill'));
                modal.hide();

                const skillIndex = document.getElementById('CompanyTechnicalSkill').getAttribute(
                    'data-skill-index');
                const skillData = technicalSkillsData[skillIndex];
                console.log('skillData', skillData);


                if (selectedOption === 'custom') {
                    const newSkillData = JSON.parse(JSON.stringify(skillData));
                    newSkillData.is_custom = 2;
                    technicalSkillsData[skillIndex] = newSkillData;

                    renderInlineSkillEdit(skillIndex); // <-- ✅ Call this directly
                    return; // Prevent fallback to any other logic
                }

                if (selectedOption === 'master') {
                    const newSkillData = JSON.parse(JSON.stringify(skillData));
                    newSkillData.is_custom = 2;
                    technicalSkillsData[skillIndex] = newSkillData;

                    triggerOverwriteConfirmAfterSave = true;

                    // ✅ This is where you trigger it for master selection
                    renderInlineSkillEdit(skillIndex);
                    return;
                }

                document.getElementById('overwriteCompanySkillName').textContent = skillData?.name || 'N/A';

                // ✅ Trigger overwrite confirmation modal
                const editModal = new bootstrap.Modal(document.getElementById(
                    'OverwriteCompanySkillConfirmModal'));
                document.getElementById('OverwriteCompanySkillConfirmModal').setAttribute(
                    'data-skill-index', skillIndex);
                editModal.show();
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const proceedBtn = document.getElementById('proceedCompanySkillBtn');

            proceedBtn.addEventListener('click', function() {
                const selectedOption = document.querySelector('input[name="jdOption"]:checked');
                const skillIndex = parseInt(document.getElementById('CompanyTechnicalSkill').getAttribute(
                    'data-skill-index'));

                if (!selectedOption || isNaN(skillIndex)) return;

                const skillData = technicalSkillsData[skillIndex];
                const modal = bootstrap.Modal.getInstance(document.getElementById('CompanyTechnicalSkill'));
                modal?.hide();

                // 👇 Force overwrite option to trigger inline edit
                if (selectedOption.value === 'master') {
                    skillData.is_custom = 2; // Mark as a company-defined custom skill
                    technicalSkillsData[skillIndex] = skillData;

                    renderInlineSkillEdit(skillIndex, 'Company Skill');
                    return;
                }

                // Fallback if needed (for 'custom' or future options)
                if (selectedOption.value === 'custom') {
                    skillData.is_custom = 2;
                    technicalSkillsData[skillIndex] = skillData;

                    renderInlineSkillEdit(skillIndex, 'Company Skill');
                    return;
                }
            });
        });
    </script>





    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            // Convert formData to JSON
            const data = {};
            formData.forEach((value, key) => {
                if (key.includes('[]')) {
                    const baseKey = key.replace('[]', '');
                    if (!data[baseKey]) data[baseKey] = [];
                    data[baseKey].push(value);
                } else {
                    data[key] = value;
                }
            });

            // Submit via API
            fetch('/api/save-job-description', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data),
                })
                .then((response) => response.json())
                .then((result) => {
                    alert('Job description saved successfully!');
                    window.location.href = '/admin/job-descriptions';
                })
                .catch((error) => console.error('Error saving job description:', error));
        });
    </script>


    <script>
        const positionCodes = {
            1: 'STAFF 1, R&F DAILY',
            2: 'STAFF 2, R&F MONTHLY',
            3: 'STAFF 3',
            4: 'SUPV',
            5: 'GRP SUPV',
            6: 'MGR',
            7: 'SR MGR, PROJ MGR',
            8: 'GRP MGR',
            9: 'AVP',
            10: 'VP',
            11: 'SVP',
            12: 'EVP',
            13: 'PRES'
        };

        // Function to update the position code based on selected level
        function updatePositionCode() {
            const levelJob = document.getElementById('level-job');
            const positionCodeInput = document.getElementById('position_code');
            const selectedLevel = levelJob.value;

            // Update the position code input field based on selected level
            positionCodeInput.value = positionCodes[selectedLevel] || '';
        }

        // Set position code when the page loads based on the current level
        window.onload = function() {
            const selectedLevel = {{ $cachedData['level'] ?? 'null' }};
            if (selectedLevel) {
                const positionCodeInput = document.getElementById('position_code');
                const positionCode = positionCodes[selectedLevel] || '';
                if (positionCodeInput) {
                    positionCodeInput?.value = positionCode;
                }
            }
        };
    </script>


    <script>
        $(document).ready(function() {
            // Show modal when #generate-riasec is clicked
            //   $('#generate-riasec').on('click', function () {
            //     const jobRole = $('#job_profile').val().trim();

            //     if (!jobRole) {
            //       alert('Please enter a job role.');
            //       return;
            //     }

            //     // Enable the proceed button
            //     $('#proceedBtn').prop('disabled', false);

            //     // Show modal
            //     const modal = new bootstrap.Modal(document.getElementById('generateRIASECJR'));
            //     modal.show();
            //   });


            let riasecRequest = null;

            $('#generate-riasec').on('click', function() {
                showOverlay(); // Show loading overlay
                const jobRole = $('#job_profile').val().trim();

                if (!jobRole) {
                    alert('Please enter a job role.');
                    return;
                }

                // Abort previous request if it's still ongoing
                if (riasecRequest && riasecRequest.readyState !== XMLHttpRequest.DONE) {
                    riasecRequest.abort();
                }

                riasecRequest = $.ajax({
                    url: "{{ route('get.riasec.data') }}",
                    method: 'GET',
                    data: {
                        job_role: "{{ $cachedData['title'] ?? ($cachedData['job_role_name'] ?? '') }}",
                        top3riasec: "{{ $cachedData['top3riasec'] ?? '' }}",
                        job_role_name: "{{ $cachedData['job_role_name'] ?? '' }}"
                    },
                    success: function(data) {
                        hideOverlay(); // Hide loading overlay
                        let html = '';
                        $.each(data, function(index, item) {
                            html += `
                    <label class="manually-radio">
                        <input type="radio" name="jdOptionRiasec" value="${item.code}" id="jdOption${index}">
                        <div class="d-flex flex-column gap-3 manually-modal-inner h-100">
                            <p class="m-0 text-left fw-bolder fs-2 d-flex justify-content-between gap-5 align-items-center">
                                ${item.title}
                                <span class="jd-badge text-center ${item.badge_class}">${item.badge}</span>
                            </p>
                            <div class="line"></div>
                            <div class="modal-content-riasec d-flex flex-column">
                                <p class="m-0 heading">${item.code}</p>
                                ${
                                    item.details.map(detail => `
                                            <div class="d-flex flex-column">
                                                <p class="m-0 sub-heading">${detail.sub_heading}</p>
                                                <p class="m-0 para">${detail.para}</p>
                                            </div>
                                        `).join('')
                                }
                            </div>
                        </div>
                    </label>
                    `;
                        });
                        $('#dynamic-riasec-options').html(html);
                        $('#proceedBtn').prop('disabled', false);

                        const modal = new bootstrap.Modal(document.getElementById(
                            'generateRIASECJR'));
                        modal.show();
                    },
                    error: function(jqXHR, textStatus) {
                        if (textStatus !== 'abort') {
                            alert('Could not fetch RIASEC data');
                        }
                    }
                });
            });


            // On proceedBtn click -> run the AJAX and logic
            $('#proceedBtn').on('click', function() {
                const jobRole = $('#job_profile').val().trim();

                const selectedOption = document.querySelector('input[name="jdOptionRiasec"]:checked');
                if (selectedOption === null) {
                    toastr.error('Please select a RIASEC option.');
                    return;
                }
                console.log('selectedOption:', selectedOption.value);


                const modalElement = document.getElementById('generateRIASECJR');
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                modalInstance.hide();

                if (!jobRole) {
                    alert('Please enter a job role.');
                    return;
                }

                // Show loading if needed
                console.log("Generating RIASEC for:", jobRole);
                showOverlay();

                $('#riasec').val([]).trigger('change');

                var reversedSelectedOption = selectedOption.value.split('');
                // Convert response (e.g. "RIA") into array
                const riasecArray = reversedSelectedOption;
                console.log("riasecArray", riasecArray);


                console.log('riasecArray:', riasecArray);

                // Select the appropriate options
                riasecArray.forEach(function(code) {
                    $('#riasec option').each(function() {
                        if ($(this).val() === code) {
                            $(this).prop('selected', true);
                            reorderOptions();

                            //   $('#riasec').trigger('change');
                        }
                    });
                });


                const $riasec = $('#riasec');


                let selectedOrder = $riasec.val() ? [...$riasec.val()] : [];

                // When user selects an option
                $riasec.on('select2:select', function(e) {
                    const id = e.params.data.id;
                    if (!selectedOrder.includes(id)) {
                        selectedOrder.push(id);
                    }
                    reorderOptions();
                });

                // When user unselects an option
                $riasec.on('select2:unselect', function(e) {
                    const id = e.params.data.id;
                    selectedOrder = selectedOrder.filter(val => val !== id);
                    reorderOptions();
                });


                function reorderOptions() {
                    const $riasec = $('#riasec');

                    let selectedOrder = $riasec.val() ? [...$riasec.val()] : [];

                    // Detach all selected <option>s and re-append in order
                    const selectedOptions = selectedOrder.map(val =>
                        $riasec.find('option[value="' + val + '"]').detach()
                    );
                    $riasec.append(selectedOptions).trigger('change.select2');
                }


                $('#riasec').trigger('change');
                hideOverlay();


            });

            // Limit to max 3 options
            $('#riasec').on('change', function() {
                if ($(this).val().length > 3) {
                    alert('You can only select a maximum of 3 options.');
                    let selectedValues = $(this).val();
                    selectedValues.pop();
                    $(this).val(selectedValues).trigger('change');
                }
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const continueEditBtn = document.getElementById('continueEditSkillBtn');

            continueEditBtn.addEventListener('click', function() {
                const skillIndex = parseInt(document.getElementById('EditTsfromMSL').getAttribute(
                    'data-skill-index'));
                const skillData = technicalSkillsData[skillIndex];
                const skillRow = document.getElementById(`skill-${skillIndex}`);

                if (!skillRow || !skillData) return;

                const originalSkillData = JSON.parse(JSON.stringify(skillData));

                const originalHTML = skillRow.innerHTML;
                console.log('skillData:', skillData);

                skillRow.innerHTML = `
                <div class="d-flex justify-content-between align-items-start pl-0">
                    <div class="d-flex align-items-start gap-3 col pl-3">
                        <div class="d-flex gap-2">
                            <button class="right-orange-btn accept-btn">
                                <iconify-icon icon="ic:round-check" width="18" height="18"></iconify-icon>
                            </button>
                            <button class="cross-grey-btn cancel-btn">
                                <iconify-icon icon="ic:round-close" width="18" height="18"></iconify-icon>
                            </button>
                        </div>
                        <div class="w-100">
                            <div class="d-flex align-items-center gap-4 mb-2 position-relative form-control">
                                <div class="d-flex align-items-center gap-2 w-100">
                                <input type="text" class="form-control p-0 border-0 h-auto" name="technicalSkills[${skillIndex}][name]"
                                    value="${skillData.name}"
                                    data-original="${skillData.name}">
                                                                    ${skillData.is_custom == 2
                                ? `<span class="badge border text-muted px-2" style="background-color: #E3F7FF; color: #125A78;">Company Skill</span>`
                                : `<span class="badge border text-muted px-2" style="background-color: #E3F7FF; color: #125A78;">Master Skill Library</span>`
                                }
                                <span class="badge border text-muted px-2" style="background-color: #F1F1F4; color: #4B5675;">
                                    ${skillData.sector_name || 'N/A'}
                                </span>
                                </div>
                                <button class="reset-btn" type="button">
                                    <iconify-icon icon="grommet-icons:power-reset" width="16" height="16"></iconify-icon>
                                </button>
                            </div>
                            <div class="position-relative">
                                <textarea class="form-control pr-5" rows="2" name="technicalSkills[${skillIndex}][description]"
                                    data-original="${skillData.description || 'N/A'}">${skillData.description || 'N/A'}</textarea>
                                <button class="reset-btn position-absolute top-0 end-0 mt-4 me-3" type="button">
                                    <iconify-icon icon="grommet-icons:power-reset" width="16" height="16"></iconify-icon>
                                </button>
                            </div>
                        </div>
                    </div>
                        <button type="button" class="edit-level-btn"
                            data-bs-toggle="modal" data-bs-target="#tsEditLevel"
                            onclick="openTSEditLevelModal(${skillIndex})">
                            Edit Level
                            <iconify-icon icon="lucide:edit" width="16" height="16"></iconify-icon>
                        </button>
                </div>
            `;

                // Cancel
                skillRow.querySelector('.cancel-btn').addEventListener('click', function() {
                    const skill = originalSkillData;

                    // Revert full skill data
                    technicalSkillsData[skillIndex] = skill;

                    skillRow.outerHTML = `
        <div class="technical-skill row mb-8" id="skill-${skillIndex}">
            <input type="hidden" name="technicalSkills[${skillIndex}][description]" value="${skill.description}">
            <input type="hidden" name="technicalSkills[${skillIndex}][sector_name]" value="${skill.sector_name || ''}">
            <input type="hidden" name="technicalSkills[${skillIndex}][preferred_level]" value="${skill.preferred_level || 1}">

            <div class="d-flex align-items-center gap-3 w-100 flex-nowrap overflow-hidden">
                <!-- Trash Button -->
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center remove-skill">
                        <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
                    </button>
                </div>

                <!-- Select Dropdown -->
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center edit-skill" data-index="${skillIndex}">
                        <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
                    </button>
                </div>

                <!-- Select box -->
                <div class="flex-grow-1 overflow-hidden">
                    <select id="skill[${skillIndex}]" name="technicalSkills[${skillIndex}][id]" 
                        class="form-control select-skill select2-skill text-truncate w-100" data-index="${skillIndex}">
                        <option value="${skill.skill_id}" selected>${skill.name}(Master Skill - ${skill?.category_name || ''})</option>
                    </select>
                </div>

                    <input type="hidden" id="technicalSkillsHidden[${skillIndex}]" 
                        name="technicalSkills[${skillIndex}][name]" value="${skill.name}">


                <div class="flex-shrink-0">
                    <button type="button" id="selectTechLevelButton${skillIndex}" class="btn-view edit-level-btn" 
                        data-bs-toggle="modal" data-bs-target="#techskillmodal" 
                        onclick="technicalpopulateModal(${skillIndex})">
                        Level ${skill?.preferred_level || ''}
                    </button>
                </div>
            </div>
        </div>

    `;

                    // Re-initialize Select2
                    setTimeout(() => {
                        const newSkillRow = document.getElementById(`skill-${skillIndex}`);

                        // Re-bind Remove Button
                        newSkillRow.querySelector('.remove-skill')?.addEventListener('click', function () {
                            delete technicalSkillsData[skillIndex];
                            this.closest('.technical-skill').remove();
                            toggleRemoveSkillButtons(); // make sure this function exists
                        });

                        // Re-bind Edit Button
                        newSkillRow.querySelector('.edit-skill')?.addEventListener('click', function () {
                            const skillData = technicalSkillsData[skillIndex];

                            
                            if (skillData.is_custom == 1 || skillData.is_custom == 2) {
                                const modalEl = document.getElementById('CompanyTechnicalSkill');
                                modalEl.setAttribute('data-skill-index', skillIndex);
                                modalEl.querySelector('#companySkillName').textContent = skillData.name || 'Skill';
                                new bootstrap.Modal(modalEl).show();
                            } else {
                                const editModalEl = document.getElementById('EditTsfromMSL');
                                editModalEl.setAttribute('data-skill-index', skillIndex);
                                new bootstrap.Modal(editModalEl).show();
                            }
                        });

                        const selectEl = $(`#skill\\[${skillIndex}\\]`);
                        initSelect2(selectEl);

                        selectEl.select2({
                            placeholder: 'Search for a skill',
                            width: 'resolve'
                        });

                        selectEl.on('change', function() {
                            const selectedText = $(this).find('option:selected')
                                .text();
                            $(`#technicalSkillsHidden\\[${skillIndex}\\]`).val(
                                selectedText);
                        });
                    }, 10);
                });


                // Reset
                skillRow.querySelectorAll('.reset-btn').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const input = btn.parentElement.querySelector('input, textarea');
                        if (input && input.dataset.original !== undefined) {
                            input.value = input.dataset.original;
                        }
                    });
                });


                // Accept: save changes and re-render as read-only
                skillRow.querySelector('.accept-btn').addEventListener('click', function() {
                    const nameInput = skillRow.querySelector(
                        `input[name="technicalSkills[${skillIndex}][name]"]`);
                    const descTextarea = skillRow.querySelector(
                        `textarea[name="technicalSkills[${skillIndex}][description]"]`);
                    const originalName = nameInput.dataset.original.trim();
                    const newName = nameInput.value.trim();
                    const isRenamed = originalName !== newName;

                    // Update technicalSkillsData
                    const skill = technicalSkillsData[skillIndex];
                    skill.name = newName;
                    skill.description = descTextarea.value.trim();

                    // Sync JSON
                    document.getElementById('technicalSkillsJson').value = JSON.stringify(
                        technicalSkillsData);

                    // Re-render with select + hidden input
                    skillRow.outerHTML = `
                    <div class="technical-skill row mb-8" id="skill-${skillIndex}">
                        <input type="hidden" name="technicalSkills[${skillIndex}][description]" value="${skill.description}">
                        <input type="hidden" name="technicalSkills[${skillIndex}][sector_name]" value="${skill.sector_name || ''}">
                        <input type="hidden" name="technicalSkills[${skillIndex}][preferred_level]" value="${skill.preferred_level || 1}">

                        <div class="d-flex align-items-center gap-3 w-100 flex-nowrap overflow-hidden">
                            <!-- Trash Button -->
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-outline btn-outline-primary d-flex  align-items-center justify-content-center remove-skill">
                                    <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
                                </button>
                            </div>

                            <!-- Select Dropdown -->
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-outline btn-outline-primary d-flex  align-items-center justify-content-center edit-skill" data-index="${skillIndex}">
                                    <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
                                </button>
                            </div>

                            <!-- Select box -->
                            <div class="flex-grow-1 overflow-hidden">
                                <select id="skill[${skillIndex}]" name="technicalSkills[${skillIndex}][id]" 
                                    class="form-control select-skill select2-skill text-truncate w-100" data-index="${skillIndex}">
                                    <option value="${skill.skill_id}" selected>${skill.name}${isRenamed ? ' (New Skill)' : ` (Master Skill - ${skill.category_name || ''})`}</option>
                                </select>
                            </div>
                            <input type="hidden" id="technicalSkillsHidden[${skillIndex}]" 
                                name="technicalSkills[${skillIndex}][name]" value="${skill.name}">
                            <div class="flex-shrink-0">
                                <button type="button" id="selectTechLevelButton${skillIndex}" class="btn-view edit-level-btn" 
                                    data-bs-toggle="modal" data-bs-target="#techskillmodal" 
                                    onclick="technicalpopulateModal(${skillIndex})">
                                    Level ${skill?.preferred_level || ''}
                                </button>
                            </div>
                        </div>
                    </div>
                `;

                    // Re-initialize Select2 after DOM update
                    setTimeout(() => {

                        const newSkillRow = document.getElementById(`skill-${skillIndex}`);

                        // Re-bind Remove Button
                        newSkillRow.querySelector('.remove-skill')?.addEventListener('click', function () {
                            delete technicalSkillsData[skillIndex];
                            this.closest('.technical-skill').remove();
                            toggleRemoveSkillButtons();
                        });

                        // Re-bind Edit Button
                        newSkillRow.querySelector('.edit-skill')?.addEventListener('click', function () {
                            const skillData = technicalSkillsData[skillIndex];

                            if (skillData.is_custom == 1 || skillData.is_custom == 2) {
                                const modalEl = document.getElementById('CompanyTechnicalSkill');
                                modalEl.setAttribute('data-skill-index', skillIndex);
                                modalEl.querySelector('#companySkillName').textContent = skillData.name || 'Skill';
                                new bootstrap.Modal(modalEl).show();
                            } else {
                                const editModalEl = document.getElementById('EditTsfromMSL');
                                editModalEl.setAttribute('data-skill-index', skillIndex);
                                new bootstrap.Modal(editModalEl).show();
                            }
                        });
                        
                        const selectEl = $(`#skill\\[${skillIndex}\\]`);
                        initSelect2(selectEl);

                        selectEl.select2({
                            placeholder: 'Search for a skill',
                            width: 'resolve'
                        });

                        selectEl.on('change', function() {
                            const selectedText = $(this).find('option:selected')
                                .text();
                            $(`#technicalSkillsHidden\\[${skillIndex}\\]`).val(
                                selectedText);
                        });
                    }, 10);

                    const modal = bootstrap.Modal.getInstance(document.getElementById(
                        'EditTsfromMSL'));
                    modal.hide();
                });





                // Close the "Edit from Master Skill Library" modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('EditTsfromMSL'));
                modal.hide();
            });
        });
    </script>


    <script>
        function renderInlineSkillEdit(skillIndex, label = 'Company Skill') {
            const skillData = technicalSkillsData[skillIndex];
            const skillRow = document.getElementById(`skill-${skillIndex}`);
            if (!skillRow || !skillData) return;

            const originalSkillData = JSON.parse(JSON.stringify(skillData));

            const originalHTML = skillRow.innerHTML;
            console.log('skillData:', skillData);

            skillRow.innerHTML = `
                <div class="d-flex justify-content-between align-items-start pl-0">
                    <div class="d-flex align-items-start gap-3 col pl-3">
                        <div class="d-flex gap-2">
                            <button class="right-orange-btn accept-btn">
                                <iconify-icon icon="ic:round-check" width="18" height="18"></iconify-icon>
                            </button>
                            <button class="cross-grey-btn cancel-btn">
                                <iconify-icon icon="ic:round-close" width="18" height="18"></iconify-icon>
                            </button>
                        </div>
                        <div class="w-100">
                            <div class="d-flex align-items-center gap-4 mb-2 position-relative form-control">
                                <div class="d-flex align-items-center gap-2 w-100">
                                <input type="text" class="form-control p-0 border-0 h-auto" name="technicalSkills[${skillIndex}][name]" 
                                    value="${skillData.name}" 
                                    data-original="${skillData.name}">
                            </div>
                                <button class="reset-btn" type="button">
                                    <iconify-icon icon="grommet-icons:power-reset" width="16" height="16"></iconify-icon>
                                </button>
                                ${skillData.is_custom == 2 
                                ? `<span class="badge border text-muted px-2" style="background-color: #E3F7FF; color: #125A78;">Company Skill</span>` 
                                : `<span class="badge border text-muted px-2" style="background-color: #E3F7FF; color: #125A78;">Master Skill Library</span>`
                                }
                                <span class="badge border text-muted px-2" style="background-color: #F1F1F4; color: #4B5675;">
                                    ${skillData.sector_name || 'N/A'}
                                </span>
                            </div>
                            <div class="position-relative">
                                <textarea class="form-control pr-5" rows="2" name="technicalSkills[${skillIndex}][description]" 
                                    data-original="${skillData.description || 'N/A'}">${skillData.description || 'N/A'}</textarea>
                                <button class="reset-btn position-absolute top-0 end-0 mt-4 me-3" type="button">
                                    <iconify-icon icon="grommet-icons:power-reset" width="16" height="16"></iconify-icon>
                                </button>
                            </div>
                        </div>
                    </div>
                        <button type="button" class="edit-level-btn"
                            data-bs-toggle="modal" data-bs-target="#tsEditLevel"
                            onclick="openTSEditLevelModal(${skillIndex})">
                            Edit Level
                            <iconify-icon icon="lucide:edit" width="16" height="16"></iconify-icon>
                        </button>
                </div>
            `;

            // Cancel

            skillRow.querySelector('.cancel-btn').addEventListener('click', function() {
                const skill = originalSkillData;

                // Revert full skill data
                technicalSkillsData[skillIndex] = skill;

                skillRow.outerHTML = `
        <div class="technical-skill row mb-8" id="skill-${skillIndex}">
            <input type="hidden" name="technicalSkills[${skillIndex}][description]" value="${skill.description}">
            <input type="hidden" name="technicalSkills[${skillIndex}][sector_name]" value="${skill.sector_name || ''}">
            <input type="hidden" name="technicalSkills[${skillIndex}][preferred_level]" value="${skill.preferred_level || 1}">

<div class="d-flex align-items-center gap-3 w-100 flex-nowrap overflow-hidden">
                <!-- Trash Button -->
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center remove-skill">
                        <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
                    </button>
                </div>

                <!-- Select Dropdown -->
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center edit-skill" data-index="${skillIndex}">
                        <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
                    </button>
                </div>

                <!-- Select box -->
                <div class="flex-grow-1 overflow-hidden">
                    <select id="skill[${skillIndex}]" name="technicalSkills[${skillIndex}][id]" 
                        class="form-control select-skill select2-skill text-truncate w-100" data-index="${skillIndex}">
                        <option value="${skill.skill_id}" selected>${skill.name}</option>
                    </select>
                </div>

                    <input type="hidden" id="technicalSkillsHidden[${skillIndex}]" 
                        name="technicalSkills[${skillIndex}][name]" value="${skill.name}">


                <div class="flex-shrink-0">
                    <button type="button" id="selectTechLevelButton${skillIndex}" class="btn-view edit-level-btn" 
                        data-bs-toggle="modal" data-bs-target="#techskillmodal" 
                        onclick="technicalpopulateModal(${skillIndex})">
                        Level ${skill?.preferred_level || ''}
                    </button>
                </div>
            </div>
        </div>
    `;

                // Re-initialize Select2
                setTimeout(() => {
                    const newSkillRow = document.getElementById(`skill-${skillIndex}`);

                    // Re-bind Remove Button
                    newSkillRow.querySelector('.remove-skill')?.addEventListener('click', function () {
                        delete technicalSkillsData[skillIndex];
                        this.closest('.technical-skill').remove();
                        toggleRemoveSkillButtons(); // make sure this function exists
                    });

                    // Re-bind Edit Button
                    newSkillRow.querySelector('.edit-skill')?.addEventListener('click', function () {
                        const skillData = technicalSkillsData[skillIndex];

                        
                        if (skillData.is_custom == 1 || skillData.is_custom == 2) {
                            const modalEl = document.getElementById('CompanyTechnicalSkill');
                            modalEl.setAttribute('data-skill-index', skillIndex);
                            modalEl.querySelector('#companySkillName').textContent = skillData.name || 'Skill';
                            new bootstrap.Modal(modalEl).show();
                        } else {
                            const editModalEl = document.getElementById('EditTsfromMSL');
                            editModalEl.setAttribute('data-skill-index', skillIndex);
                            new bootstrap.Modal(editModalEl).show();
                        }
                    });

                    const selectEl = $(`#skill\\[${skillIndex}\\]`);
                    initSelect2(selectEl);

                    selectEl.select2({
                        placeholder: 'Search for a skill',
                        width: 'resolve'
                    });

                    selectEl.on('change', function() {
                        const selectedText = $(this).find('option:selected').text();
                        $(`#technicalSkillsHidden\\[${skillIndex}\\]`).val(selectedText);
                    });
                }, 10);
            });



            // Reset
            skillRow.querySelectorAll('.reset-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const input = btn.parentElement.querySelector('input, textarea');
                    if (input && input.dataset.original !== undefined) {
                        input.value = input.dataset.original;
                    }
                });
            });

            // Accept: save changes and re-render as read-only

            skillRow.querySelector('.accept-btn').addEventListener('click', function() {
                const nameInput = skillRow.querySelector(`input[name="technicalSkills[${skillIndex}][name]"]`);
                const descTextarea = skillRow.querySelector(
                    `textarea[name="technicalSkills[${skillIndex}][description]"]`);
                const originalName = nameInput.dataset.original?.trim() || '';
                const newName = nameInput.value.trim();
                const isRenamed = originalName !== newName;

                // Update technicalSkillsData
                const skill = technicalSkillsData[skillIndex];
                skill.name = newName;
                skill.description = descTextarea.value.trim();
                skill.is_modified = 1;

                // Sync JSON (optional if you use it elsewhere)
                document.getElementById('technicalSkillsJson').value = JSON.stringify(technicalSkillsData);

                // Re-render updated DOM
                skillRow.outerHTML = `
                    <div class="technical-skill row mb-8" id="skill-${skillIndex}">
                        <input type="hidden" name="technicalSkills[${skillIndex}][description]" value="${skill.description}">
                        <input type="hidden" name="technicalSkills[${skillIndex}][sector_name]" value="${skill.sector_name || ''}">
                        <input type="hidden" name="technicalSkills[${skillIndex}][preferred_level]" value="${skill.preferred_level || 1}">

                        <div class="d-flex align-items-center gap-3 w-100 flex-nowrap overflow-hidden">
                            <!-- Trash Button -->
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-outline btn-outline-primary d-flex  align-items-center justify-content-center remove-skill">
                                    <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
                                </button>
                            </div>

                            <!-- Select Dropdown -->
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-outline btn-outline-primary d-flex  align-items-center justify-content-center edit-skill" data-index="${skillIndex}">
                                    <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
                                </button>
                            </div>

                            <!-- Select box -->
                            <div class="flex-grow-1 overflow-hidden">
                                <select id="skill[${skillIndex}]" name="technicalSkills[${skillIndex}][id]" 
                                    class="form-control select-skill select2-skill text-truncate w-100" data-index="${skillIndex}">
                                    <option value="${skill.skill_id}" selected>${skill.name}${isRenamed ? ' (New Skill)' : ''}</option>
                                </select>
                            </div>
                            <input type="hidden" id="technicalSkillsHidden[${skillIndex}]" 
                                name="technicalSkills[${skillIndex}][name]" value="${skill.name}">
                            <div class="flex-shrink-0">
                                <button type="button" id="selectTechLevelButton${skillIndex}" class="btn-view edit-level-btn" 
                                    data-bs-toggle="modal" data-bs-target="#techskillmodal" 
                                    onclick="technicalpopulateModal(${skillIndex})">
                                    Level ${skill?.preferred_level || ''}
                                </button>
                            </div>
                        </div>
                    </div>
                `;

                // Re-initialize Select2 for new element
                setTimeout(() => {
                    const newSkillRow = document.getElementById(`skill-${skillIndex}`);

                    // Re-bind Remove Button
                    newSkillRow.querySelector('.remove-skill')?.addEventListener('click', function () {
                        delete technicalSkillsData[skillIndex];
                        this.closest('.technical-skill').remove();
                        toggleRemoveSkillButtons();
                    });

                    // Re-bind Edit Button
                    newSkillRow.querySelector('.edit-skill')?.addEventListener('click', function () {
                        const skillData = technicalSkillsData[skillIndex];

                        
                        if (skillData.is_custom == 1 || skillData.is_custom == 2) {
                            const modalEl = document.getElementById('CompanyTechnicalSkill');
                            modalEl.setAttribute('data-skill-index', skillIndex);
                            modalEl.querySelector('#companySkillName').textContent = skillData.name || 'Skill';
                            new bootstrap.Modal(modalEl).show();
                        } else {
                            const editModalEl = document.getElementById('EditTsfromMSL');
                            editModalEl.setAttribute('data-skill-index', skillIndex);
                            new bootstrap.Modal(editModalEl).show();
                        }
                    });
                    const selectEl = $(`#skill\\[${skillIndex}\\]`);
                    initSelect2(selectEl);

                    selectEl.select2({
                        placeholder: 'Search for a skill',
                        width: 'resolve'
                    });

                    selectEl.on('change', function() {
                        const selectedText = $(this).find('option:selected').text();
                        $(`#technicalSkillsHidden\\[${skillIndex}\\]`).val(selectedText);
                    });
                }, 10);

                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('EditTsfromMSL'));
                if (modal) modal.hide();
            });


            // Optional: close modal (you already handle it elsewhere)
            const modalEl = document.getElementById('EditTsfromMSL');
            if (modalEl) {
                const modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) modal.hide();
            }
        }
    </script>

    






    <script>
        function autoResize(textarea) {
    textarea.style.height = "auto";
    textarea.style.height = textarea.scrollHeight + "px";
}

function generateInputRow(value = '', type = 'knowledge') {
    return `
        <div class="mb-6 d-flex align-items-center gap-3 ${type}-row">
            <span class="delete-btn">
                <iconify-icon icon="mi:delete" width="16" height="16"></iconify-icon>
            </span>
            <div class="input-box w-100 position-relative">
                <textarea 
                    class="form-control border-0 w-100 auto-expand-textarea pt-0 pl-0 pr-5 pb-5" 
                    rows="1"
                    data-original="${encodeURIComponent(value)}"
                    oninput="autoResize(this)"
                >${value}</textarea>
                <button class="reset-btn position-absolute top-0 end-0 mt-3 me-3" type="button">
                    <iconify-icon icon="grommet-icons:power-reset" width="16" height="16"></iconify-icon>
                </button>
            </div>
        </div>`;
}


function openTSEditLevelModal(skillIndex) {
    const data = technicalSkillsData[skillIndex];
    if (!data) return;

    const modal = document.getElementById('tsEditLevel');
    modal.setAttribute('data-skill-index', skillIndex);

    const title = modal.querySelector('.modal-title');
    const subtitle = modal.querySelector('.modal-header p');
    const body = modal.querySelector('.ts-edit-popup-body');

    title.textContent = data.name || 'Skill Name';
    subtitle.textContent = data.description || 'Skill Description';
    body.innerHTML = '';

    const allLevels = [1, 2, 3, 4, 5, 6];

    const levelHasContent = (i) => {
        const desc = data[`level_${i}_description`];
        const knowledge = data[`level_${i}_knowledge`] || [];
        const ability = data[`level_${i}_ability`] || [];
        return (
            (typeof desc === 'string' && desc.trim() !== '') ||
            (Array.isArray(knowledge) && knowledge.some(k => k.trim() !== '')) ||
            (Array.isArray(ability) && ability.some(a => a.trim() !== ''))
        );
    };

    const existingLevels = allLevels.filter(levelHasContent);

    const isAdjacentToExisting = (level) => {
        if (existingLevels.length === 0) return level === 1; // Allow adding Level 1 only when empty
        return existingLevels.includes(level - 1) || existingLevels.includes(level + 1);
    };

    for (let i = 1; i <= 6; i++) {
        const levelDesc = data[`level_${i}_description`] || '';
        const knowledge = data[`level_${i}_knowledge`] || [];
        const abilities = data[`level_${i}_ability`] || [];

        const isFirst = i === existingLevels[0];
        const isLast = i === existingLevels[existingLevels.length - 1];
        const canDelete = (isFirst || isLast) && existingLevels.length > 1;

        const hasContent = levelHasContent(i);

        if (hasContent) {
            // Render existing level
            const wrapper = document.createElement('div');
            wrapper.className = 'ts-edit-inner-box';
            wrapper.innerHTML = `
                <div class="header d-flex justify-content-between align-items-center">
                    <p class="d-flex align-items-center gap-1 m-0 content-p">Level ${i}
                        <iconify-icon icon="material-symbols:star" width="16" height="16" style="color: #F3AC60;"></iconify-icon>
                    </p>
                    ${canDelete ? `
                        <span class="delete-btn" data-level="${i}">
                            <iconify-icon icon="mi:delete" width="16" height="16"></iconify-icon>
                        </span>` : `
                        <span class="delete-btn text-muted" style="pointer-events: none; opacity: 0.5;">
                            <iconify-icon icon="mi:delete" width="16" height="16"></iconify-icon>
                        </span>`}
                </div>
                <div class="inner-content">
                    <div class="mb-5 w-100">
                        <label class="form-label fw-bold">Level Description</label>
                        <div class="input-box w-100 position-relative">
                            <textarea class="form-control border-0 w-100 auto-expand-textarea pt-0 pl-0 pr-5 pb-5" rows="1"
                                oninput="autoResize(this)" data-original="${encodeURIComponent(levelDesc)}">${levelDesc}</textarea>
                            <button class="reset-btn position-absolute top-0 end-0 mt-3 me-3" type="button">
                                <iconify-icon icon="grommet-icons:power-reset" width="16" height="16"></iconify-icon>
                            </button>
                        </div>
                    </div>
                    <div class="mb-5 w-100 knowledge-section">
                        <label class="form-label fw-bold">Knowledge</label>
                        ${knowledge.map(k => generateInputRow(k, 'knowledge')).join('')}
                        <div>
                            <button type="button" class="fs-6 custom-btn orange-fill-popup border-0 py-4 px-6 d-flex gap-2 add-knowledge-btn">
                                <iconify-icon icon="uil:plus" width="16" height="16"></iconify-icon> Add Knowledge
                            </button>
                        </div>
                    </div>
                    <div class="w-100 ability-section">
                        <label class="form-label fw-bold">Abilities</label>
                        ${abilities.map(a => generateInputRow(a, 'ability')).join('')}
                        <div>
                            <button type="button" class="fs-6 custom-btn orange-fill-popup border-0 py-4 px-6 d-flex gap-2 add-ability-btn">
                                <iconify-icon icon="uil:plus" width="16" height="16"></iconify-icon> Add Ability
                            </button>
                        </div>
                    </div>
                </div>`;
            body.appendChild(wrapper);
        } else if (isAdjacentToExisting(i)) {
            // Render Add Level Button (clickable)
            body.innerHTML += `
                <div class="ts-edit-inner-box bg-grey">
                    <div class="header"></div>
                    <div class="inner-content justify-content-center">
                        <div>
                            <button type="button" class="fs-6 custom-btn orange-outline-popup py-4 px-6 h-100 align-items-center d-flex gap-2 add-level-btn" data-level="${i}">
                                <iconify-icon icon="uil:plus" width="16" height="16"></iconify-icon> Add Level ${i}
                            </button>
                        </div>
                    </div>
                </div>`;
        } else {
            // Render Add Level Button (disabled)
            body.innerHTML += `
                <div class="ts-edit-inner-box bg-grey">
                    <div class="header"></div>
                    <div class="inner-content justify-content-center">
                        <div>
                            <button type="button" class="fs-6 custom-btn grey-outline-popup bg-transparent py-4 px-6 h-100 align-items-center d-flex gap-2" disabled>
                                <iconify-icon icon="uil:plus" width="16" height="16"></iconify-icon> Add Level ${i}
                            </button>
                        </div>
                    </div>
                </div>`;
        }
    }

    bindLevelEvents(); // bind buttons again after rendering
}


function bindLevelEvents() {
    // DELETE LEVEL OR ROW
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.onclick = () => {
            const skillIndex = document.getElementById('tsEditLevel').getAttribute('data-skill-index');
            const box = btn.closest('.ts-edit-inner-box');

            // Knowledge/Ability Row
            const row = btn.closest('.knowledge-row, .ability-row');
            if (row) {
                row.remove();
                return;
            }

            // Full Level Box
            const level = btn.dataset.level;
            if (level && box) {
                delete technicalSkillsData[skillIndex][`level_${level}_description`];
                delete technicalSkillsData[skillIndex][`level_${level}_knowledge`];
                delete technicalSkillsData[skillIndex][`level_${level}_ability`];

                openTSEditLevelModal(skillIndex);
            }
        };
    });

    // RESET
    document.querySelectorAll('.reset-btn').forEach(btn => {
        btn.onclick = () => {
            const textarea = btn.closest('.input-box')?.querySelector('textarea');
            if (textarea) {
                const original = decodeURIComponent(textarea.dataset.original || '');
                textarea.value = original;
                autoResize(textarea);
            }
        };
    });

    // ADD KNOWLEDGE
    document.querySelectorAll('.add-knowledge-btn').forEach(btn => {
        btn.onclick = () => {
            const container = btn.closest('.knowledge-section');
            const div = document.createElement('div');
            div.innerHTML = generateInputRow('', 'knowledge');
            container.insertBefore(div.firstElementChild, btn.parentElement);
            bindLevelEvents();
        };
    });

    // ADD ABILITY
    document.querySelectorAll('.add-ability-btn').forEach(btn => {
        btn.onclick = () => {
            const container = btn.closest('.ability-section');
            const div = document.createElement('div');
            div.innerHTML = generateInputRow('', 'ability');
            container.insertBefore(div.firstElementChild, btn.parentElement);
            bindLevelEvents();
        };
    });

    // ADD LEVEL
    
    document.querySelectorAll('.add-level-btn').forEach(btn => {
        btn.onclick = () => {
            const skillIndex = document.getElementById('tsEditLevel').getAttribute('data-skill-index');
            const level = btn.dataset.level;

            if (!skillIndex || !level) return;
            const skill = technicalSkillsData[skillIndex];
            if (!skill) return;

            // ✅ Create minimal but valid content
            skill[`level_${level}_description`] = 'Level description';
            skill[`level_${level}_knowledge`] = ['Sample knowledge'];
            skill[`level_${level}_ability`] = ['Sample ability'];

            openTSEditLevelModal(skillIndex); // rerender modal
        };
    });
}

    </script>


    

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.technicalSkillsData = {}; // CHANGED to object, not array!
            let originalSkillBeforeEdit = {};


            window.saveTSEditLevelModal = function() {
                const modal = document.getElementById('tsEditLevel');
                const skillIndex = modal.getAttribute('data-skill-index');

                if (!skillIndex) {
                    console.error("Missing skill index");
                    return;
                }

                const allLevelBoxes = modal.querySelectorAll('.ts-edit-inner-box');
                let isValid = true;

                // Backup original
                originalSkillBeforeEdit = JSON.parse(JSON.stringify(technicalSkillsData[skillIndex] || {}));
                const name = modal.querySelector('.modal-title')?.textContent.trim();
                const description = modal.querySelector('.modal-header p')?.textContent.trim();
                let skillObject = technicalSkillsData[skillIndex] || {};

                // Clear old level info
                for (let i = 1; i <= 6; i++) {
                    delete skillObject[`level_${i}_description`];
                    delete skillObject[`level_${i}_knowledge`];
                    delete skillObject[`level_${i}_ability`];
                }

                allLevelBoxes.forEach(box => {
                    const headerText = box.querySelector('.header p')?.textContent || '';
                    const match = headerText.match(/Level\s+(\d+)/);
                    const level = match ? parseInt(match[1]) : null;
                    if (!level) return;

                    // Level Description validation
                    const descTextarea = box.querySelector('.input-box textarea');
                    const levelDesc = descTextarea?.value.trim() || '';
                    const descContainer = descTextarea.closest('.input-box');

                    // Clear previous validation
                    descTextarea.classList.remove('is-invalid');
                    descContainer.querySelector('.invalid-feedback')?.remove();

                    if (!levelDesc) {
                        isValid = false;
                        descTextarea.classList.add('is-invalid');
                        const err = document.createElement('div');
                        err.className = 'invalid-feedback';
                        err.textContent = 'Level Description is required.';
                        descContainer.appendChild(err);
                    }

                    // Knowledge validation
                    const knowledgeFields = box.querySelectorAll('.knowledge-section textarea');
                    const knowledgeValues = [];
                    knowledgeFields.forEach(textarea => {
                        const val = textarea.value.trim();
                        const container = textarea.closest('.input-box');

                        textarea.classList.remove('is-invalid');
                        container.querySelector('.invalid-feedback')?.remove();

                        if (!val) {
                            isValid = false;
                            textarea.classList.add('is-invalid');
                            const error = document.createElement('div');
                            error.className = 'invalid-feedback';
                            error.textContent = 'Knowledge field cannot be empty.';
                            container.appendChild(error);
                        } else {
                            knowledgeValues.push(val);
                        }
                    });

                    // Ability validation
                    const abilityFields = box.querySelectorAll('.ability-section textarea');
                    const abilityValues = [];
                    abilityFields.forEach(textarea => {
                        const val = textarea.value.trim();
                        const container = textarea.closest('.input-box');

                        textarea.classList.remove('is-invalid');
                        container.querySelector('.invalid-feedback')?.remove();

                        if (!val) {
                            isValid = false;
                            textarea.classList.add('is-invalid');
                            const error = document.createElement('div');
                            error.className = 'invalid-feedback';
                            error.textContent = 'Ability field cannot be empty.';
                            container.appendChild(error);
                        } else {
                            abilityValues.push(val);
                        }
                    });

                    // If all fields for this level are valid, store them
                    if (levelDesc && knowledgeValues.length && abilityValues.length) {
                        skillObject[`level_${level}_description`] = levelDesc;
                        skillObject[`level_${level}_knowledge`] = knowledgeValues;
                        skillObject[`level_${level}_ability`] = abilityValues;
                    }
                });

                if (!isValid) {
                    const firstInvalid = modal.querySelector('.is-invalid');
                    firstInvalid?.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    return;
                }

                // Save common fields
                skillObject.name = name;
                skillObject.description = description;
                skillObject.preferred_level = skillObject.preferred_level || "1";
                skillObject.c_id = skillObject.c_id ?? null;
                skillObject.code = skillObject.code ?? null;
                skillObject.sector_id = skillObject.sector_id ?? null;
                skillObject.sector_name = skillObject.sector_name ?? '';
                skillObject.sub_sector_id = skillObject.sub_sector_id ?? null;
                skillObject.sub_sector_name = skillObject.sub_sector_name ?? '';

                technicalSkillsData[skillIndex] = skillObject;
                document.getElementById('technicalSkillsJson').value = JSON.stringify(technicalSkillsData);
                bootstrap.Modal.getInstance(modal)?.hide();
                console.log("✅ Skill Saved:", skillObject);

                // Optional Overwrite Logic
                if (triggerOverwriteConfirmAfterSave) {
                    triggerOverwriteConfirmAfterSave = false;
                    const confirmModal = new bootstrap.Modal(document.getElementById(
                        'OverwriteCompanySkillConfirmModal'));
                    document.getElementById('overwriteCompanySkillName').textContent = skillObject?.name ||
                        'N/A';
                    document.getElementById('OverwriteCompanySkillConfirmModal').setAttribute(
                        'data-skill-index', skillIndex);

                    const jobListContainer = document.getElementById('affectedJobList');
                    jobListContainer.textContent = 'Loading affected job titles...';

                    const skillId = skillObject?.skill_id || technicalSkillsData[skillIndex]?.skill_id;

                    if (skillId) {
                        fetch(`/admin/get-jobs-by-skill/${skillId}`)
                            .then(res => res.json())
                            .then(data => {
                                const jobTitles = data.map(job => job.title).join(', ');
                                jobListContainer.textContent = jobTitles || 'No associated job titles.';
                            })
                            .catch(() => {
                                jobListContainer.textContent = 'Failed to load job titles.';
                            });
                    } else {
                        jobListContainer.textContent = 'Skill ID not available.';
                    }

                    confirmModal.show();
                }
            };




            document.getElementById('OverwriteContinueEditSkillBtn')?.addEventListener('click', function() {
                const modal = document.getElementById('OverwriteCompanySkillConfirmModal');
                const skillIndex = modal.getAttribute('data-skill-index');
                if (!skillIndex || !technicalSkillsData[skillIndex]) {
                    console.error('Invalid or missing skillIndex');
                    return;
                }
                technicalSkillsData[skillIndex].is_modify = 1;
                // Save to hidden input and refresh view
                document.getElementById('technicalSkillsJson').value = JSON.stringify(technicalSkillsData);
                bootstrap.Modal.getInstance(modal)?.hide();
                renderInlineSkillEdit(skillIndex);
            });

            // ❌ Cancel button click (revert changes)
            document.querySelector('#OverwriteCompanySkillConfirmModal .btn[data-bs-dismiss="modal"]')
                ?.addEventListener('click', function() {
                    const modal = document.getElementById('OverwriteCompanySkillConfirmModal');
                    const skillIndex = modal.getAttribute('data-skill-index');
                    if (!skillIndex || !originalSkillBeforeEdit) return;

                    technicalSkillsData[skillIndex] = JSON.parse(JSON.stringify(originalSkillBeforeEdit));
                    document.getElementById('technicalSkillsJson').value = JSON.stringify(technicalSkillsData);
                    renderInlineSkillEdit(skillIndex);
                });


            // Update name/description after editing
            window.acceptSkillEdit = function(skillIndex) {
                const skillRow = document.getElementById(`skill-${skillIndex}`);
                const nameInput = skillRow.querySelector(`input[name="technicalSkills[${skillIndex}][name]"]`);
                const descTextarea = skillRow.querySelector(
                    `textarea[name="technicalSkills[${skillIndex}][description]"]`);

                if (!technicalSkillsData[skillIndex]) return;

                technicalSkillsData[skillIndex].name = nameInput?.value?.trim() || '';
                technicalSkillsData[skillIndex].description = descTextarea?.value?.trim() || '';

                document.getElementById('technicalSkillsJson').value = JSON.stringify(technicalSkillsData);
                // 🆕 Re-render the inline row completely using updated data
                renderInlineSkillEdit(skillIndex);
                console.log("Edited skill accepted:", technicalSkillsData[skillIndex]);
            };
        });
    </script>


    <script>
        let modifiedAdditionalDetail = '';
        let generationCount = 0;

        document.addEventListener('DOMContentLoaded', function() {
            const generateBtn = document.getElementById('generateJD');
            const step1 = document.getElementById('step1');
            const step2 = document.getElementById('step2');
            const step1Footer = document.getElementById('step1-footer');
            const step2Footer = document.getElementById('step2-footer');
            const selectJD = document.getElementById('selectJD');
            const regenerateBtn = document.getElementById('regenerateBtn');
            const jdOptionsContainer = document.getElementById('jdOptionsContainer');
            const additionalDetailTextarea = document.getElementById('additionalDetail');
            const baseJD = document.getElementById('baseJD');
            const titleInput = document.querySelector('input[name="title"]');
            const jobRoleTextarea = document.getElementById('jobRoleDescription') || document.createElement(
                'textarea');
            const modalPageSpan = document.querySelector('.modal-page-span');

            let selectedJDId = null;
            let jdResponses = [];

            if (!generateBtn || !additionalDetailTextarea || !baseJD || !titleInput) {
                console.error("Required DOM elements not found. Check your HTML structure.");
                return;
            }

            // Capture input changes for additionalDetail
            additionalDetailTextarea.addEventListener('input', function() {
                modifiedAdditionalDetail = additionalDetailTextarea.value.trim();
            });

            // Generate JD using the API
            generateBtn.addEventListener('click', function() {
                showOverlay();
                modifiedAdditionalDetail = additionalDetailTextarea.value.trim();
                const additional_information = additionalDetailTextarea.value.trim();
                const localized_job_role_name = titleInput.value.trim();
                const selected_job_role_description = baseJD.textContent.trim();

                if (!additional_information) {
                    hideOverlay();
                    alert("Please fill in the 'Job Description' field before generating JD.");
                    return;
                }

                if (!localized_job_role_name || !selected_job_role_description) {
                    hideOverlay();
                    alert("Missing required job title or base job description.");
                    return;
                }


                $.ajax({
                    url: '/api/generate-jd',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        additional_information,
                        localized_job_role_name,
                        selected_job_role_description
                    }),
                    success: function(data) {
                        console.log("JD Generation Response:", data);
                        const jobRole = data.jobRole; // Correctly assign jobRole object
                        console.log("JD Generated Successfully:", jobRole);

                        const rawDescription = jobRole.llmOutput?.description || '';
                        console.log("LLM Output Description:", rawDescription);



                        const formattedDescription = rawDescription.trim().replace(/\n/g,
                            "<br>");

                        const cardId = `generatedJD_${jdResponses.length}`;
                        jdResponses.push({
                            id: cardId,
                            text: formattedDescription
                        });

                        generationCount += 1;
                        modalPageSpan.innerText = `${generationCount}/3`;

                        step1.classList.add('d-none');
                        step2.classList.remove('d-none');
                        step1Footer.classList.add('d-none');
                        step2Footer.classList.remove('d-none');

                        if (jdResponses.length >= 3) {
                            regenerateBtn.disabled = true;
                        } else {
                            regenerateBtn.disabled = false;
                        }

                        renderJDOptions();

                        const scrollLeftBtn = document.querySelector('.custom-scroll-left');
                        const scrollRightBtn = document.querySelector('.custom-scroll-right');
                        if (jdResponses.length > 1) {
                            scrollLeftBtn.style.display = 'block';
                            scrollRightBtn.style.display = 'block';
                        } else {
                            scrollLeftBtn.style.display = 'none';
                            scrollRightBtn.style.display = 'none';
                        }

                        hideOverlay();
                    },
                    error: function() {
                        alert("Something went wrong with the API call.");
                        hideOverlay();
                    }
                });
            });

            // Render the JD options dynamically
            function renderJDOptions() {
                const current = document.getElementById('customJD_ai').parentNode.outerHTML;
                jdOptionsContainer.innerHTML = current;
                jdResponses.forEach((jd, index) => {
                    const label = document.createElement('label');
                    label.classList.add('manually-radio');
                    label.style.flex = '0 0 calc(50% - 1rem)';
                    label.style.maxWidth = 'calc(50% - 1rem)';
                    label.innerHTML = `
                    <input type="radio" class="select-jd-option" name="jdOption" value="${jd.id}" id="${jd.id}_radio">
                    <div class="d-flex flex-column gap-3 manually-modal-inner h-100">
                        <p class="m-0 text-left fw-bolder fs-2 d-flex flex-column justify-content-between gap-2">
                                <span>${jd.title || `Job Description`}</span>
                                <span class="jd-badge text-center ${jd.badge_class || 'enter-jr-badge'}">${jd.badge || 'Generated'}</span>
                            </p>
                        <div class="line"></div>
                        <p id="${jd.id}" class="m-0">${jd.text}</p>
                    </div>`;
                    jdOptionsContainer.appendChild(label);
                });
            }

            // When JD option is selected, enable the "Select this JD" button
            document.addEventListener('change', function(e) {
                if (e.target.classList.contains('select-jd-option')) {
                    selectedJDId = e.target.value;
                    selectJD.removeAttribute('disabled');
                }
            });

            // Select the JD and populate the jobRoleDescription textarea
            selectJD.addEventListener('click', function() {
                if (selectedJDId) {
                    const selectedEl = document.getElementById(selectedJDId);
                    if (selectedEl) {
                        jobRoleTextarea.value = selectedEl.innerText || selectedEl.innerHTML.replace(
                            /<br>/g, '\n');
                        const modal = bootstrap.Modal.getInstance(document.getElementById(
                            'GenerateJDUsingAI'));
                        if (modal) modal.hide();
                    }
                }
            });

            // Regenerate button logic to reset and pre-populate textarea with modifiedAdditionalDetail
            regenerateBtn.addEventListener('click', function() {
                step1.classList.remove('d-none');
                step2.classList.add('d-none');
                step1Footer.classList.remove('d-none');
                step2Footer.classList.add('d-none');

                additionalDetailTextarea.value = modifiedAdditionalDetail || '';

                // Clear the modifiedAdditionalDetail variable after use
                modifiedAdditionalDetail = '';

                selectedJDId = null;
                selectJD.setAttribute('disabled', true);
            });
        });
    </script>


    <script>
        function scrollLeft() {
            const wrapper = document.getElementById('jdScrollWrapper');
            wrapper.scrollBy({
                left: -wrapper.offsetWidth,
                behavior: 'smooth'
            });
        }

        function scrollRight() {
            const wrapper = document.getElementById('jdScrollWrapper');
            wrapper.scrollBy({
                left: wrapper.offsetWidth,
                behavior: 'smooth'
            });
        }
    </script>

    <script>
        function scrollJD(direction) {
            const container = document.getElementById('jdOptionsContainer');
            const scrollAmount = 478.750; // px to scroll

            if (direction === 'left') {
                container.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            } else if (direction === 'right') {
                container.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            }
        }
    </script>




    <script>
        let functionIndex = 0;

        function toggleDeleteButtons() {
            const total = $('.critical-function').length;
            $('.delete-function').prop('disabled', total <= 1);
        }

        function addCriticalFunction(index, cwf = null) {
            const title = cwf?.cwf_description || '';
            const tasks = cwf?.cwf_keys?.keytasks || [];

            const functionHtml = `
      <div class="critical-function mt-4" data-index="${index}">
        <!-- View Mode -->
        <div class="view-mode d-flex gap-7">
          <div class="d-flex gap-2 align-items-baseline mb-2">
            <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center delete-function">
                    <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
                </button>
 
                <!-- Edit button -->
                <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center edit-function">
                    <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
                </button>
          </div>
          <div>
            <span class="function-title" style="
                font-weight: 500;
                font-size: 16.25px;
                line-height: 50px;
                color: #071437;
                ">
                ${title}
            </span>
          <div class="task-chips d-flex flex-wrap gap-2 mt-1">
            ${tasks.map(task => `
                                            <span class="task-chip" style="background-color: #FFF6EA; color: #7C4A0E;">
                                            ${task}
                                            </span>`).join('')}
            </div>
          </div>
        </div>

        <!-- Edit Mode -->
        <div class="edit-mode d-none">
          <div class="d-flex gap-2 mb-2 align-items-center">
            <button type="button" class="right-orange-btn save-function"><i class="fa fa-check"></i></button>
            <button type="button" class="cross-grey-btn cancel-function"><i class="fa fa-times"></i></button>
            <input type="text" class="form-control function-input" value="${title}" name="functions[${index}][title]" placeholder="Critical Work Function">
          </div>
          <div class="editable-tasks">
            ${tasks.map(task => `
                  <div class="d-flex gap-2 mb-2 task-row">
                    <button class="cross-grey-btn remove-task" type="button"><i class="fa fa-trash"></i></button>
                    <input type="text" class="form-control task-input" value="${task}" name="functions[${index}][tasks][]">
                  </div>`).join('')}
          </div>
          <button class="add-task mt-4 mb-4" type="button">+ Add New Key Task</button>
        </div>
      </div>`;

            document.querySelector('.critical-functions-container').insertAdjacentHTML('beforeend', functionHtml);
        }

        function addNewCriticalFunction(index, cwf = null) {
            const title = cwf?.cwf_description || '';
            const tasks = cwf?.cwf_keys?.keytasks || [];

            const functionHtml = `
      <div class="critical-function mt-4" data-index="${index}" data-has-saved="false">
        <!-- View Mode -->
        <div class="view-mode d-none  gap-7" style="display:flex">
          <div class="d-flex gap-2 align-items-center mb-2">
            <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center delete-function">
                    <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
                </button>

                <!-- Edit button -->
                <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center edit-function">
                    <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
                </button>
                 </div>
                 <div>
            <span class="function-title" style="
                font-weight: 500;
                font-size: 16.25px;
                line-height: 50px;
                color: #071437;
                ">
                ${title}
            </span>

              <div class="task-chips d-flex flex-wrap gap-2 mt-1">
            ${tasks.map(task => `
                    <span class="task-chip" style="background-color: #FFF6EA; color: #7C4A0E;">
                    ${task}
                    </span>`).join('')}
            </div>
            </div>
         
        
        </div>

        <!-- Edit Mode -->
        <div class="edit-mode">
          <div class="d-flex gap-2 mb-2 align-items-center mt-7">
            <button type="button" class="right-orange-btn save-function"><i class="fa fa-check"></i></button>
            <button type="button" class="cross-grey-btn cancel-or-delete-function"><i class="fa fa-times"></i></button>
            <input type="text" class="form-control function-input" name="functions[${index}][title]" placeholder="Enter critical work function" required>
          </div>
          <div class="editable-tasks">
            
              <div class="d-flex gap-2 mb-2 task-row">
                <button class="cross-grey-btn" type="button" disabled><i class="fa fa-trash"></i></button>
                <input type="text" class="form-control task-input" placeholder="Enter key task"  name="functions[${index}][tasks][]" required>
              </div>
          </div>
          <button class="add-task mt-4 mb-4" type="button">+ Add New Key Task</button>
        </div>
      </div>`;

            document.querySelector('.critical-functions-container').insertAdjacentHTML('beforeend', functionHtml);
        }

        // Add initial example function
        $(document).ready(() => {
            $('#add-function-btn').click(() => {
                addCriticalFunction(functionIndex++);
            });

            // Validate Critical Work Function count before form submit
            $('form').on('submit', function(e) {
                if ($('.critical-function').length === 0) {
                    e.preventDefault();
                    $('#validationMessage').show();
                    window.scrollTo({
                        top: $('#validationMessage').offset().top - 100,
                        behavior: 'smooth'
                    });
                } else {
                    $('#validationMessage').hide();
                }
            });

            toggleDeleteButtons();
        });


        $(document).on('click', '.edit-function', function() {
            const wrapper = $(this).closest('.critical-function');

            // Save current values before switching to edit mode
            const title = wrapper.find('.function-title').text().trim();
            const tasks = wrapper.find('.task-chip').map(function() {
                return $(this).text().trim();
            }).get();

            wrapper.data('original-title', title);
            wrapper.data('original-tasks', tasks);

            // Show edit mode
            wrapper.find('.view-mode').addClass('d-none');
            wrapper.find('.edit-mode').removeClass('d-none');
        });


        $(document).on('click', '.cancel-function', function() {
            const wrapper = $(this).closest('.critical-function');
            const originalTitle = wrapper.data('original-title');
            const originalTasks = wrapper.data('original-tasks');
            const index = wrapper.data('index');

            // Revert title in the input field
            wrapper.find('.function-input').val(originalTitle);

            // Rebuild editable task list
            const taskContainer = wrapper.find('.editable-tasks');
            taskContainer.empty();
            originalTasks.forEach(task => {
                taskContainer.append(`
      <div class="d-flex gap-2 mb-2 task-row">
        <button class="cross-grey-btn remove-task" type="button"><i class="fa fa-trash"></i></button>
        <input type="text" class="form-control task-input" value="${task}" name="functions[${index}][tasks][]" />
      </div>
    `);
            });

            // Rebuild view-mode title and chips
            wrapper.find('.function-title').text(originalTitle);
            const chipContainer = wrapper.find('.task-chips');
            chipContainer.empty();
            originalTasks.forEach(task => {
                chipContainer.append(`
      <span class="task-chip" style="background-color: #FFF6EA; color: #7C4A0E;">
        ${task}
      </span>
    `);
            });

            // Hide edit mode, show view mode
            wrapper.find('.edit-mode').addClass('d-none');
            wrapper.find('.view-mode').removeClass('d-none');
        });



        // Cancel

        $(document).on('click', '.save-function', function() {
    const wrapper = $(this).closest('.critical-function');
    const newTitle = wrapper.find('.function-input').val().trim();
    const newTasks = wrapper.find('.task-input').map(function() {
        return $(this).val().trim();
    }).get();

    if (newTitle === '' || newTasks.some(task => task === '')) {
        alert('Please enter a title and at least one key task.');
        return;
    }

    // Update view
    wrapper.find('.function-title').text(newTitle);
    const chips = wrapper.find('.task-chips').empty();
    newTasks.forEach(task => {
        chips.append(`<span class="task-chip" style="background-color: #FFF6EA; color: #7C4A0E;">${task}</span>`);
    });

    // Mark as saved
    wrapper.attr('data-has-saved', 'true');

    wrapper.find('.edit-mode').addClass('d-none');
    wrapper.find('.view-mode').removeClass('d-none');
});


$(document).on('click', '.cancel-or-delete-function', function () {
    const wrapper = $(this).closest('.critical-function');
    const hasSaved = wrapper.attr('data-has-saved') === 'true';

    if (hasSaved) {
        const wrapper = $(this).closest('.critical-function');
            const originalTitle = wrapper.data('original-title');
            const originalTasks = wrapper.data('original-tasks');
            const index = wrapper.data('index');

            // Revert title in the input field
            wrapper.find('.function-input').val(originalTitle);

            // Rebuild editable task list
            const taskContainer = wrapper.find('.editable-tasks');
            taskContainer.empty();
            originalTasks.forEach(task => {
                taskContainer.append(`
      <div class="d-flex gap-2 mb-2 task-row">
        <button class="cross-grey-btn remove-task" type="button"><i class="fa fa-trash"></i></button>
        <input type="text" class="form-control task-input" value="${task}" name="functions[${index}][tasks][]" />
      </div>
    `);
            });

            // Rebuild view-mode title and chips
            wrapper.find('.function-title').text(originalTitle);
            const chipContainer = wrapper.find('.task-chips');
            chipContainer.empty();
            originalTasks.forEach(task => {
                chipContainer.append(`
      <span class="task-chip" style="background-color: #FFF6EA; color: #7C4A0E;">
        ${task}
      </span>
    `);
            });

            // Hide edit mode, show view mode
            wrapper.find('.edit-mode').addClass('d-none');
            wrapper.find('.view-mode').removeClass('d-none'); // Discard changes
    } else {
        wrapper.remove(); // Still new and unsaved → delete
        toggleDeleteButtons();
    }
});




        // Add Task
        $(document).on('click', '.add-task', function() {
            const wrapper = $(this).closest('.critical-function');
            const index = wrapper.data('index');
            wrapper.find('.editable-tasks').append(`
        <div class="d-flex gap-2 mb-2 task-row">
            <button class="cross-grey-btn remove-task" type="button"><i class="fa fa-trash"></i></button>
          <input type="text" class="form-control task-input" placeholder="Enter key task" name="functions[${index}][tasks][]">
        </div>`);
        });

        // Remove Task
        $(document).on('click', '.remove-task', function() {
            $(this).closest('.task-row').remove();
        });

        // Delete Function

        // Working delete handler
        $(document).on('click', '.delete-function', function() {
            const $allFunctions = $('.critical-function');
            if ($allFunctions.length > 1) {
                $(this).closest('.critical-function').remove();
                toggleDeleteButtons(); // keep the buttons updated
            }
        });

    </script>

    {{-- 2927 --}}

    <script>
        // Event listener for when the user selects options
        $('#riasec').on('change', function() {
            // Get the selected values
            var selectedValues = $(this).val();

            // Get all options
            var options = $('#riasec option');

            // Sort options based on the selected values
            options.sort(function(a, b) {
                // Get the index of each option in the selected values array
                var aIndex = selectedValues.indexOf(a.value);
                var bIndex = selectedValues.indexOf(b.value);

                // Return comparison to arrange options in the selected order
                return bIndex - aIndex;
            });

            // Append the sorted options back to the select element
            $('#riasec').empty().append(options);
        });
    </script>

    <script>
        $(document).ready(function() {
            const $riasec = $('#riasec');

            // Initialize select2 first
            $riasec.select2({
                placeholder: $riasec.data('placeholder'),
                closeOnSelect: false,
                width: '100%'
            });

            // Initialize selected order from initial values
            let selectedOrder = $riasec.val() ? [...$riasec.val()] : [];

            // When user selects an option
            $riasec.on('select2:select', function(e) {
                const id = e.params.data.id;
                if (!selectedOrder.includes(id)) {
                    selectedOrder.push(id);
                }
                reorderOptions();
            });

            // When user unselects an option
            $riasec.on('select2:unselect', function(e) {
                const id = e.params.data.id;
                selectedOrder = selectedOrder.filter(val => val !== id);
                reorderOptions();
            });

            // Helper: reorder DOM options to match `selectedOrder`
            function reorderOptions() {
                // Detach all selected <option>s and re-append in order
                const selectedOptions = selectedOrder.map(val =>
                    $riasec.find('option[value="' + val + '"]').detach()
                );
                $riasec.append(selectedOptions).trigger('change.select2');
            }

            // On load, trigger once
            reorderOptions();
        });
    </script>



@endsection
