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

        /* .app-content {
                padding: 45px 187px 225px 187px;
            } */

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

        /* .card-body div:last-child {
                margin: 0 !important;
            } */

        .col-lg-4 {
            padding-left: 0 !important;
        }

        .select2-container--bootstrap5 .select2-selection--multiple {
            float: right;
        }

        .select2-container .select2-selection--multiple .select2-selection__rendered {
            white-space: normal;
            width: fit-content;
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
            border: 1px solid #F7941C;
        }

        .submit-job-bot a {
            border: 1px solid #99A1B7;
            color: #78829D;
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
            background: #FFF6EA;
            border: none;
            color: #F7941C;
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
            padding: 8px 16px;
            background: #F7941C;
            justify-content: center;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            width: fit-content;
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
            min-width: 100px;
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
            /* padding-bottom: 0px; */
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
            color: #071437;
            font-size: 32.5px;
            font-weight: 600;
            line-height: 39px;
        }

        .unique .custom-popup-body p {
            color: #071437;
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

        .header-checked-orange h3 {
            color: #fff !important;
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

        .reset-btn {
            display: flex;
            padding: 4px;
            align-items: center;
            border-radius: 4px;
            background: #FFF6EA;
            border: none;
            color: #F7941C;
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


        .custom-toggle-wrapper {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .custom-toggle {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
        }

        .custom-toggle input[type="checkbox"] {
            width: 42px;
            height: 22px;
            -webkit-appearance: none;
            appearance: none;
            background-color: #ddd;
            outline: none;
            border-radius: 30px;
            position: relative;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .custom-toggle input[type="checkbox"]::before {
            content: '';
            width: 18px;
            height: 18px;
            background-color: #fff;
            border-radius: 50%;
            position: absolute;
            top: 2px;
            left: 2px;
            transition: 0.3s ease;
        }

        .custom-toggle input[type="checkbox"]:checked {
            background-color: #F7941C;
        }


        .custom-toggle input[type="checkbox"]:checked::before {
            transform: translateX(20px);
        }

        .custom-toggle label {
            font-weight: 500;
            font-size: 14px;
            color: #333;
        }

        .form-control:disabled,
        .form-control:disabled,
        .form-control[readonly],
        .form-control.form-control-solid {
            border: 1px solid #C8C8C9;
            background: #DBDFE9;
            color: #78829D;
        }

        .table-responsive {
            border-radius: 8px;
            border: 1px solid #DBDFE9;
        }

        .table th,
        .table td {
            vertical-align: middle !important;
            padding: 22px !important;
        }

        .table tbody tr td {
            border-top: 1px solid #DBDFE9 !important;
            height: 84px !important;
            color: #071437 !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            line-height: 20px;
        }

        .table thead th {
            color: #99A1B7 !important;
            font-size: 12px !important;
            font-weight: 600 !important;
            line-height: 16px;
        }

        .btn-light-danger {
            color: #ff5959;
            background: #f9ecec;
            border: none;
        }

        .btn-light-danger:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }


        .table:not(.table-bordered) td:first-child,
        .table:not(.table-bordered) th:first-child,
        .table:not(.table-bordered) tr:first-child {
            padding-left: 22px !important;
        }

        .tooltip-inner {
            max-width: 300px !important;
            white-space: normal;
        }

        .delete-function iconify-icon,
        .edit-function iconify-icon {
            height: 24px;
            width: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .select2-container .select2-selection--single .select2-selection__clear {
            position: absolute;
        }

        .is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.1rem rgba(220, 53, 69, 0.25);
        }

        .select2-container--bootstrap5 .select2-selection--single {
            height: 43.5px !important;
            border: 1px solid #DBDFE9;
        }

        button.remove-headcount:disabled iconify-icon {
            color: #99A1B7 !important;
        }

        .disabled-custom iconify-icon {
            color: #99A1B7 !important;
            cursor: default;
        }

        /* Common badge style */
        .badge-soft {
            display: inline-block;
            height: 24px;
            padding: 4px 12px;
            border-radius: 80px;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            max-width: 219px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            vertical-align: middle;
        }

        .badge-company {
            color: #A56313;
            background-color: #FFF5DA;
        }

        .badge-master {
            color: #125A78;
            background-color: #E3F7FF;
        }

        .badge-green {
            background-color: #DDF5E2;
            color: #196329;
        }

        .badge-purple {
            background-color: #F2EEFD;
            color: #6652A1;
        }

        .select2-selection__placeholder {
            width: 100%;
        }

        /* Ensure select2 options are aligned */
        .select2-results__option {
            padding: 12px 16px !important;
        }

        .select2-results__option:hover,
        .select2-container--bootstrap5 .select2-dropdown .select2-results__option.select2-results__option--selected,
        .select2-container--bootstrap5 .select2-dropdown .select2-results__option.select2-results__option--highlighted {
            background-color: #FFF6EA !important;
            color: #4B5675 !important;
        }

        .select2-selection__rendered {
            display: flex !important;
            /* justify-content: space-between; */
            align-items: center;
            width: 100%;
        }

        .span-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #3E3E3E;
            max-width: 50%;
            color: #3E3E3E;
        }

        /* Orange border when active */
        .select2-container--focus .select2-selection {
            border: 1px solid #F7941C !important;
            box-shadow: 0 0 0 2px rgba(247, 148, 28, 0.15);
        }

        .select2-container--bootstrap5 .select2-dropdown {
            border-radius: 8px;
            border: 1px solid #DBDFE9;
            background: #fff;
            box-shadow: 0 3px 4px 0 rgba(0, 0, 0, 0.03);
            margin-top: 10px;
            padding: 8px;
        }

        .select2-container--bootstrap5 .select2-dropdown .select2-search {
            padding: 0px !important;
        }

        .select2-container--bootstrap5 .select2-dropdown .select2-results__option.select2-results__option--selected:after {
            display: none;
        }

        .custom-tooltip>span {
            margin-right: 10px;
        }

        .custom-tooltip .dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;

        }

        .dot-sky {
            background: #E3F7FF;
        }

        .dot-yellow {
            background: #FFF5DA;
        }

        .dot-green {
            background: #DDF5E2;
        }

        .dot-purple {
            background: #F2EEFD;
        }

        li[role="alert"].select2-results__message {
            height: 116px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        li[role="alert"].select2-results__message:hover {
            background: #fff !important;
        }

        .btn:disabled,
        .add-function:disabled {
            border: 1px solid #DBDFE9 !important;
            background-color: #F1F1F4 !important;
            color: #99A1B7 !important;
        }

        #riasec-block .select2-container .select2-selection--multiple {
            /* display: block; */
            height: 43.59px;
        }

        #riasecValidationMessage {
            position: absolute;
        }

        .select2-search--dropdown {
            position: relative;
        }

        .select2-search__field {
            padding-left: 28px !important;
            border: 1px solid #cdd5df;
            border-radius: 6px;
            font-size: 14px;
            color: #333;
        }

        #riasec-block .select2-search__field {
            padding-left: 0px !important;
        }

        .select2-search--dropdown::before {
            content: "\f002";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            pointer-events: none;
        }

        .bg-modal-content {
            padding: 12px 18px;
            background: #F1F1F4;
            color: #071437;
            text-align: center;
            margin-bottom: 24px;
            overflow: scroll;
            max-height: 144px;
        }

        .bg-modal-content p {
            font-size: 14px !important;
            font-weight: 400 !important;
            line-height: 20px !important;
        }
   /* View Comparison button start */
        .ts-button .custom-toggle-comparison {
            position: relative;
            width: 32px;
            height: 16px;
        }

        .toggle-input-comparison {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider-comparison {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            border-radius: 24px;
            transition: 0.3s;
        }

        .toggle-slider-comparison:before {
            position: absolute;
            content: "";
            height: 12px;
            width: 12px;
            left: 3px;
            bottom: 2px;
            background-color: white;
            border-radius: 50%;
            transition: 0.3s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .toggle-input-comparison:checked+.toggle-slider-comparison {
            background-color: #F7941C;
        }

        .toggle-input-comparison:checked+.toggle-slider-comparison:before {
            transform: translateX(14px);
        }

        .toggle-label {
            font-weight: 600;
            color: #495057;
            user-select: none;
        }

        .comp-legend {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .comp-legend span {
            font-size: 16px;
            font-weight: 600;
        }

        .comp-new {
            color: #34D399;
            /* Green */
        }

        .comp-removed {
            color: #FEE2E2;
            /* Light Pink */
        }

        .comp-level-update {
            color: #F97316;
            /* Orange */
        }

        .ts-button {
            padding: 12px 18px;
            gap: 8px;
            border-radius: 4px;
            background: #FFF;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .ts-button.outline-orange {
            color: #F7941C;
            border: 1px solid #F7941C;
        }

        .ts-button.outline-orange:hover, .btn.btn-outline.btn-outline-primary:hover:not(.btn-active) {
            background-color: #F7941C !important;
            color: #FFF !important;
        }

        .ts-button.grey-outline {
            border: 1px solid #99A1B7;
            color: #78829D;
        }

        .comparison-summary {
            margin-bottom: 24px;
        }

        .comparison-summary p {
            color: #071437;
font-size: 14px;
font-weight: 400;
line-height: 20px;
margin: 0;
        }

        #modal-dynamic .card-header {
            padding: 18px 16px;
            border-radius: 4px 4px 0 0;
            min-height: 53px;
        }

        #modal-dynamic .card-header h6 {
            font-size: 17.55px;
            font-weight: 500;
            line-height: 21.06px;
            color: #071437 !important;
        }

        #modal-dynamic .card-header.bg-success {
            background: #BBECC5 !important;
        }

        #modal-dynamic .card-header.bg-danger {
            background: #FFE0DD !important;
        }

        #modal-dynamic .card-header.bg-warning {
            background: #FFF5DA !important;
        }

        #modal-dynamic .accordion-button:not(.collapsed) {
            box-shadow: none;
            border-bottom: 1px solid #fff !important;
        }

        #modal-dynamic .accordion-item:first-of-type .accordion-button, .accordion-button:not(.collapsed), .accordion-button {
            border-top: 0px;
            border-bottom: 1px solid #F1F1F4;
            padding: 16px;
            gap: 12px;
            flex-direction: column;
            align-items: baseline;
            color: #071437;
            font-size: 16.25px;
            font-weight: 500;
            line-height: 19.5px;
            background-color: #fff;
        }

         #modal-dynamic .accordion-button::after {
            display: none;
        }

        #modal-dynamic .accordion-item {
            border: none;

        }

        #modal-dynamic .alert-heading {
        color: #2E2F38;
        font-size: 14px;
        font-weight: 600;
        line-height: 20px;
                }

                #modal-dynamic .body-bottom  .accordion-body {
                    border-bottom: 1px solid #F1F1F4;
                }
        .custom-tooltip .levels {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }
   .levels.new {
            background: #BBECC5;
        }
        
        .levels.removed {
            background: #FFE0DD;
        }

        .levels.level-update {
            background: #F7941C;
        }

         .inline-error { color:#dc3545; font-size:12px; margin-top:.25rem; margin-left:.25rem; }

        .reset-btn:disabled {
        background-color: #F1F1F4;
        color: #99A1B7;
        }

        .accordion-header .hide-desc {
            color: #2E2F38;
            font-size: 13px;
            font-weight: 400;
            line-height: 16px;
            display: inline-block;
            max-width: 93%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* View Comparison button end*/

        /* Validation styles for missing levels */
        .level-missing-highlight {
            border: 2px solid #dc3545 !important;
            background-color: #f8d7da !important;
            color: #721c24 !important;
            animation: pulse-error 2s infinite;
        }

        @keyframes pulse-error {
            0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
            100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
        }

        .level-missing-highlight:hover {
            background-color: #f5c2c7 !important;
            border-color: #b02a37 !important;
        }

        /* No changes found message styling */
        .comparison-summary.no-changes {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .comparison-summary.no-changes .info-icon {
            color: #6c757d;
            font-size: 24px;
            margin-right: 12px;
        }

        .comparison-summary.no-changes p {
            color: #6c757d;
            font-size: 16px;
            font-weight: 500;
            margin: 0;
        }
    </style>
    
@endsection
@section('content')
    <div class="d-flex flex-column flex-column-fluid">

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
            use App\Models\Job;
            use App\Models\JobProfile;
            use App\Models\Department;
            use App\Models\Division;
            use App\Models\BusinessUnit;

            // Step 1: Get job_id from cached data
            $jobId = $cachedData['job_id'] ?? null;

            // Step 2: Retrieve the Job entry via Eloquent
            $jobEntry = $jobId ? Job::find($jobId) : null;

            // Step 3: Retrieve Job Position using job_profile_id from Job
            $jobProfileId = $jobEntry?->job_profile_id;
            $jobProfileEntry = $jobProfileId ? JobProfile::find($jobProfileId) : null;

            $jobProfileTitle = $jobProfileEntry?->name ?? 'N/A';
            $aaJobProfileId = $jobProfileEntry?->aa_job_profile_id ?? 'N/A';

            // Step 4: Retrieve Department using department_id from Job Position
            $departmentId = $jobProfileEntry?->department_id;
            $departmentEntry = $departmentId ? Department::find($departmentId) : null;

            $jobFamilyId = $departmentId ?? 'N/A';
            $jobFamilyTitle = $departmentEntry?->name ?? 'N/A';

            // Step 5: Retrieve Division using division_id from Department
            $divisionId = $departmentEntry?->division_id;
            $divisionEntry = $divisionId ? Division::find($divisionId) : null;

            $jobFamilyGroupId = $divisionId ?? 'N/A';
            $jobFamilyGroupTitle = $divisionEntry?->head_of_division ?? 'N/A';

            $businessUnit = BusinessUnit::find($divisionEntry->business_unit_id);
            $businessUnitTitle = $businessUnit ? $businessUnit->name : '';

            if (
                (isset($cachedData['is_localized_job']) && $cachedData['is_localized_job'] == true) ||
                request('is_localized_job') == 1
            ) {
                $typeForRiasec = $cachedData['job_type'] ?? 'custom_gen';

                if ($typeForRiasec === 'ai_gen') {
                    $typeForRiasec = 'ai';
                } elseif ($typeForRiasec === 'company_gen') {
                    $typeForRiasec = 'company-jd';
                } elseif ($typeForRiasec === 'master_gen') {
                    $typeForRiasec = 'master-jd';
                } elseif ($typeForRiasec === 'custom_gen') {
                    $typeForRiasec = 1;
                }
            } else {
                $typeForRiasec = $job->job_type;

                if ($typeForRiasec === 'ai_gen') {
                    $typeForRiasec = 'ai';
                } elseif ($typeForRiasec === 'company_gen') {
                    $typeForRiasec = 'company-jd';
                } elseif ($typeForRiasec === 'master_gen') {
                    $typeForRiasec = 'master-jd';
                } elseif ($typeForRiasec === 'custom_gen') {
                    $typeForRiasec = 1;
                }
            }

        @endphp




        <!--begin::Toolbar-->
        @if (isset($cachedData['job_type']) && $cachedData['job_type'] === 'company-jd')
            {{-- Company JD Toolbar --}}
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
                <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            Based on Company JD
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
                            <li class="breadcrumb-item text-muted" id="breadcrumbText">Based on Company JD</li>
                        </ul>
                    </div>
                </div>
            </div>
        @elseif (isset($cachedData['job_type']) && $cachedData['job_type'] === 'master-jd')
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
                <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            Based on Master JD
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
                            <li class="breadcrumb-item text-muted" id="breadcrumbText">Based on Master JD</li>
                        </ul>
                    </div>
                </div>
            </div>
        @elseif (isset($cachedData['job_type']) && $cachedData['job_type'] === 'ai')
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
                <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            Match & Generate JD with AI
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
                            <li class="breadcrumb-item text-muted" id="breadcrumbText">Match & Generate JD with AI</li>
                        </ul>
                    </div>
                </div>
            </div>
        @else
            <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">



                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            Edit Job Description
                        </h1>
                        <!--end::Title-->


                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                <a href="/admin/dashboard" class="text-muted text-hover-primary">Home</a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->

                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                <a href="/admin/jobs/index" class="text-muted text-hover-primary">Job Management</a>
                            </li>

                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->

                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('jobs.savedJobs', ['saved_job' => 1]) }}"
                                    class="text-muted text-hover-primary">Company JDs</a>
                            </li>

                            {{-- <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>

                             <li class="breadcrumb-item text-muted">
                             {{ $jobFamilyGroupTitle }}</li> --}}

                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            @php
                                $unique = \App\Models\Job::find($cachedData['job_id']);
                                $orgDepartmentId = $unique?->org_department ?? null;
                            @endphp
                            {{-- <li class="breadcrumb-item text-muted">
                                <a href="{{ route('admin.saved.jobdescriptions', ['org_department' => $cachedData['department_id'], 'saved_job' => 1]) }}" class="text-muted text-hover-primary">
                             {{ $jobFamilyTitle }} </a></li> --}}

                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('admin.saved.jobdescriptions', ['org_department' => $orgDepartmentId, 'saved_job' => 1]) }}"
                                    class="text-muted text-hover-primary">
                                    {{ $jobFamilyTitle }} </a>
                            </li>

                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>


                            <li class="breadcrumb-item text-muted"
                                style="max-width: 56%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $jobProfileTitle }} </li>

                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->

                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                Edit JD </li>
                            <!--end::Item-->

                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page title-->

                </div>

                <!--end::Actions-->
                <!--end::Toolbar container-->
            </div>
        @endif

        <div id="kt_app_content" class="app-content  flex-column-fluid ">


            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container  container-xxl">
                <form action="{{ route('admin.job-management.update') }}" id="job_description_form" method="post">
                    @csrf
                    {{-- <input type="hidden" name="jd_from" value="5"> --}}

                    @php

                        if (
                            (isset($cachedData['is_localized_job']) && $cachedData['is_localized_job'] == true) ||
                            request('is_localized_job') == 1
                        ) {
                            $jobType = $cachedData['job_type'] ?? 'custom_gen';
                        } else {
                            $jobType = $cachedData['job_type'] ?? $job->job_type;
                        }

                        $jdFromMap = [
                            'ai' => 5,
                            'master-jd' => 6,
                            'company-jd' => 7,
                            'ai_gen' => 5,
                            'master_gen' => 6,
                            'company_gen' => 7,
                            'custom_gen' => 8,
                        ];

                        $jdFrom = $jdFromMap[$jobType] ?? 8; // default 8 if nothing matches
                    @endphp

                    <input type="hidden" name="jd_from" value="{{ $jdFrom }}">
                    <input type="hidden" name="job_id" value="{{ $cachedData['job_id'] }}">
                    <input type="hidden" name="jobID"
                        value="{{ isset($cachedData['ai_job_id']) ? $cachedData['ai_job_id'] : $job->sierra_id }}">
                    {{-- <input type="hidden" name="riasec" value="{{ $cachedData['top3riasec'] }}"> --}}
                    <input type="hidden" name="title" value="{{ $cachedData['title'] }}">
                    <input type="hidden" name="level" value="{{ $cachedData['level'] }}">
                    <input type="hidden" name="job_profileId" value="{{ $jobProfileId }}">
                    <input type="hidden" name="job_familyId" value="{{ $jobFamilyId }}">
                    <input type="hidden" name="job_family_groupId" value="{{ $jobFamilyGroupId }}">
                    <input type="hidden" name="type" value="{{ $cachedData['jd_type'] ?? '' }}">
                    <input type="hidden" name="type_job" value="{{ $cachedData['job_type'] ?? '' }}">
                    <input type="hidden" name="jd_redirect" id="jd_redirect" value="1">
                    <input type="hidden" name="pendingChangesJson" id="pendingChangesJson" value="">
                    <input type="hidden" id="technicalSkillsJson" name="technicalskill">
                    {{-- <input type="hidden" name="technicalskill" value="{{ json_encode($cachedData['llmOutput']['technical_skills']) }}"> --}}
                    <input type="hidden" name="job_profile_name" value="{{ $jobProfileTitle ?? '' }}">
                    <input type="hidden" name="sierra_id" value="{{ $cachedData['cxs_job_table_id'] ?? '' }}">
                    <input type="hidden" name="ai_job_id"
                        value="{{ isset($cachedData['ai_job_id']) ? $cachedData['ai_job_id'] : $job->sierra_id }}">
                        <input type="hidden" name="unique_id" value="{{ isset($cachedData['sierra_id']) ? $cachedData['sierra_id'] : $job->sierra_id }}">




                    <input type="hidden" name="status" value="2">

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

                    <div class="card  shadow-sm mb-4" style="display: none !important;">
                        <div class="bg-primary card-header">
                            <h3 class="card-title text-white">{{ $heading }}</h3>

                        </div>
                        <div class="card-body  px-2 py-5">

                            <div class="form-group d-flex justify-content-evenly col-lg-12 p-0">
                                <div class="col-lg-6">
                                    <label for="sector" class="fw-semibold fs-6 mb-2">Related Sector from Master
                                        JD</label>
                                    <input id="sector" name="sector" class="form-control"
                                        placeholder="Select the Sector"
                                        style="
                                    background: #ffffff;
                                "
                                        readonly>

                                </div>

                                <div class="col-lg-6">
                                    <label for="job_role" class="fw-semibold fs-6 mb-2">Related Job Role from Master
                                        JD</label>

                                    <input id="job_role" name="job_role" class="form-control" placeholder="Job Role"
                                        style="
                                    background: #ffffff;
                                "
                                        readonly>
                                </div>
                            </div>
                            {{-- {{ dd($cachedData) }} --}}
                            <div class="form-group d-flex justify-content-evenly col-lg-12 p-0">
                                @if ($cachedData['company_jd'] == 0)
                                    <div class="col-lg-6">
                                        <label for="job_family_group_company" class="fw-semibold fs-7 mb-2">Related Sector
                                            from Master JD</label>
                                        <input id="job_family_group_company" value="{{ $cachedData['sector_name'] }}"
                                            class="form-control" placeholder="Select the Sector" readonly>

                                    </div>

                                    <div class="col-lg-6">
                                        <label for="job_family_company" class="fw-semibold fs-7 mb-2">Related Job Role
                                            from Master JD</label>

                                        <input id="job_family_company" value="{{ $cachedData['title'] }}"
                                            class="form-control" placeholder="Job Role" readonly>
                                    </div>
                                @else
                                    <div class="col-lg-4">
                                        <label for="job_family_group_company" class="fw-semibold fs-7 mb-2">Related Job
                                            Family Group from Company JD</label>
                                        <input id="job_family_group_company" value="{{ $jobFamilyGroupTitle }}"
                                            class="form-control" placeholder="Select the Sector"
                                            style="
                                    background: #ffffff;
                                "
                                            readonly>

                                    </div>

                                    <div class="col-lg-4">
                                        <label for="job_family_company" class="fw-semibold fs-7 mb-2">Related Job Family
                                            from Company JD</label>

                                        <input id="job_family_company" value="{{ $jobFamilyTitle }}"
                                            class="form-control" placeholder="Job Role"
                                            style="
                                    background: #ffffff;
                                "
                                            readonly>
                                    </div>

                                    <div class="col-lg-4">
                                        <label for="job_profile_company" class="fw-semibold fs-7 mb-2">Related Job
                                            Position from Company JD</label>

                                        <input id="job_profile_company" value="{{ $jobProfileTitle }}"
                                            class="form-control"
                                            style="
                                    background: #ffffff;
                                "
                                            placeholder="Select the Related Job Role" readonly>

                                    </div>
                                @endif

                            </div>
                            {{-- <div class="float-lg-right mr-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div> --}}

                            {{-- <div id="role-details" class="mt-4"></div> --}}

                        </div>

                    </div>

                    @if (isset($cachedData['job_type']) && $cachedData['job_type'] === 'company-jd')
                        <div class="card  shadow-sm mb-4">
                            <div class="bg-primary card-header">
                                <h3 class="card-title text-white">Job Position Based on Company JD</h3>

                            </div>
                            <div class="card-body  px-2 py-5">

                                {{-- <div class="form-group d-flex justify-content-evenly col-lg-12 p-0">
                                <div class="col-lg-6">
                                    <label for="sector" class="fw-semibold fs-6 mb-2">Related Sector from Master JD</label>
                                    <input id="sector" name="sector" class="form-control" placeholder="Select the Sector"
                                        style="
                                    background: #ffffff;
                                "
                                        readonly>

                                </div>

                                <div class="col-lg-6">
                                    <label for="job_role" class="fw-semibold fs-6 mb-2">Related Job Role from Master JD</label>

                                    <input id="job_role" name="job_role" class="form-control" placeholder="Job Role"
                                        style="
                                    background: #ffffff;
                                "
                                        readonly>
                                </div>
                            </div> --}}
                                {{-- {{ dd($cachedData) }} --}}
                                <div class="form-group d-flex justify-content-evenly col-lg-12 p-0" style="gap: 16px">
                                    <div class="w-100">
                                        <label for="job_profile_company" class="fw-semibold fs-6 mb-2">Related Business
                                            Unit
                                            from Company JD</label>

                                        <input id="job_profile_company" value="{{ $businessUnitTitle }}"
                                            class="form-control" placeholder="Select the Related Job Role" readonly>

                                    </div>
                                    <div class="w-100">
                                        <label for="job_family_group_company" class="fw-semibold fs-6 mb-2">Related
                                            Company/Division
                                            from Company JD</label>
                                        <input id="job_family_group_company" value="{{ $jobFamilyGroupTitle }}"
                                            class="form-control" placeholder="Select the Sector" readonly>

                                    </div>

                                    <div class="w-100">
                                        <label for="job_family_company" class="fw-semibold fs-6 mb-2">Related Department
                                            from Company JD</label>

                                        <input id="job_family_company" value="{{ $jobFamilyTitle }}"
                                            class="form-control" placeholder="Job Role" readonly>
                                    </div>

                                </div>
                                <div class="w-100 mt-5">
                                    <label for="job_profile_company" class="fw-semibold fs-6 mb-2">Related Job Position
                                        from Company JD</label>

                                    <input id="job_profile_company" value="{{ $cachedData['title'] }}"
                                        class="form-control" placeholder="Select the Related Job Role" readonly>

                                </div>
                                {{-- <div class="float-lg-right mr-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div> --}}

                                <div id="role-details" class="mt-4"></div>

                            </div>

                        </div>
                    @endif

                    @if (isset($cachedData['job_type']) && $cachedData['job_type'] === 'master-jd')
                        <div class="card  shadow-sm mb-4">
                            <div class="bg-primary card-header">
                                <h3 class="card-title text-white">Job Role Based on Master JD</h3>

                            </div>
                            <div class="card-body  px-2 py-5">
                                <div class="form-group d-flex justify-content-evenly col-lg-12 p-0" style="gap: 16px">
                                    {{-- If JD type is master-jd --}}

                                    <div class="col-lg-6">
                                        <label for="job_family_group_company" class="fw-semibold fs-7 mb-2">Related Sector
                                            from Master JD</label>
                                        <input id="job_family_group_company" value="{{ $cachedData['job_sector'] }}"
                                            class="form-control" placeholder="Select the Sector" readonly>
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="job_family_company" class="fw-semibold fs-7 mb-2">Related Job Role
                                            from
                                            Master JD</label>
                                        <input id="job_family_company" value="{{ $cachedData['title'] }}"
                                            class="form-control" placeholder="Job Role" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (isset($cachedData['job_type']) && $cachedData['job_type'] === 'ai')
                        <div class="card  shadow-sm mb-4">
                            <div class="bg-primary card-header">
                                <h3 class="card-title text-white">Job Role Based on Master JD</h3>

                            </div>
                            <div class="card-body  px-2 py-5">
                                <div class="form-group d-flex justify-content-evenly col-lg-12 p-0" style="gap: 16px">
                                    {{-- If JD type is master-jd --}}

                                    <div class="col-lg-6">
                                        <label for="job_family_group_company" class="fw-semibold fs-7 mb-2">Related Sector
                                            from Master JD</label>
                                        <input id="job_family_group_company" value="{{ $cachedData['sector_name'] }}"
                                            class="form-control" placeholder="Select the Sector" readonly>
                                    </div>

                                    <div class="col-lg-6">
                                        <label for="job_family_company" class="fw-semibold fs-7 mb-2">Related Job Role
                                            from
                                            Master JD</label>
                                        <input id="job_family_company" value="{{ $cachedData['title'] }}"
                                            class="form-control" placeholder="Job Role" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif



                    <div class="card  shadow-sm mb-4">
                        <div class="card-header">
                            <h3 class="card-title">General Info</h3>

                        </div>
                        <div class="card-body  py-5">
                            <div class="row" style="margin-bottom: 24px;">
                                <div class="fv-row fv-plugins-icon-container col-lg-12 d-flex existing_selects_sector_department"
                                    style="gap: 16px;">
                                    <div class="fv-row fv-plugins-icon-container existing_selects_sector_department w-100">
                                        <label for="job_desc" class="fw-semibold fs-6 mb-2 required">Business Unit</label>
                                        <select id="business_unit" name="business_unit_id" class="form-control" readonly
                                            disabled>
                                            <option value="">Select Business Unit</option>
                                            @foreach ($businessUnits as $unit)
                                                <option value="{{ $unit->id }}"
                                                    {{ $job->business_unit_id == $unit->id ? 'selected' : '' }}>
                                                    {{ $unit->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="fv-row  fv-plugins-icon-container w-100">
                                        <label for="sector"
                                            class="fw-semibold fs-6 mb-2 required">Company/Division</label>
                                        <input id="job_family_group" name="job_family_group" class="form-control"
                                            value="{{ $jobFamilyGroupTitle }}" placeholder="Select the Sector" readonly>

                                    </div>

                                    <div class="fv-row  fv-plugins-icon-container w-100">
                                        <label for="sector" class="fw-semibold fs-6 mb-2 required">Department</label>
                                        <input id="job_family" name="job_family" class="form-control"
                                            value="{{ $jobFamilyTitle }}" placeholder="Select the Sector" readonly>

                                    </div>
                                </div>
                            </div>

                            <div class="mb-5 row" style="margin-bottom: 24px;">
                                <div class="fv-row  fv-plugins-icon-container col-lg-12" style="margin-bottom: 24px;">
                                    <label for="sector" class="fw-semibold fs-6 mb-2 required">Job Position</label>
                                    <input id="job_profile" name="job_profile" value="{{ $jobProfileTitle }}"
                                        class="form-control" placeholder="Job Position">

                                    <div id="jobPositionValidationMessage" class="text-danger validation-message"
                                        style="display: none;">
                                        Job Position is required
                                    </div>

                                    <div class="custom-toggle-wrapper" style="margin-top: 8px;">
                                        <div class="custom-toggle">
                                            <input type="checkbox" id="is_critical_position" name="is_critical"
                                                {{ $job->is_critical == 1 ? 'checked' : '' }}>
                                            <label for="is_critical_position">Mark as Critical Job Position</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="fv-row  fv-plugins-icon-container col-lg-6">
                                    <label for="sector" class="fw-semibold fs-6 mb-2 required">Position Code</label>
                                    <input id="job_profile_id" name="job_profile_id" class="form-control"
                                        value="{{ $aaJobProfileId }}" placeholder="Job Role" readonly>

                                </div>


                                <div class="fv-row mb-7 fv-plugins-icon-container col-lg-6">


                                    <div class="d-flex gap-2 align-items-center">
                                        <label for="superior" class="fw-semibold fs-6 mb-2">Superior Job Position</label>
                                        @if ($job->is_top != 1)
                                            <div class="d-flex align-items-center gap-1 mb-2 {{ $superiorJobDepartmentId != $job->department_id ? '' : 'd-none' }}"
                                                id="superior-warning" style="color: #4B5675;">
                                                <iconify-icon icon="mingcute:warning-line" width="16" height="16"
                                                    style="color: #F7941C;">
                                                </iconify-icon> The selected superior is from a different department.
                                            </div>
                                        @endif
                                    </div>


                                    <select id="superior" name="superior" class="form-control"
                                        style="background-color: #DBDFE9;color: #78829D;"
                                        {{ $job->is_top == 1 ? 'disabled readonly' : 'required' }}>
                                        @if ($job->is_top != 1)
                                            @if (old('superior', $job->superior_id))
                                                {{-- Pre‑seed the current value so Select2 can pick it up --}}
                                                <option value="{{ old('superior', $job->superior_id) }}" selected>
                                                    {{ $job->superior->job_full_title ?? ' ' }}
                                                </option>
                                            @endif
                                        @endif
                                    </select>
                                    @error('superior')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                    <div id="superiorValidationMessage" class="text-danger validation-message"
                                        style="display: none;">
                                        This field is required
                                    </div>

                                </div>

                            </div>

                            <div class="row" style="margin-bottom: 24px;">
                                <div class="fv-row mb-3 fv-plugins-icon-container col-lg-6">
                                    <label for="heads" class="fw-semibold fs-6 mb-2 required">Position Level</label>
                                    <select id="level-job" class="form-control mb-3 mb-lg-0" name="level">

                                        @foreach (config('constants.LEVELS') as $value => $label)
                                            <option value="{{ $value }}" class="dark:bg-slate-700"
                                                {{ isset($job->level) && $job->level == $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endForeach

                                    </select>
                                    <div id="levelJobValidationMessage" class="text-danger validation-message"
                                        style="display: none;">
                                        Please select a position level
                                    </div>

                                </div>
                                <div class="fv-row  fv-plugins-icon-container col-lg-6">
                                    <label for="position_level" class="fw-semibold fs-6 mb-2 ">Management Level <span
                                            class="text-muted"><em>-Optional</em></span></label>

                                    <select id="level-job" class="form-control form-control mb-3 mb-lg-0"
                                        onchange="updatePositionCode()" name="level_job">
                                        <option value="" class="dark:bg-slate-700">Select Management Level</option>
                                        @php
                                            $customLevels = config('positionlevel');
                                        @endphp

                                        @foreach ($customLevels as $value => $label)
                                            <option value="{{ $value }}"
                                                {{ isset($job->job_level) && $job->job_level == $value ? 'selected' : '' }}
                                                class="dark:bg-slate-700">
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>


                                </div>


                            </div>


                            <div class="mb-5">
                                <label for="" class="form-label required">Job Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="jobRoleDescription"
                                    data-kt-autosize="true" rows="5" cols="50">{{ old('description') }}</textarea>

                                @error('description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div id="jobDescValidationMessage" class="text-danger validation-message"
                                    style="display: none;">
                                    Job description is required
                                </div>

                            </div>
                            {{-- @if (!isset($cachedData['source']) || $cachedData['source'] !== 'formatJobsbyfamily') --}}
                            {{-- @if (isset($cachedData['job_type']) && $cachedData['job_type'] === 'ai') --}}
                            @if ($typeForRiasec != 1 && (empty($cachedData['job_type']) || $cachedData['job_type'] !== 'company-jd'))
                                <div class="fv-row fv-plugins-icon-container d-flex justify-content-end">
                                    <button id="GenerateJD" type="button"
                                        class="btn btn-primary d-flex align-items-center gap-2" data-bs-toggle="modal"
                                        data-bs-target="#GenerateJDUsingAI">
                                        Localise JD using AI
                                        <iconify-icon icon="f7:sparkles" width="16" height="16"></iconify-icon>
                                    </button>
                                </div>
                            @endif
                            {{-- @endif --}}

                        </div>

                    </div>

                    <x-headcount-management-edit :job="$job" :superiorHeadcounts="$superiorHeadcounts" :superiorHeadcountCodes="$superiorHeadcountCodes" :superiorNames="$superiorNames" />

                    <div class="card mb-5 mb-xl-8">

                        <div class="card-header">
                            <h3 class="card-title">
                                Job Qualifications

                                {{-- <span class="text-muted mt-1 fw-semibold fs-7">Over 500 new products</span> --}}
                            </h3>
                        </div>

                        <div class="card-body">

                            <div class="fv-row fv-plugins-icon-container col-lg-12 d-flex p-0"
                                style="gap: 16px; margin-bottom: 24px;">
                                {{-- <h5 for="select" class=" mb-5"></h5> --}}
                                @php
                                    $education_levels = \App\Models\MasterEducationLevel::all();
                                    $higher_learning_institutions = \App\Models\MasterHigherLearningInstitution::all();
                                    $edu_program = \App\Models\MasterScopeOfStudy::all();
                                @endphp
                                <div class="input-area w-100">
                                    <label for="select" class="form-label">Education Level</label>
                                    <select id="education_level" class="form-control" name="education_level">
                                        <option value="">Select Education Level</option>
                                        @foreach ($education_levels as $education_level)
                                            <option value="{{ $education_level->id }}" class="dark:bg-slate-700"
                                                {{ $job->education_level == $education_level->id ? 'selected' : '' }}>
                                                {{ $education_level->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    <div id="educationLevelValidationMessage" class="text-danger validation-message"
                                        style="display: none;">
                                        Education level is required
                                    </div>
                                    @error('education_level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-area w-100">
                                    <label for="select" class="form-label">Scope of Study</label>
                                    <select id="scope_of_study" class="form-control" name="scope_of_study">
                                        <option value="">Select Scope of Study</option>
                                        @foreach ($edu_program as $scope_of_study)
                                            <option value="{{ $scope_of_study->id }}" class="dark:bg-slate-700"
                                                {{ $job->scope_of_study == $scope_of_study->id ? 'selected' : '' }}>
                                                {{ $scope_of_study->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <div id="scopeOfStudyValidationMessage" class="text-danger validation-message" style="display: none;">
                                Scope of study is required
                            </div> --}}
                                    @error('scope_of_study')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="input-area w-100">
                                    <label for="secondary_scope_of_study" class="fw-semibold fs-6 mb-2">Secondary Scope of
                                        Study</label>
                                    {{-- <select id="secondary_scope_of_study" class="form-select mb-3 mb-lg-0" data-control="select2" data-close-on-select="false" name="secondary_scope_of_study[]" data-placeholder="Select Secondary Scope of Study" multiple>
                                <option value="" class="dark:bg-slate-700">Select Secondary Scope of Study</option>
                                @foreach ($job->jobSecondaryScopeOfStudies as $item)
                                <option value="{{ $item->title }}" class="dark:bg-slate-700" selected>{{ $item->title }}</option>
                                @endforeach
                            </select> --}}

                                    <input class="form-control" placeholder="Secondary Scope of Study" type="text"
                                        id="kt_tagify_5"
                                        value='{{ $job->jobSecondaryScopeOfStudies->map(fn($scope) => ['value' => $scope->title])->toJson() }}'
                                        name="secondary_scope_of_study" />

                                    @error('secondary_scope_of_study')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="fv-row fv-plugins-icon-container col-lg-12 d-flex p-0" style="gap: 16px;">

                                <div class="input-area w-100">
                                    <div>
                                        <label class="form-label">Relevant Professional Certificates</label>
                                        <input class="form-control" placeholder="Relevant Professional Certificates"
                                            type="text" id="kt_tagify_1"
                                            value="{{ $job->professional_certificate ?? '' }}"
                                            name="professional_certificate" />
                                    </div>
                                    {{-- <div id="message" style="display: none; color: red;">You can only select up to 5
                                options.</div> --}}
                                </div>

                                <div class="input-area w-100">
                                    <div>
                                        <label class="form-label">Relevant Training Programs</label>
                                        <input class="form-control" placeholder="Relevant Training Programs"
                                            value="{{ $job->relevant_training ?? '' }}" name="relevant_training"
                                            type="text" id="kt_tagify_2" />
                                    </div>
                                    {{-- <div id="message" style="display: none; color: red;">You can only select up to 5
                                options.</div> --}}
                                </div>


                                <div class="input-area w-100">
                                    <label class="form-label" for="work_experience">Experience in Relevant Sector</label>
                                    <select class="form-control" id="work_experience" name="work_experience">
                                        <option value="" disabled selected>Select Experience in Relevant Sector
                                        </option>
                                        <option {{ $job->work_experience == '0-1' ? 'selected' : '' }} value="0-1">0-1
                                            years</option>
                                        <option {{ $job->work_experience == '1-3' ? 'selected' : '' }} value="1-3">1-3
                                            years</option>
                                        <option {{ $job->work_experience == '3-5' ? 'selected' : '' }} value="3-5">3-5
                                            years</option>
                                        <option {{ $job->work_experience == '5-7' ? 'selected' : '' }} value="5-7">5-7
                                            years</option>
                                        <option {{ $job->work_experience == '7-10' ? 'selected' : '' }} value="7-10">7-10
                                            years</option>
                                        <option {{ $job->work_experience == '10+' ? 'selected' : '' }} value="10+">10+
                                            years</option>
                                    </select>

                                    {{-- <div id="workExperienceValidationMessage" class="text-danger validation-message" style="display: none;">
                                    Experience in relevant sector is required
                                </div> --}}

                                    @error('work_experience')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
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
                            <div id="validationMessage" class="mt-3" style="color: red; display: none;">At least one
                                Critical Work Function
                                is required.</div>

                            <div id="unsavedCriticalValidationMessage" class="text-danger mt-2" style="display: none;">
                                <!-- Dynamic error will be inserted by JS -->
                            </div>
                        </div>

                    </div>

                    
                    @if (
                        (isset($cachedData['is_localized_job']) && $cachedData['is_localized_job'] == true) ||
                            request('is_localized_job') == 1)
                        <x-riasec-selector :selectedRiasec="str_split($cachedData['top3riasec'] ?? '')" :currentTop3Riasec="$cachedData['top3riasec'] ?? ''" :masterId="$job->master_id ?? ''" :jdTitle="$cachedData['title'] ?? ''"
                            :jdType="$cachedData['job_type'] ?? 1" />
                    @else
                        <x-riasec-selector :selectedRiasec="$cachedData['top3riasec_array'] ?? []" :currentTop3Riasec="$job?->masterJob?->top3riasec ?? ''" :masterId="$job->master_id ?? ''" :jdTitle="$job?->masterJob?->title ?? ''"
                            :jdType="$typeForRiasec" />
                    @endif

                    {{-- RIASEC Component --}}



                    <div class="card  shadow-sm mb-4">
                        <div class="card-header">
                            <h3 class="card-title"> Generic Skills</h3>

                        </div>
                        @php $masterSkills = []; @endphp

                        <div class="card-body py-5">
                            <!-- Generic Skill 1 -->
                            {{-- <div class="row mb-3">
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-8">
                                    <input
                                        id="skill[0]"
                                        class="form-control mb-3 mb-lg-0"
                                        name="skills[0][title]"
                                        placeholder="Enter Generic Skill"
                                    />
                                </div>
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-4 d-flex">
                                    <select
                                        id="level[0]"
                                        class="form-control form-select mb-3 mb-lg-0 col-lg-6 rounded-right"
                                        name="skills[0][level]"
                                    >
                                        <option value="3">Level 3</option>
                                        <option value="2">Level 2</option>
                                        <option value="1">Level 1</option>
                                    </select>
                                    <button
                                        type="button"
                                        id="selectLevelButton0"
                                        class="btn btn-outline btn-outline-primary border-2 me-5 d-flex justify-content-center align-item-center rounded-left"
                                        data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_2"
                                        onclick="populateModal('0', '1', 'title', 'level_1', 'level_2', 'level_3', 'selectedlevel')"
                                    >
                                        Select Level
                                        <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                        
                            <!-- Generic Skill 2 -->
                            <div class="row mb-3">
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-8">
                                    <input
                                        id="skill[1]"
                                        class="form-control mb-3 mb-lg-0"
                                        name="skills[1][title]"
                                        placeholder="Enter Generic Skill"
                                    />
                                </div>
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-4 d-flex">
                                    <select
                                        id="level[1]"
                                        class="form-control form-select mb-3 mb-lg-0 col-lg-6 rounded-right"
                                        name="skills[1][level]"
                                    >
                                        <option value="3">Level 3</option>
                                        <option value="2">Level 2</option>
                                        <option value="1">Level 1</option>
                                    </select>
                                    <button
                                        type="button"
                                        id="selectLevelButton1"
                                        class="btn btn-outline btn-outline-primary border-2 me-5 d-flex justify-content-center align-item-center rounded-left"
                                        data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_2"
                                        onclick="populateModal('1', '1', 'title', 'level_1', 'level_2', 'level_3', 'selectedlevel')"
                                    >
                                        Select Level
                                        <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                        
                            <!-- Generic Skill 3 -->
                            <div class="row mb-3">
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-8">
                                    <input
                                        id="skill[2]"
                                        class="form-control mb-3 mb-lg-0"
                                        name="skills[2][title]"
                                        placeholder="Enter Generic Skill"
                                    />
                                </div>
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-4 d-flex">
                                    <select
                                        id="level[2]"
                                        class="form-control form-select mb-3 mb-lg-0 col-lg-6 rounded-right"
                                        name="skills[2][level]"
                                    >
                                        <option value="3">Level 3</option>
                                        <option value="2">Level 2</option>
                                        <option value="1">Level 1</option>
                                    </select>
                                    <button
                                        type="button"
                                        id="selectLevelButton2"
                                        class="btn btn-outline btn-outline-primary border-2 me-5 d-flex justify-content-center align-item-center rounded-left"
                                        data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_2"
                                        onclick="populateModal('2', '1', 'title', 'level_1', 'level_2', 'level_3', 'selectedlevel')"
                                    >
                                        Select Level
                                        <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                        
                            <!-- Generic Skill 4 -->
                            <div class="row mb-3">
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-8">
                                    <input
                                        id="skill[3]"
                                        class="form-control mb-3 mb-lg-0"
                                        name="skills[3][title]"
                                        placeholder="Enter Generic Skill"
                                    />
                                </div>
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-4 d-flex">
                                    <select
                                        id="level[3]"
                                        class="form-control form-select mb-3 mb-lg-0 col-lg-6 rounded-right"
                                        name="skills[3][level]"
                                    >
                                        <option value="3">Level 3</option>
                                        <option value="2">Level 2</option>
                                        <option value="1">Level 1</option>
                                    </select>
                                    <button
                                        type="button"
                                        id="selectLevelButton3"
                                        class="btn btn-outline btn-outline-primary border-2 me-5 d-flex justify-content-center align-item-center rounded-left"
                                        data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_2"
                                        onclick="populateModal('3', '1', 'title', 'level_1', 'level_2', 'level_3', 'selectedlevel')"
                                    >
                                        Select Level
                                        <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                        
                            <!-- Generic Skill 5 -->
                            <div class="row mb-3">
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-8">
                                    <input
                                        id="skill[4]"
                                        class="form-control mb-3 mb-lg-0"
                                        name="skills[4][title]"
                                        placeholder="Enter Generic Skill"
                                    />
                                </div>
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-4 d-flex">
                                    <select
                                        id="level[4]"
                                        class="form-control form-select mb-3 mb-lg-0 col-lg-6 rounded-right"
                                        name="skills[4][level]"
                                    >
                                        <option value="3">Level 3</option>
                                        <option value="2">Level 2</option>
                                        <option value="1">Level 1</option>
                                    </select>
                                    <button
                                        type="button"
                                        id="selectLevelButton4"
                                        class="btn btn-outline btn-outline-primary border-2 me-5 d-flex justify-content-center align-item-center rounded-left"
                                        data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_2"
                                        onclick="populateModal('4', '1', 'title', 'level_1', 'level_2', 'level_3', 'selectedlevel')"
                                    >
                                        Select Level
                                        <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                        
                            <!-- Generic Skill 6 -->
                            <div class="row mb-3">
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-8">
                                    <input
                                        id="skill[5]"
                                        class="form-control mb-3 mb-lg-0"
                                        name="skills[5][title]"
                                        placeholder="Enter Generic Skill"
                                    />
                                </div>
                                <div class="fv-row mb-5 fv-plugins-icon-container col-lg-4 d-flex">
                                    <select
                                        id="level[5]"
                                        class="form-control form-select mb-3 mb-lg-0 col-lg-6 rounded-right"
                                        name="skills[5][level]"
                                    >
                                        <option value="3">Level 3</option>
                                        <option value="2">Level 2</option>
                                        <option value="1">Level 1</option>
                                    </select>
                                    <button
                                        type="button"
                                        id="selectLevelButton5"
                                        class="btn btn-outline btn-outline-primary border-2 me-5 d-flex justify-content-center align-item-center rounded-left"
                                        data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_2"
                                        onclick="populateModal('5', '1', 'title', 'level_1', 'level_2', 'level_3', 'selectedlevel')"
                                    >
                                        Select Level
                                        <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
                                    </button>
                                </div>
                            </div> --}}
                            <div id="generic-skills-container"></div>
                            <button type="button" id="add_new_generic_skill" class="add-function mt-5"
                                style="background:#F7941C"><iconify-icon icon="stash:plus-solid"
                                    style="font-size: 20px"></iconify-icon> Add New Skill</button>

                            <div id="genericValidationMessage" class="mt-3" style="color: red; display: none;">
                                At least three Generic Skill is required.
                            </div>

                        </div>




                    </div>

                    <div class="card  shadow-sm mb-4">
                        <div class="card-header d-flex" style="justify-content: space-between !important;">
                            <h3 class="card-title"> Technical Skills <iconify-icon
                                    icon="material-symbols:info-outline-rounded" data-bs-toggle="tooltip"
                                    class="mx-2 info-tooltip" data-bs-placement="top" data-bs-html="true"
                                    data-bs-title='<div class="custom-tooltip"><span><span class="dot dot-sky"></span> Master Skill</span><span><span class="dot dot-yellow"></span> Company Skill</span><br/><span><span class="dot dot-green"></span> Sector</span><span><span class="dot dot-purple"></span> Category</span></div>'
                                    width="20" height="20" style="color: #5F6368;"></iconify-icon></h3>
                                           <div class="d-flex gap-3">
                               <button type="button" class="ts-button outline-orange d-flex gap-3" id="viewChangesBtn">
                                <iconify-icon icon="iconamoon:eye" width="16" height="16"></iconify-icon>
                                View Changes
                            </button>

                            {{-- <a id="view-comparison-btn" class="btn btn-primary">View Comparison</a> --}}

                            <div
                                class="ts-button grey-outline d-flex gap-3">
                                <div class="custom-toggle-comparison">
                                    <input type="checkbox" id="comparisonToggle" class="toggle-input-comparison">
                                    <label for="comparisonToggle" class="toggle-slider-comparison"></label>
                                </div>
                                <span class="toggle-label">Show Changes</span>

                            </div>
                            </div>
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
                            <div id="techvalidationmessage" class="mt-3" style="color: red; display: none;">At least
                                One Technical Skill is
                                required.</div>
                        </div>

                    </div>

                    <div class="card  shadow-sm mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Review Status</h3>

                        </div>
                        <div class="card-body  py-5">

                            <div class="col-lg-4">
                                <label for="job_role_desc" class="fw-semibold fs-6 mb-2">Select Status</label>
                                <select name="status" class="form-select" data-control="select2"
                                    data-placeholder="Select Status">
                                    <option value="1" @if ($cachedData['status'] == 1) selected @endif>Approved
                                    </option>
                                    <option value="2" @if ($cachedData['status'] == 2) selected @endif>Pending
                                    </option>
                                </select>
                            </div>
                        </div>

                    </div>

                    {{-- <div class="card  shadow-sm mb-11">
                    <div class="card-header">
                        <h3 class="card-title">Getting feedback <span class="text-muted"> <em>-optional</em></span></h3>
                    </div>
                    <div class="card-body  py-5">
                     <div class="d-flex gap-3 fs-5"><span>How's the overall result generated by the AI?</span>
                    <span><iconify-icon icon="codicon:thumbsup" width="24" height="24"></iconify-icon></span>
                    <span><iconify-icon icon="codicon:thumbsdown" width="24" height="24"></iconify-icon></span>
                    </div>
                    </div>

                </div> --}}

                    <div class="mb-8 gap-3 d-flex justify-content-end submit-job-bot">
                        {{-- <a href="/admin/setting/job-description/create">
                        <iconify-icon icon="gg:trash"></iconify-icon>
                        Discard
                    </a> --}}
                        <a href="{{ url()->previous() }}">
                            Cancel
                        </a>
                        <button type="submit">
                            {{-- <iconify-icon icon="flowbite:plus-outline"></iconify-icon> --}}
                            @if (($cachedData['is_localized_job'] ?? false) === true)
                                Update JD
                            @elseif(request('is_localized_job') == '1')
                                Update JD
                            @else
                                Save Changes
                            @endif
                        </button>
                    </div>
                    {{-- <div class="card submit-card shadow-sm mb-4">
                <div class="card-body  py-5">

                    <div class="mb-0 d-flex col-lg-12 p-0">

                        <div class="d-flex align-items-center gap-3 feedback-btn" style="color: #3E3E3E;">
                            <div class="thumbs-up" data-bs-toggle="modal" data-bs-target="#feedbackModal"
                                id="thumbs-up">
                                <iconify-icon icon="ic:round-thumb-up" class="cursor-pointer" width="28"
                                    height="28" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Good Result"></iconify-icon>
                            </div>
                            <div class="thumbs-down" data-bs-toggle="modal" data-bs-target="#feedbackModal"
                                id="thumbs-down">
                                <iconify-icon data-bs-toggle="modal" data-bs-target="#feedbackModal" id="thumbs-down"
                                    icon="ri:thumb-down-line" class="cursor-pointer" width="26" height="26"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Bad Result"></iconify-icon>
                            </div>
                            <p class="m-0 fs-6">How is this result?</p>
                        </div>

                    </div>
                </div>
                </div> --}}
                    {{-- <a href="/admin/setting/job-description/create">
                                <iconify-icon icon="gg:trash"></iconify-icon>
                                Discard
                            </a> --}}
                    {{-- <iconify-icon icon="flowbite:plus-outline"></iconify-icon> --}}

                    {{-- <div class="card  shadow-sm mb-4">
                    <div class="card-header">
                        <h3 class="card-title"> Update Job?</h3>

                    </div>
                    <div class="card-body  py-5">

                        <div class="mb-8 col-lg-4 gap-3 d-flex submit-job-bot">
                            <button type="submit">
                                
                                Submit
                            </button>
                            <a href="{{ url()->previous() }}">
                                Cancel
                            </a>
                        </div>
                    </div>

                </div> --}}
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
                    <button class="btn btn-outline m-0" style="color: #78829D;" data-bs-dismiss="modal">Cancel</button>
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
                        onclick="updateSkillLevel(this)" disabled>Save changes</button>

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
                    {{-- <h5 class="modal-title">Communication</h5> --}}
                    <div class="model-head">
                        <h1 class="modal-title fs-5">Skill Name</h1>
                        <p class="m-0 modal-desc">Skill Description</p>
                    </div>

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
                    <button type="button" class="btn btn-primary save-btn" data-bs-dismiss="modal" disabled>Save changes</button>

                </div>
            </div>
        </div>
    </div>
    {{-- Technical Skill Modal End --}}
    <div class="modal fade" id="EditTsfromMSL" tabindex="-1" aria-labelledby="EditTsfromMSLLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-0 pt-5 text-center">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="float: right;"></button>
                    <iconify-icon icon="ep:warning" class="my-5" width="70" height="70"
                        style="color: #FABB6E;"></iconify-icon>
                    <h4 class="fw-bold lh-1 text-center" style="font-size: 33.5px;">Create New Company<br> Technical
                        Skill?</h4>
                    <p class="m-0 text-center mt-6">This action will create a new company technical skill from the selected
                        master skill.</p>
                </div>
                <div class="modal-footer modal-footer d-block border-0">
                    <div class="filter-content d-flex justify-content-center gap-2">
                        <button class="btn btn-outline m-0" style="color: #78829D;"
                            data-bs-dismiss="modal">Cancel</button>
                        <button id="continueEditSkillBtn" class="btn btn-apply text-white continueEditSkillBtn"
                            style="background: #F7941C;">
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="CreateNewSkillModal" tabindex="-1" aria-labelledby="CreateNewSkillModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-0 pt-5 text-center">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="float: right;"></button>
                    <iconify-icon icon="ep:warning" width="70" height="70" class="my-5"
                        style="color: #FABB6E;"></iconify-icon>
                    <h4 class="fw-bold lh-1 text-center" style="font-size: 33.5px;">Create Another New<br> Company
                        Technical Skill?</h4>
                    <p class="m-0 text-center mt-6">There are already company technical skill(s) created based on this
                        master skill. Are you sure you want to create another one?</p>

                </div>
                <div class="modal-footer modal-footer d-block border-0">
                    <div class="filter-content d-flex justify-content-center gap-2">
                        <button class="btn btn-outline m-0" style="color: #78829D;"
                            data-bs-dismiss="modal">Cancel</button>
                        <button id="" class="btn btn-apply text-white continueEditSkillBtn"
                            style="background: #F7941C;">
                            Create Another
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="NoChangesModal" tabindex="-1" aria-labelledby="NoChangesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-0 pt-5 text-center">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="float: right;"></button>
                    <iconify-icon icon="ep:warning" width="70" height="70" class="my-5"
                        style="color: #FABB6E;"></iconify-icon>
                    <h4 class="fw-bold lh-1 text-center" style="font-size: 33.5px;">No Changes Detected</h4>
                    <p class="m-0 text-center mt-6">You haven’t made any changes to this skill. If you continue, no new
                        company technical skill will be created and it will remain as a master skill.</p>

                </div>
                <div class="modal-footer modal-footer d-block border-0">
                    <div class="filter-content d-flex justify-content-center gap-2">
                        <button class="btn btn-outline continue-btn">Continue</button>
                        <button class="btn text-white btn-outline" data-bs-dismiss="modal" style="background: #F7941C;">
                            Back to Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="NoChangesCompanyModal" tabindex="-1" aria-labelledby="NoChangesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-0 pt-5 text-center">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="float: right;"></button>
                    <iconify-icon icon="ep:warning" width="70" height="70" class="my-5"
                        style="color: #FABB6E;"></iconify-icon>
                    <h4 class="fw-bold lh-1 text-center" style="font-size: 33.5px;">No Changes Detected</h4>
                    <p class="m-0 text-center mt-6">You haven’t made any changes to this skill. If you continue, no new
                        company technical skill will be created.</p>

                </div>
                <div class="modal-footer modal-footer d-block border-0">
                    <div class="filter-content d-flex justify-content-center gap-2">
                        <button class="btn btn-outline continue-btn">Continue</button>
                        <button class="btn text-white btn-outline" data-bs-dismiss="modal" style="background: #F7941C;">
                            Back to Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Success Modal -->
    <div class="modal fade" id="SuccessModal" tabindex="-1" aria-labelledby="SuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-0 pt-5 text-center">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="float: right;"></button>
                    <iconify-icon icon="simple-line-icons:check" width="70" height="70" class="my-5"
                        style="color: #99E2A8;"></iconify-icon>
                    <h4 class="fw-bold lh-1 text-center" style="font-size: 33.5px;">Company Skill Created</h4>
                    <p class="m-0 text-center mt-6">The new company technical skill, <b id="SkillName">Skill Name</b>, has
                        been created successfully.</p>
                </div>
                <div class="modal-footer modal-footer d-block border-0">
                    <div class="filter-content d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-outline" data-bs-dismiss="modal"
                            style="background-color: #F7941C; color: #fff;">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Skill Restored Modal -->
    <div class="modal fade" id="SkillRestoredModal" tabindex="-1" aria-labelledby="SkillRestoredModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-0 pt-5 text-center">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="float: right;"></button>
                    <iconify-icon icon="ep:warning" width="70" height="70" class="my-5"
                        style="color: #FABB6E;"></iconify-icon>
                    <h4 class="fw-bold lh-1 text-center" style="font-size: 33.5px;">Skill Restored</h4>
                    <p class="m-0 text-center mt-6">You have reselected a previously removed skill.<br>
                        It will be restored to the list.</p>
                </div>
                <div class="modal-footer modal-footer d-block border-0">
                    <div class="filter-content d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="UnsavedTechChangesModal" tabindex="-1" aria-labelledby="UnsavedTechChangesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body py-0 pt-5 text-center">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float: right;"></button>
                    <iconify-icon icon="ep:warning" width="70" height="70" class="my-5"
                        style="color: #FABB6E;"></iconify-icon>
                    <h4 class="fw-bold lh-1 text-center" style="font-size: 33.5px;">Unsaved Changes Detected</h4>
                    <p class="m-0 text-center mt-6">You have unsaved changes in the <strong>Technical Skills</strong> section.
                            Please click the tick button in that section to save before updating the JD.</p>
                    
                </div>
                <div class="modal-footer modal-footer d-block border-0">
                <div class="filter-content d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-outline" data-bs-dismiss="modal" style="color: #78829D;border-color: #78829D;">Close</button>
                </div>
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



    <!-- RIASEC Modal is now handled by the riasec-selector component -->

    <div class="modal fade unique" id="GenerateJDUsingAI" tabindex="-1" aria-labelledby="GenerateJDUsingAILabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 70%;">
            <div class="modal-content">
                <div class="modal-header bg-orange p-7">
                    <h1 class="modal-title fs-5 fw-medium" id="GenerateJDUsingAILabel">Localise Job Description using AI
                    </h1>
                    <button type="button" data-bs-dismiss="modal" class="border-0 close-color" aria-label="Close">
                        <iconify-icon icon="material-symbols:close-rounded" width="24" height="24"></iconify-icon>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="step1">
                        <h4 class="modal-jd-heading fs-1 fw-bolder m-2" id="jd_title">Cabin Crew 2</h4>
                        <form>
                            <div class="d-flex align-items-stretch justify-content-center flex-column">
                                <div class="d-flex flex-column gap-3 border manually-modal-inner h-100">
                                    <p class="m-0 text-left fw-bolder fs-2">Job Description (Retrieved from Master List)</p>
                                    <div class="line"></div>
                                    <p class="para fs-5" id="baseJD">The Cabin Crew 2 at AirAsia is responsible for
                                        ensuring the smooth and efficient management of flight operations during turnaround
                                        processes...</p>
                                </div>
                                <h4 class="modal-jd-heading fs-1 fw-bolder m-0" id="jd_job_profile">{{ $job->title ?? '-' }}</h4>
                                <div class="mt-5">
                                    <label for="additionalDetail" class="form-label fw-semibold text-dark">Job Description from {{ env('APP_NAME') }}</label>
                                    <textarea class="form-control" id="additionalDetail" rows="4" placeholder="Enter additional details..."></textarea>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div id="step2" class="d-none">
                        <h4 class="modal-jd-heading-generate fs-1 fw-bolder d-flex align-items-center gap-3">Localise JD using AI <span class="modal-page-span">1/3</span></h4>
                        <h4 class="modal-jd-heading fs-1 fw-bolder" id="jd_job_profile_step">Cabin Crew 2 Assistant</h4>
                        <div class="d-flex flex-column gap-3">
                            <p class="m-0"><b>Job Description from {{ env('APP_NAME') }}</b></p>
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
                            class="custom-btn border-0 h-auto orange-outline-popup popup-proceed-button text-white">
                            Regenerate with New Details
                        </button>
                        <button type="button" id="selectJD"
                            class="custom-btn border-0 h-auto orange-fill-popup popup-proceed-button" data-bs-dismiss="modal" disabled>
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
                {{-- <div class="modal-header">
                    <div class="model-head">
                        <h1 class="modal-title fs-5">Edit Company Technical Skill</h1>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> --}}
                <div class="modal-body pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="float: right;"
                        aria-label="Close"></button>
                    <div class="m-auto">
                        <iconify-icon icon="jam:alert" class="text-center d-flex justify-content-center"
                            width="70" height="70" style="color: #F8BB86;"></iconify-icon>
                        <h4 class="text-center">Edit Company Technical Skill?</h4>
                        <p class="text-center">
                            Choose how you'd like to apply the changes to
                            <b id="companySkillName">Skill Name</b>.
                        </p>
                        <form>
                            <div class="d-flex align-items-center justify-content-center gap-4 mb-5">
                                <label class="manually-radio w-50">
                                    <input type="radio" name="jdOption" value="custom" id="customJD">
                                    <div class="d-flex flex-column gap-3 manually-modal-inner" style="height: 160px;">
                                        <p class="m-0 text-center fw-bold">Create New</p>
                                        <div class="line"></div>
                                        <p class="m-0 text-center">Customise and create as new company technical skill
                                            specifically for this JD and to save it in the Company Technical Skills Library.
                                        </p>
                                    </div>
                                </label>
                                <label class="manually-radio w-50">
                                    <input type="radio" name="jdOption" value="master" id="masterJD">
                                    <div class="d-flex flex-column gap-3 manually-modal-inner" style="height: 160px;">
                                        <p class="m-0 text-center fw-bold">Overwrite Existing</p>
                                        <div class="line"></div>
                                        <p class="m-0 text-center">Replace the existing skill in the Company Technical
                                            Skill Library with the updated version. This will affect all <b
                                                id="jobCount">7</b> <b>JDs</b> currently linked to it.</p>
                                    </div>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer justify-content-center border-0 gap-2">
                    <button class="btn btn-outline m-0" style="color: #78829D;"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="proceedCompanySkillBtn" class="btn btn-apply text-white m-0"
                        style="background: #F7941C;" disabled>Proceed</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="OverwriteCompanySkillConfirmModal" tabindex="-1"
        aria-labelledby="EditTsfromMSLLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    style=" position: absolute; right: 15px; top: 10px; z-index: 1;
                    "></button>
                <div class="modal-body text-center pt-4">
                    <iconify-icon icon="ep:warning" width="70" height="70"
                        style="color: #F8BB86;"></iconify-icon>
                    <h4 class="my-5" style="font-size: 32.5px;">Overwrite Technical Skill?</h4>
                    <p class="mx-12 my-5">You're about to overwrite the company technical skill <b
                            id="overwriteCompanySkillName">Aircraft Dispatch</b>
                        in the skill
                        library. <br><br>
                        This action will update the skill details across all associated job descriptions listed below.
                    </p>
                    <div class="bg-modal-content">
                        <p class="m-0" id="affectedJobList">
                            Loading affected job titles...</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <button class="btn btn-outline m-0" style="color: #78829D;"
                            data-bs-dismiss="modal">Cancel</button>
                        <button id="OverwriteContinueEditSkillBtn" class="btn btn-apply text-white m-0"
                            style="background: #F24130;">
                            Overwrite
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Global Modal Container for ModalManager -->
    <div id="global-modal-container"></div>



@endsection

@section('scripts')

<script type="module">
// Import ModalManager if not globally available
let ModalManager;
try {
    if (typeof window.ModalManager !== 'undefined') {
        ModalManager = window.ModalManager;
    } else {
        const { default: manager } = await import('/resources/js/modal/ModalManager.js');
        ModalManager = manager;
        window.ModalManager = ModalManager; // Make it globally available
    }
} catch (error) {
    console.error('Failed to load ModalManager:', error);
}
</script>

<script>
(function ($) {
  const FORM_SEL = 'form#job_description_form';
  const TECH_CONTAINER = '#skills-container';
  const TECH_ROW = '.technical-skill';
  const TECH_FIELDS = 'input[name^="technicalSkills"], textarea[name^="technicalSkills"]';
  const UNSAVED_MODAL_ID = 'UnsavedTechChangesModal';

  // --- Normalize strings for comparison ---
  const normalize = (s) => String(s ?? '').replace(/\s*\([^)]*-[^)]*\)\s*/g, '').trim();

  // --- Seed originals for given root (needed after edit mode opens) ---
  function seedOriginals(root = document) {
    $(root).find(`${TECH_FIELDS}`).each(function () {
      $(this).data('original', $(this).val() || '');
    });
  }

  // --- Detect any unsaved changes OR open edit mode ---
  function hasUnsavedTech() {
    let unsaved = false;

    $(`${TECH_CONTAINER} ${TECH_ROW}:visible`).each(function () {
      const $row = $(this);

      // if in edit mode (accept btn visible)
      if ($row.find('.accept-btn:visible').length > 0) {
        unsaved = true;
        return false;
      }

      // or if values changed from originals
      $row.find(`${TECH_FIELDS}:visible`).each(function () {
        const orig = $(this).data('original') ?? '';
        const curr = $(this).val() ?? '';
        if (normalize(orig) !== normalize(curr)) { unsaved = true; return false; }
      });
    });

    return unsaved;
  }

  // --- On Accept click, update originals (mark clean) ---
  $(document).on('click', `${TECH_CONTAINER} ${TECH_ROW} .accept-btn`, function () {
    const $row = $(this).closest(TECH_ROW);
    $row.find(TECH_FIELDS).each(function () {
      $(this).data('original', $(this).val() || '');
    });
  });

  // --- Prevent form submit if unsaved edits exist or validation fails ---
  $(document).on('submit', FORM_SEL, function (e) {
    // First check for technical skills validation
    const validation = validateTechnicalSkills();
    if (!validation.isValid) {
      e.preventDefault();
      // Highlight skills with missing levels
      highlightSkillsWithMissingLevels();
      // Show alert with validation message
      alert(validation.message);
      // Scroll to first skill with missing level
      const firstMissingLevelButton = document.querySelector('.level-missing-highlight');
      if (firstMissingLevelButton) {
        firstMissingLevelButton.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
      return false;
    }
    
    seedOriginals(); // make sure everything is seeded
    if (hasUnsavedTech()) {
      e.preventDefault();
      bootstrap.Modal.getOrCreateInstance(document.getElementById(UNSAVED_MODAL_ID)).show();
      return false;
    }
    return true;
  });

  // --- Initial seed on page load ---
  $(function () { seedOriginals(); });

  // --- Expose helper to call after edit mode opens ---
  window.afterEditModeOpen = function (skillRow) {
    seedOriginals(skillRow);
  };
})(jQuery);
</script>

    {{-- <script>
        let triggerOverwriteConfirmAfterSave = false;
        const MAX_GENERIC_SKILLS = 5;
        let temporaryGenericLevelSelection = {};
    </script> --}}
    <script>
        // your globals
        let triggerOverwriteConfirmAfterSave = false;
        const MAX_GENERIC_SKILLS = 5;
        let temporaryGenericLevelSelection = {};

        // ensure containers exist
        window.technicalSkillsData = window.technicalSkillsData || {};
        window.originalSkillBeforeEdit = window.originalSkillBeforeEdit || {};

        // helpers
        function esc(s = '') {
            return String(s)
                .replace(/&/g, '&amp;').replace(/</g, '&lt;')
                .replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
        }

        function clean(text) {
            let str = String(text || '');
            let pattern = /\([^()]*-.*?\)/g;

            // Keep removing innermost (...) containing '-' until none remain
            while (pattern.test(str)) {
                str = str.replace(pattern, '');
            }

            return str.trim();
        }

        function initSkillSelect2(skillIndex) {
            const selectEl = $(`#skill\\[${skillIndex}\\]`);
            selectEl.select2({
                ajax: {
                    url: '{{ route('admin.technical-skill.search') }}',
                    dataType: 'json',
                    delay: 250,
                    data: params => ({
                        q: params.term,
                        page: params.page || 1
                    }),
                    processResults: (data, params) => ({
                        results: data.results,
                        pagination: {
                            more: data.pagination.more
                        }
                    }),
                    cache: true
                },
                language: {
                    noResults: function() {
                        return "No matches found";
                    }
                },
                templateResult: function(data) {
                    console.log('Dropdown data:', data);
                    if (data.loading) return data.text;
                    const skillType = data.skill_type || '';
                    const category = data.category || '';
                    const sector = data.sector || '';
                    // const name = data.text || '';
                    const name = clean(data.text);
                    return $(`
          <div class="d-flex justify-content-between align-items-center w-100 gap-6">
            <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${esc(data.name) || ''}">${esc(name)}</span>
            <div class="d-flex gap-2">
              ${skillType
                ? (skillType === 'Master Skill'
                    ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${esc(skillType) || ''}">${esc(skillType)}</span>`
                    : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${esc(skillType) || ''}">${esc(skillType)}</span>`)
                : ''
              }
              ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${esc(sector) || ''}">${esc(sector)}</span>` : ''}
              ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${esc(category) || ''}">${esc(category)}</span>` : ''}
            </div>
          </div>
        `);
                },
                templateSelection: function(data) {
                    if (!data.id) return data.text;
                    console.log('Selected data:', technicalSkillsData[skillIndex]);
                    const gen = technicalSkillsData[skillIndex] || {};
                    const skillType = data.skill_type || '';
                    const category = data.category || '';
                    const sector = data.sector || '';
                    // const name = data.text || '';
                    const name = clean(data.text);
                    if (skillType || sector || category) {
                        return $(`
          <div class="d-flex justify-content-between align-items-center w-100 gap-6">
            <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${esc(data.name) || ''}">${esc(name)}</span>
            <div class="d-flex gap-2">
              ${skillType
                ? (skillType === 'Master Skill'
                    ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${esc(skillType) || ''}">${esc(skillType)}</span>`
                    : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${esc(skillType) || ''}">${esc(skillType)}</span>`)
                : ''
              }
              ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${esc(sector) || ''}">${esc(sector)}</span>` : ''}
              ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${esc(category) || ''}">${esc(category)}</span>` : ''}
            </div>
          </div>
        `);
                    }
                    return $(`
            <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
                    ${name}
                </span>
                <div class="d-flex gap-2">
                    <span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Company Skill">Company Skill</span>
 
                    ${gen?.sector_name ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-title="${gen?.sector_name || ''}">${gen?.sector_name}</span>` : ''}
                    ${gen?.category_name ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-title="${gen?.category_name || ''}">${gen?.category_name}</span>` : ''}
                </div>
            </div>
        `);
                },
                placeholder: 'Search for a skill',
                minimumInputLength: 1,
                width: 'resolve'
            });

            selectEl.on('select2:open select2:select', function() {
                // Re-initialize tooltips safely (ensures non-null titles)
                try { initializeTooltips(); } catch (err) { console.warn('initializeTooltips failed', err); }
            });
            //     selectEl.on('change', function () {
            //     const $this = $(this);
            //     const selectedId   = $this.val();
            //     const selectedText = $this.find('option:selected').text();

            //     // extract index from the element's id e.g. "skill[3]"
            //     const idMatch = $this.attr('id').match(/^skill\[(\d+)\]$/);
            //     const idx = idMatch ? idMatch[1] : null;

            //     if (!idx) return; // safety guard

            //     if (selectedId) {
            //         $(`#selectTechLevelButton${idx}`).prop('disabled', false);
            //     }

            //     $(`#technicalSkillsHidden\\[${idx}\\]`).val(selectedText);

            //     // Fetch updated skill details
            //     TechSkillChanged(idx, selectedId);
            // });
            selectEl.on('change', function() {
                const $this = $(this);
                const selectedId = $this.val();
                const selectedText = $this.find('option:selected').text();

                // extract index from the element's id e.g. "skill[3]"
                const idMatch = $this.attr('id').match(/^skill\[(\d+)\]$/);
                const idx = idMatch ? idMatch[1] : null;

                if (!idx) return; // safety guard

                if (!selectedId) {
                    // Reset if nothing selected
                    $(`#technicalSkillsHidden\\[${idx}\\]`).val('');
                    $(`#selectTechLevelButton${idx}`).prop('disabled', true);
                    return;
                }

                // ⚡ Pass $this into TechSkillChanged so it can reset if duplicate
                TechSkillChanged(idx, selectedId, $this);
            });
        }

        // central function to show the overwrite confirm modal
        function showOverwriteConfirm(skillIndex) {
            const confirmEl = document.getElementById('OverwriteCompanySkillConfirmModal');
            const m = new bootstrap.Modal(confirmEl);

            const skill = technicalSkillsData[skillIndex] || {};
            document.getElementById('overwriteCompanySkillName').textContent = skill?.name || 'N/A';
            confirmEl.setAttribute('data-skill-index', skillIndex);

            const jobListContainer = document.getElementById('affectedJobList');
            jobListContainer.textContent = 'Loading affected job titles...';

            // const skillId = skill?.skill_id || skill?.id || null;
            //     const skillId = skill.is_new
            //   ? (null)
            //   : (skill?.skill_id || skill?.id || null);
            const skillId = (skill.is_new || skill.is_new_company_skill) ?
                (null) :
                (skill?.skill_id || skill?.id || null);
            if (skillId) {
                fetch(`/admin/get-jobs-by-skill/${skillId}`)
                    .then(res => res.json())
                    .then(data => {
                        const jobTitles = (Array.isArray(data) ? data.map(j => j.title) : []).filter(Boolean).join(
                        ', ');
                        jobListContainer.textContent = jobTitles || 'No associated job titles.';
                    })
                    .catch(() => {
                        jobListContainer.textContent = 'Failed to load job titles.';
                    });
            } else {
                jobListContainer.textContent = 'No job positions are linked to this technical skill.';
            }

            m.show();
        }
    </script>

    <script>
        document.getElementById('OverwriteContinueEditSkillBtn')?.addEventListener('click', function() {
            const modal = document.getElementById('OverwriteCompanySkillConfirmModal');
            const skillIndex = modal.getAttribute('data-skill-index');
            if (!skillIndex || !technicalSkillsData[skillIndex]) {
                console.error('Invalid or missing skillIndex');
                return;
            }
            // mark that user confirmed overwrite
            technicalSkillsData[skillIndex].is_modify = 1;
            
            // ✅ Clear flags that trigger green highlighting when overwriting
            delete technicalSkillsData[skillIndex].is_new_company_skill;
            delete technicalSkillsData[skillIndex].is_new;
            // Reset is_custom to 1 if it was 2 (newly created company skill)
            if (technicalSkillsData[skillIndex].is_custom === 2) {
                technicalSkillsData[skillIndex].is_custom = 1;
            }
            
            const hidden = document.getElementById('technicalSkillsJson');
            if (hidden) hidden.value = JSON.stringify(technicalSkillsData);

            // If a pending continuation was registered by the accept button earlier, run it now
            if (typeof window._pendingOverwriteHandler === 'function') {
                try {
                    window._pendingOverwriteHandler();
                } catch (err) {
                    console.error('Error running pending overwrite handler', err);
                }
                try {
                    delete window._pendingOverwriteHandler;
                } catch (e) {}
            }

            bootstrap.Modal.getInstance(modal)?.hide();
            //   renderInlineSkillEdit(skillIndex);
            console.log("User chose to overwrite existing skill:", technicalSkillsData[skillIndex]);
        });

        // cancel: revert to backup
        document.querySelector('#OverwriteCompanySkillConfirmModal .btn[data-bs-dismiss="modal"]')
            ?.addEventListener('click', function() {
                const modal = document.getElementById('OverwriteCompanySkillConfirmModal');
                const skillIndex = modal.getAttribute('data-skill-index');
                if (!skillIndex || !window.originalSkillBeforeEdit) return;

                technicalSkillsData[skillIndex] = JSON.parse(JSON.stringify(window.originalSkillBeforeEdit));
                const hidden = document.getElementById('technicalSkillsJson');
                if (hidden) hidden.value = JSON.stringify(technicalSkillsData);

                // If user cancels, clear any pending overwrite continuation to avoid accidentally running it later
                try {
                    delete window._pendingOverwriteHandler;
                } catch (e) {}
                // renderInlineSkillEdit(skillIndex);
            });
    </script>




    {{-- Org Chart Scripts --}}
    <script>
        const originalState = {
            departmentId: $('#department_id').val(),
            departmentName: "{{ $job->department->name ?? '' }}",
            level: $('#level-job').val(),
        };

        // This will always hold our pending diffs
        let pendingChanges = [];

        // Universal helper: remove any existing entry, then add if needed
        function toggleChange({
            key,
            title,
            detailHtml,
            description,
            old_value,
            new_value,
            job_title,
            structualChange = false
        }) {
            // 1) remove old entry if it exists
            pendingChanges = pendingChanges.filter(c => c.key !== key);

            // 2) if it truly changed, add it
            if (old_value !== new_value) {
                pendingChanges.push({
                    key,
                    title,
                    detailHtml,
                    description,
                    old_value,
                    new_value,
                    job_title,
                    structualChange
                });
            }
        }

        var job_position = $('#job_profile').val()



        // Department watcher
        $('#department_id').on('change', function() {
            const newId = this.value;
            const newName = $('#department_id option:selected').text();

            toggleChange({
                key: 'change_department',
                title: 'Change Department?',
                detailHtml: `Change Department.`,
                description: 'Change Department',
                old_value: originalState.departmentName,
                new_value: newName,
                job_title: job_position,
                structualChange: true
            });

            console.log('Pending Changes:', pendingChanges);
        });

        // Level watcher
        // $('#level-job').on('change', function() {
        //     const newLvl = this.value;

        //     toggleChange({
        //         key:          'change_level',
        //         title:        job_position,
        //         detailHtml:   `Position Level`,
        //         description:  `Position Level`,
        //         old_value:    originalState.level,
        //         new_value:    newLvl,
        //         job_title:    job_position,
        //         structualChange: false
        //     });

        //     console.log('Pending Changes:', pendingChanges);
        // });

        function handleLevelChange(newLvl) {
            // Always remove old 'change_level' entry
            pendingChanges = pendingChanges.filter(c => c.key !== 'change_level');

            // Do not log if newLvl is empty or same as original
            if (!newLvl || newLvl === originalState.level) {
                console.log('Change cleared or reverted to original — no pending change.');
                return;
            }

            // Log new change
            toggleChange({
                key: 'change_level',
                title: $('#job_profile').val(),
                detailHtml: `Position Level`,
                description: `Position Level`,
                old_value: originalState.level,
                new_value: newLvl,
                job_title: $('#job_profile').val(),
                structualChange: false
            });

            console.log('Pending Changes:', pendingChanges);
        }




        $('#level-job').on('change', function() {
            handleLevelChange(this.value);
        });
    </script>

    <script>
        // The DOM elements you wish to replace with Tagify
        var input1 = document.querySelector("#kt_tagify_1");
        var input2 = document.querySelector("#kt_tagify_2");

        var input3 = document.querySelector("#kt_tagify_3");

        var input5 = document.querySelector("#kt_tagify_5");

        // Initialize Tagify components on the above inputs
        new Tagify(input1);
        new Tagify(input2);
        new Tagify(input3);
        new Tagify(input5);
    </script>

    <script>
        var technicalSkills = @json($technicalSkills);
        //        $('form').on('submit', function (e) {
        //     let isValid = true;
        //     // Target only the FIRST level-job select (Position Level*)
        //     const $positionLevelSelect = $('select#level-job').first();
        //     const levelVal = $positionLevelSelect.val();

        //     // Clear previous validation states
        //     $('#job_profile').removeClass('is-invalid');
        //     $('#jobPositionValidationMessage').hide();

        //     $('#superior').removeClass('is-invalid');
        //     $('#superiorValidationMessage').hide();

        //      // Clear previous validation state
        //     $positionLevelSelect.removeClass('is-invalid');
        //     $('#levelJobValidationMessage').hide();

        //     $('#riasec').removeClass('is-invalid');
        //     $('#riasecValidationMessage').hide();

        //     $('#jobRoleDescription').removeClass('is-invalid');
        //     $('#jobDescValidationMessage').hide();

        //     // 1. Validate Job Position
        //     const jobProfile = $('#job_profile').val().trim();
        //     if (!jobProfile) {
        //         $('#job_profile').addClass('is-invalid');
        //         $('#jobPositionValidationMessage').show();
        //         isValid = false;
        //     }

        //     // 2. Validate Superior
        //     const superior = $('#superior').val();
        //     if (!superior || superior === '') {
        //         $('#superior').addClass('is-invalid');
        //         $('#superiorValidationMessage').show();
        //         isValid = false;
        //     }

        //     // 3. Validate Position Level
        //     // Validate Position Level*
        //     // if (!levelVal || levelVal === '') {
        //     //     $positionLevelSelect.addClass('is-invalid');
        //     //     $('#levelJobValidationMessage').show();
        //     //     isValid = false;
        //     // }

        //     if (!levelVal || levelVal === '') {
        //         $positionLevelSelect.addClass('is-invalid');
        //         $('#levelJobValidationMessage').show();
        //         isValid = false;
        //     }



        //     // 4. Validate RIASEC (must select at least 3)
        //     const riasecSelected = $('#riasec').val() || [];
        //     if (riasecSelected.length < 3) {
        //         $('#riasec').addClass('is-invalid');
        //         $('#riasecValidationMessage').show();
        //         isValid = false;
        //     }

        //     // 5. Validate Job Role Description
        //     const jobDesc = $('#jobRoleDescription').val().trim();
        //     if (jobDesc === '') {
        //         $('#jobRoleDescription').addClass('is-invalid');
        //         $('#jobDescValidationMessage').show();
        //         isValid = false;
        //     }

        //     // If any invalid, prevent form submission and scroll to first error
        //     if (!isValid) {
        //         e.preventDefault();
        //         const scrollTarget = $('.is-invalid, .validation-message').first();
        //         if (scrollTarget.length) {
        //             $('html, body').animate({ scrollTop: scrollTarget.offset().top - 100 }, 500);
        //         }
        //         return false;
        //     }
        // });

        $(document).ready(function() {
            function updateSectionWarnings() {
                // TECHNICAL SKILLS (counts DOM rows; also considers technicalSkillsData if present)
                const techCountFromObj =
                    (window.technicalSkillsData && typeof window.technicalSkillsData === 'object') ?
                    Object.keys(window.technicalSkillsData).length :
                    0;
                const techCountFromDom = $('#skills-container .technical-skill').length;
                const techCount = Math.max(techCountFromObj, techCountFromDom);
                if (techCount > 0) {
                    $('#techvalidationmessage').hide();
                } else {
                    $('#techvalidationmessage').show();
                }

                // GENERIC SKILLS
                // const genericCount = $('#generic-skills-container .generic-skill').length;
                // if (genericCount > 0) { $('#genericValidationMessage').hide(); } else { $('#genericValidationMessage').show(); }
                const genericCount = $('#generic-skills-container .generic-skill').length;
                console.log('genericSkillLength', genericCount); // Debugging the count
                if (genericCount < 3) { // If there are fewer than 3 generic skills
                    $('#genericValidationMessage').show(); // Show error message
                } else {
                    $('#genericValidationMessage').hide(); // Hide error message if there are 3 or more skills
                }

                // CRITICAL WORK FUNCTIONS
                // If only saved CWFs should count, change selector to:
                // $('.critical-functions-container .critical-function[data-has-saved="true"]')
                const cwfCount = $('.critical-functions-container .critical-function').length;
                if (cwfCount > 0) {
                    $('#validationMessage').hide();
                } else {
                    $('#validationMessage').show();
                }
            }

            // Run once on load
            updateSectionWarnings();

            // Observe dynamic add/remove for all three sections
            const observeChildren = (selector) => {
                const node = document.querySelector(selector);
                if (!node) return;
                new MutationObserver(updateSectionWarnings).observe(node, {
                    childList: true
                });
            };
            observeChildren('#skills-container');
            observeChildren('#generic-skills-container');
            observeChildren('.critical-functions-container');

            $('#job_profile').on('input', function() {
                const value = $(this).val().trim(); // Get the trimmed value of the field
                if (value) { // If there's data entered
                    $(this).removeClass('is-invalid'); // Remove invalid class
                    $('#jobPositionValidationMessage').hide(); // Hide error message
                } else {
                    $(this).addClass('is-invalid'); // Add invalid class if empty
                    $('#jobPositionValidationMessage').show(); // Show error message
                }
            });

            // Listen for change in the superior field
            // $('#superior').on('change', function() {
            //     const value = $(this).val(); // Get the selected value
            //     if (value) { // If a value is selected
            //         $(this).removeClass('is-invalid'); // Remove invalid class
            //         $('#superiorValidationMessage').hide(); // Hide error message
            //     } else {
            //         $(this).addClass('is-invalid'); // Add invalid class if no value selected
            //         $('#superiorValidationMessage').show(); // Show error message
            //     }
            // });

            // Listen for change in the position level field
            const $positionLevelSelect = $('#level-job').first();
            $positionLevelSelect.on('change', function() {
                const value = $(this).val(); // Get the selected value
                if (value) { // If a value is selected
                    $(this).removeClass('is-invalid'); // Remove invalid class
                    $('#levelJobValidationMessage').hide(); // Hide error message
                } else {
                    $(this).addClass('is-invalid'); // Add invalid class if no value selected
                    $('#levelJobValidationMessage').show(); // Show error message
                }
            });

            // Listen for change in the RIASEC field
            // $('#riasec').on('change', function() {
            //     const value = $(this).val(); // Get the selected value
            //     if (value.length >= 3) { // If at least 3 values are selected
            //         $(this).removeClass('is-invalid'); // Remove invalid class
            //         $('#riasecValidationMessage').hide(); // Hide error message
            //     } else {
            //         $(this).addClass('is-invalid'); // Add invalid class if fewer than 3 values selected
            //         $('#riasecValidationMessage').show(); // Show error message
            //     }
            // });

            $(document).ready(function() {
                const $riasec = $('#riasec');
                const $validationMsg = $('#riasecValidationMessage');

                // Hide error immediately when user starts interacting
                $riasec.on('select2:opening', function() {
                    $validationMsg.hide();
                    $riasec.removeClass('is-invalid');
                });

                // When dropdown closes, validate
                $riasec.on('select2:close', function() {
                    const value = $(this).val() || [];
                    if (value.length >= 3) {
                        $validationMsg.hide();
                        $riasec.removeClass('is-invalid');
                    } else {
                        $validationMsg.show();
                        $riasec.addClass('is-invalid');
                    }
                });
            });

            // Listen for input in the job role description field
            $('#jobRoleDescription').on('input', function() {
                const value = $(this).val().trim(); // Get the trimmed value of the field
                if (value) { // If there's data entered
                    $(this).removeClass('is-invalid'); // Remove invalid class
                    $('#jobDescValidationMessage').hide(); // Hide error message
                } else {
                    $(this).addClass('is-invalid'); // Add invalid class if empty
                    $('#jobDescValidationMessage').show(); // Show error message
                }
            });

            // Listen for change in the superior hc select field
            // $('.superior-hc-select').on('change', function() {
            //     const value = $(this).val(); // Get the selected value
            //     if (value) { // If a value is selected
            //         $(this).removeClass('is-invalid'); // Remove invalid class
            //         $(this).next('.superiorValidationMessage').hide(); // Hide error message
            //     } else {
            //         $(this).addClass('is-invalid'); // Add invalid class if no value selected
            //         $(this).next('.superiorValidationMessage').show(); // Show error message
            //     }
            // });

            // Handle live validation for each Superior Headcount select box
            $(document).on('change', '.superior-hc-select', function() {
                const selectedValue = $(this).val().trim();
                const $validationMessage = $(this).siblings('.superiorValidationMessage');

                if (selectedValue) {
                    $(this).removeClass('is-invalid');
                    $validationMessage.hide();
                } else {
                    $(this).addClass('is-invalid');
                    $validationMessage.show();
                }
            });


            // Listen for change in the education level field
            $('#education_level').on('change', function() {
                const value = $(this).val(); // Get the selected value
                if (value) { // If a value is selected
                    $(this).removeClass('is-invalid'); // Remove invalid class
                    $('#educationLevelValidationMessage').hide(); // Hide error message
                } else {
                    $(this).addClass('is-invalid'); // Add invalid class if no value selected
                    $('#educationLevelValidationMessage').show(); // Show error message
                }
            });

            // When user selects/changes skills or CWF fields
            $(document).on('change input',
                '.select-skill, .select-generic-skill, .function-input, .task-input, ' +
                'select[name^="technicalSkills"][name$="[level]"]',
                updateSectionWarnings
            );

            // After clicking "Add New ..." buttons
            $('#add_new_skill, #add_new_generic_skill, #add_new_function').on('click', () => {
                setTimeout(updateSectionWarnings, 0);
            });

            // When removing rows
            $(document).on('click', '.remove-technical-skill, .remove-generic-skill, .remove-critical-function',
                updateSectionWarnings);

            $('form').on('submit', function(e) {
                let isValid = true;
                let levelValid = true;

                updateSectionWarnings();

                // Clear all previous validation messages/states
                // $('#validationMessage, #techvalidationmessage, #genericValidationMessage, #managementLevelValidationMessage, #headValidationMessage, #riasecValidationMessage, #descriptionValidationMessage, #jobPositionValidationMessage, #superiorValidationMessage, #levelJobValidationMessage, #jobDescValidationMessage, #unsavedCriticalValidationMessage').hide();

                // $('#headcount, #level-job, #riasec, #jobRoleDescription, #job_profile, #superior').removeClass('is-invalid');
                // $('select[name^="technicalSkills"][name$="[level]"]').removeClass('is-invalid');
                // $('.level-validation-message').remove();
                // $('.edit-level-btn').removeClass('border-danger text-danger');

                const $positionLevelSelect = $('select#level-job').first();
                const levelVal = $positionLevelSelect.val();

                // Clear previous validation states
                $('#job_profile').removeClass('is-invalid');
                $('#jobPositionValidationMessage').hide();

                $('#superior').removeClass('is-invalid');
                $('#superiorValidationMessage').hide();

                // Clear previous validation state
                $positionLevelSelect.removeClass('is-invalid');
                $('#levelJobValidationMessage').hide();

                $('#riasec').removeClass('is-invalid');
                $('#riasecValidationMessage').hide();

                $('#jobRoleDescription').removeClass('is-invalid');
                $('#jobDescValidationMessage').hide();

                $('.superior-hc-select').removeClass('is-invalid');
                $('.superiorValidationMessage').hide();

                $('#education_level').removeClass('is-invalid');
                $('#educationLevelValidationMessage').hide();

                $('#validationMessage').hide();
                $('#techvalidationmessage').hide();
                $('#genericValidationMessage').hide();
                $('#managementLevelValidationMessage').hide();
                $('#headValidationMessage').hide();
                $('#headcount').removeClass('is-invalid');
                $('select[name^="technicalSkills"][name$="[level]"]').removeClass('is-invalid');
                $('.level-validation-message').remove();
                $('.edit-level-btn').removeClass('border-danger text-danger');

                console.log(isValid, "isValid1===");
                // --------------------------------------------
                // 1. CRITICAL WORK FUNCTION VALIDATION
                // --------------------------------------------
                // const savedCWFs = $('.critical-function[data-has-saved="true"]');
                // if (savedCWFs.length < 1) {
                //     $('#validationMessage').show();
                //     isValid = false;
                // }

                console.log(isValid, "isValid2===");


                // const unsavedCWFs = $('.critical-function[data-has-saved="false"]');
                // let hasPartialInput = false;

                // if (unsavedCWFs.length > 0) {
                //     unsavedCWFs.each(function () {
                //         const $wrapper = $(this);
                //         const $functionInput = $wrapper.find('.function-input');
                //         const $taskInputs = $wrapper.find('.task-input');

                //         const titleVal = $functionInput.val().trim();
                //         const taskVals = $taskInputs.map(function () {
                //             return $(this).val().trim();
                //         }).get();

                //         const isTitleEmpty = titleVal === '';
                //         const areAllTasksEmpty = taskVals.every(task => task === '');

                //         if (isTitleEmpty && areAllTasksEmpty) {
                //             $wrapper.remove(); // completely blank
                //         } else {
                //             hasPartialInput = true;

                //             $wrapper.find('.edit-mode').removeClass('d-none');
                //             $wrapper.find('.view-mode').addClass('d-none');

                //             if (isTitleEmpty) {
                //                 $functionInput.addClass('is-invalid');
                //             }

                //             $taskInputs.each(function () {
                //                 if ($(this).val().trim() === '') {
                //                     $(this).addClass('is-invalid');
                //                 }
                //             });

                //             $wrapper.addClass('border border-danger rounded');
                //         }
                //     });

                //     if (hasPartialInput) {
                //         const message = unsavedCWFs.length > 1
                //             ? 'Please save or remove all unsaved Critical Work Functions before submitting.'
                //             : 'Please complete or remove the Critical Work Function before submitting.';

                //         $('#unsavedCriticalValidationMessage').text(message).show();
                //         toastr.error(message);
                //         isValid = false;

                //         $('html, body').animate({
                //             scrollTop: unsavedCWFs.first().offset().top - 100
                //         }, 500);
                //     }
                // }
                const unsavedCWFs = $('.critical-function[data-has-saved="false"]');
                let hasPartialInput = false;

                if (unsavedCWFs.length > 0) {
                    unsavedCWFs.each(function() {
                        const $wrapper = $(this);
                        const $functionInput = $wrapper.find('.function-input');
                        const $taskInputs = $wrapper.find('.task-input');

                        const titleVal = $functionInput.val().trim();
                        const taskVals = $taskInputs.map(function() {
                            return $(this).val().trim();
                        }).get();

                        const isTitleEmpty = titleVal === '';
                        const areAllTasksEmpty = taskVals.every(task => task === '');

                        if (isTitleEmpty && areAllTasksEmpty) {
                            $wrapper.remove(); // Completely blank – remove silently
                        } else {
                            hasPartialInput = true;

                            // Switch to edit mode
                            $wrapper.find('.edit-mode').removeClass('d-none');
                            $wrapper.find('.view-mode').addClass('d-none');

                            // Add error style to title if empty
                            if (isTitleEmpty) {
                                $functionInput.addClass('is-invalid');
                                if ($functionInput.next('.function-error').length === 0) {
                                    $functionInput.after(
                                        '<div class="function-error text-danger small">This field is required</div>'
                                        );
                                }
                            } else {
                                $functionInput.removeClass('is-invalid');
                                $functionInput.next('.function-error').remove();
                            }

                            // Validate each task
                            $taskInputs.each(function() {
                                const $task = $(this);
                                const value = $task.val().trim();

                                if (value === '') {
                                    $task.addClass('is-invalid');
                                    if ($task.next('.task-error').length === 0) {
                                        $task.after(
                                            '<div class="task-error text-danger small">This field is required</div>'
                                            );
                                    }
                                } else {
                                    $task.removeClass('is-invalid');
                                    $task.next('.task-error').remove();
                                }
                            });

                            // Outline error border on wrapper
                            $wrapper.addClass('border border-danger rounded');
                        }
                    });

                    if (hasPartialInput) {
                        const message = unsavedCWFs.length > 1 ?
                            'Please save or remove all unsaved Critical Work Functions before submitting.' :
                            'Please complete or remove the Critical Work Function before submitting.';

                        $('#unsavedCriticalValidationMessage').text(message).show();
                        toastr.error(message);
                        isValid = false;

                        // Scroll to first issue
                        $('html, body').animate({
                            scrollTop: unsavedCWFs.first().offset().top - 100
                        }, 500);
                    } else {
                        $('#unsavedCriticalValidationMessage').hide();
                    }
                }
                console.log(isValid, "isValid3===");


                // --------------------------------------------
                // 2. TECHNICAL SKILLS VALIDATION
                // --------------------------------------------
                if (Object.keys(technicalSkillsData).length < 1) {
                    $('#techvalidationmessage').show();
                    isValid = false;
                }

                // $('select[name^="technicalSkills"][name$="[level]"]').each(function () {
                //     const $select = $(this);
                //     const levelValue = $select.val();
                //     const $button = $select.closest('.technical-skill').find('.edit-level-btn');

                //     const index = $button.attr('id').replace('selectTechLevelButton', '');
                //     const levelSelected = $button.data('level-selected') || false;
                //     console.log('Level Selection:', levelSelected, levelValue);

                //     if (!levelSelected || !levelValue || levelValue === '') {
                //         levelValid = false;
                //         isValid = false;
                //         $select.addClass('is-invalid');

                //         if ($button.length && $button.next('.level-validation-message').length === 0) {
                //             $button.after(`<div class="level-validation-message text-danger mt-1" style="font-size: 0.875rem;">Please select a level</div>`);
                //             $button.addClass('border-danger text-danger');
                //         }
                //     }
                // });

                // Validate each level selection

                // DEBUG: Initial state of validation
                console.log('Initial isValid:', isValid);

                // 1. VALIDATE LEVEL SELECTION
                $('button.edit-level-btn').each(function() {
                    const $button = $(this);
                    const levelText = $button.text().trim(); // Get the button text (Level text)
                    const index = $button.attr('id').replace('selectTechLevelButton',
                    ''); // Extract index from the button's id
                    const $select = $(
                    `#skill\\[${index}\\]`); // Get the corresponding select element by index
                    const levelValue = $select.val(); // Get the selected level value

                    // Check if this button belongs to a technical skill (you can add a class or other selector for targeting)
                    if ($button.closest('.technical-skill').length) {
                        // Check if the level text is "Select Level", "Level", or if no level is selected
                        if (levelText === "Select Level" || levelText === "Level" || !levelValue) {
                            levelValid = false; // Mark the level as invalid
                            isValid = false; // Mark the form as invalid
                            $select.addClass(
                            'is-invalid'); // Add invalid class to the select element

                            // Add an error message if it does not already exist
                            if ($button.length && $button.next('.level-validation-message')
                                .length === 0) {
                                $button.after(`
                    <div class="level-validation-message text-danger mt-1" style="font-size: 0.875rem;">
                        Please select a level
                    </div>
                `);
                                $button.addClass(
                                'border-danger text-danger'); // Add red border to the button
                            }
                        } else {
                            // Reset validation if the level is properly selected
                            $select.removeClass('is-invalid');
                            $button.removeClass('border-danger text-danger');
                            $button.next('.level-validation-message')
                        .remove(); // Remove the error message
                        }
                    }
                });



                $('.technical-skill').each(function() {
                    const $select = $(this).find('.select-skill');
                    const skillVal = $select.val();
                    const $message = $(this).find('.skill-validation-message');

                    if (!skillVal || skillVal === '') {
                        $select.addClass('is-invalid');
                        $message.show();
                        isValid = false;
                    } else {
                        $select.removeClass('is-invalid');
                        $message.hide();
                    }
                });

                console.log(isValid, "isValid4===");



                // --------------------------------------------
                // 3. GENERIC SKILLS VALIDATION
                // --------------------------------------------
                if ($('#generic-skills-container .generic-skill').length < 1) {
                    toastr.error('At least three Generic Skills are required.');
                    $('#genericValidationMessage').show();
                    isValid = false;
                } else {
                    $('#generic-skills-container .generic-skill').each(function() {
                        const skillIndex = $(this).attr('id').split('-').pop();
                        const preferredLevel = genericSkillsData[skillIndex]?.preferred_level;
                        const $button = $(this).find('.edit-level-btn');

                        $button.removeClass('border-danger text-danger');
                        $button.next('.level-validation-message').remove();

                        if (!preferredLevel || preferredLevel === '') {
                            levelValid = false;
                            isValid = false;

                            $button.addClass('border-danger text-danger');
                            $button.after(
                                `<div class="level-validation-message text-danger mt-1" style="font-size: 0.875rem;">At least one level is required</div>`
                                );
                        }
                    });
                }

                console.log(isValid, "isValid5===");
                if (!levelValid) {
                    const scrollTarget = $('.level-validation-message').first();
                    if (scrollTarget.length) {
                        $('html, body').animate({
                            scrollTop: scrollTarget.offset().top - 100
                        }, 500);
                    }
                }

                $('.generic-skill').each(function() {
                    const $skillSelect = $(this).find('.select-generic-skill');
                    const skillVal = $skillSelect.val();
                    const $message = $(this).find('.generic-skill-validation-message');

                    $skillSelect.removeClass('is-invalid');
                    $message.hide();

                    if (!skillVal || skillVal === '') {
                        $skillSelect.addClass('is-invalid');
                        $message.show();
                        isValid = false;
                    }
                });
                console.log(isValid, "isValid6===");

                // --------------------------------------------
                // 4. JOB PROFILE
                // --------------------------------------------
                const jobProfile = $('#job_profile').val().trim();
                if (!jobProfile) {
                    $('#job_profile').addClass('is-invalid');
                    $('#jobPositionValidationMessage').show();
                    isValid = false;
                }

                console.log(isValid, "isValid7===");


                // --------------------------------------------
                // 5. SUPERIOR
                // --------------------------------------------
                //     if (!$('#superior').prop('disabled')) {
                //     const superior = $('#superior').val();
                //     if (!superior || superior === '') {
                //         $('#superior').addClass('is-invalid');
                //         $('#superiorValidationMessage').show();
                //         isValid = false;
                //     }
                // }

                //     console.log(isValid,"isValid8===");
                //     // --------------------------------------------
                //     // 6. POSITION LEVEL
                //     // --------------------------------------------
                //     const selectedLevel = $('#level-job').val();
                //     if (!selectedLevel || selectedLevel === '') {
                //         $('#level-job').addClass('is-invalid');
                //         $('#levelJobValidationMessage').show();
                //         isValid = false;
                //     }

                if (!$('#superior').prop('disabled')) {
                    const superior = $('#superior').val();
                    if (!superior || superior === '') {
                        $('#superior').addClass('is-invalid');
                        $('#superiorValidationMessage').show();
                        isValid = false;
                    }

                    const selectedLevel = $('#level-job').val();
                    if (!selectedLevel || selectedLevel === '') {
                        $('#level-job').addClass('is-invalid');
                        $('#levelJobValidationMessage').show();
                        isValid = false;
                    }
                }

                console.log(isValid, "isValid9===");
                // --------------------------------------------
                // 7. RIASEC (min 3 selections)
                // --------------------------------------------
                const riasecSelected = $('#riasec').val() || [];
                if (riasecSelected.length < 3) {
                    $('#riasec').addClass('is-invalid');
                    $('#riasecValidationMessage').show();
                    toastr.error('Please select at least 3 RIASEC values.');
                    isValid = false;
                }

                console.log(isValid, "isValid10===");
                // --------------------------------------------
                // 8. JOB ROLE DESCRIPTION
                // --------------------------------------------
                const jobDesc = $('#jobRoleDescription').val().trim();
                if (jobDesc === '') {
                    $('#jobRoleDescription').addClass('is-invalid');
                    $('#jobDescValidationMessage').show();
                    isValid = false;
                }

                console.log(isValid, "isValid11===");
                $('.superior-hc-select').each(function() {
                    const $select = $(this);
                    const selectedValue = $select.val();
                    const $message = $select.next('.superiorValidationMessage');

                    if ($select.prop('disabled')) return;

                    if (!selectedValue || selectedValue === '') {
                        $select.addClass('is-invalid');
                        $message.show();
                        isValid = false;
                    } else {
                        $select.removeClass('is-invalid');
                        $message.hide();
                    }
                });

                console.log(isValid, "isValid12===");
                const eduLevel = $('#education_level').val();
                if (!eduLevel || eduLevel === '') {
                    $('#education_level').addClass('is-invalid');
                    $('#educationLevelValidationMessage').show();
                    isValid = false;
                }

                console.log(isValid, "isValid13===");

                console.log(isValid, "isValid14===");
                // Work Experience
                // const workExperience = $('#work_experience').val();
                // if (!workExperience || workExperience === '') {
                //     $('#work_experience').addClass('is-invalid');
                //     $('#workExperienceValidationMessage').show();
                //     isValid = false;
                // } else {
                //     $('#work_experience').removeClass('is-invalid');
                //     $('#workExperienceValidationMessage').hide();
                // }

                console.log(isValid, "isValid15===");

                // --------------------------------------------
                // 10. SCOPE OF STUDY
                // --------------------------------------------

                // Scope of Study
                // const scopeOfStudy = $('#scope_of_study').val();
                // if (!scopeOfStudy || scopeOfStudy === '') {
                //    $('#scope_of_study').addClass('is-invalid');
                //    $('#scopeOfStudyValidationMessage').show();
                //    isValid = false;
                // } else {
                //    $('#scope_of_study').removeClass('is-invalid');
                //    $('#scopeOfStudyValidationMessage').hide();
                // }


                console.log(isValid, "isValid16===");


                // --------------------------------------------
                // 11. PENDING CHANGES
                // --------------------------------------------



                var departmentId = $('#department_id').val(); // Make sure this matches your form's input ID
                var departmentText = $('#department_id option:selected').text();
                var currentDepartmentId =
                "{{ $job->department_id }}"; // Blade variable for the original department_id

                console.log("dbhjsdfhjsdf2", pendingChanges.length);


                console.log("q", pendingChanges);

                if (isValid) {
                    if (pendingChanges.length) {
                        event.preventDefault();
                        const items = pendingChanges
                            .filter(c => c.structualChange === true)
                            .map(c => `<li>${c.detailHtml}</li>`)
                            .join('');

                        console.log(items == '', "===================");


                        const descriptions = pendingChanges
                            .filter(c => c.structualChange === false)
                            .map(c => `<li>${c.description}</li>`)
                            .join('');

                        const descriptionHtml = `<ul>${descriptions}</ul>`;

                        if (pendingChanges.length > 1) {
                            if (items != '') {
                                document.getElementById('jd_redirect').value = 2;
                                document.getElementById('pendingChangesJson').value = JSON.stringify(
                                    pendingChanges);
                            }
                            ModalManager.open({
                                module: 'jobs',
                                key: 'generic_confirm',
                                data: {
                                    title: 'Please Confirm Changes',
                                    bodyHtml: `<ul>${items}</ul>`,
                                    descriptions: descriptionHtml
                                },
                                onSubmit(modalEl) {
                                    this.$('#job_description_form')[0].submit();
                                }
                            });
                        } else {
                            if (pendingChanges[0].structualChange == true) {
                                document.getElementById('jd_redirect').value = 2;
                                document.getElementById('pendingChangesJson').value = JSON.stringify(
                                    pendingChanges);
                            }
                            ModalManager.open({
                                module: 'jobs',
                                key: pendingChanges[0].key,
                                data: {
                                    old_value: pendingChanges[0].old_value,
                                    new_value: pendingChanges[0].new_value,
                                    job_title: pendingChanges[0].title,
                                },
                                onSubmit(modalEl) {
                                    this.$('#job_description_form')[0].submit();
                                }
                            });
                        }
                    }
                }


                // --------------------------------------------
                // FINAL VALIDATION
                // --------------------------------------------
                // if (!isValid) {
                //     e.preventDefault();
                //     const scrollTarget = $('.is-invalid, .validation-message').first();
                //     if (scrollTarget.length) {
                //         $('html, body').animate({ scrollTop: scrollTarget.offset().top - 100 }, 500);
                //     }
                //     return false;
                // }

                // DEBUG: Check validation result after all checks
                console.log('After validation checks, isValid:', isValid);

                if (!isValid) {
                    e.preventDefault();

                    // Find first visible invalid input or visible error message
                    const scrollTarget = $('.is-invalid:visible, .validation-message:visible').first();

                    // Wait for DOM to update before scrolling
                    setTimeout(() => {
                        if (scrollTarget.length) {
                            $('html, body').animate({
                                scrollTop: scrollTarget.offset().top - 100
                            }, 500);

                            // Optionally set focus if it's an input/select
                            if (scrollTarget.is('input, select, textarea')) {
                                scrollTarget.focus();
                            }
                        }
                    }, 100);

                    return false; // prevent form from submitting
                }

                // Allow form submission if valid
            });

            // DEBUG: If form is valid, allow submission
            console.log('Form is valid, allowing submission');
            return true; // Allow form submission

        });



        $(document).ready(function() {
            $('#technicalSkills').select2();
            $('#superior').select2();


            // $('#job_description_form').submit(function(event) {
            //     var job_desc = $('#job_desc').val();
            //     var heads = $('#heads').val();
            //     var position_code = $('#position_code').val();
            //     var job_role = $('#job_profile').val();
            //     var job_role_desc = $('#job_role_desc').val();
            //     var isValid = true;
            //     console.log("dbhjsdfhjsdf");



            //     // Simple validation checks
            //     if (job_role_desc === '') {
            //         $('#job_role_desc').next('.error').remove();
            //         $('#job_role_desc').after(
            //             '<span class="error">Job Description is required</span>');
            //         isValid = false;
            //         console.log("error-1");

            //     } else {
            //         $('#job_role_desc').next('.error').remove();
            //     }

            //     if (job_role === '') {
            //         $('#job_profile').next('.error').remove();
            //         $('#job_profile').after('<span class="error">Job Position is required</span>');
            //         isValid = false;
            //         console.log("error-2");
            //     } else {
            //         $('#job_profile').next('.error').remove();
            //     }

            //     if (heads === '') {
            //         $('#heads').next('.error').remove();
            //         $('#heads').after('<span class="error">Job Role is required</span>');
            //         isValid = false;
            //         console.log("error-3");
            //     } else {
            //         $('#heads').next('.error').remove();
            //     }


            //     if ($('.critical-functions-container').find('.critical-function').length === 0) {
            //         $('#validationMessage').show();
            //         isValid = false;
            //         console.log("error-4");
            //     } else {
            //         $('#validationMessage').hide();
            //     }

            //     console.log($('#skills-container').find('.technical-skill'));

            //     if ($('#skills-container').find('.technical-skill').length === 0) {
            //         $('#techvalidationmessage').show();
            //         isValid = false;
            //         console.log("error-5",$('#skills-container').find('.technical-skill').length);
            //     } else {
            //         $('#techvalidationmessage').hide();
            //     }

            //     if (position_code === '') {
            //         $('#position_code').next('.error').remove();
            //         $('#position_code').after('<span class="error">Position Code is required</span>');
            //         isValid = false;
            //         console.log("error-6");
            //     } else {
            //         $('#position_code').next('.error').remove();
            //     }


            //     // Check uniqueness of position code
            //     if (isValid) {
            //         $.ajax({
            //             type: "POST",
            //             url: "{{ route('check-position-code') }}",
            //             data: {
            //                 _token: $('meta[name="csrf-token"]').attr('content'),
            //                 position_code: position_code
            //             },
            //             async: false,
            //             success: function(response) {
            //                 if (!response.isUnique) {
            //                     $('#position_code').next('.error').remove();
            //                     $('#position_code').after(
            //                         '<span class="error">Position Code must be unique</span>'
            //                     );
            //                     isValid = false;
            //                     console.log("error-7");
            //                 } else {
            //                     $('#position_code').next('.error').remove();
            //                 }
            //             }
            //         });
            //     }

            //     // Validate generic skills
            //     var selectedSkills = [];
            //     var skillsValid = true;
            //     var firstInvalidSkillElement = null;

            //     $('select[name^="skills["][name$="[title]"]').each(function() {
            //         var skillValue = $(this).val();
            //         if (skillValue !== "") {
            //             if (selectedSkills.includes(skillValue)) {
            //                 $(this).next('.error').remove();
            //                 $(this).after('<span class="error">Duplicate Skill Selected</span>');
            //                 skillsValid = false;
            //                 console.log("error-8");
            //                 if (!firstInvalidSkillElement) {
            //                     firstInvalidSkillElement = $(this);
            //                 }
            //             } else {
            //                 selectedSkills.push(skillValue);
            //                 $(this).next('.error').remove();
            //             }
            //         }
            //     });

            //     // if (selectedSkills.length === 0) {
            //     //     $('select[name^="skills["][name$="[title]"]').first().next('.error').remove();
            //     //     $('select[name^="skills["][name$="[title]"]').first().after(
            //     //         '<span class="error">At least one skill must be selected</span>');
            //     //     skillsValid = false;
            //     //     console.log("error-9");
            //     //     firstInvalidSkillElement = $('select[name^="skills["][name$="[title]"]').first();
            //     // }

            //     // if (!skillsValid) {
            //     //     isValid = false;
            //     //     console.log("error-10");
            //     // }



            //     // Validate technical skills
            //     var selectedTechnicalSkills = [];
            //     var technicalSkillsValid = true;
            //     var firstInvalidTechnicalSkillElement = null;

            //     $('select[name^="technicalSkills["][name$="[id]"]').each(function() {
            //         var techSkillValue = $(this).val();
            //         if (techSkillValue !== "") {
            //             if (selectedTechnicalSkills.includes(techSkillValue)) {
            //                 $(this).next('.error').remove();
            //                 $(this).after(
            //                     '<span class="error">Duplicate Technical Skill Selected</span>');
            //                 technicalSkillsValid = false;
            //                 if (!firstInvalidTechnicalSkillElement) {
            //                     firstInvalidTechnicalSkillElement = $(this);
            //                 }
            //             } else {
            //                 selectedTechnicalSkills.push(techSkillValue);
            //                 $(this).next('.error').remove();
            //             }
            //         }
            //     });

            //     if (selectedTechnicalSkills.length === 0) {
            //         $('select[name^="technicalSkills["][name$="[id]"]').first().next('.error').remove();
            //         $('select[name^="technicalSkills["][name$="[id]"]').first().after(
            //             '<span class="error">At least one technical skill must be selected</span>');
            //         technicalSkillsValid = false;
            //         firstInvalidTechnicalSkillElement = $('select[name^="technicalSkills["][name$="[id]"]')
            //             .first();
            //     }

            //     if (!technicalSkillsValid) {
            //         isValid = false;
            //     }


            //     var departmentId = $('#department_id').val();  // Make sure this matches your form's input ID
            //     var departmentText = $('#department_id option:selected').text();
            //     var currentDepartmentId = "{{ $job->department_id }}";  // Blade variable for the original department_id

            //     console.log("dbhjsdfhjsdf2",pendingChanges.length);


            //     console.log("q",pendingChanges);

            //     if (pendingChanges.length) {
            //         event.preventDefault();
            //         const items = pendingChanges
            //             .filter(c => c.structualChange === true)
            //             .map(c => `<li>${c.detailHtml}</li>`)
            //             .join('');

            //         const descriptions = pendingChanges
            //             .filter(c => c.structualChange === false)
            //             .map(c => `<li>${c.description}</li>`)
            //             .join('');

            //         const descriptionHtml = `<ul>${descriptions}</ul>`;

            //         if (pendingChanges.length > 1) {
            //             ModalManager.open({
            //                 module: 'jobs',
            //                 key:    'generic_confirm',
            //                 data: {
            //                     title: 'Please Confirm Changes',
            //                     bodyHtml: `<ul>${items}</ul>`,
            //                     descriptions: descriptionHtml
            //                 },
            //                 onSubmit(modalEl) {
            //                     this.$('#job_description_form')[0].submit();
            //                 }
            //             });
            //         } else {
            //             ModalManager.open({
            //                 module: 'jobs',
            //                 key: pendingChanges[0].key,
            //                 data: {
            //                     old_value: pendingChanges[0].old_value,
            //                     new_value: pendingChanges[0].new_value,
            //                     job_title: pendingChanges[0].title,
            //                 },
            //                 onSubmit(modalEl) {
            //                     this.$('#job_description_form')[0].submit();
            //                 }
            //             });
            //         }
            //     }

            //     console.log("dbhjsdfhjsdf3",isValid);


            //     // Prevent the form submission if validation fails
            //     if (!isValid) {
            //         event.preventDefault();
            //         scrollToFirstErrorField();
            //     }

            //     if (isValid) {
            //         console.log("dbhjsdfhjsdf4");
            //     }
            // });

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
        // function TechSkillChanged(index, skillId) {
        //     showOverlay();
        //     $.ajax({
        //         url: '/admin/get-techskill-levels/' + skillId,
        //         type: 'GET',
        //         success: function(response) {
        //             const skill = response[0]; // Ensure this is the full skill object
        //             if (!skill) return;

        //             // Save to global data store
        //             technicalSkillsData[index] = {
        //                 c_id: skill.c_id || null,
        //                 skill_id: skill.id || null,
        //                 code: skill.code || null,
        //                 sector_id: skill.sector_id || null,
        //                 sector_name: skill.sector_name || '',
        //                 sub_sector_id: skill.sub_sector_id || null,
        //                 sub_sector_name: skill.sub_sector_name || '',
        //                 name: skill.name || '',
        //                 description: skill.description || '',
        //                 preferred_level: skill.preferred_level || '',
        //                 is_custom: skill.is_custom ?? '',
        //                 category_id: skill.category_id ?? '',
        //                 category_name: skill.category_name ?? ''
        //             };

        //             // Parse levels dynamically
        //             Object.keys(skill).forEach(key => {
        //                 const match = key.match(/^level_(\d+)_description$/);
        //                 if (match) {
        //                     const level = match[1];
        //                     technicalSkillsData[index][`level_${level}_description`] = skill[
        //                         `level_${level}_description`];
        //                     technicalSkillsData[index][`level_${level}_knowledge`] = Array.isArray(
        //                             skill[`level_${level}_knowledge`]) ?
        //                         skill[`level_${level}_knowledge`] :
        //                         (skill[`level_${level}_knowledge`] || '').split(';');

        //                     technicalSkillsData[index][`level_${level}_ability`] = Array.isArray(skill[
        //                             `level_${level}_ability`]) ?
        //                         skill[`level_${level}_ability`] :
        //                         (skill[`level_${level}_ability`] || '').split(';');
        //                 }
        //             });

        //             // Update the button label
        //             $(`#selectTechLevelButton${index}`).html(`Select Level`);

        //             // Store skill name
        //             $(`#technicalSkillsHidden\\[${index}\\]`).val(skill.name);
        //             $(`#technicalSkillsHiddenCustom\\[${index}\\]`).val(skill.is_custom);

        //             // Update modal trigger
        //             $(`#selectTechLevelButton${index}`).attr(
        //                 'onclick',
        //                 `technicalpopulateModal(${index})`
        //             );

        //             // Optional: store the JSON in hidden field if needed
        //             $('#technicalSkillsJson').val(JSON.stringify(technicalSkillsData));
        //             hideOverlay();
        //         },
        //         error: function(error) {
        //             hideOverlay();
        //             console.error("Failed to load technical skill levels:", error);
        //         }
        //     });
        // }
        const cachedTechnicalSkills = @json($cachedData['technical_skills'] ?? []);

        function cleanSkillName(name) {
            if (!name) return "";
            return name.replace(/\(([^)]+)\)/g, (match, inside) => {
                if (inside.includes("-")) {
                    return "";
                }
                return `(${inside})`;
            }).trim();
        }

        function TechSkillChanged(index, skillId, selectEl = null) {
            showOverlay();
            $.ajax({
                url: '/admin/get-techskill-levels/' + skillId,
                type: 'GET',
                success: function(response) {
                    const skill = response[0];
                    if (!skill) {
                        hideOverlay();
                        return;
                    }

                    function isDuplicate(skillA, skillB) {
                        return (
                            (cleanSkillName(skillA.name) || '').toLowerCase().trim() === (cleanSkillName(
                                skillB.name) || '').toLowerCase().trim() &&
                            (skillA.category_name || '').toLowerCase().trim() === (skillB.category_name ||
                                '').toLowerCase().trim() &&
                            (skillA.sector_name || '').toLowerCase().trim() === (skillB.sector_name || '')
                            .toLowerCase().trim()
                        );
                    }

                    // Duplicate check
                    let duplicate = null;
                    for (let i = 0; i < cachedTechnicalSkills.length; i++) {
                        let item = cachedTechnicalSkills[i];

                        // ✅ Check skill vs cached item
                        if (isDuplicate(item, skill)) {
                            // ✅ Abhi check karo ki yahi item technicalSkillsData me bhi hai
                            let foundInTechnicalSkills = Object.values(technicalSkillsData).some(tsItem =>
                                isDuplicate(tsItem, item) // compare with technicalSkillsData
                            );

                            if (foundInTechnicalSkills) {
                                duplicate = item;
                                break;
                            }
                        }
                    }

                    if (duplicate) {
                        hideOverlay();
                        alert('This skill is already selected. Please choose another.');

                        // Reset dropdown, hidden field, and disable button
                        if (selectEl) {
                            selectEl.val('').trigger('change.select2');
                            $(`#technicalSkillsHidden\\[${index}\\]`).val('');
                            $(`#selectTechLevelButton${index}`).prop('disabled', true);
                            $(`#selectTechLevelButton${index}`).html(`Select Level`);
                        }
                        return;
                    }

                        // Before assigning the skill, check if this skill matches any removed-skill row.
                        // If it does, ask the user whether to restore the removed skill instead of assigning it here.
                        const removedRows = Array.from(document.querySelectorAll('.removed-skill'));
                        let matchingRemovedRow = null;
                        for (const row of removedRows) {
                            // try to find an input that holds the original id
                            const idInput = row.querySelector('input[name*="[id]"]');
                            const nameInput = row.querySelector('input[name*="[name]"]');
                            if (idInput && String(idInput.value) === String(skill.id)) {
                                matchingRemovedRow = row;
                                break;
                            }
                            if (!matchingRemovedRow && nameInput && cleanLabel(String(nameInput.value || '')).toLowerCase() === cleanLabel(String(skill.name || '')).toLowerCase()) {
                                matchingRemovedRow = row;
                                break;
                            }
                        }

                        if (matchingRemovedRow) {
                            // Directly restore the skill without confirmation modal
                            // Reconstruct the complete skill object from the removed row's hidden inputs
                            const restoredSkill = {
                                id: null,
                                skill_id: null,
                                name: '',
                                preferred_level: '',
                                is_new: 0, // Explicitly set is_new to 0 since this is a restored skill
                            };

                            // Get all hidden inputs from the removed row
                            const inputs = matchingRemovedRow.querySelectorAll('input[type="hidden"]');
                            inputs.forEach(input => {
                                const name = input.name;
                                const value = input.value;
                                
                                // Parse the input name to get the property path
                                const matches = name.match(/removedSkills\[[\w_]+\]\[([^\]]+)\](?:\[(\d+)\])?/);
                                if (matches) {
                                    const prop = matches[1];
                                    const arrayIndex = matches[2];
                                    
                                    if (arrayIndex !== undefined) {
                                        // This is an array property (like level_1_knowledge[])
                                        if (!Array.isArray(restoredSkill[prop])) {
                                            restoredSkill[prop] = [];
                                        }
                                        restoredSkill[prop][arrayIndex] = value;
                                    } else {
                                        // This is a simple property
                                        restoredSkill[prop] = value;
                                    }
                                }
                            });

                            // Get the new active index and remove the old row
                            const newActiveIndex = getNextSkillIndex('.technical-skill:not(.removed-skill)');
                            matchingRemovedRow.remove();

                            console.debug('Restoring skill with data:', { 
                                id: restoredSkill.id || restoredSkill.skill_id,
                                name: restoredSkill.name,
                                preferred_level: restoredSkill.preferred_level,
                                is_new: restoredSkill.is_new
                            });

                            // Add it back as an active skill using the reconstructed data
                            addTechnicalSkill(newActiveIndex, restoredSkill, []);

                            // Clear the temporary selection in the current select element
                            if (selectEl) {
                                selectEl.val('').trigger('change.select2');
                                $(`#technicalSkillsHidden\\[${index}\\]`).val('');
                                $(`#selectTechLevelButton${index}`).prop('disabled', true);
                                $(`#selectTechLevelButton${index}`).html('Select Level');

                                // If this was a new empty row, remove it since we don't need it
                                const currentRow = document.getElementById(`skill-${index}`);
                                if (currentRow && !currentRow.querySelector('select').value) {
                                    currentRow.remove();
                                    delete technicalSkillsData[index];
                                }
                            }

                            // Hide overlay
                            try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}

                            // Show "Skill Restored" modal directly
                            setTimeout(() => {
                                const skillRestoredModal = new bootstrap.Modal(document.getElementById('SkillRestoredModal'));
                                skillRestoredModal.show();
                            }, 300);

                            // Stop further processing
                            return;
                        }

                        // ✅ Only update hidden input & button when NOT duplicate
                        if (selectEl) {
                            const selectedText = selectEl.find('option:selected').text();
                            $(`#technicalSkillsHidden\\[${index}\\]`).val(selectedText);
                            $(`#selectTechLevelButton${index}`).prop('disabled', false);
                        }

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
                                String(skill[`level_${level}_knowledge`] || '').split(';');
                            technicalSkillsData[index][`level_${level}_ability`] = Array.isArray(skill[
                                    `level_${level}_ability`]) ?
                                skill[`level_${level}_ability`] :
                                (skill[`level_${level}_ability`] || '').split(';');
                        }
                    });

                    // Update button label + modal
                    $(`#selectTechLevelButton${index}`).html(`Select Level`);
                    $(`#technicalSkillsHiddenCustom\\[${index}\\]`).val(skill.is_custom);
                    $(`#selectTechLevelButton${index}`).attr('onclick', `technicalpopulateModal(${index})`);

                    // Update JSON hidden field
                    $('#technicalSkillsJson').val(JSON.stringify(technicalSkillsData));

                    // 🔑 Add to cached skills so new ones also block duplicates
                    cachedTechnicalSkills.push({
                        name: skill.name,
                        category_name: skill.category_name,
                        sector_name: skill.sector_name
                    });

                    hideOverlay();
                    
                    // ✅ Refresh comparison if active to maintain green highlighting for all new skills
                    if (comparisonActive) {
                        console.log('TechSkillChanged: Refreshing comparison to maintain green highlighting');
                        const ajaxResponse = @json($cachedData);
                        let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                          .masterTechnicalSkills.length > 0 ?
                          ajaxResponse.masterTechnicalSkills :
                          (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : []);
                        const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : [];
                        const currentFormSkills = getCurrentFormSkills();

                        const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                        
                        // Handle validation errors
                        if (comparison.status === 'validation_error') {
                          console.warn('Validation Error:', comparison.message);
                        } else {
                          console.log('TechSkillChanged: Rendering comparison with', comparison.comparisonResults);
                          renderComparison(comparison.comparisonResults);
                          showComparisonSummary(comparison.comparisonResults);
                        }
                    }
                },
                error: function(error) {
                    hideOverlay();
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


        // function updateSkillLevel(button) {

        //     let skillId = $(button).data('skill-id');
        //     let selectedLevel = $('#kt_modal_2 .modal-body input:checked').val();

        //     // Debugging output
        //     console.log("Skill ID:", skillId);
        //     console.log("Selected Level:", selectedLevel);

        //     // Ensure the selector targets the correct select element
        //     let selectSelector = `select[name="skills[${skillId}][level]"]`;
        //     let selectElement = $(selectSelector);

        //     if (selectElement.length) {
        //         selectElement.val(selectedLevel);
        //         console.log("Select element found and value updated.");
        //     } else {
        //         console.error("Select element not found with selector:", selectSelector);
        //     }
        // }

        //         function updateSkillLevel(button) {
        //     const index = $(button).data('skill-id'); // From save button
        //     const selectedLevel = $('#kt_modal_2 .modal-body input[name="level"]:checked').val();

        //     if (!selectedLevel) return;

        //     // Convert numeric level to label
        //     function getLevelLabel(level) {
        //         switch (parseInt(level)) {
        //             case 1: return 'Basic';
        //             case 2: return 'Intermediate';
        //             case 3: return 'Advanced';
        //             default: return '';
        //         }
        //     }

        //     const levelLabel = getLevelLabel(selectedLevel);

        //     // Update in-memory data
        //     if (genericSkillsData[index]) {
        //         genericSkillsData[index].preferred_level = levelLabel;
        //     }

        //     // Update hidden input
        //     const inputSelector = `input[name="genericSkills[${index}][preferred_level]"]`;
        //     let hiddenInput = $(inputSelector);
        //     if (hiddenInput.length) {
        //         hiddenInput.val(levelLabel);
        //     } else {
        //         $(`#generic-skill-${index}`).append(
        //             `<input type="hidden" name="genericSkills[${index}][preferred_level]" value="${levelLabel}">`
        //         );
        //     }

        //     // Update button text
        //     $(`#selectGenericLevelButton${index}`).text(levelLabel);
        // }

        // function updateSkillLevel(button) {
        //     const index = $(button).data('skill-id');
        //     const selectedLevel = $('#genericSkillModal input[name="generic_level"]:checked').val();
        //     if (!selectedLevel) return;

        //     console.log('updateSkillLevel', index, selectedLevel);

        //     const levelLabel = getLevelLabel(selectedLevel);

        //     if (genericSkillsData[index]) {
        //         genericSkillsData[index].preferred_level = levelLabel;
        //     }

        //     // Update or insert the hidden input
        //     const container = $(`#generic-skill-${index}`);
        //     const inputSelector = `input[name="genericSkills[${index}][preferred_level]"]`;
        //     const existingInput = container.find(inputSelector);

        //     if (existingInput.length) {
        //         existingInput.val(levelLabel);
        //     } else {
        //         container.prepend(
        //             `<input type="hidden" name="genericSkills[${index}][preferred_level]" value="${levelLabel}">`
        //         );
        //     }

        //     // Update level button display
        //     $(`#selectGenericLevelButton${index}`).text(levelLabel);
        // }

        function updateSkillLevel(button) {
            const index = $(button).data('skill-id');
            const selectedLevel = temporaryGenericLevelSelection[index];
            if (!selectedLevel) return;

            const levelLabel = getLevelLabel(selectedLevel);

            if (genericSkillsData[index]) {
                genericSkillsData[index].preferred_level = levelLabel;
            }

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

            // ✅ Update button label here only when saved
            $(`#selectGenericLevelButton${index}`).text(levelLabel);
        }






        // function updateTechSkillLevel(button) {

        //     let skillId = $(button).data('skill-id');
        //     let selectedLevel = $('#techskillmodal .modal-body input:checked').val();

        //     // Debugging output
        //     console.log("Skill ID:", skillId);
        //     console.log("Selected Level:", selectedLevel);

        //     // Ensure the selector targets the correct select element
        //     let inputSelector = `input[name="technicalSkills[${skillId}][preferred_level]"]`;
        //     let inputElement = $(inputSelector);


        //     console.log('inputElement', inputElement);

        //     if (inputElement.length) {
        //         inputElement.val(selectedLevel);
        //         console.log("Hidden input element found and value updated.");
        //     } else {
        //         console.error("Hidden input element not found with selector:", inputSelector);
        //     }
        // }

        // function updateTechSkillLevel(button) {
        //     let skillId = $(button).data('skill-id');
        //     let selectedLevel = $('#techskillmodal .modal-body input:checked').val();

        //     if (typeof skillId === 'undefined' || typeof selectedLevel === 'undefined') {
        //         console.error('Skill ID or Selected Level is undefined');
        //         return;
        //     }

        //     // Update the internal technicalSkillsData object
        //     if (technicalSkillsData[skillId]) {
        //         technicalSkillsData[skillId].preferred_level = parseInt(selectedLevel);
        //     }

        //     console.log("Skill ID:", skillId);

        //     // Update the hidden input for preferred_level
        //     const inputSelector = `input[name="technicalSkills[${skillId}][preferred_level]"]`;
        //     let inputElement = $(inputSelector);
        //     if (inputElement.length) {
        //         inputElement.val(selectedLevel);
        //     } else {
        //         // If input not found, insert a new hidden input
        //         $(`#skill-${skillId}`).prepend(`
    //             <input type="hidden" name="technicalSkills[${skillId}][preferred_level]" value="${selectedLevel}">
    //         `);
        //     }

        //     // Update the button text to reflect the selected level
        //     $(`#selectTechLevelButton${skillId}`).text(`Level ${selectedLevel}`);

        //     // Optional: Re-log updated JSON
        //     const formattedJson = JSON.stringify({ technical_skills: Object.values(technicalSkillsData) }, null, 4);
        //     console.log('Updated technicalSkillsData JSON:', formattedJson);
        // }

        function updateTechSkillLevel(button) {
            let skillId = $(button).data('skill-id');
            let selectedLevel = $('#techskillmodal .modal-body input:checked').val();

            if (!technicalSkillsData[skillId]) return;

            // Preserve all the existing skill data and just update the preferred_level
            const existingSkillData = { ...technicalSkillsData[skillId] };
            existingSkillData.preferred_level = parseInt(selectedLevel);

            // Important: Keep the existing is_new status
            technicalSkillsData[skillId] = existingSkillData;

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

            // Preserve any existing classes that mark skill state (new, changed, etc.)
            const row = document.getElementById(`skill-${skillId}`);
            const wasNew = row?.classList.contains('skill-new');
            const wasChanged = row?.classList.contains('skill-changed');

            // Update Level Button Label
            $(`#selectTechLevelButton${skillId}`).text(`Level ${selectedLevel}`);

            // Restore any state marking classes that were present
            if (wasNew) row?.classList.add('skill-new');
            if (wasChanged) row?.classList.add('skill-changed');

            // (Optional) If you're storing the full data as JSON
            $('#technicalSkillsJson').val(JSON.stringify(technicalSkillsData));
        }
    </script>

    <script>
        // ✅ Global delegated event handler for remove-skill buttons
        // This must be set up on page load to handle all .remove-skill clicks
        $(document).ready(function() {
            // Use namespaced event to prevent duplicate bindings
            $(document).off('click.removeSkillHandler', '.remove-skill').on('click.removeSkillHandler', '.remove-skill', function () {
                const skillElement = $(this).closest('.technical-skill');
                const skillIndex = skillElement.attr('id')?.replace('skill-', '');
                
                // Check if we have minimum required technical skills (at least 1)
                const remainingSkills = document.querySelectorAll('.technical-skill:not(.removed-skill)').length;
                if (remainingSkills <= 1) {
                    alert('At least one technical skill is required. You cannot remove all technical skills.');
                    return;
                }
                
                console.log('Global remove handler - removing skill:', skillIndex);
                
                // Show loading overlay while modal is prepared
                try { if (typeof showOverlay === 'function') showOverlay(); } catch (e) {}
                
                // Show confirmation modal
                ModalManager.open({
                    module: 'jobs',
                    key: 'delete_technical_skill',
                    data: {},
                    onSubmit(modalEl) {
                        // User confirmed removal - proceed with the removal
                        console.log("Skill removal confirmed for index:", skillIndex);
                        
                        // Safely destroy Select2 instance before removing the element
                        const selectElement = skillElement.find('.select-skill');
                        if (typeof safelyDestroySelect2 === 'function') {
                            safelyDestroySelect2(selectElement);
                        }
                        
                        // Store deleted skill if needed
                        if (skillIndex && technicalSkillsData[skillIndex]) {
                            if (typeof deletedSkills !== 'undefined') {
                                deletedSkills.push({
                                    skill_id: technicalSkillsData[skillIndex].skill_id,
                                    name: technicalSkillsData[skillIndex].name,
                                });
                            }
                            delete technicalSkillsData[skillIndex];
                        }
                        
                        // Remove the DOM element
                        skillElement.remove();
                        
                        // Update remove button states
                        if (typeof toggleRemoveSkillButtons === 'function') {
                            toggleRemoveSkillButtons();
                        }
                        
                        console.log("After global removal - skill removed:", skillIndex);
                        
                        // Refresh comparison if active
                        if (typeof comparisonActive !== 'undefined' && comparisonActive) {
                            const ajaxResponse = @json($cachedData);
                            let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                                .masterTechnicalSkills.length > 0 ?
                                ajaxResponse.masterTechnicalSkills :
                                (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : []);
                            const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : [];
                            const currentFormSkills = getCurrentFormSkills();

                            const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                            
                            // Handle validation errors
                            if (comparison.status === 'validation_error') {
                                console.warn('Validation Error:', comparison.message);
                            } else {
                                renderComparison(comparison.comparisonResults);
                                showComparisonSummary(comparison.comparisonResults);
                            }
                        }
                        
                        // Close the modal and hide loading overlay
                        const bsModal = bootstrap.Modal.getInstance(modalEl);
                        if (bsModal) bsModal.hide();
                        try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
                    },
                    onShown(modalEl) {
                        // Hide loading overlay when modal is shown
                        try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
                    },
                    onError() {
                        // Hide loading overlay on error
                        try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
                    }
                });
            });
        });
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
    {{-- <script>
        $(document).ready(function() {
            $('#riasec').select2({
                closeOnSelect: false
            });

            $('#generate-riasec').on('click', function() {
                // Example response, replace this with your actual AJAX call
                const jobRole = $('#job_role').val().trim();

                // Check if job role is empty
                if (!jobRole) {
                    alert('Please enter a job role.');
                    return;
                }



                // Perform the AJAX call
                $.ajax({
                    url: '{{ route('jobs.generateRiasecCode') }}', // Replace with your actual endpoint
                    type: 'GET',
                    data: {
                        job_role: jobRole
                    },
                    success: function(response) {
                        // Example response: 'RIA'
                        // Clear existing selections
                        $('#riasec').val([]).trigger('change');

                        // Convert the response string to an array of single characters
                        const riasecArray = response.riasec_codes[0].split('');

                        // Select the options that match the response
                        riasecArray.forEach(function(code) {
                            $('#riasec option').each(function() {
                                if ($(this).val() === code) {
                                    $(this).prop('selected', true).trigger(
                                        'change');
                                }
                            });
                        });
                    },
                    error: function() {
                        alert('Failed to retrieve RIASEC codes.');
                    }
                });
            });

            $('#riasec').on('change', function() {
                if ($(this).val().length > 3) {
                    alert('You can only select a maximum of 3 options.');
                    // Deselect the last selected option
                    let selectedValues = $(this).val();
                    selectedValues.pop(); // Remove the last selected value
                    $(this).val(selectedValues).trigger('change'); // Update select2 with new values
                }
            });
        });
    </script> --}}

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
            if (ajaxResponse) {
                console.log('Full AJAX Response:', ajaxResponse);
                console.log('Full AJAX Response data description:', ajaxResponse.description);

                populateForm(ajaxResponse);
                // Use the response as needed
                // document.querySelector('textarea[name="job_description"]').value = ajaxResponse.description || '';
                // You can also populate other fields from the response
                // Example:
                // document.querySelector('.some-other-field').innerText = ajaxResponse.data.someKey || '';
            } else {
                console.warn('No AJAX response found in session storage.');
            }




            // Add event listener for adding new critical work functions
            const addFunctionBtn = document.getElementById('add_new_function');
            if (addFunctionBtn) {
                addFunctionBtn.addEventListener('click', function() {
                    const newIndex = document.querySelectorAll(
                        '.critical-functions-container .critical-function').length;
                    addNewCriticalFunction(newIndex);
                });
            }

            // Event listener for adding new technical skills
            // document.getElementById('add_new_skill').addEventListener('click', function() {
            //     const newIndex = document.querySelectorAll('#skills-container .technical-skill').length;
            //     console.log('newIndex', newIndex);
            //     addTechnicalSkill(newIndex);
            // });

            $('#add_new_skill').click(function() {
                debugSkillState();
                
                // Use the utility function to get next available index
                var newIndex = getNextSkillIndex('.technical-skill');
                console.log('Adding new technical skill with index:', newIndex);
                
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
                // Use the utility function to get next available index
                var newIndex = getNextSkillIndex('.generic-skill');
                
                addNewGenericSkill(newIndex);
            });
        });

        function populateForm(data) {
            // console.log('populateForm data:', data);

            // Populate Sector, Track, Role
            // console.log('populate form',data.sub_sector_name);
            // document.getElementById('sector').value = data.job_sector || '';
            // document.getElementById('sector_form').value = data.job_sector || '';
            // document.getElementById('job_role').value = data.job_role || '';
            // document.getElementById('job_role_form').value = data.job_role || '';
            
            const riasecEl = document.getElementById('riasec');
            if (riasecEl) riasecEl.value = data.top3riasec || '';
            
            const jdTitleEl = document.getElementById('jd_title');
            if (jdTitleEl) jdTitleEl.textContent = data.title || '';
            
            const baseJDEl = document.getElementById('baseJD');
            if (baseJDEl) baseJDEl.textContent = data.description || '';
            
            const jdJobProfileEl = document.getElementById('jd_job_profile');
            if (jdJobProfileEl) jdJobProfileEl.textContent = data.job_role_name || '';
            
            const additionalDetailEl = document.getElementById('additionalDetail');
            if (additionalDetailEl) additionalDetailEl.value = data.job_profile_description || '';
            
            const jdJobProfileStepEl = document.getElementById('jd_job_profile_step');
            if (jdJobProfileStepEl) jdJobProfileStepEl.textContent = data.job_role_name || '';
            document.getElementById('jd_workday').textContent = data.job_profile_description || '';
            document.getElementById('currentJDText').textContent = data.description || '';
            // document.getElementById('jd_workday').textContent = document.getElementById('additionalDetail').value;


            // Job Role Description
            document.querySelector('textarea[name="description"]').value = data.description || data
                .job_profile_description || '';

            // Populate Critical Work Functions
            const criticalFunctionsContainer = document.querySelector('.critical-functions-container');
            criticalFunctionsContainer.innerHTML = '';
            data?.critical_functions?.forEach((cwf, index) => {
                addCriticalFunction(index, cwf);
            });

            // Populate Technical Skills
            const skillsContainer = document.getElementById('skills-container');
            skillsContainer.innerHTML = '';
            data?.technical_skills?.forEach((skill, index) => {
                console.log('addTechnicalSkill', skill);
                addTechnicalSkill(index, skill);
            });

            // Populate Generic Skills
            const genericSkillsContainer = document.getElementById('generic-skills-container');
            genericSkillsContainer.innerHTML = '';
            data?.soft_skills?.forEach((skill, index) => {
                console.log('addGenericSkill', skill);
                addGenericSkill(index, skill);
            });
        }

        // function addCriticalFunction(index, cwf = null) {
        //     const functionHtml = `
    //     <div class="critical-function row mb-3">
    //         <div class="col-lg-12">
    //             <div class="d-flex gap-5 mb-3">
    //                 <button type="button" class="remove-function btn btn-outline btn-outline-primary d-flex justify-content-center" title="Remove function"><iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon></button>
    //                 <input type="text" class="form-control input-style" name="functions[${index}][title]" placeholder="Critical Work Function" value="${cwf?.cwf_description || ''}" required>
    //             </div>
    //             <select class="form-control input-style select2 mb-3 col-lg-11" style="float:right" name="functions[${index}][tasks][]" multiple>
    //                 ${cwf?.cwf_keys?.keytasks
    //                     ?.map((task) => `<option value="${task}" selected>${task}</option>`)
    //                     .join('') || ''}
    //             </select>
    //         </div>
    //     </div>`;

        //     const container = document.querySelector('.critical-functions-container');
        //     container.insertAdjacentHTML('beforeend', functionHtml);

        //     // Initialize the new select with Select2
        //     $(`select[name="functions[${index}][tasks][]"]`).select2({
        //         tags: true,
        //         placeholder: 'Add tasks',
        //         createTag: function(params) {
        //             return {
        //                 id: params.term,
        //                 text: params.term,
        //                 newOption: true
        //             };
        //         },
        //     });

        //     // Add event listener to remove the function
        //     container
        //         .querySelector(`.critical-function:nth-child(${index + 1}) .remove-function`)
        //         .addEventListener('click', function() {
        //             this.closest('.critical-function').remove();
        //         });
        // }

        //         function addCriticalFunction(index, cwf = null) {
        //     const functionHtml = `
    //     <div class="critical-function row mb-3">
    //         <div class="col-lg-12">
    //             <div class="d-flex gap-5 mb-3">
    //                 <button type="button" class="remove-function btn btn-outline btn-outline-primary d-flex justify-content-center" title="Remove function"><iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon></button>
    //                 <input type="text" class="form-control input-style" name="functions[${index}][title]" placeholder="Critical Work Function" value="${cwf?.description || ''}" required>
    //             </div>
    //             <select class="form-control input-style select2 mb-3 col-lg-11" style="float:right" name="functions[${index}][tasks][]" multiple>
    //                 ${cwf?.cwf_keys
    //                     ?.map((task) => `<option value="${task.name}" selected>${task.name}</option>`)
    //                     .join('') || ''}
    //             </select>
    //         </div>
    //     </div>`;

        //     const container = document.querySelector('.critical-functions-container');
        //     container.insertAdjacentHTML('beforeend', functionHtml);

        //     // Initialize the new select with Select2
        //     $(`select[name="functions[${index}][tasks][]"]`).select2({
        //         tags: true,
        //         placeholder: 'Add tasks',
        //         createTag: function(params) {
        //             return {
        //                 id: params.term,
        //                 text: params.term,
        //                 newOption: true
        //             };
        //         },
        //     });

        //     // Add event listener to remove the function
        //     container
        //         .querySelector(`.critical-function:nth-child(${index + 1}) .remove-function`)
        //         .addEventListener('click', function() {
        //             this.closest('.critical-function').remove();
        //         });
        // }

        // function addTechnicalSkill(index, skill = null) {

        //     const skillData = JSON.stringify(skill); // Convert the skill object to a JSON string
        //     technicalSkillsData[index] = skill;
        //     console.log('technicalSkillsData', technicalSkillsData);

        //     const escapedSkillData = escapeSpecialCharacters(skillData); // Escape the JSON string
        //     console.log('escapedSkillData', escapedSkillData)
        //     console.log('UnescapedSkillData', skill)

        //     const skillHtml = `
    //     <div class="technical-skill row mb-8">
    //         <div class="fv-row mb-2 fv-plugins-icon-container col-lg-9 d-flex gap-7">
    //             <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
    //                 <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
    //             </button>

    //             <input type="text" class="form-control input-style " id="technicalSkills[${index}]" name="technicalSkills[${index}][id]" placeholder="Technical Skill" value="${skill?.name || ''}" required readonly>
    //         </div>
    //         <div class="fv-row mb-2 fv-plugins-icon-container d-flex col-lg-3 btn-vl-container justify-content-end">

    //             <select id="level[${index}]" name="technicalSkills[${index}][level]" class="form-select col-lg-7 col-md-10 btn-level mb-3 mb-lg-0 rounded-right">
    //                 ${Array.from({ length: 6 }, (_, i) => 6 - i) 
    //                     .map(level => {
    //                         const descriptionKey = `level_${level}_description`;
    //                         const levelDescription = skill[descriptionKey] || null;

    //                         if (levelDescription) {
    //                             return `<option value="${level}" 
        //                                             ${(skill?.preferred_level) == level ? 'selected' : ''} 
        //                                             class="dark:bg-slate-700">
        //                                         Level ${level}
        //                                     </option>`;
    //                         }
    //                         return ''; // Skip if no description
    //                     })
    //                     .join('')}
    //             </select>
    //         <button 
    //                 type="button" 
    //                 id="selectTechLevelButton${index}" 
    //                 class="btn-view" 
    //                 data-bs-toggle="modal" 
    //                 data-bs-target="#techskillmodal" 
    //                 onclick="technicalpopulateModal(${index})">
    //                 View Level
    //                 <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
    //             </button>
    //         </div>
    //         <div class="col-md-12 d-flex justify-content-end">

    //             <input type="text" class="form-control col-lg-11" placeholder="Enter skill description" name="technicalSkills[${index}][description]" value="${skill?.description || ''}" readonly>
    //         </div>
    //     </div>`;

        //     const container = document.getElementById('skills-container');
        //     container.insertAdjacentHTML('beforeend', skillHtml);

        //     // Add event listener to remove the skill
        //     container
        //         .querySelector(`.technical-skill:nth-child(${index + 1}) .remove-skill`)
        //         .addEventListener('click', function() {
        //             this.closest('.technical-skill').remove();
        //         });

        //     // Add event listener to remove the description
        //     // container
        //     //     .querySelector(`.technical-skill:nth-child(${index + 1}) .remove-description`)
        //     //     .addEventListener('click', function() {
        //     //         this.closest('.technical-skill').remove();
        //     //     });

        //     // Initialize Select2 for skill dropdown
        //     $(`#skill[${index}]`).select2({
        //         placeholder: 'Search for a skill',
        //     });
        // }

        // function addTechnicalSkill(index, skill = null) {
        //     if (!skill) return;

        //     // Store the complete skill object with all necessary fields
        //     const skillData = {
        //         c_id: skill?.c_id || null,
        //         code: skill?.code || null,
        //         sector_id: skill?.sector_id || null,
        //         sector_name: skill?.sector_name || '',
        //         sub_sector_id: skill?.sub_sector_id || null,
        //         sub_sector_name: skill?.sub_sector_name || '',
        //         name: skill?.name || '',
        //         description: skill?.description || '',
        //         preferred_level: skill?.preferred_level || '',
        //     };

        //     // Loop through levels (1 to 6) and add description, knowledge, and ability if they exist
        //     for (let level = 1; level <= 6; level++) {
        //         if (skill[`level_${level}_description`]) {
        //             skillData[`level_${level}_description`] = skill[`level_${level}_description`];
        //             skillData[`level_${level}_knowledge`] = skill[`level_${level}_knowledge`] || [];
        //             skillData[`level_${level}_ability`] = skill[`level_${level}_ability`] || [];
        //         }
        //     }

        //     // Store the full skill data into the array
        //     technicalSkillsData[index] = skillData;
        //     console.log('Updated technicalSkillsData:', technicalSkillsData);

        //     // Convert to JSON format matching test.txt
        //     const formattedJson = JSON.stringify({ technical_skills: Object.values(technicalSkillsData) }, null, 4);
        //     console.log('Formatted JSON Output:', formattedJson);

        //     // Generate HTML UI (if needed)
        //     const skillHtml = `
    //         <div class="technical-skill row mb-8">
    //             <div class="fv-row mb-2 fv-plugins-icon-container col-lg-9 d-flex gap-7">
    //                 <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
    //                     <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
    //                 </button>
    //                 <input type="text" class="form-control input-style" id="technicalSkills[${index}]" 
    //                     name="technicalSkills[${index}][name]" placeholder="Technical Skill" 
    //                     value="${skill?.name || ''}" required readonly>
    //             </div>
    //             <div class="fv-row mb-2 fv-plugins-icon-container d-flex col-lg-3 btn-vl-container justify-content-end">
    //                 <select id="level[${index}]" name="technicalSkills[${index}][preferred_level]" class="form-select">
    //                     ${Array.from({ length: 6 }, (_, i) => 6 - i)
    //                         .map(level => `<option value="${level}" ${skill?.preferred_level == level ? 'selected' : ''}>Level ${level}</option>`)
    //                         .join('')}
    //                 </select>
    //                 <button type="button" id="selectTechLevelButton${index}" class="btn-view" 
    //                     data-bs-toggle="modal" data-bs-target="#techskillmodal" 
    //                     onclick="technicalpopulateModal(${index})">
    //                     View Level
    //                     <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
    //                 </button>
    //             </div>
    //             <div class="col-md-12 d-flex justify-content-end">
    //                 <input type="text" class="form-control col-lg-11" 
    //                     placeholder="Enter skill description" 
    //                     name="technicalSkills[${index}][description]" 
    //                     value="${skill?.description || ''}" readonly>
    //             </div>
    //         </div>`;

        //     const container = document.getElementById('skills-container');
        //     container.insertAdjacentHTML('beforeend', skillHtml);

        //     // Remove skill event listener
        //     container.querySelector(`.technical-skill:nth-child(${index + 1}) .remove-skill`)
        //         .addEventListener('click', function() {
        //             this.closest('.technical-skill').remove();
        //         });

        //     // Initialize Select2
        //     $(`#skill[${index}]`).select2({
        //         placeholder: 'Search for a skill',
        //     });
        // }

        // function addTechnicalSkill(index, skill = null) {
        //     if (!skill) return;

        //     // Store the complete skill object with all necessary fields
        //     const skillData = {
        //         c_id: skill?.c_id || null,
        //         code: skill?.code || null,
        //         sector_id: skill?.sector_id || null,
        //         sector_name: skill?.sector_name || '',
        //         sub_sector_id: skill?.sub_sector_id || null,
        //         sub_sector_name: skill?.sub_sector_name || '',
        //         name: skill?.name || '',
        //         description: skill?.description || '',
        //         preferred_level: skill?.level || '',
        //     };

        //     // Loop through levels (1 to 6) and add description, knowledge, and ability if they exist
        //     for (let level = 1; level <= 6; level++) {
        //         if (skill[`level_${level}_description`]) {
        //             skillData[`level_${level}_description`] = skill[`level_${level}_description`];
        //             skillData[`level_${level}_knowledge`] = skill[`level_${level}_knowledge`] || [];
        //             skillData[`level_${level}_ability`] = skill[`level_${level}_ability`] || [];
        //         }
        //     }

        //     // Store the full skill data into the array
        //     technicalSkillsData[index] = skillData;
        //     console.log('Updated technicalSkillsData:', technicalSkillsData);

        //     // Convert to JSON format matching test.txt
        //     const formattedJson = JSON.stringify({ technical_skills: Object.values(technicalSkillsData) }, null, 4);
        //     console.log('Formatted JSON Output:', formattedJson);

        //     // Generate hidden input fields
        //     let hiddenInputs = '';

        //     // Loop through all keys in skillData and create hidden inputs
        //     Object.keys(skillData).forEach((key) => {
        //         if (Array.isArray(skillData[key])) {
        //             // Handle array data (level_x_knowledge and level_x_ability)
        //             skillData[key].forEach((value, i) => {
        //                 hiddenInputs += `<input type="hidden" name="technicalSkills[${index}][${key}][${i}]" value="${value}">`;
        //             });
        //         } else {
        //             // Handle regular string/integer fields
        //             hiddenInputs += `<input type="hidden" name="technicalSkills[${index}][${key}]" value="${skillData[key]}">`;
        //         }
        //     });

        //     // Generate HTML UI
        //     const skillHtml = `
    //         <div class="technical-skill row mb-8" id="skill-${index}">
    //             ${hiddenInputs} <!-- Append all hidden inputs here -->
    //             <div class="fv-row mb-2 fv-plugins-icon-container col-lg-9 d-flex gap-7">
    //                 <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
    //                     <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
    //                 </button>
    //                 <input type="text" class="form-control input-style" id="technicalSkills[${index}]" 
    //                     name="technicalSkills[${index}][name]" placeholder="Technical Skill" 
    //                     value="${skill?.name || ''}" required readonly>
    //             </div>
    //             <div class="fv-row mb-2 fv-plugins-icon-container d-flex col-lg-3 btn-vl-container justify-content-end">
    //                 <select id="level[${index}]" name="technicalSkills[${index}][level]" class="form-select col-lg-7 col-md-10 btn-level mb-3 mb-lg-0 rounded-right">
    //                     ${Array.from({ length: 6 }, (_, i) => 6 - i) 
    //                         .map(level => {
    //                             const descriptionKey = `level_${level}_description`;
    //                             const levelDescription = skill[descriptionKey] || null;

    //                             if (levelDescription) {
    //                                 return `<option value="${level}" 
        //                                                 ${skill?.preferred_level == level ? 'selected' : ''} 
        //                                                 class="dark:bg-slate-700">
        //                                             Level ${level}
        //                                         </option>`;
    //                             }
    //                             return ''; // Skip levels without a description
    //                         })
    //                         .join('')}
    //                 </select>

    //                 <button type="button" id="selectTechLevelButton${index}" class="btn-view" 
    //                     data-bs-toggle="modal" data-bs-target="#techskillmodal" 
    //                     onclick="technicalpopulateModal(${index})">
    //                     View Level
    //                     <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
    //                 </button>
    //             </div>
    //             <div class="col-md-12 d-flex justify-content-end">
    //                 <input type="text" class="form-control col-lg-11" 
    //                     placeholder="Enter skill description" 
    //                     name="technicalSkills[${index}][description]" 
    //                     value="${skill?.description || ''}" readonly>
    //             </div>
    //         </div>`;
        //     const container = document.getElementById('skills-container');
        //     container.insertAdjacentHTML('beforeend', skillHtml);

        //     // Remove skill event listener
        //     container.querySelector(`#skill-${index} .remove-skill`)
        //         .addEventListener('click', function () {
        //             this.closest('.technical-skill').remove();
        //         });

        //     // Initialize Select2
        //     $(`#skill[${index}]`).select2({
        //         placeholder: 'Search for a skill',
        //     });
        // }

        //         function addTechnicalSkill(index, skill = null) {
        //     if (!skill) return;

        //     // Store the complete skill object with all necessary fields
        //     const skillData = {
        //         c_id: skill?.c_id || null,
        //         code: skill?.code || null,
        //         sector_id: skill?.sector_id || null,
        //         sector_name: skill?.sector_name || '',
        //         sub_sector_id: skill?.sub_sector_id || null,
        //         sub_sector_name: skill?.sub_sector_name || '',
        //         name: skill?.name || '',
        //         description: skill?.description || '',
        //         preferred_level: skill?.level || '',
        //     };

        //     // Loop through levels (1 to 6) and add description, knowledge, and ability if they exist
        //     for (let level = 1; level <= 6; level++) {
        //         if (skill[`level_${level}_description`]) {
        //             skillData[`level_${level}_description`] = skill[`level_${level}_description`];
        //             skillData[`level_${level}_knowledge`] = skill[`level_${level}_knowledge`] ? skill[`level_${level}_knowledge`].split(';') : []; // Split into array
        //             skillData[`level_${level}_ability`] = skill[`level_${level}_ability`] ? skill[`level_${level}_ability`].split(';') : []; // Split into array
        //         }
        //     }

        //     // Store the full skill data into the array
        //     technicalSkillsData[index] = skillData;
        //     console.log('Updated technicalSkillsData:', technicalSkillsData);

        //     // Convert to JSON format matching test.txt
        //     const formattedJson = JSON.stringify({ technical_skills: Object.values(technicalSkillsData) }, null, 4);
        //     console.log('Formatted JSON Output:', formattedJson);

        //     // Generate hidden input fields
        //     let hiddenInputs = '';

        //     // Loop through all keys in skillData and create hidden inputs
        //     Object.keys(skillData).forEach((key) => {
        //         if (Array.isArray(skillData[key])) {
        //             // Handle array data (level_x_knowledge and level_x_ability)
        //             skillData[key].forEach((value, i) => {
        //                 hiddenInputs += `<input type="hidden" name="technicalSkills[${index}][${key}][${i}]" value="${value}">`;
        //             });
        //         } else {
        //             // Handle regular string/integer fields
        //             hiddenInputs += `<input type="hidden" name="technicalSkills[${index}][${key}]" value="${skillData[key]}">`;
        //         }
        //     });

        //     // Generate HTML UI
        //     const skillHtml = `
    //         <div class="technical-skill row mb-8" id="skill-${index}">
    //             ${hiddenInputs} <!-- Append all hidden inputs here -->
    //             <div class="fv-row mb-2 fv-plugins-icon-container col-lg-9 d-flex gap-7">
    //                 <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
    //                     <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
    //                 </button>
    //                 <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center edit-skill" data-index="${index}">
    //                     <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
    //                 </button>
    //                 <input type="text" class="form-control input-style" id="technicalSkills[${index}]" 
    //                     name="technicalSkills[${index}][name]" placeholder="Technical Skill" 
    //                     value="${skill?.name || ''}" required readonly>
    //             </div>
    //             <div class="fv-row mb-2 fv-plugins-icon-container d-flex col-lg-3 btn-vl-container justify-content-end">
    //                 <select id="level[${index}]" name="technicalSkills[${index}][level]" class="form-select col-lg-7 col-md-10 btn-level mb-3 mb-lg-0 rounded-right">
    //                     ${Array.from({ length: 6 }, (_, i) => 6 - i) 
    //                         .map(level => {
    //                             const descriptionKey = `level_${level}_description`;
    //                             const levelDescription = skill[descriptionKey] || null;

    //                             if (levelDescription) {
    //                                 return `<option value="${level}" 
        //                                                 ${skill?.preferred_level == level ? 'selected' : ''} 
        //                                                 class="dark:bg-slate-700">
        //                                             Level ${level}
        //                                         </option>`;
    //                             }
    //                             return ''; // Skip levels without a description
    //                         })
    //                         .join('')}
    //                 </select>

    //                 <button type="button" id="selectTechLevelButton${index}" class="btn-view" 
    //                     data-bs-toggle="modal" data-bs-target="#techskillmodal" 
    //                     onclick="technicalpopulateModal(${index})">
    //                     View Level
    //                     <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
    //                 </button>
    //             </div>
    //         </div>`;
        //     const container = document.getElementById('skills-container');
        //     container.insertAdjacentHTML('beforeend', skillHtml);

        //     // Remove skill event listener
        //     container.querySelector(`#skill-${index} .remove-skill`)
        //         .addEventListener('click', function () {
        //             this.closest('.technical-skill').remove();
        //         });

        //     // Initialize Select2
        //     $(`#skill[${index}]`).select2({
        //         placeholder: 'Search for a skill',
        //     });
        // }
        // function addTechnicalSkill(index, skill = null) {
        //     if (!skill) return;

        //     const skillData = {
        //         c_id: skill?.c_id || null,
        //         skill_id: skill?.id || null,
        //         code: skill?.code || null,
        //         sector_id: skill?.sector_id || null,
        //         sector_name: skill?.sector_name || '',
        //         sub_sector_id: skill?.sub_sector_id || null,
        //         sub_sector_name: skill?.sub_sector_name || '',
        //         name: skill?.name || '',
        //         description: skill?.description || '',
        //         preferred_level: skill?.level || '',
        //         is_custom: skill?.is_custom ?? '',
        //     };

        //     for (let level = 1; level <= 6; level++) {
        //         if (skill[`level_${level}_description`]) {
        //             skillData[`level_${level}_description`] = skill[`level_${level}_description`];
        //             skillData[`level_${level}_knowledge`] = skill[`level_${level}_knowledge`] ? skill[`level_${level}_knowledge`].split(';') : [];
        //             skillData[`level_${level}_ability`] = skill[`level_${level}_ability`] ? skill[`level_${level}_ability`].split(';') : [];
        //         }
        //     }

        //     technicalSkillsData[index] = skillData;
        //     console.log('Updated technicalSkillsData:', technicalSkillsData);

        //     const formattedJson = JSON.stringify({ technical_skills: Object.values(technicalSkillsData) }, null, 4);
        //     console.log('Formatted JSON Output:', formattedJson);

        //     let hiddenInputs = '';
        //     Object.keys(skillData).forEach((key) => {
        //         if (Array.isArray(skillData[key])) {
        //             (skillData[key] || []).forEach((value, i) => {
        //                 hiddenInputs += `<input type="hidden" name="technicalSkills[${index}][${key}][${i}]" value="${value}">`;
        //             });
        //         } else {
        //             hiddenInputs += `<input type="hidden" name="technicalSkills[${index}][${key}]" value="${skillData[key]}">`;
        //         }
        //     });

        //     const skillHtml = `
    //         <div class="technical-skill row mb-8" id="skill-${index}">
    //             ${hiddenInputs}
    //             <div class="fv-row mb-2 fv-plugins-icon-container col-lg-9 d-flex gap-7">
    //                 <!-- Delete button -->
    //                 <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
    //                     <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
    //                 </button>

    //                 <!-- Edit button -->
    //                 <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center edit-skill" data-index="${index}">
    //                     <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
    //                 </button>

    //                 <input type="text" class="form-control input-style" id="technicalSkills[${index}]" 
    //                     name="technicalSkills[${index}][name]" placeholder="Technical Skill" 
    //                     value="${skill?.name || ''}" required readonly>
    //             </div>
    //             <div class="fv-row mb-2 fv-plugins-icon-container d-flex col-lg-3 btn-vl-container justify-content-end">
    //                 <select id="level[${index}]" name="technicalSkills[${index}][level]" class="form-select col-lg-7 col-md-10 btn-level mb-3 mb-lg-0 rounded-right">
    //                     ${Array.from({ length: 6 }, (_, i) => 6 - i)
    //                         .map(level => {
    //                             const descriptionKey = `level_${level}_description`;
    //                             const levelDescription = skill[descriptionKey] || null;
    //                             if (levelDescription) {
    //                                 return `<option value="${level}" 
        //                                                 ${skill?.preferred_level == level ? 'selected' : ''} 
        //                                                 class="dark:bg-slate-700">
        //                                             Level ${level}
        //                                         </option>`;
    //                             }
    //                             return '';
    //                         }).join('')}
    //                 </select>

    //                 <button type="button" id="selectTechLevelButton${index}" class="btn-view" 
    //                     data-bs-toggle="modal" data-bs-target="#techskillmodal" 
    //                     onclick="technicalpopulateModal(${index})">
    //                     View Level
    //                     <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
    //                 </button>
    //             </div>
    //         </div>`;

        //     const container = document.getElementById('skills-container');
        //     container.insertAdjacentHTML('beforeend', skillHtml);

        //     // Trash/delete skill
        //     container.querySelector(`#skill-${index} .remove-skill`)
        //         .addEventListener('click', function () {
        //             this.closest('.technical-skill').remove();
        //         });

        //     // Edit skill - show confirmation modal
        //     // container.querySelector(`#skill-${index} .edit-skill`)
        //     //     .addEventListener('click', function () {
        //     //         const skillIndex = this.getAttribute('data-index');
        //     //         document.getElementById('EditTsfromMSL').setAttribute('data-skill-index', skillIndex);

        //     //         const editModal = new bootstrap.Modal(document.getElementById('EditTsfromMSL'));
        //     //         editModal.show();
        //     //     });

        //     container.querySelector(`#skill-${index} .edit-skill`)
        //     .addEventListener('click', function () {
        //         const skillIndex = this.getAttribute('data-index');
        //         const skillData = technicalSkillsData[skillIndex];

        //         if (skillData.is_custom == 2) {
        //             // Open custom skill modal
        //             const modalEl = document.getElementById('CompanyTechnicalSkill');
        //             modalEl.setAttribute('data-skill-index', skillIndex);
        //             modalEl.querySelector('#companySkillName').textContent = skillData.name || 'Skill';

        //             const companyModal = new bootstrap.Modal(modalEl);
        //             companyModal.show();
        //         } else {
        //             // Open standard edit modal
        //             const editModal = new bootstrap.Modal(document.getElementById('EditTsfromMSL'));
        //             document.getElementById('EditTsfromMSL').setAttribute('data-skill-index', skillIndex);
        //             editModal.show();
        //         }
        //     });


        //     // Initialize Select2 (optional, if you are using Select2 elsewhere)
        //     $(`#skill[${index}]`).select2({
        //         placeholder: 'Search for a skill',
        //     });
        // }

        // function addTechnicalSkill(index, skill = null) {
        //     if (!skill) return;

        //     const skillData = {
        //         c_id: skill?.c_id || null,
        //         skill_id: skill?.id || null,
        //         code: skill?.code || null,
        //         sector_id: skill?.sector_id || null,
        //         sector_name: skill?.sector_name || '',
        //         sub_sector_id: skill?.sub_sector_id || null,
        //         sub_sector_name: skill?.sub_sector_name || '',
        //         name: skill?.name || '',
        //         description: skill?.description || '',
        //         preferred_level: skill?.preferred_level || '',
        //         is_custom: skill?.is_custom ?? '',
        //         category_id: skill?.category_id ?? '',
        //         category_name: skill?.category_name ?? '',
        //     };

        //     // Dynamically find levels
        //     const levelsFound = [];
        //     Object.keys(skill).forEach(key => {
        //         const match = key.match(/^level_(\d+)_description$/);
        //         if (match) {
        //             const level = match[1];
        //             levelsFound.push(level);

        //             skillData[`level_${level}_description`] = skill[`level_${level}_description`];

        //             skillData[`level_${level}_knowledge`] = Array.isArray(skill[`level_${level}_knowledge`])
        //                 ? skill[`level_${level}_knowledge`]
        //                 : (skill[`level_${level}_knowledge`] || '').split(';');

        //             skillData[`level_${level}_ability`] = Array.isArray(skill[`level_${level}_ability`])
        //                 ? skill[`level_${level}_ability`]
        //                 : (skill[`level_${level}_ability`] || '').split(';');
        //         }
        //     });

        //     technicalSkillsData[index] = skillData;
        //     console.log('Updated technicalSkillsData:', technicalSkillsData);

        //     const formattedJson = JSON.stringify({ technical_skills: Object.values(technicalSkillsData) }, null, 4);
        //     console.log('Formatted JSON Output:', formattedJson);

        //     let hiddenInputs = '';
        //     Object.keys(skillData).forEach((key) => {
        //         if (Array.isArray(skillData[key])) {
        //             (skillData[key] || []).forEach((value, i) => {
        //                 hiddenInputs += `<input type="hidden" name="technicalSkills[${index}][${key}][${i}]" value="${value}">`;
        //             });
        //         } else {
        //             hiddenInputs += `<input type="hidden" name="technicalSkills[${index}][${key}]" value="${skillData[key]}">`;
        //         }
        //     });

        //     const levelOptions = levelsFound
        //         .sort((a, b) => b - a)
        //         .map(level => {
        //             const descriptionKey = `level_${level}_description`;
        //             const levelDescription = skill[descriptionKey] || null;
        //             if (levelDescription) {
        //                 return `<option value="${level}" 
    //                                 ${skill?.preferred_level == level ? 'selected' : ''} 
    //                                 class="dark:bg-slate-700">
    //                             Level ${level}
    //                         </option>`;
        //             }
        //             return '';
        //         }).join('');

        //     const skillHtml = `
    //         <div class="technical-skill row mb-8" id="skill-${index}">
    //             ${hiddenInputs}
    //             <div class="fv-row mb-2 fv-plugins-icon-container col-lg-10 d-flex gap-7">
    //                 <!-- Delete button -->
    //                 <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
    //                     <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
    //                 </button>

    //                 <!-- Edit button -->
    //                 <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center edit-skill" data-index="${index}">
    //                     <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
    //                 </button>

    //                 <select id="skill[${index}]" name="technicalSkills[${index}][id]" class="form-control select-skill" onchange="TechSkillChanged('${index}', this)">
    //                     <option selected value="${skill?.id}">${skill?.name}</option>
    //                 </select>
    //                 <input type="hidden" id="technicalSkillsHidden[${index}]" name="technicalSkills[${index}][name]" value="${skill?.name || ''}">

    //             </div>

    //                 <button type="button" id="selectTechLevelButton${index}" class="btn-view edit-level-btn" 
    //                     data-bs-toggle="modal" data-bs-target="#techskillmodal" 
    //                     onclick="technicalpopulateModal(${index})">
    //                     Level ${skill?.preferred_level || ''}
    //                 </button>

    //         </div>`;

        //     const container = document.getElementById('skills-container');
        //     container.insertAdjacentHTML('beforeend', skillHtml);

        //     // const skillSelect = $(`#skill\\[${index}\\]`);
        //     // initSelect2(skillSelect);

        //     // Trash/delete skill
        //     container.querySelector(`#skill-${index} .remove-skill`)
        //     .addEventListener('click', function () {
        //         console.log(technicalSkillsData);

        //         delete technicalSkillsData[index];
        //         console.log('After removal:', technicalSkillsData);

        //         this.closest('.technical-skill').remove();
        //         toggleRemoveSkillButtons(); // Call after removing
        //     });

        //     // Edit skill - custom vs standard
        //     container.querySelector(`#skill-${index} .edit-skill`)
        //         .addEventListener('click', function () {
        //             const skillIndex = this.getAttribute('data-index');
        //             const skillData = technicalSkillsData[skillIndex];

        //             if (skillData.is_custom == 2) {
        //                 const modalEl = document.getElementById('CompanyTechnicalSkill');
        //                 modalEl.setAttribute('data-skill-index', skillIndex);
        //                 modalEl.querySelector('#companySkillName').textContent = skillData.name || 'Skill';
        //                 const companyModal = new bootstrap.Modal(modalEl);
        //                 companyModal.show();
        //             } else {
        //                 const editModal = new bootstrap.Modal(document.getElementById('EditTsfromMSL'));
        //                 document.getElementById('EditTsfromMSL').setAttribute('data-skill-index', skillIndex);
        //                 editModal.show();
        //             }
        //         });

        //     // Initialize Select2 (if used)
        //     $(`#skill[${index}]`).select2({
        //         placeholder: 'Search for a skill',
        //     });

        //     toggleRemoveSkillButtons();
        // }

        // function addTechnicalSkill(index, skill = null, allSkills = []) {
        //     if (!skill) return;

        //     const skillData = {
        //         c_id: skill?.c_id || null,
        //         skill_id: skill?.id || null,
        //         code: skill?.code || null,
        //         sector_id: skill?.sector_id || null,
        //         sector_name: skill?.sector_name || '',
        //         sub_sector_id: skill?.sub_sector_id || null,
        //         sub_sector_name: skill?.sub_sector_name || '',
        //         name: skill?.name || '',
        //         description: skill?.description || '',
        //         preferred_level: skill?.preferred_level || '',
        //         is_custom: skill?.is_custom ?? '',
        //         category_id: skill?.category_id ?? '',
        //         category_name: skill?.category_name ?? '',
        //     };

        //     // Dynamically find levels
        //     const levelsFound = [];
        //     Object.keys(skill).forEach(key => {
        //         const match = key.match(/^level_(\d+)_description$/);
        //         if (match) {
        //             const level = match[1];
        //             levelsFound.push(level);

        //             skillData[`level_${level}_description`] = skill[`level_${level}_description`];
        //             skillData[`level_${level}_knowledge`] = Array.isArray(skill[`level_${level}_knowledge`])
        //                 ? skill[`level_${level}_knowledge`]
        //                 : (skill[`level_${level}_knowledge`] || '').split(';');
        //             skillData[`level_${level}_ability`] = Array.isArray(skill[`level_${level}_ability`])
        //                 ? skill[`level_${level}_ability`]
        //                 : (skill[`level_${level}_ability`] || '').split(';');
        //         }
        //     });

        //     technicalSkillsData[index] = skillData;

        //     let hiddenInputs = '';
        //     Object.keys(skillData).forEach((key) => {
        //         if (Array.isArray(skillData[key])) {
        //             (skillData[key] || []).forEach((value, i) => {
        //                 hiddenInputs += `<input type="hidden" name="technicalSkills[${index}][${key}][${i}]" value="${value}">`;
        //             });
        //         } else {
        //             hiddenInputs += `<input type="hidden" name="technicalSkills[${index}][${key}]" value="${skillData[key]}">`;
        //         }
        //     });

        //     const skillHtml = `
    //         <div class="technical-skill row mb-8" id="skill-${index}">
    //             ${hiddenInputs}
    //             <div class="fv-row mb-2 fv-plugins-icon-container col-lg-10 d-flex gap-7 align-items-center">
    //                 <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
    //                     <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
    //                 </button>

    //                 <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center edit-skill" data-index="${index}">
    //                     <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
    //                 </button>

    //                 <select id="skill[${index}]" name="technicalSkills[${index}][id]" class="form-control select-skill select2-skill" data-index="${index}">
    //                     <option value="${skill?.id}" selected>${skill?.name}</option>
    //                 </select>

    //                 <input type="hidden" id="technicalSkillsHidden[${index}]" name="technicalSkills[${index}][name]" value="${skill?.name || ''}">
    //             </div>

    //             <div class="col-lg-2">
    //                 <button type="button" id="selectTechLevelButton${index}" class="btn-view edit-level-btn w-100"
    //                     data-bs-toggle="modal" data-bs-target="#techskillmodal"
    //                     onclick="technicalpopulateModal(${index})">
    //                     Level ${skill?.preferred_level || ''}
    //                 </button>
    //             </div>
    //         </div>`;

        //     const container = document.getElementById('skills-container');
        //     container.insertAdjacentHTML('beforeend', skillHtml);

        //     // Populate select with all skills (if provided)
        //     const selectEl = $(`#skill\\[${index}\\]`);
        //     if (allSkills.length > 0) {
        //         selectEl.empty(); // Clear existing
        //         allSkills.forEach(s => {
        //             selectEl.append(new Option(s.name, s.id, s.id === skill.id, s.id === skill.id));
        //         });
        //     }

        //     initSelect2(selectEl);

        //     // Init Select2
        //     selectEl.select2({
        //         placeholder: 'Search for a skill',
        //         width: 'resolve'
        //     });

        //     // On change, update hidden input and fetch levels
        //     selectEl.on('change', function () {
        //         const selectedId = $(this).val();
        //         const selectedText = $(this).find('option:selected').text();

        //         $(`#technicalSkillsHidden\\[${index}\\]`).val(selectedText);

        //         // Optional: fetch updated skill info
        //         // TechSkillChanged(index, this);
        //     });

        //     // Remove button handler
        //     container.querySelector(`#skill-${index} .remove-skill`)
        //         .addEventListener('click', function () {
        //             delete technicalSkillsData[index];
        //             this.closest('.technical-skill').remove();
        //             toggleRemoveSkillButtons();
        //         });

        //     // Edit button handler
        //     container.querySelector(`#skill-${index} .edit-skill`)
        //         .addEventListener('click', function () {
        //             const skillIndex = this.getAttribute('data-index');
        //             const skillData = technicalSkillsData[skillIndex];

        //             if (skillData.is_custom == 2) {
        //                 const modalEl = document.getElementById('CompanyTechnicalSkill');
        //                 modalEl.setAttribute('data-skill-index', skillIndex);
        //                 modalEl.querySelector('#companySkillName').textContent = skillData.name || 'Skill';
        //                 const companyModal = new bootstrap.Modal(modalEl);
        //                 companyModal.show();
        //             } else {
        //                 const editModal = new bootstrap.Modal(document.getElementById('EditTsfromMSL'));
        //                 document.getElementById('EditTsfromMSL').setAttribute('data-skill-index', skillIndex);
        //                 editModal.show();
        //             }
        //         });

        //     toggleRemoveSkillButtons();
        // }

        // function cleanLabel(text) {
        // return String(text || '').replace(/\s*\(.*?\)\s*$/, '').trim();
        // }

        // function cleanLabel(text) {
        //     let str = String(text || '').trim();

        //     return str.replace(/\s*\(([^)]*)\)\s*$/, (match, inner) => {
        //         if (inner.includes('-')) {
        //             return '';
        //         }
        //         return ` (${inner})`;
        //     }).trim();
        // }

        function cleanLabel(text) {
            let str = String(text || '');
            let pattern = /\([^()]*-.*?\)/g;

            // Keep removing innermost (...) containing '-' until none remain
            while (pattern.test(str)) {
                str = str.replace(pattern, '');
            }

            return str.trim();
        }



        let deletedSkills = [];

        function initializeTooltips() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(function(el) {
                // Use data-bs-title instead of title
                let title = el.getAttribute('data-bs-title') || el.getAttribute('title');
                // Always set a string value for data-bs-title
                if (title === null || typeof title !== 'string' || title.trim() === '' || title.trim() === 'null') {
                    el.setAttribute('data-bs-title', 'Not Available');
                }
                // Remove any native title attribute to avoid conflicts
                if (el.hasAttribute('title')) {
                    el.removeAttribute('title');
                }
                if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                    new bootstrap.Tooltip(el, {
                        delay: {
                            show: 0,
                            hide: 100
                        }
                    });
                }
            });
        }

        // Hide all tooltips safely. Used when interacting with Select2 inputs so tooltips
        // don't remain visible (stuck) after click/focus events.
        function hideAllTooltips() {
            try {
                // Prefer jQuery plugin hide if available
                if (typeof jQuery !== 'undefined' && typeof jQuery.fn.tooltip === 'function') {
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                } else if (window.bootstrap && bootstrap.Tooltip) {
                    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
                        try {
                            const inst = bootstrap.Tooltip.getInstance(el);
                            if (inst && typeof inst.hide === 'function') inst.hide();
                        } catch (e) { /* ignore per-element errors */ }
                    });
                }
            } catch (e) {
                console.warn('hideAllTooltips failed', e);
            }

            // Also remove any orphaned tooltip DOM nodes which sometimes linger
            try {
                document.querySelectorAll('.tooltip').forEach(function (t) { t.remove(); });
            } catch (e) { /* no-op */ }
        }

        // When interacting with Select2 fields, hide any visible tooltips to avoid
        // them getting stuck on screen after click/focus.
        $(document).on('select2:opening select2:open select2:select', function () { hideAllTooltips(); });
        $(document).on('focusin click', '.select2-search__field, .select2-selection, .select2-container', function () { hideAllTooltips(); });


        function addTechnicalSkill(index, skill = null, allSkills = []) {
            if (!skill) return;

            // Compute a canonical id that covers all possible id field names
            const computedId = skill?.id || skill?.skill_id || skill?.skillid || skill?.c_id || '';
            console.debug('Adding technical skill:', {
                computedId,
                name: skill?.name,
                preferred_level: skill?.preferred_level
            });

            const skillData = {
                c_id: skill?.c_id || null,
                skill_id: computedId || null,
                id: computedId || null,
                code: skill?.code || null,
                sector_id: skill?.sector_id || null,
                sector_name: skill?.sector_name || '',
                sub_sector_id: skill?.sub_sector_id || null,
                sub_sector_name: skill?.sub_sector_name || '',
                name: skill?.name || '',
                description: skill?.description || '',
                preferred_level: skill?.preferred_level || '',
                is_custom: skill?.is_custom ?? 0,
                category_id: skill?.category_id ?? '',
                category_name: skill?.category_name ?? '',
                // Only mark as new if explicitly set or if converting master→company. Don't mark restored skills as new.
                is_new: skill?.is_new ?? (skill?.is_new_company_skill ? 1 : 0),
                is_new_company_skill: skill?.is_new_company_skill ?? 0,
            };

            const levelsFound = [];
            Object.keys(skill).forEach(key => {
                const match = key.match(/^level_(\d+)_description$/);
                if (match) {
                    const level = match[1];
                    levelsFound.push(level);

                    skillData[`level_${level}_description`] = skill[`level_${level}_description`];
                    // skillData[`level_${level}_knowledge`] = Array.isArray(skill[`level_${level}_knowledge`]) ?
                    //     skill[`level_${level}_knowledge`] :
                    //     (skill[`level_${level}_knowledge`] || '').split(';');
                    skillData[`level_${level}_knowledge`] = Array.isArray(skill[`level_${level}_knowledge`]) ?
                        skill[`level_${level}_knowledge`] :
                        String(skill[`level_${level}_knowledge`] || '').split(';');
                    skillData[`level_${level}_ability`] = Array.isArray(skill[`level_${level}_ability`]) ?
                        skill[`level_${level}_ability`] :
                        String(skill[`level_${level}_ability`] || '').split(';');
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
            if (skillData.is_custom == 1 || skillData.is_custom == 2) {
                technicalSkillType = 'Company Skill';
            } else {
                technicalSkillType = 'Master Skill';
            }
            const skillHtml = `
        <div class="technical-skill row mb-8" id="skill-${index}">
            ${hiddenInputs}
            <div class="d-flex gap-3 w-100 flex-nowrap overflow-hidden">
 
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
                                >
                            <option value="${skill?.id}" selected>
                                ${skill?.name}
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
            selectEl.select2({
                ajax: {
                    url: '{{ route('admin.technical-skill.search') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term,
                            page: params.page || 1
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination.more
                            }
                        };
                    },
                    cache: true
                },
                language: {
                    noResults: function() {
                        return "No matches found";
                    }
                },
                templateResult: function(data) {
                    console.log('Data for templateResult:', data);
                    if (data.loading) return data.text;
                    const skillType = data.skill_type || '';
                    const category = data.category || '';
                    const sector = data.sector || '';
                    const name = cleanLabel(data.text);
                    return $(`
            <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
                    ${name}
                </span>
                <div class="d-flex gap-2">
                    ${skillType
                        ? skillType === 'Master Skill'
                            ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                            : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                        : ''
                    }
 
                    ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${sector || ''}">${sector}</span>` : ''}
                    ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${category || ''}">${category}</span>` : ''}
                </div>
            </div>
        `);
                },
                templateSelection: function(data) {
                    console.log('Selected data:', data);
                    if (!data.id) return data.text;
                    const skillType = data.skill_type || '';
                    const category = data.category || '';
                    const sector = data.sector || '';
                    const name = cleanLabel(data.text);
                    if (skillType || sector || category) {
                        return $(`
            <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
                    ${name}
                </span>
                <div class="d-flex gap-2">
                    ${skillType
                        ? skillType === 'Master Skill'
                            ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                            : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                        : ''
                    }
                    ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${sector || ''}">${sector}</span>` : ''}
                    ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${category || ''}">${category}</span>` : ''}
                </div>
            </div>
        `);
                    }
                    return $(`
            <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
                    ${name}
                </span>
                <div class="d-flex gap-2">
                     ${technicalSkillType
                        ? technicalSkillType === 'Master Skill'
                            ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${technicalSkillType || ''}">${technicalSkillType}</span>`
                            : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${technicalSkillType || ''}">${technicalSkillType}</span>`
                        : ''
                    }
 
                    ${skill?.sector_name ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skill?.sector_name || ''}">${skill?.sector_name}</span>` : ''}
                    ${skill?.category_name ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skill?.category_name || ''}">${skill?.category_name}</span>` : ''}
                </div>
            </div>
        `);
                },
                placeholder: 'Search for a skill',
                minimumInputLength: 1,
                width: 'resolve'
            });

            // ✅ Re-init tooltips on dropdown open or selection (safe)
            selectEl.on('select2:open select2:select', function() {
                try { initializeTooltips(); } catch (err) { console.warn('initializeTooltips failed', err); }
            });

            $(document).on('select2:select select2:open select2:close', '.select-skill', function() {
                $('.select2-selection__rendered').removeAttr('title');
            });
            setTimeout(function() {
                $('.select2-selection__rendered').removeAttr('title');
            }, 100);

            initializeTooltips();

            //     selectEl.on('change', function() {
            //         const selectedId = $(this).val();
            //         const selectedText = $(this).find('option:selected').text();
            //         if (selectedId) {
            //     // Enable the button when a real skill is selected
            //     $(`#selectTechLevelButton${index}`).prop('disabled', false);
            // }
            //         $(`#technicalSkillsHidden\\[${index}\\]`).val(selectedText);
            //         // TechSkillChanged(index, this); // optionally fetch extra details
            //         // Fetch updated skill details from server and update everything
            //         TechSkillChanged(index, selectedId);
            //     });

            selectEl.on('change', function() {
                const selectedId = $(this).val();

                if (!selectedId) {
                    // Reset hidden field + disable button
                    $(`#technicalSkillsHidden\\[${index}\\]`).val('');
                    $(`#selectTechLevelButton${index}`).prop('disabled', true);
                    return;
                }

                // Pass selectEl to TechSkillChanged so it can handle duplicate reset
                TechSkillChanged(index, selectedId, $(this));
            });

            // ❌ REMOVED: This direct event listener was causing duplicate modal calls
            // The delegated jQuery handler below (line ~13498) handles all .remove-skill clicks
            // container.querySelector(`#skill-${index} .remove-skill`)
            //     .addEventListener('click', function() {
            //         const removeButton = this;
            //         const skillElement = removeButton.closest('.technical-skill');
            //         
            //         // Show loading overlay while modal is prepared
            //         try { if (typeof showOverlay === 'function') showOverlay(); } catch (e) {}
            //         
            //         // Show confirmation modal
            //         ModalManager.open({
            //             module: 'jobs',
            //             key: 'delete_technical_skill',
            //             data: {},
            //             onSubmit(modalEl) {
            //                 // User confirmed removal - proceed with the removal
            //                 console.log("Skill removal confirmed for index:", index);
            //                 
            //                 // Store the deleted skill in deletedSkills array
            //                 deletedSkills.push({
            //                     skill_id: skillData.skill_id,
            //                     name: skillData.name,
            //                     // other relevant fields can be stored if needed
            //                 });
            //                 delete technicalSkillsData[index];
            //                 skillElement.remove();
            //                 toggleRemoveSkillButtons();
            //                 
            //                 // Refresh comparison if active
            //                 if (comparisonActive) {
            //                     const ajaxResponse = @json($cachedData);
            //                     let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
            //                       .masterTechnicalSkills.length > 0 ?
            //                       ajaxResponse.masterTechnicalSkills :
            //                       (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : []);
            //                     const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : [];
            //                     const currentFormSkills = getCurrentFormSkills();
            //
            //                     const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
            //                     
            //                     // Handle validation errors
            //                     if (comparison.status === 'validation_error') {
            //                       console.warn('Validation Error:', comparison.message);
            //                     } else {
            //                       renderComparison(comparison.comparisonResults);
            //                       showComparisonSummary(comparison.comparisonResults);
            //                     }
            //                 }
            //                 
            //                 // Close the modal and hide loading overlay
            //                 const bsModal = bootstrap.Modal.getInstance(modalEl);
            //                 if (bsModal) bsModal.hide();
            //                 try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
            //             },
            //             onShown(modalEl) {
            //                 // Hide loading overlay when modal is shown
            //                 try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
            //             },
            //             onError() {
            //                 // Hide loading overlay on error
            //                 try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
            //             }
            //         });
            //     });

            // container.querySelector(`#skill-${index} .edit-skill`)
            //     .addEventListener('click', function() {
            //         const skillIndex = this.getAttribute('data-index');
            //         const skillData = technicalSkillsData[skillIndex];


            //         if (skillData.is_custom == 1 || skillData.is_custom == 2) {
            //             const modalEl = document.getElementById('CompanyTechnicalSkill');
            //             modalEl.setAttribute('data-skill-index', skillIndex);
            //             modalEl.querySelector('#companySkillName').textContent = skillData.name || 'Skill';
            //             // new bootstrap.Modal(modalEl).show();
            //             showOverlay();

            //             $.ajax({
            //                 url: `/admin/skill-job-count/${skillData.id}`,
            //                 type: "GET",
            //                 dataType: "json",
            //                 success: function (data) {
            //                     const countEl = modalEl.querySelector('#jobCount');
            //                     if (countEl) {
            //                         countEl.textContent = data.job_count || 0;
            //                     }
            //                     hideOverlay();
            //                     new bootstrap.Modal(modalEl).show();
            //                 },
            //                 error: function (xhr, status, error) {
            //                     console.error("Error fetching job count:", error);
            //                     hideOverlay();

            //                 }
            //             });
            //         } else {
            //             // const editModalEl = document.getElementById('EditTsfromMSL');
            //             // editModalEl.setAttribute('data-skill-index', skillIndex);
            //             // new bootstrap.Modal(editModalEl).show();
            //             console.log('Checking skill in DB:', skillData);
            //             showOverlay();
            //             $.ajax({
            //             url: '{{ route('admin.checkSkill') }}', // Endpoint to check if skill has a master_technical_skill_id
            //                 method: 'POST',
            //                 headers: {
            //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //                 },
            //                 data: {
            //                     skill_name: skillData.name,
            //                     category_name: skillData.category_name,
            //                     sector_name: skillData.sector_name,
            //                     is_custom: 0,
            //                 },
            //                 success: function(response) {
            //                     hideOverlay(); 
            //                     // if (response.skillExists) {
            //                         if (response.hasRelatedSkill) {
            //                             const createModalEl = document.getElementById('CreateNewSkillModal');
            //                             createModalEl.setAttribute('data-skill-index', skillIndex);
            //                             new bootstrap.Modal(createModalEl).show();
            //                         } else {
            //                             const editModalEl = document.getElementById('EditTsfromMSL');
            //                             editModalEl.setAttribute('data-skill-index', skillIndex);
            //                             new bootstrap.Modal(editModalEl).show();
            //                         }
            //                     // }else {
            //                     //     hideOverlay(); 
            //                     //     console.log("Skill hi nahi mila");
            //                     // }
            //                 },
            //                 error: function(error) {
            //                     hideOverlay(); 
            //                     console.log('Error checking skill:', error);
            //                 }
            //             });
            //         }
            //     });

            $(document).off('click', '.edit-skill').on('click', '.edit-skill', function(e) {
                e.preventDefault();
                const idx = this.dataset.index || (this.closest('.technical-skill')?.id.match(/^skill-(\d+)/) ||
                [])[1];
                const skillData = technicalSkillsData[idx];
                if (!skillData) return;

                if (skillData.is_custom == 1 || skillData.is_custom == 2) {
                    const modalEl = document.getElementById('CompanyTechnicalSkill');
                    modalEl.setAttribute('data-skill-index', idx);
                    modalEl.querySelector('#companySkillName').textContent = skillData.name || 'Skill';
                    showOverlay();
                    $.ajax({
                        // url: `/admin/skill-job-count/${skillData.id || skillData.skill_id}`,
                        url: `/admin/skill-job-count/${(skillData.is_new === 1 || skillData.is_new_company_skill === 1) ? null : skillData.id}`,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            const countEl = modalEl.querySelector('#jobCount');
                            if (countEl) countEl.textContent = data.job_count || 0;
                            hideOverlay();
                            new bootstrap.Modal(modalEl).show();
                        },
                        error: function() {
                            hideOverlay();
                        }
                    });
                } else {
                    showOverlay();
                    $.ajax({
                        url: '{{ route('admin.checkSkill') }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            skill_name: skillData.name,
                            category_name: skillData.category_name,
                            sector_name: skillData.sector_name,
                            is_custom: 0,
                        },
                        success: function(response) {
                            hideOverlay();
                            if (response.hasRelatedSkill) {
                                const createModalEl = document.getElementById('CreateNewSkillModal');
                                createModalEl.setAttribute('data-skill-index', idx);
                                new bootstrap.Modal(createModalEl).show();
                            } else {
                                const editModalEl = document.getElementById('EditTsfromMSL');
                                editModalEl.setAttribute('data-skill-index', idx);
                                new bootstrap.Modal(editModalEl).show();
                            }
                        },
                        error: function() {
                            hideOverlay();
                        }
                    });
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

        // function initSelect2(selector) {
        //     $(selector).select2({

        //         ajax: {
        //             url: '{{ route('admin.technical-skill.search') }}', // Change to your actual API endpoint
        //             dataType: 'json',
        //             delay: 250,
        //             data: function(params) {
        //                 return {
        //                     q: params.term // search term
        //                 };
        //             },
        //             processResults: function(data) {
        //                 return {
        //                     results: data.results,
        //                     pagination: {
        //                         more: data.pagination.more
        //                     }
        //                 };
        //             },
        //             cache: true
        //         },
        //         templateResult: function (data) {
        //             if (data.loading) return data.text;
        //             const isNewSkill = data.text && data.text.includes('(New Skill)');
        //             return $(`<span>${data.text} ${isNewSkill ? '<span class="badge bg-warning text-dark ms-2">New</span>' : ''}</span>`);
        //         },
        //         templateSelection: function (data) {
        //             return data.text;
        //         },
        //         placeholder: 'Search for a skill',
        //         minimumInputLength: 1,
        //         width: 'resolve'
        //     });
        // }

        // function initSelect2(selector) {
        //     const $el = typeof selector === 'string' ? $(selector) : selector;

        //     $el.select2({
        //         ajax: {
        //             url: '{{ route('admin.technical-skill.search') }}',
        //             dataType: 'json',
        //             delay: 250,
        //             data: function(params) {
        //                 return {
        //                     q: params.term
        //                 };
        //             },
        //             processResults: function(data) {
        //                 return {
        //                     results: data.results,
        //                     pagination: {
        //                         more: data.pagination.more
        //                     }
        //                 };
        //             },
        //             cache: true
        //         },
        //         templateResult: function(data) {
        //             if (data.loading) return data.text;
        //             const isNewSkill = data.text && data.text.includes('(New Skill)');
        //             return $(
        //                 `<span>${data.text} ${isNewSkill ? '<span class="badge bg-warning text-dark ms-2">New</span>' : ''}</span>`
        //                 );
        //         },
        //         templateSelection: function(data) {
        //             return data.text;
        //         },
        //         placeholder: 'Search for a skill',
        //         minimumInputLength: 1,
        //         width: 'resolve'
        //     });
        // }

        function initSelect2(selector) {
            const $el = typeof selector === 'string' ? $(selector) : selector;

            // 🔹 Reusable markup generator
            function renderSkillMarkup(data) {
                if (data.loading) return data.text;
                const name = cleanLabel(data.text);
                const skillType = data.skill_type || '';
                const category = data.category || '';
                const sector = data.sector || '';
                const isNewSkill = data.text && data.text.includes('(New Skill)');

                return $(`
            <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
                    ${name}
                    ${isNewSkill ? '<span class="badge bg-warning text-dark ms-2">New</span>' : ''}
                </span>
                <div class="d-flex gap-2">
                    ${skillType 
                        ? skillType === 'Master Skill'
                            ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                            : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                        : ''
                    }
                    ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${sector || ''}">${sector}</span>` : ''}
                    ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${category || ''}">${category}</span>` : ''}
                </div>
            </div>
        `);
            }

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
                language: {
                    noResults: function() {
                        return "No matches found";
                    }
                },
                templateResult: renderSkillMarkup, // ✅ dropdown items
                templateSelection: renderSkillMarkup, // ✅ selected value
                placeholder: 'Search for a skill',
                minimumInputLength: 1,
                width: 'resolve'
            });

            // ✅ Re-init tooltips when dropdown opens or selection changes (safe)
            $el.on('select2:open select2:select', function() {
                try { initializeTooltips(); } catch (err) { console.warn('initializeTooltips failed', err); }
            });
        }



        // function addNewTechnicalSkill(index, technicalSkills) {
        //     var skillSelect = $('<select>', {
        //         id: 'skill[' + index + ']',
        //         name: 'technicalSkills[' + index + '][id]',
        //         class: 'form-control mb-lg-0 select-skill',
        //         onchange: `TechSkillChanged('${index}',this.value)`,
        //         'data-control': 'select2',
        //         'data-hide-search': 'false',
        //         required: true
        //     });

        //     var hiddenInput = $(`<input>`, {
        //         type: 'hidden',
        //         id: `technicalSkillsHidden[${index}]`,
        //         name: `technicalSkills[${index}][name]`,
        //         value: ''
        //     });

        //     $.each(technicalSkills, function(key, skill) {
        //         skillSelect.append($('<option>', {
        //             value: skill.id,
        //             text: skill.name,
        //             'data-name': skill.name,
        //             'data-level1': skill.level_1_description,
        //             'data-level2': skill.level_2_description,
        //             'data-level3': skill.level_3_description,
        //             'data-level4': skill.level_4_description,
        //             'data-level5': skill.level_5_description,
        //             'data-level6': skill.level_6_description
        //         }));
        //     });

        //     var levelSelect = $('<select>', {
        //         id: 'level[' + index + ']',
        //         name: 'technicalSkills[' + index + '][level]',
        //         class: 'form-control mb-3 mb-lg-0 d-none'
        //     });

        //     for (var level = 1; level <= 6; level++) {
        //         levelSelect.append($('<option>', {
        //             value: level,
        //             text: 'Level ' + level
        //         }));
        //     }

        //     var skillRow = $('<div>', {
        //         class: 'technical-skill row mb-8',
        //         id: 'skill-' + index
        //     });

        //     var removeButton = $('<button>', {
        //         type: 'button',
        //         class: 'btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill'
        //     }).append('<iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>');

        //     var editButton = $(`<button>`, {
        //         type: 'button',
        //         class: 'btn btn-outline btn-outline-primary d-flex justify-content-center edit-skill',
        //         'data-index': index,
        //         html: `<iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>`
        //     });

        //     var skillCol = $('<div>', {
        //         class: 'fv-row fv-plugins-icon-container col d-flex gap-4 pl-0 w-100'
        //     }).append(removeButton).append(editButton).append(skillSelect);

        //     var popupButton = $('<button>', {
        //         type: 'button',
        //         id: `selectTechLevelButton${index}`,
        //         class: 'btn btn-outline btn-outline-primary btn-view d-flex justify-content-center rounded-1 w-auto w-100',
        //         'data-bs-toggle': 'modal',
        //         'data-bs-target': '#techskillmodal',
        //         onclick: `technicalpopulateModal(${index})`
        //     }).html('Select Level');


        //     skillRow.append(skillCol, hiddenInput, levelSelect, popupButton);
        //     $('#skills-container').append(skillRow);
        //     initSelect2(skillSelect);

        //     skillRow.find('.remove-skill').on('click', function () {
        //         $(this).closest('.technical-skill').remove();
        //         toggleRemoveSkillButtons();
        //     });

        //     toggleRemoveSkillButtons();
        // }

        //old code for addNewTechnicalSkill it
        // function addNewTechnicalSkill(index, technicalSkills) {

        //     const technicalSkillsData = window.technicalSkillsData || (window.technicalSkillsData = {});
        //     var skillSelect = $('<select>', {
        //         id: 'skill[' + index + ']',
        //         name: 'technicalSkills[' + index + '][id]',
        //         class: 'form-control select-skill',
        //         onchange: `TechSkillChanged('${index}',this.value)`,
        //         'data-control': 'select2',
        //         'data-hide-search': 'false',
        //         required: true
        //     });

        //     var hiddenInput = $(`<input>`, {
        //         type: 'hidden',
        //         id: `technicalSkillsHidden[${index}]`,
        //         name: `technicalSkills[${index}][name]`,
        //         value: ''
        //     });

        //     $.each(technicalSkills, function(key, skill) {
        //         skillSelect.append($('<option>', {
        //             value: skill.id,
        //             text: skill.name,
        //             'data-name': skill.name,
        //             'data-level1': skill.level_1_description,
        //             'data-level2': skill.level_2_description,
        //             'data-level3': skill.level_3_description,
        //             'data-level4': skill.level_4_description,
        //             'data-level5': skill.level_5_description,
        //             'data-level6': skill.level_6_description
        //         }));
        //     });

        //     var levelSelect = $('<select>', {
        //         id: 'level[' + index + ']',
        //         name: 'technicalSkills[' + index + '][level]',
        //         class: 'form-control mb-3 mb-lg-0 d-none'
        //     });

        //     for (var level = 1; level <= 6; level++) {
        //         levelSelect.append($('<option>', {
        //             value: level,
        //             text: 'Level ' + level
        //         }));
        //     }

        //     const skillRow = $('<div>', {
        //         class: 'technical-skill row mb-8',
        //         id: `skill-${index}`
        //     });

        //     var removeButton = $('<button>', {
        //         type: 'button',
        //         class: 'btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill'
        //     }).append('<iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>');

        //     var editButton = $(`<button>`, {
        //         type: 'button',
        //         class: 'btn btn-outline btn-outline-primary d-flex justify-content-center edit-skill',
        //         'data-index': index,
        //         html: `<iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>`
        //     });

        //     var skillCol = $('<div>', {
        //         class: 'fv-row mb-2 fv-plugins-icon-container col-lg-10 d-flex gap-7 align-items-center'
        //     }).append(removeButton).append(editButton).append(skillSelect);

        //     // var popupButton = $('<button>', {
        //     //     type: 'button',
        //     //     id: `selectTechLevelButton${index}`,
        //     //     class: 'btn-view edit-level-btn',
        //     //     'data-bs-toggle': 'modal',
        //     //     'data-bs-target': '#techskillmodal',
        //     //     onclick: `technicalpopulateModal(${index})`
        //     // }).html('Select Level');

        //     var popupButtonCol = $('<div>', {
        //         class: 'col'
        //     }).append(
        //         $('<button>', {
        //             type: 'button',
        //             id: `selectTechLevelButton${index}`,
        //             class: 'btn-view edit-level-btn',
        //             'data-bs-toggle': 'modal',
        //             'data-bs-target': '#techskillmodal',
        //             onclick: `technicalpopulateModal(${index})`
        //         }).html('Select Level')
        //     );


        //     skillRow.append(skillCol, hiddenInput, levelSelect, popupButtonCol);
        //     $('#skills-container').append(skillRow);
        //     // Initialize Select2 with AJAX
        //     $(skillSelect).select2({
        //         ajax: {
        //             url: '{{ route('admin.technical-skill.search') }}',
        //             dataType: 'json',
        //             delay: 250,
        //             data: function(params) {
        //                 return {
        //                     q: params.term
        //                 };
        //             },
        //             processResults: function(data) {
        //                 return {
        //                     results: data.results,
        //                     pagination: {
        //                         more: data.pagination.more
        //                     }
        //                 };
        //             },
        //             cache: true
        //         },
        //         templateResult: function(data) {
        //             if (data.loading) return data.text;
        //             const isNewSkill = data.text.includes('(New Skill)');
        //             return $(
        //                 `<span>${data.text} ${isNewSkill ? '<span class="badge bg-warning text-dark ms-2">New</span>' : ''}</span>`
        //                 );
        //         },
        //         templateSelection: function(data) {
        //             return data.text;
        //         },
        //         placeholder: 'Search for a skill',
        //         minimumInputLength: 1,
        //         width: 'resolve'
        //     });

        //     // Handle selection and update hidden inputs + technicalSkillsData
        //     skillSelect.on('change', function() {
        //         const selected = $(this).find('option:selected');
        //         const id = selected.val();
        //         const skillName = selected.data('name');
        //         const skillType = selected.text().includes('Company Skill') ? 2 : 0;

        //         // Update hidden name input
        //         $(`#technicalSkillsHidden\\[${index}\\]`).val(skillName);

        //         // Populate technicalSkillsData
        //         technicalSkillsData[index] = {
        //             id: id,
        //             name: skillName,
        //             description: '',
        //             level_1_description: selected.data('level1'),
        //             level_2_description: selected.data('level2'),
        //             level_3_description: selected.data('level3'),
        //             level_4_description: selected.data('level4'),
        //             level_5_description: selected.data('level5'),
        //             level_6_description: selected.data('level6'),
        //             preferred_level: 1,
        //             sector_name: '',
        //             is_custom: skillType
        //         };
        //     });

        //     // Edit skill click handler
        //     editButton.on('click', function() {
        //         const skillIndex = $(this).data('index');
        //         let skillData = technicalSkillsData[skillIndex];

        //         // Try to build it from DOM if not yet selected
        //         if (!skillData) {
        //             const selectedOption = $(`#skill\\[${skillIndex}\\] option:selected`);
        //             if (!selectedOption.length) return alert("Please select a skill first.");

        //             skillData = {
        //                 id: selectedOption.val(),
        //                 name: selectedOption.data('name'),
        //                 description: '',
        //                 level_1_description: selectedOption.data('level1'),
        //                 level_2_description: selectedOption.data('level2'),
        //                 level_3_description: selectedOption.data('level3'),
        //                 level_4_description: selectedOption.data('level4'),
        //                 level_5_description: selectedOption.data('level5'),
        //                 level_6_description: selectedOption.data('level6'),
        //                 sector_name: '',
        //                 preferred_level: 1,
        //                 is_custom: selectedOption.text().includes('Company Skill') ? 2 : 0
        //             };

        //             technicalSkillsData[skillIndex] = skillData;
        //         }

        //         // Trigger appropriate modal
        //         if (skillData.is_custom == 2) {
        //             const modalEl = document.getElementById('CompanyTechnicalSkill');
        //             modalEl.setAttribute('data-skill-index', skillIndex);
        //             modalEl.querySelector('#companySkillName').textContent = skillData.name || 'Skill';
        //             const companyModal = new bootstrap.Modal(modalEl);
        //             companyModal.show();
        //         } else {
        //             const editModal = new bootstrap.Modal(document.getElementById('EditTsfromMSL'));
        //             document.getElementById('EditTsfromMSL').setAttribute('data-skill-index', skillIndex);
        //             editModal.show();
        //         }
        //     });

        //     // Remove button logic
        //     removeButton.on('click', function() {
        //         $(this).closest('.technical-skill').remove();
        //         toggleRemoveSkillButtons();
        //     });

        //     toggleRemoveSkillButtons();
        // }

        function setTechnicalSkillLevel(index, level) {
            const $select = $(`select[name="technicalSkills[${index}][level]"]`);
            const $button = $(`#selectTechLevelButton${index}`);

            // Set select value
            $select.val(level);

            // Mark as selected
            $button.data('level-selected', true); // New flag

            // Clear any validation errors
            $select.removeClass('is-invalid');
            $button.removeClass('text-danger border-danger');
            $button.next('.level-validation-message').remove();

            // Clear custom validation highlights for missing levels
            clearValidationHighlightForSkill(index);

            // Update button text
            $button.text(`Level ${level}`);
        }


        //         function addNewTechnicalSkill(index, technicalSkills) {
        //     const technicalSkillsData = window.technicalSkillsData || (window.technicalSkillsData = {});

        //     // Create the skill select element
        //     var skillSelect = $('<select>', {
        //         id: `skill[${index}]`,
        //         name: `technicalSkills[${index}][id]`,
        //         class: 'form-control select-skill text-truncate w-100',
        //         'data-control': 'select2',
        //         'data-hide-search': 'false',
        //         'data-index': index,
        //         // onchange: `TechSkillChanged('${index}', this.value)`,
        //         // required: true
        //     });

        //     // Populate skill options
        //     $.each(technicalSkills, function(key, skill) {
        //         skillSelect.append($('<option>', {
        //             value: skill.id,
        //             text: skill.name,
        //             'data-name': skill.name,
        //             'data-level1': skill.level_1_description,
        //             'data-level2': skill.level_2_description,
        //             'data-level3': skill.level_3_description,
        //             'data-level4': skill.level_4_description,
        //             'data-level5': skill.level_5_description,
        //             'data-level6': skill.level_6_description
        //         }));
        //     });

        //     // Create level select (hidden by default)
        //     var levelSelect = $('<select>', {
        //         id: `level[${index}]`,
        //         name: `technicalSkills[${index}][level]`,
        //         class: 'form-control mb-3 mb-lg-0 d-none'
        //     });

        //     for (var level = 1; level <= 6; level++) {
        //         levelSelect.append($('<option>', {
        //             value: level,
        //             text: 'Level ' + level
        //         }));
        //     }

        //     // Create the entire skill row structure
        //     const skillRow = $(`
    //     <div class="technical-skill row mb-8" id="skill-${index}">
    //     <input type="hidden" id="technicalSkillsHidden[${index}]" name="technicalSkills[${index}][name]" value="">
    //     <div class="d-flex align-items-center gap-3 w-100 flex-nowrap overflow-hidden">

    //                     <!-- Trash Button -->
    //     <div class="flex-shrink-0">
    //     <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center remove-skill">
    //     <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
    //     </button>
    //     </div>

    //                     <!-- Edit Button -->
    //     <div class="flex-shrink-0">
    //     <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center edit-skill" data-index="${index}">
    //     <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
    //     </button>
    //     </div>

    //                     <!-- Select box container -->
    //     <div class="flex-grow-1 overflow-hidden"></div>

    //                     <!-- Level Button -->
    //     <div class="flex-shrink-0">
    //     <button type="button"
    //                                 id="selectTechLevelButton${index}"
    //                                 class="btn-view edit-level-btn"
    //                                 data-bs-toggle="modal"
    //                                 data-bs-target="#techskillmodal"
    //                                 onclick="technicalpopulateModal(${index})"
    //                                 disabled>
    //                             Select Level
    //     </button>
    //     </div>

    //                 </div>
    //     </div>
    //     `);

        //     // Append select and level select
        //     skillRow.find('.flex-grow-1').append(skillSelect);
        //     skillRow.find('.flex-grow-1').append(`
    //     <div class="text-danger mt-1 skill-validation-message" style="font-size: 0.875rem; display: none;">
    //         This field is required
    //     </div>
    //     `);
        //     skillRow.append(levelSelect);

        //     $('#skills-container').append(skillRow);

        //     // Initialize Select2
        //     $(skillSelect).select2({
        //         ajax: {
        //             url: '{{ route('admin.technical-skill.search') }}',
        //             dataType: 'json',
        //             delay: 250,
        //             data: function(params) {
        //                 return { q: params.term };
        //             },
        //             processResults: function(data) {
        //                 return {
        //                     results: data.results,
        //                     pagination: { more: data.pagination.more }
        //                 };
        //             },
        //             cache: true
        //         },
        //         templateResult: function(data) {
        //             if (data.loading) return data.text;
        //             const isNewSkill = data.text.includes('(New Skill)');
        //             return $(
        //                 `<span>${data.text} ${isNewSkill ? '<span class="badge bg-warning text-dark ms-2">New</span>' : ''}</span>`
        //             );
        //         },
        //         templateSelection: function(data) {
        //             return data.text;
        //         },
        //         placeholder: 'Search for a skill',
        //         minimumInputLength: 1,
        //         width: 'resolve'
        //     });

        //     // Handle skill select change
        //     skillSelect.on('change', function() {
        //         const selected = $(this).find('option:selected');
        //         const id = selected.val();
        //         // Check for duplicates across other select elements
        //     let isDuplicate = false;
        //     $('.select-skill').each(function() {
        //         const otherIndex = $(this).data('index');
        //         const otherValue = $(this).val();

        //         $(this).removeClass('is-invalid');
        // $(this).closest('.technical-skill').find('.skill-validation-message').hide();

        //         // Skip the current select being changed
        //         if (parseInt(otherIndex) !== parseInt(index) && otherValue === id) {
        //             isDuplicate = true;
        //             return false; // exit loop early
        //         }
        //     });

        //     if (isDuplicate) {
        //         // Reset the selection and show error
        //         $(this).val(null).trigger('change');
        //         alert('This skill is already selected. Please choose another.');
        //         return;
        //     }
        //          if (id) {
        //             // Enable the button when a real skill is selected
        //             $(`#selectTechLevelButton${index}`).prop('disabled', false);
        //         }

        //         const skillName = selected.data('name');
        //         const skillType = selected.text().includes('Company Skill') ? 2 : 0;

        //         // Update hidden input
        //         $(`#technicalSkillsHidden\\[${index}\\]`).val(skillName);

        //         // Store in global data
        //         technicalSkillsData[index] = {
        //             id: id,
        //             name: skillName,
        //             description: '',
        //             level_1_description: selected.data('level1'),
        //             level_2_description: selected.data('level2'),
        //             level_3_description: selected.data('level3'),
        //             level_4_description: selected.data('level4'),
        //             level_5_description: selected.data('level5'),
        //             level_6_description: selected.data('level6'),
        //             preferred_level: 1,
        //             sector_name: '',
        //             is_custom: skillType
        //         };
        //     });

        //     // Edit button logic
        //     skillRow.find('.edit-skill').on('click', function() {
        //         const skillIndex = $(this).data('index');
        //         let skillData = technicalSkillsData[skillIndex];

        //         // Build from DOM if needed
        //         if (!skillData) {
        //             const selectedOption = $(`#skill\\[${skillIndex}\\] option:selected`);
        //             if (!selectedOption.length) return alert("Please select a skill first.");

        //             skillData = {
        //                 id: selectedOption.val(),
        //                 name: selectedOption.data('name'),
        //                 description: '',
        //                 level_1_description: selectedOption.data('level1'),
        //                 level_2_description: selectedOption.data('level2'),
        //                 level_3_description: selectedOption.data('level3'),
        //                 level_4_description: selectedOption.data('level4'),
        //                 level_5_description: selectedOption.data('level5'),
        //                 level_6_description: selectedOption.data('level6'),
        //                 sector_name: '',
        //                 preferred_level: 1,
        //                 is_custom: selectedOption.text().includes('Company Skill') ? 2 : 0
        //             };

        //             technicalSkillsData[skillIndex] = skillData;
        //         }

        //         if (skillData.is_custom == 1 || skillData.is_custom == 2) {
        //             const modalEl = document.getElementById('CompanyTechnicalSkill');
        //             modalEl.setAttribute('data-skill-index', skillIndex);
        //             modalEl.querySelector('#companySkillName').textContent = skillData.name || 'Skill';
        //             const companyModal = new bootstrap.Modal(modalEl);
        //             companyModal.show();
        //         } else {
        //             const editModal = new bootstrap.Modal(document.getElementById('EditTsfromMSL'));
        //             document.getElementById('EditTsfromMSL').setAttribute('data-skill-index', skillIndex);
        //             editModal.show();
        //         }
        //     });

        //     // Remove button logic
        //     skillRow.find('.remove-skill').on('click', function() {
        //         $(this).closest('.technical-skill').remove();
        //         toggleRemoveSkillButtons();
        //     });

        //     toggleRemoveSkillButtons();
        //     }


        // ===================== GLOBAL DELEGATED HANDLERS =====================
        // $(function () {
        //   // ---------- helper: find row index ----------
        //   function getIdx(el) {
        //     const $el = $(el);
        //     return $el.data('index')
        //         ?? ($el.closest('.technical-skill').attr('id') || '').match(/^skill-(\d+)$/)?.[1];
        //   }

        //   // ---------- global in-flight locks (require-once) ----------
        //   window.__reqLocks = window.__reqLocks || new Set();
        //   function lock(key)  { if (window.__reqLocks.has(key)) return false; window.__reqLocks.add(key); return true; }
        //   function unlock(key){ window.__reqLocks.delete(key); }

        //   // ---------- remove any previous/legacy handlers ----------
        //   $(document).off('click.editSkill',  '.edit-skill');
        //   $(document).off('click',            '.edit-skill');   // in case a generic bind exists
        //   $(document).off('click.removeSkill', '.remove-skill');
        //   $(document).off('click',             '.remove-skill');

        //   // ---------- delegated REMOVE (single source of truth) ----------
        //   $(document).on('click.removeSkill', '.remove-skill', function (e) {
        //     e.preventDefault();
        //     const idx = getIdx(this);
        //     $(this).closest('.technical-skill').remove();
        //     if (idx != null && window.technicalSkillsData) delete window.technicalSkillsData[idx];
        //     if (typeof toggleRemoveSkillButtons === 'function') toggleRemoveSkillButtons();
        //   });

        //   // ---------- delegated EDIT (single source of truth) ----------
        //   $(document).on('click.editSkill', '.edit-skill', function (e) {
        //     e.preventDefault();
        //     e.stopPropagation();

        //     const $btn = $(this);
        //     const skillIndex = getIdx($btn);
        //     if (skillIndex == null) return;

        //     const $opt = $(`#skill\\[${skillIndex}\\] option:selected`);
        //     let skillData = window.technicalSkillsData?.[skillIndex];

        //     // Build from DOM if not present
        //     if (!skillData) {
        //       if (!$opt.length) { alert("Please select a skill first."); return; }
        //       skillData = {
        //         id: $opt.val(),
        //         name: $opt.data('name') || ($opt.text() || '').replace(/\s*\(.*?\)\s*/g, '').trim(),
        //         description: '',
        //         level_1_description: $opt.data('level1'),
        //         level_2_description: $opt.data('level2'),
        //         level_3_description: $opt.data('level3'),
        //         level_4_description: $opt.data('level4'),
        //         level_5_description: $opt.data('level5'),
        //         level_6_description: $opt.data('level6'),
        //         sector_name: '',
        //         preferred_level: 1,
        //         is_custom: ($opt.text() || '').includes('Company Skill') ? 2 : 0
        //       };
        //       (window.technicalSkillsData || (window.technicalSkillsData = {}))[skillIndex] = skillData;
        //     }

        //     console.log("Editing skill:", skillData);

        //     const isCompany = ($opt.text() || '').includes('Company Skill')
        //                    || skillData.is_custom === 2
        //                    || skillData.is_custom === 1;

        //     if (isCompany) {
        //       // -------- Company Skill path: job-count (call once) --------
        //       const key = `jobcount:${skillData.id}`;
        //       if (!lock(key)) return; // already in-flight, block duplicate

        //       const modalEl = document.getElementById('CompanyTechnicalSkill');
        //       modalEl.setAttribute('data-skill-index', skillIndex);
        //       const cleanText = ($opt.text() || '').replace(/\s*\(.*?\)\s*/g, '').trim();
        //       modalEl.querySelector('#companySkillName').textContent = skillData.name || cleanText || 'Skill';

        //       $btn.prop('disabled', true);
        //       if (typeof showOverlay === 'function') showOverlay();

        //       $.ajax({
        //         url: `/admin/skill-job-count/${skillData.id}`,
        //         type: "GET",
        //         dataType: "json"
        //       })
        //       .done(function (data) {
        //         const countEl = modalEl.querySelector('#jobCount');
        //         if (countEl) countEl.textContent = (data && data.job_count) ?? 0;
        //         new bootstrap.Modal(modalEl).show();
        //       })
        //       .fail(function (xhr, status, error) {
        //         console.error("Error fetching job count:", error);
        //       })
        //       .always(function () {
        //         if (typeof hideOverlay === 'function') hideOverlay();
        //         $btn.prop('disabled', false);
        //         unlock(key);
        //       });

        //       return;
        //     }

        //     // -------- Master Skill path: checkSkill (call once) --------
        //     const key = `checkSkill:${skillData.id || skillData.name}`;
        //     if (!lock(key)) return; // already in-flight, block duplicate

        //     $btn.prop('disabled', true);
        //     if (typeof showOverlay === 'function') showOverlay();

        //     $.ajax({
        //       url: '{{ route('admin.checkSkill') }}',
        //       method: 'POST',
        //       headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        //       data: {
        //         skill_name: skillData?.name || ($opt.text() || '').replace(/\s*\(.*?\)\s*/g, '').trim(),
        //         id: skillData?.id,
        //         is_custom: 0
        //       }
        //     })
        //     .done(function (response) {
        //       if (response?.hasRelatedSkill) {
        //         const el = document.getElementById('CreateNewSkillModal');
        //         el.setAttribute('data-skill-index', skillIndex);
        //         new bootstrap.Modal(el).show();
        //       } else {
        //         const el = document.getElementById('EditTsfromMSL');
        //         el.setAttribute('data-skill-index', skillIndex);
        //         new bootstrap.Modal(el).show();
        //       }
        //     })
        //     .fail(function (err) {
        //       console.error('Error checking skill:', err);
        //     })
        //     .always(function () {
        //       if (typeof hideOverlay === 'function') hideOverlay();
        //       $btn.prop('disabled', false);
        //       unlock(key);
        //     });
        //   });
        // });

        function removeSkillFromData(index) {
            // Remove from technicalSkillsData completely
            if (technicalSkillsData[index]) {
                delete technicalSkillsData[index];
            }

            // Clean up undefined values in place
            Object.keys(technicalSkillsData).forEach(key => {
                if (technicalSkillsData[key] === undefined) {
                    delete technicalSkillsData[key];
                }
            });

            console.log("After removal:", technicalSkillsData);
        }

        // Safe insert/replace helper: replace existing row by id if present,
        // otherwise remove duplicates (by hidden name) and append.
        function insertOrReplaceSkillRow(rowHtml, skillIndex, skillName) {
            try {
                const oldRow = document.getElementById(`skill-${skillIndex}`);
                if (oldRow) {
                    oldRow.outerHTML = rowHtml;
                    return;
                }
                const container = document.getElementById('skills-container');
                if (!container) return;

                if (skillName) {
                    const duplicates = Array.from(container.querySelectorAll('.technical-skill'))
                        .filter(el => {
                            const hidden = el.querySelector('input[type=hidden][name^="technicalSkills"][value]');
                            return hidden && String(hidden.value || '').trim() === String(skillName).trim();
                        });
                    duplicates.forEach(d => d.remove());
                }

                container.insertAdjacentHTML('beforeend', rowHtml);
            } catch (e) {
                console.error('insertOrReplaceSkillRow failed', e);
                try {
                    const container = document.getElementById('skills-container');
                    if (container) container.insertAdjacentHTML('beforeend', rowHtml);
                } catch (ee) { console.error('fallback insert failed', ee); }
            }
        }
        
        // Utility function to safely destroy Select2
        function safelyDestroySelect2(element) {
            const $element = $(element);
            
            if ($element.length === 0) {
                console.warn('Element not found for Select2 destruction');
                return false;
            }
            
            // Check if jQuery and Select2 are available
            if (typeof $ === 'undefined' || typeof $.fn.select2 === 'undefined') {
                console.warn('Select2 library not available');
                return false;
            }
            
            // Check if Select2 is initialized
            if ($element.hasClass('select2-hidden-accessible')) {
                try {
                    $element.select2('destroy');
                    console.log('Select2 destroyed successfully for:', $element.attr('id'));
                    return true;
                } catch (error) {
                    console.error('Failed to destroy Select2:', error);
                    return false;
                }
            } else {
                console.log('Select2 not initialized on element:', $element.attr('id'));
                return false;
            }
        }

        // Utility function to ensure Select2 is properly destroyed and reinitialized
        function reinitializeSelect2(element) {
            const $element = $(element);
            
            // Use the safe destroy function
            safelyDestroySelect2($element);
            
            // Remove any leftover Select2 DOM elements
            $element.next('.select2-container').remove();
            
            // Clear any validation classes
            $element.removeClass('is-invalid is-valid');
        }

        // Function to get next available index for skills
        function getNextSkillIndex(containerSelector) {
            const existingIndices = $(containerSelector).map(function() {
                const id = $(this).attr('id');
                if (id) {
                    // Handle both skill-X and generic-skill-X patterns
                    let match;
                    if (containerSelector.includes('technical-skill')) {
                        match = id.match(/^skill-(\d+)$/);
                    } else if (containerSelector.includes('generic-skill')) {
                        match = id.match(/^generic-skill-(\d+)$/);
                    } else {
                        match = id.match(/(\d+)$/);
                    }
                    return match ? parseInt(match[1]) : 0;
                }
                return 0;
            }).get();
            
            const newIndex = existingIndices.length > 0 ? Math.max(...existingIndices) + 1 : 0;
            console.log(`Getting next index for ${containerSelector}: existing indices [${existingIndices.join(', ')}], new index: ${newIndex}`);
            return newIndex;
        }

        // Debug function to check current state
        function debugSkillState() {
            console.log('=== SKILL STATE DEBUG ===');
            console.log('Technical skills in DOM:', $('.technical-skill').map(function() { return $(this).attr('id'); }).get());
            console.log('technicalSkillsData keys:', Object.keys(technicalSkillsData || {}));
            console.log('Select2 instances:', $('.select-skill.select2-hidden-accessible').map(function() { return $(this).attr('id'); }).get());
            console.log('========================');
        }
        
        // new
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
                // onchange: `TechSkillChanged('${index}', this.value)`,
                // required: true
            });

            skillSelect.append($('<option>', {
                value: '',
                text: 'Search for a skill',
                disabled: true,
                selected: true,
                style: 'color: #3E3E3E;'
            }));

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

            // Add placeholder
            levelSelect.append($('<option>', {
                value: '',
                text: 'Select Level',
                disabled: true,
                selected: true
            }));

            // Append level options
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
<input type="hidden" id="technicalSkillsHiddenCustom[${index}]" name="technicalSkills[${index}][is_custom]" value="">
<div class="d-flex gap-3 w-100 flex-nowrap overflow-hidden">
 
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
                            onclick="technicalpopulateModal(${index})"
                            disabled>
                        Select Level
</button>
</div>
 
            </div>
</div>
    `);

            // Append select and level select
            skillRow.find('.flex-grow-1').append(skillSelect);
            skillRow.find('.flex-grow-1').append(`
    <div class="text-danger mt-1 skill-validation-message" style="font-size: 0.875rem; display: none;">
        This field is required
    </div>
    `);
            skillRow.append(levelSelect);

            $('#skills-container').append(skillRow);

            // Ensure clean Select2 initialization
            reinitializeSelect2(skillSelect);

            // Initialize Select2
            try {
                console.log('Initializing Select2 for skill:', index, 'Element ID:', skillSelect.attr('id'));
                
                // Check if jQuery and Select2 are available
                if (typeof $ === 'undefined' || typeof $.fn.select2 === 'undefined') {
                    console.error('Select2 library not available for initialization');
                    return;
                }
                
                $(skillSelect).select2({
                ajax: {
                    url: '{{ route('admin.technical-skill.search') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term,
                            page: params.page || 1
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination.more
                            }
                        };
                    },
                    cache: true
                },
                language: {
                    noResults: function() {
                        return "No matches found";
                    }
                },
                templateResult: function(data) {
                    if (data.loading) return data.text;

                    // ✅ Use values from API response
                    const skillType = data.skill_type || '';
                    const category = data.category || '';
                    const sector = data.sector || '';
                    const name = cleanLabel(data.text);

                    return $(`
            <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
                    ${name}
                </span>
                <div class="d-flex gap-2">
                    ${skillType 
                        ? skillType === 'Master Skill'
                            ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                            : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                        : ''
                    }

                    ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${sector || ''}">${sector}</span>` : ''}
                    ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${category || ''}">${category}</span>` : ''}
                </div>
            </div>
        `);
                },
                templateSelection: function(data) {
                    const skillType = data.skill_type || '';
                    const category = data.category || '';
                    const sector = data.sector || '';
                    const name = cleanLabel(data.text);
                    return $(`
            <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
                    ${name}
                </span>
                <div class="d-flex gap-2">
                    ${skillType 
                        ? skillType === 'Master Skill'
                            ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                            : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                        : ''
                    }

                    ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${sector || ''}">${sector}</span>` : ''}
                    ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${category || ''}">${category}</span>` : ''}
                </div>
            </div>
        `);
                },
                placeholder: 'Search for a skill',
                minimumInputLength: 1,
                width: 'resolve'
            });

            // ✅ Re-init tooltips when dropdown opens or selection changes (safe)
            $(skillSelect).on('select2:open select2:select', function() {
                try { initializeTooltips(); } catch (err) { console.warn('initializeTooltips failed', err); }
            });

                console.log('Select2 initialized successfully for skill:', index);
            } catch (error) {
                console.error('Error initializing Select2 for skill:', index, error);
            }



            // Handle skill select change
            // skillSelect.on('change', function () {
            //     const selected = $(this).find('option:selected');
            //     const id = selected.val();
            //     const selectedId = String(selected.val()).trim();
            //     const selectedText = selected.text().trim();
            //     const skillIndex = $(this).data('index');
            //     const skillNameOnly = selectedText.split('(')[0].trim();
            //     const isMasterSkill = selectedText.includes('Master Skill');
            //     const jobId = $('input[name="job_id"]').val();

            //     let isDuplicate = false;
            //     $('.select-skill').each(function () {
            //         const otherIndex = $(this).data('index');
            //         const otherValue = String($(this).val()).trim();
            //         const isSameIndex = parseInt(otherIndex) === parseInt(skillIndex);
            //         const isPersistent = $(this).closest('.technical-skill').data('persistent') === true;
            //         const storedSkill = technicalSkillsData[otherIndex];
            //         $(this).removeClass('is-invalid');
            //         $(this).closest('.technical-skill').find('.skill-validation-message').hide();

            //         if (!isSameIndex && !isPersistent) {
            //             if (
            //                 selectedId === otherValue ||
            //                 (storedSkill && (storedSkill.skill_id == selectedId || storedSkill.id == selectedId))
            //             ) {
            //                 isDuplicate = true;
            //                 return false;
            //             }
            //         }
            //     });

            //     if (isDuplicate) {
            //         $(this).val(null).trigger('change');
            //         alert('This skill is already selected. Please choose another.');
            //         return;
            //     }

            //     // if (id) {
            //     //     // Enable the button when a real skill is selected
            //     //     $(`#selectTechLevelButton${index}`).prop('disabled', false);
            //     // }

            //     // Check if the skill was deleted and can be re-added
            //         if (deletedSkills.some(deletedSkill => deletedSkill.name === skillNameOnly)) {
            //             // Remove the skill from deleted list and proceed
            //             deletedSkills = deletedSkills.filter(deletedSkill => deletedSkill.name !== skillNameOnly);
            //             proceedWithSkillSelection(selected, skillIndex, skillNameOnly, selectedId, selectedText);
            //             TechSkillChanged(`${skillIndex}`, selectedId);
            //             console.log(`Skill "${skillNameOnly}" was previously deleted but is now being re-added.`);
            //             return;
            //         }

            //     // ✅ AJAX check for Company Skill existence and link status
            //     if (isMasterSkill) {
            //         $.ajax({
            //             url: '/admin/check-company-skill-exists',
            //             type: 'POST',
            //             data: {
            //                 name: skillNameOnly,
            //                 job_id: jobId,
            //                 _token: $('meta[name="csrf-token"]').attr('content')
            //             },
            //             success: function (response) {
            //                 if (response.exists && response.linked) {
            //                     skillSelect.val(null).trigger('change');
            //                     alert(`A Company Skill named "${skillNameOnly}" is already exists and linked to this job. Please choose another.`);
            //                 } 
            //                 // else if (response.exists) {
            //                 //     skillSelect.val(null).trigger('change');
            //                 //     alert(`A Company Skill named "${skillNameOnly}" already exists. Please choose another.`);
            //                 // } 
            //                 else {
            //                     proceedWithSkillSelection(selected, skillIndex, skillNameOnly, selectedId, selectedText);
            //                     TechSkillChanged(`${skillIndex}`, selectedId); 
            //                 }
            //             },
            //             error: function () {
            //                 alert("Error checking skill name. Please try again.");
            //             }
            //         });
            //     } else {
            //         proceedWithSkillSelection(selected, skillIndex, skillNameOnly, selectedId, selectedText);
            //         TechSkillChanged(`${skillIndex}`, selectedId); 
            //     }
            // });

            // Guard map to prevent recursive triggers
            const _changingGuard = new WeakMap();

            // skillSelect.off('change.dupcheck').on('change.dupcheck', function (e) {
            //     const $sel = $(this);

            //     // prevent recursion
            //     if (_changingGuard.get(this)) return;

            //     const selected = $sel.find('option:selected');
            //     const id = selected.val();
            //     const selectedId = String(selected.val() || '').trim();
            //     const selectedText = selected.text().trim();
            //     const skillIndex = $sel.data('index');
            //     const skillNameOnly = selectedText.split('(')[0].trim();
            //     const isMasterSkill = selectedText.includes('Master Skill');
            //     const jobId = $('input[name="job_id"]').val();

            //     let isDuplicate = false;
            //     $('.select-skill').each(function () {
            //         const otherIndex = $(this).data('index');
            //         const otherValue = String($(this).val()).trim();
            //         const isSameIndex = parseInt(otherIndex) === parseInt(skillIndex);
            //         const isPersistent = $(this).closest('.technical-skill').data('persistent') === true;
            //         const storedSkill = technicalSkillsData[otherIndex];
            //         $(this).removeClass('is-invalid');
            //         $(this).closest('.technical-skill').find('.skill-validation-message').hide();

            //         if (!isSameIndex && !isPersistent) {
            //             if (
            //                 selectedId === otherValue ||
            //                 (storedSkill && (storedSkill.skill_id == selectedId || storedSkill.id == selectedId))
            //             ) {
            //                 isDuplicate = true;
            //                 return false;
            //             }
            //         }
            //     });

            //     if (isDuplicate) {
            //         // guard during reset
            //         _changingGuard.set(this, true);

            //         // reset without infinite loop
            //         $sel.val(null).trigger('change.select2');  

            //         _changingGuard.set(this, false);

            //         alert('This skill is already selected. Please choose another.');
            //         return;
            //     }

            //     // If previously deleted skill, re-add
            //     if (deletedSkills.some(deletedSkill => deletedSkill.name === skillNameOnly)) {
            //         deletedSkills = deletedSkills.filter(deletedSkill => deletedSkill.name !== skillNameOnly);
            //         proceedWithSkillSelection(selected, skillIndex, skillNameOnly, selectedId, selectedText);
            //         TechSkillChanged(`${skillIndex}`, selectedId);
            //         console.log(`Skill "${skillNameOnly}" was previously deleted but is now being re-added.`);
            //         return;
            //     }

            //     // ✅ AJAX check for Company Skill existence
            //     if (isMasterSkill) {
            //         $.ajax({
            //             url: '/admin/check-company-skill-exists',
            //             type: 'POST',
            //             data: {
            //                 name: skillNameOnly,
            //                 job_id: jobId,
            //                 _token: $('meta[name="csrf-token"]').attr('content')
            //             },
            //             success: function (response) {
            //                 if (response.exists && response.linked) {
            //                     _changingGuard.set($sel[0], true);
            //                     $sel.val(null).trigger('change.select2');
            //                     _changingGuard.set($sel[0], false);

            //                     alert(`A Company Skill named "${skillNameOnly}" already exists and is linked to this job. Please choose another.`);
            //                 } else {
            //                     proceedWithSkillSelection(selected, skillIndex, skillNameOnly, selectedId, selectedText);
            //                     TechSkillChanged(`${skillIndex}`, selectedId);
            //                 }
            //             },
            //             error: function () {
            //                 alert("Error checking skill name. Please try again.");
            //             }
            //         });
            //     } else {
            //         proceedWithSkillSelection(selected, skillIndex, skillNameOnly, selectedId, selectedText);
            //         TechSkillChanged(`${skillIndex}`, selectedId);
            //     }
            // });

            skillSelect.off('change.dupcheck').on('change.dupcheck', function(e) {
                const $sel = $(this);

                // prevent recursion during programmatic resets
                if (_changingGuard.get(this)) return;

                const selected = $sel.find('option:selected');
                const id = selected.val();
                const selectedId = String(selected.val() || '').trim();
                const selectedText = selected.text().trim();
                const skillIndex = $sel.data('index'); // <-- use this, not 'index'
                const skillNameOnly = selectedText.split('(')[0].trim();
                const isMasterSkill = selectedText.includes('Master Skill');
                const jobId = $('input[name="job_id"]').val();

                // duplicate check across other selects + current data
                let isDuplicate = false;
                $('.select-skill').each(function() {
                    const otherIndex = $(this).data('index');
                    const otherValue = String($(this).val() || '').trim();
                    const isSameIndex = Number(otherIndex) === Number(skillIndex);
                    const isPersistent = $(this).closest('.technical-skill').data('persistent') === true;
                    const storedSkill = window.technicalSkillsData[otherIndex];

                    $(this).removeClass('is-invalid');
                    $(this).closest('.technical-skill').find('.skill-validation-message').hide();

                    if (!isSameIndex && !isPersistent) {
                        if (
                            selectedId === otherValue ||
                            (storedSkill && (storedSkill.skill_id == selectedId || storedSkill.id ==
                                selectedId))
                        ) {
                            isDuplicate = true;
                            return false; // break .each
                        }
                    }
                });

                if (isDuplicate) {
                    // guard while resetting to avoid infinite loop
                    _changingGuard.set(this, true);
                    $sel.val(null).trigger('change.select2'); // UI update only
                    _changingGuard.set(this, false);

                    alert('This skill is already selected. Please choose another.');
                    return;
                }

                // Re-add if it was previously deleted
                if (Array.isArray(window.deletedSkills) && window.deletedSkills.some(d => d?.name ===
                    skillNameOnly)) {
                    window.deletedSkills = window.deletedSkills.filter(d => d?.name !== skillNameOnly);

                    // Update hidden input (ID contains brackets, so escape them)
                    $(`#technicalSkillsHidden\\[${skillIndex}\\]`).val(skillNameOnly);
                    // enable Select Level button now that a real skill is chosen
                    $(`#selectTechLevelButton${skillIndex}`).prop('disabled', false);

                    proceedWithSkillSelection(selected, skillIndex, skillNameOnly, selectedId, selectedText);
                    TechSkillChanged(String(skillIndex), selectedId,
                    $sel); // pass select element if your fn accepts it
                    return;
                }

                // Master Skill special check
                if (isMasterSkill) {
                    $.ajax({
                        url: '/admin/check-company-skill-exists',
                        type: 'POST',
                        data: {
                            name: skillNameOnly,
                            job_id: jobId,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.exists && response.linked) {
                                // reset selection safely
                                _changingGuard.set($sel[0], true);
                                $sel.val(null).trigger('change.select2');
                                _changingGuard.set($sel[0], false);

                                alert(
                                    `A Company Skill named "${skillNameOnly}" already exists and is linked to this job. Please choose another.`);
                            } else {
                                // Update hidden + enable button
                                $(`#technicalSkillsHidden\\[${skillIndex}\\]`).val(skillNameOnly);
                                $(`#selectTechLevelButton${skillIndex}`).prop('disabled', false);

                                proceedWithSkillSelection(selected, skillIndex, skillNameOnly,
                                    selectedId, selectedText);
                                TechSkillChanged(String(skillIndex), selectedId, $sel);
                            }
                        },
                        error: function() {
                            alert("Error checking skill name. Please try again.");
                        }
                    });
                    return; // important: avoid falling through
                }

                // Normal (non-master) selection path
                // Update hidden + enable button
                $(`#technicalSkillsHidden\\[${skillIndex}\\]`).val(skillNameOnly);
                $(`#selectTechLevelButton${skillIndex}`).prop('disabled', false);

                proceedWithSkillSelection(selected, skillIndex, skillNameOnly, selectedId, selectedText);
                TechSkillChanged(String(skillIndex), selectedId, $sel);
            });



            // Edit button logic
            // skillRow.find('.edit-skill').on('click', function() {
           $(document).off('click', '.edit-skill').on('click', '.edit-skill', function () {
        const skillIndex = $(this).data('index');
        let skillData = technicalSkillsData[skillIndex];
        const selectedOption = $(`#skill\\[${skillIndex}\\] option:selected`);
         if (!selectedOption.text()) return alert("Please select a skill first.");
        if (selectedOption.text() === "Search for a skill") return alert("Please select a skill first.");
 
        // Build from DOM if needed
        if (!skillData) {
            // const selectedOption = $(`#skill\\[${skillIndex}\\] option:selected`);
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
            console.log(selectedOption.text());
 
            technicalSkillsData[skillIndex] = skillData;
        }

        console.log('skillData', skillData);


        // let selectedOption =$(`#skill\\[${skillIndex}\\] option:selected`);
        let cleanText = selectedOption.text().replace(/\s*\(.*?\)\s*/g, '').trim();
 
        // if (selectedOption.text().includes('Company Skill')) {
        //     const modalEl = document.getElementById('CompanyTechnicalSkill');
        //     modalEl.setAttribute('data-skill-index', skillIndex);
        //     modalEl.querySelector('#companySkillName').textContent = skillData.name || cleanText || 'Skill';
        //     // const companyModal = new bootstrap.Modal(modalEl);
        //     // companyModal.show();
        //     showOverlay();
 
        //     $.ajax({
        //         url: `/admin/skill-job-count/${skillData.id}`,
        //         type: "GET",
        //         dataType: "json",
        //         success: function (data) {
        //             const countEl = modalEl.querySelector('#jobCount');
        //             if (countEl) {
        //                 countEl.textContent = data.job_count || 0;
        //             }
        //             hideOverlay();
        //             const companyModal = new bootstrap.Modal(modalEl);
        //             companyModal.show();
        //         },
        //         error: function (xhr, status, error) {
        //             console.error("Error fetching job count:", error);
        //             hideOverlay();

        //         }
        //     });
        // } else {
        //     // const editModal = new bootstrap.Modal(document.getElementById('EditTsfromMSL'));
        //     // document.getElementById('EditTsfromMSL').setAttribute('data-skill-index', skillIndex);
        //     // editModal.show();
        //     showOverlay();
        //     $.ajax({
        //     url: '{{ route('admin.checkSkill') }}', // Endpoint to check if skill has a master_technical_skill_id
        //         method: 'POST',
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         data: {
        //             skill_name: skillData?.name || cleanText,
        //             id: skillData?.id,
        //             is_custom: 0,
        //         },
        //         success: function(response) {
        //             hideOverlay(); 
        //             // if (response.skillExists) {
        //                 if (response.hasRelatedSkill) {
        //                     const createModalEl = document.getElementById('CreateNewSkillModal');
        //                     createModalEl.setAttribute('data-skill-index', skillIndex);
        //                     new bootstrap.Modal(createModalEl).show();
        //                 } else {
        //                     const editModalEl = document.getElementById('EditTsfromMSL');
        //                     editModalEl.setAttribute('data-skill-index', skillIndex);
        //                     new bootstrap.Modal(editModalEl).show();
        //                 }
        //             // }else {
        //             //     hideOverlay(); 
        //             //     console.log("Skill hi nahi mila");
        //             // }
        //         },
        //         error: function(error) {
        //             hideOverlay(); 
        //             console.log('Error checking skill:', error);
        //         }
        //     });
        // }
        if (selectedOption.text().includes('Company Skill')) {
                    const modalEl = document.getElementById('CompanyTechnicalSkill');
                    modalEl.setAttribute('data-skill-index', skillIndex);
                    modalEl.querySelector('#companySkillName').textContent = skillData.name || cleanText || 'Skill';
                    // const companyModal = new bootstrap.Modal(modalEl);
                    // companyModal.show();
                    showOverlay();
 
                        $.ajax({
                            // url: `/admin/skill-job-count/${skillData.id || skillData.skill_id}`,
                            url: `/admin/skill-job-count/${(skillData.is_new === 1 || skillData.is_new_company_skill === 1) ? null : skillData.id}`,
                            type: "GET",
                            dataType: "json",
                            success: function (data) {
                                const countEl = modalEl.querySelector('#jobCount');
                                if (countEl) {
                                    countEl.textContent = data.job_count || 0;
                                }
                                hideOverlay();
                                const companyModal = new bootstrap.Modal(modalEl);
                                companyModal.show();
                            },
                            error: function (xhr, status, error) {
                                console.error("Error fetching job count:", error);
                                hideOverlay();
 
                            }
                        });
                } else if (selectedOption.text().includes('Master Skill')) {
                    showOverlay();
                        $.ajax({
                        url: '{{ route('admin.checkSkill') }}', // Endpoint to check if skill has a master_technical_skill_id
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                skill_name: skillData?.name || cleanText,
                                id: skillData?.id,
                                is_custom: 0,
                            },
                            success: function(response) {
                                hideOverlay(); 
                                // if (response.skillExists) {
                                    if (response.hasRelatedSkill) {
                                        const createModalEl = document.getElementById('CreateNewSkillModal');
                                        createModalEl.setAttribute('data-skill-index', skillIndex);
                                        new bootstrap.Modal(createModalEl).show();
                                    } else {
                                        const editModalEl = document.getElementById('EditTsfromMSL');
                                        editModalEl.setAttribute('data-skill-index', skillIndex);
                                        new bootstrap.Modal(editModalEl).show();
                                    }
                                // }else {
                                //     hideOverlay(); 
                                //     console.log("Skill hi nahi mila");
                                // }
                            },
                            error: function(error) {
                                hideOverlay(); 
                                console.log('Error checking skill:', error);
                            }
                        });

                }else if (skillData.is_custom == 1 || skillData.is_custom == 2) {
                    const modalEl = document.getElementById('CompanyTechnicalSkill');
                    modalEl.setAttribute('data-skill-index', skillIndex);
                    modalEl.querySelector('#companySkillName').textContent = skillData.name || cleanText || 'Skill';
                    // const companyModal = new bootstrap.Modal(modalEl);
                    // companyModal.show();
                    showOverlay();
 
                        $.ajax({
                            // url: `/admin/skill-job-count/${skillData.id || skillData.skill_id}`,
                            url: `/admin/skill-job-count/${(skillData.is_new === 1 || skillData.is_new_company_skill === 1) ? null : skillData.id}`,
                            type: "GET",
                            dataType: "json",
                            success: function (data) {
                                const countEl = modalEl.querySelector('#jobCount');
                                if (countEl) {
                                    countEl.textContent = data.job_count || 0;
                                }
                                hideOverlay();
                                const companyModal = new bootstrap.Modal(modalEl);
                                companyModal.show();
                            },
                            error: function (xhr, status, error) {
                                console.error("Error fetching job count:", error);
                                hideOverlay();
 
                            }
                        });
                } else if (!skillData.id || skillData.id === 'null' || skillData.id === null || skillData.id === undefined) {
                    const modalEl = document.getElementById('CompanyTechnicalSkill');
                    modalEl.setAttribute('data-skill-index', skillIndex);
                    modalEl.querySelector('#companySkillName').textContent = skillData.name || cleanText || 'Skill';
                    // const companyModal = new bootstrap.Modal(modalEl);
                    // companyModal.show();
                    showOverlay();
 
                        $.ajax({
                            // url: `/admin/skill-job-count/${skillData.id || skillData.skill_id}`,
                            url: `/admin/skill-job-count/${(skillData.is_new === 1 || skillData.is_new_company_skill === 1) ? null : skillData.id}`,
                            type: "GET",
                            dataType: "json",
                            success: function (data) {
                                const countEl = modalEl.querySelector('#jobCount');
                                if (countEl) {
                                    countEl.textContent = data.job_count || 0;
                                }
                                hideOverlay();
                                const companyModal = new bootstrap.Modal(modalEl);
                                companyModal.show();
                            },
                            error: function (xhr, status, error) {
                                console.error("Error fetching job count:", error);
                                hideOverlay();
 
                            }
                        });
                }else {
                    // const editModal = new bootstrap.Modal(document.getElementById('EditTsfromMSL'));
                    // document.getElementById('EditTsfromMSL').setAttribute('data-skill-index', skillIndex);
                    // editModal.show();
                    showOverlay();
                        $.ajax({
                        url: '{{ route('admin.checkSkill') }}', // Endpoint to check if skill has a master_technical_skill_id
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                skill_name: skillData?.name || cleanText,
                                id: skillData?.id,
                                is_custom: 0,
                            },
                            success: function(response) {
                                hideOverlay(); 
                                // if (response.skillExists) {
                                    if (response.hasRelatedSkill) {
                                        const createModalEl = document.getElementById('CreateNewSkillModal');
                                        createModalEl.setAttribute('data-skill-index', skillIndex);
                                        new bootstrap.Modal(createModalEl).show();
                                    } else {
                                        const editModalEl = document.getElementById('EditTsfromMSL');
                                        editModalEl.setAttribute('data-skill-index', skillIndex);
                                        new bootstrap.Modal(editModalEl).show();
                                    }
                                // }else {
                                //     hideOverlay(); 
                                //     console.log("Skill hi nahi mila");
                                // }
                            },
                            error: function(error) {
                                hideOverlay(); 
                                console.log('Error checking skill:', error);
                            }
                        });
                }
    });



            // ❌ REMOVED: Direct event handler - now handled by global delegated handler (line ~5806)
            // skillRow.find('.remove-skill').on('click', function() {
            //     console.log("Removing skill at index:", index);
            //     debugSkillState();
            //     
            //     const removeButton = this;
            //     const skillElement = $(this).closest('.technical-skill');
            //     const selectElement = skillElement.find('.select-skill');
            //     
            //     // Show loading overlay while modal is prepared
            //     try { if (typeof showOverlay === 'function') showOverlay(); } catch (e) {}
            //     
            //     // Show confirmation modal
            //     ModalManager.open({
            //         module: 'jobs',
            //         key: 'delete_technical_skill',
            //         data: {},
            //         onSubmit(modalEl) {
            //             // User confirmed removal - proceed with the removal
            //             console.log("Skill removal confirmed for index:", index);
            //             
            //             // Safely destroy Select2 instance before removing the element
            //             safelyDestroySelect2(selectElement);
            //             
            //             removeSkillFromData(index);
            //             skillElement.remove();
            //             toggleRemoveSkillButtons();
            //             
            //             console.log("After removal:");
            //             debugSkillState();
            //             
            //             // Refresh comparison if active
            //             if (comparisonActive) {
            //                 const ajaxResponse = @json($cachedData);
            //                 let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
            //                   .masterTechnicalSkills.length > 0 ?
            //                   ajaxResponse.masterTechnicalSkills :
            //                   (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : []);
            //                 const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : [];
            //                 const currentFormSkills = getCurrentFormSkills();
            //
            //                 const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
            //                 
            //                 // Handle validation errors
            //                 if (comparison.status === 'validation_error') {
            //                   console.warn('Validation Error:', comparison.message);
            //                 } else {
            //                   renderComparison(comparison.comparisonResults);
            //                   showComparisonSummary(comparison.comparisonResults);
            //                 }
            //             }
            //             
            //             // Close the modal and hide loading overlay
            //             const bsModal = bootstrap.Modal.getInstance(modalEl);
            //             if (bsModal) bsModal.hide();
            //             try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
            //         },
            //         onShown(modalEl) {
            //             // Hide loading overlay when modal is shown
            //             try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
            //         },
            //         onError() {
            //             // Hide loading overlay on error
            //             try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
            //         }
            //     });
            // });


            // if (typeof toggleRemoveSkillButtons === 'function') toggleRemoveSkillButtons();
            toggleRemoveSkillButtons();
            
            // Reinitialize tooltips for the new elements
            setTimeout(() => {
                $('[data-bs-toggle="tooltip"]').tooltip('dispose').tooltip();
            }, 100);
        }

        function proceedWithSkillSelection(selected, skillIndex, skillNameOnly, selectedId, selectedText) {
            const skillType = selectedText.includes('Company Skill') ? 2 : 0;

            $(`#technicalSkillsHidden\\[${skillIndex}\\]`).val(skillNameOnly);

            technicalSkillsData[skillIndex] = {
                id: selectedId,
                skill_id: selectedId,
                name: skillNameOnly,
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

            $(`#selectTechLevelButton${skillIndex}`).prop('disabled', false);
        }






        // function technicalpopulateModal(index) {
        //     const data = technicalSkillsData[index];

        //     // let data = JSON.parse(button.getAttribute('data-skill'));
        //     console.log('technicalpoopupmodal', data);

        //     let modalBody = $('#techskillmodal .modalbody');
        //     // console.log(selected_level);
        //     // console.log(level_2);
        //     modalBody.empty(); // Clear existing modal content
        //     console.log(modalBody);

        //     $('#techskillmodal .modal-title').text(data.name);
        //     // levels.forEach(level => {
        //     let selectedLevel = parseInt(data.preferred_level, 10);
        //     console.log('updateed selected', selectedLevel);
        //     for (let i = 1; i <= 6; i++) {
        //         console.log('descriptor', data['level_' + i + '_description']);

        //         let knowledge = data['level_' + i + '_knowledge'] || '';

        //         let ability = data['level_' + i + '_ability'] || '';

        //         if (data['level_' + i + '_description']) {
        //             console.log('in the condition')
        //             modalBody.append(`
    //             <div class="form-check col-lg-4">


    //                     <label class="form-check-label h-100 w-100" for="level_1">
    //                         <div class="col-lg-12 h-100">
    //                                 <div class="card  card-stretch card-bordered mb-5 h-100 card-checked-orange">
    //                                     <div class="card-header align-items-center header-checked-orange">
    //                                         <h3 class="card-title">Level ${i} <iconify-icon icon="material-symbols:star" style="margin-left: 5px"></iconify-icon></h3>
    //                                         <input class="form-check-input border-dark" type="radio" value="${i-1}" id="level_${i}" name="level" ${selectedLevel == i ? 'checked' : ''}>

    //                                     </div>
    //                                     <div class="card-body">
    //                                         <h5 class="fs-6">${data['level_' + i + '_description']}</h5>
    //                                         <div class="p-3">
    //                                             <h4 class="fs-6">Knowledge</h4>
    //                                             <div class="d-flex flex-column">

    //                                             ${createListFromString(knowledge)}
    //                                             </div>

    //                                         </div>
    //                                         <div class="p-3">
    //                                             <h4 class="fs-6">Ability</h4>
    //                                             <div class="d-flex flex-column">
    //                                             ${createListFromString(ability)}

    //                                             </div>
    //                                         </div>
    //                                     </div>

    //                                 </div>
    //                         </div>
    //                     </label>
    //                 </div>
    //             `);
        //         } else {
        //             modalBody.append(`
    //         <div class="form-check col-lg-4">


    //                 <label class="form-check-label h-100 w-100" for="level_1 ">
    //                     <div class="col-lg-12 h-100">
    //                             <div class="card bg-gray-100  card-stretch card-bordered mb-5 h-100">
    //                                 <div class="card-header align-items-center">
    //                                     <h3 class="card-title">Level ${i}</h3>
    //                                     <input class="form-check-input border-dark" type="radio" value="${i-1}" id="level_${i}" name="level" ${selectedLevel == i ? 'checked' : ''}>

    //                                 </div>
    //                                 <div class="card-body">
    //                                     <h5></h5>
    //                                     <div class="p-3">


    //                                     </div>
    //                                     <div class="p-3">

    //                                     </div>
    //                                 </div>

    //                             </div>
    //                     </div>
    //                 </label>
    //             </div>
    //         `);
        //         }

        //     }


        //     $('#techskillmodal .save-btn').data('skill-id', index); // Set skill ID on save button for later
        // }

        //         function technicalpopulateModal(index) {
        //             currentTechSkillIndex = index;
        //     const data = technicalSkillsData[index];
        //     const modalBody = $('#techskillmodal .modalbody');
        //     modalBody.empty();

        //     $('#techskillmodal .modal-title').text(data.name);

        //     let selectedLevel = parseInt(data.preferred_level, 10); // Convert string to number

        //     for (let i = 1; i <= 6; i++) {
        //         const description = data[`level_${i}_description`] || '';
        //         const knowledge = data[`level_${i}_knowledge`] || '';
        //         const ability = data[`level_${i}_ability`] || '';

        //         const isSelected = selectedLevel === i;
        //         const isEmpty = description.trim() === '';

        //         const checkedAttr = isSelected ? 'checked' : '';
        //         const disabledAttr = isEmpty ? 'disabled' : '';
        //         const activeCard = isSelected ? 'card-checked-orange' : '';
        //         const headerHighlight = isSelected ? 'header-checked-orange' : '';
        //         const labelDim = isEmpty ? 'disabled-label' : '';
        //         const onclickAttr = isEmpty ? '' : `onclick="updateSelectedLevel(${i})"`;

        //         modalBody.append(`
    //             <div class="form-check col-lg-4">
    //                 <label class="form-check-label h-100 w-100 ${labelDim}" for="level_${i}">
    //                     <div class="col-lg-12 h-100">
    //                         <div class="card card-stretch card-bordered mb-5 h-100 ${activeCard}">
    //                             <div class="card-header align-items-center ${headerHighlight}">
    //                                 <h3 class="card-title">Level ${i}</h3>
    //                                 <iconify-icon icon="material-symbols:star" style="margin-left: 5px"></iconify-icon>
    //                                 <input class="form-check-input border-dark" type="radio" 
    //                                     value="${i}" id="level_${i}" name="level" ${checkedAttr} ${disabledAttr} ${onclickAttr}>
    //                             </div>
    //                             <div class="card-body">
    //                                 <h5 class="fs-6">${description}</h5>
    //                                 <div class="p-3">
    //                                     <h4 class="fs-6">Knowledge</h4>
    //                                     <div class="d-flex flex-column">
    //                                         ${createListFromString(knowledge)}
    //                                     </div>
    //                                 </div>
    //                                 <div class="p-3">
    //                                     <h4 class="fs-6">Ability</h4>
    //                                     <div class="d-flex flex-column">
    //                                         ${createListFromString(ability)}
    //                                     </div>
    //                                 </div>
    //                             </div>
    //                         </div>
    //                     </div>
    //                 </label>
    //             </div>
    //         `);
        //     }

        //     $('#techskillmodal .save-btn').data('skill-id', index);
        //     $('#techskillmodal').modal('show');
        // }

        function technicalpopulateModal(index) {
            currentTechSkillIndex = index;
            const data = technicalSkillsData[index];
            const modalBody = $('#techskillmodal .modalbody');
            modalBody.empty();

            $('#techskillmodal .modal-title').text(cleanLabel(data.name));
            $('#techskillmodal .modal-desc').text(data.description);

            let selectedLevel = parseInt(data.preferred_level, 10); // Convert string to number
            
            // Store the original preferred level to restore if user cancels
            const originalPreferredLevel = data.preferred_level;
            
            // Flag to track if user saved or just closed
            let userClickedSave = false;
            
            const normalize = val => {
                const str = (val || '').toString().trim().toLowerCase();
                return str === '' || str === 'null';
            };

            for (let i = 1; i <= 6; i++) {
                const description = data[`level_${i}_description`] || '';
                const knowledge = data[`level_${i}_knowledge`] || '';
                const ability = data[`level_${i}_ability`] || '';

                const isSelected = selectedLevel === i;
                const isEmpty = normalize(description) && normalize(knowledge) && normalize(ability);

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
            $('#techskillmodal input[name="level"]').off('change').on('change', function() {
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
                $('#techskillmodal input[name="level"]').each(function() {
                    const card = $(this).closest('.card');
                    card.removeClass('card-checked-orange');
                    card.find('.card-header').removeClass('header-checked-orange');
                });

                // Select the chosen one
                const card = $(this).closest('.card');
                card.addClass('card-checked-orange');
                card.find('.card-header').addClass('header-checked-orange');

                // DO NOT update preferred level here - only update when Save is clicked

                // Enable Save button
                $('#techskillmodal .save-btn').prop('disabled', false);
            });

            $('#techskillmodal .save-btn').off('click').on('click', function() {
                const selected = $('#techskillmodal input[name="level"]:checked').val();
                const skillIndex = $(this).data('skill-id');

                if (!selected) {
                    alert("Please select a level before saving.");
                    return;
                }

                // Set the flag that user clicked save
                userClickedSave = true;
                
                // Update the preferred level in the data
                const skillData = technicalSkillsData[skillIndex];
                if (skillData) {
                    skillData.preferred_level = parseInt(selected, 10);
                }

                // Update the UI button text
                setTechnicalSkillLevel(skillIndex, selected);
                
                // Update hidden input
                const hiddenInputSelector = `input[name="technicalSkills[${skillIndex}][preferred_level]"]`;
                let inputEl = $(hiddenInputSelector);
                if (inputEl.length) {
                    inputEl.val(selected);
                } else {
                    $(`#skill-${skillIndex}`).prepend(`
                        <input type="hidden" name="technicalSkills[${skillIndex}][preferred_level]" value="${selected}">
                    `);
                }
                
                // Update the JSON data
                $('#technicalSkillsJson').val(JSON.stringify(technicalSkillsData));

                // Close modal (data-bs-dismiss="modal" will handle this)
                // No need to call modal('hide') as the button has data-bs-dismiss
            });
            
            // Handle modal close without saving - restore original level
            $('#techskillmodal').off('hidden.bs.modal.technicalpopulate').on('hidden.bs.modal.technicalpopulate', function() {
                const skillData = technicalSkillsData[currentTechSkillIndex];
                
                // Only restore if user didn't click save
                if (!userClickedSave && skillData && skillData.preferred_level !== originalPreferredLevel) {
                    skillData.preferred_level = originalPreferredLevel;
                    
                    // Also restore the button text
                    const $button = $(`#selectTechLevelButton${currentTechSkillIndex}`);
                    if (originalPreferredLevel) {
                        $button.text(`Level ${originalPreferredLevel}`);
                    } else {
                        $button.text('Select Level');
                    }
                }
                
                // Remove this specific event listener
                $('#techskillmodal').off('hidden.bs.modal.technicalpopulate');
            });

            $('#techskillmodal').modal('show');
        }




        // function technicalModal(index, data, skillTitle, selected_level) {
        //     console.log('technicalpoopupmodal', data);

        //     data = JSON.parse(data);
        //     console.log(data.level_4_knowledge);
        //     let modalBody = $('#techskillmodal .modalbody');
        //     // console.log(selected_level);
        //     // console.log(level_2);
        //     modalBody.empty(); // Clear existing modal content
        //     console.log(modalBody);

        //     $('#techskillmodal .modal-title').text(skillTitle);
        //     // levels.forEach(level => {
        //     let selectedLevel = parseInt(selected_level, 10);
        //     console.log('updateed selected', selectedLevel);
        //     for (let i = 1; i <= 6; i++) {
        //         console.log('descriptor', data['level_' + i + '_description']);

        //         let knowledge = data['level_' + i + '_knowledge'] || '';

        //         let ability = data['level_' + i + '_ability'] || '';

        //         if (data['level_' + i + '_description']) {
        //             console.log('in the condition')
        //             modalBody.append(`
    //             <div class="form-check col-lg-4">


    //                     <label class="form-check-label h-100 w-100" for="level_1">
    //                         <div class="col-lg-12 h-100">
    //                                 <div class="card  card-stretch card-bordered mb-5 h-100">
    //                                     <div class="card-header align-items-center">
    //                                         <h3 class="card-title">Level ${i}</h3>
    //                                         <input class="form-check-input border-dark" type="radio" value="${i}" id="level_${i}"  name="level" ${selectedLevel == i ? 'checked' : ''}>

    //                                     </div>
    //                                     <div class="card-body">
    //                                         <h5 class="fs-6">${data['level_' + i + '_description']}</h5>
    //                                         <div class="p-3">
    //                                             <h4 class="fs-6">Knowledge</h4>
    //                                             <div class="d-flex flex-column">

    //                                             ${createListFromString(knowledge)}
    //                                             </div>

    //                                         </div>
    //                                         <div class="p-3">
    //                                             <h4 class="fs-6">Ability</h4>
    //                                             <div class="d-flex flex-column">
    //                                             ${createListFromString(ability)}

    //                                             </div>
    //                                         </div>
    //                                     </div>

    //                                 </div>
    //                         </div>
    //                     </label>
    //                 </div>
    //             `);
        //         } else {
        //             modalBody.append(`
    //         <div class="form-check col-lg-4">


    //                 <label class="form-check-label h-100 w-100" for="level_1 ">
    //                     <div class="col-lg-12 h-100">
    //                             <div class="card bg-gray-100  card-stretch card-bordered mb-5 h-100">
    //                                 <div class="card-header align-items-center">
    //                                     <h3 class="card-title">Level ${i}</h3>
    //                                     <input class="form-check-input border-dark" type="radio" value="${i-1}" id="level_${i}" name="level" ${selectedLevel == i ? 'checked' : ''}>

    //                                 </div>
    //                                 <div class="card-body">
    //                                     <h5></h5>
    //                                     <div class="p-3">


    //                                     </div>
    //                                     <div class="p-3">

    //                                     </div>
    //                                 </div>

    //                             </div>
    //                     </div>
    //                 </label>
    //             </div>
    //         `);
        //         }

        //     }


        //     $('#techskillmodal .save-btn').data('skill-id', index); // Set skill ID on save button for later
        // }

        function technicalModal(index, data, skillTitle, selected_level) {
            console.log('technicalpoopupmodal', data);
            currentTechSkillIndex = index;

            data = JSON.parse(data);
            let modalBody = $('#techskillmodal .modalbody');
            modalBody.empty(); // Clear previous content

            $('#techskillmodal .modal-title').text(cleanLabel(skillTitle));

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
            $('#techskillmodal input[name="level"]').off('change').on('change', function() {
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
                $('#techskillmodal input[name="level"]').each(function() {
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
        // function updateGenericLevel(level, index) {
        //     // Store the selected level in the hidden data object
        //     if (genericSkillsData[index]) {
        //         genericSkillsData[index].preferred_level = getLevelLabel(level);
        //     }

        //     // Optional: Visually mark the card or add any effects
        //     $('#genericSkillModal input[name="generic_level"]').each(function() {
        //         const card = $(this).closest('.card');
        //         card.removeClass('card-checked-orange');
        //         card.find('.card-header').removeClass('header-checked-orange');
        //     });

        //     const selectedInput = $(`#generic_level_${level}`);
        //     const selectedCard = selectedInput.closest('.card');
        //     selectedCard.addClass('card-checked-orange');
        //     selectedCard.find('.card-header').addClass('header-checked-orange');

        //      // 4. Remove validation errors if previously shown
        //     $(`#selectGenericLevelButton${index}`).removeClass('border-danger text-danger');
        //     $(`#selectGenericLevelButton${index}`).next('.level-validation-message').remove();

        //     // 5. Update the button label text (if applicable)
        //     $(`#selectGenericLevelButton${index}`).text(`Level ${getLevelLabel(level)}`);
        // }

        function updateGenericLevel(level, index) {
            // ✅ Store only in temporary object
            temporaryGenericLevelSelection[index] = level;

            // 🔄 Remove highlight from all cards
            $('#genericSkillModal input[name="generic_level"]').each(function() {
                const card = $(this).closest('.card');
                card.removeClass('card-checked-orange');
                card.find('.card-header').removeClass('header-checked-orange');
            });

            // ✅ Highlight the selected one
            const selectedInput = $(`#generic_level_${level}`);
            const selectedCard = selectedInput.closest('.card');
            selectedCard.addClass('card-checked-orange');
            selectedCard.find('.card-header').addClass('header-checked-orange');

            $(`#selectGenericLevelButton${index}`).removeClass('border-danger text-danger');
            $(`#selectGenericLevelButton${index}`).next('.level-validation-message').remove();

            // 🚫 Do not update genericSkillsData or label here
            // ✅ Enable save button
            $('#genericSkillModal .save-btn').prop('disabled', false);
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
            $('#techskillmodal input[name="level"]').each(function() {
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

        $('#techskillmodal .save-btn').off('click').on('click', function() {
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

        // function getLevelLabel(level) {
        //     switch (parseInt(level)) {
        //         case 1:
        //             return 'Basic';
        //         case 2:
        //             return 'Intermediate';
        //         case 3:
        //             return 'Advanced';
        //         default:
        //             return '';
        //     }
        // }

        function getLevelLabel(level) {
            const levelStr = String(level).toLowerCase();

            switch (levelStr) {
                case '1':
                case 'basic':
                    return 'Basic';
                case '2':
                case 'intermediate':
                    return 'Intermediate';
                case '3':
                case 'advanced':
                    return 'Advanced';
                default:
                    return '';
            }
        }





        // function addGenericSkill(index, skill = null) {
        //     console.log(skill);
        //     genericSkillsData[index] = skill;

        //     // Helper function to map preferred_level to numeric value
        //     function getPreferredLevel(level) {
        //         switch (level?.toLowerCase()) {
        //             case 'basic':
        //                 return 1;
        //             case 'intermediate':
        //                 return 2;
        //             case 'advanced':
        //                 return 3;
        //             default:
        //                 return ''; // Return empty string if no match
        //         }
        //     }

        //     const preferredLevel = getPreferredLevel(skill?.preferred_level);
        //     const skillHtml = `
    //     <div class="technical-skill row mb-8">
    //         <div class="fv-row mb-2 fv-plugins-icon-container col-lg-9 d-flex gap-7">
    //             <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
    //                 <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
    //             </button>

    //             <input type="text" class="form-control input-style " id="genericSkill[${index}]" name="genericSkills[${index}][id]" placeholder="Generic Skill" readonly value="${skill.competency}" required>
    //         </div>
    //         <div class="fv-row mb-2 fv-plugins-icon-container d-flex col-lg-3 btn-vl-container justify-content-end">
    //             <select id="genericLevel[${index}]" name="genericSkills[${index}][level]" class="form-select col-lg-7 btn-level mb-3 mb-lg-0 rounded-right">
    //                 ${[1, 2, 3]
    //                     .map((level) => `<option value="${level}" ${preferredLevel == level ? 'selected' : ''}>Level ${level}</option>`)
    //                     .join('')}
    //             </select>
    //             <button type="button" id="selectGenericLevelButton${index}" data-bs-toggle="modal" data-bs-target="#genericSkillModal" onclick="genericPopulateModal('${index}')">
    //                 View Level
    //                 <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
    //             </button>
    //         </div>
    //         <div class="col-md-12 d-flex justify-content-end">

    //             <input type="text" class="form-control col-lg-11" readonly  placeholder="Enter skill description" name="genericSkills[${index}][description]" value="${skill?.level_1 || ''}">
    //         </div>
    //     </div>`;

        //     const container = document.getElementById('generic-skills-container');
        //     container.insertAdjacentHTML('beforeend', skillHtml);

        //     // Add event listener to remove the skill
        //     // container
        //     //     .querySelector(`.generic-skill:nth-child(${index + 1}) .remove-skill`)
        //     //     .addEventListener('click', function() {
        //     //         this.closest('.generic-skill').remove();
        //     //     });

        //     // Add event listener to remove the description
        //     // container
        //     //     .querySelector(`.generic-skill:nth-child(${index + 1}) .remove-description`)
        //     //     .addEventListener('click', function() {
        //     //         this.closest('.generic-skill').remove();
        //     //     });

        //     // Initialize Select2 for skill dropdown
        //     $(`#genericSkill[${index}]`).select2({
        //         placeholder: 'Search for a skill',
        //     });
        // }

        // function toggleRemoveSkillButtons() {
        //     const genericButtons = document.querySelectorAll('.generic-skill .remove-skill');
        //     const techButtons = document.querySelectorAll('.technical-skill .remove-skill');

        //     genericButtons.forEach(btn => {
        //         btn.disabled = genericButtons.length <= 3;
        //     });

        //     techButtons.forEach(btn => {
        //         btn.disabled = techButtons.length <= 1;
        //     });
        // }

        // function toggleRemoveSkillButtons() {
        //     const genericButtons = document.querySelectorAll('.generic-skill .remove-skill');
        //     const techButtons = document.querySelectorAll('.technical-skill .remove-skill');

        //     // Toggle remove buttons
        //     genericButtons.forEach(btn => {
        //         btn.disabled = genericButtons.length <= 3;
        //     });

        //     techButtons.forEach(btn => {
        //         btn.disabled = techButtons.length <= 1;
        //     });

        //     // Enable "Add New Generic Skill" button if count is less than MAX_GENERIC_SKILLS
        //     const currentGenericSkillCount = document.querySelectorAll('.generic-skill').length;
        //     if (currentGenericSkillCount < MAX_GENERIC_SKILLS) {
        //         $('#add_new_generic_skill').prop('disabled', false).attr('title', '');
        //     }
        // }

        function toggleRemoveSkillButtons() {
            const genericSkillElements = document.querySelectorAll('.generic-skill');
            const technicalSkillElements = document.querySelectorAll('.technical-skill:not(.removed-skill)');

            const genericButtons = document.querySelectorAll('.generic-skill .remove-skill');
            const techButtons = document.querySelectorAll('.technical-skill:not(.removed-skill) .remove-skill');

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



        // function addGenericSkill(index, skill = null) {
        //     if (!skill) return;

        //     // Ensure genericSkillsData[index] stores all necessary fields
        //     const skillData = {
        //         job_id: skill?.job_id || null,
        //         competency: skill?.competency || '',
        //         description: skill?.description || '',
        //         preferred_level: skill?.preferred_level || '',
        //         //new fields
        //         level_1: skill?.level_1 || '',
        //         level_2: skill?.level_2 || '',
        //         level_3: skill?.level_3 || '',
        //         level_1_knowledge: skill?.level_1_knowledge || [],
        //         level_1_ability: skill?.level_1_ability || [],
        //         level_2_knowledge: skill?.level_2_knowledge || [],
        //         level_2_ability: skill?.level_2_ability || [],
        //         level_3_knowledge: skill?.level_3_knowledge || [],
        //         level_3_ability: skill?.level_3_ability || [],
        //     };

        //     // Loop through levels (1 to 3) and add description, knowledge, and ability if they exist
        //     for (let level = 1; level <= 3; level++) {
        //         if (skill[`level_${level}`]) {
        //             skillData[`level_${level}`] = skill[`level_${level}`];
        //             skillData[`level_${level}_knowledge`] = skill[`level_${level}_knowledge`] || [];
        //             skillData[`level_${level}_ability`] = skill[`level_${level}_ability`] || [];
        //         }
        //     }

        //     // Store the full skill data into the array
        //     genericSkillsData[index] = skillData;
        //     console.log('Updated genericSkillsData:', genericSkillsData);

        //     // Helper function to map preferred_level to numeric value
        //     function getPreferredLevel(level) {
        //         switch (level?.toLowerCase()) {
        //             case 'Basic':
        //                 return 1;
        //             case 'Intermediate':
        //                 return 2;
        //             case 'Advanced':
        //                 return 3;
        //             default:
        //                 return ''; // Return empty string if no match
        //         }
        //     }

        //     const preferredLevel = getPreferredLevel(skill?.preferred_level);

        //     // Generate hidden input fields for form submission
        //     let hiddenInputs = '';
        //     Object.keys(skillData).forEach((key) => {
        //         if (Array.isArray(skillData[key])) {
        //             // Handle array data (level_x_knowledge and level_x_ability)
        //             skillData[key].forEach((value, i) => {
        //                 hiddenInputs += `<input type="hidden" name="genericSkills[${index}][${key}][${i}]" value="${value}">`;
        //             });
        //         } else {
        //             // Handle regular string/integer fields
        //             hiddenInputs += `<input type="hidden" name="genericSkills[${index}][${key}]" value="${skillData[key]}">`;
        //         }
        //     });

        //     console.log("hsdfjzsdfdjhdfj", skillData);

        //     // Generate HTML UI
        //     const skillHtml = `
    //         <div class="generic-skill row mb-8" id="generic-skill-${index}">
    //             ${hiddenInputs} <!-- Append hidden inputs here -->
    //             <div class="fv-row mb-2 fv-plugins-icon-container col-lg-10 d-flex gap-7">
    //                 <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
    //                     <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
    //                 </button>
    //                 <input type="text" class="form-control input-style" id="genericSkill[${index}]" 
    //                     name="genericSkills[${index}][competency]" placeholder="Generic Skill" 
    //                     value="${skillData.competency}" required readonly>
    //             </div>


    //                 <button type="button" id="selectGenericLevelButton${index}" data-bs-toggle="modal" class="edit-level-btn" data-bs-target="#genericSkillModal" onclick="genericPopulateModal('${index}')">
    //                     ${skillData.preferred_level}
    //                 </button>

    //         </div>`;

        //     const container = document.getElementById('generic-skills-container');
        //     container.insertAdjacentHTML('beforeend', skillHtml);

        //     // Remove skill event listener
        //     container.querySelector(`#generic-skill-${index} .remove-skill`)
        //     .addEventListener('click', function () {
        //         this.closest('.generic-skill').remove();
        //         toggleRemoveSkillButtons(); // Good ✅
        //     });

        //     // Initialize Select2 for skill dropdown
        //     $(`#genericSkill[${index}]`).select2({
        //         placeholder: 'Search for a skill',
        //     });

        //     toggleRemoveSkillButtons();
        // }

        //         function addGenericSkill(index, skill = null, allSkills = []) {
        //     if (!skill) return;

        //     const skillData = {
        //         // id: skill?.id || null,
        //         // competency: skill?.name || '',
        //         // description: skill?.description || '',
        //         // preferred_level: skill?.preferred_level || '',
        //         // level_1: skill?.level_1 || '',
        //         // level_1_knowledge: Array.isArray(skill?.level_1_knowledge) ? skill.level_1_knowledge : (skill?.level_1_knowledge || '').split(';'),
        //         // level_1_ability: Array.isArray(skill?.level_1_ability) ? skill.level_1_ability : (skill?.level_1_ability || '').split(';'),
        //         // level_2: skill?.level_2 || '',
        //         // level_2_knowledge: Array.isArray(skill?.level_2_knowledge) ? skill.level_2_knowledge : (skill?.level_2_knowledge || '').split(';'),
        //         // level_2_ability: Array.isArray(skill?.level_2_ability) ? skill.level_2_ability : (skill?.level_2_ability || '').split(';'),
        //         // level_3: skill?.level_3 || '',
        //         // level_3_knowledge: Array.isArray(skill?.level_3_knowledge) ? skill.level_3_knowledge : (skill?.level_3_knowledge || '').split(';'),
        //         // level_3_ability: Array.isArray(skill?.level_3_ability) ? skill.level_3_ability : (skill?.level_3_ability || '').split(';')

        //         job_id: skill?.job_id || null,
        //         id: skill?.id || null,
        //         competency: skill?.competency || '',
        //         description: skill?.description || '',
        //         preferred_level: skill?.preferred_level || '',
        //         //new fields
        //         level_1: skill?.level_1 || '',
        //         level_2: skill?.level_2 || '',
        //         level_3: skill?.level_3 || '',
        //         level_1_knowledge: skill?.level_1_knowledge || [],
        //         level_1_ability: skill?.level_1_ability || [],
        //         level_2_knowledge: skill?.level_2_knowledge || [],
        //         level_2_ability: skill?.level_2_ability || [],
        //         level_3_knowledge: skill?.level_3_knowledge || [],
        //         level_3_ability: skill?.level_3_ability || [],
        //     };

        //     genericSkillsData[index] = skillData;

        //     let hiddenInputs = '';
        //     Object.keys(skillData).forEach(key => {
        //         if (Array.isArray(skillData[key])) {
        //             skillData[key].forEach((value, i) => {
        //                 hiddenInputs += `<input type="hidden" name="genericSkills[${index}][${key}][${i}]" value="${value}">`;
        //             });
        //         } else {
        //             hiddenInputs += `<input type="hidden" name="genericSkills[${index}][${key}]" value="${skillData[key]}">`;
        //         }
        //     });

        //     const skillHtml = `
    //         <div class="generic-skill row mb-8" id="generic-skill-${index}">
    //             ${hiddenInputs}
    //             <div class="fv-row mb-2 fv-plugins-icon-container col-lg-10 d-flex gap-7 align-items-center">
    //                 <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
    //                     <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
    //                 </button>

    //                 <select id="genericSkill[${index}]" name="genericSkills[${index}][id]"
    //                     class="form-control select-generic-skill select2-generic-skill" data-index="${index}">
    //                     <option value="${skillData.id}" selected>${skillData.competency}</option>
    //                 </select>

    //                 <input type="hidden" id="genericSkillsHidden[${index}]" 
    //                     name="genericSkills[${index}][competency]" value="${skillData.competency || ''}">
    //             </div>

    //             <div class="col-lg-2">
    //                 <button type="button" id="selectGenericLevelButton${index}" class="btn-view edit-level-btn w-100"
    //                     data-bs-toggle="modal" data-bs-target="#genericSkillModal"
    //                     onclick="genericPopulateModal(${index})">
    //                      ${skillData.preferred_level || ''}
    //                 </button>
    //             </div>
    //         </div>`;

        //     const container = document.getElementById('generic-skills-container');
        //     container.insertAdjacentHTML('beforeend', skillHtml);

        //     // Initialize Select2
        //     const selectElGeneric = $(`#genericSkill\\[${index}\\]`);
        //     selectElGeneric.select2({
        //         placeholder: 'Search Generic Skill...',
        //         ajax: {
        //             url: '/admin/master-skills/search', // Replace with your real route
        //             dataType: 'json',
        //             delay: 250,
        //             data: function (params) {
        //                 return { q: params.term };
        //             },
        //             processResults: function (data) {
        //                 return {
        //                     results: data.map(skill => ({
        //                         id: skill.id,
        //                         text: skill.name
        //                     }))
        //                 };
        //             },
        //             cache: true
        //         }
        //     });

        //     // On skill change
        //     selectElGeneric.on('change', function () {
        //         const selectedId = $(this).val();
        //         const selectedText = $(this).find('option:selected').text();
        //         $(`#genericSkillsHidden\\[${index}\\]`).val(selectedText);

        //         $.ajax({
        //             url: `/admin/master-skills/${selectedId}`, // Replace with your actual endpoint
        //             type: 'GET',
        //             success: function (skill) {
        //                 console.log("Fetched skill data", skill);
        //                 const updatedSkill = {
        //                     id: skill.id,
        //                     competency: skill.name,
        //                     description: skill.description || '',
        //                     preferred_level: '',
        //                     level_1: skill.level_1 || '',
        //                     level_1_knowledge: (skill.level_1_knowledge || '').split(';'),
        //                     level_1_ability: (skill.level_1_ability || '').split(';'),
        //                     level_2: skill.level_2 || '',
        //                     level_2_knowledge: (skill.level_2_knowledge || '').split(';'),
        //                     level_2_ability: (skill.level_2_ability || '').split(';'),
        //                     level_3: skill.level_3 || '',
        //                     level_3_knowledge: (skill.level_3_knowledge || '').split(';'),
        //                     level_3_ability: (skill.level_3_ability || '').split(';')
        //                 };
        //                 genericSkillsData[index] = updatedSkill;

        //                 // Update level button text
        //                 $(`#selectGenericLevelButton${index}`).text(`Level ${updatedSkill.preferred_level || ''}`);
        //             },
        //             error: function (err) {
        //                 console.error("Failed to fetch skill data", err);
        //             }
        //         });
        //     });

        //     // Remove event
        //     container.querySelector(`#generic-skill-${index} .remove-skill`)
        //         .addEventListener('click', function () {
        //             delete genericSkillsData[index];
        //             this.closest('.generic-skill').remove();
        //             toggleRemoveSkillButtons();
        //         });

        //     toggleRemoveSkillButtons();
        // }

        function isDuplicateSkillByName(selectedName, currentIndex) {
            return Object.entries(genericSkillsData).some(([index, skill]) => {
                return skill?.competency?.trim().toLowerCase() === selectedName?.trim().toLowerCase() &&
                    parseInt(index) !== currentIndex;
            });
        }

        function addGenericSkill(index, skill = null, allSkills = []) {
            if (!skill) return;

            const preferredGenericLvl = getLevelLabel(skill?.preferred_level);
            const skillData = {
                job_id: skill?.job_id || null,
                id: skill?.id || null,
                competency: skill?.competency || '',
                description: skill?.description || '',
                preferred_level: preferredGenericLvl || '',
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
            <div class="d-flex gap-3 w-100 flex-nowrap overflow-hidden">
 
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

        // function addNewGenericSkill(index) {
        //     const currentCount = $('.generic-skill').length;

        //     if (currentCount >= MAX_GENERIC_SKILLS) {
        //         alert(`You can only add up to ${MAX_GENERIC_SKILLS} generic skills.`);
        //         return;
        //     }
        //     const skillData = {
        //         job_id: null,
        //         id: '',
        //         competency: '',
        //         description: '',
        //         preferred_level: '',
        //         level_1: '',
        //         level_2: '',
        //         level_3: '',
        //         level_1_knowledge: [],
        //         level_1_ability: [],
        //         level_2_knowledge: [],
        //         level_2_ability: [],
        //         level_3_knowledge: [],
        //         level_3_ability: []
        //     };

        //     // Store blank initial state
        //     genericSkillsData[index] = skillData;

        //     const skillHtml = `
    //         <div class="generic-skill row mb-8" id="generic-skill-${index}">
    //             <div class="d-flex align-items-center gap-3 w-100 flex-nowrap overflow-hidden">

    //     <!-- Trash Button -->
    //     <div class="flex-shrink-0">
    //         <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center align-items-center remove-skill">
    //             <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
    //         </button>
    //     </div>

    //     <!-- Select Dropdown -->
    //     <div class="flex-grow-1 overflow-hidden">
    //         <select id="genericSkill[${index}]"
    //                 name="genericSkills[${index}][id]"
    //                 class="form-control select-generic-skill select2-generic-skill text-truncate w-100"
    //                 data-index="${index}"
    //                 title="Select Generic Skill">
    //             <option value="">Select Generic Skills</option>
    //         </select>
    //     </div>

    //     <!-- Hidden Input -->
    //     <input type="hidden" id="genericSkillsHidden[${index}]"
    //         name="genericSkills[${index}][competency]" value="">

    //     <!-- Level Button -->
    //     <div class="flex-shrink-0">
    //         <button type="button"
    //                 id="selectGenericLevelButton${index}"
    //                 class="btn-view edit-level-btn"
    //                 disabled
    //                 data-bs-toggle="modal"
    //                 data-bs-target="#genericSkillModal"
    //                 onclick="genericPopulateModal(${index})">
    //             Select a level
    //         </button>
    //     </div>

    //     </div>
    //     </div>`;

        //     $('#generic-skills-container').append(skillHtml);

        //     // Init select2
        //     $(`#genericSkill\\[${index}\\]`).select2({
        //         placeholder: 'Search Generic Skill...',
        //         ajax: {
        //             url: '/admin/master-skills/search',
        //             dataType: 'json',
        //             delay: 250,
        //             data: function(params) {
        //                 return {
        //                     q: params.term
        //                 };
        //             },
        //             processResults: function(data) {
        //                 return {
        //                     results: data.map(skill => ({
        //                         id: skill.id,
        //                         text: skill.name
        //                     }))
        //                 };
        //             },
        //             cache: true
        //         }
        //     });

        //     // Handle skill selection
        //     $(`#genericSkill\\[${index}\\]`).on('change', function() {
        //         const selectedId = $(this).val();
        //         const selectedText = $(this).find('option:selected').text();

        //         if (isDuplicateSkillByName(selectedText, index)) {
        //             alert('This generic skill is already selected.');
        //             $(this).val(null).trigger('change');
        //             $(`#genericSkillsHidden\\[${index}\\]`).val('');
        //             $(`#selectGenericLevelButton${index}`).prop('disabled', true).text('Select a level');
        //             return;
        //         }

        //         $(`#genericSkillsHidden\\[${index}\\]`).val(selectedText);

        //         // Enable Select Level button
        //         $(`#selectGenericLevelButton${index}`).prop('disabled', false);

        //         $.ajax({
        //             url: `/admin/master-skills/${selectedId}`,
        //             type: 'GET',
        //             success: function(skill) {
        //                 const updatedSkill = {
        //                     job_id: skill.job_id || null,
        //                     id: skill.id,
        //                     competency: skill.name,
        //                     description: skill.description || '',
        //                     preferred_level: skill.preferred_level || '',
        //                     level_1: skill.level_1 || '',
        //                     level_2: skill.level_2 || '',
        //                     level_3: skill.level_3 || '',
        //                     level_1_knowledge: (skill.level_1_knowledge || '').split(';'),
        //                     level_1_ability: (skill.level_1_ability || '').split(';'),
        //                     level_2_knowledge: (skill.level_2_knowledge || '').split(';'),
        //                     level_2_ability: (skill.level_2_ability || '').split(';'),
        //                     level_3_knowledge: (skill.level_3_knowledge || '').split(';'),
        //                     level_3_ability: (skill.level_3_ability || '').split(';')
        //                 };

        //                 genericSkillsData[index] = updatedSkill;

        //                 // Update hidden inputs
        //                 const skillContainer = $(`#generic-skill-${index}`);
        //                 skillContainer.find(`input[name^="genericSkills[${index}]"]`).remove();
        //                 skillContainer.prepend(generateGenericHiddenInputs(index, updatedSkill));

        //                 // Update button label
        //                 const levelLabel = updatedSkill.preferred_level ?
        //                     `Level ${updatedSkill.preferred_level}` : 'Select a level';
        //                 $(`#selectGenericLevelButton${index}`).text(levelLabel);
        //             },
        //             error: function() {
        //                 console.error("Skill fetch failed.");
        //             }
        //         });
        //     });

        //     // Remove button logic
        //     $(document).on('click', `#generic-skill-${index} .remove-skill`, function() {
        //         delete genericSkillsData[index];
        //         $(this).closest('.generic-skill').remove();
        //         toggleRemoveSkillButtons();
        //     });

        //     if ($('.generic-skill').length >= MAX_GENERIC_SKILLS) {
        //         $('#add_new_generic_skill')
        //             .prop('disabled', true)
        //             .attr('title', 'Maximum 5 generic skills allowed');
        //     }

        //     toggleRemoveSkillButtons();
        // }

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
            <div class="d-flex gap-3 w-100 flex-nowrap overflow-hidden">
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
                    <div class="text-danger mt-1 generic-skill-validation-message" style="font-size: 0.875rem; display: none;">
                        This field is required
                    </div>
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
                    data: params => ({
                        q: params.term
                    }),
                    processResults: data => ({
                        results: data.map(skill => ({
                            id: skill.id,
                            text: skill.name
                        }))
                    }),
                    cache: true
                }
            });

            $(`#genericSkill\\[${newIndex}\\]`).on('change', function() {
                //  $(this).removeClass('is-invalid');
                $(this).closest('.generic-skill')
                    .find('.is-invalid')
                    .removeClass('is-invalid');
                $(this).closest('.generic-skill').find('.generic-skill-validation-message').hide();
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

                        genericSkillsData[newIndex] = updatedSkill;

                        const container = $(`#generic-skill-${newIndex}`);
                        container.find(`input[name^="genericSkills[${newIndex}]"]`).remove();
                        container.prepend(generateGenericHiddenInputs(newIndex, updatedSkill));

                        // Enable and update the level button
                        $(`#selectGenericLevelButton${newIndex}`)
                            .prop('disabled', false)
                            .text('Select a level');

                    },
                    error: function() {
                        console.error("Skill fetch failed.");
                    }
                });
            });

            $(`#generic-skill-${newIndex} .remove-skill`).on('click', function() {
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



        // function genericPopulateModal(index, skillData) {
        //     const data = genericSkillsData[index];
        //     const preferredLevel = getPreferredLevel(skillData?.preferred_level);

        //     // let data = JSON.parse(button.getAttribute('data-skill'));
        //     console.log('genericpoopupmodal', data);

        //     // const modalBody = document.querySelector('#genericSkillModal .modalbody');
        //     // data = JSON.parse(data);
        //     console.log(data.level_1_knowledge);
        //     let modalBody = $('#genericSkillModal .modalbody');
        //     // console.log(selected_level);
        //     // console.log(level_2);
        //     modalBody.empty(); // Clear existing modal content

        //     $('#genericSkillModal .modal-title').text(data.competency);
        //     // levels.forEach(level => {
        //     modalBody.append(`
    //                 <div class="form-check col-lg-4">


    //                 <label class="form-check-label" for="level_1">
    //                     <div class="col-lg-12">
    //                             <div class="card card-stretch card-bordered mb-5">
    //                                 <div class="card-header align-items-center">
    //                                     <h3 class="card-title">Level 1</h3>
    //                                     <input class="form-check-input border-dark" type="radio" value="1" id="level_1" name="level" ${preferredLevel == 1 ? 'checked' : ''}>

    //                                 </div>
    //                                 <div class="card-body">
    //                                     <h5>${data.level_1}</h5>
    //                                     <div class="p-3">
    //                                         <h4>Knowledge</h4>
    //                                         <div class="d-flex flex-column">
    //                                         ${createListFromString(data.level_1_knowledge)}

    //                                         </div>

    //                                     </div>
    //                                     <div class="p-3">
    //                                         <h4>Ability</h4>
    //                                         <div class="d-flex flex-column">
    //                                             ${createListFromString(data.level_1_ability)}
    //                                         </div>
    //                                     </div>
    //                                 </div>

    //                             </div>
    //                     </div>
    //                 </label>
    //             </div>
    //         `);

        //     modalBody.append(`
    //         <div class="form-check col-lg-4">


    //                 <label class="form-check-label" for="level_2">
    //                     <div class="col-lg-12">
    //                             <div class="card card-stretch card-bordered mb-5">
    //                                 <div class="card-header align-items-center">
    //                                     <h3 class="card-title">Level 2</h3>
    //                                 <input class="form-check-input border-dark" type="radio" value="2" id="level_2" name="level" ${preferredLevel == 2 ? 'checked' : ''}>


    //                                 </div>
    //                                 <div class="card-body">
    //                                     <h5>${data.level_2}</h5>
    //                                     <div class="p-3">
    //                                         <h4>Knowledge</h4>
    //                                         <div class="d-flex flex-column">
    //                                         ${createListFromString(data.level_2_knowledge)}

    //                                         </div>

    //                                     </div>
    //                                     <div class="p-3">
    //                                         <h4>Ability</h4>
    //                                         <div class="d-flex flex-column">
    //                                         ${createListFromString(data.level_2_ability)}
    //                                         </div>
    //                                     </div>
    //                                 </div>

    //                             </div>
    //                     </div>
    //                 </label>
    //             </div>
    //     `);

        //     modalBody.append(`
    //         <div class="form-check col-lg-4">


    //                 <label class="form-check-label" for="level_3">
    //                     <div class="col-lg-12">
    //                             <div class="card card-stretch card-bordered mb-5">
    //                                 <div class="card-header align-items-center">
    //                                     <h3 class="card-title">Level 3</h3>
    //                 <input class="form-check-input border-dark" type="radio" value="3" name="level" id="level_3" ${preferredLevel == 3 ? 'checked' : ''}>

    //                                 </div>
    //                                 <div class="card-body">
    //                                     <h5>${data.level_3}</h5>
    //                                     <div class="p-3">
    //                                         <h4>Knowledge</h4>
    //                                         <div class="d-flex flex-column">
    //                                             ${createListFromString(data.level_3_knowledge)}

    //                                         </div>

    //                                     </div>
    //                                     <div class="p-3">
    //                                         <h4>Ability</h4>
    //                                         <div class="d-flex flex-column">
    //                                         ${createListFromString(data.level_3_ability)}
    //                                         </div>
    //                                     </div>
    //                                 </div>

    //                             </div>
    //                     </div>
    //                 </label>
    //             </div>
    //     `);

        //     $('#kt_modal_2 .save-btn').data('skill-id', index); // Set skill ID on save button for later
        // }

        //         function genericPopulateModal(index, skillData) {
        //     const data = genericSkillsData[index];
        //     const preferredLevel = getPreferredLevel(data?.preferred_level);

        //     const modalBody = $('#genericSkillModal .modalbody');
        //     modalBody.empty();

        //     $('#genericSkillModal .modal-title').text(data.competency || 'Generic Skill');

        //     for (let i = 1; i <= 3; i++) {
        //         const description = data[`level_${i}`] || 'Description Not Found';
        //         const knowledge = data[`level_${i}_knowledge`] || [];
        //         const ability = data[`level_${i}_ability`] || [];

        //         const isSelected = preferredLevel === i;
        //         const isEmpty = !description || description.trim() === '';

        //         const checkedAttr = isSelected ? 'checked' : '';
        //         const disabledAttr = isEmpty ? 'disabled' : '';
        //         const activeCard = isSelected ? 'card-checked-orange' : '';
        //         const headerHighlight = isSelected ? 'header-checked-orange' : '';
        //         const labelDim = isEmpty ? 'disabled-label' : '';
        //         const onclickAttr = isEmpty ? '' : `onclick="updateSelectedLevel(${i})"`;

        //         modalBody.append(`
    //             <div class="form-check col-lg-4">
    //                 <label class="form-check-label h-100 w-100 ${labelDim}" for="level_${i}">
    //                     <div class="col-lg-12 h-100">
    //                         <div class="card card-stretch card-bordered mb-5 h-100 ${activeCard}">
    //                             <div class="card-header align-items-center ${headerHighlight}">
    //                                 <h3 class="card-title">Level ${i}</h3>
    //                                 <input class="form-check-input border-dark" type="radio" 
    //                                     value="${i}" id="level_${i}" name="level" ${checkedAttr} ${disabledAttr} ${onclickAttr}>
    //                             </div>
    //                             <div class="card-body">
    //                                 <h5 class="fs-6">${description}</h5>
    //                                 <div class="p-3">
    //                                     <h4 class="fs-6">Knowledge</h4>
    //                                     <div class="d-flex flex-column">
    //                                         ${createListFromString(knowledge)}
    //                                     </div>
    //                                 </div>
    //                                 <div class="p-3">
    //                                     <h4 class="fs-6">Ability</h4>
    //                                     <div class="d-flex flex-column">
    //                                         ${createListFromString(ability)}
    //                                     </div>
    //                                 </div>
    //                             </div>
    //                         </div>
    //                     </div>
    //                 </label>
    //             </div>
    //         `);
        //     }

        //     $('#kt_modal_2 .save-btn').data('skill-id', index); // Save index for later use
        // }

        // function genericPopulateModal(index) {
        //     const data = genericSkillsData[index];
        //     const preferredLevel = getPreferredLevel(data?.preferred_level);

        //     const modalBody = $('#genericSkillModal .modalbody');
        //     modalBody.empty();

        //     $('#genericSkillModal .modal-title').text(data.competency || 'Generic Skill');

        //     for (let i = 1; i <= 3; i++) {
        //         const description = data[`level_${i}`] || '';
        //         const knowledge = data[`level_${i}_knowledge`] || [];
        //         const ability = data[`level_${i}_ability`] || [];

        //         const isSelected = preferredLevel === i;
        //         // const isEmpty = !description || description.trim() === '';
        //         const isEmpty = (knowledge.length === 0 && ability.length === 0);

        //         const checkedAttr = isSelected ? 'checked' : '';
        //         const disabledAttr = isEmpty ? 'disabled' : '';
        //         const activeCard = isSelected ? 'card-checked-orange' : '';
        //         const headerHighlight = isSelected ? 'header-checked-orange' : '';
        //         const labelDim = isEmpty ? 'disabled-label' : '';
        //         const onclickAttr = isEmpty ? '' : `onclick="updateGenericLevel(${i}, ${index})"`;

        //         modalBody.append(`
    //     <div class="form-check col-lg-4">
    //         <label class="form-check-label h-100 w-100 ${labelDim}" for="level_${i}">
    //             <div class="col-lg-12 h-100">
    //                 <div class="card card-stretch card-bordered mb-5 h-100 ${activeCard}">
    //                     <div class="card-header align-items-center ${headerHighlight}">
    //                         <h3 class="card-title">${getLevelLabel(i)}</h3>
    //                         <input class="form-check-input border-dark" type="radio" 
    //                             value="${i}" id="level_${i}" name="level" ${checkedAttr} ${disabledAttr} ${onclickAttr}>
    //                     </div>
    //                     <div class="card-body">
    //                         <h5 class="fs-6">${description || 'No Description'}</h5>
    //                         <div class="p-3">
    //                             <h4 class="fs-6">Knowledge</h4>
    //                             <div class="d-flex flex-column">
    //                                 ${createListFromString(knowledge)}
    //                             </div>
    //                         </div>
    //                         <div class="p-3">
    //                             <h4 class="fs-6">Ability</h4>
    //                             <div class="d-flex flex-column">
    //                                 ${createListFromString(ability)}
    //                             </div>
    //                         </div>
    //                     </div>
    //                 </div>
    //             </div>
    //         </label>
    //     </div>
    // `);
        //     }

        //     $('#genericSkillModal .save-btn').data('skill-id', index);
        // }

        function genericPopulateModal(index) {
            const data = genericSkillsData[index];

            if (!data || !data.competency) {
                alert('Skill data missing or not selected.');
                return;
            }

            temporaryGenericLevelSelection[index] = null;

            const preferredLevel = getPreferredLevel(data?.preferred_level);
            const modalBody = $('#genericSkillModal .modalbody');
            modalBody.empty();
            $('#genericSkillModal .modal-title').text(data.competency || 'Generic Skill');

            for (let i = 1; i <= 3; i++) {
                const description = data[`level_${i}`] || data['description'] || '';
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
                <label class="form-check-label h-100 w-100 ${labelDim}" for="generic_level_${i}">
                    <div class="col-lg-12 h-100">
                        <div class="card card-stretch card-bordered mb-5 h-100 ${activeCard}">
                            <div class="card-header align-items-center ${headerHighlight}">
                                <h3 class="card-title">${getLevelLabel(i)}</h3>
                                <input class="form-check-input border-dark" type="radio" 
                                    value="${i}" id="generic_level_${i}" name="generic_level" ${checkedAttr} ${disabledAttr} ${onclickAttr}>
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

            // Bind change event after DOM is rendered
            $('#genericSkillModal input[name="generic_level"]').on('change', function() {
                $('#genericSkillModal .save-btn').prop('disabled', false);
            });

            $('#genericSkillModal .save-btn').data('skill-id', index);
        }

        $('#genericSkillModal').on('hidden.bs.modal', function() {
            $('#genericSkillModal .save-btn').prop('disabled', true);
            temporaryGenericLevelSelection = {};
        });


        // Add Save button event
        // const saveButton = document.querySelector('#genericSkillModal .save-btn');
        // if(saveButton){
        //     saveButton.onclick = function() {
        //     const selectedLevel = document.querySelector(
        //         '#genericSkillModal input[name="selected_generic_level"]:checked').value;
        //     document.querySelector(`#genericLevel\\[${index}\\]`).value =
        //         selectedLevel; // Update the level dropdown
        //     $('#genericSkillModal').modal('hide'); // Close the modal
        // };
        // }
    </script>

    {{-- <script>
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

                console.log('first', selectedOption);


                if (selectedOption === 'custom') {
                    const newSkillData = JSON.parse(JSON.stringify(skillData));
                    newSkillData.is_custom = 2;
                    technicalSkillsData[skillIndex] = newSkillData;

                    renderInlineSkillEdit(skillIndex, 'Company Skill'); // <-- ✅ Call this directly
                    return; // Prevent fallback to any other logic
                }

                if (selectedOption === 'master') {
                    const newSkillData = JSON.parse(JSON.stringify(skillData));
                    newSkillData.is_custom = 2;
                    technicalSkillsData[skillIndex] = newSkillData;

                    triggerOverwriteConfirmAfterSave = true;

                    // ✅ This is where you trigger it for master selection
                    renderInlineSkillEdit(skillIndex, 'Company Skill');
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
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // enable Proceed when radio picked
            document.querySelectorAll('input[name="jdOption"]').forEach(r => {
                r.addEventListener('change', () => {
                    document.getElementById('proceedCompanySkillBtn').disabled = false;
                });
            });

            // reset modal
            document.getElementById('CompanyTechnicalSkill')
                .addEventListener('hidden.bs.modal', function() {
                    document.querySelectorAll('input[name="jdOption"]').forEach(r => r.checked = false);
                    document.getElementById('proceedCompanySkillBtn').disabled = true;
                });

            // unified proceed handler
            document.getElementById('proceedCompanySkillBtn')
                .addEventListener('click', function() {
                    const selected = document.querySelector('input[name="jdOption"]:checked');
                    const modalEl = document.getElementById('CompanyTechnicalSkill');
                    const modal = bootstrap.Modal.getInstance(modalEl);
                    const skillIndex = parseInt(modalEl.getAttribute('data-skill-index'));
                    if (!selected || Number.isNaN(skillIndex)) return;

                    modal?.hide();

                    const val = selected.value; // 'custom' | 'master'
                    const skill = technicalSkillsData[skillIndex];
                    const copy = JSON.parse(JSON.stringify(skill));
                    copy.is_custom = 2; // company skill
                    delete copy.is_modify;
                    // important: mark intent so accept-btn knows to open overwrite modal
                    copy._pendingOverwrite = (val === 'master');
                    technicalSkillsData[skillIndex] = copy;

                    // open inline editor
                    renderInlineSkillEdit(skillIndex, 'Company Skill', val);
                });
        });
    </script>


    {{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const proceedBtn = document.getElementById('proceedCompanySkillBtn');
    
        proceedBtn.addEventListener('click', function () {
            const selectedOption = document.querySelector('input[name="jdOption"]:checked');
            const skillIndex = parseInt(document.getElementById('CompanyTechnicalSkill').getAttribute('data-skill-index'));
    
            if (!selectedOption || !skillIndex) return;
    
            const skillData = technicalSkillsData[skillIndex];
            const skillRow = document.getElementById(`skill-${skillIndex}`);
    
            const modal = bootstrap.Modal.getInstance(document.getElementById('CompanyTechnicalSkill'));
            modal?.hide();
    
            if (selectedOption.value === 'custom') {
                // Trigger inline edit UI logic here
                renderInlineSkillEdit(skillIndex, 'Company Skill');
            } else if (selectedOption.value === 'master') {
                // Optionally show master overwrite modal or message
                const editModal = new bootstrap.Modal(document.getElementById('OverwriteCompanySkillConfirmModal'));
                document.getElementById('OverwriteCompanySkillConfirmModal').setAttribute('data-skill-index', skillIndex);
                editModal.show();
            }
        });
    });

    </script>
    
    <script>
    document.getElementById('proceedCompanySkillBtn').addEventListener('click', function () {
    const skillIndex = parseInt(document.getElementById('CompanyTechnicalSkill').getAttribute('data-skill-index'));
    const skillIdInput = document.querySelector(`input[name="technicalSkills[${skillIndex}][skill_id]"]`);
    const skillId = skillIdInput?.value;

    if (!skillId) {
        alert('Skill ID not found');
        return;
    }

    // Optional: set skill name in header or anywhere
    const skillName = document.querySelector(`input[name="technicalSkills[${skillIndex}][name]"]`)?.value;
    const skillNameTarget = document.getElementById('overwriteCompanySkillName');
    if (skillName && skillNameTarget) {
        skillNameTarget.textContent = skillName;
    }

    // Fetch job titles from backend
    fetch(`/admin/get-jobs-by-skill/${skillId}`) // Change URL to match your backend
        .then(res => res.json())
        .then(data => {
            const jobTitles = data.map(job => job.title).join(', ');
            document.getElementById('affectedJobList').textContent = jobTitles || 'No job titles associated.';
            
            const modalEl = document.getElementById('OverwriteCompanySkillConfirmModal');
            modalEl.setAttribute('data-skill-index', skillIndex);
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        })
        .catch(error => {
            console.error(error);
            document.getElementById('affectedJobList').textContent = 'Failed to load job titles.';
        });
    });

    </script> --}}


    {{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
    const proceedBtn = document.getElementById('proceedCompanySkillBtn');

    proceedBtn.addEventListener('click', function () {
        const selectedOption = document.querySelector('input[name="jdOption"]:checked');
        const skillIndex = parseInt(document.getElementById('CompanyTechnicalSkill').getAttribute('data-skill-index'));

        if (!selectedOption || isNaN(skillIndex)) return;

        const skillData = technicalSkillsData[skillIndex];
        const skillRow = document.getElementById(`skill-${skillIndex}`);
        const modal = bootstrap.Modal.getInstance(document.getElementById('CompanyTechnicalSkill'));
        modal?.hide();

        if (selectedOption.value === 'custom') {
            renderInlineSkillEdit(skillIndex, 'Company Skill');
        } else if (selectedOption.value === 'master') {
            showOverlay();

            const skillIdInput = document.querySelector(`input[name="technicalSkills[${skillIndex}][skill_id]"]`);
            const skillId = skillIdInput?.value;

            if (!skillId) {
                alert('Skill ID not found');
                hideOverlay();
                return;
            }

            const skillName = document.querySelector(`input[name="technicalSkills[${skillIndex}][name]"]`)?.value;
            const skillNameTarget = document.getElementById('overwriteCompanySkillName');
            if (skillName && skillNameTarget) {
                skillNameTarget.textContent = skillName;
            }

            fetch(`/admin/get-jobs-by-skill/${skillId}`)
                .then(res => res.json())
                .then(data => {
                    const jobTitles = data.map(job => job.title).join(', ');
                    document.getElementById('affectedJobList').textContent = jobTitles || 'No job titles associated.';

                    const previousModalEl = document.getElementById('CompanyTechnicalSkill');
                    const newModalEl = document.getElementById('OverwriteCompanySkillConfirmModal');
                    newModalEl.setAttribute('data-skill-index', skillIndex);

                    // Clean up previous listener first
                    $('#CompanyTechnicalSkill').off('hidden.bs.modal');

                    // Rebind one-time event to show the next modal
                    $('#CompanyTechnicalSkill').one('hidden.bs.modal', function () {
                        const newModal = new bootstrap.Modal(newModalEl);
                        newModal.show();
                    });

                    const previousModal = bootstrap.Modal.getInstance(previousModalEl);
                    previousModal?.hide();

                    // Clean up backdrop
                    setTimeout(() => {
                        if (!$('.modal.show').length) {
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                        }
                    }, 300);

                    hideOverlay();
                })
                .catch(error => {
                    console.error(error);
                    document.getElementById('affectedJobList').textContent = 'Failed to load job titles.';
                    hideOverlay();
                });
        }
    });
    });

    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const proceedBtn = document.getElementById('proceedCompanySkillBtn');

            proceedBtn.addEventListener('click', function() {
                const selectedOption = document.querySelector('input[name="jdOption"]:checked');
                const skillIndex = parseInt(document.getElementById('CompanyTechnicalSkill').getAttribute(
                    'data-skill-index'));

                if (!selectedOption || isNaN(skillIndex)) return;

                const selectedValue = selectedOption.value;

                console.log('second', selectedOption);


                const skillData = technicalSkillsData[skillIndex];
                const modal = bootstrap.Modal.getInstance(document.getElementById('CompanyTechnicalSkill'));
                modal?.hide();

                // 👇 Force overwrite option to trigger inline edit
                if (selectedOption.value === 'master') {
                    skillData.is_custom = 2; // Mark as a company-defined custom skill
                    technicalSkillsData[skillIndex] = skillData;
                    console.log(selectedValue);

                    renderInlineSkillEdit(skillIndex, 'Company Skill', selectedValue);
                    return;
                }

                // Fallback if needed (for 'custom' or future options)
                if (selectedOption.value === 'custom') {
                    skillData.is_custom = 2;
                    technicalSkillsData[skillIndex] = skillData;

                    renderInlineSkillEdit(skillIndex, 'Company Skill', selectedValue);
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
                // if (positionCodeInput) {
                //     positionCodeInput?.value = positionCode;
                // }
            }
        };
    </script>

    {{-- <script>
    $(document).ready(function() {
        $('#riasec').select2({
            closeOnSelect: false
        });

        $('#generate-riasec').on('click', function() {
            // Example response, replace this with your actual AJAX call
            const jobRole = $('#job_role').val().trim();

            // Check if job role is empty
            if (!jobRole) {
                alert('Please enter a job role.');
                return;
            }



            // Perform the AJAX call
            showOverlay(); 

            $.ajax({
                url: '{{ route('jobs.generateRiasecCode') }}', // Replace with your actual endpoint
                type: 'GET',
                data: {
                    job_role: jobRole
                },
                success: function(response) {
                    // Example response: 'RIA'
                    // Clear existing selections
                    $('#riasec').val([]).trigger('change');

                    // Convert the response string to an array of single characters
                    const riasecArray = response.riasec_codes[0].split('');

                    // Select the options that match the response
                    riasecArray.forEach(function(code) {
                        $('#riasec option').each(function() {
                            if ($(this).val() === code) {
                                $(this).prop('selected', true).trigger(
                                    'change');
                            }
                        });
                    });
                    hideOverlay();

                },
                error: function() {
                    hideOverlay();

                    alert('Failed to retrieve RIASEC codes.');
                }
            });


            // Convert the response string to an array of single characters
            const riasecArray = response.split('');

            // Select the options that match the response
            riasecArray.forEach(function(code) {
                $('#riasec option').each(function() {
                    if ($(this).val() === code) {
                        $(this).prop('selected', true).trigger('change');
                    }
                });
            });
        });

        $('#riasec').on('change', function() {
            if ($(this).val().length > 3) {
                alert('You can only select a maximum of 3 options.');
                // Deselect the last selected option
                let selectedValues = $(this).val();
                selectedValues.pop(); // Remove the last selected value
                $(this).val(selectedValues).trigger('change'); // Update select2 with new values
            }
        });
    });
    </script> --}}

    {{-- <script>
    $(document).ready(function () {
        $('#riasec').select2({ closeOnSelect: false });

        // 1. Show modal on button click
        $('#generate-riasec').on('click', function () {
            $('#generateRIASECJR').modal('show');
        });

        // 2. Handle AJAX on proceed
        $('#proceedBtn').on('click', function () {
            const jobRole = $('#job_role').val().trim();
            if (!jobRole) {
                alert('Please enter a job role.');
                return;
            }

            showOverlay();

            $.ajax({
                url: '{{ route('jobs.generateRiasecCode') }}',
                type: 'GET',
                data: { job_role: jobRole },
                success: function (response) {
                    $('#riasec').val([]).trigger('change');
                    const riasecArray = response.riasec_codes[0].split('');

                    riasecArray.forEach(function (code) {
                        $('#riasec option').each(function () {
                            if ($(this).val() === code) {
                                $(this).prop('selected', true).trigger('change');
                            }
                        });
                    });

                    hideOverlay();
                    $('#generateRIASECJR').modal('hide');
                },
                error: function () {
                    hideOverlay();
                    alert('Failed to retrieve RIASEC codes.');
                }
            });
        });

        // 3. Limit selections to 3
        $('#riasec').on('change', function () {
            if ($(this).val().length > 3) {
                alert('You can only select a maximum of 3 options.');
                let selectedValues = $(this).val();
                selectedValues.pop();
                $(this).val(selectedValues).trigger('change');
            }
        });
    });
    </script> --}}

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

            // RIASEC functionality is now handled by the riasec-selector component

        });
    </script>


    {{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const continueEditBtn = document.getElementById('continueEditSkillBtn');
    
        continueEditBtn.addEventListener('click', function () {
            const skillIndex = document.getElementById('EditTsfromMSL').getAttribute('data-skill-index');
            const skillData = technicalSkillsData[skillIndex];
            const skillRow = document.getElementById(`skill-${skillIndex}`);
    
            if (!skillRow || !skillData) return;
    
            // Save original HTML in case of cancel
            const originalHTML = skillRow.innerHTML;
    
            // Build the editable card with reset buttons
            skillRow.innerHTML = `
                <div class="d-flex justify-content-between w-100 align-items-start">
                    <div class="d-flex align-items-start gap-3 col-lg-10">
                        <!-- Check & Cancel -->
                        <div class="d-flex flex-column gap-2 pt-2">
                            <button class="btn btn-light border border-warning text-warning accept-btn" style="width: 30px; height: 30px; padding: 0;">
                                <iconify-icon icon="ic:round-check" width="18" height="18"></iconify-icon>
                            </button>
                            <button class="btn btn-light border text-muted cancel-btn" style="width: 30px; height: 30px; padding: 0;">
                                <iconify-icon icon="ic:round-close" width="18" height="18"></iconify-icon>
                            </button>
                        </div>
    
                        <!-- Content -->
                        <div class="w-100">
                            <div class="d-flex align-items-center gap-2 mb-2 position-relative">
                                <input type="text" class="form-control" name="technicalSkills[${skillIndex}][name]" 
                                    value="${skillData.name}" 
                                    data-original="${skillData.name}">
                                <button class="reset-btn position-absolute top-0 end-0 mt-2 me-2" type="button">
                                    <iconify-icon icon="grommet-icons:power-reset" width="16" height="16"></iconify-icon>
                                </button>
                                <span class="badge border text-muted px-2" style="background-color: #E3F7FF; color: #125A78;">
                                    Master Skill Library
                                </span>
                                <span class="badge border text-muted px-2" style="background-color: #F1F1F4; color: #4B5675;">
                                    ${skillData.sector_name || 'N/A'}
                                </span>
                            </div>
                            <div class="position-relative">
                                <textarea class="form-control" rows="2" name="technicalSkills[${skillIndex}][description]" 
                                    data-original="${skillData.description || 'N/A'}">${skillData.description || 'N/A'}</textarea>
                                <button class="reset-btn position-absolute top-0 end-0 mt-2 me-2" type="button">
                                    <iconify-icon icon="grommet-icons:power-reset" width="16" height="16"></iconify-icon>
                                </button>
                            </div>
                        </div>
                    </div>
    
                    <!-- Right: Edit Level Button -->
                    <div class="col-lg-2 d-flex flex-column align-items-end gap-2">
                        <button type="button" class="btn btn-outline btn-sm text-warning border-warning edit-level-btn"
                            data-bs-toggle="modal" data-bs-target="#tsEditLevel"
                            onclick="openTSEditLevelModal(${skillIndex})">
                            Edit Level
                            <iconify-icon icon="lucide:edit" width="16" height="16"></iconify-icon>
                        </button>
                    </div>
                </div>
            `;
    
            // Cancel: revert back to original layout
            skillRow.querySelector('.cancel-btn').addEventListener('click', function () {
                skillRow.innerHTML = originalHTML;
            });
    
            // Accept: disable buttons to finalize state
            skillRow.querySelector('.accept-btn').addEventListener('click', function () {
                this.closest('.accept-btn').disabled = true;
                this.closest('.cancel-btn').disabled = true;
            });
    
            // Reset logic: revert input/textarea to original content
            skillRow.querySelectorAll('.reset-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const input = btn.parentElement.querySelector('input, textarea');
                    if (input && input.dataset.original !== undefined) {
                        input.value = input.dataset.original;
                    }
                });
            });
    
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('EditTsfromMSL'));
            modal.hide();
        });
    });
    </script> --}}

    {{-- <script>
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
                if (skillData.is_custom == 1 || skillData.is_custom == 2) {
                    technicalSkillType = 'Company Skill';
                } else {
                    technicalSkillType = 'Master Skill';
                }
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
                                                                    ${skillData.is_custom == 2 || skillData.is_custom == 1
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

                        <div class="d-flex gap-3 w-100 flex-nowrap overflow-hidden">
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
                        <option value="${skill.skill_id}" selected>${skill.name} (${technicalSkillType} - ${skill?.category_name || skill.sub_sector_name || ''})</option>
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
                            
                            // Refresh comparison if active
                            if (comparisonActive) {
                                const ajaxResponse = @json($cachedData);
                                let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                                  .masterTechnicalSkills.length > 0 ?
                                  ajaxResponse.masterTechnicalSkills :
                                  (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : []);
                                const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : [];
                                const currentFormSkills = getCurrentFormSkills();

                                const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                                
                                // Handle validation errors
                                if (comparison.status === 'validation_error') {
                                  console.warn('Validation Error:', comparison.message);
                                } else {
                                  renderComparison(comparison.comparisonResults);
                                  showComparisonSummary(comparison.comparisonResults);
                                }
                            }
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

                    // Dynamically check the description for the given preferred_level
                    let levelDescriptionKey = `level_${skill.preferred_level}_description`;  // e.g., level_3_description for preferred_level = 3
                    let levelDescription = skill[levelDescriptionKey] || '';  // Get the description or empty if not found

                    // If no valid level description exists, reset preferred_level to '' (or 'Select Level')
                    if (!levelDescription) {
                        skill.preferred_level = ''; // Reset to empty if no description found
                    }

                    // Sync JSON
                    document.getElementById('technicalSkillsJson').value = JSON.stringify(
                        technicalSkillsData);

                        console.log(skill);

                    // Re-render with select + hidden input
                    skillRow.outerHTML = `
<div class="technical-skill row mb-8" id="skill-${skillIndex}">
                        <input type="hidden" name="technicalSkills[${skillIndex}][description]" value="${skill.description}">
                        <input type="hidden" name="technicalSkills[${skillIndex}][sector_name]" value="${skill.sector_name || ''}">
                        <input type="hidden" name="technicalSkills[${skillIndex}][preferred_level]" value="${skill.preferred_level || 1}">

                        <div class="d-flex gap-3 w-100 flex-nowrap overflow-hidden">
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
                                    <option value="${skill.skill_id}" selected>${skill.name}${isRenamed ? ' (New Skill)' : ` (${technicalSkillType} - ${skill.category_name || skill.sub_sector_name || ''})`}</option>
                                </select>
                            </div>
                            <input type="hidden" id="technicalSkillsHidden[${skillIndex}]" 
                                name="technicalSkills[${skillIndex}][name]" value="${skill.name}">
                            <div class="flex-shrink-0">
                                <button type="button" id="selectTechLevelButton${skillIndex}" class="btn-view edit-level-btn" 
                                    data-bs-toggle="modal" data-bs-target="#techskillmodal" 
                                    onclick="technicalpopulateModal(${skillIndex})">
                                    ${skill.preferred_level ? `Level ${skill.preferred_level}` : "Select Level"}
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
                            
                            // Refresh comparison if active
                            if (comparisonActive) {
                                const ajaxResponse = @json($cachedData);
                                let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                                  .masterTechnicalSkills.length > 0 ?
                                  ajaxResponse.masterTechnicalSkills :
                                  (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : []);
                                const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : [];
                                const currentFormSkills = getCurrentFormSkills();

                                const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                                
                                // Handle validation errors
                                if (comparison.status === 'validation_error') {
                                  console.warn('Validation Error:', comparison.message);
                                } else {
                                  renderComparison(comparison.comparisonResults);
                                  showComparisonSummary(comparison.comparisonResults);
                                }
                            }
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
    </script> --}}

    <script>
        function dupCheckSkill(name, sectorName, categoryName) {
            showOverlay();
  return $.ajax({
    url: '{{ route("admin.technical-skill.dup-check") }}', // backend route that returns {exists: bool, message?: string}
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    data: { name, sector_name: sectorName, category_name: categoryName }
  });
}

// inline error under the name input
function showInlineNameError(skillRow, skillIndex, msg) {
  const nameInput = skillRow.querySelector(`input[name="technicalSkills[${skillIndex}][name]"]`);
  if (!nameInput) return;

  const fieldShell = nameInput.closest('.position-relative.form-control') || nameInput;
  fieldShell.classList.add('is-invalid');
//   nameInput.classList.add('is-invalid');

  let err = fieldShell.nextElementSibling;
  if (!err || !err.classList.contains('inline-error')) {
    err = document.createElement('div');
    err.className = 'inline-error';
    fieldShell.insertAdjacentElement('afterend', err);
  }
  err.textContent = msg || 'Company technical skill title already exists in this sector and category. Please enter a different one.';

  const acceptBtn = skillRow.querySelector('.accept-btn');
  if (acceptBtn) acceptBtn.disabled = true;

  const clear = () => {
    fieldShell.classList.remove('is-invalid');
    // nameInput.classList.remove('is-invalid');
    if (err && err.parentNode) err.parentNode.removeChild(err);
    if (acceptBtn) acceptBtn.disabled = false;
    nameInput.removeEventListener('input', clear);
  };
  nameInput.addEventListener('input', clear);
  nameInput.focus();
}
        function wireResetButtonsForRow(skillRowEl) {
  // 1) optional: normalization (keep if you want to ignore "(...-...)" chunks)
  const normalize = (s) => String(s ?? '')
    .replace(/\s*\([^)]*-[^)]*\)\s*/g, '')
    .trim();

  // 2) disable all reset buttons initially
  skillRowEl.querySelectorAll('.reset-btn').forEach(btn => { btn.disabled = true; });

  // 3) helper: find the reset button that pairs with a given field (walk up to a container that has a reset-btn)
  function findPairedResetBtn(field) {
    let node = field.parentElement;
    while (node && node !== skillRowEl) {
      const btn = node.querySelector('.reset-btn');
      if (btn) return btn;
      node = node.parentElement;
    }
    return null;
  }

  // 4) keep originals—if missing, set them now to current values
  skillRowEl.querySelectorAll('input[name^="technicalSkills"], textarea[name^="technicalSkills"]').forEach(field => {
    if (field.dataset.original === undefined) {
      field.dataset.original = field.value ?? '';
    }
  });

  // 5) delegated change detection (input + change)
  function syncForField(field) {
    const btn = findPairedResetBtn(field);
    if (!btn) return;
    const original = field.dataset.original ?? '';
    btn.disabled = (normalize(field.value) === normalize(original));
  }

  skillRowEl.addEventListener('input', (e) => {
    const el = e.target;
    if (!(el.matches('input[name^="technicalSkills"]') || el.matches('textarea[name^="technicalSkills"]'))) return;
    syncForField(el);
  });

  skillRowEl.addEventListener('change', (e) => {
    const el = e.target;
    if (!(el.matches('input[name^="technicalSkills"]') || el.matches('textarea[name^="technicalSkills"]'))) return;
    syncForField(el);
  });

  // 6) delegated reset click
 skillRowEl.addEventListener('click', (e) => {
  const btn = e.target.closest('.reset-btn');
  if (!btn || !skillRowEl.contains(btn)) return;

  // find paired field
  let field = btn.parentElement.querySelector('input, textarea');
  if (!field) {
    // fallback: search upward for nearest input/textarea
    let node = btn.parentElement;
    while (node && node !== skillRowEl) {
      const f = node.querySelector('input, textarea');
      if (f) { field = f; break; }
      node = node.parentElement;
    }
  }

  if (field && field.dataset.original !== undefined) {
    let original = field.dataset.original;

    // same normalization you had
    original = original.replace(/\s*\([^)]*-[^)]*\)\s*/g, '').trim();

    field.value = original;

    // trigger input so your "enable/disable" logic updates
    field.dispatchEvent(new Event('input', { bubbles: true }));
    field.focus();
  }
});

  // 7) initial sync (keeps them disabled if no edits yet)
  skillRowEl.querySelectorAll('input[name^="technicalSkills"], textarea[name^="technicalSkills"]').forEach(syncForField);
}
        document.addEventListener('DOMContentLoaded', function() {
            // const continueEditBtn = document.getElementById('continueEditSkillBtn');
            document.querySelectorAll('.continueEditSkillBtn').forEach(btn => {

            btn.addEventListener('click', function() {
                // const skillIndex = parseInt(document.getElementById('EditTsfromMSL').getAttribute(
                //     'data-skill-index'));
                // Jis modal se ye button belong karta hai
            const modal = btn.closest('.modal');

            // modal me jo data-skill-index set hua tha usko lo
            const skillIndex = parseInt(modal.getAttribute('data-skill-index'));
                const skillData = technicalSkillsData[skillIndex];
                const skillRow = document.getElementById(`skill-${skillIndex}`);

                console.log('skillData:', skillData);
                console.log('skillIndex:', skillIndex);

                if (!skillRow || !skillData) return;

                const originalSkillData = JSON.parse(JSON.stringify(skillData));

                const originalHTML = skillRow.innerHTML;
                console.log('skillData:', skillData);
                const name = cleanLabel(skillData.name);

                skillRow.innerHTML = `
                <div class="d-flex justify-content-between align-items-start pl-0 gap-3">
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
                                <div class="d-flex align-items-center gap-2 w-100 justify-content-between">
                                <input type="text" class="form-control p-0 border-0 h-auto span-truncate" name="technicalSkills[${skillIndex}][name]"
                                    value="${name}"
                                    data-original="${skillData.name}">
                                    <div class="d-flex align-items-center gap-2">
                                                                    ${skillData.is_custom == 2
                                ? `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-title="Company Skill">Company Skill</span>`
                                : `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-title="Master Skill">Master Skill</span>`
                                }
                                <span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-title="${skillData.sector_name || 'N/A'}">${skillData.sector_name || 'N/A'}</span>
                                <span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-title="${skillData.category_name || 'N/A'}">${skillData.category_name || 'N/A'}</span>
                                </div>
                                </div>
                                <button class="reset-btn" type="button" disabled>
                                    <iconify-icon icon="grommet-icons:power-reset" width="16" height="16"></iconify-icon>
                                </button>
                            </div>
                            <div class="position-relative">
                                <textarea class="form-control pr-5" rows="2" name="technicalSkills[${skillIndex}][description]"
                                    data-original="${skillData.description || 'N/A'}">${skillData.description || 'N/A'}</textarea>
                                <button class="reset-btn position-absolute top-0 end-0 mt-4 me-3" type="button" disabled>
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
            if (typeof afterEditModeOpen === 'function') afterEditModeOpen(skillRow);
            wireResetButtonsForRow(skillRow);

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

            <div class="d-flex gap-3 w-100 flex-nowrap overflow-hidden">
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
                         ${skill.preferred_level ? `Level ${skill?.preferred_level}` : 'Select Level'}
                    </button>
                </div>
            </div>
        </div>

    `;

                    // Re-initialize Select2
                    setTimeout(() => {
                        const newSkillRow = document.getElementById(`skill-${skillIndex}`);

                        // Re-bind Remove Button
                        newSkillRow.querySelector('.remove-skill')?.addEventListener(
                            'click',
                            function() {
                                const removeButton = this;
                                const skillElement = removeButton.closest('.technical-skill');
                                
                                // Show loading overlay while modal is prepared
                                try { if (typeof showOverlay === 'function') showOverlay(); } catch (e) {}
                                
                                // Show confirmation modal
                                ModalManager.open({
                                    module: 'jobs',
                                    key: 'delete_technical_skill',
                                    data: {},
                                    onSubmit(modalEl) {
                                        // User confirmed removal - proceed with the removal
                                        console.log("Skill removal confirmed for index:", skillIndex);
                                        
                                        delete technicalSkillsData[skillIndex];
                                        skillElement.remove();
                                        toggleRemoveSkillButtons();
                                        
                                        // Refresh comparison if active
                                        if (comparisonActive) {
                                            const ajaxResponse = @json($cachedData);
                                            let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                                              .masterTechnicalSkills.length > 0 ?
                                              ajaxResponse.masterTechnicalSkills :
                                              (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : []);
                                            const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : [];
                                            const currentFormSkills = getCurrentFormSkills();

                                            const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                                            
                                            // Handle validation errors
                                            if (comparison.status === 'validation_error') {
                                              console.warn('Validation Error:', comparison.message);
                                            } else {
                                              renderComparison(comparison.comparisonResults);
                                              showComparisonSummary(comparison.comparisonResults);
                                            }
                                        }
                                        
                                        // Close the modal and hide loading overlay
                                        const bsModal = bootstrap.Modal.getInstance(modalEl);
                                        if (bsModal) bsModal.hide();
                                        try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
                                    },
                                    onShown(modalEl) {
                                        // Hide loading overlay when modal is shown
                                        try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
                                    },
                                    onError() {
                                        // Hide loading overlay on error
                                        try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
                                    }
                                });
                            });

                        // Re-bind Edit Button
                        // newSkillRow.querySelector('.edit-skill')?.addEventListener('click',
                        //     function() {
                        $(document).off('click', '.edit-skill').on('click', '.edit-skill', function () {
                                const skillIndex = $(this).closest('.technical-skill').attr('id').replace('skill-', '');
                                const skillData = technicalSkillsData[skillIndex];


                                if (skillData.is_custom == 1 || skillData.is_custom ==
                                    2 || skillData.is_new == 1 || skillData.is_new_company_skill == 1) {
                                    const modalEl = document.getElementById(
                                        'CompanyTechnicalSkill');
                                    modalEl.setAttribute('data-skill-index',
                                        skillIndex);
                                    modalEl.querySelector('#companySkillName')
                                        .textContent = skillData.name || 'Skill';
                                    // new bootstrap.Modal(modalEl).show();
                                    showOverlay();
 
                                    $.ajax({
                                        // url: `/admin/skill-job-count/${skillData.id}`,
                                         url: `/admin/skill-job-count/${(skillData.is_new === 1 || skillData.is_new_company_skill === 1) ? null : skillData.id}`,
                                        type: "GET",
                                        dataType: "json",
                                        success: function (data) {
                                            const countEl = modalEl.querySelector('#jobCount');
                                            if (countEl) {
                                                countEl.textContent = data.job_count || 0;
                                            }
                                            hideOverlay();
                                            new bootstrap.Modal(modalEl).show();
                                        },
                                        error: function (xhr, status, error) {
                                            console.error("Error fetching job count:", error);
                                            hideOverlay();
            
                                        }
                                    });
                                } else {
                                    // const editModalEl = document.getElementById(
                                    //     'EditTsfromMSL');
                                    // editModalEl.setAttribute('data-skill-index',
                                    //     skillIndex);
                                    // new bootstrap.Modal(editModalEl).show();
                                    showOverlay();
                                    $.ajax({
                                    url: '{{ route('admin.checkSkill') }}', // Endpoint to check if skill has a master_technical_skill_id
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        data: {
                                            skill_name: skillData.name,
                                            category_name: skillData.category_name,
                                            sector_name: skillData.sector_name,
                                            is_custom: 0,
                                        },
                                        success: function(response) {
                                            hideOverlay(); 
                                            // if (response.skillExists) {
                                                if (response.hasRelatedSkill) {
                                                    const createModalEl = document.getElementById('CreateNewSkillModal');
                                                    createModalEl.setAttribute('data-skill-index', skillIndex);
                                                    new bootstrap.Modal(createModalEl).show();
                                                } else {
                                                    const editModalEl = document.getElementById('EditTsfromMSL');
                                                    editModalEl.setAttribute('data-skill-index', skillIndex);
                                                    new bootstrap.Modal(editModalEl).show();
                                                }
                                            // }else {
                                            //     hideOverlay(); 
                                            //     console.log("Skill hi nahi mila");
                                            // }
                                        },
                                        error: function(error) {
                                            hideOverlay(); 
                                            console.log('Error checking skill:', error);
                                        }
                                    });
                                }
                            });

                        const selectEl = $(`#skill\\[${skillIndex}\\]`);
                        selectEl.select2({
    ajax: {
        url: '{{ route('admin.technical-skill.search') }}',
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term,
                page: params.page || 1
            };
        },
        processResults: function(data, params) {
            params.page = params.page || 1;
            return {
                results: data.results,
                pagination: {
                    more: data.pagination.more
                }
            };
        },
        cache: true
    },
    language: {
        noResults: function () {
            return "No matches found";
        }
    },
    templateResult: function (data) {
        console.log('Data for templateResult:', data);
        if (data.loading) return data.text;
        const skillType = data.skill_type || '';
        const category = data.category || '';
        const sector   = data.sector || '';
         const name = cleanLabel(data.text); 
        return $(`
            <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
                    ${name}
                </span>
                <div class="d-flex gap-2">
                    ${skillType
                        ? skillType === 'Master Skill'
                            ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                            : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                        : ''
                    }
 
                    ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${sector || ''}">${sector}</span>` : ''}
                    ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${category || ''}">${category}</span>` : ''}
                </div>
            </div>
        `);
    },
    templateSelection: function (data) {
        console.log('Selected data:', data);
        if (!data.id) return data.text;
        const skillType = data.skill_type || '';
        const category = data.category || '';
        const sector   = data.sector || '';
         const name = cleanLabel(data.text); 
        if (skillType || sector || category) {
        return $(`
            <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
                    ${name}
                </span>
                <div class="d-flex gap-2">
                    ${skillType
                        ? skillType === 'Master Skill'
                            ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                            : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                        : ''
                    }
                    ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${sector || ''}">${sector}</span>` : ''}
                    ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${category || ''}">${category}</span>` : ''}
                </div>
            </div>
        `);
    }
        return $(`
            <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
                    ${name}
                </span>
                <div class="d-flex gap-2">
                    <span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Master Skill">Master Skill</span>
 
                    ${skill?.sector_name ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skill?.sector_name || ''}">${skill?.sector_name}</span>` : ''}
                    ${skill?.category_name ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skill?.category_name || ''}">${skill?.category_name}</span>` : ''}
                </div>
            </div>
        `);
    },
    placeholder: 'Search for a skill',
    minimumInputLength: 1,
    width: 'resolve'
});
 
// ✅ Re-init tooltips on dropdown open or selection
selectEl.on('select2:open select2:select', function () {
    $('[data-bs-toggle="tooltip"]').tooltip('dispose').tooltip();
});
// selectEl.on('change', function () {
//     const $this = $(this);
//     const selectedId   = $this.val();
//     const selectedText = $this.find('option:selected').text();

//     // extract index from the element's id e.g. "skill[3]"
//     const idMatch = $this.attr('id').match(/^skill\[(\d+)\]$/);
//     const idx = idMatch ? idMatch[1] : null;

//     if (!idx) return; // safety guard

//     if (selectedId) {
//         $(`#selectTechLevelButton${idx}`).prop('disabled', false);
//     }

//     $(`#technicalSkillsHidden\\[${idx}\\]`).val(selectedText);

//     // Fetch updated skill details
//     TechSkillChanged(idx, selectedId);
// });
selectEl.on('change', function () {
    const $this = $(this);
    const selectedId   = $this.val();
    const selectedText = $this.find('option:selected').text();

    // extract index from the element's id e.g. "skill[3]"
    const idMatch = $this.attr('id').match(/^skill\[(\d+)\]$/);
    const idx = idMatch ? idMatch[1] : null;

    if (!idx) return; // safety guard

    if (!selectedId) {
        // Reset if nothing selected
        $(`#technicalSkillsHidden\\[${idx}\\]`).val('');
        $(`#selectTechLevelButton${idx}`).prop('disabled', true);
        return;
    }

    // ⚡ Pass $this into TechSkillChanged so it can reset if duplicate
    TechSkillChanged(idx, selectedId, $this);
});

                        // selectEl.select2({
                        //     placeholder: 'Search for a skill',
                        //     width: 'resolve'
                        // });

                        // selectEl.on('change', function() {
                        //     const selectedText = $(this).find('option:selected')
                        //         .text();
                        //     $(`#technicalSkillsHidden\\[${skillIndex}\\]`).val(
                        //         selectedText);
                        // });
                    }, 10);
                });


                // Reset
                skillRow.querySelectorAll('.reset-btn').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const input = btn.parentElement.querySelector('input, textarea');
                        // if (input && input.dataset.original !== undefined) {
                        //     input.value = input.dataset.original;
                        // }
                        if (input && input.dataset.original !== undefined) {
                            // input.value = input.dataset.original;
                            let original = input.dataset.original;

                            // Remove bracketed text only if it contains a dash
                            original = original.replace(/\s*\([^)]*-[^)]*\)\s*/g, '').trim();

                            input.value = original;
                        }
                    });
                });

                function deepEqual(obj1, obj2) {
                    if (obj1 === obj2) return true;
                    if (typeof obj1 !== 'object' || typeof obj2 !== 'object' || obj1 === null || obj2 === null) {
                        return false;
                    }

                    const keys1 = Object.keys(obj1);
                    const keys2 = Object.keys(obj2);

                    if (keys1.length !== keys2.length) return false;

                    for (let key of keys1) {
                        if (!keys2.includes(key) || !deepEqual(obj1[key], obj2[key])) {
                            return false;
                        }
                    }

                    return true;
                }


                // Accept: save changes and re-render as read-only
                skillRow.querySelector('.accept-btn').addEventListener('click', function() {
                     event.preventDefault();
                    console.log('modal:', modal);
                    const nameInput = skillRow.querySelector(
                        `input[name="technicalSkills[${skillIndex}][name]"]`);
                    const descTextarea = skillRow.querySelector(
                        `textarea[name="technicalSkills[${skillIndex}][description]"]`);
                    const originalName = nameInput.dataset.original.trim();
                    const newName = nameInput.value.trim();
                    const isRenamed = originalName !== newName;

                    if (!newName || !descTextarea.value.trim()) {
                        alert('Please fill the data.');
                        return;
                    }

                    // Update technicalSkillsData
                    const skill = technicalSkillsData[skillIndex];
                    skill.name = newName;
                    skill.description = descTextarea.value.trim();

                    // if (modal && modal.id === 'CreateNewSkillModal') {
                    //     skill.is_new_company_skill = 1;
                    // }

                    // Dynamically check the description for the given preferred_level
                    let levelDescriptionKey = `level_${skill.preferred_level}_description`;  // e.g., level_3_description for preferred_level = 3
                    let levelDescription = skill[levelDescriptionKey] || '';  // Get the description or empty if not found

                    // If no valid level description exists, reset preferred_level to '' (or 'Select Level')
                    if (!levelDescription) {
                        skill.preferred_level = ''; // Reset to empty if no description found
                    }

                    console.log('Updated skill:', skill);

                    console.log('originalSkillData', originalSkillData);
                    originalSkillData.name = cleanLabel(originalSkillData.name);
                    skill.name = cleanLabel(skill.name);

                     const changesDetected = !deepEqual(originalSkillData, skill);
                     console.log('changesDetected:', changesDetected);

//                      if (changesDetected) {
//                          console.log('Changes detected, marking for overwrite if needed.');
//                          if (modal && modal.id === 'CreateNewSkillModal') {
//                             skill.is_new_company_skill = 1;
//                         }
//                          const successModal = new bootstrap.Modal(document.getElementById('SuccessModal'));
//                         //  let cleanText = skill.name.split('(')[0].trim();
//                         let cleanText = cleanLabel(skill.name);
//                          document.getElementById('SuccessModal').querySelector('#SkillName').textContent = cleanText || 'Skill';
//                         successModal.show();

//                         skill.is_new = 1;
//                         skill.preferred_level = "";
//                          // Sync JSON
//                     document.getElementById('technicalSkillsJson').value = JSON.stringify(
//                         technicalSkillsData);


//                     // Re-render with select + hidden input
//                     skillRow.outerHTML = `
//                     <div class="technical-skill row mb-8" id="skill-${skillIndex}">
//                         <input type="hidden" name="technicalSkills[${skillIndex}][description]" value="${skill.description}">
//                         <input type="hidden" name="technicalSkills[${skillIndex}][sector_name]" value="${skill.sector_name || ''}">
//                         <input type="hidden" name="technicalSkills[${skillIndex}][preferred_level]" value="${skill.preferred_level || 1}">

//                         <div class="d-flex gap-3 w-100 flex-nowrap overflow-hidden">
//                             <!-- Trash Button -->
//                             <div class="flex-shrink-0">
//                                 <button type="button" class="btn btn-outline btn-outline-primary d-flex  align-items-center justify-content-center remove-skill">
//                                     <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
//                                 </button>
//                             </div>

//                             <!-- Select Dropdown -->
//                             <div class="flex-shrink-0">
//                                 <button type="button" class="btn btn-outline btn-outline-primary d-flex  align-items-center justify-content-center edit-skill" data-index="${skillIndex}">
//                                     <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
//                                 </button>
//                             </div>

//                             <!-- Select box -->
//                             <div class="flex-grow-1 overflow-hidden">
//                                 <select id="skill[${skillIndex}]" name="technicalSkills[${skillIndex}][id]" 
//                                     class="form-control select-skill select2-skill text-truncate w-100" data-index="${skillIndex}">
//                                     <option value="${skill.skill_id}" selected>${skill.name}</option>
//                                 </select>
//                             </div>
//                             <input type="hidden" id="technicalSkillsHidden[${skillIndex}]" 
//                                 name="technicalSkills[${skillIndex}][name]" value="${skill.name}">
//                             <div class="flex-shrink-0">
//                                 <button type="button" id="selectTechLevelButton${skillIndex}" class="btn-view edit-level-btn" 
//                                     data-bs-toggle="modal" data-bs-target="#techskillmodal" 
//                                     onclick="technicalpopulateModal(${skillIndex})">
//                                     ${skill.preferred_level ? `Level ${skill?.preferred_level}` : 'Select Level'}
//                                 </button>
//                             </div>
//                         </div>
//                     </div>
//                 `;

//                     // Re-initialize Select2 after DOM update
//                     setTimeout(() => {

//                         const newSkillRow = document.getElementById(`skill-${skillIndex}`);

//                         // Re-bind Remove Button
//                         // newSkillRow.querySelector('.remove-skill')?.addEventListener(
//                         //     'click',
//                         //     function() {
//                             $(document).off('click', '.remove-skill').on('click', '.remove-skill', function () {
//                                 delete technicalSkillsData[skillIndex];
//                                 this.closest('.technical-skill').remove();
//                                 toggleRemoveSkillButtons();
//                             });

//                         // Re-bind Edit Button
//                         // newSkillRow.querySelector('.edit-skill')?.addEventListener('click',
//                         //     function() {
//                         //         const skillData = technicalSkillsData[skillIndex];
//                         //         let selectedOption = $(`#skill\\[${skillIndex}\\] option:selected`);
//                         //         console.log("selectedOption:", selectedOption.text());

//                         //         let fullText = selectedOption.text();
//                         //         let cleanText = fullText.split('(')[0].trim();
//                         //         console.log("cleanText:", cleanText);

//                         //         if (skillData.is_custom == 1 || skillData.is_custom ==
//                         //             2) {
//                         //             const modalEl = document.getElementById(
//                         //                 'CompanyTechnicalSkill');
//                         //             modalEl.setAttribute('data-skill-index',
//                         //                 skillIndex);
//                         //             modalEl.querySelector('#companySkillName')
//                         //                 .textContent = skillData.name || 'Skill';
//                         //             // new bootstrap.Modal(modalEl).show();
//                         //             showOverlay();
 
//                         //             $.ajax({
//                         //                 url: `/admin/skill-job-count/${skillData.id}`,
//                         //                 type: "GET",
//                         //                 dataType: "json",
//                         //                 success: function (data) {
//                         //                     const countEl = modalEl.querySelector('#jobCount');
//                         //                     if (countEl) {
//                         //                         countEl.textContent = data.job_count || 0;
//                         //                     }
//                         //                     hideOverlay();
//                         //                     new bootstrap.Modal(modalEl).show();
//                         //                 },
//                         //                 error: function (xhr, status, error) {
//                         //                     console.error("Error fetching job count:", error);
//                         //                     hideOverlay();
            
//                         //                 }
//                         //             });
//                         //         } else {
//                         //             // const editModalEl = document.getElementById(
//                         //             //     'EditTsfromMSL');
//                         //             // editModalEl.setAttribute('data-skill-index',
//                         //             //     skillIndex);
//                         //             // new bootstrap.Modal(editModalEl).show();
//                         //             // console.log("Checking skill via AJAX:", skillData?.name || cleanText, skillData, cleanText);
//                         //             showOverlay();
//                         //             $.ajax({
//                         //             url: '{{ route('admin.checkSkill') }}', // Endpoint to check if skill has a master_technical_skill_id
//                         //                 method: 'POST',
//                         //                 headers: {
//                         //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                         //                 },
//                         //                 data: {
//                         //                     skill_name: cleanText,
//                         //                     category_name: skillData.category_name,
//                         //                     sector_name: skillData.sector_name,
//                         //                     is_custom: 0,
//                         //                 },
//                         //                 success: function(response) {
//                         //                     hideOverlay(); 
//                         //                     // if (response.skillExists) {
//                         //                         if (response.hasRelatedSkill) {
//                         //                             const createModalEl = document.getElementById('CreateNewSkillModal');
//                         //                             createModalEl.setAttribute('data-skill-index', skillIndex);
//                         //                             new bootstrap.Modal(createModalEl).show();
//                         //                         } else {
//                         //                             const editModalEl = document.getElementById('EditTsfromMSL');
//                         //                             editModalEl.setAttribute('data-skill-index', skillIndex);
//                         //                             new bootstrap.Modal(editModalEl).show();
//                         //                         }
//                         //                     // }else {
//                         //                     //     hideOverlay(); 
//                         //                     //     alert("Skill not found in Master Skill Library.");
//                         //                     // }
//                         //                 },
//                         //                 error: function(error) {
//                         //                     hideOverlay(); 
//                         //                     console.log('Error checking skill:', error);
//                         //                 }
//                         //             });
//                         //         }
//                         //     });

//                         $(document).off('click', '.edit-skill').on('click', '.edit-skill', function (e) {
//     e.preventDefault();

//     // --- find index from dataset or parent id ---
//     const idx = this.dataset.index || (this.closest('.technical-skill')?.id.match(/^skill-(\d+)/) || [])[1];
//     const skillData = technicalSkillsData[idx];
//     if (!skillData) return;

//     // --- get selected option text for debugging / clean name ---
//     let selectedOption = $(`#skill\\[${idx}\\] option:selected`);
//     let fullText = selectedOption.text();
//     let cleanText = fullText.split('(')[0].trim();
//     console.log("selectedOption:", fullText);
//     console.log("cleanText:", cleanText);
//     console.log("skillDatasfdsdfsdg:", skillData);

//     // --- If custom skill ---
//     if (skillData.is_custom == 1 || skillData.is_custom == 2 || skillData.is_new == 1 || skillData.is_new_company_skill == 1) {
//         const modalEl = document.getElementById('CompanyTechnicalSkill');
//         modalEl.setAttribute('data-skill-index', idx);
//         modalEl.querySelector('#companySkillName').textContent = skillData.name || 'Skill';

//         showOverlay();

//         $.ajax({
//             // url: `/admin/skill-job-count/${skillData.id}`,
//             url: `/admin/skill-job-count/${skillData.is_new == 1 ? 'null' : skillData.id}`,
//             type: "GET",
//             dataType: "json",
//             success: function (data) {
//                 const countEl = modalEl.querySelector('#jobCount');
//                 if (countEl) countEl.textContent = data.job_count || 0;
//                 hideOverlay();
//                 new bootstrap.Modal(modalEl).show();
//             },
//             error: function (xhr, status, error) {
//                 console.error("Error fetching job count:", error);
//                 hideOverlay();
//             }
//         });

//     } else {
//         // --- If NOT custom skill, call checkSkill API ---
//         showOverlay();
//         $.ajax({
//             url: '{{ route('admin.checkSkill') }}',
//             method: 'POST',
//             headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
//             data: {
//                 skill_name: skillData.name,
//                 category_name: skillData.category_name,
//                 sector_name: skillData.sector_name,
//                 is_custom: 0,
//             },
//             success: function (response) {
//                 hideOverlay();
//                 if (response.hasRelatedSkill) {
//                     const createModalEl = document.getElementById('CreateNewSkillModal');
//                     createModalEl.setAttribute('data-skill-index', idx);
//                     new bootstrap.Modal(createModalEl).show();
//                 } else {
//                     const editModalEl = document.getElementById('EditTsfromMSL');
//                     editModalEl.setAttribute('data-skill-index', idx);
//                     new bootstrap.Modal(editModalEl).show();
//                 }
//             },
//             error: function (xhr, status, error) {
//                 console.error("Error checking skill:", error);
//                 hideOverlay();
//             }
//         });
//     }
// });


//                         const selectEl = $(`#skill\\[${skillIndex}\\]`);
//                         selectEl.select2({
//     ajax: {
//         url: '{{ route('admin.technical-skill.search') }}',
//         dataType: 'json',
//         delay: 250,
//         data: function(params) {
//             return {
//                 q: params.term,
//                 page: params.page || 1
//             };
//         },
//         processResults: function(data, params) {
//             params.page = params.page || 1;
//             return {
//                 results: data.results,
//                 pagination: {
//                     more: data.pagination.more
//                 }
//             };
//         },
//         cache: true
//     },
//     language: {
//         noResults: function () {
//             return "No matches found";
//         }
//     },
//     templateResult: function (data) {
//         console.log('Data for templateResult:', data);
//         if (data.loading) return data.text;
//         const skillType = data.skill_type || '';
//         const category = data.category || '';
//         const sector   = data.sector || '';
//          const name = cleanLabel(data.text); 
//         return $(`
//             <div class="d-flex justify-content-between align-items-center w-100 gap-6">
//                 <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
//                     ${name}
//                 </span>
//                 <div class="d-flex gap-2">
//                     ${skillType
//                         ? skillType === 'Master Skill'
//                             ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
//                             : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
//                         : ''
//                     }
 
//                     ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${sector || ''}">${sector}</span>` : ''}
//                     ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${category || ''}">${category}</span>` : ''}
//                 </div>
//             </div>
//         `);
//     },
//     templateSelection: function (data) {
//         console.log('Selected data:', data);
//         if (!data.id) return data.text;
//         const skillType = data.skill_type || '';
//         const category = data.category || '';
//         const sector   = data.sector || '';
//          const name = cleanLabel(data.text); 
//         if (skillType || sector || category) {
//         return $(`
//             <div class="d-flex justify-content-between align-items-center w-100 gap-6">
//                 <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
//                     ${name}
//                 </span>
//                 <div class="d-flex gap-2">
//                     ${skillType
//                         ? skillType === 'Master Skill'
//                             ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
//                             : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
//                         : ''
//                     }
//                     ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${sector || ''}">${sector}</span>` : ''}
//                     ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${category || ''}">${category}</span>` : ''}
//                 </div>
//             </div>
//         `);
//     }
//         return $(`
//             <div class="d-flex justify-content-between align-items-center w-100 gap-6">
//                 <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
//                     ${name}
//                 </span>
//                 <div class="d-flex gap-2">
//                     <span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Company Skill">Company Skill</span>
 
//                     ${skill?.sector_name ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skill?.sector_name || ''}">${skill?.sector_name}</span>` : ''}
//                     ${skill?.category_name ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skill?.category_name || ''}">${skill?.category_name}</span>` : ''}
//                 </div>
//             </div>
//         `);
//     },
//     placeholder: 'Search for a skill',
//     minimumInputLength: 1,
//     width: 'resolve'
// });
 
// // ✅ Re-init tooltips on dropdown open or selection
// selectEl.on('select2:open select2:select', function () {
//     $('[data-bs-toggle="tooltip"]').tooltip('dispose').tooltip();
// });

// // selectEl.on('change', function () {
// //     const $this = $(this);
// //     const selectedId   = $this.val();
// //     const selectedText = $this.find('option:selected').text();

// //     // extract index from the element's id e.g. "skill[3]"
// //     const idMatch = $this.attr('id').match(/^skill\[(\d+)\]$/);
// //     const idx = idMatch ? idMatch[1] : null;

// //     if (!idx) return; // safety guard

// //     if (selectedId) {
// //         $(`#selectTechLevelButton${idx}`).prop('disabled', false);
// //     }

// //     $(`#technicalSkillsHidden\\[${idx}\\]`).val(selectedText);

// //     // Fetch updated skill details
// //     TechSkillChanged(idx, selectedId);
// // });
// selectEl.on('change', function () {
//     const $this = $(this);
//     const selectedId   = $this.val();
//     const selectedText = $this.find('option:selected').text();

//     // extract index from the element's id e.g. "skill[3]"
//     const idMatch = $this.attr('id').match(/^skill\[(\d+)\]$/);
//     const idx = idMatch ? idMatch[1] : null;

//     if (!idx) return; // safety guard

//     if (!selectedId) {
//         // Reset if nothing selected
//         $(`#technicalSkillsHidden\\[${idx}\\]`).val('');
//         $(`#selectTechLevelButton${idx}`).prop('disabled', true);
//         return;
//     }

//     // ⚡ Pass $this into TechSkillChanged so it can reset if duplicate
//     TechSkillChanged(idx, selectedId, $this);
// });

//                         // selectEl.select2({
//                         //     placeholder: 'Search for a skill',
//                         //     width: 'resolve'
//                         // });

//                         // selectEl.on('change', function() {
//                         //     const selectedText = $(this).find('option:selected')
//                         //         .text();
//                         //     $(`#technicalSkillsHidden\\[${skillIndex}\\]`).val(
//                         //         selectedText);
//                         // });
//                     }, 10);

//                     // const modal = bootstrap.Modal.getInstance(document.getElementById(
//                     //     'EditTsfromMSL'));
//                     // modal.hide();
//                     const modalInstance = bootstrap.Modal.getInstance(modal);
//                     modalInstance.hide();
                         
//                      } 
                     if (changesDetected) {
  // Normalize values for duplicate check
  const nameToCheck   = cleanLabel(skill.name || '').trim();
  const sectorName    = (skill.sector_name || '').trim();
  const categoryName  = (skill.category_name || '').trim();


  dupCheckSkill(nameToCheck, sectorName, categoryName)
    .done(function (res) {

      if (res && res.exists) {
        // ⛔ Duplicate found — block save and force title change
        // alert(res.message || 'A similar skill already exists in the Master/Company library. Please change the title.');
         showInlineNameError(
          skillRow,
          skillIndex,
          res.message || 'Company technical skill title already exists in this sector and category. Please enter a different one.'
        );

        // const nameInput = skillRow.querySelector(`input[name="technicalSkills[${skillIndex}][name]"]`);
        // const acceptBtn = skillRow.querySelector('.accept-btn');

        // if (nameInput && acceptBtn) {
        //   acceptBtn.disabled = true;
        //   nameInput.classList.add('is-invalid');
        //   nameInput.focus();

        //   const conflictName = nameToCheck.toLowerCase();
        //   const onInput = () => {
        //     const current = cleanLabel(nameInput.value || '').trim().toLowerCase();
        //     const changed = current !== conflictName;
        //     acceptBtn.disabled = !changed;
        //     if (changed) nameInput.classList.remove('is-invalid');
        //   };
        //   nameInput.removeEventListener('input', onInput); // idempotent
        //   nameInput.addEventListener('input', onInput);
        // }
        hideOverlay();
        return; // stop here: DO NOT continue with success flow
      }

      // ✅ No duplicate — keep your original success flow
      console.log('Changes detected, marking for overwrite if needed.');
      if (modal && modal.id === 'CreateNewSkillModal') {
        skill.is_new_company_skill = 1;
      }
      const successModal = new bootstrap.Modal(document.getElementById('SuccessModal'));
      let cleanText = cleanLabel(skill.name);
      document.getElementById('SuccessModal').querySelector('#SkillName').textContent = cleanText || 'Skill';
      successModal.show();
      skill.is_new = 1;
      skill.preferred_level = "";

      // Sync JSON
      document.getElementById('technicalSkillsJson').value = JSON.stringify(technicalSkillsData);

      // Re-render with select + hidden input (your original HTML)
      skillRow.outerHTML = `
        <div class="technical-skill row mb-8" id="skill-${skillIndex}">
          <input type="hidden" name="technicalSkills[${skillIndex}][description]" value="${skill.description}">
          <input type="hidden" name="technicalSkills[${skillIndex}][sector_name]" value="${skill.sector_name || ''}">
          <input type="hidden" name="technicalSkills[${skillIndex}][preferred_level]" value="${skill.preferred_level || 1}">
          <div class="d-flex gap-3 w-100 flex-nowrap overflow-hidden">
            <div class="flex-shrink-0">
              <button type="button" class="btn btn-outline btn-outline-primary d-flex  align-items-center justify-content-center remove-skill">
                <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
              </button>
            </div>
            <div class="flex-shrink-0">
              <button type="button" class="btn btn-outline btn-outline-primary d-flex  align-items-center justify-content-center edit-skill" data-index="${skillIndex}">
                <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
              </button>
            </div>
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
                ${skill.preferred_level ? `Level ${skill?.preferred_level}` : 'Select Level'}
              </button>
            </div>
          </div>
        </div>
      `;

      // Re-init Select2 + rebinds (your existing code)
      setTimeout(() => {
        const newSkillRow = document.getElementById(`skill-${skillIndex}`);

        // ❌ REMOVED: Duplicate event handler - now handled globally in document.ready (line ~5806)
        // $(document).off('click', '.remove-skill').on('click', '.remove-skill', function () {
        //   const skillElement = $(this).closest('.technical-skill');
        //   const skillIndex = skillElement.attr('id')?.replace('skill-', '');
        //   
        //   // Check if we have minimum required technical skills (at least 1)
        //   const remainingSkills = document.querySelectorAll('.technical-skill:not(.removed-skill)').length;
        //   if (remainingSkills <= 1) {
        //     alert('At least one technical skill is required. You cannot remove all technical skills.');
        //     return;
        //   }
        //   
        //   console.log('Global remove handler - removing skill:', skillIndex);
        //   debugSkillState();
        //   
        //   // Show loading overlay while modal is prepared
        //   try { if (typeof showOverlay === 'function') showOverlay(); } catch (e) {}
        //   
        //   // Show confirmation modal
        //   ModalManager.open({
        //     module: 'jobs',
        //     key: 'delete_technical_skill',
        //     data: {},
        //     onSubmit(modalEl) {
        //       // User confirmed removal - proceed with the removal
        //       console.log("Skill removal confirmed for index:", skillIndex);
        //       
        //       // Safely destroy Select2 instance before removing the element
        //       const selectElement = skillElement.find('.select-skill');
        //       safelyDestroySelect2(selectElement);
        //       
        //       // Clean up data
        //       if (skillIndex && technicalSkillsData[skillIndex]) {
        //         delete technicalSkillsData[skillIndex];
        //       }
        //       
        //       // Remove the DOM element
        //       skillElement.remove();
        //       
        //       // Update remove button states
        //       if (typeof toggleRemoveSkillButtons === 'function') {
        //         toggleRemoveSkillButtons();
        //       }
        //       
        //       console.log("After global removal:");
        //       debugSkillState();
        //       
        //       // Refresh comparison if active
        //       if (comparisonActive) {
        //         const ajaxResponse = @json($cachedData);
        //         let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
        //           .masterTechnicalSkills.length > 0 ?
        //           ajaxResponse.masterTechnicalSkills :
        //           (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : []);
        //         const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : [];
        //         const currentFormSkills = getCurrentFormSkills();
        //
        //         const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
        //         
        //         // Handle validation errors
        //         if (comparison.status === 'validation_error') {
        //           console.warn('Validation Error:', comparison.message);
        //         } else {
        //           renderComparison(comparison.comparisonResults);
        //           showComparisonSummary(comparison.comparisonResults);
        //         }
        //       }
        //       
        //       // Close the modal and hide loading overlay
        //       const bsModal = bootstrap.Modal.getInstance(modalEl);
        //       if (bsModal) bsModal.hide();
        //       try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
        //     },
        //     onShown(modalEl) {
        //       // Hide loading overlay when modal is shown
        //       try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
        //     },
        //     onError() {
        //       // Hide loading overlay on error
        //       try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
        //     }
        //   });
        // });

        $(document).off('click', '.edit-skill').on('click', '.edit-skill', function () {
          const skillIndex = $(this).closest('.technical-skill').attr('id').replace('skill-', '');
          const skillData = technicalSkillsData[skillIndex];
          let selectedOption = $(`#skill\\[${skillIndex}\\] option:selected`);
          let fullText = selectedOption.text();
          let cleanText = fullText.split('(')[0].trim();

          if (skillData.is_custom == 1 || skillData.is_custom == 2 || skillData.is_new == 1 || skillData.is_new_company_skill == 1) {
            const modalEl = document.getElementById('CompanyTechnicalSkill');
            modalEl.setAttribute('data-skill-index', skillIndex);
            modalEl.querySelector('#companySkillName').textContent = skillData.name || 'Skill';
            showOverlay && showOverlay();
            $.ajax({
            //   url: `/admin/skill-job-count/${skillData.id}`,
            url: `/admin/skill-job-count/${(skillData.is_new === 1 || skillData.is_new_company_skill === 1) ? null : skillData.id}`,
              type: "GET",
              dataType: "json",
              success: function (data) {
                const countEl = modalEl.querySelector('#jobCount');
                if (countEl) countEl.textContent = data.job_count || 0;
                hideOverlay && hideOverlay();
                new bootstrap.Modal(modalEl).show();
              },
              error: function () {
                hideOverlay && hideOverlay();
              }
            });
          } else {
            showOverlay && showOverlay();
            $.ajax({
              url: '{{ route('admin.checkSkill') }}',
              method: 'POST',
              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
              data: {
                skill_name: cleanText,
                category_name: skillData.category_name,
                sector_name: skillData.sector_name,
                is_custom: 0,
              },
              success: function (response) {
                hideOverlay && hideOverlay();
                if (response.hasRelatedSkill) {
                  const createModalEl = document.getElementById('CreateNewSkillModal');
                  createModalEl.setAttribute('data-skill-index', skillIndex);
                  new bootstrap.Modal(createModalEl).show();
                } else {
                  const editModalEl = document.getElementById('EditTsfromMSL');
                  editModalEl.setAttribute('data-skill-index', skillIndex);
                  new bootstrap.Modal(editModalEl).show();
                }
              },
              error: function () {
                hideOverlay && hideOverlay();
              }
            });
          }
        });

        const selectEl = $(`#skill\\[${skillIndex}\\]`);
        selectEl.select2({
          ajax: {
            url: '{{ route('admin.technical-skill.search') }}',
            dataType: 'json',
            delay: 250,
            data: function (params) { return { q: params.term, page: params.page || 1 }; },
            processResults: function (data, params) {
              params.page = params.page || 1;
              return { results: data.results, pagination: { more: data.pagination.more } };
            },
            cache: true
          },
          language: { noResults: function () { return "No matches found"; } },
          templateResult: function (data) {
            if (data.loading) return data.text;
            const name = cleanLabel(data.text);
            const skillType = data.skill_type || '';
            const category = data.category || '';
            const sector = data.sector || '';
            return $(`
              <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name}">${name}</span>
                <div class="d-flex gap-2">
                  ${skillType
                    ? (skillType === 'Master Skill'
                      ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-title="${skillType}">${skillType}</span>`
                      : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-title="${skillType}">${skillType}</span>`)
                    : ''}
                  ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-title="${sector}">${sector}</span>` : ''}
                  ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-title="${category}">${category}</span>` : ''}
                </div>
              </div>
            `);
          },
          templateSelection: function (data) {
            if (!data.id) return data.text;
            const name = cleanLabel(data.text);
            const skillType = data.skill_type || '';
            const category = data.category || '';
            const sector = data.sector || '';
            if (skillType || sector || category) {
              return $(`
                <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                  <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name}">${name}</span>
                  <div class="d-flex gap-2">
                    ${skillType
                      ? (skillType === 'Master Skill'
                        ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-title="${skillType}">${skillType}</span>`
                        : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-title="${skillType}">${skillType}</span>`)
                      : ''}
                    ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-title="${sector}">${sector}</span>` : ''}
                    ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-title="${category}">${category}</span>` : ''}
                  </div>
                </div>
              `);
            }
            return $(`
              <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name}">${name}</span>
                <div class="d-flex gap-2">
                  <span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-title="Company Skill">Company Skill</span>
                  ${skill?.sector_name ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-title="${skill?.sector_name}">${skill?.sector_name}</span>` : ''}
                  ${skill?.category_name ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-title="${skill?.category_name}">${skill?.category_name}</span>` : ''}
                </div>
              </div>
            `);
          },
          placeholder: 'Search for a skill',
          minimumInputLength: 1,
          width: 'resolve'
        });

        selectEl.on('select2:open select2:select', function () {
          $('[data-bs-toggle="tooltip"]').tooltip('dispose').tooltip();
        });

        selectEl.on('change', function () {
          const $this = $(this);
          const selectedId = $this.val();
          const idMatch = $this.attr('id').match(/^skill\[(\d+)\]$/);
          const idx = idMatch ? idMatch[1] : null;
          if (!idx) return;

          if (!selectedId) {
            $(`#technicalSkillsHidden\\[${idx}\\]`).val('');
            $(`#selectTechLevelButton${idx}`).prop('disabled', true);
            return;
          }
          TechSkillChanged(idx, selectedId, $this);
        });
        // ✅ Toggle remove buttons to disable if only 1 skill remains
        if (typeof toggleRemoveSkillButtons === 'function') toggleRemoveSkillButtons();
      }, 10);

      // Hide the editor modal
      const modalInstance = bootstrap.Modal.getInstance(modal) || bootstrap.Modal.getOrCreateInstance(modal);
      modalInstance.hide();
      hideOverlay();
    })
    .fail(function () {
      hideOverlay(); // ensure hide on error
      alert('Unable to validate duplicate right now. Please try again.');
    });

  // IMPORTANT: wait for AJAX; do not continue below this return
  return;
}else {
                         console.log('No changes detected.');
                          // Get the modal element
                        const noChangesModalElement = document.getElementById('NoChangesModal');
                        noChangesModalElement.setAttribute('data-skill-index', skillIndex);
                        const noChangesModal = new bootstrap.Modal(noChangesModalElement);

                        // Show the modal
                        noChangesModal.show();

                        noChangesModalElement.querySelector('.continue-btn').addEventListener('click', function() {
                    const skill = originalSkillData;
                    noChangesModal.hide();
                    // skill.preferred_level = "";

                    // Revert full skill data (preserve is_new and is_new_company_skill flags)
                    technicalSkillsData[skillIndex] = skill;

                    // Find the old skill row element to replace
                    const skillRow = document.getElementById(`skill-${skillIndex}`);
                    console.log('Reverting to original skill data:', skillRow);

                    skillRow.outerHTML = `
        <div class="technical-skill row mb-8" id="skill-${skillIndex}">
            <input type="hidden" name="technicalSkills[${skillIndex}][description]" value="${skill.description}">
            <input type="hidden" name="technicalSkills[${skillIndex}][sector_name]" value="${skill.sector_name || ''}">
            <input type="hidden" name="technicalSkills[${skillIndex}][preferred_level]" value="${skill.preferred_level || 1}">

            <div class="d-flex gap-3 w-100 flex-nowrap overflow-hidden">
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
                        ${skill.preferred_level ? `Level ${skill?.preferred_level}` : 'Select Level'}
                    </button>
                </div>
            </div>
        </div>

    `;

                    // Re-initialize Select2
                    setTimeout(() => {
                        const newSkillRow = document.getElementById(`skill-${skillIndex}`);

                        // Re-bind Remove Button
                        newSkillRow.querySelector('.remove-skill')?.addEventListener(
                            'click',
                            function() {
                                const removeButton = this;
                                const skillElement = removeButton.closest('.technical-skill');
                                
                                // Show loading overlay while modal is prepared
                                try { if (typeof showOverlay === 'function') showOverlay(); } catch (e) {}
                                
                                // Show confirmation modal
                                ModalManager.open({
                                    module: 'jobs',
                                    key: 'delete_technical_skill',
                                    data: {},
                                    onSubmit(modalEl) {
                                        // User confirmed removal - proceed with the removal
                                        console.log("Skill removal confirmed for index:", skillIndex);
                                        
                                        delete technicalSkillsData[skillIndex];
                                        skillElement.remove();
                                        toggleRemoveSkillButtons();
                                        
                                        // Refresh comparison if active
                                        if (comparisonActive) {
                                            const ajaxResponse = @json($cachedData);
                                            let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                                              .masterTechnicalSkills.length > 0 ?
                                              ajaxResponse.masterTechnicalSkills :
                                              (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : []);
                                            const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : [];
                                            const currentFormSkills = getCurrentFormSkills();

                                            const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                                            
                                            // Handle validation errors
                                            if (comparison.status === 'validation_error') {
                                              console.warn('Validation Error:', comparison.message);
                                            } else {
                                              renderComparison(comparison.comparisonResults);
                                              showComparisonSummary(comparison.comparisonResults);
                                            }
                                        }
                                        
                                        // Close the modal and hide loading overlay
                                        const bsModal = bootstrap.Modal.getInstance(modalEl);
                                        if (bsModal) bsModal.hide();
                                        try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
                                    },
                                    onShown(modalEl) {
                                        // Hide loading overlay when modal is shown
                                        try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
                                    },
                                    onError() {
                                        // Hide loading overlay on error
                                        try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
                                    }
                                });
                            });

                        // Re-bind Edit Button
                        // newSkillRow.querySelector('.edit-skill')?.addEventListener('click',
                        //     function() {
                        //         const skillData = technicalSkillsData[skillIndex];


                        //         if (skillData.is_custom == 1 || skillData.is_custom ==
                        //             2) {
                        //             const modalEl = document.getElementById(
                        //                 'CompanyTechnicalSkill');
                        //             modalEl.setAttribute('data-skill-index',
                        //                 skillIndex);
                        //             modalEl.querySelector('#companySkillName')
                        //                 .textContent = skillData.name || 'Skill';
                        //             // new bootstrap.Modal(modalEl).show();
                        //             showOverlay();
 
                        //             $.ajax({
                        //                 url: `/admin/skill-job-count/${skillData.id}`,
                        //                 type: "GET",
                        //                 dataType: "json",
                        //                 success: function (data) {
                        //                     const countEl = modalEl.querySelector('#jobCount');
                        //                     if (countEl) {
                        //                         countEl.textContent = data.job_count || 0;
                        //                     }
                        //                     hideOverlay();
                        //                     new bootstrap.Modal(modalEl).show();
                        //                 },
                        //                 error: function (xhr, status, error) {
                        //                     console.error("Error fetching job count:", error);
                        //                     hideOverlay();
            
                        //                 }
                        //             });
                        //         } else {
                        //             // const editModalEl = document.getElementById(
                        //             //     'EditTsfromMSL');
                        //             // editModalEl.setAttribute('data-skill-index',
                        //             //     skillIndex);
                        //             // new bootstrap.Modal(editModalEl).show();
                        //             showOverlay();
                        //             $.ajax({
                        //             url: '{{ route('admin.checkSkill') }}', // Endpoint to check if skill has a master_technical_skill_id
                        //                 method: 'POST',
                        //                 headers: {
                        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        //                 },
                        //                 data: {
                        //                     skill_name: skillData.name,
                        //                     category_name: skillData.category_name,
                        //                      sector_name: skillData.sector_name,
                        //                     is_custom: 0,
                        //                 },
                        //                 success: function(response) {
                        //                     hideOverlay(); 
                        //                     // if (response.skillExists) {
                        //                         if (response.hasRelatedSkill) {
                        //                             const createModalEl = document.getElementById('CreateNewSkillModal');
                        //                             createModalEl.setAttribute('data-skill-index', skillIndex);
                        //                             new bootstrap.Modal(createModalEl).show();
                        //                         } else {
                        //                             const editModalEl = document.getElementById('EditTsfromMSL');
                        //                             editModalEl.setAttribute('data-skill-index', skillIndex);
                        //                             new bootstrap.Modal(editModalEl).show();
                        //                         }
                        //                     // }else {
                        //                     //     hideOverlay(); 
                        //                     //     console.log("Skill hi nahi mila");
                        //                     // }
                        //                 },
                        //                 error: function(error) {
                        //                     hideOverlay(); 
                        //                     console.log('Error checking skill:', error);
                        //                 }
                        //             });
                        //         }
                        //     });
                        $(document).off('click', '.edit-skill').on('click', '.edit-skill', function (e) {
  e.preventDefault();
  const idx = this.dataset.index || (this.closest('.technical-skill')?.id.match(/^skill-(\d+)/)||[])[1];
  const skillData = technicalSkillsData[idx];
  if (!skillData) return;

  if (skillData.is_custom == 1 || skillData.is_custom == 2 || skillData.is_new == 1 || skillData.is_new_company_skill == 1) {
    const modalEl = document.getElementById('CompanyTechnicalSkill');
    modalEl.setAttribute('data-skill-index', idx);
    modalEl.querySelector('#companySkillName').textContent = skillData.name || 'Skill';
    showOverlay();
    $.ajax({
    //   url: `/admin/skill-job-count/${skillData.id || skillData.skill_id}`,
     url: `/admin/skill-job-count/${(skillData.is_new === 1 || skillData.is_new_company_skill === 1) ? null : skillData.id}`,
      type: "GET",
      dataType: "json",
      success: function (data) {
        const countEl = modalEl.querySelector('#jobCount');
        if (countEl) countEl.textContent = data.job_count || 0;
        hideOverlay();
        new bootstrap.Modal(modalEl).show();
      },
      error: function () { hideOverlay(); }
    });
  } else {
    showOverlay();
    $.ajax({
      url: '{{ route('admin.checkSkill') }}',
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      data: {
        skill_name: skillData.name,
        category_name: skillData.category_name,
        sector_name: skillData.sector_name,
        is_custom: 0,
      },
      success: function (response) {
        hideOverlay();
        if (response.hasRelatedSkill) {
          const createModalEl = document.getElementById('CreateNewSkillModal');
          createModalEl.setAttribute('data-skill-index', idx);
          new bootstrap.Modal(createModalEl).show();
        } else {
          const editModalEl = document.getElementById('EditTsfromMSL');
          editModalEl.setAttribute('data-skill-index', idx);
          new bootstrap.Modal(editModalEl).show();
        }
      },
      error: function () { hideOverlay(); }
    });
  }
});

                        const selectEl = $(`#skill\\[${skillIndex}\\]`);
                        selectEl.select2({
    ajax: {
        url: '{{ route('admin.technical-skill.search') }}',
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term,
                page: params.page || 1
            };
        },
        processResults: function(data, params) {
            params.page = params.page || 1;
            return {
                results: data.results,
                pagination: {
                    more: data.pagination.more
                }
            };
        },
        cache: true
    },
    language: {
        noResults: function () {
            return "No matches found";
        }
    },
    templateResult: function (data) {
        console.log('Data for templateResult:', data);
        if (data.loading) return data.text;
        const skillType = data.skill_type || '';
        const category = data.category || '';
        const sector   = data.sector || '';
         const name = cleanLabel(data.text); 
        return $(`
            <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
                    ${name}
                </span>
                <div class="d-flex gap-2">
                    ${skillType
                        ? skillType === 'Master Skill'
                            ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                            : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                        : ''
                    }
 
                    ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${sector || ''}">${sector}</span>` : ''}
                    ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${category || ''}">${category}</span>` : ''}
                </div>
            </div>
        `);
    },
    templateSelection: function (data) {
        console.log('Selected data:', data);
        if (!data.id) return data.text;
        const skillType = data.skill_type || '';
        const category = data.category || '';
        const sector   = data.sector || '';
         const name = cleanLabel(data.text); 
        if (skillType || sector || category) {
        return $(`
            <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
                    ${name}
                </span>
                <div class="d-flex gap-2">
                    ${skillType
                        ? skillType === 'Master Skill'
                            ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                            : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                        : ''
                    }
                    ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${sector || ''}">${sector}</span>` : ''}
                    ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${category || ''}">${category}</span>` : ''}
                </div>
            </div>
        `);
    }
        return $(`
            <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
                    ${name}
                </span>
                <div class="d-flex gap-2">
                    <span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Master Skill">Master Skill</span>
 
                    ${skill?.sector_name ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skill?.sector_name || ''}">${skill?.sector_name}</span>` : ''}
                    ${skill?.category_name ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skill?.category_name || ''}">${skill?.category_name}</span>` : ''}
                </div>
            </div>
        `);
    },
    placeholder: 'Search for a skill',
    minimumInputLength: 1,
    width: 'resolve'
});
 
// ✅ Re-init tooltips on dropdown open or selection
selectEl.on('select2:open select2:select', function () {
    $('[data-bs-toggle="tooltip"]').tooltip('dispose').tooltip();
});
// selectEl.on('change', function () {
//     const $this = $(this);
//     const selectedId   = $this.val();
//     const selectedText = $this.find('option:selected').text();

//     // extract index from the element's id e.g. "skill[3]"
//     const idMatch = $this.attr('id').match(/^skill\[(\d+)\]$/);
//     const idx = idMatch ? idMatch[1] : null;

//     if (!idx) return; // safety guard

//     if (selectedId) {
//         $(`#selectTechLevelButton${idx}`).prop('disabled', false);
//     }

//     $(`#technicalSkillsHidden\\[${idx}\\]`).val(selectedText);

//     // Fetch updated skill details
//     TechSkillChanged(idx, selectedId);
// });
selectEl.on('change', function () {
    const $this = $(this);
    const selectedId   = $this.val();
    const selectedText = $this.find('option:selected').text();

    // extract index from the element's id e.g. "skill[3]"
    const idMatch = $this.attr('id').match(/^skill\[(\d+)\]$/);
    const idx = idMatch ? idMatch[1] : null;

    if (!idx) return; // safety guard

    if (!selectedId) {
        // Reset if nothing selected
        $(`#technicalSkillsHidden\\[${idx}\\]`).val('');
        $(`#selectTechLevelButton${idx}`).prop('disabled', true);
        return;
    }

    // ⚡ Pass $this into TechSkillChanged so it can reset if duplicate
    TechSkillChanged(idx, selectedId, $this);
});

                        // selectEl.select2({
                        //     placeholder: 'Search for a skill',
                        //     width: 'resolve'
                        // });

                        // selectEl.on('change', function() {
                        //     const selectedText = $(this).find('option:selected')
                        //         .text();
                        //     $(`#technicalSkillsHidden\\[${skillIndex}\\]`).val(
                        //         selectedText);
                        // });
                        
                        // ✅ Toggle remove buttons to disable if only 1 skill remains
                        if (typeof toggleRemoveSkillButtons === 'function') toggleRemoveSkillButtons();
                        
                        // Refresh comparison if active to preserve green highlighting for new skills
                        console.log('NoChangesModal Continue: Checking comparisonActive =', comparisonActive);
                        if (comparisonActive) {
                            console.log('NoChangesModal Continue: Refreshing comparison to maintain green highlight');
                            const ajaxResponse = @json($cachedData);
                            let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                              .masterTechnicalSkills.length > 0 ?
                              ajaxResponse.masterTechnicalSkills :
                              (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : []);
                            const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : [];
                            const currentFormSkills = getCurrentFormSkills();

                            const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                            
                            // Handle validation errors
                            if (comparison.status === 'validation_error') {
                              console.warn('Validation Error:', comparison.message);
                            } else {
                              console.log('NoChangesModal Continue: Rendering comparison with', comparison.comparisonResults);
                              renderComparison(comparison.comparisonResults);
                              showComparisonSummary(comparison.comparisonResults);
                            }
                        }
                    }, 10);
                }, { once: true });
                        

                     }

                    
                });





                // Close the "Edit from Master Skill Library" modal
                // const modal = bootstrap.Modal.getInstance(document.getElementById('EditTsfromMSL'));
                // modal.hide();
                const modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
            });
        });
        });
    </script>

    {{-- <script>
    
        function renderInlineSkillEdit(skillIndex, label = 'Company Skill') {
            const skillIndex = parseInt(document.getElementById('CompanyTechnicalSkill').getAttribute('data-skill-index'));
            const skillData = technicalSkillsData[skillIndex];
            const skillRow = document.getElementById(`skill-${skillIndex}`);
    
            if (!skillRow || !skillData) return;
    
            const originalHTML = skillRow.innerHTML;
    
            skillRow.innerHTML = `
                <div class="d-flex justify-content-between w-100 align-items-start">
                    <div class="d-flex align-items-start gap-3 col-lg-10">
                        <div class="d-flex flex-column gap-2 pt-2">
                            <button class="btn btn-light border border-warning text-warning accept-btn" style="width: 30px; height: 30px; padding: 0;">
                                <iconify-icon icon="ic:round-check" width="18" height="18"></iconify-icon>
                            </button>
                            <button class="btn btn-light border text-muted cancel-btn" style="width: 30px; height: 30px; padding: 0;">
                                <iconify-icon icon="ic:round-close" width="18" height="18"></iconify-icon>
                            </button>
                        </div>
                        <div class="w-100">
                            <div class="d-flex align-items-center gap-2 mb-2 position-relative">
                                <input type="text" class="form-control" name="technicalSkills[${skillIndex}][name]" 
                                    value="${skillData.name}" 
                                    data-original="${skillData.name}">
                                <button class="reset-btn position-absolute top-0 end-0 mt-2 me-2" type="button">
                                    <iconify-icon icon="grommet-icons:power-reset" width="16" height="16"></iconify-icon>
                                </button>
                                <span class="badge border text-muted px-2" style="background-color: #E3F7FF; color: #125A78;">
                                    Company Skill
                                </span>
                                <span class="badge border text-muted px-2" style="background-color: #F1F1F4; color: #4B5675;">
                                    ${skillData.sector_name || 'N/A'}
                                </span>
                            </div>
                            <div class="position-relative">
                                <textarea class="form-control" rows="2" name="technicalSkills[${skillIndex}][description]" 
                                    data-original="${skillData.description || 'N/A'}">${skillData.description || 'N/A'}</textarea>
                                <button class="reset-btn position-absolute top-0 end-0 mt-2 me-2" type="button">
                                    <iconify-icon icon="grommet-icons:power-reset" width="16" height="16"></iconify-icon>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 d-flex flex-column align-items-end gap-2">
                        <button type="button" class="btn btn-outline btn-sm text-warning border-warning edit-level-btn"
                            data-bs-toggle="modal" data-bs-target="#tsEditLevel"
                            onclick="openTSEditLevelModal(${skillIndex})">
                            Edit Level
                            <iconify-icon icon="lucide:edit" width="16" height="16"></iconify-icon>
                        </button>
                    </div>
                </div>
            `;
    
            // Cancel
            skillRow.querySelector('.cancel-btn').addEventListener('click', function () {
                skillRow.innerHTML = originalHTML;
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
    
            // Accept
            skillRow.querySelector('.accept-btn').addEventListener('click', function () {
                const nameInput = skillRow.querySelector(`input[name="technicalSkills[${skillIndex}][name]"]`);
                const descTextarea = skillRow.querySelector(`textarea[name="technicalSkills[${skillIndex}][description]"]`);
    
                const skill = technicalSkillsData[skillIndex];
                skill.name = nameInput.value.trim();
                skill.description = descTextarea.value.trim();
    
                document.getElementById('technicalSkillsJson').value = JSON.stringify(technicalSkillsData);
    
                const hiddenInputs = `
                    <input type="hidden" name="technicalSkills[${skillIndex}][description]" value="${skill.description}">
                    <input type="hidden" name="technicalSkills[${skillIndex}][sector_name]" value="${skill.sector_name || ''}">
                    <input type="hidden" name="technicalSkills[${skillIndex}][preferred_level]" value="${skill.preferred_level || 1}">
                `;
    
                skillRow.outerHTML = `
                    <div class="technical-skill row mb-8" id="skill-${skillIndex}">
                        ${hiddenInputs}
                        <div class="fv-row mb-2 fv-plugins-icon-container col-lg-9 d-flex gap-7">
                            <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
                                <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
                            </button>
                            <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center edit-skill" data-index="${skillIndex}">
                                <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
                            </button>
                            <input type="text" class="form-control input-style" id="technicalSkills[${skillIndex}]" 
                                name="technicalSkills[${skillIndex}][name]" placeholder="Technical Skill" 
                                value="${skill.name}" required readonly>
                        </div>
                        <div class="fv-row mb-2 fv-plugins-icon-container d-flex col-lg-3 btn-vl-container justify-content-end">
                            <select id="level[${skillIndex}]" name="technicalSkills[${skillIndex}][level]" class="form-select col-lg-7 col-md-10 btn-level mb-3 mb-lg-0 rounded-right">
                                ${Array.from({ length: 6 }, (_, i) => 6 - i)
                                    .map(level => {
                                        const descriptionKey = `level_${level}_description`;
                                        const levelDescription = skill[descriptionKey] || null;
                                        if (levelDescription) {
                                            return `<option value="${level}" 
                                                ${skill?.preferred_level == level ? 'selected' : ''} 
                                                class="dark:bg-slate-700">Level ${level}</option>`;
                                        }
                                        return '';
                                    }).join('')}
                            </select>
                            <button type="button" id="selectTechLevelButton${skillIndex}" class="btn-view" 
                                data-bs-toggle="modal" data-bs-target="#techskillmodal" 
                                onclick="technicalpopulateModal(${skillIndex})">
                                View Level
                                <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
                            </button>
                        </div>
                    </div>
                `;
            });
    
            // Hide Company Modal
            const modalInstance = bootstrap.Modal.getInstance(document.getElementById('CompanyTechnicalSkill'));
            modalInstance?.hide();
        }
    
    </script> --}}

    <script>
        function wireResetButtonsForRow(skillRowEl) {
  // 1) optional: normalization (keep if you want to ignore "(...-...)" chunks)
  const normalize = (s) => String(s ?? '')
    .replace(/\s*\([^)]*-[^)]*\)\s*/g, '')
    .trim();

  // 2) disable all reset buttons initially
  skillRowEl.querySelectorAll('.reset-btn').forEach(btn => { btn.disabled = true; });

  // 3) helper: find the reset button that pairs with a given field (walk up to a container that has a reset-btn)
  function findPairedResetBtn(field) {
    let node = field.parentElement;
    while (node && node !== skillRowEl) {
      const btn = node.querySelector('.reset-btn');
      if (btn) return btn;
      node = node.parentElement;
    }
    return null;
  }

  // 4) keep originals—if missing, set them now to current values
  skillRowEl.querySelectorAll('input[name^="technicalSkills"], textarea[name^="technicalSkills"]').forEach(field => {
    if (field.dataset.original === undefined) {
      field.dataset.original = field.value ?? '';
    }
  });

  // 5) delegated change detection (input + change)
  function syncForField(field) {
    const btn = findPairedResetBtn(field);
    if (!btn) return;
    const original = field.dataset.original ?? '';
    btn.disabled = (normalize(field.value) === normalize(original));
  }

  skillRowEl.addEventListener('input', (e) => {
    const el = e.target;
    if (!(el.matches('input[name^="technicalSkills"]') || el.matches('textarea[name^="technicalSkills"]'))) return;
    syncForField(el);
  });

  skillRowEl.addEventListener('change', (e) => {
    const el = e.target;
    if (!(el.matches('input[name^="technicalSkills"]') || el.matches('textarea[name^="technicalSkills"]'))) return;
    syncForField(el);
  });

  // 6) delegated reset click
 skillRowEl.addEventListener('click', (e) => {
  const btn = e.target.closest('.reset-btn');
  if (!btn || !skillRowEl.contains(btn)) return;

  // find paired field
  let field = btn.parentElement.querySelector('input, textarea');
  if (!field) {
    // fallback: search upward for nearest input/textarea
    let node = btn.parentElement;
    while (node && node !== skillRowEl) {
      const f = node.querySelector('input, textarea');
      if (f) { field = f; break; }
      node = node.parentElement;
    }
  }

  if (field && field.dataset.original !== undefined) {
    let original = field.dataset.original;

    // same normalization you had
    original = original.replace(/\s*\([^)]*-[^)]*\)\s*/g, '').trim();

    field.value = original;

    // trigger input so your "enable/disable" logic updates
    field.dispatchEvent(new Event('input', { bubbles: true }));
    field.focus();
  }
});

  // 7) initial sync (keeps them disabled if no edits yet)
  skillRowEl.querySelectorAll('input[name^="technicalSkills"], textarea[name^="technicalSkills"]').forEach(syncForField);
}
        function renderInlineSkillEdit(skillIndex, label = 'Company Skill', selectedValue) {
            const skillData = technicalSkillsData[skillIndex];
            const skillRow = document.getElementById(`skill-${skillIndex}`);
            if (!skillRow || !skillData) return;

            const originalSkillData = JSON.parse(JSON.stringify(skillData));

            const originalHTML = skillRow.innerHTML;
            console.log('skillData:', skillData);

            let skillLabel = `${selectedValue === 'master' ? '(Updated Skill)' : '(New Skill)'}`;
            const name = cleanLabel(skillData.name);

             skillRow.innerHTML = `
                <div class="d-flex justify-content-between align-items-start pl-0 gap-3">
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
                                <div class="d-flex align-items-center gap-2 w-100 justify-content-between">
                                <input type="text" class="form-control p-0 border-0 h-auto span-truncate" name="technicalSkills[${skillIndex}][name]" 
                                    value="${name}" 
                                    data-original="${skillData.name}">
                           <div class="d-flex align-items-center gap-2">
                                
                                ${skillData.is_custom == 2 
                                ? `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-title="Company Skill">Company Skill</span>` 
                                : `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-title="Master Skill">Master Skill</span>`
                                }
                                <span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-title="${skillData.sector_name || 'N/A'}">${skillData.sector_name || 'N/A'}</span>
                                <span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-title="${skillData.category_name || 'N/A'}">${skillData.category_name || 'N/A'}</span>
                                </div>
                                </div>
                                <button class="reset-btn" type="button" disabled>
                                    <iconify-icon icon="grommet-icons:power-reset" width="16" height="16"></iconify-icon>
                                </button>
                            </div>
                            <div class="position-relative">
                                <textarea class="form-control pr-5" rows="2" name="technicalSkills[${skillIndex}][description]" 
                                    data-original="${skillData.description || 'N/A'}">${skillData.description || 'N/A'}</textarea>
                                <button class="reset-btn position-absolute top-0 end-0 mt-4 me-3" type="button" disabled>
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
            if (typeof afterEditModeOpen === 'function') afterEditModeOpen(skillRow);
            wireResetButtonsForRow(skillRow);

            // Cancel
            // skillRow.querySelector('.cancel-btn').addEventListener('click', function () {
            //     skillRow.innerHTML = originalHTML;
            // });

            // Cancel
            // skillRow.querySelector('.cancel-btn').addEventListener('click', function () {
            //     const skill = technicalSkillsData[skillIndex];
            //     skillRow.outerHTML = `
        //         <div class="technical-skill row mb-8" id="skill-${skillIndex}">
        //             <input type="hidden" name="technicalSkills[${skillIndex}][description]" value="${skill.description}">
        //             <input type="hidden" name="technicalSkills[${skillIndex}][sector_name]" value="${skill.sector_name || ''}">
        //             <input type="hidden" name="technicalSkills[${skillIndex}][preferred_level]" value="${skill.preferred_level || 1}">
        //             <div class="fv-row mb-2 fv-plugins-icon-container col-lg-9 d-flex gap-7">
        //                 <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
        //                     <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
        //                 </button>
        //                 <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center edit-skill" data-index="${skillIndex}">
        //                     <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
        //                 </button>
        //                 <input type="text" class="form-control input-style" id="technicalSkills[${skillIndex}]" 
        //                     name="technicalSkills[${skillIndex}][name]" placeholder="Technical Skill" 
        //                     value="${skill.name}" required readonly>
        //             </div>
        //             <div class="fv-row mb-2 fv-plugins-icon-container d-flex col-lg-3 btn-vl-container justify-content-end">
        //                 <select id="level[${skillIndex}]" name="technicalSkills[${skillIndex}][level]" class="form-select col-lg-7 col-md-10 btn-level mb-3 mb-lg-0 rounded-right">
        //                     ${Array.from({ length: 6 }, (_, i) => 6 - i)
        //                         .map(level => {
        //                             const descriptionKey = `level_${level}_description`;
        //                             const levelDescription = skill[descriptionKey] || null;
        //                             if (levelDescription) {
        //                                 return `<option value="${level}" 
            //                                     ${skill?.preferred_level == level ? 'selected' : ''} 
            //                                     class="dark:bg-slate-700">Level ${level}</option>`;
        //                             }
        //                             return '';
        //                         }).join('')}
        //                 </select>

        //                 <button type="button" id="selectTechLevelButton${skillIndex}" class="btn-view" 
        //                     data-bs-toggle="modal" data-bs-target="#techskillmodal" 
        //                     onclick="technicalpopulateModal(${skillIndex})">
        //                     View Level
        //                     <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
        //                 </button>
        //             </div>
        //         </div>
        //     `;
            // });

            skillRow.querySelector('.cancel-btn').addEventListener('click', function() {
                const skill = originalSkillData;

                // Revert full skill data
                technicalSkillsData[skillIndex] = skill;

                skillRow.outerHTML = `
        <div class="technical-skill row mb-8" id="skill-${skillIndex}">
            <input type="hidden" name="technicalSkills[${skillIndex}][description]" value="${skill.description}">
            <input type="hidden" name="technicalSkills[${skillIndex}][sector_name]" value="${skill.sector_name || ''}">
            <input type="hidden" name="technicalSkills[${skillIndex}][preferred_level]" value="${skill.preferred_level || 1}">

            <div class="d-flex gap-3 w-100 flex-nowrap overflow-hidden">
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
                        ${skill.preferred_level ? `Level ${skill?.preferred_level}` : 'Select Level'}
                    </button>
                </div>
            </div>
        </div>
    `;

                // Re-initialize Select2
                setTimeout(() => {
                    const newSkillRow = document.getElementById(`skill-${skillIndex}`);

                    // ❌ REMOVED: Duplicate .remove-skill event handler
                    // The global delegated handler at line ~5809 handles all .remove-skill clicks
                    // newSkillRow.querySelector('.remove-skill')?.addEventListener('click', function () {
                    //     const removeButton = this;
                    //     const skillElement = removeButton.closest('.technical-skill');
                    //     
                    //     // Show loading overlay while modal is prepared
                    //     try { if (typeof showOverlay === 'function') showOverlay(); } catch (e) {}
                    //     
                    //     // Show confirmation modal
                    //     ModalManager.open({
                    //         module: 'jobs',
                    //         key: 'delete_technical_skill',
                    //         data: {},
                    //         onSubmit(modalEl) {
                    //             // User confirmed removal - proceed with the removal
                    //             console.log("Skill removal confirmed for index:", skillIndex);
                    //             
                    //             delete technicalSkillsData[skillIndex];
                    //             skillElement.remove();
                    //             toggleRemoveSkillButtons();
                    //             
                    //             // Refresh comparison if active
                    //             if (comparisonActive) {
                    //                 const ajaxResponse = @json($cachedData);
                    //                 let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                    //                   .masterTechnicalSkills.length > 0 ?
                    //                   ajaxResponse.masterTechnicalSkills :
                    //                   (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : []);
                    //                 const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : [];
                    //                 const currentFormSkills = getCurrentFormSkills();
                    //
                    //                 const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                    //                 
                    //                 // Handle validation errors
                    //                 if (comparison.status === 'validation_error') {
                    //                   console.warn('Validation Error:', comparison.message);
                    //                 } else {
                    //                   renderComparison(comparison.comparisonResults);
                    //                   showComparisonSummary(comparison.comparisonResults);
                    //                 }
                    //             }
                    //             
                    //             // Close the modal and hide loading overlay
                    //             const bsModal = bootstrap.Modal.getInstance(modalEl);
                    //             if (bsModal) bsModal.hide();
                    //             try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
                    //         },
                    //         onShown(modalEl) {
                    //             // Hide loading overlay when modal is shown
                    //             try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
                    //         },
                    //         onError() {
                    //             // Hide loading overlay on error
                    //             try { if (typeof hideOverlay === 'function') hideOverlay(); } catch (e) {}
                    //         }
                    //     });
                    // });

                    // Re-bind Edit Button
                    // newSkillRow.querySelector('.edit-skill')?.addEventListener('click', function () {
                    $(document).off('click', '.edit-skill').on('click', '.edit-skill', function () {
                        const skillIndex = $(this).closest('.technical-skill').attr('id').replace('skill-', '');
                        const skillData = technicalSkillsData[skillIndex];

                        if (skillData.is_custom == 1 || skillData.is_custom == 2 || skillData.is_new == 1 || skillData.is_new_company_skill == 1) {
                            const modalEl = document.getElementById('CompanyTechnicalSkill');
                            modalEl.setAttribute('data-skill-index', skillIndex);
                            modalEl.querySelector('#companySkillName').textContent = skillData.name || 'Skill';
                            // new bootstrap.Modal(modalEl).show();
                            showOverlay();
 
                            $.ajax({
                                // url: `/admin/skill-job-count/${skillData.id || skillData.skill_id}`,
                                 url: `/admin/skill-job-count/${(skillData.is_new === 1 || skillData.is_new_company_skill === 1) ? null : skillData.id}`,
                                type: "GET",
                                dataType: "json",
                                success: function (data) {
                                    const countEl = modalEl.querySelector('#jobCount');
                                    if (countEl) {
                                        countEl.textContent = data.job_count || 0;
                                    }
                                    hideOverlay();
                                    new bootstrap.Modal(modalEl).show();
                                },
                                error: function (xhr, status, error) {
                                    console.error("Error fetching job count:", error);
                                    hideOverlay();
    
                                }
                            });
                        } else {
                            // const editModalEl = document.getElementById('EditTsfromMSL');
                            // editModalEl.setAttribute('data-skill-index', skillIndex);
                            // new bootstrap.Modal(editModalEl).show();
                            showOverlay();
                            $.ajax({
                            url: '{{ route('admin.checkSkill') }}', // Endpoint to check if skill has a master_technical_skill_id
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    skill_name: skillData.name,
                                    category_name: skillData.category_name,
                                     sector_name: skillData.sector_name,
                                    is_custom: 0,
                                },
                                success: function(response) {
                                    hideOverlay(); 
                                    // if (response.skillExists) {
                                        if (response.hasRelatedSkill) {
                                            const createModalEl = document.getElementById('CreateNewSkillModal');
                                            createModalEl.setAttribute('data-skill-index', skillIndex);
                                            new bootstrap.Modal(createModalEl).show();
                                        } else {
                                            const editModalEl = document.getElementById('EditTsfromMSL');
                                            editModalEl.setAttribute('data-skill-index', skillIndex);
                                            new bootstrap.Modal(editModalEl).show();
                                        }
                                    // }else {
                                    //     hideOverlay(); 
                                    //     console.log("Skill hi nahi mila");
                                    // }
                                },
                                error: function(error) {
                                    hideOverlay(); 
                                    console.log('Error checking skill:', error);
                                }
                            });
                        }
                    });

                    const selectEl = $(`#skill\\[${skillIndex}\\]`);
                    selectEl.select2({
    ajax: {
        url: '{{ route('admin.technical-skill.search') }}',
        dataType: 'json',
        delay: 250,
        data: function(params) {
            return {
                q: params.term,
                page: params.page || 1
            };
        },
        processResults: function(data, params) {
            params.page = params.page || 1;
            return {
                results: data.results,
                pagination: {
                    more: data.pagination.more
                }
            };
        },
        cache: true
    },
    language: {
        noResults: function () {
            return "No matches found";
        }
    },
    templateResult: function (data) {
        console.log('Data for templateResult:', data);
        if (data.loading) return data.text;
        const skillType = data.skill_type || '';
        const category = data.category || '';
        const sector   = data.sector || '';
         const name = cleanLabel(data.text); 
        return $(`
            <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
                    ${name}
                </span>
                <div class="d-flex gap-2">
                    ${skillType
                        ? skillType === 'Master Skill'
                            ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                            : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                        : ''
                    }
 
                    ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${sector || ''}">${sector}</span>` : ''}
                    ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${category || ''}">${category}</span>` : ''}
                </div>
            </div>
        `);
    },
    templateSelection: function (data) {
        console.log('Selected data:', data);
        if (!data.id) return data.text;
        const skillType = data.skill_type || '';
        const category = data.category || '';
        const sector   = data.sector || '';
         const name = cleanLabel(data.text); 
        if (skillType || sector || category) {
        return $(`
            <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
                    ${name}
                </span>
                <div class="d-flex gap-2">
                    ${skillType
                        ? skillType === 'Master Skill'
                            ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                            : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                        : ''
                    }
                    ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${sector || ''}">${sector}</span>` : ''}
                    ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${category || ''}">${category}</span>` : ''}
                </div>
            </div>
        `);
    }
        return $(`
            <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
                    ${name}
                </span>
                <div class="d-flex gap-2">
                    <span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Company Skill">Company Skill</span>
 
                    ${skill?.sector_name ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skill?.sector_name || ''}">${skill?.sector_name}</span>` : ''}
                    ${skill?.category_name ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skill?.category_name || ''}">${skill?.category_name}</span>` : ''}
                </div>
            </div>
        `);
    },
    placeholder: 'Search for a skill',
    minimumInputLength: 1,
    width: 'resolve'
});
 
// ✅ Re-init tooltips on dropdown open or selection
selectEl.on('select2:open select2:select', function () {
    $('[data-bs-toggle="tooltip"]').tooltip('dispose').tooltip();
});

// selectEl.on('change', function () {
//     const $this = $(this);
//     const selectedId   = $this.val();
//     const selectedText = $this.find('option:selected').text();

//     // extract index from the element's id e.g. "skill[3]"
//     const idMatch = $this.attr('id').match(/^skill\[(\d+)\]$/);
//     const idx = idMatch ? idMatch[1] : null;

//     if (!idx) return; // safety guard

//     if (selectedId) {
//         $(`#selectTechLevelButton${idx}`).prop('disabled', false);
//     }

//     $(`#technicalSkillsHidden\\[${idx}\\]`).val(selectedText);

//     // Fetch updated skill details
//     TechSkillChanged(idx, selectedId);
// });
selectEl.on('change', function () {
    const $this = $(this);
    const selectedId   = $this.val();
    const selectedText = $this.find('option:selected').text();

    // extract index from the element's id e.g. "skill[3]"
    const idMatch = $this.attr('id').match(/^skill\[(\d+)\]$/);
    const idx = idMatch ? idMatch[1] : null;

    if (!idx) return; // safety guard

    if (!selectedId) {
        // Reset if nothing selected
        $(`#technicalSkillsHidden\\[${idx}\\]`).val('');
        $(`#selectTechLevelButton${idx}`).prop('disabled', true);
        return;
    }

    // ⚡ Pass $this into TechSkillChanged so it can reset if duplicate
    TechSkillChanged(idx, selectedId, $this);
});

                    // selectEl.select2({
                    //     placeholder: 'Search for a skill',
                    //     width: 'resolve'
                    // });

                    // selectEl.on('change', function() {
                    //     const selectedText = $(this).find('option:selected').text();
                    //     $(`#technicalSkillsHidden\\[${skillIndex}\\]`).val(selectedText);
                    // });
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
            // skillRow.querySelector('.accept-btn').addEventListener('click', function () {
            //     const nameInput = skillRow.querySelector(`input[name="technicalSkills[${skillIndex}][name]"]`);
            //     const descTextarea = skillRow.querySelector(`textarea[name="technicalSkills[${skillIndex}][description]"]`);

            //     console.log('skillIndex:', technicalSkillsData);

            //     // Update technicalSkillsData
            //     const skill = technicalSkillsData[skillIndex];
            //     skill.name = nameInput.value.trim();
            //     skill.description = descTextarea.value.trim();
            //     skill.is_modified = 1; // Mark as modified

            //     // Optional: you could also store preferred level
            //     // skill.preferred_level = some dropdown input value if needed

            //     // Sync to hidden input
            //     document.getElementById('technicalSkillsJson').value = JSON.stringify(technicalSkillsData);

            //     // Generate hidden inputs
            //     const hiddenInputs = `
        //         <input type="hidden" name="technicalSkills[${skillIndex}][description]" value="${skill.description}">
        //         <input type="hidden" name="technicalSkills[${skillIndex}][sector_name]" value="${skill.sector_name || ''}">
        //         <input type="hidden" name="technicalSkills[${skillIndex}][preferred_level]" value="${skill.preferred_level || 1}">
        //     `;

            //     // Build updated DOM using your original card format
            //     skillRow.outerHTML = `
        //         <div class="technical-skill row mb-8" id="skill-${skillIndex}">
        //             ${hiddenInputs}
        //             <div class="fv-row mb-2 fv-plugins-icon-container col-lg-9 d-flex gap-7">
        //                 <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
        //                     <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
        //                 </button>
        //                 <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center edit-skill" data-index="${skillIndex}">
        //                     <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
        //                 </button>
        //                 <input type="text" class="form-control input-style" id="technicalSkills[${skillIndex}]" 
        //                     name="technicalSkills[${skillIndex}][name]" placeholder="Technical Skill" 
        //                     value="${skill.name}" required readonly>
        //             </div>
        //             <div class="fv-row mb-2 fv-plugins-icon-container d-flex col-lg-3 btn-vl-container justify-content-end">
        //                 <select id="level[${skillIndex}]" name="technicalSkills[${skillIndex}][level]" class="form-select col-lg-7 col-md-10 btn-level mb-3 mb-lg-0 rounded-right">
        //                     ${Array.from({ length: 6 }, (_, i) => 6 - i)
        //                         .map(level => {
        //                             const descriptionKey = `level_${level}_description`;
        //                             const levelDescription = skill[descriptionKey] || null;
        //                             if (levelDescription) {
        //                                 return `<option value="${level}" 
            //                                     ${skill?.preferred_level == level ? 'selected' : ''} 
            //                                     class="dark:bg-slate-700">Level ${level}</option>`;
        //                             }
        //                             return '';
        //                         }).join('')}
        //                 </select>

        //                 <button type="button" id="selectTechLevelButton${skillIndex}" class="btn-view" 
        //                     data-bs-toggle="modal" data-bs-target="#techskillmodal" 
        //                     onclick="technicalpopulateModal(${skillIndex})">
        //                     View Level
        //                     <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
        //                 </button>
        //             </div>
        //         </div>
        //     `;
            // });

//             skillRow.querySelector('.accept-btn').addEventListener('click', function() {
//                 const nameInput = skillRow.querySelector(`input[name="technicalSkills[${skillIndex}][name]"]`);
//                 const descTextarea = skillRow.querySelector(
//                     `textarea[name="technicalSkills[${skillIndex}][description]"]`);
//                 const originalName = nameInput.dataset.original?.trim() || '';
//                 const newName = nameInput.value.trim();
//                 const isRenamed = originalName !== newName;

//                 // Update technicalSkillsData
//                 const skill = technicalSkillsData[skillIndex];
//                 skill.name = newName;
//                 skill.description = descTextarea.value.trim();
//                 skill.is_modified = 1;

//                   // Dynamically check the description for the given preferred_level
//                 let levelDescriptionKey = `level_${skill.preferred_level}_description`;  // e.g., level_3_description for preferred_level = 3
//                 let levelDescription = skill[levelDescriptionKey] || '';  // Get the description or empty if not found

//                 // If no valid level description exists, reset preferred_level to '' (or 'Select Level')
//                 if (!levelDescription) {
//                     skill.preferred_level = ''; // Reset to empty if no description found
//                 }

//                 if (skill.is_modify != 1) {
//                     const successModal = new bootstrap.Modal(document.getElementById('SuccessModal'));

//                     let cleanText = (skill.name || '').split('(')[0].trim();
//                     document.getElementById('SuccessModal')
//                         .querySelector('#SkillName')
//                         .textContent = cleanText || 'Skill';

//                         skill.is_new_company_skill = 1 ;

//                     successModal.show(); // ✅ sirf tab chalega jab is_modify 1 nahi hai
//                 }

//                 // Sync JSON (optional if you use it elsewhere)
//                 document.getElementById('technicalSkillsJson').value = JSON.stringify(technicalSkillsData);

//                 console.log('Updated skill data:', selectedValue);

//                 // Re-render updated DOM
//                 skillRow.outerHTML = `
//                     <div class="technical-skill row mb-8" id="skill-${skillIndex}">
//                         <input type="hidden" name="technicalSkills[${skillIndex}][description]" value="${skill.description}">
//                         <input type="hidden" name="technicalSkills[${skillIndex}][sector_name]" value="${skill.sector_name || ''}">
//                         <input type="hidden" name="technicalSkills[${skillIndex}][preferred_level]" value="${skill.preferred_level || 1}">

//                         <div class="d-flex gap-3 w-100 flex-nowrap overflow-hidden">
//                             <!-- Trash Button -->
//                             <div class="flex-shrink-0">
//                                 <button type="button" class="btn btn-outline btn-outline-primary d-flex  align-items-center justify-content-center remove-skill">
//                                     <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
//                                 </button>
//                             </div>

//                             <!-- Select Dropdown -->
//                             <div class="flex-shrink-0">
//                                 <button type="button" class="btn btn-outline btn-outline-primary d-flex  align-items-center justify-content-center edit-skill" data-index="${skillIndex}">
//                                     <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
//                                 </button>
//                             </div>

//                             <!-- Select box -->
//                             <div class="flex-grow-1 overflow-hidden">
//                                 <select id="skill[${skillIndex}]" name="technicalSkills[${skillIndex}][id]" 
//                                     class="form-control select-skill select2-skill text-truncate w-100" data-index="${skillIndex}">
//                                     <option value="${skill.skill_id}" selected>
//                                         ${skill.name}
//                                     </option>

                                    
//                                 </select>
//                             </div>
//                             <input type="hidden" id="technicalSkillsHidden[${skillIndex}]" 
//                                 name="technicalSkills[${skillIndex}][name]" value="${skill.name}">
//                             <div class="flex-shrink-0">
//                                 <button type="button" id="selectTechLevelButton${skillIndex}" class="btn-view edit-level-btn" 
//                                 style="
//                                     color: #071437;
//                                     border-color: #DBDFE9;
//                                     justify-content: left;
//                                     padding-left: 12px;"
//                                     data-bs-toggle="modal" data-bs-target="#techskillmodal" 
//                                     onclick="technicalpopulateModal(${skillIndex})">
//                                      ${skill.preferred_level ? `Level ${skill.preferred_level}` : "Select Level"}
//                                 </button>
//                             </div>
//                         </div>
//                     </div>
//                 `;

//                 // Re-initialize Select2 for new element
//                 setTimeout(() => {
//                     const newSkillRow = document.getElementById(`skill-${skillIndex}`);

//                     // Re-bind Remove Button
//                     newSkillRow.querySelector('.remove-skill')?.addEventListener('click', function () {
//                         delete technicalSkillsData[skillIndex];
//                         this.closest('.technical-skill').remove();
//                         toggleRemoveSkillButtons();
//                     });

//                     // Re-bind Edit Button
//                     // newSkillRow.querySelector('.edit-skill')?.addEventListener('click', function () {
//                     $(document).off('click', '.edit-skill').on('click', '.edit-skill', function () {
//                         const skillIndex = $(this).closest('.technical-skill').attr('id').replace('skill-', '');
//                         const skillData = technicalSkillsData[skillIndex];

//                         if (skillData.is_custom == 1 || skillData.is_custom == 2) {
//                             const modalEl = document.getElementById('CompanyTechnicalSkill');
//                             modalEl.setAttribute('data-skill-index', skillIndex);
//                             modalEl.querySelector('#companySkillName').textContent = skillData.name || 'Skill';
//                             // new bootstrap.Modal(modalEl).show();
//                             showOverlay();
 
//                             $.ajax({
//                                 url: `/admin/skill-job-count/${skillData.id}`,
//                                 type: "GET",
//                                 dataType: "json",
//                                 success: function (data) {
//                                     const countEl = modalEl.querySelector('#jobCount');
//                                     if (countEl) {
//                                         countEl.textContent = data.job_count || 0;
//                                     }
//                                     hideOverlay();
//                                     new bootstrap.Modal(modalEl).show();
//                                 },
//                                 error: function (xhr, status, error) {
//                                     console.error("Error fetching job count:", error);
//                                     hideOverlay();
    
//                                 }
//                             });
//                         } else {
//                             // const editModalEl = document.getElementById('EditTsfromMSL');
//                             // editModalEl.setAttribute('data-skill-index', skillIndex);
//                             // new bootstrap.Modal(editModalEl).show();
//                              showOverlay();
//                             $.ajax({
//                             url: '{{ route('admin.checkSkill') }}', // Endpoint to check if skill has a master_technical_skill_id
//                                 method: 'POST',
//                                 headers: {
//                                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                                 },
//                                 data: {
//                                     skill_name: skillData.name,
//                                     category_name: skillData.category_name,
//                                      sector_name: skillData.sector_name,
//                                     is_custom: 0,
//                                 },
//                                 success: function(response) {
//                                     hideOverlay(); 
//                                     // if (response.skillExists) {
//                                         if (response.hasRelatedSkill) {
//                                             const createModalEl = document.getElementById('CreateNewSkillModal');
//                                             createModalEl.setAttribute('data-skill-index', skillIndex);
//                                             new bootstrap.Modal(createModalEl).show();
//                                         } else {
//                                             const editModalEl = document.getElementById('EditTsfromMSL');
//                                             editModalEl.setAttribute('data-skill-index', skillIndex);
//                                             new bootstrap.Modal(editModalEl).show();
//                                         }
//                                     // }else {
//                                     //     hideOverlay(); 
//                                     //     console.log("Skill hi nahi mila");
//                                     // }
//                                 },
//                                 error: function(error) {
//                                     hideOverlay(); 
//                                     console.log('Error checking skill:', error);
//                                 }
//                             });
//                         }
//                     });
//                     const selectEl = $(`#skill\\[${skillIndex}\\]`);
//                     selectEl.select2({
//     ajax: {
//         url: '{{ route('admin.technical-skill.search') }}',
//         dataType: 'json',
//         delay: 250,
//         data: function(params) {
//             return {
//                 q: params.term,
//                 page: params.page || 1
//             };
//         },
//         processResults: function(data, params) {
//             params.page = params.page || 1;
//             return {
//                 results: data.results,
//                 pagination: {
//                     more: data.pagination.more
//                 }
//             };
//         },
//         cache: true
//     },
//     templateResult: function (data) {
//         console.log('Data for templateResult:', data);
//         if (data.loading) return data.text;
//         const skillType = data.skill_type || '';
//         const category = data.category || '';
//         const sector   = data.sector || '';
//          const name = cleanLabel(data.text); 
//         return $(`
//             <div class="d-flex justify-content-between align-items-center w-100 gap-6">
//                 <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
//                     ${name}
//                 </span>
//                 <div class="d-flex gap-2">
//                     ${skillType
//                         ? skillType === 'Master Skill'
//                             ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-title="${skillType || ''}">${skillType}</span>`
//                             : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-title="${skillType || ''}">${skillType}</span>`
//                         : ''
//                     }
 
//                     ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-title="${sector || ''}">${sector}</span>` : ''}
//                     ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-title="${category || ''}">${category}</span>` : ''}
//                 </div>
//             </div>
//         `);
//     },
//     templateSelection: function (data) {
//         console.log('Selected data:', data);
//         if (!data.id) return data.text;
//         const skillType = data.skill_type || '';
//         const category = data.category || '';
//         const sector   = data.sector || '';
//          const name = cleanLabel(data.text); 
//         if (skillType || sector || category) {
//         return $(`
//             <div class="d-flex justify-content-between align-items-center w-100 gap-6">
//                 <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
//                     ${name}
//                 </span>
//                 <div class="d-flex gap-2">
//                     ${skillType
//                         ? skillType === 'Master Skill'
//                             ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-title="${skillType || ''}">${skillType}</span>`
//                             : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-title="${skillType || ''}">${skillType}</span>`
//                         : ''
//                     }
//                     ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-title="${sector || ''}">${sector}</span>` : ''}
//                     ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-title="${category || ''}">${category}</span>` : ''}
//                 </div>
//             </div>
//         `);
//     }
//         return $(`
//             <div class="d-flex justify-content-between align-items-center w-100 gap-6">
//                 <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
//                     ${name}
//                 </span>
//                 <div class="d-flex gap-2">
//                     <span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-title="Company Skill">Company Skill</span>
 
//                     ${skill?.sector_name ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-title="${skill?.sector_name || ''}">${skill?.sector_name}</span>` : ''}
//                     ${skill?.category_name ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-title="${skill?.category_name || ''}">${skill?.category_name}</span>` : ''}
//                 </div>
//             </div>
//         `);
//     },
//     placeholder: 'Search for a skill',
//     minimumInputLength: 1,
//     width: 'resolve'
// });
 
// // ✅ Re-init tooltips on dropdown open or selection
// selectEl.on('select2:open select2:select', function () {
//     $('[data-bs-toggle="tooltip"]').tooltip('dispose').tooltip();
// });

//                     // selectEl.select2({
//                     //     placeholder: 'Search for a skill',
//                     //     width: 'resolve'
//                     // });

//                     // selectEl.on('change', function() {
//                     //     const selectedText = $(this).find('option:selected').text();
//                     //     $(`#technicalSkillsHidden\\[${skillIndex}\\]`).val(selectedText);
//                     // });
//                 }, 10);

//                 // Close modal
//                 const modal = bootstrap.Modal.getInstance(document.getElementById('EditTsfromMSL'));
//                 if (modal) modal.hide();
//             });


//  skillRow.querySelector('.accept-btn').addEventListener('click', function () {
//     const nameInput = skillRow.querySelector(`input[name="technicalSkills[${skillIndex}][name]"]`);
//     const descTextarea = skillRow.querySelector(`textarea[name="technicalSkills[${skillIndex}][description]"]`);

//     const skill = technicalSkillsData[skillIndex];
//     skill.name = (nameInput?.value || '').trim();
//     skill.description = (descTextarea?.value || '').trim();
//     skill.is_modified = 1; // use one key consistently
//      skill.is_modify = skill.is_modify ?? 0; 

//     // validate preferred level content
//     const levelKey = `level_${skill.preferred_level}_description`;
//     const levelDescription = skill[levelKey] || '';
//     if (!levelDescription) {
//       skill.preferred_level = ''; // reset if not available
//     }

//     // Conditions: either your legacy flag is set OR the row carried pending overwrite intent
//     const shouldOverwrite = (triggerOverwriteConfirmAfterSave === true) || (skill._pendingOverwrite === true);

//      if (shouldOverwrite) {
//       // backup so cancel can revert
//       window.originalSkillBeforeEdit = JSON.parse(JSON.stringify(skill));
//       // reset both flags to avoid loops
//       triggerOverwriteConfirmAfterSave = false;
//       skill._pendingOverwrite = false;
//       // open confirm modal and load affected jobs
//       showOverwriteConfirm(skillIndex);
//     } else {
//         console.log('Updated skill:', skill);

//     console.log('originalSkillData', originalSkillData);
//     // ✅ Success modal sirf tab jab overwrite confirm nahi hua ho
//     const isOverwritten = Object.prototype.hasOwnProperty.call(skill, 'is_modify') && Number(skill.is_modify) === 1;
//     if (!isOverwritten) {
//       const successEl = document.getElementById('SuccessModal');
//       if (successEl) {
//         const successModal = new bootstrap.Modal(successEl);
//         const cleanText = (skill.name || '').split('(')[0].trim();
//         successEl.querySelector('#SkillName').textContent = cleanText || 'Skill';
//         skill.is_new_company_skill = 1;
//         successModal.show();
//       }
//     }
//   }

//     // sync hidden field
//     const hidden = document.getElementById('technicalSkillsJson');
//     if (hidden) hidden.value = JSON.stringify(technicalSkillsData);

//     // Should we show Overwrite Confirm?
    

//     // re-render read-only row (same structure you already use)
//     skillRow.outerHTML = `
//       <div class="technical-skill row mb-8" id="skill-${skillIndex}">
//         <input type="hidden" name="technicalSkills[${skillIndex}][description]" value="${esc(skill.description)}">
//         <input type="hidden" name="technicalSkills[${skillIndex}][sector_name]" value="${esc(skill.sector_name || '')}">
//         <input type="hidden" name="technicalSkills[${skillIndex}][preferred_level]" value="${esc(skill.preferred_level || 1)}">

//         <div class="d-flex gap-3 w-100 flex-nowrap overflow-hidden">
//           <div class="flex-shrink-0">
//             <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center remove-skill">
//               <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
//             </button>
//           </div>
//           <div class="flex-shrink-0">
//             <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center edit-skill" data-index="${skillIndex}">
//               <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
//             </button>
//           </div>
//           <div class="flex-grow-1 overflow-hidden">
//             <select id="skill[${skillIndex}]" name="technicalSkills[${skillIndex}][id]" 
//               class="form-control select-skill select2-skill text-truncate w-100" data-index="${skillIndex}">
//               <option value="${esc(skill.skill_id)}" selected>${esc(skill.name)}</option>
//             </select>
//           </div>
//           <input type="hidden" id="technicalSkillsHidden[${skillIndex}]" 
//             name="technicalSkills[${skillIndex}][name]" value="${esc(skill.name)}">
//           <div class="flex-shrink-0">
//             <button type="button" id="selectTechLevelButton${skillIndex}" class="btn-view edit-level-btn"
//               data-bs-toggle="modal" data-bs-target="#techskillmodal"
//               onclick="technicalpopulateModal(${skillIndex})">
//               ${skill.preferred_level ? `Level ${esc(skill.preferred_level)}` : 'Select Level'}
//             </button>
//           </div>
//         </div>
//       </div>
//     `;

//     // re-init select2
//     setTimeout(() => initSkillSelect2(skillIndex), 0);

//     // close edit modal if present
//     const m = bootstrap.Modal.getInstance(document.getElementById('EditTsfromMSL'));
//     if (m) m.hide();
//   });

// Helper function to attach event listeners to skill rows after DOM recreation
function attachSkillRowEventListeners(skillIndex) {
  const skillRow = document.getElementById(`skill-${skillIndex}`);
  if (!skillRow) return;

  // ❌ REMOVED: Direct .remove-skill event listener
  // The global delegated handler at line ~5809 handles all .remove-skill clicks
  // No need to attach direct event listeners here as it causes duplicate modal calls
  
  // NOTE: If you need to attach other event listeners (like edit button, etc.),
  // you can add them here. But .remove-skill is handled globally.
}

function deepEqual(a, b) {
  if (a === b) return true;
  if (a && b && typeof a === 'object' && typeof b === 'object') {
    if (Array.isArray(a)) {
      if (!Array.isArray(b) || a.length !== b.length) return false;
      for (let i = 0; i < a.length; i++) if (!deepEqual(a[i], b[i])) return false;
      return true;
    }
    const ak = Object.keys(a), bk = Object.keys(b);
    if (ak.length !== bk.length) return false;
    for (const k of ak) if (!bk.includes(k) || !deepEqual(a[k], b[k])) return false;
    return true;
  }
  return Number.isNaN(a) && Number.isNaN(b);
}

function sanitizeForDiff(obj) {
  const s = JSON.parse(JSON.stringify(obj || {}));

  // meta/volatile flags that shouldn't count as "change"
  ['is_modify','is_modified','is_new_company_skill','_pendingOverwrite','updated_at','created_at']
    .forEach(k => delete s[k]);

  // normalize text & empties
  ['name','description','sector_name','category_name'].forEach(k => {
    if (s[k] == null) s[k] = '';
    if (typeof s[k] === 'string') s[k] = s[k].trim();
  });

  // preferred_level ko normalize: agar us level ki description nahi to ''
  if (s.preferred_level == null) s.preferred_level = '';
  const lk = `level_${s.preferred_level}_description`;
  if (!s[lk]) s.preferred_level = '';

  return s;
}

// aapki purani naming ko support karne ke liye:
function deepComEqual(a, b) { return deepEqual(a, b); }
function esc(s=''){return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;')
  .replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#39;');}


  skillRow.querySelector('.accept-btn').addEventListener('click', function (e) {
  e.preventDefault();

  const nameInput = skillRow.querySelector(`input[name="technicalSkills[${skillIndex}][name]"]`);
  const descTextarea = skillRow.querySelector(`textarea[name="technicalSkills[${skillIndex}][description]"]`);

  const newName = (nameInput?.value || '').trim();
    const newDesc = (descTextarea?.value || '').trim();
    if (!newName || !newDesc) {
        alert('Please fill the data.');
        return;
    }

  const skill = technicalSkillsData[skillIndex];

  // ---- latest edits (mutate in-memory) ----
  skill.name = (nameInput?.value || '').trim();
  skill.description = (descTextarea?.value || '').trim();
  skill.is_modified = 1; // NOTE: is_modify ko yahan set/clear mat karo
  skill.is_modify = skill.is_modify ?? 0;

  // preferred_level sanity (normalization sanitize me bhi ho rahi, yeh UI ke liye ok)
  const levelKey = `level_${skill.preferred_level}_description`;
  if (!skill[levelKey]) skill.preferred_level = '';

  // 1) Overwrite path FIRST
  const shouldOverwrite = (triggerOverwriteConfirmAfterSave === true) || (skill._pendingOverwrite === true);
  if (shouldOverwrite) {
        window.originalSkillBeforeEdit = JSON.parse(JSON.stringify(skill)); // backup for cancel
        triggerOverwriteConfirmAfterSave = false;
        skill._pendingOverwrite = false;

        // Register a pending continuation that will run when the user confirms overwrite in the modal
        // Keep it lightweight: try to call renderInlineSkillEdit if the app exposes it, otherwise no-op
                window._pendingOverwriteHandler = function() {
                        try {
                                // First, persist the JSON state so server will get updated data on form submit
                                const hiddenA = document.getElementById('technicalSkillsJson');
                                if (hiddenA) hiddenA.value = JSON.stringify(technicalSkillsData);

                                // Re-render read-only row (same markup that was previously applied immediately)
                                try {
                                    const skill = technicalSkillsData[skillIndex];
                                    const rowHtml = `
        <div class="technical-skill row mb-8" id="skill-${skillIndex}">
            <input type="hidden" name="technicalSkills[${skillIndex}][description]" value="${esc(skill.description)}">
            <input type="hidden" name="technicalSkills[${skillIndex}][sector_name]" value="${esc(skill.sector_name || '')}">
            <input type="hidden" name="technicalSkills[${skillIndex}][preferred_level]" value="${esc(skill.preferred_level || 1)}">
            <div class="d-flex gap-3 w-100 flex-nowrap overflow-hidden">
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center remove-skill">
                        <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
                    </button>
                </div>
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center edit-skill" data-index="${skillIndex}">
                        <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
                    </button>
                </div>
                <div class="flex-grow-1 overflow-hidden">
                    <select id="skill[${skillIndex}]" name="technicalSkills[${skillIndex}][id]" 
                        class="form-control select-skill select2-skill text-truncate w-100" data-index="${skillIndex}">
                        <option value="${esc(skill.skill_id)}" selected>${esc(skill.name)}</option>
                    </select>
                </div>
                <input type="hidden" id="technicalSkillsHidden[${skillIndex}]" 
                    name="technicalSkills[${skillIndex}][name]" value="${esc(skill.name)}">
                <div class="flex-shrink-0">
                    <button type="button" id="selectTechLevelButton${skillIndex}" class="btn-view edit-level-btn"
                        data-bs-toggle="modal" data-bs-target="#techskillmodal"
                        onclick="technicalpopulateModal(${skillIndex})">
                        ${skill.preferred_level ? `Level ${esc(skill.preferred_level)}` : 'Select Level'}
                    </button>
                </div>
            </div>
        </div>
    `;

                                    const oldRow = document.getElementById(`skill-${skillIndex}`);
                                    if (oldRow) {
                                        oldRow.outerHTML = rowHtml;
                                    } else {
                                        const container = document.getElementById('skills-container');
                                        if (container) {
                                            // Guard: try to remove any existing duplicate row that contains
                                            // a hidden input with the same skill name to avoid creating
                                            // duplicate entries when the original row element cannot
                                            // be found (e.g. restored skills or index changes).
                                            try {
                                                const skillName = (skill && skill.name) ? String(skill.name).trim() : '';
                                                if (skillName) {
                                                    const duplicates = Array.from(container.querySelectorAll('.technical-skill'))
                                                        .filter(el => {
                                                            const hidden = el.querySelector('input[type=hidden][name^="technicalSkills"][value]');
                                                            return hidden && String(hidden.value).trim() === skillName;
                                                        });
                                                    duplicates.forEach(d => d.remove());
                                                }
                                            } catch (e) {
                                                // if any error occurs during duplicate removal, fall back to insert
                                                console.warn('duplicate removal failed', e);
                                            }

                                            insertOrReplaceSkillRow(rowHtml, skillIndex, skill && skill.name ? skill.name : '');
                                        }
                                    }
                                    setTimeout(() => { 
                                        if (typeof initSkillSelect2 === 'function') initSkillSelect2(skillIndex); 
                                        
                                        // ✅ Re-attach event listeners including delete button
                                        attachSkillRowEventListeners(skillIndex);
                                        
                                        // ✅ Toggle remove buttons to disable if only 1 skill remains
                                        if (typeof toggleRemoveSkillButtons === 'function') toggleRemoveSkillButtons();
                                        
                                        // ✅ Refresh comparison to remove green highlighting after overwrite
                                        if (comparisonActive) {
                                            console.log('Overwrite confirmed: Refreshing comparison to remove green highlight');
                                            const ajaxResponse = @json($cachedData);
                                            let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse.masterTechnicalSkills.length > 0 ?
                                                ajaxResponse.masterTechnicalSkills :
                                                (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : []);
                                            const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : [];
                                            const currentFormSkills = getCurrentFormSkills();
                                            const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                                            
                                            if (comparison.status === 'validation_error') {
                                                console.warn('Validation Error:', comparison.message);
                                            } else {
                                                console.log('Overwrite: Rendering comparison without green highlight');
                                                renderComparison(comparison.comparisonResults);
                                                showComparisonSummary(comparison.comparisonResults);
                                            }
                                        }
                                    }, 10);
                                } catch (innerErr) { console.error('rendering row in pending handler failed', innerErr); }

                        } catch (err) {
                                console.error('pendingOverwriteHandler failed', err);
                        } finally {
                                // cleanup
                                try { delete window._pendingOverwriteHandler; } catch(e){}
                        }
                };

    showOverwriteConfirm(skillIndex);

    // Defer any UI mutation and JSON sync until the user actually confirms overwrite.
    // The pending handler will perform the hidden input update and re-render the read-only row.
    // (window._pendingOverwriteHandler already registered above)

  const m = bootstrap.Modal.getInstance(document.getElementById('EditTsfromMSL'));
  if (m) m.hide();
  }else {

  // 2) Non-overwrite → diff check against original snapshot
  // NOTE: make sure renderInlineSkillEdit ke start me aapne yeh set kiya ho:
  // const originalSkillData = JSON.parse(JSON.stringify(skillData));
  const changesDetected = !deepComEqual(
    sanitizeForDiff(originalSkillData),
    sanitizeForDiff(skill)
  );
  console.log('Changes detected?', changesDetected, { original: originalSkillData, latest: skill });

  if (!changesDetected) {
    // ---- NO CHANGES → show NoChangesModal and bail ----
    const modalEl = document.getElementById('NoChangesCompanyModal');
    if (modalEl) {
      modalEl.setAttribute('data-skill-index', skillIndex);
      const noChangesModal = new bootstrap.Modal(modalEl);
      noChangesModal.show();

      const contBtn = modalEl.querySelector('.continue-btn');
      if (contBtn) {
        contBtn.addEventListener('click', function onContinue() {
          contBtn.removeEventListener('click', onContinue);
          noChangesModal.hide();

          modalEl.addEventListener('hidden.bs.modal', function onHidden() {
            modalEl.removeEventListener('hidden.bs.modal', onHidden);

            // revert data
            technicalSkillsData[skillIndex] = JSON.parse(JSON.stringify(originalSkillData));
            const hidden = document.getElementById('technicalSkillsJson');
            if (hidden) hidden.value = JSON.stringify(technicalSkillsData);

            // re-render read-only row
            const s = technicalSkillsData[skillIndex];
            const row = document.getElementById(`skill-${skillIndex}`);
            if (row) {
              row.outerHTML = `
                <div class="technical-skill row mb-8" id="skill-${skillIndex}">
                  <input type="hidden" name="technicalSkills[${skillIndex}][description]" value="${esc(s.description)}">
                  <input type="hidden" name="technicalSkills[${skillIndex}][sector_name]" value="${esc(s.sector_name || '')}">
                  <input type="hidden" name="technicalSkills[${skillIndex}][preferred_level]" value="${esc(s.preferred_level || 1)}">
                  <div class="d-flex gap-3 w-100 flex-nowrap overflow-hidden">
                    <div class="flex-shrink-0">
                      <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center remove-skill">
                        <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
                      </button>
                    </div>
                    <div class="flex-shrink-0">
                      <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center edit-skill" data-index="${skillIndex}">
                        <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
                      </button>
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                      <select id="skill[${skillIndex}]" name="technicalSkills[${skillIndex}][id]" 
                        class="form-control select-skill select2-skill text-truncate w-100" data-index="${skillIndex}">
                        <option value="${esc(s.skill_id)}" selected>${esc(s.name)}</option>
                      </select>
                    </div>
                    <input type="hidden" id="technicalSkillsHidden[${skillIndex}]" 
                      name="technicalSkills[${skillIndex}][name]" value="${esc(s.name)}">
                    <div class="flex-shrink-0">
                      <button type="button" id="selectTechLevelButton${skillIndex}" class="btn-view edit-level-btn"
                        data-bs-toggle="modal" data-bs-target="#techskillmodal"
                        onclick="technicalpopulateModal(${skillIndex})">
                        ${s?.preferred_level ? `Level ${esc(s.preferred_level)}` : 'Select Level'}
                      </button>
                    </div>
                  </div>
                </div>
              `;
              setTimeout(() => {
                const selectEl = $(`#skill\\[${skillIndex}\\]`);
                selectEl.select2({
                  ajax: {
                    url: '{{ route('admin.technical-skill.search') }}',
                    dataType: 'json',
                    delay: 250,
                    data: p => ({ q: p.term, page: p.page || 1 }),
                    processResults: (data, p) => ({
                      results: data.results,
                      pagination: { more: data.pagination.more }
                    }),
                    cache: true
                  },
                  language: {
                    noResults: function () {
                        return "No matches found";
                    }
                },
                  templateResult: function (data) {
                    console.log('Data for templateResult:', data);
                    if (data.loading) return data.text;
                    const skillType = data.skill_type || '';
                    const category = data.category || '';
                    const sector   = data.sector || '';
                    const name = cleanLabel(data.text); 
                    return $(`
                        <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                            <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
                                ${name}
                            </span>
                            <div class="d-flex gap-2">
                                ${skillType
                                    ? skillType === 'Master Skill'
                                        ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                                        : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                                    : ''
                                }
            
                                ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${sector || ''}">${sector}</span>` : ''}
                                ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${category || ''}">${category}</span>` : ''}
                            </div>
                        </div>
                    `);
                },
                templateSelection: function (data) {
                    console.log('Selected data:', data);
                    if (!data.id) return data.text;
                    const skillType = data.skill_type || '';
                    const category = data.category || '';
                    const sector   = data.sector || '';
                    const name = cleanLabel(data.text); 
                    if (skillType || sector || category) {
                    return $(`
                        <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                            <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
                                ${name}
                            </span>
                            <div class="d-flex gap-2">
                                ${skillType
                                    ? skillType === 'Master Skill'
                                        ? `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                                        : `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skillType || ''}">${skillType}</span>`
                                    : ''
                                }
                                ${sector ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${sector || ''}">${sector}</span>` : ''}
                                ${category ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${category || ''}">${category}</span>` : ''}
                            </div>
                        </div>
                    `);
                }
                    return $(`
                        <div class="d-flex justify-content-between align-items-center w-100 gap-6">
                            <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${name || ''}">
                                ${name}
                            </span>
                            <div class="d-flex gap-2">
                                <span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Company Skill">Company Skill</span>
            
                                ${skill?.sector_name ? `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skill?.sector_name || ''}">${skill?.sector_name}</span>` : ''}
                                ${skill?.category_name ? `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${skill?.category_name || ''}">${skill?.category_name}</span>` : ''}
                            </div>
                        </div>
                    `);
                },
                  placeholder: 'Search for a skill',
                  minimumInputLength: 1,
                  width: 'resolve'
                });
                selectEl.on('select2:open select2:select', function () {
                    $('[data-bs-toggle="tooltip"]').tooltip('dispose').tooltip();
                });
                // selectEl.on('change', function () {
                //     const $this = $(this);
                //     const selectedId   = $this.val();
                //     const selectedText = $this.find('option:selected').text();

                //     // extract index from the element's id e.g. "skill[3]"
                //     const idMatch = $this.attr('id').match(/^skill\[(\d+)\]$/);
                //     const idx = idMatch ? idMatch[1] : null;

                //     if (!idx) return; // safety guard

                //     if (selectedId) {
                //         $(`#selectTechLevelButton${idx}`).prop('disabled', false);
                //     }

                //     $(`#technicalSkillsHidden\\[${idx}\\]`).val(selectedText);

                //     // Fetch updated skill details
                //     TechSkillChanged(idx, selectedId);
                // });
                selectEl.on('change', function () {
    const $this = $(this);
    const selectedId   = $this.val();
    const selectedText = $this.find('option:selected').text();

    // extract index from the element's id e.g. "skill[3]"
    const idMatch = $this.attr('id').match(/^skill\[(\d+)\]$/);
    const idx = idMatch ? idMatch[1] : null;

    if (!idx) return; // safety guard

    if (!selectedId) {
        // Reset if nothing selected
        $(`#technicalSkillsHidden\\[${idx}\\]`).val('');
        $(`#selectTechLevelButton${idx}`).prop('disabled', true);
        return;
    }

    // ⚡ Pass $this into TechSkillChanged so it can reset if duplicate
    TechSkillChanged(idx, selectedId, $this);
});

                // ✅ Attach event listeners to the recreated row
                attachSkillRowEventListeners(skillIndex);
                // ✅ Toggle remove buttons to disable if only 1 skill remains
                if (typeof toggleRemoveSkillButtons === 'function') toggleRemoveSkillButtons();
                
                // Refresh comparison if active to preserve green highlighting for new skills
                console.log('NoChangesCompanyModal Continue: Checking comparisonActive =', comparisonActive);
                if (comparisonActive) {
                    console.log('NoChangesCompanyModal Continue: Refreshing comparison to maintain green highlight');
                    const ajaxResponse = @json($cachedData);
                    let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                      .masterTechnicalSkills.length > 0 ?
                      ajaxResponse.masterTechnicalSkills :
                      (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : []);
                    const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : [];
                    const currentFormSkills = getCurrentFormSkills();

                    const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                    
                    // Handle validation errors
                    if (comparison.status === 'validation_error') {
                      console.warn('Validation Error:', comparison.message);
                    } else {
                      console.log('NoChangesCompanyModal Continue: Rendering comparison with', comparison.comparisonResults);
                      renderComparison(comparison.comparisonResults);
                      showComparisonSummary(comparison.comparisonResults);
                    }
                }
              }, 10);
            }
          });
        }, { once: true });
      }
    }
    return; // ⛔ SuccessModal yahan kabhi nahi
  }

  // 3) CHANGES + NON-OVERWRITE → Success
//   if ('is_modify' in skill && Number(skill.is_modify) !== 1) {
//     delete skill.is_modify; // create flow me yeh ABSENT rehna chahiye
//   }
//   skill.is_new_company_skill = 1; // persist before syncing JSON

//   const hiddenB = document.getElementById('technicalSkillsJson');
//   if (hiddenB) hiddenB.value = JSON.stringify(technicalSkillsData);
// if (skill.is_modify != 1) {
//   const successEl = document.getElementById('SuccessModal');
//   if (successEl) {
//     const successModal = new bootstrap.Modal(successEl);
//     // const cleanText = (skill.name || '').split('(')[0].trim();
//     let cleanText = cleanLabel(skill.name);
//     successEl.querySelector('#SkillName').textContent = cleanText || 'Skill';
//     successModal.show();
//   }
// }
// // re-render read-only row (aapka existing block)
//   skillRow.outerHTML = `
//     <div class="technical-skill row mb-8" id="skill-${skillIndex}">
//       <input type="hidden" name="technicalSkills[${skillIndex}][description]" value="${esc(skill.description)}">
//       <input type="hidden" name="technicalSkills[${skillIndex}][sector_name]" value="${esc(skill.sector_name || '')}">
//       <input type="hidden" name="technicalSkills[${skillIndex}][preferred_level]" value="${esc(skill.preferred_level || 1)}">
//       <div class="d-flex gap-3 w-100 flex-nowrap overflow-hidden">
//         <div class="flex-shrink-0">
//           <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center remove-skill">
//             <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
//           </button>
//         </div>
//         <div class="flex-shrink-0">
//           <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center edit-skill" data-index="${skillIndex}">
//             <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
//           </button>
//         </div>
//         <div class="flex-grow-1 overflow-hidden">
//           <select id="skill[${skillIndex}]" name="technicalSkills[${skillIndex}][id]" 
//             class="form-control select-skill select2-skill text-truncate w-100" data-index="${skillIndex}">
//             <option value="${esc(skill.skill_id)}" selected>${esc(skill.name)}</option>
//           </select>
//         </div>
//         <input type="hidden" id="technicalSkillsHidden[${skillIndex}]" 
//           name="technicalSkills[${skillIndex}][name]" value="${esc(skill.name)}">
//         <div class="flex-shrink-0">
//           <button type="button" id="selectTechLevelButton${skillIndex}" class="btn-view edit-level-btn"
//             data-bs-toggle="modal" data-bs-target="#techskillmodal"
//             onclick="technicalpopulateModal(${skillIndex})">
//             ${skill.preferred_level ? `Level ${esc(skill.preferred_level)}` : 'Select Level'}
//           </button>
//         </div>
//       </div>
//     </div>
//   `;

//   setTimeout(() => initSkillSelect2(skillIndex), 0);

//   const m = bootstrap.Modal.getInstance(document.getElementById('EditTsfromMSL'));
//   if (m) m.hide();
if (Number(skill.is_modify) !== 1) {
  // Prepare values for duplicate check
  const nameToCheck  = (typeof cleanLabel === 'function' ? cleanLabel(skill.name || '') : (skill.name || '')).trim();
  const sectorName   = (skill.sector_name || '').trim();
  const categoryName = (skill.category_name || '').trim();

  // Call helper (shows overlay); handle result here
  dupCheckSkill(nameToCheck, sectorName, categoryName)
    .done(function(res) {
      // Duplicate → alert & stop (no invalid class, no button disabling)
      if (res && res.exists) {
        hideOverlay();
        // alert(res.message || 'A similar skill already exists in the Master/Company library. Please change the title.');
         showInlineNameError(
          skillRow,
          skillIndex,
          res.message || 'Company technical skill title already exists in this sector and category. Please enter a different one.'
        );
        return;
      }

      // ✅ No duplicate → proceed with your original success flow
      hideOverlay();

      // Remove flag so it doesn't persist in create flow
      if ('is_modify' in skill && Number(skill.is_modify) !== 1) {
        delete skill.is_modify;
      }

      // Persist flag before syncing JSON
      skill.is_new_company_skill = 1;
      skill.preferred_level = "";

      // Sync JSON
      const hiddenB = document.getElementById('technicalSkillsJson');
      if (hiddenB) hiddenB.value = JSON.stringify(technicalSkillsData);

      // Success Modal
      const successEl = document.getElementById('SuccessModal');
      if (successEl) {
        const successModal = new bootstrap.Modal(successEl);
        const cleanText = (typeof cleanLabel === 'function' ? cleanLabel(skill.name) : (skill.name || ''));
        successEl.querySelector('#SkillName').textContent = cleanText || 'Skill';
        successModal.show();
      }

      // Re-render read-only row (unchanged from your code)
      skillRow.outerHTML = `
        <div class="technical-skill row mb-8" id="skill-${skillIndex}">
          <input type="hidden" name="technicalSkills[${skillIndex}][description]" value="${esc(skill.description)}">
          <input type="hidden" name="technicalSkills[${skillIndex}][sector_name]" value="${esc(skill.sector_name || '')}">
          <input type="hidden" name="technicalSkills[${skillIndex}][preferred_level]" value="${esc(skill.preferred_level || 1)}">
          <div class="d-flex gap-3 w-100 flex-nowrap overflow-hidden">
            <div class="flex-shrink-0">
              <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center remove-skill">
                <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
              </button>
            </div>
            <div class="flex-shrink-0">
              <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center edit-skill" data-index="${skillIndex}">
                <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
              </button>
            </div>
            <div class="flex-grow-1 overflow-hidden">
              <select id="skill[${skillIndex}]" name="technicalSkills[${skillIndex}][id]" 
                class="form-control select-skill select2-skill text-truncate w-100" data-index="${skillIndex}">
                <option value="${esc(skill.skill_id)}" selected>${esc(skill.name)}</option>
              </select>
            </div>
            <input type="hidden" id="technicalSkillsHidden[${skillIndex}]" 
              name="technicalSkills[${skillIndex}][name]" value="${esc(skill.name)}">
            <div class="flex-shrink-0">
              <button type="button" id="selectTechLevelButton${skillIndex}" class="btn-view edit-level-btn"
                data-bs-toggle="modal" data-bs-target="#techskillmodal"
                onclick="technicalpopulateModal(${skillIndex})">
                ${skill.preferred_level ? `Level ${esc(skill.preferred_level)}` : 'Select Level'}
              </button>
            </div>
          </div>
        </div>
      `;

      setTimeout(() => {
        if (typeof initSkillSelect2 === 'function') initSkillSelect2(skillIndex);
        // ✅ Attach event listeners to the newly created DOM elements after success modal
        attachSkillRowEventListeners(skillIndex);
        // ✅ Toggle remove buttons to disable if only 1 skill remains
        if (typeof toggleRemoveSkillButtons === 'function') toggleRemoveSkillButtons();
      }, 0);

      const m = bootstrap.Modal.getInstance(document.getElementById('EditTsfromMSL'));
      if (m) m.hide();
    })
    .fail(function() {
      hideOverlay();
      alert('Unable to validate duplicate right now. Please try again.');
    });

  // IMPORTANT: stop here — wait for AJAX callback
  return;
}

// else (is_modify === 1): skip the whole create/success flow
// do nothing or just close the modal if desired
const _m = bootstrap.Modal.getInstance(document.getElementById('EditTsfromMSL'));
if (_m) _m.hide();
  }

});




            // Optional: close modal (you already handle it elsewhere)
            const modalEl = document.getElementById('EditTsfromMSL');
            if (modalEl) {
                const modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) modal.hide();
            }
        }
    </script>

    {{-- <script>
    function renderInlineSkillEdit(skillIndex) {
        const skillData = technicalSkillsData[skillIndex];
        const skillRow = document.getElementById(`skill-${skillIndex}`);
        if (!skillRow || !skillData) return;

        const originalHTML = skillRow.innerHTML;

        // Render edit UI
        skillRow.innerHTML = `
            <div class="d-flex justify-content-between w-100 align-items-start">
                <div class="d-flex align-items-start gap-3 col-lg-10">
                    <div class="d-flex flex-column gap-2 pt-2">
                        <button class="btn btn-light border border-warning text-warning accept-btn" style="width: 30px; height: 30px; padding: 0;">
                            <iconify-icon icon="ic:round-check" width="18" height="18"></iconify-icon>
                        </button>
                        <button class="btn btn-light border text-muted cancel-btn" style="width: 30px; height: 30px; padding: 0;">
                            <iconify-icon icon="ic:round-close" width="18" height="18"></iconify-icon>
                        </button>
                    </div>
                    <div class="w-100">
                        <div class="d-flex align-items-center gap-2 mb-2 position-relative">
                            <input type="text" class="form-control" name="technicalSkills[${skillIndex}][name]" 
                                id="skillNameInput-${skillIndex}" value="${skillData.name}" 
                                data-original="${skillData.name}">
                            <button class="reset-btn position-absolute top-0 end-0 mt-2 me-2" type="button">
                                <iconify-icon icon="grommet-icons:power-reset" width="16" height="16"></iconify-icon>
                            </button>
                            <span id="skillStatusBadge-${skillIndex}" 
                                class="badge px-2"
                                style="background-color: #E3F7FF; color: #125A78;">
                                ${skillData.is_custom == 2 ? 'Company Skill' : 'Master Skill Library'}
                            </span>
                            <span class="badge border text-muted px-2" style="background-color: #F1F1F4; color: #4B5675;">
                                ${skillData.sector_name || 'N/A'}
                            </span>
                        </div>
                        <div class="position-relative">
                            <textarea class="form-control" rows="2" name="technicalSkills[${skillIndex}][description]" 
                                data-original="${skillData.description || 'N/A'}">${skillData.description || 'N/A'}</textarea>
                            <button class="reset-btn position-absolute top-0 end-0 mt-2 me-2" type="button">
                                <iconify-icon icon="grommet-icons:power-reset" width="16" height="16"></iconify-icon>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 d-flex flex-column align-items-end gap-2">
                    <button type="button" class="btn btn-outline btn-sm text-warning border-warning edit-level-btn"
                        data-bs-toggle="modal" data-bs-target="#tsEditLevel"
                        onclick="openTSEditLevelModal(${skillIndex})">
                        Edit Level
                        <iconify-icon icon="lucide:edit" width="16" height="16"></iconify-icon>
                    </button>
                </div>
            </div>
        `;

        // Cancel button
        skillRow.querySelector('.cancel-btn').addEventListener('click', () => {
            skillRow.innerHTML = originalHTML;
        });

        // Reset button logic
        skillRow.querySelectorAll('.reset-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const input = btn.parentElement.querySelector('input, textarea');
                if (input && input.dataset.original !== undefined) {
                    input.value = input.dataset.original;
                }
            });
        });

        // Update badge on name input
        const nameInput = skillRow.querySelector(`#skillNameInput-${skillIndex}`);
        const badge = document.getElementById(`skillStatusBadge-${skillIndex}`);
        const originalName = nameInput.dataset.original;

        nameInput.addEventListener('input', function () {
            const current = nameInput.value.trim();
            if (current !== originalName.trim()) {
                badge.textContent = 'New Skill';
                badge.style.backgroundColor = '#DFF5E3';
                badge.style.color = '#146C43';
            } else {
                badge.textContent = skillData.is_custom == 2 ? 'Company Skill' : 'Master Skill Library';
                badge.style.backgroundColor = '#E3F7FF';
                badge.style.color = '#125A78';
            }
        });

        // Accept button
        skillRow.querySelector('.accept-btn').addEventListener('click', () => {
            const name = skillRow.querySelector(`input[name="technicalSkills[${skillIndex}][name]"]`).value.trim();
            const description = skillRow.querySelector(`textarea[name="technicalSkills[${skillIndex}][description]"]`).value.trim();

            // Update object
            technicalSkillsData[skillIndex].name = name;
            technicalSkillsData[skillIndex].description = description;
            technicalSkillsData[skillIndex].is_modified = 1;

            // Sync JSON
            const jsonInput = document.getElementById('technicalSkillsJson');
            if (jsonInput) jsonInput.value = JSON.stringify(technicalSkillsData);

            // Re-render to view mode
            skillRow.outerHTML = `
                <div class="technical-skill row mb-8" id="skill-${skillIndex}">
                    <input type="hidden" name="technicalSkills[${skillIndex}][description]" value="${description}">
                    <input type="hidden" name="technicalSkills[${skillIndex}][sector_name]" value="${technicalSkillsData[skillIndex].sector_name || ''}">
                    <input type="hidden" name="technicalSkills[${skillIndex}][preferred_level]" value="${technicalSkillsData[skillIndex].preferred_level || 1}">
                    <div class="fv-row mb-2 fv-plugins-icon-container col-lg-9 d-flex gap-7">
                        <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center remove-skill">
                            <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
                        </button>
                        <button type="button" class="btn btn-outline btn-outline-primary d-flex justify-content-center edit-skill" data-index="${skillIndex}">
                            <iconify-icon icon="lucide:edit-3" class="fa-1-5"></iconify-icon>
                        </button>
                        <input type="text" class="form-control input-style" id="technicalSkills[${skillIndex}]" 
                            name="technicalSkills[${skillIndex}][name]" placeholder="Technical Skill" 
                            value="${name}" required readonly>
                    </div>
                    <div class="fv-row mb-2 fv-plugins-icon-container d-flex col-lg-3 btn-vl-container justify-content-end">
                        <select id="level[${skillIndex}]" name="technicalSkills[${skillIndex}][level]" class="form-select col-lg-7 col-md-10 btn-level mb-3 mb-lg-0 rounded-right">
                            ${Array.from({ length: 6 }, (_, i) => 6 - i)
                                .map(level => {
                                    const descKey = `level_${level}_description`;
                                    const levelDesc = technicalSkillsData[skillIndex][descKey] || null;
                                    if (levelDesc) {
                                        return `<option value="${level}" 
                                            ${technicalSkillsData[skillIndex].preferred_level == level ? 'selected' : ''}>
                                            Level ${level}</option>`;
                                    }
                                    return '';
                                }).join('')}
                        </select>
                        <button type="button" id="selectTechLevelButton${skillIndex}" class="btn-view" 
                            data-bs-toggle="modal" data-bs-target="#techskillmodal" 
                            onclick="technicalpopulateModal(${skillIndex})">
                            View Level
                            <iconify-icon icon="iconamoon:search-bold" class="fa-1-5 ml-2"></iconify-icon>
                        </button>
                    </div>
                </div>
            `;
        });

        // Optional: Close modal if opened
        const modalEl = document.getElementById('EditTsfromMSL');
        if (modalEl) {
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();
        }
    }
    </script> --}}





    {{-- <script>
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

        // function openTSEditLevelModal(skillIndex) {
        //     const data = technicalSkillsData[skillIndex];
        //     if (!data) return;

        //     const modal = document.getElementById('tsEditLevel');
        //     modal.setAttribute('data-skill-index', skillIndex);
        //     const title = modal.querySelector('.modal-title');
        //     const subtitle = modal.querySelector('.modal-header p');
        //     const body = modal.querySelector('.ts-edit-popup-body');

        //     title.textContent = data.name || 'Skill Name';
        //     subtitle.textContent = data.description || 'Skill Description';
        //     body.innerHTML = '';

        //     let lastExistingLevel = 0;

        //     for (let i = 1; i <= 6; i++) {
        //         const levelDesc = data[`level_${i}_description`];
        //         const knowledge = data[`level_${i}_knowledge`] || [];
        //         const abilities = data[`level_${i}_ability`] || [];

        //         const isLastLevel = (() => {
        //             // check if there's no level after i
        //             for (let j = i + 1; j <= 6; j++) {
        //                 if (data[`level_${j}_description`]) return false;
        //             }
        //             return true;
        //         })();
        //         const existingLevels = [];
        //         for (let k = 1; k <= 6; k++) {
        //             if (data[`level_${k}_description`]) {
        //                 existingLevels.push(k);
        //             }
        //         }
        //         const isFirst = i === existingLevels[0];
        //         const isLast = i === existingLevels[existingLevels.length - 1];
        //         const canDelete = (isFirst || isLast) && existingLevels.length > 1;



        //         if (levelDesc) {
        //             lastExistingLevel = i;

        //             const wrapper = document.createElement('div');
        //             wrapper.className = 'ts-edit-inner-box';
        //             wrapper.innerHTML = `
        //             <div class="header d-flex justify-content-between align-items-center">
        //                 <p class="d-flex align-items-center gap-1 m-0 content-p">Level ${i}
        //                     <iconify-icon icon="material-symbols:star" width="16" height="16" style="color: #F3AC60;"></iconify-icon>
        //                 </p>
                        
        //                     ${canDelete
        //                     ? `<span class="delete-btn" data-level="${i}">
        //                                 <iconify-icon icon="mi:delete" width="16" height="16"></iconify-icon>
        //                             </span>`
        //                     : `<span class="delete-btn text-muted" style="pointer-events: none; opacity: 0.5;">
        //                                 <iconify-icon icon="mi:delete" width="16" height="16"></iconify-icon>
        //                             </span>`}

        //             </div>
        //             <div class="inner-content">
        //                 <div class="mb-5 w-100">
        //                     <label class="form-label fw-bold">Level Description</label>
        //                     <div class="input-box w-100 position-relative">
        //                         <textarea class="form-control border-0 w-100 auto-expand-textarea pt-0 pl-0 pr-5 pb-5" rows="1" oninput="autoResize(this)" data-original="${encodeURIComponent(levelDesc)}">${levelDesc}</textarea>
        //                         <button class="reset-btn position-absolute top-0 end-0 mt-3 me-3" type="button">
        //                             <iconify-icon icon="grommet-icons:power-reset" width="16" height="16"></iconify-icon>
        //                         </button>
        //                     </div>
        //                 </div>

        //                 <div class="mb-5 w-100 knowledge-section">
        //                     <label class="form-label fw-bold">Knowledge</label>
        //                     ${knowledge.map(k => generateInputRow(k, 'knowledge')).join('')}
        //                     <div>
        //                         <button type="button" class="fs-6 custom-btn orange-fill-popup border-0 py-4 px-6 d-flex gap-2 add-knowledge-btn">
        //                             <iconify-icon icon="uil:plus" width="16" height="16"></iconify-icon> Add Knowledge
        //                         </button>
        //                     </div>
        //                 </div>

        //                 <div class="w-100 ability-section">
        //                     <label class="form-label fw-bold">Abilities</label>
        //                     ${abilities.map(a => generateInputRow(a, 'ability')).join('')}
        //                     <div>
        //                         <button type="button" class="fs-6 custom-btn orange-fill-popup border-0 py-4 px-6 d-flex gap-2 add-ability-btn">
        //                             <iconify-icon icon="uil:plus" width="16" height="16"></iconify-icon> Add Ability
        //                         </button>
        //                     </div>
        //                 </div>
        //             </div>`;
        //             body.appendChild(wrapper);
        //         } else if (i === lastExistingLevel + 1) {
        //             // Only allow next level
        //             body.innerHTML += `
        //             <div class="ts-edit-inner-box bg-grey">
        //                 <div class="header"></div>
        //                 <div class="inner-content justify-content-center">
        //                     <div>
        //                         <button type="button" class="fs-6 custom-btn orange-outline-popup py-4 px-6 h-100 align-items-center d-flex gap-2 add-level-btn" data-level="${i}">
        //                             <iconify-icon icon="uil:plus" width="16" height="16"></iconify-icon> Add Level ${i}
        //                         </button>
        //                     </div>
        //                 </div>
        //             </div>`;
        //         } else {
        //             // Disabled further levels
        //             body.innerHTML += `
        //             <div class="ts-edit-inner-box bg-grey">
        //                 <div class="header"></div>
        //                 <div class="inner-content justify-content-center">
        //                     <div>
        //                         <button type="button" class="fs-6 custom-btn grey-outline-popup bg-transparent py-4 px-6 h-100 align-items-center d-flex gap-2" disabled>
        //                             <iconify-icon icon="uil:plus" width="16" height="16"></iconify-icon> Add Level ${i}
        //                         </button>
        //                     </div>
        //                 </div>
        //             </div>`;
        //         }
        //     }

        //     bindLevelEvents();
        // }

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
    const existingLevels = allLevels.filter(i => data[`level_${i}_description`]);
    const missingLevels = allLevels.filter(i => !existingLevels.includes(i));

    const isAdjacentToExisting = (level) => {
        return existingLevels.includes(level - 1) || existingLevels.includes(level + 1);
    };

    for (let i = 1; i <= 6; i++) {
        const levelDesc = data[`level_${i}_description`];
        const knowledge = data[`level_${i}_knowledge`] || [];
        const abilities = data[`level_${i}_ability`] || [];

        const isFirst = i === existingLevels[0];
        const isLast = i === existingLevels[existingLevels.length - 1];
        const canDelete = (isFirst || isLast) && existingLevels.length > 1;

        if (levelDesc) {
            const wrapper = document.createElement('div');
            wrapper.className = 'ts-edit-inner-box';
            wrapper.innerHTML = `
                <div class="header d-flex justify-content-between align-items-center">
                    <p class="d-flex align-items-center gap-1 m-0 content-p">Level ${i}
                        <iconify-icon icon="material-symbols:star" width="16" height="16" style="color: #F3AC60;"></iconify-icon>
                    </p>
                    ${canDelete
                        ? `<span class="delete-btn" data-level="${i}">
                            <iconify-icon icon="mi:delete" width="16" height="16"></iconify-icon>
                        </span>`
                        : `<span class="delete-btn text-muted" style="pointer-events: none; opacity: 0.5;">
                            <iconify-icon icon="mi:delete" width="16" height="16"></iconify-icon>
                        </span>`}
                </div>
                <div class="inner-content">
                    <div class="mb-5 w-100">
                        <label class="form-label fw-bold">Level Description</label>
                        <div class="input-box w-100 position-relative">
                            <textarea class="form-control border-0 w-100 auto-expand-textarea pt-0 pl-0 pr-5 pb-5"
                                rows="1" oninput="autoResize(this)" data-original="${encodeURIComponent(levelDesc)}">${levelDesc}</textarea>
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
            body.innerHTML += `
                <div class="ts-edit-inner-box bg-grey">
                    <div class="header"></div>
                    <div class="inner-content justify-content-center">
                        <div>
                            <button type="button" class="fs-6 custom-btn orange-outline-popup py-4 px-6 h-100 align-items-center d-flex gap-2 add-level-btn"
                                data-level="${i}">
                                <iconify-icon icon="uil:plus" width="16" height="16"></iconify-icon> Add Level ${i}
                            </button>
                        </div>
                    </div>
                </div>`;
        } else {
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

    bindLevelEvents();
    }

        


        // function bindLevelEvents() {
        //     // Delete rows
        //     // document.querySelectorAll('.delete-btn').forEach(btn => {
        //     //     btn.onclick = () => {
        //     //         const row = btn.closest('.knowledge-row, .ability-row, .ts-edit-inner-box');
        //     //         if (row) row.remove();
        //     //     };
        //     // });

        //     document.querySelectorAll('.delete-btn').forEach(btn => {
        //         btn.onclick = () => {
        //             const level = btn.dataset.level;
        //             const box = btn.closest('.ts-edit-inner-box');

        //             // For knowledge/ability rows → just remove
        //             if (btn.closest('.knowledge-row') || btn.closest('.ability-row')) {
        //                 const row = btn.closest('.knowledge-row, .ability-row');
        //                 if (row) row.remove();
        //                 return;
        //             }

        //             // If it's a level box → replace with Add Level button
        //             if (level && box) {
        //                 const placeholder = document.createElement('div');
        //                 placeholder.className = 'ts-edit-inner-box bg-grey';
        //                 placeholder.innerHTML = `
        //         <div class="header"></div>
        //         <div class="inner-content justify-content-center">
        //             <div>
        //                 <button type="button" class="fs-6 custom-btn orange-outline-popup py-4 px-6 h-100 align-items-center d-flex gap-2 add-level-btn" data-level="${level}">
        //                     <iconify-icon icon="uil:plus" width="16" height="16"></iconify-icon> Add Level ${level}
        //                 </button>
        //             </div>
        //         </div>
        //     `;
        //                 box.replaceWith(placeholder);
        //                 bindLevelEvents(); // re-bind the new Add button
        //             }
        //         };
        //     });


        //     // Reset to original
        //     document.querySelectorAll('.reset-btn').forEach(btn => {
        //         btn.onclick = () => {
        //             const textarea = btn.closest('.input-box')?.querySelector('textarea');
        //             if (textarea) {
        //                 const original = decodeURIComponent(textarea.dataset.original || '');
        //                 textarea.value = original;
        //                 autoResize(textarea);
        //             }
        //         };
        //     });

        //     // Add Knowledge
        //     document.querySelectorAll('.add-knowledge-btn').forEach(btn => {
        //         btn.onclick = () => {
        //             const container = btn.closest('.knowledge-section');
        //             const div = document.createElement('div');
        //             div.innerHTML = generateInputRow('', 'knowledge');
        //             container.insertBefore(div.firstElementChild, btn.parentElement);
        //             bindLevelEvents();
        //         };
        //     });

        //     // Add Ability
        //     document.querySelectorAll('.add-ability-btn').forEach(btn => {
        //         btn.onclick = () => {
        //             const container = btn.closest('.ability-section');
        //             const div = document.createElement('div');
        //             div.innerHTML = generateInputRow('', 'ability');
        //             container.insertBefore(div.firstElementChild, btn.parentElement);
        //             bindLevelEvents();
        //         };
        //     });

        //     // Add Level
        //     document.querySelectorAll('.add-level-btn').forEach(btn => {
        //         btn.onclick = () => {
        //             const level = btn.dataset.level;
        //             const wrapper = document.createElement('div');
        //             wrapper.innerHTML = `
        //             <div class="ts-edit-inner-box">
        //                 <div class="header d-flex justify-content-between align-items-center">
        //                     <p class="d-flex align-items-center gap-1 m-0 content-p">Level ${level}
        //                         <iconify-icon icon="material-symbols:star" width="16" height="16" style="color: #F3AC60;"></iconify-icon>
        //                     </p>
        //                     <span class="delete-btn"><iconify-icon icon="mi:delete" width="16" height="16"></iconify-icon></span>
        //                 </div>
        //                 <div class="inner-content">
        //                     <div class="mb-5 w-100">
        //                         <label class="form-label fw-bold">Level Description</label>
        //                         <div class="input-box w-100 position-relative">
        //                             <textarea class="form-control border-0 w-100 auto-expand-textarea pt-0 pl-0 pr-5 pb-5" rows="1" oninput="autoResize(this)" data-original=""></textarea>
        //                             <button class="reset-btn position-absolute top-0 end-0 mt-3 me-3" type="button">
        //                                 <iconify-icon icon="grommet-icons:power-reset" width="16" height="16"></iconify-icon>
        //                             </button>
        //                         </div>
        //                     </div>
        //                     <div class="mb-5 w-100 knowledge-section">
        //                         <label class="form-label fw-bold">Knowledge</label>
        //                         ${generateInputRow('', 'knowledge')}
        //                         <div>
        //                             <button type="button" class="fs-6 custom-btn orange-fill-popup border-0 py-4 px-6 d-flex gap-2 add-knowledge-btn">
        //                                 <iconify-icon icon="uil:plus" width="16" height="16"></iconify-icon> Add Knowledge
        //                             </button>
        //                         </div>
        //                     </div>
        //                     <div class="w-100 ability-section">
        //                         <label class="form-label fw-bold">Abilities</label>
        //                         ${generateInputRow('', 'ability')}
        //                         <div>
        //                             <button type="button" class="fs-6 custom-btn orange-fill-popup border-0 py-4 px-6 d-flex gap-2 add-ability-btn">
        //                                 <iconify-icon icon="uil:plus" width="16" height="16"></iconify-icon> Add Ability
        //                             </button>
        //                         </div>
        //                     </div>
        //                 </div>
        //             </div>`;
        //             btn.closest('.ts-edit-inner-box').replaceWith(wrapper.firstElementChild);
        //             bindLevelEvents();
        //         };
        //     });
        // }

//         function bindLevelEvents() {
//     // Delete knowledge or ability rows
//     document.querySelectorAll('.delete-btn').forEach(btn => {
//         btn.onclick = () => {
//             const skillIndex = document.getElementById('tsEditLevel').getAttribute('data-skill-index');
//             const box = btn.closest('.ts-edit-inner-box');

//             // If it's a knowledge or ability row
//             const row = btn.closest('.knowledge-row, .ability-row');
//             if (row) {
//                 row.remove();
//                 return;
//             }

//             // If it's a level box
//             const level = btn.dataset.level;
//             if (level && box) {
//                 // Remove from data
//                 delete technicalSkillsData[skillIndex][`level_${level}_description`];
//                 delete technicalSkillsData[skillIndex][`level_${level}_knowledge`];
//                 delete technicalSkillsData[skillIndex][`level_${level}_ability`];

//                 // Re-render modal
//                 openTSEditLevelModal(skillIndex);
//             }
//         };
//     });

//     // Reset original values
//     document.querySelectorAll('.reset-btn').forEach(btn => {
//         btn.onclick = () => {
//             const textarea = btn.closest('.input-box')?.querySelector('textarea');
//             if (textarea) {
//                 const original = decodeURIComponent(textarea.dataset.original || '');
//                 textarea.value = original;
//                 autoResize(textarea);
//             }
//         };
//     });

//     // Add Knowledge
//     document.querySelectorAll('.add-knowledge-btn').forEach(btn => {
//         btn.onclick = () => {
//             const container = btn.closest('.knowledge-section');
//             const div = document.createElement('div');
//             div.innerHTML = generateInputRow('', 'knowledge');
//             container.insertBefore(div.firstElementChild, btn.parentElement);
//             bindLevelEvents();
//         };
//     });

//     // Add Ability
//     document.querySelectorAll('.add-ability-btn').forEach(btn => {
//         btn.onclick = () => {
//             const container = btn.closest('.ability-section');
//             const div = document.createElement('div');
//             div.innerHTML = generateInputRow('', 'ability');
//             container.insertBefore(div.firstElementChild, btn.parentElement);
//             bindLevelEvents();
//         };
//     });

//     // Add Level
//     document.querySelectorAll('.add-level-btn').forEach(btn => {
//                 btn.onclick = () => {
//                     const level = btn.dataset.level;
//                     const wrapper = document.createElement('div');
//                     wrapper.innerHTML = `
//                     <div class="ts-edit-inner-box">
//                         <div class="header d-flex justify-content-between align-items-center">
//                             <p class="d-flex align-items-center gap-1 m-0 content-p">Level ${level}
//                                 <iconify-icon icon="material-symbols:star" width="16" height="16" style="color: #F3AC60;"></iconify-icon>
//                             </p>
//                             <span class="delete-btn"><iconify-icon icon="mi:delete" width="16" height="16"></iconify-icon></span>
//                         </div>
//                         <div class="inner-content">
//                             <div class="mb-5 w-100">
//                                 <label class="form-label fw-bold">Level Description</label>
//                                 <div class="input-box w-100 position-relative">
//                                     <textarea class="form-control border-0 w-100 auto-expand-textarea pt-0 pl-0 pr-5 pb-5" rows="1" oninput="autoResize(this)" data-original=""></textarea>
//                                     <button class="reset-btn position-absolute top-0 end-0 mt-3 me-3" type="button">
//                                         <iconify-icon icon="grommet-icons:power-reset" width="16" height="16"></iconify-icon>
//                                     </button>
//                                 </div>
//                             </div>
//                             <div class="mb-5 w-100 knowledge-section">
//                                 <label class="form-label fw-bold">Knowledge</label>
//                                 ${generateInputRow('', 'knowledge')}
//                                 <div>
//                                     <button type="button" class="fs-6 custom-btn orange-fill-popup border-0 py-4 px-6 d-flex gap-2 add-knowledge-btn">
//                                         <iconify-icon icon="uil:plus" width="16" height="16"></iconify-icon> Add Knowledge
//                                     </button>
//                                 </div>
//                             </div>
//                             <div class="w-100 ability-section">
//                                 <label class="form-label fw-bold">Abilities</label>
//                                 ${generateInputRow('', 'ability')}
//                                 <div>
//                                     <button type="button" class="fs-6 custom-btn orange-fill-popup border-0 py-4 px-6 d-flex gap-2 add-ability-btn">
//                                         <iconify-icon icon="uil:plus" width="16" height="16"></iconify-icon> Add Ability
//                                     </button>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>`;
//                     btn.closest('.ts-edit-inner-box').replaceWith(wrapper.firstElementChild);
//                     bindLevelEvents();
//                 };
//             });
// }

function bindLevelEvents() {
    // Delete knowledge or ability rows OR entire level
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.onclick = () => {
            const skillIndex = document.getElementById('tsEditLevel').getAttribute('data-skill-index');
            const box = btn.closest('.ts-edit-inner-box');

            // If it's a knowledge or ability row
            const row = btn.closest('.knowledge-row, .ability-row');
            if (row) {
                row.remove();
                return;
            }

            // If it's a level box
            const level = btn.dataset.level;
            if (level && box) {
                delete technicalSkillsData[skillIndex][`level_${level}_description`];
                delete technicalSkillsData[skillIndex][`level_${level}_knowledge`];
                delete technicalSkillsData[skillIndex][`level_${level}_ability`];

                openTSEditLevelModal(skillIndex); // Re-render modal
            }
        };
    });

    // Reset original values
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

    // Add Knowledge row
    document.querySelectorAll('.add-knowledge-btn').forEach(btn => {
        btn.onclick = () => {
            const container = btn.closest('.knowledge-section');
            const div = document.createElement('div');
            div.innerHTML = generateInputRow('', 'knowledge');
            container.insertBefore(div.firstElementChild, btn.parentElement);
            bindLevelEvents();
        };
    });

    // Add Ability row
    document.querySelectorAll('.add-ability-btn').forEach(btn => {
        btn.onclick = () => {
            const container = btn.closest('.ability-section');
            const div = document.createElement('div');
            div.innerHTML = generateInputRow('', 'ability');
            container.insertBefore(div.firstElementChild, btn.parentElement);
            bindLevelEvents();
        };
    });

    // Add new Level
    document.querySelectorAll('.add-level-btn').forEach(btn => {
        btn.onclick = () => {
            const skillIndex = document.getElementById('tsEditLevel').getAttribute('data-skill-index');
            const level = btn.dataset.level;

            if (!skillIndex || !level) return;

            const skill = technicalSkillsData[skillIndex];
            if (!skill) return;

            // Add empty level data so it's tracked and deletable
            skill[`level_${level}_description`] = '';
            skill[`level_${level}_knowledge`] = [''];
            skill[`level_${level}_ability`] = [''];

            // Re-render modal with updated state
            openTSEditLevelModal(skillIndex);
        };
    });
}


    </script> --}}

    <script>
        let originalSkillBeforeEdit = {};
        let didSave = false;
        let backupLocked = false; // ✅ new: guards backup per session
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
                <div class="error-div" style="width: 90%;">
                <textarea 
                    class="form-control border-0 w-100 auto-expand-textarea pt-0 pl-0 pr-5 pb-5" 
                    rows="1"
                    data-original="${encodeURIComponent(value)}"
                    oninput="autoResize(this)"
                >${value}</textarea>
                </div>
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

            if (!backupLocked) {
                const data = technicalSkillsData[skillIndex] || {};
                originalSkillBeforeEdit = JSON.parse(JSON.stringify(data));
                didSave = false;
                backupLocked = true; // lock backup for this session
                console.log("📦 Backed up original skill:", originalSkillBeforeEdit);
            }

            const title = modal.querySelector('.modal-title');
            const subtitle = modal.querySelector('.modal-header p');
            const body = modal.querySelector('.ts-edit-popup-body');

            title.textContent = cleanLabel(data.name) || 'Skill Name';
            subtitle.textContent = data.description || 'Skill Description';
            body.innerHTML = '';

            const allLevels = [1, 2, 3, 4, 5, 6];

            // const levelHasContent = (i) => {
            //     const desc = data[`level_${i}_description`];
            //     const knowledge = data[`level_${i}_knowledge`] || [];
            //     const ability = data[`level_${i}_ability`] || [];
            //     return (
            //         (typeof desc === 'string' && desc.trim() !== '') ||
            //         (Array.isArray(knowledge) && knowledge.some(k => k.trim() !== '')) ||
            //         (Array.isArray(ability) && ability.some(a => a.trim() !== ''))
            //     );
            // };
            //             const levelHasContent = (i) => {
            //   const dKey = `level_${i}_description`;
            //   const kKey = `level_${i}_knowledge`;
            //   const aKey = `level_${i}_ability`;

            //   // 🔧 New: if any of the keys exist, consider the level present (render it)
            //   if (
            //     Object.prototype.hasOwnProperty.call(data, dKey) ||
            //     Object.prototype.hasOwnProperty.call(data, kKey) ||
            //     Object.prototype.hasOwnProperty.call(data, aKey)
            //   ) {
            //     return true;
            //   }

            //   // Fallback to your original non-empty check
            //   const desc = data[dKey];
            //   const knowledge = data[kKey] || [];
            //   const ability = data[aKey] || [];
            //   return (
            //     (typeof desc === 'string' && desc.trim() !== '') ||
            //     (Array.isArray(knowledge) && knowledge.some(k => (k ?? '').trim() !== '')) ||
            //     (Array.isArray(ability) && ability.some(a => (a ?? '').trim() !== ''))
            //   );
            // };
            const levelHasContent = (i) => {
                const dKey = `level_${i}_description`;
                const kKey = `level_${i}_knowledge`;
                const aKey = `level_${i}_ability`;

                const desc = data[dKey];
                const knowledge = data[kKey] || [];
                const ability = data[aKey] || [];

                // Check if description exists (length > 0, no trim for newly added levels)
                const hasDesc = typeof desc === 'string' && desc.length > 0;

                // Check if knowledge array has any non-empty items
                const hasKnowledge = Array.isArray(knowledge) &&
                    knowledge.some(k => (k ?? '').trim() !== '');

                // Check if ability array has any non-empty items
                const hasAbility = Array.isArray(ability) &&
                    ability.some(a => (a ?? '').trim() !== '');

                // Only return true if at least ONE field has actual content
                return hasDesc || hasKnowledge || hasAbility;
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
                            <div class="error-div" style="width: 90%;">
                            <textarea class="form-control border-0 w-100 auto-expand-textarea pt-0 pl-0 pr-5 pb-5" rows="1"
                                oninput="autoResize(this)" data-original="${encodeURIComponent(levelDesc)}">${levelDesc}</textarea>
                                </div>
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
            // document.querySelectorAll('.delete-btn').forEach(btn => {
            //     btn.onclick = () => {
            //         const skillIndex = document.getElementById('tsEditLevel').getAttribute('data-skill-index');
            //         const box = btn.closest('.ts-edit-inner-box');

            //         // Knowledge/Ability Row
            //         const row = btn.closest('.knowledge-row, .ability-row');
            //         if (row) {
            //             row.remove();
            //             return;
            //         }

            //         // Full Level Box
            //         const level = btn.dataset.level;
            //         if (level && box) {
            //             delete technicalSkillsData[skillIndex][`level_${level}_description`];
            //             delete technicalSkillsData[skillIndex][`level_${level}_knowledge`];
            //             delete technicalSkillsData[skillIndex][`level_${level}_ability`];

            //             openTSEditLevelModal(skillIndex);
            //         }
            //     };
            // });
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.onclick = () => {
                    const skillIndex = document.getElementById('tsEditLevel').getAttribute('data-skill-index');
                    const box = btn.closest('.ts-edit-inner-box');

                    // Knowledge/Ability Row
                    const row = btn.closest('.knowledge-row, .ability-row');
                    if (row) {
                        const section = row.closest('.knowledge-section, .ability-section');
                        const allRows = section.querySelectorAll('.knowledge-row, .ability-row');

                        if (allRows.length <= 1) {
                            // Prevent deleting if it's the last row
                            alert('At least one knowledge and ability should be existing.');
                            return;
                        }

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


            document.querySelectorAll('.add-level-btn').forEach(btn => {
                btn.onclick = () => {
                    const skillIndex = document.getElementById('tsEditLevel').getAttribute('data-skill-index');
                    const level = btn.dataset.level;

                    if (!skillIndex || !level) return;
                    const skill = technicalSkillsData[skillIndex];
                    if (!skill) return;

                    // ✅ Add minimal but detectable content
                    skill[`level_${level}_description`] = ' '; // Single space (level will be detected)
                    skill[`level_${level}_knowledge`] = []; // Empty array (no initial rows)
                    skill[`level_${level}_ability`] = []; // Empty array (no initial rows)

                    openTSEditLevelModal(skillIndex); // rerender modal
                };
            });
        }
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // window.technicalSkillsData = {}; // CHANGED to object, not array!
            // let originalSkillBeforeEdit = {};
            const jsonInput = document.getElementById('technicalSkillsJson');
            if (jsonInput && jsonInput.value) {
                try {
                    const parsed = JSON.parse(jsonInput.value);
                    if (parsed && typeof parsed === 'object') window.technicalSkillsData = parsed;
                } catch (e) {
                    console.warn('Failed to parse #technicalSkillsJson');
                }
            }
            let hasAttemptedSave = false;
            window.saveTSEditLevelModal = function(e) {
                if (e) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                console.log("Attempting to save skill levels...");
                const modal = document.getElementById('tsEditLevel');
                const skillIndex = modal.getAttribute('data-skill-index');

                if (!skillIndex) {
                    console.error("Missing skill index");
                    return;
                }

                const allLevelBoxes = modal.querySelectorAll('.ts-edit-inner-box');
                let isValid = true;

                // Backup original
                // originalSkillBeforeEdit = JSON.parse(JSON.stringify(technicalSkillsData[skillIndex] || {}));
                const name = modal.querySelector('.modal-title')?.textContent.trim();
                const description = modal.querySelector('.modal-header p')?.textContent.trim();
                let skillObject = technicalSkillsData[skillIndex] || {};

                // Clear old level info
                // for (let i = 1; i <= 6; i++) {
                //     delete skillObject[`level_${i}_description`];
                //     delete skillObject[`level_${i}_knowledge`];
                //     delete skillObject[`level_${i}_ability`];
                // }

                // allLevelBoxes.forEach(box => {
                //     const headerText = box.querySelector('.header p')?.textContent || '';
                //     const match = headerText.match(/Level\s+(\d+)/);
                //     const level = match ? parseInt(match[1]) : null;
                //     if (!level) return;

                //     // Level Description validation
                //     const descTextarea = box.querySelector('.input-box textarea');
                //     const levelDesc = descTextarea?.value.trim() || '';
                //     const descContainer = descTextarea.closest('.input-box');

                //     // Clear previous validation
                //     descTextarea.classList.remove('is-invalid');
                //     descContainer.querySelector('.invalid-feedback')?.remove();

                //     if (!levelDesc) {
                //         isValid = false;
                //         descTextarea.classList.add('is-invalid');
                //         const err = document.createElement('div');
                //         err.className = 'invalid-feedback';
                //         err.textContent = 'Level Description is required.';
                //         descContainer.appendChild(err);
                //     }

                //     // Knowledge validation
                //     const knowledgeFields = box.querySelectorAll('.knowledge-section textarea');
                //     const knowledgeValues = [];
                //     knowledgeFields.forEach(textarea => {
                //         const val = textarea.value.trim();
                //         const container = textarea.closest('.input-box');

                //         textarea.classList.remove('is-invalid');
                //         container.querySelector('.invalid-feedback')?.remove();

                //         if (!val) {
                //             isValid = false;
                //             textarea.classList.add('is-invalid');
                //             const error = document.createElement('div');
                //             error.className = 'invalid-feedback';
                //             error.textContent = 'Knowledge field cannot be empty.';
                //             container.appendChild(error);
                //         } else {
                //             knowledgeValues.push(val);
                //         }
                //     });

                //     // Ability validation
                //     const abilityFields = box.querySelectorAll('.ability-section textarea');
                //     const abilityValues = [];
                //     abilityFields.forEach(textarea => {
                //         const val = textarea.value.trim();
                //         const container = textarea.closest('.input-box');

                //         textarea.classList.remove('is-invalid');
                //         container.querySelector('.invalid-feedback')?.remove();

                //         if (!val) {
                //             isValid = false;
                //             textarea.classList.add('is-invalid');
                //             const error = document.createElement('div');
                //             error.className = 'invalid-feedback';
                //             error.textContent = 'Ability field cannot be empty.';
                //             container.appendChild(error);
                //         } else {
                //             abilityValues.push(val);
                //         }
                //     });

                //     // If all fields for this level are valid, store them
                //     if (levelDesc && knowledgeValues.length && abilityValues.length) {
                //         skillObject[`level_${level}_description`] = levelDesc;
                //         skillObject[`level_${level}_knowledge`] = knowledgeValues;
                //         skillObject[`level_${level}_ability`] = abilityValues;
                //     }
                // });

                // if (!isValid) {
                //     const firstInvalid = modal.querySelector('.is-invalid');
                //     firstInvalid?.scrollIntoView({
                //         behavior: 'smooth',
                //         block: 'center'
                //     });
                //     return;
                // }
                allLevelBoxes.forEach(box => {
                    const headerText = box.querySelector('.header p')?.textContent || '';
                    const match = headerText.match(/Level\s+(\d+)/);
                    const level = match ? parseInt(match[1]) : null;
                    if (!level) return;

                    // Level Description
                    const descTextarea = box.querySelector('.input-box textarea');
                    const levelDesc = descTextarea?.value.trim() || '';
                    const errorDiv = descTextarea.closest('.error-div'); // target wrapper

                    // reset state
                    descTextarea.classList.remove('is-invalid');
                    errorDiv.querySelector('.invalid-feedback')?.remove();

                    if (!levelDesc) {
                        isValid = false;
                        descTextarea.classList.add('is-invalid');

                        const err = document.createElement('div');
                        err.className = 'invalid-feedback';
                        err.textContent = 'Level Description is required.';

                        // Append error below the textarea
                        descTextarea.insertAdjacentElement('afterend', err);
                    }

                    // Knowledge
                    const knowledgeFields = box.querySelectorAll('.knowledge-section textarea');
                    const knowledgeValues = [];
                    if (knowledgeFields.length === 0) { // if you allow zero rows, show a section error
                        isValid = false;
                        const section = box.querySelector('.knowledge-section');
                        section.querySelector('.section-error')?.remove();
                        const err = document.createElement('div');
                        err.className = 'text-danger small mt-2 section-error';
                        err.textContent = 'At least one knowledge item is required.';
                        section.appendChild(err);
                    } else {
                        knowledgeFields.forEach(textarea => {
                            const val = textarea.value.trim();
                            const errorDiv = textarea.closest(
                            '.error-div'); // 👈 target error-div wrapper

                            // reset state
                            textarea.classList.remove('is-invalid');
                            errorDiv.querySelector('.invalid-feedback')?.remove();

                            if (!val) {
                                isValid = false;
                                textarea.classList.add('is-invalid');

                                const error = document.createElement('div');
                                error.className = 'invalid-feedback';
                                error.textContent = 'This field is required.';

                                // Append error below textarea
                                textarea.insertAdjacentElement('afterend', error);
                            } else {
                                knowledgeValues.push(val);
                            }
                        });
                    }

                    // Abilities
                    const abilityFields = box.querySelectorAll('.ability-section textarea');
                    const abilityValues = [];
                    if (abilityFields.length === 0) {
                        isValid = false;
                        const section = box.querySelector('.ability-section');
                        section.querySelector('.section-error')?.remove();
                        const err = document.createElement('div');
                        err.className = 'text-danger small mt-2 section-error';
                        err.textContent = 'At least one ability is required.';
                        section.appendChild(err);
                    } else {
                        abilityFields.forEach(textarea => {
                            const val = textarea.value.trim();
                            const errorDiv = textarea.closest(
                            '.error-div'); // 👈 target error-div wrapper

                            // reset state
                            textarea.classList.remove('is-invalid');
                            errorDiv.querySelector('.invalid-feedback')?.remove();

                            if (!val) {
                                isValid = false;
                                textarea.classList.add('is-invalid');

                                const error = document.createElement('div');
                                error.className = 'invalid-feedback';
                                error.textContent = 'This field is required.';

                                // Append error below textarea
                                textarea.insertAdjacentElement('afterend', error);
                            } else {
                                abilityValues.push(val);
                            }
                        });
                    }

                    // Save level if valid
                    if (levelDesc && knowledgeValues.length && abilityValues.length) {
                        skillObject[`level_${level}_description`] = levelDesc;
                        skillObject[`level_${level}_knowledge`] = knowledgeValues;
                        skillObject[`level_${level}_ability`] = abilityValues;
                    }
                });

                if (!isValid) {
                    const firstInvalid = modal.querySelector('.is-invalid') ||
                        modal.querySelector('.section-error');
                    firstInvalid?.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    return; // 🔒 keep modal open, errors visible
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
                if (jsonInput) jsonInput.value = JSON.stringify(technicalSkillsData);

                didSave = true; // ✅ skip restore
                // bootstrap.Modal.getInstance(modal)?.hide();
                const dismissBtn = modal.querySelector('[data-bs-dismiss="modal"]');
                dismissBtn.click();
                console.log("✅ Skill Saved:", skillObject);

                // Optional Overwrite Logic
                // if (triggerOverwriteConfirmAfterSave) {
                //     triggerOverwriteConfirmAfterSave = false;
                //     const confirmModal = new bootstrap.Modal(document.getElementById(
                //         'OverwriteCompanySkillConfirmModal'));
                //     document.getElementById('overwriteCompanySkillName').textContent = skillObject?.name ||
                //         'N/A';
                //     document.getElementById('OverwriteCompanySkillConfirmModal').setAttribute(
                //         'data-skill-index', skillIndex);

                //     const jobListContainer = document.getElementById('affectedJobList');
                //     jobListContainer.textContent = 'Loading affected job titles...';

                //     const skillId = skillObject?.skill_id || technicalSkillsData[skillIndex]?.skill_id;

                //     if (skillId) {
                //         fetch(`/admin/get-jobs-by-skill/${skillId}`)
                //             .then(res => res.json())
                //             .then(data => {
                //                 const jobTitles = data.map(job => job.title).join(', ');
                //                 jobListContainer.textContent = jobTitles || 'No associated job titles.';
                //             })
                //             .catch(() => {
                //                 jobListContainer.textContent = 'Failed to load job titles.';
                //             });
                //     } else {
                //         jobListContainer.textContent = 'Skill ID not available.';
                //     }

                //     confirmModal.show();
                // }
            };

            // Live error clearing
            const bssmodal = document.getElementById('tsEditLevel');
            bssmodal.addEventListener('input', (e) => {
                const textarea = e.target.closest('textarea');
                if (!textarea) return;

                const val = textarea.value.trim();
                const inputBox = textarea.closest('.input-box');

                // Field-level clearing
                if (val) {
                    textarea.classList.remove('is-invalid');
                    inputBox?.querySelector('.invalid-feedback')?.remove();
                } else if (hasAttemptedSave) {
                    if (!textarea.classList.contains('is-invalid')) {
                        textarea.classList.add('is-invalid');
                        const err = document.createElement('div');
                        err.className = 'invalid-feedback';
                        err.textContent = 'This field is required.';
                        inputBox.appendChild(err);
                    }
                }

                // Section-level clearing
                const knowledgeSection = textarea.closest('.knowledge-section');
                if (knowledgeSection) {
                    const anyFilled = Array.from(knowledgeSection.querySelectorAll('textarea'))
                        .some(t => t.value.trim() !== '');
                    if (anyFilled) {
                        knowledgeSection.querySelector('.section-error')?.remove();
                    }
                }
                const abilitySection = textarea.closest('.ability-section');
                if (abilitySection) {
                    const anyFilled = Array.from(abilitySection.querySelectorAll('textarea'))
                        .some(t => t.value.trim() !== '');
                    if (anyFilled) {
                        abilitySection.querySelector('.section-error')?.remove();
                    }
                }
            });

            const modal = document.getElementById('tsEditLevel');
            const closeBtn = modal.querySelector('.btn-close');
            // modal.addEventListener('hidden.bs.modal', function () {
            closeBtn.addEventListener('click', function() {
                const skillIndex = modal.getAttribute('data-skill-index');
                // unlock backup for the next open
                backupLocked = false;

                if (!skillIndex) return;
                if (didSave) {
                    didSave = false;
                    return;
                } // user saved → do not restore

                // restore from original backup
                if (originalSkillBeforeEdit && Object.keys(originalSkillBeforeEdit).length > 0) {
                    technicalSkillsData[skillIndex] = JSON.parse(JSON.stringify(originalSkillBeforeEdit));
                    if (jsonInput) jsonInput.value = JSON.stringify(technicalSkillsData);
                    // if (typeof renderInlineSkillEdit === "function") renderInlineSkillEdit(skillIndex);
                    console.log("🔄 Restored original skill on close:", technicalSkillsData[skillIndex]);
                }
            });




            // document.getElementById('OverwriteContinueEditSkillBtn')?.addEventListener('click', function() {
            //     const modal = document.getElementById('OverwriteCompanySkillConfirmModal');
            //     const skillIndex = modal.getAttribute('data-skill-index');
            //     if (!skillIndex || !technicalSkillsData[skillIndex]) {
            //         console.error('Invalid or missing skillIndex');
            //         return;
            //     }
            //     technicalSkillsData[skillIndex].is_modify = 1;
            //     // Save to hidden input and refresh view
            //     document.getElementById('technicalSkillsJson').value = JSON.stringify(technicalSkillsData);
            //     bootstrap.Modal.getInstance(modal)?.hide();
            //     renderInlineSkillEdit(skillIndex);
            // });

            // document.querySelector('#OverwriteCompanySkillConfirmModal .btn[data-bs-dismiss="modal"]')
            //     ?.addEventListener('click', function() {
            //         const modal = document.getElementById('OverwriteCompanySkillConfirmModal');
            //         const skillIndex = modal.getAttribute('data-skill-index');
            //         if (!skillIndex || !originalSkillBeforeEdit) return;

            //         technicalSkillsData[skillIndex] = JSON.parse(JSON.stringify(originalSkillBeforeEdit));
            //         document.getElementById('technicalSkillsJson').value = JSON.stringify(technicalSkillsData);
            //         renderInlineSkillEdit(skillIndex);
            //     });


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



            generateBtn.addEventListener('click', function() {
                showOverlay();

                // const framework_job_role_id = document.querySelector('input[name="jobID"]').value.trim();
                // // const framework_job_role_name = titleInput.value.trim();
                // var jobRoleName = $('#job_profile').val().trim();
                // const user_job_role_name = jobRoleName;
                const typeJob = document.querySelector('input[name="type_job"]').value.trim();

                let framework_job_role_id = '';
                let user_job_role_name = '';

                if (typeJob === 'master-jd') {
                    // Use unique_id and title for master JD
                    framework_job_role_id = document.querySelector('input[name="unique_id"]').value.trim();
                    user_job_role_name = document.querySelector('input[name="title"]').value.trim();
                } else {
                    // Use jobID and job_profile for company JD or other types
                    framework_job_role_id = document.querySelector('input[name="jobID"]').value.trim();
                    user_job_role_name = $('#job_profile').val().trim();
                }
                const user_short_description = additionalDetailTextarea.value.trim();

                if (!framework_job_role_id || !user_job_role_name || !user_short_description) {
                    hideOverlay();
                    alert(
                        "All fields (title, job ID, profile name, and additional detail) must be filled."
                    );
                    return;
                }


                $.ajax({
                    url: '/api/generate-jd',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        framework_job_role_id,
                        user_job_role_name,
                        user_short_description
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
                        <p class="m-0 text-left fw-bolder fs-2 d-flex justify-content-between gap-2">
                                <span>${jd.title || `Job Description`}</span>
                                <span class="jd-badge d-flex align-items-center text-center ${jd.badge_class || 'enter-jr-badge'}">${jd.badge || 'Generated'}</span>
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

        // ✅ Helper: Disable delete buttons if only 1 task left
        function refreshDeleteButtons(wrapper) {
            const taskRows = wrapper.find('.task-row');
            const enableDelete = taskRows.length > 1;

            taskRows.each(function() {
                const deleteBtn = $(this).find('.remove-task');
                deleteBtn.prop('disabled', !enableDelete);
            });
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
          <div style="margin-top: -15px; margin-bottom: 15px;">
            <span class="function-title" style="
                font-weight: 500;
                font-size: 16.25px;
                line-height: 50px;
                color: #071437;
                overflow-wrap: anywhere;
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
            toggleDeleteButtons();
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
                 <div style="margin-top: -15px; margin-bottom: 15px;">
            <span class="function-title" style="
                font-weight: 500;
                font-size: 16.25px;
                line-height: 50px;
                color: #071437;
                overflow-wrap: anywhere;
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
            <input type="text" class="form-control function-input" name="functions[${index}][title]" placeholder="Enter critical work function">
          </div>
          <div class="editable-tasks">
            
              <div class="d-flex gap-2 mb-2 task-row">
                <button class="cross-grey-btn" type="button" disabled><i class="fa fa-trash"></i></button>
                <input type="text" class="form-control task-input" placeholder="Enter key task"  name="functions[${index}][tasks][]">
              </div>
          </div>
          <button class="add-task mt-4 mb-4" type="button">+ Add New Key Task</button>
        </div>
      </div>`;

            document.querySelector('.critical-functions-container').insertAdjacentHTML('beforeend', functionHtml);
            toggleDeleteButtons();
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
            refreshDeleteButtons(wrapper);
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
            refreshDeleteButtons(wrapper);
        });

        $(document).on('click', '.save-function', function() {
            const wrapper = $(this).closest('.critical-function');
            const newTitle = wrapper.find('.function-input').val().trim();
            const newTasks = wrapper.find('.task-input').map(function() {
                return $(this).val().trim();
            }).get();
            const nonEmptyTasks = newTasks.filter(task => task !== '');

            if (newTitle === '' || nonEmptyTasks.length === 0) {
                alert('Please enter a title and at least one non-empty key task.');
                return;
            }

            // Update view
            wrapper.find('.function-title').text(newTitle);
            const chips = wrapper.find('.task-chips').empty();
            nonEmptyTasks.forEach(task => {
                chips.append(
                    `<span class="task-chip" style="background-color: #FFF6EA; color: #7C4A0E;">${task}</span>`
                    );
            });

            // Mark as saved
            wrapper.attr('data-has-saved', 'true');

            // ✅ Clear all error indicators
            wrapper.find('.function-input').removeClass('is-invalid').next('.function-error').remove();
            wrapper.find('.task-input').removeClass('is-invalid');
            wrapper.find('.task-error').remove();
            wrapper.removeClass('border border-danger rounded');
            $('#unsavedCriticalValidationMessage').hide();

            wrapper.find('.edit-mode').addClass('d-none');
            wrapper.find('.view-mode').removeClass('d-none');
            refreshDeleteButtons(wrapper);
            toggleDeleteButtons(); // <-- ADD THIS HERE
        });



        $(document).on('click', '.cancel-or-delete-function', function() {
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
                refreshDeleteButtons(wrapper);
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
            refreshDeleteButtons(wrapper);
        });

        // Remove Task
        // $(document).on('click', '.remove-task', function() {
        //     $(this).closest('.task-row').remove();
        // });

        // ✅ Remove Task with delete control
        $(document).on('click', '.remove-task', function() {
            const wrapper = $(this).closest('.critical-function');
            $(this).closest('.task-row').remove();
            refreshDeleteButtons(wrapper); // ✅ call here
        });

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
            document.querySelectorAll('input[name="accuracy"]').forEach((radio) => {
                radio.addEventListener('change', function() {
                    // Remove 'selected' class from all labels
                    document.querySelectorAll('.feedback-label').forEach((label) => {
                        label.classList.remove('selected');
                    });

                    // Add 'selected' class to the associated label
                    const selectedLabel = document.querySelector(`label[for="${this.id}"]`);
                    if (selectedLabel) {
                        selectedLabel.classList.add('selected');
                    }
                });
            });

            // Remove 'selected' class when the modal is closed
            $('#feedbackModal').on('hidden.bs.modal', function() {
                document.querySelectorAll('.feedback-label').forEach((label) => {
                    label.classList.remove('selected');
                });
                // Reset the radio buttons
                document.querySelectorAll('input[name="accuracy"]').forEach((radio) => {
                    radio.checked = false;
                });
            });

            // Remove 'selected' class when the "Submit Feedback" button is clicked
            $('#submit-feedback').on('click', function() {
                document.querySelectorAll('.feedback-label').forEach((label) => {
                    label.classList.remove('selected');
                });
                // Optionally hide the modal after feedback is submitted
                $('#feedbackModal').modal('hide');
            });

            let feedbackType = '';
            $(".thumbs-up, .thumbs-down").click(function() {
                feedbackType = $(this).hasClass('thumbs-up') ? 'thumbs-up' : 'thumbs-down';
                // Clear previous form data
                $("#feedback-form")[0].reset();
                $("#comments").val('');

                // Remove 'active' class from both buttons and add to the clicked one
                $(".thumbs-up, .thumbs-down").removeClass('active');
                $(this).addClass('active');

                // Show the modal
                $('#feedbackModal').modal('show');
            });
            jdGenartorUniqueId = "bfc9e8cb-638b-447f-8a94-d6dfcd28aecb";
            //Check GIT CHerry
            // Handle form submission
            $('#submit-feedback').click(function() {
                let selectedAccuracy = $("input[name='accuracy']:checked");
                if (selectedAccuracy.length > 0 && jdGenartorUniqueId) {
                    let feedbackRating = selectedAccuracy.attr('id'); // Selected radio button ID
                    let feedbackLabel = $(`label[for="${feedbackRating}"]`); // Fetch associated label
                    let feedbackDescription = feedbackLabel.find('.heading-emotions-desc').text()
                        .trim(); // Get description text
                    let additionalFeedback = $('#comments').val();

                    // Create the payload
                    const payload = {
                        job_generation_id: jdGenartorUniqueId,
                        thumbs_up: feedbackType === 'thumbs-up' ? 1 : 0,
                        thumbs_down: feedbackType === 'thumbs-down' ? 1 : 0,
                        feedback_rating: feedbackRating,
                        feedback: feedbackDescription,
                        additional_feedback: additionalFeedback,
                    };
                    showOverlay()
                    // Make the AJAX request
                    $.ajax({
                        url: '/admin/sendFeedbackRating', // Update with your route
                        method: 'POST',
                        data: JSON.stringify(payload),
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
                        },
                        success: function(response) {
                            hideOverlay();
                            // alert('Feedback submitted successfully!');
                            toastr.success('Feedback submitted successfully!', 'Status')
                            $('#feedbackModal').modal('hide');
                            // Update the text of the paragraph
                            $('.feedback-btn p').text('Your Feedback is submitted');
                        },
                        error: function() {
                            alert('An error occurred. Please try again.');
                            hideOverlay();
                        }
                    });
                } else {
                    alert('Please select an accuracy rating!');
                }
            });
        });


        document.getElementById('submit-feedback').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default behavior

            // Retrieve input values
            const jobRole = document.querySelector('input[name="title"]').value.trim();
            const jobDescription = document.querySelector('textarea[name="description"]').value.trim();
            const selectedFeedbackRating = document.querySelector('input[name="accuracy"]:checked');
            const additionalComment = document.getElementById('comments').value.trim();
            const feedbackType = document.querySelector('.thumbs-up.active') ? 1 :
                0; // 1 for thumbs-up, 0 for thumbs-down

            // Validate input fields
            let isValid = true;
            document.querySelectorAll('.error-message').forEach(el => el.remove()); // Remove old error messages

            if (!jobRole) {
                isValid = false;
                const error = document.createElement('p');
                error.classList.add('text-danger', 'error-message');
                error.innerText = 'Job Role is required.';
                document.querySelector('input[name="title"]').after(error);
            }

            if (!jobDescription) {
                isValid = false;
                const error = document.createElement('p');
                error.classList.add('text-danger', 'error-message');
                error.innerText = 'Job Description is required.';
                document.querySelector('textarea[name="job_description"]').after(error);
            }

            if (!selectedFeedbackRating) {
                isValid = false;
                alert('Please select a feedback rating.');
            }

            if (!isValid) {
                return; // Stop further execution if validation fails
            }

            const ajaxResponse = @json($cachedData);
            // Prepare data payload
            const payload = {
                role: jobRole,
                description: jobDescription,
                sector: ajaxResponse?.sector_name || 'General Sector',
                sub_sector: ajaxResponse?.sub_sector_name || 'General Sub-sector',
                json: JSON.stringify(ajaxResponse),
                feedback: feedbackType,
                feedback_rating: selectedFeedbackRating.value,
                feedback_comment: additionalComment,
            };
            showOverlay()

            // Make AJAX POST request
            fetch('/admin/feedback/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                    body: JSON.stringify(payload),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        hideOverlay();
                        // Optionally reset the form and close the modal
                        // toastr.success('Feedback submitted successfully!','Status')
                        document.getElementById('feedback-form').reset();
                        document.querySelector('.thumbs-up').classList.remove('active');
                        document.querySelector('.thumbs-down').classList.remove('active');
                        $('#feedbackModal').modal('hide');
                        // $('.feedback-btn p').text('Your Feedback is submitted');
                    } else {
                        alert(data.message || 'Failed to submit feedback. Please try again.');
                        hideOverlay();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An unexpected error occurred. Please try again later.');
                });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Ensure correct placeholder and selection
            $('#riasec').select2({
                placeholder: "Select Riasec",
                closeOnSelect: false,
                allowClear: true,
                width: '100%',
            });

            // Force re-set the value to trigger Select2 UI update
            let preselected = {!! json_encode($cachedData['top3riasec_array'] ?? []) !!};
            console.log(preselected, 'preselected');

            $('#riasec').val(preselected[0]).trigger('change');
            $('#riasec').val(preselected[1]).trigger('change');
            $('#riasec').val(preselected[2]).trigger('change');
            $('#riasec').val(preselected).trigger('change');
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

    @if (isset($cachedData['job_type']) && $cachedData['job_type'] === 'ai')
        <script>
            document.getElementById('job_profile').addEventListener('input', function() {
                var jobRoleName = $('#job_profile').val().trim();
                document.getElementById('jd_job_profile').textContent = jobRoleName || '';
                document.getElementById('jd_job_profile_step').textContent = jobRoleName || '';
            });
        </script>
    @else
        @if (
            (isset($cachedData['is_localized_job']) && $cachedData['is_localized_job'] == true) ||
                request('is_localized_job') == 1)
            <script>
                setTimeout(() => {

                    var jobRoleName = $('#job_profile').val().trim();
                    document.getElementById('jd_job_profile').textContent = jobRoleName || '';
                }, 1000);

                document.getElementById('job_profile').addEventListener('input', function() {
                    var jobRoleName = $('#job_profile').val().trim();
                    document.getElementById('jd_job_profile').textContent = jobRoleName || '';
                    document.getElementById('jd_job_profile_step').textContent = jobRoleName || '';
                });
            </script>
        @else
            <script>
                setTimeout(() => {
                    document.getElementById('jd_title').textContent = "{{ $job?->masterJob?->title ?? '' }}" || '';
                    var jobRoleName = $('#job_profile').val().trim();
                    document.getElementById('jd_job_profile').textContent = jobRoleName || '';
                }, 1000);

                document.getElementById('job_profile').addEventListener('input', function() {
                    var jobRoleName = $('#job_profile').val().trim();
                    document.getElementById('jd_job_profile').textContent = jobRoleName || '';
                    document.getElementById('jd_job_profile_step').textContent = jobRoleName || '';
                    document.getElementById('jd_title').textContent = "{{ $job?->masterJob?->title ?? '' }}" || '';
                });
            </script>
        @endif
    @endif


    {{-- Org Chart Scripts --}}
    <script>
        function compareSkills(masterSkills, cachedSkills, currentFormSkills) {
            console.log('comparing skills', currentFormSkills);
            
            // Form validation: Check for missing preferred levels
            const skillsWithMissingLevels = [];
            currentFormSkills.forEach(skill => {
                const preferredLevel = parseInt(skill.preferred_level) || 0;
                if (!preferredLevel || preferredLevel === 0) {
                    skillsWithMissingLevels.push(skill.name || 'Unknown Skill');
                }
            });

            // If validation fails, return validation error
            if (skillsWithMissingLevels.length > 0) {
                const skillsList = skillsWithMissingLevels.join(', ');
                return {
                    status: 'validation_error',
                    message: `Please select preferred levels for the following skills: ${skillsList}`,
                    validationErrors: {
                        missingLevels: skillsWithMissingLevels,
                        count: skillsWithMissingLevels.length
                    },
                    canSubmit: false
                };
            }

            // If validation passes, proceed with comparison logic
            // Use a composite key that works even for skills without IDs
            const makeKey = (skill) => {
                const id = skill.id || skill.c_id || skill.skillid;
                if (id) return `id:${id}`;
                // For skills without IDs, use name + category + sector as unique key
                const name = (typeof cleanLabel === 'function' ? cleanLabel(skill.name || '') : String(skill.name || '').trim()).toLowerCase();
                const category = String(skill.category_name || '').toLowerCase().trim();
                const sector = String(skill.sector_name || '').toLowerCase().trim();
                return `name:${name}|cat:${category}|sec:${sector}`;
            };
            
            const masterMap = new Map(masterSkills.map(s => [makeKey(s), s]));
            const currentMap = new Map(currentFormSkills.map(s => [makeKey(s), s]));
            const results = [];
            const processedKeys = new Set();

            console.log('mapped skillssssss', masterMap, currentMap);

            // 0. Check for master -> company conversions.
            // When a master skill is converted to a company skill we set `is_new = 1` on the current
            // form row. Prefer that flag for detection (more explicit). Fall back gracefully.
            currentMap.forEach((cs, key) => {
                if (masterMap.has(key)) {
                    const ms = masterMap.get(key);
                    // Primary indicator for conversion is `is_new === 1` on the current skill.
                    const isConverted = Number(cs.is_new) === 1;

                    // Fallback: in case `is_new` isn't present, fallback to previous heuristic
                    // considering is_custom values (company flag) only if needed.
                    const fallbackConverted = (!('is_new' in cs)) && (Number(cs.is_custom) === 1 || Number(cs.is_custom) === 2) && !(Number(ms.is_custom) === 1 || Number(ms.is_custom) === 2);

                    if (isConverted || fallbackConverted) {
                        results.push({
                            skill: cs,
                            masterSkill: ms,
                            status: 'new',
                            reason: 'converted_from_master'
                        });
                        processedKeys.add(key);
                    }
                }
            });

            // 1. Check for removed skills (present in master but not in current form)
            masterMap.forEach((ms, key) => {
                if (!currentMap.has(key)) {
                    results.push({
                        skill: ms,
                        status: 'removed'
                    });
                    processedKeys.add(key);
                }
            });

            // 2. Check for level changes (present in both but with different levels)
            masterMap.forEach((ms, key) => {
                if (currentMap.has(key) && !processedKeys.has(key)) {
                    const currentSkill = currentMap.get(key);
                    const masterLevel = parseInt(ms.preferred_level) || 0;
                    const currentLevel = parseInt(currentSkill.preferred_level) || 0;

                    if (masterLevel !== currentLevel && masterLevel > 0 && currentLevel > 0) {
                        results.push({
                            skill: currentSkill,
                            masterSkill: ms,
                            status: 'level_changed',
                            masterLevel: masterLevel,
                            currentLevel: currentLevel
                        });
                        processedKeys.add(key);
                    }
                }
            });

            // 3. Check for new skills (present in current form but not in master)
            currentMap.forEach((cs, key) => {
                if (!masterMap.has(key) && !processedKeys.has(key)) {
                    results.push({
                        skill: cs,
                        status: 'new'
                    });
                    processedKeys.add(key);
                }
            });

            console.log('checking result', results);
            
            // Return successful validation with comparison results
            return {
                status: 'success',
                message: 'All technical skills have been validated successfully.',
                canSubmit: true,
                comparisonResults: results,
                validationSummary: {
                    totalSkills: currentFormSkills.length,
                    newSkills: results.filter(r => r.status === 'new').length,
                    removedSkills: results.filter(r => r.status === 'removed').length,
                    levelChangedSkills: results.filter(r => r.status === 'level_changed').length
                }
            };
        }

        // Standalone validation function for form submission
        function validateTechnicalSkills() {
            const currentFormSkills = getCurrentFormSkills();
            const skillsWithMissingLevels = [];
            
            currentFormSkills.forEach(skill => {
                const preferredLevel = parseInt(skill.preferred_level) || 0;
                if (!preferredLevel || preferredLevel === 0) {
                    skillsWithMissingLevels.push(skill.name || 'Unknown Skill');
                }
            });

            if (skillsWithMissingLevels.length > 0) {
                const skillsList = skillsWithMissingLevels.join(', ');
                return {
                    isValid: false,
                    message: `Please select preferred levels for the following skills: ${skillsList}`,
                    missingLevels: skillsWithMissingLevels
                };
            }

            return {
                isValid: true,
                message: 'All technical skills have valid preferred levels.',
                totalSkills: currentFormSkills.length
            };
        }

        // Helper function to visually highlight skills with missing levels
        function highlightSkillsWithMissingLevels() {
            const currentFormSkills = getCurrentFormSkills();
            
            // Clear previous highlights
            clearValidationHighlights();
            
            currentFormSkills.forEach((skill, index) => {
                const preferredLevel = parseInt(skill.preferred_level) || 0;
                if (!preferredLevel || preferredLevel === 0) {
                    // Find the corresponding skill row and highlight the level button
                    Object.keys(technicalSkillsData).forEach(skillIndex => {
                        const skillData = technicalSkillsData[skillIndex];
                        if (skillData && (skillData.id == skill.id || skillData.skill_id == skill.id || 
                                        skillData.c_id == skill.c_id || skillData.name === skill.name)) {
                            const levelButton = document.getElementById(`selectTechLevelButton${skillIndex}`);
                            if (levelButton) {
                                levelButton.classList.add('level-missing-highlight');
                                levelButton.style.borderColor = '#dc3545';
                                levelButton.style.backgroundColor = '#f8d7da';
                                levelButton.style.color = '#721c24';
                            }
                        }
                    });
                }
            });
        }

        // Helper function to clear validation highlights
        function clearValidationHighlights() {
            document.querySelectorAll('.level-missing-highlight').forEach(el => {
                el.classList.remove('level-missing-highlight');
                el.style.removeProperty('border-color');
                el.style.removeProperty('background-color');
                el.style.removeProperty('color');
            });
        }

        // Helper function to clear validation highlight for a specific skill
        function clearValidationHighlightForSkill(skillIndex) {
            const levelButton = document.getElementById(`selectTechLevelButton${skillIndex}`);
            if (levelButton && levelButton.classList.contains('level-missing-highlight')) {
                levelButton.classList.remove('level-missing-highlight');
                levelButton.style.removeProperty('border-color');
                levelButton.style.removeProperty('background-color');
                levelButton.style.removeProperty('color');
            }
        }

        function getMergedCurrentSkills(cachedSkills, currentFormChanges) {
            const mergedSkills = [...(cachedSkills || [])];
            const cachedSkillsMap = new Map(mergedSkills.map((s, index) => [s.id || s.skillid, {
                skill: s,
                index
            }]));

            // Process current form technical skills
            Object.keys(technicalSkillsData).forEach(index => {
                const formSkill = technicalSkillsData[index];
                const skillElement = document.querySelector(`#skill-${index}`);

                // Skip if this is a removed skill row or doesn't exist
                if (!formSkill || !skillElement || skillElement.classList.contains('removed-skill')) {
                    return;
                }

                const selectElement = skillElement.querySelector('select[name*="[id]"]');
                const skillId = selectElement?.value;

                if (skillId) {
                    const currentSkillData = {
                        id: skillId,
                        skillid: skillId,
                        name: formSkill.name,
                        preferred_level: formSkill.preferred_level,
                        is_custom: formSkill.is_custom,
                        sector_name: formSkill.sector_name,
                        category_name: formSkill.category_name,
                        description: formSkill.description
                    };

                    if (cachedSkillsMap.has(skillId)) {
                        // Update existing skill in merged array
                        const cachedData = cachedSkillsMap.get(skillId);
                        mergedSkills[cachedData.index] = {
                            ...cachedData.skill,
                            ...currentSkillData
                        };
                    } else {
                        // Add new skill to merged array
                        mergedSkills.push(currentSkillData);
                    }
                }
            });

            // Remove skills that were deleted from the form
            const activeSkillIds = new Set();
            Object.keys(technicalSkillsData).forEach(index => {
                const skillElement = document.querySelector(`#skill-${index}`);
                if (skillElement && !skillElement.classList.contains('removed-skill')) {
                    const selectElement = skillElement.querySelector('select[name*="[id]"]');
                    if (selectElement?.value) {
                        activeSkillIds.add(selectElement.value);
                    }
                }
            });

            // Filter out skills that are no longer in the form
            return mergedSkills.filter(skill => activeSkillIds.has(skill.id || skill.skillid));
        }

        function getCurrentFormSkills() {
            const currentSkills = [];

            // Get all active technical skills from the current form state
            console.log('technical skill data', technicalSkillsData);
            Object.keys(technicalSkillsData).forEach(index => {
                const skillData = technicalSkillsData[index];
                const skillElement = document.querySelector(`#skill-${index}`);

                // Only include skills that exist in DOM and are not removed
                if (skillData && skillElement && !skillElement.classList.contains('removed-skill')) {
                    const selectElement = skillElement.querySelector('select[name*="[id]"]');
                    
                    // Check if skill is in edit mode (has input fields instead of select)
                    const nameInput = skillElement.querySelector('input[name*="[name]"]');
                    const isInEditMode = nameInput && nameInput.type !== 'hidden';

                    // Include skill if it has a select with value OR if it's in edit mode
                    const hasSelectValue = selectElement && selectElement.value;
                    const shouldInclude = hasSelectValue || isInEditMode;

                    if (shouldInclude) {
                        // Initialize the skill object
                        const skillObject = {
                            id: skillData.id || skillData.c_id,
                            c_id: skillData.c_id,
                            skillid: skillData.id || skillData.skill_id,
                            name: skillData.name,
                            preferred_level: skillData.preferred_level,
                            is_custom: skillData.is_custom,
                            // include conversion/new flags so compareSkills can detect converted items
                            is_new: skillData.is_new || 0,
                            is_new_company_skill: skillData.is_new_company_skill || 0,
                            sector_name: skillData.sector_name,
                            category_name: skillData.category_name,
                            description: skillData.description
                        };

                        // Loop through levels 1 to 6 dynamically
                        for (let i = 1; i <= 6; i++) {
                            skillObject[`level_${i}_description`] = skillData[`level_${i}_description`];
                            skillObject[`level_${i}_knowledge`] = skillData[`level_${i}_knowledge`];
                            skillObject[`level_${i}_ability`] = skillData[`level_${i}_ability`];
                        }

                        // Push the completed skill object into currentSkills array
                        currentSkills.push(skillObject);
                    }
                }
            });
            console.log('current form skills', currentSkills);
            return currentSkills;
        }


        function renderComparison(results) {
            // Reset previous comparison styling
            resetComparisonStyling();

            results.forEach(item => {
                const skillId = item.skill.id || item.skill.skillid || item.skill.c_id;
                console.log('renderComparison', skillId, item);

                if (item.status === 'removed') {
                    // Show removed skill row with red styling
                    addRemovedSkillRow(item.skill, skillId);
                }

                if (item.status === 'new') {
                    // Apply green styling for new skills - pass the whole skill object
                    markSkillAsNew(item.skill);
                }

                if (item.status === 'level_changed') {
                    // Show level change with yellow styling
                    console.log('level_changed', skillId, item);

                    updateLevelButtonForChange(item, skillId);
                }
            });
            
            // Update remove button states after rendering comparison
            if (typeof toggleRemoveSkillButtons === 'function') {
                toggleRemoveSkillButtons();
            }
        }


        function addRemovedSkillRow(skill, skillId) {
            const removedIndex = `removed_${skillId}_${Date.now()}`;

            const skillData = {
                c_id: skill?.c_id || null,
                skill_id: skill?.id || skill?.skillid || null,
                id: skill?.id || skill?.skillid || null,
                code: skill?.code || null,
                sector_id: skill?.sector_id || null,
                sector_name: skill?.sector_name || '',
                sub_sector_id: skill?.sub_sector_id || null,
                sub_sector_name: skill?.sub_sector_name || '',
                name: skill?.name || '',
                description: skill?.description || '',
                preferred_level: skill?.preferred_level || '',
                is_custom: skill?.is_custom ?? 0,
                category_id: skill?.category_id ?? '',
                category_name: skill?.category_name ?? '',
            };

            // Helper to safely convert different types to an array of trimmed strings
            function normalizeToArray(value, sep = ';') {
                if (Array.isArray(value)) return value.filter(v => v != null).map(v => String(v).trim()).filter(Boolean);
                if (value == null) return [];
                if (typeof value === 'string') return value.split(sep).map(v => v.trim()).filter(Boolean);
                try {
                    if (typeof value === 'object') {
                        return Object.values(value).map(v => String(v).trim()).filter(Boolean);
                    }
                    return [String(value).trim()].filter(Boolean);
                } catch (e) {
                    return [];
                }
            }

            // Add level data if available
            Object.keys(skill).forEach(key => {
                const match = key.match(/^level_(\d+)_description$/);
                if (match) {
                    const level = match[1];
                    skillData[`level_${level}_description`] = skill[`level_${level}_description`];
                    skillData[`level_${level}_knowledge`] = normalizeToArray(skill[`level_${level}_knowledge`], ';');
                    skillData[`level_${level}_ability`] = normalizeToArray(skill[`level_${level}_ability`], ';');
                }
            });

            // Generate hidden inputs
            let hiddenInputs = '';
            Object.keys(skillData).forEach((key) => {
                if (Array.isArray(skillData[key])) {
                    (skillData[key] || []).forEach((value, i) => {
                        hiddenInputs +=
                            `<input type="hidden" name="removedSkills[${removedIndex}][${key}][${i}]" value="${value}">`;
                    });
                } else {
                    hiddenInputs +=
                        `<input type="hidden" name="removedSkills[${removedIndex}][${key}]" value="${skillData[key]}">`;
                }
            });

            // Determine skill type for badge
            const skillType = skillData.is_custom == 1 || skillData.is_custom == 2 ? 'Company Skill' : 'Master Skill';
            const skillTypeBadge = skillType === 'Master Skill' ?
                `<span class="badge-soft badge-master" data-bs-toggle="tooltip" data-bs-title="${skillType || ''}">${skillType}</span>` :
                `<span class="badge-soft badge-company" data-bs-toggle="tooltip" data-bs-title="${skillType ||  ''}">${skillType}</span>`;

            // Create sector and category badges
            const sectorBadge = skillData.sector_name ?
                `<span class="badge-soft badge-green" data-bs-toggle="tooltip" data-bs-title="${skillData.sector_name ||  ''}">${skillData.sector_name}</span>` :
                '';
            const categoryBadge = skillData.category_name ?
                `<span class="badge-soft badge-purple" data-bs-toggle="tooltip" data-bs-title="${skillData.category_name ||  ''}">${skillData.category_name}</span>` :
                '';

            // Clean the skill name
            const cleanedSkillName = cleanLabel(skillData.name);

            // Create the skill HTML with proper badge display
            const skillHtml = `
            <div class="technical-skill row mb-8 removed-skill" id="skill-${removedIndex}" >
                ${hiddenInputs}
                <div class="d-flex gap-3 w-100 flex-nowrap overflow-hidden">
            
                    <!-- Delete Button -->
                    <div class="flex-shrink-0">
                        <button type="button" disabled class="btn btn-outline btn-outline-danger d-flex align-items-center justify-content-center remove-removed-skill" style="border: 1px solid #C8C8C8 !important; background-color: #FFF !important;" title="Permanently remove">
                            <iconify-icon icon="gg:trash" class="fa-1-5"></iconify-icon>
                        </button>
                    </div>

                    <!-- Edit Button (disabled for removed skills) -->
                    <div class="flex-shrink-0">
                        <button type="button" class="btn btn-outline btn-outline-primary d-flex align-items-center justify-content-center restore-skill" title="Restore this skill">
                            <iconify-icon icon="ix:restore"class="fa-1-5"></iconify-icon>
                        </button>
                    </div>

                    <!-- Select box with badges -->
                    <div class="flex-grow-1 overflow-hidden">
                        <div class="form-control text-truncate w-100 d-flex justify-content-between align-items-center" 
                            style="background-color: #FFE0DD; color: #AA2D22; border-color: #AA2D22;">
                            <span class="span-truncate" data-bs-toggle="tooltip" data-bs-placement="top" style="text-decoration: line-through !important;" data-bs-title="${skillData.name ||  'default'}">
                                ${cleanedSkillName}
                            </span>
                            <div class="d-flex gap-2 flex-shrink-0">
                                ${skillTypeBadge}
                                ${sectorBadge}
                                ${categoryBadge}
                            </div>
                        </div>
                    </div>

                    <!-- Hidden Input -->
                    <input type="hidden" name="removedSkills[${removedIndex}][name]" value="${skillData.name}">

                    <!-- Level Button (disabled) -->
                    <div class="flex-shrink-0">
                        <button type="button" class="btn-view edit-level-btn" disabled 
                                style="background-color: #FFE0DD; color: #AA2D22; border-color: #AA2D22; text-decoration: line-through;">
                            Level ${skillData.preferred_level || ''}
                        </button>
                    </div>
                </div>
            </div>`;

            // Insert the removed skill at the top of the skills container
            const container = document.getElementById('skills-container');
            container.insertAdjacentHTML('afterbegin', skillHtml);

            // Initialize tooltips for the new badges
            // $('[data-bs-toggle="tooltip"]').tooltip('dispose').tooltip();
            initializeTooltips();

            // Add event listeners for the new buttons
            const removedSkillElement = document.getElementById(`skill-${removedIndex}`);

            // Restore button functionality
        

            // Add loading state helpers for restore button to prevent double clicks and
            // show feedback until the confirm modal opens.
            const restoreBtn = removedSkillElement.querySelector('.restore-skill');

            function setBtnLoading(btn) {
                try {
                    btn.disabled = true;
                    // Save original content so we can restore it later
                    if (!btn.dataset.origHtml) btn.dataset.origHtml = btn.innerHTML;
                    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Restoring...';
                    btn.classList.add('btn-loading');
                } catch (e) {
                    // ignore
                }
            }

            function clearBtnLoading(btn) {
                try {
                    btn.disabled = false;
                    if (btn.dataset.origHtml) {
                        btn.innerHTML = btn.dataset.origHtml;
                        delete btn.dataset.origHtml;
                    }
                    btn.classList.remove('btn-loading');
                } catch (e) {
                    // ignore
                }
            }

            if (restoreBtn) {
                restoreBtn.addEventListener('click', function(e) {
                    // Stop other click handlers on the same element (prevents duplicate handlers from interfering)
                    if (e && e.stopImmediatePropagation) e.stopImmediatePropagation();

                    // show loading state immediately
                    setBtnLoading(restoreBtn);

                    // safety fallback: clear loading after 6s in case modal callbacks don't run
                    const fallbackTimer = setTimeout(() => {
                        clearBtnLoading(restoreBtn);
                    }, 6000);

                ModalManager.open({
                    module: 'jobs',
                    key: 'technical_skill_comparison_restore',
                    data: {
                        skillName: skillData.name || 'this skill',
                        skillData: skillData
                    },
                    onSubmit(modalEl) {
                        // Clear loading state in case still set
                        clearTimeout(fallbackTimer);
                        clearBtnLoading(restoreBtn);

                        // Restore the skill
                        const bsModal = bootstrap.Modal.getInstance(modalEl);
                        if (bsModal) bsModal.hide();
                        const newActiveIndex = getNextSkillIndex('.technical-skill:not(.removed-skill)');
                        removedSkillElement.remove();

                        // Add it back as an active skill
                        addTechnicalSkill(newActiveIndex, skillData, []);

                        // Update the comparison visual state
                        setTimeout(() => {
                            const newSkillElement = document.querySelector(
                                `#skill-${newActiveIndex}`);
                            if (newSkillElement) {
                                const selectContainer = newSkillElement.querySelector(
                                    '.select2-container');
                                if (selectContainer) {
                                    selectContainer.style.backgroundColor = '#BBECC5';
                                    selectContainer.style.borderColor = '#218336';
                                    selectContainer.style.borderWidth = '1px';
                                }
                            }
                        }, 100);

                        // Show "Skill Restored" modal
                        // setTimeout(() => {
                        //     const skillRestoredModal = new bootstrap.Modal(document.getElementById('SkillRestoredModal'));
                        //     skillRestoredModal.show();
                        // }, 300);
                    },
                    onShown: (modal) => {
                        // Modal is now visible — clear loading state and populate content
                        clearTimeout(fallbackTimer);
                        clearBtnLoading(restoreBtn);

                        const skillNameEl = modal.querySelector('.skill-name-display');
                        if (skillNameEl) {
                            skillNameEl.textContent = skillData.name || 'this skill';
                        }
                    },
                    // safety: ensure loading cleared if modal doesn't open for some reason
                    onError: function() {
                        clearTimeout(fallbackTimer);
                        clearBtnLoading(restoreBtn);
                    }
                }, true);
                });
            }

           
        }

        function resetComparisonStyling() {
            // Reset all select2 containers - target the actual select2 selection elements
            document.querySelectorAll('.select2-selection--single').forEach(selection => {
                selection.style.backgroundColor = '';
                selection.style.borderColor = '';
                selection.style.borderWidth = '';
            });

            // Also reset any select2-container styling
            document.querySelectorAll('.select2-container').forEach(container => {
                container.style.backgroundColor = '';
                container.style.borderColor = '';
                container.style.borderWidth = '';
            });

            // Reset all level buttons to default
            document.querySelectorAll('[id*="selectTechLevelButton"]').forEach(button => {
                button.style.backgroundColor = '';
                button.style.borderColor = '';
                button.style.color = '';
                button.classList.remove('level-changed');
                button.removeAttribute('data-bs-toggle');
                button.removeAttribute('title');
                $(button).tooltip('dispose');

                // Reset button text to original format
                const index = button.id.replace('selectTechLevelButton', '');
                const skillData = technicalSkillsData[index];
                if (skillData && skillData.preferred_level) {
                    button.textContent = `Level ${skillData.preferred_level}`;
                    button.innerHTML = `Level ${skillData.preferred_level}`;
                }
            });

            // Remove all removed skill rows
            document.querySelectorAll('.removed-skill').forEach(row => {
                row.remove();
            });

            // Reset any additional styling on technical skill rows
            document.querySelectorAll('.technical-skill:not(.removed-skill)').forEach(row => {
                row.style.backgroundColor = '';
                row.style.borderColor = '';
                row.style.border = '';
            });
            
            // Update remove button states after resetting comparison
            if (typeof toggleRemoveSkillButtons === 'function') {
                toggleRemoveSkillButtons();
            }
        }

        function markSkillAsNew(skillToMatch) {
            console.log('markSkillAsNew called with:', skillToMatch);
            
            // Find and apply green styling to new skills
            Object.keys(technicalSkillsData).forEach(index => {
                const skillData = technicalSkillsData[index];
                const skillElement = document.querySelector(`#skill-${index}`);

                if (!skillData || !skillElement || skillElement.classList.contains('removed-skill')) {
                    return;
                }

                // Extract IDs from skillToMatch
                const matchId = skillToMatch.id || skillToMatch.skillid || skillToMatch.c_id;
                let idMatch = matchId && (skillData.id == matchId || skillData.skill_id == matchId || skillData.c_id == matchId);

                // Name matching with cleaning
                const cleanedMatchName = (typeof cleanLabel === 'function' ? cleanLabel(skillToMatch.name || '') : String(skillToMatch.name || '').trim()).toLowerCase();
                const cleanedSkillName = (typeof cleanLabel === 'function' ? cleanLabel(skillData.name || '') : String(skillData.name || '').trim()).toLowerCase();
                let nameMatch = cleanedMatchName && cleanedSkillName && (cleanedMatchName === cleanedSkillName);

                // Check if this skill has the "new" flag
                const isNewCompanyFlag = Number(skillData.is_new_company_skill) === 1 || Number(skillData.is_new) === 1 || Number(skillData.is_custom) === 2;

                console.log(`Checking skill ${index}: idMatch=${idMatch}, nameMatch=${nameMatch}, isNewFlag=${isNewCompanyFlag}`, {
                    skillData: skillData.name,
                    matchName: skillToMatch.name,
                    cleanedSkillName,
                    cleanedMatchName
                });

                if (idMatch || nameMatch || isNewCompanyFlag) {
                    console.log(`✅ Marking skill ${index} as NEW (green)`);
                    // Target the actual select2 selection element
                    const select2Selection = skillElement.querySelector('.select2-selection--single');
                    if (select2Selection) {
                        select2Selection.style.backgroundColor = '#BBECC5';
                        select2Selection.style.borderColor = 'green';
                        select2Selection.style.borderWidth = '1px';
                        select2Selection.style.color = '#196329';
                    }
                }
            });
        }


        function updateLevelButtonForChange(item, skillId) {
            // Find the skill index in technicalSkillsData
            console.log('updateLevelButtonForChange', skillId, item);
            let skillIndex = null;

            Object.keys(technicalSkillsData).forEach(index => {
                console.log('updateLevelButtonForChangeindexxxx', index, technicalSkillsData);

                const skill = technicalSkillsData[index];
                console.log('skillll', skill);
                if (skill && (skill.id == skillId || skill.skill_id == skillId || skill.c_id == skillId)) {
                    skillIndex = index;
                }
            });
            console.log('ssssssssskillIndex', skillIndex);

            if (skillIndex !== null) {
                const levelButton = document.getElementById(`selectTechLevelButton${skillIndex}`);
                if (levelButton) {
                    // Update button content with styled levels + arrow icon
                    levelButton.innerHTML = `
                        <span style="text-decoration: line-through; color: #9ca3af;">
                            Level ${item.masterLevel}
                        </span>
                        <iconify-icon icon="mdi:arrow-right" style="margin: 0 6px; color: #F7941C;"></iconify-icon>
                        <span style="font-weight: 600; color: #F7941C;">
                            Level ${item.currentLevel}
                        </span>
                    `;

                    // Apply yellow styling
                    levelButton.style.backgroundColor = '#FFF5DA';
                    levelButton.style.borderColor = '#F7941C';
                    levelButton.style.color = '#F7941C';
                    levelButton.classList.add('level-changed');
                    levelButton.style.gap = "0";

                    // Add tooltip (use data-bs-title to ensure Bootstrap receives a string)
                    levelButton.setAttribute('data-bs-toggle', 'tooltip');
                    levelButton.setAttribute('data-bs-placement', 'top');
                    levelButton.setAttribute('data-bs-title', `Master skill level: ${item.masterLevel}, Current level: ${item.currentLevel}`);
                    if (levelButton.hasAttribute('title')) levelButton.removeAttribute('title');

                    // Re-initialize tooltip safely
                    try { initializeTooltips(); } catch (err) { console.warn('initializeTooltips failed', err); }
                }
            }
        }





        // Dynamic comparison updates
        function setupDynamicComparison() {
            // Listen for skill changes if comparison is active
            document.addEventListener('change', function(e) {
                if (comparisonActive && e.target.matches('select[name*="technicalSkills"]')) {
                    // Delay to allow the change to process
                    setTimeout(() => {
                        const ajaxResponse = @json($cachedData);
                        let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                            .masterTechnicalSkills.length > 0 ?
                            ajaxResponse.masterTechnicalSkills :
                            (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills :
                                []);
                        const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse
                            .technical_skills : [];
                        const currentFormSkills = getCurrentFormSkills();

                        const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                        
                        // Handle validation errors
                        if (comparison.status === 'validation_error') {
                            console.warn('Validation Error:', comparison.message);
                            return;
                        }
                        
                        // Use comparison results for rendering
                        renderComparison(comparison.comparisonResults);
                        showComparisonSummary(comparison.comparisonResults);
                    }, 100);
                }
            });

            // Listen for level changes
            $('#techskillmodal').on('hidden.bs.modal', function() {
                if (comparisonActive) {
                    setTimeout(() => {
                        const ajaxResponse = @json($cachedData);
                        let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                            .masterTechnicalSkills.length > 0 ?
                            ajaxResponse.masterTechnicalSkills :
                            (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills :
                                []);
                        const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse
                            .technical_skills : [];
                        const currentFormSkills = getCurrentFormSkills();

                        const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                        
                        // Handle validation errors
                        if (comparison.status === 'validation_error') {
                            console.warn('Validation Error:', comparison.message);
                            return;
                        }
                        
                        renderComparison(comparison.comparisonResults);
                        showComparisonSummary(comparison.comparisonResults);
                    }, 100);
                }
            });

            // Listen for skill additions (use closest to detect clicks on child elements)
            document.addEventListener('click', function(e) {
                if (comparisonActive && e.target && e.target.closest && e.target.closest('#add_new_skill')) {
                    setTimeout(() => {
                        const ajaxResponse = @json($cachedData);
                        let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                            .masterTechnicalSkills.length > 0 ?
                            ajaxResponse.masterTechnicalSkills :
                            (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills :
                                []);
                        const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse
                            .technical_skills : [];
                        const currentFormSkills = getCurrentFormSkills();

                        const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                        
                        // Handle validation errors
                        if (comparison.status === 'validation_error') {
                            console.warn('Validation Error:', comparison.message);
                            return;
                        }
                        
                        renderComparison(comparison.comparisonResults);
                        showComparisonSummary(comparison.comparisonResults);
                    }, 500);
                }
            });

            // Listen for skill removals
            document.addEventListener('click', function(e) {
                if (comparisonActive && e.target && e.target.closest && e.target.closest('.remove-skill')) {
                    setTimeout(() => {
                        console.log('adfafdasfdasfasfasfasdfasdfsd');
                        const ajaxResponse = @json($cachedData);
                        let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                            .masterTechnicalSkills.length > 0 ?
                            ajaxResponse.masterTechnicalSkills :
                            (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills :
                                []);
                        const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse
                            .technical_skills : [];
                        const currentFormSkills = getCurrentFormSkills();

                        const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                        
                        // Handle validation errors
                        if (comparison.status === 'validation_error') {
                            console.warn('Validation Error:', comparison.message);
                            return;
                        }
                        
                        renderComparison(comparison.comparisonResults);
                        showComparisonSummary(comparison.comparisonResults);
                    }, 100);
                }
            });

            // Listen for restored skills from removed skill rows
            document.addEventListener('click', function(e) {
                if (comparisonActive && e.target && e.target.closest && e.target.closest('.restore-skill')) {
                    setTimeout(() => {
                        const ajaxResponse = @json($cachedData);
                        let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                            .masterTechnicalSkills.length > 0 ?
                            ajaxResponse.masterTechnicalSkills :
                            (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills :
                                []);
                        const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse
                            .technical_skills : [];
                        const currentFormSkills = getCurrentFormSkills();

                        const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                        
                        // Handle validation errors
                        if (comparison.status === 'validation_error') {
                            console.warn('Validation Error:', comparison.message);
                            return;
                        }
                        
                        renderComparison(comparison.comparisonResults);
                        showComparisonSummary(comparison.comparisonResults);
                    }, 200);
                }
            });
        }

        function showComparisonSummary(results) {
            // Remove existing summary
            hideComparisonSummary();

            const removed = results.filter(r => r.status === 'removed').length;
            const added = results.filter(r => r.status === 'new').length;
            const levelChanged = results.filter(r => r.status === 'level_changed').length;

            const container = document.getElementById('skills-container');
            
            if (removed > 0 || added > 0 || levelChanged > 0) {
                const summaryHtml = `
                    <div class="comparison-summary d-flex justify-content-between align-items-center">
                        <p>This view reflects the technical skills changes compared to the original mapping of JD.</p>
                        <div class="d-flex gap-2">
                            <div class="custom-tooltip">
                                <span><span class="levels new"></span> New</span>
                                <span><span class="levels removed"></span> Removed</span>
                                <span><span class="levels level-update"></span> Level Update</span>
                            </div>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('afterbegin', summaryHtml);
            } else {
                // Show "No changes found" message when there are no changes
                const noChangesHtml = `
                    <div class="comparison-summary no-changes d-flex justify-content-center align-items-center">
                        <div class="d-flex align-items-center">
                            <iconify-icon icon="material-symbols:info-outline" class="info-icon"></iconify-icon>
                            <p>No changes found compared to the original mapping of JD.</p>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('afterbegin', noChangesHtml);
            }
        }

        function hideComparisonSummary() {
            const summary = document.querySelector('.comparison-summary');
            if (summary) {
                summary.remove();
            }
        }

        let comparisonActive = false;

        document.getElementById('comparisonToggle').addEventListener('change', function() {
            const ajaxResponse = @json($cachedData);
            // Use technical_skills as masterSkills if masterTechnicalSkills is not present or empty
            let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                .masterTechnicalSkills.length > 0 ?
                ajaxResponse.masterTechnicalSkills :
                (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : []);
            const cachedSkills = Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : [];
            console.log('masterSkills', masterSkills);
            console.log('cachedSkills', cachedSkills);

            if (this.checked) {
                // Get current form changes
                const currentFormSkills = getCurrentFormSkills();
                console.log('currentFormSkills', currentFormSkills);
                // Compare master vs (cached + current form changes)
                const comparison = compareSkills(masterSkills, cachedSkills, currentFormSkills);
                
                // Handle validation errors
                if (comparison.status === 'validation_error') {
                    console.warn('Validation Error:', comparison.message);
                    // Show validation error to user
                    alert(comparison.message);
                    // Uncheck the toggle since validation failed
                    this.checked = false;
                    return;
                }
                
                renderComparison(comparison.comparisonResults);
                comparisonActive = true;

                // Always show summary (including "No changes found" message)
                showComparisonSummary(comparison.comparisonResults);

            } else {
                // Hide comparison and reset all styling
                resetComparisonStyling();
                comparisonActive = false;

                // Hide summary
                hideComparisonSummary();
            }
        });
        $(document).ready(function() {
            setupDynamicComparison();
        });

        // View Changes Modal Start
        // View Changes Modal functionality using ModalManager
        document.getElementById('viewChangesBtn').addEventListener('click', function() {
            const ajaxResponse = @json($cachedData);
            let masterSkills = Array.isArray(ajaxResponse.masterTechnicalSkills) && ajaxResponse
                .masterTechnicalSkills.length > 0 ?
                ajaxResponse.masterTechnicalSkills :
                (Array.isArray(ajaxResponse.technical_skills) ? ajaxResponse.technical_skills : []);
            const currentFormSkills = getCurrentFormSkills();

            // Get comparison results
            const comparison = compareSkills(masterSkills, [], currentFormSkills);

            // Handle validation errors
            if (comparison.status === 'validation_error') {
                alert(comparison.message);
                return;
            }

            // Open modal using ModalManager
            ModalManager.open({
                module: 'jobs',
                key: 'technical_skill_comparison',
                data: {
                    comparison: comparison.comparisonResults,
                    masterSkills: masterSkills,
                    currentSkills: currentFormSkills
                },
                onSubmit(modalEl) {
                    // Handle any submission logic if needed
                    // For now, this modal is view-only, so just close it
                    ModalManager.close('technical_skill_comparison');
                },
                onShown: (modal) => {
                    // Populate the modal content after it's shown
                    populateViewChangesModalContent(modal, comparison.comparisonResults);
                }
            });
        });

        function populateViewChangesModalContent(modalElement, results) {
            // Find the modal body container (adjust selector based on your modal structure)
            const modalContent = modalElement.querySelector('.modal-body') || modalElement.querySelector(
                '[data-modal-content]');

            if (!modalContent) {
                console.error('Modal content container not found');
                return;
            }

            modalContent.innerHTML = '';

            // Categorize results
            const newSkills = results.filter(r => r.status === 'new');
            const removedSkills = results.filter(r => r.status === 'removed');
            const levelChangedSkills = results.filter(r => r.status === 'level_changed');

            // Generate cards for each category
            if (newSkills.length > 0) {
                modalContent.appendChild(createSkillCard('New Skills', newSkills, 'success'));
            }

            if (removedSkills.length > 0) {
                modalContent.appendChild(createSkillCard('Removed Skills', removedSkills, 'danger'));
            }

            if (levelChangedSkills.length > 0) {
                modalContent.appendChild(createSkillCard('Skill Level Changes', levelChangedSkills, 'warning'));
            }

            // Show message if no changes
            if (newSkills.length === 0 && removedSkills.length === 0 && levelChangedSkills.length === 0) {
                modalContent.innerHTML = `
                <div class="text-center py-5">
                    <iconify-icon icon="garden:file-pdf-stroke-16" width="16" height="16" style="font-size: 48px;"></iconify-icon>
                    <h4 class="mt-3">No changes detected</h4>
                    <p class="text-muted">You haven’t made any updates to skills. Once you add, remove, or update a skill level, the changes will appear here.</p>
                </div>
            `;
            }

            // Initialize Bootstrap components in the modal
            initializeModalComponents(modalElement);
        }

function initializeModalComponents(modalElement) {
    // Initialize Bootstrap tooltips
    modalElement.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
        if (!el.dataset.tooltipInit) {
            new bootstrap.Tooltip(el);
            el.dataset.tooltipInit = 'true';
        }
    });

    // Accordion buttons
    const accordionButtons = modalElement.querySelectorAll('.accordion-button');

    accordionButtons.forEach(button => {
        if (button.dataset.listenerAttached) return;
        button.dataset.listenerAttached = 'true';

        const targetSelector = button.getAttribute('data-bs-target');
        const collapseEl = modalElement.querySelector(targetSelector);
        const bsCollapse = bootstrap.Collapse.getOrCreateInstance(collapseEl, { toggle: false });
        const icon = button.querySelector('iconify-icon');
        const desc = button.closest('.accordion-item')?.querySelector('.hide-desc');

        // Sync initial state (in case something is open by default)
        if (collapseEl.classList.contains('show')) {
            button.classList.remove('collapsed');
            button.setAttribute('aria-expanded', 'true');
            if (icon) icon.setAttribute('icon', 'lsicon:minus-outline');
            if (desc) desc.style.display = 'none';
        } else {
            button.classList.add('collapsed');
            button.setAttribute('aria-expanded', 'false');
            if (icon) icon.setAttribute('icon', 'mage:plus-circle-fill');
            if (desc) desc.style.display = '';
        }

        // Toggle accordion on click
        button.addEventListener('click', function () {
            const isOpen = collapseEl.classList.contains('show');

            if (isOpen) {
                bsCollapse.hide();
            } else {
                bsCollapse.show();

                // Close others
                accordionButtons.forEach(otherBtn => {
                    if (otherBtn === button) return;
                    const otherTarget = otherBtn.getAttribute('data-bs-target');
                    const otherCollapseEl = modalElement.querySelector(otherTarget);
                    const otherBsCollapse = bootstrap.Collapse.getOrCreateInstance(otherCollapseEl);
                    otherBsCollapse.hide();
                });
            }
        });

        // ✅ Update icon + description visibility dynamically
        collapseEl.addEventListener('show.bs.collapse', () => {
            button.classList.remove('collapsed');
            button.setAttribute('aria-expanded', 'true');
            if (icon) icon.setAttribute('icon', 'lsicon:minus-outline');
            if (desc) desc.style.display = 'none';
        });

        collapseEl.addEventListener('hide.bs.collapse', () => {
            button.classList.add('collapsed');
            button.setAttribute('aria-expanded', 'false');
            if (icon) icon.setAttribute('icon', 'mage:plus-circle-fill');
            if (desc) desc.style.display = '';
        });
    });
}



        function createSkillCard(title, skills, variant) {
            const card = document.createElement('div');
            card.className = `card mb-4`;

            const cardHeader = document.createElement('div');
            cardHeader.className = `card-header bg-${variant} text-white`;
            cardHeader.innerHTML = `
                <h6 class="mb-0 d-flex gap-2 align-items-center">
                    ${title} <span>(${skills.length})</span>
                </h6>
            `;

            const cardBody = document.createElement('div');
            cardBody.className = 'card-body p-0 body-bottom';
            cardBody.style.setProperty('padding', '0', 'important');

            const accordion = document.createElement('div');
            accordion.className = 'accordion';
            accordion.id = `accordion${variant}${Date.now()}`; // Unique ID for each accordion

            skills.forEach((item, index) => {
                const accordionItem = createAccordionItem(item, index, accordion.id, variant);
                accordion.appendChild(accordionItem);
            });

            cardBody.appendChild(accordion);
            card.appendChild(cardHeader);
            card.appendChild(cardBody);

            return card;
        }

        function getVariantColor(variant) {
    switch (variant) {
        case 'success': return '#2AA443'; // green
        case 'danger': return '#D4392A';  // red
        case 'warning': return '#F7941C'; // yellow/orange
        default: return '#6c757d';        // gray
    }
}


// Accordion item creation
function createAccordionItem(item, index, parentAccordionId, variant) {
    const color = getVariantColor(variant);
    const accordionItem = document.createElement('div');
    accordionItem.className = 'accordion-item';

            const skill = item.skill;
            const accordionId = `${parentAccordionId}Item${index}`;

            // Determine skill type badge. Consider newly-created company flags so that
            // skills created client-side as company variants are shown correctly.
            const isCompanySkill = (Number(skill.is_custom) === 1 || Number(skill.is_custom) === 2 || Number(skill.is_new_company_skill) === 1 || Number(skill.is_new) === 1);
            const skillType = isCompanySkill ? 'Company Skill' : 'Master Skill';
            let skillTypeBadge = skillType === 'Master Skill' ?
                `<span class="badge badge-soft badge-master" data-bs-toggle="tooltip" title="${skillType ||  'default'}">${skillType}</span>` :
                `<span class="badge badge-soft badge-company" data-bs-toggle="tooltip" title="${skillType || 'default'}">${skillType}</span>`;

    let levelIndicator = '';
    if (item.status === 'level_changed') {
        levelIndicator = `
            <span class="d-flex align-items-center gap-1">
                <span class="d-flex align-items-center gap-1" style="text-decoration: line-through; color: #757575;">
                    <iconify-icon icon="material-symbols:star" width="16" height="16" style="color: #99A1B7;"></iconify-icon> ${item.masterLevel}
                </span>
                <iconify-icon icon="tabler:arrow-right" width="16" height="16"></iconify-icon>
                <span class="d-flex align-items-center gap-1">
                    <iconify-icon icon="material-symbols:star" width="16" height="16" style="color: ${color};"></iconify-icon> ${item.currentLevel}
                </span>
            </span>
        `;
    } else if (skill.preferred_level) {
        levelIndicator = `
            <span class="d-flex align-items-center gap-1" style="color: #757575;">
                <iconify-icon icon="material-symbols:star" width="16" height="16" style="color: #F7941D;"></iconify-icon> ${skill.preferred_level}
            </span>
        `;
    }

    const sectorBadge = skill.sector_name
        ? `<span class="badge badge-soft badge-green" data-bs-toggle="tooltip" title="${skill.sector_name}">${skill.sector_name}</span>`
        : '';
    const categoryBadge = skill.category_name
        ? `<span class="badge badge-soft badge-purple" data-bs-toggle="tooltip" title="${skill.category_name}">${skill.category_name}</span>`
        : '';

    accordionItem.innerHTML = `
        <h2 class="accordion-header" id="heading${accordionId}">
            <button class="accordion-button collapsed" type="button"
                    data-bs-target="#collapse${accordionId}" aria-expanded="false"
                    aria-controls="collapse${accordionId}">
                <span style="padding-left:44px; word-break: break-all;">${cleanLabel(skill.name)}</span>
                <div class="d-flex justify-content-between align-items-center w-100 me-3">
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <iconify-icon icon="mage:plus-circle-fill" width="23" height="23" style="color: ${color}; margin-right: 14px; height: 23px; width: 23px;"></iconify-icon>
                        ${skillTypeBadge}
                        ${sectorBadge}
                        ${categoryBadge}
                    </div>
                    <div class="flex-shrink-0">
                        ${levelIndicator}
                    </div>
                </div>
                <p class="mb-0 hide-desc" style="padding-left:44px;">${skill.description}</p>
            </button>
        </h2>
        <div id="collapse${accordionId}" class="accordion-collapse collapse"
             aria-labelledby="heading${accordionId}">
            <div class="accordion-body pt-0" style="padding-left: 60px;">
                ${generateSkillDetails(skill, item, variant)}
            </div>
        </div>
    `;

    return accordionItem;
}

// Updated generateSkillDetails to color check-circle icons
function generateSkillDetails(skill, item, variant) {
    const color = getVariantColor(variant);
    let content = '';

    if (skill.description) {
        content += `<div class="mb-4"><p class="mb-0">${skill.description}</p></div>`;
    }

    let levelsToShow = [];

            if (item.status === 'level_changed') {
                // For level changed skills, show the current level prominently
                levelsToShow.push({
                    level: item.currentLevel,
                    // label: `Current Level ${item.currentLevel}`,
                    label: `Level ${item.currentLevel}`,
                    isPrimary: true,
                    alertClass: 'alert-success'
                });

                // Also show master level for comparison
                // if (item.masterLevel !== item.currentLevel) {
                //     levelsToShow.push({
                //         level: item.masterLevel,
                //         label: `Master Level ${item.masterLevel}`,
                //         isPrimary: false,
                //         alertClass: 'alert-info'
                //     });
                // }
            } else {
                // For new and removed skills, show their current/assigned level
                if (skill.preferred_level) {
                    levelsToShow.push({
                        level: skill.preferred_level,
                        label: `Level ${skill.preferred_level}`,
                        isPrimary: true,
                        alertClass: item.status === 'new' ? 'alert-success' : 'alert-danger'
                    });
                }
            }

            // Show all available levels if no specific level is set
            if (levelsToShow.length === 0) {
                for (let level = 1; level <= 6; level++) {
                    if (skill[`level_${level}_description`] ||
                        skill[`level_${level}_knowledge`] ||
                        skill[`level_${level}_ability`]) {
                        levelsToShow.push({
                            level: level,
                            label: `Level ${level}`,
                            isPrimary: level === 1,
                            alertClass: 'alert-secondary'
                        });
                    }
                }
            }

            // Display details for each level
            levelsToShow.forEach((levelInfo, index) => {
        const levelDesc = skill[`level_${levelInfo.level}_description`];
        const levelKnowledge = skill[`level_${levelInfo.level}_knowledge`];
        const levelAbility = skill[`level_${levelInfo.level}_ability`];

        // Skip if no data for this level
                if (!levelDesc && !levelKnowledge && !levelAbility) {
                    return;
                }

                // Create level container
                const containerClass = levelInfo.isPrimary ? `` : 'pt-3';
                const headerClass = levelInfo.isPrimary ? 'alert-heading' : 'text-primary';

                content += `<div class="${containerClass}">`;

                // Level header
                content += `
                    <h6 class="alert-heading d-flex gap-2 align-items-center mb-3">
                        <iconify-icon icon="material-symbols:star" width="16" height="16" style="color: #F7941D; height: 16px; width: 16px;"></iconify-icon>
                        ${levelInfo.label}
                    </h6>
                `;

                // Level Description
                if (levelDesc) {
                    content += `
                        <div class="mb-5">
                            <p class="mb-0 mt-1">${levelDesc}</p>
                        </div>
                    `;
                }

                // Knowledge Section
                if (levelKnowledge && levelKnowledge.length > 0) {
                    const knowledgeItems = Array.isArray(levelKnowledge) ?
                        levelKnowledge.filter(k => k && k.trim()) :
                        String(levelKnowledge).split(';').filter(k => k && k.trim());

                    if (knowledgeItems.length > 0) {
                content += `
                    <div class="mb-5">
                        <h6 class="alert-heading mb-3">Knowledge:</h6>
                        <ul class="mb-0 mt-1 p-0">
                            ${knowledgeItems.map(k => `<li style="list-style:none;" class="d-flex align-items-center gap-2">
                                <iconify-icon icon="material-symbols-light:check-circle-outline-rounded" width="16" height="16" style="color: ${color}; height: 16px; width: 16px;"></iconify-icon> ${k.trim()}
                            </li>`).join('')}
                        </ul>
                    </div>
                `;
            }
        }

        if (levelAbility) {
            const abilityItems = String(levelAbility).split(',').filter(a => a.trim());
            if (abilityItems.length > 0) {
                content += `
                    <div>
                        <h6 class="alert-heading mb-3">Ability:</h6>
                        <ul class="mb-0 mt-1 p-0">
                            ${abilityItems.map(a => `<li style="list-style:none;" class="d-flex align-items-center gap-2">
                                <iconify-icon icon="material-symbols-light:check-circle-outline-rounded" width="16" height="16" style="color: ${color}; height: 16px; width: 16px;"></iconify-icon> ${a.trim()}
                            </li>`).join('')}
                        </ul>
                    </div>
                `;
            }
        }

        content += `</div>`;
    });

    // Show status-specific messages
            // if (item.status === 'new') {
            //     // If converted from master, show context about the master skill
            //     if (item.reason === 'converted_from_master' && item.masterSkill) {
            //         content += `
            //             <div class="alert alert-info">
            //                 <h6 class="alert-heading mb-1">Converted from Master Skill</h6>
            //                 <p class="mb-0">This skill was originally present in the master mapping as <strong>${cleanLabel(item.masterSkill.name)}</strong> and has been converted to a company skill.</p>
            //             </div>
            //         `;
            //     } else {
            //         content += `
            //             <div class="alert alert-success">
            //                 <h6 class="alert-heading mb-1">New Skill Added</h6>
            //                 <p class="mb-0">This skill has been added and was not present in the master technical skills mapping.</p>
            //             </div>
            //         `;
            //     }
            // } else if (item.status === 'removed') {
            //     content += `
            //         <div class="alert alert-danger">
            //             <h6 class="alert-heading mb-1">Skill Removed</h6>
            //             <p class="mb-0">This skill was present in the master technical skills but has been removed from the current job configuration.</p>
            //         </div>
            //     `;
            // }

            return content || `
                <div class="text-center py-4">
                    <iconify-icon icon="material-symbols:info" class="text-muted" style="font-size: 24px;"></iconify-icon>
                    <p class="text-muted mb-0 mt-2">No detailed information available for this skill.</p>
                </div>
            `;
        }

        function getCardIcon(variant) {
            switch (variant) {
                case 'success':
                    return 'material-symbols:add-circle';
                case 'danger':
                    return 'material-symbols:remove-circle';
                case 'warning':
                    return 'material-symbols:change-circle';
                default:
                    return 'material-symbols:info';
            }
        }

        // Helper function if cleanLabel is not available in scope
        function cleanLabel(text) {
            let str = String(text || '').trim();
            return str.replace(/\s*\(([^)]*)\)\s*$/, (match, inner) => {
                if (inner.includes('-')) {
                    return '';
                }
                return ` (${inner})`;
            }).trim();
        }
        // View Changes Modal End
    </script>



@endsection
