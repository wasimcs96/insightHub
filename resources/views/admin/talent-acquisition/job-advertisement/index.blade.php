@extends('admin.layout.app')

@section('title', 'Talent Insights Hub')

@section('styles')

    <style>
        .app-wrapper {
            margin-top: 74px !important;
        }
    </style>

    <style>
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

        .top-card {
            padding: 30px 30px 0px 30px;
            border-radius: 8px;
            border: 1px solid #F1F1F4;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
            margin-bottom: 30px;
        }

        .top-card .card-info-p {
            color: #99A1B7;
            font-size: 13.975px;
            line-height: 20.963px;
        }

        .top-card .gap-16px {
            gap: 16px;
        }

        .top-card .line-vertical {
            height: 24px;
            width: 1px;
            display: block;
            background-color: #DBDFE9;
        }

        .top-card .badge {
            display: flex;
            padding: 6.4px 12.8px;
            justify-content: center;
            align-items: center;
            border-radius: 64px;
            font-size: 12px;
            line-height: 16px;
        }

        .top-card .badge.active {
            background: #DDF5E2;
            color: #218336;
        }

        .top-card .badge.ready {
            background: #E2F6F6;
            color: #108585;
        }

        .top-card .badge.filled {
            background: #F2EEFD;
            color: #7F66CA;
        }

        .top-card .badge.expired {
            background: #FFE0DD;
            color: #F24130;
        }

        .top-card .vacancy-number {
            padding: 5px 10px;
            border-radius: 5px;
            background: #FFF6EA;
            color: #F7941C;
            font-size: 10px;
            line-height: 14px;
        }

        .top-card .mb-30px {
            margin-bottom: 30px;
        }

        .top-card .card-info-btn button {
            display: flex;
            height: 32px;
            padding: 12px 18px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .top-card .card-info-btn button.btn-orange {
            color: #F7941C;
            border: 1px solid #F7941C;
        }

        .top-card .card-info-btn button.btn-action {
            color: #78829D;
            border: 1px solid #99A1B7;
        }

        .top-card .tabs-div .nav-pills .nav-ite,
        {
        margin: 0;
        }

        .top-card .tabs-div .nav-pills .nav-link {
            padding: 16px;
            color: #99A1B7;
            font-size: 14px;
            line-height: 18px;

        }

        .top-card .tabs-div .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            border-bottom: 1px solid #F7941C;
            color: #F7941C;
        }

        .top-card .tabs-div .applicants-number {
            display: flex;
            width: 33px;
            height: 20px;
            align-items: center;
            justify-content: center;
            border-radius: 3.4px;
            background: #F1F1F4;
            color: #99A1B7;
            text-align: center;
            font-size: 10px;
        }
    </style>

    <style>
        .ji-body {
            gap: 26px;
        }

        .ji-left-side {
            width: 62%;
            display: flex;
            padding: 30px;
            flex-direction: column;
            gap: 48px;
            flex: 1 0 0;
            border-radius: 8px;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .ji-sidebar {
            width: 28%;
        }

        .ji-left-side h5 {
            color: #071437;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
        }

        .ji-left-side p {
            color: #4B5675 !important;
            font-size: 16px !important;
            font-weight: 400 !important;
            line-height: 22.4px !important;
            letter-spacing: 0.5px;
        }

        .ji-left-side .accordion-design {
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

        .ji-left-side .accordion-design .icon {
            color: #1AC2C2;
            width: 23px;
        }

        .ji-left-side .accordion-button,
        .ji-left-side .accordion-item {
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

        .ji-left-side .accordion-body {
            border-radius: 8.13px;
            padding: 19.5px 24px;
            background: rgb(226, 246, 246);
        }

        .ji-left-side .accordion-body ul li {
            color: #4B5675;
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
        }

        .ji-left-side .accordion-button {
            padding: 0px;
        }

        .ji-left-side .accordion-item {
            border: 0;
        }

        .ji-left-side .accordion-button:not(.collapsed) {
            color: #555;
            box-shadow: none;
            background: none;
        }

        .ji-sidebar .box {
            padding: 24px;
            border-radius: 8px;
            border: 1px solid #F1F1F4;
            background: #FFF;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.03);
        }

        .ji-sidebar h4,
        .ji-left-side h4 {
            color: #1E1E1E;
            font-size: 19.5px;
            font-weight: 700;
            line-height: 23.4px;
            margin-bottom: 12px;
        }

        .ji-sidebar p {
            color: #4B5675 !important;
            font-size: 14px !important;
            font-weight: 400 !important;
            line-height: 22px !important;
        }

        .ji-sidebar h5 {
            color: #1E1E1E;
            font-size: 16.25px;
            font-weight: 500;
            line-height: 19.5px;
        }

        .ji-left-side .tag {
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
            font-weight: 500;
        }
    </style>

    <style>
        .applicants-main-div {
            display: flex;
            padding: 32px 16px 16px 16px;
            flex-direction: column;
            gap: 24px;
        }

        .applicants-main-div h4 {
            color: #000;
            font-size: 26px;
            font-weight: 500;
            line-height: 27.3px;
        }

        .applicants-main-div .btn-reject-candidate,
        .applicants-main-div .filter-button,
        .applicants-main-div .field-setting,
        .applicants-main-div .btn-reject-candidate-selected,
        .applicants-main-div .orange-outline,
        .applicants-main-div .orange-fill {
            display: flex;
            padding: 12px 18px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            font-size: 12px;
            font-style: normal;
            font-weight: 600;
            line-height: 16px;
        }

        .applicants-main-div .btn-reject-candidate {
            border: 1px solid#DBDFE9;
            background: #F1F1F4;
            color: #99A1B7;
        }

        .btn-shortlist-candidate {
            border: 1px solid#DBDFE9;
            background: #F1F1F4;
            color: #99A1B7;
            display: flex;
            padding: 12px 18px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            font-size: 12px;
            font-style: normal;
            font-weight: 600;
            line-height: 16px;
        }

        .btn-general {
            border: 1px solid#DBDFE9;
            background: #F1F1F4;
            color: #99A1B7;
            display: flex;
            padding: 12px 18px;
            justify-content: center;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
            font-size: 12px;
            font-style: normal;
            font-weight: 600;
            line-height: 16px;
        }

        .applicants-main-div .btn-reject-candidate-selected {
            border: 1px solid#F24130;
            background: #fff;
            color: #F24130;
        }

        .applicants-main-div .btn-reject-candidate-selected:hover {
            border: 1px solid#F24130;
            background: #FF6355;
            color: #fff;
        }

        .applicants-main-div .orange-outline {
            border: 1px solid#F7941C;
            background: #fff;
            color: #F7941C;
        }

        .applicants-main-div .orange-fill {
            border: 1px solid#F7941C;
            background: #F7941C;
            color: #fff;
        }

        .applicants-main-div .filter-button,
        .applicants-main-div .field-setting {
            background: #FAFAFB;
            color: #78829D;
        }

        .applicants-main-div .search-container {
            border-radius: 4px !important;
            border: 1px solid #C4CADA;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
            width: 389px;
        }

        .applicants-main-div .search-container input {
            width: 100%;
        }

        .applicants-main-div .search-container input:focus {
            outline: none;
        }

        .applicants-main-div .tabs-div {
            border: 1px solid #78829D;
            border-radius: 4px;
            width: 335px;
        }

        .applicants-main-div .assessment-tabs-div {
            border: 1px solid #78829D;
            border-radius: 4px;
        }

        .applicants-main-div .assessment-tabs-div ul {
            height: 40px;
            width: max-content;
        }

        .applicants-main-div .tabs-div ul {
            height: 40px;
            width: max-content;
        }

        .applicants-main-div .tabs-div .nav-pills .nav-item,
        .applicants-main-div .assessment-tabs-div .nav-pills .nav-item {
            margin: 0;
        }

        .applicants-main-div .tabs-div .nav-pills .nav-link,
        .applicants-main-div .assessment-tabs-div .nav-pills .nav-link {
            display: flex;
            padding: 12px 18px;
            justify-content: center;
            align-items: center;
            color: #78829D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            border-radius: 0;
            border: 1px solid #78829D;
        }

        #applied-tab.nav-link,
        #rejected-tab.nav-link,
        #assessment-pending-tab.nav-link,
        #assessment-completed-tab.nav-link,
        #hiring-interview-scheduled-tab.nav-link,
        #hiring-interview-conducted-tab.nav-link {
            border: 0;
        }

        #withdraw-tab.nav-link {
            border: 0;
            border-left: 1px solid #78829D;
            border-right: 1px solid #78829D;
        }

        .applicants-main-div .tabs-div .nav-pills .nav-link.active,
        .applicants-main-div .assessment-tabs-div .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background: #F7941C;
            color: #fff;
        }

        #applied-tab.nav-link.active,
        #assessment-pending-tab.nav-link.active,
        #hiring-interview-scheduled-tab.nav-link.active {
            border-radius: 4px 0px 0px 4px;
            border: none;
        }

        #withdraw-tab.nav-link.active {
            border-radius: 0;
            border: none;
        }

        #rejected-tab.nav-link.active,
        #assessment-completed-tab.nav-link.active,
        #hiring-interview-conducted-tab.nav-link.active {
            border-radius: 0px 4px 4px 0px;
            border: none;
        }
    </style>

    <style>
        .table-container .custom-table {
            width: max-content;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .table-container .custom-table thead th {
            padding: 16px;
            color: #4B5675;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
            border-bottom: 1px solid #DBDFE9;
        }

        .table-container .custom-table tr th:nth-child(3),
        .table-container .custom-table tbody td:nth-child(3) {
            background: #FFF5DA;
        }

        .table-container .custom-table-withdraw tr th:nth-child(3),
        .table-container .custom-table-withdraw tbody td:nth-child(3),
        .table-container .custom-table-rejected tbody td:nth-child(3),
        .table-container .custom-table-rejected tbody td:nth-child(3) {
            background: #FAFAFB !important;
        }

        .table-container .custom-table th:nth-child(4),
        .table-container .custom-table td:nth-child(4),
        .table-container .custom-table th:nth-child(6),
        .table-container .custom-table td:nth-child(6),
        .table-container .custom-table th:nth-child(8),
        .table-container .custom-table td:nth-child(8),
        .table-container .custom-table th:nth-child(10),
        .table-container .custom-table td:nth-child(10),
        .table-container .custom-table th:nth-child(12),
        .table-container .custom-table td:nth-child(12),
        .table-container .custom-table th:nth-child(14),
        .table-container .custom-table td:nth-child(14),
        .table-container .custom-table th:nth-child(16),
        .table-container .custom-table td:nth-child(16) {
            background: #FAFAFB;
        }

        .table-container .custom-table-withdraw th:nth-child(3),
        .table-container .custom-table-withdraw td:nth-child(3),
        .table-container .custom-table-withdraw th:nth-child(5),
        .table-container .custom-table-withdraw td:nth-child(5),
        .table-container .custom-table-withdraw th:nth-child(7),
        .table-container .custom-table-withdraw td:nth-child(7),
        .table-container .custom-table-withdraw th:nth-child(9),
        .table-container .custom-table-withdraw td:nth-child(9) {
            background: #FAFAFB !important;
        }

        .table-container .custom-table-rejected th:nth-child(11),
        .table-container .custom-table-rejected td:nth-child(11),
        .table-container .custom-table-rejected th:nth-child(13),
        .table-container .custom-table-rejected td:nth-child(13),
        .table-container .custom-table-rejected th:nth-child(15),
        .table-container .custom-table-rejected td:nth-child(15) {
            background: #FAFAFB !important;
        }

        .table-container .custom-table-withdraw th:nth-child(4),
        .table-container .custom-table-withdraw td:nth-child(4),
        .table-container .custom-table-withdraw th:nth-child(6),
        .table-container .custom-table-withdraw td:nth-child(6),
        .table-container .custom-table-withdraw th:nth-child(8),
        .table-container .custom-table-withdraw td:nth-child(8),
        .table-container .custom-table-withdraw th:nth-child(10),
        .table-container .custom-table-withdraw td:nth-child(10),
        .table-container .custom-table-rejected th:nth-child(12),
        .table-container .custom-table-rejected td:nth-child(12),
        .table-container .custom-table-rejected th:nth-child(14),
        .table-container .custom-table-rejected td:nth-child(14),
        .table-container .custom-table-rejected th:nth-child(16) {
            background: #fff !important;
        }

        .table-container .custom-table-interview-scheduled tbody td:nth-child(4),
        .table-container .custom-table-interview-scheduled th:nth-child(4) {
            background: #FFF6EA !important;
        }

        .table-container .employee-head {
            display: grid;
            grid-template-columns: 76% 10%;
        }

        .table-container .employee-head p,
        .table-container .top-row p {
            margin: 0;
        }

        .table-container .top-row {
            display: flex;
            gap: 24px;
            justify-content: center;
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            height: 90px;
        }

        .table-container .custom-table tbody td {
            text-align: center;
            padding: 16px;
            font-size: 0.9rem;
            vertical-align: middle;
            border-bottom: 1px solid #DBDFE9;
        }

        .table-container .employee-info {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            width: 100%;
            justify-content: space-between;
            padding: 0px 10px;
        }

        .table-container .employee-info .grey {
            color: #99A1B7;
        }

        .table-container .employee-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .table-container .employee-info .employee-name {
            color: #071437;
            font-size: 14px;
            font-weight: 600;
            line-height: normal;
            margin: 0;
            text-align: left;
        }

        .table-container .employee-info .employee-email {
            color: #4B5675;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            margin: 0;
            text-align: left;
            margin-bottom: 5px;
            overflow-wrap: break-word;
        }

        .table-container .high {
            background-color: #DDF5E2;
            color: #196329;
            border-radius: 15px;
            padding: 4px 12px;
        }

        .table-container .moderate {
            background-color: #FFEBB4;
            color: #EB8100;
            border-radius: 15px;
            padding: 4px 12px;
        }

        .table-container .low {
            background-color: #ffcdd2;
            color: #d32f2f;
            border-radius: 15px;
            padding: 4px 12px;
        }

        .table-container .high-risk {
            background-color: #FFE0DD;
            color: #AA2D22;
            border-radius: 15px;
            padding: 4px 12px;
        }

        .table-container .profile {
            color: #D9D9D9;
            font-size: 36px;
            width: 36px;
        }

        .table-container .profile-name {
            width: 76%;
            text-align: left;
        }

        .table-container .profile-name p {
            margin-top: 4px;
        }

        .table-container .info {
            font-size: 20px;
            color: #99A1B7;
            width: 20px;
        }

        .table-container .info:active {
            color: #757575;
        }

        .table-container .custom-table input[type="checkbox"] {
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

        .table-container .custom-table input[type="checkbox"]:checked {
            background-color: #F7941C;
            border: 4px solid #fff;
            box-shadow: 0px 3px 4px 0px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }

        .table-container .custom-table thead {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 10;
        }

        .table-container {
            overflow: auto;
            height: 68vh;
        }



        .table-container .custom-table th:nth-child(2) {
            width: 240px;
        }

        .table-container .custom-table td:first-child,
        .table-container .custom-table td:nth-child(2),
        .table-container .custom-table th:first-child,
        .table-container .custom-table th:nth-child(2) {
            position: sticky;
            left: 0;
            z-index: 1;
            background-color: white;
        }

        .table-container .custom-table th:nth-child(1),
        .table-container .custom-table th:nth-child(2) {
            z-index: 100;
            background-color: #f8f8f8;
        }

        .table-container .custom-table thead th {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 10;
        }

        .table-container .custom-table td {
            background-color: #fff;
            z-index: 0;
        }

        .custom-table td .badge {
            padding: 8px 16px;
            border-radius: 80px;
            text-align: center;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
        }

        .custom-table td .p-content {
            color: #000;
            font-size: 12px;
            font-weight: 400;
        }

        .custom-table td .badge.applied {
            color: #125A78;
            background-color: #E3F7FF;
        }

        .custom-table td .badge.green {
            color: #196329;
            background-color: #DDF5E2;
        }

        .custom-table td .badge.dark-green {
            color: #196329;
            background-color: #BBECC5;
        }

        .custom-table td .badge.yellow {
            color: #EB8100;
            background-color: #FFEBB4;
        }

        .custom-table td .badge.light-yellow {
            color: #A56313;
            background-color: #FFEBB4;
        }

        .custom-table td .badge.purple {
            color: #6652A1;
            background-color: #F2EEFD;
        }

        .custom-table td .badge.teal {
            color: #108585;
            background-color: #E2F6F6;
        }

        .custom-table td .badge.red {
            color: #F24130;
            background-color: #FFE0DD;
        }

        .custom-table td .btn-orange-outline {
            padding: 12px 18px;
            gap: 8px;
            border-radius: 4px;
            border: 1px solid #F7941C;
            color: #F7941C;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            background-color: #fff;
        }

        .custom-table td .btn-grey-outline {
            padding: 12px 18px;
            gap: 8px;
            border-radius: 4px;
            border: 1px solid #78829D;
            background: none;
            color: #78829D;
            font-size: 12px;
            font-weight: 600;
            line-height: 16px;
            width: fit-content;
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
    </style>

    <style>
        .applicants-main-div .hiring-tabs-div .nav-pills .nav-ite,
        {
        margin: 0;
        }

        .applicants-main-div .hiring-tabs-div .nav-pills .nav-link {
            padding: 12px;
            color: #C4CADA;
            font-size: 14.95px;
            font-weight: 400;
            line-height: 17.94px;

        }

        .applicants-main-div .hiring-tabs-div .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #4B5675;
            font-weight: 500;
            border-bottom: 3px solid #F7941C;
        }

        .applicants-main-div .hiring-tabs-div .applicants-number {
            display: flex;
            width: 33px;
            height: 20px;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            background: #EBEBEB;
            color: #C4CADA;
            text-align: center;
            font-size: 12px;
        }
    </style>

    <style>
        .modal-content .btn-custom,
        .modal-content .btn-custom-contract {
            display: flex;
            gap: 8px;
        }

        .modal-content .btn-custom-contract {
            justify-content: space-between !important;
        }

        .btn-custom button,
        .btn-custom-contract button {
            display: flex;
            padding: 14px 20px !important;
            justify-content: center;
            align-items: center;
            flex: 1 0 0;
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
            border-radius: 4px;
        }

        .btn-custom-contract button {
            flex: none;
        }

        .btn-custom .btn-outline,
        .btn-custom-contract .btn-outline {
            color: #78829D;
            border: 1px solid #99A1B7;
            background: #FFF;
        }

        .btn-custom .disabled,
        .btn-custom-contract .disabled,
        .modal-body input[type="number"].disabled,
        .modal-body select.form-select.disabled {
            color: #99A1B7;
            border: 1px solid #99A1B7 !important;
            background: #F1F1F4;
        }

        .btn-custom .btn-apply,
        .btn-custom-contract .btn-apply {
            background: #F7941C;
            border: 1px solid #F7941C;
            color: #FFF;
        }

        .modal-body .custom-label {
            color: #071437;
            font-size: 12px;
            line-height: 16px;
        }

        .modal-body input.form-control,
        .modal-body .contract select.form-select, .convert-employee-modal .custom-select select {
            height: 40px;
            padding: 0px 12px;
            border-radius: 4px;
            border: 1px solid #DBDFE9;
            background-color: #FFF;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 400;
        }

        .modal-body .input-group-text {
            background-color: white;
        }

        .modal-body input:focus {
            outline: none;
            box-shadow: none;
        }

        .modal-body input[type="number"],
        .modal-body select.form-select {
            width: 42px;
            height: 29px;
            padding: 4px;
            border-radius: 4px !important;
            border: 1px solid #99A1B7;
            color: #BDC0CC;
            font-size: 14px;
            font-weight: 400;
            line-height: 150%;
        }

        .modal-body input[type="radio"] {
            appearance: none;
            border: 1px solid #DBDFE9;
            padding: 8px;
            border-radius: 50%;
        }

        input[type="radio"]:checked {
            background-color: #fff;
            border: 5px solid #F7941C;
            padding: 4px;
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
            height: 24px;
        }

        .tag .remove-tag {
            background: none;
            border: none;
            cursor: pointer;
            color: #6C7280;
            font-size: 20px;
            padding: 0;
        }

        .tag-input {
            border: none;
            outline: none;
            flex-grow: 1;
            min-width: 120px;
            background: transparent;
            color: #99A1B7;
            font-size: 12px;
            font-weight: 400;
        }

        .modal-body .color-grid-modal {
            grid-template-columns: 81% 15%;
            width: 80%;
            gap: 24px;
            padding: 16px 16px 0px 16px;
        }

        .modal-body .color-grid-modal .right-side,
        .modal-body .color-grid-modal .left-side {
            display: grid;
            gap: 16px;
        }

        .modal-body .color-grid-modal .right-side .arrow-div,
        .modal-body .color-grid-modal .left-side .arrow-div {
            width: 100%;
            height: 3px;
            background: #DBDFE9;
        }

        .modal-body .color-grid-modal .left-side .arrow {
            position: relative;
            top: -10.5px;
            left: 96.5%;
            color: #DBDFE9;
        }

        .modal-body .color-grid-modal .right-side {
            position: absolute;
            right: 8%;
            top: 70%;
            transform: rotate(90deg);
        }

        .modal-body .color-grid-modal .left-side .right-side-arrow-div {
            position: relative;
            transform: rotate(90deg);
            right: -53%;
            height: 0px;
            bottom: 154px;
            margin-left: 185px;

        }

        .modal-body .color-grid-modal .left-side .color-grid {
            display: grid;
            grid-template-columns: 18.6% 18.6% 18.6% 18.6% 18.6%;
            gap: 8px;
        }

        .modal-body .color-grid-modal .left-side .grid-item {
            width: 100%;
            height: 50px;
            border-radius: 4px;
            border: 1px solid #D9D9D9;
        }

        .modal-body .color-grid-modal .left-side .red {
            background-color: #E66C6C;
        }

        .modal-body .color-grid-modal .left-side .orange {
            background-color: #F2B948;
        }

        .modal-body .color-grid-modal .left-side .yellow {
            background-color: #F6E54B;
        }

        .modal-body .color-grid-modal .left-side .green {
            background-color: #7DC76F;
        }

        .modal-body .color-grid-modal .left-side .selected .checkmark {
            font-size: 36px;
            color: white;
            top: 6px;
            position: relative;
            left: 25px;
        }
    </style>

    <style>
        .field-setting-sidebar {
            padding: 32px;
        }

        .field-setting-sidebar .offcanvas-header {
            padding: 0px;
            padding-bottom: 32px;
        }

        .field-setting-sidebar .offcanvas-title {
            color: #071437;
            font-size: 17.55px;
            line-height: 21.06px;
        }

        .field-setting-sidebar .offcanvas-header span {
            color: #99A1B7;
            font-size: 12px;
            line-height: 16px;
        }

        .field-setting-sidebar .offcanvas-body {
            padding: 0px;
        }

        .field-setting-sidebar .form-check-label {
            color: #071437;
            font-size: 14px;
            line-height: 20px;
        }

        .field-setting-sidebar .line-grey {
            height: 1px;
            width: 100%;
            display: block;
            background-color: #F1F1F4;
            margin: 16px 0px;
        }

        .field-setting-sidebar .filter-content {
            margin: 32px 0px 0px;
        }

        .field-setting-sidebar .filter-content button {
            display: flex;
            padding: 12px 18px;
            justify-content: center;
            align-items: center;
            flex: 1 0 0;
            border-radius: 4px;
            font-size: 12px;
            line-height: 16px;
        }

        .field-setting-sidebar .filter-content button.btn-outline {
            border: 1px solid #99A1B7;
            background: #FFF;
            color: #78829D;
        }

        .field-setting-sidebar .filter-content button.btn-apply {
            border-radius: 4px;
            background: #F7941C;
            color: #fff;
            border: 1px solid #F7941C;
        }

        .field-setting-sidebar .form-check-input:checked {
            background-color: #F7941C;
            border-color: #F7941C;
        }

        .field-setting-sidebar .checkbox-custom,
        .field-setting-sidebar .custom-radio {
            width: 16px;
            height: 16px;
        }

        .field-setting-sidebar .custom-label {
            color: #071437;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

        .field-setting-sidebar .custom-label span {
            color: #99A1B7;
        }

        .field-setting-sidebar input[type="radio"]:checked {
            border-width: 0.8px;
        }

        .filter-group .selected-text {
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

        .filter-group .form-check-label span {
            color: #99A1B7;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
        }

        .filter-apply {
            background: #DBDFE9;
        }
    </style>

    <style>
        .text-first-head {
            color: #252F4A;
            font-size: 22.75px;
            font-weight: 500;
            line-height: 27.3px;
            margin: 0;
        }

        .box {
            flex: 1 0 0;
            border-radius: 4px;
            background: #FFF;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.10);
        }

        .box p {
            color: #78829D;
            font-size: 12px;
            font-weight: 500;
            line-height: 16px;
            margin-bottom: 20px;
        }

        .box span {
            color: #252F4A;
            font-size: 39px;
            font-weight: 500;
            line-height: 46.8px;
        }

        .green-info {
            padding: 4px 12px;
            border-radius: 4px;
            background: #DDF5E2;
            color: #2AA443;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }

        .top-content p {
            color: #252F4A;
            font-size: 19.5px;
            font-weight: 500;
            line-height: 23.4px;
            margin-bottom: 16px;
        }



        .ratio-div p {
            color: #78829D;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
        }

        .ratio-div span {
            width: 16px;
            height: 8px;
            display: block
        }

        .location-div div {
            border-bottom: 1px solid #F2F2F2;
            margin-bottom: 16px;
        }

        .location-div div p {
            font-size: 16.25px;
            font-weight: 500;
            line-height: 19.5px;
            padding-bottom: 8px;
        }

        .location-div div .name {
            color: #4B5675;
        }

        .location-div div .number,
        .location-div div span {
            color: #78829D;
        }

        .chart-design {
            height: 500px;
            padding: 20px;
            border-radius: 4px;
            background: #F1F1F4;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.10);
        }

        .line-bottom {
            width: 100%;
            height: 3px;
            display: block;
            margin: 48px 0px;
            background-color: #F2F2F2;
        }

        .chart-levels p {
            color: #252F4A;
            font-size: 16.25px;
            font-weight: 500;
            line-height: 19.5px;
        }

        .chart-levels {
            width: 150px;
        }

        .chart-levels span {
            width: 13px;
            height: 13px;
            border-radius: 20px;
            display: block;
            margin-right: 10px;
        }

        .chart-levels .teal {
            background: #65DADA;
        }

        .chart-levels .primary {
            background: #1E95C8;
        }

        .chart-levels .secondary {
            background: #125A78;
        }

        .chart-levels .diploma {
            background: #D0C2F9;
        }

        .chart-levels .purple {
            background: #AA91F4;
        }

        .chart-levels .dark-purple {
            background: #7F66CA;
        }

        .chart-levels .light-blue {
            background: #92D9F8;
        }

        .chart-levels .yellow {
            background: #FFEBB4;
        }

        .chart-levels .blue {
            background: #24B3F0;
        }

        .chart-levels-position {
            position: relative;
        }
    </style>

    <style>
        .location-div div.apexcharts-theme-light,
        .location-div div.apexcharts-legend {
            border: 0;
        }
    </style>

    <style>
        .dropdown-menu-custom {
            position: absolute;
            top: 0px;
            right: -84px;
            background: white;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: none;
            z-index: 999;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .dropdown-toggle-btn {
            cursor: pointer;
        }

        .dropdown-menu-custom li {
            padding: 10px;
            cursor: pointer;
        }

        .dropdown-menu-custom li:hover {
            background-color: #f0f0f0;
        }

        .apexcharts-legend-series {
            height: 30px;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .apexcharts-legend {
            justify-content: center !important;
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
                    Job Advertisement View
                </h2>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Job Advertisement Dashboard</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Job Advertisement View</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content  flex-column-fluid position-lg-relative">
        <div id="kt_app_content_container" class="app-container  container-xxl  w-100 mt-17">
            @include('admin.talent-acquisition.job-advertisement.top-card.top-card')
        </div>
    </div>

    @include('admin.talent-acquisition.job-advertisement.field-setting')

    @include('admin.talent-acquisition.job-advertisement.filters')

    <div class="modal fade" id="advanced-comparison" tabindex="-1" aria-labelledby="advanced-comparison-label"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-2 fw-medium" style="width: 80%">Advanced Comparison</h1>
                    <button type="button" class="p-0 border-0 bg-white" data-bs-dismiss="modal" aria-label="Close"><img
                            src="{{ asset('/admin/media/svg/shapes/cancel.svg') }}" alt="cancel"></button>
                </div>
                <div class="modal-body pt-4">
                    <form>
                        <div class="mb-4">
                            <label for="date" class="custom-label mb-1 fw-medium">Report Type</label>
                            <div class="input-group contract">
                                @php
                                    $reportTypes = config('helpers.advanced_comparison_report_options');
                                @endphp
                                <select class="form-select" id="reportTypeSelect">
                                    <option value="" disabled selected hidden>Select Report Type</option>
                                    @foreach ($reportTypes as $key => $label)
                                        <option value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        {{-- Select Pool Section --}}
                        {{-- <div class="mb-4">
                            <label for="poolSelect" class="custom-label mb-1 fw-medium">Select Pool</label>
                            <div class="input-group contract">
                            <select id="poolSelect" class="form-select">
                                <option value="" disabled selected hidden>Select Pool</option>
                                <option value="candidate-vs-candidate">Candidate vs Candidate</option>
                                <option value="candidate-vs-employee">Candidate vs Employee</option>
                            </select>
                            </div>
                        </div> --}}

                        <div class="btn-custom">
                            <button type="button" class="btn btn-outline" data-bs-dismiss="modal">cancel</button>
                            <button id="modalCompareBtn" class="btn disabled">
                                Compare
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.talent-acquisition.job-advertisement.top-card.modify-application-date')
    @include('admin.talent-acquisition.job-advertisement.top-card.modal')
    @include('admin.talent-acquisition.job-advertisement.hiring-pipeline.hiring-screening-interview.hiring-contract-issue-modal')

    @include('admin.talent-acquisition.job-advertisement.hiring-pipeline.hiring-modal')
@endsection



@section('scripts')

    @if ($page == 'report')
        <script>
            var options = {
                series: [{
                    name: "Candidates",
                    data: @json($statusSeries) // Dynamically passing the series data (total_applications)
                }],
                chart: {
                    type: "bar",
                    height: 574,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "99%",
                        borderRadius: 5,
                        distributed: true
                    }
                },
                colors: ["#CE7B17", "#F7941C", "#F7941CE5", "#F9A845", "#FABB6E", "#FCCF98", "#FDE2C1", "#FFF6EA"],
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val; // Only show the number, not the category label
                    },
                    offsetY: -10, // Adjust this if needed
                    style: {
                        fontSize: '12px',
                        colors: ["#1E2A41"]
                    }
                },
                grid: {
                    show: true,
                    borderColor: "#F1F1F4",
                    strokeDashArray: 0,
                    xaxis: {
                        lines: {
                            show: true
                        }
                    },
                    yaxis: {
                        lines: {
                            show: false
                        }
                    },
                    column: {
                        colors: ["transparent"]
                    }
                },
                xaxis: {
                    categories: @json($statusLabels),
                    labels: {
                        show: true,
                        rotate: -45, // or -60 for steeper angle
                        style: {
                            fontSize: '12px',
                            colors: '#1E2A41'
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        show: false
                    }
                },
                tooltip: {
                    enabled: true,
                    custom: function({
                        series,
                        seriesIndex,
                        dataPointIndex,
                        w
                    }) {
                        var category = w.globals.labels[dataPointIndex];
                        var value = series[seriesIndex][dataPointIndex];

                        // Fetch the rejected count and rejection rate for this status from PHP variables
                        var rejectedCount = @json($totalRejectedApplications)[dataPointIndex] ||
                            0; // Ensure it's 0 if not set
                        var rejectionRate = @json($rejectionRates)[dataPointIndex] ||
                            0; // Ensure it's 0 if not set

                        return `
                        <div style="background: white; 
                                    border-radius: 8px; 
                                    padding: 10px 15px; 
                                    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
                                    font-family: Arial, sans-serif;
                                    border: 1px solid #ddd;">
                            <div style="font-weight: bold; font-size: 14px; color: #1E2A41;">${category}</div>
                            <hr style="margin: 5px 0; border: none; border-top: 1px solid #eee;">
                            <div style="display: flex; align-items: center; gap: 5px;">
                                <span style="width: 10px; height: 10px; background-color: ${w.config.colors[dataPointIndex]}; border-radius: 50%;"></span>
                                <span style="color: #1E2A41; font-size: 13px;">Candidate(s): <strong>${value}</strong></span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 5px;">
                                <span style="width: 10px; height: 10px; background-color:red; border-radius: 50%;"></span>
                                <span style="color: #1E2A41; font-size: 13px;">Rejected Candidates(s): <strong>${rejectedCount}</strong></span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 5px;">
                                <span style="width: 10px; height: 10px; background-color: red; border-radius: 50%;"></span>
                                <span style="color: #1E2A41; font-size: 13px;">Rejection Rate: <strong>${rejectionRate.toFixed(2)}</strong></span>
                            </div>
                        </div>
                    `;
                    }
                },
                legend: {
                    show: false
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        </script>




    <script>
        // Data from Controller
        var workAuthorizationCounts = @json($workAuthorizationCounts);

        // Prepare labels and series
        var labels = workAuthorizationCounts.map(function(item) {
            return item.work_auth === 'Yes' ? 'Yes' : 'No';
        });

        var series = workAuthorizationCounts.map(function(item) {
            return item.total;
        });

        // Calculate total sum of series values
        var totalApplications = series.reduce(function(acc, val) {
            return acc + val;
        }, 0);

        var options = {
            chart: {
                type: 'pie',
                height: 380,
                width: '100%', // Ensure the chart uses full container width
            },
            labels: labels,
            series: series,
            colors: ['#65DADA', '#FFEBB4'],
            stroke: {
                show: true,
                width: 0 // This removes the separation line
            },
            plotOptions: {
                pie: {
                    expandOnClick: true
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val, opts) {
                    // Display label and percentage in data labels
                    return `${opts.w.globals.labels[opts.seriesIndex]}: ${val.toFixed(2)}%`;
                },
            },
            legend: {
                show: true,
                position: 'right', // Place the legend on the right side of the chart
                verticalAlign: 'middle', // Align the legend vertically in the middle
                floating: false, // Ensures the legend is not overlapping the pie chart
                offsetX: 20, // Adjust the horizontal offset to move it outside the chart
                offsetY: 0, // Adjust the vertical offset if needed
                formatter: function(seriesName, opts) {
                    // Calculate the percentage for the legend
                    var seriesValue = opts.w.globals.series[opts.seriesIndex];
                    var percentage = ((seriesValue / totalApplications) * 100).toFixed(2);

                    return `${seriesName} (${percentage}%)`;
                },
            },
            tooltip: {
                enabled: true,
                custom: function({ series, seriesIndex, w }) {
                    let label = w.globals.labels[seriesIndex];
                    let value = series[seriesIndex];
                    let color = w.config.colors[seriesIndex];

                    return `
                    <div style="background: white; padding: 12px 16px; border-radius: 4px; box-shadow: 0px 4px 4px rgba(0,0,0,0.25);">
                        <strong style="color: #071437; font-size: 12px;">${label}</strong>
                        <div style="display: flex; align-items: center; margin-top: 8px;">
                            <span style="display:inline-block;width:10px;height:10px;background:${color};border-radius:50%;margin-right:8px;"></span>
                            <span style="color: #4B5675; font-size:12px;">Candidate(s): <strong>${value}</strong></span>
                        </div>
                    </div>
                    `;
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chartWorkAuthorisation"), options);
        chart.render();
    </script>





    <script>
        // Example of logging the data to check for proper binding
        console.log(educationLevelCounts);

        var educationLevelCounts = @json($educationLevelCounts);

        // Prepare labels and series
        var labels = educationLevelCounts.map(function(item) {
            return item.education_level;
        });

        var series = educationLevelCounts.map(function(item) {
            return item.total_applications;
        });

        // Calculate total sum of series values
        var totalApplications = series.reduce(function(acc, val) {
            return acc + val;
        }, 0);

        var options = {
            chart: {
                type: 'pie',
                height: 410,
                width: '100%', // Make sure the chart width is sufficient
                toolbar: {
                    show: false
                },
                offsetX: 20 // Optional: Adjust the position of the chart
            },
            labels: labels,
            series: series,
            colors: ['#7F66CA', '#AA91F4', '#24B3F0', '#AA91F4', '#92D9F8', '#125A78', '#1E95C8'], // Customize as needed
            stroke: {
                show: true,
                width: 0
            },
            // dataLabels: {
            //     enabled: true,
            //     formatter: function(val, opts) {
            //         return opts.w.globals.labels[opts.seriesIndex] + ": " + val.toFixed(2) + "%";
            //     },
            // },
            legend: {
                show: true,
                position: 'right', // Place the legend to the right of the chart
                verticalAlign: 'middle', // Align the legend vertically in the middle of the chart
                floating: false, // Set floating to false to prevent overlap with chart
                offsetX: 20, // Adjust the horizontal offset to move it outside the chart
                offsetY: 0, // Adjust the vertical offset if needed
                formatter: function(seriesName, opts) {
                    var seriesValue = opts.w.globals.series[opts.seriesIndex];
                    var percentage = ((seriesValue / totalApplications) * 100).toFixed(2);
                    return `${seriesName} (${percentage}%)`;
                },
            },
            tooltip: {
                enabled: true,
                custom: function({ series, seriesIndex, w }) {
                    let label = w.globals.labels[seriesIndex];
                    let value = series[seriesIndex];
                    let color = w.config.colors[seriesIndex];

                    return `
                    <div style="background: white; padding: 12px 16px; border-radius: 4px; box-shadow: 0px 4px 4px rgba(0,0,0,0.25);">
                        <strong style="color: #071437; font-size: 12px;">${label}</strong>
                        <div style="display: flex; align-items: center; margin-top: 8px;">
                            <span style="display:inline-block;width:10px;height:10px;background:${color};border-radius:50%;margin-right:8px;"></span>
                            <span style="color: #4B5675; font-size:12px;">Candidate(s): <strong>${value}</strong></span>
                        </div>
                    </div>
                    `;
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chartEducationLevel"), options);
        chart.render();
    </script>








        <script>
            var workExperienceData = @json($workExperienceCounts); // This will output the PHP data as a JavaScript array

            // Prepare the data for the chart
            var workExperienceLabels = workExperienceData.map(function(item) {
                return item.work_experience;
            });

            var workExperienceValues = workExperienceData.map(function(item) {
                return item.total_applications;
            });

            var options = {
                chart: {
                    type: 'bar',
                    height: 253,
                    width: 577,
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Users',
                    data: workExperienceValues // Use the dynamic data for the bar chart
                }],
                xaxis: {
                    categories: workExperienceLabels, // Use dynamic labels
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function(value, index) {
                            return `${value}`;
                        },
                        style: {
                            fontSize: '16px',
                            colors: ['#5B5B5B'],
                            width: 120, // Fix width for labels
                            whiteSpace: 'nowrap', // Prevents text from wrapping
                            overflow: 'hidden',
                            textOverflow: 'ellipsis', // Truncates long text
                        }
                    }
                },
                grid: {
                    show: false,
                    borderColor: 'transparent'
                },
                legend: {
                    show: false
                },
                tooltip: {
                    enabled: false,
                },
                colors: ['#FDE2C1', '#FCCF98', '#FABB6E', '#F9A845', '#F7941C', '#CE7B17', '#A56313'],
                plotOptions: {
                    bar: {
                        horizontal: true,
                        distributed: true,
                        borderRadius: 5,
                        barHeight: '70%',
                        dataLabels: {
                            position: 'top'
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    offsetX: 40,
                    formatter: function(value) {
                        return `${value} 👤`;
                    },
                    style: {
                        fontSize: '14px',
                        colors: ['#A0A0A0']
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#positionChart"), options);
            chart.render();
        </script>
    @endif


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".accordion-design").forEach((accordionHeader) => {
                accordionHeader.addEventListener("click", function() {
                    let plusIcon = this.querySelector(".plus-icon");
                    let minusIcon = this.querySelector(".minus-icon");
                    let target = document.querySelector(this.getAttribute("data-bs-target"));

                    if (target.classList.contains("show")) {
                        target.addEventListener("hidden.bs.collapse", function() {
                            plusIcon.classList.remove("d-none");
                            minusIcon.classList.add("d-none");
                        }, {
                            once: true
                        });
                    } else {
                        plusIcon.classList.add("d-none");
                        minusIcon.classList.remove("d-none");

                        target.addEventListener("hidden.bs.collapse", function() {
                            plusIcon.classList.remove("d-none");
                            minusIcon.classList.add("d-none");
                        }, {
                            once: true
                        });
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tabButtons = document.querySelectorAll('[data-bs-toggle="pill"]');
            const rejectButton = document.getElementById("rejectCandidateBtn");
            const buttons1 = document.getElementById("assessmentCompletedButtons1");
            const buttons2 = document.getElementById("assessmentCompletedButtons2");
            const tabButton = document.getElementById("hiring-interview-conducted-tab");
            const contentElements = document.querySelectorAll(".interview-conducted-content");

            function toggleVisibility(tabId) {
                // Show "Reject Candidate" button only for "applied-tab"
                if (rejectButton) {
                    rejectButton.style.display = (tabId === "applied-tab" || document.getElementById("applied-tab")
                        .classList.contains("active")) ? "flex" : "none";
                }

                // Show assessment buttons only for "assessment-completed-tab"
                if (buttons1 && buttons2) {
                    const showAssessmentButtons = tabId === "assessment-completed-tab";
                    buttons1.classList.toggle("d-none", !showAssessmentButtons);
                    buttons2.classList.toggle("d-none", !showAssessmentButtons);
                }
            }

            // Initial check for active tab on page load
            const activeTab = document.querySelector(".nav-link.active");
            if (activeTab) {
                toggleVisibility(activeTab.id);
            }

            // Event listener for tab changes
            tabButtons.forEach(tab => {
                tab.addEventListener("shown.bs.tab", function(event) {
                    toggleVisibility(event.target.id);
                });
            });

            try {
                tabButton.addEventListener("shown.bs.tab", function() {
                    contentElements.forEach(el => el.classList.remove("d-none"));
                });

                tabButton.addEventListener("hidden.bs.tab", function() {
                    contentElements.forEach(el => el.classList.add("d-none"));
                });
            } catch (error) {

            }

        });
    </script>

    {{-- <script>
        function setupFileUpload(container) {
            const fileInput = container.querySelector(".fileInput");
            const fileDetails = container.querySelector(".fileDetails");
            const fileList = container.querySelector(".fileList");
            const buttonText = container.querySelector(".buttonText");
            const removeFileButton = container.querySelector(".removeFile");
            const label = container.querySelector(".uploadLabel");

            // Ensure label clicks the file input
            label.addEventListener("click", function() {
                fileInput.click();
            });

            fileInput.addEventListener("change", function(event) {
                const files = event.target.files;
                fileList.innerHTML = ""; // Clear previous entries
                let validFiles = 0;
                const validTypes = ["pdf", "docx", "txt"];
                const maxSize = 5 * 1024 * 1024; // 5MB

                if (files.length > 0) {
                    for (let file of files) {
                        const fileType = file.name.split('.').pop().toLowerCase();

                        if (!validTypes.includes(fileType)) {
                            alert(`Invalid file type: ${file.name}. Only PDF, DOCX, and TXT allowed.`);
                            continue;
                        }
                        if (file.size > maxSize) {
                            alert(`File too large: ${file.name}. Max size is 5MB.`);
                            continue;
                        }

                        validFiles++;
                        const fileItem = document.createElement("div");
                        fileItem.textContent = file.name;
                        fileList.appendChild(fileItem);
                    }
                }

                if (validFiles > 0) {
                    fileDetails.style.display = "flex";
                    buttonText.innerHTML = "Change<br>Documents";
                } else {
                    fileDetails.style.display = "none";
                    buttonText.innerHTML = "Upload<br>Documents";
                }
            });

            removeFileButton.addEventListener("click", function() {
                fileInput.value = ""; // Reset file input
                fileDetails.style.display = "none"; // Hide file details
                fileList.innerHTML = ""; // Clear file names
                buttonText.innerHTML = "Upload<br>Documents";
            });
        }

        // Apply to all file upload components on the same page
        document.querySelectorAll(".file-upload-container").forEach(setupFileUpload);
    </script> --}}

    <script>
        function setupFileUpload(container) {
            const fileInput = container.querySelector(".fileInput");
            const fileDetails = container.querySelector(".fileDetails");
            const fileList = container.querySelector(".fileList");
            const buttonText = container.querySelector(".buttonText");
            const removeFileButton = container.querySelector(".removeFile");
            const label = container.querySelector(".uploadLabel");

            // Find the closest "Convert to Employee" button **inside the same container**
            const convertButton = container.closest("tr")?.querySelector(".btn-grey-outline");

            // Ensure label clicks the file input
            label.addEventListener("click", function() {
                fileInput.click();
            });

            fileInput.addEventListener("change", function(event) {
                const files = event.target.files;
                fileList.innerHTML = ""; // Clear previous entries
                let validFiles = 0;
                const validTypes = ["pdf", "docx", "txt"];
                const maxSize = 5 * 1024 * 1024; // 5MB

                if (files.length > 0) {
                    for (let file of files) {
                        const fileType = file.name.split('.').pop().toLowerCase();

                        if (!validTypes.includes(fileType)) {
                            alert(`Invalid file type: ${file.name}. Only PDF, DOCX, and TXT allowed.`);
                            continue;
                        }
                        if (file.size > maxSize) {
                            alert(`File too large: ${file.name}. Max size is 5MB.`);
                            continue;
                        }

                        validFiles++;
                        const fileItem = document.createElement("div");
                        fileItem.textContent = file.name;
                        fileList.appendChild(fileItem);
                    }
                }

                if (validFiles > 0) {
                    fileDetails.style.display = "flex";
                    buttonText.innerHTML = "Change<br>Documents";

                    // Enable the Convert button **inside the same row**
                    if (convertButton) {
                        convertButton.classList.remove("btn-grey-outline");
                        convertButton.classList.add("btn-orange-outline");
                        convertButton.disabled = false;
                    }
                } else {
                    fileDetails.style.display = "none";
                    buttonText.innerHTML = "Upload<br>Documents";

                    // Disable the Convert button again
                    if (convertButton) {
                        convertButton.classList.remove("btn-orange-outline");
                        convertButton.classList.add("btn-grey-outline");
                        convertButton.disabled = true;
                    }
                }
            });

            removeFileButton.addEventListener("click", function() {
                fileInput.value = ""; // Reset file input
                fileDetails.style.display = "none"; // Hide file details
                fileList.innerHTML = ""; // Clear file names
                buttonText.innerHTML = "Upload<br>Documents";

                // Disable the Convert button again
                if (convertButton) {
                    convertButton.classList.remove("btn-orange-outline");
                    convertButton.classList.add("btn-grey-outline");
                    convertButton.disabled = true;
                }
            });
        }

        // Apply to all file upload components on the same page
        document.querySelectorAll(".file-upload-container").forEach(setupFileUpload);
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#startDateM", {
                // dateFormat: "d M Y",
                defaultDate: document.querySelector("#startDateM").value || null,
            });

            flatpickr("#endDate", {
                // dateFormat: "d M Y",
                defaultDate: document.querySelector("#endDate").value || null,
            });

            flatpickr("#extendEndDate", {
                // dateFormat: "d M Y",
                defaultDate: document.querySelector("#extendEndDate").value || null,
            });


        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const phoneRadio = document.getElementById("phone");
            const interviewerLink = document.getElementById("interviewerLink");
            const otherRadios = document.querySelectorAll('input[name="interviewType"]:not(#phone)');

            phoneRadio.addEventListener("change", function() {
                interviewerLink.style.display = phoneRadio.checked ? "block" : "none";
            });

            otherRadios.forEach(radio => {
                radio.addEventListener("change", function() {
                    interviewerLink.style.display = "none";
                });
            });
        });
    </script>

    <script>
        document.getElementById("tagInput").addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                addTag();
            }
        });

        function addTag() {
            let input = document.getElementById("tagInput");
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
        document.addEventListener("DOMContentLoaded", function() {
            const selectInput = document.getElementById("contractSelect");
            const scheduleButton = document.getElementById("scheduleButton");

            selectInput.addEventListener("change", function() {
                if (selectInput.value) {
                    scheduleButton.classList.remove("disabled");
                    scheduleButton.classList.add("btn-apply");
                } else {
                    scheduleButton.classList.add("disabled");
                    scheduleButton.classList.remove("btn-apply");
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '.grid-item', function() {
            let selectedGridId = $(this).data('id');
            // $('.grid-item').removeClass('selected').find('.checkmark').remove();
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected').find('.checkmark').remove();
                return;
            } else {
                $(this).addClass('selected').append(
                    '<div class="checkmark"><iconify-icon icon="mingcute:check-fill"></iconify-icon></div>'
                );
            }
            loadResults(selectedGridId);
        });

        function loadResults(selectedGridId) {
            console.log("Loading results for Grid ID:", selectedGridId);
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            try {
                document.querySelector(".copyLink").addEventListener("click", function(event) {
                    event.preventDefault(); // Prevent default link behavior

                    let link = this.getAttribute("data-link"); // Get the link from data attribute
                    let tempInput = document.createElement("input"); // Create temp input
                    tempInput.value = link;
                    document.body.appendChild(tempInput);
                    tempInput.select();
                    document.execCommand("copy"); // Copy to clipboard
                    document.body.removeChild(tempInput); // Remove temp input

                    // Show success toaster
                    toastr.success("Link copied to clipboard!");
                });
            } catch (error) {

            }

        });
    </script>


    <script>
        $(document).ready(function() {
            $("#setApplicationDate").click(function() {
                var startDate = $("#startDateM").val();
                var endDate = $("#endDate").val();
                var jobId = "{{ $jobOpening->id ?? '' }}"; // Get the job ID

                $.ajax({
                    url: "{{ route('admin.job.updateApplicationPeriod') }}", // Change to your actual route
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}", // Laravel CSRF token
                        job_id: jobId,
                        start_date: startDate,
                        end_date: endDate,
                        status: "1"
                    },
                    success: function(response) {
                        if (response.success) {
                            $("#hideApplicationSetModal").click();
                            toastr.success(response.message);
                            location.reload();
                        } else {
                            toastr.error("Failed to update dates.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        toastr.error("An error occurred. Please try again.");
                    }
                });
            });

            $("#setAddToExpiry").click(function() {
                var jobId = "{{ $jobOpening->id ?? '' }}"; // Get the job ID

                $.ajax({
                    url: "{{ route('admin.job.updateApplicationStatusToExpired') }}", // Change to your actual route
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}", // Laravel CSRF token
                        job_id: jobId,
                        status: "3"
                    },
                    success: function(response) {
                        if (response.success) {
                            $("#hideAddToExpiry").click();
                            toastr.success(response.message);
                            location.reload();
                        } else {
                            toastr.error("Failed to update status.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        toastr.error("An error occurred. Please try again.");
                    }
                });
            });

            $("#setExtendExpiryDate").click(function() {
                var startDate = "{{ $jobOpening->application_period_start_date }}";
                var endDate = $("#extendEndDate").val();
                var jobId = "{{ $jobOpening->id ?? '' }}"; // Get the job ID

                $.ajax({
                    url: "{{ route('admin.job.updateApplicationPeriod') }}", // Change to your actual route
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}", // Laravel CSRF token
                        job_id: jobId,
                        start_date: startDate,
                        end_date: endDate,
                        status: "2"
                    },
                    success: function(response) {
                        if (response.success) {
                            // $("#hideApplicationSetModal").click();
                            toastr.success(response.message);
                            location.reload();
                        } else {
                            toastr.error("Failed to update dates.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        toastr.error("An error occurred. Please try again.");
                    }
                });
            });

            $("#setLaunchAdvertisement").click(function() {
                var jobId = "{{ $jobOpening->id ?? '' }}"; // Get the job ID

                $.ajax({
                    url: "{{ route('admin.job.updateApplicationStatusToExpired') }}", // Change to your actual route
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}", // Laravel CSRF token
                        job_id: jobId,
                        status: "2"
                    },
                    success: function(response) {
                        if (response.success) {
                            // $("#hideAddToExpiry").click();
                            toastr.success(response.message);
                            location.reload();
                        } else {
                            toastr.error("Failed to update status.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        toastr.error("An error occurred. Please try again.");
                    }
                });
            });

            $("#setDeleteAdvertisement").click(function() {
                var jobId = "{{ $jobOpening->id ?? '' }}"; // Get the job ID

                $.ajax({
                    url: "{{ route('admin.job.deleteAdvertisement') }}", // Change to your actual route
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}", // Laravel CSRF token
                        job_id: jobId
                    },
                    success: function(response) {
                        if (response.success) {
                            // $("#hideAddToExpiry").click();
                            toastr.success(response.message);
                            location.href = "{{ route('admin.job-openings.index') }}";
                        } else {
                            toastr.error("Failed to update status.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        toastr.error("An error occurred. Please try again.");
                    }
                });
            });


        });
    </script>
    @if ($page == 'all-applicants' || $page == 'hiring-pipeline')
        <script>
            $(document).ready(function() {
                showOverlay();
                var requestData = {
                    applicantTitle: '',
                    tab: '1',
                    pageType: '{{ $page }}',
                    showAll: false,
                    selectedUsers: [],
                    perPage: 10,
                    filters: [],
                    sortDirection: 'desc',
                    sortBy: 'updated_at'
                };
              
                
                const filterLabels = {
                    "statusCounts": "Hiring Status",
                    "lastStatusCounts": "Last Hiring Status",
                    "countryCounts": "Nationality",
                    "workAuthorisationCounts": "Work Authorisation",
                    "selectionMatrixCounts": "Selection Matrix",
                    "interviewPerformanceCounts": "Interview Performance",
                    "catLevelCounts": "Cognitive Ability",
                    "rciLevelCounts": "Response Consistency Index",
                    "frLevelCounts": "Flight Risk",
                    "omrLevelCounts": "OMR",
                    "workExperienceCounts": "Work Experience",
                    "interviewDateCounts": "Interview Dates",
                    "educationProgramCounts": "Education Program",
                    "educationLevelCounts": "Education Level",
                   "expectedSalaryCounts": "Expected Monthly Salary (MYR)",
                    "suitabilityRateCounts": "Suitability Rate",
                    "currentLocationCounts": "Current Location",
                    "oceanStatusCounts": "Ocean Assessment",
                    "riasecStatusCounts": "Riasec Assessment",
                    "cognitiveAssessmentStatusCounts": "Cognitive Assessment",
                    "technicalAssessmentStatusCounts": "Technical Assessment",
                    "bfrLevelCounts": "Behaviour Fit Rate",
                    "ssmrLevelCounts": "Soft Skill Match Rate",
                    "jmrLevelCounts": "Job Match Rate",
                    "gpLevelCounts": "Growth Potential",
                    "wafLevelCounts": "Workplace Alignment Forecast",
                    "interviewTimeColumns": "Interview Time",


                };

                function formatCategoryName(name) {
                    return name.replace(/_/g, ' ').replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                }

                function loadFilters() {
                    console.log("==============");
                    console.log(requestData);
                    $.ajax({
                        url: "{{ route('admin.talent-acquisition.job-advertisement.getFilters', $jobOpening->id) }}",
                        method: "GET",
                        data: {
                            tab: requestData.tab,
                            pageType: requestData.pageType
                        },
                        beforeSend: function() {
                            $("#loading").show();
                        },
                        success: function(response) {
                            $("#loading").hide();
                            renderFilters(response);
                        },
                        error: function(error) {
                            $("#loading").hide();
                            console.log("Error fetching filters:", error);
                        }
                    });
                }

                function renderFilters(filters) {
                    let container = $("#filtersContainer");
                    container.empty();

                    $(".filter-checkbox").prop("checked", false);
                    $("#selectedFiltersContainer").empty();

                    Object.keys(filters).forEach(category => {
                        let categoryLabel = filterLabels[category] || formatCategoryName(category);
                        let categoryHtml = `
                        <div class="filter-group">
                            <h6 class="form-check-label fw-bold mb-4">${categoryLabel}</h6>
                            ${Object.entries(filters[category]).map(([option, count]) => `
                                                <div class="form-check d-flex gap-3 p-0 align-items-center mb-3">
                                                    <input class="filter-checkbox form-check-input position-relative m-0 p-0 checkbox-custom" 
                                                        type="checkbox" 
                                                        id="${option}" 
                                                        data-filter="${category}" 
                                                        value="${option}">
                                                    <label class="form-check-label d-flex custom-label fw-medium justify-content-between align-items-center w-100"
                                                        for="${option}">
                                                        ${option} <span class="count">${count}</span>
                                                    </label>
                                                </div>
                                            `).join('')}
                        </div>
                        <div class="line-grey"></div>
                    `;
                        container.append(categoryHtml);
                    });

                    restoreCheckedFilters();
                }

                function getSelectedFilters() {
                    let selectedFilters = [];

                    $(".filter-checkbox:checked").each(function() {
                        let filterKey = $(this).data("filter");
                        let value = $(this).val();
                        let category = filterLabels[filterKey] || formatCategoryName(filterKey);

                        selectedFilters.push({
                            category: category,
                            value: value,
                            filterKey: filterKey
                        });
                    });

                    if (selectedFilters.length > 0) {
                        console.log(selectedFilters.length, "=================");
                        $('span.filterCount').each(function() {
                            $(this).text('(' + selectedFilters.length + ')');
                        });
                    }

                    return selectedFilters;
                }

                function updateSelectedFilters(filters) {
                    let selectedFiltersContainer = $("#selectedFiltersContainer");
                    selectedFiltersContainer.empty();

                    filters.forEach(filter => {
                        let filterText = `${filter.category} - ${filter.value}`;
                        let filterElement = `
                        <div class="mb-2 d-flex align-items-center selected-text">
                            <p class="m-0">${filterText}</p>
                            <iconify-icon icon="maki:cross" width="14" height="14" style="color: #78829D;" 
                                class="remove-filter" data-filter="${filter.value}" data-filter-key="${filter.filterKey}">
                            </iconify-icon>
                        </div>
                    `;
                        selectedFiltersContainer.append(filterElement);
                    });

                    $(".remove-filter").off("click").on("click", function() {
                        let filterValue = $(this).data("filter");
                        let filterKey = $(this).data("filter-key");

                        $(".filter-checkbox").each(function() {
                            if ($(this).data("filter") === filterKey && $(this).val() === filterValue) {
                                $(this).prop("checked", false);
                            }

                            $('span.filterCount').each(function() {
                                $(this).text('(' + $(".filter-checkbox:checked").length + ')');
                            });


                        });

                        // f(1,false,[],getSelectedFilters());
                    });

                }

                function updateFilterCounts(data) {
                    $.each(data, function(key, value) {
                        if (typeof value === "object") {
                            $.each(value, function(subKey, subValue) {
                                $(`#${subKey}`).siblings(".count").text(subValue);
                            });
                        }
                    });
                }

                function updateResultSection(results) {
                    let resultContainer = $("#resultContainer");
                    resultContainer.empty();

                    results.forEach(result => {
                        let resultHtml = `<div class="result-item">${result.name} - ${result.status}</div>`;
                        resultContainer.append(resultHtml);
                    });
                }

                function restoreCheckedFilters() {
                    $(".filter-checkbox").each(function() {
                        let filterId = $(this).attr("id");
                        if ($("#selectedFiltersContainer").find(`[data-filter="${filterId}"]`).length) {
                            $(this).prop("checked", true);
                        }
                    });
                }

                $(document).on("change", ".filter-checkbox", function() {
                    updateSelectedFilters(getSelectedFilters());

                    $('span.filterCount').each(function() {
                        $(this).text('(' + $(".filter-checkbox:checked").length + ')');
                    });
                    // loadEmployees(1,false,[],getSelectedFilters());
                });

                $(document).on("click", "#clearAllFilters1", function(e) {
                    e.preventDefault();
                    $(".filter-checkbox").prop("checked", false);
                    $("#selectedFiltersContainer").empty();
                    requestData.selection_m = null;
                    $('.grid-item').each(function() {
                        $(this).removeClass('selected').find('.checkmark').remove();
                    });
                    loadEmployees(1, false, [], getSelectedFilters());
                    // setTimeout(loadFilters, 100);
                    $('span.filterCount').each(function() {
                        $(this).text('(' + $(".filter-checkbox:checked").length + ')');
                    });
                });

                $(document).on("click", "#clearAllFilters2", function(e) {
                    e.preventDefault();
                    $(".filter-checkbox").prop("checked", false);
                    $("#selectedFiltersContainer").empty();
                    requestData.selection_m = null;
                    $('.grid-item').each(function() {
                        $(this).removeClass('selected').find('.checkmark').remove();
                    });
                    loadEmployees(1, false, [], getSelectedFilters());
                    // setTimeout(loadFilters, 100);
                    $('span.filterCount').each(function() {
                        $(this).text('(' + $(".filter-checkbox:checked").length + ')');
                    });
                });

                $(document).on("click", "#clearAllFilters3", function(e) {
                    e.preventDefault();
                    $(".filter-checkbox").prop("checked", false);
                    $("#selectedFiltersContainer").empty();
                    requestData.selection_m = null;
                    $('.grid-item').each(function() {
                        $(this).removeClass('selected').find('.checkmark').remove();
                    });
                    loadEmployees(1, false, [], getSelectedFilters());
                    // setTimeout(loadFilters, 100);
                    $('span.filterCount').each(function() {
                        $(this).text('(' + $(".filter-checkbox:checked").length + ')');
                    });
                });

                $(document).on("click", ".selected-text iconify-icon", function() {
                    let valueToRemove = $(this).data("filter");
                    let categoryToRemove = $(this).data("category");

                    // Uncheck the corresponding checkbox
                    $(`.filter-checkbox[data-filter-category="${categoryToRemove}"][data-filter-label="${valueToRemove}"]`)
                        .prop("checked", false);

                    // Remove the selected filter from the UI
                    $(this).closest(".selected-text").remove();

                    // Update filters
                    // loadEmployees(1,false,[],getSelectedFilters());
                });

                $(document).on("click", "#applyFilters", function() {
                    loadEmployees(1, false, [], getSelectedFilters());
                });

                loadFilters();


                var showAll = false;

                let selectedRows = [];
                // Dynamically generate the thead based on the columns array
                function generateTableHeader(columns, sortBy, sortDirection, tab) {
                    let theadHtml = '<tr><th><input type="checkbox" id="select-all"></th>';

                    console.log("=-==============================_");

                    console.log(columns);

                    // Loop through columns and add to the header
                    columns.forEach(column => {
                        var directions = {
                            'asc': 'desc',
                            'desc': 'asc'
                        };

                        var infoIcon = '';

                        if (column.info_icon == 'true') {
                            infoIcon = `<iconify-icon icon="material-symbols:info-outline" class="info"
                            toggle="tooltip" placement="top"
                            title="${column.info_description}"></iconify-icon>`;
                        }

                        const currencyShortName = "{{ $jobOpening->currency_short_name }}";
                        if (column.label == "Expected Monthly Salary (MYR)") {
                            column.label = "Expected Monthly Salary (" + currencyShortName + ")";
                        }
                        theadHtml += `
                        <th id="${column.id}Column" class="sortable" currentDirection="${sortBy == column.id+'Column' ? directions[sortDirection]:'asc'}">
                            <div class="employee-head top-row">
                                ${infoIcon}
                                <p>${column.label}</p>
                                <div class="d-grid position-relative" style="grid-auto-rows: 10px 10px; top: -4px;">
                                    <iconify-icon icon="stash:chevron-up-solid" class="info cursor-pointer"></iconify-icon>
                                    <iconify-icon icon="stash:chevron-down-solid" class="info cursor-pointer"></iconify-icon>
                                </div>
                            </div>
                        </th>
                    `;
                        if (["5", "6", "7", "8"].includes(tab) && column.label == "Applicant") {
                            theadHtml += `
                            <th id="actionColumn" class="" >
                                <div class="employee-head">
                                    <p>Action</p>
                                    <div class="d-grid position-relative" style="grid-auto-rows: 10px 10px; top: -4px;">
                                </div>
                                </div>
                            </th>
                        `;
                        }

                        if (["8", "12"].includes(tab) && column.label == "Applicant") {
                            theadHtml += `
                            <th id="contractSigned" class="" >
                                <div class="employee-head">
                                    <p>Contract Signed</p>
                                    <div class="d-grid position-relative" style="grid-auto-rows: 10px 10px; top: -4px;">
                                </div>
                                </div>
                            </th>
                        `;
                        }

                    });

                    theadHtml += '</tr>';

                    // Inject the dynamically generated header into the table
                    $('#employeeTable thead').html(theadHtml);
                }

                function loadEmployees(page = 1, showAll = false, selectedUsers = [], filters = []) {
                    // Create the data object for AJAX
                    showOverlay();
                    requestData.showAll = showAll;
                    if (selectedUsers.length < 1) {
                        requestData.showAll = false
                    }
                    requestData.selectedUsers = selectedUsers.join(",");
                    requestData.filters = getSelectedFilters();

                    $.ajax({
                        url: "{{ route('admin.job.getApplicantUsers', $jobOpening->id) }}?page=" + page,
                        type: "GET",
                        data: requestData,
                        success: function(response) {
                            var tbody = "";
                            loadFieldSettings(response);
                            generateTableHeader(response.columns_visible, response.sortBy, response
                                .sortDirection, requestData.tab);
                            updateTabCounts(response.status_counts);
                            if (response.appliedUsers.data.length > 0) {
                                $.each(response.appliedUsers.data, function(index, applicant) {
                                    tbody += "<tr>";
                                    tbody +=
                                        `<td><input type="checkbox" class="select-row" data-id="${applicant.id}"></td>`;
                                    // Loop through the columns to dynamically generate table rows
                                    $.each(response.columns_visible, function(colIndex, column) {
                                        let cellData = "";

                                        // Fill data based on column id
                                        switch (column.id) {
                                            case "employee":
                                                cellData = `
                                                <div class="employee-info position-relative">
                                                    <img src="{{ asset('/admin/media/svg/shapes/user-ta.svg') }}" alt="filter-icon" />
                                                    <div class="profile-name">
                                                        <p class="employee-name">${applicant.user.name}</p>
                                                        <p class="employee-email">${applicant.user.email}</p>
                                                    </div>
                                            `;

                                                if (requestData.pageType ==
                                                    "hiring-pipeline" && requestData.tab ==
                                                    "1") {

                                                    cellData += `<span class="dropdown-toggle-btn" data-dropdown-id="dropdown-${applicant.id}">⋮</span>
                                                        <div class="dropdown-menu-custom" id="dropdown-${applicant.id}">
                                                            <ul class="list-unstyled mb-0">
                                                                <li applicantID="${applicant.id}" applicantName="${applicant.user.name}" data-jobid="${applicant.job_opening_id}" data-applicantid="${applicant.user_id}">View Applicant Details</li>
                                                                <li applicantID="${applicant.id}" applicantName="${applicant.user.name}" data-jobid="${applicant.job_opening_id}" data-applicantid="${applicant.user_id}">Send Email</li>
                                                                <li applicantID="${applicant.id}" applicantName="${applicant.user.name}" data-jobid="${applicant.job_opening_id}" data-applicantid="${applicant.user_id}"">Reject Applicant</li>
                                                            </ul>
                                                        </div>`;

                                                } else if (requestData.pageType ==
                                                    "hiring-pipeline" && requestData.tab ==
                                                    "6") {


                                                    cellData += `<span class="dropdown-toggle-btn" data-dropdown-id="dropdown-${applicant.id}">⋮</span>
                                                        <div class="dropdown-menu-custom" id="dropdown-${applicant.id}">
                                                            <ul class="list-unstyled mb-0">
                                                                <li applicantID="${applicant.id}" applicantName="${applicant.user.name}" data-jobid="${applicant.job_opening_id}" data-applicantid="${applicant.user_id}">View Applicant Details</li>
                                                                <li applicantInterviewDate="${applicant.interview_date}" applicantInterviewLink="${applicant.interview_link}" applicantInterviewDesc="${applicant.interview_description}" applicantInterviewName="${applicant.interviewer_name}" applicantInterviewMode="${applicant.interview_mode}" applicantInterviewStartTime="${applicant.interview_start_time}" applicantInterviewEndTime="${applicant.interview_end_time}" applicantID="${applicant.id}" applicantName="${applicant.user.name}" data-jobid="${applicant.job_opening_id}" data-applicantid="${applicant.user_id}">Reschedule Interview</li>
                                                                <li applicantID="${applicant.id}" applicantName="${applicant.user.name}" data-jobid="${applicant.job_opening_id}" data-applicantid="${applicant.user_id}"">Reject Applicant</li>
                                                            </ul>
                                                        </div>`;
                                                } else {
                                                    cellData += `<span class="dropdown-toggle-btn" data-dropdown-id="dropdown-${applicant.id}">⋮</span>
                                                        <div class="dropdown-menu-custom" id="dropdown-${applicant.id}">
                                                            <ul class="list-unstyled mb-0">
                                                                <li applicantID="${applicant.id}" applicantName="${applicant.user.name}" data-jobid="${applicant.job_opening_id}" data-applicantid="${applicant.user_id}">View Applicant Details</li>
                                                                <li applicantID="${applicant.id}" applicantName="${applicant.user.name}" data-jobid="${applicant.job_opening_id}" data-applicantid="${applicant.user_id}"">Reject Applicant</li>
                                                            </ul>
                                                        </div>`;
                                                }



                                                cellData += `</div>`;
                                                break;
                                            case "hiringStatus":
                                                cellData = `
                                                <span class="badge ${applicant.application_status_color}">
                                                    ${applicant.status_label}
                                                </span>
                                            `;
                                                break;
                                            case "lastHiringStatus":
                                                cellData = `
                                                <span class="badge ${applicant.application_status_color}">
                                                    ${applicant.status_label}
                                                </span>
                                            `;
                                                break;
                                            case "interviewTimeColumn":
                                                cellData =
                                                    `${applicant.interview_date_time_label}`;
                                                break;
                                            case "currentLocation":
                                                const country = applicant.user.country
                                                ?.name;
                                                const city = applicant.user.city?.name;

                                                if (country && city) {
                                                    cellData = `${country}, ${city}`;
                                                } else if (country || city) {
                                                    cellData = `${country || city}`;
                                                } else {
                                                    cellData = 'Unknown';
                                                }
                                                break;
                                            case "nationality":
                                                cellData =
                                                    `${applicant.user.nationality ? applicant.user.nationality.name : 'Unknown'}`;
                                                break;
                                            case "workAuthorisation":
                                                cellData =
                                                    `${applicant.user.work_authorisation == '1' ? 'Yes' : 'No'}`;
                                                break;
                                            case "selectionMatrix":
                                                cellData =
                                                    `<span class="badge ${response.domain_colors[applicant.selection_matrix_label || 'N/A']}">${applicant.selection_matrix_label}</span>`;
                                                break;
                                            case "interviewPerformance":
                                                cellData =
                                                    `<span class="badge green">${applicant.interview_performance_label || 'N/A'}</span>`;
                                                break;
                                            case "omr":
                                                cellData =
                                                    `<span class="badge ${response.domain_colors[applicant?.user?.results[0]?.omr_level_label || 'N/A']}">${applicant?.user?.results[0]?.omr_level_label || 'N/A'}</span>`;
                                                break;
                                            case "bfr":
                                                cellData =
                                                    `<span class="badge ${response.domain_colors[applicant?.user?.results[0]?.bfr_level_label || 'N/A']}">${applicant?.user?.results[0]?.bfr_level_label || 'N/A'}</span>`;
                                                break;
                                            case "cat":
                                                cellData =
                                                    `<span class="badge ${response.domain_colors[applicant?.user?.results[0]?.cat_level_label || 'N/A']}">${applicant?.user?.results[0]?.cat_level_label || 'N/A'}</span>`;
                                                break;
                                            case "fr":
                                                cellData =
                                                    `<span class="badge ${response.domain_colors[applicant?.user?.results[0]?.fr_level_label || 'N/A']}">${applicant?.user?.results[0]?.fr_level_label || 'N/A'}</span>`;
                                                break;
                                            case "gp":
                                                cellData =
                                                    `<span class="badge ${response.domain_colors[applicant?.user?.results[0]?.gp_level_label || 'N/A']}">${applicant?.user?.results[0]?.gp_level_label || 'N/A'}</span>`;
                                                break;
                                            case "jmr":
                                                cellData =
                                                    `<span class="badge ${response.domain_colors[applicant?.user?.results[0]?.jmr_level_label || 'N/A']}">${applicant?.user?.results[0]?.jmr_level_label || 'N/A'}</span>`;
                                                break;
                                            case "rci":
                                                cellData =
                                                    `<span class="badge ${response.domain_colors[applicant?.user?.results[0]?.rci_level_label || 'N/A']}">${applicant?.user?.results[0]?.rci_level_label || 'N/A'}</span>`;
                                                break;
                                            case "ssmr":
                                                cellData =
                                                    `<span class="badge ${response.domain_colors[applicant?.user?.results[0]?.ssmr_level_label || 'N/A']}">${applicant?.user?.results[0]?.ssmr_level_label || 'N/A'}</span>`;
                                                break;
                                            case "ta":
                                                cellData =
                                                    `<span class="badge ${response.domain_colors[applicant?.user?.results[0]?.ta_level_label]}">${applicant?.user?.results[0]?.ta_level_label || 'N/A'}</span>`;
                                                break;
                                            case "waf":
                                                cellData =
                                                    `<span class="badge ${response.domain_colors[applicant?.user?.results[0]?.waf_level_label]}">${applicant?.user?.results[0]?.waf_level_label || 'N/A'}</span>`;
                                                break;
                                            case "suitabilityRate":
                                                if (applicant.suitability_rate <= 54) {
                                                    cellData =
                                                        `<span class="badge red">${applicant.suitability_rate}%</span>`;
                                                } else if (applicant.suitability_rate >
                                                    54 && applicant.suitability_rate <= 74
                                                    ) {
                                                    cellData =
                                                        `<span class="badge yellow">${applicant.suitability_rate}%</span>`;

                                                } else if (applicant.suitability_rate >
                                                    74) {
                                                    cellData =
                                                        `<span class="badge green">${applicant.suitability_rate}%</span>`;
                                                } else {
                                                    cellData =
                                                        `<span class="badge ">${applicant.suitability_rate}%</span>`;
                                                }
                                                break;
                                            case "workExperience":
                                                cellData =
                                                    `${applicant.user.year_of_experience_in_it_sector} years`;
                                                break;
                                            case "educationProgram":
                                                cellData =
                                                    `${applicant.user.program ? applicant.user.program.name : 'Unknown'}`;
                                                break;
                                            case "educationLevel":
                                                cellData =
                                                    `${applicant.user.education_level_check ? applicant.user.education_level_check.name : 'Unknown'}`;
                                                break;
                                            case "expectedSalary":
                                                cellData = `${applicant.expected_salary}`;
                                                break;
                                            case "oceanStatus":
                                                cellData =
                                                    `<span class="badge ${applicant.user.is_personality_motivation_completed == 1 ? 'dark-green' : 'red'}">${applicant.user.is_personality_motivation_completed == 1 ? 'Yes' : 'No'}</span>`;
                                                break;
                                            case "riasecStatus":
                                                cellData =
                                                    `<span class="badge ${applicant.user.is_work_interest_completed == 1 ? 'dark-green' : 'red'}">${applicant.user.is_work_interest_completed == 1 ? 'Yes' : 'No'}</span>`;
                                                break;
                                            case "technicalAssessmentStatus":
                                                cellData =
                                                    `<span class="badge ${applicant.technical_assessment_completed == 1 ? 'dark-green' : 'red'}">${applicant.technical_assessment_completed == 1 ? 'Yes' : 'No'}</span>`;
                                                break;
                                            case "cognitiveAssessmentStatus":
                                                cellData =
                                                    `<span class="badge ${applicant.user.is_cognitive_ability_completed == 1 ? 'dark-green' : 'red'}">${applicant.user.is_cognitive_ability_completed == 1 ? 'Yes' : 'No'}</span>`;
                                                break;
                                        }

                                        // Append the cell data to the row dynamically
                                        tbody +=
                                            `<td class="${column.id}">${cellData}</td>`;

                                        if (requestData.tab == "5" && column.id ==
                                            "employee") {
                                            tbody += `<td id="${applicant.user.id}" class=""><button class="d-flex align-items-center btn-orange-outline bg-white"
                                                data-bs-toggle="modal" data-username="${applicant.user.name}" data-userid="${applicant.id}" data-bs-target="#schedule-interview"><img
                                                    src="{{ asset('/admin/media/svg/shapes/user-duble-orange.svg') }}" alt="filter-icon" />
                                                Schedule Interview</button></td>`;
                                        } else if (requestData.tab == "6" && column.id ==
                                            "employee") {
                                            tbody += `<td id="${applicant.user.id}" class=""><button class="d-flex align-items-center btn-orange-outline bg-white"
                                                data-bs-toggle="modal" id="conductInterviewBtn" data-username="${applicant.user.name}" data-userid="${applicant.id}" data-bs-target="#"><img
                                                    src="{{ asset('/admin/media/svg/shapes/user-duble-orange.svg') }}" alt="filter-icon" />
                                                Conduct Interview</button></td>`;
                                        } else if (requestData.tab == "7" && column.id ==
                                            "employee") {
                                            tbody += `<td id="${applicant.user.id}" class=""><button class="d-flex align-items-center btn-orange-outline bg-white"
                                                data-bs-toggle="modal" data-username="${applicant.user.name}" data-userid="${applicant.id}" data-bs-target="#contract-issue"><img
                                                    src="{{ asset('/admin/media/svg/shapes/user-duble-orange.svg') }}" alt="filter-icon" />
                                                Issue Contract</button></td>`;
                                        } else if (["8", "12"].includes(requestData.tab) &&
                                            column.id ==
                                            "employee") {

                                            if (requestData.tab == "8") {
                                                tbody += `<td id="${applicant.user.id}"><button class="d-flex convert-employee align-items-center ${applicant.status == 9 && applicant.contract != null ? 'btn-orange-outline btn-apply' : 'btn-grey-outline bg-white'}"
                                                data-username="${applicant.user.name}" jobApplicationId="${applicant.id}" data-userid="${applicant.user_id}" data-contractSignedCheck="${applicant.status == 9 && applicant.contract != null ? true : false}">
                                                <iconify-icon
                            icon="ix:cycle" width="16" height="16"></iconify-icon> Convert to Employee</button></td>`;
                                                

                                            }




                                            if ([8, 9, 12].includes(applicant.status) &&
                                                applicant.contract != null) {
                                                tbody += `<td id="${applicant.user.id}" class=""><a href="${applicant.contract.contract_pdf_url}" target="_blank" class="d-flex align-items-center btn-grey-outline bg-white">
                                                    View Contract</a></td>`;
                                            } else {
                                                tbody +=
                                                    `<td id="${applicant.user.id}" class="">N/A</td>`;
                                            }


                                        }

                                        try {
                                            document.getElementById(
                                                    'offerLetterapplication_id').value =
                                                applicant.id;
                                        } catch (e) {
                                            console.log(e); // Logs the error
                                        }

                                    });




                                    tbody += "</tr>";
                                });
                                var numCandidates = response.appliedUsers.total;
                                $('#candidate-count').text(`${numCandidates} candidates found`);
                                $("#employeeTable tbody").html(tbody);

                                updateSelectAllCheckbox();
                                restoreSelectedRows(response);
                            } else {
                                $("#employeeTable tbody").html(
                                    '<tr><td colspan="13" class="text-center">No data available</td></tr>'
                                );
                            }

                            // Pagination Links
                            var paginationLinks = '';
                            $.each(response.appliedUsers.links, function(index, link) {
                                paginationLinks += `
                                <li class="page-item ${link.active ? 'active' : ''}">
                                    <a class="page-link" href="${link.url || '#'}">${link.label}</a>
                                </li>
                            `;
                            });
                            $("#pagination-links").html(paginationLinks);
                            hideOverlay();
                        }
                    });
                }

                loadEmployees(1, false, [], getSelectedFilters());

                // Update selected rows when individual checkboxes are checked/unchecked
                $('#employeeTable').on('change', '.select-row', function() {
                    let rowId = $(this).data('id');
                    if ($(this).prop('checked')) {
                        selectedRows.push(rowId); // Add ID to the selectedRows array
                    } else {
                        selectedRows = selectedRows.filter(id => id !==
                            rowId); // Remove ID from the selectedRows array
                    }

                    // Update the "Select All" checkbox
                    updateSelectAllCheckbox();
                    updateSelectedCount();
                });

                
                $(document).on('click', '.convert-employee', function(e) {
                    e.preventDefault();
                    
                    // Get data attributes
                    const userName = $(this).data('username');
                    const userId = $(this).data('userid');
                    const jobApplicationId = $(this).attr('jobApplicationId');
                    const jobId = "{{ $jobOpening->job_id }}";
                    

                    const contractSignedCheck = $(this).data('contractsignedcheck');
                    console.log(contractSignedCheck,"===========");
                    
                    const buttonElement = $(this);
                    
                    // Check if button is disabled (grey outline)
                    if (contractSignedCheck == false) {
                        alert('This applicant cannot be converted to employee yet.');
                        return;
                    }
                    if (contractSignedCheck == true) {
                        convertToEmployee(userName, userId, buttonElement,jobId,jobApplicationId);
                    }
                    
                });

                function convertToEmployee(userName, userId, buttonElement, jobId,jobApplicationId) {

                    // Disable button during processing
                    

                    ModalManager.open({
                        module: 'talent_acquisition',
                        key: "convert_to_employee",
                        data: {
                            title: userName
                        },
                        onSubmit(modalEl1) {
                            // Validate form before submission
                            if (validateConvertEmployeeForm()) {
                                const formData = getFormData(userId,jobApplicationId);
                                
                                // Show loading state
                                const submitBtn = $(modalEl1).find('[data-modal-submit]');
                                const originalText = submitBtn.text();
                                submitBtn.prop('disabled', true).text('Converting...');

                                // AJAX call to convert employee
                                fetch('/admin/ajax/convert-employee', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify(formData)
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        return response.json().then(err => Promise.reject(err));
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    if (data.success) {
                                        // Close modal
                                        const bsModal = bootstrap.Modal.getInstance(modalEl1);
                                        bsModal.hide();


                                        if (data.conversionSingle == 1) {
                                             ModalManager.open({
                                                module: 'talent_acquisition',
                                                key: "convert_to_employee_success",
                                                data: {
                                                    title: userName
                                                },
                                                onSubmit(modalEl1) {
                                                    const bsModal = bootstrap.Modal.getInstance(modalEl1);
                                                        bsModal.hide();
                                                       location.reload();

                                                },
                                            });
                                        }else if(data.conversionSingle == 2){

                                            ModalManager.open({
                                                module: 'talent_acquisition',
                                                key: "convert_to_employee_success_application_filled",
                                                data: {
                                                    title: userName
                                                },
                                                onSubmit(modalEl1) {
                                                    const bsModal = bootstrap.Modal.getInstance(modalEl1);
                                                        bsModal.hide();
                                                        location.reload();
                                                },
                                            });

                                        }

                                        
                                        
                                        // Show success message
                                        showNotification('success', data.message || `${userName} has been converted to employee successfully!`);
                                        
                                        // Reset original button
                                        buttonElement.prop('disabled', false).html('<iconify-icon icon="ix:cycle" width="16" height="16"></iconify-icon> Convert to Employee');
                                        
                                        // Optional: Update UI to reflect employee status
                                        updateEmployeeStatus(userId, 'employee');
                                        
                                    } else {
                                        throw new Error(data.message || 'Conversion failed');
                                    }
                                })
                                .catch(error => {
                                    console.error('Conversion error:', error);
                                    
                                    let errorMessage = 'An error occurred during conversion.';

                                    if (error?.errors) {
                                        // Validation errors
                                        let messages = [];

                                        Object.entries(error.errors).forEach(([field, errors]) => {
                                            if (Array.isArray(errors)) {
                                                errors.forEach(err => messages.push(`${field}: ${err}`));
                                            }
                                        });

                                        errorMessage = messages.join('\n') || 'Please check the form for errors.';
                                        displayValidationErrors(error.errors); // Your existing UI handler
                                    }
                                    else if (error?.message) {
                                        errorMessage = error.message;
                                    }
                                    
                                    // showNotification('error', errorMessage);
                                })
                                .finally(() => {
                                    // Restore submit button state
                                    submitBtn.prop('disabled', false).text(originalText);
                                });
                            }
                        },
                        onShown(modalEl) {
                            // Load headcount options when modal is shown
                            loadHeadcountOptions(jobId);
                            
                            // Attach form validation
                            attachFormValidation();
                        }
                    });
                }

                // Helper function to get form data
                function getFormData(userId,jobApplicationId) {
                    return {
                        user_id: parseInt(userId),
                        employee_id: $('#modalEmployeeId').val().trim(),
                        headcount_id: parseInt($('#modalHeadcountId').val()),
                        application_id: jobApplicationId,
                    };
                }

                 function showFieldErrorTest(fieldId, errorId, message) {
        $(`#${fieldId}`).addClass('is-invalid');
        $(`#${errorId}`).text(message).addClass('show');
    }

                // Helper function to display validation errors
                // Keep this small helper around
                function showFieldError(inputSel, errorSel, message) {
                const $input = $(inputSel);
                const $error = $(errorSel);

                $input.addClass('is-invalid');
                $error.text(message).addClass('show');
                }

                function clearFieldErrors($scope) {
                $scope.find('.form-control').removeClass('is-invalid');
                $scope.find('.invalid-feedback').removeClass('show').text('');
                }

                // Call this with the Laravel 422 errors object
                function displayValidationErrors(errors) {
                const $modal = $('.convert-employee-modal'); // scope to the modal only
                clearFieldErrors($modal);

                // Map backend field names → input + error elements
                const fieldMap = {
                    employee_id: { input: '#modalEmployeeId',   error: '#employeeIdError'   },
                    headcount_id:{ input: '#modalHeadcountId',  error: '#headcountIdError'  },
                    user_id:     { input: '#modalEmployeeId',   error: '#employeeIdError'   }, // fallback
                };

                // Show each field's first error (you can join if you prefer)
                Object.entries(errors).forEach(([field, msgs]) => {
                    const map = fieldMap[field];
                    const message = Array.isArray(msgs) ? msgs[0] : String(msgs);

                    if (map) {
                    showFieldError(map.input, map.error, message);
                    } else {
                    // Unknown field key from backend → show a generic notice at top if you have one
                    // $('#generalFormError').text(message).addClass('show'); // optional
                    console.warn('Unmapped validation field:', field, message);
                    }
                });
                }


                // Helper function to update UI after successful conversion
                function updateEmployeeStatus(userId, status) {
                    // Update any UI elements that show user status
                    $(`.user-row-${userId}`).removeClass('candidate-status').addClass('employee-status');
                    $(`.convert-employee[data-userid="${userId}"]`).remove();
                    
                    // You can add more UI updates here based on your needs
                }

                // Dummy JSON data for headcounts
                // Replace the loadHeadcountOptions function in your Blade file
                function loadHeadcountOptions() {
                    const dropdown = $('#modalHeadcountId');
                    
                    // Show loading state
                    dropdown.addClass('loading-dropdown').prop('disabled', true);
                    dropdown.html('<option value="">Loading headcounts...</option>');
                    
                    // Get job_id from your context (you'll need to pass this)
                    const jobId = getJobIdFromContext(); // Implement this based on your needs
                    
                    // Make AJAX call to get vacant headcounts
                    fetch(`/admin/ajax/vacant-job-headcounts/?job_id=${jobId}`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Clear existing options
                        dropdown.html('<option value="">Select Headcount ID</option>');
                        
                        if (data.success && data.data.length > 0) {
                            data.data.forEach(headcount => {
                                dropdown.append(`<option value="${headcount.id}">${headcount.display_text}</option>`);
                            });
                        } else {
                            dropdown.append('<option value="">No vacant positions available</option>');
                        }
                        
                        // Remove loading state
                        dropdown.removeClass('loading-dropdown').prop('disabled', false);
                    })
                    .catch(error => {
                        console.error('Error loading headcounts:', error);
                        dropdown.html('<option value="">Error loading headcounts</option>');
                        dropdown.removeClass('loading-dropdown').prop('disabled', false);
                    });
                }

                function getJobIdFromContext() {
                    // You'll need to implement this based on how you pass job_id to the modal
                    // Options:
                    // 1. From button data attribute
                    // 2. From global variable
                    // 3. From URL parameter
                    // Example:
                    return "{{ $jobOpening->job_id }}";
                }

                function validateConvertEmployeeForm() {
                    let isValid = true;
                    
                    // Reset previous validation states
                    $('.form-control').removeClass('is-invalid');
                    $('.invalid-feedback').removeClass('show');
                    
                    // Validate Employee ID
                    const employeeId = $('#modalEmployeeId').val().trim();
                    if (!employeeId) {
                        showFieldErrorTest('modalEmployeeId', 'employeeIdError', 'Employee ID is required');
                        isValid = false;
                    }
                    
                    // Validate Headcount ID
                    const headcountId = $('#modalHeadcountId').val();
                    if (!headcountId) {
                        showFieldErrorTest('modalHeadcountId', 'headcountIdError', 'Please select a Headcount ID');
                        isValid = false;
                    }
                    
                    return isValid;
                }

                // function showFieldError(fieldId, errorId, message) {
                //     $(`#${fieldId}`).addClass('is-invalid');
                //     $(`#${errorId}`).text(message).addClass('show');
                // }

                function attachFormValidation() {
                    // Real-time validation
                    $('#modalEmployeeId').on('input', function() {
                        const value = $(this).val().trim();
                        
                        if ($(this).val()) {
                            $(this).removeClass('is-invalid');
                            $('#employeeIdError').removeClass('show');
                        }
                    });
                    
                    $('#modalHeadcountId').on('change', function() {
                        if ($(this).val()) {
                            $(this).removeClass('is-invalid');
                            $('#headcountIdError').removeClass('show');
                        }
                    });
                }

                // Notification helper function
                function showNotification(type, message) {
                    // You can customize this based on your notification system
                    if (typeof toastr !== 'undefined') {
                        toastr[type](message);
                    } else if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: type,
                            title: type === 'success' ? 'Success!' : 'Error!',
                            text: message
                        });
                    } else {
                        alert(message);
                    }
                }

                // Global function to be called from button cli


                $(document).on('change', '#select-all', function() {

                    // Get the status of the "Select All" checkbox
                    let isChecked = $(this).prop('checked');

                    // Select or deselect all checkboxes on the current page
                    $('#employeeTable .select-row').each(function() {
                        $(this).prop('checked', isChecked);
                        let rowId = $(this).data('id');

                        // Update the selectedRows array accordingly
                        if (isChecked && !selectedRows.includes(rowId)) {
                            selectedRows.push(rowId); // Add to selectedRows if checked
                        } else if (!isChecked && selectedRows.includes(rowId)) {
                            selectedRows = selectedRows.filter(id => id !==
                                rowId); // Remove from selectedRows if unchecked
                        }
                    });

                    // Update "Select All" checkbox based on selected rows
                    updateSelectAllCheckbox();
                    updateSelectedCount();
                });

                // Update "Select All" checkbox based on selected rows on the current page
                function updateSelectAllCheckbox() {
                    let totalRows = $('#employeeTable .select-row').length;
                    let checkedRows = $('#employeeTable .select-row:checked').length;

                    // If all rows on the current page are selected, check the "Select All" checkbox
                    $('#select-all').prop('checked', totalRows === checkedRows);
                }

                // Function to restore selected rows based on saved row IDs
                function restoreSelectedRows(response) {
                    response.appliedUsers.data.forEach(function(applicant) {
                        if (selectedRows.includes(applicant.id)) {
                            // Check the checkbox for rows that were previously selected
                            $(`#employeeTable .select-row[data-id="${applicant.id}"]`).prop('checked', true);
                        }
                    });
                }

                // Button to show only selected data
                $('#show-selected').on('click', function() {
                    showAll = true;
                    // Make AJAX call to load only selected data
                    loadEmployees(1, showAll, selectedRows,
                        getSelectedFilters()); // Pass `showAll = true` to load only selected rows
                });

                // Button to show all data (reset the selections and show all rows)
                $('#show-all').on('click', function() {
                    showAll = false;
                    // Make AJAX call to load all data
                    loadEmployees(1, showAll, [],
                        getSelectedFilters()); // Pass `showAll = false` to load all rows
                });

                $('#clear-comparison').on('click', function() {
                    showAll = false;
                    // Make AJAX call to load all data
                    resetFilters();
                    loadEmployees(1, showAll, [],
                        getSelectedFilters()); // Pass `showAll = false` to load all rows
                });

                function updateSelectedCount() {
                    $('#selected-count').text(`${selectedRows.length} selected`);
                }

                // Handle pagination click
                $(document).on('click', '#pagination-links a', function(e) {
                    e.preventDefault();
                    var page = $(this).attr('href').split('page=')[1];
                    loadEmployees(page, showAll, selectedRows, getSelectedFilters());
                });

                function resetFilters() {
                    requestData.selectedUsers = [];
                    requestData.showAll = false;
                    selectedRows = [];
                    // Uncheck all checkboxes on the current page
                    $('#employeeTable .select-row').prop('checked', false);
                    // Uncheck the "Select All" checkbox
                    $('#select-all').prop('checked', false);
                    // Update the selected count and "Select All" checkbox
                    updateSelectedCount();
                    updateSelectAllCheckbox();
                    $('span.filterCount').each(function() {
                        $(this).text('(' + $(".filter-checkbox:checked").length + ')');
                    });
                }


                //Tabs Filters
                // Update requestData based on the tab clicked
                $('#applied-tab').on('click', function() {
                    resetFilters();
                    requestData.tab = '1'; // Update filter to 'Applied'
                    $(".filter-checkbox").prop("checked", false);
                    $("#selectedFiltersContainer").empty();
                    loadEmployees();
                    loadFilters();



                });

                $('#withdraw-tab').on('click', function() {
                    resetFilters();
                    requestData.tab = '0'; // Update filter to 'Withdraw'
                    $(".filter-checkbox").prop("checked", false);
                    $("#selectedFiltersContainer").empty();
                    loadEmployees();
                    loadFilters();



                });

                $('#rejected-tab').on('click', function() {
                    resetFilters();
                    requestData.tab = '2'; // Update filter to 'Rejected'
                    $(".filter-checkbox").prop("checked", false);
                    $("#selectedFiltersContainer").empty();
                    loadEmployees();
                    loadFilters();
                });

                $('#hiring-applied-tab').on('click', function() {
                    resetFilters();
                    requestData.tab = '1'; // Update filter to 'Rejected'
                    $(".filter-checkbox").prop("checked", false);
                    $("#selectedFiltersContainer").empty();
                    requestData.selection_m = null;
                    $('.grid-item').each(function() {
                        $(this).removeClass('selected').find('.checkmark').remove();
                    });
                    loadEmployees();
                    loadFilters();
                });

                $('#hiring-assessment-tab').on('click', function() {
                    $('#assessment-pending-tab').trigger('click');
                    // resetFilters();
                    // requestData.tab = '3'; // Update filter to 'Rejected'
                    // $(".filter-checkbox").prop("checked", false);
                    // $("#selectedFiltersContainer").empty();
                    // requestData.selection_m = null;
                    // $('.grid-item').each(function () {
                    //     $(this).removeClass('selected').find('.checkmark').remove();
                    // });

                    // loadEmployees();
                    // loadFilters();
                });

                $('#assessment-pending-tab').on('click', function() {
                    resetFilters();
                    requestData.tab = '3'; // Update filter to 'Rejected'
                    $(".filter-checkbox").prop("checked", false);
                    $("#selectedFiltersContainer").empty();
                    requestData.selection_m = null;
                    $('.grid-item').each(function() {
                        $(this).removeClass('selected').find('.checkmark').remove();
                    });

                    loadEmployees();
                    loadFilters();
                });

                $('#assessment-completed-tab').on('click', function() {
                    resetFilters();
                    requestData.tab = '4'; // Update filter to 'Rejected'
                    $(".filter-checkbox").prop("checked", false);
                    $("#selectedFiltersContainer").empty();
                    requestData.selection_m = null;
                    $('.grid-item').each(function() {
                        $(this).removeClass('selected').find('.checkmark').remove();
                    });

                    loadEmployees();
                    loadFilters();
                });

                $('#hiring-shortlisted-tab').on('click', function() {
                    resetFilters();
                    requestData.tab = '5'; // Update filter to 'Rejected'
                    $(".filter-checkbox").prop("checked", false);
                    $("#selectedFiltersContainer").empty();
                    requestData.selection_m = null;
                    $('.grid-item').each(function() {
                        $(this).removeClass('selected').find('.checkmark').remove();
                    });

                    loadEmployees();
                    loadFilters();
                });

                $('#hiring-screening-interview-tab').on('click', function() {
                    $('#hiring-interview-scheduled-tab').trigger('click');
                    // resetFilters();
                    // requestData.tab = '6'; // Update filter to 'Rejected'
                    // $(".filter-checkbox").prop("checked", false);
                    // $("#selectedFiltersContainer").empty();
                    // requestData.selection_m = null;
                    // $('.grid-item').each(function () {
                    //     $(this).removeClass('selected').find('.checkmark').remove();
                    // });

                    // loadEmployees();
                    // loadFilters();
                });

                $('#hiring-interview-scheduled-tab').on('click', function() {
                    resetFilters();
                    requestData.tab = '6'; // Update filter to 'Rejected'
                    $(".filter-checkbox").prop("checked", false);
                    $("#selectedFiltersContainer").empty();
                    requestData.selection_m = null;
                    $('.grid-item').each(function() {
                        $(this).removeClass('selected').find('.checkmark').remove();
                    });

                    loadEmployees();
                    loadFilters();
                });

                $('#hiring-interview-conducted-tab').on('click', function() {
                    resetFilters();
                    requestData.tab = '7'; // Update filter to 'Rejected'
                    $(".filter-checkbox").prop("checked", false);
                    $("#selectedFiltersContainer").empty();
                    requestData.selection_m = null;
                    $('.grid-item').each(function() {
                        $(this).removeClass('selected').find('.checkmark').remove();
                    });

                    loadEmployees();
                    loadFilters();
                });

                $('#hiring-offer-stage-tab').on('click', function() {
                    resetFilters();
                    requestData.tab = '8'; // Update filter to 'Rejected'
                    $(".filter-checkbox").prop("checked", false);
                    $("#selectedFiltersContainer").empty();
                    requestData.selection_m = null;
                    $('.grid-item').each(function() {
                        $(this).removeClass('selected').find('.checkmark').remove();
                    });
                    loadEmployees();
                    loadFilters();
                });

                $('#hiring-hired-stage-tab').on('click', function() {
                    resetFilters();
                    requestData.tab = '12'; // Update filter to 'Rejected'
                    $(".filter-checkbox").prop("checked", false);
                    $("#selectedFiltersContainer").empty();
                    requestData.selection_m = null;
                    $('.grid-item').each(function() {
                        $(this).removeClass('selected').find('.checkmark').remove();
                    });
                    loadEmployees();
                    loadFilters();
                });

                const yesConvertModal = document.getElementById('yes-convert-to-employee');

                if (yesConvertModal) {
                    yesConvertModal.addEventListener('hidden.bs.modal', function() {
                        // Reload the page when modal is fully hidden
                        resetFilters();
                        requestData.tab = '8'; // Update filter to 'Rejected'
                        $(".filter-checkbox").prop("checked", false);
                        $("#selectedFiltersContainer").empty();
                        requestData.selection_m = null;
                        $('.grid-item').each(function() {
                            $(this).removeClass('selected').find('.checkmark').remove();
                        });
                        loadEmployees();
                        loadFilters();
                    });
                }

                const employeeStatusModal = document.getElementById('employee-status-changed');

                if (employeeStatusModal) {
                    employeeStatusModal.addEventListener('hidden.bs.modal', function() {
                        // Reload the page when modal is fully hidden
                        resetFilters();
                        requestData.tab = '8'; // Update filter to 'Rejected'
                        $(".filter-checkbox").prop("checked", false);
                        $("#selectedFiltersContainer").empty();
                        requestData.selection_m = null;
                        $('.grid-item').each(function() {
                            $(this).removeClass('selected').find('.checkmark').remove();
                        });
                        loadEmployees();
                        loadFilters();
                    });
                }






                $('#confirmReject').on('click', function() {
                    if (selectedRows.length == 0) {
                        toastr.error('Please Select At least 1 Applicant');
                    } else {
                        $.ajax({
                            url: '{{ route('admin.talent-acquisition.job-advertisement.rejectApplicants') }}',
                            type: 'POST',
                            data: {
                                selectedRows: selectedRows
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                $('#modal-reject').modal('hide');
                                resetFilters();
                                loadEmployees();
                                toastr.success(response.message);

                            },
                            error: function(xhr) {
                                toastr.error('Error bookmarking user: ' + xhr.statusText);
                            }
                        });
                    }
                });

                $('#confirmSend').on('click', function() {
                    if (selectedRows.length == 0) {
                        toastr.error('Please Select At least 1 Applicant');
                    } else {
                        $.ajax({
                            url: '{{ route('admin.talent-acquisition.job-advertisement.sendAssessmentLink') }}',
                            type: 'POST',
                            data: {
                                applicant_ids: selectedRows
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                $('#modal-send-assessment').modal('hide');
                                resetFilters();
                                loadEmployees();
                                toastr.success(response.message);

                            },
                            error: function(xhr) {
                                toastr.error('Error bookmarking user: ' + xhr.statusText);
                            }
                        });
                    }
                });

                function updateTabCounts(statusCounts) {
                    // Define which statuses belong to which tab
                    const tabStatusMapping = {
                        "hiring-applied-tab": ["Applied"],
                        "hiring-assessment-tab": ["Assessment Pending", "Assessment Completed"],
                        "hiring-shortlisted-tab": ["Shortlisted"],
                        "hiring-screening-interview-tab": ["Interview Scheduled", "Interview Completed"],
                        "hiring-offer-stage-tab": ["Offered", "Offer Accepted", "Offer Declined", "Offer Expired"],
                        "hiring-hired-stage-tab": ["Hired"],
                        // Add other tabs if needed
                    };


                    for (const [tabId, statuses] of Object.entries(tabStatusMapping)) {
                        console.log(tabId, statuses);

                        let total = 0;
                        statuses.forEach(status => {
                            total += statusCounts[status] || 0;
                        });

                        const tabButton = document.getElementById(tabId);
                        if (tabButton) {
                            const countSpan = tabButton.querySelector(".applicants-number");
                            if (countSpan) {
                                countSpan.textContent = total;
                            }
                        }
                    }
                }



                // $(document).on('click', '#rejectCandidateBtn', function() {
                //     if (selectedRows.length == 0) {
                //         toastr.error('Please Select At least 1 Applicant');
                //     } else {
                //         $("#rejectCount").text(selectedRows.length); // Update the number in modal
                //         $('#modal-reject').modal('show'); // Open modal
                //     }
                // });

                // $(document).on('click', '#rejectCandidateBtnHPApplied', function() {
                //     if (selectedRows.length == 0) {
                //         toastr.error('Please Select At least 1 Applicant');
                //     } else {
                //         $("#rejectCount").text(selectedRows.length); // Update the number in modal
                //         $('#modal-reject').modal('show'); // Open modal
                //     }
                // });

                $(document).on('click', '.btn-reject-candidate', function() {
                    if (selectedRows.length == 0) {
                        toastr.error('Please Select At least 1 Applicant');
                    } else {
                        $("#rejectCount").text(selectedRows.length); // Update the number in modal
                        $('#modal-reject').modal('show'); // Open modal
                    }
                });

                $(document).on('click', '.btn-shortlist-candidate', function() {
                    if (selectedRows.length == 0) {
                        toastr.error('Please Select At least 1 Applicant');
                    } else {
                        $.ajax({
                            url: '{{ route('admin.talent-acquisition.job-advertisement.applicationChangeShortlisted') }}',
                            type: 'POST',
                            data: {
                                applicant_ids: selectedRows,
                                status: 5
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                resetFilters();
                                loadEmployees();
                                toastr.success(response.message);

                            },
                            error: function(xhr) {
                                toastr.error('Error bookmarking user: ' + xhr.statusText);
                            }
                        });
                    }
                });



                $(document).on('click', '#sendAssessmentLink', function() {
                    if (selectedRows.length == 0) {
                        toastr.error('Please Select At least 1 Applicant');
                    } else {
                        $("#sendCount").text(selectedRows.length); // Update the number in modal
                        $('#modal-send-assessment').modal('show'); // Open modal
                    }
                });

                $(document).on('change', '#rowsPerPage', function() {
                    resetFilters();
                    requestData.perPage = this.value
                    loadEmployees();
                });

                function fetchSortedData(sortBy, sortDirection) {
                    console.log(sortBy, sortDirection);

                    requestData.sortBy = sortBy
                    requestData.sortDirection = sortDirection
                    loadEmployees(1, false, [], getSelectedFilters());
                }

                $(document).on('click', '.sortable', function() {
                    let column = $(this).attr("id");
                    let currentSort = $(this).data("sort");
                    let newSort = $(this).attr("currentDirection");
                    // Call function to fetch sorted data
                    fetchSortedData(column, newSort);
                });

                let debounceTimer;

                function handleSearch(event) {
                    const query = event.target.value.trim();
                    console.log("Searching for:", query);
                    requestData.applicantTitle = query;
                    loadEmployees(1, false, [], getSelectedFilters());

                }

                document.getElementById('searchInput').addEventListener('input', function(event) {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => {
                        handleSearch(event);
                    }, 500); // Adjust delay as needed (500ms in this case)
                });

                try {
                    document.getElementById('searchInputAssessmentOverview').addEventListener('input', function(event) {
                        clearTimeout(debounceTimer);
                        debounceTimer = setTimeout(() => {
                            handleSearch(event);
                        }, 500); // Adjust delay as needed (500ms in this case)
                    });



                    document.getElementById('searchInputShortlisted').addEventListener('input', function(event) {
                        clearTimeout(debounceTimer);
                        debounceTimer = setTimeout(() => {
                            handleSearch(event);
                        }, 500); // Adjust delay as needed (500ms in this case)
                    });

                    document.getElementById('searchInputInterviewScreening').addEventListener('input', function(event) {
                        clearTimeout(debounceTimer);
                        debounceTimer = setTimeout(() => {
                            handleSearch(event);
                        }, 500); // Adjust delay as needed (500ms in this case)
                    });

                    document.getElementById('searchInputOfferStage').addEventListener('input', function(event) {
                        clearTimeout(debounceTimer);
                        debounceTimer = setTimeout(() => {
                            handleSearch(event);
                        }, 500); // Adjust delay as needed (500ms in this case)
                    });
                } catch (error) {

                }


                $(document).on('click', '.dropdown-toggle-btn', function(e) {
                    e.stopPropagation();
                    console.log("Dropdown clicked");

                    const dropdownId = $(this).data('dropdown-id');
                    $('.dropdown-menu-custom').not(`#${dropdownId}`).hide();
                    $(`#${dropdownId}`).toggle();
                });

                $(document).on('click', function() {
                    $('.dropdown-menu-custom').hide();
                });

                $(document).on('click', 'li[applicantid][applicantname]', function() {
                    const name = $(this).attr('applicantname');
                    const id = $(this).attr('applicantid');
                    const action = $(this).text().trim();

                    if (action === "Reject Applicant") {
                        // Update the modal text
                        $('#modal-reject-applicant-single .modal-body h4').html(
                            `Are you sure you want to reject<br>${name}?`);

                        // You can also store the ID somewhere if needed
                        $('#modal-reject-applicant-single').data('applicant-id', id);

                        // $('#modal-reject-applicant-single-value').value(id);

                        // Then open the modal manually (if not using Bootstrap auto toggle)
                        const modal = new bootstrap.Modal(document.getElementById(
                            'modal-reject-applicant-single'));
                        modal.show();
                    }

                    if (action === "Send Email") {
                        // Optional: Handle email logic here

                        $('#singleApplicantName').text(name);

                        // Store applicant ID for sending later
                        $('#modal-send-assessment-single').data('applicant-id', id);

                        // Show the modal
                        const modal = new bootstrap.Modal(document.getElementById(
                            'modal-send-assessment-single'));
                        modal.show();

                    }

                    if (action === "View Applicant Details") {
                        // Optional: Redirect or show profile

                        const jobId = $(this).attr('data-jobid');
                        const applicantId = $(this).attr('data-applicantid');

                        if (jobId && applicantId) {
                            let route =
                                "{{ route('admin.talent-acquisition.job-advertisement.detail.applicant-details', ['id' => ':id', 'applicant_id' => ':applicant_id']) }}";
                            const url = route.replace(':id', jobId).replace(':applicant_id', applicantId);
                            window.location.href = url;
                        }
                    }

                    if (action == "Reschedule Interview") {
                        document.getElementById('rescheduleInterviewLink').value = '';
                        // Open the modal manually if not already set via data-bs-toggle
                        const modal = new bootstrap.Modal(document.getElementById('reschedule-interview'));
                        modal.show();

                        // Extract values from li
                        const id = $(this).attr('applicantId');
                        const name = $(this).attr('applicantName');
                        const date = $(this).attr('applicantInterviewDate');
                        const startTime = $(this).attr('applicantInterviewStartTime'); // "14:15:00"
                        const endTime = $(this).attr('applicantInterviewEndTime');
                        const link = $(this).attr('applicantInterviewLink');
                        const mode = $(this).attr('applicantInterviewMode');
                        const interviewerName = $(this).attr('applicantInterviewName');
                        const desc = $(this).attr('applicantInterviewDesc');

                        // Set name in modal title
                        document.querySelector('#reschedule-interview .modal-title').innerHTML =
                            `Reschedule Interview for ${name}`;

                        // if (date) {
                        //     const d = new Date(date);
                            // const formatted = d.toISOString().split('T')[0]; // "YYYY-MM-DD"
                        if (date && typeof date === "string" && date.trim() !== "") {
                        const d = new Date(date);

                        if (d instanceof Date && !isNaN(d)) {
                            const formatted = d.toISOString().split('T')[0];
                            console.log(formatted);
                            document.getElementById('rescheduleDate').value = formatted;
                        } else {
                            console.error("Invalid Date after parsing:", d);
                        }
                        } else {
                        console.error("Date input is missing or invalid:", date);
                        }



                        // Parse and set start time
                        if (startTime) {
                            const [startHour24, startMinute] = startTime.split(':');
                            let hour = parseInt(startHour24);
                            const ampm = hour >= 12 ? 'PM' : 'AM';
                            hour = hour % 12 || 12;

                            document.getElementById('startHour').value = hour;
                            document.getElementById('startMinute').value = parseInt(startMinute);
                            document.getElementById('startAmPm').value = ampm;
                        }

                        // Parse and set end time
                        if (endTime) {
                            const [endHour24, endMinute] = endTime.split(':');
                            let hour = parseInt(endHour24);
                            const ampm = hour >= 12 ? 'PM' : 'AM';
                            hour = hour % 12 || 12;

                            document.getElementById('endHour').value = hour;
                            document.getElementById('endMinute').value = parseInt(endMinute);
                            document.getElementById('endAmPm').value = ampm;
                        }

                        // Interviewer name (you can split if using tags)
                        // Clear existing tags
                        const tagContainer = document.getElementById('tagContainer');
                        tagContainer.querySelectorAll('.tag').forEach(tag => tag.remove());

                        if (interviewerName) {
                            interviewerName.split(',').forEach(name => {
                                const tag = document.createElement('div');
                                tag.classList.add('tag');
                                tag.innerHTML =
                                    `${name.trim()} <button class="remove-tag" onclick="removeTag(this)">&times;</button>`;
                                tagContainer.insertBefore(tag, document.getElementById('tagInput'));
                            });
                        }

                        // Interview type
                        if (mode) {

                            var interviewModes = {
                                'Virtual': '2',
                                'In-Person': '1',
                                'Phone': '3'
                            };


                            document.querySelectorAll('input[name="interview_mode"]').forEach(radio => {
                                radio.checked = radio.value === mode;
                            });

                            // Show/hide interview link
                            if (mode === '2') {
                                document.getElementById('interviewerLinkReschedule').style.display = 'block';
                                document.getElementById('rescheduleInterviewLink').value = link || '';
                            } else {
                                document.getElementById('interviewerLinkReschedule').style.display = 'none';
                            }
                        }

                        document.getElementById('re_application_id').value = id;

                        // const tags = Array.from(document.querySelectorAll('#tagContainer .tag')).map(tag => {
                        //     return tag.childNodes[0].textContent.trim(); // tag text is first child
                        // });

                        // console.log("============================",tags);


                        // // Join with comma or JSON, your choice
                        // document.getElementById('tagInput').value = tags.join(', ');

                        const form = document.getElementById('reschedule-form');
                        form.action = "{{ route('admin.job-opening.applicant-interview-schedule') }}";
                    }
                });

                document.getElementById('reschedule-form').addEventListener('submit', function(e) {
                    // Gather all tag texts
                    const tags = Array.from(document.querySelectorAll('#tagContainer .tag')).map(tag => {
                        return tag.childNodes[0].textContent.trim(); // tag text is first child
                    });

                    // Join with comma or JSON, your choice
                    document.getElementById('tagInput').value = tags.join(', ');
                });

                $('#modal-reject-applicant-single .btn-apply').off('click').on('click', function() {
                    const applicantId = $('#modal-reject-applicant-single').data('applicant-id');

                    if (!applicantId) {
                        toastr.error('Please Select At least 1 Applicant');
                    } else {
                        $.ajax({
                            url: '{{ route('admin.talent-acquisition.job-advertisement.rejectApplicants') }}',
                            type: 'POST',
                            data: {
                                selectedRows: [applicantId]
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                $('#modal-reject-applicant-single').modal('hide');
                                resetFilters();
                                loadEmployees();
                                toastr.success(response.message);
                            },
                            error: function(xhr) {
                                toastr.error('Error bookmarking user: ' + xhr.statusText);
                            }
                        });
                    }
                });

                $('#confirmSingleSend').on('click', function() {
                    const applicantId = $('#modal-send-assessment-single').data('applicant-id');


                    if (!applicantId) {
                        toastr.error('Please Select At least 1 Applicant');
                    } else {
                        $.ajax({
                            url: '{{ route('admin.talent-acquisition.job-advertisement.sendAssessmentLink') }}',
                            type: 'POST',
                            data: {
                                applicant_ids: [applicantId]
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                $('#modal-send-assessment-single').modal('hide');
                                resetFilters();
                                loadEmployees();
                                toastr.success(response.message);

                            },
                            error: function(xhr) {
                                toastr.error('Error bookmarking user: ' + xhr.statusText);
                            }
                        });
                    }
                });


                const selectionMatrix = @json(config('helpers.selection_matrix'));
                const levelLabels = @json(config('helpers.selection_matrix_levels'));

                // document.querySelector('.btn-apply-selectmatrix').addEventListener('click', function () {
                //     const selectedItem = document.querySelector('.grid-item.selected');

                //     if (!selectedItem) {
                //         alert('Please select a matrix cell.');
                //         return;
                //     }

                //     const id = selectedItem.dataset.id;
                //     const config = selectionMatrix[id];

                //     if (config) {
                //         const level = config.final_result_level;
                //         const label = levelLabels[level] ?? 'Unknown';
                //         console.log(id);

                //         requestData.selection_m = id;
                //         loadEmployees(1, false, [], getSelectedFilters());

                //         $('#selection-matrix').modal('hide');
                //         toastr.success(`Selection Matrix updated to ${label}`);

                //     } else {
                //         console.log('No config found for selected ID:', id);
                //         alert('Invalid selection.');
                //     }
                // });

                document.querySelector('.btn-apply-selectmatrix').addEventListener('click', function() {
                    const selectedItems = document.querySelectorAll('.grid-item.selected');

                    if (selectedItems.length === 0) {
                        alert('Please select at least one matrix cell.');
                        return;
                    }

                    let validSelections = [];

                    selectedItems.forEach(selectedItem => {
                        const id = selectedItem.dataset.id;
                        const config = selectionMatrix[id];

                        if (config) {
                            const level = config.final_result_level;
                            const label = levelLabels[level] ?? 'Unknown';
                            console.log(`ID: ${id}, Level: ${level}, Label: ${label}`);

                            validSelections.push(id); // collect valid ids
                        } else {
                            console.log('No config found for selected ID:', id);
                        }
                    });

                    if (validSelections.length > 0) {
                        // If you want to handle multiple selections, modify `requestData` accordingly
                        requestData.selection_m = validSelections;

                        loadEmployees(1, false, [], getSelectedFilters());

                        $('#selection-matrix').modal('hide');
                        toastr.success(`Selection Matrix updated for ${validSelections.length} item(s).`);
                    } else {
                        alert('None of the selected items were valid.');
                    }
                });

                document.querySelector('.btn-clear-selectmatrix').addEventListener('click', function() {
                    resetFilters();
                    requestData.tab = '8'; // Update filter to 'Rejected'
                    $(".filter-checkbox").prop("checked", false);
                    $("#selectedFiltersContainer").empty();
                    requestData.selection_m = null;
                    $('.grid-item').each(function() {
                        $(this).removeClass('selected').find('.checkmark').remove();
                    });
                    loadEmployees();
                    loadFilters();
                    $('#selection-matrix').modal('hide');
                });


                function handleCompareButtonState() {
                    const selectedAppIds = requestData.selectedUsers;
                    const outsideCompareBtn = document.getElementById('scheduleButton');
                    const modalCompareBtn = document.getElementById('modalCompareBtn');
                    const reportType = document.getElementById('reportTypeSelect')?.value;

                    if (!outsideCompareBtn || !modalCompareBtn) return;

                    if (!selectedAppIds || selectedAppIds.length < 2) {
                        disableCompareButtons();
                        return;
                    }

                    // Make AJAX call to fetch user IDs and department IDs
                    $.ajax({
                        url: "{{ route('admin.talent-acquisition.job-advertisement.fetchUsersByApplicationIds') }}",
                        type: "POST",
                        data: {
                            application_ids: selectedAppIds
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.users && response.users.length >= 2) {
                                window.comparisonData = response.users;
                                enableCompareButtons(reportType);
                            } else {
                                disableCompareButtons();
                            }
                        },
                        error: function() {
                            disableCompareButtons();
                        }
                    });

                    function enableCompareButtons(reportType) {
                        outsideCompareBtn.classList.remove("disabled");
                        outsideCompareBtn.classList.add("btn-outline", "btn-apply");
                        outsideCompareBtn.style.backgroundColor = "#F7941C";
                        outsideCompareBtn.textContent = "Compare";

                        if (reportType) {
                            modalCompareBtn.disabled = false;
                            modalCompareBtn.classList.remove("disabled");
                            modalCompareBtn.classList.add("btn-outline", "btn-apply");
                        }
                    }

                    function disableCompareButtons() {
                        outsideCompareBtn.classList.remove("btn-outline", "btn-apply");
                        outsideCompareBtn.classList.add("disabled");
                        outsideCompareBtn.textContent = "Compare";

                        modalCompareBtn.disabled = true;
                        modalCompareBtn.classList.add("disabled");
                        modalCompareBtn.classList.remove("btn-outline", "btn-apply");
                    }
                }

                function updateActionButtons() {
                    const sendBtn = $('#sendAssessmentLink');

                    // All reject buttons
                    const rejectButtons = $('#rejectCandidateBtnHPApplied, .btn-reject-candidate, #rejectCandidateBtn');
                    const shortlistBtn = $('#assessmentCompletedButtons2');

                    if (selectedRows.length > 0) {
                        // Enable "Send" button
                        sendBtn.prop('disabled', false).removeClass('disabled').css({
                            backgroundColor: '#F7941C',
                            color: '#fff',
                            border: 'none'
                        });

                        // Enable all reject buttons
                        rejectButtons.prop('disabled', false).removeClass('disabled').css({
                            border: '1px solid #F04438',
                            backgroundColor: '#fff',
                            color: '#F04438'
                        });

                        shortlistBtn.prop('disabled', false).removeClass('disabled').css({
                            backgroundColor: '#F7941C',
                            color: '#fff',
                            border: 'none'
                        });

                    } else {
                        // Disable "Send" button
                        sendBtn.prop('disabled', true).addClass('disabled').css({
                            backgroundColor: '',
                            color: '',
                            border: ''
                        });

                        // Disable all reject buttons
                        rejectButtons.prop('disabled', true).addClass('disabled').css({
                            border: '',
                            backgroundColor: '',
                            color: ''
                        });

                        shortlistBtn.prop('disabled', true).addClass('disabled').css({
                            backgroundColor: '',
                            color: '',
                            border: ''
                        });
                    }
                }


                $(document).on('change', '.select-row, #select-all', function() {
                    selectedRows = [];

                    if ($(this).attr('id') === 'select-all') {
                        const isChecked = $(this).prop('checked');

                        $('.select-row').each(function() {
                            $(this).prop('checked', isChecked);

                            const rowId = $(this).data('id');
                            if (isChecked && !selectedRows.includes(rowId)) {
                                selectedRows.push(rowId);
                            }
                        });
                    } else {
                        $('.select-row:checked').each(function() {
                            const rowId = $(this).data('id');
                            selectedRows.push(rowId);
                        });
                    }

                    requestData.selectedUsers = selectedRows;
                    updateActionButtons();
                    handleCompareButtonState();
                });

                $(document).on('change', '#reportTypeSelect', function() {
                    handleCompareButtonState();
                });


                // $(document).on('click', '#modalCompareBtn', function () {
                //     if ($(this).hasClass('disabled')) return;

                //     const reportType = document.getElementById('reportTypeSelect').value;

                //     if (!reportType) {
                //         toastr.error("Please select a Report Type first.");
                //         return;
                //     }

                //     if (window.comparisonData && window.comparisonData.length >= 2) {
                //         const users = window.comparisonData.map(u => u.user_id).join(',');
                //         const departmentId = window.comparisonData[0].department_id;

                //         console.log("Department ID:", departmentId);
                //         console.log("Users:", users);
                //         console.log("Report Type:", reportType);

                //         const baseUrl = "{{ route('admin.advanced_comparison.report') }}";
                //         const url = `${baseUrl}?department_id=${departmentId}&report_type=${reportType}&pool_type=candidate-vs-candidate&users=${encodeURIComponent(users)}`;

                //         console.log("URL:", url);

                //         // ✅ Open the comparison in a new browser tab
                //         window.open(url, '_blank');
                //     } else {
                //         toastr.error("At least 2 users must be selected to compare.");
                //     }
                // });

                $(document).on('click', '#modalCompareBtn', function(e) {
                    e.preventDefault();

                    if ($(this).hasClass('disabled')) return;

                    const reportType = document.getElementById('reportTypeSelect').value;

                    if (!reportType) {
                        toastr.error("Please select a Report Type first.");
                        return;
                    }

                    if (window.comparisonData) {
                        const selectedCount = window.comparisonData.length;

                        if (selectedCount < 2) {
                            toastr.error("At least 2 users must be selected to compare.");
                            return;
                        }

                        if (selectedCount > 5) {
                            toastr.error("You can only compare a maximum of 5 users.");
                            return;
                        }

                        const users = window.comparisonData.map(u => u.user_id).join(',');
                        const departmentId = window.comparisonData[0].department_id;

                        const baseUrl = "{{ route('admin.advanced_comparison.report') }}";
                        const url =
                            `${baseUrl}?department_id=${departmentId}&report_type=${reportType}&pool_type=candidate-vs-candidate&users=${encodeURIComponent(users)}`;

                        console.log("✅ Opening Report URL:", url);

                        window.open(url, '_blank');
                    } else {
                        toastr.error("Please select at least 2 users to compare.");
                    }
                });


            });
        </script>

        <script>
            // Function to dynamically generate field setting checkboxes based on response columns
            function generateFieldSettings(columns) {
                let fieldSettingsHtml = '';

                columns.forEach(column => {
                    fieldSettingsHtml += `
                    <div class="form-check form-switch d-flex justify-content-between p-0 align-items-center">
                        <label class="form-check-label fw-bold" for="${column.id}">${column.label}</label>
                        <input class="form-check-input position-relative m-0 p-0 formCheckAllApplicant-inputs" type="checkbox" role="switch"
                            id="${column.id}" checked>
                    </div>
                    <div class="line-grey"></div>
                `;
                });

                // Inject the dynamically generated checkboxes into the form
                $('#fieldSettingsForm').html(fieldSettingsHtml);
            }

            // Update column visibility when checkboxes are toggled
            function updateColumnVisibility(columns) {
                columns.forEach(column => {
                    if ($(`#${column.id}`).is(':checked')) {
                        $(`#${column.id}Column`).show();
                        $(`.${column.id}`).show();
                        column.is_checked = 1;
                    } else {
                        $(`#${column.id}Column`).hide();
                        $(`.${column.id}`).hide();
                        column.is_checked = 0;
                    }
                });
            }

            // Fetch columns from response and generate the field settings
            function loadFieldSettings(response) {
                generateFieldSettings(response.columns_visible);

                // Initialize column visibility based on checkboxes
                updateColumnVisibility(response.columns_visible);

                // Handle checkbox changes
                $(".formCheckAllApplicant-inputs").on("change", function() {
                    updateColumnVisibility(response.columns_visible);
                });

                // Handle 'Show All' button click
                $(".offcanvas-title span").on("click", function() {
                    $(".form-check-input").prop("checked", true);
                    updateColumnVisibility(response.columns_visible);
                });
            }
        </script>

        <script>
            const convertForm = document.getElementById('application_id_convert-form');

            convertForm.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                const formData = new FormData(convertForm);

                fetch(convertForm.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            toastr.success(data.message);
                            $('#convert-to-employee').modal('hide');
                            if (data.conversionSingle == 1) {
                                $('#yes-convert-to-employee').modal('show');
                            } else {
                                $('#employee-status-changed').modal('show');
                            }

                            // location.reload();
                        } else {
                            toastr.error(data.message || 'Conversion failed.');
                            $('#convert-to-employee').modal('hide');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        $('#convert-to-employee').modal('hide');
                    });
            });


            const convertToEmployeeModal = document.getElementById('convert-to-employee');

            convertToEmployeeModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const userName = button.getAttribute('data-username');
                const userId = button.getAttribute('data-userid');

                // Update name in modal title
                document.getElementById('emp-name').textContent = userName;
                document.getElementById('emp-desc-name').textContent = userName;
                document.getElementById('application_id_convert').value = userId;


                // Set dynamic form action (Laravel route example)
                const form = document.getElementById('application_id_convert-form');
                form.action =
                    "{{ route('admin.job-opening.applicant-convertToEmployee') }}"; // Update this route as needed
            });

            const scheduleModal = document.getElementById('schedule-interview');

            scheduleModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const userName = button.getAttribute('data-username');
                const userId = button.getAttribute('data-userid');

                // Update name in modal title
                document.getElementById('interviewee-name').textContent = userName;
                document.getElementById('application_id').value = userId;


                // Set dynamic form action (Laravel route example)
                const form = document.getElementById('schedule-form');
                form.action =
                    "{{ route('admin.job-opening.applicant-interview-schedule') }}"; // Update this route as needed
            });

            // Show/hide interviewer link field if 'Virtual Interview' is selected
            document.querySelectorAll('input[name="interview_mode"]').forEach((radio) => {
                radio.addEventListener('change', function() {
                    console.log("==============", this.value);

                    const linkField = document.getElementById('interviewerLink');
                    if (this.value === '2') {
                        linkField.style.display = 'block';
                    } else {
                        linkField.style.display = 'none';
                    }
                });
            });

            $(document).on('click', '#conductInterviewBtn', function() {

                const applicationId = $(this).attr('data-userid');

                if (!applicationId) {
                    alert("No application selected!");
                    return;
                }

                console.log("Conduct interview for application ID:", applicationId);

                // Redirect to Laravel route
                window.location.href =
                    `/admin/talent-acquisition/candidate-screening/conduct-interview?application_id=${applicationId}`;

            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const modals = ["schedule-interview", "reschedule-interview"];

                modals.forEach(modalId => {
                    const modal = document.getElementById(modalId);
                    if (!modal) return;

                    // Scope only within this modal
                    const radios = modal.querySelectorAll('input[name="interview_mode"]');
                    const linkContainer = modal.querySelector('[id^="interviewerLink"]');
                    const linkInput = modal.querySelector('input[name="interview_link"]');

                    radios.forEach(radio => {
                        radio.addEventListener('change', function() {
                            if (this.value === '2') {
                                linkContainer.style.display = 'block';
                                linkInput.setAttribute('required', 'required');
                            } else {
                                linkContainer.style.display = 'none';
                                linkInput.removeAttribute('required');
                                linkInput.value = ""; // Optional: clear field
                            }
                        });
                    });
                });
            });
        </script>
    @endif


@endsection
