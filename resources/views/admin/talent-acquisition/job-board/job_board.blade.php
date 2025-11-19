@extends('admin.layout.app')

@section('title', 'Talent Acquisition')

@section('styles')

    <style>
        .app-wrapper {
            margin-top: 74px !important;
        }

        .feedback-message {
            display: none;
            border-radius: 8px;
            border: 1px solid #BBECC5;
            background: #DDF5E2;
            padding: 24px;
        }

        .feedback-message p {
            color: #071437;
            font-size: 13.975px;
            line-height: 16.77px;
        }

        .feedback-message .icon {
            color: #78829D;
        }

        .card-heading {
            color: #252F4A;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
        }

        .tab-button-container .nav-tabs {
            border: 1px solid #78829D;
            font-size: 10px;
            font-weight: 500;
            line-height: 14px;
        }

        .tab-button-container .nav-tabs .nav-link {
            border: none;
            border-right: 1px solid #78829D;
            border-radius: 0;
            padding: 5px 12px;
            color: #78829D;
            margin: 0;
        }

        .tab-button-container .nav-tabs:last-child {
            border-right: none;
        }

        .tab-button-container .nav-tabs .nav-link.active {
            background: #F7941C;
            color: #FFF;
        }

        .search-container {
            border-radius: 4px !important;
            border: 1px solid#C4CADA;
            width: 50%;
            height: 32px;
        }

        .search-container input {
            color: #99A1B7;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
            width: 70%;
            outline: none;
        }

        .filter-button {
            display: flex;
            padding: 8px 16px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            background: #FAFAFB;
            color: #78829D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .filter-apply {
            background: #DBDFE9;
        }
    </style>

    <style>
        .table-container {
            /* border-bottom: 1px solid #F1F1F4; */
            min-height: 76vh;
        }

        .table-container .table thead {
            color: #99A1B7;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            border-top: 1px solid #F3F3F3;
            border-bottom: 1px solid #F3F3F3;
            background: #FAFAFB;
        }

        .table-container .table thead th {
            padding: 16px 4px;
            vertical-align: middle;
        }

        .table-container .table tbody tr td {
            padding: 24px 4px;
            vertical-align: middle;
            border-bottom: 1px solid #F1F1F4;
            color: #4B5675;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
            letter-spacing: 0.1px;
        }

        .table-container .table tbody tr:hover {
            background: #FFF6EA;
        }

        .table-container .table:not(.table-bordered) td:first-child,
        .table:not(.table-bordered) th:first-child,
        .table:not(.table-bordered) tr:first-child {
            padding-left: 16px;
        }

        .table-container .table:not(.table-bordered) td:last-child,
        .table:not(.table-bordered) th:last-child,
        .table:not(.table-bordered) tr:last-child {
            padding-right: 16px;
        }

        .table-container .table tbody tr:last-child {
            border-bottom: 1px solid #F1F1F4 !important;
        }

        .status-badge {
            width: 56px;
            padding: 3px 7px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            text-align: center;
        }

        .status-active {
            background: #DDF5E2;
            color: #218336;
        }

        .status-ready {
            background: #E2F6F6;
            color: #108585;
        }

        .status-expired {
            background: #FFE0DD;
            color: #F24130;
        }

        .status-filled {
            background: #F2EEFD;
            color: #7F66CA;
        }

        .action-btn {
            background: transparent;
            border: none;
            color: #4B5675;
            cursor: pointer;
            top: 3px;
            position: relative;
        }

        .action-card {
            display: none;
            width: 250px;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 10px;
            opacity: 0;
            transform: scale(0.95);
            transition: opacity 0.3s ease, transform 0.3s ease;
            z-index: 10;
            pointer-events: none;
        }

        .action-card.show {
            display: flex;
            opacity: 1;
            transform: scale(1);
            pointer-events: auto;
        }

        .expired-date {
            color: #F24130 !important;
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
            background-color: #FABB6E;
            color: #FFF;
            border-radius: 4px;
            font-weight: 600;
        }

        .pagination .page-item.disabled .page-link {
            color: #C4CADA;
        }

        .pagination .page-item .page-link:hover {
            background-color: #FABB6E;
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
    </style>

    <style>
        .offcanvas-header {
            padding: 32px 16px 32px 32px;
        }

        .offcanvas-body {
            padding: 0px 32px 30px 32px;
        }

        .filter-content h5 {
            color: #071437;
            font-size: 16.25px;
            font-weight: 700;
            line-height: 19.5px;
            margin-bottom: 24px;
        }

        .filter-content span {
            color: #99A1B7;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

        .filter-content .dropdown-div {
            border-radius: 4px;
            border: 1px solid #DBDFE9;
            height: 40px;
            padding: 0px 12px;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
            display: flex;
            align-items: center;
        }

        .filter-content .dropdown-item {
            color: #1E1E1E;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
            padding: 12px 16px;
        }

        .filter-content .dropdown-menu {
            border-radius: 8px;
            border: 1px solid #D9D9D9;
            background: #fff;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            padding: 8px;
        }

        .filter-content .dropdown-item.active {
            background: #FFF6EA;
        }

        .filter-line {
            background-color: #F1F1F4;
            height: 1px;
            width: 100%;
            margin: 32px 0px;
        }

        .filter-content label {
            color: #071437;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
            margin-bottom: 8px;
        }

        .filter-content .input-text {
            color: #071437;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

        .filter-content button {
            display: flex;
            padding: 12px 18px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            flex: 1 0 0;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .filter-content .btn-outline {
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #78829D;
        }

        .filter-content .btn-apply {
            background: #F7941C;
            color: #fff;
        }

        .filter-content input[type="radio"]:checked {
            border: 5px solid #F7941C;
            padding: 3.9px;

        }

        .filter-content input[type="radio"] {
            appearance: none;
            border: 2px solid #DBDFE9;
            padding: 7px;
            border-radius: 50%;
        }

        .found-text {
            color: #252F4A;
            font-size: 13.975px;
            font-style: normal;
            font-weight: 500;
            line-height: 16.77px;
        }

        .filter-content .selected-text {
            padding: 8px 16px;
            border-radius: 80px;
            background: #F1F1F4;
            color: #4B5675;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            letter-spacing: 0.5px;
            gap: 4px;
            width: fit-content;
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

        .modal-div .btn-apply-disable {
            border: 1px solid #DBDFE9;
            background: #F1F1F4;
            color: #99A1B7;
        }

        .modal-div .year {
            border-radius: 8px 0px 0px 8px;
            background-color: #F1F1F4;
            width: 120px;
            color: #4B5675;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            padding: 12px 8px;
        }

        .modal-div .previous-job-btn {
            border-radius: 0px 4px 4px 0px;
            border: 1px solid #DBDFE9;
            background-color: #FFF;
            color: #99A1B7;
            font-size: 12px;
            font-style: normal;
            font-weight: 400;
            line-height: 16px;
            height: 42px;
        }

        .form-control:focus,
        .input-group-text:focus {
            box-shadow: none !important;
            border-color: #ced4da !important;
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
            width: 28%;
            padding: 16px 0px;
            margin-right: 24px;
            position: sticky;
            top: 140px;
        }

        .modal-step-form .tab-content {
            padding: 16px;
            width: 100%;

        }

        .modal-step-form .top-content {
            margin-bottom: 16px;
        }

        .modal-step-form .top-content h3 {
            color: #4B5675;
            font-size: 22.75px;
            font-weight: 700;
            line-height: 27.3px;
            margin: 0;
        }

        .modal-step-form .top-content p {
            color: #99A1B7;
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
            margin: 0;
        }

        .modal-step-form label {
            color: #071437;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

        .modal-step-form .input-grey {
            border-radius: 4px;
            background: #F1F1F4;
            border: 1px solid #DBDFE9;
        }

        .modal-step-form input,
        .modal-step-form select {
            border-radius: 4px;
            border: 1px solid #DBDFE9;
            display: flex;
            height: 40px;
            padding: 0px 12px;
            align-items: center;
            align-self: stretch;
            color: #4B5675;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }

        .modal-step-form form>div,
        .jp-body {
            /* max-height: 40vh;
                overflow: scroll; */
            padding-right: 10px;
        }

        .workflow-bottom {
            margin: 24px 0px 11.5px 0px;
        }

        .workflow-bottom p {
            width: 200px;
            color: #99A1B7;
        }

        .workflow-bottom h5 {
            color: #4B5675;
            font-size: 13.975px;
            font-weight: 500;
            line-height:
        }

        .workflow-bottom h5 span {
            font-size: 19.5px;
            font-weight: 700;
            line-height: 23.4px;
        }

        .workflow-bottom .green {
            color: #2AA443;
        }

        .workflow-bottom .red {
            color: #F24130;
        }

        .red-bottom-text {
            color: #F24130 !important;
            font-size: 10px !important;
            margin: 0;
            width: 208px;
            line-height: normal !important;
        }

        .document-card input[type="radio"] {
            appearance: none;
            border: 1px solid #DBDFE9;
            padding: 8px;
            border-radius: 50%;
        }

        input[type="radio"]:checked {
            background-color: #F7941C;
        }

        input[type="checkbox"] {
            accent-color: #F7941C !important;
            border: 1px solid #DBDFE9;
            width: 15px;
            height: 15px;
            border-radius: 4px;
            cursor: pointer;
            margin: auto 0;
        }

        input[type="checkbox"]:checked {
            background-color: #F7941C;
            border: 1px solid #F7941C;
        }

        .optional {
            font-style: italic;
            color: #99A1B7;
            font-weight: 400;
        }

        .optional-bottom {
            color: #4B5675 !important;
            font-size: 10px !important;
            font-weight: 400 !important;
            line-height: 16px !important;
            margin-bottom: 8px;
        }

        .tag-container {
            display: flex;
            flex-wrap: wrap;
            gap: 4px 12px;
            align-items: center;
        }

        .tag {
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
            height: 32px;
        }

        .tag .remove-tag {
            background: none;
            border: none;
            cursor: pointer;
            color: #6C7280;
            font-size: 20px;
            padding: 0;
        }

        .tag .remove-tag:hover {
            color: #F7941C;
        }

        .tag-input {
            border: none;
            outline: none;
            flex-grow: 1;
            min-width: 120px;
            background: transparent;
        }

        .document-card {
            border-radius: 8px;
            padding: 20px !important;
            position: relative;
            border: 1px solid #C4CADA !important;
        }

        .document-card .close-btn {
            position: absolute;
            top: 10px;
            right: 16px;
            font-size: 22px;
            cursor: pointer;
            color: #78829D;
        }

        .review-card {
            padding: 16px 16px 32px 16px;
            border-radius: 8px;
            box-shadow: 0px 1px 4px 0px #0C0C0D10;
        }

        .review-card .accordion-item {
            border: 0;
        }

        .review-card .accordion-item .accordion-header {
            display: flex;
            align-items: center;
            gap: 8px;
            align-self: stretch;
            border-bottom: 1px solid #F3F3F3;
            background-color: #fff;
            padding-bottom: 16px;
        }

        .review-card .accordion-body {
            padding: 24px 32px 0px 32px;
        }

        .review-card .accordion-item .accordion-button:not(.collapsed),
        .review-card .accordion-item .accordion-button {
            padding: 0;
            border-bottom: none;
            background-color: #fff;
            box-shadow: none;
            color: #292929;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
        }

        .accordion-body h4 {
            color: #071437;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
        }

        .accordion-body p {
            color: #78829D !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            line-height: 20px !important;
        }

        .review-card .accordion-item .accordion-header .edit-button {
            padding: 8px 16px;
            justify-content: center;
            gap: 8px;
            border-radius: 4px;
            border: 1px solid #99A1B7;
            background: #FFF;
            position: absolute;
            right: 60px;
            z-index: 10;
            color: #78829D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            height: 32px;
        }

        .jp-header {
            padding: 24px 24px 24px 48px;
            border-radius: 8px 8px 0px 0px;
            border: 1px solid #F1F1F4;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .jp-header h4 {
            color: #071437;
            font-size: 22.75px;
            font-weight: 500;
            line-height: 27.3px;
            margin-bottom: 8px;
        }

        .jp-header p {
            color: #99A1B7 !important;
            font-size: 13.975px !important;
            font-weight: 500 !important;
            line-height: 16.77px !important;
        }

        .jp-body {
            padding: 48px;
            border-radius: 0px 0px 8px 8px;
            border-right: 1px solid #F1F1F4;
            border-bottom: 1px solid #F1F1F4;
            border-left: 1px solid#F1F1F4;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            gap: 26px;
        }

        .jp-sidebar {
            width: 36%;
        }

        .jp-left-side {
            width: 62%;
        }

        .jp-left-side h5 {
            color: #071437;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
        }

        .jp-left-side p {
            color: #4B5675 !important;
            font-size: 16px !important;
            font-weight: 400 !important;
            line-height: 25px !important;
        }

        .jp-left-side .accordion-button,
        .jp-left-side .accordion-item {
            padding: 16px;
            border-radius: 8px;
            font-size: 16.25px;
            font-weight: 500;
            border: 0;
            line-height: 19.5px;
        }

        .jp-left-side .accordion-body {
            padding: 20px 0px 0px;
        }

        .jp-left-side .accordion-body ul li {
            color: #4B5675;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
        }

        .jp-left-side .accordion-button {
            padding: 0px;
        }

        .jp-left-side .accordion-item {
            border: 1px solid #DBDFE9;
        }

        .jp-left-side .accordion-button:not(.collapsed) {
            color: #071437;
            box-shadow: none;
            background: none;
        }

        .jp-sidebar .box {
            padding: 24px;
            border-radius: 8px;
            background: #FAFAFB;
        }

        .jp-sidebar h4 {
            color: #071437;
            font-size: 16.25px;
            font-weight: 500;
            line-height: 19.5px;
        }

        .jp-sidebar p {
            color: #4B5675 !important;
            font-size: 14px !important;
            font-weight: 400 !important;
            line-height: 22px !important;
        }

        .jp-sidebar h5 {
            color: #4B5675;
            font-size: 14px;
            font-weight: 700;
            line-height: 22px;
        }

        .jp-sidebar button {
            display: flex;
            padding: 14px 20px;
            justify-content: center;
            align-items: center;
            border-radius: 4px;
        }

        .jp-sidebar .btn-apply {
            background: #F7941C;
            color: #FFF;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
            flex: 1 0 0;
        }

        .jp-sidebar .btn-outline {
            display: flex;
            width: 48px;
            height: 48px;
            justify-content: center;
            align-items: center;
            border: 1px solid #99A1B7 !important;
            background: #FFF;
        }

        .display {
            display: none;
        }

        .department-name-filter {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-right: 10px;
        }

        .btn-disabled {
            opacity: 0.6;
            pointer-events: none;
        }
        .hover-effect:hover {
            background: #FFF6EA;
            border-radius: 8px;
        }

    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@endsection

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
                class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h2 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Job Board
                </h2>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/talent-acquisition/job-board" class="text-muted text-hover-primary">Talent
                            Acquisition</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Job Board</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content  flex-column-fluid position-lg-relative">
        <div id="kt_app_content_container" class="app-container  container-xxl  w-100 mt-17">
            <h1 class="text-dark fw-semibold lh-base m-0 mb-6" style="font-size: 32.5px;">
                Job Board
            </h1>
            <div id="feedbackMessage" class="justify-content-between align-items-center feedback-message mt-3 mb-3"
                style="display:none;">
                <p class="text-center fw-medium m-0">Link copied to your clipboard!</p>
                <iconify-icon icon="iconamoon:close-bold" width="24" height="24" class="cursor-pointer"
                    id="closeIcon"></iconify-icon>
            </div>
            <div class="container">
                <div class="row gap-6">
                    <div class="col card p-6">
                        <div class="d-flex justify-content-between align-items-center mb-10">
                            <h3 class="card-heading">Job Vacancy</h3>
                        </div>
                        @include('admin.talent-acquisition.job-board.job-vacancy.filter')
                        <div id="vacancy-table">
                            @include('admin.talent-acquisition.job-board.job-vacancy.index')
                        </div>
                    </div>
                    <div class="col-md-7 card p-6">
                        <div class="d-flex justify-content-between align-items-center tab-button-container mb-10">
                            <h3 class="card-heading">Job Advertisement</h3>
                            {{-- <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link @if ($status == 'ongoing') active @endif" data-bs-toggle="tab" href="#ongoing" data-status="ongoing">Ongoing</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if ($status == 'ready') active @endif" data-bs-toggle="tab" href="#ready" data-status="ready">Ready</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if ($status == 'filled') active @endif" data-bs-toggle="tab" href="#filled" data-status="filled">Filled</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if ($status == 'draft') active @endif" data-bs-toggle="tab" href="#draft" data-status="draft">Draft</a>
                                </li>
                            </ul> --}}
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link job-openings-tab active" href="#"
                                        data-status="ongoing">Ongoing</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link job-openings-tab" href="#" data-status="ready">Ready</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link job-openings-tab" href="#" data-status="filled">Filled</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link job-openings-tab" href="#" data-status="draft">Draft</a>
                                </li>
                            </ul>
                        </div>
                        @include('admin.talent-acquisition.job-board.job-advertisement.filter')
                        {{-- <div class="tab-content">
                            <div id="ongoing" class="tab-pane @if ($status == 'ongoing') active @endif">
                                <div id="ongoing-jobs">
                                    @include('admin.talent-acquisition.job-board.job-advertisement.table.ongoing', compact('jobOpenings'))
                                </div>
                            </div>
                            <div id="ready" class="tab-pane @if ($status == 'ready') active @endif">
                                <div id="ready-jobs">
                                    @include('admin.talent-acquisition.job-board.job-advertisement.table.ready', compact('jobOpenings'))
                                </div>
                            </div>
                            <div id="filled" class="tab-pane @if ($status == 'filled') active @endif">
                                <div id="filled-jobs">
                                    @include('admin.talent-acquisition.job-board.job-advertisement.table.filled', compact('jobOpenings'))
                                </div>
                            </div>
                            <div id="draft" class="tab-pane @if ($status == 'draft') active @endif">
                                <div id="draft-jobs">
                                    @include('admin.talent-acquisition.job-board.job-advertisement.table.draft', compact('jobOpenings'))
                                </div>
                            </div>
                        </div> --}}
                        {{-- {{ dd($jobOpenings) }} --}}
                        <div id="job-openings-section">
                            <div class="tab-content">
                                <div id="ongoing" class="tab-pane active">
                                    <div id="ongoing-jobs">
                                        @include(
                                            'admin.talent-acquisition.job-board.job-advertisement.table.ongoing',
                                            compact('jobOpenings'))
                                    </div>
                                </div>
                                <div id="ready" class="tab-pane">
                                    <div id="ready-jobs"></div>
                                </div>
                                <div id="filled" class="tab-pane">
                                    <div id="filled-jobs"></div>
                                </div>
                                <div id="draft" class="tab-pane">
                                    <div id="draft-jobs"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@include('admin.talent-acquisition.job-board.job-advertisement.modal')
@include('admin.talent-acquisition.job-board.create-edit-job-advertisement.edit-job-advertisement')

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        document.addEventListener('click', function(event) {
            const target = event.target.closest(".copyLink");
            if (target) {
                event.preventDefault();

                const link = target.getAttribute("data-link");
                const feedbackMessage = document.getElementById("feedbackMessage");

                navigator.clipboard.writeText(link).then(() => {
                    console.log("Link copied: " + link);
                    feedbackMessage.style.display = "flex";

                    setTimeout(() => {
                        feedbackMessage.scrollIntoView({
                            behavior: "smooth",
                            block: "start"
                        });
                        window.scrollBy(0, -750);
                    }, 100);
                }).catch(err => {
                    console.error("Failed to copy: ", err);
                });
            }
        });

        // Close the feedback message when close icon is clicked
        document.addEventListener('DOMContentLoaded', function() {
            const closeIcon = document.getElementById("closeIcon");
            if (closeIcon) {
                closeIcon.addEventListener("click", function() {
                    document.getElementById("feedbackMessage").style.display = "none";
                });
            }
        });
    </script>




    <script>
function updateDropdownText(element) {
    let dropdown = element.closest(".dropdown");
    let dropdownButton = dropdown.querySelector(".dropdown-div");

    let selectedText;

    // Case 1: If there's a department name wrapper
    const deptName = element.querySelector('.department-name-filter');
    if (deptName) {
        selectedText = deptName.textContent.trim();
    } else {
        // Case 2: Extract only text node (exclude span and others)
        selectedText = Array.from(element.childNodes)
            .filter(node => node.nodeType === Node.TEXT_NODE)
            .map(node => node.textContent.trim())
            .join(" ");
    }

    // Update the visible dropdown button text
    dropdownButton.textContent = selectedText;

    // Handle sortDropdown1
    if (dropdown.id === "sortDropdown1") {
        document.querySelector("#selectedSort").textContent = "Sort By: " + selectedText;

        dropdown.querySelectorAll(".dropdown-item .checkmark").forEach(span => span.innerHTML = "");
        element.querySelector(".checkmark").innerHTML =
            '<iconify-icon icon="fa6-solid:check" width="14" height="16"></iconify-icon>';
    }

    // Handle sortDropdown2
    if (dropdown.id === "sortDropdown2") {
        document.querySelector("#selectedDepartment").textContent = selectedText;

        dropdown.querySelectorAll(".dropdown-item").forEach(item => item.classList.remove("active"));
        element.classList.add("active");
    }

    // Close dropdown if Bootstrap is available
    if (typeof bootstrap !== "undefined") {
        var bsDropdown = new bootstrap.Dropdown(dropdownButton);
        bsDropdown.hide();
    }
}

    </script>

    <script>
        document.querySelectorAll('input[name="positionLevel"]').forEach(radio => {
            radio.addEventListener("change", function() {
                let selectedLevel = this.nextElementSibling.textContent.trim();
                document.querySelector("#selectedPositionLevel").textContent = "Position Level - " +
                    selectedLevel;
            });
        });
    </script>

    <script>
        function clearFilter(filterId, dropdownId = null) {
            let defaultText = {
                "selectedSort": "Sort By: Most Recent",
                "selectedDepartment": "Any Department",
                "selectedPositionLevel": "Position Level - Any"
            };

            // Reset Filter Text
            document.getElementById(filterId).textContent = defaultText[filterId];

            // Reset Dropdown
            if (dropdownId) {
                let dropdown = document.getElementById(dropdownId);
                let dropdownButton = dropdown.querySelector(".dropdown-div");
                dropdownButton.textContent = defaultText[filterId];

                // Clear checkmarks and active classes
                dropdown.querySelectorAll(".dropdown-item .checkmark").forEach(span => span.innerHTML = "");
                dropdown.querySelectorAll(".dropdown-item").forEach(item => item.classList.remove("active"));
            }
        }
    </script>

    <script>
        document.querySelectorAll(".clear-all-btn").forEach(button => {
            button.addEventListener("click", function() {
                clearFilter("selectedSort", "sortDropdown1");
                clearFilter("selectedDepartment", "sortDropdown2");
                clearFilter("selectedPositionLevel");

                document.querySelectorAll('input[name="positionLevel"]').forEach(radio => {
                    radio.checked = false;
                });

                let activeOffcanvas = document.querySelector(".offcanvas.show");
                if (!activeOffcanvas) return;

                // let filterBtn = document.querySelector(
                //     `[data-bs-target="#${activeOffcanvas.id}"] .filterCount`
                // );

                let filterBtn = $('.filterCount');
       
                if (filterBtn) {
                    filterBtn.textContent = "";
                    filterBtn.closest(".filterBtn").classList.remove("filter-apply");
                }

                let jobVacanciesText = document.getElementById("jobVacanciesText");
                if (jobVacanciesText) jobVacanciesText.style.display = "none";
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const applyBtn = document.getElementById("applyFiltersBtn");
        
            function updateApplyButtonState() {
                const sortText = document.getElementById("selectedSort").textContent.trim();
                const departmentText = document.getElementById("selectedDepartment").textContent.trim();
                const positionLevelText = document.getElementById("selectedPositionLevel").textContent.trim();

                const isSortChanged = sortText !== "Sort By: Most Recent";
                const isDepartmentChanged = departmentText !== "Any Department";
                const isPositionLevelChanged = positionLevelText !== "Position Level - Any";
        
                const shouldEnable = isSortChanged || isDepartmentChanged || isPositionLevelChanged;
        
                if (shouldEnable) {
                    applyBtn.removeAttribute("disabled");
                    applyBtn.classList.remove("btn-disabled");
                } else {
                    applyBtn.setAttribute("disabled", true);
                    applyBtn.classList.add("btn-disabled");
                }
            }
        
            // Watch for changes in dropdown selections
            document.querySelectorAll("#sortDropdown1 .dropdown-item, #sortDropdown2 .dropdown-item").forEach(item => {
                item.addEventListener("click", () => setTimeout(updateApplyButtonState, 50));
            });
        
            // Watch for changes in position level radio buttons
            document.querySelectorAll('input[name="positionLevel"]').forEach(radio => {
                radio.addEventListener("change", updateApplyButtonState);
            });
        
            // When 'Clear All' button is clicked
            document.querySelectorAll(".clear-all-btn").forEach(btn => {
                btn.addEventListener("click", () => {
                    document.querySelector("#openFilterBtn .filterCount").innerHTML = "";
                    setTimeout(updateApplyButtonState, 100);
                });
            });
        
            // Initial state
            updateApplyButtonState();
        });
        </script>
        

    <script>
        document.querySelectorAll(".applyFilters").forEach(button => {
            button.addEventListener("click", function(event) {
                let filterCount = 0;
                let jobVacancies = 7; // Set dynamically

                // Get Selected Values
                let selectedSort = document.getElementById("selectedSort").textContent.trim();
                let selectedDepartment = document.getElementById("selectedDepartment").textContent.trim();
                let selectedPosition = document.getElementById("selectedPositionLevel").textContent.trim();

                // Count Filters Applied
                if (selectedSort !== "Sort By: Most Recent") filterCount++;
                if (selectedDepartment !== "Any Department") filterCount++;
                if (selectedPosition !== "Position Level - Any") filterCount++;

                if (filterCount === 0) {
                    event.stopPropagation();
                    alert("Please select at least one filter before applying.");
                    return;
                }

                // Find the active Offcanvas
                let activeOffcanvas = document.querySelector(".offcanvas.show");
                if (!activeOffcanvas) return;

                // Find the button inside this specific Offcanvas
                let filterBtn = document.querySelector(
                    `[data-bs-target="#${activeOffcanvas.id}"] .filterCount`
                );
                
                if (filterBtn) {
                    filterBtn.textContent = `(${filterCount})`;
                    filterBtn.closest(".filterBtn").classList.add("filter-apply");
                }

                // Show job vacancies text
                let jobVacanciesText = document.getElementById("jobVacanciesText");
                jobVacanciesText.textContent = `${jobVacancies} job vacancies found`;
                jobVacanciesText.style.display = "block";
            });
        });
    </script>

    <script>
        function setDropdownValue(element, targetClass) {
            let fullText = element.innerText.trim(); // Get full text
            let maxLength = 35; // Set max length for truncation
            let truncatedText = fullText.length > maxLength ? fullText.substring(0, maxLength) + "..." : fullText;

            let targetElement = document.querySelector('.' + targetClass);
            targetElement.innerText = truncatedText; // Show truncated text
            // Use data-bs-title for tooltip content to avoid native title conflicts
            targetElement.setAttribute('data-bs-title', fullText || ''); // Show full text on hover
            if (targetElement.hasAttribute('title')) targetElement.removeAttribute('title');

            checkButtonState(); // Check if button should be enabled
        }

        function checkButtonState() {
            let yearSelected = document.querySelector('.year').innerText !== "Select a Year";
            let jobSelected = document.querySelector('.previous-job-btn').innerText !==
                "Select a Previous Job Advertisement";
            let applyUSeBtn = document.getElementById('applyUSeBtn');

            if (yearSelected && jobSelected) {
                applyUSeBtn.classList.remove('btn-apply-disable'); // Activate button
                applyUSeBtn.removeAttribute('disabled');
                applyUSeBtn.innerText = "Review Details"; // Change button text
            } else {
                applyUSeBtn.classList.add('btn-apply-disable'); // Disable button
                applyUSeBtn.setAttribute('disabled', 'true');
                applyUSeBtn.innerText = "Use This Ad Information"; // Reset button text
            }
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#startDate", {
                dateFormat: "d M Y",
                defaultDate: "17 Dec 2024"
            });

            flatpickr("#endDate", {
                dateFormat: "d M Y",
                defaultDate: "27 Dec 2025"
            });

            flatpickr("#endDateExpire", {
                dateFormat: "d M Y",
            });

            document.querySelector('.endDateExpire').addEventListener('click', function () {
                document.querySelector('#endDateExpire').focus();
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navLinks = document.querySelectorAll(".nav-link");

            navLinks.forEach((link) => {
                link.addEventListener("click", function() {
                    // Remove active class from all span elements
                    document.querySelectorAll(".circle-gray").forEach((span) => {
                        span.classList.remove("active");
                    });

                    // Find the span inside the clicked button and add active class
                    const span = this.querySelector(".circle-gray");
                    if (span) {
                        span.classList.add("active");
                    }
                });
            });
        });
    </script>

    <script>
        document?.getElementById("tagInput")?.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                addTag();
            }
        });

        function addTag() {
            let input = document?.getElementById("tagInput");
            let tagContainer = document.getElementById("tagContainer");

            if (input.value.trim() !== "") {
                let tag = document.createElement("div");
                tag.className = "tag";
                tag.innerHTML = `${input.value} <button class="remove-tag" onclick="removeTag(this)">&times;</button>`;
                tagContainer.insertBefore(tag, input);
                input.value = "";
            }
        }

        function removeTag(button) {
            button.parentElement.remove();
        }
    </script>

    <script>
        function updateExperience(element) {
            document.getElementById("dropdownSelectedExperience").innerText = element.innerText;
        }
    </script>

    <script>
        document?.getElementById("addField")?.addEventListener("click", function() {
            // Clone the existing document-card
            let originalCard = document.querySelector(".document-card");
            let newCard = originalCard.cloneNode(true);

            // Remove any existing input values from the cloned card
            newCard.querySelector("input[type='text']").value = "";

            // Generate unique names for radio inputs to avoid selection conflicts
            let randomId = Math.floor(Math.random() * 10000);
            newCard.querySelectorAll("input[type='radio']").forEach((radio, index) => {
                radio.name = `documentType${randomId}-${index}`;
            });

            newCard.style.marginTop = "16px"; // Adjust as needed

            // Attach remove event to the close button
            newCard.querySelector(".close-btn").addEventListener("click", function() {
                this.parentElement.remove();
            });

            // Append the new card to the container
            document.getElementById("documentContainer").appendChild(newCard);
        });

        // Remove document card when close button is clicked
        document?.querySelector(".close-btn")?.addEventListener("click", function() {
            this.parentElement.remove();
        });
    </script>

    <script>
function updateDropdownText2(element) {
    let dropdown = element.closest(".dropdown");
    let dropdownButton = dropdown.querySelector(".dropdown-div");

    let selectedText;

    // Handle department dropdown (has <p class="department-name-filter">)
    const deptName = element.querySelector('.department-name-filter');
    if (deptName) {
        selectedText = deptName.textContent.trim();
    } else {
        // Fallback for plain text dropdowns (like sortDropdown2)
        selectedText = Array.from(element.childNodes)
            .filter(node => node.nodeType === 3)
            .map(node => node.textContent.trim())
            .join(" ");
    }

    dropdownButton.textContent = selectedText;

    if (dropdown.id === "sortDropdown2") {
        document.querySelector("#selectedSort2").textContent = "Sort By: " + selectedText;

        dropdown.querySelectorAll(".dropdown-item .checkmark").forEach(span => span.innerHTML = "");
        element.querySelector(".checkmark").innerHTML =
            '<iconify-icon icon="fa6-solid:check" width="14" height="16"></iconify-icon>';
    }

    if (dropdown.id === "sortDropdown3") {
        document.querySelector("#selectedDepartment2").textContent = selectedText;
        dropdown.querySelectorAll(".dropdown-item").forEach(item => item.classList.remove("active"));
        element.classList.add("active");
    }

    if (typeof bootstrap !== "undefined") {
        var bsDropdown = new bootstrap.Dropdown(dropdownButton);
        bsDropdown.hide();
    }
}



        document.querySelectorAll('input[name="positionLevelJob"]').forEach(radio => {
            radio.addEventListener("change", function() {
                let selectedLevel = this.nextElementSibling.textContent.trim();
                document.querySelector("#selectedPositionLevel2").textContent = "Position Level - " +
                    selectedLevel;
            });
        });

        document.querySelectorAll('input[name="jobOpeningStatus"]').forEach(radio => {
            radio.addEventListener("change", function() {
                let selectedStatus = this.nextElementSibling.textContent.trim();
                document.querySelector("#selectedStatus2").textContent = "Status - " +
                    selectedStatus;
            });
        });

        function clearFilter2(filterId, dropdownId = null) {
            let defaultText = {
                "selectedSort2": "Sort By: Most Recent",
                "selectedDepartment2": "Any Department",
                "selectedPositionLevel2": "Position Level - Any",
                "selectedStatus2": "Status - Any"
            };

            // Reset Filter Text
            document.getElementById(filterId).textContent = defaultText[filterId];

            // Reset Dropdown
            if (dropdownId) {
                let dropdown = document.getElementById(dropdownId);
                let dropdownButton = dropdown.querySelector(".dropdown-div");
                dropdownButton.textContent = defaultText[filterId];

                dropdown.querySelectorAll(".dropdown-item .checkmark").forEach(span => span.innerHTML = "");
                dropdown.querySelectorAll(".dropdown-item").forEach(item => item.classList.remove("active"));
            }
        }

        document.querySelectorAll(".clear-all-btn2").forEach(button => {
            button.addEventListener("click", function() {
                clearFilter2("selectedSort2", "sortDropdown2");
                clearFilter2("selectedDepartment2", "sortDropdown3");
                clearFilter2("selectedPositionLevel2");
                clearFilter2('selectedStatus2');

                document.querySelectorAll('input[name="positionLevel2"]').forEach(radio => {
                    radio.checked = false;
                });

                let activeOffcanvas = document.querySelector(".offcanvas.show");
                if (!activeOffcanvas) return;

                let filterBtn = document.querySelector(
                    `[data-bs-target="#${activeOffcanvas.id}"] .filterCount2`
                );
                updateFilterCountDisplay();
                if (filterBtn) {
                    filterBtn.textContent = "";
                    filterBtn.closest(".filterBtn2").classList.remove("filter-apply");
                }

                let jobVacanciesText = document.getElementById("jobVacanciesText2");
                if (jobVacanciesText) jobVacanciesText.style.display = "none";
            });
        });

        document.querySelectorAll(".applyFilters2").forEach(button => {
            button.addEventListener("click", function(event) {
                let filterCount = 0;
                let jobVacancies = 7; // Set dynamically

                // Get Selected Values
                let selectedSort = document.getElementById("selectedSort2").textContent.trim();
                let selectedDepartment = document.getElementById("selectedDepartment2").textContent.trim();
                let selectedPosition = document.getElementById("selectedPositionLevel2").textContent.trim();
                let selectedStatus = document.getElementById("selectedStatus2").textContent.trim();

                // Count Filters Applied
                if (selectedSort !== "Sort By: Most Recent") filterCount++;
                if (selectedDepartment !== "Any Department") filterCount++;
                if (selectedPosition !== "Position Level - Any") filterCount++;
                if (selectedStatus !== "Status - Any") filterCount++;

                if (filterCount === 0) {
                    event.stopPropagation();
                    alert("Please select at least one filter before applying.");
                    return;
                }

                // Find the active Offcanvas
                let activeOffcanvas = document.querySelector(".offcanvas.show");
                if (!activeOffcanvas) return;

                // Find the button inside this specific Offcanvas
                let filterBtn = document.querySelector(
                    `[data-bs-target="#${activeOffcanvas.id}"] .filterCount2`
                );
                updateFilterCountDisplay();
                if (filterBtn) {
                    filterBtn.textContent = `(${filterCount})`;
                    filterBtn.closest(".filterBtn2").classList.add("filter-apply");
                }

                // Show job vacancies text
                let jobVacanciesText = document.getElementById("jobVacanciesText2");
                jobVacanciesText.textContent = `${jobVacancies} job advertisement found`;
                jobVacanciesText.style.display = "block";
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const applyBtn2 = document.getElementById("applyFiltersBtn2");
        
            function updateApplyButtonState2() {
                const sortText = document.getElementById("selectedSort2").textContent.trim();
                const departmentText = document.getElementById("selectedDepartment2").textContent.trim();
                const positionLevelText = document.getElementById("selectedPositionLevel2").textContent.trim();
                const statusText = document.getElementById("selectedStatus2").textContent.trim();
        
                const isSortChanged = sortText !== "Sort By: Most Recent";
                const isDepartmentChanged = departmentText !== "Any Department";
                const isPositionLevelChanged = positionLevelText !== "Position Level - Any";
                const isStatusChanged = statusText !== "Status - Any";
        
                const shouldEnable = isSortChanged || isDepartmentChanged || isPositionLevelChanged || isStatusChanged;
        
                if (shouldEnable) {
                    applyBtn2.removeAttribute("disabled");
                    applyBtn2.classList.remove("btn-disabled");
                } else {
                    applyBtn2.setAttribute("disabled", true);
                    applyBtn2.classList.add("btn-disabled");
                }
            }
        
            // Trigger on dropdown changes
            document.querySelectorAll("#sortDropdown2 .dropdown-item, #sortDropdown3 .dropdown-item").forEach(item => {
                item.addEventListener("click", () => setTimeout(updateApplyButtonState2, 100));
            });
        
            // Trigger on position level radio change
            document.querySelectorAll('input[name="positionLevelJob"]').forEach(radio => {
                radio.addEventListener("change", updateApplyButtonState2);
            });
        
            // Trigger on status radio change
            document.querySelectorAll('input[name="jobOpeningStatus"]').forEach(radio => {
                radio.addEventListener("change", updateApplyButtonState2);
            });
        
            // Trigger on clear all
            document.querySelectorAll(".clear-all-btn2").forEach(btn => {
                btn.addEventListener("click", () => {
                    document.querySelector(".filterBtn2 .filterCount2").innerHTML = "";
                    setTimeout(updateApplyButtonState2, 100);
                });
            });
        
            // Initial check
            updateApplyButtonState2();
        });
    </script>
    

    <script>
        $(document).ready(function() {

            document.querySelectorAll('input[name="positionLevel"]').forEach(radio => {
                radio.addEventListener("change", function() {
                    let selectedLevel = this.value; // Get the numeric value of selected level
                    document.querySelector("#selectedPositionLevel").textContent =
                        "Position Level - " + selectedLevel;
                        updateFilterCount();
                });
            });

            const deptElement = document.getElementById("selectedDepartment");

            const observer = new MutationObserver(() => {
                if (deptElement.textContent.trim() !== "Any Department") {
                    console.log("Done");
                    updateFilterCount()
                }
            });

            observer.observe(deptElement, { childList: true, characterData: true, subtree: true });


            // Function to load vacancies
            function loadVacancies(page = 1) {
                showOverlay();
                // Collect filter values
                let search = $('#search').val(); // Get the search input value
                let perPage = $('#vacancy-table select[name="per_page"]').val(); // Rows per page
                let departmentId = $('#sortDropdown2 .dropdown-item.active').data('id'); // Selected department ID
                let positionLevel = $('input[name="positionLevel"]:checked').val(); // Selected position level
                let sort = $(".jobFilter .dropdown-div").text().trim();
                let sortType = (sort == 'Job Title A-Z' || sort == 'Most Recent') ? 'asc' :
                'desc'; // Ascending or Descending
                $.ajax({
                    url: '{{ route('admin.talent-acquisition.job-board.index') }}',
                    method: 'GET',
                    data: {
                        page: page,
                        per_page: perPage,
                        search: search, // Send search term to the server
                        department_id: departmentId, // Send department filter
                        position_level: positionLevel, // Send position level filter
                        sort: sort, // Send selected sort option
                        sort_type: sortType, // Send sort direction (asc/desc)
                    },
                    success: function(response) {
                        $('#vacancy-table').html(response.html); // Update the table with new data
                        $('#jobVacanciesText').text(
                        `Found ${response.total_count} job vacancies`); // Show vacancy count
                        $('#jobVacanciesText').show(); // Display the text
                        hideOverlay();
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr); // Log error in case of failure
                        hideOverlay();
                    }
                });
            }

            // Load on page change
            $(document).on('click', '#vacancy-table .pagination a', function(e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                loadVacancies(page);
            });

            $('.clear-all-btn').on('click', function() {
                loadVacancies(1); // Load results from the first page
            });


            // Trigger sorting when a dropdown item is clicked
            $('#sortDropdown1 .dropdown-menu a').on('click', function() {
                updateDropdownText(this); // Call the function to update the dropdown text and sort
            });

            // Update dropdown text and sorting parameters
            function updateDropdownText(element) {
                var selectedOption = $(element).text().trim(); // Get selected sort option
                $('#sortDropdown1 .form-select').text(selectedOption); // Update dropdown button text

                // Determine the sort type (ascending or descending)
                var sortType = (selectedOption === 'Job Title A-Z' || selectedOption === 'Most Recent') ? 'asc' :
                    'desc';

                // Store the selected sort and sort type in the global scope
                selectedSort = selectedOption;
                selectedSortType = sortType; // Trigger the AJAX request to load vacancies with selected sorting
                updateFilterCount();
            }

            $('#filter-btn').on('click', function() {
                loadVacancies(1); // Load results from the first page
            });


            // Listen for change event on the rows per page dropdown
            $(document).on('change', '#rowsPerPage', function() {
                // Get the selected value from the dropdown
                let perPage = $(this).val();
                // Call loadResults with the selected rows per page and reset to page 1
                loadVacancies(1, perPage);
            });

            $('#offcanvasRight .applyFilters').on('click', function() {
                $('#jobVacanciesText').hide();
                loadVacancies(1); // Reload vacancies starting from page 1 when the apply button is clicked
            });

            $('#resetSort').on('click', function () {
                // Reset the dropdown text
                $('#sortDropdown1 .form-select').text('Most Recent');

                // Update selectedSort and selectedSortType variables
                selectedSort = 'Most Recent';
                selectedSortType = 'asc';

                // Update selected sort display text
                $('#selectedSort').text('Sort By: Most Recent');

                // Remove all checkmarks
                $('#sortDropdown1 .dropdown-item .checkmark').html('');

                // Add checkmark to "Most Recent"
                $('#sortDropdown1 .dropdown-item').each(function () {
                    if ($(this).text().trim().startsWith('Most Recent')) {
                        $(this).find('.checkmark').html('<iconify-icon icon="fa6-solid:check" width="14" height="16"></iconify-icon>');
                    }
                });

                updateFilterCount();

                // Reload vacancies with reset sorting
                loadVacancies(1);
            });

            function updateFilterCount() {
                let count = 0;

                if ($('#selectedSort').text().trim() !== 'Sort By: Most Recent') {
                    count++;
                }

                if ($('#selectedDepartment').text().trim() !== 'Any Department') {
                    count++;
                }

                if ($('#selectedPositionLevel').text().trim() !== 'Position Level - Any') {
                    count++;
                }

                if (count > 0) {
                    $('.filterCount').text(`(${count})`); // Display the filter count
                } else {
                    $('.filterCount').text(''); // Hide the count if no filters are applied
                }
            }

            // Clear Sort Tag
            $('#selectedSortContainer iconify-icon').on('click', function () {
                $('#sortDropdown1 .form-select').text('Most Recent');
                $('#selectedSort').text('Sort By: Most Recent');

                $('#sortDropdown1 .dropdown-item .checkmark').html('');
                $('#sortDropdown1 .dropdown-item').each(function () {
                    if ($(this).text().trim().startsWith('Most Recent')) {
                        $(this).find('.checkmark').html('<iconify-icon icon="fa6-solid:check" width="14" height="16"></iconify-icon>');
                    }
                });

                updateFilterCount();

                const offcanvasEl = document.getElementById('offcanvasRight');
                const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if (bsOffcanvas) {
                    bsOffcanvas.hide();
                }

                loadVacancies(1);
            });

            // Clear Department Tag
            $('#selectedDepartmentContainer iconify-icon').on('click', function () {
                $('#sortDropdown2 .dropdown-div').text('Any Department');
                $('#selectedDepartment').text('Any Department');
                $('#sortDropdown2 .dropdown-item').removeClass('active');
                $('#sortDropdown2 .dropdown-item .checkmark').html('');
                updateFilterCount();
                const offcanvasEl = document.getElementById('offcanvasRight');
                const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if (bsOffcanvas) {
                    bsOffcanvas.hide();
                }
                loadVacancies(1);
            });

            // Clear Position Level Tag
            $('#selectedPositionLevelContainer iconify-icon').on('click', function () {
                $('#selectedPositionLevel').text('Position Level - Any');
                $('input[name="positionLevel"]').prop('checked', false);
                updateFilterCount();
                const offcanvasEl = document.getElementById('offcanvasRight');
                const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if (bsOffcanvas) {
                    bsOffcanvas.hide();
                }
                loadVacancies(1);
            });


            // // Load on filter change (search or per_page)
            // $('#search, #vacancy-table select[name="per_page"]').on('change keyup', function() {
            //     loadVacancies(1);  // Reload vacancies starting from page 1 whenever search or per-page filter changes
            // });

            // Initial load
            loadVacancies(); // Load vacancies when the page first loads
        });
    </script>

    <script>
        function updateFilterCountDisplay() {
            let count = 0;

            if ($("#selectedSort2").text().trim() !== "Sort By: Most Recent") count++;
            if ($("#selectedDepartment2").text().trim() !== "Any Department") count++;
            if ($("#selectedPositionLevel2").text().trim() !== "Position Level - Any") count++;
            if ($("#selectedStatus2").text().trim() !== "Status - Any") count++;

            let filterCountEl = $(".filterCount2");
            let filterBtn = filterCountEl.closest(".filterBtn2");

            if (count > 0) {
                filterCountEl.text(`(${count})`);
                filterBtn.addClass("filter-apply");
            } else {
                filterCountEl.text("");
                filterBtn.removeClass("filter-apply");
            }
        }
    </script>


    <script>
        $(document).ready(function() {
            var currentTab = "ongoing"; // Default active tab
            var currentPage = 1;

            function fetchJobOpenings(status, page = 1) {
                showOverlay();

                let url = '{{ route('admin.talent-acquisition.job-board.getJobOpenings') }}';
                let search = $("#search_job").val();
                let perPage = $(`#rowsPerPage_${status}`).val() || 10;
                let departmentId = $("#sortDropdown3 .dropdown-item.active").data("id");
                let positionLevel = $("input[name='positionLevelJob']:checked").val();
                let jobOpeningStatus = $("input[name='jobOpeningStatus']:checked").val();

                // Fixing the sorting issue
                let sortText = $(".jobOpeningFilter .dropdown-div").text().trim();
                // let validSortOptions = {
                //     "Job Title A-Z": "job_title",
                //     "Job Title Z-A": "job_title",
                //     "Most Recent": "created_at",
                //     "Oldest": "created_at",
                //     "Most Total Vacancies": "vacancies",
                //     "Fewest Total Vacancies": "vacancies"
                // };

                // // Default to 'created_at' if invalid value
                // let sort = validSortOptions[sortText] || "created_at";
                let sortType = (sortText === "Job Title A-Z" || sortText === "Most Recent") ? "asc" : "desc";
                console.log(sortText, sortType);

                $.ajax({
                    url: url,
                    method: "GET",
                    data: {
                        status: status,
                        search_job_opening: search,
                        per_page_job_opening: perPage,
                        department_id_job_opening: departmentId,
                        position_level_job_opening: positionLevel,
                        job_opening_status: jobOpeningStatus,
                        sort_job_opening: sortText,
                        sort_type_job_opening: sortType,
                        page: page,
                    },
                    success: function(response) {
                        $(`#${status}-jobs`).html(response.html);
                        $(".job-openings-tab").removeClass("active");
                        $(`.job-openings-tab[data-status='${status}']`).addClass("active");
                        currentPage = response.current_page;
                        $('#jobVacanciesText2').text(
                        `Found ${response.total_count} job advertisement`); // Show vacancy count
                        $('#jobVacanciesText2').show(); // Display the text
                        hideOverlay();
                    },
                    error: function(xhr) {
                        console.log("Error fetching job openings:", xhr.responseText);
                        hideOverlay();
                    },
                });
            }


            function clearFilterTag(tagId, dropdownId = null, radioSelector = null, defaultText = '') {
                // Reset the tag label
                $(`#${tagId}`).text(defaultText);

                // Reset dropdown display and checkmarks
                if (dropdownId) {
                    $(`#${dropdownId} .dropdown-div`).text(defaultText);
                    $(`#${dropdownId} .dropdown-item`).removeClass('active');
                    $(`#${dropdownId} .dropdown-item .checkmark`).html('');

                    // Optional: set checkmark to default
                    if (defaultText.includes('Most Recent')) {
                        $(`#${dropdownId} .dropdown-item`).each(function () {
                            if ($(this).text().trim().startsWith('Most Recent')) {
                                $(this).find('.checkmark').html('<iconify-icon icon="fa6-solid:check" width="14" height="16"></iconify-icon>');
                            }
                        });
                    }
                }

                // Reset radio buttons if applicable
                if (radioSelector) {
                    $(radioSelector).prop('checked', false);
                }

                updateFilterCountDisplay(); // Update filter count display

                fetchJobOpenings(currentTab, 1);
            }

            // Tag icon click handlers
            $('#selectedSort2').siblings('iconify-icon').on('click', function () {
                clearFilterTag('selectedSort2', 'sortDropdown2', null, 'Sort By: Most Recent');
                const offcanvasEl = document.getElementById('job-advertisement');
                const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if (bsOffcanvas) {
                    bsOffcanvas.hide();
                }
            });

            $('#selectedDepartment2').siblings('iconify-icon').on('click', function () {
                clearFilterTag('selectedDepartment2', 'sortDropdown3', null, 'Any Department');
                const offcanvasEl = document.getElementById('job-advertisement');
                const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if (bsOffcanvas) {
                    bsOffcanvas.hide();
                }
            });

            $('#selectedPositionLevel2').siblings('iconify-icon').on('click', function () {
                clearFilterTag('selectedPositionLevel2', null, "input[name='positionLevelJob']", 'Position Level - Any');
                const offcanvasEl = document.getElementById('job-advertisement');
                const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if (bsOffcanvas) {
                    bsOffcanvas.hide();
                }
            });

            $('#selectedStatus2').siblings('iconify-icon').on('click', function () {
                clearFilterTag('selectedStatus2', null, "input[name='jobOpeningStatus']", 'Status - Any');
                const offcanvasEl = document.getElementById('job-advertisement');
                const bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                if (bsOffcanvas) {
                    bsOffcanvas.hide();
                }
            });


            // Handle Tab Click (Loads respective job openings)
            $(".job-openings-tab").on("click", function(e) {
                e.preventDefault();
                currentTab = $(this).data("status");
                currentPage = 1; // Reset to first page on tab switch

                $(".tab-pane").removeClass("active show");
                $(`#${currentTab}`).addClass("active show");

                const adsStatusFilter = document.getElementById("adsStatusFilterSection");
                const selectedStatusWrapper = document.getElementById("selectedStatusWrapper");

                if (adsStatusFilter && selectedStatusWrapper) {
                    if (currentTab === "ongoing") {
                        adsStatusFilter.style.display = "block";
                        selectedStatusWrapper.style.display = "flex";
                    } else {
                        adsStatusFilter.style.display = "none";
                        selectedStatusWrapper.style.display = "none";
                    }
                }

                fetchJobOpenings(currentTab, currentPage);
            });

            // Search within Active Tab
            $('#filter-btn2').on('click', function() {
                fetchJobOpenings(currentTab, 1); // Load results from the first page
            });

            // Apply Filters
            $(".applyFilters2").on("click", function() {
                $('#jobVacanciesText2').hide();
                fetchJobOpenings(currentTab, 1);
            });

            // Handle Pagination in Active Tab
            $(document).on("click", "#job-openings-section .job-opening-pagination .pagination a", function(e) {
                e.preventDefault();
                let page = $(this).attr("href").split("page=")[1];
                fetchJobOpenings(currentTab, page);
            });

            // Rows Per Page Change (Affects Active Tab)
            $(document).on("change", ".rowsPerPageJobOpening", function() {
                fetchJobOpenings(currentTab, 1);
            });

            // Reset Sort Functionality
            $('#resetSort2').on('click', function () {
                // Reset the sorting dropdown text
                $('#sortDropdown2 .dropdown-div').text('Sort By: Most Recent');

                // Reset the selected sort display
                $('#selectedSort2').text('Sort By: Most Recent');

                // Remove all checkmarks inside the dropdown items
                $('#sortDropdown2 .dropdown-item .checkmark').html('');

                // Add checkmark to "Most Recent"
                $('#sortDropdown2 .dropdown-item').each(function () {
                    if ($(this).text().trim().startsWith('Most Recent')) {
                        $(this).find('.checkmark').html('<iconify-icon icon="fa6-solid:check" width="14" height="16"></iconify-icon>');
                    }
                });

                // Reload job openings with reset sorting
                fetchJobOpenings(currentTab, 1);
            });


            // Clear Filters
            $(".clear-all-btn2").on("click", function() {
                $("input[name='positionLevelJob']").prop("checked", false);
                $("input[name='jobOpeningStatus']").prop("checked", false);
                $("#sortDropdown2 .dropdown-div").text("Sort By: Most Recent");
                $("#sortDropdown3 .dropdown-div").text("Any Department");
                $("#selectedSort2").text("Sort By: Most Recent");
                $("#selectedDepartment2").text("Any Department");
                $("#selectedPositionLevel2").text("Position Level - Any");
                $("#selectedStatus2").text("Status - Any");

                fetchJobOpenings(currentTab, 1);
            });

            // Load default tab data on page load
            fetchJobOpenings(currentTab, currentPage);

            if (window.location.hash === '#ready') {
                $('.job-openings-tab[data-status="ready"]').click();
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let jobIdToDelete = null;

            // When clicking the delete button, store the job ID and title
            document.body.addEventListener("click", function(event) {
                if (event.target.closest(".delete-job")) {
                    let deleteBtn = event.target.closest(".delete-job");
                    jobIdToDelete = deleteBtn.getAttribute("data-job-id");
                    let jobTitle = deleteBtn.getAttribute("data-job-title");
                    console.log(jobIdToDelete, jobTitle);
                    // Update modal text
                    document.querySelector("#jobTitleToDelete").textContent = jobTitle;
                }
            });

            // Handle delete confirmation
            document.body.addEventListener("click", function(event) {
                if (event.target.closest(".delete-confirm")) {
                    if (jobIdToDelete) {
                        fetch(`/admin/talent-acquisition/job-board/job-openings/${jobIdToDelete}`, {
                                method: "DELETE",
                                headers: {
                                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute("content"),
                                    "Content-Type": "application/json",
                                }
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error("Failed to delete job");
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    toastr.success("Job deleted successfully!", "Status");

                                    // Remove the deleted row from the table
                                    document.querySelector(
                                            `.delete-job[data-job-id="${jobIdToDelete}"]`).closest("tr")
                                        .remove();
                                    location.reload();
                                    // Hide modal after successful deletion
                                    let deleteModal = new bootstrap.Modal(document.getElementById(
                                        "DeleteModal"));
                                    deleteModal.hide();
                                } else {
                                    alert("Error deleting job.");
                                }
                            })
                            .catch(error => console.error("Error:", error));
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let jobIdToDelete = null;
            let jobTitleToDelete = null;

            // When clicking the delete job button, set job ID and title
            document.querySelectorAll('.delete-job').forEach(button => {
                button.addEventListener('click', function() {
                    jobIdToDelete = this.getAttribute('data-job-id');
                    jobTitleToDelete = this.getAttribute('data-job-title');
                    document.getElementById('jobTitleToDelete').textContent = jobTitleToDelete;
                });
            });

            // Handle the delete confirmation
            document.getElementById('deleteDraftBtn').addEventListener('click', function() {
                if (jobIdToDelete) {
                    fetch(`/admin/talent-acquisition/job-board/job-openings/${jobIdToDelete}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                                'Content-Type': 'application/json',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                toastr.success('Job draft deleted successfully!', 'Status');
                                location.reload();
                                // Close the modal
                                let modal = bootstrap.Modal.getInstance(document.getElementById(
                                    'DeleteDraftModal'));
                                modal.hide();

                            } else {
                                alert("Error deleting job.");
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        });
    </script>

    {{-- <script>
     document.addEventListener('DOMContentLoaded', function () {
    // This listens for when the modal is opened.
    $('#ModifyApplicationDate').on('show.bs.modal', function (event) {
        // Get the button that triggered the modal
        var button = $(event.relatedTarget); // Button that triggered the modal
        
        // Extract information from data-* attributes
        var jobId = button.data('job-id');
        var jobTitle = button.data('job-title');
        var startDate = button.data('start-date');
        var endDate = button.data('end-date');
        // Convert YYYY-MM-DD to DD MMM YYYY format
        let startDateFormatted = moment(startDate).format('DD MMM YYYY');
        let endDateFormatted = moment(endDate).format('DD MMM YYYY');
                console.log(jobId, jobTitle, startDate, endDate);

        // Update the modal's content
        var modal = $(this);
        modal.find('#jobTitle').text(jobTitle); // Set the job title in the modal
        modal.find('#jobTitleDescription').text(jobTitle); // Optionally, display more description if needed
        modal.find('#startDate').val(startDateFormatted); // Set start date in the modal
        modal.find('#endDate').val(endDateFormatted); // Set end date in the modal

        // Store the job ID in a hidden input or in the modal to send to the server
        modal.find('#setApplicationPeriodBtn').data('job-id', jobId);

        // Initialize flatpickr for start and end dates
        flatpickr("#startDate", {
            dateFormat: "d M Y", 
            defaultDate: startDateFormatted // Dynamically set selected start date
        });

        flatpickr("#endDate", {
            dateFormat: "d M Y",
            defaultDate: endDateFormatted // Dynamically set selected end date
        });
    });

    // Handle the form submission when the "Set Application Period" button is clicked
    $('#setApplicationPeriodBtn').on('click', function () {
        var jobId = $(this).data('job-id'); // Get the job ID from the button
        var startDate = $('#startDate').val(); // Get the start date from the modal
        var endDate = $('#endDate').val(); // Get the end date from the modal

        
        // Convert the date string (e.g., '02 Dec 2024') into 'YYYY-MM-DD' format
        let formattedStartDate = new Date(startDate).toISOString().split('T')[0];
        let formattedEndDate = new Date(endDate).toISOString().split('T')[0];

        // Send this data to the server via AJAX to update the job posting
        $.ajax({
            url: '/admin/talent-acquisition/job-board/job-openings/update-job-dates',  // Your API route to update job dates
            type: 'POST',
            data: {
                job_id: jobId,
                start_date: formattedStartDate,
                end_date: formattedEndDate,
                _token: '{{ csrf_token() }}'  // Make sure CSRF token is included
            },
            success: function (response) {
                console.log(response);
                if (response.success) {
                    // Close the modal
                    $('#ModifyApplicationDate').modal('hide');
                    toastr.success('Application dates updated successfully!', 'Status');
                    // Optionally, reload the page or update the job listing dynamically
                    location.reload(); // This will reload the page to reflect the updated data
                } else {
                    alert('Failed to update application dates!');
                }
            },
            error: function () {
                alert('There was an error processing your request!');
            }
        });
    });
});

   </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // This listens for when the modal is opened.
            $('#ModifyApplicationDate').on('show.bs.modal', function(event) {
                // Get the button that triggered the modal
                var button = $(event.relatedTarget);

                // Extract information from data-* attributes
                var jobId = button.data('job-id');
                var jobTitle = button.data('job-title');
                var startDate = button.data('start-date');
                var endDate = button.data('end-date');

                // Convert YYYY-MM-DD to DD MMM YYYY format using Moment.js
                let startDateFormatted = moment(startDate, "YYYY-MM-DD").format("DD MMM YYYY");
                let endDateFormatted = moment(endDate, "YYYY-MM-DD").format("DD MMM YYYY");

                console.log(jobId, jobTitle, startDate, endDate);

                // Update the modal's content
                var modal = $(this);
                modal.find('#jobTitle').text(jobTitle);
                modal.find('#jobTitleDescription').text(jobTitle);
                modal.find('#startDate').val(startDateFormatted);
                modal.find('#endDate').val(endDateFormatted);

                // Store the job ID in the button's data
                modal.find('#setApplicationPeriodBtn').data('job-id', jobId);

                // Initialize flatpickr for start and end dates
                flatpickr("#startDate", {
                    dateFormat: "d M Y",
                    defaultDate: startDateFormatted
                });

                flatpickr("#endDate", {
                    dateFormat: "d M Y",
                    defaultDate: endDateFormatted
                });
            });

            // Handle the form submission when "Set Application Period" button is clicked
            $('#setApplicationPeriodBtn').on('click', function() {
                var jobId = $(this).data('job-id');
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();

                // Convert 'DD MMM YYYY' to 'YYYY-MM-DD' without timezone shift
                let formattedStartDate = moment(startDate, "DD MMM YYYY").format("YYYY-MM-DD");
                let formattedEndDate = moment(endDate, "DD MMM YYYY").format("YYYY-MM-DD");

                // Send data to server via AJAX
                $.ajax({
                    url: '/admin/talent-acquisition/job-board/job-openings/update-job-dates',
                    type: 'POST',
                    data: {
                        job_id: jobId,
                        start_date: formattedStartDate,
                        end_date: formattedEndDate,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            $('#ModifyApplicationDate').modal('hide');
                            toastr.success('Application dates updated successfully!',
                            'Success');
                            location.reload();
                        } else {
                            alert('Failed to update application dates!');
                        }
                    },
                    error: function() {
                        alert('There was an error processing your request!');
                    }
                });
            });
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Open the modal and pass data when the link is clicked
            $('#AddToExpiry').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var jobId = button.data('job-id');
                var jobTitle = button.data('job-title');
                console.log(jobId, jobTitle); // Log the job ID and title

                // Set the job title in the modal
                var modal = $(this);
                modal.find('#jobTitleToExpire').text(jobTitle); // Set the job title to the modal

                // Store the job ID for later use
                modal.find('#setToExpiredBtn').data('job-id', jobId);
            });

            // Handle the "Yes, set to Expired" button click
            $('#setToExpiredBtn').on('click', function() {
                var jobId = $(this).data('job-id'); // Get the job ID stored on the button

                // Send an AJAX request to update the status of the job
                $.ajax({
                    url: '/admin/talent-acquisition/job-board/job-openings/set-to-expired', // Your route to set job to expired
                    type: 'POST',
                    data: {
                        job_id: jobId,
                        status: 3, // Expired status
                        _token: '{{ csrf_token() }}' // CSRF token for security
                    },
                    success: function(response) {
                        if (response.success) {
                            // Close the modal
                            $('#AddToExpiry').modal('hide');
                            toastr.success('Job advertisement has been set to expired!',
                                'Status');
                            // Optionally, reload the page to reflect the changes
                            location.reload();
                        } else {
                            alert('Failed to update the status!');
                        }
                    },
                    error: function() {
                        alert('There was an error processing your request!');
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Open the modal and pass data when the "Extend Expiry Date" link is clicked
            $('#ExtendExpiryDate').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var jobId = button.data('job-id');
                var jobTitle = button.data('job-title');
                var endDate = button.data('end-date');
                let endDateExpire = moment(endDate, "YYYY-MM-DD").format("DD MMM YYYY");
                // Set the job title in the modal
                var modal = $(this);
                modal.find('#jobTitleToExtend').text(jobTitle); // Set the job title to the modal
                modal.find('#jobTitleToExtendDesc').text(
                jobTitle); // Optionally set a description or other details

                // Set the current end date in the input field
                modal.find('#endDateExpire').val(endDateExpire);

                // Store the job ID for later use
                modal.find('#extendExpiryBtn').data('job-id', jobId);

                flatpickr("#endDateExpire", {
                    dateFormat: "d M Y",
                    defaultDate: endDateExpire // Dynamically set selected end date
                });
            });

            // Handle the "Set Expiry Date" button click
            $('#extendExpiryBtn').on('click', function() {
                var jobId = $(this).data('job-id'); // Get the job ID stored on the button
                var endDate = $('#endDateExpire').val(); // Get the end date from the modal

                let ExpireEndDate = moment(endDate, "DD MMM YYYY").format("YYYY-MM-DD");

                // Send an AJAX request to update the expiry date
                $.ajax({
                    url: '/admin/talent-acquisition/job-board/job-openings/extend-expiry-date', // Your route to extend expiry date
                    type: 'POST',
                    data: {
                        job_id: jobId,
                        end_date: ExpireEndDate,
                        _token: '{{ csrf_token() }}' // CSRF token for security
                    },
                    success: function(response) {
                        if (response.success) {
                            // Close the modal
                            $('#ExtendExpiryDate').modal('hide');
                            toastr.success('Expiry date extended successfully!', 'Status');
                            // Optionally, reload the page to reflect the changes
                            location.reload();
                        } else {
                            alert('Failed to update the expiry date!');
                        }
                    },
                    error: function() {
                        alert('There was an error processing your request!');
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // When the modal is triggered, get job data
            $('#LaunchAdvertisement').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var jobId = button.data('job-id');
                var jobTitle = button.data('job-title');
                console.log(jobId, jobTitle); // Log the job ID and title

                // Update the modal content with the job title
                var modal = $(this);
                modal.find('#jobTitleToLaunch').text(jobTitle); // Set the job title to the modal

                // Store the job ID in the modal for use when submitting the form
                modal.find('#launchJobBtn').data('job-id', jobId);
            });

            // Handle the "Yes, launch now" button click
            $('#launchJobBtn').on('click', function() {
                var jobId = $(this).data('job-id'); // Get the job ID from the button

                // Get the current date in YYYY-MM-DD format
                var currentDate = new Date().toISOString().split('T')[0];
                let formattedCurrentDate = moment(currentDate, "YYYY-MM-DD").format("YYYY-MM-DD");

                // Send an AJAX request to update the job status and start date
                $.ajax({
                    url: '/admin/talent-acquisition/job-board/job-openings/launch-advertisement', // Your route to launch advertisement
                    type: 'POST',
                    data: {
                        job_id: jobId,
                        start_date: formattedCurrentDate,
                        status: 2, // ACTIVE status
                        _token: '{{ csrf_token() }}' // CSRF token for security
                    },
                    success: function(response) {
                        if (response.success) {
                            // Close the modal
                            $('#LaunchAdvertisement').modal('hide');
                            toastr.success('Advertisement launched successfully!', 'Status');
                            // Optionally, reload the page to reflect the changes
                            location.reload();
                        } else {
                            alert('Failed to launch the advertisement!');
                        }
                    },
                    error: function() {
                        alert('There was an error processing your request!');
                    }
                });
            });
        });
    </script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const mappings = [
    { trigger: "#openFilterBtn", target: "#offcanvasRight" },
    { trigger: ".filterBtn2", target: "#job-advertisement" }
  ];

  mappings.forEach(map => {
    document.querySelectorAll(map.trigger).forEach(btn => {
      btn.addEventListener("click", function () {
        const offcanvasEl = document.querySelector(map.target);
        const bsOffcanvas = new bootstrap.Offcanvas(offcanvasEl);
        bsOffcanvas.show();
      });
    });
  });
});
</script>



<script>
    const jobDetailsBaseUrl = "{{ route('job-details', ':slug') }}"; // inject base route
</script>


<script>
    function navigateToJobBoard() {
       window.location.href = `/admin/talent-acquisition/job-board`;
   }

//    function navigateToJobBoardReady() {
//         // Find the "Ready" tab button using jQuery
//         const $readyTab = $('.job-openings-tab[data-status="ready"]');
        
//         if ($readyTab.length) {
//             // Simulate a click on the "Ready" tab
//             $readyTab.click();
//         } else {
//             // Fallback: Redirect to the job board with #ready hash
//             window.location.href = "{{ route('admin.talent-acquisition.job-board.index') }}#ready";
//         }
//     }

function navigateToJobBoardReady() {
        const jobBoardPath = "{{ route('admin.talent-acquisition.job-board.index', [], false) }}";
        const isOnJobBoardPage = window.location.pathname === jobBoardPath;
        const $readyTab = $('.job-openings-tab[data-status="ready"]');

        if (isOnJobBoardPage && $readyTab.length) {
            $readyTab.click();

            // Remove the #ready from URL after loading
            if (window.location.hash === '#ready') {
                history.replaceState(null, null, window.location.pathname);
            }
        } else {
            // Temporarily go to job board with #ready — main script will click the tab on load
            window.location.href = "{{ route('admin.talent-acquisition.job-board.index') }}#ready";
        }
    }

    // This goes inside your existing document ready block:
    $(document).ready(function () {
        if (window.location.hash === '#ready') {
            const $readyTab = $('.job-openings-tab[data-status="ready"]');
            if ($readyTab.length) {
                $readyTab.click();

                // Remove #ready from the URL once it's triggered
                history.replaceState(null, null, window.location.pathname);
            }
        }
    });


function navigateToJobBoardReadyNewPage() {
    const slug = document.getElementById('jobSlugHolder').value;
    if (slug) {
        const finalUrl = jobDetailsBaseUrl.replace(':slug', slug);
        window.open(finalUrl, '_blank'); // ← opens in a new tab
    } else {
        alert('Job slug not found!');
    }
}

</script>


@endsection
