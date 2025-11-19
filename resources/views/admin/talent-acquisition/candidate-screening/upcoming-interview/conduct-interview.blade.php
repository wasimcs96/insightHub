@extends('admin.layout.app')

@section('title', 'Talent Insights Hub')

@section('styles')

    <style>
        .heading,
        .desc-card .sub-heading {
            color: #000;
            font-size: 32.5px;
            line-height: 39px;
            margin-bottom: 31.5px;
        }

        .grid-section {
            grid-template-columns: 36% 62.3%;
            gap: 20px;
        }

        .sub-heading {
            color: #252F4A;
            font-size: 22.75px;
            line-height: 27.3px;
        }

        .week-button {
            display: flex;
            height: 30px;
            padding: 0px 8px;
            align-items: center;
            border-radius: 4px;
            border: 1px solid #C4CADA;
            background: #FFF;
            color: #071437;
            font-size: 12px;
            line-height: 16px;
        }

        .filter-buttons {
            gap: 8px;
            flex-wrap: wrap;
        }

        .filter-btn {
            display: flex;
            padding: 12px 18px;
            align-items: center;
            gap: 8px;
            border-radius: 80px;
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #78829D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            max-width: 140px;
            overflow: hidden;
            white-space: nowrap;
            height: 40px;
        }

        .filter-btn span {
            display: flex;
            align-items: center;
            gap: 8px;
            max-width: 100px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .left-table {
            margin-top: 16px;
            display: flex;
            padding-bottom: 32px;
            flex-direction: column;
            gap: 32px;
            align-self: stretch;
            border-radius: 8px;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .table-box {
            padding: 16px;
            gap: 16px;
            border-bottom: 1px solid #F1F1F4;
            background: #FFF;
            cursor: pointer;
        }

        .table-box.active {
            background: #FFF6EA;
        }

        .table-date {
            color: #4B5675;
            font-size: 32.5px;
            font-weight: 500;
            line-height: 39px;
        }

        .table-day {
            color: #4B5675;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

        .table-box .line {
            width: 1px;
            height: 40px;
            background: #C4CADA;
            display: block;
        }

        .table-box .name-info {
            width: 100%;
        }

        .table-box .name {
            color: #4B5675;
            font-size: 16.25px;
            font-weight: 500;
            line-height: 22px;
        }

        .table-box .time {
            color: #4B5675;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
        }

        .table-box .position {
            color: #78829D;
            font-size: 10px;
            font-weight: 500;
            line-height: 14px;
        }

        .table-box .tag {
            display: flex;
            padding: 3px 7px;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            font-size: 10px;
            font-weight: 600;
            line-height: normal;
            text-transform: uppercase;
        }

        .table-box .tag.blue,
        .sheet-card .bottom-text .tag.blue {
            color: #1877A0;
            background: #E3F7FF;
        }

        .table-box .tag.purple,
        .sheet-card .bottom-text .tag.purple {
            background: #F2EEFD;
            color: #7F66CA;
        }

        .table-box .tag.teal,
        .sheet-card .bottom-text .tag.teal {
            background: #E2F6F6;
            color: #108585;
        }

        .table-box .tag.green,
        .sheet-card .bottom-text .tag.green {
            background: #DDF5E2;
            color: #196329;
        }

        .table-box .tag.yellow,
        .sheet-card .bottom-text .tag.yellow {
            background: #FFEBB4;
            color: #EB8100;
        }

        .table-box .tag.red,
        .sheet-card .bottom-text .tag.red {
            background: #FFE0DD;
            color: #AA2D22;
        }

        .table-box .tag.orange,
        .sheet-card .bottom-text .tag.orange {
            background: #FDE2C1;
            color: #A56313;
        }

        .table-box .tag.dark-red,
        .sheet-card .bottom-text .tag.red {
            background: #FFE0DD;
            color: #F24130;
        }

        .icon-link {
            color: #C4CADA;
        }

        .na-text {
            color: #78829D;
            font-size: 10px;
            font-weight: 500;
            line-height: 14px;
        }

        .not-selected {
            display: block;
        }

        .not-selected-content {
            display: flex;
            padding: 32px;
            height: 1029px;
            justify-content: center;
            align-items: center;
            gap: 10px;
            align-self: stretch;
            background: #FFF;
            margin-top: 32px;
        }

        .not-selected p {
            color: #99A1B7;
            text-align: center;
            font-size: 17.55px;
            font-weight: 500;
            line-height: 21.06px;
            width: 372px;
        }

        .button-custom {
            padding: 14px 20px;
            gap: 8px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
        }

        .btn-orange-outline {
            border: 1px solid #F7941C;
            background: #FFF;
            color: #F7941C;
        }

        .info-card {
            padding: 32px;
            background: #FFF;
        }

        .info-content {
            margin-bottom: 24px;
            width: 90%;
        }

        .info-card .heading,
        .desc-card .heading {
            color: #99A1B7;
            font-size: 13.975px;
            line-height: 20.963px;
            font-weight: 400;
            margin-bottom: 8px;
        }

        .info-card .sub-heading {
            color: #071437;
            font-size: 17.55px;
            font-weight: 500;
            line-height: 21.06px;
        }

        .badge {
            color: #4B5675;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
            display: flex;
            padding: 8px 16px;
            align-items: center;
            gap: 4px;
            border-radius: 80px;
            background: #F1F1F4;
            height: 24px;
        }

        .join-interview {
            color: #F7941C;
            font-size: 14px;
            font-weight: 400;
            line-height: 22px;
        }

        .desc-card {
            padding: 32px;
            background: #FFF;
        }

        .desc-content .heading {
            color: #1E1E1E;
            font-size: 19.5px;
            font-weight: 700;
            line-height: 23.4px;
            margin-bottom: 12px;
        }

        .desc-content .desc {
            color: #4B5675;
            font-size: 16px;
            font-weight: 400;
            line-height: 22.4px;
            letter-spacing: 0.5px;
        }

        .desc-content .accordion-design {
            height: 69px;
            padding: 19.5px 0px;
            gap: 24px;
            border-bottom: 1px solid #F1F1F4;
            color: #555;
            font-size: 16.25px;
            font-weight: 400;
            line-height: 24px;
            letter-spacing: 0.15px;
        }

        .desc-content .accordion-design .icon {
            color: #1AC2C2;
            width: 23px;
        }

        .desc-content .accordion-button,
        .desc-content .accordion-item {
            height: 69px;
            padding: 19.5px 0px;
            gap: 24px;
            border-bottom: 1px solid #F1F1F4;
            color: #555;
            font-size: 16.25px;
            font-weight: 400;
            line-height: 24px;
            letter-spacing: 0.15px;
        }

        .desc-content .accordion-body {
            border-radius: 8.13px;
            padding: 19.5px 24px;
            background: rgb(226, 246, 246);
        }

        .desc-content .accordion-body ul li {
            color: #4B5675;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
        }

        .desc-content .accordion-button {
            padding: 0px;
        }

        .desc-content .accordion-item {
            border: 0;
        }

        .desc-content .accordion-button:not(.collapsed) {
            color: #555;
            box-shadow: none;
            background: none;
        }

        .interview-list {
            color: #F7941C;
            font-size: 14px;
            font-weight: 600;
            line-height: normal;
            text-transform: capitalize;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .conduct-interview .left-side {
            padding: 24px;
            border-radius: 8px;
            border: 1px solid #F1F1F4;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .conduct-interview .right-side {
            width: 765.75px;
            padding: 24px;
            background: #FFF;
        }

        .conduct-interview .left-side .custom-button {
            padding: 8px 16px;
            gap: 8px;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            border-radius: 4px;
        }

        .conduct-interview .left-side h4 {
            color: #071437;
            font-size: 22.75px;
            font-weight: 600;
            line-height: 34px;
        }

        .tag-text {
            padding: 16px 0px;
            border-bottom: 1px solid #F1F1F4;
            margin-bottom: 32px;
        }

        .tag-text p {
            color: #4B5675;
            font-size: 16.25px;
            font-weight: 500;
            line-height: 22px;
        }

        .tag-text .tag {
            display: flex;
            padding: 5.6px 11.2px;
            justify-content: center;
            align-items: center;
            border-radius: 56px;
            font-size: 8.4px;
            font-weight: 600;
            line-height: 11.2px;
        }

        .tag-text .tag.green {
            background: #DDF5E2;
            color: #196329;
        }

        .bottom-content {
            margin-bottom: 32px;
        }

        .bottom-content h5 {
            color: #1E1E1E;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
            margin-bottom: 16px;
        }

        .bottom-content .inner-content {
            gap: 16px;
        }

        .bottom-content .inner-content p {
            color: #99A1B7;
            font-size: 13.975px;
            font-weight: 400;
            line-height: 20.963px;
        }

        .bottom-content .inner-content .custom-button {
            display: flex;
            padding: 8px 16px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            background: #FFF;
        }

        .bottom-content .inner-content .custom-button.btn-grey-outline {
            border: 1px solid #99A1B7;
            color: #78829D;
        }

        .bottom-content .inner-content .color-dark {
            color: #4B5675;
        }

        .conduct-interview .right-side h4 {
            color: #252F4A;
            font-size: 22.75px;
            font-weight: 500;
            line-height: 27.3px;
            margin-bottom: 32px;
        }

        .selected {
            display: none;
        }

        .conduct-interview .right-side form label,
        .selected .right-side form label {
            color: #1E1E1E;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            letter-spacing: 0.25px;
            margin-bottom: 14px;
        }

        .conduct-interview .right-side form .custom-check-input,
        .selected .right-side form .custom-check-input {
            color: #4B5675;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            margin-bottom: 12px;
        }

        .conduct-interview input[type="radio"],
        .filter-buttons input[type="radio"],
        .selected input[type="radio"],
        .filter-buttons input[type="radio"] {
            appearance: none;
            border: 1px solid #DBDFE9;
            padding: 5px;
            border-radius: 50%;
        }

        .conduct-interview input[type="radio"]:checked,
        .filter-buttons input[type="radio"]:checked,
        .selected input[type="radio"]:checked,
        .filter-buttons input[type="radio"]:checked {
            background-color: #fff;
            border: 3.2px solid #F7941C;
            padding: 3px;
        }

        .filter-buttons input[type="checkbox"]:checked {
            accent-color: #F7941C !important;
        }

        .conduct-interview .custom-button {
            padding: 8px 16px;
            border-radius: 4px;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
            letter-spacing: 0.1px;
        }

        .conduct-interview .custom-button.btn-orange-fill {
            background: #F7941C;
            color: #FFF;
        }

        .sheet-card {
            padding: 24px;
            border-radius: 8px 8px 0px 0px;
            border-bottom: 1px solid #DBDFE9;
            background: #FFF;
        }

        .sheet-card h4 {
            color: #4B5675;
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
        }

        .sheet-card .position {
            color: #4B5675;
            font-size: 16.25px;
            font-weight: 500;
            line-height: 19.5px;
            margin-top: 6px;
        }

        .sheet-card .bottom-text {
            margin-top: 16px;
        }

        .sheet-card .bottom-text p {
            color: #78829D;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

        .sheet-card .bottom-text .tag {
            display: flex;
            padding: 5.6px 11.2px;
            justify-content: center;
            align-items: center;
            font-size: 8.4px;
            font-weight: 600;
            line-height: 11.2px;
            border-radius: 56px;
        }

        .sheet-card .bottom-text .line {
            width: 1px;
            height: 24px;
            display: block;
            background-color: #C4CADA;
        }

        .filter-buttons .custom-check-input {
            padding: 12px 8px;
            cursor: pointer;
        }

        .filter-buttons .active-btn {
            border: 1px solid #F7941C;
            background: #FFF6EA;
            color: #F7941C;
            font-weight: 600;
        }

        .filter-buttons .dropdown-menu {
            border-radius: 4px;
            padding: 0;
            border: 1px solid #DBDFE9;
        }

        .filter-buttons .button-div {
            padding: 12px 8px;
            gap: 12px;
            border-top: 1px solid #DBDFE9;
        }

        .filter-buttons .filter {
            display: flex;
            padding: 4px 20px;
            justify-content: center;
            align-items: center;
            border-radius: 14.5px;
            background: #F7941C;
            color: #FFF;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .filter-buttons .resetBtn {
            color: #5B5B5B;
            text-align: right;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            background-color: white;
        }

        .filter-buttons .custom-check-input:hover {
            background: #FFF6EA;
            border-radius: 4px 4px 0px 0px;
        }

        .filter-buttons .custom-check-input.active {
            background: #FFF6EA;
            border-radius: 4px 4px 0px 0px;
        }

        .filter-buttons .custom-check-input label p {
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

        .filter-buttons .custom-check-input label p {
            color: #000;
        }

        .filter-buttons .custom-check-input label span {
            color: #99A1B7;
        }
    </style>

    <style>
        .page-text {
            color: #4B5675;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
            margin-right: 8px;
        }

        .page-input-box {
            width: 66px;
            border-radius: 4px;
            border: 1px solid #D9D9D9;
            color: #4B5675;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            padding: 8px 16px;
        }


        .pagination .page-item .page-link {
            border: none;
            color: #78829D;
            font-weight: 500;
            line-height: 20px;
            font-size: 14px;
            font-weight: 500;
            padding: 6px 12px;
        }

        .pagination .page-item.active .page-link {
            background-color: #F7941C;
            color: #FFF;
            border-radius: 4px;
            font-weight: 600;
        }

        .pagination .page-item.disabled .page-link {
            color: #C4CADA;
        }

        .pagination .page-item .page-link:hover {
            background-color: #F7941C;
            color: #fff !important;
        }

        .dropdown-toggle {
            border: 1px solid #C4CADA;
            padding: 6px 12px;
            border-radius: 6px;
            background: white;
            color: #6C7486;
            font-size: 14px;
        }

        .filter-number {
            padding: 4px 10px;
            border-radius: 12px;
            background: #FFF;
            color: #78829D;
            text-align: center;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
            justify-content: center;
        }

        .week-dropdown {
            border-radius: 4px;
            border: 1px solid #C4CADA;
            background: #FFF;
        }

        .week-dropdown .dropdown-item {
            padding: 12px 8px;
            color: #071437;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }
    </style>

    <style>
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

        .modal-div .modal-footer button {
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
            padding: 14px 20px;
        }

        .modal-div .btn-apply {
            background: #F7941C;
            color: #FFF;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
            flex: 1 0 0;
        }
    </style>

@endsection

@section('content')

    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
                class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h2 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Candidate Screening
                </h2>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Talent Acquisition</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Candidate Screening</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content  flex-column-fluid position-lg-relative">
        <div class="app-container container-xxl w-100">
            <p id="backToList" class="interview-list d-flex gap-2 align-items-center"><iconify-icon
                    icon="rivet-icons:arrow-left" width="16" height="16"></iconify-icon> Back to Interview List</p>
            <h1 class="heading fw-bold">Conduct Interview</h1>
            <div class="d-grid grid-section conduct-interview">
                {{-- <div class="left-side">
                    <div class="d-flex align-items-center justify-content-between mb-5">
                        <h4 class="m-0">Kavitha Rajendran</h4>
                        <button
                            class="d-flex align-items-center justify-content-center custom-button btn-orange-outline cursor-pointer"><iconify-icon
                                icon="tabler:send" width="16" height="16"></iconify-icon> Send Email</button>
                    </div>
                    <div class="d-flex align-items-center justify-content-between tag-text m-0">
                        <p class="m-0">Suitability Rate</p>
                        <div class="tag green">95%</div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between tag-text">
                        <p class="m-0">Overall Match Rate</p>
                        <div class="tag green">VERY HIGH</div>
                    </div>
                    <div class="bottom-content">
                        <h5>Documents</h5>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 99px;">Resume</p>
                            <button
                                class="d-flex align-items-center justify-content-center custom-button btn-grey-outline cursor-pointer"><iconify-icon
                                    icon="material-symbols:download" width="16" height="16"></iconify-icon>
                                Download</button>
                        </div>
                        <div class="d-flex inner-content">
                            <p class="m-0" style="width: 99px;">Portfolio</p>
                            <p class="m-0 color-dark">www.kavithaportfolio.com</p>
                        </div>
                    </div>
                    <div class="bottom-content">
                        <h5>Personal Information</h5>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 111px;">Email</p>
                            <p class="m-0 color-dark">kavitha.rajendran@gmail.com</p>
                        </div>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 111px;">Phone Number</p>
                            <p class="m-0 color-dark">(+60) 12 345 6789</p>
                        </div>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 111px;">Current Location</p>
                            <p class="m-0 color-dark">Kuala Lumpur</p>
                        </div>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 111px;">Nationality</p>
                            <p class="m-0 color-dark">Malaysia</p>
                        </div>
                        <div class="d-flex inner-content">
                            <p class="m-0" style="width: 217px;">Address</p>
                            <p class="m-0 color-dark">No. 12, Jalan Meranti 5,Taman Bukit Indah,81200 Johor Bahru,Johor,
                                Malaysia.</p>
                        </div>
                    </div>
                    <div class="bottom-content">
                        <h5>Education Information</h5>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 136px;">Education Level</p>
                            <p class="m-0 color-dark">Bachelor's Degree</p>
                        </div>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 136px;">Year Graduation</p>
                            <p class="m-0 color-dark">2018</p>
                        </div>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 136px;">Education Institution</p>
                            <p class="m-0 color-dark">Universiti Malaya</p>
                        </div>
                        <div class="d-flex inner-content">
                            <p class="m-0" style="width: 204px;">Education Program</p>
                            <p class="m-0 color-dark">Bachelor of Computer Science (Software Engineering)</p>
                        </div>
                    </div>
                    <div class="bottom-content m-0">
                        <h5>Job Preference</h5>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 136px;">Work Experience</p>
                            <p class="m-0 color-dark">5</p>
                        </div>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 136px;">Work Authorisation</p>
                            <p class="m-0 color-dark">Yes</p>
                        </div>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 136px;">Preferred Working Locations</p>
                            <p class="m-0 color-dark">Kuala Lumpur, Malaysia</p>
                        </div>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 204px;">Preferred Job</p>
                            <p class="m-0 color-dark">Software Engineer</p>
                        </div>
                        <div class="d-flex inner-content">
                            <p class="m-0" style="width: 204px;">Expected Salary (MYR)</p>
                            <p class="m-0 color-dark">5000-6000</p>
                        </div>
                    </div>
                </div> --}}
                <div class="left-side">
                    <div class="d-flex align-items-center justify-content-between mb-5">
                        <h4 class="m-0">{{ $application->external_user_name ?? 'N/A' }}</h4>
                        <button type="button"
                            onclick="window.location.href='mailto:{{ $application->external_user_email ?? '' }}?subject=Subject%20Here&body=Body%20text%20here'"
                            class="d-flex align-items-center justify-content-center custom-button btn-orange-outline cursor-pointer">
                            <iconify-icon icon="tabler:send" width="16" height="16"></iconify-icon>
                            Send Email
                        </button>
                    </div>

                    <!-- Suitability Rate -->
                    <div class="d-flex align-items-center justify-content-between tag-text m-0">
                        <p class="m-0">Suitability Rate</p>
                        <div class="tag green">{{ $suitabilityRate }}%</div>
                    </div>

                    <!-- Overall Match Rate -->
                    <div class="d-flex align-items-center justify-content-between tag-text">
                        <p class="m-0">Overall Match Rate</p>
                        <div class="tag green">{{ $overallMatchRate }}</div>
                    </div>

                    <!-- Documents -->
                    <div class="bottom-content">
                        <h5>Documents</h5>
                        @if (empty($userDocuments) || $userDocuments == 'N/A')
                            <p class="m-0">No documents uploaded</p>
                        @else
                            <div class="d-flex inner-content mb-2">
                                <p class="m-0" style="width: 99px;">Resume</p>
                                <a href="{{ asset($userDocuments) }}" target="_blank"
                                    class="d-flex align-items-center justify-content-center custom-button btn-grey-outline cursor-pointer">
                                    <iconify-icon icon="material-symbols:download" width="16"
                                        height="16"></iconify-icon> Download
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Personal Information -->
                    <div class="bottom-content">
                        <h5>Personal Information</h5>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 111px;">Email</p>
                            <p class="m-0 color-dark">{{ $personalInfo['email'] }}</p>
                        </div>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 111px;">Phone Number</p>
                            <p class="m-0 color-dark">{{ $personalInfo['phone'] }}</p>
                        </div>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 111px;">Current Location</p>
                            <p class="m-0 color-dark">{{ $personalInfo['current_location'] }}</p>
                        </div>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 111px;">Nationality</p>
                            <p class="m-0 color-dark">{{ $personalInfo['nationality'] }}</p>
                        </div>
                        <div class="d-flex inner-content">
                            <p class="m-0" style="width: 120px;">Address</p>
                            <p class="m-0 color-dark">{{ $personalInfo['address'] }}</p>
                        </div>
                    </div>

                    <!-- Education Information -->
                    <div class="bottom-content">
                        <h5>Education Information</h5>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 136px;">Education Level</p>
                            <p class="m-0 color-dark">{{ $educationInfo['education_level'] }}</p>
                        </div>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 136px;">Year Graduation</p>
                            <p class="m-0 color-dark">{{ $educationInfo['graduation_year'] }}</p>
                        </div>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 136px;">Education Institution</p>
                            <p class="m-0 color-dark">{{ $educationInfo['institution'] }}</p>
                        </div>
                        <div class="d-flex inner-content">
                            <p class="m-0" style="width: 204px;">Education Program</p>
                            <p class="m-0 color-dark">{{ $educationInfo['program'] }}</p>
                        </div>
                    </div>

                    <!-- Job Preferences -->
                    <div class="bottom-content m-0">
                        <h5>Job Preference</h5>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 136px;">Work Experience</p>
                            <p class="m-0 color-dark">{{ $jobPreference['work_experience'] }}</p>
                        </div>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 136px;">Work Authorization</p>
                            <p class="m-0 color-dark">{{ $jobPreference['work_authorization'] }}</p>
                        </div>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 136px;">Preferred Working Locations</p>
                            <p class="m-0 color-dark">{{ implode(', ', $preferredLocations) }}</p>
                        </div>
                        <div class="d-flex inner-content mb-2">
                            <p class="m-0" style="width: 204px;">Preferred Job</p>
                            <p class="m-0 color-dark">{{ $application->jobOpening->jobs->title ?? 'N/A' }}</p>
                        </div>
                        <div class="d-flex inner-content">
                            <p class="m-0" style="width: 204px;">
                                Expected Salary ({{ $application->jobOpening->currency_short_name ?? 'MYR' }})
                            </p>
                            <p class="m-0 color-dark">
                                {{ $application->salary_lower_bound ?? 0 }}
                                 {{-- - {{ $application->salary_upper_bound ??  }} --}}
                            </p>
                        </div>
                        
                    </div>
                </div>

                <div class="right-side">
                    <h4>Interview List for {{ $jobTitle }}</h4>
                    @if(count($interviewQuestions) > 0)
                    <form id="interviewForm">
                        @csrf
                        @foreach($interviewQuestions as $question)
                        <div class="mb-5">
                            <input type="hidden" id="candidateName" value="{{ $application->external_user_name ?? 'N/A' }}">
                            <input type="hidden" name="application_id[]" value="{{ $question->id }}">
                            <input type="hidden" name="user_id" value="{{ $userId }}">
                            <input type="hidden" name="job_opening_application_id" value="{{ $application->id }}">
                            <label>{{ $question->question_number }}. {{ $question->title }}</label>
                            
                            @php
                                $options = config('helpers.interview_option');
                                $availableScores = [
                                    $question->option_1_score,
                                    $question->option_2_score,
                                    $question->option_3_score,
                                    $question->option_4_score
                                ];
                            @endphp
                    
                            @foreach($options as $score => $label)
                                <div class="d-flex gap-3 align-items-center custom-check-input">
                                    <input type="radio" name="question_{{ $question->id }}" value="{{ $score }}" {{ in_array($score, $availableScores) ? '' : 'disabled' }}>
                                    {{ $label }}
                                </div>
                            @endforeach
                        </div>
                        @endforeach
                    
                        <div class="mb-10">
                            <label class="mb-2">Additional Comments</label>
                            <p class="mb-2 text-muted">Any quick remarks or feedback?</p>
                            <textarea class="form-control" name="comment" rows="3" placeholder="Description"></textarea>
                        </div>
                    
                        <button type="button" class="custom-button btn-orange-fill cursor-pointer border-0 w-100"
                            id="submitInterview">Submit</button>
                    </form>
                    @else
                        <a href="{{ route('admin.interview-question.create') }}" target="_blank" class="custom-button btn-orange-fill cursor-pointer border-0" style="
                        margin: auto;
                        width: fit-content;
                        display: block;
                    ">
                            Create Interview Questions
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="saved" tabindex="-1" aria-labelledby="savedLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-div">
                <div class="modal-body py-0  pt-5 text-center">
                    <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"
                        style="
                float: right;
            "><img
                            src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
                    <iconify-icon icon="simple-line-icons:check" width="70" height="70"
                        style="color: #99E2A8;"></iconify-icon>
                    <p class="fw-bolder fs-1 lh-1 text-center" style="color: #4B5675;">Interview Performance Evaluation
                        for Turnaround Coordinator-First Interview Successfully!
                    </p>
                    <p class="text-center" style="color: #4B5675;">
                        You have successfully submitted the interview performance evaluation for <span id="candidateModalName"
                            class="fw-bold">Kavitha Rajendran</span>. The performance score will now appear in the hiring
                        pipeline under ‘Interview Conducted’ for review and further decision-making.
                    </p>
                </div>
                <div class="modal-footer modal-footer d-block border-0 pt-0">
                    <div class="filter-content d-flex justify-content-between gap-2">
                        <button class="btn btn-outline" data-bs-dismiss="modal" id="backToUpcoming">Back to Upcoming Interview</button>
                        <button class="btn btn-apply" data-bs-dismiss="modal" id="viewResultBtn">
                            View Result
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

<script>
    document.getElementById('backToList').addEventListener('click', function () {
        window.location.href = "{{ route('admin.talent-acquisition.candidate-screening.upcoming-interview.index') }}";
    });
</script>

<script>
    $(document).ready(function() {
        $('#submitInterview').on('click', function() {
            let formData = new FormData($('#interviewForm')[0]);

            $.ajax({
                url: "{{ route('admin.talent-acquisition.candidate-screening.conduct-interview.response') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    $('#submitInterview').prop('disabled', true).text('Submitting...');
                },
                success: function(response) {
                    // Enable the button
                    $('#submitInterview').prop('disabled', false).text('Submit');

                    let candidateName = $('#candidateName').val();

                    // Set the name in the modal span
                    $('#candidateModalName').text(candidateName);

                    // Show the success modal
                    var myModal = new bootstrap.Modal(document.getElementById('saved'));
                    myModal.show();
                },
                error: function(xhr) {
                    console.log(xhr);
                    $('#submitInterview').prop('disabled', false).text('Submit');
                    alert('Something went wrong! Please try again.');
                }
            });
        });

        // Redirect to appropriate pages when clicking buttons
        $('#viewResultBtn').on('click', function() {
            window.location.href = "{{ route('admin.talent-acquisition.candidate-screening.interview-conduct.index') }}";
        });

        $('#backToUpcoming').on('click', function() {
            window.location.href = "{{ route('admin.talent-acquisition.candidate-screening.upcoming-interview.index') }}";
        });
    });
</script>


@endsection