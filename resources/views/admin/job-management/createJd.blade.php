@extends('admin.layout.app')

@section('title', 'Create with AI')

@section('styles')
    <style>
        .create-ai .top-card .card-header {
            padding: 24px;
            border-radius: 8px 8px 0px 0px;
            border: 1px solid #F1F1F4;
            background: #F7941D;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .create-ai .top-card .card-header p {
            color: #FFF;
            font-size: 17.55px;
            font-weight: 500;
            line-height: 21.06px;
        }

        .create-ai .top-card .card-inner {
            padding: 24px;
            border-radius: 0px 0px 8px 8px;
            border-right: 1px solid #F1F1F4;
            border-bottom: 1px solid #F1F1F4;
            border-left: 1px solid #F1F1F4;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .create-ai .custom-btn {
            padding: 14px 20px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
        }

        .create-ai .custom-btn.orange-fill {
            background: #F7941C;
            color: #FFF;
            border: 1px solid #F7941C;
        }

        .create-ai .custom-btn.orange-outline {
            border: 1px solid #F7941C;
            background: #FFF;
            color: #F7941C;
        }

        .create-ai .main-content .heading {
            color: #4B5675;
            font-size: 22.75px;
            font-weight: 500;
            line-height: 27.3px;
            width: 45%;
        }

        .create-ai .creat-jd-manually {
            padding: 24px;
            border-radius: 8px;
            border: 1px solid #DBDFE9;
            background: #FFF;
            margin-top: 30px;
        }

        .create-ai .main-card {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        .create-ai .main-card .main-card-inner {
            width: 49.2%;
            border-radius: 3.2px;
            border: 1px solid #99A1B7;
            background: #fff;
            box-shadow: 0px 2.4px 3.2px 0px rgba(0, 0, 0, 0.03);
            padding: 19.2px;
            cursor: pointer;
        }

        .create-ai .main-card .main-card-inner:checked {
            border: 3px solid #F9A845;
        }

        .create-ai .button-card {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .create-ai .main-card .main-card-inner .header .sector {
            padding: 4px 12px;
            border-radius: 80px;
            background: #F1F1F4;
            color: #4B5675;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .create-ai .main-card .main-card-inner .para-clip {
            display: -webkit-box;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
            overflow: hidden;
            color: #757575;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }

        .create-ai .main-card .main-card-inner .badge-main-div .heading {
            color: #4B5675;
            font-size: 9.6px;
            font-weight: 600;
            line-height: 12.8px;
        }

        .create-ai .main-card .main-card-inner .badge-main-div .badge-inner-div {
            gap: 6.4px;
            flex-wrap: wrap;
        }

        .star-color {
            color: #FFCD44;
        }

        .badge-div {
            padding: 6.4px 12.8px;
            gap: 3.2px;
            border-radius: 64px;
            font-size: 10px;
            font-weight: 500;
            line-height: 14px;
        }

        .generic-div {
            background: #F2EEFD;
            color: #6652A1;
        }

        .technical-div {
            background: #FFF6EA;
            color: #7C4A0E;
        }

        .btn-more-skills {
            padding: 6.4px 12.8px;
            border-radius: 64px;
            border: 0.8px solid #99A1B7;
            background: #fff;
            color: #99A1B7;
            font-size: 10px;
            font-weight: 500;
            line-height: 14px;
        }

        .jd-badge {
            padding: 4px 12px;
            border-radius: 80px;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .master-jd-badge {
            background: #E3F7FF;
            color: #1877A0;
        }

        .company-jd-badge {
            background: #FFF0CF;
            color: #A56313;
        }
    </style>

    <style>
        .navtab-btn {
            display: flex;
            border: 1px solid #F7941D;
            border-radius: 6px;
            overflow: hidden;
        }

        .navtab-btn .tab-link {
            text-align: center;
            padding: 8px 16px;
            color: #F7941D;
            background-color: #fff;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 12px;
            line-height: 16px;
        }

        .navtab-btn .tab-link.active-tab {
            background-color: #F7941D;
            color: #fff;
        }

        .search-wrapper {
            height: 32px;
            display: flex;
        }

        .search-input {
            width: 270px;
            padding: 0px 12px;
            border-radius: 4px 0px 0px 4px;
            border: 1px solid #C4CADA;
            border-right: 0;
            background: #FFF;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 400;
        }

        .search-icon {
            display: flex;
            padding: 0px 8px;
            align-items: center;
            border-radius: 0px 4px 4px 0px;
            border: 1px solid #C4CADA;
            background: #FFF;
            color: #99A1B7;
        }

        .btn-view-jd {
            border: 1px solid #ced4da;
            color: #6c757d;
            background-color: white;
        }

        .btn-view-jd i {
            margin-right: 4px;
        }

        input:focus-visible {
            outline: none !important;
            box-shadow: none !important;
        }

        .custom-btn-new {
            height: 35px;
            padding: 8px 16px;
            background: #F7941C;
            justify-content: center;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            width: fit-content;
        }

        .custom-btn.orange-fill,
        .orange-fill-popup {
            background: #F7941C;
            color: #FFF;
        }

        .orange-outline-popup {
            border: 1px solid #F7941C !important;
            background: #FFF;
            color: #F7941C;
        }

        .disable-grey-popup {
            border: 1px solid #DBDFE9 !important;
            background: #F1F1F4 !important;
            color: #99A1B7 !important;
            pointer-events: none !important;
        }

        .grey-outline-popup {
            border: 1px solid #99A1B7 !important;
            background: #FFF;
            color: #78829D;

        }

        .btn-view-jd {
            padding: 8px 16px;
            border-radius: 4px;
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #78829D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .line-h {
            width: 1px;
            height: 32px;
            background: #DDD;
        }

        .dropdown-menu.show {
            transform: translate3d(1063px, 205.5px, 0px) !important;
            width: 11%;
            border-radius: 8px;
            border: 1px solid #D9D9D9;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            padding: 8px;
        }

        .dropdown-item {
            display: flex;
            padding: 12px 16px;
            align-items: flex-start;
            gap: 4px;
            border-radius: 8px;
            color: #1E1E1E;
            font-size: 12px;
            font-style: normal;
            font-weight: 400;
            line-height: 16px;
        }

        .empty-state {
            display: flex;
            height: 70vh;
            padding: 118px 232px;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 16px;
            border-radius: 8px;
            background: #F1F1F4;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            margin-top: 28px;
        }

        .empty-state p {
            color: #4B5675;
            text-align: center;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
        }

        .sector-main {
            margin-top: 28px;
            display: flex;
            align-items: center;
            gap: 28px 31px;
            flex-wrap: wrap;
        }

        .sector-box {
            min-width: 397px;
            margin: auto;
            display: flex;
            padding: 26px 29.25px;
            flex-direction: column;
            align-items: flex-start;
            border-radius: 8.125px;
            background: #FFF;
            box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.1);
        }

        .sector-box:hover {
            background: #FFF6EA;
        }

        .sector-box img {
            margin-bottom: 16.25px;
        }

        .sector-box h4 {
            margin-bottom: 22.75px;
        }

        .custom-popup-body .modal-header {
            border-bottom: none;
            padding-bottom: 0px;
        }

        .custom-popup-body .modal-footer {
            border-top: none;
            padding-top: 0px;
        }

        .modal-footer button {
            flex: 1 0 0;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
        }

        .custom-popup-body h4 {
            margin: 16px auto 13px auto;
            color: #4B5675;
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
        }

        .custom-popup-body p {
            color: #4B5675;
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 20px;
            margin-bottom: 16px;
        }

        .manually-radio {
            position: relative;
        }

        .manually-radio input[type="radio"] {
            display: none;
        }

        .manually-radio input[type="radio"]:checked+.manually-modal-inner {
            border: 2px solid #F7941C !important;
        }

        .manually-modal-inner {
            border-radius: 16px;
            border: 2px solid #F1F1F4;
            padding: 16px;
            flex: 1 0 0;
            min-width: 32%;
            height: 150px;
            cursor: pointer;
        }

        .manually-modal-inner:hover {
            border: 2px solid #F7941C;
        }

        .manually-modal-inner .line {
            height: 2px;
            width: 100%;
            display: block;
            background-color: #F1F1F4;
        }

        .popup-proceed-button:disabled {
            border: 1px solid #DBDFE9 !important;
            background: #F1F1F4;
            color: #99A1B7;
        }
    </style>

    <style>
        .form-control:focus,
        .input-group-text:focus {
            box-shadow: none !important;
            border-color: #ced4da !important;
        }

        .create-ai .modal-body {
            padding: 48px;
        }

        .modal-step-form .nav-pills .nav-link {
            background-color: #fff;
            color: #99A1B7;
            font-size: 13.975px;
            font-weight: 500;
            display: flex;
            gap: 16px;
            align-items: center;
            padding: 0px;
        }

        .modal-step-form .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #fff;
            color: #4B5675;
            font-weight: 700;
        }

        .modal-step-form .nav-pills .nav-link .circle-gray {
            border: 2px solid #DBDFE9;
            width: 24px;
            height: 24px;
            display: block;
            background: #fff;
            border-radius: 50%;
        }

        .modal-step-form .nav-pills .nav-link .circle-gray.active {
            background: #F7941C;
        }

        .modal-step-form .line-horizontal {
            width: 2px;
            height: 25px;
            display: block;
            background: #DBDFE9;
            margin: 4px 0px 4px 11px;
        }

        .modal-step-form .nav-pills {
            width: 39%;
            padding: 16px 0px;
            margin-right: 24px;
        }

        .modal-step-form .tab-content {
            padding: 16px;
            width: 100%;
            border-radius: 8px;
            border: 1px solid #F1F1F4;
        }

        .modal-step-form .tab-content .heading {
            color: #4B5675;
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
        }

        .modal-step-form .tab-content .line {
            height: 2px;
            width: 100%;
            background-color: #F1F1F4;
            margin: 16px 0px;
        }

        .modal-step-form .tab-content .para {
            color: #4B5675;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
        }

        .modal-sector-text {
            color: #99A1B7;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
        }

        .modal-jd-heading {
            color: #4B5675;
            font-size: 32.5px;
            font-weight: 600;
            line-height: 39px;
            margin-bottom: 24px;
        }

        .modal-step-form .accordion-header {
            color: #555;
            font-size: 16.25px;
            font-weight: 400;
            line-height: 24px;
            letter-spacing: 0.15px;
            border-bottom: 1px solid #F1F1F4;
            cursor: pointer;
            margin-top: 8px;
            /* transition: background 0.3s; */
        }

        .modal-step-form .accordion-header.open {
            padding: 19.5px 24px 0px 24px;
            border-radius: 8.13px 8.13px 0px 0px;
            color: #1E2129;
            font-weight: 700;
        }

        .modal-step-form .critical-accordion .accordion-header.open {
            background: #E2F6F6;
            border-bottom: 1px solid #E2F6F6;
        }

        .modal-step-form .generic-accordion .accordion-header.open {
            background: #F2EEFD;
            border-bottom: 1px solid #F2EEFD;
        }

        .modal-step-form .technical-accordion .accordion-header.open {
            border-bottom: 1px solid #FFF6EA;
            background: #FFF6EA;
        }

        .modal-step-form .accordion-icon {
            display: block;
            width: 24px;
            height: 24px;
        }

        .accordion-icon-on {
            display: none;
        }

        .accordion-header.open .accordion-icon-on {
            display: inline-block !important;
        }

        .accordion-header.open .accordion-icon-off {
            display: none !important;
        }

        .modal-step-form .bg-open-accordion {
            padding: 0px 19.5px 19.5px;
            border-radius: 0px 0px 8.13px 8.13px;
        }

        .modal-step-form .critical-accordion .bg-open-accordion {
            background: #E2F6F6;
        }

        .modal-step-form .generic-accordion .bg-open-accordion {
            background: #F2EEFD;
        }

        .modal-step-form .technical-accordion .bg-open-accordion {
            background: #FFF6EA;
        }

        .modal-step-form .generic-accordion .star-generic {
            color: #997BF2;
        }

        .modal-step-form .technical-accordion .star-technical {
            color: #F7941D;
        }

        .form-check-input:checked {
            background-color: #F7941D;
            border-color: #F7941D;
        }

        .hide-button {
            display: none !important;
        }

        .modal-body h4 {
            color: #071437;
            font-size: 32.5px;
            font-style: normal;
            font-weight: 600;
            line-height: 39px;
        }

        .modal-body .para {
            color: #071437;
            text-align: center;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
            margin: 24px 0px;
        }

        .custom-dropdown-select .dropdown {
            position: relative;
        }

        .custom-dropdown-select .dropdown-list {
            position: absolute;
            top: 57px;
            left: 0;
            right: 0;
            z-index: 99;
            border-top: none;
            max-height: 280px;
            overflow-y: auto;
            display: none;
            border-radius: 4px;
            border: 1px solid #DBDFE9;
            background: #FFF;
        }

        .dropdown-list {
            display: none;
        }

        .dropdown-list.active {
            display: block;
        }

        .custom-dropdown-select .dropdown-items-container {
            overflow-y: auto;
            flex: 1 1 auto;
        }

        .custom-dropdown-select .add-job-btn {
            position: sticky;
            bottom: 0;
            padding: 12px 12px 20px 12px;
            z-index: 10;
            background: #fff;
        }

        .custom-dropdown-select .add-job-btn button {
            padding: 12px 18px;
            gap: 8px;
            border-radius: 4px;
            border: 1px solid #F7941C;
            background: #FFF;
            color: #F7941C;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            cursor: pointer;
            box-sizing: border-box;
            background-clip: padding-box;
            transition: background 0.2s;
            width: 100%;
            display: flex;
        }


        .custom-dropdown-select .add-job-btn button:hover {
            background: #F7941C;
            color: #fff;
        }

        .custom-dropdown-select .dropdown-item {
            padding: 12px 20px;
            cursor: pointer;
            display: flex;
            gap: 8px;
            align-items: center;
            color: #000;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }

        .custom-dropdown-select .dropdown-item:hover {
            background-color: #FFF6EA;
            border-radius: 0px;
        }

        .custom-dropdown-select .pill {
            padding: 6px 12px;
            border-radius: 80px;
            text-align: center;
            font-size: 10px;
            font-weight: 600;
            line-height: 14px;
            margin-right: 8px;
        }

        .custom-dropdown-select .pill.localised {
            background: #F2EEFD;
            color: #6652A1;
        }

        .custom-dropdown-select .pill.pending {
            background: #FFEBB4;
            color: #EB8100;
        }

        .custom-dropdown-select .pill.approved {
            background: #DDF5E2;
            color: #196329;
        }

        .custom-dropdown-select .job-entry {
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
        }

        .custom-dropdown-select .tags {
            display: flex;
        }

        .create-ai .alert-dismissible {
            padding: 24px;
        }

        .create-ai .alert-success {
            border-radius: 8px;
            border: 1px solid #BBECC5;
            background: #DDF5E2;
            color: #071437;
            font-size: 13.975px;
            font-weight: 500;
            line-height: 16.77px;
            margin-bottom: 28px;
        }

        .create-ai .alert-dismissible .close {
            top: 11px;
        }

        .dropdown-item.active {
            background-color: #FFF6EA;
            border-radius: 0px;
        }

        .close-icon {
            position: absolute;
            right: 16px;
            top: 16px;
            color: #99A1B7;
            cursor: pointer;
        }

        #job_description::placeholder {
            color: #78829D;
            opacity: 1;
        }
    </style>

@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">

                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/jobs/index" class="text-muted text-hover-primary">Job Management</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('jobs.savedJobs', ['saved_job' => 1]) }}"
                            class="text-muted text-hover-primary">Company JDs</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted" id="breadcrumbText"></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl">
            <section class="create-ai">
                @if (session('alert'))
                    <x-alert :type="session('alert.type')" :message="session('alert.message')" />
                @endif
                <div class="top-card mb-15">
                    <div class="card-header">
                        {{-- <p class="m-0 d-flex align-items-center gap-2"><iconify-icon icon="f7:sparkles" class="mr-1"
                                width="24" height="24"></iconify-icon> Select Job Position</p> --}}
                        <p class="m-0 d-flex align-items-center gap-2" data-role="job-position">
                            <iconify-icon icon="f7:sparkles" class="mr-1" width="24" height="24"></iconify-icon>
                            Select Job Position
                        </p>
                    </div>
                    <div class="card-inner">
                        <form id="matchForm">
                            <div class="form-group d-flex justify-content-evenly col-lg-12 p-0" style="gap: 24px">
                                {{-- {{ dd($cachedJobData) }} --}}
                                <livewire:business-unit-select :selected-business-unit="isset($cachedJobData) && $cachedJobData['jd_type'] == 'company-jd'
                                    ? $cachedJobData['business_unit_id']
                                    : null" />

                                {{-- <livewire:division-select :selected-division="(isset($cachedJobData) && $cachedJobData['jd_type'] == 'company-jd')? $cachedJobData['selected_job_family_group'] : null" /> --}}
                                <livewire:division-select :selected-division="isset($cachedJobData) && $cachedJobData['jd_type'] == 'company-jd'
                                    ? $cachedJobData['selected_job_family_group']
                                    : null" :business-unit-id="isset($cachedJobData) && $cachedJobData['jd_type'] == 'company-jd'
                                    ? $cachedJobData['business_unit_id']
                                    : null"
                                    wire:disabled="!$selectedBusinessUnit" />


                                <livewire:department-select :selected-department="isset($cachedJobData) && $cachedJobData['jd_type'] == 'company-jd'
                                    ? $cachedJobData['selected_job_family']
                                    : null" :division-id="isset($cachedJobData) && $cachedJobData['jd_type'] == 'company-jd'
                                    ? $cachedJobData['selected_job_family_group']
                                    : null" />

                            </div>

                            <livewire:job-profile-select :selected-job-profile="isset($cachedJobData) && $cachedJobData['jd_type'] == 'company-jd'
                                ? $cachedJobData['job_profile_id']
                                : null" :department-id="isset($cachedJobData) && $cachedJobData['jd_type'] == 'company-jd'
                                ? $cachedJobData['selected_job_family']
                                : null"
                                wire:model="selectedJobProfile" />



                            <div class="form-group mt-5 col-lg-12 p-0">
                                {{-- <label for="job_description">Job Description from {{ env('APP_NAME') }}</label> --}}
                                <label for="job_description" class="fw-semibold fs-6 mb-2">Current Job Description</label>

                                <textarea id="job_description" class="form-control" rows="5" placeholder="Auto-filled job description..."
                                    disabled></textarea>
                            </div>

                            {{-- <div class="form-check mt-5">
                                <input class="form-check-input" type="checkbox" name="company_jd" value=""
                                    id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Include Company JD in search
                                </label>
                            </div> --}}

                            <div class="text-end mt-5">
                                {{-- {{ dd($jd_type) }} --}}
                                @if (isset($jdType) && $jdType == 'AI-jd')
                                    <button type="submit"
                                        class="custom-btn orange-fill formSubmitBtn disable-grey-popup">Show Me Related JD
                                    </button>
                                @else
                                    <button type="button" class="custom-btn orange-fill formSubmitBtn disable-grey-popup"
                                        id="customJdBtn">Customise this Job
                                        Position</button>
                                @endif
                            </div>
                        </form>
                    </div>

                </div>

                <!-- Heading (Initially hidden) -->
                <p id="searchHeading" class="heading m-0" style="display: none;">
                    Here are the top matches with ‘<span id="jobTitleSpan"></span>’:
                </p>

                <!-- Card Container -->
                <div id="jdResultsContainer" class="main-card my-11"></div>

                <!-- Load More + Create JD Manually Section -->
                <div id="loadMoreSection" class="text-center my-4" style="display: none;">
                    <div class="button-card mb-3">
                        <button id="loadMoreBtn"
                            class="custom-btn orange-fill border-0 d-flex align-items-center gap-2 m-auto h-auto">
                            <iconify-icon icon="f7:sparkles" class="mr-1" width="24" height="24"></iconify-icon>
                            Generate More Result
                        </button>
                    </div>

                    <div class="creat-jd-manually text-center">
                        <p class="heading mb-5 m-auto">Can't find a match? Would you like to create a job description
                            manually?
                        </p>
                        <button class="custom-btn orange-outline d-flex align-items-center gap-2 m-auto h-auto"
                            data-bs-toggle="modal" href="#CreateJDManually">
                            Create JD Manually <iconify-icon icon="prime:pencil" width="16"
                                height="16"></iconify-icon>
                        </button>
                    </div>
                </div>

                <!--selectingJD Modal -->
                <div class="modal fade" id="selectingJD" tabindex="-1" aria-labelledby="selectingJDLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="max-width: 68%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 fw-medium" id="selectingJDLabel">JD Preview</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="modal-sector-text mb-1">Air Transport</p>
                                <h4 class="modal-jd-heading">Turnaround Coordinator</h4>
                                @include('admin.job-management.selecting-jd')
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="createFromJD" class="custom-btn orange-fill border-0 h-auto"
                                    style="
                                flex: none;
                            ">Create
                                    from This
                                    JD</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="modal fade" id="OverwriteCompanySkillConfirmModal" tabindex="-1" aria-labelledby="EditTsfromMSLLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <iconify-icon icon="ic:round-close" width="24" height="24" class="close-icon"
                        data-bs-dismiss="modal"></iconify-icon>
                    <iconify-icon icon="ep:warning" width="70" height="70" class="mb-2"
                        style="color: #F8BB86;"></iconify-icon>
                    <h4 class="m-0">Overwrite Localised <br> Job Position?</h4>
                    <p class="para">This job position was previously localised. To continue, select this job position.
                        Please note that any changes made will overwrite your previous modifications.</p>
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <button class="btn btn-outline m-0" data-bs-dismiss="modal">Cancel</button>
                        <button id="OverwriteContinueEditSkillBtn" class="btn btn-apply text-white m-0"
                            style="background: #F7941C;">
                            Overwrite this Job Position
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.job-management.modals.manual_job_create_modal')


@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const companyJdDiv = document.getElementById('companyJdDiv');

            if (!companyJdDiv) {
                console.error("Element with id 'companyJdDiv' not found.");
                return;
            }

            if (jdType === 'custom-jd') {
                companyJdDiv.style.display = 'none';
            } else {
                companyJdDiv.style.display = '';
            }
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const cacheKey = urlParams.get('cache_key');
            const currentPath = window.location.pathname;
            console.log('Cache Key:', cacheKey);
            console.log('Current Path:', currentPath);

            let title = 'Custom JD';

            if (currentPath.includes('/create/Ai')) {
                title = 'Match & Generate JD with AI';
            } else if (cacheKey?.includes('master-jd')) {
                title = 'Master JD';
            } else if (cacheKey?.includes('company-jd')) {
                title = 'Company JD';
            }

            // Update both heading and breadcrumb
            document.querySelector('h1.page-heading').textContent = title;
            document.getElementById('breadcrumbText').textContent = title;
        });
    </script>

    <script>
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const cacheKey = urlParams.get('cache_key') || '';
    const currentPath = window.location.pathname;
 
    // Determine jobdesc_type and UI title
    let jobdesc_type = 'custom-jd'; // default
    let title = 'Based on Custom JD';
    let jobPositionText = 'Select Job Position';
 
    if (currentPath.includes('/create/Ai')) {
        jobdesc_type = 'AI-jd';
        title = jobPositionText = 'Match & Generate JD with AI';
    } else if (cacheKey.includes('master-jd')) {
        jobdesc_type = 'master-jd';
        title = 'Based on Master JD';
    } else if (cacheKey.includes('company-jd')) {
        jobdesc_type = 'company-jd';
        title = 'Based on Company JD';
    }
 
    console.log('Cache Key:', cacheKey);
    console.log('Current Path:', currentPath);
 
    // Update heading and breadcrumb
    const heading = document.querySelector('h1.page-heading');
    const breadcrumb = document.getElementById('breadcrumbText');
    if (heading) heading.textContent = title;
    if (breadcrumb) breadcrumb.textContent = title;
 
    // Update job position display
    const jobPositionElement = document.querySelector('p[data-role="job-position"]');
    if (jobPositionElement) {
        jobPositionElement.textContent = ''; // Clear existing
 
        // icon only for AI case
        if (currentPath.includes('/create/Ai')) {
            const icon = document.createElement('iconify-icon');
            icon.setAttribute('icon', 'f7:sparkles');
            icon.setAttribute('width', '24');
            icon.setAttribute('height', '24');
            icon.classList.add('mr-1');
            jobPositionElement.appendChild(icon);
        }
 
        jobPositionElement.appendChild(document.createTextNode(` ${jobPositionText}`));
    }

    // const jobPositionElement = document.querySelector('p[data-role="job-position"]');
    //         if (jobPositionElement) {
    //             jobPositionElement.textContent = ''; // Clear existing
    //             const icon = document.createElement('iconify-icon');
    //             icon.setAttribute('icon', 'f7:sparkles');
    //             icon.setAttribute('width', '24');
    //             icon.setAttribute('height', '24');
    //             icon.classList.add('mr-1');
    //             // jobPositionElement.append(icon, document.createTextNode(` ${jobPositionText}`));
    //             if (jdType !== 'custom-jd') {
    //                 jobPositionElement.appendChild(icon);
    //             }
    //             jobPositionElement.appendChild(document.createTextNode(` ${jobPositionText}`));
    //         }
});
    </script>




    <script>
        const cachedJobData = @json($cachedJobData ?? []);
        const jdType = @json($jdType);
        console.log('Cached Job Data:', cachedJobData);
        console.log('JD Type:', jdType);
        selectedRoleLocalized = 0;
        jobRoleName = null;
        jobRole = null;
        businessUnit = null;
        jobFamilyGroup = null;
        jobFamily = null;

        jobProfileDescription = null;
        jobFamilyGroupName = null;
        jobFamilyName = null;

        const roleSelect = document.querySelector('.dropdown-items-container'); // The parent of the dropdown items
        const descriptionBox = document.getElementById('job_description'); // The job description box
        const formSubmitBtn = document.querySelector('.formSubmitBtn');
    </script>
    {{-- dropdown start --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {


            function updateDescriptionBox(selectedJobProfile) {
                if (!selectedJobProfile) {
                    descriptionBox.value = '';
                    descriptionBox.setAttribute('disabled', 'disabled');
                    descriptionBox.setAttribute('placeholder', 'Job Description.');
                    formSubmitBtn.classList.add('disable-grey-popup'); // disable submit if you want
                } else {
                    descriptionBox.removeAttribute('disabled');
                    descriptionBox.setAttribute('placeholder', 'Auto-filled job description...');
                    formSubmitBtn.classList.remove('disable-grey-popup');
                }
            }

            // Listen for Livewire dispatched event
            window.addEventListener('job-profile-changed', event => {
                const selectedJobProfile = event.detail.selectedJobProfile;
                updateDescriptionBox(selectedJobProfile);
            });

            // Initial disable state on page load (optional)
            updateDescriptionBox(null);



            const dropdownList = document.querySelector(".dropdown-list");
            const selectedTitle = document.querySelector(".selected-title");
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'selectedJobTitle'; // Adjust the name as needed
            dropdownList.closest('.custom-dropdown-select').appendChild(hiddenInput);

            function toggleDropdown() {
                dropdownList.classList.toggle("active");
            }

            function selectJob(jobTitle, jobSpan) {
                const dropdownBtn = document.querySelector(".dropdown-btn");
                const selectedTitle = dropdownBtn.querySelector(".selected-title");

                // Update selected job title text
                selectedTitle.textContent = jobTitle;

                // Store the selected value in the hidden input
                hiddenInput.value = jobTitle;

                // Remove the 'selected' attribute and 'active' class from all previously selected items
                document.querySelectorAll('.dropdown-item[selected]').forEach(item => {
                    item.removeAttribute('selected');
                    item.classList.remove('active');
                });

                // Add 'selected' attribute and 'active' class to the newly selected item
                jobSpan.closest('.dropdown-item').setAttribute('selected', true);
                jobSpan.closest('.dropdown-item').classList.add('active');

                // Remove any existing pill elements inside the dropdown button (preserving only the selected-title)
                dropdownBtn.querySelectorAll(".pill").forEach(pill => pill.remove());

                // Find all pill elements inside the selected dropdown item and clone them into the dropdown button
                const pills = jobSpan.closest('.dropdown-item').querySelectorAll(".pill");
                pills.forEach(pill => {
                    const pillClone = pill.cloneNode(true); // Deep clone the pill element
                    dropdownBtn.appendChild(pillClone); // Append cloned pill next to selected-title
                });

                // Close dropdown after selection
                toggleDropdown();
            }


            // if (typeof jdType !== 'undefined' && jdType === 'company-jd' && cachedJobData) {


            //     function initializeSelectedJobProfile() {

            //         const selectedJobProfile = cachedJobData.job_profile_id // Assuming this is passed from server-side
            //         const jobProfiles = document.querySelectorAll('.dropdown-item');

            //         jobProfiles.forEach(item => {
            //             const profileId = item.getAttribute('data-value');
            //             if (parseInt(profileId) === parseInt(selectedJobProfile)) {
            //                 const jobTitle = item.querySelector('span').textContent;
            //                 selectJob(jobTitle, item);
            //             }
            //         });
            //     }
            // // }
            // initializeSelectedJobProfile();

            // Using event delegation to handle item selection
            document.querySelector('.dropdown-items-container').addEventListener('click', function(event) {
                const item = event.target.closest('.dropdown-item');
                if (item) {
                    const jobTitle = item.querySelector('span').textContent;
                    selectJob(jobTitle, item);
                }
            });


            // Open dropdown when the dropdown button is clicked
            const dropdownButton = document.querySelector(".dropdown-btn");
            dropdownButton.addEventListener("click", function(event) {
                console.log('opennnn');

                toggleDropdown(); // Open the dropdown
                event.stopPropagation(); // Prevent event from bubbling up to the document listener
            });

            // Close dropdown when clicking outside
            document.addEventListener("click", function(event) {
                // Check if the click is outside the dropdown button and the dropdown list
                const dropdownButton = document.querySelector(".dropdown-btn");
                if (!dropdownButton.contains(event.target) && !dropdownList.contains(event.target)) {
                    // Close dropdown if not clicked on the button or list
                    dropdownList.classList.remove("active");
                }
            });



            // Attach event listener to the dropdown container (delegation pattern)
            roleSelect.addEventListener('click', function(event) {
                const item = event.target.closest('.dropdown-item');
                businessUnit = $('#business_unit').val();
                jobFamilyGroup = $('#division').val();
                jobFamily = $('#department').val();
                jobProfileDescription = $('#job_description').val();
                jobFamilyGroupName = $('#division option:selected').text();
                jobFamilyName = $('#department option:selected').text();
                console.log('dropdown itemmm',item);
                if (item) {
                    // Get the selected value and description from the data attributes
                    const selectedValue = item.getAttribute('data-value');
                    jobRole = selectedValue;
                    jobRoleName = item.getAttribute('data-name');
                    selectedRoleLocalized = item.getAttribute('data-islocalized') ?? 0;
                    const descText = item.getAttribute('data-desc') || '';

                    // Clean description text as per your earlier code
                    let cleanedDescText = descText;
                    if (cleanedDescText && cleanedDescText !== 'null') {
                        cleanedDescText = cleanedDescText
                            .replace(/â—/g, '') // Remove junk bullets
                            .replace(/•/g, '') // Remove actual bullet characters
                            .replace(/â€™/g, "'") // Fix apostrophes
                            .replace(/â€œ|â€�/g, '"') // Fix quotes
                            .replace(/â€“/g, '-') // Fix dashes
                            .replace(/\s+/g, ' ') // Collapse multiple spaces
                            .trim();

                        descriptionBox.value = cleanedDescText;
                        descriptionBox.removeAttribute('disabled');
                        formSubmitBtn.classList.remove('disable-grey-popup');
                    } else {
                        descriptionBox.value = '';
                        
                        // descriptionBox.setAttribute('disabled');
                        // formSubmitBtn.classList.add('disable-grey-popup');

                        descriptionBox.setAttribute('placeholder',
                            'No description available for this job position.');
                    }
                    descriptionBox.removeAttribute('disabled');
                        formSubmitBtn.classList.remove('disable-grey-popup');

                    // Optionally, you can do something with the selectedValue (e.g., save it in a hidden field or update the UI)
                    console.log('Selected Job Position ID:', selectedValue);
                }
            });
        });

        function populateSelect(selectElement, options) {
            // selectElement.innerHTML = '<option value="">Select an option</option>'; // Clear existing options
            options.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option.id;
                optionElement.textContent = option.name;
                selectElement.appendChild(optionElement);
            });
        }

        function validatePositionCode(event) {
            let inputValue = event.target.value;

            // Capitalize first letter
            if (inputValue) {
                inputValue = inputValue.charAt(0).toUpperCase() + inputValue.slice(1);
            }

            // Regex to allow alphanumeric characters and no special characters
            const regex = /^[A-Za-z0-9]*$/;

            // Get the error message span element
            const errorSpan = document.getElementById('positionCode');

            // If input matches the regex and is not too long
            if (regex.test(inputValue) && inputValue.length <= 10) {
                // Update the value with the first letter capitalized
                event.target.value = inputValue;
                errorSpan.textContent = ''; // Clear error message
            } else {
                // If it doesn't match the regex, prevent the user from entering special characters
                event.target.value = inputValue.slice(0, -1);

                // If the length exceeds 10 characters, display an error message
                if (inputValue.length > 10) {
                    errorSpan.textContent = 'Position Code cannot be more than 10 characters.';
                } else {
                    errorSpan.textContent = ''; // Clear error message if it's valid again
                }
            }
        }


        // Load Company/Division options based on selected Business Unit
        function loadSectorOptions(modalEl, businessUnitId, selectedSectorValue = null) {
            showOverlay();

            fetch(`/admin/ajax/divisions/${businessUnitId}`)
                .then(res => res.json())
                .then(sectorOptions => {
                    const sectorSelect = modalEl.querySelector('#modalDivision');

                    sectorSelect.innerHTML = '<option value="">Select Company/Division</option>'; // Clear existing options
                    sectorOptions.forEach(option => {
                        const optionElement = document.createElement('option');
                        optionElement.value = option.id;
                        optionElement.textContent = option.head_of_division;
                        sectorSelect.appendChild(optionElement);
                    });
                    sectorSelect.value = selectedSectorValue;
                    sectorSelect.disabled = false; // Enable the sector dropdown once options are loaded
                    hideOverlay();
                })
                .catch(error => {
                    console.error('Error fetching sector options:', error);
                    hideOverlay();
                });
        }

        // Load Department options based on selected Company/Division
        function loadTrackOptions(modalEl, sectorId, selectedTrackValue) {
            showOverlay();

            fetch(`/admin/ajax/departments/${sectorId}`)
                .then(res => res.json())
                .then(trackOptions => {
                    const trackSelect = modalEl.querySelector('#modalDepartment');
                     trackSelect.innerHTML = '<option value="">Select Department</option>';
                    populateSelect(trackSelect, trackOptions); // Populate Track dropdown based on selected Sector
                    trackSelect.value = selectedTrackValue;
                    trackSelect.disabled = false; // Enable the track dropdown once options are loaded
                    hideOverlay();
                })
                .catch(error => {
                    console.error('Error fetching track options:', error);
                    hideOverlay();
                });
        }

        function displayErrors(errors) {
            console.log('in display funciton', errors);

            // Loop through the errors object
            for (const [field, errorMessages] of Object.entries(errors)) {
                const errorMessage = errorMessages[0]; // Assuming you only need the first error message
                const errorField = document.getElementById(`${field}`);

                if (errorField) {
                    // Assuming the error message will be displayed next to the field
                    console.log('in display field', errorField);
                    console.log('in display field', errorMessage);


                    if (errorField) {
                        errorField.innerText = errorMessage;
                    }
                }
            }
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navLinks = document.querySelectorAll(".nav-link");

            navLinks.forEach((link) => {
                link.addEventListener("click", function() {
                    document.querySelectorAll(".circle-gray").forEach((span) => {
                        span.classList.remove("active");
                    });
                    const span = this.querySelector(".circle-gray");
                    if (span) {
                        span.classList.add("active");
                    }
                });
            });
        });
    </script>

    <script>
        function initializeAccordion(containerSelector) {
            console.log(`Initializing accordion for container: ${containerSelector}`);

            const container = document.querySelector(containerSelector);
            if (!container) {
                console.warn(`Accordion container ${containerSelector} not found.`);
                return;
            } else {
                console.log(`Accordion container found.`);
            }

            const headers = container.querySelectorAll('.accordion-header');
            console.log(`Found ${headers.length} accordion header(s) inside ${containerSelector}.`);

            headers.forEach((header, index) => {
                const targetId = header.getAttribute('data-bs-target');
                console.log(`Header ${index + 1}: data-bs-target is '${targetId}'.`);

                const collapseEl = document.querySelector(targetId);
                if (!collapseEl) {
                    console.warn(`Collapse element '${targetId}' not found for header ${index + 1}.`);
                    return;
                } else {
                    console.log(`Collapse element '${targetId}' found.`);
                }

                // Initialize aria-expanded and classes based on initial state
                if (collapseEl.classList.contains('show')) {
                    header.classList.add('open');
                    header.classList.remove('collapsed');
                    header.setAttribute('aria-expanded', 'true');
                    console.log(`Collapse element '${targetId}' is initially open.`);
                } else {
                    header.classList.remove('open');
                    header.classList.add('collapsed');
                    header.setAttribute('aria-expanded', 'false');
                    console.log(`Collapse element '${targetId}' is initially closed.`);
                }

                // Click event listener
                header.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log(`Header ${index + 1} clicked.`);

                    const isCurrentlyOpen = header.getAttribute('aria-expanded') === 'true';
                    console.log(`Header ${index + 1} is currently ${isCurrentlyOpen ? 'open' : 'closed'}.`);

                    let bsCollapse = bootstrap.Collapse.getInstance(collapseEl);
                    if (!bsCollapse) {
                        console.log(`Creating new Bootstrap collapse instance for '${targetId}'.`);
                        bsCollapse = new bootstrap.Collapse(collapseEl, {
                            parent: containerSelector,
                        });
                    } else {
                        console.log(`Using existing Bootstrap collapse instance for '${targetId}'.`);
                    }

                    if (isCurrentlyOpen) {
                        console.log(`Hiding collapse element '${targetId}'.`);
                        bsCollapse.hide();
                    } else {
                        console.log(`Showing collapse element '${targetId}'.`);
                        bsCollapse.show();
                    }
                });

                // Bootstrap collapse show event
                collapseEl.addEventListener('show.bs.collapse', () => {
                    console.log(`Collapse element '${targetId}' is showing.`);
                    header.classList.add('open');
                    header.classList.remove('collapsed');
                    header.setAttribute('aria-expanded', 'true');
                });

                // Bootstrap collapse hide event
                collapseEl.addEventListener('hide.bs.collapse', () => {
                    console.log(`Collapse element '${targetId}' is hiding.`);
                    header.classList.remove('open');
                    header.classList.add('collapsed');
                    header.setAttribute('aria-expanded', 'false');
                });

            });
        }
    </script>

    <script>
        $(document).ready(function() {
            let allJobs = [];
            let currentIndex = 0;
            const limitPerClick = 5;
            let latestJobData = null;
            let allowLocalizedSubmit = false;
            let isSubmitting = false;

            function renderJobs(jobs) {
                const levelToNumber = {
                    'Basic': 1,
                    'Intermediate': 2,
                    'Advanced': 3
                };
                jobs.forEach((jd) => {
                    const card = `
                        <div class="main-card-inner" data-id="${jd.job_id}" data-bs-toggle="modal" data-bs-target="#selectingJD">
                            <div class="header d-flex align-items-center justify-content-between">
                                <span class="sector">${jd.sector_name || 'Air Transport'}</span>
                                <span class="jd-badge ${jd.type === 'Company JD' ? 'company-jd-badge' : 'master-jd-badge'}">${jd.type || 'Master JD'}</span>
                            </div>
                            <h4 class="my-5">${jd.title}</h4>
                            <p class="para-clip m-0">${jd.description}</p>
                            <div class="my-5 badge-main-div">
                                <p class="heading mb-2">Generic Skill</p>
                                <div class="badge-inner-div d-flex align-items-center flex-wrap">
                                    ${(jd.soft_skills || []).map(skill => `
                                                                                            <div class="badge-div generic-div">
                                                                                                <span class="d-flex align-items-center">${skill.competency}
                                                                                                    <span class="d-flex align-items-center">
                                                                                                        <iconify-icon class="star-color" icon="material-symbols:star" width="13" height="13"></iconify-icon> ${levelToNumber[skill.preferred_level] ?? skill.preferred_level}
                                                                                                    </span>
                                                                                                </span>
                                                                                            </div>
                                                                                        `).join('')}
                                </div>
                            </div>
                            <div class="badge-main-div">
                                <p class="heading mb-2">Technical Skill</p>
                                <div class="badge-inner-div d-flex align-items-center flex-wrap">
                                    ${(jd.technical_skills || []).slice(0, 5).map(skill => `
                                                                                                <div class="badge-div technical-div">
                                                                                                    <span class="d-flex align-items-center">${skill.name}
                                                                                                        <span class="d-flex align-items-center">
                                                                                                            <iconify-icon class="star-color" icon="material-symbols:star" width="13" height="13"></iconify-icon> ${skill.preferred_level}
                                                                                                        </span>
                                                                                                    </span>
                                                                                                </div>
                                                                                            `).join('')}
                                    ${jd.technical_skills && jd.technical_skills.length > 5 ? `<div class="btn-more-skills">+ ${jd.technical_skills.length - 5} more skills</div>` : ''}
                                </div>
                            </div>
                        </div>`;
                    $('#jdResultsContainer').append(card);
                });
            }

            $('form').on('submit', function(e) {
                e.preventDefault();

                if (isSubmitting) return;
                isSubmitting = true;


                const includeCompanyJD = $('#flexCheckDefault').is(':checked') ? 1 : 0;

                console.log('payload', jobFamilyGroup, jobFamily, jobRole)
                if (!jobFamilyGroup || !jobFamily || !jobRole) {
                    alert('Please complete all fields: Company/Division, Department and Job Position.');
                    isSubmitting = false;
                    return;
                }

                // const isLocalized = jobRoleName.includes('(Localized)');

                // if (selectedRoleLocalized != 0 && !allowLocalizedSubmit) {
                //     const localizedName = jobRoleName;
                //     $('#overwriteCompanySkillName').text(localizedName);
                //     $('#affectedJobList').text('Affected This Job');
                //     $('#OverwriteContinueEditSkillBtn')
                //         .data('localized-key', localizedName)
                //         .data('is-localized', true);
                //     $('#OverwriteCompanySkillConfirmModal').modal('show');
                //     isSubmitting = false;
                //     return;
                // }

                if (promptForOverwriteIfNeeded(() => $('#matchForm').trigger('submit'))) {
                    isSubmitting = false;
                    return;
                }

                $('#jdResultsContainer').empty();
                $('#searchHeading').hide();
                $('#loadMoreSection').hide();
                $('#loadMoreBtn').show();
                currentIndex = 0;
                allJobs = [];

                $('#jobTitleSpan').text(jobRoleName);
                $('#searchHeading').fadeIn();

                showOverlay();

                $.ajax({
                    url: '/api/jobs/non-primary',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        job_role: jobRole,
                        business_unit: businessUnit,
                        job_family_group: jobFamilyGroup,
                        job_family: jobFamily,
                        job_family_group_name: jobFamilyGroupName,
                        job_family_name: jobFamilyName,
                        job_role_name: jobRoleName,
                        job_profile_description: $('#job_description').val(),
                        company_jd: includeCompanyJD
                    }),
                    success: function(data) {
                        let jds = data.jobs || [];

                        if (jds.length === 0) {
                            $('#jdResultsContainer').html(
                                '<p class="text-center">No results found.</p>');
                            hideOverlay();
                            isSubmitting = false;
                            return;
                        }

                        const localizedKey = $('#OverwriteContinueEditSkillBtn').data(
                            'localized-key');
                        if (allowLocalizedSubmit && localizedKey) {
                            jds = jds.map(job => ({
                                ...job,
                                is_localized_job: true,
                                localized_override_key: localizedKey
                            }));
                        }

                        allJobs = jds;
                        currentIndex = 0;
                        $('#jdResultsContainer').empty();
                        renderJobs(allJobs.slice(currentIndex, currentIndex + limitPerClick));
                        currentIndex += limitPerClick;

                        $('#loadMoreSection').show();
                        $('#loadMoreBtn').removeClass('hide-button');
                        hideOverlay();

                        if (currentIndex >= allJobs.length) {
                            $('#loadMoreBtn').addClass('hide-button');
                        }

                        isSubmitting = false;
                    },
                    error: function() {
                        $('#jdResultsContainer').html(
                            '<p class="text-danger">Error fetching job descriptions.</p>');
                        hideOverlay();
                        isSubmitting = false;
                    }
                });
            });

            $('#loadMoreBtn').on('click', function() {
                const nextSlice = allJobs.slice(currentIndex, currentIndex + limitPerClick);
                renderJobs(nextSlice);
                currentIndex += nextSlice.length;

                if (currentIndex >= allJobs.length) {
                    $('#loadMoreBtn').addClass('hide-button');
                }
            });

            if (typeof jdType !== 'undefined' && jdType === 'AI-jd') {


                // $('#OverwriteContinueEditSkillBtn').off('click').on('click', function() {
                //     allowLocalizedSubmit = true;

                //     // Wait for modal to fully close before triggering submit
                //     $('#OverwriteCompanySkillConfirmModal')
                //         .one('hidden.bs.modal', function() {
                //             $('form').trigger('submit');
                //         })
                //         .modal('hide');
                // });
            }

            // Card click to populate modal
            $(document).on('click', '.main-card-inner', function() {
                const jobId = $(this).data('id');
                const job = allJobs.find(j => j.job_id === jobId);
                if (!job) return;

                latestJobData = job;

                $('.modal-sector-text').text(job.sector_name || 'Air Transport');
                $('.modal-jd-heading').text(job.title || '-');
                $('#job-description .para').text(job.description || '-');

                // Generic Skills
                let genericHtml = '';
                const levelToNumber = {
                    'Basic': 1,
                    'Intermediate': 2,
                    'Advanced': 3
                };
                (job.soft_skills || []).forEach((skill, i) => {
                    genericHtml += `
                <div class="mb-0 generic-accordion">
                <div class="accordion-header p-6 d-flex accordion-border align-items-center"
                    data-bs-target="#kt_accordion_generic_item_${i + 1}" aria-expanded="false">
                    <span class="accordion-icon me-3">
                    <iconify-icon icon="gravity-ui:circle-plus-fill" class="accordion-icon-off fs-3" style="color: #997BF2;"></iconify-icon>
                    <iconify-icon icon="zondicons:minus-outline" class="accordion-icon-on fs-3" style="color: #997BF2;"></iconify-icon>
                    </span>
                    <span class="accordion-title d-flex align-items-center justify-content-between w-100">
                    ${skill.competency}
                    <span class="d-flex align-items-center star-generic">
                        <iconify-icon icon="material-symbols:star" width="16" height="16"></iconify-icon>
                        ${levelToNumber[skill.preferred_level] ?? skill.preferred_level}
                    </span>
                    </span>
                </div>
                <div id="kt_accordion_generic_item_${i + 1}" class="fs-6 collapse bg-open-accordion" data-bs-parent="#kt_accordion_generic">
                    <div><p class="m-0">${skill.description || '-'}</p></div>
                </div>
                </div>`;
                });
                $('#kt_accordion_generic').html(genericHtml);
                initializeAccordion('#kt_accordion_generic');

                // Technical Skills


                let techHtml = '';
                (job.technical_skills || []).forEach((skill, i) => {
                    const level = skill.preferred_level ||
                        1; // Fallback to level 1 if not specified

                    const knowledgeItems = Array.isArray(skill[`level_${level}_knowledge`]) ?
                        skill[`level_${level}_knowledge`] : [];

                    const abilityItems = Array.isArray(skill[`level_${level}_ability`]) ?
                        skill[`level_${level}_ability`] : [];

                    techHtml += `
                            <div class="mb-0 technical-accordion">
                                <input type="hidden" name="is_custom" value="${skill.is_custom ?? 0}">
                                <div class="accordion-header p-6 d-flex accordion-border align-items-center"
                                    data-bs-target="#kt_accordion_technical_item_${i + 1}" aria-expanded="false">
                                    <span class="accordion-icon me-3">
                                        <iconify-icon icon="gravity-ui:circle-plus-fill" class="accordion-icon-off fs-3" style="color: #F7941D;"></iconify-icon>
                                        <iconify-icon icon="zondicons:minus-outline" class="accordion-icon-on fs-3" style="color: #F7941D;"></iconify-icon>
                                    </span>
                                    <span class="accordion-title d-flex align-items-center justify-content-between w-100">
                                        ${skill.name}
                                        <span class="d-flex align-items-center">
                                            <iconify-icon class="star-technical" icon="material-symbols:star" width="16" height="16"></iconify-icon>
                                            ${level}
                                        </span>
                                    </span>
                                </div>
                                <div id="kt_accordion_technical_item_${i + 1}" class="fs-6 collapse bg-open-accordion" data-bs-parent="#kt_accordion_technical">
                                    <div class="technical-inner mb-6">
                                        <h4 class="mb-3 fs-4 fw-bold">Knowledge</h4>
                                        ${knowledgeItems.length
                                            ? knowledgeItems.map(k => `
                                                                                                                                                                                            <p class="mb-2 d-flex align-items-center gap-4">
                                                                                                                                                                                                <iconify-icon icon="simple-line-icons:check" class="star-technical" width="20" height="20"></iconify-icon>
                                                                                                                                                                                                ${k}
                                                                                                                                                                                            </p>`).join('')
                                            : '<p>-</p>'}
                                    </div>
                                    <div class="technical-inner">
                                        <h4 class="mb-3 fs-4 fw-bold">Ability</h4>
                                        ${abilityItems.length
                                            ? abilityItems.map(a => `
                                                                                                                                                                                            <p class="mb-2 d-flex align-items-center gap-4">
                                                                                                                                                                                                <iconify-icon icon="simple-line-icons:check" class="star-technical" width="20" height="20"></iconify-icon>
                                                                                                                                                                                                ${a}
                                                                                                                                                                                            </p>`).join('')
                                            : '<p>-</p>'}
                                    </div>
                                </div>
                            </div>`;
                });

                $('#kt_accordion_technical').html(techHtml);
                initializeAccordion('#kt_accordion_technical');


                // Critical Work Functions


                let cwfHtml = '';
                (job.critical_functions || []).forEach((cf, i) => {
                    const keyTasks = (cf.cwf_keys?.keytasks || []).map(key => `<li>${key}</li>`)
                        .join('');

                    cwfHtml += `
                        <div class="mb-0 critical-accordion">
                            <div class="accordion-header p-6 d-flex accordion-border align-items-center"
                                data-bs-target="#kt_accordion_3_item_${i + 1}" 
                                aria-expanded="false">
                                <span class="accordion-icon me-3">
                                    <iconify-icon icon="gravity-ui:circle-plus-fill" class="accordion-icon-off fs-3" style="color: #1AC2C2;"></iconify-icon>
                                    <iconify-icon icon="zondicons:minus-outline" class="accordion-icon-on fs-3" style="color: #1AC2C2;"></iconify-icon>
                                </span>
                                <span class="accordion-title">${cf.cwf_description || cf.description || ''}</span>
                            </div>
                            <div id="kt_accordion_3_item_${i + 1}" class="fs-6 collapse bg-open-accordion" data-bs-parent="#kt_accordion_3">
                                <div><ul class="m-0">${keyTasks}</ul></div>
                            </div>
                        </div>`;
                });

                $('#kt_accordion_3').html(cwfHtml);
                initializeAccordion('#kt_accordion_3');

            });

            // Create from JD button
            $(document).on('click', '#createFromJD', function() {
                showOverlay();
                if (latestJobData) {
                    console.log('latestdataaaaaaaaaaa', latestJobData);
                    // const jobRole = $('#job_role').val();
                    // const sector = $('#sector').val();

                    latestJobData.jd_type = 'ai';

                    const cacheKey = `job_detail_${jobRole}_${jobFamily}_${jobFamilyGroup}`;

                    // Send data to server to store in Redis
                    $.ajax({
                        url: '/admin/cache-job-data',
                        type: 'POST',
                        data: {
                            cache_key: cacheKey,
                            job_data: JSON.stringify(latestJobData),
                            _token: $('meta[name="csrf-token"]').attr(
                                'content') // important for Laravel POST
                        },
                        success: function() {
                            window.location.href =
                                `/admin/job-management/ai/create-jd?cache_key=${encodeURIComponent(cacheKey)}`;
                            hideOverlay();
                        },
                        error: function() {
                            toastr.error(
                                'The job profile is already associated with another job.');
                            hideOverlay();
                        }
                    });
                } else {
                    alert('Job data not available. Please try again.');
                }
            });

            // custom jd flow Master Company
            function triggerCustomJDFlow() {

                // const isLocalized = jobRoleName.includes('(Localized)');
                const localizedKey = $('#OverwriteContinueEditSkillBtn').data('localized-key');

                console.log('payload data', cachedJobData);
                console.log('payload data job role', jobRole);
                console.log('payload data selected role localised', selectedRoleLocalized);
                console.log('payload data selected role allow localised', allowLocalizedSubmit);



                if (!cachedJobData || !jobRole) {
                    alert('Missing job data or job profile selection.');
                    return;
                }


                // if (selectedRoleLocalized != 0 && !allowLocalizedSubmit) {
                //     const localizedName = jobRoleName;
                //     $('#overwriteCompanySkillName').text(localizedName);
                //     $('#affectedJobList').text('Affected This Job');
                //     $('#OverwriteContinueEditSkillBtn')
                //         .data('localized-key', localizedName)
                //         .data('is-localized', true);
                //     $('#OverwriteCompanySkillConfirmModal').modal('show');
                //     return;
                // }


                // if (promptForOverwriteIfNeeded(() => $('form').trigger('submit'))) {
                //     isSubmitting = false;
                //     return;
                // }
                if (promptForOverwriteIfNeeded(triggerCustomJDFlow)) {
                    isSubmitting = false;
                    return;
                }
                const payload = {
                    ...cachedJobData,
                    job_family_group: jobFamilyGroup,
                    business_unit_id: businessUnit,
                    job_family: jobFamily,
                    job_role: jobRole,
                    ...(allowLocalizedSubmit && localizedKey && selectedRoleLocalized && {
                        is_localized_job: true,
                        localized_override_key: localizedKey
                    })
                };

                const cacheKey = `job_detail_${jobRoleName}_${jobFamilyName}_${jobFamilyGroupName}`;

                console.log('cacheee keyyyyy', cacheKey);
                $.ajax({
                    url: '/admin/cache-job-data',
                    type: 'POST',
                    data: {
                        cache_key: cacheKey,
                        job_data: JSON.stringify(payload),
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        window.location.href =
                            `/admin/job-management/ai/create-jd?cache_key=${encodeURIComponent(cacheKey)}`;
                    },
                    error: function() {
                        alert('Failed to cache job data. Please try again.');
                    }
                });
            }

            if (typeof jdType !== 'undefined' && jdType !== 'AI-jd' && jdType !== 'custom-jd') {

                // When clicking the primary button
                $('#customJdBtn').on('click', function() {
                    // console.log('ddddd');
                    allowLocalizedSubmit = false;
                    triggerCustomJDFlow();
                });
            }




            if (typeof jdType !== 'undefined' && jdType === 'custom-jd') {
                document.getElementById('customJdBtn').addEventListener('click', function() {
                    if (isSubmitting) return;
                    isSubmitting = true;
                    const localizedKey = $('#OverwriteContinueEditSkillBtn').data('localized-key');

                    if (promptForOverwriteIfNeeded(() => $('#customJdBtn').trigger('click'))) {
                        isSubmitting = false;
                        return;
                    }
                    const params = new URLSearchParams({
                        business_unit_id: businessUnit,
                        job_family_group: jobFamilyGroup,
                        job_family: jobFamily,
                        job_role: jobRole,
                        job_family_group_name: jobFamilyGroupName,
                        job_family_name: jobFamilyName,
                        job_role_name: jobRoleName,
                        // job_type: jdType,
                        job_profile_description: $('#job_description').val()
                    });

                    if (allowLocalizedSubmit && selectedRoleLocalized != 0) {
                        params.append('is_localized_job', '1');
                        params.append('localized_override_key', localizedKey);
                    }

                    // Redirect to the GET route with query parameters
                    window.location.href = `/admin/job-management/job/create?${params.toString()}`;
                });
            }


            function promptForOverwriteIfNeeded(callback) {
                console.log('promptForOverwriteIfNeeded', selectedRoleLocalized, allowLocalizedSubmit)
                if (selectedRoleLocalized != 0 && !allowLocalizedSubmit) {
                    const localizedName = jobRoleName;
                    $('#overwriteCompanySkillName').text(localizedName);
                    $('#affectedJobList').text('Affected This Job');
                    $('#OverwriteContinueEditSkillBtn')
                        .data('localized-key', localizedName)
                        .data('is-localized', true);

                    $('#OverwriteContinueEditSkillBtn')
                        .off('click')
                        .on('click', function() {
                            console.log('sdsdfasdfasdfasdfasdf', allowLocalizedSubmit);
                            allowLocalizedSubmit = true;
                            $('#OverwriteCompanySkillConfirmModal')
                                .one('hidden.bs.modal', callback)
                                .modal('hide');
                        });

                    $('#OverwriteCompanySkillConfirmModal').modal('show');
                    return true;
                }
                return false; // No prompt needed
            }


        });
    </script>



    <script>
        // Get all the radio buttons
        const radioButtons = document.querySelectorAll('input[name="jdOption"]');
        const proceedButton = document.getElementById('proceedBtn');

        // Listen for change event on radio buttons
        radioButtons.forEach(button => {
            button.addEventListener('change', function() {
                // Enable the proceed button when a radio is selected
                proceedButton.disabled = false;
            });
        });

        // Add event listener to the proceed button
        proceedButton.addEventListener('click', function() {
            // Get the selected radio button value
            const selectedOption = document.querySelector('input[name="jdOption"]:checked');

            if (selectedOption) {
                // Redirect to the URL corresponding to the selected radio button value
                let redirectURL = '/';

                switch (selectedOption.value) {
                    case 'custom':
                        redirectURL = '/admin/job-management/custom-jd'; // Set the URL for Custom JD
                        break;
                    case 'master':
                        redirectURL = '/admin/job-management/localized/master-jd'; // Set the URL for Master JD
                        break;
                    case 'company':
                        redirectURL = '/admin/job-management/localized/company-jd'; // Set the URL for Company JD
                        break;
                    default:
                        break;
                }

                if (redirectURL) {
                    window.location.href = redirectURL; // Redirect to the selected URL
                }
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('btn-add-job-profile').addEventListener("click", function() {

                const businessUnitValue = document.getElementById('business_unit').value;
                const sectorValue = document.getElementById('division').value;
                const trackValue = document.getElementById('department').value;
                // openAddJobProfilePopup();
                ModalManager.open({
                    module: 'jobs',
                    key: "add_new_profile",
                    data: {},
                    onSubmit(modalEl) {
                        showOverlay();

                        // Get form values from the modal
                        const job_position_name = modalEl.querySelector('#modalJobPosition')
                            .value;
                        const positionCode = modalEl.querySelector('#modalPositionCode').value;
                        const jobDescription = modalEl.querySelector('#modalJobDescription')
                            .value;
                        const business_unit_id = modalEl.querySelector('#modalBusinessUnit')
                            .value;
                        const division_id = modalEl.querySelector('#modalDivision').value;
                        const department_id = modalEl.querySelector('#modalDepartment').value;

                        console.log(department_id);
                        fetch('/admin/job-management/create/job-profile', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    business_unit_id,
                                    division_id,
                                    department_id,
                                    job_position_name,
                                    positionCode,
                                    jobDescription,
                                }),
                            })
                            .then(res => res.json())
                            .then(response => {
                                // console.log('responseeeeeeeeeeeeeeee', response);
                                if (response.success) {
                                    const alertMessage = response.message;

                                    const event = new Event('change');
                                    document.getElementById('department').dispatchEvent(event);
                                    modalEl.querySelector('.btn-close').click();
                                    hideOverlay();


                                    const alertHtml =
                                        `<x-alert :type="'success'" :message="'${alertMessage}'" />`;
                                    document.querySelector('.top-card').insertAdjacentHTML(
                                        'beforebegin', alertHtml);
                                } else if (response.errors) {

                                    displayErrors(response.errors);
                                    hideOverlay();

                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                hideOverlay();
                            });
                    },
                    onShown(modalEl) {
                        modalEl.querySelector('#modalBusinessUnit').value = businessUnitValue;
                        modalEl.querySelector('#modalDivision').value = sectorValue;
                        modalEl.querySelector('#modalDepartment').value = trackValue;

                        fetch('/admin/ajax/business-unit')
                            .then(res => res.json())
                            .then(businessUnits => {
                                const businessUnitSelect = modalEl.querySelector(
                                    '#modalBusinessUnit');
                                populateSelect(businessUnitSelect, businessUnits);
                                businessUnitSelect.value = businessUnitValue;
                                loadSectorOptions(modalEl, businessUnitValue, sectorValue);
                            });
                        loadTrackOptions(modalEl, sectorValue, trackValue);


                        modalEl.querySelector('#modalBusinessUnit').addEventListener('change',
                            function() {
                                const selectedBU = this.value;
                                loadSectorOptions(modalEl, selectedBU, '');
                            });


                        modalEl.querySelector('#modalDivision').addEventListener('change',
                            function() {
                                const selectedSector = this.value;
                                // loadTrackOptions(modalEl,selectedSector);
                                loadTrackOptions(modalEl, selectedSector, '');
                            });
                    }
                })
                hideOverlay();
                return;

            });


            function setupMasterJD() {

                // roleSelect.addEventListener('click', handleProfileChange);
            }

            // Company JD Mode with Pre-fill
            function setupCompanyJD() {
                const selectedBusinessUnit = cachedJobData.business_unit_id;
                const selectedGroupId = cachedJobData.selected_job_family_group;
                const selectedFamilyId = cachedJobData.selected_job_family;
                const selectedProfileId = cachedJobData.selected_job_profile;

                // showOverlay();

                // fetch('/admin/job-family-groups')
                //     .then(res => res.json())
                //     .then(groups => {
                //         populateOptions(sectorSelect, 'Select Job Family Group', groups, selectedGroupId);
                //         return fetch(`/admin/job-families/${selectedGroupId}`);
                //     })
                //     .then(res => res.json())
                //     .then(families => {
                //         trackSelect.disabled = false;
                //         populateOptions(trackSelect, 'Select Job Family', families, selectedFamilyId);
                //         return fetch(`/admin/job-profiles/${selectedFamilyId}`);
                //     })
                //     .then(res => res.json())
                //     .then(profiles => {
                //         roleSelect.disabled = false;
                //         roleSelect.innerHTML = '<option value="">Select Job Position</option>';
                //         profiles.forEach(profile => {
                //             const selected = profile.id == selectedProfileId ? 'selected' : '';
                //             const option = document.createElement('option');
                //             option.value = profile.id;
                //             option.textContent = profile.name;
                //             option.dataset.desc = profile.description || '';
                //             if (selected) option.setAttribute('selected', 'selected');
                //             roleSelect.appendChild(option);
                //         });

                //         // Pre-fill description
                //         const selectedOption = roleSelect.querySelector(`option[value="${selectedProfileId}"]`);
                //         descriptionBox.value = cleanDescription(selectedOption?.dataset.desc || '');
                //         roleSelect.addEventListener('change', handleProfileChange);
                //         hideOverlay();
                //     });
            }

            // Entry point
            if (typeof jdType !== 'undefined' && jdType === 'company-jd' && cachedJobData) {
                setupCompanyJD();
            } else if (typeof jdType !== 'undefined' && jdType === 'master-jd') {
                setupMasterJD();
            }



            function cleanDescription(desc) {
                return desc
                    .replace(/â—|•|●|▪|■/g, '') // Remove bullets
                    .replace(/â€™|’/g, "'") // Apostrophes
                    .replace(/â€œ|â€�|“|”/g, '"') // Quotes
                    .replace(/â€“|–|—/g, '-') // Dashes
                    .replace(/\u00A0/g, ' ') // Non-breaking space
                    .replace(/[^\x20-\x7E]/g, '') // Remove non-ASCII
                    .replace(/\s+/g, ' ') // Collapse multiple spaces
                    .trim();
            }

            function handleProfileChange() {
                const selected = roleSelect.selectedOptions[0];
                let descText = selected?.dataset?.desc || '';

                if (descText && descText.toLowerCase() !== 'null') {
                    descriptionBox.value = cleanDescription(descText);
                } else {
                    descriptionBox.value = '';
                    descriptionBox.setAttribute('placeholder', 'No description available for this job profile.');
                }
            }
        });
    </script>

@endsection
